<header
    class="sticky top-0 z-50 w-full bg-white dark:bg-slate-900 border-b border-slate-200 dark:border-slate-800 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">

            <a href="{{ route('dashboard') ?? '/' }}" class="flex items-center">
                <x-logo class="h-10 sm:h-12 w-auto" />
            </a>

            <nav class="hidden md:flex items-center space-x-8">
                @guest
                    <a class="text-sm font-semibold text-slate-600 dark:text-slate-300 hover:text-primary transition-colors"
                        href="/">Explorer</a>
                    <a class="text-sm font-semibold text-slate-600 dark:text-slate-300 hover:text-primary transition-colors"
                        href="#">Tarifs</a>
                @endguest

                @auth
                    <a class="text-sm font-semibold text-slate-600 dark:text-slate-300 hover:text-primary transition-colors"
                        href="/">Trouver un terrain</a>
                    <a class="text-sm font-semibold text-slate-600 dark:text-slate-300 hover:text-primary transition-colors"
                        href="{{ route('reservations.index') ?? '#' }}">Mes Matchs</a>
                    <a class="text-sm font-semibold text-slate-600 dark:text-slate-300 hover:text-primary transition-colors"
                        href="{{ route('aide.index') ?? '#' }}">Aide</a>
                @endauth
            </nav>

            <div class="flex items-center gap-4">
                @auth
                    <div class="flex items-center gap-5">

                        <!-- 🔥 ICONE NOTIFICATIONS AVEC MENU DÉROULANT 🔥 -->
                        <div class="relative pt-1">
                            <!-- 1. Bouton de la cloche (Fih onclick bach i-7ell l-menu) -->
                            <button onclick="document.getElementById('notifDropdown').classList.toggle('hidden')"
                                class="relative flex items-center justify-center text-slate-500 dark:text-slate-400 hover:text-primary transition-colors focus:outline-none">
                                <span class="material-symbols-outlined text-[26px]">notifications</span>

                                <!-- L-point l-7mra katban ghir ila kaynin notifications jdad -->
                                @if (auth()->user()->unreadNotifications->count() > 0)
                                    <span class="absolute top-0 right-0 flex h-2.5 w-2.5">
                                        <span
                                            class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                                        <span
                                            class="relative inline-flex rounded-full h-2.5 w-2.5 bg-red-500 border-2 border-white dark:border-slate-900"></span>
                                    </span>
                                @endif
                            </button>

                            <div id="notifDropdown"
                                class="hidden absolute right-0 mt-3 w-80 bg-white dark:bg-slate-900 rounded-xl shadow-xl border border-slate-200 dark:border-slate-700 overflow-hidden z-50 origin-top-right">

                                <div
                                    class="flex items-center justify-between px-4 py-3 border-b border-slate-100 dark:border-slate-800 bg-slate-50 dark:bg-slate-800/50">
                                    <h3 class="font-bold text-sm text-slate-800 dark:text-slate-100">Notifications</h3>
                                    @if (auth()->user()->unreadNotifications->count() > 0)
                                        <span
                                            class="bg-primary/10 text-primary text-[10px] font-black px-2 py-0.5 rounded-full">
                                            {{ auth()->user()->unreadNotifications->count() }} NOUVELLE(S)
                                        </span>
                                    @endif
                                </div>

                                <div class="max-h-[300px] overflow-y-auto divide-y divide-slate-100 dark:divide-slate-800">

                                    @forelse(auth()->user()->unreadNotifications as $notification)
                                        <div class="p-4 hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-colors">
                                            <div class="flex gap-3">
                                                <div class="flex-shrink-0 mt-0.5">
                                                    <div
                                                        class="w-8 h-8 rounded-full bg-green-100 text-green-600 flex items-center justify-center">
                                                        <span
                                                            class="material-symbols-outlined text-[16px]">check_circle</span>
                                                    </div>
                                                </div>
                                                <div>
                                                    <p class="text-sm font-bold text-slate-800 dark:text-slate-200 mb-1">
                                                        Réservation Approuvée !
                                                    </p>
                                                    <!-- L-message li siftna f l-Backend -->
                                                    <p class="text-xs text-slate-500 dark:text-slate-400 leading-relaxed">
                                                        {{ $notification->data['message'] }}
                                                    </p>
                                                    <!-- L-we9t ch7al hadi (ex: il y a 2 heures) -->
                                                    <p
                                                        class="text-[10px] font-bold text-slate-400 mt-2 uppercase tracking-wider">
                                                        {{ $notification->created_at->diffForHumans() }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <div
                                            class="p-6 text-center text-slate-500 dark:text-slate-400 flex flex-col items-center gap-2">
                                            <span
                                                class="material-symbols-outlined text-4xl opacity-20">notifications_paused</span>
                                            <p class="text-sm">Vous n'avez aucune notification.</p>
                                        </div>
                                    @endforelse
                                </div>

                                <!-- Ta7t dyal l-Menu (Bouton Marquer comme lu) -->
                                @if (auth()->user()->unreadNotifications->count() > 0)
                                    <div
                                        class="p-2 border-t border-slate-100 dark:border-slate-800 bg-slate-50 dark:bg-slate-800/50">
                                        <form action="{{ route('notifications.read') }}" method="POST" class="m-0">
                                            @csrf
                                            <button type="submit"
                                                class="w-full text-center text-xs font-bold text-primary hover:text-primary/80 py-2 transition-colors">
                                                Marquer tout comme lu
                                            </button>
                                        </form>
                                    </div>
                                @endif
                            </div>
                        </div>


                        <div class="flex items-center gap-3 border-l border-slate-200 dark:border-slate-700 pl-5">
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
                            <div
                                class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-xs font-black flex items-center gap-1 shadow-sm">
                                <span class="material-symbols-outlined text-[14px]">account_balance_wallet</span>
                                {{ number_format(auth()->user()->wallet_balance, 2) }} DH
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
                    <div class="flex items-center gap-4">
                        <a class="text-sm font-bold text-slate-700 dark:text-slate-200 hover:text-primary px-3 py-2"
                            href="{{ route('login') }}">Connexion</a>
                        <a href="{{ route('register') }}"
                            class="bg-primary hover:bg-primary/90 text-white px-5 py-2.5 rounded-xl text-sm font-bold shadow-sm transition-all">Inscription</a>
                    </div>
                @endauth
            </div>
        </div>
    </div>
</header>
