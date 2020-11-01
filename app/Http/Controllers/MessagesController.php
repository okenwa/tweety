<?php

namespace App\Http\Controllers;

use App\Chat;
use App\Events\MessageSent;
use App\Message;
use Illuminate\Http\Request;

class MessagesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function get(Chat $chat)
    {
        return Message::where('chat_id', $chat->id)
            ->with('user')
            ->latest()
            ->paginate(20);
    }

    public function store(Chat $chat, Request $request)
    {
        $message = auth()->user()->messages()->create([
            'message' => $request->message,
            'chat_id' => $chat->id,
        ]);
        
        $chat->messages()->attach($message);

        $chat->touch();

        broadcast(new MessageSent(auth()->user(), $message, $chat))->toOthers();

        return ['status' => 'Message Sent!'];
    }
}
