@extends('layouts.app')

@section('title', 'Nouvelle demande de congé')

@section('content')
<div class="max-w-xl mx-auto px-4 py-8">

    <div class="flex items-center justify-between mb-6">
        <h1 class="text-xl font-semibold text-gray-900">Nouvelle demande de congé</h1>
        <a href="{{ route('employe.dashboard') }}" class="text-sm text-gray-500 hover:text-gray-700 transition">
            ← Retour
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
        <form method="POST" action="{{ route('employe.demande.store') }}" class="space-y-5">
            @csrf

            {{-- Type de congé --}}
            <div>
                <label for="type_conge_id" class="block text-sm font-medium text-gray-700 mb-1">
                    Type de congé <span class="text-red-500">*</span>
                </label>
                <select id="type_conge_id" name="type_conge_id" required
                    class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
                    <option value="" disabled selected>— Sélectionner —</option>
                    @foreach($typeConges as $type)
                        <option value="{{ $type->id_type_conge }}" {{ old('type_conge_id') == $type->id_type_conge ? 'selected' : '' }}>
                            {{ $type->libelle }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Dates --}}
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="date_debut" class="block text-sm font-medium text-gray-700 mb-1">
                        Date de début <span class="text-red-500">*</span>
                    </label>
                    <input type="date" id="date_debut" name="date_debut"
                        value="{{ old('date_debut') }}"
                        min="{{ now()->toDateString() }}"
                        required
                        class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
                </div>
                <div>
                    <label for="date_fin" class="block text-sm font-medium text-gray-700 mb-1">
                        Date de fin <span class="text-red-500">*</span>
                    </label>
                    <input type="date" id="date_fin" name="date_fin"
                        value="{{ old('date_fin') }}"
                        min="{{ now()->toDateString() }}"
                        required
                        class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
                </div>
            </div>

            {{-- Durée calculée --}}
            <p id="duree-info" class="text-sm text-gray-500 hidden"></p>

            {{-- Motif --}}
            <div>
                <label for="motif" class="block text-sm font-medium text-gray-700 mb-1">
                    Motif <span class="text-gray-400 font-normal">(optionnel)</span>
                </label>
                <textarea id="motif" name="motif" rows="3"
                    placeholder="Précisez le motif si nécessaire..."
                    class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 resize-none">{{ old('motif') }}</textarea>
            </div>

            <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                <a href="{{ route('employe.dashboard') }}" class="text-sm text-gray-500 hover:text-gray-700 transition">
                    Annuler
                </a>
                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium py-2 px-5 rounded transition">
                    Soumettre la demande
                </button>
            </div>
        </form>
    </div>

    <p class="text-xs text-gray-400 mt-4 text-center">
        Votre demande sera examinée par le DRH.
    </p>

</div>
@endsection

@push('scripts')
<script>
    const debut = document.getElementById('date_debut');
    const fin   = document.getElementById('date_fin');
    const info  = document.getElementById('duree-info');

    function calcDuree() {
        if (!debut.value || !fin.value) { info.classList.add('hidden'); return; }
        const d1 = new Date(debut.value);
        const d2 = new Date(fin.value);
        if (d2 < d1) { info.classList.add('hidden'); return; }
        const jours = Math.round((d2 - d1) / 86400000) + 1;
        info.textContent = 'Durée : ' + jours + ' jour' + (jours > 1 ? 's' : '');
        info.classList.remove('hidden');
    }

    debut.addEventListener('change', () => { if (fin.value && fin.value < debut.value) fin.value = debut.value; calcDuree(); });
    fin.addEventListener('change', calcDuree);
</script>
@endpush
