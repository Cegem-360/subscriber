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
            0% { box-shadow: 0 0 0 0 rgba(244, 63, 94, 0.4); }
            70% { box-shadow: 0 0 0 6px rgba(244, 63, 94, 0); }
            100% { box-shadow: 0 0 0 0 rgba(244, 63, 94, 0); }
        }
        .pulse-dot { animation: pulse-ring 2s ease infinite; }

        .card-glow { transition: all 0.4s cubic-bezier(0,0,0.2,1); }
        .card-glow:hover { box-shadow: 0 8px 30px -8px rgba(244, 63, 94, 0.15), 0 2px 8px rgba(0,0,0,0.04) !important; }

        .icon-hover { transition: transform 0.35s cubic-bezier(0,0,0.2,1.4); }
        .group:hover .icon-hover, .card-glow:hover .icon-hover { transform: translateY(-3px) scale(1.08); }

        .arrow-slide { transition: transform 0.3s cubic-bezier(0,0,0.2,1); }
        .group:hover .arrow-slide, a:hover .arrow-slide { transform: translateX(4px); }

        .stat-hover .stat-value { transition: transform 0.4s cubic-bezier(0,0,0.2,1.4); }
        .stat-hover:hover .stat-value { transform: scale(1.08); }

        .feature-dot { transition: transform 0.3s cubic-bezier(0,0,0.2,1); }
        .card-glow:hover .feature-dot { transform: scale(1.5); }

        @keyframes ticket-pulse { 0%, 100% { opacity: 1; } 50% { opacity: 0.4; } }
        .ticket-dot-pulse { animation: ticket-pulse 2s ease infinite; }

        .pill-float { transition: transform 0.35s cubic-bezier(0,0,0.2,1), box-shadow 0.35s cubic-bezier(0,0,0.2,1); }
        .pill-float:hover { transform: translateY(-3px); box-shadow: 0 6px 20px -4px rgba(244, 63, 94, 0.12); }

        html { scroll-behavior: smooth; }
    </style>

    {{-- Hero Section --}}
    <section class="bg-linear-to-b from-rose-50 to-surface-secondary">
        <div class="mx-auto max-w-7xl px-6 py-16 lg:py-24">
            <div class="grid grid-cols-1 items-center gap-12 lg:grid-cols-2">
                {{-- Hero Text --}}
                <div class="reveal">
                    <div class="badge-gradient mb-8 inline-flex items-center gap-2 rounded-full border border-border-light/80 bg-surface-primary px-4 py-1.5"
                        style="box-shadow: 0 1px 3px rgba(0,0,0,0.04);">
                        <span class="pulse-dot h-1.5 w-1.5 rounded-full bg-linear-to-r from-rose-500 via-pink-500 to-violet-500"></span>
                        <span class="text-sm font-medium text-text-primary">{{ __('Industrial service and customer support solutions') }}</span>
                    </div>

                    <h1 class="mb-6 text-4xl leading-tight tracking-tight text-text-primary md:text-5xl lg:text-[3.5rem]"
                        style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                        {{ __('Deliver service faster') }}<br>
                        {{ __('— and retain your customers') }}
                    </h1>

                    <p class="mb-10 max-w-xl text-lg text-text-secondary lg:text-xl">
                        {{ __('In industrial B2B, the real relationship begins after the sale. Cégem360 provides digital service management, 24/7 AI customer support, complaint workflow and proactive maintenance notifications — so the customer doesn\'t call the competitor.') }}
                    </p>

                    <div class="flex flex-wrap items-center gap-4">
                        <a href="{{ route('contact') }}"
                            class="group inline-flex items-center gap-2 rounded-full bg-rose-600 px-6 py-3 text-base font-medium text-white transition-all hover:bg-rose-700 hover:shadow-lg"
                            style="box-shadow: 0 1px 2px rgba(0,0,0,0.05);">
                            <span>{{ __('Online consultation') }}</span>
                            <svg class="arrow-slide h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" /></svg>
                        </a>
                        <a href="#megoldasok"
                            class="inline-flex items-center gap-2 rounded-full border border-border-light bg-surface-primary px-6 py-3 text-base font-medium text-text-primary transition-all hover:border-rose-200 hover:bg-surface-secondary hover:shadow-md">
                            {{ __('Solutions overview') }}
                        </a>
                    </div>
                </div>

                {{-- Service Ticket Dashboard Visual --}}
                <div class="reveal-right">
                    <div class="rounded-2xl border border-border-light bg-surface-primary p-6"
                        style="box-shadow: 0 4px 20px -4px rgba(0,0,0,0.06);">
                        <div class="mb-4 flex items-center justify-between border-b border-border-light pb-4">
                            <div>
                                <span class="block text-sm font-bold text-text-primary">{{ __('Service dashboard') }}</span>
                                <span class="block text-[10px] text-text-tertiary">{{ __('Customer support & field service') }}</span>
                            </div>
                            <span class="inline-flex items-center gap-1.5 rounded-md border border-rose-100 bg-rose-50 px-2.5 py-1 text-[10px] font-semibold text-rose-600">
                                <span class="ticket-dot-pulse h-1.5 w-1.5 rounded-full bg-rose-500"></span>
                                {{ __('Live · 3 open') }}
                            </span>
                        </div>

                        {{-- KPI Cards --}}
                        <div class="mb-4 grid grid-cols-2 gap-2.5">
                            <div class="rounded-lg border border-border-light bg-surface-secondary p-2.5 text-center">
                                <span class="block text-xl font-bold text-rose-600" style="font-family: 'JetBrains Mono', monospace;">12</span>
                                <span class="block text-[10px] font-semibold uppercase tracking-wider text-text-tertiary">{{ __('Open tickets') }}</span>
                            </div>
                            <div class="rounded-lg border border-border-light bg-surface-secondary p-2.5 text-center">
                                <span class="block text-xl font-bold text-amber-600" style="font-family: 'JetBrains Mono', monospace;">2.4h</span>
                                <span class="block text-[10px] font-semibold uppercase tracking-wider text-text-tertiary">{{ __('Avg. response time') }}</span>
                            </div>
                            <div class="rounded-lg border border-border-light bg-surface-secondary p-2.5 text-center">
                                <span class="block text-xl font-bold text-success-600" style="font-family: 'JetBrains Mono', monospace;">94%</span>
                                <span class="block text-[10px] font-semibold uppercase tracking-wider text-text-tertiary">{{ __('Satisfaction') }}</span>
                            </div>
                            <div class="rounded-lg border border-border-light bg-surface-secondary p-2.5 text-center">
                                <span class="block text-xl font-bold text-blue-600" style="font-family: 'JetBrains Mono', monospace;">87%</span>
                                <span class="block text-[10px] font-semibold uppercase tracking-wider text-text-tertiary">{{ __('First fix rate') }}</span>
                            </div>
                        </div>

                        {{-- AI Chat Preview --}}
                        <div class="mb-4 rounded-lg border border-rose-100 bg-rose-50 p-3">
                            <div class="mb-2 flex items-center gap-2">
                                <div class="flex h-7 w-7 items-center justify-center rounded-full bg-linear-to-br from-rose-500 to-pink-500 text-[10px] font-bold text-white">AI</div>
                                <span class="text-xs font-bold text-text-primary">{{ __('Cégem360 AI Assistant') }}</span>
                                <span class="rounded bg-rose-100 px-1.5 py-0.5 text-[9px] font-semibold text-rose-600">{{ __('Automatic') }}</span>
                            </div>
                            <div class="rounded-lg bg-surface-primary p-2.5 text-xs leading-relaxed text-text-secondary">
                                {{ __('Hi! The status of service ticket #4821: the technician will arrive tomorrow at 9:00, the required part (SKF 6205 bearing) is in stock. Is there anything else I can help with?') }}
                            </div>
                            <span class="mt-1.5 block text-right text-[10px] text-text-tertiary">{{ __('Today 14:32 · AI Chat') }}</span>
                        </div>

                        {{-- Ticket Rows --}}
                        <div class="space-y-1.5">
                            <div class="flex items-center justify-between rounded-lg bg-surface-secondary px-3 py-2">
                                <div class="flex items-center gap-2">
                                    <span class="h-6 w-1 rounded-full bg-danger-500"></span>
                                    <div>
                                        <span class="block text-xs font-medium text-text-secondary">{{ __('Compressor failure') }}</span>
                                        <span class="text-[10px] text-text-tertiary">TechBuild Kft.</span>
                                    </div>
                                </div>
                                <span class="rounded bg-danger-50 px-2 py-0.5 text-[10px] font-semibold text-danger-700">{{ __('Open') }}</span>
                                <span class="text-[11px] text-text-tertiary" style="font-family: 'JetBrains Mono', monospace;">{{ __('35 min') }}</span>
                            </div>
                            <div class="flex items-center justify-between rounded-lg bg-surface-secondary px-3 py-2">
                                <div class="flex items-center gap-2">
                                    <span class="h-6 w-1 rounded-full bg-amber-500"></span>
                                    <div>
                                        <span class="block text-xs font-medium text-text-secondary">{{ __('Annual maintenance scheduling') }}</span>
                                        <span class="text-[10px] text-text-tertiary">InnoClima Zrt.</span>
                                    </div>
                                </div>
                                <span class="rounded bg-amber-50 px-2 py-0.5 text-[10px] font-semibold text-amber-700">{{ __('In progress') }}</span>
                                <span class="text-[11px] text-text-tertiary" style="font-family: 'JetBrains Mono', monospace;">{{ __('4 hours') }}</span>
                            </div>
                            <div class="flex items-center justify-between rounded-lg bg-surface-secondary px-3 py-2">
                                <div class="flex items-center gap-2">
                                    <span class="h-6 w-1 rounded-full bg-success-500"></span>
                                    <div>
                                        <span class="block text-xs font-medium text-text-secondary">{{ __('Warranty claim: control panel') }}</span>
                                        <span class="text-[10px] text-text-tertiary">Hungária Gép Kft.</span>
                                    </div>
                                </div>
                                <span class="rounded bg-success-50 px-2 py-0.5 text-[10px] font-semibold text-success-700">{{ __('Resolved') }}</span>
                                <span class="text-[11px] text-text-tertiary" style="font-family: 'JetBrains Mono', monospace;">{{ __('Closed') }}</span>
                            </div>
                        </div>

                        {{-- Status bar --}}
                        <div class="mt-4 flex gap-5 border-t border-border-light pt-3">
                            <span class="flex items-center gap-1.5 text-[11px] text-text-tertiary">
                                <span class="h-2 w-2 rounded-full bg-danger-500"></span> {{ __('3 urgent') }}
                            </span>
                            <span class="flex items-center gap-1.5 text-[11px] text-text-tertiary">
                                <span class="h-2 w-2 rounded-full bg-amber-500"></span> {{ __('5 in progress') }}
                            </span>
                            <span class="flex items-center gap-1.5 text-[11px] text-text-tertiary">
                                <span class="h-2 w-2 rounded-full bg-success-500"></span> {{ __('4 closed today') }}
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
                <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-rose-600">{{ __('The challenge') }}</p>
                <h2 class="mb-4 text-3xl text-text-primary md:text-4xl" style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                    {{ __('These weaken industrial customer service') }}
                </h2>
                <p class="max-w-xl text-lg text-text-secondary">
                    {{ __('Familiar situations for customer service managers at industrial manufacturing, assembly and service companies.') }}
                </p>
            </div>

            <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4" data-stagger>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-7" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="icon-hover mb-5 flex h-12 w-12 items-center justify-center rounded-xl bg-danger-50">
                        <svg class="h-6 w-6 text-danger-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    </div>
                    <h3 class="mb-2 text-lg font-bold text-text-primary">{{ __('Slow response time') }}</h3>
                    <p class="text-sm leading-relaxed text-text-secondary">{{ __('The customer calls, sends emails — but the service team is unreachable, or no one knows who is handling the case. Response time is hours-days, not minutes.') }}</p>
                </div>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-7" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="icon-hover mb-5 flex h-12 w-12 items-center justify-center rounded-xl bg-warning-50">
                        <svg class="h-6 w-6 text-warning-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                    </div>
                    <h3 class="mb-2 text-lg font-bold text-text-primary">{{ __('Paper service worksheets') }}</h3>
                    <p class="text-sm leading-relaxed text-text-secondary">{{ __('The field technician documents on paper, the worksheet disappears for days. No instant photos, no digital signature, no instant confirmation.') }}</p>
                </div>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-7" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="icon-hover mb-5 flex h-12 w-12 items-center justify-center rounded-xl bg-violet-50">
                        <svg class="h-6 w-6 text-violet-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" /></svg>
                    </div>
                    <h3 class="mb-2 text-lg font-bold text-text-primary">{{ __('No service history') }}</h3>
                    <p class="text-sm leading-relaxed text-text-secondary">{{ __('When the customer calls, no one knows when they were last visited, what was done, and whether the warranty has expired. Every call starts from zero.') }}</p>
                </div>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-7" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="icon-hover mb-5 flex h-12 w-12 items-center justify-center rounded-xl bg-blue-50">
                        <svg class="h-6 w-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    </div>
                    <h3 class="mb-2 text-lg font-bold text-text-primary">{{ __('Missed upsell opportunities') }}</h3>
                    <p class="text-sm leading-relaxed text-text-secondary">{{ __('During the service visit it turns out there\'s a need for expansion — but this information never reaches sales. Millions are left on the table.') }}</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Target Audience Section --}}
    <section class="bg-surface-secondary py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-6">
            <div class="reveal mb-12">
                <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-rose-600">{{ __('Who uses it?') }}</p>
                <h2 class="mb-4 text-3xl text-text-primary md:text-4xl" style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                    {{ __('From the service team to customer relations — in one system') }}
                </h2>
                <p class="max-w-xl text-lg text-text-secondary">
                    {{ __('Cégem360 provides data and tools to every member of the customer service team.') }}
                </p>
            </div>

            <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4" data-stagger>
                <div class="stagger-item card-glow group relative overflow-hidden rounded-2xl border border-border-light bg-surface-primary p-7" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="absolute inset-x-0 top-0 h-0.5 bg-linear-to-r from-transparent via-rose-400 to-transparent opacity-0 transition-opacity group-hover:opacity-100"></div>
                    <span class="mb-3 block text-3xl">🔧</span>
                    <span class="mb-2 block text-[10px] font-semibold uppercase tracking-wider text-rose-600">{{ __('Service Engineer') }}</span>
                    <h3 class="mb-2 text-base font-bold text-text-primary">{{ __('Field technicians, service engineers') }}</h3>
                    <p class="text-sm leading-relaxed text-text-secondary">{{ __('Digital worksheet, history access, parts inventory and photo documentation — on the phone, on-site, even offline.') }}</p>
                </div>
                <div class="stagger-item card-glow group relative overflow-hidden rounded-2xl border border-border-light bg-surface-primary p-7" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="absolute inset-x-0 top-0 h-0.5 bg-linear-to-r from-transparent via-rose-400 to-transparent opacity-0 transition-opacity group-hover:opacity-100"></div>
                    <span class="mb-3 block text-3xl">📋</span>
                    <span class="mb-2 block text-[10px] font-semibold uppercase tracking-wider text-rose-600">{{ __('Service Manager') }}</span>
                    <h3 class="mb-2 text-base font-bold text-text-primary">{{ __('Service managers, dispatchers') }}</h3>
                    <p class="text-sm leading-relaxed text-text-secondary">{{ __('Ticket management, dispatch scheduling, technician assignment, SLA monitoring and performance reports — in real time.') }}</p>
                </div>
                <div class="stagger-item card-glow group relative overflow-hidden rounded-2xl border border-border-light bg-surface-primary p-7" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="absolute inset-x-0 top-0 h-0.5 bg-linear-to-r from-transparent via-rose-400 to-transparent opacity-0 transition-opacity group-hover:opacity-100"></div>
                    <span class="mb-3 block text-3xl">🤝</span>
                    <span class="mb-2 block text-[10px] font-semibold uppercase tracking-wider text-rose-600">{{ __('Customer Relations') }}</span>
                    <h3 class="mb-2 text-base font-bold text-text-primary">{{ __('Customer relations staff') }}</h3>
                    <p class="text-sm leading-relaxed text-text-secondary">{{ __('Complete customer history, service records, warranty status and open tickets — instantly, during the call.') }}</p>
                </div>
                <div class="stagger-item card-glow group relative overflow-hidden rounded-2xl border border-border-light bg-surface-primary p-7" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="absolute inset-x-0 top-0 h-0.5 bg-linear-to-r from-transparent via-rose-400 to-transparent opacity-0 transition-opacity group-hover:opacity-100"></div>
                    <span class="mb-3 block text-3xl">💼</span>
                    <span class="mb-2 block text-[10px] font-semibold uppercase tracking-wider text-rose-600">{{ __('Managing Director') }}</span>
                    <h3 class="mb-2 text-base font-bold text-text-primary">{{ __('Managing directors, sales directors') }}</h3>
                    <p class="text-sm leading-relaxed text-text-secondary">{{ __('Customer satisfaction, service profitability, upsell conversion and retention rates — for strategic decisions.') }}</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Core Toolkit Section --}}
    <section class="bg-surface-primary py-16 lg:py-24" id="megoldasok">
        <div class="mx-auto max-w-7xl px-6">
            <div class="reveal mb-12">
                <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-rose-600">{{ __('Service toolkit') }}</p>
                <h2 class="mb-4 text-3xl text-text-primary md:text-4xl" style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                    {{ __('4 key modules for customer service and field service') }}
                </h2>
                <p class="max-w-xl text-lg text-text-secondary">
                    {{ __('These modules together form the Cégem360 after-sales intelligence layer.') }}
                </p>
            </div>

            <div class="grid grid-cols-1 gap-6 md:grid-cols-2" data-stagger>
                {{-- Digitális munkalap --}}
                <div class="stagger-item card-glow group rounded-2xl border border-border-light bg-surface-primary p-8" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="mb-5 flex items-center gap-4">
                        <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-rose-50">
                            <x-module-icon module="szerviz" class="h-5 w-5 text-rose-600" />
                        </div>
                        <div>
                            <span class="block text-sm font-bold text-text-primary">{{ __('Digital Worksheet') }}</span>
                            <span class="text-xs text-text-tertiary">{{ __('Field service') }}</span>
                        </div>
                    </div>
                    <h3 class="mb-3 text-lg font-bold text-text-primary">{{ __('Field service — digitally, with photos, with signature') }}</h3>
                    <p class="mb-5 text-sm leading-relaxed text-text-secondary">{{ __('The technician records on-site: work completed, materials used, photo documentation, customer digital signature. The worksheet is instantly in the system — PDF at the customer\'s in minutes.') }}</p>
                    <div class="mb-5 grid grid-cols-2 gap-2">
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><span class="feature-dot h-1 w-1 rounded-full bg-rose-400"></span>{{ __('Digital worksheet') }}</span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><span class="feature-dot h-1 w-1 rounded-full bg-rose-400"></span>{{ __('Photo documentation') }}</span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><span class="feature-dot h-1 w-1 rounded-full bg-rose-400"></span>{{ __('Customer e-signature') }}</span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><span class="feature-dot h-1 w-1 rounded-full bg-rose-400"></span>{{ __('Material usage') }}</span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><span class="feature-dot h-1 w-1 rounded-full bg-rose-400"></span>{{ __('Offline mode') }}</span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><span class="feature-dot h-1 w-1 rounded-full bg-rose-400"></span>{{ __('PDF export for customer') }}</span>
                    </div>
                    <a href="{{ route('products.szerviz') }}" class="inline-flex items-center gap-1.5 text-sm font-semibold text-rose-600 transition-colors hover:text-rose-700">
                        {{ __('View details') }} <svg class="arrow-slide h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" /></svg>
                    </a>
                </div>

                {{-- CRM --}}
                <div class="stagger-item card-glow group rounded-2xl border border-border-light bg-surface-primary p-8" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="mb-5 flex items-center gap-4">
                        <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-pink-50">
                            <x-module-icon module="crm" class="h-5 w-5 text-pink-600" />
                        </div>
                        <div>
                            <span class="block text-sm font-bold text-text-primary">CRM</span>
                            <span class="text-xs text-text-tertiary">{{ __('Customer relations & history') }}</span>
                        </div>
                    </div>
                    <h3 class="mb-3 text-lg font-bold text-text-primary">{{ __('Complete customer history — from purchase to service records') }}</h3>
                    <p class="mb-5 text-sm leading-relaxed text-text-secondary">{{ __('Service tickets, dispatch history, warranty status, contacts and NPS rating — all on one timeline. Customer support sees everything instantly, before picking up the phone.') }}</p>
                    <div class="mb-5 grid grid-cols-2 gap-2">
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><span class="feature-dot h-1 w-1 rounded-full bg-pink-400"></span>{{ __('Service history') }}</span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><span class="feature-dot h-1 w-1 rounded-full bg-pink-400"></span>{{ __('Warranty management') }}</span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><span class="feature-dot h-1 w-1 rounded-full bg-pink-400"></span>{{ __('Ticket system') }}</span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><span class="feature-dot h-1 w-1 rounded-full bg-pink-400"></span>{{ __('SLA monitoring') }}</span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><span class="feature-dot h-1 w-1 rounded-full bg-pink-400"></span>{{ __('NPS/CSAT measurement') }}</span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><span class="feature-dot h-1 w-1 rounded-full bg-pink-400"></span>{{ __('Customer portal') }}</span>
                    </div>
                    <a href="{{ route('products.crm') }}" class="inline-flex items-center gap-1.5 text-sm font-semibold text-pink-600 transition-colors hover:text-pink-700">
                        {{ __('View details') }} <svg class="arrow-slide h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" /></svg>
                    </a>
                </div>

                {{-- AI Chat --}}
                <div class="stagger-item card-glow group rounded-2xl border border-border-light bg-surface-primary p-8" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="mb-5 flex items-center gap-4">
                        <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-violet-50">
                            <x-module-icon module="ai-chat" class="h-5 w-5 text-violet-600" />
                        </div>
                        <div>
                            <span class="block text-sm font-bold text-text-primary">AI Chat</span>
                            <span class="text-xs text-text-tertiary">{{ __('24/7 customer support') }}</span>
                        </div>
                    </div>
                    <h3 class="mb-3 text-lg font-bold text-text-primary">{{ __('AI customer support — 24/7, with your knowledge base') }}</h3>
                    <p class="mb-5 text-sm leading-relaxed text-text-secondary">{{ __('The AI chatbot answers the most common service questions: ticket status, delivery time, warranty, documents. If it can\'t answer, it automatically opens a ticket and hands over to a live colleague.') }}</p>
                    <div class="mb-5 grid grid-cols-2 gap-2">
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><span class="feature-dot h-1 w-1 rounded-full bg-violet-400"></span>{{ __('24/7 availability') }}</span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><span class="feature-dot h-1 w-1 rounded-full bg-violet-400"></span>{{ __('Ticket status inquiry') }}</span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><span class="feature-dot h-1 w-1 rounded-full bg-violet-400"></span>{{ __('Automatic ticket creation') }}</span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><span class="feature-dot h-1 w-1 rounded-full bg-violet-400"></span>{{ __('Knowledge base integration') }}</span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><span class="feature-dot h-1 w-1 rounded-full bg-violet-400"></span>{{ __('Multilingual (HU/EN/DE)') }}</span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><span class="feature-dot h-1 w-1 rounded-full bg-violet-400"></span>{{ __('Live handover to colleague') }}</span>
                    </div>
                    <a href="{{ route('products.aichat') }}" class="inline-flex items-center gap-1.5 text-sm font-semibold text-violet-600 transition-colors hover:text-violet-700">
                        {{ __('View details') }} <svg class="arrow-slide h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" /></svg>
                    </a>
                </div>

                {{-- Automatizálás --}}
                <div class="stagger-item card-glow group rounded-2xl border border-border-light bg-surface-primary p-8" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="mb-5 flex items-center gap-4">
                        <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-blue-50">
                            <x-module-icon module="automatizalas" class="h-5 w-5 text-blue-600" />
                        </div>
                        <div>
                            <span class="block text-sm font-bold text-text-primary">{{ __('Automation') }}</span>
                            <span class="text-xs text-text-tertiary">{{ __('Service workflows') }}</span>
                        </div>
                    </div>
                    <h3 class="mb-3 text-lg font-bold text-text-primary">{{ __('Automatic ticket assignment, escalation and proactive notification') }}</h3>
                    <p class="mb-5 text-sm leading-relaxed text-text-secondary">{{ __('New service request — automatic assignment to the nearest available technician. SLA deadline approaching — escalation. Warranty expiring — proactive framework agreement offer.') }}</p>
                    <div class="mb-5 grid grid-cols-2 gap-2">
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><span class="feature-dot h-1 w-1 rounded-full bg-blue-400"></span>{{ __('Automatic assignment') }}</span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><span class="feature-dot h-1 w-1 rounded-full bg-blue-400"></span>{{ __('SLA escalation') }}</span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><span class="feature-dot h-1 w-1 rounded-full bg-blue-400"></span>{{ __('Warranty expiry trigger') }}</span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><span class="feature-dot h-1 w-1 rounded-full bg-blue-400"></span>{{ __('Proactive notification') }}</span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><span class="feature-dot h-1 w-1 rounded-full bg-blue-400"></span>{{ __('Maintenance reminder') }}</span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><span class="feature-dot h-1 w-1 rounded-full bg-blue-400"></span>{{ __('Satisfaction survey') }}</span>
                    </div>
                    <a href="{{ route('products.automatizalas') }}" class="inline-flex items-center gap-1.5 text-sm font-semibold text-blue-600 transition-colors hover:text-blue-700">
                        {{ __('View details') }} <svg class="arrow-slide h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" /></svg>
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{-- Service Lifecycle Section --}}
    <section class="bg-surface-secondary py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-6">
            <div class="reveal mb-12">
                <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-rose-600">{{ __('Service cycle') }}</p>
                <h2 class="mb-4 text-3xl text-text-primary md:text-4xl" style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                    {{ __('From report to closure — in a closed system') }}
                </h2>
                <p class="max-w-xl text-lg text-text-secondary">
                    {{ __('Every step is automated, documented and transparent to the customer.') }}
                </p>
            </div>

            <div class="grid grid-cols-2 gap-5 sm:grid-cols-3 lg:grid-cols-6" data-stagger>
                <div class="stagger-item text-center">
                    <div class="mx-auto mb-4 flex h-16 w-16 items-center justify-center rounded-full border-2 border-rose-200 bg-surface-primary text-xl font-bold text-rose-600">01</div>
                    <h4 class="mb-1 text-sm font-bold text-text-primary">{{ __('Report') }}</h4>
                    <p class="mb-2 text-xs text-text-tertiary">{{ __('By phone, email, AI chatbot or customer portal — automatic ticket') }}</p>
                    <div class="flex flex-wrap justify-center gap-1">
                        <span class="rounded bg-rose-50 px-1.5 py-0.5 text-[9px] font-semibold text-rose-600">AI Chat</span>
                        <span class="rounded bg-rose-50 px-1.5 py-0.5 text-[9px] font-semibold text-rose-600">CRM</span>
                    </div>
                </div>
                <div class="stagger-item text-center">
                    <div class="mx-auto mb-4 flex h-16 w-16 items-center justify-center rounded-full border-2 border-pink-200 bg-surface-primary text-xl font-bold text-pink-600">02</div>
                    <h4 class="mb-1 text-sm font-bold text-text-primary">{{ __('Assignment') }}</h4>
                    <p class="mb-2 text-xs text-text-tertiary">{{ __('Automatic technician assignment based on expertise, location and availability') }}</p>
                    <div class="flex flex-wrap justify-center gap-1">
                        <span class="rounded bg-pink-50 px-1.5 py-0.5 text-[9px] font-semibold text-pink-600">{{ __('Automation') }}</span>
                    </div>
                </div>
                <div class="stagger-item text-center">
                    <div class="mx-auto mb-4 flex h-16 w-16 items-center justify-center rounded-full border-2 border-amber-200 bg-surface-primary text-xl font-bold text-amber-600">03</div>
                    <h4 class="mb-1 text-sm font-bold text-text-primary">{{ __('On-site work') }}</h4>
                    <p class="mb-2 text-xs text-text-tertiary">{{ __('Digital worksheet, photo, material usage, customer e-signature') }}</p>
                    <div class="flex flex-wrap justify-center gap-1">
                        <span class="rounded bg-amber-50 px-1.5 py-0.5 text-[9px] font-semibold text-amber-600">{{ __('Worksheet') }}</span>
                        <span class="rounded bg-amber-50 px-1.5 py-0.5 text-[9px] font-semibold text-amber-600">{{ __('Procurement') }}</span>
                    </div>
                </div>
                <div class="stagger-item text-center">
                    <div class="mx-auto mb-4 flex h-16 w-16 items-center justify-center rounded-full border-2 border-blue-200 bg-surface-primary text-xl font-bold text-blue-600">04</div>
                    <h4 class="mb-1 text-sm font-bold text-text-primary">{{ __('Documentation') }}</h4>
                    <p class="mb-2 text-xs text-text-tertiary">{{ __('Automatic PDF for the customer, data in CRM and controlling') }}</p>
                    <div class="flex flex-wrap justify-center gap-1">
                        <span class="rounded bg-blue-50 px-1.5 py-0.5 text-[9px] font-semibold text-blue-600">CRM</span>
                        <span class="rounded bg-blue-50 px-1.5 py-0.5 text-[9px] font-semibold text-blue-600">{{ __('Controlling') }}</span>
                    </div>
                </div>
                <div class="stagger-item text-center">
                    <div class="mx-auto mb-4 flex h-16 w-16 items-center justify-center rounded-full border-2 border-success-200 bg-surface-primary text-xl font-bold text-success-600">05</div>
                    <h4 class="mb-1 text-sm font-bold text-text-primary">{{ __('Feedback') }}</h4>
                    <p class="mb-2 text-xs text-text-tertiary">{{ __('Automatic satisfaction survey, NPS measurement, complaint handling') }}</p>
                    <div class="flex flex-wrap justify-center gap-1">
                        <span class="rounded bg-success-50 px-1.5 py-0.5 text-[9px] font-semibold text-success-600">{{ __('Automation') }}</span>
                        <span class="rounded bg-success-50 px-1.5 py-0.5 text-[9px] font-semibold text-success-600">CRM</span>
                    </div>
                </div>
                <div class="stagger-item text-center">
                    <div class="mx-auto mb-4 flex h-16 w-16 items-center justify-center rounded-full border-2 border-violet-200 bg-surface-primary text-xl font-bold text-violet-600">06</div>
                    <h4 class="mb-1 text-sm font-bold text-text-primary">{{ __('Proactive care') }}</h4>
                    <p class="mb-2 text-xs text-text-tertiary">{{ __('Maintenance reminder, warranty expiry offer, upsell opportunity') }}</p>
                    <div class="flex flex-wrap justify-center gap-1">
                        <span class="rounded bg-violet-50 px-1.5 py-0.5 text-[9px] font-semibold text-violet-600">{{ __('Automation') }}</span>
                        <span class="rounded bg-violet-50 px-1.5 py-0.5 text-[9px] font-semibold text-violet-600">{{ __('Sales') }}</span>
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
                    <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-rose-600">{{ __('Full ecosystem') }}</p>
                    <h2 class="text-3xl text-text-primary md:text-4xl" style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                        {{ __('All 11 modules serving customer retention') }}
                    </h2>
                </div>
                <p class="text-lg leading-relaxed text-text-secondary lg:mt-8">
                    {{ __('Customer service is not an isolated department — history comes from the CRM, procurement ensures parts, sales picks up the upsell thread, controlling measures service profitability. When all this is in one system, customer service doesn\'t just react — it proactively cares.') }}
                </p>
            </div>

            <div class="grid grid-cols-2 gap-4 sm:grid-cols-4 lg:grid-cols-7" data-stagger>
                <div class="stagger-item pill-float rounded-xl border border-border-light bg-surface-primary p-4 text-center" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="mx-auto mb-3 flex h-10 w-10 items-center justify-center rounded-lg bg-success-50">
                        <x-module-icon module="ertekesites" class="h-5 w-5 text-success-600" />
                    </div>
                    <h4 class="mb-1 text-xs font-bold text-text-primary">{{ __('CRM & Sales') }}</h4>
                    <p class="text-[10px] leading-snug text-text-tertiary">{{ __('Service upsell automatically becomes a sales opportunity') }}</p>
                </div>
                <div class="stagger-item pill-float rounded-xl border border-border-light bg-surface-primary p-4 text-center" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="mx-auto mb-3 flex h-10 w-10 items-center justify-center rounded-lg bg-cyan-50">
                        <x-module-icon module="beszerzes" class="h-5 w-5 text-cyan-600" />
                    </div>
                    <h4 class="mb-1 text-xs font-bold text-text-primary">{{ __('Procurement & Logistics') }}</h4>
                    <p class="text-[10px] leading-snug text-text-tertiary">{{ __('Service parts inventory level and automatic reorder') }}</p>
                </div>
                <div class="stagger-item pill-float rounded-xl border border-border-light bg-surface-primary p-4 text-center" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="mx-auto mb-3 flex h-10 w-10 items-center justify-center rounded-lg bg-indigo-50">
                        <x-module-icon module="kontrolling" class="h-5 w-5 text-indigo-600" />
                    </div>
                    <h4 class="mb-1 text-xs font-bold text-text-primary">{{ __('Controlling') }}</h4>
                    <p class="text-[10px] leading-snug text-text-tertiary">{{ __('Service profitability per dispatch and framework agreement level') }}</p>
                </div>
                <div class="stagger-item pill-float rounded-xl border border-border-light bg-surface-primary p-4 text-center" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="mx-auto mb-3 flex h-10 w-10 items-center justify-center rounded-lg bg-orange-50">
                        <x-module-icon module="gyartas" class="h-5 w-5 text-orange-600" />
                    </div>
                    <h4 class="mb-1 text-xs font-bold text-text-primary">{{ __('Production Management') }}</h4>
                    <p class="text-[10px] leading-snug text-text-tertiary">{{ __('Service feedback as quality input for production') }}</p>
                </div>
                <div class="stagger-item pill-float rounded-xl border border-border-light bg-surface-primary p-4 text-center" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="mx-auto mb-3 flex h-10 w-10 items-center justify-center rounded-lg bg-blue-50">
                        <x-module-icon module="datamind" class="h-5 w-5 text-blue-600" />
                    </div>
                    <h4 class="mb-1 text-xs font-bold text-text-primary">DataMind</h4>
                    <p class="text-[10px] leading-snug text-text-tertiary">{{ __('Predictive service: AI signals which customer needs maintenance') }}</p>
                </div>
                <div class="stagger-item pill-float rounded-xl border border-border-light bg-surface-primary p-4 text-center" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="mx-auto mb-3 flex h-10 w-10 items-center justify-center rounded-lg bg-amber-50">
                        <x-module-icon module="marketinghub" class="h-5 w-5 text-amber-600" />
                    </div>
                    <h4 class="mb-1 text-xs font-bold text-text-primary">MarketingHub</h4>
                    <p class="text-[10px] leading-snug text-text-tertiary">{{ __('NPS-based automatic reference request and case study collection') }}</p>
                </div>
                <div class="stagger-item pill-float rounded-xl border border-border-light bg-surface-primary p-4 text-center" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="mx-auto mb-3 flex h-10 w-10 items-center justify-center rounded-lg bg-violet-50">
                        <x-module-icon module="seo" class="h-5 w-5 text-violet-600" />
                    </div>
                    <h4 class="mb-1 text-xs font-bold text-text-primary">{{ __('SEO Tool') }}</h4>
                    <p class="text-[10px] leading-snug text-text-tertiary">{{ __('Service content SEO: maintenance guides as inbound leads') }}</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Stats Section --}}
    <section class="bg-surface-secondary py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-6">
            <div class="reveal mb-12 text-center">
                <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-rose-600">{{ __('Results') }}</p>
                <h2 class="text-3xl text-text-primary md:text-4xl" style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                    {{ __('Measurable improvement in customer service') }}
                </h2>
            </div>

            <div class="grid grid-cols-2 gap-5 lg:grid-cols-4" data-stagger data-counter-trigger>
                <div class="stagger-item stat-hover rounded-2xl border border-border-light bg-surface-primary p-8 text-center" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <span class="stat-value block text-4xl font-bold text-rose-600 lg:text-5xl" style="font-family: 'JetBrains Mono', monospace;"
                        data-count="60" data-prefix="-" data-suffix="%">0%</span>
                    <span class="mt-2 block text-sm text-text-secondary">{{ __('Average response time reduction') }}</span>
                </div>
                <div class="stagger-item stat-hover rounded-2xl border border-border-light bg-surface-primary p-8 text-center" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <span class="stat-value block text-4xl font-bold text-success-600 lg:text-5xl" style="font-family: 'JetBrains Mono', monospace;"
                        data-count="35" data-prefix="+" data-suffix="%">0%</span>
                    <span class="mt-2 block text-sm text-text-secondary">{{ __('Customer retention improvement') }}</span>
                </div>
                <div class="stagger-item stat-hover rounded-2xl border border-border-light bg-surface-primary p-8 text-center" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <span class="stat-value block text-4xl font-bold text-amber-600 lg:text-5xl" style="font-family: 'JetBrains Mono', monospace;"
                        data-count="45" data-prefix="+" data-suffix="%">0%</span>
                    <span class="mt-2 block text-sm text-text-secondary">{{ __('Service upsell conversion') }}</span>
                </div>
                <div class="stagger-item stat-hover rounded-2xl border border-border-light bg-surface-primary p-8 text-center" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <span class="stat-value block text-4xl font-bold text-blue-600 lg:text-5xl" style="font-family: 'JetBrains Mono', monospace;"
                        data-count="70" data-prefix="-" data-suffix="%">0%</span>
                    <span class="mt-2 block text-sm text-text-secondary">{{ __('On-site admin time') }}</span>
                </div>
            </div>
        </div>
    </section>

    {{-- Use Cases Section --}}
    <section class="bg-surface-primary py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-6">
            <div class="reveal mb-12">
                <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-rose-600">{{ __('Use cases') }}</p>
                <h2 class="mb-4 text-3xl text-text-primary md:text-4xl" style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                    {{ __('How industrial service teams use it') }}
                </h2>
            </div>

            <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3" data-stagger>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-7" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <span class="mb-4 block text-xs font-semibold text-text-tertiary" style="font-family: 'JetBrains Mono', monospace;">01</span>
                    <h3 class="mb-2 text-base font-bold text-text-primary">{{ __('Digital documentation of field service') }}</h3>
                    <p class="mb-4 text-sm leading-relaxed text-text-secondary">{{ __('The technician records the work done on-site, takes photos, records materials used, the customer signs — and the worksheet PDF is in the customer\'s email before the technician has left.') }}</p>
                    <div class="flex flex-wrap gap-1.5">
                        <span class="rounded bg-rose-50 px-2 py-0.5 text-[10px] font-semibold text-rose-600">{{ __('Worksheet') }}</span>
                        <span class="rounded bg-rose-50 px-2 py-0.5 text-[10px] font-semibold text-rose-600">CRM</span>
                    </div>
                </div>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-7" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <span class="mb-4 block text-xs font-semibold text-text-tertiary" style="font-family: 'JetBrains Mono', monospace;">02</span>
                    <h3 class="mb-2 text-base font-bold text-text-primary">{{ __('24/7 AI customer support') }}</h3>
                    <p class="mb-4 text-sm leading-relaxed text-text-secondary">{{ __('The customer can check service ticket status, warranty status or the next maintenance date even at 2 AM. If the AI can\'t help, it automatically opens a ticket.') }}</p>
                    <div class="flex flex-wrap gap-1.5">
                        <span class="rounded bg-rose-50 px-2 py-0.5 text-[10px] font-semibold text-rose-600">AI Chat</span>
                        <span class="rounded bg-rose-50 px-2 py-0.5 text-[10px] font-semibold text-rose-600">CRM</span>
                    </div>
                </div>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-7" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <span class="mb-4 block text-xs font-semibold text-text-tertiary" style="font-family: 'JetBrains Mono', monospace;">03</span>
                    <h3 class="mb-2 text-base font-bold text-text-primary">{{ __('Proactive maintenance notification') }}</h3>
                    <p class="mb-4 text-sm leading-relaxed text-text-secondary">{{ __('Automation signals when annual maintenance is due at a customer, warranty is expiring, or DataMind prediction indicates service will be needed soon — sales can send an offer in time.') }}</p>
                    <div class="flex flex-wrap gap-1.5">
                        <span class="rounded bg-rose-50 px-2 py-0.5 text-[10px] font-semibold text-rose-600">{{ __('Automation') }}</span>
                        <span class="rounded bg-rose-50 px-2 py-0.5 text-[10px] font-semibold text-rose-600">DataMind</span>
                        <span class="rounded bg-rose-50 px-2 py-0.5 text-[10px] font-semibold text-rose-600">{{ __('Sales') }}</span>
                    </div>
                </div>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-7" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <span class="mb-4 block text-xs font-semibold text-text-tertiary" style="font-family: 'JetBrains Mono', monospace;">04</span>
                    <h3 class="mb-2 text-base font-bold text-text-primary">{{ __('Complaint handling and warranty workflow') }}</h3>
                    <p class="mb-4 text-sm leading-relaxed text-text-secondary">{{ __('Complaint received — automatic categorization — warranty check — assignment to responsible technician — SLA deadline monitoring — closure and feedback. Complete audit trail.') }}</p>
                    <div class="flex flex-wrap gap-1.5">
                        <span class="rounded bg-rose-50 px-2 py-0.5 text-[10px] font-semibold text-rose-600">CRM</span>
                        <span class="rounded bg-rose-50 px-2 py-0.5 text-[10px] font-semibold text-rose-600">{{ __('Automation') }}</span>
                    </div>
                </div>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-7" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <span class="mb-4 block text-xs font-semibold text-text-tertiary" style="font-family: 'JetBrains Mono', monospace;">05</span>
                    <h3 class="mb-2 text-base font-bold text-text-primary">{{ __('Service upsell and framework agreement offer') }}</h3>
                    <p class="mb-4 text-sm leading-relaxed text-text-secondary">{{ __('The field technician notes the expansion opportunity on the worksheet — sales automatically gets a notification and offer template. The highest conversion sales channel.') }}</p>
                    <div class="flex flex-wrap gap-1.5">
                        <span class="rounded bg-rose-50 px-2 py-0.5 text-[10px] font-semibold text-rose-600">{{ __('Worksheet') }}</span>
                        <span class="rounded bg-rose-50 px-2 py-0.5 text-[10px] font-semibold text-rose-600">{{ __('Sales') }}</span>
                        <span class="rounded bg-rose-50 px-2 py-0.5 text-[10px] font-semibold text-rose-600">CRM</span>
                    </div>
                </div>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-7" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <span class="mb-4 block text-xs font-semibold text-text-tertiary" style="font-family: 'JetBrains Mono', monospace;">06</span>
                    <h3 class="mb-2 text-base font-bold text-text-primary">{{ __('Service profitability analysis') }}</h3>
                    <p class="mb-4 text-sm leading-relaxed text-text-secondary">{{ __('How much does a dispatch cost? Which framework agreement is profitable and which isn\'t? Controlling measures the service P&L in real time — at customer and dispatch level.') }}</p>
                    <div class="flex flex-wrap gap-1.5">
                        <span class="rounded bg-rose-50 px-2 py-0.5 text-[10px] font-semibold text-rose-600">{{ __('Controlling') }}</span>
                        <span class="rounded bg-rose-50 px-2 py-0.5 text-[10px] font-semibold text-rose-600">{{ __('Worksheet') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Comparison Table Section --}}
    <section class="bg-surface-secondary py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-6">
            <div class="reveal mb-12">
                <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-rose-600">{{ __('Comparison') }}</p>
                <h2 class="mb-4 text-3xl text-text-primary md:text-4xl" style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                    {{ __('Instead of phone-based service — integrated customer support platform') }}
                </h2>
                <p class="max-w-xl text-lg text-text-secondary">
                    {{ __('This is how customer service changes with Cégem360.') }}
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
                        <tr><td class="px-6 py-4 text-sm font-semibold text-text-primary">{{ __('Service report') }}</td><td class="px-6 py-4 text-sm text-text-tertiary">{{ __('Phone / email') }}</td><td class="px-6 py-4 text-sm font-medium text-success-600">{{ __('✓ AI Chat + portal + phone') }}</td></tr>
                        <tr><td class="px-6 py-4 text-sm font-semibold text-text-primary">{{ __('Availability') }}</td><td class="px-6 py-4 text-sm text-text-tertiary">{{ __('During business hours') }}</td><td class="px-6 py-4 text-sm font-medium text-success-600">{{ __('✓ 24/7 AI customer support') }}</td></tr>
                        <tr><td class="px-6 py-4 text-sm font-semibold text-text-primary">{{ __('Service history') }}</td><td class="px-6 py-4 text-sm text-text-tertiary">{{ __('None / scattered') }}</td><td class="px-6 py-4 text-sm font-medium text-success-600">{{ __('✓ Complete timeline') }}</td></tr>
                        <tr><td class="px-6 py-4 text-sm font-semibold text-text-primary">{{ __('On-site documentation') }}</td><td class="px-6 py-4 text-sm text-text-tertiary">{{ __('Paper worksheet') }}</td><td class="px-6 py-4 text-sm font-medium text-success-600">{{ __('✓ Digital, with photo, e-signature') }}</td></tr>
                        <tr><td class="px-6 py-4 text-sm font-semibold text-text-primary">{{ __('Warranty management') }}</td><td class="px-6 py-4 text-sm text-text-tertiary">{{ __('Manual check') }}</td><td class="px-6 py-4 text-sm font-medium text-success-600">{{ __('✓ Automatic, from CRM') }}</td></tr>
                        <tr><td class="px-6 py-4 text-sm font-semibold text-text-primary">{{ __('Proactive care') }}</td><td class="px-6 py-4 text-sm text-text-tertiary">{{ __('When the customer calls') }}</td><td class="px-6 py-4 text-sm font-medium text-success-600">{{ __('✓ AI prediction + automatic notification') }}</td></tr>
                        <tr><td class="px-6 py-4 text-sm font-semibold text-text-primary">{{ __('Service upsell') }}</td><td class="px-6 py-4 text-sm text-text-tertiary">{{ __('Lost information') }}</td><td class="px-6 py-4 text-sm font-medium text-success-600">{{ __('✓ Automatic offer from worksheet') }}</td></tr>
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
                        <h3 class="mb-3 text-xl font-bold text-text-primary lg:text-2xl" style="font-family: 'Poppins', sans-serif;">{{ __('Personalized online consultation') }}</h3>
                        <p class="mb-5 text-base text-text-secondary">{{ __('A 30-minute video call where we assess how you can digitize your customer service and service processes with Cégem360 — tailored to your industry, team size and customer base.') }}</p>
                        <div class="flex flex-wrap gap-5">
                            <span class="flex items-center gap-1.5 text-sm text-text-tertiary"><svg class="h-4 w-4 text-success-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>{{ __('30-minute video call') }}</span>
                            <span class="flex items-center gap-1.5 text-sm text-text-tertiary"><svg class="h-4 w-4 text-success-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>{{ __('Service process audit') }}</span>
                            <span class="flex items-center gap-1.5 text-sm text-text-tertiary"><svg class="h-4 w-4 text-success-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>{{ __('No commitment') }}</span>
                        </div>
                    </div>
                    <a href="{{ route('contact') }}" class="group inline-flex items-center gap-2 rounded-full bg-rose-600 px-6 py-3 text-base font-medium text-white transition-all hover:bg-rose-700 hover:shadow-lg" style="box-shadow: 0 1px 2px rgba(0,0,0,0.05);">
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
                <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-rose-600">{{ __('Get started') }}</p>
                <h2 class="mb-4 text-3xl text-text-primary md:text-4xl" style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                    {{ __('Ready for proactive customer service?') }}
                </h2>
                <p class="mx-auto max-w-xl text-lg text-text-secondary">
                    {{ __('Choose the next step for you.') }}
                </p>
            </div>

            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2" data-stagger>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-8 text-center" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <h3 class="mb-3 text-xl font-bold text-text-primary">{{ __('Online consultation') }}</h3>
                    <p class="mb-6 text-sm text-text-secondary">{{ __('Ask our experts in 30 minutes — via video call, tailored to your service challenges, with no obligation.') }}</p>
                    <a href="{{ route('contact') }}" class="inline-flex items-center gap-2 rounded-full border border-border-light bg-surface-secondary px-6 py-3 text-sm font-medium text-text-primary transition-all hover:border-rose-200 hover:shadow-md">
                        {{ __('Book appointment') }} <svg class="arrow-slide h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" /></svg>
                    </a>
                </div>
                <div class="stagger-item card-glow rounded-2xl border border-rose-100 bg-rose-50 p-8 text-center" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <h3 class="mb-3 text-xl font-bold text-text-primary">{{ __('Registration and trial') }}</h3>
                    <p class="mb-6 text-sm text-text-secondary">{{ __('Explore the digital worksheet, the AI chatbot and the service ticket system — instantly.') }}</p>
                    <a href="{{ route('register') }}" class="group inline-flex items-center gap-2 rounded-full bg-rose-600 px-6 py-3 text-sm font-medium text-white transition-all hover:bg-rose-700 hover:shadow-lg" style="box-shadow: 0 1px 2px rgba(0,0,0,0.05);">
                        {{ __('Registration') }} <svg class="arrow-slide h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" /></svg>
                    </a>
                </div>
            </div>
        </div>
    </section>
</div>
