<!DOCTYPE html>
<html class="light" lang="fr">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <script src="https://cdn.tailwindcss.com?plugins=forms"></script>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@700;800&family=Inter:wght@400;500;600&display=swap"
        rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0"
        rel="stylesheet" />

    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#003527",
                        "primary-container": "#064e3b",
                        "on-primary-container": "#80bea6",
                        "secondary-container": "#f97316",
                        "surface": "#f8f9fb",
                        "outline-variant": "#bfc9c3",
                        "on-surface": "#191c1e",
                        "on-surface-variant": "#404944",
                        "surface-container-lowest": "#ffffff",
                    },
                    fontFamily: {
                        "headline": ["Manrope"],
                        "body": ["Inter"]
                    },
                    borderRadius: {
                        "xl": "1.5rem"
                    },
                },
            },
        }
    </script>
    <style>
        html,
        body {
            height: 100%;
            margin: 0;
            overflow: hidden;
        }

        .material-symbols-outlined {
            display: inline-block;
            vertical-align: middle;
            line-height: 1;
        }

        .text-shadow-hero {
            text-shadow: 0 4px 12px rgba(0, 0, 0, 0.5);
        }
    </style>
    <title>KoraBooking - Inscription</title>
</head>

<body class="bg-surface font-body text-on-surface antialiased">

    <main class="flex h-screen w-full overflow-hidden">
        <section class="hidden lg:flex lg:w-1/2 relative h-full overflow-hidden bg-primary-container">
            <div class="absolute inset-0 z-0">
                <img alt="Pitch" class="h-full w-full object-cover mix-blend-overlay opacity-60"
                    src="https://images.unsplash.com/photo-1574629810360-7efbbe195018?q=80&w=2000" />
            </div>
            <div
                class="relative z-10 flex flex-col justify-end p-16 w-full h-full bg-gradient-to-t from-primary-container via-transparent to-transparent">
                <div class="max-w-md text-white">
                    <h1 class="font-headline text-5xl font-extrabold tracking-tight mb-4 text-shadow-hero">KoraBooking
                    </h1>
                    <p class="text-on-primary-container text-xl font-medium leading-relaxed opacity-90">
                        Réservez votre terrain en un clic et rejoignez +5,000 passionnés au Maroc.
                    </p>
                </div>
                <div class="mt-12 flex items-center gap-4">
                    <div class="flex -space-x-3">
                        <img class="w-10 h-10 rounded-full border-2 border-primary-container"
                            src="https://i.pravatar.cc/100?u=1" />
                        <img class="w-10 h-10 rounded-full border-2 border-primary-container"
                            src="https://i.pravatar.cc/100?u=2" />
                    </div>
                    <p class="text-white text-[10px] font-black tracking-[0.2em] uppercase">Vibrez Football</p>
                </div>
            </div>
        </section>

        <section class="w-full lg:w-1/2 flex items-center justify-center p-8 bg-surface h-full">
            <div class="w-full max-w-[420px] space-y-6">

                <div class="space-y-1 text-center lg:text-left">
                    <h2 class="font-headline text-4xl font-extrabold text-on-surface tracking-tight">Créer un compte
                    </h2>
                    <p class="text-on-surface-variant font-medium text-sm">Le terrain vous attend, inscrivez-vous.</p>
                </div>

                @if ($errors->any())
                    <div class="p-3 rounded-xl bg-red-50 border-l-4 border-red-500 text-red-700 text-xs">
                        @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                @endif

                <form action="{{ route('register') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                    @csrf

                    <div class="space-y-1.5">
                        <label
                            class="block text-[10px] font-black text-on-surface-variant uppercase tracking-[0.15em]">Nom
                            complet</label>
                        <div class="relative">
                            <span
                                class="absolute left-4 top-1/2 -translate-y-1/2 text-outline-variant material-symbols-outlined text-[20px] pointer-events-none">person</span>
                            <input
                                class="w-full pl-12 pr-4 py-3.5 bg-surface-container-lowest border-none ring-1 ring-outline-variant/30 rounded-xl focus:ring-2 focus:ring-primary transition-all outline-none"
                                name="name" value="{{ old('name') }}" placeholder="Ahmed Oubelkacem" type="text"
                                required />
                        </div>
                    </div>

                    <div class="space-y-1.5">
                        <label
                            class="block text-[10px] font-black text-on-surface-variant uppercase tracking-[0.15em]">Email</label>
                        <div class="relative">
                            <span
                                class="absolute left-4 top-1/2 -translate-y-1/2 text-outline-variant material-symbols-outlined text-[20px] pointer-events-none">mail</span>
                            <input
                                class="w-full pl-12 pr-4 py-3.5 bg-surface-container-lowest border-none ring-1 ring-outline-variant/30 rounded-xl focus:ring-2 focus:ring-primary transition-all outline-none"
                                name="email" value="{{ old('email') }}" placeholder="nom@exemple.com" type="email"
                                required />
                        </div>
                    </div>

                    <div class="space-y-1.5">
                        <label
                            class="block text-[10px] font-black text-on-surface-variant uppercase tracking-[0.15em]">Image
                            de profil <span
                                class="lowercase tracking-normal font-normal text-outline-variant">(Optionnel)</span></label>
                        <div class="relative">
                            <span
                                class="absolute left-4 top-1/2 -translate-y-1/2 text-outline-variant material-symbols-outlined text-[20px] pointer-events-none">add_a_photo</span>
                            <input
                                class="w-full pl-12 pr-4 py-2.5 bg-surface-container-lowest border-none ring-1 ring-outline-variant/30 rounded-xl focus:ring-2 focus:ring-primary transition-all outline-none text-sm text-on-surface-variant file:mr-4 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-[10px] file:font-bold file:uppercase file:tracking-wider file:bg-primary/10 file:text-primary hover:file:bg-primary/20 file:cursor-pointer cursor-pointer"
                                name="profile_image" type="file" accept="image/*" />
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-3">
                        <div class="space-y-1.5">
                            <label
                                class="block text-[10px] font-black text-on-surface-variant uppercase tracking-[0.15em]">Mot
                                de passe</label>
                            <input
                                class="w-full px-4 py-3.5 bg-surface-container-lowest border-none ring-1 ring-outline-variant/30 rounded-xl focus:ring-2 focus:ring-primary transition-all outline-none"
                                name="password" placeholder="••••••••" type="password" required />
                        </div>
                        <div class="space-y-1.5">
                            <label
                                class="block text-[10px] font-black text-on-surface-variant uppercase tracking-[0.15em]">Confirmer</label>
                            <input
                                class="w-full px-4 py-3.5 bg-surface-container-lowest border-none ring-1 ring-outline-variant/30 rounded-xl focus:ring-2 focus:ring-primary transition-all outline-none"
                                name="password_confirmation" placeholder="••••••••" type="password" required />
                        </div>
                    </div>

                    <button
                        class="w-full py-4 bg-secondary-container text-white font-black rounded-xl shadow-xl shadow-secondary-container/20 hover:scale-[1.02] active:scale-[0.98] transition-all flex items-center justify-center gap-2 uppercase tracking-widest text-xs"
                        type="submit">
                        S'inscrire <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
                    </button>

                    <div class="relative py-2 flex items-center">
                        <div class="flex-grow border-t border-outline-variant/10"></div>
                        <span
                            class="flex-shrink mx-4 text-[9px] font-black text-on-surface-variant uppercase tracking-tighter">Accès
                            Rapide</span>
                        <div class="flex-grow border-t border-outline-variant/10"></div>
                    </div>

                    <div class="grid grid-cols-2 gap-3">
                        <button
                            class="flex items-center justify-center gap-2 py-3 bg-surface-container-lowest ring-1 ring-outline-variant/10 rounded-xl hover:bg-gray-50 transition-all font-bold text-[11px] text-on-surface"
                            type="button">
                            <img src="https://www.svgrepo.com/show/475656/google-color.svg" class="w-4 h-4"
                                alt=""> Google
                        </button>
                        <button
                            class="flex items-center justify-center gap-2 py-3 bg-surface-container-lowest ring-1 ring-outline-variant/10 rounded-xl hover:bg-gray-50 transition-all font-bold text-[11px] text-on-surface"
                            type="button">
                            <img src="https://www.svgrepo.com/show/475647/facebook-color.svg" class="w-4 h-4"
                                alt=""> Facebook
                        </button>
                    </div>

                    <p class="text-center text-on-surface-variant font-bold text-xs pt-2">
                        Déjà membre ? <a class="text-primary hover:underline underline-offset-4 ml-1"
                            href="{{ route('login') }}">Se connecter</a>
                    </p>
                </form>

                <footer class="pt-4 opacity-30 text-center">
                    <p class="text-[8px] font-black tracking-[0.3em] uppercase text-on-surface">© 2026 KoraBooking. Pure
                        Football.</p>
                </footer>
            </div>
        </section>
    </main>

</body>

</html>
