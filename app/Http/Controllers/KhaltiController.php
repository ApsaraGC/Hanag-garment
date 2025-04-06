<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;
use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;

class KhaltiController extends Controller
{
    public function showPaymentForm($orderId)
    {
        $order = Order::findOrFail($orderId);

        return view('payment.khalti', compact('order'));
    }

    public function verifyPayment(Request $request)
    {
        $token = $request->input('token');
        $amount = $request->input('amount');

        $response = Http::withHeaders([
            'Authorization' => 'Key ' . env('KHALTI_LIVE_SECRET_KEY')
        ])->post('https://khalti.com/api/v2/payment/verify/', [
            'token' => $token,
            'amount' => $amount
        ]);

        // Check if the response is successful
        if ($response->successful()) {
            // Find the order (adjust based on your logic)
            $order = Order::where('total_amount', $amount)->first(); // Modify this query based on your order logic

            // Mark the order as paid
            $order->status = 'paid';
            $order->save();

            // Save the payment details
            Payment::create([
                'order_id' => $order->id,
                'amount' => $amount,
                'payment_method' => 'khalti',
                'payment_date' => now(),
            ]);

            // Return success response
            return response()->json(['success' => true, 'order_id' => $order->id]);
        } else {
            // Return error response if verification fails
            return response()->json(['success' => false, 'message' => 'Verification failed.'], 403);
        }
    }
}
