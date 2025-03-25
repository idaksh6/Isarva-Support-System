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

class DailyReportController extends Controller
{
    //
    public function index(){

        

        return view('backend.daily_report.dailyreport');
    }

  

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


    
    public function store(Request $request)
    {
        // Validate request
        $request->validate([
            'project_name'   => 'required|array|min:1',
            'project_name.*' => 'required|string|max:255',
            'task_name'      => 'required|array|min:1',
            'task_name.*'    => 'required|string|max:255',
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
    
        // Extract all container data
        $containerData = [];
        foreach ($request->get('project_name') as $uniqueId => $projectName) {
            $containerData[] = [
                'project_id'     => $request->get('project_id')[$uniqueId],
                'task_id'        => $request->get('task_id')[$uniqueId],
                'user_id'        => Auth::id(),
                'project_name'   => $projectName,
                'task_name'      => $request->get('task_name')[$uniqueId],
                'type'           => $request->get('type')[$uniqueId],
                'comments'       => $request->get('comments')[$uniqueId],
                'hrs'            => $request->get('hrs')[$uniqueId],
                'link'           => $request->get('link')[$uniqueId],
                'billable'       => $request->get('billable')[$uniqueId],
            ];
        }
    
        DB::beginTransaction(); // Start DB transaction
    
        // Insert into `si_daily_report`
        $dailyReport = new DailyReport();
        $dailyReport->user_id        = Auth::id();
        $dailyReport->total_time     = array_sum(array_column($containerData, 'hrs')); // Sum of all hours
        $dailyReport->overall_status = $request->get('overall_status');
        $dailyReport->created_by     = Auth::id();
        $dailyReport->updated_by     = Auth::id();
        $dailyReport->save();
    
        $dailyReportId = $dailyReport->id; // Get inserted `daily_report_id`
    
        // Insert into `si_daily_report_fields` for each container
        foreach ($containerData as $data) {
            $dailyReportField = new DailyReportField();
            $dailyReportField->daily_report_id = $dailyReportId;
            $dailyReportField->user_id         = Auth::id();
            $dailyReportField->type            = $data['type'];
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
    
      // Fetch data for email
        $reportData = DailyReportField::where('daily_report_id', $dailyReportId)->get();
        $overallStatus = $dailyReport->overall_status; // Fetch overall status
        $totalTime = $dailyReport->total_time;

        // Prepare data for email
        $emailData = [
            'reportData' => $reportData,
            'overallStatus' => $overallStatus, // Pass overall status to the email
            'totalTime' => $totalTime
        ];

        // Send email
        Mail::to('saikiran@idaksh.in')->send(new DailyReportMail($emailData));
    
        return redirect()->back()->with('flash_success_dailyreport', 'Daily Report added successfully.');
    }
      

}
