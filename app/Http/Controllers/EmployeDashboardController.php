<?php

namespace App\Http\Controllers;

use App\Models\DemandeConge;
use App\Models\TypeConge;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmployeDashboardController extends Controller
{
    /**
     * Dashboard principal de l'employé.
     */
    public function index()
    {
        $employee = Auth::user();

        $demandes = DemandeConge::with('typeConge')
            ->where('employee_id', $employee->id)
            ->orderByDesc('created_at')
            ->get();

        $stats = [
            'total'      => $demandes->count(),
            'en_attente' => $demandes->where('statut', 'en_attente')->count(),
            'acceptees'  => $demandes->where('statut', 'accepte')->count(),
            'refusees'   => $demandes->where('statut', 'refuse')->count(),
        ];

        return view('employe.dashboard', compact('employee', 'demandes', 'stats'));
    }

    /**
     * Formulaire de nouvelle demande de congé.
     */
    public function createDemande()
    {
        $typeConges = TypeConge::orderBy('libelle')->get();

        if ($typeConges->isEmpty()) {
            return redirect()->route('employe.dashboard')
                ->with('error', 'Aucun type de congé disponible pour le moment.');
        }

        return view('employe.create-demande', compact('typeConges'));
    }

    /**
     * Soumettre une demande de congé.
     */
    public function storeDemande(Request $request)
    {
        $validated = $request->validate([
            'type_conge_id' => 'required|exists:type_conges,id_type_conge',
            'date_debut'    => 'required|date|after_or_equal:today',
            'date_fin'      => 'required|date|after_or_equal:date_debut',
            'motif'         => 'nullable|string|max:500',
        ]);

        DemandeConge::create([
            'employee_id'   => Auth::id(),
            'type_conge_id' => $validated['type_conge_id'],
            'date_debut'    => $validated['date_debut'],
            'date_fin'      => $validated['date_fin'],
            'statut'        => 'en_attente',
        ]);

        return redirect()->route('employe.dashboard')
            ->with('success', 'Votre demande de congé a été soumise avec succès !');
    }

    /**
     * Détail d'une demande de congé de l'employé.
     */
    public function showDemande(string $id)
    {
        $demande = DemandeConge::with('typeConge')
            ->where('employee_id', Auth::id())
            ->findOrFail($id);

        return view('employe.show-demande', compact('demande'));
    }
}
