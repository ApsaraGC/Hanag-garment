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
            font-family: Arial, sans-serif;
            background-color: #ffe6f2;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 600px;
            margin: auto;
            background: white;
            padding: 20px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        h3 {
            text-align: center;
            color: #ff1493;
        }

        /* Form Styling */
        .form-group {
            margin-bottom: 15px;
        }

        label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="file"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ff66b2;
            border-radius: 5px;
            outline: none;
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
            padding: 10px 15px;
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

        .btn-secondary {
            background: #888;
        }

        .btn-secondary:hover {
            background: #555;
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
        <label for="user_id">User</label>
        <select name="user_id" id="user_id" class="form-control">
            @foreach($users as $user)
                <option value="{{ $user->id }}" {{ isset($order) && $order->user_id == $user->id ? 'selected' : '' }}>
                    {{ $user->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label for="order_type">Order Type</label>
        <input type="text" name="order_type" id="order_type" class="form-control" value="{{ isset($order) ? $order->order_type : '' }}" required>
    </div>

    <div class="form-group">
        <label for="sub_total">Sub Total</label>
        <input type="number" name="sub_total" id="sub_total" class="form-control" value="{{ isset($order) ? $order->sub_total : '' }}" required>
    </div>

    <div class="form-group">
        <label for="total_amount">Total Amount</label>
        <input type="number" name="total_amount" id="total_amount" class="form-control" value="{{ isset($order) ? $order->total_amount : '' }}" required>
    </div>

    <div class="form-group">
        <label for="status">Status</label>
        <select name="status" id="status" class="form-control">
            <option value="pending" {{ isset($order) && $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
            <option value="completed" {{ isset($order) && $order->status == 'completed' ? 'selected' : '' }}>Completed</option>
            <option value="cancelled" {{ isset($order) && $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
        </select>
    </div>

    <button type="submit" class="btn btn-primary">
        {{ isset($order) ? 'Update Order' : 'Create Order' }}
    </button>
</form>

    </div>

    <script>
        // Function to Preview Image Before Uploading
        function previewImage(event) {
            var preview = document.getElementById("imagePreview");
            var file = event.target.files[0];
            var reader = new FileReader();

            reader.onload = function() {
                preview.innerHTML = '<img src="' + reader.result + '">';
            }

            if (file) {
                reader.readAsDataURL(file);
            }
        }
    </script>

</body>

</html>
