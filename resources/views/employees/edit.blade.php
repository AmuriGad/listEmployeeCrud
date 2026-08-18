@extends('layouts.app')

@section('title', 'Modifier un Employé')

@section('content')
<div class="max-w-2xl mx-auto px-4 py-8">

    <div class="flex items-center justify-between mb-6">
        <h1 class="text-xl font-semibold text-gray-900">Modifier l'employé</h1>
        <a href="{{ route('employees.index') }}" class="text-sm text-gray-500 hover:text-gray-700 transition">
            ← Retour à la liste
        </a>
    </div>

    @if($errors->any())
        <div class="bg-red-50 border border-red-200 text-red-700 text-sm px-4 py-3 rounded mb-5">
            <ul class="list-disc list-inside space-y-1">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="bg-white border border-gray-200 rounded-lg p-6">
        <form action="{{ route('employees.update', $employee->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                {{-- Service --}}
                <div class="md:col-span-2">
                    <label for="service_id" class="block text-sm font-medium text-gray-700 mb-1">Service</label>
                    <select name="service_id" id="service_id"
                        class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
                        <option value="">— Aucun service —</option>
                        @foreach($services as $service)
                            <option value="{{ $service->id_service }}" {{ old('service_id', $employee->service_id) == $service->id_service ? 'selected' : '' }}>
                                {{ $service->nom }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Nom --}}
                <div>
                    <label for="nom" class="block text-sm font-medium text-gray-700 mb-1">Nom <span class="text-red-500">*</span></label>
                    <input type="text" name="nom" id="nom" value="{{ old('nom', $employee->nom) }}" required
                        class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 @error('nom') border-red-400 @enderror">
                </div>

                {{-- Prénom --}}
                <div>
                    <label for="prenom" class="block text-sm font-medium text-gray-700 mb-1">Prénom <span class="text-red-500">*</span></label>
                    <input type="text" name="prenom" id="prenom" value="{{ old('prenom', $employee->prenom) }}" required
                        class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 @error('prenom') border-red-400 @enderror">
                </div>

                {{-- Postnom --}}
                <div>
                    <label for="postnom" class="block text-sm font-medium text-gray-700 mb-1">Postnom</label>
                    <input type="text" name="postnom" id="postnom" value="{{ old('postnom', $employee->postnom) }}"
                        placeholder="Optionnel"
                        class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
                </div>

                {{-- Email --}}
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email <span class="text-red-500">*</span></label>
                    <input type="email" name="email" id="email" value="{{ old('email', $employee->email) }}" required
                        class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 @error('email') border-red-400 @enderror">
                </div>

                {{-- Téléphone --}}
                <div>
                    <label for="telephone" class="block text-sm font-medium text-gray-700 mb-1">Téléphone</label>
                    <input type="tel" name="telephone" id="telephone" value="{{ old('telephone', $employee->telephone) }}"
                        placeholder="+243 000 000 000"
                        class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
                </div>

                {{-- Poste --}}
                <div>
                    <label for="poste" class="block text-sm font-medium text-gray-700 mb-1">Poste <span class="text-red-500">*</span></label>
                    <input type="text" name="poste" id="poste" value="{{ old('poste', $employee->poste) }}" required
                        class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 @error('poste') border-red-400 @enderror">
                </div>

                {{-- Département --}}
                <div>
                    <label for="departement" class="block text-sm font-medium text-gray-700 mb-1">Département</label>
                    <input type="text" name="departement" id="departement" value="{{ old('departement', $employee->departement) }}"
                        class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
                </div>

                {{-- Date d'embauche --}}
                <div>
                    <label for="date_embauche" class="block text-sm font-medium text-gray-700 mb-1">Date d'embauche</label>
                    <input type="date" name="date_embauche" id="date_embauche"
                        value="{{ old('date_embauche', $employee->date_embauche ? $employee->date_embauche->format('Y-m-d') : '') }}"
                        class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
                </div>

                {{-- Nouveau mot de passe --}}
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Nouveau mot de passe</label>
                    <input type="password" name="password" id="password"
                        placeholder="Laisser vide pour ne pas changer"
                        class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 @error('password') border-red-400 @enderror">
                    <p class="text-xs text-gray-400 mt-1">Laissez vide pour conserver le mot de passe actuel.</p>
                </div>

            </div>

            <div class="flex items-center justify-between mt-6 pt-5 border-t border-gray-100">
                <a href="{{ route('employees.index') }}" class="text-sm text-gray-500 hover:text-gray-700 transition">
                    Annuler
                </a>
                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium py-2 px-5 rounded transition">
                    Mettre à jour
                </button>
            </div>
        </form>
    </div>

</div>
@endsection
