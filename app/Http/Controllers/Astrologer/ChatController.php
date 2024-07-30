<?php

namespace App\Http\Controllers\Astrologer;

use App\Http\Controllers\Controller;
use App\Models\ChatRequest;
use App\Models\Message;
use App\Events\MessageEvent;
use Illuminate\Http\Request;
use App\Events\ChatRequestUser;

class ChatController extends Controller
{
    public function chat()
    {
        return view('astrologer.chat');
    }
    public function loadchats(Request $request)
{
    try {
        $chats = Message::where(function($query) use ($request) {
            $query->where(function($query) use ($request) {
                $query->where('sender_id', $request->sender_id)
                      ->where('sender_type', $request->sender_type);
            })->orWhere(function($query) use ($request) {
                $query->where('sender_id', $request->receiver_id)
                      ->where('sender_type', $request->receiver_type);
            });
        })->where(function($query) use ($request) {
            $query->where(function($query) use ($request) {
                $query->where('receiver_id', $request->receiver_id)
                      ->where('receiver_type', $request->receiver_type);
            })->orWhere(function($query) use ($request) {
                $query->where('receiver_id', $request->sender_id)
                      ->where('receiver_type', $request->sender_type);
            });
        })->get();
        
        return response()->json(['success' => true, 'data' => $chats]);
    } catch (\Exception $e) {
        return response()->json(['success' => false, 'msg' => $e->getMessage()]);
    }
}

public function savechat(Request $request)
{
    try {
        $chat = Message::create([
            'sender_id' => $request->sender_id,
            'sender_type' => $request->sender_type,
            'receiver_id' => $request->receiver_id,
            'receiver_type' => $request->receiver_type,
            'message' => $request->message
        ]);
        event(new MessageEvent($chat));
        
        return response()->json(['success' => true, 'data' => $chat]);
    } catch (\Exception $e) {
        return response()->json(['success' => false, 'msg' => $e->getMessage()]);
    }
}
    public function chat_requests()
    {
        $chat_requests = ChatRequest::where('astrologer_id', auth('astrologer')->id())->get();
        return view('astrologer.chat.chat-request',compact('chat_requests'));
    }
    public function accept_chat_request($id)
    {
        $chat = ChatRequest::find($id);
        $chat->status = 'accepted';
        $chat->save();
        event(new ChatRequestUser($chat->astrologer->name, $chat->user_id)); 
        return redirect()->back()->with('success', 'Chat request accepted successfully');

    }
    public function reject_chat_request($id)
    {
        $chat = ChatRequest::find($id);
        $chat->status = 'rejected';
        $chat->save();
        event(new ChatRequestUser($chat->astrologer->name, $chat->user_id)); 
        return redirect()->back()->with('success', 'Chat request rejected successfully');

    }
}
