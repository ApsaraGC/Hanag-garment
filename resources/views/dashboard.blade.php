<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="Hanag's Garments offers premium clothing for every occasion with affordable pricing. Explore our latest collection of men's and women's wear.">
    <meta name="keywords" content="clothing, garments, fashion, premium clothing, affordable fashion">
    <meta name="author" content="Hanag's Garments">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <title>Hanag's Garments</title>
    <style>
        /* General Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            overflow-x: hidden;
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        /* Banner Section */
        .banner {
            display: flex;
            align-items: center;
            justify-content: space-between;
            height: 550px;
            padding: 60px;
            background-color: #f9f9f9;
        }

        .banner .text-content {
            flex: 1;
            max-width: 50%;
            margin-top: -20px;
        }

        .banner .text-content h2 {
            font-size: 40px;
            color: #888;
            margin-bottom: 5px;
        }

        .banner .text-content h1 {
            font-size: 60px;
            color: #F070BB;
            margin-bottom: 10px;
        }

        .banner .text-content p {
            font-size: 16px;
            margin-bottom: 15px;
            color: #555;
        }

        .banner .shop-now-btn {
            display: inline-block;
            padding: 8px 16px;
            background-color: #F070BB;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
        }

        .banner .shop-now-btn:hover {
            background-color: #e4419d;
        }

        .banner .image-content {
            flex: 1;
            max-width: 100%;
            position: relative;
        }

        .banner .image-content img {
            max-height: 480px;
            /* Increased height */
            transition: all 1s ease;
        }

        .image-content {
            flex: 1;
            max-width: 50%;
            text-align: center;
        }

        /* Container styles for the 'You Might Like' section */
        .you-might-like {
            padding: 30px 20px;
            text-align: center;
            background-color: #FFF;

        }

        .you-might-like h2 {
            font-size: 35px;
            margin-bottom: 20px;
            color: #F070BB;
        }

        /* Carousel container that holds the items */
        .carousel {
            margin-top: 10px;
            display: flex;
            justify-content: center;
        }

        /* Items inside the carousel */
        .carousel-items {
            display: flex;
            gap: 45px;
            /* Adjusted gap between images */
            justify-content: center;

            /* Initially center the images */
            animation: scroll-right-to-left 15s linear infinite;
            /* Animation for moving right to left */

        }

        .carousel-items::-webkit-scrollbar {
            display: none;
        }

        /* Styling each carousel item */
        .carousel-item {
            justify-content: center;
            /* Initially center the images */
            text-align: center;
        }

        /* Styling for images inside the carousel items */
        .carousel-item img {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 5px;
        }

        /* Keyframes for the scrolling effect from right to left */
        @keyframes scroll-right-to-left {
            0% {
                transform: translateX(20%);
                /* Start from the right side (out of view) */
            }

            50% {
                transform: translateX(0%);
                /* Move to the center (visible) */
            }

            100% {
                transform: translateX(-50%);
                /* Move out of view to the left side */
            }
        }

        /* Hot Deals Section */
        .hot-deals {
            padding: 30px 20px;
            display: flex;
            justify-content: flex-start;
            /* Align all items in one row */
            align-items: center;
            background-color: #F8F8F8;
            border-radius: 10px;
            /* overflow-x: hidden;  Allows horizontal scrolling if needed */
        }

        .hot-deals .sale-banner {
            background-color: #e42121;
            text-align: center;
            padding: 20px 10px;
            border-radius: 100%;
            width: 350px;
            height: 280px;
            /* Adjust size of the banner */
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            color: #fff;
            margin-left: 30px;
            margin-right: 40px;
            /* Space between sale banner and product images */
        }

        .hot-deals .sale-banner h2 {
            font-size: 30px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .hot-deals .sale-banner p {
            font-size: 18px;
            font-weight: bold;
        }

        /* Product image container */
        .deals-images {
            display: flex;
            justify-content: flex-start;
            gap: 16px;
        }

        .product-items {
            text-align: center;
            border: 0.5px solid #ddd;
            padding: 10px;
            border-radius: 5px;
            background: #fff;
            position: relative;
            overflow: hidden;
            width: 100%;
            transition: transform 0.3s ease-in-out;
        }

        .product-items:hover {
            transform: translateY(-5px);
        }

        .product-items img {
            width: 100%;
            height: 200px;
            /* Set a fixed height for consistency */
            object-fit: cover;
            /* Ensures the image covers the area without stretching */
            border-radius: 10px;
            transition: transform 0.3s ease;
        }


        .product-items img:hover {
            transform: scale(1.05);
        }

        .product-items h3 {
            font-size: 16px;
            font-weight: bold;
            color: #757272;
            text-align: left;
            margin-top: 10px;
        }

        /* Regular and sale price styling */
        .product-info {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
        }

        /* Price Section */
        .price-section {
            display: flex;
            justify-content: flex-start;
            align-items: center;
            gap: 10px;
            /* Add space between sale price and regular price */
        }

        /* Sale Price */
        .sale-price {
            font-weight: bold;
            color: #626362;
            font-size: 16px;
            margin-right: 45px;
            /* Space between sale price and regular price */
        }

        /* Regular Price */
        .regular-price {
            text-align: left;
            text-decoration: line-through;
            color: #ff0000;
            font-size: 14px;
            margin-bottom: 5px;
        }

        .cart-icon {
            background-color: #f8f8f8;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 8px 12px;
            font-size: 16px;
            cursor: pointer;
            transition: background 0.3s, color 0.3s;
            color: #333;
        }

        .cart-icon:hover {
            color: #f312a4;
        }

        .product-items:hover .add-to-cart-btn {
            opacity: 1;
        }

        /* Media query for responsiveness */
        @media (max-width: 1024px) {
            .product-items {
                width: calc(33.33% - 10px);
                /* 3 items per row */
            }
        }

        @media (max-width: 768px) {
            .product-items {
                width: calc(50% - 10px);
                /* 2 items per row */
            }
        }

        @media (max-width: 480px) {
            .product-items {
                width: 100%;
                /* 1 item per row */
            }

            .hot-deals .sale-banner {
                width: 120px;
                height: 120px;
            }
        }

        /* Featured Products Section */
        .featured-products {
            padding: 30px 20px;
            background-color: #FFF;
            text-align: center;
        }

        .featured-products h2 {
            font-size: 22px;
            margin-bottom: 20px;
        }

        /* Ensure a row has exactly 5 products */
        .product-list {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 20px;
            padding: 20px;
        }

        .product-item {
            text-align: center;
            border: 0.5px solid #ddd;
            padding: 10px;
            background: #fff;
            position: relative;
            overflow: hidden;
            transition: transform 0.3s ease-in-out;
        }

        /* Uniform Image Size */
        .product-item img {
            width: 100%;
            height: 220px;
            /* Fixed height for uniformity */
            object-fit: contain;
            /* Ensures images fit well without distortion */
            margin-bottom: 10px;
            background: rgba(0, 0, 0, 0.3);
        }

        .product-item h4,
        .product-item p {
            margin: 5px 0;
        }

        /* Hover effect */
        .product-item:hover {
            transform: scale(1.05);
        }

        .add-to-cart-btn {
            display: none;
            position: absolute;
            top: 65%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: transparent;
            color: #fff;
            border: 2px solid #eea5a5;
            padding: 12px 18px;
            font-size: 16px;
            border-radius: 5px;
            width: 200px;
            transition: 0.3s;
        }

        .product-item:hover .add-to-cart-btn {
            display: block;
            background: #ede8e8;
            color: rgb(236, 151, 164);
        }

        /* Wishlist Button */
        .wishlist-btn {
            background: none;
            border: none;
            padding: 0;
            cursor: pointer;
            /* Make it clickable */
            position: absolute;
            right: 10px;
            top: 10px;
            color: red;
            border-radius: 60%;
            padding: 10px;
            cursor: pointer;
            font-size: 18px;
        }

        .load-more {
            margin-top: -25px;
            display: inline-block;
            background-color: #F070BB;
            color: white;
            margin-left: 650px;
            text-align: center;
            padding: 10px 20px;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        .banner {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
        }

        .circle-container {
            position: relative;
            width: 450px;
            /* Set the desired width of the circle */
            height: 450px;
            /* Set the desired height of the circle */
            background-color: #fbcbe1;
            /* Pink background */
            border-radius: 50%;
            /* Makes it circular */
            display: flex;
            margin-left: 50px;
            justify-content: center;
            align-items: center;
            overflow: hidden;
        }

        .bag-image {
            position: absolute;
            width: 550px;
            height: 400px;
        }

        .logo-image {
            border-radius: 50%;
            /* Makes it circular */
            position: absolute;
            margin-left: 85px;
            margin-top: 60px;
            width: 120px;
            /* Adjust the size of the logo */
            height: 120px;
            /* Adjust the size of the logo */
        }

        .chat-float-button {
            position: fixed;
            bottom: 30px;
            right: 30px;
            width: 60px;
            height: 60px;
            background-color: #ff69b4;
            color: white;
            font-size: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.3);
            text-decoration: none;
            z-index: 999;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .chat-float-button i {
            margin: 0;
        }

        .chat-float-button:hover {
            background-color: #e0569a;
            transform: scale(1.1);
        }
    </style>
</head>
<body>
    <!-- Include Navigation -->
    @include('layouts.navigation')
    <!-- Banner -->
    <section class="banner">
        <div class="text-content">
            @if(Auth::check())
                <p style="color:#F070BB; font-weight:bold;">Welcome, {{ Auth::user()->full_name }}</p>
            @endif
            <h2>Grace in Every Stitch</h2>
            <h1>Hanag's Garments</h1>
            <p>Explore our latest collection of premium clothing for every occasion.</p>
            <a href="{{route('user.shop')}}" class="shop-now-btn">Shop Now</a>
        </div>
        <div class="image-content">
            <div class="image-content">
                <div class="circle-container">
                    <img id="banner-image-1" class="bag-image" src="{{ asset('build/assets/images/bag.png') }}"
                        alt="Bag">
                    <img id="banner-image-2" class="bag-image" src="{{ asset('build/assets/images/Bag1.png') }}"
                        alt="Shopping Bag">
                    <img class="logo-image" src="{{ asset('build/assets/images/logo1.png') }}" alt="Hanag's Logo">
                </div>
            </div>
        </div>
    </section>
    <!-- You Might Like Section -->
    <section class="you-might-like">
        <h2>You Might Like</h2>
        <div class="carousel-items">
            <div class="carousel-item">
                <img src="{{ asset('images/brands/Satin_Green.png') }}" alt="Item">
                <p>Floral Gown</p>
            </div>
            <div class="carousel-item">
                <img src="{{ asset('images/brands/Midi_Grad_34.png') }}" alt="Item">
                <p>Casual Summar</p>
            </div>
            <div class="carousel-item">
                <img src="{{ asset('images/brands/light_pink1.png') }}" alt="Item">
                <p>A-Line Skirts</p>
            </div>
            <div class="carousel-item">
                <img src="{{ asset('images/brands/White_one.png') }}" alt="Item">
                <p>One piece</p>
            </div>

            <div class="carousel-item">
                <img src="{{ asset('images/brands/White_long.png') }}" alt="Item">
                <p>Party Gown</p>
            </div>
            <div class="carousel-item">
                <img src="{{ asset('images/brands/Maroon_3.png') }}" alt="Item">
                <p>Pleates Skirts</p>
            </div>
            <div class="carousel-item">
                <img src="{{ asset('images/brands/Brown_white.png') }}" alt="Item">
                <p>Formal Dress</p>
            </div>
            <div class="carousel-item">
                <img src="{{ asset('images/brands/Midi_Grad.png') }}" alt="Item">
                <p>Denim Skirts</p>
            </div>
        </div>
    </section>
    <div>
        <!-- Hot Deals Section -->
        <section class="hot-deals">
            <!-- Sale Banner -->
            <div class="sale-banner">
                <h2>Summer Sale</h2>
                <p>Up to 10% off</p>
            </div>
            <!-- Product Images & Information -->
            <div class="deals-images">
                @foreach($hotDeals as $product)
                    <div class="product-items">
                        <!-- Product Image -->
                        <img src="{{ asset($product->image) }}" alt="{{ $product->product_name }}">
                        <!-- Product Info -->
                        <div class="product-info">
                            <h3>{{ $product->product_name }}</h3>
                            <form name="addtocart-form" method="post" action="{{ route('cart.add') }}">
                                @csrf
                                <input type="hidden" name="id" value="{{ $product->id }}" />
                                <input type="hidden" name="quantity" value="1" />
                                <input type="hidden" name="name" value="{{ $product->product_name }}" />
                                <input type="hidden" name="price"
                                    value="{{ $product->sale_price == '' ? $product->regular_price : $product->sale_price }}" />
                                <button type="submit" style="border: none; background: none; padding: 0; height: 20px;">
                                    <i class="cart-icon fa fa-shopping-cart"></i>
                                </button>
                            </form>
                            <form action="{{ route('wishlist.add', $product->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="wishlist-btn">
                                    <i class="fa fa-heart-o"></i>
                                </button>
                            </form>
                        </div>
                        <!-- Price Section -->
                        <div class="price-section">
                            <p><span class="sale-price">${{ number_format($product->discount_price, 0) }}</span></p>
                            <p><span class="regular-price">${{ number_format($product->regular_price, 0) }}</span></p>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
    </div>
    <!-- Featured Products -->
    <section class="featured-products">
        <h2>Our Latest Products</h2>
        <div class="product-list">
            @foreach($products as $product)
                <div class="product-item">
                    <!-- Add to Cart button - will appear centered over image on hover -->
                    <form name="addtocart-form" method="post" action="{{route('cart.add')}}">
                        @csrf
                        <input type="hidden" name="id" value="{{$product->id}}" />
                        <input type="hidden" name="quantity" value="1" />
                        <input type="hidden" name="name" value="{{$product->product_name}}" />
                        <input type="hidden" name="price"
                            value="{{$product->sale_price == '' ? $product->regular_price : $product->sale_price}}" />
                        <button class="add-to-cart-btn">Add to Cart</button>
                    </form>
                    <a href="{{ route('user.productDetails.show', ['id' => $product->id]) }}">
                        <img src="{{ asset($product->image) }}" alt="Product Image">
                    </a>
                    <h4>{{ $product->brand->brand_name }}</h4>
                    <p>{{ $product->product_name }}</p>
                    <p>Rs. {{ number_format($product->sale_price, 0) }}</p>
                    <!-- Wishlist Button -->
                    <form action="{{ route('wishlist.add', $product->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="wishlist-btn">
                            <i class="fa fa-heart-o"></i>
                        </button>
                    </form>
                </div>
            @endforeach
        </div>
    </section>
    <a href="{{ route('user.shop') }}" class="load-more">Load More</a>
    <a href="{{route('chat.index')}}" class="chat-float-button" title="Chat with Users">
        <i class="fas fa-comment-dots"></i>
    </a>
    <!-- Footer -->
    @include('layouts.footer')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const carousel = document.querySelector('.carousel-items');
            // Adjust the animation speed based on the number of items
            const totalItems = carousel.children.length;
            const totalWidth = totalItems * 120; // Adjusted width to account for the gap
            const animationDuration = (totalWidth / 50) + 's'; // Adjust the speed as needed
            // Apply dynamic animation duration
            carousel.style.animationDuration = animationDuration;
        });

        let bannerImages = ['bag.png', 'Bag1.png'];
        let currentBannerImage = 0;

        const bannerImage1 = document.getElementById('banner-image-1');
        const bannerImage2 = document.getElementById('banner-image-2');

        [bannerImage2].forEach(image => {
            image.style.width = "440px";
            image.style.height = "300px";
            image.style.marginLeft = "75px";
            image.style.marginBottom = "25px";
            image.style.marginTop = "20px";
            image.style.objectFit = "contain";
            image.style.transition = "opacity 1s ease-in-out";
            image.style.position = "absolute";
        });
        // Initial states
        bannerImage1.style.opacity = 1;
        bannerImage2.style.opacity = 0;
        bannerImage1.src = `{{ asset('build/assets/images/') }}/${bannerImages[0]}`;
        bannerImage2.src = `{{ asset('build/assets/images/') }}/${bannerImages[1]}`;

        function swapBannerImages() {
            if (currentBannerImage % 2 === 0) {
                bannerImage1.style.opacity = 0;
                bannerImage2.style.opacity = 1;
            } else {
                bannerImage1.style.opacity = 1;
                bannerImage2.style.opacity = 0;
            }
            setTimeout(() => {
                currentBannerImage = (currentBannerImage + 1) % bannerImages.length;

                const nextImage = bannerImages[currentBannerImage];
                if (currentBannerImage % 2 === 0) {
                    bannerImage1.src = `{{ asset('build/assets/images/') }}/${nextImage}`;
                } else {
                    bannerImage2.src = `{{ asset('build/assets/images/') }}/${nextImage}`;
                }
            }, 1000); // After fade transition
        }
        setInterval(swapBannerImages, 4000); // Every 4 seconds
        function showPrice(productId) {
            // Replace the displayed price with the sale price and show the "Add to Cart" button
            var priceElement = document.getElementById('price-' + productId);
            var cartButton = document.getElementById('cart-button-' + productId);
            // Update the price display
            var salePrice = "{{ $product->sale_price }}"; // Get the sale price dynamically
            priceElement.innerHTML = 'Sale Price: $' + salePrice;
            // Show the "Add to Cart" button
            cartButton.style.display = 'block';
        }
        function addToCart(productId) {
            // Example: Send an AJAX request or simply display a message for now
            alert('Product added to cart: ' + productId);
        }
    </script>
</body>
</html>
