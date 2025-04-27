<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Customer Settings - Hanag's Garments</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-yH4G/ln9TjP/cU0R9R8tOZ2W+gXymvY3A4fUoJ8iOSh08cEVUYaK9tMbkR7whu5OIV12cYB98lHzz/0xqfFxRg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>


        body {
            font-family: 'Poppins', sans-serif;
            background: #f4f6f9;
            color: #333;
          
        }

        .container {
            max-width: 550px;
            margin: 40px auto;
            padding: 30px;
            background: #ffffff;
            border-radius: 15px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #2c3e50;
            font-size: 2.2rem;
            margin-bottom: 25px;
        }

        .customer-settings {
            padding: 10px;
        }

        .order-info,
        .account-details {
            background: #f9fafc;
            padding: 20px;
            border-left: 5px solid #F070BB;
            border-radius: 12px;
            margin-bottom: 20px;
        }

        .order-info h3,
        .account-details h3 {
            font-size: 1.5rem;
            color: #34495e;
            margin-bottom: 12px;
        }

        p {
            font-size: 1rem;
            color: #555;
            margin-bottom: 10px;
        }

        .dropdown-toggle {
            background-color: #fef2f7;
            padding: 10px 15px;
            border: none;
            width: 100%;
            font-size: 1rem;
            text-align: left;
            border-radius: 8px;
            cursor: pointer;
            color: #e91e63;
            font-weight: 500;
            margin-top: 10px;
            transition: background 0.3s ease;
        }

        .dropdown-toggle:hover {
            background-color: #fdd8e8;
        }

        .order-list {
            display: none;
            margin-top: 10px;
        }

        .order-list a {
            display: block;
            text-decoration: none;
            background: #fff0f6;
            padding: 10px 15px;
            margin: 8px 0;
            border-radius: 8px;
            color: #d63384;
            font-weight: 500;
            transition: background-color 0.3s ease;
        }

        .order-list a:hover {
            background-color: #f8d7e8;
        }

        .actions {
            text-align: center;
            margin-top: 15px;
        }

        .actions .btn {
            display: inline-block;
            padding: 12px 20px;
            text-decoration: none;
            font-size: 1rem;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.3s ease;
            cursor: pointer;
            margin: 8px;
        }

        .btn-primary {
            background-color: #F070BB;
            color: #fff;
        }

        .btn-primary:hover {
            background-color: #e62fa0;
        }

        .btn-cancel {
            background-color: #dc3545;
            color: #fff;
        }

        .btn-cancel:hover {
            background-color: #a71d2a;
        }

        .btn-delete {
            background-color: #dc3545;
            color: #fff;
            text-decoration: none;
            border: none;
        }

        .btn-delete:hover {
            background-color: #a71d2a;
        }

        @media (max-width: 768px) {
            .container {
                margin: 20px;
                padding: 20px;
            }

            h2 {
                font-size: 1.8rem;
            }

            p,
            .order-list a {
                font-size: 0.95rem;
            }
        }
    </style>
</head>
<body>

    @include('layouts.navigation')

    <div class="container">
        <div class="customer-settings">
            <h2>Account Settings</h2>

            <div class="order-info">
                <h3>My Orders</h3>
                <p><strong>Total Orders:</strong> {{ $orderCount }}</p>

                @if ($order->count() > 0)
                <button class="dropdown-toggle" onclick="toggleDropdown()">
                    <i class="fas fa-chevron-down" id="chevronIcon"></i> View Orders
                </button>
                <div class="order-list" id="orderList">
                    @foreach ($order as $orders)
                        <a href="{{ route('user.orderBill', ['orderId' => $orders->id]) }}">
                            <i class="fas fa-gift"></i> Order-{{ $orders->id }}
                        </a>
                    @endforeach
                </div>
                @else
                    <p>No orders available.</p>
                @endif
            </div>

            <div class="account-details">
                <h3>My Details</h3>
                <p><strong>Name:</strong> {{ $user->full_name }}</p>
                <p><strong>Email:</strong> {{ $user->email }}</p>
            </div>

            <div class="actions">
                <a href="{{ route('user.profile') }}" class="btn btn-primary">Edit Profile</a>
                <a href="{{ route('dashboard') }}" class="btn btn-cancel">Cancel</a>
                <button class="btn btn-delete" onclick="confirmDeleteAccount()">Delete Account</button>
            </div>
        </div>
    </div>

    @include('layouts.footer')

    <script>
        function toggleDropdown() {
            const list = document.getElementById('orderList');
            const icon = document.getElementById('chevronIcon');

            if (list.style.display === 'block') {
                list.style.display = 'none';
                icon.classList.remove('fa-chevron-up');
                icon.classList.add('fa-chevron-down');
            } else {
                list.style.display = 'block';
                icon.classList.remove('fa-chevron-down');
                icon.classList.add('fa-chevron-up');
            }
        }

        function confirmDeleteAccount() {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete my account!'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-account-form').submit();
                }
            });
        }
    </script>

    <form id="delete-account-form" action="{{ route('user.delete') }}" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
    </form>

</body>
</html>
