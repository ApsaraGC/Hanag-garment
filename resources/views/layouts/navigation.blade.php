<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navigation Bar</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
        }

        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #F070BB;
            padding: 10px 20px;
        }

        .logo {
            width: 40px;
            height: 40px;
            background-color: #e94c99;
            border-radius: 50%;
        }

        .logo img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
        }

        .nav-links {
            display: flex;
            gap: 20px;
        }

        .nav-links a {
            text-decoration: none;
            color: rgb(244, 242, 242);
            font-weight: bold;
        }

        .nav-icons {
            display: flex;
            gap: 15px;
            color: aliceblue;
        }

        .nav-icons a {
            color: aliceblue;
        }

        header {
            background-color: #F070BB;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
            color: white;
        }

        /* User Card Styles */
        .user-card {
            position: relative;
            display: flex;
            align-items: center;
            cursor: pointer;
        }

        .user-card i {
            font-size: 18px;
            margin-top: 5px;
        }

        .user-info {
            display: none;
            position: absolute;
            top: 35px;
            left: -70px;
            background-color: white;
            border: 1px solid #ccc;
            padding: 10px;
            border-radius: 5px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 150px;
            z-index: 10;
        }

        /* Show the card when the user card is clicked */
        .user-card.active .user-info {
            display: block;
        }

        .user-info a {
            display: block;
            color: #ff1493;
            text-decoration: none;
            margin-bottom: 5px;
        }

        .user-info a:hover {
            color: #cc117a;
        }

        .user-info p {
            margin-bottom: 10px;
            font-weight: bold;
        }

        .profile-link {
            color: #ff1493;
            font-size: 16px;
        }

        .profile-link:hover {
            color: #cc117a;
        }

    </style>
</head>
<body>
    <header class="navbar">
        <div class="logo"><img src="{{ asset('build/assets/images/logo.png') }}" alt="Item"></div>
        <nav class="nav-links">
            <a href="{{route('dashboard')}}">HOME</a>
            <a href="{{route('user.shop')}}">SHOP</a>
            <a href="{{route('user.faq')}}">FAQ</a>
            <a href="{{route('user.aboutus')}}">ABOUT</a>
            <a href="{{route('user.contact')}}">CONTACT</a>
        </nav>
        <div class="nav-icons">
            <a href="#"><i class="fa fa-search"></i></a>
            @if (Route::has('login'))
            <nav class="">
                @auth
                    <!-- User Card -->
                    <div class="user-card" onclick="this.classList.toggle('active')">
                        <i class="fa fa-user"></i>
                        <div class="user-info">
                            <p>{{ Auth::user()->name }}</p>
                            <a href="{{ route('user.profile') }}" class="profile-link">View Profile</a>
                            <a href="{{ route('user.settings') }}" class="profile-link">Settings</a>
                            <form method="POST" action="{{ route('logout') }}" id="logout-form">
                                @csrf
                                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    Logout
                                </a>
                            </form>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}">
                        <i class="fa fa-user" ></i>
                    </a>
                @endauth
            </nav>
            @endif

            <a href="{{route('user.cart')}}"><i class="fa fa-shopping-cart"></i></a>
            <a href="{{route('user.wishlist')}}"><i class="fa fa-heart-o"></i></a>
        </div>
    </header>

    <script>
        // Optional: Close the user card if clicked outside
        document.addEventListener('click', function(event) {
            const userCard = document.querySelector('.user-card');
            if (!userCard.contains(event.target)) {
                userCard.classList.remove('active');
            }
        });
    </script>
</body>
</html>
