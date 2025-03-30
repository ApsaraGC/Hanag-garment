<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>About Us - Hanag's Garments</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
      width: 25%;
      background-color: #fff;
      padding: 20px;
      border-right: 1px solid #ddd;
    }

    .filter-box h3 {
      font-size: 18px;
      margin-bottom: 20px;
      color: #000;
    }

    .filter-box ul {
      list-style-type: none;
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

    /* Product Section Styles */
    .product-section {
      display: flex;
      width: 75%;
      align-items: stretch;
      justify-content: space-between;
      padding: 20px;
      background-color: #fff;
    }

    .product-box {
      display: flex;
      width: 100%;
      align-items: stretch;
    }

    .product-description {
      width: 50%;
      background-color: #f5a9c3;
      padding: 20px;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      height: 340px;
    }

    .product-description h4 {
      font-size: 18px;
      color: #000;
      margin-bottom: 10px;
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
    }

    .product-image {
      width: 45%;
      height: 340px;
      display: flex;
      justify-content: center;
      align-items: center;
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

    /* Uniform Image Size & Centering */
    .product-item img {
      display: block;
      margin: 0 auto 10px auto; /* centers the image horizontally */
      width: 100%; /* Ensures full width within the container */
      height: 220px; /* Fixed height for uniformity */
      object-fit: contain; /* Ensures images fit well without distortion */
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

    /* Adjust 'Add to Cart' button position */
    .add-to-cart-btn {
      display: none;
      position: absolute;
      top: 68%; /* Move button slightly higher */
      left: 50%;
      transform: translate(-50%, -50%);
      background-color: #efaee1;
      color: white;
      padding: 12px 18px;
      font-size: 16px;
      cursor: pointer;
      border: none;
      border-radius: 5px;
      width: 200px; /* Adjust width */
      transition: background-color 0.3s ease;
    }

    /* Show 'Add to Cart' button on hover */
    .product-item:hover .add-to-cart-btn {
      display: block;
    }

    /* Wishlist Button */
    .wishlist-btn {
      background: none;
      border: none;
      padding: 0;
      cursor: pointer;
      position: absolute;
      right: 10px;
      top: 10px;
      color: rgb(229, 20, 20);
      border-radius: 50%;
      padding: 10px;
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

    /* Not Found Section */
    .not-found-container {
      text-align: center;
      padding: 40px 20px;
      background-color: #f8f8f8;
      border: 1px solid #ddd;
      border-radius: 8px;
      margin: 40px auto;
      max-width: 600px;
      box-shadow: 0 2px 6px rgba(0,0,0,0.1);
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

    /* Search Results Heading */
    .search-results-heading {
      text-align: center;
      font-size: 28px;
      font-weight: bold;
      color: #787575;
      margin: 20px 0;
      padding-bottom: 10px;
      /* border-bottom: 2px solid #F070BB; Uncomment if you need an underline */
    }
  </style>
</head>
<body>
  <!-- Include Navigation -->
  @include('layouts.navigation')

  <h2 class="search-results-heading">Search Results for "{{ $search }}"</h2>

  @if($products->isEmpty())
    <div class="not-found-container">
      <h1>Oops!</h1>
      <p>No products found matching "{{ $search }}".</p>
      <a href="{{ route('user.shop') }}">
        <button type="button">Go to Shop</button>
      </a>
    </div>
  @else
    <div class="product-list">
      @foreach($products as $product)
        <div class="product-item">
          <form name="addtocart-form" method="post" action="{{ route('cart.add') }}">
            @csrf
            <input type="hidden" name="id" value="{{ $product->id }}"/>
            <input type="hidden" name="quantity" value="1"/>
            <input type="hidden" name="name" value="{{ $product->product_name }}"/>
            <input type="hidden" name="price" value="{{ $product->sale_price == '' ? $product->regular_price : $product->sale_price }}"/>
            <button class="add-to-cart-btn">Add to Cart</button>
          </form>
          <a href="{{ route('user.productDetails.show', ['id' => $product->id]) }}">
            <img src="{{ asset($product->image) }}" alt="Product Image">
          </a>
          <h4>{{ $product->brand->brand_name }}</h4>
          <p>{{ $product->product_name }}</p>
          <p>Rs. {{ $product->sale_price }}</p>
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
  @endif

  <!-- Include Footer -->
  @include('layouts.footer')
</body>
</html>
