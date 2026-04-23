<footer class="bg-slate-50 dark:bg-slate-950 border-t border-slate-200 dark:border-slate-800 pt-16 pb-8 mt-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Grid dyal les colonnes -->
        <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-12 mb-12">

            <!-- Colonne 1: Logo w description -->
            <div class="lg:col-span-2">
                <div class="flex items-center mb-6">
                    <a href="{{ route('dashboard') ?? '/' }}"
                        class="inline-block transition-transform hover:scale-105 duration-300">
                        <x-logo class="h-10 sm:h-12 w-auto" />
                    </a>
                </div>
                <p class="text-slate-500 dark:text-slate-400 text-sm max-w-sm leading-relaxed mb-6">
                    La plateforme n°1 au Maroc pour la réservation de terrains de football. Jouez plus, cherchez moins.
                    Réservez votre terrain 5vs5 en quelques clics.
                </p>

                <!-- Réseaux Sociaux -->
                <div class="flex space-x-4">
                    <a href="#"
                        class="w-10 h-10 rounded-full bg-white dark:bg-slate-800 shadow-sm flex items-center justify-center text-slate-400 hover:text-primary hover:border-primary border border-slate-200 dark:border-slate-700 transition-all"
                        title="Facebook">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path fill-rule="evenodd"
                                d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"
                                clip-rule="evenodd" />
                        </svg>
                    </a>
                    <a href="#"
                        class="w-10 h-10 rounded-full bg-white dark:bg-slate-800 shadow-sm flex items-center justify-center text-slate-400 hover:text-primary hover:border-primary border border-slate-200 dark:border-slate-700 transition-all"
                        title="Instagram">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path fill-rule="evenodd"
                                d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z"
                                clip-rule="evenodd" />
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Colonne 2: Liens -->
            <div>
                <h3 class="text-sm font-bold text-slate-900 dark:text-white uppercase tracking-wider mb-4">Navigation
                </h3>
                <ul class="space-y-3">
                    <li><a href="#"
                            class="text-sm font-medium text-slate-500 hover:text-primary dark:text-slate-400 transition-colors">Trouver
                            un terrain</a></li>
                    <li><a href="#"
                            class="text-sm font-medium text-slate-500 hover:text-primary dark:text-slate-400 transition-colors">Mes
                            réservations</a></li>
                    <li><a href="#"
                            class="text-sm font-medium text-slate-500 hover:text-primary dark:text-slate-400 transition-colors">Tarifs
                            & Promos</a></li>
                </ul>
            </div>

            <!-- Colonne 3: Support w Contact -->
            <div>
                <h3 class="text-sm font-bold text-slate-900 dark:text-white uppercase tracking-wider mb-4">Support</h3>
                <ul class="space-y-3">
                    <li><a href="#"
                            class="text-sm font-medium text-slate-500 hover:text-primary dark:text-slate-400 transition-colors">Centre
                            d'aide (FAQ)</a></li>
                    <li><a href="#"
                            class="text-sm font-medium text-slate-500 hover:text-primary dark:text-slate-400 transition-colors">Devenir
                            Partenaire</a></li>
                    <li class="pt-2">
                        <a href="mailto:support@koorabooking.ma"
                            class="inline-flex items-center text-sm font-semibold text-slate-700 dark:text-slate-300 hover:text-primary transition-colors">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                </path>
                            </svg>
                            support@koorabooking.ma
                        </a>
                    </li>
                </ul>
            </div>

        </div>

        <!-- Ta7tiya (Bottom Footer) -->
        <div
            class="pt-8 border-t border-slate-200 dark:border-slate-800 flex flex-col md:flex-row justify-between items-center gap-4">
            <div
                class="text-xs font-bold text-slate-400 dark:text-slate-500 uppercase tracking-widest text-center md:text-left">
                © {{ date('Y') }} KooraBooking. Tous droits réservés.
            </div>
            <div class="flex space-x-6 text-sm font-medium text-slate-500 dark:text-slate-400">
                <a href="#" class="hover:text-primary transition-colors">Conditions Générales</a>
                <a href="#" class="hover:text-primary transition-colors">Confidentialité</a>
            </div>
        </div>
    </div>
</footer>
