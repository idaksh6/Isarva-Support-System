<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ClientPasswordResetMail extends Mailable
{
    use Queueable, SerializesModels;

    public $url;
    public $email;

    public function __construct($url, $email)
    {
        $this->url = $url;
        $this->email = $email;
    }

    public function build()
    {
        return $this->subject('Password Reset Request')
                   ->markdown('emails.tickets.client_password_reset')
                    ->with([
                        'url' => $this->url,
                        'email' => $this->email
                    ]);
    }
}
