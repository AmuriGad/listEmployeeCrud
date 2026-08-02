<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\DemandeCongeController;


Route::get('/employees', [EmployeeController::class, 'index']);
Route::post('/employees', [EmployeeController::class, 'store']);
Route::get('/employees/{id}', [EmployeeController::class, 'show']);
Route::put('/employees/{id}', [EmployeeController::class, 'update']);
Route::delete('/employees/{id}', [EmployeeController::class, 'destroy']);

Route::apiResource('/employees', EmployeeController::class)->names('api.employees');
Route::apiResource('/services', ServiceController::class)->names('api.services');
Route::apiResource('/demande-conges', DemandeCongeController::class)->names('api.demande-conges');

