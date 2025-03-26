<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Page</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet"> <!-- Font Awesome CDN -->
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
            margin-bottom: 40px;
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
            max-width: 500px;
            border-radius: 5px;
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
            margin-top: 40px;
        }

        .related-products h2 {
            font-size: 20px;
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
    background: #F070BB;
    color: #fff;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 14px;
    text-align: center;
    transition: background-color 0.3s ease;
    width: 100%;
    margin-top: 10px;
}

.related-product-add-to-cart:hover {
    background: #D55B9D;
}

.related-product-add-to-cart i {
    margin-right: 10px;
    font-size: 18px;
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
            transition: transform 0.3s ease-in-out;
        }

        .product-item img {
            max-width: 90%;
            height: auto;
            margin-bottom: 10px;
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

        /* Add to Cart button - center of image */
        .add-to-cart-btn {
            display: none;
            position: absolute;
            top: 75%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #ff00c8;
            color: white;
            padding: 15px 20px;
            font-size: 18px;
            cursor: pointer;
            border: none;
            border-radius: 5px;
            width: 245px;         /* Increased width */

            transition: background-color 0.3s ease;
        }
        /* Show Add to Cart button on hover */
        .product-item:hover .add-to-cart-btn {
            display: block;
        }
 /* Wishlist Button */
        .wishlist-btn {
            position: absolute;
            right: 10px;
            top: 10px;
            color: rgb(229, 20, 20);
            border-radius: 50%;
            padding: 10px;
            cursor: pointer;
            font-size: 18px;
        }

    </style>
</head>
<body>
    <!-- Include Navigation -->
    @include('layouts.navigation')

    <div class="product-container">

        <!-- Product Section -->
        <div class="product-section">
            <div class="product-gallery">
                <div class="thumbnails">
                    {{-- @php
                    $images = json_decode($product->images, true);
                @endphp --}}

                {{-- @if($images && count($images) > 0) --}}
                    @foreach($product as $image)
                            <img src="{{ asset('build/assets/images/products/' . $product->images) }}" alt="Product Images">
                    @endforeach
                {{-- @else
                    <p>No images available for this product.</p>
                @endif --}}



                </div>
                <div class="main-image">

                    <img src="{{ asset('build/assets/images/products/'.$product->image) }}" alt="Main Product">
                </div>
            </div>

            <div class="product-details">
                <!-- Breadcrumb -->
                <div class="breadcrumb">
                    <a href="{{route('dashboard')}}">Home</a> / <a href="{{ route('user.shop') }}">The Shop</a> / <span>Lightweight Black Summer One Piece</span>
                </div>
                <h1>{{ $product->product_name }}</h1>
                <div class="ratings">
                    ⭐⭐⭐⭐⭐ <span>6 reviews</span>
                </div>
                <p class="price">Rs. {{ $product->sale_price }}</p>
                <p class="description">
                    {{ $product->description }}
                </p>

                <!-- Quantity Selector -->
                <div class="quantity">
                    <button class="decrease">-</button>
                    <input type="number" value="1" min="1">
                    <button class="increase">+</button>

                    <!-- Add to Cart Form -->
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
            </div>

                <button class="wishlist">
                    <i class="fas fa-heart"></i> Add To Wishlist
                </button>
                <p class="categories">Category:{{ $product->category->category_name }}</p>
                 <p class="tags">Brand:{{$product->brand->brand_name}}</p>
                {{-- <p class="categories">Categories: {{ implode(', ', $product->category->pluck('category_name')->toArray()) }}</p> --}}
                {{-- <p class="tags">Brand: {{ implode(', ', $product->brand->pluck('brand_name')->toArray()) }}</p> --}}

            </div>
        </div>

        <!-- Related Products -->
        <div class="related-products">
            <h2>Related Products</h2>
             <!-- Product Grid -->
        <div class="product-list">
            @foreach ($relatedProducts as $relatedProduct)
                <div class="product-item">
                    <img src="{{ asset('build/assets/images/products/'. $relatedProduct->image) }}" alt="Related Product">

                <!-- Add to Cart button - will appear centered over image on hover -->
                <form name="addtocart-form" method="post" action="{{route('cart.add')}}">
                    @csrf
                            <input type="hidden" name="id" value="{{ $relatedProduct->id }}">
                            <input type="hidden" name="quantity" value="1">
                            <input type="hidden" name="name" value="{{ $relatedProduct->product_name }}">
                            <input type="hidden" name="price" value="{{ $relatedProduct->sale_price ?: $relatedProduct->regular_price }}">
                            <button type="submit" class="related-product-add-to-cart">
                                <i class="fas fa-cart-plus"></i> Add to Cart
                            </button>
                </form>
                <p class="product-name">{{ $relatedProduct->product_name }}</p>
                <p class="product-price">Rs. {{ $relatedProduct->sale_price }}</p>

                <!-- Wishlist Button -->
                <a href="{{route('user.wishlist')}}" class="wishlist-btn"><i class="fa fa-heart-o"></i></a>
            </div>
            @endforeach
        </div>
            </div>

    </div>
    <!-- Include Footer -->
    @include('layouts.footer')
</body>
</html>
