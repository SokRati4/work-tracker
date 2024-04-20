<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\EmploymentController;
use App\Http\Controllers\WorkdayController;
use App\Http\Middleware\CheckAcceptedMiddleware;
use App\Http\Middleware\CheckAdminMiddleware;
use App\Http\Middleware\CheckAdministrationMiddleware;

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();




Route::middleware([CheckAcceptedMiddleware::class])->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});

Route::middleware([CheckAdministrationMiddleware::class])->group(function () {
    Route::get('/employees', [EmployeeController::class, 'index'])->name('employees.index');
    Route::get('/accounts', [AccountController::class, 'index'])->name('accounts.index');
    Route::put('/accounts/{id}/accept', [AccountController::class, 'accept'])->name('accounts.accept');
    Route::get('/accounts/{id}/details', [AccountController::class, 'details'])->name('accounts.details');
    Route::get('/accounts/{id}/edit', [AccountController::class, 'edit'])->name('accounts.edit');
    Route::put('/accounts/{id}', [AccountController::class, 'update'])->name('accounts.update');
    Route::post('/accounts/{id}/change-role', [AccountController::class, 'changeRole'])->name('accounts.change-role');
    Route::get('/employees/{id}/employee', [EmployeeController::class, 'employee'])->name('employees.employee');
    Route::get('/employments/{id}/create-employment', [EmploymentController::class, 'createEmployment'])->name('employments.create-employment');
    Route::post('/employments/store-employment', [EmploymentController::class, 'storeEmployment'])->name('employments.store-employment');
    Route::get('/employments', [EmploymentController::class, 'index'])->name('employments.index');
    Route::get('/employments/{id}/details', [EmploymentController::class, 'details'])->name('employments.details');
    Route::get('/workdays/{id}/{month}/{year}/work-month', [WorkdayController::class, 'workMonth'])->name('workdays.work-month');
    Route::post('/workdays/update', [WorkdayController::class, 'update'])->name('workdays.update');
});

Route::middleware([CheckAdminMiddleware::class])->group(function () {
    Route::delete('/accounts/{id}', [AccountController::class, 'delete'])->name('accounts.delete');
});