<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fund;
use App\Models\Loan;
use App\Models\LoanRequest;
use App\Models\Member;

class MemberDashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $member = $user->member;
        if(!$member) abort(404,'Member profile not found.');

        $funds = Fund::where('member_id', $member->id)->orderBy('month','desc')->take(6)->get();
        $loans = Loan::where('member_id', $member->id)->with('installments')->get();
        $pendingLoanRequest = LoanRequest::where('member_id', $member->id)->where('status','pending')->first();

        $totalFund = Fund::where('member_id', $member->id)->sum('amount');
        $totalLoan = Loan::where('member_id', $member->id)->sum('amount');
        $totalPaid = Loan::where('member_id', $member->id)->sum('paid_amount');

        return view('member.dashboard', compact('member','funds','loans','pendingLoanRequest','totalFund','totalLoan','totalPaid'));
    }

    public function funds()
    {
        $member = auth()->user()->member;
        $funds = Fund::where('member_id', $member->id)->orderBy('month','desc')->get();
        return view('member.funds', compact('funds'));
    }

    public function loans()
    {
        $member = auth()->user()->member;
        $loans = Loan::where('member_id', $member->id)->with('installments')->get();
        return view('member.loans', compact('loans'));
    }

    public function loanDetails(Loan $loan)
    {
        if ($loan->member_id !== auth()->user()->member->id) abort(403);
        $loan->load('installments','member.user');
        return view('member.loan-details', compact('loan'));
    }

    public function createLoanRequest()
    {
        return view('member.loan-request-create');
    }

    public function storeLoanRequest(Request $request)
    {
        $member = auth()->user()->member;
        $data = $request->validate([
            'amount' => 'required|numeric|min:1000',
            'reason' => 'nullable|string|max:1000',
        ]);
        LoanRequest::create([
            'member_id' => $member->id,
            'amount' => $data['amount'],
            'reason' => $data['reason'],
            'status' => 'pending',
        ]);
        return redirect()->route('member.dashboard')->with('success','Loan request submitted.');
    }
}
