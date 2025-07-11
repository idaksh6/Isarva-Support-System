<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Backend\Client;

class GeneralApiController extends Controller
{
    //
    public function getClients(Request $request)
    {
        $clients = Client::all(); // ← This will return ALL columns from the `isar_clients` table

        return response()->json($clients);
    }
}
