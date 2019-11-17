<?php

namespace App\Http\Controllers;

use App\Message;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $messages = Message::orderBy('id', 'DESC')
            ->whereAnswerMessageId(0)
            ->paginate(25);

        return view('index', [
            'messages' => $messages
        ]);
    }
}
