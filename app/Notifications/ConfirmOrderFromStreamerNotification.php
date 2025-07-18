<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Contracts\Queue\ShouldQueue;

class ConfirmOrderFromStreamerNotification extends Notification
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
        $text = $this->message['text'];
        $url = route('orderList');
        return (new MailMessage)
            ->subject('Стример подтвердил заказ!')
            ->view('notifications.messages.confirmOrder', compact('text', 'url'));
    }
}
