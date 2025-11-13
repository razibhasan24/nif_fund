@extends('layouts.app')

@section('content')
<h1 class="text-2xl font-bold mb-6">Loan Installments</h1>

<a href="{{ route('installments.create') }}" class="bg-green-600 text-white px-4 py-2 rounded mb-4 inline-block">নতুন কিস্তি যোগ</a>

<table class="w-full bg-white shadow rounded">
    <thead class="bg-green-700 text-white">
        <tr>
            <th class="py-2 px-3">Loan ID</th>
            <th class="py-2 px-3">সদস্য</th>
            <th class="py-2 px-3">তারিখ</th>
            <th class="py-2 px-3">পরিমাণ (৳)</th>
            <th class="py-2 px-3">Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($installments as $item)
        <tr class="border-b hover:bg-gray-100">
            <td class="py-2 px-3">{{ $item->loan_id }}</td>
            <td class="py-2 px-3">{{ $item->loan->member->user->name }}</td>
            <td class="py-2 px-3">{{ $item->date->format('d M Y') }}</td>
            <td class="py-2 px-3">{{ $item->amount }}</td>
            <td class="py-2 px-3">
                <span class="px-2 py-1 rounded {{ $item->status == 'paid' ? 'bg-green-500 text-white' : 'bg-red-500 text-white' }}">
                    {{ ucfirst($item->status) }}
                </span>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
