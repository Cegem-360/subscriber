<div>
    {{-- Hero Section --}}
    <section class="bg-linear-to-b from-gray-900 to-gray-800 py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto max-w-4xl text-center">
                <div class="mb-6 inline-flex items-center gap-2 rounded-full bg-indigo-500/20 px-4 py-1.5 text-sm font-medium text-indigo-300">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                    </svg>
                    Enterprise Megoldások
                </div>
                <h1 class="mb-6 text-4xl font-semibold text-white sm:text-5xl lg:text-6xl leading-tight">
                    Enterprise szintű irányítás — testreszabva az Ön igényeire
                </h1>
                <p class="mx-auto max-w-3xl text-lg text-gray-300 leading-relaxed sm:text-xl">
                    Nagyvállalatnál nincs helye a kompromisszumoknak. Több telephely, összetett folyamatok, szigorú
                    compliance-követelmények — és mindezek mellett a versenyképesség fenntartása. A Cégem360 Enterprise
                    olyan vállalatirányítási platformot kínál, amely skálázható, biztonságos és teljesen testreszabható.
                </p>

                {{-- CTA Buttons --}}
                <div class="mt-8 flex flex-col items-center justify-center gap-4 sm:flex-row">
                    <a href="{{ route('quote-request') }}" class="inline-flex items-center justify-center gap-2 rounded-full bg-indigo-600 px-8 py-4 text-base font-semibold text-white shadow-lg transition-colors hover:bg-indigo-700 hover:shadow-xl">
                        Enterprise konzultáció kérése
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </a>
                    <a href="{{ route('quote-request') }}" class="inline-flex items-center justify-center gap-2 rounded-full border-2 border-gray-600 bg-transparent px-8 py-4 text-base font-semibold text-white transition-colors hover:bg-gray-800">
                        Árajánlat kérése
                    </a>
                </div>

                {{-- Trust badges --}}
                <div class="mt-8 flex flex-wrap items-center justify-center gap-x-6 gap-y-2 text-sm text-gray-400">
                    <span class="flex items-center gap-1.5">
                        <svg class="h-4 w-4 text-indigo-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                        99,9% SLA garancia
                    </span>
                    <span class="flex items-center gap-1.5">
                        <svg class="h-4 w-4 text-indigo-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                        Dedikált támogatás
                    </span>
                    <span class="flex items-center gap-1.5">
                        <svg class="h-4 w-4 text-indigo-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                        Egyedi integrációk
                    </span>
                </div>
            </div>
        </div>
    </section>

    {{-- Challenges Section --}}
    <section class="bg-white py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto mb-12 max-w-3xl text-center">
                <h2 class="text-3xl font-semibold text-gray-900 sm:text-4xl">Nagyvállalati kihívások, amelyeket megoldunk</h2>
            </div>

            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
                <div class="rounded-2xl border border-indigo-100 bg-linear-to-br from-indigo-50 to-white p-8">
                    <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-xl bg-white shadow-sm">
                        <svg class="h-6 w-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4" />
                        </svg>
                    </div>
                    <h3 class="mb-2 text-lg font-semibold text-gray-900">Széttagolt rendszerek</h3>
                    <p class="text-gray-600">Különböző részlegek különböző eszközöket használnak, az adatok silókban
                        ragadnak.</p>
                </div>

                <div class="rounded-2xl border border-indigo-100 bg-linear-to-br from-indigo-50 to-white p-8">
                    <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-xl bg-white shadow-sm">
                        <svg class="h-6 w-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="mb-2 text-lg font-semibold text-gray-900">Lassú döntéshozatal</h3>
                    <p class="text-gray-600">Mire az adat összegyűlik és feldolgozódik, a piaci helyzet megváltozik.</p>
                </div>

                <div class="rounded-2xl border border-indigo-100 bg-linear-to-br from-indigo-50 to-white p-8">
                    <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-xl bg-white shadow-sm">
                        <svg class="h-6 w-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                    </div>
                    <h3 class="mb-2 text-lg font-semibold text-gray-900">Compliance-kockázatok</h3>
                    <p class="text-gray-600">GDPR, SOC 2, ISO — a megfelelés folyamatos figyelmet igényel.</p>
                </div>

                <div class="rounded-2xl border border-indigo-100 bg-linear-to-br from-indigo-50 to-white p-8">
                    <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-xl bg-white shadow-sm">
                        <svg class="h-6 w-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                        </svg>
                    </div>
                    <h3 class="mb-2 text-lg font-semibold text-gray-900">Skálázhatósági korlátok</h3>
                    <p class="text-gray-600">A jelenlegi rendszer nem bírja a növekedést, a migráció kockázatos.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Enterprise Modules Section --}}
    <section class="bg-gray-50 py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto mb-12 max-w-3xl text-center">
                <h2 class="text-3xl font-semibold text-gray-900 sm:text-4xl">Enterprise moduljaink</h2>
                <p class="mt-4 text-lg text-gray-600">Skálázható megoldások a legnagyobb kihívásokra.</p>
            </div>

            <div class="grid gap-8 lg:grid-cols-2">
                {{-- CRM Module --}}
                <div class="rounded-2xl border border-gray-100 bg-white p-8 shadow-sm transition-shadow hover:shadow-lg">
                    <div class="mb-4 flex items-center gap-4">
                        <x-module-icon module="crm" size="lg" />
                        <h3 class="text-xl font-semibold text-gray-900">CRM — 360°-os ügyfélnézet a teljes szervezetben
                        </h3>
                    </div>
                    <ul class="mb-4 space-y-2 text-gray-600">
                        <li class="flex items-start gap-2">
                            <svg class="mt-0.5 h-5 w-5 shrink-0 text-green-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            Egységes ügyfélkép minden részleg számára: értékesítés, support, pénzügy
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="mt-0.5 h-5 w-5 shrink-0 text-green-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            Automatizált lead-scoring és opportunity management
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="mt-0.5 h-5 w-5 shrink-0 text-green-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            Integráció meglévő ERP és marketing rendszerekkel
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="mt-0.5 h-5 w-5 shrink-0 text-green-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            Többszintű jogosultságkezelés és audit trail
                        </li>
                    </ul>
                    <div class="rounded-lg bg-indigo-50 px-4 py-3">
                        <p class="font-medium text-indigo-700">
                            Eredmény: 25%-kal magasabb ügyfél-életciklus érték (CLV).
                        </p>
                    </div>
                </div>

                {{-- Kontrolling Module --}}
                <div class="rounded-2xl border border-gray-100 bg-white p-8 shadow-sm transition-shadow hover:shadow-lg">
                    <div class="mb-4 flex items-center gap-4">
                        <x-module-icon module="kontrolling" size="lg" />
                        <h3 class="text-xl font-semibold text-gray-900">Kontrolling — Valós idejű üzleti intelligencia
                        </h3>
                    </div>
                    <ul class="mb-4 space-y-2 text-gray-600">
                        <li class="flex items-start gap-2">
                            <svg class="mt-0.5 h-5 w-5 shrink-0 text-green-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            Konszolidált pénzügyi riportok több vállalatról, valutáról, régióról
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="mt-0.5 h-5 w-5 shrink-0 text-green-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            Automatikus terv-tény elemzés és eltéréselemzés
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="mt-0.5 h-5 w-5 shrink-0 text-green-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            Prediktív analitika és szcenárió-tervezés
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="mt-0.5 h-5 w-5 shrink-0 text-green-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            Board-szintű dashboardok másodpercek alatt
                        </li>
                    </ul>
                    <div class="rounded-lg bg-indigo-50 px-4 py-3">
                        <p class="font-medium text-indigo-700">
                            Eredmény: 60%-kal gyorsabb zárási ciklus, azonnali döntéstámogatás.
                        </p>
                    </div>
                </div>

                {{-- Beszerzés-logisztika Module --}}
                <div class="rounded-2xl border border-gray-100 bg-white p-8 shadow-sm transition-shadow hover:shadow-lg">
                    <div class="mb-4 flex items-center gap-4">
                        <x-module-icon module="beszerzes" size="lg" />
                        <h3 class="text-xl font-semibold text-gray-900">Beszerzés-logisztika — Globális ellátási lánc
                            menedzsment</h3>
                    </div>
                    <ul class="mb-4 space-y-2 text-gray-600">
                        <li class="flex items-start gap-2">
                            <svg class="mt-0.5 h-5 w-5 shrink-0 text-green-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            Több raktár, több beszállító, több telephely — egyetlen felületen
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="mt-0.5 h-5 w-5 shrink-0 text-green-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            Automatikus újrarendelés és készletoptimalizálás
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="mt-0.5 h-5 w-5 shrink-0 text-green-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            Beszállítói teljesítmény-monitoring és kockázatkezelés
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="mt-0.5 h-5 w-5 shrink-0 text-green-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            EDI és API integráció a partnerekkel
                        </li>
                    </ul>
                    <div class="rounded-lg bg-indigo-50 px-4 py-3">
                        <p class="font-medium text-indigo-700">
                            Eredmény: 20-30% készletcsökkentés a szolgáltatási szint megtartása mellett.
                        </p>
                    </div>
                </div>

                {{-- Gyártásirányítás Module --}}
                <div class="rounded-2xl border border-gray-100 bg-white p-8 shadow-sm transition-shadow hover:shadow-lg">
                    <div class="mb-4 flex items-center gap-4">
                        <x-module-icon module="gyartas" size="lg" />
                        <h3 class="text-xl font-semibold text-gray-900">Gyártásirányítás — Intelligens termeléstervezés
                        </h3>
                    </div>
                    <ul class="mb-4 space-y-2 text-gray-600">
                        <li class="flex items-start gap-2">
                            <svg class="mt-0.5 h-5 w-5 shrink-0 text-green-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            MES integráció és valós idejű termeléskövetés
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="mt-0.5 h-5 w-5 shrink-0 text-green-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            Kapacitástervezés és ütemezés optimalizálás
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="mt-0.5 h-5 w-5 shrink-0 text-green-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            Minőségbiztosítás és nyomon követhetőség
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="mt-0.5 h-5 w-5 shrink-0 text-green-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            OEE monitoring és prediktív karbantartás
                        </li>
                    </ul>
                    <div class="rounded-lg bg-indigo-50 px-4 py-3">
                        <p class="font-medium text-indigo-700">
                            Eredmény: 15%-kal magasabb OEE, 40%-kal kevesebb állásidő.
                        </p>
                    </div>
                </div>

                {{-- Automatizálás Module - Full width --}}
                <div class="rounded-2xl border border-gray-100 bg-white p-8 shadow-sm transition-shadow hover:shadow-lg lg:col-span-2">
                    <div class="mb-4 flex items-center gap-4">
                        <x-module-icon module="automatizalas" size="lg" />
                        <h3 class="text-xl font-semibold text-gray-900">Automatizálás — Vállalati szintű workflow engine
                        </h3>
                    </div>
                    <div class="grid gap-4 sm:grid-cols-2">
                        <ul class="space-y-2 text-gray-600">
                            <li class="flex items-start gap-2">
                                <svg class="mt-0.5 h-5 w-5 shrink-0 text-green-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                                Komplex, többlépcsős jóváhagyási folyamatok
                            </li>
                            <li class="flex items-start gap-2">
                                <svg class="mt-0.5 h-5 w-5 shrink-0 text-green-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                                Cross-departmental workflow-ok szabályalapú triggerekkel
                            </li>
                        </ul>
                        <ul class="space-y-2 text-gray-600">
                            <li class="flex items-start gap-2">
                                <svg class="mt-0.5 h-5 w-5 shrink-0 text-green-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                                RPA integráció és API-alapú automatizáció
                            </li>
                            <li class="flex items-start gap-2">
                                <svg class="mt-0.5 h-5 w-5 shrink-0 text-green-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                                Audit-képes folyamatdokumentáció
                            </li>
                        </ul>
                    </div>
                    <div class="mt-4 rounded-lg bg-indigo-50 px-4 py-3">
                        <p class="font-medium text-indigo-700">
                            Eredmény: 50%-kal rövidebb átfutási idők, teljes compliance-megfelelés.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Enterprise Benefits Section --}}
    <section class="bg-white py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto mb-12 max-w-3xl text-center">
                <h2 class="text-3xl font-semibold text-gray-900 sm:text-4xl">Nagyvállalati előnyök</h2>
            </div>

            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                <div class="flex gap-4 rounded-2xl border border-gray-100 bg-white p-6 shadow-sm transition-shadow hover:shadow-lg">
                    <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-lg bg-indigo-100 text-indigo-600">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="mb-1 font-semibold text-gray-900">Dedikált Customer Success Manager</h3>
                        <p class="text-sm text-gray-600">Személyes kapcsolattartó, aki ismeri az Ön üzletét.</p>
                    </div>
                </div>

                <div class="flex gap-4 rounded-2xl border border-gray-100 bg-white p-6 shadow-sm transition-shadow hover:shadow-lg">
                    <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-lg bg-indigo-100 text-indigo-600">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="mb-1 font-semibold text-gray-900">SLA-garantált rendelkezésre állás</h3>
                        <p class="text-sm text-gray-600">99,9% uptime és 24/7 prioritásos támogatás.</p>
                    </div>
                </div>

                <div class="flex gap-4 rounded-2xl border border-gray-100 bg-white p-6 shadow-sm transition-shadow hover:shadow-lg">
                    <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-lg bg-indigo-100 text-indigo-600">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5 12h14M5 12a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v4a2 2 0 01-2 2M5 12a2 2 0 00-2 2v4a2 2 0 002 2h14a2 2 0 002-2v-4a2 2 0 00-2-2" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="mb-1 font-semibold text-gray-900">On-premise és hibrid deployment</h3>
                        <p class="text-sm text-gray-600">Saját infrastruktúrán vagy privát felhőben.</p>
                    </div>
                </div>

                <div class="flex gap-4 rounded-2xl border border-gray-100 bg-white p-6 shadow-sm transition-shadow hover:shadow-lg">
                    <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-lg bg-indigo-100 text-indigo-600">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="mb-1 font-semibold text-gray-900">Enterprise SSO és identity management</h3>
                        <p class="text-sm text-gray-600">SAML, LDAP, Active Directory integráció.</p>
                    </div>
                </div>

                <div class="flex gap-4 rounded-2xl border border-gray-100 bg-white p-6 shadow-sm transition-shadow hover:shadow-lg">
                    <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-lg bg-indigo-100 text-indigo-600">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="mb-1 font-semibold text-gray-900">Custom fejlesztés és integráció</h3>
                        <p class="text-sm text-gray-600">API-first architektúra, testreszabott modulok.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Security & Compliance Section --}}
    <section class="bg-gray-900 py-16 lg:py-20">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto mb-12 max-w-3xl text-center">
                <h2 class="text-3xl font-semibold text-white">Biztonság és megfelelőség</h2>
                <p class="mt-4 text-gray-400">A legmagasabb szintű adatvédelem és compliance</p>
            </div>

            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                <div class="flex items-center gap-4 rounded-lg border border-gray-700 bg-gray-800 p-4">
                    <svg class="h-8 w-8 shrink-0 text-green-400" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                    </svg>
                    <span class="text-white">SOC 2 Type II tanúsított infrastruktúra</span>
                </div>

                <div class="flex items-center gap-4 rounded-lg border border-gray-700 bg-gray-800 p-4">
                    <svg class="h-8 w-8 shrink-0 text-green-400" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                    </svg>
                    <span class="text-white">GDPR és CCPA megfelelőség beépítve</span>
                </div>

                <div class="flex items-center gap-4 rounded-lg border border-gray-700 bg-gray-800 p-4">
                    <svg class="h-8 w-8 shrink-0 text-green-400" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                    </svg>
                    <span class="text-white">Végpontok közötti titkosítás (AES-256)</span>
                </div>

                <div class="flex items-center gap-4 rounded-lg border border-gray-700 bg-gray-800 p-4">
                    <svg class="h-8 w-8 shrink-0 text-green-400" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                    </svg>
                    <span class="text-white">Rendszeres penetrációs tesztelés és audit</span>
                </div>

                <div class="flex items-center gap-4 rounded-lg border border-gray-700 bg-gray-800 p-4">
                    <svg class="h-8 w-8 shrink-0 text-green-400" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                    </svg>
                    <span class="text-white">ISO 27001 kompatibilis adatkezelés</span>
                </div>
            </div>
        </div>
    </section>

    {{-- Bottom CTA Section --}}
    <section class="bg-indigo-600 py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-4 text-center sm:px-6 lg:px-8">
            <h2 class="text-3xl font-semibold text-white sm:text-4xl">
                Beszéljünk az Ön igényeiről
            </h2>
            <p class="mx-auto mt-4 max-w-xl text-lg text-indigo-100">
                Minden nagyvállalat más. Ezért kezdjük egy személyes konzultációval, ahol feltérképezzük az Ön
                kihívásait és bemutatjuk, hogyan segíthet a Cégem360.
            </p>
            <div class="mt-8 flex flex-col items-center justify-center gap-4 sm:flex-row">
                <a href="{{ route('quote-request') }}"
                    class="inline-flex items-center justify-center gap-2 rounded-full bg-white px-8 py-4 text-base font-semibold text-indigo-600 shadow-lg transition-colors hover:bg-indigo-50 hover:shadow-xl">
                    Enterprise konzultáció kérése
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M14 5l7 7m0 0l-7 7m7-7H3" />
                    </svg>
                </a>
                <a href="{{ route('quote-request') }}"
                    class="inline-flex items-center justify-center rounded-full border-2 border-indigo-400 px-8 py-4 text-base font-semibold text-white transition-colors hover:bg-indigo-700">
                    Árajánlat kérése
                </a>
            </div>
        </div>
    </section>
</div>
