<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment - Hanag Garments</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f8f8;
        }


    </style>
</head>
<body>
     <!-- eSewa Payment Form -->
     <form action="https://rc-epay.esewa.com.np/api/epay/main/v2/form" method="POST">
        @csrf
        <input type="text" name="amount" value="{{ $subtotal }}" required>
        <input type="text" name="tax_amount" value="{{ $total - $subtotal }}" required>
        <input type="text" name="total_amount" value="{{ $total }}" required>
        <input type="text" name="product_code" value="EPAYTEST" required>
        {{-- <input type="text" name="product_service_charge" value="0" required> --}}
        <input type="text" name="product_delivery_charge" value="{{ $deliveryCharge }}" required>
        <input type="text" id="success_url" name="success_url" value="{{ route('payment.success')}}" required>
        <input type="text" id="failure_url" name="failure_url" value="{{ route('payment.failure')}}" required>
        <button type="submit" class="btn btn-primary">Proceed to eSewa</button>
    </form>

   </body>

   <script>
    document.addEventListener("DOMContentLoaded", function() {
        // You could use AJAX or check for errors in response data
        var errorMessage = "{{ session('error_message') }}"; // Assuming you pass this error message from the backend

        if (errorMessage) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: errorMessage || 'The payment service is currently unavailable. Please try again later.',
            });
        }
    });
</script>

</html>
