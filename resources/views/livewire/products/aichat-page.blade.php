<div>
    {{-- Hero Section --}}
    <section class="bg-linear-to-b from-blue-50 to-white py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto max-w-4xl text-center">
                <div class="mb-6 flex justify-center">
                    <x-module-icon module="ai-chat" size="xl" />
                </div>
                <div
                    class="mb-6 inline-flex items-center gap-2 rounded-full bg-blue-100 px-4 py-1.5 text-sm font-medium text-blue-700">
                    <x-module-icon module="ai-chat" size="xs" :show-background="false" color="#1d4ed8" />
                    AI Chat Plugin
                </div>
                <h1 class="mb-6 text-4xl font-semibold leading-tight text-gray-900 sm:text-5xl lg:text-6xl">
                    Intelligens AI chatbot a weboldaladra
                </h1>
                <p class="mx-auto max-w-3xl text-lg leading-relaxed text-gray-600 sm:text-xl">
                    0-24 automatizált ügyfélszolgálat, ami ismeri a termékeidet és szolgáltatásaidat.
                    A chatbot a weboldal tartalmából tanul. Saját API kulcs — teljes kontroll.
                </p>

                {{-- CTA Buttons --}}
                <div class="mt-8 flex flex-col items-center justify-center gap-4 sm:flex-row">
                    <a href="{{ route('register') }}"
                        class="inline-flex items-center justify-center gap-2 rounded-full bg-blue-500 px-8 py-4 text-base font-semibold text-white shadow-lg transition-colors hover:bg-blue-600 hover:shadow-xl">
                        Kezdés indítása
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </a>
                    <a href="{{ route('contact') }}"
                        class="inline-flex items-center justify-center gap-2 rounded-full border-2 border-blue-200 bg-white px-8 py-4 text-base font-semibold text-blue-700 transition-colors hover:bg-blue-50">
                        Demó kérése
                    </a>
                    <a href="{{ route('login') }}"
                        class="inline-flex items-center justify-center gap-2 text-base font-medium text-blue-600 transition-colors hover:text-blue-800">
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
                <h2 class="text-3xl font-semibold text-gray-900 sm:text-4xl">Miért veszítesz ügyfeleket a weboldaladon?
                </h2>
            </div>

            <div class="grid gap-6 sm:grid-cols-2">
                <div class="rounded-2xl border border-blue-100 bg-linear-to-br from-blue-50 to-white p-8">
                    <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-xl bg-white shadow-sm">
                        <svg class="h-6 w-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="mb-2 text-lg font-semibold text-gray-900">Megválaszolatlan kérdések</h3>
                    <p class="text-gray-600">A látogatók kérdeznek, de senki nem válaszol munkaidőn kívül. Reggel már
                        konkurenciánál vannak.</p>
                </div>
                <div class="rounded-2xl border border-blue-100 bg-linear-to-br from-blue-50 to-white p-8">
                    <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-xl bg-white shadow-sm">
                        <svg class="h-6 w-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19.5 12c0-1.232-.046-2.453-.138-3.662a4.006 4.006 0 00-3.7-3.7 48.678 48.678 0 00-7.324 0 4.006 4.006 0 00-3.7 3.7c-.017.22-.032.441-.046.662M19.5 12l3-3m-3 3l-3-3m-12 3c0 1.232.046 2.453.138 3.662a4.006 4.006 0 003.7 3.7 48.656 48.656 0 007.324 0 4.006 4.006 0 003.7-3.7c.017-.22.032-.441.046-.662M4.5 12l3 3m-3-3l-3 3" />
                        </svg>
                    </div>
                    <h3 class="mb-2 text-lg font-semibold text-gray-900">Ismétlődő kérdések terhe</h3>
                    <p class="text-gray-600">Az ügyfélszolgálat idejének 80%-a ugyanazokra az alap kérdésekre megy el,
                        újra és újra.</p>
                </div>
                <div class="rounded-2xl border border-blue-100 bg-linear-to-br from-blue-50 to-white p-8">
                    <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-xl bg-white shadow-sm">
                        <svg class="h-6 w-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 013 19.875v-6.75zM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V8.625zM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V4.125z" />
                        </svg>
                    </div>
                    <h3 class="mb-2 text-lg font-semibold text-gray-900">Alacsony konverzió</h3>
                    <p class="text-gray-600">A vásárlók elakadnak a vásárlási folyamatban, de nincs ki segítsen nekik valós
                        időben.</p>
                </div>
                <div class="rounded-2xl border border-blue-100 bg-linear-to-br from-blue-50 to-white p-8">
                    <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-xl bg-white shadow-sm">
                        <svg class="h-6 w-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0zm3 0h.008v.008H18V10.5zm-12 0h.008v.008H6V10.5z" />
                        </svg>
                    </div>
                    <h3 class="mb-2 text-lg font-semibold text-gray-900">Drága ügyfélszolgálat</h3>
                    <p class="text-gray-600">Több munkatárs, hosszabb munkaidő — az ügyfélszolgálat költsége folyamatosan
                        nő.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Features Section --}}
    <section id="funkciok" class="bg-gray-50 py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto mb-12 max-w-3xl text-center">
                <h2 class="text-3xl font-semibold text-gray-900 sm:text-4xl">Minden, amire szükséged van az AI
                    ügyfélszolgálathoz</h2>
                <p class="mt-4 text-lg text-gray-600">Automatikus tartalomfeldolgozás, e-commerce integráció, CRM és
                    személyre szabás — egyetlen widgetben.</p>
            </div>

            <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-3">
                {{-- Feature 1 --}}
                <div class="rounded-2xl bg-white p-8 shadow-sm">
                    <div
                        class="mb-4 flex h-12 w-12 items-center justify-center rounded-xl bg-blue-100 text-blue-500">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9.813 15.904L9 18.75l-.813-2.846a4.5 4.5 0 00-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 003.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 003.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 00-3.09 3.09z" />
                        </svg>
                    </div>
                    <h3 class="mb-2 text-lg font-semibold text-gray-900">Automatikus tartalomfeldolgozás</h3>
                    <ul class="space-y-2 text-sm text-gray-600">
                        <li class="flex items-start gap-2">
                            <svg class="mt-0.5 h-4 w-4 shrink-0 text-blue-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            AI automatikusan indexeli a weboldal tartalmát
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="mt-0.5 h-4 w-4 shrink-0 text-blue-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            Oldalak, termékek és blogbejegyzések feldolgozása
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="mt-0.5 h-4 w-4 shrink-0 text-blue-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            RAG (Retrieval Augmented Generation) technológia
                        </li>
                    </ul>
                </div>

                {{-- Feature 2 --}}
                <div class="rounded-2xl bg-white p-8 shadow-sm">
                    <div
                        class="mb-4 flex h-12 w-12 items-center justify-center rounded-xl bg-blue-100 text-blue-500">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                        </svg>
                    </div>
                    <h3 class="mb-2 text-lg font-semibold text-gray-900">Dokumentumkezelés</h3>
                    <ul class="space-y-2 text-sm text-gray-600">
                        <li class="flex items-start gap-2">
                            <svg class="mt-0.5 h-4 w-4 shrink-0 text-blue-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            PDF, DOCX, TXT dokumentumok feltöltése
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="mt-0.5 h-4 w-4 shrink-0 text-blue-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            Tudásbázis bővítése saját anyagokkal
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="mt-0.5 h-4 w-4 shrink-0 text-blue-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            Automatikus tartalom-szegmentálás és verziókezelés
                        </li>
                    </ul>
                </div>

                {{-- Feature 3 --}}
                <div class="rounded-2xl bg-white p-8 shadow-sm">
                    <div
                        class="mb-4 flex h-12 w-12 items-center justify-center rounded-xl bg-blue-100 text-blue-500">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                        </svg>
                    </div>
                    <h3 class="mb-2 text-lg font-semibold text-gray-900">E-commerce integráció</h3>
                    <ul class="space-y-2 text-sm text-gray-600">
                        <li class="flex items-start gap-2">
                            <svg class="mt-0.5 h-4 w-4 shrink-0 text-blue-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            WooCommerce termék-ajánlás chatből
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="mt-0.5 h-4 w-4 shrink-0 text-blue-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            Készletinformáció és árak megjelenítése
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="mt-0.5 h-4 w-4 shrink-0 text-blue-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            Kosárba helyezés és rendelés-követés
                        </li>
                    </ul>
                </div>

                {{-- Feature 4 --}}
                <div class="rounded-2xl bg-white p-8 shadow-sm">
                    <div
                        class="mb-4 flex h-12 w-12 items-center justify-center rounded-xl bg-blue-100 text-blue-500">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                        </svg>
                    </div>
                    <h3 class="mb-2 text-lg font-semibold text-gray-900">CRM és ügyfélkezelés</h3>
                    <ul class="space-y-2 text-sm text-gray-600">
                        <li class="flex items-start gap-2">
                            <svg class="mt-0.5 h-4 w-4 shrink-0 text-blue-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            Automatikus ügyfél-azonosítás e-mail alapján
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="mt-0.5 h-4 w-4 shrink-0 text-blue-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            Beszélgetéstörténet keresés és export
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="mt-0.5 h-4 w-4 shrink-0 text-blue-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            Automatikus hírlevél-lista építés
                        </li>
                    </ul>
                </div>

                {{-- Feature 5 --}}
                <div class="rounded-2xl bg-white p-8 shadow-sm">
                    <div
                        class="mb-4 flex h-12 w-12 items-center justify-center rounded-xl bg-blue-100 text-blue-500">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
                        </svg>
                    </div>
                    <h3 class="mb-2 text-lg font-semibold text-gray-900">Értesítések és adminisztráció</h3>
                    <ul class="space-y-2 text-sm text-gray-600">
                        <li class="flex items-start gap-2">
                            <svg class="mt-0.5 h-4 w-4 shrink-0 text-blue-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            Azonnali e-mail értesítések új beszélgetéseknél
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="mt-0.5 h-4 w-4 shrink-0 text-blue-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            Hibás válaszok jelölése és finomhangolás
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="mt-0.5 h-4 w-4 shrink-0 text-blue-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            Admin felület teljes áttekintéssel
                        </li>
                    </ul>
                </div>

                {{-- Feature 6 --}}
                <div class="rounded-2xl bg-white p-8 shadow-sm">
                    <div
                        class="mb-4 flex h-12 w-12 items-center justify-center rounded-xl bg-blue-100 text-blue-500">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10.5 6h9.75M10.5 6a1.5 1.5 0 11-3 0m3 0a1.5 1.5 0 10-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-9.75 0h9.75" />
                        </svg>
                    </div>
                    <h3 class="mb-2 text-lg font-semibold text-gray-900">Személyre szabás</h3>
                    <ul class="space-y-2 text-sm text-gray-600">
                        <li class="flex items-start gap-2">
                            <svg class="mt-0.5 h-4 w-4 shrink-0 text-blue-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            Visszatérő ügyfél automatikus felismerése
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="mt-0.5 h-4 w-4 shrink-0 text-blue-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            Korábbi beszélgetések kontextusa megmarad
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="mt-0.5 h-4 w-4 shrink-0 text-blue-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            Widget szín, pozíció, üdvözlő üzenet testreszabás
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
                <h2 class="text-3xl font-semibold text-gray-900 sm:text-4xl">4 egyszerű lépés az éles indulásig</h2>
                <p class="mt-4 text-lg text-gray-600">Nem kell fejlesztő — teljes telepítés 5 perc alatt, kódolás
                    nélkül.</p>
            </div>

            <div class="mx-auto max-w-4xl">
                <div class="space-y-8">
                    <div class="flex items-start gap-6">
                        <div
                            class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-blue-500 text-sm font-bold text-white">
                            1</div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">Telepítés</h3>
                            <p class="mt-1 text-gray-600">Töltsd fel a plugin ZIP-et a WordPress-be és aktiváld a
                                licenckulcsot.</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-6">
                        <div
                            class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-blue-500 text-sm font-bold text-white">
                            2</div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">Tartalom betöltés</h3>
                            <p class="mt-1 text-gray-600">Az AI automatikusan indexeli a weboldal tartalmát és a
                                feltöltött dokumentumokat.</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-6">
                        <div
                            class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-blue-500 text-sm font-bold text-white">
                            3</div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">Testreszabás</h3>
                            <p class="mt-1 text-gray-600">Állítsd be a widget színeit, pozícióját és az üdvözlő
                                üzenetet.</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-6">
                        <div
                            class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-blue-500 text-sm font-bold text-white">
                            4</div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">Éles indulás</h3>
                            <p class="mt-1 text-gray-600">Kapcsold be a chatbotot — és máris válaszol az ügyfeleidnek
                                0-24-ben!</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Results Section --}}
    <section class="bg-blue-500 py-16 lg:py-20">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto mb-12 max-w-3xl text-center">
                <h2 class="text-3xl font-semibold text-white sm:text-4xl">Mérhető eredmények</h2>
                <p class="mt-4 text-lg text-blue-100">Átlagos javulás ügyfeleink körében a bevezetés után.</p>
            </div>

            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-5">
                <div class="rounded-2xl bg-white/10 p-6 text-center backdrop-blur-sm">
                    <p class="text-4xl font-bold text-white">-70%</p>
                    <p class="mt-2 text-blue-100">Ügyfélszolgálati megkeresések</p>
                </div>
                <div class="rounded-2xl bg-white/10 p-6 text-center backdrop-blur-sm">
                    <p class="text-4xl font-bold text-white">85%</p>
                    <p class="mt-2 text-blue-100">Automatikusan megválaszolt kérdések</p>
                </div>
                <div class="rounded-2xl bg-white/10 p-6 text-center backdrop-blur-sm">
                    <p class="text-4xl font-bold text-white">+35%</p>
                    <p class="mt-2 text-blue-100">Konverzió növekedés</p>
                </div>
                <div class="rounded-2xl bg-white/10 p-6 text-center backdrop-blur-sm">
                    <p class="text-4xl font-bold text-white">3mp</p>
                    <p class="mt-2 text-blue-100">Átlagos válaszidő</p>
                </div>
                <div class="rounded-2xl bg-white/10 p-6 text-center backdrop-blur-sm">
                    <p class="text-4xl font-bold text-white">0-24</p>
                    <p class="mt-2 text-blue-100">Elérhetőség, hétvégén is</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Use Cases Section --}}
    <section class="bg-white py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto mb-12 max-w-3xl text-center">
                <h2 class="text-3xl font-semibold text-gray-900 sm:text-4xl">Minden iparágban helytáll</h2>
            </div>

            <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-3">
                <div class="rounded-2xl bg-gray-50 p-8">
                    <div
                        class="mb-4 flex h-12 w-12 items-center justify-center rounded-xl bg-blue-100 text-blue-500">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 0h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008z" />
                        </svg>
                    </div>
                    <h3 class="mb-2 text-lg font-semibold text-gray-900">Szálláshely és turizmus</h3>
                    <ul class="space-y-2 text-sm text-gray-600">
                        <li class="flex items-start gap-2">
                            <svg class="mt-0.5 h-4 w-4 shrink-0 text-blue-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            Szobaárak és elérhetőség 0-24
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="mt-0.5 h-4 w-4 shrink-0 text-blue-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            Foglalási kérdések automatikus kezelése
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="mt-0.5 h-4 w-4 shrink-0 text-blue-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            Többnyelvű vendégkommunikáció
                        </li>
                    </ul>
                </div>
                <div class="rounded-2xl bg-gray-50 p-8">
                    <div
                        class="mb-4 flex h-12 w-12 items-center justify-center rounded-xl bg-blue-100 text-blue-500">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                        </svg>
                    </div>
                    <h3 class="mb-2 text-lg font-semibold text-gray-900">Webáruház</h3>
                    <ul class="space-y-2 text-sm text-gray-600">
                        <li class="flex items-start gap-2">
                            <svg class="mt-0.5 h-4 w-4 shrink-0 text-blue-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            Termék-ajánlás chatből
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="mt-0.5 h-4 w-4 shrink-0 text-blue-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            Rendelés státusz lekérdezés
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="mt-0.5 h-4 w-4 shrink-0 text-blue-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            Készlet és méretinformáció
                        </li>
                    </ul>
                </div>
                <div class="rounded-2xl bg-gray-50 p-8">
                    <div
                        class="mb-4 flex h-12 w-12 items-center justify-center rounded-xl bg-blue-100 text-blue-500">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 21v-3.375c0-.621.504-1.125 1.125-1.125h3.75c.621 0 1.125.504 1.125 1.125V21" />
                        </svg>
                    </div>
                    <h3 class="mb-2 text-lg font-semibold text-gray-900">Szolgáltató cég</h3>
                    <ul class="space-y-2 text-sm text-gray-600">
                        <li class="flex items-start gap-2">
                            <svg class="mt-0.5 h-4 w-4 shrink-0 text-blue-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            Szolgáltatások bemutatása és árajánlat
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="mt-0.5 h-4 w-4 shrink-0 text-blue-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            Időpontfoglalás támogatás
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="mt-0.5 h-4 w-4 shrink-0 text-blue-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            GYIK automatikus megválaszolása
                        </li>
                    </ul>
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
                        class="mx-auto mb-4 flex h-14 w-14 items-center justify-center rounded-full bg-blue-100 text-blue-500">
                        <svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900">Webáruház-tulajdonosok</h3>
                    <p class="mt-2 text-sm text-gray-600">Automatikus értékesítési asszisztens</p>
                </div>
                <div class="rounded-2xl border border-gray-200 p-6 text-center">
                    <div
                        class="mx-auto mb-4 flex h-14 w-14 items-center justify-center rounded-full bg-blue-100 text-blue-500">
                        <svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 0h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900">Szálláshely-üzemeltetők</h3>
                    <p class="mt-2 text-sm text-gray-600">0-24 vendégkiszolgálás</p>
                </div>
                <div class="rounded-2xl border border-gray-200 p-6 text-center">
                    <div
                        class="mx-auto mb-4 flex h-14 w-14 items-center justify-center rounded-full bg-blue-100 text-blue-500">
                        <svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18-2.087.277-4.216.42-6.378.42s-4.291-.143-6.378-.42c-1.085-.144-1.872-1.086-1.872-2.18v-4.25m16.5 0a2.18 2.18 0 00.75-1.661V8.706c0-1.081-.768-2.015-1.837-2.175a48.114 48.114 0 00-3.413-.387m4.5 8.006c-.194.165-.42.295-.673.38A23.978 23.978 0 0112 15.75c-2.648 0-5.195-.429-7.577-1.22a2.016 2.016 0 01-.673-.38m0 0A2.18 2.18 0 013 12.489V8.706c0-1.081.768-2.015 1.837-2.175a48.111 48.111 0 013.413-.387m7.5 0V5.25A2.25 2.25 0 0013.5 3h-3a2.25 2.25 0 00-2.25 2.25v.894m7.5 0a48.667 48.667 0 00-7.5 0M12 12.75h.008v.008H12v-.008z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900">Ügyfélszolgálati vezetők</h3>
                    <p class="mt-2 text-sm text-gray-600">Megkeresések 70%-ának automatizálása</p>
                </div>
                <div class="rounded-2xl border border-gray-200 p-6 text-center">
                    <div
                        class="mx-auto mb-4 flex h-14 w-14 items-center justify-center rounded-full bg-blue-100 text-blue-500">
                        <svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900">KKV ügyvezetők</h3>
                    <p class="mt-2 text-sm text-gray-600">Költséghatékony ügyfélszolgálat</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Testimonials Section (hidden) --}}
    @if(false)
    <section class="bg-white py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto mb-12 max-w-3xl text-center">
                <h2 class="text-3xl font-semibold text-gray-900 sm:text-4xl">Amit ügyfeleink mondanak</h2>
            </div>

            <div class="grid gap-8 sm:grid-cols-2">
                <div class="rounded-2xl bg-gray-50 p-8 shadow-sm">
                    <div class="mb-6 flex items-center gap-1">
                        @for ($i = 0; $i < 5; $i++)
                            <svg class="h-5 w-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg>
                        @endfor
                    </div>
                    <p class="mb-6 text-lg leading-relaxed text-gray-600">
                        "Az AI chatbot az ügyfélszolgálati megkeresések 75%-át kezeli automatikusan.
                        Az ügyfelek elégedettek, mi pedig végre a fontos feladatokra tudunk koncentrálni."
                    </p>
                    <div class="flex items-center gap-3">
                        <div
                            class="flex h-10 w-10 items-center justify-center rounded-full bg-blue-100 text-sm font-semibold text-blue-500">
                            KA</div>
                        <div>
                            <p class="text-sm font-semibold text-gray-900">Kovács Anna</p>
                            <p class="text-xs text-gray-500">Ügyvezető, Online kiskereskedelmi cég</p>
                        </div>
                    </div>
                </div>
                <div class="rounded-2xl bg-gray-50 p-8 shadow-sm">
                    <div class="mb-6 flex items-center gap-1">
                        @for ($i = 0; $i < 5; $i++)
                            <svg class="h-5 w-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg>
                        @endfor
                    </div>
                    <p class="mb-6 text-lg leading-relaxed text-gray-600">
                        "5 perc alatt telepítettük, és aznap estétől már válaszolt a vendégeink kérdéseire.
                        A többnyelvű támogatás a külföldi vendégeknél is kiválóan működik."
                    </p>
                    <div class="flex items-center gap-3">
                        <div
                            class="flex h-10 w-10 items-center justify-center rounded-full bg-blue-100 text-sm font-semibold text-blue-500">
                            SB</div>
                        <div>
                            <p class="text-sm font-semibold text-gray-900">Szabó Balázs</p>
                            <p class="text-xs text-gray-500">Tulajdonos, Balatoni panzió</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif

    {{-- FAQ Section --}}
    <section class="bg-gray-50 py-16 lg:py-24" x-data="{ openFaq: null }">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto mb-12 max-w-3xl text-center">
                <h2 class="text-3xl font-semibold text-gray-900 sm:text-4xl">Gyakran ismételt kérdések</h2>
            </div>

            <div class="mx-auto max-w-3xl space-y-4">
                <div class="rounded-xl border border-gray-200 bg-white">
                    <button @click="openFaq = openFaq === 1 ? null : 1"
                        class="flex w-full items-center justify-between px-6 py-4 text-left">
                        <span class="font-medium text-gray-900">Milyen weboldalakkal kompatibilis?</span>
                        <svg class="h-5 w-5 shrink-0 text-gray-400 transition-transform"
                            :class="{ 'rotate-180': openFaq === 1 }" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="openFaq === 1" x-collapse class="px-6 pb-4 text-gray-600">
                        Az AI Chat plugin elsősorban WordPress-hez készült, de JavaScript widget formájában bármilyen
                        weboldalba beilleszthető. WooCommerce integrációval webáruházakban is kiválóan működik.
                    </div>
                </div>
                <div class="rounded-xl border border-gray-200 bg-white">
                    <button @click="openFaq = openFaq === 2 ? null : 2"
                        class="flex w-full items-center justify-between px-6 py-4 text-left">
                        <span class="font-medium text-gray-900">Melyik AI szolgáltatót használja?</span>
                        <svg class="h-5 w-5 shrink-0 text-gray-400 transition-transform"
                            :class="{ 'rotate-180': openFaq === 2 }" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="openFaq === 2" x-collapse class="px-6 pb-4 text-gray-600">
                        Saját API kulcsot használhat — így teljes kontrollal rendelkezik a költségek és a szolgáltató
                        felett. Támogatjuk a legnépszerűbb AI szolgáltatókat.
                    </div>
                </div>
                <div class="rounded-xl border border-gray-200 bg-white">
                    <button @click="openFaq = openFaq === 3 ? null : 3"
                        class="flex w-full items-center justify-between px-6 py-4 text-left">
                        <span class="font-medium text-gray-900">Mennyire biztonságos az adatkezelés?</span>
                        <svg class="h-5 w-5 shrink-0 text-gray-400 transition-transform"
                            :class="{ 'rotate-180': openFaq === 3 }" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="openFaq === 3" x-collapse class="px-6 pb-4 text-gray-600">
                        Teljes mértékben GDPR kompatibilis. Az adatok titkosítva közlekednek, és Ön dönti el, milyen
                        információkat gyűjt a chatbot. Beszélgetéstörténet bármikor törölhető.
                    </div>
                </div>
                <div class="rounded-xl border border-gray-200 bg-white">
                    <button @click="openFaq = openFaq === 4 ? null : 4"
                        class="flex w-full items-center justify-between px-6 py-4 text-left">
                        <span class="font-medium text-gray-900">Mennyibe kerül az AI szolgáltatás?</span>
                        <svg class="h-5 w-5 shrink-0 text-gray-400 transition-transform"
                            :class="{ 'rotate-180': openFaq === 4 }" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="openFaq === 4" x-collapse class="px-6 pb-4 text-gray-600">
                        Az AI szolgáltatót közvetlenül fizeti — mi a szoftverért, frissítésekért és támogatásért
                        számolunk. Az átlagos AI költség havi néhány ezer forint, a forgalomtól függően.
                    </div>
                </div>
                <div class="rounded-xl border border-gray-200 bg-white">
                    <button @click="openFaq = openFaq === 5 ? null : 5"
                        class="flex w-full items-center justify-between px-6 py-4 text-left">
                        <span class="font-medium text-gray-900">Kell-e programozni a telepítéshez?</span>
                        <svg class="h-5 w-5 shrink-0 text-gray-400 transition-transform"
                            :class="{ 'rotate-180': openFaq === 5 }" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="openFaq === 5" x-collapse class="px-6 pb-4 text-gray-600">
                        Nem! A telepítés 5 perc alatt elvégezhető: plugin feltöltés, licenckulcs aktiválás, és máris
                        működik. A chatbot automatikusan indexeli a weboldal tartalmát.
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Related Modules Section --}}
    <section class="bg-white py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto mb-12 max-w-3xl text-center">
                <h2 class="text-3xl font-semibold text-gray-900 sm:text-4xl">Kapcsolódó modulok</h2>
                <p class="mt-4 text-lg text-gray-600">Bővítse az AI Chatet ezekkel a modulokkal.</p>
            </div>

            <div class="mx-auto grid max-w-3xl gap-6 sm:grid-cols-3">
                <a href="{{ route('products.crm') }}"
                    class="group rounded-2xl border border-gray-200 bg-white p-6 transition-shadow hover:shadow-md">
                    <x-module-icon module="crm" size="lg" />
                    <h3 class="mt-4 text-lg font-semibold text-gray-900 group-hover:text-blue-500">CRM modul</h3>
                    <p class="mt-2 text-sm text-gray-600">Ügyfélkapcsolat-kezelés és értékesítés támogatás</p>
                </a>
                <a href="{{ route('products.automatizalas') }}"
                    class="group rounded-2xl border border-gray-200 bg-white p-6 transition-shadow hover:shadow-md">
                    <x-module-icon module="automatizalas" size="lg" />
                    <h3 class="mt-4 text-lg font-semibold text-gray-900 group-hover:text-blue-500">Automatizálás</h3>
                    <p class="mt-2 text-sm text-gray-600">Workflow-k és triggerek az AI Chat eseményeihez</p>
                </a>
                <a href="{{ route('products.marketinghub') }}"
                    class="group rounded-2xl border border-gray-200 bg-white p-6 transition-shadow hover:shadow-md">
                    <x-module-icon module="marketinghub" size="lg" />
                    <h3 class="mt-4 text-lg font-semibold text-gray-900 group-hover:text-blue-500">MarketingHub</h3>
                    <p class="mt-2 text-sm text-gray-600">Online marketing eszközök és kampánykezelés</p>
                </a>
            </div>
        </div>
    </section>

    {{-- CTA Section --}}
    <section class="bg-blue-500 py-16 lg:py-20">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl font-semibold text-white sm:text-4xl">
                Kezdje el még ma — kockázat nélkül
            </h2>
            <p class="mx-auto mt-4 max-w-xl text-lg text-blue-100">
                Teljes funkcionalitás, magyar nyelvű támogatás. Kérjen személyre szabott bemutatót.
            </p>
            <div class="mt-8 flex flex-col items-center justify-center gap-4 sm:flex-row">
                <a href="{{ route('register') }}"
                    class="inline-flex items-center justify-center gap-2 rounded-full bg-white px-8 py-4 text-base font-semibold text-blue-500 shadow-lg transition-colors hover:bg-blue-50 hover:shadow-xl">
                    Kezdés indítása
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M14 5l7 7m0 0l-7 7m7-7H3" />
                    </svg>
                </a>
                <a href="{{ route('contact') }}"
                    class="inline-flex items-center justify-center gap-2 rounded-full border-2 border-blue-300 px-8 py-4 text-base font-semibold text-white transition-colors hover:bg-blue-600">
                    Demó kérése
                </a>
                <a href="{{ route('login') }}"
                    class="inline-flex items-center justify-center gap-2 text-base font-medium text-blue-200 transition-colors hover:text-white">
                    Bejelentkezés a programba →
                </a>
            </div>
        </div>
    </section>
</div>
