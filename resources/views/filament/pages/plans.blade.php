<x-filament-panels::page>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <div class="space-y-6">
        {{-- Command cards --}}
        <div class="grid gap-4 md:grid-cols-2">
            {{-- stripe:sync-prices --}}
            <div class="rounded-xl border border-gray-200 bg-white p-5 dark:border-gray-700 dark:bg-gray-800">
                <div class="flex items-center gap-2 mb-3">
                    <div class="flex size-8 shrink-0 items-center justify-center rounded-lg bg-primary-50 dark:bg-primary-500/10">
                        <x-filament::icon icon="heroicon-o-command-line" class="size-4 text-primary-600 dark:text-primary-400" />
                    </div>
                    <code class="text-sm font-semibold text-gray-900 dark:text-white">stripe:sync-prices</code>
                </div>
                <p class="text-xs text-gray-500 dark:text-gray-400 mb-4">
                    Szinkronizálja a helyi terveket a Stripe-pal. Termékeket és árakat hoz létre HUF és EUR pénznemben.
                </p>
                <div class="flex flex-wrap gap-2">
                    <button wire:click="syncPrices" wire:confirm="Biztosan futtatod a stripe:sync-prices parancsot?"
                        class="inline-flex items-center gap-1.5 rounded-lg bg-primary-600 px-3 py-2 text-xs font-semibold text-white hover:bg-primary-700 transition">
                        <x-filament::icon icon="heroicon-m-play" class="size-3.5" />
                        Futtatás
                    </button>
                    <button wire:click="syncPricesForce" wire:confirm="Biztosan futtatod --force módban? Ez újra létrehozza az összes árat."
                        class="inline-flex items-center gap-1.5 rounded-lg bg-warning-600 px-3 py-2 text-xs font-semibold text-white hover:bg-warning-700 transition">
                        <x-filament::icon icon="heroicon-m-play" class="size-3.5" />
                        Force
                    </button>
                    <button wire:click="syncPricesDryRun"
                        class="inline-flex items-center gap-1.5 rounded-lg bg-gray-200 px-3 py-2 text-xs font-semibold text-gray-700 hover:bg-gray-300 dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600 transition">
                        <x-filament::icon icon="heroicon-m-eye" class="size-3.5" />
                        Dry run
                    </button>
                </div>
            </div>

            {{-- subscriptions:sync-items --}}
            <div class="rounded-xl border border-gray-200 bg-white p-5 dark:border-gray-700 dark:bg-gray-800">
                <div class="flex items-center gap-2 mb-3">
                    <div class="flex size-8 shrink-0 items-center justify-center rounded-lg bg-info-50 dark:bg-info-500/10">
                        <x-filament::icon icon="heroicon-o-command-line" class="size-4 text-info-600 dark:text-info-400" />
                    </div>
                    <code class="text-sm font-semibold text-gray-900 dark:text-white">subscriptions:sync-items</code>
                </div>
                <p class="text-xs text-gray-500 dark:text-gray-400 mb-4">
                    Szinkronizálja az előfizetési tételeket a Stripe-ból a helyi adatbázisba.
                </p>
                <div class="flex flex-wrap gap-2">
                    <button wire:click="syncSubscriptionItems" wire:confirm="Biztosan futtatod a subscriptions:sync-items parancsot?"
                        class="inline-flex items-center gap-1.5 rounded-lg bg-info-600 px-3 py-2 text-xs font-semibold text-white hover:bg-info-700 transition">
                        <x-filament::icon icon="heroicon-m-play" class="size-3.5" />
                        Futtatás
                    </button>
                </div>
            </div>
        </div>

        {{-- Terminal output --}}
        <div class="rounded-xl border border-gray-200 bg-gray-900 dark:border-gray-700 overflow-hidden">
            {{-- Terminal header --}}
            <div class="flex items-center justify-between border-b border-gray-700 bg-gray-800 px-4 py-2.5">
                <div class="flex items-center gap-2">
                    <div class="flex gap-1.5">
                        <span class="size-3 rounded-full bg-red-500"></span>
                        <span class="size-3 rounded-full bg-yellow-500"></span>
                        <span class="size-3 rounded-full bg-green-500"></span>
                    </div>
                    <span class="ml-2 text-xs text-gray-400">terminal</span>
                </div>
                @if ($consoleOutput)
                    <button wire:click="clearOutput" class="text-xs text-gray-500 hover:text-gray-300 transition">
                        Törlés
                    </button>
                @endif
            </div>

            {{-- Terminal body --}}
            <div class="p-4 font-mono text-sm min-h-48 max-h-128 overflow-y-auto">
                @if ($isRunning)
                    <div class="flex items-center gap-2 text-green-400">
                        <svg class="size-4 animate-spin" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        <span>Futtatás...</span>
                    </div>
                @elseif ($consoleOutput)
                    <pre class="whitespace-pre-wrap text-gray-300 leading-relaxed">{{ $consoleOutput }}</pre>
                @else
                    <div class="flex items-center gap-1 text-gray-500">
                        <span class="text-green-500">$</span>
                        <span>Kattints egy parancs "Futtatás" gombjára...</span>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-filament-panels::page>
