<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

class AppsController
{
    //
    public function calender(){
        return view('backend.calender');
    }
    public function messages(){
        return view('backend.messages');
    }
}
