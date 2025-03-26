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
            margin: 0;
            padding: 0;
        }

        .cart-container {
            display: flex;
            flex-wrap: wrap;
            padding: 20px;
            gap: 20px;

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
            max-width: 400px;
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

        .checkout-btn {
            background: #F070BB;
            display: block;
            text-align: center;
        }

        .quantity-selector {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .quantity-selector input {
            text-align: center;
            border: 1px solid #ddd;
            width: 40px;
            height: 30px;
            margin: 0 5px;
        }

        .cart-totals .totals-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }

        .payment-method {
            margin-top: 10px;

        }
        input[type="checkbox"] {
    border: 1px solid #F070BB;
    width: 16px; /* Optional: Adjust size if needed */
    height: 16px; /* Optional: Adjust size if needed */
    border-radius: 3px; /* Optional: Add a slight rounding for aesthetics */
    appearance: none; /* Removes default styling */
    outline: none; /* Removes outline on focus */
    cursor: pointer;
}
/* General Button Styling */

    /* Remove Button */
    .btn-danger {
        background-color: #E63946;
        color: white;
        border: none;
        padding: 8px 16px;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s, box-shadow 0.3s;
    }
    .btn-danger:hover {
        background-color: #D62828;
        box-shadow: 0 0 8px rgba(230, 57, 70, 0.4);
    }

    /* Clear All Cart Button */
    .btn-light {
        background-color: #F070BB;
        color: white;
        border: none;
        padding: 8px 16px;
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
            width: '350px',  // Adjust width as needed
            padding: '5px', // Optional: Adjust padding
            customClass: {
                popup: 'swal-popup-small'
            }
        });
    </script>
@endif





    {{-- @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif --}}

    <div class="cart-container">
        @if($items->count() > 0)
        <!-- Cart Items -->
        <div class="cart-items">
            <h2>Cart</h2>
            <table>
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Subtotal</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($items as $item)
                    <tr>
                        <td>
                            <div class="product-info">
                                <img src="{{ asset('build/assets/images/products/'.$item->model->image) }}" alt="Product">
                                <div class="product-details">
                                    <p><strong>{{ $item->name }}</strong></p>
                                    <p>Color: {{ $item->model->color ?? 'N/A' }}</p>
                                    <p>Size: {{ $item->model->size ?? 'N/A' }}</p>
                                </div>
                            </div>
                        </td>
                        <td>Rs. {{ $item->price }}</td>
                        <td>
                            <div class="quantity-selector">
                                <!-- Form for decreasing the quantity -->
                                <form method="POST" action="{{ route('cart.qty.decrease', ['rowId' => $item->rowId]) }}">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-link">-</button>
                                </form>

                                <!-- Input for quantity -->
                                <input type="number" name="quantity" value="{{ $item->qty }}" min="1" class="qty-control__number text-center" disabled>

                                <!-- Form for increasing the quantity -->
                                <form method="POST" action="{{ route('cart.qty.increase', ['rowId' => $item->rowId]) }}">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-link">+</button>
                                </form>
                            </div>
                        </td>

                        <td>Rs. {{ $item->subtotal }}</td>
                        <td>
                            <form action="{{ route('cart.remove', $item->rowId) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Remove</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <form action="{{ route('cart.empty') }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-light">Clear All Cart</button>
            </form>

        </div>

        <!-- Cart Totals -->
        <div class="cart-totals">
            <h2>Cart Totals</h2>
            <div class="totals-row">
                <span>Subtotal</span>
                <span>Rs. {{ number_format($subtotal, 2) }}</span>
            </div>
            <hr>
            <div class="totals-row">
                <span>Delivery Charge</span>
                <span>Rs. {{ number_format($deliveryCharge, 2) }}</span>            </div>

            <hr>
            <div class="totals-row">
                <span>Total</span>
                <span>Rs. {{ number_format($total, 2) }}</span>
            </div>

            <hr>
            <div class="payment-method">
                <p>Payment Method</p>
                <label><input type="checkbox"> eSewa</label>
                <br>
                <label><input type="checkbox"> </label>
            </div>
            <a href="{{ Auth::check() ? route('user.payment') : route('login') }}" class="checkout-btn">Proceed to Checkout</a>

            {{-- <a href="{{ route('user.payment') }}" class="checkout-btn">Proceed to Checkout</a> --}}
        </div>
        @else
        <div class="row">
            <div class="col-md-12 text-center pt-5 bp-5">
                <p>No item found in your cart</p>
                <a href="{{ route('user.shop') }}" class="btn btn-info">Shop Now</a>
            </div>
        </div>
        @endif
    </div>

    <!-- Include Footer -->
    @include('layouts.footer')
</body>


</html>
