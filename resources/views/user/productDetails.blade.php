<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Page</title>
    <link rel="stylesheet" href="styles.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <!-- Font Awesome CDN -->
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            line-height: 1.6;
        }

        .product-container {
            width: 90%;
            margin: 0 auto;
        }

        .breadcrumb {
            font-size: 14px;
            margin-left: 30px;
            margin: 20px 0;
            color: #888;
        }

        .breadcrumb a {
            color: #F070BB;
            text-decoration: none;
        }

        .product-section {
            display: flex;
            gap: 20px;
            margin-top: 20px;
        }

        .product-gallery {
            display: flex;
            flex-direction: row;
            gap: 20px;
        }

        .thumbnails {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .thumbnails img {
            width: 80px;
            height: auto;
            border: 1px solid #ddd;
            border-radius: 5px;
            cursor: pointer;
        }

        .main-image img {
            width: 100%;
            /* You can adjust this percentage to fit your layout */
            max-width: 500px;
            /* Set a max width */
            height: auto;
            /* Keep the aspect ratio intact */
            border: 5px;
            object-fit: cover;
            /* Optional: Ensures the image covers the area without stretching */
        }

        .product-details {
            flex: 1;
        }

        .product-details h1 {
            font-size: 24px;
            margin-bottom: 10px;
        }

        .ratings span {
            font-size: 14px;
            color: #888;
        }

        .price {
            font-size: 20px;
            font-weight: bold;
            margin: 10px 0;
            color: #F070BB;
        }

        .description {
            margin: 20px 0;
        }

        .quantity {
            display: flex;
            align-items: center;
            gap: 10px;
            margin: 20px 0;
        }

        .add-to-cart {
            background: #F070BB;
            color: #fff;
            padding: 15px 35px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            display: inline-block;
            font-size: 16px;
            text-align: center;
            transition: background-color 0.3s ease;
            width: 100%;
            margin-top: 20px;
        }

        .add-to-cart:hover {
            background: #D55B9D;
        }

        .add-to-cart i {
            margin-right: 10px;
            font-size: 18px;
        }

        .add-to-cart-btn {
            background: #F070BB;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            text-align: center;
            width: 100%;
            transition: background-color 0.3s ease;
        }

        .add-to-cart-btn:hover {
            background: #D55B9D;
        }

        .quantity input {
            width: 50px;
            text-align: center;
            border: 1px solid #ddd;
            height: 30px;
        }

        .quantity button {
            background: #F070BB;
            color: #fff;
            border: none;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        .quantity button:hover {
            background: #D55B9D;
        }

        .quantity button:active {
            background: #C1518A;
        }

        .wishlist {
            background: #ddd;
            color: #333;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            display: inline-block;
        }

        .related-products {
            margin-top: 20px;
        }

        .related-products h2 {
            font-size: 20px;
            text-align: center;
            margin-bottom: 20px;
        }

        .products-grid {
            display: flex;
            gap: 20px;
        }

        .product-card {
            text-align: center;
            flex: 1;
        }

        .product-card img {
            width: 100%;
            border-radius: 5px;
            margin-bottom: 10px;

        }

        .product-name {
            font-size: 16px;
            margin: 10px 0;
        }

        .product-price {
            color: #F070BB;
            font-weight: bold;
        }

        /* Add to Cart Button for Related Products */
        .related-product-add-to-cart {
            position: absolute;
            top: 60%;
            left: 50%;
            transform: translate(-50%, -50%);
            border: none;
            padding: 12px 18px;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            width: 220px;
            opacity: 0;
            transition: opacity 0.3s ease-in-out, background-color 0.3s ease;

        }

        /* Show button only on hover */
        .product-item:hover .related-product-add-to-cart {
            opacity: 1;
        }

        /* Subtle hover effect for the button */
        .related-product-add-to-cart:hover {
            background-color: #ede8e8;
            color: rgb(236, 151, 164);
            border: 2px solid #eea5a5;
        }

        /* Product Grid */
        .product-list {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
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
            width: 220px;
            transition: transform 0.3s ease-in-out;
        }

        /* Uniform Image Size */
        .product-item img {
            width: 100%;
            /* Ensures full width */
            height: 220px;
            /* Fixed height for uniformity */
            object-fit: contain;
            /* Ensures images fit well without distortion */
            margin-bottom: 10px;
            background: rgba(0, 0, 0, 0.3);
            /* Dark overlay on hover */

        }

        .product-item h4,
        .product-item p {
            margin: 5px 0;
            color: #212121;
        }

        /* Hover effect */
        .product-item:hover {
            transform: scale(1.05);
        }

        /* Wishlist Button */
        .wishlist-btn {
            background: none;
            /* Remove button background */
            border: none;
            /* Remove border */
            padding: 0;
            /* Remove padding */
            cursor: pointer;
            /* Make it clickable */
            position: absolute;
            right: 10px;
            top: 10px;
            color: rgb(229, 20, 20);
            border-radius: 50%;
            padding: 10px;
            cursor: pointer;
            font-size: 18px;
        }

        /* Full star (yellow) */
        .fa-star.checked {
            color: yellow;
        }

        .out-of-stock {
            background: #F070BB;
            color: #fff;
            padding: 10px 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
            text-align: center;
        }

        /* Half star effect using background gradient */
        .fa-star-half {
            background: linear-gradient(to right, yellow 50%, #ccc 50%);
            -webkit-background-clip: text;
            color: transparent;
        }

        .thumbnail {
            cursor: pointer;
            /* Change cursor to pointer when hovering over thumbnails */
        }

        .thumbnail.active {
            border: 2px solid #F070BB;
            /* Optional: Add a border to highlight the active thumbnail */
        }

        .related-products.product-name {
            font-size: bold;
            color: #333;

        }
    </style>
    <!-- Add icon library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <!-- Include Navigation -->
    @include('layouts.navigation')

    <div class="product-container">

        <!-- Product Section -->
        <div class="product-section">
            <div class="product-gallery">
                <div class="thumbnails">
                    @php
                        $product->images = array_slice($product->images, 0, 4); // Limits to 4 images
                    @endphp
                    @foreach($product->images as $img)
                        <img src="{{ asset($img) }}" alt="Product Image" class="thumbnail"
                            onclick="changeMainImage(this)"></img>
                    @endforeach
                </div>
                <div class="main-image">

                    <img id="main-image" src="{{ asset($product->image) }}" alt="Main Product ">
                </div>
            </div>

            <div class="product-details">
                <!-- Breadcrumb -->
                <div class="breadcrumb">
                    <a href="{{route('dashboard')}}">Home</a> / <a href="{{ route('user.shop') }}">The Shop</a> /
                    <span>{{ $product->short_description }}</span>
                </div>
                <h1>{{ $product->product_name }}</h1>
                <div class="ratings">
                    <form id="rating-form" action="{{ route('submit.rating') }}" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <input type="hidden" name="rating" id="selected-rating">

                        @for ($i = 1; $i <= 5; $i++)
                            <span class="star" data-rating="{{ $i }}" onclick="submitRating({{ $i }})">
                                <span class="fa fa-star" id="star-{{ $i }}-empty"></span>
                                <span class="fa fa-star checked" id="star-{{ $i }}-filled" style="display: none;"></span>
                                <span class="fa fa-star-half" id="star-{{ $i }}-half" style="display: none;"></span>
                            </span>
                        @endfor
                        <span id="review-count">{{ $product->reviews->count() }} reviews</span>
                    </form>
                </div>

                <p class="price">Rs. <span
                        style="text-decoration: line-through; color: #5e5c5c; font-size: 20px;">{{ number_format($product->regular_price, 0) }}</span>
                </p>

                <p class="price">Rs. {{ $product->sale_price }}</p>
                <p class="description">
                    {{ $product->description }}
                </p>
                <p class="categories">Category:{{ $product->category->category_name }}</p>
                <p class="tags">Brand:{{$product->brand->brand_name}}</p>
                <!-- Quantity Selector -->
                <div class="quantity">
                    <!-- Add to Cart Form -->
                    @if ($product->stock_status === 'outofstock')
                        <!-- Out of Stock Message -->
                        <p class="out-of-stock">Out of Stock</p>
                    @else
                        <form name="addtocart-form" method="post" action="{{route('cart.add')}}">
                            @csrf
                            <input type="hidden" name="id" value="{{ $product->id }}">
                            <input type="hidden" name="quantity" value="1">
                            <input type="hidden" name="name" value="{{ $product->product_name }}">
                            <input type="hidden" name="price" value="{{ $product->sale_price ?: $product->regular_price }}">
                            <button type="submit" class="add-to-cart">
                                <i class="fas fa-cart-plus"></i> Add to Cart
                            </button>
                        </form>

                    @endif

                </div>
                <!-- Wishlist Button -->
                <form action="{{ route('wishlist.add', $product->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="wishlist">
                        <i class="fa fa-heart-o"></i> Add To Wishlist
                    </button>
                </form>


            </div>
        </div>

        <!-- Related Products -->
        <div class="related-products">
            <h2>Related Products</h2>
            <!-- Product Grid -->
            <div class="product-list">
                @foreach ($relatedProducts as $relatedProduct)
                    <div class="product-item">
                        <img src="{{ asset($relatedProduct->image) }}" alt="Related Product">
                        <!-- Add to Cart button - will appear centered over image on hover -->
                        <form name="addtocart-form" method="post" action="{{route('cart.add')}}">
                            @csrf
                            <input type="hidden" name="id" value="{{ $relatedProduct->id }}">
                            <input type="hidden" name="quantity" value="1">
                            <input type="hidden" name="name" value="{{ $relatedProduct->product_name }}">
                            <input type="hidden" name="price"
                                value="{{ $relatedProduct->sale_price ?: $relatedProduct->regular_price }}">
                            <button type="submit" class="related-product-add-to-cart">
                                <i class="fas fa-cart-plus"></i> Add to Cart
                            </button>
                        </form>
                        <p class="product-name">{{$relatedProduct->brand->brand_name}}</p>
                        <p class="product-name">{{ $relatedProduct->product_name }}</p>
                        <p class="">Rs. {{ $relatedProduct->sale_price }}</p>
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
        </div>
    </div>
    <!-- Include Footer -->
    @include('layouts.footer')
</body>
<script>
    function submitRating(rating) {
        // Set the selected rating in the hidden input field
        document.getElementById('selected-rating').value = rating;

        // Update the star display to reflect the selected rating (half-star logic)
        for (let i = 1; i <= 5; i++) {
            const starEmpty = document.getElementById(`star-${i}-empty`);
            const starFilled = document.getElementById(`star-${i}-filled`);
            const starHalf = document.getElementById(`star-${i}-half`);

            // Reset all stars first
            starEmpty.style.display = 'inline';
            starFilled.style.display = 'none';
            starHalf.style.display = 'none';

            // If the current star is less than or equal to the rating, fill it with yellow
            if (i <= rating) {
                starEmpty.style.display = 'none';
                starFilled.style.display = 'inline';
            }

            // If the current star is half of the next one, show half-filled star
            else if (i - 1.5 === rating) {
                starEmpty.style.display = 'none';
                starHalf.style.display = 'inline';
            }
        }

        // Submit the form
        document.getElementById('rating-form').submit();
    }
</script>
<script>
    function changeMainImage(thumbnail) {
        // Get all thumbnails and remove 'active' class
        var thumbnails = document.querySelectorAll('.thumbnail');
        thumbnails.forEach(function (thumb) {
            thumb.classList.remove('active');
        });

        // Add 'active' class to the clicked thumbnail
        thumbnail.classList.add('active');

        // Get the source of the clicked thumbnail image
        var thumbnailSrc = thumbnail.src;

        // Get the main image element
        var mainImage = document.getElementById('main-image');

        // Get the current source of the main image
        var currentMainImageSrc = mainImage.src;

        // Swap the main image with the clicked thumbnail
        mainImage.src = thumbnailSrc;

        // Set the thumbnail image's source to the old main image source
        thumbnail.src = currentMainImageSrc;
    }
</script>
</html>
