<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ResetPasswordEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $email, $name, $token;
    public function __construct($user, $token)
    {
        $this->email = $user->email;
        $this->name = $user->name;
        $this->token = $token;
    }

    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
