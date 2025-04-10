<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Hanag's Garments</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
    * { margin: 0; padding: 0; box-sizing: border-box; }
body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; background: #f4f4f4; }
.container { padding: 10px; max-width: 1200px; margin: auto; border-radius: 10px; }
h1 { text-align: center; color: #444; margin: 15px 0 20px; font-size: 2.0rem; }
 /* Underline for heading */
 .container h1::after {
            content: '';
            display: block;
            width: 140px;
            height: 3px;
            background-color: #F070BB;
            margin: 2px auto 0;
        }

.full-width-image img, .left-side img { width: 100%; border-radius: 8px; object-fit: cover; }
.full-width-image img { margin-bottom: 20px; }
.left-side img { height: 250px; }
.shop-details { margin-top: 30px; }
.shop-details h2 { font-size: 1.6rem; margin-bottom: 10px; }
.shop-details p { font-size: 1rem; color: #555; line-height: 1.8; margin-bottom: 15px; }
.shop-info { display: flex; gap: 20px; flex-wrap: wrap; align-items: center; margin-top: 20px; }
.left-side { width: 40%; padding-right: 10px; }
.right-side { width: 55%; }
.cta-button { display: inline-block; padding: 10px 20px; text-decoration: none; background: #F070BB; color: #fff; font-weight: bold; text-align: center; border-radius: 5px; margin-top: 30px; transition: 0.3s; }
.cta-button:hover { background: #e62fa0; }
@media (max-width: 768px) {
  .shop-info { flex-direction: column; }
  .left-side, .right-side { width: 100%; padding: 10px 0; }
  h1 { font-size: 2rem; }
  .cta-button { width: 100%; }
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

                    <a href="{{route('user.shop')}}" class="cta-button">Shop Now</a> <!-- Call-to-action button -->
                </div>
            </div>
        </div>
    </div>

 <!-- Footer -->
 @include('layouts.footer')

</body>
</html>
