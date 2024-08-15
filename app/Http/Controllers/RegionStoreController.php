<?php

namespace App\Http\Controllers;

use App\Models\Store;
use App\Models\Region;
use App\Models\RegionStore;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;

class RegionStoreController extends Controller
{
    public function regionStore(Request $request)
    {
        if ($request->ajax()) {
            $data = RegionStore::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->make(true);
        }

        $data = RegionStore::all();
        return view('region-store.index',[
            'data'  => $data,
            'title' => 'Region Store list',
        ]);
    }

    public function getRegionStore(Request $request)
    {
        if ($request->ajax()) {
            $data = Region::with('regionStores.store')->get()->map(function($region) {
                return [
                    'region_id' => $region->id,
                    'region_name' => $region->name,
                    'initial_stores' => $region->regionStores->pluck('store.initial_store')->filter()->unique()->implode(', '),
                    'created_at' => $region->created_at->toIso8601String(),
                    'updated_at' => $region->updated_at->toIso8601String(),
                    'hashed_id' => base64_encode($region->id)
                ];
            });

            return DataTables::of($data)
                ->addColumn('action', function($row) {
                    $editUrl = route('edit.region.store', $row['hashed_id']);

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

        return view('region-store.index');
    }

    public function edit($hashedId)
    {
        $regionId = base64_decode($hashedId);
        $region = Region::findOrFail($regionId);
        $stores = Store::all();
        $selectedStores = RegionStore::where('region_id', $regionId)->pluck('store_code')->toArray();

        return view('region-store.edit', [
            'title' => 'Edit Region Store',
            'region' => $region,
            'stores' => $stores,
            'selectedStores' => $selectedStores
        ]);
    }

}
