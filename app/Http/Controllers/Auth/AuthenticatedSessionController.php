<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // Validate the input
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Attempt authentication
        if (Auth::attempt($request->only('email', 'password'), $request->boolean('remember'))) {
            // Regenerate session to prevent session fixation attacks
            $request->session()->regenerate();

            // Check if authentication succeeded
            // dd(Auth::user()); // Inspect the authenticated user
            // Redirect based on user role
            if ($request->user()->role === 'ADM') {
                return redirect()->route('admin.dashboard'); // Redirect to admin dashboard (adjust the route if needed)
            }
            // Default redirection to the dashboard for other users
            return redirect()->intended(route('dashboard', absolute: false));
        } else {
            // If authentication fails, return back with an error message
            return back()->withErrors([
                'email' => 'The provided email address or password is incorrect.',
            ])->onlyInput('email');
        }
    }
    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        // Log out the user from the 'web' guard (default).
        Auth::guard('web')->logout();

        // Invalidate the session
        $request->session()->invalidate();

        // Regenerate the session token to prevent CSRF attacks
        $request->session()->regenerateToken();

        // Redirect the user to the welcome page or login page after logout
        return redirect('/login');
    }
}
