<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Afficher la liste des services
     */
    public function index()
    {
        $services = Service::withCount('employees')->get();

        return view('services.index', compact('services'));
    }

    /**
     * Afficher le formulaire d'ajout
     */
    public function create()
    {
        return view('services.create');
    }

    /**
     * Enregistrer un nouveau service
     */
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
        ]);

        Service::create([
            'nom' => $request->nom,
        ]);

        return redirect()->route('services.index')
                         ->with('success', 'Service ajouté avec succès');
    }

    /**
     * Afficher un service
     */
    public function show(string $id)
    {
        $service = Service::withCount('employees')->with('employees')->find($id);

        return view('services.show', compact('service'));
    }

    /**
     * Afficher le formulaire de modification
     */
    public function edit(string $id)
    {
        $service = Service::find($id);

        return view('services.edit', compact('service'));
    }

    /**
     * Modifier un service
     */
    public function update(Request $request, string $id)
    {
        $service = Service::find($id);

        $request->validate([
            'nom' => 'required|string|max:255',
        ]);

        $service->update([
            'nom' => $request->nom,
        ]);

        return redirect()->route('services.index')
                         ->with('success', 'Service modifié avec succès');
    }

    /**
     * Supprimer un service
     */
    public function destroy(string $id)
    {
        $service = Service::find($id);

        $service->delete();

        return redirect()->route('services.index')
                         ->with('success', 'Service supprimé avec succès');
    }
}

