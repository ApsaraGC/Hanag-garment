<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart - Hanag's Garments</title>
    <!-- Include SweetAlert2 from CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet"> <!-- Font Awesome CDN -->

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .cart-container {
            display: flex;
            flex-wrap: wrap;
            padding: 30px;
            gap: 10px;
            max-width: 400px;
            margin-left: 190px;


        }

        .cart-items, .cart-totals {
            background: #fff;
            border: 1px solid #ddd;
            padding: 20px;
            border-radius: 5px;
        }

        .cart-items {
            flex: 2;
        }
        .cart-items h2{
            color: #F070BB;
            text-align: center;
            font-size: 30px;

        }

        .cart-totals {
            flex: 1;
            border: 1.5px solid  #F070BB;
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

        .update-btn, .checkout-btn {
            display: inline-block;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            color: #fff;
            border-radius: 5px;
            margin: 10px 0;
        }

        .update-btn {
            background: #F070BB;
        }







    /* Clear All Cart Button */
    .btn-light {
        background-color: #F070BB;
        color: white;
        border: none;
        width:140px;
        padding: 8px 12px;
        border-radius: 5px;
        margin: 0 0 0 630px;  /* Centers it horizontally */
        cursor: pointer;
        transition: background-color 0.3s, box-shadow 0.3s;
    }
    .btn-light:hover {
        background-color: #da2424;
        box-shadow: 0 0 8px rgba(240, 112, 187, 0.4);
    }
    .swal-popup-small {
    font-size: 14px;  /* Adjust the font size */
    border-radius: 10px;  /* Round corners */
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);  /* Optional: Add shadow */
    padding: 5px 20px;  /* Decrease the padding to make it more compact */
    display: flex;
    justify-content: center;
    align-items: center;
    overflow: hidden;  /* Hide overflow if content exceeds the set height */
}

.empty-cart {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    text-align: center;

    height: 80vh; /* Adjust height to center properly */
    padding: 5px;
}

.empty-cart img {
    max-width: 800px; /* Larger image */
    opacity: 0.9;

}

.empty-cart h1 {
    font-size: 32px;
    font-weight: bold;
    color: #333;
    margin-right: 90px;

    margin-bottom: 5px;
}

.empty-cart p {
    font-size: 20px;
    color: #666;
    margin-right: 90px;

    margin-left: 0px;
    margin-bottom: 20px;
    text-decoration: none;
}

.empty-cart .btn {
    display: inline-block;
        padding: 10px 20px;
        background-color: #F070BB;
        color: #fff;
        text-decoration: none;
        font-weight: bold;
        text-align: center;
        margin-right: 90px;
        border-radius: 5px;
        transition: background-color 0.3s ease;
}

.empty-cart .btn:hover {
    background-color: #e62fa0;
}
.add-to-cart {
        color: white;
        padding: 8px 16px;
        transition: background-color 0.3s, box-shadow 0.3s;
    background: #F070BB;
    color: #fff;
    font-weight: bold;

    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
    margin-top: 20px;
}

.add-to-cart:hover {
    background: #D55B9D;
}

.add-to-cart i {
    margin-right: 5px;
    font-size: 12px;
}

.out-of-stock {
    background-color: #ff3333;
    color:#fff;
    font-weight: bold;

    font-size: 14px;
    width:100px;
    border-radius: 5px;

    margin-right: 15px;
    text-align: center;
    padding: 8px;
}


    </style>
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
            <h2>Wishlist</h2>
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
                        <td>Rs. {{ $item->product->sale_price }}</td>
                        <td>
                            <div class="product-actions" style="display: flex; align-items: center; gap: 10px;">
                                <!-- Remove from Wishlist Form (Icon Only) -->
                                <form action="{{ route('wishlist.remove', $item->product->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" style="border: none; background: transparent; padding: 5px; margin-top: 15px;">
                                        <i class="fas fa-times" style="font-size: 20px; color: red;"></i>
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
                                        <button type="submit" class="add-to-cart" style="border: none; background: transparent; padding: 0;">
                                            <i class="fas fa-cart-plus" style="font-size: 20px; color: #F070BB;"></i>
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
            <form action="{{ route('wishlist.clear') }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-light">Clear All Wishlist</button>
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

    <!-- Include Footer -->
    @include('layouts.footer')
</body>
</html>
