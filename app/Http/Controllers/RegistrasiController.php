<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;

class RegistrasiController extends Controller
{
    public function reportRegistrasi(Request $request)
    {
        return view('registrasi.index', [
            'title' => 'Report',
        ]);
    }

    public function getRegistrasi(Request $request)
    {
        $fromDate = $request->input('fromDate');
        $toDate = $request->input('toDate');

        $query = DB::table('stores')
            ->leftJoin('members', 'stores.store_code', '=', 'members.store_code')
            ->select(
                'stores.store_code',
                'stores.initial_store',
                'stores.name',
                DB::raw('COUNT(members.store_code) as jumlah_terdaftar')
            )
            ->groupBy('stores.store_code', 'stores.initial_store', 'stores.name')
            ->havingRaw('COUNT(members.store_code) > 0');

        if ($fromDate && $toDate) {
            $query->whereBetween('members.created_at', [$fromDate, $toDate]);
        }

        return DataTables::of($query)
            ->make(true);
    }

}
