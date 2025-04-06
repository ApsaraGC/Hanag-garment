<!DOCTYPE html>
<html>
<head>
    <title>Khalti Payment</title>
    <script src="https://khalti.com/static/khalti-checkout.js"></script>
</head>
<body>
    <h2>Pay with Khalti</h2>
    <p>Amount: Rs {{ $order->amount }}</p>
    <button id="payment-button">Pay with Khalti</button>

    <script>
        var config = {
            // replace this key with your test public key
            "publicKey": "test_public_key_dc74a6b2822f4e64b62a4e26cb5c3dfd",
            "productIdentity": "{{ $order->id }}",
            "productName": "Order Payment",
            "productUrl": "http://example.com/product",
            "paymentPreference": ["KHALTI"],
            "eventHandler": {
                onSuccess(payload) {
                    console.log(payload);

                    fetch("{{ route('khalti.verify') }}", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": "{{ csrf_token() }}"
                        },
                        body: JSON.stringify({
                            token: payload.token,
                            amount: {{ $order->amount * 100 }} // amount in paisa
                        })
                    })
                    .then(res => res.json())
                    .then(data => {
                        if (data.success) {
                            alert('Payment Successful!');
                            // redirect or update UI
                        } else {
                            alert('Payment Failed!');
                        }
                    });
                },
                onError(error) {
                    console.log(error);
                    alert('Something went wrong.');
                },
                onClose() {
                    console.log('Khalti widget is closing');
                }
            }
        };

        var checkout = new KhaltiCheckout(config);
        var btn = document.getElementById("payment-button");
        btn.onclick = function () {
            checkout.show({ amount: {{ $order->amount * 100 }} });
        };
    </script>
</body>
</html>
