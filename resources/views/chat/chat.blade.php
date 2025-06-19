@extends('layouts.main')

@section('title', 'Чат')

@section('content')

    <style>
        html,
        body {
            height: 100%;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
        }

        .chat-container {
            display: flex;
            flex-direction: column;
            height: 75vh;
            border-radius: 1rem;
            overflow: hidden;
        }

        .chat-body {
            flex-grow: 1;
            overflow-y: auto;
            padding: 1rem;
            background: #f0f2f5;
        }

        .chat-body::-webkit-scrollbar {
            width: 6px;
        }

        .chat-body::-webkit-scrollbar-track {
            background: transparent;
        }

        .chat-body::-webkit-scrollbar-thumb {
            background-color: #ccc;
            border-radius: 3px;
        }

        .message-bubble {
            display: flex;
            margin-bottom: 1rem;
            width: 100%;
        }

        .message-bubble.left {
            justify-content: flex-start;
        }

        .message-bubble.right {
            justify-content: flex-end;
        }

        .bubble-content {
            max-width: 70%;
            padding: 0.75rem 1rem;
            border-radius: 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            position: relative;
            word-break: break-word;
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
            color: #ccc;
            display: block;
            margin-top: 0.25rem;
            text-align: right;
        }

        .chat-input-form input[type="text"] {
            border-radius: 20px;
            padding-left: 1rem;
        }

        .chat-input-form button {
            border-radius: 20px;
            padding: 0 1.25rem;
        }
    </style>

    <div class="col-md-9">
        <div class="card chat-container shadow-sm">
            <div class="card-header bg-white py-3 fw-bold fs-5 border-0">Диалог</div>

            <div id="chat-messages" class="chat-body">
                @forelse ($messages as $message)
                    @php
                        $isMe = $message->from_id == Auth::user()->id;
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

            <form action="{{ route('chat.send') }}" method="POST" class="chat-input-form d-flex p-3 bg-white border-top">
                @csrf
                <input type="hidden" name="chat_id" value="{{ $chat_id }}">
                <input type="hidden" name="to_id" value="{{ $otherUserId }}">

                <input type="text" name="text" class="form-control me-2" placeholder="Введите сообщение..." required>
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-send"></i>
                </button>
            </form>
        </div>
    </div>

    <script>
        // Автопрокрутка вниз
        window.onload = function() {
            let container = document.getElementById('chat-messages');
            container.scrollTop = container.scrollHeight;
        };
    </script>
@endsection
