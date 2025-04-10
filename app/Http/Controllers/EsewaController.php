<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
class EsewaController extends Controller
{
    // public function initiatePaymentFromCart(Request $request)
    // {
    //     $totalAmount = Session::get('cart_total'); // Assuming you store the total in the session
    //     $productDetails = 'Order from Hanag\'s Garments'; // You can create a more detailed description
    //     $orderId = 'HANAGS-' . time(); // Generate a unique order ID
    //     $successUrl = route('esewa.success');
    //     $failureUrl = route('esewa.failure');

    //     $environment = Config::get('app.esewa_environment', 'test');
    //     $paymentUrl = ($environment === 'live')
    //         ? 'https://epay.esewa.com.np/epay/main'
    //         : 'https://rc-epay.esewa.com.np/epay/main';

    //     $params = [
    //         'amt' => $totalAmount,
    //         'pdc' => 0,
    //         'psc' => 0,
    //         'txAmt' => 0,
    //         'tAmt' => $totalAmount,
    //         'pid' => $orderId, // Use a unique order ID
    //         'scd' => Config::get('app.esewa_client_id'),
    //         'su' => $successUrl,
    //         'fu' => $failureUrl,
    //     ];

    //     $queryString = http_build_query($params);
    //     return redirect()->away($paymentUrl . '?' . $queryString);
    // }

    // public function paymentSuccess(Request $request)
    // {
    //     $refId = $request->input('refId');
    //     $orderId = $request->input('oid');
    //     $amount = $request->input('amt');

    //     return $this->verifyPayment($refId, $orderId, $amount, $request);
    // }

    public function paymentFailure(Request $request)
    {
        // Handle failed eSewa payment
        dd('eSewa Test Payment Failed!', $request->all());
        // In a real scenario, you would:
        // 1. Log the failure
        // 2. Inform the user
        // 3. Allow them to retry or choose another payment method
    }

    // private function verifyPayment($refId, $productId, $amount, Request $request)
    // {
    //     $verificationUrl = ($this->getEsewaEnvironment() === 'live')
    //         ? 'https://epay.esewa.com.np/api/epay/transaction/v2/status'
    //         : 'https://rc-epay.esewa.com.np/api/epay/transaction/v2/status';

    //     $params = [
    //         'amt' => $amount,
    //         'pid' => $productId,
    //         'refId' => $refId,
    //     ];

    //     $client = new Client();
    //     try {
    //         $response = $client->request('POST', $verificationUrl, [
    //             'form_params' => $params,
    //             'headers' => [
    //                 'Authorization' => 'Basic ' . base64_encode(Config::get('app.esewa_client_id') . ':' . Config::get('app.esewa_secret_key')),
    //             ],
    //         ]);

    //         $responseData = json_decode($response->getBody(), true);

    //         if ($responseData && isset($responseData['detail']) && $responseData['detail']['status'] === 'success') {
    //             // Payment is verified and successful
    //             dd('eSewa Test Payment Successful and Verified!', $request->all(), $responseData);
    //             // In a real scenario:
    //             // 1. Update your order status to "Paid"
    //             // 2. Clear the user's cart
    //             // 3. Redirect them to an order confirmation page
    //         } else {
    //             // Verification failed
    //             dd('eSewa Test Payment Successful but Verification Failed!', $request->all(), $responseData);
    //             // In a real scenario:
    //             // 1. Log the verification failure
    //             // 2. Potentially update order status to "Payment Failed" or "Pending Verification"
    //             // 3. Inform the user about the issue
    //         }

    //     } catch (\Exception $e) {
    //         dd('Error verifying eSewa payment: ' . $e->getMessage());
    //         // In a real scenario:
    //         // 1. Log the error
    //         // 2. Inform the user that payment verification failed
    //         // 3. Potentially provide a way to manually check the status
    //     }
    // }

    // private function getEsewaEnvironment()
    // {
    //     return Config::get('app.esewa_environment', 'test');
    // }
}
