<?php

namespace App\Http\Controllers\Backend\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BillableNonBillableController extends Controller
{
    //
    public function index(){

    return view('backend.reports.billable_nonbillable');
    }
}
