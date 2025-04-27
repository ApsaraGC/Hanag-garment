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
            overflow-x: hidden;
            margin-left: 200px;
            /* Offset for the sidebar */
            padding: 20px;
            background-color: #fff;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            border-radius: 15px;
            height: 100vh;
            /* To prevent long size issues */

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

        th,
        td {
            border: 1px solid #ffc0cb;
            padding: 12px;
            text-align: left;
        }

        th {
            background: #ff66b2;
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

        tbody tr:nth-child(odd) {
            background-color: #fff0f5;
            /* light pink */
        }

        tbody tr:nth-child(even) {
            background-color: #ffe4ec;
            /* slightly different pink */
        }



        /* Flexbox Utility */
        .flex {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        /* Dropdown Button */
        .dropdown-toggle {
            padding: 10px 20px;
            background: #ff1493;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            display: flex;
            justify-content: center;
            align-items: center;
            transition: 0.3s;
        }

        .dropdown-toggle:hover {
            background: #cc117a;
        }

        .order-list {
            display: none;
            margin-top: 20px;
            padding: 10px;
            background: #ffe6f2;
            border-radius: 5px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }

        .order-list.active {
            display: block;
        }

        .order-list td {
            padding: 8px;
            border: 1px solid #ffc0cb;
        }

        .status-dropdown {
            padding: 5px 10px;
            border-radius: 5px;
            border: 1px solid #ff1493;
            background-color: #ffe6f2;
            color: #ff1493;
            font-size: 14px;
            cursor: pointer;
        }

        .status-dropdown:hover {
            background-color: #ff1493;
            color: white;
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
            <div class="flex" style="display: flex; justify-content: space-between; align-items: center;">
                <h3>All Orders</h3>
                {{-- <a href="{{ route('admin.createOrder') }}" class="btn">Create Order</a> --}}
            </div>


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

            <!-- Orders Table -->
            <table border="1">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>User Name</th>
                        <th>User Address</th>
                        <th>User Phone</th>
                        <th>Payment Type</th>
                        <th>Product Name</th>
                        <th>Total Amount</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                        <tr>
                            <td>{{ $order->id }}</td>
                            <td>{{ $order->user->full_name ?? 'N/A' }}</td> <!-- User Name -->
                            <td>{{ $order->user->address ?? 'N/A' }}</td> <!-- User Address -->
                            <td>{{ $order->user->phone_number ?? 'N/A' }}</td> <!-- User Address -->

                            <td>{{ $order->order_type }}</td>
                            <td>
                                @if ($order->products->isNotEmpty())
                                    @foreach($order->products as $product)
                                        {{ $product->product_name ?? 'N/A' }}
                                        <br>
                                    @endforeach
                                @else
                                    No Products Found.
                                @endif

                            </td>
                            <td>{{ $order->total_amount }}</td>
                            <td>
                                <form action="{{ route('admin.updateOrder', ['order' => $order->id]) }}" method="POST"
                                    class="status-form">
                                    @csrf
                                    @method('PUT')
                                    <select name="status" onchange="this.form.submit()" class="status-dropdown">
                                        <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending
                                        </option>
                                        <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>
                                            Completed</option>
                                        <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>
                                            Cancelled</option>
                                    </select>
                                </form>
                            </td>

                            {{-- <td>{{ $order->status }}</td> --}}
                            <td>
                                {{-- <a href="{{ route('admin.update-order', ['order' => $order->id]) }}">
                                    <i class="fas fa-edit"></i>
                                </a> --}}
                                <!-- View Icon -->
                                <a href="{{ route('admin.view-order', ['order' => $order->id]) }}"
                                    style=" color: #ff1493; text-decoration: none; font-size: 18px;transition: 0.3s;">
                                    <i class="fas fa-eye"></i> <!-- Eye icon for viewing order -->
                                </a>
                                {{-- <form action="{{ route('admin.destroyOrder', ['order' => $order->id]) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" style="background:none;border:none;color:#ff1414;cursor:pointer;"
                                        onclick="return confirm('Are you sure?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form> --}}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Pagination -->
            <div class="pagination">
                {{ $orders->links('vendor.pagination.bootstrap-5') }}
            </div>
        </div>
    </div>
</body>
<script>
    // Toggle Dropdown
    function toggleDropdown() {
        const orderList = document.getElementById('orderList');
        orderList.classList.toggle('active');
    }
</script>

</html>
