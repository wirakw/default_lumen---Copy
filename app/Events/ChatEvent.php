<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Broadcasting\PrivateChannel;

class ChatEvent implements ShouldBroadcast
{
    use InteractsWithSockets, SerializesModels;
    public $message;
    public $id;

    public function __construct(int $id, string $message)
    {
        $this->message = $message;
        $this->id = $id;
    }

    public function broadcastOn()
    {
        return new channel("chat.{$this->id}");
    }

    public function broadcastAs()
    {
        return 'ChatEvent';
    }
}