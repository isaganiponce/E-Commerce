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

        .products-header-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 0;
            margin-top: 70px;
        }

        .products-title {
            font-family: 'Poppins', sans-serif;
            font-weight: 700;
            font-size: 2.25em;
            color: #111;
            letter-spacing: 0.01em;
        }

        .products-actions {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .products-generate-btn {
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

        .products-generate-btn:hover {
            background: #1E1E1E;
            color: #fff;
            border-color: #1E1E1E;
        }

        .products-action-btn {
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

        .products-action-btn:hover {
            background: #333;
        }

        .products-placeholder {
            width: 100%;
            min-height: 520px;
            height: 520px;
            background: #fff;
            border-radius: 0px;
            box-shadow: 0 0 0 2px #E0E0E0;
            border: 1px solid #000;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #888;
            font-family: 'Poppins', sans-serif;
            font-size: 1.1em;
            margin-top: 0;
        }

        /* Add custom styles for the form and table here */
        .product-form {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
        }

        .product-form input {
            padding: 10px;
            border: 2px solid #000;
            border-radius: 4px;
            font-size: 1em;
            font-family: 'Poppins', sans-serif;
            width: 100%;
        }

        .product-form button {
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            background: #1E1E1E;
            color: #fff;
            font-family: 'Poppins', sans-serif;
            font-size: 1em;
            cursor: pointer;
            transition: background 0.2s;
        }

        .product-form button:hover {
            background: #333;
        }

        .products-table {
            margin-top: 200px;
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .products-table th,
        .products-table td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: left;
        }

        .products-table th {
            background: #f9f9f9;
            font-weight: 600;
        }

        .products-table tr:hover {
            background: #f1f1f1;
        }

        .action-buttons {
            display: flex;
            gap: 10px;
        }

        .action-buttons form {
            display: inline;
        }

        .selected-row {
            background-color: #e6f7ff;
            border: 2px solid #1E90FF;
        }

        tr:has(input.order-checkbox:checked) {
            background-color: #eaf6ff;
        }
    </style>

    <div class="dashboard-header">
        <form action="{{ route('admin.products.index') }}" method="GET" style="display: flex; width: 100%;">
            <input type="text" name="search" placeholder="Search Products" value="{{ request('search') }}">
            <button type="submit">Search</button>
        </form>
        <div class="admin-info">
            <span>Admin</span>
            <i class="fa-regular fa-user"></i>
        </div>
    </div>

    <div class="products-header-row">
        <div class="products-title">Products</div>
    </div>

    <!-- Add Product Form -->
    <form action="{{ route('admin.products.add') }}" method="POST" class="product-form">
        @csrf
        <input type="text" name="name" placeholder="Name" required>
        <input type="number" name="price" placeholder="Price" required>
        <input type="text" name="category" placeholder="Category">
        <button type="submit">Add Product</button>
    </form>

    <div class="products-placeholder" style="overflow-x:auto; display: block;">
        <table class="products-table">
            <thead>
                <tr>
                    <th></th>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Category</th>
                    <th>Created</th>
                </tr>
            </thead>
            <tbody id="products-table-body">
                @forelse($products as $product)
                    <tr data-id="{{ $product->id }}">
                        <form method="POST" action="{{ route('admin.products.edit', $product->id) }}" class="product-form-row">
                            @csrf
                            <td><input type="checkbox" name="order_ids[]" class="order-checkbox"></td>
                            <td>{{ $product->id }}</td>
                            <td><input type="text" name="name" value="{{ $product->name }}" class="editable-input" disabled
                                    required></td>
                            <td><input type="number" name="price" value="{{ $product->price }}" class="editable-input" disabled
                                    required></td>
                            <td><input type="text" name="category" value="{{ $product->category }}" class="editable-input"
                                    disabled></td>
                            <td>{{ $product->created_at->format('Y-m-d') }}</td>
                        </form>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" style="text-align:center; padding:16px;">No products found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div style="margin-top: 16px; display: flex; gap: 10px;">
            <button id="edit-selected"
                style="padding: 10px 20px; background: #333; color: white; border: none; cursor: pointer;">Edit
                Selected</button>
            <button id="delete-selected"
                style="padding: 10px 20px; background: crimson; color: white; border: none; cursor: pointer;">Delete
                Selected</button>
        </div>
    </div>

    <script>
        const editBtn = document.getElementById('edit-selected');
        let isEditMode = false;

        editBtn.addEventListener('click', () => {
            const checkboxes = document.querySelectorAll('.order-checkbox:checked');

            if (checkboxes.length === 0) {
                alert("Please select at least one product.");
                return;
            }

            if (!isEditMode) {
                checkboxes.forEach(checkbox => {
                    const row = checkbox.closest('tr');
                    const inputs = row.querySelectorAll('.editable-input');
                    inputs.forEach(input => input.disabled = false);
                });

                editBtn.textContent = 'Save Changes';
                isEditMode = true;
            } else {
                if (confirm("Submit changes for the selected products?")) {
                    checkboxes.forEach(checkbox => {
                        const form = checkbox.closest('tr').querySelector('form');
                        form.submit();
                    });
                }

                editBtn.textContent = 'Edit Selected';
                isEditMode = false;
            }
        });

        document.getElementById('delete-selected').addEventListener('click', () => {
            const checkboxes = document.querySelectorAll('.order-checkbox:checked');

            if (checkboxes.length === 0) {
                alert("Please select at least one product to delete.");
                return;
            }

            const csrfMeta = document.querySelector('meta[name="csrf-token"]');
            if (!csrfMeta) {
                alert("CSRF token not found. Make sure it's included in your HTML.");
                return;
            }

            const csrfToken = csrfMeta.content;

            if (confirm("Are you sure you want to delete the selected products?")) {
                checkboxes.forEach(checkbox => {
                    const row = checkbox.closest('tr');
                    const productId = row.getAttribute('data-id');

                    const deleteForm = document.createElement('form');
                    deleteForm.method = 'POST';
                    deleteForm.action = `/admin/products/${productId}`;
                    deleteForm.innerHTML = `
                    <input type="hidden" name="_method" value="DELETE">
                    <input type="hidden" name="_token" value="${csrfToken}">
                `;

                    document.body.appendChild(deleteForm);
                    deleteForm.submit();
                });
            }
        });


    </script>
@endsection