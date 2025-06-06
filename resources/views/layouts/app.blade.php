<!DOCTYPE html>

<head></head>
<title>ULAP Account Center</title>
<link rel="stylesheet" href="{{ asset('css/app.css') }}">
<script src="{{ asset('js/home.js') }}"></script>
<link href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@400;500;700&family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>

<body>
    <!-- Navbar/Header -->
    <nav class="navbar">
        <img src="{{ asset('images/ulap-logo-transparent.png') }}" alt="ULAP Logo" class="navbar-logo" onclick="location.href='{{ route('user.home') }}'">
        <form action="{{ route('logout') }}" method="POST" style="margin:0;">
            @csrf
            <button type="submit" class="logout-icon-btn" title="Sign Out">
                <i class="fa-solid fa-right-from-bracket"></i>
            </button>
        </form>
    </nav>
    <div class="main-container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="profile-section">
                <img src="https://via.placeholder.com/80" class="profile-photo">
                <div class="profile-info">
                    <div class="profile-name">{{ Auth::user()->name }}</div>
                    <div class="profile-email">{{ Auth::user()->email }}</div>
                </div>
            </div>
            <ul class="sidebar-menu">
                <li>
                    <a href="/account" class="{{ (isset($active) && $active == 'account') ? 'active' : '' }}">
                        My Account
                    </a>
                </li>
                <li>
                    <a href="/myorders" class="{{ (isset($active) && $active == 'orders') ? 'active' : '' }}">
                        Order History
                    </a>
                </li>
                <li>
                    <a href="/terms" class="{{ (isset($active) && $active == 'terms') ? 'active' : '' }}">
                        Terms and Privacy Policy
                    </a>
                </li>
            </ul>
        </aside>
        <!-- Main Content -->
        <main class="content">
            @yield('content')
        </main>
    </div>


    <div class="footer">
        <div id="footer-elements">
            <div class="logo"><img src="{{ asset('images/ulap logoru.png') }}" alt="logo" width="400px" height="200px"></div>
            <div class="about">
                <h3 class="title">About</h3>
                <p class="subs">Who We Are</p>
                <p class="subs">Terms of Service</p>
                <p class="subs">Privacy Policy</p>
            </div>
            <div class="help">
                <h3 class="title">Help</h3>
                <p class="subs">My Account</p>
                <p class="subs">FAQ</p>
                <p class="subs">Exchange Policy</p>
                <p class="subs">Bulk Order</p>
                <p class="subs">Return & Exchange</p>
            </div>
            <div class="socials">
                <h3 class="title">SOCIAL</h3>
                <div id="socials-logo">
                    <i class="fa-brands fa-tiktok"></i>
                    <i class="fa-brands fa-facebook-f"></i>
                    <i class="fa-brands fa-instagram"></i>
                </div>
                <span id="mark">© 2025 ULAP</span>
            </div>
        </div>
    </div>
</body>

</html>