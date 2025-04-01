<!-- resources/views/admin/orders.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Orders</title>
    <style>
        /* General Styles */
      /* General Styles */
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    display: flex;
}

/* Sidebar (Navbar) Styles */
.admin-panels {
    color: white;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    position: fixed;
    height: 100%;
}

/* Main Content Styles */
.main-content-inner {
    flex: 1;
    margin-left: 200px; /* Offset for the sidebar */
    padding: 20px;
    background-color: #fff;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    border-radius: 15px;
    height: 100vh; /* To prevent long size issues */

}

/* Header */
h3 {
    color: #ff1493;
    margin: 0;
}

/* Breadcrumbs */
.breadcrumbs {
    list-style: none;
    padding: 0;
    display: flex;
    gap: 10px;
}

.breadcrumbs a {
    text-decoration: none;
    color: #ff66b2;
}

.breadcrumbs a:hover {
    text-decoration: underline;
}



.no-results-message {
    text-align: center;
    color: #888;
    font-size: 16px;
    margin-top: 20px;
}



/* Buttons */
.btn {
    padding: 10px 15px;
    background: #ff1493;
    color: white;
    border: none;
    border-radius: 5px;
    text-decoration: none;
    transition: 0.3s;
    cursor: pointer;
    margin-left: 10px;
}

.btn:hover {
    background: #cc117a;
}

/* Table */
table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
    background-color: white;
}

th, td {
    border: 1px solid #ffc0cb;
    padding: 12px;
    text-align: left;
}

th {
    background:  #ff66b2;
    color: white;
}

tr:hover {
    background: #ffe6f2;
}

/* Action Icons */
.action-icons {
    display: flex;
    gap: 10px;
}

.action-icons a {
    color: #ff1493;
    text-decoration: none;
    font-size: 18px;
    transition: 0.3s;
}

.action-icons a:hover {
    color: #cc117a;
}

/* Pagination */
.pagination {
    text-align: center;
    margin-top: 20px;
}

/* Pagination */
.pagination {
    text-align: center;
    margin-top: 20px;
}

.pagination a {
    padding: 8px 15px;
    border: 1px solid #ff1493;
    color: #ff1493;
    text-decoration: none;
    border-radius: 5px;
    margin-bottom: 15px;
    transition: 0.3s;
    font-weight: bold;
}

.pagination .page-item {
    display: inline-block;
    margin: 0 5px;
    margin-bottom: 5px;
}



/* Flexbox Utility */
.flex {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
}
    </style>

    <!-- FontAwesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

</head>

<body>
    <div class="admin-panels">
        @include('admin.navbar') <!-- Sidebar -->
    </div>
    <div class="main-content-inner">
        <div class="main-content-wrap">
            <div class="flex">
                <h3>All Orders</h3>
                {{-- <a href="{{ route('admin.createOrder') }}" class="btn">Create Order</a> --}}
            </div>

            <!-- Display success message -->
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Orders Table -->
            <table border="1">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Order Type</th>
                        <th>Total Amount</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                        <tr>
                            <td>{{ $order->id }}</td>
                            <td>{{ $order->order_type }}</td>
                            <td>{{ $order->total_amount }}</td>
                            <td>{{ $order->status }}</td>
                            <td class="action-icons">
                                <a href="{{ route('admin.update-order', ['order' => $order->id]) }}">
                                    <i class="fas fa-edit"></i>
                                </a>


                                <form action="{{ route('admin.destroyOrder', ['order' => $order->id]) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" style="background:none;border:none;color:#ff1414;cursor:pointer;" onclick="return confirm('Are you sure?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>



        </div>
          <!-- Pagination -->
          <div class="pagination">
            {{ $orders->links('vendor.pagination.bootstrap-5') }} <!-- Or 'bootstrap-5' depending on your version -->
        </div>
    </div>
</body>

</html>
