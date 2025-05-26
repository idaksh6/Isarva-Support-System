<?php

namespace App\Http\Controllers\Backend;
use Illuminate\Http\Request;
use App\Helpers\ClientHelper;
use App\Helpers\EmployeeHelper;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

use Illuminate\Support\Facades\Storage;
use App\Models\Backend\Ticket; 
use App\Models\Backend\TicketComment;
use App\Mail\TicketAssignedNotification;
use Illuminate\Support\Facades\Mail;
use App\Models\Backend\User;
use App\Models\Backend\DailyReportField;
use App\Helpers\TicketHelper;



class TicketController
{
    //

    // public function ticketView(Request $request)
    // {
    //     // Retrieve query parameters
    //     $query = Ticket::query();

    //     if ($request->filled('q')) {
    //         $query->where(function ($q) use ($request) {
    //             $q->where('title', 'like', '%' . $request->q . '%')
    //             ->orWhere('id', 'like', '%' . $request->q . '%')
    //             ->orWhere('domain', 'like', '%' . $request->q . '%');
    //         });
    //     }

    //     if ($request->filled('month_year')) {
    //         $monthYear = explode('-', $request->month_year); // Splitting into [YYYY, MM]
    //         if (count($monthYear) == 2) {
    //             $query->whereYear('created_at', $monthYear[0])
    //                 ->whereMonth('created_at', $monthYear[1]);
    //         }
    //     }

    //     if ($request->filled('assignedTo')) {
    //         $query->where('flag_to', $request->assignedTo);
    //     }

    //     if ($request->filled('department')) {
    //         $query->where('department', $request->department);
    //     }

    //     if ($request->filled('priority')) {
    //         $query->where('priority', $request->priority);
    //     }

    //     if ($request->filled('status')) {
    //         $query->where('status', $request->status);
    //     }

    //     // Fetch filtered tickets
    //     $tickets = $query->get();

    //     // Get supporting data
    //     $clients = ClientHelper::getClientNames();
    //     $projects = ClientHelper::getProjects();
    //     $employees = ClientHelper::getEmployees();
    //     $status = ClientHelper::TicketStatus();
    //     $department=ClientHelper::Departments();
    //     $priority=ClientHelper::Priority();
        

    //     // Pass the filtered tickets to the view
    //     return view('backend.tickets.ticket-view', [
    //         'tickets' => $tickets,
    //         'clients' => $clients,
    //         'projects' => $projects,
    //         'employees' => $employees,
    //         'status' => $status,
    //         'department'=>$department,
    //         'priority'=>$priority,
            
    //     ]);
    // }

    // public function ticketView(Request $request)
    // {
    //     // Start with base query
    //     $query = Ticket::query();
        
    //     // Get current user info
    //     $user = Auth::user();
    //     $userId = $user->id;
        
    //     // Apply role-based filtering
    //     // if ($user->role != 1) { // If not admin
    //     //     $query->where('flag_to', $userId);
    //     // }
    //       // Apply role-based filtering
    // if ($user->role != 1) { // If not admin
    //     $query->where(function($q) use ($userId) {
    //         $q->where('flag_to', $userId)
    //           ->orWhere('team_members', 'LIKE', '%,'.$userId.',%')
    //           ->orWhere('team_members', 'LIKE', $userId.',%')
    //           ->orWhere('team_members', 'LIKE', '%,'.$userId)
    //           ->orWhere('team_members', '=', $userId);
    //     });
    // }

    //     // Apply search filters
    //     if ($request->filled('q')) {
    //         $query->where(function ($q) use ($request) {
    //             $q->where('title', 'like', '%' . $request->q . '%')
    //             ->orWhere('id', 'like', '%' . $request->q . '%')
    //             ->orWhere('domain', 'like', '%' . $request->q . '%');
    //         });
    //     }

    //     if ($request->filled('month_year')) {
    //         $monthYear = explode('-', $request->month_year);
    //         if (count($monthYear) == 2) {
    //             $query->whereYear('created_at', $monthYear[0])
    //                 ->whereMonth('created_at', $monthYear[1]);
    //         }
    //     }

    //     if ($request->filled('assignedTo')) {
    //         $query->where('flag_to', $request->assignedTo);
    //     }

    //     if ($request->filled('department')) {
    //         $query->where('department', $request->department);
    //     }

    //     if ($request->filled('priority')) {
    //         $query->where('priority', $request->priority);
    //     }

    //     if ($request->filled('status')) {
    //         $query->where('status', $request->status);
    //     }

    //     // Fetch filtered tickets
    //     $tickets = $query->get();

    //     // Get supporting data
    //     $clients = ClientHelper::getClientNames();
    //     $projects = ClientHelper::getProjects();
    //     $employees = ClientHelper::getEmployees();
    //     $status = ClientHelper::TicketStatus();
    //     $department = ClientHelper::Departments();
    //     $priority = ClientHelper::Priority();

    //     return view('backend.tickets.ticket-view', [
    //         'tickets' => $tickets,
    //         'clients' => $clients,
    //         'projects' => $projects,
    //         'employees' => $employees,
    //         'status' => $status,
    //         'department' => $department,
    //         'priority' => $priority,
    //     ]);
    // }
    public function ticketView(Request $request)
    {
        // Start with base query
        $query = Ticket::query();
        
        // Get current user info
        $user = Auth::user();
        $userId = $user->id;
        
        // Apply role-based filtering
    
        // if ($user->role != 1) { // If not admin
        //     $query->where(function($q) use ($userId) {
        //         $q->where('flag_to', $userId)
        //         ->orWhereRaw("CONCAT(',', team_members, ',') LIKE ?", ['%,' . $userId . ',%']);
        //     });
        // }
          
    //     if ($user->role != 1) {
    //     $query->where(function($q) use ($userId) {
    //         $q->where('flag_to', $userId)
    //         ->orWhereRaw("CONCAT(',', team_members, ',') LIKE ?", ['%,' . $userId . ',%'])
    //         ->orWhereExists(function($subQuery) use ($userId) {
    //             $subQuery->select(DB::raw(1))
    //                     ->from('isar_ticket_discusion')
    //                     ->whereRaw('isar_ticket_discusion.ticket_id = isar_tickets.id')
    //                     ->whereRaw("CONCAT(',', assigned_to, ',') LIKE ?", ['%,' . $userId . ',%']);
    //         });
    //     });
    // }

            if ($user->role != 1) {
            $query->where(function($q) use ($userId) {
                $q->where('flag_to', $userId)
                ->orWhereRaw("CONCAT(',', team_members, ',') LIKE ?", ['%,' . $userId . ',%'])
                ->orWhereExists(function($subQuery) use ($userId) {
                    $subQuery->select(DB::raw(1))
                        ->from('isar_ticket_discusion as itd')
                        ->whereRaw('itd.ticket_id = isar_tickets.id')
                        ->whereRaw('itd.id = (
                            SELECT MAX(id)
                            FROM isar_ticket_discusion
                            WHERE ticket_id = isar_tickets.id
                        )')
                        ->whereRaw("CONCAT(',', assigned_to, ',') LIKE ?", ['%,' . $userId . ',%']);
                });
            });
        }


            
        // Apply search filters
        if ($request->filled('q')) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'like', '%' . $request->q . '%')
                  ->orWhere('id', 'like', '%' . $request->q . '%')
                  ->orWhere('domain', 'like', '%' . $request->q . '%');
            });
        }
    
        if ($request->filled('month_year')) {
            $monthYear = explode('-', $request->month_year);
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
                    if ($request->status == '8') { // Active status (8)
                        $query->whereNotIn('isar_tickets.status', [7]); // Not Closed (6) or On Hold (7)
                    } else{ 
                        $query->where('status', $request->status);
                }
        }

         // Add custom status ordering with creation date
        $statusOrder = [1, 2, 5, 6, 3, 4, 7];
        $query->orderByRaw(
            'FIELD(isar_tickets.status, '.implode(',', $statusOrder).')'
        )->orderBy('isar_tickets.created_at', 'desc');
           
    
        // Fetch filtered tickets
        $tickets = $query->get();
    
        // Get supporting data
        $clients = ClientHelper::getClientNames();
        $projects = ClientHelper::getProjects();
        $employees = ClientHelper::getEmployees();
        $status = ClientHelper::TicketStatus();
        $department = ClientHelper::Departments();
        $priority = ClientHelper::Priority();
    
        return view('backend.tickets.ticket-view', [
            'tickets' => $tickets,
            'clients' => $clients,
            'projects' => $projects,
            'employees' => $employees,
            'status' => $status,
            'department' => $department,
            'priority' => $priority,
        ]);
    }


    public function ticketDetail($id)
    {
        // Get ticket details
        // $ticket = DB::table('isar_tickets')
        //     ->where('id', $id)
        //     ->first();

        $ticket = DB::table('isar_tickets as t')
            ->leftJoin('users as u', 't.created_by', '=', 'u.id')
            ->where('t.id', $id)
            ->select('t.*', 'u.name as created_by_name')
            ->first();


         // Add readable type name
        if ($ticket) {
            $ticket->type_name = TicketHelper::getTypeName($ticket->type);
        }
    
        // $ticket->assigned_to_names = EmployeeHelper::getEmployeeNamesByIds($ticket->assigned_to, $employees);

        // // Get associated comments
        // $comments = DB::table('isar_ticket_discusion')
        //     ->where('ticket_id', $id)
        //     ->orderBy('created_on', 'desc')
        //     ->paginate(5);
        $comments = DB::table('isar_ticket_discusion')
        ->leftJoin('users', 'isar_ticket_discusion.user_id', '=', 'users.id')
        ->where('isar_ticket_discusion.ticket_id', $id)
        ->select('isar_ticket_discusion.*', 'users.name as user_name')
        ->orderBy('isar_ticket_discusion.created_on', 'desc')
        ->paginate(5);

    
        // Get user details for comments (if needed)
        $commentsWithUsers = DB::table('isar_ticket_discusion')
            ->where('ticket_id', $id)
            ->join('users', 'isar_ticket_discusion.user_id', '=', 'users.id')
            ->select('isar_ticket_discusion.*', 'users.name as user_name')
            ->get();
        
        $employees=ClientHelper::getEmployees();
       $ticket->assigned_to_names = EmployeeHelper::getEmployeeNamesByIds($ticket->team_members, $employees);

        $status=ClientHelper::TicketStatus();

        $billableStats = DailyReportField::getTicketBillableStats($id);

        $latestComment = DB::table('isar_ticket_discusion')
        ->where('ticket_id', $id)
        ->orderBy('created_on', 'desc')
        ->first(); // or ->latest('created_on')->first()

       


        return view('backend.tickets.ticket-detail', [
            'ticket' => $ticket,
            'comments' => $comments,
            'commentsWithUsers' => $commentsWithUsers, // choose one approach
            'id' => $id,
            'employees'=>$employees,
            'status'=>$status,
            'billableStats' => $billableStats,
             'ticketComment' => $latestComment, 
          
        ]);
    }

      /** Store the Ticket Information - Author SK - 11-03-2025 */
    //   public function store(Request $request)
    // {
        
    //     // Validate the request data
    //     // $request->validate([
    //     //     'client' => 'required|string|max:200',
    //     //     'title' => 'required|string|max:500',
    //     //     'domain' => 'nullable|string',
    //     //     'type' => 'required|string',
    //     //     'source' => 'required|string',
    //     //     'priority' => 'required|integer',
    //     //     'project' => 'nullable|string',
    //     //     'description' => 'required|string',
    //     //     'privacy' => 'required|integer',
    //     //     'assignedTo' => 'required|string',
    //     //     'dueDate' => 'required|date',
    //     //     'department' => 'required|string',
    //     //     'attachment' => 'nullable|file|mimes:jpeg,png,jpg,pdf,doc,docx|max:2048',
    //     // ]);

    //     // Create a new Ticket instance
    //     $ticket = new Ticket();

    //     if ($request->hasFile('attachment')) {
    //         $folderPath = public_path('images/ticket_attachments'); // Path to store files in public folder
        
    //         // Ensure the folder exists, create if not
    //         if (!File::exists($folderPath)) {
    //             File::makeDirectory($folderPath, 0775, true, true);
    //         }
        
    //         // Generate a unique file name
    //         $fileName = time() . '_' . $request->file('attachment')->getClientOriginalName();
        
    //         // Move the file to the target folder
    //         $request->file('attachment')->move($folderPath, $fileName);
        
    //         // Delete old file if exists
    //         if (!empty($ticket->attachment) && File::exists(public_path('images/ticket_attachments/'.$ticket->attachment))) {
    //             File::delete(public_path('images/ticket_attachments/'.$ticket->attachment));
    //         }
        
    //         // Store the new file path in the database
    //         $ticket->attachment = 'images/ticket_attachments/' . $fileName;
    //     }else{
    //         $fileName="";
    //     }

    //     $ticket->client = $request->client;
    //     $ticket->title = $request->title;
    //     $ticket->domain = $request->domain;
    //     $ticket->type = $request->tag;
    //     $ticket->source = $request->source;
    //     $ticket->priority = $request->priority;
    //     $ticket->project = $request->project;
    //     $ticket->comments = $request->description;
    //     $ticket->privacy = $request->privacy;
    //     $ticket->comments = $request->assignedTo;
    //     $ticket->end_date = $request->dueDate;
    //     $ticket->department = $request->department;
    //     $ticket->created_by = Auth::id();
    //     $ticket->last_updated_by = Auth::id();
    //     $ticket->last_modified_on = now();
    //     $ticket->team_members = "";
    //     $ticket->flag_to = "";
    //     $ticket->status =  $request->status;
    //     $ticket->status =  1;
    //     $ticket->start_date =  now();
    //     $ticket->created_on =  now();
    //     $ticket->is_client =  0;
    //     $ticket->email_cc_list =  "";
    //     $ticket->ip_address =  "";
    //     $ticket->flag_to = $request->assignedTo;
    //     $ticket->attachment=$fileName;
        

    //     // Handle file upload for attachment
    //     // if ($request->hasFile('attachment')) {
    //     //     $fileName = time() . '_' . $request->attachment->getClientOriginalName();
    //     //     $filePath = $request->attachment->storeAs('images/ticket_attachments', $fileName, 'public');

    //     //     // Store the file path in the database
    //     //     $ticket->attachment = $filePath;
    //     // }

    //     // Save the ticket
    //     $ticket->save();

    //     // Redirect back with a success message
    //     return redirect()->back()->withFlashSuccess(__('The ticket was successfully created.'));
    // }

    public function store(Request $request)
    {

        
    $validated = $request->validate([
       'client' => 'required',
        'title' => 'required|string|max:500',
        'priority' => 'required',
        'description' => 'required',
        'privacy' => 'required',
        'assignedTo' => 'nullable|exists:users,id',
        'teamMembers' => 'required|array',
        'teamMembers.*' => 'exists:users,id',
        'dueDate' => 'required|date',
        'department' => 'required',
    ], [
        'client.required' => 'The client field is required.',
        'title.required' => 'The title field is required.',
        'priority.required' => 'The priority field is required.',
        'description.required' => 'The description field is required.',
        'privacy.required' => 'The privacy field is required.',
        // 'assignedTo.required' => 'The assigned to field is required.',
        'teamMembers.required' => 'Please select at least one team member.',
        'dueDate.required' => 'The due date field is required.',
        'department.required' => 'The department field is required.',
    ]);
        // Create a new Ticket instance
        $ticket = new Ticket();

        // Handle file upload
        $fileName = null;
        if ($request->hasFile('attachment')) {
            $folderPath = public_path('images/ticket_attachments');
            
            if (!File::exists($folderPath)) {
                File::makeDirectory($folderPath, 0775, true, true);
            }
            
            $fileName = time() . '_' . $request->file('attachment')->getClientOriginalName();
            $request->file('attachment')->move($folderPath, $fileName);
        }

        // Set ticket properties
        $ticket->client = $request->client;
        $ticket->title = $request->title;
        $ticket->domain = $request->domain;
        $ticket->type = $request->tag;
        $ticket->source = $request->source;
        $ticket->priority = $request->priority;
        $ticket->project = $request->project;
        $ticket->comments = $request->description;
        $ticket->privacy = $request->privacy;
        $ticket->end_date = $request->dueDate;
        $ticket->department = $request->department;
        $ticket->created_by = Auth::id();
        $ticket->last_updated_by = Auth::id();
        $ticket->last_modified_on = now();
        // $ticket->team_members = $request->teamMembers ? implode(',', $request->teamMembers) : null; // Comma-separated string
        $ticket->team_members = $request->teamMembers ? implode(',', $request->teamMembers) : null;
        

        // $ticket->flag_to = $request->assignedTo; // This is the assigned user ID
      
      
        $ticket->status = 1;
        $ticket->start_date = now();
        $ticket->created_on = now();
        $ticket->is_client = 0;
        $ticket->email_cc_list = "";
        $ticket->ip_address = "";
        $ticket->attachment = $fileName;

        // Save the ticket
        $ticket->save();

        // Get the logged in user and assigned user
        // $loggedInUser = Auth::user();
        // $assignedUser = User::find($request->assignedTo);

        // // Send email notification to assigned user
        // if ($assignedUser) {
        //     Mail::to($assignedUser->email)->send(
        //         new TicketAssignedNotification(
        //             $ticket->id,
        //             $ticket->title,
        //             $loggedInUser->name,
        //             $assignedUser->email
        //         )
        //     );
        // }



        
        // Email section 
        $loggedInUser = Auth::user();

        // teamMembers is an array of user IDs already validated
        $teamMemberIds = $request->teamMembers;

        // Fetch all users by those IDs
        $teamMembers = User::whereIn('id', $teamMemberIds)->get();

        // Send email to each team member
        foreach ($teamMembers as $member) {
            Mail::to($member->email)->send(
                new TicketAssignedNotification(
                    $ticket->id,
                    $ticket->title,
                    $loggedInUser->name,
                    $member->email
                )
            );
        }

           // Return a response
           if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Ticket created successfully!'
            ]);
        }
        
        return redirect()->back()->withFlashSuccess(__('The ticket was successfully created.'));
        

        // Redirect back with a success message
        // return redirect()->back()->withFlashSuccess(__('The ticket was successfully created.'));
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
        $validated = $request->validate([
            't_client' => 'required|exists:isar_clients,id', // Assuming clients is your table
            't_title' => 'required|string|max:500',
            't_domain' => 'nullable|string|max:255',
            't_tag' => 'required|integer|between:1,7',
            't_source' => 'required|integer|between:1,6',
            't_priority' => 'required|integer|between:1,3',
            't_project' => 'nullable|exists:si_projects,id', // Assuming projects is your table
            't_description' => 'required|string',
            't_privacy' => 'required|integer|between:1,2',
            // 't_assignedTo' => 'nullable|exists:users,id',
            't_teamMembers' => 'required|array',
            't_teamMembers.*' => 'exists:users,id',
            't_dueDate' => 'required|date|after_or_equal:today',
            't_department' => 'required|integer|between:1,4',
            't_attachment' => 'nullable|file|mimes:jpg,jpeg,png,pdf,doc,docx|max:2048',
        ], [
            't_client.required' => 'The client field is required.',
            't_client.exists' => 'The selected client is invalid.',
            't_title.required' => 'The title field is required.',
            't_title.max' => 'The title may not be greater than 500 characters.',
            't_tag.required' => 'The tag field is required.',
            't_tag.between' => 'The selected tag is invalid.',
            't_source.required' => 'The source field is required.',
            't_source.between' => 'The selected source is invalid.',
            't_priority.required' => 'The priority field is required.',
            't_priority.between' => 'The selected priority is invalid.',
            't_project.exists' => 'The selected project is invalid.',
            't_description.required' => 'The description field is required.',
            't_privacy.required' => 'The privacy field is required.',
            't_privacy.between' => 'The selected privacy option is invalid.',
            // 't_assignedTo.required' => 'The assigned to field is required.',
            't_assignedTo.exists' => 'The selected assigned user is invalid.',
            't_teamMembers.required' => 'Please select at least one team member.',
            't_teamMembers.*.exists' => 'One or more selected team members are invalid.',
            't_dueDate.required' => 'The due date field is required.',
            't_dueDate.after_or_equal' => 'The due date must be today or in the future.',
            't_department.required' => 'The department field is required.',
            't_department.between' => 'The selected department is invalid.',
            't_attachment.mimes' => 'The attachment must be a file of type: jpg, jpeg, png, pdf, doc, docx.',
            't_attachment.max' => 'The attachment may not be greater than 2MB.',
        ]);
    
       
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
        // $ticket->flag_to = $request->t_assignedTo;
        // $ticket->team_members = $request->t_teamMembers ? implode(',', $request->t_teamMembers) : null; // Only implode if array exists
     
        $ticket->team_members = $request->t_teamMembers ? implode(',', $request->t_teamMembers) : null;
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


         // Send email to team members
        // $loggedInUser = Auth::user();
        // $teamMemberIds = $request->teamMembers;
        // $teamMembers = User::whereIn('id', $teamMemberIds)->get();

        // foreach ($teamMembers as $member) {
        //     Mail::to($member->email)->send(
        //         new TicketAssignedNotification(
        //             $ticket->id,
        //             $ticket->title,
        //             $loggedInUser->name,
        //             $member->email
        //         )
        //     );
        // }

        // Email integration part
        $loggedInUser = Auth::user();

        // Handle string like "1,2,3" => convert to array
        $teamMemberIds = explode(',', $request->teamMembers);
        
        // Optional: filter non-numeric values to be safe
        $teamMemberIds = array_filter($teamMemberIds, fn($id) => is_numeric($id));
        
        // Fetch team members
        $teamMembers = User::whereIn('id', $teamMemberIds)->get();
        
        // Send email to each member
        foreach ($teamMembers as $member) {
            Mail::to($member->email)->send(
                new TicketAssignedNotification(
                    $ticket->id,
                    $ticket->title,
                    $loggedInUser->name,
                    $member->email
                )
            );
        }

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


    // public function storeTicketDiscussion(Request $request)
    // {
    //     //dd($request->all());
    //     // Uncomment and fix validation
    //     $validated = $request->validate([
    //         'comments' => 'required|string',
    //         'ticket_id' => 'required|exists:isar_tickets,id',
    //         'attachment' => 'nullable|file|max:2048',
    //     ]);
    
    //     // Handle file upload
    //     $attachmentPath = null;
    //     if ($request->hasFile('attachment')) {
    //         $attachmentPath = $request->file('attachment')->store('attachments', 'public');
    //     }

    //     if(!empty($request->assignedTo))
    //     {
    //         $ticket = Ticket::findOrFail($validated['ticket_id']);
    //         $ticket->flag_to = $request->assignedTo;
    
    //         // Save the updated ticket
    //         $ticket->save();
    //     }

    //     if(!empty($request->status))
    //     {
    //         $ticket = Ticket::findOrFail($validated['ticket_id']);
    //         $ticket->status = $request->status;
    
    //         // Save the updated ticket
    //         $ticket->save();
    //     }

    //     if ($request->hasFile('attachment')) {
    //         $folderPath = public_path('images/ticket_attachments'); // Path to store files in public folder
        
    //         // Ensure the folder exists, create if not
    //         if (!File::exists($folderPath)) {
    //             File::makeDirectory($folderPath, 0775, true, true);
    //         }
        
    //         // Generate a unique file name
    //         $fileName = time() . '_' . $request->file('attachment')->getClientOriginalName();
        
    //         // Move the file to the target folder
    //         $request->file('attachment')->move($folderPath, $fileName);
        
    //         // Delete old file if exists
    //         if (!empty($ticket->attachment) && File::exists(public_path('images/ticket_attachments/'.$ticket->attachment))) {
    //             File::delete(public_path('images/ticket_attachments/'.$ticket->attachment));
    //         }
        
    //         // Store the new file path in the database
    //         $ticket->attachment = 'images/ticket_attachments/' . $fileName;
    //     }else{
    //         $fileName="";
    //     }
    
    //     TicketComment::create([
    //         'user_id' => Auth::id(),
    //         'ticket_id' => $validated['ticket_id'],
    //         'comments' => $validated['comments'],
    //         'attahcement' => $fileName, // Match DB column name
    //         'created_on' => now(),
    //         'last_modified_on' => now(),
    //         'ip_address' => $request->ip(),
    //     ]);

       
    //     return redirect()->back()->withFlashSuccess(__('Comment added successfully.'));
       
    // }


     // SAVE SINGLE TICKET DISCUSSION  - AUTH - SK  14-03-2025
    // public function storeTicketDiscussion(Request $request)
    // {
    //     $validated = $request->validate([
    //         'comments' => 'required|string',
    //         'ticket_id' => 'required|exists:isar_tickets,id',
    //         'attachment' => 'nullable|file|max:2048',
    //     ]);

    //     // Handle file upload
    //     $attachmentPath = null;
    //     if ($request->hasFile('attachment')) {
    //         $attachmentPath = $request->file('attachment')->store('attachments', 'public');
    //     }

    //     $ticket = Ticket::findOrFail($validated['ticket_id']);
    //     $loggedInUser = Auth::user();

    //     // Fetch latest status directly from DB
    //     $currentStatus = DB::table('isar_tickets')->where('id', $ticket->id)->value('status');

    //     // Update assignedTo if provided
    //     if (!empty($request->assignedTo)) {
    //         $ticket->flag_to = $request->assignedTo;  // Save assigned user
    //         $ticket->save();

    //         // Get assigned user details
    //         $assignedUser = User::find($request->assignedTo);

    //        // Send email notification **only if status = 5**
    //         if ($assignedUser && $currentStatus == 5) {
    //             Mail::to($assignedUser->email)->send(
    //                 new TicketAssignedNotification(
    //                     $ticket->id,
    //                     $ticket->title,
    //                     $loggedInUser->name,
    //                     $assignedUser->email
    //                 )
    //             );
    //         }
    //     }

    //     // Update status if provided
    //     if (!empty($request->status)) {
    //         $ticket->status = $request->status;
    //         $ticket->save();
    //     }

    //     // Handle attachment
    //     $fileName = null;
    //     if ($request->hasFile('attachment')) {
    //         $folderPath = public_path('images/ticket_attachments');
            
    //         if (!File::exists($folderPath)) {
    //             File::makeDirectory($folderPath, 0775, true, true);
    //         }
            
    //         $fileName = time() . '_' . $request->file('attachment')->getClientOriginalName();
    //         $request->file('attachment')->move($folderPath, $fileName);
    //     }

    //     // Create comment
    //     TicketComment::create([
    //         'user_id' => $loggedInUser->id,
    //         'ticket_id' => $validated['ticket_id'],
    //         'comments' => $validated['comments'],
    //         'attahcement' => $fileName,
    //         'created_on' => now(),
    //         'last_modified_on' => now(),
    //         'ip_address' => $request->ip(),
    //     ]);

    //     return redirect()->back()->withFlashSuccess(__('Comment added successfully.'));
    // }

       public function storeTicketDiscussion(Request $request)
        {
            $validated = $request->validate([
                'comments' => 'required|string',
                'ticket_id' => 'required|exists:isar_tickets,id',
                'attachment' => 'nullable|file|max:2048',
                'teamMembers' => 'nullable|array',
                'teamMembers.*' => 'exists:users,id',
            ]);

            try {
                // Handle file upload
                $fileName = null;
                if ($request->hasFile('attachment')) {
                    $folderPath = public_path('images/ticket_attachments');
                    File::ensureDirectoryExists($folderPath, 0775, true);
                    $fileName = time() . '_' . $request->file('attachment')->getClientOriginalName();
                    $request->file('attachment')->move($folderPath, $fileName);
                }

                $ticket = Ticket::findOrFail($validated['ticket_id']);
                $loggedInUser = Auth::user();
                $sendEmail = false;
                $assignedUser = null;

                // Store original values
                $originalStatus = $ticket->status;
                $originalAssignedTo = $ticket->flag_to;
                $originalTeamMembers = $ticket->team_members ? explode(',', $ticket->team_members) : [];

                // Update status if provided
                if ($request->has('status')) {
                    $ticket->status = $request->status;
                }

                // Update assignedTo if provided
                if ($request->has('assignedTo')) {
                    $newAssigneeId = $request->assignedTo;
                    $ticket->flag_to = $newAssigneeId;
                    $assignedUser = User::find($newAssigneeId);

                    if ($assignedUser && $ticket->status == 5 && $originalAssignedTo != $newAssigneeId) {
                        $sendEmail = true;
                    }
                }

                // Handle team members update and email notification
                $newTeamMembers = $request->teamMembers ?? [];
                $newMembersToNotify = [];

                if (!empty($newTeamMembers)) {
                    // Update ticket's team members
                    $ticket->team_members = implode(',', $newTeamMembers);
                    
                    // Find new members who weren't previously assigned
                    $newMembersToNotify = array_diff($newTeamMembers, $originalTeamMembers);
                }

                // Save ticket if changed
                if ($ticket->isDirty()) {
                    $ticket->save();
                }

                // Send email if conditions met for flagged to
                if ($sendEmail) {
                    Mail::to($assignedUser->email)->queue(
                        new TicketAssignedNotification(
                            $ticket->id,
                            $ticket->title,
                            $loggedInUser->name,
                            $assignedUser->email
                        )
                    );
                }

                // Send emails to newly added team members
                if (!empty($newMembersToNotify)) {
                    $newMembers = User::whereIn('id', $newMembersToNotify)->get();
                    
                    foreach ($newMembers as $member) {
                        Mail::to($member->email)->queue(
                            new TicketAssignedNotification(
                                $ticket->id,
                                $ticket->title,
                                $loggedInUser->name,
                                $member->email
                            )
                        );
                    }
                }

                // Create comment - don't store team members here anymore
                TicketComment::create([
                    'user_id' => $loggedInUser->id,
                    'ticket_id' => $validated['ticket_id'],
                    'comments' => $validated['comments'],
                    'attahcement' => $fileName,
                    'created_on' => now(),
                    'last_modified_on' => now(),
                    'ip_address' => $request->ip(),
                ]);

                return redirect()->back()->withFlashSuccess(__('Comment added successfully.'));

            } catch (\Exception $e) {
                return redirect()->back()->withFlashError(__('An error occurred. Please try again.'));
            }
        }

 
}
