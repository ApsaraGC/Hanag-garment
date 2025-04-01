<!DOCTYPE html>
<html>
<head>
    <title>Order Bill</title>
</head>
<body>
    <h3>Order Bill - Order ID: {{ $order->id }}</h3>
    <p><strong>User Name:</strong> {{ $user->full_name }}</p>
    <p><strong>Address:</strong> {{ $user->address ?? 'No address set' }}</p>

    <h4>Order Details</h4>
    <p><strong>Subtotal:</strong> Rs. {{ number_format($order->sub_total, 2) }}</p>
    <p><strong>Delivery Charge:</strong> Rs. {{ number_format($order->delivery_charge, 2) }}</p>
    <p><strong>Total Amount:</strong> Rs. {{ number_format($order->total, 2) }}</p>

    <p><strong>Status:</strong> {{ $order->status }}</p>
</body>
</html>
