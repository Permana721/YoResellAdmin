<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
use App\Http\Requests\MemberRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class MemberController extends Controller
{

    public function index()
    {
        return view("INI HALAMAN UTAMA");
    }

    public function login()
    {
        return view('auth.login');
    }

    public function register()
    {
        return view('auth.register');
    }

    public function regpros(MemberRequest $request)
    {
        $request->validate([
            'full_name' => 'required',
            'username' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6',
            'role' => 'required',
            'phone' => 'required',
        ]);

        $data = new Member;
        $data->full_name = $request->full_name;
        $data->username = $request->username;
        $data->email = $request->email;
        $data->password = bcrypt($request->password);
        $data->role = $request->role;
        $data->phone = $request->phone;
        $data->save();

        return back()->with('success', 'Berhasil menambah data member');
    }

    public function logpros(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $member = Member::where('username', $request->username)->first();

        if ($member && Hash::check($request->password, $member->password)) {
            return redirect('/');
            return response()->json(['message' => 'Login successful']);
        } else {
            return response()->json(['message' => 'Invalid username or password'], 401);
        }
    }
}
