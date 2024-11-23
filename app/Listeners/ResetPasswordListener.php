<?php

namespace App\Listeners;

use App\Events\ResetPasswordEvent;
use App\Mail\ResetPasswordMail;
use Illuminate\Support\Facades\Mail;

class ResetPasswordListener
{
    public function handle(ResetPasswordEvent $event)
    {
        $email = $event->email;
        $name = $event->name;
        $link = env('APP_URL') . '/system/reset-password/' . $event->token;

        try {
            Mail::to($email)->send(new ResetPasswordMail($name, $link));
        } catch (\Exception $e) {
            dd($e);
            return false;
        }
    }
}
