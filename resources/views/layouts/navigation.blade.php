<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Navigation Bar</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #fff;
        }

        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #f070bb;
            padding: 8px 16px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .logo img {
            width: 60px;
            height: 60px;
            border-radius: 50%;
        }

        .nav-links {
            display: flex;
            gap: 24px;
        }

        .nav-links a {
            color: #fff;
            text-decoration: none;
            font-weight: 600;
            position: relative;
            padding: 4px 0;
            transition: color 0.3s;
        }

        .nav-links a::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 2px;
            background-color: #fff;
            transition: width 0.3s;
        }

        .nav-links a:hover::after {
            width: 100%;
        }

        .nav-icons {
            display: flex;
            gap: 16px;
            align-items: center;
            color: #fff;
        }

        .nav-icons a {
            color: #fff;
            font-size: 18px;
            background: none;
            border: none;
            cursor: pointer;
            padding: 0;
            margin: 0;
        }

        .nav-icons button.search-btn-icon {
            color: #fff;
            font-size: 18px;
            background: none;
            font-weight: bold;
            border: none;
            cursor: pointer;
            padding: 0px;
            margin-top: 10px;
        }

        .nav-icons a:hover,
        .nav-icons button.search-btn-icon:hover {
            color: #ffd9ec;
        }

        .search-form {
            position: relative;
        }

        .search-form input[type="text"] {
            width: 0;
            opacity: 0;
            padding: 5px 10px;
            border: none;
            border-radius: 4px;
            outline: none;
            transition: width 0.4s ease, opacity 0.4s ease;
        }

        .search-form.active input[type="text"] {
            width: 160px;
            opacity: 1;
            border: 1px solid #ddd;
            background-color: #fff;
            color: #333;
        }

        .user-card {
            position: relative;
            display: flex;
            align-items: center;
            cursor: pointer;
        }

        .user-card i {
            font-size: 18px;
        }

        .user-info {
            display: none;
            position: absolute;
            top: 30px;
            right: 0;
            background-color: #fff;
            color: #333;
            border: 1px solid #ccc;
            padding: 12px;
            border-radius: 6px;
            width: 160px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.15);
        }

        .user-card.active .user-info {
            display: block;
            animation: fadeIn 0.3s ease;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-5px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .user-info p {
            font-weight: bold;
            margin-bottom: 8px;
        }

        .user-info a {
            color: #f070bb;
            text-decoration: none;
            display: block;
            margin-bottom: 6px;
        }

        .user-info a:hover {
            color: #cc117a;
        }

        @media (max-width: 768px) {
            .nav-links {
                display: none;
            }

            .search-form.active input[type="text"] {
                width: 120px;
            }
        }

        .icon-with-badge {
            position: relative;
            display: inline-block;
            margin-right: 10px;
        }

        .badge {
            position: absolute;
            top: -10px;
            right: -12px;
            background-color: white;
            /* add background if needed */
            color: #f070bb;
            padding: 4px 7px;
            font-size: 12px;
            font-weight: bold;
            min-width: 8px;
            height: 8px;
            border-radius: 60%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 0 3px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>

<body>
    <header class="navbar">
        <div class="logo">
            <img src="{{ asset('build/assets/images/logo.png') }}" alt="Logo">
        </div>

        <nav class="nav-links">
            <a href="{{ route('dashboard') }}">HOME</a>
            <a href="{{ route('user.shop') }}">SHOP</a>
            <a href="{{ route('user.faq') }}">FAQ</a>
            <a href="{{ route('user.aboutus') }}">ABOUT</a>
            <a href="{{ route('user.contact') }}">CONTACT</a>
        </nav>

        <div class="nav-icons">
            <form class="search-form" method="GET" action="{{ route('user.shop') }}">
                <input type="text" name="search" value="{{ old('search', $search ?? '') }}"
                    placeholder="Search products...">
                <button type="button" class="search-btn-icon"><i class="fas fa-search"></i></button>
            </form>

            @if (Route::has('login'))
                <nav>
                    @auth
                        <div class="user-card" onclick="this.classList.toggle('active')">
                            <i class="fas fa-user"></i>
                            <div class="user-info">
                                <p>{{ Auth::user()->name }}</p>
                                <a href="{{ route('user.profile') }}"> Edit Profile</a>
                                <a href="{{ route('user.settings') }}">Settings</a>
                                <form method="POST" action="{{ route('logout') }}" id="logout-form">
                                    @csrf
                                    <a href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                                </form>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('login') }}"><i class="fas fa-user"></i></a>
                    @endauth
                </nav>
            @endif

            {{-- @auth --}}
            <a href="{{ route('user.cart') }}" class="icon-with-badge">
                <i class="fas fa-shopping-cart"></i>
                @if($cartCount > 0)
                    <span class="badge">{{ $cartCount }}</span>
                @endif
            </a>

            <a href="{{ route('user.wishlist') }}" class="icon-with-badge">
                <i class="fas fa-heart"></i>
                @if($wishlistCount > 0)
                    <span class="badge">{{ $wishlistCount }}</span>
                @endif
            </a>

            {{-- @endauth --}}

        </div>
    </header>

    <script>
        // Close user info dropdown on outside click
        document.addEventListener('click', function (event) {
            const userCard = document.querySelector('.user-card');
            if (userCard && !userCard.contains(event.target)) {
                userCard.classList.remove('active');
            }
        });

        // Handle search input toggle
        document.addEventListener('DOMContentLoaded', function () {
            const searchForm = document.querySelector('.search-form');
            const searchInput = searchForm.querySelector('input[type="text"]');
            const searchBtn = searchForm.querySelector('.search-btn-icon');

            searchBtn.addEventListener('click', function (e) {
                if (!searchForm.classList.contains('active')) {
                    searchForm.classList.add('active');
                    searchInput.focus();
                    e.preventDefault();
                } else {
                    if (!searchInput.value.trim()) {
                        searchForm.classList.remove('active');
                        searchInput.blur();
                        e.preventDefault();
                    } else {
                        searchForm.submit();
                    }
                }
            });
        });
    </script>
</body>

</html>
