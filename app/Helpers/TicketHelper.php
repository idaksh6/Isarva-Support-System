<?php
// app/Helpers/TicketHelper.php

namespace App\Helpers;

use App\Models\Backend\Ticket;

class TicketHelper
{
    public static function getTicketNames()
    {
        return Ticket::pluck('title', 'id')->toArray();
    }
}