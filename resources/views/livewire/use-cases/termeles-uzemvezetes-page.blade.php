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
            0% { box-shadow: 0 0 0 0 rgba(249, 115, 22, 0.4); }
            70% { box-shadow: 0 0 0 6px rgba(249, 115, 22, 0); }
            100% { box-shadow: 0 0 0 0 rgba(249, 115, 22, 0); }
        }
        .pulse-dot { animation: pulse-ring 2s ease infinite; }

        /* Card hover glow */
        .card-glow {
            transition: all 0.4s cubic-bezier(0, 0, 0.2, 1);
        }
        .card-glow:hover {
            box-shadow: 0 8px 30px -8px rgba(249, 115, 22, 0.15), 0 2px 8px rgba(0,0,0,0.04) !important;
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

        /* OEE bar animation */
        @keyframes oee-grow {
            from { transform: scaleX(0); transform-origin: left; }
            to { transform: scaleX(1); transform-origin: left; }
        }
        .oee-bar {
            animation: oee-grow 0.8s cubic-bezier(0, 0, 0.2, 1) both;
        }

        /* Machine dot pulse */
        @keyframes machine-pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.4; }
        }
        .machine-dot-pulse { animation: machine-pulse 2s ease infinite; }

        /* Pill float */
        .pill-float {
            transition: transform 0.35s cubic-bezier(0, 0, 0.2, 1), box-shadow 0.35s cubic-bezier(0, 0, 0.2, 1);
        }
        .pill-float:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 20px -4px rgba(249, 115, 22, 0.12);
        }

        /* Smooth scroll for anchor links */
        html { scroll-behavior: smooth; }
    </style>

    {{-- Hero Section --}}
    <section class="bg-linear-to-b from-orange-50 to-surface-secondary">
        <div class="mx-auto max-w-7xl px-6 py-16 lg:py-24">
            <div class="grid grid-cols-1 items-center gap-12 lg:grid-cols-2">
                {{-- Hero Text --}}
                <div class="reveal">
                    <div class="badge-gradient mb-8 inline-flex items-center gap-2 rounded-full border border-border-light/80 bg-surface-primary px-4 py-1.5"
                        style="box-shadow: 0 1px 3px rgba(0,0,0,0.04);">
                        <span class="pulse-dot h-1.5 w-1.5 rounded-full bg-linear-to-r from-orange-500 via-amber-500 to-rose-500"></span>
                        <span class="text-sm font-medium text-text-primary">Ipari termelésirányítási megoldások</span>
                    </div>

                    <h1 class="mb-6 text-4xl leading-tight tracking-tight text-text-primary md:text-5xl lg:text-[3.5rem]"
                        style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                        Irányítsa a termelést<br>
                        — ne a termelés irányítsa Önt
                    </h1>

                    <p class="mb-10 max-w-xl text-lg text-text-secondary lg:text-xl">
                        Az ipari gyártásban a tervezett és a tényleges teljesítmény közötti rés milliókat visz el. A Cégem360 valós idejű üzemirányítást, OEE-mérést, karbantartás-tervezést és MI alapú optimalizálást ad a termelési vezetők kezébe.
                    </p>

                    <div class="flex flex-wrap items-center gap-4">
                        <a href="{{ route('contact') }}"
                            class="group inline-flex items-center gap-2 rounded-full bg-orange-600 px-6 py-3 text-base font-medium text-white transition-all hover:bg-orange-700 hover:shadow-lg"
                            style="box-shadow: 0 1px 2px rgba(0,0,0,0.05);">
                            <span>Online konzultáció</span>
                            <svg class="arrow-slide h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                            </svg>
                        </a>
                        <a href="#megoldasok"
                            class="inline-flex items-center gap-2 rounded-full border border-border-light bg-surface-primary px-6 py-3 text-base font-medium text-text-primary transition-all hover:border-orange-200 hover:bg-surface-secondary hover:shadow-md">
                            Megoldások áttekintése
                        </a>
                    </div>
                </div>

                {{-- OEE Dashboard Visual --}}
                <div class="reveal-right">
                    <div class="rounded-2xl border border-border-light bg-surface-primary p-6"
                        style="box-shadow: 0 4px 20px -4px rgba(0,0,0,0.06);">
                        <div class="mb-4 flex items-center justify-between border-b border-border-light pb-4">
                            <div>
                                <span class="block text-sm font-bold text-text-primary">Üzemi vezérlőpult</span>
                                <span class="block text-[10px] text-text-tertiary">Valós idejű termelési adatok</span>
                            </div>
                            <span class="inline-flex items-center gap-1.5 rounded-md border border-orange-100 bg-orange-50 px-2.5 py-1 text-[10px] font-semibold text-orange-600">
                                <span class="machine-dot-pulse h-1.5 w-1.5 rounded-full bg-orange-500"></span>
                                A műszak · Élő
                            </span>
                        </div>

                        {{-- OEE Gauges --}}
                        <div class="mb-4 grid grid-cols-3 gap-2.5">
                            <div class="rounded-lg border border-border-light bg-surface-secondary p-2.5 text-center">
                                <span class="mb-1 block text-[10px] font-semibold uppercase tracking-wider text-text-tertiary">OEE összesen</span>
                                <span class="block text-xl font-bold text-orange-600" style="font-family: 'JetBrains Mono', monospace;">78%</span>
                                <div class="mt-1.5 h-1.5 w-full overflow-hidden rounded-full bg-surface-primary">
                                    <div class="oee-bar h-1.5 rounded-full bg-orange-400" style="width: 78%; animation-delay: 0.1s;"></div>
                                </div>
                            </div>
                            <div class="rounded-lg border border-border-light bg-surface-secondary p-2.5 text-center">
                                <span class="mb-1 block text-[10px] font-semibold uppercase tracking-wider text-text-tertiary">Rendelk. állás</span>
                                <span class="block text-xl font-bold text-success-600" style="font-family: 'JetBrains Mono', monospace;">92%</span>
                                <div class="mt-1.5 h-1.5 w-full overflow-hidden rounded-full bg-surface-primary">
                                    <div class="oee-bar h-1.5 rounded-full bg-success-400" style="width: 92%; animation-delay: 0.2s;"></div>
                                </div>
                            </div>
                            <div class="rounded-lg border border-border-light bg-surface-secondary p-2.5 text-center">
                                <span class="mb-1 block text-[10px] font-semibold uppercase tracking-wider text-text-tertiary">Teljesítmény</span>
                                <span class="block text-xl font-bold text-amber-600" style="font-family: 'JetBrains Mono', monospace;">84%</span>
                                <div class="mt-1.5 h-1.5 w-full overflow-hidden rounded-full bg-surface-primary">
                                    <div class="oee-bar h-1.5 rounded-full bg-amber-400" style="width: 84%; animation-delay: 0.3s;"></div>
                                </div>
                            </div>
                        </div>

                        {{-- Machine Status Rows --}}
                        <div class="mb-4 space-y-1.5">
                            <div class="flex items-center justify-between rounded-lg bg-surface-secondary px-3 py-2">
                                <div class="flex items-center gap-2">
                                    <span class="h-2 w-2 rounded-full bg-success-500" style="box-shadow: 0 0 6px rgba(16,185,129,0.5);"></span>
                                    <span class="text-xs font-medium text-text-secondary">CNC marógép #1</span>
                                </div>
                                <span class="rounded bg-success-50 px-2 py-0.5 text-[10px] font-semibold text-success-700">Gyárt</span>
                                <span class="text-xs font-bold text-text-primary" style="font-family: 'JetBrains Mono', monospace;">94%</span>
                                <span class="text-[11px] text-text-tertiary" style="font-family: 'JetBrains Mono', monospace;">142/160 db</span>
                            </div>
                            <div class="flex items-center justify-between rounded-lg bg-surface-secondary px-3 py-2">
                                <div class="flex items-center gap-2">
                                    <span class="h-2 w-2 rounded-full bg-success-500" style="box-shadow: 0 0 6px rgba(16,185,129,0.5);"></span>
                                    <span class="text-xs font-medium text-text-secondary">Hegesztő robot</span>
                                </div>
                                <span class="rounded bg-success-50 px-2 py-0.5 text-[10px] font-semibold text-success-700">Gyárt</span>
                                <span class="text-xs font-bold text-text-primary" style="font-family: 'JetBrains Mono', monospace;">87%</span>
                                <span class="text-[11px] text-text-tertiary" style="font-family: 'JetBrains Mono', monospace;">56/68 db</span>
                            </div>
                            <div class="flex items-center justify-between rounded-lg bg-surface-secondary px-3 py-2">
                                <div class="flex items-center gap-2">
                                    <span class="h-2 w-2 rounded-full bg-amber-500" style="box-shadow: 0 0 6px rgba(245,158,11,0.4);"></span>
                                    <span class="text-xs font-medium text-text-secondary">Lézervágó</span>
                                </div>
                                <span class="rounded bg-amber-50 px-2 py-0.5 text-[10px] font-semibold text-amber-700">Átállás</span>
                                <span class="text-xs font-bold text-text-primary" style="font-family: 'JetBrains Mono', monospace;">71%</span>
                                <span class="text-[11px] text-text-tertiary" style="font-family: 'JetBrains Mono', monospace;">—</span>
                            </div>
                            <div class="flex items-center justify-between rounded-lg bg-surface-secondary px-3 py-2">
                                <div class="flex items-center gap-2">
                                    <span class="h-2 w-2 rounded-full bg-danger-500" style="box-shadow: 0 0 6px rgba(244,63,94,0.4);"></span>
                                    <span class="text-xs font-medium text-text-secondary">Présgép #2</span>
                                </div>
                                <span class="rounded bg-danger-50 px-2 py-0.5 text-[10px] font-semibold text-danger-700">Karbantartás</span>
                                <span class="text-xs font-bold text-text-primary" style="font-family: 'JetBrains Mono', monospace;">0%</span>
                                <span class="text-[11px] font-semibold text-danger-600" style="font-family: 'JetBrains Mono', monospace;">14:30 ETA</span>
                            </div>
                        </div>

                        {{-- Production Progress Bar --}}
                        <div class="mb-4 rounded-lg border border-border-light bg-surface-secondary px-3 py-2.5">
                            <div class="mb-1.5 flex items-center justify-between">
                                <span class="text-xs font-semibold text-text-secondary">Napi termelési cél teljesítés</span>
                                <span class="text-xs font-bold text-orange-600" style="font-family: 'JetBrains Mono', monospace;">73%</span>
                            </div>
                            <div class="h-2 w-full overflow-hidden rounded-full bg-surface-primary">
                                <div class="oee-bar h-2 rounded-full bg-linear-to-r from-orange-400 to-amber-400" style="width: 73%; animation-delay: 0.5s;"></div>
                            </div>
                        </div>

                        {{-- Status bar --}}
                        <div class="flex gap-5 border-t border-border-light pt-3">
                            <span class="flex items-center gap-1.5 text-[11px] text-text-tertiary">
                                <span class="h-2 w-2 rounded-full bg-success-500"></span> 3 gép üzemben
                            </span>
                            <span class="flex items-center gap-1.5 text-[11px] text-text-tertiary">
                                <span class="h-2 w-2 rounded-full bg-amber-500"></span> 1 átállás alatt
                            </span>
                            <span class="flex items-center gap-1.5 text-[11px] text-text-tertiary">
                                <span class="h-2 w-2 rounded-full bg-danger-500"></span> 1 karbantartás
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
                <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-orange-600">A kihívás</p>
                <h2 class="mb-4 text-3xl text-text-primary md:text-4xl" style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                    Ezek fékezik le az ipari termelést
                </h2>
                <p class="max-w-xl text-lg text-text-secondary">
                    Ismerős helyzetek gyártó, szerelő és feldolgozóipari cégek üzemvezetőinek.
                </p>
            </div>

            <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4" data-stagger>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-7"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="icon-hover mb-5 flex h-12 w-12 items-center justify-center rounded-xl bg-danger-50">
                        <svg class="h-6 w-6 text-danger-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="mb-2 text-lg font-bold text-text-primary">Nem tervezett leállások</h3>
                    <p class="text-sm leading-relaxed text-text-secondary">A gépek figyelmeztetés nélkül állnak le. Nincs prediktív karbantartás, nincs élő gépállapot-figyelés — a leállás mindig meglepetés.</p>
                </div>

                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-7"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="icon-hover mb-5 flex h-12 w-12 items-center justify-center rounded-xl bg-warning-50">
                        <svg class="h-6 w-6 text-warning-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <h3 class="mb-2 text-lg font-bold text-text-primary">Papír alapú gyártáskísérés</h3>
                    <p class="text-sm leading-relaxed text-text-secondary">A gyártási adatok papíros munkalapokon, kézzel írt jegyzetekben vannak. Napokba telik összegyűjteni, mi történt a műszakban.</p>
                </div>

                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-7"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="icon-hover mb-5 flex h-12 w-12 items-center justify-center rounded-xl bg-violet-50">
                        <svg class="h-6 w-6 text-violet-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                    </div>
                    <h3 class="mb-2 text-lg font-bold text-text-primary">Ismeretlen OEE és hatékonyság</h3>
                    <p class="text-sm leading-relaxed text-text-secondary">Nem tudja, mekkora a tényleges gépkihasználtság, mennyi az átállási idő, és hol keletkezik a legtöbb selejt. Mérés nélkül nincs javítás.</p>
                </div>

                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-7"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="icon-hover mb-5 flex h-12 w-12 items-center justify-center rounded-xl bg-orange-50">
                        <svg class="h-6 w-6 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                        </svg>
                    </div>
                    <h3 class="mb-2 text-lg font-bold text-text-primary">Gyártás–értékesítés szinkronhiba</h3>
                    <p class="text-sm leading-relaxed text-text-secondary">Az értékesítés ígér, a gyártás nem tudja tartani. Nincs valós idejű kapacitásinformáció — a határidők csúsznak, az ügyfelek csalódnak.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Target Audience Section --}}
    <section class="bg-surface-secondary py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-6">
            <div class="reveal mb-12">
                <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-orange-600">Ki használja?</p>
                <h2 class="mb-4 text-3xl text-text-primary md:text-4xl" style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                    Az üzemtől az igazgatóságig — valós idejű termelési adat
                </h2>
                <p class="max-w-xl text-lg text-text-secondary">
                    A Cégem360 minden szinten releváns termelési információt ad.
                </p>
            </div>

            <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4" data-stagger>
                <div class="stagger-item card-glow group relative overflow-hidden rounded-2xl border border-border-light bg-surface-primary p-7"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="absolute inset-x-0 top-0 h-0.5 bg-linear-to-r from-transparent via-orange-400 to-transparent opacity-0 transition-opacity group-hover:opacity-100"></div>
                    <span class="mb-3 block text-3xl">🏭</span>
                    <span class="mb-2 block text-[10px] font-semibold uppercase tracking-wider text-orange-600">Üzemvezető</span>
                    <h3 class="mb-2 text-base font-bold text-text-primary">Üzem- és műszakvezetők</h3>
                    <p class="text-sm leading-relaxed text-text-secondary">Élő gépállapot, műszak-teljesítmény, OEE dashboard és azonnali probléma-riasztás — a termelés irányítópultja.</p>
                </div>

                <div class="stagger-item card-glow group relative overflow-hidden rounded-2xl border border-border-light bg-surface-primary p-7"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="absolute inset-x-0 top-0 h-0.5 bg-linear-to-r from-transparent via-orange-400 to-transparent opacity-0 transition-opacity group-hover:opacity-100"></div>
                    <span class="mb-3 block text-3xl">⚙️</span>
                    <span class="mb-2 block text-[10px] font-semibold uppercase tracking-wider text-orange-600">Termelési igazgató</span>
                    <h3 class="mb-2 text-base font-bold text-text-primary">Termelési igazgatók</h3>
                    <p class="text-sm leading-relaxed text-text-secondary">Kapacitástervezés, termelési terv vs. tény, selejt-elemzés és karbantartási ütemterv — stratégiai szinten.</p>
                </div>

                <div class="stagger-item card-glow group relative overflow-hidden rounded-2xl border border-border-light bg-surface-primary p-7"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="absolute inset-x-0 top-0 h-0.5 bg-linear-to-r from-transparent via-orange-400 to-transparent opacity-0 transition-opacity group-hover:opacity-100"></div>
                    <span class="mb-3 block text-3xl">🔧</span>
                    <span class="mb-2 block text-[10px] font-semibold uppercase tracking-wider text-orange-600">Karbantartás</span>
                    <h3 class="mb-2 text-base font-bold text-text-primary">Karbantartási vezetők</h3>
                    <p class="text-sm leading-relaxed text-text-secondary">Prediktív karbantartás ütemterv, gépállapot-előzmények, alkatrész-készlet és karbantartási munkalapok — digitálisan.</p>
                </div>

                <div class="stagger-item card-glow group relative overflow-hidden rounded-2xl border border-border-light bg-surface-primary p-7"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="absolute inset-x-0 top-0 h-0.5 bg-linear-to-r from-transparent via-orange-400 to-transparent opacity-0 transition-opacity group-hover:opacity-100"></div>
                    <span class="mb-3 block text-3xl">📋</span>
                    <span class="mb-2 block text-[10px] font-semibold uppercase tracking-wider text-orange-600">Minőségirányítás</span>
                    <h3 class="mb-2 text-base font-bold text-text-primary">Minőségirányítási vezető</h3>
                    <p class="text-sm leading-relaxed text-text-secondary">Minőségellenőrzési protokollok, selejt-nyomonkövetés, nem-megfelelőség kezelés és gyártástétel-nyomonkövethetőség.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Core Toolkit Section --}}
    <section class="bg-surface-primary py-16 lg:py-24" id="megoldasok">
        <div class="mx-auto max-w-7xl px-6">
            <div class="reveal mb-12">
                <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-orange-600">Termelési eszköztár</p>
                <h2 class="mb-4 text-3xl text-text-primary md:text-4xl" style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                    4 kulcsmodul az üzemirányításhoz
                </h2>
                <p class="max-w-xl text-lg text-text-secondary">
                    Ezek a modulok együttesen adják a Cégem360 termelési intelligencia rétegét.
                </p>
            </div>

            <div class="grid grid-cols-1 gap-6 md:grid-cols-2" data-stagger>
                {{-- Gyártásirányítás --}}
                <div class="stagger-item card-glow group rounded-2xl border border-border-light bg-surface-primary p-8"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="mb-5 flex items-center gap-4">
                        <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-orange-50">
                            <x-module-icon module="gyartas" class="h-5 w-5 text-orange-600" />
                        </div>
                        <div>
                            <span class="block text-sm font-bold text-text-primary">Gyártásirányítás</span>
                            <span class="text-xs text-text-tertiary">Termelés és minőség</span>
                        </div>
                    </div>
                    <h3 class="mb-3 text-lg font-bold text-text-primary">A termelési folyamat teljes irányítása</h3>
                    <p class="mb-5 text-sm leading-relaxed text-text-secondary">
                        Gantt-alapú gyártástervezés, kapacitás-ütemezés, BOM-kezelés, OEE mérés, minőségellenőrzés és selejt-követés. A gyártás központi agya — valós időben.
                    </p>
                    <div class="mb-5 grid grid-cols-2 gap-2">
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><span class="feature-dot h-1 w-1 rounded-full bg-orange-400"></span>Gantt gyártástervezés</span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><span class="feature-dot h-1 w-1 rounded-full bg-orange-400"></span>OEE mérés és elemzés</span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><span class="feature-dot h-1 w-1 rounded-full bg-orange-400"></span>Kapacitás-ütemezés</span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><span class="feature-dot h-1 w-1 rounded-full bg-orange-400"></span>BOM és darabjegyzék</span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><span class="feature-dot h-1 w-1 rounded-full bg-orange-400"></span>Minőségellenőrzés</span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><span class="feature-dot h-1 w-1 rounded-full bg-orange-400"></span>Selejt-nyomonkövetés</span>
                    </div>
                    <a href="{{ route('products.gyartas') }}" class="inline-flex items-center gap-1.5 text-sm font-semibold text-orange-600 transition-colors hover:text-orange-700">
                        Részletek megtekintése <svg class="arrow-slide h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" /></svg>
                    </a>
                </div>

                {{-- Digitális munkalap --}}
                <div class="stagger-item card-glow group rounded-2xl border border-border-light bg-surface-primary p-8"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="mb-5 flex items-center gap-4">
                        <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-amber-50">
                            <x-module-icon module="szerviz" class="h-5 w-5 text-amber-600" />
                        </div>
                        <div>
                            <span class="block text-sm font-bold text-text-primary">Digitális munkalap</span>
                            <span class="text-xs text-text-tertiary">Üzemi adatrögzítés</span>
                        </div>
                    </div>
                    <h3 class="mb-3 text-lg font-bold text-text-primary">Gyártási és karbantartási munkalapok — digitálisan</h3>
                    <p class="mb-5 text-sm leading-relaxed text-text-secondary">
                        A gépkezelő az üzemben rögzíti a műszak adatait: legyártott mennyiség, selejt, leállás-ok, anyagfelhasználás, fotódokumentáció — azonnal a rendszerben.
                    </p>
                    <div class="mb-5 grid grid-cols-2 gap-2">
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><span class="feature-dot h-1 w-1 rounded-full bg-amber-400"></span>Műszak-jelentés</span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><span class="feature-dot h-1 w-1 rounded-full bg-amber-400"></span>Selejt-rögzítés ok-kóddal</span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><span class="feature-dot h-1 w-1 rounded-full bg-amber-400"></span>Karbantartási munkalap</span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><span class="feature-dot h-1 w-1 rounded-full bg-amber-400"></span>Fotódokumentáció</span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><span class="feature-dot h-1 w-1 rounded-full bg-amber-400"></span>Anyagfelhasználás rögzítés</span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><span class="feature-dot h-1 w-1 rounded-full bg-amber-400"></span>Offline mód</span>
                    </div>
                    <a href="{{ route('products.szerviz') }}" class="inline-flex items-center gap-1.5 text-sm font-semibold text-amber-600 transition-colors hover:text-amber-700">
                        Részletek megtekintése <svg class="arrow-slide h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" /></svg>
                    </a>
                </div>

                {{-- Automatizálás --}}
                <div class="stagger-item card-glow group rounded-2xl border border-border-light bg-surface-primary p-8"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="mb-5 flex items-center gap-4">
                        <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-violet-50">
                            <x-module-icon module="automatizalas" class="h-5 w-5 text-violet-600" />
                        </div>
                        <div>
                            <span class="block text-sm font-bold text-text-primary">Automatizálás</span>
                            <span class="text-xs text-text-tertiary">Termelési workflow-k</span>
                        </div>
                    </div>
                    <h3 class="mb-3 text-lg font-bold text-text-primary">Riasztások, eszkaláció és automatikus feladatkiosztás</h3>
                    <p class="mb-5 text-sm leading-relaxed text-text-secondary">
                        Gépállás — riasztás a karbantartásnak. Selejt-limit túllépés — minőségirányítási értesítés. Kapacitáshiány — eszkaláció. Kód nélkül, drag-and-drop workflow-val.
                    </p>
                    <div class="mb-5 grid grid-cols-2 gap-2">
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><span class="feature-dot h-1 w-1 rounded-full bg-violet-400"></span>Gépállás-riasztás</span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><span class="feature-dot h-1 w-1 rounded-full bg-violet-400"></span>Selejt-limit trigger</span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><span class="feature-dot h-1 w-1 rounded-full bg-violet-400"></span>Karbantartás-ütemezés</span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><span class="feature-dot h-1 w-1 rounded-full bg-violet-400"></span>Műszakváltás-értesítés</span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><span class="feature-dot h-1 w-1 rounded-full bg-violet-400"></span>Eszkaláció-lánc</span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><span class="feature-dot h-1 w-1 rounded-full bg-violet-400"></span>Kapacitás-figyelmeztetés</span>
                    </div>
                    <a href="{{ route('products.automatizalas') }}" class="inline-flex items-center gap-1.5 text-sm font-semibold text-violet-600 transition-colors hover:text-violet-700">
                        Részletek megtekintése <svg class="arrow-slide h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" /></svg>
                    </a>
                </div>

                {{-- DataMind --}}
                <div class="stagger-item card-glow group rounded-2xl border border-border-light bg-surface-primary p-8"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="mb-5 flex items-center gap-4">
                        <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-blue-50">
                            <x-module-icon module="datamind" class="h-5 w-5 text-blue-600" />
                        </div>
                        <div>
                            <span class="block text-sm font-bold text-text-primary">DataMind</span>
                            <span class="text-xs text-text-tertiary">MI alapú termelés-optimalizálás</span>
                        </div>
                    </div>
                    <h3 class="mb-3 text-lg font-bold text-text-primary">Prediktív karbantartás és termelési mintafelismerés</h3>
                    <p class="mb-5 text-sm leading-relaxed text-text-secondary">
                        Az MI azonosítja a karbantartási szükségletet, mielőtt leállás történne. Selejt-mintázat felismerés, OEE trend predikció és kapacitás-optimalizálási javaslatok.
                    </p>
                    <div class="mb-5 grid grid-cols-2 gap-2">
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><span class="feature-dot h-1 w-1 rounded-full bg-blue-400"></span>Prediktív karbantartás</span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><span class="feature-dot h-1 w-1 rounded-full bg-blue-400"></span>Selejt-mintafelismerés</span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><span class="feature-dot h-1 w-1 rounded-full bg-blue-400"></span>OEE trend előrejelzés</span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><span class="feature-dot h-1 w-1 rounded-full bg-blue-400"></span>Kapacitás-optimalizálás</span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><span class="feature-dot h-1 w-1 rounded-full bg-blue-400"></span>Leállás-ok elemzés</span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><span class="feature-dot h-1 w-1 rounded-full bg-blue-400"></span>Automatikus összefoglalók</span>
                    </div>
                    <a href="{{ route('products.datamind') }}" class="inline-flex items-center gap-1.5 text-sm font-semibold text-blue-600 transition-colors hover:text-blue-700">
                        Részletek megtekintése <svg class="arrow-slide h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" /></svg>
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{-- Production Lifecycle Section --}}
    <section class="bg-surface-secondary py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-6">
            <div class="reveal mb-12">
                <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-orange-600">Termelési ciklus</p>
                <h2 class="mb-4 text-3xl text-text-primary md:text-4xl" style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                    A megrendeléstől a kiszállításig — egy zárt rendszerben
                </h2>
                <p class="max-w-xl text-lg text-text-secondary">
                    Minden fázis mért, dokumentált és valós idejű — nem utólagos adatgyűjtés.
                </p>
            </div>

            <div class="grid grid-cols-2 gap-5 sm:grid-cols-3 lg:grid-cols-6" data-stagger>
                <div class="stagger-item text-center">
                    <div class="mx-auto mb-4 flex h-16 w-16 items-center justify-center rounded-full border-2 border-orange-200 bg-surface-primary text-xl font-bold text-orange-600">01</div>
                    <h4 class="mb-1 text-sm font-bold text-text-primary">Megrendelés</h4>
                    <p class="mb-2 text-xs text-text-tertiary">Vevői rendelés beérkezése, gyártási utasítás generálás</p>
                    <div class="flex flex-wrap justify-center gap-1">
                        <span class="rounded bg-orange-50 px-1.5 py-0.5 text-[9px] font-semibold text-orange-600">Értékesítés</span>
                        <span class="rounded bg-orange-50 px-1.5 py-0.5 text-[9px] font-semibold text-orange-600">CRM</span>
                    </div>
                </div>
                <div class="stagger-item text-center">
                    <div class="mx-auto mb-4 flex h-16 w-16 items-center justify-center rounded-full border-2 border-amber-200 bg-surface-primary text-xl font-bold text-amber-600">02</div>
                    <h4 class="mb-1 text-sm font-bold text-text-primary">Tervezés</h4>
                    <p class="mb-2 text-xs text-text-tertiary">Gantt-ütemezés, kapacitás-ellenőrzés, anyagszükséglet</p>
                    <div class="flex flex-wrap justify-center gap-1">
                        <span class="rounded bg-amber-50 px-1.5 py-0.5 text-[9px] font-semibold text-amber-600">Gyártásirányítás</span>
                        <span class="rounded bg-amber-50 px-1.5 py-0.5 text-[9px] font-semibold text-amber-600">Beszerzés</span>
                    </div>
                </div>
                <div class="stagger-item text-center">
                    <div class="mx-auto mb-4 flex h-16 w-16 items-center justify-center rounded-full border-2 border-teal-200 bg-surface-primary text-xl font-bold text-teal-600">03</div>
                    <h4 class="mb-1 text-sm font-bold text-text-primary">Gyártás</h4>
                    <p class="mb-2 text-xs text-text-tertiary">Valós idejű gépállapot, OEE, műszak-adatok rögzítése</p>
                    <div class="flex flex-wrap justify-center gap-1">
                        <span class="rounded bg-teal-50 px-1.5 py-0.5 text-[9px] font-semibold text-teal-600">Gyártásirányítás</span>
                        <span class="rounded bg-teal-50 px-1.5 py-0.5 text-[9px] font-semibold text-teal-600">Munkalap</span>
                    </div>
                </div>
                <div class="stagger-item text-center">
                    <div class="mx-auto mb-4 flex h-16 w-16 items-center justify-center rounded-full border-2 border-success-200 bg-surface-primary text-xl font-bold text-success-600">04</div>
                    <h4 class="mb-1 text-sm font-bold text-text-primary">Minőség</h4>
                    <p class="mb-2 text-xs text-text-tertiary">Gyártásközi és végellenőrzés, selejt-kezelés, tétel-nyomonkövetés</p>
                    <div class="flex flex-wrap justify-center gap-1">
                        <span class="rounded bg-success-50 px-1.5 py-0.5 text-[9px] font-semibold text-success-600">Gyártásirányítás</span>
                    </div>
                </div>
                <div class="stagger-item text-center">
                    <div class="mx-auto mb-4 flex h-16 w-16 items-center justify-center rounded-full border-2 border-blue-200 bg-surface-primary text-xl font-bold text-blue-600">05</div>
                    <h4 class="mb-1 text-sm font-bold text-text-primary">Kiszállítás</h4>
                    <p class="mb-2 text-xs text-text-tertiary">Készáru bevételezés, szállítólevél, logisztikai koordináció</p>
                    <div class="flex flex-wrap justify-center gap-1">
                        <span class="rounded bg-blue-50 px-1.5 py-0.5 text-[9px] font-semibold text-blue-600">Beszerzés</span>
                        <span class="rounded bg-blue-50 px-1.5 py-0.5 text-[9px] font-semibold text-blue-600">Értékesítés</span>
                    </div>
                </div>
                <div class="stagger-item text-center">
                    <div class="mx-auto mb-4 flex h-16 w-16 items-center justify-center rounded-full border-2 border-violet-200 bg-surface-primary text-xl font-bold text-violet-600">06</div>
                    <h4 class="mb-1 text-sm font-bold text-text-primary">Elemzés</h4>
                    <p class="mb-2 text-xs text-text-tertiary">Gyártási önköltség, OEE riport, MI javaslatok a következő ciklusra</p>
                    <div class="flex flex-wrap justify-center gap-1">
                        <span class="rounded bg-violet-50 px-1.5 py-0.5 text-[9px] font-semibold text-violet-600">Kontrolling</span>
                        <span class="rounded bg-violet-50 px-1.5 py-0.5 text-[9px] font-semibold text-violet-600">DataMind</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Ecosystem Section --}}
    <section class="bg-surface-primary py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-6">
            <div class="reveal mb-12 grid grid-cols-1 gap-8 lg:grid-cols-2">
                <div>
                    <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-orange-600">Teljes ökoszisztéma</p>
                    <h2 class="text-3xl text-text-primary md:text-4xl" style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                        Mind a 11 modul a termelés szolgálatában
                    </h2>
                </div>
                <p class="text-lg leading-relaxed text-text-secondary lg:mt-8">
                    A termelés nem légüres térben működik — az értékesítés generálja a megrendeléseket, a beszerzés biztosítja az anyagot, a kontrolling méri a jövedelmezőséget, a szerviz karbantart. Amikor mindez egy rendszerben van, az üzemvezető a tényleges termelésre koncentrálhat — nem az információgyűjtésre.
                </p>
            </div>

            <div class="grid grid-cols-2 gap-4 sm:grid-cols-4 lg:grid-cols-7" data-stagger>
                <div class="stagger-item pill-float rounded-xl border border-border-light bg-surface-primary p-4 text-center"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="mx-auto mb-3 flex h-10 w-10 items-center justify-center rounded-lg bg-cyan-50">
                        <x-module-icon module="beszerzes" class="h-5 w-5 text-cyan-600" />
                    </div>
                    <h4 class="mb-1 text-xs font-bold text-text-primary">Beszerzés-logisztika</h4>
                    <p class="text-[10px] leading-snug text-text-tertiary">Anyagszükséglet automatikusan a gyártási tervből</p>
                </div>
                <div class="stagger-item pill-float rounded-xl border border-border-light bg-surface-primary p-4 text-center"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="mx-auto mb-3 flex h-10 w-10 items-center justify-center rounded-lg bg-success-50">
                        <x-module-icon module="ertekesites" class="h-5 w-5 text-success-600" />
                    </div>
                    <h4 class="mb-1 text-xs font-bold text-text-primary">CRM & Értékesítés</h4>
                    <p class="text-[10px] leading-snug text-text-tertiary">Megrendelés automatikusan gyártási utasítást generál</p>
                </div>
                <div class="stagger-item pill-float rounded-xl border border-border-light bg-surface-primary p-4 text-center"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="mx-auto mb-3 flex h-10 w-10 items-center justify-center rounded-lg bg-indigo-50">
                        <x-module-icon module="kontrolling" class="h-5 w-5 text-indigo-600" />
                    </div>
                    <h4 class="mb-1 text-xs font-bold text-text-primary">Kontrolling</h4>
                    <p class="text-[10px] leading-snug text-text-tertiary">Gyártási önköltség valós időben: anyag, munkaóra, gépköltség</p>
                </div>
                <div class="stagger-item pill-float rounded-xl border border-border-light bg-surface-primary p-4 text-center"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="mx-auto mb-3 flex h-10 w-10 items-center justify-center rounded-lg bg-blue-50">
                        <x-module-icon module="marketinghub" class="h-5 w-5 text-blue-600" />
                    </div>
                    <h4 class="mb-1 text-xs font-bold text-text-primary">MarketingHub</h4>
                    <p class="text-[10px] leading-snug text-text-tertiary">Kereslet-előrejelzés marketing adatokból</p>
                </div>
                <div class="stagger-item pill-float rounded-xl border border-border-light bg-surface-primary p-4 text-center"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="mx-auto mb-3 flex h-10 w-10 items-center justify-center rounded-lg bg-rose-50">
                        <x-module-icon module="seo" class="h-5 w-5 text-rose-600" />
                    </div>
                    <h4 class="mb-1 text-xs font-bold text-text-primary">SEO Eszköz</h4>
                    <p class="text-[10px] leading-snug text-text-tertiary">Referencia-projektek online láthatósága új megrendeléseket hoz</p>
                </div>
                <div class="stagger-item pill-float rounded-xl border border-border-light bg-surface-primary p-4 text-center"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="mx-auto mb-3 flex h-10 w-10 items-center justify-center rounded-lg bg-teal-50">
                        <x-module-icon module="ai-chat" class="h-5 w-5 text-teal-600" />
                    </div>
                    <h4 class="mb-1 text-xs font-bold text-text-primary">AI Chat</h4>
                    <p class="text-[10px] leading-snug text-text-tertiary">Belső státusz-lekérdezés: hol tart a gyártás — azonnal</p>
                </div>
                <div class="stagger-item pill-float rounded-xl border border-border-light bg-surface-primary p-4 text-center"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="mx-auto mb-3 flex h-10 w-10 items-center justify-center rounded-lg bg-violet-50">
                        <x-module-icon module="automatizalas" class="h-5 w-5 text-violet-600" />
                    </div>
                    <h4 class="mb-1 text-xs font-bold text-text-primary">Automatizálás</h4>
                    <p class="text-[10px] leading-snug text-text-tertiary">Gépállás-riasztás, karbantartási ütemezés automatikusan</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Stats Section --}}
    <section class="bg-surface-secondary py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-6">
            <div class="reveal mb-12 text-center">
                <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-orange-600">Eredmények</p>
                <h2 class="text-3xl text-text-primary md:text-4xl" style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                    Mérhető javulás a termelési teljesítményben
                </h2>
            </div>

            <div class="grid grid-cols-2 gap-5 lg:grid-cols-4" data-stagger data-counter-trigger>
                <div class="stagger-item stat-hover rounded-2xl border border-border-light bg-surface-primary p-8 text-center"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <span class="stat-value block text-4xl font-bold text-orange-600 lg:text-5xl" style="font-family: 'JetBrains Mono', monospace;"
                        data-count="25" data-prefix="+" data-suffix="%">0%</span>
                    <span class="mt-2 block text-sm text-text-secondary">OEE javulás</span>
                </div>
                <div class="stagger-item stat-hover rounded-2xl border border-border-light bg-surface-primary p-8 text-center"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <span class="stat-value block text-4xl font-bold text-success-600 lg:text-5xl" style="font-family: 'JetBrains Mono', monospace;"
                        data-count="40" data-prefix="-" data-suffix="%">0%</span>
                    <span class="mt-2 block text-sm text-text-secondary">Nem tervezett leállás</span>
                </div>
                <div class="stagger-item stat-hover rounded-2xl border border-border-light bg-surface-primary p-8 text-center"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <span class="stat-value block text-4xl font-bold text-amber-600 lg:text-5xl" style="font-family: 'JetBrains Mono', monospace;"
                        data-count="30" data-prefix="-" data-suffix="%">0%</span>
                    <span class="mt-2 block text-sm text-text-secondary">Selejt-arány csökkenés</span>
                </div>
                <div class="stagger-item stat-hover rounded-2xl border border-border-light bg-surface-primary p-8 text-center"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <span class="stat-value block text-4xl font-bold text-blue-600 lg:text-5xl" style="font-family: 'JetBrains Mono', monospace;"
                        data-count="65" data-prefix="-" data-suffix="%">0%</span>
                    <span class="mt-2 block text-sm text-text-secondary">Adminisztrációs idő</span>
                </div>
            </div>
        </div>
    </section>

    {{-- Use Cases Section --}}
    <section class="bg-surface-primary py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-6">
            <div class="reveal mb-12">
                <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-orange-600">Felhasználási esetek</p>
                <h2 class="mb-4 text-3xl text-text-primary md:text-4xl" style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                    Így használják ipari üzemvezetők
                </h2>
            </div>

            <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3" data-stagger>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-7"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <span class="mb-4 block text-xs font-semibold text-text-tertiary" style="font-family: 'JetBrains Mono', monospace;">01</span>
                    <h3 class="mb-2 text-base font-bold text-text-primary">OEE mérés és gépkihasználtság-elemzés</h3>
                    <p class="mb-4 text-sm leading-relaxed text-text-secondary">Minden gépre valós idejű OEE: rendelkezésre állás, teljesítmény, minőség. A műszakvezető azonnal látja, melyik gép jár a célérték alatt — és miért.</p>
                    <div class="flex flex-wrap gap-1.5">
                        <span class="rounded bg-orange-50 px-2 py-0.5 text-[10px] font-semibold text-orange-600">Gyártásirányítás</span>
                        <span class="rounded bg-orange-50 px-2 py-0.5 text-[10px] font-semibold text-orange-600">Munkalap</span>
                    </div>
                </div>

                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-7"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <span class="mb-4 block text-xs font-semibold text-text-tertiary" style="font-family: 'JetBrains Mono', monospace;">02</span>
                    <h3 class="mb-2 text-base font-bold text-text-primary">Prediktív karbantartás MI-vel</h3>
                    <p class="mb-4 text-sm leading-relaxed text-text-secondary">A DataMind a korábbi meghibásodási mintákból és a gépüzemi adatokból előrejelzi, mikor lesz szükség karbantartásra — hetekkel a leállás előtt.</p>
                    <div class="flex flex-wrap gap-1.5">
                        <span class="rounded bg-orange-50 px-2 py-0.5 text-[10px] font-semibold text-orange-600">DataMind</span>
                        <span class="rounded bg-orange-50 px-2 py-0.5 text-[10px] font-semibold text-orange-600">Automatizálás</span>
                    </div>
                </div>

                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-7"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <span class="mb-4 block text-xs font-semibold text-text-tertiary" style="font-family: 'JetBrains Mono', monospace;">03</span>
                    <h3 class="mb-2 text-base font-bold text-text-primary">Gantt-alapú kapacitástervezés</h3>
                    <p class="mb-4 text-sm leading-relaxed text-text-secondary">Vizuális gyártásütemezés: melyik gépen, mikor, milyen termék fut. A rendszer automatikusan jelez, ha kapacitás-ütközés van — és javasol átütemezést.</p>
                    <div class="flex flex-wrap gap-1.5">
                        <span class="rounded bg-orange-50 px-2 py-0.5 text-[10px] font-semibold text-orange-600">Gyártásirányítás</span>
                        <span class="rounded bg-orange-50 px-2 py-0.5 text-[10px] font-semibold text-orange-600">Értékesítés</span>
                    </div>
                </div>

                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-7"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <span class="mb-4 block text-xs font-semibold text-text-tertiary" style="font-family: 'JetBrains Mono', monospace;">04</span>
                    <h3 class="mb-2 text-base font-bold text-text-primary">Digitális műszak-jelentés</h3>
                    <p class="mb-4 text-sm leading-relaxed text-text-secondary">A gépkezelő a műszak végén rögzíti: legyártott mennyiség, selejt (ok-kóddal), leállások, anyagfelhasználás — 5 perc alatt, a telefonján, papír nélkül.</p>
                    <div class="flex flex-wrap gap-1.5">
                        <span class="rounded bg-orange-50 px-2 py-0.5 text-[10px] font-semibold text-orange-600">Munkalap</span>
                        <span class="rounded bg-orange-50 px-2 py-0.5 text-[10px] font-semibold text-orange-600">Gyártásirányítás</span>
                    </div>
                </div>

                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-7"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <span class="mb-4 block text-xs font-semibold text-text-tertiary" style="font-family: 'JetBrains Mono', monospace;">05</span>
                    <h3 class="mb-2 text-base font-bold text-text-primary">Selejt-elemzés és minőségellenőrzés</h3>
                    <p class="mb-4 text-sm leading-relaxed text-text-secondary">Melyik gépen, melyik műszakban, melyik anyagból keletkezik a legtöbb selejt? A DataMind mintázatot talál — a minőségirányítási vezető célzott intézkedést hozhat.</p>
                    <div class="flex flex-wrap gap-1.5">
                        <span class="rounded bg-orange-50 px-2 py-0.5 text-[10px] font-semibold text-orange-600">DataMind</span>
                        <span class="rounded bg-orange-50 px-2 py-0.5 text-[10px] font-semibold text-orange-600">Gyártásirányítás</span>
                    </div>
                </div>

                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-7"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <span class="mb-4 block text-xs font-semibold text-text-tertiary" style="font-family: 'JetBrains Mono', monospace;">06</span>
                    <h3 class="mb-2 text-base font-bold text-text-primary">Gyártás–értékesítés szinkronizáció</h3>
                    <p class="mb-4 text-sm leading-relaxed text-text-secondary">Az értékesítő a CRM-ben valós időben látja a szabad kapacitást és a gyártási határidőt — reális szállítási időt kommunikálhat az ügyfélnek, nem megérzés alapján.</p>
                    <div class="flex flex-wrap gap-1.5">
                        <span class="rounded bg-orange-50 px-2 py-0.5 text-[10px] font-semibold text-orange-600">Gyártásirányítás</span>
                        <span class="rounded bg-orange-50 px-2 py-0.5 text-[10px] font-semibold text-orange-600">CRM</span>
                        <span class="rounded bg-orange-50 px-2 py-0.5 text-[10px] font-semibold text-orange-600">Értékesítés</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Comparison Table Section --}}
    <section class="bg-surface-secondary py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-6">
            <div class="reveal mb-12">
                <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-orange-600">Összehasonlítás</p>
                <h2 class="mb-4 text-3xl text-text-primary md:text-4xl" style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                    Papíros műszakjelentés helyett — digitális üzemirányítás
                </h2>
                <p class="max-w-xl text-lg text-text-secondary">
                    Így változik meg a termelés irányítása a Cégem360 bevezetésével.
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
                        <tr>
                            <td class="px-6 py-4 text-sm font-semibold text-text-primary">Gépállapot áttekintés</td>
                            <td class="px-6 py-4 text-sm text-text-tertiary">Személyesen, az üzemben</td>
                            <td class="px-6 py-4 text-sm font-medium text-success-600">✓ Valós idejű dashboard</td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 text-sm font-semibold text-text-primary">OEE mérés</td>
                            <td class="px-6 py-4 text-sm text-text-tertiary">Nem mérik / utólag</td>
                            <td class="px-6 py-4 text-sm font-medium text-success-600">✓ Folyamatos, gépenként</td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 text-sm font-semibold text-text-primary">Gyártástervezés</td>
                            <td class="px-6 py-4 text-sm text-text-tertiary">Whiteboard / Excel</td>
                            <td class="px-6 py-4 text-sm font-medium text-success-600">✓ Gantt, kapacitás-szinkronnal</td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 text-sm font-semibold text-text-primary">Karbantartás</td>
                            <td class="px-6 py-4 text-sm text-text-tertiary">Meghibásodás után</td>
                            <td class="px-6 py-4 text-sm font-medium text-success-600">✓ Prediktív MI tervezés</td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 text-sm font-semibold text-text-primary">Selejt-elemzés</td>
                            <td class="px-6 py-4 text-sm text-text-tertiary">Heti jelentésben, ha van</td>
                            <td class="px-6 py-4 text-sm font-medium text-success-600">✓ Valós idejű, ok-kóddal</td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 text-sm font-semibold text-text-primary">Műszak-jelentés</td>
                            <td class="px-6 py-4 text-sm text-text-tertiary">Papíros, másnap reggel</td>
                            <td class="px-6 py-4 text-sm font-medium text-success-600">✓ Digitális, azonnali</td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 text-sm font-semibold text-text-primary">Kapacitás-információ az értékesítésnek</td>
                            <td class="px-6 py-4 text-sm text-text-tertiary">Telefonon kérdezi</td>
                            <td class="px-6 py-4 text-sm font-medium text-success-600">✓ Valós időben a CRM-ben</td>
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
                <div class="grid grid-cols-1 items-center gap-8 rounded-2xl border border-border-light bg-surface-secondary p-8 lg:grid-cols-[1fr_auto] lg:p-12"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div>
                        <h3 class="mb-3 text-xl font-bold text-text-primary lg:text-2xl" style="font-family: 'Poppins', sans-serif;">Személyre szabott online konzultáció</h3>
                        <p class="mb-5 text-base text-text-secondary">30 perces videóhívás, amelyben felmérjük, hogyan digitalizálhatja termelési és üzemirányítási folyamatait a Cégem360-nal — az Ön iparágára, géppark-méretére és termelési típusára szabva.</p>
                        <div class="flex flex-wrap gap-5">
                            <span class="flex items-center gap-1.5 text-sm text-text-tertiary">
                                <svg class="h-4 w-4 text-success-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                                30 perc videóhívás
                            </span>
                            <span class="flex items-center gap-1.5 text-sm text-text-tertiary">
                                <svg class="h-4 w-4 text-success-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                                Termelési audit
                            </span>
                            <span class="flex items-center gap-1.5 text-sm text-text-tertiary">
                                <svg class="h-4 w-4 text-success-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                                Nincs elköteleződés
                            </span>
                        </div>
                    </div>
                    <a href="{{ route('contact') }}"
                        class="group inline-flex items-center gap-2 rounded-full bg-orange-600 px-6 py-3 text-base font-medium text-white transition-all hover:bg-orange-700 hover:shadow-lg"
                        style="box-shadow: 0 1px 2px rgba(0,0,0,0.05);">
                        <span>Konzultációt kérek</span>
                        <svg class="arrow-slide h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{-- Footer CTA Section --}}
    <section class="bg-linear-to-b from-surface-secondary to-surface-primary py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-6">
            <div class="reveal mb-12 text-center">
                <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-orange-600">Kezdje el</p>
                <h2 class="mb-4 text-3xl text-text-primary md:text-4xl" style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                    Készen áll a digitális üzemirányításra?
                </h2>
                <p class="mx-auto max-w-xl text-lg text-text-secondary">
                    Válassza ki a következő lépést az Ön számára.
                </p>
            </div>

            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2" data-stagger>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-8 text-center"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <h3 class="mb-3 text-xl font-bold text-text-primary">Online konzultáció</h3>
                    <p class="mb-6 text-sm text-text-secondary">Kérdezzen szakértőinktől 30 percben — videóhíváson, az Ön termelési kihívásaira szabva, kötelezettség nélkül.</p>
                    <a href="{{ route('contact') }}"
                        class="inline-flex items-center gap-2 rounded-full border border-border-light bg-surface-secondary px-6 py-3 text-sm font-medium text-text-primary transition-all hover:border-orange-200 hover:shadow-md">
                        Időpont foglalása <svg class="arrow-slide h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" /></svg>
                    </a>
                </div>
                <div class="stagger-item card-glow rounded-2xl border border-orange-100 bg-orange-50 p-8 text-center"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <h3 class="mb-3 text-xl font-bold text-text-primary">Regisztráció és kipróbálás</h3>
                    <p class="mb-6 text-sm text-text-secondary">Fedezze fel a gyártásirányítást, az OEE dashboardot és a digitális munkalapokat — azonnal.</p>
                    <a href="{{ route('register') }}"
                        class="group inline-flex items-center gap-2 rounded-full bg-orange-600 px-6 py-3 text-sm font-medium text-white transition-all hover:bg-orange-700 hover:shadow-lg"
                        style="box-shadow: 0 1px 2px rgba(0,0,0,0.05);">
                        Regisztráció <svg class="arrow-slide h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" /></svg>
                    </a>
                </div>
            </div>
        </div>
    </section>
</div>
