<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SetPasswordEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $email, $name, $password, $username;
    public function __construct($user, $password)
    {
        $this->email = $user->email;
        $this->name = $user->name;
        $this->username = $user->username;
        $this->password = $password;
    }

    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
