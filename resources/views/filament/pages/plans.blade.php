<x-filament-panels::page>
    <div class="space-y-6">
        {{-- Command info cards --}}
        <div class="grid gap-4 md:grid-cols-2">
            <div class="rounded-xl border border-gray-200 bg-white p-5 dark:border-gray-700 dark:bg-gray-800">
                <div class="flex items-start gap-3">
                    <div class="flex size-9 shrink-0 items-center justify-center rounded-lg bg-primary-50 dark:bg-primary-500/10">
                        <x-filament::icon icon="heroicon-o-command-line" class="size-4 text-primary-600 dark:text-primary-400" />
                    </div>
                    <div>
                        <h3 class="text-sm font-semibold text-gray-900 dark:text-white">stripe:sync-prices</h3>
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                            Szinkronizálja a helyi terveket a Stripe-pal. Termékeket és árakat hoz létre HUF és EUR pénznemben.
                        </p>
                        <div class="mt-2 flex flex-wrap gap-1.5">
                            <span class="inline-flex items-center rounded bg-gray-100 px-1.5 py-0.5 text-xs text-gray-600 dark:bg-gray-700 dark:text-gray-300">--force</span>
                            <span class="inline-flex items-center rounded bg-gray-100 px-1.5 py-0.5 text-xs text-gray-600 dark:bg-gray-700 dark:text-gray-300">--dry-run</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="rounded-xl border border-gray-200 bg-white p-5 dark:border-gray-700 dark:bg-gray-800">
                <div class="flex items-start gap-3">
                    <div class="flex size-9 shrink-0 items-center justify-center rounded-lg bg-info-50 dark:bg-info-500/10">
                        <x-filament::icon icon="heroicon-o-command-line" class="size-4 text-info-600 dark:text-info-400" />
                    </div>
                    <div>
                        <h3 class="text-sm font-semibold text-gray-900 dark:text-white">subscriptions:sync-items</h3>
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                            Szinkronizálja az előfizetési tételeket a Stripe-ból a helyi adatbázisba.
                        </p>
                        <div class="mt-2 flex flex-wrap gap-1.5">
                            <span class="inline-flex items-center rounded bg-gray-100 px-1.5 py-0.5 text-xs text-gray-600 dark:bg-gray-700 dark:text-gray-300">--subscription=ID</span>
                        </div>
                    </div>
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
            <div class="p-4 font-mono text-sm min-h-48 max-h-128 overflow-y-auto" id="terminal-output">
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
                        <span>Válassz egy parancsot a fejlécből a futtatáshoz...</span>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-filament-panels::page>
