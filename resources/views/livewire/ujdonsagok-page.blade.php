<div x-data="{
    activeFilter: 'all',
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

        .card-glow { transition: all 0.4s cubic-bezier(0,0,0.2,1); }
        .card-glow:hover { box-shadow: 0 8px 30px -8px rgba(99, 102, 241, 0.15), 0 2px 8px rgba(0,0,0,0.04) !important; transform: translateY(-4px); }

        .arrow-slide { transition: transform 0.3s cubic-bezier(0,0,0.2,1); }
        .group:hover .arrow-slide, a:hover .arrow-slide { transform: translateX(4px); }

        .stat-hover .stat-value { transition: transform 0.4s cubic-bezier(0,0,0.2,1.4); }
        .stat-hover:hover .stat-value { transform: scale(1.08); }

        @keyframes pulse-dot { 0%, 100% { opacity: 1; } 50% { opacity: 0.4; } }
        .pulse-dot { animation: pulse-dot 2s infinite; }

        html { scroll-behavior: smooth; }
    </style>

    {{-- Hero Section --}}
    <section class="bg-linear-to-b from-indigo-50 to-surface-secondary">
        <div class="mx-auto max-w-7xl px-6 py-16 lg:py-24">
            <div class="reveal mx-auto max-w-3xl text-center">
                <div class="badge-gradient mb-8 inline-flex items-center gap-2 rounded-full border border-border-light/80 bg-surface-primary px-4 py-1.5"
                    style="box-shadow: 0 1px 3px rgba(0,0,0,0.04);">
                    <span class="inline-block h-1.5 w-1.5 rounded-full bg-indigo-500 pulse-dot"></span>
                    <span class="text-sm font-medium text-text-primary">{{ __('Company') }} &middot; {{ __('What\'s New') }}</span>
                </div>

                <h1 class="mb-6 text-4xl leading-tight tracking-tight text-text-primary md:text-5xl lg:text-[3.5rem]"
                    style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                    {{ __('What\'s new in Cégem360?') }}
                </h1>

                <p class="mx-auto mb-10 max-w-2xl text-lg text-text-secondary lg:text-xl">
                    {{ __('New features, improvements, and fixes every month. Follow how the platform evolves — continuously, based on our customers\' feedback.') }}
                </p>

                <div class="mb-8 flex flex-wrap items-center justify-center gap-3">
                    <a href="#feliratkozas" class="group inline-flex items-center gap-2 rounded-full bg-indigo-600 px-6 py-3 text-base font-medium text-white transition-all hover:bg-indigo-700 hover:shadow-lg"
                        style="box-shadow: 0 1px 2px rgba(0,0,0,0.05);">
                        <span>{{ __('Notify me') }}</span>
                        <svg class="arrow-slide h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" /></svg>
                    </a>
                    <a href="#roadmap" class="inline-flex items-center gap-2 rounded-full border border-border-light bg-surface-primary px-6 py-3 text-base font-medium text-text-primary transition-all hover:border-indigo-200 hover:shadow-md">
                        {{ __('Planned developments') }}
                    </a>
                </div>

                {{-- Filter bar --}}
                <div class="flex flex-wrap items-center justify-center gap-2">
                    <button class="rounded-full border px-4 py-2 text-sm font-semibold transition-all"
                        :class="activeFilter === 'all' ? 'border-indigo-300 bg-indigo-50 text-indigo-700' : 'border-border-light bg-surface-primary text-text-secondary hover:border-border-default hover:text-text-primary'"
                        @click="activeFilter = 'all'">
                        {{ __('All') }}
                    </button>
                    <button class="rounded-full border px-4 py-2 text-sm font-semibold transition-all"
                        :class="activeFilter === 'new' ? 'border-indigo-300 bg-indigo-50 text-indigo-700' : 'border-border-light bg-surface-primary text-text-secondary hover:border-border-default hover:text-text-primary'"
                        @click="activeFilter = 'new'">
                        {{ __('New feature') }}
                    </button>
                    <button class="rounded-full border px-4 py-2 text-sm font-semibold transition-all"
                        :class="activeFilter === 'improvement' ? 'border-indigo-300 bg-indigo-50 text-indigo-700' : 'border-border-light bg-surface-primary text-text-secondary hover:border-border-default hover:text-text-primary'"
                        @click="activeFilter = 'improvement'">
                        {{ __('Improvement') }}
                    </button>
                    <button class="rounded-full border px-4 py-2 text-sm font-semibold transition-all"
                        :class="activeFilter === 'fix' ? 'border-indigo-300 bg-indigo-50 text-indigo-700' : 'border-border-light bg-surface-primary text-text-secondary hover:border-border-default hover:text-text-primary'"
                        @click="activeFilter = 'fix'">
                        {{ __('Bug fix') }}
                    </button>
                    <button class="rounded-full border px-4 py-2 text-sm font-semibold transition-all"
                        :class="activeFilter === 'ai' ? 'border-indigo-300 bg-indigo-50 text-indigo-700' : 'border-border-light bg-surface-primary text-text-secondary hover:border-border-default hover:text-text-primary'"
                        @click="activeFilter = 'ai'">
                        {{ __('AI') }}
                    </button>
                    <button class="rounded-full border px-4 py-2 text-sm font-semibold transition-all"
                        :class="activeFilter === 'integration' ? 'border-indigo-300 bg-indigo-50 text-indigo-700' : 'border-border-light bg-surface-primary text-text-secondary hover:border-border-default hover:text-text-primary'"
                        @click="activeFilter = 'integration'">
                        {{ __('Integration') }}
                    </button>
                </div>
            </div>
        </div>
    </section>

    {{-- Update Entries Section --}}
    <section class="bg-surface-secondary py-12 lg:py-20">
        <div class="mx-auto max-w-4xl px-6">

            {{-- 2026. Február --}}
            <div class="reveal mb-16">
                <div class="mb-6 flex items-center gap-4 border-b border-border-light pb-4">
                    <span class="text-base font-bold text-text-primary" style="font-family: 'JetBrains Mono', monospace;">{{ __('February 2026') }}</span>
                    <span class="rounded-md bg-indigo-50 px-2.5 py-0.5 text-[11px] font-bold text-indigo-600">{{ __(':count updates', ['count' => 3]) }}</span>
                    <span class="h-px flex-1 bg-border-light"></span>
                </div>

                {{-- Entry 1: DataMind anomália-detekció --}}
                <div class="mb-4 rounded-2xl border border-border-light bg-surface-primary p-6 transition-all hover:border-border-default lg:p-8" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);"
                    x-show="activeFilter === 'all' || activeFilter === 'new' || activeFilter === 'ai'" x-transition>
                    <div class="mb-4 flex flex-wrap items-start justify-between gap-3">
                        <div class="flex flex-wrap items-center gap-2">
                            <span class="text-xs font-semibold text-text-tertiary" style="font-family: 'JetBrains Mono', monospace;">{{ __('Feb 10, 2026') }}</span>
                            <span class="rounded-md bg-indigo-50 px-2.5 py-0.5 text-[11px] font-bold uppercase tracking-wider text-indigo-600">{{ __('New feature') }}</span>
                            <span class="rounded-md bg-violet-50 px-2.5 py-0.5 text-[11px] font-bold uppercase tracking-wider text-violet-600">{{ __('AI') }}</span>
                        </div>
                        <div class="flex flex-wrap gap-1.5">
                            <span class="rounded-md bg-surface-secondary px-2 py-0.5 text-[11px] font-semibold text-text-tertiary">DataMind</span>
                            <span class="rounded-md bg-surface-secondary px-2 py-0.5 text-[11px] font-semibold text-text-tertiary">AI Chat</span>
                        </div>
                    </div>

                    <h3 class="mb-2 text-lg font-bold text-text-primary">{{ __('DataMind anomaly detection: automatic alerts for unusual business data') }}</h3>
                    <p class="mb-5 text-sm leading-relaxed text-text-secondary">{{ __('The DataMind AI module now automatically recognizes unusual patterns in business data — and alerts you immediately. No need to stare at dashboards: if something is out of the ordinary, the system will notify you.') }}</p>

                    <div class="mb-5 space-y-2">
                        <div class="flex items-start gap-3">
                            <span class="mt-0.5 flex h-5 w-5 shrink-0 items-center justify-center rounded bg-indigo-50 text-[10px] font-bold text-indigo-600">+</span>
                            <span class="text-sm text-text-secondary">{{ __('Automatic anomaly detection for revenue, orders, service, and production data — on daily and weekly cycles') }}</span>
                        </div>
                        <div class="flex items-start gap-3">
                            <span class="mt-0.5 flex h-5 w-5 shrink-0 items-center justify-center rounded bg-indigo-50 text-[10px] font-bold text-indigo-600">+</span>
                            <span class="text-sm text-text-secondary">{{ __('Alerts via email and in-system notifications — prioritized (low / medium / high)') }}</span>
                        </div>
                        <div class="flex items-start gap-3">
                            <span class="mt-0.5 flex h-5 w-5 shrink-0 items-center justify-center rounded bg-indigo-50 text-[10px] font-bold text-indigo-600">+</span>
                            <span class="text-sm text-text-secondary">{{ __('Queryable in AI Chat: "What was unusual this week?" — in natural language, in Hungarian') }}</span>
                        </div>
                        <div class="flex items-start gap-3">
                            <span class="mt-0.5 flex h-5 w-5 shrink-0 items-center justify-center rounded bg-emerald-50 text-[10px] font-bold text-emerald-600">&#8593;</span>
                            <span class="text-sm text-text-secondary">{{ __('DataMind prediction accuracy improved: ±8% → ±5% for revenue forecasts') }}</span>
                        </div>
                    </div>

                    <div class="rounded-xl border border-border-light bg-surface-secondary p-5 text-center">
                        <span class="mb-1 block text-2xl opacity-40">&#128202;</span>
                        <span class="text-xs font-semibold text-text-tertiary">{{ __('Screenshot: DataMind anomaly alert dashboard') }}</span>
                    </div>
                </div>

                {{-- Entry 2: Digitális munkalap offline --}}
                <div class="mb-4 rounded-2xl border border-border-light bg-surface-primary p-6 transition-all hover:border-border-default lg:p-8" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);"
                    x-show="activeFilter === 'all' || activeFilter === 'improvement'" x-transition>
                    <div class="mb-4 flex flex-wrap items-start justify-between gap-3">
                        <div class="flex flex-wrap items-center gap-2">
                            <span class="text-xs font-semibold text-text-tertiary" style="font-family: 'JetBrains Mono', monospace;">{{ __('Feb 5, 2026') }}</span>
                            <span class="rounded-md bg-emerald-50 px-2.5 py-0.5 text-[11px] font-bold uppercase tracking-wider text-emerald-600">{{ __('Improvement') }}</span>
                        </div>
                        <div class="flex flex-wrap gap-1.5">
                            <span class="rounded-md bg-surface-secondary px-2 py-0.5 text-[11px] font-semibold text-text-tertiary">{{ __('Digital work order') }}</span>
                            <span class="rounded-md bg-surface-secondary px-2 py-0.5 text-[11px] font-semibold text-text-tertiary">{{ __('Service') }}</span>
                        </div>
                    </div>

                    <h3 class="mb-2 text-lg font-bold text-text-primary">{{ __('Digital work order: offline mode and photo notes for field work') }}</h3>
                    <p class="mb-5 text-sm leading-relaxed text-text-secondary">{{ __('Service technicians can now fill out digital work orders without an internet connection — data syncs automatically when the network returns.') }}</p>

                    <div class="space-y-2">
                        <div class="flex items-start gap-3">
                            <span class="mt-0.5 flex h-5 w-5 shrink-0 items-center justify-center rounded bg-indigo-50 text-[10px] font-bold text-indigo-600">+</span>
                            <span class="text-sm text-text-secondary">{{ __('Offline mode: complete work order filling without network, automatic sync on reconnection') }}</span>
                        </div>
                        <div class="flex items-start gap-3">
                            <span class="mt-0.5 flex h-5 w-5 shrink-0 items-center justify-center rounded bg-indigo-50 text-[10px] font-bold text-indigo-600">+</span>
                            <span class="text-sm text-text-secondary">{{ __('Text notes on photos: technician takes photos and comments on-site, customer sees them in the service report') }}</span>
                        </div>
                        <div class="flex items-start gap-3">
                            <span class="mt-0.5 flex h-5 w-5 shrink-0 items-center justify-center rounded bg-emerald-50 text-[10px] font-bold text-emerald-600">&#8593;</span>
                            <span class="text-sm text-text-secondary">{{ __('Work order PDF generation sped up: 3.2s → 0.8s average generation time') }}</span>
                        </div>
                    </div>
                </div>

                {{-- Entry 3: Jogosultságkezelés --}}
                <div class="rounded-2xl border border-border-light bg-surface-primary p-6 transition-all hover:border-border-default lg:p-8" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);"
                    x-show="activeFilter === 'all' || activeFilter === 'fix'" x-transition>
                    <div class="mb-4 flex flex-wrap items-start justify-between gap-3">
                        <div class="flex flex-wrap items-center gap-2">
                            <span class="text-xs font-semibold text-text-tertiary" style="font-family: 'JetBrains Mono', monospace;">{{ __('Feb 2, 2026') }}</span>
                            <span class="rounded-md bg-rose-50 px-2.5 py-0.5 text-[11px] font-bold uppercase tracking-wider text-rose-600">{{ __('Bug fix') }}</span>
                            <span class="rounded-md bg-gray-100 px-2.5 py-0.5 text-[11px] font-bold uppercase tracking-wider text-gray-600">{{ __('Security') }}</span>
                        </div>
                        <div class="flex flex-wrap gap-1.5">
                            <span class="rounded-md bg-surface-secondary px-2 py-0.5 text-[11px] font-semibold text-text-tertiary">{{ __('System') }}</span>
                            <span class="rounded-md bg-surface-secondary px-2 py-0.5 text-[11px] font-semibold text-text-tertiary">{{ __('Permissions') }}</span>
                        </div>
                    </div>

                    <h3 class="mb-2 text-lg font-bold text-text-primary">{{ __('Permission management fix and security update') }}</h3>
                    <p class="mb-5 text-sm leading-relaxed text-text-secondary">{{ __('We fixed three permission bugs that allowed unintended access with specific role combinations. We also updated session management.') }}</p>

                    <div class="space-y-2">
                        <div class="flex items-start gap-3">
                            <span class="mt-0.5 flex h-5 w-5 shrink-0 items-center justify-center rounded bg-rose-50 text-[10px] font-bold text-rose-600">&#10005;</span>
                            <span class="text-sm text-text-secondary">{{ __('Fixed: "Service tech + Warehouse" combined role granted unintended access to the finance module') }}</span>
                        </div>
                        <div class="flex items-start gap-3">
                            <span class="mt-0.5 flex h-5 w-5 shrink-0 items-center justify-center rounded bg-rose-50 text-[10px] font-bold text-rose-600">&#10005;</span>
                            <span class="text-sm text-text-secondary">{{ __('Fixed: inactive users\' tokens did not expire properly in certain cases') }}</span>
                        </div>
                        <div class="flex items-start gap-3">
                            <span class="mt-0.5 flex h-5 w-5 shrink-0 items-center justify-center rounded bg-emerald-50 text-[10px] font-bold text-emerald-600">&#8593;</span>
                            <span class="text-sm text-text-secondary">{{ __('Session timeout: 60 min → 30 min auto-logout after inactivity (configurable)') }}</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- 2026. Január --}}
            <div class="reveal mb-16">
                <div class="mb-6 flex items-center gap-4 border-b border-border-light pb-4">
                    <span class="text-base font-bold text-text-primary" style="font-family: 'JetBrains Mono', monospace;">{{ __('January 2026') }}</span>
                    <span class="rounded-md bg-indigo-50 px-2.5 py-0.5 text-[11px] font-bold text-indigo-600">{{ __(':count updates', ['count' => 4]) }}</span>
                    <span class="h-px flex-1 bg-border-light"></span>
                </div>

                {{-- Entry 4: MarketingHub --}}
                <div class="mb-4 rounded-2xl border border-border-light bg-surface-primary p-6 transition-all hover:border-border-default lg:p-8" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);"
                    x-show="activeFilter === 'all' || activeFilter === 'new' || activeFilter === 'integration'" x-transition>
                    <div class="mb-4 flex flex-wrap items-start justify-between gap-3">
                        <div class="flex flex-wrap items-center gap-2">
                            <span class="text-xs font-semibold text-text-tertiary" style="font-family: 'JetBrains Mono', monospace;">{{ __('Jan 25, 2026') }}</span>
                            <span class="rounded-md bg-indigo-50 px-2.5 py-0.5 text-[11px] font-bold uppercase tracking-wider text-indigo-600">{{ __('New feature') }}</span>
                            <span class="rounded-md bg-blue-50 px-2.5 py-0.5 text-[11px] font-bold uppercase tracking-wider text-blue-600">{{ __('Integration') }}</span>
                        </div>
                        <div class="flex flex-wrap gap-1.5">
                            <span class="rounded-md bg-surface-secondary px-2 py-0.5 text-[11px] font-semibold text-text-tertiary">MarketingHub</span>
                            <span class="rounded-md bg-surface-secondary px-2 py-0.5 text-[11px] font-semibold text-text-tertiary">CRM</span>
                        </div>
                    </div>

                    <h3 class="mb-2 text-lg font-bold text-text-primary">{{ __('MarketingHub: newsletter campaigns built on CRM data') }}</h3>
                    <p class="mb-5 text-sm leading-relaxed text-text-secondary">{{ __('MarketingHub now sends newsletters directly to CRM segments — no need to export, import, or sync. When the customer segment changes, the newsletter list automatically follows.') }}</p>

                    <div class="mb-5 space-y-2">
                        <div class="flex items-start gap-3">
                            <span class="mt-0.5 flex h-5 w-5 shrink-0 items-center justify-center rounded bg-indigo-50 text-[10px] font-bold text-indigo-600">+</span>
                            <span class="text-sm text-text-secondary">{{ __('CRM segment-based newsletter sending: selectable filters (industry, size, activity, deal status)') }}</span>
                        </div>
                        <div class="flex items-start gap-3">
                            <span class="mt-0.5 flex h-5 w-5 shrink-0 items-center justify-center rounded bg-indigo-50 text-[10px] font-bold text-indigo-600">+</span>
                            <span class="text-sm text-text-secondary">{{ __('Drag-and-drop newsletter editor: templates, images, CTA buttons, personalized fields') }}</span>
                        </div>
                        <div class="flex items-start gap-3">
                            <span class="mt-0.5 flex h-5 w-5 shrink-0 items-center justify-center rounded bg-indigo-50 text-[10px] font-bold text-indigo-600">+</span>
                            <span class="text-sm text-text-secondary">{{ __('Campaign analytics: opens, clicks, conversions — linked back to CRM deal pipeline') }}</span>
                        </div>
                        <div class="flex items-start gap-3">
                            <span class="mt-0.5 flex h-5 w-5 shrink-0 items-center justify-center rounded bg-indigo-50 text-[10px] font-bold text-indigo-600">+</span>
                            <span class="text-sm text-text-secondary">{{ __('A/B testing: automatic evaluation of subject line and content variants') }}</span>
                        </div>
                    </div>

                    <div class="rounded-xl border border-border-light bg-surface-secondary p-5 text-center">
                        <span class="mb-1 block text-2xl opacity-40">&#128231;</span>
                        <span class="text-xs font-semibold text-text-tertiary">{{ __('Screenshot: MarketingHub newsletter editor') }}</span>
                    </div>
                </div>

                {{-- Entry 5: Kontrolling --}}
                <div class="mb-4 rounded-2xl border border-border-light bg-surface-primary p-6 transition-all hover:border-border-default lg:p-8" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);"
                    x-show="activeFilter === 'all' || activeFilter === 'new'" x-transition>
                    <div class="mb-4 flex flex-wrap items-start justify-between gap-3">
                        <div class="flex flex-wrap items-center gap-2">
                            <span class="text-xs font-semibold text-text-tertiary" style="font-family: 'JetBrains Mono', monospace;">{{ __('Jan 18, 2026') }}</span>
                            <span class="rounded-md bg-indigo-50 px-2.5 py-0.5 text-[11px] font-bold uppercase tracking-wider text-indigo-600">{{ __('New feature') }}</span>
                        </div>
                        <div class="flex flex-wrap gap-1.5">
                            <span class="rounded-md bg-surface-secondary px-2 py-0.5 text-[11px] font-semibold text-text-tertiary">{{ __('Controlling') }}</span>
                            <span class="rounded-md bg-surface-secondary px-2 py-0.5 text-[11px] font-semibold text-text-tertiary">{{ __('Dashboards') }}</span>
                        </div>
                    </div>

                    <h3 class="mb-2 text-lg font-bold text-text-primary">{{ __('Controlling: cash flow forecast and cash flow dashboard') }}</h3>
                    <p class="mb-5 text-sm leading-relaxed text-text-secondary">{{ __('The Controlling module now shows not only historical data — but also 30, 60, and 90-day cash flow forecasts based on issued invoices, supplier obligations, and contractual revenues.') }}</p>

                    <div class="space-y-2">
                        <div class="flex items-start gap-3">
                            <span class="mt-0.5 flex h-5 w-5 shrink-0 items-center justify-center rounded bg-indigo-50 text-[10px] font-bold text-indigo-600">+</span>
                            <span class="text-sm text-text-secondary">{{ __('Cash flow forecast: 30/60/90-day chart of expected inflows and outflows') }}</span>
                        </div>
                        <div class="flex items-start gap-3">
                            <span class="mt-0.5 flex h-5 w-5 shrink-0 items-center justify-center rounded bg-indigo-50 text-[10px] font-bold text-indigo-600">+</span>
                            <span class="text-sm text-text-secondary">{{ __('Payment discipline report: average payment days per customer, trend line, alerts') }}</span>
                        </div>
                        <div class="flex items-start gap-3">
                            <span class="mt-0.5 flex h-5 w-5 shrink-0 items-center justify-center rounded bg-emerald-50 text-[10px] font-bold text-emerald-600">&#8593;</span>
                            <span class="text-sm text-text-secondary">{{ __('Dashboard widgets: 2 new financial widgets for the CEO and financial dashboards') }}</span>
                        </div>
                    </div>
                </div>

                {{-- Entry 6: Teljesítmény --}}
                <div class="mb-4 rounded-2xl border border-border-light bg-surface-primary p-6 transition-all hover:border-border-default lg:p-8" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);"
                    x-show="activeFilter === 'all' || activeFilter === 'improvement'" x-transition>
                    <div class="mb-4 flex flex-wrap items-start justify-between gap-3">
                        <div class="flex flex-wrap items-center gap-2">
                            <span class="text-xs font-semibold text-text-tertiary" style="font-family: 'JetBrains Mono', monospace;">{{ __('Jan 10, 2026') }}</span>
                            <span class="rounded-md bg-emerald-50 px-2.5 py-0.5 text-[11px] font-bold uppercase tracking-wider text-emerald-600">{{ __('Improvement') }}</span>
                            <span class="rounded-md bg-orange-50 px-2.5 py-0.5 text-[11px] font-bold uppercase tracking-wider text-orange-600">{{ __('Performance') }}</span>
                        </div>
                        <div class="flex flex-wrap gap-1.5">
                            <span class="rounded-md bg-surface-secondary px-2 py-0.5 text-[11px] font-semibold text-text-tertiary">{{ __('System') }}</span>
                        </div>
                    </div>

                    <h3 class="mb-2 text-lg font-bold text-text-primary">{{ __('System-level performance optimization') }}</h3>
                    <p class="mb-5 text-sm leading-relaxed text-text-secondary">{{ __('As a result of the January performance sprint, the platform\'s average response time decreased by 40%, and dashboard loading times were nearly halved.') }}</p>

                    <div class="space-y-2">
                        <div class="flex items-start gap-3">
                            <span class="mt-0.5 flex h-5 w-5 shrink-0 items-center justify-center rounded bg-emerald-50 text-[10px] font-bold text-emerald-600">&#8593;</span>
                            <span class="text-sm text-text-secondary">{{ __('API response time: 320ms → 190ms average (p95: 800ms → 450ms)') }}</span>
                        </div>
                        <div class="flex items-start gap-3">
                            <span class="mt-0.5 flex h-5 w-5 shrink-0 items-center justify-center rounded bg-emerald-50 text-[10px] font-bold text-emerald-600">&#8593;</span>
                            <span class="text-sm text-text-secondary">{{ __('Dashboard loading: 2.1s → 1.2s (with 40+ widgets)') }}</span>
                        </div>
                        <div class="flex items-start gap-3">
                            <span class="mt-0.5 flex h-5 w-5 shrink-0 items-center justify-center rounded bg-emerald-50 text-[10px] font-bold text-emerald-600">&#8593;</span>
                            <span class="text-sm text-text-secondary">{{ __('List view pagination: instant response when searching with 10,000+ records') }}</span>
                        </div>
                    </div>
                </div>

                {{-- Entry 7: Ügyfélportál béta --}}
                <div class="rounded-2xl border border-border-light bg-surface-primary p-6 transition-all hover:border-border-default lg:p-8" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);"
                    x-show="activeFilter === 'all' || activeFilter === 'new'" x-transition>
                    <div class="mb-4 flex flex-wrap items-start justify-between gap-3">
                        <div class="flex flex-wrap items-center gap-2">
                            <span class="text-xs font-semibold text-text-tertiary" style="font-family: 'JetBrains Mono', monospace;">{{ __('Jan 3, 2026') }}</span>
                            <span class="rounded-md bg-indigo-50 px-2.5 py-0.5 text-[11px] font-bold uppercase tracking-wider text-indigo-600">{{ __('New feature') }}</span>
                            <span class="rounded-md bg-amber-50 px-2.5 py-0.5 text-[11px] font-bold uppercase tracking-wider text-amber-600">{{ __('Beta') }}</span>
                        </div>
                        <div class="flex flex-wrap gap-1.5">
                            <span class="rounded-md bg-surface-secondary px-2 py-0.5 text-[11px] font-semibold text-text-tertiary">{{ __('Customer portal') }}</span>
                        </div>
                    </div>

                    <h3 class="mb-2 text-lg font-bold text-text-primary">{{ __('Customer portal beta: customers can track their orders on their own interface') }}</h3>
                    <p class="mb-5 text-sm leading-relaxed text-text-secondary">{{ __('The customer portal allows B2B partners to log in and see order status, invoice status, service ticket progress, and warranty information in real time — without having to call.') }}</p>

                    <div class="space-y-2">
                        <div class="flex items-start gap-3">
                            <span class="mt-0.5 flex h-5 w-5 shrink-0 items-center justify-center rounded bg-indigo-50 text-[10px] font-bold text-indigo-600">+</span>
                            <span class="text-sm text-text-secondary">{{ __('Order tracking: B2B customer sees order status on the portal (submitted → in production → shipping → closed)') }}</span>
                        </div>
                        <div class="flex items-start gap-3">
                            <span class="mt-0.5 flex h-5 w-5 shrink-0 items-center justify-center rounded bg-indigo-50 text-[10px] font-bold text-indigo-600">+</span>
                            <span class="text-sm text-text-secondary">{{ __('Invoice history: all issued invoices, payment status, downloadable PDF') }}</span>
                        </div>
                        <div class="flex items-start gap-3">
                            <span class="mt-0.5 flex h-5 w-5 shrink-0 items-center justify-center rounded bg-indigo-50 text-[10px] font-bold text-indigo-600">+</span>
                            <span class="text-sm text-text-secondary">{{ __('Service ticket portal: customer can open, comment on, and track their service tickets') }}</span>
                        </div>
                        <div class="flex items-start gap-3">
                            <span class="mt-0.5 flex h-5 w-5 shrink-0 items-center justify-center rounded bg-indigo-50 text-[10px] font-bold text-indigo-600">+</span>
                            <span class="text-sm text-text-secondary">{{ __('Warranty registry: customer sees warranty expiration dates and related service history') }}</span>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

    {{-- Stats Section --}}
    <section class="bg-surface-primary py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-6">
            <div class="reveal mb-12 text-center">
                <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-indigo-600">{{ __('Development pace') }}</p>
                <h2 class="text-3xl text-text-primary md:text-4xl" style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                    {{ __('Cégem360 is continuously evolving') }}
                </h2>
            </div>

            <div class="grid grid-cols-2 gap-5 lg:grid-cols-4" data-stagger data-counter-trigger>
                <div class="stagger-item stat-hover rounded-2xl border border-border-light bg-surface-primary p-8 text-center" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <span class="stat-value block text-4xl font-bold text-indigo-600 lg:text-5xl" style="font-family: 'JetBrains Mono', monospace;"
                        data-count="Havi">0</span>
                    <span class="mt-2 block text-sm text-text-secondary">{{ __('Update cycle') }}</span>
                </div>
                <div class="stagger-item stat-hover rounded-2xl border border-border-light bg-surface-primary p-8 text-center" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <span class="stat-value block text-4xl font-bold text-emerald-600 lg:text-5xl" style="font-family: 'JetBrains Mono', monospace;"
                        data-count="11">0</span>
                    <span class="mt-2 block text-sm text-text-secondary">{{ __('Active modules') }}</span>
                </div>
                <div class="stagger-item stat-hover rounded-2xl border border-border-light bg-surface-primary p-8 text-center" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <span class="stat-value block text-4xl font-bold text-amber-600 lg:text-5xl" style="font-family: 'JetBrains Mono', monospace;"
                        data-count="40" data-suffix="+">0</span>
                    <span class="mt-2 block text-sm text-text-secondary">{{ __('Dashboard widgets') }}</span>
                </div>
                <div class="stagger-item stat-hover rounded-2xl border border-border-light bg-surface-primary p-8 text-center" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <span class="stat-value block text-4xl font-bold text-violet-600 lg:text-5xl" style="font-family: 'JetBrains Mono', monospace;"
                        data-count="100" data-suffix="%">0</span>
                    <span class="mt-2 block text-sm text-text-secondary">{{ __('Customer feedback-based') }}</span>
                </div>
            </div>
        </div>
    </section>

    {{-- Roadmap Section --}}
    <section class="bg-surface-secondary py-16 lg:py-24" id="roadmap">
        <div class="mx-auto max-w-7xl px-6">
            <div class="reveal mb-12">
                <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-indigo-600">{{ __('Development plan') }}</p>
                <h2 class="mb-4 text-3xl text-text-primary md:text-4xl" style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                    {{ __('What we\'re working on now — and what\'s next') }}
                </h2>
                <p class="max-w-xl text-lg text-text-secondary">
                    {{ __('The roadmap is shaped by customer feedback. If you have a suggestion — we\'d love to hear it.') }}
                </p>
            </div>

            <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3" data-stagger>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-7" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <span class="mb-4 inline-flex items-center gap-1.5 rounded-md bg-indigo-50 px-2.5 py-1 text-[11px] font-bold uppercase tracking-wider text-indigo-600">
                        <span class="inline-block h-1.5 w-1.5 rounded-full bg-indigo-500 pulse-dot"></span>
                        {{ __('In development') }}
                    </span>
                    <h3 class="mb-2 text-base font-bold text-text-primary">{{ __('SEO module — technical audit and keyword tracking') }}</h3>
                    <p class="mb-4 text-sm leading-relaxed text-text-secondary">{{ __('Extending MarketingHub with SEO tools: technical page audit, keyword position tracking, on-page suggestions, competitor analysis.') }}</p>
                    <div class="flex flex-wrap gap-1.5">
                        <span class="rounded-md bg-surface-secondary px-2 py-0.5 text-[11px] font-semibold text-text-tertiary">MarketingHub</span>
                        <span class="rounded-md bg-surface-secondary px-2 py-0.5 text-[11px] font-semibold text-text-tertiary">SEO</span>
                    </div>
                </div>

                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-7" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <span class="mb-4 inline-flex items-center gap-1.5 rounded-md bg-violet-50 px-2.5 py-1 text-[11px] font-bold uppercase tracking-wider text-violet-600">
                        <span class="inline-block h-1.5 w-1.5 rounded-full bg-violet-500"></span>
                        {{ __('Planned') }}
                    </span>
                    <h3 class="mb-2 text-base font-bold text-text-primary">{{ __('Multi-currency invoicing and exchange rate management') }}</h3>
                    <p class="mb-4 text-sm leading-relaxed text-text-secondary">{{ __('EUR/USD/CHF exchange rate automation, multi-currency quote creation, exchange rate difference management in controlling.') }}</p>
                    <div class="flex flex-wrap gap-1.5">
                        <span class="rounded-md bg-surface-secondary px-2 py-0.5 text-[11px] font-semibold text-text-tertiary">{{ __('Sales') }}</span>
                        <span class="rounded-md bg-surface-secondary px-2 py-0.5 text-[11px] font-semibold text-text-tertiary">{{ __('Controlling') }}</span>
                    </div>
                </div>

                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-7" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <span class="mb-4 inline-flex items-center gap-1.5 rounded-md bg-amber-50 px-2.5 py-1 text-[11px] font-bold uppercase tracking-wider text-amber-600">
                        <span class="inline-block h-1.5 w-1.5 rounded-full bg-amber-500"></span>
                        {{ __('Research') }}
                    </span>
                    <h3 class="mb-2 text-base font-bold text-text-primary">{{ __('Mobile app — service technician and warehouse view') }}</h3>
                    <p class="mb-4 text-sm leading-relaxed text-text-secondary">{{ __('Native mobile app for the most common field tasks: work order, inventory, service ticket, photo, signature — with offline capability.') }}</p>
                    <div class="flex flex-wrap gap-1.5">
                        <span class="rounded-md bg-surface-secondary px-2 py-0.5 text-[11px] font-semibold text-text-tertiary">{{ __('Service') }}</span>
                        <span class="rounded-md bg-surface-secondary px-2 py-0.5 text-[11px] font-semibold text-text-tertiary">{{ __('Work order') }}</span>
                        <span class="rounded-md bg-surface-secondary px-2 py-0.5 text-[11px] font-semibold text-text-tertiary">{{ __('Warehouse') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Subscribe Section --}}
    <section class="bg-surface-primary py-16 lg:py-24" id="feliratkozas">
        <div class="mx-auto max-w-7xl px-6">
            <div class="reveal mb-12">
                <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-indigo-600">{{ __('Notifications') }}</p>
                <h2 class="text-3xl text-text-primary md:text-4xl" style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                    {{ __('Be the first to know about updates') }}
                </h2>
            </div>

            <div class="reveal">
                <div class="grid items-center gap-10 rounded-2xl border border-border-light bg-surface-primary p-8 lg:grid-cols-2 lg:p-12" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div>
                        <h3 class="mb-2 text-xl font-bold text-text-primary">{{ __('Get notified about every update') }}</h3>
                        <p class="text-sm leading-relaxed text-text-secondary">{{ __('Choose how you\'d like to be notified about Cégem360 updates. We don\'t spam — we only write when there\'s something worth sharing.') }}</p>
                    </div>
                    <div class="flex flex-col gap-3 sm:flex-row lg:flex-col">
                        <a href="{{ route('contact') }}" class="flex items-center gap-3 rounded-xl border border-border-light bg-surface-secondary p-4 transition-all hover:border-indigo-200 hover:shadow-md">
                            <span class="text-xl">&#128231;</span>
                            <div>
                                <h4 class="text-sm font-bold text-text-primary">{{ __('Newsletter') }}</h4>
                                <p class="text-xs text-text-tertiary">{{ __('Monthly summary via email') }}</p>
                            </div>
                        </a>
                        <a href="{{ route('contact') }}" class="flex items-center gap-3 rounded-xl border border-border-light bg-surface-secondary p-4 transition-all hover:border-indigo-200 hover:shadow-md">
                            <span class="text-xl">&#128225;</span>
                            <div>
                                <h4 class="text-sm font-bold text-text-primary">{{ __('RSS feed') }}</h4>
                                <p class="text-xs text-text-tertiary">{{ __('Automatic updates in your RSS reader') }}</p>
                            </div>
                        </a>
                        <a href="{{ route('contact') }}" class="flex items-center gap-3 rounded-xl border border-border-light bg-surface-secondary p-4 transition-all hover:border-indigo-200 hover:shadow-md">
                            <span class="text-xl">&#128188;</span>
                            <div>
                                <h4 class="text-sm font-bold text-text-primary">LinkedIn</h4>
                                <p class="text-xs text-text-tertiary">{{ __('Follow the Cégem360 page') }}</p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- CTA Section --}}
    <section class="bg-linear-to-b from-surface-secondary to-surface-primary py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-6">
            <div class="reveal">
                <div class="rounded-2xl border border-indigo-100 bg-indigo-50/30 p-10 text-center lg:p-16" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <h3 class="mb-4 text-2xl font-bold text-text-primary lg:text-3xl" style="font-family: 'Poppins', sans-serif; font-weight: 600;">{{ __('Curious about the new features?') }}</h3>
                    <p class="mx-auto mb-8 max-w-xl text-base text-text-secondary">{{ __('Register and try the latest version of Cégem360 — all new features are immediately available to active subscribers, at no extra cost.') }}</p>

                    <div class="flex flex-wrap items-center justify-center gap-4">
                        <a href="{{ route('contact') }}"
                            class="group inline-flex items-center gap-2 rounded-full bg-indigo-600 px-6 py-3 text-base font-medium text-white transition-all hover:bg-indigo-700 hover:shadow-lg"
                            style="box-shadow: 0 1px 2px rgba(0,0,0,0.05);">
                            <span>{{ __('Book a consultation') }}</span>
                            <svg class="arrow-slide h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" /></svg>
                        </a>
                        <a href="{{ route('register') }}"
                            class="inline-flex items-center gap-2 rounded-full border border-border-light bg-surface-primary px-6 py-3 text-base font-medium text-text-primary transition-all hover:border-indigo-200 hover:shadow-md">
                            {{ __('Register and try it') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>
