<aside
    class="w-72 bg-white border-r border-slate-100 flex flex-col h-full shrink-0 shadow-[4px_0_24px_rgba(0,0,0,0.02)] z-50 transition-all duration-300">

    <div class="h-24 flex items-center px-8 border-b border-slate-100/80">
        <x-logo class="h-10 sm:h-12 w-auto" />
        <span
            class="ml-3 bg-emerald-50 text-emerald-700 border border-emerald-200/50 text-[10px] font-black px-2.5 py-1 rounded-md uppercase tracking-wider shadow-sm">
            Manager
        </span>
    </div>

    <nav class="flex-1 px-5 py-8 space-y-2 overflow-y-auto no-scrollbar">
        <p class="px-3 text-[11px] font-black text-slate-400 uppercase tracking-widest mb-4">Menu Principal</p>

        {{-- Dashboard Link --}}
        <a class="flex items-center space-x-3 px-4 py-3.5 rounded-2xl font-semibold transition-all duration-200 group {{ request()->routeIs('manager.dashboard') ? 'bg-emerald-700 text-white shadow-lg shadow-emerald-700/20' : 'text-slate-500 hover:bg-slate-50 hover:text-emerald-700' }}"
            href="{{ route('manager.dashboard') ?? '#' }}">
            <svg class="h-5 w-5 transition-transform group-hover:scale-110" fill="none" stroke="currentColor"
                viewBox="0 0 24 24">
                <path
                    d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"
                    stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
            </svg>
            <span>Tableau de bord</span>
        </a>

        {{-- My Pitches Link --}}
        <a class="flex items-center space-x-3 px-4 py-3.5 rounded-2xl font-semibold transition-all duration-200 group {{ request()->routeIs('manager.stadiums*') ? 'bg-emerald-700 text-white shadow-lg shadow-emerald-700/20' : 'text-slate-500 hover:bg-slate-50 hover:text-emerald-700' }}"
            href="{{ route('manager.stadiums') }}">
            <svg class="h-5 w-5 transition-transform group-hover:scale-110" fill="none" stroke="currentColor"
                viewBox="0 0 24 24">
                <path
                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"
                    stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
            </svg>
            <span>Mes Terrains</span>
        </a>

        {{-- Offers Link --}}
        <a class="flex items-center space-x-3 px-4 py-3.5 rounded-2xl font-semibold transition-all duration-200 group {{ request()->routeIs('manager.offers*') ? 'bg-emerald-700 text-white shadow-lg shadow-emerald-700/20' : 'text-slate-500 hover:bg-slate-50 hover:text-emerald-700' }}"
            href="{{ route('manager.offers') }}">
            <svg class="h-5 w-5 transition-transform group-hover:scale-110" fill="none" stroke="currentColor"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z">
                </path>
            </svg>
            <span>Offres & Promos</span>
        </a>

        {{-- Reviews Link --}}
        <a class="flex items-center space-x-3 px-4 py-3.5 rounded-2xl font-semibold transition-all duration-200 group {{ request()->routeIs('manager.reviews*') ? 'bg-emerald-700 text-white shadow-lg shadow-emerald-700/20' : 'text-slate-500 hover:bg-slate-50 hover:text-emerald-700' }}"
            href="{{ route('manager.reviews') }}">
            <svg class="h-5 w-5 transition-transform group-hover:scale-110" fill="none" stroke="currentColor"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
            </svg>
            <span>Avis Clients</span>
        </a>
    </nav>

    <div class="p-5">
        <div class="bg-slate-50 rounded-3xl p-4 border border-slate-100 shadow-sm">
            <div class="flex items-center space-x-3 mb-4">
                <div
                    class="w-11 h-11 rounded-full bg-emerald-100 border-2 border-white shadow-sm overflow-hidden flex items-center justify-center text-emerald-700 font-black text-lg">
                    @if (auth()->check() && auth()->user()->profile_image)
                        <img alt="Manager Profile" class="w-full h-full object-cover"
                            src="{{ asset('storage/' . auth()->user()->profile_image) }}" />
                    @else
                        {{ substr(auth()->user()->name ?? 'M', 0, 1) }}
                    @endif
                </div>
                <div class="flex-1 overflow-hidden">
                    <p class="text-sm font-bold text-slate-800 truncate">{{ auth()->user()->name ?? 'Manager' }}</p>
                    <p class="text-xs font-semibold text-emerald-600 truncate">
                        {{ auth()->user()->email ?? 'Compte Gérant' }}</p>
                </div>
            </div>

            <form action="{{ route('logout') ?? '#' }}" method="POST" class="m-0">
                @csrf
                <button type="submit"
                    class="w-full flex justify-center items-center space-x-2 bg-white border border-slate-200 text-slate-600 hover:bg-red-50 hover:text-red-600 hover:border-red-100 px-4 py-2.5 rounded-xl font-bold transition-all text-sm group">
                    <svg class="h-4 w-4 transition-transform group-hover:-translate-x-1" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                        </path>
                    </svg>
                    <span>Déconnexion</span>
                </button>
            </form>
        </div>
    </div>
</aside>
