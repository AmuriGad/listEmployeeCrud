@extends('layouts.app')

@section('title', 'Mon Espace')

@section('content')
<div class="max-w-3xl mx-auto px-4 py-8">

    {{-- En-tête --}}
    <div class="mb-6 flex items-start justify-between flex-wrap gap-3">
        <div>
            <h1 class="text-xl font-semibold text-gray-900">Mon espace</h1>
            <p class="text-sm text-gray-500 mt-0.5">
                {{ $employee->prenom }} {{ $employee->nom }} — {{ $employee->poste }}
                @if($employee->departement) · {{ $employee->departement }} @endif
            </p>
        </div>
        <a href="{{ route('employe.demande.create') }}"
           class="text-sm bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded transition">
            + Nouvelle demande
        </a>
    </div>

    {{-- Stats --}}
    <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 mb-8">
        <div class="bg-white border border-gray-200 rounded-lg p-4 text-center">
            <p class="text-2xl font-bold text-gray-900">{{ $stats['total'] }}</p>
            <p class="text-xs text-gray-500 mt-0.5">Total</p>
        </div>
        <div class="bg-white border border-gray-200 rounded-lg p-4 text-center">
            <p class="text-2xl font-bold text-yellow-600">{{ $stats['en_attente'] }}</p>
            <p class="text-xs text-gray-500 mt-0.5">En attente</p>
        </div>
        <div class="bg-white border border-gray-200 rounded-lg p-4 text-center">
            <p class="text-2xl font-bold text-green-600">{{ $stats['acceptees'] }}</p>
            <p class="text-xs text-gray-500 mt-0.5">Acceptées</p>
        </div>
        <div class="bg-white border border-gray-200 rounded-lg p-4 text-center">
            <p class="text-2xl font-bold text-red-600">{{ $stats['refusees'] }}</p>
            <p class="text-xs text-gray-500 mt-0.5">Refusées</p>
        </div>
    </div>

    {{-- Liste des demandes --}}
    <div class="bg-white border border-gray-200 rounded-lg overflow-hidden">
        <div class="px-5 py-4 border-b border-gray-100">
            <h2 class="text-sm font-semibold text-gray-700">Mes demandes de congé</h2>
        </div>

        @if($demandes->isEmpty())
            <div class="px-5 py-10 text-center">
                <p class="text-sm text-gray-500 mb-3">Vous n'avez pas encore soumis de demande.</p>
                <a href="{{ route('employe.demande.create') }}"
                   class="text-sm bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded transition inline-block">
                    Faire une demande
                </a>
            </div>
        @else
            <div class="divide-y divide-gray-100">
                @foreach($demandes as $demande)
                <div class="px-5 py-4 flex items-center justify-between gap-4 hover:bg-gray-50 transition">
                    <div>
                        <p class="text-sm font-medium text-gray-800">{{ $demande->typeConge->libelle ?? 'Type non défini' }}</p>
                        <p class="text-xs text-gray-400 mt-0.5">
                            {{ $demande->date_debut->format('d/m/Y') }} → {{ $demande->date_fin->format('d/m/Y') }}
                            ({{ $demande->date_debut->diffInDays($demande->date_fin) + 1 }} jour{{ $demande->date_debut->diffInDays($demande->date_fin) >= 1 ? 's' : '' }})
                        </p>
                    </div>
                    <div class="flex items-center gap-3 flex-shrink-0">
                        @if($demande->statut === 'en_attente')
                            <span class="text-xs font-medium text-yellow-700 bg-yellow-50 border border-yellow-200 px-2 py-0.5 rounded">En attente</span>
                        @elseif($demande->statut === 'accepte')
                            <span class="text-xs font-medium text-green-700 bg-green-50 border border-green-200 px-2 py-0.5 rounded">Acceptée</span>
                        @else
                            <span class="text-xs font-medium text-red-700 bg-red-50 border border-red-200 px-2 py-0.5 rounded">Refusée</span>
                        @endif
                        <a href="{{ route('employe.demande.show', $demande->id_demande) }}"
                           class="text-xs text-blue-600 hover:underline">Voir</a>
                    </div>
                </div>
                @endforeach
            </div>
        @endif
    </div>

    <p class="text-xs text-gray-400 mt-5 text-center">
        Vos demandes sont traitées par le DRH. Consultez cette page pour suivre leur état.
    </p>

</div>
@endsection
