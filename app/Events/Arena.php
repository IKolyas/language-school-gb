<?php

namespace App\Events;

use App\Entities\ArenaRoom;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class Arena implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public ArenaRoom $arena;

    public function __construct(ArenaRoom $arena)
    {
        $this->arena = $arena;
    }


    public function broadcastOn(): Channel|array
    {
        return new Channel('arena.' . $this->arena->invite->id);
    }
}
