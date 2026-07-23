@extends('layouts.app')

@section('title', 'Modifier un Employé')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-2xl mx-auto">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-3xl font-bold text-gray-800">Modifier l'employé</h1>
            <a href="{{ route('employees.index') }}" class="text-gray-600 hover:text-gray-800 transition">
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
            <form action="{{ route('employees.update', $employee->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="nom" class="block text-sm font-medium text-gray-700 mb-1">Nom <span class="text-red-500">*</span></label>
                        <input type="text" name="nom" id="nom" value="{{ old('nom', $employee->nom) }}" required
                            class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition @error('nom') border-red-500 @enderror"
                            placeholder="Nom de famille">
                    </div>

                    <div>
                        <label for="prenom" class="block text-sm font-medium text-gray-700 mb-1">Prénom <span class="text-red-500">*</span></label>
                        <input type="text" name="prenom" id="prenom" value="{{ old('prenom', $employee->prenom) }}" required
                            class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition @error('prenom') border-red-500 @enderror"
                            placeholder="Prénom">
                    </div>

                    <div>
                        <label for="postnom" class="block text-sm font-medium text-gray-700 mb-1">Postnom</label>
                        <input type="text" name="postnom" id="postnom" value="{{ old('postnom', $employee->postnom) }}"
                            class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                            placeholder="Postnom (optionnel)">
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email <span class="text-red-500">*</span></label>
                        <input type="email" name="email" id="email" value="{{ old('email', $employee->email) }}" required
                            class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition @error('email') border-red-500 @enderror"
                            placeholder="email@exemple.com">
                    </div>

                    <div>
                        <label for="telephone" class="block text-sm font-medium text-gray-700 mb-1">Téléphone</label>
                        <input type="tel" name="telephone" id="telephone" value="{{ old('telephone', $employee->telephone) }}"
                            class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                            placeholder="+243 000 000 000">
                    </div>

                    <div>
                        <label for="poste" class="block text-sm font-medium text-gray-700 mb-1">Poste <span class="text-red-500">*</span></label>
                        <input type="text" name="poste" id="poste" value="{{ old('poste', $employee->poste) }}" required
                            class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition @error('poste') border-red-500 @enderror"
                            placeholder="Titre du poste">
                    </div>

                    <div>
                        <label for="departement" class="block text-sm font-medium text-gray-700 mb-1">Département</label>
                        <input type="text" name="departement" id="departement" value="{{ old('departement', $employee->departement) }}"
                            class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                            placeholder="Département (optionnel)">
                    </div>

                    <div>
                        <label for="date_embauche" class="block text-sm font-medium text-gray-700 mb-1">Date d'embauche</label>
                        <input type="date" name="date_embauche" id="date_embauche" value="{{ old('date_embauche', $employee->date_embauche ? $employee->date_embauche->format('Y-m-d') : '') }}"
                            class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                    </div>
                </div>

                <div class="flex items-center justify-between mt-8 pt-6 border-t border-gray-200">
                    <a href="{{ route('employees.index') }}" class="text-gray-600 hover:text-gray-800 transition font-medium">
                        Annuler
                    </a>
                    <button type="submit" class="bg-yellow-500 hover:bg-yellow-600 text-white font-medium py-2.5 px-8 rounded-lg transition duration-200">
                        Mettre à jour
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

