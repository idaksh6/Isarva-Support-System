<?php

namespace App\Helpers;

use App\Models\Backend\Client;

class ClientHelper
{
    /**
     * Fetch all client names from the database.
     *
     * @return \Illuminate\Support\Collection
     */
    public static function getClientNames()
   {
    return cache()->remember('client_names', 3600, function () {
        return Client::pluck('client_name', 'id'); // Cache for 1 hour
    });
  }
}