<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        $googleUser = Socialite::driver('google')->user();

        // Check if user already exists in the database
        $user = User::where('google_id', $googleUser->getId())->first();

        if (!$user) {
            // If user does not exist, create a new user
            $user = User::create([
                'name' => $googleUser->getName(),
                'email' => $googleUser->getEmail(),
                'google_id' => $googleUser->getId(),
                'password' => bcrypt(str_random(16)), // A random password
            ]);
        }

        // Log the user in
        Auth::login($user, true);

        return redirect()->route('dashboard'); // Redirect to the dashboard or home page
    }

}
