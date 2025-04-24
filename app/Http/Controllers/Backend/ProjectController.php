<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\EmployeeHelper;
use App\Models\Backend\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Backend\ProjectEstimationChangeLog;
use App\Models\Backend\Task;
use App\Helpers\ClientHelper;
use Illuminate\Support\Facades\DB;
use App\Models\Backend\User;
class ProjectController
{
  
    // Index page main method , Card view controller method
    public function index()
    {
        $user = auth()->user();
        $baseQuery = Project::query();

        // For non-admin users
        if ($user->role != 1) {
            $userId = $user->id;
            
            $baseQuery->where(function($q) use ($userId) {
                $q->where('manager', $userId)
                ->orWhere('team_leader', $userId)
                ->orWhere(function($q) use ($userId) {
                    $q->where('team_members', 'like', $userId.',%')
                        ->orWhere('team_members', 'like', '%,'.$userId.',%')
                        ->orWhere('team_members', 'like', '%,'.$userId)
                        ->orWhere('team_members', $userId);
                });
            });
        }

        // Now create all your filtered queries from the base query
        $projects = $baseQuery->get();
        $activeProjects = $baseQuery->clone()->where('status', '!=', 6)->get();
        $onBoardProjects = $baseQuery->clone()->where('status', 1)->get();
        $openProjects = $baseQuery->clone()->where('status', 2)->get();
        $progressProjects = $baseQuery->clone()->where('status', 3)->get();
        $monitorProjects = $baseQuery->clone()->where('status', 4)->get();
        $billingProjects = $baseQuery->clone()->where('status', 5)->get();
        $onHoldProjects = $baseQuery->clone()->where('status', 7)->get();
        $warrantyProjects = $baseQuery->clone()->where('status', 8)->get();
        $closedProjects = $baseQuery->clone()->where('status', 6)->get();

        // Department tab queries
        $webApplicationProjects = $baseQuery->clone()->where('department', 1)->where('status', '!=', 6)->get();
        $websiteProjects = $baseQuery->clone()->where('department', 2)->where('status', '!=', 6)->get();
        $graphicsProjects = $baseQuery->clone()->where('department', 3)->where('status', '!=', 6)->get();

        $totalProjects = $projects->count();

        return view('backend.project.index', 
            compact('projects', 'activeProjects','onBoardProjects','openProjects', 
            'progressProjects', 'monitorProjects', 'billingProjects', 'onHoldProjects', 'warrantyProjects',
            'closedProjects','webApplicationProjects', 'websiteProjects', 'graphicsProjects', 'totalProjects'));
    }
   

    
    public function manage(Request $request)
    {
        $user = auth()->user();
        $query = Project::query();
    
        // For non-admin users (role != 1)
        if ($user->role != 1) {
            $userId = $user->id;
            
            $query->where(function($q) use ($userId) {
                $q->where('manager', $userId) // User is manager
                  ->orWhere('team_leader', $userId) // User is team leader
                  ->orWhere(function($q) use ($userId) {
                      // Handle comma-separated team members
                      $q->where('team_members', 'like', $userId.',%') // Starts with user ID
                        ->orWhere('team_members', 'like', '%,'.$userId.',%') // User ID in middle
                        ->orWhere('team_members', 'like', '%,'.$userId) // Ends with user ID
                        ->orWhere('team_members', $userId); // Only user ID
                  });
            });
        }
    
        // Global project name search (from header)
        if ($request->has('global_project_name') && $request->global_project_name != '') {
            $query->where('si_projects.project_name', 'like', '%' . $request->global_project_name . '%');
        }
        
        // Manage page project name search
        elseif ($request->has('project_name') && $request->project_name != '') {
            $query->where('si_projects.project_name', 'like', '%' . $request->project_name . '%');
        }
    
        // Global project ID search (from header)
        if ($request->has('global_project_id') && $request->global_project_id != '') {
            $query->where('si_projects.id', $request->global_project_id);
        }
    
        // Status filter
        if ($request->has('status') && $request->status != 'None') {
            if ($request->status == '9') { // Active status (9)
                $query->whereNotIn('si_projects.status', [6, 7]); // Not Closed (6) or On Hold (7)
            } else {
                $query->where('si_projects.status', $request->status);
            }
        }
    
        // Other filters
        if ($request->has('assigned_to') && $request->assigned_to != '') {
            $query->where('si_projects.manager', $request->assigned_to);
        }
    
        if ($request->has('department') && $request->department != 'None') {
            $query->where('si_projects.department', $request->department);
        }
    
        // Month filter
        if ($request->has('month') && $request->month != 'None') {
            $query->whereMonth('si_projects.start_date', $request->month);
        }
    
        // Year filter
        if ($request->has('year') && $request->year != 'None') {
            $query->whereYear('si_projects.start_date', $request->year);
        }
    
        $viewType = $request->input('view', 'table');
    
        $projects = $query->leftJoin('isar_clients', 'si_projects.client', '=', 'isar_clients.id')
                 ->leftJoin('users', 'si_projects.manager', '=', 'users.id')
                ->select(
                     'si_projects.*',
                    'isar_clients.client_name as client_name',
                    'users.name as manager_name'
                );
                
        $perPage = $request->input('per_page', $viewType === 'table' ? 10 : 12);

           // Get all query parameters except page
          $queryParams = $request->except('page');
    
        // $projectsmanage = $projects->paginate($perPage);

        $projectsmanage = $projects->paginate($perPage)->appends([
            'view' => $viewType,
            'project_name' => $request->project_name,
            'status' => $request->status,
            'assigned_to' => $request->assigned_to,
            'department' => $request->department,
            'month' => $request->month,
            'year' => $request->year,
            'global_project_name' => $request->global_project_name,
            'global_project_id' => $request->global_project_id,
            'per_page' => $perPage
        ]);
        
        return view('backend.project.manage', [
            'projectsmanage' => $projectsmanage,
            'totalProjectscount' => $projectsmanage->total(),
            'viewType' => $viewType,
            'projects' => $projectsmanage->items()
        ]);
    }    
   

    public function store(Request $request)
    {
   
        // Validate the request data
        $request->validate([
            'client'          => 'required|integer|exists:isar_clients,id',
            'project_name'    => 'required|string|max:100',
            'category'        => 'nullable|integer|in:1,2,3,4,5,6,7,8,9,10',
            'project_image'   => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'manager'         => 'required|integer|exists:users,id',
            // 'team_leader'     => 'required|integer|exists:users,id',
            // 'team_members'    => 'required|string|exists:users,id', // Comma-separated string of team member IDs
            'team_members' => 'required|array',
            'team_members.*' => 'integer|exists:users,id',
            'start_date'      => 'required|date',
            'end_date'        => 'required|date|after_or_equal:start_date',
            'department'      => 'required|integer|in:1,2,3',
            'status'          => 'required|integer|in:1,2,3,4,5,6,7,8',
            'budget'          => 'nullable|numeric',
            'priority'        => 'required|integer||in:1,2,3',
            'type'            => 'required|integer||in:1,2',
            'estimation'      => 'required|numeric',
            'biiling_company' => 'nullable|integer',
            'description'     => 'required|string|max:200',
            'change_estimation'        => 'nullable|integer',
            'change_estimation_reason' => 'nullable|string|max:400',
        ], [
            'client.required'  => 'The client field is required.',
            'client.exists'    => 'The selected client is invalid.',

            'project_name.required' => 'The project name is required.',
            'project_name.max'      => 'The project name cannot exceed 100 characters.',

            'manager.required'  => 'The manager field is required.',
            'manager.exists'    => 'The selected manager is invalid.',

            'team_leader.required'  => 'The team leader field is required.',
            'team_leader.exists'    => 'The selected team leader is invalid.',
            'team_members.required' => 'At least one team member must be selected.',

            'start_date.required' => 'The start date is required.',
            'start_date.date'     => 'The start date must be a valid date.',
            'end_date.required'   => 'The end date is required.',
            
            'end_date.date'       => 'The end date must be a valid date.',
            'end_date.after_or_equal' => 'The end date must be after or equal to the start date.',

            'department.required' => 'The department field is required.',

            'status.required'     => 'The status field is required.',
            'status.integer'      => 'The status field is required',

            'priority.required'   => 'The priority field is required.',

            'type.required'       => 'The type field is required.',

            'estimation.required' => 'The estimation field is required.',

            'description.required' => 'The description field is required.',
            'description.max'      => 'The description cannot exceed 200 characters.',

            'project_image.image' => 'The project image must be a valid image file.',
            'project_image.mimes' => 'The project image must be of type jpeg, png, or jpg.',
            'project_image.max'   => 'The project image cannot exceed 2048KB.',
        ]);

        // Create a new Project instance
        $project = new Project();
        $project->client       = $request->client;
        $project->project_name = $request->project_name;
        $project->category     = $request->category;
        $project->manager      = $request->manager;
        $project->team_leader  = $request->team_leader;
        // $project->team_members = $request->team_members; // Comma-separated string of team member IDs
        $project->team_members = implode(',', $request->team_members);
        $project->start_date   = $request->start_date;
        $project->end_date     = $request->end_date;
        $project->department   = $request->department;
        $project->status       = $request->status;
        $project->budget       = $request->budget;
        $project->priority     = $request->priority;
        $project->type         = $request->type;
        $project->estimation   = $request->estimation;
        $project-> biiling_company  = $request->biiling_company;
        $project->description       = $request->description;
        $project->change_estimation = $request->change_estimation;
        $project->change_estimation_reason = $request->change_estimation_reason;
        $project->created_by = Auth::id();
        $project->updated_by = Auth::id();

        // Handle project image upload
        if ($request->hasFile('project_image')) {
            $fileName = time() . '.' . $request->project_image->extension();
            $filePath = public_path('images/project_profile/');

            // Ensure the directory exists
            if (!file_exists($filePath)) {
                mkdir($filePath, 0777, true);
            }

            // Move the uploaded file to the target directory
            $request->project_image->move($filePath, $fileName);
            $project->project_image = 'images/project_profile/' . $fileName; // Store relative path
        }

        

        // Save the project
        $project->save();

        // Return a response
        if ($request->ajax()) {
            return response()->json(['success' => 'Project created successfully!']);
        }

        return redirect()->back()->with('flash_success_project', 'Project added successfully.');
    }
    
    // public function edit($id)
    // {
    //     // Fetch the project with its estimation change logs and the user who made the changes
    //     $project = Project::with(['estimationChangeLogs.changedBy'])->findOrFail($id);
    //     $project->team_members = explode(',', $project->team_members); // Convert string back to array
    //     return response()->json($project); // Return project data as JSON
    // }
   
    // public function edit($id)
    // {
    //     $project = Project::with(['estimationChangeLogs.changedBy'])->findOrFail($id);

    //     // Convert stored team member IDs string into an array
    //     $teamMemberIds = explode(',', $project->team_members);

    //     // Fetch employee names using helper
    //     $employees = EmployeeHelper::getEmployeeNames();

    //     // Map IDs to names, if exists
    //     $project->team_members = array_map(function ($id) use ($employees) {
    //         return [
    //             'id' => $id,
    //             'name' => $employees[$id] ?? "Unknown" // Replace ID with name or "Unknown" if not found
    //         ];
    //     }, $teamMemberIds);

    //     return response()->json($project);
    // }
      
    public function edit($id)
    {
        $project = Project::with(['estimationChangeLogs.changedBy'])->findOrFail($id);
    
        // Convert team members string to array for Select2
        // $project->team_members = $project->team_members ? explode(',', $project->team_members) : [];
    
        return response()->json($project);
    }

    public function update(Request $request, $id)
    {
           
      
        // Fetch the employee by ID
        $project = Project::findOrFail($id);
        
        // Validate the request data
        $request->validate([
            'client'          => 'required|integer|exists:isar_clients,id',
            'project_name'    => 'required|string|max:100',
            'category'        => 'nullable|integer|in:1,2,3,4,5,6,7,8,9,10',
            'project_image'   => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'manager'         => 'required|integer|exists:users,id',
            'team_leader'     => 'required|integer|exists:users,id',
            // 'team_members'    => 'required|string|exists:users,id', // Comma-separated string of team member IDs
            // 'team_members' => 'required|array',
            //  'team_members.*' => 'integer|exists:si_users,id',
            
           'team_members' => 'required|array',
            'team_members.*' => 'integer|exists:users,id',

            'start_date'      => 'required|date',
            'end_date'        => 'required|date|after_or_equal:start_date',
            'department'      => 'required|integer|in:1,2,3',
            'status'          => 'required|integer|in:1,2,3,4,5,6,7,8',
            'budget'          => 'nullable|numeric',
            'priority'        => 'required|integer||in:1,2,3',
            'type'            => 'required|integer||in:1,2',
            'estimation'      => 'required|numeric',
            'biiling_company' => 'nullable|integer',
            'description'     => 'required|string|max:200',
            'change_estimation'        => 'nullable|integer',
            'change_estimation_reason' => 'nullable|string|max:400',
        ], [
            'client.required'  => 'The client field is required.',
            'client.exists'    => 'The selected client is invalid.',

            'project_name.required' => 'The project name is required.',
            'project_name.max'      => 'The project name cannot exceed 100 characters.',

            'manager.required'  => 'The manager field is required.',
            'manager.exists'    => 'The selected manager is invalid.',

            'team_leader.required'  => 'The team leader field is required.',
            'team_leader.exists'    => 'The selected team leader is invalid.',
            'team_members.required' => 'At least one team member must be selected.',

            'start_date.required' => 'The start date is required.',
            'start_date.date'     => 'The start date must be a valid date.',
            'end_date.required'   => 'The end date is required.',
            
            'end_date.date'       => 'The end date must be a valid date.',
            'end_date.after_or_equal' => 'The end date must be after or equal to the start date.',

            'department.required' => 'The department field is required.',

            'status.required'     => 'The status field is required.',
            
            'priority.required'   => 'The priority field is required.',

            'type.required'       => 'The type field is required.',

            'estimation.required' => 'The estimation field is required.',

            'description.required' => 'The description field is required.',
            'description.max'      => 'The description cannot exceed 200 characters.',

            'project_image.image' => 'The project image must be a valid image file.',
            'project_image.mimes' => 'The project image must be of type jpeg, png, or jpg.',
            'project_image.max'   => 'The project image cannot exceed 2048KB.',
        ]);

         // Check if estimation has changed
            if ($project->estimation != $request->estimation) {
                // Manually verify the user exists
                if (!User::where('id', Auth::id())->exists()) {
                    return response()->json(['error' => 'Invalid user'], 400);
                }

                // Create change log without foreign key constraints
                ProjectEstimationChangeLog::create([
                    'project_id' => $project->id,
                    'changed_by' => Auth::id(),
                    'changed_from' => $project->estimation,
                    'changed_to' => $request->estimation,
                    'diff' => $request->estimation - $project->estimation,
                    'reason' => $request->change_estimation_reason,
                    'created_by' => Auth::id(),
                    'updated_by' => Auth::id(),
                ]);
            }
        $project->client       = $request->client;
        $project->project_name = $request->project_name;
        $project->category     = $request->category;
        $project->manager      = $request->manager;
        $project->team_leader  = $request->team_leader;
        // $project->team_members = is_array($request->team_members) 
        // ? implode(',', $request->team_members) 
        // : $request->team_members; // If it's already a string, just assign it directly
        // $project->team_members = implode(',', $request->team_members);
        $project->team_members = $request->team_members ? implode(',', $request->team_members) : null;
    
        $project->start_date   = $request->start_date;
        $project->end_date     = $request->end_date;
        $project->department   = $request->department;
        $project->status       = $request->status;
        $project->budget       = $request->budget;
        $project->priority     = $request->priority;
        $project->type         = $request->type;
        $project->estimation   = $request->estimation;
        $project->change_estimation_reason = $request->change_estimation_reason ;
        $project-> biiling_company  = $request->biiling_company;
        $project->description       = $request->description;
        $project->change_estimation = $request->change_estimation;
        $project->change_estimation_reason = $request->change_estimation_reason;
        $project->updated_by = Auth::id();

        // Handle project image upload
        if ($request->hasFile('project_image')) {
            $fileName = time() . '.' . $request->project_image->extension();
            $filePath = public_path('images/project_profile/');

            // Ensure the directory exists
            if (!file_exists($filePath)) {
                mkdir($filePath, 0777, true);
            }

            // Move the uploaded file to the target directory
            $request->project_image->move($filePath, $fileName);
            $project->project_image = 'images/project_profile/' . $fileName; // Store relative path
        }

        $project->save();

       // Save the updated employee data
       if ($request->ajax()) {
        return response()->json(['success' => 'Project updated successfully!']);
       }
       
       return redirect()->back()->with('flash_success_edit', 'Project updated successfully.');

    }

        // DELETE SINGLE PROJECT INFORMATION - AUTH - RI - 06-03-2025
        public function destroy($id)
        {
            $project = Project::findOrFail($id); // Find the PROJECT by ID
            $project->delete(); // Delete the project
    
            return response()->json(['success' => true, 'message' => 'Project deleted successfully.']);
        }
    
        
        
        
        public function tasks()
        {
            // Fetch project details
            // $project = Project::findOrFail($id);
        
            // Fetch tasks related to the project
            // $tasks = Task::where('project_id', $id)->get();
        
            // Pass data to the view
            return view('backend.project.tasks');
        }
        

    public function timesheet(){
        return view('backend.project.timesheet');
    }
    public function leaders(){
        return view('backend.project.leaders');
    }

    

     // Fetched under TaskController for workedhrs field 
    public function getWorkedHours($projectId)
    {
        return DB::table('si_daily_report_fields')
            ->select('users.name as employee', DB::raw('SUM(si_daily_report_fields.hrs) as spent_hrs'))
            ->join('users', 'si_daily_report_fields.user_id', '=', 'users.id')
            ->where('si_daily_report_fields.project_id', $projectId)
            ->where('si_daily_report_fields.type', 1) // Only type=1 for hours calculation
            ->groupBy('si_daily_report_fields.user_id', 'users.name')
            ->get();
    }



}