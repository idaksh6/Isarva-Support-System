<?php

namespace App\Helpers;

use App\Models\Backend\Employee;
use App\Models\Backend\User;

class EmployeeHelper
{
    /**
     * Fetch all client names from the database.
     *
     * @return \Illuminate\Support\Collection
     */
    // public static function getEmployeeNames()
    // {
    //     return Employee::pluck('name', 'id'); // Fetch employee names as key-value pairs
    // }

    public static function getEmployeeNames()
    {
        return User::pluck('name', 'id'); // Fetch employee names as key-value pairs
    }
}