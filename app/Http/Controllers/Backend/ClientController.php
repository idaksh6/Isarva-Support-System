<?php

namespace App\Http\Controllers\Backend;


use Illuminate\Http\Request;
use App\Models\Backend\Client;
use Illuminate\Support\Facades\Auth;

class ClientController
{
    /** Manage page to view all the clients - Author SK - 29-02-2025 */
    public function clients()
    {
        $clients = Client::all(); // Fetch all clients from the database
        return view('backend.our-client.clients', compact('clients'));
    }
    public function clientsProfile(){
        return view('backend.our-client.client-profile');
    }

    /** Store the Client Information - Author SK - 29-02-2025 */
    public function store(Request $request)
    {
        $request->validate([
            'client_name' => 'required|string|max:255',
            'client_pos_in_comp'=> 'nullable|string|max:255',
            'company_name' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'password' => 'required|string|min:6',
            'email' => 'required|email',
            'phone' => 'required',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $client = new Client();
        $client->client_name = $request->client_name;
        $client->client_pos_in_comp = $request->client_pos_in_comp;
        $client->company_name = $request->company_name;
        $client->user_name = $request->username;
        $client->password = bcrypt($request->password);
        $client->email_id = $request->email;
        $client->phone = $request->phone;
        $client->description = $request->description;
        $client->created_by = Auth::id();
        $client->updated_by = Auth::id();

        if ($request->hasFile('profile_image')) {
            $fileName = time() . '.' . $request->profile_image->extension();
            $filePath = public_path('images/client_or_comp_images/'); // Define the target path

            // Ensure the directory exists
            if (!file_exists($filePath)) {
                mkdir($filePath, 0777, true);
            }

            $request->profile_image->move($filePath, $fileName);
            $client->profile_image = 'images/client_or_comp_images/' . $fileName; // Store relative path
        }

        $client->save();

        return redirect()->back()->withFlashSuccess(__('The client was successfully created.'));

    }


}
