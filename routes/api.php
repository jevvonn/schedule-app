<?php

use App\Http\Controllers\ScheduleController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get("/schedules", [ScheduleController::class, 'index']);
Route::get("/schedules/{id}", [ScheduleController::class, 'show']);

Route::post("/schedules", [ScheduleController::class, 'store']);
Route::put('/schedules/{id}', [ScheduleController::class, 'update']);

Route::delete("/schedules/{id}", [ScheduleController::class, 'destroy']);
