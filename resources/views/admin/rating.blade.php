<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Ratings - Hanag's Garment</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Arial', sans-serif;
        }

        body {
            background-color: #f9f9f9;
            font-family: Arial, sans-serif;
        }

        .container {
            padding: 30px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            max-width: 1200px;
            margin: 0 auto;
        }

        .main-content-inner {
            flex: 1;
            padding: 10px;
            background-color: white;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            overflow-y: auto;
        }

        h1, h2 {
            color: #333;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }

        table th, table td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ddd;
        }

        table th {
            background-color: #f471b7;
            color:white;
        }

        /* Chart Styles */
        #ratingsPieChart {
            width: 100%;
            max-width: 500px;
            height: 300px;
            margin-top: 30px;
        }

        .alert {
            padding: 10px;
            background-color: #ff66b2;
            color: white;
            border-radius: 5px;
            text-align: center;
            margin-top: 20px;
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

    <div class="main-content-inner">
        <div class="container">
            <h1>Product Ratings</h1>

            <!-- Table for User Ratings -->
            <h2>User Ratings for Products</h2>
            <table>
                <thead>
                    <tr>
                        <th>Product Name</th>
                        <th>User Name</th>
                        <th>Rating</th>
                        <th>Message</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($productReviews as $review)
                        <tr>
                            <td>{{ $review['product_name'] }}</td>
                            <td>{{ $review['full_name'] }}</td>
                            <td>{{ $review['rating'] }} / 5</td>
                            <td>{{ $review['message'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>


        </div>
    </div>
</body>
</html>
