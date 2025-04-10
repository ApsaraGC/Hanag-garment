<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function index()
    {
        // admin_id is hardcoded as 1 for now
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

    // public function fetchMessages()
    // {
    //     $adminId = 2;
    //     $userId = auth()->id();

    //     $messages = Message::where(function ($query) use ($adminId, $userId) {
    //         $query->where('sender_id', $userId)->where('receiver_id', $adminId);
    //     })->orWhere(function ($query) use ($adminId, $userId) {
    //         $query->where('sender_id', $adminId)->where('receiver_id', $userId);
    //     })->orderBy('created_at', 'asc')->get();

    //     return response()->json($messages);
    // }



    public function fetchMessages()
{
    $adminId = 2;
    $userId = auth()->id();

    // Fetch messages between the logged-in user and the admin
    $messages = Message::where(function ($query) use ($adminId, $userId) {
        $query->where('sender_id', $userId)->where('receiver_id', $adminId)
              ->orWhere('sender_id', $adminId)->where('receiver_id', $userId);
    })
    ->orderBy('created_at', 'asc')
    ->get();

    return response()->json($messages);
}

    public function adminChat($userId)
{
    $user = User::findOrFail($userId);

    return view('chat.admin', [
        'userId' => $userId,
        'userName' => $user->full_name
    ]);
//     return view('chat.admin', ['userId' => $userId]);
// }
}
// public function delete($id)
// {
//     $message = Message::findOrFail($id);

//     if (auth()->id() == 2) { // Only admin can delete
//         $message->delete();
//         return response()->json(['success' => true]);
//     }

//     return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
// }


}
