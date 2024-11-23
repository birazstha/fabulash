<?php

namespace App\Listeners;

use App\Events\SetPasswordEvent;
use App\Mail\SetPasswordMail;
use Illuminate\Support\Facades\Mail;

class SetPasswordListener
{
    public function handle(SetPasswordEvent $event)
    {
        $email = $event->email;
        $name = $event->name;
        $username = $event->username;
        $password = $event->password;
        $link = env('APP_URL') . '/system/login';




        try {
            Mail::to($email)->send(new SetPasswordMail($name, $username, $password, $link));
        } catch (\Exception $e) {
            dd($e);
            return false;
        }
    }
}
