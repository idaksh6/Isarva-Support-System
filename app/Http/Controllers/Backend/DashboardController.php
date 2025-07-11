<?php

namespace App\Http\Controllers\Backend;
use Illuminate\Http\Request;
use App\Models\Backend\Ticket;
use Illuminate\Support\Carbon;
use App\Models\Backend\Project;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Backend\DailyReportField;
use App\Models\Backend\Client;


use App\Helpers\ClientHelper;
/**
 * Class DashboardController.
 */
class DashboardController
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    
    public function formBasic(Request $request)
    {
        $validatedData = $request->validate([
            "firstname"  => 'required',
            "lastname"  => 'required',
            "phonenumber"  => 'required',
            "emailaddress"  => 'required|unique:employees|max:255',
            "admitdate"  => 'required',
            "admittime"  => 'required',
            "formFileMultiple"  => 'required',
            "exampleRadios"  => 'required',
            "addnote"  => 'required',
        ]);
    }

    public function formAdvance(Request $request)
    {
        $validatedData = $request->validate([
            "min8" => 'required|min:8',
            "between5to10" => 'required|between:5,10',
            "between_min_number" => 'required|min:5',
            "between20to30" => 'required|between:20,30'
        ]);
    }

    public function index()
    {
        return view('backend.dashboard');
    }

    // public function project()
    // {

    //     $userId = Auth::id(); // Get logged-in user ID

    //     $totalProjects = Project::getTotalProjects(); // Get total project count
    //     $openProjects = Project::getOpenProjectCount(); // Count of open projects
    //     $closedProjects = Project::getClosedProjectCount(); // Closed projects count
    //     $OnHoldProjects = Project::getOnHoldProjectCount(); // OnHold Count

    //     $openTickets = Ticket::countOpenTickets(); // Get active tickets count
    //     $onHoldTickets = Ticket::countOnHoldTickets();
    //     $flaggedTickets = Ticket::countFlaggedTickets(); // Get flagged tickets count
    //     $activeTickets = Ticket::getActiveTicketCount(); // Other than closed ticket

    //     // Count projects where the logged-in user is assigned (as Manager, Team Leader, or Team Member)
    //     $totalProjectsCount = Project::where('manager', $userId)
    //         ->orWhere('team_leader', $userId)
    //         ->orWhereRaw("FIND_IN_SET(?, team_members)", [$userId])
    //         ->count();

    //     return view('backend.project_dashboard', compact('totalProjectsCount','totalProjects','openProjects','closedProjects','OnHoldProjects',
    //     'openTickets','onHoldTickets','flaggedTickets', 'activeTickets'));
    // }

    public function project()
    {
        $user = Auth::user();
        $userId = $user->id;
        $isAdmin = ($user->role == 1);

        // Clienrt Aceess code
    //      if (!session()->has('client_id')) {
    //     return redirect('/clientlogin')->withErrors(['access' => 'Please login first.']);
    //    }

        // Project counts
        $projectQuery = Project::query();
        if (!$isAdmin) {
            $projectQuery->where(function($query) use ($userId) {
                $query->where('manager', $userId)
                    ->orWhere('team_leader', $userId)
                    ->orWhereRaw("FIND_IN_SET(?, team_members)", [$userId]);
            });
        }

        $totalProjects = $isAdmin ? Project::getTotalProjects() : $projectQuery->count();
        // Get ticket counts
    //    $ticketCounts = Ticket::getTicketCounts($user->id, $isAdmin);
        // $totaltickets  = $isAdmin ? Ticket::getTotalTicketsts() : $ticketQuery->count();
        $openProjects = $isAdmin ? Project::getOpenProjectCount() : $projectQuery->clone()->where('status', 2)->count();
        $closedProjects = $isAdmin ? Project::getClosedProjectCount() : $projectQuery->clone()->where('status', 6)->count();
        $OnHoldProjects = $isAdmin ? Project::getOnHoldProjectCount() : $projectQuery->clone()->where('status', 7)->count();

        // Ticket counts
        $ticketQuery = Ticket::query();
        if (!$isAdmin) {
            $ticketQuery->where('flag_to', $userId);
        }

        $openTickets = $isAdmin ? Ticket::countOpenTickets() : $ticketQuery->clone()->where('status', 1)->count();
        $onHoldTickets = $isAdmin ? Ticket::countOnHoldTickets() : $ticketQuery->clone()->where('status', 3)->count();
        $flaggedTickets = $isAdmin ? Ticket::countFlaggedTickets() : $ticketQuery->clone()
                                    ->whereNotNull('flag_to')
                                    ->where('flag_to', '!=', '')
                                    ->count();
        $activeTickets = $isAdmin ? Ticket::getActiveTicketCount() : $ticketQuery->clone()->where('status', '!=', 7)->count();

        // Count of projects assigned to user (regardless of role)
        $totalProjectsCount = Project::where('manager', $userId)
            ->orWhere('team_leader', $userId)
            ->orWhereRaw("FIND_IN_SET(?, team_members)", [$userId])
            ->count();

        // // Get urgent renewals (expiring in <5 days) without using relationships
        // $urgentRenewals = DB::table('services')
        // ->leftJoin('si_projects', 'services.project_id', '=', 'si_projects.id')
        // ->select(
        //     'services.*',
        //     'si_projects.project_name',
        //     'si_projects.id as project_id'
        // )
        // ->where('services.priority', 'urgent')
        // // ->orderBy('services.expiry_date')
        // ->take(6) // Limit to 6 most urgent
        // ->get();

        // Get urgent renewals (expiring in <5 days) without using relationships
        // $urgentRenewals = DB::table('services')
        // ->leftJoin('si_projects', 'services.project_id', '=', 'si_projects.id')
        // ->select(
        //     'services.*',
        //     'si_projects.project_name',
        //     'si_projects.id as project_id',
        //     // Add these to determine which service is active
        //     DB::raw('CASE 
        //         WHEN services.d_service = 1 THEN "domain"
        //         WHEN services.h_service = 1 THEN "hosting"
        //         WHEN services.a_service = 1 THEN "application"
        //         ELSE "none"
        //     END as service_type'),
        //     DB::raw('CASE 
        //         WHEN services.d_service = 1 THEN services.d_name
        //         WHEN services.h_service = 1 THEN services.h_ip
        //         WHEN services.a_service = 1 THEN services.a_name
        //         ELSE "N/A"
        //     END as service_name'),
        //     DB::raw('CASE 
        //         WHEN services.d_service = 1 THEN services.d_exp
        //         WHEN services.h_service = 1 THEN services.h_exp
        //         WHEN services.a_service = 1 THEN services.a_exp
        //         ELSE NULL
        //     END as expiry_date')
        // )
        // ->where('services.priority', 'urgent')
        // ->orderBy('expiry_date') // Now this column is calculated in the query
        // ->take(6) // Limit to 6 most urgent
        // ->get();

        
        // Get all urgent services (expiring in <=5 days or past due)
        $urgentServices = DB::table('services')
        ->leftJoin('si_projects', 'services.project_id', '=', 'si_projects.id')
        ->select(                         // specifies the columns that we want to retrieve:
            'services.id',
            'si_projects.project_name',
            'si_projects.id as project_id',
            DB::raw('"domain" as service_type'),
            'services.d_name as service_name',
            'services.d_exp as expiry_date',
            DB::raw('DATEDIFF(services.d_exp, CURDATE()) as days_left')
        )
        ->where('services.d_service', 1)       //condition as d_service value should be 1
        ->where('services.priority', 'urgent') 
        ->whereRaw('DATEDIFF(services.d_exp, CURDATE()) <= 5') // Only <=5 days
        ->whereNull('services.deleted_at') // Exclude soft-deleted records

        ->unionAll(
            DB::table('services')
                ->leftJoin('si_projects', 'services.project_id', '=', 'si_projects.id')
                ->select(
                    'services.id',
                    'si_projects.project_name',
                    'si_projects.id as project_id',
                    DB::raw('"hosting" as service_type'),
                    'services.h_ip as service_name',
                    'services.h_exp as expiry_date',
                    DB::raw('DATEDIFF(services.h_exp, CURDATE()) as days_left')
                )
                ->where('services.h_service', 1)
                ->where('services.priority', 'urgent')
                ->whereRaw('DATEDIFF(services.h_exp, CURDATE()) <= 5') // Only <=5 days
                ->whereNull('services.deleted_at') // Exclude soft-deleted records
        )

        ->unionAll(
            DB::table('services')
                ->leftJoin('si_projects', 'services.project_id', '=', 'si_projects.id')
                ->select(
                    'services.id',
                    'si_projects.project_name',
                    'si_projects.id as project_id',
                    DB::raw('"application" as service_type'),
                    'services.a_name as service_name',
                    'services.a_exp as expiry_date',
                    DB::raw('DATEDIFF(services.a_exp, CURDATE()) as days_left')
                )
                ->where('services.a_service', 1)
                ->where('services.priority', 'urgent')
                ->whereRaw('DATEDIFF(services.a_exp, CURDATE()) <= 5') // Only <=5 days
                ->whereNull('services.deleted_at') // Exclude soft-deleted records
        )

        ->orderBy('days_left') // Order by closest expiry (including negative for past due)
        // ->take(8) // Limit to 8 most urgent
        ->get();

        return view('backend.project_dashboard', compact(
            'totalProjectsCount', 'totalProjects', 'openProjects', 
            'closedProjects', 'OnHoldProjects', 'openTickets',
            'onHoldTickets', 'flaggedTickets', 'activeTickets', 'urgentServices',
        ));
    }

   
    
    public function help()
    {
        return view('backend.help');
    }
    public function classes(){
        return view('backend.classes');
    }
    public function student(){
        return view('backend.student');
    }
    public function videoClasses(){
        return view('backend.video-classes');
    }
    public function messages(){
        return view('backend.messages');
    }
    public function reviews(){
        return view('backend.reviews');
    }

    public function dailyReportStatisticsChart($year = null, $month = null)
    {
        // Use current year/month if not provided
        $year = $year ?? date('Y');
        $month = $month ?? date('m');
        
        // Create Carbon instance for the selected month/year
        $date = Carbon::create($year, $month, 1);
        
        $startOfMonth = $date->copy()->startOfMonth();
        $endOfMonth = $date->copy()->endOfMonth();
    
        $query = DailyReportField::select('billable_type', DB::raw('SUM(hrs) as total'))
            ->whereIn('billable_type', [0, 1, 2])
            ->whereBetween('created_at', [$startOfMonth, $endOfMonth]);
    
        // Add user filter if not admin
        if (auth()->user()->role != 1) { // 1 = admin
            $query->where('user_id', auth()->id());
        }
    
        $data = $query->groupBy('billable_type')
            ->get()
            ->keyBy('billable_type');
    
        return response()->json([
            'series' => [
                $data->get(1)?->total ?? 0,
                $data->get(2)?->total ?? 0,
                $data->get(0)?->total ?? 0
            ],
            'labels' => ['Billable', 'Non-Billable', 'Internal Billable']
        ]);
    }
    
    public function lastOneYearData($year = null, $month = null)
    {
        $year = $year ?? date('Y');
        $month = $month ?? date('m');
        
        $endDate = Carbon::create($year, $month)->endOfMonth();
        $startDate = $endDate->copy()->subMonths(12)->startOfMonth();
    
        $labels = [];
        $billedHours = [];
    
        for ($i = 0; $i < 13; $i++) {
            $currentDate = $startDate->copy()->addMonths($i);
            $labels[] = $currentDate->format('M Y');
            
            $monthStart = $currentDate->copy()->startOfMonth();
            $monthEnd = $currentDate->copy()->endOfMonth();
    
            $query = DailyReportField::where('billable_type', 1)
                ->whereBetween('created_at', [$monthStart, $monthEnd]);
    
            // Add user filter if not admin
            if (auth()->user()->role != 1) { // 1 = admin
                $query->where('user_id', auth()->id());
            }
    
            $total = $query->sum('hrs');
    
            $billedHours[] = $total ?? 0;
        }
    
        return response()->json([
            'labels' => $labels,
            'series' => [$billedHours],
            'selectedMonthIndex' => 12 // Last month in the range
        ]);
    }



       public function lastSixMonthData($year = null, $month = null,$employee=null)
        {
            $year = $year ?? date('Y');
            $month = $month ?? date('m');

            $endDate = Carbon::create($year, $month)->endOfMonth();
            $startDate = $endDate->copy()->subMonths(5)->startOfMonth(); // Last 6 months including current

            $labels = [];
            $billable = [];
            $internalBillable = [];
            $nonBillable = [];

            for ($i = 0; $i < 6; $i++) {
                $currentDate = $startDate->copy()->addMonths($i);
                $labels[] = $currentDate->format('M Y');

                $monthStart = $currentDate->copy()->startOfMonth();
                $monthEnd = $currentDate->copy()->endOfMonth();

                // Get totals for all billable types in one query
                $totals = DailyReportField::whereIn('billable_type', [0, 1, 2])
                    ->whereBetween('created_at', [$monthStart, $monthEnd])
                    ->when(auth()->user()->role != 1, function ($query) {
                        $query->where('user_id', auth()->id());
                    })
                    ->when(auth()->user()->role == 1 && !empty($employee), function ($query) use ($employee) {
                        $query->where('user_id', $employee); // Admin employee filter
                    })
                    ->groupBy('billable_type')
                    ->selectRaw('billable_type, SUM(hrs) as total_hrs')
                    ->pluck('total_hrs', 'billable_type')
                    ->toArray();

                $billable[] = $totals[1] ?? 0;
                $internalBillable[] = $totals[2] ?? 0;
                $nonBillable[] = $totals[0] ?? 0;
            }

            return response()->json([
                'labels' => $labels,
                'series' => [
                    $billable,          // Billable (type 1)
                    $internalBillable,  // Internal Billable (type 2)
                    $nonBillable        // Non-Billable (type 0)
                ]
            ]);
        }



        // public function clientProjectDashboard()
        // {
        //     // Optional: You can fetch client_id from session
        //     $clientId = session('client_id');

        //     // Static or real counts (depends on your data structure)
        //     $activeProjects = 5;
        //     $onHoldProjects = 2;
        //     $activeTickets = 3;
        //     $closedTickets = 7;

        //     // return view('client.project_dashboard', compact(
        //     //     'activeProjects',
        //     //     'onHoldProjects',
        //     //     'activeTickets',
        //     //     'closedTickets'
        //     // ));

        //   return view('client.client.project_dashboard', compact(
        //         'activeProjects',
        //         'onHoldProjects',
        //         'activeTickets',
        //         'closedTickets'
        //     ));
        // }
        public function clientProjectDashboard()
        {
            // Get client_id from session
            $clientId = session('client_id');
            
            // Get client name from session
            $clientName = session('client_name');
            $clientEmail = session('client_email');

            // If client name isn't in session, fetch it from database
            if (!$clientName && $clientId) {
                $client = Client::find($clientId);
                $clientName = $client ? $client->client_name : 'Guest';
                
                // Store in session for future use
                session(['client_name' => $clientName]);
            }

            // Static or real counts (depends on your data structure)
            $activeProjects = 5;
            $onHoldProjects = 2;
            $activeTickets = 3;
            $closedTickets = 7;

            return view('client.project_dashboard', compact(
                'activeProjects',
                'onHoldProjects',
                'activeTickets',
                'closedTickets',
                // 'clientName', // Make sure this is included in compact()
                //  'clientEmail'
            ));
        }

      
    
        // Working fine with session
        // public function clientTickets(Request $request)
        // {
        //     $clientEmail = session('client_email'); // stored  in session

        //     if (!$clientEmail) {
        //         return redirect()->route('clientlogin')->with('error', 'Please login to view tickets');
        //     }

        //     // Query using email_id field from tickets table
        //     $query = DB::table('isar_tickets as t')
        //         ->where('t.email_id', $clientEmail)
        //         ->where('t.is_client', 1)
        //         ->select('t.*')
        //         ->orderBy('t.created_at', 'desc');

        //     // Optional search filter
        //     if ($request->filled('q')) {
        //         $query->where(function ($q) use ($request) {
        //             $q->where('t.title', 'like', '%' . $request->q . '%')
        //             ->orWhere('t.id', 'like', '%' . $request->q . '%');
        //         });
        //     }

        //     // Optional status filter
        //     if ($request->filled('status')) {
        //         $query->where('t.status', $request->status);
        //     }

        //     $tickets = $query->get();

        //     // Fetch helper data
        //     $employees = ClientHelper::getEmployees();
        //     $status = ClientHelper::TicketStatus();
        //     $department = ClientHelper::Departments();
        //     $priority = ClientHelper::Priority();

        //     return view('client.ticket_view', [
        //         'tickets' => $tickets,
        //         'employees' => $employees,
        //         'status' => $status,
        //         'department' => $department,
        //         'priority' => $priority,
        //     ]);
        // }

    public function clientTickets(Request $request)
    {
        $client = Auth::guard('client')->user();

        if (!$client) {
            return redirect()->route('clientlogin')->with('error', 'Please login to view tickets');
        }

        $query = DB::table('isar_tickets as t')
            ->where('t.email_id', $client->email_id)
            ->where('t.is_client', 1)
            ->select('t.*')
            ->orderBy('t.created_at', 'desc');

        if ($request->filled('q')) {
            $query->where(function ($q) use ($request) {
                $q->where('t.title', 'like', '%' . $request->q . '%')
                ->orWhere('t.id', 'like', '%' . $request->q . '%');
            });
        }

        if ($request->filled('status')) {
            $query->where('t.status', $request->status);
        }

        $tickets = $query->get();

        $employees = ClientHelper::getEmployees();
        $status = ClientHelper::TicketStatus();
        $department = ClientHelper::Departments();
        $priority = ClientHelper::Priority();

        return view('client.ticket_view', [
            'tickets' => $tickets,
            'employees' => $employees,
            'status' => $status,
            'department' => $department,
            'priority' => $priority,
        ]);
    }


        
}
