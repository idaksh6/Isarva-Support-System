<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ClientCommentAdded extends Mailable
{
    use Queueable, SerializesModels;

    public $ticket;
    public $comment;
    public $fileName;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($ticket, $comment, $fileName = null)
    {
        //
        $this->ticket = $ticket;
        $this->comment = $comment;
        $this->fileName = $fileName;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
         $mail = $this->subject('New Client Comment on Ticket #' . $this->ticket->id)
                       ->view('emails.tickets.client_comment');

        // Attach file if exists
        if ($this->fileName) {
            $path = public_path('images/ticket_attachments/' . $this->fileName);
            if (file_exists($path)) {
                $mail->attach($path);
            }
        }

        return $mail;
        // return $this->view('view.name');
    }
}
