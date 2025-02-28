<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

class OtherpagesController
{
    //
    public function apexCharts(){
        return view('backend.other-page.apex-charts');
    }
    public function formExample(){
        return view('backend.other-page.form-example');
    }
    public function tableExample(){
        return view('backend.other-page.table-example');
    }
    public function reviewPage(){
        return view('backend.other-page.review-page');
    }
    public function icons(){
        return view('backend.other-page.icons');
    }
    public function contact(){
        return view('backend.other-page.contact');
    }
    
}
