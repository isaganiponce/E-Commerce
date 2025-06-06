<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/payment.css') }}">
    <script src="{{ asset('js/home.js') }}" defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <title>U.L.A.P</title>
    <style>
        #payment-success {
            display: none;
        }
    </style>
</head>

<body>

    <div class="navbar">
        <div class="menu" onclick="openNav()"><i class="fa-solid fa-bars"></i></div>
        <div class="logo"><img src="{{ asset('images/ulap-logo-transparent.png') }}" alt="logo" width="100px"
                height="50px"></div>
        <div class="shopping-account-icons">
            <i class="fa fa-cart-shopping" onclick="openCart()"></i>
            @if(Auth::check())
                <a href="{{ route('account') }}"><i class="fa-solid fa-circle-user"></i></a>
            @else
                <a href="{{ route('login') }}"><i class="fa-solid fa-circle-user"></i></a>
            @endif
        </div>
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

    <div id="shopping-cart">
        <div id="shopping-cart-content">
            <div id="title">
                <i class="fa-solid fa-xmark fa-xl" onclick="closeCart()"></i>
                <span>SHOPPING CART</span>
            </div>

            <table id="shopping-cart-table">
                <thead>
                    <tr>
                        <th><span class="dot" id="head-dot" onclick="selectAllDot()"></span></th>
                        <th id="product-text">Product</th>
                        <th id="total-price-text">Total Price</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <hr width="120%" size="2">
                            <span class="dot" id="product-dot" onclick="selectDot()"></span>
                            <img src="{{ asset('images/IMG_9171 1.png') }}" alt="Product Image"
                                style="width: 60px; vertical-align: middle;">
                            <div class="product-info">
                                <h4 class="item-name" style="margin: 0;">ULAP™ Football Jersey Black</h4>
                                <p>Variation: Black, Size: M</p>
                                <div id="price-quantity" style="display: flex; align-items: center; gap: 10px;">
                                    <span id="product-info-price">₱ 999.00</span>
                                    <div id="quantity" style="display: flex; align-items: center; gap: 5px;">
                                        <i class="fa-solid fa-minus" id="decreaseBtn" onclick="decreaseBtn()"></i>
                                        <span id="amount">1</span>
                                        <i class="fa-solid fa-plus" id="increaseBtn" onclick="increaseBtn()"></i>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td id="totall">
                            <p>₱ </p>
                            <span id="price">999.00</span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div id="checkoutpanel">
        <div id="checkoutmain">
            <div id="titlepart">
                <img src="{{ asset('images/ulap-logo-transparent.png') }}" />
                <div class="vl"></div>
                <p>Checkout</p>
            </div>
        </div>
        <div id="addresspart">
            <div id="address">
                <i class="fa-solid fa-location-dot"></i>
                <p>Delivery Address</p>
            </div>

            <div id="information">
                <div id="nameNumber">
                    <p id="name">José Protacio Rizal Mercado y Alonso Realonda</p>
                    <p id="number">09123456789</p>
                </div>

                <div id="addressInfo">
                    <p id="address">Napico, 1234 Atis St. Manggahan, Pasig City, Metro Manila</p>
                    <p id="zipcode">1211</p>
                </div>

                <div id="change">
                    <span>CHANGE</span>
                </div>
            </div>
        </div>
        <div id="product-list">
            <table>
                <thead>
                    <tr>
                        <th>Product Ordered</th>
                        <th>Unit Price</th>
                        <th>Quantity</th>
                        <th>Item Subtotal</th>
                    </tr>
                </thead>
                <tbody id="checkout-cart-items">
                    <!-- Cart items will be injected here -->
                </tbody>
            </table>
            <div id="e-invoice">
                <p id="invoiceBtn">E-Invoice<i class="fa-regular fa-circle-question"></i></p>
                <p id="requestBtn">Request Now</p>
                <p id="shippingText">Shipping Fee</p>
                <span id="shipping">₱ 99.00</span>
            </div>

            <div id="total">
                <p id="totalText">Order Total</p>
                <span id="totalPrice">₱ 999.00</span>
            </div>
        </div>

        <form id="orderForm" method="POST" action="{{ route('order.store') }}">
            @csrf

            <div id="payment-method">
                <div id="payment">
                    <p>Payment Method</p>
                    <div id="payment-methods">
                        <select id="mod" name="payment_method" disabled>
                            <option value="Gcash">Gcash</option>
                            <option value="Cash on Delivery">Cash on Delivery</option>
                            <option value="Credit Card" selected>Credit Card</option>
                        </select>
                        <span id="changeBtn" onclick="changepayment()">CHANGE</span>
                    </div>
                </div>

                <div id="additional">
                    <table style="width:100%;">
                        <tr>
                            <td>Merchandise Total</td>
                            <td style="text-align:right;" id="merchandisePrice">₱ 999.00</td>
                        </tr>
                        <tr>
                            <td>Shipping Fee</td>
                            <td style="text-align:right;" id="shippingPrice">₱ 50.00</td>
                        </tr>
                        <tr>
                            <td><strong>Total Payment</strong></td>
                            <td style="text-align:right;" id="totalPrice"><strong>₱ 1049.00</strong></td>
                        </tr>
                        <tr>
                            <td colspan="2" style="text-align:right;" id="payBtn">
                                <button type="button" id="pay" onclick="handlePayment()">Pay Now</button>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>

            <form id="orderForm" method="POST" action="{{ route('order.store') }}">
                @csrf
                <input type="hidden" name="merchandise_total" id="merchandise_input">
                <input type="hidden" name="shipping_fee" id="shipping_input">
                <input type="hidden" name="total_payment" id="total_input">
                <input type="hidden" name="cart_data" id="cartDataInput">
                <input type="hidden" name="payment_method" id="mod">
            </form>

        </form>
    </div>

    <div id="payment-choice">
        <table>
            <tr>
                <td colspan="2" id="card-details-text" style="font-size: 26px; font-weight: 600; padding-bottom: 10px;">
                    Card Details</td>
            </tr>
            <tr>
                <td colspan="2"><label for="card-name-input">Card Holder's Name</label></td>
            </tr>
            <tr>
                <td colspan="2"><input type="text" id="card-name-input" placeholder="Enter Card Holder's Name"></td>
            </tr>
            <tr>
                <td colspan="2"><label for="card-number-input">Card Number</label></td>
            </tr>
            <tr>
                <td colspan="2"><input type="text" id="card-number-input" placeholder="Enter Card Number"></td>
            </tr>
            <tr>
                <td><label for="expiry-date-input">Expiry Date</label></td>
                <td><label for="cvv-input">CVV</label></td>
            </tr>
            <tr>
                <td><input type="text" id="expiry-date-input" placeholder="MM/YYYY"
                        style="width: 80px; margin-right: 10px;"></td>
                <td><input type="text" id="cvv-input" placeholder="CVV" style="width: 60px;"></td>
            </tr>
            <form id="payment-form" action="{{ route('checkout.save') }}" method="POST"
                onsubmit="return sendCartToBackend();">
                @csrf
                <input type="hidden" name="cart_data" id="cart_data">
                <table>
                    ...
                    <tr>
                        <td colspan="2" style="text-align: center;">
                            <button type="submit" onclick="closepayment()">Submit Payment</button>
                        </td>
                    </tr>
                </table>
            </form>
        </table>
    </div>

    <div id="payment-success">
        <div id="payment-success-content">
            <p id="successtext"><i class="fa-solid fa-circle-check"></i>Payment Successful</p>
            <p>Your order has been placed successfully.</p>
            <button onclick="closeSuccess()">Continue Shopping</button>
        </div>
    </div>

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
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const cart = JSON.parse(localStorage.getItem('cart') || '[]');
            const tableBody = document.getElementById('checkout-cart-items');
            const merchandiseTotalElement = document.getElementById('merchandisePrice');
            const shippingFeeElement = document.getElementById('shippingPrice');
            const totalPriceElement = document.querySelectorAll('#totalPrice');
            const shippingFee = 50; // or 99, depending on your logic
            let merchandiseTotal = 0;

            if (tableBody && cart.length > 0) {
                tableBody.innerHTML = ''; // clear any existing content

                cart.forEach(item => {
                    const itemSubtotal = parseFloat(item.price) * item.quantity;
                    merchandiseTotal += itemSubtotal;

                    const row = document.createElement('tr');
                    row.innerHTML = `
                <td>
                    <div class="products" style="cursor:pointer;display:flex;margin-top:15px;" onclick="location.href='/product/${item.id}'">
                        <img src="${item.image}" alt="${item.name}" style="width: 100px;">
                        <div class="product-info" style="display: flex; flex-direction: column; margin-left: 10px; line-height: 0;">
                            <p style="font-weight:800;">${item.name}</p>
                            <p>Size: ${item.size}</p>
                        </div>
                    </div>
                </td>
                <td style="text-align: center;">₱${parseFloat(item.price).toFixed(2)}</td>
                <td style="text-align: center;">${item.quantity}</td>
                <td style="text-align: center;">₱${itemSubtotal.toFixed(2)}</td>
            `;
                    tableBody.appendChild(row);
                });

                // Update the price displays
                const formattedMerchandiseTotal = `₱ ${merchandiseTotal.toFixed(2)}`;
                const formattedTotal = `₱ ${(merchandiseTotal + shippingFee).toFixed(2)}`;

                if (merchandiseTotalElement) merchandiseTotalElement.innerText = formattedMerchandiseTotal;
                if (shippingFeeElement) shippingFeeElement.innerText = `₱ ${shippingFee.toFixed(2)}`;
                totalPriceElement.forEach(el => el.innerText = formattedTotal); // handles both summary totalPrice & final payment total

                // Also update the hidden input fields for the form
                document.getElementById('merchandise_input').value = merchandiseTotal.toFixed(2);
                document.getElementById('shipping_input').value = shippingFee.toFixed(2);
                document.getElementById('total_input').value = (merchandiseTotal + shippingFee).toFixed(2);
                document.getElementById('cartDataInput').value = JSON.stringify(cart);
            }
        });
    </script>

    <script src="{{ asset('js/cart.js') }}"></script>
    <script src="{{ asset('js/home.js') }}"></script>
</body>

</html>