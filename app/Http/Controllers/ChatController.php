<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Chat;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Notifications\NewMessageNotification;

class ChatController extends Controller
{
    public function index()
    {
        checkAuth();
        $userId = Auth::user()->id;

        $chats = Chat::where('user1_id', $userId)
            ->orWhere('user2_id', $userId)
            ->with(['lastMessage'])
            ->get();

        return view('chat.index', compact('chats', 'userId'));
    }

    public function show($chat_id)
    {
        checkAuth();
        $userId = Auth::user()->id;

        $chats = Chat::where('user1_id', $userId)
            ->orWhere('user2_id', $userId)
            ->with(['lastMessage'])
            ->get();

        $messages = Message::where(["chat_id" => $chat_id])->orderBy('created_at', 'asc')->get();

        $userId = Auth::user()->id;
        $chat = Chat::find($chat_id);

        $to_id = $chat->user1_id == $userId ? $chat->user2_id : $chat->user1_id;

        return view('chat.index', compact('messages', 'chats', 'userId', 'chat_id', 'to_id'));
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

    public static function createMessage($chat_id, $text, $to_id)
    {
        $message = Message::create([
            'chat_id' => $chat_id,
            'from_id' => Auth::user()->id,
            'to_id' => $to_id,
            "text" => $text
        ]);

        $recipient = User::find($to_id); // получатель

        $recipient->notify(new NewMessageNotification($message));
    }

    public function sendMessage(Request $request)
    {
        checkAuth();

        $request->validate([
            'chat_id' => 'required|exists:chats,id',
            'to_id' => 'required',
            'text' => 'required|string',
        ]);

        $this->createMessage($request->chat_id, $request->text, $request->to_id);

        return redirect()->back();
    }
}