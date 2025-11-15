@extends('layouts.app')

@section('content')
<h1 class="text-2xl font-bold mb-4">Apply for Loan</h1>

<div class="bg-white p-6 shadow rounded max-w-xl">
    
    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
            <ul class="list-disc ml-6">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('member.loan-request.store') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label class="block font-semibold mb-1">Loan Amount (৳)</label>
            <input type="number" name="amount" class="w-full border p-2 rounded"
                   placeholder="Enter loan amount" required>
        </div>

        <div class="mb-4">
            <label class="block font-semibold mb-1">Reason for Loan</label>
            <textarea name="reason" class="w-full border p-2 rounded" rows="4"
                      placeholder="Why do you need this loan?" required></textarea>
        </div>

        <div class="mb-4">
            <label class="block font-semibold mb-1">Preferred Installment Duration (Months)</label>
            <input type="number" name="duration" class="w-full border p-2 rounded"
                   placeholder="e.g. 6, 12, 18" required>
        </div>

        <button type="submit"
                class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
            Submit Request
        </button>

        <a href="{{ route('member.dashboard') }}"
           class="ml-3 text-blue-600 hover:underline">
            Cancel
        </a>
    </form>

</div>
@endsection
