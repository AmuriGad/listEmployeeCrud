<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\DemandeCongeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmployeDashboardController;


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
| Routes DRH (Administrateur) — accès réservé au poste "DRH"
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'is_drh'])->group(function () {

    // Dashboard DRH
    Route::get('/dashboard', function () {
        $totalEmployes  = \App\Models\Employee::count();
        $totalServices  = \App\Models\Service::count();
        $totalDemandes  = \App\Models\DemandeConge::count();
        $enAttente      = \App\Models\DemandeConge::where('statut', 'en_attente')->count();
        $acceptees      = \App\Models\DemandeConge::where('statut', 'accepte')->count();
        $refusees       = \App\Models\DemandeConge::where('statut', 'refuse')->count();
        $dernieresDemandes = \App\Models\DemandeConge::with(['employee', 'typeConge'])
            ->orderByDesc('created_at')
            ->limit(5)
            ->get();

        return view('dashboard', compact(
            'totalEmployes', 'totalServices', 'totalDemandes',
            'enAttente', 'acceptees', 'refusees', 'dernieresDemandes'
        ));
    })->name('dashboard');

    // Gestion des employés (CRUD complet)
    Route::resource('employees', EmployeeController::class);

    // Gestion des services (CRUD complet)
    Route::resource('services', ServiceController::class);

    // Gestion de toutes les demandes de congé
    Route::resource('demande-conges', DemandeCongeController::class);

    // Action rapide DRH : changer le statut d'une demande
    Route::post('demande-conges/{id}/statut', [DemandeCongeController::class, 'changerStatut'])
        ->name('demande-conges.statut');
});


/*
|--------------------------------------------------------------------------
| Routes Employé — accès à tous les employés authentifiés (non-DRH)
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->prefix('mon-espace')->name('employe.')->group(function () {

    // Dashboard personnel de l'employé
    Route::get('/dashboard', [EmployeDashboardController::class, 'index'])
        ->name('dashboard');

    // Nouvelle demande de congé
    Route::get('/demande-conge/nouvelle', [EmployeDashboardController::class, 'createDemande'])
        ->name('demande.create');

    Route::post('/demande-conge/nouvelle', [EmployeDashboardController::class, 'storeDemande'])
        ->name('demande.store');

    // Voir une demande de congé
    Route::get('/demande-conge/{id}', [EmployeDashboardController::class, 'showDemande'])
        ->name('demande.show');
});


/*
|--------------------------------------------------------------------------
| Accueil
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return redirect()->route('login');
});
