<div x-data="{
    activeFilter: 'all',
    countersAnimated: false,
    animateCounters() {
        if (this.countersAnimated) return;
        this.countersAnimated = true;
        this.$root.querySelectorAll('[data-count]').forEach(el => {
            const target = el.dataset.count;
            const isPrefix = el.dataset.prefix || '';
            const isSuffix = el.dataset.suffix || '';
            const duration = 1500;
            const steps = 40;
            const stepTime = duration / steps;
            const isNumber = !isNaN(parseFloat(target));

            if (isNumber) {
                const end = parseFloat(target);
                let current = 0;
                const increment = end / steps;
                const timer = setInterval(() => {
                    current += increment;
                    if (current >= end) {
                        current = end;
                        clearInterval(timer);
                    }
                    el.textContent = isPrefix + (Number.isInteger(end) ? Math.round(current) : current.toFixed(0)) + isSuffix;
                }, stepTime);
            } else {
                el.textContent = isPrefix + target + isSuffix;
            }
        });
    }
}" x-init="
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('revealed');
                if (entry.target.hasAttribute('data-stagger')) {
                    entry.target.querySelectorAll('.stagger-item').forEach((child, i) => {
                        setTimeout(() => child.classList.add('revealed'), i * 80);
                    });
                }
                if (entry.target.hasAttribute('data-counter-trigger')) {
                    animateCounters();
                }
            }
        });
    }, { threshold: 0.1, rootMargin: '0px 0px -60px 0px' });

    $root.querySelectorAll('.reveal, .reveal-left, .reveal-right, .reveal-scale, [data-stagger], [data-counter-trigger]').forEach(el => observer.observe(el));
">

    {{-- Scoped Animation Styles --}}
    <style>
        .reveal { opacity: 0; transform: translateY(28px); transition: opacity 0.7s cubic-bezier(0,0,0.2,1), transform 0.7s cubic-bezier(0,0,0.2,1); }
        .reveal.revealed { opacity: 1; transform: translateY(0); }
        .reveal-left { opacity: 0; transform: translateX(-32px); transition: opacity 0.7s cubic-bezier(0,0,0.2,1), transform 0.7s cubic-bezier(0,0,0.2,1); }
        .reveal-left.revealed { opacity: 1; transform: translateX(0); }
        .reveal-right { opacity: 0; transform: translateX(32px); transition: opacity 0.7s cubic-bezier(0,0,0.2,1), transform 0.7s cubic-bezier(0,0,0.2,1); }
        .reveal-right.revealed { opacity: 1; transform: translateX(0); }
        .reveal-scale { opacity: 0; transform: scale(0.92); transition: opacity 0.6s cubic-bezier(0,0,0.2,1), transform 0.6s cubic-bezier(0,0,0.2,1); }
        .reveal-scale.revealed { opacity: 1; transform: scale(1); }
        .stagger-item { opacity: 0; transform: translateY(20px); transition: opacity 0.5s cubic-bezier(0,0,0.2,1), transform 0.5s cubic-bezier(0,0,0.2,1); }
        .stagger-item.revealed { opacity: 1; transform: translateY(0); }

        @keyframes gradient-shift { 0%, 100% { background-position: 0% 50%; } 50% { background-position: 100% 50%; } }
        .badge-gradient { background-size: 200% 200%; animation: gradient-shift 3s ease infinite; }

        .card-glow { transition: all 0.4s cubic-bezier(0,0,0.2,1); }
        .card-glow:hover { box-shadow: 0 8px 30px -8px rgba(249, 115, 22, 0.15), 0 2px 8px rgba(0,0,0,0.04) !important; transform: translateY(-4px); }

        .icon-hover { transition: transform 0.35s cubic-bezier(0,0,0.2,1.4); }
        .group:hover .icon-hover, .card-glow:hover .icon-hover { transform: translateY(-3px) scale(1.08); }

        .arrow-slide { transition: transform 0.3s cubic-bezier(0,0,0.2,1); }
        .group:hover .arrow-slide, a:hover .arrow-slide { transform: translateX(4px); }

        .stat-hover .stat-value { transition: transform 0.4s cubic-bezier(0,0,0.2,1.4); }
        .stat-hover:hover .stat-value { transform: scale(1.08); }

        html { scroll-behavior: smooth; }
    </style>

    {{-- Hero Section --}}
    <section class="bg-linear-to-b from-orange-50 to-surface-secondary">
        <div class="mx-auto max-w-7xl px-6 py-16 lg:py-24">
            <div class="reveal mx-auto max-w-3xl text-center">
                <div class="badge-gradient mb-8 inline-flex items-center gap-2 rounded-full border border-border-light/80 bg-surface-primary px-4 py-1.5"
                    style="box-shadow: 0 1px 3px rgba(0,0,0,0.04);">
                    <span class="text-sm font-medium text-text-primary">Cég &middot; Ügyfélsztorik</span>
                </div>

                <h1 class="mb-6 text-4xl leading-tight tracking-tight text-text-primary md:text-5xl lg:text-[3.5rem]"
                    style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                    Valós eredmények,<br>
                    valós ipari cégektől
                </h1>

                <p class="mx-auto mb-10 max-w-2xl text-lg text-text-secondary lg:text-xl">
                    Nem mi mondjuk, hogy működik — az ügyfeleink mondják. Ezek a sztorik arról szólnak, hogyan változtatta meg a Cégem360 a napi munkát: kevesebb papír, gyorsabb döntés, több idő arra, ami számít.
                </p>

                {{-- Filter bar --}}
                <div class="flex flex-wrap items-center justify-center gap-2">
                    <button class="rounded-full border px-4 py-2 text-sm font-semibold transition-all"
                        :class="activeFilter === 'all' ? 'border-orange-300 bg-orange-50 text-orange-700' : 'border-border-light bg-surface-primary text-text-secondary hover:border-border-default hover:text-text-primary'"
                        @click="activeFilter = 'all'">
                        Összes
                    </button>
                    <button class="rounded-full border px-4 py-2 text-sm font-semibold transition-all"
                        :class="activeFilter === 'gyartas' ? 'border-orange-300 bg-orange-50 text-orange-700' : 'border-border-light bg-surface-primary text-text-secondary hover:border-border-default hover:text-text-primary'"
                        @click="activeFilter = 'gyartas'">
                        Gyártás
                    </button>
                    <button class="rounded-full border px-4 py-2 text-sm font-semibold transition-all"
                        :class="activeFilter === 'szerviz' ? 'border-orange-300 bg-orange-50 text-orange-700' : 'border-border-light bg-surface-primary text-text-secondary hover:border-border-default hover:text-text-primary'"
                        @click="activeFilter = 'szerviz'">
                        Szerviz &amp; Karbantartás
                    </button>
                    <button class="rounded-full border px-4 py-2 text-sm font-semibold transition-all"
                        :class="activeFilter === 'kereskedelem' ? 'border-orange-300 bg-orange-50 text-orange-700' : 'border-border-light bg-surface-primary text-text-secondary hover:border-border-default hover:text-text-primary'"
                        @click="activeFilter = 'kereskedelem'">
                        Kereskedelem
                    </button>
                    <button class="rounded-full border px-4 py-2 text-sm font-semibold transition-all"
                        :class="activeFilter === 'epitoipar' ? 'border-orange-300 bg-orange-50 text-orange-700' : 'border-border-light bg-surface-primary text-text-secondary hover:border-border-default hover:text-text-primary'"
                        @click="activeFilter = 'epitoipar'">
                        Építőipar
                    </button>
                    <button class="rounded-full border px-4 py-2 text-sm font-semibold transition-all"
                        :class="activeFilter === 'szolgaltatas' ? 'border-orange-300 bg-orange-50 text-orange-700' : 'border-border-light bg-surface-primary text-text-secondary hover:border-border-default hover:text-text-primary'"
                        @click="activeFilter = 'szolgaltatas'">
                        Szolgáltatás
                    </button>
                </div>
            </div>
        </div>
    </section>

    {{-- Story Cards Section --}}
    <section class="bg-surface-secondary py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-6">
            <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3" data-stagger>

                {{-- Story 1: Gyártás --}}
                <article class="stagger-item card-glow flex flex-col overflow-hidden rounded-2xl border border-border-light bg-surface-primary" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);"
                    x-show="activeFilter === 'all' || activeFilter === 'gyartas'" x-transition>
                    {{-- Cover --}}
                    <div class="flex aspect-video items-center justify-center bg-linear-to-br from-blue-50 to-indigo-50">
                        <span class="text-5xl opacity-50">&#127981;</span>
                    </div>
                    <div class="-mt-8 relative px-6">
                        <span class="inline-flex items-center gap-1 rounded-md bg-blue-50 px-2.5 py-1 text-[11px] font-bold uppercase tracking-wider text-blue-600">Gyártás &middot; Fémfeldolgozás</span>
                    </div>

                    {{-- Body --}}
                    <div class="flex flex-1 flex-col p-6 pt-3">
                        <span class="mb-2 block text-xs font-bold uppercase tracking-wider text-text-tertiary">PrecízTech Kft.</span>
                        <h3 class="mb-3 text-base font-bold leading-snug text-text-primary">Hogyan csökkentette a PrecízTech a selejt-arányt 40%-kal a Cégem360 gyártásirányítással</h3>
                        <p class="mb-5 flex-1 text-sm leading-relaxed text-text-secondary">A PrecízTech Kft. CNC forgácsoló üzeme 3 műszakban dolgozik, 12 géppel. A gyártásirányítás korábban Excel-táblákban és műszakvezetői naplókban történt — a selejt-arány 8% körül mozgott, az OEE láthatatlan volt.</p>

                        {{-- Modules --}}
                        <div class="mb-4 flex flex-wrap gap-1.5">
                            <span class="rounded-md bg-surface-secondary px-2 py-0.5 text-[11px] font-semibold text-text-tertiary">Gyártásirányítás</span>
                            <span class="rounded-md bg-surface-secondary px-2 py-0.5 text-[11px] font-semibold text-text-tertiary">Digitális munkalap</span>
                            <span class="rounded-md bg-surface-secondary px-2 py-0.5 text-[11px] font-semibold text-text-tertiary">DataMind MI</span>
                            <span class="rounded-md bg-surface-secondary px-2 py-0.5 text-[11px] font-semibold text-text-tertiary">Irányítópultok</span>
                        </div>

                        {{-- Results --}}
                        <div class="mb-4 grid grid-cols-3 gap-2 rounded-xl border border-border-light bg-surface-secondary p-3">
                            <div class="text-center">
                                <span class="block text-sm font-bold text-blue-600" style="font-family: 'JetBrains Mono', monospace;">-40%</span>
                                <span class="block text-[10px] font-semibold uppercase text-text-tertiary">Selejt-arány</span>
                            </div>
                            <div class="text-center">
                                <span class="block text-sm font-bold text-blue-600" style="font-family: 'JetBrains Mono', monospace;">87%</span>
                                <span class="block text-[10px] font-semibold uppercase text-text-tertiary">OEE átlag</span>
                            </div>
                            <div class="text-center">
                                <span class="block text-sm font-bold text-blue-600" style="font-family: 'JetBrains Mono', monospace;">-3 hét</span>
                                <span class="block text-[10px] font-semibold uppercase text-text-tertiary">Bevezetési idő</span>
                            </div>
                        </div>

                        {{-- Quote --}}
                        <div class="mb-5 rounded-xl border-l-3 border-blue-200 bg-blue-50/50 p-4">
                            <p class="text-sm italic leading-relaxed text-text-secondary">&ldquo;Korábban a műszakvezető fejben tartotta, melyik gép mikor áll le. Most a DataMind előre szól, és a csapat a telefonján látja az OEE-t valós időben.&rdquo;</p>
                            <p class="mt-2 text-xs font-semibold text-text-tertiary">&mdash; Üzemvezető, PrecízTech Kft.</p>
                        </div>

                        {{-- Link --}}
                        <a href="#" class="inline-flex items-center gap-1.5 text-sm font-semibold text-blue-600 hover:text-blue-700">
                            Teljes esettanulmány <svg class="arrow-slide h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" /></svg>
                        </a>
                    </div>
                </article>

                {{-- Story 2: Szerviz --}}
                <article class="stagger-item card-glow flex flex-col overflow-hidden rounded-2xl border border-border-light bg-surface-primary" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);"
                    x-show="activeFilter === 'all' || activeFilter === 'szerviz'" x-transition>
                    {{-- Cover --}}
                    <div class="flex aspect-video items-center justify-center bg-linear-to-br from-emerald-50 to-teal-50">
                        <span class="text-5xl opacity-50">&#128295;</span>
                    </div>
                    <div class="-mt-8 relative px-6">
                        <span class="inline-flex items-center gap-1 rounded-md bg-emerald-50 px-2.5 py-1 text-[11px] font-bold uppercase tracking-wider text-emerald-600">Szerviz &middot; Ipari karbantartás</span>
                    </div>

                    {{-- Body --}}
                    <div class="flex flex-1 flex-col p-6 pt-3">
                        <span class="mb-2 block text-xs font-bold uppercase tracking-wider text-text-tertiary">SzervizPont Zrt.</span>
                        <h3 class="mb-3 text-base font-bold leading-snug text-text-primary">A SzervizPont 15 technikusát koordinálja a Cégem360 — papír nélkül, valós időben</h3>
                        <p class="mb-5 flex-1 text-sm leading-relaxed text-text-secondary">A SzervizPont Zrt. ipari gépek helyszíni karbantartásával foglalkozik, 15 szerviz-technikussal. Korábban papíralapú munkalapokat használtak, a diszpécser telefonon egyeztetett.</p>

                        {{-- Modules --}}
                        <div class="mb-4 flex flex-wrap gap-1.5">
                            <span class="rounded-md bg-surface-secondary px-2 py-0.5 text-[11px] font-semibold text-text-tertiary">Szerviz &amp; Karbantartás</span>
                            <span class="rounded-md bg-surface-secondary px-2 py-0.5 text-[11px] font-semibold text-text-tertiary">Digitális munkalap</span>
                            <span class="rounded-md bg-surface-secondary px-2 py-0.5 text-[11px] font-semibold text-text-tertiary">CRM</span>
                            <span class="rounded-md bg-surface-secondary px-2 py-0.5 text-[11px] font-semibold text-text-tertiary">Automatizálás</span>
                        </div>

                        {{-- Results --}}
                        <div class="mb-4 grid grid-cols-3 gap-2 rounded-xl border border-border-light bg-surface-secondary p-3">
                            <div class="text-center">
                                <span class="block text-sm font-bold text-emerald-600" style="font-family: 'JetBrains Mono', monospace;">96%</span>
                                <span class="block text-[10px] font-semibold uppercase text-text-tertiary">SLA-teljesítés</span>
                            </div>
                            <div class="text-center">
                                <span class="block text-sm font-bold text-emerald-600" style="font-family: 'JetBrains Mono', monospace;">-65%</span>
                                <span class="block text-[10px] font-semibold uppercase text-text-tertiary">Admin idő</span>
                            </div>
                            <div class="text-center">
                                <span class="block text-sm font-bold text-emerald-600" style="font-family: 'JetBrains Mono', monospace;">+22%</span>
                                <span class="block text-[10px] font-semibold uppercase text-text-tertiary">Napi kiszállás</span>
                            </div>
                        </div>

                        {{-- Quote --}}
                        <div class="mb-5 rounded-xl border-l-3 border-emerald-200 bg-emerald-50/50 p-4">
                            <p class="text-sm italic leading-relaxed text-text-secondary">&ldquo;A technikusok a helyszínen, a telefonjukon töltik ki a munkalapot — fotóval, aláírással. Az ügyfél még aznap megkapja a szervizjelentést, automatikusan.&rdquo;</p>
                            <p class="mt-2 text-xs font-semibold text-text-tertiary">&mdash; Szervizmenedzser, SzervizPont Zrt.</p>
                        </div>

                        {{-- Link --}}
                        <a href="#" class="inline-flex items-center gap-1.5 text-sm font-semibold text-emerald-600 hover:text-emerald-700">
                            Teljes esettanulmány <svg class="arrow-slide h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" /></svg>
                        </a>
                    </div>
                </article>

                {{-- Story 3: Kereskedelem --}}
                <article class="stagger-item card-glow flex flex-col overflow-hidden rounded-2xl border border-border-light bg-surface-primary" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);"
                    x-show="activeFilter === 'all' || activeFilter === 'kereskedelem'" x-transition>
                    {{-- Cover --}}
                    <div class="flex aspect-video items-center justify-center bg-linear-to-br from-amber-50 to-orange-50">
                        <span class="text-5xl opacity-50">&#128230;</span>
                    </div>
                    <div class="-mt-8 relative px-6">
                        <span class="inline-flex items-center gap-1 rounded-md bg-amber-50 px-2.5 py-1 text-[11px] font-bold uppercase tracking-wider text-amber-600">Kereskedelem &middot; Ipari alkatrész</span>
                    </div>

                    {{-- Body --}}
                    <div class="flex flex-1 flex-col p-6 pt-3">
                        <span class="mb-2 block text-xs font-bold uppercase tracking-wider text-text-tertiary">IndusztriParts Kft.</span>
                        <h3 class="mb-3 text-base font-bold leading-snug text-text-primary">Hogyan növelte az IndusztriParts 35%-kal az ajánlat–megrendelés konverziót a Cégem360 CRM-mel</h3>
                        <p class="mb-5 flex-1 text-sm leading-relaxed text-text-secondary">Az IndusztriParts Kft. ipari alkatrészek nagykereskedelmével foglalkozik, 380+ aktív ügyfélszámlával. Az értékesítők korábban e-mailben és fejben követték a pipeline-t.</p>

                        {{-- Modules --}}
                        <div class="mb-4 flex flex-wrap gap-1.5">
                            <span class="rounded-md bg-surface-secondary px-2 py-0.5 text-[11px] font-semibold text-text-tertiary">CRM &amp; Ügyfélkezelés</span>
                            <span class="rounded-md bg-surface-secondary px-2 py-0.5 text-[11px] font-semibold text-text-tertiary">Értékesítés</span>
                            <span class="rounded-md bg-surface-secondary px-2 py-0.5 text-[11px] font-semibold text-text-tertiary">DataMind MI</span>
                            <span class="rounded-md bg-surface-secondary px-2 py-0.5 text-[11px] font-semibold text-text-tertiary">Kontrolling</span>
                        </div>

                        {{-- Results --}}
                        <div class="mb-4 grid grid-cols-3 gap-2 rounded-xl border border-border-light bg-surface-secondary p-3">
                            <div class="text-center">
                                <span class="block text-sm font-bold text-amber-600" style="font-family: 'JetBrains Mono', monospace;">+35%</span>
                                <span class="block text-[10px] font-semibold uppercase text-text-tertiary">Konverzió</span>
                            </div>
                            <div class="text-center">
                                <span class="block text-sm font-bold text-amber-600" style="font-family: 'JetBrains Mono', monospace;">-2 nap</span>
                                <span class="block text-[10px] font-semibold uppercase text-text-tertiary">Ajánlat kiadás</span>
                            </div>
                            <div class="text-center">
                                <span class="block text-sm font-bold text-amber-600" style="font-family: 'JetBrains Mono', monospace;">-60%</span>
                                <span class="block text-[10px] font-semibold uppercase text-text-tertiary">Churn-kockázat</span>
                            </div>
                        </div>

                        {{-- Quote --}}
                        <div class="mb-5 rounded-xl border-l-3 border-amber-200 bg-amber-50/50 p-4">
                            <p class="text-sm italic leading-relaxed text-text-secondary">&ldquo;A DataMind hétfőnként megmondja, melyik ügyfélnél van churn-kockázat, és az értékesítő még aznap felhívja. Korábban csak akkor tudtuk meg, hogy elvesztettük, amikor már késő volt.&rdquo;</p>
                            <p class="mt-2 text-xs font-semibold text-text-tertiary">&mdash; Értékesítési vezető, IndusztriParts Kft.</p>
                        </div>

                        {{-- Link --}}
                        <a href="#" class="inline-flex items-center gap-1.5 text-sm font-semibold text-amber-600 hover:text-amber-700">
                            Teljes esettanulmány <svg class="arrow-slide h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" /></svg>
                        </a>
                    </div>
                </article>

            </div>
        </div>
    </section>

    {{-- More Stories Teaser --}}
    <section class="bg-surface-primary py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-6">
            <div class="reveal mb-8">
                <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-orange-600">Hamarosan</p>
                <h2 class="text-3xl text-text-primary md:text-4xl" style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                    Folyamatosan bővülő ügyfélsztorik
                </h2>
            </div>

            <div class="reveal">
                <div class="rounded-2xl border border-dashed border-border-light bg-surface-secondary p-12 text-center" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <span class="mb-4 block text-4xl opacity-40">&#128218;</span>
                    <h3 class="mb-2 text-lg font-bold text-text-primary">További esettanulmányok hamarosan</h3>
                    <p class="mx-auto mb-6 max-w-lg text-sm text-text-secondary">Minden negyedévben új ügyfélsztorikat publikálunk — különböző iparágakból, különböző kihívásokkal és megoldásokkal. Iratkozzon fel a hírlevélre, hogy elsőként értesüljön.</p>
                    <a href="{{ route('contact') }}" class="inline-flex items-center gap-2 rounded-full border border-border-light bg-surface-primary px-6 py-3 text-sm font-semibold text-text-primary transition-all hover:border-orange-200 hover:shadow-md">
                        Értesítsen az új sztorikról
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{-- Anatomy of a Story --}}
    <section class="bg-surface-secondary py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-6">
            <div class="reveal mb-12">
                <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-orange-600">Esettanulmány felépítés</p>
                <h2 class="mb-4 text-3xl text-text-primary md:text-4xl" style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                    Minden sztorinkat így építjük fel
                </h2>
                <p class="max-w-xl text-lg text-text-secondary">
                    Nem marketingszöveget írunk — hanem mérhető eredményeket, valós kontextusban, idézhető adatokkal.
                </p>
            </div>

            <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4" data-stagger>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-7 text-center" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <span class="mb-3 block text-xs font-bold text-orange-600" style="font-family: 'JetBrains Mono', monospace;">01</span>
                    <div class="icon-hover mb-3 text-2xl">&#127970;</div>
                    <h4 class="mb-1 text-sm font-bold text-text-primary">Cég és iparág</h4>
                    <p class="text-xs text-text-tertiary">Ki az ügyfél, milyen szegmensben dolgozik, mekkora a cég, mit csinál</p>
                </div>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-7 text-center" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <span class="mb-3 block text-xs font-bold text-orange-600" style="font-family: 'JetBrains Mono', monospace;">02</span>
                    <div class="icon-hover mb-3 text-2xl">&#9888;&#65039;</div>
                    <h4 class="mb-1 text-sm font-bold text-text-primary">Kihívás</h4>
                    <p class="text-xs text-text-tertiary">Milyen problémával küzdött a cég a Cégem360 előtt — konkrétan, számokkal</p>
                </div>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-7 text-center" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <span class="mb-3 block text-xs font-bold text-orange-600" style="font-family: 'JetBrains Mono', monospace;">03</span>
                    <div class="icon-hover mb-3 text-2xl">&#128161;</div>
                    <h4 class="mb-1 text-sm font-bold text-text-primary">Megoldás</h4>
                    <p class="text-xs text-text-tertiary">Milyen modulokat vezettünk be, hogyan konfiguráltuk, mennyi ideig tartott</p>
                </div>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-7 text-center" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <span class="mb-3 block text-xs font-bold text-orange-600" style="font-family: 'JetBrains Mono', monospace;">04</span>
                    <div class="icon-hover mb-3 text-2xl">&#128200;</div>
                    <h4 class="mb-1 text-sm font-bold text-text-primary">Eredmények</h4>
                    <p class="text-xs text-text-tertiary">Mérhető változás: %-os javulás, időmegtakarítás, költségcsökkenés, ROI</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Stats Section --}}
    <section class="bg-surface-primary py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-6">
            <div class="reveal mb-12 text-center">
                <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-orange-600">Összesített eredmények</p>
                <h2 class="text-3xl text-text-primary md:text-4xl" style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                    Amit az ügyfeleink együtt elértek
                </h2>
            </div>

            <div class="grid grid-cols-2 gap-5 lg:grid-cols-4" data-stagger data-counter-trigger>
                <div class="stagger-item stat-hover rounded-2xl border border-border-light bg-surface-primary p-8 text-center" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <span class="stat-value block text-4xl font-bold text-orange-600 lg:text-5xl" style="font-family: 'JetBrains Mono', monospace;"
                        data-count="52" data-prefix="-" data-suffix="%">0</span>
                    <span class="mt-2 block text-sm text-text-secondary">Átlagos admin-idő csökkenés</span>
                </div>
                <div class="stagger-item stat-hover rounded-2xl border border-border-light bg-surface-primary p-8 text-center" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <span class="stat-value block text-4xl font-bold text-emerald-600 lg:text-5xl" style="font-family: 'JetBrains Mono', monospace;"
                        data-count="34" data-prefix="+" data-suffix="%">0</span>
                    <span class="mt-2 block text-sm text-text-secondary">Átlagos hatékonyság-növekedés</span>
                </div>
                <div class="stagger-item stat-hover rounded-2xl border border-border-light bg-surface-primary p-8 text-center" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <span class="stat-value block text-4xl font-bold text-blue-600 lg:text-5xl" style="font-family: 'JetBrains Mono', monospace;"
                        data-count="3 hét">0</span>
                    <span class="mt-2 block text-sm text-text-secondary">Átlagos bevezetési idő</span>
                </div>
                <div class="stagger-item stat-hover rounded-2xl border border-border-light bg-surface-primary p-8 text-center" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <span class="stat-value block text-4xl font-bold text-violet-600 lg:text-5xl" style="font-family: 'JetBrains Mono', monospace;"
                        data-count="96" data-suffix="%">0</span>
                    <span class="mt-2 block text-sm text-text-secondary">Ügyfél-elégedettség</span>
                </div>
            </div>
        </div>
    </section>

    {{-- CTA Section --}}
    <section class="bg-linear-to-b from-surface-secondary to-surface-primary py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-6">
            <div class="reveal">
                <div class="rounded-2xl border border-orange-100 bg-orange-50/30 p-10 text-center lg:p-16" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <h3 class="mb-4 text-2xl font-bold text-text-primary lg:text-3xl" style="font-family: 'Poppins', sans-serif; font-weight: 600;">Az Ön cége is lehet a következő sztori</h3>
                    <p class="mx-auto mb-8 max-w-xl text-base text-text-secondary">Foglaljon egy 30 perces konzultációt — megmutatjuk, hogyan segíthet a Cégem360 az Ön iparágában, az Ön kihívásaira. Nem demó-prezentáció — hanem párbeszéd.</p>

                    <div class="flex flex-wrap items-center justify-center gap-4">
                        <a href="{{ route('contact') }}"
                            class="group inline-flex items-center gap-2 rounded-full bg-orange-600 px-6 py-3 text-base font-medium text-white transition-all hover:bg-orange-700 hover:shadow-lg"
                            style="box-shadow: 0 1px 2px rgba(0,0,0,0.05);">
                            <span>Konzultáció foglalása</span>
                            <svg class="arrow-slide h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" /></svg>
                        </a>
                        <a href="{{ route('register') }}"
                            class="inline-flex items-center gap-2 rounded-full border border-border-light bg-surface-primary px-6 py-3 text-base font-medium text-text-primary transition-all hover:border-orange-200 hover:shadow-md">
                            Regisztráció és kipróbálás
                        </a>
                    </div>

                    <div class="mt-6 flex flex-wrap items-center justify-center gap-6">
                        <span class="flex items-center gap-1.5 text-sm text-text-tertiary">
                            <svg class="h-4 w-4 text-success-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                            30 perc videóhívás
                        </span>
                        <span class="flex items-center gap-1.5 text-sm text-text-tertiary">
                            <svg class="h-4 w-4 text-success-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                            Az Ön iparágára vetítve
                        </span>
                        <span class="flex items-center gap-1.5 text-sm text-text-tertiary">
                            <svg class="h-4 w-4 text-success-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                            Nincs elköteleződés
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>
