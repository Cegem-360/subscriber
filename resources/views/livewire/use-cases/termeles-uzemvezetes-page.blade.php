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
            0% { box-shadow: 0 0 0 0 rgba(249, 115, 22, 0.4); }
            70% { box-shadow: 0 0 0 6px rgba(249, 115, 22, 0); }
            100% { box-shadow: 0 0 0 0 rgba(249, 115, 22, 0); }
        }
        .pulse-dot { animation: pulse-ring 2s ease infinite; }

        /* Card hover glow */
        .card-glow {
            transition: all 0.4s cubic-bezier(0, 0, 0.2, 1);
        }
        .card-glow:hover {
            box-shadow: 0 8px 30px -8px rgba(249, 115, 22, 0.15), 0 2px 8px rgba(0,0,0,0.04) !important;
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

        /* OEE bar animation */
        @keyframes oee-grow {
            from { transform: scaleX(0); transform-origin: left; }
            to { transform: scaleX(1); transform-origin: left; }
        }
        .oee-bar {
            animation: oee-grow 0.8s cubic-bezier(0, 0, 0.2, 1) both;
        }

        /* Machine dot pulse */
        @keyframes machine-pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.4; }
        }
        .machine-dot-pulse { animation: machine-pulse 2s ease infinite; }

        /* Pill float */
        .pill-float {
            transition: transform 0.35s cubic-bezier(0, 0, 0.2, 1), box-shadow 0.35s cubic-bezier(0, 0, 0.2, 1);
        }
        .pill-float:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 20px -4px rgba(249, 115, 22, 0.12);
        }

        /* Smooth scroll for anchor links */
        html { scroll-behavior: smooth; }
    </style>

    {{-- Hero Section --}}
    <section class="bg-linear-to-b from-orange-50 to-surface-secondary">
        <div class="mx-auto max-w-7xl px-6 py-16 lg:py-24">
            <div class="grid grid-cols-1 items-center gap-12 lg:grid-cols-2">
                {{-- Hero Text --}}
                <div class="reveal">
                    <div class="badge-gradient mb-8 inline-flex items-center gap-2 rounded-full border border-border-light/80 bg-surface-primary px-4 py-1.5"
                        style="box-shadow: 0 1px 3px rgba(0,0,0,0.04);">
                        <span class="pulse-dot h-1.5 w-1.5 rounded-full bg-linear-to-r from-orange-500 via-amber-500 to-rose-500"></span>
                        <span class="text-sm font-medium text-text-primary">{{ __('Industrial production management solutions') }}</span>
                    </div>

                    <h1 class="mb-6 text-4xl leading-tight tracking-tight text-text-primary md:text-5xl lg:text-[3.5rem]"
                        style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                        {{ __('Control production') }}<br>
                        {{ __('— don\'t let production control you') }}
                    </h1>

                    <p class="mb-10 max-w-xl text-lg text-text-secondary lg:text-xl">
                        {{ __('In industrial manufacturing, the gap between planned and actual performance costs millions. Cégem360 puts real-time plant management, OEE measurement, maintenance planning and AI-based optimization into the hands of production managers.') }}
                    </p>

                    <div class="flex flex-wrap items-center gap-4">
                        <a href="{{ route('contact') }}"
                            class="group inline-flex items-center gap-2 rounded-full bg-orange-600 px-6 py-3 text-base font-medium text-white transition-all hover:bg-orange-700 hover:shadow-lg"
                            style="box-shadow: 0 1px 2px rgba(0,0,0,0.05);">
                            <span>{{ __('Online consultation') }}</span>
                            <svg class="arrow-slide h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                            </svg>
                        </a>
                        <a href="#megoldasok"
                            class="inline-flex items-center gap-2 rounded-full border border-border-light bg-surface-primary px-6 py-3 text-base font-medium text-text-primary transition-all hover:border-orange-200 hover:bg-surface-secondary hover:shadow-md">
                            {{ __('Solutions overview') }}
                        </a>
                    </div>
                </div>

                {{-- OEE Dashboard Visual --}}
                <div class="reveal-right">
                    <div class="rounded-2xl border border-border-light bg-surface-primary p-6"
                        style="box-shadow: 0 4px 20px -4px rgba(0,0,0,0.06);">
                        <div class="mb-4 flex items-center justify-between border-b border-border-light pb-4">
                            <div>
                                <span class="block text-sm font-bold text-text-primary">{{ __('Plant control panel') }}</span>
                                <span class="block text-[10px] text-text-tertiary">{{ __('Real-time production data') }}</span>
                            </div>
                            <span class="inline-flex items-center gap-1.5 rounded-md border border-orange-100 bg-orange-50 px-2.5 py-1 text-[10px] font-semibold text-orange-600">
                                <span class="machine-dot-pulse h-1.5 w-1.5 rounded-full bg-orange-500"></span>
                                {{ __('A shift · Live') }}
                            </span>
                        </div>

                        {{-- OEE Gauges --}}
                        <div class="mb-4 grid grid-cols-3 gap-2.5">
                            <div class="rounded-lg border border-border-light bg-surface-secondary p-2.5 text-center">
                                <span class="mb-1 block text-[10px] font-semibold uppercase tracking-wider text-text-tertiary">{{ __('OEE total') }}</span>
                                <span class="block text-xl font-bold text-orange-600" style="font-family: 'JetBrains Mono', monospace;">78%</span>
                                <div class="mt-1.5 h-1.5 w-full overflow-hidden rounded-full bg-surface-primary">
                                    <div class="oee-bar h-1.5 rounded-full bg-orange-400" style="width: 78%; animation-delay: 0.1s;"></div>
                                </div>
                            </div>
                            <div class="rounded-lg border border-border-light bg-surface-secondary p-2.5 text-center">
                                <span class="mb-1 block text-[10px] font-semibold uppercase tracking-wider text-text-tertiary">{{ __('Availability') }}</span>
                                <span class="block text-xl font-bold text-success-600" style="font-family: 'JetBrains Mono', monospace;">92%</span>
                                <div class="mt-1.5 h-1.5 w-full overflow-hidden rounded-full bg-surface-primary">
                                    <div class="oee-bar h-1.5 rounded-full bg-success-400" style="width: 92%; animation-delay: 0.2s;"></div>
                                </div>
                            </div>
                            <div class="rounded-lg border border-border-light bg-surface-secondary p-2.5 text-center">
                                <span class="mb-1 block text-[10px] font-semibold uppercase tracking-wider text-text-tertiary">{{ __('Performance') }}</span>
                                <span class="block text-xl font-bold text-amber-600" style="font-family: 'JetBrains Mono', monospace;">84%</span>
                                <div class="mt-1.5 h-1.5 w-full overflow-hidden rounded-full bg-surface-primary">
                                    <div class="oee-bar h-1.5 rounded-full bg-amber-400" style="width: 84%; animation-delay: 0.3s;"></div>
                                </div>
                            </div>
                        </div>

                        {{-- Machine Status Rows --}}
                        <div class="mb-4 space-y-1.5">
                            <div class="flex items-center justify-between rounded-lg bg-surface-secondary px-3 py-2">
                                <div class="flex items-center gap-2">
                                    <span class="h-2 w-2 rounded-full bg-success-500" style="box-shadow: 0 0 6px rgba(16,185,129,0.5);"></span>
                                    <span class="text-xs font-medium text-text-secondary">{{ __('CNC milling machine #1') }}</span>
                                </div>
                                <span class="rounded bg-success-50 px-2 py-0.5 text-[10px] font-semibold text-success-700">{{ __('Producing') }}</span>
                                <span class="text-xs font-bold text-text-primary" style="font-family: 'JetBrains Mono', monospace;">94%</span>
                                <span class="text-[11px] text-text-tertiary" style="font-family: 'JetBrains Mono', monospace;">142/160 {{ __('pcs') }}</span>
                            </div>
                            <div class="flex items-center justify-between rounded-lg bg-surface-secondary px-3 py-2">
                                <div class="flex items-center gap-2">
                                    <span class="h-2 w-2 rounded-full bg-success-500" style="box-shadow: 0 0 6px rgba(16,185,129,0.5);"></span>
                                    <span class="text-xs font-medium text-text-secondary">{{ __('Welding robot') }}</span>
                                </div>
                                <span class="rounded bg-success-50 px-2 py-0.5 text-[10px] font-semibold text-success-700">{{ __('Producing') }}</span>
                                <span class="text-xs font-bold text-text-primary" style="font-family: 'JetBrains Mono', monospace;">87%</span>
                                <span class="text-[11px] text-text-tertiary" style="font-family: 'JetBrains Mono', monospace;">56/68 {{ __('pcs') }}</span>
                            </div>
                            <div class="flex items-center justify-between rounded-lg bg-surface-secondary px-3 py-2">
                                <div class="flex items-center gap-2">
                                    <span class="h-2 w-2 rounded-full bg-amber-500" style="box-shadow: 0 0 6px rgba(245,158,11,0.4);"></span>
                                    <span class="text-xs font-medium text-text-secondary">{{ __('Laser cutter') }}</span>
                                </div>
                                <span class="rounded bg-amber-50 px-2 py-0.5 text-[10px] font-semibold text-amber-700">{{ __('Changeover') }}</span>
                                <span class="text-xs font-bold text-text-primary" style="font-family: 'JetBrains Mono', monospace;">71%</span>
                                <span class="text-[11px] text-text-tertiary" style="font-family: 'JetBrains Mono', monospace;">—</span>
                            </div>
                            <div class="flex items-center justify-between rounded-lg bg-surface-secondary px-3 py-2">
                                <div class="flex items-center gap-2">
                                    <span class="h-2 w-2 rounded-full bg-danger-500" style="box-shadow: 0 0 6px rgba(244,63,94,0.4);"></span>
                                    <span class="text-xs font-medium text-text-secondary">{{ __('Press machine #2') }}</span>
                                </div>
                                <span class="rounded bg-danger-50 px-2 py-0.5 text-[10px] font-semibold text-danger-700">{{ __('Maintenance') }}</span>
                                <span class="text-xs font-bold text-text-primary" style="font-family: 'JetBrains Mono', monospace;">0%</span>
                                <span class="text-[11px] font-semibold text-danger-600" style="font-family: 'JetBrains Mono', monospace;">14:30 ETA</span>
                            </div>
                        </div>

                        {{-- Production Progress Bar --}}
                        <div class="mb-4 rounded-lg border border-border-light bg-surface-secondary px-3 py-2.5">
                            <div class="mb-1.5 flex items-center justify-between">
                                <span class="text-xs font-semibold text-text-secondary">{{ __('Daily production target completion') }}</span>
                                <span class="text-xs font-bold text-orange-600" style="font-family: 'JetBrains Mono', monospace;">73%</span>
                            </div>
                            <div class="h-2 w-full overflow-hidden rounded-full bg-surface-primary">
                                <div class="oee-bar h-2 rounded-full bg-linear-to-r from-orange-400 to-amber-400" style="width: 73%; animation-delay: 0.5s;"></div>
                            </div>
                        </div>

                        {{-- Status bar --}}
                        <div class="flex gap-5 border-t border-border-light pt-3">
                            <span class="flex items-center gap-1.5 text-[11px] text-text-tertiary">
                                <span class="h-2 w-2 rounded-full bg-success-500"></span> {{ __('3 machines running') }}
                            </span>
                            <span class="flex items-center gap-1.5 text-[11px] text-text-tertiary">
                                <span class="h-2 w-2 rounded-full bg-amber-500"></span> {{ __('1 in changeover') }}
                            </span>
                            <span class="flex items-center gap-1.5 text-[11px] text-text-tertiary">
                                <span class="h-2 w-2 rounded-full bg-danger-500"></span> {{ __('1 in maintenance') }}
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
                <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-orange-600">{{ __('The challenge') }}</p>
                <h2 class="mb-4 text-3xl text-text-primary md:text-4xl" style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                    {{ __('These slow down industrial production') }}
                </h2>
                <p class="max-w-xl text-lg text-text-secondary">
                    {{ __('Familiar situations for plant managers at manufacturing, assembly and processing companies.') }}
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
                    <h3 class="mb-2 text-lg font-bold text-text-primary">{{ __('Unplanned downtime') }}</h3>
                    <p class="text-sm leading-relaxed text-text-secondary">{{ __('Machines stop without warning. No predictive maintenance, no live machine health monitoring — downtime is always a surprise.') }}</p>
                </div>

                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-7"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="icon-hover mb-5 flex h-12 w-12 items-center justify-center rounded-xl bg-warning-50">
                        <svg class="h-6 w-6 text-warning-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <h3 class="mb-2 text-lg font-bold text-text-primary">{{ __('Paper-based production tracking') }}</h3>
                    <p class="text-sm leading-relaxed text-text-secondary">{{ __('Production data lives on paper worksheets, handwritten notes. It takes days to compile what happened during a shift.') }}</p>
                </div>

                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-7"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="icon-hover mb-5 flex h-12 w-12 items-center justify-center rounded-xl bg-violet-50">
                        <svg class="h-6 w-6 text-violet-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                    </div>
                    <h3 class="mb-2 text-lg font-bold text-text-primary">{{ __('Unknown OEE and efficiency') }}</h3>
                    <p class="text-sm leading-relaxed text-text-secondary">{{ __('You don\'t know actual machine utilization, changeover time, or where the most scrap is generated. Without measurement, there is no improvement.') }}</p>
                </div>

                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-7"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="icon-hover mb-5 flex h-12 w-12 items-center justify-center rounded-xl bg-orange-50">
                        <svg class="h-6 w-6 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                        </svg>
                    </div>
                    <h3 class="mb-2 text-lg font-bold text-text-primary">{{ __('Production–sales sync failure') }}</h3>
                    <p class="text-sm leading-relaxed text-text-secondary">{{ __('Sales promises, production can\'t keep up. No real-time capacity information — deadlines slip, customers are disappointed.') }}</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Target Audience Section --}}
    <section class="bg-surface-secondary py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-6">
            <div class="reveal mb-12">
                <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-orange-600">{{ __('Who uses it?') }}</p>
                <h2 class="mb-4 text-3xl text-text-primary md:text-4xl" style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                    {{ __('From the shop floor to the boardroom — real-time production data') }}
                </h2>
                <p class="max-w-xl text-lg text-text-secondary">
                    {{ __('Cégem360 provides relevant production information at every level.') }}
                </p>
            </div>

            <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4" data-stagger>
                <div class="stagger-item card-glow group relative overflow-hidden rounded-2xl border border-border-light bg-surface-primary p-7"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="absolute inset-x-0 top-0 h-0.5 bg-linear-to-r from-transparent via-orange-400 to-transparent opacity-0 transition-opacity group-hover:opacity-100"></div>
                    <span class="mb-3 block text-3xl">🏭</span>
                    <span class="mb-2 block text-[10px] font-semibold uppercase tracking-wider text-orange-600">{{ __('Plant Manager') }}</span>
                    <h3 class="mb-2 text-base font-bold text-text-primary">{{ __('Plant and shift managers') }}</h3>
                    <p class="text-sm leading-relaxed text-text-secondary">{{ __('Live machine status, shift performance, OEE dashboard and instant problem alerts — the production control panel.') }}</p>
                </div>

                <div class="stagger-item card-glow group relative overflow-hidden rounded-2xl border border-border-light bg-surface-primary p-7"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="absolute inset-x-0 top-0 h-0.5 bg-linear-to-r from-transparent via-orange-400 to-transparent opacity-0 transition-opacity group-hover:opacity-100"></div>
                    <span class="mb-3 block text-3xl">⚙️</span>
                    <span class="mb-2 block text-[10px] font-semibold uppercase tracking-wider text-orange-600">{{ __('Production Director') }}</span>
                    <h3 class="mb-2 text-base font-bold text-text-primary">{{ __('Production directors') }}</h3>
                    <p class="text-sm leading-relaxed text-text-secondary">{{ __('Capacity planning, production plan vs. actual, scrap analysis and maintenance schedule — at a strategic level.') }}</p>
                </div>

                <div class="stagger-item card-glow group relative overflow-hidden rounded-2xl border border-border-light bg-surface-primary p-7"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="absolute inset-x-0 top-0 h-0.5 bg-linear-to-r from-transparent via-orange-400 to-transparent opacity-0 transition-opacity group-hover:opacity-100"></div>
                    <span class="mb-3 block text-3xl">🔧</span>
                    <span class="mb-2 block text-[10px] font-semibold uppercase tracking-wider text-orange-600">{{ __('Maintenance') }}</span>
                    <h3 class="mb-2 text-base font-bold text-text-primary">{{ __('Maintenance managers') }}</h3>
                    <p class="text-sm leading-relaxed text-text-secondary">{{ __('Predictive maintenance schedule, machine health history, spare parts inventory and maintenance worksheets — digitally.') }}</p>
                </div>

                <div class="stagger-item card-glow group relative overflow-hidden rounded-2xl border border-border-light bg-surface-primary p-7"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="absolute inset-x-0 top-0 h-0.5 bg-linear-to-r from-transparent via-orange-400 to-transparent opacity-0 transition-opacity group-hover:opacity-100"></div>
                    <span class="mb-3 block text-3xl">📋</span>
                    <span class="mb-2 block text-[10px] font-semibold uppercase tracking-wider text-orange-600">{{ __('Quality Management') }}</span>
                    <h3 class="mb-2 text-base font-bold text-text-primary">{{ __('Quality management manager') }}</h3>
                    <p class="text-sm leading-relaxed text-text-secondary">{{ __('Quality control protocols, scrap tracking, non-conformance management and production batch traceability.') }}</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Core Toolkit Section --}}
    <section class="bg-surface-primary py-16 lg:py-24" id="megoldasok">
        <div class="mx-auto max-w-7xl px-6">
            <div class="reveal mb-12">
                <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-orange-600">{{ __('Production toolkit') }}</p>
                <h2 class="mb-4 text-3xl text-text-primary md:text-4xl" style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                    {{ __('4 key modules for plant management') }}
                </h2>
                <p class="max-w-xl text-lg text-text-secondary">
                    {{ __('These modules together form the Cégem360 production intelligence layer.') }}
                </p>
            </div>

            <div class="grid grid-cols-1 gap-6 md:grid-cols-2" data-stagger>
                {{-- Gyártásirányítás --}}
                <div class="stagger-item card-glow group rounded-2xl border border-border-light bg-surface-primary p-8"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="mb-5 flex items-center gap-4">
                        <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-orange-50">
                            <x-module-icon module="gyartas" class="h-5 w-5 text-orange-600" />
                        </div>
                        <div>
                            <span class="block text-sm font-bold text-text-primary">{{ __('Production Management') }}</span>
                            <span class="text-xs text-text-tertiary">{{ __('Production and quality') }}</span>
                        </div>
                    </div>
                    <h3 class="mb-3 text-lg font-bold text-text-primary">{{ __('Complete control of the production process') }}</h3>
                    <p class="mb-5 text-sm leading-relaxed text-text-secondary">
                        {{ __('Gantt-based production planning, capacity scheduling, BOM management, OEE measurement, quality control and scrap tracking. The central brain of manufacturing — in real time.') }}
                    </p>
                    <div class="mb-5 grid grid-cols-2 gap-2">
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><span class="feature-dot h-1 w-1 rounded-full bg-orange-400"></span>{{ __('Gantt production planning') }}</span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><span class="feature-dot h-1 w-1 rounded-full bg-orange-400"></span>{{ __('OEE measurement and analysis') }}</span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><span class="feature-dot h-1 w-1 rounded-full bg-orange-400"></span>{{ __('Capacity scheduling') }}</span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><span class="feature-dot h-1 w-1 rounded-full bg-orange-400"></span>{{ __('BOM and parts list') }}</span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><span class="feature-dot h-1 w-1 rounded-full bg-orange-400"></span>{{ __('Quality control') }}</span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><span class="feature-dot h-1 w-1 rounded-full bg-orange-400"></span>{{ __('Scrap tracking') }}</span>
                    </div>
                    <a href="{{ route('products.gyartas') }}" class="inline-flex items-center gap-1.5 text-sm font-semibold text-orange-600 transition-colors hover:text-orange-700">
                        {{ __('View details') }} <svg class="arrow-slide h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" /></svg>
                    </a>
                </div>

                {{-- Digitális munkalap --}}
                <div class="stagger-item card-glow group rounded-2xl border border-border-light bg-surface-primary p-8"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="mb-5 flex items-center gap-4">
                        <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-amber-50">
                            <x-module-icon module="szerviz" class="h-5 w-5 text-amber-600" />
                        </div>
                        <div>
                            <span class="block text-sm font-bold text-text-primary">{{ __('Digital Worksheet') }}</span>
                            <span class="text-xs text-text-tertiary">{{ __('Plant data recording') }}</span>
                        </div>
                    </div>
                    <h3 class="mb-3 text-lg font-bold text-text-primary">{{ __('Production and maintenance worksheets — digitally') }}</h3>
                    <p class="mb-5 text-sm leading-relaxed text-text-secondary">
                        {{ __('The machine operator records shift data in the plant: produced quantity, scrap, downtime reasons, material usage, photo documentation — instantly in the system.') }}
                    </p>
                    <div class="mb-5 grid grid-cols-2 gap-2">
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><span class="feature-dot h-1 w-1 rounded-full bg-amber-400"></span>{{ __('Shift report') }}</span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><span class="feature-dot h-1 w-1 rounded-full bg-amber-400"></span>{{ __('Scrap recording with reason code') }}</span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><span class="feature-dot h-1 w-1 rounded-full bg-amber-400"></span>{{ __('Maintenance worksheet') }}</span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><span class="feature-dot h-1 w-1 rounded-full bg-amber-400"></span>{{ __('Photo documentation') }}</span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><span class="feature-dot h-1 w-1 rounded-full bg-amber-400"></span>{{ __('Material usage recording') }}</span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><span class="feature-dot h-1 w-1 rounded-full bg-amber-400"></span>{{ __('Offline mode') }}</span>
                    </div>
                    <a href="{{ route('products.szerviz') }}" class="inline-flex items-center gap-1.5 text-sm font-semibold text-amber-600 transition-colors hover:text-amber-700">
                        {{ __('View details') }} <svg class="arrow-slide h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" /></svg>
                    </a>
                </div>

                {{-- Automatizálás --}}
                <div class="stagger-item card-glow group rounded-2xl border border-border-light bg-surface-primary p-8"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="mb-5 flex items-center gap-4">
                        <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-violet-50">
                            <x-module-icon module="automatizalas" class="h-5 w-5 text-violet-600" />
                        </div>
                        <div>
                            <span class="block text-sm font-bold text-text-primary">{{ __('Automation') }}</span>
                            <span class="text-xs text-text-tertiary">{{ __('Production workflows') }}</span>
                        </div>
                    </div>
                    <h3 class="mb-3 text-lg font-bold text-text-primary">{{ __('Alerts, escalation and automatic task assignment') }}</h3>
                    <p class="mb-5 text-sm leading-relaxed text-text-secondary">
                        {{ __('Machine downtime — alert to maintenance. Scrap limit exceeded — quality management notification. Capacity shortage — escalation. No code, drag-and-drop workflow.') }}
                    </p>
                    <div class="mb-5 grid grid-cols-2 gap-2">
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><span class="feature-dot h-1 w-1 rounded-full bg-violet-400"></span>{{ __('Machine downtime alert') }}</span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><span class="feature-dot h-1 w-1 rounded-full bg-violet-400"></span>{{ __('Scrap limit trigger') }}</span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><span class="feature-dot h-1 w-1 rounded-full bg-violet-400"></span>{{ __('Maintenance scheduling') }}</span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><span class="feature-dot h-1 w-1 rounded-full bg-violet-400"></span>{{ __('Shift change notification') }}</span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><span class="feature-dot h-1 w-1 rounded-full bg-violet-400"></span>{{ __('Escalation chain') }}</span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><span class="feature-dot h-1 w-1 rounded-full bg-violet-400"></span>{{ __('Capacity warning') }}</span>
                    </div>
                    <a href="{{ route('products.automatizalas') }}" class="inline-flex items-center gap-1.5 text-sm font-semibold text-violet-600 transition-colors hover:text-violet-700">
                        {{ __('View details') }} <svg class="arrow-slide h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" /></svg>
                    </a>
                </div>

                {{-- DataMind --}}
                <div class="stagger-item card-glow group rounded-2xl border border-border-light bg-surface-primary p-8"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="mb-5 flex items-center gap-4">
                        <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-blue-50">
                            <x-module-icon module="datamind" class="h-5 w-5 text-blue-600" />
                        </div>
                        <div>
                            <span class="block text-sm font-bold text-text-primary">DataMind</span>
                            <span class="text-xs text-text-tertiary">{{ __('AI-based production optimization') }}</span>
                        </div>
                    </div>
                    <h3 class="mb-3 text-lg font-bold text-text-primary">{{ __('Predictive maintenance and production pattern recognition') }}</h3>
                    <p class="mb-5 text-sm leading-relaxed text-text-secondary">
                        {{ __('AI identifies maintenance needs before downtime occurs. Scrap pattern recognition, OEE trend prediction and capacity optimization recommendations.') }}
                    </p>
                    <div class="mb-5 grid grid-cols-2 gap-2">
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><span class="feature-dot h-1 w-1 rounded-full bg-blue-400"></span>{{ __('Predictive maintenance') }}</span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><span class="feature-dot h-1 w-1 rounded-full bg-blue-400"></span>{{ __('Scrap pattern recognition') }}</span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><span class="feature-dot h-1 w-1 rounded-full bg-blue-400"></span>{{ __('OEE trend forecasting') }}</span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><span class="feature-dot h-1 w-1 rounded-full bg-blue-400"></span>{{ __('Capacity optimization') }}</span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><span class="feature-dot h-1 w-1 rounded-full bg-blue-400"></span>{{ __('Downtime cause analysis') }}</span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><span class="feature-dot h-1 w-1 rounded-full bg-blue-400"></span>{{ __('Automatic summaries') }}</span>
                    </div>
                    <a href="{{ route('products.datamind') }}" class="inline-flex items-center gap-1.5 text-sm font-semibold text-blue-600 transition-colors hover:text-blue-700">
                        {{ __('View details') }} <svg class="arrow-slide h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" /></svg>
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{-- Production Lifecycle Section --}}
    <section class="bg-surface-secondary py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-6">
            <div class="reveal mb-12">
                <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-orange-600">{{ __('Production cycle') }}</p>
                <h2 class="mb-4 text-3xl text-text-primary md:text-4xl" style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                    {{ __('From order to delivery — in one closed system') }}
                </h2>
                <p class="max-w-xl text-lg text-text-secondary">
                    {{ __('Every phase is measured, documented and real-time — not retrospective data collection.') }}
                </p>
            </div>

            <div class="grid grid-cols-2 gap-5 sm:grid-cols-3 lg:grid-cols-6" data-stagger>
                <div class="stagger-item text-center">
                    <div class="mx-auto mb-4 flex h-16 w-16 items-center justify-center rounded-full border-2 border-orange-200 bg-surface-primary text-xl font-bold text-orange-600">01</div>
                    <h4 class="mb-1 text-sm font-bold text-text-primary">{{ __('Order') }}</h4>
                    <p class="mb-2 text-xs text-text-tertiary">{{ __('Customer order receipt, production instruction generation') }}</p>
                    <div class="flex flex-wrap justify-center gap-1">
                        <span class="rounded bg-orange-50 px-1.5 py-0.5 text-[9px] font-semibold text-orange-600">{{ __('Sales') }}</span>
                        <span class="rounded bg-orange-50 px-1.5 py-0.5 text-[9px] font-semibold text-orange-600">CRM</span>
                    </div>
                </div>
                <div class="stagger-item text-center">
                    <div class="mx-auto mb-4 flex h-16 w-16 items-center justify-center rounded-full border-2 border-amber-200 bg-surface-primary text-xl font-bold text-amber-600">02</div>
                    <h4 class="mb-1 text-sm font-bold text-text-primary">{{ __('Planning') }}</h4>
                    <p class="mb-2 text-xs text-text-tertiary">{{ __('Gantt scheduling, capacity check, material requirements') }}</p>
                    <div class="flex flex-wrap justify-center gap-1">
                        <span class="rounded bg-amber-50 px-1.5 py-0.5 text-[9px] font-semibold text-amber-600">{{ __('Production Management') }}</span>
                        <span class="rounded bg-amber-50 px-1.5 py-0.5 text-[9px] font-semibold text-amber-600">{{ __('Procurement') }}</span>
                    </div>
                </div>
                <div class="stagger-item text-center">
                    <div class="mx-auto mb-4 flex h-16 w-16 items-center justify-center rounded-full border-2 border-teal-200 bg-surface-primary text-xl font-bold text-teal-600">03</div>
                    <h4 class="mb-1 text-sm font-bold text-text-primary">{{ __('Manufacturing') }}</h4>
                    <p class="mb-2 text-xs text-text-tertiary">{{ __('Real-time machine status, OEE, shift data recording') }}</p>
                    <div class="flex flex-wrap justify-center gap-1">
                        <span class="rounded bg-teal-50 px-1.5 py-0.5 text-[9px] font-semibold text-teal-600">{{ __('Production Management') }}</span>
                        <span class="rounded bg-teal-50 px-1.5 py-0.5 text-[9px] font-semibold text-teal-600">{{ __('Worksheet') }}</span>
                    </div>
                </div>
                <div class="stagger-item text-center">
                    <div class="mx-auto mb-4 flex h-16 w-16 items-center justify-center rounded-full border-2 border-success-200 bg-surface-primary text-xl font-bold text-success-600">04</div>
                    <h4 class="mb-1 text-sm font-bold text-text-primary">{{ __('Quality') }}</h4>
                    <p class="mb-2 text-xs text-text-tertiary">{{ __('In-process and final inspection, scrap management, batch traceability') }}</p>
                    <div class="flex flex-wrap justify-center gap-1">
                        <span class="rounded bg-success-50 px-1.5 py-0.5 text-[9px] font-semibold text-success-600">{{ __('Production Management') }}</span>
                    </div>
                </div>
                <div class="stagger-item text-center">
                    <div class="mx-auto mb-4 flex h-16 w-16 items-center justify-center rounded-full border-2 border-blue-200 bg-surface-primary text-xl font-bold text-blue-600">05</div>
                    <h4 class="mb-1 text-sm font-bold text-text-primary">{{ __('Delivery') }}</h4>
                    <p class="mb-2 text-xs text-text-tertiary">{{ __('Finished goods receipt, delivery note, logistics coordination') }}</p>
                    <div class="flex flex-wrap justify-center gap-1">
                        <span class="rounded bg-blue-50 px-1.5 py-0.5 text-[9px] font-semibold text-blue-600">{{ __('Procurement') }}</span>
                        <span class="rounded bg-blue-50 px-1.5 py-0.5 text-[9px] font-semibold text-blue-600">{{ __('Sales') }}</span>
                    </div>
                </div>
                <div class="stagger-item text-center">
                    <div class="mx-auto mb-4 flex h-16 w-16 items-center justify-center rounded-full border-2 border-violet-200 bg-surface-primary text-xl font-bold text-violet-600">06</div>
                    <h4 class="mb-1 text-sm font-bold text-text-primary">{{ __('Analysis') }}</h4>
                    <p class="mb-2 text-xs text-text-tertiary">{{ __('Production cost, OEE report, AI recommendations for the next cycle') }}</p>
                    <div class="flex flex-wrap justify-center gap-1">
                        <span class="rounded bg-violet-50 px-1.5 py-0.5 text-[9px] font-semibold text-violet-600">{{ __('Controlling') }}</span>
                        <span class="rounded bg-violet-50 px-1.5 py-0.5 text-[9px] font-semibold text-violet-600">DataMind</span>
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
                    <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-orange-600">{{ __('Full ecosystem') }}</p>
                    <h2 class="text-3xl text-text-primary md:text-4xl" style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                        {{ __('All 11 modules serving production') }}
                    </h2>
                </div>
                <p class="text-lg leading-relaxed text-text-secondary lg:mt-8">
                    {{ __('Production doesn\'t operate in a vacuum — sales generates orders, procurement ensures materials, controlling measures profitability, service maintains. When all this is in one system, the plant manager can focus on actual production — not on gathering information.') }}
                </p>
            </div>

            <div class="grid grid-cols-2 gap-4 sm:grid-cols-4 lg:grid-cols-7" data-stagger>
                <div class="stagger-item pill-float rounded-xl border border-border-light bg-surface-primary p-4 text-center"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="mx-auto mb-3 flex h-10 w-10 items-center justify-center rounded-lg bg-cyan-50">
                        <x-module-icon module="beszerzes" class="h-5 w-5 text-cyan-600" />
                    </div>
                    <h4 class="mb-1 text-xs font-bold text-text-primary">{{ __('Procurement & Logistics') }}</h4>
                    <p class="text-[10px] leading-snug text-text-tertiary">{{ __('Material requirements automatically from the production plan') }}</p>
                </div>
                <div class="stagger-item pill-float rounded-xl border border-border-light bg-surface-primary p-4 text-center"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="mx-auto mb-3 flex h-10 w-10 items-center justify-center rounded-lg bg-success-50">
                        <x-module-icon module="ertekesites" class="h-5 w-5 text-success-600" />
                    </div>
                    <h4 class="mb-1 text-xs font-bold text-text-primary">{{ __('CRM & Sales') }}</h4>
                    <p class="text-[10px] leading-snug text-text-tertiary">{{ __('Orders automatically generate production instructions') }}</p>
                </div>
                <div class="stagger-item pill-float rounded-xl border border-border-light bg-surface-primary p-4 text-center"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="mx-auto mb-3 flex h-10 w-10 items-center justify-center rounded-lg bg-indigo-50">
                        <x-module-icon module="kontrolling" class="h-5 w-5 text-indigo-600" />
                    </div>
                    <h4 class="mb-1 text-xs font-bold text-text-primary">{{ __('Controlling') }}</h4>
                    <p class="text-[10px] leading-snug text-text-tertiary">{{ __('Production cost in real time: material, labor hours, machine cost') }}</p>
                </div>
                <div class="stagger-item pill-float rounded-xl border border-border-light bg-surface-primary p-4 text-center"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="mx-auto mb-3 flex h-10 w-10 items-center justify-center rounded-lg bg-blue-50">
                        <x-module-icon module="marketinghub" class="h-5 w-5 text-blue-600" />
                    </div>
                    <h4 class="mb-1 text-xs font-bold text-text-primary">MarketingHub</h4>
                    <p class="text-[10px] leading-snug text-text-tertiary">{{ __('Demand forecasting from marketing data') }}</p>
                </div>
                <div class="stagger-item pill-float rounded-xl border border-border-light bg-surface-primary p-4 text-center"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="mx-auto mb-3 flex h-10 w-10 items-center justify-center rounded-lg bg-rose-50">
                        <x-module-icon module="seo" class="h-5 w-5 text-rose-600" />
                    </div>
                    <h4 class="mb-1 text-xs font-bold text-text-primary">{{ __('SEO Tool') }}</h4>
                    <p class="text-[10px] leading-snug text-text-tertiary">{{ __('Online visibility of reference projects brings new orders') }}</p>
                </div>
                <div class="stagger-item pill-float rounded-xl border border-border-light bg-surface-primary p-4 text-center"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="mx-auto mb-3 flex h-10 w-10 items-center justify-center rounded-lg bg-teal-50">
                        <x-module-icon module="ai-chat" class="h-5 w-5 text-teal-600" />
                    </div>
                    <h4 class="mb-1 text-xs font-bold text-text-primary">AI Chat</h4>
                    <p class="text-[10px] leading-snug text-text-tertiary">{{ __('Internal status query: where is production — instantly') }}</p>
                </div>
                <div class="stagger-item pill-float rounded-xl border border-border-light bg-surface-primary p-4 text-center"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="mx-auto mb-3 flex h-10 w-10 items-center justify-center rounded-lg bg-violet-50">
                        <x-module-icon module="automatizalas" class="h-5 w-5 text-violet-600" />
                    </div>
                    <h4 class="mb-1 text-xs font-bold text-text-primary">{{ __('Automation') }}</h4>
                    <p class="text-[10px] leading-snug text-text-tertiary">{{ __('Machine downtime alerts, maintenance scheduling automatically') }}</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Stats Section --}}
    <section class="bg-surface-secondary py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-6">
            <div class="reveal mb-12 text-center">
                <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-orange-600">{{ __('Results') }}</p>
                <h2 class="text-3xl text-text-primary md:text-4xl" style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                    {{ __('Measurable improvement in production performance') }}
                </h2>
            </div>

            <div class="grid grid-cols-2 gap-5 lg:grid-cols-4" data-stagger data-counter-trigger>
                <div class="stagger-item stat-hover rounded-2xl border border-border-light bg-surface-primary p-8 text-center"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <span class="stat-value block text-4xl font-bold text-orange-600 lg:text-5xl" style="font-family: 'JetBrains Mono', monospace;"
                        data-count="25" data-prefix="+" data-suffix="%">0%</span>
                    <span class="mt-2 block text-sm text-text-secondary">{{ __('OEE improvement') }}</span>
                </div>
                <div class="stagger-item stat-hover rounded-2xl border border-border-light bg-surface-primary p-8 text-center"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <span class="stat-value block text-4xl font-bold text-success-600 lg:text-5xl" style="font-family: 'JetBrains Mono', monospace;"
                        data-count="40" data-prefix="-" data-suffix="%">0%</span>
                    <span class="mt-2 block text-sm text-text-secondary">{{ __('Unplanned downtime') }}</span>
                </div>
                <div class="stagger-item stat-hover rounded-2xl border border-border-light bg-surface-primary p-8 text-center"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <span class="stat-value block text-4xl font-bold text-amber-600 lg:text-5xl" style="font-family: 'JetBrains Mono', monospace;"
                        data-count="30" data-prefix="-" data-suffix="%">0%</span>
                    <span class="mt-2 block text-sm text-text-secondary">{{ __('Scrap rate reduction') }}</span>
                </div>
                <div class="stagger-item stat-hover rounded-2xl border border-border-light bg-surface-primary p-8 text-center"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <span class="stat-value block text-4xl font-bold text-blue-600 lg:text-5xl" style="font-family: 'JetBrains Mono', monospace;"
                        data-count="65" data-prefix="-" data-suffix="%">0%</span>
                    <span class="mt-2 block text-sm text-text-secondary">{{ __('Administration time') }}</span>
                </div>
            </div>
        </div>
    </section>

    {{-- Use Cases Section --}}
    <section class="bg-surface-primary py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-6">
            <div class="reveal mb-12">
                <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-orange-600">{{ __('Use cases') }}</p>
                <h2 class="mb-4 text-3xl text-text-primary md:text-4xl" style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                    {{ __('How industrial plant managers use it') }}
                </h2>
            </div>

            <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3" data-stagger>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-7"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <span class="mb-4 block text-xs font-semibold text-text-tertiary" style="font-family: 'JetBrains Mono', monospace;">01</span>
                    <h3 class="mb-2 text-base font-bold text-text-primary">{{ __('OEE measurement and machine utilization analysis') }}</h3>
                    <p class="mb-4 text-sm leading-relaxed text-text-secondary">{{ __('Real-time OEE for every machine: availability, performance, quality. The shift manager instantly sees which machine is below target — and why.') }}</p>
                    <div class="flex flex-wrap gap-1.5">
                        <span class="rounded bg-orange-50 px-2 py-0.5 text-[10px] font-semibold text-orange-600">{{ __('Production Management') }}</span>
                        <span class="rounded bg-orange-50 px-2 py-0.5 text-[10px] font-semibold text-orange-600">{{ __('Worksheet') }}</span>
                    </div>
                </div>

                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-7"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <span class="mb-4 block text-xs font-semibold text-text-tertiary" style="font-family: 'JetBrains Mono', monospace;">02</span>
                    <h3 class="mb-2 text-base font-bold text-text-primary">{{ __('Predictive maintenance with AI') }}</h3>
                    <p class="mb-4 text-sm leading-relaxed text-text-secondary">{{ __('DataMind predicts from past failure patterns and machine operating data when maintenance will be needed — weeks before the downtime.') }}</p>
                    <div class="flex flex-wrap gap-1.5">
                        <span class="rounded bg-orange-50 px-2 py-0.5 text-[10px] font-semibold text-orange-600">DataMind</span>
                        <span class="rounded bg-orange-50 px-2 py-0.5 text-[10px] font-semibold text-orange-600">{{ __('Automation') }}</span>
                    </div>
                </div>

                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-7"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <span class="mb-4 block text-xs font-semibold text-text-tertiary" style="font-family: 'JetBrains Mono', monospace;">03</span>
                    <h3 class="mb-2 text-base font-bold text-text-primary">{{ __('Gantt-based capacity planning') }}</h3>
                    <p class="mb-4 text-sm leading-relaxed text-text-secondary">{{ __('Visual production scheduling: which machine, when, which product runs. The system automatically alerts on capacity conflicts — and suggests rescheduling.') }}</p>
                    <div class="flex flex-wrap gap-1.5">
                        <span class="rounded bg-orange-50 px-2 py-0.5 text-[10px] font-semibold text-orange-600">{{ __('Production Management') }}</span>
                        <span class="rounded bg-orange-50 px-2 py-0.5 text-[10px] font-semibold text-orange-600">{{ __('Sales') }}</span>
                    </div>
                </div>

                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-7"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <span class="mb-4 block text-xs font-semibold text-text-tertiary" style="font-family: 'JetBrains Mono', monospace;">04</span>
                    <h3 class="mb-2 text-base font-bold text-text-primary">{{ __('Digital shift report') }}</h3>
                    <p class="mb-4 text-sm leading-relaxed text-text-secondary">{{ __('The machine operator records at the end of the shift: produced quantity, scrap (with reason code), downtime, material usage — in 5 minutes, on their phone, without paper.') }}</p>
                    <div class="flex flex-wrap gap-1.5">
                        <span class="rounded bg-orange-50 px-2 py-0.5 text-[10px] font-semibold text-orange-600">{{ __('Worksheet') }}</span>
                        <span class="rounded bg-orange-50 px-2 py-0.5 text-[10px] font-semibold text-orange-600">{{ __('Production Management') }}</span>
                    </div>
                </div>

                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-7"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <span class="mb-4 block text-xs font-semibold text-text-tertiary" style="font-family: 'JetBrains Mono', monospace;">05</span>
                    <h3 class="mb-2 text-base font-bold text-text-primary">{{ __('Scrap analysis and quality control') }}</h3>
                    <p class="mb-4 text-sm leading-relaxed text-text-secondary">{{ __('Which machine, which shift, which material produces the most scrap? DataMind finds patterns — the quality management manager can take targeted action.') }}</p>
                    <div class="flex flex-wrap gap-1.5">
                        <span class="rounded bg-orange-50 px-2 py-0.5 text-[10px] font-semibold text-orange-600">DataMind</span>
                        <span class="rounded bg-orange-50 px-2 py-0.5 text-[10px] font-semibold text-orange-600">{{ __('Production Management') }}</span>
                    </div>
                </div>

                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-7"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <span class="mb-4 block text-xs font-semibold text-text-tertiary" style="font-family: 'JetBrains Mono', monospace;">06</span>
                    <h3 class="mb-2 text-base font-bold text-text-primary">{{ __('Production–sales synchronization') }}</h3>
                    <p class="mb-4 text-sm leading-relaxed text-text-secondary">{{ __('The sales rep sees available capacity and production deadlines in real time in the CRM — they can communicate realistic delivery times to customers, not based on guesswork.') }}</p>
                    <div class="flex flex-wrap gap-1.5">
                        <span class="rounded bg-orange-50 px-2 py-0.5 text-[10px] font-semibold text-orange-600">{{ __('Production Management') }}</span>
                        <span class="rounded bg-orange-50 px-2 py-0.5 text-[10px] font-semibold text-orange-600">CRM</span>
                        <span class="rounded bg-orange-50 px-2 py-0.5 text-[10px] font-semibold text-orange-600">{{ __('Sales') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Comparison Table Section --}}
    <section class="bg-surface-secondary py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-6">
            <div class="reveal mb-12">
                <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-orange-600">{{ __('Comparison') }}</p>
                <h2 class="mb-4 text-3xl text-text-primary md:text-4xl" style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                    {{ __('Instead of paper shift reports — digital plant management') }}
                </h2>
                <p class="max-w-xl text-lg text-text-secondary">
                    {{ __('This is how production management changes with Cégem360.') }}
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
                        <tr>
                            <td class="px-6 py-4 text-sm font-semibold text-text-primary">{{ __('Machine status overview') }}</td>
                            <td class="px-6 py-4 text-sm text-text-tertiary">{{ __('In person, in the plant') }}</td>
                            <td class="px-6 py-4 text-sm font-medium text-success-600">{{ __('✓ Real-time dashboard') }}</td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 text-sm font-semibold text-text-primary">{{ __('OEE measurement') }}</td>
                            <td class="px-6 py-4 text-sm text-text-tertiary">{{ __('Not measured / retrospective') }}</td>
                            <td class="px-6 py-4 text-sm font-medium text-success-600">{{ __('✓ Continuous, per machine') }}</td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 text-sm font-semibold text-text-primary">{{ __('Production planning') }}</td>
                            <td class="px-6 py-4 text-sm text-text-tertiary">{{ __('Whiteboard / Excel') }}</td>
                            <td class="px-6 py-4 text-sm font-medium text-success-600">{{ __('✓ Gantt, with capacity sync') }}</td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 text-sm font-semibold text-text-primary">{{ __('Maintenance') }}</td>
                            <td class="px-6 py-4 text-sm text-text-tertiary">{{ __('After breakdown') }}</td>
                            <td class="px-6 py-4 text-sm font-medium text-success-600">{{ __('✓ Predictive AI planning') }}</td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 text-sm font-semibold text-text-primary">{{ __('Scrap analysis') }}</td>
                            <td class="px-6 py-4 text-sm text-text-tertiary">{{ __('In weekly report, if any') }}</td>
                            <td class="px-6 py-4 text-sm font-medium text-success-600">{{ __('✓ Real-time, with reason code') }}</td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 text-sm font-semibold text-text-primary">{{ __('Shift report') }}</td>
                            <td class="px-6 py-4 text-sm text-text-tertiary">{{ __('Paper, next morning') }}</td>
                            <td class="px-6 py-4 text-sm font-medium text-success-600">{{ __('✓ Digital, instant') }}</td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 text-sm font-semibold text-text-primary">{{ __('Capacity information for sales') }}</td>
                            <td class="px-6 py-4 text-sm text-text-tertiary">{{ __('Asks by phone') }}</td>
                            <td class="px-6 py-4 text-sm font-medium text-success-600">{{ __('✓ Real-time in the CRM') }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    {{-- Consultation Section --}}
    <section class="bg-surface-primary py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-6">
            <div class="reveal">
                <div class="grid grid-cols-1 items-center gap-8 rounded-2xl border border-border-light bg-surface-secondary p-8 lg:grid-cols-[1fr_auto] lg:p-12"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div>
                        <h3 class="mb-3 text-xl font-bold text-text-primary lg:text-2xl" style="font-family: 'Poppins', sans-serif;">{{ __('Personalized online consultation') }}</h3>
                        <p class="mb-5 text-base text-text-secondary">{{ __('A 30-minute video call where we assess how you can digitize your production and plant management processes with Cégem360 — tailored to your industry, machine park size and production type.') }}</p>
                        <div class="flex flex-wrap gap-5">
                            <span class="flex items-center gap-1.5 text-sm text-text-tertiary">
                                <svg class="h-4 w-4 text-success-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                                {{ __('30-minute video call') }}
                            </span>
                            <span class="flex items-center gap-1.5 text-sm text-text-tertiary">
                                <svg class="h-4 w-4 text-success-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                                {{ __('Production audit') }}
                            </span>
                            <span class="flex items-center gap-1.5 text-sm text-text-tertiary">
                                <svg class="h-4 w-4 text-success-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                                {{ __('No commitment') }}
                            </span>
                        </div>
                    </div>
                    <a href="{{ route('contact') }}"
                        class="group inline-flex items-center gap-2 rounded-full bg-orange-600 px-6 py-3 text-base font-medium text-white transition-all hover:bg-orange-700 hover:shadow-lg"
                        style="box-shadow: 0 1px 2px rgba(0,0,0,0.05);">
                        <span>{{ __('Request consultation') }}</span>
                        <svg class="arrow-slide h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{-- Footer CTA Section --}}
    <section class="bg-linear-to-b from-surface-secondary to-surface-primary py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-6">
            <div class="reveal mb-12 text-center">
                <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-orange-600">{{ __('Get started') }}</p>
                <h2 class="mb-4 text-3xl text-text-primary md:text-4xl" style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                    {{ __('Ready for digital plant management?') }}
                </h2>
                <p class="mx-auto max-w-xl text-lg text-text-secondary">
                    {{ __('Choose the next step for you.') }}
                </p>
            </div>

            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2" data-stagger>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-8 text-center"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <h3 class="mb-3 text-xl font-bold text-text-primary">{{ __('Online consultation') }}</h3>
                    <p class="mb-6 text-sm text-text-secondary">{{ __('Ask our experts in 30 minutes — via video call, tailored to your production challenges, with no obligation.') }}</p>
                    <a href="{{ route('contact') }}"
                        class="inline-flex items-center gap-2 rounded-full border border-border-light bg-surface-secondary px-6 py-3 text-sm font-medium text-text-primary transition-all hover:border-orange-200 hover:shadow-md">
                        {{ __('Book appointment') }} <svg class="arrow-slide h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" /></svg>
                    </a>
                </div>
                <div class="stagger-item card-glow rounded-2xl border border-orange-100 bg-orange-50 p-8 text-center"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <h3 class="mb-3 text-xl font-bold text-text-primary">{{ __('Registration and trial') }}</h3>
                    <p class="mb-6 text-sm text-text-secondary">{{ __('Explore production management, the OEE dashboard and digital worksheets — instantly.') }}</p>
                    <a href="{{ route('register') }}"
                        class="group inline-flex items-center gap-2 rounded-full bg-orange-600 px-6 py-3 text-sm font-medium text-white transition-all hover:bg-orange-700 hover:shadow-lg"
                        style="box-shadow: 0 1px 2px rgba(0,0,0,0.05);">
                        {{ __('Registration') }} <svg class="arrow-slide h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" /></svg>
                    </a>
                </div>
            </div>
        </div>
    </section>
</div>
