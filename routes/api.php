<?php

use App\Http\Controllers\LecturerController;
use App\Http\Controllers\LecturerPlotController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\SubClassController;
use App\Http\Controllers\RoomTimeController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\CourseController;
use Illuminate\Support\Facades\Route;


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

/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::get('v1/lecturer/{lecturerId}', [LecturerController::class, 'getLecturerCredit']);
Route::apiResource('v1/lecturer', LecturerController::class);

Route::apiResource('v1/subclass', SubClassController::class);

Route::apiResource('v1/room', RoomController::class);

Route::get('v1/lecturer_plot/{acadYearId}', [LecturerPlotController::class, 'getJoinedByAcadYearId']);
Route::put('v1/lecturer_plot', [LecturerPlotController::class, 'update']);
Route::post('v1/lecturer_plot', [LecturerPlotController::class, 'store']);
Route::delete('v1/lecturer_plot', [LecturerPlotController::class, 'destroy']);




Route::get('v1/room_time_helper', [RoomTimeController::class, 'getHelper']);
Route::apiResource('v1/room_time', RoomTimeController::class);

Route::apiResource('/v1/schedule', ScheduleController::class);


