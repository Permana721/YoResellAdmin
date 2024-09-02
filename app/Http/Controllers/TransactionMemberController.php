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
        $user = auth()->user();
        $roleId = $user->role_id;
        $userStoreCode = $user->store_code;

        $members = Member::with(['store', 'card', 'card.salesHeaders.salesDetails'])
            ->select('members.*');

        if ($roleId == 3 && $userStoreCode) {
            $members->whereHas('store', function ($query) use ($userStoreCode) {
                $query->where('store_code', $userStoreCode);
            });
        }

        if ($request->has('fromDate') && $request->has('toDate')) {
            $fromDate = $request->input('fromDate');
            $toDate = $request->input('toDate');
            $members->whereHas('card.salesHeaders.salesDetails', function ($query) use ($fromDate, $toDate) {
                $query->whereBetween('tanggal', [$fromDate, $toDate]);
            });
        }

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
            ->addColumn('omset_qty', function ($member) use ($request) {
                $fromDate = $request->input('fromDate');
                $toDate = $request->input('toDate');

                if ($member->card) {
                    $query = $member->card->salesHeaders->flatMap(function ($header) {
                        return $header->salesDetails;
                    });

                    if ($fromDate && $toDate) {
                        $query = $query->filter(function ($detail) use ($fromDate, $toDate) {
                            return $detail->tanggal >= $fromDate && $detail->tanggal <= $toDate;
                        });
                    }

                    $totalQty = $query->sum('qty');
                    return $totalQty;
                }
                return 0;
            })
            ->addColumn('omset_rupiah', function ($member) use ($request) {
                $fromDate = $request->input('fromDate');
                $toDate = $request->input('toDate');

                if ($member->card) {
                    $query = $member->card->salesHeaders->flatMap(function ($header) {
                        return $header->salesDetails;
                    });

                    if ($fromDate && $toDate) {
                        $query = $query->filter(function ($detail) use ($fromDate, $toDate) {
                            return $detail->tanggal >= $fromDate && $detail->tanggal <= $toDate;
                        });
                    }

                    $totalRupiah = $query->sum(function ($detail) {
                        return $detail->gross - $detail->disc;
                    });

                    return $totalRupiah ? number_format($totalRupiah) : 0;
                }
                return 0;
            })
            ->make(true);
    }

}
