<?php

use Illuminate\Support\Facades\Route;

// Controllers with proper subfolder namespaces
use App\Http\Controllers\Api\Fund\FundController;
use App\Http\Controllers\Api\Member\MemberController;
use App\Http\Controllers\Api\Loan\LoanController;
use App\Http\Controllers\Api\LoanRequest\LoanRequestController;
use App\Http\Controllers\Api\Installment\InstallmentController;
use App\Http\Controllers\Api\Payment\PaymentController;
use App\Http\Controllers\Api\DashboardController;

// Only API endpoints (no Blade views)
// Route::get('/dashboard', [DashboardController::class, 'index']);

// API Resource routes
Route::apiResource('members', MemberController::class);
Route::apiResource('funds', FundController::class);
Route::apiResource('loans', LoanController::class);
Route::apiResource('installments', InstallmentController::class);
Route::apiResource('payments', PaymentController::class);

// Loan Requests API (custom routes)
Route::get('/loan-requests', [LoanRequestController::class, 'index']);
Route::post('/loan-requests', [LoanRequestController::class, 'store']);
Route::post('/loan-requests/{id}/approve', [LoanRequestController::class, 'approve']);
Route::post('/loan-requests/{id}/reject', [LoanRequestController::class, 'reject']);
Route::delete('/loan-requests/{id}', [LoanRequestController::class, 'destroy']);
