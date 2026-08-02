@extends('layouts.app')

@section('title', 'Liste des Demandes de Congé')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Demandes de Congé</h1>
        <a href="{{ route('demande-conges.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg transition duration-200">
            + Nouvelle demande
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded" role="alert">
            <p>{{ session('success') }}</p>
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded" role="alert">
            <p>{{ session('error') }}</p>
        </div>
    @endif

    @if($demandes->isEmpty())
        <div class="bg-gray-50 border-2 border-dashed border-gray-300 rounded-lg p-12 text-center">
            <svg class="mx-auto h-16 w-16 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
            </svg>
            <h3 class="text-lg font-medium text-gray-600 mb-2">Aucune demande de congé</h3>
            <p class="text-gray-500 mb-4">Les demandes de congé créées apparaîtront ici.</p>
            <a href="{{ route('demande-conges.create') }}" class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-6 rounded-lg transition duration-200">
                Créer une demande
            </a>
        </div>
    @else
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="bg-gray-800 text-white">
                            <th class="py-3 px-4 font-semibold">N°</th>
                            <th class="py-3 px-4 font-semibold">Employé</th>
                            <th class="py-3 px-4 font-semibold">Type de congé</th>
                            <th class="py-3 px-4 font-semibold">Date début</th>
                            <th class="py-3 px-4 font-semibold">Date fin</th>
                            <th class="py-3 px-4 font-semibold">Statut</th>
                            <th class="py-3 px-4 font-semibold text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($demandes as $demande)
                            <tr class="border-b border-gray-200 hover:bg-gray-50 transition">
                                <td class="py-3 px-4 text-gray-600">{{ $loop->iteration }}</td>
                                <td class="py-3 px-4 font-medium text-gray-800">
                                    {{ $demande->employee->prenom }} {{ $demande->employee->nom }}
                                </td>
                                <td class="py-3 px-4 text-gray-700">{{ $demande->typeConge->libelle }}</td>
                                <td class="py-3 px-4 text-gray-600">{{ $demande->date_debut->format('d/m/Y') }}</td>
                                <td class="py-3 px-4 text-gray-600">{{ $demande->date_fin->format('d/m/Y') }}</td>
                                <td class="py-3 px-4">
                                    <span class="text-xs font-medium px-2.5 py-1 rounded-full {{ $demande->statutBadgeClass() }}">
                                        {{ $demande->statutLabel() }}
                                    </span>
                                </td>
                                <td class="py-3 px-4">
                                    <div class="flex justify-center space-x-2">
                                        <a href="{{ route('demande-conges.show', $demande->id_demande) }}" class="bg-green-500 hover:bg-green-600 text-white p-2 rounded-lg transition" title="Voir">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                        </a>
                                        <a href="{{ route('demande-conges.edit', $demande->id_demande) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white p-2 rounded-lg transition" title="Modifier">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </a>
                                        <form action="{{ route('demande-conges.destroy', $demande->id_demande) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette demande ?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white p-2 rounded-lg transition" title="Supprimer">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
</div>
@endsection

