<?php

namespace App\Http\Controllers\Api\Member;

use App\Http\Controllers\Controller;
use App\Models\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function index()
    {
        return response()->json(Member::with('user')->latest()->get());
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'user_id' => 'required|exists:users,id',
            'phone' => 'required|string|max:20',
            'address' => 'nullable|string|max:255',
            'join_date' => 'required|date',
        ]);

        $member = Member::create($data);
        return response()->json(['message' => 'Member created successfully', 'data' => $member], 201);
    }

    public function show($id)
    {
        $member = Member::with(['user', 'funds', 'loans', 'loanRequests'])->findOrFail($id);
        return response()->json($member);
    }

    public function update(Request $request, $id)
    {
        $member = Member::findOrFail($id);

        $data = $request->validate([
            'phone' => 'required|string|max:20',
            'address' => 'nullable|string|max:255',
            'join_date' => 'required|date',
        ]);

        $member->update($data);
        return response()->json(['message' => 'Member updated successfully', 'data' => $member]);
    }

    public function destroy($id)
    {
        Member::findOrFail($id)->delete();
        return response()->json(['message' => 'Member deleted successfully']);
    }
}
