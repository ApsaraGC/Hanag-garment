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
            background-color: #f9f9f9;
        }

        .payment-container {
            max-width: 800px;
            margin: 30px auto;
            padding: 10px;
            background-color: #fff; /* Box background */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Shadow effect */
            border-radius: 8px; /* Rounded corners */
            border: 1px solid #ddd; /* Light border around the box */
        }

        .header {
            text-align: center;
            padding: 10px 0;
            color: black;
            border-radius: 5px 5px 0 0;
            font-size: 18px;
            font-weight: bold;
        }

        .payment-details {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
            gap:30px;
        }

        .transaction-details, .login-section {
            flex: 1;
            padding: 20px;
        }

        .transaction-details h3 {
            margin-bottom: 25px;
        }

        .transaction-details p {
            margin: 5px 0;
            display: flex;
            justify-content: space-between;
        }

        .transaction-details p span {
            font-weight: bold;
        }

        .login-section {
            text-align: center;
        }

        .login-section h3 {
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 15px;
            text-align: left;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .form-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #F070BB;
            border-radius: 5px;
            font-size: 14px;
        }

        .button-group {
            margin-top: 20px;
        }

        .button-group button {
            padding: 10px 20px;
            border: none;
            border-radius: 1px;
            font-size: 14px;
            cursor: pointer;
        }

        .button-group .login-btn {
            background-color: #F070BB;
            color: #fff;
            margin-right: 50px;
        }

        .button-group .cancel-btn {
            background-color: #ff3333;
            color: #fff;
        }
    </style>
</head>
<body>
    <!-- Include Navigation -->
    @include('layouts.navigation')

    {{-- <div class="payment-container">
        <div class="payment-details">
            <!-- Transaction Details Section -->
            <div class="transaction-details">
                <h3>Transaction Details</h3>
                <p><span>Hanag Garment</span> <span>NPR</span></p>
                <hr>
                <p><span>Product Amount</span> <span>1450.00</span></p>
                <hr>
                <p><span>Tax Amount</span> <span>0.00</span></p>
                <hr>
                <p><span>Delivery Charge</span> <span>0.00</span></p>
                <hr>
                <p><span>Total Amount</span> <span>1450.00</span></p>
            </div>

            <!-- Login Section -->
            <div class="login-section">
                <h3>Login</h3>
                <div class="form-group">
                    <label for="esewa-id">eSewa ID</label>
                    <input type="text" id="esewa-id" placeholder="Enter your eSewa ID">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" placeholder="Enter your password">
                </div>
                <div class="button-group">
                    <button class="login-btn">Login</button>
                    <button class="cancel-btn">Cancel</button>
                </div>
            </div>
        </div>
    </div> --}}
    <!-- Include Footer -->
    @include('layouts.footer')
</body>
</html>
