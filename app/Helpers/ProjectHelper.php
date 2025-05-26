<?php

namespace App\Helpers;

use App\Models\Backend\Project;

class ProjectHelper
{
    /**
     * Fetch all project names from the database.
     *
     * @return \Illuminate\Support\Collection
     */
    public static function getProjectNames()
    {
        return Project::pluck('project_name', 'id'); // Fetch project names as key-value pairs
    }

    public static function getBillingCompanies()
    {
        return collect([
            // 0 => 'None',
            1 => 'Isarva Internal',
            2 => 'Blue Flemingo',
            3 => 'Glue',
            4 => 'Eye Web',
            5 => 'Indian Project',
        ]);
    }

    public static function getbiilingtype()
    {

        return collect([

            0 => 'NonBillable',
            1 => 'Billable',
            2 => 'Internal Billable'
        ]);
    }



}
