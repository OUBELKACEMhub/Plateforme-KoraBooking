<x-admin-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

        <!-- Header -->
        <div class="mb-8 flex justify-between items-center">
            <div>
                <h1 class="font-headline text-3xl font-extrabold text-slate-900 dark:text-white">Gestion des Utilisateurs
                </h1>
                <p class="text-slate-500 mt-1">Liste de tous les clients, managers et administrateurs.</p>
            </div>
        </div>


        <div
            class="bg-white dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-slate-800 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr
                            class="bg-slate-50 dark:bg-slate-800/50 text-slate-500 dark:text-slate-400 text-xs uppercase tracking-wider font-bold">
                            <th class="px-6 py-4">Nom & Email</th>
                            <th class="px-6 py-4">Rôle</th>
                            <th class="px-6 py-4">Portefeuille</th>
                            <th class="px-6 py-4">Date d'inscription</th>
                            <th class="px-6 py-4 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 dark:divide-slate-800 text-sm">
                        @foreach ($users as $user)
                            <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/20 transition-colors">

                                <td class="px-6 py-4">
                                    <div class="font-bold text-slate-800 dark:text-slate-200">
                                        {{ $user->name }}
                                        <!-- 🔥 Badge mni kay-koun l-user Banni 🔥 -->
                                        @if ($user->is_banned)
                                            <span
                                                class="bg-red-100 text-red-700 px-2 py-0.5 rounded text-[10px] font-black uppercase ml-2">Banni</span>
                                        @endif
                                    </div>
                                    <div class="text-xs text-slate-500">{{ $user->email }}</div>
                                </td>

                                <!-- 2. Rôle -->
                                <td class="px-6 py-4">
                                    @if ($user->role == 'admin')
                                        <span
                                            class="bg-purple-100 text-purple-700 px-2.5 py-1 rounded-md text-xs font-black uppercase">Admin</span>
                                    @elseif($user->role == 'manager')
                                        <span
                                            class="bg-indigo-100 text-indigo-700 px-2.5 py-1 rounded-md text-xs font-black uppercase">Manager</span>
                                    @else
                                        <span
                                            class="bg-slate-100 dark:bg-slate-800 text-slate-700 dark:text-slate-300 px-2.5 py-1 rounded-md text-xs font-black uppercase">Client</span>
                                    @endif
                                </td>

                                <td class="px-6 py-4 font-bold text-green-600">
                                    {{ number_format($user->wallet_balance, 2) }} DH
                                </td>

                                <td class="px-6 py-4 text-slate-500">
                                    {{ $user->created_at->format('d/m/Y') }}
                                </td>

                                <td class="px-6 py-4 text-right">

                                    <form action="{{ route('admin.users.ban', $user->id) }}" method="POST"
                                        class="inline-block m-0"
                                        onsubmit="return confirm('Êtes-vous sûr de vouloir {{ $user->is_banned ? 'réactiver' : 'bannir' }} cet utilisateur ?');">
                                        @csrf
                                        @method('PATCH')

                                        @if ($user->is_banned)
                                            <button type="submit"
                                                class="text-slate-400 hover:text-green-600 p-1 ml-2 transition-colors"
                                                title="Réactiver le compte">
                                                <span class="material-symbols-outlined text-[20px]">lock_open</span>
                                            </button>
                                        @else
                                            <button type="submit"
                                                class="text-slate-400 hover:text-orange-500 p-1 ml-2 transition-colors"
                                                title="Bannir le compte">
                                                <span class="material-symbols-outlined text-[20px]">block</span>
                                            </button>
                                        @endif
                                    </form>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="px-6 py-4 border-t border-slate-200 dark:border-slate-800">
                {{ $users->links() }}
            </div>
        </div>
    </div>
</x-admin-layout>
