<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ModelRated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    

    private $qualifier;
    private $rateable;
    private $score;

    public function __construct(Model $qualifier, Model $rateable, float $score) //objetos que intervienen en el modelo
    {
        $this->qualifier    = $qualifier;
        $this->rateable     = $rateable;
        $this->score        = $score;
    }

//implementamos getters para obtenerlos cada vez que se ejecute el evento

    public function getQualifier():Model{
        return $this->qualifier;
    }

    public function getRateable():Model{
        return $this->rateable;
    }

    public function getScore():float{
        return $this->score;
    }

    public function broadcastOn() // para cuando tenemos mensaje de broadcasting
    {
        return new PrivateChannel('channel-name');
    }
}
