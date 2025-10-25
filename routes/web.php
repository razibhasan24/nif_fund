<?php

use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

use App\Http\Controllers\{
    DashboardController,
    FundController,
    LoanRequestController,
    LoanController,
    InstallmentController
};

Route::get('/', [DashboardController::class,'index'])->name('dashboard');
Route::resource('funds', FundController::class);
Route::resource('loans', LoanController::class);
Route::resource('installments', InstallmentController::class);

// Loan Requests
Route::get('loan-requests',[LoanRequestController::class,'index'])->name('loan-requests.index');
Route::post('loan-requests/{id}/approve',[LoanRequestController::class,'approve'])->name('loan-requests.approve');
Route::post('loan-requests/{id}/reject',[LoanRequestController::class,'reject'])->name('loan-requests.reject');
