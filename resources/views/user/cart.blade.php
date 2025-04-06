<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart - Hanag's Garments</title>
    <script src="https://khalti.s3.ap-south-1.amazonaws.com/KPG/dist/2020.12.17.0.0.0/khalti-checkout.iffe.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">

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
            background-color: #F070BB;
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
    <div class="cart-container">
        @if($cartItems->count() > 0)
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
                        @foreach ($cartItems as $item)
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
                                        <!-- Display Available Stock -->
                                        <!-- Form for increasing the quantity -->
                                        <!-- Increase Button -->
                                        <form method="POST"
                                            action="{{ route('cart.qty.increase', ['productId' => $item->product->id]) }}">
                                            @csrf
                                            <button type="submit" class="btn btn-link">+</button>
                                        </form>
                                    </div>
                                </td>
                                <td id="subtotal-{{ $item->product->id }}" class="product-subtotal">
                                    Rs. {{ $item->product->sale_price * $item->quantity }}
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
                    <span>Delivery Charge</span>
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
                        <br>
                        <label>
                            <input type="checkbox" name="payment_method" value="esewa" id="esewa">
                            eSewa
                        </label><br>
                        <label>
                            <input type="checkbox" name="payment_method" value="cod" id="cod">
                            COD<span style="font-size: 12px; color:#666; margin-bottom: 5px;"> (Inside Pokhara value
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
    <form id="esewa-payment-form" action="https://epay.esewa.com.np/api/epay/main/v2/form" method="POST"
        style="display: none;">
        <input type="hidden" name="amt" id="esewa-amt">
        <input type="hidden" name="pdc" value="0">
        <input type="hidden" name="psc" value="0">
        <input type="hidden" name="txAmt" value="0">
        <input type="hidden" name="tAmt" id="esewa-tAmt">
        <input type="hidden" name="pid" id="esewa-pid">
        <input type="hidden" name="scd" value="{{ config('app.esewa_client_id') }}">
        <input type="hidden" name="su" id="esewa-su" value="{{ route('esewa.success') }}">
        <input type="hidden" name="fu" id="esewa-fu" value="{{ route('esewa.failure') }}">
    </form>
    <!-- Include Footer -->
    @include('layouts.footer')
    <script src="https://khalti.com/static/khalti-checkout.js"></script>

</body>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const checkoutLink = document.getElementById('checkout-link');
        const checkoutForm = document.getElementById('checkout-form');
        const khaltiCheckbox = document.getElementById('khalti');
        const esewaCheckbox = document.getElementById('esewa');
        const codCheckbox = document.getElementById('cod');

        // Disable other payment methods on selection
        [khaltiCheckbox, esewaCheckbox, codCheckbox].forEach(checkbox => {
            checkbox.addEventListener('change', function () {
                if (this.checked) {
                    [khaltiCheckbox, esewaCheckbox, codCheckbox].forEach(cb => {
                        if (cb !== this) cb.disabled = true;
                    });
                } else {
                    [khaltiCheckbox, esewaCheckbox, codCheckbox].forEach(cb => cb.disabled = false);
                }
            });
        });

        // Khalti config
        var khaltiConfig = {
            publicKey: "test_public_key_dc74d69a62ec4fbb9a615e6c38038bd1",
            productIdentity: "1234567890",
            productName: "Hanag’s Garment",
            productUrl: "http://yourwebsite.com/product",
            eventHandler: {
                onSuccess(payload) {
                    console.log("Khalti payment success:", payload);

                    // Send to server for verification
                    fetch("{{ route('khalti.payment.verify') }}", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": "{{ csrf_token() }}"
                        },
                        body: JSON.stringify({
                            token: payload.token,
                            amount: "{{ $total * 100 }}" // Ensure this is echoed correctly
                        })
                    })
                    .then(res => res.json())
                    .then(data => {
                        if (data.success) {
                            Swal.fire("Payment Successful", "Order placed!", "success").then(() => {
                                window.location.href = "{{ route('user.orderBill', ['orderId' => ':orderId']) }}".replace(':orderId', data.order_id);
                            });
                        } else {
                            Swal.fire("Payment Failed", "Something went wrong", "error");
                        }
                    })
                    .catch(err => {
                        console.error("Verification error:", err);
                        Swal.fire("Error", "Verification failed", "error");
                    });
                },
                onError(error) {
                    console.log("Khalti error:", error);
                    Swal.fire("Error", "Payment failed", "error");
                },
                onClose() {
                    console.log("Khalti popup closed.");
                }
            }
        };

        var khaltiCheckout = new KhaltiCheckout(khaltiConfig);

        // Proceed button click
        checkoutLink.addEventListener('click', function (e) {
            e.preventDefault();

            const selectedMethods = [khaltiCheckbox, esewaCheckbox, codCheckbox].filter(cb => cb.checked);
            if (selectedMethods.length !== 1) {
                Swal.fire("Select one payment method", "", "warning");
                return;
            }

            if (khaltiCheckbox.checked) {
                const amountInPaisa = "{{ $total * 100 }}";  // Corrected this line
                khaltiCheckout.show({ amount: amountInPaisa });
            } else if (codCheckbox.checked) {
                checkoutForm.submit();
            } else {
                Swal.fire("Unsupported method", "", "error");
            }
        });
    });
</script>

</html>
