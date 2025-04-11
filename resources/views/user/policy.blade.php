<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Hanag's Garment - Terms and Conditions</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #fff;
            margin: 0;
            padding: 0;
            color: #333;
        }


        /* Container */
        .terms-container {
            max-width: 800px;
            margin: 50px auto;
            border: 2px solid #ff69b4;
            padding: 30px;
            border-radius: 10px;
        }
        .terms-container h1 {
            color: #ff69b4;
            text-align: center;
            margin-bottom: 20px;
        }
        .terms-container h2 {
            color: #ff69b4;
            margin-top: 25px;
        }
        .terms-container p {
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


    <!-- Terms and Conditions -->
    <div class="terms-container">
        <h1>Terms & Conditions</h1>

        <p>Welcome to <span class="highlight">Hanag's Garment</span>. By accessing or using our website and services, you agree to be bound by the following terms and conditions.</p>

        <h2>1. Products & Services</h2>
        <p>We strive to deliver high-quality garments at affordable prices. All products listed are subject to availability and may be withdrawn at any time.</p>

        <h2>2. Orders & Payments</h2>
        <p>Customers are required to make full payment at the time of placing an order. We accept various payment methods for your convenience.</p>

        <h2>3. Delivery</h2>
        <p>We offer home delivery services. Estimated delivery times may vary depending on location and availability. We will notify customers in case of delays.</p>

        <h2>4. Returns & Exchanges</h2>
        <p>If you are not satisfied with your purchase, you may return or exchange products within 7 days of delivery. Items must be unused and in original condition.</p>

        <h2>5. User Accounts</h2>
        <p>Users must provide accurate information during registration. You are responsible for maintaining the confidentiality of your account credentials.</p>

        <h2>6. Privacy</h2>
        <p>Your privacy is important to us. We do not share personal information with third parties without your consent. Please read our Privacy Policy for more details.</p>

        <h2>7. Contact</h2>
        <p>If you have any questions about these Terms, please contact us at <span class="highlight">support@hanagsgarment.com</span>.</p>
    </div>

    <!-- Footer -->
    @include('layouts.footer')


</body>
</html>
