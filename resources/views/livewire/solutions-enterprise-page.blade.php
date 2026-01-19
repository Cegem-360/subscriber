<div>
    {{-- Hero Section --}}
    <section class="bg-linear-to-b from-gray-900 to-gray-800 py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto max-w-4xl text-center">
                <div class="mb-6 inline-flex items-center gap-2 rounded-full bg-indigo-500/20 px-4 py-1.5 text-sm font-medium text-indigo-300">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                    </svg>
                    Enterprise Megoldasok
                </div>

                <h1 class="mb-6 text-4xl font-bold tracking-tight text-white sm:text-5xl lg:text-6xl">
                    Egyedi megoldasok, dedikalt eroforrasok
                    <span class="text-indigo-400">az On vallalatara szabva</span>
                </h1>

                <p class="mx-auto mb-8 max-w-3xl text-lg text-gray-300 sm:text-xl">
                    Amikor a standard megoldasok mar nem elegsegek. A Cegem360 Enterprise programja azoknak a vallalatoknak
                    szol, akik egyedi igenyekkel rendelkeznek, dedikalt eroforrasokat varnak el, es a legmagasabb szintu
                    tamogatasra es biztonsagra szamitanak.
                </p>

                <div class="flex flex-col justify-center gap-4 sm:flex-row">
                    <a href="{{ route('quote-request') }}" class="inline-flex items-center justify-center gap-2 rounded-lg bg-indigo-600 px-8 py-4 text-base font-semibold text-white shadow-lg transition hover:bg-indigo-700">
                        Enterprise konzultacio kerese
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                        </svg>
                    </a>
                    <a href="{{ route('quote-request') }}" class="inline-flex items-center justify-center gap-2 rounded-lg border-2 border-gray-600 px-8 py-4 text-base font-semibold text-white transition hover:bg-gray-800">
                        Arajanlatot kerek
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
                        Dedikalt tamogatas
                    </div>
                    <div class="flex items-center gap-2">
                        <svg class="h-5 w-5 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Egyedi integraciok
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
                    Miert valasztjak a nagyok az Enterprise programot?
                </h2>
                <p class="text-lg text-gray-600">
                    Egy bizonyos vallalati meret felett a standard SaaS megoldasok korlatokba utkoznek.
                    Egyedi folyamatok, specialis integracios igenyek, szigoru compliance-kovetelmenyek.
                </p>
            </div>

            <div class="mt-12 grid gap-8 md:grid-cols-2 lg:grid-cols-4">
                <div class="rounded-xl bg-gray-50 p-6">
                    <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-lg bg-red-100">
                        <svg class="h-6 w-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4" />
                        </svg>
                    </div>
                    <h3 class="mb-2 font-semibold text-gray-900">Szettagolt rendszerek</h3>
                    <p class="text-sm text-gray-600">Kulonbozo reszlegek kulonbozo eszkozoket hasznalnak, az adatok silokban ragadnak.</p>
                </div>

                <div class="rounded-xl bg-gray-50 p-6">
                    <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-lg bg-red-100">
                        <svg class="h-6 w-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="mb-2 font-semibold text-gray-900">Lassu donteshozatal</h3>
                    <p class="text-sm text-gray-600">Mire az adat osszegyulik es feldolgozodik, a piaci helyzet megvaltozik.</p>
                </div>

                <div class="rounded-xl bg-gray-50 p-6">
                    <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-lg bg-red-100">
                        <svg class="h-6 w-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                    </div>
                    <h3 class="mb-2 font-semibold text-gray-900">Compliance-kockazatok</h3>
                    <p class="text-sm text-gray-600">GDPR, SOC 2, ISO - a megfeleles folyamatos figyelmet igenyel.</p>
                </div>

                <div class="rounded-xl bg-gray-50 p-6">
                    <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-lg bg-red-100">
                        <svg class="h-6 w-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                        </svg>
                    </div>
                    <h3 class="mb-2 font-semibold text-gray-900">Skalazhattosagi korlatok</h3>
                    <p class="text-sm text-gray-600">A jelenlegi rendszer nem birja a novekedes, a migracio kockazatos.</p>
                </div>
            </div>

            <div class="mt-12 text-center">
                <p class="text-lg font-semibold text-indigo-600">
                    A Cegem360 Enterprise nem egy csomag - hanem egy partnerseg.
                </p>
            </div>
        </div>
    </section>

    {{-- 5 Pillars Section --}}
    <section class="bg-gray-50 py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto max-w-3xl text-center">
                <div class="mb-4 inline-flex items-center gap-2 rounded-full bg-indigo-100 px-4 py-1.5 text-sm font-medium text-indigo-700">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                    </svg>
                    Az Enterprise program 5 pillere
                </div>
                <h2 class="mb-4 text-3xl font-bold text-gray-900 sm:text-4xl">
                    Minden amire szuksege van a sikeres mukodoshoz
                </h2>
            </div>

            <div class="mt-16 space-y-16">
                {{-- Pillar 1: Dedicated Server --}}
                <div class="grid items-center gap-12 lg:grid-cols-2">
                    <div>
                        <div class="mb-4 inline-flex items-center gap-2 rounded-full bg-indigo-600 px-3 py-1 text-sm font-medium text-white">
                            1. Piller
                        </div>
                        <h3 class="mb-4 text-2xl font-bold text-gray-900">Dedikalt szerver kornyezet</h3>
                        <p class="mb-6 text-gray-600">
                            Az On adatai, az On szerveren - teljes kontroll es biztonsag. A dedikalt szerver kornyezet
                            azt jelenti, hogy az On Cegem360 rendszere fizikailag elkulonitett infrastrukturan fut.
                        </p>

                        <div class="grid gap-4 sm:grid-cols-2">
                            <div class="rounded-lg bg-white p-4 shadow-sm">
                                <h4 class="mb-2 font-semibold text-gray-900">Teljesitmeny-garancia</h4>
                                <ul class="space-y-1 text-sm text-gray-600">
                                    <li>Garantalt CPU, RAM es tarhely</li>
                                    <li>Nincs lassulas mas ugyfelek miatt</li>
                                    <li>Skalazhato eroforrasok</li>
                                </ul>
                            </div>
                            <div class="rounded-lg bg-white p-4 shadow-sm">
                                <h4 class="mb-2 font-semibold text-gray-900">Adatbiztonsag</h4>
                                <ul class="space-y-1 text-sm text-gray-600">
                                    <li>Fizikailag elkulonitett tarolás</li>
                                    <li>Egyedi titkositasi kulcsok</li>
                                    <li>Valaszthato adatkozpont (EU, HU)</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="rounded-2xl bg-white p-8 shadow-lg">
                        <h4 class="mb-6 font-semibold text-gray-900">Deployment opciok</h4>
                        <div class="space-y-4">
                            <div class="flex items-start gap-4 rounded-lg border border-gray-100 p-4">
                                <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-indigo-100">
                                    <svg class="h-5 w-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z" />
                                    </svg>
                                </div>
                                <div>
                                    <h5 class="font-medium text-gray-900">Dedikalt cloud</h5>
                                    <p class="text-sm text-gray-600">Gyors indulas, minimalis IT-teher</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-4 rounded-lg border border-gray-100 p-4">
                                <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-indigo-100">
                                    <svg class="h-5 w-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                    </svg>
                                </div>
                                <div>
                                    <h5 class="font-medium text-gray-900">Private cloud</h5>
                                    <p class="text-sm text-gray-600">AWS, Azure, GCP - meglevo befektetes</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-4 rounded-lg border border-gray-100 p-4">
                                <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-indigo-100">
                                    <svg class="h-5 w-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M5 12a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v4a2 2 0 01-2 2M5 12a2 2 0 00-2 2v4a2 2 0 002 2h14a2 2 0 002-2v-4a2 2 0 00-2-2" />
                                    </svg>
                                </div>
                                <div>
                                    <h5 class="font-medium text-gray-900">On-premise</h5>
                                    <p class="text-sm text-gray-600">Maximalis kontroll, szigoru compliance</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Pillar 2: Custom Integrations --}}
                <div class="grid items-center gap-12 lg:grid-cols-2">
                    <div class="order-2 lg:order-1">
                        <div class="rounded-2xl bg-white p-8 shadow-lg">
                            <h4 class="mb-6 font-semibold text-gray-900">Tipikus integraciok</h4>
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
                                        <p class="text-sm font-medium text-gray-900">Kommunikacio</p>
                                        <p class="text-xs text-gray-500">Slack, Teams</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="order-1 lg:order-2">
                        <div class="mb-4 inline-flex items-center gap-2 rounded-full bg-indigo-600 px-3 py-1 text-sm font-medium text-white">
                            2. Piller
                        </div>
                        <h3 class="mb-4 text-2xl font-bold text-gray-900">Egyedi integraciok fejlesztese</h3>
                        <p class="mb-6 text-gray-600">
                            Kapcsolja ossze a Cegem360-at a meglevo rendszereivel - zokkenomentesen.
                            Minden vallalatnak megvannak a sajat rendszerei: ERP, HR, BI, legacy alkalmazasok.
                        </p>

                        <div class="space-y-4">
                            <div class="flex items-start gap-3">
                                <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-indigo-100 text-sm font-semibold text-indigo-600">1</div>
                                <div>
                                    <h5 class="font-medium text-gray-900">Felmeres es tervezes</h5>
                                    <p class="text-sm text-gray-600">Meglevo rendszerek es adatfolyamok felterkepezese</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-3">
                                <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-indigo-100 text-sm font-semibold text-indigo-600">2</div>
                                <div>
                                    <h5 class="font-medium text-gray-900">Fejlesztes</h5>
                                    <p class="text-sm text-gray-600">Dedikalt fejlesztoi csapat, agilis modszertan</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-3">
                                <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-indigo-100 text-sm font-semibold text-indigo-600">3</div>
                                <div>
                                    <h5 class="font-medium text-gray-900">Teszteles es elesites</h5>
                                    <p class="text-sm text-gray-600">Teljes koru teszteles, staged rollout</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-3">
                                <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-indigo-100 text-sm font-semibold text-indigo-600">4</div>
                                <div>
                                    <h5 class="font-medium text-gray-900">Karbantartas</h5>
                                    <p class="text-sm text-gray-600">Folyamatos monitoring es tovabbfejlesztes</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Pillar 3: SLA --}}
                <div class="grid items-center gap-12 lg:grid-cols-2">
                    <div>
                        <div class="mb-4 inline-flex items-center gap-2 rounded-full bg-indigo-600 px-3 py-1 text-sm font-medium text-white">
                            3. Piller
                        </div>
                        <h3 class="mb-4 text-2xl font-bold text-gray-900">SLA garancia - 99,9% uptime</h3>
                        <p class="mb-6 text-gray-600">
                            Amikor a rendszer kritikus, a rendelkezesre allas nem opcio - kovetelmevy.
                            Az Enterprise SLA szerzodesben rogzitett garanciat ad a rendszer teljesitmenyere.
                        </p>

                        <div class="overflow-hidden rounded-xl border border-gray-200 bg-white">
                            <table class="w-full text-sm">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-4 py-3 text-left font-semibold text-gray-900">Szint</th>
                                        <th class="px-4 py-3 text-left font-semibold text-gray-900">Uptime</th>
                                        <th class="px-4 py-3 text-left font-semibold text-gray-900">Max. kieses/ho</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100">
                                    <tr>
                                        <td class="px-4 py-3 text-gray-600">Standard</td>
                                        <td class="px-4 py-3 text-gray-600">99,5%</td>
                                        <td class="px-4 py-3 text-gray-600">3,6 ora</td>
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
                            <div class="flex items-center justify-between rounded-lg border-l-4 border-red-500 bg-red-50 p-4">
                                <div>
                                    <p class="font-medium text-gray-900">P1 - Kritikus</p>
                                    <p class="text-sm text-gray-600">Rendszer nem elerheto</p>
                                </div>
                                <div class="text-right">
                                    <p class="font-semibold text-red-600">15 perc</p>
                                    <p class="text-xs text-gray-500">reakcioido</p>
                                </div>
                            </div>
                            <div class="flex items-center justify-between rounded-lg border-l-4 border-orange-500 bg-orange-50 p-4">
                                <div>
                                    <p class="font-medium text-gray-900">P2 - Magas</p>
                                    <p class="text-sm text-gray-600">Fo funkcio nem mukodik</p>
                                </div>
                                <div class="text-right">
                                    <p class="font-semibold text-orange-600">1 ora</p>
                                    <p class="text-xs text-gray-500">reakcioido</p>
                                </div>
                            </div>
                            <div class="flex items-center justify-between rounded-lg border-l-4 border-yellow-500 bg-yellow-50 p-4">
                                <div>
                                    <p class="font-medium text-gray-900">P3 - Kozepes</p>
                                    <p class="text-sm text-gray-600">Funkcio korlatozott</p>
                                </div>
                                <div class="text-right">
                                    <p class="font-semibold text-yellow-600">4 ora</p>
                                    <p class="text-xs text-gray-500">reakcioido</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Pillar 4: Support --}}
                <div class="grid items-center gap-12 lg:grid-cols-2">
                    <div class="order-2 lg:order-1">
                        <div class="rounded-2xl bg-white p-8 shadow-lg">
                            <h4 class="mb-6 font-semibold text-gray-900">Tamogatasi csatornak</h4>
                            <div class="space-y-3">
                                <div class="flex items-center gap-4 rounded-lg bg-gray-50 p-4">
                                    <svg class="h-6 w-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                    </svg>
                                    <div>
                                        <p class="font-medium text-gray-900">Telefon (hotline)</p>
                                        <p class="text-sm text-gray-600">H-P 8:00-18:00 - surgos problemak</p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-4 rounded-lg bg-gray-50 p-4">
                                    <svg class="h-6 w-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                    </svg>
                                    <div>
                                        <p class="font-medium text-gray-900">Slack/Teams csatorna</p>
                                        <p class="text-sm text-gray-600">10/5 - gyors kerdesek, napi kommunikacio</p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-4 rounded-lg bg-gray-50 p-4">
                                    <svg class="h-6 w-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                    </svg>
                                    <div>
                                        <p class="font-medium text-gray-900">Kepernyomegosztas</p>
                                        <p class="text-sm text-gray-600">Korlatlan - komplex problemak</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="order-1 lg:order-2">
                        <div class="mb-4 inline-flex items-center gap-2 rounded-full bg-indigo-600 px-3 py-1 text-sm font-medium text-white">
                            4. Piller
                        </div>
                        <h3 class="mb-4 text-2xl font-bold text-gray-900">Kiemelt tamogatas (10/5)</h3>
                        <p class="mb-6 text-gray-600">
                            Dedikalt support csapat, aki ismeri az On rendszeret es uzletet.
                            Az Enterprise tamogatas nem egy anonim helpdesk - hanem dedikalt csapat.
                        </p>

                        <ul class="space-y-3">
                            <li class="flex items-start gap-3">
                                <svg class="mt-0.5 h-5 w-5 shrink-0 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                <span class="text-gray-600">Dedikalt support mernok - nevesitett kapcsolattarto</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <svg class="mt-0.5 h-5 w-5 shrink-0 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                <span class="text-gray-600">Prioritasos kezeles - garantalt reakcioidok</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <svg class="mt-0.5 h-5 w-5 shrink-0 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                <span class="text-gray-600">Proaktiv tamogatas - rendszeres health check-ek</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <svg class="mt-0.5 h-5 w-5 shrink-0 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                <span class="text-gray-600">Tudasatadas - admin es power user treningek</span>
                            </li>
                        </ul>
                    </div>
                </div>

                {{-- Pillar 5: Account Manager --}}
                <div class="grid items-center gap-12 lg:grid-cols-2">
                    <div>
                        <div class="mb-4 inline-flex items-center gap-2 rounded-full bg-indigo-600 px-3 py-1 text-sm font-medium text-white">
                            5. Piller
                        </div>
                        <h3 class="mb-4 text-2xl font-bold text-gray-900">Szemelyes Account Manager</h3>
                        <p class="mb-6 text-gray-600">
                            Egy dedikalt kapcsolattarto, aki az On sikere erdekeben dolgozik.
                            Az Account Manager nem ertekesito - hanem az On belso szoszoloja.
                        </p>

                        <div class="space-y-4">
                            <div class="rounded-lg border border-gray-200 bg-white p-4">
                                <h5 class="mb-2 font-medium text-gray-900">Onboarding es bevezetes</h5>
                                <p class="text-sm text-gray-600">Projekt-terv, stakeholder-kezeles, go-live kriteriumok</p>
                            </div>
                            <div class="rounded-lg border border-gray-200 bg-white p-4">
                                <h5 class="mb-2 font-medium text-gray-900">Folyamatos partnerseg</h5>
                                <p class="text-sm text-gray-600">Rendszeres check-in hivasok, uzleti igenyek felterkepezese</p>
                            </div>
                            <div class="rounded-lg border border-gray-200 bg-white p-4">
                                <h5 class="mb-2 font-medium text-gray-900">Uzleti tanacsadas</h5>
                                <p class="text-sm text-gray-600">Best practice-ek, ROI-meres, uzleti ertek demonstralasa</p>
                            </div>
                        </div>
                    </div>
                    <div class="rounded-2xl bg-indigo-600 p-8 text-white">
                        <h4 class="mb-6 text-xl font-semibold">Negyedeves uzleti attekintes (QBR)</h4>
                        <p class="mb-6 text-indigo-100">
                            Minden negyedevben szemelyes talalkozo az Account Managerrel:
                        </p>
                        <div class="space-y-4">
                            <div class="flex items-start gap-3">
                                <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-white/20 text-sm font-semibold">1</div>
                                <div>
                                    <p class="font-medium">Elmult negyedev attekintese</p>
                                    <p class="text-sm text-indigo-200">Hasznalati statisztikak, elert eredmenyek</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-3">
                                <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-white/20 text-sm font-semibold">2</div>
                                <div>
                                    <p class="font-medium">Aktualis helyzet</p>
                                    <p class="text-sm text-indigo-200">Felhasznaloi elegedettseg, nyitott kerdesek</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-3">
                                <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-white/20 text-sm font-semibold">3</div>
                                <div>
                                    <p class="font-medium">Kovetkezo negyedev</p>
                                    <p class="text-sm text-indigo-200">Uzleti prioritasok, tervezett fejlesztesek</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-3">
                                <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-white/20 text-sm font-semibold">4</div>
                                <div>
                                    <p class="font-medium">Hosszu tavu strategia</p>
                                    <p class="text-sm text-indigo-200">Roadmap egyeztetes, partnerseg fejlesztese</p>
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
                    Biztonsag es compliance
                </h2>
                <p class="text-lg text-gray-400">
                    A legmagasabb szintu adatvedelem es megfelelosseg
                </p>
            </div>

            <div class="mt-12 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                <div class="flex items-center gap-4 rounded-xl border border-gray-700 bg-gray-800 p-6">
                    <svg class="h-8 w-8 shrink-0 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                    </svg>
                    <div>
                        <p class="font-medium text-white">SOC 2 Type II</p>
                        <p class="text-sm text-gray-400">Tanusitott infrastruktura</p>
                    </div>
                </div>

                <div class="flex items-center gap-4 rounded-xl border border-gray-700 bg-gray-800 p-6">
                    <svg class="h-8 w-8 shrink-0 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3" />
                    </svg>
                    <div>
                        <p class="font-medium text-white">GDPR megfelelo</p>
                        <p class="text-sm text-gray-400">Adatvedelem beepitve</p>
                    </div>
                </div>

                <div class="flex items-center gap-4 rounded-xl border border-gray-700 bg-gray-800 p-6">
                    <svg class="h-8 w-8 shrink-0 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                    <div>
                        <p class="font-medium text-white">AES-256 titkositas</p>
                        <p class="text-sm text-gray-400">Nyugalmi es atviteli</p>
                    </div>
                </div>

                <div class="flex items-center gap-4 rounded-xl border border-gray-700 bg-gray-800 p-6">
                    <svg class="h-8 w-8 shrink-0 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
                    </svg>
                    <div>
                        <p class="font-medium text-white">SSO integracio</p>
                        <p class="text-sm text-gray-400">SAML, OIDC, AD</p>
                    </div>
                </div>

                <div class="flex items-center gap-4 rounded-xl border border-gray-700 bg-gray-800 p-6">
                    <svg class="h-8 w-8 shrink-0 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                    </svg>
                    <div>
                        <p class="font-medium text-white">Teljes audit trail</p>
                        <p class="text-sm text-gray-400">SIEM integracio</p>
                    </div>
                </div>

                <div class="flex items-center gap-4 rounded-xl border border-gray-700 bg-gray-800 p-6">
                    <svg class="h-8 w-8 shrink-0 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    <div>
                        <p class="font-medium text-white">Penetracios teszt</p>
                        <p class="text-sm text-gray-400">Eves kulso audit</p>
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
                    Az Enterprise bevezetes menete
                </h2>
                <p class="text-lg text-gray-600">
                    Strukturalt megkozelites a sikeres bevezeteshez
                </p>
            </div>

            <div class="mt-12">
                <div class="relative">
                    <div class="absolute left-8 top-0 hidden h-full w-0.5 bg-indigo-200 lg:block"></div>

                    <div class="space-y-8">
                        <div class="relative flex gap-8">
                            <div class="hidden lg:flex lg:flex-col lg:items-center">
                                <div class="flex h-16 w-16 items-center justify-center rounded-full bg-indigo-600 text-xl font-bold text-white">1</div>
                            </div>
                            <div class="flex-1 rounded-xl bg-gray-50 p-6">
                                <div class="mb-2 flex items-center gap-3">
                                    <div class="flex h-10 w-10 items-center justify-center rounded-full bg-indigo-600 text-sm font-bold text-white lg:hidden">1</div>
                                    <h3 class="text-xl font-semibold text-gray-900">Felmeres es tervezes</h3>
                                    <span class="rounded-full bg-indigo-100 px-3 py-1 text-sm font-medium text-indigo-700">2-4 het</span>
                                </div>
                                <p class="text-gray-600">Kickoff meeting, jelenlegi rendszerek felterkepezese, projekt-terv osszeallitasa</p>
                            </div>
                        </div>

                        <div class="relative flex gap-8">
                            <div class="hidden lg:flex lg:flex-col lg:items-center">
                                <div class="flex h-16 w-16 items-center justify-center rounded-full bg-indigo-600 text-xl font-bold text-white">2</div>
                            </div>
                            <div class="flex-1 rounded-xl bg-gray-50 p-6">
                                <div class="mb-2 flex items-center gap-3">
                                    <div class="flex h-10 w-10 items-center justify-center rounded-full bg-indigo-600 text-sm font-bold text-white lg:hidden">2</div>
                                    <h3 class="text-xl font-semibold text-gray-900">Konfiguracio es fejlesztes</h3>
                                    <span class="rounded-full bg-indigo-100 px-3 py-1 text-sm font-medium text-indigo-700">4-12 het</span>
                                </div>
                                <p class="text-gray-600">Dedikalt kornyezet felepitese, egyedi integraciok fejlesztese, adatmigracio</p>
                            </div>
                        </div>

                        <div class="relative flex gap-8">
                            <div class="hidden lg:flex lg:flex-col lg:items-center">
                                <div class="flex h-16 w-16 items-center justify-center rounded-full bg-indigo-600 text-xl font-bold text-white">3</div>
                            </div>
                            <div class="flex-1 rounded-xl bg-gray-50 p-6">
                                <div class="mb-2 flex items-center gap-3">
                                    <div class="flex h-10 w-10 items-center justify-center rounded-full bg-indigo-600 text-sm font-bold text-white lg:hidden">3</div>
                                    <h3 class="text-xl font-semibold text-gray-900">Bevezetes es kepzes</h3>
                                    <span class="rounded-full bg-indigo-100 px-3 py-1 text-sm font-medium text-indigo-700">2-4 het</span>
                                </div>
                                <p class="text-gray-600">Admin es power user kepzesek, staged rollout, go-live tamogatas</p>
                            </div>
                        </div>

                        <div class="relative flex gap-8">
                            <div class="hidden lg:flex lg:flex-col lg:items-center">
                                <div class="flex h-16 w-16 items-center justify-center rounded-full bg-indigo-600 text-xl font-bold text-white">4</div>
                            </div>
                            <div class="flex-1 rounded-xl bg-gray-50 p-6">
                                <div class="mb-2 flex items-center gap-3">
                                    <div class="flex h-10 w-10 items-center justify-center rounded-full bg-indigo-600 text-sm font-bold text-white lg:hidden">4</div>
                                    <h3 class="text-xl font-semibold text-gray-900">Stabilizacio es optimalizalas</h3>
                                    <span class="rounded-full bg-indigo-100 px-3 py-1 text-sm font-medium text-indigo-700">4-8 het</span>
                                </div>
                                <p class="text-gray-600">Hypercare idoszak, teljesitmeny-monitoring, optimalizalasi javaslatok</p>
                            </div>
                        </div>

                        <div class="relative flex gap-8">
                            <div class="hidden lg:flex lg:flex-col lg:items-center">
                                <div class="flex h-16 w-16 items-center justify-center rounded-full bg-green-600 text-xl font-bold text-white">
                                    <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                </div>
                            </div>
                            <div class="flex-1 rounded-xl bg-green-50 p-6">
                                <div class="mb-2 flex items-center gap-3">
                                    <div class="flex h-10 w-10 items-center justify-center rounded-full bg-green-600 text-white lg:hidden">
                                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                        </svg>
                                    </div>
                                    <h3 class="text-xl font-semibold text-gray-900">Folyamatos partnerseg</h3>
                                </div>
                                <p class="text-gray-600">Rendszeres check-in-ek, negyedeves uzleti attekintesek, folyamatos fejlesztes</p>
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
                    Kinek ajanjuk az Enterprise programot?
                </h2>
            </div>

            <div class="mt-12 grid gap-8 lg:grid-cols-2">
                <div class="rounded-2xl bg-white p-8 shadow-sm">
                    <h3 class="mb-6 text-xl font-semibold text-gray-900">Idealis, ha...</h3>
                    <ul class="space-y-4">
                        <li class="flex items-start gap-3">
                            <svg class="mt-0.5 h-6 w-6 shrink-0 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            <span class="text-gray-600"><strong class="text-gray-900">100+ felhasznaloja</strong> lesz a rendszernek</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <svg class="mt-0.5 h-6 w-6 shrink-0 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            <span class="text-gray-600"><strong class="text-gray-900">Egyedi integraciokra</strong> van szuksege meglevo rendszerekkel</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <svg class="mt-0.5 h-6 w-6 shrink-0 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            <span class="text-gray-600"><strong class="text-gray-900">Szigoru compliance-kovetelimenyek</strong>nek kell megfelelnie</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <svg class="mt-0.5 h-6 w-6 shrink-0 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            <span class="text-gray-600"><strong class="text-gray-900">Dedikalt eroforrasokat</strong> es szemelyes tamogatast var el</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <svg class="mt-0.5 h-6 w-6 shrink-0 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            <span class="text-gray-600"><strong class="text-gray-900">Hosszu tavu partnerre</strong> van szuksege, nem csak szoftverre</span>
                        </li>
                    </ul>
                </div>

                <div class="rounded-2xl bg-white p-8 shadow-sm">
                    <h3 class="mb-6 text-xl font-semibold text-gray-900">Tipikus Enterprise ugyfelek</h3>
                    <div class="space-y-4">
                        <div class="flex items-center gap-4 rounded-lg bg-gray-50 p-4">
                            <span class="text-2xl">🏭</span>
                            <div>
                                <p class="font-medium text-gray-900">Gyartas</p>
                                <p class="text-sm text-gray-600">MES integracio, tobb telephely, OEE monitoring</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-4 rounded-lg bg-gray-50 p-4">
                            <span class="text-2xl">🏪</span>
                            <div>
                                <p class="font-medium text-gray-900">Kereskedelem</p>
                                <p class="text-sm text-gray-600">ERP-kapcsolat, webshop-integracio, multi-currency</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-4 rounded-lg bg-gray-50 p-4">
                            <span class="text-2xl">🏦</span>
                            <div>
                                <p class="font-medium text-gray-900">Penzugy</p>
                                <p class="text-sm text-gray-600">Szigoru compliance, audit trail, titkositas</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-4 rounded-lg bg-gray-50 p-4">
                            <span class="text-2xl">🚚</span>
                            <div>
                                <p class="font-medium text-gray-900">Logisztika</p>
                                <p class="text-sm text-gray-600">EDI, tobb raktar, fuvarozo-integraciok</p>
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
                    Referenciak
                </h2>
            </div>

            <div class="mt-12 grid gap-8 lg:grid-cols-3">
                <div class="rounded-2xl bg-gray-50 p-8">
                    <div class="mb-6 flex items-center gap-1">
                        @for ($i = 0; $i < 5; $i++)
                            <svg class="h-5 w-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg>
                        @endfor
                    </div>
                    <blockquote class="mb-6 text-gray-700">
                        "A Cegem360 nem csak szoftvert adott, hanem partnert. Az Account Managerunk jobban ismeri a folyamatainkat, mint nehany belso kollegank."
                    </blockquote>
                    <div class="flex items-center gap-4">
                        <div class="flex h-12 w-12 items-center justify-center rounded-full bg-indigo-200 font-semibold text-indigo-700">HL</div>
                        <div>
                            <div class="font-semibold text-gray-900">Horvath Laszlo</div>
                            <div class="text-sm text-gray-600">IT igazgato, Nagyvallalati gyarto</div>
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
                        "A dedikalt kornyezet es az SLA-garancia volt a donto. Kritikus rendszerunkel nem engedhetjuk meg a kiesest."
                    </blockquote>
                    <div class="flex items-center gap-4">
                        <div class="flex h-12 w-12 items-center justify-center rounded-full bg-indigo-200 font-semibold text-indigo-700">SM</div>
                        <div>
                            <div class="font-semibold text-gray-900">Dr. Szabo Maria</div>
                            <div class="text-sm text-gray-600">CFO, Penzugyi szolgaltato</div>
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
                        "Az egyedi SAP-integracio 3 honap alatt keszult el, es azota hibatlanul mukodik. A support csapat reakcioideje peldaerteku."
                    </blockquote>
                    <div class="flex items-center gap-4">
                        <div class="flex h-12 w-12 items-center justify-center rounded-full bg-indigo-200 font-semibold text-indigo-700">KA</div>
                        <div>
                            <div class="font-semibold text-gray-900">Kovacs Andras</div>
                            <div class="text-sm text-gray-600">Operations Director, Logisztikai ceg</div>
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
                    Gyakran ismetelt kerdesek
                </h2>
            </div>

            <div class="mx-auto mt-12 max-w-3xl space-y-4">
                <div x-data="{ open: false }" class="rounded-xl bg-white shadow-sm">
                    <button @click="open = !open" class="flex w-full items-center justify-between p-6 text-left">
                        <span class="font-semibold text-gray-900">Mennyi ido a bevezetes?</span>
                        <svg class="h-5 w-5 text-gray-500 transition-transform" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="open" x-collapse class="px-6 pb-6">
                        <p class="text-gray-600">Tipikusan 3-6 honap, az egyedi igenyek komplexitasatol fuggoen. Egyszerubb projektek akar 8 het alatt is indulhatnak.</p>
                    </div>
                </div>

                <div x-data="{ open: false }" class="rounded-xl bg-white shadow-sm">
                    <button @click="open = !open" class="flex w-full items-center justify-between p-6 text-left">
                        <span class="font-semibold text-gray-900">Milyen rendszerekkel tudnak integralmi?</span>
                        <svg class="h-5 w-5 text-gray-500 transition-transform" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="open" x-collapse class="px-6 pb-6">
                        <p class="text-gray-600">Szinte barmivel, aminek van API-ja vagy adatexport lehetosege. A legnepszerubbek: SAP, Microsoft Dynamics, Salesforce, HubSpot, Shopify, valamint szamos magyar rendszer (Billingo, Szamlazz.hu, Nexon).</p>
                    </div>
                </div>

                <div x-data="{ open: false }" class="rounded-xl bg-white shadow-sm">
                    <button @click="open = !open" class="flex w-full items-center justify-between p-6 text-left">
                        <span class="font-semibold text-gray-900">Mi tortenik, ha a szerzodes lejar?</span>
                        <svg class="h-5 w-5 text-gray-500 transition-transform" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="open" x-collapse class="px-6 pb-6">
                        <p class="text-gray-600">Az On adatai az Onei. Szerzodes vegem teljes adatexportot biztositunk szabvanyos formatumban (CSV, JSON, XML). Nincs vendor lock-in.</p>
                    </div>
                </div>

                <div x-data="{ open: false }" class="rounded-xl bg-white shadow-sm">
                    <button @click="open = !open" class="flex w-full items-center justify-between p-6 text-left">
                        <span class="font-semibold text-gray-900">Van probaidoszak?</span>
                        <svg class="h-5 w-5 text-gray-500 transition-transform" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="open" x-collapse class="px-6 pb-6">
                        <p class="text-gray-600">Enterprise projektekmek Proof of Concept (PoC) idoszakot tudunk biztositani, amelynek soran egy korlatozott scope-on tesztelheti a rendszert.</p>
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
                    Kovetkezo lepesek
                </h2>
                <p class="mb-10 text-lg text-indigo-100">
                    Egyeztessunk egy 30 perces hivast, ahol megertjuk az On igenyeit es kihivasait.
                    Szakertoink felterkepezik a jelenlegi rendszereket es szemelyere szabott ajanlatot keszitunk.
                </p>
                <div class="flex flex-col justify-center gap-4 sm:flex-row">
                    <a href="{{ route('quote-request') }}" class="inline-flex items-center justify-center gap-2 rounded-lg bg-white px-8 py-4 text-base font-semibold text-indigo-600 shadow-lg transition hover:bg-gray-50">
                        Enterprise konzultacio kerese
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                        </svg>
                    </a>
                    <a href="{{ route('quote-request') }}" class="inline-flex items-center justify-center gap-2 rounded-lg border-2 border-white/30 px-8 py-4 text-base font-semibold text-white transition hover:bg-white/10">
                        Arajanlatot kerek
                    </a>
                </div>
            </div>
        </div>
    </section>
</div>
