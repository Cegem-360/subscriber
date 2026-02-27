<div x-data="{
    priority: 'normal',
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
            0% { box-shadow: 0 0 0 0 rgba(0, 202, 114, 0.4); }
            70% { box-shadow: 0 0 0 6px rgba(0, 202, 114, 0); }
            100% { box-shadow: 0 0 0 0 rgba(0, 202, 114, 0); }
        }
        .pulse-dot { animation: pulse-ring 2s ease infinite; }

        .card-glow { transition: all 0.4s cubic-bezier(0,0,0.2,1); }
        .card-glow:hover { box-shadow: 0 8px 30px -8px rgba(251, 39, 93, 0.12), 0 2px 8px rgba(0,0,0,0.04) !important; }

        .icon-hover { transition: transform 0.35s cubic-bezier(0,0,0.2,1.4); }
        .group:hover .icon-hover, .card-glow:hover .icon-hover { transform: translateY(-3px) scale(1.08); }

        .arrow-slide { transition: transform 0.3s cubic-bezier(0,0,0.2,1); }
        .group:hover .arrow-slide, a:hover .arrow-slide { transform: translateX(4px); }

        .stat-hover .stat-value { transition: transform 0.4s cubic-bezier(0,0,0.2,1.4); }
        .stat-hover:hover .stat-value { transform: scale(1.08); }

        html { scroll-behavior: smooth; }
    </style>

    {{-- Hero Section --}}
    <section class="bg-linear-to-b from-danger-50 to-surface-secondary">
        <div class="mx-auto max-w-7xl px-6 py-16 lg:py-24">
            <div class="reveal mx-auto max-w-3xl text-center">
                <div class="badge-gradient mb-8 inline-flex items-center gap-2 rounded-full border border-border-light/80 bg-surface-primary px-4 py-1.5"
                    style="box-shadow: 0 1px 3px rgba(0,0,0,0.04);">
                    <span class="pulse-dot h-1.5 w-1.5 rounded-full bg-linear-to-r from-danger-500 via-danger-400 to-danger-300"></span>
                    <span class="text-sm font-medium text-text-primary">{{ __('Bug Report') }}</span>
                </div>

                <h1 class="mb-6 text-4xl leading-tight tracking-tight text-text-primary md:text-5xl lg:text-[3.5rem]"
                    style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                    {{ __('Report a technical issue') }}<br>
                    {{ __('to the Cégem360 team') }}
                </h1>

                <p class="mx-auto mb-10 max-w-2xl text-lg text-text-secondary lg:text-xl">
                    {{ __('Fill out the form below with the details of the issue — the more precise the description, the faster we can help. Our team handles reports Monday–Friday 8:00–16:00.') }}
                </p>

                <div class="flex flex-wrap items-center justify-center gap-6">
                    <div class="flex items-center gap-2">
                        <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-success-50 text-sm">&#9201;</span>
                        <span class="text-sm text-text-secondary"><strong class="text-text-primary">{{ __('1–8 hours') }}</strong> {{ __('response time') }}</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-primary-50 text-sm">&#128197;</span>
                        <span class="text-sm text-text-secondary"><strong class="text-text-primary">{{ __('Mon–Fri 8–16h') }}</strong> {{ __('handling') }}</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-warning-50 text-sm">&#128231;</span>
                        <span class="text-sm text-text-secondary"><strong class="text-text-primary">{{ __('Email notification') }}</strong> {{ __('about the status') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Form + Sidebar Section --}}
    <section class="bg-surface-secondary py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-6">
            <div class="grid grid-cols-1 items-start gap-8 lg:grid-cols-[1fr_360px]">

                {{-- Form --}}
                <div class="reveal rounded-2xl border border-border-light bg-surface-primary p-8 lg:p-10" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <h2 class="mb-1 text-xl font-bold text-text-primary" style="font-family: 'Poppins', sans-serif;">{{ __('Bug report form') }}</h2>
                    <p class="mb-8 text-sm text-text-tertiary">{{ __('Fields marked with * are required.') }}</p>

                    <form id="bugForm">

                        {{-- Bejelento adatai --}}
                        <p class="mb-5 text-xs font-bold uppercase tracking-widest text-danger-600">{{ __('Reporter details') }}</p>

                        <div class="mb-5 grid grid-cols-1 gap-5 sm:grid-cols-2">
                            <div>
                                <label for="name" class="mb-2 block text-sm font-semibold text-text-primary">{{ __('Name') }} <span class="text-danger-500">*</span></label>
                                <input type="text" id="name" name="name" class="input" placeholder="{{ __('Full name') }}" required>
                            </div>
                            <div>
                                <label for="email" class="mb-2 block text-sm font-semibold text-text-primary">{{ __('Email address') }} <span class="text-danger-500">*</span></label>
                                <input type="email" id="email" name="email" class="input" placeholder="{{ __('name@company.com') }}" required>
                            </div>
                        </div>

                        <div class="mb-5 grid grid-cols-1 gap-5 sm:grid-cols-2">
                            <div>
                                <label for="company" class="mb-2 block text-sm font-semibold text-text-primary">{{ __('Company name') }} <span class="text-danger-500">*</span></label>
                                <input type="text" id="company" name="company" class="input" placeholder="{{ __('Company name') }}" required>
                            </div>
                            <div>
                                <label for="phone" class="mb-2 block text-sm font-semibold text-text-primary">{{ __('Phone number') }}</label>
                                <input type="tel" id="phone" name="phone" class="input" placeholder="+36 ...">
                                <span class="mt-1 block text-xs text-text-tertiary">{{ __('Optional — if you request an urgent callback') }}</span>
                            </div>
                        </div>

                        <div class="my-8 h-px bg-border-light"></div>

                        {{-- Hiba reszletei --}}
                        <p class="mb-5 text-xs font-bold uppercase tracking-widest text-danger-600">{{ __('Issue details') }}</p>

                        <div class="mb-5 grid grid-cols-1 gap-5 sm:grid-cols-2">
                            <div>
                                <label for="module" class="mb-2 block text-sm font-semibold text-text-primary">{{ __('Affected module') }} <span class="text-danger-500">*</span></label>
                                <select id="module" name="module" class="input" required>
                                    <option value="" disabled selected>{{ __('Select a module…') }}</option>
                                    <option value="crm">{{ __('CRM & Customer Management') }}</option>
                                    <option value="ertekesites">{{ __('Sales') }}</option>
                                    <option value="gyartasiranyitas">{{ __('Manufacturing management') }}</option>
                                    <option value="beszerzes">{{ __('Procurement & Logistics') }}</option>
                                    <option value="munkalap">{{ __('Digital work order') }}</option>
                                    <option value="kontrolling">{{ __('Controlling') }}</option>
                                    <option value="automatizalas">{{ __('Automation') }}</option>
                                    <option value="datamind">DataMind ({{ __('AI') }})</option>
                                    <option value="marketinghub">MarketingHub</option>
                                    <option value="seo">{{ __('SEO module') }}</option>
                                    <option value="aichat">AI Chat</option>
                                    <option value="dokumentumok">{{ __('Documents') }}</option>
                                    <option value="iranyitopult">{{ __('Dashboards') }}</option>
                                    <option value="ugyfelportal">{{ __('Customer portal') }}</option>
                                    <option value="bejelentkezes">{{ __('Login / Account') }}</option>
                                    <option value="egyeb">{{ __('Other / I don\'t know') }}</option>
                                </select>
                            </div>
                            <div>
                                <label for="issue-type" class="mb-2 block text-sm font-semibold text-text-primary">{{ __('Issue type') }} <span class="text-danger-500">*</span></label>
                                <select id="issue-type" name="issue_type" class="input" required>
                                    <option value="" disabled selected>{{ __('Select a type…') }}</option>
                                    <option value="nem-mukodik">{{ __('Feature not working') }}</option>
                                    <option value="hibauzenet">{{ __('Error message appears') }}</option>
                                    <option value="lassu">{{ __('Slow performance') }}</option>
                                    <option value="nem-jelenik-meg">{{ __('Data not displaying') }}</option>
                                    <option value="rossz-adat">{{ __('Incorrect data / calculation') }}</option>
                                    <option value="jogosultsag">{{ __('Permission issue') }}</option>
                                    <option value="integracio">{{ __('Integration error') }}</option>
                                    <option value="dokumentum">{{ __('Document generation error') }}</option>
                                    <option value="egyeb-hiba">{{ __('Other') }}</option>
                                </select>
                            </div>
                        </div>

                        <div class="mb-5">
                            <label for="subject" class="mb-2 block text-sm font-semibold text-text-primary">{{ __('Brief summary') }} <span class="text-danger-500">*</span></label>
                            <input type="text" id="subject" name="subject" class="input" placeholder="{{ __('E.g.: CRM quote PDF export shows error message') }}" required>
                            <span class="mt-1 block text-xs text-text-tertiary">{{ __('One sentence that summarizes the problem') }}</span>
                        </div>

                        <div class="mb-5">
                            <label for="description" class="mb-2 block text-sm font-semibold text-text-primary">{{ __('Detailed description') }} <span class="text-danger-500">*</span></label>
                            <textarea id="description" name="description" class="input" rows="6" placeholder="{{ __("Please describe in detail:\n\n1. What were you doing when the error occurred?\n2. What error message did you receive (if any)?\n3. Does the error repeat or is it one-time?\n4. How long have you been experiencing this?") }}" required style="resize: vertical; min-height: 140px;"></textarea>
                            <span class="mt-1 block text-xs text-text-tertiary">{{ __('The more detailed, the faster we can help') }}</span>
                        </div>

                        <div class="mb-5 grid grid-cols-1 gap-5 sm:grid-cols-2">
                            <div>
                                <label for="url" class="mb-2 block text-sm font-semibold text-text-primary">{{ __('Affected page URL') }}</label>
                                <input type="url" id="url" name="url" class="input" placeholder="https://cegem360.eu/admin/...">
                                <span class="mt-1 block text-xs text-text-tertiary">{{ __('Copy it from your browser\'s address bar') }}</span>
                            </div>
                            <div>
                                <label for="browser" class="mb-2 block text-sm font-semibold text-text-primary">{{ __('Browser and device') }}</label>
                                <select id="browser" name="browser" class="input">
                                    <option value="" disabled selected>{{ __('Select…') }}</option>
                                    <option value="chrome-desktop">{{ __('Chrome — Desktop') }}</option>
                                    <option value="chrome-mobile">{{ __('Chrome — Mobile') }}</option>
                                    <option value="firefox-desktop">{{ __('Firefox — Desktop') }}</option>
                                    <option value="safari-desktop">{{ __('Safari — Desktop') }}</option>
                                    <option value="safari-mobile">{{ __('Safari — Mobile (iPhone/iPad)') }}</option>
                                    <option value="edge-desktop">{{ __('Edge — Desktop') }}</option>
                                    <option value="egyeb-bongeszo">{{ __('Other') }}</option>
                                </select>
                            </div>
                        </div>

                        <div class="my-8 h-px bg-border-light"></div>

                        {{-- Prioritas --}}
                        <p class="mb-5 text-xs font-bold uppercase tracking-widest text-danger-600">{{ __('Priority') }} <span class="text-danger-500">*</span></p>

                        <div class="mb-5 grid grid-cols-2 gap-3 sm:grid-cols-4">
                            <label class="cursor-pointer rounded-xl border p-4 text-center transition-all"
                                :class="priority === 'critical' ? 'border-danger-400 bg-danger-50' : 'border-border-light bg-surface-secondary hover:border-border-default'"
                                @click="priority = 'critical'">
                                <input type="radio" name="priority" value="critical" class="hidden" x-model="priority">
                                <span class="mb-1 block text-lg">&#128308;</span>
                                <span class="block text-xs font-bold text-text-primary">{{ __('Critical') }}</span>
                                <span class="block text-[10px] text-text-tertiary">{{ __('System unavailable') }}</span>
                            </label>
                            <label class="cursor-pointer rounded-xl border p-4 text-center transition-all"
                                :class="priority === 'high' ? 'border-orange-400 bg-orange-50' : 'border-border-light bg-surface-secondary hover:border-border-default'"
                                @click="priority = 'high'">
                                <input type="radio" name="priority" value="high" class="hidden" x-model="priority">
                                <span class="mb-1 block text-lg">&#128992;</span>
                                <span class="block text-xs font-bold text-text-primary">{{ __('High') }}</span>
                                <span class="block text-[10px] text-text-tertiary">{{ __('Feature not working') }}</span>
                            </label>
                            <label class="cursor-pointer rounded-xl border p-4 text-center transition-all"
                                :class="priority === 'normal' ? 'border-warning-400 bg-warning-50' : 'border-border-light bg-surface-secondary hover:border-border-default'"
                                @click="priority = 'normal'">
                                <input type="radio" name="priority" value="normal" class="hidden" x-model="priority">
                                <span class="mb-1 block text-lg">&#128993;</span>
                                <span class="block text-xs font-bold text-text-primary">{{ __('Normal') }}</span>
                                <span class="block text-[10px] text-text-tertiary">{{ __('Annoying, but has a workaround') }}</span>
                            </label>
                            <label class="cursor-pointer rounded-xl border p-4 text-center transition-all"
                                :class="priority === 'low' ? 'border-blue-400 bg-blue-50' : 'border-border-light bg-surface-secondary hover:border-border-default'"
                                @click="priority = 'low'">
                                <input type="radio" name="priority" value="low" class="hidden" x-model="priority">
                                <span class="mb-1 block text-lg">&#128309;</span>
                                <span class="block text-xs font-bold text-text-primary">{{ __('Low') }}</span>
                                <span class="block text-[10px] text-text-tertiary">{{ __('Cosmetic / suggestion') }}</span>
                            </label>
                        </div>

                        <div class="my-8 h-px bg-border-light"></div>

                        {{-- Kepernykep / csatolmany --}}
                        <p class="mb-5 text-xs font-bold uppercase tracking-widest text-danger-600">{{ __('Screenshot / attachment') }}</p>

                        <div class="mb-5">
                            <label for="attachment" class="relative flex cursor-pointer flex-col items-center rounded-xl border-2 border-dashed border-border-light bg-surface-secondary p-8 text-center transition-all hover:border-border-default hover:bg-surface-tertiary">
                                <input type="file" id="attachment" name="attachment" accept="image/*,.pdf,.zip,.doc,.docx" multiple class="absolute inset-0 cursor-pointer opacity-0">
                                <span class="mb-2 block text-2xl">&#128206;</span>
                                <span class="block text-sm text-text-secondary">{{ __('Drag files here, or click to browse') }}</span>
                                <span class="mt-1 block text-xs text-text-tertiary">{{ __('Formats: PNG, JPG, PDF, ZIP, DOC · Max. 10 MB / file · Max. 5 files') }}</span>
                            </label>
                            <span class="mt-1 block text-xs text-text-tertiary">{{ __('Attaching screenshot(s) significantly speeds up troubleshooting') }}</span>
                        </div>

                        <div class="my-8 h-px bg-border-light"></div>

                        {{-- Hozzajarulas --}}
                        <div class="mb-4">
                            <label class="flex cursor-pointer items-start gap-3 rounded-xl border border-border-light bg-surface-secondary p-4 transition-all hover:border-border-default">
                                <input type="checkbox" name="consent" required class="mt-0.5 h-4 w-4 shrink-0 rounded border-border-default text-danger-500 focus:ring-danger-300">
                                <span class="text-sm text-text-secondary">{!! __('I consent to Cégem 360 Kft. using my provided data for handling this bug report, in accordance with the <a href=":url" target="_blank" class="font-semibold text-danger-600 hover:text-danger-700">Privacy Policy</a>.', ['url' => route('legal.adatvedelmi-tajekoztato')]) !!} <span class="text-danger-500">*</span></span>
                            </label>
                        </div>

                        <div class="mb-6">
                            <label class="flex cursor-pointer items-start gap-3 rounded-xl border border-border-light bg-surface-secondary p-4 transition-all hover:border-border-default">
                                <input type="checkbox" name="notify" checked class="mt-0.5 h-4 w-4 shrink-0 rounded border-border-default text-danger-500 focus:ring-danger-300">
                                <span class="text-sm text-text-secondary">{{ __('Please send me email notifications about bug report status changes.') }}</span>
                            </label>
                        </div>

                        {{-- Submit --}}
                        <button type="submit" id="bugSubmitBtn"
                            class="group flex w-full items-center justify-center gap-2 rounded-xl bg-danger-600 px-6 py-4 text-base font-bold text-white transition-all hover:bg-danger-700 hover:shadow-lg"
                            style="box-shadow: 0 4px 24px rgba(251, 39, 93, 0.2);">
                            {{ __('Submit bug report') }}
                            <svg class="arrow-slide h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" /></svg>
                        </button>
                    </form>
                </div>

                {{-- Sidebar --}}
                <div class="reveal-right flex flex-col gap-5 lg:sticky lg:top-24">

                    {{-- System Status --}}
                    <div class="rounded-2xl border border-success-200 bg-success-50/50 p-5" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                        <div class="flex items-center gap-3">
                            <span class="pulse-dot h-2.5 w-2.5 shrink-0 rounded-full bg-success-500"></span>
                            <span class="text-sm text-text-secondary">{!! __('The Cégem360 system is <strong class="text-success-700">currently available</strong> and operating normally.') !!}</span>
                        </div>
                    </div>

                    {{-- SLA --}}
                    <div class="rounded-2xl border border-border-light bg-surface-primary p-6" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                        <h3 class="mb-4 flex items-center gap-2 text-base font-bold text-text-primary">
                            <span class="text-sm">&#9201;</span> {{ __('Response times by priority') }}
                        </h3>
                        <div class="space-y-2">
                            <div class="flex items-center justify-between rounded-lg bg-surface-secondary px-4 py-2.5">
                                <span class="flex items-center gap-2 text-sm text-text-secondary">
                                    <span class="h-1.5 w-1.5 rounded-full bg-danger-500"></span> {{ __('Critical') }}
                                </span>
                                <span class="text-sm font-bold text-text-primary" style="font-family: 'JetBrains Mono', monospace;">&lt; {{ __('1 hour') }}</span>
                            </div>
                            <div class="flex items-center justify-between rounded-lg bg-surface-secondary px-4 py-2.5">
                                <span class="flex items-center gap-2 text-sm text-text-secondary">
                                    <span class="h-1.5 w-1.5 rounded-full bg-orange-500"></span> {{ __('High') }}
                                </span>
                                <span class="text-sm font-bold text-text-primary" style="font-family: 'JetBrains Mono', monospace;">&lt; {{ __('4 hours') }}</span>
                            </div>
                            <div class="flex items-center justify-between rounded-lg bg-surface-secondary px-4 py-2.5">
                                <span class="flex items-center gap-2 text-sm text-text-secondary">
                                    <span class="h-1.5 w-1.5 rounded-full bg-warning-500"></span> {{ __('Normal') }}
                                </span>
                                <span class="text-sm font-bold text-text-primary" style="font-family: 'JetBrains Mono', monospace;">&lt; {{ __('8 hours') }}</span>
                            </div>
                            <div class="flex items-center justify-between rounded-lg bg-surface-secondary px-4 py-2.5">
                                <span class="flex items-center gap-2 text-sm text-text-secondary">
                                    <span class="h-1.5 w-1.5 rounded-full bg-blue-500"></span> {{ __('Low') }}
                                </span>
                                <span class="text-sm font-bold text-text-primary" style="font-family: 'JetBrains Mono', monospace;">&lt; {{ __('24 hours') }}</span>
                            </div>
                        </div>
                    </div>

                    {{-- Tips --}}
                    <div class="rounded-2xl border border-border-light bg-surface-primary p-6" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                        <h3 class="mb-4 flex items-center gap-2 text-base font-bold text-text-primary">
                            <span class="text-sm">&#128161;</span> {{ __('Tips for a faster resolution') }}
                        </h3>
                        <div class="space-y-3">
                            <p class="flex items-start gap-2.5 text-sm text-text-secondary">
                                <span class="mt-0.5 flex-shrink-0 text-xs">&#128161;</span>
                                {{ __('Attach a screenshot — visual information helps a lot.') }}
                            </p>
                            <p class="flex items-start gap-2.5 text-sm text-text-secondary">
                                <span class="mt-0.5 flex-shrink-0 text-xs">&#128161;</span>
                                {{ __('Copy the exact text of the error message into the description.') }}
                            </p>
                            <p class="flex items-start gap-2.5 text-sm text-text-secondary">
                                <span class="mt-0.5 flex-shrink-0 text-xs">&#128161;</span>
                                {{ __('Indicate whether the error repeats or is one-time.') }}
                            </p>
                            <p class="flex items-start gap-2.5 text-sm text-text-secondary">
                                <span class="mt-0.5 flex-shrink-0 text-xs">&#128161;</span>
                                {{ __('Specify the browser and device (desktop/mobile).') }}
                            </p>
                            <p class="flex items-start gap-2.5 text-sm text-text-secondary">
                                <span class="mt-0.5 flex-shrink-0 text-xs">&#128161;</span>
                                {{ __('If the error is related to a specific user, indicate the username.') }}
                            </p>
                        </div>
                    </div>

                    {{-- Other channels --}}
                    <div class="rounded-2xl border border-border-light bg-surface-primary p-6" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                        <h3 class="mb-4 flex items-center gap-2 text-base font-bold text-text-primary">
                            <span class="text-sm">&#128222;</span> {{ __('Other contact options') }}
                        </h3>
                        <div class="space-y-2.5">
                            <div class="flex items-center gap-3 rounded-lg border border-border-light bg-surface-secondary p-3 transition-all hover:border-border-default">
                                <span class="text-base">&#129302;</span>
                                <div>
                                    <span class="block text-sm font-bold text-text-primary">AI Chat</span>
                                    <span class="block text-[11px] text-text-tertiary">24/7 &middot; {{ __('Instant response in the system') }}</span>
                                </div>
                            </div>
                            <a href="mailto:support@cegem360.eu" class="flex items-center gap-3 rounded-lg border border-border-light bg-surface-secondary p-3 transition-all hover:border-border-default">
                                <span class="text-base">&#128231;</span>
                                <div>
                                    <span class="block text-sm font-bold text-text-primary">support@cegem360.eu</span>
                                    <span class="block text-[11px] text-text-tertiary">{{ __('Mon–Fri 8–16h') }} &middot; {{ __('Response < 4 hours') }}</span>
                                </div>
                            </a>
                            <a href="{{ route('tamogatas') }}" class="flex items-center gap-3 rounded-lg border border-border-light bg-surface-secondary p-3 transition-all hover:border-border-default">
                                <span class="text-base">&#128218;</span>
                                <div>
                                    <span class="block text-sm font-bold text-text-primary">{{ __('24/7 Support page') }}</span>
                                    <span class="block text-[11px] text-text-tertiary">{{ __('All contact options and AI Chat') }}</span>
                                </div>
                            </a>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </section>

    {{-- After Form: 3 Steps Section --}}
    <section class="bg-surface-primary py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-6">
            <div class="reveal mb-12 text-center">
                <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-danger-600">{{ __('What happens after the report?') }}</p>
                <h2 class="text-3xl text-text-primary md:text-4xl" style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                    {{ __('3 steps to the solution') }}
                </h2>
            </div>

            <div class="grid grid-cols-1 gap-6 sm:grid-cols-3" data-stagger>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-8 text-center" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="icon-hover mb-4 text-3xl">&#128232;</div>
                    <h3 class="mb-2 text-lg font-bold text-text-primary">{{ __('1. Instant confirmation') }}</h3>
                    <p class="text-sm leading-relaxed text-text-secondary">{{ __('After submitting the report, you\'ll receive an automatic email with the ticket number and expected response time. You can track the ticket anytime.') }}</p>
                </div>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-8 text-center" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="icon-hover mb-4 text-3xl">&#128269;</div>
                    <h3 class="mb-2 text-lg font-bold text-text-primary">{{ __('2. Investigation and diagnosis') }}</h3>
                    <p class="text-sm leading-relaxed text-text-secondary">{{ __('Our team investigates the issue, asks follow-up questions if needed, and begins the fix. Status can be tracked via email.') }}</p>
                </div>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-8 text-center" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="icon-hover mb-4 text-3xl">&#10004;</div>
                    <h3 class="mb-2 text-lg font-bold text-text-primary">{{ __('3. Resolution and closure') }}</h3>
                    <p class="text-sm leading-relaxed text-text-secondary">{{ __('We\'ll notify you about the solution — along with the fix description. We send a satisfaction survey and close the ticket.') }}</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Footer CTA Section --}}
    <section class="bg-linear-to-b from-surface-secondary to-surface-primary py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-6">
            <div class="reveal">
                <div class="grid grid-cols-1 items-center gap-8 rounded-2xl border border-border-light bg-surface-primary p-8 lg:grid-cols-[1fr_auto] lg:p-12" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div>
                        <h3 class="mb-3 text-xl font-bold text-text-primary lg:text-2xl" style="font-family: 'Poppins', sans-serif;">{{ __('Not a bug, but a question? Choose a channel!') }}</h3>
                        <p class="mb-5 text-base text-text-secondary">{{ __('If you don\'t want to report a technical issue but have a question about the system, use AI Chat (24/7) or write to our support team.') }}</p>
                        <div class="flex flex-wrap gap-5">
                            <span class="flex items-center gap-1.5 text-sm text-text-tertiary">
                                <svg class="h-4 w-4 text-success-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                                AI Chat 24/7
                            </span>
                            <span class="flex items-center gap-1.5 text-sm text-text-tertiary">
                                <svg class="h-4 w-4 text-success-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                                {{ __('Email support') }}
                            </span>
                            <span class="flex items-center gap-1.5 text-sm text-text-tertiary">
                                <svg class="h-4 w-4 text-success-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                                {{ __('Consultation') }}
                            </span>
                        </div>
                    </div>
                    <a href="{{ route('tamogatas') }}" class="group inline-flex items-center gap-2 rounded-full bg-danger-600 px-6 py-3 text-base font-medium text-white transition-all hover:bg-danger-700 hover:shadow-lg" style="box-shadow: 0 1px 2px rgba(0,0,0,0.05);">
                        <span>{{ __('Support page') }}</span>
                        <svg class="arrow-slide h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" /></svg>
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{-- Form Submit Script --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('bugForm');
            if (form) {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();
                    const btn = document.getElementById('bugSubmitBtn');
                    btn.innerHTML = '&#10004; {{ __('Report submitted — you\'ll receive an email shortly!') }}';
                    btn.classList.remove('bg-danger-600', 'hover:bg-danger-700');
                    btn.classList.add('bg-success-600', 'hover:bg-success-700');
                    btn.style.boxShadow = '0 4px 24px rgba(0, 202, 114, 0.2)';
                    btn.style.pointerEvents = 'none';
                    setTimeout(function() {
                        btn.innerHTML = '{{ __('Submit bug report') }} <svg class="arrow-slide h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" /></svg>';
                        btn.classList.remove('bg-success-600', 'hover:bg-success-700');
                        btn.classList.add('bg-danger-600', 'hover:bg-danger-700');
                        btn.style.boxShadow = '0 4px 24px rgba(251, 39, 93, 0.2)';
                        btn.style.pointerEvents = '';
                    }, 4000);
                });
            }
        });
    </script>

</div>
