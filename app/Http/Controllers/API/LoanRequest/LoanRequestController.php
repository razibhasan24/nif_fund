<?php

namespace App\Http\Controllers\Api\LoanRequest;

use App\Http\Controllers\Controller;
use App\Models\LoanRequest;
use Illuminate\Http\Request;

class LoanRequestController extends Controller
{
    public function index()
    {
        return response()->json(LoanRequest::with('member.user')->latest()->get());
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'member_id' => 'required|exists:members,id',
            'amount' => 'required|numeric|min:1',
            'reason' => 'nullable|string|max:255',
            'status' => 'nullable|string|in:pending,approved,rejected',
        ]);

        $loanRequest = LoanRequest::create($data);
        return response()->json(['message' => 'Loan request submitted', 'data' => $loanRequest], 201);
    }

    public function show($id)
    {
        $loanRequest = LoanRequest::with('member.user')->findOrFail($id);
        return response()->json($loanRequest);
    }

    public function update(Request $request, $id)
    {
        $loanRequest = LoanRequest::findOrFail($id);

        $data = $request->validate([
            'status' => 'required|string|in:pending,approved,rejected',
        ]);

        $loanRequest->update($data);
        return response()->json(['message' => 'Loan request updated', 'data' => $loanRequest]);
    }

    public function destroy($id)
    {
        LoanRequest::findOrFail($id)->delete();
        return response()->json(['message' => 'Loan request deleted']);
    }
}
