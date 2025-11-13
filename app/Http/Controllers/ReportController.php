<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\User; 

class ReportController extends Controller
{
    public function index()
    {
        // Example months
        $months = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];

        // Example data arrays (replace with DB queries if needed)
        $fundAmounts = [10000, 12000, 8000, 15000, 11000, 13000, 16000, 12000, 17000, 18000, 19000, 20000];
        $loanAmounts = [5000, 6000, 4000, 8000, 7000, 9000, 8500, 9500, 10000, 12000, 11000, 13000];
        $installmentAmounts = [2000, 2500, 2300, 2600, 3000, 2700, 3200, 3400, 3600, 3800, 4000, 4200];

        return view('reports.index', compact('months', 'fundAmounts', 'loanAmounts', 'installmentAmounts'));
    }
}
