<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Invoice - Hanag Garments</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />

    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #fff;
            margin: 0;
            padding: 0;
        }

        .invoice-box {
            max-width: 500px;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #eee;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
            color: #555;
            font-size: 14px;
        }

        .top-section {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #F070BB;
            color: white;
            padding: 15px 20px;
            border-radius: 8px 8px 0 0;
        }

        .top-section h1 {
            margin: 0;
            font-size: 24px;
        }

        .top-section img {
            height: 50px;
        }

        .info p {
            margin: 2px 0;
        }

        .address-section {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
        }

        .address-block h4 {
            margin: 0 0 4px;
        }

        .item-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        .item-table th {
            background-color: #F070BB;
            color: white;
            padding: 8px;
            text-align: left;
            font-size: 13px;
        }

        .item-table td {
            padding: 8px;
            border-bottom: 1px solid #eee;
        }

        .totals {
            margin-top: 1px;
            text-align: right;
        }

        .totals p {
            margin: 4px 0;
        }

        .bank-details,
        .notes,
        .footer {
            margin-top: 20px;
            font-size: 13px;
        }

        .footer {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            border-top: 1px solid #eee;
            padding-top: 1px;
            color: #999;
            flex-wrap: nowrap;
            /* prevent wrapping */
        }

        .footer>div {
            flex: 1;
        }

        .footer .notes {
            text-align: right;
        }

        @media(max-width: 600px) {
            .top-section {
                flex-direction: column;
                text-align: center;
            }

            .top-section img {
                margin-top: 10px;
            }

            .address-section {
                flex-direction: column;
                gap: 10px;
            }

            .footer {
                flex-direction: column;
                align-items: flex-start;
            }
        }

        .item-table td img {
            max-height: 60px;
            max-width: 60px;
            object-fit: cover;
        }
    </style>
</head>

<body>
    @include('layouts.navigation')

    <div class="invoice-box">
        <div class="top-section">
            <div>
                <h1>Order Successful</h1>
                <div class="info">
                    <p>Invoice No: {{ $order->id }}</p>
                    <p>Date: {{ $order->created_at->format('d M Y') }}</p>
                </div>
            </div>
            <img style="background-color:#eee; border-radius: 50%;" src="{{ asset('build/assets/images/logo1.png') }}"
                alt="Hanag Logo">
        </div>

        <div class="address-section">
            <div class="address-block">
                <h4>PAYABLE TO</h4>
                <p>Hanag Garments<br>Pokhara, Nepal</p>
            </div>
            <div class="address-block">
                <h4>BILL FROM</h4>
                <p>{{ $user->full_name }}<br>{{ $user->address }}</p>
            </div>
        </div>

        <table class="item-table">
            <thead>
                <tr>
                    <th>PRODUCT IMAGE</th>
                    <th>PRODUCT NAME</th>
                    <th>PRICE</th>
                    <th>TOTAL</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->order_items as $item)
                    <tr>
                        <td>
                            <img src="{{ asset($item->product->image) }}" alt="Product">
                        </td>
                        <td>{{ $item->product->product_name ?? 'N/A' }}</td>
                        <td>Rs.{{ number_format($item->price, 2) }}</td>
                        <td>Rs.{{ number_format($item->price * $item->quantity, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="totals">
            <p><strong>Sub Total:</strong> Rs.{{ number_format($order->sub_total, 2) }}</p>
            <p><strong>Shipping:</strong> Rs.150.00</p>
            <p><strong>Total:</strong> Rs.{{ number_format($order->total_amount, 2) }}</p>
            <p><strong>Type:</strong>{{$order->order_type}}</p>
        </div>
        <div class="footer">
            <div>
                <p><i class="fa fa-phone"></i> +977-9800000000</p>
                <p><i class="fa fa-envelope"></i> hanag@domain.com</p>
                <p><i class="fa fa-globe"></i> www.hanag.com</p>
            </div>
        </div>
        <hr>
        <p style="text-align: center;">Thank you for your purchase!</p>
    </div>
    </div>
</body>
</html>
