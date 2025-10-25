<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        // মোট Paid amount
        $totalPaid = Payment::where('status', 'paid')->sum('amount');

        // মোট Pending amount
        $totalPending = Payment::where('status', 'pending')->sum('amount');

        // মোট user
        $totalUsers = User::count();

        // Blade template এ পাঠানো
        return view('dashboard.index', compact('totalPaid', 'totalPending', 'totalUsers'));
    }
}
