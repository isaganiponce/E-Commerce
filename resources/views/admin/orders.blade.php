@extends('layouts.admin')

@section('content')
    <style>
        /* Keep your original styles... */
        .dashboard-header {
            display: flex;
            align-items: center;
            justify-content: flex-start;
            margin-bottom: 28px;
        }

        .dashboard-header input[type="text"] {
            width: 60%;
            padding: 10px 18px;
            border-radius: 0px;
            border: 2px solid #000;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.10);
            font-size: 1.08em;
            font-family: 'Poppins', sans-serif;
            margin-right: 10px;
        }

        .dashboard-header button {
            padding: 10px 22px;
            border-radius: 0px;
            border: none;
            background: #1E1E1E;
            color: #fff;
            font-family: 'Poppins', sans-serif;
            font-size: 1.08em;
            font-weight: 600;
            cursor: pointer;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.10);
            transition: background 0.2s;
        }

        .dashboard-header button:hover {
            background: #333;
        }

        .dashboard-header .admin-info {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-left: 400px;
        }

        .dashboard-header .admin-info span {
            font-size: 1.25em;
            color: #222;
            font-family: 'Poppins', sans-serif;
        }

        .dashboard-header .admin-info i {
            font-size: 1.5em;
            color: #222;
        }

        .orders-header-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-top: 70px;
        }

        .orders-title {
            font-family: 'Poppins', sans-serif;
            font-weight: 700;
            font-size: 2.25em;
            color: #111;
            letter-spacing: 0.01em;
        }

        .orders-actions {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .orders-generate-btn,
        .orders-action-btn {
            font-family: 'Poppins', sans-serif;
            font-size: 0.92em;
            font-weight: 600;
            cursor: pointer;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
        }

        .orders-generate-btn {
            background: #fff;
            color: #1E1E1E;
            border: 2px solid #1E1E1E;
            border-radius: 8px;
            padding: 7px 14px;
            transition: all 0.2s;
            margin-right: 24px;
        }

        .orders-generate-btn:hover {
            background: #1E1E1E;
            color: #fff;
        }

        .orders-action-btn {
            background: #1E1E1E;
            color: #fff;
            border: none;
            border-radius: 8px;
            padding: 10px 14px;
            display: flex;
            align-items: center;
            transition: background 0.2s;
        }

        .orders-action-btn:hover {
            background: #333;
        }

        .orders-placeholder {
            width: 100%;
            min-height: 520px;
            background: #fff;
            border-radius: 0px;
            border: 1px solid #000;
            box-shadow: 0 0 0 2px #E0E0E0;
            display: flex;
            justify-content: center;
            padding-top: 20px;
            overflow-x: auto;
        }

        .orders-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .orders-table th,
        .orders-table td {
            border-bottom: 1px solid #ccc;
            padding: 10px;
            text-align: left;
        }

        .orders-table th {
            background-color: #f9f9f9;
            font-weight: 700;
        }

        .orders-table tr:hover {
            background: #f1f1f1;
        }
    </style>

    <div class="dashboard-header">
        <form action="{{ route('admin.orders') }}" method="GET" style="display: flex; width: 100%;">
            <input type="text" name="search" placeholder="Search Orders" value="{{ request('search') }}">
            <button type="submit">Search</button>
        </form>
        <div class="admin-info">
            <span>Admin</span>
            <i class="fa-regular fa-user"></i>
        </div>
    </div>

    <form id="bulk-action-form" method="POST" action="{{ route('admin.orders.bulkAction') }}">
        @csrf
        <input type="hidden" name="action" id="bulk-action-type">

        <div class="orders-header-row">
            <div class="orders-title">Orders</div>
            <div class="orders-actions">
                <a href="{{ route('admin.orders.create') }}" class="orders-action-btn" title="Add"><i
                        class="fa-solid fa-plus"></i></a>
                <button type="button" class="orders-action-btn" title="Edit" onclick="submitBulkAction('edit')"><i
                        class="fa-solid fa-pen"></i></button>
                <button type="button" class="orders-action-btn" title="Delete" onclick="submitBulkAction('delete')"><i
                        class="fa-solid fa-trash"></i></button>
            </div>
        </div>

        <div class="orders-placeholder">
            <table class="orders-table">
                <thead>
                    <tr>
                        <th><input type="checkbox" id="select-all"></th>
                        <th>Order #</th>
                        <th>Customer</th>
                        <th>Total</th>
                        <th>Date</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $order)
                        <tr>
                            <td><input type="checkbox" name="order_ids[]" value="{{ $order->id }}" class="order-checkbox"></td>
                            <td>{{ $order->id }}</td>
                            <td>{{ $order->user->name ?? 'N/A' }}</td>
                            <td>₱{{ number_format($order->total, 2) }}</td>
                            <td>{{ $order->created_at->format('Y-m-d') }}</td>
                            <td>{{ $order->status ?? 'N/A' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" style="text-align:center; padding:16px;">No orders found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </form>

    <script>
        document.getElementById('select-all').addEventListener('click', function () {
            const checkboxes = document.querySelectorAll('.order-checkbox');
            checkboxes.forEach(cb => cb.checked = this.checked);
        });

        function submitBulkAction(actionType) {
            const selected = document.querySelectorAll('.order-checkbox:checked');
            if (selected.length === 0) {
                alert("Please select at least one order.");
                return;
            }

            document.getElementById('bulk-action-type').value = actionType;

            if (actionType === 'delete' && !confirm('Are you sure you want to delete selected orders?')) {
                return;
            }

            document.getElementById('bulk-action-form').submit();
        }
    </script>
@endsection