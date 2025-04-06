<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment with Khalti</title>
    <script src="https://khalti.s3.ap-south-1.amazonaws.com/KPG/dist/2020.12.17.0.0.0/khalti-checkout.iffe.js"></script>

    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .payment-container {
            width: 50%;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            background-color: #f9f9f9;
        }
        h2 {
            text-align: center;
        }
        .order-details {
            margin-bottom: 20px;
        }
        .order-details p {
            font-size: 16px;
        }
    </style>
</head>
<body>
    <div class="payment-container">
        <h2>Proceed with Khalti Payment</h2>

        <!-- Display Order Details -->
        <div class="order-details">
            <p><strong>Order ID:</strong> {{ $order->id }}</p>
            <p><strong>Total Amount:</strong> NPR {{ number_format($amount / 100, 2) }} (Converted from paisa)</p>
        </div>

        <!-- Khalti Payment Form -->
        <form action="{{ route('khalti.payment.verify') }}" method="POST">
            @csrf
            <input type="hidden" name="order_id" value="{{ $order->id }}">
            <input type="hidden" name="amount" value="{{ $amount }}">

            <!-- Khalti payment token -->
            <input type="hidden" id="khalti-token" name="token" value="{{ $token }}">

            <!-- Trigger Khalti Payment -->
            <button type="button" id="khalti-button" class="khalti-button">Pay with Khalti</button>
        </form>
    </div>

    <!-- Include Khalti SDK -->
    <script src="https://khalti.com/static/khalti-checkout.js"></script>
    <script>
        // Khalti Checkout configuration
        var config = {
            "publicKey": "{{ env('KHALTI_LIVE_PUBLIC_KEY') }}", // Public Key for Khalti (from .env)
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

        // Initialize Khalti Checkout
        var checkout = new KhaltiCheckout(config);

        // Trigger Khalti Payment on button click
        document.getElementById("khalti-button").onclick = function () {
            checkout.show({ amount: {{ $amount }} }); // Amount in paisa
        };
    </script>
</body>
</html>
