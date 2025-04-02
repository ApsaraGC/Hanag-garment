<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Settings - Hanag's Garments</title>
    <style>
        /* Reset & General Styles */
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Poppins', sans-serif; background: #f8f9fa; color: #333; line-height: 1.6; }

        /* Container */
        .container {
            max-width: 500px;
            margin: 30px auto;
            padding: 25px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #444;
            font-size: 2rem;
            margin-bottom: 20px;
        }

        /* Section Styles */
        .customer-settings {
            padding: 20px;
        }

        .order-info, .account-details {
            background: #f1f1f1;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 15px;
        }

        .order-info h3, .account-details h3 {
            font-size: 1.4rem;
            color: #555;
            margin-bottom: 10px;
        }

        p {
            font-size: 1rem;
            color: #666;
            margin-bottom: 8px;
        }

        /* Button Styling */
        .actions {
            text-align: center;
            margin-top: 10px;
        }

        .actions .btn {
            display: inline-block;
            padding: 10px 16px;
            text-decoration: none;
            font-size: 1rem;
            border-radius: 5px;
            font-weight: 400;
            transition: all 0.3s ease;
            cursor: pointer;
            margin: 5px;
        }

        .btn-primary {
            background: #F070BB;
            color: #fff;
        }

        .btn-primary:hover {
            background:  #e62fa0;
        }

        .btn-cancel {
            background: #dc3545;
            color: #fff;
        }

        .btn-cancel:hover {
            background: #a71d2a;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .container {
                margin: 20px;
                padding: 15px;
            }

            h2 {
                font-size: 1.8rem;
            }

            p {
                font-size: 0.95rem;
            }
        }
    </style>
</head>
<body>

    <!-- Include Navigation -->
    @include('layouts.navigation')

    <div class="container">
        <div class="customer-settings">
            <h2>Account Settings</h2>

            <!-- Order Information -->
            <div class="order-info">
                <h3>My Orders</h3>
                <p><strong>Total Orders:</strong> {{ $orderCount }}</p>
            </div>

            <!-- Account Details -->
            <div class="account-details">
                <h3>My Details</h3>
                <p><strong>Name:</strong> {{ $user->full_name }}</p>
                <p><strong>Email:</strong> {{ $user->email }}</p>
            </div>

            <!-- Action Buttons -->
            <div class="actions">
                <a href="{{ route('user.profile') }}" class="btn btn-primary">Edit Profile</a>
                <a href="{{ route('dashboard') }}" class="btn btn-cancel">Cancel</a>
            </div>
        </div>
    </div>

    <!-- Include Footer -->
    @include('layouts.footer')

</body>
</html>
