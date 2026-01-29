<div>
    {{-- Hero Section --}}
    <section class="bg-linear-to-b from-gray-900 to-gray-800 py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto max-w-4xl text-center">
                <div
                    class="mb-6 inline-flex items-center gap-2 rounded-full bg-indigo-500/20 px-4 py-1.5 text-sm font-medium text-indigo-300">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                    </svg>
                    Enterprise Megoldások
                </div>

                <h1 class="mb-6 text-4xl font-bold tracking-tight text-white sm:text-5xl lg:text-6xl">
                    Egyedi megoldások, dedikált erőforrások
                    <span class="text-indigo-400">az Ön vállalatára szabva</span>
                </h1>

                <p class="mx-auto mb-8 max-w-3xl text-lg text-gray-300 sm:text-xl">
                    Amikor a standard megoldások már nem elégségesek. A Cegem360 Enterprise programja azoknak a
                    vállalatoknak
                    szól, akik egyedi igényekkel rendelkeznek, dedikált erőforrásokat várnak el, és a legmagasabb szintű
                    támogatásra és biztonságra számítanak.
                </p>

                <div class="flex flex-col justify-center gap-4 sm:flex-row">
                    <a href="{{ route('contact') }}"
                        class="inline-flex items-center justify-center gap-2 rounded-lg bg-indigo-600 px-8 py-4 text-base font-semibold text-white shadow-lg transition hover:bg-indigo-700">
                        Enterprise konzultáció kérése
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 7l5 5m0 0l-5 5m5-5H6" />
                        </svg>
                    </a>
                    <a href="{{ route('quote-request') }}"
                        class="inline-flex items-center justify-center gap-2 rounded-lg border-2 border-gray-600 px-8 py-4 text-base font-semibold text-white transition hover:bg-gray-800">
                        Árajánlatot kérek
                    </a>
                </div>

                <div class="mt-10 flex flex-wrap items-center justify-center gap-x-8 gap-y-4 text-sm text-gray-400">
                    <div class="flex items-center gap-2">
                        <svg class="h-5 w-5 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        99,9% SLA garancia
                    </div>
                    <div class="flex items-center gap-2">
                        <svg class="h-5 w-5 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Dedikált támogatás
                    </div>
                    <div class="flex items-center gap-2">
                        <svg class="h-5 w-5 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Egyedi integrációk
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Why Enterprise Section --}}
    <section class="bg-white py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto max-w-3xl text-center">
                <h2 class="mb-4 text-3xl font-bold text-gray-900 sm:text-4xl">
                    Miért választják a nagyok az Enterprise programot?
                </h2>
                <p class="text-lg text-gray-600">
                    Egy bizonyos vállalati méret felett a standard SaaS megoldások korlátokba ütköznek.
                    Egyedi folyamatok, speciális integrációs igények, szigorú compliance-követelmények.
                </p>
            </div>

            <div class="mt-12 grid gap-8 md:grid-cols-2 lg:grid-cols-4">
                <div class="rounded-xl bg-gray-50 p-6">
                    <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-lg bg-red-100">
                        <svg class="h-6 w-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4" />
                        </svg>
                    </div>
                    <h3 class="mb-2 font-semibold text-gray-900">Széttagolt rendszerek</h3>
                    <p class="text-sm text-gray-600">Különböző részlegek különböző eszközöket használnak, az adatok
                        silókban ragadnak.</p>
                </div>

                <div class="rounded-xl bg-gray-50 p-6">
                    <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-lg bg-red-100">
                        <svg class="h-6 w-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="mb-2 font-semibold text-gray-900">Lassú döntéshozatal</h3>
                    <p class="text-sm text-gray-600">Mire az adat összegyűlik és feldolgozódik, a piaci helyzet
                        megváltozik.</p>
                </div>

                <div class="rounded-xl bg-gray-50 p-6">
                    <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-lg bg-red-100">
                        <svg class="h-6 w-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                    </div>
                    <h3 class="mb-2 font-semibold text-gray-900">Compliance-kockázatok</h3>
                    <p class="text-sm text-gray-600">GDPR, SOC 2, ISO - a megfelelés folyamatos figyelmet igényel.</p>
                </div>

                <div class="rounded-xl bg-gray-50 p-6">
                    <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-lg bg-red-100">
                        <svg class="h-6 w-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                        </svg>
                    </div>
                    <h3 class="mb-2 font-semibold text-gray-900">Skálázhatósági korlátok</h3>
                    <p class="text-sm text-gray-600">A jelenlegi rendszer nem bírja a növekedést, a migráció kockázatos.
                    </p>
                </div>
            </div>

            <div class="mt-12 text-center">
                <p class="text-lg font-semibold text-indigo-600">
                    A Cegem360 Enterprise nem egy csomag - hanem egy partnerség.
                </p>
            </div>
        </div>
    </section>

    {{-- 5 Pillars Section --}}
    <section class="bg-gray-50 py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto max-w-3xl text-center">
                <div
                    class="mb-4 inline-flex items-center gap-2 rounded-full bg-indigo-100 px-4 py-1.5 text-sm font-medium text-indigo-700">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                    </svg>
                    Az Enterprise program 5 pillére
                </div>
                <h2 class="mb-4 text-3xl font-bold text-gray-900 sm:text-4xl">
                    Minden amire szüksége van a sikeres működéshez
                </h2>
            </div>

            <div class="mt-16 space-y-16">
                {{-- Pillar 1: Dedicated Server --}}
                <div class="grid items-center gap-12 lg:grid-cols-2">
                    <div>
                        <div
                            class="mb-4 inline-flex items-center gap-2 rounded-full bg-indigo-600 px-3 py-1 text-sm font-medium text-white">
                            1. Pillér
                        </div>
                        <h3 class="mb-4 text-2xl font-bold text-gray-900">Dedikált szerver környezet</h3>
                        <p class="mb-6 text-gray-600">
                            Az Ön adatai, az Ön szerverén - teljes kontroll és biztonság. A dedikált szerver környezet
                            azt jelenti, hogy az Ön Cegem360 rendszere fizikailag elkülönített infrastruktúrán fut.
                        </p>

                        <div class="grid gap-4 sm:grid-cols-2">
                            <div class="rounded-lg bg-white p-4 shadow-sm">
                                <h4 class="mb-2 font-semibold text-gray-900">Teljesítmény-garancia</h4>
                                <ul class="space-y-1 text-sm text-gray-600">
                                    <li>Garantált CPU, RAM és tárhely</li>
                                    <li>Nincs lassulás más ügyfelek miatt</li>
                                    <li>Skálázható erőforrások</li>
                                </ul>
                            </div>
                            <div class="rounded-lg bg-white p-4 shadow-sm">
                                <h4 class="mb-2 font-semibold text-gray-900">Adatbiztonság</h4>
                                <ul class="space-y-1 text-sm text-gray-600">
                                    <li>Fizikailag elkülönített tárolás</li>
                                    <li>Egyedi titkosítási kulcsok</li>
                                    <li>Választható adatközpont (EU, HU)</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="rounded-2xl bg-white p-8 shadow-lg">
                        <h4 class="mb-6 font-semibold text-gray-900">Deployment opciók</h4>
                        <div class="space-y-4">
                            <div class="flex items-start gap-4 rounded-lg border border-gray-100 p-4">
                                <div
                                    class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-indigo-100">
                                    <svg class="h-5 w-5 text-indigo-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z" />
                                    </svg>
                                </div>
                                <div>
                                    <h5 class="font-medium text-gray-900">Dedikált cloud</h5>
                                    <p class="text-sm text-gray-600">Gyors indulás, minimális IT-teher</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-4 rounded-lg border border-gray-100 p-4">
                                <div
                                    class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-indigo-100">
                                    <svg class="h-5 w-5 text-indigo-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                    </svg>
                                </div>
                                <div>
                                    <h5 class="font-medium text-gray-900">Private cloud</h5>
                                    <p class="text-sm text-gray-600">AWS, Azure, GCP - meglévő befektetés</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-4 rounded-lg border border-gray-100 p-4">
                                <div
                                    class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-indigo-100">
                                    <svg class="h-5 w-5 text-indigo-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 12h14M5 12a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v4a2 2 0 01-2 2M5 12a2 2 0 00-2 2v4a2 2 0 002 2h14a2 2 0 002-2v-4a2 2 0 00-2-2" />
                                    </svg>
                                </div>
                                <div>
                                    <h5 class="font-medium text-gray-900">On-premise</h5>
                                    <p class="text-sm text-gray-600">Maximális kontroll, szigorú compliance</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Pillar 2: Custom Integrations --}}
                <div class="grid items-center gap-12 lg:grid-cols-2">
                    <div class="order-2 lg:order-1">
                        <div class="rounded-2xl bg-white p-8 shadow-lg">
                            <h4 class="mb-6 font-semibold text-gray-900">Tipikus integrációk</h4>
                            <div class="grid gap-3 sm:grid-cols-2">
                                <div class="flex items-center gap-3 rounded-lg bg-gray-50 p-3">
                                    <span class="text-2xl">📊</span>
                                    <div>
                                        <p class="text-sm font-medium text-gray-900">ERP</p>
                                        <p class="text-xs text-gray-500">SAP, Dynamics, Odoo</p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-3 rounded-lg bg-gray-50 p-3">
                                    <span class="text-2xl">👥</span>
                                    <div>
                                        <p class="text-sm font-medium text-gray-900">HR</p>
                                        <p class="text-xs text-gray-500">Workday, BambooHR</p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-3 rounded-lg bg-gray-50 p-3">
                                    <span class="text-2xl">📈</span>
                                    <div>
                                        <p class="text-sm font-medium text-gray-900">BI/Analytics</p>
                                        <p class="text-xs text-gray-500">Power BI, Tableau</p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-3 rounded-lg bg-gray-50 p-3">
                                    <span class="text-2xl">🛒</span>
                                    <div>
                                        <p class="text-sm font-medium text-gray-900">E-commerce</p>
                                        <p class="text-xs text-gray-500">Shopify, Magento</p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-3 rounded-lg bg-gray-50 p-3">
                                    <span class="text-2xl">📧</span>
                                    <div>
                                        <p class="text-sm font-medium text-gray-900">Marketing</p>
                                        <p class="text-xs text-gray-500">HubSpot, Marketo</p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-3 rounded-lg bg-gray-50 p-3">
                                    <span class="text-2xl">💬</span>
                                    <div>
                                        <p class="text-sm font-medium text-gray-900">Kommunikáció</p>
                                        <p class="text-xs text-gray-500">Slack, Teams</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="order-1 lg:order-2">
                        <div
                            class="mb-4 inline-flex items-center gap-2 rounded-full bg-indigo-600 px-3 py-1 text-sm font-medium text-white">
                            2. Pillér
                        </div>
                        <h3 class="mb-4 text-2xl font-bold text-gray-900">Egyedi integrációk fejlesztése</h3>
                        <p class="mb-6 text-gray-600">
                            Kapcsolja össze a Cegem360-at a meglévő rendszereivel - zökkenőmentesen.
                            Minden vállalatnak megvannak a saját rendszerei: ERP, HR, BI, legacy alkalmazások.
                        </p>

                        <div class="space-y-4">
                            <div class="flex items-start gap-3">
                                <div
                                    class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-indigo-100 text-sm font-semibold text-indigo-600">
                                    1</div>
                                <div>
                                    <h5 class="font-medium text-gray-900">Felmérés és tervezés</h5>
                                    <p class="text-sm text-gray-600">Meglévő rendszerek és adatfolyamok feltérképezése
                                    </p>
                                </div>
                            </div>
                            <div class="flex items-start gap-3">
                                <div
                                    class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-indigo-100 text-sm font-semibold text-indigo-600">
                                    2</div>
                                <div>
                                    <h5 class="font-medium text-gray-900">Fejlesztés</h5>
                                    <p class="text-sm text-gray-600">Dedikált fejlesztői csapat, agilis módszertan</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-3">
                                <div
                                    class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-indigo-100 text-sm font-semibold text-indigo-600">
                                    3</div>
                                <div>
                                    <h5 class="font-medium text-gray-900">Tesztelés és élesítés</h5>
                                    <p class="text-sm text-gray-600">Teljes körű tesztelés, staged rollout</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-3">
                                <div
                                    class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-indigo-100 text-sm font-semibold text-indigo-600">
                                    4</div>
                                <div>
                                    <h5 class="font-medium text-gray-900">Karbantartás</h5>
                                    <p class="text-sm text-gray-600">Folyamatos monitoring és továbbfejlesztés</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Pillar 3: SLA --}}
                <div class="grid items-center gap-12 lg:grid-cols-2">
                    <div>
                        <div
                            class="mb-4 inline-flex items-center gap-2 rounded-full bg-indigo-600 px-3 py-1 text-sm font-medium text-white">
                            3. Pillér
                        </div>
                        <h3 class="mb-4 text-2xl font-bold text-gray-900">SLA garancia - 99,9% uptime</h3>
                        <p class="mb-6 text-gray-600">
                            Amikor a rendszer kritikus, a rendelkezésre állás nem opció - követelmény.
                            Az Enterprise SLA szerződésben rögzített garanciát ad a rendszer teljesítményére.
                        </p>

                        <div class="overflow-hidden rounded-xl border border-gray-200 bg-white">
                            <table class="w-full text-sm">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-4 py-3 text-left font-semibold text-gray-900">Szint</th>
                                        <th class="px-4 py-3 text-left font-semibold text-gray-900">Uptime</th>
                                        <th class="px-4 py-3 text-left font-semibold text-gray-900">Max. kiesés/hó</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100">
                                    <tr>
                                        <td class="px-4 py-3 text-gray-600">Standard</td>
                                        <td class="px-4 py-3 text-gray-600">99,5%</td>
                                        <td class="px-4 py-3 text-gray-600">3,6 óra</td>
                                    </tr>
                                    <tr class="bg-indigo-50">
                                        <td class="px-4 py-3 font-medium text-indigo-700">Enterprise</td>
                                        <td class="px-4 py-3 font-medium text-indigo-700">99,9%</td>
                                        <td class="px-4 py-3 font-medium text-indigo-700">43 perc</td>
                                    </tr>
                                    <tr>
                                        <td class="px-4 py-3 text-gray-600">Enterprise+</td>
                                        <td class="px-4 py-3 text-gray-600">99,95%</td>
                                        <td class="px-4 py-3 text-gray-600">22 perc</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="rounded-2xl bg-white p-8 shadow-lg">
                        <h4 class="mb-6 font-semibold text-gray-900">Incident management</h4>
                        <div class="space-y-4">
                            <div
                                class="flex items-center justify-between rounded-lg border-l-4 border-red-500 bg-red-50 p-4">
                                <div>
                                    <p class="font-medium text-gray-900">P1 - Kritikus</p>
                                    <p class="text-sm text-gray-600">Rendszer nem elérhető</p>
                                </div>
                                <div class="text-right">
                                    <p class="font-semibold text-red-600">15 perc</p>
                                    <p class="text-xs text-gray-500">reakcióidő</p>
                                </div>
                            </div>
                            <div
                                class="flex items-center justify-between rounded-lg border-l-4 border-orange-500 bg-orange-50 p-4">
                                <div>
                                    <p class="font-medium text-gray-900">P2 - Magas</p>
                                    <p class="text-sm text-gray-600">Fő funkció nem működik</p>
                                </div>
                                <div class="text-right">
                                    <p class="font-semibold text-orange-600">1 óra</p>
                                    <p class="text-xs text-gray-500">reakcióidő</p>
                                </div>
                            </div>
                            <div
                                class="flex items-center justify-between rounded-lg border-l-4 border-yellow-500 bg-yellow-50 p-4">
                                <div>
                                    <p class="font-medium text-gray-900">P3 - Közepes</p>
                                    <p class="text-sm text-gray-600">Funkció korlátozott</p>
                                </div>
                                <div class="text-right">
                                    <p class="font-semibold text-yellow-600">4 óra</p>
                                    <p class="text-xs text-gray-500">reakcióidő</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Pillar 4: Support --}}
                <div class="grid items-center gap-12 lg:grid-cols-2">
                    <div class="order-2 lg:order-1">
                        <div class="rounded-2xl bg-white p-8 shadow-lg">
                            <h4 class="mb-6 font-semibold text-gray-900">Támogatási csatornák</h4>
                            <div class="space-y-3">
                                <div class="flex items-center gap-4 rounded-lg bg-gray-50 p-4">
                                    <svg class="h-6 w-6 text-indigo-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                    </svg>
                                    <div>
                                        <p class="font-medium text-gray-900">Telefon (hotline)</p>
                                        <p class="text-sm text-gray-600">H-P 8:00-18:00 - sürgős problémák</p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-4 rounded-lg bg-gray-50 p-4">
                                    <svg class="h-6 w-6 text-indigo-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                    </svg>
                                    <div>
                                        <p class="font-medium text-gray-900">Slack/Teams csatorna</p>
                                        <p class="text-sm text-gray-600">10/5 - gyors kérdések, napi kommunikáció</p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-4 rounded-lg bg-gray-50 p-4">
                                    <svg class="h-6 w-6 text-indigo-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                    </svg>
                                    <div>
                                        <p class="font-medium text-gray-900">Képernyőmegosztás</p>
                                        <p class="text-sm text-gray-600">Korlátlan - komplex problémák</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="order-1 lg:order-2">
                        <div
                            class="mb-4 inline-flex items-center gap-2 rounded-full bg-indigo-600 px-3 py-1 text-sm font-medium text-white">
                            4. Pillér
                        </div>
                        <h3 class="mb-4 text-2xl font-bold text-gray-900">Kiemelt támogatás (10/5)</h3>
                        <p class="mb-6 text-gray-600">
                            Dedikált support csapat, aki ismeri az Ön rendszerét és üzletét.
                            Az Enterprise támogatás nem egy anonim helpdesk - hanem dedikált csapat.
                        </p>

                        <ul class="space-y-3">
                            <li class="flex items-start gap-3">
                                <svg class="mt-0.5 h-5 w-5 shrink-0 text-green-500" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                                <span class="text-gray-600">Dedikált support mérnök - nevesített kapcsolattartó</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <svg class="mt-0.5 h-5 w-5 shrink-0 text-green-500" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                                <span class="text-gray-600">Prioritasos kezeles - garantalt reakcióidők</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <svg class="mt-0.5 h-5 w-5 shrink-0 text-green-500" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                                <span class="text-gray-600">Proaktív támogatás - rendszeres health check-ek</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <svg class="mt-0.5 h-5 w-5 shrink-0 text-green-500" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                                <span class="text-gray-600">Tudásátadás - admin és power user tréningek</span>
                            </li>
                        </ul>
                    </div>
                </div>

                {{-- Pillar 5: Account Manager --}}
                <div class="grid items-center gap-12 lg:grid-cols-2">
                    <div>
                        <div
                            class="mb-4 inline-flex items-center gap-2 rounded-full bg-indigo-600 px-3 py-1 text-sm font-medium text-white">
                            5. Pillér
                        </div>
                        <h3 class="mb-4 text-2xl font-bold text-gray-900">Személyes Account Manager</h3>
                        <p class="mb-6 text-gray-600">
                            Egy dedikált kapcsolattartó, aki az Ön sikere érdekében dolgozik.
                            Az Account Manager nem értékesítő - hanem az Ön belső szószólója.
                        </p>

                        <div class="space-y-4">
                            <div class="rounded-lg border border-gray-200 bg-white p-4">
                                <h5 class="mb-2 font-medium text-gray-900">Onboarding és bevezetés</h5>
                                <p class="text-sm text-gray-600">Projekt-terv, stakeholder-kezelés, go-live kritériumok
                                </p>
                            </div>
                            <div class="rounded-lg border border-gray-200 bg-white p-4">
                                <h5 class="mb-2 font-medium text-gray-900">Folyamatos partnerség</h5>
                                <p class="text-sm text-gray-600">Rendszeres check-in hívások, üzleti igények
                                    feltérképezése</p>
                            </div>
                            <div class="rounded-lg border border-gray-200 bg-white p-4">
                                <h5 class="mb-2 font-medium text-gray-900">Üzleti tanácsadás</h5>
                                <p class="text-sm text-gray-600">Best practice-ek, ROI-mérés, üzleti érték
                                    demonstrálása</p>
                            </div>
                        </div>
                    </div>
                    <div class="rounded-2xl bg-indigo-600 p-8 text-white">
                        <h4 class="mb-6 text-xl font-semibold">Negyedéves üzleti áttekintés (QBR)</h4>
                        <p class="mb-6 text-indigo-100">
                            Minden negyedévben személyes találkozó az Account Managerrel:
                        </p>
                        <div class="space-y-4">
                            <div class="flex items-start gap-3">
                                <div
                                    class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-white/20 text-sm font-semibold">
                                    1</div>
                                <div>
                                    <p class="font-medium">Elmúlt negyedév áttekintése</p>
                                    <p class="text-sm text-indigo-200">Használati statisztikák, elért eredmények</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-3">
                                <div
                                    class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-white/20 text-sm font-semibold">
                                    2</div>
                                <div>
                                    <p class="font-medium">Aktuális helyzet</p>
                                    <p class="text-sm text-indigo-200">Felhasználói elégedettség, nyitott kérdések</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-3">
                                <div
                                    class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-white/20 text-sm font-semibold">
                                    3</div>
                                <div>
                                    <p class="font-medium">Következő negyedév</p>
                                    <p class="text-sm text-indigo-200">Üzleti prioritások, tervezett fejlesztések</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-3">
                                <div
                                    class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-white/20 text-sm font-semibold">
                                    4</div>
                                <div>
                                    <p class="font-medium">Hosszú távú stratégia</p>
                                    <p class="text-sm text-indigo-200">Roadmap egyeztetés, partnerség fejlesztése</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Security Section --}}
    <section class="bg-gray-900 py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto max-w-3xl text-center">
                <h2 class="mb-4 text-3xl font-bold text-white sm:text-4xl">
                    Biztonság és compliance
                </h2>
                <p class="text-lg text-gray-400">
                    A legmagasabb szintű adatvédelem és megfelelősség
                </p>
            </div>

            <div class="mt-12 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                <div class="flex items-center gap-4 rounded-xl border border-gray-700 bg-gray-800 p-6">
                    <svg class="h-8 w-8 shrink-0 text-green-400" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                    </svg>
                    <div>
                        <p class="font-medium text-white">SOC 2 Type II</p>
                        <p class="text-sm text-gray-400">Tanúsított infrastruktúra</p>
                    </div>
                </div>

                <div class="flex items-center gap-4 rounded-xl border border-gray-700 bg-gray-800 p-6">
                    <svg class="h-8 w-8 shrink-0 text-green-400" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3" />
                    </svg>
                    <div>
                        <p class="font-medium text-white">GDPR megfelelő</p>
                        <p class="text-sm text-gray-400">Adatvédelem beépítve</p>
                    </div>
                </div>

                <div class="flex items-center gap-4 rounded-xl border border-gray-700 bg-gray-800 p-6">
                    <svg class="h-8 w-8 shrink-0 text-green-400" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                    <div>
                        <p class="font-medium text-white">AES-256 titkosítás</p>
                        <p class="text-sm text-gray-400">Nyugalmi és átviteli</p>
                    </div>
                </div>

                <div class="flex items-center gap-4 rounded-xl border border-gray-700 bg-gray-800 p-6">
                    <svg class="h-8 w-8 shrink-0 text-green-400" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
                    </svg>
                    <div>
                        <p class="font-medium text-white">SSO integráció</p>
                        <p class="text-sm text-gray-400">SAML, OIDC, AD</p>
                    </div>
                </div>

                <div class="flex items-center gap-4 rounded-xl border border-gray-700 bg-gray-800 p-6">
                    <svg class="h-8 w-8 shrink-0 text-green-400" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                    </svg>
                    <div>
                        <p class="font-medium text-white">Teljes audit trail</p>
                        <p class="text-sm text-gray-400">SIEM integracio</p>
                    </div>
                </div>

                <div class="flex items-center gap-4 rounded-xl border border-gray-700 bg-gray-800 p-6">
                    <svg class="h-8 w-8 shrink-0 text-green-400" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    <div>
                        <p class="font-medium text-white">Penetrációs teszt</p>
                        <p class="text-sm text-gray-400">Éves külső audit</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Implementation Process --}}
    <section class="bg-white py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto max-w-3xl text-center">
                <h2 class="mb-4 text-3xl font-bold text-gray-900 sm:text-4xl">
                    Az Enterprise bevezetés menete
                </h2>
                <p class="text-lg text-gray-600">
                    Strukturált megközelítés a sikeres bevezetéshez
                </p>
            </div>

            <div class="mt-12">
                <div class="relative">
                    <div class="absolute left-8 top-0 hidden h-full w-0.5 bg-indigo-200 lg:block"></div>

                    <div class="space-y-8">
                        <div class="relative flex gap-8">
                            <div class="hidden lg:flex lg:flex-col lg:items-center">
                                <div
                                    class="flex h-16 w-16 items-center justify-center rounded-full bg-indigo-600 text-xl font-bold text-white">
                                    1</div>
                            </div>
                            <div class="flex-1 rounded-xl bg-gray-50 p-6">
                                <div class="mb-2 flex items-center gap-3">
                                    <div
                                        class="flex h-10 w-10 items-center justify-center rounded-full bg-indigo-600 text-sm font-bold text-white lg:hidden">
                                        1</div>
                                    <h3 class="text-xl font-semibold text-gray-900">Felmérés és tervezés</h3>
                                    <span
                                        class="rounded-full bg-indigo-100 px-3 py-1 text-sm font-medium text-indigo-700">2-4
                                        hét</span>
                                </div>
                                <p class="text-gray-600">Kickoff meeting, jelenlegi rendszerek feltérképezése,
                                    projekt-terv összeállítása</p>
                            </div>
                        </div>

                        <div class="relative flex gap-8">
                            <div class="hidden lg:flex lg:flex-col lg:items-center">
                                <div
                                    class="flex h-16 w-16 items-center justify-center rounded-full bg-indigo-600 text-xl font-bold text-white">
                                    2</div>
                            </div>
                            <div class="flex-1 rounded-xl bg-gray-50 p-6">
                                <div class="mb-2 flex items-center gap-3">
                                    <div
                                        class="flex h-10 w-10 items-center justify-center rounded-full bg-indigo-600 text-sm font-bold text-white lg:hidden">
                                        2</div>
                                    <h3 class="text-xl font-semibold text-gray-900">Konfiguráció és fejlesztés</h3>
                                    <span
                                        class="rounded-full bg-indigo-100 px-3 py-1 text-sm font-medium text-indigo-700">4-12
                                        hét</span>
                                </div>
                                <p class="text-gray-600">Dedikált környezet felépítése, egyedi integrációk fejlesztése,
                                    adatmigráció</p>
                            </div>
                        </div>

                        <div class="relative flex gap-8">
                            <div class="hidden lg:flex lg:flex-col lg:items-center">
                                <div
                                    class="flex h-16 w-16 items-center justify-center rounded-full bg-indigo-600 text-xl font-bold text-white">
                                    3</div>
                            </div>
                            <div class="flex-1 rounded-xl bg-gray-50 p-6">
                                <div class="mb-2 flex items-center gap-3">
                                    <div
                                        class="flex h-10 w-10 items-center justify-center rounded-full bg-indigo-600 text-sm font-bold text-white lg:hidden">
                                        3</div>
                                    <h3 class="text-xl font-semibold text-gray-900">Bevezetés és képzés</h3>
                                    <span
                                        class="rounded-full bg-indigo-100 px-3 py-1 text-sm font-medium text-indigo-700">2-4
                                        hét</span>
                                </div>
                                <p class="text-gray-600">Admin és power user képzések, staged rollout, go-live
                                    támogatás</p>
                            </div>
                        </div>

                        <div class="relative flex gap-8">
                            <div class="hidden lg:flex lg:flex-col lg:items-center">
                                <div
                                    class="flex h-16 w-16 items-center justify-center rounded-full bg-indigo-600 text-xl font-bold text-white">
                                    4</div>
                            </div>
                            <div class="flex-1 rounded-xl bg-gray-50 p-6">
                                <div class="mb-2 flex items-center gap-3">
                                    <div
                                        class="flex h-10 w-10 items-center justify-center rounded-full bg-indigo-600 text-sm font-bold text-white lg:hidden">
                                        4</div>
                                    <h3 class="text-xl font-semibold text-gray-900">Stabilizáció és optimalizálás</h3>
                                    <span
                                        class="rounded-full bg-indigo-100 px-3 py-1 text-sm font-medium text-indigo-700">4-8
                                        hét</span>
                                </div>
                                <p class="text-gray-600">Hypercare időszak, teljesítmény-monitoring, optimalizálási
                                    javaslatok</p>
                            </div>
                        </div>

                        <div class="relative flex gap-8">
                            <div class="hidden lg:flex lg:flex-col lg:items-center">
                                <div
                                    class="flex h-16 w-16 items-center justify-center rounded-full bg-green-600 text-xl font-bold text-white">
                                    <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7" />
                                    </svg>
                                </div>
                            </div>
                            <div class="flex-1 rounded-xl bg-green-50 p-6">
                                <div class="mb-2 flex items-center gap-3">
                                    <div
                                        class="flex h-10 w-10 items-center justify-center rounded-full bg-green-600 text-white lg:hidden">
                                        <svg class="h-5 w-5" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 13l4 4L19 7" />
                                        </svg>
                                    </div>
                                    <h3 class="text-xl font-semibold text-gray-900">Folyamatos partnerség</h3>
                                </div>
                                <p class="text-gray-600">Rendszeres check-in-ek, negyedéves üzleti áttekintések,
                                    folyamatos fejlesztés</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Who Is It For --}}
    <section class="bg-gray-50 py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto max-w-3xl text-center">
                <h2 class="mb-4 text-3xl font-bold text-gray-900 sm:text-4xl">
                    Kinek ajánljuk az Enterprise programot?
                </h2>
            </div>

            <div class="mt-12 grid gap-8 lg:grid-cols-2">
                <div class="rounded-2xl bg-white p-8 shadow-sm">
                    <h3 class="mb-6 text-xl font-semibold text-gray-900">Ideális, ha...</h3>
                    <ul class="space-y-4">
                        <li class="flex items-start gap-3">
                            <svg class="mt-0.5 h-6 w-6 shrink-0 text-green-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            <span class="text-gray-600"><strong class="text-gray-900">100+ felhasználója</strong> lesz
                                a rendszernek</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <svg class="mt-0.5 h-6 w-6 shrink-0 text-green-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            <span class="text-gray-600"><strong class="text-gray-900">Egyedi integrációkra</strong>
                                van szüksége meglévő rendszerekkel</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <svg class="mt-0.5 h-6 w-6 shrink-0 text-green-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            <span class="text-gray-600"><strong class="text-gray-900">Szigorú
                                    compliance-követelmények</strong>nek kell megfelelnie</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <svg class="mt-0.5 h-6 w-6 shrink-0 text-green-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            <span class="text-gray-600"><strong class="text-gray-900">Dedikált erőforrásokat</strong>
                                és személyes támogatást vár el</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <svg class="mt-0.5 h-6 w-6 shrink-0 text-green-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            <span class="text-gray-600"><strong class="text-gray-900">Hosszú távú partnerre</strong>
                                van szüksége, nem csak szoftverre</span>
                        </li>
                    </ul>
                </div>

                <div class="rounded-2xl bg-white p-8 shadow-sm">
                    <h3 class="mb-6 text-xl font-semibold text-gray-900">Tipikus Enterprise ügyfelek</h3>
                    <div class="space-y-4">
                        <div class="flex items-center gap-4 rounded-lg bg-gray-50 p-4">
                            <span class="text-2xl">🏭</span>
                            <div>
                                <p class="font-medium text-gray-900">Gyártás</p>
                                <p class="text-sm text-gray-600">MES integráció, több telephely, OEE monitoring</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-4 rounded-lg bg-gray-50 p-4">
                            <span class="text-2xl">🏪</span>
                            <div>
                                <p class="font-medium text-gray-900">Kereskedelem</p>
                                <p class="text-sm text-gray-600">ERP-kapcsolat, webshop-integráció, multi-currency</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-4 rounded-lg bg-gray-50 p-4">
                            <span class="text-2xl">🏦</span>
                            <div>
                                <p class="font-medium text-gray-900">Pénzügy</p>
                                <p class="text-sm text-gray-600">Szigorú compliance, audit trail, titkosítás</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-4 rounded-lg bg-gray-50 p-4">
                            <span class="text-2xl">🚚</span>
                            <div>
                                <p class="font-medium text-gray-900">Logisztika</p>
                                <p class="text-sm text-gray-600">EDI, több raktár, fuvarozó-integrációk</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Testimonials --}}
    <section class="bg-white py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto max-w-3xl text-center">
                <h2 class="mb-4 text-3xl font-bold text-gray-900 sm:text-4xl">
                    Referenciák
                </h2>
            </div>

            <div class="mt-12 grid gap-8 lg:grid-cols-3">
                <div class="rounded-2xl bg-gray-50 p-8">
                    <div class="mb-6 flex items-center gap-1">
                        @for ($i = 0; $i < 5; $i++)
                            <svg class="h-5 w-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg>
                        @endfor
                    </div>
                    <blockquote class="mb-6 text-gray-700">
                        "A Cegem360 nem csak szoftvert adott, hanem partnert. Az Account Managerünk jobban ismeri a
                        folyamatainkat, mint néhány belső kollégánk."
                    </blockquote>
                    <div class="flex items-center gap-4">
                        <div
                            class="flex h-12 w-12 items-center justify-center rounded-full bg-indigo-200 font-semibold text-indigo-700">
                            HL</div>
                        <div>
                            <div class="font-semibold text-gray-900">Horváth László</div>
                            <div class="text-sm text-gray-600">IT igazgató, Nagyvállalati gyártó</div>
                        </div>
                    </div>
                </div>

                <div class="rounded-2xl bg-gray-50 p-8">
                    <div class="mb-6 flex items-center gap-1">
                        @for ($i = 0; $i < 5; $i++)
                            <svg class="h-5 w-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg>
                        @endfor
                    </div>
                    <blockquote class="mb-6 text-gray-700">
                        "A dedikált környezet és az SLA-garancia volt a döntő. Kritikus rendszerünkkel nem engedhetjük
                        meg a kiesést."
                    </blockquote>
                    <div class="flex items-center gap-4">
                        <div
                            class="flex h-12 w-12 items-center justify-center rounded-full bg-indigo-200 font-semibold text-indigo-700">
                            SM</div>
                        <div>
                            <div class="font-semibold text-gray-900">Dr. Szabó Mária</div>
                            <div class="text-sm text-gray-600">CFO, Pénzügyi szolgáltató</div>
                        </div>
                    </div>
                </div>

                <div class="rounded-2xl bg-gray-50 p-8">
                    <div class="mb-6 flex items-center gap-1">
                        @for ($i = 0; $i < 5; $i++)
                            <svg class="h-5 w-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg>
                        @endfor
                    </div>
                    <blockquote class="mb-6 text-gray-700">
                        "Az egyedi SAP-integráció 3 hónap alatt készült el, és azóta hibátlanul működik. A support
                        csapat reakcióideje példaértékű."
                    </blockquote>
                    <div class="flex items-center gap-4">
                        <div
                            class="flex h-12 w-12 items-center justify-center rounded-full bg-indigo-200 font-semibold text-indigo-700">
                            KA</div>
                        <div>
                            <div class="font-semibold text-gray-900">Kovács András</div>
                            <div class="text-sm text-gray-600">Operations Director, Logisztikai cég</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- FAQ Section --}}
    <section class="bg-gray-50 py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto max-w-3xl text-center">
                <h2 class="mb-4 text-3xl font-bold text-gray-900 sm:text-4xl">
                    Gyakran ismételt kérdések
                </h2>
            </div>

            <div class="mx-auto mt-12 max-w-3xl space-y-4">
                <div x-data="{ open: false }" class="rounded-xl bg-white shadow-sm">
                    <button @click="open = !open" class="flex w-full items-center justify-between p-6 text-left">
                        <span class="font-semibold text-gray-900">Mennyi idő a bevezetés?</span>
                        <svg class="h-5 w-5 text-gray-500 transition-transform" :class="{ 'rotate-180': open }"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="open" x-collapse class="px-6 pb-6">
                        <p class="text-gray-600">Tipikusan 3-6 hónap, az egyedi igények komplexitásától függően.
                            Egyszerűbb projektek akár 8 hét alatt is indulhatnak.</p>
                    </div>
                </div>

                <div x-data="{ open: false }" class="rounded-xl bg-white shadow-sm">
                    <button @click="open = !open" class="flex w-full items-center justify-between p-6 text-left">
                        <span class="font-semibold text-gray-900">Milyen rendszerekkel tudnak integrálni?</span>
                        <svg class="h-5 w-5 text-gray-500 transition-transform" :class="{ 'rotate-180': open }"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="open" x-collapse class="px-6 pb-6">
                        <p class="text-gray-600">Szinte bármivel, aminek van API-ja vagy adatexport lehetősége. A
                            legnépszerűbbek: SAP, Microsoft Dynamics, Salesforce, HubSpot, Shopify, valamint számos
                            magyar rendszer (Billingo, Számlázz.hu, Nexon).</p>
                    </div>
                </div>

                <div x-data="{ open: false }" class="rounded-xl bg-white shadow-sm">
                    <button @click="open = !open" class="flex w-full items-center justify-between p-6 text-left">
                        <span class="font-semibold text-gray-900">Mi történik, ha a szerződés lejár?</span>
                        <svg class="h-5 w-5 text-gray-500 transition-transform" :class="{ 'rotate-180': open }"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="open" x-collapse class="px-6 pb-6">
                        <p class="text-gray-600">Az Ön adatai az Önéi. Szerződés végén teljes adatexportot biztosítunk
                            szabványos formátumban (CSV, JSON, XML). Nincs vendor lock-in.</p>
                    </div>
                </div>

                <div x-data="{ open: false }" class="rounded-xl bg-white shadow-sm">
                    <button @click="open = !open" class="flex w-full items-center justify-between p-6 text-left">
                        <span class="font-semibold text-gray-900">Van próbaidőszak?</span>
                        <svg class="h-5 w-5 text-gray-500 transition-transform" :class="{ 'rotate-180': open }"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="open" x-collapse class="px-6 pb-6">
                        <p class="text-gray-600">Enterprise projekteknek Proof of Concept (PoC) időszakot tudunk
                            biztosítani, amelynek során egy korlátozott scope-on tesztelheti a rendszert.</p>
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
                    Következő lépések
                </h2>
                <p class="mb-10 text-lg text-indigo-100">
                    Egyeztessünk egy 30 perces hívást, ahol megértjük az Ön igényeit és kihívásait.
                    Szakértőink feltérképezik a jelenlegi rendszereket és személyre szabott ajánlatot készítünk.
                </p>
                <div class="flex flex-col justify-center gap-4 sm:flex-row">
                    <a href="{{ route('contact') }}"
                        class="inline-flex items-center justify-center gap-2 rounded-lg bg-white px-8 py-4 text-base font-semibold text-indigo-600 shadow-lg transition hover:bg-gray-50">
                        Enterprise konzultáció kérése
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 7l5 5m0 0l-5 5m5-5H6" />
                        </svg>
                    </a>
                    <a href="{{ route('quote-request') }}"
                        class="inline-flex items-center justify-center gap-2 rounded-lg border-2 border-white/30 px-8 py-4 text-base font-semibold text-white transition hover:bg-white/10">
                        Árajánlatot kérek
                    </a>
                </div>
            </div>
        </div>
    </section>
</div>
