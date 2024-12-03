<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\Viaje;

class EstadoViajeActualizado
{
    use Dispatchable, SerializesModels;

    public $viaje;

    public function __construct(Viaje $viaje)
    {
        $this->viaje = $viaje;
    }
}
