<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Verified;
use Illuminate\Auth\Events\Registered;
use Yajra\DataTables\DataTables;

class RoleController extends Controller
{
    public function role(Request $request)
    {
        if ($request->ajax()) {
            $data = Role::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->make(true);
        }

        $data = Role::all();
        return view('roles.index',[
            'data'  => $data,
            'title' => 'Role list',
        ]);
    }

    public function getRole(Request $request)
    {
        if ($request->ajax()) {
            $data = Role::select(['id', 'name', 'created_at', 'updated_at'])
                        ->get()
                        ->map(function($role) {
                            $role->hashed_id = base64_encode($role->id);
                            return $role;
                        });

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $deleteUrl = route('delete.role', $row->id);
                    $editUrl = route('edit.role', $row->hashed_id); 

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
    
    public function addDataRole(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $data = new Role;
        $data->name = $request->name;
        $data->save();

        return redirect()->route('role');
    }

    public function create()
    {
        return view('roles.create',[
            'title' => 'Add Role',
        ]);
    }

    public function edit($hashedId)
    {
        $id = base64_decode($hashedId);
        $data = Role::findOrFail($id);

        return view('roles.edit',[
            'data'  => $data,
            'title' => 'Edit Role',
        ]);
    }

    public function update(Request $request, $id)
    {
        $data = Role::findOrFail($id);

        $request->validate([
            'name' => 'required',
        ]);

        $data->name = $request->name;
        $data->save();

        return redirect()->route('role');
    }

    public function destroy($id)
    {
        $User = Role::findOrFail($id);
        $User->delete();
        return back();
    }
}