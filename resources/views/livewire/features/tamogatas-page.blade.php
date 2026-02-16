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
            0% { box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.4); }
            70% { box-shadow: 0 0 0 6px rgba(16, 185, 129, 0); }
            100% { box-shadow: 0 0 0 0 rgba(16, 185, 129, 0); }
        }
        .pulse-dot { animation: pulse-ring 2s ease infinite; }

        .card-glow { transition: all 0.4s cubic-bezier(0,0,0.2,1); }
        .card-glow:hover { box-shadow: 0 8px 30px -8px rgba(16, 185, 129, 0.15), 0 2px 8px rgba(0,0,0,0.04) !important; }

        .icon-hover { transition: transform 0.35s cubic-bezier(0,0,0.2,1.4); }
        .group:hover .icon-hover, .card-glow:hover .icon-hover { transform: translateY(-3px) scale(1.08); }

        .arrow-slide { transition: transform 0.3s cubic-bezier(0,0,0.2,1); }
        .group:hover .arrow-slide, a:hover .arrow-slide { transform: translateX(4px); }

        .stat-hover .stat-value { transition: transform 0.4s cubic-bezier(0,0,0.2,1.4); }
        .stat-hover:hover .stat-value { transform: scale(1.08); }

        .feature-dot { transition: transform 0.3s cubic-bezier(0,0,0.2,1); }
        .card-glow:hover .feature-dot { transform: scale(1.5); }

        .pill-float { transition: transform 0.35s cubic-bezier(0,0,0.2,1), box-shadow 0.35s cubic-bezier(0,0,0.2,1); }
        .pill-float:hover { transform: translateY(-3px); box-shadow: 0 6px 20px -4px rgba(16, 185, 129, 0.12); }

        @keyframes chat-pulse { 0%, 100% { opacity: 1; } 50% { opacity: 0.6; } }
        .chat-pulse { animation: chat-pulse 2.5s ease infinite; }

        html { scroll-behavior: smooth; }
    </style>

    {{-- Hero Section --}}
    <section class="bg-linear-to-b from-emerald-50 to-surface-secondary">
        <div class="mx-auto max-w-7xl px-6 py-16 lg:py-24">
            <div class="grid grid-cols-1 items-center gap-12 lg:grid-cols-2">
                {{-- Hero Text --}}
                <div class="reveal">
                    <div class="badge-gradient mb-8 inline-flex items-center gap-2 rounded-full border border-border-light/80 bg-surface-primary px-4 py-1.5"
                        style="box-shadow: 0 1px 3px rgba(0,0,0,0.04);">
                        <span class="pulse-dot h-1.5 w-1.5 rounded-full bg-linear-to-r from-emerald-500 via-teal-500 to-emerald-400"></span>
                        <span class="text-sm font-medium text-text-primary">Funkció — 24/7 Támogatás</span>
                    </div>

                    <h1 class="mb-6 text-4xl leading-tight tracking-tight text-text-primary md:text-5xl lg:text-[3.5rem]"
                        style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                        Éjjel az AI válaszol —<br>
                        nappal a csapatunk is ott van
                    </h1>

                    <p class="mb-10 max-w-xl text-lg text-text-secondary lg:text-xl">
                        A Cégem360 támogatás két szintű: az AI Chat éjjel-nappal válaszol a kérdéseire, a rendszer adataira építve. Munkaidőben a szakértő csapatunk veszi át a bonyolultabb ügyeket — e-mailen vagy hibabejelentő űrlapon.
                    </p>

                    <div class="flex flex-wrap items-center gap-4">
                        <a href="{{ route('hibabejelentes') }}"
                            class="group inline-flex items-center gap-2 rounded-full bg-emerald-600 px-6 py-3 text-base font-medium text-white transition-all hover:bg-emerald-700 hover:shadow-lg"
                            style="box-shadow: 0 1px 2px rgba(0,0,0,0.05);">
                            <span>Hibabejelentés</span>
                            <svg class="arrow-slide h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" /></svg>
                        </a>
                        <a href="#csatornak"
                            class="inline-flex items-center gap-2 rounded-full border border-border-light bg-surface-primary px-6 py-3 text-base font-medium text-text-primary transition-all hover:border-emerald-200 hover:bg-surface-secondary hover:shadow-md">
                            Elérhetőségeink
                        </a>
                    </div>
                </div>

                {{-- Support Visual --}}
                <div class="reveal-right">
                    <div class="rounded-2xl border border-border-light bg-surface-primary p-6"
                        style="box-shadow: 0 4px 20px -4px rgba(0,0,0,0.06);">
                        <div class="mb-4 flex items-center justify-between border-b border-border-light pb-4">
                            <div>
                                <span class="block text-sm font-bold text-text-primary">Támogatás</span>
                                <span class="block text-[10px] text-text-tertiary">AI Chat + Emberi ügyfélszolgálat</span>
                            </div>
                            <div class="flex gap-2">
                                <span class="inline-flex items-center gap-1.5 rounded-md border border-emerald-100 bg-emerald-50 px-2 py-0.5 text-[10px] font-semibold text-emerald-600">
                                    <span class="chat-pulse h-1 w-1 rounded-full bg-emerald-500"></span>
                                    AI Chat · 24/7
                                </span>
                                <span class="inline-flex items-center gap-1.5 rounded-md border border-blue-100 bg-blue-50 px-2 py-0.5 text-[10px] font-semibold text-blue-600">
                                    Csapat · H–P 8–16h
                                </span>
                            </div>
                        </div>

                        {{-- Chat Preview --}}
                        <div class="mb-4 space-y-2">
                            <div class="ml-auto max-w-[88%] rounded-lg rounded-br-sm bg-surface-secondary p-2.5 text-right">
                                <span class="mb-1 block text-[9px] font-bold text-text-tertiary">Ügyfél · 23:47</span>
                                <span class="text-[11px] text-text-primary">Nem tudok belépni a munkalap modulba, hibaüzenetet kapok: „Hozzáférés megtagadva".</span>
                            </div>
                            <div class="max-w-[88%] rounded-lg rounded-bl-sm border border-emerald-100 bg-emerald-50 p-2.5">
                                <span class="mb-1 block text-[9px] font-bold text-emerald-600">🤖 AI Chat · 23:47</span>
                                <span class="text-[11px] text-text-secondary">Megnéztem a jogosultságait. A „Munkalap" modul hozzáférése a „Szerviz technikus" szerepkörhöz van kötve, de az Ön fiókja „Értékesítő" szerepkörrel rendelkezik. Javaslat: kérje a rendszergazdától a szerepkör-bővítést.</span>
                            </div>
                            <div class="ml-auto max-w-[88%] rounded-lg rounded-br-sm bg-surface-secondary p-2.5 text-right">
                                <span class="mb-1 block text-[9px] font-bold text-text-tertiary">Ügyfél · 23:48</span>
                                <span class="text-[11px] text-text-primary">Kösz, holnap reggel jelzem. De ha nem megy, ti is tudjátok módosítani?</span>
                            </div>
                            <div class="max-w-[88%] rounded-lg rounded-bl-sm border border-blue-100 bg-blue-50 p-2.5">
                                <span class="mb-1 block text-[9px] font-bold text-blue-600">🔄 Átadás · Automatikus</span>
                                <span class="text-[11px] text-text-secondary">Igen! Ha reggel 8 után a hibabejelentő űrlapon jelzi, a csapatunk hétfő–péntek 8:00–16:00 között kezeli. Addig is rögzítettem a kérést.</span>
                            </div>
                        </div>

                        {{-- Channel Cards --}}
                        <div class="mb-3 grid grid-cols-3 gap-2">
                            <div class="rounded-lg border border-border-light bg-surface-secondary p-2.5 text-center">
                                <span class="block text-sm">🤖</span>
                                <span class="block text-[10px] font-bold text-text-primary">AI Chat</span>
                                <span class="block text-[9px] font-semibold text-emerald-600">24/7 · Azonnal</span>
                            </div>
                            <div class="rounded-lg border border-border-light bg-surface-secondary p-2.5 text-center">
                                <span class="block text-sm">📧</span>
                                <span class="block text-[10px] font-bold text-text-primary">E-mail</span>
                                <span class="block text-[9px] font-semibold text-blue-600">H–P 8–16h</span>
                            </div>
                            <div class="rounded-lg border border-border-light bg-surface-secondary p-2.5 text-center">
                                <span class="block text-sm">📋</span>
                                <span class="block text-[10px] font-bold text-text-primary">Hibabejelentés</span>
                                <span class="block text-[9px] font-semibold text-blue-600">H–P 8–16h</span>
                            </div>
                        </div>

                        {{-- Footer Stats --}}
                        <div class="mt-3 flex gap-5 border-t border-border-light pt-3">
                            <span class="flex items-center gap-1.5 text-[10px] text-text-tertiary">
                                <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span> AI Chat online
                            </span>
                            <span class="flex items-center gap-1.5 text-[10px] text-text-tertiary">
                                <span class="h-1.5 w-1.5 rounded-full bg-blue-500"></span> Emberi support: H–P 8–16
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Two Pillars Section --}}
    <section class="bg-surface-secondary py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-6">
            <div class="reveal mb-12">
                <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-emerald-600">Két szintű támogatás</p>
                <h2 class="mb-4 text-3xl text-text-primary md:text-4xl" style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                    AI Chat éjjel-nappal + Szakértő csapat munkaidőben
                </h2>
                <p class="max-w-xl text-lg text-text-secondary">
                    Az AI azonnal segít az egyszerű kérdésekben. A bonyolultabb ügyeket a csapatunk kezeli — ember embernek.
                </p>
            </div>

            <div class="grid grid-cols-1 gap-6 lg:grid-cols-2" data-stagger>
                {{-- AI Chat Pillar --}}
                <div class="stagger-item card-glow rounded-2xl border border-emerald-100 bg-emerald-50/30 p-8" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="mb-5 flex items-center gap-3">
                        <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-emerald-50 text-xl">🤖</span>
                        <div>
                            <span class="mb-0.5 inline-flex rounded-lg bg-emerald-50 px-3 py-1 text-[11px] font-bold uppercase tracking-wider text-emerald-600">AI Chat</span>
                            <span class="block text-xs font-semibold text-emerald-600">24/7 — éjjel-nappal, hétvégén is</span>
                        </div>
                    </div>
                    <h3 class="mb-2 text-lg font-bold text-text-primary">Azonnali válasz, a rendszer adataira építve</h3>
                    <p class="mb-5 text-sm text-text-secondary">Az AI Chat nem generikus chatbot — a Cégem360 rendszeradatokat ismeri. Válaszol a szervizjegy-státuszra, a jogosultsági kérdésekre, a modul-használati útmutatókra, és a gyakori hibákra. Ha nem tud válaszolni — automatikusan rögzíti a kérést a csapatnak.</p>
                    <div class="space-y-2.5">
                        <span class="flex items-center gap-2.5 text-sm text-text-secondary"><span class="h-1 w-1 rounded-full bg-emerald-500"></span>Szervizjegy-státusz, számla, garancia lekérdezés</span>
                        <span class="flex items-center gap-2.5 text-sm text-text-secondary"><span class="h-1 w-1 rounded-full bg-emerald-500"></span>Modul-használati útmutató és hibaelhárítás</span>
                        <span class="flex items-center gap-2.5 text-sm text-text-secondary"><span class="h-1 w-1 rounded-full bg-emerald-500"></span>Jogosultsági és beállítási kérdések</span>
                        <span class="flex items-center gap-2.5 text-sm text-text-secondary"><span class="h-1 w-1 rounded-full bg-emerald-500"></span>Gyakori hibák felismerése és megoldási javaslat</span>
                        <span class="flex items-center gap-2.5 text-sm text-text-secondary"><span class="h-1 w-1 rounded-full bg-emerald-500"></span>Magyar nyelven, természetes társalgással</span>
                        <span class="flex items-center gap-2.5 text-sm text-text-secondary"><span class="h-1 w-1 rounded-full bg-emerald-500"></span>Ha nem tud segíteni — automatikus ticket a csapatnak</span>
                    </div>
                </div>

                {{-- Human Support Pillar --}}
                <div class="stagger-item card-glow rounded-2xl border border-blue-100 bg-blue-50/30 p-8" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="mb-5 flex items-center gap-3">
                        <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-blue-50 text-xl">👨‍💻</span>
                        <div>
                            <span class="mb-0.5 inline-flex rounded-lg bg-blue-50 px-3 py-1 text-[11px] font-bold uppercase tracking-wider text-blue-600">Emberi ügyfélszolgálat</span>
                            <span class="block text-xs font-semibold text-blue-600">Hétfő – Péntek · 8:00 – 16:00</span>
                        </div>
                    </div>
                    <h3 class="mb-2 text-lg font-bold text-text-primary">Szakértő csapat a komplex ügyekre</h3>
                    <p class="mb-5 text-sm text-text-secondary">A Cégem360 fejlesztő- és support-csapata kezeli a bonyolultabb technikai problémákat, konfigurációs kérdéseket, hibabejelentéseket és egyedi igényeket. Elérhető e-mailen és a hibabejelentő űrlapon.</p>
                    <div class="space-y-2.5">
                        <span class="flex items-center gap-2.5 text-sm text-text-secondary"><span class="h-1 w-1 rounded-full bg-blue-500"></span>Technikai hibaelhárítás és bugfix</span>
                        <span class="flex items-center gap-2.5 text-sm text-text-secondary"><span class="h-1 w-1 rounded-full bg-blue-500"></span>Konfigurációs és beállítási segítség</span>
                        <span class="flex items-center gap-2.5 text-sm text-text-secondary"><span class="h-1 w-1 rounded-full bg-blue-500"></span>Jogosultság-kezelés és felhasználó-adminisztráció</span>
                        <span class="flex items-center gap-2.5 text-sm text-text-secondary"><span class="h-1 w-1 rounded-full bg-blue-500"></span>Egyedi fejlesztési igények egyeztetése</span>
                        <span class="flex items-center gap-2.5 text-sm text-text-secondary"><span class="h-1 w-1 rounded-full bg-blue-500"></span>E-mail: support@cegem360.eu</span>
                        <span class="flex items-center gap-2.5 text-sm text-text-secondary"><span class="h-1 w-1 rounded-full bg-blue-500"></span>Hibabejelentő űrlap: prioritás és képernyőkép csatolás</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- How It Works Section (5 steps) --}}
    <section class="bg-surface-primary py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-6">
            <div class="reveal mb-12">
                <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-emerald-600">Hogyan működik?</p>
                <h2 class="mb-4 text-3xl text-text-primary md:text-4xl" style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                    A kérdéstől a megoldásig — lépésről lépésre
                </h2>
                <p class="max-w-xl text-lg text-text-secondary">
                    A támogatási folyamat automatikusan a leggyorsabb útvonalon halad a megoldásig.
                </p>
            </div>

            <div class="reveal">
                <div class="rounded-2xl border border-border-light bg-surface-primary p-6 lg:p-8" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    {{-- Steps --}}
                    <div class="mb-6 grid grid-cols-2 gap-4 sm:grid-cols-3 lg:grid-cols-5" data-stagger>
                        <div class="stagger-item rounded-xl border border-border-light bg-surface-secondary p-5 text-center">
                            <span class="mb-2 block text-xs font-bold text-emerald-600" style="font-family: 'JetBrains Mono', monospace;">01</span>
                            <span class="mb-2 block text-xl">💬</span>
                            <span class="block text-xs font-bold text-text-primary">Kérdés érkezik</span>
                            <span class="text-[10px] text-text-tertiary">AI Chat-en, e-mailen vagy űrlapon</span>
                        </div>
                        <div class="stagger-item rounded-xl border border-border-light bg-surface-secondary p-5 text-center">
                            <span class="mb-2 block text-xs font-bold text-emerald-600" style="font-family: 'JetBrains Mono', monospace;">02</span>
                            <span class="mb-2 block text-xl">🤖</span>
                            <span class="block text-xs font-bold text-text-primary">AI Chat válaszol</span>
                            <span class="text-[10px] text-text-tertiary">Azonnali válasz, 24/7</span>
                        </div>
                        <div class="stagger-item rounded-xl border border-border-light bg-surface-secondary p-5 text-center">
                            <span class="mb-2 block text-xs font-bold text-violet-600" style="font-family: 'JetBrains Mono', monospace;">03</span>
                            <span class="mb-2 block text-xl">❓</span>
                            <span class="block text-xs font-bold text-text-primary">Megoldva?</span>
                            <span class="text-[10px] text-text-tertiary">Ha nem — automatikus ticket</span>
                        </div>
                        <div class="stagger-item rounded-xl border border-border-light bg-surface-secondary p-5 text-center">
                            <span class="mb-2 block text-xs font-bold text-blue-600" style="font-family: 'JetBrains Mono', monospace;">04</span>
                            <span class="mb-2 block text-xl">👨‍💻</span>
                            <span class="block text-xs font-bold text-text-primary">Csapat átveszi</span>
                            <span class="text-[10px] text-text-tertiary">H–P 8–16h, kontextussal</span>
                        </div>
                        <div class="stagger-item rounded-xl border border-border-light bg-surface-secondary p-5 text-center">
                            <span class="mb-2 block text-xs font-bold text-amber-600" style="font-family: 'JetBrains Mono', monospace;">05</span>
                            <span class="mb-2 block text-xl">✅</span>
                            <span class="block text-xs font-bold text-text-primary">Megoldás</span>
                            <span class="text-[10px] text-text-tertiary">Értesítés, visszajelzés</span>
                        </div>
                    </div>

                    {{-- Note --}}
                    <div class="rounded-xl border border-emerald-100 bg-emerald-50/50 p-4">
                        <p class="flex items-start gap-2.5 text-sm text-text-secondary">
                            <span class="mt-0.5 flex-shrink-0">💡</span>
                            Fontos: amikor az emberi csapat átveszi a jegyet, látja az AI Chat teljes előzményét — így nem kell az ügyfélnek újra elmondania a problémát. Az AI kontextusa automatikusan átadódik.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Contact Channels Section (3 cards) --}}
    <section class="bg-surface-secondary py-16 lg:py-24" id="csatornak">
        <div class="mx-auto max-w-7xl px-6">
            <div class="reveal mb-12">
                <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-emerald-600">Elérhetőségek</p>
                <h2 class="mb-4 text-3xl text-text-primary md:text-4xl" style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                    Három csatorna — válassza, amelyik kényelmes
                </h2>
            </div>

            <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3" data-stagger>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-8 text-center" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="icon-hover mb-4 text-3xl">🤖</div>
                    <h3 class="mb-2 text-lg font-bold text-text-primary">AI Chat</h3>
                    <span class="mb-4 block text-sm font-semibold text-emerald-600">24/7 · Éjjel-nappal</span>
                    <p class="mb-5 text-sm text-text-secondary">Kérdezzen bármit a rendszerről — azonnali válasz, a Cégem360 adataira építve. Elérhető a rendszerben és az ügyfélportálon.</p>
                    <span class="inline-flex items-center gap-2 rounded-lg border border-border-light bg-surface-secondary px-4 py-2.5 text-sm font-semibold text-text-primary">
                        A rendszeren belül, jobb alsó sarok
                    </span>
                </div>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-8 text-center" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="icon-hover mb-4 text-3xl">📧</div>
                    <h3 class="mb-2 text-lg font-bold text-text-primary">E-mail</h3>
                    <span class="mb-4 block text-sm font-semibold text-blue-600">Hétfő – Péntek · 8:00 – 16:00</span>
                    <p class="mb-5 text-sm text-text-secondary">Írjon a support csapatunknak — részletes leírás, képernyőkép csatolása lehetséges. Válaszidő: 4 órán belül.</p>
                    <span class="inline-flex items-center gap-2 rounded-lg border border-border-light bg-surface-secondary px-4 py-2.5 text-sm font-semibold text-text-primary" style="font-family: 'JetBrains Mono', monospace;">
                        support@cegem360.eu
                    </span>
                </div>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-8 text-center" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="icon-hover mb-4 text-3xl">📋</div>
                    <h3 class="mb-2 text-lg font-bold text-text-primary">Hibabejelentő űrlap</h3>
                    <span class="mb-4 block text-sm font-semibold text-blue-600">Hétfő – Péntek · 8:00 – 16:00</span>
                    <p class="mb-5 text-sm text-text-secondary">Strukturált hibabejelentés: modul, prioritás, lépések, képernyőkép. A leggyorsabb út a csapathoz komplex problémáknál.</p>
                    <a href="{{ route('hibabejelentes') }}" class="inline-flex items-center gap-2 rounded-lg border border-emerald-200 bg-emerald-50 px-4 py-2.5 text-sm font-semibold text-emerald-600 transition-all hover:bg-emerald-100">
                        Hibabejelentő megnyitása <svg class="arrow-slide h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" /></svg>
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{-- AI Chat Capabilities Section (6 cards) --}}
    <section class="bg-surface-primary py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-6">
            <div class="reveal mb-12">
                <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-emerald-600">AI Chat képességek</p>
                <h2 class="mb-4 text-3xl text-text-primary md:text-4xl" style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                    Nem generikus chatbot — a rendszert ismeri
                </h2>
                <p class="max-w-xl text-lg text-text-secondary">
                    Az AI Chat a Cégem360 rendszeradatokra és modulokra épül. Nem „hallucináción" alapul — validált adatokból válaszol.
                </p>
            </div>

            <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3" data-stagger>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-7" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="icon-hover mb-5 flex h-12 w-12 items-center justify-center rounded-xl bg-emerald-50 text-xl">🔍</div>
                    <h3 class="mb-2 text-base font-bold text-text-primary">Státusz-lekérdezés</h3>
                    <p class="text-sm leading-relaxed text-text-secondary">Szervizjegy státusz, megrendelés állapota, számla fizetési helyzete, garancia-lejárat — az ügyfél vagy a munkatárs valós idejű adatot kap a rendszerből.</p>
                </div>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-7" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="icon-hover mb-5 flex h-12 w-12 items-center justify-center rounded-xl bg-violet-50 text-xl">📖</div>
                    <h3 class="mb-2 text-base font-bold text-text-primary">Használati útmutató</h3>
                    <p class="text-sm leading-relaxed text-text-secondary">„Hogyan hozok létre új ajánlatot?" — az AI Chat lépésről lépésre végigvezeti a felhasználót, az aktuális felület alapján, képernyőkép-hivatkozásokkal.</p>
                </div>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-7" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="icon-hover mb-5 flex h-12 w-12 items-center justify-center rounded-xl bg-cyan-50 text-xl">🔧</div>
                    <h3 class="mb-2 text-base font-bold text-text-primary">Hibaelhárítás</h3>
                    <p class="text-sm leading-relaxed text-text-secondary">Gyakori hibák felismerése: „Hozzáférés megtagadva" — jogosultsági javaslat. „Nem jelenik meg a modul" — beállítási útmutató. „Lassú a rendszer" — böngésző-tippek.</p>
                </div>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-7" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="icon-hover mb-5 flex h-12 w-12 items-center justify-center rounded-xl bg-amber-50 text-xl">🫳</div>
                    <h3 class="mb-2 text-base font-bold text-text-primary">Automatikus ticket-nyitás</h3>
                    <p class="text-sm leading-relaxed text-text-secondary">Ha az AI nem tud megoldani egy problémát — automatikusan support-ticketet nyit a csapatnak, a teljes beszélgetés-kontextussal, az ügyfélnek nem kell újra leírnia.</p>
                </div>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-7" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="icon-hover mb-5 flex h-12 w-12 items-center justify-center rounded-xl bg-blue-50 text-xl">🔄</div>
                    <h3 class="mb-2 text-base font-bold text-text-primary">Live handoff</h3>
                    <p class="text-sm leading-relaxed text-text-secondary">Munkaidőben az AI átadhatja a beszélgetést élő operátornak — a kolléga látja az előzményeket, és pontosan ott folytatja, ahol az AI abbahagyta.</p>
                </div>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-7" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="icon-hover mb-5 flex h-12 w-12 items-center justify-center rounded-xl bg-rose-50 text-xl">🇭🇺</div>
                    <h3 class="mb-2 text-base font-bold text-text-primary">Magyar nyelv</h3>
                    <p class="text-sm leading-relaxed text-text-secondary">Természetes magyar nyelven kommunikál, érti az iparági szakkifejezéseket, a modulneveket és a magyar üzleti terminológiát — nem kell angolul kérdezni.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- AI Chat Examples Section (4 cards) --}}
    <section class="bg-surface-secondary py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-6">
            <div class="reveal mb-12">
                <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-emerald-600">Példa párbeszédek</p>
                <h2 class="mb-4 text-3xl text-text-primary md:text-4xl" style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                    Ilyen kérdésekre válaszol az AI Chat — azonnal
                </h2>
            </div>

            <div class="grid grid-cols-1 gap-4 md:grid-cols-2" data-stagger>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-6" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <p class="mb-3 flex items-center gap-2 text-sm font-semibold text-emerald-600">
                        <span class="text-xs">🤔</span> Mi a státusza az SZ-2026-0142 szervizjegyemnek?
                    </p>
                    <div class="rounded-lg border border-emerald-100 bg-emerald-50/50 p-3">
                        <span class="mb-1 block text-[10px] font-bold text-emerald-600">🤖 AI Chat</span>
                        <p class="text-xs leading-relaxed text-text-secondary">Az SZ-2026-0142 jegy státusza: „Technikus kiküldve". Novák Péter a helyszínre érkezik ma 14:00-kor. Az alkatrész (kompresszor szelep) raktáron van. Várható lezárás: ma 17:00.</p>
                        <span class="mt-2 block text-[10px] text-text-tertiary">Forrás: CRM + Munkalap · válaszidő: 1,2 mp</span>
                    </div>
                </div>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-6" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <p class="mb-3 flex items-center gap-2 text-sm font-semibold text-emerald-600">
                        <span class="text-xs">🤔</span> Hogyan hozhatok létre új ajánlatot a CRM-ben?
                    </p>
                    <div class="rounded-lg border border-emerald-100 bg-emerald-50/50 p-3">
                        <span class="mb-1 block text-[10px] font-bold text-emerald-600">🤖 AI Chat</span>
                        <p class="text-xs leading-relaxed text-text-secondary">Új ajánlat létrehozásához: 1) Nyissa meg a CRM modult → 2) Kattintson az „Új ajánlat" gombra → 3) Válassza ki az ügyfelet → 4) Adja meg a tételeket → 5) Kattintson a „Mentés" gombra. Az ajánlat automatikusan PDF-be is exportálható.</p>
                        <span class="mt-2 block text-[10px] text-text-tertiary">Forrás: Használati útmutató · válaszidő: 0,8 mp</span>
                    </div>
                </div>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-6" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <p class="mb-3 flex items-center gap-2 text-sm font-semibold text-emerald-600">
                        <span class="text-xs">🤔</span> Nem tudok belépni — „Hozzáférés megtagadva" hibaüzenetet kapok.
                    </p>
                    <div class="rounded-lg border border-emerald-100 bg-emerald-50/50 p-3">
                        <span class="mb-1 block text-[10px] font-bold text-emerald-600">🤖 AI Chat</span>
                        <p class="text-xs leading-relaxed text-text-secondary">Megnéztem a fiókját. A „Munkalap" modul hozzáférése a „Szerviz technikus" szerepkörhöz van kötve, de az Ön fiókja „Értékesítő" szerepkörrel rendelkezik. Kérje meg a rendszergazdát a szerepkör-bővítésre, vagy írjon a support@cegem360.eu címre.</p>
                        <span class="mt-2 block text-[10px] text-text-tertiary">Forrás: Jogosultság-rendszer · válaszidő: 1,5 mp</span>
                    </div>
                </div>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-6" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <p class="mb-3 flex items-center gap-2 text-sm font-semibold text-emerald-600">
                        <span class="text-xs">🤔</span> Mikor jár le a garanciám a 2024-es karbantartási szerződésre?
                    </p>
                    <div class="rounded-lg border border-emerald-100 bg-emerald-50/50 p-3">
                        <span class="mb-1 block text-[10px] font-bold text-emerald-600">🤖 AI Chat</span>
                        <p class="text-xs leading-relaxed text-text-secondary">A KARB-2024-0087 karbantartási szerződés garanciája 2026. április 15-én jár le. Ez 62 nap múlva. Javaslatom: lépjen kapcsolatba az értékesítőjével a megújítás érdekében, vagy használja az automatikus megújítási igény gombot.</p>
                        <span class="mt-2 block text-[10px] text-text-tertiary">Forrás: CRM + Értékesítés · válaszidő: 1,1 mp</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- SLA Section (2 cards) --}}
    <section class="bg-surface-primary py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-6">
            <div class="reveal mb-12">
                <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-emerald-600">Válaszidők</p>
                <h2 class="mb-4 text-3xl text-text-primary md:text-4xl" style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                    Mire számíthat — csatornánként
                </h2>
            </div>

            <div class="grid grid-cols-1 gap-5 lg:grid-cols-2" data-stagger>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-7" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <h3 class="mb-5 flex items-center gap-2 text-base font-bold text-text-primary">🤖 AI Chat válaszidők</h3>
                    <div class="space-y-2">
                        <div class="flex items-center justify-between rounded-lg bg-surface-secondary px-4 py-3">
                            <span class="text-sm text-text-secondary">Státusz-lekérdezés (szervizjegy, számla)</span>
                            <span class="text-sm font-bold text-emerald-600" style="font-family: 'JetBrains Mono', monospace;">&lt; 2 mp</span>
                        </div>
                        <div class="flex items-center justify-between rounded-lg bg-surface-secondary px-4 py-3">
                            <span class="text-sm text-text-secondary">Használati útmutató</span>
                            <span class="text-sm font-bold text-emerald-600" style="font-family: 'JetBrains Mono', monospace;">&lt; 3 mp</span>
                        </div>
                        <div class="flex items-center justify-between rounded-lg bg-surface-secondary px-4 py-3">
                            <span class="text-sm text-text-secondary">Hibaelhárítási javaslat</span>
                            <span class="text-sm font-bold text-emerald-600" style="font-family: 'JetBrains Mono', monospace;">&lt; 5 mp</span>
                        </div>
                        <div class="flex items-center justify-between rounded-lg bg-surface-secondary px-4 py-3">
                            <span class="text-sm text-text-secondary">Automatikus ticket, ha nem tud segíteni</span>
                            <span class="text-sm font-bold text-emerald-600" style="font-family: 'JetBrains Mono', monospace;">Azonnali</span>
                        </div>
                        <div class="flex items-center justify-between rounded-lg bg-surface-secondary px-4 py-3">
                            <span class="text-sm text-text-secondary">Elérhetőség</span>
                            <span class="text-sm font-bold text-emerald-600" style="font-family: 'JetBrains Mono', monospace;">24/7</span>
                        </div>
                    </div>
                </div>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-7" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <h3 class="mb-5 flex items-center gap-2 text-base font-bold text-text-primary">👨‍💻 Emberi support válaszidők</h3>
                    <div class="space-y-2">
                        <div class="flex items-center justify-between rounded-lg bg-surface-secondary px-4 py-3">
                            <span class="text-sm text-text-secondary">Kritikus hiba (rendszer nem elérhető)</span>
                            <span class="text-sm font-bold text-emerald-600" style="font-family: 'JetBrains Mono', monospace;">&lt; 1 óra</span>
                        </div>
                        <div class="flex items-center justify-between rounded-lg bg-surface-secondary px-4 py-3">
                            <span class="text-sm text-text-secondary">Magas prioritás (funkció nem működik)</span>
                            <span class="text-sm font-bold text-amber-600" style="font-family: 'JetBrains Mono', monospace;">&lt; 4 óra</span>
                        </div>
                        <div class="flex items-center justify-between rounded-lg bg-surface-secondary px-4 py-3">
                            <span class="text-sm text-text-secondary">Normál (konfigurációs kérdés, kérés)</span>
                            <span class="text-sm font-bold text-blue-600" style="font-family: 'JetBrains Mono', monospace;">&lt; 8 óra</span>
                        </div>
                        <div class="flex items-center justify-between rounded-lg bg-surface-secondary px-4 py-3">
                            <span class="text-sm text-text-secondary">Alacsony (fejlesztési javaslat, kívánság)</span>
                            <span class="text-sm font-bold text-blue-600" style="font-family: 'JetBrains Mono', monospace;">&lt; 24 óra</span>
                        </div>
                        <div class="flex items-center justify-between rounded-lg bg-surface-secondary px-4 py-3">
                            <span class="text-sm text-text-secondary">Elérhetőség</span>
                            <span class="text-sm font-bold text-blue-600" style="font-family: 'JetBrains Mono', monospace;">H–P 8–16h</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Stats Section --}}
    <section class="bg-surface-secondary py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-6">
            <div class="reveal mb-12 text-center">
                <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-emerald-600">Eredmények</p>
                <h2 class="text-3xl text-text-primary md:text-4xl" style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                    Mérhető támogatási teljesítmény
                </h2>
            </div>

            <div class="grid grid-cols-2 gap-5 lg:grid-cols-4" data-stagger data-counter-trigger>
                <div class="stagger-item stat-hover rounded-2xl border border-border-light bg-surface-primary p-8 text-center" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <span class="stat-value block text-4xl font-bold text-emerald-600 lg:text-5xl" style="font-family: 'JetBrains Mono', monospace;"
                        data-count="24/7">0</span>
                    <span class="mt-2 block text-sm text-text-secondary">AI Chat elérhetőség</span>
                </div>
                <div class="stagger-item stat-hover rounded-2xl border border-border-light bg-surface-primary p-8 text-center" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <span class="stat-value block text-4xl font-bold text-blue-600 lg:text-5xl" style="font-family: 'JetBrains Mono', monospace;"
                        data-count="2" data-prefix="<" data-suffix="s">0</span>
                    <span class="mt-2 block text-sm text-text-secondary">AI válaszidő</span>
                </div>
                <div class="stagger-item stat-hover rounded-2xl border border-border-light bg-surface-primary p-8 text-center" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <span class="stat-value block text-4xl font-bold text-violet-600 lg:text-5xl" style="font-family: 'JetBrains Mono', monospace;"
                        data-count="85" data-suffix="%">0</span>
                    <span class="mt-2 block text-sm text-text-secondary">AI által megoldott kérdés</span>
                </div>
                <div class="stagger-item stat-hover rounded-2xl border border-border-light bg-surface-primary p-8 text-center" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <span class="stat-value block text-4xl font-bold text-amber-600 lg:text-5xl" style="font-family: 'JetBrains Mono', monospace;"
                        data-count="4" data-prefix="<" data-suffix="h">0</span>
                    <span class="mt-2 block text-sm text-text-secondary">Emberi válaszidő (átlag)</span>
                </div>
            </div>
        </div>
    </section>

    {{-- Use Cases Section (6 cases) --}}
    <section class="bg-surface-primary py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-6">
            <div class="reveal mb-12">
                <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-emerald-600">Felhasználási esetek</p>
                <h2 class="mb-4 text-3xl text-text-primary md:text-4xl" style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                    Így működik a támogatás a gyakorlatban
                </h2>
            </div>

            <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3" data-stagger>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-7" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <span class="mb-4 block text-xs font-semibold text-text-tertiary" style="font-family: 'JetBrains Mono', monospace;">01</span>
                    <h3 class="mb-2 text-base font-bold text-text-primary">Éjszakai szervizjegy-ellenőrzés</h3>
                    <p class="mb-4 text-sm leading-relaxed text-text-secondary">Az ügyfél este 23-kor szeretné tudni, hogy a szerviz-technikus holnap jön-e. Az AI Chat azonnal válaszol: technikus neve, érkezési idő, szükséges alkatrész státusza — élő operátor nélkül.</p>
                    <div class="flex flex-wrap gap-1.5">
                        <span class="rounded bg-emerald-50 px-2 py-0.5 text-[10px] font-semibold text-emerald-600">AI Chat · 24/7</span>
                    </div>
                </div>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-7" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <span class="mb-4 block text-xs font-semibold text-text-tertiary" style="font-family: 'JetBrains Mono', monospace;">02</span>
                    <h3 class="mb-2 text-base font-bold text-text-primary">Jogosultsági probléma megoldása</h3>
                    <p class="mb-4 text-sm leading-relaxed text-text-secondary">Egy kolléga nem lát egy modult. Az AI Chat felismeri a jogosultsági problémát és javaslatot tesz. Ha az ügyfél nem tudja maga megoldani — automatikusan ticket nyílik, a csapat reggel átveszi.</p>
                    <div class="flex flex-wrap gap-1.5">
                        <span class="rounded bg-emerald-50 px-2 py-0.5 text-[10px] font-semibold text-emerald-600">AI Chat</span>
                        <span class="rounded bg-blue-50 px-2 py-0.5 text-[10px] font-semibold text-blue-600">Csapat · 8–16h</span>
                    </div>
                </div>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-7" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <span class="mb-4 block text-xs font-semibold text-text-tertiary" style="font-family: 'JetBrains Mono', monospace;">03</span>
                    <h3 class="mb-2 text-base font-bold text-text-primary">Komplex technikai hibabejelentés</h3>
                    <p class="mb-4 text-sm leading-relaxed text-text-secondary">A rendszergazda egy ismétlődő hibát tapasztal a gyártásirányítás modulban. A hibabejelentő űrlapon jelzi: modul, lépések, képernyőkép. A csapat 4 órán belül elkezdi a vizsgálatot.</p>
                    <div class="flex flex-wrap gap-1.5">
                        <span class="rounded bg-violet-50 px-2 py-0.5 text-[10px] font-semibold text-violet-600">Hibabejelentő űrlap</span>
                        <span class="rounded bg-blue-50 px-2 py-0.5 text-[10px] font-semibold text-blue-600">Csapat · 8–16h</span>
                    </div>
                </div>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-7" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <span class="mb-4 block text-xs font-semibold text-text-tertiary" style="font-family: 'JetBrains Mono', monospace;">04</span>
                    <h3 class="mb-2 text-base font-bold text-text-primary">Új felhasználó betanítás AI segítséggel</h3>
                    <p class="mb-4 text-sm leading-relaxed text-text-secondary">Az új kolléga lépésről lépésre kérdezi az AI Chat-et: „Hogyan hozok létre munkalapot?", „Hogyan csatolok fotót?" — az AI végigvezeti, 24/7, annyiszor, ahányszor szükséges.</p>
                    <div class="flex flex-wrap gap-1.5">
                        <span class="rounded bg-emerald-50 px-2 py-0.5 text-[10px] font-semibold text-emerald-600">AI Chat · 24/7</span>
                    </div>
                </div>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-7" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <span class="mb-4 block text-xs font-semibold text-text-tertiary" style="font-family: 'JetBrains Mono', monospace;">05</span>
                    <h3 class="mb-2 text-base font-bold text-text-primary">E-mail kérdés konfigurációs segítségre</h3>
                    <p class="mb-4 text-sm leading-relaxed text-text-secondary">A szervizmenedzser e-mailt ír a support@cegem360.eu-ra: szeretne egy új automatizációs szabályt beállítani. A csapat válaszol a részletekkel és segít a konfigurálásban.</p>
                    <div class="flex flex-wrap gap-1.5">
                        <span class="rounded bg-blue-50 px-2 py-0.5 text-[10px] font-semibold text-blue-600">E-mail · 8–16h</span>
                    </div>
                </div>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-7" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <span class="mb-4 block text-xs font-semibold text-text-tertiary" style="font-family: 'JetBrains Mono', monospace;">06</span>
                    <h3 class="mb-2 text-base font-bold text-text-primary">Hétvégi garancia-lekérdezés</h3>
                    <p class="mb-4 text-sm leading-relaxed text-text-secondary">Az ügyfél szombat délelőtt szeretné tudni, mikor jár le a garanciája. Az AI Chat azonnal válaszol a pontos dátummal, és javasol megújítási lehetőséget — emberi beavatkozás nélkül.</p>
                    <div class="flex flex-wrap gap-1.5">
                        <span class="rounded bg-emerald-50 px-2 py-0.5 text-[10px] font-semibold text-emerald-600">AI Chat · 24/7</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Competitor Comparison Section (3 cards) --}}
    <section class="bg-surface-secondary py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-6">
            <div class="reveal mb-12">
                <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-emerald-600">Piaci összehasonlítás</p>
                <h2 class="mb-4 text-3xl text-text-primary md:text-4xl" style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                    Támogatási megközelítések az ipari szoftver-piacon
                </h2>
            </div>

            <div class="grid grid-cols-1 gap-6 lg:grid-cols-3" data-stagger>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-8" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="mb-5">
                        <span class="mb-1 block text-xs font-semibold uppercase tracking-wider text-text-tertiary">Hagyományos helpdesk</span>
                        <span class="block text-[11px] text-text-tertiary">E-mail, telefon, ticket-rendszer</span>
                    </div>
                    <div class="mb-5 space-y-2">
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><svg class="h-4 w-4 text-success-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>Emberi kontakt, empátia</span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><svg class="h-4 w-4 text-success-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>Komplex problémák kezelése</span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><svg class="h-4 w-4 text-success-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>Megszokott folyamat</span>
                    </div>
                    <div class="space-y-2 border-t border-border-light pt-5">
                        <span class="flex items-center gap-2 text-sm text-text-tertiary"><svg class="h-4 w-4 text-danger-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>Csak munkaidőben elérhető</span>
                        <span class="flex items-center gap-2 text-sm text-text-tertiary"><svg class="h-4 w-4 text-danger-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>Lassú válaszidő (24–48 óra)</span>
                        <span class="flex items-center gap-2 text-sm text-text-tertiary"><svg class="h-4 w-4 text-danger-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>Nem ismeri automatikusan a kontextust</span>
                        <span class="flex items-center gap-2 text-sm text-text-tertiary"><svg class="h-4 w-4 text-danger-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>Skálázási probléma: több ügyfél = több munkatárs</span>
                    </div>
                </div>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-8" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="mb-5">
                        <span class="mb-1 block text-xs font-semibold uppercase tracking-wider text-text-tertiary">Generikus chatbotok</span>
                        <span class="block text-[11px] text-text-tertiary">Drift, Intercom, Zendesk Bot</span>
                    </div>
                    <div class="mb-5 space-y-2">
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><svg class="h-4 w-4 text-success-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>24/7 elérhetőség</span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><svg class="h-4 w-4 text-success-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>Gyors válasz egyszerű kérdésekre</span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><svg class="h-4 w-4 text-success-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>Több nyelv támogatása</span>
                    </div>
                    <div class="space-y-2 border-t border-border-light pt-5">
                        <span class="flex items-center gap-2 text-sm text-text-tertiary"><svg class="h-4 w-4 text-danger-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>Nem ismeri a rendszer adatait</span>
                        <span class="flex items-center gap-2 text-sm text-text-tertiary"><svg class="h-4 w-4 text-danger-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>FAQ-alapú — nem érti a kontextust</span>
                        <span class="flex items-center gap-2 text-sm text-text-tertiary"><svg class="h-4 w-4 text-danger-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>Frusztráló, ha nem tud segíteni</span>
                        <span class="flex items-center gap-2 text-sm text-text-tertiary"><svg class="h-4 w-4 text-danger-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>Külön integrálni kell a rendszerrel</span>
                    </div>
                </div>
                <div class="stagger-item card-glow rounded-2xl border border-emerald-200 bg-emerald-50 p-8" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="mb-5">
                        <span class="mb-1 block text-xs font-semibold uppercase tracking-wider text-emerald-600">Cégem360 Támogatás</span>
                        <span class="block text-[11px] text-text-tertiary">AI Chat 24/7 + Emberi csapat 8–16h</span>
                    </div>
                    <div class="space-y-2">
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><svg class="h-4 w-4 text-success-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>AI Chat 24/7: a rendszer adataira épít</span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><svg class="h-4 w-4 text-success-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>Emberi csapat munkaidőben</span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><svg class="h-4 w-4 text-success-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>Automatikus ticket + kontextus-átadás</span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><svg class="h-4 w-4 text-success-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>Magyar nyelv, ipari terminológia</span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><svg class="h-4 w-4 text-success-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>Nem kell integrálni — beépített</span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><svg class="h-4 w-4 text-success-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>Hibabejelentő űrlap strukturált jelzésre</span>
                    </div>
                    <div class="mt-5 rounded-lg bg-surface-primary p-3">
                        <p class="text-xs font-semibold text-emerald-700">Ajánlott: ipari cégeknek, akik 24/7 önkiszolgáló támogatást akarnak az egyszerű kérdésekre + gyors emberi segítséget a komoly problémákra.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Detailed Comparison Table --}}
    <section class="bg-surface-primary py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-6">
            <div class="reveal mb-12">
                <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-emerald-600">Részletes összehasonlítás</p>
                <h2 class="mb-4 text-3xl text-text-primary md:text-4xl" style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                    Támogatási képesség-összehasonlítás
                </h2>
            </div>

            <div class="reveal overflow-x-auto">
                <table class="w-full min-w-[700px] border-collapse overflow-hidden rounded-2xl border border-border-light">
                    <thead>
                        <tr class="bg-surface-primary">
                            <th class="px-5 py-4 text-left text-xs font-bold uppercase tracking-wider text-text-primary">Képesség</th>
                            <th class="px-5 py-4 text-left text-xs font-bold uppercase tracking-wider text-text-tertiary">Hagyományos helpdesk</th>
                            <th class="px-5 py-4 text-left text-xs font-bold uppercase tracking-wider text-text-tertiary">Generikus chatbot</th>
                            <th class="px-5 py-4 text-left text-xs font-bold uppercase tracking-wider text-emerald-600">Cégem360</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-border-light">
                        <tr>
                            <td class="px-5 py-4 text-sm font-semibold text-text-primary">24/7 elérhetőség</td>
                            <td class="px-5 py-4 text-sm text-text-tertiary">✗ Munkaidőben</td>
                            <td class="px-5 py-4 text-sm font-medium text-success-600">✓ Online</td>
                            <td class="px-5 py-4 text-sm font-medium text-success-600">✓ AI Chat 24/7</td>
                        </tr>
                        <tr>
                            <td class="px-5 py-4 text-sm font-semibold text-text-primary">Rendszeradatokra épülő válasz</td>
                            <td class="px-5 py-4 text-sm text-amber-600">◐ Kézi keresés</td>
                            <td class="px-5 py-4 text-sm text-text-tertiary">✗ Nem</td>
                            <td class="px-5 py-4 text-sm font-medium text-success-600">✓ Natív, valós idejű</td>
                        </tr>
                        <tr>
                            <td class="px-5 py-4 text-sm font-semibold text-text-primary">Emberi support komplex ügyekre</td>
                            <td class="px-5 py-4 text-sm font-medium text-success-600">✓ Igen</td>
                            <td class="px-5 py-4 text-sm text-text-tertiary">✗ Nincs</td>
                            <td class="px-5 py-4 text-sm font-medium text-success-600">✓ H–P 8–16h</td>
                        </tr>
                        <tr>
                            <td class="px-5 py-4 text-sm font-semibold text-text-primary">Kontextus-átadás AI → ember</td>
                            <td class="px-5 py-4 text-sm text-text-tertiary">✗ Nem releváns</td>
                            <td class="px-5 py-4 text-sm text-amber-600">◐ Korlátozott</td>
                            <td class="px-5 py-4 text-sm font-medium text-success-600">✓ Automatikus</td>
                        </tr>
                        <tr>
                            <td class="px-5 py-4 text-sm font-semibold text-text-primary">Automatikus ticket-nyitás</td>
                            <td class="px-5 py-4 text-sm text-amber-600">◐ Kézi</td>
                            <td class="px-5 py-4 text-sm text-amber-600">◐ Alap</td>
                            <td class="px-5 py-4 text-sm font-medium text-success-600">✓ Automatikus</td>
                        </tr>
                        <tr>
                            <td class="px-5 py-4 text-sm font-semibold text-text-primary">Hibabejelentő űrlap (strukturált)</td>
                            <td class="px-5 py-4 text-sm text-amber-600">◐ Általános form</td>
                            <td class="px-5 py-4 text-sm text-text-tertiary">✗ Nincs</td>
                            <td class="px-5 py-4 text-sm font-medium text-success-600">✓ Modulspecifikus</td>
                        </tr>
                        <tr>
                            <td class="px-5 py-4 text-sm font-semibold text-text-primary">Magyar nyelv és ipari terminológia</td>
                            <td class="px-5 py-4 text-sm font-medium text-success-600">✓ Emberi</td>
                            <td class="px-5 py-4 text-sm text-amber-600">◐ Gépi fordítás</td>
                            <td class="px-5 py-4 text-sm font-medium text-success-600">✓ Natív magyar</td>
                        </tr>
                        <tr>
                            <td class="px-5 py-4 text-sm font-semibold text-text-primary">Válaszidő (egyszerű kérdés)</td>
                            <td class="px-5 py-4 text-sm text-text-tertiary">✗ 24–48h</td>
                            <td class="px-5 py-4 text-sm font-medium text-success-600">✓ &lt; 5 mp</td>
                            <td class="px-5 py-4 text-sm font-medium text-success-600">✓ &lt; 2 mp</td>
                        </tr>
                        <tr>
                            <td class="px-5 py-4 text-sm font-semibold text-text-primary">Válaszidő (komplex hiba)</td>
                            <td class="px-5 py-4 text-sm text-amber-600">◐ 24–48h</td>
                            <td class="px-5 py-4 text-sm text-text-tertiary">✗ Nem tud segíteni</td>
                            <td class="px-5 py-4 text-sm font-medium text-success-600">✓ &lt; 4h</td>
                        </tr>
                        <tr>
                            <td class="px-5 py-4 text-sm font-semibold text-text-primary">Beépítve, nem kell integrálni</td>
                            <td class="px-5 py-4 text-sm text-text-tertiary">✗ Külön rendszer</td>
                            <td class="px-5 py-4 text-sm text-text-tertiary">✗ Külön rendszer</td>
                            <td class="px-5 py-4 text-sm font-medium text-success-600">✓ Natív</td>
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
                        <h3 class="mb-3 text-xl font-bold text-text-primary lg:text-2xl" style="font-family: 'Poppins', sans-serif;">Kérdése van? Vegye fel a kapcsolatot!</h3>
                        <p class="mb-5 text-base text-text-secondary">Ha a támogatási rendszerről, az AI Chat képességeiről vagy az emberi ügyfélszolgálat elérhetőségéről kérdezne — foglaljon online konzultációt vagy írjon a support csapatunknak.</p>
                        <div class="flex flex-wrap gap-5">
                            <span class="flex items-center gap-1.5 text-sm text-text-tertiary"><svg class="h-4 w-4 text-success-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>30 perc videóhívás</span>
                            <span class="flex items-center gap-1.5 text-sm text-text-tertiary"><svg class="h-4 w-4 text-success-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>AI Chat bemutató</span>
                            <span class="flex items-center gap-1.5 text-sm text-text-tertiary"><svg class="h-4 w-4 text-success-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>Nincs elköteleződés</span>
                        </div>
                    </div>
                    <a href="{{ route('contact') }}" class="group inline-flex items-center gap-2 rounded-full bg-emerald-600 px-6 py-3 text-base font-medium text-white transition-all hover:bg-emerald-700 hover:shadow-lg" style="box-shadow: 0 1px 2px rgba(0,0,0,0.05);">
                        <span>Konzultáció</span>
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
                <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-emerald-600">Segítségre van szüksége?</p>
                <h2 class="mb-4 text-3xl text-text-primary md:text-4xl" style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                    Válassza ki a leggyorsabb utat a megoldásig
                </h2>
            </div>

            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2" data-stagger>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-8 text-center" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <h3 class="mb-3 text-xl font-bold text-text-primary">Hibabejelentés</h3>
                    <p class="mb-6 text-sm text-text-secondary">Strukturált űrlap a technikai problémák jelzésére: modul, prioritás, lépések, képernyőkép. A csapatunk munkaidőben kezeli.</p>
                    <a href="{{ route('hibabejelentes') }}" class="group inline-flex items-center gap-2 rounded-full bg-emerald-600 px-6 py-3 text-sm font-medium text-white transition-all hover:bg-emerald-700 hover:shadow-lg" style="box-shadow: 0 1px 2px rgba(0,0,0,0.05);">
                        Hibabejelentő megnyitása <svg class="arrow-slide h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" /></svg>
                    </a>
                </div>
                <div class="stagger-item card-glow rounded-2xl border border-emerald-100 bg-emerald-50 p-8 text-center" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <h3 class="mb-3 text-xl font-bold text-text-primary">Regisztráció és kipróbálás</h3>
                    <p class="mb-6 text-sm text-text-secondary">Fedezze fel a Cégem360-at, az AI Chat-et és a teljes támogatási rendszert — regisztráció után azonnal.</p>
                    <a href="{{ route('register') }}" class="inline-flex items-center gap-2 rounded-full border border-border-light bg-surface-primary px-6 py-3 text-sm font-medium text-text-primary transition-all hover:border-emerald-200 hover:shadow-md">
                        Regisztráció <svg class="arrow-slide h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" /></svg>
                    </a>
                </div>
            </div>
        </div>
    </section>
</div>
