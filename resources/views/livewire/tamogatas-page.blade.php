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
                        <span class="text-sm font-medium text-text-primary">{{ __('Feature — 24/7 Support') }}</span>
                    </div>

                    <h1 class="mb-6 text-4xl leading-tight tracking-tight text-text-primary md:text-5xl lg:text-[3.5rem]"
                        style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                        {{ __('AI answers at night —') }}<br>
                        {{ __('our team is there during the day') }}
                    </h1>

                    <p class="mb-10 max-w-xl text-lg text-text-secondary lg:text-xl">
                        {{ __('Cégem360 support has two levels: AI Chat answers your questions around the clock, based on system data. During business hours, our expert team handles more complex issues — via email or bug report form.') }}
                    </p>

                    <div class="flex flex-wrap items-center gap-4">
                        <a href="{{ route('hibabejelentes') }}"
                            class="group inline-flex items-center gap-2 rounded-full bg-emerald-600 px-6 py-3 text-base font-medium text-white transition-all hover:bg-emerald-700 hover:shadow-lg"
                            style="box-shadow: 0 1px 2px rgba(0,0,0,0.05);">
                            <span>{{ __('Bug report') }}</span>
                            <svg class="arrow-slide h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" /></svg>
                        </a>
                        <a href="#csatornak"
                            class="inline-flex items-center gap-2 rounded-full border border-border-light bg-surface-primary px-6 py-3 text-base font-medium text-text-primary transition-all hover:border-emerald-200 hover:bg-surface-secondary hover:shadow-md">
                            {{ __('Our contact options') }}
                        </a>
                    </div>
                </div>

                {{-- Support Visual --}}
                <div class="reveal-right">
                    <div class="rounded-2xl border border-border-light bg-surface-primary p-6"
                        style="box-shadow: 0 4px 20px -4px rgba(0,0,0,0.06);">
                        <div class="mb-4 flex items-center justify-between border-b border-border-light pb-4">
                            <div>
                                <span class="block text-sm font-bold text-text-primary">{{ __('Support') }}</span>
                                <span class="block text-[10px] text-text-tertiary">{{ __('AI Chat + Human customer service') }}</span>
                            </div>
                            <div class="flex gap-2">
                                <span class="inline-flex items-center gap-1.5 rounded-md border border-emerald-100 bg-emerald-50 px-2 py-0.5 text-[10px] font-semibold text-emerald-600">
                                    <span class="chat-pulse h-1 w-1 rounded-full bg-emerald-500"></span>
                                    AI Chat · 24/7
                                </span>
                                <span class="inline-flex items-center gap-1.5 rounded-md border border-blue-100 bg-blue-50 px-2 py-0.5 text-[10px] font-semibold text-blue-600">
                                    {{ __('Team · Mon–Fri 8–16h') }}
                                </span>
                            </div>
                        </div>

                        {{-- Chat Preview --}}
                        <div class="mb-4 space-y-2">
                            <div class="ml-auto max-w-[88%] rounded-lg rounded-br-sm bg-surface-secondary p-2.5 text-right">
                                <span class="mb-1 block text-[9px] font-bold text-text-tertiary">{{ __('Customer · 23:47') }}</span>
                                <span class="text-[11px] text-text-primary">{{ __('I can\'t access the work order module, I\'m getting an error message: "Access denied".') }}</span>
                            </div>
                            <div class="max-w-[88%] rounded-lg rounded-bl-sm border border-emerald-100 bg-emerald-50 p-2.5">
                                <span class="mb-1 block text-[9px] font-bold text-emerald-600">AI Chat · 23:47</span>
                                <span class="text-[11px] text-text-secondary">{{ __('I checked your permissions. The "Work order" module access is tied to the "Service technician" role, but your account has the "Sales" role. Suggestion: ask the system administrator for a role expansion.') }}</span>
                            </div>
                            <div class="ml-auto max-w-[88%] rounded-lg rounded-br-sm bg-surface-secondary p-2.5 text-right">
                                <span class="mb-1 block text-[9px] font-bold text-text-tertiary">{{ __('Customer · 23:48') }}</span>
                                <span class="text-[11px] text-text-primary">{{ __('Thanks, I\'ll let them know tomorrow morning. But if it doesn\'t work, can you also change it?') }}</span>
                            </div>
                            <div class="max-w-[88%] rounded-lg rounded-bl-sm border border-blue-100 bg-blue-50 p-2.5">
                                <span class="mb-1 block text-[9px] font-bold text-blue-600">{{ __('Handoff · Automatic') }}</span>
                                <span class="text-[11px] text-text-secondary">{{ __('Yes! If you submit it on the bug report form after 8 AM, our team handles it Monday–Friday 8:00–16:00. Meanwhile, I\'ve logged the request.') }}</span>
                            </div>
                        </div>

                        {{-- Channel Cards --}}
                        <div class="mb-3 grid grid-cols-3 gap-2">
                            <div class="rounded-lg border border-border-light bg-surface-secondary p-2.5 text-center">
                                <span class="block text-sm">&#129302;</span>
                                <span class="block text-[10px] font-bold text-text-primary">AI Chat</span>
                                <span class="block text-[9px] font-semibold text-emerald-600">24/7 · {{ __('Instant') }}</span>
                            </div>
                            <div class="rounded-lg border border-border-light bg-surface-secondary p-2.5 text-center">
                                <span class="block text-sm">&#128231;</span>
                                <span class="block text-[10px] font-bold text-text-primary">{{ __('Email') }}</span>
                                <span class="block text-[9px] font-semibold text-blue-600">{{ __('Mon–Fri 8–16h') }}</span>
                            </div>
                            <div class="rounded-lg border border-border-light bg-surface-secondary p-2.5 text-center">
                                <span class="block text-sm">&#128203;</span>
                                <span class="block text-[10px] font-bold text-text-primary">{{ __('Bug report') }}</span>
                                <span class="block text-[9px] font-semibold text-blue-600">{{ __('Mon–Fri 8–16h') }}</span>
                            </div>
                        </div>

                        {{-- Footer Stats --}}
                        <div class="mt-3 flex gap-5 border-t border-border-light pt-3">
                            <span class="flex items-center gap-1.5 text-[10px] text-text-tertiary">
                                <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span> {{ __('AI Chat online') }}
                            </span>
                            <span class="flex items-center gap-1.5 text-[10px] text-text-tertiary">
                                <span class="h-1.5 w-1.5 rounded-full bg-blue-500"></span> {{ __('Human support: Mon–Fri 8–16') }}
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
                <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-emerald-600">{{ __('Two-level support') }}</p>
                <h2 class="mb-4 text-3xl text-text-primary md:text-4xl" style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                    {{ __('AI Chat around the clock + Expert team during business hours') }}
                </h2>
                <p class="max-w-xl text-lg text-text-secondary">
                    {{ __('AI helps immediately with simple questions. Our team handles the more complex issues — human to human.') }}
                </p>
            </div>

            <div class="grid grid-cols-1 gap-6 lg:grid-cols-2" data-stagger>
                {{-- AI Chat Pillar --}}
                <div class="stagger-item card-glow rounded-2xl border border-emerald-100 bg-emerald-50/30 p-8" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="mb-5 flex items-center gap-3">
                        <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-emerald-50 text-xl">&#129302;</span>
                        <div>
                            <span class="mb-0.5 inline-flex rounded-lg bg-emerald-50 px-3 py-1 text-[11px] font-bold uppercase tracking-wider text-emerald-600">AI Chat</span>
                            <span class="block text-xs font-semibold text-emerald-600">{{ __('24/7 — day and night, weekends too') }}</span>
                        </div>
                    </div>
                    <h3 class="mb-2 text-lg font-bold text-text-primary">{{ __('Instant answers, built on system data') }}</h3>
                    <p class="mb-5 text-sm text-text-secondary">{{ __('AI Chat is not a generic chatbot — it knows the Cégem360 system data. It answers service ticket status, permission questions, module usage guides, and common errors. If it can\'t answer — it automatically logs the request for the team.') }}</p>
                    <div class="space-y-2.5">
                        <span class="flex items-center gap-2.5 text-sm text-text-secondary"><span class="h-1 w-1 rounded-full bg-emerald-500"></span>{{ __('Service ticket status, invoice, warranty queries') }}</span>
                        <span class="flex items-center gap-2.5 text-sm text-text-secondary"><span class="h-1 w-1 rounded-full bg-emerald-500"></span>{{ __('Module usage guide and troubleshooting') }}</span>
                        <span class="flex items-center gap-2.5 text-sm text-text-secondary"><span class="h-1 w-1 rounded-full bg-emerald-500"></span>{{ __('Permission and settings questions') }}</span>
                        <span class="flex items-center gap-2.5 text-sm text-text-secondary"><span class="h-1 w-1 rounded-full bg-emerald-500"></span>{{ __('Common error recognition and solution suggestions') }}</span>
                        <span class="flex items-center gap-2.5 text-sm text-text-secondary"><span class="h-1 w-1 rounded-full bg-emerald-500"></span>{{ __('In Hungarian, with natural conversation') }}</span>
                        <span class="flex items-center gap-2.5 text-sm text-text-secondary"><span class="h-1 w-1 rounded-full bg-emerald-500"></span>{{ __('If it can\'t help — automatic ticket to the team') }}</span>
                    </div>
                </div>

                {{-- Human Support Pillar --}}
                <div class="stagger-item card-glow rounded-2xl border border-blue-100 bg-blue-50/30 p-8" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="mb-5 flex items-center gap-3">
                        <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-blue-50 text-xl">&#128104;&#8205;&#128187;</span>
                        <div>
                            <span class="mb-0.5 inline-flex rounded-lg bg-blue-50 px-3 py-1 text-[11px] font-bold uppercase tracking-wider text-blue-600">{{ __('Human customer service') }}</span>
                            <span class="block text-xs font-semibold text-blue-600">{{ __('Monday – Friday · 8:00 – 16:00') }}</span>
                        </div>
                    </div>
                    <h3 class="mb-2 text-lg font-bold text-text-primary">{{ __('Expert team for complex issues') }}</h3>
                    <p class="mb-5 text-sm text-text-secondary">{{ __('The Cégem360 development and support team handles more complex technical problems, configuration questions, bug reports, and custom requests. Available via email and the bug report form.') }}</p>
                    <div class="space-y-2.5">
                        <span class="flex items-center gap-2.5 text-sm text-text-secondary"><span class="h-1 w-1 rounded-full bg-blue-500"></span>{{ __('Technical troubleshooting and bugfix') }}</span>
                        <span class="flex items-center gap-2.5 text-sm text-text-secondary"><span class="h-1 w-1 rounded-full bg-blue-500"></span>{{ __('Configuration and setup assistance') }}</span>
                        <span class="flex items-center gap-2.5 text-sm text-text-secondary"><span class="h-1 w-1 rounded-full bg-blue-500"></span>{{ __('Permission management and user administration') }}</span>
                        <span class="flex items-center gap-2.5 text-sm text-text-secondary"><span class="h-1 w-1 rounded-full bg-blue-500"></span>{{ __('Custom development requests coordination') }}</span>
                        <span class="flex items-center gap-2.5 text-sm text-text-secondary"><span class="h-1 w-1 rounded-full bg-blue-500"></span>{{ __('Email: support@cegem360.eu') }}</span>
                        <span class="flex items-center gap-2.5 text-sm text-text-secondary"><span class="h-1 w-1 rounded-full bg-blue-500"></span>{{ __('Bug report form: priority and screenshot attachment') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- How It Works Section (5 steps) --}}
    <section class="bg-surface-primary py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-6">
            <div class="reveal mb-12">
                <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-emerald-600">{{ __('How does it work?') }}</p>
                <h2 class="mb-4 text-3xl text-text-primary md:text-4xl" style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                    {{ __('From question to solution — step by step') }}
                </h2>
                <p class="max-w-xl text-lg text-text-secondary">
                    {{ __('The support process automatically takes the fastest route to the solution.') }}
                </p>
            </div>

            <div class="reveal">
                <div class="rounded-2xl border border-border-light bg-surface-primary p-6 lg:p-8" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    {{-- Steps --}}
                    <div class="mb-6 grid grid-cols-2 gap-4 sm:grid-cols-3 lg:grid-cols-5" data-stagger>
                        <div class="stagger-item rounded-xl border border-border-light bg-surface-secondary p-5 text-center">
                            <span class="mb-2 block text-xs font-bold text-emerald-600" style="font-family: 'JetBrains Mono', monospace;">01</span>
                            <span class="mb-2 block text-xl">&#128172;</span>
                            <span class="block text-xs font-bold text-text-primary">{{ __('Question arrives') }}</span>
                            <span class="text-[10px] text-text-tertiary">{{ __('Via AI Chat, email, or form') }}</span>
                        </div>
                        <div class="stagger-item rounded-xl border border-border-light bg-surface-secondary p-5 text-center">
                            <span class="mb-2 block text-xs font-bold text-emerald-600" style="font-family: 'JetBrains Mono', monospace;">02</span>
                            <span class="mb-2 block text-xl">&#129302;</span>
                            <span class="block text-xs font-bold text-text-primary">{{ __('AI Chat responds') }}</span>
                            <span class="text-[10px] text-text-tertiary">{{ __('Instant response, 24/7') }}</span>
                        </div>
                        <div class="stagger-item rounded-xl border border-border-light bg-surface-secondary p-5 text-center">
                            <span class="mb-2 block text-xs font-bold text-violet-600" style="font-family: 'JetBrains Mono', monospace;">03</span>
                            <span class="mb-2 block text-xl">&#10067;</span>
                            <span class="block text-xs font-bold text-text-primary">{{ __('Resolved?') }}</span>
                            <span class="text-[10px] text-text-tertiary">{{ __('If not — automatic ticket') }}</span>
                        </div>
                        <div class="stagger-item rounded-xl border border-border-light bg-surface-secondary p-5 text-center">
                            <span class="mb-2 block text-xs font-bold text-blue-600" style="font-family: 'JetBrains Mono', monospace;">04</span>
                            <span class="mb-2 block text-xl">&#128104;&#8205;&#128187;</span>
                            <span class="block text-xs font-bold text-text-primary">{{ __('Team takes over') }}</span>
                            <span class="text-[10px] text-text-tertiary">{{ __('Mon–Fri 8–16h, with context') }}</span>
                        </div>
                        <div class="stagger-item rounded-xl border border-border-light bg-surface-secondary p-5 text-center">
                            <span class="mb-2 block text-xs font-bold text-amber-600" style="font-family: 'JetBrains Mono', monospace;">05</span>
                            <span class="mb-2 block text-xl">&#9989;</span>
                            <span class="block text-xs font-bold text-text-primary">{{ __('Solution') }}</span>
                            <span class="text-[10px] text-text-tertiary">{{ __('Notification, feedback') }}</span>
                        </div>
                    </div>

                    {{-- Note --}}
                    <div class="rounded-xl border border-emerald-100 bg-emerald-50/50 p-4">
                        <p class="flex items-start gap-2.5 text-sm text-text-secondary">
                            <span class="mt-0.5 flex-shrink-0">&#128161;</span>
                            {{ __('Important: when the human team takes over the ticket, they see the full AI Chat history — so the customer doesn\'t have to re-explain the problem. The AI context is automatically transferred.') }}
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
                <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-emerald-600">{{ __('Contact options') }}</p>
                <h2 class="mb-4 text-3xl text-text-primary md:text-4xl" style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                    {{ __('Three channels — choose what\'s convenient') }}
                </h2>
            </div>

            <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3" data-stagger>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-8 text-center" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="icon-hover mb-4 text-3xl">&#129302;</div>
                    <h3 class="mb-2 text-lg font-bold text-text-primary">AI Chat</h3>
                    <span class="mb-4 block text-sm font-semibold text-emerald-600">{{ __('24/7 · Day and night') }}</span>
                    <p class="mb-5 text-sm text-text-secondary">{{ __('Ask anything about the system — instant answer, built on Cégem360 data. Available in the system and on the customer portal.') }}</p>
                    <span class="inline-flex items-center gap-2 rounded-lg border border-border-light bg-surface-secondary px-4 py-2.5 text-sm font-semibold text-text-primary">
                        {{ __('Inside the system, bottom right corner') }}
                    </span>
                </div>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-8 text-center" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="icon-hover mb-4 text-3xl">&#128231;</div>
                    <h3 class="mb-2 text-lg font-bold text-text-primary">{{ __('Email') }}</h3>
                    <span class="mb-4 block text-sm font-semibold text-blue-600">{{ __('Monday – Friday · 8:00 – 16:00') }}</span>
                    <p class="mb-5 text-sm text-text-secondary">{{ __('Write to our support team — detailed description, screenshot attachment possible. Response time: within 4 hours.') }}</p>
                    <span class="inline-flex items-center gap-2 rounded-lg border border-border-light bg-surface-secondary px-4 py-2.5 text-sm font-semibold text-text-primary" style="font-family: 'JetBrains Mono', monospace;">
                        support@cegem360.eu
                    </span>
                </div>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-8 text-center" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="icon-hover mb-4 text-3xl">&#128203;</div>
                    <h3 class="mb-2 text-lg font-bold text-text-primary">{{ __('Bug report form') }}</h3>
                    <span class="mb-4 block text-sm font-semibold text-blue-600">{{ __('Monday – Friday · 8:00 – 16:00') }}</span>
                    <p class="mb-5 text-sm text-text-secondary">{{ __('Structured bug report: module, priority, steps, screenshot. The fastest path to the team for complex problems.') }}</p>
                    <a href="{{ route('hibabejelentes') }}" class="inline-flex items-center gap-2 rounded-lg border border-emerald-200 bg-emerald-50 px-4 py-2.5 text-sm font-semibold text-emerald-600 transition-all hover:bg-emerald-100">
                        {{ __('Open bug report form') }} <svg class="arrow-slide h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" /></svg>
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{-- AI Chat Capabilities Section (6 cards) --}}
    <section class="bg-surface-primary py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-6">
            <div class="reveal mb-12">
                <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-emerald-600">{{ __('AI Chat capabilities') }}</p>
                <h2 class="mb-4 text-3xl text-text-primary md:text-4xl" style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                    {{ __('Not a generic chatbot — it knows the system') }}
                </h2>
                <p class="max-w-xl text-lg text-text-secondary">
                    {{ __('AI Chat is built on Cégem360 system data and modules. It doesn\'t rely on "hallucination" — it answers from validated data.') }}
                </p>
            </div>

            <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3" data-stagger>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-7" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="icon-hover mb-5 flex h-12 w-12 items-center justify-center rounded-xl bg-emerald-50 text-xl">&#128269;</div>
                    <h3 class="mb-2 text-base font-bold text-text-primary">{{ __('Status queries') }}</h3>
                    <p class="text-sm leading-relaxed text-text-secondary">{{ __('Service ticket status, order status, invoice payment status, warranty expiration — the customer or staff member gets real-time data from the system.') }}</p>
                </div>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-7" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="icon-hover mb-5 flex h-12 w-12 items-center justify-center rounded-xl bg-violet-50 text-xl">&#128214;</div>
                    <h3 class="mb-2 text-base font-bold text-text-primary">{{ __('Usage guide') }}</h3>
                    <p class="text-sm leading-relaxed text-text-secondary">{{ __('"How do I create a new quote?" — AI Chat walks the user through step by step, based on the current interface, with screenshot references.') }}</p>
                </div>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-7" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="icon-hover mb-5 flex h-12 w-12 items-center justify-center rounded-xl bg-cyan-50 text-xl">&#128295;</div>
                    <h3 class="mb-2 text-base font-bold text-text-primary">{{ __('Troubleshooting') }}</h3>
                    <p class="text-sm leading-relaxed text-text-secondary">{{ __('Common error recognition: "Access denied" — permission suggestion. "Module not showing" — settings guide. "System is slow" — browser tips.') }}</p>
                </div>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-7" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="icon-hover mb-5 flex h-12 w-12 items-center justify-center rounded-xl bg-amber-50 text-xl">&#129779;</div>
                    <h3 class="mb-2 text-base font-bold text-text-primary">{{ __('Automatic ticket creation') }}</h3>
                    <p class="text-sm leading-relaxed text-text-secondary">{{ __('If AI can\'t solve a problem — it automatically opens a support ticket for the team, with the full conversation context, so the customer doesn\'t have to re-explain.') }}</p>
                </div>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-7" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="icon-hover mb-5 flex h-12 w-12 items-center justify-center rounded-xl bg-blue-50 text-xl">&#128260;</div>
                    <h3 class="mb-2 text-base font-bold text-text-primary">{{ __('Live handoff') }}</h3>
                    <p class="text-sm leading-relaxed text-text-secondary">{{ __('During business hours, AI can hand off the conversation to a live operator — the colleague sees the history and continues exactly where AI left off.') }}</p>
                </div>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-7" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="icon-hover mb-5 flex h-12 w-12 items-center justify-center rounded-xl bg-rose-50 text-xl">&#127469;&#127482;</div>
                    <h3 class="mb-2 text-base font-bold text-text-primary">{{ __('Hungarian language') }}</h3>
                    <p class="text-sm leading-relaxed text-text-secondary">{{ __('Communicates in natural Hungarian, understands industry terminology, module names, and Hungarian business terminology — no need to ask in English.') }}</p>
                </div>
            </div>
        </div>
    </section>

    {{-- AI Chat Examples Section (4 cards) --}}
    <section class="bg-surface-secondary py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-6">
            <div class="reveal mb-12">
                <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-emerald-600">{{ __('Example conversations') }}</p>
                <h2 class="mb-4 text-3xl text-text-primary md:text-4xl" style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                    {{ __('AI Chat answers questions like these — instantly') }}
                </h2>
            </div>

            <div class="grid grid-cols-1 gap-4 md:grid-cols-2" data-stagger>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-6" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <p class="mb-3 flex items-center gap-2 text-sm font-semibold text-emerald-600">
                        <span class="text-xs">&#129300;</span> {{ __('What\'s the status of my service ticket SZ-2026-0142?') }}
                    </p>
                    <div class="rounded-lg border border-emerald-100 bg-emerald-50/50 p-3">
                        <span class="mb-1 block text-[10px] font-bold text-emerald-600">&#129302; AI Chat</span>
                        <p class="text-xs leading-relaxed text-text-secondary">{{ __('Ticket SZ-2026-0142 status: "Technician dispatched". Peter Novak will arrive on-site today at 14:00. The part (compressor valve) is in stock. Expected closure: today 17:00.') }}</p>
                        <span class="mt-2 block text-[10px] text-text-tertiary">{{ __('Source: CRM + Work order · response time: 1.2 sec') }}</span>
                    </div>
                </div>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-6" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <p class="mb-3 flex items-center gap-2 text-sm font-semibold text-emerald-600">
                        <span class="text-xs">&#129300;</span> {{ __('How can I create a new quote in CRM?') }}
                    </p>
                    <div class="rounded-lg border border-emerald-100 bg-emerald-50/50 p-3">
                        <span class="mb-1 block text-[10px] font-bold text-emerald-600">&#129302; AI Chat</span>
                        <p class="text-xs leading-relaxed text-text-secondary">{{ __('To create a new quote: 1) Open the CRM module → 2) Click "New quote" → 3) Select the customer → 4) Enter the items → 5) Click "Save". The quote can also be automatically exported to PDF.') }}</p>
                        <span class="mt-2 block text-[10px] text-text-tertiary">{{ __('Source: Usage guide · response time: 0.8 sec') }}</span>
                    </div>
                </div>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-6" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <p class="mb-3 flex items-center gap-2 text-sm font-semibold text-emerald-600">
                        <span class="text-xs">&#129300;</span> {{ __('I can\'t log in — I\'m getting an "Access denied" error.') }}
                    </p>
                    <div class="rounded-lg border border-emerald-100 bg-emerald-50/50 p-3">
                        <span class="mb-1 block text-[10px] font-bold text-emerald-600">&#129302; AI Chat</span>
                        <p class="text-xs leading-relaxed text-text-secondary">{{ __('I checked your account. The "Work order" module access is tied to the "Service technician" role, but your account has the "Sales" role. Ask the system administrator for a role expansion, or write to support@cegem360.eu.') }}</p>
                        <span class="mt-2 block text-[10px] text-text-tertiary">{{ __('Source: Permission system · response time: 1.5 sec') }}</span>
                    </div>
                </div>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-6" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <p class="mb-3 flex items-center gap-2 text-sm font-semibold text-emerald-600">
                        <span class="text-xs">&#129300;</span> {{ __('When does my warranty expire for the 2024 maintenance contract?') }}
                    </p>
                    <div class="rounded-lg border border-emerald-100 bg-emerald-50/50 p-3">
                        <span class="mb-1 block text-[10px] font-bold text-emerald-600">&#129302; AI Chat</span>
                        <p class="text-xs leading-relaxed text-text-secondary">{{ __('The MAINT-2024-0087 maintenance contract warranty expires on April 15, 2026. That\'s 62 days from now. Suggestion: contact your sales rep for renewal, or use the automatic renewal request button.') }}</p>
                        <span class="mt-2 block text-[10px] text-text-tertiary">{{ __('Source: CRM + Sales · response time: 1.1 sec') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- SLA Section (2 cards) --}}
    <section class="bg-surface-primary py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-6">
            <div class="reveal mb-12">
                <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-emerald-600">{{ __('Response times') }}</p>
                <h2 class="mb-4 text-3xl text-text-primary md:text-4xl" style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                    {{ __('What to expect — by channel') }}
                </h2>
            </div>

            <div class="grid grid-cols-1 gap-5 lg:grid-cols-2" data-stagger>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-7" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <h3 class="mb-5 flex items-center gap-2 text-base font-bold text-text-primary">&#129302; {{ __('AI Chat response times') }}</h3>
                    <div class="space-y-2">
                        <div class="flex items-center justify-between rounded-lg bg-surface-secondary px-4 py-3">
                            <span class="text-sm text-text-secondary">{{ __('Status query (service ticket, invoice)') }}</span>
                            <span class="text-sm font-bold text-emerald-600" style="font-family: 'JetBrains Mono', monospace;">&lt; 2 {{ __('sec') }}</span>
                        </div>
                        <div class="flex items-center justify-between rounded-lg bg-surface-secondary px-4 py-3">
                            <span class="text-sm text-text-secondary">{{ __('Usage guide') }}</span>
                            <span class="text-sm font-bold text-emerald-600" style="font-family: 'JetBrains Mono', monospace;">&lt; 3 {{ __('sec') }}</span>
                        </div>
                        <div class="flex items-center justify-between rounded-lg bg-surface-secondary px-4 py-3">
                            <span class="text-sm text-text-secondary">{{ __('Troubleshooting suggestion') }}</span>
                            <span class="text-sm font-bold text-emerald-600" style="font-family: 'JetBrains Mono', monospace;">&lt; 5 {{ __('sec') }}</span>
                        </div>
                        <div class="flex items-center justify-between rounded-lg bg-surface-secondary px-4 py-3">
                            <span class="text-sm text-text-secondary">{{ __('Automatic ticket if it can\'t help') }}</span>
                            <span class="text-sm font-bold text-emerald-600" style="font-family: 'JetBrains Mono', monospace;">{{ __('Instant') }}</span>
                        </div>
                        <div class="flex items-center justify-between rounded-lg bg-surface-secondary px-4 py-3">
                            <span class="text-sm text-text-secondary">{{ __('Availability') }}</span>
                            <span class="text-sm font-bold text-emerald-600" style="font-family: 'JetBrains Mono', monospace;">24/7</span>
                        </div>
                    </div>
                </div>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-7" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <h3 class="mb-5 flex items-center gap-2 text-base font-bold text-text-primary">&#128104;&#8205;&#128187; {{ __('Human support response times') }}</h3>
                    <div class="space-y-2">
                        <div class="flex items-center justify-between rounded-lg bg-surface-secondary px-4 py-3">
                            <span class="text-sm text-text-secondary">{{ __('Critical issue (system unavailable)') }}</span>
                            <span class="text-sm font-bold text-emerald-600" style="font-family: 'JetBrains Mono', monospace;">&lt; {{ __('1 hour') }}</span>
                        </div>
                        <div class="flex items-center justify-between rounded-lg bg-surface-secondary px-4 py-3">
                            <span class="text-sm text-text-secondary">{{ __('High priority (feature not working)') }}</span>
                            <span class="text-sm font-bold text-amber-600" style="font-family: 'JetBrains Mono', monospace;">&lt; {{ __('4 hours') }}</span>
                        </div>
                        <div class="flex items-center justify-between rounded-lg bg-surface-secondary px-4 py-3">
                            <span class="text-sm text-text-secondary">{{ __('Normal (configuration question, request)') }}</span>
                            <span class="text-sm font-bold text-blue-600" style="font-family: 'JetBrains Mono', monospace;">&lt; {{ __('8 hours') }}</span>
                        </div>
                        <div class="flex items-center justify-between rounded-lg bg-surface-secondary px-4 py-3">
                            <span class="text-sm text-text-secondary">{{ __('Low (development suggestion, wish)') }}</span>
                            <span class="text-sm font-bold text-blue-600" style="font-family: 'JetBrains Mono', monospace;">&lt; {{ __('24 hours') }}</span>
                        </div>
                        <div class="flex items-center justify-between rounded-lg bg-surface-secondary px-4 py-3">
                            <span class="text-sm text-text-secondary">{{ __('Availability') }}</span>
                            <span class="text-sm font-bold text-blue-600" style="font-family: 'JetBrains Mono', monospace;">{{ __('Mon–Fri 8–16h') }}</span>
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
                <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-emerald-600">{{ __('Results') }}</p>
                <h2 class="text-3xl text-text-primary md:text-4xl" style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                    {{ __('Measurable support performance') }}
                </h2>
            </div>

            <div class="grid grid-cols-2 gap-5 lg:grid-cols-4" data-stagger data-counter-trigger>
                <div class="stagger-item stat-hover rounded-2xl border border-border-light bg-surface-primary p-8 text-center" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <span class="stat-value block text-4xl font-bold text-emerald-600 lg:text-5xl" style="font-family: 'JetBrains Mono', monospace;"
                        data-count="24/7">0</span>
                    <span class="mt-2 block text-sm text-text-secondary">{{ __('AI Chat availability') }}</span>
                </div>
                <div class="stagger-item stat-hover rounded-2xl border border-border-light bg-surface-primary p-8 text-center" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <span class="stat-value block text-4xl font-bold text-blue-600 lg:text-5xl" style="font-family: 'JetBrains Mono', monospace;"
                        data-count="2" data-prefix="<" data-suffix="s">0</span>
                    <span class="mt-2 block text-sm text-text-secondary">{{ __('AI response time') }}</span>
                </div>
                <div class="stagger-item stat-hover rounded-2xl border border-border-light bg-surface-primary p-8 text-center" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <span class="stat-value block text-4xl font-bold text-violet-600 lg:text-5xl" style="font-family: 'JetBrains Mono', monospace;"
                        data-count="85" data-suffix="%">0</span>
                    <span class="mt-2 block text-sm text-text-secondary">{{ __('Questions resolved by AI') }}</span>
                </div>
                <div class="stagger-item stat-hover rounded-2xl border border-border-light bg-surface-primary p-8 text-center" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <span class="stat-value block text-4xl font-bold text-amber-600 lg:text-5xl" style="font-family: 'JetBrains Mono', monospace;"
                        data-count="4" data-prefix="<" data-suffix="h">0</span>
                    <span class="mt-2 block text-sm text-text-secondary">{{ __('Human response time (avg)') }}</span>
                </div>
            </div>
        </div>
    </section>

    {{-- Use Cases Section (6 cases) --}}
    <section class="bg-surface-primary py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-6">
            <div class="reveal mb-12">
                <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-emerald-600">{{ __('Use cases') }}</p>
                <h2 class="mb-4 text-3xl text-text-primary md:text-4xl" style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                    {{ __('How support works in practice') }}
                </h2>
            </div>

            <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3" data-stagger>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-7" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <span class="mb-4 block text-xs font-semibold text-text-tertiary" style="font-family: 'JetBrains Mono', monospace;">01</span>
                    <h3 class="mb-2 text-base font-bold text-text-primary">{{ __('Nighttime service ticket check') }}</h3>
                    <p class="mb-4 text-sm leading-relaxed text-text-secondary">{{ __('The customer wants to know at 11 PM if the service technician is coming tomorrow. AI Chat answers immediately: technician name, arrival time, required part status — without a live operator.') }}</p>
                    <div class="flex flex-wrap gap-1.5">
                        <span class="rounded bg-emerald-50 px-2 py-0.5 text-[10px] font-semibold text-emerald-600">AI Chat · 24/7</span>
                    </div>
                </div>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-7" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <span class="mb-4 block text-xs font-semibold text-text-tertiary" style="font-family: 'JetBrains Mono', monospace;">02</span>
                    <h3 class="mb-2 text-base font-bold text-text-primary">{{ __('Permission issue resolution') }}</h3>
                    <p class="mb-4 text-sm leading-relaxed text-text-secondary">{{ __('A colleague can\'t see a module. AI Chat recognizes the permission issue and makes a suggestion. If the customer can\'t resolve it themselves — a ticket opens automatically, the team takes over in the morning.') }}</p>
                    <div class="flex flex-wrap gap-1.5">
                        <span class="rounded bg-emerald-50 px-2 py-0.5 text-[10px] font-semibold text-emerald-600">AI Chat</span>
                        <span class="rounded bg-blue-50 px-2 py-0.5 text-[10px] font-semibold text-blue-600">{{ __('Team · 8–16h') }}</span>
                    </div>
                </div>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-7" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <span class="mb-4 block text-xs font-semibold text-text-tertiary" style="font-family: 'JetBrains Mono', monospace;">03</span>
                    <h3 class="mb-2 text-base font-bold text-text-primary">{{ __('Complex technical bug report') }}</h3>
                    <p class="mb-4 text-sm leading-relaxed text-text-secondary">{{ __('The system admin experiences a recurring bug in the manufacturing management module. They report via the bug form: module, steps, screenshot. The team starts investigating within 4 hours.') }}</p>
                    <div class="flex flex-wrap gap-1.5">
                        <span class="rounded bg-violet-50 px-2 py-0.5 text-[10px] font-semibold text-violet-600">{{ __('Bug report form') }}</span>
                        <span class="rounded bg-blue-50 px-2 py-0.5 text-[10px] font-semibold text-blue-600">{{ __('Team · 8–16h') }}</span>
                    </div>
                </div>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-7" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <span class="mb-4 block text-xs font-semibold text-text-tertiary" style="font-family: 'JetBrains Mono', monospace;">04</span>
                    <h3 class="mb-2 text-base font-bold text-text-primary">{{ __('New user training with AI assistance') }}</h3>
                    <p class="mb-4 text-sm leading-relaxed text-text-secondary">{{ __('The new colleague asks AI Chat step by step: "How do I create a work order?", "How do I attach a photo?" — AI walks them through, 24/7, as many times as needed.') }}</p>
                    <div class="flex flex-wrap gap-1.5">
                        <span class="rounded bg-emerald-50 px-2 py-0.5 text-[10px] font-semibold text-emerald-600">AI Chat · 24/7</span>
                    </div>
                </div>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-7" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <span class="mb-4 block text-xs font-semibold text-text-tertiary" style="font-family: 'JetBrains Mono', monospace;">05</span>
                    <h3 class="mb-2 text-base font-bold text-text-primary">{{ __('Email question for configuration help') }}</h3>
                    <p class="mb-4 text-sm leading-relaxed text-text-secondary">{{ __('The service manager writes to support@cegem360.eu: wants to set up a new automation rule. The team responds with details and helps with the configuration.') }}</p>
                    <div class="flex flex-wrap gap-1.5">
                        <span class="rounded bg-blue-50 px-2 py-0.5 text-[10px] font-semibold text-blue-600">{{ __('Email · 8–16h') }}</span>
                    </div>
                </div>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-7" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <span class="mb-4 block text-xs font-semibold text-text-tertiary" style="font-family: 'JetBrains Mono', monospace;">06</span>
                    <h3 class="mb-2 text-base font-bold text-text-primary">{{ __('Weekend warranty check') }}</h3>
                    <p class="mb-4 text-sm leading-relaxed text-text-secondary">{{ __('The customer wants to know on Saturday morning when their warranty expires. AI Chat answers immediately with the exact date and suggests renewal options — without human intervention.') }}</p>
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
                <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-emerald-600">{{ __('Market comparison') }}</p>
                <h2 class="mb-4 text-3xl text-text-primary md:text-4xl" style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                    {{ __('Support approaches in the industrial software market') }}
                </h2>
            </div>

            <div class="grid grid-cols-1 gap-6 lg:grid-cols-3" data-stagger>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-8" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="mb-5">
                        <span class="mb-1 block text-xs font-semibold uppercase tracking-wider text-text-tertiary">{{ __('Traditional helpdesk') }}</span>
                        <span class="block text-[11px] text-text-tertiary">{{ __('Email, phone, ticket system') }}</span>
                    </div>
                    <div class="mb-5 space-y-2">
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><svg class="h-4 w-4 text-success-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>{{ __('Human contact, empathy') }}</span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><svg class="h-4 w-4 text-success-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>{{ __('Complex problem handling') }}</span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><svg class="h-4 w-4 text-success-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>{{ __('Familiar process') }}</span>
                    </div>
                    <div class="space-y-2 border-t border-border-light pt-5">
                        <span class="flex items-center gap-2 text-sm text-text-tertiary"><svg class="h-4 w-4 text-danger-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>{{ __('Only available during business hours') }}</span>
                        <span class="flex items-center gap-2 text-sm text-text-tertiary"><svg class="h-4 w-4 text-danger-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>{{ __('Slow response time (24–48 hours)') }}</span>
                        <span class="flex items-center gap-2 text-sm text-text-tertiary"><svg class="h-4 w-4 text-danger-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>{{ __('Doesn\'t automatically know the context') }}</span>
                        <span class="flex items-center gap-2 text-sm text-text-tertiary"><svg class="h-4 w-4 text-danger-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>{{ __('Scaling issue: more customers = more staff') }}</span>
                    </div>
                </div>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-8" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="mb-5">
                        <span class="mb-1 block text-xs font-semibold uppercase tracking-wider text-text-tertiary">{{ __('Generic chatbots') }}</span>
                        <span class="block text-[11px] text-text-tertiary">Drift, Intercom, Zendesk Bot</span>
                    </div>
                    <div class="mb-5 space-y-2">
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><svg class="h-4 w-4 text-success-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>{{ __('24/7 availability') }}</span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><svg class="h-4 w-4 text-success-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>{{ __('Quick answers for simple questions') }}</span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><svg class="h-4 w-4 text-success-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>{{ __('Multi-language support') }}</span>
                    </div>
                    <div class="space-y-2 border-t border-border-light pt-5">
                        <span class="flex items-center gap-2 text-sm text-text-tertiary"><svg class="h-4 w-4 text-danger-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>{{ __('Doesn\'t know the system data') }}</span>
                        <span class="flex items-center gap-2 text-sm text-text-tertiary"><svg class="h-4 w-4 text-danger-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>{{ __('FAQ-based — doesn\'t understand context') }}</span>
                        <span class="flex items-center gap-2 text-sm text-text-tertiary"><svg class="h-4 w-4 text-danger-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>{{ __('Frustrating when it can\'t help') }}</span>
                        <span class="flex items-center gap-2 text-sm text-text-tertiary"><svg class="h-4 w-4 text-danger-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>{{ __('Needs separate integration with the system') }}</span>
                    </div>
                </div>
                <div class="stagger-item card-glow rounded-2xl border border-emerald-200 bg-emerald-50 p-8" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="mb-5">
                        <span class="mb-1 block text-xs font-semibold uppercase tracking-wider text-emerald-600">{{ __('Cégem360 Support') }}</span>
                        <span class="block text-[11px] text-text-tertiary">{{ __('AI Chat 24/7 + Human team 8–16h') }}</span>
                    </div>
                    <div class="space-y-2">
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><svg class="h-4 w-4 text-success-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>{{ __('AI Chat 24/7: built on system data') }}</span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><svg class="h-4 w-4 text-success-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>{{ __('Human team during business hours') }}</span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><svg class="h-4 w-4 text-success-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>{{ __('Automatic ticket + context handoff') }}</span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><svg class="h-4 w-4 text-success-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>{{ __('Hungarian language, industry terminology') }}</span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><svg class="h-4 w-4 text-success-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>{{ __('No integration needed — built-in') }}</span>
                        <span class="flex items-center gap-2 text-sm text-text-secondary"><svg class="h-4 w-4 text-success-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>{{ __('Bug report form for structured reporting') }}</span>
                    </div>
                    <div class="mt-5 rounded-lg bg-surface-primary p-3">
                        <p class="text-xs font-semibold text-emerald-700">{{ __('Recommended: for industrial companies who want 24/7 self-service support for simple questions + fast human help for serious problems.') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Detailed Comparison Table --}}
    <section class="bg-surface-primary py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-6">
            <div class="reveal mb-12">
                <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-emerald-600">{{ __('Detailed comparison') }}</p>
                <h2 class="mb-4 text-3xl text-text-primary md:text-4xl" style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                    {{ __('Support capability comparison') }}
                </h2>
            </div>

            <div class="reveal overflow-x-auto">
                <table class="w-full min-w-[700px] border-collapse overflow-hidden rounded-2xl border border-border-light">
                    <thead>
                        <tr class="bg-surface-primary">
                            <th class="px-5 py-4 text-left text-xs font-bold uppercase tracking-wider text-text-primary">{{ __('Capability') }}</th>
                            <th class="px-5 py-4 text-left text-xs font-bold uppercase tracking-wider text-text-tertiary">{{ __('Traditional helpdesk') }}</th>
                            <th class="px-5 py-4 text-left text-xs font-bold uppercase tracking-wider text-text-tertiary">{{ __('Generic chatbot') }}</th>
                            <th class="px-5 py-4 text-left text-xs font-bold uppercase tracking-wider text-emerald-600">Cégem360</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-border-light">
                        <tr>
                            <td class="px-5 py-4 text-sm font-semibold text-text-primary">{{ __('24/7 availability') }}</td>
                            <td class="px-5 py-4 text-sm text-text-tertiary">{{ __('✗ Business hours') }}</td>
                            <td class="px-5 py-4 text-sm font-medium text-success-600">{{ __('✓ Online') }}</td>
                            <td class="px-5 py-4 text-sm font-medium text-success-600">{{ __('✓ AI Chat 24/7') }}</td>
                        </tr>
                        <tr>
                            <td class="px-5 py-4 text-sm font-semibold text-text-primary">{{ __('System data-based response') }}</td>
                            <td class="px-5 py-4 text-sm text-amber-600">{{ __('◐ Manual search') }}</td>
                            <td class="px-5 py-4 text-sm text-text-tertiary">{{ __('✗ No') }}</td>
                            <td class="px-5 py-4 text-sm font-medium text-success-600">{{ __('✓ Native, real-time') }}</td>
                        </tr>
                        <tr>
                            <td class="px-5 py-4 text-sm font-semibold text-text-primary">{{ __('Human support for complex issues') }}</td>
                            <td class="px-5 py-4 text-sm font-medium text-success-600">{{ __('✓ Yes') }}</td>
                            <td class="px-5 py-4 text-sm text-text-tertiary">{{ __('✗ None') }}</td>
                            <td class="px-5 py-4 text-sm font-medium text-success-600">{{ __('✓ Mon–Fri 8–16h') }}</td>
                        </tr>
                        <tr>
                            <td class="px-5 py-4 text-sm font-semibold text-text-primary">{{ __('Context handoff AI → human') }}</td>
                            <td class="px-5 py-4 text-sm text-text-tertiary">{{ __('✗ Not relevant') }}</td>
                            <td class="px-5 py-4 text-sm text-amber-600">{{ __('◐ Limited') }}</td>
                            <td class="px-5 py-4 text-sm font-medium text-success-600">{{ __('✓ Automatic') }}</td>
                        </tr>
                        <tr>
                            <td class="px-5 py-4 text-sm font-semibold text-text-primary">{{ __('Automatic ticket creation') }}</td>
                            <td class="px-5 py-4 text-sm text-amber-600">{{ __('◐ Manual') }}</td>
                            <td class="px-5 py-4 text-sm text-amber-600">{{ __('◐ Basic') }}</td>
                            <td class="px-5 py-4 text-sm font-medium text-success-600">{{ __('✓ Automatic') }}</td>
                        </tr>
                        <tr>
                            <td class="px-5 py-4 text-sm font-semibold text-text-primary">{{ __('Bug report form (structured)') }}</td>
                            <td class="px-5 py-4 text-sm text-amber-600">{{ __('◐ Generic form') }}</td>
                            <td class="px-5 py-4 text-sm text-text-tertiary">{{ __('✗ None') }}</td>
                            <td class="px-5 py-4 text-sm font-medium text-success-600">{{ __('✓ Module-specific') }}</td>
                        </tr>
                        <tr>
                            <td class="px-5 py-4 text-sm font-semibold text-text-primary">{{ __('Hungarian language and industry terminology') }}</td>
                            <td class="px-5 py-4 text-sm font-medium text-success-600">{{ __('✓ Human') }}</td>
                            <td class="px-5 py-4 text-sm text-amber-600">{{ __('◐ Machine translation') }}</td>
                            <td class="px-5 py-4 text-sm font-medium text-success-600">{{ __('✓ Native Hungarian') }}</td>
                        </tr>
                        <tr>
                            <td class="px-5 py-4 text-sm font-semibold text-text-primary">{{ __('Response time (simple question)') }}</td>
                            <td class="px-5 py-4 text-sm text-text-tertiary">{{ __('✗ 24–48h') }}</td>
                            <td class="px-5 py-4 text-sm font-medium text-success-600">{{ __('✓ < 5 sec') }}</td>
                            <td class="px-5 py-4 text-sm font-medium text-success-600">{{ __('✓ < 2 sec') }}</td>
                        </tr>
                        <tr>
                            <td class="px-5 py-4 text-sm font-semibold text-text-primary">{{ __('Response time (complex issue)') }}</td>
                            <td class="px-5 py-4 text-sm text-amber-600">{{ __('◐ 24–48h') }}</td>
                            <td class="px-5 py-4 text-sm text-text-tertiary">{{ __('✗ Can\'t help') }}</td>
                            <td class="px-5 py-4 text-sm font-medium text-success-600">{{ __('✓ < 4h') }}</td>
                        </tr>
                        <tr>
                            <td class="px-5 py-4 text-sm font-semibold text-text-primary">{{ __('Built-in, no integration needed') }}</td>
                            <td class="px-5 py-4 text-sm text-text-tertiary">{{ __('✗ Separate system') }}</td>
                            <td class="px-5 py-4 text-sm text-text-tertiary">{{ __('✗ Separate system') }}</td>
                            <td class="px-5 py-4 text-sm font-medium text-success-600">{{ __('✓ Native') }}</td>
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
                        <h3 class="mb-3 text-xl font-bold text-text-primary lg:text-2xl" style="font-family: 'Poppins', sans-serif;">{{ __('Have a question? Get in touch!') }}</h3>
                        <p class="mb-5 text-base text-text-secondary">{{ __('If you have questions about the support system, AI Chat capabilities, or human customer service availability — book an online consultation or write to our support team.') }}</p>
                        <div class="flex flex-wrap gap-5">
                            <span class="flex items-center gap-1.5 text-sm text-text-tertiary"><svg class="h-4 w-4 text-success-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>{{ __('30 minute video call') }}</span>
                            <span class="flex items-center gap-1.5 text-sm text-text-tertiary"><svg class="h-4 w-4 text-success-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>{{ __('AI Chat demo') }}</span>
                            <span class="flex items-center gap-1.5 text-sm text-text-tertiary"><svg class="h-4 w-4 text-success-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>{{ __('No commitment') }}</span>
                        </div>
                    </div>
                    <a href="{{ route('contact') }}" class="group inline-flex items-center gap-2 rounded-full bg-emerald-600 px-6 py-3 text-base font-medium text-white transition-all hover:bg-emerald-700 hover:shadow-lg" style="box-shadow: 0 1px 2px rgba(0,0,0,0.05);">
                        <span>{{ __('Consultation') }}</span>
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
                <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-emerald-600">{{ __('Need help?') }}</p>
                <h2 class="mb-4 text-3xl text-text-primary md:text-4xl" style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                    {{ __('Choose the fastest path to the solution') }}
                </h2>
            </div>

            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2" data-stagger>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-8 text-center" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <h3 class="mb-3 text-xl font-bold text-text-primary">{{ __('Bug report') }}</h3>
                    <p class="mb-6 text-sm text-text-secondary">{{ __('Structured form for reporting technical issues: module, priority, steps, screenshot. Our team handles it during business hours.') }}</p>
                    <a href="{{ route('hibabejelentes') }}" class="group inline-flex items-center gap-2 rounded-full bg-emerald-600 px-6 py-3 text-sm font-medium text-white transition-all hover:bg-emerald-700 hover:shadow-lg" style="box-shadow: 0 1px 2px rgba(0,0,0,0.05);">
                        {{ __('Open bug report form') }} <svg class="arrow-slide h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" /></svg>
                    </a>
                </div>
                <div class="stagger-item card-glow rounded-2xl border border-emerald-100 bg-emerald-50 p-8 text-center" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <h3 class="mb-3 text-xl font-bold text-text-primary">{{ __('Register and try it') }}</h3>
                    <p class="mb-6 text-sm text-text-secondary">{{ __('Explore Cégem360, AI Chat, and the full support system — available immediately after registration.') }}</p>
                    <a href="{{ route('register') }}" class="inline-flex items-center gap-2 rounded-full border border-border-light bg-surface-primary px-6 py-3 text-sm font-medium text-text-primary transition-all hover:border-emerald-200 hover:shadow-md">
                        {{ __('Registration') }} <svg class="arrow-slide h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" /></svg>
                    </a>
                </div>
            </div>
        </div>
    </section>
</div>
