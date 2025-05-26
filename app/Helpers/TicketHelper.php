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

      public static function getTypeName($type)
    {
        $types = [
            1 => 'Bug Report',
            2 => 'Question',
            3 => 'Reminder',
            4 => 'Incident',
            5 => 'Problem',
            6 => 'Feature Request',
            7 => 'Request',
        ];

        return $types[$type] ?? 'Unknown';
    }
}