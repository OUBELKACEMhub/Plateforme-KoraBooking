<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>KoraBooking - Manager Dashboard</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link
        href="https://fonts.googleapis.com/css2?family=Manrope:wght@500;700;800&family=Inter:wght@400;500;600&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8fafc;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-family: 'Manrope', sans-serif;
        }

        ::-webkit-scrollbar {
            width: 6px;
        }

        ::-webkit-scrollbar-track {
            background: transparent;
        }

        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }
    </style>
</head>

<body class="text-slate-800 flex h-screen overflow-hidden">

    <x-manager-sidebar />

    <main class="flex-1 flex flex-col h-full overflow-hidden bg-slate-50">
        <header
            class="bg-white border-b border-slate-200/60 px-8 py-5 flex justify-between items-center shrink-0 shadow-sm z-10">
            <div>
                <h2 class="text-2xl font-extrabold text-slate-900 tracking-tight">Tableau de bord</h2>
                <p class="text-sm text-slate-500 font-medium mt-0.5">Bienvenue {{ auth()->user()->name ?? '' }}, voici
                    vos performances.</p>
            </div>
            <x-navbar-actions />
        </header>

        <div class="flex-1 overflow-y-auto p-8 space-y-8">

            @if (session('success'))
                <div id="flash-message"
                    class="bg-emerald-50 border border-emerald-200/60 text-emerald-800 px-5 py-4 rounded-2xl font-medium flex justify-between items-center shadow-sm">
                    <div class="flex items-center gap-3">
                        <span class="material-symbols-outlined text-emerald-500">check_circle</span>
                        <span>{{ session('success') }}</span>
                    </div>
                    <button onclick="document.getElementById('flash-message').style.display='none'"
                        class="text-emerald-600 hover:text-emerald-900 transition-colors">
                        <span class="material-symbols-outlined text-lg">close</span>
                    </button>
                </div>
            @endif

            <section class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div
                    class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm hover:shadow-md transition-shadow flex items-center justify-between group">
                    <div>
                        <p class="text-sm font-semibold text-slate-400 mb-1 uppercase tracking-wider">Total Revenus</p>
                        <h3 class="text-3xl font-extrabold text-slate-900">{{ number_format($totalRevenue ?? 0, 2) }}
                            <span class="text-lg text-slate-400 font-medium">DH</span></h3>
                    </div>
                    <div class="bg-blue-50/80 p-4 rounded-2xl text-blue-600 group-hover:scale-110 transition-transform">
                        <span class="material-symbols-outlined text-3xl">account_balance_wallet</span>
                    </div>
                </div>
                <div
                    class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm hover:shadow-md transition-shadow flex items-center justify-between group">
                    <div>
                        <p class="text-sm font-semibold text-slate-400 mb-1 uppercase tracking-wider">Réservations
                            (Mois)</p>
                        <h3 class="text-3xl font-extrabold text-slate-900">{{ $monthlyBookingsCount ?? 0 }}</h3>
                    </div>
                    <div
                        class="bg-emerald-50/80 p-4 rounded-2xl text-emerald-600 group-hover:scale-110 transition-transform">
                        <span class="material-symbols-outlined text-3xl">calendar_month</span>
                    </div>
                </div>
                <div
                    class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm hover:shadow-md transition-shadow flex items-center justify-between group">
                    <div>
                        <p class="text-sm font-semibold text-slate-400 mb-1 uppercase tracking-wider">Offres Actives</p>
                        <h3 class="text-3xl font-extrabold text-slate-900">{{ $activeOffersCount ?? 0 }}</h3>
                    </div>
                    <div
                        class="bg-orange-50/80 p-4 rounded-2xl text-orange-500 group-hover:scale-110 transition-transform">
                        <span class="material-symbols-outlined text-3xl">local_offer</span>
                    </div>
                </div>
            </section>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <section class="lg:col-span-2">
                    <div class="bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden h-full">
                        <div class="p-6 border-b border-slate-100/80 flex justify-between items-center bg-slate-50/50">
                            <h4 class="font-extrabold text-slate-800 text-lg flex items-center gap-2">
                                <span class="material-symbols-outlined text-emerald-500">stadium</span> Mes Terrains
                            </h4>
                            <a href="{{ route('manager.stadiums') }}"
                                class="text-emerald-600 font-semibold text-sm hover:text-emerald-700 transition-colors">Voir
                                Tout &rarr;</a>
                        </div>
                        <div class="overflow-x-auto p-2">
                            <table class="w-full text-left border-collapse">
                                <thead class="text-slate-400 text-xs uppercase tracking-widest bg-white">
                                    <tr>
                                        <th class="px-6 py-4 font-bold border-b border-slate-100">Terrain</th>
                                        <th class="px-6 py-4 font-bold border-b border-slate-100">Prix/Hr</th>
                                        <th class="px-6 py-4 font-bold border-b border-slate-100 text-right">Statut</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-50">
                                    @forelse($stadiums ?? [] as $stadium)
                                        <tr class="hover:bg-slate-50/80 transition-colors">
                                            <td class="px-6 py-4 font-bold text-slate-800">{{ $stadium->name }}</td>
                                            <td class="px-6 py-4 font-semibold text-emerald-600">{{ $stadium->price }}
                                                DH</td>
                                            <td class="px-6 py-4 text-right">
                                                <span
                                                    class="px-3 py-1 rounded-md text-[11px] font-black uppercase tracking-wider bg-emerald-50 text-emerald-600 border border-emerald-100">Actif</span>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="px-6 py-8 text-center text-slate-400 font-medium">
                                                Aucun terrain disponible.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>

                <section>
                    <div
                        class="bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden h-full flex flex-col">
                        <div class="p-6 border-b border-slate-100/80 bg-slate-50/50">
                            <h4 class="font-extrabold text-slate-800 text-lg flex items-center gap-2">
                                <span class="material-symbols-outlined text-orange-500">pending_actions</span> En
                                attente
                            </h4>
                        </div>
                        <div class="p-6 space-y-4 overflow-y-auto max-h-[400px] no-scrollbar">
                            @forelse($pendingReservations ?? [] as $reservation)
                                <div
                                    class="p-5 bg-white rounded-2xl border border-slate-100 shadow-sm hover:shadow-md transition-shadow">
                                    <div class="flex items-center space-x-4 mb-4">
                                        <div
                                            class="w-12 h-12 rounded-full bg-slate-100 flex items-center justify-center text-slate-600 font-black text-lg border border-slate-200">
                                            {{ substr($reservation->user->name ?? 'U', 0, 1) }}
                                        </div>
                                        <div>
                                            <p class="font-bold text-slate-900">
                                                {{ $reservation->user->name ?? 'Client' }}</p>
                                            <p class="text-xs font-semibold text-slate-500 mt-0.5">
                                                {{ \Carbon\Carbon::parse($reservation->start_time)->format('d M, H:i') }}
                                                - {{ \Carbon\Carbon::parse($reservation->end_time)->format('H:i') }}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="flex gap-2 w-full">
                                        <form
                                            action="{{ route('manager.reservations.updateStatus', $reservation->id) }}"
                                            method="POST" class="flex-1 m-0">
                                            @csrf @method('PATCH')
                                            <input type="hidden" name="status" value="confirmed">
                                            <button type="submit"
                                                class="w-full bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-bold py-2.5 rounded-xl transition-colors shadow-sm">
                                                Accepter
                                            </button>
                                        </form>
                                        <form
                                            action="{{ route('manager.reservations.updateStatus', $reservation->id) }}"
                                            method="POST" class="flex-1 m-0">
                                            @csrf @method('PATCH')
                                            <input type="hidden" name="status" value="canceled">
                                            <button type="submit"
                                                class="w-full bg-white hover:bg-red-50 text-slate-600 hover:text-red-600 border border-slate-200 hover:border-red-200 text-xs font-bold py-2.5 rounded-xl transition-colors">
                                                Refuser
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-10">
                                    <span class="material-symbols-outlined text-4xl text-slate-300 mb-2">done_all</span>
                                    <p class="text-sm font-medium text-slate-400">Aucune demande en attente.</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </section>
            </div>

        </div>
    </main>

    <script>
        setTimeout(() => {
            const msg = document.getElementById('flash-message');
            if (msg) {
                msg.style.opacity = '0';
                msg.style.transition = 'opacity 0.5s ease';
                setTimeout(() => msg.remove(), 500);
            }
        }, 5000);
    </script>
</body>

</html>
