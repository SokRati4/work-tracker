<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Middleware\CheckAcceptedMiddleware;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();




Route::middleware([CheckAcceptedMiddleware::class])->group(function () {
    Route::get('/employees', [EmployeeController::class, 'index'])->name('employees.index');
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});