@extends('layouts.app')

@section('content')
<h1 class="text-2xl font-bold mb-6">ঋণ আবেদনসমূহ</h1>

<table class="w-full bg-white shadow rounded">
<thead class="bg-red-800 text-white">
<tr>
    <th class="py-2 px-3">সদস্য</th>
    <th class="py-2 px-3">পরিমাণ</th>
    <th class="py-2 px-3">কারণ</th>
    <th class="py-2 px-3">Status</th>
    <th class="py-2 px-3">Actions</th>
</tr>
</thead>
<tbody>
@foreach($loanRequests as $request)
<tr class="border-b hover:bg-gray-100">
    <td class="py-2 px-3">{{ $request->member->user->name }}</td>
    <td class="py-2 px-3">{{ $request->amount }}</td>
    <td class="py-2 px-3">{{ $request->reason }}</td>
    <td class="py-2 px-3 capitalize">{{ $request->status }}</td>
    <td class="py-2 px-3">
        @if($request->status == 'pending')
        <form action="{{ route('loan-requests.approve', $request->id) }}" method="POST" class="inline">
            @csrf
            <button class="bg-green-600 text-white px-2 py-1 rounded">Approve</button>
        </form>
        <form action="{{ route('loan-requests.reject', $request->id) }}" method="POST" class="inline">
            @csrf
            <button class="bg-red-600 text-white px-2 py-1 rounded">Reject</button>
        </form>
        @endif
    </td>
</tr>
@endforeach
</tbody>
</table>
@endsection
