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
                        "background-dark": "#221610",
                    },
                    fontFamily: {
                        "display": ["Public Sans"]
                    },
                    borderRadius: {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "2xl": "1rem",
                        "full": "9999px"
                    },
                },
            },
        }
    </script>
    <title>KoraBooking - Connexion</title>
</head>

<body class="font-display antialiased h-screen overflow-hidden text-slate-800">
    <div class="flex h-screen w-full">

        <div class="hidden lg:flex lg:w-1/2 relative h-full">
            <div class="absolute inset-0 bg-cover bg-center"
                style="background-image: url('https://images.unsplash.com/photo-1574629810360-7efbbe195018?q=80&w=2000')">
            </div>
            <div
                class="absolute inset-0 bg-gradient-to-t from-background-dark/90 via-background-dark/20 to-transparent">
            </div>
            <div class="relative z-10 flex flex-col justify-end p-16 text-white pb-20">
                <h1 class="text-5xl font-black tracking-tight mb-4">KoraBooking</h1>
                <p class="text-lg max-w-md opacity-90 leading-relaxed font-medium">
                    Réservez votre terrain de sport en un clic et rejoignez la plus grande communauté de passionnés au
                    Maroc.
                </p>
            </div>
        </div>

        <div
            class="w-full lg:w-1/2 flex items-center justify-center bg-white dark:bg-slate-900 px-6 py-12 overflow-y-auto">

            <div class="w-full max-w-md space-y-8">

                <div class="flex flex-col items-start space-y-3">
                    <div class="mb-4">
                        <x-logo class="h-12 w-auto" />
                    </div>
                    <h2 class="text-3xl font-black text-slate-900 dark:text-white tracking-tight">Bon retour !</h2>
                    <p class="text-sm font-medium text-slate-500">Veuillez entrer vos identifiants pour continuer.</p>
                </div>

                @if ($errors->any())
                    <div class="p-4 rounded-xl bg-red-50 border border-red-100 text-red-600 text-sm font-medium">
                        <ul class="list-disc list-inside space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('login') }}" method="POST" class="space-y-6">
                    @csrf
                    <div class="space-y-5">
                        <div class="flex flex-col gap-1.5">
                            <label for="email" class="text-sm font-bold text-slate-700 dark:text-slate-300">Adresse
                                Email</label>
                            <input id="email" name="email" value="{{ old('email') }}" required autofocus
                                class="w-full h-12 px-4 rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-white focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all text-sm font-medium outline-none"
                                placeholder="nom@exemple.com" type="email" />
                        </div>

                        <div class="flex flex-col gap-1.5">
                            <div class="flex justify-between items-center">
                                <label for="password" class="text-sm font-bold text-slate-700 dark:text-slate-300">Mot
                                    de passe</label>
                                <a class="text-xs font-bold text-primary hover:text-primary/80 transition-colors"
                                    href="#">Oublié ?</a>
                            </div>
                            <div class="relative">
                                <input id="password" name="password" required
                                    class="w-full h-12 px-4 rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-white focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all text-sm font-medium outline-none"
                                    placeholder="••••••••" type="password" />
                                <button
                                    class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-400 hover:text-primary transition-colors"
                                    type="button" onclick="togglePassword()">
                                    <small id="toggle-text"
                                        class="font-black text-[10px] uppercase tracking-widest">Show</small>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center gap-2 pt-1">
                        <input
                            class="w-4 h-4 rounded border-slate-300 text-primary focus:ring-primary/30 transition-colors cursor-pointer"
                            id="remember" name="remember" type="checkbox" />
                        <label class="text-sm font-medium text-slate-600 dark:text-slate-400 cursor-pointer"
                            for="remember">
                            Se souvenir de moi
                        </label>
                    </div>

                    <button type="submit"
                        class="w-full h-12 bg-primary hover:bg-primary/90 text-white font-bold rounded-xl transition-all duration-200 shadow-lg shadow-primary/25 flex items-center justify-center text-sm tracking-wide">
                        Se connecter
                    </button>
                </form>

                <p class="text-center text-sm font-medium text-slate-500 dark:text-slate-400 pt-6">
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
