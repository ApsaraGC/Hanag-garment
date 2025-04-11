<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        /* Base Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            display: flex;
            height: 100vh;
        }

        .admin-panel {
            display: flex;
            width: 100%;
        }

        /* Sidebar */
        .sidebar {
            width: 100%;
            background-color: #ff69b4;
            padding: 20px;
            color: #fff;
            display: flex;
            flex-direction: column;
        }

        .sidebar h2 {
            font-size: 22px;
            color: #fff;
            text-align: left;
            margin-bottom: 20px;
        }

        .sidebar ul {
            list-style: none;
            padding-top: 0;
        }

        .sidebar ul li {
            margin: 15px 0;
        }

        .sidebar ul li a {
            text-decoration: none;
            color: #fff;
            font-size: 16px;
            display: flex;
            align-items: center;
            padding: 10px;
            border-radius: 5px;
            transition: all 0.3s ease;
        }

        .sidebar ul li a:hover {
            background-color: #ff69b4;
            color: white;
        }
        .sidebar ul li a i{
          text-decoration: none;
          margin-top: -10px;

        }
    </style>
</head>
<body>
    <div class="admin-panel">
        <!-- Sidebar -->
        <div class="sidebar">
            <h2>Hanas Garment</h2>
            <ul>
                <li><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                <li><a href="{{route('admin.products')}}">Products</a></li>
                <li><a href="{{route('admin.brands')}}">Brand</a></li>
                <li><a href="{{route('admin.categorys')}}">Category</a></li>
                <li><a href="{{route('admin.order')}}">Order</a></li>
                <li><a href="{{route('admin.users')}}">Users</a></li>
                <li><a href="{{route('admin.messages')}}">Messages</a></li>

                <li><a href="{{route('admin.rating')}}">Rating</a></li>
                <!-- Authentication (login/logout) -->
                <li>
                    @if (Route::has('login'))
                        @auth
                            <form method="POST" action="{{route('logout')}}" id="logout-form">
                                @csrf
                            <a href="{{route('logout')}}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                               <i>Logout</i>
                            </a>
                        @else
                            <a href="{{ route('login') }}"><i class="fa fa-user"></i></a>
                        @endauth
                    @endif
                </li>
            </ul>
        </div>

        <!-- Main Content -->
    </div>
</body>
</html>
