<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;  // This imports the Auth facade
use Barryvdh\DomPDF\Facade as PDF;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Models\UserCart;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function viewOrders(Request $request)
    {
        // Fetch all orders along with related data (like user and products in the order)
        $orders = Order::with('user', 'products')->paginate(10);
        // Pass orders to the view
        return view('admin.order', compact('orders'));
    }
    // public function create()
    // {
    //     $users = User::all(); // Fetch users for the select dropdown
    //     return view('admin.order', compact('users'));
    // }

    public function stores(Request $request)
    {
        $order = Order::create($request->all());
        return redirect()->route('admin.createOrder')->with('success', 'Order created successfully');
    }

    public function edit($id)
    {
        $order = Order::findOrFail($id);
        $users = User::all();
        return view('admin.update-order', compact('order', 'users'));
    }

    public function update(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->update($request->all());
        return redirect()->route('admin.order')->with('success', 'Order updated successfully');
    }

    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();
        return redirect()->route('admin.destroyOrder', ['order' => $id])->with('success', 'Order deleted successfully');
    }

    public function store(Request $request)
    {
        $user = auth::user(); // Get logged-in user

        // Retrieve cart items
        $cartItems = UserCart::where('user_id', $user->id)->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('user.cart')->with('error', 'Your cart is empty!');
        }
        // Calculate subtotal
        $subtotal = 0;
        foreach ($cartItems as $item) {
            $subtotal += $item->product->sale_price * $item->quantity;
        }

        $deliveryCharge = 150.00; // Fixed delivery charge
        $discount = 0; // You can add discount logic here
        $totalAmount = ($subtotal + $deliveryCharge) - $discount;

        // Store order details in the database
        $order = Order::create([
            'user_id' => $user->id,
            'sub_total' => $totalAmount,
            'discount' => $discount,
            'total_amount' => $totalAmount,
            'order_type' => 'online',
            'status' => 'pending',
            'description' => 'Order placed successfully.',
        ]);

        // Clear user cart after placing order
         UserCart::where('user_id', $user->id)->delete();

        // Pass the order ID to the redirect route
        return redirect()->route('dashboard')->with('success', 'Order placed successfully!');

        // return redirect()->route('user.invoice', ['orderId' => $order->id])->with('success', 'Order placed successfully!');
    }
    // public function checkout($orderId)
    // {
    //     // Fetch order details for the given orderId
    //     $order = Order::findOrFail($orderId);
    //     $user = auth()->user();
    //     return redirect()->route('user.orderBill', ['orderId' => $order->id])->with('success', 'Order placed successfully!');

    //     // Pass order and user details to view
    //     // view('user.orderBill', compact('user', 'order'));
    // }


    public function downloadOrderBill($id)
{
    // Fetch the order and user details
    $order = Order::findOrFail($id);
    $user = auth()->user();

    // Generate PDF from view
    $pdf = PDF::loadView('user.BillPdf', compact('user', 'order'));

    // Download the PDF
    return $pdf->download('order_bill_' . $id . '.pdf');
}





}
