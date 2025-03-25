<?php

use App\Http\Controllers\LocaleController;
use App\Http\Controllers\Backend\GoogleController;



// Google ROUTE
Route::get('auth/google', [GoogleController::class, 'googleLogin'])->name('auth.google');

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


// GOOGLE ROUTE 
Route::get('auth/google', [GoogleController::class, 'googleLogin'])->name('auth.google');
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);