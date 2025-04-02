<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class NewPasswordController extends Controller
{
    // Show the form to reset the password
    public function create($token)
    {
        return view('auth.reset-password', ['token' => $token]);  // Reset password form
    }

    // Handle password reset form submission
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8', // Ensure password and confirmation match
            'token' => 'required',
        ]);

        // Attempt to reset the password
        $response = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => bcrypt($password),
                ])->save();
            }
        );

        if ($response == Password::PASSWORD_RESET) {
            return redirect()->route('login')->with('status', 'Your password has been reset!');
        }

        return back()->withErrors(['email' => 'The provided token is invalid.']);
    }
}
