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
        .reveal { opacity: 0; transform: translateY(28px); transition: opacity 0.7s cubic-bezier(0, 0, 0.2, 1), transform 0.7s cubic-bezier(0, 0, 0.2, 1); }
        .reveal.revealed { opacity: 1; transform: translateY(0); }
        .reveal-left { opacity: 0; transform: translateX(-32px); transition: opacity 0.7s cubic-bezier(0, 0, 0.2, 1), transform 0.7s cubic-bezier(0, 0, 0.2, 1); }
        .reveal-left.revealed { opacity: 1; transform: translateX(0); }
        .reveal-right { opacity: 0; transform: translateX(32px); transition: opacity 0.7s cubic-bezier(0, 0, 0.2, 1), transform 0.7s cubic-bezier(0, 0, 0.2, 1); }
        .reveal-right.revealed { opacity: 1; transform: translateX(0); }
        .reveal-scale { opacity: 0; transform: scale(0.92); transition: opacity 0.6s cubic-bezier(0, 0, 0.2, 1), transform 0.6s cubic-bezier(0, 0, 0.2, 1); }
        .reveal-scale.revealed { opacity: 1; transform: scale(1); }
        .stagger-item { opacity: 0; transform: translateY(20px); transition: opacity 0.5s cubic-bezier(0, 0, 0.2, 1), transform 0.5s cubic-bezier(0, 0, 0.2, 1); }
        .stagger-item.revealed { opacity: 1; transform: translateY(0); }
        @keyframes gradient-shift { 0%, 100% { background-position: 0% 50%; } 50% { background-position: 100% 50%; } }
        .badge-gradient { background-size: 200% 200%; animation: gradient-shift 3s ease infinite; }
        @keyframes pulse-ring { 0% { box-shadow: 0 0 0 0 rgba(245, 158, 11, 0.4); } 70% { box-shadow: 0 0 0 6px rgba(245, 158, 11, 0); } 100% { box-shadow: 0 0 0 0 rgba(245, 158, 11, 0); } }
        .pulse-dot { animation: pulse-ring 2s ease infinite; }
        .card-glow { transition: all 0.4s cubic-bezier(0, 0, 0.2, 1); }
        .card-glow:hover { box-shadow: 0 8px 30px -8px rgba(245, 158, 11, 0.15), 0 2px 8px rgba(0,0,0,0.04) !important; }
        .icon-hover { transition: transform 0.35s cubic-bezier(0, 0, 0.2, 1.4); }
        .group:hover .icon-hover, .card-glow:hover .icon-hover { transform: translateY(-3px) scale(1.08); }
        .arrow-slide { transition: transform 0.3s cubic-bezier(0, 0, 0.2, 1); }
        .group:hover .arrow-slide, a:hover .arrow-slide { transform: translateX(4px); }
        .stat-hover .stat-value { transition: transform 0.4s cubic-bezier(0, 0, 0.2, 1.4); }
        .stat-hover:hover .stat-value { transform: scale(1.08); }
        .feature-dot { transition: transform 0.3s cubic-bezier(0, 0, 0.2, 1); }
        .card-glow:hover .feature-dot { transform: scale(1.5); }
        .lifecycle-line { background: linear-gradient(90deg, transparent, var(--color-warning-200), var(--color-success-200), var(--color-primary-200), transparent); transform: scaleX(0); transform-origin: left; transition: transform 1.2s cubic-bezier(0, 0, 0.2, 1) 0.3s; }
        .lifecycle-line.revealed { transform: scaleX(1); }
        @keyframes gantt-grow { from { transform: scaleX(0); transform-origin: left; } to { transform: scaleX(1); transform-origin: left; } }
        .gantt-bar { animation: gantt-grow 0.8s cubic-bezier(0, 0, 0.2, 1) both; }
        .pill-float { transition: transform 0.35s cubic-bezier(0, 0, 0.2, 1), box-shadow 0.35s cubic-bezier(0, 0, 0.2, 1); }
        .pill-float:hover { transform: translateY(-3px); box-shadow: 0 6px 20px -4px rgba(245, 158, 11, 0.12); }
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
                        <span class="text-sm font-medium text-text-primary">{{ __('Industrial project management solutions') }}</span>
                    </div>

                    <h1 class="mb-6 text-4xl leading-tight tracking-tight text-text-primary md:text-5xl lg:text-[3.5rem]"
                        style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                        {{ __('Manage your industrial projects') }}<br>
                        {{ __('— from order to handover') }}
                    </h1>

                    <p class="mb-10 max-w-xl text-lg text-text-secondary lg:text-xl">
                        {{ __('Production planning, on-site work, procurement, cost control — all in one system. The modular platform of Cégem360 covers the entire lifecycle of industrial projects, so spreadsheets don\'t run your projects.') }}
                    </p>

                    <div class="flex flex-wrap items-center gap-4">
                        <a href="{{ route('contact') }}"
                            class="group inline-flex items-center gap-2 rounded-full bg-warning-600 px-6 py-3 text-base font-medium text-white transition-all hover:bg-warning-700 hover:shadow-lg"
                            style="box-shadow: 0 1px 2px rgba(0,0,0,0.05);">
                            <span>{{ __('Online consultation') }}</span>
                            <svg class="arrow-slide h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                            </svg>
                        </a>
                        <a href="#megoldasok"
                            class="inline-flex items-center gap-2 rounded-full border border-border-light bg-surface-primary px-6 py-3 text-base font-medium text-text-primary transition-all hover:border-warning-200 hover:bg-surface-secondary hover:shadow-md">
                            {{ __('Solutions overview') }}
                        </a>
                    </div>
                </div>

                {{-- Gantt Chart Visual --}}
                <div class="reveal-right">
                    <div class="rounded-2xl border border-border-light bg-surface-primary p-6"
                        style="box-shadow: 0 4px 20px -4px rgba(0,0,0,0.06);">
                        <div class="mb-4 flex items-center justify-between border-b border-border-light pb-4">
                            <span class="text-sm font-bold text-text-primary">{{ __('Project schedule — Production line installation') }}</span>
                            <span class="text-xs text-text-tertiary">{{ __('2026. H1 · 24 weeks') }}</span>
                        </div>

                        {{-- Month headers + Gantt rows --}}
                        <div class="space-y-1.5">
                            {{-- Month row --}}
                            <div class="grid items-center" style="grid-template-columns: 90px 1fr;">
                                <span></span>
                                <div class="flex">
                                    <span class="flex-1 text-center text-[10px] font-semibold uppercase tracking-wider text-text-tertiary">{{ __('Jan') }}</span>
                                    <span class="flex-1 text-center text-[10px] font-semibold uppercase tracking-wider text-text-tertiary">{{ __('Feb') }}</span>
                                    <span class="flex-1 text-center text-[10px] font-semibold uppercase tracking-wider text-text-tertiary">{{ __('Mar') }}</span>
                                    <span class="flex-1 text-center text-[10px] font-semibold uppercase tracking-wider text-text-tertiary">{{ __('Apr') }}</span>
                                    <span class="flex-1 text-center text-[10px] font-semibold uppercase tracking-wider text-text-tertiary">{{ __('May') }}</span>
                                    <span class="flex-1 text-center text-[10px] font-semibold uppercase tracking-wider text-text-tertiary">{{ __('Jun') }}</span>
                                </div>
                            </div>

                            {{-- Gantt bars --}}
                            <div class="grid items-center" style="grid-template-columns: 90px 1fr;">
                                <span class="pr-3 text-xs font-semibold text-text-secondary">{{ __('Proposal') }}</span>
                                <div class="relative h-7 rounded-md bg-surface-secondary">
                                    <div class="gantt-bar absolute top-1 h-5 rounded-sm bg-warning-400" style="left: 0%; width: 35%; animation-delay: 0.2s;"></div>
                                </div>
                            </div>
                            <div class="grid items-center" style="grid-template-columns: 90px 1fr;">
                                <span class="pr-3 text-xs font-semibold text-text-secondary">{{ __('Procurement') }}</span>
                                <div class="relative h-7 rounded-md bg-surface-secondary">
                                    <div class="gantt-bar absolute top-1 h-5 rounded-sm bg-primary-400" style="left: 10%; width: 50%; animation-delay: 0.35s;"></div>
                                </div>
                            </div>
                            <div class="grid items-center" style="grid-template-columns: 90px 1fr;">
                                <span class="pr-3 text-xs font-semibold text-text-secondary">{{ __('Manufacturing') }}</span>
                                <div class="relative h-7 rounded-md bg-surface-secondary">
                                    <div class="gantt-bar absolute top-1 h-5 rounded-sm bg-success-400" style="left: 25%; width: 40%; animation-delay: 0.5s;"></div>
                                </div>
                            </div>
                            <div class="grid items-center" style="grid-template-columns: 90px 1fr;">
                                <span class="pr-3 text-xs font-semibold text-text-secondary">{{ __('Installation') }}</span>
                                <div class="relative h-7 rounded-md bg-surface-secondary">
                                    <div class="gantt-bar absolute top-1 h-5 rounded-sm bg-violet-400" style="left: 40%; width: 45%; animation-delay: 0.65s;"></div>
                                </div>
                            </div>
                            <div class="grid items-center" style="grid-template-columns: 90px 1fr;">
                                <span class="pr-3 text-xs font-semibold text-text-secondary">{{ __('Trial run') }}</span>
                                <div class="relative h-7 rounded-md bg-surface-secondary">
                                    <div class="gantt-bar absolute top-1 h-5 rounded-sm bg-cyan-400" style="left: 55%; width: 35%; animation-delay: 0.8s;"></div>
                                </div>
                            </div>
                            <div class="grid items-center" style="grid-template-columns: 90px 1fr;">
                                <span class="pr-3 text-xs font-semibold text-text-secondary">{{ __('Handover') }}</span>
                                <div class="relative h-7 rounded-md bg-surface-secondary">
                                    <div class="gantt-bar absolute top-1 h-5 rounded-sm bg-danger-400" style="left: 65%; width: 30%; animation-delay: 0.95s;"></div>
                                </div>
                            </div>
                        </div>

                        {{-- Status bar --}}
                        <div class="mt-4 flex gap-5 border-t border-border-light pt-3">
                            <span class="flex items-center gap-1.5 text-[11px] text-text-tertiary">
                                <span class="h-2 w-2 rounded-full bg-success-500"></span> {{ __('On schedule') }}
                            </span>
                            <span class="flex items-center gap-1.5 text-[11px] text-text-tertiary">
                                <span class="h-2 w-2 rounded-full bg-warning-500"></span> {{ __('94% complete') }}
                            </span>
                            <span class="flex items-center gap-1.5 text-[11px] text-text-tertiary">
                                <span class="h-2 w-2 rounded-full bg-primary-500"></span> {{ __('6 phases') }}
                            </span>
                            <span class="flex items-center gap-1.5 text-[11px] text-text-tertiary">
                                <span class="h-2 w-2 rounded-full bg-violet-500"></span> {{ __('12 people') }}
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
                <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-warning-600">{{ __('The challenge') }}</p>
                <h2 class="mb-4 text-3xl text-text-primary md:text-4xl" style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                    {{ __('These slow down industrial projects') }}
                </h2>
                <p class="max-w-xl text-lg text-text-secondary">
                    {{ __('Familiar situations for project managers at manufacturing, assembly, and construction companies.') }}
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
                    <h3 class="mb-2 text-lg font-bold text-text-primary">{{ __('Slipping deadlines') }}</h3>
                    <p class="text-sm leading-relaxed text-text-secondary">{{ __('Bottlenecks are discovered late — there is no real-time visibility into the status of resources and tasks.') }}</p>
                </div>

                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-7"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="icon-hover mb-5 flex h-12 w-12 items-center justify-center rounded-xl bg-warning-50">
                        <svg class="h-6 w-6 text-warning-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <h3 class="mb-2 text-lg font-bold text-text-primary">{{ __('Paper-based on-site work') }}</h3>
                    <p class="text-sm leading-relaxed text-text-secondary">{{ __('Worksheets, photos, material lists — all on paper, which enters the system days later, if at all.') }}</p>
                </div>

                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-7"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="icon-hover mb-5 flex h-12 w-12 items-center justify-center rounded-xl bg-violet-50">
                        <svg class="h-6 w-6 text-violet-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="mb-2 text-lg font-bold text-text-primary">{{ __('Escalating project costs') }}</h3>
                    <p class="text-sm leading-relaxed text-text-secondary">{{ __('The actual cost of materials and labor hours is only visible at the end of the project — by then there is no way to correct it.') }}</p>
                </div>

                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-7"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="icon-hover mb-5 flex h-12 w-12 items-center justify-center rounded-xl bg-primary-50">
                        <svg class="h-6 w-6 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                        </svg>
                    </div>
                    <h3 class="mb-2 text-lg font-bold text-text-primary">{{ __('Fragmented communication') }}</h3>
                    <p class="text-sm leading-relaxed text-text-secondary">{{ __('Sales, manufacturing, procurement, and the on-site team work in different systems — or nowhere.') }}</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Target Audiences Section --}}
    <section class="bg-surface-secondary py-16 lg:py-24" id="celcsoportok">
        <div class="mx-auto max-w-7xl px-6">
            <div class="reveal mb-12">
                <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-warning-600">{{ __('Who uses it?') }}</p>
                <h2 class="mb-4 text-3xl text-text-primary md:text-4xl" style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                    {{ __('All industrial project participants in one system') }}
                </h2>
                <p class="max-w-xl text-lg text-text-secondary">
                    {{ __('Cégem360 provides a shared workspace for the entire project team — in the office and on-site alike.') }}
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
                    <p class="mb-2 text-xs font-semibold uppercase tracking-wider text-warning-600">{{ __('Project manager') }}</p>
                    <h3 class="mb-3 text-lg font-bold text-text-primary">{{ __('Project managers') }}</h3>
                    <p class="text-sm leading-relaxed text-text-secondary">{{ __('Gantt chart, resource scheduling, milestones, and automatic alerts — full project control on a single interface.') }}</p>
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
                    <p class="mb-2 text-xs font-semibold uppercase tracking-wider text-violet-600">{{ __('Technical manager') }}</p>
                    <h3 class="mb-3 text-lg font-bold text-text-primary">{{ __('Technical directors') }}</h3>
                    <p class="text-sm leading-relaxed text-text-secondary">{{ __('Quality control, BOM management, production schedule, and capacity planning — managing the technical details.') }}</p>
                </div>

                <div class="stagger-item group card-glow relative overflow-hidden rounded-2xl border border-border-light bg-surface-primary p-8"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="absolute inset-x-0 top-0 h-1 bg-linear-to-r from-success-500 to-cyan-500 opacity-0 transition-opacity duration-500 group-hover:opacity-100"></div>
                    <div class="icon-hover mb-4 flex h-14 w-14 items-center justify-center rounded-2xl bg-success-50">
                        <svg class="h-7 w-7 text-success-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                    </div>
                    <p class="mb-2 text-xs font-semibold uppercase tracking-wider text-success-600">{{ __('Plant manager') }}</p>
                    <h3 class="mb-3 text-lg font-bold text-text-primary">{{ __('Plant managers') }}</h3>
                    <p class="text-sm leading-relaxed text-text-secondary">{{ __('Production tasks, worker performance, machine utilization, and maintenance schedule — in real time.') }}</p>
                </div>

                <div class="stagger-item group card-glow relative overflow-hidden rounded-2xl border border-border-light bg-surface-primary p-8"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="absolute inset-x-0 top-0 h-1 bg-linear-to-r from-primary-500 to-warning-500 opacity-0 transition-opacity duration-500 group-hover:opacity-100"></div>
                    <div class="icon-hover mb-4 flex h-14 w-14 items-center justify-center rounded-2xl bg-primary-50">
                        <svg class="h-7 w-7 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                        </svg>
                    </div>
                    <p class="mb-2 text-xs font-semibold uppercase tracking-wider text-primary-600">{{ __('CEO') }}</p>
                    <h3 class="mb-3 text-lg font-bold text-text-primary">{{ __('CEOs') }}</h3>
                    <p class="text-sm leading-relaxed text-text-secondary">{{ __('Project profitability, cost control dashboard, and strategic overview — in moments, based on data.') }}</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Core Toolkit Section --}}
    <section class="bg-surface-primary py-16 lg:py-24" id="megoldasok">
        <div class="mx-auto max-w-7xl px-6">
            <div class="reveal mb-12">
                <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-warning-600">{{ __('Project management toolkit') }}</p>
                <h2 class="mb-4 text-3xl text-text-primary md:text-4xl" style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                    {{ __('4 key modules for industrial project management') }}
                </h2>
                <p class="max-w-xl text-lg text-text-secondary">
                    {{ __('These modules directly support the daily coordination of the project team.') }}
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
                            <span class="rounded-md bg-warning-50 px-2.5 py-1 text-xs font-bold uppercase tracking-wider text-warning-600">{{ __('Manufacturing control') }}</span>
                        </div>
                        <span class="text-xs text-text-tertiary">{{ __('Production and capacity planning') }}</span>
                    </div>
                    <h3 class="mb-3 text-xl font-bold text-text-primary">{{ __('Plan and track the manufacturing process in real time') }}</h3>
                    <p class="mb-6 text-sm leading-relaxed text-text-secondary">{{ __('Capacity planning with Gantt charts, production sequence optimization, resource scheduling, quality control, and maintenance — the entire production cycle in one module.') }}</p>
                    <div class="mb-6 grid grid-cols-2 gap-2">
                        <span class="flex items-center gap-2 text-sm text-text-secondary">
                            <span class="feature-dot h-1.5 w-1.5 rounded-full bg-warning-500"></span>{{ __('Gantt schedule') }}
                        </span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary">
                            <span class="feature-dot h-1.5 w-1.5 rounded-full bg-warning-500"></span>{{ __('Capacity planning') }}
                        </span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary">
                            <span class="feature-dot h-1.5 w-1.5 rounded-full bg-warning-500"></span>{{ __('Quality control') }}
                        </span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary">
                            <span class="feature-dot h-1.5 w-1.5 rounded-full bg-warning-500"></span>{{ __('Maintenance') }}
                        </span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary">
                            <span class="feature-dot h-1.5 w-1.5 rounded-full bg-warning-500"></span>{{ __('Bill of materials (BOM)') }}
                        </span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary">
                            <span class="feature-dot h-1.5 w-1.5 rounded-full bg-warning-500"></span>{{ __('OEE metrics') }}
                        </span>
                    </div>
                    <a href="{{ route('products.gyartas') }}" class="inline-flex items-center gap-1.5 text-sm font-semibold text-warning-600 transition-colors hover:text-warning-700">
                        {{ __('View details') }}
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
                            <span class="rounded-md bg-success-50 px-2.5 py-1 text-xs font-bold uppercase tracking-wider text-success-600">{{ __('Digital worksheet') }}</span>
                        </div>
                        <span class="text-xs text-text-tertiary">{{ __('On-site work recording') }}</span>
                    </div>
                    <h3 class="mb-3 text-xl font-bold text-text-primary">{{ __('Record everything on-site — without paper') }}</h3>
                    <p class="mb-6 text-sm leading-relaxed text-text-secondary">{{ __('Work hours, materials used, photo documentation — from mobile, on-site. Instant digital protocol for the client, and billing data immediately at the office.') }}</p>
                    <div class="mb-6 grid grid-cols-2 gap-2">
                        <span class="flex items-center gap-2 text-sm text-text-secondary">
                            <span class="feature-dot h-1.5 w-1.5 rounded-full bg-success-500"></span>{{ __('Work time recording') }}
                        </span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary">
                            <span class="feature-dot h-1.5 w-1.5 rounded-full bg-success-500"></span>{{ __('Material usage') }}
                        </span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary">
                            <span class="feature-dot h-1.5 w-1.5 rounded-full bg-success-500"></span>{{ __('Photo documentation') }}
                        </span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary">
                            <span class="feature-dot h-1.5 w-1.5 rounded-full bg-success-500"></span>{{ __('Digital protocol') }}
                        </span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary">
                            <span class="feature-dot h-1.5 w-1.5 rounded-full bg-success-500"></span>{{ __('On-site signature') }}
                        </span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary">
                            <span class="feature-dot h-1.5 w-1.5 rounded-full bg-success-500"></span>{{ __('Instant billing data') }}
                        </span>
                    </div>
                    <a href="{{ route('products.szerviz') }}" class="inline-flex items-center gap-1.5 text-sm font-semibold text-success-600 transition-colors hover:text-success-700">
                        {{ __('View details') }}
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
                            <span class="rounded-md bg-violet-50 px-2.5 py-1 text-xs font-bold uppercase tracking-wider text-violet-600">{{ __('Automation') }}</span>
                        </div>
                        <span class="text-xs text-text-tertiary">{{ __('Workflows and triggers') }}</span>
                    </div>
                    <h3 class="mb-3 text-xl font-bold text-text-primary">{{ __('Automate the project\'s repetitive tasks') }}</h3>
                    <p class="mb-6 text-sm leading-relaxed text-text-secondary">{{ __('Visual drag-and-drop workflow builder: deadline reminders, task delegation, document generation, and status updates — rule-based, without code.') }}</p>
                    <div class="mb-6 grid grid-cols-2 gap-2">
                        <span class="flex items-center gap-2 text-sm text-text-secondary">
                            <span class="feature-dot h-1.5 w-1.5 rounded-full bg-violet-500"></span>{{ __('Drag & drop workflow') }}
                        </span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary">
                            <span class="feature-dot h-1.5 w-1.5 rounded-full bg-violet-500"></span>{{ __('Triggers and conditions') }}
                        </span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary">
                            <span class="feature-dot h-1.5 w-1.5 rounded-full bg-violet-500"></span>{{ __('Automatic notifications') }}
                        </span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary">
                            <span class="feature-dot h-1.5 w-1.5 rounded-full bg-violet-500"></span>{{ __('Document generation') }}
                        </span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary">
                            <span class="feature-dot h-1.5 w-1.5 rounded-full bg-violet-500"></span>{{ __('Task delegation') }}
                        </span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary">
                            <span class="feature-dot h-1.5 w-1.5 rounded-full bg-violet-500"></span>{{ __('Data synchronization') }}
                        </span>
                    </div>
                    <a href="{{ route('products.automatizalas') }}" class="inline-flex items-center gap-1.5 text-sm font-semibold text-violet-600 transition-colors hover:text-violet-700">
                        {{ __('View details') }}
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
                            <span class="rounded-md bg-blue-50 px-2.5 py-1 text-xs font-bold uppercase tracking-wider text-blue-600">{{ __('Controlling') }}</span>
                        </div>
                        <span class="text-xs text-text-tertiary">{{ __('Project financial control') }}</span>
                    </div>
                    <h3 class="mb-3 text-xl font-bold text-text-primary">{{ __('See project profitability — in real time') }}</h3>
                    <p class="mb-6 text-sm leading-relaxed text-text-secondary">{{ __('Project-level revenue-cost analysis, cash flow tracking, planned vs. actual cost comparison. Monthly closing is reduced from days to hours.') }}</p>
                    <div class="mb-6 grid grid-cols-2 gap-2">
                        <span class="flex items-center gap-2 text-sm text-text-secondary">
                            <span class="feature-dot h-1.5 w-1.5 rounded-full bg-blue-500"></span>{{ __('Project P&L') }}
                        </span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary">
                            <span class="feature-dot h-1.5 w-1.5 rounded-full bg-blue-500"></span>{{ __('Cash flow tracking') }}
                        </span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary">
                            <span class="feature-dot h-1.5 w-1.5 rounded-full bg-blue-500"></span>{{ __('Plan vs. actual comparison') }}
                        </span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary">
                            <span class="feature-dot h-1.5 w-1.5 rounded-full bg-blue-500"></span>{{ __('Cost center breakdown') }}
                        </span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary">
                            <span class="feature-dot h-1.5 w-1.5 rounded-full bg-blue-500"></span>{{ __('Automatic reports') }}
                        </span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary">
                            <span class="feature-dot h-1.5 w-1.5 rounded-full bg-blue-500"></span>{{ __('Executive dashboard') }}
                        </span>
                    </div>
                    <a href="{{ route('products.kontrolling') }}" class="inline-flex items-center gap-1.5 text-sm font-semibold text-blue-600 transition-colors hover:text-blue-700">
                        {{ __('View details') }}
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
                <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-warning-600">{{ __('Project lifecycle') }}</p>
                <h2 class="mb-4 text-3xl text-text-primary md:text-4xl" style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                    {{ __('Closed system — from proposal to handover') }}
                </h2>
                <p class="max-w-xl text-lg text-text-secondary">
                    {{ __('Different modules activate in each project phase — but the data always stays in the same system.') }}
                </p>
            </div>

            <div class="relative">
                {{-- Connector line (desktop only) --}}
                <div class="lifecycle-line reveal absolute top-8 right-[8%] left-[8%] hidden h-0.5 lg:block"></div>

                <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-6" data-stagger>
                    @php
                        $lifecycle = [
                            ['num' => '01', 'title' => __('Proposal'), 'desc' => __('Client needs are assessed, a professional proposal is prepared'), 'modules' => ['CRM', __('Sales')], 'color' => 'warning'],
                            ['num' => '02', 'title' => __('Planning'), 'desc' => __('Capacity scheduling, BOM assembly, and resource allocation'), 'modules' => [__('Manufacturing control'), __('Automation')], 'color' => 'amber'],
                            ['num' => '03', 'title' => __('Procurement'), 'desc' => __('Material ordering, supplier management, and inventory reservation'), 'modules' => [__('Procurement'), __('Controlling')], 'color' => 'success'],
                            ['num' => '04', 'title' => __('Execution'), 'desc' => __('Manufacturing, installation, and on-site work tracking'), 'modules' => [__('Manufacturing control'), __('Worksheet')], 'color' => 'primary'],
                            ['num' => '05', 'title' => __('Control'), 'desc' => __('Costs, deadlines, and quality checked in real time'), 'modules' => [__('Controlling'), 'DataMind'], 'color' => 'violet'],
                            ['num' => '06', 'title' => __('Handover'), 'desc' => __('Digital protocol, documentation, and customer satisfaction measurement'), 'modules' => [__('Worksheet'), 'CRM'], 'color' => 'cyan'],
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
                    <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-warning-600">{{ __('Full ecosystem') }}</p>
                    <h2 class="text-3xl text-text-primary md:text-4xl" style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                        {{ __('All 11 modules in the service of project success') }}
                    </h2>
                </div>
                <p class="reveal-right text-lg leading-relaxed text-text-secondary lg:mt-6">
                    {{ __('An industrial project is not just production. The proposal, procurement, finance, on-site work, and customer communication are all interconnected. In Cégem360, all data lives in the same system.') }}
                </p>
            </div>

            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4" data-stagger>
                <div class="stagger-item card-glow rounded-xl border border-border-light bg-surface-primary p-6 text-center"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="icon-hover mx-auto mb-3 flex h-11 w-11 items-center justify-center rounded-xl bg-primary-50">
                        <x-module-icon module="crm" size="xs" />
                    </div>
                    <h4 class="mb-1 text-sm font-bold text-text-primary">CRM</h4>
                    <p class="text-xs leading-relaxed text-text-tertiary">{{ __('Project-client relationship: communication, contracts, and follow-up on one timeline.') }}</p>
                </div>

                <div class="stagger-item card-glow rounded-xl border border-border-light bg-surface-primary p-6 text-center"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="icon-hover mx-auto mb-3 flex h-11 w-11 items-center justify-center rounded-xl bg-warning-50">
                        <x-module-icon module="ertekesites" size="xs" />
                    </div>
                    <h4 class="mb-1 text-sm font-bold text-text-primary">{{ __('Sales') }}</h4>
                    <p class="text-xs leading-relaxed text-text-tertiary">{{ __('Proposal templates, pricing, and proposal-to-order conversion — the starting point of the project.') }}</p>
                </div>

                <div class="stagger-item card-glow rounded-xl border border-border-light bg-surface-primary p-6 text-center"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="icon-hover mx-auto mb-3 flex h-11 w-11 items-center justify-center rounded-xl bg-success-50">
                        <x-module-icon module="beszerzes" size="xs" />
                    </div>
                    <h4 class="mb-1 text-sm font-bold text-text-primary">{{ __('Procurement & logistics') }}</h4>
                    <p class="text-xs leading-relaxed text-text-tertiary">{{ __('Project-assigned material ordering, supplier management, and automatic inventory reservation.') }}</p>
                </div>

                <div class="stagger-item card-glow rounded-xl border border-border-light bg-surface-primary p-6 text-center"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="icon-hover mx-auto mb-3 flex h-11 w-11 items-center justify-center rounded-xl bg-danger-50">
                        <x-module-icon module="seo" size="xs" />
                    </div>
                    <h4 class="mb-1 text-sm font-bold text-text-primary">{{ __('SEO Tool') }}</h4>
                    <p class="text-xs leading-relaxed text-text-tertiary">{{ __('SEO optimization of reference projects and case studies — so new clients find you.') }}</p>
                </div>

                <div class="stagger-item card-glow rounded-xl border border-border-light bg-surface-primary p-6 text-center"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="icon-hover mx-auto mb-3 flex h-11 w-11 items-center justify-center rounded-xl bg-violet-50">
                        <x-module-icon module="marketinghub" size="xs" />
                    </div>
                    <h4 class="mb-1 text-sm font-bold text-text-primary">MarketingHub</h4>
                    <p class="text-xs leading-relaxed text-text-tertiary">{{ __('Project references and customer satisfaction data for marketing campaigns.') }}</p>
                </div>

                <div class="stagger-item card-glow rounded-xl border border-border-light bg-surface-primary p-6 text-center"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="icon-hover mx-auto mb-3 flex h-11 w-11 items-center justify-center rounded-xl bg-cyan-50">
                        <x-module-icon module="datamind" size="xs" />
                    </div>
                    <h4 class="mb-1 text-sm font-bold text-text-primary">DataMind</h4>
                    <p class="text-xs leading-relaxed text-text-tertiary">{{ __('AI analysis of project data: trend forecasting, anomaly detection, and predictive estimates.') }}</p>
                </div>

                <div class="stagger-item card-glow rounded-xl border border-border-light bg-surface-primary p-6 text-center"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="icon-hover mx-auto mb-3 flex h-11 w-11 items-center justify-center rounded-xl bg-blue-50">
                        <x-module-icon module="ai-chat" size="xs" />
                    </div>
                    <h4 class="mb-1 text-sm font-bold text-text-primary">AI Chat</h4>
                    <p class="text-xs leading-relaxed text-text-tertiary">{{ __('Automating client communication: project status queries on the website, 24/7.') }}</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Stats Section --}}
    <section class="bg-surface-secondary py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-6">
            <div class="reveal mb-12 text-center">
                <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-warning-600">{{ __('Results') }}</p>
                <h2 class="text-3xl text-text-primary md:text-4xl" style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                    {{ __('Measurable improvement in industrial projects') }}
                </h2>
            </div>

            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4" data-stagger data-counter-trigger>
                <div class="stagger-item stat-hover rounded-2xl border border-border-light bg-surface-primary p-8 text-center"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <p class="stat-value mb-2 text-4xl font-bold text-warning-600" style="font-family: 'JetBrains Mono', monospace;" data-count="30" data-prefix="+" data-suffix="%">0%</p>
                    <p class="text-sm font-medium text-text-secondary">{{ __('Deadline adherence improvement') }}</p>
                </div>

                <div class="stagger-item stat-hover rounded-2xl border border-border-light bg-surface-primary p-8 text-center"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <p class="stat-value mb-2 text-4xl font-bold text-success-600" style="font-family: 'JetBrains Mono', monospace;" data-count="25" data-prefix="-" data-suffix="%">0%</p>
                    <p class="text-sm font-medium text-text-secondary">{{ __('Project cost reduction') }}</p>
                </div>

                <div class="stagger-item stat-hover rounded-2xl border border-border-light bg-surface-primary p-8 text-center"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <p class="stat-value mb-2 text-4xl font-bold text-primary-600" style="font-family: 'JetBrains Mono', monospace;" data-count="70" data-suffix="%">0%</p>
                    <p class="text-sm font-medium text-text-secondary">{{ __('Faster administration') }}</p>
                </div>

                <div class="stagger-item stat-hover rounded-2xl border border-border-light bg-surface-primary p-8 text-center"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <p class="stat-value mb-2 text-4xl font-bold text-violet-600" style="font-family: 'JetBrains Mono', monospace;" data-count="40" data-prefix="-" data-suffix="%">0%</p>
                    <p class="text-sm font-medium text-text-secondary">{{ __('Machine downtime reduction') }}</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Use Cases Section --}}
    <section class="bg-surface-primary py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-6">
            <div class="reveal mb-12">
                <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-warning-600">{{ __('Use cases') }}</p>
                <h2 class="mb-4 text-3xl text-text-primary md:text-4xl" style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                    {{ __('How industrial project managers use it') }}
                </h2>
            </div>

            <div class="grid grid-cols-1 gap-5 md:grid-cols-2 lg:grid-cols-3" data-stagger>
                @php
                    $useCases = [
                        ['num' => '01', 'title' => __('Production line installation project'), 'desc' => __('From proposal to trial run: capacity planning, procurement, on-site assembly, and handover protocol — in a single system, on a Gantt view.'), 'tags' => [__('Manufacturing control'), __('Worksheet'), __('Procurement')]],
                        ['num' => '02', 'title' => __('Service and maintenance projects'), 'desc' => __('Preventive maintenance schedules, on-site worksheets, and material usage — billing data immediately at the office.'), 'tags' => [__('Worksheet'), __('Automation'), __('Controlling')]],
                        ['num' => '03', 'title' => __('Project-based cost control'), 'desc' => __('Real-time project P&L: plan vs. actual, material and labor costs, and automatic alerts when the budget is at risk.'), 'tags' => [__('Controlling'), __('Manufacturing control'), 'DataMind']],
                        ['num' => '04', 'title' => __('Multi-site execution'), 'desc' => __('Coordinating teams working at different sites: task delegation, status tracking, and automatic notifications — in one system.'), 'tags' => [__('Automation'), __('Worksheet'), 'CRM']],
                        ['num' => '05', 'title' => __('Procurement coordination for projects'), 'desc' => __('Project-assigned material ordering, tracking delivery deadlines, and automatic inventory reservation — so a missing part does not stop the project.'), 'tags' => [__('Procurement'), __('Manufacturing control')]],
                        ['num' => '06', 'title' => __('Predictive project analysis'), 'desc' => __('DataMind\'s AI model learns from past project data to predict delay and cost overrun risks — before they happen.'), 'tags' => ['DataMind', __('Controlling')]],
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
                <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-warning-600">{{ __('Comparison') }}</p>
                <h2 class="mb-4 text-3xl text-text-primary md:text-4xl" style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                    {{ __('Instead of Excel and email — an integrated system') }}
                </h2>
                <p class="max-w-xl text-lg text-text-secondary">
                    {{ __('This is how project coordination changes with the introduction of Cégem360.') }}
                </p>
            </div>

            <div class="reveal-scale overflow-hidden rounded-2xl border border-border-light"
                style="box-shadow: 0 4px 20px -4px rgba(0,0,0,0.06);">
                <table class="w-full text-left text-sm">
                    <thead>
                        <tr class="bg-surface-primary">
                            <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-text-primary">{{ __('Capability') }}</th>
                            <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-text-tertiary">{{ __('Excel + Email') }}</th>
                            <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-warning-600">Cégem360</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-border-light">
                        @php
                            $comparisons = [
                                ['cap' => __('Real-time project status'), 'old' => __('Manual update'), 'new' => __('Automatic')],
                                ['cap' => __('On-site data recording'), 'old' => __('Paper → data entry'), 'new' => __('From mobile, instantly')],
                                ['cap' => __('Project cost control'), 'old' => __('End-of-month surprise'), 'new' => __('Real-time P&L')],
                                ['cap' => __('Procurement coordination'), 'old' => __('Email chains'), 'new' => __('Integrated inventory reservation')],
                                ['cap' => __('Automatic notifications'), 'old' => __('None'), 'new' => __('Trigger-based workflow')],
                                ['cap' => __('Client documentation'), 'old' => __('Days later'), 'new' => __('Instant digital protocol')],
                                ['cap' => __('Predictive analysis'), 'old' => __('Not possible'), 'new' => __('AI-based forecasting')],
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
                    <h3 class="mb-2 text-xl font-bold text-text-primary">{{ __('Personalized online consultation') }}</h3>
                    <p class="mb-4 max-w-lg text-sm leading-relaxed text-text-secondary">{{ __('30-minute video call where we assess how Cégem360 can fit into managing your industrial projects — from production planning to on-site work.') }}</p>
                    <div class="flex flex-wrap gap-5">
                        <span class="flex items-center gap-1.5 text-xs font-medium text-text-tertiary">
                            <svg class="h-3.5 w-3.5 text-success-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" /></svg>
                            {{ __('30-minute video call') }}
                        </span>
                        <span class="flex items-center gap-1.5 text-xs font-medium text-text-tertiary">
                            <svg class="h-3.5 w-3.5 text-success-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" /></svg>
                            {{ __('Industrial project consulting') }}
                        </span>
                        <span class="flex items-center gap-1.5 text-xs font-medium text-text-tertiary">
                            <svg class="h-3.5 w-3.5 text-success-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" /></svg>
                            {{ __('No commitment') }}
                        </span>
                    </div>
                </div>
                <a href="{{ route('contact') }}"
                    class="group inline-flex shrink-0 items-center gap-2 rounded-full bg-warning-600 px-6 py-3 text-base font-medium text-white transition-all hover:bg-warning-700 hover:shadow-lg"
                    style="box-shadow: 0 1px 2px rgba(0,0,0,0.05);">
                    {{ __('Request consultation') }}
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
                <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-warning-600">{{ __('Get started') }}</p>
                <h2 class="mb-4 text-3xl text-text-primary md:text-4xl" style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                    {{ __('Ready for more effective project management?') }}
                </h2>
                <p class="text-lg text-text-secondary">{{ __('Choose the next step for you.') }}</p>
            </div>

            <div class="mx-auto grid max-w-3xl grid-cols-1 gap-6 md:grid-cols-2" data-stagger>
                <div class="stagger-item card-glow rounded-2xl border border-warning-100 bg-linear-to-br from-warning-50/40 to-surface-primary p-8 text-center"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <h3 class="mb-3 text-lg font-bold text-text-primary">{{ __('Online consultation') }}</h3>
                    <p class="mb-6 text-sm leading-relaxed text-text-secondary">{{ __('Ask our experts in 30 minutes — via video call, tailored to your industrial project, with no obligation.') }}</p>
                    <a href="{{ route('contact') }}"
                        class="group inline-flex items-center gap-2 rounded-full border border-border-light bg-surface-primary px-5 py-2.5 text-sm font-medium text-text-primary transition-all hover:border-warning-200 hover:bg-surface-secondary hover:shadow-md">
                        {{ __('Book an appointment') }}
                        <svg class="arrow-slide h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                        </svg>
                    </a>
                </div>

                <div class="stagger-item card-glow rounded-2xl border border-amber-100 bg-linear-to-br from-amber-50/40 to-surface-primary p-8 text-center"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <h3 class="mb-3 text-lg font-bold text-text-primary">{{ __('Registration and trial') }}</h3>
                    <p class="mb-6 text-sm leading-relaxed text-text-secondary">{{ __('Explore the full functionality of the platform. Get to know the modules and start working immediately.') }}</p>
                    <a href="{{ route('register') }}"
                        class="group inline-flex items-center gap-2 rounded-full bg-warning-600 px-5 py-2.5 text-sm font-medium text-white transition-all hover:bg-warning-700 hover:shadow-lg"
                        style="box-shadow: 0 1px 2px rgba(0,0,0,0.05);">
                        {{ __('Registration') }}
                        <svg class="arrow-slide h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </section>
</div>
