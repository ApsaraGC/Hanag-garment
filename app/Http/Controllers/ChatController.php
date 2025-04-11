<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function index()
    {
        // For a regular user, the receiver will always be the admin (ID 2)
        $adminId = 2;
        return view('chat.index', ['adminId' => $adminId]);
    }

    public function sendMessage(Request $request)
    {
        Message::create([
            'sender_id' => auth()->id(),
            'receiver_id' => $request->receiver_id,
            'message' => $request->message,
        ]);

        return response()->json(['status' => 'Message sent']);
    }

    // New fetch messages route for regular users
    public function fetchUserMessages($receiverId)
    {
        $userId = auth()->id();
        $messages = Message::where(function ($query) use ($userId, $receiverId) {
            $query->where('sender_id', $userId)->where('receiver_id', $receiverId);
        })->orWhere(function ($query) use ($userId, $receiverId) {
            $query->where('sender_id', $receiverId)->where('receiver_id', $userId);
        })->orderBy('created_at', 'asc')->get();

        return response()->json($messages);
    }

    public function adminChat($userId)
    {
        $user = User::findOrFail($userId);

        return view('chat.admin', [
            'userId' => $userId,
            'userName' => $user->full_name,
        ]);
    }

    public function fetchMessages($receiverId) // This is for the admin's view
    {
        $adminId = auth()->id();
        $messages = Message::where(function ($query) use ($adminId, $receiverId) {
            $query->where('sender_id', $adminId)->where('receiver_id', $receiverId);
        })->orWhere(function ($query) use ($adminId, $receiverId) {
            $query->where('sender_id', $receiverId)->where('receiver_id', $adminId);
        })->orderBy('created_at', 'asc')->get();

        return response()->json($messages);
    }

    public function deleteMessage($id, Request $request)
    {
        $message = Message::findOrFail($id);
        $loggedInUserId = auth()->id();
        $receiverId = $request->input('receiver_id');

        if ($loggedInUserId == 2 &&
            (($message->sender_id == $loggedInUserId && $message->receiver_id == $receiverId) ||
             ($message->sender_id == $receiverId && $message->receiver_id == $loggedInUserId))) {
            $message->delete();
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false, 'message' => 'Unauthorized to delete this message.'], 403);
    }
}
