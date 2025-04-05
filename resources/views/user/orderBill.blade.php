<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment - Hanag Garments</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f8f8;
        }

        .payment-container {
            max-width: 450px;
            margin: 40px auto;
            height: 470px;
            padding: 15px;
            background-color: #fff;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            border: 1px solid #ddd;
        }

        .header {
            text-align: center;
            font-size: 22px;
            font-weight: bold;
            color: black;
            margin-bottom: 15px;
        }

        .logo-image {
            display: block;
            margin: 0 auto 20px; /* Center the logo image */
            width: 120px; /* Adjust width as needed */
        }

        .transaction-details {
            background-color: #fafafa;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .transaction-details h3 {
            font-size: 18px;
            margin-bottom: 20px;
            color:#504d4d;
        }

        .transaction-details p {
            display: flex;
            justify-content: space-between;
            font-size: 16px;
            margin: 10px 0;
        }

        .transaction-details p span {
            font-weight: bold;
            color: #333;
        }

        .address-section {
            margin-top: 20px;
            padding: 20px;
            background-color: #f3f3f3;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .address-section h4 {
            font-size: 18px;
            margin-bottom: 15px;
            color: #333;
        }




        /* Responsive Design for smaller screens */
        @media (max-width: 600px) {
            .payment-container {
                width: 90%;
                padding: 15px;
            }

            .header {
                font-size: 18px;
            }

            .transaction-details p {
                font-size: 14px;
            }
        }
    </style>
</head>

<body>
    @include('layouts.navigation')

    <div class="payment-container">
        <form action="{{ route('order.confirm') }}" method="POST" id="orderForm">
            @csrf

            <!-- Centered logo image -->
            <img id="bannerr-image" class="logo-image" src="{{ asset('build/assets/images/logo1.png') }}" alt="Hot Deal">

            <div class="header">Hanag Garments - Invoice</div>
            <h3 style="text-align: center;">Order ID: {{ $order->id }}</h3>
            <h3 style="text-align: center;">{{ $user->full_name }}</h3> <!-- Assuming 'name' is a field on the User model -->
            <h3>{{ $user->address }}</h3> <!-- Assuming 'name' is a field on the User model -->

            <p>Order Type: {{ $order->order_type }}</p>
            <p>Subtotal: Rs.{{ number_format($order->sub_total, 2) }}</p>
            <p>Total Amount: Rs.{{ number_format($order->total_amount, 2) }}</p>
            <p>Status: {{ $order->status }}</p>
            <p>Description:{{ $order->description }}</p>

            <!-- Submit button -->
        </form>
    </div>

    @include('layouts.footer')

    <script>
        // Handling the confirmation order submission and triggering SweetAlert
        document.getElementById('orderForm').addEventListener('submit', function(event) {
            event.preventDefault();  // Prevent the form from submitting immediately

            // Here, you can make an Ajax request if needed to confirm the order and then trigger the popup.
            Swal.fire({
                title: 'Order Confirmed!',
                text: 'Your order has been confirmed successfully.',
                icon: 'success',
                confirmButtonText: 'Close',
            }).then((result) => {
                if (result.isConfirmed) {
                    // After clicking 'Close', submit the form
                    this.submit();  // Submit the form after the popup closes
                }
            });
        });
    </script>
</body>

</html>
