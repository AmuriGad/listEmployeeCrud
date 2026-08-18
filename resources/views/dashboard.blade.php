@extends('layouts.app')

@section('title', 'Tableau de bord')

@section('content')
<div class="max-w-6xl mx-auto px-4 py-8">

    <div class="mb-6">
        <h1 class="text-xl font-semibold text-gray-900">Tableau de bord</h1>
        <p class="text-sm text-gray-500 mt-0.5">Bienvenue, {{ Auth::user()->prenom }} {{ Auth::user()->nom }}</p>
    </div>

    {{-- Statistiques --}}
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-8">
        <a href="{{ route('employees.index') }}"
           class="bg-white border border-gray-200 rounded-lg p-5 hover:border-gray-300 hover:shadow-sm transition block">
            <p class="text-2xl font-bold text-gray-900">{{ $totalEmployes }}</p>
            <p class="text-sm text-gray-500 mt-1">Employés</p>
        </a>
        <a href="{{ route('services.index') }}"
           class="bg-white border border-gray-200 rounded-lg p-5 hover:border-gray-300 hover:shadow-sm transition block">
            <p class="text-2xl font-bold text-gray-900">{{ $totalServices }}</p>
            <p class="text-sm text-gray-500 mt-1">Services</p>
        </a>
        <a href="{{ route('demande-conges.index') }}"
           class="bg-white border border-gray-200 rounded-lg p-5 hover:border-gray-300 hover:shadow-sm transition block">
            <p class="text-2xl font-bold text-gray-900">{{ $totalDemandes }}</p>
            <p class="text-sm text-gray-500 mt-1">Demandes de congé</p>
        </a>
    </div>

    {{-- Statuts des demandes --}}
    <div class="grid grid-cols-3 gap-4 mb-8">
        <div class="bg-white border border-gray-200 rounded-lg p-4">
            <p class="text-xl font-bold text-yellow-600">{{ $enAttente }}</p>
            <p class="text-sm text-gray-500 mt-0.5">En attente</p>
        </div>
        <div class="bg-white border border-gray-200 rounded-lg p-4">
            <p class="text-xl font-bold text-green-600">{{ $acceptees }}</p>
            <p class="text-sm text-gray-500 mt-0.5">Acceptées</p>
        </div>
        <div class="bg-white border border-gray-200 rounded-lg p-4">
            <p class="text-xl font-bold text-red-600">{{ $refusees }}</p>
            <p class="text-sm text-gray-500 mt-0.5">Refusées</p>
        </div>
    </div>

    {{-- Dernières demandes --}}
    <div class="bg-white border border-gray-200 rounded-lg overflow-hidden">
        <div class="px-5 py-4 border-b border-gray-100 flex items-center justify-between">
            <h2 class="text-sm font-semibold text-gray-700">Dernières demandes de congé</h2>
            <a href="{{ route('demande-conges.index') }}" class="text-sm text-blue-600 hover:underline">Voir tout</a>
        </div>

        @if($dernieresDemandes->isEmpty())
            <div class="px-5 py-8 text-center text-sm text-gray-400">
                Aucune demande pour le moment.
            </div>
        @else
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-gray-100 text-left text-xs text-gray-500 uppercase tracking-wide">
                        <th class="px-5 py-3 font-medium">Employé</th>
                        <th class="px-5 py-3 font-medium">Type</th>
                        <th class="px-5 py-3 font-medium">Période</th>
                        <th class="px-5 py-3 font-medium">Statut</th>
                        <th class="px-5 py-3 font-medium"></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @foreach($dernieresDemandes as $demande)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-5 py-3 text-gray-800 font-medium">
                            {{ $demande->employee->prenom ?? '—' }} {{ $demande->employee->nom ?? '' }}
                            <span class="block text-xs text-gray-400 font-normal">{{ $demande->employee->poste ?? '' }}</span>
                        </td>
                        <td class="px-5 py-3 text-gray-600">{{ $demande->typeConge->libelle ?? '—' }}</td>
                        <td class="px-5 py-3 text-gray-500">
                            {{ $demande->date_debut->format('d/m/Y') }} → {{ $demande->date_fin->format('d/m/Y') }}
                        </td>
                        <td class="px-5 py-3">
                            @if($demande->statut === 'en_attente')
                                <span class="text-xs font-medium text-yellow-700 bg-yellow-50 border border-yellow-200 px-2 py-0.5 rounded">En attente</span>
                            @elseif($demande->statut === 'accepte')
                                <span class="text-xs font-medium text-green-700 bg-green-50 border border-green-200 px-2 py-0.5 rounded">Acceptée</span>
                            @else
                                <span class="text-xs font-medium text-red-700 bg-red-50 border border-red-200 px-2 py-0.5 rounded">Refusée</span>
                            @endif
                        </td>
                        <td class="px-5 py-3">
                            <a href="{{ route('demande-conges.show', $demande->id_demande) }}" class="text-blue-600 hover:underline text-xs">Voir</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>

    {{-- Actions rapides --}}
    <div class="flex gap-3 mt-6">
        <a href="{{ route('employees.create') }}"
           class="text-sm bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded transition">
            + Nouvel employé
        </a>
        <a href="{{ route('demande-conges.create') }}"
           class="text-sm bg-white hover:bg-gray-50 text-gray-700 border border-gray-300 px-4 py-2 rounded transition">
            + Nouvelle demande de congé
        </a>
    </div>

</div>
@endsection
