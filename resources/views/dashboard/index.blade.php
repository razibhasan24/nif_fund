@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Dashboard</h1>

    <div class="grid grid-cols-3 gap-4">
        <!-- Total Paid -->
        <div class="bg-green-100 p-4 rounded shadow">
            <h2 class="text-lg font-semibold">Total Paid</h2>
            <p class="text-xl font-bold text-green-700">{{ $totalPaid ?? 0 }}</p>
        </div>

        <!-- Total Pending -->
        <div class="bg-yellow-100 p-4 rounded shadow">
            <h2 class="text-lg font-semibold">Total Pending</h2>
            <p class="text-xl font-bold text-yellow-700">{{ $totalPending ?? 0 }}</p>
        </div>

        <!-- Total Users -->
        <div class="bg-blue-100 p-4 rounded shadow">
            <h2 class="text-lg font-semibold">Total Users</h2>
            <p class="text-xl font-bold text-blue-700">{{ $totalUsers ?? 0 }}</p>
        </div>
    </div>
</div>
@endsection
