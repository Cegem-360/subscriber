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
        .card-glow:hover { box-shadow: 0 8px 30px -8px rgba(249, 115, 22, 0.15), 0 2px 8px rgba(0,0,0,0.04) !important; transform: translateY(-4px); }

        .icon-hover { transition: transform 0.35s cubic-bezier(0,0,0.2,1.4); }
        .group:hover .icon-hover, .card-glow:hover .icon-hover { transform: translateY(-3px) scale(1.08); }

        .arrow-slide { transition: transform 0.3s cubic-bezier(0,0,0.2,1); }
        .group:hover .arrow-slide, a:hover .arrow-slide { transform: translateX(4px); }

        .stat-hover .stat-value { transition: transform 0.4s cubic-bezier(0,0,0.2,1.4); }
        .stat-hover:hover .stat-value { transform: scale(1.08); }

        html { scroll-behavior: smooth; }
    </style>

    {{-- Hero Section --}}
    <section class="bg-linear-to-b from-orange-50 to-surface-secondary">
        <div class="mx-auto max-w-7xl px-6 py-16 lg:py-24">
            <div class="reveal mx-auto max-w-3xl text-center">
                <div class="badge-gradient mb-8 inline-flex items-center gap-2 rounded-full border border-border-light/80 bg-surface-primary px-4 py-1.5"
                    style="box-shadow: 0 1px 3px rgba(0,0,0,0.04);">
                    <span class="text-sm font-medium text-text-primary">{{ __('Company') }} &middot; {{ __('Customer Stories') }}</span>
                </div>

                <h1 class="mb-6 text-4xl leading-tight tracking-tight text-text-primary md:text-5xl lg:text-[3.5rem]"
                    style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                    {{ __('Real results,') }}<br>
                    {{ __('from real industrial companies') }}
                </h1>

                <p class="mx-auto mb-10 max-w-2xl text-lg text-text-secondary lg:text-xl">
                    {{ __("We don't say it works — our customers do. These stories are about how Cégem360 changed the daily work: less paper, faster decisions, more time for what matters.") }}
                </p>

                {{-- Filter bar --}}
                <div class="flex flex-wrap items-center justify-center gap-2">
                    <button class="rounded-full border px-4 py-2 text-sm font-semibold transition-all"
                        :class="activeFilter === 'all' ? 'border-orange-300 bg-orange-50 text-orange-700' : 'border-border-light bg-surface-primary text-text-secondary hover:border-border-default hover:text-text-primary'"
                        @click="activeFilter = 'all'">
                        {{ __('All') }}
                    </button>
                    <button class="rounded-full border px-4 py-2 text-sm font-semibold transition-all"
                        :class="activeFilter === 'gyartas' ? 'border-orange-300 bg-orange-50 text-orange-700' : 'border-border-light bg-surface-primary text-text-secondary hover:border-border-default hover:text-text-primary'"
                        @click="activeFilter = 'gyartas'">
                        {{ __('Manufacturing') }}
                    </button>
                    <button class="rounded-full border px-4 py-2 text-sm font-semibold transition-all"
                        :class="activeFilter === 'szerviz' ? 'border-orange-300 bg-orange-50 text-orange-700' : 'border-border-light bg-surface-primary text-text-secondary hover:border-border-default hover:text-text-primary'"
                        @click="activeFilter = 'szerviz'">
                        {{ __('Service & Maintenance') }}
                    </button>
                    <button class="rounded-full border px-4 py-2 text-sm font-semibold transition-all"
                        :class="activeFilter === 'kereskedelem' ? 'border-orange-300 bg-orange-50 text-orange-700' : 'border-border-light bg-surface-primary text-text-secondary hover:border-border-default hover:text-text-primary'"
                        @click="activeFilter = 'kereskedelem'">
                        {{ __('Commerce') }}
                    </button>
                    <button class="rounded-full border px-4 py-2 text-sm font-semibold transition-all"
                        :class="activeFilter === 'epitoipar' ? 'border-orange-300 bg-orange-50 text-orange-700' : 'border-border-light bg-surface-primary text-text-secondary hover:border-border-default hover:text-text-primary'"
                        @click="activeFilter = 'epitoipar'">
                        {{ __('Construction') }}
                    </button>
                    <button class="rounded-full border px-4 py-2 text-sm font-semibold transition-all"
                        :class="activeFilter === 'szolgaltatas' ? 'border-orange-300 bg-orange-50 text-orange-700' : 'border-border-light bg-surface-primary text-text-secondary hover:border-border-default hover:text-text-primary'"
                        @click="activeFilter = 'szolgaltatas'">
                        {{ __('Services') }}
                    </button>
                </div>
            </div>
        </div>
    </section>

    {{-- Story Cards Section --}}
    <section class="bg-surface-secondary py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-6">
            <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3" data-stagger>

                {{-- Story 1: Gyártás --}}
                <article class="stagger-item card-glow flex flex-col overflow-hidden rounded-2xl border border-border-light bg-surface-primary" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);"
                    x-show="activeFilter === 'all' || activeFilter === 'gyartas'" x-transition>
                    {{-- Cover --}}
                    <div class="flex aspect-video items-center justify-center bg-linear-to-br from-blue-50 to-indigo-50">
                        <span class="text-5xl opacity-50">&#127981;</span>
                    </div>
                    <div class="-mt-8 relative px-6">
                        <span class="inline-flex items-center gap-1 rounded-md bg-blue-50 px-2.5 py-1 text-[11px] font-bold uppercase tracking-wider text-blue-600">{{ __('Manufacturing') }} &middot; {{ __('Metal Processing') }}</span>
                    </div>

                    {{-- Body --}}
                    <div class="flex flex-1 flex-col p-6 pt-3">
                        <span class="mb-2 block text-xs font-bold uppercase tracking-wider text-text-tertiary">PrecízTech Kft.</span>
                        <h3 class="mb-3 text-base font-bold leading-snug text-text-primary">{{ __('How PrecízTech reduced scrap rate by 40% with Cégem360 production management') }}</h3>
                        <p class="mb-5 flex-1 text-sm leading-relaxed text-text-secondary">{{ __('PrecízTech Kft. CNC machining plant operates in 3 shifts with 12 machines. Production management was previously done in Excel spreadsheets and shift leader notebooks — the scrap rate was around 8%, OEE was invisible.') }}</p>

                        {{-- Modules --}}
                        <div class="mb-4 flex flex-wrap gap-1.5">
                            <span class="rounded-md bg-surface-secondary px-2 py-0.5 text-[11px] font-semibold text-text-tertiary">{{ __('Production Management') }}</span>
                            <span class="rounded-md bg-surface-secondary px-2 py-0.5 text-[11px] font-semibold text-text-tertiary">{{ __('Digital Worksheet') }}</span>
                            <span class="rounded-md bg-surface-secondary px-2 py-0.5 text-[11px] font-semibold text-text-tertiary">DataMind {{ __('AI') }}</span>
                            <span class="rounded-md bg-surface-secondary px-2 py-0.5 text-[11px] font-semibold text-text-tertiary">{{ __('Dashboards') }}</span>
                        </div>

                        {{-- Results --}}
                        <div class="mb-4 grid grid-cols-3 gap-2 rounded-xl border border-border-light bg-surface-secondary p-3">
                            <div class="text-center">
                                <span class="block text-sm font-bold text-blue-600" style="font-family: 'JetBrains Mono', monospace;">-40%</span>
                                <span class="block text-[10px] font-semibold uppercase text-text-tertiary">{{ __('Scrap Rate') }}</span>
                            </div>
                            <div class="text-center">
                                <span class="block text-sm font-bold text-blue-600" style="font-family: 'JetBrains Mono', monospace;">87%</span>
                                <span class="block text-[10px] font-semibold uppercase text-text-tertiary">{{ __('OEE Average') }}</span>
                            </div>
                            <div class="text-center">
                                <span class="block text-sm font-bold text-blue-600" style="font-family: 'JetBrains Mono', monospace;">-3 hét</span>
                                <span class="block text-[10px] font-semibold uppercase text-text-tertiary">{{ __('Implementation Time') }}</span>
                            </div>
                        </div>

                        {{-- Quote --}}
                        <div class="mb-5 rounded-xl border-l-3 border-blue-200 bg-blue-50/50 p-4">
                            <p class="text-sm italic leading-relaxed text-text-secondary">&ldquo;{{ __('Previously the shift leader kept in his head which machine would stop when. Now DataMind alerts in advance, and the team sees the OEE on their phones in real time.') }}&rdquo;</p>
                            <p class="mt-2 text-xs font-semibold text-text-tertiary">&mdash; {{ __('Plant Manager, PrecízTech Kft.') }}</p>
                        </div>

                        {{-- Link --}}
                        <a href="#" class="inline-flex items-center gap-1.5 text-sm font-semibold text-blue-600 hover:text-blue-700">
                            {{ __('Full case study') }} <svg class="arrow-slide h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" /></svg>
                        </a>
                    </div>
                </article>

                {{-- Story 2: Szerviz --}}
                <article class="stagger-item card-glow flex flex-col overflow-hidden rounded-2xl border border-border-light bg-surface-primary" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);"
                    x-show="activeFilter === 'all' || activeFilter === 'szerviz'" x-transition>
                    {{-- Cover --}}
                    <div class="flex aspect-video items-center justify-center bg-linear-to-br from-emerald-50 to-teal-50">
                        <span class="text-5xl opacity-50">&#128295;</span>
                    </div>
                    <div class="-mt-8 relative px-6">
                        <span class="inline-flex items-center gap-1 rounded-md bg-emerald-50 px-2.5 py-1 text-[11px] font-bold uppercase tracking-wider text-emerald-600">{{ __('Service') }} &middot; {{ __('Industrial Maintenance') }}</span>
                    </div>

                    {{-- Body --}}
                    <div class="flex flex-1 flex-col p-6 pt-3">
                        <span class="mb-2 block text-xs font-bold uppercase tracking-wider text-text-tertiary">SzervizPont Zrt.</span>
                        <h3 class="mb-3 text-base font-bold leading-snug text-text-primary">{{ __("SzervizPont coordinates its 15 technicians with Cégem360 — paperless, in real time") }}</h3>
                        <p class="mb-5 flex-1 text-sm leading-relaxed text-text-secondary">{{ __('SzervizPont Zrt. provides on-site maintenance of industrial machines with 15 service technicians. Previously they used paper-based worksheets, the dispatcher coordinated by phone.') }}</p>

                        {{-- Modules --}}
                        <div class="mb-4 flex flex-wrap gap-1.5">
                            <span class="rounded-md bg-surface-secondary px-2 py-0.5 text-[11px] font-semibold text-text-tertiary">{{ __('Service & Maintenance') }}</span>
                            <span class="rounded-md bg-surface-secondary px-2 py-0.5 text-[11px] font-semibold text-text-tertiary">{{ __('Digital Worksheet') }}</span>
                            <span class="rounded-md bg-surface-secondary px-2 py-0.5 text-[11px] font-semibold text-text-tertiary">CRM</span>
                            <span class="rounded-md bg-surface-secondary px-2 py-0.5 text-[11px] font-semibold text-text-tertiary">{{ __('Automation') }}</span>
                        </div>

                        {{-- Results --}}
                        <div class="mb-4 grid grid-cols-3 gap-2 rounded-xl border border-border-light bg-surface-secondary p-3">
                            <div class="text-center">
                                <span class="block text-sm font-bold text-emerald-600" style="font-family: 'JetBrains Mono', monospace;">96%</span>
                                <span class="block text-[10px] font-semibold uppercase text-text-tertiary">{{ __('SLA Fulfillment') }}</span>
                            </div>
                            <div class="text-center">
                                <span class="block text-sm font-bold text-emerald-600" style="font-family: 'JetBrains Mono', monospace;">-65%</span>
                                <span class="block text-[10px] font-semibold uppercase text-text-tertiary">{{ __('Admin Time') }}</span>
                            </div>
                            <div class="text-center">
                                <span class="block text-sm font-bold text-emerald-600" style="font-family: 'JetBrains Mono', monospace;">+22%</span>
                                <span class="block text-[10px] font-semibold uppercase text-text-tertiary">{{ __('Daily Dispatches') }}</span>
                            </div>
                        </div>

                        {{-- Quote --}}
                        <div class="mb-5 rounded-xl border-l-3 border-emerald-200 bg-emerald-50/50 p-4">
                            <p class="text-sm italic leading-relaxed text-text-secondary">&ldquo;{{ __('The technicians fill out the worksheet on-site, on their phones — with photos and signatures. The customer receives the service report the same day, automatically.') }}&rdquo;</p>
                            <p class="mt-2 text-xs font-semibold text-text-tertiary">&mdash; {{ __('Service Manager, SzervizPont Zrt.') }}</p>
                        </div>

                        {{-- Link --}}
                        <a href="#" class="inline-flex items-center gap-1.5 text-sm font-semibold text-emerald-600 hover:text-emerald-700">
                            {{ __('Full case study') }} <svg class="arrow-slide h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" /></svg>
                        </a>
                    </div>
                </article>

                {{-- Story 3: Kereskedelem --}}
                <article class="stagger-item card-glow flex flex-col overflow-hidden rounded-2xl border border-border-light bg-surface-primary" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);"
                    x-show="activeFilter === 'all' || activeFilter === 'kereskedelem'" x-transition>
                    {{-- Cover --}}
                    <div class="flex aspect-video items-center justify-center bg-linear-to-br from-amber-50 to-orange-50">
                        <span class="text-5xl opacity-50">&#128230;</span>
                    </div>
                    <div class="-mt-8 relative px-6">
                        <span class="inline-flex items-center gap-1 rounded-md bg-amber-50 px-2.5 py-1 text-[11px] font-bold uppercase tracking-wider text-amber-600">{{ __('Commerce') }} &middot; {{ __('Industrial Parts') }}</span>
                    </div>

                    {{-- Body --}}
                    <div class="flex flex-1 flex-col p-6 pt-3">
                        <span class="mb-2 block text-xs font-bold uppercase tracking-wider text-text-tertiary">IndusztriParts Kft.</span>
                        <h3 class="mb-3 text-base font-bold leading-snug text-text-primary">{{ __('How IndusztriParts increased quote-to-order conversion by 35% with Cégem360 CRM') }}</h3>
                        <p class="mb-5 flex-1 text-sm leading-relaxed text-text-secondary">{{ __('IndusztriParts Kft. deals in wholesale of industrial parts with 380+ active customer accounts. Sales reps previously tracked the pipeline via email and memory.') }}</p>

                        {{-- Modules --}}
                        <div class="mb-4 flex flex-wrap gap-1.5">
                            <span class="rounded-md bg-surface-secondary px-2 py-0.5 text-[11px] font-semibold text-text-tertiary">CRM & {{ __('Customer Management') }}</span>
                            <span class="rounded-md bg-surface-secondary px-2 py-0.5 text-[11px] font-semibold text-text-tertiary">{{ __('Sales') }}</span>
                            <span class="rounded-md bg-surface-secondary px-2 py-0.5 text-[11px] font-semibold text-text-tertiary">DataMind {{ __('AI') }}</span>
                            <span class="rounded-md bg-surface-secondary px-2 py-0.5 text-[11px] font-semibold text-text-tertiary">{{ __('Controlling') }}</span>
                        </div>

                        {{-- Results --}}
                        <div class="mb-4 grid grid-cols-3 gap-2 rounded-xl border border-border-light bg-surface-secondary p-3">
                            <div class="text-center">
                                <span class="block text-sm font-bold text-amber-600" style="font-family: 'JetBrains Mono', monospace;">+35%</span>
                                <span class="block text-[10px] font-semibold uppercase text-text-tertiary">{{ __('Conversion') }}</span>
                            </div>
                            <div class="text-center">
                                <span class="block text-sm font-bold text-amber-600" style="font-family: 'JetBrains Mono', monospace;">-2 nap</span>
                                <span class="block text-[10px] font-semibold uppercase text-text-tertiary">{{ __('Quote Delivery') }}</span>
                            </div>
                            <div class="text-center">
                                <span class="block text-sm font-bold text-amber-600" style="font-family: 'JetBrains Mono', monospace;">-60%</span>
                                <span class="block text-[10px] font-semibold uppercase text-text-tertiary">{{ __('Churn Risk') }}</span>
                            </div>
                        </div>

                        {{-- Quote --}}
                        <div class="mb-5 rounded-xl border-l-3 border-amber-200 bg-amber-50/50 p-4">
                            <p class="text-sm italic leading-relaxed text-text-secondary">&ldquo;{{ __('DataMind tells us every Monday which customer has churn risk, and the sales rep calls them the same day. Previously we only found out we lost them when it was already too late.') }}&rdquo;</p>
                            <p class="mt-2 text-xs font-semibold text-text-tertiary">&mdash; {{ __('Sales Director, IndusztriParts Kft.') }}</p>
                        </div>

                        {{-- Link --}}
                        <a href="#" class="inline-flex items-center gap-1.5 text-sm font-semibold text-amber-600 hover:text-amber-700">
                            {{ __('Full case study') }} <svg class="arrow-slide h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" /></svg>
                        </a>
                    </div>
                </article>

            </div>
        </div>
    </section>

    {{-- More Stories Teaser --}}
    <section class="bg-surface-primary py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-6">
            <div class="reveal mb-8">
                <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-orange-600">{{ __('Coming Soon') }}</p>
                <h2 class="text-3xl text-text-primary md:text-4xl" style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                    {{ __('Continuously expanding customer stories') }}
                </h2>
            </div>

            <div class="reveal">
                <div class="rounded-2xl border border-dashed border-border-light bg-surface-secondary p-12 text-center" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <span class="mb-4 block text-4xl opacity-40">&#128218;</span>
                    <h3 class="mb-2 text-lg font-bold text-text-primary">{{ __('More case studies coming soon') }}</h3>
                    <p class="mx-auto mb-6 max-w-lg text-sm text-text-secondary">{{ __('Every quarter we publish new customer stories — from different industries, with different challenges and solutions. Subscribe to our newsletter to be the first to know.') }}</p>
                    <a href="{{ route('contact') }}" class="inline-flex items-center gap-2 rounded-full border border-border-light bg-surface-primary px-6 py-3 text-sm font-semibold text-text-primary transition-all hover:border-orange-200 hover:shadow-md">
                        {{ __('Notify me about new stories') }}
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{-- Anatomy of a Story --}}
    <section class="bg-surface-secondary py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-6">
            <div class="reveal mb-12">
                <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-orange-600">{{ __('Case Study Structure') }}</p>
                <h2 class="mb-4 text-3xl text-text-primary md:text-4xl" style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                    {{ __('How we build every story') }}
                </h2>
                <p class="max-w-xl text-lg text-text-secondary">
                    {{ __("We don't write marketing copy — we present measurable results, in real context, with citable data.") }}
                </p>
            </div>

            <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4" data-stagger>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-7 text-center" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <span class="mb-3 block text-xs font-bold text-orange-600" style="font-family: 'JetBrains Mono', monospace;">01</span>
                    <div class="icon-hover mb-3 text-2xl">&#127970;</div>
                    <h4 class="mb-1 text-sm font-bold text-text-primary">{{ __('Company and Industry') }}</h4>
                    <p class="text-xs text-text-tertiary">{{ __('Who is the customer, what segment they work in, how big the company is, what they do') }}</p>
                </div>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-7 text-center" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <span class="mb-3 block text-xs font-bold text-orange-600" style="font-family: 'JetBrains Mono', monospace;">02</span>
                    <div class="icon-hover mb-3 text-2xl">&#9888;&#65039;</div>
                    <h4 class="mb-1 text-sm font-bold text-text-primary">{{ __('Challenge') }}</h4>
                    <p class="text-xs text-text-tertiary">{{ __('What problem the company faced before Cégem360 — specifically, with numbers') }}</p>
                </div>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-7 text-center" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <span class="mb-3 block text-xs font-bold text-orange-600" style="font-family: 'JetBrains Mono', monospace;">03</span>
                    <div class="icon-hover mb-3 text-2xl">&#128161;</div>
                    <h4 class="mb-1 text-sm font-bold text-text-primary">{{ __('Solution') }}</h4>
                    <p class="text-xs text-text-tertiary">{{ __('Which modules were implemented, how they were configured, how long it took') }}</p>
                </div>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-7 text-center" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <span class="mb-3 block text-xs font-bold text-orange-600" style="font-family: 'JetBrains Mono', monospace;">04</span>
                    <div class="icon-hover mb-3 text-2xl">&#128200;</div>
                    <h4 class="mb-1 text-sm font-bold text-text-primary">{{ __('Results') }}</h4>
                    <p class="text-xs text-text-tertiary">{{ __('Measurable change: % improvement, time savings, cost reduction, ROI') }}</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Stats Section --}}
    <section class="bg-surface-primary py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-6">
            <div class="reveal mb-12 text-center">
                <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-orange-600">{{ __('Aggregated Results') }}</p>
                <h2 class="text-3xl text-text-primary md:text-4xl" style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                    {{ __('What our customers achieved together') }}
                </h2>
            </div>

            <div class="grid grid-cols-2 gap-5 lg:grid-cols-4" data-stagger data-counter-trigger>
                <div class="stagger-item stat-hover rounded-2xl border border-border-light bg-surface-primary p-8 text-center" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <span class="stat-value block text-4xl font-bold text-orange-600 lg:text-5xl" style="font-family: 'JetBrains Mono', monospace;"
                        data-count="52" data-prefix="-" data-suffix="%">0</span>
                    <span class="mt-2 block text-sm text-text-secondary">{{ __('Average admin time reduction') }}</span>
                </div>
                <div class="stagger-item stat-hover rounded-2xl border border-border-light bg-surface-primary p-8 text-center" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <span class="stat-value block text-4xl font-bold text-emerald-600 lg:text-5xl" style="font-family: 'JetBrains Mono', monospace;"
                        data-count="34" data-prefix="+" data-suffix="%">0</span>
                    <span class="mt-2 block text-sm text-text-secondary">{{ __('Average efficiency increase') }}</span>
                </div>
                <div class="stagger-item stat-hover rounded-2xl border border-border-light bg-surface-primary p-8 text-center" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <span class="stat-value block text-4xl font-bold text-blue-600 lg:text-5xl" style="font-family: 'JetBrains Mono', monospace;"
                        data-count="3 hét">0</span>
                    <span class="mt-2 block text-sm text-text-secondary">{{ __('Average implementation time') }}</span>
                </div>
                <div class="stagger-item stat-hover rounded-2xl border border-border-light bg-surface-primary p-8 text-center" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <span class="stat-value block text-4xl font-bold text-violet-600 lg:text-5xl" style="font-family: 'JetBrains Mono', monospace;"
                        data-count="96" data-suffix="%">0</span>
                    <span class="mt-2 block text-sm text-text-secondary">{{ __('Customer satisfaction') }}</span>
                </div>
            </div>
        </div>
    </section>

    {{-- CTA Section --}}
    <section class="bg-linear-to-b from-surface-secondary to-surface-primary py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-6">
            <div class="reveal">
                <div class="rounded-2xl border border-orange-100 bg-orange-50/30 p-10 text-center lg:p-16" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <h3 class="mb-4 text-2xl font-bold text-text-primary lg:text-3xl" style="font-family: 'Poppins', sans-serif; font-weight: 600;">{{ __('Your company can be the next story') }}</h3>
                    <p class="mx-auto mb-8 max-w-xl text-base text-text-secondary">{{ __("Book a 30-minute consultation — we'll show you how Cégem360 can help in your industry, for your challenges. Not a demo presentation — but a dialogue.") }}</p>

                    <div class="flex flex-wrap items-center justify-center gap-4">
                        <a href="{{ route('contact') }}"
                            class="group inline-flex items-center gap-2 rounded-full bg-orange-600 px-6 py-3 text-base font-medium text-white transition-all hover:bg-orange-700 hover:shadow-lg"
                            style="box-shadow: 0 1px 2px rgba(0,0,0,0.05);">
                            <span>{{ __('Book a consultation') }}</span>
                            <svg class="arrow-slide h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" /></svg>
                        </a>
                        <a href="{{ route('register') }}"
                            class="inline-flex items-center gap-2 rounded-full border border-border-light bg-surface-primary px-6 py-3 text-base font-medium text-text-primary transition-all hover:border-orange-200 hover:shadow-md">
                            {{ __('Register and try it out') }}
                        </a>
                    </div>

                    <div class="mt-6 flex flex-wrap items-center justify-center gap-6">
                        <span class="flex items-center gap-1.5 text-sm text-text-tertiary">
                            <svg class="h-4 w-4 text-success-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                            {{ __('30-minute video call') }}
                        </span>
                        <span class="flex items-center gap-1.5 text-sm text-text-tertiary">
                            <svg class="h-4 w-4 text-success-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                            {{ __('Tailored to your industry') }}
                        </span>
                        <span class="flex items-center gap-1.5 text-sm text-text-tertiary">
                            <svg class="h-4 w-4 text-success-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                            {{ __('No commitment') }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>
