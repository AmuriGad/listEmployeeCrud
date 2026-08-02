@extends('layouts.app')

@section('title', 'Ajouter un Service')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-2xl mx-auto">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-3xl font-bold text-gray-800">Ajouter un service</h1>
            <a href="{{ route('services.index') }}" class="text-gray-600 hover:text-gray-800 transition">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
            </a>
        </div>

        @if($errors->any())
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded">
                <h3 class="font-bold mb-2">Veuillez corriger les erreurs suivantes :</h3>
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="bg-white rounded-lg shadow-md p-6">
            <form action="{{ route('services.store') }}" method="POST">
                @csrf

                <div>
                    <label for="nom" class="block text-sm font-medium text-gray-700 mb-1">Nom du service <span class="text-red-500">*</span></label>
                    <input type="text" name="nom" id="nom" value="{{ old('nom') }}" required
                        class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition @error('nom') border-red-500 @enderror"
                        placeholder="Ex : Ressources Humaines">
                </div>

                <div class="flex items-center justify-between mt-8 pt-6 border-t border-gray-200">
                    <a href="{{ route('services.index') }}" class="text-gray-600 hover:text-gray-800 transition font-medium">
                        Annuler
                    </a>
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2.5 px-8 rounded-lg transition duration-200">
                        Enregistrer le service
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

