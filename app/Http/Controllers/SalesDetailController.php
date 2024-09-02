<?php

namespace App\Http\Controllers;

use App\Models\SalesDetail;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Auth\Events\Verified;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use RealRashid\SweetAlert\Facades\Alert;

class SalesDetailController extends Controller
{
    public function salesDetail(Request $request)
    {
        if ($request->ajax()) {
            $data = SalesDetail::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->make(true);
        }

        $data = SalesDetail::all();
        return view('sales-detail.index',[
            'data'  => $data,
            'title' => 'Dashboard Transaction Detail',
        ]);
    }

    public function getSalesDetail(Request $request)
    {
        $user = auth()->user();
        $userStoreCode = $user->store_code; 
        $roleId = $user->role_id;

        $query = SalesDetail::with(['store', 'masterArticle', 'salesHeader']);

        if ($roleId == 3) {
            $query->where('store_code', $userStoreCode);
        }

        if (!empty($request->fromDate) && !empty($request->toDate)) {
            $query->whereBetween('tanggal', [$request->fromDate, $request->toDate]);
        }

        return DataTables::of($query)
            ->editColumn('StoreName', function ($row) {
                return $row->store ? $row->store->name : 'Unknown';
            })
            ->editColumn('SubCat', function ($row) {
                return $row->masterArticle ? $row->masterArticle->subcat : 'Unknown';
            })
            ->editColumn('Type', function ($row) {
                return $row->masterArticle ? $row->masterArticle->art_type_system : 'Unknown';
            })
            ->editColumn('Number', function ($row) {
                return $row->salesHeader ? $row->salesHeader->number : 'Unknown';
            })
            ->make(true);
    }
}