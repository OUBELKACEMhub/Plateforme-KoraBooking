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
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,300,0,0" />
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
