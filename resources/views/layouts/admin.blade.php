<html>
<head>
    <title>Admin Centre</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@400;500;700&family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <style>
        body {
            margin: 0;
            padding: 0;
            background: #f4f4f4;
            font-family: 'Poppins', 'Be Vietnam Pro', sans-serif;
        }
        .admin-layout {
            display: flex;
            min-height: 100vh;
        }
        .admin-sidebar {
            width: 260px;
            background: #D9D9D9;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            font-family: 'Poppins', sans-serif;
            padding-left: 32px;
            align-items: flex-start;
            border-right: 2px solid #000;
        }
        .admin-sidebar .logo {
            width: 100%;
            padding: 32px 0 16px 0;
            display: flex;
            justify-content: flex-start;
            align-items: center;
            padding-left: 0;
        }
        .admin-sidebar .logo img {
            width: 120px;
            height: auto;
        }
        .admin-sidebar .admin-title {
            color: #222;
            font-family: 'Poppins', sans-serif;
            font-weight: 700;
            text-align: left;
            font-size: 1.3rem;
            text-shadow: none;
            margin-bottom: 14px;
            letter-spacing: 1px;
            padding-left: 40px;
        }
        .admin-sidebar .nav-links {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            gap: 4px;
            padding-left: 0;
        }
        .admin-sidebar .nav-links a {
            color: #1E1E1E;
            text-decoration: none;
            font-family: 'Poppins', sans-serif;
            font-weight: 400;
            font-size: 1.08rem;
            padding: 6px 22px 6px 22px;
            border-radius: 12px;
            margin-left: 0;
            width: 180px;
            letter-spacing: 1px;
            text-align: left;
            text-shadow: none;
            transition: background 0.2s, color 0.2s;
            display: flex;
            align-items: center;
            gap: 12px;
            position: relative;
            z-index: 1;
            overflow: visible;
        }
        .admin-sidebar .nav-links a.active {
            background: #1E1E1E;
            color: #fff;
            border-radius: 0 14px 14px 0;
            margin-left: 0px;
            padding-left: 32px;
            box-shadow: -3px 0 0 #1E1E1E;
            font-weight: 700;
            z-index: 2;
            position: relative;
        }
        .admin-sidebar .nav-links a:hover {
            background: #bdbdbd;
        }
        .admin-sidebar .logout {
            margin-bottom: 24px;
            text-align: left;
            padding-left: 0;
        }
        .admin-sidebar .logout a {
            color: #E74C3C;
            text-decoration: none;
            font-size: 1.5em; /* Larger icon */
            font-family: 'Poppins', sans-serif;
            font-weight: 500;
            display: flex;
            align-items: center;
            justify-content: flex-start;
            padding-left: 4px;
            transition: color 0.2s;
        }
        .admin-sidebar .logout a:hover {
            color: #c0392b;
        }
        .admin-content {
            flex: 1;
            padding: 40px;
            font-family: 'Poppins', 'Be Vietnam Pro', sans-serif;
        }
    </style>
</head>
<body>
    <div class="admin-layout">
        <aside class="admin-sidebar">
            <div class="logo">
                <img src="{{ asset('images/ulap-logo-transparent.png') }}" alt="ULAP Logo">
            </div>
            <div class="admin-title">Admin Centre</div>
            <nav class="nav-links">
                <a href="{{ route('admin.dashboard') }}" class="{{ Route::is('admin.dashboard') ? 'active' : '' }}"><i class="fa-solid fa-gauge"></i> Dashboard</a>
                <a href="{{ route('admin.orders') }}" class="{{ Route::is('admin.orders') ? 'active' : '' }}"><i class="fa-solid fa-box"></i> Orders</a>
                <a href="{{ route('admin.products.index') }}" class="{{ Route::is('admin.products') ? 'active' : '' }}"><i class="fa-solid fa-tags"></i> Products</a>
                <a href="{{ route('admin.customers') }}" class="{{ Route::is('admin.customers') ? 'active' : '' }}"><i class="fa-solid fa-users"></i> Customers</a>            </nav>
            <div class="logout">
                <a href="{{ route('logout') }}"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                   title="Logout">
                    <i class="fa-solid fa-right-from-bracket"></i>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </aside>
        <main class="admin-content">
            @yield('content')
        </main>
    </div>
</body>
</html>