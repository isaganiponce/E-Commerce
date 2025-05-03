<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <title>U.L.A.P</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

        body {
            margin: 0;
            padding: 0;
            background-color: #EEEEEE;
            overflow-x: hidden;
        }
        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            width: 95%;
            z-index: 1000;
            display: flex;
            align-items: center;
            justify-content: space-between;
            background-color: #D9D9D9;
            color: black;
            border: solid black;
            border-width: 0 0 1px 0;
            padding: 10px 50px 10px 50px;
            box-shadow: 0 10px 5px rgba(0, 0, 0, 0.3);
        }
        .shopping-account-icons .fa.fa-cart-shopping {
            padding-right: 7px;
        }
        .menu .fa-solid.fa-bars{
            transition: transform 0.3s ease;
        }
        .shopping-account-icons .fa.fa-cart-shopping, .fa-solid.fa-circle-user{
            transition: transform 0.3s ease;
        }
        .menu .fa-solid.fa-bars:hover{
            transform: scale(1.1);
        }
        .shopping-account-icons .fa.fa-cart-shopping:hover, .fa-solid.fa-circle-user:hover{
            transform: scale(1.1);
        }
        .menu, .logo, .shopping-account-icons:hover{
            cursor: pointer;
        }

        .product-panels-1{
            padding: 0 250px 0 250px;
        }
        .product-panels-1 #quick-release {
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
            padding: 50px 0 0 0;
        }
        .product-panels-1 #tops{
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
        }
        .product-panels-1 .product-display-new{
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .product-panels-1 .product-display-new .products{
            justify-content: center;
            cursor: pointer;
            transition: transform 0.3s ease;
        }
        .product-panels-1 .product-display-new .products:hover{
            transform: scale(1.1);
        }
        .product-panels-1 .product-display-new .products .product-information .item-name, .product-display-tops .products .product-information .item-name{ 
            align-items: start;
            margin: 0;
            padding: 10px 0 0 0;
            font-family: 'Inter', sans-serif;
            font-weight: 700;
            font-style: normal;
        }
        .product-panels-1 .product-display-new .products .product-information .price, .product-display-tops .products .product-information .price{
            align-items: start;
            margin: 0;
            padding: 0;
            font-family: 'Inter', sans-serif;
            font-weight: 400;
            font-style: normal;
        }
        .product-panels-1 #tops{
            margin-top: 70px;
        }
        .product-panels-1 .product-display-tops{
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            grid-template-rows: repeat(2, auto); 
            row-gap: 30px;
        }
        .product-panels-1 .product-display-tops .products{
            justify-content: center;
            cursor: pointer;
            transition: transform 0.3s ease;
        }
        .product-panels-1 .product-display-tops .products:hover{
            transform: scale(1.1);
        }
        .product-panels-1 .view-all{
            margin: 30px 0 0 0;
            display: flex;
            justify-content: center;
        }
        .product-panels-1 .view-all .btn-view-all{
            padding: 10px 30px;
            background-color: #222831;
            color: #FFFFFF;
            border: none;
            text-align: center;
            text-decoration: none;
            font-family: 'Poppins', sans-serif;
            font-weight: 400;
            font-size: 14px;
            border-radius: 7px;
            transition: transform 0.3s ease;
        }
        .product-panels-1 .view-all .btn-view-all:hover{
            cursor: pointer;
            transform: scale(1.1);
        }
        .promotional-pic2{
            margin-top: 70px;
        }
        .product-panels-2{
            padding: 0 250px 0 250px;
        }
        .product-panels-2 #bottoms{
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
            padding: 50px 0 0 0;
        }
        .product-panels-2 #bna{
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
        }
        .product-panels-2 .product-display-bottoms, .product-display-bna{
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .product-panels-2 .product-display-bottoms .products .product-information .item-name, .product-display-bna .products .product-information .item-name{ 
            align-items: start;
            margin: 0;
            padding: 10px 0 0 0;
            font-family: 'Inter', sans-serif;
            font-weight: 700;
            font-style: normal;
        }
        .product-panels-2 .product-display-bottoms .products .product-information .price, .product-display-bna .products .product-information .price{
            align-items: start;
            margin: 0;
            padding: 0;
            font-family: 'Inter', sans-serif;
            font-weight: 400;
            font-style: normal;
        }
        .product-panels-2 #bna{
            margin-top: 70px;
        }
        .product-panels-2 .product-display-bottoms .products, .product-display-bna .products{
            justify-content: center;
            cursor: pointer;
            transition: transform 0.3s ease;
        }
        .product-panels-2 .product-display-bottoms .products:hover, .product-display-bna .products:hover{
            transform: scale(1.1);
        }
        .footer{
            margin-top: 0;
            color: #FFFFFF;
            background-color: #393E46;
            padding-top: 40px;
            padding-bottom: 40px;
        }
        .footer #footer-elements{
            display: flex;
            justify-content: center;
            gap: 150px;
        }
        .footer #footer-elements .title{
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
        }
        .footer #footer-elements .socials .title{
            text-align: center;
        }
        .footer #footer-elements .subs{
            font-family: 'Poppins', sans-serif;
            font-weight: 400;
            margin:0;
            cursor: pointer;
        }
        #socials-logo {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-top: 10px;
            cursor: pointer;
        }
        #socials-logo i {
            font-size: 16px;
            color: white;
            cursor: pointer;
        }
        #mark {
            display: block;
            margin-top: 90px;
            text-align: center;
            font-family: 'Poppins', sans-serif;
            font-weight: 400;
            font-size: 14px;
            color: #ccc;
        }
        #slide-menu{
            display: grid;
            padding: 30px;
        }
        #slide-menu #search-bar{
            
        }
    </style>
</head>
<body>

<div class="navbar">
    <div class="menu"><i class="fa-solid fa-bars"></i></div>
    <div class="logo"><img src="{{ asset('images/ulap-logo-transparent.png') }}" alt="logo" width="100px" height="50px"></div>
    <div class="shopping-account-icons"><i class="fa fa-cart-shopping"></i><i class="fa-solid fa-circle-user"></i></div>
    </div>
</div>

<div class="promotional-pic"><img src="{{ asset('images/promotional pic.png') }}" alt="promotional-pic"></div>

<div id="slide-menu">
    <div id="search-bar">
        <i class="fa-solid fa-xmark"></i>
        <input type="text" id="search" name="search-bar">
    </div>

    <div id="categories">
        <span class="categories">TOPS</span>
        <span class="categories">BOTTOMS</span>
        <span class="categories">HATS, BAGS N ACCESSORIES</span>
        <span class="categories">CARGO PANTS</span>
        <span class="categories">FOOTWEAR</span>
    </div>
    
    <div id="registering">
        <p>REGISTER AND ACTIVATE YOUR ACCOUNT</p>
        <button id="register-btn">REGISTER</button>
        <button id="login-btn">LOG IN</button>
    </div>

    <div id="socials-logo-slide">
        <i class="fa-brands fa-tiktok"></i>
        <i class="fa-brands fa-facebook-f"></i>
        <i class="fa-brands fa-instagram"></i>
    </div>
</div>

<div class="product-panels-1">
    <h2 id="quick-release">QUICK RELEASES</h2>
    <div class="product-display-new">
        <div class="products">
            <img src="{{ asset('images/IMG_9171 1.png') }}">
            <div class="product-information">
                <h4 class="item-name">ULAP™ Football Jersey Black</h4>
                <h4 class="price">₱ 999.00</h4>
            </div>
        </div>
        <div class="products">
            <img src="{{ asset('images/IMG_9193 1.png') }}">
            <div class="product-information">
                <h4 class="item-name">ULAP™ “Blue n Black”</h4>
                <h4 class="price">₱ 999.00</h4>
            </div>
        </div>
        <div class="products">
            <img src="{{ asset('images/IMG_9112 1.png') }}">
            <div class="product-information">
                <h4 class="item-name">ULAP™ CLOGS (Tan and Gray)</h4>
                <h4 class="price">₱ 999.00</h4>
            </div>
        </div>
        <div class="products">
            <img src="{{ asset('images/IMG_9136 1.png') }}">
            <div class="product-information">
                <h4 class="item-name">ULAP™ “Body Bag”</h4>
                <h4 class="price">₱ 999.00</h4>
            </div>
        </div>
        <div class="products">
            <img src="{{ asset('images/IMG_9147 1.png') }}">
            <div class="product-information">
                <h4 class="item-name">ULAP™ 420 CAP (Black)</h4>
                <h4 class="price">₱ 999.00</h4>
            </div>
        </div>
    </div>
    <h2 id="tops">TOPS</h2>
    <div class="product-display-tops">
        <div class="products">
            <img src="{{ asset('images/SCRIPT 1.png') }}">
            <div class="product-information">
                <h4 class="item-name">U.LA.P™ SCRIPT</h4>
                <h4 class="price">₱ 728.00</h4>
            </div>
        </div>
        <div class="products">
            <img src="{{ asset('images/Four_twenty_moss_green 1.png') }}">
            <div class="product-information">
                <h4 class="item-name">FOUR:TWENTY”</h4>
                <h4 class="price">₱ 649.00</h4>
            </div>
        </div>
        <div class="products">
            <img src="{{ asset('images/Plantfortomorrow 1.png') }}">
            <div class="product-information">
                <h4 class="item-name">PLANT FOR TOMORROW</h4>
                <h4 class="price">₱ 728.00</h4>
            </div>
        </div>
        <div class="products">
            <img src="{{ asset('images/MDFour 1.png') }}">
            <div class="product-information">
                <h4 class="item-name">ULAP - MAC & DEVIN FOUR</h4>
                <h4 class="price">₱ 737.00</h4>
            </div>
        </div>
        <div class="products">
            <img src="{{ asset('images/Pineapple 1.png') }}">
            <div class="product-information">
                <h4 class="item-name">PINEAPPLE EXPRESS</h4>
                <h4 class="price">₱ 699.00</h4>
            </div>
        </div>
        <div class="products">
            <img src="{{ asset('images/Different 1.png') }}">
            <div class="product-information">
                <h4 class="item-name">FLORA BY ULAP</h4>
                <h4 class="price">₱ 728.00</h4>
            </div>
        </div>
        <div class="products">
            <img src="{{ asset('images/Bennie 1.png') }}">
            <div class="product-information">
                <h4 class="item-name">ULAP EYE BEANIE</h4>
                <h4 class="price">₱ 737.00</h4>
            </div>
        </div>
        <div class="products">
            <img src="{{ asset('images/mocks 1.png') }}">
            <div class="product-information">
                <h4 class="item-name">SNITCHES ULAP</h4>
                <h4 class="price">₱ 738.00</h4>
            </div>
        </div>
        <div class="products">
            <img src="{{ asset('images/REVERSESTITCHBLACK 1.png') }}">
            <div class="product-information">
                <h4 class="item-name">U.L.A.P™ BANDANA</h4>
                <h4 class="price">₱ 721.00</h4>
            </div>
        </div>
        <div class="products">
            <img src="{{ asset('images/KIDULAP_c8f63ad7-948f-4d5e-a103-d6bc79af0f13 1.png') }}">
            <div class="product-information">
                <h4 class="item-name">TEACH EM' YOUNG</h4>
                <h4 class="price">₱ 728.00</h4>
            </div>
        </div>
    </div>
    <form action="{{ url('/tops') }}" method="GET" class="view-all">
        <button type="submit" class="btn-view-all">VIEW ALL</button>
    </form>
</div>

<div class="promotional-pic2"><img src="{{ asset('images/491998481_1094273132740384_2703676786075208661_n 1.png') }}" alt="promotional-pic"></div>

<div class="product-panels-2">
    <h2 id="bottoms">BOTTOMS</h2>
    <div class="product-display-bottoms">
        <div class="products">
            <img src="{{ asset('images/IMG_9171 1.png') }}">
            <div class="product-information">
                <h4 class="item-name">ULAP™ Football Jersey Black</h4>
                <h4 class="price">₱ 999.00</h4>
            </div>
        </div>
        <div class="products">
            <img src="{{ asset('images/IMG_9193 1.png') }}">
            <div class="product-information">
                <h4 class="item-name">ULAP™ “Blue n Black”</h4>
                <h4 class="price">₱ 999.00</h4>
            </div>
        </div>
        <div class="products">
            <img src="{{ asset('images/IMG_9112 1.png') }}">
            <div class="product-information">
                <h4 class="item-name">ULAP™ CLOGS (Tan and Gray)</h4>
                <h4 class="price">₱ 999.00</h4>
            </div>
        </div>
        <div class="products">
            <img src="{{ asset('images/IMG_9136 1.png') }}">
            <div class="product-information">
                <h4 class="item-name">ULAP™ “Body Bag”</h4>
                <h4 class="price">₱ 999.00</h4>
            </div>
        </div>
        <div class="products">
            <img src="{{ asset('images/IMG_9147 1.png') }}">
            <div class="product-information">
                <h4 class="item-name">ULAP™ 420 CAP (Black)</h4>
                <h4 class="price">₱ 999.00</h4>
            </div>
        </div>
    </div>
    <h2 id="bna">BAGS, HATS, & ACCESSORIES</h2>
    <div class="product-display-bna">
        <div class="products">
            <img src="{{ asset('images/IMG_9171 1.png') }}">
            <div class="product-information">
                <h4 class="item-name">ULAP™ Football Jersey Black</h4>
                <h4 class="price">₱ 999.00</h4>
            </div>
        </div>
        <div class="products">
            <img src="{{ asset('images/IMG_9193 1.png') }}">
            <div class="product-information">
                <h4 class="item-name">ULAP™ “Blue n Black”</h4>
                <h4 class="price">₱ 999.00</h4>
            </div>
        </div>
        <div class="products">
            <img src="{{ asset('images/IMG_9112 1.png') }}">
            <div class="product-information">
                <h4 class="item-name">ULAP™ CLOGS (Tan and Gray)</h4>
                <h4 class="price">₱ 999.00</h4>
            </div>
        </div>
        <div class="products">
            <img src="{{ asset('images/IMG_9136 1.png') }}">
            <div class="product-information">
                <h4 class="item-name">ULAP™ “Body Bag”</h4>
                <h4 class="price">₱ 999.00</h4>
            </div>
        </div>
        <div class="products">
            <img src="{{ asset('images/IMG_9147 1.png') }}">
            <div class="product-information">
                <h4 class="item-name">ULAP™ 420 CAP (Black)</h4>
                <h4 class="price">₱ 999.00</h4>
            </div>
        </div>
    </div>
    <h2 id="bna">FOOTWEAR, HOODIES & SWEATERS</h2>
    <div class="product-display-bna">
        <div class="products">
            <img src="{{ asset('images/IMG_9171 1.png') }}">
            <div class="product-information">
                <h4 class="item-name">ULAP™ Football Jersey Black</h4>
                <h4 class="price">₱ 999.00</h4>
            </div>
        </div>
        <div class="products">
            <img src="{{ asset('images/IMG_9193 1.png') }}">
            <div class="product-information">
                <h4 class="item-name">ULAP™ “Blue n Black”</h4>
                <h4 class="price">₱ 999.00</h4>
            </div>
        </div>
        <div class="products">
            <img src="{{ asset('images/IMG_9112 1.png') }}">
            <div class="product-information">
                <h4 class="item-name">ULAP™ CLOGS (Tan and Gray)</h4>
                <h4 class="price">₱ 999.00</h4>
            </div>
        </div>
        <div class="products">
            <img src="{{ asset('images/IMG_9136 1.png') }}">
            <div class="product-information">
                <h4 class="item-name">ULAP™ “Body Bag”</h4>
                <h4 class="price">₱ 999.00</h4>
            </div>
        </div>
        <div class="products">
            <img src="{{ asset('images/IMG_9147 1.png') }}">
            <div class="product-information">
                <h4 class="item-name">ULAP™ 420 CAP (Black)</h4>
                <h4 class="price">₱ 999.00</h4>
            </div>
        </div>
    </div>
</div>

<div class="promotional-pic2"><img src="{{ asset('images/image 12.png') }}" alt="promotional-pic"></div>

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
