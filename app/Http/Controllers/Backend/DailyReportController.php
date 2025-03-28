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

class DailyReportController extends Controller
{
    //
    public function index(){

        

        return view('backend.daily_report.dailyreport');
    }

  
     // Works fine
    // public function search($term = null)
    // {
    //     if ($term) {
    //         $projects = Project::where('project_name', 'like', '%' . $term . '%')
    //                           ->select('id', 'project_name as label') // Select id and project_name (aliased as label)
    //                           ->get();
    //     } else {
    //         $projects = []; // Return an empty array if no term is provided
    //     }

    //     return response()->json($projects);
    // }

       
        public function search($term = null)
        {
            $userId = Auth::id(); // Get logged-in user ID

            if ($term) {
                $projects = Project::where('project_name', 'like', '%' . $term . '%')
                                ->where(function ($query) use ($userId) {
                                    $query->where('created_by', $userId) // Projects created by user
                                            ->orWhereRaw("JSON_CONTAINS(team_members, ?)", [$userId]); // Projects where user is a team member
                                })
                                ->select('id', 'project_name as label')
                                ->get();
            } else {
                $projects = [];
            }

            return response()->json($projects);
        }


    // New task search method
    // public function searchTasks(Request $request)
    // {
    //     $term = $request->input('term');
    //     $projectId = $request->input('project_id'); // Get the selected project ID

    //     if ($term && $projectId) {
    //         $tasks = Task::where('task_name', 'like', '%' . $term . '%')
    //                      ->where('project_id', $projectId) // Filter tasks by project ID
    //                      ->select('id', 'task_name as label')
    //                      ->get();
    //     } else {
    //         $tasks = [];
    //     }

    //     return response()->json($tasks);
    // }
            

    public function searchTasks(Request $request)
    {
        $userId = Auth::id();
        $term = $request->input('term');
        $projectId = $request->input('project_id');

        if ($term && $projectId) {
            $tasks = Task::where('task_name', 'like', '%' . $term . '%')
                        ->where('project_id', $projectId)
                        ->where(function ($query) use ($userId) {
                            $query->where('assigned_to', $userId) // Task assigned to logged-in user
                                ->orWhereHas('project', function ($subQuery) use ($userId) {
                                    $subQuery->where('created_by', $userId) // Project created by user
                                                ->orWhereRaw("JSON_CONTAINS(team_members, ?)", [$userId]); // User is a team member
                                });
                        })
                        ->select('id', 'task_name as label')
                        ->get();
        } else {
            $tasks = [];
        }

        return response()->json($tasks);
    }


   

    public function searchTickets(Request $request)
    {
        $term = $request->input('term');
        
        if ($term) {
            $tickets = Ticket::where('title', 'like', '%' . $term . '%')
                               ->select('id', 'title as label')
                               ->get()
                               ->toArray();
        } else {
            $tickets = [];
        }
    
        return response()->json($tickets);
    }
    
 
      
    public function store(Request $request)
    {
        // Base validation rules
        $request->validate([
            'type' => 'required|array|min:1',
            'type.*' => 'required|integer|in:0,1,2',
            'comments' => 'required|array',
            'comments.*' => 'required|string',
            'hrs' => 'required|array|min:1',
            'hrs.*' => 'required|numeric',
            'link' => 'nullable|array',
            'link.*' => 'nullable|url',
            'billable' => 'required|array|min:1',
            'billable.*' => 'required|integer|in:0,1,2',
            'total_hrs' => 'required|numeric',
            'overall_status' => 'required|string',
            
            // Make all fields nullable by default
            'project_name.*' => 'nullable|string|max:255',
            'project_id.*' => 'nullable|integer',
            'task_name.*' => 'nullable|string|max:255',
            'task_id.*' => 'nullable|integer',
            'ticket-name.*' => 'nullable|string|max:255',
            'ticket_id.*' => 'nullable|integer'
        ], [
            // Your existing error messages
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
            } 
            elseif ($type == 2) { // Ticket
                $data['project_name'] = $request->get('ticket-name')[$uniqueId];
                $data['task_name'] = 'Other';
                $data['project_id'] = $request->get('ticket_id')[$uniqueId]; // Store ticket ID in project_id
                $data['task_id'] = $request->get('task_id')[$uniqueId] ?? 0; // Fallback to 0 if null
            }
    
            $containerData[] = $data;
        }
    
        DB::beginTransaction();
    
        $dailyReport = new DailyReport();
        $dailyReport->user_id = Auth::id();
        $dailyReport->total_time = array_sum(array_column($containerData, 'hrs'));
        $dailyReport->overall_status = $request->get('overall_status');
        $dailyReport->created_by = Auth::id();
        $dailyReport->updated_by = Auth::id();
        $dailyReport->save();
    
        $dailyReportId = $dailyReport->id;
    
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
            
            // Handle task_id for tickets - set to 0 if null
            $dailyReportField->task_id = ($data['type'] == 2 && empty($data['task_id'])) ? 0 : $data['task_id'];
            
            $dailyReportField->created_by = Auth::id();
            $dailyReportField->updated_by = Auth::id();
            $dailyReportField->save();
        }
    
        DB::commit();
    
        // Email and redirect logic
        $reportData = DailyReportField::where('daily_report_id', $dailyReportId)->get();
        $emailData = [
            'reportData' => $reportData,
            'overallStatus' => $dailyReport->overall_status,
            'totalTime' => $dailyReport->total_time
        ];
    
        Mail::to('web.b4@isarva.in')->send(new DailyReportMail($emailData));
    
        return redirect()->back()->with('flash_success_dailyreport', 'Daily Report added successfully.');
    }
}
