<x-layout>
    <x-slot:title>Trouvez votre terrain - KoraBooking</x-slot:title>

    @push('styles')
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
        <style>
            .leaflet-container {
                z-index: 10 !important;
            }

            .fade-in {
                animation: fadeIn 0.5s ease-in-out;
            }

            @keyframes fadeIn {
                from {
                    opacity: 0;
                    transform: translateY(10px);
                }

                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            .hide-scroll::-webkit-scrollbar {
                display: none;
            }

            .hide-scroll {
                -ms-overflow-style: none;
                scrollbar-width: none;
            }
        </style>
    @endpush



    <section class="relative bg-primary py-16 md:py-24 overflow-hidden">
        <div class="absolute inset-0 opacity-55">
            <div class="absolute top-0 left-0 w-full h-full"
                style="background-image: url('https://images.unsplash.com/photo-1721441904917-1afc7f0de133?q=80&w=1931&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;">
            </div>
        </div>
        <div class="relative max-w-7xl mx-auto px-4 text-center text-white">
            <h2 class="text-4xl md:text-6xl font-black mb-6 leading-tight">Trouvez votre terrain de football</h2>
            <p class="text-lg md:text-xl text-white/90 font-medium max-w-2xl mx-auto opacity-90">
                Réservez en quelques clics les meilleurs terrains 5vs5 près de chez vous au Maroc.
            </p>
        </div>
    </section>

    <div class="max-w-5xl mx-auto px-4 -mt-10 relative z-20">

        <form action="" method="GET"
            class="bg-white dark:bg-slate-800 rounded-2xl shadow-xl p-4 md:p-6 border border-slate-200 dark:border-slate-700">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-end">
                <div class="relative">
                    <label class="block text-xs font-bold text-slate-500 uppercase mb-2 ml-1">Ville</label>
                    <div class="relative group">
                        <span
                            class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-primary transition-colors">location_on</span>
                        <input name="city" value="{{ request('city', 'Safi') }}"
                            class="w-full pl-10 pr-4 py-3 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-xl focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none"
                            placeholder="Casablanca, Rabat..." type="text" />
                    </div>
                </div>
                <div
                    class="relative group flex flex-col gap-3 p-4 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-xl focus-within:ring-2 focus-within:ring-primary/20 focus-within:border-primary transition-all">

                    <div class="flex items-center justify-between">
                        <div
                            class="flex items-center gap-2 text-slate-500 group-focus-within:text-primary transition-colors">
                            <span class="material-symbols-outlined text-[20px]">payments</span>
                            <span class="text-sm font-semibold">Prix maximum</span>
                        </div>
                        <div class="text-sm font-bold text-primary">
                            <span id="price-output">{{ request('max_price', 500) }}</span> DH
                        </div>
                    </div>

                    <input type="range" name="max_price" id="max_price_range" min="50" max="1000"
                        step="50" value="{{ request('max_price', 500) }}"
                        oninput="document.getElementById('price-output').innerText = this.value"
                        class="w-full h-2 bg-slate-200 rounded-lg appearance-none cursor-pointer accent-primary dark:bg-slate-700" />
                </div>
                <button type="submit"
                    class="w-full bg-primary hover:bg-primary/90 text-white font-bold py-3.5 rounded-xl shadow-lg transition-all active:scale-95">
                    Rechercher
                </button>
            </div>

            <div class="flex flex-wrap gap-2 mt-4 pt-4 border-t border-slate-100 dark:border-slate-700">
                <span
                    class="px-3 py-1 bg-green-50 text-green-600 rounded-full text-xs font-bold flex items-center gap-1 cursor-pointer"><span
                        class="material-symbols-outlined text-[14px]">check</span> Vestiaires</span>
                <span
                    class="px-3 py-1 bg-slate-50 text-slate-500 hover:bg-slate-100 rounded-full text-xs font-medium cursor-pointer">Éclairage</span>
                <span
                    class="px-3 py-1 bg-slate-50 text-slate-500 hover:bg-slate-100 rounded-full text-xs font-medium cursor-pointer">Douches</span>
                <span
                    class="px-3 py-1 bg-slate-50 text-slate-500 hover:bg-slate-100 rounded-full text-xs font-medium cursor-pointer">Parking</span>
            </div>
        </form>
    </div>

    <div class="max-w-7xl mx-auto px-4 pt-12 pb-4 fade-in">
        <div class="flex justify-between items-center mb-6">
            <h3 class="text-xl font-bold text-slate-900 dark:text-white flex items-center gap-2">
                <span class="text-orange-500 text-2xl">🔥</span> OFFRES DISPONIBLES
            </h3>
            <div class="flex gap-2">
                <button
                    class="w-8 h-8 rounded-full border border-slate-200 flex items-center justify-center hover:bg-slate-50 transition-colors">
                    <span class="material-symbols-outlined text-sm text-slate-600">chevron_left</span>
                </button>
                <button
                    class="w-8 h-8 rounded-full border border-slate-200 flex items-center justify-center hover:bg-slate-50 transition-colors">
                    <span class="material-symbols-outlined text-sm text-slate-600">chevron_right</span>
                </button>
            </div>
        </div>

        <div class="flex gap-6 overflow-x-auto pb-4 snap-x snap-mandatory hide-scroll">

            @php
                $offerStyles = [
                    [
                        'card' => 'bg-[#16a34a] text-white',
                        'badge' => 'bg-white/20 text-white',
                        'title' => 'text-white',
                        'desc' => 'text-white/90',
                        'icon' => 'percent text-white/90',
                        'price_label' => 'opacity-80 text-white',
                        'btn' => 'bg-white/20 hover:bg-white hover:text-[#16a34a] text-white',
                    ],
                    [
                        'card' => 'bg-white border border-slate-200',
                        'badge' => 'bg-orange-100 text-orange-600',
                        'title' => 'text-slate-900',
                        'desc' => 'text-slate-500',
                        'icon' => 'bolt text-orange-500/20',
                        'price_label' => 'text-orange-500',
                        'btn' => 'bg-orange-100 hover:bg-orange-500 hover:text-white text-orange-500',
                    ],
                    [
                        'card' => 'bg-[#f97316] text-white',
                        'badge' => 'bg-white/20 text-white',
                        'title' => 'text-white',
                        'desc' => 'text-white/90',
                        'icon' => 'military_tech text-white/80',
                        'price_label' => 'opacity-80 text-white',
                        'btn' => 'bg-white/20 hover:bg-white hover:text-[#f97316] text-white',
                    ],
                    [
                        'card' => 'bg-[#0f172a] text-white',
                        'badge' => 'bg-sky-500/20 text-sky-400',
                        'title' => 'text-white',
                        'desc' => 'text-slate-300',
                        'icon' => 'school text-slate-700',
                        'price_label' => 'opacity-80 text-white',
                        'btn' => 'bg-white/20 hover:bg-white hover:text-black text-white',
                    ],
                ];
            @endphp

            @forelse($offers ?? [] as $offer)
                @php
                    // Kan3zlo style b tariqa dynamique (0, 1, 2, 3 w kayt3awd)
                    $style = $offerStyles[$loop->index % 4];

                    // Njib l-terrain lewel li m-linki m3a had l-offre
                    $stadium = $offer->stadiums->first();

                    // Calcul dyal prix jdid (Ila kan l-terrain m3rof)
                    $discountedPrice = null;
                    if ($stadium && $stadium->price) {
                        $discountedPrice = $stadium->price - ($stadium->price * $offer->discount_percentage) / 100;
                    }
                @endphp

                <div
                    class="min-w-[280px] md:min-w-[320px] {{ $style['card'] }} rounded-2xl p-6 shrink-0 snap-start relative overflow-hidden group cursor-pointer shadow-md">
                    <div class="absolute -right-4 -top-4 opacity-20 group-hover:scale-110 transition-transform">
                        <span class="material-symbols-outlined text-9xl {{ $style['icon'] }}">sell</span>
                    </div>

                    <div class="relative z-10 flex flex-col h-full">
                        <span
                            class="inline-block px-3 py-1 {{ $style['badge'] }} rounded-full text-[10px] font-bold tracking-wider mb-4 self-start uppercase">
                            {{ $offer->type ?? 'PROMO' }}
                        </span>

                        <h4 class="text-2xl font-black mb-2 {{ $style['title'] }}">
                            -{{ $offer->discount_percentage }}%
                            @if ($stadium)
                                à <br><span class="text-lg">{{ Str::limit($stadium->name, 20) }}</span>
                            @endif
                        </h4>

                        <p class="text-sm {{ $style['desc'] }} mb-6 leading-relaxed">
                            Valable jusqu'au {{ \Carbon\Carbon::parse($offer->end_date)->format('d M Y') }}.
                        </p>

                        <div class="flex justify-between items-end mt-auto">
                            <div>
                                @if ($discountedPrice)
                                    <p class="text-[10px] font-bold uppercase {{ $style['price_label'] }}">À PARTIR DE
                                    </p>
                                    <p class="text-2xl font-black italic">{{ number_format($discountedPrice, 0) }}
                                        DH<span
                                            class="text-sm not-italic font-medium {{ $style['price_label'] }}">/h</span>
                                    </p>
                                @else
                                    <p
                                        class="text-[10px] font-bold uppercase tracking-wide {{ $style['price_label'] }}">
                                        RÉSERVER VITE</p>
                                @endif
                            </div>

                            @if ($stadium)
                                @if ($stadium->status === 'maintenance')
                                    <div title="Terrain en maintenance"
                                        class="w-10 h-10 rounded-full bg-slate-200 dark:bg-slate-700 text-slate-400 dark:text-slate-500 flex items-center justify-center relative z-20 cursor-not-allowed">
                                        <span class="material-symbols-outlined text-sm">block</span>
                                    </div>
                                @else
                                    <a href="{{ route('stadiums.show', $stadium->id) }}"
                                        class="w-10 h-10 rounded-full {{ $style['btn'] }} flex items-center justify-center transition-colors relative z-20 hover:scale-105">
                                        <span class="material-symbols-outlined text-sm">arrow_forward</span>
                                    </a>
                                @endif
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="w-full bg-slate-50 border border-slate-200 text-center py-8 rounded-2xl">
                    <span class="material-symbols-outlined text-slate-300 text-4xl mb-2">loyalty</span>
                    <p class="text-slate-500 font-bold">Aucune offre disponible pour le moment.</p>
                </div>
            @endforelse

        </div>
    </div>

    <div
        class="mt-6 bg-orange-100/50 dark:bg-orange-500/10 border border-orange-200 dark:border-orange-500/30 rounded-2xl p-4 flex items-center justify-center gap-3 transition-transform hover:scale-[1.01]">
        <span class="flex h-3 w-3 relative">
            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-orange-400 opacity-75"></span>
            <span class="relative inline-flex rounded-full h-3 w-3 bg-orange-500"></span>
        </span>

        <p class="text-slate-800 dark:text-slate-200 text-sm md:text-base font-medium">
            Réservez maintenant et gagnez <strong class="text-orange-600 dark:text-orange-400 font-black">10 points
                Wallet</strong> !
        </p>
    </div>

    <div class="max-w-7xl mx-auto px-4 pb-12 pt-4">
        <div class="flex flex-col lg:flex-row gap-8">
            <div class="flex-1">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-xl font-bold text-slate-900 dark:text-white">{{ count($stadiums ?? []) }} terrains
                        disponibles</h3>
                    <div class="text-sm text-slate-500 flex items-center gap-2">
                        Trier par: <span class="font-bold text-primary cursor-pointer flex items-center">Prix croissant
                            <span class="material-symbols-outlined text-sm">expand_more</span></span>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6" id="stadiums-grid">
                    @forelse($stadiums ?? [] as $stadium)
                        <div
                            class="stadium-card {{ $loop->iteration > 4 ? 'hidden' : '' }} bg-white dark:bg-slate-800 rounded-2xl overflow-hidden shadow-sm border border-slate-200 dark:border-slate-700 group transition-all duration-300 {{ $stadium->status === 'maintenance' ? 'opacity-80 grayscale-[40%]' : 'hover:shadow-md' }}">

                            <div class="relative h-48">
                                <img src="{{ $stadium->image ?? 'https://images.unsplash.com/photo-1574629810360-7efbbe195018?q=80&w=800' }}"
                                    class="w-full h-full object-cover">

                                @if ($stadium->isUnderMaintenance())
                                    <div
                                        class="absolute inset-0 bg-slate-900/50 backdrop-blur-[2px] flex items-center justify-center z-10">
                                        <div
                                            class="bg-red-600 text-white px-4 py-2 rounded-full font-bold text-sm flex items-center gap-2 shadow-lg">
                                            <span class="material-symbols-outlined text-[18px]">build</span>
                                            En Maintenance
                                        </div>
                                    </div>
                                @endif

                                <div
                                    class="absolute top-3 right-3 bg-white text-slate-900 px-2 py-1 rounded flex items-center gap-1 text-xs font-bold shadow-sm z-20">
                                    <span class="material-symbols-outlined text-yellow-500 text-[14px]"
                                        style="font-variation-settings: 'FILL' 1;">star</span>
                                    {{ $stadium->rate ?? 4.8 }}
                                    <span class="text-slate-400 font-medium">
                                        ({{ $stadium->reviews->count() ?? 0 }} avis)
                                    </span>
                                </div>

                                <div class="absolute bottom-3 left-3 flex gap-2 z-20">
                                    @if ($stadium->has_active_offer ?? false)
                                        <div
                                            class="bg-slate-900/80 backdrop-blur text-white px-2 py-1 rounded text-sm font-bold line-through opacity-80">
                                            {{ $stadium->price }} DH/h
                                        </div>
                                        <div class="bg-primary text-white px-3 py-1 rounded text-sm font-bold">
                                            {{ $stadium->discounted_price ?? 175 }} DH/h
                                        </div>
                                    @else
                                        <div class="bg-green-600 text-white px-3 py-1 rounded text-sm font-bold">
                                            {{ $stadium->price ?? 250 }} DH/h
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="p-5">
                                <h4
                                    class="text-lg font-bold text-slate-900 mb-1 group-hover:text-primary transition-colors">
                                    {{ $stadium->name }}
                                </h4>
                                <div class="flex items-center gap-1 text-slate-500 text-sm mb-4">
                                    <span class="material-symbols-outlined text-[16px]">location_on</span>
                                    <span>{{ $stadium->address ?? 'Quartier' }}, {{ $stadium->city }}</span>
                                </div>

                                <div class="flex items-center justify-between border-t border-slate-100 pt-4">
                                    <div class="flex gap-3">
                                        @if ($stadium->has_active_offer ?? false)
                                            <span class="text-xs font-bold text-primary flex items-center gap-1">
                                                <span class="material-symbols-outlined text-[14px]">local_offer</span>
                                                Promo
                                            </span>
                                        @endif
                                        <span class="text-xs font-medium text-slate-500 flex items-center gap-1">
                                            <span class="material-symbols-outlined text-[14px]">calendar_month</span>
                                            Dispo.
                                        </span>
                                    </div>

                                    @if ($stadium->isUnderMaintenance())
                                        <span
                                            class="text-slate-400 font-bold text-sm flex items-center gap-1 cursor-not-allowed">
                                            Indisponible <span class="material-symbols-outlined text-sm">block</span>
                                        </span>
                                    @else
                                        <a href="{{ route('stadiums.show', $stadium->id) }}"
                                            class="text-green-600 font-bold text-sm flex items-center gap-1 hover:translate-x-1 transition-transform">
                                            Réserver <span
                                                class="material-symbols-outlined text-sm">arrow_forward</span>
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="text-center py-10 opacity-50 col-span-2">Aucun terrain trouvé.</p>
                    @endforelse
                </div>

                @php $listeTerrains = $stadiums ?? [1,2,3,4,5]; @endphp
                @if (count($listeTerrains) > 4)
                    <div class="mt-8 flex justify-center" id="voir-plus-container">
                        <button id="btn-voir-plus"
                            class="bg-white dark:bg-slate-800 border border-slate-200 text-slate-700 font-bold py-2.5 px-6 rounded-xl shadow-sm hover:bg-slate-50 transition-colors">
                            Voir plus de terrains
                        </button>
                    </div>
                @endif


            </div>

            <div class="lg:w-[400px]">
                <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden sticky top-24">
                    <div class="px-4 py-3 border-b border-slate-100 flex justify-between items-center">
                        <h4 class="font-bold text-sm text-slate-900">Vue Carte</h4>
                        <span
                            class="text-[10px] font-bold text-green-600 uppercase tracking-wider bg-green-50 px-2 py-1 rounded">Interactif</span>
                    </div>
                    <div class="h-[550px] bg-slate-100 relative" id="map"></div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const btnVoirPlus = document.getElementById('btn-voir-plus');
                const hiddenCards = document.querySelectorAll('.stadium-card.hidden');
                if (btnVoirPlus) {
                    btnVoirPlus.addEventListener('click', () => {
                        hiddenCards.forEach(card => card.classList.remove('hidden'));
                        document.getElementById('voir-plus-container').style.display = 'none';
                    });
                }

                @php
                    $terrainsParDefaut = [['id' => 1, 'latitude' => 33.5898, 'longitude' => -7.6038, 'name' => 'Stadium Five Casablanca', 'price' => 175], ['id' => 2, 'latitude' => 34.0208, 'longitude' => -6.8416, 'name' => 'Arena Sport Rabat', 'price' => 200]];
                    $stadiumsData = isset($stadiums) && count($stadiums) > 0 ? $stadiums : $terrainsParDefaut;
                @endphp

                const stadiums = @json($stadiumsData);
                const defaultLat = stadiums.length > 0 ? stadiums[0].latitude : 32.2995;
                const defaultLng = stadiums.length > 0 ? stadiums[0].longitude : -9.2372;
                const map = L.map('map').setView([defaultLat, defaultLng], 12);

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

                stadiums.forEach((stadium) => {
                    if (stadium.latitude && stadium.longitude) {
                        L.marker([stadium.latitude, stadium.longitude], {
                                icon: koraIcon
                            })
                            .addTo(map)
                            .bindPopup(
                                `<b>${stadium.name}</b><br><span style="color:#ec5b13; font-weight:bold;">${stadium.price} DH/h</span>`
                            );
                    }
                });
            });
        </script>
    @endpush
</x-layout>
