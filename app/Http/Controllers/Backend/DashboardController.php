<?php

namespace App\Http\Controllers\Backend;
use Illuminate\Http\Request;

/**
 * Class DashboardController.
 */
class DashboardController
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    
    public function formBasic(Request $request)
    {
        $validatedData = $request->validate([
            "firstname"  => 'required',
            "lastname"  => 'required',
            "phonenumber"  => 'required',
            "emailaddress"  => 'required|unique:employees|max:255',
            "admitdate"  => 'required',
            "admittime"  => 'required',
            "formFileMultiple"  => 'required',
            "exampleRadios"  => 'required',
            "addnote"  => 'required',
        ]);
    }

    public function formAdvance(Request $request)
    {
        $validatedData = $request->validate([
            "min8" => 'required|min:8',
            "between5to10" => 'required|between:5,10',
            "between_min_number" => 'required|min:5',
            "between20to30" => 'required|between:20,30'
        ]);
    }

    public function index()
    {
        return view('backend.dashboard');
    }

    public function project()
    {
        return view('backend.project_dashboard');
    }
    
    public function help()
    {
        return view('backend.help');
    }
    public function classes(){
        return view('backend.classes');
    }
    public function student(){
        return view('backend.student');
    }
    public function videoClasses(){
        return view('backend.video-classes');
    }
    public function messages(){
        return view('backend.messages');
    }
    public function reviews(){
        return view('backend.reviews');
    }
}
