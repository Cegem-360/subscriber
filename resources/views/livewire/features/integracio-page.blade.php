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
            0% { box-shadow: 0 0 0 0 rgba(20, 184, 166, 0.4); }
            70% { box-shadow: 0 0 0 6px rgba(20, 184, 166, 0); }
            100% { box-shadow: 0 0 0 0 rgba(20, 184, 166, 0); }
        }
        .pulse-dot { animation: pulse-ring 2s ease infinite; }

        .card-glow { transition: all 0.4s cubic-bezier(0,0,0.2,1); }
        .card-glow:hover { box-shadow: 0 8px 30px -8px rgba(20, 184, 166, 0.15), 0 2px 8px rgba(0,0,0,0.04) !important; }

        .icon-hover { transition: transform 0.35s cubic-bezier(0,0,0.2,1.4); }
        .group:hover .icon-hover, .card-glow:hover .icon-hover { transform: translateY(-3px) scale(1.08); }

        .arrow-slide { transition: transform 0.3s cubic-bezier(0,0,0.2,1); }
        .group:hover .arrow-slide, a:hover .arrow-slide { transform: translateX(4px); }

        .stat-hover .stat-value { transition: transform 0.4s cubic-bezier(0,0,0.2,1.4); }
        .stat-hover:hover .stat-value { transform: scale(1.08); }

        .feature-dot { transition: transform 0.3s cubic-bezier(0,0,0.2,1); }
        .card-glow:hover .feature-dot { transform: scale(1.5); }

        @keyframes hub-spin { to { transform: translate(-50%, -50%) rotate(360deg); } }
        .hub-ring { animation: hub-spin 30s linear infinite; }

        @keyframes hub-pulse { 0%, 100% { opacity: 1; } 50% { opacity: 0.4; } }
        .hub-pulse { animation: hub-pulse 2s ease infinite; }

        .pill-float { transition: transform 0.35s cubic-bezier(0,0,0.2,1), box-shadow 0.35s cubic-bezier(0,0,0.2,1); }
        .pill-float:hover { transform: translateY(-3px); box-shadow: 0 6px 20px -4px rgba(20, 184, 166, 0.12); }

        .code-line { opacity: 0; animation: code-appear 0.3s ease forwards; }
        .code-line:nth-child(1) { animation-delay: 0.1s; }
        .code-line:nth-child(2) { animation-delay: 0.3s; }
        .code-line:nth-child(3) { animation-delay: 0.5s; }
        @keyframes code-appear { to { opacity: 1; } }

        html { scroll-behavior: smooth; }
    </style>

    {{-- Hero Section --}}
    <section class="bg-linear-to-b from-teal-50 to-surface-secondary">
        <div class="mx-auto max-w-7xl px-6 py-16 lg:py-24">
            <div class="grid grid-cols-1 items-center gap-12 lg:grid-cols-2">
                {{-- Hero Text --}}
                <div class="reveal">
                    <div class="badge-gradient mb-8 inline-flex items-center gap-2 rounded-full border border-border-light/80 bg-surface-primary px-4 py-1.5"
                        style="box-shadow: 0 1px 3px rgba(0,0,0,0.04);">
                        <span class="pulse-dot h-1.5 w-1.5 rounded-full bg-linear-to-r from-teal-500 via-emerald-500 to-teal-400"></span>
                        <span class="text-sm font-medium text-text-primary">Funkció — Integrációk</span>
                    </div>

                    <h1 class="mb-6 text-4xl leading-tight tracking-tight text-text-primary md:text-5xl lg:text-[3.5rem]"
                        style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                        11 modul, egyetlen rendszer —<br>
                        és REST API bármilyen külső kapcsolathoz
                    </h1>

                    <p class="mb-10 max-w-xl text-lg text-text-secondary lg:text-xl">
                        A Cégem360 legnagyobb ereje: a 11 modul natívan össze van kötve, nulla konfigurációval. Ha külső rendszerhez is csatlakozni kell — számlázó, ERP, webshop — a REST API-n keresztül, beépített AI segítséggel, dokumentációval és az integrációs szolgáltatásunkkal minden megoldható.
                    </p>

                    <div class="flex flex-wrap items-center gap-4">
                        <a href="{{ route('contact') }}"
                            class="group inline-flex items-center gap-2 rounded-full bg-teal-600 px-6 py-3 text-base font-medium text-white transition-all hover:bg-teal-700 hover:shadow-lg"
                            style="box-shadow: 0 1px 2px rgba(0,0,0,0.05);">
                            <span>Online konzultáció</span>
                            <svg class="arrow-slide h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" /></svg>
                        </a>
                        <a href="#hogyan-mukodik"
                            class="inline-flex items-center gap-2 rounded-full border border-border-light bg-surface-primary px-6 py-3 text-base font-medium text-text-primary transition-all hover:border-teal-200 hover:bg-surface-secondary hover:shadow-md">
                            Hogyan működik?
                        </a>
                    </div>
                </div>

                {{-- Integration Hub Visual --}}
                <div class="reveal-right">
                    <div class="rounded-2xl border border-border-light bg-surface-primary p-6"
                        style="box-shadow: 0 4px 20px -4px rgba(0,0,0,0.06);">
                        <div class="mb-4 flex items-center justify-between border-b border-border-light pb-4">
                            <div>
                                <span class="block text-sm font-bold text-text-primary">Integrációs áttekintés</span>
                                <span class="block text-[10px] text-text-tertiary">Belső modulkapcsolatok + külső API</span>
                            </div>
                            <span class="inline-flex items-center gap-1.5 rounded-md border border-teal-100 bg-linear-to-r from-teal-50 to-emerald-50 px-2.5 py-1 text-[10px] font-semibold text-teal-600">
                                <span class="hub-pulse">🔗</span>
                                11 modul aktív
                            </span>
                        </div>

                        {{-- Hub Center --}}
                        <div class="relative mb-4 flex justify-center py-6">
                            <div class="relative z-10 flex h-16 w-16 items-center justify-center rounded-full bg-linear-to-br from-teal-500 to-emerald-500 text-xs font-extrabold tracking-wide text-white"
                                style="box-shadow: 0 0 30px rgba(20,184,166,0.3), 0 0 60px rgba(20,184,166,0.1);">
                                C360
                            </div>
                            <div class="hub-ring absolute top-1/2 left-1/2 h-36 w-36 rounded-full border border-dashed border-teal-200"
                                style="transform: translate(-50%, -50%);"></div>
                        </div>

                        {{-- Module Cards --}}
                        <div class="mb-3 grid grid-cols-4 gap-1.5">
                            <div class="rounded-md border border-border-light bg-surface-secondary p-1.5 text-center">
                                <span class="block text-[10px] font-bold text-text-secondary">CRM</span>
                                <span class="text-[9px] text-emerald-500">↔ 10</span>
                            </div>
                            <div class="rounded-md border border-border-light bg-surface-secondary p-1.5 text-center">
                                <span class="block text-[10px] font-bold text-text-secondary">Értékesítés</span>
                                <span class="text-[9px] text-emerald-500">↔ 8</span>
                            </div>
                            <div class="rounded-md border border-border-light bg-surface-secondary p-1.5 text-center">
                                <span class="block text-[10px] font-bold text-text-secondary">Beszerzés</span>
                                <span class="text-[9px] text-emerald-500">↔ 7</span>
                            </div>
                            <div class="rounded-md border border-border-light bg-surface-secondary p-1.5 text-center">
                                <span class="block text-[10px] font-bold text-text-secondary">Gyártás</span>
                                <span class="text-[9px] text-emerald-500">↔ 8</span>
                            </div>
                            <div class="rounded-md border border-border-light bg-surface-secondary p-1.5 text-center">
                                <span class="block text-[10px] font-bold text-text-secondary">Munkalap</span>
                                <span class="text-[9px] text-emerald-500">↔ 6</span>
                            </div>
                            <div class="rounded-md border border-border-light bg-surface-secondary p-1.5 text-center">
                                <span class="block text-[10px] font-bold text-text-secondary">Kontrolling</span>
                                <span class="text-[9px] text-emerald-500">↔ 10</span>
                            </div>
                            <div class="rounded-md border border-border-light bg-surface-secondary p-1.5 text-center">
                                <span class="block text-[10px] font-bold text-text-secondary">Automatizálás</span>
                                <span class="text-[9px] text-emerald-500">↔ 10</span>
                            </div>
                            <div class="rounded-md border border-border-light bg-surface-secondary p-1.5 text-center">
                                <span class="block text-[10px] font-bold text-text-secondary">DataMind</span>
                                <span class="text-[9px] text-emerald-500">↔ 10</span>
                            </div>
                        </div>

                        {{-- Connection Stats --}}
                        <div class="mb-3 grid grid-cols-2 gap-2">
                            <div class="rounded-lg border border-teal-100 bg-linear-to-r from-teal-50 to-emerald-50 p-3 text-center">
                                <span class="block text-lg font-extrabold text-teal-600" style="font-family: 'JetBrains Mono', monospace;">55+</span>
                                <span class="block text-[9px] font-semibold uppercase tracking-wider text-text-tertiary">Belső modulkapcsolat</span>
                            </div>
                            <div class="rounded-lg border border-violet-100 bg-linear-to-r from-violet-50 to-purple-50 p-3 text-center">
                                <span class="block text-lg font-extrabold text-violet-600" style="font-family: 'JetBrains Mono', monospace;">REST</span>
                                <span class="block text-[9px] font-semibold uppercase tracking-wider text-text-tertiary">Külső API csatlakozás</span>
                            </div>
                        </div>

                        {{-- AI Integration Panel --}}
                        <div class="mb-3 rounded-lg border border-violet-100 bg-linear-to-r from-violet-50 to-purple-50 p-3">
                            <div class="mb-1 flex items-center gap-2">
                                <div class="flex h-5 w-5 items-center justify-center rounded-md bg-violet-500 text-[9px] font-bold text-white">AI</div>
                                <span class="text-xs font-bold text-violet-600">AI-támogatott integráció</span>
                            </div>
                            <p class="text-[11px] leading-relaxed text-text-secondary">
                                Külső rendszer csatlakoztatása? A beépített <strong class="text-teal-700">AI segít a fejlesztésben</strong>, a dokumentáció végigvezeti a folyamaton, a csapatunk pedig támogatja az egyedi megoldásokat.
                            </p>
                        </div>

                        {{-- Footer Stats --}}
                        <div class="mt-3 flex gap-5 border-t border-border-light pt-3">
                            <span class="flex items-center gap-1.5 text-[10px] text-text-tertiary">
                                <span class="h-1.5 w-1.5 rounded-full bg-teal-500"></span> 11 modul natívan
                            </span>
                            <span class="flex items-center gap-1.5 text-[10px] text-text-tertiary">
                                <span class="h-1.5 w-1.5 rounded-full bg-violet-500"></span> REST API elérhető
                            </span>
                            <span class="flex items-center gap-1.5 text-[10px] text-text-tertiary">
                                <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span> AI + dokumentáció
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
                <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-teal-600">Kétszintű integráció</p>
                <h2 class="mb-4 text-3xl text-text-primary md:text-4xl" style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                    Belső natív kapcsolat + külső API lehetőség
                </h2>
                <p class="max-w-xl text-lg text-text-secondary">
                    A Cégem360 integráció két szinten működik: a belső modulok automatikusan, a külső rendszerek REST API-n keresztül.
                </p>
            </div>

            <div class="grid grid-cols-1 gap-6 lg:grid-cols-2" data-stagger>
                {{-- Belső integráció --}}
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-8" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <span class="mb-5 inline-flex rounded-lg bg-teal-50 px-3 py-1.5 text-[11px] font-bold uppercase tracking-wider text-teal-600">Belső integráció</span>
                    <h3 class="mb-3 text-xl font-bold text-text-primary">11 modul — natívan összekötve, nulla konfiguráció</h3>
                    <p class="mb-5 text-sm leading-relaxed text-text-secondary">
                        A CRM, értékesítés, gyártás, beszerzés, szerviz, kontrolling és az összes többi modul egyetlen rendszerben fut. Az adat egyszer kerül be — és mindenhol elérhető, valós időben.
                    </p>
                    <div class="space-y-2.5">
                        <span class="flex items-center gap-2.5 text-sm text-text-secondary"><span class="h-1 w-1 rounded-full bg-teal-500"></span>Nincs szinkronizálási hiba vagy adatvesztés</span>
                        <span class="flex items-center gap-2.5 text-sm text-text-secondary"><span class="h-1 w-1 rounded-full bg-teal-500"></span>Nincs dupla adatrögzítés</span>
                        <span class="flex items-center gap-2.5 text-sm text-text-secondary"><span class="h-1 w-1 rounded-full bg-teal-500"></span>Valós idejű adatáramlás minden modulban</span>
                        <span class="flex items-center gap-2.5 text-sm text-text-secondary"><span class="h-1 w-1 rounded-full bg-teal-500"></span>Egyetlen jogosultságkezelés az egész rendszerben</span>
                        <span class="flex items-center gap-2.5 text-sm text-text-secondary"><span class="h-1 w-1 rounded-full bg-teal-500"></span>Automatikus trigger-ek modulok között</span>
                        <span class="flex items-center gap-2.5 text-sm text-text-secondary"><span class="h-1 w-1 rounded-full bg-teal-500"></span>DataMind MI minden modul adatát elemzi</span>
                    </div>
                </div>

                {{-- Külső integráció --}}
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-8" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <span class="mb-5 inline-flex rounded-lg bg-violet-50 px-3 py-1.5 text-[11px] font-bold uppercase tracking-wider text-violet-600">Külső integráció</span>
                    <h3 class="mb-3 text-xl font-bold text-text-primary">REST API — AI segítséggel és a mi szolgáltatásunkkal</h3>
                    <p class="mb-5 text-sm leading-relaxed text-text-secondary">
                        Ha külső rendszerhez kell csatlakozni — számlázó, ERP, webshop, banki API — a Cégem360 REST API-ján keresztül minden megoldható. Nincs kész plugin: helyette dokumentáció, beépített AI fejlesztéstámogatás és az integrációs csapatunk áll rendelkezésre.
                    </p>
                    <div class="space-y-2.5">
                        <span class="flex items-center gap-2.5 text-sm text-text-secondary"><span class="h-1 w-1 rounded-full bg-violet-500"></span>REST API teljes hozzáféréssel minden modulhoz</span>
                        <span class="flex items-center gap-2.5 text-sm text-text-secondary"><span class="h-1 w-1 rounded-full bg-violet-500"></span>AI-támogatott fejlesztés és kódgenerálás</span>
                        <span class="flex items-center gap-2.5 text-sm text-text-secondary"><span class="h-1 w-1 rounded-full bg-violet-500"></span>Részletes API dokumentáció és sandbox</span>
                        <span class="flex items-center gap-2.5 text-sm text-text-secondary"><span class="h-1 w-1 rounded-full bg-violet-500"></span>Webhook-ok valós idejű eseményekre</span>
                        <span class="flex items-center gap-2.5 text-sm text-text-secondary"><span class="h-1 w-1 rounded-full bg-violet-500"></span>Integrációs szolgáltatás a csapatunktól</span>
                        <span class="flex items-center gap-2.5 text-sm text-text-secondary"><span class="h-1 w-1 rounded-full bg-violet-500"></span>Bármilyen külső rendszer csatlakoztatható</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Internal Ecosystem Section (11 modules + connection flows) --}}
    <section class="bg-surface-primary py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-6">
            <div class="reveal mb-12">
                <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-teal-600">Belső ökoszisztéma</p>
                <h2 class="mb-4 text-3xl text-text-primary md:text-4xl" style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                    11 modul, 55+ automatikus belső kapcsolat
                </h2>
                <p class="max-w-xl text-lg text-text-secondary">
                    Nem kell integrálni, ami eleve egy rendszer. A Cégem360 moduljai natívan kommunikálnak egymással.
                </p>
            </div>

            {{-- Module Grid --}}
            <div class="reveal">
                <div class="rounded-2xl border border-border-light bg-surface-primary p-6" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="grid grid-cols-2 gap-3 sm:grid-cols-3 lg:grid-cols-4" data-stagger>
                        <div class="stagger-item rounded-xl border border-border-light bg-surface-secondary p-4 text-center transition-all hover:border-teal-200">
                            <div class="mx-auto mb-2 flex h-9 w-9 items-center justify-center rounded-lg bg-emerald-50">
                                <x-module-icon module="crm" class="h-4 w-4 text-emerald-600" />
                            </div>
                            <span class="block text-xs font-bold text-text-primary">CRM</span>
                            <span class="text-[10px] text-text-tertiary">↔ 10 modul</span>
                        </div>
                        <div class="stagger-item rounded-xl border border-border-light bg-surface-secondary p-4 text-center transition-all hover:border-teal-200">
                            <div class="mx-auto mb-2 flex h-9 w-9 items-center justify-center rounded-lg bg-emerald-50">
                                <x-module-icon module="ertekesites" class="h-4 w-4 text-emerald-600" />
                            </div>
                            <span class="block text-xs font-bold text-text-primary">Értékesítés</span>
                            <span class="text-[10px] text-text-tertiary">↔ 8 modul</span>
                        </div>
                        <div class="stagger-item rounded-xl border border-border-light bg-surface-secondary p-4 text-center transition-all hover:border-teal-200">
                            <div class="mx-auto mb-2 flex h-9 w-9 items-center justify-center rounded-lg bg-cyan-50">
                                <x-module-icon module="beszerzes" class="h-4 w-4 text-cyan-600" />
                            </div>
                            <span class="block text-xs font-bold text-text-primary">Beszerzés</span>
                            <span class="text-[10px] text-text-tertiary">↔ 7 modul</span>
                        </div>
                        <div class="stagger-item rounded-xl border border-border-light bg-surface-secondary p-4 text-center transition-all hover:border-teal-200">
                            <div class="mx-auto mb-2 flex h-9 w-9 items-center justify-center rounded-lg bg-orange-50">
                                <x-module-icon module="gyartas" class="h-4 w-4 text-orange-600" />
                            </div>
                            <span class="block text-xs font-bold text-text-primary">Gyártásirányítás</span>
                            <span class="text-[10px] text-text-tertiary">↔ 8 modul</span>
                        </div>
                        <div class="stagger-item rounded-xl border border-border-light bg-surface-secondary p-4 text-center transition-all hover:border-teal-200">
                            <div class="mx-auto mb-2 flex h-9 w-9 items-center justify-center rounded-lg bg-amber-50">
                                <x-module-icon module="szerviz" class="h-4 w-4 text-amber-600" />
                            </div>
                            <span class="block text-xs font-bold text-text-primary">Munkalap</span>
                            <span class="text-[10px] text-text-tertiary">↔ 6 modul</span>
                        </div>
                        <div class="stagger-item rounded-xl border border-border-light bg-surface-secondary p-4 text-center transition-all hover:border-teal-200">
                            <div class="mx-auto mb-2 flex h-9 w-9 items-center justify-center rounded-lg bg-violet-50">
                                <x-module-icon module="kontrolling" class="h-4 w-4 text-violet-600" />
                            </div>
                            <span class="block text-xs font-bold text-text-primary">Kontrolling</span>
                            <span class="text-[10px] text-text-tertiary">↔ 10 modul</span>
                        </div>
                        <div class="stagger-item rounded-xl border border-border-light bg-surface-secondary p-4 text-center transition-all hover:border-teal-200">
                            <div class="mx-auto mb-2 flex h-9 w-9 items-center justify-center rounded-lg bg-blue-50">
                                <x-module-icon module="automatizalas" class="h-4 w-4 text-blue-600" />
                            </div>
                            <span class="block text-xs font-bold text-text-primary">Automatizálás</span>
                            <span class="text-[10px] text-text-tertiary">↔ 10 modul</span>
                        </div>
                        <div class="stagger-item rounded-xl border border-border-light bg-surface-secondary p-4 text-center transition-all hover:border-teal-200">
                            <div class="mx-auto mb-2 flex h-9 w-9 items-center justify-center rounded-lg bg-rose-50">
                                <x-module-icon module="datamind" class="h-4 w-4 text-rose-600" />
                            </div>
                            <span class="block text-xs font-bold text-text-primary">DataMind</span>
                            <span class="text-[10px] text-text-tertiary">↔ 10 modul</span>
                        </div>
                        <div class="stagger-item rounded-xl border border-border-light bg-surface-secondary p-4 text-center transition-all hover:border-teal-200">
                            <div class="mx-auto mb-2 flex h-9 w-9 items-center justify-center rounded-lg bg-sky-50">
                                <x-module-icon module="marketinghub" class="h-4 w-4 text-sky-600" />
                            </div>
                            <span class="block text-xs font-bold text-text-primary">MarketingHub</span>
                            <span class="text-[10px] text-text-tertiary">↔ 6 modul</span>
                        </div>
                        <div class="stagger-item rounded-xl border border-border-light bg-surface-secondary p-4 text-center transition-all hover:border-teal-200">
                            <div class="mx-auto mb-2 flex h-9 w-9 items-center justify-center rounded-lg bg-pink-50">
                                <x-module-icon module="seo" class="h-4 w-4 text-pink-600" />
                            </div>
                            <span class="block text-xs font-bold text-text-primary">SEO Eszköz</span>
                            <span class="text-[10px] text-text-tertiary">↔ 4 modul</span>
                        </div>
                        <div class="stagger-item rounded-xl border border-border-light bg-surface-secondary p-4 text-center transition-all hover:border-teal-200">
                            <div class="mx-auto mb-2 flex h-9 w-9 items-center justify-center rounded-lg bg-teal-50">
                                <x-module-icon module="ai-chat" class="h-4 w-4 text-teal-600" />
                            </div>
                            <span class="block text-xs font-bold text-text-primary">AI Chat</span>
                            <span class="text-[10px] text-text-tertiary">↔ 8 modul</span>
                        </div>
                    </div>

                    {{-- Description --}}
                    <div class="mt-5 rounded-xl border border-teal-100 bg-linear-to-r from-teal-50 to-emerald-50 p-5">
                        <p class="text-center text-sm leading-relaxed text-text-secondary">
                            Az adatokat <strong class="text-teal-700">nem kell szinkronizálni</strong> — mert egyetlen adatbázisban élnek. Amikor az értékesítő lezár egy ajánlatot, a gyártásirányítás azonnal látja a kapacitásigényt, a beszerzés az anyagszükségletet, a kontrolling a tervezett bevételt.
                        </p>
                    </div>
                </div>
            </div>

            {{-- Connection Flow Cards --}}
            <div class="mt-8 grid grid-cols-1 gap-5 md:grid-cols-2" data-stagger>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-6" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="mb-3 flex items-center gap-2">
                        <span class="rounded bg-teal-50 px-2 py-0.5 text-[10px] font-bold text-teal-600">Értékesítés</span>
                        <svg class="h-3.5 w-3.5 text-teal-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" /></svg>
                        <span class="rounded bg-teal-50 px-2 py-0.5 text-[10px] font-bold text-teal-600">Gyártásirányítás</span>
                    </div>
                    <p class="text-sm leading-relaxed text-text-secondary">Elfogadott ajánlatból automatikus gyártási utasítás: termék, mennyiség, határidő — emberi beavatkozás nélkül.</p>
                </div>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-6" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="mb-3 flex items-center gap-2">
                        <span class="rounded bg-teal-50 px-2 py-0.5 text-[10px] font-bold text-teal-600">Gyártásirányítás</span>
                        <svg class="h-3.5 w-3.5 text-teal-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" /></svg>
                        <span class="rounded bg-teal-50 px-2 py-0.5 text-[10px] font-bold text-teal-600">Beszerzés</span>
                    </div>
                    <p class="text-sm leading-relaxed text-text-secondary">A gyártási tervből automatikus anyagszükséglet és beszerzési igény — ha nincs készleten, rendelés indul.</p>
                </div>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-6" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="mb-3 flex items-center gap-2">
                        <span class="rounded bg-teal-50 px-2 py-0.5 text-[10px] font-bold text-teal-600">Munkalap</span>
                        <svg class="h-3.5 w-3.5 text-teal-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" /></svg>
                        <span class="rounded bg-teal-50 px-2 py-0.5 text-[10px] font-bold text-teal-600">Kontrolling</span>
                    </div>
                    <p class="text-sm leading-relaxed text-text-secondary">A szerviz-munkalapból azonnali költségelszámolás: anyag, munkaidő, kiszállási díj — valós idejű projekt P&L.</p>
                </div>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-6" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="mb-3 flex items-center gap-2">
                        <span class="rounded bg-teal-50 px-2 py-0.5 text-[10px] font-bold text-teal-600">CRM</span>
                        <svg class="h-3.5 w-3.5 text-teal-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" /></svg>
                        <span class="rounded bg-teal-50 px-2 py-0.5 text-[10px] font-bold text-teal-600">AI Chat</span>
                    </div>
                    <p class="text-sm leading-relaxed text-text-secondary">Az ügyfél az AI chatbottól kérdezi a szervizjegy státuszát — a chatbot a CRM-ből válaszol, valós időben.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- External API Section --}}
    <section class="bg-surface-secondary py-16 lg:py-24" id="kulso-integracio">
        <div class="mx-auto max-w-7xl px-6">
            <div class="reveal mb-12">
                <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-teal-600">Külső integrációk</p>
                <h2 class="mb-4 text-3xl text-text-primary md:text-4xl" style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                    REST API + AI segítség + szolgáltatás
                </h2>
                <p class="max-w-xl text-lg text-text-secondary">
                    Nincs kész plugin — de van jobb: REST API minden modulhoz, AI-támogatott fejlesztés és egy csapat, aki megoldja az egyedi igényeket.
                </p>
            </div>

            {{-- 3-Step Approach --}}
            <div class="mb-12 grid grid-cols-1 gap-5 sm:grid-cols-3" data-stagger>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-7 text-center" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="icon-hover mx-auto mb-5 flex h-14 w-14 items-center justify-center rounded-xl bg-violet-50 text-2xl">📖</div>
                    <span class="mb-2 block text-[10px] font-bold uppercase tracking-wider text-violet-600">1. lépés</span>
                    <h3 class="mb-2 text-base font-bold text-text-primary">Dokumentáció és sandbox</h3>
                    <p class="text-sm leading-relaxed text-text-secondary">Teljes REST API dokumentáció OpenAPI 3.0 szabvány szerint, sandbox környezettel. Minden végpont kipróbálható élesben is — kockázat nélkül.</p>
                </div>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-7 text-center" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="icon-hover mx-auto mb-5 flex h-14 w-14 items-center justify-center rounded-xl bg-teal-50 text-2xl">🤖</div>
                    <span class="mb-2 block text-[10px] font-bold uppercase tracking-wider text-teal-600">2. lépés</span>
                    <h3 class="mb-2 text-base font-bold text-text-primary">AI fejlesztéstámogatás</h3>
                    <p class="text-sm leading-relaxed text-text-secondary">A beépített AI ismeri az API struktúrát, generál kódpéldákat, segít a hibakeresésben és javaslatot tesz az optimális integráció-architektúrára.</p>
                </div>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-7 text-center" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="icon-hover mx-auto mb-5 flex h-14 w-14 items-center justify-center rounded-xl bg-blue-50 text-2xl">👥</div>
                    <span class="mb-2 block text-[10px] font-bold uppercase tracking-wider text-blue-600">3. lépés</span>
                    <h3 class="mb-2 text-base font-bold text-text-primary">Integrációs szolgáltatás</h3>
                    <p class="text-sm leading-relaxed text-text-secondary">Ha nincs fejlesztői kapacitás — a Cégem360 csapata megtervezi, megvalósítja és karbantartja az egyedi integrációt. Kulcsrakészen, ipari tapasztalattal.</p>
                </div>
            </div>

            {{-- API Info + Code Example --}}
            <div class="reveal grid grid-cols-1 items-start gap-8 lg:grid-cols-2">
                <div>
                    <h3 class="mb-3 text-xl font-bold text-text-primary">REST API — teljes hozzáférés mind a 11 modulhoz</h3>
                    <p class="mb-5 text-sm leading-relaxed text-text-secondary">
                        A Cégem360 API-n keresztül bármilyen külső rendszer csatlakoztatható: számlázóprogramok, ERP-k, webshop-ok, banki rendszerek, IoT szenzorok, egyedi szoftverek. Az API dokumentált, autentikált és rate-limitált.
                    </p>
                    <div class="space-y-2.5">
                        <span class="flex items-center gap-2.5 text-sm text-text-secondary"><span class="h-1 w-1 rounded-full bg-teal-500"></span>RESTful JSON API (OpenAPI 3.0 dokumentáció)</span>
                        <span class="flex items-center gap-2.5 text-sm text-text-secondary"><span class="h-1 w-1 rounded-full bg-teal-500"></span>OAuth 2.0 és API key autentikáció</span>
                        <span class="flex items-center gap-2.5 text-sm text-text-secondary"><span class="h-1 w-1 rounded-full bg-teal-500"></span>Sandbox környezet teszteléshez</span>
                        <span class="flex items-center gap-2.5 text-sm text-text-secondary"><span class="h-1 w-1 rounded-full bg-teal-500"></span>Webhook-ok valós idejű eseményekre</span>
                        <span class="flex items-center gap-2.5 text-sm text-text-secondary"><span class="h-1 w-1 rounded-full bg-teal-500"></span>Batch műveletek nagy adatmennyiséghez</span>
                        <span class="flex items-center gap-2.5 text-sm text-text-secondary"><span class="h-1 w-1 rounded-full bg-teal-500"></span>AI kódgenerálás a dokumentációból</span>
                    </div>
                </div>

                {{-- Code Example --}}
                <div class="overflow-hidden rounded-2xl border border-border-light bg-surface-primary" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="flex items-center gap-2 border-b border-border-light bg-surface-secondary px-5 py-3">
                        <span class="h-2.5 w-2.5 rounded-full bg-danger-400"></span>
                        <span class="h-2.5 w-2.5 rounded-full bg-amber-400"></span>
                        <span class="h-2.5 w-2.5 rounded-full bg-emerald-400"></span>
                        <span class="ml-2 text-[11px] font-medium text-text-tertiary">api-example.sh</span>
                    </div>
                    <pre class="overflow-x-auto p-5 text-xs leading-relaxed text-text-secondary" style="font-family: 'JetBrains Mono', monospace;"><span class="text-text-tertiary italic"># Ajánlatok lekérdezése a CRM-ből</span>
<span class="text-violet-600 font-medium">curl</span> -X GET <span class="text-amber-600">"https://api.cegem360.eu/v2/crm/offers"</span> \
  -H <span class="text-teal-600">"Authorization: Bearer &#123;token&#125;"</span> \
  -H <span class="text-teal-600">"Content-Type: application/json"</span>

<span class="text-text-tertiary italic"># Webhook: értesítés új rendeléskor</span>
<span class="text-violet-600 font-medium">curl</span> -X POST <span class="text-amber-600">"https://api.cegem360.eu/v2/webhooks"</span> \
  -d '{
    <span class="text-teal-600">"event"</span>: <span class="text-teal-600">"order.created"</span>,
    <span class="text-teal-600">"url"</span>: <span class="text-teal-600">"https://erp.ceg.hu/hook"</span>
  }'

<span class="text-text-tertiary italic"># Készletszint frissítés külső raktárból</span>
<span class="text-violet-600 font-medium">curl</span> -X PATCH <span class="text-amber-600">"https://api.cegem360.eu/v2/inventory/SKU-4821"</span> \
  -d '{ <span class="text-teal-600">"qty"</span>: <span class="text-orange-600">150</span>, <span class="text-teal-600">"loc"</span>: <span class="text-teal-600">"Raktár A"</span> }'</pre>
                </div>
            </div>
        </div>
    </section>

    {{-- Possible Connections Section (8 cards) --}}
    <section class="bg-surface-primary py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-6">
            <div class="reveal mb-12">
                <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-teal-600">Csatlakoztatható rendszerek</p>
                <h2 class="mb-4 text-3xl text-text-primary md:text-4xl" style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                    Ezekhez csatlakoztatható — API-n vagy szolgáltatásként
                </h2>
                <p class="max-w-xl text-lg text-text-secondary">
                    A REST API és az integrációs szolgáltatásunk segítségével bármilyen külső rendszer csatlakoztatható. Íme a leggyakoribb igények.
                </p>
            </div>

            <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4" data-stagger>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-6 text-center" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <span class="mb-3 block text-2xl">🧾</span>
                    <h4 class="mb-1 text-sm font-bold text-text-primary">Számlázóprogramok</h4>
                    <p class="mb-3 text-xs leading-relaxed text-text-secondary">Billingo, Számlázz.hu — számlakészítés, fizetési státusz szinkron</p>
                    <span class="inline-block rounded bg-violet-50 px-2 py-0.5 text-[10px] font-bold text-violet-600">REST API</span>
                </div>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-6 text-center" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <span class="mb-3 block text-2xl">🏛</span>
                    <h4 class="mb-1 text-sm font-bold text-text-primary">NAV Online Számla</h4>
                    <p class="mb-3 text-xs leading-relaxed text-text-secondary">Automatikus adatszolgáltatás a NAV felé — kimenő számlák bejelentése</p>
                    <span class="inline-block rounded bg-teal-50 px-2 py-0.5 text-[10px] font-bold text-teal-600">API + szolgáltatás</span>
                </div>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-6 text-center" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <span class="mb-3 block text-2xl">🏭</span>
                    <h4 class="mb-1 text-sm font-bold text-text-primary">ERP rendszerek</h4>
                    <p class="mb-3 text-xs leading-relaxed text-text-secondary">SAP, Dynamics, Odoo — törzs-adat szinkron, kiegészítő modulok</p>
                    <span class="inline-block rounded bg-teal-50 px-2 py-0.5 text-[10px] font-bold text-teal-600">API + szolgáltatás</span>
                </div>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-6 text-center" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <span class="mb-3 block text-2xl">📦</span>
                    <h4 class="mb-1 text-sm font-bold text-text-primary">Webshopok</h4>
                    <p class="mb-3 text-xs leading-relaxed text-text-secondary">WooCommerce, Shopify, Shoprenter — rendelés- és készletszinkron</p>
                    <span class="inline-block rounded bg-violet-50 px-2 py-0.5 text-[10px] font-bold text-violet-600">REST API</span>
                </div>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-6 text-center" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <span class="mb-3 block text-2xl">📧</span>
                    <h4 class="mb-1 text-sm font-bold text-text-primary">Google Workspace</h4>
                    <p class="mb-3 text-xs leading-relaxed text-text-secondary">Gmail, Calendar, Drive — e-mail, naptár és dokumentumszinkron</p>
                    <span class="inline-block rounded bg-violet-50 px-2 py-0.5 text-[10px] font-bold text-violet-600">REST API</span>
                </div>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-6 text-center" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <span class="mb-3 block text-2xl">📊</span>
                    <h4 class="mb-1 text-sm font-bold text-text-primary">Microsoft 365</h4>
                    <p class="mb-3 text-xs leading-relaxed text-text-secondary">Outlook, Teams, SharePoint — értesítések, naptár, dokumentumok</p>
                    <span class="inline-block rounded bg-violet-50 px-2 py-0.5 text-[10px] font-bold text-violet-600">REST API</span>
                </div>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-6 text-center" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <span class="mb-3 block text-2xl">💳</span>
                    <h4 class="mb-1 text-sm font-bold text-text-primary">Fizetési szolgáltatók</h4>
                    <p class="mb-3 text-xs leading-relaxed text-text-secondary">Stripe, Barion, SimplePay — online fizetés, státusz-szinkron</p>
                    <span class="inline-block rounded bg-violet-50 px-2 py-0.5 text-[10px] font-bold text-violet-600">REST API</span>
                </div>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-6 text-center" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <span class="mb-3 block text-2xl">📱</span>
                    <h4 class="mb-1 text-sm font-bold text-text-primary">Kommunikáció</h4>
                    <p class="mb-3 text-xs leading-relaxed text-text-secondary">Slack, Teams, SMS, Viber — trigger-alapú értesítések és riasztások</p>
                    <span class="inline-block rounded bg-amber-50 px-2 py-0.5 text-[10px] font-bold text-amber-600">Webhook</span>
                </div>
            </div>
        </div>
    </section>

    {{-- Stats Section --}}
    <section class="bg-surface-secondary py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-6">
            <div class="reveal mb-12 text-center">
                <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-teal-600">Számokban</p>
                <h2 class="text-3xl text-text-primary md:text-4xl" style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                    Integrációs képesség számokban
                </h2>
            </div>

            <div class="grid grid-cols-2 gap-5 lg:grid-cols-4" data-stagger data-counter-trigger>
                <div class="stagger-item stat-hover rounded-2xl border border-border-light bg-surface-primary p-8 text-center" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <span class="stat-value block text-4xl font-bold text-teal-600 lg:text-5xl" style="font-family: 'JetBrains Mono', monospace;"
                        data-count="11">0</span>
                    <span class="mt-2 block text-sm text-text-secondary">Belső modul natívan összekötve</span>
                </div>
                <div class="stagger-item stat-hover rounded-2xl border border-border-light bg-surface-primary p-8 text-center" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <span class="stat-value block text-4xl font-bold text-emerald-600 lg:text-5xl" style="font-family: 'JetBrains Mono', monospace;"
                        data-count="55" data-suffix="+">0</span>
                    <span class="mt-2 block text-sm text-text-secondary">Automatikus modulkapcsolat</span>
                </div>
                <div class="stagger-item stat-hover rounded-2xl border border-border-light bg-surface-primary p-8 text-center" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <span class="stat-value block text-4xl font-bold text-violet-600 lg:text-5xl" style="font-family: 'JetBrains Mono', monospace;"
                        data-count="REST">REST</span>
                    <span class="mt-2 block text-sm text-text-secondary">API bármilyen külső rendszerhez</span>
                </div>
                <div class="stagger-item stat-hover rounded-2xl border border-border-light bg-surface-primary p-8 text-center" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <span class="stat-value block text-4xl font-bold text-blue-600 lg:text-5xl" style="font-family: 'JetBrains Mono', monospace;"
                        data-count="AI">AI</span>
                    <span class="mt-2 block text-sm text-text-secondary">Fejlesztéstámogatás beépítve</span>
                </div>
            </div>
        </div>
    </section>

    {{-- Use Cases Section (6 cases) --}}
    <section class="bg-surface-primary py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-6">
            <div class="reveal mb-12">
                <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-teal-600">Felhasználási esetek</p>
                <h2 class="mb-4 text-3xl text-text-primary md:text-4xl" style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                    Belső automatizmus + külső csatlakozás a gyakorlatban
                </h2>
            </div>

            <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3" data-stagger>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-7" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <span class="mb-4 block text-xs font-semibold text-text-tertiary" style="font-family: 'JetBrains Mono', monospace;">01</span>
                    <h3 class="mb-2 text-base font-bold text-text-primary">Megrendelés → gyártás → kiszállítás — belső lánc</h3>
                    <p class="mb-4 text-sm leading-relaxed text-text-secondary">Az ügyfél elfogadja az ajánlatot a CRM-ben → automatikusan gyártási utasítás, anyagigény a beszerzésnek, határidő a Gantt-ban, kapacitásfoglalás — emberi beavatkozás nélkül, a belső modulkapcsolatból.</p>
                    <div class="flex flex-wrap gap-1.5">
                        <span class="rounded bg-teal-50 px-2 py-0.5 text-[10px] font-semibold text-teal-600">CRM → Gyártás → Beszerzés</span>
                    </div>
                </div>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-7" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <span class="mb-4 block text-xs font-semibold text-text-tertiary" style="font-family: 'JetBrains Mono', monospace;">02</span>
                    <h3 class="mb-2 text-base font-bold text-text-primary">Számlázóprogram csatlakoztatása REST API-n</h3>
                    <p class="mb-4 text-sm leading-relaxed text-text-secondary">A Cégem360 API-n keresztül a számlázó (pl. Billingo) automatikusan kap adatot az elfogadott rendelésekből. Az integrációt az AI dokumentáció segít felépíteni — vagy a csapatunk megvalósítja.</p>
                    <div class="flex flex-wrap gap-1.5">
                        <span class="rounded bg-violet-50 px-2 py-0.5 text-[10px] font-semibold text-violet-600">REST API</span>
                        <span class="rounded bg-violet-50 px-2 py-0.5 text-[10px] font-semibold text-violet-600">AI segítség</span>
                    </div>
                </div>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-7" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <span class="mb-4 block text-xs font-semibold text-text-tertiary" style="font-family: 'JetBrains Mono', monospace;">03</span>
                    <h3 class="mb-2 text-base font-bold text-text-primary">Szerviz-kiszállás → költségelszámolás — automatikus</h3>
                    <p class="mb-4 text-sm leading-relaxed text-text-secondary">A szerelő kitölti a munkalapot a helyszínen → az anyag, munkaidő és kiszállási díj azonnal megjelenik a kontrollingban → a projekt P&L valós időben frissül. Belső modulkapcsolat, nulla szinkron.</p>
                    <div class="flex flex-wrap gap-1.5">
                        <span class="rounded bg-teal-50 px-2 py-0.5 text-[10px] font-semibold text-teal-600">Munkalap → Kontrolling</span>
                    </div>
                </div>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-7" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <span class="mb-4 block text-xs font-semibold text-text-tertiary" style="font-family: 'JetBrains Mono', monospace;">04</span>
                    <h3 class="mb-2 text-base font-bold text-text-primary">ERP törzs-adatszinkron szolgáltatásként</h3>
                    <p class="mb-4 text-sm leading-relaxed text-text-secondary">A meglévő SAP vagy Dynamics rendszerből az ügyfél- és cikktörzs szinkronizálása a Cégem360 API-n keresztül. Az integrációs csapatunk megtervezi, megvalósítja és karbantartja.</p>
                    <div class="flex flex-wrap gap-1.5">
                        <span class="rounded bg-violet-50 px-2 py-0.5 text-[10px] font-semibold text-violet-600">REST API</span>
                        <span class="rounded bg-violet-50 px-2 py-0.5 text-[10px] font-semibold text-violet-600">Szolgáltatás</span>
                    </div>
                </div>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-7" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <span class="mb-4 block text-xs font-semibold text-text-tertiary" style="font-family: 'JetBrains Mono', monospace;">05</span>
                    <h3 class="mb-2 text-base font-bold text-text-primary">Webhook riasztás Slack-be vagy SMS-ben</h3>
                    <p class="mb-4 text-sm leading-relaxed text-text-secondary">A Cégem360 webhook-on keresztül valós idejű riasztást küld: kritikus készletszint → Slack üzenet, gépállás → SMS a műszakvezetőnek, SLA-túllépés → Teams értesítés.</p>
                    <div class="flex flex-wrap gap-1.5">
                        <span class="rounded bg-violet-50 px-2 py-0.5 text-[10px] font-semibold text-violet-600">Webhook</span>
                        <span class="rounded bg-teal-50 px-2 py-0.5 text-[10px] font-semibold text-teal-600">Automatizálás</span>
                    </div>
                </div>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-7" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <span class="mb-4 block text-xs font-semibold text-text-tertiary" style="font-family: 'JetBrains Mono', monospace;">06</span>
                    <h3 class="mb-2 text-base font-bold text-text-primary">Webshop rendelések behúzása API-n</h3>
                    <p class="mb-4 text-sm leading-relaxed text-text-secondary">A WooCommerce vagy Shopify webshopból a rendelések API-n érkeznek a CRM-be és a gyártásirányításba. A készletszint visszaírás biztosítja, hogy a webshop valós raktárkészletet mutat.</p>
                    <div class="flex flex-wrap gap-1.5">
                        <span class="rounded bg-violet-50 px-2 py-0.5 text-[10px] font-semibold text-violet-600">REST API</span>
                        <span class="rounded bg-teal-50 px-2 py-0.5 text-[10px] font-semibold text-teal-600">CRM → Gyártás</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Competitor Comparison Section (3 cards) --}}
    <section class="bg-surface-secondary py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-6">
            <div class="reveal mb-12">
                <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-teal-600">Piaci összehasonlítás</p>
                <h2 class="mb-4 text-3xl text-text-primary md:text-4xl" style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                    Integráció-megközelítések az ipari piacon
                </h2>
                <p class="max-w-xl text-lg text-text-secondary">
                    Különböző rendszerek különbözően közelítik meg az integrációt. A Cégem360 egyedülálló abban, hogy a belső integráció natívan megvan.
                </p>
            </div>

            <div class="grid grid-cols-1 gap-6 lg:grid-cols-3" data-stagger>
                {{-- Pont-megoldások --}}
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-8" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="mb-5">
                        <span class="mb-1 block text-xs font-semibold uppercase tracking-wider text-text-tertiary">Pont-megoldások halmaza</span>
                        <span class="block text-[11px] text-text-tertiary">CRM + projektkezelő + számlázó + DMS + Excel</span>
                    </div>
                    <div class="mb-5 space-y-2">
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><svg class="h-4 w-4 text-success-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>Szakterületre optimalizált eszközök</span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><svg class="h-4 w-4 text-success-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>Gyors bevezetés egyenként</span>
                    </div>
                    <div class="space-y-2 border-t border-border-light pt-5">
                        <span class="flex items-center gap-2 text-sm text-text-tertiary"><svg class="h-4 w-4 text-danger-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>Zapier, kézi szinkron, CSV export</span>
                        <span class="flex items-center gap-2 text-sm text-text-tertiary"><svg class="h-4 w-4 text-danger-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>Adatsilók: a rendszerek nem ismerik egymást</span>
                        <span class="flex items-center gap-2 text-sm text-text-tertiary"><svg class="h-4 w-4 text-danger-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>Minden integráció: külön projekt, külön költség</span>
                        <span class="flex items-center gap-2 text-sm text-text-tertiary"><svg class="h-4 w-4 text-danger-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>Nincs egységes jogosultságkezelés</span>
                    </div>
                </div>

                {{-- Nagyvállalati ERP --}}
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-8" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="mb-5">
                        <span class="mb-1 block text-xs font-semibold uppercase tracking-wider text-text-tertiary">Nagyvállalati ERP</span>
                        <span class="block text-[11px] text-text-tertiary">SAP, Oracle, Microsoft Dynamics</span>
                    </div>
                    <div class="mb-5 space-y-2">
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><svg class="h-4 w-4 text-success-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>Széleskörű modularitás</span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><svg class="h-4 w-4 text-success-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>Szabványos iparági folyamatok</span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><svg class="h-4 w-4 text-success-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>Erős pénzügyi és gyártási modulok</span>
                    </div>
                    <div class="space-y-2 border-t border-border-light pt-5">
                        <span class="flex items-center gap-2 text-sm text-text-tertiary"><svg class="h-4 w-4 text-danger-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>Bevezetés: 6–18 hónap, drága licensz</span>
                        <span class="flex items-center gap-2 text-sm text-text-tertiary"><svg class="h-4 w-4 text-danger-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>CRM, marketing, szerviz: gyakran hiányzik</span>
                        <span class="flex items-center gap-2 text-sm text-text-tertiary"><svg class="h-4 w-4 text-danger-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>MI, predikció: extra modulok, extra ár</span>
                        <span class="flex items-center gap-2 text-sm text-text-tertiary"><svg class="h-4 w-4 text-danger-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>KKV-knak túlméretezett és drága</span>
                    </div>
                </div>

                {{-- Cégem360 (highlighted) --}}
                <div class="stagger-item card-glow rounded-2xl border border-teal-200 bg-teal-50 p-8" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="mb-5">
                        <span class="mb-1 block text-xs font-semibold uppercase tracking-wider text-teal-600">Cégem360</span>
                        <span class="block text-[11px] text-text-tertiary">Integrált platform · 11 modul · REST API</span>
                    </div>
                    <div class="space-y-2">
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><svg class="h-4 w-4 text-success-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>11 modul natívan összekapcsolva — nulla integráció</span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><svg class="h-4 w-4 text-success-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>REST API + AI segítség külső rendszerekhez</span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><svg class="h-4 w-4 text-success-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>Integrációs szolgáltatás csapatunktól</span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><svg class="h-4 w-4 text-success-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>MI és predikció beépítve (DataMind)</span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><svg class="h-4 w-4 text-success-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>KKV méretezés, ipari fókusz</span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><svg class="h-4 w-4 text-success-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>ERP-kiegészítő üzemmód — nem cserélni kell</span>
                    </div>
                    <div class="mt-5 rounded-lg bg-surface-primary p-3">
                        <p class="text-xs font-semibold text-teal-700">Ajánlott: ipari KKV-knak, akik nem akarnak 5–12 rendszert integrálni — hanem egyet használni, és a meglévőket API-n összekötni.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Detailed Comparison Table (9 rows × 4 columns) --}}
    <section class="bg-surface-primary py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-6">
            <div class="reveal mb-12">
                <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-teal-600">Részletes összehasonlítás</p>
                <h2 class="mb-4 text-3xl text-text-primary md:text-4xl" style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                    Integrációs képesség-összehasonlítás
                </h2>
            </div>

            <div class="reveal overflow-x-auto">
                <table class="w-full min-w-[700px] border-collapse overflow-hidden rounded-2xl border border-border-light">
                    <thead>
                        <tr class="bg-surface-primary">
                            <th class="px-5 py-4 text-left text-xs font-bold uppercase tracking-wider text-text-primary">Képesség</th>
                            <th class="px-5 py-4 text-left text-xs font-bold uppercase tracking-wider text-text-tertiary">Pont-megoldások</th>
                            <th class="px-5 py-4 text-left text-xs font-bold uppercase tracking-wider text-text-tertiary">Nagyvállalati ERP</th>
                            <th class="px-5 py-4 text-left text-xs font-bold uppercase tracking-wider text-teal-600">Cégem360</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-border-light">
                        <tr>
                            <td class="px-5 py-4 text-sm font-semibold text-text-primary">Belső modulok integrációja</td>
                            <td class="px-5 py-4 text-sm text-text-tertiary">✗ Nincs (különálló)</td>
                            <td class="px-5 py-4 text-sm font-medium text-success-600">✓ Beépített</td>
                            <td class="px-5 py-4 text-sm font-medium text-success-600">✓ Natív, 11 modul</td>
                        </tr>
                        <tr>
                            <td class="px-5 py-4 text-sm font-semibold text-text-primary">Külső rendszerkapcsolat</td>
                            <td class="px-5 py-4 text-sm text-amber-600">◐ Zapier / CSV</td>
                            <td class="px-5 py-4 text-sm font-medium text-success-600">✓ SAP connector-ök</td>
                            <td class="px-5 py-4 text-sm font-medium text-success-600">✓ REST API + szolgáltatás</td>
                        </tr>
                        <tr>
                            <td class="px-5 py-4 text-sm font-semibold text-text-primary">AI fejlesztéstámogatás</td>
                            <td class="px-5 py-4 text-sm text-text-tertiary">✗ Nincs</td>
                            <td class="px-5 py-4 text-sm text-text-tertiary">✗ Nincs</td>
                            <td class="px-5 py-4 text-sm font-medium text-success-600">✓ Beépített AI</td>
                        </tr>
                        <tr>
                            <td class="px-5 py-4 text-sm font-semibold text-text-primary">Integrációs szolgáltatás</td>
                            <td class="px-5 py-4 text-sm text-text-tertiary">✗ Rendszerenként más</td>
                            <td class="px-5 py-4 text-sm text-amber-600">◐ Tanácsadó cég</td>
                            <td class="px-5 py-4 text-sm font-medium text-success-600">✓ Saját csapat</td>
                        </tr>
                        <tr>
                            <td class="px-5 py-4 text-sm font-semibold text-text-primary">Webhook-ok (valós idejű)</td>
                            <td class="px-5 py-4 text-sm text-text-tertiary">✗ Zapier közvetítéssel</td>
                            <td class="px-5 py-4 text-sm text-amber-600">◐ Korlátozott</td>
                            <td class="px-5 py-4 text-sm font-medium text-success-600">✓ Beépített</td>
                        </tr>
                        <tr>
                            <td class="px-5 py-4 text-sm font-semibold text-text-primary">API dokumentáció</td>
                            <td class="px-5 py-4 text-sm text-amber-600">◐ Rendszerenként</td>
                            <td class="px-5 py-4 text-sm font-medium text-success-600">✓ Komplex</td>
                            <td class="px-5 py-4 text-sm font-medium text-success-600">✓ OpenAPI 3.0 + sandbox</td>
                        </tr>
                        <tr>
                            <td class="px-5 py-4 text-sm font-semibold text-text-primary">ERP-kiegészítő üzemmód</td>
                            <td class="px-5 py-4 text-sm text-text-tertiary">✗ Nem</td>
                            <td class="px-5 py-4 text-sm text-text-tertiary">✗ Teljes csere</td>
                            <td class="px-5 py-4 text-sm font-medium text-success-600">✓ API szinkron</td>
                        </tr>
                        <tr>
                            <td class="px-5 py-4 text-sm font-semibold text-text-primary">Bevezetési idő</td>
                            <td class="px-5 py-4 text-sm text-amber-600">◐ Rendszerenként más</td>
                            <td class="px-5 py-4 text-sm text-text-tertiary">✗ 6–18 hónap</td>
                            <td class="px-5 py-4 text-sm font-medium text-success-600">✓ 2–6 hét</td>
                        </tr>
                        <tr>
                            <td class="px-5 py-4 text-sm font-semibold text-text-primary">Szinkron-hibák kockázata</td>
                            <td class="px-5 py-4 text-sm text-text-tertiary">✗ Magas (többrendszeres)</td>
                            <td class="px-5 py-4 text-sm text-amber-600">◐ Közepes</td>
                            <td class="px-5 py-4 text-sm font-medium text-success-600">✓ Belső: nulla</td>
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
                        <h3 class="mb-3 text-xl font-bold text-text-primary lg:text-2xl" style="font-family: 'Poppins', sans-serif;">Személyre szabott integrációs konzultáció</h3>
                        <p class="mb-5 text-base text-text-secondary">30 perces videóhívás, amelyben felmérjük, milyen rendszereket használ jelenleg, és hogyan csatlakoztathatja őket a Cégem360-hoz REST API-n keresztül — vagy hogyan válthatja ki a meglévőket a 11 belső modullal.</p>
                        <div class="flex flex-wrap gap-5">
                            <span class="flex items-center gap-1.5 text-sm text-text-tertiary"><svg class="h-4 w-4 text-success-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>30 perc videóhívás</span>
                            <span class="flex items-center gap-1.5 text-sm text-text-tertiary"><svg class="h-4 w-4 text-success-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>Integrációs audit</span>
                            <span class="flex items-center gap-1.5 text-sm text-text-tertiary"><svg class="h-4 w-4 text-success-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>Nincs elköteleződés</span>
                        </div>
                    </div>
                    <a href="{{ route('contact') }}" class="group inline-flex items-center gap-2 rounded-full bg-teal-600 px-6 py-3 text-base font-medium text-white transition-all hover:bg-teal-700 hover:shadow-lg" style="box-shadow: 0 1px 2px rgba(0,0,0,0.05);">
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
                <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-teal-600">Kezdje el</p>
                <h2 class="mb-4 text-3xl text-text-primary md:text-4xl" style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                    Készen áll az összekötött ipari vállalatirányításra?
                </h2>
                <p class="mx-auto max-w-xl text-lg text-text-secondary">
                    Válassza ki a következő lépést az Ön számára.
                </p>
            </div>

            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2" data-stagger>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-8 text-center" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <h3 class="mb-3 text-xl font-bold text-text-primary">Integrációs konzultáció</h3>
                    <p class="mb-6 text-sm text-text-secondary">Kérdezzen szakértőinktől 30 percben — videóhíváson, a meglévő rendszerei csatlakoztatásáról, kötelezettség nélkül.</p>
                    <a href="{{ route('contact') }}" class="inline-flex items-center gap-2 rounded-full border border-border-light bg-surface-secondary px-6 py-3 text-sm font-medium text-text-primary transition-all hover:border-teal-200 hover:shadow-md">
                        Időpont foglalása <svg class="arrow-slide h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" /></svg>
                    </a>
                </div>
                <div class="stagger-item card-glow rounded-2xl border border-teal-100 bg-teal-50 p-8 text-center" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <h3 class="mb-3 text-xl font-bold text-text-primary">Regisztráció és kipróbálás</h3>
                    <p class="mb-6 text-sm text-text-secondary">Fedezze fel a 11 natívan összekötött modult és a REST API lehetőségeit — azonnal.</p>
                    <a href="{{ route('register') }}" class="group inline-flex items-center gap-2 rounded-full bg-teal-600 px-6 py-3 text-sm font-medium text-white transition-all hover:bg-teal-700 hover:shadow-lg" style="box-shadow: 0 1px 2px rgba(0,0,0,0.05);">
                        Regisztráció <svg class="arrow-slide h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" /></svg>
                    </a>
                </div>
            </div>
        </div>
    </section>
</div>
