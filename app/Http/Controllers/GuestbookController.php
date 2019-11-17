<?php

namespace App\Http\Controllers;

use App\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GuestbookController extends Controller
{
    public function index() {
        $messages = Message::orderBy('id', 'DESC')->paginate(25);

        return view('index', [
            'messages' => $messages
        ]);
    }

    public function send(Request $request) {
        $request->validate(Message::$createValidateRules);

        Message::add($request);

        return redirect()->route('home')->with('message', 'Message added');
    }

    public function answer($message_id, Request $request) {

        $message = Message::findOrFail($message_id);

        if ($request->post()) {
            Message::add($request, [
                'answer_message_id' => $message_id
            ]);

            return redirect()->route('home')->with('message', 'Message added');
        }

        return view('guestbook.answer', [
            'message' => $message
        ]);
    }
}
