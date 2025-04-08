<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;

class DailyReportMail extends Mailable
{
    // use Queueable, SerializesModels;

    // /**
    //  * Create a new message instance.
    //  *
    //  * @return void
    //  */
    // public $reportData;

    // public function __construct($reportData)
    // {
    //     $this->reportData = $reportData;
    // }

    // public function build()
    // {
    //     return $this->subject('Daily Report Submission')
    //                 ->view('emails.daily_report_email')
    //                 ->with('reportData', $this->reportData);
    // }
   
    use Queueable, SerializesModels;

    public $emailData;
    public $userName;

    public function __construct($emailData, $userName)
    {
        $this->emailData = $emailData;
        $this->userName = $userName; // Store the username
    }

    public function build()
    {
        return $this->from('web.b4@isarva.in', 'Isarva Support') // Must match the verified sender
                    ->view('emails.daily_report_email')
                    ->with([
                        'reportData' => $this->emailData['reportData'],
                        'overallStatus' => $this->emailData['overallStatus'],
                        'totalTime' => $this->emailData['totalTime']
                    ])
                    ->subject('Daily Report Submission - ' . $this->userName);
    }

}
