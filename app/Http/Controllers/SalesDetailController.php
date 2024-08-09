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
        $query = SalesDetail::with(['store', 'masterArticle', 'salesHeader']);

        return DataTables::of($query)
            ->editColumn('StoreName', function ($row) {
                return $row->store->name;
            })
            ->editColumn('SubCat', function ($row) {
                return $row->masterArticle->subcat;
            })
            ->editColumn('Type', function ($row) {
                return $row->masterArticle->art_type_system;
            })
            ->editColumn('Number', function ($row) {
                return $row->salesHeader->number;
            })
            ->make(true);
    }
}