<?php

namespace App\Http\Controllers\Backend\Reports;

use App\Models\Backend\DailyTask;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use App\Helpers\ClientHelper;
use App\Models\Backend\Ticket;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Backend\DailyReportField;
use App\Helpers\EmployeeHelper;
use App\Helpers\ProjectHelper;
use App\Helpers\TicketHelper;
use App\Models\Backend\User;
use Carbon\Carbon;

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
        // $tickets = $query->get();
         $tickets = $query->paginate(10);

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

 
        // DailyTask Report
        public function getdailytaskreport(Request $request)
        {
            $query = DailyTask::with('user');
        
            if ($request->has(['start_date', 'end_date'])) {
                $start = $request->input('start_date');
                $end = $request->input('end_date');
        
                $query->whereDate('created_at', '>=', $start)
                      ->whereDate('created_at', '<=', $end);
            }
        
            // Paginate 30 records per page and keep filters during pagination
            $tasks = $query->paginate(30)->appends($request->all());
        
            // return view('admin.reports.dailytask_report', compact('tasks'));
            return view('backend.reports.dailytaskreports.dailytask_report', compact('tasks'));
        }
        


        // public function getemployeeanalytics(Request $request){
        //     {
        //         $start_date = $request->input('start_date', now()->subDay()->toDateString());
        //         $end_date = $request->input('end_date', now()->toDateString());
        
        //         $reportModel = new DailyReportField();
        //         $employeeData = $reportModel->getEmployeeStats($start_date, $end_date);
        
        //         // Group by department
        //         $departments = [
        //             1 => 'Frontend Team',
        //             2 => 'Backend Team',
        //             3 => 'Internship',
        //         ];
        
        //         $grouped = $employeeData->groupBy('department');
        
        //         return view('backend.employee_analytic_reports.employee_analytics', compact('grouped', 'departments', 'start_date', 'end_date'));
        //     }
        // //    return view('backend.employee_analytic_reports.employee_analytics');
           
        // }

        // Employee analytics report method
        public function getemployeeanalytics(Request $request)
        {
            $start_date = $request->input('start_date');
            $end_date = $request->input('end_date');
        
            $employeeData = null;
        
            if ($start_date && $end_date) {
                   // Convert end date to include the full day
                   $start_date = Carbon::parse($request->input('start_date'))->startOfDay();
                   $end_date = Carbon::parse($request->input('end_date'))->endOfDay();

                $reportModel = new DailyReportField();
                $employeeData = $reportModel->getEmployeeStats($start_date, $end_date);
            }
        
            return view('backend.employee_analytic_reports.employee_analytics', compact('employeeData', 'start_date', 'end_date'));
        }


        // Company Wise Billing Report
        // public function getcompanywisebilingreport(Request $request){

        // // Fetch employees, projects, and tickets
        // $employees = EmployeeHelper::getEmployeeNames();
        // $projects = ProjectHelper::getProjectNames();
        // $tickets = TicketHelper::getTicketNames();
        // $billingCompanies = ProjectHelper::getBillingCompanies();
        // $biilingtype = ProjectHelper::getbiilingtype();


        //      return view('backend.reports.comapnywisebillingreport.manage', 
        //      compact('employees','projects','tickets','billingCompanies','biilingtype'));

        // }
  

        // working fine with billcomp fetch from dailyreportfield

    // public function getcompanywisebilingreport(Request $request)
    // {
    //     $query = DailyReportField::with('user');

    //     // 1. Date range filter (fixed to include end date)
    //     // if ($request->filled('start_date') && $request->filled('end_date')) {
    //     //     $startDate = Carbon::parse($request->start_date)->startOfDay();
    //     //     $endDate = Carbon::parse($request->end_date)->endOfDay();
    //     //     $query->whereBetween('created_at', [$startDate, $endDate]);
    //     // }
    //     if ($request->filled('start_date') && $request->filled('end_date')) {
    //         // Both dates provided
    //         $startDate = Carbon::parse($request->start_date)->startOfDay();
    //         $endDate = Carbon::parse($request->end_date)->endOfDay();
    //         $query->whereBetween('created_at', [$startDate, $endDate]);
    //     } elseif ($request->filled('start_date')) {
    //         // Only start date provided
    //         $startDate = Carbon::parse($request->start_date)->startOfDay();
    //         $query->where('created_at', '>=', $startDate);
    //     } elseif ($request->filled('end_date')) {
    //         // Only end date provided
    //         $endDate = Carbon::parse($request->end_date)->endOfDay();
    //         $query->where('created_at', '<=', $endDate);
    //     }


    //     // 2. Employee filter
    //     if ($request->filled('employee')) {
    //         $query->where('user_id', $request->employee);
    //     }

    //     // 3. Project/Ticket filter
    //     // if (
    //     //     $request->filled('project_ticket') &&
    //     //     $request->project_ticket !== 'none' &&
    //     //     $request->filled('select_project')
    //     // ) {
    //     //     if ($request->project_ticket == '1') {
    //     //         $query->where('type', 1)->where('project_id', $request->select_project);
    //     //     } elseif ($request->project_ticket == '2') {
    //     //         $query->where('type', 2)->where('project_id', $request->select_project);
    //     //     }
    //     // }
    //     if ($request->project_ticket === '1') {
    //         $query->where('type', 1); // Only projects

    //         if ($request->filled('select_project')) {
    //             $query->where('project_id', $request->select_project);
    //         }

    //     } elseif ($request->project_ticket === '2') {
    //         $query->where('type', 2); // Only tickets

    //         if ($request->filled('select_project')) {
    //             $query->where('project_id', $request->select_project);
    //         }

    //     } elseif ($request->project_ticket === 'none') {
    //         // Do not filter by type at all
    //     }

    //     // 4. Billing Type filter
    //     if ($request->filled('billing_type') && $request->billing_type !== 'none') {
    //         $query->where('billable_type', $request->billing_type);
    //     }

    //     // 5. Modified Billing Company filter
    //    // Filter logic for billing company
    //     if ($request->filled('billing_company') && $request->billing_company !== 'all') {
    //         if ($request->billing_company === 'none') {
    //             $query->where(function($q) {
    //                 $q->whereNull('se_bill_company')
    //                 ->orWhere('se_bill_company', 0);
    //             });
    //         } else {
    //             $query->where('se_bill_company', $request->billing_company);
    //         }
    //     }
    //     // If 'all' is selected or billing_company not provided, show all records

    //     $results = $query->get();

    //     // Fetch additional data
    //     $employees = EmployeeHelper::getEmployeeNames();
    //     $projects = ProjectHelper::getProjectNames();
    //     $tickets = TicketHelper::getTicketNames();
        
    //     $billingCompanies = ProjectHelper::getBillingCompanies();
    //     $biilingtype = ProjectHelper::getbiilingtype();
    //             // $biilingtype = ProjectHelper::getbiilingtype();
    //         return view('backend.reports.comapnywisebillingreport.manage', compact(
    //             'results',
    //             'employees',
    //             'projects',
    //             'tickets',
    //             'biilingtype',
    //             'billingCompanies'
    //         ));
            //     }

        public function getcompanywisebilingreport(Request $request)
        {

            
            // Start with base query
            $query = DailyReportField::with(['user', 'project'])
                ->leftJoin('si_projects', function($join) {
                    $join->on('si_daily_report_fields.project_id', '=', 'si_projects.id')
                        ->where('si_daily_report_fields.type', 1); // Only join for projects (type=1)
                });

            // Date range filter
            if ($request->filled('start_date') && $request->filled('end_date')) {
                $startDate = Carbon::parse($request->start_date)->startOfDay();
                $endDate = Carbon::parse($request->end_date)->endOfDay();
                $query->whereBetween('si_daily_report_fields.created_at', [$startDate, $endDate]);
            } elseif ($request->filled('start_date')) {
                $startDate = Carbon::parse($request->start_date)->startOfDay();
                $query->where('si_daily_report_fields.created_at', '>=', $startDate);
            } elseif ($request->filled('end_date')) {
                $endDate = Carbon::parse($request->end_date)->endOfDay();
                $query->where('si_daily_report_fields.created_at', '<=', $endDate);
            }

            // Employee filter
            // if ($request->filled('employee')) {
            //     $query->where('si_daily_report_fields.user_id', $request->employee);
            // }

            //2. Employee filter
                if ($request->filled('employee')) {
                    $query->where('user_id', $request->employee);
                }


            // Project/Ticket filter
            if ($request->project_ticket === '1') {
                $query->where('si_daily_report_fields.type', 1); // Only projects
                if ($request->filled('select_project')) {
                    $query->where('si_daily_report_fields.project_id', $request->select_project);
                }
            } elseif ($request->project_ticket === '2') {
                $query->where('si_daily_report_fields.type', 2); // Only tickets
                if ($request->filled('select_project')) {
                    $query->where('si_daily_report_fields.project_id', $request->select_project);
                }
            }

            // Billing Type filter
            if ($request->filled('billing_type') && $request->billing_type !== 'none') {
                $query->where('si_daily_report_fields.billable_type', $request->billing_type);
            }

            // Billing Company filter
            if ($request->filled('billing_company') && $request->billing_company !== 'all') {
                if ($request->billing_company === 'none') {
                    // For projects with NULL billing company
                    $query->whereNull('si_projects.biiling_company'); // Make sure to fix typo here if necessary
                } else {
                    $query->where('si_projects.biiling_company', $request->billing_company);
                }
            }

            // Clone the query BEFORE pagination for accurate sums
            $sumQuery = clone $query;

            // Get results with selected columns
            $results = $query->select(
                'si_daily_report_fields.*',
                'si_projects.biiling_company as project_billing_company',
                'si_projects.manager',
                'si_projects.team_leader',
                'si_projects.team_members'
            )->paginate(30);

            // Get billing companies from ProjectHelper
            $billingCompanies = ProjectHelper::getBillingCompanies();

            // Map results to include billing company from project
            // $results = $results->map(function($item) use ($billingCompanies) {
            //     // For projects, use the joined project billing company
            //     if ($item->type == 1 && $item->project_billing_company !== null) {
            //         $item->billing_company_name = $billingCompanies[$item->project_billing_company] ?? 'N/A';
            //     } 
            //     // For tickets or when no project found, show N/A
            //     else {
            //         $item->billing_company_name = 'N/A';
            //     }
            //     return $item;
            // });
            $results->getCollection()->transform(function($item) use ($billingCompanies) {
                if ($item->type == 1 && $item->project_billing_company !== null) {
                    $item->billing_company_name = $billingCompanies[$item->project_billing_company] ?? 'N/A';
                } else {
                    $item->billing_company_name = 'N/A';
                }
                return $item;
            });



            // $billable = (clone $query)->where('billable_type', 1)->sum('hrs');
            // $nonBillable = (clone $query)->where('billable_type', 0)->sum('hrs');
            // $internalBillable = (clone $query)->where('billable_type', 2)->sum('hrs');
            $billable = (clone $sumQuery)->where('billable_type', 1)->sum('hrs');
            $nonBillable = (clone $sumQuery)->where('billable_type', 0)->sum('hrs');
            $internalBillable = (clone $sumQuery)->where('billable_type', 2)->sum('hrs');


            $total = $billable + $nonBillable + $internalBillable;

            $billablePercent = $total > 0 ? round(($billable / $total) * 100, 2) : 0;
            $nonBillablePercent = $total > 0 ? round(($nonBillable / $total) * 100, 2) : 0;
            $internalPercent = $total > 0 ? round(($internalBillable / $total) * 100, 2) : 0;


            // Fetch additional data
            $employees = EmployeeHelper::getEmployeeNames();
            $projects = ProjectHelper::getProjectNames();
            $tickets = TicketHelper::getTicketNames();
            $biilingtype = ProjectHelper::getbiilingtype();

            return view('backend.reports.comapnywisebillingreport.manage', compact(
              'results',
    'employees',
                'projects',
                'tickets',
                'biilingtype',
                'billingCompanies',
                'billable',
                'nonBillable',
                'internalBillable',
                'billablePercent',
                'nonBillablePercent',
                'internalPercent',
                'total'
            ));
        }

        
        public function compnaywisebillableexportPdf(Request $request)
        {
            // Reuse the same query logic from your main method
            $query = DailyReportField::with(['user', 'project'])
                ->leftJoin('si_projects', function($join) {
                    $join->on('si_daily_report_fields.project_id', '=', 'si_projects.id')
                        ->where('si_daily_report_fields.type', 1);
                });

            // Date range filter
            if ($request->filled('start_date') && $request->filled('end_date')) {
                $startDate = Carbon::parse($request->start_date)->startOfDay();
                $endDate = Carbon::parse($request->end_date)->endOfDay();
                $query->whereBetween('si_daily_report_fields.created_at', [$startDate, $endDate]);
            } elseif ($request->filled('start_date')) {
                $startDate = Carbon::parse($request->start_date)->startOfDay();
                $query->where('si_daily_report_fields.created_at', '>=', $startDate);
            } elseif ($request->filled('end_date')) {
                $endDate = Carbon::parse($request->end_date)->endOfDay();
                $query->where('si_daily_report_fields.created_at', '<=', $endDate);
            }

            // Employee filter
            if ($request->filled('employee')) {
                $query->where('user_id', $request->employee);
            }

            // Project/Ticket filter
            if ($request->project_ticket === '1') {
                $query->where('si_daily_report_fields.type', 1);
                if ($request->filled('select_project')) {
                    $query->where('si_daily_report_fields.project_id', $request->select_project);
                }
            } elseif ($request->project_ticket === '2') {
                $query->where('si_daily_report_fields.type', 2);
                if ($request->filled('select_project')) {
                    $query->where('si_daily_report_fields.project_id', $request->select_project);
                }
            }

            // Billing Type filter
            if ($request->filled('billing_type') && $request->billing_type !== 'none') {
                $query->where('si_daily_report_fields.billable_type', $request->billing_type);
            }

            // Billing Company filter
            if ($request->filled('billing_company') && $request->billing_company !== 'all') {
                if ($request->billing_company === 'none') {
                    $query->whereNull('si_projects.biiling_company');
                } else {
                    $query->where('si_projects.biiling_company', $request->billing_company);
                }
            }

            // Get results
            $results = $query->select(
                'si_daily_report_fields.*',
                'si_projects.biiling_company as project_billing_company',
                'si_projects.manager',
                'si_projects.team_leader',
                'si_projects.team_members'
            )->get();

            // Get billing companies
            $billingCompanies = ProjectHelper::getBillingCompanies();

            // Map results with billing company names
            $results = $results->map(function($item) use ($billingCompanies) {
                if ($item->type == 1 && $item->project_billing_company !== null) {
                    $item->billing_company_name = $billingCompanies[$item->project_billing_company] ?? 'N/A';
                } else {
                    $item->billing_company_name = 'N/A';
                }
                return $item;
            });

            // Calculate summary stats
            $billable = (clone $query)->where('billable_type', 1)->sum('hrs');
            $nonBillable = (clone $query)->where('billable_type', 0)->sum('hrs');
            $internalBillable = (clone $query)->where('billable_type', 2)->sum('hrs');
            $total = $billable + $nonBillable + $internalBillable;

            $billablePercent = $total > 0 ? round(($billable / $total) * 100, 2) : 0;
            $nonBillablePercent = $total > 0 ? round(($nonBillable / $total) * 100, 2) : 0;
            $internalPercent = $total > 0 ? round(($internalBillable / $total) * 100, 2) : 0;

            // Get employee name if filtered
            $employeeName = '';
            if ($request->filled('employee')) {
                $employees = EmployeeHelper::getEmployeeNames();
                $employeeName = $employees[$request->employee] ?? 'Unknown Employee';
            }

            // Generate PDF title
            $title = 'All (Project, Ticket, Meeting and Other) - Company Wise Billing Report';
            
            if ($request->filled('start_date') && $request->filled('end_date')) {
                $start = Carbon::parse($request->start_date)->format('d-M-y');
                $end = Carbon::parse($request->end_date)->format('d-M-y');
                $title .= " from $start to $end";
            } elseif ($request->filled('start_date')) {
                $start = Carbon::parse($request->start_date)->format('d-M-y');
                $title .= " from $start";
            } elseif ($request->filled('end_date')) {
                $end = Carbon::parse($request->end_date)->format('d-M-y');
                $title .= " until $end";
            }

            if ($request->filled('employee')) {
                $title .= " - Employee: $employeeName (ID: {$request->employee})";
            }

           
           // Prepare data for the PDF view
            $pdfData = [
                'results' => $results,
                'billable' => $billable,
                'nonBillable' => $nonBillable,
                'internalBillable' => $internalBillable,
                'billablePercent' => $billablePercent,
                'nonBillablePercent' => $nonBillablePercent,
                'internalPercent' => $internalPercent,
                'total' => $total,
                // Pass raw data instead of formatted string
                'reportType' => 'All (Project, Ticket, Meeting and Other)',
                'startDate' => $request->filled('start_date') ? Carbon::parse($request->start_date)->format('d-M-y') : null,
                'endDate' => $request->filled('end_date') ? Carbon::parse($request->end_date)->format('d-M-y') : null,
                'employeeData' => $request->filled('employee') ? [
                    'id' => $request->employee,
                    'name' => $employees[$request->employee] ?? 'Unknown Employee'
                ] : null
            ];

            $pdf = PDF::loadView('backend.reports.comapnywisebillingreport.company_report_pdf', $pdfData)
                    ->setPaper('a4', 'landscape');

            return $pdf->download('companywise_billing_report_'.now()->format('YmdHis').'.pdf');
        }

//       public function getcompanywisebilingreport(Request $request)
// {
//     // Build main query
//     $query = DailyReportField::with(['user'])
//         ->select(
//             'si_daily_report_fields.*',
//             'users.name as user_name',
//             'users.department'
//         )
//         ->join('users', 'users.id', '=', 'si_daily_report_fields.user_id');

//     // Date range filter
//     if ($request->filled('start_date') && $request->filled('end_date')) {
//         $start = Carbon::parse($request->start_date)->startOfDay();
//         $end = Carbon::parse($request->end_date)->endOfDay();
//         $query->whereBetween('si_daily_report_fields.created_at', [$start, $end]);
//     }

//     // Employee filter
//     if ($request->filled('employee')) {
//         $query->where('users.id', $request->employee);
//     }

//     // Project/Ticket filter
//     if ($request->filled('project_ticket') && $request->project_ticket !== 'none') {
//         if ($request->project_ticket == 'project' && $request->filled('select_project')) {
//             $query->where('si_daily_report_fields.type', 1)
//                 ->where('si_daily_report_fields.project_id', $request->select_project);
//         } elseif ($request->project_ticket == 'ticket' && $request->filled('select_project')) {
//             $query->where('si_daily_report_fields.type', 2)
//                 ->where('si_daily_report_fields.ticket_id', $request->select_project);
//         }
//     }

//     // Billing Type filter
//     if ($request->filled('billing_type') && $request->billing_type !== 'none') {
//         $query->where('si_daily_report_fields.billable_type', $request->billing_type);
//     }

//     // Billing Company filter - only apply if something is selected
//     if ($request->filled('billing_company') && $request->billing_company !== '') {
//         if ($request->billing_company === 'not_available') {
//             $query->whereNull('si_daily_report_fields.se_bill_company');
//         } else {
//             $query->where('si_daily_report_fields.se_bill_company', $request->billing_company);
//         }
//     }
//     // If no billing company is selected, all records will be returned

//     $results = $query->get();

//             // Fetch dropdown data
//             $employees = EmployeeHelper::getEmployeeNames();
//             $projects = ProjectHelper::getProjectNames();
//             $tickets = TicketHelper::getTicketNames();
//             $billingCompanies = ProjectHelper::getBillingCompanies();
//             $biilingtype = ProjectHelper::getbiilingtype();

//             return view('backend.reports.comapnywisebillingreport.manage', compact(
//                 'results',
//                 'employees',
//                 'projects',
//                 'tickets',
//                 'biilingtype',
//                 'billingCompanies'
//             ));
//         }
        
}
