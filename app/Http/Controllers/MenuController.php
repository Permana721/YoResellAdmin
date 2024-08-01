<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;

class MenuController extends Controller
{
    public function menu(Request $request)
    {
        if ($request->ajax()) {
            $data = Menu::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->make(true);
        }

        $data = Menu::all();
        return view('menu.index',[
            'data'  => $data,
            'title' => 'Menu list',
        ]);
    }

    public function getMenu(Request $request)
    {
        if ($request->ajax()) {
            $data = Menu::select(['id', 'name', 'group_name', 'url', 'icon', 'created_at', 'updated_at'])
            ->get()
            ->map(function($menu) {
                $menu->hashed_id = base64_encode($menu->id);
                return $menu;
            });

            return DataTables::of($data)
                ->addColumn('action', function($row){
                    $deleteUrl = route('delete.menu', $row->id);
                    $editUrl = route('edit.menu', $row->hashed_id);

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
                ->make(true);
        }

        return view('menu.index');
    }

    public function create()
    {
        return view('menu.create',[
            'title' => 'Add Menu',
        ]);
    }

    public function addDataMenu(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'group_name' => 'required',
            'url' => 'required',
            'icon' => 'required',
        ]);

        $data = new Menu;
        $data->name = $request->name;
        $data->group_name = $request->group_name;
        $data->url = $request->url;
        $data->icon = $request->icon;
        $data->save();

        return redirect()->route('menu');
    }

    public function edit($hashedId)
    {
        $id = base64_decode($hashedId);
        $data = Menu::findOrFail($id);

        return view('menu.edit',[
            'data'  => $data,
            'title' => 'Menu List',
        ]);
    }

    public function update(Request $request, $id)
    {
        $data = Menu::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'group_name' => 'required',
            'url' => 'required',
            'icon' => 'required',
        ]);

        $data->name = $request->name;
        $data->group_name = $request->group_name;
        $data->url = $request->url;
        $data->icon = $request->icon;
        $data->save();

        return redirect()->route('menu');
    }

    public function destroy($id)
    {
        $Menu = Menu::findOrFail($id);
        $Menu->delete();
        return back();
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
