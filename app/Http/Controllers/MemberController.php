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
            'title' => 'Member',
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
            $data = Member::select(['id', 'username', 'full_name', 'phone_1', 'nric', 'approve_cso', 'approve_admin', 'created_at', 'updated_at']);

            return DataTables::of($data)
                ->addColumn('action', function($row){
                    $deleteUrl = route('deleteUser', $row->id);
                    $editUrl = route('editUser', $row->id);

                    $btn = '<div class="dropdown">
                            <button class="btn transparent" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="material-icons">menu</i>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="'.$editUrl.'">Edit</a>
                                <form action="'.$deleteUrl.'" method="POST" style="display:inline;">
                                    <input type="hidden" name="_token" value="'.csrf_token().'">
                                    '.method_field('DELETE').'
                                    <button type="submit" class="dropdown-item" onclick="return confirm(\'Are you sure?\')">Delete</button>
                                </form>
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

        return view('members.index');
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
