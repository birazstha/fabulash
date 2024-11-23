<?php

namespace App\Mail;

use App\Traits\MailTrait;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ResetPasswordMail extends Mailable
{
    use Queueable, SerializesModels, MailTrait;

    public $name, $link;

    public function __construct($name, $link)
    {
        $this->name = $name;
        $this->link = $link;
    }
    public function build()
    {
        $data = $this->emailTemplate([
            '%name%' => printFirstNameOnly($this->name),
            '%link%' => $this->link,
            '%company_name%' => getConfig('company-name')
        ], 'ResetPassword');

        $this->subject($data['subject']);
        $this->from($data['from']);

        return $this->view('mail.resetPasswordSetup', ['content' => $data['content']]);
    }
}
