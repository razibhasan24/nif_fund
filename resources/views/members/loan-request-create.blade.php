@extends('layouts.app')

@section('content')
<h1 class="text-2xl font-bold mb-4">Apply for Loan</h1>
@if(session('success')) <div class="p-3 bg-green-100 mb-4">{{ session('success') }}</div> @endif

<form action="{{ route('member.loan-request.store') }}" method="POST" class="bg-white p-4 shadow rounded max-w-lg">
  @csrf
  <div class="mb-4">
    <label class="block mb-1">Amount (৳)</label>
    <input name="amount" type="number" required class="w-full border p-2 rounded" />
  </div>
  <div class="mb-4">
    <label class="block mb-1">Reason</label>
    <textarea name="reason" class="w-full border p-2 rounded" rows="4"></textarea>
  </div>
  <button class="bg-blue-600 text-white px-4 py-2 rounded">Submit Request</button>
</form>
@endsection
