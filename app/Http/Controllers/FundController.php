<?php

namespace App\Http\Controllers;

use App\Models\Fund;
use Illuminate\Http\Request;

class FundController extends Controller
{
    public function index()
    {
        return Fund::with('member.user')->latest()->get();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'member_id' => 'required|exists:members,id',
            'amount' => 'required|numeric|min:0',
            'month' => 'required|date',
        ]);

        $fund = Fund::create($data);
        return response()->json(['message' => 'Fund added successfully', 'data' => $fund]);
    }

    public function show($id)
    {
        return Fund::with('member.user')->findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $fund = Fund::findOrFail($id);
        $fund->update($request->all());
        return response()->json(['message' => 'Fund updated', 'data' => $fund]);
    }

    public function destroy($id)
    {
        Fund::findOrFail($id)->delete();
        return response()->json(['message' => 'Fund deleted successfully']);
    }
}
