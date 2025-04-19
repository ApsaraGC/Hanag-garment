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

              <!-- Dropdown Button -->
              <button class="dropdown-toggle" onclick="toggleDropdown()">
                <i class="fas fa-chevron-down" id="chevronIcon"></i> View Orders
            </button>

            <!-- Order List -->
            <div class="order-list" id="orderList">
                <table>
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>View Bill</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr>
                                <td>{{ $order->id }}</td>
                                <td>
                                    <a href="{{ route('admin.vieworder', ['id' => $order->id]) }}">
                                        <i class="fas fa-gift"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
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
