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


class DailyReportController extends Controller
{
    //
    public function index(){

        

        return view('backend.daily_report.dailyreport');
    }

     // Fetch projects allocated to the logged-in user
    //  public function getUserProjects() {
    //     $user = auth()->user();
    //     $projects = Project::where('team_members', 'like', '%' . $user->id . '%')->get();
    //     return response()->json($projects);
    // }

    // // Fetch tasks assigned to the logged-in user for a specific project
    // public function getUserTasks($projectId) {
    //     $user = auth()->user();
    //     $tasks = Task::where('project_id', $projectId)
    //                  ->where('assigned_to', $user->id)
    //                  ->get();
    //     return response()->json($tasks);
    // }


    // public function store(Request $request) {
    //     $user = auth()->user();
    
    //     // Check if the user has already submitted a daily report today
    //     $existingReport = DailyReport::where('user_id', $user->id)
    //                                  ->whereDate('created_at', today())
    //                                  ->exists();
    //     if ($existingReport) {
    //         return redirect()->back()->with('error', 'Daily report already submitted.');
    //     }
    
    //     // Validate the request
    //     $validated = $request->validate([
    //         'total_time' => 'required|numeric',
    //         'overall_status' => 'required|string',
    //         'fields' => 'required|array',
    //         'fields.*.type' => 'required|string',
    //         'fields.*.project_name' => 'required_if:fields.*.type,Project',
    //         'fields.*.task_name' => 'required_if:fields.*.type,Project',
    //         'fields.*.comments' => 'required|string',
    //         'fields.*.link' => 'nullable|url',
    //         'fields.*.billable_type' => 'required|string',
    //         'fields.*.se_bill_company' => 'nullable|string',
    //     ]);
    
    //     // Save the daily report
    //     $dailyReport = DailyReport::create([
    //         'user_id' => $user->id,
    //         'total_time' => $validated['total_time'],
    //         'overall_status' => $validated['overall_status'],
    //     ]);
    
    //     // Save the fields
    //     foreach ($validated['fields'] as $field) {
    //         $dailyReport->fields()->create($field);
    //     }
    
    //     return redirect()->back()->with('success', 'Daily report submitted successfully.');
    // }



    // METHOD  
     

    // public function getProjectList(Request $request) {
    //     $term = $request->query('term'); // Get the search term from the query string
    //     $user = auth()->user();
    
    //     // Fetch projects assigned to the logged-in user
    //     $projects = Project::where('team_members', 'like', '%' . $user->id . '%')
    //                        ->where('project_name', 'like', '%' . $term . '%')
    //                        ->get(['id', 'project_name as label']);
    
    //     return response()->json($projects);
    // }

    // public function getProjectTaskList(Request $request) {
    //     $term = $request->query('term'); // Get the search term from the query string
    //     $projectId = $request->query('projectId'); // Get the project ID from the query string
    //     $user = auth()->user();
    
    //     // Fetch tasks assigned to the logged-in user for the specified project
    //     $tasks = Task::where('project_id', $projectId)
    //                  ->where('assigned_to', $user->id)
    //                  ->where('task_name', 'like', '%' . $term . '%')
    //                  ->get(['id', 'task_name as label']);
    
    //     return response()->json($tasks);
    // }


    // public function getProjectList(Request $request) {
    //     $term = $request->query('term'); // Get the search term from the query string
    //     $user = auth()->user();
    
    //     // Check if the user is a super admin
    //     if ($user->is_super_admin) {
    //         // Super admin can access all projects
    //         $projects = Project::where('project_name', 'like', '%' . $term . '%')
    //                            ->get(['id', 'project_name as label']);
    //     } else {
    //         // Regular users can only access their assigned projects
    //         $projects = Project::where('team_members', 'like', '%' . $user->id . '%')
    //                            ->where('project_name', 'like', '%' . $term . '%')
    //                            ->get(['id', 'project_name as label']);
    //     }
    
    //     return response()->json($projects);
    // }


    // public function getProjectTaskList(Request $request) {
        
    //     $term = $request->query('term'); // Get the search term from the query string
    //     $projectId = $request->query('projectId'); // Get the project ID from the query string
    //     $user = auth()->user();
    
    //     // Check if the user is a super admin
    //     if ($user->is_super_admin) {
    //         // Super admin can access all tasks for the project
    //         $tasks = Task::where('project_id', $projectId)
    //                      ->where('task_name', 'like', '%' . $term . '%')
    //                      ->get(['id', 'task_name as label']);
    //     } else {
    //         // Regular users can only access their assigned tasks for the project
    //         $tasks = Task::where('project_id', $projectId)
    //                      ->where('assigned_to', $user->id)
    //                      ->where('task_name', 'like', '%' . $term . '%')
    //                      ->get(['id', 'task_name as label']);
    //     }
    
    //     return response()->json($tasks);
    // }



    // public function search(Request $request)
    // {
    //     $term = $request->input('term');
    //     $projects = Project::where('project_name', 'like', '%' . $term . '%')->pluck('project_name');

    //     return response()->json($projects);
    // }

    // This working perfectly fine

    // public function search($term = null)
    // {
    //     if ($term) {
    //         $projects = Project::where('project_name', 'like', '%' . $term . '%')->pluck('project_name');
    //     } else {
    //         $projects = []; // Return an empty array if no term is provided
    //     }

    //     return response()->json($projects);
    // }

    public function search($term = null)
    {
        if ($term) {
            $projects = Project::where('project_name', 'like', '%' . $term . '%')
                              ->select('id', 'project_name as label') // Select id and project_name (aliased as label)
                              ->get();
        } else {
            $projects = []; // Return an empty array if no term is provided
        }

        return response()->json($projects);
    }


    // New task search method
    public function searchTasks(Request $request)
    {
        $term = $request->input('term');
        $projectId = $request->input('project_id'); // Get the selected project ID

        if ($term && $projectId) {
            $tasks = Task::where('task_name', 'like', '%' . $term . '%')
                         ->where('project_id', $projectId) // Filter tasks by project ID
                         ->select('id', 'task_name as label')
                         ->get();
        } else {
            $tasks = [];
        }

        return response()->json($tasks);
    }

    // public function store(Request $request)
    // {
    //     dd($request->all());
    //     // Validate request
    //     $request->validate([
    //         'project_id'     => 'required|integer|exists:si_projects,id', // hidden
    //         'task_id'        => 'required|integer|exists:si_tasks,id',
    //         'user_id'        =>  'required|integer|exists:si_users,id',
    //         'total-hrs'      => 'required|numeric',
    //         'overall_status' => 'required|string',
    //         'reports'        => 'required|array|min:1', // Ensure at least one report is present
    //         'project_name'   => 'nullable|string|max:255',
    //         'task_name'      => 'nullable|string|max:255',
    //         'ticket_name'    => 'nullable|string|max:255',
    //         'type'           => 'required|integer|in:0,1,2', // 0=default, 1=Project, 2=Ticket
    //         'comments'       => 'required|string',
    //         'hrs'            => 'required|numeric',
    //         'link'           => 'nullable|url',
    //         'billable'       => 'required|integer|in:0,1,2', // Billable status
           
    //     ]);

    //     try {
    //         DB::beginTransaction(); // Start DB transaction

    //         //Columnname  = name attribute
    //         // Step 1: Insert into `si_daily_report`
    //         $dailyReport = new DailyReport();
    //         $dailyReport->user_id        = Auth::id();
    //         $dailyReport->total_time     = $request->total_hrs;
    //         $dailyReport->overall_status = $request->overall_status;
    //         $dailyReport->created_by     = Auth::id();
    //         $dailyReport->updated_by     = Auth::id();
    //         $dailyReport->save();

    //         $dailyReportId = $dailyReport->id; // Get inserted `daily_report_id`

    //         // Step 2: Insert multiple triggered sections into `si_daily_report_fields`
    //         foreach ($request->reports as $report) {
    //             $dailyReportField = new DailyReportField();
    //             $dailyReportField->daily_report_id = $dailyReportId;
    //             $dailyReportField->user_id         = Auth::id();
    //             $dailyReportField->type            = $report['type'];
    //             $dailyReportField->project_name    = $report['project_name'] ?? $report['task_name'] ?? $report['ticket_name'];
    //             $dailyReportField->comments        = $report['comments'];
    //             $dailyReportField->hrs             = $report['hrs'];
    //             $dailyReportField->link            = $report['link'];
    //             $dailyReportField->billable_type   = $report['billable'];
    //             $dailyReportField->project_id      = $report['project_id'] ?? null;
    //             $dailyReportField->task_id         = $report['task_id'] ?? null;
    //             $dailyReportField->created_by      = Auth::id();
    //             $dailyReportField->updated_by      = Auth::id();
    //             $dailyReportField->save();
    //         }

    //         DB::commit(); // Commit transaction

    //         return redirect()->back()->with('success', 'Daily report added successfully!');

    //     } catch (\Exception $e) {
    //         DB::rollBack(); // Rollback on error
    //         return redirect()->back()->with('error', 'Something went wrong! ' . $e->getMessage());
    //     }
    // }

    // public function store(Request $request)
    // {
    //     dd($request->all());
    //     // Validate request
    //     $request->validate([
    //         'project_id'     => 'required|integer|exists:si_projects,id', // Ensure project_id is present
    //         'task_id'        => 'required|integer|exists:si_tasks,id', // Ensure task_id is present
    //         'user_id'        => 'required|integer|exists:si_users,id',
    //         'total_hrs'      => 'required|numeric',
    //         'overall_status' => 'required|string',
    //         'project_name'   => 'nullable|string|max:255',
    //         'task_name'      => 'nullable|string|max:255',
    //         'ticket_name'    => 'nullable|string|max:255',
    //         'type'           => 'required|integer|in:0,1,2', // 0=default, 1=Project, 2=Ticket
    //         'comments'       => 'required|string',
    //         'hrs'            => 'required|numeric',
    //         'link'           => 'nullable|url',
    //         'billable'       => 'required|integer|in:0,1,2', // Billable status
    //     ]);
    
    //     try {
    //         DB::beginTransaction(); // Start DB transaction
    
    //         // Step 1: Insert into `si_daily_report`
    //         $dailyReport = new DailyReport();
    //         $dailyReport->user_id        = Auth::id();
    //         $dailyReport->total_time     = $request->total_hrs;
    //         $dailyReport->overall_status = $request->overall_status;
    //         $dailyReport->created_by     = Auth::id();
    //         $dailyReport->updated_by     = Auth::id();
    //         $dailyReport->save();
    
    //         $dailyReportId = $dailyReport->id; // Get inserted `daily_report_id`
    
    //         // Step 2: Insert into `si_daily_report_fields`
    //         $dailyReportField = new DailyReportField();
    //         $dailyReportField->daily_report_id = $dailyReportId;
    //         $dailyReportField->user_id         = Auth::id();
    //         $dailyReportField->type            = $request->type;
    //         $dailyReportField->project_name    = $request->project_name;
    //         $dailyReportField->task_name       = $request->task_name;
    //         $dailyReportField->comments        = $request->comments;
    //         $dailyReportField->hrs             = $request->hrs;
    //         $dailyReportField->link            = $request->link;
    //         $dailyReportField->billable_type   = $request->billable;
    //         $dailyReportField->project_id      = $request->project_id;
    //         $dailyReportField->task_id         = $request->task_id;
    //         $dailyReportField->created_by      = Auth::id();
    //         $dailyReportField->updated_by      = Auth::id();
    //         $dailyReportField->save();
    
    //         DB::commit(); // Commit transaction
    
    //         return redirect()->back()->with('success', 'Daily report added successfully!');
    
    //     } catch (\Exception $e) {
    //         DB::rollBack(); // Rollback on error
    //         return redirect()->back()->with('error', 'Something went wrong! ' . $e->getMessage());
    //     }
    // }

        // Store yesterday's working fine
        // public function store(Request $request)
        // {
        //     // dd($request->all());
        //     // Debug: Log the request data
        //     \Log::info('Request Data:', $request->all());

        //     // Validate request
        //     try {
        //         $validatedData = $request->validate([
        //             'project_id'     => 'required|integer|exists:si_projects,id', // Ensure project_id is present
        //             'task_id'        => 'required|integer|exists:si_tasks,id', // Ensure task_id is present
        //             'user_id'        => 'required|integer|exists:si_users,id',
        //             'total_hrs'      => 'required|numeric',
        //             'overall_status' => 'required|string',
        //             'project_name'   => 'nullable|string|max:255',
        //             'task_name'      => 'nullable|string|max:255',
        //             // 'ticket_name'    => 'nullable|string|max:255',
        //             'type'           => 'required|integer|in:0,1,2', // 0=default, 1=Project, 2=Ticket
        //             'comments'       => 'required|string',
        //             'hrs'            => 'required|numeric',
        //             'link'           => 'nullable|url',
        //             'billable'       => 'required|integer|in:0,1,2', // Billable status
        //         ]);

        //         // Debug: Log the validated data
        //         \Log::info('Validated Data:', $validatedData);

        //         DB::beginTransaction(); // Start DB transaction

        //         // Step 1: Insert into `si_daily_report`
        //         $dailyReport = new DailyReport();
        //         $dailyReport->user_id        = Auth::id();
        //         $dailyReport->total_time     = $validatedData['total_hrs'];
        //         $dailyReport->overall_status = $validatedData['overall_status'];
        //         $dailyReport->created_by     = Auth::id();
        //         $dailyReport->updated_by     = Auth::id();
        //         $dailyReport->save();

        //         $dailyReportId = $dailyReport->id; // Get inserted `daily_report_id`

        //         // Step 2: Insert into `si_daily_report_fields`
        //         $dailyReportField = new DailyReportField();
        //         $dailyReportField->daily_report_id = $dailyReportId;
        //         $dailyReportField->user_id         = Auth::id();
        //         $dailyReportField->type            = $validatedData['type'];
        //         $dailyReportField->project_name    = $validatedData['project_name'];
        //         $dailyReportField->task_name       = $validatedData['task_name'];
        //         $dailyReportField->comments        = $validatedData['comments'];
        //         $dailyReportField->hrs             = $validatedData['hrs'];
        //         $dailyReportField->link            = $validatedData['link'];
        //         $dailyReportField->billable_type   = $validatedData['billable'];
        //         $dailyReportField->project_id      = $validatedData['project_id'];
        //         $dailyReportField->task_id         = $validatedData['task_id'];
        //         $dailyReportField->created_by      = Auth::id();
        //         $dailyReportField->updated_by      = Auth::id();
        //         $dailyReportField->save();

        //         DB::commit(); // Commit transaction

        //         return redirect()->back()->with('success', 'Daily report added successfully!');

        //     } catch (\Illuminate\Validation\ValidationException $e) {
        //         // Handle validation errors
        //         \Log::error('Validation Error:', $e->errors());
        //         return redirect()->back()
        //                         ->withErrors($e->errors()) // Pass validation errors to the view
        //                         ->withInput(); // Retain old input values
        //     } catch (\Exception $e) {
        //         DB::rollBack(); // Rollback on error
        //         \Log::error('Error storing daily report:', ['error' => $e->getMessage()]);
        //         return redirect()->back()->with('error', 'Something went wrong! ' . $e->getMessage());
        //     }
        // }

        public function store(Request $request)
        {
            //  dd($request->all());
            // Debug: Log the request data
            \Log::info('Request Data:', $request->all());
            \Log::info('Old Input:', session()->getOldInput());

        
            // Validate request
            // try {
                // Step 1: Validate the request data
                $request->validate([
                    'project_name'   => 'required|array|min:1',
                    'project_name.*' => 'required|string|max:255',
                    // 'project_id'     => 'required|array|min:1',
                    'project_id.*'   => 'required|integer|exists:si_projects,id',
                    'task_name'      => 'required|array|min:1',
                    'task_name.*'    => 'required|string|max:255',
                    // 'task_id'        => 'required|array|min:1',
                    'task_id.*'      => 'required|integer|exists:si_tasks,id',
                    'type'           => 'required|array|min:1',
                    'type.*'         => 'required|integer|in:0,1,2',
                    'comments'       => 'required|array',
                    'comments.*'     => 'required|string',
                    'hrs'            => 'required|array|min:1',
                    'hrs.*'          => 'required|numeric',
                    'link'           => 'nullable|array',
                    'link.*'         => 'nullable|url',
                    'billable'       => 'required|array|min:1',
                    'billable.*'     => 'required|integer|in:0,1,2',
                    'total_hrs'      => 'required|numeric',
                    'overall_status' => 'required|string',
                 ], [
                    'project_id.*.exists'      => 'Invalid project selected.', // Custom error message
                    'task_id.*.exists'         => 'Invalid task selected.', // Custom error message
                    'project_name.required'    => 'The project name is required.',
                    'project_name.*.required'  => 'The project name is required.',
                    'task_name.required'       => 'The task name is required.',
                    'task_name.*.required'     => 'The task name is required.',
                    'comments.required'        => 'The comments are required.',
                    'comments.*.required'      => 'The comments are required.',
                    'hrs.required'             => 'The hours are required.',
                    'hrs.*.required'           => 'The hours are required.',
                    'type.required'            => 'The report type is required.',
                    'type.*.required'          => 'The report type is required for all containers.',
                    'type.*.in'                => 'The selected report type is invalid.',
                ]);
                
            
        
                // Step 2: Extract all container data
                $containerData = [];
                foreach ($request->get('project_name') as $uniqueId => $projectName) {
                    $containerData[] = [
                        'project_id'     => $request->get('project_id')[$uniqueId],
                        'task_id'        => $request->get('task_id')[$uniqueId],
                        'user_id'        => Auth::id(),
                        'project_name'   => $projectName,
                        'task_name'      => $request->get('task_name')[$uniqueId],
                        'type'           => $request->get('type')[$uniqueId], // Ensure type is included
                        'comments'       => $request->get('comments')[$uniqueId],
                        'hrs'            => $request->get('hrs')[$uniqueId],
                        'link'           => $request->get('link')[$uniqueId],
                        'billable'       => $request->get('billable')[$uniqueId],
                    ];
                }
        
                DB::beginTransaction(); // Start DB transaction
        
                // Step 3: Insert into `si_daily_report`
                $dailyReport = new DailyReport();
                $dailyReport->user_id        = Auth::id();
                $dailyReport->total_time     = array_sum(array_column($containerData, 'hrs')); // Sum of all hours
                $dailyReport->overall_status = $request->get('overall_status');
                $dailyReport->created_by     = Auth::id();
                $dailyReport->updated_by     = Auth::id();
                $dailyReport->save();
        
                $dailyReportId = $dailyReport->id; // Get inserted `daily_report_id`
        
                // Step 4: Insert into `si_daily_report_fields` for each container
                foreach ($containerData as $data) {
                    $dailyReportField = new DailyReportField();
                    $dailyReportField->daily_report_id = $dailyReportId;
                    $dailyReportField->user_id         = Auth::id();
                    $dailyReportField->type            = $data['type']; // Ensure type is saved
                    $dailyReportField->project_name    = $data['project_name'];
                    $dailyReportField->task_name       = $data['task_name'];
                    $dailyReportField->comments        = $data['comments'];
                    $dailyReportField->hrs             = $data['hrs'];
                    $dailyReportField->link            = $data['link'];
                    $dailyReportField->billable_type   = $data['billable'];
                    $dailyReportField->project_id      = $data['project_id'];
                    $dailyReportField->task_id         = $data['task_id'];
                    $dailyReportField->created_by      = Auth::id();
                    $dailyReportField->updated_by      = Auth::id();
                    $dailyReportField->save();
                }
        
                DB::commit(); // Commit transaction
        
                return redirect()->back()->with('flash_success_dailyreport', 'Daily Report added successfully.');
        
            // } catch (\Illuminate\Validation\ValidationException $e) {
            //     // Handle validation errors
            //     \Log::error('Validation Error:', $e->errors());
            //     return redirect()->back()
            //                     ->withErrors($e->errors()) // Pass validation errors to the view
            //                     ->withInput(); // Retain old input values
            // } catch (\Exception $e) {
            //     DB::rollBack(); // Rollback on error
            //     \Log::error('Error storing daily report:', ['error' => $e->getMessage()]);
            //     return redirect()->back()->with('error', 'Something went wrong! ' . $e->getMessage());
            // }
        }

        // public function store(Request $request)
        // {
        //     try {
        //         // Step 1: Validate the request data
        //         $validatedData = $request->validate([
        //             'project_name'   => 'required|array|min:1',
        //             'project_name.*' => 'required|string|max:255',
        //             'project_id.*'   => 'required|integer|exists:si_projects,id',
        //             'task_name'      => 'required|array|min:1',
        //             'task_name.*'    => 'required|string|max:255',
        //             'task_id.*'      => 'required|integer|exists:si_tasks,id',
        //             'type'           => 'required|array|min:1',
        //             'type.*'         => 'required|integer|in:0,1,2',
        //             'comments'       => 'required|array',
        //             'comments.*'     => 'required|string',
        //             'hrs'            => 'required|array|min:1',
        //             'hrs.*'          => 'required|numeric',
        //             'link'           => 'nullable|array',
        //             'link.*'         => 'nullable|url',
        //             'billable'       => 'required|array|min:1',
        //             'billable.*'     => 'required|integer|in:0,1,2',
        //             'total_hrs'      => 'required|numeric',
        //             'overall_status' => 'required|string',
        //         ], [
        //             'project_id.*.exists'      => 'Invalid project selected.',
        //             'task_id.*.exists'        => 'Invalid task selected.',
        //             'project_name.required'    => 'The project name is required.',
        //             'project_name.*.required' => 'The project name is required.',
        //             'task_name.required'      => 'The task name is required.',
        //             'task_name.*.required'    => 'The task name is required.',
        //             'comments.required'        => 'The comments are required.',
        //             'comments.*.required'      => 'The comments are required.',
        //             'hrs.required'            => 'The hours are required.',
        //             'hrs.*.required'           => 'The hours are required.',
        //             'type.required'            => 'The report type is required.',
        //             'type.*.required'          => 'The report type is required for all containers.',
        //             'type.*.in'                => 'The selected report type is invalid.',
        //         ]);
        
        //         // Step 2: Extract all container data
        //         $containerData = [];
        //         foreach ($request->get('project_name') as $uniqueId => $projectName) {
        //             $containerData[] = [
        //                 'project_id'     => $request->get('project_id')[$uniqueId],
        //                 'task_id'        => $request->get('task_id')[$uniqueId],
        //                 'user_id'        => Auth::id(),
        //                 'project_name'   => $projectName,
        //                 'task_name'      => $request->get('task_name')[$uniqueId],
        //                 'type'           => $request->get('type')[$uniqueId],
        //                 'comments'       => $request->get('comments')[$uniqueId],
        //                 'hrs'            => $request->get('hrs')[$uniqueId],
        //                 'link'           => $request->get('link')[$uniqueId],
        //                 'billable'       => $request->get('billable')[$uniqueId],
        //             ];
        //         }
        
        //         DB::beginTransaction(); // Start DB transaction
        
        //         // Step 3: Insert into `si_daily_report`
        //         $dailyReport = new DailyReport();
        //         $dailyReport->user_id        = Auth::id();
        //         $dailyReport->total_time     = array_sum(array_column($containerData, 'hrs'));
        //         $dailyReport->overall_status = $request->get('overall_status');
        //         $dailyReport->created_by     = Auth::id();
        //         $dailyReport->updated_by     = Auth::id();
        //         $dailyReport->save();
        
        //         $dailyReportId = $dailyReport->id; // Get inserted `daily_report_id`
        
        //         // Step 4: Insert into `si_daily_report_fields` for each container
        //         foreach ($containerData as $data) {
        //             $dailyReportField = new DailyReportField();
        //             $dailyReportField->daily_report_id = $dailyReportId;
        //             $dailyReportField->user_id         = Auth::id();
        //             $dailyReportField->type            = $data['type'];
        //             $dailyReportField->project_name    = $data['project_name'];
        //             $dailyReportField->task_name       = $data['task_name'];
        //             $dailyReportField->comments        = $data['comments'];
        //             $dailyReportField->hrs             = $data['hrs'];
        //             $dailyReportField->link            = $data['link'];
        //             $dailyReportField->billable_type   = $data['billable'];
        //             $dailyReportField->project_id      = $data['project_id'];
        //             $dailyReportField->task_id         = $data['task_id'];
        //             $dailyReportField->created_by      = Auth::id();
        //             $dailyReportField->updated_by      = Auth::id();
        //             $dailyReportField->save();
        //         }
        
        //         DB::commit(); // Commit transaction
        
        //         return redirect()->back()->with('flash_success_dailyreport', 'Daily Report added successfully.');
        
        //     } catch (\Illuminate\Validation\ValidationException $e) {
        //         // Log validation errors
        //         \Log::error('Validation Errors:', $e->errors());
        
        //         // Redirect back with errors and old input
        //         return redirect()->back()
        //                         ->withErrors($e->errors()) // Pass validation errors to the view
        //                         ->withInput(); // Retain old input values
        //     } catch (\Exception $e) {
        //         DB::rollBack(); // Rollback on error
        //         \Log::error('Error storing daily report:', ['error' => $e->getMessage()]);
        //         return redirect()->back()->with('error', 'Something went wrong! ' . $e->getMessage());
        //     }
        // }

}
