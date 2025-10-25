<?php

namespace App\Http\Controllers;

use App\Models\LoanRequest;
use Illuminate\Http\Request;

class LoanRequestController extends Controller
{
    public function index()
    {
        return LoanRequest::with('member.user')->latest()->get();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'member_id' => 'required|exists:members,id',
            'amount' => 'required|numeric|min:1000',
            'reason' => 'nullable|string',
        ]);

        $loanRequest = LoanRequest::create($data);
        return response()->json(['message' => 'Loan request submitted', 'data' => $loanRequest]);
    }

    public function approve($id)
    {
        $loanRequest = LoanRequest::findOrFail($id);
        $loanRequest->update(['status' => 'approved']);

        // Loan তৈরি করা হচ্ছে
        \App\Models\Loan::create([
            'member_id' => $loanRequest->member_id,
            'amount' => $loanRequest->amount,
            'installments' => 6, // Default 6 month
            'paid_amount' => 0,
            'status' => 'running',
        ]);

        return response()->json(['message' => 'Loan approved and created']);
    }

    public function reject($id)
    {
        $loanRequest = LoanRequest::findOrFail($id);
        $loanRequest->update(['status' => 'rejected']);
        return response()->json(['message' => 'Loan request rejected']);
    }

    public function destroy($id)
    {
        LoanRequest::findOrFail($id)->delete();
        return response()->json(['message' => 'Loan request deleted']);
    }
}
