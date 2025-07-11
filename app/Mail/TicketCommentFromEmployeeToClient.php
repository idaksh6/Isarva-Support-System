<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
class TicketCommentFromEmployeeToClient extends Mailable
{
    use Queueable, SerializesModels;

    public $ticket;
    public $user;
    public $comment;
    // public $attachment;
      public $fileName;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($ticket, $user, $comment, $fileName = null)
    {
        //
        $this->ticket = $ticket;
        $this->user = $user;
        $this->comment = $comment;
        $this->fileName  = $fileName;
        
    }

    /**
     * Build the message.
     *
     * @return $this
  */
    // public function build()
    // {
    //     // \Log::info('Building mail for ticket ID: ' . $this->ticket->id);

    //    $mail = $this->subject('New Comment on Your Ticket')
    //                 ->view('emails.tickets.ticket_comment_from_employee')
    //                   ->with([
    //                         'ticket' => $this->ticket,
    //                         'user' => $this->user,
    //                         'comment' => $this->comment,
    //                         'fileName' => $this->fileName,
    //                     ]);

    //     if ($this->fileName) {
    //         $mail->attach(public_path('images/ticket_attachments/' . $this->fileName));
    //     }

    //     // dd($mail);

    //     return $mail;
    // }
     public function build()
    {
        // Log::info('Building mail for ticket ID: ' . $this->ticket->id);

        $mail = $this->subject('New Comment on Your Ticket')
                    ->view('emails.tickets.ticket_comment_from_employee');

        // Pass variables directly to view (public properties are already available)
        // Remove the ->with() call as it's redundant

        if ($this->fileName) {
            $attachmentPath = public_path('images/ticket_attachments/' . $this->fileName);
            
            if (file_exists($attachmentPath)) {
                $mail->attach($attachmentPath, [
                    'as' => $this->fileName,
                    'mime' => mime_content_type($attachmentPath),
                ]);
            } else {
                Log::warning("Attachment not found: " . $attachmentPath);
            }
        }

        //  dd($mail);
        return $mail;
    }
}
