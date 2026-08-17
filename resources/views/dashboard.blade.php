@extends('layouts.app')

@section('title', 'Tableau de bord')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Tableau de bord</h1>
        <p class="text-gray-500 mt-1">Bienvenue, {{ Auth::user()->name }} 👋</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        {{-- Employés --}}
        <a href="{{ route('employees.index') }}"
           class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition group">
            <div class="flex items-center space-x-4">
                <div class="bg-blue-100 text-blue-600 rounded-xl p-3 group-hover:bg-blue-600 group-hover:text-white transition">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                              d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-gray-500 font-medium">Employés</p>
                    <p class="text-2xl font-bold text-gray-900">{{ \App\Models\Employee::count() }}</p>
                </div>
            </div>
        </a>

        {{-- Services --}}
        <a href="{{ route('services.index') }}"
           class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition group">
            <div class="flex items-center space-x-4">
                <div class="bg-purple-100 text-purple-600 rounded-xl p-3 group-hover:bg-purple-600 group-hover:text-white transition">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                              d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-gray-500 font-medium">Services</p>
                    <p class="text-2xl font-bold text-gray-900">{{ \App\Models\Service::count() }}</p>
                </div>
            </div>
        </a>

        {{-- Demandes de congé --}}
        <a href="{{ route('demande-conges.index') }}"
           class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition group">
            <div class="flex items-center space-x-4">
                <div class="bg-green-100 text-green-600 rounded-xl p-3 group-hover:bg-green-600 group-hover:text-white transition">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                              d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-gray-500 font-medium">Demandes de congé</p>
                    <p class="text-2xl font-bold text-gray-900">{{ \App\Models\DemandeConge::count() }}</p>
                </div>
            </div>
        </a>
    </div>

    <div class="mt-10 flex flex-wrap gap-4">
        <a href="{{ route('employees.create') }}"
           class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-lg text-sm font-semibold transition">
            + Nouvel employé
        </a>
        <a href="{{ route('demande-conges.create') }}"
           class="inline-flex items-center gap-2 bg-green-600 hover:bg-green-700 text-white px-5 py-2.5 rounded-lg text-sm font-semibold transition">
            + Nouvelle demande de congé
        </a>
    </div>

</div>
@endsection
