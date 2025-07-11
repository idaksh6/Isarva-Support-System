<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Backend\Project;
use App\Models\Backend\Client;
use App\Models\Backend\User;

class ProjectCreated extends Mailable
{
    use Queueable, SerializesModels;

  
    public $project;

    /**
     * Create a new message instance.
     *
     * @param Project $project
     * @return void
     */
    public function __construct(Project $project)
    {
        $this->project = $project;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // Fetch client name
        $clientName = Client::where('id', $this->project->client)->value('client_name') ?? 'N/A';

        // Fetch created_by name
        $createdByName = User::where('id', $this->project->created_by)->value('name') ?? 'N/A';

        // Map type ID to name
        $typeNames = [
            1 => 'External',
            2 => 'Internal',
        ];
        $type = $typeNames[$this->project->type] ?? 'Unknown';

        return $this->to('web.b4@isarva.in')
                    ->subject('New Project Created: ' . $this->project->project_name)
                    ->view('emails.projects.project_created')
                    ->with([
                        'client_name' => $clientName,
                        'project_name' => $this->project->project_name,
                        'category_name' => Project::$categoryNames[$this->project->category] ?? 'N/A',
                        'created_by' => $createdByName,
                        'start_date' => \Carbon\Carbon::parse($this->project->start_date)->format('Y-m-d'),
                        'end_date' => \Carbon\Carbon::parse($this->project->end_date)->format('Y-m-d'),
                        'type' => $type,
                        'estimation' => $this->project->estimation,
                        'billing_company' => Project::$billingCompanyNames[$this->project->biiling_company] ?? 'None',
                        'description' => $this->project->description,
                    ]);
    }
}
