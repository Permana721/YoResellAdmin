<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Member;
use Illuminate\Http\Request;
use App\Http\Requests\MemberRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Events\Verified;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;

class MemberController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Member::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->make(true);
        }

        $data = Member::all();
        return view('member.index',[
            'data'  => $data,
            'title' => 'Member list',
        ]);
    }

    public function create()
    {
        return view('member.create',[
            'title' => 'Add Member',
        ]);
    }

    public function getMember(Request $request)
    {
        if ($request->ajax()) {
            $query = Member::with('card')
                ->select(['id', 'username', 'full_name', 'phone_1', 'otp', 'approve_cso', 'approve_admin', 'created_at', 'updated_at']);

            $user = auth()->user();
            if ($user->role_id == 3) {
                $query->where('store_code', $user->store_code);
            }

            $data = $query->get()->map(function ($member) use ($user) {
                if ($user->role_id == 3) {
                    $member->phone_otp = $member->phone_1;
                } else {
                    $member->phone_otp = $member->phone_1 . ' (' . $member->otp . ')';
                }
                
                $member->hashed_id = hash('sha256', $member->id);
                return $member;
            });

            return DataTables::of($data)
                ->addColumn('ymc', function ($row) {
                    return optional($row->card)->number ?: 'No Data';
                })
                ->addColumn('action', function ($row) {
                    $editUrl = route('edit.member', $row->hashed_id);

                    return '<div class="dropdown">
                                <button class="btn transparent" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="material-icons">menu</i>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="' . $editUrl . '">Edit</a>
                                </div>
                            </div>';
                })
                ->editColumn('approve_admin', function ($row) {
                    return $row->approve_admin == 1 ? '<span style="color: green;">Active</span>' : '<span style="color: red;">Not Active</span>';
                })
                ->rawColumns(['action', 'approve_admin'])
                ->make(true);
        }

        return view('member.index');
    }

    public function edit($hashedId)
    {
        $memberId = Member::all()->filter(function ($member) use ($hashedId) {
            return hash('sha256', $member->id) === $hashedId;
        })->pluck('id')->first();

        if (!$memberId) {
            abort(404, 'Member not found');
        }

        $data = Member::with('card')->findOrFail($memberId);

        return view('member.edit', [
            'data'  => $data,
            'title' => 'Edit Member by CSO',
        ]);
    }

    public function update(Request $request, $id)
    {
        $data = Member::findOrFail($id);

        $request->validate([
            'phone_1' => 'required',
            'full_name' => 'required',
            'email' => 'required|email',
            'nric' => 'required',
            'keterangan' => 'required',
            'address' => 'required',
        ]);

        $data->phone_1 = $request->phone_1;
        $data->username = $request->username;
        $data->full_name = $request->full_name;
        $data->address = $request->address;
        $data->nric = $request->nric;
        $data->keterangan = $request->keterangan;
        $data->address = $request->address;
        $data->tokopedia = $request->tokopedia;
        $data->shopee = $request->shopee;
        $data->bukalapak = $request->bukalapak;
        $data->lain_lain = $request->lain_lain;
        $data->type_customer = $request->type_customer;
        $data->brand = $request->brand;
        $data->save();     

        
        return redirect()->route('member');
    }
}
