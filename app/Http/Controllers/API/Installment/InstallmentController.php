<?php

namespace App\Http\Controllers\Api\Installment;

use App\Http\Controllers\Controller;
use App\Models\Installment;
use Illuminate\Http\Request;

class InstallmentController extends Controller
{
    public function index()
    {
        return response()->json(Installment::with('loan.member.user')->latest()->get());
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'loan_id' => 'required|exists:loans,id',
            'amount' => 'required|numeric|min:1',
            'payment_date' => 'required|date',
        ]);

        $installment = Installment::create($data);
        return response()->json(['message' => 'Installment created successfully', 'data' => $installment], 201);
    }

    public function show($id)
    {
        $installment = Installment::with('loan.member.user')->findOrFail($id);
        return response()->json($installment);
    }

    public function update(Request $request, $id)
    {
        $installment = Installment::findOrFail($id);

        $data = $request->validate([
            'amount' => 'required|numeric|min:1',
            'payment_date' => 'required|date',
        ]);

        $installment->update($data);
        return response()->json(['message' => 'Installment updated successfully', 'data' => $installment]);
    }

    public function destroy($id)
    {
        Installment::findOrFail($id)->delete();
        return response()->json(['message' => 'Installment deleted successfully']);
    }
}
