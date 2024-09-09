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

class UserController extends Controller
{
    
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

        $data = new User;
        $data->full_name = $request->full_name;
        $data->username = $request->username;
        $data->email = $request->email;
        $data->password = bcrypt($request->password);
        $data->role = $request->role;
        $data->phone = $request->phone;
        $data->save();

        return redirect('/login');
    }

    public function logpros(Request $request)
    {
        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->intended('home');
        }

        // Flash an error message to the session
        return back()->with('error', 'Username atau Password salah');
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = User::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->make(true);
        }

        $data = User::all();
        return view('user.index',[
            'data'  => $data,
            'title' => 'User list',
        ]);
    }

    public function getUsers(Request $request)
    {
        if ($request->ajax()) {
            $data = User::select(['id', 'username', 'full_name', 'phone', 'email', 'role_id', 'created_at', 'updated_at'])
                        ->get()
                        ->map(function($user) {
                            $user->status = 'Active';
                            $user->hashed_id = hash('sha256', $user->id);
                            return $user;
                        });

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row) {
                    $deleteUrl = route('deleteUser', $row->id);
                    $editUrl = route('editUser', $row->hashed_id); 

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
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function edit($hashedId)
    {
        $userId = User::all()->filter(function($user) use ($hashedId) {
            return hash('sha256', $user->id) === $hashedId;
        })->pluck('id')->first();

        if (!$userId) {
            abort(404, 'User not found');
        }

        $data = User::findOrFail($userId);

        return view('user.edit', [
            'data'  => $data,
            'title' => 'Edit User',
        ]);
    }

    public function create()
    {
        return view('user.create',[
            'title' => 'Add User',
        ]);
    }

    public function addDataUser(MemberRequest $request)
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
        $data->role_id = $request->role_id;
        $data->phone = $request->phone;
        $data->save();

        return redirect()->route('user');
    }

    public function update(Request $request, $id)
    {
        $data = User::findOrFail($id);

        $data->full_name = $request->full_name;
        $data->username = $request->username;
        $data->email = $request->email;
        $data->role_id = $request->role_id;
        $data->phone = $request->phone;
        $data->save();

        return redirect()->route('user');
    }

    public function destroy($id)
    {
        $User = User::findOrFail($id);
        $User->delete();
        return back();
    }

    public function logout()
    {
        Auth::logout();
        request()->session()->invalidate();
        return redirect('/login');                       
    }
}

