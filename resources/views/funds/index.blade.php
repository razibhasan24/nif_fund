@extends('layouts.app')

@section('content')
<h1 class="text-2xl font-bold mb-6">মাসিক ফান্ড তালিকা</h1>

<a href="{{ route('funds.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded mb-4 inline-block">নতুন ফান্ড যোগ</a>

<table class="w-full bg-white shadow rounded">
    <thead class="bg-blue-800 text-white">
        <tr>
            <th class="py-2 px-3">সদস্য</th>
            <th class="py-2 px-3">মাস</th>
            <th class="py-2 px-3">পরিমাণ (৳)</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($funds as $fund)
        <tr class="border-b hover:bg-gray-100">
            <td class="py-2 px-3">{{ $fund->member->user->name }}</td>
            <td class="py-2 px-3">{{ \Carbon\Carbon::parse($fund->month)->format('F Y') }}</td>
            <td class="py-2 px-3">{{ $fund->amount }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
