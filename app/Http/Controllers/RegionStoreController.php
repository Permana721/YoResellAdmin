<?php

namespace App\Http\Controllers;

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
        $data = RegionStore::with(['region', 'store'])
            ->get()
            ->groupBy(function ($item) {
                return $item->region->name; // Mengelompokkan berdasarkan nama region
            })
            ->map(function($items) {
                $firstItem = $items->first(); 

                $regionName = $items->pluck('region.name')->unique()->implode(', ');
                $regionId = $firstItem->region_id;

                // Mendapatkan initial_store yang unik
                $initialStores = $items->pluck('store.initial_store')->filter()->unique()->implode(', ');

                // Mendapatkan tanggal paling awal dan paling akhir dari created_at dan updated_at
                $createdAt = $items->min('created_at')->toIso8601String();
                $updatedAt = $items->max('updated_at')->toIso8601String();

                return [
                    'region_id' => $regionId,
                    'region' => $regionName,
                    'initial_stores' => $initialStores,
                    'created_at' => $createdAt,
                    'updated_at' => $updatedAt,
                    'hashed_id' => base64_encode($regionId)
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


}
