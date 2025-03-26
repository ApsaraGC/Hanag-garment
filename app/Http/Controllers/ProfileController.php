<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function profile()
    {
        if (!auth()->check()) {
            return redirect()->route('login'); // Redirect to login if not authenticated
        }

        $user = User::find(auth()->id());

        if (!$user) {
            // Handle the case where the user is not found (optional)
            return redirect()->route('login'); // Redirect to login if the user doesn't exist
        }

        return view('user.profile', compact('user'));
    }


    public function settings()
    {
        return view('user.settings'); // Create settings view
    }
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);

    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
{
    $user = Auth::user();

    if (!$user) {
        return redirect()->route('login')->with('error', 'Please log in first.');
    }

    // Validate input data
    $validatedData = $request->validate([
        'full_name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $user->id,
        'phone_number' => 'nullable|string|max:20',
    ]);

    // Update user details
    $user->update($validatedData);

    return redirect()->route('profile')->with('popup_message', 'Profile updated successfully.');
}


    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/dashboard');
    }
}
