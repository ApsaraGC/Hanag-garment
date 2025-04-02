<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart - Hanag's Garments</title>
    <!-- Include SweetAlert2 from CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
      body { font-family: Arial, sans-serif; margin: 0; padding: 0; }
.cart-container { display: flex; flex-wrap: wrap; padding: 20px; gap: 20px; }
.cart-items, .cart-totals { background: #fff; border: 1px solid #ddd; padding: 20px; border-radius: 5px; }
.cart-items { flex: 2; } .cart-items h2 { color: #F070BB; text-align: center; font-size: 30px; }
.cart-totals { flex: 1; max-width: 400px; border: 1.5px solid #F070BB; }
table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
th, td { text-align: left; padding: 10px; border-bottom: 1px solid #F070BB; }
.cart-items img { width: 80px; border-radius: 5px; }
.product-info { display: flex; align-items: center; gap: 10px; }
.product-details { display: flex; flex-direction: column; }
.update-btn, .checkout-btn { display: inline-block; padding: 10px 20px; text-align: center; color: #fff; border-radius: 5px; margin: 10px 0; background: #F070BB; text-decoration: none; }
.checkout-btn { display: block;  }
.quantity-selector { display: flex; align-items: center; justify-content: center; }
.quantity-selector input { text-align: center; border: 1px solid #ddd; width: 40px; height: 30px; margin: 0 5px; }
.cart-totals .totals-row { display: flex; justify-content: space-between; margin-bottom: 10px; }
.payment-method { margin-top: 10px; }
input[type="checkbox"] { background-color: #4CAF50; border: 1px solid #F070BB; width: 16px; height: 16px; border-radius: 3px; outline: none; cursor: pointer; }
.btn-danger, .btn-light { color: white; border: none; padding: 8px 16px; border-radius: 5px; cursor: pointer; transition: background-color 0.3s, box-shadow 0.3s; }
.btn-danger { background-color: #E63946; } .btn-danger:hover { background-color: #D62828; box-shadow: 0 0 8px rgba(230, 57, 70, 0.4); }
.btn-light { background-color: #F070BB; margin-left: 630px; } .btn-light:hover { background-color: #da2424; box-shadow: 0 0 8px rgba(240, 112, 187, 0.4); }
.swal-popup-small { font-size: 14px; border-radius: 10px; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2); padding: 5px 20px; display: flex; justify-content: center; align-items: center; overflow: hidden; }
.empty-cart { display: flex; flex-direction: column; align-items: center; justify-content: center; text-align: center; height: 80vh; padding: 5px; }
.empty-cart img { max-width: 700px; opacity: 0.9; margin-left: 310px; }
.empty-cart h1, .empty-cart p, .empty-cart .btn { margin-left: 270px; }
.empty-cart h1 { font-size: 32px; font-weight: bold; color: #333; margin-bottom: 5px; }
.empty-cart p { font-size: 20px; color: #666; margin-bottom: 20px; text-decoration: none; }
.empty-cart .btn { display: inline-block; padding: 10px 20px; background-color: #F070BB; color: #fff; font-weight: bold; text-align: center; border-radius: 5px; transition: background-color 0.3s ease; }
.empty-cart .btn:hover { background-color: #e62fa0; }

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
                <h2>Cart Totals</h2>
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
                <form method="POST" action="{{ route('cart.checkout') }}">
                    @csrf
                    <div class="payment-method">
                        <p>Payment Method</p>
                        <label>
                            <input type="checkbox" name="payment_method[]" value="esewa" id="esewa">
                            eSewa
                        </label>
                        <br>
                        <label>
                            <input type="checkbox" name="payment_method[]" value="cod" id="cod">
                            COD
                        </label>
                    </div>

                    <a id="checkout-link" href="#" class="checkout-btn">Proceed to Checkout</a>
                </form>
                <!-- eSewa Payment Form -->
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
    </div>
    <!-- Include Footer -->
    @include('layouts.footer')
</body>
<script>
    document.getElementById('checkout-link').addEventListener('click', function (e) {
        e.preventDefault(); // Prevent the default anchor click behavior

        // Check if eSewa is selected
        const isEsewaSelected = document.getElementById('esewa').checked;
        // Check if COD is selected
        const isCODSelected = document.getElementById('cod').checked;

        // Prevent both payment methods from being selected at the same time
        if (isEsewaSelected && isCODSelected) {
            Swal.fire({
                icon: 'warning',
                title: 'Please select only one payment method',
                showConfirmButton: true
            });
            return;
        }
        if (isEsewaSelected) {
            // If eSewa is selected, check if the user is logged in
            @auth
                // Redirect to eSewa payment page
                window.location.href = "{{route('user.esewa.payment')}}";
            @else
                // If not logged in, redirect to login page
                window.location.href = "{{ route('login') }}";
            @endauth
    } else if (isCODSelected) {
            // If COD is selected, proceed with generating invoice
            window.location.href = "{{ route('user.invoice') }}";
        } else {
            // If neither is selected, show a SweetAlert or an alert
            Swal.fire({
                icon: 'warning',
                title: 'Please select a payment method',
                showConfirmButton: true
            });
        }
    });

    // Disable the other checkbox when one is selected
    document.getElementById('esewa').addEventListener('change', function () {
        if (this.checked) {
            document.getElementById('cod').disabled = true; // Disable COD
        } else {
            document.getElementById('cod').disabled = false; // Enable COD
        }
    });

    document.getElementById('cod').addEventListener('change', function () {
        if (this.checked) {
            document.getElementById('esewa').disabled = true; // Disable eSewa
        } else {
            document.getElementById('esewa').disabled = false; // Enable eSewa
        }
    });
</script>
<!-- Add this script to update the quantity dynamically -->

</html>
