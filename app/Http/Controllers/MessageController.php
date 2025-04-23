<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Message;
use App\Models\Review;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    // Store user messages
    public function store(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:15',
            'message' => 'required|string',
        ]);
        Review::create($request->all());
        return redirect()->back()->with('popup_message', 'Message sent successfully!');
    }

    // Show messages to the admin
    public function index() {
        $messages = Message::latest()->get();
        return view('admin.messages', compact('messages'));
    }

    public function Contactstore(Request $request)
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
        // Session::flash('popup_message', 'Your message has been sent successfully!');

        // Redirect back to the contact form
        return redirect()->route('contact.form');
    }

}
