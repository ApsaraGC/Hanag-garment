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
    if (!Auth::attempt($request->only('email', 'password'), $request->boolean('remember'))) {
        return back()->withErrors([
            'email' => 'The provided email address or password is incorrect.',
            
        ])->onlyInput('email');
    }
     // Regenerate session and redirect
        $request->authenticate();

        $request->session()->regenerate();
        //Check the authenticated user's role to determine redirection.
        if($request->user()->role ==='ADM'){
            // If the user's role is 'ADM' (Admin), redirect them to the admin dashboard.
            return redirect('admin/dashbord');
        }
        // Default redirection to the dashboard for other users.
        return redirect()->intended(route('dashboard', absolute: false));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        // Log out the user from the 'web' guard (default).
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        // Redirect the user to the welcome page after logout.
        return redirect('/dashboard');
    }
}
