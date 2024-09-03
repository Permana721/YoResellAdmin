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
            ->groupBy('month', 'year', 'store_name')
            ->orderBy('year')
            ->orderBy('month');

        if ($roleId == 3) {
            $query->where('sales_details.store_code', $storeCode);
        }

        if ($request->has('start_date') && $request->has('end_date')) {
            $startDate = Carbon::parse($request->start_date);
            $endDate = Carbon::parse($request->end_date);
            $query->whereBetween('tanggal', [$startDate, $endDate]);
        }

        $data = $query->paginate($request->input('length'));

        $results = $data->map(function ($item) {
            $monthName = Carbon::createFromFormat('m', $item->month)->format('F');
            $period = "{$monthName} - {$item->year}";

            return [
                'no' => $item->month,
                'periode' => $period,
                'cabang' => $item->store_name,
                'tipe_customer' => 'ALL',
                'sales_qty' => $item->total_qty,
                'total_penjualan' => number_format($item->total_price, 0, ',', '.'),
            ];
        });

        return response()->json([
            'draw' => intval($request->input('draw')),
            'recordsTotal' => $data->total(),
            'recordsFiltered' => $data->total(),
            'data' => $results,
        ]);
    }
}
