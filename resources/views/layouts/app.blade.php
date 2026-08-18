<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'GestionRH') — {{ config('app.name', 'GestionRH') }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: { extend: { fontFamily: { sans: ['Inter', 'sans-serif'] } } }
        }
    </script>
</head>
<body class="bg-gray-50 text-gray-800 font-sans min-h-screen flex flex-col">

    {{-- Barre de navigation --}}
    <nav class="bg-white border-b border-gray-200">
        <div class="max-w-6xl mx-auto px-4 h-14 flex items-center justify-between">

            {{-- Logo --}}
            <a href="{{ Auth::user()->isDRH() ? route('dashboard') : route('employe.dashboard') }}"
               class="font-semibold text-gray-900 text-base">
                GestionRH
            </a>

            {{-- Liens --}}
            <div class="flex items-center gap-1 text-sm">
                @if(Auth::user()->isDRH())
                    <a href="{{ route('dashboard') }}"
                       class="px-3 py-1.5 rounded {{ request()->is('dashboard') ? 'bg-gray-100 text-gray-900 font-medium' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-50' }} transition">
                        Tableau de bord
                    </a>
                    <a href="{{ route('employees.index') }}"
                       class="px-3 py-1.5 rounded {{ request()->is('employees*') ? 'bg-gray-100 text-gray-900 font-medium' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-50' }} transition">
                        Employés
                    </a>
                    <a href="{{ route('services.index') }}"
                       class="px-3 py-1.5 rounded {{ request()->is('services*') ? 'bg-gray-100 text-gray-900 font-medium' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-50' }} transition">
                        Services
                    </a>
                    <a href="{{ route('demande-conges.index') }}"
                       class="px-3 py-1.5 rounded {{ request()->is('demande-conges*') ? 'bg-gray-100 text-gray-900 font-medium' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-50' }} transition">
                        Congés
                    </a>
                @else
                    <a href="{{ route('employe.dashboard') }}"
                       class="px-3 py-1.5 rounded {{ request()->is('mon-espace/dashboard') ? 'bg-gray-100 text-gray-900 font-medium' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-50' }} transition">
                        Mon espace
                    </a>
                    <a href="{{ route('employe.demande.create') }}"
                       class="px-3 py-1.5 rounded {{ request()->is('mon-espace/demande-conge/nouvelle') ? 'bg-gray-100 text-gray-900 font-medium' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-50' }} transition">
                        Nouvelle demande
                    </a>
                @endif
            </div>

            {{-- Profil + Déconnexion --}}
            <div class="flex items-center gap-3 text-sm">
                <span class="text-gray-500">
                    {{ Auth::user()->prenom }} {{ Auth::user()->nom }}
                    @if(Auth::user()->isDRH())
                        <span class="ml-1 text-xs font-medium text-blue-600">(DRH)</span>
                    @endif
                </span>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-gray-500 hover:text-red-600 transition">
                        Déconnexion
                    </button>
                </form>
            </div>
        </div>
    </nav>

    {{-- Messages flash --}}
    @if(session('success'))
        <div class="max-w-6xl mx-auto px-4 pt-4">
            <div class="bg-green-50 border border-green-200 text-green-800 text-sm px-4 py-3 rounded">
                {{ session('success') }}
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="max-w-6xl mx-auto px-4 pt-4">
            <div class="bg-red-50 border border-red-200 text-red-800 text-sm px-4 py-3 rounded">
                {{ session('error') }}
            </div>
        </div>
    @endif

    {{-- Contenu --}}
    <main class="flex-1">
        @yield('content')
    </main>

    {{-- Footer --}}
    <footer class="border-t border-gray-200 bg-white py-3 mt-8">
        <p class="text-center text-gray-400 text-xs">
            &copy; {{ date('Y') }} GestionRH
        </p>
    </footer>

    @stack('scripts')
</body>
</html>
