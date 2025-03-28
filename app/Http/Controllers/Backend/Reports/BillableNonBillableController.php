<?php

namespace App\Http\Controllers\Backend\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\EmployeeHelper;
use App\Helpers\ProjectHelper;
use App\Models\Backend\DailyReportField;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Helpers\TicketHelper;


class BillableNonBillableController extends Controller
{
    
   

     // Works Fine BEFORE TICKET SECTION 28/03/2025
  
    //  public function index(Request $request)
    //  {
    //      // Fetch employees and projects
    //      $employees = EmployeeHelper::getEmployeeNames();
    //      $projects = ProjectHelper::getProjectNames();
    //      $tickets = TicketHelper::getTicketNames();
     
    //      // Prepare search filters
    //      $filters = [
    //          'start_date' => $request->input('start_date'),
    //          'end_date' => $request->input('end_date'),
    //          'employee' => $request->input('employee'),
    //          'project_ticket' => $request->input('project_ticket'),
    //          'select_project' => $request->input('select_project'),
    //      ];
     
    //      // Check if billing type filter is applied
    //      $billingTypeFilter = $request->filled('billing_type') && $request->billing_type !== 'none' 
    //          ? $request->billing_type 
    //          : null;
     
    //      // Fetch total hours with all filters
    //      $totals = DailyReportField::getTotalHours($filters, $billingTypeFilter);
     
    //      // If a specific billing type is selected, adjust totals display
    //      if ($billingTypeFilter !== null) {
    //          $totals = [
    //              'billable' => $billingTypeFilter == 1 ? $totals : 0,
    //              'non_billable' => $billingTypeFilter == 0 ? $totals : 0,
    //              'internal_billable' => $billingTypeFilter == 2 ? $totals : 0,
    //          ];
    //      }
     
    //      // Fetch search results
    //      $query = DailyReportField::query()->with('user');
     
    //      if (!empty($filters['start_date']) && !empty($filters['end_date'])) {
    //          $query->whereBetween('created_at', [$filters['start_date'], $filters['end_date']]);
    //      }
     
    //      if (!empty($filters['employee'])) {
    //          $query->where('user_id', $filters['employee']);
    //      }
     
    //      if (!empty($filters['project_ticket']) && !empty($filters['select_project'])) {
    //          if ($filters['project_ticket'] === 'project') {
    //              $query->where('type', 1)->where('project_name', $filters['select_project']);
    //          } elseif ($filters['project_ticket'] === 'ticket') {
    //              $query->where('type', 2)->where('project_name', $filters['select_project']);
    //          }
    //      }
     
    //      if ($billingTypeFilter !== null) {
    //          $query->where('billable_type', $billingTypeFilter);
    //      }
     
    //      // Fetch results only if search is triggered
    //      $reports = $request->hasAny(array_keys($filters)) || $billingTypeFilter !== null 
    //          ? $query->paginate(10) 
    //          : collect();
     
    //      return view('backend.reports.billable_nonbillable', compact('employees', 'projects', 'tickets', 'reports', 'totals'));
    //  }
              
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
    
        // Date range filter
        if (!empty($filters['start_date']) && !empty($filters['end_date'])) {
            $query->whereBetween('created_at', [$filters['start_date'], $filters['end_date']]);
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
    
        return view('backend.reports.billable_nonbillable', compact('employees', 'projects', 'tickets', 'reports', 'totals'));
    }

    // WORKS FINE without ticket
    
    // public function exportPdf(Request $request)
    // {
    //     // Prepare search filters (same as index method)
    //     $filters = [
    //         'start_date' => $request->input('start_date'),
    //         'end_date' => $request->input('end_date'),
    //         'employee' => $request->input('employee'),
    //         'project_ticket' => $request->input('project_ticket'),
    //         'select_project' => $request->input('select_project'),
    //     ];

    //     // Check if billing type filter is applied (same as index)
    //     $billingTypeFilter = $request->filled('billing_type') && $request->billing_type !== 'none' 
    //         ? $request->billing_type 
    //         : null;

    //     // Fetch total hours with all filters (same as index)
    //     $totals = DailyReportField::getTotalHours($filters, $billingTypeFilter);

    //     // If a specific billing type is selected, adjust totals display (same as index)
    //     if ($billingTypeFilter !== null) {
    //         $totals = [
    //             'billable' => $billingTypeFilter == 1 ? $totals : 0,
    //             'non_billable' => $billingTypeFilter == 0 ? $totals : 0,
    //             'internal_billable' => $billingTypeFilter == 2 ? $totals : 0,
    //         ];
    //     }

    //     // Build query (same as index method)
    //     $query = DailyReportField::query()->with('user');

    //     if (!empty($filters['start_date']) && !empty($filters['end_date'])) {
    //         $query->whereBetween('created_at', [$filters['start_date'], $filters['end_date']]);
    //     }

    //     if (!empty($filters['employee'])) {
    //         $query->where('user_id', $filters['employee']);
    //     }

    //     if (!empty($filters['project_ticket']) && !empty($filters['select_project'])) {
    //         if ($filters['project_ticket'] === 'project') {
    //             $query->where('type', 1)->where('project_name', $filters['select_project']);
    //         } elseif ($filters['project_ticket'] === 'ticket') {
    //             $query->where('type', 2)->where('project_name', $filters['select_project']);
    //         }
    //     }

    //     if ($billingTypeFilter !== null) {
    //         $query->where('billable_type', $billingTypeFilter);
    //     }

    //     // Get all results (without pagination)
    //     $reports = $query->get();

    //     // Pass data to PDF view
    //     $data = [
    //         'reports' => $reports,
    //         'totals' => $totals,
    //     ];
        
    //     // Load the PDF view
    //     $pdf = PDF::loadView('backend.reports.billable_pdf', $data);
        
    //     // Download the PDF file
    //     return $pdf->download('billable-report-'.now()->format('Y-m-d').'.pdf');
    // }


    // public function exportPdf(Request $request)
    // {
    //     // Prepare search filters (same as index method)
    //     $filters = [
    //         'start_date' => $request->input('start_date'),
    //         'end_date' => $request->input('end_date'),
    //         'employee' => $request->input('employee'),
    //         'project_ticket' => $request->input('project_ticket'),
    //         'select_project' => $request->input('select_project'),
    //     ];
    
    //     // Check if billing type filter is applied (same as index)
    //     $billingTypeFilter = $request->filled('billing_type') && $request->billing_type !== 'none' 
    //         ? $request->billing_type 
    //         : null;
    
    //     // Fetch total hours with all filters (same as index)
    //     $totals = DailyReportField::getTotalHours($filters, $billingTypeFilter);
    
    //     // If a specific billing type is selected, adjust totals display (same as index)
    //     if ($billingTypeFilter !== null) {
    //         $totals = [
    //             'billable' => $billingTypeFilter == 1 ? $totals : 0,
    //             'non_billable' => $billingTypeFilter == 0 ? $totals : 0,
    //             'internal_billable' => $billingTypeFilter == 2 ? $totals : 0,
    //         ];
    //     }
    
    //     // Build query (same as index method)
    //     $query = DailyReportField::query()->with('user');
    
    //     if (!empty($filters['start_date']) && !empty($filters['end_date'])) {
    //         $query->whereBetween('created_at', [$filters['start_date'], $filters['end_date']]);
    //     }
    
    //     if (!empty($filters['employee'])) {
    //         $query->where('user_id', $filters['employee']);
    //     }
    
    //     if (!empty($filters['project_ticket']) && !empty($filters['select_project'])) {
    //         if ($filters['project_ticket'] === 'project') {
    //             $query->where('type', 1)->where('project_name', $filters['select_project']);
    //         } elseif ($filters['project_ticket'] === 'ticket') {
    //             $query->where('type', 2)->where('project_name', $filters['select_project']);
    //         }
    //     }
    
    //     if ($billingTypeFilter !== null) {
    //         $query->where('billable_type', $billingTypeFilter);
    //     }
    
    //     // Get all results (without pagination)
    //     $reports = $query->get();
    
    //     // Pass data to PDF view
    //     $data = [
    //         'reports' => $reports,
    //         'totals' => $totals,
    //     ];
        
    //     // Load the PDF view
    //     $pdf = PDF::loadView('backend.reports.billable_pdf', $data);
        
    //     // Download the PDF file
    //     return $pdf->download('billable-report-'.now()->format('Y-m-d').'.pdf');
    // }

    public function exportPdf(Request $request)
    {
        // Prepare search filters (same as index method)
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
    
        // Build query (same as index method)
        $query = DailyReportField::query()->with('user');
    
        // Date range filter
        if (!empty($filters['start_date']) && !empty($filters['end_date'])) {
            $query->whereBetween('created_at', [$filters['start_date'], $filters['end_date']]);
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
        
        // Download the PDF file
        return $pdf->download('billable-report-'.now()->format('Y-m-d').'.pdf');
    }


   

}