<div>
    {{-- Hero Section --}}
    <section class="bg-linear-to-b from-violet-50 to-white py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto max-w-4xl text-center">
                <div class="mb-6 flex justify-center">
                    <x-module-icon module="datamind" size="xl" />
                </div>
                <div
                    class="mb-6 inline-flex items-center gap-2 rounded-full bg-violet-100 px-4 py-1.5 text-sm font-medium text-violet-700">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                    MI Alapú Üzleti Intelligencia
                </div>
                <h1 class="mb-6 text-4xl font-semibold leading-tight text-gray-900 sm:text-5xl lg:text-6xl">
                    Adataiból üzleti előnyt csinálunk — mesterséges intelligenciával
                </h1>
                <p class="mx-auto max-w-3xl text-lg leading-relaxed text-gray-600 sm:text-xl">
                    A Cégem 360 DataMind automatikusan feltárja a marketing adatokban rejlő összefüggéseket,
                    előrejelzi a trendeket és javaslatokat ad — kódolás nélkül, drag-and-drop felületen.
                </p>

                {{-- CTA Buttons --}}
                <div class="mt-8 flex flex-col items-center justify-center gap-4 sm:flex-row">
                    <a href="{{ route('contact') }}"
                        class="inline-flex items-center justify-center gap-2 rounded-full bg-violet-500 px-8 py-4 text-base font-semibold text-white shadow-lg transition-colors hover:bg-violet-600 hover:shadow-xl">
                        Demó kérése
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </a>
                    <a href="#funkciok"
                        class="inline-flex items-center justify-center gap-2 rounded-full border-2 border-violet-200 bg-white px-8 py-4 text-base font-semibold text-violet-700 transition-colors hover:bg-violet-50">
                        Funkciók megtekintése
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{-- Problem Section --}}
    <section class="bg-white py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto mb-12 max-w-3xl text-center">
                <h2 class="text-3xl font-semibold text-gray-900 sm:text-4xl">Ismerős problémák?</h2>
            </div>

            <div class="grid gap-6 sm:grid-cols-2">
                <div class="rounded-2xl border border-violet-100 bg-linear-to-br from-violet-50 to-white p-8">
                    <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-xl bg-white shadow-sm">
                        <svg class="h-6 w-6 text-violet-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3.375 19.5h17.25m-17.25 0a1.125 1.125 0 01-1.125-1.125M3.375 19.5h7.5c.621 0 1.125-.504 1.125-1.125m-9.75 0V5.625m0 12.75v-1.5c0-.621.504-1.125 1.125-1.125m18.375 2.625V5.625m0 12.75c0 .621-.504 1.125-1.125 1.125m1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125m0 3.75h-7.5A1.125 1.125 0 0112 18.375" />
                        </svg>
                    </div>
                    <h3 class="mb-2 text-lg font-semibold text-gray-900">Szétszórt adatok</h3>
                    <p class="text-gray-600">Google Analytics, Ads, Search Console — mindegyik külön felületen,
                        manuális összesítés.</p>
                </div>
                <div class="rounded-2xl border border-violet-100 bg-linear-to-br from-violet-50 to-white p-8">
                    <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-xl bg-white shadow-sm">
                        <svg class="h-6 w-6 text-violet-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="mb-2 text-lg font-semibold text-gray-900">Lassú riportolás</h3>
                    <p class="text-gray-600">Heti órákat tölt Excel táblázatok összeállításával, ahelyett hogy
                        döntéseket hozna.</p>
                </div>
                <div class="rounded-2xl border border-violet-100 bg-linear-to-br from-violet-50 to-white p-8">
                    <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-xl bg-white shadow-sm">
                        <svg class="h-6 w-6 text-violet-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                    <h3 class="mb-2 text-lg font-semibold text-gray-900">Rejtett összefüggések</h3>
                    <p class="text-gray-600">Nem látja, mi hat mire — melyik kampány hozza a konverziót, mi okozza a
                        forgalomcsökkenést.</p>
                </div>
                <div class="rounded-2xl border border-violet-100 bg-linear-to-br from-violet-50 to-white p-8">
                    <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-xl bg-white shadow-sm">
                        <svg class="h-6 w-6 text-violet-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="mb-2 text-lg font-semibold text-gray-900">Reaktív döntéshozatal</h3>
                    <p class="text-gray-600">Mindig utólag reagál, ahelyett hogy előre látná a trendeket és megelőzné a
                        problémákat.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Features Section --}}
    <section id="funkciok" class="bg-gray-50 py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto mb-12 max-w-3xl text-center">
                <h2 class="text-3xl font-semibold text-gray-900 sm:text-4xl">Mindent egy platformon</h2>
                <p class="mt-4 text-lg text-gray-600">MI alapú adatbányász és üzleti intelligencia — 6 integrált
                    képesség egyetlen felületen.</p>
            </div>

            <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-3">
                {{-- Feature 1 --}}
                <div class="rounded-2xl bg-white p-8 shadow-sm">
                    <div
                        class="mb-4 flex h-12 w-12 items-center justify-center rounded-xl bg-violet-100 text-violet-500">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
                        </svg>
                    </div>
                    <h3 class="mb-2 text-lg font-semibold text-gray-900">Adatintegráció</h3>
                    <ul class="space-y-2 text-sm text-gray-600">
                        <li class="flex items-start gap-2">
                            <svg class="mt-0.5 h-4 w-4 shrink-0 text-violet-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            Google Analytics, Search Console, Ads
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="mt-0.5 h-4 w-4 shrink-0 text-violet-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            CSV, adatbázisok, ERP és CRM
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="mt-0.5 h-4 w-4 shrink-0 text-violet-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            Egyetlen egységes adattárház
                        </li>
                    </ul>
                </div>

                {{-- Feature 2 --}}
                <div class="rounded-2xl bg-white p-8 shadow-sm">
                    <div
                        class="mb-4 flex h-12 w-12 items-center justify-center rounded-xl bg-violet-100 text-violet-500">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                    <h3 class="mb-2 text-lg font-semibold text-gray-900">Valós idejű elemzés</h3>
                    <ul class="space-y-2 text-sm text-gray-600">
                        <li class="flex items-start gap-2">
                            <svg class="mt-0.5 h-4 w-4 shrink-0 text-violet-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            Streaming adatfeldolgozás
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="mt-0.5 h-4 w-4 shrink-0 text-violet-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            Azonnali anomália-észlelés
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="mt-0.5 h-4 w-4 shrink-0 text-violet-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            KPI riasztások és értesítések
                        </li>
                    </ul>
                </div>

                {{-- Feature 3 --}}
                <div class="rounded-2xl bg-white p-8 shadow-sm">
                    <div
                        class="mb-4 flex h-12 w-12 items-center justify-center rounded-xl bg-violet-100 text-violet-500">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <h3 class="mb-2 text-lg font-semibold text-gray-900">MI modellépítő</h3>
                    <ul class="space-y-2 text-sm text-gray-600">
                        <li class="flex items-start gap-2">
                            <svg class="mt-0.5 h-4 w-4 shrink-0 text-violet-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            Drag-and-drop felület
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="mt-0.5 h-4 w-4 shrink-0 text-violet-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            Menedzseri és szakértői mód
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="mt-0.5 h-4 w-4 shrink-0 text-violet-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            Nem kell programozni
                        </li>
                    </ul>
                </div>

                {{-- Feature 4 --}}
                <div class="rounded-2xl bg-white p-8 shadow-sm">
                    <div
                        class="mb-4 flex h-12 w-12 items-center justify-center rounded-xl bg-violet-100 text-violet-500">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 013 19.875v-6.75zM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V8.625zM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V4.125z" />
                        </svg>
                    </div>
                    <h3 class="mb-2 text-lg font-semibold text-gray-900">Prediktív elemzés</h3>
                    <ul class="space-y-2 text-sm text-gray-600">
                        <li class="flex items-start gap-2">
                            <svg class="mt-0.5 h-4 w-4 shrink-0 text-violet-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            Forgalom-előrejelzés
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="mt-0.5 h-4 w-4 shrink-0 text-violet-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            Konverzió predikció
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="mt-0.5 h-4 w-4 shrink-0 text-violet-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            Költségoptimalizálás és churn előrejelzés
                        </li>
                    </ul>
                </div>

                {{-- Feature 5 --}}
                <div class="rounded-2xl bg-white p-8 shadow-sm">
                    <div
                        class="mb-4 flex h-12 w-12 items-center justify-center rounded-xl bg-violet-100 text-violet-500">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                    <h3 class="mb-2 text-lg font-semibold text-gray-900">Összefüggés-feltárás</h3>
                    <ul class="space-y-2 text-sm text-gray-600">
                        <li class="flex items-start gap-2">
                            <svg class="mt-0.5 h-4 w-4 shrink-0 text-violet-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            Automatikus korreláció-keresés
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="mt-0.5 h-4 w-4 shrink-0 text-violet-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            Ügyfél-szegmentáció
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="mt-0.5 h-4 w-4 shrink-0 text-violet-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            Mintázat-azonosítás
                        </li>
                    </ul>
                </div>

                {{-- Feature 6 --}}
                <div class="rounded-2xl bg-white p-8 shadow-sm">
                    <div
                        class="mb-4 flex h-12 w-12 items-center justify-center rounded-xl bg-violet-100 text-violet-500">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                        </svg>
                    </div>
                    <h3 class="mb-2 text-lg font-semibold text-gray-900">Automatikus riportok</h3>
                    <ul class="space-y-2 text-sm text-gray-600">
                        <li class="flex items-start gap-2">
                            <svg class="mt-0.5 h-4 w-4 shrink-0 text-violet-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            Magyar nyelvű MI összefoglalók
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="mt-0.5 h-4 w-4 shrink-0 text-violet-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            Akcióterv javaslatok
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="mt-0.5 h-4 w-4 shrink-0 text-violet-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            Iparági benchmark összehasonlítás
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    {{-- Workflow Section --}}
    <section class="bg-white py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto mb-12 max-w-3xl text-center">
                <h2 class="text-3xl font-semibold text-gray-900 sm:text-4xl">Hogyan működik?</h2>
            </div>

            <div class="mx-auto max-w-4xl">
                <div class="space-y-8">
                    <div class="flex items-start gap-6">
                        <div
                            class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-violet-500 text-sm font-bold text-white">
                            1</div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">Adatforrások csatlakoztatása</h3>
                            <p class="mt-1 text-gray-600">Kösse össze Google fiókjait, töltse fel CSV-jét vagy
                                csatlakoztassa adatbázisát — pár kattintással.</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-6">
                        <div
                            class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-violet-500 text-sm font-bold text-white">
                            2</div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">Automatikus adattisztítás</h3>
                            <p class="mt-1 text-gray-600">Az ETL pipeline megtisztítja, normalizálja és egységesíti
                                az adatokat az adattárházba.</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-6">
                        <div
                            class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-violet-500 text-sm font-bold text-white">
                            3</div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">MI elemzés indul</h3>
                            <p class="mt-1 text-gray-600">A rendszer automatikusan futtatja az anomália-detektálást,
                                trend-elemzést és korrelációkeresést.</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-6">
                        <div
                            class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-violet-500 text-sm font-bold text-white">
                            4</div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">Modell építése</h3>
                            <p class="mt-1 text-gray-600">A drag-and-drop felületen válassza ki a célváltozót
                                — a rendszer automatikusan megépíti a legjobb modellt.</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-6">
                        <div
                            class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-violet-500 text-sm font-bold text-white">
                            5</div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">Javaslatok és döntések</h3>
                            <p class="mt-1 text-gray-600">Kapjon azonnali, magyar nyelvű MI javaslatokat és akciótervt
                                a dashboardon és e-mailben.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Results Section --}}
    <section class="bg-violet-500 py-16 lg:py-20">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto mb-12 max-w-3xl text-center">
                <h2 class="text-3xl font-semibold text-white sm:text-4xl">Mérhető eredmények</h2>
                <p class="mt-4 text-lg text-violet-100">Átlagos javulás ügyfeleink körében a DataMind bevezetése
                    után.</p>
            </div>

            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                <div class="rounded-2xl bg-white/10 p-6 text-center backdrop-blur-sm">
                    <p class="text-4xl font-bold text-white">-75%</p>
                    <p class="mt-2 text-violet-100">riportidő csökkenés</p>
                </div>
                <div class="rounded-2xl bg-white/10 p-6 text-center backdrop-blur-sm">
                    <p class="text-4xl font-bold text-white">3x</p>
                    <p class="mt-2 text-violet-100">gyorsabb döntéshozatal</p>
                </div>
                <div class="rounded-2xl bg-white/10 p-6 text-center backdrop-blur-sm">
                    <p class="text-4xl font-bold text-white">+40%</p>
                    <p class="mt-2 text-violet-100">több feltárt összefüggés</p>
                </div>
                <div class="rounded-2xl bg-white/10 p-6 text-center backdrop-blur-sm">
                    <p class="text-4xl font-bold text-white">+25%</p>
                    <p class="mt-2 text-violet-100">marketing ROI javulás</p>
                </div>
                <div class="rounded-2xl bg-white/10 p-6 text-center backdrop-blur-sm">
                    <p class="text-4xl font-bold text-white">-90%</p>
                    <p class="mt-2 text-violet-100">emberi hiba csökkenés</p>
                </div>
                <div class="rounded-2xl bg-white/10 p-6 text-center backdrop-blur-sm">
                    <p class="text-4xl font-bold text-white">6+</p>
                    <p class="mt-2 text-violet-100">adatforrás integráció</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Integrations Section --}}
    <section class="bg-white py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto mb-12 max-w-3xl text-center">
                <h2 class="text-3xl font-semibold text-gray-900 sm:text-4xl">Csatlakozik a meglévő eszközeihez</h2>
                <p class="mt-4 text-lg text-gray-600">Előre konfigurált integrációk a legnépszerűbb adatforrásokhoz.
                </p>
            </div>

            <div class="mx-auto grid max-w-4xl gap-4 sm:grid-cols-2 lg:grid-cols-3">
                <div class="flex items-center gap-3 rounded-xl border border-gray-200 p-4">
                    <div
                        class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-yellow-50 text-xs font-bold text-yellow-600">
                        GA</div>
                    <div>
                        <p class="text-sm font-semibold text-gray-900">Google Analytics 4</p>
                        <p class="text-xs text-gray-400">Forgalmi adatok, konverziók</p>
                    </div>
                </div>
                <div class="flex items-center gap-3 rounded-xl border border-gray-200 p-4">
                    <div
                        class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-blue-50 text-xs font-bold text-blue-600">
                        Ads</div>
                    <div>
                        <p class="text-sm font-semibold text-gray-900">Google Ads</p>
                        <p class="text-xs text-gray-400">Kampány teljesítmény</p>
                    </div>
                </div>
                <div class="flex items-center gap-3 rounded-xl border border-gray-200 p-4">
                    <div
                        class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-green-50 text-xs font-bold text-green-600">
                        GSC</div>
                    <div>
                        <p class="text-sm font-semibold text-gray-900">Search Console</p>
                        <p class="text-xs text-gray-400">Keresési pozíciók, CTR</p>
                    </div>
                </div>
                <div class="flex items-center gap-3 rounded-xl border border-gray-200 p-4">
                    <div
                        class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-gray-50 text-xs font-bold text-gray-600">
                        CSV</div>
                    <div>
                        <p class="text-sm font-semibold text-gray-900">CSV / Excel / JSON</p>
                        <p class="text-xs text-gray-400">Fájl alapú adatimport</p>
                    </div>
                </div>
                <div class="flex items-center gap-3 rounded-xl border border-gray-200 p-4">
                    <div
                        class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-violet-50 text-xs font-bold text-violet-600">
                        SQL</div>
                    <div>
                        <p class="text-sm font-semibold text-gray-900">SQL adatbázisok</p>
                        <p class="text-xs text-gray-400">PostgreSQL, MySQL, MSSQL</p>
                    </div>
                </div>
                <div class="flex items-center gap-3 rounded-xl border border-gray-200 p-4">
                    <div
                        class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-indigo-50 text-xs font-bold text-indigo-600">
                        API</div>
                    <div>
                        <p class="text-sm font-semibold text-gray-900">REST API</p>
                        <p class="text-xs text-gray-400">Külső rendszer integráció</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Who Uses Section --}}
    <section class="bg-gray-50 py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto mb-12 max-w-3xl text-center">
                <h2 class="text-3xl font-semibold text-gray-900 sm:text-4xl">Kinek készült?</h2>
            </div>

            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
                <div class="rounded-2xl border border-gray-200 p-6 text-center">
                    <div
                        class="mx-auto mb-4 flex h-14 w-14 items-center justify-center rounded-full bg-violet-100 text-violet-500">
                        <svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 013 19.875v-6.75z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900">Marketing vezetők</h3>
                    <p class="mt-2 text-sm text-gray-600">Kampányok valós idejű követése, ROI optimalizálás, MI
                        predikciók a büdzsé-tervezéshez.</p>
                </div>
                <div class="rounded-2xl border border-gray-200 p-6 text-center">
                    <div
                        class="mx-auto mb-4 flex h-14 w-14 items-center justify-center rounded-full bg-violet-100 text-violet-500">
                        <svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900">Webshop tulajdonosok</h3>
                    <p class="mt-2 text-sm text-gray-600">Értékesítés-előrejelzés, ügyfél-szegmentáció, szezonális
                        minták felismerése.</p>
                </div>
                <div class="rounded-2xl border border-gray-200 p-6 text-center">
                    <div
                        class="mx-auto mb-4 flex h-14 w-14 items-center justify-center rounded-full bg-violet-100 text-violet-500">
                        <svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900">Ügyvezető igazgatók</h3>
                    <p class="mt-2 text-sm text-gray-600">Egyetlen dashboardon minden üzleti mutató, MI-alapú
                        döntéstámogatással.</p>
                </div>
                <div class="rounded-2xl border border-gray-200 p-6 text-center">
                    <div
                        class="mx-auto mb-4 flex h-14 w-14 items-center justify-center rounded-full bg-violet-100 text-violet-500">
                        <svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9.813 15.904L9 18.75l-.813-2.846a4.5 4.5 0 00-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 003.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 003.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 00-3.09 3.09z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900">Adatelemzők</h3>
                    <p class="mt-2 text-sm text-gray-600">Szakértői mód drag-and-drop modellépítővel, fejlett
                        algoritmus-választás.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- FAQ Section --}}
    <section class="bg-white py-16 lg:py-24" x-data="{ openFaq: null }">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto mb-12 max-w-3xl text-center">
                <h2 class="text-3xl font-semibold text-gray-900 sm:text-4xl">Gyakran ismételt kérdések</h2>
            </div>

            <div class="mx-auto max-w-3xl space-y-4">
                <div class="rounded-xl border border-gray-200">
                    <button @click="openFaq = openFaq === 1 ? null : 1"
                        class="flex w-full items-center justify-between px-6 py-4 text-left">
                        <span class="font-medium text-gray-900">Milyen adatforrásokat támogat a DataMind?</span>
                        <svg class="h-5 w-5 shrink-0 text-gray-400 transition-transform"
                            :class="{ 'rotate-180': openFaq === 1 }" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="openFaq === 1" x-collapse class="px-6 pb-4 text-gray-600">
                        Google Analytics 4, Google Search Console, Google Ads, CSV/Excel/JSON fájlok, SQL adatbázisok
                        (PostgreSQL, MySQL, MSSQL) és tetszőleges REST API-k.
                    </div>
                </div>
                <div class="rounded-xl border border-gray-200">
                    <button @click="openFaq = openFaq === 2 ? null : 2"
                        class="flex w-full items-center justify-between px-6 py-4 text-left">
                        <span class="font-medium text-gray-900">Kell programozni a használatához?</span>
                        <svg class="h-5 w-5 shrink-0 text-gray-400 transition-transform"
                            :class="{ 'rotate-180': openFaq === 2 }" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="openFaq === 2" x-collapse class="px-6 pb-4 text-gray-600">
                        Nem! A menedzseri módban a drag-and-drop felületen 5 lépésben építhet modellt, kódolás nélkül. A
                        szakértői mód opcionálisan elérhető haladó felhasználóknak.
                    </div>
                </div>
                <div class="rounded-xl border border-gray-200">
                    <button @click="openFaq = openFaq === 3 ? null : 3"
                        class="flex w-full items-center justify-between px-6 py-4 text-left">
                        <span class="font-medium text-gray-900">Mennyi idő alatt kezdhetek el dolgozni?</span>
                        <svg class="h-5 w-5 shrink-0 text-gray-400 transition-transform"
                            :class="{ 'rotate-180': openFaq === 3 }" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="openFaq === 3" x-collapse class="px-6 pb-4 text-gray-600">
                        A Google fiókok csatlakoztatása után 15 percen belül megjelennek az első adatok és elemzések a
                        dashboardon.
                    </div>
                </div>
                <div class="rounded-xl border border-gray-200">
                    <button @click="openFaq = openFaq === 4 ? null : 4"
                        class="flex w-full items-center justify-between px-6 py-4 text-left">
                        <span class="font-medium text-gray-900">Biztonságos az adataim kezelése?</span>
                        <svg class="h-5 w-5 shrink-0 text-gray-400 transition-transform"
                            :class="{ 'rotate-180': openFaq === 4 }" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="openFaq === 4" x-collapse class="px-6 pb-4 text-gray-600">
                        Igen. A rendszer GDPR-kompatibilis, TLS 1.3 titkosítást használ, és RBAC jogosultsági
                        rendszerrel rendelkezik. Adatanonimizálási képességek is elérhetők.
                    </div>
                </div>
                <div class="rounded-xl border border-gray-200">
                    <button @click="openFaq = openFaq === 5 ? null : 5"
                        class="flex w-full items-center justify-between px-6 py-4 text-left">
                        <span class="font-medium text-gray-900">Mi az a prediktív elemzés?</span>
                        <svg class="h-5 w-5 shrink-0 text-gray-400 transition-transform"
                            :class="{ 'rotate-180': openFaq === 5 }" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="openFaq === 5" x-collapse class="px-6 pb-4 text-gray-600">
                        Az MI gépi tanulási algoritmusokkal a múltbeli adatokból előrejelzéseket készít — pl. mekkora
                        forgalom várható jövő hónapban, vagy melyik ügyfél fogja elhagyni a szolgáltatást.
                    </div>
                </div>
                <div class="rounded-xl border border-gray-200">
                    <button @click="openFaq = openFaq === 6 ? null : 6"
                        class="flex w-full items-center justify-between px-6 py-4 text-left">
                        <span class="font-medium text-gray-900">Hogyan kapcsolódik a többi Cégem 360 modulhoz?</span>
                        <svg class="h-5 w-5 shrink-0 text-gray-400 transition-transform"
                            :class="{ 'rotate-180': openFaq === 6 }" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="openFaq === 6" x-collapse class="px-6 pb-4 text-gray-600">
                        A DataMind natívan integrálódik a CRM, Kontrolling és Automatizálás modulokkal — az adatok
                        automatikusan átfolynak a rendszerek között.
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Related Modules Section --}}
    <section class="bg-gray-50 py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto mb-12 max-w-3xl text-center">
                <h2 class="text-3xl font-semibold text-gray-900 sm:text-4xl">Kapcsolódó modulok</h2>
                <p class="mt-4 text-lg text-gray-600">Bővítse a DataMind-ot ezekkel a modulokkal.</p>
            </div>

            <div class="mx-auto grid max-w-3xl gap-6 sm:grid-cols-3">
                <a href="{{ route('products.crm') }}"
                    class="group rounded-2xl border border-gray-200 bg-white p-6 transition-shadow hover:shadow-md">
                    <x-module-icon module="crm" size="lg" />
                    <h3 class="mt-4 text-lg font-semibold text-gray-900 group-hover:text-violet-500">CRM modul</h3>
                    <p class="mt-2 text-sm text-gray-600">Ügyfélkapcsolat-kezelés és értékesítési pipeline</p>
                </a>
                <a href="{{ route('products.automatizalas') }}"
                    class="group rounded-2xl border border-gray-200 bg-white p-6 transition-shadow hover:shadow-md">
                    <x-module-icon module="automatizalas" size="lg" />
                    <h3 class="mt-4 text-lg font-semibold text-gray-900 group-hover:text-violet-500">Automatizálás
                    </h3>
                    <p class="mt-2 text-sm text-gray-600">Üzleti folyamatok automatizálása</p>
                </a>
                <a href="{{ route('products.kontrolling') }}"
                    class="group rounded-2xl border border-gray-200 bg-white p-6 transition-shadow hover:shadow-md">
                    <x-module-icon module="kontrolling" size="lg" />
                    <h3 class="mt-4 text-lg font-semibold text-gray-900 group-hover:text-violet-500">Kontrolling</h3>
                    <p class="mt-2 text-sm text-gray-600">Marketing dashboard és KPI követés</p>
                </a>
            </div>
        </div>
    </section>

    {{-- CTA Section --}}
    <section class="bg-violet-500 py-16 lg:py-20">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl font-semibold text-white sm:text-4xl">
                Készen áll az adatvezérelt döntéshozatalra?
            </h2>
            <p class="mx-auto mt-4 max-w-xl text-lg text-violet-100">
                Teljes funkcionalitás, magyar támogatás. Próbálja ki a DataMind-ot még ma.
            </p>
            <div class="mt-8 flex flex-col items-center justify-center gap-4 sm:flex-row">
                <a href="{{ route('register') }}"
                    class="inline-flex items-center justify-center rounded-lg bg-white px-6 py-3 text-base font-medium text-violet-500 transition-colors hover:bg-violet-50">
                    Kezdés
                    <svg class="ml-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M14 5l7 7m0 0l-7 7m7-7H3" />
                    </svg>
                </a>
                <a href="{{ route('contact') }}"
                    class="inline-flex items-center justify-center rounded-lg border border-violet-300 px-6 py-3 text-base font-medium text-white transition-colors hover:bg-violet-600">
                    Demó kérése
                </a>
            </div>
        </div>
    </section>
</div>
