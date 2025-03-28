<?php

namespace App\Helpers;

use App\Models\Backend\Client;
use App\Models\Backend\Project;
use App\Models\Backend\Employee;

class ClientHelper
{
    /**
     * Fetch all client names from the database.
     *
     * @return \Illuminate\Support\Collection
     */
    public static function getClientNames()
    {
    
        return Client::pluck('client_name', 'id'); // Cache for 1 hour
    }

    // Get Project By Ak
    public static function getProjects()
    {
      return Project::pluck('project_name','id');
    }

    public static function getEmployees()
    {
        return Employee::pluck('name', 'id'); // Fetch employee names as key-value pairs
    }

    public static function TicketStatus()
    {
        $tickets_status=array(
            "1"=>"Open",
            "2"=>"Progress",
            "3"=>"On Hold",
            "4"=>"Monitor",
            "5"=>"Assigned",
            "6"=>"Awaiting Client Response",
            "7"=>"Closed"
        );

        return $tickets_status;
    }
}