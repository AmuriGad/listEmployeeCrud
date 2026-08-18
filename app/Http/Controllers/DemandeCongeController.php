<?php

namespace App\Http\Controllers;

use App\Models\DemandeConge;
use App\Models\Employee;
use App\Models\TypeConge;
use Illuminate\Http\Request;

class DemandeCongeController extends Controller
{
    /**
     * Afficher la liste des demandes de congé.
     */
    public function index()
    {
        $demandes = DemandeConge::with(['employee', 'typeConge'])
            ->orderByDesc('created_at')
            ->get();

        return view('demandeConge.index', compact('demandes'));
    }

    /**
     * Afficher le formulaire de création d'une demande de congé (côté DRH).
     */
    public function create()
    {
        $employees  = Employee::orderBy('nom')->orderBy('prenom')->get();
        $typeConges = TypeConge::orderBy('libelle')->get();

        if ($employees->isEmpty()) {
            return redirect()->route('demande-conges.index')
                ->with('error', 'Aucun employé trouvé pour effectuer une demande de congé.');
        }

        if ($typeConges->isEmpty()) {
            return redirect()->route('demande-conges.index')
                ->with('error', 'Aucun type de congé disponible.');
        }

        return view('demandeConge.create', compact('employees', 'typeConges'));
    }

    /**
     * Enregistrer une nouvelle demande de congé (côté DRH).
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'employee_id'   => 'required|exists:employees,id',
            'type_conge_id' => 'required|exists:type_conges,id_type_conge',
            'date_debut'    => 'required|date',
            'date_fin'      => 'required|date|after_or_equal:date_debut',
        ]);

        DemandeConge::create([
            'employee_id'   => $validated['employee_id'],
            'type_conge_id' => $validated['type_conge_id'],
            'date_debut'    => $validated['date_debut'],
            'date_fin'      => $validated['date_fin'],
            'statut'        => 'en_attente',   // Toujours "en attente" à la création
        ]);

        return redirect()->route('demande-conges.index')
            ->with('success', 'Demande de congé créée avec succès.');
    }

    /**
     * Afficher une demande de congé.
     */
    public function show(string $id)
    {
        $demande = DemandeConge::with(['employee', 'typeConge'])->findOrFail($id);

        return view('demandeConge.show', compact('demande'));
    }

    /**
     * Afficher le formulaire de modification d'une demande de congé.
     */
    public function edit(string $id)
    {
        $demande    = DemandeConge::findOrFail($id);
        $employees  = Employee::orderBy('nom')->orderBy('prenom')->get();
        $typeConges = TypeConge::orderBy('libelle')->get();

        return view('demandeConge.edit', compact('demande', 'employees', 'typeConges'));
    }

    /**
     * Modifier une demande de congé.
     */
    public function update(Request $request, string $id)
    {
        $demande = DemandeConge::findOrFail($id);

        $validated = $request->validate([
            'employee_id'   => 'required|exists:employees,id',
            'type_conge_id' => 'required|exists:type_conges,id_type_conge',
            'date_debut'    => 'required|date',
            'date_fin'      => 'required|date|after_or_equal:date_debut',
            'statut'        => 'required|in:en_attente,accepte,refuse',
        ]);

        $demande->update($validated);

        return redirect()->route('demande-conges.show', $demande->id_demande)
            ->with('success', 'Demande de congé mise à jour avec succès.');
    }

    /**
     * Changer uniquement le statut d'une demande — action rapide DRH.
     */
    public function changerStatut(Request $request, string $id)
    {
        $request->validate([
            'statut' => 'required|in:en_attente,accepte,refuse',
        ]);

        $demande = DemandeConge::findOrFail($id);
        $demande->update(['statut' => $request->statut]);

        $labels = [
            'en_attente' => 'remise en attente',
            'accepte'    => 'acceptée',
            'refuse'     => 'refusée',
        ];

        return redirect()->route('demande-conges.show', $demande->id_demande)
            ->with('success', 'Demande ' . ($labels[$request->statut] ?? 'mise à jour') . ' avec succès.');
    }

    /**
     * Supprimer une demande de congé.
     */
    public function destroy(string $id)
    {
        $demande = DemandeConge::findOrFail($id);
        $demande->delete();

        return redirect()->route('demande-conges.index')
            ->with('success', 'Demande de congé supprimée avec succès.');
    }
}
