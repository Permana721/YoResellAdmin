<?php

namespace App\Http\Controllers;

use App\Models\SalesDetail;
use App\Models\Store;
use DB;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;

class TransactionStoreController extends Controller
{
    public function transactionStore(Request $request)
    {
        if ($request->ajax()) {
            $data = Store::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->make(true);
        }

        $data = Store::all();
        return view('transaction-store.index',[
            'data'  => $data,
            'title' => 'Dashboard Transaction Store',
        ]);
    }

    public function getTransactionStore(Request $request)
    {
        $query = SalesDetail::selectRaw('
            store_code,
            SUM(qty) as omset_qty,
            SUM(price) as omset_rupiah
        ')
        ->groupBy('store_code');

        if ($request->has('fromDate') && $request->has('toDate') && $request->fromDate && $request->toDate) {
            $fromDate = $request->input('fromDate');
            $toDate = $request->input('toDate');
            $query->whereBetween('tanggal', [$fromDate, $toDate]);
        }

        if ($request->has('search') && $request->input('search.value')) {
            $searchValue = strtolower($request->input('search.value'));
            $query->where(function($query) use ($searchValue) {
                $query->whereHas('store', function($q) use ($searchValue) {
                    $q->whereRaw('LOWER(name) LIKE ?', ["%{$searchValue}%"]);
                })->orWhereRaw('LOWER(store_code) LIKE ?', ["%{$searchValue}%"]);
            });
        }

        $data = DataTables::of($query)
            ->addColumn('store', function ($row) {
                return $row->store ? $row->store->name : 'Unknown';
            })
            ->addColumn('omset_qty', function ($row) {
                return $row->omset_qty;
            })
            ->addColumn('omset_rupiah', function ($row) {
                return number_format($row->omset_rupiah);
            })
            ->rawColumns(['store'])
            ->make(true);

        return $data;
    }

}
