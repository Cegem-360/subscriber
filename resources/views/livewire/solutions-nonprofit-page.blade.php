<div>
    {{-- Hero Section --}}
    <section class="bg-linear-to-b from-emerald-50 to-white py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto max-w-4xl text-center">
                <div class="mb-6 inline-flex items-center gap-2 rounded-full bg-emerald-100 px-4 py-1.5 text-sm font-medium text-emerald-700">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                    </svg>
                    Non-profit Megoldások
                </div>
                <h1 class="mb-6 text-4xl font-semibold text-gray-900 sm:text-5xl lg:text-6xl leading-tight">
                    Több hatás, kevesebb adminisztráció — kedvezményes áron
                </h1>
                <p class="mx-auto max-w-3xl text-lg text-gray-600 leading-relaxed sm:text-xl">
                    Non-profit szervezetként az Ön küldetése a változás. De ahhoz, hogy valódi hatást érjen el,
                    hatékonyan kell működnie — anélkül, hogy a költségvetés nagy részét szoftverekre költené. A Cégem360
                    Non-profit programja dedikált kedvezményeket és speciális funkciókat kínál alapítványoknak,
                    egyesületeknek és civil szervezeteknek.
                </p>

                {{-- CTA Buttons --}}
                <div class="mt-8 flex flex-col items-center justify-center gap-4 sm:flex-row">
                    <a href="{{ route('quote-request') }}" class="inline-flex items-center justify-center gap-2 rounded-full bg-emerald-600 px-8 py-4 text-base font-semibold text-white shadow-lg transition-colors hover:bg-emerald-700 hover:shadow-xl">
                        Jelentkezés a programba
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </a>
                    <a href="{{ route('quote-request') }}" class="inline-flex items-center justify-center gap-2 rounded-full border-2 border-emerald-200 bg-white px-8 py-4 text-base font-semibold text-emerald-700 transition-colors hover:bg-emerald-50">
                        Tudjon meg többet
                    </a>
                </div>

                {{-- Trust badges --}}
                <div class="mt-8 flex flex-wrap items-center justify-center gap-x-6 gap-y-2 text-sm text-gray-500">
                    <span class="flex items-center gap-1.5">
                        <svg class="h-4 w-4 text-emerald-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                        50% kedvezmény
                    </span>
                    <span class="flex items-center gap-1.5">
                        <svg class="h-4 w-4 text-emerald-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                        Ingyenes onboarding
                    </span>
                    <span class="flex items-center gap-1.5">
                        <svg class="h-4 w-4 text-emerald-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                        Dedikált támogatás
                    </span>
                </div>
            </div>
        </div>
    </section>

    {{-- Challenges Section --}}
    <section class="bg-white py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto mb-12 max-w-3xl text-center">
                <h2 class="text-3xl font-semibold text-gray-900 sm:text-4xl">Non-profit szervezetek tipikus kihívásai</h2>
            </div>

            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                <div class="rounded-2xl border border-emerald-100 bg-linear-to-br from-emerald-50 to-white p-8">
                    <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-xl bg-white shadow-sm">
                        <svg class="h-6 w-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="mb-2 text-lg font-semibold text-gray-900">Korlátozott erőforrások</h3>
                    <p class="text-gray-600">Kevés munkatárs, sok feladat, szűkös IT-költségkeret.</p>
                </div>

                <div class="rounded-2xl border border-emerald-100 bg-linear-to-br from-emerald-50 to-white p-8">
                    <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-xl bg-white shadow-sm">
                        <svg class="h-6 w-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                    <h3 class="mb-2 text-lg font-semibold text-gray-900">Donor-menedzsment</h3>
                    <p class="text-gray-600">Támogatók nyilvántartása, kapcsolattartás, köszönőlevelek — manuálisan
                        időigényes.</p>
                </div>

                <div class="rounded-2xl border border-emerald-100 bg-linear-to-br from-emerald-50 to-white p-8">
                    <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-xl bg-white shadow-sm">
                        <svg class="h-6 w-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <h3 class="mb-2 text-lg font-semibold text-gray-900">Pályázati adminisztráció</h3>
                    <p class="text-gray-600">Beszámolók, elszámolások, határidők követése több projektnél párhuzamosan.
                    </p>
                </div>

                <div class="rounded-2xl border border-emerald-100 bg-linear-to-br from-emerald-50 to-white p-8">
                    <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-xl bg-white shadow-sm">
                        <svg class="h-6 w-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </div>
                    <h3 class="mb-2 text-lg font-semibold text-gray-900">Önkéntes-koordináció</h3>
                    <p class="text-gray-600">Ki, mikor, hol van? Kinek milyen képességei vannak?</p>
                </div>

                <div class="rounded-2xl border border-emerald-100 bg-linear-to-br from-emerald-50 to-white p-8">
                    <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-xl bg-white shadow-sm">
                        <svg class="h-6 w-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <h3 class="mb-2 text-lg font-semibold text-gray-900">Átláthatósági követelmények</h3>
                    <p class="text-gray-600">Támogatók és hatóságok részletes beszámolókat várnak.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Features Section --}}
    <section class="bg-gray-50 py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto mb-12 max-w-3xl text-center">
                <h2 class="text-3xl font-semibold text-gray-900 sm:text-4xl">Speciális funkciók non-profit szervezeteknek</h2>
                <p class="mt-4 text-lg text-gray-600">Célzott eszközök a hatékonyabb működéshez.</p>
            </div>

            <div class="grid gap-8 lg:grid-cols-2">
                {{-- Donor Management --}}
                <div class="rounded-2xl border border-gray-100 bg-white p-8 shadow-sm transition-shadow hover:shadow-lg">
                    <div class="mb-4 flex items-center gap-4">
                        <x-module-icon module="crm" size="lg" />
                        <h3 class="text-xl font-semibold text-gray-900">CRM — Donor és támogató menedzsment</h3>
                    </div>
                    <ul class="mb-4 space-y-2 text-gray-600">
                        <li class="flex items-start gap-2">
                            <svg class="mt-0.5 h-5 w-5 shrink-0 text-green-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            Minden támogató, adományozó és partner egy helyen
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="mt-0.5 h-5 w-5 shrink-0 text-green-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            Automatikus köszönőlevelek és nyugták
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="mt-0.5 h-5 w-5 shrink-0 text-green-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            Adományozási történet és giving patterns elemzés
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="mt-0.5 h-5 w-5 shrink-0 text-green-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            Személyre szabott kommunikáció a donor journey mentén
                        </li>
                    </ul>
                    <div class="rounded-lg bg-emerald-50 px-4 py-3">
                        <p class="font-medium text-emerald-700">
                            Eredmény: 30%-kal magasabb donor-megtartás, több visszatérő adományozó.
                        </p>
                    </div>
                </div>

                {{-- Project Accounting --}}
                <div class="rounded-2xl border border-gray-100 bg-white p-8 shadow-sm transition-shadow hover:shadow-lg">
                    <div class="mb-4 flex items-center gap-4">
                        <x-module-icon module="kontrolling" size="lg" />
                        <h3 class="text-xl font-semibold text-gray-900">Kontrolling — Pályázati és projekt-elszámolás
                        </h3>
                    </div>
                    <ul class="mb-4 space-y-2 text-gray-600">
                        <li class="flex items-start gap-2">
                            <svg class="mt-0.5 h-5 w-5 shrink-0 text-green-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            Projektalapú költségkövetés, forrásonként elkülönítve
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="mt-0.5 h-5 w-5 shrink-0 text-green-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            Automatikus pályázati beszámolók generálása
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="mt-0.5 h-5 w-5 shrink-0 text-green-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            Határidő-figyelés és emlékeztetők
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="mt-0.5 h-5 w-5 shrink-0 text-green-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            Átlátható pénzügyi kimutatások stakeholdereknek
                        </li>
                    </ul>
                    <div class="rounded-lg bg-emerald-50 px-4 py-3">
                        <p class="font-medium text-emerald-700">
                            Eredmény: 50%-kal kevesebb idő a beszámolók elkészítésén.
                        </p>
                    </div>
                </div>

                {{-- Volunteer Coordination --}}
                <div class="rounded-2xl border border-gray-100 bg-white p-8 shadow-sm transition-shadow hover:shadow-lg">
                    <div class="mb-4 flex items-center gap-4">
                        <div
                            class="flex h-14 w-14 items-center justify-center rounded-xl bg-emerald-100 text-emerald-600">
                            <svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900">Önkéntes-koordináció — Közösségszervezés
                            egyszerűen</h3>
                    </div>
                    <ul class="mb-4 space-y-2 text-gray-600">
                        <li class="flex items-start gap-2">
                            <svg class="mt-0.5 h-5 w-5 shrink-0 text-green-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            Önkéntes-adatbázis képességekkel és elérhetőséggel
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="mt-0.5 h-5 w-5 shrink-0 text-green-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            Műszakbeosztás és jelentkezés-kezelés
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="mt-0.5 h-5 w-5 shrink-0 text-green-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            Órák nyilvántartása és elismerések
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="mt-0.5 h-5 w-5 shrink-0 text-green-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            Kommunikáció csoportokkal és egyénekkel
                        </li>
                    </ul>
                    <div class="rounded-lg bg-emerald-50 px-4 py-3">
                        <p class="font-medium text-emerald-700">
                            Eredmény: 40%-kal hatékonyabb önkéntes-aktiválás.
                        </p>
                    </div>
                </div>

                {{-- Automation --}}
                <div class="rounded-2xl border border-gray-100 bg-white p-8 shadow-sm transition-shadow hover:shadow-lg">
                    <div class="mb-4 flex items-center gap-4">
                        <x-module-icon module="automatizalas" size="lg" />
                        <h3 class="text-xl font-semibold text-gray-900">Automatizálás — Kevesebb admin, több misszió
                        </h3>
                    </div>
                    <ul class="mb-4 space-y-2 text-gray-600">
                        <li class="flex items-start gap-2">
                            <svg class="mt-0.5 h-5 w-5 shrink-0 text-green-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            Automatikus adomány-visszaigazolás és nyugtaküldés
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="mt-0.5 h-5 w-5 shrink-0 text-green-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            Esemény-emlékeztetők résztvevőknek és önkénteseknek
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="mt-0.5 h-5 w-5 shrink-0 text-green-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            Rendszeres donor-kommunikáció ütemezve
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="mt-0.5 h-5 w-5 shrink-0 text-green-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            Jelentések automatikus generálása és küldése
                        </li>
                    </ul>
                    <div class="rounded-lg bg-emerald-50 px-4 py-3">
                        <p class="font-medium text-emerald-700">
                            Eredmény: Heti 15+ óra megtakarítás adminisztratív feladatokon.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Program Benefits Section --}}
    <section class="bg-white py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto mb-12 max-w-3xl text-center">
                <h2 class="text-3xl font-semibold text-gray-900 sm:text-4xl">A Cégem360 Non-profit Program előnyei</h2>
            </div>

            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                <div class="rounded-2xl border-2 border-emerald-200 bg-emerald-50 p-6 text-center">
                    <div class="mb-3 text-4xl font-bold text-emerald-600">50%</div>
                    <h3 class="mb-2 text-lg font-semibold text-gray-900">kedvezmény</h3>
                    <p class="text-gray-600">minden csomagból bejegyzett non-profit szervezeteknek</p>
                </div>

                <div class="flex gap-4 rounded-2xl border border-gray-100 bg-white p-6 shadow-sm transition-shadow hover:shadow-lg">
                    <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-lg bg-emerald-100 text-emerald-600">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="mb-1 font-semibold text-gray-900">Ingyenes onboarding</h3>
                        <p class="text-sm text-gray-600">és dedikált támogatás a bevezetés során</p>
                    </div>
                </div>

                <div class="flex gap-4 rounded-2xl border border-gray-100 bg-white p-6 shadow-sm transition-shadow hover:shadow-lg">
                    <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-lg bg-emerald-100 text-emerald-600">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="mb-1 font-semibold text-gray-900">Non-profit specifikus sablonok</h3>
                        <p class="text-sm text-gray-600">pályázati nyilvántartás, donor-kezelés, eseményszervezés</p>
                    </div>
                </div>

                <div class="flex gap-4 rounded-2xl border border-gray-100 bg-white p-6 shadow-sm transition-shadow hover:shadow-lg">
                    <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-lg bg-emerald-100 text-emerald-600">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="mb-1 font-semibold text-gray-900">Közösségi hozzáférés</h3>
                        <p class="text-sm text-gray-600">tapasztalatcsere más non-profit szervezetekkel</p>
                    </div>
                </div>

                <div class="flex gap-4 rounded-2xl border border-gray-100 bg-white p-6 shadow-sm transition-shadow hover:shadow-lg">
                    <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-lg bg-emerald-100 text-emerald-600">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="mb-1 font-semibold text-gray-900">GDPR-megfelelő adatkezelés</h3>
                        <p class="text-sm text-gray-600">biztonságos donor-adatbázis</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Case Study Section --}}
    <section class="bg-gray-50 py-16 lg:py-20">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto max-w-4xl">
                <div class="rounded-2xl bg-white p-8 shadow-sm lg:p-12">
                    <div class="mb-6 inline-flex items-center rounded-full bg-emerald-50 px-3 py-1">
                        <svg class="mr-2 h-4 w-4 text-emerald-600" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span class="text-sm font-medium text-emerald-700">Sikertörténet</span>
                    </div>

                    <h3 class="mb-4 text-2xl font-semibold text-gray-900">
                        Hogyan duplázta meg egy alapítvány a visszatérő adományozóit?
                    </h3>

                    <p class="mb-6 text-gray-600 leading-relaxed">
                        Egy környezetvédelmi alapítvány korábban Excelben vezette a támogatóit. A köszönőlevelek gyakran
                        elkéstek, a donor-kapcsolatok személytelenek voltak.
                    </p>

                    <p class="mb-6 text-gray-600 leading-relaxed">
                        A Cégem360 bevezetése után automatikus köszönőlevelek mennek 24 órán belül, személyre szabott
                        évfordulós üzenetek érkeznek a donálás évfordulóján, és a csapat látja, ki milyen ügyeket támogat
                        legszívesebben.
                    </p>

                    <div class="mb-6 rounded-lg bg-emerald-50 px-4 py-3">
                        <p class="font-semibold text-emerald-700">
                            Eredmény: A visszatérő adományozók száma megduplázódott egy év alatt.
                        </p>
                    </div>

                    <blockquote class="border-l-4 border-emerald-500 pl-6">
                        <p class="mb-4 text-lg italic text-gray-700">
                            „Végre van időnk arra, ami igazán fontos: a küldetésünkre. A rendszer elvégzi az
                            adminisztrációt helyettünk."
                        </p>
                        <footer class="text-gray-500">— Programigazgató</footer>
                    </blockquote>
                </div>
            </div>
        </div>
    </section>

    {{-- Eligibility Section --}}
    <section class="bg-white py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto max-w-3xl text-center">
                <h2 class="mb-8 text-3xl font-semibold text-gray-900 sm:text-4xl">Kik jogosultak a Non-profit programra?</h2>

                <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
                    <div class="flex items-center gap-3 rounded-2xl border border-gray-100 bg-white p-4 shadow-sm">
                        <svg class="h-5 w-5 shrink-0 text-emerald-500" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5 13l4 4L19 7" />
                        </svg>
                        <span class="text-gray-700">Bejegyzett alapítványok és egyesületek</span>
                    </div>

                    <div class="flex items-center gap-3 rounded-2xl border border-gray-100 bg-white p-4 shadow-sm">
                        <svg class="h-5 w-5 shrink-0 text-emerald-500" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5 13l4 4L19 7" />
                        </svg>
                        <span class="text-gray-700">Egyházak és vallási szervezetek</span>
                    </div>

                    <div class="flex items-center gap-3 rounded-2xl border border-gray-100 bg-white p-4 shadow-sm">
                        <svg class="h-5 w-5 shrink-0 text-emerald-500" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5 13l4 4L19 7" />
                        </svg>
                        <span class="text-gray-700">Oktatási intézmények non-profit státusszal</span>
                    </div>

                    <div class="flex items-center gap-3 rounded-2xl border border-gray-100 bg-white p-4 shadow-sm">
                        <svg class="h-5 w-5 shrink-0 text-emerald-500" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5 13l4 4L19 7" />
                        </svg>
                        <span class="text-gray-700">Szociális és egészségügyi civil szervezetek</span>
                    </div>

                    <div class="flex items-center gap-3 rounded-2xl border border-gray-100 bg-white p-4 shadow-sm">
                        <svg class="h-5 w-5 shrink-0 text-emerald-500" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5 13l4 4L19 7" />
                        </svg>
                        <span class="text-gray-700">Környezetvédelmi és közhasznú szervezetek</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Bottom CTA Section --}}
    <section class="bg-emerald-600 py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-4 text-center sm:px-6 lg:px-8">
            <h2 class="text-3xl font-semibold text-white sm:text-4xl">
                Jelentkezzen a Non-profit programba
            </h2>
            <p class="mx-auto mt-4 max-w-xl text-lg text-emerald-100">
                Egyszerű jelentkezési folyamat. Csak küldje el szervezete alapító okiratát vagy közhasznúsági
                bejegyzését, és 48 órán belül aktiváljuk kedvezményes hozzáférését.
            </p>
            <div class="mt-8 flex flex-col items-center justify-center gap-4 sm:flex-row">
                <a href="{{ route('quote-request') }}"
                    class="inline-flex items-center justify-center gap-2 rounded-full bg-white px-8 py-4 text-base font-semibold text-emerald-600 shadow-lg transition-colors hover:bg-emerald-50 hover:shadow-xl">
                    Jelentkezés a programba
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M14 5l7 7m0 0l-7 7m7-7H3" />
                    </svg>
                </a>
                <a href="{{ route('quote-request') }}"
                    class="inline-flex items-center justify-center rounded-full border-2 border-emerald-400 px-8 py-4 text-base font-semibold text-white transition-colors hover:bg-emerald-700">
                    Kérdésem van
                </a>
            </div>
        </div>
    </section>
</div>
