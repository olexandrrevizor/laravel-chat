<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redis;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function index()
    {
        $chatMessages = json_decode(Redis::get('chat.messages'), true);

        return view('home', [
            'messages' => $chatMessages
        ]);
    }

    public function sendMessage(Request $request)
    {
        $data = json_encode(['message' =>  $request->input('message')]);

        $messages = json_decode(Redis::get('chat.messages'), true);
        Redis::del('chat.messages');
        $messages[] = $request->input('message');
        Redis::set('chat.messages', json_encode($messages));

        Redis::publish('message', $data);

        return response()->json(['status' => 'success']);
    }
}
