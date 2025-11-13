@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">

    <h1 class="text-3xl font-bold mb-6 text-gray-800">ড্যাশবোর্ড</h1>

    <!-- Summary Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-white shadow rounded-lg p-5">
            <p class="text-gray-500">মোট ফান্ড</p>
            <h2 class="text-2xl font-bold text-blue-600">{{ $totalFund ?? 0 }} ৳</h2>
        </div>
        <div class="bg-white shadow rounded-lg p-5">
            <p class="text-gray-500">মোট ঋণ</p>
            <h2 class="text-2xl font-bold text-red-600">{{ $totalLoan ?? 0 }} ৳</h2>
        </div>
        <div class="bg-white shadow rounded-lg p-5">
            <p class="text-gray-500">Paid</p>
            <h2 class="text-2xl font-bold text-green-600">{{ $totalPaid ?? 0 }} ৳</h2>
        </div>
        <div class="bg-white shadow rounded-lg p-5">
            <p class="text-gray-500">ব্যালান্স</p>
            <h2 class="text-2xl font-bold text-yellow-600">{{ $balance ?? 0 }} ৳</h2>
        </div>
    </div>

    <!-- Members Card -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-white shadow rounded-lg p-5">
            <p class="text-gray-500">সদস্য সংখ্যা</p>
            <h2 class="text-2xl font-bold text-indigo-600">{{ $members ?? 0 }}</h2>
        </div>
    </div>

    <!-- Recent Loan Requests -->
    <div class="bg-white shadow rounded-lg p-6 mb-8">
        <h3 class="text-xl font-semibold mb-4 text-gray-700">Recent Loan Requests</h3>
        <a href="{{ route('loan-requests.index') }}" class="text-blue-600 hover:underline">View all loan requests</a>
    </div>

    <!-- Fund vs Loan Chart -->
    <div class="bg-white shadow rounded-lg p-6">
        <h3 class="text-xl font-semibold mb-4 text-gray-700">Fund vs Loan Chart</h3>
        <canvas id="fundLoanChart" class="w-full h-64"></canvas>
    </div>

</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const ctx = document.getElementById('fundLoanChart').getContext('2d');
const chart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['মোট ফান্ড', 'মোট ঋণ', 'Paid', 'Balance'],
        datasets: [{
            label: 'টাকা',
            data: [
                {{ $totalFund ?? 0 }},
                {{ $totalLoan ?? 0 }},
                {{ $totalPaid ?? 0 }},
                {{ $balance ?? 0 }}
            ],
            backgroundColor: ['#1D4ED8','#DC2626','#16A34A','#F59E0B'],
            borderRadius: 5,
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: { display: false },
            tooltip: {
                callbacks: {
                    label: function(context) {
                        return context.dataset.label + ': ' + context.raw + ' ৳';
                    }
                }
            }
        },
        scales: {
            y: { beginAtZero: true }
        }
    }
});
</script>
@endsection
