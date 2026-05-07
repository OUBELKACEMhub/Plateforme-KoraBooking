<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="light">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'KoraBooking') }} - Administration</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
</head>

<body class="bg-slate-50 dark:bg-slate-900 text-slate-800 dark:text-slate-200 font-sans antialiased overflow-hidden">

    <div class="flex h-screen w-full">

        <aside class="w-64 bg-slate-900 flex-shrink-0 flex flex-col transition-all duration-300 hidden md:flex">

            <div class="h-16 flex items-center justify-center px-6 border-b border-slate-600 bg-slate-600/50">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2">
                    <x-logo class="h-10 sm:h-12 w-auto" />
                </a>
            </div>

            <nav class="flex-1 overflow-y-auto py-6 px-4 space-y-2">
                <a href="{{ route('admin.dashboard') }}"
                    class="flex items-center gap-3 px-4 py-3 bg-indigo-600 text-white rounded-xl font-bold transition-all shadow-sm">
                    <span class="material-symbols-outlined text-[22px]">space_dashboard</span>
                    Tableau de bord
                </a>


                <a href="{{ route('admin.users') }}"
                    class="flex items-center gap-3 px-4 py-3 text-slate-400 hover:text-white hover:bg-slate-800 rounded-xl font-bold transition-all">
                    <span class="material-symbols-outlined text-[22px]">group</span>
                    Utilisateurs
                </a>

                <a href="{{ route('admin.stadiums') }}"
                    class="flex items-center gap-3 px-4 py-3 text-slate-400 hover:text-white hover:bg-slate-800 rounded-xl font-bold transition-all">
                    <span class="material-symbols-outlined text-[22px]">stadium</span>
                    Terrains
                </a>

                <a href="{{ route('admin.reservations') }}"
                    class="flex items-center gap-3 px-4 py-3 text-slate-400 hover:text-white hover:bg-slate-800 rounded-xl font-bold transition-all">
                    <span class="material-symbols-outlined text-[22px]">calendar_month</span>
                    Réservations
                </a>


            </nav>

            <div class="p-4 border-t border-slate-800 bg-slate-950/30">
                <form action="{{ route('logout') }}" method="POST" class="m-0">
                    @csrf
                    <button type="submit"
                        class="w-full flex items-center justify-center gap-2 px-4 py-2.5 text-red-400 hover:text-white hover:bg-red-500/20 rounded-xl font-bold transition-all text-sm">
                        <span class="material-symbols-outlined text-[20px]">logout</span>
                        Déconnexion
                    </button>
                </form>
            </div>
        </aside>

        <div class="flex-1 flex flex-col overflow-hidden relative">

            <header
                class="h-16 bg-white dark:bg-slate-900 border-b border-slate-200 dark:border-slate-800 flex items-center justify-between px-4 sm:px-6 z-20">

                <!-- L-issr d Navbar (Titre awla Menu Mobile) -->
                <div>
                    <button class="md:hidden text-slate-500 hover:text-indigo-600 transition-colors">
                        <span class="material-symbols-outlined text-2xl">menu</span>
                    </button>
                    <span class="hidden md:block font-bold text-slate-700 dark:text-slate-200">Espace
                        Administration</span>
                </div>

                <div class="flex items-center gap-4 sm:gap-6">
                    <div class="flex items-center gap-2 border-r border-slate-200 dark:border-slate-700 pr-4 sm:pr-6">

                        <div class="relative pt-1">
                            <button onclick="document.getElementById('adminNotifDropdown').classList.toggle('hidden')"
                                class="relative p-2 text-slate-500 hover:text-indigo-600 bg-transparent hover:bg-indigo-50 dark:hover:bg-indigo-900/40 rounded-xl transition-all active:scale-95 focus:outline-none flex items-center justify-center">
                                <span class="material-symbols-outlined text-[22px]">notifications</span>
                                @if (auth()->user()->unreadNotifications->count() > 0)
                                    <span class="absolute top-1.5 right-1.5 flex h-2.5 w-2.5">
                                        <span
                                            class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                                        <span
                                            class="relative inline-flex rounded-full h-2.5 w-2.5 bg-red-500 border-2 border-white"></span>
                                    </span>
                                @endif
                            </button>

                            <!-- Menu déroulant notif... (Mkhbi) -->
                            <div id="adminNotifDropdown"
                                class="hidden absolute right-0 mt-3 w-80 bg-white dark:bg-slate-900 rounded-xl shadow-2xl border border-slate-100 overflow-hidden z-50">
                                <div class="p-4 text-center text-sm text-slate-500">Pas de nouvelles notifications.
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center gap-3">
                        <div class="hidden sm:block text-right">
                            <span class="block text-sm font-bold text-slate-700 dark:text-slate-200 leading-tight">
                                {{ auth()->user()->name }}
                            </span>
                            <span class="block text-[10px] font-black text-indigo-500 uppercase tracking-widest">
                                Administrateur
                            </span>
                        </div>
                        <div
                            class="h-10 w-10 rounded-xl overflow-hidden border-2 border-indigo-200 bg-indigo-600 text-white flex items-center justify-center font-bold">
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        </div>
                    </div>
                </div>
            </header>

            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-slate-50 dark:bg-slate-950 p-4 sm:p-6 lg:p-8">
                <!-- Had $slot hiya li kay-t-injekta fiha l-contenu dyal ay page khra -->
                {{ $slot }}
            </main>

        </div>
    </div>

</body>

</html>
