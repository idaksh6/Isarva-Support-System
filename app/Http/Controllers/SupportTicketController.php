<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Backend\Ticket;
use Illuminate\Support\Facades\File;

use App\Models\Backend\Client;
use Illuminate\Support\Facades\Hash;
use App\Helpers\ClientHelper;
use App\Helpers\TicketHelper;
use App\Helpers\EmployeeHelper;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Mail\ClientCommentAdded;   // For email integration under Clientcoment add class
use Illuminate\Support\Facades\Mail;
use App\Models\Backend\User;
use App\Mail\ClientTicketFormMail;

class SupportTicketController extends Controller
{
    // Support w/o email and client accees store
     // public function store(Request $request)
    // {
    //     // dd($request->all());
    //     $validated = $request->validate([
    //         'client_name' => 'required|string|max:200',
           
    //         'email'     => 'required|email',
    //         'phone'     => 'required|string|max:20',
    //         'name'    => 'nullable',                 // Domain name attribute
            
    //         'subject'   => 'required|string|max:255',
    //         'type'      => 'required|string',
    //         'message'   => 'required|string',
    //         'attachment' => 'nullable|file|max:5120', // Max 5MB
    //     ]);

    //     // dd($validated);

    //     // File upload
    //     // if ($request->hasFile('attachment')) {
    //     //     $validated['attachment'] = $request->file('attachment')->store('attachments', 'public');
    //     // }

    //     $fileName = null;
    //     if ($request->hasFile('attachment')) {
           
    //         $folderPath = public_path('images/ticket_attachments');
            
    //         if (!File::exists($folderPath)) {
    //             File::makeDirectory($folderPath, 0775, true, true);
    //         }
            
    //         $fileName = time() . '_' . $request->file('attachment')->getClientOriginalName();
    //         $request->file('attachment')->move($folderPath, $fileName);
    //     }

        

    //     // Map form fields to Ticket model columns
    //     $ticketData = [
    //         'domain'    => $validated['name'],
    //         'email_id'     => $validated['email'],
    //         'phone_number'     => $validated['phone'],
    //         'title'     => $validated['subject'],
    //         'comments' => $validated['message'],
    //         'client_name'=> $validated['client_name'],
    //         'priority' => 1,
    //         'client' => 0,
    //         'is_client' => 1,
    //         'source' => 1,
    //         'privacy' => 1,
    //         'last_modified_on' => \Carbon\Carbon::now(), 
    //         'team_members' => '21,22,23,24,27',
    //         // 'team_members' =>[21, 22, 23, 24, 27],
    //         // 'flag_to' => 20,
    //         'status' => 2,
    //         'created_by' => 1,
    //         'start_date' => \Carbon\Carbon::now(), 
    //         'end_date' => \Carbon\Carbon::now(), 
    //         'last_updated_by'=> 1,
    //         'created_on' => \Carbon\Carbon::now(), 
    //         'email_cc_list' => $validated['email'],
    //         'department' => 1,
    //         // 'type'      => 1,
    //          'type'  => $validated['type'],  
    //         'ip_address' => 122,
    //         // 'comments'  => $validated['message'],
    //         'attachment'=> $fileName
    //     ];

    // //    dd($ticketData);


    //     Ticket::create($ticketData);

    //     return back()->with('success', 'Support request submitted successfully.');
    // }


    // public function store(Request $request)
    // {
    //     // dd($request->all());
    //     $validated = $request->validate([
    //         'client_name' => 'required|string|max:200',
    //         'name'      => 'nullable|string|max:255',
    //         'email'     => 'required|email',
    //         'phone'     => 'required|string|max:20',
            
    //         'subject'   => 'required|string|max:255',
    //         'type'      => 'required|string',
    //         'message'   => 'required|string',
    //         'attachment' => 'nullable|file|max:5120', // Max 5MB
    //     ]);

    //     // File upload
    //     // if ($request->hasFile('attachment')) {
    //     //     $validated['attachment'] = $request->file('attachment')->store('attachments', 'public');
    //     // }

    //     $fileName = null;
    //     if ($request->hasFile('attachment')) {
           
    //         $folderPath = public_path('images/ticket_attachments');
            
    //         if (!File::exists($folderPath)) {
    //             File::makeDirectory($folderPath, 0775, true, true);
    //         }
            
    //         $fileName = time() . '_' . $request->file('attachment')->getClientOriginalName();
    //         $request->file('attachment')->move($folderPath, $fileName);
    //     }

        

    //     // Map form fields to Ticket model columns
    //     $ticketData = [
       
    //         'domain'    => $validated['name'],
    //         'email_id'     => $validated['email'],
    //         'phone_number'     => $validated['phone'],
    //         'title'     => $validated['subject'],
    //         'comments' => $validated['message'],
    //         'client_name'=> $validated['client_name'],
    //         'priority' => 1,
    //         'client' => 0,
    //         'is_client' => 1,
    //         'source' => 1,
    //         'privacy' => 1,
    //         'last_modified_on' => \Carbon\Carbon::now(), 
    //         'team_members' => 21,
    //         'flag_to' => 20,
    //         'status' => 1,
    //         'created_by' => 1,
    //         'start_date' => \Carbon\Carbon::now(), 
    //         'end_date' => \Carbon\Carbon::now(), 
    //         'last_updated_by'=> 1,
    //         'created_on' => \Carbon\Carbon::now(), 
    //         'email_cc_list' => $validated['email'],
    //         'department' => 1,
    //         'type'      =>  $validated['type'],
    //         'ip_address' => 122,
    //         // 'comments'  => $validated['message'],
    //         'attachment'=> $fileName
    //     ];

    //     Ticket::create($ticketData);

    //     // return back()->with('success', 'Support request submitted successfully.');

    //      // Check if client exists with this email
    //     $clientExists = Client::where('email_id', $validated['email'])->exists();

    //     // Prepare base message
    //     $message = 'Support request submitted successfully. ';
    //     $credentialsMessage = 'Your username is ' . $validated['email'] . ' and password is 1234.';
    //     $sameClientMessage = 'Login within your Username and Password to check ticket details';

    //     // Create new client if doesn't exist
    //     if (!$clientExists) {
    //         Client::create([
    //             'client_name' => $validated['client_name'],
    //             'user_name' => $validated['email'],    // Using email as username
    //             'password' => bcrypt('1234'),          // Static password
    //             'email_id' => $validated['email'],
    //             'phone' => $validated['phone'],
    //             'company_name' => 'N/A',              // Default value
    //             'description' => 'Auto-created via support ticket',
    //             'created_at' => \Carbon\Carbon::now(), 
    //             'created_by' => 1,
    //             'updated_by' => 1,
    //         ]);
    //         $message .= 'New client added successfully. ' . $credentialsMessage;
    //     } else {
    //         // $message .= $credentialsMessage;
    //          $message .= $sameClientMessage;
    //     }

    //     return back()->with('success', $message);

    // }

    public function store(Request $request)
    {
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

        // Handle attachment
        $fileName = null;
        if ($request->hasFile('attachment')) {
            $folderPath = public_path('images/ticket_attachments');
            if (!File::exists($folderPath)) {
                File::makeDirectory($folderPath, 0775, true, true);
            }
            $fileName = time() . '_' . $request->file('attachment')->getClientOriginalName();
            $request->file('attachment')->move($folderPath, $fileName);
        }

        // Check if client exists with this email
        $existingClient = Client::where('email_id', $validated['email'])->first();

        if (!$existingClient) {
            // Create new client and get ID
            $newClient = Client::create([
                'client_name' => $validated['client_name'],
                'user_name' => $validated['email'],    // Using email as username
                'password' => bcrypt('1234'),          // Static password
                'email_id' => $validated['email'],
                'phone' => $validated['phone'],
                'company_name' => 'N/A',
                'description' => 'Auto-created via support ticket',
                'created_at' => now(),
                'created_by' => 1,
                'updated_by' => 1,
            ]);
            $clientId = $newClient->id;
            $message = 'Support request submitted successfully. New client added successfully. Your username is ' . $validated['email'] . ' and password is 1234.';
        } else {
            $clientId = $existingClient->id;
            $message = 'Support request submitted successfully. For client login credentials, please contact our support team.';
        }

        // Now that $clientId is available, prepare ticket data
        $ticketData = [
            'domain'    => $validated['name'],
            'email_id' => $validated['email'],
            'phone_number' => $validated['phone'],
            'title'     => $validated['subject'],
            'comments'  => $validated['message'],
            'client_name' => $validated['client_name'],
            'priority' => 1,
            'client' => $clientId,
            'is_client' => 1,
            'source' => 1,
            'privacy' => 1,
            'last_modified_on' => now(),
            'team_members' => 21,
            'flag_to' => 20,
            'status' => 1,
            'created_by' => 1,
            'start_date' => now(),
            'end_date' => now(),
            'last_updated_by' => 1,
            'created_on' => now(),
            'email_cc_list' => $validated['email'],
            'department' => 1,
            'type'      => $validated['type'],
            'ip_address' => 122,
            'attachment' => $fileName
        ];

        Ticket::create($ticketData);

        // Prepare email data of the client ticket form
        $emailData = [
            'client_name' => $validated['client_name'],
            'email'       => $validated['email'],
            'phone'       => $validated['phone'],
            'name'        => $validated['name'] ?? '',
            'subject'     => $validated['subject'],
            'type'        => $this->getTypeName($validated['type']),
            'message'     => $validated['message'],
            'attachment'  => $fileName,
        ];

        // List of recipients
        // $recipients = ['web.b4@isarva.in', 'web.f5@isarva.in'];

        // // Send email to all
        // Mail::to($recipients)->send(new ClientTicketFormMail($emailData));

        return back()->with('success', $message);
    }


    private function getTypeName($type)
    {
        $types = [
            '1' => 'Bug Report',
            '2' => 'Question',
            '3' => 'Reminder',
            '4' => 'Incident',
            '5' => 'Problem',
            '6' => 'Feature Request',
            '7' => 'Request',
        ];
        return $types[$type] ?? 'Unknown';
    }

    // public function clientLogin(Request $request)
    // {
    //     $credentials = $request->validate([
    //         'username' => 'required',
    //         'password' => 'required'
    //     ]);

    //     // $client = Client::where('user_name', $credentials['username'])->first();

    //      $client = Client::where('email_id', $credentials['username'])->first();

    //     if ($client && Hash::check($credentials['password'], $client->password)) {
    //         session([
    //             'client_id' => $client->id,
    //             'client_email' => $client->email_id, // Get email from DB, not form
    //              'client_name' => $client->client_name,
    //             'client_logged_in' => true
    //         ]);
    //         //  dd(session()->all()); 
    //         // return redirect()->route('client.project.dashboard');
    //          return redirect()->route('client.ticket_view');
            
    //     }

    //     return back()->withErrors(['username' => 'Invalid credentials']);
    // }

    public function clientLogin(Request $request)
    {
        // dd($request);
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        // Auth attempt using the 'client' guard
        if (Auth::guard('client')->attempt(['email_id' => $credentials['username'], 'password' => $credentials['password']])) {
            $request->session()->regenerate();
            return redirect()->route('client.ticket_view');
        }

        return back()->withErrors(['username' => 'Invalid credentials']);
    }

    // For session workd fine
    // public function updatePassword(Request $request)
    // {
    //     $request->validate([
    //         'new_password' => 'required|min:6'
    //     ]);

    //     $clientId = session('client_id');

    //     // $client = Auth::guard('client')->user(); // Get logged-in client

    //     if (!$clientId) {
    //         return back()->with('error', 'Unauthorized action.');
    //     }

    //     $client = Client::find($clientId);

    //      if (!$client) {
    //         return back()->with('error', 'Unauthorized action.');
    //     }

    //     $client = Client::find($client);


    //     if (!$client) {
    //         return back()->with('error', 'Client not found.');
    //     }

    //     $client->password = Hash::make($request->new_password);
    //     $client->save();

    //     // return back()->with('success', 'Password updated successfully.');
    //      return redirect()->route('client.ticket_view')
    //         ->with('flash_success_cleintupdatedpaswrd', 'Password Updated successfully!');
    // }

        public function updatePassword(Request $request)
        {
            $request->validate([
                'new_password' => 'required|min:6'
            ]);

            $client = Auth::guard('client')->user(); // Get the logged-in client

            if (!$client) {
                return back()->with('error', 'Unauthorized action.');
            }

            // Update password
            $client->password = Hash::make($request->new_password);
            $client->save();

            return redirect()->route('client.ticket_view')
                ->with('flash_success_cleintupdatedpaswrd', 'Password Updated successfully!');
        }




    //   public function getclienttickedetail($id){

    //     return view('client.clientticket_detail');
    //   }
    // public function getclienttickedetail($id)
    // {
    //     $clientEmail = session('client_email');
        
    //     if (!$clientEmail) {
    //         return redirect()->route('clientlogin')->with('error', 'Please login to view ticket details');
    //     }

    //     // Get ticket details with client verification
    //     $ticket = DB::table('isar_tickets as t')
    //         ->where('t.id', $id)
    //         ->where('t.email_id', $clientEmail)  // Ensure ticket belongs to client
    //         ->where('t.is_client', 1)           // Ensure it's a client ticket
    //         ->first();

    //     if (!$ticket) {
    //         return redirect()->route('client.ticket_view')->with('error', 'Ticket not found or access denied');
    //     }

    //     // Add readable type name
    //     if ($ticket) {
    //         $ticket->type_name = TicketHelper::getTypeName($ticket->type);
    //     }

    //     // Get associated comments
    //     $comments = DB::table('isar_ticket_discusion')
    //         ->leftJoin('users', 'isar_ticket_discusion.user_id', '=', 'users.id')
    //         ->where('isar_ticket_discusion.ticket_id', $id)
    //         ->select('isar_ticket_discusion.*', 'users.name as user_name')
    //         ->orderBy('isar_ticket_discusion.created_on', 'desc')
    //         ->paginate(5);

    //     // Get helper data
    //     $employees = ClientHelper::getEmployees();
    //     $status = ClientHelper::TicketStatus();
    //     $department = ClientHelper::Departments();
    //     $priority = ClientHelper::Priority();

    //     // Get assigned names
    //     $ticket->assigned_to_names = EmployeeHelper::getEmployeeNamesByIds($ticket->team_members, $employees);

    //     return view('client.clientticket_detail', [
    //         'ticket' => $ticket,
    //         'comments' => $comments,
    //         'id' => $id,
    //         'employees' => $employees,
    //         'status' => $status,
    //         'department' => $department,
    //         'priority' => $priority,
    //     ]);
    // }

//     // Upone working fine
// public function getclienttickedetail($id)
// {
//     $client = Auth::guard('client')->user(); // Get logged-in client

//     if (!$client) {
//         return redirect()->route('clientlogin')->with('error', 'Please login to view ticket details');
//     }

//     // Get ticket details with client verification
//     $ticket = DB::table('isar_tickets as t')
//         ->where('t.id', $id)
//         ->where('t.email_id', $client->email)  // Ensure ticket belongs to logged-in client
//         ->where('t.is_client', 1)
//         ->first();

//     if (!$ticket) {
//         return redirect()->route('client.ticket_view')->with('error', 'Ticket not found or access denied');
//     }

//     $ticket->type_name = TicketHelper::getTypeName($ticket->type);

//     $comments = DB::table('isar_ticket_discusion')
//         ->leftJoin('users', 'isar_ticket_discusion.user_id', '=', 'users.id')
//         ->where('isar_ticket_discusion.ticket_id', $id)
//         ->select('isar_ticket_discusion.*', 'users.name as user_name')
//         ->orderBy('isar_ticket_discusion.created_on', 'desc')
//         ->paginate(5);

//     $employees = ClientHelper::getEmployees();
//     $status = ClientHelper::TicketStatus();
//     $department = ClientHelper::Departments();
//     $priority = ClientHelper::Priority();

//     $ticket->assigned_to_names = EmployeeHelper::getEmployeeNamesByIds($ticket->team_members, $employees);

//     return view('client.clientticket_detail', [
//         'ticket' => $ticket,
//         'comments' => $comments,
//         'id' => $id,
//         'employees' => $employees,
//         'status' => $status,
//         'department' => $department,
//         'priority' => $priority,
//     ]);
// }

    public function getclienttickedetail($id)
    {
        $client = Auth::guard('client')->user(); // Get logged-in client

        if (!$client) {
            return redirect()->route('clientlogin')->with('error', 'Please login to view ticket details');
        }

        // Ensure ticket belongs to logged-in client
        $ticket = DB::table('isar_tickets as t')
            ->where('t.id', $id)
            ->where('t.email_id', $client->email_id) // fixed here
            ->where('t.is_client', 1)
            ->first();

        if (!$ticket) {
            return redirect()->route('client.ticket_view')->with('error', 'Ticket not found or access denied');
        }

        $ticket->type_name = TicketHelper::getTypeName($ticket->type);

        $comments = DB::table('isar_ticket_discusion')
            ->leftJoin('users', 'isar_ticket_discusion.user_id', '=', 'users.id')
            ->where('isar_ticket_discusion.ticket_id', $id)
            ->select('isar_ticket_discusion.*', 'users.name as user_name')
            ->orderBy('isar_ticket_discusion.created_on', 'desc')
            ->paginate(5);

        $employees = ClientHelper::getEmployees();
        $status = ClientHelper::TicketStatus();
        $department = ClientHelper::Departments();
        $priority = ClientHelper::Priority();

        $ticket->assigned_to_names = EmployeeHelper::getEmployeeNamesByIds($ticket->team_members, $employees);

        return view('client.ticket_detail', [
            'ticket' => $ticket,
            'comments' => $comments,
            'id' => $id,
            'employees' => $employees,
            'status' => $status,
            'department' => $department,
            'priority' => $priority,
        ]);
    }



    // Working fine in session  --
    //  public function storeClientComment(Request $request)
    // {
    //     // dd($request->all());
    //     $clientId = session('client_id');
    //     $clientEmail = session('client_email');
        
    //     if (!$clientId || !$clientEmail) {
    //         return redirect()->route('clientlogin')->with('error', 'Please login to add comments');
    //     }

    //     $request->validate([
    //         'ticket_id' => 'required|exists:isar_tickets,id',
    //         'comments' => 'required|string',
    //          'attachment' => 'nullable|file|mimes:jpg,jpeg,png,gif,pdf,doc,docx|max:5120', // Max 5mb
    //     ], [
    //         'attachment.mimes' => 'Only images (jpg, jpeg, png, gif) and documents (pdf, doc, docx) are allowed.',
    //         'attachment.max' => 'The attachment must not be greater than 5MB.',
    //     ]);

    //     // dd($request);

    //     // Verify ticket belongs to client
    //     $ticket = Ticket::where('id', $request->ticket_id)
    //                     ->where('email_id', $clientEmail)
    //                     ->first();

    //     if (!$ticket) {
    //         return back()->with('error', 'Ticket not found or access denied');
    //     }

    //     // File upload
    //     $fileName = null;
    //     if ($request->hasFile('attachment')) {
    //         $folderPath = public_path('images/ticket_attachments');
    //         if (!File::exists($folderPath)) {
    //             File::makeDirectory($folderPath, 0775, true, true);
    //         }
    //         $fileName = time() . '_' . $request->file('attachment')->getClientOriginalName();
    //         $request->file('attachment')->move($folderPath, $fileName);
    //     }

    //     // Create comment with client-specific fields
    //     DB::table('isar_ticket_discusion')->insert([
    //         'ticket_id' => $request->ticket_id,
    //         'comments' => $request->comments,
    //         'attahcement' => $fileName,
    //         'created_on' => now(),
    //         'last_modified_on' => now(),
    //         'is_client_reply' => 1, // Mark as client reply
    //         'ip_address' => $request->ip(),
    //         // Add client ID if your table has a client_id column
    //         // 'client_id' => $clientId,
    //     ]);

    //     // Update ticket status to "Awaiting Response"
    //     // $ticket->update([
    //     //     'status' => 6,
    //     //     'last_modified_on' => now(),
    //     // ]);

    //        return redirect()->back()->withFlashSuccess(__('Comment added successfully.'));
    // }

        public function storeClientComment(Request $request)
        {
            // dd($request->all());
            $client = Auth::guard('client')->user(); // Get the logged-in client

            if (!$client) {
                return redirect()->route('clientlogin')->with('error', 'Please login to add comments');
            }

            $request->validate([
                'ticket_id' => 'required|exists:isar_tickets,id',
                'comments' => 'required|string',
                'attachment' => 'nullable|file|mimes:jpg,jpeg,png,gif,pdf,doc,docx|max:5120',
            ], [
                'attachment.mimes' => 'Only images (jpg, jpeg, png, gif) and documents (pdf, doc, docx) are allowed.',
                'attachment.max' => 'The attachment must not be greater than 5MB.',
            ]);
            // dd($request->all());

            $ticket = Ticket::where('id', $request->ticket_id)
                            ->where('email_id', $client->email_id)
                            ->first();

            // dd($ticket);
            if (!$ticket) {
                return back()->with('error', 'Ticket not found or access denied');
            }

            // File upload
            $fileName = null;
            if ($request->hasFile('attachment')) {
                $folderPath = public_path('images/ticket_attachments');
                if (!File::exists($folderPath)) {
                    File::makeDirectory($folderPath, 0775, true, true);
                }
                $fileName = time() . '_' . $request->file('attachment')->getClientOriginalName();
                $request->file('attachment')->move($folderPath, $fileName);
            }

            // Create comment
            DB::table('isar_ticket_discusion')->insert([
                'ticket_id' => $request->ticket_id,
                'comments' => $request->comments,
                'attahcement' => $fileName,
                'created_on' => now(),
                'last_modified_on' => now(),
                'is_client_reply' => 1,
                'ip_address' => $request->ip(),
                // 'client_id' => $client->id, // uncomment if column exists
            ]);

             //  Send email to each team member
            if (!empty($ticket->team_members)) {
                $userIds = explode(',', $ticket->team_members);

                $users = User::whereIn('id', $userIds)->get();

                foreach ($users as $user) {
                    Mail::to($user->email)->send(new ClientCommentAdded($ticket, $request->comments, $fileName));
                }
            }
                    return redirect()->back()->withFlashSuccess(__('Comment added successfully.'));
        }
}
