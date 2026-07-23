<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Afficher la liste des employés
     */
    public function index()
    {
        $employees = Employee::all();

        return view('employees.index', compact('employees'));
    }


    /**
     * Afficher le formulaire d'ajout
     */
    public function create()
    {
        return view('employees.create');
    }


    /**
     * Enregistrer un nouvel employé
     */
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required',
            'prenom' => 'required',
            'email' => 'required|email',
            'poste' => 'required',
        ]);


        Employee::create([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'postnom' => $request->postnom,
            'email' => $request->email,
            'telephone' => $request->telephone,
            'poste' => $request->poste,
            'departement' => $request->departement,
            'date_embauche' => $request->date_embauche,
        ]);


        return redirect()->route('employees.index')
                         ->with('success', 'Employé ajouté avec succès');
    }


    /**
     * Afficher un employé
     */
    public function show(string $id)
    {
        $employee = Employee::find($id);

        return view('employees.show', compact('employee'));
    }


    /**
     * Afficher le formulaire de modification
     */
    public function edit(string $id)
    {
        $employee = Employee::find($id);

        return view('employees.edit', compact('employee'));
    }


    /**
     * Modifier un employé
     */
    public function update(Request $request, string $id)
    {
        $employee = Employee::find($id);


        $employee->update([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'postnom' => $request->postnom,
            'email' => $request->email,
            'telephone' => $request->telephone,
            'poste' => $request->poste,
            'departement' => $request->departement,
            'date_embauche' => $request->date_embauche,
        ]);


        return redirect()->route('employees.index')
                         ->with('success', 'Employé modifié avec succès');
    }


    /**
     * Supprimer un employé
     */
    public function destroy(string $id)
    {
        $employee = Employee::find($id);

        $employee->delete();


        return redirect()->route('employees.index')
                         ->with('success', 'Employé supprimé avec succès');
    }
}