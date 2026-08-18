@extends('layouts.app')

@section('title', 'Détail de la demande')

@section('content')
<div class="max-w-xl mx-auto px-4 py-8">

    <div class="flex items-center justify-between mb-6">
        <h1 class="text-xl font-semibold text-gray-900">Détail de la demande</h1>
        <a href="{{ route('employe.dashboard') }}" class="text-sm text-gray-500 hover:text-gray-700 transition">
            ← Retour
        </a>
    </div>

    <div class="bg-white border border-gray-200 rounded-lg overflow-hidden">

        {{-- Statut --}}
        <div class="px-5 py-4 border-b border-gray-100 flex items-center justify-between">
            <span class="text-sm font-medium text-gray-700">Statut de la demande</span>
            @if($demande->statut === 'en_attente')
                <span class="text-xs font-medium text-yellow-700 bg-yellow-50 border border-yellow-200 px-2.5 py-1 rounded">En attente</span>
            @elseif($demande->statut === 'accepte')
                <span class="text-xs font-medium text-green-700 bg-green-50 border border-green-200 px-2.5 py-1 rounded">Acceptée</span>
            @else
                <span class="text-xs font-medium text-red-700 bg-red-50 border border-red-200 px-2.5 py-1 rounded">Refusée</span>
            @endif
        </div>

        {{-- Détails --}}
        <div class="px-5 py-4 space-y-4">
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <p class="text-xs text-gray-400 uppercase tracking-wide font-medium mb-1">Type de congé</p>
                    <p class="text-sm text-gray-800 font-medium">{{ $demande->typeConge->libelle ?? '—' }}</p>
                </div>
                <div>
                    @php $jours = $demande->date_debut->diffInDays($demande->date_fin) + 1; @endphp
                    <p class="text-xs text-gray-400 uppercase tracking-wide font-medium mb-1">Durée</p>
                    <p class="text-sm text-gray-800 font-medium">{{ $jours }} jour{{ $jours > 1 ? 's' : '' }}</p>
                </div>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <p class="text-xs text-gray-400 uppercase tracking-wide font-medium mb-1">Date de début</p>
                    <p class="text-sm text-gray-800">{{ $demande->date_debut->format('d/m/Y') }}</p>
                </div>
                <div>
                    <p class="text-xs text-gray-400 uppercase tracking-wide font-medium mb-1">Date de fin</p>
                    <p class="text-sm text-gray-800">{{ $demande->date_fin->format('d/m/Y') }}</p>
                </div>
            </div>
            <div>
                <p class="text-xs text-gray-400 uppercase tracking-wide font-medium mb-1">Soumise le</p>
                <p class="text-sm text-gray-800">{{ $demande->created_at->format('d/m/Y à H:i') }}</p>
            </div>
        </div>

        {{-- Message selon statut --}}
        <div class="px-5 py-4 bg-gray-50 border-t border-gray-100">
            @if($demande->statut === 'en_attente')
                <p class="text-sm text-gray-500">Votre demande est en cours d'examen par le DRH.</p>
            @elseif($demande->statut === 'accepte')
                <p class="text-sm text-green-700">Votre demande a été acceptée.</p>
            @else
                <p class="text-sm text-red-600">Votre demande a été refusée. Contactez le DRH pour plus d'informations.</p>
            @endif
        </div>
    </div>

</div>
@endsection
