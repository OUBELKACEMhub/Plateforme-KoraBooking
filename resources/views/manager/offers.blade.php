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

<body class="bg-surface text-on-surface flex overflow-hidden">

    {{-- SIDEBAR COMPONENT --}}
    <aside class="w-64 fixed left-0 top-0 z-50 bg-white border-r border-gray-200 flex flex-col h-screen shrink-0">
        <div class="p-6 border-b border-gray-100 flex items-center space-x-2">
            <div class="w-8 h-8 bg-green-600 rounded-lg flex items-center justify-center">
                <span class="text-white font-bold text-xl">K</span>
            </div>
            <h1 class="text-xl font-bold text-gray-800 tracking-tight">KoraBooking</h1>
        </div>

        <nav class="flex-1 p-4 space-y-1 overflow-y-auto no-scrollbar">
            <a class="flex items-center space-x-3 text-gray-500 hover:bg-gray-50 px-4 py-3 rounded-xl font-medium transition-colors"
                href="{{ route('manager.dashboard') ?? '#' }}">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path
                        d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"
                        stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                </svg>
                <span>Dashboard</span>
            </a>

            <a class="flex items-center space-x-3 text-gray-500 hover:bg-gray-50 px-4 py-3 rounded-xl font-medium transition-colors"
                href="{{ route('manager.stadiums') ?? '#' }}">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path
                        d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"
                        stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                </svg>
                <span>My Pitches</span>
            </a>

            <a class="flex items-center space-x-3 text-gray-500 hover:bg-gray-50 px-4 py-3 rounded-xl font-medium transition-colors"
                href="{{ route('manager.reviews') ?? '#' }}">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                    </path>
                </svg>
                <span>Reviews</span>
            </a>

            <a class="flex items-center space-x-3 bg-green-50 text-green-700 px-4 py-3 rounded-xl font-medium transition-colors"
                href="{{ route('manager.offers') ?? '#' }}">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z">
                    </path>
                </svg>
                <span>Offres & Promotions</span>
            </a>
        </nav>

        <div class="p-4 border-t border-gray-100">
            <div class="flex items-center space-x-3 mb-4">
                <div
                    class="w-10 h-10 rounded-full bg-gray-200 overflow-hidden flex items-center justify-center text-green-700 font-bold">
                    @if (auth()->check() && auth()->user()->profile_image)
                        <img alt="Manager Profile" class="w-full h-full object-cover"
                            src="{{ asset('storage/' . auth()->user()->profile_image) }}" />
                    @else
                        {{ substr(auth()->user()->name ?? 'M', 0, 1) }}
                    @endif
                </div>
                <div>
                    <p class="text-sm font-semibold text-gray-800">{{ auth()->user()->name ?? 'Manager' }}</p>
                    <p class="text-xs text-gray-500 uppercase">{{ auth()->user()->role ?? 'ADMIN' }}</p>
                </div>
            </div>

            <form action="{{ route('logout') ?? '#' }}" method="POST" class="m-0">
                @csrf
                <button type="submit"
                    class="w-full flex items-center space-x-3 text-gray-500 hover:bg-red-50 hover:text-red-600 px-4 py-2 rounded-lg font-medium transition-colors text-sm">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                        </path>
                    </svg>
                    <span>Déconnexion</span>
                </button>
            </form>
        </div>
    </aside>

    <main class="flex-grow ml-64 min-h-screen relative">
        {{-- TOP HEADER COMPONENT --}}
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
            <div class="flex items-center gap-6">
                <div class="flex items-center gap-4">
                    <button
                        class="p-2 text-slate-500 hover:bg-slate-50 dark:hover:bg-emerald-900/40 rounded-full transition-colors active:scale-95">
                        <span class="material-symbols-outlined">notifications</span>
                    </button>
                    <button
                        class="p-2 text-slate-500 hover:bg-slate-50 dark:hover:bg-emerald-900/40 rounded-full transition-colors active:scale-95">
                        <span class="material-symbols-outlined">help_outline</span>
                    </button>
                </div>
                <div
                    class="h-10 w-10 rounded-full overflow-hidden border-2 border-emerald-100 cursor-pointer flex items-center justify-center bg-green-600 text-white font-bold">
                    @if (auth()->check() && auth()->user()->profile_image)
                        <img alt="Manager profile" class="object-cover w-full h-full"
                            src="{{ asset('storage/' . auth()->user()->profile_image) }}" />
                    @else
                        {{ substr(auth()->user()->name ?? 'M', 0, 1) }}
                    @endif
                </div>
            </div>
        </header>

        <section class="p-8 max-w-7xl mx-auto space-y-10">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div
                    class="bg-surface-container-lowest p-6 rounded-xl border border-outline-variant/15 flex flex-col justify-between h-40">
                    <div class="flex justify-between items-start">
                        <div class="bg-primary-fixed/30 p-2 rounded-lg">
                            <span class="material-symbols-outlined text-primary-container">campaign</span>
                        </div>
                        <span
                            class="text-xs font-semibold text-on-tertiary-container bg-tertiary-fixed/20 px-2 py-1 rounded">+12%
                            vs last month</span>
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
                            <h4 class="text-green-50 text-sm font-medium">Total Revenue from Promotions</h4>
                            <p class="text-3xl font-bold tracking-tight">KSh 142,500</p>
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
                        <p class="text-3xl font-bold text-primary tracking-tight">03 <span
                                class="text-sm font-normal text-slate-400 ml-1">in next 48h</span></p>
                    </div>
                </div>
            </div>

            {{-- CREATE NEW OFFER SECTION --}}
            <div class="grid grid-cols-1 lg:grid-cols-5 gap-8">
                <div class="lg:col-span-3 bg-surface-container-lowest rounded-xl p-8 shadow-sm border border-gray-100">
                    <h2 class="text-xl font-bold text-primary mb-6 flex items-center gap-2">
                        <span class="material-symbols-outlined text-green-600">add_circle</span>
                        Create New Offer
                    </h2>

                    <form action="#" method="POST" class="space-y-6">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label class="text-xs font-bold uppercase tracking-wider text-slate-500">Offer
                                    Name</label>
                                <input name="name"
                                    class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 focus:ring-2 focus:ring-green-500/20 focus:border-green-500 transition-all outline-none"
                                    placeholder="e.g. Weekend Warrior Flash Sale" type="text" required />
                            </div>
                            <div class="space-y-2">
                                <label class="text-xs font-bold uppercase tracking-wider text-slate-500">Offer
                                    Type</label>
                                <select name="type"
                                    class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 focus:ring-2 focus:ring-green-500/20 focus:border-green-500 transition-all outline-none appearance-none">
                                    <option value="flash">Flash Sale</option>
                                    <option value="seasonal">Seasonal Discount</option>
                                    <option value="welcome">New User Welcome</option>
                                    <option value="loyalty">Loyalty Reward</option>
                                </select>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label class="text-xs font-bold uppercase tracking-wider text-slate-500">Discount
                                    Percentage</label>
                                <div class="relative">
                                    <input name="discount_percentage"
                                        class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 focus:ring-2 focus:ring-green-500/20 focus:border-green-500 transition-all outline-none"
                                        placeholder="20" type="number" min="1" max="100" />
                                    <span
                                        class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-400 font-bold">%</span>
                                </div>
                            </div>
                            <div class="space-y-2">
                                <label class="text-xs font-bold uppercase tracking-wider text-slate-500">Pitch
                                    Type</label>
                                <div class="flex gap-2 flex-wrap">
                                    <span
                                        class="bg-green-600 text-white text-xs font-bold px-3 py-1.5 rounded-full cursor-pointer">All
                                        Pitches</span>
                                    <span
                                        class="bg-green-50 text-green-700 text-xs font-bold px-3 py-1.5 rounded-full cursor-pointer hover:bg-green-100 transition-colors border border-green-200">5-A-Side</span>
                                    <span
                                        class="bg-green-50 text-green-700 text-xs font-bold px-3 py-1.5 rounded-full cursor-pointer hover:bg-green-100 transition-colors border border-green-200">11-A-Side</span>
                                </div>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label class="text-xs font-bold uppercase tracking-wider text-slate-500">Start
                                    Date</label>
                                <input name="start_date"
                                    class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 focus:ring-2 focus:ring-green-500/20 focus:border-green-500 transition-all outline-none"
                                    type="date" />
                            </div>
                            <div class="space-y-2">
                                <label class="text-xs font-bold uppercase tracking-wider text-slate-500">End
                                    Date</label>
                                <input name="end_date"
                                    class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 focus:ring-2 focus:ring-green-500/20 focus:border-green-500 transition-all outline-none"
                                    type="date" />
                            </div>
                        </div>

                        <button
                            class="w-full bg-green-600 text-white py-4 rounded-xl font-bold text-lg hover:bg-green-700 hover:shadow-lg hover:shadow-green-600/20 transition-all active:scale-95"
                            type="submit">
                            Launch Promotion
                        </button>
                    </form>
                </div>

                <div class="lg:col-span-2 relative rounded-xl overflow-hidden group h-full min-h-[400px]">
                    <img alt="Stadium lights"
                        class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                        src="https://images.unsplash.com/photo-1518605368461-1ee125b42d76?q=80&w=1000&auto=format&fit=crop" />
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

            {{-- CURRENT OFFERS GRID --}}
            <div class="space-y-6">
                <div class="flex justify-between items-center">
                    <h2 class="text-2xl font-extrabold text-gray-800 tracking-tight">Active Campaigns</h2>
                    <div class="flex gap-2">
                        <button
                            class="bg-white border border-gray-200 p-2 rounded-lg hover:bg-gray-50 transition-colors">
                            <span class="material-symbols-outlined text-gray-600">filter_list</span>
                        </button>
                        <button
                            class="bg-white border border-gray-200 p-2 rounded-lg hover:bg-gray-50 transition-colors">
                            <span class="material-symbols-outlined text-gray-600">sort</span>
                        </button>
                    </div>
                </div>

                <div class="grid grid-cols-1 gap-4">

                    {{-- CORRECT SYNTAX: No curly braces around @foreach --}}
                    @foreach ($offers as $offer)
                        @php
                            // Logique d'affichage selon le statut et le type
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
                            class="bg-white p-6 rounded-xl border border-gray-200 flex flex-wrap md:flex-nowrap items-center gap-6 group hover:shadow-md hover:border-{{ $colorTheme }}-200 transition-all {{ $isPast ? 'opacity-75' : '' }}">

                            <div
                                class="w-16 h-16 bg-{{ $colorTheme }}-50 rounded-full flex items-center justify-center flex-shrink-0 text-{{ $colorTheme }}-600">
                                <span class="material-symbols-outlined text-3xl">{{ $icon }}</span>
                            </div>

                            <div class="flex-grow">
                                <h4 class="font-bold text-gray-800 text-lg">{{ ucfirst($offer->type) }} Offer</h4>
                                <p class="text-gray-500 text-sm">Applied to your Pitches</p>
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

                                    <div class="flex gap-3 opacity-0 group-hover:opacity-100 transition-opacity">
                                        <button class="text-gray-400 hover:text-blue-600 transition-colors">
                                            <span class="material-symbols-outlined">edit</span>
                                        </button>
                                        <button class="text-gray-400 hover:text-red-500 transition-colors">
                                            <span class="material-symbols-outlined">delete</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    @if ($offers->isEmpty())
                        <div class="text-center py-10 text-gray-500 bg-gray-50 rounded-xl border border-gray-200">
                            <span class="material-symbols-outlined text-4xl mb-2 text-gray-400">inbox</span>
                            <p>You haven't created any offers yet.</p>
                        </div>
                    @endif

                </div>
            </div>
        </section>
    </main>
</body>

</html>
