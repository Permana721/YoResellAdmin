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
            $data = Member::select(['id', 'username', 'full_name', 'phone_1', 'nric', 'approve_cso', 'approve_admin', 'created_at', 'updated_at'])
            ->get()
            ->map(function($member) {
                $member->hashed_id = base64_encode($member->id);
                return $member;
            });

            return DataTables::of($data)
                ->addColumn('action', function($row){
                    $editUrl = route('edit.member', $row->hashed_id);

                    $btn = '<div class="dropdown">
                            <button class="btn transparent" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="material-icons">menu</i>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="'.$editUrl.'">Edit</a>
                            </div>
                        </div>';
                    return $btn;
                })
                ->editColumn('approve_admin', function($row){
                    if ($row->approve_admin == 1) {
                        return '<span style="color: green;">Active</span>';
                    } else {
                        return '<span style="color: red;">Not Active</span>';
                    }
                })
                ->rawColumns(['action', 'approve_admin'])
                ->make(true);
        }

        return view('member.index');
    }

    public function edit($hashedId)
    {
        $id = base64_decode($hashedId);
        $data = Member::findOrFail($id);

        return view('member.edit',[
            'data'  => $data,
            'title' => 'Member list',
        ]);
    }

    public function update(Request $request, $id)
    {
        $data = Member::findOrFail($id);

        $request->validate([
            'phone_1' => 'required',
            'username' => 'required',
            'full_name' => 'required',
            'email' => 'required|email',
            'nric' => 'required',
            'keterangan' => 'required',
            'address' => 'required',
            'tokopedia' => 'required',
            'shopee' => 'required',
            'bukalapak' => 'required',
            'lain_lain' => 'required',
            'type_customer' => 'required',
            'brand' => 'required',
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

    public function detail(Request $request)
    {
        if ($request->ajax()) {
            $data = Member::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->make(true);
        }

        $data = Member::all();
        return view('member.detail',[
            'data'  => $data,
            'title' => 'Transaction Member Detail',
        ]);
    }

    public function summary(Request $request)
    {
        if ($request->ajax()) {
            $data = Member::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->make(true);
        }

        $data = Member::all();
        return view('member.transaction',[
            'data'  => $data,
            'title' => 'Transaction Member Summary',
        ]);
    }
}
