<?php

namespace App\Http\Controllers;

use App\Models\Fund;
use App\Models\Loan;
use App\Models\Member;

class DashboardController extends Controller
{
    public function index()
    {
        $totalFund = Fund::sum('amount');
        $totalLoan = Loan::sum('amount');
        $totalPaid = Loan::sum('paid_amount');
        $balance = $totalFund - ($totalLoan - $totalPaid);
        $activeLoans = Loan::where('status', 'running')->count();
        $members = Member::count();

        return response()->json([
            'total_fund' => $totalFund,
            'total_loan' => $totalLoan,
            'total_paid' => $totalPaid,
            'available_balance' => $balance,
            'active_loans' => $activeLoans,
            'total_members' => $members,
        ]);
    }
}
