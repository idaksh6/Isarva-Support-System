<?php

namespace App\Helpers;

use App\Models\Backend\User;
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
        return User::pluck('name', 'id'); // Fetch employee names as key-value pairs
    }

    public static function ProfileImg($userId)
    {
        return User::where('id', $userId)->value('profile_image');
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

    public static function Months()
    {
        $month=array(
            "1"=>"Jan",
            "2"=>"Feb",
            "3"=>"Mar",
            "4"=>"Apr",
            "5"=>"May",
            "6"=>"Jun",
            "7"=>"July",
            "8"=>"Aug",
            "9"=>"Sep",
            "10"=>"Oct",
            "11"=>"Nov",
            "12"=>"Dec",
        );

        return $month;
    }

    public static function Departments()
    {
        $department=array(
            "1"=>"Development",
            "2"=>"Billing",
            "3"=>"Graphics",
            "4"=>"Other Support",
        );

        return $department;
    }

    public static function Priority()
    {
        $priority=array(
            "1"=>"Low",
            "2"=>"Medium",
            "3"=>"High",
        );

        return $priority;
    }
}