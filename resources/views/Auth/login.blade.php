<!DOCTYPE html>
<html class="light" lang="fr">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700;800;900&display=swap"
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
    <title>KoraBooking - Connexion</title>
</head>

<body class="bg-background-light dark:bg-background-dark font-display antialiased h-screen overflow-hidden">
    <div class="flex h-screen w-full">
        <div class="hidden lg:flex lg:w-1/2 relative h-full">
            <div class="absolute inset-0 bg-cover bg-center"
                style="background-image: url('https://images.unsplash.com/photo-1574629810360-7efbbe195018?q=80&w=2000')">
            </div>
            <div class="absolute inset-0 bg-gradient-to-t from-background-dark/80 via-transparent to-transparent"></div>
            <div class="relative z-10 flex flex-col justify-end p-12 text-white">
                <h1 class="text-5xl font-black tracking-tight mb-4">KoraBooking</h1>
                <p class="text-xl max-w-md opacity-90 leading-relaxed">
                    Réservez votre terrain de sport en un clic et rejoignez la plus grande communauté de passionnés au
                    Maroc.
                </p>
            </div>
        </div>

        <div
            class="w-full lg:w-1/2 flex items-center justify-center p-6 bg-background-light dark:bg-background-dark overflow-y-auto lg:overflow-hidden">
            <div class="w-full max-w-[440px] space-y-6 py-4">
                <div class="flex flex-col items-center lg:items-start space-y-2">
                    <div
                        class="w-12 h-12 bg-primary rounded-xl flex items-center justify-center text-white mb-2 shadow-lg shadow-primary/40">
                        <svg class="w-7 h-7" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm-5.5-2.5l1.06-3.34-2.81-2.03h3.44L9.25 7l1.06 3.13h3.38l-2.73 1.98 1.05 3.26-2.76-2.01L6.5 17.5z" />
                        </svg>
                    </div>
                    <h2 class="text-2xl font-bold text-slate-900 dark:text-slate-100">Bon retour parmi nous</h2>
                    <p class="text-sm text-slate-500 dark:text-slate-400">Veuillez entrer vos coordonnées pour vous
                        connecter.</p>
                </div>

                @if ($errors->any())
                    <div class="p-3 rounded-xl bg-red-50 border border-red-200 text-red-600 text-xs">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('login') }}" method="POST" class="space-y-4">
                    @csrf
                    <div class="space-y-3">
                        <div class="flex flex-col gap-1">
                            <label for="email"
                                class="text-xs font-semibold text-slate-700 dark:text-slate-300">Email</label>
                            <input id="email" name="email" value="{{ old('email') }}" required autofocus
                                class="w-full h-11 px-4 rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-slate-100 focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all text-sm"
                                placeholder="nom@exemple.com" type="email" />
                        </div>

                        <div class="flex flex-col gap-1">
                            <div class="flex justify-between items-center">
                                <label for="password"
                                    class="text-xs font-semibold text-slate-700 dark:text-slate-300">Mot de
                                    passe</label>
                                <a class="text-xs font-medium text-primary hover:underline" href="#">Oublié ?</a>
                            </div>
                            <div class="relative">
                                <input id="password" name="password" required
                                    class="w-full h-11 px-4 rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-slate-100 focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all text-sm"
                                    placeholder="••••••••" type="password" />
                                <button
                                    class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-600"
                                    type="button" onclick="togglePassword()">
                                    <small id="toggle-text" class="font-bold text-[10px] uppercase">Show</small>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center gap-2">
                        <input class="rounded text-primary focus:ring-primary border-slate-300" id="remember"
                            name="remember" type="checkbox" />
                        <label class="text-xs text-slate-600 dark:text-slate-400" for="remember">Se souvenir de
                            moi</label>
                    </div>

                    <button type="submit"
                        class="w-full h-11 bg-primary hover:bg-primary/90 text-white font-bold rounded-xl transition-all shadow-lg shadow-primary/20 flex items-center justify-center text-sm">
                        Se connecter
                    </button>
                </form>

                <div class="relative py-2">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-slate-200 dark:border-slate-700"></div>
                    </div>
                    <div class="relative flex justify-center text-xs">
                        <span
                            class="px-4 bg-background-light dark:bg-background-dark text-slate-500 uppercase tracking-wider">Ou</span>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <button
                        class="flex items-center justify-center gap-2 h-11 border border-slate-200 dark:border-slate-700 rounded-xl bg-white dark:bg-slate-800 hover:bg-slate-50 text-sm font-medium transition-colors">
                        <svg class="w-4 h-4" viewBox="0 0 24 24">
                            <path
                                d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"
                                fill="#4285F4"></path>
                            <path
                                d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"
                                fill="#34A853"></path>
                            <path
                                d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"
                                fill="#FBBC05"></path>
                            <path
                                d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"
                                fill="#EA4335"></path>
                        </svg>
                        Google
                    </button>
                    <button
                        class="flex items-center justify-center gap-2 h-11 border border-slate-200 dark:border-slate-700 rounded-xl bg-white dark:bg-slate-800 hover:bg-slate-50 text-sm font-medium transition-colors">
                        <svg class="w-4 h-4" fill="#1877F2" viewBox="0 0 24 24">
                            <path
                                d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z">
                            </path>
                        </svg>
                        Facebook
                    </button>
                </div>

                <p class="text-center text-xs text-slate-600 dark:text-slate-400 pt-2">
                    Pas encore de compte ?
                    <a class="text-primary font-bold hover:underline" href="{{ route('register') }}">S'inscrire
                        gratuitement</a>
                </p>
            </div>
        </div>
    </div>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const toggleText = document.getElementById('toggle-text');
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleText.textContent = 'Hide';
            } else {
                passwordInput.type = 'password';
                toggleText.textContent = 'Show';
            }
        }
    </script>
</body>

</html>
