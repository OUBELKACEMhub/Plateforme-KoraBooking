<!DOCTYPE html>
<html lang="fr" class="light">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700&display=swap"
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
                        "background-light": "#f8f6f6",
                        "background-dark": "#221610",
                        "nav-dark": "#064e3b",
                        "brand-green": "#16a34a"
                    },
                    fontFamily: {
                        "display": ["Public Sans"]
                    },
                    borderRadius: {
                        "xl": "0.75rem",
                        "2xl": "1rem"
                    },
                },
            },
        }
    </script>

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <style>
        .leaflet-container {
            z-index: 10 !important;
        }

        /* Classe pour forcer le remplissage des icônes Material (étoiles) */
        .icon-filled {
            font-variation-settings: 'FILL' 1;
        }

        /* Design zwine l-Scrollbar dyal les avis */
        .custom-scrollbar::-webkit-scrollbar {
            width: 6px;
        }

        .custom-scrollbar::-webkit-scrollbar-track {
            background: #f8f6f6;
            border-radius: 10px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 10px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }
    </style>

    <title>KoraBooking - {{ $stadium->name ?? 'Urban Arena 5vs5' }}</title>
</head>

<body class="bg-background-light dark:bg-background-dark font-display text-slate-900 dark:text-slate-100 min-h-screen">

    <x-navbar />

    <main class="max-w-7xl mx-auto px-4 md:px-20 py-8">
        <nav class="flex items-center gap-2 text-sm mb-6 text-slate-500">
            <a class="hover:text-primary transition-colors" href="{{ route('dashboard') ?? '#' }}">Stadiums</a>
            <span class="material-symbols-outlined text-sm">chevron_right</span>
            <span class="text-slate-900 font-medium">{{ $stadium->name ?? 'Urban Arena 5vs5' }}</span>
        </nav>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            <div class="lg:col-span-2 space-y-6">
                <div class="bg-white dark:bg-slate-800 rounded-2xl overflow-hidden shadow-sm border border-slate-200">
                    <div class="aspect-video w-full relative">
                        <img class="w-full h-full object-cover"
                            src="{{ $stadium->image ?? 'https://images.unsplash.com/photo-1556056504-5c7696c4c28d' }}"
                            alt="Pitch" />
                        <div
                            class="absolute top-4 right-4 bg-white/90 backdrop-blur px-3 py-1.5 rounded-lg flex items-center gap-1.5 shadow-sm">
                            <span class="material-symbols-outlined text-yellow-500 text-lg icon-filled">star</span>
                            <span class="font-bold text-sm">{{ $stadium->rate ?? 4.8 }}</span>
                        </div>
                    </div>

                    <div class="p-6">
                        <div class="flex justify-between items-start mb-6">
                            <div>
                                <h1 class="text-3xl font-bold mb-1">
                                    {{ $stadium->name ?? 'Urban Arena 5vs5' }}</h1>
                                <div class="flex items-center gap-1 text-slate-500">
                                    <span class="material-symbols-outlined text-sm">location_on</span>
                                    <span
                                        class="text-sm">{{ $stadium->address ?? ($stadium->city ?? 'Casablanca') }}</span>
                                </div>
                            </div>
                            <div
                                class="bg-primary/10 text-primary px-3 py-1 rounded-full text-[10px] font-black uppercase">
                                Verified Venue
                            </div>
                        </div>

                        <div
                            class="bg-nav-dark/5 dark:bg-slate-900 p-4 rounded-2xl border border-nav-dark/10 flex flex-col md:flex-row gap-4 items-center">
                            <div
                                class="flex items-center gap-3 bg-white dark:bg-slate-800 p-3 rounded-xl shadow-sm min-w-[120px]">
                                <span class="material-symbols-outlined text-yellow-500 text-3xl">wb_sunny</span>
                                <div>
                                    <p class="text-xl font-black">
                                        {{ $weather['main']['temp'] ?? '22' }}°C</p>
                                    <p class="text-[10px] font-bold uppercase opacity-50">Sunny</p>
                                </div>
                            </div>
                            <div
                                class="flex-1 relative bg-white dark:bg-slate-800 py-3 px-4 rounded-2xl shadow-sm border border-slate-100">
                                <div class="flex items-center gap-2 mb-1">
                                    <span class="material-symbols-outlined text-nav-dark text-sm">smart_toy</span>
                                    <span class="text-[10px] font-black uppercase text-nav-dark">KoraBot Advisor</span>
                                </div>
                                <p class="text-sm italic text-slate-600">
                                    "{{ $ai['message'] ?? 'Conditions parfaites pour un match ! La température est idéale et aucune pluie n\'est prévue.' }}"
                                </p>
                            </div>
                        </div>

                        <div class="mt-8">
                            <h3 class="text-lg font-bold mb-4">Services & Équipements</h3>
                            <div class="flex flex-wrap gap-3">
                                <span
                                    class="flex items-center gap-2 bg-slate-100 px-4 py-2 rounded-full text-xs font-bold text-slate-700">
                                    <span class="material-symbols-outlined text-primary text-lg">home</span> Indoor
                                </span>
                                <span
                                    class="flex items-center gap-2 bg-slate-100 px-4 py-2 rounded-full text-xs font-bold text-slate-700">
                                    <span class="material-symbols-outlined text-primary text-lg">grass</span> Gazon
                                    Synthétique
                                </span>
                                <span
                                    class="flex items-center gap-2 bg-slate-100 px-4 py-2 rounded-full text-xs font-bold text-slate-700">
                                    <span class="material-symbols-outlined text-primary text-lg">door_sliding</span>
                                    Vestiaires
                                </span>
                                <span
                                    class="flex items-center gap-2 bg-slate-100 px-4 py-2 rounded-full text-xs font-bold text-slate-700">
                                    <span class="material-symbols-outlined text-primary text-lg">shower</span> Douches
                                </span>
                            </div>
                        </div>

                        <div class="mt-8 pt-8 border-t border-slate-100">
                            <h3 class="text-lg font-bold mb-4">À propos de ce terrain</h3>
                            <p class="text-sm text-slate-600 leading-relaxed">
                                Vivez une expérience de football de haute qualité à
                                {{ $stadium->name ?? 'Urban Arena' }}. Notre terrain
                                5vs5 est doté d'un gazon
                                synthétique de qualité professionnelle, optimisé pour la
                                vitesse et la sécurité. Situé
                                en plein centre-ville, nous offrons un accès complet aux
                                installations, y compris des
                                vestiaires premium et des douches à haute pression.
                            </p>
                        </div>

                        <div class="mt-8 pt-8 border-t border-slate-100">
                            <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center mb-8 gap-4">
                                <h3 class="text-xl font-bold">Évaluations & Avis</h3>
                                <button id="write-review-btn" onclick="toggleReviewForm()"
                                    class="bg-primary hover:bg-orange-600 text-white px-5 py-2.5 rounded-lg text-sm font-bold flex items-center justify-center gap-2 transition-colors shadow-sm">
                                    <span class="material-symbols-outlined text-sm">edit</span> Rédiger un avis
                                </button>
                            </div>

                            <div id="reviews-wrapper">

                                <div id="reviews-list-container" class="transition-opacity duration-300">
                                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

                                        <div class="md:col-span-1 flex flex-col">
                                            <div class="flex items-baseline gap-2 mb-1">
                                                <span
                                                    class="text-5xl font-black text-slate-900">{{ $stadium->rate ?? 4.8 }}</span>
                                            </div>
                                            <div class="flex text-primary mb-1">
                                                <div class="flex text-primary">
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        <span
                                                            class="material-symbols-outlined {{ $i <= round($stadium->rate) ? 'icon-filled' : '' }} text-lg">
                                                            {{ $i <= round($stadium->rate) ? 'star' : 'star_outline' }}
                                                        </span>
                                                    @endfor
                                                </div>
                                            </div>
                                            <div
                                                class="text-[10px] text-slate-400 font-bold uppercase tracking-widest mb-6">
                                                {{ $stadium->reviews->count() }}
                                                Évaluation{{ $stadium->reviews->count() > 1 ? 's' : '' }}
                                            </div>

                                            @php
                                                $totalReviews = $stadium->reviews->count();
                                                $percentages = [];
                                                for ($i = 5; $i >= 1; $i--) {
                                                    $count = $stadium->reviews->where('rating', $i)->count();
                                                    $percentages[$i] =
                                                        $totalReviews > 0 ? ($count / $totalReviews) * 100 : 0;
                                                }
                                            @endphp

                                            <div class="space-y-2">
                                                @for ($i = 5; $i >= 1; $i--)
                                                    <div class="flex items-center gap-3 text-xs text-slate-600">
                                                        <span
                                                            class="w-2 font-bold text-slate-400">{{ $i }}</span>
                                                        <div
                                                            class="flex-1 h-1.5 bg-slate-100 rounded-full overflow-hidden">
                                                            <div class="h-full bg-primary rounded-full transition-all duration-500"
                                                                style="width: {{ $percentages[$i] }}%;"></div>
                                                        </div>
                                                    </div>
                                                @endfor
                                            </div>
                                        </div>

                                        <div class="md:col-span-2">
                                            <div class="space-y-6 max-h-[320px] overflow-y-auto pr-4 custom-scrollbar">
                                                @forelse ($stadium->reviews ?? [] as $review)
                                                    <div class="border-b border-slate-100 pb-6 last:border-0 last:pb-0">
                                                        <div class="flex items-center gap-3 mb-3">

                                                            @if ($review->user && $review->user->profile_image)
                                                                <img src="{{ asset('storage/' . $review->user->profile_image) }}"
                                                                    alt="Profil"
                                                                    class="w-10 h-10 rounded-full object-cover border border-slate-200">
                                                            @else
                                                                <div
                                                                    class="w-10 h-10 rounded-full bg-nav-dark/10 text-nav-dark font-bold flex items-center justify-center text-sm uppercase">
                                                                    {{ substr($review->user->name ?? 'U', 0, 2) }}
                                                                </div>
                                                            @endif

                                                            <div>
                                                                <h4 class="font-bold text-sm text-slate-900">
                                                                    {{ $review->user->name ?? 'Utilisateur Anonyme' }}
                                                                </h4>
                                                                <div class="flex items-center gap-2">
                                                                    <div class="flex text-primary text-[12px]">
                                                                        @for ($i = 1; $i <= 5; $i++)
                                                                            <span
                                                                                class="material-symbols-outlined {{ $i <= $review->rating ? 'icon-filled text-primary' : 'text-slate-300' }} text-sm">
                                                                                star
                                                                            </span>
                                                                        @endfor
                                                                    </div>
                                                                    <span
                                                                        class="text-[10px] text-slate-400 font-medium">{{ $review->created_at->format('d M Y') }}</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <p class="text-sm text-slate-600 leading-relaxed">
                                                            {{ $review->comment }}
                                                        </p>
                                                    </div>
                                                @empty
                                                    <div
                                                        class="text-center py-8 bg-slate-50 rounded-xl border border-slate-100 mt-4">
                                                        <span
                                                            class="material-symbols-outlined text-slate-300 text-4xl mb-2">forum</span>
                                                        <p class="text-sm text-slate-500 font-medium">Aucun avis pour
                                                            le
                                                            moment.
                                                        </p>
                                                        <p class="text-xs text-slate-400 mt-1">Soyez le premier à
                                                            partager
                                                            votre expérience !</p>
                                                    </div>
                                                @endforelse
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div id="review-form-container" class="hidden transition-opacity duration-300 mt-6">
                                    <form action="{{ route('reviews.store') ?? '#' }}" method="POST"
                                        class="bg-slate-50 dark:bg-slate-800/50 border border-slate-200 dark:border-slate-700 rounded-2xl p-6">
                                        @csrf
                                        <input type="hidden" name="stadium_id" value="{{ $stadium->id ?? 1 }}">

                                        <h4 class="font-bold text-lg mb-6">
                                            Partagez votre expérience</h4>

                                        <div class="mb-6">
                                            <label
                                                class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">Note
                                                globale</label>
                                            <div class="flex gap-1" id="star-rating-input">
                                                <span
                                                    class="material-symbols-outlined cursor-pointer text-slate-300 hover:text-primary transition-colors text-3xl star-item"
                                                    data-val="1">star</span>
                                                <span
                                                    class="material-symbols-outlined cursor-pointer text-slate-300 hover:text-primary transition-colors text-3xl star-item"
                                                    data-val="2">star</span>
                                                <span
                                                    class="material-symbols-outlined cursor-pointer text-slate-300 hover:text-primary transition-colors text-3xl star-item"
                                                    data-val="3">star</span>
                                                <span
                                                    class="material-symbols-outlined cursor-pointer text-slate-300 hover:text-primary transition-colors text-3xl star-item"
                                                    data-val="4">star</span>
                                                <span
                                                    class="material-symbols-outlined cursor-pointer text-slate-300 hover:text-primary transition-colors text-3xl star-item"
                                                    data-val="5">star</span>
                                            </div>
                                            <input type="hidden" name="rating" id="form-rating-value"
                                                value="0" required>
                                        </div>

                                        <div class="mb-6">
                                            <label
                                                class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">Votre
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
                                                class="bg-primary hover:bg-orange-600 text-white px-6 py-2.5 rounded-xl text-sm font-bold shadow-sm transition-colors flex items-center gap-2">
                                                <span class="material-symbols-outlined text-sm">send</span> Publier
                                                l'avis
                                            </button>
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-1">
                <div
                    class="bg-white dark:bg-slate-800 rounded-2xl shadow-xl border border-slate-200 p-6 sticky top-24 overflow-hidden relative">

                    <form action="{{ route('payment.process') ?? '#' }}" method="POST" id="spa-booking-form">
                        @csrf
                        <input type="hidden" name="stadium_id" value="{{ $stadium->id ?? 1 }}">
                        <input type="hidden" name="reservation_time" id="selected-time" value="18:00">
                        <input type="hidden" name="total_amount" value="{{ $stadium->price + 3 ?? 45 }}">

                        <div id="step-1" class="transition-all duration-300 transform translate-x-0 opacity-100">
                            @if (session('error'))
                                <div
                                    class="mb-6 bg-red-50 border border-red-200 text-red-600 px-4 py-3 rounded-xl flex items-start gap-3 shadow-sm animate-pulse">
                                    <span class="material-symbols-outlined icon-filled mt-0.5">error</span>
                                    <p class="text-sm font-bold">{{ session('error') }}</p>
                                </div>
                            @endif

                            @if (session('success'))
                                <div
                                    class="mb-6 bg-brand-green/10 border border-brand-green/20 text-brand-green px-4 py-3 rounded-xl flex items-start gap-3 shadow-sm">
                                    <span class="material-symbols-outlined icon-filled mt-0.5">check_circle</span>
                                    <p class="text-sm font-bold">{{ session('success') }}</p>
                                </div>
                            @endif

                            @if ($errors->any())
                                <div
                                    class="mb-6 bg-orange-50 border border-orange-200 text-orange-600 px-4 py-3 rounded-xl flex items-start gap-3 shadow-sm">
                                    <span class="material-symbols-outlined icon-filled mt-0.5">warning</span>
                                    <ul class="text-sm font-bold list-disc pl-4">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <h2 class="text-xl font-bold mb-6">Réserver le terrain</h2>

                            <div class="space-y-6">
                                <div class="space-y-2">
                                    <label class="text-xs font-black uppercase opacity-50">Date</label>
                                    <div class="relative">
                                        <span
                                            class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 pointer-events-none">calendar_today</span>
                                        <input name="reservation_date" id="date-picker"
                                            class="w-full pl-10 pr-4 py-3 bg-slate-50 border-none ring-1 ring-slate-200 rounded-xl text-sm outline-none cursor-pointer focus:ring-2 focus:ring-primary"
                                            type="date" value="{{ date('Y-m-d') }}" min="{{ date('Y-m-d') }}"
                                            required />
                                    </div>
                                </div>

                                <div class="space-y-3">
                                    <label class="text-xs font-black uppercase opacity-50">Heure</label>
                                    <div class="grid grid-cols-3 gap-2">
                                        @foreach (['18:00', '19:00', '20:00', '21:00', '22:00', '23:00'] as $time)
                                            <button type="button" data-time="{{ $time }}"
                                                class="time-btn py-2.5 rounded-lg text-xs font-bold border {{ $loop->first ? 'bg-nav-dark text-white border-nav-dark' : 'border-slate-200 hover:border-primary text-slate-900 dark:text-slate-100' }} transition-all {{ $loop->last ? 'opacity-50 cursor-not-allowed line-through' : '' }}">
                                                {{ $time }}
                                            </button>
                                        @endforeach
                                    </div>
                                </div>

                                <div class="bg-white p-2 space-y-2">
                                    <div class="flex justify-between text-sm text-slate-500">
                                        <span>Tarif (1 hr)</span>
                                        <div class="text-right">
                                            @if ($stadium->has_active_offer)
                                                <span
                                                    class="line-through text-slate-400 text-xs mr-1">${{ $stadium->price }}</span>
                                                <span
                                                    class="font-bold text-green-600">${{ $stadium->discounted_price }}</span>
                                            @else
                                                <span class="font-medium text-slate-800">${{ $stadium->price }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="flex justify-between text-sm text-slate-500">
                                        <span>Frais de service</span>
                                        <span class="font-medium text-slate-800">$3.00</span>
                                    </div>
                                    <div class="pt-2 mt-2 flex justify-between items-center">
                                        <span class="font-bold">Total</span>
                                        <span class="text-xl font-black text-primary">
                                            ${{ $total ?? $stadium->discounted_price + 3 }} </span>
                                    </div>
                                </div>

                                <div class="pt-2">
                                    <button type="button" onclick="goToPayment()"
                                        class="w-full bg-nav-dark hover:bg-primary text-white py-3.5 rounded-xl font-bold flex items-center justify-center gap-2 transition-all transform active:scale-[0.98] cursor-pointer">
                                        <span class="material-symbols-outlined text-[20px]">credit_card</span>
                                        Book & Pay
                                    </button>
                                </div>

                                <p class="text-[9px] text-center text-slate-400 font-bold uppercase tracking-widest">
                                    FREE CANCELLATION UP TO 24H BEFORE
                                </p>
                            </div>
                        </div>

                        <div id="step-2"
                            class="absolute top-6 left-6 right-6 transition-all duration-300 transform translate-x-full opacity-0 invisible">

                            <div class="flex items-center gap-2 mb-6">
                                <button type="button" onclick="goBackToReservation()"
                                    class="text-slate-400 hover:text-nav-dark transition-colors flex items-center justify-center">
                                    <span class="material-symbols-outlined">arrow_back</span>
                                </button>
                                <h2 class="text-xl font-bold">Paiement</h2>
                            </div>

                            <div
                                class="bg-primary/5 border border-primary/20 rounded-xl p-3 flex justify-between items-center mb-5">
                                <div>
                                    <p class="text-xs text-slate-500 font-semibold uppercase">Total à payer</p>
                                    <p class="text-sm font-bold text-slate-800" id="summary-time">Aujourd'hui à 18:00
                                    </p>
                                </div>
                                <span class="text-xl font-black text-primary">
                                    ${{ $total ?? $stadium->discounted_price + 3 }} </span>
                            </div>

                            <div class="space-y-4">
                                <div>
                                    <label
                                        class="block text-xs font-bold text-slate-700 mb-1 uppercase tracking-wider">Nom
                                        sur la carte</label>
                                    <input type="text" name="cardholder_name" required
                                        class="w-full bg-slate-50 border-none ring-1 ring-slate-200 rounded-lg focus:ring-2 focus:ring-primary py-2.5 text-sm outline-none"
                                        placeholder="Ahmed Oubelkacem">
                                </div>

                                <div>
                                    <label
                                        class="block text-xs font-bold text-slate-700 mb-1 uppercase tracking-wider">Numéro
                                        de carte</label>
                                    <div class="relative">
                                        <span
                                            class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-[20px]">credit_card</span>
                                        <input type="text" required placeholder="XXXX XXXX XXXX XXXX"
                                            class="w-full pl-10 pr-4 bg-slate-50 border-none ring-1 ring-slate-200 rounded-lg focus:ring-2 focus:ring-primary py-2.5 text-sm outline-none">
                                    </div>
                                </div>

                                <div class="grid grid-cols-2 gap-3">
                                    <div>
                                        <label
                                            class="block text-xs font-bold text-slate-700 mb-1 uppercase tracking-wider">Expiration</label>
                                        <input type="text" required placeholder="MM / YY"
                                            class="w-full bg-slate-50 border-none ring-1 ring-slate-200 rounded-lg focus:ring-2 focus:ring-primary py-2.5 text-sm outline-none text-center">
                                    </div>
                                    <div>
                                        <label
                                            class="block text-xs font-bold text-slate-700 mb-1 uppercase tracking-wider">CVV</label>
                                        <input type="text" required placeholder="123"
                                            class="w-full bg-slate-50 border-none ring-1 ring-slate-200 rounded-lg focus:ring-2 focus:ring-primary py-2.5 text-sm outline-none text-center">
                                    </div>
                                </div>

                                <div class="pt-4">
                                    <button type="submit"
                                        class="w-full bg-nav-dark hover:bg-primary text-white py-3.5 rounded-xl font-bold flex items-center justify-center gap-2 transition-all transform active:scale-[0.98] shadow-lg shadow-nav-dark/20">
                                        <span class="material-symbols-outlined text-[20px]">lock</span>
                                        PAYER SÉCURISÉ
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div
                        class="mt-6 rounded-2xl overflow-hidden border border-slate-200 h-48 relative shadow-inner z-0">
                        <div id="map-small" class="w-full h-full bg-slate-200 z-0"></div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <x-footer />

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const timeButtons = document.querySelectorAll('.time-btn:not(.opacity-50)');
            const selectedTimeInput = document.getElementById('selected-time');
            const summaryTime = document.getElementById('summary-time');

            // --- 1. Gestion de la sélection de l'heure ---
            timeButtons.forEach(button => {
                button.addEventListener('click', function() {
                    timeButtons.forEach(btn => {
                        btn.classList.remove('bg-nav-dark', 'text-white',
                            'border-nav-dark');
                        btn.classList.add('border-slate-200', 'hover:border-primary',
                            'text-slate-900', 'dark:text-slate-100');
                    });

                    this.classList.remove('border-slate-200', 'hover:border-primary',
                        'text-slate-900', 'dark:text-slate-100');
                    this.classList.add('bg-nav-dark', 'text-white', 'border-nav-dark');

                    const selectedTime = this.getAttribute('data-time');
                    selectedTimeInput.value = selectedTime;

                    summaryTime.innerText = `Aujourd'hui à ${selectedTime}`;
                });
            });

            // --- 2. Code de la carte Leaflet ---
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
                html: `<div style="background-color: #ec5b13; color: white; border-radius: 50%; width: 36px; height: 36px; display: flex; align-items: center; justify-content: center; border: 3px solid white; box-shadow: 0 4px 6px rgba(0,0,0,0.3);">
                            <span class="material-symbols-outlined" style="font-size: 20px;">sports_soccer</span>
                       </div>`,
                iconSize: [36, 36],
                iconAnchor: [18, 18],
                popupAnchor: [0, -18]
            });

            L.marker([lat, lng], {
                    icon: koraIcon
                })
                .addTo(map)
                .bindPopup(`<b>${stadiumName}</b><br><span style="color:#ec5b13;">Ici le match !</span>`)
                .openPopup();
        });

        // --- 3. Animations Sidebar (Paiement) ---
        function goToPayment() {
            const step1 = document.getElementById('step-1');
            const step2 = document.getElementById('step-2');

            step1.classList.remove('translate-x-0', 'opacity-100');
            step1.classList.add('-translate-x-full', 'opacity-0', 'invisible');

            step2.classList.remove('translate-x-full', 'opacity-0', 'invisible');
            step2.classList.add('translate-x-0', 'opacity-100');
        }

        function goBackToReservation() {
            const step1 = document.getElementById('step-1');
            const step2 = document.getElementById('step-2');

            step2.classList.remove('translate-x-0', 'opacity-100');
            step2.classList.add('translate-x-full', 'opacity-0', 'invisible');

            step1.classList.remove('-translate-x-full', 'opacity-0', 'invisible');
            step1.classList.add('translate-x-0', 'opacity-100');
        }

        // --- 4. Gestion du Formulaire d'Avis (Toggle & Rating) ---
        function toggleReviewForm() {
            const listContainer = document.getElementById('reviews-list-container');
            const formContainer = document.getElementById('review-form-container');
            const writeBtn = document.getElementById('write-review-btn');

            if (formContainer.classList.contains('hidden')) {
                listContainer.classList.add('hidden');
                formContainer.classList.remove('hidden');
                writeBtn.classList.add('hidden');
            } else {
                formContainer.classList.add('hidden');
                listContainer.classList.remove('hidden');
                writeBtn.classList.remove('hidden');
            }
        }

        const starItems = document.querySelectorAll('.star-item');
        const ratingValueInput = document.getElementById('form-rating-value');
        let currentRating = 0;

        starItems.forEach(star => {
            star.addEventListener('mouseover', function() {
                const hoverVal = parseInt(this.getAttribute('data-val'));
                highlightStars(hoverVal);
            });

            star.addEventListener('mouseout', function() {
                highlightStars(currentRating);
            });

            star.addEventListener('click', function() {
                currentRating = parseInt(this.getAttribute('data-val'));
                ratingValueInput.value = currentRating;
                highlightStars(currentRating);
            });
        });

        function highlightStars(val) {
            starItems.forEach(star => {
                const starVal = parseInt(star.getAttribute('data-val'));
                if (starVal <= val) {
                    star.classList.remove('text-slate-300');
                    star.classList.add('text-primary', 'icon-filled');
                } else {
                    star.classList.add('text-slate-300');
                    star.classList.remove('text-primary', 'icon-filled');
                }
            });
        }
    </script>
</body>

</html>
