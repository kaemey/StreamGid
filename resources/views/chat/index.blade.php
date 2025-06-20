@extends('layouts.main')

@section('title', 'Чат')

@section('content')
    <style>
        .chat-wrapper {
            display: flex;
            flex-direction: row;
            gap: 1rem;
            height: 75vh;
        }

        .chat-list-panel {
            flex: 0 0 30%;
            background-color: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            overflow-y: auto;
        }

        .chat-item {
            display: flex;
            align-items: center;
            padding: 12px 16px;
            border-bottom: 1px solid #f0f0f0;
            text-decoration: none;
            color: inherit;
            transition: background-color 0.2s ease;
        }

        .chat-item:hover {
            background-color: #f1f1f1;
        }

        .chat-item-active {
            background-color: #5cabff;
        }

        .chat-avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
            margin-right: 12px;
        }

        .chat-info {
            flex: 1;
        }

        .chat-name {
            font-weight: 600;
            font-size: 1rem;
        }

        .chat-preview {
            font-size: 0.85rem;
            color: #666;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .chat-time {
            font-size: 0.75rem;
            color: #999;
            margin-left: 8px;
            white-space: nowrap;
        }

        .chat-panel {
            flex: 1;
            display: flex;
            flex-direction: column;
            background: linear-gradient(135deg, #f0f4ff, #ffffff);
            border-radius: 16px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
            border: 1px solid #e0e7ff;
            overflow: hidden;
        }

        .chat-header {
            padding: 1rem;
            background: #0d6efd;
            color: white;
            font-size: 1.25rem;
            font-weight: 600;
            border-bottom: 1px solid #ccc;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
        }

        .chat-body {
            flex-grow: 1;
            overflow-y: auto;
            padding: 1.5rem;
            background: #f8faff;
            scrollbar-width: thin;
            scrollbar-color: #cbd5e1 transparent;
        }

        .chat-body::-webkit-scrollbar {
            width: 6px;
        }

        .chat-body::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 6px;
        }

        .message-bubble {
            display: flex;
            margin-bottom: 1rem;
            animation: fadeIn 0.3s ease;
        }

        .message-bubble.left {
            justify-content: flex-start;
        }

        .message-bubble.right {
            justify-content: flex-end;
        }

        .bubble-content {
            max-width: 70%;
            padding: 0.8rem 1.2rem;
            border-radius: 20px;
            word-break: break-word;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .message-bubble.left .bubble-content {
            background-color: #ffffff;
            color: #333;
            border-bottom-left-radius: 5px;
        }

        .message-bubble.right .bubble-content {
            background-color: #007bff;
            color: #fff;
            border-bottom-right-radius: 5px;
        }

        .bubble-content small {
            font-size: 0.75rem;
            display: block;
            margin-top: 0.4rem;
            text-align: right;
            color: rgba(255, 255, 255, 0.7);
        }

        .message-bubble.left .bubble-content small {
            color: #888;
        }

        .chat-input-form {
            display: flex;
            padding: 1rem;
            background: #fff;
            border-top: 1px solid #e6ecf0;
        }

        .chat-input-form input[type="text"] {
            border-radius: 20px;
            padding-left: 1rem;
            border: 1px solid #ccc;
            box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.05);
        }

        .chat-input-form button {
            border-radius: 20px;
            padding: 0 1.25rem;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @media (max-width: 768px) {
            .chat-wrapper {
                flex-direction: column;
            }

            .chat-list-panel {
                flex: none;
                max-height: 300px;
            }
        }
    </style>

    @php
        use App\Models\User;
    @endphp

    <div class="col-md-9">
        <div class="chat-wrapper">
            <!-- Левая панель -->
            <div class="chat-list-panel">
                @if (count($chats) > 0)
                    @foreach ($chats as $chat)
                        @php
                            $otherUserId = $chat->user1_id == $userId ? $chat->user2_id : $chat->user1_id;
                            $otherUser = User::find($otherUserId);
                            $lastMessage = $chat->lastMessage;
                        @endphp

                        <a href="{{ route('chat_show', ['id' => $chat->id]) }}"
                            class="chat-item {{ $chat->id == $chat_id ? 'chat-item-active' : '' }}">
                            <img src="{{ asset($otherUser->avatar) }}" alt="Аватар" class="chat-avatar">
                            <div class="chat-info">
                                <div class="chat-name">{{ $otherUser->name }}</div>
                                <div class="chat-preview">
                                    {{ User::find($lastMessage->from_id)->name }}:
                                    {{ Str::limit($lastMessage->text, 30) }}
                                </div>
                            </div>
                            <div class="chat-time">{{ $lastMessage->created_at->format('H:i') }}</div>
                        </a>
                    @endforeach
                @else
                    <div class="p-4 text-center text-muted">Нет чатов</div>
                @endif
            </div>

            <!-- Правая панель -->
            <div class="chat-panel">
                <div class="chat-header">Чат</div>
                @if (isset($messages))
                    <div class="chat-body" id="chat-messages">
                        @forelse ($messages as $message)
                            @php
                                $isMe = $message->from_id == Auth::id();
                                $alignClass = $isMe ? 'right' : 'left';
                            @endphp
                            <div class="message-bubble {{ $alignClass }}">
                                <div class="bubble-content">
                                    {{ $message->text }}
                                    <small>{{ \Carbon\Carbon::parse($message->created_at)->format('H:i') }}</small>
                                </div>
                            </div>
                        @empty
                            <div class="text-center text-muted">Нет сообщений</div>
                        @endforelse
                    </div>

                    <form action="{{ route('chat.send') }}" method="POST" class="chat-input-form">
                        @csrf
                        <input type="hidden" name="chat_id" value="{{ $chat_id }}">
                        <input type="hidden" name="to_id" value="{{ $to_id }}">
                        <input type="text" name="text" class="form-control me-2" placeholder="Введите сообщение..."
                            required>
                        <button type="submit" class="btn btn-primary"><i class="bi bi-send"></i></button>
                    </form>
                @else
                    <div class="p-5 text-center text-muted">Выберите чат слева</div>
                @endif
            </div>
        </div>
    </div>

    <script>
        window.onload = function() {
            const container = document.getElementById('chat-messages');
            if (container) container.scrollTop = container.scrollHeight;
        };
    </script>
@endsection
