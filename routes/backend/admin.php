<?php

use Tabuna\Breadcrumbs\Trail;
use App\Http\Controllers\Backend\AppsController;
use App\Http\Controllers\Backend\TaskController;
use App\Http\Controllers\Backend\ClientController;
use App\Http\Controllers\Backend\GoogleController;
use App\Http\Controllers\Backend\TicketController;
use App\Http\Controllers\Backend\ProjectController;
use App\Http\Controllers\Backend\AccountsController;
use App\Http\Controllers\Backend\EmployeeController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\UielementController;
use App\Http\Controllers\Backend\OtherpagesController;
use App\Http\Controllers\Backend\DailyReportController;
use App\Http\Controllers\Backend\AuthenticationController;
use App\Http\Controllers\Backend\ProjectAdditionalHrController;
use App\Http\Controllers\Backend\Reports\ReportsController;
use App\Http\Controllers\Backend\Reports\BillableNonBillableController;
use App\Http\Controllers\Backend\DailyTaskController;
use App\Http\Controllers\Backend\BackupController;
use App\Http\Controllers\Backend\RenewalController;


// All route names are prefixed with 'admin.'.
Route::redirect('/', 'login', 301);

// Route::redirect('/', '/admin/hr-dashboard', 404);

   
   


Route::post('form/basic', [DashboardController::class, 'formBasic'])
    ->name('form.basic')
    ->breadcrumbs(function (Trail $trail) {
        $trail->push(__('Home'), route('form.basic'));
    });

Route::post('form/advance', [DashboardController::class, 'formAdvance'])
->name('form.advance')
->breadcrumbs(function (Trail $trail) {
    $trail->push(__('Home'), route('form.advance'));
});

Route::get('hr-dashboard', [DashboardController::class, 'index'])
    ->name('dashboard')
    ->breadcrumbs(function (Trail $trail) {
        $trail->push(__('Home'), route('admin.dashboard'));
    });

Route::get('get-daily-stats/{year}/{month}', [DashboardController::class, 'dailyReportStatisticsChart']);
Route::get('last-one-year/{year}/{month}', [DashboardController::class, 'lastOneYearData']);



// Added Middleware
// Route::middleware(['client.auth'])->group(function () {
// Route::get('project-dashboard', [DashboardController::class, 'project'])
//     ->name('project')
//     ->breadcrumbs(function (Trail $trail) {
//         $trail->push(__('Home'), route('admin.project'));
//     });
// });


Route::get('project-dashboard', [DashboardController::class, 'project'])
    ->name('project')
    ->breadcrumbs(function (Trail $trail) {
        $trail->push(__('Home'), route('admin.project'));
    });




Route::get('payroll/employee-salary', [EmployeeController::class, 'payroll'])
->name('employee-salary')
->breadcrumbs(function (Trail $trail) {
    $trail->push(__('Home'), route('admin.employee-salary'));
});


// Route::get('add_daily-reports', [DailyReportController::class, 'index'])
//     ->name('add_dailyreport')
//     ->breadcrumbs(function (Trail $trail) {
//         $trail->push(__('Home'), route('admin.add_dailyreport'));

     
//     });

//     // Daily Report Route
//     Route::get('add_daily-reports', [DailyReportController::class, 'index'])
//     ->name('add_dailyreport');
//     Route::post('/admin/daily-reports/store', [DailyReportController::class, 'store'])
//     ->name('daily-reports.store');


// Billable report Routes
Route::group([
    'prefix' => 'report'
], function () {

  // Billable Reports
  Route::get('billable_non_billable_reports', [BillableNonBillableController::class, 'index'])
  ->name('billable_nonbillable_report')
    ->breadcrumbs(function (Trail $trail) {
        $trail->push(__('Home'), route('admin.billable_nonbillable_report'));
    });

    // Billable-nonbillable PDF ROUTE
    Route::get('/export-billable-report-pdf', [BillableNonBillableController::class, 'exportPdf'])
    ->name('export.billable.pdf')
    ->breadcrumbs(function (Trail $trail) {
        $trail->push(__('Home'), route('export.billable.pdf'));
    });

     // Consolidated Report   ROUTE
     Route::get('consolidated_daily_reports', [BillableNonBillableController::class, 'getconsolidatedreport'])
     ->name('consolidated_dailyreport')
     ->breadcrumbs(function (Trail $trail) {
         $trail->push(__('Home'), route('admin.consolidated_dailyreport'));
     });
       
     // Consolidated Report PDF ROUTE
     Route::get('/admin/report/consolidated_daily_reports/export', [BillableNonBillableController::class, 'exportconsolidatedreportToPdf'])->name('consolidated_report.export');
      
        // DailyTask Report   ROUTE
        Route::get('dailytask_reports', [ReportsController::class, 'getdailytaskreport'])
        ->name('dailytask_reports')
        ->breadcrumbs(function (Trail $trail) {
            $trail->push(__('Home'), route('admin.dailytask_reports'));
        });

         // Employee analytics Report   ROUTE
         Route::get('employee_analytics_report', [ReportsController::class, 'getemployeeanalytics'])
         ->name('employee_analytics')
         ->breadcrumbs(function (Trail $trail) {
             $trail->push(__('Home'), route('admin.employee_analytics'));
         });
          
         // Comapny Wise Billing Reports
         Route::get('companywise_billing_report', [ReportsController::class, 'getcompanywisebilingreport'])
         ->name('companywise_billingreport')
         ->breadcrumbs(function (Trail $trail) {
             $trail->push(__('Home'), route('admin.companywise_billingreport'));
         });

         // EXPORT PDF Route for Company wise billing report
         Route::get('/admin/company-report/export-pdf', [ReportsController::class, 'compnaywisebillableexportPdf'])->name('company-report.exportPdf');


        // Company wise analytic report part 
         Route::get('companywise_analytic_report', [ReportsController::class, 'getcompanywiseanalyticreport'])
         ->name('companywise_analytic_report')
         ->breadcrumbs(function (Trail $trail) {
             $trail->push(__('Home'), route('admin.companywise_analytic_report'));
         });

    
        // Route::post('companywise_analytic_report/export', [ReportsController::class, 'exportCompanywiseAnalyticReport'])
        // ->name('companywise_analytic_report.export');
        Route::get('/admin/companywiseanalyticreport/pdf', [ReportsController::class, 'exportCompanyWisePDF'])->name('company.report.pdf');

        // Project Timesheet Report 
         Route::get('project_timesheet_report', [ReportsController::class, 'getprojecttimesheetreport'])
         ->name('project_timesheet_report')
         ->breadcrumbs(function (Trail $trail) {
             $trail->push(__('Home'), route('admin.project_timesheet_report'));
         });

        // Project Timesheet Report  PDF 
         Route::get('project-timesheet/export-pdf', [ReportsController::class, 'exportTimesheetPDF'])->name('project_timesheet_export_pdf');


        // Metric Report
         Route::get('metric_report', [ReportsController::class, 'getmetricreport'])
         ->name('metric_report')
         ->breadcrumbs(function (Trail $trail) {
             $trail->push(__('Home'), route('admin.metric_report'));
         });

          // Metric Analytic Report
         Route::get('metric_analytic_report', [ReportsController::class, 'getmetricanalyticreport'])
         ->name('metric_analytic_report')
         ->breadcrumbs(function (Trail $trail) {
             $trail->push(__('Home'), route('admin.metric_analytic_report'));
         });



         

        //  // Session
        //  Route::get('/session-debug', function() {
        //     $session = DB::table('sessions')
        //         ->where('id', session()->getId())
        //         ->first();

        //     return [
        //         'session_id' => session()->getId(),
        //         'last_activity' => $session ? date('Y-m-d H:i:s', $session->last_activity) : null,
        //         'current_time' => now(),
        //         'user_id' => auth()->id(),
        //         'session_data' => $session ? unserialize(base64_decode($session->payload)) : null
        //     ];
        // });

        // Route::get('/session-keepalive', function() {
        //     if (Auth::check()) {
        //         Auth::user()->updateLastActivity();
        //         session(['last_activity' => now()]);
        //     }
        //     return response()->noContent();
        // })->middleware('auth');
                // Works fine --
        //  // In routes/web.php (or api.php)
        // Route::get('/update-billing-companies', function() {
        //     // Update project-based entries
        //     $updatedProjects = DB::table('si_daily_report_fields as drf')
        //         ->join('si_projects as p', 'drf.project_id', '=', 'p.id')
        //         ->whereNull('drf.se_bill_company')
        //         ->where('drf.type', 1)
        //         ->update([
        //             'drf.se_bill_company' => DB::raw('p.biiling_company')
        //         ]);
                
        //     // Update ticket-based entries to 0
        //     $updatedTickets = DB::table('si_daily_report_fields')
        //         ->whereNull('se_bill_company')
        //         ->where('type', 2)
        //         ->update(['se_bill_company' => 0]);
                
        //     return "Updated $updatedProjects project records and $updatedTickets ticket records";
        // });

        // In routes/web.php (or api.php)
        // Route::get('/update-billing-companies', function() {
        //     // First update records where we can find a project with billing_company
        //     $updatedProjects = DB::table('si_daily_report_fields as drf')
        //         ->join('si_projects as p', 'drf.project_id', '=', 'p.id')
        //         ->whereNull('drf.se_bill_company')
        //         ->where('drf.type', 1)
        //         ->whereNotNull('p.biiling_company') // Only projects with biiling_company set
        //         ->update([
        //             'drf.se_bill_company' => DB::raw('p.biiling_company')
        //         ]);
            
        //     // Then update project records where biiling_company is null in projects table
        //     $updatedNullProjects = DB::table('si_daily_report_fields as drf')
        //         ->join('si_projects as p', 'drf.project_id', '=', 'p.id')
        //         ->whereNull('drf.se_bill_company')
        //         ->where('drf.type', 1)
        //         ->whereNull('p.biiling_company') // Projects with null billing_company
        //         ->update([
        //             'drf.se_bill_company' => 0
        //         ]);
            
        //     // Update project records where project doesn't exist anymore
        //     $updatedOrphanedProjects = DB::table('si_daily_report_fields as drf')
        //         ->leftJoin('si_projects as p', 'drf.project_id', '=', 'p.id')
        //         ->whereNull('drf.se_bill_company')
        //         ->where('drf.type', 1)
        //         ->whereNull('p.id') // No matching project found
        //         ->update([
        //             'drf.se_bill_company' => 0
        //         ]);
            
        //     // Update ticket-based entries to 0
        //     $updatedTickets = DB::table('si_daily_report_fields')
        //         ->whereNull('se_bill_company')
        //         ->where('type', 2)
        //         ->update(['se_bill_company' => 0]);
            
        //     return response()->json([
        //         'success' => true,
        //         'message' => 'Billing companies updated successfully',
        //         'stats' => [
        //             'projects_with_billing_company' => $updatedProjects,
        //             'projects_with_null_billing_company' => $updatedNullProjects,
        //             'orphaned_projects' => $updatedOrphanedProjects,
        //             'tickets_updated' => $updatedTickets,
        //             'total_updated' => $updatedProjects + $updatedNullProjects + $updatedOrphanedProjects + $updatedTickets
        //         ]
        //     ]);
        // });
});





// Project Route
Route::group([
    'prefix' => 'project'
], function () {
    Route::get('index', [ProjectController::class, 'index'])
    ->name('project.index')
    ->breadcrumbs(function (Trail $trail) {
        $trail->push(__('Home'), route('admin.project.index'));
    });


    // // Billable Reports
    // Route::get('/adminreports/billable_non_billable_reports', [BillableNonBillableController::class, 'index'])->name('billable_nonbillable_report');
    
    // //PDF ROUTE
    // Route::get('/export-billable-report-pdf', [BillableNonBillableController::class, 'exportPdf'])->name('export.billable.pdf');

 
    // Route to bring project name under daily report field
    Route::get('/admin/projects/search/{term?}', [DailyReportController::class, 'search'])->name('projects.search');

    // Route to bring Task name under daily report field
    Route::get('/admin/tasks/search', [DailyReportController::class, 'searchTasks'])->name('tasks.search');

    
    // Route to bring Ticket name under daily report field
    Route::get('/tickets/search', [DailyReportController::class, 'searchTickets'])->name('tickets.search');

    // Daily Report Route
    // Route::get('/add/daily-reports', [DailyReportController::class, 'index'])->name('add_dailyreport');
    // Route::post('/admin/daily-reports/store', [DailyReportController::class, 'store'])->name('daily-reports.store');

    // //  Daily Report Store route
    // Route::post('dailyreport/store', [DailyReportController::class, 'store'])->name('dailyreport_store');


     // Define the route for the ProjectController index method
    Route::get('/projects/manage', [ProjectController::class, 'manage'])->name('project.manage');


    // Project Store route
    Route::post('project/store', [ProjectController::class, 'store'])->name('project.store-project');

     // Edit and update Project routes
     Route::get('/project/{id}/edit', [ProjectController::class, 'edit'])->name('project.edit-project');
     Route::put('/project/{id}', [ProjectController::class, 'update'])->name('project.update-project');
     Route::delete('/project/{id}', [ProjectController::class, 'destroy'])->name('project.destroy-project');
     
     // Route to search project 
     Route::get('/projects/search-assigned', [ProjectController::class, 'searchByAssignedTo'])
     ->name('projects.searchByAssignedTo');


    Route::get('tasks', [TaskController::class, 'tasks'])
    ->name('project.tasks')
    ->breadcrumbs(function (Trail $trail) {
        $trail->push(__('Home'), route('admin.project.tasks'));
    });

    // Route for task
     Route::get('/tasks/{id}', [TaskController::class, 'tasksByProject'])->name('tasks.byProject');

      // Task Store route
      Route::post('task/store', [TaskController::class, 'store'])->name('project_task.store-task');

      // Route to store internal docs
      Route::post('/internal-docs/store', [TaskController::class, 'storeInternalDoc'])->name('internal-docs.store');

    // Assets Route
      Route::get('/task-assets/{projectId}', [TaskController::class, 'showAssets'])->name('task-assets.show');

      // Worked Hour Route
      Route::get('/admin/project/worked-hours/{id}', [ProjectController::class, 'getWorkedHours'])->name('project.worked-hours');

 
     // Route for additinal Hr under Task
    Route::get('/projects/{project}/additional-hrs', [ProjectAdditionalHrController::class, 'index'])
      ->name('project.additional-hrs.index');
  
    // Route to store additional Hr
    Route::post('/projects/additional-hrs', [ProjectAdditionalHrController::class, 'store'])
      ->name('project.additional-hrs.store');
   


   // Define the route for updating task status
  //  Route::post('/admin/task/updateStatus', [TaskController::class, 'updateTaskStatus'])->name('task.updateStatus');

    // Route for storing asset
    Route::post('/task-asset/store', [TaskController::class, 'storeasset'])->name('task-asset.store');

    // TASK EDIT ROUTE AND UPDATE ROUTE
    Route::get('task/{id}/edit', [TaskController::class, 'edit'])->name('task.edit');
    Route::put('task/{id}/update', [TaskController::class, 'update'])->name('task.update');

    // Route::put('task/{id}', [TaskController::class, 'update'])->name('task.update');

    

// Route to fetch uploaded files for a project (AJAX)
Route::get('/admin/task-asset/fetch/{project_id}', [TaskController::class, 'fetchUploadedFiles'])
    ->name('task-asset.fetch');

Route::post('/task/update-status', [TaskController::class, 'updateStatus'])->name('task.updateStatus');

// Route for credential section store,edit,update,delete
Route::post('/credential_store', [TaskController::class, 'storecredential'])->name('store_credential');

Route::get('credential_edit/{id}', [TaskController::class, 'editcredential'])->name('edit_credential');

Route::put('/credential_update/{id}', [TaskController::class, 'updatecredential'])->name('update_credential');


Route::delete('/credential/{id}', [TaskController::class, 'destroycredential'])->name('destroy-credential');





    Route::get('timesheet', [ProjectController::class, 'timesheet'])
    ->name('project.timesheet')
    ->breadcrumbs(function (Trail $trail) {
        $trail->push(__('Home'), route('admin.project.timesheet'));
    });

    Route::get('leaders', [ProjectController::class, 'leaders'])
    ->name('project.leaders')
    ->breadcrumbs(function (Trail $trail) {
        $trail->push(__('Home'), route('admin.project.leaders'));
    });
});


// Daily Report Route 
Route::group([
    'prefix' => 'add_daily-reports'
], function () {
    Route::get('add_dailyreport', [DailyReportController::class, 'index'])
    ->name('add_dailyreport')
    ->breadcrumbs(function (Trail $trail) {
        $trail->push(__('Home'), route('admin.add_dailyreport'));
    });

    // Store Route
    Route::post('/admin/daily-reports/store', [DailyReportController::class, 'store'])->name('daily-reports.store');
   
});


// Daily Task Route 
Route::group([
    'prefix' => 'add_dailytasks'
], function () {
    Route::get('task_manage', [DailyTaskController::class, 'index'])
    ->name('add_dailytask')
    ->breadcrumbs(function (Trail $trail) {
        $trail->push(__('Home'), route('admin.add_dailytask'));
    });

    // Store Route
    Route::post('/admin/dailytask/store', [DailyTaskController::class, 'store'])->name('daily-task.store');

      // Form view
      Route::get('create', [DailyTaskController::class, 'create'])->name('daily-task.create');

      
    // Route::get('daily-task/{id}/edit', [DailyTaskController::class, 'edit'])->name('daily-task.edit');
    // Route::put('daily-task/{id}', [DailyTaskController::class, 'update'])->name('daily-task.update');
     
    // Edit and update Route
    Route::get('edit/{id}', [DailyTaskController::class, 'edit'])->name('daily-task.edit');
    Route::post('update/{id}', [DailyTaskController::class, 'update'])->name('daily-task.update');

    // Route::get('/daily-task/export', [DailyTaskController::class, 'exportPDF'])->name('daily-task.export');
    Route::get('daily-task/export-pdf', [DailyTaskController::class, 'exportPdf'])->name('daily-task.export-pdf');


});

Route::group([
    'prefix' => 'ticket'
], function () {
    Route::get('ticket-view', [TicketController::class, 'ticketView'])
    ->name('ticket.ticket-view')
    ->breadcrumbs(function (Trail $trail) {
        $trail->push(__('Home'), route('admin.ticket.ticket-view'));
    });

    Route::get('ticket-detail/{id}', [TicketController::class, 'ticketDetail'])
    ->name('ticket.ticket-detail')
    ->breadcrumbs(function (Trail $trail, $id) {
        $trail->push(__('Home'), route('ticket.ticket-detail', ['id' => $id]));
    });

    // Add Store Route Here
    Route::post('tickets/store', [TicketController::class, 'store'])
        ->name('ticket.ticket-store');

    // Edit and update ticket routes
    Route::get('/{id}/edit', [TicketController::class, 'edit'])->name('ticket.edit-ticket');
    Route::put('{id}', [TicketController::class, 'update'])->name('ticket.update-ticket');

    
    // Delete Client
    Route::delete('{id}', [TicketController::class, 'destroy'])->name('ticket.destroy-ticket');

    // Store Ticket Discussion
    Route::post('tickets/comments/store', [TicketController::class, 'storeTicketDiscussion'])
    ->name('ticket.comment-store');

});

Route::group([
    'prefix' => 'renewals'
], function () {
    // Main View (List all renewals)
    Route::get('manage', [RenewalController::class, 'index'])
        ->name('renewals.manage')
        ->breadcrumbs(function (Trail $trail) {
            $trail->push(__('Home'), route('admin.dashboard'));
            $trail->push(__('Renewals'), route('renewals.manage'));
        });

    // Create Form
    Route::get('create', [RenewalController::class, 'create'])
        ->name('renewals.create');

    // Store New Renewal
    Route::post('store', [RenewalController::class, 'store'])
        ->name('renewals.store');

    // Edit Form
    Route::get('edit/{id}', [RenewalController::class, 'edit'])
        ->name('renewals.edit');

    // Update Renewal
    Route::put('update/{id}', [RenewalController::class, 'update'])
        ->name('renewals.update');

    // Delete Renewal
    Route::delete('delete/{id}', [RenewalController::class, 'destroy'])
        ->name('renewals.delete');

    // Search Renewal
    Route::get('renewals/search', [RenewalController::class, 'search'])
        ->name('renewals.search');

    // Export (Optional)
    Route::get('export', [RenewalController::class, 'export'])
        ->name('renewals.export');
});

// Backup Route
Route::group([
    'prefix' => 'backup'
], function () {
    Route::get('backup', [BackupController::class, 'index'])
    ->name('backup_manage')
    ->breadcrumbs(function (Trail $trail) {
        $trail->push(__('Home'), route('admin.backup_manage'));
    });

    // Creating a form route
    Route::get('/create', [BackupController::class, 'create'])->name('backup_create');

    // Storing a form route
    Route::post('/backup/store', [BackupController::class, 'store'])->name('backup.store');

    // Log History blade route
    // Route::get('/log-history/{domain}', [BackupController::class, 'logHistory'])->name('backup.log-history');
    // Route
    Route::get('/log-history/{group_id}', [BackupController::class, 'logHistory'])->name('backup.log-history');

    // Edit and Update method
    Route::get('/backup/edit/{id}', [BackupController::class, 'edit'])->name('backup.edit');
    Route::put('/backup/update/{id}', [BackupController::class, 'update'])->name('backup.update');

    //Search method 
    Route::get('backup/search', [BackupController::class, 'searchBackups'])->name('backup_search');


});




Route::group([
    'prefix' => 'our-client'
], function () {
    Route::get('clients', [ClientController::class, 'clients'])
    ->name('our-client.clients')
    ->breadcrumbs(function (Trail $trail) {
        $trail->push(__('Home'), route('admin.our-client.clients'));
    });

    Route::get('clients-profile', [ClientController::class, 'clientsProfile'])
    ->name('our-client.clients-profile')
    ->breadcrumbs(function (Trail $trail) {
        $trail->push(__('Home'), route('admin.our-client.clients-profile'));
    });

    // Add Store Route Here
    Route::post('clients/store', [ClientController::class, 'store'])
        ->name('our-client.store-client');
        


    // Edit and update client routes
    Route::get('/clients/{id}/edit', [ClientController::class, 'edit'])->name('our-client.edit-client');
    Route::put('clients/{id}', [ClientController::class, 'update'])->name('our-client.update-client');

    Route::get('clients/search', [ClientController::class, 'search'])->name('our-client.search-client');

    Route::delete('/clients/{id}', [ClientController::class, 'destroy'])->name('our-client.destroy-client');
});

// Reports section
Route::group([
    'prefix' => 'report'
], function () {
    Route::get('Active-ticket', [ReportsController::class, 'ActiveTicketReport'])
    ->name('reports.active-tickets')
    ->breadcrumbs(function (Trail $trail) {
        $trail->push(__('Home'), route('admin.reports.active-tickets'));
    });

    Route::get('ExportPdf-ticket', [ReportsController::class, 'ExportPdf'])
    ->name('reports.ExportPdf-ticket')
    ->breadcrumbs(function (Trail $trail) {
        $trail->push(__('Home'), route('admin.reports.ExportPdf-ticket'));
    });

    
});

// Employee routes
Route::group([
    'prefix' => 'our-employee'
], function () {
    Route::get('members', [EmployeeController::class, 'members'])
    ->name('our-employee.members')
    ->breadcrumbs(function (Trail $trail) {
        $trail->push(__('Home'), route('admin.our-employee.members'));
    });

 
    Route::get('members-profile', [EmployeeController::class, 'membersProfile'])
    ->name('our-employee.members-profile')
    ->breadcrumbs(function (Trail $trail) {
        $trail->push(__('Home'), route('admin.our-employee.members-profile'));
    });

    // Add Store route here 
    Route::post('members/store', [EmployeeController::class, 'store'])
    ->name('our-employee.store-employee');

    // Edit and update employee routes
    Route::get('/members/{id}/edit', [EmployeeController::class, 'edit'])->name('our-employee.edit-employee');
    Route::put('/members/{id}', [EmployeeController::class, 'update'])->name('our-employee.update-employee');
    Route::get('/members/search', [EmployeeController::class, 'search'])->name('our-employee.search');
    
    // Delete Employee Route 
    Route::delete('/members/{id}', [EmployeeController::class, 'destroy'])->name('our-employee.destroy-employee');
   

    Route::get('holidays', [EmployeeController::class, 'holidays'])
    ->name('our-employee.holidays')
    ->breadcrumbs(function (Trail $trail) {
        $trail->push(__('Home'), route('admin.our-employee.holidays'));
    });

    Route::get('attendance-employee', [EmployeeController::class, 'attendanceEmployee'])
    ->name('our-employee.attendance-employee')
    ->breadcrumbs(function (Trail $trail) {
        $trail->push(__('Home'), route('admin.our-employee.attendance-employee'));
    });

    Route::get('attendance', [EmployeeController::class, 'attendance'])
    ->name('our-employee.attendance')
    ->breadcrumbs(function (Trail $trail) {
        $trail->push(__('Home'), route('admin.our-employee.attendance'));
    });

    Route::get('leave-request', [EmployeeController::class, 'leaveRequest'])
    ->name('our-employee.leave-request')
    ->breadcrumbs(function (Trail $trail) {
        $trail->push(__('Home'), route('admin.our-employee.leave-request'));
    });

    Route::get('department', [EmployeeController::class, 'department'])
    ->name('our-employee.department')
    ->breadcrumbs(function (Trail $trail) {
        $trail->push(__('Home'), route('admin.our-employee.department'));
    });

});

Route::group([
    'prefix' => 'accounts'
], function () {
    Route::get('invocies', [AccountsController::class, 'invocies'])
    ->name('accounts.invocies')
    ->breadcrumbs(function (Trail $trail) {
        $trail->push(__('Home'), route('admin.accounts.invocies'));
    });

    Route::get('payments', [AccountsController::class, 'payments'])
    ->name('accounts.payments')
    ->breadcrumbs(function (Trail $trail) {
        $trail->push(__('Home'), route('admin.accounts.payments'));
    });

    Route::get('expenses', [AccountsController::class, 'expenses'])
    ->name('accounts.expenses')
    ->breadcrumbs(function (Trail $trail) {
        $trail->push(__('Home'), route('admin.accounts.expenses'));
    });
});

Route::group([
    'prefix' => 'app'
], function () {
    Route::get('calender', [AppsController::class, 'calender'])
    ->name('app.calender')
    ->breadcrumbs(function (Trail $trail) {
        $trail->push(__('Home'), route('admin.app.calender'));
    });

    Route::get('messages', [AppsController::class, 'messages'])
    ->name('app.messages')
    ->breadcrumbs(function (Trail $trail) {
        $trail->push(__('Home'), route('admin.app.messages'));
    });
});


Route::group([
    'prefix' => 'other-pages'
], function () {
    Route::get('apex-charts', [OtherpagesController::class, 'apexCharts'])
    ->name('other-pages.apex-charts')
    ->breadcrumbs(function (Trail $trail) {
        $trail->push(__('Home'), route('admin.other-pages.apex-charts'));
    });

    Route::get('form-example', [OtherpagesController::class, 'formExample'])
    ->name('other-pages.form-example')
    ->breadcrumbs(function (Trail $trail) {
        $trail->push(__('Home'), route('admin.other-pages.form-example'));
    });

    Route::get('table-example', [OtherpagesController::class, 'tableExample'])
    ->name('other-pages.table-example')
    ->breadcrumbs(function (Trail $trail) {
        $trail->push(__('Home'), route('admin.other-pages.table-example'));
    });

    Route::get('review-page', [OtherpagesController::class, 'reviewPage'])
    ->name('other-pages.review-page')
    ->breadcrumbs(function (Trail $trail) {
        $trail->push(__('Home'), route('admin.other-pages.review-page'));
    });

    Route::get('icons', [OtherpagesController::class, 'icons'])
    ->name('other-pages.icons')
    ->breadcrumbs(function (Trail $trail) {
        $trail->push(__('Home'), route('admin.other-pages.icons'));
    });

    Route::get('contact', [OtherpagesController::class, 'contact'])
    ->name('other-pages.contact')
    ->breadcrumbs(function (Trail $trail) {
        $trail->push(__('Home'), route('admin.other-pages.contact'));
    });
    
});

Route::group([
    'prefix' => 'ui-components'
], function () {
    Route::get('alerts', [UielementController::class, 'alerts'])
        ->name('ui-components.alerts')
        ->breadcrumbs(function (Trail $trail) {
            $trail->push(__('Home'), route('admin.ui-components.alerts'));
        });
    Route::get('badge', [UielementController::class, 'badge'])
        ->name('ui-components.badge')
        ->breadcrumbs(function (Trail $trail) {
            $trail->push(__('Home'), route('admin.ui-components.badge'));
        });
    Route::get('breadcrumb', [UielementController::class, 'breadcrumb'])
        ->name('ui-components.breadcrumb')
        ->breadcrumbs(function (Trail $trail) {
            $trail->push(__('Home'), route('admin.ui-components.breadcrumb'));
        });
    Route::get('buttons', [UielementController::class, 'buttons'])
        ->name('ui-components.buttons')
        ->breadcrumbs(function (Trail $trail) {
            $trail->push(__('Home'), route('admin.ui-components.buttons'));
        });
    Route::get('card', [UielementController::class, 'card'])
        ->name('ui-components.card')
        ->breadcrumbs(function (Trail $trail) {
            $trail->push(__('Home'), route('admin.ui-components.card'));
        });
    Route::get('carousel', [UielementController::class, 'carousel'])
        ->name('ui-components.carousel')
        ->breadcrumbs(function (Trail $trail) {
            $trail->push(__('Home'), route('admin.ui-components.carousel'));
        });
    Route::get('collapse', [UielementController::class, 'collapse'])
        ->name('ui-components.collapse')
        ->breadcrumbs(function (Trail $trail) {
            $trail->push(__('Home'), route('admin.ui-components.collapse'));
        });
    Route::get('dropdowns', [UielementController::class, 'dropdowns'])
        ->name('ui-components.dropdowns')
        ->breadcrumbs(function (Trail $trail) {
            $trail->push(__('Home'), route('admin.ui-components.dropdowns'));
        });
    Route::get('list', [UielementController::class, 'list'])
        ->name('ui-components.list')
        ->breadcrumbs(function (Trail $trail) {
            $trail->push(__('Home'), route('admin.ui-components.list'));
        });
    Route::get('modal', [UielementController::class, 'modal'])
        ->name('ui-components.modal')
        ->breadcrumbs(function (Trail $trail) {
            $trail->push(__('Home'), route('admin.ui-components.modal'));
        });
    Route::get('navs', [UielementController::class, 'navs'])
        ->name('ui-components.navs')
        ->breadcrumbs(function (Trail $trail) {
            $trail->push(__('Home'), route('admin.ui-components.navs'));
        });
    Route::get('navbar', [UielementController::class, 'navbar'])
        ->name('ui-components.navbar')
        ->breadcrumbs(function (Trail $trail) {
            $trail->push(__('Home'), route('admin.ui-components.navbar'));
        });
    Route::get('pagination', [UielementController::class, 'pagination'])
        ->name('ui-components.pagination')
        ->breadcrumbs(function (Trail $trail) {
            $trail->push(__('Home'), route('admin.ui-components.pagination'));
        });
    Route::get('popovers', [UielementController::class, 'popovers'])
        ->name('ui-components.popovers')
        ->breadcrumbs(function (Trail $trail) {
            $trail->push(__('Home'), route('admin.ui-components.popovers'));
        });
    Route::get('progress', [UielementController::class, 'progress'])
        ->name('ui-components.progress')
        ->breadcrumbs(function (Trail $trail) {
            $trail->push(__('Home'), route('admin.ui-components.progress'));
        });
    Route::get('scrollspy', [UielementController::class, 'scrollspy'])
        ->name('ui-components.scrollspy')
        ->breadcrumbs(function (Trail $trail) {
            $trail->push(__('Home'), route('admin.ui-components.scrollspy'));
        });
    Route::get('spinners', [UielementController::class, 'spinners'])
        ->name('ui-components.spinners')
        ->breadcrumbs(function (Trail $trail) {
            $trail->push(__('Home'), route('admin.ui-components.spinners'));
        });
    Route::get('toasts', [UielementController::class, 'toasts'])
        ->name('ui-components.toasts')
        ->breadcrumbs(function (Trail $trail) {
            $trail->push(__('Home'), route('admin.ui-components.toasts'));
        });
    Route::get('tooltips', [UielementController::class, 'tooltips'])
        ->name('ui-components.tooltips')
        ->breadcrumbs(function (Trail $trail) {
            $trail->push(__('Home'), route('admin.ui-components.tooltips'));
        });
    Route::get('/stater-page', [UielementController::class, 'index'])
        ->name('ui-components.index')
        ->breadcrumbs(function (Trail $trail) {
            $trail->push(__('Home'), route('admin.ui-components.index'));
        });

        Route::get('/document', [UielementController::class, 'document'])
        ->name('document')
        ->breadcrumbs(function (Trail $trail) {
            $trail->push(__('Home'), route('admin.document'));
        });

        Route::get('/changelog', [UielementController::class, 'changelog'])
        ->name('changelog')
        ->breadcrumbs(function (Trail $trail) {
            $trail->push(__('Home'), route('admin.changelog'));
        });
});


Route::group([
    'prefix' => 'authentication'
], function () {
   
    Route::get('signin', [AuthenticationController::class, 'signin'])
        ->name('authentication.signin')
        ->breadcrumbs(function (Trail $trail) {
            $trail->push(__('Home'), route('admin.authentication.signin'));
        });
       
       
        // Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);

    Route::get('signup', [AuthenticationController::class, 'signup'])
        ->name('authentication.signup')
        ->breadcrumbs(function (Trail $trail) {
            $trail->push(__('Home'), route('admin.authentication.signup'));
        });
    Route::get('password-reset', [AuthenticationController::class, 'passwordReset'])
        ->name('authentication.password-reset')
        ->breadcrumbs(function (Trail $trail) {
            $trail->push(__('Home'), route('admin.authentication.password-reset'));
        });
    Route::get('two-step-authentication', [AuthenticationController::class, 'twoStepAuthentication'])
        ->name('authentication.two-step-authentication')
        ->breadcrumbs(function (Trail $trail) {
            $trail->push(__('Home'), route('admin.authentication.two-step-authentication'));
        });
    
    Route::get('bad-request', [AuthenticationController::class, 'badRequest'])
        ->name('authentication.bad-request')
        ->breadcrumbs(function (Trail $trail) {
            $trail->push(__('Home'), route('admin.authentication.bad-request'));
        });
});

Route::get('help', [DashboardController::class, 'help'])
    ->name('help')
    ->breadcrumbs(function (Trail $trail) {
        $trail->push(__('Home'), route('help'));
    });