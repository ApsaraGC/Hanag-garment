<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Hanag's Garments</title>
    <style>
    /* Reset default margin and padding for body and all elements */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    /* Body styling */
    body {
        font-family: 'Arial', sans-serif;
        line-height: 1.6;
        color: #333;
        background-color: #f4f4f4;
    }

    /* Main container */
    .container {
        padding: 10px;
        width: 100%;
        max-width: 1200px;
        margin: 0 auto;
        border-radius: 10px;
    }

    /* Heading style */
    h1 {
        text-align: center;
        color: #444;
        margin-top: 15px;
        font-size: 2.5rem;
        margin-bottom: 20px;
    }

    /* Full-width image */
    .full-width-image img {
        width: 100%;
        height: auto;
        object-fit: cover;
        border-radius: 8px;
        margin-bottom: 20px;
    }

    /* Shop details section */
    .shop-details {
        margin-top: 30px;
    }

    .shop-details h2 {
        text-align: left;
        color: #000;
        font-size: 1.6rem;
        margin-bottom: 10px;
    }

    /* Shop paragraph with smaller text and more breaks */
    .shop-details p {
        font-size: 1rem;
        color: #555;
        line-height: 1.8;
        margin-bottom: 15px;
    }

    /* Shop information with image and text side by side */
    .shop-info {
        display: flex;
        margin-top: 20px;
        gap: 20px;
        flex-wrap: wrap; /* Allow items to wrap on small screens */
        align-items: center;
    }

    /* Left side with image */
    .left-side {
        width: 40%;
        padding-right: 10px;
    }

    .left-side img {
        width: 100%;
        height: 250px;
        object-fit: cover;
        border-radius: 8px;
    }

    /* Right side with description */
    .right-side {
        width: 55%;
    }

    /* Button styling */
    .cta-button {
        display: inline-block;
        padding: 10px 20px;
        background-color: #f79c42;
        color: #fff;
        text-decoration: none;
        font-weight: bold;
        text-align: center;
        border-radius: 5px;
        margin-top: 30px;
        transition: background-color 0.3s ease;
    }

    .cta-button:hover {
        background-color: #e68a2f;
    }

    /* Ensure responsiveness */
    @media (max-width: 768px) {
        .shop-info {
            flex-direction: column;
        }

        .left-side, .right-side {
            width: 100%;
            padding: 10px 0;
        }

        h1 {
            font-size: 2rem;
        }

        .cta-button {
            width: 100%;
            text-align: center;
        }
    }

    </style>
</head>
<body>

<!-- Include Navigation -->
@include('layouts.navigation')

    <div class="container">
        <!-- About Us Heading -->
        <h1>About Us</h1>

        <!-- Full-width image -->
        <div class="full-width-image">
            <img src="{{ asset('build/assets/images/about/about-1.jpg') }}" alt="Garment Image">
        </div>

        <!-- Shop details section -->
        <div class="shop-details">
            <h2>Who We Are</h2>
            <p>At Hanag's Garments, we offer stylish and high-quality clothing for everyone. Our mission is to provide fashion that’s both accessible and affordable, blending trendy designs with top-notch materials. Whether you’re looking for casual or formal wear, we’ve got you covered!
             We take pride in using premium fabrics, ensuring every garment is comfortable, durable, and eco-friendly. Our goal is to create fashion pieces that look great and feel great.</p>

            <!-- Shop information with image and text side by side -->
            <div class="shop-info">
                <!-- Left side with image -->
                <div class="left-side">
                    <img src="{{ asset('build/assets/images/about/about-1.jpg') }}" alt="Garment Image">
                </div>

                <!-- Right side with description -->
                <div class="right-side">
                    <h3>Our Vision</h3>
                    <p>Our vision is to become a leading global brand that stands for sustainable fashion, innovation, and a positive impact on society. We aim to create a community of like-minded individuals who are passionate about style and sustainability.</p>

                    <h3>Our Mission</h3>
                    <p>At Hanag’s, our mission is to offer high-quality, affordable, and stylish clothing that promotes eco-friendly practices. We are committed to delivering products that make you feel good while helping to preserve the planet.</p>

                    <a href="#" class="cta-button">Shop Now</a> <!-- Call-to-action button -->
                </div>
            </div>
        </div>
    </div>

 <!-- Footer -->
 @include('layouts.footer')

</body>
</html>
