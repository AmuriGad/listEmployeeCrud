@extends('layouts.app')

@section('title', 'Nouvelle Demande de Congé')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-2xl mx-auto">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-3xl font-bold text-gray-800">Nouvelle demande de congé</h1>
            <a href="{{ route('demande-conges.index') }}" class="text-gray-600 hover:text-gray-800 transition">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
            </a>
        </div>

        @if($errors->any())
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded">
                <h3 class="font-bold mb-2">Veuillez corriger les erreurs suivantes :</h3>
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="bg-white rounded-lg shadow-md p-6">
            <form action="{{ route('demande-conges.store') }}" method="POST">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="md:col-span-2">
                        <label for="employee_id" class="block text-sm font-medium text-gray-700 mb-1">Employé <span class="text-red-500">*</span></label>
                        <select name="employee_id" id="employee_id" required
                            class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition @error('employee_id') border-red-500 @enderror">
                            <option value="">-- Sélectionner un employé --</option>
                            @foreach($employees as $employee)
                                <option value="{{ $employee->id }}" {{ old('employee_id') == $employee->id ? 'selected' : '' }}>
                                    {{ $employee->prenom }} {{ $employee->nom }} ({{ $employee->poste }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="md:col-span-2">
                        <label for="type_conge_id" class="block text-sm font-medium text-gray-700 mb-1">Type de congé <span class="text-red-500">*</span></label>
                        <select name="type_conge_id" id="type_conge_id" required
                            class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition @error('type_conge_id') border-red-500 @enderror">
                            <option value="">-- Sélectionner un type de congé --</option>
                            @foreach($typeConges as $typeConge)
                                <option value="{{ $typeConge->id_type_conge }}" {{ old('type_conge_id') == $typeConge->id_type_conge ? 'selected' : '' }}>
                                    {{ $typeConge->libelle }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="date_debut" class="block text-sm font-medium text-gray-700 mb-1">Date de début <span class="text-red-500">*</span></label>
                        <input type="date" name="date_debut" id="date_debut" value="{{ old('date_debut') }}" required
                            class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition @error('date_debut') border-red-500 @enderror">
                    </div>

                    <div>
                        <label for="date_fin" class="block text-sm font-medium text-gray-700 mb-1">Date de fin <span class="text-red-500">*</span></label>
                        <input type="date" name="date_fin" id="date_fin" value="{{ old('date_fin') }}" required
                            class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition @error('date_fin') border-red-500 @enderror">
                    </div>
                </div>

                <div class="flex items-center justify-between mt-8 pt-6 border-t border-gray-200">
                    <a href="{{ route('demande-conges.index') }}" class="text-gray-600 hover:text-gray-800 transition font-medium">
                        Annuler
                    </a>
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2.5 px-8 rounded-lg transition duration-200">
                        Envoyer la demande
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

