<div>
    {{-- Hero Section --}}
    <section class="bg-linear-to-b from-violet-50 to-white py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto max-w-4xl text-center">
                <div class="mb-6 flex justify-center">
                    <x-module-icon module="automatizalas" size="xl" />
                </div>

                <div class="mb-6 inline-flex items-center gap-2 rounded-full bg-violet-100 px-4 py-1.5 text-sm font-medium text-violet-700">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                    Intelligens uzleti automatizacio
                </div>

                <h1 class="mb-6 text-4xl font-bold tracking-tight text-gray-900 sm:text-5xl lg:text-6xl">
                    Automatizalja uzleti
                    <span class="text-violet-600">folyamatait</span>
                </h1>

                <p class="mx-auto mb-10 max-w-2xl text-lg text-gray-600 sm:text-xl">
                    Szabaduljon meg az ismetlodo manualis feladatoktol. Az Automatizalas modul
                    intelligens workflow-kkal es triggerekkel optimalizalja vallalkozasa mukodeset.
                </p>

                <div class="flex flex-col justify-center gap-4 sm:flex-row">
                    <a href="{{ route('register') }}" class="inline-flex items-center justify-center gap-2 rounded-lg bg-violet-600 px-8 py-4 text-base font-semibold text-white shadow-lg transition hover:bg-violet-700">
                        Ingyenes kiproblas
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                        </svg>
                    </a>
                    <a href="{{ route('quote-request') }}" class="inline-flex items-center justify-center gap-2 rounded-lg border-2 border-gray-200 bg-white px-8 py-4 text-base font-semibold text-gray-700 transition hover:border-violet-200 hover:bg-violet-50">
                        <svg class="h-5 w-5 text-violet-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Demo video megtekintese
                    </a>
                </div>

                <div class="mt-12 flex flex-wrap items-center justify-center gap-x-8 gap-y-4 text-sm text-gray-500">
                    <div class="flex items-center gap-2">
                        <svg class="h-5 w-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Nincs bankkartya szukseges
                    </div>
                    <div class="flex items-center gap-2">
                        <svg class="h-5 w-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Percek alatt bevezetheto
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Problem Section --}}
    <section class="bg-gray-50 py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto max-w-3xl text-center">
                <h2 class="mb-4 text-3xl font-bold text-gray-900 sm:text-4xl">
                    Ismeros problemak?
                </h2>
                <p class="text-lg text-gray-600">
                    A manualis, ismetlodo feladatok rengeteg idot es energiat emesztenek fel.
                </p>
            </div>

            <div class="mt-12 grid gap-8 md:grid-cols-2 lg:grid-cols-4">
                <div class="rounded-xl bg-white p-6 shadow-sm">
                    <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-lg bg-red-100">
                        <svg class="h-6 w-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="mb-2 font-semibold text-gray-900">Ismetlodo feladatok</h3>
                    <p class="text-sm text-gray-600">Munkatarsai napi szinten ugyanazokat a manualis lepeseket hajtjak vegre ujra es ujra.</p>
                </div>

                <div class="rounded-xl bg-white p-6 shadow-sm">
                    <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-lg bg-red-100">
                        <svg class="h-6 w-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                    </div>
                    <h3 class="mb-2 font-semibold text-gray-900">Emberi hibak</h3>
                    <p class="text-sm text-gray-600">A manualis adatrogzites es -atadas soran gyakran elofordulnak elfelejtett vagy hibas muveletek.</p>
                </div>

                <div class="rounded-xl bg-white p-6 shadow-sm">
                    <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-lg bg-red-100">
                        <svg class="h-6 w-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 17h8m0 0V9m0 8l-8-8-4 4-6-6" />
                        </svg>
                    </div>
                    <h3 class="mb-2 font-semibold text-gray-900">Lassu folyamatok</h3>
                    <p class="text-sm text-gray-600">Az informaciok kesve jutnak el a megfelelo szemelyek szamara, ami lassitja a donteshozatalt.</p>
                </div>

                <div class="rounded-xl bg-white p-6 shadow-sm">
                    <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-lg bg-red-100">
                        <svg class="h-6 w-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="mb-2 font-semibold text-gray-900">Motivalatlan csapat</h3>
                    <p class="text-sm text-gray-600">Az unalmas, ismetlodo feladatok csokentik a munkatarsak elegedettsegenet es hatekonysagat.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Features Section --}}
    <section class="py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto max-w-3xl text-center">
                <div class="mb-4 inline-flex items-center gap-2 rounded-full bg-violet-100 px-4 py-1.5 text-sm font-medium text-violet-700">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                    </svg>
                    Funkciok
                </div>
                <h2 class="mb-4 text-3xl font-bold text-gray-900 sm:text-4xl">
                    Minden amire szuksege van az automatizalashoz
                </h2>
                <p class="text-lg text-gray-600">
                    Atfogo eszkoztar a munkafolyamatok automatizalasahoz es optimalizalasahoz.
                </p>
            </div>

            <div class="mt-16 grid gap-8 md:grid-cols-2 lg:grid-cols-3">
                {{-- Feature 1 --}}
                <div class="rounded-2xl border border-gray-100 bg-white p-8 shadow-sm transition hover:shadow-md">
                    <div class="mb-6 flex h-14 w-14 items-center justify-center rounded-xl bg-violet-100">
                        <svg class="h-7 w-7 text-violet-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                        </svg>
                    </div>
                    <h3 class="mb-3 text-xl font-semibold text-gray-900">Workflow builder</h3>
                    <p class="mb-4 text-gray-600">
                        Vizualis drag-and-drop feluleten tervezze meg uzleti folyamatait programozas nelkul.
                    </p>
                    <ul class="space-y-2 text-sm text-gray-600">
                        <li class="flex items-center gap-2">
                            <svg class="h-4 w-4 text-violet-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Drag-and-drop szerkeszto
                        </li>
                        <li class="flex items-center gap-2">
                            <svg class="h-4 w-4 text-violet-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Elagazasok es feltetelrendszer
                        </li>
                        <li class="flex items-center gap-2">
                            <svg class="h-4 w-4 text-violet-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Sablonok es peldak
                        </li>
                    </ul>
                </div>

                {{-- Feature 2 --}}
                <div class="rounded-2xl border border-gray-100 bg-white p-8 shadow-sm transition hover:shadow-md">
                    <div class="mb-6 flex h-14 w-14 items-center justify-center rounded-xl bg-violet-100">
                        <svg class="h-7 w-7 text-violet-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                        </svg>
                    </div>
                    <h3 class="mb-3 text-xl font-semibold text-gray-900">Triggerek es esemenyek</h3>
                    <p class="mb-4 text-gray-600">
                        Allitson be automatikus akciokat, amelyek esemenyek bekovetkeztekor futnak le.
                    </p>
                    <ul class="space-y-2 text-sm text-gray-600">
                        <li class="flex items-center gap-2">
                            <svg class="h-4 w-4 text-violet-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Idobalapusok es utemezettek
                        </li>
                        <li class="flex items-center gap-2">
                            <svg class="h-4 w-4 text-violet-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Adatvaltozoson alapulo
                        </li>
                        <li class="flex items-center gap-2">
                            <svg class="h-4 w-4 text-violet-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Felhasznaloi akcio alapu
                        </li>
                    </ul>
                </div>

                {{-- Feature 3 --}}
                <div class="rounded-2xl border border-gray-100 bg-white p-8 shadow-sm transition hover:shadow-md">
                    <div class="mb-6 flex h-14 w-14 items-center justify-center rounded-xl bg-violet-100">
                        <svg class="h-7 w-7 text-violet-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <h3 class="mb-3 text-xl font-semibold text-gray-900">Automatikus ertesitesek</h3>
                    <p class="mb-4 text-gray-600">
                        Kuldjod automatikusan emaileket, SMS-eket vagy rendszer-ertesiteseket az esemenyekrol.
                    </p>
                    <ul class="space-y-2 text-sm text-gray-600">
                        <li class="flex items-center gap-2">
                            <svg class="h-4 w-4 text-violet-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Email sablonok
                        </li>
                        <li class="flex items-center gap-2">
                            <svg class="h-4 w-4 text-violet-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            SMS es push ertesitesek
                        </li>
                        <li class="flex items-center gap-2">
                            <svg class="h-4 w-4 text-violet-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Slack es Teams integracio
                        </li>
                    </ul>
                </div>

                {{-- Feature 4 --}}
                <div class="rounded-2xl border border-gray-100 bg-white p-8 shadow-sm transition hover:shadow-md">
                    <div class="mb-6 flex h-14 w-14 items-center justify-center rounded-xl bg-violet-100">
                        <svg class="h-7 w-7 text-violet-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <h3 class="mb-3 text-xl font-semibold text-gray-900">Dokumentum generalas</h3>
                    <p class="mb-4 text-gray-600">
                        Hozzon letre automatikusan szamlakat, szerzodeseeket, jelenteseket es mas dokumentumokat.
                    </p>
                    <ul class="space-y-2 text-sm text-gray-600">
                        <li class="flex items-center gap-2">
                            <svg class="h-4 w-4 text-violet-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            PDF es Word export
                        </li>
                        <li class="flex items-center gap-2">
                            <svg class="h-4 w-4 text-violet-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Testreszabhato sablonok
                        </li>
                        <li class="flex items-center gap-2">
                            <svg class="h-4 w-4 text-violet-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Automatikus szamozas
                        </li>
                    </ul>
                </div>

                {{-- Feature 5 --}}
                <div class="rounded-2xl border border-gray-100 bg-white p-8 shadow-sm transition hover:shadow-md">
                    <div class="mb-6 flex h-14 w-14 items-center justify-center rounded-xl bg-violet-100">
                        <svg class="h-7 w-7 text-violet-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" />
                        </svg>
                    </div>
                    <h3 class="mb-3 text-xl font-semibold text-gray-900">Adatszinkronizalas</h3>
                    <p class="mb-4 text-gray-600">
                        Tartsa szinkronban az adatokat a kulonbozo modulok es kulso rendszerek kozott.
                    </p>
                    <ul class="space-y-2 text-sm text-gray-600">
                        <li class="flex items-center gap-2">
                            <svg class="h-4 w-4 text-violet-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Ket- es egyiranyu szinkron
                        </li>
                        <li class="flex items-center gap-2">
                            <svg class="h-4 w-4 text-violet-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Adatlekepezesek
                        </li>
                        <li class="flex items-center gap-2">
                            <svg class="h-4 w-4 text-violet-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Konfliktuskezeles
                        </li>
                    </ul>
                </div>

                {{-- Feature 6 --}}
                <div class="rounded-2xl border border-gray-100 bg-white p-8 shadow-sm transition hover:shadow-md">
                    <div class="mb-6 flex h-14 w-14 items-center justify-center rounded-xl bg-violet-100">
                        <svg class="h-7 w-7 text-violet-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                    </div>
                    <h3 class="mb-3 text-xl font-semibold text-gray-900">Automatizalasi riportok</h3>
                    <p class="mb-4 text-gray-600">
                        Kovesse nyomon az automatizaciok teljesitmenyet es azonositsa az optimalizalasi lehetosegeket.
                    </p>
                    <ul class="space-y-2 text-sm text-gray-600">
                        <li class="flex items-center gap-2">
                            <svg class="h-4 w-4 text-violet-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Futasi statisztikak
                        </li>
                        <li class="flex items-center gap-2">
                            <svg class="h-4 w-4 text-violet-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Hibajelentesek
                        </li>
                        <li class="flex items-center gap-2">
                            <svg class="h-4 w-4 text-violet-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Idomegtalkaritas meroszamok
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    {{-- Results Section --}}
    <section class="bg-violet-600 py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto max-w-3xl text-center">
                <h2 class="mb-4 text-3xl font-bold text-white sm:text-4xl">
                    Merheto eredmenyek
                </h2>
                <p class="text-lg text-violet-100">
                    Ugyfeleink altal elert atlagos javulasok az automatizacio bevezetesenek elso 6 honapjaban.
                </p>
            </div>

            <div class="mt-12 grid gap-8 sm:grid-cols-2 lg:grid-cols-5">
                <div class="rounded-xl bg-white/10 p-6 text-center backdrop-blur-sm">
                    <div class="mb-2 text-4xl font-bold text-white">75%</div>
                    <div class="text-sm text-violet-100">Kevesebb manualis feladat</div>
                </div>
                <div class="rounded-xl bg-white/10 p-6 text-center backdrop-blur-sm">
                    <div class="mb-2 text-4xl font-bold text-white">60%</div>
                    <div class="text-sm text-violet-100">Gyorsabb folyamatok</div>
                </div>
                <div class="rounded-xl bg-white/10 p-6 text-center backdrop-blur-sm">
                    <div class="mb-2 text-4xl font-bold text-white">90%</div>
                    <div class="text-sm text-violet-100">Kevesebb emberi hiba</div>
                </div>
                <div class="rounded-xl bg-white/10 p-6 text-center backdrop-blur-sm">
                    <div class="mb-2 text-4xl font-bold text-white">40%</div>
                    <div class="text-sm text-violet-100">Tobbb idomegtakaritas</div>
                </div>
                <div class="rounded-xl bg-white/10 p-6 text-center backdrop-blur-sm">
                    <div class="mb-2 text-4xl font-bold text-white">3x</div>
                    <div class="text-sm text-violet-100">ROI 12 honap alatt</div>
                </div>
            </div>
        </div>
    </section>

    {{-- Integrations Section --}}
    <section class="py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto max-w-3xl text-center">
                <div class="mb-4 inline-flex items-center gap-2 rounded-full bg-violet-100 px-4 py-1.5 text-sm font-medium text-violet-700">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
                    </svg>
                    Integraciok
                </div>
                <h2 class="mb-4 text-3xl font-bold text-gray-900 sm:text-4xl">
                    Kapcsolodjon kedvenc eszkozeihez
                </h2>
                <p class="text-lg text-gray-600">
                    Automatizalja a munkafolyamatokat a mar hasznalt rendszerekkel.
                </p>
            </div>

            <div class="mt-12 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                <div class="flex items-center gap-4 rounded-xl border border-gray-100 bg-white p-6 shadow-sm">
                    <div class="flex h-12 w-12 items-center justify-center rounded-lg bg-gray-100">
                        <svg class="h-6 w-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-900">Email szolgaltatok</h3>
                        <p class="text-sm text-gray-600">Gmail, Outlook, SMTP</p>
                    </div>
                </div>

                <div class="flex items-center gap-4 rounded-xl border border-gray-100 bg-white p-6 shadow-sm">
                    <div class="flex h-12 w-12 items-center justify-center rounded-lg bg-gray-100">
                        <svg class="h-6 w-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-900">Kommunikacio</h3>
                        <p class="text-sm text-gray-600">Slack, Teams, Discord</p>
                    </div>
                </div>

                <div class="flex items-center gap-4 rounded-xl border border-gray-100 bg-white p-6 shadow-sm">
                    <div class="flex h-12 w-12 items-center justify-center rounded-lg bg-gray-100">
                        <svg class="h-6 w-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-900">Felhototarhelyek</h3>
                        <p class="text-sm text-gray-600">Google Drive, Dropbox, OneDrive</p>
                    </div>
                </div>

                <div class="flex items-center gap-4 rounded-xl border border-gray-100 bg-white p-6 shadow-sm">
                    <div class="flex h-12 w-12 items-center justify-center rounded-lg bg-gray-100">
                        <svg class="h-6 w-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-900">Penzugyi rendszerek</h3>
                        <p class="text-sm text-gray-600">NAV, Szamlazo, Billingo</p>
                    </div>
                </div>

                <div class="flex items-center gap-4 rounded-xl border border-gray-100 bg-white p-6 shadow-sm">
                    <div class="flex h-12 w-12 items-center justify-center rounded-lg bg-gray-100">
                        <svg class="h-6 w-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-900">Webhook es API</h3>
                        <p class="text-sm text-gray-600">REST API, Webhooks, Zapier</p>
                    </div>
                </div>

                <div class="flex items-center gap-4 rounded-xl border border-gray-100 bg-white p-6 shadow-sm">
                    <div class="flex h-12 w-12 items-center justify-center rounded-lg bg-gray-100">
                        <svg class="h-6 w-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-900">Naptarak</h3>
                        <p class="text-sm text-gray-600">Google Calendar, Outlook</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Who Uses Section --}}
    <section class="bg-gray-50 py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto max-w-3xl text-center">
                <h2 class="mb-4 text-3xl font-bold text-gray-900 sm:text-4xl">
                    Kiknek keszult?
                </h2>
                <p class="text-lg text-gray-600">
                    Az Automatizalas modul minden olyan csapat szamara idealis, akik hatekonyabban szeretnenek dolgozni.
                </p>
            </div>

            <div class="mt-12 grid gap-8 sm:grid-cols-2 lg:grid-cols-4">
                <div class="rounded-xl bg-white p-6 shadow-sm">
                    <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-lg bg-violet-100">
                        <svg class="h-6 w-6 text-violet-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                    </div>
                    <h3 class="mb-2 font-semibold text-gray-900">Irodavezetok</h3>
                    <p class="text-sm text-gray-600">Automatizaljak az adminisztrativ feladatokat es a csapaton beluli kommunikaciot.</p>
                </div>

                <div class="rounded-xl bg-white p-6 shadow-sm">
                    <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-lg bg-violet-100">
                        <svg class="h-6 w-6 text-violet-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                        </svg>
                    </div>
                    <h3 class="mb-2 font-semibold text-gray-900">Folyamatmenedzserek</h3>
                    <p class="text-sm text-gray-600">Optimalizaljak es automatizaljak a vallalati uzleti folyamatokat.</p>
                </div>

                <div class="rounded-xl bg-white p-6 shadow-sm">
                    <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-lg bg-violet-100">
                        <svg class="h-6 w-6 text-violet-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>
                    <h3 class="mb-2 font-semibold text-gray-900">IT csapatok</h3>
                    <p class="text-sm text-gray-600">Integraciot es rendszerautomatizaciot valositanak meg a vallalaton belul.</p>
                </div>

                <div class="rounded-xl bg-white p-6 shadow-sm">
                    <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-lg bg-violet-100">
                        <svg class="h-6 w-6 text-violet-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                        </svg>
                    </div>
                    <h3 class="mb-2 font-semibold text-gray-900">Vallalkozok</h3>
                    <p class="text-sm text-gray-600">Kevesebb eroforrassal tobbet ernek el a mindennapi mukodesben.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Testimonials Section --}}
    <section class="py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto max-w-3xl text-center">
                <h2 class="mb-4 text-3xl font-bold text-gray-900 sm:text-4xl">
                    Ugyfeleink velemenye
                </h2>
                <p class="text-lg text-gray-600">
                    Ismerje meg, hogyan segitette az Automatizalas modul mas vallalkozasokat.
                </p>
            </div>

            <div class="mt-12 grid gap-8 lg:grid-cols-2">
                <div class="rounded-2xl bg-gray-50 p-8">
                    <div class="mb-6 flex items-center gap-1">
                        @for ($i = 0; $i < 5; $i++)
                            <svg class="h-5 w-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg>
                        @endfor
                    </div>
                    <blockquote class="mb-6 text-gray-700">
                        "Az automatizalas bevezetesenek elott a csapatunk napi 3-4 orat toltott ismetlodo adminisztrativ feladatokkal. Ma mar ezek tobbsege automatikusan tortenik, es a kollegak ertekesebb munkara tudnak koncentralni."
                    </blockquote>
                    <div class="flex items-center gap-4">
                        <div class="flex h-12 w-12 items-center justify-center rounded-full bg-violet-200 font-semibold text-violet-700">
                            NK
                        </div>
                        <div>
                            <div class="font-semibold text-gray-900">Nagy Katalin</div>
                            <div class="text-sm text-gray-600">Operacios igazgato, LogiTech Kft.</div>
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
                        "A workflow-ket kezdetben szepenszepen, egyenkent allitottuk be, de mar az elso honapban 90%-kal csokkent az emberi hibak szama. A rendszer megbizhatoan mukodik, es a csapat motivaltabb lett."
                    </blockquote>
                    <div class="flex items-center gap-4">
                        <div class="flex h-12 w-12 items-center justify-center rounded-full bg-violet-200 font-semibold text-violet-700">
                            FT
                        </div>
                        <div>
                            <div class="font-semibold text-gray-900">Feher Tamas</div>
                            <div class="text-sm text-gray-600">IT vezeto, MediaPrint Zrt.</div>
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
                    Valassza ki a megfelelo csomagot
                </h2>
                <p class="text-lg text-gray-600">
                    Rugalmas araink minden meretuvallalatszamaraeelerhetok.
                </p>
            </div>

            <div class="mt-12 grid gap-8 lg:grid-cols-3">
                {{-- Starter --}}
                <div class="rounded-2xl border border-gray-200 bg-white p-8 shadow-sm">
                    <h3 class="mb-2 text-xl font-semibold text-gray-900">Starter</h3>
                    <p class="mb-6 text-sm text-gray-600">Kis csapatok szamara</p>
                    <div class="mb-6">
                        <span class="text-4xl font-bold text-gray-900">19.900</span>
                        <span class="text-gray-600"> Ft/ho</span>
                    </div>
                    <ul class="mb-8 space-y-3 text-sm text-gray-600">
                        <li class="flex items-center gap-2">
                            <svg class="h-5 w-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            10 aktiv workflow
                        </li>
                        <li class="flex items-center gap-2">
                            <svg class="h-5 w-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            1.000 trigger/ho
                        </li>
                        <li class="flex items-center gap-2">
                            <svg class="h-5 w-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Email ertesitesek
                        </li>
                        <li class="flex items-center gap-2">
                            <svg class="h-5 w-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Alap riportok
                        </li>
                    </ul>
                    <a href="{{ route('register') }}" class="block w-full rounded-lg border-2 border-violet-600 py-3 text-center font-semibold text-violet-600 transition hover:bg-violet-50">
                        Ingyenes proba
                    </a>
                </div>

                {{-- Professional --}}
                <div class="relative rounded-2xl border-2 border-violet-600 bg-white p-8 shadow-lg">
                    <div class="absolute -top-4 left-1/2 -translate-x-1/2 rounded-full bg-violet-600 px-4 py-1 text-sm font-semibold text-white">
                        Legnepszerubb
                    </div>
                    <h3 class="mb-2 text-xl font-semibold text-gray-900">Professional</h3>
                    <p class="mb-6 text-sm text-gray-600">Novekvo vallalkozasok szamara</p>
                    <div class="mb-6">
                        <span class="text-4xl font-bold text-gray-900">49.900</span>
                        <span class="text-gray-600"> Ft/ho</span>
                    </div>
                    <ul class="mb-8 space-y-3 text-sm text-gray-600">
                        <li class="flex items-center gap-2">
                            <svg class="h-5 w-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Korlatlan workflow
                        </li>
                        <li class="flex items-center gap-2">
                            <svg class="h-5 w-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            10.000 trigger/ho
                        </li>
                        <li class="flex items-center gap-2">
                            <svg class="h-5 w-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Email + SMS ertesitesek
                        </li>
                        <li class="flex items-center gap-2">
                            <svg class="h-5 w-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Webhook integraciok
                        </li>
                        <li class="flex items-center gap-2">
                            <svg class="h-5 w-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Reszletes analitika
                        </li>
                    </ul>
                    <a href="{{ route('register') }}" class="block w-full rounded-lg bg-violet-600 py-3 text-center font-semibold text-white transition hover:bg-violet-700">
                        Ingyenes proba
                    </a>
                </div>

                {{-- Egyedi ajánlat --}}
                <div class="rounded-2xl border border-gray-200 bg-white p-8 shadow-sm">
                    <h3 class="mb-2 text-xl font-semibold text-gray-900">Egyedi ajánlat</h3>
                    <p class="mb-6 text-sm text-gray-600">Nagyvallalatok szamara</p>
                    <div class="mb-6">
                        <span class="text-4xl font-bold text-gray-900">Egyedi</span>
                    </div>
                    <ul class="mb-8 space-y-3 text-sm text-gray-600">
                        <li class="flex items-center gap-2">
                            <svg class="h-5 w-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Korlatlan minden
                        </li>
                        <li class="flex items-center gap-2">
                            <svg class="h-5 w-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Dedikalt szerver
                        </li>
                        <li class="flex items-center gap-2">
                            <svg class="h-5 w-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Egyedi integraciok
                        </li>
                        <li class="flex items-center gap-2">
                            <svg class="h-5 w-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            24/7 premium tamogatas
                        </li>
                        <li class="flex items-center gap-2">
                            <svg class="h-5 w-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            SLA garancia
                        </li>
                    </ul>
                    <a href="{{ route('quote-request') }}" class="block w-full rounded-lg border-2 border-violet-600 py-3 text-center font-semibold text-violet-600 transition hover:bg-violet-50">
                        Kapcsolatfelvetel
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{-- Related Modules Section --}}
    <section class="py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto max-w-3xl text-center">
                <h2 class="mb-4 text-3xl font-bold text-gray-900 sm:text-4xl">
                    Kapcsolodo modulok
                </h2>
                <p class="text-lg text-gray-600">
                    Bovitse az Automatizalas modult mas Cegem360 modulokkal a teljes koru mukodes erdekeben.
                </p>
            </div>

            <div class="mt-12 grid gap-8 md:grid-cols-2">
                <a href="{{ route('products.crm') }}" class="group flex gap-6 rounded-2xl border border-gray-100 bg-white p-6 shadow-sm transition hover:shadow-md">
                    <div class="flex h-16 w-16 shrink-0 items-center justify-center rounded-xl bg-sky-100">
                        <x-module-icon module="crm" size="lg" />
                    </div>
                    <div>
                        <h3 class="mb-2 text-xl font-semibold text-gray-900 group-hover:text-sky-600">CRM</h3>
                        <p class="text-gray-600">Automatizalja az ugyfelkapcsolati folyamatokat: follow-up emailek, lead pontozas, feladat-hozzarendelesek.</p>
                    </div>
                </a>

                <a href="{{ route('products.gyartas') }}" class="group flex gap-6 rounded-2xl border border-gray-100 bg-white p-6 shadow-sm transition hover:shadow-md">
                    <div class="flex h-16 w-16 shrink-0 items-center justify-center rounded-xl bg-indigo-100">
                        <x-module-icon module="gyartas" size="lg" />
                    </div>
                    <div>
                        <h3 class="mb-2 text-xl font-semibold text-gray-900 group-hover:text-indigo-600">Gyartasiranitas</h3>
                        <p class="text-gray-600">Automatizalja a gyartasi folyamatokat: munkautasitasok generalasa, minoseg-ellenorzesi riasztasok.</p>
                    </div>
                </a>
            </div>
        </div>
    </section>

    {{-- Bottom CTA Section --}}
    <section class="bg-linear-to-br from-violet-600 to-violet-800 py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto max-w-3xl text-center">
                <h2 class="mb-6 text-3xl font-bold text-white sm:text-4xl">
                    Keszenkera folyamatok automatizalasara?
                </h2>
                <p class="mb-10 text-lg text-violet-100">
                    Probalja ki az Automatizalas modult 14 napig ingyen, es tapasztalja meg, milyen konnyu automatizalni.
                </p>
                <div class="flex flex-col justify-center gap-4 sm:flex-row">
                    <a href="{{ route('register') }}" class="inline-flex items-center justify-center gap-2 rounded-lg bg-white px-8 py-4 text-base font-semibold text-violet-600 shadow-lg transition hover:bg-gray-50">
                        Ingyenes kiproblas
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                        </svg>
                    </a>
                    <a href="{{ route('quote-request') }}" class="inline-flex items-center justify-center gap-2 rounded-lg border-2 border-white/30 px-8 py-4 text-base font-semibold text-white transition hover:bg-white/10">
                        Demo kerese
                    </a>
                </div>
            </div>
        </div>
    </section>
</div>
