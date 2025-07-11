<?php

use Tabuna\Breadcrumbs\Trail;
use App\Http\Controllers\LocaleController;
use App\Http\Controllers\Backend\GoogleController;
use App\Domains\Auth\Http\Controllers\Frontend\Auth\LoginController;
use App\Http\Controllers\SupportTicketController;

use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\ClientAuth\ForgotPasswordController;
use App\Http\Controllers\ClientAuth\ResetPasswordController;
use App\Http\Controllers\ClientForgotPasswordController;
use App\Http\Controllers\ClientResetPasswordController;



// Google ROUTE
Route::get('auth/google', [GoogleController::class, 'googleLogin'])->name('auth.google');
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback'])->name('auth.googleCallback');
/*
 * Global Routes
 *
 * Routes that are used between both frontend and backend.
 */

// Switch between the included languages
Route::get('lang/{lang}', [LocaleController::class, 'change'])->name('locale.change');

/*
 * Frontend Routes
 */
Route::group(['as' => 'frontend.'], function () {
    includeRouteFiles(__DIR__ . '/frontend/');
});

/*
 * Backend Routes
 *
 * These routes can only be accessed by users with type `admin`
 */
Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'admin'], function () {
    includeRouteFiles(__DIR__ . '/backend/');
});
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login'])->name("frontend.auth.login");

//Client form

Route::get('/form', function () {
    return view('client-form');
})->name('client.login.form');

Route::post('/form', [SupportTicketController::class, 'store'])->name('support.request.store');




// Client Login Form
Route::get('/clientlogin', function () {
    return view('clientlogin');
})->name('clientloginform');




Route::post('/clientlogin/submit', [SupportTicketController::class, 'clientLogin'])->name('client.login');

// Cliet Password Reset Routes
Route::prefix('client')->group(function () {


    Route::get('/password/reset', [ClientForgotPasswordController::class, 'showLinkRequestForm'])
        ->name('client.password.request');


    Route::post('/password/email', [ClientForgotPasswordController::class, 'sendResetLinkEmail'])
        ->name('client.password.email');

    Route::get('/password/reset/{token}', [ClientResetPasswordController::class, 'showResetForm'])
        ->name('client.password.reset');

    Route::post('/password/reset', [ClientResetPasswordController::class, 'reset'])
        ->name('client.password.update');

});


// web.php or client.php
Route::middleware(['client.auth'])->group(function () {
    Route::get('/client/project-dashboard', [DashboardController::class, 'clientProjectDashboard'])
        ->name('client.project.dashboard');
    // });


    // Logout Route session working fine
    // Route::get('/client/logout', function () {
    //     // Only clear the client-specific session data
    //     session()->forget(['client_id', 'client_name', 'client_logged_in']);
    //     return redirect()->route('clientlogin')->with('success', 'You have been logged out.');
    // })->name('client.logout');

    Route::get('/client/logout', function () {
        Auth::guard('client')->logout(); // Logs out the client user
        return redirect()->route('clientloginform')->with('success', 'You have been logged out.');
    })->name('client.logout');


    // Client Ticket route
    Route::get('/client/tickets', [DashboardController::class, 'clientTickets'])
        ->name('client.ticket_view');

    // Updating client password under profile
    Route::post('client/update-password', [SupportTicketController::class, 'updatePassword'])->name('client.update_password');

    // Route::get('client/ticket_details', [SupportTicketController::class, 'getclienttickedetail'])->name('client.ticket_detail');

    Route::get('client/ticket_details/{id}', [SupportTicketController::class, 'getclienttickedetail'])->name('client.ticket_detail');

    Route::post('client/ticket/comment', [SupportTicketController::class, 'storeClientComment'])->name('client.ticket.comment-store');
    // Client Auth Routes for reset passwords
    // Route::prefix('client')->name('client.')->group(function () {

    //     Route::get('forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
    //     Route::post('forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

    //     Route::get('reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
    //     Route::post('reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');
    // });



    //       // Client Ticket Routes Group (nested under client.auth middleware)
//     Route::group([
//         'prefix' => 'ticket' // This adds '/ticket' to the URL
//     ], function () {
//         Route::get('ticket-view', [DashboardController::class, 'clientTickets'])
//     ->name('client.ticket_view')
//     ->breadcrumbs(function (Trail $trail) {
//         $trail->push(__('Home'), route('client.ticket_view'));
//     });

    //    });

});







