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
            0% { box-shadow: 0 0 0 0 rgba(139, 92, 246, 0.4); }
            70% { box-shadow: 0 0 0 6px rgba(139, 92, 246, 0); }
            100% { box-shadow: 0 0 0 0 rgba(139, 92, 246, 0); }
        }
        .pulse-dot { animation: pulse-ring 2s ease infinite; }

        .card-glow { transition: all 0.4s cubic-bezier(0,0,0.2,1); }
        .card-glow:hover { box-shadow: 0 8px 30px -8px rgba(139, 92, 246, 0.15), 0 2px 8px rgba(0,0,0,0.04) !important; }

        .icon-hover { transition: transform 0.35s cubic-bezier(0,0,0.2,1.4); }
        .group:hover .icon-hover, .card-glow:hover .icon-hover { transform: translateY(-3px) scale(1.08); }

        .arrow-slide { transition: transform 0.3s cubic-bezier(0,0,0.2,1); }
        .group:hover .arrow-slide, a:hover .arrow-slide { transform: translateX(4px); }

        .stat-hover .stat-value { transition: transform 0.4s cubic-bezier(0,0,0.2,1.4); }
        .stat-hover:hover .stat-value { transform: scale(1.08); }

        .feature-dot { transition: transform 0.3s cubic-bezier(0,0,0.2,1); }
        .card-glow:hover .feature-dot { transform: scale(1.5); }

        @keyframes crown-pulse { 0%, 100% { opacity: 1; } 50% { opacity: 0.5; } }
        .crown-pulse { animation: crown-pulse 2s ease infinite; }

        /* Module health bar animation */
        @keyframes mod-grow {
            from { transform: scaleX(0); transform-origin: left; }
            to { transform: scaleX(1); transform-origin: left; }
        }
        .mod-bar { animation: mod-grow 0.8s cubic-bezier(0, 0, 0.2, 1) both; }

        .pill-float { transition: transform 0.35s cubic-bezier(0,0,0.2,1), box-shadow 0.35s cubic-bezier(0,0,0.2,1); }
        .pill-float:hover { transform: translateY(-3px); box-shadow: 0 6px 20px -4px rgba(139, 92, 246, 0.12); }

        html { scroll-behavior: smooth; }
    </style>

    {{-- Hero Section --}}
    <section class="bg-linear-to-b from-violet-50 to-surface-secondary">
        <div class="mx-auto max-w-7xl px-6 py-16 lg:py-24">
            <div class="grid grid-cols-1 items-center gap-12 lg:grid-cols-2">
                {{-- Hero Text --}}
                <div class="reveal">
                    <div class="badge-gradient mb-8 inline-flex items-center gap-2 rounded-full border border-border-light/80 bg-surface-primary px-4 py-1.5"
                        style="box-shadow: 0 1px 3px rgba(0,0,0,0.04);">
                        <span class="pulse-dot h-1.5 w-1.5 rounded-full bg-linear-to-r from-violet-500 via-amber-500 to-yellow-500"></span>
                        <span class="text-sm font-medium text-text-primary">{{ __('Executive decision support for industrial companies') }}</span>
                    </div>

                    <h1 class="mb-6 text-4xl leading-tight tracking-tight text-text-primary md:text-5xl lg:text-[3.5rem]"
                        style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                        {{ __('The entire company — on a single') }}<br>
                        {{ __('dashboard, every morning') }}
                    </h1>

                    <p class="mb-10 max-w-xl text-lg text-text-secondary lg:text-xl">
                        {{ __('Industrial executives don\'t need more data — they need better overview. Cégem360 consolidates data from all 11 modules into a single executive dashboard: revenue, production, service, procurement, marketing — with AI summary, every morning.') }}
                    </p>

                    <div class="flex flex-wrap items-center gap-4">
                        <a href="{{ route('contact') }}"
                            class="group inline-flex items-center gap-2 rounded-full bg-violet-600 px-6 py-3 text-base font-medium text-white transition-all hover:bg-violet-700 hover:shadow-lg"
                            style="box-shadow: 0 1px 2px rgba(0,0,0,0.05);">
                            <span>{{ __('Online consultation') }}</span>
                            <svg class="arrow-slide h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" /></svg>
                        </a>
                        <a href="#megoldasok"
                            class="inline-flex items-center gap-2 rounded-full border border-border-light bg-surface-primary px-6 py-3 text-base font-medium text-text-primary transition-all hover:border-violet-200 hover:bg-surface-secondary hover:shadow-md">
                            {{ __('Solutions overview') }}
                        </a>
                    </div>
                </div>

                {{-- CEO Command Center Visual --}}
                <div class="reveal-right">
                    <div class="rounded-2xl border border-border-light bg-surface-primary p-6"
                        style="box-shadow: 0 4px 20px -4px rgba(0,0,0,0.06);">
                        <div class="mb-4 flex items-center justify-between border-b border-border-light pb-4">
                            <div>
                                <span class="block text-sm font-bold text-text-primary">{{ __('Executive command center') }}</span>
                                <span class="block text-[10px] text-text-tertiary">{{ __('Full company overview · Real-time') }}</span>
                            </div>
                            <span class="inline-flex items-center gap-1.5 rounded-md border border-amber-100 bg-linear-to-r from-amber-50 to-violet-50 px-2.5 py-1 text-[10px] font-semibold text-amber-600">
                                <span class="crown-pulse">★</span>
                                CEO Dashboard
                            </span>
                        </div>

                        {{-- KPI Cards Row 1: 3 items --}}
                        <div class="mb-2 grid grid-cols-3 gap-2">
                            <div class="rounded-lg border border-border-light bg-surface-secondary p-2 text-center">
                                <span class="block text-lg font-bold text-success-600" style="font-family: 'JetBrains Mono', monospace;">248M</span>
                                <span class="block text-[9px] font-semibold uppercase tracking-wider text-text-tertiary">{{ __('Revenue') }}</span>
                                <span class="block text-[9px] font-semibold text-success-600">▲ +12%</span>
                            </div>
                            <div class="rounded-lg border border-border-light bg-surface-secondary p-2 text-center">
                                <span class="block text-lg font-bold text-violet-600" style="font-family: 'JetBrains Mono', monospace;">16.6%</span>
                                <span class="block text-[9px] font-semibold uppercase tracking-wider text-text-tertiary">{{ __('EBITDA margin') }}</span>
                                <span class="block text-[9px] font-semibold text-success-600">▲ +2.1pp</span>
                            </div>
                            <div class="rounded-lg border border-border-light bg-surface-secondary p-2 text-center">
                                <span class="block text-lg font-bold text-amber-600" style="font-family: 'JetBrains Mono', monospace;">78%</span>
                                <span class="block text-[9px] font-semibold uppercase tracking-wider text-text-tertiary">OEE</span>
                                <span class="block text-[9px] font-semibold text-success-600">▲ +5%</span>
                            </div>
                        </div>

                        {{-- KPI Cards Row 2: 2 items --}}
                        <div class="mb-4 grid grid-cols-2 gap-2">
                            <div class="rounded-lg border border-border-light bg-surface-secondary p-2 text-center">
                                <span class="block text-lg font-bold text-blue-600" style="font-family: 'JetBrains Mono', monospace;">94%</span>
                                <span class="block text-[9px] font-semibold uppercase tracking-wider text-text-tertiary">CSAT</span>
                                <span class="block text-[9px] font-semibold text-success-600">▲ +3%</span>
                            </div>
                            <div class="rounded-lg border border-border-light bg-surface-secondary p-2 text-center">
                                <span class="block text-lg font-bold text-success-600" style="font-family: 'JetBrains Mono', monospace;">32M</span>
                                <span class="block text-[9px] font-semibold uppercase tracking-wider text-text-tertiary">{{ __('Pipeline value') }}</span>
                                <span class="block text-[9px] font-semibold text-success-600">▲ +18%</span>
                            </div>
                        </div>

                        {{-- Module Health Bars --}}
                        <div class="mb-4 space-y-2">
                            <div>
                                <div class="mb-0.5 flex items-center justify-between">
                                    <span class="text-[10px] font-bold uppercase tracking-wider text-text-tertiary">{{ __('Sales') }}</span>
                                    <span class="text-[10px] font-bold text-text-tertiary" style="font-family: 'JetBrains Mono', monospace;">92%</span>
                                </div>
                                <div class="h-3 w-full rounded bg-surface-secondary">
                                    <div class="mod-bar h-3 rounded bg-success-400" style="width: 92%; animation-delay: 0.1s;"></div>
                                </div>
                            </div>
                            <div>
                                <div class="mb-0.5 flex items-center justify-between">
                                    <span class="text-[10px] font-bold uppercase tracking-wider text-text-tertiary">{{ __('Manufacturing') }}</span>
                                    <span class="text-[10px] font-bold text-text-tertiary" style="font-family: 'JetBrains Mono', monospace;">78%</span>
                                </div>
                                <div class="h-3 w-full rounded bg-surface-secondary">
                                    <div class="mod-bar h-3 rounded bg-violet-400" style="width: 78%; animation-delay: 0.2s;"></div>
                                </div>
                            </div>
                            <div>
                                <div class="mb-0.5 flex items-center justify-between">
                                    <span class="text-[10px] font-bold uppercase tracking-wider text-text-tertiary">{{ __('Procurement') }}</span>
                                    <span class="text-[10px] font-bold text-text-tertiary" style="font-family: 'JetBrains Mono', monospace;">85%</span>
                                </div>
                                <div class="h-3 w-full rounded bg-surface-secondary">
                                    <div class="mod-bar h-3 rounded bg-amber-400" style="width: 85%; animation-delay: 0.3s;"></div>
                                </div>
                            </div>
                            <div>
                                <div class="mb-0.5 flex items-center justify-between">
                                    <span class="text-[10px] font-bold uppercase tracking-wider text-text-tertiary">{{ __('Service') }}</span>
                                    <span class="text-[10px] font-bold text-text-tertiary" style="font-family: 'JetBrains Mono', monospace;">64%</span>
                                </div>
                                <div class="h-3 w-full rounded bg-surface-secondary">
                                    <div class="mod-bar h-3 rounded bg-orange-400" style="width: 64%; animation-delay: 0.4s;"></div>
                                </div>
                            </div>
                        </div>

                        {{-- AI Insight --}}
                        <div class="mb-4 rounded-lg border border-violet-100 bg-linear-to-r from-violet-50 to-amber-50 p-3">
                            <div class="mb-2 flex items-center gap-2">
                                <div class="flex h-6 w-6 items-center justify-center rounded-md bg-linear-to-br from-violet-500 to-amber-500 text-[9px] font-bold text-white">AI</div>
                                <span class="text-xs font-bold text-violet-600">{{ __('DataMind — Morning summary') }}</span>
                            </div>
                            <p class="text-[11px] leading-relaxed text-text-secondary">
                                {{ __('Q1 revenue') }} <strong class="text-amber-600">{{ __('exceeds plan by 12%') }}</strong>. {{ __('Attention: service SLA performance dropped to 64% — I recommend reviewing capacity expansion. DataMind prediction suggests') }} <strong class="text-amber-600">{{ __('cash flow may tighten in March') }}</strong> {{ __('due to large project procurement.') }}
                            </p>
                        </div>

                        {{-- Alert Rows --}}
                        <div class="space-y-1">
                            <div class="flex items-center justify-between rounded-lg bg-surface-secondary px-3 py-1.5">
                                <div class="flex items-center gap-2">
                                    <span class="h-1.5 w-1.5 rounded-full bg-success-500"></span>
                                    <span class="text-[11px] text-text-secondary">{{ __('New framework agreement signed: TechBuild Kft. — 18M Ft/year') }}</span>
                                </div>
                                <span class="text-[10px] text-text-tertiary" style="font-family: 'JetBrains Mono', monospace;">{{ __('2 hours') }}</span>
                            </div>
                            <div class="flex items-center justify-between rounded-lg bg-surface-secondary px-3 py-1.5">
                                <div class="flex items-center gap-2">
                                    <span class="h-1.5 w-1.5 rounded-full bg-amber-500"></span>
                                    <span class="text-[11px] text-text-secondary">{{ __('Hall expansion project: 8% cost overrun') }}</span>
                                </div>
                                <span class="text-[10px] text-text-tertiary" style="font-family: 'JetBrains Mono', monospace;">{{ __('4 hours') }}</span>
                            </div>
                            <div class="flex items-center justify-between rounded-lg bg-surface-secondary px-3 py-1.5">
                                <div class="flex items-center gap-2">
                                    <span class="h-1.5 w-1.5 rounded-full bg-danger-500"></span>
                                    <span class="text-[11px] text-text-secondary">{{ __('Critical stock level: seal kit — auto. order') }}</span>
                                </div>
                                <span class="text-[10px] text-text-tertiary" style="font-family: 'JetBrains Mono', monospace;">{{ __('6 hours') }}</span>
                            </div>
                        </div>

                        {{-- Status bar --}}
                        <div class="mt-3 flex gap-5 border-t border-border-light pt-3">
                            <span class="flex items-center gap-1.5 text-[10px] text-text-tertiary">
                                <span class="h-1.5 w-1.5 rounded-full bg-violet-500"></span> {{ __('11 modules active') }}
                            </span>
                            <span class="flex items-center gap-1.5 text-[10px] text-text-tertiary">
                                <span class="h-1.5 w-1.5 rounded-full bg-success-500"></span> {{ __('Updated: 2 min ago') }}
                            </span>
                            <span class="flex items-center gap-1.5 text-[10px] text-text-tertiary">
                                <span class="h-1.5 w-1.5 rounded-full bg-amber-500"></span> {{ __('3 AI recommendations') }}
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
                <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-violet-600">{{ __('The challenge') }}</p>
                <h2 class="mb-4 text-3xl text-text-primary md:text-4xl" style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                    {{ __('These hinder strategic business management') }}
                </h2>
                <p class="max-w-xl text-lg text-text-secondary">
                    {{ __('Familiar situations for managing directors and owners of industrial companies.') }}
                </p>
            </div>

            <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4" data-stagger>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-7" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="icon-hover mb-5 flex h-12 w-12 items-center justify-center rounded-xl bg-danger-50">
                        <svg class="h-6 w-6 text-danger-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                    </div>
                    <h3 class="mb-2 text-lg font-bold text-text-primary">{{ __('No real-time overview') }}</h3>
                    <p class="text-sm leading-relaxed text-text-secondary">{{ __('The CEO learns what happened from the month-end closing. The data needed for daily decisions arrives scattered, late, in different formats.') }}</p>
                </div>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-7" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="icon-hover mb-5 flex h-12 w-12 items-center justify-center rounded-xl bg-warning-50">
                        <svg class="h-6 w-6 text-warning-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4" /></svg>
                    </div>
                    <h3 class="mb-2 text-lg font-bold text-text-primary">{{ __('Data silos and system islands') }}</h3>
                    <p class="text-sm leading-relaxed text-text-secondary">{{ __('Sales uses one system, production another, finance yet another. The CEO can\'t see connections — because the data doesn\'t talk to each other.') }}</p>
                </div>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-7" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="icon-hover mb-5 flex h-12 w-12 items-center justify-center rounded-xl bg-violet-50">
                        <svg class="h-6 w-6 text-violet-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    </div>
                    <h3 class="mb-2 text-lg font-bold text-text-primary">{{ __('Decisions based on gut feeling') }}</h3>
                    <p class="text-sm leading-relaxed text-text-secondary">{{ __('No predictive model, no AI-based recommendations. Strategic decisions are built on experience and intuition — not data-driven analysis.') }}</p>
                </div>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-7" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="icon-hover mb-5 flex h-12 w-12 items-center justify-center rounded-xl bg-amber-50">
                        <svg class="h-6 w-6 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                    </div>
                    <h3 class="mb-2 text-lg font-bold text-text-primary">{{ __('Weekly management report: manual compilation') }}</h3>
                    <p class="text-sm leading-relaxed text-text-secondary">{{ __('Everyone brings their own Excel to the management meeting. The numbers don\'t match, report preparation takes days — and it\'s still not complete.') }}</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Target Audience Section --}}
    <section class="bg-surface-secondary py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-6">
            <div class="reveal mb-12">
                <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-violet-600">{{ __('Who uses it?') }}</p>
                <h2 class="mb-4 text-3xl text-text-primary md:text-4xl" style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                    {{ __('The entire management level — from a single source of truth') }}
                </h2>
                <p class="max-w-xl text-lg text-text-secondary">
                    {{ __('Cégem360 provides relevant, real-time data at every level of executive decision-making.') }}
                </p>
            </div>

            <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4" data-stagger>
                <div class="stagger-item card-glow group relative overflow-hidden rounded-2xl border border-border-light bg-surface-primary p-7" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="absolute inset-x-0 top-0 h-0.5 bg-linear-to-r from-transparent via-violet-400 to-transparent opacity-0 transition-opacity group-hover:opacity-100"></div>
                    <span class="mb-3 block text-3xl">👔</span>
                    <span class="mb-2 block text-[10px] font-semibold uppercase tracking-wider text-violet-600">{{ __('CEO / Owner') }}</span>
                    <h3 class="mb-2 text-base font-bold text-text-primary">{{ __('CEOs and company owners') }}</h3>
                    <p class="text-sm leading-relaxed text-text-secondary">{{ __('One-minute morning summary: revenue, profit, projects, risks, AI recommendations — at a glance, every day.') }}</p>
                </div>
                <div class="stagger-item card-glow group relative overflow-hidden rounded-2xl border border-border-light bg-surface-primary p-7" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="absolute inset-x-0 top-0 h-0.5 bg-linear-to-r from-transparent via-violet-400 to-transparent opacity-0 transition-opacity group-hover:opacity-100"></div>
                    <span class="mb-3 block text-3xl">💼</span>
                    <span class="mb-2 block text-[10px] font-semibold uppercase tracking-wider text-violet-600">{{ __('CFO') }}</span>
                    <h3 class="mb-2 text-base font-bold text-text-primary">{{ __('CFOs and finance directors') }}</h3>
                    <p class="text-sm leading-relaxed text-text-secondary">{{ __('Cash flow forecasting, project profitability, cost control and automatic executive reports — in real time.') }}</p>
                </div>
                <div class="stagger-item card-glow group relative overflow-hidden rounded-2xl border border-border-light bg-surface-primary p-7" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="absolute inset-x-0 top-0 h-0.5 bg-linear-to-r from-transparent via-violet-400 to-transparent opacity-0 transition-opacity group-hover:opacity-100"></div>
                    <span class="mb-3 block text-3xl">📊</span>
                    <span class="mb-2 block text-[10px] font-semibold uppercase tracking-wider text-violet-600">{{ __('Commercial Director') }}</span>
                    <h3 class="mb-2 text-base font-bold text-text-primary">{{ __('Commercial and sales directors') }}</h3>
                    <p class="text-sm leading-relaxed text-text-secondary">{{ __('Pipeline value, conversion rates, customer satisfaction and revenue forecasting — the data-driven foundation of sales strategy.') }}</p>
                </div>
                <div class="stagger-item card-glow group relative overflow-hidden rounded-2xl border border-border-light bg-surface-primary p-7" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="absolute inset-x-0 top-0 h-0.5 bg-linear-to-r from-transparent via-violet-400 to-transparent opacity-0 transition-opacity group-hover:opacity-100"></div>
                    <span class="mb-3 block text-3xl">⚙️</span>
                    <span class="mb-2 block text-[10px] font-semibold uppercase tracking-wider text-violet-600">{{ __('Technical Director') }}</span>
                    <h3 class="mb-2 text-base font-bold text-text-primary">{{ __('Technical and production directors') }}</h3>
                    <p class="text-sm leading-relaxed text-text-secondary">{{ __('OEE, capacity utilization, service performance and procurement status — the entire operation on a single dashboard.') }}</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Core Toolkit Section --}}
    <section class="bg-surface-primary py-16 lg:py-24" id="megoldasok">
        <div class="mx-auto max-w-7xl px-6">
            <div class="reveal mb-12">
                <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-violet-600">{{ __('Executive toolkit') }}</p>
                <h2 class="mb-4 text-3xl text-text-primary md:text-4xl" style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                    {{ __('4 key modules for strategic decision support') }}
                </h2>
                <p class="max-w-xl text-lg text-text-secondary">
                    {{ __('These modules together form the Cégem360 executive intelligence layer.') }}
                </p>
            </div>

            <div class="grid grid-cols-1 gap-6 md:grid-cols-2" data-stagger>
                {{-- Kontrolling --}}
                <div class="stagger-item card-glow group rounded-2xl border border-border-light bg-surface-primary p-8" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="mb-5 flex items-center gap-4">
                        <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-violet-50">
                            <x-module-icon module="kontrolling" class="h-5 w-5 text-violet-600" />
                        </div>
                        <div>
                            <span class="block text-sm font-bold text-text-primary">{{ __('Controlling') }}</span>
                            <span class="text-xs text-text-tertiary">{{ __('Complete financial overview') }}</span>
                        </div>
                    </div>
                    <h3 class="mb-3 text-lg font-bold text-text-primary">{{ __('Executive financial dashboard — at a single glance') }}</h3>
                    <p class="mb-5 text-sm leading-relaxed text-text-secondary">{{ __('Revenue, cost, EBITDA, cash flow, project profitability — in real time, with automatic reports. Plan vs. actual analysis shows where the company stands relative to targets.') }}</p>
                    <div class="mb-5 grid grid-cols-2 gap-2">
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><span class="feature-dot h-1 w-1 rounded-full bg-violet-400"></span>{{ __('Real-time P&L') }}</span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><span class="feature-dot h-1 w-1 rounded-full bg-violet-400"></span>{{ __('Cash flow forecasting') }}</span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><span class="feature-dot h-1 w-1 rounded-full bg-violet-400"></span>{{ __('Plan vs. actual') }}</span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><span class="feature-dot h-1 w-1 rounded-full bg-violet-400"></span>{{ __('Project portfolio P&L') }}</span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><span class="feature-dot h-1 w-1 rounded-full bg-violet-400"></span>{{ __('Automatic reports') }}</span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><span class="feature-dot h-1 w-1 rounded-full bg-violet-400"></span>{{ __('Scheduled PDF delivery') }}</span>
                    </div>
                    <a href="{{ route('products.kontrolling') }}" class="inline-flex items-center gap-1.5 text-sm font-semibold text-violet-600 transition-colors hover:text-violet-700">
                        {{ __('View details') }} <svg class="arrow-slide h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" /></svg>
                    </a>
                </div>

                {{-- DataMind --}}
                <div class="stagger-item card-glow group rounded-2xl border border-border-light bg-surface-primary p-8" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="mb-5 flex items-center gap-4">
                        <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-amber-50">
                            <x-module-icon module="datamind" class="h-5 w-5 text-amber-600" />
                        </div>
                        <div>
                            <span class="block text-sm font-bold text-text-primary">DataMind</span>
                            <span class="text-xs text-text-tertiary">{{ __('AI strategic advisor') }}</span>
                        </div>
                    </div>
                    <h3 class="mb-3 text-lg font-bold text-text-primary">{{ __('AI summaries, predictions and strategic recommendations') }}</h3>
                    <p class="mb-5 text-sm leading-relaxed text-text-secondary">{{ __('DataMind summarizes the most important changes every morning, identifies risks, predicts trends — and provides understandable recommendations in Hungarian for the next steps.') }}</p>
                    <div class="mb-5 grid grid-cols-2 gap-2">
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><span class="feature-dot h-1 w-1 rounded-full bg-amber-400"></span>{{ __('Morning AI summary') }}</span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><span class="feature-dot h-1 w-1 rounded-full bg-amber-400"></span>{{ __('Risk identification') }}</span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><span class="feature-dot h-1 w-1 rounded-full bg-amber-400"></span>{{ __('Trend forecasting') }}</span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><span class="feature-dot h-1 w-1 rounded-full bg-amber-400"></span>{{ __('Strategic recommendations') }}</span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><span class="feature-dot h-1 w-1 rounded-full bg-amber-400"></span>{{ __('Anomaly detection') }}</span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><span class="feature-dot h-1 w-1 rounded-full bg-amber-400"></span>{{ __('Industry benchmark') }}</span>
                    </div>
                    <a href="{{ route('products.datamind') }}" class="inline-flex items-center gap-1.5 text-sm font-semibold text-amber-600 transition-colors hover:text-amber-700">
                        {{ __('View details') }} <svg class="arrow-slide h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" /></svg>
                    </a>
                </div>

                {{-- CRM --}}
                <div class="stagger-item card-glow group rounded-2xl border border-border-light bg-surface-primary p-8" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="mb-5 flex items-center gap-4">
                        <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-success-50">
                            <x-module-icon module="crm" class="h-5 w-5 text-success-600" />
                        </div>
                        <div>
                            <span class="block text-sm font-bold text-text-primary">CRM</span>
                            <span class="text-xs text-text-tertiary">{{ __('Customer portfolio overview') }}</span>
                        </div>
                    </div>
                    <h3 class="mb-3 text-lg font-bold text-text-primary">{{ __('Customer portfolio, pipeline value and retention rates') }}</h3>
                    <p class="mb-5 text-sm leading-relaxed text-text-secondary">{{ __('The CEO sees on a single screen: pipeline value, most profitable customers, churn risk, and where new leads come from.') }}</p>
                    <div class="mb-5 grid grid-cols-2 gap-2">
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><span class="feature-dot h-1 w-1 rounded-full bg-success-400"></span>{{ __('Pipeline value overview') }}</span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><span class="feature-dot h-1 w-1 rounded-full bg-success-400"></span>{{ __('Top customer profitability') }}</span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><span class="feature-dot h-1 w-1 rounded-full bg-success-400"></span>{{ __('Churn risk alert') }}</span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><span class="feature-dot h-1 w-1 rounded-full bg-success-400"></span>{{ __('Lead source analysis') }}</span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><span class="feature-dot h-1 w-1 rounded-full bg-success-400"></span>{{ __('NPS/CSAT trends') }}</span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><span class="feature-dot h-1 w-1 rounded-full bg-success-400"></span>{{ __('Sales rep ranking') }}</span>
                    </div>
                    <a href="{{ route('products.crm') }}" class="inline-flex items-center gap-1.5 text-sm font-semibold text-success-600 transition-colors hover:text-success-700">
                        {{ __('View details') }} <svg class="arrow-slide h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" /></svg>
                    </a>
                </div>

                {{-- MarketingHub --}}
                <div class="stagger-item card-glow group rounded-2xl border border-border-light bg-surface-primary p-8" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="mb-5 flex items-center gap-4">
                        <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-blue-50">
                            <x-module-icon module="marketinghub" class="h-5 w-5 text-blue-600" />
                        </div>
                        <div>
                            <span class="block text-sm font-bold text-text-primary">MarketingHub</span>
                            <span class="text-xs text-text-tertiary">{{ __('Marketing ROI and efficiency') }}</span>
                        </div>
                    </div>
                    <h3 class="mb-3 text-lg font-bold text-text-primary">{{ __('Marketing ROI, campaign effectiveness and brand health') }}</h3>
                    <p class="mb-5 text-sm leading-relaxed text-text-secondary">{{ __('How much does the company spend on marketing, and how much does it return? Which channel brings the most leads, and at what cost? The CEO can make data-driven decisions about the marketing budget.') }}</p>
                    <div class="mb-5 grid grid-cols-2 gap-2">
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><span class="feature-dot h-1 w-1 rounded-full bg-blue-400"></span>{{ __('Marketing ROI summary') }}</span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><span class="feature-dot h-1 w-1 rounded-full bg-blue-400"></span>{{ __('Channel effectiveness') }}</span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><span class="feature-dot h-1 w-1 rounded-full bg-blue-400"></span>{{ __('Cost per lead metric') }}</span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><span class="feature-dot h-1 w-1 rounded-full bg-blue-400"></span>{{ __('Organic vs. paid') }}</span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><span class="feature-dot h-1 w-1 rounded-full bg-blue-400"></span>{{ __('Brand awareness trends') }}</span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><span class="feature-dot h-1 w-1 rounded-full bg-blue-400"></span>{{ __('Campaign comparison') }}</span>
                    </div>
                    <a href="{{ route('products.marketinghub') }}" class="inline-flex items-center gap-1.5 text-sm font-semibold text-blue-600 transition-colors hover:text-blue-700">
                        {{ __('View details') }} <svg class="arrow-slide h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" /></svg>
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{-- Ecosystem Section — All 11 Modules --}}
    <section class="bg-surface-secondary py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-6">
            <div class="reveal mb-12 text-center">
                <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-violet-600">{{ __('Full ecosystem') }}</p>
                <h2 class="mb-4 text-3xl text-text-primary md:text-4xl" style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                    {{ __('All 11 modules — on the CEO\'s dashboard') }}
                </h2>
                <p class="mx-auto max-w-2xl text-lg text-text-secondary">
                    {{ __('The unique power of Cégem360 is that the executive dashboard is not one module — but the sum of all 11 modules. A real-time imprint of every business activity on a single screen.') }}
                </p>
            </div>

            <div class="grid grid-cols-2 gap-4 sm:grid-cols-3 lg:grid-cols-4" data-stagger>
                <div class="stagger-item pill-float rounded-xl border border-border-light bg-surface-primary p-4 text-center" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="mx-auto mb-3 flex h-10 w-10 items-center justify-center rounded-lg bg-violet-50">
                        <x-module-icon module="kontrolling" class="h-5 w-5 text-violet-600" />
                    </div>
                    <h4 class="mb-1 text-xs font-bold text-text-primary">{{ __('Controlling') }}</h4>
                    <p class="text-[10px] leading-snug text-text-tertiary">{{ __('P&L, cash flow, plan vs. actual') }}</p>
                </div>
                <div class="stagger-item pill-float rounded-xl border border-border-light bg-surface-primary p-4 text-center" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="mx-auto mb-3 flex h-10 w-10 items-center justify-center rounded-lg bg-success-50">
                        <x-module-icon module="crm" class="h-5 w-5 text-success-600" />
                    </div>
                    <h4 class="mb-1 text-xs font-bold text-text-primary">CRM</h4>
                    <p class="text-[10px] leading-snug text-text-tertiary">{{ __('Customer data, pipeline, NPS') }}</p>
                </div>
                <div class="stagger-item pill-float rounded-xl border border-border-light bg-surface-primary p-4 text-center" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="mx-auto mb-3 flex h-10 w-10 items-center justify-center rounded-lg bg-blue-50">
                        <x-module-icon module="ertekesites" class="h-5 w-5 text-blue-600" />
                    </div>
                    <h4 class="mb-1 text-xs font-bold text-text-primary">{{ __('Sales') }}</h4>
                    <p class="text-[10px] leading-snug text-text-tertiary">{{ __('Quote, order, revenue') }}</p>
                </div>
                <div class="stagger-item pill-float rounded-xl border border-border-light bg-surface-primary p-4 text-center" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="mx-auto mb-3 flex h-10 w-10 items-center justify-center rounded-lg bg-cyan-50">
                        <x-module-icon module="beszerzes" class="h-5 w-5 text-cyan-600" />
                    </div>
                    <h4 class="mb-1 text-xs font-bold text-text-primary">{{ __('Procurement') }}</h4>
                    <p class="text-[10px] leading-snug text-text-tertiary">{{ __('Inventory, suppliers, orders') }}</p>
                </div>
                <div class="stagger-item pill-float rounded-xl border border-border-light bg-surface-primary p-4 text-center" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="mx-auto mb-3 flex h-10 w-10 items-center justify-center rounded-lg bg-orange-50">
                        <x-module-icon module="gyartas" class="h-5 w-5 text-orange-600" />
                    </div>
                    <h4 class="mb-1 text-xs font-bold text-text-primary">{{ __('Production Management') }}</h4>
                    <p class="text-[10px] leading-snug text-text-tertiary">{{ __('OEE, capacity, quality') }}</p>
                </div>
                <div class="stagger-item pill-float rounded-xl border border-border-light bg-surface-primary p-4 text-center" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="mx-auto mb-3 flex h-10 w-10 items-center justify-center rounded-lg bg-amber-50">
                        <x-module-icon module="automatizalas" class="h-5 w-5 text-amber-600" />
                    </div>
                    <h4 class="mb-1 text-xs font-bold text-text-primary">{{ __('Automation') }}</h4>
                    <p class="text-[10px] leading-snug text-text-tertiary">{{ __('Workflows, triggers, alerts') }}</p>
                </div>
                <div class="stagger-item pill-float rounded-xl border border-border-light bg-surface-primary p-4 text-center" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="mx-auto mb-3 flex h-10 w-10 items-center justify-center rounded-lg bg-rose-50">
                        <x-module-icon module="szerviz" class="h-5 w-5 text-rose-600" />
                    </div>
                    <h4 class="mb-1 text-xs font-bold text-text-primary">{{ __('Digital Worksheet') }}</h4>
                    <p class="text-[10px] leading-snug text-text-tertiary">{{ __('On-site data, photo, signature') }}</p>
                </div>
                <div class="stagger-item pill-float rounded-xl border border-border-light bg-surface-primary p-4 text-center" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="mx-auto mb-3 flex h-10 w-10 items-center justify-center rounded-lg bg-teal-50">
                        <x-module-icon module="seo" class="h-5 w-5 text-teal-600" />
                    </div>
                    <h4 class="mb-1 text-xs font-bold text-text-primary">{{ __('SEO Tool') }}</h4>
                    <p class="text-[10px] leading-snug text-text-tertiary">{{ __('Organic traffic, rankings') }}</p>
                </div>
                <div class="stagger-item pill-float rounded-xl border border-border-light bg-surface-primary p-4 text-center" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="mx-auto mb-3 flex h-10 w-10 items-center justify-center rounded-lg bg-yellow-50">
                        <x-module-icon module="marketinghub" class="h-5 w-5 text-yellow-600" />
                    </div>
                    <h4 class="mb-1 text-xs font-bold text-text-primary">MarketingHub</h4>
                    <p class="text-[10px] leading-snug text-text-tertiary">{{ __('Campaigns, ROI, segments') }}</p>
                </div>
                <div class="stagger-item pill-float rounded-xl border border-border-light bg-surface-primary p-4 text-center" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="mx-auto mb-3 flex h-10 w-10 items-center justify-center rounded-lg bg-indigo-50">
                        <x-module-icon module="datamind" class="h-5 w-5 text-indigo-600" />
                    </div>
                    <h4 class="mb-1 text-xs font-bold text-text-primary">DataMind</h4>
                    <p class="text-[10px] leading-snug text-text-tertiary">{{ __('AI prediction, summaries') }}</p>
                </div>
                <div class="stagger-item pill-float rounded-xl border border-border-light bg-surface-primary p-4 text-center" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="mx-auto mb-3 flex h-10 w-10 items-center justify-center rounded-lg bg-pink-50">
                        <x-module-icon module="ai-chat" class="h-5 w-5 text-pink-600" />
                    </div>
                    <h4 class="mb-1 text-xs font-bold text-text-primary">AI Chat</h4>
                    <p class="text-[10px] leading-snug text-text-tertiary">{{ __('24/7 customer support, lead') }}</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Decision Flow Section --}}
    <section class="bg-surface-primary py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-6">
            <div class="reveal mb-12">
                <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-violet-600">{{ __('Decision cycle') }}</p>
                <h2 class="mb-4 text-3xl text-text-primary md:text-4xl" style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                    {{ __('Data-driven management — on a daily basis') }}
                </h2>
                <p class="max-w-xl text-lg text-text-secondary">
                    {{ __('This is what a CEO\'s day looks like with Cégem360.') }}
                </p>
            </div>

            <div class="grid grid-cols-2 gap-5 sm:grid-cols-3 lg:grid-cols-5" data-stagger>
                <div class="stagger-item text-center">
                    <div class="mx-auto mb-4 flex h-16 w-16 items-center justify-center rounded-full border-2 border-violet-200 bg-surface-primary text-xl font-bold text-violet-600">01</div>
                    <h4 class="mb-1 text-sm font-bold text-text-primary">{{ __('Morning summary') }}</h4>
                    <p class="mb-2 text-xs text-text-tertiary">{{ __('AI summary: key KPIs, changes, risks, recommendations') }}</p>
                    <div class="flex flex-wrap justify-center gap-1">
                        <span class="rounded bg-violet-50 px-1.5 py-0.5 text-[9px] font-semibold text-violet-600">DataMind</span>
                    </div>
                </div>
                <div class="stagger-item text-center">
                    <div class="mx-auto mb-4 flex h-16 w-16 items-center justify-center rounded-full border-2 border-amber-200 bg-surface-primary text-xl font-bold text-amber-600">02</div>
                    <h4 class="mb-1 text-sm font-bold text-text-primary">{{ __('Dashboard review') }}</h4>
                    <p class="mb-2 text-xs text-text-tertiary">{{ __('Every segment at a glance: finance, sales, production, service') }}</p>
                    <div class="flex flex-wrap justify-center gap-1">
                        <span class="rounded bg-amber-50 px-1.5 py-0.5 text-[9px] font-semibold text-amber-600">{{ __('Controlling') }}</span>
                        <span class="rounded bg-amber-50 px-1.5 py-0.5 text-[9px] font-semibold text-amber-600">CRM</span>
                    </div>
                </div>
                <div class="stagger-item text-center">
                    <div class="mx-auto mb-4 flex h-16 w-16 items-center justify-center rounded-full border-2 border-blue-200 bg-surface-primary text-xl font-bold text-blue-600">03</div>
                    <h4 class="mb-1 text-sm font-bold text-text-primary">{{ __('Focus analysis') }}</h4>
                    <p class="mb-2 text-xs text-text-tertiary">{{ __('Drilldown on critical points: which project, customer, machine, campaign needs attention') }}</p>
                    <div class="flex flex-wrap justify-center gap-1">
                        <span class="rounded bg-blue-50 px-1.5 py-0.5 text-[9px] font-semibold text-blue-600">{{ __('All modules') }}</span>
                    </div>
                </div>
                <div class="stagger-item text-center">
                    <div class="mx-auto mb-4 flex h-16 w-16 items-center justify-center rounded-full border-2 border-success-200 bg-surface-primary text-xl font-bold text-success-600">04</div>
                    <h4 class="mb-1 text-sm font-bold text-text-primary">{{ __('Decision making') }}</h4>
                    <p class="mb-2 text-xs text-text-tertiary">{{ __('AI-based recommendations, scenario modeling and impact analysis') }}</p>
                    <div class="flex flex-wrap justify-center gap-1">
                        <span class="rounded bg-success-50 px-1.5 py-0.5 text-[9px] font-semibold text-success-600">DataMind</span>
                        <span class="rounded bg-success-50 px-1.5 py-0.5 text-[9px] font-semibold text-success-600">{{ __('Controlling') }}</span>
                    </div>
                </div>
                <div class="stagger-item text-center">
                    <div class="mx-auto mb-4 flex h-16 w-16 items-center justify-center rounded-full border-2 border-orange-200 bg-surface-primary text-xl font-bold text-orange-600">05</div>
                    <h4 class="mb-1 text-sm font-bold text-text-primary">{{ __('Execution tracking') }}</h4>
                    <p class="mb-2 text-xs text-text-tertiary">{{ __('Delegation, task assignment, automatic feedback on decision impact') }}</p>
                    <div class="flex flex-wrap justify-center gap-1">
                        <span class="rounded bg-orange-50 px-1.5 py-0.5 text-[9px] font-semibold text-orange-600">{{ __('Automation') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Stats Section --}}
    <section class="bg-surface-secondary py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-6">
            <div class="reveal mb-12 text-center">
                <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-violet-600">{{ __('Results') }}</p>
                <h2 class="text-3xl text-text-primary md:text-4xl" style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                    {{ __('Measurable improvement in executive decision-making') }}
                </h2>
            </div>

            <div class="grid grid-cols-2 gap-5 lg:grid-cols-4" data-stagger data-counter-trigger>
                <div class="stagger-item stat-hover rounded-2xl border border-border-light bg-surface-primary p-8 text-center" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <span class="stat-value block text-4xl font-bold text-violet-600 lg:text-5xl" style="font-family: 'JetBrains Mono', monospace;"
                        data-count="5" data-suffix="×">0×</span>
                    <span class="mt-2 block text-sm text-text-secondary">{{ __('Faster decision-making') }}</span>
                </div>
                <div class="stagger-item stat-hover rounded-2xl border border-border-light bg-surface-primary p-8 text-center" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <span class="stat-value block text-4xl font-bold text-amber-600 lg:text-5xl" style="font-family: 'JetBrains Mono', monospace;"
                        data-count="100" data-suffix="%">0%</span>
                    <span class="mt-2 block text-sm text-text-secondary">{{ __('Real-time company overview') }}</span>
                </div>
                <div class="stagger-item stat-hover rounded-2xl border border-border-light bg-surface-primary p-8 text-center" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <span class="stat-value block text-4xl font-bold text-success-600 lg:text-5xl" style="font-family: 'JetBrains Mono', monospace;"
                        data-count="90" data-prefix="-" data-suffix="%">0%</span>
                    <span class="mt-2 block text-sm text-text-secondary">{{ __('Report preparation time') }}</span>
                </div>
                <div class="stagger-item stat-hover rounded-2xl border border-border-light bg-surface-primary p-8 text-center" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <span class="stat-value block text-4xl font-bold text-blue-600 lg:text-5xl" style="font-family: 'JetBrains Mono', monospace;"
                        data-count="30" data-prefix="+" data-suffix="%">0%</span>
                    <span class="mt-2 block text-sm text-text-secondary">{{ __('Strategic goal achievement') }}</span>
                </div>
            </div>
        </div>
    </section>

    {{-- Use Cases Section --}}
    <section class="bg-surface-primary py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-6">
            <div class="reveal mb-12">
                <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-violet-600">{{ __('Use cases') }}</p>
                <h2 class="mb-4 text-3xl text-text-primary md:text-4xl" style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                    {{ __('How industrial CEOs use it') }}
                </h2>
            </div>

            <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3" data-stagger>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-7" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <span class="mb-4 block text-xs font-semibold text-text-tertiary" style="font-family: 'JetBrains Mono', monospace;">01</span>
                    <h3 class="mb-2 text-base font-bold text-text-primary">{{ __('Morning AI summary and daily priorities') }}</h3>
                    <p class="mb-4 text-sm leading-relaxed text-text-secondary">{{ __('The CEO gets an AI summary every morning: what changed yesterday, what to watch today, what risks exist. 2 minutes of reading — and they know what to focus on.') }}</p>
                    <div class="flex flex-wrap gap-1.5">
                        <span class="rounded bg-violet-50 px-2 py-0.5 text-[10px] font-semibold text-violet-600">DataMind</span>
                        <span class="rounded bg-violet-50 px-2 py-0.5 text-[10px] font-semibold text-violet-600">{{ __('Controlling') }}</span>
                    </div>
                </div>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-7" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <span class="mb-4 block text-xs font-semibold text-text-tertiary" style="font-family: 'JetBrains Mono', monospace;">02</span>
                    <h3 class="mb-2 text-base font-bold text-text-primary">{{ __('Project portfolio profitability overview') }}</h3>
                    <p class="mb-4 text-sm leading-relaxed text-text-secondary">{{ __('Which project makes money, which loses it? The CEO sees all 15 running projects\' P&L in real time, critical ones marked in red, with AI recommendations for intervention.') }}</p>
                    <div class="flex flex-wrap gap-1.5">
                        <span class="rounded bg-violet-50 px-2 py-0.5 text-[10px] font-semibold text-violet-600">{{ __('Controlling') }}</span>
                        <span class="rounded bg-violet-50 px-2 py-0.5 text-[10px] font-semibold text-violet-600">{{ __('Production Management') }}</span>
                        <span class="rounded bg-violet-50 px-2 py-0.5 text-[10px] font-semibold text-violet-600">DataMind</span>
                    </div>
                </div>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-7" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <span class="mb-4 block text-xs font-semibold text-text-tertiary" style="font-family: 'JetBrains Mono', monospace;">03</span>
                    <h3 class="mb-2 text-base font-bold text-text-primary">{{ __('Strategic capacity decision with AI prediction') }}</h3>
                    <p class="mb-4 text-sm leading-relaxed text-text-secondary">{{ __('DataMind forecasts capacity needs 3-6 months ahead based on pipeline data and seasonal patterns. The CEO can make data-driven decisions about expansion or staffing.') }}</p>
                    <div class="flex flex-wrap gap-1.5">
                        <span class="rounded bg-violet-50 px-2 py-0.5 text-[10px] font-semibold text-violet-600">DataMind</span>
                        <span class="rounded bg-violet-50 px-2 py-0.5 text-[10px] font-semibold text-violet-600">CRM</span>
                        <span class="rounded bg-violet-50 px-2 py-0.5 text-[10px] font-semibold text-violet-600">{{ __('Production Management') }}</span>
                    </div>
                </div>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-7" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <span class="mb-4 block text-xs font-semibold text-text-tertiary" style="font-family: 'JetBrains Mono', monospace;">04</span>
                    <h3 class="mb-2 text-base font-bold text-text-primary">{{ __('Automatic weekly executive report') }}</h3>
                    <p class="mb-4 text-sm leading-relaxed text-text-secondary">{{ __('No need for manual Excel for the management meeting. The system automatically generates the weekly report: KPIs, changes, projects, risks — in PDF, every Monday at 8:00.') }}</p>
                    <div class="flex flex-wrap gap-1.5">
                        <span class="rounded bg-violet-50 px-2 py-0.5 text-[10px] font-semibold text-violet-600">{{ __('Controlling') }}</span>
                        <span class="rounded bg-violet-50 px-2 py-0.5 text-[10px] font-semibold text-violet-600">{{ __('Automation') }}</span>
                    </div>
                </div>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-7" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <span class="mb-4 block text-xs font-semibold text-text-tertiary" style="font-family: 'JetBrains Mono', monospace;">05</span>
                    <h3 class="mb-2 text-base font-bold text-text-primary">{{ __('Marketing–sales–service correlation analysis') }}</h3>
                    <p class="mb-4 text-sm leading-relaxed text-text-secondary">{{ __('How much does it cost to acquire a new customer? How much do they bring over their lifecycle? Where do the most profitable customers come from? The CEO sees the full customer value chain.') }}</p>
                    <div class="flex flex-wrap gap-1.5">
                        <span class="rounded bg-violet-50 px-2 py-0.5 text-[10px] font-semibold text-violet-600">MarketingHub</span>
                        <span class="rounded bg-violet-50 px-2 py-0.5 text-[10px] font-semibold text-violet-600">CRM</span>
                        <span class="rounded bg-violet-50 px-2 py-0.5 text-[10px] font-semibold text-violet-600">{{ __('Controlling') }}</span>
                    </div>
                </div>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-7" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <span class="mb-4 block text-xs font-semibold text-text-tertiary" style="font-family: 'JetBrains Mono', monospace;">06</span>
                    <h3 class="mb-2 text-base font-bold text-text-primary">{{ __('Owner report and investor communication') }}</h3>
                    <p class="mb-4 text-sm leading-relaxed text-text-secondary">{{ __('Reports for owners or investors can be generated automatically: revenue, profit, growth, market position, forecast — in professional format, in minutes.') }}</p>
                    <div class="flex flex-wrap gap-1.5">
                        <span class="rounded bg-violet-50 px-2 py-0.5 text-[10px] font-semibold text-violet-600">{{ __('Controlling') }}</span>
                        <span class="rounded bg-violet-50 px-2 py-0.5 text-[10px] font-semibold text-violet-600">DataMind</span>
                        <span class="rounded bg-violet-50 px-2 py-0.5 text-[10px] font-semibold text-violet-600">{{ __('Automation') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Comparison Table Section --}}
    <section class="bg-surface-secondary py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-6">
            <div class="reveal mb-12">
                <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-violet-600">{{ __('Comparison') }}</p>
                <h2 class="mb-4 text-3xl text-text-primary md:text-4xl" style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                    {{ __('Instead of Excel piles — AI-driven company management') }}
                </h2>
                <p class="max-w-xl text-lg text-text-secondary">
                    {{ __('This is how CEO work changes with Cégem360.') }}
                </p>
            </div>

            <div class="reveal overflow-x-auto">
                <table class="w-full min-w-[640px] border-collapse overflow-hidden rounded-2xl border border-border-light">
                    <thead>
                        <tr class="bg-surface-primary">
                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-text-primary">{{ __('Capability') }}</th>
                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-text-primary">{{ __('Traditional method') }}</th>
                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-text-primary">Cégem360</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-border-light">
                        <tr><td class="px-6 py-4 text-sm font-semibold text-text-primary">{{ __('Company overview') }}</td><td class="px-6 py-4 text-sm text-text-tertiary">{{ __('At month end, manually') }}</td><td class="px-6 py-4 text-sm font-medium text-success-600">{{ __('✓ Real-time, from 11 modules') }}</td></tr>
                        <tr><td class="px-6 py-4 text-sm font-semibold text-text-primary">{{ __('Executive report') }}</td><td class="px-6 py-4 text-sm text-text-tertiary">{{ __('Days of manual work') }}</td><td class="px-6 py-4 text-sm font-medium text-success-600">{{ __('✓ Automatic, scheduled') }}</td></tr>
                        <tr><td class="px-6 py-4 text-sm font-semibold text-text-primary">{{ __('Forecasting') }}</td><td class="px-6 py-4 text-sm text-text-tertiary">{{ __('Intuition / experience') }}</td><td class="px-6 py-4 text-sm font-medium text-success-600">{{ __('✓ AI prediction, scenarios') }}</td></tr>
                        <tr><td class="px-6 py-4 text-sm font-semibold text-text-primary">{{ __('Risk identification') }}</td><td class="px-6 py-4 text-sm text-text-tertiary">{{ __('When someone reports') }}</td><td class="px-6 py-4 text-sm font-medium text-success-600">{{ __('✓ Automatic AI detection') }}</td></tr>
                        <tr><td class="px-6 py-4 text-sm font-semibold text-text-primary">{{ __('Operational transparency') }}</td><td class="px-6 py-4 text-sm text-text-tertiary">{{ __('Verbally / in meetings') }}</td><td class="px-6 py-4 text-sm font-medium text-success-600">{{ __('✓ Live dashboard, drilldown') }}</td></tr>
                        <tr><td class="px-6 py-4 text-sm font-semibold text-text-primary">{{ __('Strategic planning') }}</td><td class="px-6 py-4 text-sm text-text-tertiary">{{ __('1x per year strategy day') }}</td><td class="px-6 py-4 text-sm font-medium text-success-600">{{ __('✓ Continuous, data-driven') }}</td></tr>
                        <tr><td class="px-6 py-4 text-sm font-semibold text-text-primary">{{ __('Information consistency') }}</td><td class="px-6 py-4 text-sm text-text-tertiary">{{ __('Everyone quotes different numbers') }}</td><td class="px-6 py-4 text-sm font-medium text-success-600">{{ __('✓ Single source of truth') }}</td></tr>
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
                        <h3 class="mb-3 text-xl font-bold text-text-primary lg:text-2xl" style="font-family: 'Poppins', sans-serif;">{{ __('Personalized executive consultation') }}</h3>
                        <p class="mb-5 text-base text-text-secondary">{{ __('A 30-minute video call where we show how Cégem360 can provide real-time company overview and AI decision support for your industrial company — with the full module set.') }}</p>
                        <div class="flex flex-wrap gap-5">
                            <span class="flex items-center gap-1.5 text-sm text-text-tertiary"><svg class="h-4 w-4 text-success-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>{{ __('30-minute video call') }}</span>
                            <span class="flex items-center gap-1.5 text-sm text-text-tertiary"><svg class="h-4 w-4 text-success-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>{{ __('Executive needs assessment') }}</span>
                            <span class="flex items-center gap-1.5 text-sm text-text-tertiary"><svg class="h-4 w-4 text-success-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>{{ __('No commitment') }}</span>
                        </div>
                    </div>
                    <a href="{{ route('contact') }}" class="group inline-flex items-center gap-2 rounded-full bg-violet-600 px-6 py-3 text-base font-medium text-white transition-all hover:bg-violet-700 hover:shadow-lg" style="box-shadow: 0 1px 2px rgba(0,0,0,0.05);">
                        <span>{{ __('Request consultation') }}</span>
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
                <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-violet-600">{{ __('Get started') }}</p>
                <h2 class="mb-4 text-3xl text-text-primary md:text-4xl" style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                    {{ __('Ready for data-driven company management?') }}
                </h2>
                <p class="mx-auto max-w-xl text-lg text-text-secondary">
                    {{ __('Choose the next step for you.') }}
                </p>
            </div>

            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2" data-stagger>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-8 text-center" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <h3 class="mb-3 text-xl font-bold text-text-primary">{{ __('Executive consultation') }}</h3>
                    <p class="mb-6 text-sm text-text-secondary">{{ __('Ask our experts in 30 minutes — via video call, tailored to your corporate management challenges, with no obligation.') }}</p>
                    <a href="{{ route('contact') }}" class="inline-flex items-center gap-2 rounded-full border border-border-light bg-surface-secondary px-6 py-3 text-sm font-medium text-text-primary transition-all hover:border-violet-200 hover:shadow-md">
                        {{ __('Book appointment') }} <svg class="arrow-slide h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" /></svg>
                    </a>
                </div>
                <div class="stagger-item card-glow rounded-2xl border border-violet-100 bg-violet-50 p-8 text-center" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <h3 class="mb-3 text-xl font-bold text-text-primary">{{ __('Registration and trial') }}</h3>
                    <p class="mb-6 text-sm text-text-secondary">{{ __('Explore the executive dashboard, DataMind AI summaries and the full 11-module system — instantly.') }}</p>
                    <a href="{{ route('register') }}" class="group inline-flex items-center gap-2 rounded-full bg-violet-600 px-6 py-3 text-sm font-medium text-white transition-all hover:bg-violet-700 hover:shadow-lg" style="box-shadow: 0 1px 2px rgba(0,0,0,0.05);">
                        {{ __('Registration') }} <svg class="arrow-slide h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" /></svg>
                    </a>
                </div>
            </div>
        </div>
    </section>
</div>
