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

        @keyframes crown-pulse { 0%, 100% { opacity: 1; } 50% { opacity: 0.5; } }
        .crown-pulse { animation: crown-pulse 2s ease infinite; }

        /* Module health bar animation */
        @keyframes mod-grow {
            from { transform: scaleX(0); transform-origin: left; }
            to { transform: scaleX(1); transform-origin: left; }
        }
        .mod-bar { animation: mod-grow 0.8s cubic-bezier(0, 0, 0.2, 1) both; }

        .pill-float { transition: transform 0.35s cubic-bezier(0,0,0.2,1), box-shadow 0.35s cubic-bezier(0,0,0.2,1); }
        .pill-float:hover { transform: translateY(-3px); box-shadow: 0 6px 20px -4px rgba(139, 92, 246, 0.12); }

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
                        <span class="pulse-dot h-1.5 w-1.5 rounded-full bg-linear-to-r from-violet-500 via-amber-500 to-yellow-500"></span>
                        <span class="text-sm font-medium text-text-primary">Vezetői döntéstámogatás ipari vállalatoknak</span>
                    </div>

                    <h1 class="mb-6 text-4xl leading-tight tracking-tight text-text-primary md:text-5xl lg:text-[3.5rem]"
                        style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                        Az egész vállalat — egyetlen<br>
                        irányítópulton, minden reggel
                    </h1>

                    <p class="mb-10 max-w-xl text-lg text-text-secondary lg:text-xl">
                        Az ipari cégvezetőknek nem több adatra van szükségük — hanem jobb áttekintésre. A Cégem360 mind a 11 modul adatát egyetlen vezetői dashboardba sűríti: bevétel, gyártás, szerviz, beszerzés, marketing — MI összefoglalóval, minden reggel.
                    </p>

                    <div class="flex flex-wrap items-center gap-4">
                        <a href="{{ route('contact') }}"
                            class="group inline-flex items-center gap-2 rounded-full bg-violet-600 px-6 py-3 text-base font-medium text-white transition-all hover:bg-violet-700 hover:shadow-lg"
                            style="box-shadow: 0 1px 2px rgba(0,0,0,0.05);">
                            <span>Online konzultáció</span>
                            <svg class="arrow-slide h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" /></svg>
                        </a>
                        <a href="#megoldasok"
                            class="inline-flex items-center gap-2 rounded-full border border-border-light bg-surface-primary px-6 py-3 text-base font-medium text-text-primary transition-all hover:border-violet-200 hover:bg-surface-secondary hover:shadow-md">
                            Megoldások áttekintése
                        </a>
                    </div>
                </div>

                {{-- CEO Command Center Visual --}}
                <div class="reveal-right">
                    <div class="rounded-2xl border border-border-light bg-surface-primary p-6"
                        style="box-shadow: 0 4px 20px -4px rgba(0,0,0,0.06);">
                        <div class="mb-4 flex items-center justify-between border-b border-border-light pb-4">
                            <div>
                                <span class="block text-sm font-bold text-text-primary">Vezetői irányítóközpont</span>
                                <span class="block text-[10px] text-text-tertiary">Teljes vállalati áttekintés · Valós idejű</span>
                            </div>
                            <span class="inline-flex items-center gap-1.5 rounded-md border border-amber-100 bg-linear-to-r from-amber-50 to-violet-50 px-2.5 py-1 text-[10px] font-semibold text-amber-600">
                                <span class="crown-pulse">★</span>
                                CEO Dashboard
                            </span>
                        </div>

                        {{-- KPI Cards Row 1: 3 items --}}
                        <div class="mb-2 grid grid-cols-3 gap-2">
                            <div class="rounded-lg border border-border-light bg-surface-secondary p-2 text-center">
                                <span class="block text-lg font-bold text-success-600" style="font-family: 'JetBrains Mono', monospace;">248M</span>
                                <span class="block text-[9px] font-semibold uppercase tracking-wider text-text-tertiary">Árbevétel</span>
                                <span class="block text-[9px] font-semibold text-success-600">▲ +12%</span>
                            </div>
                            <div class="rounded-lg border border-border-light bg-surface-secondary p-2 text-center">
                                <span class="block text-lg font-bold text-violet-600" style="font-family: 'JetBrains Mono', monospace;">16.6%</span>
                                <span class="block text-[9px] font-semibold uppercase tracking-wider text-text-tertiary">EBITDA margin</span>
                                <span class="block text-[9px] font-semibold text-success-600">▲ +2.1pp</span>
                            </div>
                            <div class="rounded-lg border border-border-light bg-surface-secondary p-2 text-center">
                                <span class="block text-lg font-bold text-amber-600" style="font-family: 'JetBrains Mono', monospace;">78%</span>
                                <span class="block text-[9px] font-semibold uppercase tracking-wider text-text-tertiary">OEE</span>
                                <span class="block text-[9px] font-semibold text-success-600">▲ +5%</span>
                            </div>
                        </div>

                        {{-- KPI Cards Row 2: 2 items --}}
                        <div class="mb-4 grid grid-cols-2 gap-2">
                            <div class="rounded-lg border border-border-light bg-surface-secondary p-2 text-center">
                                <span class="block text-lg font-bold text-blue-600" style="font-family: 'JetBrains Mono', monospace;">94%</span>
                                <span class="block text-[9px] font-semibold uppercase tracking-wider text-text-tertiary">CSAT</span>
                                <span class="block text-[9px] font-semibold text-success-600">▲ +3%</span>
                            </div>
                            <div class="rounded-lg border border-border-light bg-surface-secondary p-2 text-center">
                                <span class="block text-lg font-bold text-success-600" style="font-family: 'JetBrains Mono', monospace;">32M</span>
                                <span class="block text-[9px] font-semibold uppercase tracking-wider text-text-tertiary">Pipeline érték</span>
                                <span class="block text-[9px] font-semibold text-success-600">▲ +18%</span>
                            </div>
                        </div>

                        {{-- Module Health Bars --}}
                        <div class="mb-4 space-y-2">
                            <div>
                                <div class="mb-0.5 flex items-center justify-between">
                                    <span class="text-[10px] font-bold uppercase tracking-wider text-text-tertiary">Értékesítés</span>
                                    <span class="text-[10px] font-bold text-text-tertiary" style="font-family: 'JetBrains Mono', monospace;">92%</span>
                                </div>
                                <div class="h-3 w-full rounded bg-surface-secondary">
                                    <div class="mod-bar h-3 rounded bg-success-400" style="width: 92%; animation-delay: 0.1s;"></div>
                                </div>
                            </div>
                            <div>
                                <div class="mb-0.5 flex items-center justify-between">
                                    <span class="text-[10px] font-bold uppercase tracking-wider text-text-tertiary">Gyártás</span>
                                    <span class="text-[10px] font-bold text-text-tertiary" style="font-family: 'JetBrains Mono', monospace;">78%</span>
                                </div>
                                <div class="h-3 w-full rounded bg-surface-secondary">
                                    <div class="mod-bar h-3 rounded bg-violet-400" style="width: 78%; animation-delay: 0.2s;"></div>
                                </div>
                            </div>
                            <div>
                                <div class="mb-0.5 flex items-center justify-between">
                                    <span class="text-[10px] font-bold uppercase tracking-wider text-text-tertiary">Beszerzés</span>
                                    <span class="text-[10px] font-bold text-text-tertiary" style="font-family: 'JetBrains Mono', monospace;">85%</span>
                                </div>
                                <div class="h-3 w-full rounded bg-surface-secondary">
                                    <div class="mod-bar h-3 rounded bg-amber-400" style="width: 85%; animation-delay: 0.3s;"></div>
                                </div>
                            </div>
                            <div>
                                <div class="mb-0.5 flex items-center justify-between">
                                    <span class="text-[10px] font-bold uppercase tracking-wider text-text-tertiary">Szerviz</span>
                                    <span class="text-[10px] font-bold text-text-tertiary" style="font-family: 'JetBrains Mono', monospace;">64%</span>
                                </div>
                                <div class="h-3 w-full rounded bg-surface-secondary">
                                    <div class="mod-bar h-3 rounded bg-orange-400" style="width: 64%; animation-delay: 0.4s;"></div>
                                </div>
                            </div>
                        </div>

                        {{-- AI Insight --}}
                        <div class="mb-4 rounded-lg border border-violet-100 bg-linear-to-r from-violet-50 to-amber-50 p-3">
                            <div class="mb-2 flex items-center gap-2">
                                <div class="flex h-6 w-6 items-center justify-center rounded-md bg-linear-to-br from-violet-500 to-amber-500 text-[9px] font-bold text-white">AI</div>
                                <span class="text-xs font-bold text-violet-600">DataMind — Reggeli összefoglaló</span>
                            </div>
                            <p class="text-[11px] leading-relaxed text-text-secondary">
                                A Q1 árbevétel <strong class="text-amber-600">12%-kal meghaladja a tervet</strong>. Figyelem: a szerviz SLA-teljesítés 64%-ra csökkent — javaslom a kapacitásbővítés vizsgálatát. A DataMind predikció szerint a <strong class="text-amber-600">cash flow márciusban szűkülhet</strong> a nagyprojekt beszerzései miatt.
                            </p>
                        </div>

                        {{-- Alert Rows --}}
                        <div class="space-y-1">
                            <div class="flex items-center justify-between rounded-lg bg-surface-secondary px-3 py-1.5">
                                <div class="flex items-center gap-2">
                                    <span class="h-1.5 w-1.5 rounded-full bg-success-500"></span>
                                    <span class="text-[11px] text-text-secondary">Új keretszerződés aláírva: TechBuild Kft. — 18M Ft/év</span>
                                </div>
                                <span class="text-[10px] text-text-tertiary" style="font-family: 'JetBrains Mono', monospace;">2 óra</span>
                            </div>
                            <div class="flex items-center justify-between rounded-lg bg-surface-secondary px-3 py-1.5">
                                <div class="flex items-center gap-2">
                                    <span class="h-1.5 w-1.5 rounded-full bg-amber-500"></span>
                                    <span class="text-[11px] text-text-secondary">Csarnok bővítés projekt: 8%-os költségtúllépés</span>
                                </div>
                                <span class="text-[10px] text-text-tertiary" style="font-family: 'JetBrains Mono', monospace;">4 óra</span>
                            </div>
                            <div class="flex items-center justify-between rounded-lg bg-surface-secondary px-3 py-1.5">
                                <div class="flex items-center gap-2">
                                    <span class="h-1.5 w-1.5 rounded-full bg-danger-500"></span>
                                    <span class="text-[11px] text-text-secondary">Kritikus készletszint: tömítéskészlet — auto. rendelés</span>
                                </div>
                                <span class="text-[10px] text-text-tertiary" style="font-family: 'JetBrains Mono', monospace;">6 óra</span>
                            </div>
                        </div>

                        {{-- Status bar --}}
                        <div class="mt-3 flex gap-5 border-t border-border-light pt-3">
                            <span class="flex items-center gap-1.5 text-[10px] text-text-tertiary">
                                <span class="h-1.5 w-1.5 rounded-full bg-violet-500"></span> 11 modul aktív
                            </span>
                            <span class="flex items-center gap-1.5 text-[10px] text-text-tertiary">
                                <span class="h-1.5 w-1.5 rounded-full bg-success-500"></span> Frissítés: 2 perce
                            </span>
                            <span class="flex items-center gap-1.5 text-[10px] text-text-tertiary">
                                <span class="h-1.5 w-1.5 rounded-full bg-amber-500"></span> 3 MI javaslat
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Pain Points Section --}}
    <section class="bg-surface-primary py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-6">
            <div class="reveal mb-12">
                <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-violet-600">A kihívás</p>
                <h2 class="mb-4 text-3xl text-text-primary md:text-4xl" style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                    Ezek akadályozzák a stratégiai cégvezetést
                </h2>
                <p class="max-w-xl text-lg text-text-secondary">
                    Ismerős helyzetek ipari cégek ügyvezetőinek és tulajdonosainak.
                </p>
            </div>

            <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4" data-stagger>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-7" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="icon-hover mb-5 flex h-12 w-12 items-center justify-center rounded-xl bg-danger-50">
                        <svg class="h-6 w-6 text-danger-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                    </div>
                    <h3 class="mb-2 text-lg font-bold text-text-primary">Nincs valós idejű áttekintés</h3>
                    <p class="text-sm leading-relaxed text-text-secondary">A cégvezető a hónap végi zárásból tudja meg, mi történt. A napi döntésekhez szükséges adatok szétszórtan, késve, különböző formátumokban érkeznek.</p>
                </div>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-7" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="icon-hover mb-5 flex h-12 w-12 items-center justify-center rounded-xl bg-warning-50">
                        <svg class="h-6 w-6 text-warning-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4" /></svg>
                    </div>
                    <h3 class="mb-2 text-lg font-bold text-text-primary">Adatsilók és rendszersziget-ek</h3>
                    <p class="text-sm leading-relaxed text-text-secondary">Az értékesítés más rendszert használ, mint a gyártás, a pénzügy megint másikat. A cégvezető nem lát összefüggéseket — mert az adatok nem beszélnek egymással.</p>
                </div>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-7" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="icon-hover mb-5 flex h-12 w-12 items-center justify-center rounded-xl bg-violet-50">
                        <svg class="h-6 w-6 text-violet-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    </div>
                    <h3 class="mb-2 text-lg font-bold text-text-primary">Döntés megérzés alapján</h3>
                    <p class="text-sm leading-relaxed text-text-secondary">Nincs prediktív modell, nincs MI-alapú javaslat. A stratégiai döntések tapasztalatra és megérzésre épülnek — nem adatvezérelt elemzésre.</p>
                </div>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-7" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="icon-hover mb-5 flex h-12 w-12 items-center justify-center rounded-xl bg-amber-50">
                        <svg class="h-6 w-6 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                    </div>
                    <h3 class="mb-2 text-lg font-bold text-text-primary">Heti menedzsment-riport: kézi összesítés</h3>
                    <p class="text-sm leading-relaxed text-text-secondary">A vezetői értekezlet előtt mindenki saját Excelt hoz. A számok nem egyeznek, a riport-készítés napokat vesz igénybe — és akkor sem teljes.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Target Audience Section --}}
    <section class="bg-surface-secondary py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-6">
            <div class="reveal mb-12">
                <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-violet-600">Ki használja?</p>
                <h2 class="mb-4 text-3xl text-text-primary md:text-4xl" style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                    A teljes vezetői szint — egyetlen igazságforrásból
                </h2>
                <p class="max-w-xl text-lg text-text-secondary">
                    A Cégem360 a vezetői döntéshozatal minden szintjén releváns, valós idejű adatot ad.
                </p>
            </div>

            <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4" data-stagger>
                <div class="stagger-item card-glow group relative overflow-hidden rounded-2xl border border-border-light bg-surface-primary p-7" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="absolute inset-x-0 top-0 h-0.5 bg-linear-to-r from-transparent via-violet-400 to-transparent opacity-0 transition-opacity group-hover:opacity-100"></div>
                    <span class="mb-3 block text-3xl">👔</span>
                    <span class="mb-2 block text-[10px] font-semibold uppercase tracking-wider text-violet-600">Ügyvezető / Tulajdonos</span>
                    <h3 class="mb-2 text-base font-bold text-text-primary">Ügyvezetők és cégtulajdonosok</h3>
                    <p class="text-sm leading-relaxed text-text-secondary">Egyperces reggeli összefoglaló: bevétel, profit, projektek, kockázatok, MI javaslatok — egy pillantásra, minden nap.</p>
                </div>
                <div class="stagger-item card-glow group relative overflow-hidden rounded-2xl border border-border-light bg-surface-primary p-7" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="absolute inset-x-0 top-0 h-0.5 bg-linear-to-r from-transparent via-violet-400 to-transparent opacity-0 transition-opacity group-hover:opacity-100"></div>
                    <span class="mb-3 block text-3xl">💼</span>
                    <span class="mb-2 block text-[10px] font-semibold uppercase tracking-wider text-violet-600">Pénzügyi igazgató</span>
                    <h3 class="mb-2 text-base font-bold text-text-primary">CFO-k és pénzügyi igazgatók</h3>
                    <p class="text-sm leading-relaxed text-text-secondary">Cash flow előrejelzés, projekt-jövedelmezőség, költségkontroll és automatikus vezetői riportok — valós időben.</p>
                </div>
                <div class="stagger-item card-glow group relative overflow-hidden rounded-2xl border border-border-light bg-surface-primary p-7" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="absolute inset-x-0 top-0 h-0.5 bg-linear-to-r from-transparent via-violet-400 to-transparent opacity-0 transition-opacity group-hover:opacity-100"></div>
                    <span class="mb-3 block text-3xl">📊</span>
                    <span class="mb-2 block text-[10px] font-semibold uppercase tracking-wider text-violet-600">Kereskedelmi igazgató</span>
                    <h3 class="mb-2 text-base font-bold text-text-primary">Kereskedelmi és értékesítési igazgatók</h3>
                    <p class="text-sm leading-relaxed text-text-secondary">Pipeline-érték, konverziós arányok, ügyfélelégedettség és bevétel-előrejelzés — az értékesítési stratégia adatvezérelt alapja.</p>
                </div>
                <div class="stagger-item card-glow group relative overflow-hidden rounded-2xl border border-border-light bg-surface-primary p-7" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="absolute inset-x-0 top-0 h-0.5 bg-linear-to-r from-transparent via-violet-400 to-transparent opacity-0 transition-opacity group-hover:opacity-100"></div>
                    <span class="mb-3 block text-3xl">⚙️</span>
                    <span class="mb-2 block text-[10px] font-semibold uppercase tracking-wider text-violet-600">Műszaki igazgató</span>
                    <h3 class="mb-2 text-base font-bold text-text-primary">Műszaki és termelési igazgatók</h3>
                    <p class="text-sm leading-relaxed text-text-secondary">OEE, kapacitáskihasználtság, szerviz-teljesítmény és beszerzési státusz — a teljes operáció egyetlen dashboardon.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Core Toolkit Section --}}
    <section class="bg-surface-primary py-16 lg:py-24" id="megoldasok">
        <div class="mx-auto max-w-7xl px-6">
            <div class="reveal mb-12">
                <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-violet-600">Vezetői eszköztár</p>
                <h2 class="mb-4 text-3xl text-text-primary md:text-4xl" style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                    4 kulcsmodul a stratégiai döntéstámogatáshoz
                </h2>
                <p class="max-w-xl text-lg text-text-secondary">
                    Ezek a modulok együttesen adják a Cégem360 vezetői intelligencia rétegét.
                </p>
            </div>

            <div class="grid grid-cols-1 gap-6 md:grid-cols-2" data-stagger>
                {{-- Kontrolling --}}
                <div class="stagger-item card-glow group rounded-2xl border border-border-light bg-surface-primary p-8" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="mb-5 flex items-center gap-4">
                        <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-violet-50">
                            <x-module-icon module="kontrolling" class="h-5 w-5 text-violet-600" />
                        </div>
                        <div>
                            <span class="block text-sm font-bold text-text-primary">Kontrolling</span>
                            <span class="text-xs text-text-tertiary">Teljes pénzügyi áttekintés</span>
                        </div>
                    </div>
                    <h3 class="mb-3 text-lg font-bold text-text-primary">Vezetői pénzügyi dashboard — egyetlen pillantásra</h3>
                    <p class="mb-5 text-sm leading-relaxed text-text-secondary">Bevétel, költség, EBITDA, cash flow, projekt-jövedelmezőség — valós időben, automatikus riportokkal. A terv vs. tény elemzés mutatja, hol tart a cég a célokhoz képest.</p>
                    <div class="mb-5 grid grid-cols-2 gap-2">
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><span class="feature-dot h-1 w-1 rounded-full bg-violet-400"></span>Valós idejű P&L</span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><span class="feature-dot h-1 w-1 rounded-full bg-violet-400"></span>Cash flow előrejelzés</span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><span class="feature-dot h-1 w-1 rounded-full bg-violet-400"></span>Terv vs. tény</span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><span class="feature-dot h-1 w-1 rounded-full bg-violet-400"></span>Projekt-portfólió P&L</span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><span class="feature-dot h-1 w-1 rounded-full bg-violet-400"></span>Automatikus riportok</span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><span class="feature-dot h-1 w-1 rounded-full bg-violet-400"></span>Ütemezett PDF küldés</span>
                    </div>
                    <a href="{{ route('products.kontrolling') }}" class="inline-flex items-center gap-1.5 text-sm font-semibold text-violet-600 transition-colors hover:text-violet-700">
                        Részletek megtekintése <svg class="arrow-slide h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" /></svg>
                    </a>
                </div>

                {{-- DataMind --}}
                <div class="stagger-item card-glow group rounded-2xl border border-border-light bg-surface-primary p-8" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="mb-5 flex items-center gap-4">
                        <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-amber-50">
                            <x-module-icon module="datamind" class="h-5 w-5 text-amber-600" />
                        </div>
                        <div>
                            <span class="block text-sm font-bold text-text-primary">DataMind</span>
                            <span class="text-xs text-text-tertiary">MI stratégiai tanácsadó</span>
                        </div>
                    </div>
                    <h3 class="mb-3 text-lg font-bold text-text-primary">MI összefoglalók, predikciók és stratégiai javaslatok</h3>
                    <p class="mb-5 text-sm leading-relaxed text-text-secondary">A DataMind minden reggel összefoglalja a legfontosabb változásokat, azonosítja a kockázatokat, prediktálja a trendeket — és magyar nyelvű, érthető javaslatokat ad a következő lépésekre.</p>
                    <div class="mb-5 grid grid-cols-2 gap-2">
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><span class="feature-dot h-1 w-1 rounded-full bg-amber-400"></span>Reggeli MI összefoglaló</span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><span class="feature-dot h-1 w-1 rounded-full bg-amber-400"></span>Kockázat-azonosítás</span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><span class="feature-dot h-1 w-1 rounded-full bg-amber-400"></span>Trend-előrejelzés</span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><span class="feature-dot h-1 w-1 rounded-full bg-amber-400"></span>Stratégiai javaslatok</span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><span class="feature-dot h-1 w-1 rounded-full bg-amber-400"></span>Anomália-detektálás</span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><span class="feature-dot h-1 w-1 rounded-full bg-amber-400"></span>Iparági benchmark</span>
                    </div>
                    <a href="{{ route('products.datamind') }}" class="inline-flex items-center gap-1.5 text-sm font-semibold text-amber-600 transition-colors hover:text-amber-700">
                        Részletek megtekintése <svg class="arrow-slide h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" /></svg>
                    </a>
                </div>

                {{-- CRM --}}
                <div class="stagger-item card-glow group rounded-2xl border border-border-light bg-surface-primary p-8" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="mb-5 flex items-center gap-4">
                        <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-success-50">
                            <x-module-icon module="crm" class="h-5 w-5 text-success-600" />
                        </div>
                        <div>
                            <span class="block text-sm font-bold text-text-primary">CRM</span>
                            <span class="text-xs text-text-tertiary">Ügyfélportfólió áttekintés</span>
                        </div>
                    </div>
                    <h3 class="mb-3 text-lg font-bold text-text-primary">Ügyfélportfólió, pipeline-érték és megtartási ráták</h3>
                    <p class="mb-5 text-sm leading-relaxed text-text-secondary">A cégvezető egyetlen felületen látja: mennyi a pipeline-érték, melyik ügyfelek a legnyereségesebbek, hol van churn-kockázat, és honnan jönnek az új lead-ek.</p>
                    <div class="mb-5 grid grid-cols-2 gap-2">
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><span class="feature-dot h-1 w-1 rounded-full bg-success-400"></span>Pipeline-érték áttekintés</span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><span class="feature-dot h-1 w-1 rounded-full bg-success-400"></span>Top ügyfél profitabilitás</span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><span class="feature-dot h-1 w-1 rounded-full bg-success-400"></span>Churn-kockázat jelzés</span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><span class="feature-dot h-1 w-1 rounded-full bg-success-400"></span>Lead-forrás elemzés</span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><span class="feature-dot h-1 w-1 rounded-full bg-success-400"></span>NPS/CSAT trendek</span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><span class="feature-dot h-1 w-1 rounded-full bg-success-400"></span>Értékesítői ranking</span>
                    </div>
                    <a href="{{ route('products.crm') }}" class="inline-flex items-center gap-1.5 text-sm font-semibold text-success-600 transition-colors hover:text-success-700">
                        Részletek megtekintése <svg class="arrow-slide h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" /></svg>
                    </a>
                </div>

                {{-- MarketingHub --}}
                <div class="stagger-item card-glow group rounded-2xl border border-border-light bg-surface-primary p-8" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="mb-5 flex items-center gap-4">
                        <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-blue-50">
                            <x-module-icon module="marketinghub" class="h-5 w-5 text-blue-600" />
                        </div>
                        <div>
                            <span class="block text-sm font-bold text-text-primary">MarketingHub</span>
                            <span class="text-xs text-text-tertiary">Marketing ROI és hatékonyság</span>
                        </div>
                    </div>
                    <h3 class="mb-3 text-lg font-bold text-text-primary">Marketing ROI, kampányhatékonyság és brand health</h3>
                    <p class="mb-5 text-sm leading-relaxed text-text-secondary">Mennyit költ a cég marketingre, és mennyit hoz vissza? Melyik csatorna hozza a legtöbb lead-et, és mennyiért? A cégvezető adatvezérelten dönthet a marketing büdzséről.</p>
                    <div class="mb-5 grid grid-cols-2 gap-2">
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><span class="feature-dot h-1 w-1 rounded-full bg-blue-400"></span>Marketing ROI összesítő</span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><span class="feature-dot h-1 w-1 rounded-full bg-blue-400"></span>Csatorna-hatékonyság</span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><span class="feature-dot h-1 w-1 rounded-full bg-blue-400"></span>Költség/lead metrika</span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><span class="feature-dot h-1 w-1 rounded-full bg-blue-400"></span>Organikus vs. fizetett</span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><span class="feature-dot h-1 w-1 rounded-full bg-blue-400"></span>Brand-ismertség trendek</span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><span class="feature-dot h-1 w-1 rounded-full bg-blue-400"></span>Kampány-összehasonlítás</span>
                    </div>
                    <a href="{{ route('products.marketinghub') }}" class="inline-flex items-center gap-1.5 text-sm font-semibold text-blue-600 transition-colors hover:text-blue-700">
                        Részletek megtekintése <svg class="arrow-slide h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" /></svg>
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{-- Ecosystem Section — All 11 Modules --}}
    <section class="bg-surface-secondary py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-6">
            <div class="reveal mb-12 text-center">
                <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-violet-600">Teljes ökoszisztéma</p>
                <h2 class="mb-4 text-3xl text-text-primary md:text-4xl" style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                    Mind a 11 modul — a cégvezető irányítópultján
                </h2>
                <p class="mx-auto max-w-2xl text-lg text-text-secondary">
                    A Cégem360 egyedülálló ereje, hogy a vezetői dashboard nem egy modul — hanem mind a 11 modul összessége. Minden üzleti tevékenység valós idejű lenyomata egyetlen felületen.
                </p>
            </div>

            <div class="grid grid-cols-2 gap-4 sm:grid-cols-3 lg:grid-cols-4" data-stagger>
                <div class="stagger-item pill-float rounded-xl border border-border-light bg-surface-primary p-4 text-center" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="mx-auto mb-3 flex h-10 w-10 items-center justify-center rounded-lg bg-violet-50">
                        <x-module-icon module="kontrolling" class="h-5 w-5 text-violet-600" />
                    </div>
                    <h4 class="mb-1 text-xs font-bold text-text-primary">Kontrolling</h4>
                    <p class="text-[10px] leading-snug text-text-tertiary">P&L, cash flow, terv vs. tény</p>
                </div>
                <div class="stagger-item pill-float rounded-xl border border-border-light bg-surface-primary p-4 text-center" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="mx-auto mb-3 flex h-10 w-10 items-center justify-center rounded-lg bg-success-50">
                        <x-module-icon module="crm" class="h-5 w-5 text-success-600" />
                    </div>
                    <h4 class="mb-1 text-xs font-bold text-text-primary">CRM</h4>
                    <p class="text-[10px] leading-snug text-text-tertiary">Ügyféladatok, pipeline, NPS</p>
                </div>
                <div class="stagger-item pill-float rounded-xl border border-border-light bg-surface-primary p-4 text-center" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="mx-auto mb-3 flex h-10 w-10 items-center justify-center rounded-lg bg-blue-50">
                        <x-module-icon module="ertekesites" class="h-5 w-5 text-blue-600" />
                    </div>
                    <h4 class="mb-1 text-xs font-bold text-text-primary">Értékesítés</h4>
                    <p class="text-[10px] leading-snug text-text-tertiary">Ajánlat, rendelés, bevétel</p>
                </div>
                <div class="stagger-item pill-float rounded-xl border border-border-light bg-surface-primary p-4 text-center" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="mx-auto mb-3 flex h-10 w-10 items-center justify-center rounded-lg bg-cyan-50">
                        <x-module-icon module="beszerzes" class="h-5 w-5 text-cyan-600" />
                    </div>
                    <h4 class="mb-1 text-xs font-bold text-text-primary">Beszerzés</h4>
                    <p class="text-[10px] leading-snug text-text-tertiary">Készlet, szállítók, rendelés</p>
                </div>
                <div class="stagger-item pill-float rounded-xl border border-border-light bg-surface-primary p-4 text-center" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="mx-auto mb-3 flex h-10 w-10 items-center justify-center rounded-lg bg-orange-50">
                        <x-module-icon module="gyartas" class="h-5 w-5 text-orange-600" />
                    </div>
                    <h4 class="mb-1 text-xs font-bold text-text-primary">Gyártásirányítás</h4>
                    <p class="text-[10px] leading-snug text-text-tertiary">OEE, kapacitás, minőség</p>
                </div>
                <div class="stagger-item pill-float rounded-xl border border-border-light bg-surface-primary p-4 text-center" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="mx-auto mb-3 flex h-10 w-10 items-center justify-center rounded-lg bg-amber-50">
                        <x-module-icon module="automatizalas" class="h-5 w-5 text-amber-600" />
                    </div>
                    <h4 class="mb-1 text-xs font-bold text-text-primary">Automatizálás</h4>
                    <p class="text-[10px] leading-snug text-text-tertiary">Workflow-k, triggerek, riasztások</p>
                </div>
                <div class="stagger-item pill-float rounded-xl border border-border-light bg-surface-primary p-4 text-center" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="mx-auto mb-3 flex h-10 w-10 items-center justify-center rounded-lg bg-rose-50">
                        <x-module-icon module="szerviz" class="h-5 w-5 text-rose-600" />
                    </div>
                    <h4 class="mb-1 text-xs font-bold text-text-primary">Digitális munkalap</h4>
                    <p class="text-[10px] leading-snug text-text-tertiary">Helyszíni adat, fotó, aláírás</p>
                </div>
                <div class="stagger-item pill-float rounded-xl border border-border-light bg-surface-primary p-4 text-center" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="mx-auto mb-3 flex h-10 w-10 items-center justify-center rounded-lg bg-teal-50">
                        <x-module-icon module="seo" class="h-5 w-5 text-teal-600" />
                    </div>
                    <h4 class="mb-1 text-xs font-bold text-text-primary">SEO Eszköz</h4>
                    <p class="text-[10px] leading-snug text-text-tertiary">Organikus forgalom, rangsor</p>
                </div>
                <div class="stagger-item pill-float rounded-xl border border-border-light bg-surface-primary p-4 text-center" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="mx-auto mb-3 flex h-10 w-10 items-center justify-center rounded-lg bg-yellow-50">
                        <x-module-icon module="marketinghub" class="h-5 w-5 text-yellow-600" />
                    </div>
                    <h4 class="mb-1 text-xs font-bold text-text-primary">MarketingHub</h4>
                    <p class="text-[10px] leading-snug text-text-tertiary">Kampányok, ROI, szegmensek</p>
                </div>
                <div class="stagger-item pill-float rounded-xl border border-border-light bg-surface-primary p-4 text-center" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="mx-auto mb-3 flex h-10 w-10 items-center justify-center rounded-lg bg-indigo-50">
                        <x-module-icon module="datamind" class="h-5 w-5 text-indigo-600" />
                    </div>
                    <h4 class="mb-1 text-xs font-bold text-text-primary">DataMind</h4>
                    <p class="text-[10px] leading-snug text-text-tertiary">MI predikció, összefoglalók</p>
                </div>
                <div class="stagger-item pill-float rounded-xl border border-border-light bg-surface-primary p-4 text-center" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="mx-auto mb-3 flex h-10 w-10 items-center justify-center rounded-lg bg-pink-50">
                        <x-module-icon module="ai-chat" class="h-5 w-5 text-pink-600" />
                    </div>
                    <h4 class="mb-1 text-xs font-bold text-text-primary">AI Chat</h4>
                    <p class="text-[10px] leading-snug text-text-tertiary">0-24 ügyfélszolgálat, lead</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Decision Flow Section --}}
    <section class="bg-surface-primary py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-6">
            <div class="reveal mb-12">
                <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-violet-600">Döntési ciklus</p>
                <h2 class="mb-4 text-3xl text-text-primary md:text-4xl" style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                    Adatvezérelt vezetés — napi szinten
                </h2>
                <p class="max-w-xl text-lg text-text-secondary">
                    Így néz ki egy cégvezető napja a Cégem360-nal.
                </p>
            </div>

            <div class="grid grid-cols-2 gap-5 sm:grid-cols-3 lg:grid-cols-5" data-stagger>
                <div class="stagger-item text-center">
                    <div class="mx-auto mb-4 flex h-16 w-16 items-center justify-center rounded-full border-2 border-violet-200 bg-surface-primary text-xl font-bold text-violet-600">01</div>
                    <h4 class="mb-1 text-sm font-bold text-text-primary">Reggeli összefoglaló</h4>
                    <p class="mb-2 text-xs text-text-tertiary">MI összefoglaló: kulcs KPI-k, változások, kockázatok, javaslatok</p>
                    <div class="flex flex-wrap justify-center gap-1">
                        <span class="rounded bg-violet-50 px-1.5 py-0.5 text-[9px] font-semibold text-violet-600">DataMind</span>
                    </div>
                </div>
                <div class="stagger-item text-center">
                    <div class="mx-auto mb-4 flex h-16 w-16 items-center justify-center rounded-full border-2 border-amber-200 bg-surface-primary text-xl font-bold text-amber-600">02</div>
                    <h4 class="mb-1 text-sm font-bold text-text-primary">Dashboard áttekintés</h4>
                    <p class="mb-2 text-xs text-text-tertiary">Minden szegmens egy pillantásra: pénzügy, értékesítés, gyártás, szerviz</p>
                    <div class="flex flex-wrap justify-center gap-1">
                        <span class="rounded bg-amber-50 px-1.5 py-0.5 text-[9px] font-semibold text-amber-600">Kontrolling</span>
                        <span class="rounded bg-amber-50 px-1.5 py-0.5 text-[9px] font-semibold text-amber-600">CRM</span>
                    </div>
                </div>
                <div class="stagger-item text-center">
                    <div class="mx-auto mb-4 flex h-16 w-16 items-center justify-center rounded-full border-2 border-blue-200 bg-surface-primary text-xl font-bold text-blue-600">03</div>
                    <h4 class="mb-1 text-sm font-bold text-text-primary">Fókusz-elemzés</h4>
                    <p class="mb-2 text-xs text-text-tertiary">Drilldown a kritikus pontokon: melyik projekt, ügyfél, gép, kampány igényel figyelmet</p>
                    <div class="flex flex-wrap justify-center gap-1">
                        <span class="rounded bg-blue-50 px-1.5 py-0.5 text-[9px] font-semibold text-blue-600">Összes modul</span>
                    </div>
                </div>
                <div class="stagger-item text-center">
                    <div class="mx-auto mb-4 flex h-16 w-16 items-center justify-center rounded-full border-2 border-success-200 bg-surface-primary text-xl font-bold text-success-600">04</div>
                    <h4 class="mb-1 text-sm font-bold text-text-primary">Döntéshozatal</h4>
                    <p class="mb-2 text-xs text-text-tertiary">MI-alapú javaslatok, szcenárió-modellezés és hatáselemzés</p>
                    <div class="flex flex-wrap justify-center gap-1">
                        <span class="rounded bg-success-50 px-1.5 py-0.5 text-[9px] font-semibold text-success-600">DataMind</span>
                        <span class="rounded bg-success-50 px-1.5 py-0.5 text-[9px] font-semibold text-success-600">Kontrolling</span>
                    </div>
                </div>
                <div class="stagger-item text-center">
                    <div class="mx-auto mb-4 flex h-16 w-16 items-center justify-center rounded-full border-2 border-orange-200 bg-surface-primary text-xl font-bold text-orange-600">05</div>
                    <h4 class="mb-1 text-sm font-bold text-text-primary">Végrehajtás-követés</h4>
                    <p class="mb-2 text-xs text-text-tertiary">Delegálás, feladat-kiosztás, automatikus visszacsatolás a döntés hatásáról</p>
                    <div class="flex flex-wrap justify-center gap-1">
                        <span class="rounded bg-orange-50 px-1.5 py-0.5 text-[9px] font-semibold text-orange-600">Automatizálás</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Stats Section --}}
    <section class="bg-surface-secondary py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-6">
            <div class="reveal mb-12 text-center">
                <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-violet-600">Eredmények</p>
                <h2 class="text-3xl text-text-primary md:text-4xl" style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                    Mérhető javulás a vezetői döntéshozatalban
                </h2>
            </div>

            <div class="grid grid-cols-2 gap-5 lg:grid-cols-4" data-stagger data-counter-trigger>
                <div class="stagger-item stat-hover rounded-2xl border border-border-light bg-surface-primary p-8 text-center" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <span class="stat-value block text-4xl font-bold text-violet-600 lg:text-5xl" style="font-family: 'JetBrains Mono', monospace;"
                        data-count="5" data-suffix="×">0×</span>
                    <span class="mt-2 block text-sm text-text-secondary">Gyorsabb döntéshozatal</span>
                </div>
                <div class="stagger-item stat-hover rounded-2xl border border-border-light bg-surface-primary p-8 text-center" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <span class="stat-value block text-4xl font-bold text-amber-600 lg:text-5xl" style="font-family: 'JetBrains Mono', monospace;"
                        data-count="100" data-suffix="%">0%</span>
                    <span class="mt-2 block text-sm text-text-secondary">Valós idejű vállalati áttekintés</span>
                </div>
                <div class="stagger-item stat-hover rounded-2xl border border-border-light bg-surface-primary p-8 text-center" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <span class="stat-value block text-4xl font-bold text-success-600 lg:text-5xl" style="font-family: 'JetBrains Mono', monospace;"
                        data-count="90" data-prefix="-" data-suffix="%">0%</span>
                    <span class="mt-2 block text-sm text-text-secondary">Riportkészítési idő</span>
                </div>
                <div class="stagger-item stat-hover rounded-2xl border border-border-light bg-surface-primary p-8 text-center" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <span class="stat-value block text-4xl font-bold text-blue-600 lg:text-5xl" style="font-family: 'JetBrains Mono', monospace;"
                        data-count="30" data-prefix="+" data-suffix="%">0%</span>
                    <span class="mt-2 block text-sm text-text-secondary">Stratégiai célok teljesülése</span>
                </div>
            </div>
        </div>
    </section>

    {{-- Use Cases Section --}}
    <section class="bg-surface-primary py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-6">
            <div class="reveal mb-12">
                <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-violet-600">Felhasználási esetek</p>
                <h2 class="mb-4 text-3xl text-text-primary md:text-4xl" style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                    Így használják ipari cégvezetők
                </h2>
            </div>

            <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3" data-stagger>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-7" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <span class="mb-4 block text-xs font-semibold text-text-tertiary" style="font-family: 'JetBrains Mono', monospace;">01</span>
                    <h3 class="mb-2 text-base font-bold text-text-primary">Reggeli MI összefoglaló és napi prioritások</h3>
                    <p class="mb-4 text-sm leading-relaxed text-text-secondary">A cégvezető minden reggel MI összefoglalót kap: mi változott tegnap, mire figyeljen ma, milyen kockázatok vannak. 2 perc olvasás — és tudja, mire fókuszáljon.</p>
                    <div class="flex flex-wrap gap-1.5">
                        <span class="rounded bg-violet-50 px-2 py-0.5 text-[10px] font-semibold text-violet-600">DataMind</span>
                        <span class="rounded bg-violet-50 px-2 py-0.5 text-[10px] font-semibold text-violet-600">Kontrolling</span>
                    </div>
                </div>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-7" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <span class="mb-4 block text-xs font-semibold text-text-tertiary" style="font-family: 'JetBrains Mono', monospace;">02</span>
                    <h3 class="mb-2 text-base font-bold text-text-primary">Projekt-portfólió jövedelmezőségi áttekintés</h3>
                    <p class="mb-4 text-sm leading-relaxed text-text-secondary">Melyik projekt hozza a pénzt, melyik viszi? A cégvezető valós időben látja mind a 15 futó projekt P&L-jét, a kritikusakat pirossal jelölve, MI javaslattal a beavatkozásra.</p>
                    <div class="flex flex-wrap gap-1.5">
                        <span class="rounded bg-violet-50 px-2 py-0.5 text-[10px] font-semibold text-violet-600">Kontrolling</span>
                        <span class="rounded bg-violet-50 px-2 py-0.5 text-[10px] font-semibold text-violet-600">Gyártásirányítás</span>
                        <span class="rounded bg-violet-50 px-2 py-0.5 text-[10px] font-semibold text-violet-600">DataMind</span>
                    </div>
                </div>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-7" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <span class="mb-4 block text-xs font-semibold text-text-tertiary" style="font-family: 'JetBrains Mono', monospace;">03</span>
                    <h3 class="mb-2 text-base font-bold text-text-primary">Stratégiai kapacitásdöntés MI predikcióval</h3>
                    <p class="mb-4 text-sm leading-relaxed text-text-secondary">A DataMind a pipeline-adatok és a szezonális minták alapján előrejelzi a kapacitásszükségletet 3–6 hónapra. A cégvezető adatvezérelten dönthet a bővítésről vagy a létszámtervezésről.</p>
                    <div class="flex flex-wrap gap-1.5">
                        <span class="rounded bg-violet-50 px-2 py-0.5 text-[10px] font-semibold text-violet-600">DataMind</span>
                        <span class="rounded bg-violet-50 px-2 py-0.5 text-[10px] font-semibold text-violet-600">CRM</span>
                        <span class="rounded bg-violet-50 px-2 py-0.5 text-[10px] font-semibold text-violet-600">Gyártásirányítás</span>
                    </div>
                </div>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-7" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <span class="mb-4 block text-xs font-semibold text-text-tertiary" style="font-family: 'JetBrains Mono', monospace;">04</span>
                    <h3 class="mb-2 text-base font-bold text-text-primary">Automatikus vezetői heti riport</h3>
                    <p class="mb-4 text-sm leading-relaxed text-text-secondary">A vezetői értekezletre nem kell kézi Excelt készíteni. A rendszer automatikusan generálja a heti riportot: KPI-k, változások, projektek, kockázatok — PDF-ben, minden hétfőn 8:00-ra.</p>
                    <div class="flex flex-wrap gap-1.5">
                        <span class="rounded bg-violet-50 px-2 py-0.5 text-[10px] font-semibold text-violet-600">Kontrolling</span>
                        <span class="rounded bg-violet-50 px-2 py-0.5 text-[10px] font-semibold text-violet-600">Automatizálás</span>
                    </div>
                </div>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-7" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <span class="mb-4 block text-xs font-semibold text-text-tertiary" style="font-family: 'JetBrains Mono', monospace;">05</span>
                    <h3 class="mb-2 text-base font-bold text-text-primary">Marketing–értékesítés–szerviz összefüggés-elemzés</h3>
                    <p class="mb-4 text-sm leading-relaxed text-text-secondary">Mennyibe kerül egy új ügyfél megszerzése? Mennyit hoz az életciklusa során? Honnan jönnek a legjövedelmezőbb ügyfelek? A cégvezető átlátja a teljes ügyfélérték-láncot.</p>
                    <div class="flex flex-wrap gap-1.5">
                        <span class="rounded bg-violet-50 px-2 py-0.5 text-[10px] font-semibold text-violet-600">MarketingHub</span>
                        <span class="rounded bg-violet-50 px-2 py-0.5 text-[10px] font-semibold text-violet-600">CRM</span>
                        <span class="rounded bg-violet-50 px-2 py-0.5 text-[10px] font-semibold text-violet-600">Kontrolling</span>
                    </div>
                </div>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-7" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <span class="mb-4 block text-xs font-semibold text-text-tertiary" style="font-family: 'JetBrains Mono', monospace;">06</span>
                    <h3 class="mb-2 text-base font-bold text-text-primary">Tulajdonosi riport és befektetői kommunikáció</h3>
                    <p class="mb-4 text-sm leading-relaxed text-text-secondary">A tulajdonosoknak vagy befektetőknek szóló riport automatikusan generálható: bevétel, profit, növekedés, piaci helyzet, előrejelzés — professzionális formában, percek alatt.</p>
                    <div class="flex flex-wrap gap-1.5">
                        <span class="rounded bg-violet-50 px-2 py-0.5 text-[10px] font-semibold text-violet-600">Kontrolling</span>
                        <span class="rounded bg-violet-50 px-2 py-0.5 text-[10px] font-semibold text-violet-600">DataMind</span>
                        <span class="rounded bg-violet-50 px-2 py-0.5 text-[10px] font-semibold text-violet-600">Automatizálás</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Comparison Table Section --}}
    <section class="bg-surface-secondary py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-6">
            <div class="reveal mb-12">
                <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-violet-600">Összehasonlítás</p>
                <h2 class="mb-4 text-3xl text-text-primary md:text-4xl" style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                    Excel-halmaz helyett — MI-vezérelt cégirányítás
                </h2>
                <p class="max-w-xl text-lg text-text-secondary">
                    Így változik meg a cégvezetői munka a Cégem360 bevezetésével.
                </p>
            </div>

            <div class="reveal overflow-x-auto">
                <table class="w-full min-w-[640px] border-collapse overflow-hidden rounded-2xl border border-border-light">
                    <thead>
                        <tr class="bg-surface-primary">
                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-text-primary">Képesség</th>
                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-text-primary">Hagyományos módszer</th>
                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-text-primary">Cégem360</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-border-light">
                        <tr><td class="px-6 py-4 text-sm font-semibold text-text-primary">Vállalati áttekintés</td><td class="px-6 py-4 text-sm text-text-tertiary">Hónap végén, kézzel</td><td class="px-6 py-4 text-sm font-medium text-success-600">✓ Valós idejű, 11 modulból</td></tr>
                        <tr><td class="px-6 py-4 text-sm font-semibold text-text-primary">Vezetői riport</td><td class="px-6 py-4 text-sm text-text-tertiary">Napokig tartó kézi munka</td><td class="px-6 py-4 text-sm font-medium text-success-600">✓ Automatikus, ütemezett</td></tr>
                        <tr><td class="px-6 py-4 text-sm font-semibold text-text-primary">Előrejelzés</td><td class="px-6 py-4 text-sm text-text-tertiary">Megérzés / tapasztalat</td><td class="px-6 py-4 text-sm font-medium text-success-600">✓ MI predikció, szcenáriók</td></tr>
                        <tr><td class="px-6 py-4 text-sm font-semibold text-text-primary">Kockázat-azonosítás</td><td class="px-6 py-4 text-sm text-text-tertiary">Ha valaki szól</td><td class="px-6 py-4 text-sm font-medium text-success-600">✓ Automatikus MI detektálás</td></tr>
                        <tr><td class="px-6 py-4 text-sm font-semibold text-text-primary">Operatív átláthatóság</td><td class="px-6 py-4 text-sm text-text-tertiary">Szóban / értekezleten</td><td class="px-6 py-4 text-sm font-medium text-success-600">✓ Élő dashboard, drilldown</td></tr>
                        <tr><td class="px-6 py-4 text-sm font-semibold text-text-primary">Stratégiai tervezés</td><td class="px-6 py-4 text-sm text-text-tertiary">Évi 1× stratégiai nap</td><td class="px-6 py-4 text-sm font-medium text-success-600">✓ Folyamatos, adatvezérelt</td></tr>
                        <tr><td class="px-6 py-4 text-sm font-semibold text-text-primary">Információs egységesség</td><td class="px-6 py-4 text-sm text-text-tertiary">Mindenki más számot mond</td><td class="px-6 py-4 text-sm font-medium text-success-600">✓ Egyetlen igazságforrás</td></tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    {{-- Consultation Section --}}
    <section class="bg-surface-primary py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-6">
            <div class="reveal">
                <div class="grid grid-cols-1 items-center gap-8 rounded-2xl border border-border-light bg-surface-secondary p-8 lg:grid-cols-[1fr_auto] lg:p-12" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div>
                        <h3 class="mb-3 text-xl font-bold text-text-primary lg:text-2xl" style="font-family: 'Poppins', sans-serif;">Személyre szabott vezetői konzultáció</h3>
                        <p class="mb-5 text-base text-text-secondary">30 perces videóhívás, amelyben bemutatjuk, hogyan adhat a Cégem360 valós idejű vállalati áttekintést és MI döntéstámogatást az Ön ipari vállalatának — a teljes modulkészlettel.</p>
                        <div class="flex flex-wrap gap-5">
                            <span class="flex items-center gap-1.5 text-sm text-text-tertiary"><svg class="h-4 w-4 text-success-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>30 perc videóhívás</span>
                            <span class="flex items-center gap-1.5 text-sm text-text-tertiary"><svg class="h-4 w-4 text-success-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>Vezetői igényfelmérés</span>
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
    <section class="bg-linear-to-b from-surface-secondary to-surface-primary py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-6">
            <div class="reveal mb-12 text-center">
                <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-violet-600">Kezdje el</p>
                <h2 class="mb-4 text-3xl text-text-primary md:text-4xl" style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                    Készen áll az adatvezérelt cégirányításra?
                </h2>
                <p class="mx-auto max-w-xl text-lg text-text-secondary">
                    Válassza ki a következő lépést az Ön számára.
                </p>
            </div>

            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2" data-stagger>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-8 text-center" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <h3 class="mb-3 text-xl font-bold text-text-primary">Vezetői konzultáció</h3>
                    <p class="mb-6 text-sm text-text-secondary">Kérdezzen szakértőinktől 30 percben — videóhíváson, az Ön vállalatirányítási kihívásaira szabva, kötelezettség nélkül.</p>
                    <a href="{{ route('contact') }}" class="inline-flex items-center gap-2 rounded-full border border-border-light bg-surface-secondary px-6 py-3 text-sm font-medium text-text-primary transition-all hover:border-violet-200 hover:shadow-md">
                        Időpont foglalása <svg class="arrow-slide h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" /></svg>
                    </a>
                </div>
                <div class="stagger-item card-glow rounded-2xl border border-violet-100 bg-violet-50 p-8 text-center" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <h3 class="mb-3 text-xl font-bold text-text-primary">Regisztráció és kipróbálás</h3>
                    <p class="mb-6 text-sm text-text-secondary">Fedezze fel a vezetői dashboardot, a DataMind MI összefoglalókat és a teljes 11 modulrendszert — azonnal.</p>
                    <a href="{{ route('register') }}" class="group inline-flex items-center gap-2 rounded-full bg-violet-600 px-6 py-3 text-sm font-medium text-white transition-all hover:bg-violet-700 hover:shadow-lg" style="box-shadow: 0 1px 2px rgba(0,0,0,0.05);">
                        Regisztráció <svg class="arrow-slide h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" /></svg>
                    </a>
                </div>
            </div>
        </div>
    </section>
</div>
