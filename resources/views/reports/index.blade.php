@extends('layouts.app')

@section('content')
<h1 class="text-2xl font-bold mb-6">Reports Dashboard</h1>

<div class="grid md:grid-cols-2 gap-6">
    <div class="bg-white p-6 shadow rounded">
        <h2 class="text-lg font-semibold mb-4">Monthly Fund vs Loan</h2>
        <canvas id="fundLoanChart"></canvas>
    </div>

    <div class="bg-white p-6 shadow rounded">
        <h2 class="text-lg font-semibold mb-4">Installment Collection Trend</h2>
        <canvas id="installmentChart"></canvas>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const fundLoanCtx = document.getElementById('fundLoanChart');
new Chart(fundLoanCtx, {
    type: 'bar',
    data: {
        labels: {!! json_encode($months) !!},
        datasets: [
            {
                label: 'Fund',
                data: {!! json_encode($fundAmounts) !!},
                backgroundColor: '#16A34A',
            },
            {
                label: 'Loan',
                data: {!! json_encode($loanAmounts) !!},
                backgroundColor: '#DC2626',
            }
        ]
    },
});

const installmentCtx = document.getElementById('installmentChart');
new Chart(installmentCtx, {
    type: 'line',
    data: {
        labels: {!! json_encode($months) !!},
        datasets: [{
            label: 'Installment Collected (৳)',
            data: {!! json_encode($installmentAmounts) !!},
            borderColor: '#1D4ED8',
            fill: false,
            tension: 0.3
        }]
    },
});
</script>
@endsection
