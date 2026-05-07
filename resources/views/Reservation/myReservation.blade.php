<x-layout>

    <main class="min-h-screen">
        <section class="relative h-[307px] bg-emerald-50 overflow-hidden flex items-end px-4 md:px-12 pb-12">
            <div class="absolute inset-0 z-0">
                <img alt="Stadium background" class="w-full h-full object-cover opacity-30 grayscale"
                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuD1h9YQB0X91-X1p-O7jfK65KJuFp6Hq3mySkX-Tr2lavZgbz_coZqB6D56T4n4deLXG68kUrjCw5Vtomu2adGlkC3r2QoEiwGls2nJg1FULMZtHY2gihZiaP5PfcmDiQhTq8YYhKv8xGW98QyDcStl5430wa_WIgQ49g3zyBxdW1nBbt2C8NDc_9vGkDaD1pAsseK3Tl5OzWdnaPlqkuuVeePz1sBAMUh408sw4sHKPrYrUNbVDgnOaIVsFSvkd782D7NfrKtmdyk" />


                <div class="absolute inset-0 bg-gradient-to-t from-emerald-200 via-emerald-50/60 to-transparent">
                </div>
            </div>

            <div class="relative z-10 w-full max-w-7xl mx-auto">
                <p class="font-label text-emerald-600 font-extrabold text-sm tracking-[0.2em] uppercase mb-2">
                    Espace Joueur
                </p>
                <h1 class="font-headline font-extrabold text-4xl md:text-5xl text-emerald-950 tracking-tight">
                    Mes Réservations
                </h1>
            </div>
        </section>

        <section class="max-w-7xl mx-auto px-4 md:px-12 py-16">
            <div class="flex flex-col gap-12">
                @if (session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative"
                        role="alert">
                        <span class="block sm:inline font-bold">{{ session('success') }}</span>
                    </div>
                @endif

                @if (session('error'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative"
                        role="alert">
                        <span class="block sm:inline font-bold">{{ session('error') }}</span>
                    </div>
                @endif

                <div class="flex flex-col gap-6">
                    <div class="flex items-center justify-between border-b border-outline-variant/20 pb-4">
                        <h2 class="font-headline font-bold text-2xl text-primary">Réservations à venir</h2>
                        <span
                            class="font-label text-xs font-semibold px-3 py-1 bg-primary-fixed text-on-primary-fixed rounded-full">
                            {{ $upcomingBookings->count() }} ACTIVE(S)
                        </span>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">

                        {{-- Boucle 3la les réservations jayin --}}
                        @forelse ($upcomingBookings as $booking)
                            @php
                                $statusMap = [
                                    'confirmed' => ['bg' => 'bg-emerald-500', 'text' => 'text-white'],
                                    'confirmé' => ['bg' => 'bg-emerald-500', 'text' => 'text-white'],
                                    'pending' => ['bg' => 'bg-amber-400', 'text' => 'text-amber-900'],
                                    'en attente' => ['bg' => 'bg-amber-400', 'text' => 'text-amber-900'],
                                    'cancelled' => ['bg' => 'bg-red-500', 'text' => 'text-white'],
                                    'annulé' => ['bg' => 'bg-red-500', 'text' => 'text-white'],
                                ];
                                $badge = $statusMap[strtolower($booking->status)] ?? [
                                    'bg' => 'bg-zinc-500',
                                    'text' => 'text-white',
                                ];
                            @endphp

                            <div
                                class="group relative bg-white rounded-2xl overflow-hidden border border-zinc-100 hover:-translate-y-1 hover:shadow-2xl hover:shadow-emerald-100 transition-all duration-300">

                                {{-- Top color bar --}}
                                <div class="h-1 w-full bg-gradient-to-r from-emerald-400 via-teal-400 to-emerald-600">
                                </div>

                                {{-- Image --}}
                                <div class="relative h-44 overflow-hidden">
                                    @php
                                        $rawImage = $booking->stadium->image;
                                        $cleanPath = $rawImage
                                            ? str_replace(['public/', 'storage/'], '', $rawImage)
                                            : null;
                                    @endphp

                                    <img src="{{ $cleanPath ? asset('storage/' . $cleanPath) : 'https://images.unsplash.com/photo-1574629810360-7efbbe195018?q=80&w=800' }}"
                                        alt="{{ $booking->stadium?->name ?? 'Terrain' }}"
                                        onerror="this.src='https://images.unsplash.com/photo-1574629810360-7efbbe195018?q=80&w=800'"
                                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" />
                                    <div
                                        class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/10 to-transparent">
                                    </div>

                                    {{-- Status badge --}}
                                    <span
                                        class="absolute top-3 right-3 {{ $badge['bg'] }} {{ $badge['text'] }} text-[10px] font-black tracking-widest uppercase px-3 py-1 rounded-full">
                                        {{ $booking->status }}
                                    </span>

                                    {{-- Price --}}
                                    <span
                                        class="absolute bottom-3 left-4 text-white font-black text-2xl tracking-tight drop-shadow-md">
                                        {{ number_format($booking->final_price, 0) }}
                                        <span class="text-sm font-semibold opacity-80">DH</span>
                                    </span>
                                </div>


                                <div class="p-5">


                                    <div class="mb-4">
                                        <h3 class="font-black text-base text-zinc-900 truncate leading-tight">
                                            {{ $booking->stadium->name }}
                                        </h3>
                                        <p class="flex items-center gap-1.5 text-xs text-zinc-400 mt-1">
                                            <span class="inline-block w-1.5 h-1.5 rounded-full bg-emerald-400"></span>
                                            {{ $booking->stadium->city ?? 'Ville inconnue' }}
                                        </p>
                                    </div>


                                    <div
                                        class="flex flex-col gap-2 mb-5 bg-zinc-50 rounded-xl px-4 py-3 border border-zinc-100">
                                        <div class="flex items-center gap-3">
                                            <div
                                                class="w-7 h-7 rounded-lg bg-emerald-50 flex items-center justify-center flex-shrink-0">
                                                <svg class="w-3.5 h-3.5 text-emerald-600" viewBox="0 0 16 16"
                                                    fill="none">
                                                    <rect x="2" y="3" width="12" height="11" rx="2"
                                                        stroke="currentColor" stroke-width="1.4" />
                                                    <path d="M5 1v3M11 1v3M2 7h12" stroke="currentColor"
                                                        stroke-width="1.4" stroke-linecap="round" />
                                                </svg>
                                            </div>
                                            <span class="text-xs font-semibold text-zinc-700">
                                                {{ \Carbon\Carbon::parse($booking->start_time)->translatedFormat('l d F Y') }}
                                            </span>
                                        </div>
                                        <div class="flex items-center gap-3">
                                            <div
                                                class="w-7 h-7 rounded-lg bg-emerald-50 flex items-center justify-center flex-shrink-0">
                                                <svg class="w-3.5 h-3.5 text-emerald-600" viewBox="0 0 16 16"
                                                    fill="none">
                                                    <circle cx="8" cy="8" r="6" stroke="currentColor"
                                                        stroke-width="1.4" />
                                                    <path d="M8 5v3.5l2.5 1.5" stroke="currentColor" stroke-width="1.4"
                                                        stroke-linecap="round" />
                                                </svg>
                                            </div>
                                            <span class="text-xs font-semibold text-zinc-700">
                                                {{ \Carbon\Carbon::parse($booking->start_time)->format('H:i') }}
                                                &mdash;
                                                {{ \Carbon\Carbon::parse($booking->end_time)->format('H:i') }}
                                            </span>
                                        </div>
                                    </div>


                                    <form action="{{ route('reservations.cancel', $booking->id) }}" method="POST"
                                        onsubmit="return confirm('Voulez-vous vraiment annuler ? Le montant sera remboursé dans votre Portefeuille KoraBooking.');">
                                        @csrf
                                        <button type="submit"
                                            class="relative w-full overflow-hidden flex items-center justify-between gap-3 px-4 py-3 rounded-xl border border-red-200 bg-white hover:bg-red-600 text-red-500 hover:text-white hover:border-red-600 hover:shadow-lg hover:shadow-red-100 active:scale-95 transition-all duration-200 group/btn">

                                            <div class="flex items-center gap-2.5">

                                                <span class="text-xs font-bold tracking-wide">Annuler la
                                                    réservation</span>
                                            </div>
                                            {{-- Right: arrow --}}
                                            <svg class="w-3.5 h-3.5 opacity-40 group-hover/btn:opacity-100 group-hover/btn:translate-x-0.5 transition-all duration-200"
                                                viewBox="0 0 16 16" fill="none">
                                                <path d="M3 8h10M9 4l4 4-4 4" stroke="currentColor" stroke-width="1.5"
                                                    stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                        </button>
                                    </form>

                                </div>
                            </div>

                        @empty
                            <div class="col-span-full py-16 flex flex-col items-center gap-3 text-zinc-400">
                                <div class="w-14 h-14 rounded-full bg-zinc-100 flex items-center justify-center">
                                    <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none">
                                        <rect x="3" y="4" width="18" height="17" rx="3"
                                            stroke="currentColor" stroke-width="1.5" />
                                        <path d="M8 2v4M16 2v4M3 10h18" stroke="currentColor" stroke-width="1.5"
                                            stroke-linecap="round" />
                                    </svg>
                                </div>
                                <p class="text-sm font-medium">Vous n'avez aucune réservation à venir.</p>
                            </div>
                        @endforelse

                        {{-- Add new booking --}}
                        <a href="{{ route('dashboard') ?? '#' }}"
                            class="group border-2 border-dashed border-zinc-200 hover:border-emerald-400 rounded-2xl flex flex-col items-center justify-center p-8 min-h-[300px] transition-all duration-300 hover:bg-emerald-50/40 cursor-pointer">
                            <div
                                class="w-14 h-14 rounded-2xl bg-zinc-100 group-hover:bg-emerald-100 flex items-center justify-center mb-4 transition-all duration-300 group-hover:scale-110 group-hover:rotate-3">
                                <svg class="w-6 h-6 text-zinc-400 group-hover:text-emerald-600 transition-colors duration-300"
                                    viewBox="0 0 24 24" fill="none">
                                    <path d="M12 5v14M5 12h14" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" />
                                </svg>
                            </div>
                            <h3
                                class="font-black text-sm tracking-widest uppercase text-zinc-400 group-hover:text-emerald-700 transition-colors duration-300">
                                Nouveau Match
                            </h3>
                            <p class="text-xs text-zinc-400 text-center mt-2 max-w-[130px] leading-relaxed">
                                Trouvez un terrain et réservez votre prochaine session.
                            </p>
                        </a>

                    </div>

                    <div class="flex flex-col gap-6 mt-8">
                        <div class="flex items-center justify-between border-b border-outline-variant/20 pb-4">
                            <h2 class="font-headline font-bold text-2xl text-primary">Historique</h2>
                        </div>

                        <div class="bg-surface-container-lowest rounded-xl overflow-hidden shadow-sm overflow-x-auto">
                            <table class="w-full text-left whitespace-nowrap">
                                <thead class="bg-surface-container-low border-b border-outline-variant/10">
                                    <tr>
                                        <th
                                            class="px-6 py-5 font-label text-xs tracking-widest text-on-surface-variant uppercase">
                                            Terrain</th>
                                        <th
                                            class="px-6 py-5 font-label text-xs tracking-widest text-on-surface-variant uppercase">
                                            Date & Heure</th>
                                        <th
                                            class="px-6 py-5 font-label text-xs tracking-widest text-on-surface-variant uppercase">
                                            Prix</th>
                                        <th
                                            class="px-6 py-5 font-label text-xs tracking-widest text-on-surface-variant uppercase">
                                            Statut</th>
                                        <th
                                            class="px-6 py-5 font-label text-xs tracking-widest text-on-surface-variant uppercase text-right">
                                            Reçu</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-outline-variant/5">

                                    {{-- Boucle 3la l'historique --}}
                                    @forelse ($historyBookings as $history)
                                        <tr class="hover:bg-surface transition-colors">
                                            <td class="px-6 py-6">
                                                <div class="flex items-center gap-4">
                                                    <div
                                                        class="w-10 h-10 rounded-lg {{ $history->status === 'cancelled' ? 'bg-error-container/30' : 'bg-primary-fixed-dim' }} flex items-center justify-center">
                                                        <span
                                                            class="material-symbols-outlined {{ $history->status === 'cancelled' ? 'text-error' : 'text-on-primary-fixed' }}">
                                                            {{ $history->status === 'cancelled' ? 'close' : 'sports_soccer' }}
                                                        </span>
                                                    </div>
                                                    <div>
                                                        <div class="font-bold text-primary">
                                                            {{ $history->stadium->name }}
                                                        </div>
                                                        <div class="text-xs text-on-surface-variant">Réf:
                                                            {{ $history->id }}</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-6">
                                                <div class="text-sm font-medium">
                                                    {{ \Carbon\Carbon::parse($history->start_time)->format('d/m/Y') }}
                                                </div>
                                                <div class="text-xs text-on-surface-variant">
                                                    {{ \Carbon\Carbon::parse($history->start_time)->format('H:i') }} —
                                                    {{ \Carbon\Carbon::parse($history->end_time)->format('H:i') }}
                                                </div>
                                            </td>
                                            <td class="px-6 py-6 font-headline font-bold text-primary">
                                                {{ $history->final_price }} DH</td>
                                            <td class="px-6 py-6">
                                                @if ($history->status === 'confirmed')
                                                    <span
                                                        class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-surface-container text-on-surface-variant text-[10px] font-bold tracking-wider uppercase">Terminé</span>
                                                @elseif($history->status === 'cancelled')
                                                    <span
                                                        class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-error-container/40 text-on-error-container text-[10px] font-bold tracking-wider uppercase">Annulé</span>
                                                @endif
                                            </td>
                                            <td class="px-6 py-6 text-right">
                                                @if ($history->status !== 'cancelled')
                                                    <button
                                                        class="text-on-primary-container hover:text-primary transition-colors">
                                                        <span class="material-symbols-outlined">download</span>
                                                    </button>
                                                @else
                                                    <button class="text-outline/40 cursor-not-allowed" disabled>
                                                        <span class="material-symbols-outlined">info</span>
                                                    </button>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="px-6 py-8 text-center text-on-surface-variant">
                                                Aucun historique de réservation.
                                            </td>
                                        </tr>
                                    @endforelse

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
        </section>
    </main>

</x-layout>
