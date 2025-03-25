<?php

namespace App\Http\Controllers\Backend\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\EmployeeHelper;
use App\Helpers\ProjectHelper;
use App\Models\Backend\DailyReportField;
use Barryvdh\DomPDF\Facade\Pdf;


class BillableNonBillableController extends Controller
{
    
    // public function index()
    // {
    //     // Fetch employees and projects
    //     $employees = EmployeeHelper::getEmployeeNames();
    //     $projects = ProjectHelper::getProjectNames();

    //     return view('backend.reports.billable_nonbillable', compact('employees', 'projects'));
    // }

     

    
    
    // public function index(Request $request)
    // {
    //     // Fetch employees and projects
    //     $employees = EmployeeHelper::getEmployeeNames();
    //     $projects = ProjectHelper::getProjectNames();
    
    //     // Initialize query builder
    //     $query = DailyReportField::query()->with('user');
    
    //     // Apply filters
    //     if ($request->filled('start_date') && $request->filled('end_date')) {
    //         $query->whereBetween('created_at', [$request->start_date, $request->end_date]);
    //     }
    
    //     if ($request->filled('employee')) {
    //         $query->where('user_id', $request->employee);
    //     }
    
    //     if ($request->filled('project_ticket') && $request->filled('select_project')) {
    //         if ($request->project_ticket == 'project') {
    //             $query->where('type', 1)->where('project_name', $request->select_project);
    //         } elseif ($request->project_ticket == 'ticket') {
    //             $query->where('type', 2)->where('project_name', $request->select_project);
    //         }
    //     }
    
    //     if ($request->filled('billing_type') && $request->billing_type !== 'none') {
    //         $query->where('billable_type', $request->billing_type);
    //     }
    
    //     // Fetch results only if search is triggered
    //     $reports = $request->hasAny(['start_date', 'end_date', 'employee', 'project_ticket', 'select_project', 'billing_type']) 
    //                 ? $query->get()
    //                 : collect(); // Empty collection if no search is done
    
    //     return view('backend.reports.billable_nonbillable', compact('employees', 'projects', 'reports'));
    // }

    // wORKING FINE 

    // public function index(Request $request)
    // {
    //     // Fetch employees and projects
    //     $employees = EmployeeHelper::getEmployeeNames();
    //     $projects = ProjectHelper::getProjectNames();

    //     // Prepare search filters
    //     $filters = [
    //         'start_date' => $request->input('start_date'),
    //         'end_date' => $request->input('end_date'),
    //         'employee' => $request->input('employee'),
    //         'project_ticket' => $request->input('project_ticket'),
    //         'select_project' => $request->input('select_project'),
    //     ];

    //     // Fetch total hours dynamically
    //     $totals = DailyReportField::getTotalHours($filters);

    //     // Fetch search results
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

    //     if ($request->filled('billing_type') && $request->billing_type !== 'none') {
    //         $query->where('billable_type', $request->billing_type);
    //     }

    //     // Fetch results only if search is triggered
    //     $reports = $request->hasAny(array_keys($filters)) ? $query->paginate(10)  : collect();

    //     return view('backend.reports.billable_nonbillable', compact('employees', 'projects', 'reports', 'totals'));
    // }


    public function index(Request $request)
    {
        // Fetch employees and projects
        $employees = EmployeeHelper::getEmployeeNames();
        $projects = ProjectHelper::getProjectNames();
    
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
    
        // Fetch total hours with all filters
        $totals = DailyReportField::getTotalHours($filters, $billingTypeFilter);
    
        // If a specific billing type is selected, adjust totals display
        if ($billingTypeFilter !== null) {
            $totals = [
                'billable' => $billingTypeFilter == 1 ? $totals : 0,
                'non_billable' => $billingTypeFilter == 0 ? $totals : 0,
                'internal_billable' => $billingTypeFilter == 2 ? $totals : 0,
            ];
        }
    
        // Fetch search results
        $query = DailyReportField::query()->with('user');
    
        if (!empty($filters['start_date']) && !empty($filters['end_date'])) {
            $query->whereBetween('created_at', [$filters['start_date'], $filters['end_date']]);
        }
    
        if (!empty($filters['employee'])) {
            $query->where('user_id', $filters['employee']);
        }
    
        if (!empty($filters['project_ticket']) && !empty($filters['select_project'])) {
            if ($filters['project_ticket'] === 'project') {
                $query->where('type', 1)->where('project_name', $filters['select_project']);
            } elseif ($filters['project_ticket'] === 'ticket') {
                $query->where('type', 2)->where('project_name', $filters['select_project']);
            }
        }
    
        if ($billingTypeFilter !== null) {
            $query->where('billable_type', $billingTypeFilter);
        }
    
        // Fetch results only if search is triggered
        $reports = $request->hasAny(array_keys($filters)) || $billingTypeFilter !== null 
            ? $query->paginate(10) 
            : collect();
    
        return view('backend.reports.billable_nonbillable', compact('employees', 'projects', 'reports', 'totals'));
    }
    

    // Export to PDF Logic
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

    //     // Get totals (same as index method)
    //     $totals = DailyReportField::getTotalHours($filters);

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

    //     if ($request->filled('billing_type') && $request->billing_type !== 'none') {
    //         $query->where('billable_type', $request->billing_type);
    //     }

    //     // Get all results (without pagination)
    //     $reports = $query->get();

    //     // Pass data to PDF view
    //     $data = [
    //         'reports' => $reports,
    //         'totals' => $totals,
    //     ];
        
    //     // Load the PDF view
    //     // $pdf = PDF::loadView('backend.reports.billable_pdf', $data);

    //     $pdf = PDF::loadView('backend.reports.billable_pdf',$data);
        
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

        // Check if billing type filter is applied (same as index)
        $billingTypeFilter = $request->filled('billing_type') && $request->billing_type !== 'none' 
            ? $request->billing_type 
            : null;

        // Fetch total hours with all filters (same as index)
        $totals = DailyReportField::getTotalHours($filters, $billingTypeFilter);

        // If a specific billing type is selected, adjust totals display (same as index)
        if ($billingTypeFilter !== null) {
            $totals = [
                'billable' => $billingTypeFilter == 1 ? $totals : 0,
                'non_billable' => $billingTypeFilter == 0 ? $totals : 0,
                'internal_billable' => $billingTypeFilter == 2 ? $totals : 0,
            ];
        }

        // Build query (same as index method)
        $query = DailyReportField::query()->with('user');

        if (!empty($filters['start_date']) && !empty($filters['end_date'])) {
            $query->whereBetween('created_at', [$filters['start_date'], $filters['end_date']]);
        }

        if (!empty($filters['employee'])) {
            $query->where('user_id', $filters['employee']);
        }

        if (!empty($filters['project_ticket']) && !empty($filters['select_project'])) {
            if ($filters['project_ticket'] === 'project') {
                $query->where('type', 1)->where('project_name', $filters['select_project']);
            } elseif ($filters['project_ticket'] === 'ticket') {
                $query->where('type', 2)->where('project_name', $filters['select_project']);
            }
        }

        if ($billingTypeFilter !== null) {
            $query->where('billable_type', $billingTypeFilter);
        }

        // Get all results (without pagination)
        $reports = $query->get();

        // Pass data to PDF view
        $data = [
            'reports' => $reports,
            'totals' => $totals,
        ];
        
        // Load the PDF view
        $pdf = PDF::loadView('backend.reports.billable_pdf', $data);
        
        // Download the PDF file
        return $pdf->download('billable-report-'.now()->format('Y-m-d').'.pdf');
    }

   

}






