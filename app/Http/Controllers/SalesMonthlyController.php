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
    $roleId = $user->role_id;
    $storeCode = $user->store_code;

    $query = SalesDetail::selectRaw('
            EXTRACT(MONTH FROM tanggal) AS month,
            EXTRACT(YEAR FROM tanggal) AS year,
            stores.name AS store_name,
            SUM(qty) AS total_qty,
            SUM(price) AS total_price
        ')
        ->join('stores', 'sales_details.store_code', '=', 'stores.store_code')
        ->groupByRaw('EXTRACT(MONTH FROM tanggal), EXTRACT(YEAR FROM tanggal), stores.name')
        ->orderByRaw('EXTRACT(YEAR FROM tanggal) ASC, EXTRACT(MONTH FROM tanggal) ASC');

    if ($roleId == 3) {
        $query->where('sales_details.store_code', $storeCode);
    }

    if ($request->has('start_date') && $request->has('end_date')) {
        $startDate = Carbon::parse($request->start_date);
        $endDate = Carbon::parse($request->end_date);
        $query->whereBetween('tanggal', [$startDate, $endDate]);
    }

    if ($request->has('store') && $request->store != '') {
        $query->where('sales_details.store_code', $request->store);
    }

    if ($request->has('type_customer') && $request->type_customer != 'ALL') {
        $query->where('sales_details.type_customer', $request->type_customer);
    }

    if ($request->has('search') && !empty($request->search)) {
        $searchTerm = $request->search;
        $query->where(function ($q) use ($searchTerm) {
            $q->where('stores.name', 'ILIKE', "%{$searchTerm}%")
            ->orWhereRaw("CAST(EXTRACT(MONTH FROM tanggal) AS TEXT) ILIKE ?", ["%{$searchTerm}%"])
            ->orWhereRaw("CAST(EXTRACT(YEAR FROM tanggal) AS TEXT) ILIKE ?", ["%{$searchTerm}%"]);
        });
    }

    // Get total count for unfiltered data
    $totalRecords = $query->count();

    $perPage = $request->per_page ?? 10;
    $page = $request->page ?? 1;

    $sales = $query->paginate($perPage, ['*'], 'page', $page);

    $data = $sales->map(function ($sale, $index) use ($sales) {
        // Convert month number to month name
        $monthName = Carbon::create()->month($sale->month)->format('F');
        $periode = "{$monthName} - {$sale->year}";

        return [
            'no' => $sale->month, // Number corresponding to the month
            'periode' => $periode,
            'cabang' => $sale->store_name,
            'tipe_customer' => 'ALL', // Set as "ALL"
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

}
