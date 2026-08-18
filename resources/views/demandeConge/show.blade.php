@extends('layouts.app')

@section('title', 'Détail de la demande')

@section('content')
<div class="max-w-2xl mx-auto px-4 py-8">

    <div class="flex items-center justify-between mb-6">
        <h1 class="text-xl font-semibold text-gray-900">Détail de la demande</h1>
        <a href="{{ route('demande-conges.index') }}" class="text-sm text-gray-500 hover:text-gray-700 transition">
            ← Retour à la liste
        </a>
    </div>

    <div class="bg-white border border-gray-200 rounded-lg overflow-hidden">

        {{-- En-tête avec statut --}}
        <div class="px-5 py-4 border-b border-gray-100 flex items-center justify-between">
            <div>
                <p class="text-xs text-gray-400 uppercase tracking-wide font-medium mb-0.5">Demande #{{ $demande->id_demande }}</p>
                <p class="text-sm font-semibold text-gray-800">
                    {{ $demande->employee->prenom }} {{ $demande->employee->nom }}
                    <span class="text-gray-400 font-normal">— {{ $demande->employee->poste }}</span>
                </p>
            </div>
            <span class="text-xs font-medium px-2.5 py-1 rounded {{ $demande->statutBadgeClass() }}">
                {{ $demande->statutLabel() }}
            </span>
        </div>

        {{-- Détails --}}
        <div class="px-5 py-5 grid grid-cols-2 gap-5">
            <div>
                <p class="text-xs text-gray-400 uppercase tracking-wide font-medium mb-1">Type de congé</p>
                <p class="text-sm text-gray-800 font-medium">{{ $demande->typeConge->libelle ?? '—' }}</p>
            </div>
            <div>
                @php $jours = $demande->date_debut->diffInDays($demande->date_fin) + 1; @endphp
                <p class="text-xs text-gray-400 uppercase tracking-wide font-medium mb-1">Durée</p>
                <p class="text-sm text-gray-800 font-medium">{{ $jours }} jour{{ $jours > 1 ? 's' : '' }}</p>
            </div>
            <div>
                <p class="text-xs text-gray-400 uppercase tracking-wide font-medium mb-1">Date de début</p>
                <p class="text-sm text-gray-800">{{ $demande->date_debut->format('d/m/Y') }}</p>
            </div>
            <div>
                <p class="text-xs text-gray-400 uppercase tracking-wide font-medium mb-1">Date de fin</p>
                <p class="text-sm text-gray-800">{{ $demande->date_fin->format('d/m/Y') }}</p>
            </div>
            @if($demande->typeConge->description ?? false)
            <div class="col-span-2">
                <p class="text-xs text-gray-400 uppercase tracking-wide font-medium mb-1">Description du type</p>
                <p class="text-sm text-gray-600">{{ $demande->typeConge->description }}</p>
            </div>
            @endif
            <div>
                <p class="text-xs text-gray-400 uppercase tracking-wide font-medium mb-1">Soumise le</p>
                <p class="text-sm text-gray-800">{{ $demande->created_at->format('d/m/Y à H:i') }}</p>
            </div>
        </div>

        {{-- ======================================================
             ACTIONS DRH — Changer le statut
        ====================================================== --}}
        <div class="px-5 py-4 bg-gray-50 border-t border-gray-100">
            <p class="text-xs text-gray-500 font-medium uppercase tracking-wide mb-3">Action DRH — Changer le statut</p>
            <div class="flex items-center gap-3 flex-wrap">

                {{-- Accepter --}}
                @if($demande->statut !== 'accepte')
                <form method="POST" action="{{ route('demande-conges.statut', $demande->id_demande) }}">
                    @csrf
                    <input type="hidden" name="statut" value="accepte">
                    <button type="submit"
                        class="text-sm font-medium bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded transition"
                        onclick="return confirm('Accepter cette demande de congé ?')">
                        ✓ Accepter
                    </button>
                </form>
                @endif

                {{-- Refuser --}}
                @if($demande->statut !== 'refuse')
                <form method="POST" action="{{ route('demande-conges.statut', $demande->id_demande) }}">
                    @csrf
                    <input type="hidden" name="statut" value="refuse">
                    <button type="submit"
                        class="text-sm font-medium bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded transition"
                        onclick="return confirm('Refuser cette demande de congé ?')">
                        ✗ Refuser
                    </button>
                </form>
                @endif

                {{-- Remettre en attente --}}
                @if($demande->statut !== 'en_attente')
                <form method="POST" action="{{ route('demande-conges.statut', $demande->id_demande) }}">
                    @csrf
                    <input type="hidden" name="statut" value="en_attente">
                    <button type="submit"
                        class="text-sm font-medium text-gray-600 hover:text-gray-800 border border-gray-300 hover:border-gray-400 px-4 py-2 rounded transition">
                        ↩ Remettre en attente
                    </button>
                </form>
                @endif

                {{-- Modifier (complet) --}}
                <a href="{{ route('demande-conges.edit', $demande->id_demande) }}"
                   class="text-sm text-gray-500 hover:text-gray-700 border border-gray-200 hover:border-gray-300 px-4 py-2 rounded transition">
                    Modifier les détails
                </a>
            </div>
        </div>

    </div>

    {{-- Lien supprimer --}}
    <div class="mt-4 text-right">
        <form action="{{ route('demande-conges.destroy', $demande->id_demande) }}" method="POST"
              onsubmit="return confirm('Supprimer définitivement cette demande ?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="text-xs text-red-500 hover:text-red-700 transition">
                Supprimer cette demande
            </button>
        </form>
    </div>

</div>
@endsection
