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
    $user = Auth::user();
    $storeCode = $user->store_code;

    $query = SalesDetail::selectRaw('
            EXTRACT(MONTH FROM sales_details.tanggal) AS month,
            EXTRACT(YEAR FROM sales_details.tanggal) AS year,
            stores.name AS store_name,
            SUM(sales_details.qty) AS total_qty,
            SUM(sales_details.gross - sales_details.disc) AS total_price
        ')
        ->join('stores', 'sales_details.store_code', '=', 'stores.store_code')
        ->join('sales_headers', 'sales_details.trans', '=', 'sales_headers.trans')
        ->join('cards', 'sales_headers.number', '=', 'cards.number')
        ->join('members', 'cards.member_id', '=', 'members.id')
        ->groupByRaw('EXTRACT(MONTH FROM sales_details.tanggal), EXTRACT(YEAR FROM sales_details.tanggal), stores.name')
        ->orderByRaw('EXTRACT(YEAR FROM sales_details.tanggal) ASC, EXTRACT(MONTH FROM sales_details.tanggal) ASC');

    if ($request->has('store') && $request->store != 'ALL') {
        $query->where('sales_details.store_code', $request->store);
    }

    if ($request->has('start_date') && $request->has('end_date')) {
        $startDate = Carbon::parse($request->start_date)->startOfDay();
        $endDate = Carbon::parse($request->end_date)->endOfDay();

        $query->whereBetween('sales_details.tanggal', [$startDate, $endDate]);
    }

    if ($request->has('type_customer') && $request->type_customer != 'ALL') {
        $query->where('members.type_customer', $request->type_customer);
    }    

    if ($request->has('search') && !empty($request->search)) {
        $searchTerm = $request->search;
        $query->where(function ($q) use ($searchTerm) {
            $q->where('stores.name', 'ILIKE', "%{$searchTerm}%")
              ->orWhereRaw("CAST(EXTRACT(MONTH FROM sales_details.tanggal) AS TEXT) ILIKE ?", ["%{$searchTerm}%"])
              ->orWhereRaw("CAST(EXTRACT(YEAR FROM sales_details.tanggal) AS TEXT) ILIKE ?", ["%{$searchTerm}%"]);
        });
    }

    $totalRecords = $query->count();
    $perPage = $request->per_page ?? 10;
    $page = $request->page ?? 1;
    $sales = $query->paginate($perPage, ['*'], 'page', $page);

    $selectedType = $request->type_customer == 'ALL' ? 'ALL' : $request->type_customer;

    $data = $sales->map(function ($sale, $index) use ($sales, $selectedType) {
        $monthName = Carbon::create()->month($sale->month)->format('F');
        $periode = "{$monthName} - {$sale->year}";

        return [
            'no' => $sale->month,
            'periode' => $periode,
            'cabang' => $sale->store_name,
            'tipe_customer' => $selectedType,
            'sales_qty' => number_format($sale->total_qty, 0, ',', '.'),
            'total_penjualan' => number_format($sale->total_price, 0, ',', '.'),
        ];
    });

    return response()->json([
        'draw' => $request->input('draw', 1),
        'recordsTotal' => $totalRecords,
        'recordsFiltered' => $sales->total(),
        'data' => $data,
    ]);
}


public function getSalesChartData(Request $request)
{
    $query = SalesDetail::selectRaw('
            EXTRACT(MONTH FROM sales_details.tanggal) AS month,
            EXTRACT(YEAR FROM sales_details.tanggal) AS year,
            SUM(sales_details.qty) AS total_qty,
            SUM(sales_details.gross - sales_details.disc) AS total_price
        ')
        ->join('stores', 'sales_details.store_code', '=', 'stores.store_code')
        ->join('sales_headers', 'sales_details.trans', '=', 'sales_headers.trans')
        ->join('cards', 'sales_headers.number', '=', 'cards.number')
        ->join('members', 'cards.member_id', '=', 'members.id')
        ->groupByRaw('EXTRACT(MONTH FROM sales_details.tanggal), EXTRACT(YEAR FROM sales_details.tanggal)')
        ->orderByRaw('EXTRACT(YEAR FROM sales_details.tanggal) ASC, EXTRACT(MONTH FROM sales_details.tanggal) ASC');

    if ($request->has('start_date') && $request->has('end_date')) {
        $startDate = Carbon::parse($request->start_date)->startOfMonth();
        $endDate = Carbon::parse($request->end_date)->endOfMonth();
        $query->whereBetween('sales_details.tanggal', [$startDate, $endDate]);
    }

    if ($request->has('store') && $request->store != 'ALL') {
        $query->where('sales_details.store_code', $request->store);
    }

    if ($request->has('type_customer') && $request->type_customer != 'ALL') {
        $query->where('members.type_customer', $request->type_customer);
    }    

    $sales = $query->get();

    $labels = $sales->map(function ($sale) {
        return Carbon::create()->month($sale->month)->year($sale->year)->format('F Y');
    });
    
    $qtyData = $sales->map(function ($sale) {
        return $sale->total_qty;
    });

    $priceData = $sales->map(function ($sale) {
        return $sale->total_price;
    });

    return response()->json([
        'labels' => $labels,
        'qtyData' => $qtyData,
        'priceData' => $priceData,
    ]);
}



}
