<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Backend\Project;
use App\Models\Backend\Task;
use App\Models\Backend\DailyReport;
use App\Models\Backend\DailyReportField;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\DailyReportEmail;
use App\Mail\DailyReportMail;
use App\Models\Backend\Ticket;
use Carbon\Carbon;

class DailyReportController extends Controller
{
   
    // public function index()
    // {
    //     $user = Auth::user();
        
    //     // Check if user has pending tickets (status 1, 2, or 3)
    //     $pendingTickets = Ticket::where('flag_to', $user->id)
    //         ->whereIn('status', [1, 3])
    //         ->get();
        
    //     if ($pendingTickets->isNotEmpty() && $user->role != 1) { // Skip check for admin (role=1)
    //         return view('backend.daily_report.restricted', [
    //             'pendingTickets' => $pendingTickets
    //         ]);
    //     }
        
    //     return view('backend.daily_report.dailyreport');
    // }

    public function index()
    {
        $user = Auth::user();

        // Check if user has pending tickets (status 1, 2, or 3)
        $pendingTickets = Ticket::whereIn('status', [1, 3])->get();
    
        $restrictedTickets = collect();
    
        foreach ($pendingTickets as $ticket) {
            $flagTo = $ticket->flag_to;
            $teamMembers = explode(',', $ticket->team_members ?? '');
    
            // Rule 1: If flag_to is NULL → restrict all team_members
            if (is_null($flagTo) && in_array($user->id, $teamMembers)) {
                $restrictedTickets->push($ticket);
            }
    
            // Rule 2: If flag_to is not null → restrict only that person
            if (!is_null($flagTo) && $user->id == $flagTo) {
                $restrictedTickets->push($ticket);
            }
        }
    
        // for admin no restriction
        if ($restrictedTickets->isNotEmpty() && $user->role != 1) {
            return view('backend.daily_report.restricted', [
                'pendingTickets' => $restrictedTickets
            ]);
        }
    
        return view('backend.daily_report.dailyreport');
    }
    
  
    // Project Name search function
    public function search($term = null)
    {
        $userId = Auth::id(); // Get logged-in user ID

        if ($term) {
            $projects = Project::where('project_name', 'like', '%' . $term . '%')
                ->where(function($query) use ($userId) {
                    $query->where('manager', $userId) // User is manager
                        ->orWhere('team_leader', $userId) // User is team leader
                        ->orWhere(function($q) use ($userId) {
                            // Handle comma-separated team members
                            $q->where('team_members', 'like', $userId.',%') // Starts with user ID
                            ->orWhere('team_members', 'like', '%,'.$userId.',%') // User ID in middle
                            ->orWhere('team_members', 'like', '%,'.$userId) // Ends with user ID
                            ->orWhere('team_members', $userId); // Only user ID
                        });
                })
                ->select('id', 'project_name as label')
                ->get();
        } else {
            $projects = []; // Return an empty array if no term is provided
        }

        return response()->json($projects);
    }
       
        // Task name search function
        public function searchTasks(Request $request)
        {
            $term = $request->input('term');
            $projectId = $request->input('project_id');
            $userId = Auth::id(); // Get logged-in user ID
        
            if ($term && $projectId) {
                $tasks = Task::where('task_name', 'like', '%' . $term . '%')
                    ->where('project_id', $projectId)
                    ->where('assigned_to', $userId) // Only tasks assigned to current user
                    ->select('id', 'task_name as label')
                    ->get();
            } else {
                $tasks = [];
            }
        
            return response()->json($tasks);
        }
   
  
 
    // public function searchTickets(Request $request)
    // {
    //     $term = $request->input('term');
    //     $userId = Auth::id(); // Get logged-in user ID
    
    //     if ($term) {
    //         $tickets = Ticket::where('title', 'like', '%' . $term . '%')
    //             ->where(function($query) use ($userId) {
    //                 $query->where('flag_to', $userId)
    //                     ->orWhereNull('flag_to')
    //                     ->orWhereRaw("FIND_IN_SET(?, team_members)", [$userId]);
    //             })
    //             ->select('id', 'title as label')
    //             ->get()
    //             ->toArray();
    //     } else {
    //         $tickets = [];
    //     }
    
    //     return response()->json($tickets);
    // }

    public function searchTickets(Request $request)
    {
        $term = $request->input('term');
        $userId = Auth::id(); // Logged-in user ID
        $userRole = Auth::user()->role; // Assuming 'role' is 1 = Admin

        if ($term) {
            $tickets = Ticket::where('title', 'like', '%' . $term . '%')
                ->where(function($query) use ($userId, $userRole) {
                    $query->where('flag_to', $userId)
                        ->orWhereRaw("FIND_IN_SET(?, team_members)", [$userId]);

                    if ($userRole == 1) {
                        $query->orWhereNull('flag_to'); // Only Admin sees NULL flagged tickets
                    }
                })
                ->select('id', 'title as label')
                ->get()
                ->toArray();
        } else {
            $tickets = [];
        }

        return response()->json($tickets);
    }

    
   

    // public function store(Request $request)
    // {

    //    // Get user data
    //     $user = Auth::user();
    //     $userEmail = $user->email;
    //     $userName = $user->name;
    //     $mainRecipient = 'web.b4@isarva.in';

    //    // Check if user already submitted a report today
    //     $alreadySubmitted = DailyReport::where('user_id', $user->id)
    //     ->whereDate('created_at', Carbon::today())
    //     ->exists();

    //     if ($alreadySubmitted) {
    //         return redirect()->back()->withErrors(['You can only submit one daily report per day.']);
    //     }

    //     // Base validation rules
    //     $request->validate([
    //         'type' => 'required|array|min:1',
    //         'type.*' => 'required|integer|in:1,2',
    //         'comments' => 'required|array',
    //         'comments.*' => 'required|string',
    //         'hrs' => 'required|array|min:1',
    //         'hrs.*' => 'required|numeric',
    //         'link' => 'nullable|array',
    //         'link.*' => 'nullable|url',
    //         'billable' => 'required|array|min:1',
    //         'billable.*' => 'required|integer|in:0,1,2',
    //         'total_hrs' => 'required|numeric',
    //         'overall_status' => 'required|string|max:500',
    //         // 'creation_date' => 'required|date',
        
    //         // Make all fields nullable by default
    //         'project_name.*' => 'nullable|string|max:255',
    //         'project_id.*' => 'nullable|integer',
    //         'task_name.*' => 'nullable|string|max:255',
    //         'task_id.*' => 'nullable|integer',
    //         'ticket-name.*' => 'nullable|string|max:255',
    //         'ticket_id.*' => 'nullable|integer',
          
    //     ], [
    //         'type.required' => 'You must select at least one type.',
    //         'type.*.required' => 'Each type is required.',
    //         'type.*.integer' => 'Type must be an integer.',
    //         'type.*.in' => 'Invalid type selected.',
        
    //         'comments.required' => 'Comments are required.',
    //         'comments.*.required' => 'Each comment field is required.',
    //         'comments.*.string' => 'Each comment must be a valid text.',
        
    //         'hrs.required' => 'Hours field is required.',
    //         'hrs.*.required' => 'Each hour field is required.',
    //         'hrs.*.numeric' => 'Hours must be a numeric value.',
        
    //         'link.*.url' => 'Each link must be a valid URL.',
        
    //         'billable.required' => 'Billable status is required.',
    //         'billable.*.required' => 'Each billable field is required.',
    //         'billable.*.integer' => 'Billable must be an integer.',
    //         'billable.*.in' => 'Invalid billable option selected.',
        
    //         'total_hrs.required' => 'Total hours are required.',
    //         'total_hrs.numeric' => 'Total hours must be a numeric value.',
        
    //         'overall_status.required' => 'Overall status is required.',
    //        'overall_status.max' => 'Overall status must not exceed 500 characters.',
 
        
    //         'project_name.*.string' => 'Each project name must be a valid text.',
    //         'project_name.*.max' => 'Project name must not exceed 255 characters.',
        
    //         'project_id.*.integer' => 'Project ID must be an integer.',
        
    //         'task_name.*.string' => 'Each task name must be a valid text.',
    //         'task_name.*.max' => 'Task name must not exceed 255 characters.',
        
    //         'task_id.*.integer' => 'Task ID must be an integer.',
        
    //         'ticket-name.*.string' => 'Each ticket name must be a valid text.',
    //         'ticket-name.*.max' => 'Ticket name must not exceed 255 characters.',
        
    //         'ticket_id.*.integer' => 'Ticket ID must be an integer.',

    //         // 'creation_date.required' => 'The date of creation is required.',
    //         // 'creation_date.date' => 'The date of creation must be a valid date.',
    //     ]);
        
    //     // Manual conditional validation
    //     foreach ($request->get('type', []) as $index => $type) {
    //         if ($type == 1) { // Project
    //             Validator::make($request->all(), [
    //                 "project_name.$index" => 'required|string|max:255',
    //                 "project_id.$index" => 'required|integer|exists:si_projects,id',
    //                 "task_name.$index" => 'required|string|max:255',
    //                 "task_id.$index" => 'required|integer|exists:si_tasks,id',
    //             ], [
    //                 "project_name.$index.required" => 'The project name is required.',
    //                 "project_id.$index.required" => 'The project selection is required.',
    //                 "project_id.$index.exists" => 'Invalid project selected.',
    //                 "task_name.$index.required" => 'The task name is required.',
    //                 "task_id.$index.required" => 'The task selection is required.',
    //                 "task_id.$index.exists" => 'Invalid task selected.',
    //             ])->validate();
    //         } 
    //         elseif ($type == 2) { // Ticket
    //             Validator::make($request->all(), [
    //                 "ticket-name.$index" => 'required|string|max:255',
    //                 "ticket_id.$index" => 'required|integer|exists:isar_tickets,id',
    //             ], [
    //                 "ticket-name.$index.required" => 'The ticket name is required.',
    //                 "ticket_id.$index.required" => 'The ticket selection is required.',
    //                 "ticket_id.$index.exists" => 'Invalid ticket selected.',
    //             ])->validate();
    //         }
    //     }
    
    //     // Process container data
    //     $containerData = [];
    //     foreach ($request->get('type') as $uniqueId => $type) {
    //         $data = [
    //             'user_id' => Auth::id(),
    //             'type' => $type,
    //             'comments' => $request->get('comments')[$uniqueId],
    //             'hrs' => $request->get('hrs')[$uniqueId],
    //             'link' => $request->get('link')[$uniqueId] ?? null,
    //             'billable' => $request->get('billable')[$uniqueId],
    //         ];
    
    //         if ($type == 1) { // Project
    //             $data['project_name'] = $request->get('project_name')[$uniqueId];
    //             $data['task_name'] = $request->get('task_name')[$uniqueId];
    //             $data['project_id'] = $request->get('project_id')[$uniqueId];
    //             $data['task_id'] = $request->get('task_id')[$uniqueId];
    //         } 
    //         elseif ($type == 2) { // Ticket
    //             $data['project_name'] = $request->get('ticket-name')[$uniqueId];
    //             $data['task_name'] = 'Other';
    //             $data['project_id'] = $request->get('ticket_id')[$uniqueId]; // Store ticket ID in project_id
    //             $data['task_id'] = $request->get('task_id')[$uniqueId] ?? 0; // Fallback to 0 if null
    //         }
    
    //         $containerData[] = $data;
    //     }
    
    //     DB::beginTransaction();

    //     // Create the daily report with the creation date
    //     $creationDate = Carbon::parse($request->get('creation_date'));
    
    //     $dailyReport = new DailyReport();
    //     $dailyReport->user_id = Auth::id();
    //     $dailyReport->total_time = array_sum(array_column($containerData, 'hrs'));
    //     $dailyReport->overall_status = $request->get('overall_status');
    //     $dailyReport->created_by = Auth::id();
    //     $dailyReport->updated_by = Auth::id();

    //     $dailyReport->created_at = $creationDate; // Set the creation date
    //     $dailyReport->updated_at = $creationDate;
    //     $dailyReport->save();
    
    //     $dailyReportId = $dailyReport->id;
    
    //     foreach ($containerData as $data) {
    //         $dailyReportField = new DailyReportField();
    //         $dailyReportField->daily_report_id = $dailyReportId;
    //         $dailyReportField->user_id = Auth::id();
    //         $dailyReportField->type = $data['type'];
    //         $dailyReportField->project_name = $data['project_name'];
    //         $dailyReportField->task_name = $data['task_name'];
    //         $dailyReportField->comments = $data['comments'];
    //         $dailyReportField->hrs = $data['hrs'];
    //         $dailyReportField->link = $data['link'];
    //         $dailyReportField->billable_type = $data['billable'];
    //         $dailyReportField->project_id = $data['project_id'];
            
    //         // Handle task_id for tickets - set to 0 if null
    //         $dailyReportField->task_id = ($data['type'] == 2 && empty($data['task_id'])) ? 0 : $data['task_id'];
            
    //         $dailyReportField->created_by = Auth::id();
    //         $dailyReportField->updated_by = Auth::id();

    //         $dailyReportField->created_at = $creationDate; // Set the creation date
    //         $dailyReportField->updated_at = $creationDate;
    //         $dailyReportField->save();
    //     }
    
    //     DB::commit();
    
    //     // Email and redirect logic
    //     $reportData = DailyReportField::where('daily_report_id', $dailyReportId)->get();
        
        
    //         // Calculate billing type totals
    //         $billableHrs = 0;
    //         $nonBillableHrs = 0;
    //         $internalBillableHrs = 0;

    //         foreach ($containerData as $data) {
    //             switch ($data['billable']) {
    //                 case 0: // Non Billable
    //                     $nonBillableHrs += $data['hrs'];
    //                     break;
    //                 case 1: // Billable
    //                     $billableHrs += $data['hrs'];
    //                     break;
    //                 case 2: // Internal Billable
    //                     $internalBillableHrs += $data['hrs'];
    //                     break;
    //             }
    //         }
        
    //     $emailData = [
    //         'reportData' => $reportData,
    //         'overallStatus' => $dailyReport->overall_status,
    //         'totalTime' => $dailyReport->total_time,
    //         'billableHrs' => number_format($billableHrs, 2),
    //         'nonBillableHrs' => number_format($nonBillableHrs, 2),
    //         'internalBillableHrs' => number_format($internalBillableHrs, 2)
    //     ];
    
    //    // Send email to main recipient with user as CC
    //     Mail::to($mainRecipient)
    //     ->cc($userEmail)
    //     ->send(new DailyReportMail($emailData, $userName));
            
    //     return redirect()->back()->with('flash_success_dailyreport', 'Daily Report added successfully.');
    // }


    

    public function store(Request $request)
    {

       // Get user data
        $user = Auth::user();
        $userEmail = $user->email;
        $userName = $user->name;
        $mainRecipient = 'web.b4@isarva.in';

       // Check if user already submitted a report today
        // $alreadySubmitted = DailyReport::where('user_id', $user->id)
        // ->whereDate('created_at', Carbon::today())
        // ->exists();

        // if ($alreadySubmitted) {
        //     return redirect()->back()->withErrors(['You can only submit one daily report per day.']);
        // }

        // Base validation rules
        $request->validate([
            'type' => 'required|array|min:1',
            'type.*' => 'required|integer|in:1,2',
            'comments' => 'required|array',
            'comments.*' => 'required|string',
            'hrs' => 'required|array|min:1',
            'hrs.*' => 'required|numeric',
            'link' => 'nullable|array',
            'link.*' => 'nullable|url',
            'billable' => 'required|array|min:1',
            'billable.*' => 'required|integer|in:0,1,2',
            'total_hrs' => 'required|numeric',
            'overall_status' => 'required|string|max:500',
            // 'creation_date' => 'required|date',
        
            // Make all fields nullable by default
            'project_name.*' => 'nullable|string|max:255',
            'project_id.*' => 'nullable|integer',
            'task_name.*' => 'nullable|string|max:255',
            'task_id.*' => 'nullable|integer',
            'ticket-name.*' => 'nullable|string|max:255',
            'ticket_id.*' => 'nullable|integer',
          
        ], [
            'type.required' => 'You must select at least one type.',
            'type.*.required' => 'Each type is required.',
            'type.*.integer' => 'Type must be an integer.',
            'type.*.in' => 'Invalid type selected.',
        
            'comments.required' => 'Comments are required.',
            'comments.*.required' => 'Each comment field is required.',
            'comments.*.string' => 'Each comment must be a valid text.',
        
            'hrs.required' => 'Hours field is required.',
            'hrs.*.required' => 'Each hour field is required.',
            'hrs.*.numeric' => 'Hours must be a numeric value.',
        
            'link.*.url' => 'Each link must be a valid URL.',
        
            'billable.required' => 'Billable status is required.',
            'billable.*.required' => 'Each billable field is required.',
            'billable.*.integer' => 'Billable must be an integer.',
            'billable.*.in' => 'Invalid billable option selected.',
        
            'total_hrs.required' => 'Total hours are required.',
            'total_hrs.numeric' => 'Total hours must be a numeric value.',
        
            'overall_status.required' => 'Overall status is required.',
           'overall_status.max' => 'Overall status must not exceed 500 characters.',
 
        
            'project_name.*.string' => 'Each project name must be a valid text.',
            'project_name.*.max' => 'Project name must not exceed 255 characters.',
        
            'project_id.*.integer' => 'Project ID must be an integer.',
        
            'task_name.*.string' => 'Each task name must be a valid text.',
            'task_name.*.max' => 'Task name must not exceed 255 characters.',
        
            'task_id.*.integer' => 'Task ID must be an integer.',
        
            'ticket-name.*.string' => 'Each ticket name must be a valid text.',
            'ticket-name.*.max' => 'Ticket name must not exceed 255 characters.',
        
            'ticket_id.*.integer' => 'Ticket ID must be an integer.',

            // 'creation_date.required' => 'The date of creation is required.',
            // 'creation_date.date' => 'The date of creation must be a valid date.',
        ]);
        
        // Manual conditional validation
        foreach ($request->get('type', []) as $index => $type) {
            if ($type == 1) { // Project
                Validator::make($request->all(), [
                    "project_name.$index" => 'required|string|max:255',
                    "project_id.$index" => 'required|integer|exists:si_projects,id',
                    "task_name.$index" => 'required|string|max:255',
                    "task_id.$index" => 'required|integer|exists:si_tasks,id',
                ], [
                    "project_name.$index.required" => 'The project name is required.',
                    "project_id.$index.required" => 'The project selection is required.',
                    "project_id.$index.exists" => 'Invalid project selected.',
                    "task_name.$index.required" => 'The task name is required.',
                    "task_id.$index.required" => 'The task selection is required.',
                    "task_id.$index.exists" => 'Invalid task selected.',
                ])->validate();
            } 
            elseif ($type == 2) { // Ticket
                Validator::make($request->all(), [
                    "ticket-name.$index" => 'required|string|max:255',
                    "ticket_id.$index" => 'required|integer|exists:isar_tickets,id',
                ], [
                    "ticket-name.$index.required" => 'The ticket name is required.',
                    "ticket_id.$index.required" => 'The ticket selection is required.',
                    "ticket_id.$index.exists" => 'Invalid ticket selected.',
                ])->validate();
            }
        }
    
        // Process container data
        $containerData = [];
        // foreach ($request->get('type') as $uniqueId => $type) {
        //     $data = [
        //         'user_id' => Auth::id(),
        //         'type' => $type,
        //         'comments' => $request->get('comments')[$uniqueId],
        //         'hrs' => $request->get('hrs')[$uniqueId],
        //         'link' => $request->get('link')[$uniqueId] ?? null,
        //         'billable' => $request->get('billable')[$uniqueId],
        //     ];
    
        //     if ($type == 1) { // Project
        //         $data['project_name'] = $request->get('project_name')[$uniqueId];
        //         $data['task_name'] = $request->get('task_name')[$uniqueId];
        //         $data['project_id'] = $request->get('project_id')[$uniqueId];
        //         $data['task_id'] = $request->get('task_id')[$uniqueId];
        //     } 
        //     elseif ($type == 2) { // Ticket
        //         $data['project_name'] = $request->get('ticket-name')[$uniqueId];
        //         $data['task_name'] = 'Other';
        //         $data['project_id'] = $request->get('ticket_id')[$uniqueId]; // Store ticket ID in project_id
        //         $data['task_id'] = $request->get('task_id')[$uniqueId] ?? 0; // Fallback to 0 if null
        //     }
    
        //     $containerData[] = $data;
        // }

        
      foreach ($request->get('type') as $uniqueId => $type) {
        $data = [
            'user_id' => Auth::id(),
            'type' => $type,
            'comments' => $request->get('comments')[$uniqueId],
            'hrs' => $request->get('hrs')[$uniqueId],
            'link' => $request->get('link')[$uniqueId] ?? null,
            'billable' => $request->get('billable')[$uniqueId],
        ];

        if ($type == 1) { // Project
            $data['project_name'] = $request->get('project_name')[$uniqueId];
            $data['task_name'] = $request->get('task_name')[$uniqueId];
            $data['project_id'] = $request->get('project_id')[$uniqueId];
            $data['task_id'] = $request->get('task_id')[$uniqueId];
            
            // Fetch billing company from project
            $project = Project::find($data['project_id']);
            $data['se_bill_company'] = $project ? $project->biiling_company : 0;
        } 
        elseif ($type == 2) { // Ticket
            $data['project_name'] = $request->get('ticket-name')[$uniqueId];
            $data['task_name'] = 'Other';
            $data['project_id'] = $request->get('ticket_id')[$uniqueId];
            $data['task_id'] = $request->get('task_id')[$uniqueId] ?? 0;
            $data['se_bill_company'] = 0; // Default for tickets
        }

        $containerData[] = $data;
    }
    
        DB::beginTransaction();

        // Create the daily report with the creation date
        $creationDate = Carbon::parse($request->get('creation_date'));
    
        $dailyReport = new DailyReport();
        $dailyReport->user_id = Auth::id();
        $dailyReport->total_time = array_sum(array_column($containerData, 'hrs'));
        $dailyReport->overall_status = $request->get('overall_status');
        $dailyReport->created_by = Auth::id();
        $dailyReport->updated_by = Auth::id();

        $dailyReport->created_at = $creationDate; // Set the creation date
        $dailyReport->updated_at = $creationDate;
        $dailyReport->save();
    
        $dailyReportId = $dailyReport->id;
    
        // foreach ($containerData as $data) {
        //     $dailyReportField = new DailyReportField();
        //     $dailyReportField->daily_report_id = $dailyReportId;
        //     $dailyReportField->user_id = Auth::id();
        //     $dailyReportField->type = $data['type'];
        //     $dailyReportField->project_name = $data['project_name'];
        //     $dailyReportField->task_name = $data['task_name'];
        //     $dailyReportField->comments = $data['comments'];
        //     $dailyReportField->hrs = $data['hrs'];
        //     $dailyReportField->link = $data['link'];
        //     $dailyReportField->billable_type = $data['billable'];
        //     $dailyReportField->project_id = $data['project_id'];
            
        //     // Handle task_id for tickets - set to 0 if null
        //     $dailyReportField->task_id = ($data['type'] == 2 && empty($data['task_id'])) ? 0 : $data['task_id'];
            
        //     $dailyReportField->created_by = Auth::id();
        //     $dailyReportField->updated_by = Auth::id();

        //     $dailyReportField->created_at = $creationDate; // Set the creation date
        //     $dailyReportField->updated_at = $creationDate;
        //     $dailyReportField->save();
        // }
          foreach ($containerData as $data) {
        $dailyReportField = new DailyReportField();
        $dailyReportField->daily_report_id = $dailyReportId;
        $dailyReportField->user_id = Auth::id();
        $dailyReportField->type = $data['type'];
        $dailyReportField->project_name = $data['project_name'];
        $dailyReportField->task_name = $data['task_name'];
        $dailyReportField->comments = $data['comments'];
        $dailyReportField->hrs = $data['hrs'];
        $dailyReportField->link = $data['link'];
        $dailyReportField->billable_type = $data['billable'];
        $dailyReportField->project_id = $data['project_id'];
        $dailyReportField->task_id = ($data['type'] == 2 && empty($data['task_id'])) ? 0 : $data['task_id'];
        $dailyReportField->se_bill_company = $data['se_bill_company']; // Store billing company
        $dailyReportField->created_by = Auth::id();
        $dailyReportField->updated_by = Auth::id();
        $dailyReportField->created_at = $creationDate;
        $dailyReportField->updated_at = $creationDate;
        $dailyReportField->save();
    }
    //  dd($dailyReportField);
        DB::commit();
    
        // Email and redirect logic
        $reportData = DailyReportField::where('daily_report_id', $dailyReportId)->get();
       
        
            // Calculate billing type totals
            $billableHrs = 0;
            $nonBillableHrs = 0;
            $internalBillableHrs = 0;

            foreach ($containerData as $data) {
                switch ($data['billable']) {
                    case 0: // Non Billable
                        $nonBillableHrs += $data['hrs'];
                        break;
                    case 1: // Billable
                        $billableHrs += $data['hrs'];
                        break;
                    case 2: // Internal Billable
                        $internalBillableHrs += $data['hrs'];
                        break;
                }
            }
        
        $emailData = [
            'reportData' => $reportData,
            'overallStatus' => $dailyReport->overall_status,
            'totalTime' => $dailyReport->total_time,
            'billableHrs' => number_format($billableHrs, 2),
            'nonBillableHrs' => number_format($nonBillableHrs, 2),
            'internalBillableHrs' => number_format($internalBillableHrs, 2)
        ];
    
       // Send email to main recipient with user as CC
        // Mail::to($mainRecipient)
        // ->cc($userEmail)
        // ->send(new DailyReportMail($emailData, $userName));
            
        return redirect()->back()->with('flash_success_dailyreport', 'Daily Report added successfully.');
    }
}
