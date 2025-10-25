<?php

use App\Http\Controllers\{
    MemberController,
    FundController,
    LoanController,
    LoanRequestController,
    InstallmentController,
    DashboardController
};

Route::get('/dashboard', [DashboardController::class, 'index']);

Route::apiResource('members', MemberController::class);
Route::apiResource('funds', FundController::class);
Route::apiResource('loans', LoanController::class);
Route::apiResource('installments', InstallmentController::class);

// Loan Request Routes
Route::get('/loan-requests', [LoanRequestController::class, 'index']);
Route::post('/loan-requests', [LoanRequestController::class, 'store']);
Route::post('/loan-requests/{id}/approve', [LoanRequestController::class, 'approve']);
Route::post('/loan-requests/{id}/reject', [LoanRequestController::class, 'reject']);
Route::delete('/loan-requests/{id}', [LoanRequestController::class, 'destroy']);
