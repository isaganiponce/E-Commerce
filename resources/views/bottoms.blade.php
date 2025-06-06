<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="{{ asset('css/top.css') }}">
    <script src="{{ asset('js/top.js') }}"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <title>ULAP - Tops</title>
</head>

<body>

    <div class="navbar">
        <div class="menu" onclick="openNav()"><i class="fa-solid fa-bars"></i></div>
        <div class="logo"><img src="{{ asset('images/ulap-logo-transparent.png') }}" alt="logo" width="100px"
                height="50px" onclick="location.href='{{ route('user.home') }}'"></div>
        <div class="shopping-account-icons">
            <i class="fa fa-cart-shopping" onclick="openCart()"></i>
            @if(Auth::check())
                <a href="{{ route('account') }}"><i class="fa-solid fa-circle-user"></i></a>
            @else
                <a href="{{ route('login') }}"><i class="fa-solid fa-circle-user"></i></a>
            @endif
        </div>
    </div>

    <div id="slide-menu">
        <div id="slide-menu2">
            <div id="search-bar">
                <i class="fa-solid fa-xmark fa-xl" onclick="closeNav()"></i>
                <input type="text" id="search" name="search-bar" size="30" placeholder="SEARCH">
            </div>

            <div id="categories">
                <a href="{{ route('user.tops') }}"><span class="categories">TOPS</span></a>
                <a href="{{ route('user.bottoms') }}"><span class="categories">BOTTOMS</span></a>
                <a href="{{ route('user.bna') }}"><span class="categories">BAGS N ACCESSORIES</span></a>
                <a href="{{ route('user.bottoms') }}"><span class="categories">CARGO PANTS</span></a>
                <a href="{{ route('user.bna') }}"><span class="categories">HATS</span></a>
                <a href="{{ route('user.footwear') }}"><span class="categories">FOOTWEAR</span></a>
            </div>

            <div id="registering">
                <p>REGISTER AND ACTIVATE YOUR ACCOUNT</p>
                <hr width="100%" size="2">
                <a href="{{ route('signup') }}" class="btns" id="register-btn">REGISTER</a>
                <a href="{{ route('login') }}" class="btns" id="login-btn">LOG IN</a>
            </div>

        </div>
    </div>

    {{-- Shopping Cart --}}
    <div id="shopping-cart">
        <div id="shopping-cart-content">
        <div id="title">
            <i class="fa-solid fa-xmark fa-xl" onclick="closeCart()"></i>
            <span>SHOPPING CART</span>
        </div>

        <table id="shopping-cart-table">
            <thead>
            <tr>
                <th>
                <span class="dot" id="head-dot" onclick="selectAllDot()"
                    style="cursor: pointer; height: 10px; width: 10px; border-radius: 50%; display: inline-block; border: black solid 2px; background-color: #D9D9D9;"></span>
                </th>
                <th id="product-text">Product</th>
                <th id="total-price-text">Total Price</th>
            </tr>
            </thead>
            <tbody id="cart-items" style="display: flex; flex-direction: column; gap: 16px;">
            <!-- Cart items will be inserted here -->
            </tbody>
        </table>

        <div style="display: flex; justify-content: flex-end; gap: 12px; margin-top: 16px;">
            <button onclick="deleteSelectedItems()"
            style="background: #ff4d4d; color: #fff; border: none; border-radius: 4px; padding: 10px 24px; font-size: 16px; cursor: pointer;">
            Delete Selected
            </button>

            @if(Auth::check())
        <a href="{{ route('checkoutnpayment') }}">
            <button
            style="background: #222; color: #fff; border: none; border-radius: 4px; padding: 10px 24px; font-size: 16px; cursor: pointer;">
            Go to Payment
            </button>
        </a>
        @else
        <a href="{{ route('login') }}">
            <button
            style="background: #222; color: #fff; border: none; border-radius: 4px; padding: 10px 24px; font-size: 16px; cursor: pointer;">
            Go to Payment
            </button>
        </a>
        @endif
        </div>
        </div>
    </div>
    
    <!-- Category Bar -->
    <div class="category-bar">
        <span>SALE!</span>
        <span>SALE!</span>
        <span>SALE!</span>
        <span>SALE!</span>
        <span>SALE!</span>
        <span>SALE!</span>
    </div>

    <!-- Filter Button Below Category Bar -->
    <div class="filter-container">
        <button class="filter-btn">Filter</button>
    </div>

    <!-- Title -->
    <section class="title">
        <h2>BOTTOMS | Shorts, Track Pants and Cargo Pants</h2>
    </section>

    <!-- Product Grid -->
    <section class="product-grid">
        @foreach($products as $product)
            <div class="product-card" onclick="location.href='{{ route('description', ['id' => $product->id]) }}'">
                <div class="product-image">
                    <img src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->name }}">
                </div>
                <p class="product-name">{{ $product->name }}</p>
                <p class="product-price">₱ {{ number_format($product->price, 2) }}</p>
                <span class="favorite">☆</span>
            </div>
        @endforeach
    </section>

    <!-- Footer -->
    <div class="footer">
        <div id="footer-elements">
            <div class="logo"><img src="{{ asset('images/ulap logoru.png') }}" alt="logo" width="400px" height="200px">
            </div>
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

    <script src="{{ asset('js/cart.js') }}"></script>
    <script>
        // This is for toggling favorite stars
        document.querySelectorAll('.favorite').forEach(star => {
            star.addEventListener('click', () => {
                star.classList.toggle('active');
            });
        });

        // This is for toggling the sidebar menu
        const menuIcon = document.querySelector('.menu img[src$="menu-icon.png"]');
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('overlay');

        if (menuIcon && sidebar && overlay) {
            menuIcon.addEventListener('click', () => {
                sidebar.classList.toggle('open');
                overlay.classList.toggle('show');
            });

            overlay.addEventListener('click', () => {
                sidebar.classList.remove('open');
                overlay.classList.remove('show');
            });
        }
    </script>
</body>

</html>