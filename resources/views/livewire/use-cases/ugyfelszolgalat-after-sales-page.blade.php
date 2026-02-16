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
            0% { box-shadow: 0 0 0 0 rgba(244, 63, 94, 0.4); }
            70% { box-shadow: 0 0 0 6px rgba(244, 63, 94, 0); }
            100% { box-shadow: 0 0 0 0 rgba(244, 63, 94, 0); }
        }
        .pulse-dot { animation: pulse-ring 2s ease infinite; }

        .card-glow { transition: all 0.4s cubic-bezier(0,0,0.2,1); }
        .card-glow:hover { box-shadow: 0 8px 30px -8px rgba(244, 63, 94, 0.15), 0 2px 8px rgba(0,0,0,0.04) !important; }

        .icon-hover { transition: transform 0.35s cubic-bezier(0,0,0.2,1.4); }
        .group:hover .icon-hover, .card-glow:hover .icon-hover { transform: translateY(-3px) scale(1.08); }

        .arrow-slide { transition: transform 0.3s cubic-bezier(0,0,0.2,1); }
        .group:hover .arrow-slide, a:hover .arrow-slide { transform: translateX(4px); }

        .stat-hover .stat-value { transition: transform 0.4s cubic-bezier(0,0,0.2,1.4); }
        .stat-hover:hover .stat-value { transform: scale(1.08); }

        .feature-dot { transition: transform 0.3s cubic-bezier(0,0,0.2,1); }
        .card-glow:hover .feature-dot { transform: scale(1.5); }

        @keyframes ticket-pulse { 0%, 100% { opacity: 1; } 50% { opacity: 0.4; } }
        .ticket-dot-pulse { animation: ticket-pulse 2s ease infinite; }

        .pill-float { transition: transform 0.35s cubic-bezier(0,0,0.2,1), box-shadow 0.35s cubic-bezier(0,0,0.2,1); }
        .pill-float:hover { transform: translateY(-3px); box-shadow: 0 6px 20px -4px rgba(244, 63, 94, 0.12); }

        html { scroll-behavior: smooth; }
    </style>

    {{-- Hero Section --}}
    <section class="bg-linear-to-b from-rose-50 to-surface-secondary">
        <div class="mx-auto max-w-7xl px-6 py-16 lg:py-24">
            <div class="grid grid-cols-1 items-center gap-12 lg:grid-cols-2">
                {{-- Hero Text --}}
                <div class="reveal">
                    <div class="badge-gradient mb-8 inline-flex items-center gap-2 rounded-full border border-border-light/80 bg-surface-primary px-4 py-1.5"
                        style="box-shadow: 0 1px 3px rgba(0,0,0,0.04);">
                        <span class="pulse-dot h-1.5 w-1.5 rounded-full bg-linear-to-r from-rose-500 via-pink-500 to-violet-500"></span>
                        <span class="text-sm font-medium text-text-primary">Ipari szerviz és ügyfélszolgálati megoldások</span>
                    </div>

                    <h1 class="mb-6 text-4xl leading-tight tracking-tight text-text-primary md:text-5xl lg:text-[3.5rem]"
                        style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                        Szolgáltasson ki gyorsabban<br>
                        — és tartsa meg ügyfeleit
                    </h1>

                    <p class="mb-10 max-w-xl text-lg text-text-secondary lg:text-xl">
                        Az ipari B2B-ben az eladás után kezdődik a valódi kapcsolat. A Cégem360 digitális szerviz-kezelést, 0-24 AI ügyfélszolgálatot, reklamáció-workflow-t és proaktív karbantartás-értesítést ad — hogy az ügyfél ne a versenytársat hívja.
                    </p>

                    <div class="flex flex-wrap items-center gap-4">
                        <a href="{{ route('contact') }}"
                            class="group inline-flex items-center gap-2 rounded-full bg-rose-600 px-6 py-3 text-base font-medium text-white transition-all hover:bg-rose-700 hover:shadow-lg"
                            style="box-shadow: 0 1px 2px rgba(0,0,0,0.05);">
                            <span>Online konzultáció</span>
                            <svg class="arrow-slide h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" /></svg>
                        </a>
                        <a href="#megoldasok"
                            class="inline-flex items-center gap-2 rounded-full border border-border-light bg-surface-primary px-6 py-3 text-base font-medium text-text-primary transition-all hover:border-rose-200 hover:bg-surface-secondary hover:shadow-md">
                            Megoldások áttekintése
                        </a>
                    </div>
                </div>

                {{-- Service Ticket Dashboard Visual --}}
                <div class="reveal-right">
                    <div class="rounded-2xl border border-border-light bg-surface-primary p-6"
                        style="box-shadow: 0 4px 20px -4px rgba(0,0,0,0.06);">
                        <div class="mb-4 flex items-center justify-between border-b border-border-light pb-4">
                            <div>
                                <span class="block text-sm font-bold text-text-primary">Szerviz irányítópult</span>
                                <span class="block text-[10px] text-text-tertiary">Ügyfélszolgálat & helyszíni szerviz</span>
                            </div>
                            <span class="inline-flex items-center gap-1.5 rounded-md border border-rose-100 bg-rose-50 px-2.5 py-1 text-[10px] font-semibold text-rose-600">
                                <span class="ticket-dot-pulse h-1.5 w-1.5 rounded-full bg-rose-500"></span>
                                Élő · 3 nyitott
                            </span>
                        </div>

                        {{-- KPI Cards --}}
                        <div class="mb-4 grid grid-cols-2 gap-2.5">
                            <div class="rounded-lg border border-border-light bg-surface-secondary p-2.5 text-center">
                                <span class="block text-xl font-bold text-rose-600" style="font-family: 'JetBrains Mono', monospace;">12</span>
                                <span class="block text-[10px] font-semibold uppercase tracking-wider text-text-tertiary">Nyitott jegy</span>
                            </div>
                            <div class="rounded-lg border border-border-light bg-surface-secondary p-2.5 text-center">
                                <span class="block text-xl font-bold text-amber-600" style="font-family: 'JetBrains Mono', monospace;">2.4h</span>
                                <span class="block text-[10px] font-semibold uppercase tracking-wider text-text-tertiary">Átl. válaszidő</span>
                            </div>
                            <div class="rounded-lg border border-border-light bg-surface-secondary p-2.5 text-center">
                                <span class="block text-xl font-bold text-success-600" style="font-family: 'JetBrains Mono', monospace;">94%</span>
                                <span class="block text-[10px] font-semibold uppercase tracking-wider text-text-tertiary">Elégedettség</span>
                            </div>
                            <div class="rounded-lg border border-border-light bg-surface-secondary p-2.5 text-center">
                                <span class="block text-xl font-bold text-blue-600" style="font-family: 'JetBrains Mono', monospace;">87%</span>
                                <span class="block text-[10px] font-semibold uppercase tracking-wider text-text-tertiary">Első javítás arány</span>
                            </div>
                        </div>

                        {{-- AI Chat Preview --}}
                        <div class="mb-4 rounded-lg border border-rose-100 bg-rose-50 p-3">
                            <div class="mb-2 flex items-center gap-2">
                                <div class="flex h-7 w-7 items-center justify-center rounded-full bg-linear-to-br from-rose-500 to-pink-500 text-[10px] font-bold text-white">AI</div>
                                <span class="text-xs font-bold text-text-primary">Cégem360 AI Asszisztens</span>
                                <span class="rounded bg-rose-100 px-1.5 py-0.5 text-[9px] font-semibold text-rose-600">Automatikus</span>
                            </div>
                            <div class="rounded-lg bg-surface-primary p-2.5 text-xs leading-relaxed text-text-secondary">
                                Szia! A #4821-es szervizjegy státusza: a szerelő holnap 9:00-ra érkezik, a szükséges alkatrész (SKF 6205 csapágy) készleten van. Van más, amiben segíthetek?
                            </div>
                            <span class="mt-1.5 block text-right text-[10px] text-text-tertiary">Ma 14:32 · AI Chat</span>
                        </div>

                        {{-- Ticket Rows --}}
                        <div class="space-y-1.5">
                            <div class="flex items-center justify-between rounded-lg bg-surface-secondary px-3 py-2">
                                <div class="flex items-center gap-2">
                                    <span class="h-6 w-1 rounded-full bg-danger-500"></span>
                                    <div>
                                        <span class="block text-xs font-medium text-text-secondary">Kompresszor meghibásodás</span>
                                        <span class="text-[10px] text-text-tertiary">TechBuild Kft.</span>
                                    </div>
                                </div>
                                <span class="rounded bg-danger-50 px-2 py-0.5 text-[10px] font-semibold text-danger-700">Nyitott</span>
                                <span class="text-[11px] text-text-tertiary" style="font-family: 'JetBrains Mono', monospace;">35 perc</span>
                            </div>
                            <div class="flex items-center justify-between rounded-lg bg-surface-secondary px-3 py-2">
                                <div class="flex items-center gap-2">
                                    <span class="h-6 w-1 rounded-full bg-amber-500"></span>
                                    <div>
                                        <span class="block text-xs font-medium text-text-secondary">Éves karbantartás ütemezés</span>
                                        <span class="text-[10px] text-text-tertiary">InnoClima Zrt.</span>
                                    </div>
                                </div>
                                <span class="rounded bg-amber-50 px-2 py-0.5 text-[10px] font-semibold text-amber-700">Folyamatban</span>
                                <span class="text-[11px] text-text-tertiary" style="font-family: 'JetBrains Mono', monospace;">4 óra</span>
                            </div>
                            <div class="flex items-center justify-between rounded-lg bg-surface-secondary px-3 py-2">
                                <div class="flex items-center gap-2">
                                    <span class="h-6 w-1 rounded-full bg-success-500"></span>
                                    <div>
                                        <span class="block text-xs font-medium text-text-secondary">Garancia-igény: vezérlőpanel</span>
                                        <span class="text-[10px] text-text-tertiary">Hungária Gép Kft.</span>
                                    </div>
                                </div>
                                <span class="rounded bg-success-50 px-2 py-0.5 text-[10px] font-semibold text-success-700">Megoldva</span>
                                <span class="text-[11px] text-text-tertiary" style="font-family: 'JetBrains Mono', monospace;">Lezárva</span>
                            </div>
                        </div>

                        {{-- Status bar --}}
                        <div class="mt-4 flex gap-5 border-t border-border-light pt-3">
                            <span class="flex items-center gap-1.5 text-[11px] text-text-tertiary">
                                <span class="h-2 w-2 rounded-full bg-danger-500"></span> 3 sürgős
                            </span>
                            <span class="flex items-center gap-1.5 text-[11px] text-text-tertiary">
                                <span class="h-2 w-2 rounded-full bg-amber-500"></span> 5 folyamatban
                            </span>
                            <span class="flex items-center gap-1.5 text-[11px] text-text-tertiary">
                                <span class="h-2 w-2 rounded-full bg-success-500"></span> 4 lezárva ma
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
                <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-rose-600">A kihívás</p>
                <h2 class="mb-4 text-3xl text-text-primary md:text-4xl" style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                    Ezek gyengítik az ipari ügyfélszolgálatot
                </h2>
                <p class="max-w-xl text-lg text-text-secondary">
                    Ismerős helyzetek ipari gyártó, szerelő és szerviz cégek ügyfélszolgálati vezetőinek.
                </p>
            </div>

            <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4" data-stagger>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-7" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="icon-hover mb-5 flex h-12 w-12 items-center justify-center rounded-xl bg-danger-50">
                        <svg class="h-6 w-6 text-danger-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    </div>
                    <h3 class="mb-2 text-lg font-bold text-text-primary">Lassú reakcióidő</h3>
                    <p class="text-sm leading-relaxed text-text-secondary">Az ügyfél telefonál, e-mailt ír — de a szervizcsapat nem érhető el, vagy nem tudja, ki foglalkozik az üggyel. A válaszidő órák-napok, nem percek.</p>
                </div>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-7" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="icon-hover mb-5 flex h-12 w-12 items-center justify-center rounded-xl bg-warning-50">
                        <svg class="h-6 w-6 text-warning-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                    </div>
                    <h3 class="mb-2 text-lg font-bold text-text-primary">Papíros szervizmunkalapok</h3>
                    <p class="text-sm leading-relaxed text-text-secondary">A helyszíni szerelő papíron dokumentál, a munkalap napokra eltűnik. Nincs azonnali fotó, nincs digitális aláírás, nincs azonnali visszaigazolás.</p>
                </div>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-7" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="icon-hover mb-5 flex h-12 w-12 items-center justify-center rounded-xl bg-violet-50">
                        <svg class="h-6 w-6 text-violet-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" /></svg>
                    </div>
                    <h3 class="mb-2 text-lg font-bold text-text-primary">Nincs szerviz-előzmény</h3>
                    <p class="text-sm leading-relaxed text-text-secondary">Amikor az ügyfél hív, senki nem tudja, mikor jártak nála utoljára, mit csináltak, és lejárt-e a garancia. Minden hívás a nulláról indul.</p>
                </div>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-7" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="icon-hover mb-5 flex h-12 w-12 items-center justify-center rounded-xl bg-blue-50">
                        <svg class="h-6 w-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    </div>
                    <h3 class="mb-2 text-lg font-bold text-text-primary">Elszalasztott upsell-lehetőségek</h3>
                    <p class="text-sm leading-relaxed text-text-secondary">A szerviz-kiszálláson kiderül, hogy bővítésre lenne igény — de ez az információ sosem jut el az értékesítéshez. Milliókat hagynak az asztalon.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Target Audience Section --}}
    <section class="bg-surface-secondary py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-6">
            <div class="reveal mb-12">
                <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-rose-600">Ki használja?</p>
                <h2 class="mb-4 text-3xl text-text-primary md:text-4xl" style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                    A szervizcsapattól az ügyfélkapcsolatig — egy rendszerben
                </h2>
                <p class="max-w-xl text-lg text-text-secondary">
                    A Cégem360 az ügyfélszolgálat minden szereplőjének adatot és eszközt ad.
                </p>
            </div>

            <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4" data-stagger>
                <div class="stagger-item card-glow group relative overflow-hidden rounded-2xl border border-border-light bg-surface-primary p-7" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="absolute inset-x-0 top-0 h-0.5 bg-linear-to-r from-transparent via-rose-400 to-transparent opacity-0 transition-opacity group-hover:opacity-100"></div>
                    <span class="mb-3 block text-3xl">🔧</span>
                    <span class="mb-2 block text-[10px] font-semibold uppercase tracking-wider text-rose-600">Szervizmérnök</span>
                    <h3 class="mb-2 text-base font-bold text-text-primary">Helyszíni szerelők, szervizesek</h3>
                    <p class="text-sm leading-relaxed text-text-secondary">Digitális munkalap, előzmény-hozzáférés, alkatrész-készlet és fotódokumentáció — a telefonon, a helyszínen, offline is.</p>
                </div>
                <div class="stagger-item card-glow group relative overflow-hidden rounded-2xl border border-border-light bg-surface-primary p-7" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="absolute inset-x-0 top-0 h-0.5 bg-linear-to-r from-transparent via-rose-400 to-transparent opacity-0 transition-opacity group-hover:opacity-100"></div>
                    <span class="mb-3 block text-3xl">📋</span>
                    <span class="mb-2 block text-[10px] font-semibold uppercase tracking-wider text-rose-600">Szervízvezető</span>
                    <h3 class="mb-2 text-base font-bold text-text-primary">Szervizvezetők, diszpécserek</h3>
                    <p class="text-sm leading-relaxed text-text-secondary">Ticket-kezelés, kiszállás-ütemezés, szerelő-kiosztás, SLA figyelés és teljesítmény-riport — valós időben.</p>
                </div>
                <div class="stagger-item card-glow group relative overflow-hidden rounded-2xl border border-border-light bg-surface-primary p-7" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="absolute inset-x-0 top-0 h-0.5 bg-linear-to-r from-transparent via-rose-400 to-transparent opacity-0 transition-opacity group-hover:opacity-100"></div>
                    <span class="mb-3 block text-3xl">🤝</span>
                    <span class="mb-2 block text-[10px] font-semibold uppercase tracking-wider text-rose-600">Ügyfélkapcsolat</span>
                    <h3 class="mb-2 text-base font-bold text-text-primary">Ügyfélkapcsolati munkatársak</h3>
                    <p class="text-sm leading-relaxed text-text-secondary">Teljes ügyféltörténet, szerviz-előzmények, garancia-státusz és nyitott jegyek — azonnal, a hívás közben.</p>
                </div>
                <div class="stagger-item card-glow group relative overflow-hidden rounded-2xl border border-border-light bg-surface-primary p-7" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="absolute inset-x-0 top-0 h-0.5 bg-linear-to-r from-transparent via-rose-400 to-transparent opacity-0 transition-opacity group-hover:opacity-100"></div>
                    <span class="mb-3 block text-3xl">💼</span>
                    <span class="mb-2 block text-[10px] font-semibold uppercase tracking-wider text-rose-600">Ügyvezető</span>
                    <h3 class="mb-2 text-base font-bold text-text-primary">Ügyvezetők, értékesítési vezetők</h3>
                    <p class="text-sm leading-relaxed text-text-secondary">Ügyfél-elégedettség, szerviz-jövedelmezőség, upsell-konverzió és megtartási arányok — stratégiai döntésekhez.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Core Toolkit Section --}}
    <section class="bg-surface-primary py-16 lg:py-24" id="megoldasok">
        <div class="mx-auto max-w-7xl px-6">
            <div class="reveal mb-12">
                <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-rose-600">Szerviz-eszköztár</p>
                <h2 class="mb-4 text-3xl text-text-primary md:text-4xl" style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                    4 kulcsmodul az ügyfélszolgálathoz és szervizhez
                </h2>
                <p class="max-w-xl text-lg text-text-secondary">
                    Ezek a modulok együttesen adják a Cégem360 after-sales intelligencia rétegét.
                </p>
            </div>

            <div class="grid grid-cols-1 gap-6 md:grid-cols-2" data-stagger>
                {{-- Digitális munkalap --}}
                <div class="stagger-item card-glow group rounded-2xl border border-border-light bg-surface-primary p-8" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="mb-5 flex items-center gap-4">
                        <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-rose-50">
                            <x-module-icon module="szerviz" class="h-5 w-5 text-rose-600" />
                        </div>
                        <div>
                            <span class="block text-sm font-bold text-text-primary">Digitális munkalap</span>
                            <span class="text-xs text-text-tertiary">Helyszíni szerviz</span>
                        </div>
                    </div>
                    <h3 class="mb-3 text-lg font-bold text-text-primary">Helyszíni szerviz — digitálisan, fotóval, aláírással</h3>
                    <p class="mb-5 text-sm leading-relaxed text-text-secondary">A szerelő a helyszínen rögzíti: elvégzett munka, felhasznált anyag, fotódokumentáció, ügyfél digitális aláírás. A munkalap azonnal a rendszerben — PDF az ügyfélnél percek alatt.</p>
                    <div class="mb-5 grid grid-cols-2 gap-2">
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><span class="feature-dot h-1 w-1 rounded-full bg-rose-400"></span>Digitális munkalap</span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><span class="feature-dot h-1 w-1 rounded-full bg-rose-400"></span>Fotódokumentáció</span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><span class="feature-dot h-1 w-1 rounded-full bg-rose-400"></span>Ügyfél e-aláírás</span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><span class="feature-dot h-1 w-1 rounded-full bg-rose-400"></span>Anyag felhasználás</span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><span class="feature-dot h-1 w-1 rounded-full bg-rose-400"></span>Offline mód</span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><span class="feature-dot h-1 w-1 rounded-full bg-rose-400"></span>PDF export ügyfélnek</span>
                    </div>
                    <a href="{{ route('products.szerviz') }}" class="inline-flex items-center gap-1.5 text-sm font-semibold text-rose-600 transition-colors hover:text-rose-700">
                        Részletek megtekintése <svg class="arrow-slide h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" /></svg>
                    </a>
                </div>

                {{-- CRM --}}
                <div class="stagger-item card-glow group rounded-2xl border border-border-light bg-surface-primary p-8" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="mb-5 flex items-center gap-4">
                        <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-pink-50">
                            <x-module-icon module="crm" class="h-5 w-5 text-pink-600" />
                        </div>
                        <div>
                            <span class="block text-sm font-bold text-text-primary">CRM</span>
                            <span class="text-xs text-text-tertiary">Ügyfélkapcsolat & előzmények</span>
                        </div>
                    </div>
                    <h3 class="mb-3 text-lg font-bold text-text-primary">Teljes ügyféltörténet — a vásárlástól a szerviz-előzményig</h3>
                    <p class="mb-5 text-sm leading-relaxed text-text-secondary">Szerviz-jegyek, kiszállási előzmények, garancia-állapot, kapcsolattartók és NPS értékelés — minden egy idővonalon. Az ügyfélszolgálat azonnal lát mindent, mielőtt felveszi a telefont.</p>
                    <div class="mb-5 grid grid-cols-2 gap-2">
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><span class="feature-dot h-1 w-1 rounded-full bg-pink-400"></span>Szerviz-előzmények</span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><span class="feature-dot h-1 w-1 rounded-full bg-pink-400"></span>Garancia-kezelés</span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><span class="feature-dot h-1 w-1 rounded-full bg-pink-400"></span>Ticket-rendszer</span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><span class="feature-dot h-1 w-1 rounded-full bg-pink-400"></span>SLA figyelés</span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><span class="feature-dot h-1 w-1 rounded-full bg-pink-400"></span>NPS/CSAT mérés</span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><span class="feature-dot h-1 w-1 rounded-full bg-pink-400"></span>Ügyfél-portál</span>
                    </div>
                    <a href="{{ route('products.crm') }}" class="inline-flex items-center gap-1.5 text-sm font-semibold text-pink-600 transition-colors hover:text-pink-700">
                        Részletek megtekintése <svg class="arrow-slide h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" /></svg>
                    </a>
                </div>

                {{-- AI Chat --}}
                <div class="stagger-item card-glow group rounded-2xl border border-border-light bg-surface-primary p-8" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="mb-5 flex items-center gap-4">
                        <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-violet-50">
                            <x-module-icon module="ai-chat" class="h-5 w-5 text-violet-600" />
                        </div>
                        <div>
                            <span class="block text-sm font-bold text-text-primary">AI Chat</span>
                            <span class="text-xs text-text-tertiary">0-24 ügyfélszolgálat</span>
                        </div>
                    </div>
                    <h3 class="mb-3 text-lg font-bold text-text-primary">AI ügyfélszolgálat — éjjel-nappal, az Ön tudásbázisával</h3>
                    <p class="mb-5 text-sm leading-relaxed text-text-secondary">Az AI chatbot válaszol a leggyakoribb szerviz-kérdésekre: jegy-státusz, szállítási idő, garancia, dokumentumok. Ha nem tud válaszolni, automatikusan ticket-et nyit és átadja élő kollégának.</p>
                    <div class="mb-5 grid grid-cols-2 gap-2">
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><span class="feature-dot h-1 w-1 rounded-full bg-violet-400"></span>0-24 elérhetőség</span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><span class="feature-dot h-1 w-1 rounded-full bg-violet-400"></span>Jegy-státusz lekérdezés</span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><span class="feature-dot h-1 w-1 rounded-full bg-violet-400"></span>Automatikus ticket-nyitás</span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><span class="feature-dot h-1 w-1 rounded-full bg-violet-400"></span>Tudásbázis-integráció</span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><span class="feature-dot h-1 w-1 rounded-full bg-violet-400"></span>Többnyelvű (HU/EN/DE)</span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><span class="feature-dot h-1 w-1 rounded-full bg-violet-400"></span>Élő átadás kollégának</span>
                    </div>
                    <a href="{{ route('products.aichat') }}" class="inline-flex items-center gap-1.5 text-sm font-semibold text-violet-600 transition-colors hover:text-violet-700">
                        Részletek megtekintése <svg class="arrow-slide h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" /></svg>
                    </a>
                </div>

                {{-- Automatizálás --}}
                <div class="stagger-item card-glow group rounded-2xl border border-border-light bg-surface-primary p-8" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="mb-5 flex items-center gap-4">
                        <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-blue-50">
                            <x-module-icon module="automatizalas" class="h-5 w-5 text-blue-600" />
                        </div>
                        <div>
                            <span class="block text-sm font-bold text-text-primary">Automatizálás</span>
                            <span class="text-xs text-text-tertiary">Szerviz workflow-k</span>
                        </div>
                    </div>
                    <h3 class="mb-3 text-lg font-bold text-text-primary">Automatikus ticket-kiosztás, eszkaláció és proaktív értesítés</h3>
                    <p class="mb-5 text-sm leading-relaxed text-text-secondary">Új szerviz-igény — automatikus kiosztás a legközelebbi szabad szerelőhöz. SLA-határidő közeledik — eszkaláció. Garancia lejár — proaktív ajánlat keretszerződésre.</p>
                    <div class="mb-5 grid grid-cols-2 gap-2">
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><span class="feature-dot h-1 w-1 rounded-full bg-blue-400"></span>Automatikus kiosztás</span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><span class="feature-dot h-1 w-1 rounded-full bg-blue-400"></span>SLA eszkaláció</span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><span class="feature-dot h-1 w-1 rounded-full bg-blue-400"></span>Garancia-lejárat trigger</span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><span class="feature-dot h-1 w-1 rounded-full bg-blue-400"></span>Proaktív értesítés</span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><span class="feature-dot h-1 w-1 rounded-full bg-blue-400"></span>Karbantartás-emlékeztető</span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><span class="feature-dot h-1 w-1 rounded-full bg-blue-400"></span>Elégedettségi kérdőív</span>
                    </div>
                    <a href="{{ route('products.automatizalas') }}" class="inline-flex items-center gap-1.5 text-sm font-semibold text-blue-600 transition-colors hover:text-blue-700">
                        Részletek megtekintése <svg class="arrow-slide h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" /></svg>
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{-- Service Lifecycle Section --}}
    <section class="bg-surface-secondary py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-6">
            <div class="reveal mb-12">
                <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-rose-600">Szerviz-ciklus</p>
                <h2 class="mb-4 text-3xl text-text-primary md:text-4xl" style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                    A bejelentéstől a lezárásig — zárt rendszerben
                </h2>
                <p class="max-w-xl text-lg text-text-secondary">
                    Minden lépés automatizált, dokumentált és az ügyfélnek is átlátható.
                </p>
            </div>

            <div class="grid grid-cols-2 gap-5 sm:grid-cols-3 lg:grid-cols-6" data-stagger>
                <div class="stagger-item text-center">
                    <div class="mx-auto mb-4 flex h-16 w-16 items-center justify-center rounded-full border-2 border-rose-200 bg-surface-primary text-xl font-bold text-rose-600">01</div>
                    <h4 class="mb-1 text-sm font-bold text-text-primary">Bejelentés</h4>
                    <p class="mb-2 text-xs text-text-tertiary">Telefonon, e-mailen, AI chatboton vagy ügyfélportálon — automatikus ticket</p>
                    <div class="flex flex-wrap justify-center gap-1">
                        <span class="rounded bg-rose-50 px-1.5 py-0.5 text-[9px] font-semibold text-rose-600">AI Chat</span>
                        <span class="rounded bg-rose-50 px-1.5 py-0.5 text-[9px] font-semibold text-rose-600">CRM</span>
                    </div>
                </div>
                <div class="stagger-item text-center">
                    <div class="mx-auto mb-4 flex h-16 w-16 items-center justify-center rounded-full border-2 border-pink-200 bg-surface-primary text-xl font-bold text-pink-600">02</div>
                    <h4 class="mb-1 text-sm font-bold text-text-primary">Kiosztás</h4>
                    <p class="mb-2 text-xs text-text-tertiary">Szakterület, helyszín és elérhetőség alapján automatikus szerelő-kiosztás</p>
                    <div class="flex flex-wrap justify-center gap-1">
                        <span class="rounded bg-pink-50 px-1.5 py-0.5 text-[9px] font-semibold text-pink-600">Automatizálás</span>
                    </div>
                </div>
                <div class="stagger-item text-center">
                    <div class="mx-auto mb-4 flex h-16 w-16 items-center justify-center rounded-full border-2 border-amber-200 bg-surface-primary text-xl font-bold text-amber-600">03</div>
                    <h4 class="mb-1 text-sm font-bold text-text-primary">Helyszíni munka</h4>
                    <p class="mb-2 text-xs text-text-tertiary">Digitális munkalap, fotó, anyagfelhasználás, ügyfél e-aláírás</p>
                    <div class="flex flex-wrap justify-center gap-1">
                        <span class="rounded bg-amber-50 px-1.5 py-0.5 text-[9px] font-semibold text-amber-600">Munkalap</span>
                        <span class="rounded bg-amber-50 px-1.5 py-0.5 text-[9px] font-semibold text-amber-600">Beszerzés</span>
                    </div>
                </div>
                <div class="stagger-item text-center">
                    <div class="mx-auto mb-4 flex h-16 w-16 items-center justify-center rounded-full border-2 border-blue-200 bg-surface-primary text-xl font-bold text-blue-600">04</div>
                    <h4 class="mb-1 text-sm font-bold text-text-primary">Dokumentálás</h4>
                    <p class="mb-2 text-xs text-text-tertiary">Automatikus PDF az ügyfélnek, adatok a CRM-ben és kontrollingban</p>
                    <div class="flex flex-wrap justify-center gap-1">
                        <span class="rounded bg-blue-50 px-1.5 py-0.5 text-[9px] font-semibold text-blue-600">CRM</span>
                        <span class="rounded bg-blue-50 px-1.5 py-0.5 text-[9px] font-semibold text-blue-600">Kontrolling</span>
                    </div>
                </div>
                <div class="stagger-item text-center">
                    <div class="mx-auto mb-4 flex h-16 w-16 items-center justify-center rounded-full border-2 border-success-200 bg-surface-primary text-xl font-bold text-success-600">05</div>
                    <h4 class="mb-1 text-sm font-bold text-text-primary">Visszajelzés</h4>
                    <p class="mb-2 text-xs text-text-tertiary">Automatikus elégedettségi kérdőív, NPS mérés, reklamáció-kezelés</p>
                    <div class="flex flex-wrap justify-center gap-1">
                        <span class="rounded bg-success-50 px-1.5 py-0.5 text-[9px] font-semibold text-success-600">Automatizálás</span>
                        <span class="rounded bg-success-50 px-1.5 py-0.5 text-[9px] font-semibold text-success-600">CRM</span>
                    </div>
                </div>
                <div class="stagger-item text-center">
                    <div class="mx-auto mb-4 flex h-16 w-16 items-center justify-center rounded-full border-2 border-violet-200 bg-surface-primary text-xl font-bold text-violet-600">06</div>
                    <h4 class="mb-1 text-sm font-bold text-text-primary">Proaktív gondoskodás</h4>
                    <p class="mb-2 text-xs text-text-tertiary">Karbantartás-emlékeztető, garancia-lejárat ajánlat, upsell lehetőség</p>
                    <div class="flex flex-wrap justify-center gap-1">
                        <span class="rounded bg-violet-50 px-1.5 py-0.5 text-[9px] font-semibold text-violet-600">Automatizálás</span>
                        <span class="rounded bg-violet-50 px-1.5 py-0.5 text-[9px] font-semibold text-violet-600">Értékesítés</span>
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
                    <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-rose-600">Teljes ökoszisztéma</p>
                    <h2 class="text-3xl text-text-primary md:text-4xl" style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                        Mind a 11 modul az ügyfélmegtartás szolgálatában
                    </h2>
                </div>
                <p class="text-lg leading-relaxed text-text-secondary lg:mt-8">
                    Az ügyfélszolgálat nem izolált részleg — a CRM-ből jön az előzmény, a beszerzés biztosítja az alkatrészt, az értékesítés felveszi az upsell-fonalat, a kontrolling méri a szerviz jövedelmezőségét. Amikor mindez egy rendszerben van, az ügyfélszolgálat nemcsak reagál — hanem proaktívan gondoskodik.
                </p>
            </div>

            <div class="grid grid-cols-2 gap-4 sm:grid-cols-4 lg:grid-cols-7" data-stagger>
                <div class="stagger-item pill-float rounded-xl border border-border-light bg-surface-primary p-4 text-center" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="mx-auto mb-3 flex h-10 w-10 items-center justify-center rounded-lg bg-success-50">
                        <x-module-icon module="ertekesites" class="h-5 w-5 text-success-600" />
                    </div>
                    <h4 class="mb-1 text-xs font-bold text-text-primary">CRM & Értékesítés</h4>
                    <p class="text-[10px] leading-snug text-text-tertiary">Szerviz-upsell automatikusan értékesítési lehetőség lesz</p>
                </div>
                <div class="stagger-item pill-float rounded-xl border border-border-light bg-surface-primary p-4 text-center" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="mx-auto mb-3 flex h-10 w-10 items-center justify-center rounded-lg bg-cyan-50">
                        <x-module-icon module="beszerzes" class="h-5 w-5 text-cyan-600" />
                    </div>
                    <h4 class="mb-1 text-xs font-bold text-text-primary">Beszerzés-logisztika</h4>
                    <p class="text-[10px] leading-snug text-text-tertiary">Szerviz-alkatrész készletszint és automatikus újrarendelés</p>
                </div>
                <div class="stagger-item pill-float rounded-xl border border-border-light bg-surface-primary p-4 text-center" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="mx-auto mb-3 flex h-10 w-10 items-center justify-center rounded-lg bg-indigo-50">
                        <x-module-icon module="kontrolling" class="h-5 w-5 text-indigo-600" />
                    </div>
                    <h4 class="mb-1 text-xs font-bold text-text-primary">Kontrolling</h4>
                    <p class="text-[10px] leading-snug text-text-tertiary">Szerviz-jövedelmezőség kiszállásonként és keretszerződés-szinten</p>
                </div>
                <div class="stagger-item pill-float rounded-xl border border-border-light bg-surface-primary p-4 text-center" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="mx-auto mb-3 flex h-10 w-10 items-center justify-center rounded-lg bg-orange-50">
                        <x-module-icon module="gyartas" class="h-5 w-5 text-orange-600" />
                    </div>
                    <h4 class="mb-1 text-xs font-bold text-text-primary">Gyártásirányítás</h4>
                    <p class="text-[10px] leading-snug text-text-tertiary">Szerviz-visszajelzés mint minőségi input a gyártásnak</p>
                </div>
                <div class="stagger-item pill-float rounded-xl border border-border-light bg-surface-primary p-4 text-center" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="mx-auto mb-3 flex h-10 w-10 items-center justify-center rounded-lg bg-blue-50">
                        <x-module-icon module="datamind" class="h-5 w-5 text-blue-600" />
                    </div>
                    <h4 class="mb-1 text-xs font-bold text-text-primary">DataMind</h4>
                    <p class="text-[10px] leading-snug text-text-tertiary">Prediktív szerviz: MI jelzi, melyik ügyfélnél esedékes karbantartás</p>
                </div>
                <div class="stagger-item pill-float rounded-xl border border-border-light bg-surface-primary p-4 text-center" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="mx-auto mb-3 flex h-10 w-10 items-center justify-center rounded-lg bg-amber-50">
                        <x-module-icon module="marketinghub" class="h-5 w-5 text-amber-600" />
                    </div>
                    <h4 class="mb-1 text-xs font-bold text-text-primary">MarketingHub</h4>
                    <p class="text-[10px] leading-snug text-text-tertiary">NPS alapú automatikus referencia-kérés és esettanulmány-gyűjtés</p>
                </div>
                <div class="stagger-item pill-float rounded-xl border border-border-light bg-surface-primary p-4 text-center" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="mx-auto mb-3 flex h-10 w-10 items-center justify-center rounded-lg bg-violet-50">
                        <x-module-icon module="seo" class="h-5 w-5 text-violet-600" />
                    </div>
                    <h4 class="mb-1 text-xs font-bold text-text-primary">SEO Eszköz</h4>
                    <p class="text-[10px] leading-snug text-text-tertiary">Szerviz-tartalom SEO: karbantartási útmutatók mint inbound lead</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Stats Section --}}
    <section class="bg-surface-secondary py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-6">
            <div class="reveal mb-12 text-center">
                <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-rose-600">Eredmények</p>
                <h2 class="text-3xl text-text-primary md:text-4xl" style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                    Mérhető javulás az ügyfélszolgálatban
                </h2>
            </div>

            <div class="grid grid-cols-2 gap-5 lg:grid-cols-4" data-stagger data-counter-trigger>
                <div class="stagger-item stat-hover rounded-2xl border border-border-light bg-surface-primary p-8 text-center" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <span class="stat-value block text-4xl font-bold text-rose-600 lg:text-5xl" style="font-family: 'JetBrains Mono', monospace;"
                        data-count="60" data-prefix="-" data-suffix="%">0%</span>
                    <span class="mt-2 block text-sm text-text-secondary">Átlagos válaszidő csökkenés</span>
                </div>
                <div class="stagger-item stat-hover rounded-2xl border border-border-light bg-surface-primary p-8 text-center" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <span class="stat-value block text-4xl font-bold text-success-600 lg:text-5xl" style="font-family: 'JetBrains Mono', monospace;"
                        data-count="35" data-prefix="+" data-suffix="%">0%</span>
                    <span class="mt-2 block text-sm text-text-secondary">Ügyfél-megtartás javulás</span>
                </div>
                <div class="stagger-item stat-hover rounded-2xl border border-border-light bg-surface-primary p-8 text-center" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <span class="stat-value block text-4xl font-bold text-amber-600 lg:text-5xl" style="font-family: 'JetBrains Mono', monospace;"
                        data-count="45" data-prefix="+" data-suffix="%">0%</span>
                    <span class="mt-2 block text-sm text-text-secondary">Szerviz-upsell konverzió</span>
                </div>
                <div class="stagger-item stat-hover rounded-2xl border border-border-light bg-surface-primary p-8 text-center" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <span class="stat-value block text-4xl font-bold text-blue-600 lg:text-5xl" style="font-family: 'JetBrains Mono', monospace;"
                        data-count="70" data-prefix="-" data-suffix="%">0%</span>
                    <span class="mt-2 block text-sm text-text-secondary">Admin-idő helyszínen</span>
                </div>
            </div>
        </div>
    </section>

    {{-- Use Cases Section --}}
    <section class="bg-surface-primary py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-6">
            <div class="reveal mb-12">
                <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-rose-600">Felhasználási esetek</p>
                <h2 class="mb-4 text-3xl text-text-primary md:text-4xl" style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                    Így használják ipari szervizcsapatok
                </h2>
            </div>

            <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3" data-stagger>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-7" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <span class="mb-4 block text-xs font-semibold text-text-tertiary" style="font-family: 'JetBrains Mono', monospace;">01</span>
                    <h3 class="mb-2 text-base font-bold text-text-primary">Helyszíni szerviz digitális dokumentálása</h3>
                    <p class="mb-4 text-sm leading-relaxed text-text-secondary">A szerelő a helyszínen rögzíti az elvégzett munkát, fotókat készít, rögzíti a felhasznált anyagot, az ügyfél aláír — és a munkalap PDF-ben az ügyfél e-mailben van, mire a szerelő elindult.</p>
                    <div class="flex flex-wrap gap-1.5">
                        <span class="rounded bg-rose-50 px-2 py-0.5 text-[10px] font-semibold text-rose-600">Munkalap</span>
                        <span class="rounded bg-rose-50 px-2 py-0.5 text-[10px] font-semibold text-rose-600">CRM</span>
                    </div>
                </div>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-7" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <span class="mb-4 block text-xs font-semibold text-text-tertiary" style="font-family: 'JetBrains Mono', monospace;">02</span>
                    <h3 class="mb-2 text-base font-bold text-text-primary">0-24 AI ügyfélszolgálat</h3>
                    <p class="mb-4 text-sm leading-relaxed text-text-secondary">Az ügyfél éjjel 2-kor is le tudja kérdezni a szervizjegy státuszát, a garancia állapotát vagy a következő karbantartás időpontját. Ha az MI nem tud segíteni, automatikusan ticket-et nyit.</p>
                    <div class="flex flex-wrap gap-1.5">
                        <span class="rounded bg-rose-50 px-2 py-0.5 text-[10px] font-semibold text-rose-600">AI Chat</span>
                        <span class="rounded bg-rose-50 px-2 py-0.5 text-[10px] font-semibold text-rose-600">CRM</span>
                    </div>
                </div>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-7" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <span class="mb-4 block text-xs font-semibold text-text-tertiary" style="font-family: 'JetBrains Mono', monospace;">03</span>
                    <h3 class="mb-2 text-base font-bold text-text-primary">Proaktív karbantartás-értesítés</h3>
                    <p class="mb-4 text-sm leading-relaxed text-text-secondary">Az automatizálás jelzi, ha egy ügyfélnél esedékes az éves karbantartás, lejár a garancia, vagy a DataMind predikció szerint hamarosan szerviz kell — az értékesítés időben ajánlatot küldhet.</p>
                    <div class="flex flex-wrap gap-1.5">
                        <span class="rounded bg-rose-50 px-2 py-0.5 text-[10px] font-semibold text-rose-600">Automatizálás</span>
                        <span class="rounded bg-rose-50 px-2 py-0.5 text-[10px] font-semibold text-rose-600">DataMind</span>
                        <span class="rounded bg-rose-50 px-2 py-0.5 text-[10px] font-semibold text-rose-600">Értékesítés</span>
                    </div>
                </div>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-7" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <span class="mb-4 block text-xs font-semibold text-text-tertiary" style="font-family: 'JetBrains Mono', monospace;">04</span>
                    <h3 class="mb-2 text-base font-bold text-text-primary">Reklamáció-kezelés és garancia-workflow</h3>
                    <p class="mb-4 text-sm leading-relaxed text-text-secondary">Reklamáció beérkezik — automatikus kategorizálás — garancia-ellenőrzés — kiosztás a felelős szervizeshez — SLA-határidő figyelés — lezárás és visszajelzés. Teljes audit trail.</p>
                    <div class="flex flex-wrap gap-1.5">
                        <span class="rounded bg-rose-50 px-2 py-0.5 text-[10px] font-semibold text-rose-600">CRM</span>
                        <span class="rounded bg-rose-50 px-2 py-0.5 text-[10px] font-semibold text-rose-600">Automatizálás</span>
                    </div>
                </div>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-7" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <span class="mb-4 block text-xs font-semibold text-text-tertiary" style="font-family: 'JetBrains Mono', monospace;">05</span>
                    <h3 class="mb-2 text-base font-bold text-text-primary">Szerviz-upsell és keretszerződés-ajánlat</h3>
                    <p class="mb-4 text-sm leading-relaxed text-text-secondary">A helyszíni szerelő a munkalapon jelzi a bővítési lehetőséget — az értékesítés automatikusan kap értesítést és ajánlatsablont. A legmagasabb konverziójú értékesítési csatorna.</p>
                    <div class="flex flex-wrap gap-1.5">
                        <span class="rounded bg-rose-50 px-2 py-0.5 text-[10px] font-semibold text-rose-600">Munkalap</span>
                        <span class="rounded bg-rose-50 px-2 py-0.5 text-[10px] font-semibold text-rose-600">Értékesítés</span>
                        <span class="rounded bg-rose-50 px-2 py-0.5 text-[10px] font-semibold text-rose-600">CRM</span>
                    </div>
                </div>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-7" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <span class="mb-4 block text-xs font-semibold text-text-tertiary" style="font-family: 'JetBrains Mono', monospace;">06</span>
                    <h3 class="mb-2 text-base font-bold text-text-primary">Szerviz-jövedelmezőség elemzés</h3>
                    <p class="mb-4 text-sm leading-relaxed text-text-secondary">Mennyibe kerül egy kiszállás? Melyik keretszerződés jövedelmező és melyik nem? A kontrolling valós időben méri a szerviz P&L-jét — ügyfél- és kiszállás-szinten.</p>
                    <div class="flex flex-wrap gap-1.5">
                        <span class="rounded bg-rose-50 px-2 py-0.5 text-[10px] font-semibold text-rose-600">Kontrolling</span>
                        <span class="rounded bg-rose-50 px-2 py-0.5 text-[10px] font-semibold text-rose-600">Munkalap</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Comparison Table Section --}}
    <section class="bg-surface-secondary py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-6">
            <div class="reveal mb-12">
                <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-rose-600">Összehasonlítás</p>
                <h2 class="mb-4 text-3xl text-text-primary md:text-4xl" style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                    Telefonos szerviz helyett — integrált ügyfélszolgálati platform
                </h2>
                <p class="max-w-xl text-lg text-text-secondary">
                    Így változik meg az ügyfélszolgálat a Cégem360 bevezetésével.
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
                        <tr><td class="px-6 py-4 text-sm font-semibold text-text-primary">Szervizbejelentés</td><td class="px-6 py-4 text-sm text-text-tertiary">Telefon / e-mail</td><td class="px-6 py-4 text-sm font-medium text-success-600">✓ AI Chat + portál + telefon</td></tr>
                        <tr><td class="px-6 py-4 text-sm font-semibold text-text-primary">Elérhetőség</td><td class="px-6 py-4 text-sm text-text-tertiary">Munkaidőben</td><td class="px-6 py-4 text-sm font-medium text-success-600">✓ 0-24 AI ügyfélszolgálat</td></tr>
                        <tr><td class="px-6 py-4 text-sm font-semibold text-text-primary">Szerviz-előzmények</td><td class="px-6 py-4 text-sm text-text-tertiary">Nincs / szétszórt</td><td class="px-6 py-4 text-sm font-medium text-success-600">✓ Teljes idővonal</td></tr>
                        <tr><td class="px-6 py-4 text-sm font-semibold text-text-primary">Helyszíni dokumentálás</td><td class="px-6 py-4 text-sm text-text-tertiary">Papír munkalap</td><td class="px-6 py-4 text-sm font-medium text-success-600">✓ Digitális, fotóval, e-aláírással</td></tr>
                        <tr><td class="px-6 py-4 text-sm font-semibold text-text-primary">Garancia-kezelés</td><td class="px-6 py-4 text-sm text-text-tertiary">Kézi ellenőrzés</td><td class="px-6 py-4 text-sm font-medium text-success-600">✓ Automatikus, CRM-ből</td></tr>
                        <tr><td class="px-6 py-4 text-sm font-semibold text-text-primary">Proaktív gondoskodás</td><td class="px-6 py-4 text-sm text-text-tertiary">Ha az ügyfél szól</td><td class="px-6 py-4 text-sm font-medium text-success-600">✓ MI predikció + automatikus értesítés</td></tr>
                        <tr><td class="px-6 py-4 text-sm font-semibold text-text-primary">Szerviz-upsell</td><td class="px-6 py-4 text-sm text-text-tertiary">Elveszett információ</td><td class="px-6 py-4 text-sm font-medium text-success-600">✓ Munkalapból automatikus ajánlat</td></tr>
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
                        <h3 class="mb-3 text-xl font-bold text-text-primary lg:text-2xl" style="font-family: 'Poppins', sans-serif;">Személyre szabott online konzultáció</h3>
                        <p class="mb-5 text-base text-text-secondary">30 perces videóhívás, amelyben felmérjük, hogyan digitalizálhatja ügyfélszolgálati és szerviz-folyamatait a Cégem360-nal — az Ön iparágára, csapatméretére és ügyfélkörére szabva.</p>
                        <div class="flex flex-wrap gap-5">
                            <span class="flex items-center gap-1.5 text-sm text-text-tertiary"><svg class="h-4 w-4 text-success-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>30 perc videóhívás</span>
                            <span class="flex items-center gap-1.5 text-sm text-text-tertiary"><svg class="h-4 w-4 text-success-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>Szerviz-folyamat audit</span>
                            <span class="flex items-center gap-1.5 text-sm text-text-tertiary"><svg class="h-4 w-4 text-success-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>Nincs elköteleződés</span>
                        </div>
                    </div>
                    <a href="{{ route('contact') }}" class="group inline-flex items-center gap-2 rounded-full bg-rose-600 px-6 py-3 text-base font-medium text-white transition-all hover:bg-rose-700 hover:shadow-lg" style="box-shadow: 0 1px 2px rgba(0,0,0,0.05);">
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
                <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-rose-600">Kezdje el</p>
                <h2 class="mb-4 text-3xl text-text-primary md:text-4xl" style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                    Készen áll a proaktív ügyfélszolgálatra?
                </h2>
                <p class="mx-auto max-w-xl text-lg text-text-secondary">
                    Válassza ki a következő lépést az Ön számára.
                </p>
            </div>

            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2" data-stagger>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-8 text-center" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <h3 class="mb-3 text-xl font-bold text-text-primary">Online konzultáció</h3>
                    <p class="mb-6 text-sm text-text-secondary">Kérdezzen szakértőinktől 30 percben — videóhíváson, az Ön szerviz-kihívásaira szabva, kötelezettség nélkül.</p>
                    <a href="{{ route('contact') }}" class="inline-flex items-center gap-2 rounded-full border border-border-light bg-surface-secondary px-6 py-3 text-sm font-medium text-text-primary transition-all hover:border-rose-200 hover:shadow-md">
                        Időpont foglalása <svg class="arrow-slide h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" /></svg>
                    </a>
                </div>
                <div class="stagger-item card-glow rounded-2xl border border-rose-100 bg-rose-50 p-8 text-center" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <h3 class="mb-3 text-xl font-bold text-text-primary">Regisztráció és kipróbálás</h3>
                    <p class="mb-6 text-sm text-text-secondary">Fedezze fel a digitális munkalapot, az AI chatbotot és a szerviz ticket-rendszert — azonnal.</p>
                    <a href="{{ route('register') }}" class="group inline-flex items-center gap-2 rounded-full bg-rose-600 px-6 py-3 text-sm font-medium text-white transition-all hover:bg-rose-700 hover:shadow-lg" style="box-shadow: 0 1px 2px rgba(0,0,0,0.05);">
                        Regisztráció <svg class="arrow-slide h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" /></svg>
                    </a>
                </div>
            </div>
        </div>
    </section>
</div>
