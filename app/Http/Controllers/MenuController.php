<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\Member;
use Illuminate\Http\Request;
use App\Http\Requests\MemberRequest;
use Illuminate\Auth\Events\Verified;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\DataTables;

class MenuController extends Controller
{
    public function menu(Request $request)
    {
        if ($request->ajax()) {
            $data = Member::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->make(true);
        }

        $data = Member::all();
        return view('menu.menu',[
            'data'  => $data,
            'title' => 'Menu list',
        ]);
    }

    public function roleMenu(Request $request)
    {
        if ($request->ajax()) {
            $data = Member::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->make(true);
        }

        $data = Member::all();
        return view('menu.roleMenu',[
            'data'  => $data,
            'title' => 'Role Menu',
        ]);
    }
}
