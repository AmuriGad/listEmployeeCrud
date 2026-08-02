<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ServiceController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Routes HTML (formulaires + navigation) pour l'application.
|
*/

Route::resource('employees', EmployeeController::class);
Route::resource('services', ServiceController::class);

Route::get('/', function () {
    return redirect()->route('employees.index');
});

