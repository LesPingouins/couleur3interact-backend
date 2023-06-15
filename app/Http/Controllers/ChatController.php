<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function store(Request $request)
    {
        broadcast(new MessageSent($request->message, $request->username));

        return response('Message sent', 200)
            ->header('Content-Type', 'application/json');
    }
}
