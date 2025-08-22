<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\ReportController;
use App\Http\Controllers\IncomeController;

Route::post('/login', [AuthController::class, 'login']);

Route::get('incomes', [IncomeController::class, 'index']);
Route::get('incomes/{id}', [IncomeController::class, 'show']);
Route::get('incomes-summary', [IncomeController::class, 'summary']);
Route::post('incomes', [IncomeController::class, 'store']);
Route::put('incomes/{id}', [IncomeController::class, 'update']);
Route::delete('incomes/{id}', [IncomeController::class, 'destroy']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', fn() => auth()->user());

    // Reports
    Route::get('/reports', [ReportController::class, 'index']);
    Route::post('/reports', [ReportController::class, 'store']);
    Route::patch('/reports', [ReportController::class, 'updateStatus']);
});
