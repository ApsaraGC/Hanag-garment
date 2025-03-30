<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Page</title>
    <link rel="stylesheet" href="styles.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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

    background-color: #f564d5;
    position: absolute;
    color: #fff;
    top: 68%; /* Move button slightly higher */
    left: 50%;
    padding: 12px 18px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
    text-align: center;
    transform: translate(-50%, -50%);
    width: 220px;
    margin-top: 10px;
}

.related-product-add-to-cart:hover {
    display: block;

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

       /* Uniform Image Size */
.product-item img {
    width: 100%; /* Ensures full width */
    height: 220px; /* Fixed height for uniformity */
    object-fit: contain; /* Ensures images fit well without distortion */
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


 /* Wishlist Button */
        .wishlist-btn {
            background: none; /* Remove button background */
        border: none; /* Remove border */
        padding: 0; /* Remove padding */
        cursor: pointer; /* Make it clickable */
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
                    @php
            $product->images= array_slice($product->images, 0, 4); // Limits to 4 images
        @endphp
                @foreach($product->images as $img)
                <img src="{{ asset( $img) }}" alt="Product Image" ></img>
            @endforeach
                </div>
                <div class="main-image">

                    <img src="{{ asset($product->image) }}" alt="Main Product">
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
                      <!-- Wishlist Button -->
                <form action="{{ route('wishlist.add', $product->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="wishlist">
                        <i class="fa fa-heart-o"></i>Add To Wishlist
                    </button>
                </form>

                {{-- <button class="wishlist">
                    <i class="fas fa-heart"></i> Add To Wishlist
                </button> --}}
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
                    <img src="{{ asset( $relatedProduct->image) }}" alt="Related Product">

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

                 <p class="product-name">{{$relatedProduct->brand->brand_name}}</p>
                <p class="product-name">{{ $relatedProduct->product_name }}</p>
                <p class="product-price">Rs. {{ $relatedProduct->sale_price }}</p>

                <!-- Wishlist Button -->
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
</html>
