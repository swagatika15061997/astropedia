<?php

namespace App\Http\Controllers\Astrologer;

use App\Http\Controllers\Controller;
use App\Models\ChatRequest;
use Illuminate\Http\Request;

class ChatController extends Controller
{
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
        return redirect()->back()->with('success', 'Chat request accepted successfully');

    }
    public function reject_chat_request($id)
    {
        $chat = ChatRequest::find($id);
        $chat->status = 'rejected';
        $chat->save();
        return redirect()->back()->with('success', 'Chat request rejected successfully');

    }
}
