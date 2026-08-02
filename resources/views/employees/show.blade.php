@extends('layouts.app')

@section('title', 'Détails de l\'Employé')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-3xl mx-auto">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-3xl font-bold text-gray-800">Détails de l'employé</h1>
            <div class="flex space-x-2">
                <a href="{{ route('employees.index') }}" class="text-gray-600 hover:text-gray-800 transition flex items-center">
                    <svg class="w-6 h-6 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Retour
                </a>
            </div>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded" role="alert">
                <p>{{ session('success') }}</p>
            </div>
        @endif

        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <!-- En-tête de la carte -->
            <div class="bg-gradient-to-r from-blue-500 to-blue-700 px-6 py-8 text-white">
                <div class="flex items-center space-x-4">
                    <div class="bg-white bg-opacity-20 rounded-full p-4">
                        <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-2xl font-bold">{{ $employee->nom }} {{ $employee->prenom }}</h2>
                        <p class="text-blue-100">{{ $employee->poste }}</p>
                    </div>
                </div>
            </div>

            <!-- Corps de la carte -->
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <h3 class="text-sm font-medium text-gray-500 uppercase tracking-wider mb-4">Informations personnelles</h3>
                        
                        <div class="space-y-4">
                            <div>
                                <p class="text-sm text-gray-500">Nom complet</p>
                                <p class="font-medium text-gray-800">{{ $employee->nom }} {{ $employee->prenom }} {{ $employee->postnom }}</p>
                            </div>
                            
                            <div>
                                <p class="text-sm text-gray-500">Email</p>
                                <p class="font-medium">
                                    <a href="mailto:{{ $employee->email }}" class="text-blue-600 hover:text-blue-800">{{ $employee->email }}</a>
                                </p>
                            </div>
                            
                            <div>
                                <p class="text-sm text-gray-500">Téléphone</p>
                                <p class="font-medium text-gray-800">{{ $employee->telephone ?? 'Non renseigné' }}</p>
                            </div>
                        </div>
                    </div>

                    <div>
                        <h3 class="text-sm font-medium text-gray-500 uppercase tracking-wider mb-4">Informations professionnelles</h3>
                        
                        <div class="space-y-4">
                            <div>
                                <p class="text-sm text-gray-500">Poste</p>
                                <p class="font-medium">
                                    <span class="bg-blue-100 text-blue-800 text-sm font-medium px-2.5 py-1 rounded-full">{{ $employee->poste }}</span>
                                </p>
                            </div>
                            
                            <div>
                                <p class="text-sm text-gray-500">Département</p>
                                <p class="font-medium text-gray-800">{{ $employee->departement ?? 'Non renseigné' }}</p>
                            </div>

                            <div>
                                <p class="text-sm text-gray-500">Service</p>
                                <p class="font-medium text-gray-800">
                                    @if($employee->service)
                                        <a href="{{ route('services.show', $employee->service->id_service) }}" class="text-blue-600 hover:text-blue-800">
                                            {{ $employee->service->nom }}
                                        </a>
                                    @else
                                        Non renseigné
                                    @endif
                                </p>
                            </div>
                            
                            <div>
                                <p class="text-sm text-gray-500">Date d'embauche</p>
                                <p class="font-medium text-gray-800">{{ $employee->date_embauche ? $employee->date_embauche->format('d/m/Y') : 'Non renseignée' }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Informations système -->
                <div class="mt-8 pt-6 border-t border-gray-200">
                    <h3 class="text-sm font-medium text-gray-500 uppercase tracking-wider mb-4">Informations système</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm text-gray-500">
                        <div>
                            <p>Créé le : <span class="text-gray-700">{{ $employee->created_at ? $employee->created_at->format('d/m/Y à H:i') : '—' }}</span></p>
                        </div>
                        <div>
                            <p>Modifié le : <span class="text-gray-700">{{ $employee->updated_at ? $employee->updated_at->format('d/m/Y à H:i') : '—' }}</span></p>
                        </div>
                    </div>
                </div>

                <!-- Actions -->
                <div class="mt-8 flex justify-end space-x-3">
                    <a href="{{ route('employees.edit', $employee->id) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white font-medium py-2 px-6 rounded-lg transition duration-200">
                        Modifier
                    </a>
                    <form action="{{ route('employees.destroy', $employee->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet employé ?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-medium py-2 px-6 rounded-lg transition duration-200">
                            Supprimer
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

