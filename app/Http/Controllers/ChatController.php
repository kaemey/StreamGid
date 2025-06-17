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
        checkAuth();
        $userId = auth()->id();

        $chats = Chat::where('user1_id', $userId)
            ->orWhere('user2_id', $userId)
            ->with(['lastMessage'])
            ->get();

        return view('chat.index', compact('chats', 'userId'));
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