<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use Illuminate\Http\Request;

class LoanController extends Controller
{
    public function index()
    {
        return Loan::with('member.user', 'installments')->latest()->get();
    }

    public function show($id)
    {
        return Loan::with('member.user', 'installments')->findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $loan = Loan::findOrFail($id);
        $loan->update($request->only('status', 'paid_amount'));
        return response()->json(['message' => 'Loan updated', 'data' => $loan]);
    }

    public function destroy($id)
    {
        Loan::findOrFail($id)->delete();
        return response()->json(['message' => 'Loan deleted successfully']);
    }
}
