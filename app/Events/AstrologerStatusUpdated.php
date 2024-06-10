<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class AstrologerStatusUpdated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public $astrologer;

    public function __construct($astrologer)
    {
        $this->astrologer = $astrologer;
    }

    public function broadcastOn()
    {
        return new PresenceChannel('status-update-other');
    }

    public function broadcastWith()
    {
        return ['id' => $this->astrologer->id, 'type' => 'astrologer'];
    }

    public function broadcastAs()
    {
        return 'astrologerStatusUpdate';
    }
}
