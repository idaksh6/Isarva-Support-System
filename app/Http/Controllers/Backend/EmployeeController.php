<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

class EmployeeController
{
    //
    public function members(){
        return view('backend.our-employee.members');
    }

    public function membersProfile(){
        return view('backend.our-employee.members-profile');
    }

    public function holidays(){
        return view('backend.our-employee.holidays');
    }

    public function attendanceEmployee(){
        return view('backend.our-employee.attendance-employee');
    }

    public function attendance(){
        $collection = collect([
        [
            'name' => 'Joan Dyer',
            'attendance' => [
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-wall-clock text-warning',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-wall-clock text-warning',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-wall-clock text-warning',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                ''
            ]
        ],
        [
            'name' => 'Ryan Randall	',
            'attendance' => [
                'icofont-close-circled text-danger',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-close-circled text-danger',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-wall-clock text-warning',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-close-circled text-danger',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-wall-clock text-warning',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                ''
            ]
        ],
        [
            'name'=> 'Ryan Randall	',
            'attendance'=> [
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-wall-clock text-warning',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-wall-clock text-warning',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                ''
            ]
        ],
        [
            'name' => 'Victor Rampling',
            'attendance' => [
                'icofont-check-circled text-success',
                'icofont-wall-clock text-warning',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-wall-clock text-warning',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-wall-clock text-warning',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                ''
            ]
        ],
        [
            'name' => 'Sally Graham',
            'attendance' => [
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-wall-clock text-warning',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-wall-clock text-warning',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                ''
            ]
        ],
        [
            'name' => 'Robert Anderson',
            'attendance' => [
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                ''
            ]
        ],
        [
            'name' => 'Ryan Stewart',
            'attendance' => [
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-check-circled text-success',
                'icofont-wall-clock text-warning',
                ''
            ]
        ]
    ]);
        $data = $collection->all();
        
        return view('backend.our-employee.attendance',compact('data'));
    }

    public function leaveRequest(){
        return view('backend.our-employee.leave-request');
    }

    public function department(){
        return view('backend.our-employee.department');
    }

    public function payroll(){
        return view('backend.our-employee.payroll');
    }
}
