<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>KoraBooking - Avis Clients</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        ::-webkit-scrollbar {
            width: 6px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        ::-webkit-scrollbar-thumb {
            background: #888;
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #555;
        }
    </style>
</head>

<body class="bg-gray-50 text-gray-900 flex h-screen overflow-hidden">

    <aside class="w-64 bg-white border-r border-gray-200 flex flex-col h-full shrink-0">
        <div class="p-6 border-b border-gray-100 flex items-center space-x-2">
            <div class="w-8 h-8 bg-green-600 rounded-lg flex items-center justify-center">
                <span class="text-white font-bold text-xl">K</span>
            </div>
            <h1 class="text-xl font-bold text-gray-800 tracking-tight">KoraBooking</h1>
        </div>

        <nav class="flex-1 p-4 space-y-1 overflow-y-auto">
            <a class="flex items-center space-x-3 bg-green-50 text-green-700 px-4 py-3 rounded-xl font-medium transition-colors"
                href="{{ route('manager.dashboard') ?? '#' }}">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path
                        d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"
                        stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                </svg>
                <span>Dashboard</span>
            </a>

            <a class="flex items-center space-x-3 text-gray-500 hover:bg-gray-50 px-4 py-3 rounded-xl font-medium transition-colors"
                href="{{ route('manager.stadiums') }}">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path
                        d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"
                        stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                </svg>
                <span>My Pitches</span>
            </a>

            <a class="flex items-center space-x-3 text-gray-500 hover:bg-gray-50 px-4 py-3 rounded-xl font-medium transition-colors"
                href="{{ route('manager.reviews') }}">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                    </path>
                </svg>
                <span>Reviews</span>
            </a>

            <a class="flex items-center space-x-3 text-gray-500 hover:bg-gray-50 px-4 py-3 rounded-xl font-medium transition-colors"
                href="#">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z">
                    </path>
                </svg>
                <span>Offres & Promotions</span>
            </a>
        </nav>

        <div class="p-4 border-t border-gray-100">
            <div class="flex items-center space-x-3 mb-4">
                <div
                    class="w-10 h-10 rounded-full bg-gray-200 overflow-hidden flex items-center justify-center text-green-700 font-bold uppercase">
                    @if (auth()->check() && auth()->user()->profile_image)
                        <img alt="Manager Profile" class="w-full h-full object-cover"
                            src="{{ asset('storage/' . auth()->user()->profile_image) }}" />
                    @else
                        {{ substr(auth()->user()->name ?? 'M', 0, 1) }}
                    @endif
                </div>
                <div>
                    <p class="text-sm font-semibold text-gray-800">{{ auth()->user()->name ?? 'Manager' }}</p>
                    <p class="text-xs text-gray-500 uppercase">{{ auth()->user()->role ?? 'MANAGER' }}</p>
                </div>
            </div>

            <form action="{{ route('logout') ?? '#' }}" method="POST" class="m-0">
                @csrf
                <button type="submit"
                    class="w-full flex items-center space-x-3 text-gray-500 hover:bg-red-50 hover:text-red-600 px-4 py-2 rounded-lg font-medium transition-colors text-sm">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                        </path>
                    </svg>
                    <span>Déconnexion</span>
                </button>
            </form>
        </div>
    </aside>

    <main class="flex-1 flex flex-col h-full overflow-hidden">
        <header class="bg-white border-b border-gray-200 px-8 py-4 flex justify-between items-center shrink-0">
            <div>
                <h2 class="text-2xl font-bold text-gray-800">Avis des Clients</h2>
                <p class="text-sm text-gray-500">Consultez les retours d'expérience sur vos terrains.</p>
            </div>

            <div class="flex items-center space-x-4 bg-gray-50 px-4 py-2 rounded-xl border border-gray-100">
                <span class="text-sm font-semibold text-gray-700">Note Moyenne:</span>
                <div class="flex items-center">
                    <span class="text-lg font-bold text-gray-900 mr-1">4.8</span>
                    <span class="material-symbols-outlined text-yellow-400"
                        style="font-variation-settings: 'FILL' 1;">star</span>
                </div>
            </div>
        </header>

        <div class="flex-1 overflow-y-auto p-8 bg-gray-50">

            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">

                @forelse($reviews as $review)
                    <div
                        class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 hover:shadow-md transition-shadow flex flex-col">
                        <div class="flex justify-between items-start mb-4">
                            <div class="flex items-center space-x-3">
                                <div
                                    class="w-10 h-10 rounded-full bg-blue-50 text-blue-600 flex items-center justify-center font-bold uppercase border border-blue-100">
                                    {{ substr($review->user->name ?? 'U', 0, 2) }}
                                </div>
                                <div>
                                    <h4 class="font-bold text-gray-900 text-sm">
                                        {{ $review->user->name ?? 'Client Anonyme' }}</h4>
                                    <p class="text-xs text-gray-400">
                                        {{ \Carbon\Carbon::parse($review->created_at)->diffForHumans() }}</p>
                                </div>
                            </div>

                            <div class="flex space-x-0.5">
                                @for ($i = 1; $i <= 5; $i++)
                                    @if ($i <= $review->rating)
                                        <span class="material-symbols-outlined text-yellow-400 text-[18px]"
                                            style="font-variation-settings: 'FILL' 1;">star</span>
                                    @else
                                        <span class="material-symbols-outlined text-gray-200 text-[18px]"
                                            style="font-variation-settings: 'FILL' 1;">star</span>
                                    @endif
                                @endfor
                            </div>
                        </div>

                        <div class="mb-4">
                            <span
                                class="inline-flex items-center gap-1 px-2.5 py-1 bg-gray-50 text-gray-600 text-[11px] font-semibold uppercase tracking-wider rounded-lg border border-gray-100">
                                <span class="material-symbols-outlined text-[14px]">sports_soccer</span>
                                {{ $review->stadium->name ?? 'Terrain inconnu' }}
                            </span>
                        </div>

                        <div class="flex-1">
                            <p class="text-sm text-gray-700 italic leading-relaxed">
                                "{{ $review->comment }}"
                            </p>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full bg-white p-12 rounded-2xl border border-gray-100 shadow-sm text-center">
                        <div
                            class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center text-gray-400 mx-auto mb-4">
                            <span class="material-symbols-outlined text-3xl">speaker_notes_off</span>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900 mb-2">Aucun avis pour le moment</h3>
                        <p class="text-gray-500 max-w-sm mx-auto">Vos clients n'ont pas encore laissé de commentaires
                            sur vos terrains.</p>
                    </div>
                @endforelse

            </div>

            @if (isset($reviews) && $reviews->hasPages())
                <div class="mt-8">
                    {{ $reviews->links() }}
                </div>
            @endif

        </div>
    </main>

</body>

</html>
