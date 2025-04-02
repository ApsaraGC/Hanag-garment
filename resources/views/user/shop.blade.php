<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Hanag's Garments</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<style>
body { font-family: Arial, sans-serif; margin: 0; overflow-x: hidden; padding: 0; }
.container { display: flex; max-width: 100%; background: #fff; }
.sidebar { width: 20%; background: #fff; padding: 20px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); margin: 23px 0 20px; border-right: 1px solid #ddd; }
.filter-box h3 { font-size: 18px; margin-bottom: 15px; color: #000; }
.filter-box ul { list-style: none; padding: 0; }
.filter-box li { font-size: 16px; margin-bottom: 15px; color: #7a7a7a; cursor: pointer; }
.filter-box li:hover { color: #000; }
.product-section { display: flex; width: 75%; flex-direction: column; padding: 20px; background: #fff; }
.product-box { display: flex; width: 95%; align-items: center; background: #f5a9c3; padding: 20px; border-radius: 10px; }
.product-description { width: 50%; background: #f5a9c3; padding: 20px; display: flex; flex-direction: column; justify-content: center; }
.product-description h4, .product-description h2 { color: #000; margin-bottom: 10px; }
.product-description p { font-size: 14px; color: #333; line-height: 1.5; }
.product-image { width: 45%; height: 340px; display: flex; justify-content: center; align-items: center; position: relative; }
.product-image img { max-height: 100%; width: 100%; object-fit: contain; }
.product-controls { display: flex; justify-content: space-between; align-items: center; margin: 10px 400px 20px; width: 100%; }
.cart-link { font-size: 16px; text-decoration: none; color: #000; }
.cart-link i { margin-left: 30px; }
.sorting { display: flex; justify-content: flex-end; gap: 10px; }
.sorting select, .sorting button { padding: 5px 10px; font-size: 14px; margin-left: 10px; }
.product-list { display: grid; grid-template-columns: repeat(5, 1fr); gap: 18px; padding: 30px;; }
.product-item { text-align: center; border: 0.5px solid #ddd; padding: 10px; background: #fff; position: relative; transition: transform 0.3s; }
.product-item img { width: 100%; height: 210px; object-fit: contain; margin-bottom: 10px; transition: 0.5s ease; background: rgba(0, 0, 0, 0.3); }
.product-item:hover { transform: scale(1.05); }
.add-to-cart-btn { display: none; position: absolute; top: 62%; left: 50%; transform: translate(-50%, -50%); background: transparent; color: #fff; border: 2px solid #eea5a5; padding: 12px 18px; font-size: 16px; border-radius: 5px; width: 209px; transition: 0.3s; }
.product-item:hover .add-to-cart-btn { display: block; background: #ede8e8; color: rgb(236, 151, 164); }
.wishlist-btn { background: none; border: none; padding: 0; cursor: pointer; position: absolute; right: 10px; top: 10px; color: rgb(229, 20, 20); font-size: 18px; }
.prev, .next { display: none; position: absolute; top: 50%; font-size: 20px; color: #575858; padding: 10px; border: none; cursor: pointer; transform: translateY(-50%); }
.prev { left: 10px; }
.next { right: 10px; }
.product-item:hover .prev, .product-item:hover .next { display: block; }
.pagination { text-align: center; margin-top: 20px; }
.pagination a { padding: 8px 15px; margin: 5px; border: 1px solid #ff1493; color: #ff1493; text-decoration: none; border-radius: 50px; font-size: 14px; transition: 0.3s; }
.pagination a:hover, .pagination .active a { background: #ff1493; color: white; font-weight: bold; }
.pagination .disabled a { color: #ccc; cursor: not-allowed; }
.pagination .prev:disabled, .pagination .next:disabled { background: #e0e0e0; color: #ccc; cursor: not-allowed; }
.pagination .page-item { display: inline-block; }
.pagination .page-item .page-link { display: inline-block; padding: 8px 16px; }
.product-image { position: relative; width: 250px; height: 300px; }
.product-image img { width: 100%; height: 100%; object-fit: cover; }
.out-of-stock-label { position: absolute; top: 18px; left: -1.5px; background: rgba(255, 0, 0, 0.8); color: white; font-weight: bold; font-size: 12px; padding: 4px 12px; transform: rotate(-20deg); z-index: 2; text-transform: uppercase; box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2);  }
.add-to-cart-btn:disabled { background: #ccc; cursor: not-allowed; border: 2px solid rgb(236, 151, 164); color: #666; }
 </style>
</head>

<body>
    {{-- Include Navigation --}}
    @include('layouts.navigation')

    <div class="shop-page">
        <div class="container">
            {{-- Sidebar --}}
            <aside class="sidebar">
                <div class="filter-box">
                    <h3>Available Brands</h3>
                    <ul>
                        @foreach($brands as $brand)
                            <li>{{ $brand->brand_name }}</li>
                        @endforeach
                    </ul>
                </div>
            </aside>

            {{-- Product Section --}}
            <section class="product-section">
                <div class="product-box">
                    <div class="product-description">
                        <h4>WOMEN'S</h4>
                        <h2>Garments</h2>
                        <p>
                            Discover trendy, high-quality fashion at budget-friendly prices.
                            Elevate your style with our exclusive collections tailored for you.
                        </p>
                    </div>
                    <div class="product-image">
                        <img src="{{ asset('images/brands/Maroon_3.png') }}" alt="Women's Accessories">
                    </div>
                </div>
            </section>
        </div>

        {{-- Sorting Controls --}}
        <div class="product-controls">
            <div class="sorting">
                <a href="{{ route('dashboard') }}">Home</a> /
                <a href="{{ route('user.shop') }}">Shop</a>

                <label for="sort">Sort by price:</label>
                <select id="sort" name="sort" onchange="location = this.value;">
                    <option value="{{ route('user.shop', ['sort' => 'default']) }}"
                        {{ $sort == 'default' ? 'selected' : '' }}>
                        Default
                    </option>
                    <option value="{{ route('user.shop', ['sort' => 'price-asc']) }}"
                        {{ $sort == 'price-asc' ? 'selected' : '' }}>
                        Price: Low to High
                    </option>
                    <option value="{{ route('user.shop', ['sort' => 'price-desc']) }}"
                        {{ $sort == 'price-desc' ? 'selected' : '' }}>
                        Price: High to Low
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
                        <input type="hidden" name="price" value="{{ $product->sale_price ?: $product->regular_price }}">
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

        {{-- Pagination --}}
        <div class="pagination">
            {{ $products->appends(request()->query())->links('pagination::bootstrap-5') }}
        </div>
    </div>

    {{-- Include Footer --}}
    @include('layouts.footer')

    {{-- JavaScript for Product Image Navigation --}}
    <script>
        document.querySelectorAll('.product-item').forEach(item => {
            const prevButton = item.querySelector('.prev');
            const nextButton = item.querySelector('.next');
            const productImage = item.querySelector('.product-img');

            const images = @json($product->images);
            let currentImageIndex = 0;

            const updateImage = () => {
                productImage.src = "{{ asset('build/assets/images/products/') }}/" + images[currentImageIndex];
            };

            prevButton.addEventListener('click', () => {
                currentImageIndex = currentImageIndex > 0 ? currentImageIndex - 1 : images.length - 1;
                updateImage();
            });

            nextButton.addEventListener('click', () => {
                currentImageIndex = currentImageIndex < images.length - 1 ? currentImageIndex + 1 : 0;
                updateImage();
            });
        });
    </script>
</body>
</html>
