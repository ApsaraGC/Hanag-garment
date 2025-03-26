<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserAdminController extends Controller
{
    //
    // Display the admin dashboard
    public function index()
    {
       // return view('admin.dashboard');
    }

    // Show all users in the admin panel
    public function showUsers()
    {
        $users = User::all(); // Fetch all users
        $totalUsers = User::count(); // Total users count
        return view('admin.users', compact('users', 'totalUsers'));
    }

    // Search users by name or email
    public function searchUsers(Request $request)
    {
        $query = $request->input('search');
        $users = User::where('name', 'LIKE', "%{$query}%")
                        ->orWhere('email', 'LIKE', "%{$query}%")
                        ->get();
        return view('admin.users', compact('users'));
    }
}
