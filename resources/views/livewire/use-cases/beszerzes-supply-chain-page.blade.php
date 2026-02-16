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
            0% { box-shadow: 0 0 0 0 rgba(6, 182, 212, 0.4); }
            70% { box-shadow: 0 0 0 6px rgba(6, 182, 212, 0); }
            100% { box-shadow: 0 0 0 0 rgba(6, 182, 212, 0); }
        }
        .pulse-dot { animation: pulse-ring 2s ease infinite; }

        /* Card hover glow */
        .card-glow {
            transition: all 0.4s cubic-bezier(0, 0, 0.2, 1);
        }
        .card-glow:hover {
            box-shadow: 0 8px 30px -8px rgba(6, 182, 212, 0.15), 0 2px 8px rgba(0,0,0,0.04) !important;
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

        /* Supply chain flow connector line */
        .flow-line {
            background: linear-gradient(90deg, transparent, var(--color-cyan-200), var(--color-blue-200), var(--color-success-200), transparent);
            transform: scaleX(0);
            transform-origin: left;
            transition: transform 1.2s cubic-bezier(0, 0, 0.2, 1) 0.3s;
        }
        .flow-line.revealed { transform: scaleX(1); }

        /* Inventory bar animation */
        @keyframes inv-grow {
            from { transform: scaleX(0); transform-origin: left; }
            to { transform: scaleX(1); transform-origin: left; }
        }
        .inv-bar {
            animation: inv-grow 0.8s cubic-bezier(0, 0, 0.2, 1) both;
        }

        /* Flow dot animation */
        @keyframes flow-dot {
            0% { left: 0; opacity: 0; }
            10% { opacity: 1; }
            90% { opacity: 1; }
            100% { left: 100%; opacity: 0; }
        }

        /* Pill float */
        .pill-float {
            transition: transform 0.35s cubic-bezier(0, 0, 0.2, 1), box-shadow 0.35s cubic-bezier(0, 0, 0.2, 1);
        }
        .pill-float:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 20px -4px rgba(6, 182, 212, 0.12);
        }

        /* Smooth scroll for anchor links */
        html { scroll-behavior: smooth; }
    </style>

    {{-- Hero Section --}}
    <section class="bg-linear-to-b from-cyan-50/60 to-surface-secondary">
        <div class="mx-auto max-w-7xl px-6 py-16 lg:py-24">
            <div class="grid grid-cols-1 items-center gap-12 lg:grid-cols-2">
                {{-- Hero Text --}}
                <div class="reveal">
                    <div class="badge-gradient mb-8 inline-flex items-center gap-2 rounded-full border border-border-light/80 bg-surface-primary px-4 py-1.5"
                        style="box-shadow: 0 1px 3px rgba(0,0,0,0.04);">
                        <span class="pulse-dot h-1.5 w-1.5 rounded-full bg-linear-to-r from-cyan-500 via-blue-500 to-success-500"></span>
                        <span class="text-sm font-medium text-text-primary">Ipari ellátásilánc-kezelés</span>
                    </div>

                    <h1 class="mb-6 text-4xl leading-tight tracking-tight text-text-primary md:text-5xl lg:text-[3.5rem]"
                        style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                        Tudja, mi van raktáron<br>
                        — és mi lesz holnap
                    </h1>

                    <p class="mb-10 max-w-xl text-lg text-text-secondary lg:text-xl">
                        Az ipari beszerzésben a késett szállítás, a hiányzó alkatrész vagy a túlkészletezés milliókat visz el. A Cégem360 valós idejű készletkezelést, beszállítói kontrollt és MI alapú tervezést ad az Ön ellátási láncának.
                    </p>

                    <div class="flex flex-wrap items-center gap-4">
                        <a href="{{ route('contact') }}"
                            class="group inline-flex items-center gap-2 rounded-full bg-cyan-600 px-6 py-3 text-base font-medium text-white transition-all hover:bg-cyan-700 hover:shadow-lg"
                            style="box-shadow: 0 1px 2px rgba(0,0,0,0.05);">
                            <span>Online konzultáció</span>
                            <svg class="arrow-slide h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                            </svg>
                        </a>
                        <a href="#megoldasok"
                            class="inline-flex items-center gap-2 rounded-full border border-border-light bg-surface-primary px-6 py-3 text-base font-medium text-text-primary transition-all hover:border-cyan-200 hover:bg-surface-secondary hover:shadow-md">
                            Megoldások áttekintése
                        </a>
                    </div>
                </div>

                {{-- Supply Chain Tracker Visual --}}
                <div class="reveal-right">
                    <div class="rounded-2xl border border-border-light bg-surface-primary p-6"
                        style="box-shadow: 0 4px 20px -4px rgba(0,0,0,0.06);">
                        <div class="mb-4 flex items-center justify-between border-b border-border-light pb-4">
                            <span class="text-sm font-bold text-text-primary">Ellátásilánc tracker — Valós idejű</span>
                            <span class="text-xs text-text-tertiary">Ipari gyártó · 2026. február</span>
                        </div>

                        {{-- Inventory Levels --}}
                        <div class="mb-5 space-y-2.5">
                            <div>
                                <div class="mb-1 flex items-center justify-between">
                                    <span class="text-xs font-semibold text-text-secondary">Acéllemez</span>
                                    <div class="flex items-center gap-2">
                                        <span class="text-xs font-bold text-text-primary" style="font-family: 'JetBrains Mono', monospace;">85%</span>
                                        <span class="text-[10px] text-success-600">Optimális</span>
                                    </div>
                                </div>
                                <div class="h-5 w-full rounded-md bg-surface-secondary">
                                    <div class="inv-bar h-5 rounded-md bg-cyan-400" style="width: 85%; animation-delay: 0.1s;"></div>
                                </div>
                            </div>
                            <div>
                                <div class="mb-1 flex items-center justify-between">
                                    <span class="text-xs font-semibold text-text-secondary">Csapágyak</span>
                                    <div class="flex items-center gap-2">
                                        <span class="text-xs font-bold text-text-primary" style="font-family: 'JetBrains Mono', monospace;">42%</span>
                                        <span class="text-[10px] text-warning-600">Rendelés küldve</span>
                                    </div>
                                </div>
                                <div class="h-5 w-full rounded-md bg-surface-secondary">
                                    <div class="inv-bar h-5 rounded-md bg-warning-400" style="width: 42%; animation-delay: 0.2s;"></div>
                                </div>
                            </div>
                            <div>
                                <div class="mb-1 flex items-center justify-between">
                                    <span class="text-xs font-semibold text-text-secondary">Elektronika</span>
                                    <div class="flex items-center gap-2">
                                        <span class="text-xs font-bold text-text-primary" style="font-family: 'JetBrains Mono', monospace;">92%</span>
                                        <span class="text-[10px] text-success-600">Feltöltve</span>
                                    </div>
                                </div>
                                <div class="h-5 w-full rounded-md bg-surface-secondary">
                                    <div class="inv-bar h-5 rounded-md bg-success-400" style="width: 92%; animation-delay: 0.3s;"></div>
                                </div>
                            </div>
                            <div>
                                <div class="mb-1 flex items-center justify-between">
                                    <span class="text-xs font-semibold text-text-secondary">Tömítések</span>
                                    <div class="flex items-center gap-2">
                                        <span class="text-xs font-bold text-text-primary" style="font-family: 'JetBrains Mono', monospace;">18%</span>
                                        <span class="text-[10px] font-semibold text-danger-600">Kritikus!</span>
                                    </div>
                                </div>
                                <div class="h-5 w-full rounded-md bg-surface-secondary">
                                    <div class="inv-bar h-5 rounded-md bg-danger-400" style="width: 18%; animation-delay: 0.4s;"></div>
                                </div>
                            </div>
                        </div>

                        {{-- Supply Chain Flow --}}
                        <div class="mb-4 flex items-center gap-0 rounded-xl border border-cyan-100 bg-cyan-50/40 px-4 py-3">
                            <div class="flex flex-1 flex-col items-center gap-1">
                                <span class="h-2.5 w-2.5 rounded-full bg-cyan-500" style="box-shadow: 0 0 8px rgba(6,182,212,0.5);"></span>
                                <span class="text-[10px] font-semibold uppercase tracking-wider text-text-tertiary">Rendelés</span>
                            </div>
                            <div class="h-0.5 max-w-[60px] flex-1 bg-linear-to-r from-cyan-300 to-cyan-200"></div>
                            <div class="flex flex-1 flex-col items-center gap-1">
                                <span class="h-2.5 w-2.5 rounded-full bg-blue-500" style="box-shadow: 0 0 8px rgba(59,130,246,0.5);"></span>
                                <span class="text-[10px] font-semibold uppercase tracking-wider text-text-tertiary">Szállítás</span>
                            </div>
                            <div class="h-0.5 max-w-[60px] flex-1 bg-linear-to-r from-blue-300 to-blue-200"></div>
                            <div class="flex flex-1 flex-col items-center gap-1">
                                <span class="h-2.5 w-2.5 rounded-full bg-violet-500" style="box-shadow: 0 0 8px rgba(139,92,246,0.5);"></span>
                                <span class="text-[10px] font-semibold uppercase tracking-wider text-text-tertiary">Bevételezés</span>
                            </div>
                            <div class="h-0.5 max-w-[60px] flex-1 bg-linear-to-r from-violet-300 to-success-200"></div>
                            <div class="flex flex-1 flex-col items-center gap-1">
                                <span class="h-2.5 w-2.5 rounded-full bg-success-500" style="box-shadow: 0 0 8px rgba(16,185,129,0.5);"></span>
                                <span class="text-[10px] font-semibold uppercase tracking-wider text-text-tertiary">Felhasználás</span>
                            </div>
                        </div>

                        {{-- Order rows --}}
                        <div class="space-y-1.5">
                            <div class="flex items-center justify-between rounded-lg bg-surface-secondary px-3 py-2">
                                <div>
                                    <span class="block text-xs font-medium text-text-secondary">SKF csapágykészlet</span>
                                    <span class="text-[10px] text-text-tertiary">MagyarBearing Kft.</span>
                                </div>
                                <span class="text-xs font-bold text-text-primary" style="font-family: 'JetBrains Mono', monospace;">2.4M Ft</span>
                                <span class="rounded bg-cyan-50 px-2 py-0.5 text-[10px] font-semibold text-cyan-700">Úton</span>
                                <span class="text-[11px] text-text-tertiary" style="font-family: 'JetBrains Mono', monospace;">ETA: 2 nap</span>
                            </div>
                            <div class="flex items-center justify-between rounded-lg bg-surface-secondary px-3 py-2">
                                <div>
                                    <span class="block text-xs font-medium text-text-secondary">Hegesztőhuzal (180 kg)</span>
                                    <span class="text-[10px] text-text-tertiary">WeldTech Zrt.</span>
                                </div>
                                <span class="text-xs font-bold text-text-primary" style="font-family: 'JetBrains Mono', monospace;">680E Ft</span>
                                <span class="rounded bg-success-50 px-2 py-0.5 text-[10px] font-semibold text-success-700">Beérkezett</span>
                                <span class="text-[11px] text-text-tertiary" style="font-family: 'JetBrains Mono', monospace;">Ma 08:15</span>
                            </div>
                            <div class="flex items-center justify-between rounded-lg bg-surface-secondary px-3 py-2">
                                <div>
                                    <span class="block text-xs font-medium text-text-secondary">Tömítéskészlet (ipari)</span>
                                    <span class="text-[10px] text-text-tertiary">SealPro Bt.</span>
                                </div>
                                <span class="text-xs font-bold text-text-primary" style="font-family: 'JetBrains Mono', monospace;">340E Ft</span>
                                <span class="rounded bg-warning-50 px-2 py-0.5 text-[10px] font-semibold text-warning-700">Jóváhagyásra vár</span>
                                <span class="text-[11px] font-semibold text-danger-600" style="font-family: 'JetBrains Mono', monospace;">Sürgős</span>
                            </div>
                        </div>

                        {{-- Status bar --}}
                        <div class="mt-4 flex gap-5 border-t border-border-light pt-3">
                            <span class="flex items-center gap-1.5 text-[11px] text-text-tertiary">
                                <span class="h-2 w-2 rounded-full bg-success-500"></span> 12 aktív beszállító
                            </span>
                            <span class="flex items-center gap-1.5 text-[11px] text-text-tertiary">
                                <span class="h-2 w-2 rounded-full bg-cyan-500"></span> 3 úton lévő szállítmány
                            </span>
                            <span class="flex items-center gap-1.5 text-[11px] text-text-tertiary">
                                <span class="h-2 w-2 rounded-full bg-danger-500"></span> 1 kritikus készlet
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
                <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-cyan-600">A kihívás</p>
                <h2 class="mb-4 text-3xl text-text-primary md:text-4xl" style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                    Ezek akadályozzák az ipari beszerzést és raktárkezelést
                </h2>
                <p class="max-w-xl text-lg text-text-secondary">
                    Ismerős helyzetek gyártó, szerelő és karbantartó cégek beszerzési csapatainak.
                </p>
            </div>

            <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4" data-stagger>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-7"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="icon-hover mb-5 flex h-12 w-12 items-center justify-center rounded-xl bg-danger-50">
                        <svg class="h-6 w-6 text-danger-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                    </div>
                    <h3 class="mb-2 text-lg font-bold text-text-primary">Váratlan készlethiány</h3>
                    <p class="text-sm leading-relaxed text-text-secondary">Csak akkor derül ki, hogy elfogy egy kulcsfontosságú alkatrész, amikor a szerelő nyúlna érte. A gyártás leáll, a projekt csúszik.</p>
                </div>

                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-7"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="icon-hover mb-5 flex h-12 w-12 items-center justify-center rounded-xl bg-warning-50">
                        <svg class="h-6 w-6 text-warning-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="mb-2 text-lg font-bold text-text-primary">Túlkészletezés és tőkelekötés</h3>
                    <p class="text-sm leading-relaxed text-text-secondary">Biztonsági okokból mindenből sokat rendelnek, de a raktárban milliót érő anyag hever — amelynek egy részéből sosem lesz felhasználás.</p>
                </div>

                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-7"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="icon-hover mb-5 flex h-12 w-12 items-center justify-center rounded-xl bg-violet-50">
                        <svg class="h-6 w-6 text-violet-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" />
                        </svg>
                    </div>
                    <h3 class="mb-2 text-lg font-bold text-text-primary">Beszállítói káosz</h3>
                    <p class="text-sm leading-relaxed text-text-secondary">Ki szállít mit, mennyiért, mikorra? A beszállítói adatok szétszórtan vannak: e-mailben, telefonon, fejben. Nem tudja összehasonlítani az ajánlatokat.</p>
                </div>

                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-7"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="icon-hover mb-5 flex h-12 w-12 items-center justify-center rounded-xl bg-cyan-50">
                        <svg class="h-6 w-6 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <h3 class="mb-2 text-lg font-bold text-text-primary">Manuális rendelési folyamat</h3>
                    <p class="text-sm leading-relaxed text-text-secondary">A beszerzési igény szóban érkezik, a rendelés e-mailben megy ki, a bevételezés papíron történik. Nincs automatizmus, nincs jóváhagyási workflow.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Target Audiences Section --}}
    <section class="bg-surface-secondary py-16 lg:py-24" id="celcsoportok">
        <div class="mx-auto max-w-7xl px-6">
            <div class="reveal mb-12">
                <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-cyan-600">Ki használja?</p>
                <h2 class="mb-4 text-3xl text-text-primary md:text-4xl" style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                    A teljes ellátási lánc — egy felületen, valós időben
                </h2>
                <p class="max-w-xl text-lg text-text-secondary">
                    A Cégem360 a beszerzéstől a raktárig és a gyártásig átláthatóságot biztosít.
                </p>
            </div>

            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4" data-stagger>
                <div class="stagger-item group card-glow relative overflow-hidden rounded-2xl border border-border-light bg-surface-primary p-8"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="absolute inset-x-0 top-0 h-1 bg-linear-to-r from-cyan-500 to-blue-400 opacity-0 transition-opacity duration-500 group-hover:opacity-100"></div>
                    <div class="icon-hover mb-4 flex h-14 w-14 items-center justify-center rounded-2xl bg-cyan-50">
                        <svg class="h-7 w-7 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 100 4 2 2 0 000-4z" />
                        </svg>
                    </div>
                    <p class="mb-2 text-xs font-semibold uppercase tracking-wider text-cyan-600">Beszerzési vezető</p>
                    <h3 class="mb-3 text-lg font-bold text-text-primary">Beszerzési vezetők</h3>
                    <p class="text-sm leading-relaxed text-text-secondary">Szállítói összehasonlítás, automatikus rendelési pontok, kedvezmény-kezelés és beszállítói teljesítmény-értékelés — egy rendszerben.</p>
                </div>

                <div class="stagger-item group card-glow relative overflow-hidden rounded-2xl border border-border-light bg-surface-primary p-8"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="absolute inset-x-0 top-0 h-1 bg-linear-to-r from-blue-500 to-violet-400 opacity-0 transition-opacity duration-500 group-hover:opacity-100"></div>
                    <div class="icon-hover mb-4 flex h-14 w-14 items-center justify-center rounded-2xl bg-blue-50">
                        <svg class="h-7 w-7 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                        </svg>
                    </div>
                    <p class="mb-2 text-xs font-semibold uppercase tracking-wider text-blue-600">Raktárvezető</p>
                    <h3 class="mb-3 text-lg font-bold text-text-primary">Raktárvezetők</h3>
                    <p class="text-sm leading-relaxed text-text-secondary">Valós idejű készletszintek, bevételezési workflow, leltár-támogatás és készlethely-kezelés — papír nélkül.</p>
                </div>

                <div class="stagger-item group card-glow relative overflow-hidden rounded-2xl border border-border-light bg-surface-primary p-8"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="absolute inset-x-0 top-0 h-1 bg-linear-to-r from-warning-500 to-amber-400 opacity-0 transition-opacity duration-500 group-hover:opacity-100"></div>
                    <div class="icon-hover mb-4 flex h-14 w-14 items-center justify-center rounded-2xl bg-warning-50">
                        <svg class="h-7 w-7 text-warning-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.066 2.573c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.573 1.066c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.066-2.573c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>
                    <p class="mb-2 text-xs font-semibold uppercase tracking-wider text-warning-600">Termelési vezető</p>
                    <h3 class="mb-3 text-lg font-bold text-text-primary">Üzem- és termelési vezetők</h3>
                    <p class="text-sm leading-relaxed text-text-secondary">Anyagszükséglet automatikusan a gyártási tervből. Tudja, mikor fog anyag kelleni — és azt is, hogy lesz-e időben.</p>
                </div>

                <div class="stagger-item group card-glow relative overflow-hidden rounded-2xl border border-border-light bg-surface-primary p-8"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="absolute inset-x-0 top-0 h-1 bg-linear-to-r from-indigo-500 to-blue-400 opacity-0 transition-opacity duration-500 group-hover:opacity-100"></div>
                    <div class="icon-hover mb-4 flex h-14 w-14 items-center justify-center rounded-2xl bg-indigo-50">
                        <svg class="h-7 w-7 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <p class="mb-2 text-xs font-semibold uppercase tracking-wider text-indigo-600">Pénzügyi kontroll</p>
                    <h3 class="mb-3 text-lg font-bold text-text-primary">CFO-k és kontrollerek</h3>
                    <p class="text-sm leading-relaxed text-text-secondary">Beszerzési költségek, készletérték, szállítói kötelezettségek és cash flow hatás — valós idejű pénzügyi adatok a beszerzésből.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Core Toolkit Section --}}
    <section class="bg-surface-primary py-16 lg:py-24" id="megoldasok">
        <div class="mx-auto max-w-7xl px-6">
            <div class="reveal mb-12">
                <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-cyan-600">Beszerzési eszköztár</p>
                <h2 class="mb-4 text-3xl text-text-primary md:text-4xl" style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                    4 kulcsmodul az ellátási lánc kezeléséhez
                </h2>
                <p class="max-w-xl text-lg text-text-secondary">
                    Ezek a modulok együttesen adják az ipari beszerzés digitalizálásának alapját.
                </p>
            </div>

            <div class="grid grid-cols-1 gap-6 lg:grid-cols-2" data-stagger>
                {{-- Beszerzés-logisztika --}}
                <div class="stagger-item group card-glow rounded-2xl border border-border-light bg-surface-primary p-8 transition-all hover:border-cyan-200"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="mb-5 flex items-center gap-3">
                        <div class="icon-hover">
                            <x-module-icon module="beszerzes" size="sm" rounded="lg" />
                        </div>
                        <div>
                            <span class="rounded-md bg-cyan-50 px-2.5 py-1 text-xs font-bold uppercase tracking-wider text-cyan-600">Beszerzés-logisztika</span>
                        </div>
                        <span class="text-xs text-text-tertiary">Készlet és szállításkezelés</span>
                    </div>
                    <h3 class="mb-3 text-xl font-bold text-text-primary">Készletkezelés, szállítói rendelés és bevételezés</h3>
                    <p class="mb-6 text-sm leading-relaxed text-text-secondary">Valós idejű készletszint követés, automatikus minimum-készlet riasztás, beszállítói adatbázis, rendelés-kezelés és bevételezési workflow — a beszerzés központi agya.</p>
                    <div class="mb-6 grid grid-cols-2 gap-2">
                        <span class="flex items-center gap-2 text-sm text-text-secondary">
                            <span class="feature-dot h-1.5 w-1.5 rounded-full bg-cyan-500"></span>Valós idejű készletszint
                        </span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary">
                            <span class="feature-dot h-1.5 w-1.5 rounded-full bg-cyan-500"></span>Automatikus újrarendelés
                        </span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary">
                            <span class="feature-dot h-1.5 w-1.5 rounded-full bg-cyan-500"></span>Beszállítói adatbázis
                        </span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary">
                            <span class="feature-dot h-1.5 w-1.5 rounded-full bg-cyan-500"></span>Ajánlat-összehasonlítás
                        </span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary">
                            <span class="feature-dot h-1.5 w-1.5 rounded-full bg-cyan-500"></span>Bevételezési workflow
                        </span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary">
                            <span class="feature-dot h-1.5 w-1.5 rounded-full bg-cyan-500"></span>Leltár-támogatás
                        </span>
                    </div>
                    <a href="{{ route('products.beszerzes') }}" class="inline-flex items-center gap-1.5 text-sm font-semibold text-cyan-600 transition-colors hover:text-cyan-700">
                        Részletek megtekintése
                        <svg class="arrow-slide h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                        </svg>
                    </a>
                </div>

                {{-- Gyártásirányítás --}}
                <div class="stagger-item group card-glow rounded-2xl border border-border-light bg-surface-primary p-8 transition-all hover:border-success-200"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="mb-5 flex items-center gap-3">
                        <div class="icon-hover">
                            <x-module-icon module="gyartas" size="sm" rounded="lg" />
                        </div>
                        <div>
                            <span class="rounded-md bg-success-50 px-2.5 py-1 text-xs font-bold uppercase tracking-wider text-success-600">Gyártásirányítás</span>
                        </div>
                        <span class="text-xs text-text-tertiary">Anyagszükséglet és kapacitás</span>
                    </div>
                    <h3 class="mb-3 text-xl font-bold text-text-primary">Gyártási anyagszükséglet automatikusan a termelési tervből</h3>
                    <p class="mb-6 text-sm leading-relaxed text-text-secondary">A darabjegyzék (BOM) alapján a rendszer automatikusan kiszámolja az anyagszükségletet a tervezett gyártási megrendelésekhez — és jelzi, ha a készlet nem elegendő.</p>
                    <div class="mb-6 grid grid-cols-2 gap-2">
                        <span class="flex items-center gap-2 text-sm text-text-secondary">
                            <span class="feature-dot h-1.5 w-1.5 rounded-full bg-success-500"></span>BOM alapú szükséglet
                        </span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary">
                            <span class="feature-dot h-1.5 w-1.5 rounded-full bg-success-500"></span>Kapacitás-szinkron
                        </span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary">
                            <span class="feature-dot h-1.5 w-1.5 rounded-full bg-success-500"></span>Hiánylista generálás
                        </span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary">
                            <span class="feature-dot h-1.5 w-1.5 rounded-full bg-success-500"></span>Gyártási ütemterv
                        </span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary">
                            <span class="feature-dot h-1.5 w-1.5 rounded-full bg-success-500"></span>Minőségellenőrzés
                        </span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary">
                            <span class="feature-dot h-1.5 w-1.5 rounded-full bg-success-500"></span>Selejt-követés
                        </span>
                    </div>
                    <a href="{{ route('products.gyartas') }}" class="inline-flex items-center gap-1.5 text-sm font-semibold text-success-600 transition-colors hover:text-success-700">
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
                        <span class="text-xs text-text-tertiary">Beszerzési workflow-k</span>
                    </div>
                    <h3 class="mb-3 text-xl font-bold text-text-primary">Jóváhagyási workflow-k, riasztások és automatikus rendelés</h3>
                    <p class="mb-6 text-sm leading-relaxed text-text-secondary">Készletszint trigger → beszerzési igény → jóváhagyás → rendelés kiküldése → bevételezés értesítés — kód nélkül, drag-and-drop workflow-val.</p>
                    <div class="mb-6 grid grid-cols-2 gap-2">
                        <span class="flex items-center gap-2 text-sm text-text-secondary">
                            <span class="feature-dot h-1.5 w-1.5 rounded-full bg-violet-500"></span>Jóváhagyási láncolat
                        </span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary">
                            <span class="feature-dot h-1.5 w-1.5 rounded-full bg-violet-500"></span>Készlet-riasztás trigger
                        </span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary">
                            <span class="feature-dot h-1.5 w-1.5 rounded-full bg-violet-500"></span>Automatikus rendelés
                        </span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary">
                            <span class="feature-dot h-1.5 w-1.5 rounded-full bg-violet-500"></span>Bevételezés-értesítés
                        </span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary">
                            <span class="feature-dot h-1.5 w-1.5 rounded-full bg-violet-500"></span>Szállítói e-mail trigger
                        </span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary">
                            <span class="feature-dot h-1.5 w-1.5 rounded-full bg-violet-500"></span>Határidő-figyelés
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
                <div class="stagger-item group card-glow rounded-2xl border border-border-light bg-surface-primary p-8 transition-all hover:border-blue-200"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="mb-5 flex items-center gap-3">
                        <div class="icon-hover">
                            <x-module-icon module="datamind" size="sm" rounded="lg" />
                        </div>
                        <div>
                            <span class="rounded-md bg-blue-50 px-2.5 py-1 text-xs font-bold uppercase tracking-wider text-blue-600">DataMind</span>
                        </div>
                        <span class="text-xs text-text-tertiary">MI alapú ellátásilánc-tervezés</span>
                    </div>
                    <h3 class="mb-3 text-xl font-bold text-text-primary">Prediktív készletezés és beszállítói teljesítmény-elemzés</h3>
                    <p class="mb-6 text-sm leading-relaxed text-text-secondary">Az MI előrejelzi a készletszükségletet a korábbi felhasználási minták és a tervezett projektek alapján. Anomália-detektálás a szállítói árakban és szállítási időkben.</p>
                    <div class="mb-6 grid grid-cols-2 gap-2">
                        <span class="flex items-center gap-2 text-sm text-text-secondary">
                            <span class="feature-dot h-1.5 w-1.5 rounded-full bg-blue-500"></span>Fogyás-előrejelzés
                        </span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary">
                            <span class="feature-dot h-1.5 w-1.5 rounded-full bg-blue-500"></span>Szállítói rating
                        </span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary">
                            <span class="feature-dot h-1.5 w-1.5 rounded-full bg-blue-500"></span>Ár-anomália detektálás
                        </span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary">
                            <span class="feature-dot h-1.5 w-1.5 rounded-full bg-blue-500"></span>Szezonális tervezés
                        </span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary">
                            <span class="feature-dot h-1.5 w-1.5 rounded-full bg-blue-500"></span>Készlet-optimalizálás
                        </span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary">
                            <span class="feature-dot h-1.5 w-1.5 rounded-full bg-blue-500"></span>Automatikus összefoglalók
                        </span>
                    </div>
                    <a href="{{ route('products.datamind') }}" class="inline-flex items-center gap-1.5 text-sm font-semibold text-blue-600 transition-colors hover:text-blue-700">
                        Részletek megtekintése
                        <svg class="arrow-slide h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{-- Supply Chain Lifecycle Section --}}
    <section class="bg-surface-secondary py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-6">
            <div class="reveal mb-14">
                <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-cyan-600">Ellátásilánc-ciklus</p>
                <h2 class="mb-4 text-3xl text-text-primary md:text-4xl" style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                    A szükséglettől a felhasználásig — zárt rendszerben
                </h2>
                <p class="max-w-xl text-lg text-text-secondary">
                    Minden lépés automatikusan dokumentált, nyomkövethető és pénzügyileg kimutatható.
                </p>
            </div>

            <div class="relative">
                {{-- Connector line (desktop only) --}}
                <div class="flow-line reveal absolute top-8 right-[8%] left-[8%] hidden h-0.5 lg:block"></div>

                <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-6" data-stagger>
                    @php
                        $lifecycle = [
                            ['num' => '01', 'title' => 'Szükséglet', 'desc' => 'Gyártási terv vagy manuális igény alapján', 'modules' => ['Gyártás', 'Munkalap'], 'color' => 'cyan'],
                            ['num' => '02', 'title' => 'Jóváhagyás', 'desc' => 'Automatikus workflow, szintek és limit-kezelés', 'modules' => ['Automatizálás'], 'color' => 'blue'],
                            ['num' => '03', 'title' => 'Rendelés', 'desc' => 'Szállító kiválasztás, ajánlat-összehasonlítás', 'modules' => ['Beszerzés'], 'color' => 'violet'],
                            ['num' => '04', 'title' => 'Nyomonkövetés', 'desc' => 'Szállítmány-státusz, ETA és késésfigyelés', 'modules' => ['Beszerzés', 'Automatizálás'], 'color' => 'success'],
                            ['num' => '05', 'title' => 'Bevételezés', 'desc' => 'Mennyiségi és minőségi ellenőrzés', 'modules' => ['Beszerzés', 'Gyártás'], 'color' => 'warning'],
                            ['num' => '06', 'title' => 'Elszámolás', 'desc' => 'Szállítói számla és pénzügyi kontroll', 'modules' => ['Kontrolling'], 'color' => 'indigo'],
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
                    <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-cyan-600">Teljes ökoszisztéma</p>
                    <h2 class="text-3xl text-text-primary md:text-4xl" style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                        Mind a 11 modul kapcsolódik az ellátási lánchoz
                    </h2>
                </div>
                <p class="reveal-right text-lg leading-relaxed text-text-secondary lg:mt-6">
                    A beszerzés nem önálló sziget — az értékesítés generálja a keresletet, a gyártás fogyasztja az anyagot, a szerviz kiszálláskor felhasználja a raktárkészletet, a kontrolling pedig méri a költségeket. Amikor mindez egy rendszerben van, a beszerzés proaktív lesz — nem reaktív.
                </p>
            </div>

            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4" data-stagger>
                <div class="stagger-item card-glow rounded-xl border border-border-light bg-surface-primary p-6 text-center"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="icon-hover mx-auto mb-3 flex h-11 w-11 items-center justify-center rounded-xl bg-success-50">
                        <x-module-icon module="crm" size="xs" />
                    </div>
                    <h4 class="mb-1 text-sm font-bold text-text-primary">CRM & Értékesítés</h4>
                    <p class="text-xs leading-relaxed text-text-tertiary">Megrendelt tételek automatikusan beszerzési igényt generálnak — a vevői rendelésből szállítói rendelés.</p>
                </div>

                <div class="stagger-item card-glow rounded-xl border border-border-light bg-surface-primary p-6 text-center"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="icon-hover mx-auto mb-3 flex h-11 w-11 items-center justify-center rounded-xl bg-warning-50">
                        <x-module-icon module="gyartas" size="xs" />
                    </div>
                    <h4 class="mb-1 text-sm font-bold text-text-primary">Gyártásirányítás</h4>
                    <p class="text-xs leading-relaxed text-text-tertiary">BOM alapú anyagszükséglet a termelési tervből — a beszerzés tudja, mit kell rendelni, mielőtt elfogyna.</p>
                </div>

                <div class="stagger-item card-glow rounded-xl border border-border-light bg-surface-primary p-6 text-center"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="icon-hover mx-auto mb-3 flex h-11 w-11 items-center justify-center rounded-xl bg-indigo-50">
                        <x-module-icon module="kontrolling" size="xs" />
                    </div>
                    <h4 class="mb-1 text-sm font-bold text-text-primary">Kontrolling</h4>
                    <p class="text-xs leading-relaxed text-text-tertiary">Beszerzési költségek, készletérték, szállítói kötelezettségek — pénzügyi kontroll valós időben.</p>
                </div>

                <div class="stagger-item card-glow rounded-xl border border-border-light bg-surface-primary p-6 text-center"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="icon-hover mx-auto mb-3 flex h-11 w-11 items-center justify-center rounded-xl bg-cyan-50">
                        <x-module-icon module="szerviz" size="xs" />
                    </div>
                    <h4 class="mb-1 text-sm font-bold text-text-primary">Digitális munkalap</h4>
                    <p class="text-xs leading-relaxed text-text-tertiary">A helyszíni szerelők anyagfelhasználása automatikusan csökkenti a raktárkészletet — valós idejű fogyás.</p>
                </div>

                <div class="stagger-item card-glow rounded-xl border border-border-light bg-surface-primary p-6 text-center"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="icon-hover mx-auto mb-3 flex h-11 w-11 items-center justify-center rounded-xl bg-pink-50">
                        <x-module-icon module="marketinghub" size="xs" />
                    </div>
                    <h4 class="mb-1 text-sm font-bold text-text-primary">MarketingHub</h4>
                    <p class="text-xs leading-relaxed text-text-tertiary">A marketing kampányok által generált kereslet-növekedés hatása a készletterhelésre — előrejelzés.</p>
                </div>

                <div class="stagger-item card-glow rounded-xl border border-border-light bg-surface-primary p-6 text-center"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="icon-hover mx-auto mb-3 flex h-11 w-11 items-center justify-center rounded-xl bg-blue-50">
                        <x-module-icon module="ai-chat" size="xs" />
                    </div>
                    <h4 class="mb-1 text-sm font-bold text-text-primary">AI Chat</h4>
                    <p class="text-xs leading-relaxed text-text-tertiary">Szállítói státusz lekérdezés belső chatboton: a gyártásvezető megkérdezi, hol tart a rendelés — az MI válaszol.</p>
                </div>

                <div class="stagger-item card-glow rounded-xl border border-border-light bg-surface-primary p-6 text-center"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="icon-hover mx-auto mb-3 flex h-11 w-11 items-center justify-center rounded-xl bg-violet-50">
                        <x-module-icon module="datamind" size="xs" />
                    </div>
                    <h4 class="mb-1 text-sm font-bold text-text-primary">DataMind</h4>
                    <p class="text-xs leading-relaxed text-text-tertiary">Prediktív készletezés, szállítói teljesítmény-ranking és szezonális fogyásminta felismerés MI-vel.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Stats Section --}}
    <section class="bg-surface-secondary py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-6">
            <div class="reveal mb-12 text-center">
                <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-cyan-600">Eredmények</p>
                <h2 class="text-3xl text-text-primary md:text-4xl" style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                    Mérhető javulás az ellátási lánc teljesítményében
                </h2>
            </div>

            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4" data-stagger data-counter-trigger>
                <div class="stagger-item stat-hover rounded-2xl border border-border-light bg-surface-primary p-8 text-center"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <p class="stat-value mb-2 text-4xl font-bold text-cyan-600" style="font-family: 'JetBrains Mono', monospace;" data-count="35" data-prefix="-" data-suffix="%">0%</p>
                    <p class="text-sm font-medium text-text-secondary">Készlethiány miatti leállás</p>
                </div>

                <div class="stagger-item stat-hover rounded-2xl border border-border-light bg-surface-primary p-8 text-center"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <p class="stat-value mb-2 text-4xl font-bold text-success-600" style="font-family: 'JetBrains Mono', monospace;" data-count="25" data-prefix="-" data-suffix="%">0%</p>
                    <p class="text-sm font-medium text-text-secondary">Raktári tőkelekötés</p>
                </div>

                <div class="stagger-item stat-hover rounded-2xl border border-border-light bg-surface-primary p-8 text-center"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <p class="stat-value mb-2 text-4xl font-bold text-blue-600" style="font-family: 'JetBrains Mono', monospace;" data-count="60" data-prefix="-" data-suffix="%">0%</p>
                    <p class="text-sm font-medium text-text-secondary">Beszerzési adminisztrációs idő</p>
                </div>

                <div class="stagger-item stat-hover rounded-2xl border border-border-light bg-surface-primary p-8 text-center"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <p class="stat-value mb-2 text-4xl font-bold text-warning-600" style="font-family: 'JetBrains Mono', monospace;" data-count="20" data-prefix="+" data-suffix="%">0%</p>
                    <p class="text-sm font-medium text-text-secondary">Szállítói teljesítmény-javulás</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Use Cases Section --}}
    <section class="bg-surface-primary py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-6">
            <div class="reveal mb-12">
                <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-cyan-600">Felhasználási esetek</p>
                <h2 class="mb-4 text-3xl text-text-primary md:text-4xl" style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                    Így használják ipari beszerzési csapatok
                </h2>
            </div>

            <div class="grid grid-cols-1 gap-5 md:grid-cols-2 lg:grid-cols-3" data-stagger>
                @php
                    $useCases = [
                        ['num' => '01', 'title' => 'Automatikus minimumkészlet-riasztás és újrarendelés', 'desc' => 'Ha egy kritikus alkatrész eléri a minimumszintet, a rendszer automatikusan riaszt, és jóváhagyás után rendelést generál a preferált beszállítónál — emberi beavatkozás nélkül.', 'tags' => ['Beszerzés', 'Automatizálás']],
                        ['num' => '02', 'title' => 'BOM alapú anyagszükséglet-tervezés', 'desc' => 'A gyártási megrendelés beérkezésekor a darabjegyzék (BOM) alapján a rendszer automatikusan összeállítja az anyagszükségletet — és jelzi, mi van készleten és mi hiányzik.', 'tags' => ['Gyártásirányítás', 'Beszerzés']],
                        ['num' => '03', 'title' => 'Szállítói teljesítmény értékelés', 'desc' => 'Szállítási pontosság, minőség, árversenyképesség — a DataMind automatikusan rangsorolja a beszállítókat, és jelzi, ha egy szállító romló teljesítményt mutat.', 'tags' => ['DataMind', 'Beszerzés']],
                        ['num' => '04', 'title' => 'Többszintű jóváhagyási workflow', 'desc' => '100E Ft alatt automatikus jóváhagyás, 100E–1M Ft között beszerzési vezető, felette ügyvezető. A rendszer irányítja a workflow-t — és naplózza minden lépést.', 'tags' => ['Automatizálás', 'Kontrolling']],
                        ['num' => '05', 'title' => 'Szerviz kiszállás anyagkezelése', 'desc' => 'A helyszíni szerelő a digitális munkalapon rögzíti a felhasznált anyagot — a készlet automatikusan csökken, a költség a projekthez rendelődik, és szükség esetén újrarendelés indul.', 'tags' => ['Munkalap', 'Beszerzés', 'Kontrolling']],
                        ['num' => '06', 'title' => 'Prediktív készletezés MI-vel', 'desc' => 'A DataMind a korábbi felhasználási mintákból és a tervezett projektekből előrejelzi, mikor és mennyi anyagra lesz szükség — hetekkel a tényleges fogyás előtt.', 'tags' => ['DataMind', 'Gyártásirányítás']],
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
                                <span class="rounded-md bg-cyan-50 px-2.5 py-1 text-xs font-medium text-cyan-700 transition-colors hover:bg-cyan-100">{{ $tag }}</span>
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
                <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-cyan-600">Összehasonlítás</p>
                <h2 class="mb-4 text-3xl text-text-primary md:text-4xl" style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                    Telefonálgatás helyett — integrált ellátásilánc-kezelés
                </h2>
                <p class="max-w-xl text-lg text-text-secondary">
                    Így változik meg a beszerzési munka a Cégem360 bevezetésével.
                </p>
            </div>

            <div class="reveal-scale overflow-hidden rounded-2xl border border-border-light"
                style="box-shadow: 0 4px 20px -4px rgba(0,0,0,0.06);">
                <table class="w-full text-left text-sm">
                    <thead>
                        <tr class="bg-surface-primary">
                            <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-text-primary">Képesség</th>
                            <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-text-tertiary">Hagyományos módszer</th>
                            <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-cyan-600">Cégem360</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-border-light">
                        @php
                            $comparisons = [
                                ['cap' => 'Készletszint áttekintés', 'old' => 'Leltárkor, negyedévente', 'new' => 'Valós időben, dashboardon'],
                                ['cap' => 'Újrarendelés', 'old' => 'Ha észreveszik a hiányt', 'new' => 'Automatikus trigger'],
                                ['cap' => 'Szállítói összehasonlítás', 'old' => 'Fejben / régi árajánlatokból', 'new' => 'Automatikus ranking'],
                                ['cap' => 'Jóváhagyási folyamat', 'old' => 'E-mail / szóban', 'new' => 'Szabályalapú workflow'],
                                ['cap' => 'Anyagszükséglet-tervezés', 'old' => 'Kézi kalkuláció', 'new' => 'BOM alapú, automatikus'],
                                ['cap' => 'Készlet-előrejelzés', 'old' => 'Megérzés', 'new' => 'MI predikció mintákból'],
                                ['cap' => 'Szerviz anyagfelhasználás', 'old' => 'Utólag jelentik / nem jelentik', 'new' => 'Valós idejű munkalapon'],
                            ];
                        @endphp

                        @foreach ($comparisons as $row)
                            <tr class="bg-surface-secondary transition-colors hover:bg-surface-primary/50">
                                <td class="px-6 py-4 font-semibold text-text-primary">{{ $row['cap'] }}</td>
                                <td class="px-6 py-4 text-text-tertiary">{{ $row['old'] }}</td>
                                <td class="px-6 py-4">
                                    <span class="flex items-center gap-2 font-medium text-text-secondary">
                                        <svg class="h-4 w-4 text-cyan-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" /></svg>
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
                style="box-shadow: 0 4px 20px -4px rgba(6, 182, 212, 0.08);">
                <div>
                    <h3 class="mb-2 text-xl font-bold text-text-primary">Személyre szabott online konzultáció</h3>
                    <p class="mb-4 max-w-lg text-sm leading-relaxed text-text-secondary">30 perces videóhívás, amelyben felmérjük, hogyan digitalizálhatja beszerzési és raktárkezelési folyamatait a Cégem360-nal — az Ön iparágára és ellátási láncára szabva.</p>
                    <div class="flex flex-wrap gap-5">
                        <span class="flex items-center gap-1.5 text-xs font-medium text-text-tertiary">
                            <svg class="h-3.5 w-3.5 text-cyan-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" /></svg>
                            30 perc videóhívás
                        </span>
                        <span class="flex items-center gap-1.5 text-xs font-medium text-text-tertiary">
                            <svg class="h-3.5 w-3.5 text-cyan-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" /></svg>
                            Beszerzési folyamat audit
                        </span>
                        <span class="flex items-center gap-1.5 text-xs font-medium text-text-tertiary">
                            <svg class="h-3.5 w-3.5 text-cyan-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" /></svg>
                            Nincs elköteleződés
                        </span>
                    </div>
                </div>
                <a href="{{ route('contact') }}"
                    class="group inline-flex shrink-0 items-center gap-2 rounded-full bg-cyan-600 px-6 py-3 text-base font-medium text-white transition-all hover:bg-cyan-700 hover:shadow-lg"
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
                <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-cyan-600">Kezdje el</p>
                <h2 class="mb-4 text-3xl text-text-primary md:text-4xl" style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                    Készen áll az átlátható ellátási láncra?
                </h2>
                <p class="text-lg text-text-secondary">Válassza ki a következő lépést az Ön számára.</p>
            </div>

            <div class="mx-auto grid max-w-3xl grid-cols-1 gap-6 md:grid-cols-2" data-stagger>
                <div class="stagger-item card-glow rounded-2xl border border-cyan-100 bg-linear-to-br from-cyan-50/40 to-surface-primary p-8 text-center"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <h3 class="mb-3 text-lg font-bold text-text-primary">Online konzultáció</h3>
                    <p class="mb-6 text-sm leading-relaxed text-text-secondary">Kérdezzen szakértőinktől 30 percben — videóhíváson, az Ön beszerzési kihívásaira szabva, kötelezettség nélkül.</p>
                    <a href="{{ route('contact') }}"
                        class="group inline-flex items-center gap-2 rounded-full border border-border-light bg-surface-primary px-5 py-2.5 text-sm font-medium text-text-primary transition-all hover:border-cyan-200 hover:bg-surface-secondary hover:shadow-md">
                        Időpont foglalása
                        <svg class="arrow-slide h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                        </svg>
                    </a>
                </div>

                <div class="stagger-item card-glow rounded-2xl border border-blue-100 bg-linear-to-br from-blue-50/40 to-surface-primary p-8 text-center"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <h3 class="mb-3 text-lg font-bold text-text-primary">Regisztráció és kipróbálás</h3>
                    <p class="mb-6 text-sm leading-relaxed text-text-secondary">Fedezze fel a készletkezelést, a beszállítói modult és az automatikus rendelési workflow-kat — azonnal.</p>
                    <a href="{{ route('register') }}"
                        class="group inline-flex items-center gap-2 rounded-full bg-cyan-600 px-5 py-2.5 text-sm font-medium text-white transition-all hover:bg-cyan-700 hover:shadow-lg"
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
