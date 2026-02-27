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
        @keyframes pulse-ring { 0% { box-shadow: 0 0 0 0 rgba(6, 182, 212, 0.4); } 70% { box-shadow: 0 0 0 6px rgba(6, 182, 212, 0); } 100% { box-shadow: 0 0 0 0 rgba(6, 182, 212, 0); } }
        .pulse-dot { animation: pulse-ring 2s ease infinite; }
        .card-glow { transition: all 0.4s cubic-bezier(0, 0, 0.2, 1); }
        .card-glow:hover { box-shadow: 0 8px 30px -8px rgba(6, 182, 212, 0.15), 0 2px 8px rgba(0,0,0,0.04) !important; }
        .icon-hover { transition: transform 0.35s cubic-bezier(0, 0, 0.2, 1.4); }
        .group:hover .icon-hover, .card-glow:hover .icon-hover { transform: translateY(-3px) scale(1.08); }
        .arrow-slide { transition: transform 0.3s cubic-bezier(0, 0, 0.2, 1); }
        .group:hover .arrow-slide, a:hover .arrow-slide { transform: translateX(4px); }
        .stat-hover .stat-value { transition: transform 0.4s cubic-bezier(0, 0, 0.2, 1.4); }
        .stat-hover:hover .stat-value { transform: scale(1.08); }
        .feature-dot { transition: transform 0.3s cubic-bezier(0, 0, 0.2, 1); }
        .card-glow:hover .feature-dot { transform: scale(1.5); }
        .flow-line { background: linear-gradient(90deg, transparent, var(--color-cyan-200), var(--color-blue-200), var(--color-success-200), transparent); transform: scaleX(0); transform-origin: left; transition: transform 1.2s cubic-bezier(0, 0, 0.2, 1) 0.3s; }
        .flow-line.revealed { transform: scaleX(1); }
        @keyframes inv-grow { from { transform: scaleX(0); transform-origin: left; } to { transform: scaleX(1); transform-origin: left; } }
        .inv-bar { animation: inv-grow 0.8s cubic-bezier(0, 0, 0.2, 1) both; }
        @keyframes flow-dot { 0% { left: 0; opacity: 0; } 10% { opacity: 1; } 90% { opacity: 1; } 100% { left: 100%; opacity: 0; } }
        .pill-float { transition: transform 0.35s cubic-bezier(0, 0, 0.2, 1), box-shadow 0.35s cubic-bezier(0, 0, 0.2, 1); }
        .pill-float:hover { transform: translateY(-3px); box-shadow: 0 6px 20px -4px rgba(6, 182, 212, 0.12); }
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
                        <span class="text-sm font-medium text-text-primary">{{ __('Industrial supply chain management') }}</span>
                    </div>

                    <h1 class="mb-6 text-4xl leading-tight tracking-tight text-text-primary md:text-5xl lg:text-[3.5rem]"
                        style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                        {{ __('Know what is in stock') }}<br>
                        {{ __('— and what will be tomorrow') }}
                    </h1>

                    <p class="mb-10 max-w-xl text-lg text-text-secondary lg:text-xl">
                        {{ __('In industrial procurement, delayed deliveries, missing parts or overstocking costs millions. Cégem360 provides real-time inventory management, supplier control and AI-powered planning for your supply chain.') }}
                    </p>

                    <div class="flex flex-wrap items-center gap-4">
                        <a href="{{ route('contact') }}"
                            class="group inline-flex items-center gap-2 rounded-full bg-cyan-600 px-6 py-3 text-base font-medium text-white transition-all hover:bg-cyan-700 hover:shadow-lg"
                            style="box-shadow: 0 1px 2px rgba(0,0,0,0.05);">
                            <span>{{ __('Online consultation') }}</span>
                            <svg class="arrow-slide h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                            </svg>
                        </a>
                        <a href="#megoldasok"
                            class="inline-flex items-center gap-2 rounded-full border border-border-light bg-surface-primary px-6 py-3 text-base font-medium text-text-primary transition-all hover:border-cyan-200 hover:bg-surface-secondary hover:shadow-md">
                            {{ __('Solutions overview') }}
                        </a>
                    </div>
                </div>

                {{-- Supply Chain Tracker Visual --}}
                <div class="reveal-right">
                    <div class="rounded-2xl border border-border-light bg-surface-primary p-6"
                        style="box-shadow: 0 4px 20px -4px rgba(0,0,0,0.06);">
                        <div class="mb-4 flex items-center justify-between border-b border-border-light pb-4">
                            <span class="text-sm font-bold text-text-primary">{{ __('Supply chain tracker — Real-time') }}</span>
                            <span class="text-xs text-text-tertiary">{{ __('Industrial manufacturer · February 2026') }}</span>
                        </div>

                        {{-- Inventory Levels --}}
                        <div class="mb-5 space-y-2.5">
                            <div>
                                <div class="mb-1 flex items-center justify-between">
                                    <span class="text-xs font-semibold text-text-secondary">{{ __('Steel sheet') }}</span>
                                    <div class="flex items-center gap-2">
                                        <span class="text-xs font-bold text-text-primary" style="font-family: 'JetBrains Mono', monospace;">85%</span>
                                        <span class="text-[10px] text-success-600">{{ __('Optimal') }}</span>
                                    </div>
                                </div>
                                <div class="h-5 w-full rounded-md bg-surface-secondary">
                                    <div class="inv-bar h-5 rounded-md bg-cyan-400" style="width: 85%; animation-delay: 0.1s;"></div>
                                </div>
                            </div>
                            <div>
                                <div class="mb-1 flex items-center justify-between">
                                    <span class="text-xs font-semibold text-text-secondary">{{ __('Bearings') }}</span>
                                    <div class="flex items-center gap-2">
                                        <span class="text-xs font-bold text-text-primary" style="font-family: 'JetBrains Mono', monospace;">42%</span>
                                        <span class="text-[10px] text-warning-600">{{ __('Order sent') }}</span>
                                    </div>
                                </div>
                                <div class="h-5 w-full rounded-md bg-surface-secondary">
                                    <div class="inv-bar h-5 rounded-md bg-warning-400" style="width: 42%; animation-delay: 0.2s;"></div>
                                </div>
                            </div>
                            <div>
                                <div class="mb-1 flex items-center justify-between">
                                    <span class="text-xs font-semibold text-text-secondary">{{ __('Electronics') }}</span>
                                    <div class="flex items-center gap-2">
                                        <span class="text-xs font-bold text-text-primary" style="font-family: 'JetBrains Mono', monospace;">92%</span>
                                        <span class="text-[10px] text-success-600">{{ __('Restocked') }}</span>
                                    </div>
                                </div>
                                <div class="h-5 w-full rounded-md bg-surface-secondary">
                                    <div class="inv-bar h-5 rounded-md bg-success-400" style="width: 92%; animation-delay: 0.3s;"></div>
                                </div>
                            </div>
                            <div>
                                <div class="mb-1 flex items-center justify-between">
                                    <span class="text-xs font-semibold text-text-secondary">{{ __('Gaskets') }}</span>
                                    <div class="flex items-center gap-2">
                                        <span class="text-xs font-bold text-text-primary" style="font-family: 'JetBrains Mono', monospace;">18%</span>
                                        <span class="text-[10px] font-semibold text-danger-600">{{ __('Critical!') }}</span>
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
                                <span class="text-[10px] font-semibold uppercase tracking-wider text-text-tertiary">{{ __('Purchase order') }}</span>
                            </div>
                            <div class="h-0.5 max-w-[60px] flex-1 bg-linear-to-r from-cyan-300 to-cyan-200"></div>
                            <div class="flex flex-1 flex-col items-center gap-1">
                                <span class="h-2.5 w-2.5 rounded-full bg-blue-500" style="box-shadow: 0 0 8px rgba(59,130,246,0.5);"></span>
                                <span class="text-[10px] font-semibold uppercase tracking-wider text-text-tertiary">{{ __('Shipping') }}</span>
                            </div>
                            <div class="h-0.5 max-w-[60px] flex-1 bg-linear-to-r from-blue-300 to-blue-200"></div>
                            <div class="flex flex-1 flex-col items-center gap-1">
                                <span class="h-2.5 w-2.5 rounded-full bg-violet-500" style="box-shadow: 0 0 8px rgba(139,92,246,0.5);"></span>
                                <span class="text-[10px] font-semibold uppercase tracking-wider text-text-tertiary">{{ __('Receiving') }}</span>
                            </div>
                            <div class="h-0.5 max-w-[60px] flex-1 bg-linear-to-r from-violet-300 to-success-200"></div>
                            <div class="flex flex-1 flex-col items-center gap-1">
                                <span class="h-2.5 w-2.5 rounded-full bg-success-500" style="box-shadow: 0 0 8px rgba(16,185,129,0.5);"></span>
                                <span class="text-[10px] font-semibold uppercase tracking-wider text-text-tertiary">{{ __('Usage') }}</span>
                            </div>
                        </div>

                        {{-- Order rows --}}
                        <div class="space-y-1.5">
                            <div class="flex items-center justify-between rounded-lg bg-surface-secondary px-3 py-2">
                                <div>
                                    <span class="block text-xs font-medium text-text-secondary">{{ __('SKF bearing set') }}</span>
                                    <span class="text-[10px] text-text-tertiary">MagyarBearing Kft.</span>
                                </div>
                                <span class="text-xs font-bold text-text-primary" style="font-family: 'JetBrains Mono', monospace;">2.4M Ft</span>
                                <span class="rounded bg-cyan-50 px-2 py-0.5 text-[10px] font-semibold text-cyan-700">{{ __('In transit') }}</span>
                                <span class="text-[11px] text-text-tertiary" style="font-family: 'JetBrains Mono', monospace;">{{ __('ETA: 2 days') }}</span>
                            </div>
                            <div class="flex items-center justify-between rounded-lg bg-surface-secondary px-3 py-2">
                                <div>
                                    <span class="block text-xs font-medium text-text-secondary">{{ __('Welding wire (180 kg)') }}</span>
                                    <span class="text-[10px] text-text-tertiary">WeldTech Zrt.</span>
                                </div>
                                <span class="text-xs font-bold text-text-primary" style="font-family: 'JetBrains Mono', monospace;">680E Ft</span>
                                <span class="rounded bg-success-50 px-2 py-0.5 text-[10px] font-semibold text-success-700">{{ __('Received') }}</span>
                                <span class="text-[11px] text-text-tertiary" style="font-family: 'JetBrains Mono', monospace;">{{ __('Today 08:15') }}</span>
                            </div>
                            <div class="flex items-center justify-between rounded-lg bg-surface-secondary px-3 py-2">
                                <div>
                                    <span class="block text-xs font-medium text-text-secondary">{{ __('Gasket set (industrial)') }}</span>
                                    <span class="text-[10px] text-text-tertiary">SealPro Bt.</span>
                                </div>
                                <span class="text-xs font-bold text-text-primary" style="font-family: 'JetBrains Mono', monospace;">340E Ft</span>
                                <span class="rounded bg-warning-50 px-2 py-0.5 text-[10px] font-semibold text-warning-700">{{ __('Awaiting approval') }}</span>
                                <span class="text-[11px] font-semibold text-danger-600" style="font-family: 'JetBrains Mono', monospace;">{{ __('Urgent') }}</span>
                            </div>
                        </div>

                        {{-- Status bar --}}
                        <div class="mt-4 flex gap-5 border-t border-border-light pt-3">
                            <span class="flex items-center gap-1.5 text-[11px] text-text-tertiary">
                                <span class="h-2 w-2 rounded-full bg-success-500"></span> {{ __('12 active suppliers') }}
                            </span>
                            <span class="flex items-center gap-1.5 text-[11px] text-text-tertiary">
                                <span class="h-2 w-2 rounded-full bg-cyan-500"></span> {{ __('3 shipments in transit') }}
                            </span>
                            <span class="flex items-center gap-1.5 text-[11px] text-text-tertiary">
                                <span class="h-2 w-2 rounded-full bg-danger-500"></span> {{ __('1 critical stock') }}
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
                <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-cyan-600">{{ __('The challenge') }}</p>
                <h2 class="mb-4 text-3xl text-text-primary md:text-4xl" style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                    {{ __('These hinder industrial procurement and warehouse management') }}
                </h2>
                <p class="max-w-xl text-lg text-text-secondary">
                    {{ __('Familiar situations for procurement teams of manufacturing, assembly and maintenance companies.') }}
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
                    <h3 class="mb-2 text-lg font-bold text-text-primary">{{ __('Unexpected stockout') }}</h3>
                    <p class="text-sm leading-relaxed text-text-secondary">{{ __('A critical part running out is only discovered when the assembler reaches for it. Production stops, the project slips.') }}</p>
                </div>

                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-7"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="icon-hover mb-5 flex h-12 w-12 items-center justify-center rounded-xl bg-warning-50">
                        <svg class="h-6 w-6 text-warning-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="mb-2 text-lg font-bold text-text-primary">{{ __('Overstocking and capital lock-up') }}</h3>
                    <p class="text-sm leading-relaxed text-text-secondary">{{ __('For safety, they order a lot of everything, but millions worth of material sits in the warehouse — some of which will never be used.') }}</p>
                </div>

                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-7"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="icon-hover mb-5 flex h-12 w-12 items-center justify-center rounded-xl bg-violet-50">
                        <svg class="h-6 w-6 text-violet-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" />
                        </svg>
                    </div>
                    <h3 class="mb-2 text-lg font-bold text-text-primary">{{ __('Supplier chaos') }}</h3>
                    <p class="text-sm leading-relaxed text-text-secondary">{{ __('Who delivers what, at what price, by when? Supplier data is scattered: in email, on phone, in heads. You cannot compare offers.') }}</p>
                </div>

                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-7"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="icon-hover mb-5 flex h-12 w-12 items-center justify-center rounded-xl bg-cyan-50">
                        <svg class="h-6 w-6 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <h3 class="mb-2 text-lg font-bold text-text-primary">{{ __('Manual ordering process') }}</h3>
                    <p class="text-sm leading-relaxed text-text-secondary">{{ __('Procurement requests come verbally, orders go out by email, receiving is done on paper. No automation, no approval workflow.') }}</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Target Audiences Section --}}
    <section class="bg-surface-secondary py-16 lg:py-24" id="celcsoportok">
        <div class="mx-auto max-w-7xl px-6">
            <div class="reveal mb-12">
                <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-cyan-600">{{ __('Who uses it?') }}</p>
                <h2 class="mb-4 text-3xl text-text-primary md:text-4xl" style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                    {{ __('The entire supply chain — on one surface, in real time') }}
                </h2>
                <p class="max-w-xl text-lg text-text-secondary">
                    {{ __('Cégem360 provides transparency from procurement to warehouse and manufacturing.') }}
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
                    <p class="mb-2 text-xs font-semibold uppercase tracking-wider text-cyan-600">{{ __('Procurement manager') }}</p>
                    <h3 class="mb-3 text-lg font-bold text-text-primary">{{ __('Procurement managers') }}</h3>
                    <p class="text-sm leading-relaxed text-text-secondary">{{ __('Supplier comparison, automatic reorder points, discount management and supplier performance evaluation — in one system.') }}</p>
                </div>

                <div class="stagger-item group card-glow relative overflow-hidden rounded-2xl border border-border-light bg-surface-primary p-8"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="absolute inset-x-0 top-0 h-1 bg-linear-to-r from-blue-500 to-violet-400 opacity-0 transition-opacity duration-500 group-hover:opacity-100"></div>
                    <div class="icon-hover mb-4 flex h-14 w-14 items-center justify-center rounded-2xl bg-blue-50">
                        <svg class="h-7 w-7 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                        </svg>
                    </div>
                    <p class="mb-2 text-xs font-semibold uppercase tracking-wider text-blue-600">{{ __('Warehouse manager') }}</p>
                    <h3 class="mb-3 text-lg font-bold text-text-primary">{{ __('Warehouse managers') }}</h3>
                    <p class="text-sm leading-relaxed text-text-secondary">{{ __('Real-time stock levels, receiving workflow, inventory support and storage location management — without paper.') }}</p>
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
                    <p class="mb-2 text-xs font-semibold uppercase tracking-wider text-warning-600">{{ __('Production manager') }}</p>
                    <h3 class="mb-3 text-lg font-bold text-text-primary">{{ __('Plant and production managers') }}</h3>
                    <p class="text-sm leading-relaxed text-text-secondary">{{ __('Material requirements automatically from the production plan. Know when material will be needed — and whether it will arrive in time.') }}</p>
                </div>

                <div class="stagger-item group card-glow relative overflow-hidden rounded-2xl border border-border-light bg-surface-primary p-8"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="absolute inset-x-0 top-0 h-1 bg-linear-to-r from-indigo-500 to-blue-400 opacity-0 transition-opacity duration-500 group-hover:opacity-100"></div>
                    <div class="icon-hover mb-4 flex h-14 w-14 items-center justify-center rounded-2xl bg-indigo-50">
                        <svg class="h-7 w-7 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <p class="mb-2 text-xs font-semibold uppercase tracking-wider text-indigo-600">{{ __('Financial control') }}</p>
                    <h3 class="mb-3 text-lg font-bold text-text-primary">{{ __('CFOs and controllers') }}</h3>
                    <p class="text-sm leading-relaxed text-text-secondary">{{ __('Procurement costs, inventory value, supplier liabilities and cash flow impact — real-time financial data from procurement.') }}</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Core Toolkit Section --}}
    <section class="bg-surface-primary py-16 lg:py-24" id="megoldasok">
        <div class="mx-auto max-w-7xl px-6">
            <div class="reveal mb-12">
                <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-cyan-600">{{ __('Procurement toolkit') }}</p>
                <h2 class="mb-4 text-3xl text-text-primary md:text-4xl" style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                    {{ __('4 key modules for supply chain management') }}
                </h2>
                <p class="max-w-xl text-lg text-text-secondary">
                    {{ __('Together, these modules form the foundation for digitalizing industrial procurement.') }}
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
                            <span class="rounded-md bg-cyan-50 px-2.5 py-1 text-xs font-bold uppercase tracking-wider text-cyan-600">{{ __('Procurement & logistics') }}</span>
                        </div>
                        <span class="text-xs text-text-tertiary">{{ __('Inventory and delivery management') }}</span>
                    </div>
                    <h3 class="mb-3 text-xl font-bold text-text-primary">{{ __('Inventory management, supplier ordering and receiving') }}</h3>
                    <p class="mb-6 text-sm leading-relaxed text-text-secondary">{{ __('Real-time stock level tracking, automatic minimum stock alerts, supplier database, order management and receiving workflow — the central brain of procurement.') }}</p>
                    <div class="mb-6 grid grid-cols-2 gap-2">
                        <span class="flex items-center gap-2 text-sm text-text-secondary">
                            <span class="feature-dot h-1.5 w-1.5 rounded-full bg-cyan-500"></span>{{ __('Real-time stock level') }}
                        </span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary">
                            <span class="feature-dot h-1.5 w-1.5 rounded-full bg-cyan-500"></span>{{ __('Automatic reordering') }}
                        </span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary">
                            <span class="feature-dot h-1.5 w-1.5 rounded-full bg-cyan-500"></span>{{ __('Supplier database') }}
                        </span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary">
                            <span class="feature-dot h-1.5 w-1.5 rounded-full bg-cyan-500"></span>{{ __('Quote comparison') }}
                        </span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary">
                            <span class="feature-dot h-1.5 w-1.5 rounded-full bg-cyan-500"></span>{{ __('Receiving workflow') }}
                        </span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary">
                            <span class="feature-dot h-1.5 w-1.5 rounded-full bg-cyan-500"></span>{{ __('Inventory support') }}
                        </span>
                    </div>
                    <a href="{{ route('products.beszerzes') }}" class="inline-flex items-center gap-1.5 text-sm font-semibold text-cyan-600 transition-colors hover:text-cyan-700">
                        {{ __('View details') }}
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
                            <span class="rounded-md bg-success-50 px-2.5 py-1 text-xs font-bold uppercase tracking-wider text-success-600">{{ __('Manufacturing control') }}</span>
                        </div>
                        <span class="text-xs text-text-tertiary">{{ __('Material requirements and capacity') }}</span>
                    </div>
                    <h3 class="mb-3 text-xl font-bold text-text-primary">{{ __('Manufacturing material requirements automatically from the production plan') }}</h3>
                    <p class="mb-6 text-sm leading-relaxed text-text-secondary">{{ __('Based on the bill of materials (BOM), the system automatically calculates material requirements for planned production orders — and alerts when stock is insufficient.') }}</p>
                    <div class="mb-6 grid grid-cols-2 gap-2">
                        <span class="flex items-center gap-2 text-sm text-text-secondary">
                            <span class="feature-dot h-1.5 w-1.5 rounded-full bg-success-500"></span>{{ __('BOM-based requirements') }}
                        </span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary">
                            <span class="feature-dot h-1.5 w-1.5 rounded-full bg-success-500"></span>{{ __('Capacity sync') }}
                        </span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary">
                            <span class="feature-dot h-1.5 w-1.5 rounded-full bg-success-500"></span>{{ __('Shortage list generation') }}
                        </span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary">
                            <span class="feature-dot h-1.5 w-1.5 rounded-full bg-success-500"></span>{{ __('Production schedule') }}
                        </span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary">
                            <span class="feature-dot h-1.5 w-1.5 rounded-full bg-success-500"></span>{{ __('Quality control') }}
                        </span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary">
                            <span class="feature-dot h-1.5 w-1.5 rounded-full bg-success-500"></span>{{ __('Scrap tracking') }}
                        </span>
                    </div>
                    <a href="{{ route('products.gyartas') }}" class="inline-flex items-center gap-1.5 text-sm font-semibold text-success-600 transition-colors hover:text-success-700">
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
                        <span class="text-xs text-text-tertiary">{{ __('Procurement workflows') }}</span>
                    </div>
                    <h3 class="mb-3 text-xl font-bold text-text-primary">{{ __('Approval workflows, alerts and automatic ordering') }}</h3>
                    <p class="mb-6 text-sm leading-relaxed text-text-secondary">{{ __('Stock level trigger → procurement request → approval → order dispatch → receiving notification — no-code, with drag-and-drop workflow.') }}</p>
                    <div class="mb-6 grid grid-cols-2 gap-2">
                        <span class="flex items-center gap-2 text-sm text-text-secondary">
                            <span class="feature-dot h-1.5 w-1.5 rounded-full bg-violet-500"></span>{{ __('Approval chain') }}
                        </span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary">
                            <span class="feature-dot h-1.5 w-1.5 rounded-full bg-violet-500"></span>{{ __('Stock alert trigger') }}
                        </span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary">
                            <span class="feature-dot h-1.5 w-1.5 rounded-full bg-violet-500"></span>{{ __('Automatic ordering') }}
                        </span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary">
                            <span class="feature-dot h-1.5 w-1.5 rounded-full bg-violet-500"></span>{{ __('Receiving notification') }}
                        </span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary">
                            <span class="feature-dot h-1.5 w-1.5 rounded-full bg-violet-500"></span>{{ __('Supplier email trigger') }}
                        </span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary">
                            <span class="feature-dot h-1.5 w-1.5 rounded-full bg-violet-500"></span>{{ __('Deadline monitoring') }}
                        </span>
                    </div>
                    <a href="{{ route('products.automatizalas') }}" class="inline-flex items-center gap-1.5 text-sm font-semibold text-violet-600 transition-colors hover:text-violet-700">
                        {{ __('View details') }}
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
                        <span class="text-xs text-text-tertiary">{{ __('AI-powered supply chain planning') }}</span>
                    </div>
                    <h3 class="mb-3 text-xl font-bold text-text-primary">{{ __('Predictive inventory management and supplier performance analysis') }}</h3>
                    <p class="mb-6 text-sm leading-relaxed text-text-secondary">{{ __('AI predicts inventory needs based on past usage patterns and planned projects. Anomaly detection in supplier prices and delivery times.') }}</p>
                    <div class="mb-6 grid grid-cols-2 gap-2">
                        <span class="flex items-center gap-2 text-sm text-text-secondary">
                            <span class="feature-dot h-1.5 w-1.5 rounded-full bg-blue-500"></span>{{ __('Consumption forecasting') }}
                        </span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary">
                            <span class="feature-dot h-1.5 w-1.5 rounded-full bg-blue-500"></span>{{ __('Supplier rating') }}
                        </span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary">
                            <span class="feature-dot h-1.5 w-1.5 rounded-full bg-blue-500"></span>{{ __('Price anomaly detection') }}
                        </span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary">
                            <span class="feature-dot h-1.5 w-1.5 rounded-full bg-blue-500"></span>{{ __('Seasonal planning') }}
                        </span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary">
                            <span class="feature-dot h-1.5 w-1.5 rounded-full bg-blue-500"></span>{{ __('Inventory optimization') }}
                        </span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary">
                            <span class="feature-dot h-1.5 w-1.5 rounded-full bg-blue-500"></span>{{ __('Automatic summaries') }}
                        </span>
                    </div>
                    <a href="{{ route('products.datamind') }}" class="inline-flex items-center gap-1.5 text-sm font-semibold text-blue-600 transition-colors hover:text-blue-700">
                        {{ __('View details') }}
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
                <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-cyan-600">{{ __('Supply chain cycle') }}</p>
                <h2 class="mb-4 text-3xl text-text-primary md:text-4xl" style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                    {{ __('From need to usage — in a closed system') }}
                </h2>
                <p class="max-w-xl text-lg text-text-secondary">
                    {{ __('Every step is automatically documented, traceable and financially reportable.') }}
                </p>
            </div>

            <div class="relative">
                {{-- Connector line (desktop only) --}}
                <div class="flow-line reveal absolute top-8 right-[8%] left-[8%] hidden h-0.5 lg:block"></div>

                <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-6" data-stagger>
                    @php
                        $lifecycle = [
                            ['num' => '01', 'title' => __('Need'), 'desc' => __('Based on production plan or manual request'), 'modules' => [__('Manufacturing'), __('Worksheet')], 'color' => 'cyan'],
                            ['num' => '02', 'title' => __('Approval'), 'desc' => __('Automatic workflow, levels and limit management'), 'modules' => [__('Automation')], 'color' => 'blue'],
                            ['num' => '03', 'title' => __('Purchase order'), 'desc' => __('Supplier selection, quote comparison'), 'modules' => [__('Procurement')], 'color' => 'violet'],
                            ['num' => '04', 'title' => __('Tracking'), 'desc' => __('Shipment status, ETA and delay monitoring'), 'modules' => [__('Procurement'), __('Automation')], 'color' => 'success'],
                            ['num' => '05', 'title' => __('Receiving'), 'desc' => __('Quantity and quality inspection'), 'modules' => [__('Procurement'), __('Manufacturing')], 'color' => 'warning'],
                            ['num' => '06', 'title' => __('Settlement'), 'desc' => __('Supplier invoice and financial control'), 'modules' => [__('Controlling')], 'color' => 'indigo'],
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
                    <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-cyan-600">{{ __('Full ecosystem') }}</p>
                    <h2 class="text-3xl text-text-primary md:text-4xl" style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                        {{ __('All 11 modules connect to the supply chain') }}
                    </h2>
                </div>
                <p class="reveal-right text-lg leading-relaxed text-text-secondary lg:mt-6">
                    {{ __('Procurement is not an isolated island — sales generates demand, manufacturing consumes material, service uses warehouse stock on-site, and controlling measures costs. When all of this is in one system, procurement becomes proactive — not reactive.') }}
                </p>
            </div>

            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4" data-stagger>
                <div class="stagger-item card-glow rounded-xl border border-border-light bg-surface-primary p-6 text-center"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="icon-hover mx-auto mb-3 flex h-11 w-11 items-center justify-center rounded-xl bg-success-50">
                        <x-module-icon module="crm" size="xs" />
                    </div>
                    <h4 class="mb-1 text-sm font-bold text-text-primary">{{ __('CRM & Sales') }}</h4>
                    <p class="text-xs leading-relaxed text-text-tertiary">{{ __('Ordered items automatically generate procurement requests — from customer order to supplier order.') }}</p>
                </div>

                <div class="stagger-item card-glow rounded-xl border border-border-light bg-surface-primary p-6 text-center"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="icon-hover mx-auto mb-3 flex h-11 w-11 items-center justify-center rounded-xl bg-warning-50">
                        <x-module-icon module="gyartas" size="xs" />
                    </div>
                    <h4 class="mb-1 text-sm font-bold text-text-primary">{{ __('Manufacturing control') }}</h4>
                    <p class="text-xs leading-relaxed text-text-tertiary">{{ __('BOM-based material requirements from the production plan — procurement knows what to order before it runs out.') }}</p>
                </div>

                <div class="stagger-item card-glow rounded-xl border border-border-light bg-surface-primary p-6 text-center"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="icon-hover mx-auto mb-3 flex h-11 w-11 items-center justify-center rounded-xl bg-indigo-50">
                        <x-module-icon module="kontrolling" size="xs" />
                    </div>
                    <h4 class="mb-1 text-sm font-bold text-text-primary">{{ __('Controlling') }}</h4>
                    <p class="text-xs leading-relaxed text-text-tertiary">{{ __('Procurement costs, inventory value, supplier liabilities — financial control in real time.') }}</p>
                </div>

                <div class="stagger-item card-glow rounded-xl border border-border-light bg-surface-primary p-6 text-center"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="icon-hover mx-auto mb-3 flex h-11 w-11 items-center justify-center rounded-xl bg-cyan-50">
                        <x-module-icon module="szerviz" size="xs" />
                    </div>
                    <h4 class="mb-1 text-sm font-bold text-text-primary">{{ __('Digital worksheet') }}</h4>
                    <p class="text-xs leading-relaxed text-text-tertiary">{{ __('On-site technicians material usage automatically reduces warehouse stock — real-time consumption.') }}</p>
                </div>

                <div class="stagger-item card-glow rounded-xl border border-border-light bg-surface-primary p-6 text-center"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="icon-hover mx-auto mb-3 flex h-11 w-11 items-center justify-center rounded-xl bg-pink-50">
                        <x-module-icon module="marketinghub" size="xs" />
                    </div>
                    <h4 class="mb-1 text-sm font-bold text-text-primary">MarketingHub</h4>
                    <p class="text-xs leading-relaxed text-text-tertiary">{{ __('The impact of demand increase generated by marketing campaigns on inventory load — forecasting.') }}</p>
                </div>

                <div class="stagger-item card-glow rounded-xl border border-border-light bg-surface-primary p-6 text-center"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="icon-hover mx-auto mb-3 flex h-11 w-11 items-center justify-center rounded-xl bg-blue-50">
                        <x-module-icon module="ai-chat" size="xs" />
                    </div>
                    <h4 class="mb-1 text-sm font-bold text-text-primary">AI Chat</h4>
                    <p class="text-xs leading-relaxed text-text-tertiary">{{ __('Supplier status query via internal chatbot: the production manager asks where the order stands — the AI answers.') }}</p>
                </div>

                <div class="stagger-item card-glow rounded-xl border border-border-light bg-surface-primary p-6 text-center"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="icon-hover mx-auto mb-3 flex h-11 w-11 items-center justify-center rounded-xl bg-violet-50">
                        <x-module-icon module="datamind" size="xs" />
                    </div>
                    <h4 class="mb-1 text-sm font-bold text-text-primary">DataMind</h4>
                    <p class="text-xs leading-relaxed text-text-tertiary">{{ __('Predictive inventory, supplier performance ranking and seasonal consumption pattern recognition with AI.') }}</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Stats Section --}}
    <section class="bg-surface-secondary py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-6">
            <div class="reveal mb-12 text-center">
                <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-cyan-600">{{ __('Results') }}</p>
                <h2 class="text-3xl text-text-primary md:text-4xl" style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                    {{ __('Measurable improvement in supply chain performance') }}
                </h2>
            </div>

            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4" data-stagger data-counter-trigger>
                <div class="stagger-item stat-hover rounded-2xl border border-border-light bg-surface-primary p-8 text-center"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <p class="stat-value mb-2 text-4xl font-bold text-cyan-600" style="font-family: 'JetBrains Mono', monospace;" data-count="35" data-prefix="-" data-suffix="%">0%</p>
                    <p class="text-sm font-medium text-text-secondary">{{ __('Downtime due to stockout') }}</p>
                </div>

                <div class="stagger-item stat-hover rounded-2xl border border-border-light bg-surface-primary p-8 text-center"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <p class="stat-value mb-2 text-4xl font-bold text-success-600" style="font-family: 'JetBrains Mono', monospace;" data-count="25" data-prefix="-" data-suffix="%">0%</p>
                    <p class="text-sm font-medium text-text-secondary">{{ __('Warehouse capital lock-up') }}</p>
                </div>

                <div class="stagger-item stat-hover rounded-2xl border border-border-light bg-surface-primary p-8 text-center"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <p class="stat-value mb-2 text-4xl font-bold text-blue-600" style="font-family: 'JetBrains Mono', monospace;" data-count="60" data-prefix="-" data-suffix="%">0%</p>
                    <p class="text-sm font-medium text-text-secondary">{{ __('Procurement admin time') }}</p>
                </div>

                <div class="stagger-item stat-hover rounded-2xl border border-border-light bg-surface-primary p-8 text-center"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <p class="stat-value mb-2 text-4xl font-bold text-warning-600" style="font-family: 'JetBrains Mono', monospace;" data-count="20" data-prefix="+" data-suffix="%">0%</p>
                    <p class="text-sm font-medium text-text-secondary">{{ __('Supplier performance improvement') }}</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Use Cases Section --}}
    <section class="bg-surface-primary py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-6">
            <div class="reveal mb-12">
                <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-cyan-600">{{ __('Use cases') }}</p>
                <h2 class="mb-4 text-3xl text-text-primary md:text-4xl" style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                    {{ __('How industrial procurement teams use it') }}
                </h2>
            </div>

            <div class="grid grid-cols-1 gap-5 md:grid-cols-2 lg:grid-cols-3" data-stagger>
                @php
                    $useCases = [
                        ['num' => '01', 'title' => __('Automatic minimum stock alert and reordering'), 'desc' => __('When a critical part reaches the minimum level, the system automatically alerts, and after approval generates an order at the preferred supplier — without human intervention.'), 'tags' => [__('Procurement'), __('Automation')]],
                        ['num' => '02', 'title' => __('BOM-based material requirements planning'), 'desc' => __('When a production order arrives, the system automatically compiles the material requirements based on the bill of materials (BOM) — and shows what is in stock and what is missing.'), 'tags' => [__('Manufacturing control'), __('Procurement')]],
                        ['num' => '03', 'title' => __('Supplier performance evaluation'), 'desc' => __('Delivery accuracy, quality, price competitiveness — DataMind automatically ranks suppliers and alerts when a supplier shows declining performance.'), 'tags' => ['DataMind', __('Procurement')]],
                        ['num' => '04', 'title' => __('Multi-level approval workflow'), 'desc' => __('Under 100K Ft automatic approval, 100K-1M Ft procurement manager, above that CEO. The system manages the workflow — and logs every step.'), 'tags' => [__('Automation'), __('Controlling')]],
                        ['num' => '05', 'title' => __('Service visit material handling'), 'desc' => __('The on-site technician records used material on the digital worksheet — stock decreases automatically, cost is assigned to the project, and reordering starts if needed.'), 'tags' => [__('Worksheet'), __('Procurement'), __('Controlling')]],
                        ['num' => '06', 'title' => __('Predictive inventory with AI'), 'desc' => __('DataMind predicts from past usage patterns and planned projects when and how much material will be needed — weeks before actual consumption.'), 'tags' => ['DataMind', __('Manufacturing control')]],
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
                <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-cyan-600">{{ __('Comparison') }}</p>
                <h2 class="mb-4 text-3xl text-text-primary md:text-4xl" style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                    {{ __('Instead of phone calls — integrated supply chain management') }}
                </h2>
                <p class="max-w-xl text-lg text-text-secondary">
                    {{ __('This is how procurement work changes with the introduction of Cégem360.') }}
                </p>
            </div>

            <div class="reveal-scale overflow-hidden rounded-2xl border border-border-light"
                style="box-shadow: 0 4px 20px -4px rgba(0,0,0,0.06);">
                <table class="w-full text-left text-sm">
                    <thead>
                        <tr class="bg-surface-primary">
                            <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-text-primary">{{ __('Capability') }}</th>
                            <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-text-tertiary">{{ __('Traditional method') }}</th>
                            <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-cyan-600">Cégem360</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-border-light">
                        @php
                            $comparisons = [
                                ['cap' => __('Stock level overview'), 'old' => __('During inventory, quarterly'), 'new' => __('Real-time, on dashboard')],
                                ['cap' => __('Reordering'), 'old' => __('When they notice the shortage'), 'new' => __('Automatic trigger')],
                                ['cap' => __('Supplier comparison'), 'old' => __('In heads / from old quotes'), 'new' => __('Automatic ranking')],
                                ['cap' => __('Approval process'), 'old' => __('Email / verbally'), 'new' => __('Rule-based workflow')],
                                ['cap' => __('Material requirements planning'), 'old' => __('Manual calculation'), 'new' => __('BOM-based, automatic')],
                                ['cap' => __('Stock forecasting'), 'old' => __('Gut feeling'), 'new' => __('AI prediction from patterns')],
                                ['cap' => __('Service material usage'), 'old' => __('Reported later / not reported'), 'new' => __('Real-time on worksheet')],
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
                    <h3 class="mb-2 text-xl font-bold text-text-primary">{{ __('Personalized online consultation') }}</h3>
                    <p class="mb-4 max-w-lg text-sm leading-relaxed text-text-secondary">{{ __('A 30-minute video call where we assess how you can digitalize your procurement and warehouse management processes with Cégem360 — tailored to your industry and supply chain.') }}</p>
                    <div class="flex flex-wrap gap-5">
                        <span class="flex items-center gap-1.5 text-xs font-medium text-text-tertiary">
                            <svg class="h-3.5 w-3.5 text-cyan-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" /></svg>
                            {{ __('30-minute video call') }}
                        </span>
                        <span class="flex items-center gap-1.5 text-xs font-medium text-text-tertiary">
                            <svg class="h-3.5 w-3.5 text-cyan-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" /></svg>
                            {{ __('Procurement process audit') }}
                        </span>
                        <span class="flex items-center gap-1.5 text-xs font-medium text-text-tertiary">
                            <svg class="h-3.5 w-3.5 text-cyan-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" /></svg>
                            {{ __('No commitment') }}
                        </span>
                    </div>
                </div>
                <a href="{{ route('contact') }}"
                    class="group inline-flex shrink-0 items-center gap-2 rounded-full bg-cyan-600 px-6 py-3 text-base font-medium text-white transition-all hover:bg-cyan-700 hover:shadow-lg"
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
                <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-cyan-600">{{ __('Get started') }}</p>
                <h2 class="mb-4 text-3xl text-text-primary md:text-4xl" style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                    {{ __('Ready for a transparent supply chain?') }}
                </h2>
                <p class="text-lg text-text-secondary">{{ __('Choose the next step for you.') }}</p>
            </div>

            <div class="mx-auto grid max-w-3xl grid-cols-1 gap-6 md:grid-cols-2" data-stagger>
                <div class="stagger-item card-glow rounded-2xl border border-cyan-100 bg-linear-to-br from-cyan-50/40 to-surface-primary p-8 text-center"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <h3 class="mb-3 text-lg font-bold text-text-primary">{{ __('Online consultation') }}</h3>
                    <p class="mb-6 text-sm leading-relaxed text-text-secondary">{{ __('Ask our experts in 30 minutes — via video call, tailored to your procurement challenges, with no obligation.') }}</p>
                    <a href="{{ route('contact') }}"
                        class="group inline-flex items-center gap-2 rounded-full border border-border-light bg-surface-primary px-5 py-2.5 text-sm font-medium text-text-primary transition-all hover:border-cyan-200 hover:bg-surface-secondary hover:shadow-md">
                        {{ __('Book an appointment') }}
                        <svg class="arrow-slide h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                        </svg>
                    </a>
                </div>

                <div class="stagger-item card-glow rounded-2xl border border-blue-100 bg-linear-to-br from-blue-50/40 to-surface-primary p-8 text-center"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <h3 class="mb-3 text-lg font-bold text-text-primary">{{ __('Registration and trial') }}</h3>
                    <p class="mb-6 text-sm leading-relaxed text-text-secondary">{{ __('Explore inventory management, the supplier module and automatic ordering workflows — immediately.') }}</p>
                    <a href="{{ route('register') }}"
                        class="group inline-flex items-center gap-2 rounded-full bg-cyan-600 px-5 py-2.5 text-sm font-medium text-white transition-all hover:bg-cyan-700 hover:shadow-lg"
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
