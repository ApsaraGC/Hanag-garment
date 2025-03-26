<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // Validate the registration form input.
        $request->validate([
            'full_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'phone_number'=>['required','string','max:15'],
            // Password is required, must be confirmed (match the "password_confirmation" field), and adhere to default password rules.
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'address'=>['required','string']
        ]);
   // Create a new user with the validated data.
        $user = User::create([
            'full_name' => $request->full_name,
            'email' => $request->email,
            'phone_number'=>$request->phone_number,
            'password' => Hash::make($request->password),
            'address'=>$request->address,
        ]);

        event(new Registered($user));

        // Automatically log in the newly registered user.
        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}
