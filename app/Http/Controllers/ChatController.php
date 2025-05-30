<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function index()
    {
        $messages = Message::all()->toArray();

        $chats = [];

        foreach ($messages as $message) {
            if (in_array($message["from_id"], $chats) == false) {

                $user = User::find($message["from_id"]);

                $chats[] = [
                    "from_id" => $user->id,
                    "name" => $user->name,
                    "avatar" => $user->avatar,
                ];
            }
        }

        return view('chat.index', compact("chats"));
    }
}