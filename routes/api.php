<?php

use App\Http\Controllers\Backend\DailyReportController;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});


Route::middleware('auth:api')->group(function () {
    Route::get('/get_project_list', [DailyReportController::class, 'getProjectList'])->name('api.project');
    Route::get('/get_project_task_list', [DailyReportController::class, 'getProjectTaskList'])->name('api.task');
});