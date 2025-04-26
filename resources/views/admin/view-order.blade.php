<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Details</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        /* General Styles */
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f7fc;
        }

        .admin-panels {
            height: 70px;
        }

        .content-scroll {
            display: flex;
            justify-content: center;
            flex-grow: 1;
            padding: 20px;
            overflow-y: auto;
            margin-bottom: 10px;
        }

        .container {
            width: 80%;
            max-width: 1200px;
            background-color: #ffffff;
            padding: 30px;
            height: 700px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #ff1493;
            margin-bottom: 20px;
        }

        h3 {
            color: #333;
            margin-bottom: 10px;
            font-size: 1.2rem;
        }

        .order-details {
            display: flex;
            justify-content: space-between;
            gap: 40px;
            margin-bottom: 30px;
        }

        /* User Information */
        .user-info, .order-info {
            width: 48%; /* Half-width for two columns */
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
        }

        .user-info p, .order-info p {
            margin: 8px 0;
            font-size: 1rem;
            color: #555;
        }

        .user-info p strong, .order-info p strong {
            color: #333;
        }

        /* Styling for Table */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f7f7f7;
            color: #333;
            font-weight: bold;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        .status-pending {
            color: #ffca28;
        }

        .status-completed {
            color: #28a745;
        }

        .status-canceled {
            color: #dc3545;
        }

        /* Button Styling */
        .btn-container {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .btn {
            padding: 12px 20px;
            color: white;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            cursor: pointer;
            transition: 0.3s;
        }

        .btn-primary {
            background: #ff1493;
        }

        .btn-primary:hover {
            background: #cc117a;
        }

        /* SweetAlert Styling */
        .swal-popup-small {
            font-size: 14px;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .container {
                width: 90%;
                padding: 20px;
            }

            .order-details {
                flex-direction: column;
            }

            .user-info, .order-info {
                width: 100%;
                margin-bottom: 20px;
            }
        }
    </style>
</head>

<body>

    <div class="admin-panels">
        @include('admin.navbar')
    </div>

    @if(session('popup_message'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Success',
            text: '{{ session('popup_message') }}',
            timer: 3000,
            showConfirmButton: false,
            width: '350px',
            padding: '5px',
            customClass: {
                popup: 'swal-popup-small'
            }
        });
    </script>
    @endif

    <div class="content-scroll">
        <div class="container">
            <h1>Order {{ $order->id }} Details</h1>

            <div class="order-details">
                <div class="user-info">
                    <h3>User Information</h3>
                    <p><strong>Name:</strong> {{ $order->user->full_name }}</p>
                    <p><strong>Email:</strong> {{ $order->user->email }}</p>
                    <p><strong>Phone:</strong> {{ $order->user->phone_number }}</p>
                </div>

                <div class="order-info">
                    <h3>Order Total</h3>
                    <p><strong>Status:</strong> <span class="status-{{ strtolower($order->status) }}">{{ ucfirst($order->status) }}</span></p>
                    <p><strong>Subtotal:</strong> Rs. {{ number_format($order->sub_total, 2) }}</p>
                    <p><strong>Payment Type:</strong> {{ $order->payment->payment_method }}</p>                    <p><strong>Total Amount:</strong> Rs. {{ number_format($order->total_amount, 2) }}</p>
                    <p><strong>Payment Date:</strong> {{ $order->payment->payment_date->format('F j, Y') }}</p>
                </div>
            </div>
            <h3>Products in this Order</h3>
            <table>
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Product Name</th>
                        <th>Size</th>

                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order->products as $product)
                        <tr>
                            <td>
                                @if($product->image)
                                    <img src="{{ asset($product->image) }}" width="50" alt="{{ $product->product_name }}">
                                @else
                                    No Image
                                @endif
                            </td>
                            <td>{{ $product->product_name }}</td>
                            <td>{{ $product->size }}</td>
                            <td>{{ $product->pivot->quantity }}</td>
                            <td>Rs. {{ number_format($product->pivot->price, 2) }}</td>
                            <td>Rs. {{ number_format($product->pivot->quantity * $product->pivot->price, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="btn-container">
                <a href="{{ route('admin.order') }}" class="btn btn-primary">Back to Orders</a>
            </div>
        </div>
    </div>
</body>

</html>
