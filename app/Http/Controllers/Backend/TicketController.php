<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

class TicketController
{
    //

    public function ticketView(){
        return view('backend.tickets.ticket-view');
    }
    public function ticketDetail(){
        return view('backend.tickets.ticket-detail');
    }

}
