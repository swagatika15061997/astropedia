<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class AstrologerStatusEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public $astrologerId;
    public $status;

    public function __construct($astrologerId, $status)
    {
        $this->astrologerId = $astrologerId;
        $this->status = $status;
    }

    public function broadcastOn()
    {
        return new PresenceChannel('status-update');
    }

    public function broadcastWith()
    {
        return ['id' => $this->astrologerId, 'status' => $this->status, 'type' => 'astrologer'];
    }
}
