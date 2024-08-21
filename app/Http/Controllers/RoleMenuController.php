<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Role;
use App\Models\RoleMenu;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Auth\Events\Verified;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use RealRashid\SweetAlert\Facades\Alert;

class RoleMenuController extends Controller
{
    public function roleMenu(Request $request)
    {
        if ($request->ajax()) {
            $data = RoleMenu::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->make(true);
        }

        $data = RoleMenu::all();
        return view('role-menu.index',[
            'data'  => $data,
            'title' => 'RoleMenu list',
        ]);
    }

    public function getRoleMenu(Request $request)
    {
        if ($request->ajax()) {
            $data = RoleMenu::with(['role', 'menu'])
                ->get()
                ->groupBy('role_id')
                ->map(function($items) {
                    $roleId = $items->first()->role_id;
                    $roleName = optional($items->first()->role)->name ?: 'No Data';
                    
                    $menus = $items->pluck('menu.name')->filter()->unique()->implode(', ');

                    $createdAt = $items->min('created_at')->toIso8601String();
                    $updatedAt = $items->max('updated_at')->toIso8601String();

                    return [
                        'role_id' => $roleId,
                        'role' => $roleName,
                        'menu' => $menus,
                        'created_at' => $createdAt,
                        'updated_at' => $updatedAt,
                        'hashed_id' => base64_encode($roleId)
                    ];
                });

            return DataTables::of($data)
                ->addColumn('action', function($row) {
                    $editUrl = route('edit.role.menu', $row['hashed_id']);

                    return '<div class="dropdown">
                                <button class="btn transparent" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="material-icons">menu</i>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="'.$editUrl.'">Edit</a>
                                </div>
                            </div>';
                })
                ->make(true);
        }

        return view('role-menu.index');
    }

    public function edit($hashedId)
    {
        $roleId = base64_decode($hashedId);

        $roleMenus = RoleMenu::with('menu')
            ->where('role_id', $roleId)
            ->get();

        $role = Role::findOrFail($roleId);

        return view('role-menu.edit', [
            'roleMenus' => $roleMenus,
            'role' => $role,
            'availableMenus' => Menu::all(), 
            'title' => 'Edit Role Menu',
        ]);
    }
// 
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
