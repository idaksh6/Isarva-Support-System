<?php

use App\Http\Controllers\LocaleController;
use App\Http\Controllers\Backend\GoogleController;
use App\Domains\Auth\Http\Controllers\Frontend\Auth\LoginController;
use App\Http\Controllers\SupportTicketController;


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
    includeRouteFiles(__DIR__.'/frontend/');
});

/*
 * Backend Routes
 *
 * These routes can only be accessed by users with type `admin`
 */
Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'admin'], function () {
    includeRouteFiles(__DIR__.'/backend/');
});
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login'])->name("frontend.auth.login");

//Client form

Route::get('/form', function () {
    return view('client-form');
});

Route::post('/form', [SupportTicketController::class, 'store'])->name('support.request.store');



// GOOGLE ROUTE 
// Route::get('auth/google', [GoogleController::class, 'googleLogin'])->name('auth.google');
// Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);