<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;

class TransactionMemberController extends Controller
{
    public function transactionMember(Request $request)
    {
        return view('transaction-member.index', [
            'title' => 'Dashboard Transaction Member',
        ]);
    }

    public function getTransaction(Request $request)
    {
        $members = Member::with(['store', 'card', 'store.salesDetail'])
            ->select('members.*');

        return DataTables::of($members)
            ->addColumn('store', function ($member) {
                return $member->store ? $member->store->name : 'N/A';
            })
            ->addColumn('name', function ($member) {
                return $member->full_name;
            })
            ->addColumn('member', function ($member) {
                return $member->card ? $member->card->number : 'N/A';
            })
            ->addColumn('omset_qty', function ($member) {
                $totalQty = $member->store->salesDetail->sum('qty');
                return $totalQty ? $totalQty : 0;
            })
            ->addColumn('omset_rupiah', function ($member) {
                $totalRupiah = $member->store->salesDetail->sum(function ($detail) {
                    return $detail->qty * $detail->price;
                });
                return $totalRupiah ? number_format($totalRupiah, 2) : 0;
            })
            ->make(true);
    }

}
