<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Mes Réservations | KoraBooking</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link
        href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;700;800&family=Inter:wght@300;400;500;600&display=swap"
        rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap"
        rel="stylesheet" />

    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "on-surface": "#191c1e",
                        "tertiary-fixed-dim": "#4edea3",
                        "surface-container-high": "#e7e8ea",
                        "on-tertiary": "#ffffff",
                        "secondary-fixed-dim": "#ffb690",
                        "on-tertiary-fixed-variant": "#005236",
                        "outline-variant": "#bfc9c3",
                        "on-tertiary-fixed": "#002113",
                        "tertiary": "#003623",
                        "surface-tint": "#2b6954",
                        "secondary-container": "#fd761a",
                        "on-secondary-fixed-variant": "#783200",
                        "primary-fixed": "#b0f0d6",
                        "on-secondary-container": "#5c2400",
                        "on-primary-fixed-variant": "#0b513d",
                        "primary-container": "#064e3b",
                        "on-primary": "#ffffff",
                        "error-container": "#ffdad6",
                        "on-error": "#ffffff",
                        "surface-variant": "#e1e2e4",
                        "surface": "#f8f9fb",
                        "secondary": "#9d4300",
                        "on-background": "#191c1e",
                        "surface-container-low": "#f3f4f6",
                        "background": "#f8f9fb",
                        "tertiary-fixed": "#6ffbbe",
                        "surface-container-highest": "#e1e2e4",
                        "on-primary-container": "#80bea6",
                        "error": "#ba1a1a",
                        "primary-fixed-dim": "#95d3ba",
                        "inverse-on-surface": "#f0f1f3",
                        "inverse-primary": "#95d3ba",
                        "surface-dim": "#d9dadc",
                        "surface-container": "#edeef0",
                        "on-error-container": "#93000a",
                        "outline": "#707974",
                        "on-secondary": "#ffffff",
                        "on-surface-variant": "#404944",
                        "on-primary-fixed": "#002117",
                        "secondary-fixed": "#ffdbca",
                        "on-tertiary-container": "#31c98f",
                        "inverse-surface": "#2e3132",
                        "surface-bright": "#f8f9fb",
                        "tertiary-container": "#004f34",
                        "on-secondary-fixed": "#341100",
                        "surface-container-lowest": "#ffffff",
                        "primary": "#003527",
                        "brand-green": "#16a34a" // Zedt had loun bach ymatche m3a tsawra
                    },
                    fontFamily: {
                        "headline": ["Manrope"],
                        "body": ["Inter"],
                        "label": ["Inter"]
                    },
                    borderRadius: {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "full": "9999px"
                    },
                },
            },
        }
    </script>
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
    </style>
</head>

<body class="bg-surface font-body text-on-surface antialiased">

    <header class="bg-white border-b border-slate-200 px-4 md:px-20 py-4 shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto flex items-center justify-between">

            <a href="{{ route('dashboard') ?? '/' }}" class="flex items-center gap-2 cursor-pointer">
                <span class="material-symbols-outlined text-brand-green text-3xl">sports_soccer</span>
                <h2 class="text-xl font-extrabold tracking-tight text-slate-900 uppercase">Kora<span
                        class="text-brand-green">Booking</span></h2>
            </a>

            <nav class="hidden md:flex items-center gap-8">
                <a class="text-sm font-bold text-slate-600 hover:text-brand-green transition-colors"
                    href="{{ route('dashboard') ?? '#' }}">Trouver un terrain</a>
                <a class="text-sm font-bold text-slate-600 hover:text-brand-green transition-colors"
                    href="{{ route('reservations.index') ?? '#' }}">Mes Matchs</a>
                <a class="text-sm font-bold text-slate-600 hover:text-brand-green transition-colors"
                    href="#">Aide</a>
            </nav>

            <div class="flex items-center gap-6">
                @auth
                    <div class="flex items-center gap-3">
                        <div class="hidden sm:flex flex-col text-right">
                            <span class="text-sm font-bold text-slate-900">{{ auth()->user()->name }}</span>
                            <span
                                class="text-[10px] text-slate-500 uppercase tracking-widest font-black">{{ auth()->user()->role ?? 'CUSTOMER' }}</span>
                        </div>
                        <div
                            class="w-10 h-10 rounded-full border border-slate-200 overflow-hidden bg-slate-100 flex items-center justify-center shadow-sm">
                            @if (auth()->user()->profile_image)
                                <img alt="Profil" class="w-full h-full object-cover"
                                    src="{{ asset('storage/' . auth()->user()->profile_image) }}" />
                            @else
                                <span
                                    class="font-bold text-slate-600 uppercase">{{ substr(auth()->user()->name, 0, 1) }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="border-l border-slate-200 pl-6">
                        <form action="{{ route('logout') }}" method="POST" class="m-0">
                            @csrf
                            <button type="submit"
                                class="text-sm font-bold text-slate-600 hover:text-red-600 transition-colors">
                                Déconnexion
                            </button>
                        </form>
                    </div>
                @endauth
            </div>
        </div>
    </header>

    <main class="min-h-screen">
        <section class="relative h-[307px] bg-primary-container overflow-hidden flex items-end px-4 md:px-12 pb-12">
            <div class="absolute inset-0 z-0">
                <img alt="Stadium background" class="w-full h-full object-cover opacity-30 grayscale"
                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuD1h9YQB0X91-X1p-O7jfK65KJuFp6Hq3mySkX-Tr2lavZgbz_coZqB6D56T4n4deLXG68kUrjCw5Vtomu2adGlkC3r2QoEiwGls2nJg1FULMZtHY2gihZiaP5PfcmDiQhTq8YYhKv8xGW98QyDcStl5430wa_WIgQ49g3zyBxdW1nBbt2C8NDc_9vGkDaD1pAsseK3Tl5OzWdnaPlqkuuVeePz1sBAMUh408sw4sHKPrYrUNbVDgnOaIVsFSvkd782D7NfrKtmdyk" />
                <div class="absolute inset-0 bg-gradient-to-t from-primary-container via-transparent to-transparent">
                </div>
            </div>
            <div class="relative z-10 w-full max-w-7xl mx-auto">
                <p class="font-label text-on-primary-container text-sm tracking-[0.2em] uppercase mb-2">Espace Joueur
                </p>
                <h1 class="font-headline font-bold text-4xl md:text-5xl text-white tracking-tight">Mes Réservations</h1>
            </div>
        </section>

        <section class="max-w-7xl mx-auto px-4 md:px-12 py-16">
            <div class="flex flex-col gap-12">

                <div class="flex flex-col gap-6">
                    <div class="flex items-center justify-between border-b border-outline-variant/20 pb-4">
                        <h2 class="font-headline font-bold text-2xl text-primary">Réservations à venir</h2>
                        <span
                            class="font-label text-xs font-semibold px-3 py-1 bg-primary-fixed text-on-primary-fixed rounded-full">
                            {{ $upcomingBookings->count() }} ACTIVE(S)
                        </span>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                        {{-- Boucle 3la les réservations jayin --}}
                        @forelse ($upcomingBookings as $booking)
                            <div
                                class="bg-surface-container-lowest rounded-xl shadow-sm hover:shadow-xl transition-all duration-300 group border border-outline-variant/10 overflow-hidden">
                                <div class="h-40 overflow-hidden relative">
                                    <img alt="Terrain"
                                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                                        src="{{ $booking->stadium->image ? asset('storage/' . $booking->stadium->image) : 'https://images.unsplash.com/photo-1574629810360-7efbbe195018?q=80&w=800' }}"
                                        onerror="this.src='https://images.unsplash.com/photo-1574629810360-7efbbe195018?q=80&w=800'" />
                                    <div
                                        class="absolute top-4 right-4 bg-secondary-container text-white text-xs font-bold px-3 py-1 rounded-full shadow-lg">
                                        Confirmé</div>
                                </div>
                                <div class="p-6">
                                    <div class="flex justify-between items-start mb-4">
                                        <div>
                                            <h3 class="font-headline font-bold text-lg text-primary">
                                                {{ $booking->stadium->name }}</h3>
                                            <p
                                                class="font-label text-xs text-on-surface-variant flex items-center gap-1 mt-1">
                                                <span class="material-symbols-outlined text-sm">location_on</span>
                                                {{ $booking->stadium->city ?? 'Ville' }}
                                            </p>
                                        </div>
                                        <span
                                            class="font-headline font-extrabold text-xl text-primary">{{ $booking->final_price }}
                                            DH</span>
                                    </div>
                                    <div class="flex flex-col gap-3 mb-6 bg-surface-container-low p-4 rounded-lg">
                                        <div class="flex items-center gap-3">
                                            <span
                                                class="material-symbols-outlined text-on-primary-container">calendar_today</span>
                                            <span
                                                class="font-body text-sm font-medium">{{ \Carbon\Carbon::parse($booking->date)->translatedFormat('l d F Y') }}</span>
                                        </div>
                                        <div class="flex items-center gap-3">
                                            <span
                                                class="material-symbols-outlined text-on-primary-container">schedule</span>
                                            <span
                                                class="font-body text-sm font-medium">{{ \Carbon\Carbon::parse($booking->start_time)->format('H:i') }}
                                                — {{ \Carbon\Carbon::parse($booking->end_time)->format('H:i') }}</span>
                                        </div>
                                    </div>
                                    <a href="#"
                                        class="w-full py-3 rounded-lg font-bold text-sm bg-primary-container text-white hover:bg-primary transition-colors flex items-center justify-center gap-2">
                                        Voir le ticket <span
                                            class="material-symbols-outlined text-sm">arrow_forward</span>
                                    </a>
                                </div>
                            </div>
                        @empty
                            <div class="col-span-full py-8 text-center text-on-surface-variant">
                                Vous n'avez aucune réservation à venir.
                            </div>
                        @endforelse

                        <a href="{{ route('dashboard') ?? '#' }}"
                            class="border-2 border-dashed border-outline-variant/40 rounded-xl flex flex-col items-center justify-center p-8 hover:bg-surface-container-low transition-all cursor-pointer group min-h-[350px]">
                            <div
                                class="w-16 h-16 rounded-full bg-surface-container flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                                <span class="material-symbols-outlined text-primary-container text-3xl">add</span>
                            </div>
                            <h3 class="font-headline font-bold text-primary">Nouveau Match</h3>
                            <p class="text-sm text-on-surface-variant text-center mt-2">Trouvez un terrain et réservez
                                votre prochaine session.</p>
                        </a>
                    </div>
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
                                                    <div class="font-bold text-primary">{{ $history->stadium->name }}
                                                    </div>
                                                    <div class="text-xs text-on-surface-variant">Réf:
                                                        {{ $history->id }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-6">
                                            <div class="text-sm font-medium">
                                                {{ \Carbon\Carbon::parse($history->date)->format('d/m/Y') }}</div>
                                            <div class="text-xs text-on-surface-variant">
                                                {{ \Carbon\Carbon::parse($history->start_time)->format('H:i') }} —
                                                {{ \Carbon\Carbon::parse($history->end_time)->format('H:i') }}</div>
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

    <footer class="bg-primary-container full-width border-t border-primary-container/50">
        <div
            class="flex flex-col md:flex-row justify-between items-center px-4 md:px-12 py-8 w-full max-w-7xl mx-auto">
            <p class="font-inter text-xs tracking-[0.05em] uppercase text-white/50">© 2026 KoraBooking. Tous droits
                réservés.</p>
            <div class="flex gap-8 mt-6 md:mt-0">
                <a class="font-inter text-xs tracking-[0.05em] uppercase text-white/40 hover:text-white transition-colors"
                    href="#">Confidentialité</a>
                <a class="font-inter text-xs tracking-[0.05em] uppercase text-white/40 hover:text-white transition-colors"
                    href="#">Conditions</a>
                <a class="font-inter text-xs tracking-[0.05em] uppercase text-white/40 hover:text-white transition-colors"
                    href="#">Support</a>
            </div>
        </div>
    </footer>

</body>

</html>
