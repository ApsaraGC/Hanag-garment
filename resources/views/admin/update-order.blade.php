<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Brand</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        /* General Styles */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 20px;
            color: #333;
        }

        .container {
            max-width: 600px;
            margin: auto;
            background: white;
            padding: 30px;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.1);
            border-radius: 15px;
            background-color: #ffffff;
        }

        h3 {
            text-align: center;
            color: #ff1493;
            margin-bottom: 20px;
        }

        /* Form Styling */
        .form-group {
            margin-bottom: 20px;
        }

        label {
            font-weight: bold;
            display: block;
            margin-bottom: 8px;
            color: #444;
        }

        input[type="text"],
        input[type="file"],
        select,
        input[type="number"] {
            width: 100%;
            padding: 12px;
            border: 1px solid #ff66b2;
            border-radius: 5px;
            outline: none;
            font-size: 16px;
            background-color: #fafafa;
        }

        input[type="text"]:focus,
        input[type="file"]:focus,
        select:focus,
        input[type="number"]:focus {
            border-color: #ff1493;
        }

        .form-group select {
            background-color: #fff;
        }

        /* Image Preview */
        .image-preview {
            width: 100px;
            height: 100px;
            border: 1px solid #ff66b2;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 10px;
            overflow: hidden;
            border-radius: 5px;
        }

        .image-preview img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* Buttons */
        .btn-container {
            display: flex;
            justify-content: space-between;
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
            font-size: 16px;
            text-align: center;
        }

        .btn-primary {
            background: #ff1493;
        }

        .btn-primary:hover {
            background: #cc117a;
        }

        .btn-secondary {
            background: #888;
        }

        .btn-secondary:hover {
            background: #555;
        }

        /* Tooltip Styling */
        .tooltip {
            position: relative;
            display: inline-block;
        }

        /* Hide number input spinners */
        input[type="number"]::-webkit-outer-spin-button,
        input[type="number"]::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        input[type="number"] {
            -moz-appearance: textfield;
        }
    </style>
</head>

<body>

    <div class="container">
        <h3>Update Order</h3>

        <!-- Order Form - Create or Edit -->
        <form action="{{ isset($order) ? route('admin.updateOrder', $order->id) : route('admin.storeOrder') }}" method="POST">
            @csrf
            @if (isset($order))
                @method('PUT')
            @endif

            <div class="form-group">
                <label for="user_id">User ID</label>
                <!-- Replacing select dropdown with text input for User ID -->
                <input type="text" name="user_id" id="user_id" class="form-control" placeholder="Enter User ID"
                    value="{{ isset($order) ? $order->user_id : '' }}" required>
            </div>

            <div class="form-group">
                <label for="order_type">Order Type</label>
                <input type="text" name="order_type" id="order_type" class="form-control" placeholder="Enter Order Type"
                    value="{{ isset($order) ? $order->order_type : '' }}" required>
            </div>

            <div class="form-group">
                <label for="sub_total">Sub Total</label>
                <input type="number" name="sub_total" id="sub_total" class="form-control" placeholder="Enter Sub Total"
                    value="{{ isset($order) ? $order->sub_total : '' }}" required>
            </div>

            <div class="form-group">
                <label for="total_amount">Total Amount</label>
                <input type="number" name="total_amount" id="total_amount" class="form-control" placeholder="Enter Total Amount"
                    value="{{ isset($order) ? $order->total_amount : '' }}" required>
            </div>

            <div class="form-group">
                <label for="status">Status</label>
                <select name="status" id="status" class="form-control">
                    <option value="pending" {{ isset($order) && $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="completed" {{ isset($order) && $order->status == 'completed' ? 'selected' : '' }}>Completed</option>
                    <option value="cancelled" {{ isset($order) && $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>
            </div>

            <div class="btn-container">
                <button type="submit" class="btn btn-primary">
                    {{ isset($order) ? 'Update Order' : 'Create Order' }}
                </button>
            </div>
        </form>
    </div>

    <script>
        // Show success alert on form submit
        document.querySelector("form").addEventListener("submit", function(e) {
            e.preventDefault();  // Prevent form submission
            Swal.fire({
                title: 'Success!',
                text: 'Your order has been successfully updated!',
                icon: 'success',
                confirmButtonText: 'Ok'
            }).then(function() {
                e.target.submit();  // Submit form after the alert
            });
        });
    </script>

</body>

</html>
