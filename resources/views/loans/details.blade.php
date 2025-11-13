@extends('layouts.app')

@section('content')
<h1 class="text-2xl font-bold mb-4">Loan Details</h1>

<div class="bg-white shadow rounded p-4 mb-6">
    <h2 class="font-bold text-lg">সদস্য: {{ $loan->member->user->name }}</h2>
    <p>Loan Amount: <b>{{ $loan->amount }} ৳</b></p>
    <p>Purpose: {{ $loan->purpose }}</p>
    <p>Status: 
        <span class="px-2 py-1 rounded {{ $loan->status == 'approved' ? 'bg-green-500 text-white' : 'bg-yellow-500' }}">
            {{ ucfirst($loan->status) }}
        </span>
    </p>
</div>

<h2 class="text-xl font-semibold mb-3">Installment Summary</h2>

<table class="w-full bg-white shadow rounded">
    <thead class="bg-blue-800 text-white">
        <tr>
            <th class="py-2 px-3">Date</th>
            <th class="py-2 px-3">Amount (৳)</th>
            <th class="py-2 px-3">Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach($loan->installments as $ins)
        <tr class="border-b hover:bg-gray-50">
            <td class="py-2 px-3">{{ $ins->date->format('d M Y') }}</td>
            <td class="py-2 px-3">{{ $ins->amount }}</td>
            <td class="py-2 px-3">
                <span class="{{ $ins->status == 'paid' ? 'text-green-600' : 'text-red-600' }}">
                    {{ ucfirst($ins->status) }}
                </span>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<p class="mt-4"><b>Total Paid:</b> {{ $loan->installments->where('status','paid')->sum('amount') }} ৳</p>
<p><b>Remaining:</b> {{ $loan->amount - $loan->installments->where('status','paid')->sum('amount') }} ৳</p>

@endsection
