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
      // Show the form to add a new user
      public function createUser()
      {
          return view('admin.addUser');
      }

      // Store the new user in the database
    public function storeUser(Request $request)
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone_number' => 'required|digits:10',
            'password' => 'required|min:8|confirmed',
        ]);

        User::create([
            'full_name' => $request->full_name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'password' => bcrypt($request->password),
        ]);

        return redirect()->route('admin.users')->with('popup_message', 'User added successfully');
    }

      // Show the form to edit a user
      public function editUser($id)
      {
          $user = User::findOrFail($id);
          return view('admin.editUser', compact('user'));
      }

      // Update the user details
      public function updateUser(Request $request, $id)
      {
          $validated = $request->validate([
              'full_name' => 'required|string|max:255',
              'email' => 'required|email|unique:users,email,' . $id,
              'phone_number' => 'required|digits:10',
          ]);

          $user = User::findOrFail($id);
          $user->update([
              'full_name' => $request->full_name,
              'email' => $request->email,
              'phone_number' => $request->phone_number,
          ]);

          return redirect()->route('admin.users')->with('popup_message', 'User updated successfully');
      }

      // Delete a user
      public function deleteUser($id)
      {
          $user = User::findOrFail($id);
          $user->delete();

          return redirect()->route('admin.users')->with('popup_message', 'User deleted successfully');
      }
}

