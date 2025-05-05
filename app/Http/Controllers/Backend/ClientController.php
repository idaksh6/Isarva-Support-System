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

    public function search(Request $request)
    {
        $q = $request->input('q');

        $clients = Client::where('client_name', 'like', '%' . $q . '%')
            ->orWhere('company_name', 'like', '%' . $q . '%')
            ->orWhere('email_id', 'like', '%' . $q . '%')
            ->orWhere('phone', 'like', '%' . $q . '%')
            ->get();

        return view('backend.our-client.clients', compact('clients', 'q'));
    }

    /** Store the Client Information - Author SK - 29-02-2025 */
    public function store(Request $request)
    {
        $request->validate([
            'client_name' => 'required|string|max:255',
            'client_pos_in_comp' => 'nullable|string|max:255',
            'company_name' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'password' => 'nullable|string|min:6',
            'email' => 'nullable|email',
            // 'phone' => 'required|unique:isar_clients,phone',
            'phone' => 'required|unique:isar_clients,phone|regex:/^[0-9-]{1,20}$/|max:20',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ], [
            'client_name.required' => 'The client name is required.',
            'client_name.string' => 'The client name must be a string.',
            'client_name.max' => 'The client name may not be greater than 255 characters.',
            
            'client_pos_in_comp.string' => 'The position in company must be a string.',
            'client_pos_in_comp.max' => 'The position in company may not be greater than 255 characters.',
            
            'company_name.required' => 'The company name is required.',
            'company_name.string' => 'The company name must be a string.',
            'company_name.max' => 'The company name may not be greater than 255 characters.',
            
            'username.required' => 'The username is required.',
            'username.string' => 'The username must be a string.',
            'username.max' => 'The username may not be greater than 255 characters.',
            
            'password.string' => 'The password must be a string.',
            'password.min' => 'The password must be at least 6 characters.',
            
           
            'email.email' => 'The email must be a valid email address.',
            
            'phone.required' => 'The phone number is required.',
            'phone.unique' => 'The phone number entered already exists.',
            'phone.regex' => 'The phone number can only contain numbers and hyphens.',
            'phone.max' => 'The phone number may not be greater than 20 characters.',
            
            'profile_image.image' => 'The profile image must be an image.',
            'profile_image.mimes' => 'The profile image must be a file of type: jpeg, png, jpg.',
            'profile_image.max' => 'The profile image may not be greater than 2MB.',
        ]);
        
        $client = new Client();
        $client->client_name        = $request->client_name;
        $client->client_pos_in_comp = $request->client_pos_in_comp;
        $client->company_name       = $request->company_name;
        $client->user_name          = $request->username;
        $client->password           = bcrypt($request->password);
        $client->email_id           = $request->email;
        $client->phone              = $request->phone;
        $client->description        = $request->description;
        $client->created_by         = Auth::id();
        $client->updated_by         = Auth::id();

        if ($request->hasFile('profile_image')) {
            $fileName = time() . '.' . $request->profile_image->extension();
            $filePath = public_path('images/client_or_comp_images/'); // Define the target path

            // Ensure the directory exists
            if (!file_exists($filePath)) {
                mkdir($filePath, 0777, true);
            }

            $request->profile_image->move($filePath, $fileName);
            $client->profile_image = 'images/client_or_comp_images/' . $fileName; // Store relative path
        } else {
            // Set default image if no image was provided
            $client->profile_image = 'images/xs/avatar1.jpg';
        }

        $client->save();

        // return redirect()->back()->withFlashSuccess(__('The client was successfully created.'));
        
    //    return redirect()->route('admin.our-client.clients')->withFlashSuccess(_('The client was successfully created.'));

    return response()->json(['success' => true]);

    }

    // EDIT SINGLE CLIENT INFORMATION - AUTH - SK - 28-02-2025
    public function edit($id)
    {
        $client = Client::findOrFail($id); // Fetch the client by ID
        return response()->json($client); // Return client data as JSON
    }


    // UPDATE SINGLE CLIENT INFORMATION - AUTH - SK - 28-02-2025
    public function update(Request $request, $id)
    {
        $request->validate([
            'client_name' => 'required|string|max:255',
            'client_pos_in_comp' => 'nullable|string|max:255',
            'company_name' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'password' => 'nullable|string|min:6',
            'email' => 'nullable|email',
            'phone' => 'required|unique:isar_clients,phone|regex:/^[0-9-]{1,20}$/|max:20',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ], [
            'client_name.required' => 'The client name is required.',
            'client_name.string' => 'The client name must be a string.',
            'client_name.max' => 'The client name may not be greater than 255 characters.',
            
            'client_pos_in_comp.string' => 'The position in company must be a string.',
            'client_pos_in_comp.max' => 'The position in company may not be greater than 255 characters.',
            
            'company_name.required' => 'The company name is required.',
            'company_name.string' => 'The company name must be a string.',
            'company_name.max' => 'The company name may not be greater than 255 characters.',
            
            'username.required' => 'The username is required.',
            'username.string' => 'The username must be a string.',
            'username.max' => 'The username may not be greater than 255 characters.',
            
            'password.string' => 'The password must be a string.',
            'password.min' => 'The password must be at least 6 characters.',
            
            'email.email' => 'The email must be a valid email address.',
            
            'phone.required' => 'The phone number is required.',
            'phone.unique' => 'The phone number entered already exists.',
            'phone.regex' => 'The phone number can only contain numbers and hyphens.',
            'phone.max' => 'The phone number may not be greater than 20 characters.',
            
            'profile_image.image' => 'The profile image must be an image.',
            'profile_image.mimes' => 'The profile image must be a file of type: jpeg, png, jpg.',
            'profile_image.max' => 'The profile image may not be greater than 2MB.',
        ]);
        
        $client = Client::findOrFail($id);
        $client->client_name = $request->client_name;
        $client->client_pos_in_comp = $request->client_pos_in_comp;
        $client->company_name = $request->company_name;
        $client->user_name = $request->username;
        if ($request->password) {
            $client->password = bcrypt($request->password);
        }
        $client->email_id = $request->email;
        $client->phone = $request->phone;
        $client->description = $request->description;
        $client->updated_by = Auth::id();
    
        if ($request->hasFile('profile_image')) {
            $fileName = time() . '.' . $request->profile_image->extension();
            $filePath = public_path('images/client_or_comp_images/');
            if (!file_exists($filePath)) {
                mkdir($filePath, 0777, true);
            }
            $request->profile_image->move($filePath, $fileName);
            $client->profile_image = 'images/client_or_comp_images/' . $fileName;
        }
    
        $client->save();
    
        return redirect()->back()->withFlashSuccess(__('The client was successfully updated.'));

        // return response()->json([
        //     'success' => true,
        //     'message' => 'The client was successfully created.'
        // ]);
    }


    // DELETE SINGLE CLIENT INFORMATION - AUTH - SK - 28-02-2025
    public function destroy($id)
    {
        $client = Client::findOrFail($id); // Find the client by ID
        $client->delete(); // Delete the client

        return response()->json(['success' => true, 'message' => 'Client deleted successfully.']);
    }


}
