@extends('layouts.main')

@section('title', 'Мои чаты')

@section('content')
    <style>
        .chat-list {
            background-color: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .chat-item {
            display: flex;
            align-items: center;
            padding: 16px;
            border-bottom: 1px solid #f0f0f0;
            transition: background-color 0.2s ease;
        }

        .chat-item:hover {
            background-color: #f9f9f9;
        }

        .chat-item:last-child {
            border-bottom: none;
        }

        .chat-avatar {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            object-fit: cover;
            margin-right: 16px;
            border: 2px solid #f8f9fa;
        }

        .chat-info {
            flex: 1;
        }

        .chat-name {
            font-size: 1.2rem;
            font-weight: 600;
            color: #333;
            margin-bottom: 4px;
        }

        .chat-preview {
            color: #666;
            font-size: 0.9rem;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .chat-time {
            color: #999;
            font-size: 0.8rem;
            margin-left: auto;
            min-width: 60px;
            text-align: right;
        }

        .no-chats {
            padding: 40px;
            text-align: center;
            color: #666;
        }

        @media (max-width: 768px) {
            .chat-avatar {
                width: 50px;
                height: 50px;
            }

            .chat-name {
                font-size: 1rem;
            }
        }
    </style>

    @php
        use App\Models\User;
    @endphp

    <div class="col-md-9">
        <div class="chat-list">
            @if (count($chats) > 0)
                @foreach ($chats as $chat)
                    @php
                        // Определяем собеседника
                        $otherUserId = $chat->user1_id == $userId ? $chat->user2_id : $chat->user1_id;
                        $otherUser = User::find($otherUserId);

                        // Последнее сообщение в чате
                        $lastMessage = $chat->lastMessage;
                    @endphp

                    <a href="{{ route('chat_show', ['id' => $chat['id']]) }}" class="text-decoration-none">
                        <div class="chat-item">
                            <img src="{{ $otherUser->avatar }}" alt="Аватар" class="chat-avatar">
                            <div class="chat-info">
                                {{-- Имя собеседника --}}
                                <div class="chat-name"> {{ $otherUser->name }}</div>
                                {{-- Имя отправившего последнее сообщение: последнее сообщение --}}
                                <div class="chat-preview">{{ User::find($lastMessage->from_id)->name }}:
                                    {{ $lastMessage->text }}</div>
                            </div>
                            <div class="chat-time">
                                {{ $lastMessage->created_at->format('Y-m-d H:i') }}
                            </div>
                        </div>
                    </a>
                @endforeach
            @else
                <div class="no-chats">
                    <i class="bi bi-chat-square-text" style="font-size: 3rem; color: #ddd;"></i>
                    <h4 class="mt-3">У вас пока нет чатов</h4>
                </div>
            @endif
        </div>
    </div>
@endsection
