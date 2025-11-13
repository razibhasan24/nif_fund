<?php

namespace App\Http\Controllers;

use App\Models\LoanRequest;
use App\Models\Loan;
use Illuminate\Http\Request;

class LoanRequestController extends Controller
{
    // Display all loan requests
    public function index()
    {
        $loanRequests = LoanRequest::with('member.user')->latest()->get();
        return view('loan_requests.index', compact('loanRequests'));
    }

    // Approve a loan request
    public function approve($id)
    {
        $loanRequest = LoanRequest::findOrFail($id);

        if ($loanRequest->status !== 'pending') {
            return back()->with('error', 'Request already processed.');
        }

        $loanRequest->update(['status' => 'approved']);

        Loan::create([
            'member_id' => $loanRequest->member_id,
            'amount' => $loanRequest->amount,
            'installments' => 6, // Default 6 months
            'paid_amount' => 0,
            'status' => 'running',
        ]);

        return back()->with('success', 'Loan request approved and loan created.');
    }

    // Reject a loan request
    public function reject($id)
    {
        $loanRequest = LoanRequest::findOrFail($id);

        if ($loanRequest->status !== 'pending') {
            return back()->with('error', 'Request already processed.');
        }

        $loanRequest->update(['status' => 'rejected']);
        return back()->with('success', 'Loan request rejected.');
    }

    // Delete a loan request (optional)
    public function destroy($id)
    {
        LoanRequest::findOrFail($id)->delete();
        return back()->with('success', 'Loan request deleted.');
    }
}
