<div>
    {{-- Hero Section --}}
    <section class="bg-linear-to-b from-gray-900 to-gray-800 py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto max-w-4xl text-center">
                <div class="mb-6 inline-flex items-center gap-2 rounded-full bg-indigo-500/20 px-4 py-1.5 text-sm font-medium text-indigo-300">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 4a2 2 0 114 0v1a1 1 0 001 1h3a1 1 0 011 1v3a1 1 0 01-1 1h-1a2 2 0 100 4h1a1 1 0 011 1v3a1 1 0 01-1 1h-3a1 1 0 01-1-1v-1a2 2 0 10-4 0v1a1 1 0 01-1 1H7a1 1 0 01-1-1v-3a1 1 0 00-1-1H4a2 2 0 110-4h1a1 1 0 001-1V7a1 1 0 011-1h3a1 1 0 001-1V4z" />
                    </svg>
                    Egyedi megoldások
                </div>

                <h1 class="mb-6 text-4xl font-bold tracking-tight text-white sm:text-5xl lg:text-6xl">
                    Az Ön vállalkozására szabva
                    <span class="text-indigo-400">— nem fordítva</span>
                </h1>

                <p class="mx-auto mb-8 max-w-3xl text-lg text-gray-300 sm:text-xl">
                    Minden vállalkozás egyedi. Ezért a Cégem360-at úgy alakítjuk, hogy az Ön folyamataihoz igazodjon —
                    legyen szó 10 vagy 1000 fős cégről. Egyedi integrációk, testreszabott modulok és dedikált támogatás.
                </p>

                <div class="flex flex-col justify-center gap-4 sm:flex-row">
                    <a href="{{ route('quote-request') }}" class="inline-flex items-center justify-center gap-2 rounded-lg bg-indigo-600 px-8 py-4 text-base font-semibold text-white shadow-lg transition hover:bg-indigo-700">
                        Konzultációt kérek
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                        </svg>
                    </a>
                    <a href="{{ route('quote-request') }}" class="inline-flex items-center justify-center gap-2 rounded-lg border-2 border-gray-600 px-8 py-4 text-base font-semibold text-white transition hover:bg-gray-800">
                        Árajánlatot kérek
                    </a>
                </div>

                <div class="mt-10 flex flex-wrap items-center justify-center gap-x-8 gap-y-4 text-sm text-gray-400">
                    <div class="flex items-center gap-2">
                        <svg class="h-5 w-5 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Egyedi fejlesztés
                    </div>
                    <div class="flex items-center gap-2">
                        <svg class="h-5 w-5 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Személyes támogatás
                    </div>
                    <div class="flex items-center gap-2">
                        <svg class="h-5 w-5 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Rugalmas árazás
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Why Custom Solutions Section --}}
    <section class="bg-white py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto max-w-3xl text-center">
                <h2 class="mb-4 text-3xl font-bold text-gray-900 sm:text-4xl">
                    Miért válasszon egyedi megoldást?
                </h2>
                <p class="text-lg text-gray-600">
                    A dobozos szoftverek ritkán illeszkednek tökéletesen. Az egyedi megoldás azt jelenti,
                    hogy a rendszer az Ön munkamódszeréhez alkalmazkodik — nem Önnek kell megváltoznia.
                </p>
            </div>

            <div class="mt-12 grid gap-8 md:grid-cols-2 lg:grid-cols-3">
                <div class="rounded-xl bg-gray-50 p-6">
                    <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-lg bg-indigo-100">
                        <svg class="h-6 w-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z" />
                        </svg>
                    </div>
                    <h3 class="mb-2 font-semibold text-gray-900">Egyedi felület</h3>
                    <p class="text-sm text-gray-600">Az Ön munkafolyamataihoz tervezett képernyők és dashboardok — nem általános sablonok.</p>
                </div>

                <div class="rounded-xl bg-gray-50 p-6">
                    <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-lg bg-indigo-100">
                        <svg class="h-6 w-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l3 3-3 3m5 0h3M5 20h14a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <h3 class="mb-2 font-semibold text-gray-900">Rendszerintegráció</h3>
                    <p class="text-sm text-gray-600">Összekapcsoljuk a meglévő rendszereivel: ERP, számlázó, webshop, HR — bármi.</p>
                </div>

                <div class="rounded-xl bg-gray-50 p-6">
                    <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-lg bg-indigo-100">
                        <svg class="h-6 w-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                    <h3 class="mb-2 font-semibold text-gray-900">Automatizálás</h3>
                    <p class="text-sm text-gray-600">Egyedi workflow-k és triggerek, amelyek automatizálják az ismétlődő feladatokat.</p>
                </div>

                <div class="rounded-xl bg-gray-50 p-6">
                    <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-lg bg-indigo-100">
                        <svg class="h-6 w-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <h3 class="mb-2 font-semibold text-gray-900">Egyedi riportok</h3>
                    <p class="text-sm text-gray-600">Pontosan azokat az adatokat látja, amelyekre szüksége van — a saját KPI-jaival.</p>
                </div>

                <div class="rounded-xl bg-gray-50 p-6">
                    <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-lg bg-indigo-100">
                        <svg class="h-6 w-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </div>
                    <h3 class="mb-2 font-semibold text-gray-900">Dedikált támogatás</h3>
                    <p class="text-sm text-gray-600">Személyes kapcsolattartó, aki ismeri az Ön rendszerét és üzletét.</p>
                </div>

                <div class="rounded-xl bg-gray-50 p-6">
                    <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-lg bg-indigo-100">
                        <svg class="h-6 w-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                    </div>
                    <h3 class="mb-2 font-semibold text-gray-900">Magasabb SLA</h3>
                    <p class="text-sm text-gray-600">Garantált rendelkezésre állás és gyorsabb reakcióidő kritikus problémáknál.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- How It Works Section --}}
    <section class="bg-gray-50 py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto max-w-3xl text-center">
                <h2 class="mb-4 text-3xl font-bold text-gray-900 sm:text-4xl">
                    Hogyan működik?
                </h2>
                <p class="text-lg text-gray-600">
                    Négy lépésben jutunk el az ötlettől a működő rendszerig
                </p>
            </div>

            <div class="relative mt-16">
                {{-- Connecting line (hidden on mobile) --}}
                <div class="absolute left-[calc(12.5%+1.5rem)] right-[calc(12.5%+1.5rem)] top-6 hidden h-0.5 bg-indigo-200 lg:block"></div>

                <div class="grid gap-8 lg:grid-cols-4">
                    <div class="text-center">
                        <div class="relative z-10 mx-auto mb-4 flex h-12 w-12 items-center justify-center rounded-full bg-indigo-600 text-xl font-bold text-white">1</div>
                        <h3 class="mb-2 text-lg font-semibold text-gray-900">Felmérés</h3>
                        <p class="text-gray-600">Megismerjük a folyamatait, fájdalompontjait és céljait. Személyesen vagy online.</p>
                    </div>

                    <div class="text-center">
                        <div class="relative z-10 mx-auto mb-4 flex h-12 w-12 items-center justify-center rounded-full bg-indigo-600 text-xl font-bold text-white">2</div>
                        <h3 class="mb-2 text-lg font-semibold text-gray-900">Tervezés</h3>
                        <p class="text-gray-600">Elkészítjük a rendszertervet és az árajánlatot. Ön dönt, mi haladunk.</p>
                    </div>

                    <div class="text-center">
                        <div class="relative z-10 mx-auto mb-4 flex h-12 w-12 items-center justify-center rounded-full bg-indigo-600 text-xl font-bold text-white">3</div>
                        <h3 class="mb-2 text-lg font-semibold text-gray-900">Fejlesztés</h3>
                        <p class="text-gray-600">Agilis módszertannal dolgozunk: rendszeres demók, folyamatos visszajelzés.</p>
                    </div>

                    <div class="text-center">
                        <div class="relative z-10 mx-auto mb-4 flex h-12 w-12 items-center justify-center rounded-full bg-green-600 text-xl font-bold text-white">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                        <h3 class="mb-2 text-lg font-semibold text-gray-900">Élesítés</h3>
                        <p class="text-gray-600">Bevezetés, oktatás és folyamatos támogatás. Nem hagyjuk magára.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Integration Examples --}}
    <section class="bg-white py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="grid items-center gap-12 lg:grid-cols-2">
                <div>
                    <h2 class="mb-4 text-3xl font-bold text-gray-900 sm:text-4xl">
                        Integrálható a meglévő rendszereivel
                    </h2>
                    <p class="mb-8 text-lg text-gray-600">
                        Nem kell mindent lecserélnie. A Cégem360 összekapcsolható a már használt eszközökkel,
                        így az adatok automatikusan szinkronizálódnak.
                    </p>

                    <div class="space-y-4">
                        <div class="flex items-start gap-4">
                            <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-indigo-100">
                                <svg class="h-5 w-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-900">Számlázó rendszerek</h4>
                                <p class="text-sm text-gray-600">Billingo, Számlázz.hu, Kulcs-Soft és más magyar rendszerek</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-4">
                            <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-indigo-100">
                                <svg class="h-5 w-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-900">Webshopok</h4>
                                <p class="text-sm text-gray-600">Shopify, WooCommerce, Shoprenter, Unas</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-4">
                            <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-indigo-100">
                                <svg class="h-5 w-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-900">ERP rendszerek</h4>
                                <p class="text-sm text-gray-600">SAP, Microsoft Dynamics, Odoo, Nexon</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-4">
                            <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-indigo-100">
                                <svg class="h-5 w-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-900">Kommunikációs eszközök</h4>
                                <p class="text-sm text-gray-600">Microsoft 365, Google Workspace, Slack, Teams</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="rounded-2xl bg-gray-50 p-8">
                    <div class="grid grid-cols-3 gap-4">
                        {{-- SAP --}}
                        <div class="flex h-20 items-center justify-center rounded-xl bg-white p-4 shadow-sm">
                            <img src="{{ asset('images/integrations/sap.svg') }}" alt="SAP" class="h-9 w-auto">
                        </div>
                        {{-- Billingo --}}
                        <div class="flex h-20 items-center justify-center rounded-xl bg-white p-4 shadow-sm">
                            <img src="{{ asset('images/integrations/billingo.svg') }}" alt="Billingo" class="h-9 w-auto">
                        </div>
                        {{-- Shopify --}}
                        <div class="flex h-20 items-center justify-center rounded-xl bg-white p-4 shadow-sm">
                            <img src="{{ asset('images/integrations/shopify.svg') }}" alt="Shopify" class="h-7 w-auto">
                        </div>
                        {{-- Microsoft Teams --}}
                        <div class="flex h-20 items-center justify-center rounded-xl bg-white p-4 shadow-sm">
                            <img src="{{ asset('images/integrations/teams.svg') }}" alt="Microsoft Teams" class="h-10 w-auto">
                        </div>
                        {{-- Slack --}}
                        <div class="flex h-20 items-center justify-center rounded-xl bg-white p-4 shadow-sm">
                            <img src="{{ asset('images/integrations/slack.svg') }}" alt="Slack" class="h-8 w-auto">
                        </div>
                        {{-- Nexon --}}
                        <div class="flex h-20 items-center justify-center rounded-xl bg-white p-4 shadow-sm">
                            <img src="{{ asset('images/integrations/nexon.svg') }}" alt="Nexon" class="h-5 w-auto">
                        </div>
                        {{-- HubSpot --}}
                        <div class="flex h-20 items-center justify-center rounded-xl bg-white p-4 shadow-sm">
                            <img src="{{ asset('images/integrations/hubspot.svg') }}" alt="HubSpot" class="h-10 w-auto">
                        </div>
                        {{-- Microsoft Dynamics --}}
                        <div class="flex h-20 items-center justify-center rounded-xl bg-white p-4 shadow-sm">
                            <img src="{{ asset('images/integrations/dynamics.svg') }}" alt="Microsoft Dynamics 365" class="h-10 w-auto">
                        </div>
                        <div class="flex h-20 items-center justify-center rounded-xl bg-indigo-100 p-4">
                            <span class="text-sm font-medium text-indigo-600">+50 további</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Pricing Section --}}
    <section class="bg-gray-50 py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto max-w-3xl text-center">
                <h2 class="mb-4 text-3xl font-bold text-gray-900 sm:text-4xl">
                    Átlátható árazás
                </h2>
                <p class="text-lg text-gray-600">
                    Nincs rejtett költség. Pontosan tudja, mire számíthat.
                </p>
            </div>

            <div class="mt-12 grid gap-8 lg:grid-cols-3">
                <div class="rounded-2xl bg-white p-8 shadow-sm">
                    <h3 class="mb-2 text-xl font-semibold text-gray-900">Konzultáció</h3>
                    <p class="mb-6 text-gray-600">Felmérés és tervezés</p>
                    <div class="mb-6">
                        <span class="text-4xl font-bold text-gray-900">Ingyenes</span>
                    </div>
                    <ul class="mb-8 space-y-3">
                        <li class="flex items-center gap-2 text-sm text-gray-600">
                            <svg class="h-5 w-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            60 perces személyes vagy online megbeszélés
                        </li>
                        <li class="flex items-center gap-2 text-sm text-gray-600">
                            <svg class="h-5 w-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Igényfelmérés és rendszertervezés
                        </li>
                        <li class="flex items-center gap-2 text-sm text-gray-600">
                            <svg class="h-5 w-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Részletes árajánlat
                        </li>
                    </ul>
                    <a href="{{ route('quote-request') }}" class="block w-full rounded-lg bg-indigo-600 py-3 text-center font-semibold text-white transition hover:bg-indigo-700">
                        Konzultációt kérek
                    </a>
                </div>

                <div class="relative rounded-2xl bg-indigo-600 p-8 shadow-lg">
                    <div class="absolute -top-4 left-1/2 -translate-x-1/2 rounded-full bg-indigo-500 px-4 py-1 text-sm font-medium text-white">
                        Legnépszerűbb
                    </div>
                    <h3 class="mb-2 text-xl font-semibold text-white">Egyedi fejlesztés</h3>
                    <p class="mb-6 text-indigo-200">Testreszabott megoldás</p>
                    <div class="mb-6">
                        <span class="text-4xl font-bold text-white">Egyedi ár</span>
                    </div>
                    <ul class="mb-8 space-y-3">
                        <li class="flex items-center gap-2 text-sm text-indigo-100">
                            <svg class="h-5 w-5 text-indigo-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Minden a Konzultációban +
                        </li>
                        <li class="flex items-center gap-2 text-sm text-indigo-100">
                            <svg class="h-5 w-5 text-indigo-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Egyedi modul fejlesztés
                        </li>
                        <li class="flex items-center gap-2 text-sm text-indigo-100">
                            <svg class="h-5 w-5 text-indigo-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Rendszerintegrációk
                        </li>
                        <li class="flex items-center gap-2 text-sm text-indigo-100">
                            <svg class="h-5 w-5 text-indigo-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Bevezetés és oktatás
                        </li>
                        <li class="flex items-center gap-2 text-sm text-indigo-100">
                            <svg class="h-5 w-5 text-indigo-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Dedikált támogatás
                        </li>
                    </ul>
                    <a href="{{ route('quote-request') }}" class="block w-full rounded-lg bg-white py-3 text-center font-semibold text-indigo-600 transition hover:bg-indigo-50">
                        Árajánlatot kérek
                    </a>
                </div>

                <div class="rounded-2xl bg-white p-8 shadow-sm">
                    <h3 class="mb-2 text-xl font-semibold text-gray-900">Támogatás</h3>
                    <p class="mb-6 text-gray-600">Folyamatos üzemeltetés</p>
                    <div class="mb-6">
                        <span class="text-4xl font-bold text-gray-900">Havidíjas</span>
                    </div>
                    <ul class="mb-8 space-y-3">
                        <li class="flex items-center gap-2 text-sm text-gray-600">
                            <svg class="h-5 w-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Személyes kapcsolattartó
                        </li>
                        <li class="flex items-center gap-2 text-sm text-gray-600">
                            <svg class="h-5 w-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Prioritásos hibajavítás
                        </li>
                        <li class="flex items-center gap-2 text-sm text-gray-600">
                            <svg class="h-5 w-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Rendszeres frissítések
                        </li>
                        <li class="flex items-center gap-2 text-sm text-gray-600">
                            <svg class="h-5 w-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            SLA garancia
                        </li>
                    </ul>
                    <a href="{{ route('quote-request') }}" class="block w-full rounded-lg border-2 border-indigo-600 py-3 text-center font-semibold text-indigo-600 transition hover:bg-indigo-50">
                        Részleteket kérek
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{-- Who Is It For Section --}}
    <section class="bg-white py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto max-w-3xl text-center">
                <h2 class="mb-4 text-3xl font-bold text-gray-900 sm:text-4xl">
                    Kinek ajánljuk?
                </h2>
            </div>

            <div class="mt-12 grid gap-8 md:grid-cols-2">
                <div class="rounded-2xl bg-green-50 p-8">
                    <h3 class="mb-6 flex items-center gap-2 text-xl font-semibold text-green-800">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Ideális, ha...
                    </h3>
                    <ul class="space-y-3 text-green-700">
                        <li class="flex items-start gap-2">
                            <span class="mt-1.5 h-1.5 w-1.5 shrink-0 rounded-full bg-green-500"></span>
                            Egyedi munkafolyamatai vannak, amik nem férnek bele a standard megoldásokba
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="mt-1.5 h-1.5 w-1.5 shrink-0 rounded-full bg-green-500"></span>
                            Több rendszert használ, és szeretné ezeket összekötni
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="mt-1.5 h-1.5 w-1.5 shrink-0 rounded-full bg-green-500"></span>
                            Személyes támogatásra és partnerségre vágyik
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="mt-1.5 h-1.5 w-1.5 shrink-0 rounded-full bg-green-500"></span>
                            Hosszú távon gondolkodik és befektetne a hatékonyságba
                        </li>
                    </ul>
                </div>

                <div class="rounded-2xl bg-gray-100 p-8">
                    <h3 class="mb-6 flex items-center gap-2 text-xl font-semibold text-gray-600">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                        Nem ideális, ha...
                    </h3>
                    <ul class="space-y-3 text-gray-600">
                        <li class="flex items-start gap-2">
                            <span class="mt-1.5 h-1.5 w-1.5 shrink-0 rounded-full bg-gray-400"></span>
                            Standard megoldás is megfelel az igényeinek
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="mt-1.5 h-1.5 w-1.5 shrink-0 rounded-full bg-gray-400"></span>
                            Azonnal, bevezetés nélkül szeretne indulni
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="mt-1.5 h-1.5 w-1.5 shrink-0 rounded-full bg-gray-400"></span>
                            A legolcsóbb megoldást keresi
                        </li>
                    </ul>
                    <p class="mt-6 text-sm text-gray-500">
                        Ha standard megoldás is elég, nézze meg a
                        <a href="{{ route('solutions.kkv') }}" class="font-medium text-indigo-600 hover:underline">KKV csomagunkat</a>
                        vagy az
                        <a href="{{ route('pricing') }}" class="font-medium text-indigo-600 hover:underline">árazási oldalunkat</a>.
                    </p>
                </div>
            </div>
        </div>
    </section>

    {{-- Testimonials --}}
    <section class="bg-gray-50 py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto max-w-3xl text-center">
                <h2 class="mb-4 text-3xl font-bold text-gray-900 sm:text-4xl">
                    Ügyfeleink mondták
                </h2>
            </div>

            <div class="mt-12 grid gap-8 lg:grid-cols-2">
                <div class="rounded-2xl bg-white p-8 shadow-sm">
                    <div class="mb-6 flex items-center gap-1">
                        @for ($i = 0; $i < 5; $i++)
                            <svg class="h-5 w-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg>
                        @endfor
                    </div>
                    <blockquote class="mb-6 text-lg text-gray-700">
                        „Korábban 4 különböző rendszert használtunk, most minden egy helyen van. A Cégem360 csapata pontosan megértette, mire van szükségünk."
                    </blockquote>
                    <div class="flex items-center gap-4">
                        <div class="flex h-12 w-12 items-center justify-center rounded-full bg-indigo-200 font-semibold text-indigo-700">TK</div>
                        <div>
                            <div class="font-semibold text-gray-900">Tóth Katalin</div>
                            <div class="text-sm text-gray-600">Ügyvezető, Közepes méretű gyártó cég</div>
                        </div>
                    </div>
                </div>

                <div class="rounded-2xl bg-white p-8 shadow-sm">
                    <div class="mb-6 flex items-center gap-1">
                        @for ($i = 0; $i < 5; $i++)
                            <svg class="h-5 w-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg>
                        @endfor
                    </div>
                    <blockquote class="mb-6 text-lg text-gray-700">
                        „A bevezetés zökkenőmentes volt, és azóta is van kire számítani, ha kérdésem van. Ez az igazi partnerség."
                    </blockquote>
                    <div class="flex items-center gap-4">
                        <div class="flex h-12 w-12 items-center justify-center rounded-full bg-indigo-200 font-semibold text-indigo-700">NP</div>
                        <div>
                            <div class="font-semibold text-gray-900">Nagy Péter</div>
                            <div class="text-sm text-gray-600">Tulajdonos, Kereskedelmi vállalkozás</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- FAQ Section --}}
    <section class="bg-white py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto max-w-3xl text-center">
                <h2 class="mb-4 text-3xl font-bold text-gray-900 sm:text-4xl">
                    Gyakran ismételt kérdések
                </h2>
            </div>

            <div class="mx-auto mt-12 max-w-3xl space-y-4">
                <div x-data="{ open: false }" class="rounded-xl bg-gray-50 shadow-sm">
                    <button @click="open = !open" class="flex w-full items-center justify-between p-6 text-left">
                        <span class="font-semibold text-gray-900">Mekkora cégeknek ajánlják?</span>
                        <svg class="h-5 w-5 text-gray-500 transition-transform" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="open" x-collapse class="px-6 pb-6">
                        <p class="text-gray-600">Bármilyen méretű cégnek, akinek egyedi igényei vannak. Dolgoztunk már 5 fős startuppal és 500 fős gyártó céggel is. A lényeg nem a méret, hanem hogy a standard megoldások nem felelnek meg az igényeinek.</p>
                    </div>
                </div>

                <div x-data="{ open: false }" class="rounded-xl bg-gray-50 shadow-sm">
                    <button @click="open = !open" class="flex w-full items-center justify-between p-6 text-left">
                        <span class="font-semibold text-gray-900">Mennyi ideig tart egy egyedi projekt?</span>
                        <svg class="h-5 w-5 text-gray-500 transition-transform" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="open" x-collapse class="px-6 pb-6">
                        <p class="text-gray-600">A projekt komplexitásától függően 4-16 hét. Egy egyszerűbb integráció akár 2 hét alatt is elkészülhet, míg egy teljes egyedi rendszer fejlesztése több hónapot is igénybe vehet. A konzultáción pontosabb időbecslést adunk.</p>
                    </div>
                </div>

                <div x-data="{ open: false }" class="rounded-xl bg-gray-50 shadow-sm">
                    <button @click="open = !open" class="flex w-full items-center justify-between p-6 text-left">
                        <span class="font-semibold text-gray-900">Mi történik, ha közben változnak az igényeim?</span>
                        <svg class="h-5 w-5 text-gray-500 transition-transform" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="open" x-collapse class="px-6 pb-6">
                        <p class="text-gray-600">Agilis módszertannal dolgozunk, ami azt jelenti, hogy rugalmasan tudunk alkalmazkodni a változó igényekhez. Rendszeres demókon egyeztetünk, és szükség esetén módosítjuk az irányt.</p>
                    </div>
                </div>

                <div x-data="{ open: false }" class="rounded-xl bg-gray-50 shadow-sm">
                    <button @click="open = !open" class="flex w-full items-center justify-between p-6 text-left">
                        <span class="font-semibold text-gray-900">Van próbaidőszak?</span>
                        <svg class="h-5 w-5 text-gray-500 transition-transform" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="open" x-collapse class="px-6 pb-6">
                        <p class="text-gray-600">Egyedi projekteknél Proof of Concept (PoC) fázist tudunk biztosítani, ahol egy kisebb scope-on tesztelheti a megoldást, mielőtt a teljes projektre elköteleződne.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Bottom CTA Section --}}
    <section class="bg-linear-to-br from-indigo-600 to-indigo-800 py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto max-w-3xl text-center">
                <h2 class="mb-4 text-3xl font-bold text-white sm:text-4xl">
                    Beszéljünk az Ön igényeiről
                </h2>
                <p class="mb-10 text-lg text-indigo-100">
                    Egyeztessünk egy 30 perces hívást, ahol megértjük a kihívásait és felvázoljuk a lehetséges megoldásokat.
                    Nincs elköteleződés, csak egy beszélgetés.
                </p>
                <div class="flex flex-col justify-center gap-4 sm:flex-row">
                    <a href="{{ route('quote-request') }}" class="inline-flex items-center justify-center gap-2 rounded-lg bg-white px-8 py-4 text-base font-semibold text-indigo-600 shadow-lg transition hover:bg-gray-50">
                        Konzultációt kérek
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                        </svg>
                    </a>
                    <a href="{{ route('quote-request') }}" class="inline-flex items-center justify-center gap-2 rounded-lg border-2 border-white/30 px-8 py-4 text-base font-semibold text-white transition hover:bg-white/10">
                        Árajánlatot kérek
                    </a>
                </div>
            </div>
        </div>
    </section>
</div>
