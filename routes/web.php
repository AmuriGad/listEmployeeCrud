<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\DemandeCongeController;
use App\Http\Controllers\AuthController;


/*
|--------------------------------------------------------------------------
| Authentification
|--------------------------------------------------------------------------
*/

Route::get('/login', [AuthController::class, 'showLogin'])
    ->name('login');

Route::post('/login', [AuthController::class, 'login'])
    ->name('login.post');

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');


/*
|--------------------------------------------------------------------------
| Routes protégées
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::resource('employees', EmployeeController::class);

    Route::resource('services', ServiceController::class);

    Route::resource('demande-conges', DemandeCongeController::class);
});


/*
|--------------------------------------------------------------------------
| Accueil
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return redirect()->route('login');
});

