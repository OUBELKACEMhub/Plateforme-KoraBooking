<!DOCTYPE html>
<html class="light" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Réservation Confirmée - {{ config('app.name', 'KoraBooking') }}</title>

    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght@100..700,0..1&display=swap"
        rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap"
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
                    },
                    fontFamily: {
                        "display": ["Public Sans"]
                    },
                    borderRadius: {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "full": "9999px"
                    },
                },
            },
        }
    </script>
</head>

<body
    class="bg-background-light dark:bg-background-dark font-display text-slate-900 dark:text-slate-100 min-h-screen flex flex-col">

    <header
        class="sticky top-0 z-50 w-full border-b border-slate-200 dark:border-slate-800 bg-background-light/80 dark:bg-background-dark/80 backdrop-blur-md">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <a href="{{ route('dashboard') }}" class="flex items-center gap-2 cursor-pointer">
                    <div class="text-primary">
                        <span class="material-symbols-outlined text-3xl">sports_soccer</span>
                    </div>
                    <h2 class="text-xl font-bold tracking-tight text-slate-900 dark:text-white">KoraBooking</h2>
                </a>

                <div class="flex items-center gap-4">
                    <button
                        class="p-2 rounded-full text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors">
                        <span class="material-symbols-outlined">notifications</span>
                    </button>
                    <div
                        class="h-8 w-8 rounded-full bg-primary/20 flex items-center justify-center overflow-hidden border border-primary/30">
                        <img alt="Profile" class="h-full w-full object-cover" src="https://i.pravatar.cc/100" />
                    </div>
                </div>
            </div>
        </div>
    </header>

    <main class="flex-grow flex items-center justify-center p-4">
        <div
            class="max-w-md w-full bg-white dark:bg-slate-900 rounded-xl shadow-xl border border-slate-100 dark:border-slate-800 p-8 text-center">

            <div class="mb-6 flex justify-center">
                <div
                    class="h-24 w-24 bg-green-100 dark:bg-green-900/30 rounded-full flex items-center justify-center text-green-500">
                    <span class="material-symbols-outlined text-6xl font-bold">check_circle</span>
                </div>
            </div>

            <h1 class="text-3xl font-extrabold text-slate-900 dark:text-white mb-2">Réservation Confirmée !</h1>
            <p class="text-slate-500 dark:text-slate-400 mb-8">
                Votre terrain au <strong>{{ $booking->stadium->name ?? 'Urban Arena 5vs5' }}</strong> est prêt. Nous
                vous avons envoyé un email de confirmation.
            </p>

            <div
                class="bg-slate-50 dark:bg-slate-800/50 rounded-xl p-6 text-left mb-8 border border-slate-100 dark:border-slate-800">
                <h3 class="text-sm font-semibold uppercase tracking-wider text-slate-400 dark:text-slate-500 mb-4">
                    Détails de la réservation</h3>

                <div class="space-y-4">
                    <div class="flex items-start gap-3">
                        <span class="material-symbols-outlined text-primary">stadium</span>
                        <div>
                            <p class="text-xs text-slate-400 dark:text-slate-500">Stade</p>
                            <p class="font-semibold text-slate-900 dark:text-white">
                                {{ $booking->stadium->name ?? 'Urban Arena 5vs5' }}</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-3">
                        <span class="material-symbols-outlined text-primary">calendar_today</span>
                        <div>
                            <p class="text-xs text-slate-400 dark:text-slate-500">Date</p>
                            <p class="font-semibold text-slate-900 dark:text-white">
                                {{ isset($booking->date) ? \Carbon\Carbon::parse($booking->date)->translatedFormat('d F Y') : '24 Octobre 2026' }}
                            </p>
                        </div>
                    </div>

                    <div class="flex items-start gap-3">
                        <span class="material-symbols-outlined text-primary">schedule</span>
                        <div>
                            <p class="text-xs text-slate-400 dark:text-slate-500">Heure</p>
                            <p class="font-semibold text-slate-900 dark:text-white">{{ $booking->time ?? '18:00' }}</p>
                        </div>
                    </div>

                    <div
                        class="pt-4 mt-4 border-t border-slate-200 dark:border-slate-700 flex justify-between items-center">
                        <span class="font-medium text-slate-600 dark:text-slate-400">Total Payé</span>
                        <span
                            class="text-2xl font-bold text-primary">{{ number_format($booking->total_price ?? 250, 2) }}
                            DH</span>
                    </div>
                </div>
            </div>

            <div class="flex flex-col gap-3">
                <a href="#"
                    class="w-full bg-primary hover:bg-primary/90 text-white font-bold py-3.5 px-6 rounded-xl transition-all shadow-lg shadow-primary/20 flex justify-center">
                    Voir Mes Réservations
                </a>
                <a href="{{ route('dashboard') }}"
                    class="w-full bg-slate-100 dark:bg-slate-800 hover:bg-slate-200 dark:hover:bg-slate-700 text-slate-700 dark:text-slate-200 font-semibold py-3.5 px-6 rounded-xl transition-all flex justify-center">
                    Retour à l'Accueil
                </a>
            </div>

            <p class="mt-8 text-sm text-slate-400">
                Besoin d'aide ? <a class="text-primary hover:underline" href="#">Contacter le Support</a>
            </p>
        </div>
    </main>

    <footer
        class="w-full border-t border-slate-200 dark:border-slate-800 py-6 px-4 bg-background-light dark:bg-background-dark">
        <div
            class="max-w-5xl mx-auto flex flex-col md:flex-row justify-between items-center gap-4 text-sm text-slate-500">
            <div class="flex items-center gap-1">
                <span class="material-symbols-outlined text-sm">copyright</span>
                <span>{{ date('Y') }} KoraBooking. Tous droits réservés.</span>
            </div>
            <div class="flex gap-6">
                <a class="hover:text-primary" href="#">Politique de Confidentialité</a>
                <a class="hover:text-primary" href="#">Conditions d'Utilisation</a>
                <a class="hover:text-primary" href="#">Centre d'Aide</a>
            </div>
        </div>
    </footer>

</body>

</html>
