<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment - Hanag Garments</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

   
</head>
<body>
    <!-- Include Navigation -->
    @include('layouts.navigation')

     <form id="checkout-form" method="POST" action="{{ route('user.placeOrder') }}">
                    @csrf
                    <div class="payment-method">

                        <label name="payment_method" value="" id="esewa">
                             < type="" name="payment_method" value="" id="esewa">
                         </label><br>
                        <label>
                            <input type="checkbox" name="payment_method" value="cod" id="cod">
                            COD<span style="font-size: 12px; color:#666; margin-bottom: 5px;"> (Inside Pokhara valley
                                only)</span>
                        </label>
                    </div>
                </form>
                <form id="checkout-form" method="POST" action="{{ route('khalti.callback') }}">
                <label>
                    <input type="checkbox" name="payment_method" value="khalti" id="khalti"> Khalti
                </label>

                </form>

    @include('layouts.footer')
</body>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const checkoutLink = document.getElementById('checkout-link');
        const checkoutForm = document.getElementById('checkout-form');
        const khaltiCheckbox = document.getElementById('khalti');
        const esewaCheckbox = document.getElementById('esewa');
        const codCheckbox = document.getElementById('cod');
        const esewaForm = document.getElementById('esewa-payment-form');
        const esewaAmtInput = document.getElementById('esewa-amt');
        const esewaTAmtInput = document.getElementById('esewa-tAmt');
        const esewaPidInput = document.getElementById('esewa-pid');

        checkoutLink.addEventListener('click', function (event) {
            event.preventDefault(); // Prevent the default link behavior

            let selectedPayment = null;
            let isChecked = false;

            if (khaltiCheckbox.checked) {
                selectedPayment = 'khalti';
                isChecked = true;
            } else if (esewaCheckbox.checked) {
                selectedPayment = 'esewa';
                isChecked = true;
            } else if (codCheckbox.checked) {
                selectedPayment = 'cod';
                isChecked = true;
            }

            if (isChecked) {
                // Create a hidden input for the payment method
                const paymentMethodInput = document.createElement('input');
                paymentMethodInput.setAttribute('type', 'hidden');
                paymentMethodInput.setAttribute('name', 'payment_method');
                paymentMethodInput.setAttribute('value', selectedPayment);
                checkoutForm.appendChild(paymentMethodInput);

                // Submit the form to the placeOrder route
                fetch(checkoutForm.action, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: new URLSearchParams(new FormData(checkoutForm)).toString()
                })
                .then(response => response.json())
                .then(data => {
                    if (selectedPayment === 'khalti' && data.order_id && data.amount) {
                        // const amountInPaisa = Math.round(parseFloat(document.getElementById('total-amount').innerText) * 100); // Get total and convert to paisa
                        const amountInPaisa = Math.trunc(data.amount);                      // Ensure this is echoed correctly
                        // Redirect to Khalti initiation route with amount in paisa
                        window.location.href = `/khalti/initiate?order_id=${data.order_id}&amount=${amountInPaisa}`;
                    } else if (selectedPayment === 'esewa' && data.redirect_url) {
                        fetch(`/esewa/payment-details/${data.order_id}`)
                            .then(response => response.json())
                            .then(esewaData => {
                                if (esewaData.amount && esewaData.orderId) {
                                    esewaAmtInput.value = esewaData.amount;
                                    esewaTAmtInput.value = esewaData.amount;
                                    esewaPidInput.value = esewaData.orderId;
                                    esewaForm.submit();
                                } else {
                                    alert('Error preparing eSewa payment.');
                                }
                            })
                            .catch(error => {
                                console.error('Error fetching eSewa details:', error);
                                alert('Failed to process eSewa payment.');
                            });
                    } else if (data.redirect_url) { // Handles COD and other potential redirects
                        window.location.href = data.redirect_url;
                    } else {
                        alert('Failed to process order.');
                    }
                })
                .catch(error => {
                    console.error('Error placing order:', error);
                    alert('An error occurred while placing your order.');
                });
            } else {
                alert('Please select a payment method.');
            }
        });

        // Ensure only one payment method is checked at a time
        const paymentCheckboxes = document.querySelectorAll('input[name="payment_method"]');
        paymentCheckboxes.forEach(checkbox => {
            checkbox.addEventListener('change', function () {
                paymentCheckboxes.forEach(otherCheckbox => {
                    if (otherCheckbox !== this) {
                        otherCheckbox.checked = false;
                    }
                });
            });
        });
    });
    </script>

</html>
