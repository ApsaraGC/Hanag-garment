<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SettingController extends Controller
{
    public function settings()
    {
        $user = Auth::user();
        $orderCount = Order::where('user_id', $user->id)->count();

        return view('user.settings', compact('user', 'orderCount'));
    }
}
