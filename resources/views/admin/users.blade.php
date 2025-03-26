<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Users</title>
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <style>
        body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
}

.container {
    width: 80%;
    margin: 30px auto;
    padding: 20px;
    background-color: #fff;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

h1 {
    font-size: 24px;
    margin-bottom: 20px;
}

form {
    margin-bottom: 20px;
}

input[type="text"] {
    padding: 8px;
    font-size: 16px;
    width: 300px;
}

button {
    padding: 8px 16px;
    font-size: 16px;
    cursor: pointer;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

th, td {
    padding: 12px;
    text-align: left;
    border: 1px solid #ddd;
}

th {
    background-color: #f2f2f2;
}

        </style>
</head>
<body>
    <div class="admin-panels">
        <!-- Sidebar -->
        @include('admin.navbar')
    </div>
    <div class="container">
        <h1>User Management</h1>

        <!-- Total Users -->
        <p>Total Users: {{ $totalUsers ?? count($users) }}</p>

        <!-- Search Form -->
        <form method="GET" action="{{ route('admin.search.users') }}">
            <input type="text" name="search" placeholder="Search by name or email" value="{{ request('search') }}">
            <button type="submit">Search</button>
        </form>

        <!-- Users Table -->
        <table>
            <thead>
                <tr>
                    <th>S.N</th>
                    <th>Full Name</th>
                    <th>Phone Number</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $index => $user)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $user->full_name }}</td>
                        <td>{{ $user->phone_number ?? 'N/A' }}</td>
                        <td>{{ $user->email }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
