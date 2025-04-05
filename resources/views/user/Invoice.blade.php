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

        .payment-container {
            max-width: 400px;
            margin: 40px auto;
            padding: 25px;
            background-color: #fff;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            border: 1px solid #ddd;
        }

        .header {
            text-align: center;
            font-size: 22px;
            font-weight: bold;
            color: black;
            margin-bottom: 15px;
        }

        .transaction-details {
            background-color: #fafafa;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .transaction-details h3 {
            font-size: 18px;
            margin-bottom: 20px;
        }

        .transaction-details p {
            display: flex;
            justify-content: space-between;
            font-size: 16px;
            margin: 10px 0;
        }

        .transaction-details p span {
            font-weight: bold;
            color: #333;
        }

        .address-section {
            margin-top: 20px;
            padding: 20px;
            background-color: #f3f3f3;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .address-section h4 {
            font-size: 18px;
            margin-bottom: 15px;
            color: #333;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .form-group input {
            width: 90%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
        }



.button-group {
    display: flex;
    justify-content: space-between;
    gap: 10px;
    margin-top: 15px;
}

.save-btn {
    background-color: #F070BB;
    color: #fff;
    padding: 12px;
    text-align: center;
    border: none;
    border-radius: 5px;
    font-size: 16px;
    cursor: pointer;
    width: 100%; /* Ensure buttons take up half the width */
    transition: 0.3s ease;
}

.save-btn:hover {
    background-color: #ec49a8;
}
.cancel-btn {
    background-color: #ff3333;
    color: #fff;
    padding: 12px;
    text-align: center;
    border-radius: 5px;
    font-size: 14px;
    cursor: pointer;
    width: 20%; /* Ensure buttons take up half the width */
    text-decoration: none;
    transition: 0.3s ease;
}

.cancel-btn:hover {
    background-color: #e02b2b;
}

    </style>
</head>

<body>
    @include('layouts.navigation')

    <div class="payment-container">

        <div class="transaction-details">
            <div class="header">Hanag Garments - Payment</div>
            {{-- <form action="{{ route('user.orderBill') }}" method="POST" id="orderForm">
                @csrf --}}


                <h3>Hello, <span>{{ Auth::user()->full_name }}</span></h3>
                <p><span>Address</span> <span>{{ $user->address ?? 'No address set' }}</span></p>
                <hr>
                <p><span>Payment Type</span> <span>{{ $paymentType }}</span></p>
                <p><span>Subtotal</span> <span>Rs. {{ number_format($subtotal, 2) }}</span></p>
                <p><span>Delivery Charge</span> <span>Rs. {{ number_format($deliveryCharge, 2) }}</span></p>
                <hr>
                <p><span>Total</span> <span>Rs. {{ number_format($total, 2) }}</span></p>
                <div class="button-group">
                    <form action="{{ route('user.placeOrder') }}" method="POST">
                        @csrf
                        <button type="submit" class="save-btn">Confirm Your Order</button>
                    </form>
                    <a href="{{ route('user.cart') }}" class="cancel-btn">Cancel</a>
                </div>

        </div>

        <div class="address-section">
            <h4>Update Your Address</h4>
            <form action="{{ route('update.address') }}" method="POST">
                @csrf
                <div class="form-group">
                    <input type="text" id="address" name="address" value="{{ Auth::user()->address ?? '' }}" placeholder="Enter your new address" required>
                </div>
                <button type="submit" class="save-btn">Save Address</button>
            </form>
        </div>
    </div>
    @include('layouts.footer')


    {{-- <script>
    // Handling the confirmation order submission and triggering SweetAlert
    document.getElementById('orderForm').addEventListener('submit', function(event) {
        event.preventDefault();  // Prevent the form from submitting immediately

        // Here, you can make an Ajax request if needed to confirm the order and then trigger the popup.
        Swal.fire({
            title: 'Order Confirmed!',
            text: 'Your order has been confirmed successfully.',
            icon: 'success',
            confirmButtonText: 'Close',
        }).then((result) => {
            if (result.isConfirmed) {
                // After clicking 'Close', submit the form
                this.submit();  // Submit the form after the popup closes
            }
        });
    });
</script> --}}


</body>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener("DOMContentLoaded", function () {
    document.querySelector('.save-btn').addEventListener('click', function () {
        let formData = new FormData(document.getElementById("orderForm"));

        fetch("{{ route('user.placeOrder') }}", {
            method: "POST",
            body: formData,
            headers: {
                "X-CSRF-TOKEN": document.querySelector("meta[name='csrf-token']").content,
                "Accept": "application/json"
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.order_id) {
                Swal.fire({
                    title: "Order Confirmed!",
                    text: "Your order has been placed successfully.",
                    icon: "success",
                    confirmButtonText: "View Order Bill"
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Redirect to the order bill page with the order ID
                        window.location.href = "{{ url('/order') }}/" + data.order_id + "/bill";
                    }
                });
            } else {
                Swal.fire("Error", "Failed to place the order.", "error");
            }
        })
        .catch(error => {
            console.error("Error:", error);
            Swal.fire("Error", "Something went wrong!", "error");
        });
    });
});
</script>






</html>
