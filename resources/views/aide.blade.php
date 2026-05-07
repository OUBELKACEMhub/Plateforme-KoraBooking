<x-layout title="Aide - KoraBooking">
    <div class="min-h-screen bg-background-light dark:bg-background-dark">
        <!-- HERO SECTION -->
        <section
            class="relative bg-gradient-to-br from-primary to-green-700 text-white py-20 px-4 md:px-12 overflow-hidden">
            <div class="absolute inset-0 opacity-10">
                <div class="absolute inset-0"
                    style="background-image: radial-gradient(#ffffff 2px, transparent 2px); background-size: 30px 30px;">
                </div>
            </div>
            <div class="relative z-10 max-w-4xl mx-auto text-center">
                <div class="mb-4">
                    <span class="material-symbols-outlined text-6xl">help_center</span>
                </div>
                <h1 class="font-bold text-4xl md:text-5xl mb-4 tracking-tight">
                    Comment pouvons-nous vous aider ?
                </h1>
                <p class="text-lg max-w-2xl mx-auto opacity-95 leading-relaxed">
                    Découvrez comment utiliser KoraBooking, réserver votre terrain idéal et gérer votre portefeuille en
                    toute simplicité.
                </p>
            </div>
        </section>

        <!-- MAIN CONTENT -->
        <main class="max-w-5xl mx-auto px-4 md:px-12 -mt-12 relative z-20 pb-16 space-y-8">

            <!-- BOOKING STEPS -->
            <section
                class="bg-white dark:bg-slate-800 rounded-2xl p-8 shadow-sm border border-slate-200 dark:border-slate-700">
                <h2 class="font-bold text-2xl text-primary dark:text-green-400 mb-6 flex items-center gap-3">
                    <span class="material-symbols-outlined">sports_soccer</span>
                    Comment réserver un terrain ?
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Step 1 -->
                    <div
                        class="bg-slate-50 dark:bg-slate-700 p-6 rounded-xl relative overflow-hidden group hover:shadow-md hover:-translate-y-1 transition-all cursor-pointer">
                        <div
                            class="text-6xl font-black text-slate-200 dark:text-slate-600 absolute -right-2 -bottom-4 group-hover:text-primary/10 transition-colors">
                            1</div>
                        <span
                            class="material-symbols-outlined text-3xl text-primary dark:text-green-400 mb-3 block">search</span>
                        <h3 class="font-bold text-lg text-slate-900 dark:text-white mb-2">Cherchez</h3>
                        <p class="text-sm text-slate-600 dark:text-slate-400">Parcourez les terrains disponibles selon
                            votre
                            ville, la date et l'heure de votre choix.</p>
                    </div>

                    <!-- Step 2 -->
                    <div
                        class="bg-slate-50 dark:bg-slate-700 p-6 rounded-xl relative overflow-hidden group hover:shadow-md hover:-translate-y-1 transition-all cursor-pointer">
                        <div
                            class="text-6xl font-black text-slate-200 dark:text-slate-600 absolute -right-2 -bottom-4 group-hover:text-primary/10 transition-colors">
                            2</div>
                        <span
                            class="material-symbols-outlined text-3xl text-primary dark:text-green-400 mb-3 block">ads_click</span>
                        <h3 class="font-bold text-lg text-slate-900 dark:text-white mb-2">Choisissez</h3>
                        <p class="text-sm text-slate-600 dark:text-slate-400">Sélectionnez le terrain qui vous convient
                            et
                            vérifiez les équipements (douches, parking, etc).</p>
                    </div>

                    <!-- Step 3 -->
                    <div
                        class="bg-slate-50 dark:bg-slate-700 p-6 rounded-xl relative overflow-hidden group hover:shadow-md hover:-translate-y-1 transition-all cursor-pointer">
                        <div
                            class="text-6xl font-black text-slate-200 dark:text-slate-600 absolute -right-2 -bottom-4 group-hover:text-primary/10 transition-colors">
                            3</div>
                        <span
                            class="material-symbols-outlined text-3xl text-primary dark:text-green-400 mb-3 block">payments</span>
                        <h3 class="font-bold text-lg text-slate-900 dark:text-white mb-2">Payez</h3>
                        <p class="text-sm text-slate-600 dark:text-slate-400">Confirmez votre réservation en payant par
                            Carte
                            Bancaire ou directement via votre Portefeuille (Wallet).</p>
                    </div>
                </div>
            </section>

            <!-- TWO COLUMN SECTION -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                <!-- WALLET SECTION -->
                <section
                    class="bg-white dark:bg-slate-800 rounded-2xl p-8 shadow-sm border border-slate-200 dark:border-slate-700">
                    <h2 class="font-bold text-xl text-primary dark:text-green-400 mb-4 flex items-center gap-2">
                        <span
                            class="material-symbols-outlined text-green-600 dark:text-green-400">account_balance_wallet</span>
                        Le Portefeuille KoraBooking
                    </h2>
                    <p class="text-sm text-slate-600 dark:text-slate-400 mb-4">
                        Votre portefeuille (Wallet) vous permet de payer vos matchs en un clic.
                    </p>
                    <ul class="space-y-3">
                        <li class="flex items-start gap-2 text-sm text-slate-700 dark:text-slate-300">
                            <span
                                class="material-symbols-outlined text-green-500 dark:text-green-400 text-lg">check_circle</span>
                            <span><strong>Paiement rapide :</strong> Plus besoin de saisir votre carte à chaque
                                fois.</span>
                        </li>
                        <li class="flex items-start gap-2 text-sm text-slate-700 dark:text-slate-300">
                            <span
                                class="material-symbols-outlined text-green-500 dark:text-green-400 text-lg">check_circle</span>
                            <span><strong>Remboursement direct :</strong> En cas d'annulation, l'argent revient
                                instantanément ici.</span>
                        </li>
                        <li class="flex items-start gap-2 text-sm text-slate-700 dark:text-slate-300">
                            <span
                                class="material-symbols-outlined text-green-500 dark:text-green-400 text-lg">check_circle</span>
                            <span><strong>Points de fidélité :</strong> Gagnez 10 points Wallet à chaque réservation
                                !</span>
                        </li>
                    </ul>
                </section>

                <!-- CANCELLATION POLICY SECTION -->
                <section
                    class="bg-white dark:bg-slate-800 rounded-2xl p-8 shadow-sm border border-slate-200 dark:border-slate-700">
                    <h2 class="font-bold text-xl text-red-600 dark:text-red-400 mb-4 flex items-center gap-2">
                        <span class="material-symbols-outlined">event_busy</span>
                        Politique d'Annulation
                    </h2>
                    <p class="text-sm text-slate-600 dark:text-slate-400 mb-4">
                        Un imprévu ? Voici comment fonctionnent les annulations sur notre plateforme :
                    </p>

                    <!-- Success Policy -->
                    <div
                        class="bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 p-4 rounded-lg flex items-start gap-3 mb-4">
                        <span
                            class="material-symbols-outlined text-green-600 dark:text-green-400 mt-0.5">sentiment_satisfied</span>
                        <div>
                            <h4 class="font-bold text-green-800 dark:text-green-300 text-sm">Plus de 24h avant le match
                            </h4>
                            <p class="text-xs text-green-700 dark:text-green-400 mt-1">Annulation gratuite. Le montant
                                est remboursé à
                                100% dans votre Portefeuille.</p>
                        </div>
                    </div>

                    <!-- Error Policy -->
                    <div
                        class="bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 p-4 rounded-lg flex items-start gap-3">
                        <span
                            class="material-symbols-outlined text-red-600 dark:text-red-400 mt-0.5">sentiment_dissatisfied</span>
                        <div>
                            <h4 class="font-bold text-red-800 dark:text-red-300 text-sm">Moins de 24h avant le match
                            </h4>
                            <p class="text-xs text-red-700 dark:text-red-400 mt-1">Annulation impossible. La réservation
                                est maintenue
                                pour respecter l'engagement avec le terrain.</p>
                        </div>
                    </div>
                </section>
            </div>

            <!-- CTA SECTION -->
            <section
                class="bg-gradient-to-br from-slate-800 to-slate-900 dark:from-slate-900 dark:to-slate-950 text-white rounded-2xl p-8 shadow-lg text-center mt-8 relative overflow-hidden">
                <div class="absolute right-0 top-0 opacity-5 transform translate-x-4 -translate-y-4">
                    <span class="material-symbols-outlined text-[150px]">support_agent</span>
                </div>
                <div class="relative z-10">
                    <h2 class="font-bold text-2xl mb-2">Vous n'avez pas trouvé votre réponse ?</h2>
                    <p class="text-slate-300 text-sm mb-6 max-w-lg mx-auto">Notre équipe de support est là pour
                        vous aider avec vos réservations ou vos problèmes de paiement.</p>
                    <a href="mailto:support@korabooking.com"
                        class="inline-flex items-center gap-2 bg-primary hover:bg-green-700 text-white px-6 py-3 rounded-xl font-bold transition-colors">
                        <span class="material-symbols-outlined">mail</span>
                        Contactez-nous
                    </a>
                </div>
            </section>

        </main>
    </div>

    @push('styles')
        <style>
            @keyframes fadeInUp {
                from {
                    opacity: 0;
                    transform: translateY(30px);
                }

                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            @keyframes slideIn {
                from {
                    opacity: 0;
                    transform: translateX(-20px);
                }

                to {
                    opacity: 1;
                    transform: translateX(0);
                }
            }

            main>section:first-child {
                animation: fadeInUp 0.6s ease-out;
            }

            main>div>section {
                animation: fadeInUp 0.6s ease-out;
                animation-fill-mode: both;
            }

            main>div:first-of-type>section:first-child {
                animation-delay: 0.1s;
            }

            main>div:first-of-type>section:last-child {
                animation-delay: 0.2s;
            }

            main>section:last-child {
                animation-delay: 0.3s;
            }

            .grid>.group:nth-child(1) {
                animation: slideIn 0.5s ease-out 0.1s both;
            }

            .grid>.group:nth-child(2) {
                animation: slideIn 0.5s ease-out 0.2s both;
            }

            .grid>.group:nth-child(3) {
                animation: slideIn 0.5s ease-out 0.3s both;
            }
        </style>
    @endpush
</x-layout>
