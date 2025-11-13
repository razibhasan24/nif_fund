@extends('layouts.app')

@section('content')
<h1 class="text-2xl font-bold mb-4">Member Dashboard</h1>

<div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
  <div class="bg-white p-4 shadow rounded">
    <p class="text-gray-600">Your Total Fund</p>
    <h3 class="text-xl font-bold">{{ $totalFund }} ৳</h3>
  </div>
  <div class="bg-white p-4 shadow rounded">
    <p class="text-gray-600">Your Total Loan</p>
    <h3 class="text-xl font-bold">{{ $totalLoan }} ৳</h3>
  </div>
  <div class="bg-white p-4 shadow rounded">
    <p class="text-gray-600">Total Paid</p>
    <h3 class="text-xl font-bold">{{ $totalPaid }} ৳</h3>
  </div>
</div>

<div class="bg-white p-4 shadow rounded mb-6">
  <h2 class="font-semibold">Recent Funds</h2>
  <ul class="mt-3">
    @forelse($funds as $f)
      <li class="py-2 border-b">{{ \Carbon\Carbon::parse($f->month)->format('M Y') }} — {{ $f->amount }} ৳</li>
    @empty
      <li class="py-2">No funds yet.</li>
    @endforelse
  </ul>
</div>

<div class="bg-white p-4 shadow rounded mb-6">
  <h2 class="font-semibold">Loans</h2>
  <ul class="mt-3">
    @forelse($loans as $loan)
      <li class="py-3 border-b">
        <div class="flex justify-between items-center">
          <div>
            <p><b>Amount:</b> {{ $loan->amount }} ৳</p>
            <p><b>Status:</b> {{ ucfirst($loan->status) }}</p>
          </div>
          <a href="{{ route('member.loans.details', $loan->id) }}" class="bg-blue-600 text-white px-3 py-1 rounded">View</a>
        </div>
      </li>
    @empty
      <li class="py-2">No loans yet.</li>
    @endforelse
  </ul>
</div>

<a href="{{ route('member.loan-request.create') }}" class="bg-green-600 text-white px-4 py-2 rounded">Apply for Loan</a>
@endsection
