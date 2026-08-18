<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{
    /**
     * Afficher la liste des employés
     */
    public function index()
    {
        $employees = Employee::with('service')->get();

        return view('employees.index', compact('employees'));
    }


    /**
     * Afficher le formulaire d'ajout
     */
    public function create()
    {
        $services = Service::all();

        return view('employees.create', compact('services'));
    }
   

    /**
     * Enregistrer un nouvel employé
     */
    public function store(Request $request)
    {
        $request->validate([
            'nom'      => 'required',
            'prenom'   => 'required',
            'email'    => 'required|email|unique:employees,email',
            'poste'    => 'required',
            'password' => 'required|min:6',
        ]);

        Employee::create([
            'service_id'    => $request->service_id,
            'nom'           => $request->nom,
            'prenom'        => $request->prenom,
            'postnom'       => $request->postnom,
            'email'         => $request->email,
            'telephone'     => $request->telephone,
            'poste'         => $request->poste,
            'departement'   => $request->departement,
            'date_embauche' => $request->date_embauche,
            'password'      => Hash::make($request->password),
        ]);

        return redirect()->route('employees.index')
                         ->with('success', 'Employé ajouté avec succès');
    }

    /**
     * Afficher un employé
     */
    public function show(string $id)
    {
        $employee = Employee::with('service')->find($id);

        return view('employees.show', compact('employee'));
    }


    /**
     * Afficher le formulaire de modification
     */
    public function edit(string $id)
    {
        $employee = Employee::find($id);
        $services = Service::all();

        return view('employees.edit', compact('employee', 'services'));
    }


    /**
     * Modifier un destroy
     */
    public function update(Request $request, string $id)
    {
        $employee = Employee::find($id);


        $employee->update([
            'service_id'    => $request->service_id,
            'nom'           => $request->nom,
            'prenom'        => $request->prenom,
            'postnom'       => $request->postnom,
            'email'         => $request->email,
            'telephone'     => $request->telephone,
            'poste'         => $request->poste,
            'departement'   => $request->departement,
            'date_embauche' => $request->date_embauche,
        ]);

        // Mise à jour du mot de passe si fourni
        if ($request->filled('password')) {
            $employee->update(['password' => Hash::make($request->password)]);
        }

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