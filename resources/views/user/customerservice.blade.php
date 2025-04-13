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

        .contact-form button:hover {
            background-color: #ff3385;
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
            <p><strong>Email:</strong> <a href="mailto:support@hanagsgarment.com" class="highlight">support@hanagsgarment.com</a></p>
            <p><strong>Phone:</strong> <a href="tel:+1234567890" class="highlight">+977 98000087</a></p>
            <p><strong>Business Hours:</strong> Monday - Friday, 9:00 AM - 6:00 PM</p>
        </div>

        <!-- Contact Form -->
        <div class="contact-form">
            {{-- <h2>Contact Us</h2>
            <form action="/submit_contact" method="POST">
                <input type="text" name="name" placeholder="Your Name" required>
                <input type="email" name="email" placeholder="Your Email" required>
                <textarea name="message" placeholder="Your Message" rows="4" required></textarea>
                <button type="submit">Send Message</button>
            </form> --}}
        </div>

    </div>

    <!-- Footer -->
    @include('layouts.footer')

</body>
</html>
