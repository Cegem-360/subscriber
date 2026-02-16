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
        .card-glow:hover { box-shadow: 0 8px 30px -8px rgba(99, 102, 241, 0.15), 0 2px 8px rgba(0,0,0,0.04) !important; transform: translateY(-4px); }

        .arrow-slide { transition: transform 0.3s cubic-bezier(0,0,0.2,1); }
        .group:hover .arrow-slide, a:hover .arrow-slide { transform: translateX(4px); }

        .stat-hover .stat-value { transition: transform 0.4s cubic-bezier(0,0,0.2,1.4); }
        .stat-hover:hover .stat-value { transform: scale(1.08); }

        @keyframes pulse-dot { 0%, 100% { opacity: 1; } 50% { opacity: 0.4; } }
        .pulse-dot { animation: pulse-dot 2s infinite; }

        html { scroll-behavior: smooth; }
    </style>

    {{-- Hero Section --}}
    <section class="bg-linear-to-b from-indigo-50 to-surface-secondary">
        <div class="mx-auto max-w-7xl px-6 py-16 lg:py-24">
            <div class="reveal mx-auto max-w-3xl text-center">
                <div class="badge-gradient mb-8 inline-flex items-center gap-2 rounded-full border border-border-light/80 bg-surface-primary px-4 py-1.5"
                    style="box-shadow: 0 1px 3px rgba(0,0,0,0.04);">
                    <span class="inline-block h-1.5 w-1.5 rounded-full bg-indigo-500 pulse-dot"></span>
                    <span class="text-sm font-medium text-text-primary">Cég &middot; Újdonságok</span>
                </div>

                <h1 class="mb-6 text-4xl leading-tight tracking-tight text-text-primary md:text-5xl lg:text-[3.5rem]"
                    style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                    Mi újság a Cégem360-ban?
                </h1>

                <p class="mx-auto mb-10 max-w-2xl text-lg text-text-secondary lg:text-xl">
                    Minden hónapban új funkciók, fejlesztések és javítások. Kövesse nyomon, hogyan fejlődik a platform — az ügyfeleink visszajelzései alapján, folyamatosan.
                </p>

                <div class="mb-8 flex flex-wrap items-center justify-center gap-3">
                    <a href="#feliratkozas" class="group inline-flex items-center gap-2 rounded-full bg-indigo-600 px-6 py-3 text-base font-medium text-white transition-all hover:bg-indigo-700 hover:shadow-lg"
                        style="box-shadow: 0 1px 2px rgba(0,0,0,0.05);">
                        <span>Értesítést kérek</span>
                        <svg class="arrow-slide h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" /></svg>
                    </a>
                    <a href="#roadmap" class="inline-flex items-center gap-2 rounded-full border border-border-light bg-surface-primary px-6 py-3 text-base font-medium text-text-primary transition-all hover:border-indigo-200 hover:shadow-md">
                        Tervezett fejlesztések
                    </a>
                </div>

                {{-- Filter bar --}}
                <div class="flex flex-wrap items-center justify-center gap-2">
                    <button class="rounded-full border px-4 py-2 text-sm font-semibold transition-all"
                        :class="activeFilter === 'all' ? 'border-indigo-300 bg-indigo-50 text-indigo-700' : 'border-border-light bg-surface-primary text-text-secondary hover:border-border-default hover:text-text-primary'"
                        @click="activeFilter = 'all'">
                        Összes
                    </button>
                    <button class="rounded-full border px-4 py-2 text-sm font-semibold transition-all"
                        :class="activeFilter === 'new' ? 'border-indigo-300 bg-indigo-50 text-indigo-700' : 'border-border-light bg-surface-primary text-text-secondary hover:border-border-default hover:text-text-primary'"
                        @click="activeFilter = 'new'">
                        Új funkció
                    </button>
                    <button class="rounded-full border px-4 py-2 text-sm font-semibold transition-all"
                        :class="activeFilter === 'improvement' ? 'border-indigo-300 bg-indigo-50 text-indigo-700' : 'border-border-light bg-surface-primary text-text-secondary hover:border-border-default hover:text-text-primary'"
                        @click="activeFilter = 'improvement'">
                        Fejlesztés
                    </button>
                    <button class="rounded-full border px-4 py-2 text-sm font-semibold transition-all"
                        :class="activeFilter === 'fix' ? 'border-indigo-300 bg-indigo-50 text-indigo-700' : 'border-border-light bg-surface-primary text-text-secondary hover:border-border-default hover:text-text-primary'"
                        @click="activeFilter = 'fix'">
                        Hibajavítás
                    </button>
                    <button class="rounded-full border px-4 py-2 text-sm font-semibold transition-all"
                        :class="activeFilter === 'ai' ? 'border-indigo-300 bg-indigo-50 text-indigo-700' : 'border-border-light bg-surface-primary text-text-secondary hover:border-border-default hover:text-text-primary'"
                        @click="activeFilter = 'ai'">
                        MI
                    </button>
                    <button class="rounded-full border px-4 py-2 text-sm font-semibold transition-all"
                        :class="activeFilter === 'integration' ? 'border-indigo-300 bg-indigo-50 text-indigo-700' : 'border-border-light bg-surface-primary text-text-secondary hover:border-border-default hover:text-text-primary'"
                        @click="activeFilter = 'integration'">
                        Integráció
                    </button>
                </div>
            </div>
        </div>
    </section>

    {{-- Update Entries Section --}}
    <section class="bg-surface-secondary py-12 lg:py-20">
        <div class="mx-auto max-w-4xl px-6">

            {{-- 2026. Február --}}
            <div class="reveal mb-16">
                <div class="mb-6 flex items-center gap-4 border-b border-border-light pb-4">
                    <span class="text-base font-bold text-text-primary" style="font-family: 'JetBrains Mono', monospace;">2026. február</span>
                    <span class="rounded-md bg-indigo-50 px-2.5 py-0.5 text-[11px] font-bold text-indigo-600">3 frissítés</span>
                    <span class="h-px flex-1 bg-border-light"></span>
                </div>

                {{-- Entry 1: DataMind anomália-detekció --}}
                <div class="mb-4 rounded-2xl border border-border-light bg-surface-primary p-6 transition-all hover:border-border-default lg:p-8" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);"
                    x-show="activeFilter === 'all' || activeFilter === 'new' || activeFilter === 'ai'" x-transition>
                    <div class="mb-4 flex flex-wrap items-start justify-between gap-3">
                        <div class="flex flex-wrap items-center gap-2">
                            <span class="text-xs font-semibold text-text-tertiary" style="font-family: 'JetBrains Mono', monospace;">2026. feb. 10.</span>
                            <span class="rounded-md bg-indigo-50 px-2.5 py-0.5 text-[11px] font-bold uppercase tracking-wider text-indigo-600">Új funkció</span>
                            <span class="rounded-md bg-violet-50 px-2.5 py-0.5 text-[11px] font-bold uppercase tracking-wider text-violet-600">MI</span>
                        </div>
                        <div class="flex flex-wrap gap-1.5">
                            <span class="rounded-md bg-surface-secondary px-2 py-0.5 text-[11px] font-semibold text-text-tertiary">DataMind</span>
                            <span class="rounded-md bg-surface-secondary px-2 py-0.5 text-[11px] font-semibold text-text-tertiary">AI Chat</span>
                        </div>
                    </div>

                    <h3 class="mb-2 text-lg font-bold text-text-primary">DataMind anomália-detekció: automatikus riasztás rendellenes üzleti adatokra</h3>
                    <p class="mb-5 text-sm leading-relaxed text-text-secondary">A DataMind MI-modul mostantól automatikusan felismeri a rendellenes mintákat az üzleti adatokban — és azonnal riaszt. Nem kell dashboardot bámulni: ha valami kilóg a sorból, a rendszer szól.</p>

                    <div class="mb-5 space-y-2">
                        <div class="flex items-start gap-3">
                            <span class="mt-0.5 flex h-5 w-5 shrink-0 items-center justify-center rounded bg-indigo-50 text-[10px] font-bold text-indigo-600">+</span>
                            <span class="text-sm text-text-secondary">Automatikus anomália-detekció bevétel, rendelés, szerviz és gyártási adatokra — napi és heti ciklusban</span>
                        </div>
                        <div class="flex items-start gap-3">
                            <span class="mt-0.5 flex h-5 w-5 shrink-0 items-center justify-center rounded bg-indigo-50 text-[10px] font-bold text-indigo-600">+</span>
                            <span class="text-sm text-text-secondary">Riasztás e-mailben és rendszeren belüli értesítésként — priorizálva (alacsony / közepes / magas)</span>
                        </div>
                        <div class="flex items-start gap-3">
                            <span class="mt-0.5 flex h-5 w-5 shrink-0 items-center justify-center rounded bg-indigo-50 text-[10px] font-bold text-indigo-600">+</span>
                            <span class="text-sm text-text-secondary">AI Chat-ben kérdezhető: „Mi volt szokatlan a héten?" — természetes nyelven, magyarul</span>
                        </div>
                        <div class="flex items-start gap-3">
                            <span class="mt-0.5 flex h-5 w-5 shrink-0 items-center justify-center rounded bg-emerald-50 text-[10px] font-bold text-emerald-600">&#8593;</span>
                            <span class="text-sm text-text-secondary">DataMind predikciós pontosság javítva: &plusmn;8% &rarr; &plusmn;5% a bevétel-előrejelzéseknél</span>
                        </div>
                    </div>

                    <div class="rounded-xl border border-border-light bg-surface-secondary p-5 text-center">
                        <span class="mb-1 block text-2xl opacity-40">&#128202;</span>
                        <span class="text-xs font-semibold text-text-tertiary">Képernyőkép: DataMind anomália-riasztás dashboard</span>
                    </div>
                </div>

                {{-- Entry 2: Digitális munkalap offline --}}
                <div class="mb-4 rounded-2xl border border-border-light bg-surface-primary p-6 transition-all hover:border-border-default lg:p-8" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);"
                    x-show="activeFilter === 'all' || activeFilter === 'improvement'" x-transition>
                    <div class="mb-4 flex flex-wrap items-start justify-between gap-3">
                        <div class="flex flex-wrap items-center gap-2">
                            <span class="text-xs font-semibold text-text-tertiary" style="font-family: 'JetBrains Mono', monospace;">2026. feb. 05.</span>
                            <span class="rounded-md bg-emerald-50 px-2.5 py-0.5 text-[11px] font-bold uppercase tracking-wider text-emerald-600">Fejlesztés</span>
                        </div>
                        <div class="flex flex-wrap gap-1.5">
                            <span class="rounded-md bg-surface-secondary px-2 py-0.5 text-[11px] font-semibold text-text-tertiary">Digitális munkalap</span>
                            <span class="rounded-md bg-surface-secondary px-2 py-0.5 text-[11px] font-semibold text-text-tertiary">Szerviz</span>
                        </div>
                    </div>

                    <h3 class="mb-2 text-lg font-bold text-text-primary">Digitális munkalap: offline mód és fotómegjegyzés a helyszíni munkához</h3>
                    <p class="mb-5 text-sm leading-relaxed text-text-secondary">A szerviz-technikusok mostantól internetkapcsolat nélkül is kitölthetik a digitális munkalapot — az adatok automatikusan szinkronizálnak, amint visszajön a hálózat.</p>

                    <div class="space-y-2">
                        <div class="flex items-start gap-3">
                            <span class="mt-0.5 flex h-5 w-5 shrink-0 items-center justify-center rounded bg-indigo-50 text-[10px] font-bold text-indigo-600">+</span>
                            <span class="text-sm text-text-secondary">Offline mód: teljes munkalap-kitöltés hálózat nélkül, automatikus szinkronizálás a csatlakozáskor</span>
                        </div>
                        <div class="flex items-start gap-3">
                            <span class="mt-0.5 flex h-5 w-5 shrink-0 items-center justify-center rounded bg-indigo-50 text-[10px] font-bold text-indigo-600">+</span>
                            <span class="text-sm text-text-secondary">Fotókhoz szöveges megjegyzés: a technikus a helyszínen fotóz és kommentál, az ügyfél a szervizjelentésben látja</span>
                        </div>
                        <div class="flex items-start gap-3">
                            <span class="mt-0.5 flex h-5 w-5 shrink-0 items-center justify-center rounded bg-emerald-50 text-[10px] font-bold text-emerald-600">&#8593;</span>
                            <span class="text-sm text-text-secondary">Munkalap PDF-generálás gyorsítva: 3.2s &rarr; 0.8s átlagos generálási idő</span>
                        </div>
                    </div>
                </div>

                {{-- Entry 3: Jogosultságkezelés --}}
                <div class="rounded-2xl border border-border-light bg-surface-primary p-6 transition-all hover:border-border-default lg:p-8" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);"
                    x-show="activeFilter === 'all' || activeFilter === 'fix'" x-transition>
                    <div class="mb-4 flex flex-wrap items-start justify-between gap-3">
                        <div class="flex flex-wrap items-center gap-2">
                            <span class="text-xs font-semibold text-text-tertiary" style="font-family: 'JetBrains Mono', monospace;">2026. feb. 02.</span>
                            <span class="rounded-md bg-rose-50 px-2.5 py-0.5 text-[11px] font-bold uppercase tracking-wider text-rose-600">Hibajavítás</span>
                            <span class="rounded-md bg-gray-100 px-2.5 py-0.5 text-[11px] font-bold uppercase tracking-wider text-gray-600">Biztonság</span>
                        </div>
                        <div class="flex flex-wrap gap-1.5">
                            <span class="rounded-md bg-surface-secondary px-2 py-0.5 text-[11px] font-semibold text-text-tertiary">Rendszer</span>
                            <span class="rounded-md bg-surface-secondary px-2 py-0.5 text-[11px] font-semibold text-text-tertiary">Jogosultságok</span>
                        </div>
                    </div>

                    <h3 class="mb-2 text-lg font-bold text-text-primary">Jogosultságkezelés javítás és biztonsági frissítés</h3>
                    <p class="mb-5 text-sm leading-relaxed text-text-secondary">Három jogosultsági hibát javítottunk, amelyek specifikus szerepkombinációknál engedélyeztek nem szándékolt hozzáférést. Emellett frissítettük a session-kezelést.</p>

                    <div class="space-y-2">
                        <div class="flex items-start gap-3">
                            <span class="mt-0.5 flex h-5 w-5 shrink-0 items-center justify-center rounded bg-rose-50 text-[10px] font-bold text-rose-600">&#10005;</span>
                            <span class="text-sm text-text-secondary">Javítva: „Szervizes + Raktáros" kombinált szerepkör nem kívánt hozzáférést adott a pénzügyi modulhoz</span>
                        </div>
                        <div class="flex items-start gap-3">
                            <span class="mt-0.5 flex h-5 w-5 shrink-0 items-center justify-center rounded bg-rose-50 text-[10px] font-bold text-rose-600">&#10005;</span>
                            <span class="text-sm text-text-secondary">Javítva: inaktív felhasználók token-je bizonyos esetekben nem járt le megfelelően</span>
                        </div>
                        <div class="flex items-start gap-3">
                            <span class="mt-0.5 flex h-5 w-5 shrink-0 items-center justify-center rounded bg-emerald-50 text-[10px] font-bold text-emerald-600">&#8593;</span>
                            <span class="text-sm text-text-secondary">Session timeout: 60 perc &rarr; 30 perc inaktivitás után automatikus kijelentkezés (konfigurálható)</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- 2026. Január --}}
            <div class="reveal mb-16">
                <div class="mb-6 flex items-center gap-4 border-b border-border-light pb-4">
                    <span class="text-base font-bold text-text-primary" style="font-family: 'JetBrains Mono', monospace;">2026. január</span>
                    <span class="rounded-md bg-indigo-50 px-2.5 py-0.5 text-[11px] font-bold text-indigo-600">4 frissítés</span>
                    <span class="h-px flex-1 bg-border-light"></span>
                </div>

                {{-- Entry 4: MarketingHub --}}
                <div class="mb-4 rounded-2xl border border-border-light bg-surface-primary p-6 transition-all hover:border-border-default lg:p-8" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);"
                    x-show="activeFilter === 'all' || activeFilter === 'new' || activeFilter === 'integration'" x-transition>
                    <div class="mb-4 flex flex-wrap items-start justify-between gap-3">
                        <div class="flex flex-wrap items-center gap-2">
                            <span class="text-xs font-semibold text-text-tertiary" style="font-family: 'JetBrains Mono', monospace;">2026. jan. 25.</span>
                            <span class="rounded-md bg-indigo-50 px-2.5 py-0.5 text-[11px] font-bold uppercase tracking-wider text-indigo-600">Új funkció</span>
                            <span class="rounded-md bg-blue-50 px-2.5 py-0.5 text-[11px] font-bold uppercase tracking-wider text-blue-600">Integráció</span>
                        </div>
                        <div class="flex flex-wrap gap-1.5">
                            <span class="rounded-md bg-surface-secondary px-2 py-0.5 text-[11px] font-semibold text-text-tertiary">MarketingHub</span>
                            <span class="rounded-md bg-surface-secondary px-2 py-0.5 text-[11px] font-semibold text-text-tertiary">CRM</span>
                        </div>
                    </div>

                    <h3 class="mb-2 text-lg font-bold text-text-primary">MarketingHub: hírlevél-kampányok a CRM-adatokra építve</h3>
                    <p class="mb-5 text-sm leading-relaxed text-text-secondary">A MarketingHub mostantól közvetlenül a CRM szegmensekre küld hírlevelet — nem kell exportálni, importálni, szinkronizálni. Az ügyfél-szegmens változik, a hírlevél-lista automatikusan követi.</p>

                    <div class="mb-5 space-y-2">
                        <div class="flex items-start gap-3">
                            <span class="mt-0.5 flex h-5 w-5 shrink-0 items-center justify-center rounded bg-indigo-50 text-[10px] font-bold text-indigo-600">+</span>
                            <span class="text-sm text-text-secondary">CRM-szegmens alapú hírlevélküldés: választható szűrők (iparág, méret, aktivitás, deal-státusz)</span>
                        </div>
                        <div class="flex items-start gap-3">
                            <span class="mt-0.5 flex h-5 w-5 shrink-0 items-center justify-center rounded bg-indigo-50 text-[10px] font-bold text-indigo-600">+</span>
                            <span class="text-sm text-text-secondary">Drag-and-drop hírlevél szerkesztő: sablonok, képek, CTA-gombok, személyre szabott mezők</span>
                        </div>
                        <div class="flex items-start gap-3">
                            <span class="mt-0.5 flex h-5 w-5 shrink-0 items-center justify-center rounded bg-indigo-50 text-[10px] font-bold text-indigo-600">+</span>
                            <span class="text-sm text-text-secondary">Kampány-analitika: megnyitás, kattintás, konverzió — visszakötve a CRM deal-pipeline-ba</span>
                        </div>
                        <div class="flex items-start gap-3">
                            <span class="mt-0.5 flex h-5 w-5 shrink-0 items-center justify-center rounded bg-indigo-50 text-[10px] font-bold text-indigo-600">+</span>
                            <span class="text-sm text-text-secondary">A/B tesztelés: tárgysor és tartalom-variánsok automatikus kiértékelése</span>
                        </div>
                    </div>

                    <div class="rounded-xl border border-border-light bg-surface-secondary p-5 text-center">
                        <span class="mb-1 block text-2xl opacity-40">&#128231;</span>
                        <span class="text-xs font-semibold text-text-tertiary">Képernyőkép: MarketingHub hírlevél szerkesztő</span>
                    </div>
                </div>

                {{-- Entry 5: Kontrolling --}}
                <div class="mb-4 rounded-2xl border border-border-light bg-surface-primary p-6 transition-all hover:border-border-default lg:p-8" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);"
                    x-show="activeFilter === 'all' || activeFilter === 'new'" x-transition>
                    <div class="mb-4 flex flex-wrap items-start justify-between gap-3">
                        <div class="flex flex-wrap items-center gap-2">
                            <span class="text-xs font-semibold text-text-tertiary" style="font-family: 'JetBrains Mono', monospace;">2026. jan. 18.</span>
                            <span class="rounded-md bg-indigo-50 px-2.5 py-0.5 text-[11px] font-bold uppercase tracking-wider text-indigo-600">Új funkció</span>
                        </div>
                        <div class="flex flex-wrap gap-1.5">
                            <span class="rounded-md bg-surface-secondary px-2 py-0.5 text-[11px] font-semibold text-text-tertiary">Kontrolling</span>
                            <span class="rounded-md bg-surface-secondary px-2 py-0.5 text-[11px] font-semibold text-text-tertiary">Irányítópultok</span>
                        </div>
                    </div>

                    <h3 class="mb-2 text-lg font-bold text-text-primary">Kontrolling: pénzforgalmi előrejelzés és cash flow dashboard</h3>
                    <p class="mb-5 text-sm leading-relaxed text-text-secondary">A Kontrolling modul mostantól nem csak múltbeli adatokat mutat — hanem 30, 60 és 90 napos pénzforgalmi előrejelzést is ad a kiállított számlák, szállítói kötelezettségek és szerződéses bevételek alapján.</p>

                    <div class="space-y-2">
                        <div class="flex items-start gap-3">
                            <span class="mt-0.5 flex h-5 w-5 shrink-0 items-center justify-center rounded bg-indigo-50 text-[10px] font-bold text-indigo-600">+</span>
                            <span class="text-sm text-text-secondary">Cash flow előrejelzés: 30/60/90 napos grafikon a várható be- és kiáramlásokról</span>
                        </div>
                        <div class="flex items-start gap-3">
                            <span class="mt-0.5 flex h-5 w-5 shrink-0 items-center justify-center rounded bg-indigo-50 text-[10px] font-bold text-indigo-600">+</span>
                            <span class="text-sm text-text-secondary">Fizetési fegyelem riport: ügyfelenként átlagos fizetési napok, trendvonal, riasztás</span>
                        </div>
                        <div class="flex items-start gap-3">
                            <span class="mt-0.5 flex h-5 w-5 shrink-0 items-center justify-center rounded bg-emerald-50 text-[10px] font-bold text-emerald-600">&#8593;</span>
                            <span class="text-sm text-text-secondary">Dashboard widgetek: 2 új pénzügyi widget a vezérigazgatói és a pénzügyi irányítópultra</span>
                        </div>
                    </div>
                </div>

                {{-- Entry 6: Teljesítmény --}}
                <div class="mb-4 rounded-2xl border border-border-light bg-surface-primary p-6 transition-all hover:border-border-default lg:p-8" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);"
                    x-show="activeFilter === 'all' || activeFilter === 'improvement'" x-transition>
                    <div class="mb-4 flex flex-wrap items-start justify-between gap-3">
                        <div class="flex flex-wrap items-center gap-2">
                            <span class="text-xs font-semibold text-text-tertiary" style="font-family: 'JetBrains Mono', monospace;">2026. jan. 10.</span>
                            <span class="rounded-md bg-emerald-50 px-2.5 py-0.5 text-[11px] font-bold uppercase tracking-wider text-emerald-600">Fejlesztés</span>
                            <span class="rounded-md bg-orange-50 px-2.5 py-0.5 text-[11px] font-bold uppercase tracking-wider text-orange-600">Teljesítmény</span>
                        </div>
                        <div class="flex flex-wrap gap-1.5">
                            <span class="rounded-md bg-surface-secondary px-2 py-0.5 text-[11px] font-semibold text-text-tertiary">Rendszer</span>
                        </div>
                    </div>

                    <h3 class="mb-2 text-lg font-bold text-text-primary">Rendszerszintű teljesítmény-optimalizálás</h3>
                    <p class="mb-5 text-sm leading-relaxed text-text-secondary">A januári teljesítmény-sprint eredményeként a platform átlagos válaszideje 40%-kal csökkent, a dashboardok betöltése közel felére gyorsult.</p>

                    <div class="space-y-2">
                        <div class="flex items-start gap-3">
                            <span class="mt-0.5 flex h-5 w-5 shrink-0 items-center justify-center rounded bg-emerald-50 text-[10px] font-bold text-emerald-600">&#8593;</span>
                            <span class="text-sm text-text-secondary">API válaszidő: 320ms &rarr; 190ms átlag (p95: 800ms &rarr; 450ms)</span>
                        </div>
                        <div class="flex items-start gap-3">
                            <span class="mt-0.5 flex h-5 w-5 shrink-0 items-center justify-center rounded bg-emerald-50 text-[10px] font-bold text-emerald-600">&#8593;</span>
                            <span class="text-sm text-text-secondary">Dashboard betöltés: 2.1s &rarr; 1.2s (40+ widgettel)</span>
                        </div>
                        <div class="flex items-start gap-3">
                            <span class="mt-0.5 flex h-5 w-5 shrink-0 items-center justify-center rounded bg-emerald-50 text-[10px] font-bold text-emerald-600">&#8593;</span>
                            <span class="text-sm text-text-secondary">Listanézet lapozás: 10.000+ rekordnál is azonnali válasz kereséskor</span>
                        </div>
                    </div>
                </div>

                {{-- Entry 7: Ügyfélportál béta --}}
                <div class="rounded-2xl border border-border-light bg-surface-primary p-6 transition-all hover:border-border-default lg:p-8" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);"
                    x-show="activeFilter === 'all' || activeFilter === 'new'" x-transition>
                    <div class="mb-4 flex flex-wrap items-start justify-between gap-3">
                        <div class="flex flex-wrap items-center gap-2">
                            <span class="text-xs font-semibold text-text-tertiary" style="font-family: 'JetBrains Mono', monospace;">2026. jan. 03.</span>
                            <span class="rounded-md bg-indigo-50 px-2.5 py-0.5 text-[11px] font-bold uppercase tracking-wider text-indigo-600">Új funkció</span>
                            <span class="rounded-md bg-amber-50 px-2.5 py-0.5 text-[11px] font-bold uppercase tracking-wider text-amber-600">Béta</span>
                        </div>
                        <div class="flex flex-wrap gap-1.5">
                            <span class="rounded-md bg-surface-secondary px-2 py-0.5 text-[11px] font-semibold text-text-tertiary">Ügyfélportál</span>
                        </div>
                    </div>

                    <h3 class="mb-2 text-lg font-bold text-text-primary">Ügyfélportál béta: az ügyfelek saját felületen követhetik a megrendeléseiket</h3>
                    <p class="mb-5 text-sm leading-relaxed text-text-secondary">Az ügyfélportál lehetővé teszi, hogy a B2B partnerek bejelentkezzenek és valós időben lássák a rendelés-státuszt, a számlák állapotát, a szervizjegyek előrehaladását és a garancia-információkat — anélkül, hogy telefonálniuk kellene.</p>

                    <div class="space-y-2">
                        <div class="flex items-start gap-3">
                            <span class="mt-0.5 flex h-5 w-5 shrink-0 items-center justify-center rounded bg-indigo-50 text-[10px] font-bold text-indigo-600">+</span>
                            <span class="text-sm text-text-secondary">Rendelés-követés: a B2B ügyfél a portálon látja a rendelés státuszát (feladva &rarr; gyártásban &rarr; szállítás &rarr; lezárva)</span>
                        </div>
                        <div class="flex items-start gap-3">
                            <span class="mt-0.5 flex h-5 w-5 shrink-0 items-center justify-center rounded bg-indigo-50 text-[10px] font-bold text-indigo-600">+</span>
                            <span class="text-sm text-text-secondary">Számla-előzmények: összes kiállított számla, fizetési állapot, letölthető PDF</span>
                        </div>
                        <div class="flex items-start gap-3">
                            <span class="mt-0.5 flex h-5 w-5 shrink-0 items-center justify-center rounded bg-indigo-50 text-[10px] font-bold text-indigo-600">+</span>
                            <span class="text-sm text-text-secondary">Szervizjegy-portál: az ügyfél megnyithatja, kommentálhatja és követheti a szervizjegyeit</span>
                        </div>
                        <div class="flex items-start gap-3">
                            <span class="mt-0.5 flex h-5 w-5 shrink-0 items-center justify-center rounded bg-indigo-50 text-[10px] font-bold text-indigo-600">+</span>
                            <span class="text-sm text-text-secondary">Garancia-nyilvántartás: az ügyfél látja a garancia lejárati idejét és a kapcsolódó szerviz-előzményeket</span>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

    {{-- Stats Section --}}
    <section class="bg-surface-primary py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-6">
            <div class="reveal mb-12 text-center">
                <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-indigo-600">Fejlesztési ütem</p>
                <h2 class="text-3xl text-text-primary md:text-4xl" style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                    A Cégem360 folyamatosan fejlődik
                </h2>
            </div>

            <div class="grid grid-cols-2 gap-5 lg:grid-cols-4" data-stagger data-counter-trigger>
                <div class="stagger-item stat-hover rounded-2xl border border-border-light bg-surface-primary p-8 text-center" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <span class="stat-value block text-4xl font-bold text-indigo-600 lg:text-5xl" style="font-family: 'JetBrains Mono', monospace;"
                        data-count="Havi">0</span>
                    <span class="mt-2 block text-sm text-text-secondary">Frissítési ciklus</span>
                </div>
                <div class="stagger-item stat-hover rounded-2xl border border-border-light bg-surface-primary p-8 text-center" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <span class="stat-value block text-4xl font-bold text-emerald-600 lg:text-5xl" style="font-family: 'JetBrains Mono', monospace;"
                        data-count="11">0</span>
                    <span class="mt-2 block text-sm text-text-secondary">Aktív modul</span>
                </div>
                <div class="stagger-item stat-hover rounded-2xl border border-border-light bg-surface-primary p-8 text-center" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <span class="stat-value block text-4xl font-bold text-amber-600 lg:text-5xl" style="font-family: 'JetBrains Mono', monospace;"
                        data-count="40" data-suffix="+">0</span>
                    <span class="mt-2 block text-sm text-text-secondary">Dashboard widget</span>
                </div>
                <div class="stagger-item stat-hover rounded-2xl border border-border-light bg-surface-primary p-8 text-center" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <span class="stat-value block text-4xl font-bold text-violet-600 lg:text-5xl" style="font-family: 'JetBrains Mono', monospace;"
                        data-count="100" data-suffix="%">0</span>
                    <span class="mt-2 block text-sm text-text-secondary">Ügyfélvisszajelzés-alapú</span>
                </div>
            </div>
        </div>
    </section>

    {{-- Roadmap Section --}}
    <section class="bg-surface-secondary py-16 lg:py-24" id="roadmap">
        <div class="mx-auto max-w-7xl px-6">
            <div class="reveal mb-12">
                <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-indigo-600">Fejlesztési terv</p>
                <h2 class="mb-4 text-3xl text-text-primary md:text-4xl" style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                    Amin most dolgozunk — és ami következik
                </h2>
                <p class="max-w-xl text-lg text-text-secondary">
                    A roadmap az ügyfél-visszajelzések alapján alakul. Ha van javaslata — szívesen halljuk.
                </p>
            </div>

            <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3" data-stagger>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-7" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <span class="mb-4 inline-flex items-center gap-1.5 rounded-md bg-indigo-50 px-2.5 py-1 text-[11px] font-bold uppercase tracking-wider text-indigo-600">
                        <span class="inline-block h-1.5 w-1.5 rounded-full bg-indigo-500 pulse-dot"></span>
                        Fejlesztés alatt
                    </span>
                    <h3 class="mb-2 text-base font-bold text-text-primary">SEO modul — technikai audit és kulcsszó-nyomkövetés</h3>
                    <p class="mb-4 text-sm leading-relaxed text-text-secondary">A MarketingHub bővítése SEO-eszközökkel: technikai oldal-audit, kulcsszó-pozíció nyomkövetés, on-page javaslatok, versenytárs-elemzés.</p>
                    <div class="flex flex-wrap gap-1.5">
                        <span class="rounded-md bg-surface-secondary px-2 py-0.5 text-[11px] font-semibold text-text-tertiary">MarketingHub</span>
                        <span class="rounded-md bg-surface-secondary px-2 py-0.5 text-[11px] font-semibold text-text-tertiary">SEO</span>
                    </div>
                </div>

                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-7" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <span class="mb-4 inline-flex items-center gap-1.5 rounded-md bg-violet-50 px-2.5 py-1 text-[11px] font-bold uppercase tracking-wider text-violet-600">
                        <span class="inline-block h-1.5 w-1.5 rounded-full bg-violet-500"></span>
                        Tervezett
                    </span>
                    <h3 class="mb-2 text-base font-bold text-text-primary">Többdevizás számlázás és árfolyam-kezelés</h3>
                    <p class="mb-4 text-sm leading-relaxed text-text-secondary">EUR/USD/CHF árfolyam-automatika, többdevizás ajánlatkészítés, devizaárfolyam-különbözet kezelés a kontrollingban.</p>
                    <div class="flex flex-wrap gap-1.5">
                        <span class="rounded-md bg-surface-secondary px-2 py-0.5 text-[11px] font-semibold text-text-tertiary">Értékesítés</span>
                        <span class="rounded-md bg-surface-secondary px-2 py-0.5 text-[11px] font-semibold text-text-tertiary">Kontrolling</span>
                    </div>
                </div>

                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-7" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <span class="mb-4 inline-flex items-center gap-1.5 rounded-md bg-amber-50 px-2.5 py-1 text-[11px] font-bold uppercase tracking-wider text-amber-600">
                        <span class="inline-block h-1.5 w-1.5 rounded-full bg-amber-500"></span>
                        Kutatás
                    </span>
                    <h3 class="mb-2 text-base font-bold text-text-primary">Mobil app — szerviz-technikus és raktáros nézet</h3>
                    <p class="mb-4 text-sm leading-relaxed text-text-secondary">Natív mobil alkalmazás a leggyakoribb helyszíni feladatokhoz: munkalap, raktárkészlet, szervizjegy, fotó, aláírás — offline képességgel.</p>
                    <div class="flex flex-wrap gap-1.5">
                        <span class="rounded-md bg-surface-secondary px-2 py-0.5 text-[11px] font-semibold text-text-tertiary">Szerviz</span>
                        <span class="rounded-md bg-surface-secondary px-2 py-0.5 text-[11px] font-semibold text-text-tertiary">Munkalap</span>
                        <span class="rounded-md bg-surface-secondary px-2 py-0.5 text-[11px] font-semibold text-text-tertiary">Raktár</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Subscribe Section --}}
    <section class="bg-surface-primary py-16 lg:py-24" id="feliratkozas">
        <div class="mx-auto max-w-7xl px-6">
            <div class="reveal mb-12">
                <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-indigo-600">Értesítés</p>
                <h2 class="text-3xl text-text-primary md:text-4xl" style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                    Tudjon elsőként az újdonságokról
                </h2>
            </div>

            <div class="reveal">
                <div class="grid items-center gap-10 rounded-2xl border border-border-light bg-surface-primary p-8 lg:grid-cols-2 lg:p-12" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div>
                        <h3 class="mb-2 text-xl font-bold text-text-primary">Kapjon értesítést minden frissítésről</h3>
                        <p class="text-sm leading-relaxed text-text-secondary">Válassza ki, hogyan szeretne értesülni a Cégem360 újdonságairól. Nem spammelünk — csak akkor írunk, ha van, amiről érdemes.</p>
                    </div>
                    <div class="flex flex-col gap-3 sm:flex-row lg:flex-col">
                        <a href="{{ route('contact') }}" class="flex items-center gap-3 rounded-xl border border-border-light bg-surface-secondary p-4 transition-all hover:border-indigo-200 hover:shadow-md">
                            <span class="text-xl">&#128231;</span>
                            <div>
                                <h4 class="text-sm font-bold text-text-primary">Hírlevél</h4>
                                <p class="text-xs text-text-tertiary">Havi összefoglaló e-mailben</p>
                            </div>
                        </a>
                        <a href="{{ route('contact') }}" class="flex items-center gap-3 rounded-xl border border-border-light bg-surface-secondary p-4 transition-all hover:border-indigo-200 hover:shadow-md">
                            <span class="text-xl">&#128225;</span>
                            <div>
                                <h4 class="text-sm font-bold text-text-primary">RSS feed</h4>
                                <p class="text-xs text-text-tertiary">Automatikus frissítés az RSS olvasóban</p>
                            </div>
                        </a>
                        <a href="{{ route('contact') }}" class="flex items-center gap-3 rounded-xl border border-border-light bg-surface-secondary p-4 transition-all hover:border-indigo-200 hover:shadow-md">
                            <span class="text-xl">&#128188;</span>
                            <div>
                                <h4 class="text-sm font-bold text-text-primary">LinkedIn</h4>
                                <p class="text-xs text-text-tertiary">Kövesse a Cégem360 oldalt</p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- CTA Section --}}
    <section class="bg-linear-to-b from-surface-secondary to-surface-primary py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-6">
            <div class="reveal">
                <div class="rounded-2xl border border-indigo-100 bg-indigo-50/30 p-10 text-center lg:p-16" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <h3 class="mb-4 text-2xl font-bold text-text-primary lg:text-3xl" style="font-family: 'Poppins', sans-serif; font-weight: 600;">Kíváncsi az új funkciókra?</h3>
                    <p class="mx-auto mb-8 max-w-xl text-base text-text-secondary">Regisztráljon és próbálja ki a Cégem360 legfrissebb verzióját — minden új funkció azonnal elérhető az aktív előfizetőknek, extra díj nélkül.</p>

                    <div class="flex flex-wrap items-center justify-center gap-4">
                        <a href="{{ route('contact') }}"
                            class="group inline-flex items-center gap-2 rounded-full bg-indigo-600 px-6 py-3 text-base font-medium text-white transition-all hover:bg-indigo-700 hover:shadow-lg"
                            style="box-shadow: 0 1px 2px rgba(0,0,0,0.05);">
                            <span>Konzultáció foglalása</span>
                            <svg class="arrow-slide h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" /></svg>
                        </a>
                        <a href="{{ route('register') }}"
                            class="inline-flex items-center gap-2 rounded-full border border-border-light bg-surface-primary px-6 py-3 text-base font-medium text-text-primary transition-all hover:border-indigo-200 hover:shadow-md">
                            Regisztráció és kipróbálás
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>
