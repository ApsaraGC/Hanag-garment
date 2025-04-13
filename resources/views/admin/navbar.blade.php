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
            display: flex;

            color: #fff;
            display: flex;
            flex-direction: column;
        }

        .sidebar h2 {
            font-size: 22px;
            color: #fff;
            text-align: left;
            margin-bottom: 2px;
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
            font-size: 17px;
            display: flex;
            align-items: center;
            padding: 10px;
            border-radius: 5px;
            transition: all 0.3s ease;
        }
        .sidebar ul li a i {
            margin-right: 10px;
            font-size: 20px;
        }
        .sidebar ul li a:hover {
            background-color: #e51d8e;
            color: white;
        }
    </style>
</head>
<body>
    <div class="admin-panel">
        <!-- Sidebar -->
        <div class="sidebar" id="sidebar">
            <h2>Hanas Garment</h2>
            <ul>
                <li><a href="{{route('admin.dashboard')}}" class="active"><i class="fa fa-tachometer-alt"></i> Dashboard</a></li>
                <li><a href="{{route('admin.products')}}"><i class="fa fa-cogs"></i> Products</a></li>
                <li><a href="{{route('admin.brands')}}"><i class="fa fa-archive"></i> Brand</a></li>
                <li><a href="{{route('admin.categorys')}}"><i class="fa fa-th-large"></i> Category</a></li>
                <li><a href="{{route('admin.order')}}"><i class="fa fa-box"></i> Orders</a></li>
                <li><a href="{{route('admin.users')}}"><i class="fa fa-users"></i> Users</a></li>
                <li><a href="{{route('admin.messages')}}"><i class="fa fa-envelope"></i> Messages</a></li>
                <li><a href="{{route('admin.rating')}}"><i class="fa fa-star"></i> Rating</a></li>

                <!-- Authentication (login/logout) -->
                <li>
                    @if (Route::has('login'))
                        @auth
                            <form method="POST" action="{{route('logout')}}" id="logout-form">
                                @csrf
                            <a href="{{route('logout')}}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fa fa-sign-out-alt"></i> Logout                            </a>
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
