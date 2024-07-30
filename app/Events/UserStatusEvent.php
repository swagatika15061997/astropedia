<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UserStatusEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    

     public $id;
     public $type;
 
     public function __construct($id, $type)
     {
         $this->id = $id;
         $this->type = $type;
     }

    public function broadcastOn(): array
    {
        return [
            new PresenceChannel('status-update'),
        ];
    }
    public function broadcastWith()
    {
        return [
            'id' => $this->id,
            'type' => $this->type,
        ];
    }

}
