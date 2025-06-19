<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Contracts\Queue\ShouldQueue;

class NewMessageNotification extends Notification
{

    protected $message;

    public function __construct($message)
    {
        $this->message = $message;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $from = User::find($this->message->from_id);
        $text = $this->message->text;
        $url = route('chat_show', $this->message->chat_id);
        return (new MailMessage)
            ->subject('Новое сообщение')
            ->view('notifications.messages.index', compact('from', 'text', 'url'));
    }
}