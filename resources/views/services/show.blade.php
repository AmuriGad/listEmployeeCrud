@extends('layouts.app')

@section('title', 'Détails du Service')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-3xl mx-auto">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-3xl font-bold text-gray-800">Détails du service</h1>
            <div class="flex space-x-2">
                <a href="{{ route('services.index') }}" class="text-gray-600 hover:text-gray-800 transition flex items-center">
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
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-2xl font-bold">{{ $service->nom }}</h2>
                        <p class="text-blue-100">{{ $service->employees_count }} employé(s)</p>
                    </div>
                </div>
            </div>

            <!-- Corps de la carte -->
            <div class="p-6">
                <h3 class="text-sm font-medium text-gray-500 uppercase tracking-wider mb-4">Employés du service</h3>

                @if($service->employees->isEmpty())
                    <div class="bg-gray-50 border-2 border-dashed border-gray-300 rounded-lg p-8 text-center">
                        <p class="text-gray-500 mb-4">Aucun employé n'est affecté à ce service.</p>
                        <a href="{{ route('employees.create') }}" class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-6 rounded-lg transition duration-200">
                            Ajouter un employé
                        </a>
                    </div>
                @else
                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead>
                                <tr class="bg-gray-800 text-white">
                                    <th class="py-3 px-4 font-semibold">Nom</th>
                                    <th class="py-3 px-4 font-semibold">Prénom</th>
                                    <th class="py-3 px-4 font-semibold">Poste</th>
                                    <th class="py-3 px-4 font-semibold">Email</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($service->employees as $employee)
                                    <tr class="border-b border-gray-200 hover:bg-gray-50 transition">
                                        <td class="py-3 px-4 font-medium text-gray-800">{{ $employee->nom }}</td>
                                        <td class="py-3 px-4 text-gray-700">{{ $employee->prenom }}</td>
                                        <td class="py-3 px-4">
                                            <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-1 rounded-full">{{ $employee->poste }}</span>
                                        </td>
                                        <td class="py-3 px-4 text-gray-600">
                                            <a href="mailto:{{ $employee->email }}" class="text-blue-600 hover:text-blue-800">{{ $employee->email }}</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif

                <!-- Informations système -->
                <div class="mt-8 pt-6 border-t border-gray-200">
                    <h3 class="text-sm font-medium text-gray-500 uppercase tracking-wider mb-4">Informations système</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm text-gray-500">
                        <div>
                            <p>Créé le : <span class="text-gray-700">{{ $service->created_at ? $service->created_at->format('d/m/Y à H:i') : '—' }}</span></p>
                        </div>
                        <div>
                            <p>Modifié le : <span class="text-gray-700">{{ $service->updated_at ? $service->updated_at->format('d/m/Y à H:i') : '—' }}</span></p>
                        </div>
                    </div>
                </div>

                <!-- Actions -->
                <div class="mt-8 flex justify-end space-x-3">
                    <a href="{{ route('services.edit', $service->id_service) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white font-medium py-2 px-6 rounded-lg transition duration-200">
                        Modifier
                    </a>
                    <form action="{{ route('services.destroy', $service->id_service) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce service ?')">
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

