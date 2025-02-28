<?php

namespace App\Http\Controllers\Backend;
use Illuminate\Http\Request;

class AccountsController
{
    //
    public function invocies(){
        return view('backend.accounts.invocies');
    }
    public function payments(){
        return view('backend.accounts.payments');
    }
    public function expenses(){
        return view('backend.accounts.expenses');
    }

}
