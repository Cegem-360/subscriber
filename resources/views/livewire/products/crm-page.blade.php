<div>
    {{-- Hero Section --}}
    <section class="bg-linear-to-b from-sky-50 to-white py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto max-w-4xl text-center">
                <div class="mb-6 flex justify-center">
                    <x-module-icon module="crm" size="xl" />
                </div>
                <div
                    class="mb-6 inline-flex items-center gap-2 rounded-full bg-sky-100 px-4 py-1.5 text-sm font-medium text-sky-700">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                    CRM Modul
                </div>
                <h1 class="mb-6 text-4xl font-semibold leading-tight text-gray-900 sm:text-5xl lg:text-6xl">
                    Kövesse nyomon ügyfeleit az első megkeresésől a szerződéskötésig
                </h1>
                <p class="mx-auto max-w-3xl text-lg leading-relaxed text-gray-600 sm:text-xl">
                    Minden ügyfél, minden kapcsolatfelvétel, minden üzlet — egy helyen. A Cégem360 CRM nem csak egy
                    adatbázis: egy értékesítési motorháztető, amely segít több ügyfelet szerezni és megtartani.
                </p>

                {{-- CTA Buttons --}}
                <div class="mt-8 flex flex-col items-center justify-center gap-4 sm:flex-row">
                    <a href="{{ route('register') }}"
                        class="inline-flex items-center justify-center gap-2 rounded-full bg-sky-600 px-8 py-4 text-base font-semibold text-white shadow-lg transition-colors hover:bg-sky-700 hover:shadow-xl">
                        Kezdés indítása
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </a>
                    <a href="{{ route('contact') }}"
                        class="inline-flex items-center justify-center gap-2 rounded-full border-2 border-sky-200 bg-white px-8 py-4 text-base font-semibold text-sky-700 transition-colors hover:bg-sky-50">
                        Demó kérése
                    </a>
                    <a href="{{ route('login') }}"
                        class="inline-flex items-center justify-center gap-2 text-base font-medium text-sky-600 transition-colors hover:text-sky-800">
                        Bejelentkezés a programba →
                    </a>
                </div>

            </div>
        </div>
    </section>

    {{-- Problem Section --}}
    <section class="bg-white py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto mb-12 max-w-3xl text-center">
                <h2 class="text-3xl font-semibold text-gray-900 sm:text-4xl">A probléma, amit megoldunk</h2>
            </div>

            <div class="grid gap-6 sm:grid-cols-2">
                <div class="rounded-2xl border border-sky-100 bg-linear-to-br from-sky-50 to-white p-8">
                    <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-xl bg-white shadow-sm">
                        <svg class="h-6 w-6 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
                        </svg>
                    </div>
                    <h3 class="mb-2 text-lg font-semibold text-gray-900">Elveszett érdeklődők</h3>
                    <p class="text-gray-600">Valaki megkeresett három hete, de nem emlékszik senki, mit ígértünk neki.
                    </p>
                </div>
                <div class="rounded-2xl border border-sky-100 bg-linear-to-br from-sky-50 to-white p-8">
                    <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-xl bg-white shadow-sm">
                        <svg class="h-6 w-6 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="mb-2 text-lg font-semibold text-gray-900">Átláthatatlan pipeline</h3>
                    <p class="text-gray-600">Nem tudja, melyik üzlet van közel a lezáráshoz és melyik akadt el.</p>
                </div>
                <div class="rounded-2xl border border-sky-100 bg-linear-to-br from-sky-50 to-white p-8">
                    <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-xl bg-white shadow-sm">
                        <svg class="h-6 w-6 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                    </div>
                    <h3 class="mb-2 text-lg font-semibold text-gray-900">Hiányzó kapcsolattörténet</h3>
                    <p class="text-gray-600">Ha egy kolléga szabadságra megy, vele együtt tűnik el az ügyféltudás.</p>
                </div>
                <div class="rounded-2xl border border-sky-100 bg-linear-to-br from-sky-50 to-white p-8">
                    <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-xl bg-white shadow-sm">
                        <svg class="h-6 w-6 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <h3 class="mb-2 text-lg font-semibold text-gray-900">Manuális adatrögzítés</h3>
                    <p class="text-gray-600">Minden információ Excelben, jegyzetfüzetben, e-mailekben szétszórva.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Features Section --}}
    <section class="bg-gray-50 py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto mb-12 max-w-3xl text-center">
                <h2 class="text-3xl font-semibold text-gray-900 sm:text-4xl">Főbb funkciók</h2>
                <p class="mt-4 text-lg text-gray-600">Minden, amire szüksége van az ügyfélkapcsolatok kezeléséhez.</p>
            </div>

            <div class="grid gap-8 lg:grid-cols-3">
                {{-- Kapcsolatkezelés --}}
                <div
                    class="rounded-2xl border border-gray-100 bg-white p-8 shadow-sm transition-shadow hover:shadow-lg">
                    <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-xl bg-sky-100">
                        <svg class="h-6 w-6 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                    <h3 class="mb-3 text-xl font-semibold text-gray-900">Kapcsolatkezelés</h3>
                    <ul class="space-y-2 text-gray-600">
                        <li class="flex items-start gap-2">
                            <svg class="mt-1 h-4 w-4 shrink-0 text-sky-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            Teljes ügyféltörténet egy idővonalon
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="mt-1 h-4 w-4 shrink-0 text-sky-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            Cég- és kapcsolattartó-hierarchia
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="mt-1 h-4 w-4 shrink-0 text-sky-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            Egyedi mezők tetszőleges adatokhoz
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="mt-1 h-4 w-4 shrink-0 text-sky-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            Duplikátum-felismerés és egyesítés
                        </li>
                    </ul>
                </div>

                {{-- Értékesítési pipeline --}}
                <div
                    class="rounded-2xl border border-gray-100 bg-white p-8 shadow-sm transition-shadow hover:shadow-lg">
                    <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-xl bg-sky-100">
                        <svg class="h-6 w-6 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                    </div>
                    <h3 class="mb-3 text-xl font-semibold text-gray-900">Értékesítési pipeline</h3>
                    <ul class="space-y-2 text-gray-600">
                        <li class="flex items-start gap-2">
                            <svg class="mt-1 h-4 w-4 shrink-0 text-sky-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            Vizuális kanban-nézet
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="mt-1 h-4 w-4 shrink-0 text-sky-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            Drag-and-drop mozgatás
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="mt-1 h-4 w-4 shrink-0 text-sky-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            Automatikus értesítések
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="mt-1 h-4 w-4 shrink-0 text-sky-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            Többszintű pipeline
                        </li>
                    </ul>
                </div>

                {{-- Lead-kezelés --}}
                <div
                    class="rounded-2xl border border-gray-100 bg-white p-8 shadow-sm transition-shadow hover:shadow-lg">
                    <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-xl bg-sky-100">
                        <svg class="h-6 w-6 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                        </svg>
                    </div>
                    <h3 class="mb-3 text-xl font-semibold text-gray-900">Lead-kezelés</h3>
                    <ul class="space-y-2 text-gray-600">
                        <li class="flex items-start gap-2">
                            <svg class="mt-1 h-4 w-4 shrink-0 text-sky-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            Lead-forrás követés
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="mt-1 h-4 w-4 shrink-0 text-sky-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            Automatikus lead-scoring
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="mt-1 h-4 w-4 shrink-0 text-sky-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            Automatikus lead-kiosztás
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="mt-1 h-4 w-4 shrink-0 text-sky-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            Webform-integráció
                        </li>
                    </ul>
                </div>

                {{-- Feladatok és emlékeztetők --}}
                <div
                    class="rounded-2xl border border-gray-100 bg-white p-8 shadow-sm transition-shadow hover:shadow-lg">
                    <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-xl bg-sky-100">
                        <svg class="h-6 w-6 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                        </svg>
                    </div>
                    <h3 class="mb-3 text-xl font-semibold text-gray-900">Feladatok és emlékeztetők</h3>
                    <ul class="space-y-2 text-gray-600">
                        <li class="flex items-start gap-2">
                            <svg class="mt-1 h-4 w-4 shrink-0 text-sky-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            Automatikus emlékeztetők
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="mt-1 h-4 w-4 shrink-0 text-sky-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            Naptár-szinkronizáció
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="mt-1 h-4 w-4 shrink-0 text-sky-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            Feladat-delegálás
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="mt-1 h-4 w-4 shrink-0 text-sky-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            Follow-up szekvenciák
                        </li>
                    </ul>
                </div>

                {{-- Kommunikáció --}}
                <div
                    class="rounded-2xl border border-gray-100 bg-white p-8 shadow-sm transition-shadow hover:shadow-lg">
                    <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-xl bg-sky-100">
                        <svg class="h-6 w-6 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <h3 class="mb-3 text-xl font-semibold text-gray-900">Kommunikáció</h3>
                    <ul class="space-y-2 text-gray-600">
                        <li class="flex items-start gap-2">
                            <svg class="mt-1 h-4 w-4 shrink-0 text-sky-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            E-mail a CRM-ből
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="mt-1 h-4 w-4 shrink-0 text-sky-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            E-mail sablonok
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="mt-1 h-4 w-4 shrink-0 text-sky-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            Hívásnapló és jegyzetelés
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="mt-1 h-4 w-4 shrink-0 text-sky-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            Tömeges e-mail kampányok
                        </li>
                    </ul>
                </div>

                {{-- Riportok és elemzések --}}
                <div
                    class="rounded-2xl border border-gray-100 bg-white p-8 shadow-sm transition-shadow hover:shadow-lg">
                    <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-xl bg-sky-100">
                        <svg class="h-6 w-6 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                    </div>
                    <h3 class="mb-3 text-xl font-semibold text-gray-900">Riportok és elemzések</h3>
                    <ul class="space-y-2 text-gray-600">
                        <li class="flex items-start gap-2">
                            <svg class="mt-1 h-4 w-4 shrink-0 text-sky-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            Értékesítési előrejelzés
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="mt-1 h-4 w-4 shrink-0 text-sky-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            Konverziós ráták fázisonként
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="mt-1 h-4 w-4 shrink-0 text-sky-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            Értékesítői teljesítmény dashboard
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="mt-1 h-4 w-4 shrink-0 text-sky-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            Elveszett üzletek elemzése
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    {{-- Results Section --}}
    <section class="bg-white py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto mb-12 max-w-3xl text-center">
                <h2 class="text-3xl font-semibold text-gray-900 sm:text-4xl">Eredmények számokban</h2>
                <p class="mt-4 text-lg text-gray-600">Átlagos javulás ügyfeleink körében a bevezetés után.</p>
            </div>

            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-5">
                <div class="rounded-2xl bg-sky-50 p-6 text-center">
                    <div class="text-4xl font-bold text-sky-600">+40%</div>
                    <div class="mt-2 text-sm text-gray-600">Lezárt üzletek száma</div>
                </div>
                <div class="rounded-2xl bg-sky-50 p-6 text-center">
                    <div class="text-4xl font-bold text-sky-600">-30%</div>
                    <div class="mt-2 text-sm text-gray-600">Értékesítési ciklus hossza</div>
                </div>
                <div class="rounded-2xl bg-sky-50 p-6 text-center">
                    <div class="text-4xl font-bold text-sky-600">+25%</div>
                    <div class="mt-2 text-sm text-gray-600">Lead-konverzió</div>
                </div>
                <div class="rounded-2xl bg-sky-50 p-6 text-center">
                    <div class="text-4xl font-bold text-sky-600">+35%</div>
                    <div class="mt-2 text-sm text-gray-600">Ügyfél-visszatérés</div>
                </div>
                <div class="rounded-2xl bg-sky-50 p-6 text-center">
                    <div class="text-4xl font-bold text-sky-600">-50%</div>
                    <div class="mt-2 text-sm text-gray-600">Admin-idő csökkenése</div>
                </div>
            </div>
        </div>
    </section>

    {{-- Integrations Section --}}
    <section class="bg-gray-50 py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto mb-12 max-w-3xl text-center">
                <h2 class="text-3xl font-semibold text-gray-900 sm:text-4xl">Integrációk</h2>
                <p class="mt-4 text-lg text-gray-600">Kapcsolódjon a már használt eszközeihez.</p>
            </div>

            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                <div class="flex items-center gap-4 rounded-xl bg-white p-6 shadow-sm">
                    <div class="flex h-12 w-12 items-center justify-center rounded-lg bg-sky-100">
                        <svg class="h-6 w-6 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-900">E-mail</h3>
                        <p class="text-sm text-gray-600">Gmail, Outlook, IMAP/SMTP</p>
                    </div>
                </div>
                <div class="flex items-center gap-4 rounded-xl bg-white p-6 shadow-sm">
                    <div class="flex h-12 w-12 items-center justify-center rounded-lg bg-sky-100">
                        <svg class="h-6 w-6 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-900">Naptár</h3>
                        <p class="text-sm text-gray-600">Google Calendar, Microsoft 365</p>
                    </div>
                </div>
                <div class="flex items-center gap-4 rounded-xl bg-white p-6 shadow-sm">
                    <div class="flex h-12 w-12 items-center justify-center rounded-lg bg-sky-100">
                        <svg class="h-6 w-6 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-900">Marketing</h3>
                        <p class="text-sm text-gray-600">Mailchimp, ActiveCampaign</p>
                    </div>
                </div>
                <div class="flex items-center gap-4 rounded-xl bg-white p-6 shadow-sm">
                    <div class="flex h-12 w-12 items-center justify-center rounded-lg bg-sky-100">
                        <svg class="h-6 w-6 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-900">Telefonálás</h3>
                        <p class="text-sm text-gray-600">VoIP integráció</p>
                    </div>
                </div>
                <div class="flex items-center gap-4 rounded-xl bg-white p-6 shadow-sm">
                    <div class="flex h-12 w-12 items-center justify-center rounded-lg bg-sky-100">
                        <svg class="h-6 w-6 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-900">Weboldal</h3>
                        <p class="text-sm text-gray-600">Webform-ok automatikus adatküldéssel</p>
                    </div>
                </div>
                <div class="flex items-center gap-4 rounded-xl bg-white p-6 shadow-sm">
                    <div class="flex h-12 w-12 items-center justify-center rounded-lg bg-sky-100">
                        <svg class="h-6 w-6 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-900">Számlázás</h3>
                        <p class="text-sm text-gray-600">Billingo, Számlázz.hu</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Who Uses Section --}}
    <section class="bg-white py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto mb-12 max-w-3xl text-center">
                <h2 class="text-3xl font-semibold text-gray-900 sm:text-4xl">Ki használja?</h2>
            </div>

            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
                <div class="rounded-2xl border border-gray-100 bg-white p-6 text-center shadow-sm">
                    <div class="mx-auto mb-4 flex h-14 w-14 items-center justify-center rounded-xl bg-sky-100">
                        <svg class="h-7 w-7 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                    <h3 class="mb-2 font-semibold text-gray-900">Értékesítési csapatok</h3>
                    <p class="text-sm text-gray-600">Pipeline-kezelés és előrejelzés</p>
                </div>
                <div class="rounded-2xl border border-gray-100 bg-white p-6 text-center shadow-sm">
                    <div class="mx-auto mb-4 flex h-14 w-14 items-center justify-center rounded-xl bg-sky-100">
                        <svg class="h-7 w-7 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </div>
                    <h3 class="mb-2 font-semibold text-gray-900">Ügyfélszolgálat</h3>
                    <p class="text-sm text-gray-600">Kapcsolattörténet és jegykezelés</p>
                </div>
                <div class="rounded-2xl border border-gray-100 bg-white p-6 text-center shadow-sm">
                    <div class="mx-auto mb-4 flex h-14 w-14 items-center justify-center rounded-xl bg-sky-100">
                        <svg class="h-7 w-7 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z" />
                        </svg>
                    </div>
                    <h3 class="mb-2 font-semibold text-gray-900">Marketing</h3>
                    <p class="text-sm text-gray-600">Lead-kezelés és kampány-követés</p>
                </div>
                <div class="rounded-2xl border border-gray-100 bg-white p-6 text-center shadow-sm">
                    <div class="mx-auto mb-4 flex h-14 w-14 items-center justify-center rounded-xl bg-sky-100">
                        <svg class="h-7 w-7 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                    </div>
                    <h3 class="mb-2 font-semibold text-gray-900">Vezetők</h3>
                    <p class="text-sm text-gray-600">Riportok és teljesítmény-monitoring</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Testimonials Section (hidden) --}}
    @if(false)
    <section class="bg-gray-50 py-16 lg:py-20">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto mb-12 max-w-3xl text-center">
                <h2 class="text-3xl font-semibold text-gray-900 sm:text-4xl">Amit ügyfeleink mondanak</h2>
            </div>

            <div class="grid gap-8 lg:grid-cols-2">
                <div class="rounded-2xl bg-white p-8 shadow-sm">
                    <div class="mb-6 flex items-center gap-1">
                        @for ($i = 0; $i < 5; $i++)
                            <svg class="h-5 w-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg>
                        @endfor
                    </div>
                    <blockquote class="mb-6 text-lg text-gray-700">
                        „Korábban Excelben vezettem az ügyfeleket. Most egy kattintással látom, kivel mikor beszéltünk,
                        és mi a következő lépés. Nem felejtek el senkit."
                    </blockquote>
                    <div class="flex items-center gap-4">
                        <div
                            class="flex h-12 w-12 items-center justify-center rounded-full bg-sky-100 text-sky-600 font-semibold">
                            KA</div>
                        <div>
                            <div class="font-semibold text-gray-900">Kovács Anna</div>
                            <div class="text-sm text-gray-500">Értékesítési vezető, B2B szolgáltató</div>
                        </div>
                    </div>
                </div>

                <div class="rounded-2xl bg-white p-8 shadow-sm">
                    <div class="mb-6 flex items-center gap-1">
                        @for ($i = 0; $i < 5; $i++)
                            <svg class="h-5 w-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg>
                        @endfor
                    </div>
                    <blockquote class="mb-6 text-lg text-gray-700">
                        „Az értékesítőim végre látják, hol tartanak az üzleteik. A havi meetingeken nem találgatunk,
                        hanem adatokra támaszkodunk."
                    </blockquote>
                    <div class="flex items-center gap-4">
                        <div
                            class="flex h-12 w-12 items-center justify-center rounded-full bg-sky-100 text-sky-600 font-semibold">
                            SP</div>
                        <div>
                            <div class="font-semibold text-gray-900">Szabó Péter</div>
                            <div class="text-sm text-gray-500">Kereskedelmi igazgató, IT cég</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif

    {{-- Related Modules Section --}}
    <section class="bg-gray-50 py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto mb-12 max-w-3xl text-center">
                <h2 class="text-3xl font-semibold text-gray-900 sm:text-4xl">Kapcsolódó modulok</h2>
                <p class="mt-4 text-lg text-gray-600">Bővítse a CRM-et ezekkel a modulokkal a még hatékonyabb
                    működésért.</p>
            </div>

            <div class="grid gap-6 sm:grid-cols-2">
                <a href="{{ route('products.ertekesites') }}"
                    class="group rounded-2xl border border-gray-100 bg-white p-6 shadow-sm transition-shadow hover:shadow-lg">
                    <div class="flex items-center gap-4">
                        <x-module-icon module="ertekesites" size="lg" />
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 group-hover:text-red-600">Értékesítés modul
                            </h3>
                            <p class="text-gray-600">Ajánlatok és megrendelések kezelése</p>
                        </div>
                    </div>
                </a>
                <a href="{{ route('products.automatizalas') }}"
                    class="group rounded-2xl border border-gray-100 bg-white p-6 shadow-sm transition-shadow hover:shadow-lg">
                    <div class="flex items-center gap-4">
                        <x-module-icon module="automatizalas" size="lg" />
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 group-hover:text-violet-600">Automatizálás
                                modul</h3>
                            <p class="text-gray-600">Lead-kezelési workflow-k automatizálása</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </section>

    {{-- Bottom CTA Section --}}
    <section class="bg-sky-600 py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-4 text-center sm:px-6 lg:px-8">
            <h2 class="text-3xl font-semibold text-white sm:text-4xl">
                Kezdje el még ma — kockázat nélkül
            </h2>
            <p class="mx-auto mt-4 max-w-xl text-lg text-sky-100">
                Teljes funkcionalitás, magyar nyelvű támogatás. Kérjen személyre szabott bemutatót.
            </p>
            <div class="mt-8 flex flex-col items-center justify-center gap-4 sm:flex-row">
                <a href="{{ route('register') }}"
                    class="inline-flex items-center justify-center gap-2 rounded-full bg-white px-8 py-4 text-base font-semibold text-sky-600 shadow-lg transition-colors hover:bg-sky-50 hover:shadow-xl">
                    Kezdés indítása
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M14 5l7 7m0 0l-7 7m7-7H3" />
                    </svg>
                </a>
                <a href="{{ route('contact') }}"
                    class="inline-flex items-center justify-center gap-2 rounded-full border-2 border-sky-400 px-8 py-4 text-base font-semibold text-white transition-colors hover:bg-sky-700">
                    Demó kérése
                </a>
                <a href="{{ route('login') }}"
                    class="inline-flex items-center justify-center gap-2 text-base font-medium text-sky-200 transition-colors hover:text-white">
                    Bejelentkezés a programba →
                </a>
            </div>
        </div>
    </section>
</div>
