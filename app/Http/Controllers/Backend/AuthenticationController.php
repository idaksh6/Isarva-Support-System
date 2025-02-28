<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

class AuthenticationController
{
    //
    public function signin(){
        return view('backend.auth-pages.signin');
    }
    public function signup(){
        return view('backend.auth-pages.signup');
    }
    public function passwordReset(){
        return view('backend.auth-pages.password-rest');
    }
    public function twoStepAuthentication(){
        return view('backend.auth-pages.two-step-auth');
    }
    public function badRequest(){
        return view('backend.auth-pages.badrequest');
    }
}
