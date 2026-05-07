<!DOCTYPE html>
<html class="light" lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Offers & Promotions | KoraBooking Management Suite</title>

    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link
        href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;600;700;800&family=Inter:wght@400;500;600&display=swap"
        rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,300,0,0" />

    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "secondary-fixed-dim": "#ffb690",
                        "primary-fixed-dim": "#95d3ba",
                        "on-background": "#191c1e",
                        "on-tertiary-container": "#31c98f",
                        "tertiary-fixed-dim": "#4edea3",
                        "on-error-container": "#93000a",
                        "on-secondary": "#ffffff",
                        "background": "#f8f9fb",
                        "outline": "#707974",
                        "tertiary": "#003623",
                        "on-tertiary-fixed": "#002113",
                        "on-primary-fixed-variant": "#0b513d",
                        "surface-bright": "#f8f9fb",
                        "on-secondary-container": "#5c2400",
                        "tertiary-fixed": "#6ffbbe",
                        "primary-container": "#064e3b",
                        "surface-container-lowest": "#ffffff",
                        "primary": "#003527",
                        "inverse-on-surface": "#f0f1f3",
                        "error": "#ba1a1a",
                        "tertiary-container": "#004f34",
                        "surface-dim": "#d9dadc",
                        "surface-container-highest": "#e1e2e4",
                        "surface-container": "#edeef0",
                        "secondary-container": "#fd761a",
                        "on-tertiary-fixed-variant": "#005236",
                        "on-primary-fixed": "#002117",
                        "surface-variant": "#e1e2e4",
                        "surface-tint": "#2b6954",
                        "outline-variant": "#bfc9c3",
                        "on-error": "#ffffff",
                        "on-secondary-fixed": "#341100",
                        "inverse-surface": "#2e3132",
                        "secondary": "#9d4300",
                        "on-tertiary": "#ffffff",
                        "surface": "#f8f9fb",
                        "secondary-fixed": "#ffdbca",
                        "on-primary": "#ffffff",
                        "inverse-primary": "#95d3ba",
                        "surface-container-high": "#e7e8ea",
                        "error-container": "#ffdad6",
                        "surface-container-low": "#f3f4f6",
                        "on-surface-variant": "#404944",
                        "on-primary-container": "#80bea6",
                        "primary-fixed": "#b0f0d6",
                        "on-secondary-fixed-variant": "#783200",
                        "on-surface": "#191c1e"
                    },
                    fontFamily: {
                        headline: ["Manrope"],
                        body: ["Inter"],
                        label: ["Inter"]
                    }
                },
            }
        }
    </script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        h1,
        h2,
        h3,
        .headline {
            font-family: 'Manrope', sans-serif;
        }

        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }

        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }
    </style>
</head>

<body class="bg-surface text-on-surface flex h-screen overflow-hidden">

    <x-manager-sidebar />

    <main class="flex-grow h-full overflow-y-auto relative">
        <header
            class="w-full sticky top-0 z-40 bg-white/80 dark:bg-emerald-950/80 backdrop-blur-xl shadow-sm shadow-emerald-900/5 flex justify-between items-center px-8 h-16">
            <div class="flex items-center gap-4">
                <div class="relative group">
                    <span
                        class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-slate-400">search</span>
                    <input
                        class="bg-slate-100 border-none rounded-full pl-10 pr-4 py-2 w-64 focus:ring-2 focus:ring-emerald-500/20 transition-all text-sm"
                        placeholder="Search promotions..." type="text" />
                </div>
            </div>
            <x-navbar-actions />
        </header>

        <section class="p-8 max-w-7xl mx-auto space-y-10">
            <!-- Stats Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div
                    class="bg-surface-container-lowest p-6 rounded-xl border border-outline-variant/15 flex flex-col justify-between h-40">
                    <div class="flex justify-between items-start">
                        <div class="bg-primary-fixed/30 p-2 rounded-lg">
                            <span class="material-symbols-outlined text-primary-container">campaign</span>
                        </div>
                    </div>
                    <div>
                        <h4 class="text-slate-500 text-sm font-medium">Total Active Offers</h4>
                        <p class="text-3xl font-bold text-primary tracking-tight">{{ $offers->count() }}</p>
                    </div>
                </div>

                <div
                    class="bg-green-600 text-white p-6 rounded-xl relative overflow-hidden h-40 shadow-lg shadow-green-600/20">
                    <div class="relative z-10 flex flex-col justify-between h-full">
                        <div class="bg-white/20 w-fit p-2 rounded-lg backdrop-blur-sm">
                            <span class="material-symbols-outlined">payments</span>
                        </div>
                        <div>
                            <h4 class="text-green-50 text-sm font-medium">Promotions</h4>
                            <p class="text-xl font-bold tracking-tight">Gérez vos offres</p>
                        </div>
                    </div>
                    <div class="absolute -right-8 -bottom-8 opacity-10">
                        <span class="material-symbols-outlined text-[160px]">trending_up</span>
                    </div>
                </div>

                <div
                    class="bg-surface-container-lowest p-6 rounded-xl border border-outline-variant/15 flex flex-col justify-between h-40">
                    <div class="flex justify-between items-start">
                        <div class="bg-secondary-fixed/30 p-2 rounded-lg">
                            <span class="material-symbols-outlined text-secondary">timer</span>
                        </div>
                    </div>
                    <div>
                        <h4 class="text-slate-500 text-sm font-medium">Upcoming Expirations</h4>
                        <p class="text-3xl font-bold text-primary tracking-tight">0 <span
                                class="text-sm font-normal text-slate-400 ml-1">in next 48h</span></p>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-5 gap-8" id="offerFormContainer">
                <div class="lg:col-span-3 bg-surface-container-lowest rounded-xl p-8 shadow-sm border border-gray-100">
                    <h2 id="formTitle" class="text-xl font-bold text-primary mb-6 flex items-center gap-2">
                        <span class="material-symbols-outlined text-green-600">add_circle</span>
                        Créer une Nouvelle Offre
                    </h2>

                    <!-- Le Formulaire -->
                    <form id="offerForm" action="{{ route('manager.offers.store') }}" method="POST" class="space-y-6">
                        @csrf
                        <div id="methodSpoof"></div> <!-- Hna kay-tzad PUT f la modification -->

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label class="text-xs font-bold uppercase tracking-wider text-slate-500">Titre de
                                    l'offre</label>
                                <input name="title"
                                    class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 focus:ring-2 focus:ring-green-500/20 focus:border-green-500 transition-all outline-none"
                                    placeholder="e.g. Promo KoraBooking" type="text" required />
                            </div>

                            <div class="space-y-2">
                                <label class="text-xs font-bold uppercase tracking-wider text-slate-500">Type
                                    d'offre</label>
                                <select name="type" required
                                    class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 focus:ring-2 focus:ring-green-500/20 focus:border-green-500 transition-all outline-none appearance-none">
                                    <option value="" disabled selected>Choisissez le type</option>
                                    <option value="promo">Promo</option>
                                    <option value="flash">Flash</option>
                                    <option value="seasonal">Seasonal</option>
                                </select>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label class="text-xs font-bold uppercase tracking-wider text-slate-500">Remise
                                    (%)</label>
                                <div class="relative">
                                    <input name="discount_percentage"
                                        class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 focus:ring-2 focus:ring-green-500/20 focus:border-green-500 transition-all outline-none"
                                        placeholder="20" type="number" min="1" max="100" required />
                                    <span
                                        class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-400 font-bold">%</span>
                                </div>
                            </div>

                            <div class="space-y-2">
                                <label class="text-xs font-bold uppercase tracking-wider text-slate-500">Terrain
                                    applicable</label>
                                <select name="stadium_id" required
                                    class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 focus:ring-2 focus:ring-green-500/20 focus:border-green-500 transition-all outline-none appearance-none">
                                    <option value="" disabled selected>Sélectionnez un terrain</option>
                                    @forelse($stadiums ?? [] as $stadium)
                                        <option value="{{ $stadium->id }}">{{ $stadium->name }}</option>
                                    @empty
                                        <option disabled>Aucun terrain disponible</option>
                                    @endforelse
                                </select>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label class="text-xs font-bold uppercase tracking-wider text-slate-500">Date de
                                    début</label>
                                <input name="start_date"
                                    class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 focus:ring-2 focus:ring-green-500/20 focus:border-green-500 transition-all outline-none"
                                    type="date" required />
                            </div>

                            <div class="space-y-2">
                                <label class="text-xs font-bold uppercase tracking-wider text-slate-500">Date de
                                    fin</label>
                                <input name="end_date"
                                    class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 focus:ring-2 focus:ring-green-500/20 focus:border-green-500 transition-all outline-none"
                                    type="date" required />
                            </div>
                        </div>

                        <div class="flex gap-4">
                            <button type="submit" id="submitBtn"
                                class="flex-1 bg-green-600 text-white py-4 rounded-xl font-bold text-lg hover:bg-green-700 hover:shadow-lg transition-all active:scale-95">
                                Lancer la Promotion
                            </button>
                            <button type="button" id="cancelEditBtn" onclick="cancelEdit()"
                                class="hidden bg-gray-100 text-gray-600 py-4 px-6 rounded-xl font-bold text-lg hover:bg-gray-200 transition-all active:scale-95">
                                Annuler
                            </button>
                        </div>
                    </form>
                </div>

                <div class="lg:col-span-2 relative rounded-xl overflow-hidden group h-full min-h-[400px]">
                    <img alt="Stadium lights"
                        class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                        src="https://images.unsplash.com/photo-1511886929837-354d827aae26?q=80&w=2000&auto=format&fit=crop" />
                    <div class="absolute inset-0 bg-gradient-to-t from-gray-900 via-gray-900/60 to-transparent"></div>
                    <div class="absolute bottom-0 left-0 p-8 text-white">
                        <span
                            class="inline-block bg-green-500 text-white px-3 py-1 rounded text-xs font-bold mb-3">MANAGER
                            TIP</span>
                        <h3 class="text-2xl font-bold mb-2">Maximize Late-Night Slots</h3>
                        <p class="text-gray-300 text-sm">Flash offers for 9 PM - 11 PM bookings have seen a 40%
                            increase in revenue this month.</p>
                    </div>
                </div>
            </div>

            <!-- Liste des Offres -->
            <div class="space-y-6">
                <div class="flex justify-between items-center">
                    <h2 class="text-2xl font-extrabold text-gray-800 tracking-tight">Active Campaigns</h2>
                </div>

                <div class="grid grid-cols-1 gap-4">
                    @forelse ($offers as $offer)
                        @php
                            $isPast = \Carbon\Carbon::parse($offer->end_date)->isPast();
                            $isFuture = \Carbon\Carbon::parse($offer->start_date)->isFuture();

                            $statusText = 'Active';
                            $statusClass = 'bg-green-100 text-green-700';

                            if ($isPast) {
                                $statusText = 'Expired';
                                $statusClass = 'bg-red-50 text-red-600';
                            } elseif ($isFuture) {
                                $statusText = 'Scheduled';
                                $statusClass = 'bg-gray-100 text-gray-600';
                            }

                            $icon = $offer->type == 'flash' ? 'bolt' : 'local_offer';
                            $colorTheme = $offer->type == 'flash' ? 'green' : 'orange';
                        @endphp

                        <div
                            class="bg-white p-6 rounded-xl border border-gray-200 flex flex-wrap md:flex-nowrap items-center gap-6 group hover:shadow-md transition-all {{ $isPast ? 'opacity-75' : '' }}">

                            <div
                                class="w-16 h-16 bg-{{ $colorTheme }}-50 rounded-full flex items-center justify-center flex-shrink-0 text-{{ $colorTheme }}-600">
                                <span class="material-symbols-outlined text-3xl">{{ $icon }}</span>
                            </div>

                            <div class="flex-grow">
                                <h4 class="font-bold text-gray-800 text-lg">{{ ucfirst($offer->type) }} Offer</h4>
                                <p class="text-gray-500 text-sm">{{ $offer->title }}</p>
                            </div>

                            <div class="flex items-center gap-12 flex-shrink-0">
                                <div class="text-center">
                                    <p class="text-xs font-bold text-gray-400 uppercase tracking-widest">Discount</p>
                                    <p class="text-xl font-black text-{{ $colorTheme }}-600">
                                        {{ $offer->discount_percentage }}%</p>
                                </div>

                                <div class="text-center">
                                    <p class="text-xs font-bold text-gray-400 uppercase tracking-widest">Duration</p>
                                    <p class="text-sm font-medium text-gray-700">
                                        {{ \Carbon\Carbon::parse($offer->start_date)->format('M d') }} -
                                        {{ \Carbon\Carbon::parse($offer->end_date)->format('M d') }}
                                    </p>
                                </div>

                                <div class="flex flex-col items-end gap-2">
                                    <span
                                        class="{{ $statusClass }} px-3 py-1 rounded-full text-xs font-bold">{{ $statusText }}</span>

                                    <div
                                        class="flex items-center gap-3 opacity-0 group-hover:opacity-100 transition-opacity">

                                        <!-- Bouton Edit li kay-khdem b JS -->
                                        <button type="button"
                                            onclick="editOffer({{ $offer->id }}, '{{ addslashes($offer->title) }}', '{{ $offer->type }}', {{ $offer->discount_percentage }}, '{{ \Carbon\Carbon::parse($offer->start_date)->format('Y-m-d') }}', '{{ \Carbon\Carbon::parse($offer->end_date)->format('Y-m-d') }}', '{{ $offer->stadiums->first()->id ?? '' }}')"
                                            class="text-gray-400 hover:text-blue-600 transition-colors"
                                            title="Modifier l'offre">
                                            <span class="material-symbols-outlined">edit</span>
                                        </button>

                                        <!-- Bouton Delete (Route m-rygla l manager.offers.destroy) -->
                                        <form action="{{ route('manager.offers.destroy', $offer->id) }}"
                                            method="POST" class="m-0"
                                            onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette offre ?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="text-gray-400 hover:text-red-500 transition-colors flex items-center justify-center"
                                                title="Supprimer l'offre">
                                                <span class="material-symbols-outlined">delete</span>
                                            </button>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-10 text-gray-500 bg-gray-50 rounded-xl border border-gray-200">
                            <span class="material-symbols-outlined text-4xl mb-2 text-gray-400">inbox</span>
                            <p>Vous n'avez pas encore créé d'offres.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </section>
    </main>

    <!-- 🔥 SCRIPT JAVASCRIPT DYAL L-FORMULAIRE 🔥 -->
    <script>
        const form = document.getElementById('offerForm');
        const formTitle = document.getElementById('formTitle');
        const submitBtn = document.getElementById('submitBtn');
        const cancelBtn = document.getElementById('cancelEditBtn');
        const methodSpoof = document.getElementById('methodSpoof');
        const defaultAction = "{{ route('manager.offers.store') }}";

        function editOffer(id, title, type, discount, startDate, endDate, stadiumId) {
            // 1. URL + Méthode
            form.action = `/manager/offres/${id}`;
            methodSpoof.innerHTML = '<input type="hidden" name="_method" value="PUT">';

            // 2. Remplir les champs
            form.querySelector('[name="title"]').value = title;
            form.querySelector('[name="type"]').value = type;
            form.querySelector('[name="discount_percentage"]').value = discount;
            form.querySelector('[name="start_date"]').value = startDate;
            form.querySelector('[name="end_date"]').value = endDate;
            if (stadiumId) form.querySelector('[name="stadium_id"]').value = stadiumId;

            // 3. Modifier le design du formulaire
            formTitle.innerHTML =
                '<span class="material-symbols-outlined text-blue-600">edit_note</span> Modifier l\'offre';
            submitBtn.textContent = 'Enregistrer les modifications';
            submitBtn.classList.replace('bg-green-600', 'bg-blue-600');
            submitBtn.classList.replace('hover:bg-green-700', 'hover:bg-blue-700');

            cancelBtn.classList.remove('hidden');

            // 4. Scroll vers le formulaire (Animation n9iya)
            document.getElementById('offerFormContainer').scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }

        function cancelEdit() {
            form.reset();
            form.action = defaultAction;
            methodSpoof.innerHTML = '';

            formTitle.innerHTML =
                '<span class="material-symbols-outlined text-green-600">add_circle</span> Créer une Nouvelle Offre';
            submitBtn.textContent = 'Lancer la Promotion';
            submitBtn.classList.replace('bg-blue-600', 'bg-green-600');
            submitBtn.classList.replace('hover:bg-blue-700', 'hover:bg-green-700');

            cancelBtn.classList.add('hidden');
        }
    </script>
</body>

</html>
