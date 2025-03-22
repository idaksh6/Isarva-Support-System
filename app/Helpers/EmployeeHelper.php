<?php

namespace App\Helpers;

use App\Models\Backend\Employee;

class EmployeeHelper
{
    /**
     * Fetch all client names from the database.
     *
     * @return \Illuminate\Support\Collection
     */
    public static function getEmployeeNames()
    {
        return Employee::pluck('name', 'id'); // Fetch employee names as key-value pairs
    }
}