<?php

namespace App\Mail;

use App\Traits\MailTrait;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SetPasswordMail extends Mailable
{
    use SerializesModels, MailTrait;

    public $name, $username, $password, $link;

    public function __construct($name, $username, $password, $link)
    {
        $this->name = $name;
        $this->username = $username;
        $this->password = $password;
        $this->link = $link;
    }

    public function build()
    {
        $data = $this->emailTemplate([
            '%name%' => printFirstNameOnly($this->name),
            '%username%' => $this->username,
            '%password%' => $this->password,
            '%link%' => $this->link,
            '%company_name%' => getConfig('company-name')
        ], 'WelcomeNewEmployee');

        $this->subject($data['subject']);
        $this->from($data['from']);

        return $this->view('mail.passwordSetup', ['content' => $data['content']]);
    }
}
