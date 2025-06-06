<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>ULAP Product Page</title>

  <!-- Stylesheets -->
  <link rel="stylesheet" href="{{ asset('css/description.css') }}">
  <script src="{{ asset('js/cart.js') }}"></script>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

  <!-- Scripts -->
  <script src="{{ asset('js/product_desc.js') }}" defer></script>
</head>

<body>
  {{-- Navbar --}}
  <div class="navbar">
    <div class="menu" onclick="openNav()"><i class="fa-solid fa-bars"></i></div>
    <div class="logo"><img src="{{ asset('images/ulap-logo-transparent.png') }}" alt="logo" width="100" height="50"
        onclick="location.href='{{ route('user.home') }}'"></div>
    <div class="shopping-account-icons">
      <i class="fa fa-cart-shopping" onclick="openCart()"></i>
      @if(Auth::check())
      <a href="{{ route('account') }}"><i class="fa-solid fa-circle-user"></i></a>
    @else
      <a href="{{ route('login') }}"><i class="fa-solid fa-circle-user"></i></a>
    @endif

    </div>
  </div>

  {{-- Slide Menu --}}
  <div id="slide-menu">
    <div id="slide-menu2">
      <div id="search-bar">
        <i class="fa-solid fa-xmark fa-xl" onclick="closeNav()"></i>
        <input type="text" id="search" placeholder="SEARCH">
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
        <hr>
        <a href="{{ route('signup') }}" class="btns">REGISTER</a>
        <a href="{{ route('login') }}" class="btns">LOG IN</a>
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

  {{-- Product Details --}}
  <div class="product-section">
    <div class="left-col">
      <img src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->name }}">
    </div>
    <div class="right-col">
      <div class="product-name">{{ $product->name }}</div>
      <div class="product-price">₱ {{ number_format($product->price, 2) }}</div>
      <form action="{{ route('checkoutnpayment') }}" method="GET" id="buy-now-form">
        <div class="size-buttons">
          @foreach($product->sizes as $size)
        <button type="button" class="size-btn" data-size="{{ $size->size }}">{{ strtoupper($size->size) }}</button>
      @endforeach
          <input type="hidden" name="size" id="selected-size" required>
        </div>
        <div class="quantity-selector">
          <span>QUANTITY</span>
          <button type="button" class="decreaseBtn">-</button>
          <span class="amount" id="quantity-amount">1</span>
          <button type="button" class="increaseBtn">+</button>
          <input type="hidden" name="quantity" id="quantity-input" value="1">
        </div>
        <input type="hidden" name="product_id" value="{{ $product->id }}">
        <div class="preview-img"><img src="{{ asset('images/image 6.png') }}"></div>
        <button type="button" class="add-to-cart-btn" data-id="{{ $product->id }}" data-name="{{ $product->name }}"
          data-price="{{ $product->price }}" data-image="{{ asset('storage/' . $product->image_path) }}">
          Add to Cart
        </button>
        <button type="submit" class="buy-button">BUY NOW</button>
      </form>

      <div class="additional-info">
        <p>ADDITIONAL INFORMATION</p>
        <ul>
          <li>Standard sizing - Unisex</li>
          <li>80% cotton / 20% Polyester</li>
          <li>Good quality print made in PH</li>
          <li>180GSM cotton with moisture fabric</li>
          <li>100% quality print version ULAPs</li>
          <li>180GSM cotton</li>
          <li>220GSM fabric</li>
        </ul>
      </div>
    </div>
  </div>

  {{-- Footer --}}
  <div class="footer">
    <div id="footer-elements">
      <div class="logo"><img src="{{ asset('images/ulap logoru.png') }}" alt="logo" width="400" height="200"></div>
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