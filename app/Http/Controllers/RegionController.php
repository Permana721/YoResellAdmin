<?php

namespace App\Http\Controllers;

use App\Models\Region;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;

class RegionController extends Controller
{
    public function Region(Request $request)
    {
        if ($request->ajax()) {
            $data = Region::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->make(true);
        }

        $data = Region::all();
        return view('region.index',[
            'data'  => $data,
            'title' => 'Region list',
        ]);
    }

    public function getRegion(Request $request)
    {
        if ($request->ajax()) {
            $data = Region::select(['id', 'name', 'created_at', 'updated_at'])
            ->get()
            ->map(function($region) {
                $region->hashed_id = hash('sha256', $region->id);
                return $region;
            });

            return DataTables::of($data)
                ->addColumn('action', function($row){
                    $deleteUrl = route('delete.region', $row->id);
                    $editUrl = route('edit.region', $row->hashed_id);

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

        return view('region.index');
    }

    public function create()
    {
        return view('region.create',[
            'title' => 'Add Region',
        ]);
    }

    public function addDataRegion(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $data = new Region;
        $data->name = $request->name;
        $data->save();

        return redirect()->route('region');
    }

    public function edit($hashedId)
    {
        $regionId = Region::all()->filter(function($region) use ($hashedId) {
            return hash('sha256', $region->id) === $hashedId;
        })->pluck('id')->first();

        if (!$regionId) {
            abort(404, 'Region not found');
        }

        $data = Region::findOrFail($regionId);

        return view('region.edit', [
            'data'  => $data,
            'title' => 'Region Edit',
        ]);
    }

    public function update(Request $request, $id)
    {
        $data = Region::findOrFail($id);

        $request->validate([
            'name' => 'required',
        ]);

        $data->name = $request->name;
        $data->save();

        return redirect()->route('region');
    }

    public function destroy($id)
    {
        $Region = Region::findOrFail($id);
        $Region->delete();
        return back();
    }
}
