<x-admin-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <div class="mb-8 flex justify-between items-center">
            <div>
                <h1 class="font-headline text-3xl font-extrabold text-slate-900 dark:text-white">Toutes les Réservations
                </h1>
            </div>
        </div>

        <div
            class="bg-white dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-slate-800 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr
                            class="bg-slate-50 dark:bg-slate-800/50 text-slate-500 text-xs uppercase tracking-wider font-bold">
                            <th class="px-6 py-4">Client</th>
                            <th class="px-6 py-4">Terrain</th>
                            <th class="px-6 py-4">Date & Heure</th>
                            <th class="px-6 py-4">Montant</th>
                            <th class="px-6 py-4">Statut</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 dark:divide-slate-800 text-sm">
                        @foreach ($reservations as $reservation)
                            <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/20 transition-colors">
                                <td class="px-6 py-4 font-semibold text-slate-800 dark:text-slate-200">
                                    {{ $reservation->user->name }}</td>
                                <td class="px-6 py-4 text-slate-600 dark:text-slate-400">
                                    {{ $reservation->stadium->name }}</td>
                                <td class="px-6 py-4 text-slate-600 dark:text-slate-400">
                                    {{ \Carbon\Carbon::parse($reservation->start_time)->format('d/m/Y à H:i') }}</td>
                                <td class="px-6 py-4 font-bold text-slate-800 dark:text-slate-200">
                                    {{ number_format($reservation->final_price, 2) }} DH</td>
                                <td class="px-6 py-4">
                                    @if ($reservation->status == 'confirmed')
                                        <span
                                            class="bg-green-100 text-green-700 px-2.5 py-1 rounded-md text-xs font-black uppercase">Confirmée</span>
                                    @elseif($reservation->status == 'cancelled')
                                        <span
                                            class="bg-red-100 text-red-700 px-2.5 py-1 rounded-md text-xs font-black uppercase">Annulée</span>
                                    @else
                                        <span
                                            class="bg-amber-100 text-amber-700 px-2.5 py-1 rounded-md text-xs font-black uppercase">En
                                            attente</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="px-6 py-4 border-t border-slate-200 dark:border-slate-800">{{ $reservations->links() }}</div>
        </div>
    </div>
</x-admin-layout>
