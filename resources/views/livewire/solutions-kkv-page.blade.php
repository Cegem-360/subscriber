<div>
    {{-- Hero Section --}}
    <section class="bg-linear-to-b from-indigo-50 to-white py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto max-w-4xl text-center">
                <div
                    class="mb-6 inline-flex items-center gap-2 rounded-full bg-indigo-100 px-4 py-1.5 text-sm font-medium text-indigo-700">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                    KKV Megoldások
                </div>
                <h1 class="mb-6 text-4xl font-semibold text-gray-900 sm:text-5xl lg:text-6xl leading-tight">
                    Növekedjen okosabban — ne csak keményebben
                </h1>
                <p class="mx-auto max-w-3xl text-lg text-gray-600 leading-relaxed sm:text-xl">
                    Kis- és középvállalkozásként Ön mindent csinál egyszerre: értékesít, szervez, számlázz, és közben
                    még
                    a stratégiáról is gondoskodik. A Cégem360 azért készült, hogy végre Ön is úgy vezethesse cégét, mint
                    a nagyok — anélkül, hogy tucatnyi rendszert kellene használnia vagy IT-csapatot alkalmaznia.
                </p>

                {{-- CTA Buttons --}}
                <div class="mt-8 flex flex-col items-center justify-center gap-4 sm:flex-row">
                    <a href="{{ route('register') }}"
                        class="inline-flex items-center justify-center gap-2 rounded-full bg-indigo-600 px-8 py-4 text-base font-semibold text-white shadow-lg transition-colors hover:bg-indigo-700 hover:shadow-xl">
                        Kezdés
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </a>
                    <a href="{{ route('contact') }}"
                        class="inline-flex items-center justify-center gap-2 rounded-full border-2 border-indigo-200 bg-white px-8 py-4 text-base font-semibold text-indigo-700 transition-colors hover:bg-indigo-50">
                        Demó kérése
                    </a>
                </div>

            </div>
        </div>
    </section>

    {{-- Pain Points Section --}}
    <section class="bg-white py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto mb-12 max-w-3xl text-center">
                <h2 class="text-3xl font-semibold text-gray-900 sm:text-4xl">Ismerős helyzetek?</h2>
            </div>

            <div class="grid gap-6 sm:grid-cols-2">
                <div class="rounded-2xl border border-indigo-100 bg-linear-to-br from-indigo-50 to-white p-8">
                    <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-xl bg-white shadow-sm">
                        <svg class="h-6 w-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <p class="text-lg text-gray-700">
                        „Excelben vezetem az ügyfeleket, de már nem találom, kivel mikor beszéltem."
                    </p>
                </div>
                <div class="rounded-2xl border border-indigo-100 bg-linear-to-br from-indigo-50 to-white p-8">
                    <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-xl bg-white shadow-sm">
                        <svg class="h-6 w-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <p class="text-lg text-gray-700">
                        „Hónap végén derül ki, hogy tulajdonképpen mennyit kerestem — vagy bukott a cég."
                    </p>
                </div>
                <div class="rounded-2xl border border-indigo-100 bg-linear-to-br from-indigo-50 to-white p-8">
                    <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-xl bg-white shadow-sm">
                        <svg class="h-6 w-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <p class="text-lg text-gray-700">
                        „Minden számítógépen más verzió van a dokumentumokból."
                    </p>
                </div>
                <div class="rounded-2xl border border-indigo-100 bg-linear-to-br from-indigo-50 to-white p-8">
                    <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-xl bg-white shadow-sm">
                        <svg class="h-6 w-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                    <p class="text-lg text-gray-700">
                        „A beszállítóval megbeszéltük, de nem tudom, ki intézte el végül."
                    </p>
                </div>
            </div>

            {{-- Solution box --}}
            <div
                class="mx-auto mt-12 max-w-4xl rounded-2xl border border-indigo-100 bg-indigo-50 p-8 text-center lg:p-12">
                <div class="mx-auto mb-6 flex h-16 w-16 items-center justify-center rounded-2xl bg-indigo-100">
                    <svg class="h-8 w-8 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <h3 class="mb-4 text-2xl font-semibold text-gray-900">Ha bármelyik ismerős, a Cégem360 megoldást kínál
                </h3>
                <p class="text-lg text-gray-600">
                    Egyszerűen, gyorsan, kockázat nélkül. Minden egy helyen, átláthatóan és automatizáltan.
                </p>
            </div>
        </div>
    </section>

    {{-- Modules Section --}}
    <section class="bg-gray-50 py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto mb-12 max-w-3xl text-center">
                <h2 class="text-3xl font-semibold text-gray-900 sm:text-4xl">Amit a KKV-k számára kínálunk</h2>
                <p class="mt-4 text-lg text-gray-600">Moduláris rendszer, amely együtt növekszik Önnel.</p>
            </div>

            <div class="grid gap-8 lg:grid-cols-2">
                {{-- CRM Module --}}
                <div
                    class="rounded-2xl border border-gray-100 bg-white p-8 shadow-sm transition-shadow hover:shadow-lg">
                    <div class="mb-4 flex items-center gap-4">
                        <x-module-icon module="crm" size="lg" />
                        <h3 class="text-xl font-semibold text-gray-900">CRM — Soha többé elveszett ügyfél</h3>
                    </div>
                    <p class="mb-4 text-gray-600">
                        Minden érdeklődő, ajánlat és kapcsolatfelvétel egy helyen. Automatikus emlékeztetők
                        figyelmeztik, ha egy potenciális ügyfél túl régóta várakozik. Értékesítési pipeline mutatja, hol
                        tartanak az üzletek — és hol kell beavatkozni.
                    </p>
                    <div class="rounded-lg bg-indigo-50 px-4 py-3">
                        <p class="font-medium text-indigo-700">
                            Eredmény: Átlagosan 40%-kal több lezárt üzlet a bevezetés első negyedévében.
                        </p>
                    </div>
                </div>

                {{-- Kontrolling Module --}}
                <div
                    class="rounded-2xl border border-gray-100 bg-white p-8 shadow-sm transition-shadow hover:shadow-lg">
                    <div class="mb-4 flex items-center gap-4">
                        <x-module-icon module="kontrolling" size="lg" />
                        <h3 class="text-xl font-semibold text-gray-900">Kontrolling — Tudja, hova fogy a pénz</h3>
                    </div>
                    <p class="mb-4 text-gray-600">
                        Valós idejű pénzügyi áttekintés: bevételek, költségek, cash flow — egyetlen dashboardon. Nincs
                        több hónap végi meglepetés. Látja, melyik projekt nyereséges, és melyiken bukik.
                    </p>
                    <div class="rounded-lg bg-indigo-50 px-4 py-3">
                        <p class="font-medium text-indigo-700">
                            Eredmény: A havi zárás napokról órákra csökken.
                        </p>
                    </div>
                </div>

                {{-- Értékesítés Module --}}
                <div
                    class="rounded-2xl border border-gray-100 bg-white p-8 shadow-sm transition-shadow hover:shadow-lg">
                    <div class="mb-4 flex items-center gap-4">
                        <x-module-icon module="ertekesites" size="lg" />
                        <h3 class="text-xl font-semibold text-gray-900">Értékesítés — Minden ajánlat nyomon követve
                        </h3>
                    </div>
                    <p class="mb-4 text-gray-600">
                        Készítsen professzionális árajánlatokat percek alatt. A rendszer automatikusan emlékeztet a
                        lejáró ajánlatokra és a követendő ügyfelekre. Tudja, melyik termék vagy szolgáltatás hozza a
                        legtöbb bevételt.
                    </p>
                    <div class="rounded-lg bg-indigo-50 px-4 py-3">
                        <p class="font-medium text-indigo-700">
                            Eredmény: 2x gyorsabb ajánlatkészítés, kevesebb adminisztráció.
                        </p>
                    </div>
                </div>

                {{-- Automatizálás Module --}}
                <div
                    class="rounded-2xl border border-gray-100 bg-white p-8 shadow-sm transition-shadow hover:shadow-lg">
                    <div class="mb-4 flex items-center gap-4">
                        <x-module-icon module="automatizalas" size="lg" />
                        <h3 class="text-xl font-semibold text-gray-900">Automatizálás — Szabadítsa fel az idejét</h3>
                    </div>
                    <p class="mb-4 text-gray-600">
                        Állítson be automatikus műveleteket: új érdeklődő érkezik — csapat értesítést kap. Számla
                        esedékes — emlékeztető megy. Készlet alacsony — beszerzés indul. Kód nélkül, percek alatt.
                    </p>
                    <div class="rounded-lg bg-indigo-50 px-4 py-3">
                        <p class="font-medium text-indigo-700">
                            Eredmény: Akár heti 10+ óra megtakarítás az ismétlődő feladatokon.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Why Choose Section --}}
    <section class="bg-white py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto mb-12 max-w-3xl text-center">
                <h2 class="text-3xl font-semibold text-gray-900 sm:text-4xl">Miért választják a KKV-k a Cégem360-at?
                </h2>
            </div>

            <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-4">
                <div
                    class="rounded-2xl border border-gray-100 bg-white p-6 text-center shadow-sm transition-shadow hover:shadow-lg">
                    <div
                        class="mx-auto mb-4 flex h-14 w-14 items-center justify-center rounded-xl bg-indigo-100 text-indigo-600">
                        <svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <h3 class="mb-2 text-lg font-semibold text-gray-900">Nincs IT-csapat? Nincs probléma.</h3>
                    <p class="text-gray-600">A rendszert Ön is beállíthatja, és mi segítünk az indulásban.</p>
                </div>

                <div
                    class="rounded-2xl border border-gray-100 bg-white p-6 text-center shadow-sm transition-shadow hover:shadow-lg">
                    <div
                        class="mx-auto mb-4 flex h-14 w-14 items-center justify-center rounded-xl bg-indigo-100 text-indigo-600">
                        <svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                        </svg>
                    </div>
                    <h3 class="mb-2 text-lg font-semibold text-gray-900">Skálázható megoldás</h3>
                    <p class="text-gray-600">Kezdje egy modullal, és bővítse, ahogy a cég növekszik.</p>
                </div>

                <div
                    class="rounded-2xl border border-gray-100 bg-white p-6 text-center shadow-sm transition-shadow hover:shadow-lg">
                    <div
                        class="mx-auto mb-4 flex h-14 w-14 items-center justify-center rounded-xl bg-indigo-100 text-indigo-600">
                        <svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </div>
                    <h3 class="mb-2 text-lg font-semibold text-gray-900">Magyar támogatás</h3>
                    <p class="text-gray-600">24/7 elérhető ügyfélszolgálat, aki érti az Ön helyzetét.</p>
                </div>

                <div
                    class="rounded-2xl border border-gray-100 bg-white p-6 text-center shadow-sm transition-shadow hover:shadow-lg">
                    <div
                        class="mx-auto mb-4 flex h-14 w-14 items-center justify-center rounded-xl bg-indigo-100 text-indigo-600">
                        <svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                    </div>
                    <h3 class="mb-2 text-lg font-semibold text-gray-900">Kockázatmentes indulás</h3>
                    <p class="text-gray-600">Nincs elköteleződés, bármikor lemondható.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Case Study Section --}}
    <section class="bg-gray-50 py-16 lg:py-20">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto max-w-4xl">
                <div class="rounded-2xl bg-white p-8 shadow-sm lg:p-12">
                    <div class="mb-6 inline-flex items-center rounded-full bg-green-50 px-3 py-1">
                        <svg class="mr-2 h-4 w-4 text-green-600" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span class="text-sm font-medium text-green-700">Sikertörténet</span>
                    </div>

                    <h3 class="mb-4 text-2xl font-semibold text-gray-900">
                        Hogyan növelte bevételét 35%-kal egy családi vállalkozás?
                    </h3>

                    <p class="mb-6 text-gray-600 leading-relaxed">
                        Egy 12 fős gyártó cég korábban Excelben vezette az ügyfeleit és papíron a megrendeléseket. Az
                        ajánlatok gyakran elvesztek, a visszajelzések késtek.
                    </p>

                    <p class="mb-6 text-gray-600 leading-relaxed">
                        A Cégem360 bevezetése után 3 hónappal: az értékesítési ciklus 40%-kal rövidült, az
                        adminisztratív munka feleződött, és a bevétel 35%-kal nőtt — ugyanazzal a csapattal.
                    </p>

                    <blockquote class="border-l-4 border-indigo-500 pl-6">
                        <p class="mb-4 text-lg italic text-gray-700">
                            „Végre látom, hol tartanak az üzletek, és nem felejtek el senkit. A rendszer jobban
                            emlékszik, mint én."
                        </p>
                        <footer class="text-gray-500">— Tulajdonos-ügyvezető</footer>
                    </blockquote>
                </div>
            </div>
        </div>
    </section>

    {{-- Bottom CTA Section --}}
    <section class="bg-indigo-600 py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-4 text-center sm:px-6 lg:px-8">
            <h2 class="text-3xl font-semibold text-white sm:text-4xl">
                Kezdje el még ma — kockázat nélkül
            </h2>
            <p class="mx-auto mt-4 max-w-xl text-lg text-indigo-100">
                Teljes funkcionalitás, magyar támogatás. Nincs bankkártya, nincs elköteleződés. Csak
                eredmények.
            </p>
            <div class="mt-8 flex flex-col items-center justify-center gap-4 sm:flex-row">
                <a href="{{ route('register') }}"
                    class="inline-flex items-center justify-center gap-2 rounded-full bg-white px-8 py-4 text-base font-semibold text-indigo-600 shadow-lg transition-colors hover:bg-indigo-50 hover:shadow-xl">
                    Ingyenes kezdés
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M14 5l7 7m0 0l-7 7m7-7H3" />
                    </svg>
                </a>
                <a href="{{ route('contact') }}"
                    class="inline-flex items-center justify-center rounded-full border-2 border-indigo-400 px-8 py-4 text-base font-semibold text-white transition-colors hover:bg-indigo-700">
                    Bemutató kérése
                </a>
            </div>
        </div>
    </section>
</div>
