<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Hanag's Garment - Privilege Policy</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #fff;
            margin: 0;
            padding: 0;
            color: #333;
        }




        /* Container */
        .policy-container {
            max-width: 800px;
            margin: 50px auto;
            border: 2px solid #ff69b4;
            padding: 30px;
            border-radius: 10px;
        }
        .policy-container h1 {
            color: #ff69b4;
            text-align: center;
            margin-bottom: 20px;
        }
        .policy-container h2 {
            color: #ff69b4;
            margin-top: 25px;
        }
        .policy-container p {
            line-height: 1.7;
            margin-bottom: 15px;
        }
        .highlight {
            color: #ff69b4;
            font-weight: bold;
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    @include('layouts.navigation')


    <!-- Privilege Policy -->
    <div class="policy-container">
        <h1>Privilege Policy</h1>

        <p>Welcome to <span class="highlight">Hanag's Garment</span>. We are committed to providing special privileges to our registered users based on specific tiers and roles. By accessing our services, you agree to the terms outlined below:</p>

        <h2>1. Privileges for Registered Users</h2>
        <p>As a registered user, you are entitled to several exclusive benefits, including but not limited to:</p>
        <ul>
            <li>Access to exclusive discounts and offers.</li>
            <li>Priority customer support.</li>
            <li>Early access to new collections and sales events.</li>
        </ul>

        <h2>2. Privileges for Premium Members</h2>
        <p>Premium members enjoy additional privileges, which include:</p>
        <ul>
            <li>Free shipping on all orders.</li>
            <li>Exclusive invitations to private events.</li>
            <li>Special gifts on birthdays and anniversaries.</li>
            <li>Priority access to customer support with dedicated agents.</li>
        </ul>

        <h2>3. Roles and Responsibilities</h2>
        <p>Our system assigns privileges based on roles (e.g., customer, admin). You are expected to:</p>
        <ul>
            <li>Respect other users and the terms of service.</li>
            <li>Ensure that your account information remains accurate and up-to-date.</li>
            <li>Follow the rules outlined in the User Agreement when accessing the services.</li>
        </ul>

        <h2>4. Changes to Privileges</h2>
        <p>Hanag's Garment reserves the right to modify or revoke privileges at any time, at our sole discretion. You will be notified of any changes via email or within your account dashboard.</p>

        <h2>5. Contact</h2>
        <p>If you have any questions about the Privilege Policy, please reach out to us at <span class="highlight">support@hanagsgarment.com</span>.</p>
    </div>

    <!-- Footer -->
    @include('layouts.footer')

</body>
</html>
