<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Chat;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function index()
    {
        $messages = Message::where(["from_id" => Auth::user()->id])->get()->toArray();

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

    public static function getOrCreateChat($userId1, $userId2)
    {
        // Сортируем ID, чтобы гарантировать уникальность
        if ($userId1 > $userId2) {
            [$userId1, $userId2] = [$userId2, $userId1];
        }

        $chat = Chat::where('user1_id', $userId1)
            ->where('user2_id', $userId2)
            ->first();

        if (!$chat) {
            $chat = Chat::create([
                'user1_id' => $userId1,
                'user2_id' => $userId2,
            ]);
        }

        return $chat;
    }

    public static function createMessage($text, $to_id)
    {
        Message::create([
            'from_id' => Auth::user()->id,
            'to_id' => $to_id,
            "text" => $text
        ]);
    }

    public function show($from_id)
    {

    }
}