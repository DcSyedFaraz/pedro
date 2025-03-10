<?php

namespace App\Events;

use App\Models\Message;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Log;

class MessageSent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;

    public function __construct(Message $message)
    {
        Log::info('MessageSent event dispatched', ['message_id' => $message->id]);

        $this->message = $message;
    }

    public function broadcastOn()
    {
        // Broadcast on a private channel for the chat
        return new PrivateChannel('chat.' . $this->message->chat_id);
        // return ['MessageSent' . $this->message->chat_id];
    }

    public function broadcastWith()
    {
        // Optionally customize the data sent with the event
        return [
            'id' => $this->message->id,
            'sender' => [
                'id' => $this->message->sender->id,
                'name' => $this->message->sender->name,
            ],
            'message' => $this->message->message,
            'created_at' => $this->message->created_at->toDateTimeString(),
        ];
    }

    // Optionally, you can define a broadcast name to simplify event listening on the frontend
    public function broadcastAs()
    {
        return 'MessageSent';
    }
}
