<?php

namespace App\Http\Controllers\Backend\Reports;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use App\Helpers\ClientHelper;
use App\Models\Backend\Ticket;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ReportsController extends Controller
{
    public function ActiveTicketReport()
    {
        // Build the query without executing it
        $query = Ticket::leftJoinSub(
            DB::table('si_daily_report_fields')
                ->select('project_id', DB::raw('SUM(hrs) as total_hrs'))
                ->where('type', 2)
                ->groupBy('project_id'),
            'daily_reports',
            'isar_tickets.id',
            '=',
            'daily_reports.project_id'
        )
        ->leftJoinSub(
            DB::table('isar_ticket_discusion as itd')
                ->select('itd.ticket_id', 'itd.comments as discussion_comments')
                ->whereRaw('itd.id = (SELECT MAX(id) FROM isar_ticket_discusion WHERE ticket_id = itd.ticket_id)'),
            'latest_discussion',
            'isar_tickets.id',
            '=',
            'latest_discussion.ticket_id'
        )
        // Add conditional filtering for status
        ->when(request('status', 0) == 0, function ($query) {
            // Default: Exclude status 3 and 7
            $query->whereNotIn('isar_tickets.status', [3, 7]);
        }, function ($query) {
            // If a specific status is selected, filter by it
            $query->when(request()->has('status'), function ($q) {
                $q->where('isar_tickets.status', request('status'));
            });
        })
        ->select(
            'isar_tickets.id as ticketId',
            'isar_tickets.*',
            DB::raw('COALESCE(daily_reports.total_hrs, 0) as hrs'),
            DB::raw('2 as type'),
            'isar_tickets.id as project_id',
            'latest_discussion.discussion_comments'
        )
        ->orderBy('isar_tickets.id', 'desc');

        // Get the count of tickets based on the query
        $ticketCount = $query->count();

        // Execute the query to get the ticket results
        $tickets = $query->get();

        $status = ClientHelper::TicketStatus();
        $Priority = ClientHelper::Priority();
        $employees = ClientHelper::getEmployees();

        // Determine the selected status label
        $selectedStatus = request('status', 0);
        $ticketStatus = $selectedStatus == 0 
            ? 'Active' 
            : ($status[$selectedStatus] ?? 'Unknown Status');

        return view("backend.reports.tickets.active-ticket", [
            "tickets" => $tickets,
            "status" => $status,
            "Priority" => $Priority,
            "employees" => $employees,
            'ticketCount' => $ticketCount, // Correct count based on filters
            'ticketStatus' => $ticketStatus,
        ]);
    }


    public function exportPdf(Request $request)
    {
        // Build the query without executing it
        $query = Ticket::leftJoinSub(
            DB::table('si_daily_report_fields')
                ->select('project_id', DB::raw('SUM(hrs) as total_hrs'))
                ->where('type', 2)
                ->groupBy('project_id'),
            'daily_reports',
            'isar_tickets.id',
            '=',
            'daily_reports.project_id'
        )
        ->leftJoinSub(
            DB::table('isar_ticket_discusion as itd')
                ->select('itd.ticket_id', 'itd.comments as discussion_comments')
                ->whereRaw('itd.id = (SELECT MAX(id) FROM isar_ticket_discusion WHERE ticket_id = itd.ticket_id)'),
            'latest_discussion',
            'isar_tickets.id',
            '=',
            'latest_discussion.ticket_id'
        )
        ->when($request->status == 0 || !$request->has('status'), function ($query) {
            // Default: Exclude status 3 and 7
            $query->whereNotIn('isar_tickets.status', [3, 7]);
        }, function ($query) use ($request) {
            // If specific status selected
            $query->when($request->status, function ($q) use ($request) {
                $q->where('isar_tickets.status', $request->status);
            });
        })
        ->select(
            'isar_tickets.id as ticketId',
            'isar_tickets.*',
            DB::raw('COALESCE(daily_reports.total_hrs, 0) as hrs'),
            DB::raw('2 as type'),
            'isar_tickets.id as project_id',
            'latest_discussion.discussion_comments'
        )
        ->orderBy('isar_tickets.id', 'desc');

        // Get the count of filtered tickets
        $ticketCount = $query->count(); 

        // Execute the query to get results
        $tickets = $query->get();

        // Prepare data for the PDF
        $statusList = ClientHelper::TicketStatus();
        $priorityList = ClientHelper::Priority();
        $employees = ClientHelper::getEmployees();
        
        $data = [
            'status' => $statusList,
            'Priority' => $priorityList,
            'employees' => $employees,
            'tickets' => $tickets,
            'ticketStatus' => $request->status,
            'ticketCount' => $ticketCount // Include accurate count
        ];

        $pdf = PDF::loadView('backend.reports.tickets.active-ticket-pdf', $data);
        return $pdf->download('Active-ticket-report-'.now()->format('Y-m-d').'.pdf');
    }
}
