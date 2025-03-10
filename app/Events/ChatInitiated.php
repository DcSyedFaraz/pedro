<?php

namespace App\Events;

use App\Models\Chat;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ChatInitiated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $chat;

    /**
     * Create a new event instance.
     *
     * @param \App\Models\Chat $chat
     * @return void
     */
    public function __construct(Chat $chat)
    {
        $this->chat = $chat->load('userOne');
        \Log::info("ChatInitiated event fired for chat ID: {$chat}");
    }


    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        // Broadcast to both participants' user channels
        return [
            new PrivateChannel('user.' . $this->chat->user_one_id),
            new PrivateChannel('user.' . $this->chat->user_two_id),
        ];
    }

    /**
     * The event's broadcast name.
     *
     * @return string
     */
    public function broadcastAs()
    {
        return 'ChatInitiated';
    }

    /**
     * The data to broadcast.
     *
     * @return array
     */
    public function broadcastWith()
    {
        return [
            'chat' => [
                'id' => $this->chat->id,
                'with_user' => [
                    'id' => $this->chat->userOne->id,
                    'name' => $this->chat->userOne->name,
                ],
                'unread_count' => 1,
            ],
        ];
    }
}
