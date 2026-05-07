<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>KoraBooking - Mes Terrains</title>
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
    </style>
</head>

<body class="text-slate-800 flex h-screen overflow-hidden">

    <x-manager-sidebar />

    <main class="flex-1 flex flex-col h-full overflow-hidden bg-slate-50">
        <header
            class="bg-white border-b border-slate-200/60 px-8 py-5 flex justify-between items-center shrink-0 shadow-sm z-10">
            <div>
                <h2 class="text-2xl font-extrabold text-slate-900 tracking-tight">Mes Terrains</h2>
                <p class="text-sm text-slate-500 font-medium mt-0.5">Gérez les informations de votre infrastructure.</p>
            </div>
            <div class="flex items-center space-x-4">
                <x-navbar-actions />
            </div>
        </header>

        <div class="flex-1 overflow-y-auto p-8">

            <div class="flex justify-end mb-8">
                <button onclick="openCreateForm()"
                    class="bg-emerald-600 hover:bg-emerald-700 text-white px-6 py-3 rounded-2xl font-bold flex items-center gap-2 shadow-lg shadow-emerald-600/20 transition-all active:scale-95">
                    <span class="material-symbols-outlined">add</span>
                    Nouveau Terrain
                </button>
            </div>

            <div id="stadiumFormContainer"
                class="hidden mb-10 bg-white p-8 rounded-3xl border border-slate-100 shadow-lg shadow-slate-200/40 transition-all">
                <div class="flex justify-between items-center mb-8 border-b border-slate-100 pb-4">
                    <h3 id="formTitle" class="text-2xl font-extrabold text-slate-900 flex items-center gap-2">
                        <span class="material-symbols-outlined text-emerald-500">add_circle</span> Ajouter un terrain
                    </h3>
                    <button onclick="closeForm()"
                        class="p-2 bg-slate-50 hover:bg-red-50 text-slate-400 hover:text-red-500 rounded-full transition-colors">
                        <span class="material-symbols-outlined">close</span>
                    </button>
                </div>

                <form id="stadiumForm" action="{{ route('stadiums.store') }}" method="POST"
                    enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    <div id="methodSpoof"></div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Nom du
                                Terrain</label>
                            <input type="text" name="name" required
                                class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition-all outline-none font-medium"
                                placeholder="Ex: Terrain Principal">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Prix par
                                Heure (DH)</label>
                            <input type="number" name="price" step="0.01" required
                                class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition-all outline-none font-medium"
                                placeholder="Ex: 150">
                        </div>
                        <div>
                            <label
                                class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Ville</label>
                            <input type="text" name="city" required
                                class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition-all outline-none font-medium"
                                placeholder="Ex: Casablanca">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Adresse
                                complète</label>
                            <input type="text" name="address" required
                                class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition-all outline-none font-medium"
                                placeholder="Ex: Quartier Industriel">
                        </div>
                        <div>
                            <label
                                class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Statut</label>
                            <select name="status" required
                                class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition-all outline-none font-medium appearance-none">
                                <option value="available">Disponible</option>
                                <option value="maintenance">En maintenance</option>
                            </select>
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Image du
                                Terrain (Optionnel)</label>
                            <input type="file" name="image" accept="image/*"
                                class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-bold file:bg-emerald-100 file:text-emerald-700 hover:file:bg-emerald-200 cursor-pointer">
                        </div>
                    </div>

                    <div class="flex justify-end gap-3 pt-6 border-t border-slate-100">
                        <button type="button" onclick="closeForm()"
                            class="px-6 py-3 text-slate-600 bg-slate-100 hover:bg-slate-200 rounded-xl font-bold transition-colors">Annuler</button>
                        <button type="submit" id="submitBtn"
                            class="px-8 py-3 text-white bg-emerald-600 hover:bg-emerald-700 rounded-xl font-bold shadow-md shadow-emerald-600/20 transition-all">Enregistrer</button>
                    </div>
                </form>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($stadiums as $stadium)
                    <div
                        class="bg-white rounded-3xl border border-slate-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 overflow-hidden group">
                        <div class="aspect-video bg-slate-200 relative overflow-hidden">
                            @if (isset($stadium->image))
                                <img src="{{ $stadium->image }}" alt="{{ $stadium->name }}"
                                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            @else
                                <img src="https://images.unsplash.com/photo-1556816214-cb30ebd688a4?q=80&w=800"
                                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            @endif
                            <div class="absolute inset-0 bg-gradient-to-t from-slate-900/60 to-transparent"></div>
                            <div class="absolute top-4 right-4">
                                <span
                                    class="px-3 py-1 bg-white/90 backdrop-blur-md text-emerald-600 text-[10px] font-black uppercase tracking-widest rounded-md shadow-sm">Actif</span>
                            </div>
                            <h3 class="absolute bottom-4 left-4 text-xl font-extrabold text-white">{{ $stadium->name }}
                            </h3>
                        </div>

                        <div class="p-6">
                            <div class="flex justify-between items-center mb-6">
                                <p class="text-emerald-600 font-extrabold text-2xl">
                                    {{ number_format($stadium->price, 2) }} <span
                                        class="text-sm text-slate-400 font-medium">DH / Hr</span></p>
                            </div>

                            <div
                                class="flex items-center space-x-2 text-sm text-slate-500 font-medium mb-6 bg-slate-50 p-3 rounded-xl">
                                <span class="material-symbols-outlined text-slate-400">location_on</span>
                                <span class="truncate">{{ $stadium->city ?? 'Ville non spécifiée' }},
                                    {{ $stadium->address ?? '' }}</span>
                            </div>

                            <div class="flex gap-3">
                                <button type="button"
                                    onclick="openEditForm({{ $stadium->id }}, '{{ addslashes($stadium->name) }}', {{ $stadium->price }}, '{{ addslashes($stadium->city ?? '') }}', '{{ addslashes($stadium->address ?? '') }}')"
                                    class="flex-1 flex justify-center items-center gap-2 bg-blue-50 text-blue-600 hover:bg-blue-600 hover:text-white py-3 rounded-xl font-bold text-sm transition-colors">
                                    <span class="material-symbols-outlined text-[20px]">edit</span> Edit
                                </button>

                                <form action="{{ route('stadiums.destroy', $stadium->id) }}" method="POST"
                                    class="flex-1 m-0">
                                    @csrf @method('DELETE')
                                    <button type="submit"
                                        onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce terrain ?');"
                                        class="w-full flex justify-center items-center gap-2 bg-slate-50 text-slate-500 hover:bg-red-500 hover:text-white py-3 rounded-xl font-bold text-sm transition-colors">
                                        <span class="material-symbols-outlined text-[20px]">delete</span> Supprimer
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full bg-white p-12 rounded-3xl border border-slate-100 shadow-sm text-center">
                        <div
                            class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center text-slate-400 mx-auto mb-4">
                            <span class="material-symbols-outlined text-3xl">stadium</span>
                        </div>
                        <h3 class="text-lg font-bold text-slate-900 mb-2">Aucun terrain disponible</h3>
                        <p class="text-slate-500 mb-6 max-w-sm mx-auto">Vous n'avez pas encore ajouté de terrains à
                            votre arène.</p>
                        <button onclick="openCreateForm()"
                            class="inline-flex items-center space-x-2 bg-emerald-600 hover:bg-emerald-700 text-white px-6 py-3 rounded-2xl font-bold transition-colors active:scale-95 shadow-lg shadow-emerald-600/20">
                            <span class="material-symbols-outlined">add</span>
                            <span>Ajouter un terrain</span>
                        </button>
                    </div>
                @endforelse
            </div>
        </div>
    </main>

    <script>
        const formContainer = document.getElementById('stadiumFormContainer');
        const form = document.getElementById('stadiumForm');
        const formTitle = document.getElementById('formTitle');
        const submitBtn = document.getElementById('submitBtn');
        const methodSpoof = document.getElementById('methodSpoof');
        const defaultAction = "{{ route('stadiums.store') }}";

        function openCreateForm() {
            formContainer.classList.remove('hidden');
            form.reset();
            form.action = defaultAction;
            methodSpoof.innerHTML = '';

            formTitle.innerHTML =
                '<span class="material-symbols-outlined text-emerald-500">add_circle</span> Ajouter un terrain';
            submitBtn.innerText = 'Enregistrer';
            submitBtn.classList.replace('bg-blue-600', 'bg-emerald-600');
            submitBtn.classList.replace('hover:bg-blue-700', 'hover:bg-emerald-700');

            formContainer.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }

        function openEditForm(id, name, price, city, address) {
            formContainer.classList.remove('hidden');

            form.action = `/manager/terrains/${id}`;
            methodSpoof.innerHTML = '<input type="hidden" name="_method" value="PUT">';

            // 3mer l-inputs b l-ma3loumat dyal terrain
            form.querySelector('input[name="name"]').value = name;
            form.querySelector('input[name="price"]').value = price;
            form.querySelector('input[name="city"]').value = city;
            form.querySelector('input[name="address"]').value = address;

            formTitle.innerHTML =
                '<span class="material-symbols-outlined text-blue-500">edit_note</span> Modifier le Terrain';
            submitBtn.innerText = 'Enregistrer les modifications';
            submitBtn.classList.replace('bg-emerald-600', 'bg-blue-600');
            submitBtn.classList.replace('hover:bg-emerald-700', 'hover:bg-blue-700');

            formContainer.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }

        function closeForm() {
            formContainer.classList.add('hidden');
        }
    </script>
</body>

</html>
