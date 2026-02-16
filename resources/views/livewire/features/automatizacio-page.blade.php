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
            0% { box-shadow: 0 0 0 0 rgba(245, 158, 11, 0.4); }
            70% { box-shadow: 0 0 0 6px rgba(245, 158, 11, 0); }
            100% { box-shadow: 0 0 0 0 rgba(245, 158, 11, 0); }
        }
        .pulse-dot { animation: pulse-ring 2s ease infinite; }

        .card-glow { transition: all 0.4s cubic-bezier(0,0,0.2,1); }
        .card-glow:hover { box-shadow: 0 8px 30px -8px rgba(245, 158, 11, 0.15), 0 2px 8px rgba(0,0,0,0.04) !important; }

        .icon-hover { transition: transform 0.35s cubic-bezier(0,0,0.2,1.4); }
        .group:hover .icon-hover, .card-glow:hover .icon-hover { transform: translateY(-3px) scale(1.08); }

        .arrow-slide { transition: transform 0.3s cubic-bezier(0,0,0.2,1); }
        .group:hover .arrow-slide, a:hover .arrow-slide { transform: translateX(4px); }

        .stat-hover .stat-value { transition: transform 0.4s cubic-bezier(0,0,0.2,1.4); }
        .stat-hover:hover .stat-value { transform: scale(1.08); }

        .feature-dot { transition: transform 0.3s cubic-bezier(0,0,0.2,1); }
        .card-glow:hover .feature-dot { transform: scale(1.5); }

        .pill-float { transition: transform 0.35s cubic-bezier(0,0,0.2,1), box-shadow 0.35s cubic-bezier(0,0,0.2,1); }
        .pill-float:hover { transform: translateY(-3px); box-shadow: 0 6px 20px -4px rgba(245, 158, 11, 0.12); }

        @keyframes node-pulse { 0%, 100% { opacity: 1; } 50% { opacity: 0.6; } }
        .node-pulse { animation: node-pulse 2.5s ease infinite; }

        html { scroll-behavior: smooth; }
    </style>

    {{-- Hero Section --}}
    <section class="bg-linear-to-b from-amber-50 to-surface-secondary">
        <div class="mx-auto max-w-7xl px-6 py-16 lg:py-24">
            <div class="grid grid-cols-1 items-center gap-12 lg:grid-cols-2">
                {{-- Hero Text --}}
                <div class="reveal">
                    <div class="badge-gradient mb-8 inline-flex items-center gap-2 rounded-full border border-border-light/80 bg-surface-primary px-4 py-1.5"
                        style="box-shadow: 0 1px 3px rgba(0,0,0,0.04);">
                        <span class="pulse-dot h-1.5 w-1.5 rounded-full bg-linear-to-r from-amber-500 via-orange-500 to-amber-400"></span>
                        <span class="text-sm font-medium text-text-primary">Funkció — Automatizációk</span>
                    </div>

                    <h1 class="mb-6 text-4xl leading-tight tracking-tight text-text-primary md:text-5xl lg:text-[3.5rem]"
                        style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                        Ha egyszer beállítod —<br>
                        utána a rendszer dolgozik helyetted
                    </h1>

                    <p class="mb-10 max-w-xl text-lg text-text-secondary lg:text-xl">
                        Az ipari B2B cégek naponta tucatnyi ismétlődő feladatot végeznek: jóváhagyás, értesítés, kiosztás, emlékeztető, riport, eszkaláció. A Cégem360 automatizációs motor ezeket szabályalapú workflow-kkal oldja meg — modulok között, emberi beavatkozás nélkül.
                    </p>

                    <div class="flex flex-wrap items-center gap-4">
                        <a href="{{ route('contact') }}"
                            class="group inline-flex items-center gap-2 rounded-full bg-amber-600 px-6 py-3 text-base font-medium text-white transition-all hover:bg-amber-700 hover:shadow-lg"
                            style="box-shadow: 0 1px 2px rgba(0,0,0,0.05);">
                            <span>Online konzultáció</span>
                            <svg class="arrow-slide h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" /></svg>
                        </a>
                        <a href="#kepessegek"
                            class="inline-flex items-center gap-2 rounded-full border border-border-light bg-surface-primary px-6 py-3 text-base font-medium text-text-primary transition-all hover:border-amber-200 hover:bg-surface-secondary hover:shadow-md">
                            Képességek áttekintése
                        </a>
                    </div>
                </div>

                {{-- Workflow Builder Visual --}}
                <div class="reveal-right">
                    <div class="rounded-2xl border border-border-light bg-surface-primary p-6"
                        style="box-shadow: 0 4px 20px -4px rgba(0,0,0,0.06);">
                        <div class="mb-4 flex items-center justify-between border-b border-border-light pb-4">
                            <div>
                                <span class="block text-sm font-bold text-text-primary">Automatizáció-kezelő</span>
                                <span class="block text-[10px] text-text-tertiary">Workflow-k · Triggerek · Szabályok</span>
                            </div>
                            <span class="inline-flex items-center gap-1.5 rounded-md border border-amber-100 bg-linear-to-r from-amber-50 to-orange-50 px-2.5 py-1 text-[10px] font-semibold text-amber-600">
                                <span class="node-pulse">⚡</span>
                                14 aktív workflow
                            </span>
                        </div>

                        {{-- Workflow Flow Visualization --}}
                        <div class="mb-4 space-y-2">
                            <div class="flex flex-wrap items-center gap-1.5">
                                <span class="rounded-md border border-amber-200 bg-amber-50 px-2.5 py-1.5 text-[10px] font-semibold text-amber-700">⚡ Új szervizjegy</span>
                                <span class="text-[10px] text-text-tertiary">→</span>
                                <span class="rounded-md border border-violet-200 bg-violet-50 px-2.5 py-1.5 text-[10px] font-semibold text-violet-700">◆ Sürgős?</span>
                                <span class="text-[10px] text-text-tertiary">→ Igen:</span>
                                <span class="rounded-md border border-emerald-200 bg-emerald-50 px-2.5 py-1.5 text-[10px] font-semibold text-emerald-700">✓ Azonnali kiosztás</span>
                                <span class="text-[10px] text-text-tertiary">→</span>
                                <span class="rounded-md border border-blue-200 bg-blue-50 px-2.5 py-1.5 text-[10px] font-semibold text-blue-700">✉ SMS technikus</span>
                            </div>
                            <div class="flex flex-wrap items-center gap-1.5 pl-8">
                                <span class="text-[10px] text-text-tertiary">↳ Nem:</span>
                                <span class="rounded-md border border-slate-200 bg-slate-50 px-2.5 py-1.5 text-[10px] font-semibold text-slate-600">⏱ Várakozás 2h</span>
                                <span class="text-[10px] text-text-tertiary">→</span>
                                <span class="rounded-md border border-emerald-200 bg-emerald-50 px-2.5 py-1.5 text-[10px] font-semibold text-emerald-700">✓ Sorba állítás</span>
                            </div>
                        </div>

                        {{-- Active Automations List --}}
                        <div class="mb-3 space-y-1">
                            <div class="flex items-center gap-3 rounded-md bg-surface-secondary p-2.5">
                                <span class="h-2 w-2 rounded-full bg-emerald-500" style="box-shadow: 0 0 8px rgba(16,185,129,0.4);"></span>
                                <div class="min-w-0 flex-1">
                                    <span class="block truncate text-[11px] font-semibold text-text-primary">Szervizjegy kiosztás</span>
                                    <span class="block text-[9px] text-text-tertiary">Szerviz → Munkalap → CRM</span>
                                </div>
                                <span class="text-[10px] text-text-tertiary" style="font-family: 'JetBrains Mono', monospace;">1 247×</span>
                                <span class="rounded bg-emerald-50 px-1.5 py-0.5 text-[9px] font-bold text-emerald-600">Aktív</span>
                            </div>
                            <div class="flex items-center gap-3 rounded-md bg-surface-secondary p-2.5">
                                <span class="h-2 w-2 rounded-full bg-emerald-500" style="box-shadow: 0 0 8px rgba(16,185,129,0.4);"></span>
                                <div class="min-w-0 flex-1">
                                    <span class="block truncate text-[11px] font-semibold text-text-primary">Ajánlat → megrendelés → gyártás</span>
                                    <span class="block text-[9px] text-text-tertiary">CRM → Értékesítés → Gyártás</span>
                                </div>
                                <span class="text-[10px] text-text-tertiary" style="font-family: 'JetBrains Mono', monospace;">832×</span>
                                <span class="rounded bg-emerald-50 px-1.5 py-0.5 text-[9px] font-bold text-emerald-600">Aktív</span>
                            </div>
                            <div class="flex items-center gap-3 rounded-md bg-surface-secondary p-2.5">
                                <span class="h-2 w-2 rounded-full bg-emerald-500" style="box-shadow: 0 0 8px rgba(16,185,129,0.4);"></span>
                                <div class="min-w-0 flex-1">
                                    <span class="block truncate text-[11px] font-semibold text-text-primary">Garancia-lejárat</span>
                                    <span class="block text-[9px] text-text-tertiary">CRM → Automatizálás → Értékesítés</span>
                                </div>
                                <span class="text-[10px] text-text-tertiary" style="font-family: 'JetBrains Mono', monospace;">156×</span>
                                <span class="rounded bg-emerald-50 px-1.5 py-0.5 text-[9px] font-bold text-emerald-600">Aktív</span>
                            </div>
                            <div class="flex items-center gap-3 rounded-md bg-surface-secondary p-2.5">
                                <span class="h-2 w-2 rounded-full bg-amber-500"></span>
                                <div class="min-w-0 flex-1">
                                    <span class="block truncate text-[11px] font-semibold text-text-primary">Heti vezetői riport</span>
                                    <span class="block text-[9px] text-text-tertiary">Kontrolling → DataMind → E-mail</span>
                                </div>
                                <span class="text-[10px] text-text-tertiary" style="font-family: 'JetBrains Mono', monospace;">48×</span>
                                <span class="rounded bg-amber-50 px-1.5 py-0.5 text-[9px] font-bold text-amber-600">Szünetel</span>
                            </div>
                        </div>

                        {{-- Footer Stats --}}
                        <div class="mt-3 flex gap-5 border-t border-border-light pt-3">
                            <span class="flex items-center gap-1.5 text-[10px] text-text-tertiary">
                                <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span> 12 aktív
                            </span>
                            <span class="flex items-center gap-1.5 text-[10px] text-text-tertiary">
                                <span class="h-1.5 w-1.5 rounded-full bg-amber-500"></span> 2 szünetel
                            </span>
                            <span class="flex items-center gap-1.5 text-[10px] text-text-tertiary">
                                <span class="h-1.5 w-1.5 rounded-full bg-violet-500"></span> 2 283 futás / hó
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Trigger Types Section --}}
    <section class="bg-surface-secondary py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-6">
            <div class="reveal mb-12">
                <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-amber-600">Trigger-típusok</p>
                <h2 class="mb-4 text-3xl text-text-primary md:text-4xl" style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                    Mi indíthat el egy automatizmust?
                </h2>
                <p class="max-w-xl text-lg text-text-secondary">
                    Négyféle trigger indíthat workflow-t a Cégem360-ban — minden modul eseményeire reagálva.
                </p>
            </div>

            <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4" data-stagger>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-7" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="icon-hover mb-5 flex h-12 w-12 items-center justify-center rounded-xl bg-amber-50 text-xl">⚡</div>
                    <h3 class="mb-2 text-base font-bold text-text-primary">Esemény-trigger</h3>
                    <p class="mb-3 text-sm leading-relaxed text-text-secondary">Egy adott dolog történik a rendszerben — és elindul a workflow.</p>
                    <div class="space-y-1.5">
                        <span class="flex items-center gap-2 text-xs text-text-tertiary"><span class="text-amber-500">→</span>Új szervizjegy érkezett</span>
                        <span class="flex items-center gap-2 text-xs text-text-tertiary"><span class="text-amber-500">→</span>Ajánlat elfogadva</span>
                        <span class="flex items-center gap-2 text-xs text-text-tertiary"><span class="text-amber-500">→</span>Készletszint kritikus alá csökkent</span>
                    </div>
                </div>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-7" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="icon-hover mb-5 flex h-12 w-12 items-center justify-center rounded-xl bg-violet-50 text-xl">📅</div>
                    <h3 class="mb-2 text-base font-bold text-text-primary">Időzített trigger</h3>
                    <p class="mb-3 text-sm leading-relaxed text-text-secondary">Ütemezett, ismétlődő automatizmus — adott napon, időpontban.</p>
                    <div class="space-y-1.5">
                        <span class="flex items-center gap-2 text-xs text-text-tertiary"><span class="text-amber-500">→</span>Hétfő 8:00 — vezetői riport</span>
                        <span class="flex items-center gap-2 text-xs text-text-tertiary"><span class="text-amber-500">→</span>Hónap 1. — havi zárás</span>
                        <span class="flex items-center gap-2 text-xs text-text-tertiary"><span class="text-amber-500">→</span>Naponta — lejárat-ellenőrzés</span>
                    </div>
                </div>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-7" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="icon-hover mb-5 flex h-12 w-12 items-center justify-center rounded-xl bg-emerald-50 text-xl">📊</div>
                    <h3 class="mb-2 text-base font-bold text-text-primary">Feltétel-trigger</h3>
                    <p class="mb-3 text-sm leading-relaxed text-text-secondary">Amikor egy mérőszám átlép egy küszöböt — riasztás és beavatkozás.</p>
                    <div class="space-y-1.5">
                        <span class="flex items-center gap-2 text-xs text-text-tertiary"><span class="text-amber-500">→</span>SLA válaszidő &gt; 4 óra</span>
                        <span class="flex items-center gap-2 text-xs text-text-tertiary"><span class="text-amber-500">→</span>Projekt költség &gt; 110% terv</span>
                        <span class="flex items-center gap-2 text-xs text-text-tertiary"><span class="text-amber-500">→</span>OEE &lt; 70%</span>
                    </div>
                </div>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-7" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="icon-hover mb-5 flex h-12 w-12 items-center justify-center rounded-xl bg-blue-50 text-xl">🤖</div>
                    <h3 class="mb-2 text-base font-bold text-text-primary">MI-trigger (DataMind)</h3>
                    <p class="mb-3 text-sm leading-relaxed text-text-secondary">A DataMind MI azonosít egy mintát vagy predikciót — és javasol vagy cselekszik.</p>
                    <div class="space-y-1.5">
                        <span class="flex items-center gap-2 text-xs text-text-tertiary"><span class="text-amber-500">→</span>Churn-kockázat &gt; 80%</span>
                        <span class="flex items-center gap-2 text-xs text-text-tertiary"><span class="text-amber-500">→</span>Cash flow szűkülés várható</span>
                        <span class="flex items-center gap-2 text-xs text-text-tertiary"><span class="text-amber-500">→</span>Karbantartás szükséges 2 héten belül</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Capabilities Section --}}
    <section class="bg-surface-primary py-16 lg:py-24" id="kepessegek">
        <div class="mx-auto max-w-7xl px-6">
            <div class="reveal mb-12">
                <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-amber-600">Képességek</p>
                <h2 class="mb-4 text-3xl text-text-primary md:text-4xl" style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                    Nem e-mail szabály — ipari workflow-motor
                </h2>
                <p class="max-w-xl text-lg text-text-secondary">
                    A Cégem360 automatizációs motor modulok között dolgozik, feltételes logikával, eszkalációval és MI döntéstámogatással.
                </p>
            </div>

            <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3" data-stagger>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-7" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="icon-hover mb-5 flex h-12 w-12 items-center justify-center rounded-xl bg-amber-50 text-xl">🔀</div>
                    <h3 class="mb-2 text-base font-bold text-text-primary">Vizuális workflow-építő</h3>
                    <p class="text-sm leading-relaxed text-text-secondary">Drag-and-drop felületen összeállítható workflow: trigger → feltétel → akció → értesítés → várakozás → elágazás. Nem kell kódolni — de bármilyen komplex logika felépíthető.</p>
                </div>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-7" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="icon-hover mb-5 flex h-12 w-12 items-center justify-center rounded-xl bg-violet-50 text-xl">🔗</div>
                    <h3 class="mb-2 text-base font-bold text-text-primary">Modulok közötti automatizmus</h3>
                    <p class="text-sm leading-relaxed text-text-secondary">Egy workflow átívelhet a CRM-en, gyártáson, beszerzésen és kontrollingon. Az ajánlatból rendelés, a rendelésből gyártási utasítás, a gyártásból szállítólevél — egyetlen automatizmusból.</p>
                </div>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-7" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="icon-hover mb-5 flex h-12 w-12 items-center justify-center rounded-xl bg-emerald-50 text-xl">◆</div>
                    <h3 class="mb-2 text-base font-bold text-text-primary">Feltételes logika és elágazás</h3>
                    <p class="text-sm leading-relaxed text-text-secondary">IF/THEN/ELSE szabályok: ha az összeg &gt; 5M Ft → igazgatói jóváhagyás; ha sürgős → azonnali kiosztás; ha garancia lejár 60 napon belül → ajánlat küldés. Korlátlan elágazás.</p>
                </div>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-7" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="icon-hover mb-5 flex h-12 w-12 items-center justify-center rounded-xl bg-blue-50 text-xl">⏫</div>
                    <h3 class="mb-2 text-base font-bold text-text-primary">Eszkaláció és határidő-kezelés</h3>
                    <p class="text-sm leading-relaxed text-text-secondary">Ha a jóváhagyás nem érkezik meg 24 órán belül → eszkaláció a feletteshez. Ha az SLA-határidő közeleg → automatikus figyelmeztető. Többszintű eszkalációs lánc.</p>
                </div>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-7" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="icon-hover mb-5 flex h-12 w-12 items-center justify-center rounded-xl bg-orange-50 text-xl">📨</div>
                    <h3 class="mb-2 text-base font-bold text-text-primary">Többcsatornás értesítés</h3>
                    <p class="text-sm leading-relaxed text-text-secondary">E-mail, rendszer-értesítés, webhook (Slack, Teams, SMS) — egy workflow-ból több csatornára is küldhet értesítést, a címzett és a prioritás szerint különbözőre.</p>
                </div>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-7" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="icon-hover mb-5 flex h-12 w-12 items-center justify-center rounded-xl bg-rose-50 text-xl">📋</div>
                    <h3 class="mb-2 text-base font-bold text-text-primary">Napló és audit trail</h3>
                    <p class="text-sm leading-relaxed text-text-secondary">Minden automatizmus-futás naplózott: mikor indult, mi volt a trigger, melyik ágon ment végig, mi volt az eredmény. ISO 9001 kompatibilis, audit-kész.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Module Automations Map Section --}}
    <section class="bg-surface-secondary py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-6">
            <div class="reveal mb-12">
                <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-amber-600">Modul–automatizáció térkép</p>
                <h2 class="mb-4 text-3xl text-text-primary md:text-4xl" style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                    Melyik modulban milyen automatizmusok állíthatók be?
                </h2>
                <p class="max-w-xl text-lg text-text-secondary">
                    Minden modul saját eseményeket, triggereket és akciókat kínál — amelyek szabadon kombinálhatók.
                </p>
            </div>

            <div class="grid grid-cols-1 gap-5 lg:grid-cols-2" data-stagger>
                {{-- CRM & Értékesítés --}}
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-6" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="mb-4 flex items-center gap-3">
                        <span class="rounded-md bg-emerald-50 px-2.5 py-1 text-[10px] font-bold uppercase tracking-wider text-emerald-600">CRM</span>
                        <span class="text-xs font-medium text-text-tertiary">Ügyféléletciklus-automatizmusok</span>
                    </div>
                    <div class="space-y-2">
                        <div class="rounded-lg bg-surface-secondary p-3 text-sm text-text-secondary"><span class="mr-2 text-amber-500">⚡</span>Ajánlat elfogadva → automatikus megrendelés + gyártási utasítás</div>
                        <div class="rounded-lg bg-surface-secondary p-3 text-sm text-text-secondary"><span class="mr-2 text-amber-500">⚡</span>Lead inaktív 14 napja → emlékeztető az értékesítőnek</div>
                        <div class="rounded-lg bg-surface-secondary p-3 text-sm text-text-secondary"><span class="mr-2 text-amber-500">⚡</span>Szerződés lejár 60 napon belül → megújítási ajánlat generálás</div>
                    </div>
                </div>

                {{-- Gyártásirányítás --}}
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-6" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="mb-4 flex items-center gap-3">
                        <span class="rounded-md bg-orange-50 px-2.5 py-1 text-[10px] font-bold uppercase tracking-wider text-orange-600">Gyártásirányítás</span>
                        <span class="text-xs font-medium text-text-tertiary">Gyártási trigger-ek</span>
                    </div>
                    <div class="space-y-2">
                        <div class="rounded-lg bg-surface-secondary p-3 text-sm text-text-secondary"><span class="mr-2 text-amber-500">⚡</span>Gyártási utasítás létrejött → anyagigény a beszerzésnek</div>
                        <div class="rounded-lg bg-surface-secondary p-3 text-sm text-text-secondary"><span class="mr-2 text-amber-500">⚡</span>OEE &lt; 70% → riasztás a műszakvezetőnek</div>
                        <div class="rounded-lg bg-surface-secondary p-3 text-sm text-text-secondary"><span class="mr-2 text-amber-500">⚡</span>Tétel lezárva → minőségi tanúsítvány generálás</div>
                    </div>
                </div>

                {{-- Beszerzés-logisztika --}}
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-6" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="mb-4 flex items-center gap-3">
                        <span class="rounded-md bg-cyan-50 px-2.5 py-1 text-[10px] font-bold uppercase tracking-wider text-cyan-600">Beszerzés-logisztika</span>
                        <span class="text-xs font-medium text-text-tertiary">Készlet- és rendelés-automatizmusok</span>
                    </div>
                    <div class="space-y-2">
                        <div class="rounded-lg bg-surface-secondary p-3 text-sm text-text-secondary"><span class="mr-2 text-amber-500">⚡</span>Készletszint &lt; minimum → automatikus rendelés-javaslat</div>
                        <div class="rounded-lg bg-surface-secondary p-3 text-sm text-text-secondary"><span class="mr-2 text-amber-500">⚡</span>Szállítási határidő közeleg → szállító-emlékeztető</div>
                        <div class="rounded-lg bg-surface-secondary p-3 text-sm text-text-secondary"><span class="mr-2 text-amber-500">⚡</span>Bevételezés megtörtént → készletfrissítés + értesítés</div>
                    </div>
                </div>

                {{-- Kontrolling --}}
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-6" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="mb-4 flex items-center gap-3">
                        <span class="rounded-md bg-violet-50 px-2.5 py-1 text-[10px] font-bold uppercase tracking-wider text-violet-600">Kontrolling</span>
                        <span class="text-xs font-medium text-text-tertiary">Pénzügyi automatizmusok</span>
                    </div>
                    <div class="space-y-2">
                        <div class="rounded-lg bg-surface-secondary p-3 text-sm text-text-secondary"><span class="mr-2 text-amber-500">⚡</span>Projekt költség &gt; 110% terv → figyelmeztető a projektvezetőnek</div>
                        <div class="rounded-lg bg-surface-secondary p-3 text-sm text-text-secondary"><span class="mr-2 text-amber-500">⚡</span>Hétfő 8:00 → heti vezetői riport generálás és küldés</div>
                        <div class="rounded-lg bg-surface-secondary p-3 text-sm text-text-secondary"><span class="mr-2 text-amber-500">⚡</span>Fizetési határidő lejárt → fizetési felszólítás workflow</div>
                    </div>
                </div>

                {{-- Digitális munkalap --}}
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-6" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="mb-4 flex items-center gap-3">
                        <span class="rounded-md bg-amber-50 px-2.5 py-1 text-[10px] font-bold uppercase tracking-wider text-amber-600">Digitális munkalap</span>
                        <span class="text-xs font-medium text-text-tertiary">Helyszíni munka automatizmusok</span>
                    </div>
                    <div class="space-y-2">
                        <div class="rounded-lg bg-surface-secondary p-3 text-sm text-text-secondary"><span class="mr-2 text-amber-500">⚡</span>Munkalap aláírva → azonnali PDF küldés ügyfélnek</div>
                        <div class="rounded-lg bg-surface-secondary p-3 text-sm text-text-secondary"><span class="mr-2 text-amber-500">⚡</span>Anyagfelhasználás rögzítve → készlet-levonás + kontrolling</div>
                        <div class="rounded-lg bg-surface-secondary p-3 text-sm text-text-secondary"><span class="mr-2 text-amber-500">⚡</span>Karbantartás esedékes → automatikus feladat a technikusnak</div>
                    </div>
                </div>

                {{-- AI Chat --}}
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-6" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="mb-4 flex items-center gap-3">
                        <span class="rounded-md bg-blue-50 px-2.5 py-1 text-[10px] font-bold uppercase tracking-wider text-blue-600">AI Chat</span>
                        <span class="text-xs font-medium text-text-tertiary">Chatbot-trigger automatizmusok</span>
                    </div>
                    <div class="space-y-2">
                        <div class="rounded-lg bg-surface-secondary p-3 text-sm text-text-secondary"><span class="mr-2 text-amber-500">⚡</span>AI nem tud válaszolni → automatikus ticket + live handoff</div>
                        <div class="rounded-lg bg-surface-secondary p-3 text-sm text-text-secondary"><span class="mr-2 text-amber-500">⚡</span>Elégedettségi pontszám &lt; 3 → eszkaláció a menedzsmenthez</div>
                        <div class="rounded-lg bg-surface-secondary p-3 text-sm text-text-secondary"><span class="mr-2 text-amber-500">⚡</span>Új lead a chatbotból → CRM-bejegyzés + értékesítő értesítés</div>
                    </div>
                </div>

                {{-- MarketingHub --}}
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-6" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="mb-4 flex items-center gap-3">
                        <span class="rounded-md bg-pink-50 px-2.5 py-1 text-[10px] font-bold uppercase tracking-wider text-pink-600">MarketingHub</span>
                        <span class="text-xs font-medium text-text-tertiary">Kampány- és lead-automatizmusok</span>
                    </div>
                    <div class="space-y-2">
                        <div class="rounded-lg bg-surface-secondary p-3 text-sm text-text-secondary"><span class="mr-2 text-amber-500">⚡</span>Landing page kitöltés → lead a CRM-ben + welcome e-mail</div>
                        <div class="rounded-lg bg-surface-secondary p-3 text-sm text-text-secondary"><span class="mr-2 text-amber-500">⚡</span>E-mail megnyitás + kattintás → lead-scoring frissítés</div>
                        <div class="rounded-lg bg-surface-secondary p-3 text-sm text-text-secondary"><span class="mr-2 text-amber-500">⚡</span>NPS &gt; 9 → automatikus referencia-kérés és köszönőlevél</div>
                    </div>
                </div>

                {{-- DataMind --}}
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-6" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="mb-4 flex items-center gap-3">
                        <span class="rounded-md bg-rose-50 px-2.5 py-1 text-[10px] font-bold uppercase tracking-wider text-rose-600">DataMind</span>
                        <span class="text-xs font-medium text-text-tertiary">MI-alapú prediktív trigger-ek</span>
                    </div>
                    <div class="space-y-2">
                        <div class="rounded-lg bg-surface-secondary p-3 text-sm text-text-secondary"><span class="mr-2 text-amber-500">⚡</span>Churn-kockázat &gt; 80% → retention ajánlat + értékesítő értesítés</div>
                        <div class="rounded-lg bg-surface-secondary p-3 text-sm text-text-secondary"><span class="mr-2 text-amber-500">⚡</span>Cash flow szűkülés predikció → CFO figyelmeztetés</div>
                        <div class="rounded-lg bg-surface-secondary p-3 text-sm text-text-secondary"><span class="mr-2 text-amber-500">⚡</span>Prediktív karbantartás szükséges → szervizjegy nyitás</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Workflow Builder Section --}}
    <section class="bg-surface-primary py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-6">
            <div class="reveal mb-12">
                <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-amber-600">Workflow-építő</p>
                <h2 class="mb-4 text-3xl text-text-primary md:text-4xl" style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                    4 lépésben összeállítható — kód nélkül
                </h2>
                <p class="max-w-xl text-lg text-text-secondary">
                    A vizuális workflow-szerkesztő bárki számára használható — nem kell fejlesztő.
                </p>
            </div>

            <div class="reveal">
                <div class="rounded-2xl border border-border-light bg-surface-primary p-8" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    {{-- 4 Steps --}}
                    <div class="mb-8 grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4" data-stagger>
                        <div class="stagger-item rounded-xl border border-border-light bg-surface-secondary p-5 text-center">
                            <span class="mb-2 block text-xs font-bold text-amber-600" style="font-family: 'JetBrains Mono', monospace;">01</span>
                            <span class="mb-2 block text-xl">⚡</span>
                            <h4 class="mb-1 text-sm font-bold text-text-primary">Trigger kiválasztása</h4>
                            <p class="text-xs leading-relaxed text-text-tertiary">Mi indítsa el? Esemény, időzítés, feltétel vagy MI predikció.</p>
                        </div>
                        <div class="stagger-item rounded-xl border border-border-light bg-surface-secondary p-5 text-center">
                            <span class="mb-2 block text-xs font-bold text-violet-600" style="font-family: 'JetBrains Mono', monospace;">02</span>
                            <span class="mb-2 block text-xl">◆</span>
                            <h4 class="mb-1 text-sm font-bold text-text-primary">Feltételek megadása</h4>
                            <p class="text-xs leading-relaxed text-text-tertiary">IF/THEN/ELSE logika: összeg, prioritás, típus, határidő alapján.</p>
                        </div>
                        <div class="stagger-item rounded-xl border border-border-light bg-surface-secondary p-5 text-center">
                            <span class="mb-2 block text-xs font-bold text-emerald-600" style="font-family: 'JetBrains Mono', monospace;">03</span>
                            <span class="mb-2 block text-xl">✓</span>
                            <h4 class="mb-1 text-sm font-bold text-text-primary">Akciók definiálása</h4>
                            <p class="text-xs leading-relaxed text-text-tertiary">Mit csináljon? Rekord módosítás, dokumentum generálás, értesítés, kiosztás.</p>
                        </div>
                        <div class="stagger-item rounded-xl border border-border-light bg-surface-secondary p-5 text-center">
                            <span class="mb-2 block text-xs font-bold text-blue-600" style="font-family: 'JetBrains Mono', monospace;">04</span>
                            <span class="mb-2 block text-xl">🔁</span>
                            <h4 class="mb-1 text-sm font-bold text-text-primary">Aktiválás és monitoring</h4>
                            <p class="text-xs leading-relaxed text-text-tertiary">Bekapcsolás, futási napló, teljesítmény-metrikák, finomhangolás.</p>
                        </div>
                    </div>

                    {{-- Example Workflow --}}
                    <div class="rounded-xl border border-amber-100 bg-amber-50 p-5">
                        <span class="mb-3 block text-xs font-bold text-amber-700">Példa workflow: Garancia-lejárat kezelés</span>
                        <div class="space-y-2">
                            <div class="flex flex-wrap items-center gap-1.5">
                                <span class="rounded-md bg-amber-100 px-2.5 py-1.5 text-[10px] font-semibold text-amber-800">📅 Garancia lejár 60 napon belül</span>
                                <span class="text-[10px] text-amber-500">→</span>
                                <span class="rounded-md bg-violet-100 px-2.5 py-1.5 text-[10px] font-semibold text-violet-800">◆ Van aktív szervizszerződés?</span>
                                <span class="text-[10px] text-amber-500">→ Igen:</span>
                                <span class="rounded-md bg-emerald-100 px-2.5 py-1.5 text-[10px] font-semibold text-emerald-800">✓ Megújítási ajánlat</span>
                                <span class="text-[10px] text-amber-500">→</span>
                                <span class="rounded-md bg-emerald-100 px-2.5 py-1.5 text-[10px] font-semibold text-emerald-800">✉ E-mail ügyfélnek</span>
                            </div>
                            <div class="flex flex-wrap items-center gap-1.5 pl-8">
                                <span class="text-[10px] text-amber-500">↳ Nem:</span>
                                <span class="rounded-md bg-rose-100 px-2.5 py-1.5 text-[10px] font-semibold text-rose-800">✓ Új szerződés-ajánlat</span>
                                <span class="text-[10px] text-amber-500">→</span>
                                <span class="rounded-md bg-emerald-100 px-2.5 py-1.5 text-[10px] font-semibold text-emerald-800">✉ Értékesítő értesítés</span>
                                <span class="text-[10px] text-amber-500">→</span>
                                <span class="rounded-md bg-slate-100 px-2.5 py-1.5 text-[10px] font-semibold text-slate-700">⏱ 7 nap</span>
                                <span class="text-[10px] text-amber-500">→</span>
                                <span class="rounded-md bg-emerald-100 px-2.5 py-1.5 text-[10px] font-semibold text-emerald-800">✉ Follow-up</span>
                            </div>
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
                <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-amber-600">Eredmények</p>
                <h2 class="text-3xl text-text-primary md:text-4xl" style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                    Mérhető hatás az automatizációból
                </h2>
            </div>

            <div class="grid grid-cols-2 gap-5 lg:grid-cols-4" data-stagger data-counter-trigger>
                <div class="stagger-item stat-hover rounded-2xl border border-border-light bg-surface-primary p-8 text-center" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <span class="stat-value block text-4xl font-bold text-amber-600 lg:text-5xl" style="font-family: 'JetBrains Mono', monospace;"
                        data-count="75" data-prefix="-" data-suffix="%">0</span>
                    <span class="mt-2 block text-sm text-text-secondary">Ismétlődő manuális feladatok</span>
                </div>
                <div class="stagger-item stat-hover rounded-2xl border border-border-light bg-surface-primary p-8 text-center" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <span class="stat-value block text-4xl font-bold text-emerald-600 lg:text-5xl" style="font-family: 'JetBrains Mono', monospace;"
                        data-count="0">0</span>
                    <span class="mt-2 block text-sm text-text-secondary">Elfelejtett határidő vagy eszkaláció</span>
                </div>
                <div class="stagger-item stat-hover rounded-2xl border border-border-light bg-surface-primary p-8 text-center" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <span class="stat-value block text-4xl font-bold text-violet-600 lg:text-5xl" style="font-family: 'JetBrains Mono', monospace;"
                        data-count="3" data-suffix="×">0</span>
                    <span class="mt-2 block text-sm text-text-secondary">Gyorsabb reakcióidő</span>
                </div>
                <div class="stagger-item stat-hover rounded-2xl border border-border-light bg-surface-primary p-8 text-center" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <span class="stat-value block text-4xl font-bold text-blue-600 lg:text-5xl" style="font-family: 'JetBrains Mono', monospace;"
                        data-count="100" data-suffix="%">0</span>
                    <span class="mt-2 block text-sm text-text-secondary">Audit-nyomonkövethetőség</span>
                </div>
            </div>
        </div>
    </section>

    {{-- Use Cases Section --}}
    <section class="bg-surface-primary py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-6">
            <div class="reveal mb-12">
                <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-amber-600">Felhasználási esetek</p>
                <h2 class="mb-4 text-3xl text-text-primary md:text-4xl" style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                    Így használják az ipari automatizációkat
                </h2>
            </div>

            <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3" data-stagger>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-7" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <span class="mb-4 block text-xs font-semibold text-text-tertiary" style="font-family: 'JetBrains Mono', monospace;">01</span>
                    <h3 class="mb-2 text-base font-bold text-text-primary">Szervizjegy-kiosztás és SLA-eszkaláció</h3>
                    <p class="mb-4 text-sm leading-relaxed text-text-secondary">Új szervizjegy érkezik → a rendszer automatikusan kiosztja a legközelebbi szabad technikusnak, specialitás és helyszín alapján. Ha az SLA-határidő 75%-ánál nincs megoldás → eszkaláció a szervizvezetőnek.</p>
                    <div class="rounded-lg border border-amber-100 bg-amber-50 px-3 py-2 text-xs font-semibold text-amber-700">
                        ⚡ Új jegy → ◆ Sürgős? → ✓ Kiosztás → ⏱ SLA figyelés → ⏫ Eszkaláció
                    </div>
                </div>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-7" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <span class="mb-4 block text-xs font-semibold text-text-tertiary" style="font-family: 'JetBrains Mono', monospace;">02</span>
                    <h3 class="mb-2 text-base font-bold text-text-primary">Ajánlat → megrendelés → gyártás lánc</h3>
                    <p class="mb-4 text-sm leading-relaxed text-text-secondary">Az ügyfél elfogadja az ajánlatot → automatikusan megrendelés, gyártási utasítás, anyagigény a beszerzésnek, kapacitásfoglalás — egyetlen trigger-ből, modulok között.</p>
                    <div class="rounded-lg border border-amber-100 bg-amber-50 px-3 py-2 text-xs font-semibold text-amber-700">
                        ⚡ Ajánlat elfogadva → ✓ Megrendelés → ✓ Gyártási utasítás → ✓ Anyagigény
                    </div>
                </div>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-7" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <span class="mb-4 block text-xs font-semibold text-text-tertiary" style="font-family: 'JetBrains Mono', monospace;">03</span>
                    <h3 class="mb-2 text-base font-bold text-text-primary">Jóváhagyási workflow összeghatárral</h3>
                    <p class="mb-4 text-sm leading-relaxed text-text-secondary">Beszerzési igény: 500ezer Ft alatt → automatikus jóváhagyás. 500ezer – 2M Ft → részlegvezető. 2M Ft felett → igazgató. Eszkaláció, ha 48 órán belül nincs döntés.</p>
                    <div class="rounded-lg border border-amber-100 bg-amber-50 px-3 py-2 text-xs font-semibold text-amber-700">
                        ⚡ Beszerzési igény → ◆ Összeg? → ✓ Jóváhagyás v. ⏫ Eszkaláció
                    </div>
                </div>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-7" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <span class="mb-4 block text-xs font-semibold text-text-tertiary" style="font-family: 'JetBrains Mono', monospace;">04</span>
                    <h3 class="mb-2 text-base font-bold text-text-primary">Készlet-újrarendelés automatikusan</h3>
                    <p class="mb-4 text-sm leading-relaxed text-text-secondary">Amikor egy alkatrész készletszintje a minimum alá csökken → automatikus rendelés-javaslat a preferált szállítónak. Ha jóváhagyva → megrendelő generálás és kiküldés.</p>
                    <div class="rounded-lg border border-amber-100 bg-amber-50 px-3 py-2 text-xs font-semibold text-amber-700">
                        📊 Készlet &lt; min → ✓ Rendelés-javaslat → ◆ Jóváhagyva? → ✉ Megrendelő
                    </div>
                </div>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-7" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <span class="mb-4 block text-xs font-semibold text-text-tertiary" style="font-family: 'JetBrains Mono', monospace;">05</span>
                    <h3 class="mb-2 text-base font-bold text-text-primary">Garancia-lejárat → proaktív értékesítés</h3>
                    <p class="mb-4 text-sm leading-relaxed text-text-secondary">60 nappal a garancia lejárata előtt → automatikus megújítási ajánlat generálás, e-mail az ügyfélnek, feladat az értékesítőnek. Ha 14 napon belül nincs reakció → follow-up.</p>
                    <div class="rounded-lg border border-amber-100 bg-amber-50 px-3 py-2 text-xs font-semibold text-amber-700">
                        📅 Lejárat -60 nap → ✓ Ajánlat → ✉ E-mail → ⏱ 14 nap → ✉ Follow-up
                    </div>
                </div>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-7" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <span class="mb-4 block text-xs font-semibold text-text-tertiary" style="font-family: 'JetBrains Mono', monospace;">06</span>
                    <h3 class="mb-2 text-base font-bold text-text-primary">MI predikció → szerviz-beavatkozás</h3>
                    <p class="mb-4 text-sm leading-relaxed text-text-secondary">A DataMind azonosítja, hogy egy ügyfél gépének karbantartása 2 héten belül esedékes lesz. Automatikusan szervizjegy nyílik, a technikus kap feladatot, az ügyfél kap értesítést.</p>
                    <div class="rounded-lg border border-amber-100 bg-amber-50 px-3 py-2 text-xs font-semibold text-amber-700">
                        🤖 DataMind predikció → ✓ Szervizjegy → ✓ Technikus feladat → ✉ Ügyfél
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Competitor Comparison Section (3 cards) --}}
    <section class="bg-surface-secondary py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-6">
            <div class="reveal mb-12">
                <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-amber-600">Piaci összehasonlítás</p>
                <h2 class="mb-4 text-3xl text-text-primary md:text-4xl" style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                    Automatizáció-megközelítések az ipari piacon
                </h2>
                <p class="max-w-xl text-lg text-text-secondary">
                    Különböző eszközök különbözően közelítik meg az üzleti automatizációt. A Cégem360 egyedülálló a modulok közötti, ipari fókuszú megoldásában.
                </p>
            </div>

            <div class="grid grid-cols-1 gap-6 lg:grid-cols-3" data-stagger>
                {{-- Általános automatizálók --}}
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-8" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="mb-5">
                        <span class="mb-1 block text-xs font-semibold uppercase tracking-wider text-text-tertiary">Általános automatizálók</span>
                        <span class="block text-[11px] text-text-tertiary">Zapier, Make (Integromat), Power Automate</span>
                    </div>
                    <div class="mb-5 space-y-2">
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><svg class="h-4 w-4 text-success-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>Széleskörű rendszer-csatlakozás (5000+ app)</span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><svg class="h-4 w-4 text-success-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>Vizuális workflow-építő</span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><svg class="h-4 w-4 text-success-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>Gyors prototípus-készítés</span>
                    </div>
                    <div class="space-y-2 border-t border-border-light pt-5">
                        <span class="flex items-center gap-2 text-sm text-text-tertiary"><svg class="h-4 w-4 text-danger-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>Csak rendszerek között — nem az adat kontextusában</span>
                        <span class="flex items-center gap-2 text-sm text-text-tertiary"><svg class="h-4 w-4 text-danger-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>Nincs iparági logika (SLA, OEE, gyártási utasítás)</span>
                        <span class="flex items-center gap-2 text-sm text-text-tertiary"><svg class="h-4 w-4 text-danger-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>Drága skálázás (futásonkénti árazás)</span>
                        <span class="flex items-center gap-2 text-sm text-text-tertiary"><svg class="h-4 w-4 text-danger-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>Ha egy integráció meghibásodik → láncolat törik</span>
                    </div>
                </div>

                {{-- ERP workflow-k --}}
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-8" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="mb-5">
                        <span class="mb-1 block text-xs font-semibold uppercase tracking-wider text-text-tertiary">ERP workflow-k</span>
                        <span class="block text-[11px] text-text-tertiary">SAP WF, Dynamics 365, Odoo Automation</span>
                    </div>
                    <div class="mb-5 space-y-2">
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><svg class="h-4 w-4 text-success-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>Integrált a pénzügyi folyamatokba</span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><svg class="h-4 w-4 text-success-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>Szabványos jóváhagyási workflow-k</span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><svg class="h-4 w-4 text-success-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>Erős auditálási képesség</span>
                    </div>
                    <div class="space-y-2 border-t border-border-light pt-5">
                        <span class="flex items-center gap-2 text-sm text-text-tertiary"><svg class="h-4 w-4 text-danger-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>Beállítás: tanácsadói projekt, hetek/hónapok</span>
                        <span class="flex items-center gap-2 text-sm text-text-tertiary"><svg class="h-4 w-4 text-danger-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>Marketing, szerviz, AI automatizmus: nincs</span>
                        <span class="flex items-center gap-2 text-sm text-text-tertiary"><svg class="h-4 w-4 text-danger-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>Vizuális szerkesztő: általában korlátozott</span>
                        <span class="flex items-center gap-2 text-sm text-text-tertiary"><svg class="h-4 w-4 text-danger-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>MI-trigger, predikció: nem elérhető</span>
                    </div>
                </div>

                {{-- Cégem360 (highlighted) --}}
                <div class="stagger-item card-glow rounded-2xl border border-amber-200 bg-amber-50 p-8" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="mb-5">
                        <span class="mb-1 block text-xs font-semibold uppercase tracking-wider text-amber-600">Cégem360</span>
                        <span class="block text-[11px] text-text-tertiary">Integrált automatizáció · 11 modul · MI trigger-ek</span>
                    </div>
                    <div class="space-y-2">
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><svg class="h-4 w-4 text-success-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>Modulok között — nulla szinkron-hiba</span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><svg class="h-4 w-4 text-success-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>Ipari logika: SLA, OEE, gyártási utasítás, garancia</span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><svg class="h-4 w-4 text-success-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>Vizuális workflow-építő drag-and-drop-pal</span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><svg class="h-4 w-4 text-success-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>MI-trigger-ek DataMind-ból (predikció, anomália)</span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><svg class="h-4 w-4 text-success-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>Eszkalációs lánc, többszintű jóváhagyás</span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><svg class="h-4 w-4 text-success-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>Teljes audit trail, ISO 9001 kompatibilis</span>
                    </div>
                    <div class="mt-5 rounded-lg bg-surface-primary p-3">
                        <p class="text-xs font-semibold text-amber-700">Ajánlott: ipari cégeknek, akiknek a workflow modulok között fut — nem külső rendszerek közötti „ragasztóanyag" kell.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Detailed Comparison Table (10 rows × 4 columns) --}}
    <section class="bg-surface-primary py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-6">
            <div class="reveal mb-12">
                <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-amber-600">Részletes összehasonlítás</p>
                <h2 class="mb-4 text-3xl text-text-primary md:text-4xl" style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                    Automatizációs képesség-összehasonlítás
                </h2>
            </div>

            <div class="reveal overflow-x-auto">
                <table class="w-full min-w-[700px] border-collapse overflow-hidden rounded-2xl border border-border-light">
                    <thead>
                        <tr class="bg-surface-primary">
                            <th class="px-5 py-4 text-left text-xs font-bold uppercase tracking-wider text-text-primary">Képesség</th>
                            <th class="px-5 py-4 text-left text-xs font-bold uppercase tracking-wider text-text-tertiary">Zapier / Make</th>
                            <th class="px-5 py-4 text-left text-xs font-bold uppercase tracking-wider text-text-tertiary">ERP workflow</th>
                            <th class="px-5 py-4 text-left text-xs font-bold uppercase tracking-wider text-amber-600">Cégem360</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-border-light">
                        <tr>
                            <td class="px-5 py-4 text-sm font-semibold text-text-primary">Modulok közötti workflow</td>
                            <td class="px-5 py-4 text-sm text-text-tertiary">✗ Rendszerek közötti</td>
                            <td class="px-5 py-4 text-sm text-amber-600">◐ Részben</td>
                            <td class="px-5 py-4 text-sm font-medium text-success-600">✓ Natív, 11 modul</td>
                        </tr>
                        <tr>
                            <td class="px-5 py-4 text-sm font-semibold text-text-primary">Vizuális workflow-építő</td>
                            <td class="px-5 py-4 text-sm font-medium text-success-600">✓ Erős</td>
                            <td class="px-5 py-4 text-sm text-amber-600">◐ Korlátozott</td>
                            <td class="px-5 py-4 text-sm font-medium text-success-600">✓ Drag-and-drop</td>
                        </tr>
                        <tr>
                            <td class="px-5 py-4 text-sm font-semibold text-text-primary">Feltételes logika (IF/THEN)</td>
                            <td class="px-5 py-4 text-sm font-medium text-success-600">✓ Alap</td>
                            <td class="px-5 py-4 text-sm font-medium text-success-600">✓ Komplex</td>
                            <td class="px-5 py-4 text-sm font-medium text-success-600">✓ Korlátlan elágazás</td>
                        </tr>
                        <tr>
                            <td class="px-5 py-4 text-sm font-semibold text-text-primary">MI-trigger (predikció, anomália)</td>
                            <td class="px-5 py-4 text-sm text-text-tertiary">✗ Nincs</td>
                            <td class="px-5 py-4 text-sm text-text-tertiary">✗ Nincs</td>
                            <td class="px-5 py-4 text-sm font-medium text-success-600">✓ DataMind</td>
                        </tr>
                        <tr>
                            <td class="px-5 py-4 text-sm font-semibold text-text-primary">Ipari logika (SLA, OEE, garancia)</td>
                            <td class="px-5 py-4 text-sm text-text-tertiary">✗ Generikus</td>
                            <td class="px-5 py-4 text-sm text-amber-600">◐ Részben</td>
                            <td class="px-5 py-4 text-sm font-medium text-success-600">✓ Beépített</td>
                        </tr>
                        <tr>
                            <td class="px-5 py-4 text-sm font-semibold text-text-primary">Eszkalációs lánc</td>
                            <td class="px-5 py-4 text-sm text-text-tertiary">✗ Kézi</td>
                            <td class="px-5 py-4 text-sm font-medium text-success-600">✓ Beépített</td>
                            <td class="px-5 py-4 text-sm font-medium text-success-600">✓ Többszintű</td>
                        </tr>
                        <tr>
                            <td class="px-5 py-4 text-sm font-semibold text-text-primary">Jóváhagyási workflow</td>
                            <td class="px-5 py-4 text-sm text-text-tertiary">✗ Nem</td>
                            <td class="px-5 py-4 text-sm font-medium text-success-600">✓ Erős</td>
                            <td class="px-5 py-4 text-sm font-medium text-success-600">✓ Összeg-alapú</td>
                        </tr>
                        <tr>
                            <td class="px-5 py-4 text-sm font-semibold text-text-primary">Dokumentum-generálás akcióként</td>
                            <td class="px-5 py-4 text-sm text-text-tertiary">✗ Nem</td>
                            <td class="px-5 py-4 text-sm text-amber-600">◐ Korlátozott</td>
                            <td class="px-5 py-4 text-sm font-medium text-success-600">✓ PDF, riport, ajánlat</td>
                        </tr>
                        <tr>
                            <td class="px-5 py-4 text-sm font-semibold text-text-primary">Audit trail / ISO kompatibilitás</td>
                            <td class="px-5 py-4 text-sm text-amber-600">◐ Alap napló</td>
                            <td class="px-5 py-4 text-sm font-medium text-success-600">✓ Teljes</td>
                            <td class="px-5 py-4 text-sm font-medium text-success-600">✓ Teljes</td>
                        </tr>
                        <tr>
                            <td class="px-5 py-4 text-sm font-semibold text-text-primary">Árazási modell</td>
                            <td class="px-5 py-4 text-sm text-text-tertiary">✗ Futásonként fizet</td>
                            <td class="px-5 py-4 text-sm text-text-tertiary">✗ Licensz + tanácsadás</td>
                            <td class="px-5 py-4 text-sm font-medium text-success-600">✓ Korlátlan workflow</td>
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
                        <h3 class="mb-3 text-xl font-bold text-text-primary lg:text-2xl" style="font-family: 'Poppins', sans-serif;">Személyre szabott automatizációs konzultáció</h3>
                        <p class="mb-5 text-base text-text-secondary">30 perces videóhívás, amelyben felmérjük az ismétlődő folyamatait, és bemutatjuk, hogyan automatizálhatja őket a Cégem360 workflow-motorjával — az Ön cégére, moduljaira és munkafolyamataira szabva.</p>
                        <div class="flex flex-wrap gap-5">
                            <span class="flex items-center gap-1.5 text-sm text-text-tertiary"><svg class="h-4 w-4 text-success-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>30 perc videóhívás</span>
                            <span class="flex items-center gap-1.5 text-sm text-text-tertiary"><svg class="h-4 w-4 text-success-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>Folyamat-audit</span>
                            <span class="flex items-center gap-1.5 text-sm text-text-tertiary"><svg class="h-4 w-4 text-success-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>Nincs elköteleződés</span>
                        </div>
                    </div>
                    <a href="{{ route('contact') }}" class="group inline-flex items-center gap-2 rounded-full bg-amber-600 px-6 py-3 text-base font-medium text-white transition-all hover:bg-amber-700 hover:shadow-lg" style="box-shadow: 0 1px 2px rgba(0,0,0,0.05);">
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
                <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-amber-600">Kezdje el</p>
                <h2 class="mb-4 text-3xl text-text-primary md:text-4xl" style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                    Készen áll az automatizált ipari munkafolyamatokra?
                </h2>
                <p class="mx-auto max-w-xl text-lg text-text-secondary">
                    Válassza ki a következő lépést az Ön számára.
                </p>
            </div>

            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2" data-stagger>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-8 text-center" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <h3 class="mb-3 text-xl font-bold text-text-primary">Automatizációs konzultáció</h3>
                    <p class="mb-6 text-sm text-text-secondary">Kérdezzen szakértőinktől 30 percben — videóhíváson, az Ön ismétlődő folyamataira szabva, kötelezettség nélkül.</p>
                    <a href="{{ route('contact') }}" class="inline-flex items-center gap-2 rounded-full border border-border-light bg-surface-secondary px-6 py-3 text-sm font-medium text-text-primary transition-all hover:border-amber-200 hover:shadow-md">
                        Időpont foglalása <svg class="arrow-slide h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" /></svg>
                    </a>
                </div>
                <div class="stagger-item card-glow rounded-2xl border border-amber-100 bg-amber-50 p-8 text-center" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <h3 class="mb-3 text-xl font-bold text-text-primary">Regisztráció és kipróbálás</h3>
                    <p class="mb-6 text-sm text-text-secondary">Fedezze fel a workflow-építőt, a trigger-rendszert és az MI automatizmusokat — azonnal, a teljes modulkészlettel.</p>
                    <a href="{{ route('register') }}" class="group inline-flex items-center gap-2 rounded-full bg-amber-600 px-6 py-3 text-sm font-medium text-white transition-all hover:bg-amber-700 hover:shadow-lg" style="box-shadow: 0 1px 2px rgba(0,0,0,0.05);">
                        Regisztráció <svg class="arrow-slide h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" /></svg>
                    </a>
                </div>
            </div>
        </div>
    </section>
</div>
