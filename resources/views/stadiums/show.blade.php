<!DOCTYPE html>
<html lang="fr" class="light">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link
        href="https://fonts.googleapis.com/css2?family=Syne:wght@400;500;600;700;800&family=DM+Sans:wght@300;400;500;600&display=swap"
        rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-25..0"
        rel="stylesheet" />

    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#ec5b13",
                        "background-light": "#f5f4f0",
                        "background-dark": "#141210",
                        "nav-dark": "#064e3b",
                        "brand-green": "#16a34a"
                    },
                    fontFamily: {
                        "display": ["Syne", "sans-serif"],
                        "body": ["DM Sans", "sans-serif"],
                    },
                    borderRadius: {
                        "xl": "0.75rem",
                        "2xl": "1rem",
                        "3xl": "1.5rem",
                    },
                },
            },
        }
    </script>

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <style>
        body {
            font-family: 'DM Sans', sans-serif;
        }

        h1,
        h2,
        h3,
        h4,
        .font-display {
            font-family: 'Syne', sans-serif;
        }

        .leaflet-container {
            z-index: 10 !important;
        }

        .icon-filled {
            font-variation-settings: 'FILL' 1;
        }

        .custom-scrollbar::-webkit-scrollbar {
            width: 4px;
        }

        .custom-scrollbar::-webkit-scrollbar-track {
            background: transparent;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #d1d5db;
            border-radius: 10px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: #9ca3af;
        }

        /* Subtle field lines pattern on hero */
        .field-pattern {
            background-image: repeating-linear-gradient(90deg,
                    rgba(255, 255, 255, 0.03) 0px,
                    rgba(255, 255, 255, 0.03) 1px,
                    transparent 1px,
                    transparent 80px),
                repeating-linear-gradient(0deg,
                    rgba(255, 255, 255, 0.03) 0px,
                    rgba(255, 255, 255, 0.03) 1px,
                    transparent 1px,
                    transparent 80px);
        }

        /* Time button active state */
        .time-btn.active {
            background-color: #064e3b;
            color: white;
            border-color: #064e3b;
        }

        /* On place les deux étapes dans la même cellule de la grille */
        #step-1,
        #step-2 {
            grid-column: 1;
            grid-row: 1;
            transition: all 0.35s cubic-bezier(.4, 0, .2, 1);
        }

        #step-2 {
            /* Plus besoin de position: absolute, top, left, etc. */
            transform: translateX(100%);
            opacity: 0;
            visibility: hidden;
        }

        #step-2.active {
            transform: translateX(0);
            opacity: 1;
            visibility: visible;
        }

        #step-1 {
            transform: translateX(0);
            opacity: 1;
            visibility: visible;
        }

        #step-1.hidden-step {
            transform: translateX(-100%);
            opacity: 0;
            visibility: hidden;
        }
    </style>

    <title>KoraBooking — {{ $stadium->name ?? 'Urban Arena 5vs5' }}</title>
</head>

<body class="bg-background-light dark:bg-background-dark text-slate-900 dark:text-slate-100 min-h-screen antialiased">

    <x-navbar />

    {{-- ── HERO SECTION ── --}}
    <div class="relative w-full h-[420px] md:h-[520px] overflow-hidden">
        <img class="absolute inset-0 w-full h-full object-cover"
            src="{{ $stadium->image ?? 'https://images.unsplash.com/photo-1556056504-5c7696c4c28d?q=80&w=1600' }}"
            alt="{{ $stadium->name ?? 'Terrain' }}" />
        {{-- Dark gradient --}}
        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/30 to-black/10 field-pattern"></div>

        {{-- Breadcrumb --}}
        <div class="absolute top-6 left-6 md:left-20 flex items-center gap-2 text-sm text-white/70">
            <a class="hover:text-white transition-colors" href="{{ route('dashboard') ?? '#' }}">Stadiums</a>
            <span class="material-symbols-outlined text-sm opacity-50">chevron_right</span>
            <span class="text-white font-medium">{{ $stadium->name ?? 'Urban Arena 5vs5' }}</span>
        </div>

        {{-- Rating badge --}}
        <div
            class="absolute top-6 right-6 md:right-20 flex items-center gap-1.5 bg-white/15 backdrop-blur-md border border-white/20 px-3 py-1.5 rounded-full">
            <span class="material-symbols-outlined text-yellow-400 text-base icon-filled">star</span>
            <span class="font-bold text-white text-sm">{{ $stadium->rate ?? 4.8 }}</span>
        </div>

        {{-- Hero content --}}
        <div class="absolute bottom-0 left-0 right-0 px-6 md:px-20 pb-10">
            <div class="max-w-7xl mx-auto">
                <div class="flex items-end justify-between flex-wrap gap-4">
                    <div>
                        <span
                            class="inline-flex items-center gap-1.5 bg-primary/90 text-white text-[10px] font-black uppercase tracking-widest px-3 py-1 rounded-full mb-3">
                            <span class="w-1.5 h-1.5 rounded-full bg-white animate-pulse"></span>
                            Terrain Vérifié
                        </span>
                        <h1 class="font-display font-extrabold text-4xl md:text-5xl text-white leading-tight">
                            {{ $stadium->name ?? 'Urban Arena 5vs5' }}
                        </h1>
                        <div class="flex items-center gap-2 text-white/70 mt-2 text-sm">
                            <span class="material-symbols-outlined text-sm">location_on</span>
                            <span>{{ $stadium->address ?? ($stadium->city ?? 'Casablanca') }}</span>
                        </div>
                    </div>
                    {{-- Price pill --}}
                    <div class="bg-white/10 backdrop-blur-md border border-white/20 rounded-2xl px-5 py-3 text-center">
                        <p class="text-white/60 text-[10px] font-bold uppercase tracking-widest mb-0.5">À partir de</p>
                        <p class="font-display font-black text-3xl text-white">{{ $stadium->price ?? 40 }}<span
                                class="text-lg font-semibold opacity-70"> DH</span></p>
                        <p class="text-white/50 text-[10px]">par heure</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ── MAIN CONTENT ── --}}
    <main class="max-w-7xl mx-auto px-4 md:px-20 py-10">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            {{-- ── LEFT COLUMN ── --}}
            <div class="lg:col-span-2 space-y-8">

                {{-- Weather + KoraBot --}}
                <div
                    class="bg-white dark:bg-slate-800/60 rounded-3xl border border-slate-100 dark:border-slate-700 p-5 flex flex-col md:flex-row gap-4 items-stretch">
                    <div
                        class="flex items-center gap-4 bg-nav-dark/5 dark:bg-slate-900 rounded-2xl px-5 py-4 min-w-[130px]">
                        <span class="material-symbols-outlined text-yellow-400 text-4xl">wb_sunny</span>
                        <div>
                            <p class="font-display font-black text-2xl">{{ $weather['main']['temp'] ?? '22' }}°C</p>
                            <p class="text-[10px] font-bold uppercase opacity-40 tracking-widest">Ensoleillé</p>
                        </div>
                    </div>
                    <div class="flex-1 bg-nav-dark/5 dark:bg-slate-900 rounded-2xl px-5 py-4 relative">
                        <div class="flex items-center gap-2 mb-2">
                            <div class="w-5 h-5 rounded-full bg-nav-dark flex items-center justify-center">
                                <span class="material-symbols-outlined text-white text-[12px]">smart_toy</span>
                            </div>
                            <span class="text-[10px] font-black uppercase text-nav-dark tracking-widest">KoraBot
                                Advisor</span>
                        </div>
                        <p class="text-sm text-slate-600 dark:text-slate-300 italic leading-relaxed">
                            "{{ $ai['message'] ?? 'Conditions parfaites pour un match ! La température est idéale et aucune pluie n\'est prévue.' }}"
                        </p>
                    </div>
                </div>

                {{-- About --}}
                <div
                    class="bg-white dark:bg-slate-800/60 rounded-3xl border border-slate-100 dark:border-slate-700 p-7">
                    <h3 class="font-display font-bold text-xl mb-4">À propos de ce terrain</h3>
                    <p class="text-sm text-slate-600 dark:text-slate-300 leading-relaxed">
                        Vivez une expérience de football de haute qualité à
                        {{ $stadium->name ?? 'Urban Arena' }}. Notre terrain
                        5vs5 est doté d'un gazon synthétique de qualité professionnelle, optimisé pour la vitesse et la
                        sécurité.
                        Situé en plein centre-ville, nous offrons un accès complet aux installations, y compris des
                        vestiaires premium et des douches à haute pression.
                    </p>
                </div>

                {{-- Amenities --}}
                <div
                    class="bg-white dark:bg-slate-800/60 rounded-3xl border border-slate-100 dark:border-slate-700 p-7">
                    <h3 class="font-display font-bold text-xl mb-5">Services & Équipements</h3>
                    <div class="flex flex-wrap gap-3">
                        @foreach ([['home', 'Indoor'], ['grass', 'Gazon Synthétique'], ['door_sliding', 'Vestiaires'], ['shower', 'Douches'], ['local_parking', 'Parking'], ['wb_incandescent', 'Éclairage']] as [$icon, $label])
                            <div
                                class="flex items-center gap-2.5 bg-slate-50 dark:bg-slate-700/50 hover:bg-primary/5 border border-slate-100 dark:border-slate-600 hover:border-primary/20 px-4 py-2.5 rounded-xl text-sm font-semibold text-slate-700 dark:text-slate-200 transition-all cursor-default">
                                <span
                                    class="material-symbols-outlined text-primary text-[18px]">{{ $icon }}</span>
                                {{ $label }}
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- Reviews --}}
                <div
                    class="bg-white dark:bg-slate-800/60 rounded-3xl border border-slate-100 dark:border-slate-700 p-7">
                    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center mb-8 gap-4">
                        <h3 class="font-display font-bold text-xl">Évaluations & Avis</h3>
                        <button id="write-review-btn" onclick="toggleReviewForm()"
                            class="inline-flex items-center gap-2 bg-primary hover:bg-orange-600 text-white px-5 py-2.5 rounded-xl text-sm font-bold transition-all active:scale-95 shadow-sm shadow-primary/20">
                            <span class="material-symbols-outlined text-sm">edit</span> Rédiger un avis
                        </button>
                    </div>

                    <div id="reviews-wrapper">
                        <div id="reviews-list-container" class="transition-opacity duration-300">
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

                                {{-- Score sidebar --}}
                                <div class="md:col-span-1 flex flex-col">
                                    <div class="flex items-baseline gap-2 mb-1">
                                        <span
                                            class="font-display font-black text-6xl text-slate-900 dark:text-white">{{ $stadium->rate ?? 4.8 }}</span>
                                        <span class="text-slate-400 text-lg">/5</span>
                                    </div>
                                    <div class="flex text-primary mb-1">
                                        @for ($i = 1; $i <= 5; $i++)
                                            <span
                                                class="material-symbols-outlined {{ $i <= round($stadium->rate) ? 'icon-filled' : '' }} text-lg">
                                                {{ $i <= round($stadium->rate) ? 'star' : 'star_outline' }}
                                            </span>
                                        @endfor
                                    </div>
                                    <div class="text-[10px] text-slate-400 font-bold uppercase tracking-widest mb-6">
                                        {{ $stadium->reviews->count() }}
                                        Évaluation{{ $stadium->reviews->count() > 1 ? 's' : '' }}
                                    </div>

                                    @php
                                        $totalReviews = $stadium->reviews->count();
                                        $percentages = [];
                                        for ($i = 5; $i >= 1; $i--) {
                                            $count = $stadium->reviews->where('rating', $i)->count();
                                            $percentages[$i] = $totalReviews > 0 ? ($count / $totalReviews) * 100 : 0;
                                        }
                                    @endphp

                                    <div class="space-y-2.5">
                                        @for ($i = 5; $i >= 1; $i--)
                                            <div class="flex items-center gap-3 text-xs text-slate-600">
                                                <span class="w-2 font-bold text-slate-400">{{ $i }}</span>
                                                <div
                                                    class="flex-1 h-1.5 bg-slate-100 dark:bg-slate-700 rounded-full overflow-hidden">
                                                    <div class="h-full bg-primary rounded-full transition-all duration-700"
                                                        style="width: {{ $percentages[$i] }}%;"></div>
                                                </div>
                                            </div>
                                        @endfor
                                    </div>
                                </div>

                                {{-- Reviews list --}}
                                <div class="md:col-span-2">
                                    <div class="space-y-5 max-h-[340px] overflow-y-auto pr-3 custom-scrollbar">
                                        @forelse ($stadium->reviews ?? [] as $review)
                                            <div
                                                class="border-b border-slate-100 dark:border-slate-700 pb-5 last:border-0 last:pb-0">
                                                <div class="flex items-center gap-3 mb-3">
                                                    @if ($review->user && $review->user->profile_image)
                                                        <img src="{{ asset('storage/' . $review->user->profile_image) }}"
                                                            alt="Profil"
                                                            class="w-10 h-10 rounded-full object-cover ring-2 ring-slate-100">
                                                    @else
                                                        <div
                                                            class="w-10 h-10 rounded-full bg-nav-dark/10 text-nav-dark font-bold flex items-center justify-center text-sm uppercase font-display">
                                                            {{ substr($review->user->name ?? 'U', 0, 2) }}
                                                        </div>
                                                    @endif
                                                    <div>
                                                        <h4
                                                            class="font-display font-bold text-sm text-slate-900 dark:text-white">
                                                            {{ $review->user->name ?? 'Utilisateur Anonyme' }}
                                                        </h4>
                                                        <div class="flex items-center gap-2">
                                                            <div class="flex text-primary text-[12px]">
                                                                @for ($i = 1; $i <= 5; $i++)
                                                                    <span
                                                                        class="material-symbols-outlined {{ $i <= $review->rating ? 'icon-filled text-primary' : 'text-slate-200' }} text-sm">star</span>
                                                                @endfor
                                                            </div>
                                                            <span
                                                                class="text-[10px] text-slate-400 font-medium">{{ $review->created_at->format('d M Y') }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <p class="text-sm text-slate-600 dark:text-slate-300 leading-relaxed">
                                                    {{ $review->comment }}</p>
                                            </div>
                                        @empty
                                            <div
                                                class="text-center py-10 bg-slate-50 dark:bg-slate-700/30 rounded-2xl border border-slate-100 dark:border-slate-700">
                                                <span
                                                    class="material-symbols-outlined text-slate-300 text-4xl mb-2 block">forum</span>
                                                <p class="text-sm text-slate-500 font-semibold">Aucun avis pour le
                                                    moment.</p>
                                                <p class="text-xs text-slate-400 mt-1">Soyez le premier à partager
                                                    votre expérience !</p>
                                            </div>
                                        @endforelse
                                    </div>
                                </div>

                            </div>
                        </div>

                        {{-- Review form --}}
                        <div id="review-form-container" class="hidden transition-opacity duration-300 mt-6">
                            <form action="{{ route('reviews.store') ?? '#' }}" method="POST"
                                class="bg-slate-50 dark:bg-slate-800/50 border border-slate-200 dark:border-slate-700 rounded-2xl p-6">
                                @csrf
                                <input type="hidden" name="stadium_id" value="{{ $stadium->id ?? 1 }}">

                                <h4 class="font-display font-bold text-lg mb-6">Partagez votre expérience</h4>

                                <div class="mb-6">
                                    <label
                                        class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-2 uppercase tracking-wider">Note
                                        globale</label>
                                    <div class="flex gap-1" id="star-rating-input">
                                        @foreach ([1, 2, 3, 4, 5] as $val)
                                            <span
                                                class="material-symbols-outlined cursor-pointer text-slate-300 hover:text-primary transition-colors text-3xl star-item"
                                                data-val="{{ $val }}">star</span>
                                        @endforeach
                                    </div>
                                    <input type="hidden" name="rating" id="form-rating-value" value="0"
                                        required>
                                </div>

                                <div class="mb-6">
                                    <label
                                        class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-2 uppercase tracking-wider">Votre
                                        commentaire</label>
                                    <textarea name="comment" rows="4" required
                                        placeholder="Comment était le terrain ? L'éclairage ? Les vestiaires ?"
                                        class="w-full bg-white dark:bg-slate-900 border-none ring-1 ring-slate-200 dark:ring-slate-700 rounded-xl focus:ring-2 focus:ring-primary p-4 text-sm outline-none resize-none"></textarea>
                                </div>

                                <div
                                    class="flex items-center justify-end gap-3 pt-4 border-t border-slate-200 dark:border-slate-700">
                                    <button type="button" onclick="toggleReviewForm()"
                                        class="px-5 py-2.5 rounded-xl text-sm font-bold text-slate-600 dark:text-slate-400 hover:bg-slate-200 dark:hover:bg-slate-700 transition-colors">
                                        Annuler
                                    </button>
                                    <button type="submit"
                                        class="bg-primary hover:bg-orange-600 text-white px-6 py-2.5 rounded-xl text-sm font-bold transition-all active:scale-95 shadow-sm flex items-center gap-2">
                                        <span class="material-symbols-outlined text-sm">send</span> Publier l'avis
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>

            {{-- ── RIGHT COLUMN — Booking Sidebar ── --}}
            <div class="lg:col-span-1">
                <div
                    class="bg-white dark:bg-slate-800 rounded-3xl shadow-xl shadow-slate-200/60 dark:shadow-slate-900/60 border border-slate-100 dark:border-slate-700 p-6 sticky top-24 overflow-hidden relative">

                    <form action="{{ route('payment.process') ?? '#' }}" method="POST" id="spa-booking-form"
                        class="grid">
                        @csrf
                        <input type="hidden" name="stadium_id" value="{{ $stadium->id ?? 1 }}">
                        <input type="hidden" name="reservation_time" id="selected-time" value="18:00">
                        <input type="hidden" name="total_amount" value="{{ $stadium->price + 3 ?? 45 }}">

                        {{-- STEP 1 — Reservation --}}
                        <div id="step-1">

                            {{-- Flash messages --}}
                            @if (session('error'))
                                <div
                                    class="mb-5 bg-red-50 border border-red-200 text-red-600 px-4 py-3 rounded-xl flex items-start gap-3 text-sm font-semibold">
                                    <span class="material-symbols-outlined icon-filled mt-0.5 text-base">error</span>
                                    {{ session('error') }}
                                </div>
                            @endif
                            @if (session('success'))
                                <div
                                    class="mb-5 bg-emerald-50 border border-emerald-200 text-emerald-700 px-4 py-3 rounded-xl flex items-start gap-3 text-sm font-semibold">
                                    <span
                                        class="material-symbols-outlined icon-filled mt-0.5 text-base">check_circle</span>
                                    {{ session('success') }}
                                </div>
                            @endif
                            @if ($errors->any())
                                <div
                                    class="mb-5 bg-orange-50 border border-orange-200 text-orange-600 px-4 py-3 rounded-xl text-sm font-semibold">
                                    <div class="flex items-center gap-2 mb-2"><span
                                            class="material-symbols-outlined icon-filled text-base">warning</span>
                                        Erreur</div>
                                    <ul class="list-disc pl-5 space-y-0.5">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <h2 class="font-display font-bold text-xl mb-6">Réserver ce terrain</h2>

                            <div class="space-y-5">

                                {{-- Date --}}
                                <div class="space-y-2">
                                    <label
                                        class="text-[10px] font-black uppercase tracking-widest text-slate-400">Date</label>
                                    <div class="relative">
                                        <span
                                            class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 pointer-events-none text-[18px]">calendar_today</span>
                                        <input name="reservation_date" id="date-picker"
                                            class="w-full pl-10 pr-4 py-3 bg-slate-50 dark:bg-slate-700 border-none ring-1 ring-slate-200 dark:ring-slate-600 rounded-xl text-sm outline-none cursor-pointer focus:ring-2 focus:ring-primary transition-all"
                                            type="date" value="{{ date('Y-m-d') }}" min="{{ date('Y-m-d') }}"
                                            required />
                                    </div>
                                </div>

                                {{-- Time slots --}}
                                <div class="space-y-3">
                                    <label
                                        class="text-[10px] font-black uppercase tracking-widest text-slate-400">Heure</label>
                                    <div class="grid grid-cols-3 gap-2">
                                        @foreach (['18:00', '19:00', '20:00', '21:00', '22:00', '23:00'] as $time)
                                            <button type="button" data-time="{{ $time }}"
                                                class="time-btn py-2.5 rounded-xl text-xs font-bold border transition-all
                                                {{ $loop->first ? 'bg-nav-dark text-white border-nav-dark active' : 'border-slate-200 dark:border-slate-600 hover:border-primary text-slate-700 dark:text-slate-200' }}
                                                {{ $loop->last ? 'opacity-40 cursor-not-allowed line-through pointer-events-none' : '' }}">
                                                {{ $time }}
                                            </button>
                                        @endforeach
                                    </div>
                                </div>

                                {{-- Price breakdown --}}
                                <div class="bg-slate-50 dark:bg-slate-700/40 rounded-2xl p-4 space-y-2.5">
                                    <div class="flex justify-between text-sm text-slate-500 dark:text-slate-400">
                                        <span>Tarif (1 heure)</span>
                                        <div class="text-right">
                                            @if ($stadium->has_active_offer)
                                                <span
                                                    class="line-through text-slate-400 text-xs mr-1">{{ $stadium->price }}
                                                    DH</span>
                                                <span
                                                    class="font-bold text-emerald-600">{{ $stadium->discounted_price }}
                                                    DH</span>
                                            @else
                                                <span
                                                    class="font-semibold text-slate-800 dark:text-slate-200">{{ $stadium->price ?? 40 }}
                                                    DH</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="flex justify-between text-sm text-slate-500 dark:text-slate-400">
                                        <span>Frais de service</span>
                                        <span class="font-semibold text-slate-800 dark:text-slate-200">3 DH</span>
                                    </div>
                                    <div
                                        class="pt-2.5 mt-1 border-t border-slate-200 dark:border-slate-600 flex justify-between items-center">
                                        <span class="font-display font-bold text-sm">Total</span>
                                        <span class="font-display font-black text-2xl text-primary">
                                            {{ $total ?? ($stadium->discounted_price ?? ($stadium->price ?? 43)) + 3 }}
                                            <span class="text-sm font-semibold opacity-70">DH</span>
                                        </span>
                                    </div>
                                </div>

                                {{-- CTA button --}}
                                <button type="button" onclick="goToPayment()"
                                    class="w-full group relative overflow-hidden bg-nav-dark hover:bg-primary text-white py-4 rounded-2xl font-display font-bold text-sm tracking-wide flex items-center justify-center gap-2.5 transition-all duration-300 active:scale-[0.98] shadow-lg shadow-nav-dark/20">
                                    <span class="material-symbols-outlined text-[20px]">credit_card</span>
                                    Réserver & Payer
                                    <svg class="w-4 h-4 opacity-60 group-hover:translate-x-1 transition-transform"
                                        viewBox="0 0 16 16" fill="none">
                                        <path d="M3 8h10M9 4l4 4-4 4" stroke="currentColor" stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </button>

                                <p class="text-[9px] text-center text-slate-400 font-bold uppercase tracking-widest">
                                    Annulation gratuite jusqu'à 24h avant
                                </p>
                            </div>
                        </div>

                        {{-- STEP 2 — Payment --}}
                        <div id="step-2">

                            <div class="flex items-center gap-3 mb-6">
                                <button type="button" onclick="goBackToReservation()"
                                    class="w-8 h-8 rounded-xl bg-slate-100 dark:bg-slate-700 hover:bg-slate-200 dark:hover:bg-slate-600 flex items-center justify-center transition-colors">
                                    <span class="material-symbols-outlined text-[18px]">arrow_back</span>
                                </button>
                                <h2 class="font-display font-bold text-xl">Paiement</h2>
                            </div>

                            {{-- Summary pill --}}
                            <div
                                class="bg-primary/8 border border-primary/15 rounded-2xl p-4 flex justify-between items-center mb-6">
                                <div>
                                    <p class="text-[10px] text-slate-500 font-bold uppercase tracking-widest">Total à
                                        payer</p>
                                    <p class="text-sm font-semibold text-slate-700 dark:text-slate-300 mt-0.5"
                                        id="summary-time">Aujourd'hui à 18:00</p>
                                </div>
                                <span class="font-display font-black text-2xl text-primary">
                                    {{ $total ?? ($stadium->discounted_price ?? ($stadium->price ?? 43)) + 3 }} DH
                                </span>
                            </div>

                            {{-- Payment method --}}
                            <div class="mb-5">
                                <label
                                    class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-3">Méthode
                                    de paiement</label>
                                <div class="grid grid-cols-2 gap-3">

                                    <label class="cursor-pointer relative">
                                        <input type="radio" name="payment_method" value="card"
                                            class="peer sr-only" checked onchange="togglePaymentMethod()">
                                        <div
                                            class="rounded-2xl border-2 border-slate-200 dark:border-slate-600 peer-checked:border-primary peer-checked:bg-primary/5 p-4 flex flex-col items-center gap-1.5 transition-all hover:border-slate-300">
                                            <span
                                                class="material-symbols-outlined text-slate-400 peer-checked:text-primary text-3xl transition-colors">credit_card</span>
                                            <span
                                                class="text-xs font-bold text-slate-600 dark:text-slate-300 peer-checked:text-primary transition-colors">Carte
                                                Bancaire</span>
                                        </div>
                                    </label>

                                    <label class="cursor-pointer relative">
                                        <input type="radio" name="payment_method" value="wallet"
                                            class="peer sr-only" onchange="togglePaymentMethod()">
                                        <div
                                            class="rounded-2xl border-2 border-slate-200 dark:border-slate-600 peer-checked:border-primary peer-checked:bg-primary/5 p-4 flex flex-col items-center gap-1.5 transition-all hover:border-slate-300">
                                            <span
                                                class="material-symbols-outlined text-slate-400 peer-checked:text-primary text-3xl transition-colors">account_balance_wallet</span>
                                            <span
                                                class="text-xs font-bold text-slate-600 dark:text-slate-300 peer-checked:text-primary transition-colors">Portefeuille</span>
                                            <span
                                                class="text-[9px] font-bold text-slate-400 bg-slate-100 dark:bg-slate-700 px-2 py-0.5 rounded-full">
                                                {{ auth()->user()->wallet_balance ?? 0 }} DH
                                            </span>
                                        </div>
                                    </label>

                                </div>
                            </div>

                            {{-- Card details --}}
                            <div id="card-details" class="space-y-4 mb-5">
                                <div>
                                    <label
                                        class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-1.5">Nom
                                        sur la carte</label>
                                    <input type="text" name="cardholder_name" required
                                        class="w-full bg-slate-50 dark:bg-slate-700 border-none ring-1 ring-slate-200 dark:ring-slate-600 rounded-xl focus:ring-2 focus:ring-primary py-3 px-4 text-sm outline-none payment-input transition-all"
                                        placeholder="Ahmed Oubelkacem">
                                </div>
                                <div>
                                    <label
                                        class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-1.5">Numéro
                                        de carte</label>
                                    <div class="relative">
                                        <span
                                            class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-[18px]">credit_card</span>
                                        <input type="text" required placeholder="XXXX XXXX XXXX XXXX"
                                            class="w-full pl-10 pr-4 bg-slate-50 dark:bg-slate-700 border-none ring-1 ring-slate-200 dark:ring-slate-600 rounded-xl focus:ring-2 focus:ring-primary py-3 text-sm outline-none payment-input transition-all">
                                    </div>
                                </div>
                                <div class="grid grid-cols-2 gap-3">
                                    <div>
                                        <label
                                            class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-1.5">Expiration</label>
                                        <input type="text" required placeholder="MM / YY"
                                            class="w-full bg-slate-50 dark:bg-slate-700 border-none ring-1 ring-slate-200 dark:ring-slate-600 rounded-xl focus:ring-2 focus:ring-primary py-3 text-sm outline-none text-center payment-input transition-all">
                                    </div>
                                    <div>
                                        <label
                                            class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-1.5">CVV</label>
                                        <input type="text" required placeholder="123"
                                            class="w-full bg-slate-50 dark:bg-slate-700 border-none ring-1 ring-slate-200 dark:ring-slate-600 rounded-xl focus:ring-2 focus:ring-primary py-3 text-sm outline-none text-center payment-input transition-all">
                                    </div>
                                </div>
                            </div>

                            {{-- Wallet details --}}
                            <div id="wallet-details"
                                class="hidden bg-slate-50 dark:bg-slate-700/30 border border-slate-200 dark:border-slate-600 rounded-2xl p-5 text-center space-y-2 mb-5">
                                <span class="material-symbols-outlined text-nav-dark text-4xl block">payments</span>
                                <p class="text-sm text-slate-600 dark:text-slate-300 font-medium leading-relaxed">
                                    Le montant sera déduit directement de votre portefeuille KoraBooking.
                                </p>
                            </div>

                            {{-- Pay button --}}
                            <button type="submit" id="submit-btn"
                                class="w-full group relative overflow-hidden bg-nav-dark hover:bg-primary text-white py-4 rounded-2xl font-display font-bold text-sm tracking-wide flex items-center justify-center gap-2.5 transition-all duration-300 active:scale-[0.98] shadow-lg shadow-nav-dark/20">
                                <span class="material-symbols-outlined text-[20px]" id="submit-icon">lock</span>
                                <span id="submit-text">PAYER SÉCURISÉ</span>
                            </button>

                        </div>
                    </form>

                    {{-- Map --}}
                    <div
                        class="mt-6 rounded-2xl overflow-hidden border border-slate-100 dark:border-slate-700 h-48 relative shadow-inner">
                        <div id="map-small" class="w-full h-full bg-slate-100 dark:bg-slate-700"></div>
                    </div>

                </div>
            </div>

        </div>
    </main>

    <x-footer />

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            // ── Time slot selection ──
            const timeButtons = document.querySelectorAll('.time-btn:not(.pointer-events-none)');
            const selectedTimeInput = document.getElementById('selected-time');
            const summaryTime = document.getElementById('summary-time');

            timeButtons.forEach(btn => {
                btn.addEventListener('click', function() {
                    timeButtons.forEach(b => {
                        b.classList.remove('bg-nav-dark', 'text-white', 'border-nav-dark',
                            'active');
                        b.classList.add('border-slate-200', 'hover:border-primary',
                            'text-slate-700');
                    });
                    this.classList.remove('border-slate-200', 'hover:border-primary',
                        'text-slate-700');
                    this.classList.add('bg-nav-dark', 'text-white', 'border-nav-dark', 'active');
                    selectedTimeInput.value = this.getAttribute('data-time');
                    summaryTime.innerText = `Aujourd'hui à ${this.getAttribute('data-time')}`;
                });
            });

            // ── Leaflet map ──
            const stadium = @json($stadium ?? null);
            const lat = (stadium && stadium.latitude) ? stadium.latitude : 32.2995;
            const lng = (stadium && stadium.longitude) ? stadium.longitude : -9.2372;
            const stadiumName = (stadium && stadium.name) ? stadium.name : 'Urban Arena';

            const map = L.map('map-small').setView([lat, lng], 14);
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; OpenStreetMap'
            }).addTo(map);

            const koraIcon = L.divIcon({
                className: 'custom-leaflet-icon',
                html: `<div style="background:#ec5b13;color:white;border-radius:50%;width:36px;height:36px;display:flex;align-items:center;justify-content:center;border:3px solid white;box-shadow:0 4px 12px rgba(0,0,0,0.3);">
                           <span class="material-symbols-outlined" style="font-size:18px;">sports_soccer</span>
                       </div>`,
                iconSize: [36, 36],
                iconAnchor: [18, 18],
                popupAnchor: [0, -20]
            });
            L.marker([lat, lng], {
                    icon: koraIcon
                })
                .addTo(map)
                .bindPopup(`<b>${stadiumName}</b><br><span style="color:#ec5b13;">Ici le match !</span>`)
                .openPopup();
        });

        // ── Step animations ──
        function goToPayment() {
            document.getElementById('step-1').classList.add('hidden-step');
            document.getElementById('step-2').classList.add('active');
        }

        function goBackToReservation() {
            document.getElementById('step-2').classList.remove('active');
            document.getElementById('step-1').classList.remove('hidden-step');
        }

        // ── Review form toggle ──
        function toggleReviewForm() {
            const list = document.getElementById('reviews-list-container');
            const form = document.getElementById('review-form-container');
            const btn = document.getElementById('write-review-btn');
            if (form.classList.contains('hidden')) {
                list.classList.add('hidden');
                form.classList.remove('hidden');
                btn.classList.add('hidden');
            } else {
                form.classList.add('hidden');
                list.classList.remove('hidden');
                btn.classList.remove('hidden');
            }
        }

        // ── Star rating ──
        const starItems = document.querySelectorAll('.star-item');
        const ratingValueInput = document.getElementById('form-rating-value');
        let currentRating = 0;

        starItems.forEach(star => {
            star.addEventListener('mouseover', () => highlightStars(parseInt(star.getAttribute('data-val'))));
            star.addEventListener('mouseout', () => highlightStars(currentRating));
            star.addEventListener('click', () => {
                currentRating = parseInt(star.getAttribute('data-val'));
                ratingValueInput.value = currentRating;
                highlightStars(currentRating);
            });
        });

        function highlightStars(val) {
            starItems.forEach(star => {
                const sv = parseInt(star.getAttribute('data-val'));
                star.classList.toggle('text-primary', sv <= val);
                star.classList.toggle('icon-filled', sv <= val);
                star.classList.toggle('text-slate-300', sv > val);
            });
        }

        // ── Payment method toggle ──
        function togglePaymentMethod() {
            const method = document.querySelector('input[name="payment_method"]:checked').value;
            const cardDetails = document.getElementById('card-details');
            const walletDetails = document.getElementById('wallet-details');
            const submitText = document.getElementById('submit-text');
            const submitIcon = document.getElementById('submit-icon');
            const cardInputs = document.querySelectorAll('.payment-input');

            if (method === 'wallet') {
                cardDetails.classList.add('hidden');
                walletDetails.classList.remove('hidden');
                cardInputs.forEach(i => i.disabled = true);
                submitText.innerText = 'PAYER VIA WALLET';
                submitIcon.innerText = 'account_balance_wallet';
            } else {
                cardDetails.classList.remove('hidden');
                walletDetails.classList.add('hidden');
                cardInputs.forEach(i => i.disabled = false);
                submitText.innerText = 'PAYER SÉCURISÉ';
                submitIcon.innerText = 'lock';
            }
        }
    </script>
</body>

</html>
