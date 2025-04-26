<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart - Hanag's Garments</title>
    <!-- Include SweetAlert2 from CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body {
            font-family: Arial, sans-serif;

            background-color: #f4f4f9;
        }

        .cart-container {
            display: flex;
            flex-wrap: wrap;
            padding: 30px;
            gap: 20px;
            max-width: 1000px;
            margin: 0 auto;
            margin-top: 20px; /* Adjust the margin to move the cart up */

        }
        .cart-items, .cart-totals {
            background: #fff;
            border: 1px solid #ddd;
            padding: 20px;
            border-radius: 5px;
        }

        .cart-items {
            flex: 2;
            width: 70%;
        }

        .cart-items h2 {
            color: #F070BB;
            text-align: center;
            font-size: 30px;
            border-bottom: 2px solid #F070BB;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .cart-totals {
            flex: 1;
            width: 30%;
            border: 1.5px solid  #F070BB;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .cart-totals button {
            margin-top: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            text-align: left;
            padding: 10px;
            border-bottom: 1px solid #F070BB;
        }

        th {
            background-color:  #F070BB;
            font-weight: bold;
            color:white;
        }

        .cart-items img {
            width: 80px;
            border-radius: 5px;
        }

        .product-info {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .product-details {
            display: flex;
            flex-direction: column;
        }

        .remove-btn {
            font-size: 18px;
            background-color: transparent;
            border: none;
            cursor: pointer;
        }

        .remove-btn:hover {
            color: #da2424;
        }

        .btn-danger {
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s, box-shadow 0.3s;
        }

        .btn-danger {
            background-color: #E63946;
        }

        .btn-danger:hover {
            background-color: #D62828;
            box-shadow: 0 0 8px rgba(230, 57, 70, 0.4);
        }

        /* Cart Icon */
        .cart-icon {
            background-color: #f8f8f8;
            border: 1px solid #ddd;
            border-radius: 50%;
            padding: 12px;
            cursor: pointer;
            transition: background-color 0.3s, color 0.3s;
            color: #333;
            margin-top: -10px; /* Adjust this value to move the icon higher */

        }

        /* Cart icon hover effect */
        .cart-icon:hover {
            background-color: #f312a4;
            color: #fff;
        }

        .out-of-stock {
            background-color: #ff3333;
            color: #fff;
            font-weight: bold;
            font-size: 14px;
            width: 100px;
            border-radius: 5px;
            margin-right: 15px;
            text-align: center;
            padding: 8px;
        }

        .wishlist-header {
            text-align: center;
            color: #F070BB;
            font-size: 24px;
            margin-bottom: 15px;
            font-weight: bold;
        }

        .clear-all-btn {
            background-color: #E63946;
            border: none;
            font-weight: bold;
            color:white;
            padding: 8px 15px;
            font-size: 14px;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .clear-all-btn:hover {
            background: #da2424;
        }

        .empty-cart {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            height: 80vh;
            margin-left: 100px;
            padding: 5px;
        }

        .empty-cart img {
            max-width: 900px;
            opacity: 0.9;
        }

        .empty-cart h1 {
            font-size: 32px;
            font-weight: bold;
            color: #333;
            margin-bottom: 5px;
        }

        .empty-cart p {
            font-size: 20px;
            color: #666;
            margin-bottom: 20px;
        }

        .empty-cart .btn {
            display: inline-block;
            padding: 10px 10px;
            background-color: #F070BB;
            color: #fff;
            margin-left: -20px;
            text-decoration: none;
            font-weight: bold;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .empty-cart .btn:hover {
            background-color: #e62fa0;
        }
    </style>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>
<body>
    <!-- Include Navigation -->
    @include('layouts.navigation')

    @if(session('popup_message'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: '{{ session('popup_message') }}',
                timer: 3000,
                showConfirmButton: false,
                width: '350px',
                padding: '5px',
                customClass: {
                    popup: 'swal-popup-small'
                }
            });
        </script>
    @endif

    <div class="cart-container">
        @if($items->count() > 0)
        <!-- Wishlist Items -->
        <div class="cart-items">
            <div class="wishlist-header">
                Your Favorite Products
                {{-- <form action="{{ route('wishlist.clear') }}" method="POST" style="display: inline; float: right;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="clear-all-btn">Clear All Wishlist</button>
                </form> --}}
            </div>
            <table>
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($items as $item)
                    <tr>
                        <td>
                            <div class="product-info">
                                <img src="{{ asset($item->product->image) }}" alt="Product">
                                <div class="product-details">
                                    <p><strong>{{ $item->product->product_name }}</strong></p>
                                    <p>Color: {{ $item->product->color ?? 'N/A' }}</p>
                                    <p>Size: {{ $item->product->size ?? 'N/A' }}</p>
                                </div>
                            </div>
                        </td>
                        <td>    Rs. {{ number_format($item->product->sale_price, 2) }}

                        <td>
                            <div class="product-actions" style="display: flex; align-items: center; gap: 10px;">
                                <!-- Remove from Wishlist Form -->
                                <form action="{{ route('wishlist.remove', $item->product->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="remove-btn">
                                        <button type="submit" class="btn btn-danger">Remove</button>
                                    </button>
                                </form>

                                <!-- Check if product is out of stock -->
                                @if ($item->product->stock_status === 'outofstock')
                                    <!-- Display "Out of Stock" text -->
                                    <p class="out-of-stock">Out of Stock</p>
                                @else
                                    <!-- Add to Cart Form (Icon Only) -->
                                    <form name="addtocart-form" method="post" action="{{route('cart.add')}}" style="display: inline;">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $item->product->id }}">
                                        <input type="hidden" name="quantity" value="1">
                                        <input type="hidden" name="name" value="{{ $item->product->product_name }}">
                                        <input type="hidden" name="price" value="{{ $item->product->sale_price ?: $item->product->regular_price }}">
                                        <button type="submit" style="border: none; background: none; padding: 0; height: 20px;">
                                            <i class="cart-icon fa fa-shopping-cart"></i>
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>

            </table>
            <form action="{{ route('wishlist.clear') }}" method="POST" style="display: inline; float: right;">
                @csrf
                @method('DELETE')
                <button type="submit" class="clear-all-btn">Clear All Wishlist</button>
            </form>
        </div>
        @else
        <div class="empty-cart">
            <img src="{{ asset('images/brands/empty-cart.png') }}" alt="Empty Wishlist">
            <h1>Your Wishlist is Empty</h1>
            <p>Add something to your wishlist :)</p>
            <a href="{{ route('user.shop') }}" class="btn btn-info">Shop Now</a>
        </div>
        @endif
    </div>
</body>
</html>
