<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Hanag's Garments</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            overflow-x: hidden;
            padding: 0;
        }

        .container {
            display: flex;
            max-width: 100%;
            background-color: #fff;
        }

        /* Sidebar Styles */
        .sidebar {
            width: 20%;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top:23px;
            margin-bottom: 20px; /* Add margin-bottom for separation on smaller screens */
            border-right: 1px solid #ddd;
        }

        .filter-box h3 {
            font-size: 18px;
            margin-bottom: 15px;
            color: #000;
        }

        .filter-box ul {
            list-style-type: none;
            padding: 0;
        }

        .filter-box li {
            font-size: 16px;
            margin-bottom: 10px;

            cursor: pointer;
            margin-bottom: 15px;
            color: #7a7a7a;
            cursor: pointer;
        }

        .filter-box li:hover {
            color: #000;
        }

        /* Product Section Styles */
        .product-section {
            display: flex;
            width: 75%;
            flex-direction: column;

            align-items: stretch;
            justify-content: space-between;
            padding: 20px;
            background-color: #fff;
        }

        .product-box {
    display: flex;
    width: 95%;
    align-items: center;
    position: relative; /* Ensures image can be positioned inside */
    background-color: #f5a9c3;
    padding: 20px;
    border-radius: 10px;
}

.product-description {
            width: 50%;
            background-color: #f5a9c3;
            padding: 20px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            height: auto;
        }

        .product-description h4 {
            font-size: 18px;
            color: #000;
            margin-bottom: 5px;
        }

        .product-description h2 {
            font-size: 24px;
            font-weight: bold;
            color: #000;
            margin-bottom: 10px;
        }

        .product-description p {
            font-size: 14px;
            color: #333;
            margin-bottom: 10px;
            line-height: 1.5;
        }

        .product-image {
            width: 45%;
            height: 340px;
            display: flex;
            justify-content: center;
            align-items: center;
            right: 20px; /* Adjust image position */

            position: relative; /* Ensure positioning context for absolute elements */
        }

        .product-image img {
            max-height: 100%;
            width: 100%;
            object-fit: contain;
        }

        /* Product Controls */
        .product-controls {
            display: flex;
            justify-content: space-between;
            margin-top: 10px;
            align-items: center;
            margin-bottom: 20px;
            width: 100%;
            margin-left: 400px;
        }

        .cart-link {
            font-size: 16px;
            text-decoration: none;
            color: #000;
        }

        .cart-link i {
            margin-left: 30px;
        }

        .sorting {
            display: flex;

            justify-content: flex-end;
            gap: 10px;
        }

        .sorting label,
        .sorting select,
        .sorting button {
            margin-left: 10px;
        }

        .sorting select,
        .sorting button {
            padding: 5px 10px;
            font-size: 14px;
        }

        .sorting select {
            font-size: 14px;
        }

       /* Ensure a row has exactly 5 products */
.product-list {
    display: grid;
    grid-template-columns: repeat(5, 1fr); /* 5 products per row */
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
    transition: 0.5s ease;
    background: rgba(0, 0, 0, 0.3); /* Dark overlay on hover */
    /* box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); Normal state shadow */

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


    .add-to-cart-btn {
    display: none;
    position: absolute;
    top: 68%; /* Move button slightly higher */
    left: 50%;
    transform: translate(-50%, -50%);
    background-color: transparent; /* Make background transparent */
    color: #fff; /* White text color */
    border: 2px solid #eea5a5; /* White border */
    padding: 12px 18px;
    font-size: 16px;
    cursor: pointer;
    border-radius: 5px;
    width: 209px; /* Adjust width */
    transition: background-color 0.3s ease, color 0.3s ease;
}

/* Show 'Add to Cart' button on hover */
.product-item:hover .add-to-cart-btn {
    display: block;
    background-color:#ede8e8;
    color: rgb(236, 151, 164); /* Change text color on hover */
    border: 2px solid #eea5a5; /* Change border color on hover */
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
        .prev, .next {
            display: none;

        position: absolute;
        top: 50%;
        font-size: 20px;
        color: #575858;
        padding: 10px;
        border: none;
        cursor: pointer;
        transform: translateY(-50%);
        z-index: 1;
    }

    .prev {
        left: 10px;
    }

    .next {
        right: 10px;
    }
    .product-item:hover .prev, .product-item:hover .next {
            display: block;
        }
/* Pagination */
.pagination {
    text-align: center;
    margin-top: 20px;
}

.pagination a {
    padding: 8px 15px;
    margin: 5px;
    border: 1px solid #ff1493;
    color: #ff1493;
    text-decoration: none;
    border-radius: 50px;
    font-size: 14px;
    transition: 0.3s;
}

.pagination a:hover {
    background: #ff1493;
    color: white;
}

/* Active Page */
.pagination .active a {
    background: #ff1493;
    color: white;
    font-weight: bold;
}
.pagination .disabled a,
.pagination .disabled .page-link {
    color: #ccc;
    cursor: not-allowed;
}
.pagination .prev:disabled,
.pagination .next:disabled {
    background: #e0e0e0;
    color: #ccc;
    cursor: not-allowed;
}
/* Adjust the pagination numbers */
.pagination .page-item {
    display: inline-block;
}

/* Center pagination numbers properly */
.pagination .page-item .page-link {
    display: inline-block;
    padding: 8px 16px;
}


    </style>
</head>

<body>
    <!-- Include Navigation -->
    @include('layouts.navigation')

    <div class="shop-page">
        <div class="container">
            <!-- Sidebar -->
            <div class="sidebar">
                <div class="filter-box">
                    <h3>Available Brands</h3>
                    <ul>
                        @foreach($brands as $brand)
                        <li>{{ $brand->brand_name }}</li>
                    @endforeach
                    </ul>
                </div>
            </div>

            <!-- Product Section -->
            <div class="product-section">
                <div class="product-box">
                    <div class="product-description">
                        <h4>WOMEN'S</h4>
                        <h2>Garments</h2>
                        <p>Discover trendy, high-quality fashion at budget-friendly prices. Elevate your style with our exclusive collections tailored for you.</p>
                    </div>
                    <div class="product-image">
                        <img src="{{ asset(path: 'images/brands/Maroon_3.png') }}" alt="Women's Accessories">
                    </div>
                </div>
            </div>
        </div>

        <!-- Sorting Controls -->
        <div class="product-controls">
            <div class="sorting">
                <a href="{{route('dashboard')}}">Home</a> / <a href="{{route('user.shop')}}">Shop</a>

                <label for="sort">Sort by price:</label>
<select id="sort" name="sort" onchange="location = this.value;">
    <option value="{{ route('user.shop', ['sort' => 'default']) }}" {{ $sort == 'default' ? 'selected' : '' }}>Default</option>
    <option value="{{ route('user.shop', ['sort' => 'price-asc']) }}" {{ $sort == 'price-asc' ? 'selected' : '' }}>Price: Low to High</option>
    <option value="{{ route('user.shop', ['sort' => 'price-desc']) }}" {{ $sort == 'price-desc' ? 'selected' : '' }}>Price: High to Low</option>
</select>


            </div>
        </div>

        <!-- Product Grid -->
        <div class="product-list">
            @foreach($products as $product)
            <div class="product-item">

                <a href="{{ route('user.productDetails.show', ['id' => $product->id]) }}">
                    <img src="{{ asset($product->image) }}" alt="Product Image">
                </a>
                <h4>{{ $product->brand->brand_name }}</h4>
                <p>{{ $product->product_name }}</p>
                <p>Rs. {{ number_format($product->sale_price, 0) }}</p>
                <!-- Add to Cart button - will appear centered over image on hover -->
                  <form name="addtocart-form" method="post" action="{{route('cart.add')}}">
                    @csrf
                    <input type="hidden" name="id" value="{{$product->id}}"/>
                    <input type="hidden" name="quantity" value="1"/>
                    <input type="hidden" name="name" value="{{$product->product_name}}"/>
                    <input type="hidden" name="price" value="{{$product->sale_price == '' ? $product->regular_price : $product->sale_price}}"/>
                    <button class="add-to-cart-btn">Add to Cart</button>
                </form>
                <form action="{{ route('wishlist.add', $product->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="wishlist-btn">
                        <i class="fa fa-heart-o"></i>
                    </button>
                </form>
            </div>

    @endforeach

        </div>
        <!-- Pagination -->
  <div class="pagination">
    {{ $products->appends(request()->query())->links('pagination::bootstrap-5') }}
</div>
<!-- Load More Button -->

    </div>
    <!-- Include Footer -->
    @include('layouts.footer')
     <!-- JavaScript for Product Image Navigation -->
     <script>
        // Loop through each product and add navigation functionality
        document.querySelectorAll('.product-item').forEach(item => {
            const prevButton = item.querySelector('.prev');
            const nextButton = item.querySelector('.next');
            const productImage = item.querySelector('.product-img');

            // Get the images for the current product
            const images = @json($product->images); // Assuming you have a `images` attribute with the image URLs.
            let currentImageIndex = 0;

            prevButton.addEventListener('click', () => {
                if (currentImageIndex > 0) {
                    currentImageIndex--;
                } else {
                    currentImageIndex = images.length - 1; // Loop back to the last image
                }
                productImage.src = "{{ asset('build/assets/images/products/') }}" + '/' + images[currentImageIndex];
            });

            nextButton.addEventListener('click', () => {
                if (currentImageIndex < images.length - 1) {
                    currentImageIndex++;
                } else {
                    currentImageIndex = 0; // Loop back to the first image
                }
                productImage.src = "{{ asset('build/assets/images/products/') }}" + '/' + images[currentImageIndex];
            });
        });
    </script>



</body>

</html>
