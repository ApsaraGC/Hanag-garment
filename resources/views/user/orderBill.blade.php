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
            max-width: 400px;
            margin: 40px auto;
            padding: 25px;
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

        .transaction-details {
            background-color: #fafafa;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .transaction-details h3 {
            font-size: 18px;
            margin-bottom: 20px;
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

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .form-group input {
            width: 90%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
        }

        .save-btn {
            background-color: #F070BB;
            color: #fff;
            justify-content: center;
            padding: 12px;
            text-align: center;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            width: 50%;
            transition: 0.3s ease;
        }

        .save-btn:hover {
            background-color: #ec49a8;
        }
    </style>
</head>

<body>
    @include('layouts.navigation')

    <div class="payment-container">

        <div class="transaction-details">
            <div class="header">Hanag Garments - Payment</div>
            <h1>Order Bill</h1>

            <h3>Order ID: {{ $order->id }}</h3>
            <p>User: {{ $user->name }}</p> <!-- Assuming 'name' is a field on the User model -->
            <p>Order Type: {{ $order->order_type }}</p>
            <p>Subtotal: Rs.{{ number_format($order->sub_total, 2) }}</p>
            <p>Discount: Rs.{{ number_format($order->discount, 2) }}</p>
            <p>Total Amount: Rs.{{ number_format($order->total_amount, 2) }}</p>
            <p>Status: {{ $order->status }}</p>
            <p>Description: {{ $order->description }}</p>
        </div>
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
