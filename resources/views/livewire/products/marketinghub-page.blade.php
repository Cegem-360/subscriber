<div>
    {{-- Hero Section --}}
    <section class="bg-linear-to-b from-pink-50 to-white py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto max-w-4xl text-center">
                <div class="mb-6 flex justify-center">
                    <x-module-icon module="marketinghub" size="xl" />
                </div>
                <div
                    class="mb-6 inline-flex items-center gap-2 rounded-full bg-pink-100 px-4 py-1.5 text-sm font-medium text-pink-700">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 013 19.875v-6.75zM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V8.625zM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V4.125z" />
                    </svg>
                    MarketingHub Modul
                </div>
                <h1 class="mb-6 text-4xl font-semibold leading-tight text-gray-900 sm:text-5xl lg:text-6xl">
                    Integrált marketing vezérlőpult KKV-knak
                </h1>
                <p class="mx-auto max-w-3xl text-lg leading-relaxed text-gray-600 sm:text-xl">
                    Ügyfél-adatbázis, szegmentálás, kampányelemzés, riportok és AI Asszisztens
                    — egyetlen átlátható felületen, kifejezetten magyar kis- és középvállalkozások számára.
                </p>

                {{-- CTA Buttons --}}
                <div class="mt-8 flex flex-col items-center justify-center gap-4 sm:flex-row">
                    <a href="{{ route('register') }}"
                        class="inline-flex items-center justify-center gap-2 rounded-full bg-pink-500 px-8 py-4 text-base font-semibold text-white shadow-lg transition-colors hover:bg-pink-600 hover:shadow-xl">
                        Kezdés
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </a>
                    <a href="{{ route('contact') }}"
                        class="inline-flex items-center justify-center gap-2 rounded-full border-2 border-pink-200 bg-white px-8 py-4 text-base font-semibold text-pink-700 transition-colors hover:bg-pink-50">
                        Demó kérése
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
                <div class="rounded-2xl border border-pink-100 bg-linear-to-br from-pink-50 to-white p-8">
                    <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-xl bg-white shadow-sm">
                        <svg class="h-6 w-6 text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3.375 19.5h17.25m-17.25 0a1.125 1.125 0 01-1.125-1.125M3.375 19.5h7.5c.621 0 1.125-.504 1.125-1.125m-9.75 0V5.625m0 12.75v-1.5c0-.621.504-1.125 1.125-1.125m18.375 2.625V5.625m0 12.75c0 .621-.504 1.125-1.125 1.125m1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125m0 3.75h-7.5A1.125 1.125 0 0112 18.375" />
                        </svg>
                    </div>
                    <h3 class="mb-2 text-lg font-semibold text-gray-900">Szétszórt ügyféladatok</h3>
                    <p class="text-gray-600">Az ügyféladatok Excelben, e-mailben és különböző rendszerekben vannak
                        — senki nem lát teljes képet.</p>
                </div>
                <div class="rounded-2xl border border-pink-100 bg-linear-to-br from-pink-50 to-white p-8">
                    <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-xl bg-white shadow-sm">
                        <svg class="h-6 w-6 text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
                        </svg>
                    </div>
                    <h3 class="mb-2 text-lg font-semibold text-gray-900">Nincs szegmentálás</h3>
                    <p class="text-gray-600">Mindenkinek ugyanazt az üzenetet küldi, mert nincs mód célzott
                        csoportok kialakítására.</p>
                </div>
                <div class="rounded-2xl border border-pink-100 bg-linear-to-br from-pink-50 to-white p-8">
                    <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-xl bg-white shadow-sm">
                        <svg class="h-6 w-6 text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 013 19.875v-6.75z" />
                        </svg>
                    </div>
                    <h3 class="mb-2 text-lg font-semibold text-gray-900">Kézi riportkészítés</h3>
                    <p class="text-gray-600">A havi marketing riport órákat vesz igénybe, mert minden adatot kézzel
                        kell összegyűjteni.</p>
                </div>
                <div class="rounded-2xl border border-pink-100 bg-linear-to-br from-pink-50 to-white p-8">
                    <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-xl bg-white shadow-sm">
                        <svg class="h-6 w-6 text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="mb-2 text-lg font-semibold text-gray-900">Nem mérhető eredmények</h3>
                    <p class="text-gray-600">A Google Ads, weboldal és elégedettségi adatok külön-külön élnek
                        — nincs összkép a marketing ROI-ról.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Features Section --}}
    <section class="bg-gray-50 py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto mb-12 max-w-3xl text-center">
                <h2 class="text-3xl font-semibold text-gray-900 sm:text-4xl">Főbb funkciók</h2>
                <p class="mt-4 text-lg text-gray-600">Minden marketing adat egy helyen — 6 integrált modul a
                    teljes marketing folyamatra.</p>
            </div>

            <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-3">
                {{-- Feature 1 --}}
                <div class="rounded-2xl bg-white p-8 shadow-sm">
                    <div
                        class="mb-4 flex h-12 w-12 items-center justify-center rounded-xl bg-pink-100 text-pink-500">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                        </svg>
                    </div>
                    <h3 class="mb-2 text-lg font-semibold text-gray-900">Ügyfél-adatbázis</h3>
                    <ul class="space-y-2 text-sm text-gray-600">
                        <li class="flex items-start gap-2">
                            <svg class="mt-0.5 h-4 w-4 shrink-0 text-pink-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            CSV/Excel import
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="mt-0.5 h-4 w-4 shrink-0 text-pink-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            GDPR-kompatibilis adatkezelés
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="mt-0.5 h-4 w-4 shrink-0 text-pink-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            Korlátlan egyedi mezők
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="mt-0.5 h-4 w-4 shrink-0 text-pink-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            Publikus regisztrációs űrlapok
                        </li>
                    </ul>
                </div>

                {{-- Feature 2 --}}
                <div class="rounded-2xl bg-white p-8 shadow-sm">
                    <div
                        class="mb-4 flex h-12 w-12 items-center justify-center rounded-xl bg-pink-100 text-pink-500">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9.568 3H5.25A2.25 2.25 0 003 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 005.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 009.568 3z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 6h.008v.008H6V6z" />
                        </svg>
                    </div>
                    <h3 class="mb-2 text-lg font-semibold text-gray-900">Szegmentálás</h3>
                    <ul class="space-y-2 text-sm text-gray-600">
                        <li class="flex items-start gap-2">
                            <svg class="mt-0.5 h-4 w-4 shrink-0 text-pink-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            Dinamikus ügyfélcsoportok
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="mt-0.5 h-4 w-4 shrink-0 text-pink-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            Szabályalapú szűrők (ÉS/VAGY)
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="mt-0.5 h-4 w-4 shrink-0 text-pink-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            Demográfiai és viselkedési adatok
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="mt-0.5 h-4 w-4 shrink-0 text-pink-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            Szegmens-mapping vizualizáció
                        </li>
                    </ul>
                </div>

                {{-- Feature 3 --}}
                <div class="rounded-2xl bg-white p-8 shadow-sm">
                    <div
                        class="mb-4 flex h-12 w-12 items-center justify-center rounded-xl bg-pink-100 text-pink-500">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 013 19.875v-6.75zM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V8.625zM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V4.125z" />
                        </svg>
                    </div>
                    <h3 class="mb-2 text-lg font-semibold text-gray-900">Dashboard & vizualizáció</h3>
                    <ul class="space-y-2 text-sm text-gray-600">
                        <li class="flex items-start gap-2">
                            <svg class="mt-0.5 h-4 w-4 shrink-0 text-pink-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            Drag & drop widgetek
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="mt-0.5 h-4 w-4 shrink-0 text-pink-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            Táblázatok, oszlop- és kördiagramok
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="mt-0.5 h-4 w-4 shrink-0 text-pink-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            Több dashboard konfiguráció
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="mt-0.5 h-4 w-4 shrink-0 text-pink-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            Váltás egy kattintással
                        </li>
                    </ul>
                </div>

                {{-- Feature 4 --}}
                <div class="rounded-2xl bg-white p-8 shadow-sm">
                    <div
                        class="mb-4 flex h-12 w-12 items-center justify-center rounded-xl bg-pink-100 text-pink-500">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                        </svg>
                    </div>
                    <h3 class="mb-2 text-lg font-semibold text-gray-900">Riportok & adatexport</h3>
                    <ul class="space-y-2 text-sm text-gray-600">
                        <li class="flex items-start gap-2">
                            <svg class="mt-0.5 h-4 w-4 shrink-0 text-pink-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            PDF, Word, Excel, CSV export
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="mt-0.5 h-4 w-4 shrink-0 text-pink-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            Sablon-alapú és egyedi riportok
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="mt-0.5 h-4 w-4 shrink-0 text-pink-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            Szűrhető időszak és szegmens
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="mt-0.5 h-4 w-4 shrink-0 text-pink-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            Aggregált és részletes jelentések
                        </li>
                    </ul>
                </div>

                {{-- Feature 5 --}}
                <div class="rounded-2xl bg-white p-8 shadow-sm">
                    <div
                        class="mb-4 flex h-12 w-12 items-center justify-center rounded-xl bg-pink-100 text-pink-500">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9.813 15.904L9 18.75l-.813-2.846a4.5 4.5 0 00-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 003.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 003.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 00-3.09 3.09z" />
                        </svg>
                    </div>
                    <h3 class="mb-2 text-lg font-semibold text-gray-900">Kutatás & mérés</h3>
                    <ul class="space-y-2 text-sm text-gray-600">
                        <li class="flex items-start gap-2">
                            <svg class="mt-0.5 h-4 w-4 shrink-0 text-pink-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            NPS/CSAT elégedettségmérés
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="mt-0.5 h-4 w-4 shrink-0 text-pink-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            Drag & drop kérdőív szerkesztő
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="mt-0.5 h-4 w-4 shrink-0 text-pink-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            Google Analytics integráció
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="mt-0.5 h-4 w-4 shrink-0 text-pink-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            Konverziók nyomon követése
                        </li>
                    </ul>
                </div>

                {{-- Feature 6 --}}
                <div class="rounded-2xl bg-white p-8 shadow-sm">
                    <div
                        class="mb-4 flex h-12 w-12 items-center justify-center rounded-xl bg-pink-100 text-pink-500">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8.625 12a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H8.25m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H12m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0h-.375M21 12c0 4.556-4.03 8.25-9 8.25a9.764 9.764 0 01-2.555-.337A5.972 5.972 0 015.41 20.97a5.969 5.969 0 01-.474-.065 4.48 4.48 0 00.978-2.025c.09-.457-.133-.901-.467-1.226C3.93 16.178 3 14.189 3 12c0-4.556 4.03-8.25 9-8.25s9 3.694 9 8.25z" />
                        </svg>
                    </div>
                    <h3 class="mb-2 text-lg font-semibold text-gray-900">AI Asszisztens</h3>
                    <ul class="space-y-2 text-sm text-gray-600">
                        <li class="flex items-start gap-2">
                            <svg class="mt-0.5 h-4 w-4 shrink-0 text-pink-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            Természetes nyelvi kezelés
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="mt-0.5 h-4 w-4 shrink-0 text-pink-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            API kapcsolatok beállítása
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="mt-0.5 h-4 w-4 shrink-0 text-pink-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            Adatlekérdezések chat felületen
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="mt-0.5 h-4 w-4 shrink-0 text-pink-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            0-24 elérhető
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    {{-- Results Section --}}
    <section class="bg-pink-500 py-16 lg:py-20">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto mb-12 max-w-3xl text-center">
                <h2 class="text-3xl font-semibold text-white sm:text-4xl">Mérhető eredmények</h2>
                <p class="mt-4 text-lg text-pink-100">Átlagos javulás ügyfeleink körében a MarketingHub bevezetése
                    után.</p>
            </div>

            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                <div class="rounded-2xl bg-white/10 p-6 text-center backdrop-blur-sm">
                    <p class="text-4xl font-bold text-white">-70%</p>
                    <p class="mt-2 text-pink-100">riportkészítési idő</p>
                </div>
                <div class="rounded-2xl bg-white/10 p-6 text-center backdrop-blur-sm">
                    <p class="text-4xl font-bold text-white">+35%</p>
                    <p class="mt-2 text-pink-100">célzott kampány hatékonyság</p>
                </div>
                <div class="rounded-2xl bg-white/10 p-6 text-center backdrop-blur-sm">
                    <p class="text-4xl font-bold text-white">-80%</p>
                    <p class="mt-2 text-pink-100">manuális adatbevitel</p>
                </div>
                <div class="rounded-2xl bg-white/10 p-6 text-center backdrop-blur-sm">
                    <p class="text-4xl font-bold text-white">1 perc</p>
                    <p class="mt-2 text-pink-100">alatt szegmens létrehozás</p>
                </div>
                <div class="rounded-2xl bg-white/10 p-6 text-center backdrop-blur-sm">
                    <p class="text-4xl font-bold text-white">100%</p>
                    <p class="mt-2 text-pink-100">GDPR megfelelőség</p>
                </div>
                <div class="rounded-2xl bg-white/10 p-6 text-center backdrop-blur-sm">
                    <p class="text-4xl font-bold text-white">8+</p>
                    <p class="mt-2 text-pink-100">integráció elérhető</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Integrations Section --}}
    <section class="bg-white py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto mb-12 max-w-3xl text-center">
                <h2 class="text-3xl font-semibold text-gray-900 sm:text-4xl">Összekapcsolva a rendszereivel</h2>
                <p class="mt-4 text-lg text-gray-600">Előre konfigurált integrációk a Cégem360 modulokhoz és a
                    legnépszerűbb üzleti rendszerekhez.</p>
            </div>

            <div class="mx-auto grid max-w-3xl gap-4 sm:grid-cols-2 lg:grid-cols-4">
                <div class="flex items-center gap-3 rounded-xl border border-gray-200 p-4">
                    <div
                        class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-blue-50 text-xs font-bold text-blue-600">
                        CRM</div>
                    <div>
                        <p class="text-sm font-semibold text-gray-900">Cégem360 CRM</p>
                        <p class="text-xs text-gray-400">Ügyfélkezelés</p>
                    </div>
                </div>
                <div class="flex items-center gap-3 rounded-xl border border-gray-200 p-4">
                    <div
                        class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-emerald-50 text-xs font-bold text-emerald-600">
                        CTRL</div>
                    <div>
                        <p class="text-sm font-semibold text-gray-900">Cégem360 Kontrolling</p>
                        <p class="text-xs text-gray-400">Pénzügyi KPI-k</p>
                    </div>
                </div>
                <div class="flex items-center gap-3 rounded-xl border border-gray-200 p-4">
                    <div
                        class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-yellow-50 text-xs font-bold text-yellow-600">
                        GA</div>
                    <div>
                        <p class="text-sm font-semibold text-gray-900">Google Analytics</p>
                        <p class="text-xs text-gray-400">Weboldal adatok</p>
                    </div>
                </div>
                <div class="flex items-center gap-3 rounded-xl border border-gray-200 p-4">
                    <div
                        class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-blue-50 text-xs font-bold text-blue-600">
                        Ads</div>
                    <div>
                        <p class="text-sm font-semibold text-gray-900">Google Ads</p>
                        <p class="text-xs text-gray-400">Kampányadatok</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Who Uses Section --}}
    <section class="bg-gray-50 py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto mb-12 max-w-3xl text-center">
                <h2 class="text-3xl font-semibold text-gray-900 sm:text-4xl">Ki használja?</h2>
            </div>

            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
                <div class="rounded-2xl border border-gray-200 p-6 text-center">
                    <div
                        class="mx-auto mb-4 flex h-14 w-14 items-center justify-center rounded-full bg-pink-100 text-pink-500">
                        <svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 013 19.875v-6.75z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900">Marketing igazgatók</h3>
                    <p class="mt-2 text-sm text-gray-600">Marketing teljesítmény áttekintés és stratégiai
                        döntéstámogatás</p>
                </div>
                <div class="rounded-2xl border border-gray-200 p-6 text-center">
                    <div
                        class="mx-auto mb-4 flex h-14 w-14 items-center justify-center rounded-full bg-pink-100 text-pink-500">
                        <svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9.813 15.904L9 18.75l-.813-2.846a4.5 4.5 0 00-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 003.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 003.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 00-3.09 3.09z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900">Elemzők</h3>
                    <p class="mt-2 text-sm text-gray-600">Dashboard, riportok és kutatás egyetlen felületen</p>
                </div>
                <div class="rounded-2xl border border-gray-200 p-6 text-center">
                    <div
                        class="mx-auto mb-4 flex h-14 w-14 items-center justify-center rounded-full bg-pink-100 text-pink-500">
                        <svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900">Marketing managerek</h3>
                    <p class="mt-2 text-sm text-gray-600">Adatkezelés, kampányok és szegmentálás</p>
                </div>
                <div class="rounded-2xl border border-gray-200 p-6 text-center">
                    <div
                        class="mx-auto mb-4 flex h-14 w-14 items-center justify-center rounded-full bg-pink-100 text-pink-500">
                        <svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900">Ügyvezetők</h3>
                    <p class="mt-2 text-sm text-gray-600">Átfogó marketing riportok a vezetőségnek</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Testimonial Section --}}
    <section class="bg-white py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto mb-12 max-w-3xl text-center">
                <h2 class="text-3xl font-semibold text-gray-900 sm:text-4xl">Amit ügyfeleink mondanak</h2>
            </div>

            <div class="grid gap-8 sm:grid-cols-2">
                <div class="rounded-2xl bg-gray-50 p-8 shadow-sm">
                    <p class="mb-6 text-lg leading-relaxed text-gray-600">"A szegmentálás teljesen átalakította a
                        kampányainkat. Végre célzott üzeneteket küldünk, és az eredmények maguktól beszélnek."</p>
                    <div class="flex items-center gap-3">
                        <div
                            class="flex h-10 w-10 items-center justify-center rounded-full bg-pink-100 text-sm font-semibold text-pink-500">
                            MK</div>
                        <div>
                            <p class="text-sm font-semibold text-gray-900">Molnár Katalin</p>
                            <p class="text-xs text-gray-500">Marketing igazgató, DigiTrend Kft.</p>
                        </div>
                    </div>
                </div>
                <div class="rounded-2xl bg-gray-50 p-8 shadow-sm">
                    <p class="mb-6 text-lg leading-relaxed text-gray-600">"Az AI Asszisztens percek alatt beállította
                        az integrációkat, amikre korábban napokat szántunk. A riportok pedig automatikusan
                        generálódnak."</p>
                    <div class="flex items-center gap-3">
                        <div
                            class="flex h-10 w-10 items-center justify-center rounded-full bg-pink-100 text-sm font-semibold text-pink-500">
                            FA</div>
                        <div>
                            <p class="text-sm font-semibold text-gray-900">Farkas András</p>
                            <p class="text-xs text-gray-500">Ügyvezető, MarketPro Zrt.</p>
                        </div>
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
                <p class="mt-4 text-lg text-gray-600">Bővítse a MarketingHub-ot ezekkel a modulokkal.</p>
            </div>

            <div class="mx-auto grid max-w-2xl gap-6 sm:grid-cols-2">
                <a href="{{ route('products.crm') }}"
                    class="group rounded-2xl border border-gray-200 bg-white p-6 transition-shadow hover:shadow-md">
                    <x-module-icon module="crm" size="lg" />
                    <h3 class="mt-4 text-lg font-semibold text-gray-900 group-hover:text-pink-500">CRM modul</h3>
                    <p class="mt-2 text-sm text-gray-600">Ügyfélkapcsolat-kezelés a marketing adatokkal összekötve
                    </p>
                </a>
                <a href="{{ route('products.kontrolling') }}"
                    class="group rounded-2xl border border-gray-200 bg-white p-6 transition-shadow hover:shadow-md">
                    <x-module-icon module="kontrolling" size="lg" />
                    <h3 class="mt-4 text-lg font-semibold text-gray-900 group-hover:text-pink-500">Kontrolling modul
                    </h3>
                    <p class="mt-2 text-sm text-gray-600">Marketing költségek és kampány ROI mérése pénzügyi
                        adatokkal</p>
                </a>
            </div>
        </div>
    </section>

    {{-- CTA Section --}}
    <section class="bg-pink-500 py-16 lg:py-20">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl font-semibold text-white sm:text-4xl">
                Készen áll a hatékonyabb marketingre?
            </h2>
            <p class="mx-auto mt-4 max-w-xl text-lg text-pink-100">
                Teljes funkcionalitás, magyar támogatás. Próbálja ki a MarketingHub-ot még ma.
            </p>
            <div class="mt-8 flex flex-col items-center justify-center gap-4 sm:flex-row">
                <a href="{{ route('register') }}"
                    class="inline-flex items-center justify-center rounded-lg bg-white px-6 py-3 text-base font-medium text-pink-500 transition-colors hover:bg-pink-50">
                    Kezdés
                    <svg class="ml-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M14 5l7 7m0 0l-7 7m7-7H3" />
                    </svg>
                </a>
                <a href="{{ route('contact') }}"
                    class="inline-flex items-center justify-center rounded-lg border border-pink-300 px-6 py-3 text-base font-medium text-white transition-colors hover:bg-pink-600">
                    Demó kérése
                </a>
            </div>
        </div>
    </section>
</div>
