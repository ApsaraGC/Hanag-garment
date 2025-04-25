<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Footer Page</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />

  <style>
    body {
      margin: 0;
      font-family: Arial, sans-serif;
    }

    footer {
      background-color: #fbcbe1;
      color: #333;
    }

    .footer-container {
      display: flex;
      flex-wrap: wrap;
      justify-content: space-between;
      max-width: 1200px;
      margin-left: 85px;
      padding: 40px 20px;
      gap: 30px;
    }

    .footer-section {
      flex: 1 1 220px;
      min-width: 220px;
    }

    .footer-section h4 {
      font-size: 18px;
      margin-bottom: 15px;
      font-weight: bold;
      color: #3e3e3e;
    }

    .footer-section ul {
      list-style: none;
      padding: 0;
    }

    .footer-section ul li {
      margin-bottom: 10px;
    }

    .footer-section ul li a {
      text-decoration: none;
      color: #333;
      transition: all 0.3s ease;
    }

    .footer-section ul li a:hover {
      color: #ff69b4;
      padding-left: 5px;
    }

    .footer-section p {
      margin: 8px 0;
    }

    .footer-section p i {
      margin-right: 8px;
    }

    .social-icons a {
      display: inline-block;
      margin-right: 10px;
      color: #333;
      font-size: 18px;
      transition: transform 0.3s ease, color 0.3s ease;
    }

    .social-icons a:hover {
      color: #ff69b4;
      transform: scale(1.1);
    }

    .footer-bottom {
      display: flex;
      justify-content: space-between;
      align-items: center;
      background-color: #ff69b4;
      color: #fff;
      padding: 15px 40px;
      flex-wrap: wrap;
    }

    .footer-bottom p {
      margin: 5px 0;
    }

    .footer-bottom a {
      color: #fff;
      text-decoration: none;
      margin-left: 10px;
    }

    .footer-bottom a:hover {
      text-decoration: underline;
    }

    @media (max-width: 768px) {
      .footer-container {
        flex-direction: column;
        padding: 30px 20px;
        align-items: flex-start;
      }

      .footer-bottom {
        flex-direction: column;
        align-items: flex-start;
        padding: 20px;
      }
    }
  </style>
</head>
<body>

<footer>
  <div class="footer-container">
    <!-- Contact -->
    <div class="footer-section">
      <h4>CONTACT</h4>
      <p><i class="fa fa-phone"></i> +988888111</p>
      <p><i class="fa fa-envelope"></i> hanag@gmail.com</p>
      <p><i class="fa fa-map-marker"></i> Fulbari-11, Pokhara</p>
      <div class="social-icons">
        <a href="#"><i class="fa fa-facebook-square"></i></a>
        <a href="#"><i class="fa fa-instagram"></i></a>
        <a href="#"><i class="fa fa-twitter"></i></a>
      </div>
    </div>

    <!-- Useful Links -->
    <div class="footer-section">
      <h4>USEFUL LINK</h4>
      <ul>
        <li><a href="{{route('user.aboutus')}}">About Us</a></li>
        <li><a href="{{route('user.faq')}}">FAQ</a></li>
        <li><a href="{{route('user.contact')}}">Contact Us</a></li>
      </ul>
    </div>

    <!-- My Account -->
    <div class="footer-section">
      <h4>MY ACCOUNT</h4>
      <ul>
        <li><a href="{{route('register')}}">Sign In</a></li>
        <li><a href="{{route('user.cart')}}">View Cart</a></li>
        <li><a href="{{route('user.wishlist')}}">My Wishlist</a></li>
      </ul>
    </div>

    <!-- Help -->
    <div class="footer-section">
      <h4>HELP</h4>
      <ul>
        <li><a href="{{route('user.customerservice')}}">Customer Service</a></li>
        <li><a href="{{ route('user.privilege') }}">Privilege Policy</a></li>
        <li><a href="{{ route('user.policy') }}">Legal & Privacy</a></li>
      </ul>
    </div>
  </div>

  <div class="footer-bottom">
    <p>© 2024 Hanag's Garments. All rights reserved.</p>
    <p>
      <a href="{{ route('user.policy') }}">Privacy Policy</a> |
      <a href="{{ route('user.policy') }}">Terms & Conditions</a>
    </p>
  </div>
</footer>

</body>
</html>
