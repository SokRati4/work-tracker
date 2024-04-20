<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\AccountController;
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
});

Route::middleware([CheckAdminMiddleware::class])->group(function () {
    Route::delete('/accounts/{id}', [AccountController::class, 'delete'])->name('accounts.delete');
});