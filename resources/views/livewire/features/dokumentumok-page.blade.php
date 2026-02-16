<div x-data="{
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

        @keyframes pulse-ring {
            0% { box-shadow: 0 0 0 0 rgba(14, 165, 233, 0.4); }
            70% { box-shadow: 0 0 0 6px rgba(14, 165, 233, 0); }
            100% { box-shadow: 0 0 0 0 rgba(14, 165, 233, 0); }
        }
        .pulse-dot { animation: pulse-ring 2s ease infinite; }

        .card-glow { transition: all 0.4s cubic-bezier(0,0,0.2,1); }
        .card-glow:hover { box-shadow: 0 8px 30px -8px rgba(14, 165, 233, 0.15), 0 2px 8px rgba(0,0,0,0.04) !important; }

        .icon-hover { transition: transform 0.35s cubic-bezier(0,0,0.2,1.4); }
        .group:hover .icon-hover, .card-glow:hover .icon-hover { transform: translateY(-3px) scale(1.08); }

        .arrow-slide { transition: transform 0.3s cubic-bezier(0,0,0.2,1); }
        .group:hover .arrow-slide, a:hover .arrow-slide { transform: translateX(4px); }

        .stat-hover .stat-value { transition: transform 0.4s cubic-bezier(0,0,0.2,1.4); }
        .stat-hover:hover .stat-value { transform: scale(1.08); }

        .feature-dot { transition: transform 0.3s cubic-bezier(0,0,0.2,1); }
        .card-glow:hover .feature-dot { transform: scale(1.5); }

        @keyframes doc-pulse { 0%, 100% { opacity: 1; } 50% { opacity: 0.5; } }
        .doc-pulse { animation: doc-pulse 2s ease infinite; }

        @keyframes doc-bar-grow {
            from { transform: scaleX(0); transform-origin: left; }
            to { transform: scaleX(1); transform-origin: left; }
        }
        .doc-bar { animation: doc-bar-grow 0.8s cubic-bezier(0, 0, 0.2, 1) both; }

        .pill-float { transition: transform 0.35s cubic-bezier(0,0,0.2,1), box-shadow 0.35s cubic-bezier(0,0,0.2,1); }
        .pill-float:hover { transform: translateY(-3px); box-shadow: 0 6px 20px -4px rgba(14, 165, 233, 0.12); }

        html { scroll-behavior: smooth; }
    </style>

    {{-- Hero Section --}}
    <section class="bg-linear-to-b from-sky-50 to-surface-secondary">
        <div class="mx-auto max-w-7xl px-6 py-16 lg:py-24">
            <div class="grid grid-cols-1 items-center gap-12 lg:grid-cols-2">
                {{-- Hero Text --}}
                <div class="reveal">
                    <div class="badge-gradient mb-8 inline-flex items-center gap-2 rounded-full border border-border-light/80 bg-surface-primary px-4 py-1.5"
                        style="box-shadow: 0 1px 3px rgba(0,0,0,0.04);">
                        <span class="pulse-dot h-1.5 w-1.5 rounded-full bg-linear-to-r from-sky-500 via-slate-500 to-sky-400"></span>
                        <span class="text-sm font-medium text-text-primary">Funkció — Dokumentumkezelés</span>
                    </div>

                    <h1 class="mb-6 text-4xl leading-tight tracking-tight text-text-primary md:text-5xl lg:text-[3.5rem]"
                        style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                        Minden dokumentum —<br>
                        automatikusan, a folyamatból
                    </h1>

                    <p class="mb-10 max-w-xl text-lg text-text-secondary lg:text-xl">
                        Ipari B2B környezetben a dokumentumok nem önálló fájlok — hanem a CRM, az értékesítés, a szerviz, a gyártás és a kontrolling szerves részei. A Cégem360-ban minden dokumentum automatikusan generálódik, aláírható, és visszakereshető.
                    </p>

                    <div class="flex flex-wrap items-center gap-4">
                        <a href="{{ route('contact') }}"
                            class="group inline-flex items-center gap-2 rounded-full bg-sky-600 px-6 py-3 text-base font-medium text-white transition-all hover:bg-sky-700 hover:shadow-lg"
                            style="box-shadow: 0 1px 2px rgba(0,0,0,0.05);">
                            <span>Online konzultáció</span>
                            <svg class="arrow-slide h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" /></svg>
                        </a>
                        <a href="#kepessegek"
                            class="inline-flex items-center gap-2 rounded-full border border-border-light bg-surface-primary px-6 py-3 text-base font-medium text-text-primary transition-all hover:border-sky-200 hover:bg-surface-secondary hover:shadow-md">
                            Képességek áttekintése
                        </a>
                    </div>
                </div>

                {{-- Document Dashboard Visual --}}
                <div class="reveal-right">
                    <div class="rounded-2xl border border-border-light bg-surface-primary p-6"
                        style="box-shadow: 0 4px 20px -4px rgba(0,0,0,0.06);">
                        <div class="mb-4 flex items-center justify-between border-b border-border-light pb-4">
                            <div>
                                <span class="block text-sm font-bold text-text-primary">Dokumentumközpont</span>
                                <span class="block text-[10px] text-text-tertiary">Összes dokumentum · Valós idejű</span>
                            </div>
                            <span class="inline-flex items-center gap-1.5 rounded-md border border-sky-100 bg-linear-to-r from-sky-50 to-slate-50 px-2.5 py-1 text-[10px] font-semibold text-sky-600">
                                <span class="doc-pulse">📄</span>
                                1 284 dokumentum
                            </span>
                        </div>

                        {{-- Document Type Counters --}}
                        <div class="mb-3 grid grid-cols-2 gap-2">
                            <div class="rounded-lg border border-border-light bg-surface-secondary p-2 text-center">
                                <span class="block text-lg font-bold text-sky-600" style="font-family: 'JetBrains Mono', monospace;">342</span>
                                <span class="block text-[9px] font-semibold uppercase tracking-wider text-text-tertiary">Árajánlat</span>
                            </div>
                            <div class="rounded-lg border border-border-light bg-surface-secondary p-2 text-center">
                                <span class="block text-lg font-bold text-amber-600" style="font-family: 'JetBrains Mono', monospace;">187</span>
                                <span class="block text-[9px] font-semibold uppercase tracking-wider text-text-tertiary">Munkalap</span>
                            </div>
                            <div class="rounded-lg border border-border-light bg-surface-secondary p-2 text-center">
                                <span class="block text-lg font-bold text-violet-600" style="font-family: 'JetBrains Mono', monospace;">94</span>
                                <span class="block text-[9px] font-semibold uppercase tracking-wider text-text-tertiary">Szerződés</span>
                            </div>
                            <div class="rounded-lg border border-border-light bg-surface-secondary p-2 text-center">
                                <span class="block text-lg font-bold text-slate-600" style="font-family: 'JetBrains Mono', monospace;">661</span>
                                <span class="block text-[9px] font-semibold uppercase tracking-wider text-text-tertiary">Szállítólevél</span>
                            </div>
                        </div>

                        {{-- Signature Notification --}}
                        <div class="mb-3 rounded-lg border border-sky-100 bg-linear-to-r from-sky-50 to-slate-50 p-3">
                            <div class="mb-1 flex items-center gap-2">
                                <div class="flex h-5 w-5 items-center justify-center rounded-md bg-sky-500 text-[9px] font-bold text-white">✍</div>
                                <span class="text-xs font-bold text-sky-600">E-aláírás értesítés</span>
                            </div>
                            <p class="text-[11px] leading-relaxed text-text-secondary">
                                <strong class="text-sky-700">TechBuild Kft. keretszerződés</strong> — aláírásra vár. Érvényesség: 2026.03.01. A dokumentum a CRM-ből automatikusan generálódott.
                            </p>
                        </div>

                        {{-- Recent Documents --}}
                        <div class="mb-3 space-y-1">
                            <div class="flex items-center justify-between rounded-lg bg-surface-secondary px-3 py-1.5">
                                <div class="flex items-center gap-2">
                                    <span class="h-1.5 w-1.5 rounded-full bg-success-500"></span>
                                    <span class="text-[11px] text-text-secondary">Klímaberendezés árajánlat — AJ-2026-0891</span>
                                </div>
                                <span class="text-[10px] font-semibold text-success-600">Kiküldve</span>
                            </div>
                            <div class="flex items-center justify-between rounded-lg bg-surface-secondary px-3 py-1.5">
                                <div class="flex items-center gap-2">
                                    <span class="h-1.5 w-1.5 rounded-full bg-sky-500"></span>
                                    <span class="text-[11px] text-text-secondary">Helyszíni szerviz munkalap #4821</span>
                                </div>
                                <span class="text-[10px] font-semibold text-sky-600">Aláírva</span>
                            </div>
                            <div class="flex items-center justify-between rounded-lg bg-surface-secondary px-3 py-1.5">
                                <div class="flex items-center gap-2">
                                    <span class="h-1.5 w-1.5 rounded-full bg-amber-500"></span>
                                    <span class="text-[11px] text-text-secondary">Szállítólevél SL-2026-1847</span>
                                </div>
                                <span class="text-[10px] font-semibold text-amber-600">Bevételezésre vár</span>
                            </div>
                            <div class="flex items-center justify-between rounded-lg bg-surface-secondary px-3 py-1.5">
                                <div class="flex items-center gap-2">
                                    <span class="h-1.5 w-1.5 rounded-full bg-violet-500"></span>
                                    <span class="text-[11px] text-text-secondary">Heti vezetői riport KW07</span>
                                </div>
                                <span class="text-[10px] font-semibold text-violet-600">Generálás...</span>
                            </div>
                        </div>

                        {{-- Status bar --}}
                        <div class="mt-3 flex gap-5 border-t border-border-light pt-3">
                            <span class="flex items-center gap-1.5 text-[10px] text-text-tertiary">
                                <span class="h-1.5 w-1.5 rounded-full bg-success-500"></span> 38 aláírt ma
                            </span>
                            <span class="flex items-center gap-1.5 text-[10px] text-text-tertiary">
                                <span class="h-1.5 w-1.5 rounded-full bg-amber-500"></span> 7 aláírásra vár
                            </span>
                            <span class="flex items-center gap-1.5 text-[10px] text-text-tertiary">
                                <span class="h-1.5 w-1.5 rounded-full bg-sky-500"></span> 12 kiküldve ma
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Document Types Section (8 cards) --}}
    <section class="bg-surface-primary py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-6">
            <div class="reveal mb-12">
                <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-sky-600">Dokumentumtípusok</p>
                <h2 class="mb-4 text-3xl text-text-primary md:text-4xl" style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                    8 dokumentumtípus — automatikusan, a modulokból
                </h2>
                <p class="max-w-xl text-lg text-text-secondary">
                    Minden dokumentum ott keletkezik, ahol az üzleti folyamat történik — és azonnal elérhető az egész szervezet számára.
                </p>
            </div>

            <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4" data-stagger>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-7" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="icon-hover mb-5 flex h-12 w-12 items-center justify-center rounded-xl bg-sky-50">
                        <svg class="h-6 w-6 text-sky-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                    </div>
                    <h3 class="mb-2 text-lg font-bold text-text-primary">Árajánlatok</h3>
                    <p class="mb-4 text-sm leading-relaxed text-text-secondary">Professzionális árajánlat a CRM-ből, céges arculatban, termékkalkulációval — egy kattintással, PDF-ben vagy e-mailben.</p>
                    <div class="flex flex-wrap gap-1.5">
                        <span class="rounded bg-sky-50 px-2 py-0.5 text-[10px] font-semibold text-sky-600">CRM</span>
                        <span class="rounded bg-sky-50 px-2 py-0.5 text-[10px] font-semibold text-sky-600">Értékesítés</span>
                    </div>
                </div>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-7" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="icon-hover mb-5 flex h-12 w-12 items-center justify-center rounded-xl bg-violet-50">
                        <svg class="h-6 w-6 text-violet-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" /></svg>
                    </div>
                    <h3 class="mb-2 text-lg font-bold text-text-primary">Szerződések és keretszerződések</h3>
                    <p class="mb-4 text-sm leading-relaxed text-text-secondary">Sablon-alapú szerződésgenerálás, automatikus megújítás-figyelés, e-aláírás és verziókezelés — a teljes életciklus egy helyen.</p>
                    <div class="flex flex-wrap gap-1.5">
                        <span class="rounded bg-sky-50 px-2 py-0.5 text-[10px] font-semibold text-sky-600">CRM</span>
                        <span class="rounded bg-sky-50 px-2 py-0.5 text-[10px] font-semibold text-sky-600">Automatizálás</span>
                    </div>
                </div>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-7" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="icon-hover mb-5 flex h-12 w-12 items-center justify-center rounded-xl bg-amber-50">
                        <svg class="h-6 w-6 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                    </div>
                    <h3 class="mb-2 text-lg font-bold text-text-primary">Szerviz munkalapok</h3>
                    <p class="mb-4 text-sm leading-relaxed text-text-secondary">Helyszíni digitális munkalap fotódokumentációval, anyaglistával, munkaidő-rögzítéssel és helyszíni e-aláírással — mobilról is.</p>
                    <div class="flex flex-wrap gap-1.5">
                        <span class="rounded bg-sky-50 px-2 py-0.5 text-[10px] font-semibold text-sky-600">Munkalap</span>
                        <span class="rounded bg-sky-50 px-2 py-0.5 text-[10px] font-semibold text-sky-600">CRM</span>
                    </div>
                </div>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-7" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="icon-hover mb-5 flex h-12 w-12 items-center justify-center rounded-xl bg-slate-100">
                        <svg class="h-6 w-6 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" /></svg>
                    </div>
                    <h3 class="mb-2 text-lg font-bold text-text-primary">Szállítólevelek</h3>
                    <p class="mb-4 text-sm leading-relaxed text-text-secondary">Automatikus szállítólevél a beszerzési és értékesítési modulból, vonalkódos azonosítással, bevételezési visszaigazolással.</p>
                    <div class="flex flex-wrap gap-1.5">
                        <span class="rounded bg-sky-50 px-2 py-0.5 text-[10px] font-semibold text-sky-600">Beszerzés</span>
                        <span class="rounded bg-sky-50 px-2 py-0.5 text-[10px] font-semibold text-sky-600">Értékesítés</span>
                    </div>
                </div>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-7" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="icon-hover mb-5 flex h-12 w-12 items-center justify-center rounded-xl bg-success-50">
                        <svg class="h-6 w-6 text-success-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" /></svg>
                    </div>
                    <h3 class="mb-2 text-lg font-bold text-text-primary">Minőségi tanúsítványok</h3>
                    <p class="mb-4 text-sm leading-relaxed text-text-secondary">CoC (Certificate of Conformity), mérési jegyzőkönyvek és minőségi bizonylatok — automatikusan csatolva a kiszállításhoz.</p>
                    <div class="flex flex-wrap gap-1.5">
                        <span class="rounded bg-sky-50 px-2 py-0.5 text-[10px] font-semibold text-sky-600">Gyártásirányítás</span>
                    </div>
                </div>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-7" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="icon-hover mb-5 flex h-12 w-12 items-center justify-center rounded-xl bg-indigo-50">
                        <svg class="h-6 w-6 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                    </div>
                    <h3 class="mb-2 text-lg font-bold text-text-primary">Vezetői riportok</h3>
                    <p class="mb-4 text-sm leading-relaxed text-text-secondary">Automatikus heti és havi riportok: KPI-k, projekt-jövedelmezőség, cash flow, piaci helyzet — ütemezetten, PDF-ben a vezetők postaládájába.</p>
                    <div class="flex flex-wrap gap-1.5">
                        <span class="rounded bg-sky-50 px-2 py-0.5 text-[10px] font-semibold text-sky-600">Kontrolling</span>
                        <span class="rounded bg-sky-50 px-2 py-0.5 text-[10px] font-semibold text-sky-600">Automatizálás</span>
                    </div>
                </div>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-7" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="icon-hover mb-5 flex h-12 w-12 items-center justify-center rounded-xl bg-cyan-50">
                        <svg class="h-6 w-6 text-cyan-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 100 4 2 2 0 000-4z" /></svg>
                    </div>
                    <h3 class="mb-2 text-lg font-bold text-text-primary">Megrendelők és rendelés-visszaigazolások</h3>
                    <p class="mb-4 text-sm leading-relaxed text-text-secondary">Beszerzési megrendelő automatikus generálása, szállítói visszaigazolás nyomon követése és archiválása — a teljes rendelési ciklus dokumentálva.</p>
                    <div class="flex flex-wrap gap-1.5">
                        <span class="rounded bg-sky-50 px-2 py-0.5 text-[10px] font-semibold text-sky-600">Beszerzés</span>
                        <span class="rounded bg-sky-50 px-2 py-0.5 text-[10px] font-semibold text-sky-600">Automatizálás</span>
                    </div>
                </div>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-7" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="icon-hover mb-5 flex h-12 w-12 items-center justify-center rounded-xl bg-rose-50">
                        <svg class="h-6 w-6 text-rose-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z" /></svg>
                    </div>
                    <h3 class="mb-2 text-lg font-bold text-text-primary">Marketing anyagok és kampány-riportok</h3>
                    <p class="mb-4 text-sm leading-relaxed text-text-secondary">Kampány-eredmények, ROI kimutatások és marketing anyagok automatikus archiválása — a MarketingHub és a Kontrolling modulból.</p>
                    <div class="flex flex-wrap gap-1.5">
                        <span class="rounded bg-sky-50 px-2 py-0.5 text-[10px] font-semibold text-sky-600">MarketingHub</span>
                        <span class="rounded bg-sky-50 px-2 py-0.5 text-[10px] font-semibold text-sky-600">Kontrolling</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Capabilities Section (6 cards) --}}
    <section class="bg-surface-secondary py-16 lg:py-24" id="kepessegek">
        <div class="mx-auto max-w-7xl px-6">
            <div class="reveal mb-12">
                <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-sky-600">Képességek</p>
                <h2 class="mb-4 text-3xl text-text-primary md:text-4xl" style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                    Nem csak tárolás — teljes dokumentum-életciklus kezelés
                </h2>
                <p class="max-w-xl text-lg text-text-secondary">
                    A Cégem360 dokumentumkezelése túlmutat a hagyományos fájlszerveren vagy DMS rendszeren.
                </p>
            </div>

            <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3" data-stagger>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-7" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="icon-hover mb-5 flex h-12 w-12 items-center justify-center rounded-xl bg-sky-50">
                        <svg class="h-6 w-6 text-sky-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" /></svg>
                    </div>
                    <h3 class="mb-2 text-lg font-bold text-text-primary">Automatikus dokumentumgenerálás</h3>
                    <p class="text-sm leading-relaxed text-text-secondary">Ajánlat, szerződés, munkalap, szállítólevél, riport — automatikusan generálódik a modulokból, az adatok alapján. Nincs kézi másolás, nincs Excel-export.</p>
                </div>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-7" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="icon-hover mb-5 flex h-12 w-12 items-center justify-center rounded-xl bg-violet-50">
                        <svg class="h-6 w-6 text-violet-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" /></svg>
                    </div>
                    <h3 class="mb-2 text-lg font-bold text-text-primary">Digitális aláírás (e-aláírás)</h3>
                    <p class="text-sm leading-relaxed text-text-secondary">Helyszíni e-aláírás mobilon — akár offline is. Az ügyfél a helyszínen aláírja a munkalapot, a rendszer automatikusan archiválja és továbbítja.</p>
                </div>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-7" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="icon-hover mb-5 flex h-12 w-12 items-center justify-center rounded-xl bg-amber-50">
                        <svg class="h-6 w-6 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z" /></svg>
                    </div>
                    <h3 class="mb-2 text-lg font-bold text-text-primary">Sablon-rendszer céges arculattal</h3>
                    <p class="text-sm leading-relaxed text-text-secondary">Minden dokumentum a cég arculatában generálódik: logó, színek, fejléc, lábléc. A sablonok központilag karbantarthatók, a módosítás azonnal érvényesül.</p>
                </div>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-7" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="icon-hover mb-5 flex h-12 w-12 items-center justify-center rounded-xl bg-slate-100">
                        <svg class="h-6 w-6 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    </div>
                    <h3 class="mb-2 text-lg font-bold text-text-primary">Verziókezelés és audit trail</h3>
                    <p class="text-sm leading-relaxed text-text-secondary">Minden dokumentum-verzió megőrződik. Ki módosított, mikor, mit — teljes audit trail az ISO és belső compliance elvárások teljesítéséhez.</p>
                </div>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-7" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="icon-hover mb-5 flex h-12 w-12 items-center justify-center rounded-xl bg-blue-50">
                        <svg class="h-6 w-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                    </div>
                    <h3 class="mb-2 text-lg font-bold text-text-primary">Keresés és szűrés</h3>
                    <p class="text-sm leading-relaxed text-text-secondary">Keresés tartalom, ügyfél, dátum, típus, modul, státusz és címke alapján. Nem a fájlnevet kell tudni — elég a kontextust ismerni.</p>
                </div>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-7" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="icon-hover mb-5 flex h-12 w-12 items-center justify-center rounded-xl bg-success-50">
                        <svg class="h-6 w-6 text-success-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" /></svg>
                    </div>
                    <h3 class="mb-2 text-lg font-bold text-text-primary">Jogosultságkezelés és megosztás</h3>
                    <p class="text-sm leading-relaxed text-text-secondary">Dokumentum-szintű hozzáférés-kontroll: ki láthat, szerkeszthet, küldhet. Ügyfélportálon keresztüli biztonságos megosztás külső partnereknek.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Module Document Map Section (6 cards) --}}
    <section class="bg-surface-primary py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-6">
            <div class="reveal mb-12">
                <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-sky-600">Modul-dokumentum térkép</p>
                <h2 class="mb-4 text-3xl text-text-primary md:text-4xl" style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                    Melyik modul — milyen dokumentumot generál?
                </h2>
                <p class="max-w-xl text-lg text-text-secondary">
                    A Cégem360-ban minden dokumentum egy modulhoz kapcsolódik — és onnan automatikusan keletkezik.
                </p>
            </div>

            <div class="grid grid-cols-1 gap-6 md:grid-cols-2" data-stagger>
                {{-- CRM & Értékesítés --}}
                <div class="stagger-item card-glow group rounded-2xl border border-border-light bg-surface-primary p-8" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="mb-5 flex items-center gap-4">
                        <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-success-50">
                            <x-module-icon module="crm" class="h-5 w-5 text-success-600" />
                        </div>
                        <div>
                            <span class="block text-sm font-bold text-text-primary">CRM & Értékesítés</span>
                            <span class="text-xs text-text-tertiary">Ügyfélkapcsolati dokumentumok</span>
                        </div>
                    </div>
                    <div class="space-y-2">
                        <div class="flex items-center justify-between rounded-lg bg-surface-secondary px-3 py-2">
                            <span class="text-sm text-text-secondary">Árajánlat</span>
                            <span class="rounded bg-sky-50 px-2 py-0.5 text-[10px] font-semibold text-sky-600">AUTO</span>
                        </div>
                        <div class="flex items-center justify-between rounded-lg bg-surface-secondary px-3 py-2">
                            <span class="text-sm text-text-secondary">Szerződés</span>
                            <span class="rounded bg-sky-50 px-2 py-0.5 text-[10px] font-semibold text-sky-600">AUTO</span>
                        </div>
                        <div class="flex items-center justify-between rounded-lg bg-surface-secondary px-3 py-2">
                            <span class="text-sm text-text-secondary">Megrendelés-visszaigazolás</span>
                            <span class="rounded bg-sky-50 px-2 py-0.5 text-[10px] font-semibold text-sky-600">AUTO</span>
                        </div>
                        <div class="flex items-center justify-between rounded-lg bg-surface-secondary px-3 py-2">
                            <span class="text-sm text-text-secondary">Ügyfél-nyilvántartás</span>
                            <span class="rounded bg-sky-50 px-2 py-0.5 text-[10px] font-semibold text-sky-600">AUTO</span>
                        </div>
                    </div>
                </div>

                {{-- Gyártásirányítás --}}
                <div class="stagger-item card-glow group rounded-2xl border border-border-light bg-surface-primary p-8" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="mb-5 flex items-center gap-4">
                        <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-orange-50">
                            <x-module-icon module="gyartas" class="h-5 w-5 text-orange-600" />
                        </div>
                        <div>
                            <span class="block text-sm font-bold text-text-primary">Gyártásirányítás</span>
                            <span class="text-xs text-text-tertiary">Termelési és minőségi dokumentumok</span>
                        </div>
                    </div>
                    <div class="space-y-2">
                        <div class="flex items-center justify-between rounded-lg bg-surface-secondary px-3 py-2">
                            <span class="text-sm text-text-secondary">Gyártási utasítás</span>
                            <span class="rounded bg-sky-50 px-2 py-0.5 text-[10px] font-semibold text-sky-600">AUTO</span>
                        </div>
                        <div class="flex items-center justify-between rounded-lg bg-surface-secondary px-3 py-2">
                            <span class="text-sm text-text-secondary">Minőségi tanúsítvány</span>
                            <span class="rounded bg-sky-50 px-2 py-0.5 text-[10px] font-semibold text-sky-600">AUTO</span>
                        </div>
                        <div class="flex items-center justify-between rounded-lg bg-surface-secondary px-3 py-2">
                            <span class="text-sm text-text-secondary">Mérési jegyzőkönyv</span>
                            <span class="rounded bg-sky-50 px-2 py-0.5 text-[10px] font-semibold text-sky-600">AUTO</span>
                        </div>
                        <div class="flex items-center justify-between rounded-lg bg-surface-secondary px-3 py-2">
                            <span class="text-sm text-text-secondary">Selejt-jelentés</span>
                            <span class="rounded bg-sky-50 px-2 py-0.5 text-[10px] font-semibold text-sky-600">AUTO</span>
                        </div>
                    </div>
                </div>

                {{-- Beszerzés-logisztika --}}
                <div class="stagger-item card-glow group rounded-2xl border border-border-light bg-surface-primary p-8" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="mb-5 flex items-center gap-4">
                        <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-cyan-50">
                            <x-module-icon module="beszerzes" class="h-5 w-5 text-cyan-600" />
                        </div>
                        <div>
                            <span class="block text-sm font-bold text-text-primary">Beszerzés-logisztika</span>
                            <span class="text-xs text-text-tertiary">Beszerzési és logisztikai dokumentumok</span>
                        </div>
                    </div>
                    <div class="space-y-2">
                        <div class="flex items-center justify-between rounded-lg bg-surface-secondary px-3 py-2">
                            <span class="text-sm text-text-secondary">Szállítói megrendelő</span>
                            <span class="rounded bg-sky-50 px-2 py-0.5 text-[10px] font-semibold text-sky-600">AUTO</span>
                        </div>
                        <div class="flex items-center justify-between rounded-lg bg-surface-secondary px-3 py-2">
                            <span class="text-sm text-text-secondary">Szállítólevél</span>
                            <span class="rounded bg-sky-50 px-2 py-0.5 text-[10px] font-semibold text-sky-600">AUTO</span>
                        </div>
                        <div class="flex items-center justify-between rounded-lg bg-surface-secondary px-3 py-2">
                            <span class="text-sm text-text-secondary">Bevételezési bizonylat</span>
                            <span class="rounded bg-sky-50 px-2 py-0.5 text-[10px] font-semibold text-sky-600">AUTO</span>
                        </div>
                        <div class="flex items-center justify-between rounded-lg bg-surface-secondary px-3 py-2">
                            <span class="text-sm text-text-secondary">Leltárív</span>
                            <span class="rounded bg-sky-50 px-2 py-0.5 text-[10px] font-semibold text-sky-600">AUTO</span>
                        </div>
                    </div>
                </div>

                {{-- Digitális munkalap --}}
                <div class="stagger-item card-glow group rounded-2xl border border-border-light bg-surface-primary p-8" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="mb-5 flex items-center gap-4">
                        <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-rose-50">
                            <x-module-icon module="szerviz" class="h-5 w-5 text-rose-600" />
                        </div>
                        <div>
                            <span class="block text-sm font-bold text-text-primary">Digitális munkalap</span>
                            <span class="text-xs text-text-tertiary">Helyszíni és szerviz dokumentumok</span>
                        </div>
                    </div>
                    <div class="space-y-2">
                        <div class="flex items-center justify-between rounded-lg bg-surface-secondary px-3 py-2">
                            <span class="text-sm text-text-secondary">Szerviz munkalap</span>
                            <span class="rounded bg-sky-50 px-2 py-0.5 text-[10px] font-semibold text-sky-600">AUTO</span>
                        </div>
                        <div class="flex items-center justify-between rounded-lg bg-surface-secondary px-3 py-2">
                            <span class="text-sm text-text-secondary">Karbantartási jegyzőkönyv</span>
                            <span class="rounded bg-sky-50 px-2 py-0.5 text-[10px] font-semibold text-sky-600">AUTO</span>
                        </div>
                        <div class="flex items-center justify-between rounded-lg bg-surface-secondary px-3 py-2">
                            <span class="text-sm text-text-secondary">Műszak-jelentés</span>
                            <span class="rounded bg-sky-50 px-2 py-0.5 text-[10px] font-semibold text-sky-600">AUTO</span>
                        </div>
                        <div class="flex items-center justify-between rounded-lg bg-surface-secondary px-3 py-2">
                            <span class="text-sm text-text-secondary">Átadás-átvételi jegyzőkönyv</span>
                            <span class="rounded bg-sky-50 px-2 py-0.5 text-[10px] font-semibold text-sky-600">AUTO</span>
                        </div>
                    </div>
                </div>

                {{-- Kontrolling --}}
                <div class="stagger-item card-glow group rounded-2xl border border-border-light bg-surface-primary p-8" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="mb-5 flex items-center gap-4">
                        <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-violet-50">
                            <x-module-icon module="kontrolling" class="h-5 w-5 text-violet-600" />
                        </div>
                        <div>
                            <span class="block text-sm font-bold text-text-primary">Kontrolling</span>
                            <span class="text-xs text-text-tertiary">Pénzügyi és vezetői riportok</span>
                        </div>
                    </div>
                    <div class="space-y-2">
                        <div class="flex items-center justify-between rounded-lg bg-surface-secondary px-3 py-2">
                            <span class="text-sm text-text-secondary">Heti vezetői riport</span>
                            <span class="rounded bg-sky-50 px-2 py-0.5 text-[10px] font-semibold text-sky-600">AUTO</span>
                        </div>
                        <div class="flex items-center justify-between rounded-lg bg-surface-secondary px-3 py-2">
                            <span class="text-sm text-text-secondary">Havi P&L</span>
                            <span class="rounded bg-sky-50 px-2 py-0.5 text-[10px] font-semibold text-sky-600">AUTO</span>
                        </div>
                        <div class="flex items-center justify-between rounded-lg bg-surface-secondary px-3 py-2">
                            <span class="text-sm text-text-secondary">Projekt-jövedelmezőségi kimutatás</span>
                            <span class="rounded bg-sky-50 px-2 py-0.5 text-[10px] font-semibold text-sky-600">AUTO</span>
                        </div>
                        <div class="flex items-center justify-between rounded-lg bg-surface-secondary px-3 py-2">
                            <span class="text-sm text-text-secondary">Tulajdonosi riport</span>
                            <span class="rounded bg-sky-50 px-2 py-0.5 text-[10px] font-semibold text-sky-600">AUTO</span>
                        </div>
                    </div>
                </div>

                {{-- Automatizálás --}}
                <div class="stagger-item card-glow group rounded-2xl border border-border-light bg-surface-primary p-8" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="mb-5 flex items-center gap-4">
                        <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-amber-50">
                            <x-module-icon module="automatizalas" class="h-5 w-5 text-amber-600" />
                        </div>
                        <div>
                            <span class="block text-sm font-bold text-text-primary">Automatizálás</span>
                            <span class="text-xs text-text-tertiary">Trigger-alapú dokumentumok</span>
                        </div>
                    </div>
                    <div class="space-y-2">
                        <div class="flex items-center justify-between rounded-lg bg-surface-secondary px-3 py-2">
                            <span class="text-sm text-text-secondary">Garancia-lejárat értesítés</span>
                            <span class="rounded bg-sky-50 px-2 py-0.5 text-[10px] font-semibold text-sky-600">AUTO</span>
                        </div>
                        <div class="flex items-center justify-between rounded-lg bg-surface-secondary px-3 py-2">
                            <span class="text-sm text-text-secondary">Szerződés-megújítás emlékeztető</span>
                            <span class="rounded bg-sky-50 px-2 py-0.5 text-[10px] font-semibold text-sky-600">AUTO</span>
                        </div>
                        <div class="flex items-center justify-between rounded-lg bg-surface-secondary px-3 py-2">
                            <span class="text-sm text-text-secondary">Jóváhagyás-kérelem PDF</span>
                            <span class="rounded bg-sky-50 px-2 py-0.5 text-[10px] font-semibold text-sky-600">AUTO</span>
                        </div>
                        <div class="flex items-center justify-between rounded-lg bg-surface-secondary px-3 py-2">
                            <span class="text-sm text-text-secondary">Elégedettségi kérdőív eredmény</span>
                            <span class="rounded bg-sky-50 px-2 py-0.5 text-[10px] font-semibold text-sky-600">AUTO</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Document Workflow Section (6 steps) --}}
    <section class="bg-surface-secondary py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-6">
            <div class="reveal mb-12">
                <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-sky-600">Dokumentum-életciklus</p>
                <h2 class="mb-4 text-3xl text-text-primary md:text-4xl" style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                    6 lépés — a generálástól az archiválásig
                </h2>
                <p class="max-w-xl text-lg text-text-secondary">
                    Minden dokumentum ugyanazt a szabványos életciklust járja be.
                </p>
            </div>

            <div class="grid grid-cols-2 gap-5 sm:grid-cols-3 lg:grid-cols-6" data-stagger>
                <div class="stagger-item text-center">
                    <div class="mx-auto mb-4 flex h-16 w-16 items-center justify-center rounded-full border-2 border-sky-200 bg-surface-primary text-xl font-bold text-sky-600">01</div>
                    <h4 class="mb-1 text-sm font-bold text-text-primary">Generálás</h4>
                    <p class="text-xs text-text-tertiary">Sablon + adatok = dokumentum. Automatikusan, a modulból.</p>
                </div>
                <div class="stagger-item text-center">
                    <div class="mx-auto mb-4 flex h-16 w-16 items-center justify-center rounded-full border-2 border-slate-200 bg-surface-primary text-xl font-bold text-slate-600">02</div>
                    <h4 class="mb-1 text-sm font-bold text-text-primary">Szerkesztés</h4>
                    <p class="text-xs text-text-tertiary">Kézi módosítás, verziószámmal és változás-naplóval.</p>
                </div>
                <div class="stagger-item text-center">
                    <div class="mx-auto mb-4 flex h-16 w-16 items-center justify-center rounded-full border-2 border-amber-200 bg-surface-primary text-xl font-bold text-amber-600">03</div>
                    <h4 class="mb-1 text-sm font-bold text-text-primary">Jóváhagyás</h4>
                    <p class="text-xs text-text-tertiary">Szabály-alapú jóváhagyási workflow, értesítésekkel.</p>
                </div>
                <div class="stagger-item text-center">
                    <div class="mx-auto mb-4 flex h-16 w-16 items-center justify-center rounded-full border-2 border-violet-200 bg-surface-primary text-xl font-bold text-violet-600">04</div>
                    <h4 class="mb-1 text-sm font-bold text-text-primary">Aláírás</h4>
                    <p class="text-xs text-text-tertiary">Digitális e-aláírás — helyszínen, mobilon, akár offline.</p>
                </div>
                <div class="stagger-item text-center">
                    <div class="mx-auto mb-4 flex h-16 w-16 items-center justify-center rounded-full border-2 border-blue-200 bg-surface-primary text-xl font-bold text-blue-600">05</div>
                    <h4 class="mb-1 text-sm font-bold text-text-primary">Kiküldés</h4>
                    <p class="text-xs text-text-tertiary">Automatikus PDF küldés e-mailben vagy ügyfélportálon.</p>
                </div>
                <div class="stagger-item text-center">
                    <div class="mx-auto mb-4 flex h-16 w-16 items-center justify-center rounded-full border-2 border-success-200 bg-surface-primary text-xl font-bold text-success-600">06</div>
                    <h4 class="mb-1 text-sm font-bold text-text-primary">Archiválás</h4>
                    <p class="text-xs text-text-tertiary">Aláírt, végleges dokumentum — kereshető archívumban.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Stats Section --}}
    <section class="bg-surface-primary py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-6">
            <div class="reveal mb-12 text-center">
                <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-sky-600">Eredmények</p>
                <h2 class="text-3xl text-text-primary md:text-4xl" style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                    Mérhető hatás a dokumentumkezelésben
                </h2>
            </div>

            <div class="grid grid-cols-2 gap-5 lg:grid-cols-4" data-stagger data-counter-trigger>
                <div class="stagger-item stat-hover rounded-2xl border border-border-light bg-surface-primary p-8 text-center" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <span class="stat-value block text-4xl font-bold text-sky-600 lg:text-5xl" style="font-family: 'JetBrains Mono', monospace;"
                        data-count="80" data-prefix="-" data-suffix="%">0%</span>
                    <span class="mt-2 block text-sm text-text-secondary">Dokumentum-készítési idő</span>
                </div>
                <div class="stagger-item stat-hover rounded-2xl border border-border-light bg-surface-primary p-8 text-center" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <span class="stat-value block text-4xl font-bold text-success-600 lg:text-5xl" style="font-family: 'JetBrains Mono', monospace;"
                        data-count="0" data-suffix="">0</span>
                    <span class="mt-2 block text-sm text-text-secondary">Elveszett dokumentum</span>
                </div>
                <div class="stagger-item stat-hover rounded-2xl border border-border-light bg-surface-primary p-8 text-center" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <span class="stat-value block text-4xl font-bold text-amber-600 lg:text-5xl" style="font-family: 'JetBrains Mono', monospace;"
                        data-count="95" data-prefix="-" data-suffix="%">0%</span>
                    <span class="mt-2 block text-sm text-text-secondary">Papírfelhasználás</span>
                </div>
                <div class="stagger-item stat-hover rounded-2xl border border-border-light bg-surface-primary p-8 text-center" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <span class="stat-value block text-4xl font-bold text-violet-600 lg:text-5xl" style="font-family: 'JetBrains Mono', monospace;"
                        data-count="100" data-suffix="%">0%</span>
                    <span class="mt-2 block text-sm text-text-secondary">Audit-nyomonkövethetőség</span>
                </div>
            </div>
        </div>
    </section>

    {{-- Competitor Comparison Section (3 cards) --}}
    <section class="bg-surface-secondary py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-6">
            <div class="reveal mb-12">
                <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-sky-600">Összehasonlítás</p>
                <h2 class="mb-4 text-3xl text-text-primary md:text-4xl" style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                    Miért nem elég a hagyományos megoldás?
                </h2>
                <p class="max-w-xl text-lg text-text-secondary">
                    Az ipari dokumentumkezelés más, mint egy általános DMS. Összehasonlítottuk a piacon elérhető megközelítéseket.
                </p>
            </div>

            <div class="grid grid-cols-1 gap-6 lg:grid-cols-3" data-stagger>
                {{-- Általános DMS --}}
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-8" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="mb-5">
                        <span class="mb-1 block text-xs font-semibold uppercase tracking-wider text-text-tertiary">Általános DMS rendszerek</span>
                        <span class="block text-[11px] text-text-tertiary">SharePoint, Google Drive, M-Files, DocuWare</span>
                    </div>
                    <div class="mb-5 space-y-2">
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><svg class="h-4 w-4 text-success-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>Fájlkezelés és verziókövetés</span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><svg class="h-4 w-4 text-success-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>Keresés és szűrés</span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><svg class="h-4 w-4 text-success-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>Jogosultságkezelés</span>
                    </div>
                    <div class="space-y-2 border-t border-border-light pt-5">
                        <span class="flex items-center gap-2 text-sm text-text-tertiary"><svg class="h-4 w-4 text-danger-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>Nem generál dokumentumot</span>
                        <span class="flex items-center gap-2 text-sm text-text-tertiary"><svg class="h-4 w-4 text-danger-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>Nincs ipari workflow</span>
                        <span class="flex items-center gap-2 text-sm text-text-tertiary"><svg class="h-4 w-4 text-danger-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>Nincs e-aláírás</span>
                        <span class="flex items-center gap-2 text-sm text-text-tertiary"><svg class="h-4 w-4 text-danger-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>Külön rendszer, integráció kell</span>
                    </div>
                </div>

                {{-- ERP modulok --}}
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-8" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="mb-5">
                        <span class="mb-1 block text-xs font-semibold uppercase tracking-wider text-text-tertiary">ERP modulok</span>
                        <span class="block text-[11px] text-text-tertiary">SAP, Microsoft Dynamics, Odoo, Navision</span>
                    </div>
                    <div class="mb-5 space-y-2">
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><svg class="h-4 w-4 text-success-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>Részleges dokumentumgenerálás</span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><svg class="h-4 w-4 text-success-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>Audit trail</span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><svg class="h-4 w-4 text-success-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>Folyamat-integráció</span>
                    </div>
                    <div class="space-y-2 border-t border-border-light pt-5">
                        <span class="flex items-center gap-2 text-sm text-text-tertiary"><svg class="h-4 w-4 text-danger-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>Bonyolult sablon-kezelés</span>
                        <span class="flex items-center gap-2 text-sm text-text-tertiary"><svg class="h-4 w-4 text-danger-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>Nincs helyszíni e-aláírás</span>
                        <span class="flex items-center gap-2 text-sm text-text-tertiary"><svg class="h-4 w-4 text-danger-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>Nincs MI riport</span>
                        <span class="flex items-center gap-2 text-sm text-text-tertiary"><svg class="h-4 w-4 text-danger-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>Drága ügyfélportál modul</span>
                    </div>
                </div>

                {{-- Cégem360 (highlighted) --}}
                <div class="stagger-item card-glow rounded-2xl border border-sky-200 bg-sky-50 p-8" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="mb-5">
                        <span class="mb-1 block text-xs font-semibold uppercase tracking-wider text-sky-600">Cégem360</span>
                        <span class="block text-[11px] text-text-tertiary">Integrált üzleti platform, 11 modul</span>
                    </div>
                    <div class="space-y-2">
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><svg class="h-4 w-4 text-success-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>Automatikus generálás modulokból</span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><svg class="h-4 w-4 text-success-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>Helyszíni e-aláírás mobilon</span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><svg class="h-4 w-4 text-success-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>Ipari sablon-rendszer, céges arculat</span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><svg class="h-4 w-4 text-success-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>MI riportok (DataMind)</span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><svg class="h-4 w-4 text-success-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>Beépített ügyfélportál</span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><svg class="h-4 w-4 text-success-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>Teljes audit trail + verziókezelés</span>
                    </div>
                    <div class="mt-5 rounded-lg bg-surface-primary p-3">
                        <p class="text-xs font-semibold text-sky-700">A dokumentum nem külön rendszer — hanem a folyamat része. Nem kell integrálni, mert eleve ott van.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Detailed Comparison Table (10 rows × 5 columns) --}}
    <section class="bg-surface-primary py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-6">
            <div class="reveal mb-12">
                <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-sky-600">Részletes összehasonlítás</p>
                <h2 class="mb-4 text-3xl text-text-primary md:text-4xl" style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                    Funkció-összehasonlítás — részletesen
                </h2>
                <p class="max-w-xl text-lg text-text-secondary">
                    10 kulcsképesség mentén hasonlítottuk össze a megoldásokat.
                </p>
            </div>

            <div class="reveal overflow-x-auto">
                <table class="w-full min-w-[800px] border-collapse overflow-hidden rounded-2xl border border-border-light">
                    <thead>
                        <tr class="bg-surface-primary">
                            <th class="px-5 py-4 text-left text-xs font-bold uppercase tracking-wider text-text-primary">Képesség</th>
                            <th class="px-5 py-4 text-left text-xs font-bold uppercase tracking-wider text-text-tertiary">Fájlszerver / Drive</th>
                            <th class="px-5 py-4 text-left text-xs font-bold uppercase tracking-wider text-text-tertiary">Általános DMS</th>
                            <th class="px-5 py-4 text-left text-xs font-bold uppercase tracking-wider text-text-tertiary">ERP modul</th>
                            <th class="px-5 py-4 text-left text-xs font-bold uppercase tracking-wider text-sky-600">Cégem360</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-border-light">
                        <tr>
                            <td class="px-5 py-4 text-sm font-semibold text-text-primary">Automatikus dokumentumgenerálás</td>
                            <td class="px-5 py-4 text-sm text-text-tertiary">✗</td>
                            <td class="px-5 py-4 text-sm text-text-tertiary">✗</td>
                            <td class="px-5 py-4 text-sm text-text-tertiary">Részben</td>
                            <td class="px-5 py-4 text-sm font-medium text-success-600">✓ Teljes</td>
                        </tr>
                        <tr>
                            <td class="px-5 py-4 text-sm font-semibold text-text-primary">Sablon-rendszer (arculat)</td>
                            <td class="px-5 py-4 text-sm text-text-tertiary">Kézi</td>
                            <td class="px-5 py-4 text-sm text-text-tertiary">Korlátozott</td>
                            <td class="px-5 py-4 text-sm text-text-tertiary">Bonyolult</td>
                            <td class="px-5 py-4 text-sm font-medium text-success-600">✓ Céges arculat</td>
                        </tr>
                        <tr>
                            <td class="px-5 py-4 text-sm font-semibold text-text-primary">Helyszíni e-aláírás</td>
                            <td class="px-5 py-4 text-sm text-text-tertiary">✗</td>
                            <td class="px-5 py-4 text-sm text-text-tertiary">✗</td>
                            <td class="px-5 py-4 text-sm text-text-tertiary">✗</td>
                            <td class="px-5 py-4 text-sm font-medium text-success-600">✓ Mobilon, offline is</td>
                        </tr>
                        <tr>
                            <td class="px-5 py-4 text-sm font-semibold text-text-primary">Fotódokumentáció</td>
                            <td class="px-5 py-4 text-sm text-text-tertiary">Külön</td>
                            <td class="px-5 py-4 text-sm text-text-tertiary">Külön</td>
                            <td class="px-5 py-4 text-sm text-text-tertiary">✗</td>
                            <td class="px-5 py-4 text-sm font-medium text-success-600">✓ Munkalapból, beágyazva</td>
                        </tr>
                        <tr>
                            <td class="px-5 py-4 text-sm font-semibold text-text-primary">Verziókezelés & audit trail</td>
                            <td class="px-5 py-4 text-sm text-text-tertiary">Alap</td>
                            <td class="px-5 py-4 text-sm text-text-tertiary">Teljes</td>
                            <td class="px-5 py-4 text-sm text-text-tertiary">Teljes</td>
                            <td class="px-5 py-4 text-sm font-medium text-success-600">✓ Teljes</td>
                        </tr>
                        <tr>
                            <td class="px-5 py-4 text-sm font-semibold text-text-primary">Jóváhagyási workflow</td>
                            <td class="px-5 py-4 text-sm text-text-tertiary">✗</td>
                            <td class="px-5 py-4 text-sm text-text-tertiary">Alap</td>
                            <td class="px-5 py-4 text-sm text-text-tertiary">Komplex</td>
                            <td class="px-5 py-4 text-sm font-medium text-success-600">✓ Drag-and-drop</td>
                        </tr>
                        <tr>
                            <td class="px-5 py-4 text-sm font-semibold text-text-primary">MI riportok és összefoglalók</td>
                            <td class="px-5 py-4 text-sm text-text-tertiary">✗</td>
                            <td class="px-5 py-4 text-sm text-text-tertiary">✗</td>
                            <td class="px-5 py-4 text-sm text-text-tertiary">✗</td>
                            <td class="px-5 py-4 text-sm font-medium text-success-600">✓ DataMind</td>
                        </tr>
                        <tr>
                            <td class="px-5 py-4 text-sm font-semibold text-text-primary">Ügyfélportál megosztás</td>
                            <td class="px-5 py-4 text-sm text-text-tertiary">Link</td>
                            <td class="px-5 py-4 text-sm text-text-tertiary">Korlátozott</td>
                            <td class="px-5 py-4 text-sm text-text-tertiary">Drága modul</td>
                            <td class="px-5 py-4 text-sm font-medium text-success-600">✓ Beépített</td>
                        </tr>
                        <tr>
                            <td class="px-5 py-4 text-sm font-semibold text-text-primary">Keresés tartalom alapján</td>
                            <td class="px-5 py-4 text-sm text-text-tertiary">Fájlnév</td>
                            <td class="px-5 py-4 text-sm text-text-tertiary">Teljes</td>
                            <td class="px-5 py-4 text-sm text-text-tertiary">Korlátozott</td>
                            <td class="px-5 py-4 text-sm font-medium text-success-600">✓ Teljes + kontextus</td>
                        </tr>
                        <tr>
                            <td class="px-5 py-4 text-sm font-semibold text-text-primary">Ipari dokumentumtípusok</td>
                            <td class="px-5 py-4 text-sm text-text-tertiary">Nincs</td>
                            <td class="px-5 py-4 text-sm text-text-tertiary">Általános</td>
                            <td class="px-5 py-4 text-sm text-text-tertiary">Részben</td>
                            <td class="px-5 py-4 text-sm font-medium text-success-600">✓ Munkalap, CoC, stb.</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    {{-- Use Cases Section (6 cases) --}}
    <section class="bg-surface-secondary py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-6">
            <div class="reveal mb-12">
                <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-sky-600">Felhasználási esetek</p>
                <h2 class="mb-4 text-3xl text-text-primary md:text-4xl" style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                    Így használják ipari vállalatok a dokumentumkezelést
                </h2>
            </div>

            <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3" data-stagger>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-7" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <span class="mb-4 block text-xs font-semibold text-text-tertiary" style="font-family: 'JetBrains Mono', monospace;">01</span>
                    <h3 class="mb-2 text-base font-bold text-text-primary">Ajánlat küldése CRM-ből — 1 kattintás</h3>
                    <p class="mb-4 text-sm leading-relaxed text-text-secondary">Az értékesítő a CRM-ben kiválasztja a terméket, a rendszer generálja az árajánlatot céges arculatban, kalkulációval — és elküldi az ügyfélnek. A teljes folyamat 30 másodperc.</p>
                    <div class="flex flex-wrap gap-1.5">
                        <span class="rounded bg-sky-50 px-2 py-0.5 text-[10px] font-semibold text-sky-600">CRM</span>
                        <span class="rounded bg-sky-50 px-2 py-0.5 text-[10px] font-semibold text-sky-600">Értékesítés</span>
                    </div>
                </div>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-7" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <span class="mb-4 block text-xs font-semibold text-text-tertiary" style="font-family: 'JetBrains Mono', monospace;">02</span>
                    <h3 class="mb-2 text-base font-bold text-text-primary">Helyszíni szerviz munkalap e-aláírással</h3>
                    <p class="mb-4 text-sm leading-relaxed text-text-secondary">A szerelő a helyszínen kitölti a munkalapot mobilon, csatolja a fotókat, az ügyfél helyben aláírja. A dokumentum azonnal elérhető a CRM-ben és a számlázáshoz.</p>
                    <div class="flex flex-wrap gap-1.5">
                        <span class="rounded bg-sky-50 px-2 py-0.5 text-[10px] font-semibold text-sky-600">Munkalap</span>
                        <span class="rounded bg-sky-50 px-2 py-0.5 text-[10px] font-semibold text-sky-600">CRM</span>
                    </div>
                </div>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-7" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <span class="mb-4 block text-xs font-semibold text-text-tertiary" style="font-family: 'JetBrains Mono', monospace;">03</span>
                    <h3 class="mb-2 text-base font-bold text-text-primary">Automatikus heti vezetői riport</h3>
                    <p class="mb-4 text-sm leading-relaxed text-text-secondary">Minden hétfőn 8:00-ra a rendszer automatikusan generálja a heti riportot: KPI-k, változások, projektek, kockázatok — PDF-ben, a vezetők postaládájába.</p>
                    <div class="flex flex-wrap gap-1.5">
                        <span class="rounded bg-sky-50 px-2 py-0.5 text-[10px] font-semibold text-sky-600">Kontrolling</span>
                        <span class="rounded bg-sky-50 px-2 py-0.5 text-[10px] font-semibold text-sky-600">DataMind</span>
                        <span class="rounded bg-sky-50 px-2 py-0.5 text-[10px] font-semibold text-sky-600">Automatizálás</span>
                    </div>
                </div>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-7" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <span class="mb-4 block text-xs font-semibold text-text-tertiary" style="font-family: 'JetBrains Mono', monospace;">04</span>
                    <h3 class="mb-2 text-base font-bold text-text-primary">Szerződés-kezelés és automatikus megújítás</h3>
                    <p class="mb-4 text-sm leading-relaxed text-text-secondary">A rendszer figyeli a szerződések lejáratát, 60 nappal előtte emlékezteti az értékesítőt, és előkészíti a megújítási ajánlatot — automatikusan, a sablon és a feltételek alapján.</p>
                    <div class="flex flex-wrap gap-1.5">
                        <span class="rounded bg-sky-50 px-2 py-0.5 text-[10px] font-semibold text-sky-600">CRM</span>
                        <span class="rounded bg-sky-50 px-2 py-0.5 text-[10px] font-semibold text-sky-600">Automatizálás</span>
                    </div>
                </div>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-7" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <span class="mb-4 block text-xs font-semibold text-text-tertiary" style="font-family: 'JetBrains Mono', monospace;">05</span>
                    <h3 class="mb-2 text-base font-bold text-text-primary">Minőségi tanúsítvány csatolása a kiszállításhoz</h3>
                    <p class="mb-4 text-sm leading-relaxed text-text-secondary">A gyártás befejezésekor a rendszer automatikusan csatolja a CoC-t és a mérési jegyzőkönyvet a szállítólevélhez — a vevő azonnal megkapja a kiszállítással együtt.</p>
                    <div class="flex flex-wrap gap-1.5">
                        <span class="rounded bg-sky-50 px-2 py-0.5 text-[10px] font-semibold text-sky-600">Gyártásirányítás</span>
                        <span class="rounded bg-sky-50 px-2 py-0.5 text-[10px] font-semibold text-sky-600">Beszerzés</span>
                    </div>
                </div>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-7" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <span class="mb-4 block text-xs font-semibold text-text-tertiary" style="font-family: 'JetBrains Mono', monospace;">06</span>
                    <h3 class="mb-2 text-base font-bold text-text-primary">Ügyfélportál: minden dokumentum egy helyen</h3>
                    <p class="mb-4 text-sm leading-relaxed text-text-secondary">Az ügyfél bejelentkezik a portálra és eléri az összes hozzá tartozó dokumentumot: ajánlatokat, szerződéseket, munkalapokat, számlákat — biztonságos, jogosultság-alapú hozzáféréssel.</p>
                    <div class="flex flex-wrap gap-1.5">
                        <span class="rounded bg-sky-50 px-2 py-0.5 text-[10px] font-semibold text-sky-600">CRM</span>
                        <span class="rounded bg-sky-50 px-2 py-0.5 text-[10px] font-semibold text-sky-600">Ügyfélportál</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Consultation Section --}}
    <section class="bg-surface-primary py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-6">
            <div class="reveal">
                <div class="grid grid-cols-1 items-center gap-8 rounded-2xl border border-border-light bg-surface-secondary p-8 lg:grid-cols-[1fr_auto] lg:p-12" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div>
                        <h3 class="mb-3 text-xl font-bold text-text-primary lg:text-2xl" style="font-family: 'Poppins', sans-serif;">Személyre szabott online konzultáció</h3>
                        <p class="mb-5 text-base text-text-secondary">30 perces videóhívás, amelyben bemutatjuk, hogyan automatizálhatja az ipari dokumentumkezelést a Cégem360-nal — a generálástól az e-aláíráson át az archiválásig.</p>
                        <div class="flex flex-wrap gap-5">
                            <span class="flex items-center gap-1.5 text-sm text-text-tertiary"><svg class="h-4 w-4 text-success-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>30 perc videóhívás</span>
                            <span class="flex items-center gap-1.5 text-sm text-text-tertiary"><svg class="h-4 w-4 text-success-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>Dokumentum-audit</span>
                            <span class="flex items-center gap-1.5 text-sm text-text-tertiary"><svg class="h-4 w-4 text-success-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>Nincs elköteleződés</span>
                        </div>
                    </div>
                    <a href="{{ route('contact') }}" class="group inline-flex items-center gap-2 rounded-full bg-sky-600 px-6 py-3 text-base font-medium text-white transition-all hover:bg-sky-700 hover:shadow-lg" style="box-shadow: 0 1px 2px rgba(0,0,0,0.05);">
                        <span>Konzultációt kérek</span>
                        <svg class="arrow-slide h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" /></svg>
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{-- Footer CTA Section --}}
    <section class="bg-linear-to-b from-surface-secondary to-surface-primary py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-6">
            <div class="reveal mb-12 text-center">
                <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-sky-600">Kezdje el</p>
                <h2 class="mb-4 text-3xl text-text-primary md:text-4xl" style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                    Készen áll a papírmentes ipari dokumentumkezelésre?
                </h2>
                <p class="mx-auto max-w-xl text-lg text-text-secondary">
                    Válassza ki a következő lépést az Ön számára.
                </p>
            </div>

            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2" data-stagger>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-8 text-center" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <h3 class="mb-3 text-xl font-bold text-text-primary">Online konzultáció</h3>
                    <p class="mb-6 text-sm text-text-secondary">Kérdezzen szakértőinktől 30 percben — videóhíváson, az Ön dokumentumkezelési kihívásaira szabva, kötelezettség nélkül.</p>
                    <a href="{{ route('contact') }}" class="inline-flex items-center gap-2 rounded-full border border-border-light bg-surface-secondary px-6 py-3 text-sm font-medium text-text-primary transition-all hover:border-sky-200 hover:shadow-md">
                        Időpont foglalása <svg class="arrow-slide h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" /></svg>
                    </a>
                </div>
                <div class="stagger-item card-glow rounded-2xl border border-sky-100 bg-sky-50 p-8 text-center" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <h3 class="mb-3 text-xl font-bold text-text-primary">Regisztráció és kipróbálás</h3>
                    <p class="mb-6 text-sm text-text-secondary">Fedezze fel az automatikus dokumentumgenerálást, az e-aláírást és a teljes dokumentum-életciklus kezelést — azonnal.</p>
                    <a href="{{ route('register') }}" class="group inline-flex items-center gap-2 rounded-full bg-sky-600 px-6 py-3 text-sm font-medium text-white transition-all hover:bg-sky-700 hover:shadow-lg" style="box-shadow: 0 1px 2px rgba(0,0,0,0.05);">
                        Regisztráció <svg class="arrow-slide h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" /></svg>
                    </a>
                </div>
            </div>
        </div>
    </section>
</div>
