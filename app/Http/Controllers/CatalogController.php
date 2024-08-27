<?php

namespace App\Http\Controllers;

use App\Models\Catalog;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;

class CatalogController extends Controller
{
    public function catalog(Request $request)
    {
        if ($request->ajax()) {
            $data = Catalog::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->make(true);
        }

        $data = Catalog::all();
        return view('catalog.index',[
            'data'  => $data,
            'title' => 'Catalog list',
        ]);
    }

    public function getCatalog(Request $request)
    {
        if ($request->ajax()) {
            $user = auth()->user();

            if ($user->role_id == 3) {
                // Jika role_id = 3, tidak mengembalikan data apapun
                return DataTables::of(collect())->make(true);
            }

            $data = Catalog::select(['id', 'name', 'created_by', 'updated_by', 'created_at', 'updated_at', 'whatsapp', 'url_catalog', 'store_code'])
                ->get()
                ->map(function($catalog) {
                    $catalog->hashed_id = base64_encode($catalog->id);
                    return $catalog;
                });

            return DataTables::of($data)
                ->addColumn('action', function($row) {
                    $deleteUrl = route('delete.catalog', $row->id);
                    $editUrl = route('edit.catalog', $row->hashed_id);

                    $btn = '<div class="dropdown">
                            <button class="btn transparent" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="material-icons">menu</i>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="' . $editUrl . '">Edit</a>
                                <form action="' . $deleteUrl . '" method="POST">
                                    <input type="hidden" name="_token" value="' . csrf_token() . '">
                                    ' . method_field('DELETE') . '
                                    <button type="submit" class="dropdown-item w-100" onclick="return confirm(\'Are you sure?\')">Delete</button>
                                </form>
                            </div>
                        </div>';
                    return $btn;
                })
                ->make(true);
        }

        return view('catalog.index');
    }

    public function create()
    {
        return view('catalog.create',[
            'title' => 'Create Catalog',
        ]);
    }

    public function addDataCatalog(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'whatsapp' => 'required',
            'url_catalog' => 'required',
            'store_code' => 'required',
        ]);

        $data = new Catalog;
        $data->name = $request->name;
        $data->whatsapp = $request->whatsapp;
        $data->url_catalog = $request->url_catalog;
        $data->store_code = $request->store_code;
        $data->save();

        return redirect()->route('catalog');
    }

    public function edit($hashedId)
    {
        $id = base64_decode($hashedId);
        $data = Catalog::findOrFail($id);

        return view('catalog.edit',[
            'data'  => $data,
            'title' => 'Catalog Edit',
        ]);
    }

    public function update(Request $request, $id)
    {
        $data = Catalog::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'whatsapp' => 'required',
            'url_catalog' => 'required',
            'store_code' => 'required',
        ]);

        $data->name = $request->name;
        $data->whatsapp = $request->whatsapp;
        $data->url_catalog = $request->url_catalog;
        $data->store_code = $request->store_code;
        $data->save();

        return redirect()->route('catalog');
    }

    public function destroy($id)
    {
        $catalog = Catalog::findOrFail($id);
        $catalog->delete();
        return back();
    }
}
