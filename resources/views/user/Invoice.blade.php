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

            <h3>Hello, <span>{{ Auth::user()->full_name }}</span></h3>
            <p><span>Address</span> <span>{{ $user->address ?? 'No address set' }}</span></p>
            <hr>
            <p><span>Payment Type</span> <span>{{ $paymentType }}</span></p>
            <p><span>Subtotal</span> <span>Rs.{{ number_format($subtotal, 2) }}</span></p>
            <p><span>Delivery Charge</span> <span>Rs.{{ number_format($deliveryCharge, 2) }}</span></p>
            <hr>
            <p><span>Total</span> <span>Rs.{{ number_format($total, 2) }}</span></p>
        </div>

        <div class="address-section">
            <h4>Update Your Address</h4>
            <form action="{{ route('update.address') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="address">New Address</label>
                    <input type="text" id="address" name="address" value="{{ $user->address ?? '' }}" placeholder="Enter your new address" required>
                </div>
                <button type="submit" class="save-btn">Save Address</button>
                    <a href="{{ route('user.cart') }}" class="cancel-btn" style="text-decoration:none;display:inline-block;padding:12px 20px;border-radius:5px;font-size:14px;color:#fff;background-color:#ff3333;width:39git%;text-align:center;margin-top:15px;">Cancel</a>

            </form>
        </div>
    </div>

    @include('layouts.footer')
</body>

</html>
