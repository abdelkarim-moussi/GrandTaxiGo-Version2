<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewReservation
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $reservation;
    /**
     * Create a new event instance.
     */
    public function __construct($reservation)
    {
        $this->reservation = $reservation;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('reservations'),
        ];
    }

    public function broadcastAs()
    {
        return 'create';
    }

    public function broadcastWith(): array
    {
        return [
            'message' => "[{$this->reservation->created_at}] Nouveau course !",
            
            'reservation' => json_encode($this->reservation)
        ];
       
    }
}
