<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>KoraBooking - Mes Terrains</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet" />
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

    <x-manager-sidebar />
    <main class="flex-1 flex flex-col h-full overflow-hidden">
        <header class="bg-white border-b border-gray-200 px-8 py-4 flex justify-between items-center shrink-0">
            <div>
                <h2 class="text-2xl font-bold text-gray-800">Mes Terrains</h2>
                <p class="text-sm text-gray-500">Gérez et suivez les informations de vos terrains.</p>
            </div>
            <div class="flex items-center space-x-4">
                <a href="#"
                    class="bg-green-600 hover:bg-green-700 text-white px-5 py-2.5 rounded-xl font-semibold flex items-center space-x-2 shadow-sm transition-all">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    <span>Ajouter un terrain</span>
                </a>
            </div>
        </header>

        <div class="flex-1 overflow-y-auto p-8">

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                @forelse($stadiums as $stadium)
                    <div
                        class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden hover:shadow-md transition-shadow">
                        <div class="h-48 bg-gray-200 relative">
                            @if (isset($stadium->image))
                                <img src="{{ $stadium->image ?? 'https://images.unsplash.com/photo-1574629810360-7efbbe195018?q=80&w=800' }}"
                                    alt="{{ $stadium->name }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-gray-400 bg-gray-100">
                                    <svg class="h-12 w-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                </div>
                            @endif
                            <div class="absolute top-4 right-4">
                                <span
                                    class="px-3 py-1 bg-white/90 backdrop-blur-sm text-green-700 text-xs font-bold rounded-full shadow-sm">
                                    Actif
                                </span>
                            </div>
                        </div>

                        <div class="p-5">
                            <h3 class="text-xl font-bold text-gray-900 mb-1">{{ $stadium->name }}</h3>
                            <p class="text-green-600 font-semibold mb-4">${{ number_format($stadium->price, 2) }}
                                <span class="text-sm text-gray-500 font-normal">/ Heure</span>
                            </p>

                            <div class="flex items-center space-x-2 text-sm text-gray-500 mb-6">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                    </path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                <span>{{ $stadium->location ?? 'Emplacement non spécifié' }}</span>
                            </div>

                            <div class="flex space-x-3 pt-4 border-t border-gray-100">
                                <a href="#"
                                    class="flex-1 text-center bg-blue-50 text-blue-600 hover:bg-blue-100 py-2 rounded-lg font-medium text-sm transition-colors">
                                    Modifier
                                </a>
                                <form action="#" method="POST" class="flex-1 m-0">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce terrain ?');"
                                        class="w-full bg-red-50 text-red-600 hover:bg-red-100 py-2 rounded-lg font-medium text-sm transition-colors">
                                        Supprimer
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full bg-white p-12 rounded-2xl border border-gray-100 shadow-sm text-center">
                        <div
                            class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center text-gray-400 mx-auto mb-4">
                            <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                                </path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900 mb-2">Aucun terrain disponible</h3>
                        <p class="text-gray-500 mb-6 max-w-sm mx-auto">Vous n'avez pas encore ajouté de terrains à
                            votre arène. Commencez par créer votre premier terrain.</p>
                        <a href="#"
                            class="inline-flex items-center space-x-2 bg-green-600 hover:bg-green-700 text-white px-5 py-2.5 rounded-xl font-semibold transition-colors">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4v16m8-8H4"></path>
                            </svg>
                            <span>Ajouter un terrain</span>
                        </a>
                    </div>
                @endforelse

            </div>
        </div>
    </main>

</body>

</html>
