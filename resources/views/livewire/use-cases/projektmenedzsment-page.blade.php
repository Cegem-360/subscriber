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
            0% { box-shadow: 0 0 0 0 rgba(245, 158, 11, 0.4); }
            70% { box-shadow: 0 0 0 6px rgba(245, 158, 11, 0); }
            100% { box-shadow: 0 0 0 0 rgba(245, 158, 11, 0); }
        }
        .pulse-dot { animation: pulse-ring 2s ease infinite; }

        /* Card hover glow */
        .card-glow {
            transition: all 0.4s cubic-bezier(0, 0, 0.2, 1);
        }
        .card-glow:hover {
            box-shadow: 0 8px 30px -8px rgba(245, 158, 11, 0.15), 0 2px 8px rgba(0,0,0,0.04) !important;
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

        /* Lifecycle connector line */
        .lifecycle-line {
            background: linear-gradient(90deg, transparent, var(--color-warning-200), var(--color-success-200), var(--color-primary-200), transparent);
            transform: scaleX(0);
            transform-origin: left;
            transition: transform 1.2s cubic-bezier(0, 0, 0.2, 1) 0.3s;
        }
        .lifecycle-line.revealed { transform: scaleX(1); }

        /* Gantt bar animation */
        @keyframes gantt-grow {
            from { transform: scaleX(0); transform-origin: left; }
            to { transform: scaleX(1); transform-origin: left; }
        }
        .gantt-bar {
            animation: gantt-grow 0.8s cubic-bezier(0, 0, 0.2, 1) both;
        }

        /* Pill float */
        .pill-float {
            transition: transform 0.35s cubic-bezier(0, 0, 0.2, 1), box-shadow 0.35s cubic-bezier(0, 0, 0.2, 1);
        }
        .pill-float:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 20px -4px rgba(245, 158, 11, 0.12);
        }

        /* Smooth scroll for anchor links */
        html { scroll-behavior: smooth; }
    </style>

    {{-- Hero Section --}}
    <section class="bg-linear-to-b from-warning-50/60 to-surface-secondary">
        <div class="mx-auto max-w-7xl px-6 py-16 lg:py-24">
            <div class="grid grid-cols-1 items-center gap-12 lg:grid-cols-2">
                {{-- Hero Text --}}
                <div class="reveal">
                    <div class="badge-gradient mb-8 inline-flex items-center gap-2 rounded-full border border-border-light/80 bg-surface-primary px-4 py-1.5"
                        style="box-shadow: 0 1px 3px rgba(0,0,0,0.04);">
                        <span class="pulse-dot h-1.5 w-1.5 rounded-full bg-linear-to-r from-warning-500 via-amber-500 to-yellow-500"></span>
                        <span class="text-sm font-medium text-text-primary">Ipari projektmenedzsment megoldások</span>
                    </div>

                    <h1 class="mb-6 text-4xl leading-tight tracking-tight text-text-primary md:text-5xl lg:text-[3.5rem]"
                        style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                        Irányítsa ipari projektjeit<br>
                        — a megrendeléstől az átadásig
                    </h1>

                    <p class="mb-10 max-w-xl text-lg text-text-secondary lg:text-xl">
                        Gyártástervezés, helyszíni munkák, beszerzés, költségkontroll — minden egy rendszerben. A Cégem360 moduláris platformja az ipari projektek teljes életciklusát lefedi, hogy ne a táblázatok irányítsák a projektjeit.
                    </p>

                    <div class="flex flex-wrap items-center gap-4">
                        <a href="{{ route('contact') }}"
                            class="group inline-flex items-center gap-2 rounded-full bg-warning-600 px-6 py-3 text-base font-medium text-white transition-all hover:bg-warning-700 hover:shadow-lg"
                            style="box-shadow: 0 1px 2px rgba(0,0,0,0.05);">
                            <span>Online konzultáció</span>
                            <svg class="arrow-slide h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                            </svg>
                        </a>
                        <a href="#megoldasok"
                            class="inline-flex items-center gap-2 rounded-full border border-border-light bg-surface-primary px-6 py-3 text-base font-medium text-text-primary transition-all hover:border-warning-200 hover:bg-surface-secondary hover:shadow-md">
                            Megoldások áttekintése
                        </a>
                    </div>
                </div>

                {{-- Gantt Chart Visual --}}
                <div class="reveal-right">
                    <div class="rounded-2xl border border-border-light bg-surface-primary p-6"
                        style="box-shadow: 0 4px 20px -4px rgba(0,0,0,0.06);">
                        <div class="mb-4 flex items-center justify-between border-b border-border-light pb-4">
                            <span class="text-sm font-bold text-text-primary">Projekt ütemterv — Gyártósor telepítés</span>
                            <span class="text-xs text-text-tertiary">2026. H1 · 24 hét</span>
                        </div>

                        {{-- Month headers + Gantt rows --}}
                        <div class="space-y-1.5">
                            {{-- Month row --}}
                            <div class="grid items-center" style="grid-template-columns: 90px 1fr;">
                                <span></span>
                                <div class="flex">
                                    <span class="flex-1 text-center text-[10px] font-semibold uppercase tracking-wider text-text-tertiary">Jan</span>
                                    <span class="flex-1 text-center text-[10px] font-semibold uppercase tracking-wider text-text-tertiary">Feb</span>
                                    <span class="flex-1 text-center text-[10px] font-semibold uppercase tracking-wider text-text-tertiary">Már</span>
                                    <span class="flex-1 text-center text-[10px] font-semibold uppercase tracking-wider text-text-tertiary">Ápr</span>
                                    <span class="flex-1 text-center text-[10px] font-semibold uppercase tracking-wider text-text-tertiary">Máj</span>
                                    <span class="flex-1 text-center text-[10px] font-semibold uppercase tracking-wider text-text-tertiary">Jún</span>
                                </div>
                            </div>

                            {{-- Gantt bars --}}
                            <div class="grid items-center" style="grid-template-columns: 90px 1fr;">
                                <span class="pr-3 text-xs font-semibold text-text-secondary">Ajánlattétel</span>
                                <div class="relative h-7 rounded-md bg-surface-secondary">
                                    <div class="gantt-bar absolute top-1 h-5 rounded-sm bg-warning-400" style="left: 0%; width: 35%; animation-delay: 0.2s;"></div>
                                </div>
                            </div>
                            <div class="grid items-center" style="grid-template-columns: 90px 1fr;">
                                <span class="pr-3 text-xs font-semibold text-text-secondary">Beszerzés</span>
                                <div class="relative h-7 rounded-md bg-surface-secondary">
                                    <div class="gantt-bar absolute top-1 h-5 rounded-sm bg-primary-400" style="left: 10%; width: 50%; animation-delay: 0.35s;"></div>
                                </div>
                            </div>
                            <div class="grid items-center" style="grid-template-columns: 90px 1fr;">
                                <span class="pr-3 text-xs font-semibold text-text-secondary">Gyártás</span>
                                <div class="relative h-7 rounded-md bg-surface-secondary">
                                    <div class="gantt-bar absolute top-1 h-5 rounded-sm bg-success-400" style="left: 25%; width: 40%; animation-delay: 0.5s;"></div>
                                </div>
                            </div>
                            <div class="grid items-center" style="grid-template-columns: 90px 1fr;">
                                <span class="pr-3 text-xs font-semibold text-text-secondary">Telepítés</span>
                                <div class="relative h-7 rounded-md bg-surface-secondary">
                                    <div class="gantt-bar absolute top-1 h-5 rounded-sm bg-violet-400" style="left: 40%; width: 45%; animation-delay: 0.65s;"></div>
                                </div>
                            </div>
                            <div class="grid items-center" style="grid-template-columns: 90px 1fr;">
                                <span class="pr-3 text-xs font-semibold text-text-secondary">Próbaüzem</span>
                                <div class="relative h-7 rounded-md bg-surface-secondary">
                                    <div class="gantt-bar absolute top-1 h-5 rounded-sm bg-cyan-400" style="left: 55%; width: 35%; animation-delay: 0.8s;"></div>
                                </div>
                            </div>
                            <div class="grid items-center" style="grid-template-columns: 90px 1fr;">
                                <span class="pr-3 text-xs font-semibold text-text-secondary">Átadás</span>
                                <div class="relative h-7 rounded-md bg-surface-secondary">
                                    <div class="gantt-bar absolute top-1 h-5 rounded-sm bg-danger-400" style="left: 65%; width: 30%; animation-delay: 0.95s;"></div>
                                </div>
                            </div>
                        </div>

                        {{-- Status bar --}}
                        <div class="mt-4 flex gap-5 border-t border-border-light pt-3">
                            <span class="flex items-center gap-1.5 text-[11px] text-text-tertiary">
                                <span class="h-2 w-2 rounded-full bg-success-500"></span> Ütemben
                            </span>
                            <span class="flex items-center gap-1.5 text-[11px] text-text-tertiary">
                                <span class="h-2 w-2 rounded-full bg-warning-500"></span> 94% kész
                            </span>
                            <span class="flex items-center gap-1.5 text-[11px] text-text-tertiary">
                                <span class="h-2 w-2 rounded-full bg-primary-500"></span> 6 fázis
                            </span>
                            <span class="flex items-center gap-1.5 text-[11px] text-text-tertiary">
                                <span class="h-2 w-2 rounded-full bg-violet-500"></span> 12 fő
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
                <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-warning-600">A kihívás</p>
                <h2 class="mb-4 text-3xl text-text-primary md:text-4xl" style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                    Ezek fékezik le az ipari projekteket
                </h2>
                <p class="max-w-xl text-lg text-text-secondary">
                    Ismerős helyzetek gyártó, szerelő és kivitelező cégek projektvezetőinek.
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
                    <h3 class="mb-2 text-lg font-bold text-text-primary">Csúszó határidők</h3>
                    <p class="text-sm leading-relaxed text-text-secondary">A szűk keresztmetszetek későn derülnek ki — nincs valós idejű rálátás az erőforrások és feladatok állapotára.</p>
                </div>

                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-7"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="icon-hover mb-5 flex h-12 w-12 items-center justify-center rounded-xl bg-warning-50">
                        <svg class="h-6 w-6 text-warning-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <h3 class="mb-2 text-lg font-bold text-text-primary">Papíralapú helyszíni munka</h3>
                    <p class="text-sm leading-relaxed text-text-secondary">Munkalapok, fotók, anyaglisták — minden papíron, ami napokkal később kerül be a rendszerbe, ha egyáltalán bekerül.</p>
                </div>

                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-7"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="icon-hover mb-5 flex h-12 w-12 items-center justify-center rounded-xl bg-violet-50">
                        <svg class="h-6 w-6 text-violet-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="mb-2 text-lg font-bold text-text-primary">Elszálló projektköltségek</h3>
                    <p class="text-sm leading-relaxed text-text-secondary">A tényleges anyag- és munkaórák költségét csak a projekt végén látja — addigra már nincs mód korrigálni.</p>
                </div>

                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-7"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="icon-hover mb-5 flex h-12 w-12 items-center justify-center rounded-xl bg-primary-50">
                        <svg class="h-6 w-6 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                        </svg>
                    </div>
                    <h3 class="mb-2 text-lg font-bold text-text-primary">Szétesett kommunikáció</h3>
                    <p class="text-sm leading-relaxed text-text-secondary">Az értékesítés, gyártás, beszerzés és a helyszíni csapat más-más rendszerben dolgozik — vagy sehol.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Target Audiences Section --}}
    <section class="bg-surface-secondary py-16 lg:py-24" id="celcsoportok">
        <div class="mx-auto max-w-7xl px-6">
            <div class="reveal mb-12">
                <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-warning-600">Ki használja?</p>
                <h2 class="mb-4 text-3xl text-text-primary md:text-4xl" style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                    Minden ipari projektrésztvevő egy rendszerben
                </h2>
                <p class="max-w-xl text-lg text-text-secondary">
                    A Cégem360 az egész projektcsapatnak közös munkafelületet biztosít — irodában és helyszínen egyaránt.
                </p>
            </div>

            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4" data-stagger>
                <div class="stagger-item group card-glow relative overflow-hidden rounded-2xl border border-border-light bg-surface-primary p-8"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="absolute inset-x-0 top-0 h-1 bg-linear-to-r from-warning-500 to-amber-400 opacity-0 transition-opacity duration-500 group-hover:opacity-100"></div>
                    <div class="icon-hover mb-4 flex h-14 w-14 items-center justify-center rounded-2xl bg-warning-50">
                        <svg class="h-7 w-7 text-warning-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                        </svg>
                    </div>
                    <p class="mb-2 text-xs font-semibold uppercase tracking-wider text-warning-600">Projektvezető</p>
                    <h3 class="mb-3 text-lg font-bold text-text-primary">Projektvezetők</h3>
                    <p class="text-sm leading-relaxed text-text-secondary">Gantt-diagram, erőforrás-ütemezés, mérföldkövek és automatikus riasztások — teljes projektkontroll egyetlen felületen.</p>
                </div>

                <div class="stagger-item group card-glow relative overflow-hidden rounded-2xl border border-border-light bg-surface-primary p-8"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="absolute inset-x-0 top-0 h-1 bg-linear-to-r from-violet-500 to-primary-500 opacity-0 transition-opacity duration-500 group-hover:opacity-100"></div>
                    <div class="icon-hover mb-4 flex h-14 w-14 items-center justify-center rounded-2xl bg-violet-50">
                        <svg class="h-7 w-7 text-violet-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.066 2.573c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.573 1.066c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.066-2.573c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>
                    <p class="mb-2 text-xs font-semibold uppercase tracking-wider text-violet-600">Műszaki vezető</p>
                    <h3 class="mb-3 text-lg font-bold text-text-primary">Műszaki igazgatók</h3>
                    <p class="text-sm leading-relaxed text-text-secondary">Minőségellenőrzés, BOM kezelés, gyártási ütemterv és kapacitástervezés — a technikai részletek irányítása.</p>
                </div>

                <div class="stagger-item group card-glow relative overflow-hidden rounded-2xl border border-border-light bg-surface-primary p-8"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="absolute inset-x-0 top-0 h-1 bg-linear-to-r from-success-500 to-cyan-500 opacity-0 transition-opacity duration-500 group-hover:opacity-100"></div>
                    <div class="icon-hover mb-4 flex h-14 w-14 items-center justify-center rounded-2xl bg-success-50">
                        <svg class="h-7 w-7 text-success-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                    </div>
                    <p class="mb-2 text-xs font-semibold uppercase tracking-wider text-success-600">Üzemvezető</p>
                    <h3 class="mb-3 text-lg font-bold text-text-primary">Üzemvezetők</h3>
                    <p class="text-sm leading-relaxed text-text-secondary">Termelési feladatok, dolgozói teljesítmény, gépkihasználtság és karbantartási ütemterv — valós időben.</p>
                </div>

                <div class="stagger-item group card-glow relative overflow-hidden rounded-2xl border border-border-light bg-surface-primary p-8"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="absolute inset-x-0 top-0 h-1 bg-linear-to-r from-primary-500 to-warning-500 opacity-0 transition-opacity duration-500 group-hover:opacity-100"></div>
                    <div class="icon-hover mb-4 flex h-14 w-14 items-center justify-center rounded-2xl bg-primary-50">
                        <svg class="h-7 w-7 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                        </svg>
                    </div>
                    <p class="mb-2 text-xs font-semibold uppercase tracking-wider text-primary-600">Ügyvezető</p>
                    <h3 class="mb-3 text-lg font-bold text-text-primary">Ügyvezetők</h3>
                    <p class="text-sm leading-relaxed text-text-secondary">Projekt-jövedelmezőség, költségkontroll dashboard és stratégiai áttekintés — pillanatok alatt, adatok alapján.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Core Toolkit Section --}}
    <section class="bg-surface-primary py-16 lg:py-24" id="megoldasok">
        <div class="mx-auto max-w-7xl px-6">
            <div class="reveal mb-12">
                <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-warning-600">Projektmenedzsment eszköztár</p>
                <h2 class="mb-4 text-3xl text-text-primary md:text-4xl" style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                    4 kulcsmodul az ipari projektek irányításához
                </h2>
                <p class="max-w-xl text-lg text-text-secondary">
                    Ezek a modulok közvetlenül a projektcsapat mindennapi koordinációját támogatják.
                </p>
            </div>

            <div class="grid grid-cols-1 gap-6 lg:grid-cols-2" data-stagger>
                {{-- Gyártásirányítás --}}
                <div class="stagger-item group card-glow rounded-2xl border border-border-light bg-surface-primary p-8 transition-all hover:border-warning-200"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="mb-5 flex items-center gap-3">
                        <div class="icon-hover">
                            <x-module-icon module="gyartas" size="sm" rounded="lg" />
                        </div>
                        <div>
                            <span class="rounded-md bg-warning-50 px-2.5 py-1 text-xs font-bold uppercase tracking-wider text-warning-600">Gyártásirányítás</span>
                        </div>
                        <span class="text-xs text-text-tertiary">Termelés- és kapacitástervezés</span>
                    </div>
                    <h3 class="mb-3 text-xl font-bold text-text-primary">Tervezze és kövesse a gyártási folyamatot valós időben</h3>
                    <p class="mb-6 text-sm leading-relaxed text-text-secondary">Kapacitástervezés Gantt-diagrammal, gyártási sorrend optimalizálás, erőforrás-ütemezés, minőségellenőrzés és karbantartás — egyetlen modulban az egész termelési ciklus.</p>
                    <div class="mb-6 grid grid-cols-2 gap-2">
                        <span class="flex items-center gap-2 text-sm text-text-secondary">
                            <span class="feature-dot h-1.5 w-1.5 rounded-full bg-warning-500"></span>Gantt ütemterv
                        </span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary">
                            <span class="feature-dot h-1.5 w-1.5 rounded-full bg-warning-500"></span>Kapacitástervezés
                        </span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary">
                            <span class="feature-dot h-1.5 w-1.5 rounded-full bg-warning-500"></span>Minőségellenőrzés
                        </span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary">
                            <span class="feature-dot h-1.5 w-1.5 rounded-full bg-warning-500"></span>Karbantartás
                        </span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary">
                            <span class="feature-dot h-1.5 w-1.5 rounded-full bg-warning-500"></span>Darabjegyzék (BOM)
                        </span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary">
                            <span class="feature-dot h-1.5 w-1.5 rounded-full bg-warning-500"></span>OEE mutatók
                        </span>
                    </div>
                    <a href="{{ route('products.gyartas') }}" class="inline-flex items-center gap-1.5 text-sm font-semibold text-warning-600 transition-colors hover:text-warning-700">
                        Részletek megtekintése
                        <svg class="arrow-slide h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                        </svg>
                    </a>
                </div>

                {{-- Digitális munkalap --}}
                <div class="stagger-item group card-glow rounded-2xl border border-border-light bg-surface-primary p-8 transition-all hover:border-success-200"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="mb-5 flex items-center gap-3">
                        <div class="icon-hover">
                            <x-module-icon module="szerviz" size="sm" rounded="lg" />
                        </div>
                        <div>
                            <span class="rounded-md bg-success-50 px-2.5 py-1 text-xs font-bold uppercase tracking-wider text-success-600">Digitális munkalap</span>
                        </div>
                        <span class="text-xs text-text-tertiary">Helyszíni munkák rögzítése</span>
                    </div>
                    <h3 class="mb-3 text-xl font-bold text-text-primary">Rögzítsen mindent a helyszínen — papír nélkül</h3>
                    <p class="mb-6 text-sm leading-relaxed text-text-secondary">Munkaidő, felhasznált anyagok, fotódokumentáció — mobilról, a helyszínen. Azonnali digitális jegyzőkönyv az ügyfélnek, a számlázási adatok pedig azonnal az irodában.</p>
                    <div class="mb-6 grid grid-cols-2 gap-2">
                        <span class="flex items-center gap-2 text-sm text-text-secondary">
                            <span class="feature-dot h-1.5 w-1.5 rounded-full bg-success-500"></span>Munkaidő rögzítés
                        </span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary">
                            <span class="feature-dot h-1.5 w-1.5 rounded-full bg-success-500"></span>Anyagfelhasználás
                        </span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary">
                            <span class="feature-dot h-1.5 w-1.5 rounded-full bg-success-500"></span>Fotódokumentáció
                        </span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary">
                            <span class="feature-dot h-1.5 w-1.5 rounded-full bg-success-500"></span>Digitális jegyzőkönyv
                        </span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary">
                            <span class="feature-dot h-1.5 w-1.5 rounded-full bg-success-500"></span>Aláírás a helyszínen
                        </span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary">
                            <span class="feature-dot h-1.5 w-1.5 rounded-full bg-success-500"></span>Azonnali számlázási adat
                        </span>
                    </div>
                    <a href="{{ route('products.szerviz') }}" class="inline-flex items-center gap-1.5 text-sm font-semibold text-success-600 transition-colors hover:text-success-700">
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
                    <h3 class="mb-3 text-xl font-bold text-text-primary">Automatizálja a projekt ismétlődő feladatait</h3>
                    <p class="mb-6 text-sm leading-relaxed text-text-secondary">Vizuális drag-and-drop workflow builder: határidő-emlékeztetők, feladat-delegálás, dokumentum-generálás és státuszfrissítések — szabályalapúan, kód nélkül.</p>
                    <div class="mb-6 grid grid-cols-2 gap-2">
                        <span class="flex items-center gap-2 text-sm text-text-secondary">
                            <span class="feature-dot h-1.5 w-1.5 rounded-full bg-violet-500"></span>Drag & drop workflow
                        </span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary">
                            <span class="feature-dot h-1.5 w-1.5 rounded-full bg-violet-500"></span>Triggerek és feltételek
                        </span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary">
                            <span class="feature-dot h-1.5 w-1.5 rounded-full bg-violet-500"></span>Automatikus értesítések
                        </span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary">
                            <span class="feature-dot h-1.5 w-1.5 rounded-full bg-violet-500"></span>Dokumentum generálás
                        </span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary">
                            <span class="feature-dot h-1.5 w-1.5 rounded-full bg-violet-500"></span>Feladat-delegálás
                        </span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary">
                            <span class="feature-dot h-1.5 w-1.5 rounded-full bg-violet-500"></span>Adatszinkronizálás
                        </span>
                    </div>
                    <a href="{{ route('products.automatizalas') }}" class="inline-flex items-center gap-1.5 text-sm font-semibold text-violet-600 transition-colors hover:text-violet-700">
                        Részletek megtekintése
                        <svg class="arrow-slide h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                        </svg>
                    </a>
                </div>

                {{-- Kontrolling --}}
                <div class="stagger-item group card-glow rounded-2xl border border-border-light bg-surface-primary p-8 transition-all hover:border-blue-200"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="mb-5 flex items-center gap-3">
                        <div class="icon-hover">
                            <x-module-icon module="kontrolling" size="sm" rounded="lg" />
                        </div>
                        <div>
                            <span class="rounded-md bg-blue-50 px-2.5 py-1 text-xs font-bold uppercase tracking-wider text-blue-600">Kontrolling</span>
                        </div>
                        <span class="text-xs text-text-tertiary">Projekt pénzügyi kontroll</span>
                    </div>
                    <h3 class="mb-3 text-xl font-bold text-text-primary">Lássa a projekt jövedelmezőségét — valós időben</h3>
                    <p class="mb-6 text-sm leading-relaxed text-text-secondary">Projekt-szintű bevétel-költség elemzés, cash flow követés, tervezett vs. tényleges költségek összehasonlítása. A havi zárás napok helyett órákra csökken.</p>
                    <div class="mb-6 grid grid-cols-2 gap-2">
                        <span class="flex items-center gap-2 text-sm text-text-secondary">
                            <span class="feature-dot h-1.5 w-1.5 rounded-full bg-blue-500"></span>Projekt P&L
                        </span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary">
                            <span class="feature-dot h-1.5 w-1.5 rounded-full bg-blue-500"></span>Cash flow követés
                        </span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary">
                            <span class="feature-dot h-1.5 w-1.5 rounded-full bg-blue-500"></span>Terv vs. tény összehasonlítás
                        </span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary">
                            <span class="feature-dot h-1.5 w-1.5 rounded-full bg-blue-500"></span>Költséghely-bontás
                        </span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary">
                            <span class="feature-dot h-1.5 w-1.5 rounded-full bg-blue-500"></span>Automatikus riportok
                        </span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary">
                            <span class="feature-dot h-1.5 w-1.5 rounded-full bg-blue-500"></span>Vezetői dashboard
                        </span>
                    </div>
                    <a href="{{ route('products.kontrolling') }}" class="inline-flex items-center gap-1.5 text-sm font-semibold text-blue-600 transition-colors hover:text-blue-700">
                        Részletek megtekintése
                        <svg class="arrow-slide h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{-- Project Lifecycle Section --}}
    <section class="bg-surface-secondary py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-6">
            <div class="reveal mb-14">
                <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-warning-600">Projekt életciklus</p>
                <h2 class="mb-4 text-3xl text-text-primary md:text-4xl" style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                    Zárt rendszer — az ajánlattól az átadásig
                </h2>
                <p class="max-w-xl text-lg text-text-secondary">
                    Minden projektfázisban más-más modul lép működésbe — de az adatok mindig egyazon rendszerben maradnak.
                </p>
            </div>

            <div class="relative">
                {{-- Connector line (desktop only) --}}
                <div class="lifecycle-line reveal absolute top-8 right-[8%] left-[8%] hidden h-0.5 lg:block"></div>

                <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-6" data-stagger>
                    @php
                        $lifecycle = [
                            ['num' => '01', 'title' => 'Ajánlattétel', 'desc' => 'Az ügyfél igényeit felmérik, professzionális ajánlat készül', 'modules' => ['CRM', 'Értékesítés'], 'color' => 'warning'],
                            ['num' => '02', 'title' => 'Tervezés', 'desc' => 'Kapacitás-ütemezés, BOM összeállítás és erőforrás-kiosztás', 'modules' => ['Gyártásirányítás', 'Automatizálás'], 'color' => 'amber'],
                            ['num' => '03', 'title' => 'Beszerzés', 'desc' => 'Anyagrendelés, szállítók kezelése és készletfoglalás', 'modules' => ['Beszerzés', 'Kontrolling'], 'color' => 'success'],
                            ['num' => '04', 'title' => 'Végrehajtás', 'desc' => 'Gyártás, telepítés és helyszíni munkák nyomon követése', 'modules' => ['Gyártásirányítás', 'Munkalap'], 'color' => 'primary'],
                            ['num' => '05', 'title' => 'Kontroll', 'desc' => 'Költségek, határidők és minőség ellenőrzése valós időben', 'modules' => ['Kontrolling', 'DataMind'], 'color' => 'violet'],
                            ['num' => '06', 'title' => 'Átadás', 'desc' => 'Digitális jegyzőkönyv, dokumentáció és ügyfél-elégedettség mérés', 'modules' => ['Munkalap', 'CRM'], 'color' => 'cyan'],
                        ];
                    @endphp

                    @foreach ($lifecycle as $step)
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
                    <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-warning-600">Teljes ökoszisztéma</p>
                    <h2 class="text-3xl text-text-primary md:text-4xl" style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                        Mind a 11 modul a projektsiker szolgálatában
                    </h2>
                </div>
                <p class="reveal-right text-lg leading-relaxed text-text-secondary lg:mt-6">
                    Egy ipari projekt nem csak a termelés. Az ajánlat, a beszerzés, a pénzügy, a helyszíni munka és az ügyfélkommunikáció mind összefüggnek. A Cégem360-ban minden adat ugyanabban a rendszerben él.
                </p>
            </div>

            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4" data-stagger>
                <div class="stagger-item card-glow rounded-xl border border-border-light bg-surface-primary p-6 text-center"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="icon-hover mx-auto mb-3 flex h-11 w-11 items-center justify-center rounded-xl bg-primary-50">
                        <x-module-icon module="crm" size="xs" />
                    </div>
                    <h4 class="mb-1 text-sm font-bold text-text-primary">CRM</h4>
                    <p class="text-xs leading-relaxed text-text-tertiary">Projekt-ügyfél kapcsolat: kommunikáció, szerződések és follow-up egy idővonalon.</p>
                </div>

                <div class="stagger-item card-glow rounded-xl border border-border-light bg-surface-primary p-6 text-center"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="icon-hover mx-auto mb-3 flex h-11 w-11 items-center justify-center rounded-xl bg-warning-50">
                        <x-module-icon module="ertekesites" size="xs" />
                    </div>
                    <h4 class="mb-1 text-sm font-bold text-text-primary">Értékesítés</h4>
                    <p class="text-xs leading-relaxed text-text-tertiary">Ajánlatsablonok, árazás és ajánlat→rendelés konverzió — a projekt kiindulópontja.</p>
                </div>

                <div class="stagger-item card-glow rounded-xl border border-border-light bg-surface-primary p-6 text-center"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="icon-hover mx-auto mb-3 flex h-11 w-11 items-center justify-center rounded-xl bg-success-50">
                        <x-module-icon module="beszerzes" size="xs" />
                    </div>
                    <h4 class="mb-1 text-sm font-bold text-text-primary">Beszerzés-logisztika</h4>
                    <p class="text-xs leading-relaxed text-text-tertiary">Projekthez rendelt anyagrendelés, szállító-kezelés és készletfoglalás automatikusan.</p>
                </div>

                <div class="stagger-item card-glow rounded-xl border border-border-light bg-surface-primary p-6 text-center"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="icon-hover mx-auto mb-3 flex h-11 w-11 items-center justify-center rounded-xl bg-danger-50">
                        <x-module-icon module="seo" size="xs" />
                    </div>
                    <h4 class="mb-1 text-sm font-bold text-text-primary">SEO Eszköz</h4>
                    <p class="text-xs leading-relaxed text-text-tertiary">Referencia-projektek és esettanulmányok SEO-optimalizálása — hogy új ügyfelek találjanak Önre.</p>
                </div>

                <div class="stagger-item card-glow rounded-xl border border-border-light bg-surface-primary p-6 text-center"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="icon-hover mx-auto mb-3 flex h-11 w-11 items-center justify-center rounded-xl bg-violet-50">
                        <x-module-icon module="marketinghub" size="xs" />
                    </div>
                    <h4 class="mb-1 text-sm font-bold text-text-primary">MarketingHub</h4>
                    <p class="text-xs leading-relaxed text-text-tertiary">Projekt-referenciák és ügyfél-elégedettségi adatok a marketing kampányok számára.</p>
                </div>

                <div class="stagger-item card-glow rounded-xl border border-border-light bg-surface-primary p-6 text-center"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="icon-hover mx-auto mb-3 flex h-11 w-11 items-center justify-center rounded-xl bg-cyan-50">
                        <x-module-icon module="datamind" size="xs" />
                    </div>
                    <h4 class="mb-1 text-sm font-bold text-text-primary">DataMind</h4>
                    <p class="text-xs leading-relaxed text-text-tertiary">Projekt-adatok MI elemzése: trend előrejelzés, anomália-detektálás és prediktív becslések.</p>
                </div>

                <div class="stagger-item card-glow rounded-xl border border-border-light bg-surface-primary p-6 text-center"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="icon-hover mx-auto mb-3 flex h-11 w-11 items-center justify-center rounded-xl bg-blue-50">
                        <x-module-icon module="ai-chat" size="xs" />
                    </div>
                    <h4 class="mb-1 text-sm font-bold text-text-primary">AI Chat</h4>
                    <p class="text-xs leading-relaxed text-text-tertiary">Ügyfélkommunikáció automatizálása: projekt státusz lekérdezés a weboldalon, 0-24.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Stats Section --}}
    <section class="bg-surface-secondary py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-6">
            <div class="reveal mb-12 text-center">
                <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-warning-600">Eredmények</p>
                <h2 class="text-3xl text-text-primary md:text-4xl" style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                    Mérhető javulás az ipari projekteken
                </h2>
            </div>

            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4" data-stagger data-counter-trigger>
                <div class="stagger-item stat-hover rounded-2xl border border-border-light bg-surface-primary p-8 text-center"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <p class="stat-value mb-2 text-4xl font-bold text-warning-600" style="font-family: 'JetBrains Mono', monospace;" data-count="30" data-prefix="+" data-suffix="%">0%</p>
                    <p class="text-sm font-medium text-text-secondary">Határidő-tartás javulás</p>
                </div>

                <div class="stagger-item stat-hover rounded-2xl border border-border-light bg-surface-primary p-8 text-center"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <p class="stat-value mb-2 text-4xl font-bold text-success-600" style="font-family: 'JetBrains Mono', monospace;" data-count="25" data-prefix="-" data-suffix="%">0%</p>
                    <p class="text-sm font-medium text-text-secondary">Projektköltség csökkenés</p>
                </div>

                <div class="stagger-item stat-hover rounded-2xl border border-border-light bg-surface-primary p-8 text-center"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <p class="stat-value mb-2 text-4xl font-bold text-primary-600" style="font-family: 'JetBrains Mono', monospace;" data-count="70" data-suffix="%">0%</p>
                    <p class="text-sm font-medium text-text-secondary">Gyorsabb adminisztráció</p>
                </div>

                <div class="stagger-item stat-hover rounded-2xl border border-border-light bg-surface-primary p-8 text-center"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <p class="stat-value mb-2 text-4xl font-bold text-violet-600" style="font-family: 'JetBrains Mono', monospace;" data-count="40" data-prefix="-" data-suffix="%">0%</p>
                    <p class="text-sm font-medium text-text-secondary">Gépleállások csökkenése</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Use Cases Section --}}
    <section class="bg-surface-primary py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-6">
            <div class="reveal mb-12">
                <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-warning-600">Felhasználási esetek</p>
                <h2 class="mb-4 text-3xl text-text-primary md:text-4xl" style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                    Így használják ipari projektvezetők
                </h2>
            </div>

            <div class="grid grid-cols-1 gap-5 md:grid-cols-2 lg:grid-cols-3" data-stagger>
                @php
                    $useCases = [
                        ['num' => '01', 'title' => 'Gyártósor telepítési projekt', 'desc' => 'Az ajánlattételtől a próbaüzemig: kapacitástervezés, beszerzés, helyszíni szerelés és átadási jegyzőkönyv — egyetlen rendszerben, Gantt-nézeten.', 'tags' => ['Gyártásirányítás', 'Munkalap', 'Beszerzés']],
                        ['num' => '02', 'title' => 'Szerviz- és karbantartási projektek', 'desc' => 'Megelőző karbantartási ütemtervek, helyszíni munkalapok és anyagfelhasználás — a számlázási adatok azonnal az irodában.', 'tags' => ['Munkalap', 'Automatizálás', 'Kontrolling']],
                        ['num' => '03', 'title' => 'Projekt-alapú költségkontroll', 'desc' => 'Valós idejű projekt P&L: terv vs. tény, anyag- és munkaóra-költségek és automatikus riasztás, ha a büdzsé veszélyben van.', 'tags' => ['Kontrolling', 'Gyártásirányítás', 'DataMind']],
                        ['num' => '04', 'title' => 'Többhelyszínes kivitelezés', 'desc' => 'Különböző helyszíneken dolgozó csapatok koordinálása: feladat-delegálás, státuszkövetés és automatikus értesítések — egy rendszerben.', 'tags' => ['Automatizálás', 'Munkalap', 'CRM']],
                        ['num' => '05', 'title' => 'Beszerzés-koordináció projektekhez', 'desc' => 'Projekthez rendelt anyagrendelés, szállítási határidők nyomon követése és automatikus készletfoglalás — hogy ne a hiányzó alkatrész állítsa meg a projektet.', 'tags' => ['Beszerzés', 'Gyártásirányítás']],
                        ['num' => '06', 'title' => 'Prediktív projekt-elemzés', 'desc' => 'A DataMind MI modellje korábbi projektek adataiból tanulva jelzi előre a késés- és túlköltés kockázatát — még azelőtt, hogy bekövetkezne.', 'tags' => ['DataMind', 'Kontrolling']],
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
                                <span class="rounded-md bg-warning-50 px-2.5 py-1 text-xs font-medium text-warning-700 transition-colors hover:bg-warning-100">{{ $tag }}</span>
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
                <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-warning-600">Összehasonlítás</p>
                <h2 class="mb-4 text-3xl text-text-primary md:text-4xl" style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                    Excel és e-mail helyett — integrált rendszer
                </h2>
                <p class="max-w-xl text-lg text-text-secondary">
                    Így változik meg a projekt-koordináció a Cégem360 bevezetésével.
                </p>
            </div>

            <div class="reveal-scale overflow-hidden rounded-2xl border border-border-light"
                style="box-shadow: 0 4px 20px -4px rgba(0,0,0,0.06);">
                <table class="w-full text-left text-sm">
                    <thead>
                        <tr class="bg-surface-primary">
                            <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-text-primary">Képesség</th>
                            <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-text-tertiary">Excel + E-mail</th>
                            <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-warning-600">Cégem360</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-border-light">
                        @php
                            $comparisons = [
                                ['cap' => 'Valós idejű projekt státusz', 'old' => 'Kézi frissítés', 'new' => 'Automatikus'],
                                ['cap' => 'Helyszíni adatrögzítés', 'old' => 'Papír → begépelés', 'new' => 'Mobilról, azonnal'],
                                ['cap' => 'Projekt-költségkontroll', 'old' => 'Hónap végi meglepetés', 'new' => 'Valós idejű P&L'],
                                ['cap' => 'Beszerzés-koordináció', 'old' => 'E-mail láncolatok', 'new' => 'Integrált készletfoglalás'],
                                ['cap' => 'Automatikus értesítések', 'old' => 'Nincs', 'new' => 'Trigger-alapú workflow'],
                                ['cap' => 'Ügyfél dokumentáció', 'old' => 'Napokkal később', 'new' => 'Azonnali digitális jegyzőkönyv'],
                                ['cap' => 'Prediktív elemzés', 'old' => 'Nem lehetséges', 'new' => 'MI alapú előrejelzés'],
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
                style="box-shadow: 0 4px 20px -4px rgba(245, 158, 11, 0.08);">
                <div>
                    <h3 class="mb-2 text-xl font-bold text-text-primary">Személyre szabott online konzultáció</h3>
                    <p class="mb-4 max-w-lg text-sm leading-relaxed text-text-secondary">30 perces videóhívás, amelyben felmérjük, hogyan illeszthető a Cégem360 az Ön ipari projektjeinek irányításába — a termeléstervezéstől a helyszíni munkákig.</p>
                    <div class="flex flex-wrap gap-5">
                        <span class="flex items-center gap-1.5 text-xs font-medium text-text-tertiary">
                            <svg class="h-3.5 w-3.5 text-success-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" /></svg>
                            30 perc videóhívás
                        </span>
                        <span class="flex items-center gap-1.5 text-xs font-medium text-text-tertiary">
                            <svg class="h-3.5 w-3.5 text-success-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" /></svg>
                            Ipari projektre szabott tanácsadás
                        </span>
                        <span class="flex items-center gap-1.5 text-xs font-medium text-text-tertiary">
                            <svg class="h-3.5 w-3.5 text-success-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" /></svg>
                            Nincs elköteleződés
                        </span>
                    </div>
                </div>
                <a href="{{ route('contact') }}"
                    class="group inline-flex shrink-0 items-center gap-2 rounded-full bg-warning-600 px-6 py-3 text-base font-medium text-white transition-all hover:bg-warning-700 hover:shadow-lg"
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
                <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-warning-600">Kezdje el</p>
                <h2 class="mb-4 text-3xl text-text-primary md:text-4xl" style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                    Készen áll a hatékonyabb projektmenedzsmentre?
                </h2>
                <p class="text-lg text-text-secondary">Válassza ki a következő lépést az Ön számára.</p>
            </div>

            <div class="mx-auto grid max-w-3xl grid-cols-1 gap-6 md:grid-cols-2" data-stagger>
                <div class="stagger-item card-glow rounded-2xl border border-warning-100 bg-linear-to-br from-warning-50/40 to-surface-primary p-8 text-center"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <h3 class="mb-3 text-lg font-bold text-text-primary">Online konzultáció</h3>
                    <p class="mb-6 text-sm leading-relaxed text-text-secondary">Kérdezzen szakértőinktől 30 percben — videóhíváson, az Ön ipari projektjére szabva, kötelezettség nélkül.</p>
                    <a href="{{ route('contact') }}"
                        class="group inline-flex items-center gap-2 rounded-full border border-border-light bg-surface-primary px-5 py-2.5 text-sm font-medium text-text-primary transition-all hover:border-warning-200 hover:bg-surface-secondary hover:shadow-md">
                        Időpont foglalása
                        <svg class="arrow-slide h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                        </svg>
                    </a>
                </div>

                <div class="stagger-item card-glow rounded-2xl border border-amber-100 bg-linear-to-br from-amber-50/40 to-surface-primary p-8 text-center"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <h3 class="mb-3 text-lg font-bold text-text-primary">Regisztráció és kipróbálás</h3>
                    <p class="mb-6 text-sm leading-relaxed text-text-secondary">Fedezze fel a platform teljes funkcionalitását. Ismerje meg a modulokat és kezdjen el dolgozni azonnal.</p>
                    <a href="{{ route('register') }}"
                        class="group inline-flex items-center gap-2 rounded-full bg-warning-600 px-5 py-2.5 text-sm font-medium text-white transition-all hover:bg-warning-700 hover:shadow-lg"
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
