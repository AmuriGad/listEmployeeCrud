@extends('layouts.app')

@section('title', 'Détail de la Demande de Congé')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-2xl mx-auto">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-3xl font-bold text-gray-800">Détail de la demande</h1>
            <div class="flex items-center space-x-2">
                <a href="{{ route('demande-conges.index') }}" class="text-gray-600 hover:text-gray-800 transition" title="Retour">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                </a>
                <a href="{{ route('demande-conges.edit', $demande->id_demande) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-lg text-sm font-medium transition">
                    Modifier
                </a>
            </div>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded" role="alert">
                <p>{{ session('success') }}</p>
            </div>
        @endif

        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="px-6 py-4 bg-gray-800 text-white flex justify-between items-center">
                <h2 class="font-semibold">Demande #{{ $demande->id_demande }}</h2>
                <span class="text-xs font-medium px-2.5 py-1 rounded-full {{ $demande->statutBadgeClass() }}">
                    {{ $demande->statutLabel() }}
                </span>
            </div>
            <div class="p-6">
                <dl class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Employé</dt>
                        <dd class="mt-1 text-gray-800 font-medium">
                            {{ $demande->employee->prenom }} {{ $demande->employee->nom }}
                        </dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Poste</dt>
                        <dd class="mt-1 text-gray-800">{{ $demande->employee->poste }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Type de congé</dt>
                        <dd class="mt-1 text-gray-800">{{ $demande->typeConge->libelle }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Description</dt>
                        <dd class="mt-1 text-gray-600">{{ $demande->typeConge->description ?? '—' }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Date de début</dt>
                        <dd class="mt-1 text-gray-800">{{ $demande->date_debut->format('d/m/Y') }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Date de fin</dt>
                        <dd class="mt-1 text-gray-800">{{ $demande->date_fin->format('d/m/Y') }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Durée</dt>
                        <dd class="mt-1 text-gray-800">{{ $demande->date_debut->diffInDays($demande->date_fin) + 1 }} jour(s)</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Créée le</dt>
                        <dd class="mt-1 text-gray-800">{{ $demande->created_at->format('d/m/Y H:i') }}</dd>
                    </div>
                </dl>
            </div>
        </div>
    </div>
</div>
@endsection

