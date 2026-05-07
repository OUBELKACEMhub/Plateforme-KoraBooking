<div class="flex items-center gap-6">
    <div class="flex items-center gap-4">


        <div class="relative pt-1">

            <button onclick="document.getElementById('managerNotifDropdown').classList.toggle('hidden')"
                class="relative p-2 text-slate-500 hover:bg-slate-50 dark:hover:bg-emerald-900/40 rounded-full transition-colors active:scale-95 focus:outline-none"
                title="Notifications">
                <span class="material-symbols-outlined">notifications</span>

                @if (auth()->user()->unreadNotifications->count() > 0)
                    <span class="absolute top-1.5 right-1.5 flex h-2.5 w-2.5">
                        <span
                            class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                        <span
                            class="relative inline-flex rounded-full h-2.5 w-2.5 bg-red-500 border-2 border-white dark:border-slate-900"></span>
                    </span>
                @endif
            </button>

            <div id="managerNotifDropdown"
                class="hidden absolute right-0 mt-2 w-80 bg-white dark:bg-slate-900 rounded-xl shadow-xl border border-slate-200 dark:border-slate-700 overflow-hidden z-50 origin-top-right">

                <div
                    class="flex items-center justify-between px-4 py-3 border-b border-slate-100 dark:border-slate-800 bg-slate-50 dark:bg-slate-800/50">
                    <h3 class="font-bold text-sm text-slate-800 dark:text-slate-100">Notifications (Manager)</h3>
                    @if (auth()->user()->unreadNotifications->count() > 0)
                        <span class="bg-red-100 text-red-600 text-[10px] font-black px-2 py-0.5 rounded-full">
                            {{ auth()->user()->unreadNotifications->count() }} NOUVELLE(S)
                        </span>
                    @endif
                </div>

                <div class="max-h-[300px] overflow-y-auto divide-y divide-slate-100 dark:divide-slate-800">

                    @forelse(auth()->user()->unreadNotifications as $notification)
                        <div class="p-4 hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-colors">
                            <div class="flex gap-3">

                                <div class="flex-shrink-0 mt-0.5">
                                    @if (isset($notification->data['type']) && $notification->data['type'] == 'danger')
                                        <div
                                            class="w-8 h-8 rounded-full bg-red-100 text-red-600 flex items-center justify-center">
                                            <span class="material-symbols-outlined text-[16px]">event_busy</span>
                                        </div>
                                    @else
                                        <div
                                            class="w-8 h-8 rounded-full bg-primary/10 text-primary flex items-center justify-center">
                                            <span class="material-symbols-outlined text-[16px]">info</span>
                                        </div>
                                    @endif
                                </div>

                                <!-- L-Message -->
                                <div>
                                    <p class="text-sm font-bold text-slate-800 dark:text-slate-200 mb-1">
                                        {{ isset($notification->data['type']) && $notification->data['type'] == 'danger' ? 'Réservation Annulée' : 'Nouveau Message' }}
                                    </p>
                                    <p class="text-xs text-slate-500 dark:text-slate-400 leading-relaxed">
                                        {{ $notification->data['message'] }}
                                    </p>
                                    <p class="text-[10px] font-bold text-slate-400 mt-2 uppercase tracking-wider">
                                        {{ $notification->created_at->diffForHumans() }}
                                    </p>
                                </div>

                            </div>
                        </div>
                    @empty
                        <!-- Ila l-manager ma3ndou 7ta notification -->
                        <div
                            class="p-6 text-center text-slate-500 dark:text-slate-400 flex flex-col items-center gap-2">
                            <span class="material-symbols-outlined text-4xl opacity-20">notifications_paused</span>
                            <p class="text-sm">Aucune activité récente.</p>
                        </div>
                    @endforelse
                </div>

                @if (auth()->user()->unreadNotifications->count() > 0)
                    <div class="p-2 border-t border-slate-100 dark:border-slate-800 bg-slate-50 dark:bg-slate-800/50">
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


    </div>

    @auth
        <div
            class="h-10 w-10 rounded-full overflow-hidden border-2 border-emerald-100 hover:border-emerald-300 transition-colors cursor-pointer flex items-center justify-center bg-green-600 text-white font-bold shadow-sm">
            @if (auth()->user()->profile_image)
                <img alt="Profil de {{ auth()->user()->name }}" class="object-cover w-full h-full"
                    src="{{ asset('storage/' . auth()->user()->profile_image) }}" />
            @else
                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
            @endif
        </div>
    @endauth
</div>
