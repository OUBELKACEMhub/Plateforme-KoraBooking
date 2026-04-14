<x-layout>
    <x-slot:title>Trouvez votre terrain - KoraBooking</x-slot>

    {{-- 1. Styles spécifiques à la page (Leaflet & Animations) --}}
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
        </style>
    @endpush

    <section class="relative bg-primary py-16 md:py-24 overflow-hidden">
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-0 left-0 w-full h-full"
                style="background-image: radial-gradient(circle at 2px 2px, white 1px, transparent 0); background-size: 40px 40px;">
            </div>
        </div>
        <div class="relative max-w-7xl mx-auto px-4 text-center text-white">
            <h2 class="text-4xl md:text-6xl font-black mb-6 leading-tight">Trouvez votre terrain de football</h2>
            <p class="text-lg md:text-xl text-white/90 font-medium max-w-2xl mx-auto opacity-90">
                Réservez en quelques clics les meilleurs terrains 5vs5 près de chez vous au Maroc.
            </p>
        </div>
    </section>

    <div class="max-w-5xl mx-auto px-4 -mt-10 relative z-10">
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
                <div class="relative">
                    <label class="block text-xs font-bold text-slate-500 uppercase mb-2 ml-1">Prix maximum
                        (DH/h)</label>
                    <div class="relative group">
                        <span
                            class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-primary transition-colors">payments</span>
                        <input name="max_price" value="{{ request('max_price') }}"
                            class="w-full pl-10 pr-4 py-3 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-xl focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none"
                            placeholder="Ex: 300" type="number" />
                    </div>
                </div>
                <button type="submit"
                    class="w-full bg-primary hover:bg-primary/90 text-white font-bold py-3.5 rounded-xl shadow-lg transition-all active:scale-95">
                    Rechercher
                </button>
            </div>
        </form>
    </div>

    <div class="max-w-7xl mx-auto px-4 py-12">
        <div class="flex flex-col lg:flex-row gap-8">
            <div class="flex-1">
                <div class="flex justify-between items-center mb-8">
                    <h3 class="text-2xl font-bold text-slate-900 dark:text-white">Terrains disponibles</h3>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6" id="stadiums-grid">
                    @forelse($stadiums ?? [] as $stadium)
                        <div
                            class="stadium-card {{ $loop->iteration > 2 ? 'hidden' : '' }} bg-white dark:bg-slate-800 rounded-2xl overflow-hidden shadow-sm border border-slate-200 dark:border-slate-700 group hover:shadow-md transition-shadow">
                            <div class="relative h-48">
                                <img src="{{ $stadium->image ?? 'https://images.unsplash.com/photo-1574629810360-7efbbe195018?q=80&w=800' }}"
                                    class="w-full h-full object-cover">
                                <div
                                    class="absolute bottom-3 left-3 bg-primary text-white px-3 py-1 rounded-lg text-sm font-bold">
                                    {{ $stadium->price ?? 250 }} DH/h
                                </div>
                            </div>
                            <div class="p-5">
                                <h4 class="text-lg font-bold group-hover:text-primary transition-colors">
                                    {{ $stadium->name }}</h4>
                                <div class="flex items-center gap-2 text-slate-500 text-sm mb-4">
                                    <span class="material-symbols-outlined text-base">location_on</span>
                                    <span>{{ $stadium->city }}</span>
                                </div>
                                <a href="{{ route('stadiums.show', $stadium->id) }}"
                                    class="text-primary font-bold text-sm flex items-center gap-1 hover:translate-x-1 transition-transform">
                                    Réserver <span class="material-symbols-outlined text-sm">arrow_forward</span>
                                </a>
                            </div>
                        </div>
                    @empty
                        <p class="text-center py-10 opacity-50">Aucun terrain trouvé.</p>
                    @endforelse
                </div>

                @if (count($stadiums ?? []) > 2)
                    <div class="mt-8 flex justify-center" id="voir-plus-container">
                        <button id="btn-voir-plus"
                            class="bg-white dark:bg-slate-800 border border-slate-200 text-slate-700 font-bold py-3 px-8 rounded-xl shadow-sm flex items-center gap-2">
                            Voir plus de terrains <span class="material-symbols-outlined text-sm">expand_more</span>
                        </button>
                    </div>
                @endif
            </div>

            <div class="lg:w-[400px]">
                <div class="sticky top-24 border rounded-2xl overflow-hidden h-[600px]" id="map"></div>
            </div>
        </div>
    </div>

    {{-- 3. Scripts spécifiques à la page (Leaflet & Logic) --}}
    @push('scripts')
        <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Logique Voir Plus
                const btnVoirPlus = document.getElementById('btn-voir-plus');
                const hiddenCards = document.querySelectorAll('.stadium-card.hidden');
                if (btnVoirPlus) {
                    btnVoirPlus.addEventListener('click', () => {
                        hiddenCards.forEach(card => card.classList.remove('hidden'));
                        document.getElementById('voir-plus-container').style.display = 'none';
                    });
                }

                // Logique Carte Leaflet
                const stadiums = @json($stadiums ?? []);
                const map = L.map('map').setView([32.2995, -9.2372], 12);
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);

                stadiums.forEach((stadium) => {
                    if (stadium.latitude && stadium.longitude) {
                        L.marker([stadium.latitude, stadium.longitude]).addTo(map)
                            .bindPopup(`<b>${stadium.name}</b><br>${stadium.price} DH/h`);
                    }
                });
            });
        </script>
    @endpush
</x-layout>
