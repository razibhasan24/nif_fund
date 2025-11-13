<?php

namespace App\Http\Controllers;

use App\Models\Installment;
use App\Models\Loan;
use Illuminate\Http\Request;

class InstallmentController extends Controller
{
    // List all installments (paginated)
    public function index()
    {
        $installments = Installment::with('loan.member.user')->latest()->paginate(30);
        return view('installments.index', compact('installments'));
    }

    // Store a new installment and update loan status
    public function store(Request $request)
    {
        $data = $request->validate([
            'loan_id' => 'required|exists:loans,id',
            'amount' => 'required|numeric|min:0',
            'payment_date' => 'required|date',
        ]);

        $installment = Installment::create($data);

        // Update loan's paid amount and status
        $loan = Loan::find($data['loan_id']);
        $loan->paid_amount = ($loan->paid_amount ?? 0) + $data['amount'];
        $loan->status = $loan->paid_amount >= $loan->amount ? 'paid' : 'running';
        $loan->save();

        return back()->with('success', 'Installment recorded successfully.');
    }

    // Delete an installment and adjust loan
    public function destroy($id)
    {
        $installment = Installment::findOrFail($id);
        $loan = $installment->loan;

        // Adjust loan paid amount & status
        $loan->paid_amount = max(0, ($loan->paid_amount - $installment->amount));
        $loan->status = $loan->paid_amount < $loan->amount ? 'running' : $loan->status;
        $loan->save();

        $installment->delete();

        return back()->with('success', 'Installment deleted successfully.');
    }
}
