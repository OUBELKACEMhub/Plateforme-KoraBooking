<x-admin-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <div class="mb-8 flex justify-between items-center">
            <div>
                <h1 class="font-headline text-3xl font-extrabold text-slate-900 dark:text-white">Gestion des Terrains
                </h1>
            </div>
        </div>

        <div
            class="bg-white dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-slate-800 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr
                            class="bg-slate-50 dark:bg-slate-800/50 text-slate-500 text-xs uppercase tracking-wider font-bold">
                            <th class="px-6 py-4">Terrain</th>
                            <th class="px-6 py-4">Ville</th>
                            <th class="px-6 py-4">Prix / Heure</th>
                            <th class="px-6 py-4 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 dark:divide-slate-800 text-sm">
                        @foreach ($stadiums as $stadium)
                            <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/20 transition-colors">
                                <td class="px-6 py-4 font-bold text-slate-800 dark:text-slate-200">{{ $stadium->name }}
                                </td>
                                <td class="px-6 py-4 text-slate-500">{{ $stadium->city ?? 'Non défini' }}</td>
                                <td class="px-6 py-4 font-bold text-indigo-600">
                                    {{ number_format($stadium->price, 2) }} DH</td>
                                <td class="px-6 py-4 text-right">
                                    <button class="text-slate-400 hover:text-indigo-600 p-1"><span
                                            class="material-symbols-outlined text-[20px]">visibility</span></button>
                                    <button class="text-slate-400 hover:text-red-600 p-1 ml-2"><span
                                            class="material-symbols-outlined text-[20px]">delete</span></button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="px-6 py-4 border-t border-slate-200 dark:border-slate-800">{{ $stadiums->links() }}</div>
        </div>
    </div>
</x-admin-layout>
