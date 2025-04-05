<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SettingController extends Controller
{
    public function settings()
    {
        // Get the currently authenticated user
        $user = Auth::user();

        // Get the count of orders related to the authenticated user
        $orderCount = Order::where('user_id', $user->id)->count();

        // Get all orders for the user (for order details if needed)
        $order = Order::where('user_id', $user->id)->get();

        // Pass both the user, order count, and orders to the view
        return view('user.settings', compact('user', 'orderCount', 'order'));
    }
    public function destroy(Request $request)
    {
        $user = Auth::user();

        // Logout the user before deleting (optional but recommended)
        Auth::logout();

        // Delete the user's data (you might want to handle related data carefully)
        $user->delete();

        // Redirect the user to the homepage or a goodbye page with a success message
        return redirect('/')->with('success', 'Your account has been successfully deleted.');
    }

}
