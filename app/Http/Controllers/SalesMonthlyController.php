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

        // Query dasar
        $query = SalesDetail::selectRaw('
                EXTRACT(MONTH FROM tanggal) AS month,
                EXTRACT(YEAR FROM tanggal) AS year,
                stores.name AS store_name,
                SUM(qty) AS total_qty,
                SUM(gross - disc) AS total_price
            ')
            ->join('stores', 'sales_details.store_code', '=', 'stores.store_code')
            ->groupByRaw('EXTRACT(MONTH FROM tanggal), EXTRACT(YEAR FROM tanggal), stores.name')
            ->orderByRaw('EXTRACT(YEAR FROM tanggal) ASC, EXTRACT(MONTH FROM tanggal) ASC');

        // Filter berdasarkan store jika dipilih (tidak ALL)
        if ($request->has('store') && $request->store != 'ALL') {
            $query->where('sales_details.store_code', $request->store);
        }

        // Filter lainnya (tanggal, type_customer, dan search)
        if ($request->has('start_date') && $request->has('end_date')) {
            $startDate = Carbon::parse($request->start_date)->startOfMonth();
            $endDate = Carbon::parse($request->end_date)->endOfMonth();
            $query->whereBetween('tanggal', [$startDate, $endDate]);
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

        // Paginasi dan pengembalian data
        $totalRecords = $query->count();
        $perPage = $request->per_page ?? 10;
        $page = $request->page ?? 1;
        $sales = $query->paginate($perPage, ['*'], 'page', $page);

        // Format data untuk frontend
        $data = $sales->map(function ($sale, $index) use ($sales) {
            $monthName = Carbon::create()->month($sale->month)->format('F');
            $periode = "{$monthName} - {$sale->year}";

            return [
                'no' => $sale->month,
                'periode' => $periode,
                'cabang' => $sale->store_name,
                'tipe_customer' => 'ALL',
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

        // Filter berdasarkan tanggal
        if ($request->has('start_date') && $request->has('end_date')) {
            $startDate = Carbon::parse($request->start_date)->startOfMonth();
            $endDate = Carbon::parse($request->end_date)->endOfMonth();
            $query->whereBetween('sales_details.tanggal', [$startDate, $endDate]);
        }

        $sales = $query->get();

        $labels = $sales->map(function ($sale) {
            return Carbon::create()->month($sale->month)->format('F Y');
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
