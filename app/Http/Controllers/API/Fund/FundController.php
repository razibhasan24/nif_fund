<?php

namespace App\Http\Controllers\Api\Fund;

use App\Http\Controllers\Controller;
use App\Models\Fund;
use Illuminate\Http\Request;

class FundController extends Controller
{
    public function index()
    {
        return response()->json(Fund::with('member.user')->latest()->get());
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'member_id' => 'required|exists:members,id',
            'amount' => 'required|numeric|min:0',
            'month' => 'required|date',
        ]);

        $fund = Fund::create($data);
        return response()->json(['message' => 'Fund created successfully', 'data' => $fund], 201);
    }

    public function show($id)
    {
        $fund = Fund::with('member.user')->findOrFail($id);
        return response()->json($fund);
    }

    public function update(Request $request, $id)
    {
        $fund = Fund::findOrFail($id);

        $data = $request->validate([
            'member_id' => 'required|exists:members,id',
            'amount' => 'required|numeric|min:0',
            'month' => 'required|date',
        ]);

        $fund->update($data);
        return response()->json(['message' => 'Fund updated successfully', 'data' => $fund]);
    }

    public function destroy($id)
    {
        Fund::findOrFail($id)->delete();
        return response()->json(['message' => 'Fund deleted successfully']);
    }
}
