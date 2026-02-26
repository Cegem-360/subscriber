<div>
    {{-- Hero Section --}}
    <section class="bg-linear-to-b from-cyan-50 to-white py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto max-w-4xl text-center">
                <div class="mb-6 flex justify-center">
                    <x-module-icon module="szerviz" size="xl" />
                </div>
                <div
                    class="mb-6 inline-flex items-center gap-2 rounded-full bg-cyan-100 px-4 py-1.5 text-sm font-medium text-cyan-700">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                    </svg>
                    Szerviz Modul
                </div>
                <h1 class="mb-6 text-4xl font-semibold leading-tight text-gray-900 sm:text-5xl lg:text-6xl">
                    Digitális munkalapok helyszíni szervizmunkákhoz
                </h1>
                <p class="mx-auto max-w-3xl text-lg leading-relaxed text-gray-600 sm:text-xl">
                    Felejtse el a papíralapú munkalapokat. Rögzítsen mindent a helyszínen: munkaidőt, felhasznált
                    anyagokat, fotókat — és készítsen azonnali digitális jegyzőkönyvet ügyfelének.
                </p>

                {{-- CTA Buttons --}}
                <div class="mt-8 flex flex-col items-center justify-center gap-4 sm:flex-row">
                    <a href="{{ route('register') }}"
                        class="inline-flex items-center justify-center gap-2 rounded-full bg-cyan-600 px-8 py-4 text-base font-semibold text-white shadow-lg transition-colors hover:bg-cyan-700 hover:shadow-xl">
                        Kezdés indítása
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </a>
                    <a href="{{ route('contact') }}"
                        class="inline-flex items-center justify-center gap-2 rounded-full border-2 border-cyan-200 bg-white px-8 py-4 text-base font-semibold text-cyan-700 transition-colors hover:bg-cyan-50">
                        Demó kérése
                    </a>
                    <a href="{{ route('login') }}"
                        class="inline-flex items-center justify-center gap-2 text-base font-medium text-cyan-600 transition-colors hover:text-cyan-800">
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
                <h2 class="text-3xl font-semibold text-gray-900 sm:text-4xl">A probléma, amit megoldunk</h2>
            </div>

            <div class="grid gap-6 sm:grid-cols-2">
                <div class="rounded-2xl border border-cyan-100 bg-linear-to-br from-cyan-50 to-white p-8">
                    <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-xl bg-white shadow-sm">
                        <svg class="h-6 w-6 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <h3 class="mb-2 text-lg font-semibold text-gray-900">Elvesző papírok</h3>
                    <p class="text-gray-600">A kézzel kitöltött munkalapok elvesznek, olvashatatlanok vagy
                        elkallódnak.</p>
                </div>
                <div class="rounded-2xl border border-cyan-100 bg-linear-to-br from-cyan-50 to-white p-8">
                    <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-xl bg-white shadow-sm">
                        <svg class="h-6 w-6 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="mb-2 text-lg font-semibold text-gray-900">Késedelmes számlázás</h3>
                    <p class="text-gray-600">A munkalapok csak napokkal később kerülnek be az irodába, késleltetve a
                        számlázást.</p>
                </div>
                <div class="rounded-2xl border border-cyan-100 bg-linear-to-br from-cyan-50 to-white p-8">
                    <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-xl bg-white shadow-sm">
                        <svg class="h-6 w-6 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>
                    <h3 class="mb-2 text-lg font-semibold text-gray-900">Hiányzó dokumentáció</h3>
                    <p class="text-gray-600">Nincs fotódokumentáció a végzett munkáról, ami vitás helyzeteket okoz.</p>
                </div>
                <div class="rounded-2xl border border-cyan-100 bg-linear-to-br from-cyan-50 to-white p-8">
                    <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-xl bg-white shadow-sm">
                        <svg class="h-6 w-6 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <h3 class="mb-2 text-lg font-semibold text-gray-900">Átláthatatlan teljesítmények</h3>
                    <p class="text-gray-600">Nem látja valós időben, melyik szerelő hol tart, mennyi munkát végzett.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Features Section --}}
    <section class="bg-gray-50 py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto mb-12 max-w-3xl text-center">
                <h2 class="text-3xl font-semibold text-gray-900 sm:text-4xl">Főbb funkciók</h2>
                <p class="mt-4 text-lg text-gray-600">Minden, amire szüksége van a helyszíni munkák kezeléséhez.</p>
            </div>

            <div class="grid gap-8 lg:grid-cols-3">
                {{-- Digitális munkalap --}}
                <div
                    class="rounded-2xl border border-gray-100 bg-white p-8 shadow-sm transition-shadow hover:shadow-lg">
                    <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-xl bg-cyan-100">
                        <svg class="h-6 w-6 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                        </svg>
                    </div>
                    <h3 class="mb-3 text-xl font-semibold text-gray-900">Digitális munkalap</h3>
                    <ul class="space-y-2 text-gray-600">
                        <li class="flex items-start gap-2">
                            <svg class="mt-1 h-4 w-4 shrink-0 text-cyan-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            Mobilról kitölthető űrlapok
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="mt-1 h-4 w-4 shrink-0 text-cyan-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            Testreszabható mezők iparágra
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="mt-1 h-4 w-4 shrink-0 text-cyan-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            Offline mód támogatás
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="mt-1 h-4 w-4 shrink-0 text-cyan-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            Automatikus szinkronizálás
                        </li>
                    </ul>
                </div>

                {{-- Munkaidő és anyagkövetés --}}
                <div
                    class="rounded-2xl border border-gray-100 bg-white p-8 shadow-sm transition-shadow hover:shadow-lg">
                    <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-xl bg-cyan-100">
                        <svg class="h-6 w-6 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="mb-3 text-xl font-semibold text-gray-900">Munkaidő és anyagkövetés</h3>
                    <ul class="space-y-2 text-gray-600">
                        <li class="flex items-start gap-2">
                            <svg class="mt-1 h-4 w-4 shrink-0 text-cyan-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            Pontos időnyilvántartás
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="mt-1 h-4 w-4 shrink-0 text-cyan-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            Felhasznált anyagok rögzítése
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="mt-1 h-4 w-4 shrink-0 text-cyan-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            Raktárkészlet-kapcsolat
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="mt-1 h-4 w-4 shrink-0 text-cyan-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            Automatikus költségkalkuláció
                        </li>
                    </ul>
                </div>

                {{-- Dokumentumkezelés és iratkövetés --}}
                <div
                    class="rounded-2xl border border-gray-100 bg-white p-8 shadow-sm transition-shadow hover:shadow-lg">
                    <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-xl bg-cyan-100">
                        <svg class="h-6 w-6 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>
                    <h3 class="mb-3 text-xl font-semibold text-gray-900">Dokumentumkezelés és iratkövetés</h3>
                    <ul class="space-y-2 text-gray-600">
                        <li class="flex items-start gap-2">
                            <svg class="mt-1 h-4 w-4 shrink-0 text-cyan-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            Dokumentum életciklus követés
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="mt-1 h-4 w-4 shrink-0 text-cyan-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            Automatikus időbélyeg
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="mt-1 h-4 w-4 shrink-0 text-cyan-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            Könnyű keresés
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="mt-1 h-4 w-4 shrink-0 text-cyan-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            Felhőalapú tárolás
                        </li>
                    </ul>
                </div>

                {{-- Digitális aláírás --}}
                <div
                    class="rounded-2xl border border-gray-100 bg-white p-8 shadow-sm transition-shadow hover:shadow-lg">
                    <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-xl bg-cyan-100">
                        <svg class="h-6 w-6 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                        </svg>
                    </div>
                    <h3 class="mb-3 text-xl font-semibold text-gray-900">Digitális aláírás</h3>
                    <ul class="space-y-2 text-gray-600">
                        <li class="flex items-start gap-2">
                            <svg class="mt-1 h-4 w-4 shrink-0 text-cyan-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            Ügyfél-aláírás helyszínen
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="mt-1 h-4 w-4 shrink-0 text-cyan-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            Jogilag elfogadott formátum
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="mt-1 h-4 w-4 shrink-0 text-cyan-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            Azonnali PDF-generálás
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="mt-1 h-4 w-4 shrink-0 text-cyan-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            E-mail küldés az ügyfélnek
                        </li>
                    </ul>
                </div>

                {{-- Ütemezés és diszpécser --}}
                <div
                    class="rounded-2xl border border-gray-100 bg-white p-8 shadow-sm transition-shadow hover:shadow-lg">
                    <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-xl bg-cyan-100">
                        <svg class="h-6 w-6 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <h3 class="mb-3 text-xl font-semibold text-gray-900">Ütemezés és diszpécser</h3>
                    <ul class="space-y-2 text-gray-600">
                        <li class="flex items-start gap-2">
                            <svg class="mt-1 h-4 w-4 shrink-0 text-cyan-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            Drag-and-drop naptár
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="mt-1 h-4 w-4 shrink-0 text-cyan-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            Szerelő-hozzárendelés
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="mt-1 h-4 w-4 shrink-0 text-cyan-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            Útvonaloptimalizálás
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="mt-1 h-4 w-4 shrink-0 text-cyan-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            Valós idejű státuszkövetés
                        </li>
                    </ul>
                </div>

                {{-- Riportok és elemzések --}}
                <div
                    class="rounded-2xl border border-gray-100 bg-white p-8 shadow-sm transition-shadow hover:shadow-lg">
                    <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-xl bg-cyan-100">
                        <svg class="h-6 w-6 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                    </div>
                    <h3 class="mb-3 text-xl font-semibold text-gray-900">Riportok és elemzések</h3>
                    <ul class="space-y-2 text-gray-600">
                        <li class="flex items-start gap-2">
                            <svg class="mt-1 h-4 w-4 shrink-0 text-cyan-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            Szerelői teljesítmény-kimutatás
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="mt-1 h-4 w-4 shrink-0 text-cyan-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            Anyagfelhasználási statisztikák
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="mt-1 h-4 w-4 shrink-0 text-cyan-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            Ügyfél-elégedettségi mérések
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="mt-1 h-4 w-4 shrink-0 text-cyan-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            Exportálás PDF/Excel
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    {{-- Results Section --}}
    <section class="bg-white py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto mb-12 max-w-3xl text-center">
                <h2 class="text-3xl font-semibold text-gray-900 sm:text-4xl">Eredmények számokban</h2>
                <p class="mt-4 text-lg text-gray-600">Amit ügyfeleink tapasztalnak a bevezetés után.</p>
            </div>

            <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-4">
                <div class="text-center">
                    <div class="mb-4 text-5xl font-bold text-cyan-600">70%</div>
                    <p class="text-lg font-medium text-gray-900">Gyorsabb adminisztráció</p>
                    <p class="mt-1 text-gray-600">Kevesebb papírmunka, több idő a munkára.</p>
                </div>
                <div class="text-center">
                    <div class="mb-4 text-5xl font-bold text-cyan-600">50%</div>
                    <p class="text-lg font-medium text-gray-900">Gyorsabb számlázás</p>
                    <p class="mt-1 text-gray-600">Azonnali munkalap = azonnali számla.</p>
                </div>
                <div class="text-center">
                    <div class="mb-4 text-5xl font-bold text-cyan-600">0</div>
                    <p class="text-lg font-medium text-gray-900">Elveszett munkalap</p>
                    <p class="mt-1 text-gray-600">Minden adat biztonságosan a felhőben.</p>
                </div>
                <div class="text-center">
                    <div class="mb-4 text-5xl font-bold text-cyan-600">100%</div>
                    <p class="text-lg font-medium text-gray-900">Átláthatóság</p>
                    <p class="mt-1 text-gray-600">Valós idejű rálátás minden munkára.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Who Uses Section --}}
    <section class="bg-gray-50 py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto mb-12 max-w-3xl text-center">
                <h2 class="text-3xl font-semibold text-gray-900 sm:text-4xl">Kiknek ajánljuk?</h2>
                <p class="mt-4 text-lg text-gray-600">Ideális megoldás helyszíni szolgáltatást nyújtó cégeknek.</p>
            </div>

            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                <div class="rounded-2xl bg-white p-6 shadow-sm">
                    <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-xl bg-cyan-100">
                        <svg class="h-6 w-6 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                    </div>
                    <h3 class="mb-2 text-lg font-semibold text-gray-900">Épületgépészeti cégek</h3>
                    <p class="text-gray-600">Fűtés, klíma, víz-gáz szerelés dokumentálása és elszámolása.</p>
                </div>
                <div class="rounded-2xl bg-white p-6 shadow-sm">
                    <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-xl bg-cyan-100">
                        <svg class="h-6 w-6 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                    <h3 class="mb-2 text-lg font-semibold text-gray-900">Villanyszerelők</h3>
                    <p class="text-gray-600">Elektromos munkák precíz dokumentálása és átadása.</p>
                </div>
                <div class="rounded-2xl bg-white p-6 shadow-sm">
                    <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-xl bg-cyan-100">
                        <svg class="h-6 w-6 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>
                    <h3 class="mb-2 text-lg font-semibold text-gray-900">Gépszerelők, karbantartók</h3>
                    <p class="text-gray-600">Ipari gépek karbantartásának nyomon követése.</p>
                </div>
                <div class="rounded-2xl bg-white p-6 shadow-sm">
                    <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-xl bg-cyan-100">
                        <svg class="h-6 w-6 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                    </div>
                    <h3 class="mb-2 text-lg font-semibold text-gray-900">Biztonságtechnikai cégek</h3>
                    <p class="text-gray-600">Riasztó- és kamerarendszerek telepítése, karbantartása.</p>
                </div>
                <div class="rounded-2xl bg-white p-6 shadow-sm">
                    <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-xl bg-cyan-100">
                        <svg class="h-6 w-6 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                    </div>
                    <h3 class="mb-2 text-lg font-semibold text-gray-900">Ingatlankezelők</h3>
                    <p class="text-gray-600">Épület-karbantartási munkák koordinálása és dokumentálása.</p>
                </div>
                <div class="rounded-2xl bg-white p-6 shadow-sm">
                    <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-xl bg-cyan-100">
                        <svg class="h-6 w-6 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z" />
                        </svg>
                    </div>
                    <h3 class="mb-2 text-lg font-semibold text-gray-900">IT szolgáltatók</h3>
                    <p class="text-gray-600">Helyszíni hardver- és szoftverszerviz dokumentálása.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Testimonial Section (hidden) --}}
    @if(false)
    <section class="bg-white py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto max-w-3xl text-center">
                <blockquote class="text-2xl font-medium text-gray-900 sm:text-3xl">
                    "Mióta digitális munkalapot használunk, a számlázásunk napokkal gyorsabb lett. Az ügyfelek is
                    elégedettebbek, mert azonnal kapják a jegyzőkönyvet."
                </blockquote>
                <div class="mt-8 flex items-center justify-center gap-4">
                    <div
                        class="flex h-12 w-12 items-center justify-center rounded-full bg-cyan-100 text-lg font-semibold text-cyan-700">
                        BL
                    </div>
                    <div class="text-left">
                        <p class="font-semibold text-gray-900">Balogh László</p>
                        <p class="text-gray-600">Ügyvezető, KlimaProfi Kft.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif

    {{-- Related Modules Section --}}
    <section class="bg-gray-50 py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto mb-12 max-w-3xl text-center">
                <h2 class="text-3xl font-semibold text-gray-900 sm:text-4xl">Kapcsolódó modulok</h2>
                <p class="mt-4 text-lg text-gray-600">Bővítse a Szerviz modult további funkcionalitással.</p>
            </div>

            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                <a href="{{ route('products.crm') }}"
                    class="group rounded-2xl bg-white p-6 shadow-sm transition-shadow hover:shadow-lg">
                    <div class="mb-4 flex items-center gap-3">
                        <x-module-icon module="crm" size="md" />
                        <h3 class="text-lg font-semibold text-gray-900 group-hover:text-cyan-600">CRM</h3>
                    </div>
                    <p class="text-gray-600">Kapcsolja össze a szervizmunkákat az ügyfélnyilvántartással és
                        szerződésekkel.</p>
                </a>
                <a href="{{ route('products.beszerzes') }}"
                    class="group rounded-2xl bg-white p-6 shadow-sm transition-shadow hover:shadow-lg">
                    <div class="mb-4 flex items-center gap-3">
                        <x-module-icon module="beszerzes" size="md" />
                        <h3 class="text-lg font-semibold text-gray-900 group-hover:text-cyan-600">Beszerzés-logisztika
                        </h3>
                    </div>
                    <p class="text-gray-600">Kezelje a felhasznált anyagokat és raktárkészletet integráltan.</p>
                </a>
                <a href="{{ route('products.kontrolling') }}"
                    class="group rounded-2xl bg-white p-6 shadow-sm transition-shadow hover:shadow-lg">
                    <div class="mb-4 flex items-center gap-3">
                        <x-module-icon module="kontrolling" size="md" />
                        <h3 class="text-lg font-semibold text-gray-900 group-hover:text-cyan-600">Kontrolling</h3>
                    </div>
                    <p class="text-gray-600">Elemezze a szervizmunkák jövedelmezőségét és költségeit.</p>
                </a>
            </div>
        </div>
    </section>

    {{-- CTA Section --}}
    <section class="bg-cyan-600 py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto max-w-3xl text-center">
                <h2 class="text-3xl font-semibold text-white sm:text-4xl">Készen áll a papírmentes szervizre?</h2>
                <p class="mt-4 text-lg text-cyan-100">Teljes funkcionalitás, magyar nyelvű támogatás. Kérjen személyre szabott bemutatót.</p>
                <div class="mt-8 flex flex-col items-center justify-center gap-4 sm:flex-row">
                    <a href="{{ route('register') }}"
                        class="inline-flex items-center justify-center gap-2 rounded-full bg-white px-8 py-4 text-base font-semibold text-cyan-700 shadow-lg transition-colors hover:bg-cyan-50 hover:shadow-xl">
                        Kezdés indítása
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </a>
                    <a href="{{ route('contact') }}"
                        class="inline-flex items-center justify-center gap-2 rounded-full border-2 border-white bg-transparent px-8 py-4 text-base font-semibold text-white transition-colors hover:bg-white/10">
                        Demó kérése
                    </a>
                    <a href="{{ route('login') }}"
                        class="inline-flex items-center justify-center gap-2 text-base font-medium text-cyan-200 transition-colors hover:text-white">
                        Bejelentkezés a programba →
                    </a>
                </div>
            </div>
        </div>
    </section>
</div>
