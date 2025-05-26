<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Backend\Ticket;
use Illuminate\Support\Facades\File;

class SupportTicketController extends Controller
{
    public function store(Request $request)
    {
        // dd($request->all());
        $validated = $request->validate([
            'client_name' => 'required|string|max:200',
            'name'      => 'nullable|string|max:255',
            'email'     => 'required|email',
            'phone'     => 'required|string|max:20',
            
            'subject'   => 'required|string|max:255',
            'type'      => 'required|string',
            'message'   => 'required|string',
            'attachment' => 'nullable|file|max:5120', // Max 5MB
        ]);

        // File upload
        // if ($request->hasFile('attachment')) {
        //     $validated['attachment'] = $request->file('attachment')->store('attachments', 'public');
        // }

        $fileName = null;
        if ($request->hasFile('attachment')) {
           
            $folderPath = public_path('images/ticket_attachments');
            
            if (!File::exists($folderPath)) {
                File::makeDirectory($folderPath, 0775, true, true);
            }
            
            $fileName = time() . '_' . $request->file('attachment')->getClientOriginalName();
            $request->file('attachment')->move($folderPath, $fileName);
        }

        

        // Map form fields to Ticket model columns
        $ticketData = [
       
            'domain'    => $validated['name'],
            'email_id'     => $validated['email'],
            'phone_number'     => $validated['phone'],
            'title'     => $validated['subject'],
            'comments' => $validated['message'],
            'client_name'=> $validated['client_name'],
            'priority' => 1,
            'client' => 0,
            'is_client' => 1,
            'source' => 1,
            'privacy' => 1,
            'last_modified_on' => \Carbon\Carbon::now(), 
            'team_members' => 21,
            'flag_to' => 20,
            'status' => 2,
            'created_by' => 1,
            'start_date' => \Carbon\Carbon::now(), 
            'end_date' => \Carbon\Carbon::now(), 
            'last_updated_by'=> 1,
            'created_on' => \Carbon\Carbon::now(), 
            'email_cc_list' => $validated['email'],
            'department' => 1,
            'type'      =>  $validated['type'],
            'ip_address' => 122,
            // 'comments'  => $validated['message'],
            'attachment'=> $fileName
        ];

        Ticket::create($ticketData);

        return back()->with('success', 'Support request submitted successfully.');
    }
}
