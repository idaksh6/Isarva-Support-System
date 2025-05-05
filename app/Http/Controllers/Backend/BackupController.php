<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\ProjectHelper;
use App\Helpers\TicketHelper;
use App\Models\Backend\Project;
use App\Models\Backend\Ticket;
use App\Models\Backend\Backup;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon; 

class BackupController extends Controller
{

    // public function index()
    // {
    //     $projects = ProjectHelper::getProjectNames();
    //     $tickets = TicketHelper::getTicketNames();

    //     // Fetch backups: Group by domain and get latest backup
    //     $backups = Backup::select(
    //             'id',
    //             'domain',
    //             'backup_type',
    //             'present_ip',
    //             'last_backup_file_name',
    //             'last_backup_location',
    //             'php_version',
    //             'framework_version',
    //             'wordpress_version',
    //             'drive_link',
    //             'created_at',
    //             'updated_at'
    //         )
    //         // ->orderBy('updated_at', 'desc')
    //         // ->distinct('domain')  // Get only unique domains // Apply group by on the query, ensuring unique domains
    //         // ->paginate(5);  // Paginate results with 30 items per page

    //         ->orderBy('updated_at', 'desc')
    //         ->get()
    //         // ->paginate(5)  // Paginate results with 30 items per page
    //         ->unique('domain')  // Only unique domains
    //         ->values();         // Reset keys

    //     return view('backend.backup.manage', compact('projects', 'tickets', 'backups'));
    // }

    // WORKS FINE 
    // public function index(Request $request)
    // {
    //     $projects = ProjectHelper::getProjectNames();
    //     $tickets = TicketHelper::getTicketNames();
    
    //     // Base query remains the same
    //     $backups = Backup::select(
    //             'id',
    //             'domain',
    //             'backup_type',
    //             'present_ip',
    //             'last_backup_file_name',
    //             'last_backup_location',
    //             'php_version',
    //             'framework_version',
    //             'wordpress_version',
    //             'drive_link',
    //             'created_at',
    //             'updated_at'
    //         )
    //         ->when($request->search, function($query) use ($request) {
    //             $query->where(function($q) use ($request) {
    //                 $q->where('domain', 'like', '%'.$request->search.'%')
    //                   ->orWhere('present_ip', 'like', '%'.$request->search.'%');
    //             });
    //         })
    //         ->orderBy('updated_at', 'desc')
    //         ->get()
    //         ->map(function ($backup) {
    //             // Add backup type name to each backup
    //             $backup->backup_type_name = $this->getBackupTypeName($backup->backup_type);
    //             return $backup;
    //         })
    //         ->unique('domain')
    //         ->values();
    
    //     return view('backend.backup.manage', compact('projects', 'tickets', 'backups'));
    // }
    public function index(Request $request)
    {
        $projects = ProjectHelper::getProjectNames();
        $tickets = TicketHelper::getTicketNames();
    
        $query = Backup::select('si_backups.*')
            ->join(DB::raw('(SELECT group_id, MAX(updated_at) as latest FROM si_backups GROUP BY group_id) as latest_backups'), 
                function($join) {
                    $join->on('si_backups.group_id', '=', 'latest_backups.group_id')
                        ->on('si_backups.updated_at', '=', 'latest_backups.latest');
                })
            ->when($request->search, function($query) use ($request) {
                $query->where(function($q) use ($request) {
                    $q->where('si_backups.domain', 'like', '%'.$request->search.'%')
                      ->orWhere('si_backups.present_ip', 'like', '%'.$request->search.'%');
                });
            })
            ->orderBy('si_backups.updated_at', 'desc');
    
        $backups = $query->paginate(10)
            ->through(function ($backup) {
                $backup->created_at = $backup->created_at ? Carbon::parse($backup->created_at) : null;
                $backup->updated_at = $backup->updated_at ? Carbon::parse($backup->updated_at) : null;
                $backup->backup_type_name = $this->getBackupTypeName($backup->backup_type);
                return $backup;
            });
    
        return view('backend.backup.manage', compact('projects', 'tickets', 'backups'));
    }
    
    // Add this helper method to your controller
    protected function getBackupTypeName($type)
    {
        $types = [
            1 => 'Website Code',
            2 => 'Application Code',
            3 => 'Website + App Code',
            4 => 'Database File',
            5 => 'Website + DB File',
            6 => 'App + DB File',
            7 => 'Website + App + DB',
            8 => 'Graphics File'
        ];
        
        return $types[$type] ?? 'Unknown';
    }

    // public function searchBackups(Request $request)
    // {
    //     $searchTerm = $request->input('search');
        
    //     $backups = $this->getBaseBackupQuery()
    //         ->when($searchTerm, function ($query) use ($searchTerm) {
    //             $query->where(function($q) use ($searchTerm) {
    //                 $q->where('domain', 'like', "%{$searchTerm}%")
    //                 ->orWhere('present_ip', 'like', "%{$searchTerm}%");
    //             });
    //         })
    //         ->get()
    //         ->map(function ($backup) {
    //             $backup->backup_type_name = $this->getBackupTypeName($backup->backup_type);
    //             return $backup;
    //         })
    //         ->unique('domain')
    //         ->values();

    //     return view('backend.backup.manage', [
    //         'backups' => $backups,
    //         'projects' => ProjectHelper::getProjectNames(),
    //         'tickets' => TicketHelper::getTicketNames()
    //     ]);
    // }
    public function searchBackups(Request $request)
    {
        $projects = ProjectHelper::getProjectNames();
        $tickets = TicketHelper::getTicketNames();
    
        $backups = Backup::select('si_backups.*')
            ->join(DB::raw('(SELECT domain, MAX(updated_at) as latest FROM si_backups GROUP BY domain) as latest_backups'), 
                function($join) {
                    $join->on('si_backups.domain', '=', 'latest_backups.domain')
                        ->on('si_backups.updated_at', '=', 'latest_backups.latest');
                })
            ->where(function($query) use ($request) {
                $query->where('si_backups.domain', 'like', '%'.$request->search.'%')
                      ->orWhere('si_backups.present_ip', 'like', '%'.$request->search.'%');
            })
            ->orderBy('si_backups.updated_at', 'desc')
            ->paginate(30)
            ->through(function ($backup) {
                // Convert string dates to Carbon instances
                $backup->created_at = $backup->created_at ? Carbon::parse($backup->created_at) : null;
                $backup->updated_at = $backup->updated_at ? Carbon::parse($backup->updated_at) : null;
                $backup->backup_type_name = $this->getBackupTypeName($backup->backup_type);
                return $backup;
            });

        
    
        return view('backend.backup.manage', [
            'backups' => $backups,
            'projects' => $projects,
            'tickets' => $tickets,
            'search' => $request->search
           
        ]);
    }

    // protected function getBaseBackupQuery()
    // {
    //     return Backup::select(
    //             'id',
    //             'domain',
    //             'backup_type',
    //             'present_ip',
    //             'last_backup_file_name',
    //             'last_backup_location',
    //             'php_version',
    //             'framework_version',
    //             'wordpress_version',
    //             'created_at',
    //             'updated_at'
    //         )
    //         ->orderBy('updated_at', 'desc');
    // }
   
    protected function getBaseBackupQuery()
    {
        return Backup::select('backups.*')
            ->join(DB::raw('(SELECT domain, MAX(updated_at) as latest FROM backups GROUP BY domain) as latest_backups'), 
                function($join) {
                    $join->on('backups.domain', '=', 'latest_backups.domain')
                        ->on('backups.updated_at', '=', 'latest_backups.latest');
                })
            ->orderBy('backups.updated_at', 'desc');
    }

    public function create()
    {
        $projects = ProjectHelper::getProjectNames();
        $tickets = TicketHelper::getTicketNames();

        return view('backend.backup.create', compact('projects', 'tickets'));
    }


    // public function store(Request $request)
    // {
    //     // Validate the form data
    //     // $request->validate([
    //     //     'type' => 'required|in:1,2',  // Ensure the type is either 1 (Project) or 2 (Ticket)
    //     //     'domain' => 'required|string|max:255',
    //     //     'present_ip' => 'required|string|max:100',
    //     //     'last_backup_file' => 'required|string|max:500',
    //     //     'last_backup_date' => 'required|date',
    //     //     'last_backup_location' => 'required|string|max:500',
    //     //     'backup_type' => 'required|integer',
    //     //     'site_status' => 'required|integer',
          
    //     // ],[

    //     // ]);
    //      // Validate the form data
    //     $request->validate([
    //         'type' => 'required|in:1,2',
    //         'project_id' => 'required_if:type,1',
    //         'ticket_id' => 'required_if:type,2',
    //         'domain' => 'required|string|max:255',
    //         'present_ip' => 'required|string|max:100',
    //         'last_backup_file' => 'required|string|max:500',
    //         'last_backup_date' => 'required|date',
    //         'last_backup_location' => 'required|string|max:500',
    //         'backup_type' => 'required|integer|between:1,8',
    //         'site_status' => 'required|integer|between:1,4',
    //         'wordpress_version' => 'nullable|string|max:50',
    //         'php_version' => 'nullable|string|max:50',
    //         'framework_version' => 'nullable|string|max:50',
    //         'drive_link' => 'nullable|url|max:255',
    //         'description' => 'nullable|string|max:1000'
    //     ],[
    //         'type.required' => 'Please select Project or Ticket',
    //         'type.in' => 'Invalid selection for Project/Ticket',
    //         'project_id.required_if' => 'Please select a project',
    //         'ticket_id.required_if' => 'Please select a ticket',
    //         'domain.required' => 'Domain is required',
    //         'domain.max' => 'Domain cannot be longer than 255 characters',
    //         'present_ip.required' => 'Present IP is required',
    //         'present_ip.max' => 'Present IP cannot be longer than 100 characters',
    //         'last_backup_file.required' => 'Last backup file name is required',
    //         'last_backup_file.max' => 'Last backup file name cannot be longer than 500 characters',
    //         'last_backup_date.required' => 'Last backup date is required',
    //         'last_backup_date.date' => 'Please enter a valid date',
    //         'last_backup_location.required' => 'Last backup location is required',
    //         'last_backup_location.max' => 'Last backup location cannot be longer than 500 characters',
    //         'backup_type.required' => 'Backup type is required',
    //         'backup_type.between' => 'Invalid backup type selected',
    //         'site_status.required' => 'Site status is required',
    //         'site_status.between' => 'Invalid site status selected',
    //         'wordpress_version.max' => 'WordPress version cannot be longer than 50 characters',
    //         'php_version.max' => 'PHP version cannot be longer than 50 characters',
    //         'framework_version.max' => 'Framework version cannot be longer than 50 characters',
    //         'drive_link.url' => 'Please enter a valid URL for the drive link',
    //         'drive_link.max' => 'Drive link cannot be longer than 255 characters',
    //         'description.max' => 'Description cannot be longer than 1000 characters'
    //     ]);
    
    //     // Get the form values
    //     $type = $request->input('type'); // Project or Ticket (1 or 2)
    //     $project_ticket_id = $request->input('type') == 1 ? $request->input('project_id') : $request->input('ticket_id');
        
    //     // Get the project/ticket name based on selected ID
    //     $project_ticket_name = null;
    //     if ($type == 1 && $project_ticket_id) {
    //         $project_ticket_name = Project::find($project_ticket_id)?->project_name; // Project name
    //     } elseif ($type == 2 && $project_ticket_id) {
    //         $project_ticket_name = Ticket::find($project_ticket_id)?->title; // Ticket title
    //     }
    
    //     // Store the backup record
    //     $backup = new Backup([
    //         'project_ticket'        => $type,  // Save type: 1 for Project, 2 for Ticket
    //         'project_ticket_id'     => $project_ticket_id,  // Store the selected Project/Ticket ID
    //         'domain'                => $request->input('domain'),
    //         'present_ip'            => $request->input('present_ip'),
    //         'last_backup_file_name' => $request->input('last_backup_file'),
    //         'last_backup_date'      => $request->input('last_backup_date'),
    //         'last_backup_location'  => $request->input('last_backup_location'),
    //         'backup_type'           => $request->input('backup_type'),
    //         'wordpress_version'     => $request->input('wordpress_version'),
    //         'php_version'           => $request->input('php_version'),
    //         'framework_version'     => $request->input('framework_version'),
    //         'drive_link'            => $request->input('drive_link'),
    //         'site_status'           => $request->input('site_status'),
    //         'description'           => $request->input('description'),
         
    //     ]);
        
    //     // Save the backup record to the database
    //     $backup->save();
    
    //     // Redirect with a success message
    //     return redirect()->back()->with('flash_success_backup', 'Backup added successfully.');
    // }


   
    // public function store(Request $request)
    // {
      
    //     // dd($request->all());
    //     // Validate the request data
    //     $validated= $request->validate([
    //         'type'                => 'required|in:1,2,3', // 1=Project, 2=Ticket 3=others
    //         'project_id'          => 'required_if:type,1',
    //         'ticket_id'           => 'required_if:type,2',
    //         'domain'             => 'required|string|max:255',
    //         // 'domain'              => 'required|string|max:255|regex:/^(?!https?:\/\/)([a-zA-Z0-9-]+\.)+[a-zA-Z]{2,}$/',
    //         'present_ip'          => 'required|string|max:100',
    //         'last_backup_file'    => 'required|string|max:500',
    //         'last_backup_date'    => 'required|date',
    //         'last_backup_location'=> 'required|string|max:500',
    //         'backup_type'         => 'required|integer|between:1,8',
    //         'site_status'         => 'required|integer|between:1,4',
    //         'wordpress_version'   => 'nullable|string|max:50',
    //         'php_version'         => 'nullable|string|max:50',
    //         'framework_version'   => 'nullable|string|max:50',
    //         'drive_link'          => 'nullable|url|max:255',
    //         'description'         => 'nullable|string|max:1000',
    //     ], [
    //         'type.required'               => 'Please select Project or Ticket.',
    //         'domain.regex'                => 'Domain must be in format "example.com" without http/https or trailing slashes.',
    //         'type.in'                     => 'Invalid selection for Project/Ticket.',
    //         'project_id.required_if'      => 'Please select a project.',
    //         'ticket_id.required_if'       => 'Please select a ticket.',
    //         'domain.required'             => 'Domain is required.',
    //         'present_ip.required'         => 'Present IP is required.',
    //         'last_backup_file.required'   => 'Last backup file name is required.',
    //         'last_backup_date.required'   => 'Last backup date is required.',
    //         'last_backup_date.date'        => 'Last backup date must be a valid date.',
    //         'last_backup_location.required'=> 'Last backup location is required.',
    //         'backup_type.required'        => 'Backup type is required.',
    //         'backup_type.between'         => 'Invalid backup type selected.',
    //         'site_status.required'        => 'Site status is required.',
    //         'site_status.between'         => 'Invalid site status selected.',
    //         'drive_link.url'              => 'Please enter a valid URL for drive link.',
    //     ]);

    //      // Determine group_id based on type
    //         $group_id = match($request->type) {
    //             1 => 'P_' . $request->project_id,
    //             2 => 'T_' . $request->ticket_id,
    //             3 => 'D_' . strtolower($request->domain),
    //             default => null
    //         };

    //     // Determine project_ticket_id based on type
    //     $type = $request->type;
    //     $project_ticket_id = $type == 1 ? $request->project_id : $request->ticket_id;

    //     // Optional: Fetch project or ticket name if needed (currently unused)
    //     // $project_ticket_name = $type == 1 
    //     //     ? Project::find($project_ticket_id)?->project_name 
    //     //     : Ticket::find($project_ticket_id)?->title;

    //     // Create a new Backup instance
    //     // $backup = new Backup();
    //     // // Find or create group_id
    //     // $existing = Backup::where('domain', $request->domain)->first();
    //     // $backup->group_id = $existing ? $existing->group_id : Backup::max('group_id') + 1;

    //     // $backup->project_ticket        = $type;
    //     // $backup->project_ticket_id     = $project_ticket_id;
    //     $backup = new Backup();
    //     $backup->fill($validated);
        
    //     // Set IDs based on type
    //     if ($request->type == 1) {
    //         $backup->project_ticket_id = $request->project_id;
    //     } 
    //     elseif ($request->type == 2) {
    //         $backup->project_ticket_id = $request->ticket_id;
    //     }
        
    //     $backup->group_id = $group_id;
    //     $backup->project_ticket = $request->type;
    //     $backup->project_ticket_id = $request->type == 3 ? null : ($request->type == 1 ? $request->project_id : $request->ticket_id);
       
    //     $backup->domain                = $request->domain;
    //     $backup->present_ip            = $request->present_ip;
    //     $backup->last_backup_file_name = $request->last_backup_file;
    //     $backup->last_backup_date      = $request->last_backup_date;
    //     $backup->last_backup_location  = $request->last_backup_location;
    //     $backup->backup_type           = $request->backup_type;
    //     $backup->site_status           = $request->site_status;
    //     $backup->wordpress_version     = $request->wordpress_version;
    //     $backup->php_version           = $request->php_version;
    //     $backup->framework_version     = $request->framework_version;
    //     $backup->drive_link            = $request->drive_link;
    //     $backup->description           = $request->description;
    //     $backup->created_by            = Auth::id();
    //     $backup->updated_by            = Auth::id();

       
    //     // Save the backup
    //     $backup->save();
     
    //     // Redirect back with success message
    //     // return redirect()->back()->with('flash_success_backup', 'Backup added successfully.');
    //     return redirect()->route('admin.backup_manage')->with('flash_success_addbackup', 'Backup added successfully.');
 
    // }


    // public function logHistory($domain)
    // {
    //     $domain = urldecode($domain);
    
    //     $logs = Backup::where('domain', $domain)
    //                 ->orderBy('created_at', 'desc')
    //                 ->get();
    
    //     return view('backend.backup.backup_log_history', compact('domain', 'logs'));
    // }
    //corrct one
    // public function logHistory($group_id)
    // {
    //     $logs = Backup::where('group_id', $group_id)
    //                 ->orderBy('created_at', 'desc')
    //                 ->get();
        
    //     $domain = $logs->first()->domain ?? '';
        
    //     return view('backend.backup.backup_log_history', compact('domain', 'logs'));
    // }


    public function logHistory($group_id)
    {
        $logs = Backup::where('group_id', $group_id)
                    ->orderBy('created_at', 'desc')
                    ->get();
        
        // Get display name based on group type
        $displayName = match(substr($group_id, 0, 2)) {
            'P_' => Project::find(substr($group_id, 2))?->project_name,
            'T_' => Ticket::find(substr($group_id, 2))?->title,
            default => $logs->first()->domain ?? ''
        };
        
        return view('backend.backup.backup_log_history', [
            'displayName' => $displayName,
            'logs' => $logs,
            'groupType' => substr($group_id, 0, 1)
        ]);
    }


    public function edit($id)
    {

        $projects = ProjectHelper::getProjectNames();
        $tickets = TicketHelper::getTicketNames();

        // Fetch the backup record by ID
        $backup = Backup::findOrFail($id);

        // Pass the backup record to the view
         return view('backend.backup.edit', compact('backup', 'projects', 'tickets'));
    }

    //     public function update(Request $request, $id)
    //     {
    //         // dd($request->all());
    //         // Validate the request data
    //         $request->validate([
    //             'type'               => 'required|in:1,2,3', // 1=Project, 2=Ticket
    //             'project_id'         => 'required_if:type,1',
    //             'ticket_id'          => 'required_if:type,2',
    //             'domain'             => 'required|string|max:255',
    //             'present_ip'         => 'required|string|max:100',
    //             'last_backup_file'   => 'required|string|max:500',
    //             'last_backup_date'   => 'required|date',
    //             'last_backup_location'=> 'required|string|max:500',
    //             'backup_type'        => 'required|integer|between:1,8',
    //             'site_status'        => 'required|integer|between:1,4',
    //             'wordpress_version'  => 'nullable|string|max:50',
    //             'php_version'        => 'nullable|string|max:50',
    //             'framework_version'  => 'nullable|string|max:50',
    //             'drive_link'         => 'nullable|url|max:255',
    //             'description'        => 'nullable|string|max:1000',
    //         ], [
    //             'type.required'              => 'Please select Project or Ticket.',
    //             'type.in'                    => 'Invalid selection for Project/Ticket.',
    //             'project_id.required_if'     => 'Please select a project.',
    //             'ticket_id.required_if'      => 'Please select a ticket.',
    //             'domain.required'            => 'Domain is required.',
    //             'present_ip.required'        => 'Present IP is required.',
    //             'last_backup_file.required'  => 'Last backup file name is required.',
    //             'last_backup_date.required'  => 'Last backup date is required.',
    //             'last_backup_date.date'      => 'Last backup date must be a valid date.',
    //             'last_backup_location.required'=> 'Last backup location is required.',
    //             'backup_type.required'       => 'Backup type is required.',
    //             'backup_type.between'        => 'Invalid backup type selected.',
    //             'site_status.required'       => 'Site status is required.',
    //             'site_status.between'        => 'Invalid site status selected.',
    //             'drive_link.url'             => 'Please enter a valid URL for drive link.',
    //         ]);

    //     //     // Find the backup record
    //     //     $backup = Backup::findOrFail($id);

    //     //     // Determine project_ticket_id based on type
    //     //     $type = $request->type;
    //     //     $project_ticket_id = $type == 1 ? $request->project_id : $request->ticket_id;

    //     //     // Update the backup record
    //     //     $backup->update([
    //     //         'project_ticket'         => $type,
    //     //         'project_ticket_id'      => $project_ticket_id,
    //     //         'domain'                => $request->domain,
    //     //         'present_ip'            => $request->present_ip,
    //     //         'last_backup_file_name' => $request->last_backup_file,
    //     //         'last_backup_date'      => $request->last_backup_date,
    //     //         'last_backup_location'  => $request->last_backup_location,
    //     //         'backup_type'           => $request->backup_type,
    //     //         'site_status'           => $request->site_status,
    //     //         'wordpress_version'     => $request->wordpress_version,
    //     //         'php_version'           => $request->php_version,
    //     //         'framework_version'     => $request->framework_version,
    //     //         'drive_link'            => $request->drive_link,
    //     //         'description'           => $request->description,
    //     //         'updated_by'            => Auth::id(),
    //     //     ]);

    //     //     // Redirect back with success message
    //     //     return redirect()->route('admin.backup_manage')->with('flash_success_backup', 'Backup updated successfully.');

            
    //     // }
        
    //     try {
    //         // Find the backup record
    //         $backup = Backup::findOrFail($id);

    //         // Determine the new group_id based on type
    //         $newGroupId = match($request->type) {
    //             1 => 'P_' . $request->project_id,
    //             2 => 'T_' . $request->ticket_id,
    //             3 => 'D_' . strtolower($request->domain),
    //             default => $backup->group_id // fallback to existing group_id
    //         };

    //         // Only update project_ticket_id for projects and tickets
    //         $projectTicketId = $request->type == 3 ? null : 
    //                         ($request->type == 1 ? $request->project_id : $request->ticket_id);

    //         // Update the backup record
    //         $backup->update([
    //             'group_id' => $newGroupId,
    //             'project_ticket' => $request->type,
    //             'project_ticket_id' => $projectTicketId,
    //             'domain' => $request->domain,
    //             'present_ip' => $request->present_ip,
    //             'last_backup_file_name' => $request->last_backup_file,
    //             'last_backup_date' => $request->last_backup_date,
    //             'last_backup_location' => $request->last_backup_location,
    //             'backup_type' => $request->backup_type,
    //             'site_status' => $request->site_status,
    //             'wordpress_version' => $request->wordpress_version,
    //             'php_version' => $request->php_version,
    //             'framework_version' => $request->framework_version,
    //             'drive_link' => $request->drive_link,
    //             'description' => $request->description,
    //             'updated_by' => Auth::id(),
    //         ]);

    //         return redirect()->route('admin.backup_manage')
    //             ->with('flash_success_backup', 'Backup updated successfully.');

    //     } catch (\Exception $e) {
    //         return back()->withInput()
    //             ->with('error', 'Failed to update backup: ' . $e->getMessage());
    //     }
            
    // } 


    public function store(Request $request)
    {
        // Validate the request data
        $validated = $request->validate([
            'type'                => 'required|in:1,2,3', // 1=Project, 2=Ticket, 3=Domain
            'project_id'          => 'required_if:type,1',
            'ticket_id'           => 'required_if:type,2',
            'domain'             => 'required|string|max:255',
            // 'domain'              => 'required|string|max:255|regex:/^(?!https?:\/\/)([a-zA-Z0-9-]+\.)+[a-zA-Z]{2,}$/',
            'present_ip'          => 'required|string|max:100',
            'last_backup_file'    => 'required|string|max:500',
            'last_backup_date'    => 'required|date',
            'last_backup_location'=> 'required|string|max:500',
            'backup_type'         => 'required|integer|between:1,8',
            'site_status'         => 'required|integer|between:1,4',
            'wordpress_version'   => 'nullable|string|max:50',
            'php_version'         => 'nullable|string|max:50',
            'framework_version'   => 'nullable|string|max:50',
            'drive_link'          => 'nullable|url|max:255',
            'description'         => 'nullable|string|max:1000',
        ]);
    
        // Normalize domain to lowercase
        $domain = strtolower($request->domain);
    
        // Determine project_ticket_id based on type
        $project_ticket_id = null;
        if ($request->type == 1) {
            $project_ticket_id = $request->project_id;
        } elseif ($request->type == 2) {
            $project_ticket_id = $request->ticket_id;
        }
    
        // Handle domain grouping
        $group_id = null;
        $domain_id = null;
        
        if ($request->type == 1) { // Project
            $group_id = 'P_' . $request->project_id;
        } 
        elseif ($request->type == 2) { // Ticket
            $group_id = 'T_' . $request->ticket_id;
        } 
        else { // Domain (type=3)
            // Check if domain already exists
            $existingDomain = Backup::where('domain', $domain)->first();
            
            if ($existingDomain) {
                $domain_id = $existingDomain->domain_id;
                $group_id = 'D_' . $existingDomain->domain_id;
            } else {
                $maxDomainId = Backup::max('domain_id') ?? 0;
                $domain_id = $maxDomainId + 1;
                $group_id = 'D_' . $domain_id;
            }
        }
    
      // Create new Backup instance and assign all fields
      $backup = new Backup();
      $backup->group_id = $group_id;
      $backup->project_ticket = $request->type;
      $backup->project_ticket_id = $project_ticket_id;
      $backup->domain_id = $domain_id;
      $backup->domain = $domain;
      $backup->present_ip = $request->present_ip;
      $backup->last_backup_file_name = $request->last_backup_file;
      $backup->last_backup_date = $request->last_backup_date;
      $backup->last_backup_location = $request->last_backup_location;
      $backup->backup_type = $request->backup_type;
      $backup->site_status = $request->site_status;
      $backup->wordpress_version = $request->wordpress_version;
      $backup->php_version = $request->php_version;
      $backup->framework_version = $request->framework_version;
      $backup->drive_link = $request->drive_link;
      $backup->description = $request->description;
      $backup->created_by = Auth::id();
      $backup->updated_by = Auth::id();
  
      // Save the backup
      $backup->save();
  
      return redirect()->route('admin.backup_manage')
             ->with('flash_success_addbackup', 'Backup added successfully.');
  }
    // public function update(Request $request, $id)
    // {
    //     // Validate the request data
    //     $validated = $request->validate([
    //         'type'               => 'required|in:1,2,3', // 1=Project, 2=Ticket, 3=Domain
    //         'project_id'         => 'required_if:type,1',
    //         'ticket_id'          => 'required_if:type,2',
    //         'domain'             => 'required|string|max:255',
    //         // 'domain'             => 'required|string|max:255|regex:/^(?!https?:\/\/)([a-zA-Z0-9-]+\.)+[a-zA-Z]{2,}$/',
    //         'present_ip'         => 'required|string|max:100',
    //         'last_backup_file'   => 'required|string|max:500',
    //         'last_backup_date'   => 'required|date',
    //         'last_backup_location'=> 'required|string|max:500',
    //         'backup_type'        => 'required|integer|between:1,8',
    //         'site_status'        => 'required|integer|between:1,4',
    //         'wordpress_version'  => 'nullable|string|max:50',
    //         'php_version'        => 'nullable|string|max:50',
    //         'framework_version'  => 'nullable|string|max:50',
    //         'drive_link'         => 'nullable|url|max:255',
    //         'description'        => 'nullable|string|max:1000',
    //     ], [
    //         // Your custom validation messages here
    //     ]);
    
    //     try {
    //         $backup = Backup::findOrFail($id);
    //         $originalType = $backup->project_ticket;
    //         $originalDomain = $backup->domain;
    
    //         // Handle group_id based on type
    //         if ($request->type == 1) { // Project
    //             $backup->group_id = 'P_' . $request->project_id;
    //             $backup->project_ticket_id = $request->project_id;
    //         } 
    //         elseif ($request->type == 2) { // Ticket
    //             $backup->group_id = 'T_' . $request->ticket_id;
    //             $backup->project_ticket_id = $request->ticket_id;
    //         } 
    //         else { // Domain (type=3)
    //             // Only generate new domain_id if:
    //             // 1. Changing from project/ticket to domain, or
    //             // 2. Domain name changed
    //             if ($originalType != 3 || $originalDomain != $request->domain) {
    //                 $maxDomainId = Backup::where('project_ticket', 3)->max('domain_id') ?? 0;
    //                 $backup->domain_id = $maxDomainId + 1;
    //                 $backup->group_id = 'D_' . $backup->domain_id;
    //             }
    //             $backup->project_ticket_id = null;
    //         }
    
    //         // Update all other fields
    //         $backup->update([
    //             'project_ticket' => $request->type,
    //             'domain' => $request->domain,
    //             'present_ip' => $request->present_ip,
    //             'last_backup_file_name' => $request->last_backup_file,
    //             'last_backup_date' => $request->last_backup_date,
    //             'last_backup_location' => $request->last_backup_location,
    //             'backup_type' => $request->backup_type,
    //             'site_status' => $request->site_status,
    //             'wordpress_version' => $request->wordpress_version,
    //             'php_version' => $request->php_version,
    //             'framework_version' => $request->framework_version,
    //             'drive_link' => $request->drive_link,
    //             'description' => $request->description,
    //             'updated_by' => Auth::id(),
    //         ]);
    
    //         return redirect()->route('admin.backup_manage')
    //             ->with('flash_success_backup', 'Backup updated successfully.');
    
    //     } catch (\Exception $e) {
    //         return back()->withInput()
    //             ->with('error', 'Failed to update backup: ' . $e->getMessage());
    //     }
    // }
    
    public function update(Request $request, $id)
    {
        // Validate the request data
        $request->validate([
            'type'               => 'required|in:1,2,3', // 1=Project, 2=Ticket, 3=Domain
            'project_id'         => 'required_if:type,1',
            'ticket_id'          => 'required_if:type,2',
            'domain'             => 'required|string|max:255',
            'present_ip'         => 'required|string|max:100',
            'last_backup_file'   => 'required|string|max:500',
            'last_backup_date'   => 'required|date',
            'last_backup_location'=> 'required|string|max:500',
            'backup_type'        => 'required|integer|between:1,8',
            'site_status'        => 'required|integer|between:1,4',
            'wordpress_version'  => 'nullable|string|max:50',
            'php_version'        => 'nullable|string|max:50',
            'framework_version'  => 'nullable|string|max:50',
            'drive_link'         => 'nullable|url|max:255',
            'description'        => 'nullable|string|max:1000',
        ]);

        try {
            $backup = Backup::findOrFail($id);
            $originalType = $backup->project_ticket;
            $originalDomain = strtolower($backup->domain);
            $newDomain = strtolower($request->domain);

            // Handle group_id and IDs based on type
            if ($request->type == 1) { // Project
                $backup->group_id = 'P_' . $request->project_id;
                $backup->project_ticket_id = $request->project_id;
                $backup->domain_id = null;
            } 
            elseif ($request->type == 2) { // Ticket
                $backup->group_id = 'T_' . $request->ticket_id;
                $backup->project_ticket_id = $request->ticket_id;
                $backup->domain_id = null;
            } 
            else { // Domain (type=3)
                $backup->project_ticket_id = null;
                
                // Only generate new domain_id if:
                // 1. Changing from project/ticket to domain, or
                // 2. Domain name changed
                if ($originalType != 3 || $originalDomain != $newDomain) {
                    $existingDomain = Backup::where('domain', $newDomain)->first();
                    
                    if ($existingDomain) {
                        $backup->domain_id = $existingDomain->domain_id;
                        $backup->group_id = 'D_' . $existingDomain->domain_id;
                    } else {
                        $maxDomainId = Backup::where('project_ticket', 3)->max('domain_id') ?? 0;
                        $backup->domain_id = $maxDomainId + 1;
                        $backup->group_id = 'D_' . $backup->domain_id;
                    }
                }
            }

            // Update all fields explicitly
            $backup->project_ticket = $request->type;
            $backup->domain = $newDomain;
            $backup->present_ip = $request->present_ip;
            $backup->last_backup_file_name = $request->last_backup_file;
            $backup->last_backup_date = $request->last_backup_date;
            $backup->last_backup_location = $request->last_backup_location;
            $backup->backup_type = $request->backup_type;
            $backup->site_status = $request->site_status;
            $backup->wordpress_version = $request->wordpress_version;
            $backup->php_version = $request->php_version;
            $backup->framework_version = $request->framework_version;
            $backup->drive_link = $request->drive_link;
            $backup->description = $request->description;
            $backup->updated_by = Auth::id();

            $backup->save();

            return redirect()->route('admin.backup_manage')
                ->with('flash_success_backup', 'Backup updated successfully.');

        } catch (\Exception $e) {
            return back()->withInput()
                ->with('error', 'Failed to update backup: ' . $e->getMessage());
        }
    }
}
