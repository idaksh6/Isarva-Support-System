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
}
