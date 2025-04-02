<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\PasswordReset;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Password;
use Illuminate\View\View;

class PasswordResetLinkController extends Controller
{
    // Show the form to reset the password (based on username)
    public function create()
{
    return view('auth.forgot-password');  // The correct view path
}


    // Handle the form submission (reset the password directly)
    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string|min:8|confirmed', // Ensure password confirmation
        ]);

        // Find the user by their username
        $user = User::where('email', $request->username)->orWhere('full_name', $request->username)->first();

        if (!$user) {
            return back()->withErrors(['username' => 'User not found.']);
        }

        // Update the user's password
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('login')->with('status', 'Your password has been reset!');
    }
}
