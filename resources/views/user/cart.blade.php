<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart - Hanag's Garments</title>
    <script src="https://khalti.s3.ap-south-1.amazonaws.com/KPG/dist/2020.12.17.0.0.0/khalti-checkout.iffe.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://khalti.com/static/khalti-checkout.js"></script>
    <script src="https://cdn.khalti.com/payment/gateway.js"></script>
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

        .cart-items,
        .cart-totals {
            background: #fff;
            border: 1px solid #ddd;
            padding: 20px;
            border-radius: 5px;
        }

        .cart-items {
            flex: 2;
        }

        .cart-items h2 {
            color: #F070BB;
            text-align: center;
            font-size: 30px;
        }

        .cart-totals {
            flex: 1;
            max-width: 400px;
            border: 1.5px solid #F070BB;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th,
        td {
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

        .update-btn,
        .checkout-btn {
            display: inline-block;
            padding: 10px 20px;
            text-align: center;
            color: #fff;
            border-radius: 5px;
            margin: 10px 0;
            background: #F070BB;
            text-decoration: none;
        }

        .checkout-btn {
            display: block;
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
            background-color: #4CAF50;
            border: 1px solid #F070BB;
            width: 16px;
            height: 16px;
            border-radius: 3px;
            outline: none;
            cursor: pointer;
        }

        .btn-danger,
        .btn-light {
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

        .btn-light {
            background-color: #E63946;
            margin-left: 630px;
        }

        .btn-light:hover {
            background-color: #da2424;
            box-shadow: 0 0 8px rgba(240, 112, 187, 0.4);
        }

        .swal-popup-small {
            font-size: 14px;
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
            padding: 5px 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
        }

        .empty-cart {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            height: 80vh;
            padding: 5px;
        }

        .empty-cart img {
            max-width: 700px;
            opacity: 0.9;
            margin-left: 310px;
        }

        .empty-cart h1,
        .empty-cart p,
        .empty-cart .btn {
            margin-left: 270px;
            text-decoration: none;
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
            text-decoration: none;
        }

        .empty-cart .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #F070BB;
            color: #fff;
            font-weight: bold;
            text-align: center;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .empty-cart .btn:hover {
            background-color: #e62fa0;
        }

        .address-section h4 {
            color: #F070BB;
            margin-bottom: 10px;
        }

        .address-section .form-group {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        .address-section .form-group input[type="text"] {
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 5px;
            flex-grow: 1;
            margin-right: 10px;
        }

        .address-section .form-group button.save-btn {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 8px 12px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            transition: background-color 0.3s;

        }

        .address-section .form-group button.save-btn:hover {
            background-color: #45a049;
        }
        .size{
            font-size: 12px;
        padding: 8px;
        border-radius: 5px;
        border: 1px solid #ddd;
        background-color: #f8f8f8;
        cursor: pointer;
        transition: border-color 0.3s ease, background-color 0.3s ease;
        margin-bottom: 10px;
        }
        .size:focus {
        outline: none;
        border-color: #f693d5;
        background-color: #eaf2ff;
    }

    .size option {
        font-size: 14px;
        padding: 8px;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .size {
            max-width: 100%;
        }
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
    @if(session('message'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Sorry!',
                text: '{{ session('message') }}',
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
    <div class="cart-container">
        @if($cartItems->count() > 0)
            <!-- Cart Items -->
            <div class="cart-items">
                <h2>Cart</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>UnitPrice</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cartItems as $item)
                            <tr>
                                <td>
                                    <div class="product-info">
                                        <img src="{{ asset($item->product->image) }}" alt="Product">
                                        <div class="product-details">
                                            <p><strong>{{ $item->product->product_name }}</strong></p>
                                            <p>Color: {{ $item->product->color ?? 'N/A' }}</p>
                                            {{-- <p>Size: {{ $item->product->size ?? 'N/A' }}</p> --}}
 <!-- Size Drop-down for Cart -->
 <form action="{{ route('cart.update.size', ['productId' => $item->product->id]) }}" method="POST">
    @csrf
    <label for="size">Size: </label>
    <select name="size" onchange="this.form.submit()" class="size">
        @php
            $sizes = explode(',', $item->product->size);
        @endphp
        @foreach ($sizes as $size)
            <option value="{{ trim($size) }}"
                {{ $item->size == trim($size) ? 'selected' : '' }}>
                {{ trim($size) }}
            </option>
        @endforeach
    </select>
</form>
                                        </div>
                                    </div>
                                </td>
                                <td>Rs. {{ $item->product->sale_price }}</td>
                                <td>
                                    <div class="quantity-selector">
                                        <!-- Form for decreasing the quantity -->
                                        <!-- Decrease Button -->
                                        <form method="POST"
                                            action="{{ route('cart.qty.decrease', ['productId' => $item->product->id]) }}">
                                            @csrf
                                            <button type="submit" class="btn btn-link">-</button>
                                        </form>

                                        <!-- Display current quantity -->
                                        <input type="text" value="{{ $item->quantity }}" readonly
                                            style="border: none; width: 40px; text-align: center;">
                                        <!-- Increase Button -->
                                        <form method="POST"
                                            action="{{ route('cart.qty.increase', ['productId' => $item->product->id]) }}">
                                            @csrf
                                            <button type="submit" class="btn btn-link">+</button>
                                        </form>
                                    </div>
                                </td>
                                <td id="subtotal-{{ $item->product->id }}" class="product-subtotal">
                                    Rs. {{ number_format($item->product->sale_price * $item->quantity, 2) }}
                                </td>
                                <td>
                                    <form action="{{ route('cart.remove', ['productId' => $item->product->id]) }}"
                                        method="POST">
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

                <h2 style="color: #F070BB; text-align: center;">Cart Totals</h2>
                <div class="address-section">
                    <h4>Shipping Address</h4>
                    <form action="{{ route('update.address') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <input type="text" id="address" name="address" value="{{ Auth::user()->address ?? '' }}"
                                placeholder="Enter your new address" required>
                            <button type="submit" class="save-btn">Save</button>
                        </div>
                    </form>

                </div>
                <div class="totals-row">
                    <span>Subtotal</span>
                    <span>Rs. {{ number_format($subtotal, 2) }}</span>
                </div>
                <hr>
                <div class="totals-row">
                    <span>
                        Delivery Charge<br>

                        <small style="color: gray; font-size: 12px;">
                            (Max Rs.150) - Varies by location, <br>extra will be refunded if nearby.
                        </small>

                    </span>
                    <span>Rs. {{ number_format($deliveryCharge, 2) }}</span>

                </div>



                <hr>
                <div class="totals-row">
                    <span>Total</span>
                    <span>Rs. {{ number_format($total, 2) }}</span>
                </div>
                <hr>
                <form id="checkout-form" method="POST" action="{{ route('user.placeOrder') }}">
                    @csrf
                    <div class="payment-method">
                        <p>Payment Method</p>
                        <!-- Khalti Payment Method -->
                        <label>
                            <input type="checkbox" name="payment_method" value="khalti" id="khalti"> Khalti
                        </label>
                        <label name="payment_method" value="" id="esewa">
                            {{-- < type="" name="payment_method" value="" id="esewa"> --}}
                        </label><br>
                        <label>
                            <input type="checkbox" name="payment_method" value="cod" id="cod">
                            COD<span style="font-size: 12px; color:#666; margin-bottom: 5px;"> (Inside Pokhara valley
                                only)</span>
                        </label>
                    </div>
                    <a id="checkout-link" href="#" class="checkout-btn">Proceed to Checkout</a>
                </form>

            </div>
        @else
            <div class="row">
                <div class="col-md-12 d-flex justify-content-center">
                    <div class="empty-cart">
                        <img src="{{ asset('images/brands/empty-cart.png') }}" alt="Empty Cart">
                        <h1>Your Cart is Empty</h1>
                        <p>Add something to make me happy :)</p>
                        <a href="{{ route('user.shop') }}" class="btn btn-info">Shop Now</a>
                    </div>
                </div>
            </div>
        @endif

        {{-- @php
        $publicKeyFromConfig = config('services.khalti.live_public_key');
        dd($publicKeyFromConfig); // Script will stop here and show the key
        @endphp --}}

    </div>

    <!-- Include Footer -->
    @include('layouts.footer')

</body>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const checkoutLink = document.getElementById('checkout-link');
        const checkoutForm = document.getElementById('checkout-form');
        const khaltiCheckbox = document.getElementById('khalti');
        const codCheckbox = document.getElementById('cod');

        checkoutLink.addEventListener('click', function (event) {
            event.preventDefault(); // Prevent the default link behavior

            let selectedPayment = null;
            let isChecked = false;

            // Check which payment method is selected
            if (khaltiCheckbox.checked) {
                selectedPayment = 'khalti';
                isChecked = true;
            } else if (codCheckbox.checked) {
                selectedPayment = 'cod';
                isChecked = true;
            }

            if (isChecked) {
                // Create a hidden input for the payment method
                const paymentMethodInput = document.createElement('input');
                paymentMethodInput.setAttribute('type', 'hidden');
                paymentMethodInput.setAttribute('name', 'payment_method');
                paymentMethodInput.setAttribute('value', selectedPayment);
                checkoutForm.appendChild(paymentMethodInput);

                // Submit the form to the placeOrder route
                fetch(checkoutForm.action, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: new URLSearchParams(new FormData(checkoutForm)).toString()
                })
                .then(response => response.json())
                .then(data => {
                    if (selectedPayment === 'khalti' && data.order_id && data.amount) {
                        const amountInPaisa = Math.trunc(data.amount); // Ensure this is echoed correctly
                        // Redirect to Khalti initiation route with amount in paisa
                        window.location.href = `/khalti/initiate?order_id=${data.order_id}&amount=${amountInPaisa}`;
                    } else if (selectedPayment === 'cod' && data.redirect_url) {
                        // Redirect to COD payment page or process as needed
                        window.location.href = data.redirect_url;
                    } else {
                        alert('Failed to process order.');
                    }
                })
                .catch(error => {
                    console.error('Error placing order:', error);
                    alert('An error occurred while placing your order.');
                });
            } else {
                alert('Please select a payment method.');
            }
        });

        // Ensure only one payment method is checked at a time
        const paymentCheckboxes = document.querySelectorAll('input[name="payment_method"]');
        paymentCheckboxes.forEach(checkbox => {
            checkbox.addEventListener('change', function () {
                paymentCheckboxes.forEach(otherCheckbox => {
                    if (otherCheckbox !== this) {
                        otherCheckbox.checked = false;
                    }
                });
            });
        });
    });
    </script>
</html>
