<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TicketAssignedNotification extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $ticketId;
    public $ticketTitle;
    public $assignedByName;
    public $assignedToEmail;

    public function __construct($ticketId, $ticketTitle, $assignedByName, $assignedToEmail) // Placeholder for values fetched in controller
    {
        $this->ticketId = $ticketId;
        $this->ticketTitle = $ticketTitle;
        $this->assignedByName = $assignedByName;
        $this->assignedToEmail = $assignedToEmail; // email fetched from the database in the controller is now stored in the $this->assignedToEmail property of the TicketAssignedNotification object.
    }

    // Method defines how the email message is constructed.
    public function build()
    {
        return $this->subject("New Ticket Flagged #{$this->ticketId} - {$this->ticketTitle}")
                    ->view('emails.tickets.ticket_assigned')
                    ->to($this->assignedToEmail);
    }
}
