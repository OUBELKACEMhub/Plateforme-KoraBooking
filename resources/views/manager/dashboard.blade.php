<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>KoraBooking - Manager Dashboard</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet" />
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        /* Custom scrollbar */
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
                href="{{ route('manager.offers') }}">
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
                    class="w-10 h-10 rounded-full bg-gray-200 overflow-hidden flex items-center justify-center text-green-700 font-bold">
                    @if (auth()->check() && auth()->user()->profile_image)
                        <img alt="Manager Profile" class="w-full h-full object-cover"
                            src="{{ asset('storage/' . auth()->user()->profile_image) }}" />
                    @else
                        {{ substr(auth()->user()->name ?? 'M', 0, 1) }}
                    @endif
                </div>
                <div>
                    <p class="text-sm font-semibold text-gray-800">{{ auth()->user()->name ?? 'Manager' }}</p>
                    <p class="text-xs text-gray-500 uppercase">{{ auth()->user()->role ?? 'ADMIN' }}</p>
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
                <h2 class="text-2xl font-bold text-gray-800">Dashboard Overview</h2>
                <p class="text-sm text-gray-500">Bienvenue {{ auth()->user()->name ?? '' }}, voici les performances de
                    votre arène.</p>
            </div>
            <div class="flex items-center space-x-4">
                <button id="openModal"
                    class="bg-green-600 hover:bg-green-700 text-white px-5 py-2.5 rounded-xl font-semibold flex items-center space-x-2 shadow-sm transition-all">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path d="M12 4v16m8-8H4" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                    </svg>
                    <span>Créer des Offres</span>
                </button>
            </div>
        </header>

        <div class="flex-1 overflow-y-auto p-8 space-y-8">

            @if (session('success'))
                <div id="flash-message"
                    class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl font-medium mb-6 flex justify-between items-center shadow-sm fade-in">
                    <div class="flex items-center gap-2">
                        <span class="material-symbols-outlined text-green-600">check_circle</span>
                        <span>{{ session('success') }}</span>
                    </div>
                    <button onclick="document.getElementById('flash-message').style.display='none'"
                        class="text-green-700 hover:text-green-900 transition-colors p-1">
                        <span class="material-symbols-outlined text-sm">close</span>
                    </button>
                </div>
            @endif
            @if (session('error'))
                <div id="error-message"
                    class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl font-medium mb-6 flex justify-between items-center shadow-sm fade-in">
                    <div class="flex items-center gap-2">
                        <span class="material-symbols-outlined text-red-600">cancel</span>
                        <span>{{ session('error') }}</span>
                    </div>
                    <button onclick="document.getElementById('error-message').style.display='none'"
                        class="text-red-700 hover:text-red-900 transition-colors p-1">
                        <span class="material-symbols-outlined text-sm">close</span>
                    </button>
                </div>
            @endif


            <section class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div
                    class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500 mb-1">Total Revenus</p>
                        <h3 class="text-2xl font-bold text-gray-900">${{ number_format($totalRevenue ?? 0, 2) }}
                        </h3>
                    </div>
                    <div class="bg-blue-50 p-3 rounded-xl text-blue-600">
                        <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                                stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                        </svg>
                    </div>
                </div>
                <div
                    class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500 mb-1">Réservations du Mois</p>
                        <h3 class="text-2xl font-bold text-gray-900">{{ $monthlyBookingsCount ?? 0 }}</h3>
                    </div>
                    <div class="bg-green-50 p-3 rounded-xl text-green-600">
                        <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"
                                stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                        </svg>
                    </div>
                </div>
                <div
                    class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500 mb-1">Offres Actives</p>
                        <h3 class="text-2xl font-bold text-gray-900">{{ $activeOffersCount ?? 0 }}</h3>
                    </div>
                    <div class="bg-orange-50 p-3 rounded-xl text-orange-600">
                        <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M7 7h.01M7 11h.01M7 15h.01M10 7h10M10 11h10M10 15h10M4 19h16a2 2 0 002-2V7a2 2 0 00-2-2H4a2 2 0 00-2 2v10a2 2 0 002 2z"
                                stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                        </svg>
                    </div>
                </div>
            </section>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <section class="lg:col-span-2">
                    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
                        <div class="p-6 border-b border-gray-100 flex justify-between items-center">
                            <h4 class="font-bold text-gray-800 text-lg">Gérer les terrains</h4>
                            <a href="#" class="text-green-600 font-semibold text-sm hover:underline">Voir
                                Tout</a>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="w-full text-left">
                                <thead class="bg-gray-50 text-gray-500 text-xs uppercase tracking-wider">
                                    <tr>
                                        <th class="px-6 py-4 font-semibold">Nom du terrain</th>
                                        <th class="px-6 py-4 font-semibold">Prix/Hr</th>
                                        <th class="px-6 py-4 font-semibold">Statut</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100">
                                    @forelse($stadiums ?? [] as $stadium)
                                        <tr>
                                            <td class="px-6 py-4 font-medium text-gray-900">{{ $stadium->name }}
                                            </td>
                                            <td class="px-6 py-4 text-gray-500">${{ $stadium->price }}</td>
                                            <td class="px-6 py-4">
                                                <span
                                                    class="px-2.5 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-700">Actif</span>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="px-6 py-4 text-center text-gray-500">Aucun
                                                terrain disponible.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>

                <section>
                    <div
                        class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden h-full flex flex-col">
                        <div class="p-6 border-b border-gray-100">
                            <h4 class="font-bold text-gray-800 text-lg">Demandes en attente</h4>
                        </div>
                        <div class="p-6 space-y-4 overflow-y-auto max-h-[400px]">
                            @forelse($pendingReservations ?? [] as $reservation)
                                <div class="p-4 bg-gray-50 rounded-xl border border-gray-100">
                                    <div class="flex items-center space-x-3 mb-3">
                                        <div
                                            class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 font-bold uppercase">
                                            {{ substr($reservation->user->name ?? 'U', 0, 2) }}
                                        </div>
                                        <div>
                                            <p class="text-sm font-semibold text-gray-900">
                                                {{ $reservation->user->name ?? 'Utilisateur' }}</p>
                                            <p class="text-xs text-gray-500">
                                                {{ \Carbon\Carbon::parse($reservation->start_time)->format('d M, H:i') }}
                                                -
                                                {{ \Carbon\Carbon::parse($reservation->end_time)->format('H:i') }}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="flex space-x-2 w-full">
                                        <form
                                            action="{{ route('manager.reservations.updateStatus', $reservation->id) }}"
                                            method="POST" class="flex-1 m-0">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="status" value="confirmed">
                                            <button type="submit"
                                                class="w-full bg-green-600 hover:bg-green-700 text-white text-xs font-bold py-2 rounded-lg transition-colors shadow-sm">
                                                Accepter
                                            </button>
                                        </form>

                                        <form
                                            action="{{ route('manager.reservations.updateStatus', $reservation->id) }}"
                                            method="POST" class="flex-1 m-0">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="status" value="canceled"> <button
                                                type="submit"
                                                class="w-full bg-white hover:bg-red-50 text-red-600 border border-red-200 text-xs font-bold py-2 rounded-lg transition-colors shadow-sm">
                                                Refuser
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @empty
                                <p class="text-sm text-gray-500 text-center">Aucune demande en attente.</p>
                            @endforelse
                        </div>
                    </div>
                </section>
            </div>

            <section>
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
                    <div class="p-6 border-b border-gray-100">
                        <h4 class="font-bold text-gray-800 text-lg">Réservations Approuvées</h4>
                    </div>
                    <div class="p-6">
                        <ul class="space-y-4">
                            @forelse($upcomingBookings ?? [] as $booking)
                                <li
                                    class="flex items-center justify-between p-4 bg-white border border-gray-100 rounded-xl hover:shadow-sm transition-shadow">
                                    <div class="flex items-center space-x-4">
                                        <div
                                            class="w-12 h-12 bg-green-50 rounded-xl flex items-center justify-center text-green-600">
                                            <svg class="h-6 w-6" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path
                                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"
                                                    stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                                                </path>
                                            </svg>
                                        </div>
                                        <div>
                                            <h5 class="font-bold text-gray-900">
                                                {{ $booking->user->name ?? 'Client' }}
                                            </h5>
                                            <p class="text-sm text-gray-500">
                                                {{ $booking->stadium->name ?? 'Terrain' }} •
                                                {{ \Carbon\Carbon::parse($booking->start_time)->format('H:i') }}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <span
                                            class="block font-bold text-gray-900">{{ $booking->final_price }}DH</span>
                                        <span class="inline-flex items-center text-green-600 text-xs font-medium">
                                            Confirmé
                                        </span>
                                    </div>
                                </li>
                            @empty
                                <p class="text-sm text-gray-500 text-center py-4">Aucun match prévu pour le moment.
                                </p>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </section>
        </div>
    </main>

    <div id="modalOverlay"
        class="fixed inset-0 bg-black/50 backdrop-blur-sm z-50 flex items-center justify-center hidden">
        <div id="modalContent"
            class="bg-white rounded-3xl w-full max-w-lg shadow-2xl overflow-hidden scale-95 transition-transform duration-300">
            <div class="p-8 border-b border-gray-100 flex justify-between items-center bg-gray-50">
                <h3 class="text-2xl font-bold text-gray-900">Créer une nouvelle Offre</h3>
                <button id="closeModal" class="text-gray-400 hover:text-gray-600">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path d="M6 18L18 6M6 6l12 12" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2"></path>
                    </svg>
                </button>
            </div>
            <form action="{{ route('manager.offers.store') }}" method="POST" class="p-8 space-y-6">
                @csrf

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Titre de l'offre</label>
                    <input name="title" required
                        class="w-full border-gray-200 rounded-xl focus:ring-green-500 focus:border-green-500 py-3"
                        placeholder="e.g. Promo Romdane" type="text" />
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Type d'offre</label>
                    <select name="type" required
                        class="w-full border-gray-200 rounded-xl focus:ring-green-500 focus:border-green-500 py-3">
                        <option value="promo">Promo</option>
                        <option value="flash">Vente Flash</option>
                        <option value="seasonal">Saisonnière (Seasonal)</option>
                    </select>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Remise (%)</label>
                        <input name="discount_percentage" required min="1" max="100"
                            class="w-full border-gray-200 rounded-xl focus:ring-green-500 focus:border-green-500 py-3"
                            placeholder="20" type="number" />
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Date de début</label>
                        <input name="start_date" required
                            class="w-full border-gray-200 rounded-xl focus:ring-green-500 focus:border-green-500 py-3"
                            type="date" />
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Date de fin</label>
                    <input name="end_date" required
                        class="w-full border-gray-200 rounded-xl focus:ring-green-500 focus:border-green-500 py-3"
                        type="date" />
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Terrain applicable</label>
                    <select name="stadium_id" required
                        class="w-full border-gray-200 rounded-xl focus:ring-green-500 focus:border-green-500 py-3">
                        @forelse($stadiums ?? [] as $stadium)
                            <option value="{{ $stadium->id }}">{{ $stadium->name }}</option>
                        @empty
                            <option disabled>Aucun terrain disponible</option>
                        @endforelse
                    </select>
                </div>

                <div class="pt-4 flex space-x-4">
                    <button id="cancelModal"
                        class="flex-1 px-6 py-3 border border-gray-200 text-gray-600 font-bold rounded-xl hover:bg-gray-50 transition-colors"
                        type="button">Annuler</button>
                    <button type="submit"
                        class="flex-1 px-6 py-3 bg-green-600 text-white font-bold rounded-xl hover:bg-green-700 transition-colors shadow-lg shadow-green-200">
                        Enregistrer l'offre
                    </button>
                </div>
            </form>
        </div>
    </div>
    <script>
        const openBtn = document.getElementById('openModal');
        const closeBtn = document.getElementById('closeModal');
        const cancelBtn = document.getElementById('cancelModal');
        const overlay = document.getElementById('modalOverlay');
        const content = document.getElementById('modalContent');

        const toggleModal = (show) => {
            if (show) {
                overlay.classList.remove('hidden');
                setTimeout(() => {
                    content.classList.remove('scale-95');
                    content.classList.add('scale-100');
                }, 10);
            } else {
                content.classList.remove('scale-100');
                content.classList.add('scale-95');
                setTimeout(() => {
                    overlay.classList.add('hidden');
                }, 200);
            }
        };

        openBtn.addEventListener('click', () => toggleModal(true));
        closeBtn.addEventListener('click', () => toggleModal(false));
        cancelBtn.addEventListener('click', () => toggleModal(false));

        overlay.addEventListener('click', (e) => {
            if (e.target === overlay) toggleModal(false);
        });

        setTimeout(() => {
            const msg = document.getElementById('flash-message');
            if (msg) {
                msg.style.transition = 'opacity 0.5s ease';
                msg.style.opacity = '0';
                setTimeout(() => msg.remove(), 500);
            }
        }, 5000);
    </script>
</body>

</html>
