<x-admin-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

        <div class="mb-8 flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h1 class="font-headline text-3xl font-extrabold text-slate-900 dark:text-white tracking-tight">
                    Tableau de Bord
                </h1>
                <p class="text-slate-500 dark:text-slate-400 mt-1 font-medium">
                    Aperçu global des statistiques de KoraBooking.
                </p>
            </div>

            <button
                class="flex items-center justify-center gap-2 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 text-slate-700 dark:text-slate-200 px-4 py-2 rounded-xl shadow-sm hover:bg-slate-50 dark:hover:bg-slate-700 transition-colors font-bold text-sm">
                <span class="material-symbols-outlined text-[20px]">download</span>
                Exporter le rapport
            </button>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">

            <div
                class="bg-white dark:bg-slate-900 rounded-2xl p-6 border border-slate-200 dark:border-slate-800 shadow-sm relative overflow-hidden group">
                <div
                    class="absolute -right-6 -top-6 w-24 h-24 bg-primary/5 rounded-full group-hover:scale-150 transition-transform duration-500">
                </div>
                <div class="flex justify-between items-start relative z-10">
                    <div>
                        <p class="text-sm font-bold text-slate-500 dark:text-slate-400 mb-1">Chiffre d'Affaires</p>
                        <h3 class="text-3xl font-black text-slate-900 dark:text-white">
                            {{ number_format($totalRevenue ?? 15400, 2) }} <span class="text-lg text-primary">DH</span>
                        </h3>
                    </div>
                    <div
                        class="w-12 h-12 rounded-full bg-green-100 dark:bg-green-900/30 text-green-600 dark:text-green-400 flex items-center justify-center">
                        <span class="material-symbols-outlined">account_balance_wallet</span>
                    </div>
                </div>
            </div>

            <div
                class="bg-white dark:bg-slate-900 rounded-2xl p-6 border border-slate-200 dark:border-slate-800 shadow-sm relative overflow-hidden group">
                <div
                    class="absolute -right-6 -top-6 w-24 h-24 bg-blue-50 dark:bg-blue-900/10 rounded-full group-hover:scale-150 transition-transform duration-500">
                </div>
                <div class="flex justify-between items-start relative z-10">
                    <div>
                        <p class="text-sm font-bold text-slate-500 dark:text-slate-400 mb-1">Utilisateurs Inscrits</p>
                        <h3 class="text-3xl font-black text-slate-900 dark:text-white">{{ $totalUsers ?? 245 }}</h3>
                    </div>
                    <div
                        class="w-12 h-12 rounded-full bg-blue-100 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 flex items-center justify-center">
                        <span class="material-symbols-outlined">group</span>
                    </div>
                </div>
            </div>

            <div
                class="bg-white dark:bg-slate-900 rounded-2xl p-6 border border-slate-200 dark:border-slate-800 shadow-sm relative overflow-hidden group">
                <div
                    class="absolute -right-6 -top-6 w-24 h-24 bg-orange-50 dark:bg-orange-900/10 rounded-full group-hover:scale-150 transition-transform duration-500">
                </div>
                <div class="flex justify-between items-start relative z-10">
                    <div>
                        <p class="text-sm font-bold text-slate-500 dark:text-slate-400 mb-1">Terrains Actifs</p>
                        <h3 class="text-3xl font-black text-slate-900 dark:text-white">{{ $totalStadiums ?? 32 }}</h3>
                    </div>
                    <div
                        class="w-12 h-12 rounded-full bg-orange-100 dark:bg-orange-900/30 text-orange-600 dark:text-orange-400 flex items-center justify-center">
                        <span class="material-symbols-outlined">stadium</span>
                    </div>
                </div>
            </div>

            <div
                class="bg-white dark:bg-slate-900 rounded-2xl p-6 border border-slate-200 dark:border-slate-800 shadow-sm relative overflow-hidden group">
                <div
                    class="absolute -right-6 -top-6 w-24 h-24 bg-purple-50 dark:bg-purple-900/10 rounded-full group-hover:scale-150 transition-transform duration-500">
                </div>
                <div class="flex justify-between items-start relative z-10">
                    <div>
                        <p class="text-sm font-bold text-slate-500 dark:text-slate-400 mb-1">Réservations Totales</p>
                        <h3 class="text-3xl font-black text-slate-900 dark:text-white">{{ $totalReservations ?? 128 }}
                        </h3>
                    </div>
                    <div
                        class="w-12 h-12 rounded-full bg-purple-100 dark:bg-purple-900/30 text-purple-600 dark:text-purple-400 flex items-center justify-center">
                        <span class="material-symbols-outlined">calendar_today</span>
                    </div>
                </div>
            </div>

        </div>

        <div
            class="bg-white dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-slate-800 shadow-sm overflow-hidden">
            <div class="px-6 py-5 border-b border-slate-200 dark:border-slate-800 flex justify-between items-center">
                <h3 class="font-bold text-lg text-slate-800 dark:text-white">Dernières Réservations</h3>
                <a href="#" class="text-sm font-bold text-primary hover:underline">Voir tout</a>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr
                            class="bg-slate-50 dark:bg-slate-800/50 text-slate-500 dark:text-slate-400 text-xs uppercase tracking-wider font-bold">
                            <th class="px-6 py-4">Client</th>
                            <th class="px-6 py-4">Terrain</th>
                            <th class="px-6 py-4">Date & Heure</th>
                            <th class="px-6 py-4">Montant</th>
                            <th class="px-6 py-4">Statut</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 dark:divide-slate-800 text-sm">
                        @forelse($recentReservations as $reservation)
                            <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/20 transition-colors">
                                <td class="px-6 py-4 font-semibold text-slate-800 dark:text-slate-200">
                                    {{ $reservation->user->name }}
                                </td>
                                <td class="px-6 py-4 text-slate-600 dark:text-slate-400">
                                    {{ $reservation->stadium->name }}
                                </td>
                                <td class="px-6 py-4 text-slate-600 dark:text-slate-400">
                                    {{ \Carbon\Carbon::parse($reservation->start_time)->format('d M, H:i') }}
                                </td>
                                <td class="px-6 py-4 font-bold text-slate-800 dark:text-slate-200">
                                    {{ number_format($reservation->total_price, 2) }} DH
                                </td>
                                <td class="px-6 py-4">
                                    @if ($reservation->status == 'confirmed')
                                        <span
                                            class="bg-green-100 text-green-700 px-2.5 py-1 rounded-full text-xs font-black uppercase">Confirmée</span>
                                    @elseif($reservation->status == 'cancelled')
                                        <span
                                            class="bg-red-100 text-red-700 px-2.5 py-1 rounded-full text-xs font-black uppercase">Annulée</span>
                                    @else
                                        <span
                                            class="bg-amber-100 text-amber-700 px-2.5 py-1 rounded-full text-xs font-black uppercase">En
                                            attente</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-8 text-center text-slate-500">
                                    Aucune réservation trouvée pour le moment.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</x-admin-layout>
