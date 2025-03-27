<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewChatNotification extends Notification
{
    use Queueable;

    protected $chat;
    protected $otherUser;

    public function __construct($chat, $otherUser)
    {
        $this->chat = $chat;
        $this->otherUser = $otherUser;
    }

    public function via($notifiable)
    {
        return ['database'];
    }


    public function toDatabase($notifiable)
    {

        $url = route('chats.show', $this->chat->id);

        return [
            'user_id'=> $this->otherUser['id'],
            'name'=> $this->otherUser['name'],
            'email'=> $this->otherUser['email'],
            'chat_id' => $this->chat->id,
            'message' => 'A new chat has been initiated with : ' . $this->otherUser->name,
            'url' => $url,
        ];
    }
}
