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
            0% { box-shadow: 0 0 0 0 rgba(139, 92, 246, 0.4); }
            70% { box-shadow: 0 0 0 6px rgba(139, 92, 246, 0); }
            100% { box-shadow: 0 0 0 0 rgba(139, 92, 246, 0); }
        }
        .pulse-dot { animation: pulse-ring 2s ease infinite; }

        .card-glow { transition: all 0.4s cubic-bezier(0,0,0.2,1); }
        .card-glow:hover { box-shadow: 0 8px 30px -8px rgba(139, 92, 246, 0.15), 0 2px 8px rgba(0,0,0,0.04) !important; }

        .icon-hover { transition: transform 0.35s cubic-bezier(0,0,0.2,1.4); }
        .group:hover .icon-hover, .card-glow:hover .icon-hover { transform: translateY(-3px) scale(1.08); }

        .arrow-slide { transition: transform 0.3s cubic-bezier(0,0,0.2,1); }
        .group:hover .arrow-slide, a:hover .arrow-slide { transform: translateX(4px); }

        .stat-hover .stat-value { transition: transform 0.4s cubic-bezier(0,0,0.2,1.4); }
        .stat-hover:hover .stat-value { transform: scale(1.08); }

        .feature-dot { transition: transform 0.3s cubic-bezier(0,0,0.2,1); }
        .card-glow:hover .feature-dot { transform: scale(1.5); }

        .pill-float { transition: transform 0.35s cubic-bezier(0,0,0.2,1), box-shadow 0.35s cubic-bezier(0,0,0.2,1); }
        .pill-float:hover { transform: translateY(-3px); box-shadow: 0 6px 20px -4px rgba(139, 92, 246, 0.12); }

        @keyframes brain-pulse { 0%, 100% { opacity: 1; } 50% { opacity: 0.6; } }
        .brain-pulse { animation: brain-pulse 2.5s ease infinite; }

        @keyframes typing-dots { 0%, 80%, 100% { opacity: 0.3; } 40% { opacity: 1; } }
        .typing-dot:nth-child(1) { animation: typing-dots 1.4s ease infinite 0s; }
        .typing-dot:nth-child(2) { animation: typing-dots 1.4s ease infinite 0.2s; }
        .typing-dot:nth-child(3) { animation: typing-dots 1.4s ease infinite 0.4s; }

        html { scroll-behavior: smooth; }
    </style>

    {{-- Hero Section --}}
    <section class="bg-linear-to-b from-violet-50 to-surface-secondary">
        <div class="mx-auto max-w-7xl px-6 py-16 lg:py-24">
            <div class="grid grid-cols-1 items-center gap-12 lg:grid-cols-2">
                {{-- Hero Text --}}
                <div class="reveal">
                    <div class="badge-gradient mb-8 inline-flex items-center gap-2 rounded-full border border-border-light/80 bg-surface-primary px-4 py-1.5"
                        style="box-shadow: 0 1px 3px rgba(0,0,0,0.04);">
                        <span class="pulse-dot h-1.5 w-1.5 rounded-full bg-linear-to-r from-violet-500 via-indigo-500 to-violet-400"></span>
                        <span class="text-sm font-medium text-text-primary">Funkció — AI</span>
                    </div>

                    <h1 class="mb-6 text-4xl leading-tight tracking-tight text-text-primary md:text-5xl lg:text-[3.5rem]"
                        style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                        Mesterséges intelligencia —<br>
                        beépítve az ipari vállalatirányításba
                    </h1>

                    <p class="mb-10 max-w-xl text-lg text-text-secondary lg:text-xl">
                        A Cégem360 MI két pilléren áll: a DataMind elemez, prediktál és javasol — az AI Chat pedig válaszol, kiszolgál és segít. Mindkettő a 11 modul valós adatain dolgozik, nem hallucináción.
                    </p>

                    <div class="flex flex-wrap items-center gap-4">
                        <a href="{{ route('contact') }}"
                            class="group inline-flex items-center gap-2 rounded-full bg-violet-600 px-6 py-3 text-base font-medium text-white transition-all hover:bg-violet-700 hover:shadow-lg"
                            style="box-shadow: 0 1px 2px rgba(0,0,0,0.05);">
                            <span>MI konzultáció</span>
                            <svg class="arrow-slide h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" /></svg>
                        </a>
                        <a href="#kepessegek"
                            class="inline-flex items-center gap-2 rounded-full border border-border-light bg-surface-primary px-6 py-3 text-base font-medium text-text-primary transition-all hover:border-violet-200 hover:bg-surface-secondary hover:shadow-md">
                            MI képességek
                        </a>
                    </div>
                </div>

                {{-- AI Dashboard Visual --}}
                <div class="reveal-right">
                    <div class="rounded-2xl border border-border-light bg-surface-primary p-6"
                        style="box-shadow: 0 4px 20px -4px rgba(0,0,0,0.06);">
                        <div class="mb-4 flex items-center justify-between border-b border-border-light pb-4">
                            <div>
                                <span class="block text-sm font-bold text-text-primary">MI Irányítópult</span>
                                <span class="block text-[10px] text-text-tertiary">DataMind · AI Chat · Predikciók</span>
                            </div>
                            <span class="inline-flex items-center gap-1.5 rounded-md border border-violet-100 bg-linear-to-r from-violet-50 to-indigo-50 px-2.5 py-1 text-[10px] font-semibold text-violet-600">
                                <span class="brain-pulse">🧠</span>
                                MI aktív
                            </span>
                        </div>

                        {{-- DataMind Morning Summary --}}
                        <div class="mb-3 rounded-lg border border-violet-100 bg-linear-to-r from-violet-50 to-indigo-50 p-3">
                            <div class="mb-2 flex items-center gap-2">
                                <div class="flex h-5 w-5 items-center justify-center rounded-md bg-violet-500 text-[9px] font-bold text-white">DM</div>
                                <span class="text-[11px] font-bold text-violet-600">DataMind reggeli összefoglaló</span>
                            </div>
                            <div class="space-y-1.5">
                                <div class="flex items-center gap-2">
                                    <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                                    <span class="text-[10px] text-text-secondary">Q1 árbevétel 12% terv felett</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <span class="h-1.5 w-1.5 rounded-full bg-amber-500"></span>
                                    <span class="text-[10px] text-text-secondary">3 ügyfél churn-kockázat >75%</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <span class="h-1.5 w-1.5 rounded-full bg-red-500"></span>
                                    <span class="text-[10px] text-text-secondary">Márciusi cash flow szűkülés várható</span>
                                </div>
                            </div>
                        </div>

                        {{-- AI Chat Preview --}}
                        <div class="mb-3 rounded-lg border border-border-light bg-surface-secondary p-3">
                            <div class="mb-2 flex items-center gap-2">
                                <div class="flex h-5 w-5 items-center justify-center rounded-md bg-indigo-500 text-[9px] font-bold text-white">AI</div>
                                <span class="text-[11px] font-bold text-indigo-600">AI Chat</span>
                            </div>
                            <div class="space-y-2">
                                <div class="flex justify-end">
                                    <span class="rounded-lg bg-violet-100 px-2.5 py-1.5 text-[10px] text-violet-700">Mi a státusza az SZ-2026-0142 szervizjegynek?</span>
                                </div>
                                <div class="flex justify-start">
                                    <span class="rounded-lg bg-surface-primary px-2.5 py-1.5 text-[10px] text-text-secondary">Folyamatban · Technikus: Kovács P. · Alkatrész megrendelve · Várható lezárás: péntek</span>
                                </div>
                            </div>
                        </div>

                        {{-- Predictions Row --}}
                        <div class="mb-3 grid grid-cols-3 gap-2">
                            <div class="rounded-lg border border-emerald-100 bg-emerald-50 p-2 text-center">
                                <span class="block text-sm font-extrabold text-emerald-600" style="font-family: 'JetBrains Mono', monospace;">92%</span>
                                <span class="block text-[8px] font-semibold uppercase tracking-wider text-text-tertiary">Q1 terv-teljesítés</span>
                            </div>
                            <div class="rounded-lg border border-amber-100 bg-amber-50 p-2 text-center">
                                <span class="block text-sm font-extrabold text-amber-600" style="font-family: 'JetBrains Mono', monospace;">3</span>
                                <span class="block text-[8px] font-semibold uppercase tracking-wider text-text-tertiary">Churn-kockázat</span>
                            </div>
                            <div class="rounded-lg border border-violet-100 bg-violet-50 p-2 text-center">
                                <span class="block text-sm font-extrabold text-violet-600" style="font-family: 'JetBrains Mono', monospace;">14</span>
                                <span class="block text-[8px] font-semibold uppercase tracking-wider text-text-tertiary">MI javaslat ma</span>
                            </div>
                        </div>

                        {{-- Footer Stats --}}
                        <div class="mt-3 flex gap-5 border-t border-border-light pt-3">
                            <span class="flex items-center gap-1.5 text-[10px] text-text-tertiary">
                                <span class="h-1.5 w-1.5 rounded-full bg-violet-500"></span> DataMind elemez
                            </span>
                            <span class="flex items-center gap-1.5 text-[10px] text-text-tertiary">
                                <span class="h-1.5 w-1.5 rounded-full bg-indigo-500"></span> AI Chat online
                            </span>
                            <span class="flex items-center gap-1.5 text-[10px] text-text-tertiary">
                                <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span> 11 modul forrás
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Two Pillars Section --}}
    <section class="bg-surface-secondary py-16 lg:py-24" id="hogyan-mukodik">
        <div class="mx-auto max-w-7xl px-6">
            <div class="reveal mb-12">
                <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-violet-600">Két MI pillér</p>
                <h2 class="mb-4 text-3xl text-text-primary md:text-4xl" style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                    DataMind elemez — AI Chat válaszol
                </h2>
                <p class="max-w-xl text-lg text-text-secondary">
                    A Cégem360 MI két irányból segít: a DataMind elemez, prediktál és döntést támogat — az AI Chat pedig az ügyfeleket és a belső csapatot szolgálja ki.
                </p>
            </div>

            <div class="grid grid-cols-1 gap-6 lg:grid-cols-2" data-stagger>
                {{-- DataMind --}}
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-8" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="mb-5 flex items-center gap-3">
                        <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-violet-50 text-xl">🧠</span>
                        <div>
                            <span class="mb-0.5 inline-flex rounded-lg bg-violet-50 px-3 py-1 text-[11px] font-bold uppercase tracking-wider text-violet-600">DataMind</span>
                            <span class="block text-xs text-text-tertiary">Elemzés, predikció és döntéstámogatás</span>
                        </div>
                    </div>
                    <div class="space-y-2.5">
                        <span class="flex items-center gap-2.5 text-sm text-text-secondary"><span class="h-1 w-1 rounded-full bg-violet-500"></span>Reggeli összefoglaló: MI áttekintés minden fontos számról</span>
                        <span class="flex items-center gap-2.5 text-sm text-text-secondary"><span class="h-1 w-1 rounded-full bg-violet-500"></span>Churn-predikció: melyik ügyfelek veszélyben</span>
                        <span class="flex items-center gap-2.5 text-sm text-text-secondary"><span class="h-1 w-1 rounded-full bg-violet-500"></span>Cash flow előrejelzés: likviditás 30-60-90 napra</span>
                        <span class="flex items-center gap-2.5 text-sm text-text-secondary"><span class="h-1 w-1 rounded-full bg-violet-500"></span>Anomália-detekció: szokatlan minta azonnali riasztás</span>
                        <span class="flex items-center gap-2.5 text-sm text-text-secondary"><span class="h-1 w-1 rounded-full bg-violet-500"></span>Természetes nyelvű kérdezés (NLQ): magyarul kérdezhetsz</span>
                        <span class="flex items-center gap-2.5 text-sm text-text-secondary"><span class="h-1 w-1 rounded-full bg-violet-500"></span>Automatikus riportok: heti, havi, egyedi ütemezéssel</span>
                    </div>
                </div>

                {{-- AI Chat --}}
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-8" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="mb-5 flex items-center gap-3">
                        <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-indigo-50 text-xl">💬</span>
                        <div>
                            <span class="mb-0.5 inline-flex rounded-lg bg-indigo-50 px-3 py-1 text-[11px] font-bold uppercase tracking-wider text-indigo-600">AI Chat</span>
                            <span class="block text-xs text-text-tertiary">Ügyfélszolgálat, belső segédlet és információ</span>
                        </div>
                    </div>
                    <div class="space-y-2.5">
                        <span class="flex items-center gap-2.5 text-sm text-text-secondary"><span class="h-1 w-1 rounded-full bg-indigo-500"></span>Ügyfélportál chatbot: szervizjegy, számla, státusz</span>
                        <span class="flex items-center gap-2.5 text-sm text-text-secondary"><span class="h-1 w-1 rounded-full bg-indigo-500"></span>Belső kérdések: készletszint, projekt-státusz, riport</span>
                        <span class="flex items-center gap-2.5 text-sm text-text-secondary"><span class="h-1 w-1 rounded-full bg-indigo-500"></span>Automatikus ticket-kategorizálás és prioritás</span>
                        <span class="flex items-center gap-2.5 text-sm text-text-secondary"><span class="h-1 w-1 rounded-full bg-indigo-500"></span>Live handoff: bonyolult ügyben élő operátornak</span>
                        <span class="flex items-center gap-2.5 text-sm text-text-secondary"><span class="h-1 w-1 rounded-full bg-indigo-500"></span>Magyar nyelvi modell: szakmai szókinccsel</span>
                        <span class="flex items-center gap-2.5 text-sm text-text-secondary"><span class="h-1 w-1 rounded-full bg-indigo-500"></span>24/7 elérhetőség: munkaidőn kívül is válaszol</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- AI Capabilities Section (6 cards) --}}
    <section class="bg-surface-primary py-16 lg:py-24" id="kepessegek">
        <div class="mx-auto max-w-7xl px-6">
            <div class="reveal mb-12">
                <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-violet-600">Képességek</p>
                <h2 class="mb-4 text-3xl text-text-primary md:text-4xl" style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                    Mit tud a Cégem360 MI?
                </h2>
                <p class="max-w-xl text-lg text-text-secondary">
                    A DataMind és az AI Chat együtt hatféle MI-képességet kínál — mind a 11 modul adatain, valós időben.
                </p>
            </div>

            <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3" data-stagger>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-7" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="icon-hover mb-5 flex h-12 w-12 items-center justify-center rounded-xl bg-violet-50 text-xl">🔮</div>
                    <h3 class="mb-2 text-base font-bold text-text-primary">Prediktív elemzés</h3>
                    <p class="text-sm leading-relaxed text-text-secondary">Churn-kockázat, cash flow előrejelzés, kereslet-előrejelzés, kapacitásterv — a DataMind előre lát, nem csak visszanéz.</p>
                </div>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-7" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="icon-hover mb-5 flex h-12 w-12 items-center justify-center rounded-xl bg-rose-50 text-xl">🔍</div>
                    <h3 class="mb-2 text-base font-bold text-text-primary">Anomália-detekció</h3>
                    <p class="text-sm leading-relaxed text-text-secondary">Szokatlan költés, eltérő selejt-arány, hirtelen churn — az MI azonnal jelez, mielőtt problémává válna.</p>
                </div>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-7" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="icon-hover mb-5 flex h-12 w-12 items-center justify-center rounded-xl bg-indigo-50 text-xl">💬</div>
                    <h3 class="mb-2 text-base font-bold text-text-primary">Természetes nyelvű kérdezés</h3>
                    <p class="text-sm leading-relaxed text-text-secondary">Magyarul kérdezhetsz az adataidról — a DataMind SQL helyett természetes nyelven válaszol, forrással és grafikonnal.</p>
                </div>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-7" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="icon-hover mb-5 flex h-12 w-12 items-center justify-center rounded-xl bg-emerald-50 text-xl">📊</div>
                    <h3 class="mb-2 text-base font-bold text-text-primary">Automatikus összefoglalók</h3>
                    <p class="text-sm leading-relaxed text-text-secondary">Reggeli összefoglaló, heti riport, havi zárás-támogatás — a DataMind automatikusan állítja össze, e-mailben küldi.</p>
                </div>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-7" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="icon-hover mb-5 flex h-12 w-12 items-center justify-center rounded-xl bg-amber-50 text-xl">🎯</div>
                    <h3 class="mb-2 text-base font-bold text-text-primary">Javaslat-motor</h3>
                    <p class="text-sm leading-relaxed text-text-secondary">Cross-sell javaslat, újrarendelési időpont, karbantartás-ütemezés — az MI nem csak elemez, hanem javasol is.</p>
                </div>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-7" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="icon-hover mb-5 flex h-12 w-12 items-center justify-center rounded-xl bg-slate-100 text-xl">🔒</div>
                    <h3 class="mb-2 text-base font-bold text-text-primary">Adatbiztonság és jogosultság</h3>
                    <p class="text-sm leading-relaxed text-text-secondary">Az MI csak azt az adatot látja, amihez a felhasználónak joga van. A válaszok jogosultság-szűrten érkeznek, naplózva.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Module AI Map (6 cards) --}}
    <section class="bg-surface-secondary py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-6">
            <div class="reveal mb-12">
                <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-violet-600">MI modulonként</p>
                <h2 class="mb-4 text-3xl text-text-primary md:text-4xl" style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                    MI minden modulban — konkrét funkciókkal
                </h2>
                <p class="max-w-xl text-lg text-text-secondary">
                    A DataMind és az AI Chat nem külön eszközök — beépülnek a modulokba, és ott dolgoznak, ahol a feladat van.
                </p>
            </div>

            <div class="grid grid-cols-1 gap-5 md:grid-cols-2 lg:grid-cols-3" data-stagger>
                {{-- CRM --}}
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-6" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="mb-4 flex items-center gap-3">
                        <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-emerald-50">
                            <x-module-icon module="crm" class="h-4 w-4 text-emerald-600" />
                        </div>
                        <span class="text-sm font-bold text-text-primary">CRM</span>
                    </div>
                    <div class="space-y-2">
                        <div class="flex items-center justify-between">
                            <span class="text-xs text-text-secondary">Churn-predikció</span>
                            <span class="rounded bg-violet-50 px-1.5 py-0.5 text-[9px] font-bold text-violet-600">DataMind</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-xs text-text-secondary">Cross-sell javaslat</span>
                            <span class="rounded bg-violet-50 px-1.5 py-0.5 text-[9px] font-bold text-violet-600">DataMind</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-xs text-text-secondary">Ügyfélportál chatbot</span>
                            <span class="rounded bg-indigo-50 px-1.5 py-0.5 text-[9px] font-bold text-indigo-600">AI Chat</span>
                        </div>
                    </div>
                </div>

                {{-- Gyártásirányítás --}}
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-6" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="mb-4 flex items-center gap-3">
                        <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-orange-50">
                            <x-module-icon module="gyartas" class="h-4 w-4 text-orange-600" />
                        </div>
                        <span class="text-sm font-bold text-text-primary">Gyártásirányítás</span>
                    </div>
                    <div class="space-y-2">
                        <div class="flex items-center justify-between">
                            <span class="text-xs text-text-secondary">Prediktív karbantartás</span>
                            <span class="rounded bg-violet-50 px-1.5 py-0.5 text-[9px] font-bold text-violet-600">DataMind</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-xs text-text-secondary">Selejt-anomália detekció</span>
                            <span class="rounded bg-violet-50 px-1.5 py-0.5 text-[9px] font-bold text-violet-600">DataMind</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-xs text-text-secondary">Kapacitás-optimalizálás</span>
                            <span class="rounded bg-violet-50 px-1.5 py-0.5 text-[9px] font-bold text-violet-600">DataMind</span>
                        </div>
                    </div>
                </div>

                {{-- Beszerzés-logisztika --}}
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-6" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="mb-4 flex items-center gap-3">
                        <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-cyan-50">
                            <x-module-icon module="beszerzes" class="h-4 w-4 text-cyan-600" />
                        </div>
                        <span class="text-sm font-bold text-text-primary">Beszerzés-logisztika</span>
                    </div>
                    <div class="space-y-2">
                        <div class="flex items-center justify-between">
                            <span class="text-xs text-text-secondary">Készlet-újrarendelés predikció</span>
                            <span class="rounded bg-violet-50 px-1.5 py-0.5 text-[9px] font-bold text-violet-600">DataMind</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-xs text-text-secondary">Szállítói teljesítmény-elemzés</span>
                            <span class="rounded bg-violet-50 px-1.5 py-0.5 text-[9px] font-bold text-violet-600">DataMind</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-xs text-text-secondary">Beszerzési chatbot</span>
                            <span class="rounded bg-indigo-50 px-1.5 py-0.5 text-[9px] font-bold text-indigo-600">AI Chat</span>
                        </div>
                    </div>
                </div>

                {{-- Kontrolling --}}
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-6" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="mb-4 flex items-center gap-3">
                        <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-violet-50">
                            <x-module-icon module="kontrolling" class="h-4 w-4 text-violet-600" />
                        </div>
                        <span class="text-sm font-bold text-text-primary">Kontrolling</span>
                    </div>
                    <div class="space-y-2">
                        <div class="flex items-center justify-between">
                            <span class="text-xs text-text-secondary">Cash flow előrejelzés</span>
                            <span class="rounded bg-violet-50 px-1.5 py-0.5 text-[9px] font-bold text-violet-600">DataMind</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-xs text-text-secondary">Költség-anomália riasztás</span>
                            <span class="rounded bg-violet-50 px-1.5 py-0.5 text-[9px] font-bold text-violet-600">DataMind</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-xs text-text-secondary">Automatikus havi riport</span>
                            <span class="rounded bg-violet-50 px-1.5 py-0.5 text-[9px] font-bold text-violet-600">DataMind</span>
                        </div>
                    </div>
                </div>

                {{-- Szerviz --}}
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-6" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="mb-4 flex items-center gap-3">
                        <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-amber-50">
                            <x-module-icon module="szerviz" class="h-4 w-4 text-amber-600" />
                        </div>
                        <span class="text-sm font-bold text-text-primary">Szerviz</span>
                    </div>
                    <div class="space-y-2">
                        <div class="flex items-center justify-between">
                            <span class="text-xs text-text-secondary">SLA predikció</span>
                            <span class="rounded bg-violet-50 px-1.5 py-0.5 text-[9px] font-bold text-violet-600">DataMind</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-xs text-text-secondary">Szervizjegy-státusz chatbot</span>
                            <div class="flex gap-1">
                                <span class="rounded bg-violet-50 px-1.5 py-0.5 text-[9px] font-bold text-violet-600">DataMind</span>
                                <span class="rounded bg-indigo-50 px-1.5 py-0.5 text-[9px] font-bold text-indigo-600">AI Chat</span>
                            </div>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-xs text-text-secondary">Automatikus ticket-kategorizálás</span>
                            <span class="rounded bg-indigo-50 px-1.5 py-0.5 text-[9px] font-bold text-indigo-600">AI Chat</span>
                        </div>
                    </div>
                </div>

                {{-- MarketingHub --}}
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-6" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="mb-4 flex items-center gap-3">
                        <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-sky-50">
                            <x-module-icon module="marketinghub" class="h-4 w-4 text-sky-600" />
                        </div>
                        <span class="text-sm font-bold text-text-primary">MarketingHub</span>
                    </div>
                    <div class="space-y-2">
                        <div class="flex items-center justify-between">
                            <span class="text-xs text-text-secondary">Kampány-hatékonyság predikció</span>
                            <span class="rounded bg-violet-50 px-1.5 py-0.5 text-[9px] font-bold text-violet-600">DataMind</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-xs text-text-secondary">Szegmentáció MI javaslattal</span>
                            <span class="rounded bg-violet-50 px-1.5 py-0.5 text-[9px] font-bold text-violet-600">DataMind</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-xs text-text-secondary">Tartalom-asszisztens</span>
                            <span class="rounded bg-indigo-50 px-1.5 py-0.5 text-[9px] font-bold text-indigo-600">AI Chat</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- NLQ (Natural Language Query) Section --}}
    <section class="bg-surface-primary py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-6">
            <div class="reveal mb-12">
                <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-violet-600">Természetes nyelvű kérdezés</p>
                <h2 class="mb-4 text-3xl text-text-primary md:text-4xl" style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                    Kérdezz magyarul — az MI válaszol adatokkal
                </h2>
                <p class="max-w-xl text-lg text-text-secondary">
                    Nem kell SQL-t tudni, nem kell riportot készíteni. Kérdezz természetes nyelven, és a DataMind a valós adatokból válaszol — forrással, grafikonnal.
                </p>
            </div>

            <div class="grid grid-cols-1 gap-5 md:grid-cols-2" data-stagger>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-6" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="mb-3 flex items-center gap-2">
                        <span class="rounded bg-violet-50 px-2 py-0.5 text-[10px] font-bold text-violet-600">Kérdés</span>
                    </div>
                    <p class="mb-3 text-sm font-semibold text-text-primary">„Top 5 ügyfél árbevétel szerint az elmúlt negyedévben?"</p>
                    <div class="rounded-lg bg-surface-secondary p-3">
                        <p class="text-xs leading-relaxed text-text-secondary">A DataMind lekérdezi a CRM és Kontrolling adatokat, és táblázatban mutatja a top 5 ügyfelet — negyedéves árbevétellel, változás%-kal.</p>
                        <div class="mt-2 flex items-center gap-3">
                            <span class="text-[9px] text-text-tertiary">Forrás: CRM + Kontrolling</span>
                            <span class="text-[9px] text-text-tertiary">Válaszidő: ~2 mp</span>
                        </div>
                    </div>
                </div>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-6" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="mb-3 flex items-center gap-2">
                        <span class="rounded bg-violet-50 px-2 py-0.5 text-[10px] font-bold text-violet-600">Kérdés</span>
                    </div>
                    <p class="mb-3 text-sm font-semibold text-text-primary">„Milyen karbantartások esedékesek a következő 2 hétben?"</p>
                    <div class="rounded-lg bg-surface-secondary p-3">
                        <p class="text-xs leading-relaxed text-text-secondary">A DataMind a Szerviz és Gyártás modulból listázza az esedékes karbantartásokat — gép, dátum, típus, felelős, prioritás.</p>
                        <div class="mt-2 flex items-center gap-3">
                            <span class="text-[9px] text-text-tertiary">Forrás: Szerviz + Gyártás</span>
                            <span class="text-[9px] text-text-tertiary">Válaszidő: ~3 mp</span>
                        </div>
                    </div>
                </div>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-6" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="mb-3 flex items-center gap-2">
                        <span class="rounded bg-violet-50 px-2 py-0.5 text-[10px] font-bold text-violet-600">Kérdés</span>
                    </div>
                    <p class="mb-3 text-sm font-semibold text-text-primary">„Melyik gyártósoron volt a legnagyobb selejt-arány tegnap?"</p>
                    <div class="rounded-lg bg-surface-secondary p-3">
                        <p class="text-xs leading-relaxed text-text-secondary">A DataMind összehasonlítja a gyártósorok selejt-adatait, és kiemeli a legrosszabbat — grafikonnal, előző napi összehasonlítással.</p>
                        <div class="mt-2 flex items-center gap-3">
                            <span class="text-[9px] text-text-tertiary">Forrás: Gyártásirányítás</span>
                            <span class="text-[9px] text-text-tertiary">Válaszidő: ~2 mp</span>
                        </div>
                    </div>
                </div>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-6" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="mb-3 flex items-center gap-2">
                        <span class="rounded bg-violet-50 px-2 py-0.5 text-[10px] font-bold text-violet-600">Kérdés</span>
                    </div>
                    <p class="mb-3 text-sm font-semibold text-text-primary">„Mekkora a pipeline érték és a konverziós arány idén?"</p>
                    <div class="rounded-lg bg-surface-secondary p-3">
                        <p class="text-xs leading-relaxed text-text-secondary">A DataMind a CRM pipeline-ból számol: összesített érték, fázis szerinti bontás, konverziós ráta előző évhez képest.</p>
                        <div class="mt-2 flex items-center gap-3">
                            <span class="text-[9px] text-text-tertiary">Forrás: CRM</span>
                            <span class="text-[9px] text-text-tertiary">Válaszidő: ~2 mp</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Stats Section --}}
    <section class="bg-surface-secondary py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-6">
            <div class="reveal mb-12 text-center">
                <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-violet-600">Számokban</p>
                <h2 class="text-3xl text-text-primary md:text-4xl" style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                    MI hatás számokban
                </h2>
            </div>

            <div class="grid grid-cols-2 gap-5 lg:grid-cols-4" data-stagger data-counter-trigger>
                <div class="stagger-item stat-hover rounded-2xl border border-border-light bg-surface-primary p-8 text-center" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <span class="stat-value block text-4xl font-bold text-violet-600 lg:text-5xl" style="font-family: 'JetBrains Mono', monospace;"
                        data-count="5" data-suffix="×">0</span>
                    <span class="mt-2 block text-sm text-text-secondary">Gyorsabb döntéshozatal</span>
                </div>
                <div class="stagger-item stat-hover rounded-2xl border border-border-light bg-surface-primary p-8 text-center" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <span class="stat-value block text-4xl font-bold text-indigo-600 lg:text-5xl" style="font-family: 'JetBrains Mono', monospace;"
                        data-count="90" data-prefix="-" data-suffix="%">0</span>
                    <span class="mt-2 block text-sm text-text-secondary">Riport-készítési idő</span>
                </div>
                <div class="stagger-item stat-hover rounded-2xl border border-border-light bg-surface-primary p-8 text-center" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <span class="stat-value block text-4xl font-bold text-emerald-600 lg:text-5xl" style="font-family: 'JetBrains Mono', monospace;"
                        data-count="95" data-suffix="%">0</span>
                    <span class="mt-2 block text-sm text-text-secondary">Predikciós pontosság</span>
                </div>
                <div class="stagger-item stat-hover rounded-2xl border border-border-light bg-surface-primary p-8 text-center" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <span class="stat-value block text-4xl font-bold text-blue-600 lg:text-5xl" style="font-family: 'JetBrains Mono', monospace;"
                        data-count="24/7">24/7</span>
                    <span class="mt-2 block text-sm text-text-secondary">AI Chat elérhetőség</span>
                </div>
            </div>
        </div>
    </section>

    {{-- Use Cases Section (6 cases) --}}
    <section class="bg-surface-primary py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-6">
            <div class="reveal mb-12">
                <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-violet-600">Felhasználási esetek</p>
                <h2 class="mb-4 text-3xl text-text-primary md:text-4xl" style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                    MI a gyakorlatban — ipari B2B példák
                </h2>
            </div>

            <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3" data-stagger>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-7" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <span class="mb-4 block text-xs font-semibold text-text-tertiary" style="font-family: 'JetBrains Mono', monospace;">01</span>
                    <h3 class="mb-2 text-base font-bold text-text-primary">Reggeli MI összefoglaló a CEO-nak</h3>
                    <p class="mb-4 text-sm leading-relaxed text-text-secondary">A DataMind minden reggel e-mailben küld összefoglalót: árbevétel, pipeline, termelés, cash flow, kockázatok — 30 másodperc alatt áttekinthető, ahelyett hogy 5 riportot nyitna meg.</p>
                    <div class="flex flex-wrap gap-1.5">
                        <span class="rounded bg-violet-50 px-2 py-0.5 text-[10px] font-semibold text-violet-600">DataMind</span>
                        <span class="rounded bg-slate-100 px-2 py-0.5 text-[10px] font-semibold text-slate-600">Kontrolling</span>
                    </div>
                </div>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-7" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <span class="mb-4 block text-xs font-semibold text-text-tertiary" style="font-family: 'JetBrains Mono', monospace;">02</span>
                    <h3 class="mb-2 text-base font-bold text-text-primary">Churn-predikció és proaktív retention</h3>
                    <p class="mb-4 text-sm leading-relaxed text-text-secondary">A DataMind 30-60-90 napos időhorizonton jelzi, melyik ügyfeleknél van lemorzsolódási kockázat — automatikus riasztás az értékesítőnek, javaslattal a megtartási lépésre.</p>
                    <div class="flex flex-wrap gap-1.5">
                        <span class="rounded bg-violet-50 px-2 py-0.5 text-[10px] font-semibold text-violet-600">DataMind</span>
                        <span class="rounded bg-slate-100 px-2 py-0.5 text-[10px] font-semibold text-slate-600">CRM</span>
                    </div>
                </div>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-7" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <span class="mb-4 block text-xs font-semibold text-text-tertiary" style="font-family: 'JetBrains Mono', monospace;">03</span>
                    <h3 class="mb-2 text-base font-bold text-text-primary">Ügyfél szervizjegy-követés AI Chatbottal</h3>
                    <p class="mb-4 text-sm leading-relaxed text-text-secondary">Az ügyfél az ügyfélportálon kérdezi a chatbotot: „Mi a helyzet a szervizjegyemmel?" — az AI Chat a CRM-ből válaszol: státusz, technikus, alkatrész, várható lezárás.</p>
                    <div class="flex flex-wrap gap-1.5">
                        <span class="rounded bg-indigo-50 px-2 py-0.5 text-[10px] font-semibold text-indigo-600">AI Chat</span>
                        <span class="rounded bg-slate-100 px-2 py-0.5 text-[10px] font-semibold text-slate-600">Szerviz</span>
                    </div>
                </div>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-7" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <span class="mb-4 block text-xs font-semibold text-text-tertiary" style="font-family: 'JetBrains Mono', monospace;">04</span>
                    <h3 class="mb-2 text-base font-bold text-text-primary">Prediktív karbantartás gyártósoron</h3>
                    <p class="mb-4 text-sm leading-relaxed text-text-secondary">A DataMind a szerviz- és gyártási adatokból megtanulja a meghibásodási mintákat, és 2 héttel előre jelzi, melyik gépnél várható karbantartás — csökkentve az állásidőt.</p>
                    <div class="flex flex-wrap gap-1.5">
                        <span class="rounded bg-violet-50 px-2 py-0.5 text-[10px] font-semibold text-violet-600">DataMind</span>
                        <span class="rounded bg-slate-100 px-2 py-0.5 text-[10px] font-semibold text-slate-600">Gyártás</span>
                    </div>
                </div>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-7" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <span class="mb-4 block text-xs font-semibold text-text-tertiary" style="font-family: 'JetBrains Mono', monospace;">05</span>
                    <h3 class="mb-2 text-base font-bold text-text-primary">Cash flow előrejelzés a CFO-nak</h3>
                    <p class="mb-4 text-sm leading-relaxed text-text-secondary">A DataMind a számlák, rendelések és fizetési szokások alapján 30-60-90 napos cash flow előrejelzést készít — likviditási riasztással, ha szűkülés várható.</p>
                    <div class="flex flex-wrap gap-1.5">
                        <span class="rounded bg-violet-50 px-2 py-0.5 text-[10px] font-semibold text-violet-600">DataMind</span>
                        <span class="rounded bg-slate-100 px-2 py-0.5 text-[10px] font-semibold text-slate-600">Kontrolling</span>
                    </div>
                </div>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-7" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <span class="mb-4 block text-xs font-semibold text-text-tertiary" style="font-family: 'JetBrains Mono', monospace;">06</span>
                    <h3 class="mb-2 text-base font-bold text-text-primary">Belső adatlekérdezés természetes nyelven</h3>
                    <p class="mb-4 text-sm leading-relaxed text-text-secondary">A műszakvezető kérdezi: „Melyik gép állt legtöbbet a héten?" — a DataMind a Gyártás modulból válaszol, grafikonnal, forrással, összehasonlítással.</p>
                    <div class="flex flex-wrap gap-1.5">
                        <span class="rounded bg-violet-50 px-2 py-0.5 text-[10px] font-semibold text-violet-600">DataMind</span>
                        <span class="rounded bg-indigo-50 px-2 py-0.5 text-[10px] font-semibold text-indigo-600">AI Chat</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Competitor Comparison Section (3 cards) --}}
    <section class="bg-surface-secondary py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-6">
            <div class="reveal mb-12">
                <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-violet-600">Piaci összehasonlítás</p>
                <h2 class="mb-4 text-3xl text-text-primary md:text-4xl" style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                    MI-megközelítések az ipari piacon
                </h2>
                <p class="max-w-xl text-lg text-text-secondary">
                    Az MI eszközök sokfélék — de ipari B2B kontextusban nem mindegy, honnan jön az adat, és mennyire integrált a megoldás.
                </p>
            </div>

            <div class="grid grid-cols-1 gap-6 lg:grid-cols-3" data-stagger>
                {{-- Általános MI eszközök --}}
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-8" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="mb-5">
                        <span class="mb-1 block text-xs font-semibold uppercase tracking-wider text-text-tertiary">Általános MI eszközök</span>
                        <span class="block text-[11px] text-text-tertiary">ChatGPT, Copilot, Gemini, Claude</span>
                    </div>
                    <div class="mb-5 space-y-2">
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><svg class="h-4 w-4 text-success-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>Erős nyelvi modell, széleskörű tudás</span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><svg class="h-4 w-4 text-success-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>Szövegírás, ötletelés, programozás</span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><svg class="h-4 w-4 text-success-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>Gyorsan elérhető, olcsó indulás</span>
                    </div>
                    <div class="space-y-2 border-t border-border-light pt-5">
                        <span class="flex items-center gap-2 text-sm text-text-tertiary"><svg class="h-4 w-4 text-danger-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>Nem lát az ERP/CRM adatokba</span>
                        <span class="flex items-center gap-2 text-sm text-text-tertiary"><svg class="h-4 w-4 text-danger-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>Hallucináció kockázat üzleti adatoknál</span>
                        <span class="flex items-center gap-2 text-sm text-text-tertiary"><svg class="h-4 w-4 text-danger-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>Nincs modulintegráció, sem predikció</span>
                        <span class="flex items-center gap-2 text-sm text-text-tertiary"><svg class="h-4 w-4 text-danger-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>GDPR és adatbiztonsági kockázat</span>
                    </div>
                </div>

                {{-- BI + MI bővítmények --}}
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-8" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="mb-5">
                        <span class="mb-1 block text-xs font-semibold uppercase tracking-wider text-text-tertiary">BI + MI bővítmények</span>
                        <span class="block text-[11px] text-text-tertiary">Power BI Copilot, Tableau AI, Qlik Sense</span>
                    </div>
                    <div class="mb-5 space-y-2">
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><svg class="h-4 w-4 text-success-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>Erős vizualizáció és riporting</span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><svg class="h-4 w-4 text-success-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>NLQ-támogatás dashboardokon</span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><svg class="h-4 w-4 text-success-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>Adatmodellezés és ETL-kezelés</span>
                    </div>
                    <div class="space-y-2 border-t border-border-light pt-5">
                        <span class="flex items-center gap-2 text-sm text-text-tertiary"><svg class="h-4 w-4 text-danger-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>Külön integráció szükséges minden forráshoz</span>
                        <span class="flex items-center gap-2 text-sm text-text-tertiary"><svg class="h-4 w-4 text-danger-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>Csak vizualizáció — nem cselekszik</span>
                        <span class="flex items-center gap-2 text-sm text-text-tertiary"><svg class="h-4 w-4 text-danger-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>Nincs chatbot, ügyfélszolgálat, workflow</span>
                        <span class="flex items-center gap-2 text-sm text-text-tertiary"><svg class="h-4 w-4 text-danger-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>Drága licensz + adatmérnöki kapacitás</span>
                    </div>
                </div>

                {{-- Cégem360 MI (highlighted) --}}
                <div class="stagger-item card-glow rounded-2xl border border-violet-200 bg-violet-50 p-8" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="mb-5">
                        <span class="mb-1 block text-xs font-semibold uppercase tracking-wider text-violet-600">Cégem360 MI</span>
                        <span class="block text-[11px] text-text-tertiary">DataMind + AI Chat · 11 modul adatain</span>
                    </div>
                    <div class="space-y-2">
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><svg class="h-4 w-4 text-success-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>11 modul valós adatain dolgozik — nem hallucinál</span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><svg class="h-4 w-4 text-success-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>Predikció + anomália + NLQ + riport</span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><svg class="h-4 w-4 text-success-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>AI Chatbot ügyfeleknek és belső csapatnak</span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><svg class="h-4 w-4 text-success-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>Jogosultság-szűrt válaszok, audit trail</span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><svg class="h-4 w-4 text-success-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>Nincs külön integráció — az MI a rendszer része</span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><svg class="h-4 w-4 text-success-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>KKV árazás, ipari B2B fókusz</span>
                    </div>
                    <div class="mt-5 rounded-lg bg-surface-primary p-3">
                        <p class="text-xs font-semibold text-violet-700">Ajánlott: ipari KKV-knak, akik nem BI-eszközt keresnek, hanem az üzleti folyamatokba beépített, cselekvőképes MI-t.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Detailed Comparison Table (10 rows × 4 columns) --}}
    <section class="bg-surface-primary py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-6">
            <div class="reveal mb-12">
                <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-violet-600">Részletes összehasonlítás</p>
                <h2 class="mb-4 text-3xl text-text-primary md:text-4xl" style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                    MI képesség-összehasonlítás
                </h2>
            </div>

            <div class="reveal overflow-x-auto">
                <table class="w-full min-w-[700px] border-collapse overflow-hidden rounded-2xl border border-border-light">
                    <thead>
                        <tr class="bg-surface-primary">
                            <th class="px-5 py-4 text-left text-xs font-bold uppercase tracking-wider text-text-primary">Képesség</th>
                            <th class="px-5 py-4 text-left text-xs font-bold uppercase tracking-wider text-text-tertiary">Általános MI</th>
                            <th class="px-5 py-4 text-left text-xs font-bold uppercase tracking-wider text-text-tertiary">BI + MI bővítmény</th>
                            <th class="px-5 py-4 text-left text-xs font-bold uppercase tracking-wider text-violet-600">Cégem360 MI</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-border-light">
                        <tr>
                            <td class="px-5 py-4 text-sm font-semibold text-text-primary">Modulok közötti adathozzáférés</td>
                            <td class="px-5 py-4 text-sm text-text-tertiary">✗ Nem lát az adatokba</td>
                            <td class="px-5 py-4 text-sm text-amber-600">◐ ETL integráció kell</td>
                            <td class="px-5 py-4 text-sm font-medium text-success-600">✓ Natív, 11 modul</td>
                        </tr>
                        <tr>
                            <td class="px-5 py-4 text-sm font-semibold text-text-primary">Prediktív elemzés</td>
                            <td class="px-5 py-4 text-sm text-text-tertiary">✗ Nincs (szöveges MI)</td>
                            <td class="px-5 py-4 text-sm text-amber-600">◐ Korlátozott modellek</td>
                            <td class="px-5 py-4 text-sm font-medium text-success-600">✓ Churn, cash flow, kereslet</td>
                        </tr>
                        <tr>
                            <td class="px-5 py-4 text-sm font-semibold text-text-primary">Természetes nyelvű kérdezés (NLQ)</td>
                            <td class="px-5 py-4 text-sm font-medium text-success-600">✓ Általános nyelvi modell</td>
                            <td class="px-5 py-4 text-sm font-medium text-success-600">✓ Dashboard-on belül</td>
                            <td class="px-5 py-4 text-sm font-medium text-success-600">✓ Valós üzleti adatokon</td>
                        </tr>
                        <tr>
                            <td class="px-5 py-4 text-sm font-semibold text-text-primary">AI Chatbot (ügyfél + belső)</td>
                            <td class="px-5 py-4 text-sm text-amber-600">◐ Csak szövegalapú</td>
                            <td class="px-5 py-4 text-sm text-text-tertiary">✗ Nincs</td>
                            <td class="px-5 py-4 text-sm font-medium text-success-600">✓ Ügyfélportál + belső</td>
                        </tr>
                        <tr>
                            <td class="px-5 py-4 text-sm font-semibold text-text-primary">Anomália-detekció</td>
                            <td class="px-5 py-4 text-sm text-text-tertiary">✗ Nincs</td>
                            <td class="px-5 py-4 text-sm text-amber-600">◐ Konfigurálni kell</td>
                            <td class="px-5 py-4 text-sm font-medium text-success-600">✓ Automatikus riasztás</td>
                        </tr>
                        <tr>
                            <td class="px-5 py-4 text-sm font-semibold text-text-primary">Automatikus riportok</td>
                            <td class="px-5 py-4 text-sm text-text-tertiary">✗ Nincs (kézi prompt)</td>
                            <td class="px-5 py-4 text-sm font-medium text-success-600">✓ Ütemezett dashboardok</td>
                            <td class="px-5 py-4 text-sm font-medium text-success-600">✓ E-mail, heti/havi, egyedi</td>
                        </tr>
                        <tr>
                            <td class="px-5 py-4 text-sm font-semibold text-text-primary">Jogosultság-szűrt válaszok</td>
                            <td class="px-5 py-4 text-sm text-text-tertiary">✗ Nincs</td>
                            <td class="px-5 py-4 text-sm text-amber-600">◐ Dashboard szinten</td>
                            <td class="px-5 py-4 text-sm font-medium text-success-600">✓ Felhasználói szinten</td>
                        </tr>
                        <tr>
                            <td class="px-5 py-4 text-sm font-semibold text-text-primary">Workflow-integráció</td>
                            <td class="px-5 py-4 text-sm text-text-tertiary">✗ Nincs</td>
                            <td class="px-5 py-4 text-sm text-text-tertiary">✗ Nincs</td>
                            <td class="px-5 py-4 text-sm font-medium text-success-600">✓ MI-trigger automatizálásban</td>
                        </tr>
                        <tr>
                            <td class="px-5 py-4 text-sm font-semibold text-text-primary">Magyar nyelvi támogatás</td>
                            <td class="px-5 py-4 text-sm text-amber-600">◐ Általános szinten</td>
                            <td class="px-5 py-4 text-sm text-text-tertiary">✗ Angol-fókuszú</td>
                            <td class="px-5 py-4 text-sm font-medium text-success-600">✓ Ipari szókinccsel</td>
                        </tr>
                        <tr>
                            <td class="px-5 py-4 text-sm font-semibold text-text-primary">Árazási modell</td>
                            <td class="px-5 py-4 text-sm text-amber-600">◐ Token/felhasználó</td>
                            <td class="px-5 py-4 text-sm text-text-tertiary">✗ Drága licensz + ETL</td>
                            <td class="px-5 py-4 text-sm font-medium text-success-600">✓ Előfizetés, nincs rejtett díj</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    {{-- Consultation Section --}}
    <section class="bg-surface-secondary py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-6">
            <div class="reveal">
                <div class="grid grid-cols-1 items-center gap-8 rounded-2xl border border-border-light bg-surface-primary p-8 lg:grid-cols-[1fr_auto] lg:p-12" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div>
                        <h3 class="mb-3 text-xl font-bold text-text-primary lg:text-2xl" style="font-family: 'Poppins', sans-serif;">Személyre szabott MI konzultáció</h3>
                        <p class="mb-5 text-base text-text-secondary">30 perces videóhívás, amelyben felmérjük, hogyan alkalmazható a DataMind és az AI Chat az Ön iparágában — milyen predikciók, riportok és chatbot-funkciók hoznak értéket a cégének.</p>
                        <div class="flex flex-wrap gap-5">
                            <span class="flex items-center gap-1.5 text-sm text-text-tertiary"><svg class="h-4 w-4 text-success-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>30 perc videóhívás</span>
                            <span class="flex items-center gap-1.5 text-sm text-text-tertiary"><svg class="h-4 w-4 text-success-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>MI lehetőségek felmérése</span>
                            <span class="flex items-center gap-1.5 text-sm text-text-tertiary"><svg class="h-4 w-4 text-success-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>Nincs elköteleződés</span>
                        </div>
                    </div>
                    <a href="{{ route('contact') }}" class="group inline-flex items-center gap-2 rounded-full bg-violet-600 px-6 py-3 text-base font-medium text-white transition-all hover:bg-violet-700 hover:shadow-lg" style="box-shadow: 0 1px 2px rgba(0,0,0,0.05);">
                        <span>Konzultációt kérek</span>
                        <svg class="arrow-slide h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" /></svg>
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{-- Footer CTA Section --}}
    <section class="bg-linear-to-b from-surface-primary to-surface-secondary py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-6">
            <div class="reveal mb-12 text-center">
                <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-violet-600">Kezdje el</p>
                <h2 class="mb-4 text-3xl text-text-primary md:text-4xl" style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                    Készen áll az MI-vel támogatott vállalatirányításra?
                </h2>
                <p class="mx-auto max-w-xl text-lg text-text-secondary">
                    Válassza ki a következő lépést az Ön számára.
                </p>
            </div>

            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2" data-stagger>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-8 text-center" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <h3 class="mb-3 text-xl font-bold text-text-primary">MI konzultáció</h3>
                    <p class="mb-6 text-sm text-text-secondary">Kérdezzen szakértőinktől 30 percben — videóhíváson, az MI lehetőségeiről az Ön iparágában, kötelezettség nélkül.</p>
                    <a href="{{ route('contact') }}" class="inline-flex items-center gap-2 rounded-full border border-border-light bg-surface-secondary px-6 py-3 text-sm font-medium text-text-primary transition-all hover:border-violet-200 hover:shadow-md">
                        Időpont foglalása <svg class="arrow-slide h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" /></svg>
                    </a>
                </div>
                <div class="stagger-item card-glow rounded-2xl border border-violet-100 bg-violet-50 p-8 text-center" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <h3 class="mb-3 text-xl font-bold text-text-primary">Regisztráció és kipróbálás</h3>
                    <p class="mb-6 text-sm text-text-secondary">Fedezze fel a DataMind prediktív elemzéseit és az AI Chat lehetőségeit — azonnal, a 11 modul adatain.</p>
                    <a href="{{ route('register') }}" class="group inline-flex items-center gap-2 rounded-full bg-violet-600 px-6 py-3 text-sm font-medium text-white transition-all hover:bg-violet-700 hover:shadow-lg" style="box-shadow: 0 1px 2px rgba(0,0,0,0.05);">
                        Regisztráció <svg class="arrow-slide h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" /></svg>
                    </a>
                </div>
            </div>
        </div>
    </section>
</div>
