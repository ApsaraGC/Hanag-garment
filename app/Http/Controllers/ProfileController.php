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

    public function updateAddress(Request $request)
    {
        $user = Auth::user();
        $user->address = $request->input('address');
        $user->save();

        return redirect()->back()->with('success', 'Address updated successfully!');
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
        // Ensure that the user is authenticated
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login')->with('error', 'Please log in first.');
        }

        // Validate input data, including profile image
        $validatedData = $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone_number' => 'nullable|string|max:20',
            // 'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Added validation for profile picture
        ]);

        // // Handle the profile picture upload if it exists
        // if ($request->hasFile('profile_picture')) {
        //     $imagePath = $request->file('profile_picture')->store('profile_images', 'public');
        //     $validatedData['profile_picture'] = $imagePath; // Save image path to DB
        // }

        // Update user profile with the validated data
        $user->update($validatedData);

        // Redirect back with success message
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
