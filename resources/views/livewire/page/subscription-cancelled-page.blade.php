<div>
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Sikertelen rendelés</h1>
    </div>

    <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-12 text-center">
        <div class="w-16 h-16 mx-auto mb-4 bg-red-100 dark:bg-red-900/20 rounded-full flex items-center justify-center">
            <svg class="w-8 h-8 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </div>
        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">A rendelés megszakadt</h3>
        <p class="text-gray-500 dark:text-gray-400 mb-6 max-w-md mx-auto">
            A fizetési folyamat nem fejeződött be. Nem történt terhelés a kártyádon. Bármikor újrapróbálhatod a rendelést.
        </p>
        <div class="flex items-center justify-center gap-4">
            <a href="{{ route('module.order') }}"
                class="inline-flex items-center gap-2 px-6 py-3 bg-indigo-600 text-white rounded-lg font-semibold text-sm hover:bg-indigo-700 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                </svg>
                Újrapróbálás
            </a>
            <a href="{{ route('modules') }}"
                class="inline-flex items-center gap-2 px-6 py-3 bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-lg font-semibold text-sm hover:bg-gray-200 dark:hover:bg-gray-600 transition">
                Vissza a modulokhoz
            </a>
        </div>
    </div>
</div>
