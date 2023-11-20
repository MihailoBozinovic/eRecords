<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class Poruka implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */

    public $ime;
    public $poruka;
    public $vreme;
    public $id_posiljaoca;
    public $id_primaoca;
    public $id_chat;

    public function __construct($ime, $poruka, $vreme, $id_posiljaoca, $id_primaoca, $id_chat)
    {
        $this->ime = $ime;
        $this->poruka = $poruka;
        $this->vreme = $vreme;
        $this->id_posiljaoca = $id_posiljaoca;
        $this->id_primaoca = $id_primaoca;
        $this->id_chat = $id_chat;
    }
    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('chat-' . $this->id_chat);
    }
    public function broadcastAs()
    {
        return 'message';
    }
}
