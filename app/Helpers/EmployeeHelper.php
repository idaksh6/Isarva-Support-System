<?php

namespace App\Helpers;

use App\Models\Backend\Employee;
use App\Models\Backend\User;
use Illuminate\Support\Facades\Auth;

class EmployeeHelper
{
    /**
     * 
     *
     * @return \Illuminate\Support\Collection
     */
  


     // Fetch all Employee names from the database.
    public static function getEmployeeNames()
    {
        return User::pluck('name', 'id'); // Fetch employee names as key-value pairs
    }

    // Get Employee profile image to display in profile section
    public static function getProfileImage()
    {
        $user = Auth::user();
        if (!$user) {
            return asset('/images/xs/avatar1.jpg');
        }

        return $user->profile_image 
            ? asset($user->profile_image) 
            : asset('/images/xs/avatar1.jpg');
    }


    public static function getEmployeeNamesByIds($ids, $allEmployees)
    {
        $idArray = explode(',', $ids);
        $names = [];
        foreach ($idArray as $id) {        // ex :$idArray would become ['1', ' 5', ' 12'].
            $id = trim($id);
            if (isset($allEmployees[$id])) {
                $names[] = $allEmployees[$id];
            }
        }
        return $names;
    }


}