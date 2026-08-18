@extends('layouts.app')

@section('title', 'Demandes de congé')

@section('content')
<div class="max-w-6xl mx-auto px-4 py-8">

    <div class="flex items-center justify-between mb-6">
        <h1 class="text-xl font-semibold text-gray-900">Demandes de congé</h1>
        <a href="{{ route('demande-conges.create') }}"
           class="text-sm bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded transition">
            + Nouvelle demande
        </a>
    </div>

    @if($demandes->isEmpty())
        <div class="bg-white border border-gray-200 rounded-lg p-10 text-center">
            <p class="text-sm text-gray-500 mb-3">Aucune demande de congé enregistrée.</p>
            <a href="{{ route('demande-conges.create') }}"
               class="text-sm bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded transition inline-block">
                Créer une demande
            </a>
        </div>
    @else
        <div class="bg-white border border-gray-200 rounded-lg overflow-hidden">
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-gray-200 text-left text-xs text-gray-500 uppercase tracking-wide">
                        <th class="px-4 py-3 font-medium">Employé</th>
                        <th class="px-4 py-3 font-medium">Type</th>
                        <th class="px-4 py-3 font-medium">Début</th>
                        <th class="px-4 py-3 font-medium">Fin</th>
                        <th class="px-4 py-3 font-medium">Statut</th>
                        <th class="px-4 py-3 font-medium text-center">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach($demandes as $demande)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-4 py-3 font-medium text-gray-800">
                            {{ $demande->employee->prenom }} {{ $demande->employee->nom }}
                            <span class="block text-xs text-gray-400 font-normal">{{ $demande->employee->poste }}</span>
                        </td>
                        <td class="px-4 py-3 text-gray-600">{{ $demande->typeConge->libelle }}</td>
                        <td class="px-4 py-3 text-gray-600">{{ $demande->date_debut->format('d/m/Y') }}</td>
                        <td class="px-4 py-3 text-gray-600">{{ $demande->date_fin->format('d/m/Y') }}</td>
                        <td class="px-4 py-3">
                            <span class="text-xs font-medium px-2 py-0.5 rounded {{ $demande->statutBadgeClass() }}">
                                {{ $demande->statutLabel() }}
                            </span>
                        </td>
                        <td class="px-4 py-3">
                            <div class="flex justify-center items-center gap-2">
                                {{-- Voir --}}
                                <a href="{{ route('demande-conges.show', $demande->id_demande) }}"
                                   class="text-xs text-blue-600 hover:underline">Voir</a>

                                {{-- Accepter rapide (si pas déjà accepté) --}}
                                @if($demande->statut !== 'accepte')
                                <form method="POST" action="{{ route('demande-conges.statut', $demande->id_demande) }}">
                                    @csrf
                                    <input type="hidden" name="statut" value="accepte">
                                    <button type="submit"
                                        class="text-xs text-green-700 hover:text-green-900 transition"
                                        title="Accepter"
                                        onclick="return confirm('Accepter cette demande ?')">✓</button>
                                </form>
                                @endif

                                {{-- Refuser rapide (si pas déjà refusé) --}}
                                @if($demande->statut !== 'refuse')
                                <form method="POST" action="{{ route('demande-conges.statut', $demande->id_demande) }}">
                                    @csrf
                                    <input type="hidden" name="statut" value="refuse">
                                    <button type="submit"
                                        class="text-xs text-red-600 hover:text-red-800 transition"
                                        title="Refuser"
                                        onclick="return confirm('Refuser cette demande ?')">✗</button>
                                </form>
                                @endif

                                {{-- Supprimer --}}
                                <form action="{{ route('demande-conges.destroy', $demande->id_demande) }}" method="POST"
                                      onsubmit="return confirm('Supprimer cette demande ?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-xs text-gray-400 hover:text-red-500 transition" title="Supprimer">
                                        ×
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

</div>
@endsection
