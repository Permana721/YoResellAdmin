<?php

namespace App\Http\Controllers;

use App\Models\Store;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;

class StoreController extends Controller
{
    public function store(Request $request)
    {
        if ($request->ajax()) {
            $data = Store::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->make(true);
        }

        $data = Store::all();
        return view('store.index',[
            'data'  => $data,
            'title' => 'Store Catalog',
        ]);
    }
// 
    public function getStore(Request $request)
    {
        if ($request->ajax()) {
            $data = Store::select(['id', 'name', 'store_code', 'initial_store', 'address', 'city', 'latitude', 'longitude', 'created_at', 'updated_at'])
            ->get()
            ->map(function($store) {
                $store->hashed_id = base64_encode($store->id);
                return $store;
            });

            return DataTables::of($data)
                ->addColumn('action', function($row){
                    $deleteUrl = route('delete.store', $row->id);
                    $editUrl = route('edit.store', $row->hashed_id);

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

        return view('store.index');
    }

    public function create()
    {
        return view('store.create',[
            'title' => 'Add Store',
        ]);
    }

    public function addDataStore(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'store_code' => 'required',
            'initial_store' => 'required',
            'address' => 'required',
            'city' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
        ]);

        $data = new Store;
        $data->name = $request->name;
        $data->store_code = $request->store_code;
        $data->initial_store = $request->initial_store;
        $data->address = $request->address;
        $data->city = $request->city;
        $data->latitude = $request->latitude;
        $data->longitude = $request->longitude;
        $data->save();

        return redirect()->route('store');
    }

    public function edit($hashedId)
    {
        $id = base64_decode($hashedId);                  
        $data = Store::findOrFail($id);

        return view('store.edit',[
            'data'  => $data,
            'title' => 'Edit Store',
        ]);
    }

    public function update(Request $request, $id)
    {
        $data = Store::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'code' => 'required',
            'initial' => 'required',
            'address' => 'required',
            'city' => 'required',
            'latitude' => 'required',
            'longtitude' => 'required',
        ]);

        $data->name = $request->name;
        $data->code = $request->code;
        $data->initial = $request->initial;
        $data->address = $request->address;
        $data->city = $request->city;
        $data->latitude = $request->latitude;
        $data->longtitude = $request->longtitude;
        $data->save();

        return redirect()->route('store');
    }

    public function destroy($id)
    {
        $Store = Store::findOrFail($id);
        $Store->delete();
        return back();
    }
}
