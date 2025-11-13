<?php

namespace App\Http\Controllers\Api\Loan;


use App\Http\Controllers\Controller;
use App\Models\Loan;
use Illuminate\Http\Request;

class LoanController extends Controller
{
    public function index()
    {
        return response()->json(Loan::with(['member.user', 'installments'])->latest()->get());
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'member_id' => 'required|exists:members,id',
            'amount' => 'required|numeric|min:1',
            'installments' => 'required|integer|min:1',
            'paid_amount' => 'nullable|numeric|min:0',
            'status' => 'required|string|in:pending,approved,rejected,paid',
        ]);

        $loan = Loan::create($data);
        return response()->json(['message' => 'Loan created successfully', 'data' => $loan], 201);
    }

    public function show($id)
    {
        $loan = Loan::with(['member.user', 'installments'])->findOrFail($id);
        return response()->json($loan);
    }

    public function update(Request $request, $id)
    {
        $loan = Loan::findOrFail($id);

        $data = $request->validate([
            'amount' => 'required|numeric|min:1',
            'installments' => 'required|integer|min:1',
            'paid_amount' => 'nullable|numeric|min:0',
            'status' => 'required|string|in:pending,approved,rejected,paid',
        ]);

        $loan->update($data);
        return response()->json(['message' => 'Loan updated successfully', 'data' => $loan]);
    }

    public function destroy($id)
    {
        Loan::findOrFail($id)->delete();
        return response()->json(['message' => 'Loan deleted successfully']);
    }
}
