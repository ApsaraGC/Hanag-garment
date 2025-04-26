<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Hanag's Garment - Customer Service</title>
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
        .service-container {
            max-width: 900px;
            margin: 50px auto;
            border: 2px solid #ff69b4;
            padding: 30px;
            border-radius: 10px;
            background-color: #f9f9f9;
        }

        .service-container h1 {
            color: #ff69b4;
            text-align: center;
            margin-bottom: 20px;
        }

        .service-container h2 {
            color: #ff69b4;
            margin-top: 25px;
        }

        .service-container p {
            line-height: 1.7;
            margin-bottom: 15px;
        }

        .contact-info {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 25px;
        }

        .contact-info p {
            font-size: 16px;
        }
        .contact-info a {
    display: inline-block;
    margin-top: 5px;
    font-size: 17px;
}

        .contact-form input,
        .contact-form textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        .contact-form button {
            background-color: #ff69b4;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .contact-info strong {
    display: inline-block;
    width: 130px;
    color: #333;
}

        .contact-form button:hover {
            background-color: #ff3385;
        }
        .contact-info a[href^="mailto:"] {
    color: #000; /* black color */
    text-decoration: none; /* no underline */
    font-weight: normal; /* optional: if you don't want bold */
}

.contact-info a[href^="mailto:"]:hover {
    text-decoration: none; /* still no underline on hover */
    color: #333; /* slightly darker black on hover */
}
.contact-info a[href^="tel:"] {
    color: #000; /* black color */
    text-decoration: none; /* no underline */
    font-weight: normal; /* optional: if you don't want bold */
}

.contact-info a[href^="tel:"]:hover {
    text-decoration: none; /* still no underline on hover */
    color: #333; /* slightly darker black on hover */
}

    </style>
</head>
<body>

    <!-- Navbar -->
    @include('layouts.navigation')

    <!-- Customer Service -->
    <div class="service-container">
        <h1>Customer Service</h1>

        <!-- Contact Information -->
        <div class="contact-info">
            <h2>Get in Touch</h2>
            <p>If you have any questions or concerns, feel free to reach out to our customer service team. We are here to help!</p>
            <p><strong><i class="fas fa-envelope"></i> Email:</strong>
                <a href="mailto:support@hanagsgarment.com">support@hanagsgarment.com</a></p>

             <p><strong><i class="fas fa-phone"></i> Phone:</strong>
                <a href="tel:+97798000087">+977 98000087</a></p>

            <p><strong>Business Hours:</strong> Monday - Friday, 9:00 AM - 6:00 PM</p>
        </div>

        <!-- Contact Form -->
        <div class="contact-form">

        </div>

    </div>

    <!-- Footer -->
    @include('layouts.footer')

</body>
</html>
