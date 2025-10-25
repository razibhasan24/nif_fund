<?php

namespace App\Http\Controllers;

use App\Models\Installment;
use App\Models\Loan;
use Illuminate\Http\Request;

class InstallmentController extends Controller
{
    public function index()
    {
        return Installment::with('loan.member.user')->latest()->get();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'loan_id' => 'required|exists:loans,id',
            'amount' => 'required|numeric|min:0',
            'payment_date' => 'required|date',
        ]);

        $installment = Installment::create($data);

        // Loan update
        $loan = Loan::find($request->loan_id);
        $loan->paid_amount += $request->amount;
        if ($loan->paid_amount >= $loan->amount) {
            $loan->status = 'paid';
        }
        $loan->save();

        return response()->json(['message' => 'Installment added', 'data' => $installment]);
    }

    public function destroy($id)
    {
        Installment::findOrFail($id)->delete();
        return response()->json(['message' => 'Installment deleted']);
    }
}
