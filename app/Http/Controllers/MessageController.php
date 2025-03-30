<?php

namespace App\Http\Controllers;

use App\Models\Message;
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

        Message::create($request->all());

        return redirect()->back()->with('popup_message', 'Message sent successfully!');
    }

    // Show messages to the admin
    public function index() {
        $messages = Message::latest()->get();
        return view('admin.messages', compact('messages'));
    }

}
