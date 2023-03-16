<?php

use App\Http\Controllers\LecturerController;
use App\Http\Controllers\LecturerPlotController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\SubClassController;
use App\Http\Controllers\RoomTimeController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\OfferedSubClassController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AcademicYearController;


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



Route::post('v1/login', [UserController::class, 'login']);
Route::middleware('auth:sanctum')->post('v1/logout', [UserController::class, 'logout']);
Route::middleware('auth:sanctum')->get('v1/user', [UserController::class, 'me']);

Route::get('v1/lecturers/{acadYearId}', [LecturerController::class, 'lecturersCreditByAcadYear']);
Route::get('v1/lecturer/{lecturerId}', [LecturerController::class, 'getLecturerCredit']);
Route::apiResource('v1/lecturer', LecturerController::class);

Route::apiResource('v1/subclass', SubClassController::class);

Route::apiResource('v1/room', RoomController::class);

Route::get('v1/offered_classes/{acadYearId}', [OfferedSubClassController::class, 'show']);
Route::post('v1/offered_classes', [OfferedSubClassController::class, 'store']);
Route::delete('v1/offered_classes', [OfferedSubClassController::class, 'destroy']);

Route::get('v1/lecturer_plot/{acadYearId}', [LecturerPlotController::class, 'getJoinedByAcadYearId']);
Route::put('v1/lecturer_plot', [LecturerPlotController::class, 'update']);
Route::post('v1/lecturer_plot', [LecturerPlotController::class, 'store']);
Route::delete('v1/lecturer_plot', [LecturerPlotController::class, 'destroy']);



Route::get('v1/room_time_helper/{acadYearId}', [RoomTimeController::class, 'getHelperByAcadYearId']);
Route::get('v1/room_time', [RoomTimeController::class, 'index']);
Route::get('v1/room_time/{acadYearId}', [RoomTimeController::class, 'show']);
Route::put('v1/room_time', [RoomTimeController::class, 'update']);
Route::post('v1/room_time', [RoomTimeController::class, 'store']);
Route::delete('v1/room_time', [RoomTimeController::class, 'destroy']);


Route::post('/v1/schedule', [ScheduleController::class, 'store']);
Route::post('/v1/schedule/brute_store', [ScheduleController::class, 'bruteStore']);
Route::delete('/v1/schedule', [ScheduleController::class, 'destroy']);
Route::get('/v1/schedule/{acadYearId}', [ScheduleController::class, 'show']);
Route::get('/v1/schedule/formatted/{acadYearId}', [ScheduleController::class, 'showFormatted']);

Route::apiResource('/v1/academic_year', AcademicYearController::class);




