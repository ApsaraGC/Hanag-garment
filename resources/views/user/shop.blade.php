<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop - Hanag's Garments</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            overflow-x: hidden;
            padding: 0;
        }
        .wishlist-btn {
            background: none;
            border: none;
            padding: 0;
            cursor: pointer;
            position: absolute;
            right: 20px;
            top: 15px;
            color: rgb(229, 20, 20);
            font-size: 18px;
        }
        .container {
            display: flex;
            max-width: 100%;
            background: #fff;
        }
        .sorting-container {
            display: flex;
            width: 800px;
            margin-left: 40px;
            justify-content: space-between;
            /* Adjusts spacing */
            background-color: #f9f9f9;
            padding: 8px 10px;
            border-radius: 8px;
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
        }
        .explore-text {
            font-size: 20px;
            font-weight: bold;
            color: #333;

            margin: 0;
            margin-left: 4px;
        }
        .sorting {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        label {
            font-size: 14px;
            color: #555;
        }

        select {
            padding: 5px 10px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 5px;
            cursor: pointer;
        }

        select:hover {
            border-color: #888;
        }
        .sidebar {
            width: 20%;
            background: #fff;
            padding: 15px;
            border-radius: 20px;
            height: 100vh;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin: 23px 10px 15px;
            border-right: 1px solid #ddd;
        }

        .filter-box h3 {
            font-size: 18px;
            margin-bottom: 15px;
            color: #000;
        }

        .filter-box ul {
            list-style: none;
            padding: 0;
        }

        .filter-box li {
            font-size: 16px;
            margin-bottom: 15px;
            color: #7a7a7a;
            cursor: pointer;
        }

        .filter-box li:hover {
            color: #000;
        }
        .product-section {
            display: flex;
            width: 75%;
            flex-direction: column;
            padding: 20px;
            background: #fff;
        }
        .product-list {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 18px;
            padding: 30px;
        }
        .product-item {
            text-align: center;
            border: 0.5px solid #ddd;
            padding: 10px;
            height: 300px;
            background: #fff;
            position: relative;
            transition: transform 0.3s;
        }
        .product-item img {
            width: 100%;
            height: 210px;
            background: rgba(0, 0, 0, 0.3);
            object-fit: contain;
            margin-bottom: 10px;
            transition: 0.5s ease;
        }
        .product-item:hover {
            transform: scale(1.05);
        }
        .product-item p {
            justify-content: center;
            gap: 5px;
            color: #464444;
            margin: 2px;
            padding: 0;
        }
        .product-item h4 {
            justify-content: center;
            color: #464444;
            margin: 1px;
            /* Remove any default margin */
            margin: 2px 0;
            /* Reduce margin to minimize space */
            padding-top: 15px;
            /* Reduce padding */
        }
        .add-to-cart-btn {
            display: none;
            position: absolute;
            top: 70%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: transparent;
            color: #fff;
            border: 2px solid #eea5a5;
            padding: 12px 18px;
            font-size: 16px;
            border-radius: 5px;
            width: 185px;
            transition: 0.3s;
        }
        .product-item:hover .add-to-cart-btn {
            display: block;
            background: #ede8e8;
            color: rgb(236, 151, 164);
        }
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
        .pagination a:hover,
        .pagination .active a {
            background: #ff1493;
            color: white;
            font-weight: bold;
        }

        .pagination .disabled a {
            color: #ccc;
            cursor: not-allowed;
        }
        .pagination .prev:disabled,
        .pagination .next:disabled {
            background: #e0e0e0;
            color: #ccc;
            cursor: not-allowed;
        }
        .pagination .page-item {
            display: inline-block;
        }
        .pagination .page-item .page-link {
            display: inline-block;
            padding: 8px 16px;
        }
        .out-of-stock-label {
            position: absolute;
            top: 18px;
            left: -1.5px;
            background: rgba(255, 0, 0, 0.8);
            color: white;
            font-weight: bold;
            font-size: 12px;
            padding: 4px 12px;
            transform: rotate(-20deg);
            z-index: 2;
            text-transform: uppercase;
            box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2);
        }
        .add-to-cart-btn:disabled {
            background: #ccc;
            cursor: not-allowed;
            border: 2px solid rgb(236, 151, 164);
            color: #666;
        }
        /* Not Found Section */
        .not-found-container {
            text-align: center;
            padding: 40px 20px;
            background-color: #f8f8f8;
            border: 1px solid #ddd;
            border-radius: 8px;
            margin: 40px auto;
            max-width: 500px;
            height: 220px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        }
        .not-found-container h1 {
            font-size: 32px;
            color: #d9534f;
            margin-bottom: 20px;
        }
        .not-found-container p {
            font-size: 18px;
            color: #333;
            margin-bottom: 30px;
        }
        .not-found-container a {
            text-decoration: none;
        }
        .not-found-container button {
            background-color: #F070BB;
            color: #fff;
            padding: 12px 24px;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .not-found-container button:hover {
            background-color: #cc5a9d;
        }
    </style>
</head>
<body>
    {{-- Include Navigation --}}
    @include('layouts.navigation')
    <div class="shop-page">
        @if($products->isEmpty())
            <div class="not-found-container">
                <h2 class="search-results-heading">Search Results for "{{ $search }}"</h2>
                <h1>Oops!</h1>
                <p>No products found matching "{{ $search }}".</p>
                <a href="{{ route('user.shop') }}">
                    <button type="button">Go to Shop</button>
                </a>
            </div>
        @else
            <div class="container">
                {{-- Sidebar --}}
                <aside class="sidebar">
                    {{-- Brands --}}
                    <div class="filter-box">
                        <h3>Available Brands</h3>
                        <ul>
                            @foreach($brands as $brand)
                                <li>{{ $brand->brand_name }}</li>
                            @endforeach
                        </ul>
                    </div>
                    <br>
                    <hr>
                    {{-- Categories --}}
                    <div class="filter-box">
                        <h3>Categories</h3>
                        <ul>
                            @foreach($categories as $category)
                                <li>{{ $category->category_name }}</li>
                            @endforeach
                        </ul>
                    </div>
                </aside>
                {{-- Product Section --}}
                <section class="product-section">
                    {{-- Sorting Controls --}}
                    <div class="sorting-container">
                        <p class="explore-text">Explore Our Product</p>
                        <div class="sorting">
                            <label for="sort">Sort by price:</label>
                            <select id="sort" name="sort" onchange="applySort()">
                                <option value="default" {{ $sort == 'default' ? 'selected' : '' }}>Default</option>
                                <option value="price-asc" {{ $sort == 'price-asc' ? 'selected' : '' }}>Price: Low to High
                                </option>
                                <option value="price-desc" {{ $sort == 'price-desc' ? 'selected' : '' }}>Price: High to Low
                                </option>
                            </select>
                        </div>
                    </div>
                    {{-- Product Grid --}}
                    <div class="product-list">
                        @foreach($products as $product)
                            <div class="product-item">
                                <a href="{{ route('user.productDetails.show', ['id' => $product->id]) }}">
                                    @if($product->stock_status === 'outofstock')
                                        <div class="out-of-stock-label">Out of Stock</div>
                                    @endif
                                    <img src="{{ asset($product->image) }}" alt="Product Image">
                                </a>
                                <h4>{{ $product->brand->brand_name }}</h4>
                                <p>{{ $product->product_name }}</p>
                                <p>Rs. {{ number_format($product->sale_price, 0) }}</p>
                                {{-- Add to Cart Form --}}
                                <form name="addtocart-form" method="POST" action="{{ route('cart.add') }}">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $product->id }}">
                                    <input type="hidden" name="quantity" value="1">
                                    <input type="hidden" name="name" value="{{ $product->product_name }}">
                                    <input type="hidden" name="price"
                                        value="{{ $product->sale_price ?: $product->regular_price }}">
                                    <button class="add-to-cart-btn" {{ $product->stock_status === 'outofstock' ? 'disabled' : '' }}>
                                        Add to Cart
                                    </button>
                                </form>
                                {{-- Wishlist Form --}}
                                <form action="{{ route('wishlist.add', $product->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="wishlist-btn">
                                        <i class="fa fa-heart-o"></i>
                                    </button>
                                </form>
                            </div>
                        @endforeach
                    </div>
        @endif
                {{-- Pagination --}}
                <div class="pagination">
                    {{ $products->appends(request()->query())->links('pagination::bootstrap-5') }}
                </div>
            </section>
        </div>
    </div>
    {{-- Include Footer --}}
    @include('layouts.footer')
    <script>
        function applySort() {
            let sortValue = document.getElementById('sort').value;
            let searchValue = "{{ request('search') }}";
            let url = new URL(window.location.href);
            url.searchParams.set('sort', sortValue);
            if (searchValue) {
                url.searchParams.set('search', searchValue);
            }
            window.location.href = url.toString();
        }
    </script>
</body>
</html>
