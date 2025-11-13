<?php

namespace App\Http\Controllers;

use App\Models\Fund;
use App\Models\Member;
use Illuminate\Http\Request;

class FundController extends Controller
{
    // List all funds
    public function index()
    {
        $funds = Fund::with('member.user')->latest()->paginate(20);
        return view('funds.index', compact('funds'));
    }

    // Show form to add new funda
    public function create()
    {
        $members = Member::with('user')->get();
        return view('funds.create', compact('members'));
    }

    // Store a new fund
    public function store(Request $request)
    {
        $data = $request->validate([
            'member_id' => 'required|exists:members,id',
            'amount' => 'required|numeric|min:0',
            'month' => 'required|date',
        ]);

        Fund::create($data);

        return redirect()->route('funds.index')->with('success', 'Fund added successfully.');
    }

    // Show form to edit a fund
    public function edit($id)
    {
        $fund = Fund::findOrFail($id);
        $members = Member::with('user')->get();
        return view('funds.edit', compact('fund', 'members'));
    }

    // Update fund data
    public function update(Request $request, $id)
    {
        $fund = Fund::findOrFail($id);

        $data = $request->validate([
            'member_id' => 'required|exists:members,id',
            'amount' => 'required|numeric|min:0',
            'month' => 'required|date',
        ]);

        $fund->update($data);

        return redirect()->route('funds.index')->with('success', 'Fund updated successfully.');
    }

    // Delete a fund
    public function destroy($id)
    {
        Fund::findOrFail($id)->delete();
        return back()->with('success', 'Fund deleted successfully.');
    }
}
