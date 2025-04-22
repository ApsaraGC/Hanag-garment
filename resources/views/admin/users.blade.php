<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Users</title>

    <!-- FontAwesome CDN for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Optional external CSS -->
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
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
            width: 50%;
        }

        .sidebar {
            width: 200px;
            /* Reduced from 250px */
            background-color: #ff69b4;
            padding: 20px;
            color: #fff;
            display: flex;
            flex-direction: column;
        }

        .sidebar h2 {
            font-size: 22px;
            color: #fff;
            margin-bottom: 10px;
        }

        .sidebar ul {
            list-style: none;
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
        }

        .sidebar ul li a:hover {
            background-color: #e51d8e;
        }

        .main-content {
            flex: 1;
            padding: 30px;
            background-color: #f9f9f9;
        }

        .main-content h1 {

            color: #ff1493;
            margin: 0;
            text-align: center;
            font-size: 30px;

        }

        table {
            width: 1000px;
            border-collapse: collapse;
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        th,
        td {
            padding: 12px 15px;
            text-align: left;
        }

        thead {
            background-color: #ff69b4;
            color: white;
        }

        tbody tr:nth-child(odd) {
            background-color: #fff0f5;
            /* light pink */
        }

        tbody tr:nth-child(even) {
            background-color: #ffe4ec;
            /* slightly different pink */
        }

        /* Buttons */
        .btn {
            padding: 10px 15px;
            background: #ff1493;
            color: white;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            font-size: 14px;
            font-weight: bold;
            transition: background 0.3s;
            cursor: pointer;
            margin-left: auto;
            display: block;
        }

        .btn:hover {
            background: #cc117a;
        }

        .btn-container {
            display: flex;
            justify-content: flex-end;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    @if(session('popup_message'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: '{{ session('popup_message') }}',
                timer: 3000,
                showConfirmButton: false,
                width: '350px',  // Adjust width as needed
                padding: '5px', // Optional: Adjust padding
                customClass: {
                    popup: 'swal-popup-small'
                }
            });
        </script>
    @endif
    <div class="admin-panel">
        <!-- Sidebar -->
        @include('admin.navbar')
        <!-- Main Content -->
        <div class="main-content">
            <h1>User Management</h1>
            <div class="btn-container">
                <a href="{{ route('add-user') }}" class="btn">Add User</a>
            </div>
            <!-- Total Users -->
            <p>Total Users: {{ $totalUsers ?? count($users) }}</p>
            {{-- <!-- Search Form -->
            <form method="GET" action="{{ route('admin.search.users') }}">
                <input type="text" name="search" placeholder="Search by name or email" value="{{ request('search') }}">
                <button type="submit">Search</button>
            </form> --}}

            <!-- Users Table -->
            <table>
                <thead>
                    <tr>
                        <th>S.N</th>
                        <th>Full Name</th>
                        <th>Phone Number</th>
                        <th>Email</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $index => $user)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $user->full_name }}</td>
                            <td>{{ $user->phone_number ?? 'N/A' }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                <a href="{{ route('editUser', $user->id) }}" title="Edit"><i class="fas fa-edit"
                                        style="color:rgb(255, 0, 200);"></i></a>
                                <a href="{{ route('deleteUser', $user->id) }}" title="Delete"
                                    onclick="return confirm('Are you sure you want to delete this user?')"><i
                                        class="fas fa-trash" style="color:red;"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>
