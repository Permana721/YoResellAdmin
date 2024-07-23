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

class MemberController extends Controller
{

    public function index()
    {
        return view('home');
    }

    public function login()
    {
        return view('auth.login');
    }

    public function register()
    {
        return view('auth.register');
    }

    public function store()
    {
        $data = User::all();

        return view('store.index',[
            'data'  => $data,
        ]);
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

        $data = new User;
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
        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            // Authentication passed...
            return redirect()->intended('home');
        }

        return redirect()->back()->withErrors([
            'username' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout()
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect('/login');                       
    }
}
