<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use Illuminate\Support\Facades\Session;

class ContactController extends Controller
{
    public function index() {
        $messages = Contact::latest()->get();
        return view('admin.messages', compact('messages'));
    }

    // Show the contact form
    public function create()
    {
        return view('user.contact');  // Make sure the view is named 'contact.blade.php'
    }

    // Store the contact message
    public function store(Request $request)
    {
        // Validate the incoming request
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'nullable|digits_between:10,15',
            'message' => 'required|string',
        ]);

        // Create a new contact message in the database
        Contact::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'message' => $validated['message'],
        ]);

        // Flash success message to session
        Session::flash('popup_message', 'Your message has been sent successfully!');

        // Redirect back to the contact form
        return redirect()->route('contact.form');
    }
}
