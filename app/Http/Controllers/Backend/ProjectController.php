<?php

namespace App\Http\Controllers\Backend;

use App\Models\Backend\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Backend\ProjectEstimationChangeLog;
use App\Models\Backend\Task;


class ProjectController
{
    //
    public function index(){

        $projects = Project::all();
        $activeProjects = Project::where('status', '!=', 6)->get(); // Fetch only active projects
        $onBoardProjects = Project::where('status', 1)->get(); // onboard projects (status = 1)
        $openProjects = Project::where('status', 2)->get(); 
        $progressProjects = Project::where('status', 3)->get(); 
        $monitorProjects = Project::where('status', 4)->get(); 
        $billingProjects = Project::where('status', 5)->get(); 
        $onHoldProjects = Project::where('status', 7)->get(); 
        $warrantyProjects = Project::where('status', 8)->get();
        $closedProjects = Project::where('status', 6)->get(); 

        // Department tab
        $webApplicationProjects = Project::where('department', 1)
        ->where('status', '!=', 6)->get(); 
    
        $websiteProjects = Project::where('department', 2)
        ->where('status', '!=', 6)->get();
        
        $graphicsProjects = Project::where('department', 3)
        ->where('status', '!=', 6)->get();

        // Project Count
        $totalProjects = Project::getTotalProjects(); // Call model method
    
        

        return view('backend.project.index', 
        compact('projects', 'activeProjects','onBoardProjects','openProjects', 
        'progressProjects', 'monitorProjects', 'billingProjects', 'onHoldProjects', 'warrantyProjects',
        'closedProjects','webApplicationProjects', 'websiteProjects', 'graphicsProjects', 'totalProjects'));
    }

    public function manage(Request $request)
    {
        $query = Project::query();

        // Apply filters based on search parameters
        if ($request->has('status') && $request->status != 'None') {
            $query->where('si_projects.status', $request->status); // Specify table name
        }

        if ($request->has('assigned_to') && $request->assigned_to != '') {
            $query->where('si_projects.manager', $request->assigned_to); // Specify table name
        }

        if ($request->has('department') && $request->department != 'None') {
            $query->where('si_projects.department', $request->department); // Specify table name
        }

        // Fetch projects with necessary joins and paginate the results
        $projectsmanage = $query->leftJoin('isar_clients', 'si_projects.client', '=', 'isar_clients.id')
            ->leftJoin('si_users', 'si_projects.manager', '=', 'si_users.id')
            ->select(
                'si_projects.*',
                'isar_clients.client_name as client_name', // Corrected column name
                'si_users.name as manager_name'
            )
            ->paginate(10); // Use paginate() instead of get()

        // Count total projects dynamically
        $totalProjectscount = $projectsmanage->total();

            // Fetch filtered projects
            $projects = $query->get();
        

        return view('backend.project.manage', compact('projectsmanage', 'totalProjectscount', 'projects'));
    }
    

    public function store(Request $request)
   {
   
        // Validate the request data
        $request->validate([
            'client'          => 'required|integer|exists:isar_clients,id',
            'project_name'    => 'required|string|max:100',
            'category'        => 'nullable|integer|in:1,2,3,4,5,6,7,8,9,10',
            'project_image'   => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'manager'         => 'required|integer|exists:si_users,id',
            'team_leader'     => 'required|integer|exists:si_users,id',
            'team_members'    => 'required|string|exists:si_users,id', // Comma-separated string of team member IDs
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
        $project->team_members = $request->team_members; // Comma-separated string of team member IDs
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

        return redirect()->back()->with('success', 'Project created successfully!');
    }
    
    public function edit($id)
    {
        // Fetch the project with its estimation change logs and the user who made the changes
        $project = Project::with(['estimationChangeLogs.changedBy'])->findOrFail($id);
        $project->team_members = explode(',', $project->team_members); // Convert string back to array
        return response()->json($project); // Return project data as JSON
    }

    public function update(Request $request, $id){

        // Fetch the employee by ID
        $project = Project::findOrFail($id);
        
        // Validate the request data
        $request->validate([
            'client'          => 'required|integer|exists:isar_clients,id',
            'project_name'    => 'required|string|max:100',
            'category'        => 'nullable|integer|in:1,2,3,4,5,6,7,8,9,10',
            'project_image'   => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'manager'         => 'required|integer|exists:si_users,id',
            'team_leader'     => 'required|integer|exists:si_users,id',
            'team_members'    => 'required|string|exists:si_users,id', // Comma-separated string of team member IDs
            // 'team_members' => 'required|array',
            //  'team_members.*' => 'integer|exists:si_users,id',

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

          // Check if the estimation has changed
         if ($project->estimation != $request->estimation) {
            // Create a new entry in the project_estimation_change_log table
            ProjectEstimationChangeLog::create([
                'project_id'   => $project->id,
                'changed_by'   => Auth::id(),
                'changed_from' => $project->estimation,
                'changed_to'   => $request->estimation,
                'diff'         => $request->estimation - $project->estimation,
                'reason'       => $request->change_estimation_reason,
                'created_by'   => Auth::id(), 
                'updated_by'   => Auth::id(), // Add this line to set the updated_by field
            ]);
        }    
        $project->client       = $request->client;
        $project->project_name = $request->project_name;
        $project->category     = $request->category;
        $project->manager      = $request->manager;
        $project->team_leader  = $request->team_leader;
        $project->team_members = is_array($request->team_members) 
        ? implode(',', $request->team_members) 
        : $request->team_members; // If it's already a string, just assign it directly
    
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

}
