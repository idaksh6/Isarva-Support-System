<?php

namespace App\Http\Controllers\Backend\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\EmployeeHelper;
use App\Helpers\ProjectHelper;
use App\Models\Backend\DailyReportField;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Helpers\TicketHelper;
use App\Models\Backend\User;
use Carbon\Carbon;


class BillableNonBillableController extends Controller
{
    
    
              
    // public function index(Request $request)
    // {
    //     // Fetch employees, projects, and tickets
    //     $employees = EmployeeHelper::getEmployeeNames();
    //     $projects = ProjectHelper::getProjectNames();
    //     $tickets = TicketHelper::getTicketNames();
    
    //     // Prepare search filters
    //     $filters = [
    //         'start_date' => $request->input('start_date'),
    //         'end_date' => $request->input('end_date'),
    //         'employee' => $request->input('employee'),
    //         'project_ticket' => $request->input('project_ticket'),
    //         'select_project' => $request->input('select_project'),
    //     ];
    
    //     // Check if billing type filter is applied
    //     $billingTypeFilter = $request->filled('billing_type') && $request->billing_type !== 'none' 
    //         ? $request->billing_type 
    //         : null;
    
    //     // Fetch search results
    //     $query = DailyReportField::query()->with('user');
    
    //     // Set default dates if not provided
    //     $startDate = $request->filled('start_date') ? $request->start_date : now()->subDay()->toDateString();
    //     $endDate = $request->filled('end_date') ? Carbon::parse($request->end_date)->endOfDay()
    //     ->toDateTimeString(): Carbon::now()->endOfDay()->toDateTimeString();

    //     // Only apply date filter if dates are different from defaults or explicitly set
  
    //     if ($request->has('start_date') || $request->has('end_date')) {
    //         $query->where('created_at', '>=', $request->filled('start_date') ? $request->start_date : '1970-01-01')
    //             ->where('created_at', '<=', $request->filled('end_date') ? Carbon::parse($request->end_date)->endOfDay() : Carbon::now()->endOfDay());
    //     }
    
    //     // Employee filter
    //     if (!empty($filters['employee'])) {
    //         $query->where('user_id', $filters['employee']);
    //     }
    
    //     // Project/Ticket filter
    //     if (!empty($filters['project_ticket'])) {
    //         if ($filters['project_ticket'] === 'project') {
    //             $query->where('type', 1); // Only projects
    //             if (!empty($filters['select_project'])) {
    //                 $query->where('project_id', $filters['select_project']);
    //             }
    //         } elseif ($filters['project_ticket'] === 'ticket') {
    //             $query->where('type', 2); // Only tickets
    //             if (!empty($filters['select_project'])) {
    //                 $query->where('project_id', $filters['select_project']);
    //             }
    //         }
    //     }
    
    //     // Billing type filter
    //     if ($billingTypeFilter !== null) {
    //         $query->where('billable_type', $billingTypeFilter);
    //     }
    
    //     // Calculate totals
    //     $totals = [
    //         'billable' => (clone $query)->where('billable_type', 1)->sum('hrs'),
    //         'non_billable' => (clone $query)->where('billable_type', 0)->sum('hrs'),
    //         'internal_billable' => (clone $query)->where('billable_type', 2)->sum('hrs'),
    //     ];



    
    //     // If specific billing type is selected, adjust totals
    //     if ($billingTypeFilter !== null) {
    //         $totals = [
    //             'billable' => $billingTypeFilter == 1 ? $query->sum('hrs') : 0,
    //             'non_billable' => $billingTypeFilter == 0 ? $query->sum('hrs') : 0,
    //             'internal_billable' => $billingTypeFilter == 2 ? $query->sum('hrs') : 0,
    //         ];
    //     }
    
    //     // Fetch results
    //     $reports = $request->hasAny(array_keys($filters)) || $billingTypeFilter !== null 
    //         ? $query->paginate(10) 
    //         : collect();
    
    //     return view('backend.reports.billable_nonbillable', compact('employees', 'projects', 'tickets', 'reports', 'totals'));
    // }


    
    public function index(Request $request)
    {
        // Fetch employees, projects, and tickets
        $employees = EmployeeHelper::getEmployeeNames();
        $projects = ProjectHelper::getProjectNames();
        $tickets = TicketHelper::getTicketNames();
    
        // Prepare search filters
        $filters = [
            'start_date' => $request->input('start_date'),
            'end_date' => $request->input('end_date'),
            'employee' => $request->input('employee'),
            'project_ticket' => $request->input('project_ticket'),
            'select_project' => $request->input('select_project'),
        ];
    
        // Check if billing type filter is applied
        $billingTypeFilter = $request->filled('billing_type') && $request->billing_type !== 'none' 
            ? $request->billing_type 
            : null;
    
        // Fetch search results
        $query = DailyReportField::query()->with('user');
    
        // Set default dates if not provided
        $startDate = $request->filled('start_date') ? $request->start_date : now()->subDay()->toDateString();
        $endDate = $request->filled('end_date') ? Carbon::parse($request->end_date)->endOfDay()
        ->toDateTimeString(): Carbon::now()->endOfDay()->toDateTimeString();

        // Only apply date filter if dates are different from defaults or explicitly set
  
        if ($request->has('start_date') || $request->has('end_date')) {
            $query->where('created_at', '>=', $request->filled('start_date') ? $request->start_date : '1970-01-01')
                ->where('created_at', '<=', $request->filled('end_date') ? Carbon::parse($request->end_date)->endOfDay() : Carbon::now()->endOfDay());
        }
    
        // Employee filter
        if (!empty($filters['employee'])) {
            $query->where('user_id', $filters['employee']);
        }
    
        // Project/Ticket filter
        if (!empty($filters['project_ticket'])) {
            if ($filters['project_ticket'] === 'project') {
                $query->where('type', 1); // Only projects
                if (!empty($filters['select_project'])) {
                    $query->where('project_id', $filters['select_project']);
                }
            } elseif ($filters['project_ticket'] === 'ticket') {
                $query->where('type', 2); // Only tickets
                if (!empty($filters['select_project'])) {
                    $query->where('project_id', $filters['select_project']);
                }
            }
        }
    
        // Billing type filter
        if ($billingTypeFilter !== null) {
            $query->where('billable_type', $billingTypeFilter);
        }
    
        // Calculate totals
        $totals = [
            'billable' => (clone $query)->where('billable_type', 1)->sum('hrs'),
            'non_billable' => (clone $query)->where('billable_type', 0)->sum('hrs'),
            'internal_billable' => (clone $query)->where('billable_type', 2)->sum('hrs'),
        ];


       

    
        // If specific billing type is selected, adjust totals
        if ($billingTypeFilter !== null) {
            $totals = [
                'billable' => $billingTypeFilter == 1 ? $query->sum('hrs') : 0,
                'non_billable' => $billingTypeFilter == 0 ? $query->sum('hrs') : 0,
                'internal_billable' => $billingTypeFilter == 2 ? $query->sum('hrs') : 0,
            ];
        }
    
        // Fetch results
        $reports = $request->hasAny(array_keys($filters)) || $billingTypeFilter !== null 
            ? $query->paginate(10) 
            : collect();







         $dailyBreakdown = [];

        if ($reports->count() > 0) {
            $clonedQuery = (clone $query)->get()->groupBy(function($item) {
                return Carbon::parse($item->created_at)->format('Y-m-d');
            });

            foreach ($clonedQuery as $date => $entries) {
                $billable = $entries->where('billable_type', 1)->sum('hrs');
                $nonBillable = $entries->where('billable_type', 0)->sum('hrs');
                $internalBillable = $entries->where('billable_type', 2)->sum('hrs');
                $total = $billable + $nonBillable + $internalBillable;

                $dailyBreakdown[$date] = [
                    'billable' => $billable,
                    'non_billable' => $nonBillable,
                    'internal_billable' => $internalBillable,
                    'billable_percent' => $total > 0 ? number_format(($billable / $total) * 100, 2) : 0,
                    'non_billable_percent' => $total > 0 ? number_format(($nonBillable / $total) * 100, 2) : 0,
                    'internal_billable_percent' => $total > 0 ? number_format(($internalBillable / $total) * 100, 2) : 0,
                ];
            }
        }
    
        return view('backend.reports.billable_nonbillable', compact('employees', 
        'projects', 'tickets', 'reports', 'totals','dailyBreakdown'));
    }

    

    public function exportPdf(Request $request)
    {
        // Prepare search filters (same as index method)
        $filters = [
            'start_date'     => $request->input('start_date'),
            'end_date'       => $request->input('end_date'),
            'employee'       => $request->input('employee'),
            'project_ticket' => $request->input('project_ticket'),
            'select_project' => $request->input('select_project'),
        ];
    
        // Check if billing type filter is applied
        $billingTypeFilter = $request->filled('billing_type') && $request->billing_type !== 'none' 
            ? $request->billing_type 
            : null;
    
        // Build query (same as index method)
        $query = DailyReportField::query()->with('user');
    
        // Same logic as index method
        $startDate = $request->filled('start_date') ? $request->start_date : now()->subDay()->toDateString();
        $endDate = $request->filled('end_date') ? Carbon::parse($request->end_date)->endOfDay()
            ->toDateTimeString(): Carbon::now()->endOfDay()->toDateTimeString();

        if ($request->has('start_date') || $request->has('end_date')) {
            $query->where('created_at', '>=', $request->filled('start_date') ? $request->start_date : '1970-01-01')
                ->where('created_at', '<=', $request->filled('end_date') ? Carbon::parse($request->end_date)->endOfDay() : Carbon::now()->endOfDay());
        }
    
        // Employee filter
        if (!empty($filters['employee'])) {
            $query->where('user_id', $filters['employee']);
        }
    
        // Project/Ticket filter
        if (!empty($filters['project_ticket'])) {
            if ($filters['project_ticket'] === 'project') {
                $query->where('type', 1); // Only projects
                if (!empty($filters['select_project'])) {
                    $query->where('project_id', $filters['select_project']);
                }
            } elseif ($filters['project_ticket'] === 'ticket') {
                $query->where('type', 2); // Only tickets
                if (!empty($filters['select_project'])) {
                    $query->where('project_id', $filters['select_project']);
                }
            }
        }
    
        // Billing type filter
        if ($billingTypeFilter !== null) {
            $query->where('billable_type', $billingTypeFilter);
        }
    
        // Calculate totals (same as index method)
        $totals = [
            'billable' => (clone $query)->where('billable_type', 1)->sum('hrs'),
            'non_billable' => (clone $query)->where('billable_type', 0)->sum('hrs'),
            'internal_billable' => (clone $query)->where('billable_type', 2)->sum('hrs'),
        ];
    
        // If specific billing type is selected, adjust totals
        if ($billingTypeFilter !== null) {
            $totals = [
                'billable' => $billingTypeFilter == 1 ? $query->sum('hrs') : 0,
                'non_billable' => $billingTypeFilter == 0 ? $query->sum('hrs') : 0,
                'internal_billable' => $billingTypeFilter == 2 ? $query->sum('hrs') : 0,
            ];
        }
    
        // Get all results (without pagination)
        $reports = $query->get();
    
        // Pass data to PDF view including the request parameters
        $data = [
            'reports' => $reports,
            'totals' => $totals,
            'request' => $request // Pass the request object to access filters in the view
        ];
        
        // Load the PDF view
        $pdf = PDF::loadView('backend.reports.billable_pdf', $data);
        $pdf->setPaper('A4', 'landscape');

        
        // Download the PDF file
        return $pdf->download('billable-report-'.now()->format('Y-m-d').'.pdf');
    }


        public function getconsolidatedreport(Request $request)
        {
            $startDate = $request->input('start_date');
            $endDate = $request->input('end_date');

            //  // Adjust end date to include the entire day
            // if ($endDate) {
            //     $endDate = Carbon::parse($endDate)->endOfDay()->toDateTimeString();
            // }

            // Get the report data organized by department
            $result = DailyReportField::getConsolidatedReportData($startDate, $endDate);
            
            // Calculate grand totals for the global total row
            $grandTotal = array_sum([
                $result['totals']['billable'],
                $result['totals']['non_billable'],
                $result['totals']['internal']
            ]);
            
            // Create the global total row
            $globalTotalRow = $this->createTotalRow($result['totals'], $grandTotal);
            
            // Add the global total row to each department's data
            foreach ($result['department_data'] as &$department) {
                // Calculate department base for percentages
                $departmentBase = array_sum([
                    $department['totals']['billable'],
                    $department['totals']['non_billable'],
                    $department['totals']['internal']
                ]);
                
                // Add department total row
                $department['total_row'] = [
                    'si_no' => '',
                    'employee_name' => 'Department Total',
                    'billable_hrs' => $department['totals']['billable'],
                    'billable_percent' => $departmentBase > 0 ? ($department['totals']['billable'] / $departmentBase) * 100 : 0,
                    'non_billable_hrs' => $department['totals']['non_billable'],
                    'non_billable_percent' => $departmentBase > 0 ? ($department['totals']['non_billable'] / $departmentBase) * 100 : 0,
                    'internal_hrs' => $department['totals']['internal'],
                    'internal_percent' => $departmentBase > 0 ? ($department['totals']['internal'] / $departmentBase) * 100 : 0,
                    'is_total' => true
                ];
            }

            return view('backend.reports.consolidatedreports.consolidated_dailyreport', [
                'departmentData' => $result['department_data'],
                'globalTotalRow' => $globalTotalRow,
                'totals' => $result['totals'],
                'startDate' => $startDate,
                'endDate' => $endDate
            ]);
        }

        protected function createTotalRow($totals, $grandTotal)
        {
            $base = $grandTotal > 0 ? $grandTotal : 1;
            
            return [
                'si_no' => '',
                'employee_name' => 'Grand Total',
                'billable_hrs' => $totals['billable'],
                'billable_percent' => ($totals['billable'] / $base) * 100,
                'non_billable_hrs' => $totals['non_billable'],
                'non_billable_percent' => ($totals['non_billable'] / $base) * 100,
                'internal_hrs' => $totals['internal'],
                'internal_percent' => ($totals['internal'] / $base) * 100,
                'project_billable' => $totals['project_billable'],
                'project_non_billable' => $totals['project_non_billable'],
                'project_internal' => $totals['project_internal'],
                'ticket_billable' => $totals['ticket_billable'],
                'ticket_non_billable' => $totals['ticket_non_billable'],
                'ticket_internal' => $totals['ticket_internal'],
                'project_total' => $totals['project_total'],
                'ticket_total' => $totals['ticket_total'],
                'is_total' => true
            ];
        }


        public function exportconsolidatedreportToPdf(Request $request)
        {
            $startDate = $request->input('start_date');
            $endDate = $request->input('end_date');

            // Get the report data (same as your getconsolidatedreport method)
            $result = DailyReportField::getConsolidatedReportData($startDate, $endDate);
            
            $grandTotal = array_sum([
                $result['totals']['billable'],
                $result['totals']['non_billable'],
                $result['totals']['internal']
            ]);
            
            $globalTotalRow = $this->createTotalRow($result['totals'], $grandTotal);
            
            foreach ($result['department_data'] as &$department) {
                $departmentBase = array_sum([
                    $department['totals']['billable'],
                    $department['totals']['non_billable'],
                    $department['totals']['internal']
                ]);
                
                $department['total_row'] = [
                    'si_no' => '',
                    'employee_name' => 'Department Total',
                    'billable_hrs' => $department['totals']['billable'],
                    'billable_percent' => $departmentBase > 0 ? ($department['totals']['billable'] / $departmentBase) * 100 : 0,
                    'non_billable_hrs' => $department['totals']['non_billable'],
                    'non_billable_percent' => $departmentBase > 0 ? ($department['totals']['non_billable'] / $departmentBase) * 100 : 0,
                    'internal_hrs' => $department['totals']['internal'],
                    'internal_percent' => $departmentBase > 0 ? ($department['totals']['internal'] / $departmentBase) * 100 : 0,
                    'is_total' => true
                ];
            }

            // Generate HTML for PDF
            $html = view('backend.reports.consolidatedreports.consolidated_report-pdf', [
                'departmentData' => $result['department_data'],
                'globalTotalRow' => $globalTotalRow,
                'totals' => $result['totals'],
                'startDate' => $startDate,
                'endDate' => $endDate
            ])->render();

            // PDF options
            $options = new \Dompdf\Options();
            $options->set('isHtml5ParserEnabled', true);
            $options->set('isRemoteEnabled', true);

            // Generate PDF
            $pdf = PDF::loadHTML($html);
            // $pdf->setOptions($options);
            $pdf->setPaper('A4', 'landscape');

            // Download the PDF
            return $pdf->download('consolidated_report_'.now()->format('Y-m-d').'.pdf');
        }
            
    
}