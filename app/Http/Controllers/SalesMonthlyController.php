<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\SalesDetail;
use App\Models\Store;
use App\Models\Member;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Auth\Events\Verified;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use RealRashid\SweetAlert\Facades\Alert;

class SalesMonthlyController extends Controller
{
    public function salesMonthly() {
        $stores = Store::all();
        $typeCustomers = Member::select('type_customer')->distinct()->pluck('type_customer');
        
        return view('sales-monthly.index',[
            'title' => 'Report Sales Monthly',
        ], compact('stores', 'typeCustomers'));
    }

    public function getSalesMonthly(Request $request)
    {
        $query = SalesDetail::query();
    
        // Filter berdasarkan tanggal
        if ($request->fromDate && $request->toDate) {
            $fromDate = $request->fromDate . '-01';
            $toDate = date('Y-m-t', strtotime($request->toDate . '-01'));
            $query->whereBetween('tanggal', [$fromDate, $toDate]);
        }
    
        // Filter berdasarkan store
        if ($request->store) {
            $query->where('store_code', $request->store);
        }
    
        // Filter berdasarkan tipe pelanggan
        if ($request->type_customer && $request->type_customer !== 'ALL') {
            $query->whereHas('salesHeader.card.member', function($q) use ($request) {
                $q->where('type_customer', $request->type_customer);
            });
        }
    
        // Ambil data dan lakukan agregasi
        $data = $query->selectRaw('EXTRACT(MONTH FROM tanggal) as bulan, EXTRACT(YEAR FROM tanggal) as tahun, store_code, sum(qty) as totalQty, sum(price) as totalRupiah')
            ->groupBy('bulan', 'tahun', 'store_code')
            ->orderBy('tahun', 'ASC')
            ->orderBy('bulan', 'ASC')
            ->get();
    
        return datatables()->of($data)
            ->addIndexColumn()
            ->addColumn('no', function($row) {
                return $row->bulan; // Mengisi kolom 'no' dengan nomor bulan
            })
            ->addColumn('periode', function($row) {
                return date('F - Y', mktime(0, 0, 0, $row->bulan, 10)) . ' - ' . $row->tahun;
            })
            ->addColumn('cabang', function($row) {
                return Store::where('store_code', $row->store_code)->value('name');
            })
            ->addColumn('salesQTY', function($row) {
                return $row->totalQty;
            })
            ->addColumn('salesRupiah', function($row) {
                return $row->totalRupiah;
            })
            ->make(true);
    }
    

public function getSalesMonthlyChart(Request $request)
{
    $query = SalesDetail::query();

    if ($request->fromDate && $request->toDate) {
        $fromDate = $request->fromDate . '-01';
        $toDate = date('Y-m-t', strtotime($request->toDate . '-01'));

        $query->whereBetween('tanggal', [$fromDate, $toDate]);
    }

    if ($request->store) {
        $query->where('store_code', $request->store);
    }

    if ($request->type_customer && $request->type_customer !== 'ALL') {
        $query->whereHas('salesHeader.card.member', function($q) use ($request) {
            $q->where('type_customer', $request->type_customer);
        });
    }

    // Group by bulan dan tahun
    $data = $query->selectRaw('
            EXTRACT(MONTH FROM tanggal) as bulan, 
            EXTRACT(YEAR FROM tanggal) as tahun, 
            sum(qty) as totalQty, 
            sum(price * qty) as totalRupiah
        ')
        ->groupBy('bulan', 'tahun')
        ->orderBy('tahun', 'ASC')
        ->orderBy('bulan', 'ASC')
        ->get();

    $labels = $data->map(function($row) {
        return date('F - Y', mktime(0, 0, 0, $row->bulan, 10)) . ' - ' . $row->tahun;
    });

    $qty = $data->pluck('totalQty');
    $rupiah = $data->pluck('totalRupiah');

    return response()->json([
        'labels' => $labels,
        'qty' => $qty,
        'rupiah' => $rupiah
    ]);
}


}
