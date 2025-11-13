<?php

namespace App\Http\Controllers\Api\Payment;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    // GET /api/payments
    public function index()
    {
        $payments = Payment::latest()->get();
        return response()->json($payments);
    }

    // POST /api/payments
    public function store(Request $request)
    {
        $data = $request->validate([
            'amount' => 'required|numeric|min:1',
            'status' => 'required|string|in:pending,completed,failed',
        ]);

        $payment = Payment::create($data);

        return response()->json([
            'message' => 'Payment created successfully',
            'data' => $payment
        ], 201);
    }

    // GET /api/payments/{id}
    public function show($id)
    {
        $payment = Payment::findOrFail($id);
        return response()->json($payment);
    }

    // PUT/PATCH /api/payments/{id}
    public function update(Request $request, $id)
    {
        $payment = Payment::findOrFail($id);

        $data = $request->validate([
            'amount' => 'required|numeric|min:1',
            'status' => 'required|string|in:pending,completed,failed',
        ]);

        $payment->update($data);

        return response()->json([
            'message' => 'Payment updated successfully',
            'data' => $payment
        ]);
    }

    // DELETE /api/payments/{id}
    public function destroy($id)
    {
        Payment::findOrFail($id)->delete();

        return response()->json([
            'message' => 'Payment deleted successfully'
        ]);
    }
}
