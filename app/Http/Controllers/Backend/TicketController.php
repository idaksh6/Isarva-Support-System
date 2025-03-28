<?php

namespace App\Http\Controllers\Backend;
use Illuminate\Http\Request;
use App\Helpers\ClientHelper;
use App\Helpers\EmployeeHelper;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

use Illuminate\Support\Facades\Storage;
use App\Models\Backend\Ticket; // Assuming you have a Ticket model
use App\Models\Backend\TicketComment; // Assuming you have a Ticket model

class TicketController
{
    //

    public function ticketView(Request $request)
    {
        // Retrieve query parameters
        $query = Ticket::query();

        if ($request->filled('q')) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'like', '%' . $request->q . '%')
                ->orWhere('id', 'like', '%' . $request->q . '%')
                ->orWhere('domain', 'like', '%' . $request->q . '%');
            });
        }

        if ($request->filled('month_year')) {
            $monthYear = explode('-', $request->month_year); // Splitting into [YYYY, MM]
            if (count($monthYear) == 2) {
                $query->whereYear('created_at', $monthYear[0])
                    ->whereMonth('created_at', $monthYear[1]);
            }
        }

        if ($request->filled('assignedTo')) {
            $query->where('flag_to', $request->assignedTo);
        }

        if ($request->filled('department')) {
            $query->where('department', $request->department);
        }

        if ($request->filled('priority')) {
            $query->where('priority', $request->priority);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Fetch filtered tickets
        $tickets = $query->get();

        // Get supporting data
        $clients = ClientHelper::getClientNames();
        $projects = ClientHelper::getProjects();
        $employees = ClientHelper::getEmployees();
        $status = ClientHelper::TicketStatus();
        $department=ClientHelper::Departments();
        $priority=ClientHelper::Priority();
        

        // Pass the filtered tickets to the view
        return view('backend.tickets.ticket-view', [
            'tickets' => $tickets,
            'clients' => $clients,
            'projects' => $projects,
            'employees' => $employees,
            'status' => $status,
            'department'=>$department,
            'priority'=>$priority,
            
        ]);
    }



    public function ticketDetail($id)
    {
        // Get ticket details
        $ticket = DB::table('isar_tickets')
            ->where('id', $id)
            ->first();
    
        // Get associated comments
        $comments = DB::table('isar_ticket_discusion')
            ->where('ticket_id', $id)
            ->orderBy('created_on', 'desc')
            ->paginate(5);
    
        // Get user details for comments (if needed)
        $commentsWithUsers = DB::table('isar_ticket_discusion')
            ->where('ticket_id', $id)
            ->join('users', 'isar_ticket_discusion.user_id', '=', 'users.id')
            ->select('isar_ticket_discusion.*', 'users.name as user_name')
            ->get();
        
        $employees=ClientHelper::getEmployees();
        $status=ClientHelper::TicketStatus();

        return view('backend.tickets.ticket-detail', [
            'ticket' => $ticket,
            'comments' => $comments,
            'commentsWithUsers' => $commentsWithUsers, // choose one approach
            'id' => $id,
            'employees'=>$employees,
            'status'=>$status
        ]);
    }

      /** Store the Ticket Information - Author SK - 11-03-2025 */
      public function store(Request $request)
    {
        
        // Validate the request data
        // $request->validate([
        //     'client' => 'required|string|max:200',
        //     'title' => 'required|string|max:500',
        //     'domain' => 'nullable|string',
        //     'type' => 'required|string',
        //     'source' => 'required|string',
        //     'priority' => 'required|integer',
        //     'project' => 'nullable|string',
        //     'description' => 'required|string',
        //     'privacy' => 'required|integer',
        //     'assignedTo' => 'required|string',
        //     'dueDate' => 'required|date',
        //     'department' => 'required|string',
        //     'attachment' => 'nullable|file|mimes:jpeg,png,jpg,pdf,doc,docx|max:2048',
        // ]);

        // Create a new Ticket instance
        $ticket = new Ticket();

        if ($request->hasFile('attachment')) {
            $folderPath = public_path('images/ticket_attachments'); // Path to store files in public folder
        
            // Ensure the folder exists, create if not
            if (!File::exists($folderPath)) {
                File::makeDirectory($folderPath, 0775, true, true);
            }
        
            // Generate a unique file name
            $fileName = time() . '_' . $request->file('attachment')->getClientOriginalName();
        
            // Move the file to the target folder
            $request->file('attachment')->move($folderPath, $fileName);
        
            // Delete old file if exists
            if (!empty($ticket->attachment) && File::exists(public_path('images/ticket_attachments/'.$ticket->attachment))) {
                File::delete(public_path('images/ticket_attachments/'.$ticket->attachment));
            }
        
            // Store the new file path in the database
            $ticket->attachment = 'images/ticket_attachments/' . $fileName;
        }else{
            $fileName="";
        }

        $ticket->client = $request->client;
        $ticket->title = $request->title;
        $ticket->domain = $request->domain;
        $ticket->type = $request->tag;
        $ticket->source = $request->source;
        $ticket->priority = $request->priority;
        $ticket->project = $request->project;
        $ticket->comments = $request->description;
        $ticket->privacy = $request->privacy;
        $ticket->comments = $request->assignedTo;
        $ticket->end_date = $request->dueDate;
        $ticket->department = $request->department;
        $ticket->created_by = Auth::id();
        $ticket->last_updated_by = Auth::id();
        $ticket->last_modified_on = now();
        $ticket->team_members = "";
        $ticket->flag_to = "";
        $ticket->status =  $request->status;
        $ticket->status =  1;
        $ticket->start_date =  now();
        $ticket->created_on =  now();
        $ticket->is_client =  0;
        $ticket->email_cc_list =  "";
        $ticket->ip_address =  "";
        $ticket->flag_to = $request->assignedTo;
        $ticket->attachment=$fileName;
        

        // Handle file upload for attachment
        // if ($request->hasFile('attachment')) {
        //     $fileName = time() . '_' . $request->attachment->getClientOriginalName();
        //     $filePath = $request->attachment->storeAs('images/ticket_attachments', $fileName, 'public');

        //     // Store the file path in the database
        //     $ticket->attachment = $filePath;
        // }

        // Save the ticket
        $ticket->save();

        // Redirect back with a success message
        return redirect()->back()->withFlashSuccess(__('The ticket was successfully created.'));
    }


    // EDIT SINGLE TICKET INFORMATION - AUTH - SK - 13-03-2025
    public function edit($id)
    {
        $ticket = Ticket::findOrFail($id); // Fetch the client by ID
       // dd($ticket);
        return response()->json($ticket); // Return client data as JSON
    }

    // UPDATE SINGLE TICKET INFORMATION - AUTH - SK - 13-03-2025
    public function update(Request $request, $id) 
    {
        // Validate the request data
        // $request->validate([
        //     'client' => 'required|string|max:200',
        //     'title' => 'required|string|max:500',
        //     'domain' => 'nullable|string',
        //     'type' => 'required|string',
        //     'source' => 'required|string',
        //     'priority' => 'required|integer',
        //     'project' => 'nullable|string',
        //     'description' => 'required|string',
        //     'privacy' => 'required|integer',
        //     'assignedTo' => 'required|string',
        //     'dueDate' => 'required|date',
        //     'department' => 'required|string',
        //     'attachment' => 'nullable|file|mimes:jpeg,png,jpg,pdf,doc,docx|max:2048',
        // ]);

       
        // Find the existing ticket
        $ticket = Ticket::findOrFail($id);

        // Update ticket details
        $ticket->client = $request->t_client;
        $ticket->title = $request->t_title;
        $ticket->domain = $request->t_domain;
        $ticket->type = $request->t_tag;
        $ticket->source = $request->t_source;
        $ticket->priority = $request->t_priority;
        $ticket->project = $request->t_project;
        $ticket->comments = $request->t_description;
        $ticket->privacy = $request->t_privacy;
        $ticket->flag_to = $request->t_assignedTo;
        $ticket->end_date = $request->t_dueDate;
        $ticket->department = $request->t_department;
        $ticket->last_updated_by = Auth::id();
        $ticket->last_modified_on = now();

        if ($request->hasFile('t_attachment')) {
            $folderPath = public_path('images/ticket_attachments'); // Path to store files in public folder
        
            // Ensure the folder exists, create if not
            if (!File::exists($folderPath)) {
                File::makeDirectory($folderPath, 0775, true, true);
            }
        
            // Generate a unique file name
            $fileName = time() . '_' . $request->file('t_attachment')->getClientOriginalName();
        
            // Move the file to the target folder
            $request->file('t_attachment')->move($folderPath, $fileName);
        
            // Delete old file if exists
            if (!empty($ticket->attachment) && File::exists(public_path('images/ticket_attachments/'.$ticket->attachment))) {
                File::delete(public_path('images/ticket_attachments/'.$ticket->attachment));
            }
        
            // Store the new file path in the database
            $ticket->attachment = $fileName;
        }


        // Save the updated ticket
        $ticket->save();

        // Redirect back with a success message
        return redirect()->back()->withFlashSuccess(__('The ticket was successfully updated.'));
    }


    // DELETE SINGLE TICKET INFORMATION - AUTH - SK - 13-03-2025
    public function destroy($id)
    {
        $ticket = Ticket::findOrFail($id); // Find the client by ID
        $ticket->delete(); // Delete the ticket

        return response()->json(['success' => true, 'message' => 'Ticket deleted successfully.']);
    }


    // SAVE SINGLE TICKET DISCUSSION  - AUTH - SK  14-03-2025
    public function storeTicketDiscussion(Request $request)
    {
        //dd($request->all());
        // Uncomment and fix validation
        $validated = $request->validate([
            'comments' => 'required|string',
            'ticket_id' => 'required|exists:isar_tickets,id',
            'attachment' => 'nullable|file|max:2048',
        ]);
    
        // Handle file upload
        $attachmentPath = null;
        if ($request->hasFile('attachment')) {
            $attachmentPath = $request->file('attachment')->store('attachments', 'public');
        }

        if(!empty($request->assignedTo))
        {
            $ticket = Ticket::findOrFail($validated['ticket_id']);
            $ticket->flag_to = $request->assignedTo;
    
            // Save the updated ticket
            $ticket->save();
        }

        if(!empty($request->status))
        {
            $ticket = Ticket::findOrFail($validated['ticket_id']);
            $ticket->status = $request->status;
    
            // Save the updated ticket
            $ticket->save();
        }

        if ($request->hasFile('attachment')) {
            $folderPath = public_path('images/ticket_attachments'); // Path to store files in public folder
        
            // Ensure the folder exists, create if not
            if (!File::exists($folderPath)) {
                File::makeDirectory($folderPath, 0775, true, true);
            }
        
            // Generate a unique file name
            $fileName = time() . '_' . $request->file('attachment')->getClientOriginalName();
        
            // Move the file to the target folder
            $request->file('attachment')->move($folderPath, $fileName);
        
            // Delete old file if exists
            if (!empty($ticket->attachment) && File::exists(public_path('images/ticket_attachments/'.$ticket->attachment))) {
                File::delete(public_path('images/ticket_attachments/'.$ticket->attachment));
            }
        
            // Store the new file path in the database
            $ticket->attachment = 'images/ticket_attachments/' . $fileName;
        }else{
            $fileName="";
        }
    
        TicketComment::create([
            'user_id' => Auth::id(),
            'ticket_id' => $validated['ticket_id'],
            'comments' => $validated['comments'],
            'attahcement' => $fileName, // Match DB column name
            'created_on' => now(),
            'last_modified_on' => now(),
            'ip_address' => $request->ip(),
        ]);

       
        return redirect()->back()->withFlashSuccess(__('Comment added successfully.'));
       
    }

}
