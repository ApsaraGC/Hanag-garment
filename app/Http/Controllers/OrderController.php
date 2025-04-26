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
        // Fetch all orders along with related data (like user and products in the order)
        $orders = Order::with('user', 'products','payment',)
            ->orderBy('created_at', 'desc') // Sort by created_at in descending order
            ->paginate(10);
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
        // Find the order by ID or fail if not found
        $order = Order::findOrFail($id);

        // Validate the incoming request for the status (optional, but recommended)
        $request->validate([
            'status' => 'required|in:pending,completed,cancelled', // Ensure only valid status
        ]);

        // Update only the status field or any other fields you want to update
        $order->update([
            'status' => $request->status, // Update the status field
            // Add other fields here if needed
        ]);

        // Redirect with a success message
        return redirect()->route('admin.order')->with('popup_message', 'Order updated successfully');
    }

    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();
        return redirect()->route('admin.order')->with('popup_message', 'Order deleted successfully');
    }

    public function viewOrder($orderId)
{
    // Fetch the order along with the related data (user, products, payment)
    $order = Order::with(['user', 'products', 'payment',])
                  ->findOrFail($orderId); // Fetch the order by ID

    // Fetch the user's cart with selected size for the products in the order

    // Pass the order and the sizes to the view
    return view('admin.view-order', compact('order'));
}

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
