@extends('layouts.admin')

@section('content')
    {{-- DASHBOARD & FINANCE STYLES --}}
    <style>
        /* Dashboard Header */
        .dashboard-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 28px;
        }

        .dashboard-header form {
            flex: 1;
            display: flex;
        }

        .dashboard-header input[type="text"] {
            width: 60%;
            padding: 10px 18px;
            margin-right: 10px;
            border-radius: 0;
            font-size: 1.08em;
            font-family: 'Poppins', sans-serif;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .dashboard-header button {
            padding: 10px 22px;
            border-radius: 0;
            background: #1E1E1E;
            color: #fff;
            font-weight: 600;
            font-family: 'Poppins', sans-serif;
            border: none;
            cursor: pointer;
            transition: background 0.2s;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .dashboard-header button:hover {
            background: #333;
        }

        .admin-info {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-left: 20px;
        }

        .admin-info span,
        .admin-info i {
            color: #222;
            font-family: 'Poppins', sans-serif;
        }

        /* Cards - Dashboard */
        .dashboard-top-row,
        .dashboard-bottom-row,
        .finance-cards-row,
        .finance-bottom-row {
            display: flex;
            gap: 18px;
            width: 100%;
            margin-bottom: 18px;
        }

        .dashboard-top-row {
            margin-top: 70px;
        }

        .dashboard-card,
        .finance-card,
        .dashboard-big-card,
        .dashboard-tall-card,
        .finance-chart-card,
        .finance-table-card {
            background: #fff;
            border-radius: 14px;
            border: 1px solid #000;
            box-shadow: 0 0 0 2px #E0E0E0;
        }

        .dashboard-card,
        .finance-card {
            flex: 1;
            padding: 14px 16px;
            text-align: center;
        }

        .dashboard-card .card-label,
        .finance-card-label {
            font-weight: 700;
            font-size: 1em;
            color: #111;
            font-family: 'Poppins', sans-serif;
        }

        .dashboard-card .card-value,
        .finance-card-value {
            font-size: 1.15em;
            font-weight: 600;
            color: #1E1E1E;
            font-family: 'Poppins', sans-serif;
        }

        .dashboard-big-card {
            flex: 3;
            padding: 18px 20px;
            min-height: 240px;
            height: 385px;
        }

        .dashboard-big-card .big-card-title,
        .dashboard-big-card .big-card-desc {
            font-family: 'Poppins', sans-serif;
            color: #111;
        }

        .big-card-desc {
            font-style: italic;
            font-size: 0.98em;
            color: #666;
        }

        .dashboard-tall-card {
            flex: 1;
            padding: 18px 20px;
            height: 385px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .tall-card-title {
            font-weight: 700;
            font-size: 1.08em;
            margin-bottom: 8px;
            text-align: center;
        }

        /* Finance */
        .finance-header-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 70px;
        }

        .finance-title {
            font-size: 2.25em;
            font-weight: 700;
            font-family: 'Poppins', sans-serif;
        }

        .finance-actions {
            display: flex;
            gap: 12px;
        }

        .finance-generate-btn {
            background: #fff;
            color: #1E1E1E;
            border: 2px solid #1E1E1E;
            border-radius: 8px;
            padding: 7px 14px;
            font-weight: 600;
            font-family: 'Poppins', sans-serif;
            cursor: pointer;
            transition: all 0.2s;
        }

        .finance-generate-btn:hover {
            background: #1E1E1E;
            color: #fff;
        }

        .finance-chart-card,
        .finance-table-card {
            padding: 24px 20px;
            min-height: 260px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            font-size: 1.1em;
            font-family: 'Poppins', sans-serif;
        }

        .finance-chart-card {
            flex: 1.2;
        }

        .finance-table-card {
            flex: 1.8;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 8px;
            text-align: left;
        }

        th {
            font-weight: 600;
        }
        .customers-actions {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .customers-generate-btn {
            background: #fff;
            color: #1E1E1E;
            border: 2px solid #1E1E1E;
            border-radius: 8px;
            padding: 7px 14px;
            font-family: 'Poppins', sans-serif;
            font-size: 0.92em;
            font-weight: 600;
            cursor: pointer;
            margin-right: 24px;
            transition: background 0.2s, color 0.2s, border 0.2s;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
        }

        .customers-generate-btn:hover {
            background: #1E1E1E;
            color: #fff;
            border-color: #1E1E1E;
        }

        .customers-action-btn {
            background: #1E1E1E;
            color: #fff;
            border: none;
            border-radius: 8px;
            padding: 7px 10px;
            font-size: 0.92em;
            cursor: pointer;
            display: flex;
            align-items: center;
            transition: background 0.2s;
        }

        .customers-action-btn:hover {
            background: #333;
        }

    </style>

    {{-- DASHBOARD HEADER --}}
    <div class="dashboard-header">
        <form action="{{ route('admin.dashboard') }}" method="GET">
            <input type="text" name="search" placeholder="Search" value="{{ request('search') }}">
            <button type="submit">Search</button>
        </form>
        <div class="admin-info">
            <span>Admin</span>
            <i class="fa-regular fa-user"></i>
        </div>
    </div>

    {{-- TOP METRICS --}}
    <div class="dashboard-top-row">
        <div class="dashboard-card">
            <div class="card-label">Total Revenue</div>
            <div class="card-value">₱ {{ number_format($totalRevenue, 2) }}</div>
        </div>
        <div class="dashboard-card">
            <div class="card-label">Total Products Sold</div>
            <div class="card-value">{{ $totalProductsSold }}</div>
        </div>
        <div class="dashboard-card">
            <div class="card-label">Total No. of Customers</div>
            <div class="card-value">{{ $totalCustomers }}</div>
        </div>
        <div class="dashboard-card">
            <div class="card-label">Return/Refund</div>
            <div class="card-value">{{ $totalReturns }}</div>
        </div>
    </div>

    {{-- ORDER HISTORY + TOP PRODUCTS --}}
    <div class="dashboard-bottom-row">
        <div class="dashboard-big-card">
            <div class="big-card-title">Order History</div>
            <div class="big-card-desc">*All product that has been sold</div>
            <ul>
                @foreach($orderHistory as $order)
                    <li>Order #{{ $order->id }} - ₱{{ number_format($order->total, 2) }} - {{ $order->created_at->format('Y-m-d') }}</li>
                @endforeach
            </ul>
        </div>
        <div class="dashboard-tall-card">
            <div class="tall-card-title">Top Products</div>
            <ul>
                @foreach($topProducts as $item)
                    <li>{{ \App\Models\Product::find($item->product_id)->name ?? 'Unknown' }} ({{ $item->sold }} sold)</li>
                @endforeach
            </ul>
        </div>
    </div>

    {{-- FINANCE SECTION --}}
    <div class="finance-header-row">
        <div class="finance-title">Finance</div>
        <div class="finance-actions">
            <a href="{{ route('generateFinance.report') }}" class="customers-generate-btn">Generate Report</a>
        </div>
    </div>

    <div class="finance-cards-row">
        <div class="finance-card">
            <div class="finance-card-label">Total Revenue</div>
            <div class="finance-card-value">₱{{ number_format($totalRevenue ?? 0, 2) }}</div>
        </div>
        <div class="finance-card">
            <div class="finance-card-label">Total Expenses</div>
            <div class="finance-card-value">₱{{ number_format($totalExpenses ?? 0, 2) }}</div>
        </div>
        <div class="finance-card">
            <div class="finance-card-label">Net Profit</div>
            <div class="finance-card-value">₱{{ number_format(($totalRevenue ?? 0) - ($totalExpenses ?? 0), 2) }}</div>
        </div>
        <div class="finance-card">
            <div class="finance-card-label">Outstanding Payments</div>
            <div class="finance-card-value">₱{{ number_format($outstandingPayments ?? 0, 2) }}</div>
        </div>
    </div>

    <div class="finance-bottom-row">
        <div class="finance-chart-card">
            <canvas id="financeLineChart" width="400" height="200"></canvas>
        </div>
        <div class="finance-table-card">
            <table>
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Type</th>
                        <th>Amount</th>
                        <th>Description</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($transactions ?? [] as $transaction)
                        <tr>
                            <td>{{ $transaction->date }}</td>
                            <td>{{ $transaction->type }}</td>
                            <td>₱{{ number_format($transaction->amount, 2) }}</td>
                            <td>{{ $transaction->description }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" style="text-align:center;">No transactions found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection

{{-- CHART SCRIPT --}}
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('financeLineChart').getContext('2d');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: @json($dates ?? []),
            datasets: [{
                label: 'Revenue',
                data: @json($amounts ?? []),
                borderColor: 'rgba(54, 162, 235, 1)',
                backgroundColor: 'rgba(54, 162, 235, 0.1)',
                fill: true,
                tension: 0.3,
                pointRadius: 4,
                pointBackgroundColor: 'rgba(54, 162, 235, 1)'
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: true }
            },
            scales: {
                y: { beginAtZero: true }
            }
        }
    });
</script>
@endpush
