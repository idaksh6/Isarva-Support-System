<?php

namespace App\Http\Controllers\Backend;
use Illuminate\Http\Request;
use App\Models\Backend\Ticket;
use Illuminate\Support\Carbon;
use App\Models\Backend\Project;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Backend\DailyReportField;

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

        return view('backend.project_dashboard', compact(
            'totalProjectsCount', 'totalProjects', 'openProjects', 
            'closedProjects', 'OnHoldProjects', 'openTickets',
            'onHoldTickets', 'flaggedTickets', 'activeTickets'
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
}
