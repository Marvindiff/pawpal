<?php

namespace App\Http\Controllers; // ✅ IMPORTANT

use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\User;

class ChatController extends Controller
{
   public function index($userId)
{
    $receiver = User::findOrFail($userId);

    Message::where('receiver_id', auth()->id())
    ->where('sender_id', $receiver->id)
    ->update(['is_seen' => true]);
    
    // ✅ mark messages as read
    Message::where('sender_id', $userId)
        ->where('receiver_id', auth()->id())
        ->update(['is_read' => true]);

    $messages = Message::where(function ($q) use ($userId) {
        $q->where('sender_id', auth()->id())
          ->where('receiver_id', $userId);
    })->orWhere(function ($q) use ($userId) {
        $q->where('sender_id', $userId)
          ->where('receiver_id', auth()->id());
    })
    ->orderBy('created_at')
    ->get();

    return view('chat.index', compact('messages', 'receiver'));
}
public function inbox()
{
    $userId = auth()->id();

    $conversations = \App\Models\Message::where('sender_id', $userId)
        ->orWhere('receiver_id', $userId)
        ->orderBy('created_at', 'desc')
        ->get()
        ->groupBy(function ($msg) use ($userId) {
            return $msg->sender_id == $userId 
                ? $msg->receiver_id 
                : $msg->sender_id;
        });

    return view('chat.inbox', compact('conversations'));
}
public function typing(Request $request)
{
    cache()->put('typing_'.$request->receiver_id, true, 5);
    return response()->json(['ok' => true]);
}

    public function send(Request $request)
    {
        $request->validate([
            'receiver_id' => 'required',
            'message' => 'required'
        ]);

        Message::create([
            'sender_id' => auth()->id(),
            'receiver_id' => $request->receiver_id,
            'message' => $request->message
        ]);

        return back();
    }
}