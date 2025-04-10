<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"> --}}
    <style>

        /* Footer Styles */
        footer {
            background-color: #fbcbe1;
            font-family: Arial, sans-serif;
            border-top: 1px solid #ddd;
        }

        .footer-container {
            display: flex;
            justify-content: space-between;
            padding: 20px 50px;
            color: #444        }

        .footer-section {
            flex: 1;
            margin-right: 20px;
        }

        .footer-section h4 {
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .footer-section ul {
            list-style: none;
            padding: 0;
        }

        .footer-section ul li {
            margin: 5px 0;
        }

        .footer-section ul li a {
            text-decoration: none;
            color: #333;
            transition: color 0.3s;
        }

        .footer-section ul li a:hover {
            color: #ff69b4;
        }

        .footer-section p {
            margin: 5px 0;
        }

        /* Footer Bottom */
        .footer-bottom {
            background-color: #ff69b4;
            color: #fff;
            text-align: center;
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .footer-bottom p {
            margin: 0;
        }

        .footer-bottom a {
            color: #fff;
            text-decoration: none;
            margin: 0 5px;
            transition: color 0.3s;
        }

        .footer-bottom a:hover {
            text-decoration: underline;
        }

            </style>
</head>
<body>

    <footer>
        <div class="footer-container">
            <!-- Contact Section -->
            <div class="footer-section">
                <h4>CONTACT</h4>
                <p><i class="fa fa-phone"></i>  +988888111</p>
                <p><i class="fa fa-envelope"></i>  hanag@gmail.com</p>
                <p><i class="fa fa-map-marker"></i>  Fulbari-11, Pokhara</p>
                            <!-- Social Media Icons -->
                            <p>
                                <a href="#" style="color:#333;"><i class="fa fa-instagram"></i></a>
                                <a href="#" style="color:#333;"><i class="fa fa-youtube"></i></a>
                            </p>
            </div>
            <!-- Shop Section -->
            <div class="footer-section">
                <h4>SHOP</h4>
                <ul>
                    <li><a href="#">New Arrivals</a></li>
                    <li><a href="#">Baby Girl</a></li>
                    <li><a href="#">Women</a></li>
                    <li><a href="#">Shop All</a></li>
                </ul>
            </div>

            <!-- Brand Section -->
            <div class="footer-section">
                <h4>BRAND</h4>
                <ul>
                    <li><a href="#">Flare $ Frill</a></li>
                    <li><a href="#">Hanag's Garments</a></li>
                    <li><a href="#">Lush Skirts</a></li>
                    <li><a href="#">ModaCharm</a></li>
                </ul>
            </div>

            <!-- Category Section -->
            <div class="footer-section">
                <h4>CATEGORY</h4>
                <ul>
                    <li><a href="#">Formal Skirts</a></li>
                    <li><a href="#">A Line Skirts</a></li>
                    <li><a href="#">Wrap Skirts</a></li>
                    <li><a href="#">Denim Skirts</a></li>
                </ul>
            </div>

            <!-- Help Section -->
            <div class="footer-section">
                <h4>HELP</h4>
                <ul>
                    <li><a href="#">Customer Service</a></li>
                    <li><a href="{{route('user.privilege')}}">Privilege Policy</a></li>
                    <li><a href="{{route('user.policy')}}">Legal & Privacy</a></li>
                    <li><a href="#">Gift Card</a></li>
                </ul>
            </div>
        </div>

        <!-- Footer Bottom -->
        <div class="footer-bottom">
            <p>©2024 Hanag's Garments</p>
            <p><a href="#">Privacy Policy</a> | <a href="#">Term & Condition</a></p>

        </div>
    </footer>

</body>
</html>
