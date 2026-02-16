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
        /* Scroll reveal base states */
        .reveal {
            opacity: 0;
            transform: translateY(28px);
            transition: opacity 0.7s cubic-bezier(0, 0, 0.2, 1), transform 0.7s cubic-bezier(0, 0, 0.2, 1);
        }
        .reveal.revealed { opacity: 1; transform: translateY(0); }
        .reveal-left {
            opacity: 0;
            transform: translateX(-32px);
            transition: opacity 0.7s cubic-bezier(0, 0, 0.2, 1), transform 0.7s cubic-bezier(0, 0, 0.2, 1);
        }
        .reveal-left.revealed { opacity: 1; transform: translateX(0); }
        .reveal-right {
            opacity: 0;
            transform: translateX(32px);
            transition: opacity 0.7s cubic-bezier(0, 0, 0.2, 1), transform 0.7s cubic-bezier(0, 0, 0.2, 1);
        }
        .reveal-right.revealed { opacity: 1; transform: translateX(0); }
        .reveal-scale {
            opacity: 0;
            transform: scale(0.92);
            transition: opacity 0.6s cubic-bezier(0, 0, 0.2, 1), transform 0.6s cubic-bezier(0, 0, 0.2, 1);
        }
        .reveal-scale.revealed { opacity: 1; transform: scale(1); }

        /* Stagger children */
        .stagger-item {
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 0.5s cubic-bezier(0, 0, 0.2, 1), transform 0.5s cubic-bezier(0, 0, 0.2, 1);
        }
        .stagger-item.revealed { opacity: 1; transform: translateY(0); }

        /* Badge gradient animation */
        @keyframes gradient-shift {
            0%, 100% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
        }
        .badge-gradient {
            background-size: 200% 200%;
            animation: gradient-shift 3s ease infinite;
        }

        /* Pulse ring for badge dot */
        @keyframes pulse-ring {
            0% { box-shadow: 0 0 0 0 rgba(79, 70, 229, 0.4); }
            70% { box-shadow: 0 0 0 6px rgba(79, 70, 229, 0); }
            100% { box-shadow: 0 0 0 0 rgba(79, 70, 229, 0); }
        }
        .pulse-dot { animation: pulse-ring 2s ease infinite; }

        /* Card hover glow */
        .card-glow {
            transition: all 0.4s cubic-bezier(0, 0, 0.2, 1);
        }
        .card-glow:hover {
            box-shadow: 0 8px 30px -8px rgba(79, 70, 229, 0.15), 0 2px 8px rgba(0,0,0,0.04) !important;
        }

        /* Icon hover bounce */
        .icon-hover { transition: transform 0.35s cubic-bezier(0, 0, 0.2, 1.4); }
        .group:hover .icon-hover,
        .card-glow:hover .icon-hover { transform: translateY(-3px) scale(1.08); }

        /* Arrow slide on hover */
        .arrow-slide { transition: transform 0.3s cubic-bezier(0, 0, 0.2, 1); }
        .group:hover .arrow-slide,
        a:hover .arrow-slide { transform: translateX(4px); }

        /* Stat value scale */
        .stat-hover .stat-value {
            transition: transform 0.4s cubic-bezier(0, 0, 0.2, 1.4);
        }
        .stat-hover:hover .stat-value {
            transform: scale(1.08);
        }

        /* Feature dot pulse on card hover */
        .feature-dot {
            transition: transform 0.3s cubic-bezier(0, 0, 0.2, 1);
        }
        .card-glow:hover .feature-dot {
            transform: scale(1.5);
        }

        /* Data flow connector line */
        .flow-line {
            background: linear-gradient(90deg, transparent, var(--color-indigo-200), var(--color-primary-200), var(--color-blue-200), transparent);
            transform: scaleX(0);
            transform-origin: left;
            transition: transform 1.2s cubic-bezier(0, 0, 0.2, 1) 0.3s;
        }
        .flow-line.revealed { transform: scaleX(1); }

        /* Dashboard bar animation */
        @keyframes dashboard-grow {
            from { transform: scaleY(0); transform-origin: bottom; }
            to { transform: scaleY(1); transform-origin: bottom; }
        }
        .dashboard-bar {
            animation: dashboard-grow 0.8s cubic-bezier(0, 0, 0.2, 1) both;
        }

        /* Pill float */
        .pill-float {
            transition: transform 0.35s cubic-bezier(0, 0, 0.2, 1), box-shadow 0.35s cubic-bezier(0, 0, 0.2, 1);
        }
        .pill-float:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 20px -4px rgba(79, 70, 229, 0.12);
        }

        /* Smooth scroll for anchor links */
        html { scroll-behavior: smooth; }
    </style>

    {{-- Hero Section --}}
    <section class="bg-linear-to-b from-indigo-50/60 to-surface-secondary">
        <div class="mx-auto max-w-7xl px-6 py-16 lg:py-24">
            <div class="grid grid-cols-1 items-center gap-12 lg:grid-cols-2">
                {{-- Hero Text --}}
                <div class="reveal">
                    <div class="badge-gradient mb-8 inline-flex items-center gap-2 rounded-full border border-border-light/80 bg-surface-primary px-4 py-1.5"
                        style="box-shadow: 0 1px 3px rgba(0,0,0,0.04);">
                        <span class="pulse-dot h-1.5 w-1.5 rounded-full bg-linear-to-r from-indigo-500 via-blue-500 to-cyan-500"></span>
                        <span class="text-sm font-medium text-text-primary">Pénzügyi irányítás és kontrolling</span>
                    </div>

                    <h1 class="mb-6 text-4xl leading-tight tracking-tight text-text-primary md:text-5xl lg:text-[3.5rem]"
                        style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                        Lássa át vállalata pénzügyeit<br>
                        — valós időben, nem hónap végén
                    </h1>

                    <p class="mb-10 max-w-xl text-lg text-text-secondary lg:text-xl">
                        Kontrolling, cash flow előrejelzés, projekt-jövedelmezőség, automatikus riportok — minden egy rendszerben. A Cégem360 moduláris platformja a pénzügyi átláthatóságot biztosítja, a napi tranzakcióktól a stratégiai döntésekig.
                    </p>

                    <div class="flex flex-wrap items-center gap-4">
                        <a href="{{ route('contact') }}"
                            class="group inline-flex items-center gap-2 rounded-full bg-indigo-600 px-6 py-3 text-base font-medium text-white transition-all hover:bg-indigo-700 hover:shadow-lg"
                            style="box-shadow: 0 1px 2px rgba(0,0,0,0.05);">
                            <span>Online konzultáció</span>
                            <svg class="arrow-slide h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                            </svg>
                        </a>
                        <a href="#megoldasok"
                            class="inline-flex items-center gap-2 rounded-full border border-border-light bg-surface-primary px-6 py-3 text-base font-medium text-text-primary transition-all hover:border-indigo-200 hover:bg-surface-secondary hover:shadow-md">
                            Megoldások áttekintése
                        </a>
                    </div>
                </div>

                {{-- Finance Dashboard Visual --}}
                <div class="reveal-right">
                    <div class="rounded-2xl border border-border-light bg-surface-primary p-6"
                        style="box-shadow: 0 4px 20px -4px rgba(0,0,0,0.06);">
                        <div class="mb-4 flex items-center justify-between border-b border-border-light pb-4">
                            <span class="text-sm font-bold text-text-primary">Pénzügyi Dashboard — 2026 Q1</span>
                            <span class="text-xs text-text-tertiary">Valós idejű adatok</span>
                        </div>

                        {{-- KPI Cards --}}
                        <div class="mb-5 grid grid-cols-3 gap-3">
                            <div class="rounded-xl border border-border-light bg-indigo-50 p-3 text-center">
                                <span class="block text-[11px] font-medium text-text-tertiary">Nettó árbevétel</span>
                                <span class="block text-lg font-bold text-indigo-700" style="font-family: 'JetBrains Mono', monospace;">248.6M</span>
                                <span class="text-[10px] font-medium text-success-600">+12.4%</span>
                            </div>
                            <div class="rounded-xl border border-border-light bg-blue-50 p-3 text-center">
                                <span class="block text-[11px] font-medium text-text-tertiary">EBITDA</span>
                                <span class="block text-lg font-bold text-blue-700" style="font-family: 'JetBrains Mono', monospace;">41.2M</span>
                                <span class="text-[10px] font-medium text-success-600">+8.7%</span>
                            </div>
                            <div class="rounded-xl border border-border-light bg-cyan-50 p-3 text-center">
                                <span class="block text-[11px] font-medium text-text-tertiary">Cash flow</span>
                                <span class="block text-lg font-bold text-cyan-700" style="font-family: 'JetBrains Mono', monospace;">18.9M</span>
                                <span class="text-[10px] font-medium text-warning-600">-2.1%</span>
                            </div>
                        </div>

                        {{-- Chart Bars --}}
                        <div class="mb-4">
                            <span class="mb-2 block text-[11px] font-semibold text-text-tertiary">Havi árbevétel vs. költség (M Ft)</span>
                            <div class="flex items-end gap-2" style="height: 80px;">
                                <div class="flex flex-1 flex-col items-center gap-1">
                                    <div class="dashboard-bar w-full rounded-t bg-indigo-400" style="height: 60px; animation-delay: 0.1s;"></div>
                                    <div class="dashboard-bar w-full rounded-t bg-indigo-200" style="height: 40px; animation-delay: 0.15s;"></div>
                                    <span class="text-[9px] text-text-tertiary">Jan</span>
                                </div>
                                <div class="flex flex-1 flex-col items-center gap-1">
                                    <div class="dashboard-bar w-full rounded-t bg-indigo-400" style="height: 68px; animation-delay: 0.2s;"></div>
                                    <div class="dashboard-bar w-full rounded-t bg-indigo-200" style="height: 44px; animation-delay: 0.25s;"></div>
                                    <span class="text-[9px] text-text-tertiary">Feb</span>
                                </div>
                                <div class="flex flex-1 flex-col items-center gap-1">
                                    <div class="dashboard-bar w-full rounded-t bg-indigo-400" style="height: 75px; animation-delay: 0.3s;"></div>
                                    <div class="dashboard-bar w-full rounded-t bg-indigo-200" style="height: 48px; animation-delay: 0.35s;"></div>
                                    <span class="text-[9px] text-text-tertiary">Már</span>
                                </div>
                                <div class="flex flex-1 flex-col items-center gap-1">
                                    <div class="dashboard-bar w-full rounded-t bg-blue-400" style="height: 70px; animation-delay: 0.4s;"></div>
                                    <div class="dashboard-bar w-full rounded-t bg-blue-200" style="height: 50px; animation-delay: 0.45s;"></div>
                                    <span class="text-[9px] text-text-tertiary">Ápr</span>
                                </div>
                                <div class="flex flex-1 flex-col items-center gap-1">
                                    <div class="dashboard-bar w-full rounded-t bg-blue-400" style="height: 80px; animation-delay: 0.5s;"></div>
                                    <div class="dashboard-bar w-full rounded-t bg-blue-200" style="height: 46px; animation-delay: 0.55s;"></div>
                                    <span class="text-[9px] text-text-tertiary">Máj</span>
                                </div>
                            </div>
                        </div>

                        {{-- Project P&L rows --}}
                        <div class="space-y-1.5">
                            <span class="mb-1 block text-[11px] font-semibold text-text-tertiary">Projekt jövedelmezőség</span>
                            <div class="flex items-center justify-between rounded-lg bg-surface-secondary px-3 py-2">
                                <span class="text-xs font-medium text-text-secondary">Gyártósor telepítés</span>
                                <span class="text-xs font-bold text-success-600">+18.2%</span>
                            </div>
                            <div class="flex items-center justify-between rounded-lg bg-surface-secondary px-3 py-2">
                                <span class="text-xs font-medium text-text-secondary">Szerviz szerződés</span>
                                <span class="text-xs font-bold text-success-600">+24.6%</span>
                            </div>
                            <div class="flex items-center justify-between rounded-lg bg-surface-secondary px-3 py-2">
                                <span class="text-xs font-medium text-text-secondary">Egyedi fejlesztés</span>
                                <span class="text-xs font-bold text-warning-600">+5.1%</span>
                            </div>
                        </div>

                        {{-- Status bar --}}
                        <div class="mt-4 flex gap-5 border-t border-border-light pt-3">
                            <span class="flex items-center gap-1.5 text-[11px] text-text-tertiary">
                                <span class="h-2 w-2 rounded-full bg-indigo-500"></span> Árbevétel
                            </span>
                            <span class="flex items-center gap-1.5 text-[11px] text-text-tertiary">
                                <span class="h-2 w-2 rounded-full bg-indigo-200"></span> Költség
                            </span>
                            <span class="flex items-center gap-1.5 text-[11px] text-text-tertiary">
                                <span class="h-2 w-2 rounded-full bg-success-500"></span> Profit
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
                <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-indigo-600">A kihívás</p>
                <h2 class="mb-4 text-3xl text-text-primary md:text-4xl" style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                    Ezek nehezítik a pénzügyi átláthatóságot
                </h2>
                <p class="max-w-xl text-lg text-text-secondary">
                    Ismerős helyzetek pénzügyi vezetők és kontrollerek számára.
                </p>
            </div>

            <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4" data-stagger>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-7"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="icon-hover mb-5 flex h-12 w-12 items-center justify-center rounded-xl bg-danger-50">
                        <svg class="h-6 w-6 text-danger-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="mb-2 text-lg font-bold text-text-primary">Hónap végi meglepetések</h3>
                    <p class="text-sm leading-relaxed text-text-secondary">A pénzügyi eredményeket csak a hónap végén látja — addigra már nem lehet korrigálni a problémákat.</p>
                </div>

                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-7"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="icon-hover mb-5 flex h-12 w-12 items-center justify-center rounded-xl bg-warning-50">
                        <svg class="h-6 w-6 text-warning-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                        </svg>
                    </div>
                    <h3 class="mb-2 text-lg font-bold text-text-primary">Szétszórt pénzügyi adatok</h3>
                    <p class="text-sm leading-relaxed text-text-secondary">Számlázás, kontrolling, projektkövetés és Excel-táblák — az adatok nem egy helyen vannak, az összkép hiányzik.</p>
                </div>

                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-7"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="icon-hover mb-5 flex h-12 w-12 items-center justify-center rounded-xl bg-violet-50">
                        <svg class="h-6 w-6 text-violet-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="mb-2 text-lg font-bold text-text-primary">Napokig tartó riportkészítés</h3>
                    <p class="text-sm leading-relaxed text-text-secondary">A vezetői riportok összeállítása manuális munka — napokba telik, mire a döntéshozók megkapják az aktuális képet.</p>
                </div>

                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-7"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="icon-hover mb-5 flex h-12 w-12 items-center justify-center rounded-xl bg-primary-50">
                        <svg class="h-6 w-6 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                        </svg>
                    </div>
                    <h3 class="mb-2 text-lg font-bold text-text-primary">Nincs előrejelzés</h3>
                    <p class="text-sm leading-relaxed text-text-secondary">A döntések múltbeli adatokon alapulnak, nincs prediktív elemzés — a cash flow szűkülés vagy a költségtúllépés későn derül ki.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Target Audiences Section --}}
    <section class="bg-surface-secondary py-16 lg:py-24" id="celcsoportok">
        <div class="mx-auto max-w-7xl px-6">
            <div class="reveal mb-12">
                <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-indigo-600">Ki használja?</p>
                <h2 class="mb-4 text-3xl text-text-primary md:text-4xl" style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                    Minden pénzügyi szereplő egy rendszerben
                </h2>
                <p class="max-w-xl text-lg text-text-secondary">
                    A Cégem360 a pénzügyi döntéshozók és kontrollerek közös munkafelülete — a napi tranzakcióktól a stratégiai tervezésig.
                </p>
            </div>

            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4" data-stagger>
                <div class="stagger-item group card-glow relative overflow-hidden rounded-2xl border border-border-light bg-surface-primary p-8"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="absolute inset-x-0 top-0 h-1 bg-linear-to-r from-indigo-500 to-blue-400 opacity-0 transition-opacity duration-500 group-hover:opacity-100"></div>
                    <div class="icon-hover mb-4 flex h-14 w-14 items-center justify-center rounded-2xl bg-indigo-50">
                        <svg class="h-7 w-7 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <p class="mb-2 text-xs font-semibold uppercase tracking-wider text-indigo-600">Pénzügyi vezető</p>
                    <h3 class="mb-3 text-lg font-bold text-text-primary">CFO / Pénzügyi igazgató</h3>
                    <p class="text-sm leading-relaxed text-text-secondary">Teljes pénzügyi áttekintés, cash flow előrejelzés, jövedelmezőségi elemzés és stratégiai döntéstámogatás — egyetlen dashboard-on.</p>
                </div>

                <div class="stagger-item group card-glow relative overflow-hidden rounded-2xl border border-border-light bg-surface-primary p-8"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="absolute inset-x-0 top-0 h-1 bg-linear-to-r from-blue-500 to-cyan-400 opacity-0 transition-opacity duration-500 group-hover:opacity-100"></div>
                    <div class="icon-hover mb-4 flex h-14 w-14 items-center justify-center rounded-2xl bg-blue-50">
                        <svg class="h-7 w-7 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                    </div>
                    <p class="mb-2 text-xs font-semibold uppercase tracking-wider text-blue-600">Kontrolling</p>
                    <h3 class="mb-3 text-lg font-bold text-text-primary">Kontrollerek</h3>
                    <p class="text-sm leading-relaxed text-text-secondary">Terv-tény elemzés, költséghelyi kontrolling, projekt-jövedelmezőség és automatikus riportgenerálás — valós időben.</p>
                </div>

                <div class="stagger-item group card-glow relative overflow-hidden rounded-2xl border border-border-light bg-surface-primary p-8"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="absolute inset-x-0 top-0 h-1 bg-linear-to-r from-warning-500 to-amber-400 opacity-0 transition-opacity duration-500 group-hover:opacity-100"></div>
                    <div class="icon-hover mb-4 flex h-14 w-14 items-center justify-center rounded-2xl bg-warning-50">
                        <svg class="h-7 w-7 text-warning-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                    </div>
                    <p class="mb-2 text-xs font-semibold uppercase tracking-wider text-warning-600">Ügyvezető</p>
                    <h3 class="mb-3 text-lg font-bold text-text-primary">Ügyvezetők/tulajdonosok</h3>
                    <p class="text-sm leading-relaxed text-text-secondary">Árbevétel-trendek, profitabilitás, stratégiai KPI-k és automatikus heti/havi összefoglalók — könnyen emészthető formában.</p>
                </div>

                <div class="stagger-item group card-glow relative overflow-hidden rounded-2xl border border-border-light bg-surface-primary p-8"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="absolute inset-x-0 top-0 h-1 bg-linear-to-r from-violet-500 to-purple-400 opacity-0 transition-opacity duration-500 group-hover:opacity-100"></div>
                    <div class="icon-hover mb-4 flex h-14 w-14 items-center justify-center rounded-2xl bg-violet-50">
                        <svg class="h-7 w-7 text-violet-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.066 2.573c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.573 1.066c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.066-2.573c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>
                    <p class="mb-2 text-xs font-semibold uppercase tracking-wider text-violet-600">Operatív vezető</p>
                    <h3 class="mb-3 text-lg font-bold text-text-primary">Projekt- és üzemvezetők</h3>
                    <p class="text-sm leading-relaxed text-text-secondary">Projekt-szintű költségkövetés, erőforrás-felhasználás és jövedelmezőségi riportok — hogy minden projekt nyereséges maradjon.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Core Toolkit Section --}}
    <section class="bg-surface-primary py-16 lg:py-24" id="megoldasok">
        <div class="mx-auto max-w-7xl px-6">
            <div class="reveal mb-12">
                <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-indigo-600">Pénzügyi eszköztár</p>
                <h2 class="mb-4 text-3xl text-text-primary md:text-4xl" style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                    4 kulcsmodul a pénzügyi átláthatósághoz
                </h2>
                <p class="max-w-xl text-lg text-text-secondary">
                    Ezek a modulok közvetlenül a pénzügyi döntéshozók mindennapi munkáját támogatják.
                </p>
            </div>

            <div class="grid grid-cols-1 gap-6 lg:grid-cols-2" data-stagger>
                {{-- Kontrolling --}}
                <div class="stagger-item group card-glow rounded-2xl border border-border-light bg-surface-primary p-8 transition-all hover:border-indigo-200"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="mb-5 flex items-center gap-3">
                        <div class="icon-hover">
                            <x-module-icon module="kontrolling" size="sm" rounded="lg" />
                        </div>
                        <div>
                            <span class="rounded-md bg-indigo-50 px-2.5 py-1 text-xs font-bold uppercase tracking-wider text-indigo-600">Kontrolling</span>
                        </div>
                        <span class="text-xs text-text-tertiary">Pénzügyi irányítás</span>
                    </div>
                    <h3 class="mb-3 text-xl font-bold text-text-primary">Valós idejű pénzügyi áttekintés</h3>
                    <p class="mb-6 text-sm leading-relaxed text-text-secondary">Terv-tény elemzés, költséghelyi kontrolling, projekt-jövedelmezőség, cash flow monitoring és automatikus riportkészítés. Minden pénzügyi adat egy helyen.</p>
                    <div class="mb-6 grid grid-cols-2 gap-2">
                        <span class="flex items-center gap-2 text-sm text-text-secondary">
                            <span class="feature-dot h-1.5 w-1.5 rounded-full bg-indigo-500"></span>Terv-tény elemzés
                        </span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary">
                            <span class="feature-dot h-1.5 w-1.5 rounded-full bg-indigo-500"></span>Cash flow monitoring
                        </span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary">
                            <span class="feature-dot h-1.5 w-1.5 rounded-full bg-indigo-500"></span>Költséghelyi kontroll
                        </span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary">
                            <span class="feature-dot h-1.5 w-1.5 rounded-full bg-indigo-500"></span>Automatikus riportok
                        </span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary">
                            <span class="feature-dot h-1.5 w-1.5 rounded-full bg-indigo-500"></span>Projekt-jövedelmezőség
                        </span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary">
                            <span class="feature-dot h-1.5 w-1.5 rounded-full bg-indigo-500"></span>KPI dashboard
                        </span>
                    </div>
                    <a href="{{ route('products.kontrolling') }}" class="inline-flex items-center gap-1.5 text-sm font-semibold text-indigo-600 transition-colors hover:text-indigo-700">
                        Részletek megtekintése
                        <svg class="arrow-slide h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                        </svg>
                    </a>
                </div>

                {{-- DataMind --}}
                <div class="stagger-item group card-glow rounded-2xl border border-border-light bg-surface-primary p-8 transition-all hover:border-blue-200"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="mb-5 flex items-center gap-3">
                        <div class="icon-hover">
                            <x-module-icon module="datamind" size="sm" rounded="lg" />
                        </div>
                        <div>
                            <span class="rounded-md bg-blue-50 px-2.5 py-1 text-xs font-bold uppercase tracking-wider text-blue-600">DataMind</span>
                        </div>
                        <span class="text-xs text-text-tertiary">MI alapú pénzügyi intelligencia</span>
                    </div>
                    <h3 class="mb-3 text-xl font-bold text-text-primary">Prediktív pénzügyi elemzés</h3>
                    <p class="mb-6 text-sm leading-relaxed text-text-secondary">Cash flow előrejelzés, költség-anomália felismerés, jövedelmezőségi predikció és automatikus MI összefoglalók. Drag-and-drop elemzés magyar nyelven.</p>
                    <div class="mb-6 grid grid-cols-2 gap-2">
                        <span class="flex items-center gap-2 text-sm text-text-secondary">
                            <span class="feature-dot h-1.5 w-1.5 rounded-full bg-blue-500"></span>Cash flow predikció
                        </span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary">
                            <span class="feature-dot h-1.5 w-1.5 rounded-full bg-blue-500"></span>Költség-anomália
                        </span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary">
                            <span class="feature-dot h-1.5 w-1.5 rounded-full bg-blue-500"></span>Trend-elemzés
                        </span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary">
                            <span class="feature-dot h-1.5 w-1.5 rounded-full bg-blue-500"></span>MI összefoglalók
                        </span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary">
                            <span class="feature-dot h-1.5 w-1.5 rounded-full bg-blue-500"></span>Profit predikció
                        </span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary">
                            <span class="feature-dot h-1.5 w-1.5 rounded-full bg-blue-500"></span>Automatikus riportok
                        </span>
                    </div>
                    <a href="{{ route('products.datamind') }}" class="inline-flex items-center gap-1.5 text-sm font-semibold text-blue-600 transition-colors hover:text-blue-700">
                        Részletek megtekintése
                        <svg class="arrow-slide h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                        </svg>
                    </a>
                </div>

                {{-- Értékesítés --}}
                <div class="stagger-item group card-glow rounded-2xl border border-border-light bg-surface-primary p-8 transition-all hover:border-success-200"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="mb-5 flex items-center gap-3">
                        <div class="icon-hover">
                            <x-module-icon module="ertekesites" size="sm" rounded="lg" />
                        </div>
                        <div>
                            <span class="rounded-md bg-success-50 px-2.5 py-1 text-xs font-bold uppercase tracking-wider text-success-600">Értékesítés</span>
                        </div>
                        <span class="text-xs text-text-tertiary">Árbevétel-forrás</span>
                    </div>
                    <h3 class="mb-3 text-xl font-bold text-text-primary">Árbevétel-adatok valós időben</h3>
                    <p class="mb-6 text-sm leading-relaxed text-text-secondary">Az értékesítési modul adatai azonnal megjelennek a kontrollingban — árbevétel, pipeline érték, ajánlat→rendelés konverzió és ügyfél-szintű jövedelmezőség.</p>
                    <div class="mb-6 grid grid-cols-2 gap-2">
                        <span class="flex items-center gap-2 text-sm text-text-secondary">
                            <span class="feature-dot h-1.5 w-1.5 rounded-full bg-success-500"></span>Árbevétel-tracking
                        </span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary">
                            <span class="feature-dot h-1.5 w-1.5 rounded-full bg-success-500"></span>Pipeline érték
                        </span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary">
                            <span class="feature-dot h-1.5 w-1.5 rounded-full bg-success-500"></span>Konverzió-mérés
                        </span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary">
                            <span class="feature-dot h-1.5 w-1.5 rounded-full bg-success-500"></span>Ügyfél-jövedelmezőség
                        </span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary">
                            <span class="feature-dot h-1.5 w-1.5 rounded-full bg-success-500"></span>Előrejelzés
                        </span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary">
                            <span class="feature-dot h-1.5 w-1.5 rounded-full bg-success-500"></span>Trend-elemzés
                        </span>
                    </div>
                    <a href="{{ route('products.ertekesites') }}" class="inline-flex items-center gap-1.5 text-sm font-semibold text-success-600 transition-colors hover:text-success-700">
                        Részletek megtekintése
                        <svg class="arrow-slide h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                        </svg>
                    </a>
                </div>

                {{-- Automatizálás --}}
                <div class="stagger-item group card-glow rounded-2xl border border-border-light bg-surface-primary p-8 transition-all hover:border-violet-200"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="mb-5 flex items-center gap-3">
                        <div class="icon-hover">
                            <x-module-icon module="automatizalas" size="sm" rounded="lg" />
                        </div>
                        <div>
                            <span class="rounded-md bg-violet-50 px-2.5 py-1 text-xs font-bold uppercase tracking-wider text-violet-600">Automatizálás</span>
                        </div>
                        <span class="text-xs text-text-tertiary">Pénzügyi workflow-k</span>
                    </div>
                    <h3 class="mb-3 text-xl font-bold text-text-primary">Automatizálja a pénzügyi folyamatokat</h3>
                    <p class="mb-6 text-sm leading-relaxed text-text-secondary">Automatikus riportküldés, költség-figyelmeztető triggerek, jóváhagyási workflow-k és határidő-emlékeztetők — szabályalapúan, kód nélkül.</p>
                    <div class="mb-6 grid grid-cols-2 gap-2">
                        <span class="flex items-center gap-2 text-sm text-text-secondary">
                            <span class="feature-dot h-1.5 w-1.5 rounded-full bg-violet-500"></span>Automatikus riportküldés
                        </span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary">
                            <span class="feature-dot h-1.5 w-1.5 rounded-full bg-violet-500"></span>Költség-figyelmeztetés
                        </span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary">
                            <span class="feature-dot h-1.5 w-1.5 rounded-full bg-violet-500"></span>Jóváhagyási workflow
                        </span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary">
                            <span class="feature-dot h-1.5 w-1.5 rounded-full bg-violet-500"></span>Határidő-emlékeztetők
                        </span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary">
                            <span class="feature-dot h-1.5 w-1.5 rounded-full bg-violet-500"></span>Adatvalidálás
                        </span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary">
                            <span class="feature-dot h-1.5 w-1.5 rounded-full bg-violet-500"></span>Értesítés-szabályok
                        </span>
                    </div>
                    <a href="{{ route('products.automatizalas') }}" class="inline-flex items-center gap-1.5 text-sm font-semibold text-violet-600 transition-colors hover:text-violet-700">
                        Részletek megtekintése
                        <svg class="arrow-slide h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{-- Data Flow Section --}}
    <section class="bg-surface-secondary py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-6">
            <div class="reveal mb-14">
                <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-indigo-600">Adatáramlás</p>
                <h2 class="mb-4 text-3xl text-text-primary md:text-4xl" style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                    Zárt rendszer — az üzlettől a pénzügyi riportig
                </h2>
                <p class="max-w-xl text-lg text-text-secondary">
                    Minden üzleti területről automatikusan áramlanak az adatok a kontrollingba — a pénzügyi kép mindig naprakész.
                </p>
            </div>

            <div class="relative">
                {{-- Connector line (desktop only) --}}
                <div class="flow-line reveal absolute top-8 right-[10%] left-[10%] hidden h-0.5 lg:block"></div>

                <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-5" data-stagger>
                    @php
                        $dataFlow = [
                            ['num' => '01', 'title' => 'Értékesítés', 'desc' => 'Ajánlatok, megrendelések és árbevétel-adatok automatikusan áramlanak', 'modules' => ['CRM', 'Értékesítés'], 'color' => 'success'],
                            ['num' => '02', 'title' => 'Gyártás & szerviz', 'desc' => 'Gyártási költségek, munkalapok és szerviz-adatok valós időben', 'modules' => ['Gyártás', 'Munkalap'], 'color' => 'warning'],
                            ['num' => '03', 'title' => 'Beszerzés', 'desc' => 'Beszerzési költségek, készletértékek és szállítói számlák', 'modules' => ['Beszerzés'], 'color' => 'violet'],
                            ['num' => '04', 'title' => 'Kontrolling', 'desc' => 'Minden adat egy helyen — terv-tény elemzés és jövedelmezőség', 'modules' => ['Kontrolling'], 'color' => 'indigo'],
                            ['num' => '05', 'title' => 'MI elemzés', 'desc' => 'Prediktív elemzés, anomália-felismerés és automatikus összefoglalók', 'modules' => ['DataMind'], 'color' => 'blue'],
                        ];
                    @endphp

                    @foreach ($dataFlow as $step)
                        <div class="stagger-item text-center">
                            <div class="relative z-10 mx-auto mb-5 flex h-16 w-16 items-center justify-center rounded-full border-2 border-{{ $step['color'] }}-200 bg-{{ $step['color'] }}-50 text-2xl font-bold text-{{ $step['color'] }}-600 transition-all duration-300 hover:scale-110 hover:shadow-lg">
                                {{ $step['num'] }}
                            </div>
                            <h4 class="mb-2 text-base font-bold text-text-primary">{{ $step['title'] }}</h4>
                            <p class="mb-3 text-sm leading-relaxed text-text-tertiary">{{ $step['desc'] }}</p>
                            <div class="flex flex-wrap justify-center gap-1.5">
                                @foreach ($step['modules'] as $module)
                                    <span class="rounded-md bg-surface-primary px-2 py-0.5 text-[11px] font-semibold text-text-tertiary">{{ $module }}</span>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    {{-- Full Ecosystem Section --}}
    <section class="bg-surface-primary py-16 lg:py-24" id="okoszisztema">
        <div class="mx-auto max-w-7xl px-6">
            <div class="mb-12 grid grid-cols-1 items-start gap-8 lg:grid-cols-2">
                <div class="reveal-left">
                    <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-indigo-600">Teljes ökoszisztéma</p>
                    <h2 class="text-3xl text-text-primary md:text-4xl" style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                        Mind a 11 modul a pénzügyi átláthatóság szolgálatában
                    </h2>
                </div>
                <p class="reveal-right text-lg leading-relaxed text-text-secondary lg:mt-6">
                    A pénzügyi kép nem csak a kontrolling adataiból áll. Az értékesítés hozza az árbevételt, a gyártás a költségeket, a beszerzés a készletértéket. A Cégem360-ban minden modul adatai automatikusan beépülnek a pénzügyi riportokba.
                </p>
            </div>

            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4" data-stagger>
                <div class="stagger-item card-glow rounded-xl border border-border-light bg-surface-primary p-6 text-center"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="icon-hover mx-auto mb-3 flex h-11 w-11 items-center justify-center rounded-xl bg-success-50">
                        <x-module-icon module="crm" size="xs" />
                    </div>
                    <h4 class="mb-1 text-sm font-bold text-text-primary">CRM</h4>
                    <p class="text-xs leading-relaxed text-text-tertiary">Ügyfél-szintű árbevétel és jövedelmezőségi adatok a pénzügyi elemzésekhez.</p>
                </div>

                <div class="stagger-item card-glow rounded-xl border border-border-light bg-surface-primary p-6 text-center"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="icon-hover mx-auto mb-3 flex h-11 w-11 items-center justify-center rounded-xl bg-emerald-50">
                        <x-module-icon module="ertekesites" size="xs" />
                    </div>
                    <h4 class="mb-1 text-sm font-bold text-text-primary">Értékesítés</h4>
                    <p class="text-xs leading-relaxed text-text-tertiary">Ajánlatok, megrendelések és pipeline érték — az árbevétel-oldal adatforrása.</p>
                </div>

                <div class="stagger-item card-glow rounded-xl border border-border-light bg-surface-primary p-6 text-center"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="icon-hover mx-auto mb-3 flex h-11 w-11 items-center justify-center rounded-xl bg-violet-50">
                        <x-module-icon module="beszerzes" size="xs" />
                    </div>
                    <h4 class="mb-1 text-sm font-bold text-text-primary">Beszerzés-logisztika</h4>
                    <p class="text-xs leading-relaxed text-text-tertiary">Beszerzési költségek, készletértékek és szállítói kötelezettségek nyilvántartása.</p>
                </div>

                <div class="stagger-item card-glow rounded-xl border border-border-light bg-surface-primary p-6 text-center"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="icon-hover mx-auto mb-3 flex h-11 w-11 items-center justify-center rounded-xl bg-warning-50">
                        <x-module-icon module="gyartas" size="xs" />
                    </div>
                    <h4 class="mb-1 text-sm font-bold text-text-primary">Gyártásirányítás</h4>
                    <p class="text-xs leading-relaxed text-text-tertiary">Gyártási önköltség, kapacitás-kihasználtság és termelési hatékonyság adatok.</p>
                </div>

                <div class="stagger-item card-glow rounded-xl border border-border-light bg-surface-primary p-6 text-center"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="icon-hover mx-auto mb-3 flex h-11 w-11 items-center justify-center rounded-xl bg-pink-50">
                        <x-module-icon module="marketinghub" size="xs" />
                    </div>
                    <h4 class="mb-1 text-sm font-bold text-text-primary">MarketingHub</h4>
                    <p class="text-xs leading-relaxed text-text-tertiary">Marketing költségek és kampány ROI — melyik csatorna hoz valódi megtérülést.</p>
                </div>

                <div class="stagger-item card-glow rounded-xl border border-border-light bg-surface-primary p-6 text-center"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="icon-hover mx-auto mb-3 flex h-11 w-11 items-center justify-center rounded-xl bg-cyan-50">
                        <x-module-icon module="szerviz" size="xs" />
                    </div>
                    <h4 class="mb-1 text-sm font-bold text-text-primary">Digitális munkalap</h4>
                    <p class="text-xs leading-relaxed text-text-tertiary">Munkaidő- és anyagköltségek projekt szinten — a szerviz-jövedelmezőség alapja.</p>
                </div>

                <div class="stagger-item card-glow rounded-xl border border-border-light bg-surface-primary p-6 text-center"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="icon-hover mx-auto mb-3 flex h-11 w-11 items-center justify-center rounded-xl bg-danger-50">
                        <x-module-icon module="seo" size="xs" />
                    </div>
                    <h4 class="mb-1 text-sm font-bold text-text-primary">SEO Eszköz</h4>
                    <p class="text-xs leading-relaxed text-text-tertiary">Organikus forgalom és lead-szerzési költségek — a marketing megtérülés másik oldala.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Stats Section --}}
    <section class="bg-surface-secondary py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-6">
            <div class="reveal mb-12 text-center">
                <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-indigo-600">Eredmények</p>
                <h2 class="text-3xl text-text-primary md:text-4xl" style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                    Mérhető javulás a pénzügyi irányításban
                </h2>
            </div>

            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4" data-stagger data-counter-trigger>
                <div class="stagger-item stat-hover rounded-2xl border border-border-light bg-surface-primary p-8 text-center"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <p class="stat-value mb-2 text-4xl font-bold text-indigo-600" style="font-family: 'JetBrains Mono', monospace;" data-count="80" data-prefix="-" data-suffix="%">0%</p>
                    <p class="text-sm font-medium text-text-secondary">Riportkészítési idő</p>
                </div>

                <div class="stagger-item stat-hover rounded-2xl border border-border-light bg-surface-primary p-8 text-center"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <p class="stat-value mb-2 text-4xl font-bold text-blue-600" style="font-family: 'JetBrains Mono', monospace;" data-count="30" data-prefix="+" data-suffix="%">0%</p>
                    <p class="text-sm font-medium text-text-secondary">Költségcsökkentés</p>
                </div>

                <div class="stagger-item stat-hover rounded-2xl border border-border-light bg-surface-primary p-8 text-center"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <p class="stat-value mb-2 text-4xl font-bold text-cyan-600" style="font-family: 'JetBrains Mono', monospace;" data-count="3" data-suffix="×">0×</p>
                    <p class="text-sm font-medium text-text-secondary">Gyorsabb döntéshozatal</p>
                </div>

                <div class="stagger-item stat-hover rounded-2xl border border-border-light bg-surface-primary p-8 text-center"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <p class="stat-value mb-2 text-4xl font-bold text-violet-600" style="font-family: 'JetBrains Mono', monospace;" data-count="95" data-suffix="%">0%</p>
                    <p class="text-sm font-medium text-text-secondary">Predikció pontosság</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Use Cases Section --}}
    <section class="bg-surface-primary py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-6">
            <div class="reveal mb-12">
                <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-indigo-600">Felhasználási esetek</p>
                <h2 class="mb-4 text-3xl text-text-primary md:text-4xl" style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                    Így használják pénzügyi csapatok
                </h2>
            </div>

            <div class="grid grid-cols-1 gap-5 md:grid-cols-2 lg:grid-cols-3" data-stagger>
                @php
                    $useCases = [
                        ['num' => '01', 'title' => 'Projekt-szintű jövedelmezőség', 'desc' => 'Minden projekt költsége és árbevétele valós időben látható — a kontroller azonnal látja, melyik projekt nyereséges és melyik nem.', 'tags' => ['Kontrolling', 'Gyártás', 'Értékesítés']],
                        ['num' => '02', 'title' => 'Cash flow előrejelzés', 'desc' => 'A DataMind MI modellje a múltbeli adatok és a pipeline alapján előrejelzi a következő 3-6 hónap cash flow-ját — automatikusan, naponta frissítve.', 'tags' => ['DataMind', 'Kontrolling']],
                        ['num' => '03', 'title' => 'Automatikus vezetői riport', 'desc' => 'Heti és havi vezetői riportok automatikusan generálódnak és kiküldésre kerülnek — KPI-k, trendek és anomáliák kiemelésével.', 'tags' => ['Automatizálás', 'Kontrolling']],
                        ['num' => '04', 'title' => 'Marketing ROI mérés', 'desc' => 'A marketing költségek és az értékesítési eredmények összekapcsolása — végre mérhető, melyik kampány hoz valódi üzleti megtérülést.', 'tags' => ['MarketingHub', 'Kontrolling', 'CRM']],
                        ['num' => '05', 'title' => 'Gyártási önköltségszámítás', 'desc' => 'A gyártási költségek automatikusan hozzárendelődnek a termékekhez — anyag, munkaóra, gépidő és rezsi alapján, valós adatokkal.', 'tags' => ['Gyártás', 'Kontrolling']],
                        ['num' => '06', 'title' => 'Költség-anomália felismerése', 'desc' => 'A DataMind MI modellje figyeli a költségadatokat és automatikusan jelez, ha szokatlan tételek vagy trendek jelennek meg.', 'tags' => ['DataMind', 'Automatizálás']],
                    ];
                @endphp

                @foreach ($useCases as $useCase)
                    <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-7"
                        style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                        <span class="mb-3 block text-xs font-semibold text-text-tertiary" style="font-family: 'JetBrains Mono', monospace;">{{ $useCase['num'] }}</span>
                        <h3 class="mb-3 text-lg font-bold text-text-primary">{{ $useCase['title'] }}</h3>
                        <p class="mb-5 text-sm leading-relaxed text-text-secondary">{{ $useCase['desc'] }}</p>
                        <div class="flex flex-wrap gap-1.5">
                            @foreach ($useCase['tags'] as $tag)
                                <span class="rounded-md bg-indigo-50 px-2.5 py-1 text-xs font-medium text-indigo-700 transition-colors hover:bg-indigo-100">{{ $tag }}</span>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Comparison Table Section --}}
    <section class="bg-surface-secondary py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-6">
            <div class="reveal mb-12">
                <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-indigo-600">Összehasonlítás</p>
                <h2 class="mb-4 text-3xl text-text-primary md:text-4xl" style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                    Excel és manuális riportok helyett — integrált rendszer
                </h2>
                <p class="max-w-xl text-lg text-text-secondary">
                    Így változik meg a pénzügyi irányítás a Cégem360 bevezetésével.
                </p>
            </div>

            <div class="reveal-scale overflow-hidden rounded-2xl border border-border-light"
                style="box-shadow: 0 4px 20px -4px rgba(0,0,0,0.06);">
                <table class="w-full text-left text-sm">
                    <thead>
                        <tr class="bg-surface-primary">
                            <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-text-primary">Képesség</th>
                            <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-text-tertiary">Excel + E-mail</th>
                            <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-indigo-600">Cégem360</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-border-light">
                        @php
                            $comparisons = [
                                ['cap' => 'Pénzügyi áttekintés', 'old' => 'Hónap végén, manuálisan', 'new' => 'Valós idejű dashboard'],
                                ['cap' => 'Projekt-jövedelmezőség', 'old' => 'Utólagos kalkuláció', 'new' => 'Folyamatos monitoring'],
                                ['cap' => 'Riportkészítés', 'old' => 'Napokig tartó összegyűjtés', 'new' => 'Automatikus generálás'],
                                ['cap' => 'Cash flow előrejelzés', 'old' => 'Megérzés alapján', 'new' => 'MI-alapú predikció'],
                                ['cap' => 'Költség-anomália', 'old' => 'Későn derül ki', 'new' => 'Automatikus felismerés'],
                                ['cap' => 'Gyártási önköltség', 'old' => 'Becsült értékek', 'new' => 'Valós adatok alapján'],
                                ['cap' => 'Terv vs. tény', 'old' => 'Negyedévente egyszer', 'new' => 'Napi szintű frissítés'],
                            ];
                        @endphp

                        @foreach ($comparisons as $row)
                            <tr class="bg-surface-secondary transition-colors hover:bg-surface-primary/50">
                                <td class="px-6 py-4 font-semibold text-text-primary">{{ $row['cap'] }}</td>
                                <td class="px-6 py-4 text-text-tertiary">{{ $row['old'] }}</td>
                                <td class="px-6 py-4">
                                    <span class="flex items-center gap-2 font-medium text-text-secondary">
                                        <svg class="h-4 w-4 text-indigo-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" /></svg>
                                        {{ $row['new'] }}
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    {{-- Consultation Banner --}}
    <section class="bg-surface-primary py-6 lg:py-10">
        <div class="mx-auto max-w-7xl px-6">
            <div class="reveal-scale flex flex-col items-center gap-8 rounded-2xl border border-border-light bg-surface-secondary p-10 transition-shadow duration-500 hover:shadow-xl lg:flex-row lg:justify-between"
                style="box-shadow: 0 4px 20px -4px rgba(79, 70, 229, 0.08);">
                <div>
                    <h3 class="mb-2 text-xl font-bold text-text-primary">Személyre szabott online konzultáció</h3>
                    <p class="mb-4 max-w-lg text-sm leading-relaxed text-text-secondary">30 perces videóhívás, amelyben felmérjük, hogyan illeszthető a Cégem360 az Ön pénzügyi folyamataiba — az iparágára és vállalatméretére szabva.</p>
                    <div class="flex flex-wrap gap-5">
                        <span class="flex items-center gap-1.5 text-xs font-medium text-text-tertiary">
                            <svg class="h-3.5 w-3.5 text-indigo-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" /></svg>
                            30 perc videóhívás
                        </span>
                        <span class="flex items-center gap-1.5 text-xs font-medium text-text-tertiary">
                            <svg class="h-3.5 w-3.5 text-indigo-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" /></svg>
                            Pénzügyre szabott tanácsadás
                        </span>
                        <span class="flex items-center gap-1.5 text-xs font-medium text-text-tertiary">
                            <svg class="h-3.5 w-3.5 text-indigo-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" /></svg>
                            Nincs elköteleződés
                        </span>
                    </div>
                </div>
                <a href="{{ route('contact') }}"
                    class="group inline-flex shrink-0 items-center gap-2 rounded-full bg-indigo-600 px-6 py-3 text-base font-medium text-white transition-all hover:bg-indigo-700 hover:shadow-lg"
                    style="box-shadow: 0 1px 2px rgba(0,0,0,0.05);">
                    Konzultációt kérek
                    <svg class="arrow-slide h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                    </svg>
                </a>
            </div>
        </div>
    </section>

    {{-- Footer CTA Section --}}
    <section class="bg-surface-secondary py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-6">
            <div class="reveal mb-12 text-center">
                <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-indigo-600">Kezdje el</p>
                <h2 class="mb-4 text-3xl text-text-primary md:text-4xl" style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                    Készen áll a hatékonyabb pénzügyi irányításra?
                </h2>
                <p class="text-lg text-text-secondary">Válassza ki a következő lépést az Ön számára.</p>
            </div>

            <div class="mx-auto grid max-w-3xl grid-cols-1 gap-6 md:grid-cols-2" data-stagger>
                <div class="stagger-item card-glow rounded-2xl border border-indigo-100 bg-linear-to-br from-indigo-50/40 to-surface-primary p-8 text-center"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <h3 class="mb-3 text-lg font-bold text-text-primary">Online konzultáció</h3>
                    <p class="mb-6 text-sm leading-relaxed text-text-secondary">Kérdezzen szakértőinktől 30 percben — videóhíváson, az Ön pénzügyi folyamataira szabva, kötelezettség nélkül.</p>
                    <a href="{{ route('contact') }}"
                        class="group inline-flex items-center gap-2 rounded-full border border-border-light bg-surface-primary px-5 py-2.5 text-sm font-medium text-text-primary transition-all hover:border-indigo-200 hover:bg-surface-secondary hover:shadow-md">
                        Időpont foglalása
                        <svg class="arrow-slide h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                        </svg>
                    </a>
                </div>

                <div class="stagger-item card-glow rounded-2xl border border-blue-100 bg-linear-to-br from-blue-50/40 to-surface-primary p-8 text-center"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <h3 class="mb-3 text-lg font-bold text-text-primary">Regisztráció és kipróbálás</h3>
                    <p class="mb-6 text-sm leading-relaxed text-text-secondary">Fedezze fel a platform teljes funkcionalitását. Ismerje meg a modulokat és kezdjen el dolgozni azonnal.</p>
                    <a href="{{ route('register') }}"
                        class="group inline-flex items-center gap-2 rounded-full bg-indigo-600 px-5 py-2.5 text-sm font-medium text-white transition-all hover:bg-indigo-700 hover:shadow-lg"
                        style="box-shadow: 0 1px 2px rgba(0,0,0,0.05);">
                        Regisztráció
                        <svg class="arrow-slide h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </section>
</div>
