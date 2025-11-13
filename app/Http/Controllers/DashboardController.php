<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\User;

class DashboardController extends Controller
{
     public function index()
    {
        $totalFund = Fund::sum('amount');
        $totalLoan = Loan::sum('amount');
        $totalPaid = Loan::sum('paid_amount');
        $balance = $totalFund - ($totalLoan - $totalPaid);
        $activeLoans = Loan::where('status','running')->count();
        $members = Member::count();

        return view('dashboard.index', compact('totalFund','totalLoan','totalPaid','balance','activeLoans','members'));
    }
}
