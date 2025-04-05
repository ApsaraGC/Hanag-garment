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
    return redirect()->route('admin.order')->with('popup_message', 'Order deleted successfully');
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
