<?php

use App\Http\Controllers\HolidayPlanController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/users', [UserController::class, 'store'])->name('user.store');

Route::middleware("auth:sanctum")->group(function () {
    Route::apiResource('users', UserController::class)->except('store');
    Route::apiResource('holiday-plans', HolidayPlanController::class);
});
