<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hanag's Garments</title>
    <style>
        /* General Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
        }

        a {
            text-decoration: none;
            color: inherit;
        }

       /* Header */
       .header {
            background-color: #F070BB;
            color: #fff;
            padding: 20px 0;
        }




        .banner {
    display: flex;
    align-items: center;
    justify-content: space-between;
    height: 450px; /* Reduced height for a smaller banner */
    padding: 20px;
    background-color: #f9f9f9;
}

.banner .text-content {
    flex: 1;
    max-width: 50%;
    margin-top: -20px; /* Adjusted to move text slightly higher */
}

.banner .text-content h2 {
    font-size: 20px;
    color: #888;
    margin-bottom: 5px;
}

.banner .text-content h1 {
    font-size: 40px; /* Reduced font size for a smaller banner */
    color: #222;
    margin-bottom: 10px;
}

.banner .text-content p {
    font-size: 16px;
    margin-bottom: 15px;
    color: #555;
}

.banner .shop-now-btn {
    display: inline-block;
    padding: 8px 16px;
    background-color: #F070BB;
    color: #fff;
    text-decoration: none;
    border-radius: 5px;
}

.banner .shop-now-btn:hover {
    background-color: #e73370;
}

.banner .image-content {
    flex: 1;
    max-width: 100%;
}

.banner .image-content img {
    width: 80%;
    max-height: 380px; /* Adjusted to fit smaller banner */

}

.text-content {
    flex: 1;
    max-width: 50%;
    margin-top: -80px;
}

.text-content h2 {
    font-size: 18px; /* Slightly smaller heading */
    color: #888;
    margin-bottom: 10px;
}

.text-content h1 {
    font-size: 36px; /* Reduced font size for better balance */
    color: #222;
    margin-bottom: 15px;
}

.text-content p {
    font-size: 16px;
    margin-bottom: 20px;
    color: #555;
}

.shop-now-btn {
    display: inline-block;
    padding: 10px 20px;
    background-color: #ff4081;
    color: #fff;
    text-decoration: none;
    border-radius: 5px;
}

.shop-now-btn:hover {
    background-color: #e73370;
}

.image-content {
    flex: 1;
    max-width: 50%;
    text-align: center;
}

.image-content img {
    max-width: 100%; /* Reduce image size to 80% of its container */
    height: auto;
    border-radius: 10px;
     /* Ensures the image maintains proportions */
}

        /* You Might Like Section */
        .you-might-like {
            padding: 30px 20px;
            text-align: center;
            background-color: #FFF;
        }

        .you-might-like h2 {
            font-size: 22px;
            margin-bottom: 20px;
        }

        .carousel-items {
            display: flex;
            gap: 15px;
            justify-content: center;
        }

        .carousel-item {
            text-align: center;
        }

        .carousel-item img {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 5px;
        }

        /* Hot Deals Section */
        .hot-deals {
            padding: 30px 20px;
            display: flex;
            justify-content: space-between;
            background-color: #F8F8F8;
        }

        .hot-deals .sale-banner {
            background-color: #FFF;
            text-align: center;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .hot-deals .deals-images {
            display: flex;
            gap: 20px;
        }

        .hot-deals img {
            width: 150px;
            border-radius: 10px;
        }
       .deals{
        width: 150px;
            border-radius: 10px;
       }
        /* Featured Products Section */
        .featured-products {
            padding: 30px 20px;
            background-color: #FFF;
            text-align: center;
        }

        .featured-products h2 {
            font-size: 22px;
            margin-bottom: 20px;
        }

        .product-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
        }

        .product {
            background-color: #F0F0F0;
            padding: 15px;
            text-align: center;
            border-radius: 5px;
        }

        .product img {
            width: 100%;
            border-radius: 5px;
        }

        .product p {
            margin: 10px 0;
        }

        .product .price {
            color: #F070BB;
            font-weight: bold;
        }

        .load-more {
            margin-top: 20px;
            display: inline-block;
            background-color: #F070BB;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
        }


    </style>
</head>
<body>


 <!-- Include Navigation -->
 @include('layouts.navigation')

    <!-- Banner -->
   <!-- Banner Section -->
<!-- Banner -->
<section class="banner">
    <div class="text-content">
        <h2>New Arrivals</h2>
        <h1>Hanag's Garments</h1>
        <p>Explore our latest collection of premium clothing for every occasion.</p>
        <a href="#" class="shop-now-btn">Shop Now</a>
    </div>
    <div class="image-content">
        <img src="{{ asset('build/assets/images/products/product_9-1.jpg') }}" alt="Hot Deal">
    </div>
</section>




    <!-- You Might Like Section -->
    <section class="you-might-like">
        <h2>You Might Like</h2>
        <div class="carousel-items">
            <div class="carousel-item">
                <img src="{{ asset('build/assets/images/products/product_0-1.jpg') }}" alt="Item">
                <p>Item 1</p>
            </div>
            <div class="carousel-item">
                <img src="{{ asset('build/assets/images/products/product_0-2.jpg') }}" alt="Item">
                <p>Item 2</p>
            </div>
            <div class="carousel-item">
                <img src="{{ asset('build/assets/images/products/product_0-3.jpg') }}" alt="Item">
                <p>Item 2</p>
            </div>
            <div class="carousel-item">
                <img src="{{ asset('build/assets/images/products/product_0.jpg') }}" alt="Item">
                <p>Item 2</p>
            </div>
            <div class="carousel-item">
                <img src="{{ asset('build/assets/images/products/product_1-1.jpg') }}" alt="Item">
                <p>Item 2</p>
            </div>
            <div class="carousel-item">
                <img src="{{ asset('build/assets/images/products/product_1.jpg') }}" alt="Item">
                <p>Item 2</p>
            </div>
        </div>
    </section>

    <!-- Hot Deals Section -->
    <section class="hot-deals">
        <div class="sale-banner">
            <h2>Summer Sale</h2>
            <p>Up to 50% off</p>
        </div>
        <div class="deals-images">
            <img src="{{ asset('build/assets/images/products/product_9-1.jpg') }}" alt="Hot Deal">
            <img src="{{ asset('build/assets/images/products/product_3-1.jpg') }}" alt="Hot Deal">
            <img src="{{ asset('build/assets/images/products/product_9.jpg') }}" alt="Hot Deal">
            <img src="{{ asset('build/assets/images/products/product_6-1.jpg') }}" alt="Hot Deal">
            <img src="{{ asset('build/assets/images/products/product_7-1.jpg') }}" alt="Hot Deal">
            <img src="{{ asset('build/assets/images/products/product_8-1.jpg') }}" alt="Hot Deal">
        </div>
    </section>

    <!-- Featured Products -->
    <section class="featured-products">
        <h2>Featured Products</h2>
        <div class="product-grid">
            <div class="product">
                <img src="{{ asset('build/assets/images/products/product_8.jpg') }}" alt="Product">
                <p>Skirt</p>
                <p class="price">$40 <span style="text-decoration: line-through;">$50</span></p>
            </div>

                <div class="product">
                    <img src="{{ asset('build/assets/images/products/product_3.jpg') }}" alt="Product">
                    <p>Skirt</p>
                    <p class="price">$40 <span style="text-decoration: line-through;">$50</span></p>
                </div>

                    <div class="product">
                        <img src="{{ asset('build/assets/images/products/product_4-1.jpg') }}" alt="Product">
                        <p>Skirt</p>
                        <p class="price">$40 <span style="text-decoration: line-through;">$50</span></p>
                    </div>
                    <div class="product">
                        <img src="{{ asset('build/assets/images/products/product_5-1.jpg') }}" alt="Product">
                        <p>Skirt</p>
                        <p class="price">$40 <span style="text-decoration: line-through;">$50</span></p>
                    </div>
        </div>
    </section>
    <!-- Footer -->
    @include('layouts.footer')
</body>
</html>
