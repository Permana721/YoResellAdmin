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

        return back();
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
            $data = User::select(['id', 'username', 'full_name', 'phone', 'email', 'role', 'created_at', 'updated_at'])
                        ->get()
                        ->map(function($user) {
                            $user->status = 'Active';
                            $user->hashed_id = base64_encode($user->id);
                            return $user;
                        });

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $deleteUrl = route('deleteUser', $row->id);
                    $editUrl = route('editUser', $row->hashed_id); 

                    $btn = '<div class="dropdown">
                            <button class="btn transparent" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="material-icons">menu</i>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="'.$editUrl.'">Edit</a>
                                <form action="'.$deleteUrl.'" method="POST">
                                    <input type="hidden" name="_token" value="'.csrf_token().'">
                                    '.method_field('DELETE').'
                                    <button type="submit" class="dropdown-item w-100" onclick="return confirm(\'Are you sure?\')">Delete</button>
                                </form>
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
        $id = base64_decode($hashedId);
        $data = User::findOrFail($id);

        return view('user.edit',[
            'data'  => $data,
            'title' => 'User list',
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
        $data->role = $request->role;
        $data->phone = $request->phone;
        $data->save();

        return redirect()->route('user');
    }

    public function update(Request $request, $id)
    {
        $data = User::findOrFail($id);

        $request->validate([
            'full_name' => 'required',
            'username' => 'required',
            'email' => 'required|email',
            'role' => 'required',
            'phone' => 'required',
        ]);

        $data->full_name = $request->full_name;
        $data->username = $request->username;
        $data->email = $request->email;
        $data->role = $request->role;
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
        request()->session()->regenerateToken();
        return redirect('/login');                       
    }
}
