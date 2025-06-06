@extends('layouts.admin')

@section('content')
    <style>
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

        .customers-header-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 0;
            margin-top: 70px;
        }

        .customers-title {
            font-family: 'Poppins', sans-serif;
            font-weight: 700;
            font-size: 2.25em;
            color: #111;
            letter-spacing: 0.01em;
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

        .customers-placeholder {
            width: 100%;
            min-height: 520px;
            height: 520px;
            background: #fff;
            border-radius: 0px;
            box-shadow: 0 0 0 2px #E0E0E0;
            border: 1px solid #000;
            display: flex;
            align-items: flex-start;
            justify-content: center;
            color: #888;
            font-family: 'Poppins', sans-serif;
            font-size: 1.1em;
            margin-top: 0;
            padding-top: 20px;
        }

        .customers-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .customers-table th,
        .customers-table td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: left;
        }

        .customers-table th {
            background: #f9f9f9;
            font-weight: 600;
        }

        .customers-table tr:hover {
            background: #f1f1f1;
        }

        input[readonly] {
            background-color: #f5f5f5;
            border: 1px solid #ccc;
        }

        .btns button {
            background: #fff;
            color: #1E1E1E;
            border: 2px solid #1E1E1E;
            border-radius: 8px;
            padding: 7px 14px;
            font-family: 'Poppins', sans-serif;
            font-size: 0.82em;
            font-weight: 600;
            cursor: pointer;
            gap: 10px transition: background 0.2s, color 0.2s, border 0.2s;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
        }
    </style>

    <div class="dashboard-header">
        <input type="text" placeholder="Search Customers">
        <button type="submit">Search</button>
        <div class="admin-info">
            <span>Admin</span>
            <i class="fa-regular fa-user"></i>
        </div>
    </div>

    <div class="customers-header-row">
        <div class="customers-title">Customers</div>
        <div class="customers-actions">
            <a href="{{ route('generateCustomer.report') }}" class="customers-generate-btn">Generate Report</a>
        </div>
    </div>

    <div class="customers-placeholder">
        <form action="{{ route('customers.bulkAction') }}" method="POST" style="width: 100%;">
            @csrf
            {{-- Use PATCH or DELETE depending on how you handle it in controller --}}
            <table class="customers-table">
                <thead>
                    <tr>
                        <th><input type="checkbox" id="select-all" /></th>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Registered</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($customers as $customer)
                        <tr>
                            <td>
                                <input type="checkbox" name="delete_ids[]" value="{{ $customer->id }}" class="row-checkbox" />
                            </td>
                            <td>
                                <input type="text" name="customers[{{ $customer->id }}][id]" value="{{ $customer->id }}"
                                    readonly />
                            </td>
                            <td>
                                <input type="text" name="customers[{{ $customer->id }}][name]" value="{{ $customer->name }}"
                                    readonly />
                            </td>
                            <td>
                                <input type="email" name="customers[{{ $customer->id }}][email]" value="{{ $customer->email }}"
                                    readonly />
                            </td>
                            <td>
                                <input type="date" name="customers[{{ $customer->id }}][created_at]"
                                    value="{{ $customer->created_at->format('Y-m-d') }}" readonly />
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" style="text-align:center;">No customers found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            @if($customers->count())
                <div class="btns" style="margin-top: 10px; display: flex; justify-content: flex-end; gap: 10px;">
                    <button type="button" onclick="toggleAllInputs(this)">Edit All</button>
                    <button type="submit" name="action" value="delete"
                        onclick="return confirm('Delete selected customers?')">Delete Selected</button>
                    <button type="submit" name="action" value="update">Save Changes</button>
                </div>
            @endif
        </form>
    </div>


    <script>
        function toggleAllInputs(button) {
            const isEditing = button.dataset.editing === 'true';
            const inputs = document.querySelectorAll('.customers-table input');

            inputs.forEach(input => {
                if (input.type === 'checkbox') return;
                if (input.name.includes('[id]')) return;
                input.readOnly = isEditing;
            });

            button.dataset.editing = (!isEditing).toString();
            button.textContent = isEditing ? 'Edit All' : 'Cancel Edit';
        }

        // Select All checkbox logic
        document.addEventListener('DOMContentLoaded', () => {
            const selectAll = document.getElementById('select-all');
            const checkboxes = document.querySelectorAll('.row-checkbox');

            if (selectAll) {
                selectAll.addEventListener('change', function () {
                    checkboxes.forEach(cb => cb.checked = this.checked);
                });
            }
        });
    </script>
@endsection