<header
    class="sticky top-0 z-50 w-full bg-white dark:bg-slate-900 border-b border-slate-200 dark:border-slate-800 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <a href="{{ route('dashboard') ?? '/' }}" class="flex items-center gap-2">
                <span class="material-symbols-outlined text-primary text-3xl">sports_soccer</span>
                <h1 class="text-xl font-extrabold tracking-tight text-slate-900 dark:text-white uppercase">Kora<span
                        class="text-primary">Booking</span></h1>
            </a>

            <nav class="hidden md:flex items-center space-x-8">
                @guest
                    <a class="text-sm font-semibold text-slate-600 dark:text-slate-300 hover:text-primary transition-colors"
                        href="/">Explorer</a>
                    <a class="text-sm font-semibold text-slate-600 dark:text-slate-300 hover:text-primary transition-colors"
                        href="#">Tarifs</a>
                @endguest

                @auth
                    @if (auth()->user()->role === 'admin')
                        <a class="text-sm font-bold text-red-600 hover:text-red-700 transition-colors"
                            href="#">Dashboard Admin</a>
                        <a class="text-sm font-semibold text-slate-600 hover:text-primary transition-colors"
                            href="#">Gestion Utilisateurs</a>
                        <a class="text-sm font-semibold text-slate-600 hover:text-primary transition-colors"
                            href="#">Validation Terrains</a>
                    @elseif(auth()->user()->role === 'manager')
                        <a class="text-sm font-bold text-blue-600 hover:text-blue-700 transition-colors" href="#">Mon
                            Espace Manager</a>
                        <a class="text-sm font-semibold text-slate-600 hover:text-primary transition-colors"
                            href="#">Mes Terrains</a>
                        <a class="text-sm font-semibold text-slate-600 hover:text-primary transition-colors"
                            href="#">Planning & Réservations</a>
                    @else
                        <a class="text-sm font-semibold text-slate-600 dark:text-slate-300 hover:text-primary transition-colors"
                            href="/">Trouver un terrain</a>
                        <a class="text-sm font-semibold text-slate-600 dark:text-slate-300 hover:text-primary transition-colors"
                            href="{{ route('reservations.index') }}">Mes Matchs</a>
                        <a class="text-sm font-semibold text-slate-600 dark:text-slate-300 hover:text-primary transition-colors"
                            href="#">Aide</a>
                    @endif
                @endauth
            </nav>

            <div class="flex items-center gap-4">
                @auth
                    <div class="flex items-center gap-4">
                        <div class="flex items-center gap-3">
                            <div class="text-right hidden sm:block">
                                <span
                                    class="block text-sm font-bold text-slate-700 dark:text-slate-200">{{ auth()->user()->name }}</span>
                                <span
                                    class="block text-[10px] font-black text-primary uppercase tracking-widest">{{ auth()->user()->role }}</span>
                            </div>

                            <div class="flex-shrink-0">
                                @if (auth()->user()->profile_image)
                                    <img class="w-10 h-10 rounded-full object-cover border-2 border-primary/20 shadow-sm"
                                        src="{{ asset('storage/' . auth()->user()->profile_image) }}"
                                        alt="Profil de {{ auth()->user()->name }}">
                                @else
                                    <div
                                        class="w-10 h-10 rounded-full bg-primary/10 border-2 border-primary/20 flex items-center justify-center text-primary font-bold shadow-sm uppercase">
                                        {{ substr(auth()->user()->name, 0, 1) }}
                                    </div>
                                @endif
                            </div>
                        </div>

                        <form action="{{ route('logout') }}" method="POST"
                            class="inline m-0 border-l border-slate-200 dark:border-slate-700 pl-4 ml-1">
                            @csrf
                            <button type="submit"
                                class="text-sm font-bold text-slate-600 dark:text-slate-300 hover:text-red-600 dark:hover:text-red-500 transition-colors">
                                Déconnexion
                            </button>
                        </form>
                    </div>
                @else
                    <a class="text-sm font-bold text-slate-700 dark:text-slate-200 hover:text-primary px-3 py-2"
                        href="{{ route('login') }}">Connexion</a>
                    <a href="{{ route('register') }}"
                        class="bg-primary hover:bg-primary/90 text-white px-5 py-2.5 rounded-xl text-sm font-bold shadow-sm transition-all">Inscription</a>
                @endauth
            </div>
        </div>
    </div>
</header>
