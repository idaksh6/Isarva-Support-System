<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

class ProjectController
{
    //
    public function index(){
        return view('backend.project.index');
    }
    public function tasks(){
        return view('backend.project.tasks');
    }
    public function timesheet(){
        return view('backend.project.timesheet');
    }
    public function leaders(){
        return view('backend.project.leaders');
    }

}
