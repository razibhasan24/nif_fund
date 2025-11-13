@extends('layouts.app')

@section('content')
<h1 class="text-2xl font-bold mb-6">ঋণ আবেদনসমূহ / Loan Requests</h1>

@if(session('success'))
    <div class="p-3 bg-green-100 mb-4">{{ session('success') }}</div>
@endif
@if(session('error'))
    <div class="p-3 bg-red-100 mb-4">{{ session('error') }}</div>
@endif

<table class="w-full bg-white shadow rounded">
    <thead class="bg-gray-800 text-white">
        <tr>
            <th class="py-2 px-3">সদস্য / Member</th>
            <th class="py-2 px-3">পরিমাণ / Amount</th>
            <th class="py-2 px-3">কারণ / Reason</th>
            <th class="py-2 px-3">Status</th>
            <th class="py-2 px-3">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($loanRequests as $request)
        <tr class="border-b hover:bg-gray-50">
            <td class="py-2 px-3">{{ $request->member->user->name }}</td>
            <td class="py-2 px-3">{{ $request->amount }} ৳</td>
            <td class="py-2 px-3">{{ $request->reason }}</td>
            <td class="py-2 px-3 capitalize">{{ $request->status }}</td>
            <td class="py-2 px-3">
                @if($request->status == 'pending')
                    <form action="{{ route('loan-requests.approve', $request->id) }}" method="POST" class="inline">
                        @csrf
                        <button class="bg-green-600 text-white px-2 py-1 rounded hover:bg-green-700">Approve</button>
                    </form>
                    <form action="{{ route('loan-requests.reject', $request->id) }}" method="POST" class="inline">
                        @csrf
                        <button class="bg-red-600 text-white px-2 py-1 rounded hover:bg-red-700">Reject</button>
                    </form>
                @else
                    <span class="text-gray-500">Processed</span>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
