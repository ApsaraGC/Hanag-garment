{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
</head>
<body>
    <div class="payment-container">
        <h2>Proceed with Khalti Payment</h2>

        <!-- Display order details -->
        <p>Order ID: {{ $order->id }}</p>
        <p>Total Amount: NPR {{ $amount / 100 }} (Converted from paisa)</p>

        <!-- Khalti Payment Form -->
        <form action="{{ route('khalti.payment.verify') }}" method="POST">
            @csrf
            <input type="hidden" name="order_id" value="{{ $order->id }}">
            <input type="hidden" name="amount" value="{{ $amount }}">

            <!-- Khalti payment token -->
            <input type="hidden" id="khalti-token" name="token" value="{{ $token }}">

            <!-- Trigger Khalti Payment -->
            <button type="button" id="khalti-button">Pay with Khalti</button>
        </form>
    </div>

    <!-- Include Khalti SDK -->
    <script src="https://khalti.com/static/khalti-checkout.js"></script>

    <script>
        var config = {
            "publicKey": "{{ env('KHALTI_LIVE_PUBLIC_KEY') }}", // Your Khalti public key
            "productIdentity": "TestProduct001",
            "productName": "Test Product",
            "productUrl": "https://example.com",
            "eventHandler": {
                onSuccess: function (payload) {
                    // Set the payment token received from Khalti checkout
                    document.getElementById('khalti-token').value = payload.token;
                    // Submit the form to verify the payment
                    document.querySelector('form').submit();
                },
                onError: function (error) {
                    alert("Payment Failed: " + error.message);
                },
                onClose: function () {
                    console.log("Khalti Checkout window closed");
                }
            }
        };

        var checkout = new KhaltiCheckout(config);
        document.getElementById("khalti-button").onclick = function () {
            checkout.show({ amount: {{ $amount }} }); // Amount in paisa
        };
        </script>

</body>
</html> --}}
