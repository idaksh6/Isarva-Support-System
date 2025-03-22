<?php

namespace App\Http\Controllers\Backend;

use App\Models\Backend\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Backend\ProjectEstimationChangeLog;
use App\Models\Backend\Task;
use App\Models\Backend\ProjectInternalDocument;
use App\Models\Backend\ProjectAsset;

class TaskController
{

    // public function tasks()
    //     {
    //         // Fetch project details
    //         // $project = Project::findOrFail($id);
        
    //         // Fetch tasks related to the project
    //         // $tasks = Task::where('project_id', $id)->get();
        
    //         // Pass data to the view
    //         return view('backend.project.tasks', ['project' => null]); // Ensures $project exists in view
    //     }

    // Main task

    public function tasks()
   {
    // Fetch tasks (if needed)
    $alltasks = Task::all(); // Or any other logic to fetch tasks

    // Pass data to the view
    return view('backend.project.tasks', [
        'project' => null, // Ensures $project exists in view
        'tasks' => $alltasks, // Pass tasks to the view
        'internalDocs' => collect(), // Ensure internalDocs is always available
    ]);
   }

        // public function tasksByProject($id)
        // {
        //     $project = Project::findOrFail($id); // Fetch project details
        //     return view('backend.project.tasks', compact('id','project'));
        // }

        public function tasksByProject($id)
        {
            $project = Project::find($id);
        
            if (!$project) {
                abort(404, 'Project not found');
            }
        
            // Fetch only tasks related to the project
            $tasks = Task::where('project_id', $id)->get();
        
            // Group tasks **by status** only for this project
            $tasksByStatus = $tasks->groupBy('status');
        
            // Fetch related data
            $internalDocs = ProjectInternalDocument::where('project_id', $id)->orderBy('raw_index')->get();
            $assets = ProjectAsset::where('project_id', $id)->get();
        
            // Fetch uploaded files for the project
            $uploadedFiles = ProjectAsset::where('project_id', $id)->get();
        
            return view('backend.project.tasks', compact('project', 'tasksByStatus', 'tasks', 'uploadedFiles', 'internalDocs', 'assets'));
        }
        
        

  
    public function store(Request $request)
    {
            $request->validate([
             // name attribute => validation
            'project_id' => 'required|integer|exists:si_projects,id', // hidden
            'task_name' => 'required|string|max:255',
            'task_description' => 'required|string',
            'task_end_date' => 'required|date',
            'task_assigned_for' => 'required|integer|exists:si_users,id',
            'task_estimation_hr' => 'required|numeric|min:0',
        ], [
            // Custom error messages
            'task_name.required' => 'The task name is required.',
            'task_name.string' => 'The task name must be a valid string.',
            'task_name.max' => 'The task name must not exceed 255 characters.',

            'task_description.required' => 'The description is required.',
            'task_description.string' => 'The description must be a valid string.',

            'task_end_date.required' => 'The end date is required.',
            'task_end_date.date' => 'The end date must be a valid date.',

            'task_assigned_for.required' => 'Please select an assigned user.',
            'task_assigned_for.integer' => 'The assigned user must be a valid ID.',
            'task_assigned_for.exists' => 'The selected assigned user does not exist.',

            'task_estimation_hr.required' => 'Estimation hours are required.',
            'task_estimation_hr.numeric' => 'Estimation hours must be a valid number.',
            'task_estimation_hr.min' => 'Estimation hours must be at least 0.',
        ]);

        $task = new Task();
        // Column-name = name_attribute
        $task->project_id = $request->project_id;
        $task->task_name = $request->task_name;
        $task->task_category = $request->task_category;
        $task->description = $request->task_description;
        $task->end_date = $request->task_end_date;
        $task->status = $request->task_status ?? 1; // If null, default to 1
        $task->assigned_to = $request->task_assigned_for;
        $task->estimation_hrs = $request->task_estimation_hr;
        $task->created_by = Auth::id();
        $task->updated_by = Auth::id();

        $task->save();

          // Return a response
          if ($request->ajax()) {
            return response()->json(['success' => 'Task created successfully!']);
        }

    }

        //  public function edit($id)
        // {
        //     $task = Task::find($id);

        //     if (!$task) {
        //         return response()->json(['success' => false, 'message' => 'Task not found'], 404);
        //     }

        //     return response()->json([
        //         'success' => true,
        //         'task' => [
        //             'task_name' => $task->task_name,
        //             'task_category' => $task->task_category,
        //             'description' => $task->description,
        //             'end_date' => $task->end_date ? $task->end_date->format('Y-m-d') : null, // Format the date
        //             'task_assigned_for' => $task->assigned_to,
        //             'estimation_hrs' => $task->estimation_hrs,
        //         ]
        //     ]);
        // }

        public function edit($id)
        {
            $task = Task::find($id);

            if (!$task) {
                return response()->json(['success' => false, 'message' => 'Task not found'], 404);
            }

            return response()->json([
                'success' => true,
                'task' => [
                    'id' => $task->id, // Include task ID
                    'project_id' => $task->project_id, // Include project ID
                    'task_name' => $task->task_name,
                    'task_category' => $task->task_category,
                    'description' => $task->description,
                    'end_date' => $task->end_date,
                    'task_assigned_for' => $task->assigned_to,
                    'estimation_hrs' => $task->estimation_hrs,
                ]
            ]);
        }
    // public function update(Request $request, $id)
    // {
    //    $request->validate([
    //          // name attribute => validation
    //         'project_id' => 'required|integer|exists:si_projects,id', // hidden
    //         'task_name' => 'required|string|max:255',
    //         'task_description' => 'required|string',
    //         'task_end_date' => 'required|date',
    //         'task_assigned_for' => 'required|integer|exists:si_users,id',
    //         'task_estimation_hr' => 'required|numeric|min:0',
    //     ], [
    //         // Custom error messages
    //         'task_name.required' => 'The task name is required.',
    //         'task_name.string' => 'The task name must be a valid string.',
    //         'task_name.max' => 'The task name must not exceed 255 characters.',

    //         'task_description.required' => 'The description is required.',
    //         'task_description.string' => 'The description must be a valid string.',

    //         'task_end_date.required' => 'The end date is required.',
    //         'task_end_date.date' => 'The end date must be a valid date.',

    //         'task_assigned_for.required' => 'Please select an assigned user.',
    //         'task_assigned_for.integer' => 'The assigned user must be a valid ID.',
    //         'task_assigned_for.exists' => 'The selected assigned user does not exist.',

    //         'task_estimation_hr.required' => 'Estimation hours are required.',
    //         'task_estimation_hr.numeric' => 'Estimation hours must be a valid number.',
    //         'task_estimation_hr.min' => 'Estimation hours must be at least 0.',
    //     ]);

    //     $task = Task::find($id);

    //     if (!$task) {
    //         return response()->json(['error' => 'Task not found'], 404);
    //     }

    //     $task->update([
    //         'task_name' => $request->task_name,
    //         'task_description' => $request->description,
    //         'task_category' => $request->task_category,
    //         'task_assigned_for' => $request->assigned_to,
    //         'start_date' => $request->start_date,
    //         'end_date' => $request->end_date,
    //         'status' => $request->status,
    //         'updated_by' => Auth::id(), // Track who updated the task
    //     ]);

    //     return response()->json(['success' => 'Task updated successfully']);
    // }


    public function update(Request $request, $id)
    {
        // dd($request->all());
    // Fetch the task by ID
    $task = Task::findOrFail($id);

    // Validation
    $request->validate([
        'project_id' => 'required|integer|exists:si_projects,id', // Ensure project_id is required
        'task_id' => 'required|integer|exists:si_tasks,id', // Ensure task_id is required
        'task_name' => 'required|string|max:255',
        'task_description' => 'required|string',
        'task_end_date' => 'required|date',
        'task_assigned_for' => 'required|integer|exists:si_users,id',
        'task_estimation_hr' => 'required|numeric|min:0',
    ], [
        'task_name.required' => 'The task name is required.',
        'task_name.string' => 'The task name must be a valid string.',
        'task_name.max' => 'The task name must not exceed 255 characters.',

        'task_description.required' => 'The description is required.',
        'task_description.string' => 'The description must be a valid string.',

        'task_end_date.required' => 'The end date is required.',
        'task_end_date.date' => 'The end date must be a valid date.',

        'task_assigned_for.required' => 'Please select an assigned user.',
        'task_assigned_for.integer' => 'The assigned user must be a valid ID.',
        'task_assigned_for.exists' => 'The selected assigned user does not exist.',

        'task_estimation_hr.required' => 'Estimation hours are required.',
        'task_estimation_hr.numeric' => 'Estimation hours must be a valid number.',
        'task_estimation_hr.min' => 'Estimation hours must be at least 0.',
    ]);

    // Update Task Details
    $task->project_id = $request->project_id;
    $task->task_name = $request->task_name;
    $task->task_category = $request->task_category;
    $task->description = $request->task_description;
    $task->end_date = $request->task_end_date;
    $task->status = $request->task_status ?? $task->status; // Keep existing status if not provided
    $task->assigned_to = $request->task_assigned_for;
    $task->estimation_hrs = $request->task_estimation_hr;
    $task->updated_by = Auth::id();

    $task->save();

    // Return response
    if ($request->ajax()) {
        return response()->json(['success' => 'Task updated successfully!']);
    }

    return redirect()->back()->with('success', 'Task updated successfully!');
}



    // Internal Docs store method
    public function storeInternalDoc(Request $request)
        {
            $request->validate([
                'project_id' => 'required|integer|exists:si_projects,id',
                'id' => 'nullable|array',
                'id.*' => 'nullable|integer|exists:si_project_internal_documents,id',
                'date' => 'required|array',
                'date.*' => 'required|date',
                'title' => 'required|array',
                'title.*' => 'required|string|max:255',
                'link' => 'nullable|array',
                'link.*' => 'nullable|string|max:255',
                'comments' => 'nullable|array',
                'comments.*' => 'nullable|string|max:255',
                'deleted_ids' => 'nullable|array',
                'deleted_ids.*' => 'nullable|integer|exists:si_project_internal_documents,id',
            ]);

            $projectId = $request->input('project_id');
            $ids = $request->input('id', []);
            $dates = $request->input('date');
            $titles = $request->input('title');
            $links = $request->input('link', []);
            $comments = $request->input('comments', []);
            $deletedIds = $request->input('deleted_ids', []);
            $createdBy = Auth::id();
            $updatedBy = Auth::id();

            // Delete rows that have been marked as deleted
            if (!empty($deletedIds)) {
                ProjectInternalDocument::whereIn('id', $deletedIds)->delete();
            }

            // Update or create remaining rows
            foreach ($dates as $index => $date) {
                $data = [
                    'project_id' => $projectId,
                    'date' => $date,
                    'title' => $titles[$index],
                    'link' => $links[$index] ?? null,
                    'comments' => $comments[$index] ?? null,
                    'raw_index' => $index + 1,
                    'updated_by' => $updatedBy,
                ];

                if (!empty($ids[$index])) {
                    // Update existing row
                    ProjectInternalDocument::where('id', $ids[$index])->update($data);
                } else {
                    // Insert new row
                    $data['created_by'] = $createdBy;
                    ProjectInternalDocument::create($data);
                }
            }

            return redirect()->back()->with('flash_success_docs', 'Internal documents saved successfully.');
        }

   //  if there is more issue after updating then uncomment this this works somewhat fine

    // public function storeInternalDoc(Request $request)
    //     {
    //         $request->validate([
    //             'project_id' => 'required|integer|exists:si_projects,id',
    //             'id' => 'nullable|array',
    //             'id.*' => 'nullable|integer|exists:si_project_internal_documents,id',
    //             'date' => 'required|array',
    //             'date.*' => 'required|date',
    //             'title' => 'required|array',
    //             'title.*' => 'required|string|max:255',
    //             'link' => 'nullable|array',
    //             'link.*' => 'nullable|string|max:255',
    //             'comments' => 'nullable|array',
    //             'comments.*' => 'nullable|string|max:255',
    //         ]);

    //         $projectId = $request->input('project_id');
    //         $ids = $request->input('id', []);
    //         $dates = $request->input('date');
    //         $titles = $request->input('title');
    //         $links = $request->input('link', []);
    //         $comments = $request->input('comments', []);
    //         $createdBy = Auth::id();
    //         $updatedBy = Auth::id();

    //         foreach ($dates as $index => $date) {
    //             $data = [
    //                 'project_id' => $projectId,
    //                 'date' => $date,
    //                 'title' => $titles[$index],
    //                 'link' => $links[$index] ?? null,
    //                 'comments' => $comments[$index] ?? null,
    //                 'raw_index' => $index + 1,
    //                 'updated_by' => $updatedBy,
    //             ];

    //             if (!empty($ids[$index])) {
    //                 // Update existing row
    //                 ProjectInternalDocument::where('id', $ids[$index])->update($data);
    //             } else {
    //                 // Insert new row
    //                 $data['created_by'] = $createdBy;
    //                 ProjectInternalDocument::create($data);
    //             }
    //         }

    //         return redirect()->back()->with('flash_success_docs', 'Internal documents saved successfully.');
    //       
    //     }



        // Drag and Drop Status Update code
        public function updateStatus(Request $request)
        {
            $task = Task::find($request->task_id);
            
            if ($task) {
                $task->status = $request->status;
                $task->save();
            
                return response()->json(['success' => true, 'message' => 'Task status updated!']);
            } else {
                return response()->json(['success' => false, 'message' => 'Task not found.'], 404);
            }
        }
                


    // Store function for task asset section
    public function storeasset(Request $request)
    {
        // Validate the request
        $request->validate([
            'assets' => 'required|array',
            'assets.*' => 'file|mimes:jpeg,jpg,png,pdf|max:2048', // Adjust max file size as needed
            'project_id' => 'required|exists:si_projects,id', // Ensure the project exists
        ]);

        // Get the authenticated user's ID
        $userId = Auth::id();

        $uploadedFiles = [];

        // Loop through each uploaded file
        foreach ($request->file('assets') as $file) {
            // Determine the file type
            $extension = strtolower($file->getClientOriginalExtension());
            $isImage = in_array($extension, ['jpeg', 'jpg', 'png']) ? 1 : 2;

            // Store the file in the public/images/taskasset_files directory
            $filePath = $file->store('public/images/taskasset_files');
            $publicFilePath = str_replace('public/', '', $filePath);

            // Save the file details in the database
            $projectAsset = ProjectAsset::create([
                'project_id' => $request->project_id,
                'user_id' => $userId,
                'image_path' => $publicFilePath,
                'filename' => $file->getClientOriginalName(),
                'is_image' => $isImage,
                'uploaded_time' => now(),
                'created_by' => $userId,
                'updated_by' => $userId,
            ]);

            // Add the uploaded file to the array
            $uploadedFiles[] = $projectAsset;
        }

        
        // return response()->json([
        //     'success' => true,
        //     'message' => 'Files uploaded successfully.',
        // ]);
        return redirect()->back()
        ->with('flash_success_asset', 'Files uploaded successfully.')
        ->with('uploaded_files', $uploadedFiles);

    }


     // Method to fetch uploaded files for a project (AJAX)
     public function fetchUploadedFiles($project_id)
     {
         // Fetch the uploaded files for the project
         $assets = ProjectAsset::where('project_id', $project_id)->get();
 
         // Return only the HTML for the uploaded files section
         return view('admin.project.tasks', compact('assets'))->render();
     }
}

