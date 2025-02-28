<?php

use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\ProjectController;
use App\Http\Controllers\Backend\UielementController;
use App\Http\Controllers\Backend\AuthenticationController;
use App\Http\Controllers\Backend\TicketController;
use App\Http\Controllers\Backend\ClientController;
use App\Http\Controllers\Backend\EmployeeController;
use App\Http\Controllers\Backend\AccountsController;
use App\Http\Controllers\Backend\AppsController;
use App\Http\Controllers\Backend\OtherpagesController;

use Tabuna\Breadcrumbs\Trail;

// All route names are prefixed with 'admin.'.
Route::redirect('/', '/admin/hr-dashboard', 301);


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

Route::group([
    'prefix' => 'project'
], function () {
    Route::get('index', [ProjectController::class, 'index'])
    ->name('project.index')
    ->breadcrumbs(function (Trail $trail) {
        $trail->push(__('Home'), route('admin.project.index'));
    });

    Route::get('tasks', [ProjectController::class, 'tasks'])
    ->name('project.tasks')
    ->breadcrumbs(function (Trail $trail) {
        $trail->push(__('Home'), route('admin.project.tasks'));
    });

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

Route::group([
    'prefix' => 'ticket'
], function () {
    Route::get('ticket-view', [TicketController::class, 'ticketView'])
    ->name('ticket.ticket-view')
    ->breadcrumbs(function (Trail $trail) {
        $trail->push(__('Home'), route('admin.ticket.ticket-view'));
    });

    Route::get('ticket-detail', [TicketController::class, 'ticketDetail'])
    ->name('ticket.ticket-detail')
    ->breadcrumbs(function (Trail $trail) {
        $trail->push(__('Home'), route('admin.ticket.ticket-detail'));
    });
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

    Route::delete('/clients/{id}', [ClientController::class, 'destroy'])->name('our-client.destroy-client');
});

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