<div>
    {{-- Hero Section --}}
    <section class="bg-linear-to-b from-violet-50 to-white py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto max-w-4xl text-center">
                <div class="mb-6 flex justify-center">
                    <x-module-icon module="automatizalas" size="xl" />
                </div>

                <div class="mb-6 inline-flex items-center gap-2 rounded-full bg-violet-100 px-4 py-1.5 text-sm font-medium text-violet-700">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                    Intelligens üzleti automatizáció
                </div>

                <h1 class="mb-6 text-4xl font-bold tracking-tight text-gray-900 sm:text-5xl lg:text-6xl">
                    Automatizálja üzleti
                    <span class="text-violet-600">folyamatait</span>
                </h1>

                <p class="mx-auto mb-10 max-w-2xl text-lg text-gray-600 sm:text-xl">
                    Szabaduljon meg az ismétlődő manuális feladatoktól. Az Automatizálás modul
                    intelligens workflow-kkal és triggerekkel optimalizálja vállalkozása működését.
                </p>

                <div class="mt-8 flex flex-col items-center justify-center gap-4 sm:flex-row">
                    <a href="{{ route('register') }}"
                        class="inline-flex items-center justify-center gap-2 rounded-full bg-violet-600 px-8 py-4 text-base font-semibold text-white shadow-lg transition-colors hover:bg-violet-700 hover:shadow-xl">
                        Kezdés indítása
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </a>
                    <a href="{{ route('contact') }}"
                        class="inline-flex items-center justify-center gap-2 rounded-full border-2 border-violet-200 bg-white px-8 py-4 text-base font-semibold text-violet-700 transition-colors hover:bg-violet-50">
                        Demó kérése
                    </a>
                    <a href="{{ route('login') }}"
                        class="inline-flex items-center justify-center gap-2 text-base font-medium text-violet-600 transition-colors hover:text-violet-800">
                        Bejelentkezés a programba →
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{-- Problem Section --}}
    <section class="bg-gray-50 py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto max-w-3xl text-center">
                <h2 class="mb-4 text-3xl font-bold text-gray-900 sm:text-4xl">
                    Ismerős problémák?
                </h2>
                <p class="text-lg text-gray-600">
                    A manuális, ismétlődő feladatok rengeteg időt és energiát emésztenek fel.
                </p>
            </div>

            <div class="mt-12 grid gap-8 md:grid-cols-2 lg:grid-cols-4">
                <div class="rounded-xl bg-white p-6 shadow-sm">
                    <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-lg bg-red-100">
                        <svg class="h-6 w-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="mb-2 font-semibold text-gray-900">Ismétlődő feladatok</h3>
                    <p class="text-sm text-gray-600">Munkatársai napi szinten ugyanazokat a manuális lépéseket hajtják végre újra és újra.</p>
                </div>

                <div class="rounded-xl bg-white p-6 shadow-sm">
                    <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-lg bg-red-100">
                        <svg class="h-6 w-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                    </div>
                    <h3 class="mb-2 font-semibold text-gray-900">Emberi hibák</h3>
                    <p class="text-sm text-gray-600">A manuális adatrögzítés és -átadás során gyakran előfordulnak elfelejtett vagy hibás műveletek.</p>
                </div>

                <div class="rounded-xl bg-white p-6 shadow-sm">
                    <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-lg bg-red-100">
                        <svg class="h-6 w-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 17h8m0 0V9m0 8l-8-8-4 4-6-6" />
                        </svg>
                    </div>
                    <h3 class="mb-2 font-semibold text-gray-900">Lassú folyamatok</h3>
                    <p class="text-sm text-gray-600">Az információk késve jutnak el a megfelelő személyek számára, ami lassítja a döntéshozatalt.</p>
                </div>

                <div class="rounded-xl bg-white p-6 shadow-sm">
                    <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-lg bg-red-100">
                        <svg class="h-6 w-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="mb-2 font-semibold text-gray-900">Motiválatlan csapat</h3>
                    <p class="text-sm text-gray-600">Az unalmas, ismétlődő feladatok csökkentik a munkatársak elégedettségét és hatékonyságát.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Features Section --}}
    <section class="py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto max-w-3xl text-center">
                <div class="mb-4 inline-flex items-center gap-2 rounded-full bg-violet-100 px-4 py-1.5 text-sm font-medium text-violet-700">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                    </svg>
                    Funkciók
                </div>
                <h2 class="mb-4 text-3xl font-bold text-gray-900 sm:text-4xl">
                    Minden, amire szüksége van az automatizáláshoz
                </h2>
                <p class="text-lg text-gray-600">
                    Átfogó eszköztár a munkafolyamatok automatizálásához és optimalizálásához.
                </p>
            </div>

            <div class="mt-16 grid gap-8 md:grid-cols-2 lg:grid-cols-3">
                {{-- Feature 1 --}}
                <div class="rounded-2xl border border-gray-100 bg-white p-8 shadow-sm transition hover:shadow-md">
                    <div class="mb-6 flex h-14 w-14 items-center justify-center rounded-xl bg-violet-100">
                        <svg class="h-7 w-7 text-violet-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                        </svg>
                    </div>
                    <h3 class="mb-3 text-xl font-semibold text-gray-900">Workflow builder</h3>
                    <p class="mb-4 text-gray-600">
                        Vizuális drag-and-drop felületen tervezze meg üzleti folyamatait programozás nélkül.
                    </p>
                    <ul class="space-y-2 text-sm text-gray-600">
                        <li class="flex items-center gap-2">
                            <svg class="h-4 w-4 text-violet-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Drag-and-drop szerkesztő
                        </li>
                        <li class="flex items-center gap-2">
                            <svg class="h-4 w-4 text-violet-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Elágazások és feltételrendszer
                        </li>
                        <li class="flex items-center gap-2">
                            <svg class="h-4 w-4 text-violet-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Sablonok és példák
                        </li>
                    </ul>
                </div>

                {{-- Feature 2 --}}
                <div class="rounded-2xl border border-gray-100 bg-white p-8 shadow-sm transition hover:shadow-md">
                    <div class="mb-6 flex h-14 w-14 items-center justify-center rounded-xl bg-violet-100">
                        <svg class="h-7 w-7 text-violet-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                        </svg>
                    </div>
                    <h3 class="mb-3 text-xl font-semibold text-gray-900">Triggerek és események</h3>
                    <p class="mb-4 text-gray-600">
                        Állítson be automatikus akciókat, amelyek események bekövetkeztekor futnak le.
                    </p>
                    <ul class="space-y-2 text-sm text-gray-600">
                        <li class="flex items-center gap-2">
                            <svg class="h-4 w-4 text-violet-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Időalapúak és ütemezettek
                        </li>
                        <li class="flex items-center gap-2">
                            <svg class="h-4 w-4 text-violet-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Adatváltozáson alapuló
                        </li>
                        <li class="flex items-center gap-2">
                            <svg class="h-4 w-4 text-violet-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Felhasználói akció alapú
                        </li>
                    </ul>
                </div>

                {{-- Feature 3 --}}
                <div class="rounded-2xl border border-gray-100 bg-white p-8 shadow-sm transition hover:shadow-md">
                    <div class="mb-6 flex h-14 w-14 items-center justify-center rounded-xl bg-violet-100">
                        <svg class="h-7 w-7 text-violet-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <h3 class="mb-3 text-xl font-semibold text-gray-900">Automatikus értesítések</h3>
                    <p class="mb-4 text-gray-600">
                        Küldjön automatikusan emaileket, SMS-eket vagy rendszerértesítéseket az eseményekről.
                    </p>
                    <ul class="space-y-2 text-sm text-gray-600">
                        <li class="flex items-center gap-2">
                            <svg class="h-4 w-4 text-violet-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Email sablonok
                        </li>
                        <li class="flex items-center gap-2">
                            <svg class="h-4 w-4 text-violet-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            SMS és push értesítések
                        </li>
                        <li class="flex items-center gap-2">
                            <svg class="h-4 w-4 text-violet-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Slack és Teams integráció
                        </li>
                    </ul>
                </div>

                {{-- Feature 4 --}}
                <div class="rounded-2xl border border-gray-100 bg-white p-8 shadow-sm transition hover:shadow-md">
                    <div class="mb-6 flex h-14 w-14 items-center justify-center rounded-xl bg-violet-100">
                        <svg class="h-7 w-7 text-violet-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <h3 class="mb-3 text-xl font-semibold text-gray-900">Dokumentum generálás</h3>
                    <p class="mb-4 text-gray-600">
                        Hozzon létre automatikusan számlákat, szerződéseket, jelentéseket és más dokumentumokat.
                    </p>
                    <ul class="space-y-2 text-sm text-gray-600">
                        <li class="flex items-center gap-2">
                            <svg class="h-4 w-4 text-violet-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            PDF és Word export
                        </li>
                        <li class="flex items-center gap-2">
                            <svg class="h-4 w-4 text-violet-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Testreszabható sablonok
                        </li>
                        <li class="flex items-center gap-2">
                            <svg class="h-4 w-4 text-violet-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Automatikus számozás
                        </li>
                    </ul>
                </div>

                {{-- Feature 5 --}}
                <div class="rounded-2xl border border-gray-100 bg-white p-8 shadow-sm transition hover:shadow-md">
                    <div class="mb-6 flex h-14 w-14 items-center justify-center rounded-xl bg-violet-100">
                        <svg class="h-7 w-7 text-violet-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" />
                        </svg>
                    </div>
                    <h3 class="mb-3 text-xl font-semibold text-gray-900">Adatszinkronizálás</h3>
                    <p class="mb-4 text-gray-600">
                        Tartsa szinkronban az adatokat a különböző modulok és külső rendszerek között.
                    </p>
                    <ul class="space-y-2 text-sm text-gray-600">
                        <li class="flex items-center gap-2">
                            <svg class="h-4 w-4 text-violet-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Két- és egyirányú szinkron
                        </li>
                        <li class="flex items-center gap-2">
                            <svg class="h-4 w-4 text-violet-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Adatleképezések
                        </li>
                        <li class="flex items-center gap-2">
                            <svg class="h-4 w-4 text-violet-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Konfliktuskezelés
                        </li>
                    </ul>
                </div>

                {{-- Feature 6 --}}
                <div class="rounded-2xl border border-gray-100 bg-white p-8 shadow-sm transition hover:shadow-md">
                    <div class="mb-6 flex h-14 w-14 items-center justify-center rounded-xl bg-violet-100">
                        <svg class="h-7 w-7 text-violet-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                    </div>
                    <h3 class="mb-3 text-xl font-semibold text-gray-900">Automatizálási riportok</h3>
                    <p class="mb-4 text-gray-600">
                        Kövesse nyomon az automatizációk teljesítményét és azonosítsa az optimalizálási lehetőségeket.
                    </p>
                    <ul class="space-y-2 text-sm text-gray-600">
                        <li class="flex items-center gap-2">
                            <svg class="h-4 w-4 text-violet-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Futási statisztikák
                        </li>
                        <li class="flex items-center gap-2">
                            <svg class="h-4 w-4 text-violet-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Hibajelentések
                        </li>
                        <li class="flex items-center gap-2">
                            <svg class="h-4 w-4 text-violet-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Időmegtakarítás mérőszámok
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    {{-- Results Section --}}
    <section class="bg-violet-600 py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto max-w-3xl text-center">
                <h2 class="mb-4 text-3xl font-bold text-white sm:text-4xl">
                    Mérhető eredmények
                </h2>
                <p class="text-lg text-violet-100">
                    Ügyfeleink által elért átlagos javulások az automatizáció bevezetésének első 6 hónapjában.
                </p>
            </div>

            <div class="mt-12 grid gap-8 sm:grid-cols-2 lg:grid-cols-5">
                <div class="rounded-xl bg-white/10 p-6 text-center backdrop-blur-sm">
                    <div class="mb-2 text-4xl font-bold text-white">75%</div>
                    <div class="text-sm text-violet-100">Kevesebb manuális feladat</div>
                </div>
                <div class="rounded-xl bg-white/10 p-6 text-center backdrop-blur-sm">
                    <div class="mb-2 text-4xl font-bold text-white">60%</div>
                    <div class="text-sm text-violet-100">Gyorsabb folyamatok</div>
                </div>
                <div class="rounded-xl bg-white/10 p-6 text-center backdrop-blur-sm">
                    <div class="mb-2 text-4xl font-bold text-white">90%</div>
                    <div class="text-sm text-violet-100">Kevesebb emberi hiba</div>
                </div>
                <div class="rounded-xl bg-white/10 p-6 text-center backdrop-blur-sm">
                    <div class="mb-2 text-4xl font-bold text-white">40%</div>
                    <div class="text-sm text-violet-100">Több időmegtakarítás</div>
                </div>
                <div class="rounded-xl bg-white/10 p-6 text-center backdrop-blur-sm">
                    <div class="mb-2 text-4xl font-bold text-white">3x</div>
                    <div class="text-sm text-violet-100">ROI 12 hónap alatt</div>
                </div>
            </div>
        </div>
    </section>

    {{-- Integrations Section --}}
    <section class="py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto max-w-3xl text-center">
                <div class="mb-4 inline-flex items-center gap-2 rounded-full bg-violet-100 px-4 py-1.5 text-sm font-medium text-violet-700">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
                    </svg>
                    Integrációk
                </div>
                <h2 class="mb-4 text-3xl font-bold text-gray-900 sm:text-4xl">
                    Kapcsolódjon kedvenc eszközeihez
                </h2>
                <p class="text-lg text-gray-600">
                    Automatizálja a munkafolyamatokat a már használt rendszerekkel.
                </p>
            </div>

            <div class="mt-12 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                <div class="flex items-center gap-4 rounded-xl border border-gray-100 bg-white p-6 shadow-sm">
                    <div class="flex h-12 w-12 items-center justify-center rounded-lg bg-gray-100">
                        <svg class="h-6 w-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-900">Email szolgáltatók</h3>
                        <p class="text-sm text-gray-600">Gmail, Outlook, SMTP</p>
                    </div>
                </div>

                <div class="flex items-center gap-4 rounded-xl border border-gray-100 bg-white p-6 shadow-sm">
                    <div class="flex h-12 w-12 items-center justify-center rounded-lg bg-gray-100">
                        <svg class="h-6 w-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-900">Kommunikáció</h3>
                        <p class="text-sm text-gray-600">Slack, Teams, Discord</p>
                    </div>
                </div>

                <div class="flex items-center gap-4 rounded-xl border border-gray-100 bg-white p-6 shadow-sm">
                    <div class="flex h-12 w-12 items-center justify-center rounded-lg bg-gray-100">
                        <svg class="h-6 w-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-900">Felhőtárhelyek</h3>
                        <p class="text-sm text-gray-600">Google Drive, Dropbox, OneDrive</p>
                    </div>
                </div>

                <div class="flex items-center gap-4 rounded-xl border border-gray-100 bg-white p-6 shadow-sm">
                    <div class="flex h-12 w-12 items-center justify-center rounded-lg bg-gray-100">
                        <svg class="h-6 w-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-900">Pénzügyi rendszerek</h3>
                        <p class="text-sm text-gray-600">NAV, Számlázó, Billingo</p>
                    </div>
                </div>

                <div class="flex items-center gap-4 rounded-xl border border-gray-100 bg-white p-6 shadow-sm">
                    <div class="flex h-12 w-12 items-center justify-center rounded-lg bg-gray-100">
                        <svg class="h-6 w-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-900">Webhook és API</h3>
                        <p class="text-sm text-gray-600">REST API, Webhooks, Zapier</p>
                    </div>
                </div>

                <div class="flex items-center gap-4 rounded-xl border border-gray-100 bg-white p-6 shadow-sm">
                    <div class="flex h-12 w-12 items-center justify-center rounded-lg bg-gray-100">
                        <svg class="h-6 w-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-900">Naptárak</h3>
                        <p class="text-sm text-gray-600">Google Calendar, Outlook</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Who Uses Section --}}
    <section class="bg-gray-50 py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto max-w-3xl text-center">
                <h2 class="mb-4 text-3xl font-bold text-gray-900 sm:text-4xl">
                    Kiknek készült?
                </h2>
                <p class="text-lg text-gray-600">
                    Az Automatizálás modul minden olyan csapat számára ideális, akik hatékonyabban szeretnének dolgozni.
                </p>
            </div>

            <div class="mt-12 grid gap-8 sm:grid-cols-2 lg:grid-cols-4">
                <div class="rounded-xl bg-white p-6 shadow-sm">
                    <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-lg bg-violet-100">
                        <svg class="h-6 w-6 text-violet-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                    </div>
                    <h3 class="mb-2 font-semibold text-gray-900">Irodavezetők</h3>
                    <p class="text-sm text-gray-600">Automatizálják az adminisztratív feladatokat és a csapaton belüli kommunikációt.</p>
                </div>

                <div class="rounded-xl bg-white p-6 shadow-sm">
                    <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-lg bg-violet-100">
                        <svg class="h-6 w-6 text-violet-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                        </svg>
                    </div>
                    <h3 class="mb-2 font-semibold text-gray-900">Folyamatmenedzserek</h3>
                    <p class="text-sm text-gray-600">Optimalizálják és automatizálják a vállalati üzleti folyamatokat.</p>
                </div>

                <div class="rounded-xl bg-white p-6 shadow-sm">
                    <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-lg bg-violet-100">
                        <svg class="h-6 w-6 text-violet-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>
                    <h3 class="mb-2 font-semibold text-gray-900">IT csapatok</h3>
                    <p class="text-sm text-gray-600">Integrációt és rendszerautomatizációt valósítanak meg a vállalaton belül.</p>
                </div>

                <div class="rounded-xl bg-white p-6 shadow-sm">
                    <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-lg bg-violet-100">
                        <svg class="h-6 w-6 text-violet-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                        </svg>
                    </div>
                    <h3 class="mb-2 font-semibold text-gray-900">Vállalkozók</h3>
                    <p class="text-sm text-gray-600">Kevesebb erőforrással többet érnek el a mindennapi működésben.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Testimonials Section (hidden) --}}
    @if(false)
    <section class="py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto max-w-3xl text-center">
                <h2 class="mb-4 text-3xl font-bold text-gray-900 sm:text-4xl">
                    Ügyfeleink véleménye
                </h2>
                <p class="text-lg text-gray-600">
                    Ismerje meg, hogyan segítette az Automatizálás modul más vállalkozásokat.
                </p>
            </div>

            <div class="mt-12 grid gap-8 lg:grid-cols-2">
                <div class="rounded-2xl bg-gray-50 p-8">
                    <div class="mb-6 flex items-center gap-1">
                        @for ($i = 0; $i < 5; $i++)
                            <svg class="h-5 w-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg>
                        @endfor
                    </div>
                    <blockquote class="mb-6 text-gray-700">
                        "Az automatizálás bevezetésének előtt a csapatunk napi 3-4 órát töltött ismétlődő adminisztratív feladatokkal. Ma már ezek többsége automatikusan történik, és a kollégák értékesebb munkára tudnak koncentrálni."
                    </blockquote>
                    <div class="flex items-center gap-4">
                        <div class="flex h-12 w-12 items-center justify-center rounded-full bg-violet-200 font-semibold text-violet-700">
                            NK
                        </div>
                        <div>
                            <div class="font-semibold text-gray-900">Nagy Katalin</div>
                            <div class="text-sm text-gray-600">Operációs igazgató, LogiTech Kft.</div>
                        </div>
                    </div>
                </div>

                <div class="rounded-2xl bg-gray-50 p-8">
                    <div class="mb-6 flex items-center gap-1">
                        @for ($i = 0; $i < 5; $i++)
                            <svg class="h-5 w-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg>
                        @endfor
                    </div>
                    <blockquote class="mb-6 text-gray-700">
                        "A workflow-ket kezdetben szépen, egyenként állítottuk be, de már az első hónapban 90%-kal csökkent az emberi hibák száma. A rendszer megbízhatóan működik, és a csapat motiváltabb lett."
                    </blockquote>
                    <div class="flex items-center gap-4">
                        <div class="flex h-12 w-12 items-center justify-center rounded-full bg-violet-200 font-semibold text-violet-700">
                            FT
                        </div>
                        <div>
                            <div class="font-semibold text-gray-900">Fehér Tamás</div>
                            <div class="text-sm text-gray-600">IT vezető, MediaPrint Zrt.</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif

    {{-- Related Modules Section --}}
    <section class="py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto max-w-3xl text-center">
                <h2 class="mb-4 text-3xl font-bold text-gray-900 sm:text-4xl">
                    Kapcsolódó modulok
                </h2>
                <p class="text-lg text-gray-600">
                    Bővítse az Automatizálás modult más Cégem360 modulokkal a teljes körű működés érdekében.
                </p>
            </div>

            <div class="mt-12 grid gap-8 md:grid-cols-2">
                <a href="{{ route('products.crm') }}" class="group flex gap-6 rounded-2xl border border-gray-100 bg-white p-6 shadow-sm transition hover:shadow-md">
                    <div class="flex h-16 w-16 shrink-0 items-center justify-center rounded-xl bg-sky-100">
                        <x-module-icon module="crm" size="lg" />
                    </div>
                    <div>
                        <h3 class="mb-2 text-xl font-semibold text-gray-900 group-hover:text-sky-600">CRM</h3>
                        <p class="text-gray-600">Automatizálja az ügyfélkapcsolati folyamatokat: follow-up emailek, lead pontozás, feladat-hozzárendelések.</p>
                    </div>
                </a>

                <a href="{{ route('products.gyartas') }}" class="group flex gap-6 rounded-2xl border border-gray-100 bg-white p-6 shadow-sm transition hover:shadow-md">
                    <div class="flex h-16 w-16 shrink-0 items-center justify-center rounded-xl bg-indigo-100">
                        <x-module-icon module="gyartas" size="lg" />
                    </div>
                    <div>
                        <h3 class="mb-2 text-xl font-semibold text-gray-900 group-hover:text-indigo-600">Gyártásirányítás</h3>
                        <p class="text-gray-600">Automatizálja a gyártási folyamatokat: munkautasítások generálása, minőség-ellenőrzési riasztások.</p>
                    </div>
                </a>
            </div>
        </div>
    </section>

    {{-- Bottom CTA Section --}}
    <section class="bg-linear-to-br from-violet-600 to-violet-800 py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto max-w-3xl text-center">
                <h2 class="mb-6 text-3xl font-bold text-white sm:text-4xl">
                    Készen áll a folyamatok automatizálására?
                </h2>
                <p class="mb-10 text-lg text-violet-100">
                    Teljes funkcionalitás, magyar nyelvű támogatás. Kérjen személyre szabott bemutatót.
                </p>
                <div class="flex flex-col items-center justify-center gap-4 sm:flex-row">
                    <a href="{{ route('register') }}"
                        class="inline-flex items-center justify-center gap-2 rounded-full bg-white px-8 py-4 text-base font-semibold text-violet-600 shadow-lg transition-colors hover:bg-violet-50 hover:shadow-xl">
                        Kezdés indítása
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </a>
                    <a href="{{ route('contact') }}"
                        class="inline-flex items-center justify-center gap-2 rounded-full border-2 border-violet-400 px-8 py-4 text-base font-semibold text-white transition-colors hover:bg-violet-700">
                        Demó kérése
                    </a>
                    <a href="{{ route('login') }}"
                        class="inline-flex items-center justify-center gap-2 text-base font-medium text-violet-200 transition-colors hover:text-white">
                        Bejelentkezés a programba →
                    </a>
                </div>
            </div>
        </div>
    </section>
</div>
