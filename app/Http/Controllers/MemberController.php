<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
class MemberController extends Controller
{
    public function index()
    {
        return Member::with('user')->get();
    }

    public function viewList()
{
    $members = Member::with('user')->get();
    return view('members.index', compact('members'));
}


    public function store(Request $request)
    {
        $data = $request->validate([
            'user_id' => 'required|exists:users,id',
            'phone' => 'nullable|string',
            'address' => 'nullable|string',
        ]);
        return Member::create($data);
    }

    public function show($id)
    {
        return Member::with(['funds', 'loans', 'loanRequests'])->findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $member = Member::findOrFail($id);
        $member->update($request->all());
        return $member;
    }

    public function destroy($id)
    {
        Member::findOrFail($id)->delete();
        return response()->json(['message' => 'Member deleted']);
    }
}
