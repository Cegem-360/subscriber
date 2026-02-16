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
            0% { box-shadow: 0 0 0 0 rgba(97, 97, 255, 0.4); }
            70% { box-shadow: 0 0 0 6px rgba(97, 97, 255, 0); }
            100% { box-shadow: 0 0 0 0 rgba(97, 97, 255, 0); }
        }
        .pulse-dot { animation: pulse-ring 2s ease infinite; }

        /* Card hover glow */
        .card-glow {
            transition: all 0.4s cubic-bezier(0, 0, 0.2, 1);
        }
        .card-glow:hover {
            box-shadow: 0 8px 30px -8px rgba(96, 92, 212, 0.15), 0 2px 8px rgba(0,0,0,0.04) !important;
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

        /* Workflow connector line */
        .workflow-line {
            background: linear-gradient(90deg, transparent, var(--color-primary-200), var(--color-success-200), var(--color-warning-200), transparent);
            transform: scaleX(0);
            transform-origin: left;
            transition: transform 1.2s cubic-bezier(0, 0, 0.2, 1) 0.3s;
        }
        .workflow-line.revealed { transform: scaleX(1); }

        /* Integration pill float */
        .pill-float {
            transition: transform 0.35s cubic-bezier(0, 0, 0.2, 1), box-shadow 0.35s cubic-bezier(0, 0, 0.2, 1);
        }
        .pill-float:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 20px -4px rgba(96, 92, 212, 0.12);
        }

        /* Smooth scroll for anchor links */
        html { scroll-behavior: smooth; }
    </style>

    {{-- Hero Section --}}
    <section class="bg-linear-to-b from-primary-50/60 to-surface-secondary">
        <div class="mx-auto max-w-7xl px-6 py-16 lg:py-24">
            <div class="reveal mx-auto max-w-3xl text-center">
                <div class="badge-gradient mb-8 inline-flex items-center gap-2 rounded-full border border-border-light/80 bg-surface-primary px-4 py-1.5"
                    style="box-shadow: 0 1px 3px rgba(0,0,0,0.04);">
                    <span class="pulse-dot h-1.5 w-1.5 rounded-full bg-linear-to-r from-pink-500 via-primary-500 to-violet-500"></span>
                    <span class="text-sm font-medium text-text-primary">B2B ipari marketing megoldások</span>
                </div>

                <h1 class="mb-6 text-4xl leading-tight tracking-tight text-text-primary md:text-5xl lg:text-[3.5rem]"
                    style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                    Érje el a döntéshozókat<br>
                    — adatvezérelt marketing eszközökkel
                </h1>

                <p class="mx-auto mb-10 max-w-2xl text-lg text-text-secondary lg:text-xl">
                    Beszerzési vezetők, műszaki igazgatók, cégvezetők. Az ipari B2B szektorban a hagyományos marketing nem elég. A Cégem360 11 integrált modulja segít mérhetően növelni a pipeline-t, a konverziót és a marketing ROI-t.
                </p>

                <div class="flex flex-wrap items-center justify-center gap-4">
                    <a href="{{ route('contact') }}"
                        class="group inline-flex items-center gap-2 rounded-full bg-primary-600 px-6 py-3 text-base font-medium text-white transition-all hover:bg-primary-700 hover:shadow-lg"
                        style="box-shadow: 0 1px 2px rgba(0,0,0,0.05);">
                        <span>Online konzultáció</span>
                        <svg class="arrow-slide h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                        </svg>
                    </a>
                    <a href="#megoldasok"
                        class="inline-flex items-center gap-2 rounded-full border border-border-light bg-surface-primary px-6 py-3 text-base font-medium text-text-primary transition-all hover:border-primary-200 hover:bg-surface-secondary hover:shadow-md">
                        Megoldások áttekintése
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{-- Pain Points Section --}}
    <section class="bg-surface-primary py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-6">
            <div class="reveal mb-12">
                <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-primary-600">A kihívás</p>
                <h2 class="mb-4 text-3xl text-text-primary md:text-4xl" style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                    Ezekkel küzd ma egy B2B marketing csapat
                </h2>
                <p class="max-w-xl text-lg text-text-secondary">
                    Az ipari szektorban a marketingesek nap mint nap szembesülnek ezekkel az akadályokkal.
                </p>
            </div>

            <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4" data-stagger>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-7"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="icon-hover mb-5 flex h-12 w-12 items-center justify-center rounded-xl bg-danger-50">
                        <svg class="h-6 w-6 text-danger-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16" />
                        </svg>
                    </div>
                    <h3 class="mb-2 text-lg font-bold text-text-primary">Szétszórt adatforrások</h3>
                    <p class="text-sm leading-relaxed text-text-secondary">Google Ads, Analytics, Search Console, CRM, Excel — mindegyik más felületen, más formátumban. Nincs egyetlen igazságforrás.</p>
                </div>

                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-7"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="icon-hover mb-5 flex h-12 w-12 items-center justify-center rounded-xl bg-warning-50">
                        <svg class="h-6 w-6 text-warning-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="mb-2 text-lg font-bold text-text-primary">Nem mérhető kampányok</h3>
                    <p class="text-sm leading-relaxed text-text-secondary">A marketing költi a büdzsét, de az értékesítés nem látja, melyik lead honnan jött. A ROI kérdőjeles marad.</p>
                </div>

                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-7"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="icon-hover mb-5 flex h-12 w-12 items-center justify-center rounded-xl bg-violet-50">
                        <svg class="h-6 w-6 text-violet-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>
                    <h3 class="mb-2 text-lg font-bold text-text-primary">Döntéshozók elérése</h3>
                    <p class="text-sm leading-relaxed text-text-secondary">Beszerzők, műszaki vezetők, ügyvezetők — mindegyik más nyelven gondolkodik. A generikus üzenetek nem működnek.</p>
                </div>

                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-7"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="icon-hover mb-5 flex h-12 w-12 items-center justify-center rounded-xl bg-primary-50">
                        <svg class="h-6 w-6 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <h3 class="mb-2 text-lg font-bold text-text-primary">Manuális riportolás</h3>
                    <p class="text-sm leading-relaxed text-text-secondary">Heti órák mennek el a riportok összeállítására, ahelyett hogy stratégiai munkán dolgozna a csapat.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Target Audiences Section --}}
    <section class="bg-surface-secondary py-16 lg:py-24" id="celcsoportok">
        <div class="mx-auto max-w-7xl px-6">
            <div class="reveal mb-12">
                <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-primary-600">Célcsoportok</p>
                <h2 class="mb-4 text-3xl text-text-primary md:text-4xl" style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                    Kit kell elérnie az ipari B2B marketingnek?
                </h2>
                <p class="max-w-xl text-lg text-text-secondary">
                    A Cégem360 eszközei segítenek célzottan megszólítani minden döntéshozói szintet.
                </p>
            </div>

            <div class="grid grid-cols-1 gap-6 md:grid-cols-3" data-stagger>
                <div class="stagger-item group card-glow relative overflow-hidden rounded-2xl border border-border-light bg-surface-primary p-8"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="absolute inset-x-0 top-0 h-1 bg-linear-to-r from-pink-500 to-primary-500 opacity-0 transition-opacity duration-500 group-hover:opacity-100"></div>
                    <div class="icon-hover mb-4 flex h-14 w-14 items-center justify-center rounded-2xl bg-pink-50">
                        <svg class="h-7 w-7 text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                        </svg>
                    </div>
                    <p class="mb-2 text-xs font-semibold uppercase tracking-wider text-pink-500">Beszerzési osztály</p>
                    <h3 class="mb-3 text-lg font-bold text-text-primary">Beszerzési vezetők és referensek</h3>
                    <p class="text-sm leading-relaxed text-text-secondary">Árak, szállítási határidők, referenciák — nekik a tények számítanak. A CRM és Értékesítés modul segít személyre szabott ajánlatokkal megtalálni őket.</p>
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
                    <p class="mb-2 text-xs font-semibold uppercase tracking-wider text-violet-600">Műszaki döntéshozók</p>
                    <h3 class="mb-3 text-lg font-bold text-text-primary">Műszaki igazgatók és mérnökök</h3>
                    <p class="text-sm leading-relaxed text-text-secondary">Specifikációk, tanúsítványok, technikai tartalom. Az SEO Eszköz és AI Chat segít, hogy ők találjanak Önre — a megfelelő pillanatban.</p>
                </div>

                <div class="stagger-item group card-glow relative overflow-hidden rounded-2xl border border-border-light bg-surface-primary p-8"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="absolute inset-x-0 top-0 h-1 bg-linear-to-r from-primary-500 to-cyan-500 opacity-0 transition-opacity duration-500 group-hover:opacity-100"></div>
                    <div class="icon-hover mb-4 flex h-14 w-14 items-center justify-center rounded-2xl bg-primary-50">
                        <svg class="h-7 w-7 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                        </svg>
                    </div>
                    <p class="mb-2 text-xs font-semibold uppercase tracking-wider text-primary-600">Felső vezetés</p>
                    <h3 class="mb-3 text-lg font-bold text-text-primary">Ügyvezetők és tulajdonosok</h3>
                    <p class="text-sm leading-relaxed text-text-secondary">ROI, stratégiai előny, megbízhatóság. A DataMind és MarketingHub adatai segítenek bizonyítani, hogy a befektetés megtérül.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Core Marketing Toolkit Section --}}
    <section class="bg-surface-primary py-16 lg:py-24" id="megoldasok">
        <div class="mx-auto max-w-7xl px-6">
            <div class="reveal mb-12">
                <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-primary-600">Marketing eszköztár</p>
                <h2 class="mb-4 text-3xl text-text-primary md:text-4xl" style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                    4 kulcsmodul a marketing hatékonyságért
                </h2>
                <p class="max-w-xl text-lg text-text-secondary">
                    Ezek a modulok közvetlenül a marketing csapat mindennapi munkáját támogatják.
                </p>
            </div>

            <div class="grid grid-cols-1 gap-6 lg:grid-cols-2" data-stagger>
                {{-- MarketingHub --}}
                <div class="stagger-item group card-glow rounded-2xl border border-border-light bg-surface-primary p-8 transition-all hover:border-pink-200"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="mb-5 flex items-center gap-3">
                        <div class="icon-hover">
                            <x-module-icon module="marketinghub" size="sm" rounded="lg" />
                        </div>
                        <div>
                            <span class="rounded-md bg-pink-50 px-2.5 py-1 text-xs font-bold uppercase tracking-wider text-pink-600">MarketingHub</span>
                        </div>
                        <span class="text-xs text-text-tertiary">Központi marketing vezérlőpult</span>
                    </div>
                    <h3 class="mb-3 text-xl font-bold text-text-primary">Minden marketing adat — egy irányítópulton</h3>
                    <p class="mb-6 text-sm leading-relaxed text-text-secondary">Google Ads, Meta, Analytics, SEO és elégedettségi adatok egyetlen felületen. Ügyfélszegmentálás, NPS mérés, kampányelemzés és automatikus riportok.</p>
                    <div class="mb-6 grid grid-cols-2 gap-2">
                        <span class="flex items-center gap-2 text-sm text-text-secondary">
                            <span class="feature-dot h-1.5 w-1.5 rounded-full bg-pink-500"></span>Drag & drop dashboard
                        </span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary">
                            <span class="feature-dot h-1.5 w-1.5 rounded-full bg-pink-500"></span>PDF/Excel riportok
                        </span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary">
                            <span class="feature-dot h-1.5 w-1.5 rounded-full bg-pink-500"></span>NPS/CSAT mérés
                        </span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary">
                            <span class="feature-dot h-1.5 w-1.5 rounded-full bg-pink-500"></span>AI Asszisztens
                        </span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary">
                            <span class="feature-dot h-1.5 w-1.5 rounded-full bg-pink-500"></span>GDPR megfelelőség
                        </span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary">
                            <span class="feature-dot h-1.5 w-1.5 rounded-full bg-pink-500"></span>Dinamikus szegmentálás
                        </span>
                    </div>
                    <a href="{{ route('products.marketinghub') }}" class="inline-flex items-center gap-1.5 text-sm font-semibold text-pink-600 transition-colors hover:text-pink-700">
                        Részletek megtekintése
                        <svg class="arrow-slide h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                        </svg>
                    </a>
                </div>

                {{-- SEO Eszköz --}}
                <div class="stagger-item group card-glow rounded-2xl border border-border-light bg-surface-primary p-8 transition-all hover:border-violet-200"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="mb-5 flex items-center gap-3">
                        <div class="icon-hover">
                            <x-module-icon module="seo" size="sm" rounded="lg" />
                        </div>
                        <div>
                            <span class="rounded-md bg-violet-50 px-2.5 py-1 text-xs font-bold uppercase tracking-wider text-violet-600">SEO Eszköz</span>
                        </div>
                        <span class="text-xs text-text-tertiary">AI alapú keresőoptimalizálás</span>
                    </div>
                    <h3 class="mb-3 text-xl font-bold text-text-primary">Legyen az első találat — ipari kulcsszavakra</h3>
                    <p class="mb-6 text-sm leading-relaxed text-text-secondary">AI-alapú kulcsszókutatás, versenytárs-elemzés és tartalom-optimalizálás. Google Analytics és Search Console AI elemzés, automatikus KPI követés.</p>
                    <div class="mb-6 grid grid-cols-2 gap-2">
                        <span class="flex items-center gap-2 text-sm text-text-secondary">
                            <span class="feature-dot h-1.5 w-1.5 rounded-full bg-violet-500"></span>Long-tail kulcsszó javaslatok
                        </span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary">
                            <span class="feature-dot h-1.5 w-1.5 rounded-full bg-violet-500"></span>Versenytárs gap elemzés
                        </span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary">
                            <span class="feature-dot h-1.5 w-1.5 rounded-full bg-violet-500"></span>Tartalom optimalizálás
                        </span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary">
                            <span class="feature-dot h-1.5 w-1.5 rounded-full bg-violet-500"></span>CTR javítási tippek
                        </span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary">
                            <span class="feature-dot h-1.5 w-1.5 rounded-full bg-violet-500"></span>Core Web Vitals
                        </span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary">
                            <span class="feature-dot h-1.5 w-1.5 rounded-full bg-violet-500"></span>Automatikus riasztások
                        </span>
                    </div>
                    <a href="{{ route('products.seo') }}" class="inline-flex items-center gap-1.5 text-sm font-semibold text-violet-600 transition-colors hover:text-violet-700">
                        Részletek megtekintése
                        <svg class="arrow-slide h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                        </svg>
                    </a>
                </div>

                {{-- DataMind --}}
                <div class="stagger-item group card-glow rounded-2xl border border-border-light bg-surface-primary p-8 transition-all hover:border-violet-200"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="mb-5 flex items-center gap-3">
                        <div class="icon-hover">
                            <x-module-icon module="datamind" size="sm" rounded="lg" />
                        </div>
                        <div>
                            <span class="rounded-md bg-violet-50 px-2.5 py-1 text-xs font-bold uppercase tracking-wider text-violet-600">DataMind</span>
                        </div>
                        <span class="text-xs text-text-tertiary">MI alapú üzleti intelligencia</span>
                    </div>
                    <h3 class="mb-3 text-xl font-bold text-text-primary">Prediktív elemzés — kódolás nélkül</h3>
                    <p class="mb-6 text-sm leading-relaxed text-text-secondary">Automatikus összefüggés-feltárás marketing adatokban, forgalom-előrejelzés, konverzió predikció. Drag-and-drop modellépítő és magyar nyelvű MI összefoglalók.</p>
                    <div class="mb-6 grid grid-cols-2 gap-2">
                        <span class="flex items-center gap-2 text-sm text-text-secondary">
                            <span class="feature-dot h-1.5 w-1.5 rounded-full bg-violet-500"></span>Anomália-detektálás
                        </span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary">
                            <span class="feature-dot h-1.5 w-1.5 rounded-full bg-violet-500"></span>Konverzió predikció
                        </span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary">
                            <span class="feature-dot h-1.5 w-1.5 rounded-full bg-violet-500"></span>Ügyfél-szegmentáció
                        </span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary">
                            <span class="feature-dot h-1.5 w-1.5 rounded-full bg-violet-500"></span>Automatikus riportok
                        </span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary">
                            <span class="feature-dot h-1.5 w-1.5 rounded-full bg-violet-500"></span>Több adatforrás
                        </span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary">
                            <span class="feature-dot h-1.5 w-1.5 rounded-full bg-violet-500"></span>Iparági benchmark
                        </span>
                    </div>
                    <a href="{{ route('products.datamind') }}" class="inline-flex items-center gap-1.5 text-sm font-semibold text-violet-600 transition-colors hover:text-violet-700">
                        Részletek megtekintése
                        <svg class="arrow-slide h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                        </svg>
                    </a>
                </div>

                {{-- AI Chat --}}
                <div class="stagger-item group card-glow rounded-2xl border border-border-light bg-surface-primary p-8 transition-all hover:border-blue-200"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="mb-5 flex items-center gap-3">
                        <div class="icon-hover">
                            <x-module-icon module="ai-chat" size="sm" rounded="lg" />
                        </div>
                        <div>
                            <span class="rounded-md bg-blue-50 px-2.5 py-1 text-xs font-bold uppercase tracking-wider text-blue-600">AI Chat</span>
                        </div>
                        <span class="text-xs text-text-tertiary">Intelligens chatbot</span>
                    </div>
                    <h3 class="mb-3 text-xl font-bold text-text-primary">0-24 lead generálás a weboldalon</h3>
                    <p class="mb-6 text-sm leading-relaxed text-text-secondary">A chatbot ismeri a termékeket, válaszol a műszaki kérdésekre és kvalifikálja a látogatókat — automatikusan, akár munkaidőn kívül is. Többnyelvű támogatás.</p>
                    <div class="mb-6 grid grid-cols-2 gap-2">
                        <span class="flex items-center gap-2 text-sm text-text-secondary">
                            <span class="feature-dot h-1.5 w-1.5 rounded-full bg-blue-500"></span>Weboldal tartalom alapú
                        </span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary">
                            <span class="feature-dot h-1.5 w-1.5 rounded-full bg-blue-500"></span>Lead kvalifikálás
                        </span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary">
                            <span class="feature-dot h-1.5 w-1.5 rounded-full bg-blue-500"></span>Többnyelvű (HU/EN/DE)
                        </span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary">
                            <span class="feature-dot h-1.5 w-1.5 rounded-full bg-blue-500"></span>Saját API kulcs
                        </span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary">
                            <span class="feature-dot h-1.5 w-1.5 rounded-full bg-blue-500"></span>5 perc telepítés
                        </span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary">
                            <span class="feature-dot h-1.5 w-1.5 rounded-full bg-blue-500"></span>CRM integráció
                        </span>
                    </div>
                    <a href="{{ route('products.aichat') }}" class="inline-flex items-center gap-1.5 text-sm font-semibold text-blue-600 transition-colors hover:text-blue-700">
                        Részletek megtekintése
                        <svg class="arrow-slide h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{-- Full Ecosystem Section --}}
    <section class="bg-surface-secondary py-16 lg:py-24" id="okoszisztema">
        <div class="mx-auto max-w-7xl px-6">
            <div class="mb-12 grid grid-cols-1 items-start gap-8 lg:grid-cols-2">
                <div class="reveal-left">
                    <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-primary-600">Teljes ökoszisztéma</p>
                    <h2 class="text-3xl text-text-primary md:text-4xl" style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                        Mind a 11 modul segíti a marketinget
                    </h2>
                </div>
                <p class="reveal-right text-lg leading-relaxed text-text-secondary lg:mt-6">
                    A marketing nem sziget. A CRM-ből jönnek a leadek, a kontrolling méri a ROI-t, a beszerzés és gyártás biztosítja, hogy amit ígér, azt teljesítse. Minden modul adatot ad a marketingnek — és a marketing adatot ad mindenkinek.
                </p>
            </div>

            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4" data-stagger>
                <div class="stagger-item card-glow rounded-xl border border-border-light bg-surface-primary p-6 text-center"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="icon-hover mx-auto mb-3 flex h-11 w-11 items-center justify-center rounded-xl bg-primary-50">
                        <x-module-icon module="crm" size="xs" />
                    </div>
                    <h4 class="mb-1 text-sm font-bold text-text-primary">CRM</h4>
                    <p class="text-xs leading-relaxed text-text-tertiary">Lead-forrás követés, pipeline és konverzió mérés — tudja, melyik kampány hozta az ügyfelet.</p>
                </div>

                <div class="stagger-item card-glow rounded-xl border border-border-light bg-surface-primary p-6 text-center"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="icon-hover mx-auto mb-3 flex h-11 w-11 items-center justify-center rounded-xl bg-success-50">
                        <x-module-icon module="ertekesites" size="xs" />
                    </div>
                    <h4 class="mb-1 text-sm font-bold text-text-primary">Értékesítés</h4>
                    <p class="text-xs leading-relaxed text-text-tertiary">Marketing-sales összehangolás: ajánlat lezárási adatok visszacsatolása a kampányokba.</p>
                </div>

                <div class="stagger-item card-glow rounded-xl border border-border-light bg-surface-primary p-6 text-center"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="icon-hover mx-auto mb-3 flex h-11 w-11 items-center justify-center rounded-xl bg-warning-50">
                        <x-module-icon module="kontrolling" size="xs" />
                    </div>
                    <h4 class="mb-1 text-sm font-bold text-text-primary">Kontrolling</h4>
                    <p class="text-xs leading-relaxed text-text-tertiary">Marketing költségvetés és kampány ROI mérése valós pénzügyi adatokkal.</p>
                </div>

                <div class="stagger-item card-glow rounded-xl border border-border-light bg-surface-primary p-6 text-center"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="icon-hover mx-auto mb-3 flex h-11 w-11 items-center justify-center rounded-xl bg-success-50">
                        <x-module-icon module="automatizalas" size="xs" />
                    </div>
                    <h4 class="mb-1 text-sm font-bold text-text-primary">Automatizálás</h4>
                    <p class="text-xs leading-relaxed text-text-tertiary">Follow-up e-mailek, lead scoring triggerek és feladat-delegálás — szabályalapúan.</p>
                </div>

                <div class="stagger-item card-glow rounded-xl border border-border-light bg-surface-primary p-6 text-center"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="icon-hover mx-auto mb-3 flex h-11 w-11 items-center justify-center rounded-xl bg-violet-50">
                        <x-module-icon module="gyartas" size="xs" />
                    </div>
                    <h4 class="mb-1 text-sm font-bold text-text-primary">Gyártásirányítás</h4>
                    <p class="text-xs leading-relaxed text-text-tertiary">Kapacitás és termelési adatok, hogy a marketing reális szállítási időket kommunikálhasson.</p>
                </div>

                <div class="stagger-item card-glow rounded-xl border border-border-light bg-surface-primary p-6 text-center"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="icon-hover mx-auto mb-3 flex h-11 w-11 items-center justify-center rounded-xl bg-cyan-50">
                        <x-module-icon module="beszerzes" size="xs" />
                    </div>
                    <h4 class="mb-1 text-sm font-bold text-text-primary">Beszerzés-logisztika</h4>
                    <p class="text-xs leading-relaxed text-text-tertiary">Készletinformáció a marketing számára — ne hirdessen olyat, ami nincs raktáron.</p>
                </div>

                <div class="stagger-item card-glow rounded-xl border border-border-light bg-surface-primary p-6 text-center"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="icon-hover mx-auto mb-3 flex h-11 w-11 items-center justify-center rounded-xl bg-cyan-50">
                        <x-module-icon module="szerviz" size="xs" />
                    </div>
                    <h4 class="mb-1 text-sm font-bold text-text-primary">Digitális munkalap</h4>
                    <p class="text-xs leading-relaxed text-text-tertiary">Helyszíni visszajelzések és ügyfél-elégedettségi adatok a tartalomgyártáshoz és referenciákhoz.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Workflow Section --}}
    <section class="bg-surface-primary py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-6">
            <div class="reveal mb-14">
                <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-primary-600">Marketing workflow</p>
                <h2 class="mb-4 text-3xl text-text-primary md:text-4xl" style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                    Zárt körű rendszer — a megjelenéstől a lezárásig
                </h2>
                <p class="max-w-xl text-lg text-text-secondary">
                    Így dolgozik együtt a Cégem360 a marketing csapat mindennapjaiban.
                </p>
            </div>

            <div class="relative">
                {{-- Connector line (desktop only) --}}
                <div class="workflow-line reveal absolute top-8 right-[10%] left-[10%] hidden h-0.5 lg:block"></div>

                <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-5" data-stagger>
                    @php
                        $steps = [
                            ['num' => '01', 'title' => 'Megtalálnak', 'desc' => 'Az ipari döntéshozó rátalál Önre keresőben vagy hirdetésben', 'modules' => ['SEO Eszköz', 'MarketingHub'], 'color' => 'primary'],
                            ['num' => '02', 'title' => 'Kvalifikálás', 'desc' => 'Az AI Chat kvalifikálja a látogatót és átadja a leadet', 'modules' => ['AI Chat', 'Automatizálás'], 'color' => 'cyan'],
                            ['num' => '03', 'title' => 'Nyomon követés', 'desc' => 'A CRM rögzíti a leadet, az automatizálás indítja a follow-up szekvenciát', 'modules' => ['CRM', 'Automatizálás'], 'color' => 'success'],
                            ['num' => '04', 'title' => 'Ajánlattétel', 'desc' => 'Az értékesítés professzionális ajánlatot küld, a marketing látja a pipeline állapotát', 'modules' => ['Értékesítés', 'CRM'], 'color' => 'warning'],
                            ['num' => '05', 'title' => 'Elemzés', 'desc' => 'A DataMind és Kontrolling méri a teljes marketing ROI-t és javaslatot ad', 'modules' => ['DataMind', 'Kontrolling'], 'color' => 'violet'],
                        ];
                    @endphp

                    @foreach ($steps as $step)
                        <div class="stagger-item text-center">
                            <div class="relative z-10 mx-auto mb-5 flex h-16 w-16 items-center justify-center rounded-full border-2 border-{{ $step['color'] }}-200 bg-{{ $step['color'] }}-50 text-2xl font-bold text-{{ $step['color'] }}-600 transition-all duration-300 hover:scale-110 hover:shadow-lg">
                                {{ $step['num'] }}
                            </div>
                            <h4 class="mb-2 text-base font-bold text-text-primary">{{ $step['title'] }}</h4>
                            <p class="mb-3 text-sm leading-relaxed text-text-tertiary">{{ $step['desc'] }}</p>
                            <div class="flex flex-wrap justify-center gap-1.5">
                                @foreach ($step['modules'] as $module)
                                    <span class="rounded-md bg-surface-secondary px-2 py-0.5 text-[11px] font-semibold text-text-tertiary">{{ $module }}</span>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    {{-- Stats Section --}}
    <section class="bg-surface-secondary py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-6">
            <div class="reveal mb-12 text-center">
                <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-primary-600">Eredmények</p>
                <h2 class="text-3xl text-text-primary md:text-4xl" style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                    Mérhető javulás ügyfeleink körében
                </h2>
            </div>

            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4" data-stagger data-counter-trigger>
                <div class="stagger-item stat-hover rounded-2xl border border-border-light bg-surface-primary p-8 text-center"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <p class="stat-value mb-2 text-4xl font-bold text-primary-600" style="font-family: 'JetBrains Mono', monospace;" data-count="45" data-prefix="+" data-suffix="%">0%</p>
                    <p class="text-sm font-medium text-text-secondary">Marketing ROI növekedés</p>
                </div>

                <div class="stagger-item stat-hover rounded-2xl border border-border-light bg-surface-primary p-8 text-center"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <p class="stat-value mb-2 text-4xl font-bold text-success-600" style="font-family: 'JetBrains Mono', monospace;" data-count="3" data-suffix="x">0x</p>
                    <p class="text-sm font-medium text-text-secondary">Organikus forgalom</p>
                </div>

                <div class="stagger-item stat-hover rounded-2xl border border-border-light bg-surface-primary p-8 text-center"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <p class="stat-value mb-2 text-4xl font-bold text-cyan-600" style="font-family: 'JetBrains Mono', monospace;" data-count="70" data-prefix="-" data-suffix="%">0%</p>
                    <p class="text-sm font-medium text-text-secondary">Riportkészítési idő</p>
                </div>

                <div class="stagger-item stat-hover rounded-2xl border border-border-light bg-surface-primary p-8 text-center"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <p class="stat-value mb-2 text-4xl font-bold text-warning-600" style="font-family: 'JetBrains Mono', monospace;" data-count="2" data-suffix="x">0x</p>
                    <p class="text-sm font-medium text-text-secondary">Lead konverzió</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Use Cases Section --}}
    <section class="bg-surface-primary py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-6">
            <div class="reveal mb-12">
                <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-primary-600">Felhasználási esetek</p>
                <h2 class="mb-4 text-3xl text-text-primary md:text-4xl" style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                    Így használják ipari marketing csapatok
                </h2>
            </div>

            <div class="grid grid-cols-1 gap-5 md:grid-cols-2 lg:grid-cols-3" data-stagger>
                @php
                    $useCases = [
                        ['num' => '01', 'title' => 'Lead generálás ipari beszerzőknek', 'desc' => 'SEO-optimalizált technikai tartalmak és AI chatbot, amelyek a megfelelő kulcsszavakra vonzzák a beszerzési döntéshozókat, majd automatikusan kvalifikálják őket.', 'tags' => ['SEO Eszköz', 'AI Chat', 'CRM']],
                        ['num' => '02', 'title' => 'Kampány-attribúció és ROI mérés', 'desc' => 'Összeköti a Google Ads, organikus és direkt csatornákat a tényleges lezárt ügyletekkel. Végre tudja, melyik kampány hoz valódi árbevételt.', 'tags' => ['MarketingHub', 'Kontrolling', 'DataMind']],
                        ['num' => '03', 'title' => 'Marketing-Sales összehangolás', 'desc' => 'A marketing leadjei automatikusan kerülnek a CRM pipeline-ba, az értékesítés visszajelzése pedig méri a marketing hatékonyságát.', 'tags' => ['CRM', 'Értékesítés', 'Automatizálás']],
                        ['num' => '04', 'title' => 'Automatizált follow-up szekvenciák', 'desc' => 'A lead scoring és trigger-alapú workflow-k gondoskodnak arról, hogy egyetlen érdeklődő se vesszen el a pipeline-ban.', 'tags' => ['Automatizálás', 'CRM']],
                        ['num' => '05', 'title' => 'Prediktív kampánytervezés', 'desc' => 'A DataMind MI modellje előrejelzi, melyik kampány hozhat jobb eredményt, és automatikusan javaslatot ad a büdzsé átcsoportosítására.', 'tags' => ['DataMind', 'MarketingHub']],
                        ['num' => '06', 'title' => 'Többnyelvű ipari tartalom és SEO', 'desc' => 'Magyar, angol és német piacra egyaránt optimalizált tartalom stratégia — AI-alapú kulcsszókutatással és versenytárs-elemzéssel.', 'tags' => ['SEO Eszköz', 'AI Chat']],
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
                                <span class="rounded-md bg-primary-50 px-2.5 py-1 text-xs font-medium text-primary-700 transition-colors hover:bg-primary-100">{{ $tag }}</span>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Integrations Section --}}
    <section class="bg-surface-primary py-12 lg:py-16">
        <div class="mx-auto max-w-7xl px-6">
            <div class="reveal mb-8 text-center">
                <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-primary-600">Integrációk</p>
                <h2 class="text-3xl text-text-primary md:text-4xl" style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                    Csatlakozik a meglévő eszközeihez
                </h2>
            </div>

            <div class="flex flex-wrap justify-center gap-3" data-stagger>
                @php
                    $integrations = [
                        ['name' => 'Google Analytics', 'color' => 'primary'],
                        ['name' => 'Google Ads', 'color' => 'success'],
                        ['name' => 'Search Console', 'color' => 'warning'],
                        ['name' => 'Meta Ads', 'color' => 'violet'],
                        ['name' => 'Gmail / Outlook', 'color' => 'cyan'],
                        ['name' => 'CSV / Excel', 'color' => 'danger'],
                        ['name' => 'ERP rendszerek', 'color' => 'primary'],
                    ];
                @endphp

                @foreach ($integrations as $integration)
                    <div class="stagger-item pill-float flex items-center gap-2 rounded-full border border-border-light bg-surface-primary px-4 py-2.5 text-sm font-medium text-text-secondary"
                        style="box-shadow: 0 1px 3px rgba(0,0,0,0.04);">
                        <span class="h-2 w-2 rounded-full bg-{{ $integration['color'] }}-500"></span>
                        {{ $integration['name'] }}
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Consultation Banner --}}
    <section class="bg-surface-secondary py-6 lg:py-10">
        <div class="mx-auto max-w-7xl px-6">
            <div class="reveal-scale flex flex-col items-center gap-8 rounded-2xl border border-border-light bg-surface-primary p-10 transition-shadow duration-500 hover:shadow-xl lg:flex-row lg:justify-between"
                style="box-shadow: 0 4px 20px -4px rgba(96, 92, 212, 0.08);">
                <div>
                    <h3 class="mb-2 text-xl font-bold text-text-primary">Személyre szabott online konzultáció</h3>
                    <p class="mb-4 max-w-lg text-sm leading-relaxed text-text-secondary">30 perces videóhívás, amelyben felmérjük, hogyan illeszkedik a Cégem360 az Ön marketing folyamataiba — az Ön iparágára és célcsoportjára szabva.</p>
                    <div class="flex flex-wrap gap-5">
                        <span class="flex items-center gap-1.5 text-xs font-medium text-text-tertiary">
                            <svg class="h-3.5 w-3.5 text-success-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" /></svg>
                            30 perc videóhívás
                        </span>
                        <span class="flex items-center gap-1.5 text-xs font-medium text-text-tertiary">
                            <svg class="h-3.5 w-3.5 text-success-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" /></svg>
                            Iparágra szabott tanácsadás
                        </span>
                        <span class="flex items-center gap-1.5 text-xs font-medium text-text-tertiary">
                            <svg class="h-3.5 w-3.5 text-success-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" /></svg>
                            Nincs elköteleződés
                        </span>
                    </div>
                </div>
                <a href="{{ route('contact') }}"
                    class="group inline-flex shrink-0 items-center gap-2 rounded-full bg-primary-600 px-6 py-3 text-base font-medium text-white transition-all hover:bg-primary-700 hover:shadow-lg"
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
    <section class="bg-surface-primary py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-6">
            <div class="reveal mb-12 text-center">
                <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-primary-600">Kezdje el</p>
                <h2 class="mb-4 text-3xl text-text-primary md:text-4xl" style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                    Készen áll a hatékonyabb B2B marketingre?
                </h2>
                <p class="text-lg text-text-secondary">Válassza ki a következő lépést az Ön számára.</p>
            </div>

            <div class="mx-auto grid max-w-3xl grid-cols-1 gap-6 md:grid-cols-2" data-stagger>
                <div class="stagger-item card-glow rounded-2xl border border-cyan-100 bg-linear-to-br from-cyan-50/40 to-surface-primary p-8 text-center"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <h3 class="mb-3 text-lg font-bold text-text-primary">Online konzultáció</h3>
                    <p class="mb-6 text-sm leading-relaxed text-text-secondary">Kérdezzen szakértőinktől 30 percben — videóhíváson, az Ön iparágára szabva, kötelezettség nélkül.</p>
                    <a href="{{ route('contact') }}"
                        class="group inline-flex items-center gap-2 rounded-full border border-border-light bg-surface-primary px-5 py-2.5 text-sm font-medium text-text-primary transition-all hover:border-primary-200 hover:bg-surface-secondary hover:shadow-md">
                        Időpont foglalása
                        <svg class="arrow-slide h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                        </svg>
                    </a>
                </div>

                <div class="stagger-item card-glow rounded-2xl border border-primary-100 bg-linear-to-br from-primary-50/40 to-surface-primary p-8 text-center"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <h3 class="mb-3 text-lg font-bold text-text-primary">Regisztráció és kipróbálás</h3>
                    <p class="mb-6 text-sm leading-relaxed text-text-secondary">Fedezze fel a platform teljes funkcionalitását. Ismerje meg a modulokat és kezdjen el dolgozni azonnal.</p>
                    <a href="{{ route('register') }}"
                        class="group inline-flex items-center gap-2 rounded-full bg-primary-600 px-5 py-2.5 text-sm font-medium text-white transition-all hover:bg-primary-700 hover:shadow-lg"
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
