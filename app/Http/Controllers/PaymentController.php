<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function khalti(Request $request): Redirector | RedirectResponse
    {
        // Validate the incoming request data
        $request->validate([
            'total_amount' => 'required|numeric', // Assuming you need to pass total_amount for Khalti payment
            'order_id' => 'required|string',
        ]);

        // Store the order details in session
        $orderDetails = [
            'order_id' => $request->input('order_id'),
            'total_amount' => $request->input('total_amount'),
        ];
        $request->session()->put('order_details', $orderDetails);

        // Set up the return URL (Khalti payment verification URL)
        $returnUrl = route('khalti.verify'); // Your verify route

        // Prepare the data to initiate Khalti payment
        $response = Http::withHeaders([
            'Authorization' => 'Key ' . env('KHALTI_LIVE_SECRET_KEY'), // Use the secret key from .env
        ])->post('https://a.khalti.com/api/v2/epayment/initiate/', [
            'amount' => $request->input('total_amount'),
            'purchase_order_id' => $request->input('order_id'),
            'return_url' => $returnUrl,
            'website_url' => config('app.url'),
        ]);

        // Check if the response is successful
        if ($response->successful()) {
            $data = $response->json();
            return redirect()->to($data['payment_url']); // Redirect to Khalti payment gateway
        } else {
            // Log the error for debugging
            return back()->with('error', 'Khalti payment initiation failed. Please try again.');
        }
    }


    // Method to verify the payment after the user is redirected back
    public function verify(Request $request): RedirectResponse
    {
        // Log the incoming request data for debugging purposes

        $paymentToken = $request->input('token');  // Token received from Khalti
        $paymentID = $request->input('payment_id');  // Payment ID received from Khalti

        // Retrieve the order details from the session
        $orderDetails = $request->session()->get('order_details');
        if (!$orderDetails) {
            return redirect()->route('user.cart')->with('error', 'Order details not found in session.');
        }

        // Set up the verification URL and headers
        $secretKey = env('KHALTI_LIVE_SECRET_KEY');
        $response = Http::withHeaders([
            'Authorization' => 'Key ' . $secretKey,
        ])->post('https://a.khalti.com/api/v2/payment/verify/', [
            'token' => $paymentToken,
            'payment_id' => $paymentID,
        ]);

        // Check if the verification is successful
        if ($response->successful()) {
            $data = $response->json();

            // Check payment status
            if ($data['status'] == 'success') {
                // Handle successful payment (e.g., save payment details, update order status)
                // Example: Update order status to "paid"
                $order = Order::where('order_id', $orderDetails['order_id'])->first();
                if ($order) {
                    $order->status = 'paid';
                    $order->save();

                    // Optional: Create a payment record
                    Payment::create([
                        'order_id' => $order->id,
                        'amount' => $orderDetails['total_amount'],
                        'payment_method' => 'khalti',
                        'payment_status' => 'success',
                        'payment_date' => now(),
                    ]);
                }

                return redirect()->route('user.invoice');  // Redirect to success page
            } else {
                // Log the failure for debugging
                return redirect()->route('user.invoice')->with('error', 'Payment failed. Please try again.');
            }
        } else {
            // Log the error for debugging
            return redirect()->route('user.invoice')->with('error', 'Payment verification failed. Please try again.');
        }
    }
}




