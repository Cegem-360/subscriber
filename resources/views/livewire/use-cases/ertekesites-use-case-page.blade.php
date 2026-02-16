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
            0% { box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.4); }
            70% { box-shadow: 0 0 0 6px rgba(16, 185, 129, 0); }
            100% { box-shadow: 0 0 0 0 rgba(16, 185, 129, 0); }
        }
        .pulse-dot { animation: pulse-ring 2s ease infinite; }

        /* Card hover glow */
        .card-glow {
            transition: all 0.4s cubic-bezier(0, 0, 0.2, 1);
        }
        .card-glow:hover {
            box-shadow: 0 8px 30px -8px rgba(16, 185, 129, 0.15), 0 2px 8px rgba(0,0,0,0.04) !important;
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

        /* Funnel connector line */
        .funnel-line {
            background: linear-gradient(90deg, transparent, var(--color-success-200), var(--color-primary-200), var(--color-warning-200), transparent);
            transform: scaleX(0);
            transform-origin: left;
            transition: transform 1.2s cubic-bezier(0, 0, 0.2, 1) 0.3s;
        }
        .funnel-line.revealed { transform: scaleX(1); }

        /* Pipeline bar animation */
        @keyframes pipeline-grow {
            from { transform: scaleX(0); transform-origin: left; }
            to { transform: scaleX(1); transform-origin: left; }
        }
        .pipeline-bar {
            animation: pipeline-grow 0.8s cubic-bezier(0, 0, 0.2, 1) both;
        }

        /* Pill float */
        .pill-float {
            transition: transform 0.35s cubic-bezier(0, 0, 0.2, 1), box-shadow 0.35s cubic-bezier(0, 0, 0.2, 1);
        }
        .pill-float:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 20px -4px rgba(16, 185, 129, 0.12);
        }

        /* Smooth scroll for anchor links */
        html { scroll-behavior: smooth; }
    </style>

    {{-- Hero Section --}}
    <section class="bg-linear-to-b from-success-50/60 to-surface-secondary">
        <div class="mx-auto max-w-7xl px-6 py-16 lg:py-24">
            <div class="grid grid-cols-1 items-center gap-12 lg:grid-cols-2">
                {{-- Hero Text --}}
                <div class="reveal">
                    <div class="badge-gradient mb-8 inline-flex items-center gap-2 rounded-full border border-border-light/80 bg-surface-primary px-4 py-1.5"
                        style="box-shadow: 0 1px 3px rgba(0,0,0,0.04);">
                        <span class="pulse-dot h-1.5 w-1.5 rounded-full bg-linear-to-r from-success-500 via-emerald-500 to-cyan-500"></span>
                        <span class="text-sm font-medium text-text-primary">Ipari értékesítési megoldások</span>
                    </div>

                    <h1 class="mb-6 text-4xl leading-tight tracking-tight text-text-primary md:text-5xl lg:text-[3.5rem]"
                        style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                        Zárja le gyorsabban<br>
                        — az ipari üzleteket
                    </h1>

                    <p class="mb-10 max-w-xl text-lg text-text-secondary lg:text-xl">
                        Pipeline kezelés, ajánlattétel, ügyfélkövetés, sales riportok — minden egy rendszerben. A Cégem360 moduláris platformja az értékesítés teljes folyamatát lefedi, a lead beérkezéstől a lezárásig.
                    </p>

                    <div class="flex flex-wrap items-center gap-4">
                        <a href="{{ route('contact') }}"
                            class="group inline-flex items-center gap-2 rounded-full bg-success-600 px-6 py-3 text-base font-medium text-white transition-all hover:bg-success-700 hover:shadow-lg"
                            style="box-shadow: 0 1px 2px rgba(0,0,0,0.05);">
                            <span>Online konzultáció</span>
                            <svg class="arrow-slide h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                            </svg>
                        </a>
                        <a href="#megoldasok"
                            class="inline-flex items-center gap-2 rounded-full border border-border-light bg-surface-primary px-6 py-3 text-base font-medium text-text-primary transition-all hover:border-success-200 hover:bg-surface-secondary hover:shadow-md">
                            Megoldások áttekintése
                        </a>
                    </div>
                </div>

                {{-- Pipeline Visual --}}
                <div class="reveal-right">
                    <div class="rounded-2xl border border-border-light bg-surface-primary p-6"
                        style="box-shadow: 0 4px 20px -4px rgba(0,0,0,0.06);">
                        <div class="mb-4 flex items-center justify-between border-b border-border-light pb-4">
                            <span class="text-sm font-bold text-text-primary">Sales Pipeline — Q1 2026</span>
                            <span class="text-xs text-text-tertiary">Összesen: 24 aktív üzlet</span>
                        </div>

                        {{-- Pipeline stages --}}
                        <div class="space-y-2.5">
                            <div>
                                <div class="mb-1 flex items-center justify-between">
                                    <span class="text-xs font-semibold text-text-secondary">Lead beérkezés</span>
                                    <span class="text-xs font-bold text-text-tertiary">12</span>
                                </div>
                                <div class="h-6 w-full rounded-md bg-surface-secondary">
                                    <div class="pipeline-bar h-6 rounded-md bg-success-400" style="width: 100%; animation-delay: 0.2s;"></div>
                                </div>
                            </div>
                            <div>
                                <div class="mb-1 flex items-center justify-between">
                                    <span class="text-xs font-semibold text-text-secondary">Kvalifikálás</span>
                                    <span class="text-xs font-bold text-text-tertiary">8</span>
                                </div>
                                <div class="h-6 w-full rounded-md bg-surface-secondary">
                                    <div class="pipeline-bar h-6 rounded-md bg-primary-400" style="width: 67%; animation-delay: 0.35s;"></div>
                                </div>
                            </div>
                            <div>
                                <div class="mb-1 flex items-center justify-between">
                                    <span class="text-xs font-semibold text-text-secondary">Ajánlattétel</span>
                                    <span class="text-xs font-bold text-text-tertiary">5</span>
                                </div>
                                <div class="h-6 w-full rounded-md bg-surface-secondary">
                                    <div class="pipeline-bar h-6 rounded-md bg-warning-400" style="width: 42%; animation-delay: 0.5s;"></div>
                                </div>
                            </div>
                            <div>
                                <div class="mb-1 flex items-center justify-between">
                                    <span class="text-xs font-semibold text-text-secondary">Tárgyalás</span>
                                    <span class="text-xs font-bold text-text-tertiary">3</span>
                                </div>
                                <div class="h-6 w-full rounded-md bg-surface-secondary">
                                    <div class="pipeline-bar h-6 rounded-md bg-violet-400" style="width: 25%; animation-delay: 0.65s;"></div>
                                </div>
                            </div>
                            <div>
                                <div class="mb-1 flex items-center justify-between">
                                    <span class="text-xs font-semibold text-text-secondary">Lezárás</span>
                                    <span class="text-xs font-bold text-text-tertiary">2</span>
                                </div>
                                <div class="h-6 w-full rounded-md bg-surface-secondary">
                                    <div class="pipeline-bar h-6 rounded-md bg-cyan-400" style="width: 17%; animation-delay: 0.8s;"></div>
                                </div>
                            </div>
                        </div>

                        {{-- Status bar --}}
                        <div class="mt-4 flex gap-5 border-t border-border-light pt-3">
                            <span class="flex items-center gap-1.5 text-[11px] text-text-tertiary">
                                <span class="h-2 w-2 rounded-full bg-success-500"></span> 42% konverzió
                            </span>
                            <span class="flex items-center gap-1.5 text-[11px] text-text-tertiary">
                                <span class="h-2 w-2 rounded-full bg-warning-500"></span> 18M Ft pipeline
                            </span>
                            <span class="flex items-center gap-1.5 text-[11px] text-text-tertiary">
                                <span class="h-2 w-2 rounded-full bg-primary-500"></span> 5 fázis
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
                <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-success-600">A kihívás</p>
                <h2 class="mb-4 text-3xl text-text-primary md:text-4xl" style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                    Ezek lassítják az ipari értékesítést
                </h2>
                <p class="max-w-xl text-lg text-text-secondary">
                    Ismerős helyzetek ipari értékesítési vezetők és kereskedelmi csapatok számára.
                </p>
            </div>

            <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4" data-stagger>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-7"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="icon-hover mb-5 flex h-12 w-12 items-center justify-center rounded-xl bg-danger-50">
                        <svg class="h-6 w-6 text-danger-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
                        </svg>
                    </div>
                    <h3 class="mb-2 text-lg font-bold text-text-primary">Elveszett érdeklődők</h3>
                    <p class="text-sm leading-relaxed text-text-secondary">A leadek e-mailben, telefonon és személyesen érkeznek — de nincs központi hely, ahol nyomon követhetők lennének.</p>
                </div>

                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-7"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="icon-hover mb-5 flex h-12 w-12 items-center justify-center rounded-xl bg-warning-50">
                        <svg class="h-6 w-6 text-warning-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="mb-2 text-lg font-bold text-text-primary">Lassú ajánlattétel</h3>
                    <p class="text-sm leading-relaxed text-text-secondary">Az ajánlat összeállítása napokat vesz igénybe — közben a verseny megelőzi. Nincs sablonrendszer, nincs automatizálás.</p>
                </div>

                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-7"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="icon-hover mb-5 flex h-12 w-12 items-center justify-center rounded-xl bg-violet-50">
                        <svg class="h-6 w-6 text-violet-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                    </div>
                    <h3 class="mb-2 text-lg font-bold text-text-primary">Átláthatatlan pipeline</h3>
                    <p class="text-sm leading-relaxed text-text-secondary">A vezető nem látja, hány üzlet van folyamatban, melyik fázisban akadnak el, és mi a várható árbevétel.</p>
                </div>

                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-7"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="icon-hover mb-5 flex h-12 w-12 items-center justify-center rounded-xl bg-primary-50">
                        <svg class="h-6 w-6 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
                        </svg>
                    </div>
                    <h3 class="mb-2 text-lg font-bold text-text-primary">Marketing–Sales szakadék</h3>
                    <p class="text-sm leading-relaxed text-text-secondary">A marketing hoz leadeket, de az értékesítés nem követi őket — és senki nem méri, melyik kampány hoz valódi üzletet.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Target Audiences Section --}}
    <section class="bg-surface-secondary py-16 lg:py-24" id="celcsoportok">
        <div class="mx-auto max-w-7xl px-6">
            <div class="reveal mb-12">
                <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-success-600">Ki használja?</p>
                <h2 class="mb-4 text-3xl text-text-primary md:text-4xl" style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                    Minden értékesítési szereplő egy rendszerben
                </h2>
                <p class="max-w-xl text-lg text-text-secondary">
                    A Cégem360 a teljes kereskedelmi csapatnak közös munkafelületet biztosít — a lead kezeléstől a lezárásig.
                </p>
            </div>

            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4" data-stagger>
                <div class="stagger-item group card-glow relative overflow-hidden rounded-2xl border border-border-light bg-surface-primary p-8"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="absolute inset-x-0 top-0 h-1 bg-linear-to-r from-success-500 to-emerald-400 opacity-0 transition-opacity duration-500 group-hover:opacity-100"></div>
                    <div class="icon-hover mb-4 flex h-14 w-14 items-center justify-center rounded-2xl bg-success-50">
                        <svg class="h-7 w-7 text-success-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                        </svg>
                    </div>
                    <p class="mb-2 text-xs font-semibold uppercase tracking-wider text-success-600">Kereskedelmi vezető</p>
                    <h3 class="mb-3 text-lg font-bold text-text-primary">Sales igazgatók</h3>
                    <p class="text-sm leading-relaxed text-text-secondary">Pipeline áttekintés, előrejelzés, csapatteljesítmény és árbevétel-riportok — valós időben, egyetlen dashboard-on.</p>
                </div>

                <div class="stagger-item group card-glow relative overflow-hidden rounded-2xl border border-border-light bg-surface-primary p-8"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="absolute inset-x-0 top-0 h-1 bg-linear-to-r from-primary-500 to-violet-500 opacity-0 transition-opacity duration-500 group-hover:opacity-100"></div>
                    <div class="icon-hover mb-4 flex h-14 w-14 items-center justify-center rounded-2xl bg-primary-50">
                        <svg class="h-7 w-7 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>
                    <p class="mb-2 text-xs font-semibold uppercase tracking-wider text-primary-600">Értékesítő</p>
                    <h3 class="mb-3 text-lg font-bold text-text-primary">Értékesítők és AM-ek</h3>
                    <p class="text-sm leading-relaxed text-text-secondary">Lead kezelés, ajánlatkészítés, ügyfélkommunikáció és follow-up feladatok — minden egy felületen, mobilról is.</p>
                </div>

                <div class="stagger-item group card-glow relative overflow-hidden rounded-2xl border border-border-light bg-surface-primary p-8"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="absolute inset-x-0 top-0 h-1 bg-linear-to-r from-warning-500 to-amber-400 opacity-0 transition-opacity duration-500 group-hover:opacity-100"></div>
                    <div class="icon-hover mb-4 flex h-14 w-14 items-center justify-center rounded-2xl bg-warning-50">
                        <svg class="h-7 w-7 text-warning-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                    </div>
                    <p class="mb-2 text-xs font-semibold uppercase tracking-wider text-warning-600">Ügyvezető</p>
                    <h3 class="mb-3 text-lg font-bold text-text-primary">Ügyvezetők</h3>
                    <p class="text-sm leading-relaxed text-text-secondary">Árbevétel-előrejelzés, értékesítési trendek és stratégiai döntéstámogatás — adatvezérelt vezetői dashboard.</p>
                </div>

                <div class="stagger-item group card-glow relative overflow-hidden rounded-2xl border border-border-light bg-surface-primary p-8"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="absolute inset-x-0 top-0 h-1 bg-linear-to-r from-pink-500 to-rose-400 opacity-0 transition-opacity duration-500 group-hover:opacity-100"></div>
                    <div class="icon-hover mb-4 flex h-14 w-14 items-center justify-center rounded-2xl bg-pink-50">
                        <svg class="h-7 w-7 text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z" />
                        </svg>
                    </div>
                    <p class="mb-2 text-xs font-semibold uppercase tracking-wider text-pink-500">Marketing</p>
                    <h3 class="mb-3 text-lg font-bold text-text-primary">Marketing csapat</h3>
                    <p class="text-sm leading-relaxed text-text-secondary">Lead-forrás követés, kampány-attribúció és marketing-sales összehangolás — végre látja, melyik kampány hoz üzletet.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Core Toolkit Section --}}
    <section class="bg-surface-primary py-16 lg:py-24" id="megoldasok">
        <div class="mx-auto max-w-7xl px-6">
            <div class="reveal mb-12">
                <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-success-600">Értékesítési eszköztár</p>
                <h2 class="mb-4 text-3xl text-text-primary md:text-4xl" style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                    4 kulcsmodul az értékesítés támogatásához
                </h2>
                <p class="max-w-xl text-lg text-text-secondary">
                    Ezek a modulok közvetlenül az értékesítési csapat mindennapi munkáját támogatják.
                </p>
            </div>

            <div class="grid grid-cols-1 gap-6 lg:grid-cols-2" data-stagger>
                {{-- CRM --}}
                <div class="stagger-item group card-glow rounded-2xl border border-border-light bg-surface-primary p-8 transition-all hover:border-success-200"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="mb-5 flex items-center gap-3">
                        <div class="icon-hover">
                            <x-module-icon module="crm" size="sm" rounded="lg" />
                        </div>
                        <div>
                            <span class="rounded-md bg-success-50 px-2.5 py-1 text-xs font-bold uppercase tracking-wider text-success-600">CRM</span>
                        </div>
                        <span class="text-xs text-text-tertiary">Ügyfélkapcsolat-kezelés</span>
                    </div>
                    <h3 class="mb-3 text-xl font-bold text-text-primary">Minden ügyfél-interakció egy idővonalon</h3>
                    <p class="mb-6 text-sm leading-relaxed text-text-secondary">Kontaktok, cégek, kommunikációtörténet, feladatok és lehetőségek — teljes 360°-os ügyfélkép. Automatikus emlékeztetők és testreszabható pipeline nézet.</p>
                    <div class="mb-6 grid grid-cols-2 gap-2">
                        <span class="flex items-center gap-2 text-sm text-text-secondary">
                            <span class="feature-dot h-1.5 w-1.5 rounded-full bg-success-500"></span>360° ügyfélkép
                        </span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary">
                            <span class="feature-dot h-1.5 w-1.5 rounded-full bg-success-500"></span>Pipeline nézet
                        </span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary">
                            <span class="feature-dot h-1.5 w-1.5 rounded-full bg-success-500"></span>Kommunikáció-napló
                        </span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary">
                            <span class="feature-dot h-1.5 w-1.5 rounded-full bg-success-500"></span>Automatikus emlékeztetők
                        </span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary">
                            <span class="feature-dot h-1.5 w-1.5 rounded-full bg-success-500"></span>Lead scoring
                        </span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary">
                            <span class="feature-dot h-1.5 w-1.5 rounded-full bg-success-500"></span>Cég-kontakt kezelés
                        </span>
                    </div>
                    <a href="{{ route('products.crm') }}" class="inline-flex items-center gap-1.5 text-sm font-semibold text-success-600 transition-colors hover:text-success-700">
                        Részletek megtekintése
                        <svg class="arrow-slide h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                        </svg>
                    </a>
                </div>

                {{-- Értékesítés --}}
                <div class="stagger-item group card-glow rounded-2xl border border-border-light bg-surface-primary p-8 transition-all hover:border-emerald-200"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="mb-5 flex items-center gap-3">
                        <div class="icon-hover">
                            <x-module-icon module="ertekesites" size="sm" rounded="lg" />
                        </div>
                        <div>
                            <span class="rounded-md bg-emerald-50 px-2.5 py-1 text-xs font-bold uppercase tracking-wider text-emerald-600">Értékesítés</span>
                        </div>
                        <span class="text-xs text-text-tertiary">Ajánlatok és pipeline</span>
                    </div>
                    <h3 class="mb-3 text-xl font-bold text-text-primary">Professzionális ajánlatok percek alatt</h3>
                    <p class="mb-6 text-sm leading-relaxed text-text-secondary">Ajánlatsablonok, árazás, automatikus dokumentum-generálás és ajánlat→rendelés konverzió. Online elfogadás és digitális aláírás támogatás.</p>
                    <div class="mb-6 grid grid-cols-2 gap-2">
                        <span class="flex items-center gap-2 text-sm text-text-secondary">
                            <span class="feature-dot h-1.5 w-1.5 rounded-full bg-emerald-500"></span>Ajánlatsablonok
                        </span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary">
                            <span class="feature-dot h-1.5 w-1.5 rounded-full bg-emerald-500"></span>Dinamikus árazás
                        </span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary">
                            <span class="feature-dot h-1.5 w-1.5 rounded-full bg-emerald-500"></span>PDF generálás
                        </span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary">
                            <span class="feature-dot h-1.5 w-1.5 rounded-full bg-emerald-500"></span>Online elfogadás
                        </span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary">
                            <span class="feature-dot h-1.5 w-1.5 rounded-full bg-emerald-500"></span>Ajánlat→Rendelés
                        </span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary">
                            <span class="feature-dot h-1.5 w-1.5 rounded-full bg-emerald-500"></span>Verziókövetés
                        </span>
                    </div>
                    <a href="{{ route('products.ertekesites') }}" class="inline-flex items-center gap-1.5 text-sm font-semibold text-emerald-600 transition-colors hover:text-emerald-700">
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
                        <span class="text-xs text-text-tertiary">Workflow-k és triggerek</span>
                    </div>
                    <h3 class="mb-3 text-xl font-bold text-text-primary">Automatizálja az értékesítés ismétlődő feladatait</h3>
                    <p class="mb-6 text-sm leading-relaxed text-text-secondary">Follow-up emlékeztetők, lead scoring triggerek, ajánlat-emlékeztetők és feladat-delegálás — szabályalapúan, kód nélkül, vizuális workflow builderrel.</p>
                    <div class="mb-6 grid grid-cols-2 gap-2">
                        <span class="flex items-center gap-2 text-sm text-text-secondary">
                            <span class="feature-dot h-1.5 w-1.5 rounded-full bg-violet-500"></span>Drag & drop workflow
                        </span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary">
                            <span class="feature-dot h-1.5 w-1.5 rounded-full bg-violet-500"></span>Lead scoring triggerek
                        </span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary">
                            <span class="feature-dot h-1.5 w-1.5 rounded-full bg-violet-500"></span>Follow-up szekvenciák
                        </span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary">
                            <span class="feature-dot h-1.5 w-1.5 rounded-full bg-violet-500"></span>Ajánlat-emlékeztetők
                        </span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary">
                            <span class="feature-dot h-1.5 w-1.5 rounded-full bg-violet-500"></span>Feladat-delegálás
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

                {{-- DataMind --}}
                <div class="stagger-item group card-glow rounded-2xl border border-border-light bg-surface-primary p-8 transition-all hover:border-cyan-200"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="mb-5 flex items-center gap-3">
                        <div class="icon-hover">
                            <x-module-icon module="datamind" size="sm" rounded="lg" />
                        </div>
                        <div>
                            <span class="rounded-md bg-cyan-50 px-2.5 py-1 text-xs font-bold uppercase tracking-wider text-cyan-600">DataMind</span>
                        </div>
                        <span class="text-xs text-text-tertiary">MI alapú értékesítési intelligencia</span>
                    </div>
                    <h3 class="mb-3 text-xl font-bold text-text-primary">Prediktív sales elemzés — kódolás nélkül</h3>
                    <p class="mb-6 text-sm leading-relaxed text-text-secondary">Értékesítési előrejelzés, deal scoring, konverzió predikció és automatikus javaslatok. Drag-and-drop elemzés és magyar nyelvű MI összefoglalók.</p>
                    <div class="mb-6 grid grid-cols-2 gap-2">
                        <span class="flex items-center gap-2 text-sm text-text-secondary">
                            <span class="feature-dot h-1.5 w-1.5 rounded-full bg-cyan-500"></span>Deal scoring
                        </span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary">
                            <span class="feature-dot h-1.5 w-1.5 rounded-full bg-cyan-500"></span>Árbevétel-előrejelzés
                        </span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary">
                            <span class="feature-dot h-1.5 w-1.5 rounded-full bg-cyan-500"></span>Konverzió predikció
                        </span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary">
                            <span class="feature-dot h-1.5 w-1.5 rounded-full bg-cyan-500"></span>Automatikus riportok
                        </span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary">
                            <span class="feature-dot h-1.5 w-1.5 rounded-full bg-cyan-500"></span>Trend-elemzés
                        </span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary">
                            <span class="feature-dot h-1.5 w-1.5 rounded-full bg-cyan-500"></span>MI összefoglalók
                        </span>
                    </div>
                    <a href="{{ route('products.datamind') }}" class="inline-flex items-center gap-1.5 text-sm font-semibold text-cyan-600 transition-colors hover:text-cyan-700">
                        Részletek megtekintése
                        <svg class="arrow-slide h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{-- Sales Funnel Section --}}
    <section class="bg-surface-secondary py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-6">
            <div class="reveal mb-14">
                <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-success-600">Értékesítési folyamat</p>
                <h2 class="mb-4 text-3xl text-text-primary md:text-4xl" style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                    Zárt rendszer — a leadtől a lezárásig
                </h2>
                <p class="max-w-xl text-lg text-text-secondary">
                    Minden értékesítési fázisban más-más modul lép működésbe — de az adatok mindig egyazon rendszerben maradnak.
                </p>
            </div>

            <div class="relative">
                {{-- Connector line (desktop only) --}}
                <div class="funnel-line reveal absolute top-8 right-[10%] left-[10%] hidden h-0.5 lg:block"></div>

                <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-5" data-stagger>
                    @php
                        $funnel = [
                            ['num' => '01', 'title' => 'Lead beérkezés', 'desc' => 'Az érdeklődő megtalálja Önt weben, hirdetésen vagy ajánláson keresztül', 'modules' => ['AI Chat', 'MarketingHub'], 'color' => 'success'],
                            ['num' => '02', 'title' => 'Kvalifikálás', 'desc' => 'Lead scoring és automatikus értékelés — a jó leadek prioritást kapnak', 'modules' => ['CRM', 'Automatizálás'], 'color' => 'primary'],
                            ['num' => '03', 'title' => 'Ajánlattétel', 'desc' => 'Professzionális ajánlat sablonból, egyedi árazással és digitális küldéssel', 'modules' => ['Értékesítés', 'CRM'], 'color' => 'warning'],
                            ['num' => '04', 'title' => 'Tárgyalás', 'desc' => 'Follow-up szekvenciák, ajánlat módosítás és a döntéshozók bevonása', 'modules' => ['Automatizálás', 'Értékesítés'], 'color' => 'violet'],
                            ['num' => '05', 'title' => 'Lezárás', 'desc' => 'Megrendelés rögzítése, szerződéskötés és az ügyfél onboardolása', 'modules' => ['Értékesítés', 'Kontrolling'], 'color' => 'cyan'],
                        ];
                    @endphp

                    @foreach ($funnel as $step)
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
                    <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-success-600">Teljes ökoszisztéma</p>
                    <h2 class="text-3xl text-text-primary md:text-4xl" style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                        Mind a 11 modul az értékesítés szolgálatában
                    </h2>
                </div>
                <p class="reveal-right text-lg leading-relaxed text-text-secondary lg:mt-6">
                    Az értékesítés nem áll meg a lezárásnál. A gyártás teljesíti, a kontrolling méri, a szerviz karbantartja, a marketing újabb leadeket hoz. A Cégem360-ban minden adat ugyanabban a rendszerben él.
                </p>
            </div>

            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4" data-stagger>
                <div class="stagger-item card-glow rounded-xl border border-border-light bg-surface-primary p-6 text-center"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="icon-hover mx-auto mb-3 flex h-11 w-11 items-center justify-center rounded-xl bg-warning-50">
                        <x-module-icon module="kontrolling" size="xs" />
                    </div>
                    <h4 class="mb-1 text-sm font-bold text-text-primary">Kontrolling</h4>
                    <p class="text-xs leading-relaxed text-text-tertiary">Üzlet-szintű jövedelmezőség és árbevétel-elemzés valós pénzügyi adatokkal.</p>
                </div>

                <div class="stagger-item card-glow rounded-xl border border-border-light bg-surface-primary p-6 text-center"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="icon-hover mx-auto mb-3 flex h-11 w-11 items-center justify-center rounded-xl bg-success-50">
                        <x-module-icon module="beszerzes" size="xs" />
                    </div>
                    <h4 class="mb-1 text-sm font-bold text-text-primary">Beszerzés-logisztika</h4>
                    <p class="text-xs leading-relaxed text-text-tertiary">Készletinformáció az ajánlatokhoz — tudja, mit tud szállítani és mikor.</p>
                </div>

                <div class="stagger-item card-glow rounded-xl border border-border-light bg-surface-primary p-6 text-center"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="icon-hover mx-auto mb-3 flex h-11 w-11 items-center justify-center rounded-xl bg-violet-50">
                        <x-module-icon module="gyartas" size="xs" />
                    </div>
                    <h4 class="mb-1 text-sm font-bold text-text-primary">Gyártásirányítás</h4>
                    <p class="text-xs leading-relaxed text-text-tertiary">Kapacitás és gyártási határidők, hogy az ajánlatban reális szállítási időt adhasson.</p>
                </div>

                <div class="stagger-item card-glow rounded-xl border border-border-light bg-surface-primary p-6 text-center"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="icon-hover mx-auto mb-3 flex h-11 w-11 items-center justify-center rounded-xl bg-pink-50">
                        <x-module-icon module="marketinghub" size="xs" />
                    </div>
                    <h4 class="mb-1 text-sm font-bold text-text-primary">MarketingHub</h4>
                    <p class="text-xs leading-relaxed text-text-tertiary">Kampány-attribúció és lead-forrás adatok — tudja, honnan jönnek a legjobb ügyfelek.</p>
                </div>

                <div class="stagger-item card-glow rounded-xl border border-border-light bg-surface-primary p-6 text-center"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="icon-hover mx-auto mb-3 flex h-11 w-11 items-center justify-center rounded-xl bg-danger-50">
                        <x-module-icon module="seo" size="xs" />
                    </div>
                    <h4 class="mb-1 text-sm font-bold text-text-primary">SEO Eszköz</h4>
                    <p class="text-xs leading-relaxed text-text-tertiary">Organikus lead generálás — hogy a döntéshozók megtalálják Önt, mielőtt Ön keresi őket.</p>
                </div>

                <div class="stagger-item card-glow rounded-xl border border-border-light bg-surface-primary p-6 text-center"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="icon-hover mx-auto mb-3 flex h-11 w-11 items-center justify-center rounded-xl bg-blue-50">
                        <x-module-icon module="ai-chat" size="xs" />
                    </div>
                    <h4 class="mb-1 text-sm font-bold text-text-primary">AI Chat</h4>
                    <p class="text-xs leading-relaxed text-text-tertiary">0-24 lead kvalifikálás a weboldalon — az érdeklődők azonnal választ kapnak, Ön pedig leaddé konvertálja őket.</p>
                </div>

                <div class="stagger-item card-glow rounded-xl border border-border-light bg-surface-primary p-6 text-center"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="icon-hover mx-auto mb-3 flex h-11 w-11 items-center justify-center rounded-xl bg-cyan-50">
                        <x-module-icon module="szerviz" size="xs" />
                    </div>
                    <h4 class="mb-1 text-sm font-bold text-text-primary">Digitális munkalap</h4>
                    <p class="text-xs leading-relaxed text-text-tertiary">A lezárt üzlet után a szerviz adatai segítik az upsell és cross-sell lehetőségek feltárását.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Stats Section --}}
    <section class="bg-surface-secondary py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-6">
            <div class="reveal mb-12 text-center">
                <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-success-600">Eredmények</p>
                <h2 class="text-3xl text-text-primary md:text-4xl" style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                    Mérhető javulás az értékesítésben
                </h2>
            </div>

            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4" data-stagger data-counter-trigger>
                <div class="stagger-item stat-hover rounded-2xl border border-border-light bg-surface-primary p-8 text-center"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <p class="stat-value mb-2 text-4xl font-bold text-success-600" style="font-family: 'JetBrains Mono', monospace;" data-count="40" data-prefix="+" data-suffix="%">0%</p>
                    <p class="text-sm font-medium text-text-secondary">Lezárt üzletek</p>
                </div>

                <div class="stagger-item stat-hover rounded-2xl border border-border-light bg-surface-primary p-8 text-center"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <p class="stat-value mb-2 text-4xl font-bold text-primary-600" style="font-family: 'JetBrains Mono', monospace;" data-count="30" data-prefix="-" data-suffix="%">0%</p>
                    <p class="text-sm font-medium text-text-secondary">Értékesítési ciklus</p>
                </div>

                <div class="stagger-item stat-hover rounded-2xl border border-border-light bg-surface-primary p-8 text-center"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <p class="stat-value mb-2 text-4xl font-bold text-warning-600" style="font-family: 'JetBrains Mono', monospace;" data-count="50" data-prefix="-" data-suffix="%">0%</p>
                    <p class="text-sm font-medium text-text-secondary">Admin-idő</p>
                </div>

                <div class="stagger-item stat-hover rounded-2xl border border-border-light bg-surface-primary p-8 text-center"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <p class="stat-value mb-2 text-4xl font-bold text-violet-600" style="font-family: 'JetBrains Mono', monospace;" data-count="35" data-prefix="+" data-suffix="%">0%</p>
                    <p class="text-sm font-medium text-text-secondary">Ügyfél-visszatérés</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Use Cases Section --}}
    <section class="bg-surface-primary py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-6">
            <div class="reveal mb-12">
                <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-success-600">Felhasználási esetek</p>
                <h2 class="mb-4 text-3xl text-text-primary md:text-4xl" style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                    Így használják ipari értékesítési csapatok
                </h2>
            </div>

            <div class="grid grid-cols-1 gap-5 md:grid-cols-2 lg:grid-cols-3" data-stagger>
                @php
                    $useCases = [
                        ['num' => '01', 'title' => 'Ipari lead kezelés és kvalifikálás', 'desc' => 'A webes, telefonos és személyes érdeklődők automatikusan bekerülnek a CRM-be, lead scoring értékeli őket, és az értékesítő azonnal prioritás szerint dolgozhat.', 'tags' => ['CRM', 'AI Chat', 'Automatizálás']],
                        ['num' => '02', 'title' => 'Gyors ajánlattétel sablonokból', 'desc' => 'Professzionális ajánlat percek alatt: termékek és szolgáltatások kiválasztása, egyedi árazás, PDF generálás és digitális küldés — az ügyfél online is elfogadhatja.', 'tags' => ['Értékesítés', 'CRM']],
                        ['num' => '03', 'title' => 'Pipeline menedzsment és előrejelzés', 'desc' => 'Vizuális pipeline nézet, fázis-szintű konverzió mérés és MI-alapú árbevétel-előrejelzés — a sales vezető mindig tudja, hol tartanak az üzletek.', 'tags' => ['CRM', 'DataMind', 'Értékesítés']],
                        ['num' => '04', 'title' => 'Automatizált follow-up szekvenciák', 'desc' => 'A lead scoring és trigger-alapú workflow-k gondoskodnak arról, hogy egyetlen érdeklődő se vesszen el — automatikus emlékeztetők és feladat-delegálás.', 'tags' => ['Automatizálás', 'CRM']],
                        ['num' => '05', 'title' => 'Marketing-Sales összehangolás', 'desc' => 'A marketing leadjei automatikusan kerülnek a pipeline-ba, az értékesítés visszajelzése pedig méri a kampányhatékonyságot. Végre közös adatokon dolgoznak.', 'tags' => ['MarketingHub', 'CRM', 'Kontrolling']],
                        ['num' => '06', 'title' => 'Ügyfél lifetime value elemzés', 'desc' => 'A DataMind MI modellje elemzi az ügyfelek vásárlási mintáit, előrejelzi a churn kockázatot és javaslatot ad az upsell lehetőségekre.', 'tags' => ['DataMind', 'CRM']],
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
                                <span class="rounded-md bg-success-50 px-2.5 py-1 text-xs font-medium text-success-700 transition-colors hover:bg-success-100">{{ $tag }}</span>
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
                <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-success-600">Összehasonlítás</p>
                <h2 class="mb-4 text-3xl text-text-primary md:text-4xl" style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                    Excel és fejben tartás helyett — integrált rendszer
                </h2>
                <p class="max-w-xl text-lg text-text-secondary">
                    Így változik meg az értékesítési folyamat a Cégem360 bevezetésével.
                </p>
            </div>

            <div class="reveal-scale overflow-hidden rounded-2xl border border-border-light"
                style="box-shadow: 0 4px 20px -4px rgba(0,0,0,0.06);">
                <table class="w-full text-left text-sm">
                    <thead>
                        <tr class="bg-surface-primary">
                            <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-text-primary">Képesség</th>
                            <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-text-tertiary">Excel + E-mail</th>
                            <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-success-600">Cégem360</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-border-light">
                        @php
                            $comparisons = [
                                ['cap' => 'Lead nyomon követés', 'old' => 'Excel táblázat', 'new' => 'Automatikus CRM pipeline'],
                                ['cap' => 'Ajánlatkészítés', 'old' => 'Word sablon másolása', 'new' => 'Dinamikus ajánlat percek alatt'],
                                ['cap' => 'Follow-up emlékeztetők', 'old' => 'Fejben tartás', 'new' => 'Automatikus workflow'],
                                ['cap' => 'Pipeline áttekintés', 'old' => 'Heti megbeszélés', 'new' => 'Valós idejű dashboard'],
                                ['cap' => 'Árbevétel-előrejelzés', 'old' => 'Megérzés alapján', 'new' => 'MI-alapú predikció'],
                                ['cap' => 'Lead-forrás mérés', 'old' => 'Nem mérhető', 'new' => 'Kampány-attribúció'],
                                ['cap' => 'Értékesítési riportok', 'old' => 'Kézi összeállítás', 'new' => 'Automatikus generálás'],
                            ];
                        @endphp

                        @foreach ($comparisons as $row)
                            <tr class="bg-surface-secondary transition-colors hover:bg-surface-primary/50">
                                <td class="px-6 py-4 font-semibold text-text-primary">{{ $row['cap'] }}</td>
                                <td class="px-6 py-4 text-text-tertiary">{{ $row['old'] }}</td>
                                <td class="px-6 py-4">
                                    <span class="flex items-center gap-2 font-medium text-text-secondary">
                                        <svg class="h-4 w-4 text-success-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" /></svg>
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
                style="box-shadow: 0 4px 20px -4px rgba(16, 185, 129, 0.08);">
                <div>
                    <h3 class="mb-2 text-xl font-bold text-text-primary">Személyre szabott online konzultáció</h3>
                    <p class="mb-4 max-w-lg text-sm leading-relaxed text-text-secondary">30 perces videóhívás, amelyben felmérjük, hogyan illeszthető a Cégem360 az Ön értékesítési folyamataiba — az iparágára és csapatméretére szabva.</p>
                    <div class="flex flex-wrap gap-5">
                        <span class="flex items-center gap-1.5 text-xs font-medium text-text-tertiary">
                            <svg class="h-3.5 w-3.5 text-success-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" /></svg>
                            30 perc videóhívás
                        </span>
                        <span class="flex items-center gap-1.5 text-xs font-medium text-text-tertiary">
                            <svg class="h-3.5 w-3.5 text-success-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" /></svg>
                            Értékesítésre szabott tanácsadás
                        </span>
                        <span class="flex items-center gap-1.5 text-xs font-medium text-text-tertiary">
                            <svg class="h-3.5 w-3.5 text-success-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" /></svg>
                            Nincs elköteleződés
                        </span>
                    </div>
                </div>
                <a href="{{ route('contact') }}"
                    class="group inline-flex shrink-0 items-center gap-2 rounded-full bg-success-600 px-6 py-3 text-base font-medium text-white transition-all hover:bg-success-700 hover:shadow-lg"
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
                <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-success-600">Kezdje el</p>
                <h2 class="mb-4 text-3xl text-text-primary md:text-4xl" style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                    Készen áll a hatékonyabb értékesítésre?
                </h2>
                <p class="text-lg text-text-secondary">Válassza ki a következő lépést az Ön számára.</p>
            </div>

            <div class="mx-auto grid max-w-3xl grid-cols-1 gap-6 md:grid-cols-2" data-stagger>
                <div class="stagger-item card-glow rounded-2xl border border-success-100 bg-linear-to-br from-success-50/40 to-surface-primary p-8 text-center"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <h3 class="mb-3 text-lg font-bold text-text-primary">Online konzultáció</h3>
                    <p class="mb-6 text-sm leading-relaxed text-text-secondary">Kérdezzen szakértőinktől 30 percben — videóhíváson, az Ön értékesítési folyamataira szabva, kötelezettség nélkül.</p>
                    <a href="{{ route('contact') }}"
                        class="group inline-flex items-center gap-2 rounded-full border border-border-light bg-surface-primary px-5 py-2.5 text-sm font-medium text-text-primary transition-all hover:border-success-200 hover:bg-surface-secondary hover:shadow-md">
                        Időpont foglalása
                        <svg class="arrow-slide h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                        </svg>
                    </a>
                </div>

                <div class="stagger-item card-glow rounded-2xl border border-emerald-100 bg-linear-to-br from-emerald-50/40 to-surface-primary p-8 text-center"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <h3 class="mb-3 text-lg font-bold text-text-primary">Regisztráció és kipróbálás</h3>
                    <p class="mb-6 text-sm leading-relaxed text-text-secondary">Fedezze fel a platform teljes funkcionalitását. Ismerje meg a modulokat és kezdjen el dolgozni azonnal.</p>
                    <a href="{{ route('register') }}"
                        class="group inline-flex items-center gap-2 rounded-full bg-success-600 px-5 py-2.5 text-sm font-medium text-white transition-all hover:bg-success-700 hover:shadow-lg"
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
