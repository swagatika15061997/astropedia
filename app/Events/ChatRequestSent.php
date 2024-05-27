<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;
use App\Models\Astrologer;

class ChatRequestSent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $user;
    public $astrologer;
    /**
     * Create a new event instance.
     */
    public function __construct($user, $astrologer)
    {
        $this->user = $user;
        $this->astrologer = $astrologer;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new Channel('astrologer.' . $this->astrologer->id),
        ];
    }
    public function broadcastWith()
    {
        return [
            'user_name' => $this->user->name,
            'message' => 'You have a new chat request from ' . $this->user->name,
        ];
    }
    public function broadcastAs()
    {
        return 'user-notification';
    }
}

