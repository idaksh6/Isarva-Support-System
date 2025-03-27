<?php

namespace App\Http\Controllers\Backend;
use Illuminate\Http\Request;
use App\Models\Backend\Project;
use App\Models\Backend\Ticket;
use Illuminate\Support\Facades\Auth;

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

    public function project()
    {

        $userId = Auth::id(); // Get logged-in user ID

        $totalProjects = Project::getTotalProjects(); // Get total project count
        $openProjects = Project::getOpenProjectCount(); // Count of open projects
        $closedProjects = Project::getClosedProjectCount(); // Closed projects count
        $OnHoldProjects = Project::getOnHoldProjectCount(); // OnHold Count

        $openTickets = Ticket::countOpenTickets(); // Get active tickets count
        $onHoldTickets = Ticket::countOnHoldTickets();
        $flaggedTickets = Ticket::countFlaggedTickets(); // Get flagged tickets count
        $activeTickets = Ticket::getActiveTicketCount(); // Other than closed ticket

        // Count projects where the logged-in user is assigned (as Manager, Team Leader, or Team Member)
        $totalProjectsCount = Project::where('manager', $userId)
            ->orWhere('team_leader', $userId)
            ->orWhereRaw("FIND_IN_SET(?, team_members)", [$userId])
            ->count();

        return view('backend.project_dashboard', compact('totalProjectsCount','totalProjects','openProjects','closedProjects','OnHoldProjects',
        'openTickets','onHoldTickets','flaggedTickets', 'activeTickets'));
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
}
