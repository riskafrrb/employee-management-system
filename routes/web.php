<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeeController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/', [DashboardController::class, 'index']);
Route::resource('employees', EmployeeController::class);
