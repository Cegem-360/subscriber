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
            0% { box-shadow: 0 0 0 0 rgba(6, 182, 212, 0.4); }
            70% { box-shadow: 0 0 0 6px rgba(6, 182, 212, 0); }
            100% { box-shadow: 0 0 0 0 rgba(6, 182, 212, 0); }
        }
        .pulse-dot { animation: pulse-ring 2s ease infinite; }

        .card-glow { transition: all 0.4s cubic-bezier(0,0,0.2,1); }
        .card-glow:hover { box-shadow: 0 8px 30px -8px rgba(6, 182, 212, 0.15), 0 2px 8px rgba(0,0,0,0.04) !important; }

        .icon-hover { transition: transform 0.35s cubic-bezier(0,0,0.2,1.4); }
        .group:hover .icon-hover, .card-glow:hover .icon-hover { transform: translateY(-3px) scale(1.08); }

        .arrow-slide { transition: transform 0.3s cubic-bezier(0,0,0.2,1); }
        .group:hover .arrow-slide, a:hover .arrow-slide { transform: translateX(4px); }

        .stat-hover .stat-value { transition: transform 0.4s cubic-bezier(0,0,0.2,1.4); }
        .stat-hover:hover .stat-value { transform: scale(1.08); }

        .feature-dot { transition: transform 0.3s cubic-bezier(0,0,0.2,1); }
        .card-glow:hover .feature-dot { transform: scale(1.5); }

        .pill-float { transition: transform 0.35s cubic-bezier(0,0,0.2,1), box-shadow 0.35s cubic-bezier(0,0,0.2,1); }
        .pill-float:hover { transform: translateY(-3px); box-shadow: 0 6px 20px -4px rgba(6, 182, 212, 0.12); }

        @keyframes dash-pulse { 0%, 100% { opacity: 1; } 50% { opacity: 0.6; } }
        .dash-pulse { animation: dash-pulse 2.5s ease infinite; }

        html { scroll-behavior: smooth; }
    </style>

    {{-- Hero Section --}}
    <section class="bg-linear-to-b from-cyan-50 to-surface-secondary">
        <div class="mx-auto max-w-7xl px-6 py-16 lg:py-24">
            <div class="grid grid-cols-1 items-center gap-12 lg:grid-cols-2">
                {{-- Hero Text --}}
                <div class="reveal">
                    <div class="badge-gradient mb-8 inline-flex items-center gap-2 rounded-full border border-border-light/80 bg-surface-primary px-4 py-1.5"
                        style="box-shadow: 0 1px 3px rgba(0,0,0,0.04);">
                        <span class="pulse-dot h-1.5 w-1.5 rounded-full bg-linear-to-r from-cyan-500 via-sky-500 to-cyan-400"></span>
                        <span class="text-sm font-medium text-text-primary">Funkció — Irányítópultok</span>
                    </div>

                    <h1 class="mb-6 text-4xl leading-tight tracking-tight text-text-primary md:text-5xl lg:text-[3.5rem]"
                        style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                        Minden szám, egyetlen képernyőn —<br>
                        az Ön szerepkörére szabva
                    </h1>

                    <p class="mb-10 max-w-xl text-lg text-text-secondary lg:text-xl">
                        A Cégem360 irányítópultjai nem statikus riportok. Valós idejű, drag-and-drop dashboard-ok, amelyeket bárki személyre szabhat — a CEO-tól a műszakvezetőig. Minden modul adata egyetlen felületen, mindig friss, mindig releváns.
                    </p>

                    <div class="flex flex-wrap items-center gap-4">
                        <a href="{{ route('contact') }}"
                            class="group inline-flex items-center gap-2 rounded-full bg-cyan-600 px-6 py-3 text-base font-medium text-white transition-all hover:bg-cyan-700 hover:shadow-lg"
                            style="box-shadow: 0 1px 2px rgba(0,0,0,0.05);">
                            <span>Online konzultáció</span>
                            <svg class="arrow-slide h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" /></svg>
                        </a>
                        <a href="#szerepkor-dashboardok"
                            class="inline-flex items-center gap-2 rounded-full border border-border-light bg-surface-primary px-6 py-3 text-base font-medium text-text-primary transition-all hover:border-cyan-200 hover:bg-surface-secondary hover:shadow-md">
                            Dashboard-ok áttekintése
                        </a>
                    </div>
                </div>

                {{-- Dashboard Visual --}}
                <div class="reveal-right">
                    <div class="rounded-2xl border border-border-light bg-surface-primary p-6"
                        style="box-shadow: 0 4px 20px -4px rgba(0,0,0,0.06);">
                        <div class="mb-4 flex items-center justify-between border-b border-border-light pb-4">
                            <div>
                                <span class="block text-sm font-bold text-text-primary">Vezetői irányítópult</span>
                                <span class="block text-[10px] text-text-tertiary">Valós idejű · Összes modul</span>
                            </div>
                            <div class="flex gap-1">
                                <span class="rounded-md border border-cyan-100 bg-cyan-50 px-2 py-0.5 text-[10px] font-semibold text-cyan-600">Ma</span>
                                <span class="rounded-md bg-surface-secondary px-2 py-0.5 text-[10px] text-text-tertiary">Hét</span>
                                <span class="rounded-md bg-surface-secondary px-2 py-0.5 text-[10px] text-text-tertiary">Hónap</span>
                                <span class="rounded-md bg-surface-secondary px-2 py-0.5 text-[10px] text-text-tertiary">Q1</span>
                            </div>
                        </div>

                        {{-- KPI Row --}}
                        <div class="mb-3 grid grid-cols-4 gap-2">
                            <div class="rounded-lg border border-border-light bg-surface-secondary p-2 text-center">
                                <span class="block text-sm font-extrabold text-cyan-600" style="font-family: 'JetBrains Mono', monospace;">187.4M</span>
                                <span class="block text-[8px] font-semibold uppercase tracking-wider text-text-tertiary">Pipeline érték</span>
                                <span class="block text-[9px] font-bold text-emerald-600">▲ +12%</span>
                            </div>
                            <div class="rounded-lg border border-border-light bg-surface-secondary p-2 text-center">
                                <span class="block text-sm font-extrabold text-emerald-600" style="font-family: 'JetBrains Mono', monospace;">92%</span>
                                <span class="block text-[8px] font-semibold uppercase tracking-wider text-text-tertiary">Terv-teljesítés</span>
                                <span class="block text-[9px] font-bold text-emerald-600">▲ +3%</span>
                            </div>
                            <div class="rounded-lg border border-border-light bg-surface-secondary p-2 text-center">
                                <span class="block text-sm font-extrabold text-amber-600" style="font-family: 'JetBrains Mono', monospace;">4.2h</span>
                                <span class="block text-[8px] font-semibold uppercase tracking-wider text-text-tertiary">Átlag SLA válasz</span>
                                <span class="block text-[9px] font-bold text-emerald-600">▼ -18%</span>
                            </div>
                            <div class="rounded-lg border border-border-light bg-surface-secondary p-2 text-center">
                                <span class="block text-sm font-extrabold text-violet-600" style="font-family: 'JetBrains Mono', monospace;">87%</span>
                                <span class="block text-[8px] font-semibold uppercase tracking-wider text-text-tertiary">OEE üzem</span>
                                <span class="block text-[9px] font-bold text-emerald-600">▲ +2%</span>
                            </div>
                        </div>

                        {{-- Mini Charts --}}
                        <div class="mb-3 grid grid-cols-2 gap-2">
                            <div class="rounded-lg border border-border-light bg-surface-secondary p-3">
                                <div class="mb-2 flex items-center justify-between">
                                    <span class="text-[10px] font-bold text-text-secondary">Havi árbevétel (M Ft)</span>
                                    <span class="text-[10px] font-extrabold text-cyan-600" style="font-family: 'JetBrains Mono', monospace;">42.3M</span>
                                </div>
                                <div class="flex items-end gap-0.5" style="height: 24px;">
                                    <div class="w-full rounded-t-sm bg-cyan-200" style="height: 45%;"></div>
                                    <div class="w-full rounded-t-sm bg-cyan-200" style="height: 62%;"></div>
                                    <div class="w-full rounded-t-sm bg-cyan-300" style="height: 55%;"></div>
                                    <div class="w-full rounded-t-sm bg-cyan-300" style="height: 78%;"></div>
                                    <div class="w-full rounded-t-sm bg-cyan-300" style="height: 70%;"></div>
                                    <div class="w-full rounded-t-sm bg-cyan-400" style="height: 85%;"></div>
                                    <div class="w-full rounded-t-sm bg-cyan-400" style="height: 95%;"></div>
                                    <div class="w-full rounded-t-sm bg-cyan-400" style="height: 80%;"></div>
                                    <div class="w-full rounded-t-sm bg-cyan-300" style="height: 72%;"></div>
                                    <div class="w-full rounded-t-sm bg-cyan-500" style="height: 88%;"></div>
                                </div>
                            </div>
                            <div class="rounded-lg border border-border-light bg-surface-secondary p-3">
                                <div class="mb-2 flex items-center justify-between">
                                    <span class="text-[10px] font-bold text-text-secondary">Nyitott szervizjegyek</span>
                                    <span class="text-[10px] font-extrabold text-emerald-600" style="font-family: 'JetBrains Mono', monospace;">23 aktív</span>
                                </div>
                                <div class="flex items-end gap-0.5" style="height: 24px;">
                                    <div class="w-full rounded-t-sm bg-emerald-200" style="height: 80%;"></div>
                                    <div class="w-full rounded-t-sm bg-emerald-200" style="height: 65%;"></div>
                                    <div class="w-full rounded-t-sm bg-emerald-300" style="height: 90%;"></div>
                                    <div class="w-full rounded-t-sm bg-emerald-200" style="height: 45%;"></div>
                                    <div class="w-full rounded-t-sm bg-emerald-300" style="height: 55%;"></div>
                                    <div class="w-full rounded-t-sm bg-emerald-200" style="height: 35%;"></div>
                                    <div class="w-full rounded-t-sm bg-emerald-300" style="height: 60%;"></div>
                                    <div class="w-full rounded-t-sm bg-emerald-200" style="height: 40%;"></div>
                                    <div class="w-full rounded-t-sm bg-emerald-200" style="height: 50%;"></div>
                                    <div class="w-full rounded-t-sm bg-emerald-400" style="height: 30%;"></div>
                                </div>
                            </div>
                        </div>

                        {{-- Activity Feed --}}
                        <div class="mb-3 space-y-1">
                            <div class="flex items-center gap-2 rounded-md bg-surface-secondary p-2">
                                <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                                <span class="flex-1 truncate text-[10px] text-text-secondary">TechBuild Kft. — ajánlat elfogadva (8.2M Ft)</span>
                                <span class="text-[9px] text-text-tertiary" style="font-family: 'JetBrains Mono', monospace;">09:14</span>
                            </div>
                            <div class="flex items-center gap-2 rounded-md bg-surface-secondary p-2">
                                <span class="h-1.5 w-1.5 rounded-full bg-amber-500"></span>
                                <span class="flex-1 truncate text-[10px] text-text-secondary">CNC-2 gép OEE 68% alá csökkent — DataMind riasztás</span>
                                <span class="text-[9px] text-text-tertiary" style="font-family: 'JetBrains Mono', monospace;">08:52</span>
                            </div>
                            <div class="flex items-center gap-2 rounded-md bg-surface-secondary p-2">
                                <span class="h-1.5 w-1.5 rounded-full bg-cyan-500"></span>
                                <span class="flex-1 truncate text-[10px] text-text-secondary">Heti vezetői riport generálva — e-mail kiküldve</span>
                                <span class="text-[9px] text-text-tertiary" style="font-family: 'JetBrains Mono', monospace;">08:00</span>
                            </div>
                        </div>

                        {{-- Footer Stats --}}
                        <div class="mt-3 flex gap-5 border-t border-border-light pt-3">
                            <span class="flex items-center gap-1.5 text-[10px] text-text-tertiary">
                                <span class="h-1.5 w-1.5 rounded-full bg-cyan-500"></span> Valós idejű
                            </span>
                            <span class="flex items-center gap-1.5 text-[10px] text-text-tertiary">
                                <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span> 11 modul forrás
                            </span>
                            <span class="flex items-center gap-1.5 text-[10px] text-text-tertiary">
                                <span class="h-1.5 w-1.5 rounded-full bg-violet-500"></span> 8 widget aktív
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Role Dashboards Section (6 cards) --}}
    <section class="bg-surface-secondary py-16 lg:py-24" id="szerepkor-dashboardok">
        <div class="mx-auto max-w-7xl px-6">
            <div class="reveal mb-12">
                <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-cyan-600">Szerepkör-alapú dashboardok</p>
                <h2 class="mb-4 text-3xl text-text-primary md:text-4xl" style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                    Mindenkinek azt mutatja, ami számára fontos
                </h2>
                <p class="max-w-xl text-lg text-text-secondary">
                    A Cégem360-ban minden felhasználó a saját szerepkörére szabott irányítópultot lát — automatikusan, bejelentkezés után azonnal.
                </p>
            </div>

            <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3" data-stagger>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-7" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="icon-hover mb-4 flex h-12 w-12 items-center justify-center rounded-xl bg-cyan-50 text-xl">📊</div>
                    <h3 class="mb-1 text-base font-bold text-text-primary">CEO / Ügyvezető</h3>
                    <span class="mb-4 block text-xs text-text-tertiary">Átfogó üzleti kép, stratégiai KPI-k</span>
                    <div class="space-y-1.5">
                        <span class="flex items-center gap-2 text-xs text-text-secondary"><span class="text-cyan-500">→</span>Havi/negyedéves árbevétel és terv-teljesítés</span>
                        <span class="flex items-center gap-2 text-xs text-text-secondary"><span class="text-cyan-500">→</span>Pipeline érték és konverziós arány</span>
                        <span class="flex items-center gap-2 text-xs text-text-secondary"><span class="text-cyan-500">→</span>Cash flow előrejelzés (DataMind)</span>
                        <span class="flex items-center gap-2 text-xs text-text-secondary"><span class="text-cyan-500">→</span>Top 5 ügyfél, top kockázatok</span>
                        <span class="flex items-center gap-2 text-xs text-text-secondary"><span class="text-cyan-500">→</span>DataMind reggeli MI összefoglaló</span>
                    </div>
                </div>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-7" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="icon-hover mb-4 flex h-12 w-12 items-center justify-center rounded-xl bg-emerald-50 text-xl">📈</div>
                    <h3 class="mb-1 text-base font-bold text-text-primary">Értékesítési vezető</h3>
                    <span class="mb-4 block text-xs text-text-tertiary">Pipeline, ajánlatok, konverziók</span>
                    <div class="space-y-1.5">
                        <span class="flex items-center gap-2 text-xs text-text-secondary"><span class="text-emerald-500">→</span>Pipeline fázisok és értékek</span>
                        <span class="flex items-center gap-2 text-xs text-text-secondary"><span class="text-emerald-500">→</span>Értékesítőnkénti teljesítmény</span>
                        <span class="flex items-center gap-2 text-xs text-text-secondary"><span class="text-emerald-500">→</span>Ajánlat → megrendelés konverzió</span>
                        <span class="flex items-center gap-2 text-xs text-text-secondary"><span class="text-emerald-500">→</span>Churn-kockázat lista (DataMind)</span>
                        <span class="flex items-center gap-2 text-xs text-text-secondary"><span class="text-emerald-500">→</span>Heti/havi értékesítési trend</span>
                    </div>
                </div>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-7" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="icon-hover mb-4 flex h-12 w-12 items-center justify-center rounded-xl bg-violet-50 text-xl">💰</div>
                    <h3 class="mb-1 text-base font-bold text-text-primary">CFO / Pénzügyi vezető</h3>
                    <span class="mb-4 block text-xs text-text-tertiary">P&amp;L, cash flow, költségek</span>
                    <div class="space-y-1.5">
                        <span class="flex items-center gap-2 text-xs text-text-secondary"><span class="text-violet-500">→</span>Havi P&amp;L összefoglaló</span>
                        <span class="flex items-center gap-2 text-xs text-text-secondary"><span class="text-violet-500">→</span>Cash flow aktuális + előrejelzés</span>
                        <span class="flex items-center gap-2 text-xs text-text-secondary"><span class="text-violet-500">→</span>Kintlévőségek és lejárt számlák</span>
                        <span class="flex items-center gap-2 text-xs text-text-secondary"><span class="text-violet-500">→</span>Projekt-jövedelmezőségi mátrix</span>
                        <span class="flex items-center gap-2 text-xs text-text-secondary"><span class="text-violet-500">→</span>Terv vs. tény eltérés-elemzés</span>
                    </div>
                </div>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-7" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="icon-hover mb-4 flex h-12 w-12 items-center justify-center rounded-xl bg-amber-50 text-xl">🏭</div>
                    <h3 class="mb-1 text-base font-bold text-text-primary">Üzemvezető / Termelés</h3>
                    <span class="mb-4 block text-xs text-text-tertiary">OEE, kapacitás, selejt, gépállapot</span>
                    <div class="space-y-1.5">
                        <span class="flex items-center gap-2 text-xs text-text-secondary"><span class="text-amber-500">→</span>OEE valós időben, gépenként</span>
                        <span class="flex items-center gap-2 text-xs text-text-secondary"><span class="text-amber-500">→</span>Selejt-arány és trend</span>
                        <span class="flex items-center gap-2 text-xs text-text-secondary"><span class="text-amber-500">→</span>Kapacitáskihasználás és szűk keresztmetszet</span>
                        <span class="flex items-center gap-2 text-xs text-text-secondary"><span class="text-amber-500">→</span>Prediktív karbantartás jelzések</span>
                        <span class="flex items-center gap-2 text-xs text-text-secondary"><span class="text-amber-500">→</span>Gyártási utasítások státusza</span>
                    </div>
                </div>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-7" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="icon-hover mb-4 flex h-12 w-12 items-center justify-center rounded-xl bg-orange-50 text-xl">🔧</div>
                    <h3 class="mb-1 text-base font-bold text-text-primary">Szervizmenedzser</h3>
                    <span class="mb-4 block text-xs text-text-tertiary">SLA, jegyek, technikusok, elégedettség</span>
                    <div class="space-y-1.5">
                        <span class="flex items-center gap-2 text-xs text-text-secondary"><span class="text-orange-500">→</span>Nyitott szervizjegyek (prioritás szerint)</span>
                        <span class="flex items-center gap-2 text-xs text-text-secondary"><span class="text-orange-500">→</span>SLA-teljesítés % és eszkalációk</span>
                        <span class="flex items-center gap-2 text-xs text-text-secondary"><span class="text-orange-500">→</span>Technikus-kihasználás és helyszíni térkép</span>
                        <span class="flex items-center gap-2 text-xs text-text-secondary"><span class="text-orange-500">→</span>Ügyfél-elégedettség (CSAT/NPS)</span>
                        <span class="flex items-center gap-2 text-xs text-text-secondary"><span class="text-orange-500">→</span>Karbantartás ütemterv</span>
                    </div>
                </div>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-7" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="icon-hover mb-4 flex h-12 w-12 items-center justify-center rounded-xl bg-blue-50 text-xl">📦</div>
                    <h3 class="mb-1 text-base font-bold text-text-primary">Beszerzési vezető</h3>
                    <span class="mb-4 block text-xs text-text-tertiary">Készlet, szállítók, rendelések</span>
                    <div class="space-y-1.5">
                        <span class="flex items-center gap-2 text-xs text-text-secondary"><span class="text-blue-500">→</span>Kritikus készletszintek és riasztások</span>
                        <span class="flex items-center gap-2 text-xs text-text-secondary"><span class="text-blue-500">→</span>Nyitott beszerzési megrendelések</span>
                        <span class="flex items-center gap-2 text-xs text-text-secondary"><span class="text-blue-500">→</span>Szállítói megbízhatóság scoring</span>
                        <span class="flex items-center gap-2 text-xs text-text-secondary"><span class="text-blue-500">→</span>Bevételezés-státusz és késések</span>
                        <span class="flex items-center gap-2 text-xs text-text-secondary"><span class="text-blue-500">→</span>Havi beszerzési költségek vs. terv</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Capabilities Section (6 cards) --}}
    <section class="bg-surface-primary py-16 lg:py-24" id="kepessegek">
        <div class="mx-auto max-w-7xl px-6">
            <div class="reveal mb-12">
                <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-cyan-600">Képességek</p>
                <h2 class="mb-4 text-3xl text-text-primary md:text-4xl" style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                    Nem statikus riport — élő, testreszabható irányítópult
                </h2>
                <p class="max-w-xl text-lg text-text-secondary">
                    A Cégem360 dashboardjai valós idejű, interaktív felületek, amelyeket bárki testreszabhat — kód nélkül.
                </p>
            </div>

            <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3" data-stagger>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-7" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="icon-hover mb-5 flex h-12 w-12 items-center justify-center rounded-xl bg-cyan-50 text-xl">🧩</div>
                    <h3 class="mb-2 text-base font-bold text-text-primary">Drag-and-drop widget-rendszer</h3>
                    <p class="text-sm leading-relaxed text-text-secondary">Widget-ek húzása a dashboard-ra: KPI-kártya, oszlopdiagram, kördiagram, táblázat, térkép, hőtérkép, MI összefoglaló, aktivitás-feed. Átméretezhető, áthelyezhető, elmenthető.</p>
                </div>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-7" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="icon-hover mb-5 flex h-12 w-12 items-center justify-center rounded-xl bg-violet-50 text-xl">👥</div>
                    <h3 class="mb-2 text-base font-bold text-text-primary">Szerepkör-alapú alapértelmezés</h3>
                    <p class="text-sm leading-relaxed text-text-secondary">Minden szerepkör (CEO, értékesítő, üzemvezető, szervizmenedzser) kap egy előre beállított dashboardot — de bárki személyre szabhatja, új widget-eket adhat hozzá vagy elrejthet.</p>
                </div>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-7" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="icon-hover mb-5 flex h-12 w-12 items-center justify-center rounded-xl bg-emerald-50 text-xl">🔄</div>
                    <h3 class="mb-2 text-base font-bold text-text-primary">Valós idejű frissítés</h3>
                    <p class="text-sm leading-relaxed text-text-secondary">Az adatok nem statikusak: a KPI-k, grafikonok és feed-ek automatikusan frissülnek — nincs „riport futtatás", nincs „F5". Az irányítópult mindig az aktuális állapotot mutatja.</p>
                </div>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-7" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="icon-hover mb-5 flex h-12 w-12 items-center justify-center rounded-xl bg-amber-50 text-xl">📱</div>
                    <h3 class="mb-2 text-base font-bold text-text-primary">Mobil-elérés</h3>
                    <p class="text-sm leading-relaxed text-text-secondary">A dashboardok reszponzívak: tableten és telefonon is használhatók. A helyszíni szerelő, a kiszálló értékesítő vagy a tárgyalóteremben ülő CEO ugyanazt a friss adatot látja.</p>
                </div>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-7" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="icon-hover mb-5 flex h-12 w-12 items-center justify-center rounded-xl bg-blue-50 text-xl">🔗</div>
                    <h3 class="mb-2 text-base font-bold text-text-primary">Modul-átívelő adatok</h3>
                    <p class="text-sm leading-relaxed text-text-secondary">Egy dashboardon megjelenik a CRM pipeline, a gyártási OEE, a pénzügyi P&amp;L és a szerviz SLA — mert az adatok egyetlen rendszerben élnek. Nem kell integrálni.</p>
                </div>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-7" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="icon-hover mb-5 flex h-12 w-12 items-center justify-center rounded-xl bg-rose-50 text-xl">🤝</div>
                    <h3 class="mb-2 text-base font-bold text-text-primary">Export és megosztás</h3>
                    <p class="text-sm leading-relaxed text-text-secondary">Bármely dashboard vagy widget exportálható PDF-be, Excel-be. Automatikus e-mail küldés ütemezése: hétfőnként a vezetői dashboard PDF-ben, havi záráskor a P&amp;L.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Widget Library Section (12 cards) --}}
    <section class="bg-surface-secondary py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-6">
            <div class="reveal mb-12">
                <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-cyan-600">Widget-könyvtár</p>
                <h2 class="mb-4 text-3xl text-text-primary md:text-4xl" style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                    40+ widget — húzd a dashboardra
                </h2>
                <p class="max-w-xl text-lg text-text-secondary">
                    A widget-könyvtárból bárki kiválaszthatja a számára fontos elemeket és elhelyezheti az irányítópultján.
                </p>
            </div>

            <div class="grid grid-cols-2 gap-4 sm:grid-cols-3 lg:grid-cols-4" data-stagger>
                <div class="stagger-item pill-float rounded-xl border border-border-light bg-surface-primary p-5 text-center" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <span class="mb-2 block text-xl">🔢</span>
                    <span class="block text-xs font-bold text-text-primary">KPI-kártya</span>
                    <span class="text-[10px] text-text-tertiary">Egyetlen szám, trend-nyíl</span>
                </div>
                <div class="stagger-item pill-float rounded-xl border border-border-light bg-surface-primary p-5 text-center" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <span class="mb-2 block text-xl">📊</span>
                    <span class="block text-xs font-bold text-text-primary">Oszlopdiagram</span>
                    <span class="text-[10px] text-text-tertiary">Idősor, csoportosított, halmozott</span>
                </div>
                <div class="stagger-item pill-float rounded-xl border border-border-light bg-surface-primary p-5 text-center" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <span class="mb-2 block text-xl">📈</span>
                    <span class="block text-xs font-bold text-text-primary">Vonaldiagram</span>
                    <span class="text-[10px] text-text-tertiary">Trend, többszörös sor, prognózis</span>
                </div>
                <div class="stagger-item pill-float rounded-xl border border-border-light bg-surface-primary p-5 text-center" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <span class="mb-2 block text-xl">🍩</span>
                    <span class="block text-xs font-bold text-text-primary">Kör/fánk diagram</span>
                    <span class="text-[10px] text-text-tertiary">Arány, megoszlás, szegmens</span>
                </div>
                <div class="stagger-item pill-float rounded-xl border border-border-light bg-surface-primary p-5 text-center" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <span class="mb-2 block text-xl">📋</span>
                    <span class="block text-xs font-bold text-text-primary">Táblázat</span>
                    <span class="text-[10px] text-text-tertiary">Szűrhető lista, rendezés</span>
                </div>
                <div class="stagger-item pill-float rounded-xl border border-border-light bg-surface-primary p-5 text-center" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <span class="mb-2 block text-xl">🗺</span>
                    <span class="block text-xs font-bold text-text-primary">Térkép</span>
                    <span class="text-[10px] text-text-tertiary">Helyszínek, technikusok</span>
                </div>
                <div class="stagger-item pill-float rounded-xl border border-border-light bg-surface-primary p-5 text-center" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <span class="mb-2 block text-xl">💡</span>
                    <span class="block text-xs font-bold text-text-primary">Gauge / sebességmérő</span>
                    <span class="text-[10px] text-text-tertiary">Célérték: OEE, SLA, terv%</span>
                </div>
                <div class="stagger-item pill-float rounded-xl border border-border-light bg-surface-primary p-5 text-center" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <span class="mb-2 block text-xl">🔥</span>
                    <span class="block text-xs font-bold text-text-primary">Hőtérkép</span>
                    <span class="text-[10px] text-text-tertiary">Aktivitás, kapacitás, eloszlás</span>
                </div>
                <div class="stagger-item pill-float rounded-xl border border-border-light bg-surface-primary p-5 text-center" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <span class="mb-2 block text-xl">🧠</span>
                    <span class="block text-xs font-bold text-text-primary">MI összefoglaló</span>
                    <span class="text-[10px] text-text-tertiary">DataMind napi elemzés</span>
                </div>
                <div class="stagger-item pill-float rounded-xl border border-border-light bg-surface-primary p-5 text-center" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <span class="mb-2 block text-xl">⚡</span>
                    <span class="block text-xs font-bold text-text-primary">Aktivitás-feed</span>
                    <span class="text-[10px] text-text-tertiary">Valós idejű események</span>
                </div>
                <div class="stagger-item pill-float rounded-xl border border-border-light bg-surface-primary p-5 text-center" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <span class="mb-2 block text-xl">📅</span>
                    <span class="block text-xs font-bold text-text-primary">Naptár/ütemterv</span>
                    <span class="text-[10px] text-text-tertiary">Kiszállás, határidő</span>
                </div>
                <div class="stagger-item pill-float rounded-xl border border-border-light bg-surface-primary p-5 text-center" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <span class="mb-2 block text-xl">🎯</span>
                    <span class="block text-xs font-bold text-text-primary">Pipeline funnel</span>
                    <span class="text-[10px] text-text-tertiary">Értékesítési tölcsér</span>
                </div>
            </div>
        </div>
    </section>

    {{-- Module Dashboards Section (6 cards) --}}
    <section class="bg-surface-primary py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-6">
            <div class="reveal mb-12">
                <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-cyan-600">Modul-irányítópultok</p>
                <h2 class="mb-4 text-3xl text-text-primary md:text-4xl" style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                    Minden modul saját alapértelmezett dashboarddal rendelkezik
                </h2>
                <p class="max-w-xl text-lg text-text-secondary">
                    A modulok beépített irányítópultjai azonnal használhatók — és bármikor bővíthetők a widget-könyvtárból.
                </p>
            </div>

            <div class="grid grid-cols-1 gap-5 md:grid-cols-2" data-stagger>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-6" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="mb-4 flex items-center gap-3">
                        <span class="rounded-md bg-emerald-50 px-3 py-1 text-[10px] font-bold uppercase tracking-wider text-emerald-600">CRM</span>
                        <span class="text-xs text-text-tertiary">Értékesítési dashboard</span>
                    </div>
                    <div class="flex flex-wrap gap-1.5">
                        <span class="rounded-md border border-border-light bg-surface-secondary px-2.5 py-1 text-[11px] text-text-secondary">Pipeline funnel</span>
                        <span class="rounded-md border border-border-light bg-surface-secondary px-2.5 py-1 text-[11px] text-text-secondary">Értékesítő-rangsor</span>
                        <span class="rounded-md border border-border-light bg-surface-secondary px-2.5 py-1 text-[11px] text-text-secondary">Havi trendgörbe</span>
                        <span class="rounded-md border border-border-light bg-surface-secondary px-2.5 py-1 text-[11px] text-text-secondary">Top ügyfelek</span>
                        <span class="rounded-md border border-border-light bg-surface-secondary px-2.5 py-1 text-[11px] text-text-secondary">Churn-kockázat</span>
                        <span class="rounded-md border border-border-light bg-surface-secondary px-2.5 py-1 text-[11px] text-text-secondary">Ajánlat-konverzió</span>
                    </div>
                </div>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-6" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="mb-4 flex items-center gap-3">
                        <span class="rounded-md bg-orange-50 px-3 py-1 text-[10px] font-bold uppercase tracking-wider text-orange-600">Gyártásirányítás</span>
                        <span class="text-xs text-text-tertiary">Termelés dashboard</span>
                    </div>
                    <div class="flex flex-wrap gap-1.5">
                        <span class="rounded-md border border-border-light bg-surface-secondary px-2.5 py-1 text-[11px] text-text-secondary">OEE gauge (gépenként)</span>
                        <span class="rounded-md border border-border-light bg-surface-secondary px-2.5 py-1 text-[11px] text-text-secondary">Selejt-arány trend</span>
                        <span class="rounded-md border border-border-light bg-surface-secondary px-2.5 py-1 text-[11px] text-text-secondary">Kapacitás hőtérkép</span>
                        <span class="rounded-md border border-border-light bg-surface-secondary px-2.5 py-1 text-[11px] text-text-secondary">Gyártási ütemterv</span>
                        <span class="rounded-md border border-border-light bg-surface-secondary px-2.5 py-1 text-[11px] text-text-secondary">Anyagszükséglet</span>
                        <span class="rounded-md border border-border-light bg-surface-secondary px-2.5 py-1 text-[11px] text-text-secondary">Prediktív karbantartás</span>
                    </div>
                </div>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-6" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="mb-4 flex items-center gap-3">
                        <span class="rounded-md bg-cyan-50 px-3 py-1 text-[10px] font-bold uppercase tracking-wider text-cyan-600">Beszerzés-logisztika</span>
                        <span class="text-xs text-text-tertiary">Készlet dashboard</span>
                    </div>
                    <div class="flex flex-wrap gap-1.5">
                        <span class="rounded-md border border-border-light bg-surface-secondary px-2.5 py-1 text-[11px] text-text-secondary">Kritikus készletek</span>
                        <span class="rounded-md border border-border-light bg-surface-secondary px-2.5 py-1 text-[11px] text-text-secondary">Nyitott megrendelések</span>
                        <span class="rounded-md border border-border-light bg-surface-secondary px-2.5 py-1 text-[11px] text-text-secondary">Szállítói scoring</span>
                        <span class="rounded-md border border-border-light bg-surface-secondary px-2.5 py-1 text-[11px] text-text-secondary">Bevételezés-státusz</span>
                        <span class="rounded-md border border-border-light bg-surface-secondary px-2.5 py-1 text-[11px] text-text-secondary">Költség vs. terv</span>
                        <span class="rounded-md border border-border-light bg-surface-secondary px-2.5 py-1 text-[11px] text-text-secondary">Szállítási késések</span>
                    </div>
                </div>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-6" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="mb-4 flex items-center gap-3">
                        <span class="rounded-md bg-violet-50 px-3 py-1 text-[10px] font-bold uppercase tracking-wider text-violet-600">Kontrolling</span>
                        <span class="text-xs text-text-tertiary">Pénzügyi dashboard</span>
                    </div>
                    <div class="flex flex-wrap gap-1.5">
                        <span class="rounded-md border border-border-light bg-surface-secondary px-2.5 py-1 text-[11px] text-text-secondary">P&amp;L összefoglaló</span>
                        <span class="rounded-md border border-border-light bg-surface-secondary px-2.5 py-1 text-[11px] text-text-secondary">Cash flow aktuális</span>
                        <span class="rounded-md border border-border-light bg-surface-secondary px-2.5 py-1 text-[11px] text-text-secondary">Cash flow előrejelzés</span>
                        <span class="rounded-md border border-border-light bg-surface-secondary px-2.5 py-1 text-[11px] text-text-secondary">Kintlévőségek</span>
                        <span class="rounded-md border border-border-light bg-surface-secondary px-2.5 py-1 text-[11px] text-text-secondary">Projekt-jövedelmezőség</span>
                        <span class="rounded-md border border-border-light bg-surface-secondary px-2.5 py-1 text-[11px] text-text-secondary">Terv vs. tény</span>
                    </div>
                </div>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-6" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="mb-4 flex items-center gap-3">
                        <span class="rounded-md bg-amber-50 px-3 py-1 text-[10px] font-bold uppercase tracking-wider text-amber-600">Szerviz</span>
                        <span class="text-xs text-text-tertiary">Szerviz dashboard</span>
                    </div>
                    <div class="flex flex-wrap gap-1.5">
                        <span class="rounded-md border border-border-light bg-surface-secondary px-2.5 py-1 text-[11px] text-text-secondary">Nyitott jegyek</span>
                        <span class="rounded-md border border-border-light bg-surface-secondary px-2.5 py-1 text-[11px] text-text-secondary">SLA gauge</span>
                        <span class="rounded-md border border-border-light bg-surface-secondary px-2.5 py-1 text-[11px] text-text-secondary">Technikus térkép</span>
                        <span class="rounded-md border border-border-light bg-surface-secondary px-2.5 py-1 text-[11px] text-text-secondary">CSAT/NPS</span>
                        <span class="rounded-md border border-border-light bg-surface-secondary px-2.5 py-1 text-[11px] text-text-secondary">Karbantartás naptár</span>
                        <span class="rounded-md border border-border-light bg-surface-secondary px-2.5 py-1 text-[11px] text-text-secondary">Alkatrész-készlet</span>
                    </div>
                </div>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-6" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="mb-4 flex items-center gap-3">
                        <span class="rounded-md bg-sky-50 px-3 py-1 text-[10px] font-bold uppercase tracking-wider text-sky-600">MarketingHub</span>
                        <span class="text-xs text-text-tertiary">Marketing dashboard</span>
                    </div>
                    <div class="flex flex-wrap gap-1.5">
                        <span class="rounded-md border border-border-light bg-surface-secondary px-2.5 py-1 text-[11px] text-text-secondary">Kampány ROI</span>
                        <span class="rounded-md border border-border-light bg-surface-secondary px-2.5 py-1 text-[11px] text-text-secondary">Lead-scoring</span>
                        <span class="rounded-md border border-border-light bg-surface-secondary px-2.5 py-1 text-[11px] text-text-secondary">E-mail teljesítmény</span>
                        <span class="rounded-md border border-border-light bg-surface-secondary px-2.5 py-1 text-[11px] text-text-secondary">Weboldal-forgalom</span>
                        <span class="rounded-md border border-border-light bg-surface-secondary px-2.5 py-1 text-[11px] text-text-secondary">Konverzió funnel</span>
                        <span class="rounded-md border border-border-light bg-surface-secondary px-2.5 py-1 text-[11px] text-text-secondary">SEO rangsor</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Dashboard Builder Section --}}
    <section class="bg-surface-secondary py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-6">
            <div class="reveal mb-12">
                <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-cyan-600">Dashboard-építő</p>
                <h2 class="mb-4 text-3xl text-text-primary md:text-4xl" style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                    4 lépésben összeállítható — kód nélkül
                </h2>
                <p class="max-w-xl text-lg text-text-secondary">
                    Az egyedi dashboardok létrehozása bárki számára elérhető — a widget-könyvtárból válogatva, drag-and-drop módszerrel.
                </p>
            </div>

            <div class="reveal">
                <div class="rounded-2xl border border-border-light bg-surface-primary p-6 lg:p-8" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    {{-- Steps --}}
                    <div class="mb-6 grid grid-cols-2 gap-4 lg:grid-cols-4" data-stagger>
                        <div class="stagger-item rounded-xl border border-border-light bg-surface-secondary p-5 text-center">
                            <span class="mb-2 block text-xs font-bold text-cyan-600" style="font-family: 'JetBrains Mono', monospace;">01</span>
                            <span class="mb-2 block text-xl">➕</span>
                            <span class="block text-xs font-bold text-text-primary">Új dashboard</span>
                            <span class="text-[10px] text-text-tertiary">Üres felület, elnevezés, hozzáférés</span>
                        </div>
                        <div class="stagger-item rounded-xl border border-border-light bg-surface-secondary p-5 text-center">
                            <span class="mb-2 block text-xs font-bold text-violet-600" style="font-family: 'JetBrains Mono', monospace;">02</span>
                            <span class="mb-2 block text-xl">🧩</span>
                            <span class="block text-xs font-bold text-text-primary">Widget-ek kiválasztása</span>
                            <span class="text-[10px] text-text-tertiary">40+ widget a könyvtárból</span>
                        </div>
                        <div class="stagger-item rounded-xl border border-border-light bg-surface-secondary p-5 text-center">
                            <span class="mb-2 block text-xs font-bold text-emerald-600" style="font-family: 'JetBrains Mono', monospace;">03</span>
                            <span class="mb-2 block text-xl">🔍</span>
                            <span class="block text-xs font-bold text-text-primary">Szűrők és adat</span>
                            <span class="text-[10px] text-text-tertiary">Modul, időszak, ügyfél, projekt</span>
                        </div>
                        <div class="stagger-item rounded-xl border border-border-light bg-surface-secondary p-5 text-center">
                            <span class="mb-2 block text-xs font-bold text-amber-600" style="font-family: 'JetBrains Mono', monospace;">04</span>
                            <span class="mb-2 block text-xl">💾</span>
                            <span class="block text-xs font-bold text-text-primary">Mentés és megosztás</span>
                            <span class="text-[10px] text-text-tertiary">Auto frissítés, e-mail, PDF</span>
                        </div>
                    </div>

                    {{-- Example Dashboard --}}
                    <div class="rounded-xl border border-cyan-100 bg-linear-to-r from-cyan-50 to-sky-50 p-5">
                        <span class="mb-3 block text-xs font-bold text-cyan-600">Példa: Heti vezetői áttekintés (6 widget)</span>
                        <div class="grid grid-cols-2 gap-3 sm:grid-cols-3">
                            <div class="rounded-lg border border-border-light bg-surface-primary p-3 text-center">
                                <span class="block text-sm">📊</span>
                                <span class="block text-[10px] font-bold text-text-secondary">Heti árbevétel</span>
                                <span class="block text-xs font-extrabold text-cyan-600" style="font-family: 'JetBrains Mono', monospace;">42.3M Ft</span>
                            </div>
                            <div class="rounded-lg border border-border-light bg-surface-primary p-3 text-center">
                                <span class="block text-sm">🎯</span>
                                <span class="block text-[10px] font-bold text-text-secondary">Pipeline funnel</span>
                                <span class="block text-xs font-extrabold text-emerald-600" style="font-family: 'JetBrains Mono', monospace;">187.4M</span>
                            </div>
                            <div class="rounded-lg border border-border-light bg-surface-primary p-3 text-center">
                                <span class="block text-sm">💡</span>
                                <span class="block text-[10px] font-bold text-text-secondary">OEE gauge</span>
                                <span class="block text-xs font-extrabold text-amber-600" style="font-family: 'JetBrains Mono', monospace;">87%</span>
                            </div>
                            <div class="rounded-lg border border-border-light bg-surface-primary p-3 text-center">
                                <span class="block text-sm">⚡</span>
                                <span class="block text-[10px] font-bold text-text-secondary">Aktivitás-feed</span>
                                <span class="block text-xs font-extrabold text-violet-600" style="font-family: 'JetBrains Mono', monospace;">12 esemény</span>
                            </div>
                            <div class="rounded-lg border border-border-light bg-surface-primary p-3 text-center">
                                <span class="block text-sm">🧠</span>
                                <span class="block text-[10px] font-bold text-text-secondary">MI összefoglaló</span>
                                <span class="block text-xs font-extrabold text-violet-600" style="font-family: 'JetBrains Mono', monospace;">3 kockázat</span>
                            </div>
                            <div class="rounded-lg border border-border-light bg-surface-primary p-3 text-center">
                                <span class="block text-sm">💰</span>
                                <span class="block text-[10px] font-bold text-text-secondary">Cash flow</span>
                                <span class="block text-xs font-extrabold text-cyan-600" style="font-family: 'JetBrains Mono', monospace;">+14.2M</span>
                            </div>
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
                <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-cyan-600">Eredmények</p>
                <h2 class="text-3xl text-text-primary md:text-4xl" style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                    Mérhető hatás az irányítópultokból
                </h2>
            </div>

            <div class="grid grid-cols-2 gap-5 lg:grid-cols-4" data-stagger data-counter-trigger>
                <div class="stagger-item stat-hover rounded-2xl border border-border-light bg-surface-primary p-8 text-center" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <span class="stat-value block text-4xl font-bold text-cyan-600 lg:text-5xl" style="font-family: 'JetBrains Mono', monospace;"
                        data-count="90" data-prefix="-" data-suffix="%">0</span>
                    <span class="mt-2 block text-sm text-text-secondary">Riport-készítési idő</span>
                </div>
                <div class="stagger-item stat-hover rounded-2xl border border-border-light bg-surface-primary p-8 text-center" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <span class="stat-value block text-4xl font-bold text-emerald-600 lg:text-5xl" style="font-family: 'JetBrains Mono', monospace;"
                        data-count="5" data-suffix="×">0</span>
                    <span class="mt-2 block text-sm text-text-secondary">Gyorsabb döntéshozatal</span>
                </div>
                <div class="stagger-item stat-hover rounded-2xl border border-border-light bg-surface-primary p-8 text-center" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <span class="stat-value block text-4xl font-bold text-violet-600 lg:text-5xl" style="font-family: 'JetBrains Mono', monospace;"
                        data-count="40" data-suffix="+">0</span>
                    <span class="mt-2 block text-sm text-text-secondary">Widget a könyvtárban</span>
                </div>
                <div class="stagger-item stat-hover rounded-2xl border border-border-light bg-surface-primary p-8 text-center" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <span class="stat-value block text-4xl font-bold text-amber-600 lg:text-5xl" style="font-family: 'JetBrains Mono', monospace;"
                        data-count="0">0</span>
                    <span class="mt-2 block text-sm text-text-secondary">Szükséges fejlesztői óra</span>
                </div>
            </div>
        </div>
    </section>

    {{-- Use Cases Section (6 cases) --}}
    <section class="bg-surface-secondary py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-6">
            <div class="reveal mb-12">
                <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-cyan-600">Felhasználási esetek</p>
                <h2 class="mb-4 text-3xl text-text-primary md:text-4xl" style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                    Így használják az irányítópultokat
                </h2>
            </div>

            <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3" data-stagger>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-7" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <span class="mb-4 block text-xs font-semibold text-text-tertiary" style="font-family: 'JetBrains Mono', monospace;">01</span>
                    <h3 class="mb-2 text-base font-bold text-text-primary">CEO reggeli áttekintés — 2 perc alatt</h3>
                    <p class="mb-4 text-sm leading-relaxed text-text-secondary">Az ügyvezető bejelentkezik, és a dashboardon azonnal látja: tegnapi árbevétel, pipeline állapot, SLA-teljesítés, OEE, cash flow, DataMind MI összefoglaló — egyetlen képernyőn.</p>
                    <div class="flex flex-wrap gap-1.5">
                        <span class="rounded bg-cyan-50 px-2 py-0.5 text-[10px] font-semibold text-cyan-600">Vezetői dashboard</span>
                        <span class="rounded bg-violet-50 px-2 py-0.5 text-[10px] font-semibold text-violet-600">DataMind</span>
                    </div>
                </div>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-7" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <span class="mb-4 block text-xs font-semibold text-text-tertiary" style="font-family: 'JetBrains Mono', monospace;">02</span>
                    <h3 class="mb-2 text-base font-bold text-text-primary">Értékesítési heti meeting adattal</h3>
                    <p class="mb-4 text-sm leading-relaxed text-text-secondary">Az értékesítési vezető megnyitja a dashboard-ot a meeting elején: pipeline funnel, értékesítőnkénti teljesítmény, konverziós arány, churn-kockázat — nem Excel-t küldözgetnek.</p>
                    <div class="flex flex-wrap gap-1.5">
                        <span class="rounded bg-cyan-50 px-2 py-0.5 text-[10px] font-semibold text-cyan-600">Értékesítési dashboard</span>
                        <span class="rounded bg-slate-100 px-2 py-0.5 text-[10px] font-semibold text-slate-600">Megosztás</span>
                    </div>
                </div>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-7" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <span class="mb-4 block text-xs font-semibold text-text-tertiary" style="font-family: 'JetBrains Mono', monospace;">03</span>
                    <h3 class="mb-2 text-base font-bold text-text-primary">Üzemvezető műszak-áttekintés mobilon</h3>
                    <p class="mb-4 text-sm leading-relaxed text-text-secondary">Az üzemvezető az üzemcsarnokból, telefonon ellenőrzi az OEE-t gépenként, a selejt-arányt, a kapacitás-kihasználtságot és a prediktív karbantartás jelzéseket — valós időben.</p>
                    <div class="flex flex-wrap gap-1.5">
                        <span class="rounded bg-cyan-50 px-2 py-0.5 text-[10px] font-semibold text-cyan-600">Termelés dashboard</span>
                        <span class="rounded bg-slate-100 px-2 py-0.5 text-[10px] font-semibold text-slate-600">Mobil</span>
                    </div>
                </div>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-7" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <span class="mb-4 block text-xs font-semibold text-text-tertiary" style="font-family: 'JetBrains Mono', monospace;">04</span>
                    <h3 class="mb-2 text-base font-bold text-text-primary">Automatikus heti PDF riport e-mailben</h3>
                    <p class="mb-4 text-sm leading-relaxed text-text-secondary">A vezetői dashboard automatikusan PDF-be exportálódik minden hétfőn 8:00-kor, és e-mailben megy az igazgatóságnak. Nincs kézi riportkészítés — a dashboard maga a riport.</p>
                    <div class="flex flex-wrap gap-1.5">
                        <span class="rounded bg-cyan-50 px-2 py-0.5 text-[10px] font-semibold text-cyan-600">Export</span>
                        <span class="rounded bg-slate-100 px-2 py-0.5 text-[10px] font-semibold text-slate-600">Automatizálás</span>
                    </div>
                </div>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-7" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <span class="mb-4 block text-xs font-semibold text-text-tertiary" style="font-family: 'JetBrains Mono', monospace;">05</span>
                    <h3 class="mb-2 text-base font-bold text-text-primary">Szervizmenedzser helyszíni koordinálás</h3>
                    <p class="mb-4 text-sm leading-relaxed text-text-secondary">A szerviz dashboard-on a térkép widget mutatja a technikusok helyszínét, a jegy-lista a nyitott feladatokat, az SLA gauge a teljesítményt. Valós idejű kiszállás-koordináció.</p>
                    <div class="flex flex-wrap gap-1.5">
                        <span class="rounded bg-cyan-50 px-2 py-0.5 text-[10px] font-semibold text-cyan-600">Szerviz dashboard</span>
                        <span class="rounded bg-slate-100 px-2 py-0.5 text-[10px] font-semibold text-slate-600">Térkép widget</span>
                    </div>
                </div>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-7" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <span class="mb-4 block text-xs font-semibold text-text-tertiary" style="font-family: 'JetBrains Mono', monospace;">06</span>
                    <h3 class="mb-2 text-base font-bold text-text-primary">Egyedi projekt-dashboard az ügyfélnek</h3>
                    <p class="mb-4 text-sm leading-relaxed text-text-secondary">Egy kiemelt projekthez saját dashboardot készítenek: projekt-mérföldkövek, költség vs. terv, szervizjegy-státuszok, dokumentumok. Az ügyfél az ügyfélportálon keresztül is láthatja.</p>
                    <div class="flex flex-wrap gap-1.5">
                        <span class="rounded bg-cyan-50 px-2 py-0.5 text-[10px] font-semibold text-cyan-600">Egyedi dashboard</span>
                        <span class="rounded bg-slate-100 px-2 py-0.5 text-[10px] font-semibold text-slate-600">Ügyfélportál</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Competitor Comparison Section (3 cards) --}}
    <section class="bg-surface-primary py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-6">
            <div class="reveal mb-12">
                <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-cyan-600">Piaci összehasonlítás</p>
                <h2 class="mb-4 text-3xl text-text-primary md:text-4xl" style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                    Dashboard-megközelítések az ipari piacon
                </h2>
                <p class="max-w-xl text-lg text-text-secondary">
                    Különböző rendszerek különbözően kezelik a riportolást és az irányítópultokat.
                </p>
            </div>

            <div class="grid grid-cols-1 gap-6 lg:grid-cols-3" data-stagger>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-8" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="mb-5">
                        <span class="mb-1 block text-xs font-semibold uppercase tracking-wider text-text-tertiary">Külső BI eszközök</span>
                        <span class="block text-[11px] text-text-tertiary">Power BI, Tableau, Looker, Metabase</span>
                    </div>
                    <div class="mb-5 space-y-2">
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><svg class="h-4 w-4 text-success-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>Erős vizualizáció és elemzőképesség</span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><svg class="h-4 w-4 text-success-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>Sok adatforrás csatlakoztatható</span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><svg class="h-4 w-4 text-success-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>Fejlett kalkulációk és modellezés</span>
                    </div>
                    <div class="space-y-2 border-t border-border-light pt-5">
                        <span class="flex items-center gap-2 text-sm text-text-tertiary"><svg class="h-4 w-4 text-danger-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>Külön rendszer: integrálni kell minden adatforrást</span>
                        <span class="flex items-center gap-2 text-sm text-text-tertiary"><svg class="h-4 w-4 text-danger-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>ETL pipeline szükséges — késleltetett adat</span>
                        <span class="flex items-center gap-2 text-sm text-text-tertiary"><svg class="h-4 w-4 text-danger-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>Licensz: felhasználónkénti díj, drága skálázás</span>
                        <span class="flex items-center gap-2 text-sm text-text-tertiary"><svg class="h-4 w-4 text-danger-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>Karbantartás: ha az adat változik, a riport is törhet</span>
                    </div>
                </div>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-8" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="mb-5">
                        <span class="mb-1 block text-xs font-semibold uppercase tracking-wider text-text-tertiary">ERP beépített riportok</span>
                        <span class="block text-[11px] text-text-tertiary">SAP Crystal, Dynamics Reports, Odoo</span>
                    </div>
                    <div class="mb-5 space-y-2">
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><svg class="h-4 w-4 text-success-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>Integrált a pénzügyi adatokkal</span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><svg class="h-4 w-4 text-success-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>Szabványos pénzügyi riportok</span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><svg class="h-4 w-4 text-success-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>Audit-kompatibilis</span>
                    </div>
                    <div class="space-y-2 border-t border-border-light pt-5">
                        <span class="flex items-center gap-2 text-sm text-text-tertiary"><svg class="h-4 w-4 text-danger-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>Statikus, táblázatos — kevés vizualizáció</span>
                        <span class="flex items-center gap-2 text-sm text-text-tertiary"><svg class="h-4 w-4 text-danger-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>Testreszabás: tanácsadói projekt, drága fejlesztés</span>
                        <span class="flex items-center gap-2 text-sm text-text-tertiary"><svg class="h-4 w-4 text-danger-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>Szerviz, marketing, AI: nincs rajta</span>
                        <span class="flex items-center gap-2 text-sm text-text-tertiary"><svg class="h-4 w-4 text-danger-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>Drag-and-drop: általában nincs</span>
                    </div>
                </div>
                <div class="stagger-item card-glow rounded-2xl border border-cyan-200 bg-cyan-50 p-8" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="mb-5">
                        <span class="mb-1 block text-xs font-semibold uppercase tracking-wider text-cyan-600">Cégem360</span>
                        <span class="block text-[11px] text-text-tertiary">Beépített dashboard · 11 modul · Widget-rendszer</span>
                    </div>
                    <div class="space-y-2">
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><svg class="h-4 w-4 text-success-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>Valós idejű adat — nincs ETL, nincs késleltetés</span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><svg class="h-4 w-4 text-success-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>11 modul adata egyetlen dashboardon</span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><svg class="h-4 w-4 text-success-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>Drag-and-drop widget-rendszer, 40+ widget</span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><svg class="h-4 w-4 text-success-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>Szerepkör-alapú automatikus dashboard</span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><svg class="h-4 w-4 text-success-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>MI összefoglaló és predikció beépítve</span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><svg class="h-4 w-4 text-success-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>Mobil, export, e-mail ütemezés</span>
                    </div>
                    <div class="mt-5 rounded-lg bg-surface-primary p-3">
                        <p class="text-xs font-semibold text-cyan-700">Ajánlott: ipari cégeknek, akik nem akarnak külön BI rendszert integrálni — hanem a saját platform adataira építenek dashboardot.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Detailed Comparison Table (10 rows × 4 columns) --}}
    <section class="bg-surface-secondary py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-6">
            <div class="reveal mb-12">
                <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-cyan-600">Részletes összehasonlítás</p>
                <h2 class="mb-4 text-3xl text-text-primary md:text-4xl" style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                    Irányítópult képesség-összehasonlítás
                </h2>
            </div>

            <div class="reveal overflow-x-auto">
                <table class="w-full min-w-[700px] border-collapse overflow-hidden rounded-2xl border border-border-light">
                    <thead>
                        <tr class="bg-surface-primary">
                            <th class="px-5 py-4 text-left text-xs font-bold uppercase tracking-wider text-text-primary">Képesség</th>
                            <th class="px-5 py-4 text-left text-xs font-bold uppercase tracking-wider text-text-tertiary">Külső BI</th>
                            <th class="px-5 py-4 text-left text-xs font-bold uppercase tracking-wider text-text-tertiary">ERP riportok</th>
                            <th class="px-5 py-4 text-left text-xs font-bold uppercase tracking-wider text-cyan-600">Cégem360</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-border-light">
                        <tr>
                            <td class="px-5 py-4 text-sm font-semibold text-text-primary">Valós idejű adat</td>
                            <td class="px-5 py-4 text-sm text-amber-600">◐ ETL késleltetés</td>
                            <td class="px-5 py-4 text-sm text-amber-600">◐ Frissítéssel</td>
                            <td class="px-5 py-4 text-sm font-medium text-success-600">✓ Natív, azonnal</td>
                        </tr>
                        <tr>
                            <td class="px-5 py-4 text-sm font-semibold text-text-primary">Drag-and-drop widget-rendszer</td>
                            <td class="px-5 py-4 text-sm font-medium text-success-600">✓ Erős</td>
                            <td class="px-5 py-4 text-sm text-text-tertiary">✗ Nincs</td>
                            <td class="px-5 py-4 text-sm font-medium text-success-600">✓ 40+ widget</td>
                        </tr>
                        <tr>
                            <td class="px-5 py-4 text-sm font-semibold text-text-primary">Szerepkör-alapú alapértelmezés</td>
                            <td class="px-5 py-4 text-sm text-text-tertiary">✗ Kézi</td>
                            <td class="px-5 py-4 text-sm text-amber-600">◐ Korlátozott</td>
                            <td class="px-5 py-4 text-sm font-medium text-success-600">✓ Automatikus</td>
                        </tr>
                        <tr>
                            <td class="px-5 py-4 text-sm font-semibold text-text-primary">Modul-átívelő adatok</td>
                            <td class="px-5 py-4 text-sm text-amber-600">◐ Integrációval</td>
                            <td class="px-5 py-4 text-sm text-amber-600">◐ Részben</td>
                            <td class="px-5 py-4 text-sm font-medium text-success-600">✓ Natív, 11 modul</td>
                        </tr>
                        <tr>
                            <td class="px-5 py-4 text-sm font-semibold text-text-primary">MI összefoglaló widget</td>
                            <td class="px-5 py-4 text-sm text-amber-600">◐ AI Copilot</td>
                            <td class="px-5 py-4 text-sm text-text-tertiary">✗ Nincs</td>
                            <td class="px-5 py-4 text-sm font-medium text-success-600">✓ DataMind</td>
                        </tr>
                        <tr>
                            <td class="px-5 py-4 text-sm font-semibold text-text-primary">Mobil-elérés</td>
                            <td class="px-5 py-4 text-sm font-medium text-success-600">✓ App</td>
                            <td class="px-5 py-4 text-sm text-amber-600">◐ Korlátozott</td>
                            <td class="px-5 py-4 text-sm font-medium text-success-600">✓ Reszponzív</td>
                        </tr>
                        <tr>
                            <td class="px-5 py-4 text-sm font-semibold text-text-primary">PDF export + e-mail ütemezés</td>
                            <td class="px-5 py-4 text-sm font-medium text-success-600">✓ Erős</td>
                            <td class="px-5 py-4 text-sm text-amber-600">◐ Alap</td>
                            <td class="px-5 py-4 text-sm font-medium text-success-600">✓ Automatikus</td>
                        </tr>
                        <tr>
                            <td class="px-5 py-4 text-sm font-semibold text-text-primary">Bevezetési idő</td>
                            <td class="px-5 py-4 text-sm text-text-tertiary">✗ Hetek/hónapok</td>
                            <td class="px-5 py-4 text-sm text-text-tertiary">✗ Tanácsadói projekt</td>
                            <td class="px-5 py-4 text-sm font-medium text-success-600">✓ Azonnal használható</td>
                        </tr>
                        <tr>
                            <td class="px-5 py-4 text-sm font-semibold text-text-primary">Extra licensz szükséges?</td>
                            <td class="px-5 py-4 text-sm text-text-tertiary">✗ Igen, felhasználónként</td>
                            <td class="px-5 py-4 text-sm text-amber-600">◐ Modulonként</td>
                            <td class="px-5 py-4 text-sm font-medium text-success-600">✓ Beépítve</td>
                        </tr>
                        <tr>
                            <td class="px-5 py-4 text-sm font-semibold text-text-primary">Ipari KPI-k beépítve (OEE, SLA)</td>
                            <td class="px-5 py-4 text-sm text-text-tertiary">✗ Kézi létrehozás</td>
                            <td class="px-5 py-4 text-sm text-amber-600">◐ Részben</td>
                            <td class="px-5 py-4 text-sm font-medium text-success-600">✓ Azonnal elérhető</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    {{-- Consultation Section --}}
    <section class="bg-surface-primary py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-6">
            <div class="reveal">
                <div class="grid grid-cols-1 items-center gap-8 rounded-2xl border border-border-light bg-surface-primary p-8 lg:grid-cols-[1fr_auto] lg:p-12" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div>
                        <h3 class="mb-3 text-xl font-bold text-text-primary lg:text-2xl" style="font-family: 'Poppins', sans-serif;">Személyre szabott dashboard-konzultáció</h3>
                        <p class="mb-5 text-base text-text-secondary">30 perces videóhívás, amelyben felmérjük, milyen KPI-kat és riportokat használ jelenleg, és bemutatjuk, hogyan épülne fel az Ön cégére szabott irányítópult-rendszer a Cégem360-ban.</p>
                        <div class="flex flex-wrap gap-5">
                            <span class="flex items-center gap-1.5 text-sm text-text-tertiary"><svg class="h-4 w-4 text-success-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>30 perc videóhívás</span>
                            <span class="flex items-center gap-1.5 text-sm text-text-tertiary"><svg class="h-4 w-4 text-success-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>KPI audit</span>
                            <span class="flex items-center gap-1.5 text-sm text-text-tertiary"><svg class="h-4 w-4 text-success-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>Nincs elköteleződés</span>
                        </div>
                    </div>
                    <a href="{{ route('contact') }}" class="group inline-flex items-center gap-2 rounded-full bg-cyan-600 px-6 py-3 text-base font-medium text-white transition-all hover:bg-cyan-700 hover:shadow-lg" style="box-shadow: 0 1px 2px rgba(0,0,0,0.05);">
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
                <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-cyan-600">Kezdje el</p>
                <h2 class="mb-4 text-3xl text-text-primary md:text-4xl" style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                    Készen áll a valós idejű ipari irányítópultokra?
                </h2>
                <p class="mx-auto max-w-xl text-lg text-text-secondary">
                    Válassza ki a következő lépést az Ön számára.
                </p>
            </div>

            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2" data-stagger>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-8 text-center" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <h3 class="mb-3 text-xl font-bold text-text-primary">Dashboard konzultáció</h3>
                    <p class="mb-6 text-sm text-text-secondary">Kérdezzen szakértőinktől 30 percben — videóhíváson, az Ön KPI-jaira és riportjaira szabva, kötelezettség nélkül.</p>
                    <a href="{{ route('contact') }}" class="inline-flex items-center gap-2 rounded-full border border-border-light bg-surface-secondary px-6 py-3 text-sm font-medium text-text-primary transition-all hover:border-cyan-200 hover:shadow-md">
                        Időpont foglalása <svg class="arrow-slide h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" /></svg>
                    </a>
                </div>
                <div class="stagger-item card-glow rounded-2xl border border-cyan-100 bg-cyan-50 p-8 text-center" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <h3 class="mb-3 text-xl font-bold text-text-primary">Regisztráció és kipróbálás</h3>
                    <p class="mb-6 text-sm text-text-secondary">Fedezze fel a dashboardokat, a widget-könyvtárat és a valós idejű KPI-kat — azonnal, a teljes modulkészlettel.</p>
                    <a href="{{ route('register') }}" class="group inline-flex items-center gap-2 rounded-full bg-cyan-600 px-6 py-3 text-sm font-medium text-white transition-all hover:bg-cyan-700 hover:shadow-lg" style="box-shadow: 0 1px 2px rgba(0,0,0,0.05);">
                        Regisztráció <svg class="arrow-slide h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" /></svg>
                    </a>
                </div>
            </div>
        </div>
    </section>
</div>
