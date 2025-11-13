<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use Illuminate\Http\Request;

class LoanController extends Controller
{
    // Display a paginated list of loans
    public function index()
    {
        $loans = Loan::with('member.user', 'installments')->latest()->paginate(20);
        return view('loans.index', compact('loans'));
    }

    // Show details of a single loan
    public function show($id)
    {
        $loan = Loan::with('member.user', 'installments')->findOrFail($id);
        return view('loans.show', compact('loan'));
    }

    // Update loan status or paid amount
    public function update(Request $request, $id)
    {
        $loan = Loan::findOrFail($id);

        $data = $request->validate([
            'status' => 'required|in:running,paid,default',
            'paid_amount' => 'nullable|numeric|min:0',
        ]);

        $loan->update($data);

        return back()->with('success', 'Loan updated successfully.');
    }

    // Delete a loan
    public function destroy($id)
    {
        Loan::findOrFail($id)->delete();
        return back()->with('success', 'Loan deleted successfully.');
    }
}
