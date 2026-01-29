<section class="bg-white py-16 lg:py-24">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="mx-auto mb-12 max-w-3xl text-center">
            <h2 class="text-3xl font-semibold text-gray-900 sm:text-4xl">Árazás</h2>
            <p class="mt-4 text-lg text-gray-600">Válassza ki a cégének megfelelő csomagot.</p>
        </div>

        <div class="grid gap-8 lg:grid-cols-3">
            {{-- Starter --}}
            <div class="rounded-2xl border border-gray-200 bg-white p-8">
                <h3 class="text-xl font-semibold text-gray-900">Starter</h3>
                <div class="mt-4 flex items-baseline gap-1">
                    <span class="text-4xl font-bold text-gray-900">6 900</span>
                    <span class="text-gray-600">Ft/felhasználó/hó</span>
                </div>
                <ul class="mt-6 space-y-3">
                    <li class="flex items-center gap-2 text-gray-600">
                        <svg class="h-5 w-5 text-emerald-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                clip-rule="evenodd" />
                        </svg>
                        Alap dashboardok
                    </li>
                    <li class="flex items-center gap-2 text-gray-600">
                        <svg class="h-5 w-5 text-emerald-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                clip-rule="evenodd" />
                        </svg>
                        3 költséghely
                    </li>
                    <li class="flex items-center gap-2 text-gray-600">
                        <svg class="h-5 w-5 text-emerald-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                clip-rule="evenodd" />
                        </svg>
                        Alap riportok
                    </li>
                </ul>
                <a href="{{ route('register') }}"
                    class="mt-8 block w-full rounded-full border-2 border-emerald-600 py-3 text-center font-semibold text-emerald-600 transition-colors hover:bg-emerald-50">
                    Ingyenes próba
                </a>
            </div>

            {{-- Professional --}}
            <div class="relative rounded-2xl border-2 border-emerald-600 bg-white p-8">
                <div
                    class="absolute -top-4 left-1/2 -translate-x-1/2 rounded-full bg-emerald-600 px-4 py-1 text-sm font-semibold text-white">
                    Legnépszerűbb
                </div>
                <h3 class="text-xl font-semibold text-gray-900">Professional</h3>
                <div class="mt-4 flex items-baseline gap-1">
                    <span class="text-4xl font-bold text-gray-900">14 900</span>
                    <span class="text-gray-600">Ft/felhasználó/hó</span>
                </div>
                <ul class="mt-6 space-y-3">
                    <li class="flex items-center gap-2 text-gray-600">
                        <svg class="h-5 w-5 text-emerald-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                clip-rule="evenodd" />
                        </svg>
                        Korlátlan költséghely
                    </li>
                    <li class="flex items-center gap-2 text-gray-600">
                        <svg class="h-5 w-5 text-emerald-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                clip-rule="evenodd" />
                        </svg>
                        Automatikus riportok
                    </li>
                    <li class="flex items-center gap-2 text-gray-600">
                        <svg class="h-5 w-5 text-emerald-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                clip-rule="evenodd" />
                        </svg>
                        Terv-tény elemzés
                    </li>
                </ul>
                <a href="{{ route('register') }}"
                    class="mt-8 block w-full rounded-full bg-emerald-600 py-3 text-center font-semibold text-white transition-colors hover:bg-emerald-700">
                    Ingyenes próba
                </a>
            </div>

            {{-- Egyedi ajánlat --}}
            <div class="rounded-2xl border border-gray-200 bg-white p-8">
                <h3 class="text-xl font-semibold text-gray-900">Egyedi ajánlat</h3>
                <div class="mt-4 flex items-baseline gap-1">
                    <span class="text-4xl font-bold text-gray-900">Egyedi</span>
                </div>
                <ul class="mt-6 space-y-3">
                    <li class="flex items-center gap-2 text-gray-600">
                        <svg class="h-5 w-5 text-emerald-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                clip-rule="evenodd" />
                        </svg>
                        Konszolidáció
                    </li>
                    <li class="flex items-center gap-2 text-gray-600">
                        <svg class="h-5 w-5 text-emerald-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                clip-rule="evenodd" />
                        </svg>
                        Multi-currency
                    </li>
                    <li class="flex items-center gap-2 text-gray-600">
                        <svg class="h-5 w-5 text-emerald-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                clip-rule="evenodd" />
                        </svg>
                        Custom riportok
                    </li>
                </ul>
                <a href="{{ route('contact') }}"
                    class="mt-8 block w-full rounded-full border-2 border-emerald-600 py-3 text-center font-semibold text-emerald-600 transition-colors hover:bg-emerald-50">
                    Ajánlatot kérek
                </a>
            </div>
        </div>
    </div>
</section>
