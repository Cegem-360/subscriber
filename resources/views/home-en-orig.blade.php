<x-layouts.app>
    {{-- Section 1: Hero (Zoho layout + Monday.com style) --}}
    <section class="bg-gradient-to-b from-primary-50/60 to-surface-secondary">
        <div class="max-w-7xl mx-auto px-6 py-16 lg:py-24">
            <div class="flex flex-col lg:flex-row gap-12 lg:gap-16 items-center">
                {{-- Left: Content --}}
                <div class="flex-1">
                    {{-- Gradient badge --}}
                    <div class="inline-flex items-center px-4 py-1.5 rounded-full border border-border-light/80 bg-surface-primary mb-8"
                        style="box-shadow: 0 1px 3px rgba(0,0,0,0.04), 0 1px 2px rgba(0,0,0,0.02);">
                        <span
                            class="w-1.5 h-1.5 rounded-full bg-gradient-to-r from-success-500 via-warning-500 to-danger-500 mr-2.5"></span>
                        <span class="text-sm font-medium text-text-primary">AI work platform</span>
                    </div>

                    {{-- Main headline --}}
                    <h1 class="text-4xl md:text-5xl lg:text-[3.5rem] text-text-primary leading-[1.15] tracking-tight mb-6"
                        style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                        From managing work,<br>
                        to doing the work for you
                    </h1>

                    {{-- Subheadline --}}
                    <p class="text-xl lg:text-2xl text-text-secondary mb-8 leading-relaxed">
                        Agentic AI products that deliver results across projects, marketing, sales, operations, and
                        engineering.
                    </p>

                    {{-- CTA Button --}}
                    <a href="{{ route('register') }}"
                        class="inline-flex items-center gap-2 px-6 py-3 bg-primary-600 text-white rounded-full text-base font-medium hover:bg-primary-700 transition-colors"
                        style="box-shadow: 0 1px 2px rgba(0,0,0,0.05);">
                        <span>Get Started</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                        </svg>
                    </a>

                    {{-- No credit card text --}}
                    <p class="text-sm text-text-tertiary mt-4 flex items-center gap-2">
                        <span>No credit card needed</span>
                        <span class="text-text-disabled">✦</span>
                        <span>Unlimited time on Free plan</span>
                    </p>
                </div>

                {{-- Right: Card (Zoho vertical layout) --}}
                <div class="bg-surface-primary rounded-2xl p-8 w-full lg:w-[340px] shrink-0"
                    style="box-shadow: 0 12px 50px -6px rgba(96, 92, 212, 0.35), 0 0 1px rgba(96, 92, 212, 0.2);">
                    <p class="text-[11px] font-semibold text-text-tertiary uppercase tracking-widest mb-6">Featured Apps
                    </p>

                    <div class="space-y-5">
                        {{-- App Item 1: CRM --}}
                        <a href="#" class="flex items-center gap-4 group">
                            <div
                                class="w-10 h-10 bg-primary-100 rounded-full flex items-center justify-center shrink-0">
                                <svg class="w-5 h-5 text-primary-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z">
                                    </path>
                                </svg>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p
                                    class="text-sm font-semibold text-text-primary leading-none group-hover:text-primary-600 transition-colors">
                                    CRM</p>
                                <p class="text-[13px] text-text-tertiary mt-1">Convert leads and close sales deals
                                    faster.</p>
                            </div>
                        </a>

                        {{-- App Item 2: Mail --}}
                        <a href="#" class="flex items-center gap-4 group">
                            <div
                                class="w-10 h-10 bg-primary-100 rounded-full flex items-center justify-center shrink-0">
                                <svg class="w-5 h-5 text-primary-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                    </path>
                                </svg>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p
                                    class="text-sm font-semibold text-text-primary leading-none group-hover:text-primary-600 transition-colors">
                                    Mail</p>
                                <p class="text-[13px] text-text-tertiary mt-1">Secure email hosting for teams.</p>
                            </div>
                        </a>

                        {{-- App Item 3: Desk --}}
                        <a href="#" class="flex items-center gap-4 group">
                            <div
                                class="w-10 h-10 bg-success-100 rounded-full flex items-center justify-center shrink-0">
                                <svg class="w-5 h-5 text-success-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z">
                                    </path>
                                </svg>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p
                                    class="text-sm font-semibold text-text-primary leading-none group-hover:text-primary-600 transition-colors">
                                    Desk</p>
                                <p class="text-[13px] text-text-tertiary mt-1">Helpdesk software for support teams.</p>
                            </div>
                        </a>

                        {{-- App Item 4: Books --}}
                        <a href="#" class="flex items-center gap-4 group">
                            <div
                                class="w-10 h-10 bg-warning-100 rounded-full flex items-center justify-center shrink-0">
                                <svg class="w-5 h-5 text-warning-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z">
                                    </path>
                                </svg>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p
                                    class="text-sm font-semibold text-text-primary leading-none group-hover:text-primary-600 transition-colors">
                                    Books</p>
                                <p class="text-[13px] text-text-tertiary mt-1">Online accounting for growing businesses.
                                </p>
                            </div>
                        </a>

                        {{-- App Item 5: People --}}
                        <a href="#" class="flex items-center gap-4 group">
                            <div class="w-10 h-10 bg-danger-100 rounded-full flex items-center justify-center shrink-0">
                                <svg class="w-5 h-5 text-danger-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                                    </path>
                                </svg>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p
                                    class="text-sm font-semibold text-text-primary leading-none group-hover:text-primary-600 transition-colors">
                                    People</p>
                                <p class="text-[13px] text-text-tertiary mt-1">Organize and simplify your HR processes.
                                </p>
                            </div>
                        </a>
                    </div>

                    {{-- Explore All Link --}}
                    <a href="#"
                        class="inline-flex items-center gap-1 text-primary-600 text-sm font-medium mt-6 hover:text-primary-800 transition-colors">
                        Explore all products
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                            </path>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{-- Section 2: Tabbed Product Showcase --}}
    <section class="bg-surface-secondary py-16" x-data="{ activeTab: 'projects' }">
        <div class="max-w-7xl mx-auto px-6">
            {{-- Tab Navigation --}}
            <div class="flex justify-center mb-12">
                <div class="inline-flex items-center bg-surface-primary rounded-full p-1.5 border border-border-light"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <button @click="activeTab = 'projects'"
                        :class="activeTab === 'projects' ? 'bg-primary-600 text-white' :
                            'text-text-secondary hover:text-text-primary'"
                        class="px-6 py-2.5 rounded-full text-sm font-medium transition-all duration-200">Projects</button>
                    <button @click="activeTab = 'sales'"
                        :class="activeTab === 'sales' ? 'bg-[#0f7b6c] text-white' :
                            'text-text-secondary hover:text-text-primary'"
                        class="px-6 py-2.5 rounded-full text-sm font-medium transition-all duration-200">Sales</button>
                    <button @click="activeTab = 'marketing'"
                        :class="activeTab === 'marketing' ? 'bg-primary-500 text-white' :
                            'text-text-secondary hover:text-text-primary'"
                        class="px-6 py-2.5 rounded-full text-sm font-medium transition-all duration-200">Marketing</button>
                    <button @click="activeTab = 'itops'"
                        :class="activeTab === 'itops' ? 'bg-[#7a1a42] text-white' :
                            'text-text-secondary hover:text-text-primary'"
                        class="px-6 py-2.5 rounded-full text-sm font-medium transition-all duration-200">IT &
                        Ops</button>
                    <button @click="activeTab = 'engineering'"
                        :class="activeTab === 'engineering' ? 'bg-success-600 text-white' :
                            'text-text-secondary hover:text-text-primary'"
                        class="px-6 py-2.5 rounded-full text-sm font-medium transition-all duration-200">Product &
                        Engineering</button>
                    <button @click="activeTab = 'leadership'"
                        :class="activeTab === 'leadership' ? 'bg-primary-600 text-white' :
                            'text-text-secondary hover:text-text-primary'"
                        class="px-6 py-2.5 rounded-full text-sm font-medium transition-all duration-200">Leadership</button>
                </div>
            </div>

            {{-- Tab Content --}}
            <div class="flex flex-col lg:flex-row gap-6 items-stretch">
                {{-- Left: Colored Product Card --}}
                <div class="lg:w-130 shrink-0">
                    {{-- Projects Tab --}}
                    <div x-show="activeTab === 'projects'" x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                        class="bg-primary-600 rounded-3xl p-10 h-full flex flex-col justify-between min-h-120">
                        <div>
                            <div class="flex items-center gap-2 mb-8">
                                <div class="w-8 h-8 bg-white/20 rounded-lg flex items-center justify-center">
                                    <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                                        <rect x="3" y="3" width="7" height="7" rx="1" />
                                        <rect x="14" y="3" width="7" height="7" rx="1" />
                                        <rect x="3" y="14" width="7" height="7" rx="1" />
                                        <rect x="14" y="14" width="7" height="7" rx="1" />
                                    </svg>
                                </div>
                                <span class="text-white/90 text-sm font-medium"><strong
                                        class="font-bold">monday</strong> work management</span>
                            </div>
                            <h3 class="text-white text-4xl lg:text-5xl font-light leading-tight mb-6"
                                style="font-family: 'Poppins', sans-serif;">Drive execution<br>at scale</h3>
                            <p class="text-white/80 text-lg lg:text-xl leading-relaxed mb-8">Deliver projects,
                                programs, and portfolios with full resource visibility and AI-powered risk detection.
                            </p>
                        </div>
                        <a href="#"
                            class="inline-flex items-center gap-2 bg-white text-text-primary px-6 py-3 rounded-full text-sm font-medium hover:bg-light-200 transition-colors w-fit">
                            Get Started
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 8l4 4m0 0l-4 4m4-4H3" />
                            </svg>
                        </a>
                    </div>

                    {{-- Sales Tab --}}
                    <div x-show="activeTab === 'sales'" x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                        class="bg-[#0f7b6c] rounded-3xl p-10 h-full flex flex-col justify-between min-h-120">
                        <div>
                            <div class="flex items-center gap-2 mb-8">
                                <div class="w-8 h-8 bg-white/20 rounded-lg flex items-center justify-center">
                                    <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z" />
                                    </svg>
                                </div>
                                <span class="text-white/90 text-sm font-medium"><strong
                                        class="font-bold">monday</strong> CRM</span>
                            </div>
                            <h3 class="text-white text-4xl lg:text-5xl font-light leading-tight mb-6"
                                style="font-family: 'Poppins', sans-serif;">Accelerate<br>revenue growth</h3>
                            <p class="text-white/80 text-lg lg:text-xl leading-relaxed mb-8">Free your teams from data
                                entry to focus on sales and nurture, with AI actions and code-free automations.</p>
                        </div>
                        <a href="#"
                            class="inline-flex items-center gap-2 bg-white text-text-primary px-6 py-3 rounded-full text-sm font-medium hover:bg-light-200 transition-colors w-fit">
                            Get Started
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 8l4 4m0 0l-4 4m4-4H3" />
                            </svg>
                        </a>
                    </div>

                    {{-- Marketing Tab --}}
                    <div x-show="activeTab === 'marketing'" x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                        class="bg-primary-500 rounded-3xl p-10 h-full flex flex-col justify-between min-h-120">
                        <div>
                            <div class="flex items-center gap-2 mb-8">
                                <div class="w-8 h-8 bg-white/20 rounded-lg flex items-center justify-center">
                                    <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                                        <rect x="3" y="3" width="7" height="7" rx="1" />
                                        <rect x="14" y="3" width="7" height="7" rx="1" />
                                        <rect x="3" y="14" width="7" height="7" rx="1" />
                                        <rect x="14" y="14" width="7" height="7" rx="1" />
                                    </svg>
                                </div>
                                <span class="text-white/90 text-sm font-medium"><strong
                                        class="font-bold">monday</strong> work management</span>
                            </div>
                            <h3 class="text-white text-4xl lg:text-5xl font-light leading-tight mb-6"
                                style="font-family: 'Poppins', sans-serif;">Amplify marketing<br>impact</h3>
                            <p class="text-white/80 text-lg lg:text-xl leading-relaxed mb-8">Align marketing around
                                shared goals with AI that streamlines briefs, flags delays, and drives campaign impact.
                            </p>
                        </div>
                        <a href="#"
                            class="inline-flex items-center gap-2 bg-white text-text-primary px-6 py-3 rounded-full text-sm font-medium hover:bg-light-200 transition-colors w-fit">
                            Get Started
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 8l4 4m0 0l-4 4m4-4H3" />
                            </svg>
                        </a>
                    </div>

                    {{-- IT & Ops Tab --}}
                    <div x-show="activeTab === 'itops'" x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                        class="bg-[#7a1a42] rounded-3xl p-10 h-full flex flex-col justify-between min-h-120">
                        <div>
                            <div class="flex items-center gap-2 mb-8">
                                <div class="w-8 h-8 bg-white/20 rounded-lg flex items-center justify-center">
                                    <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-7 3c1.93 0 3.5 1.57 3.5 3.5S13.93 13 12 13s-3.5-1.57-3.5-3.5S10.07 6 12 6zm7 13H5v-.23c0-.62.28-1.2.76-1.58C7.47 15.82 9.64 15 12 15s4.53.82 6.24 2.19c.48.38.76.97.76 1.58V19z" />
                                    </svg>
                                </div>
                                <span class="text-white/90 text-sm font-medium"><strong
                                        class="font-bold">monday</strong> service</span>
                            </div>
                            <h3 class="text-white text-4xl lg:text-5xl font-light leading-tight mb-6"
                                style="font-family: 'Poppins', sans-serif;">Scale exceptional<br>service</h3>
                            <p class="text-white/80 text-lg lg:text-xl leading-relaxed mb-8">Empower teams to resolve
                                requests faster with AI that triages, routes, and guides each issue to resolution.</p>
                        </div>
                        <a href="#"
                            class="inline-flex items-center gap-2 bg-white text-text-primary px-6 py-3 rounded-full text-sm font-medium hover:bg-light-200 transition-colors w-fit">
                            Get Started
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 8l4 4m0 0l-4 4m4-4H3" />
                            </svg>
                        </a>
                    </div>

                    {{-- Product & Engineering Tab --}}
                    <div x-show="activeTab === 'engineering'" x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                        class="bg-success-600 rounded-3xl p-10 h-full flex flex-col justify-between min-h-120">
                        <div>
                            <div class="flex items-center gap-2 mb-8">
                                <div class="w-8 h-8 bg-white/20 rounded-lg flex items-center justify-center">
                                    <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M9.4 16.6L4.8 12l4.6-4.6L8 6l-6 6 6 6 1.4-1.4zm5.2 0l4.6-4.6-4.6-4.6L16 6l6 6-6 6-1.4-1.4z" />
                                    </svg>
                                </div>
                                <span class="text-white/90 text-sm font-medium"><strong
                                        class="font-bold">monday</strong> dev</span>
                            </div>
                            <h3 class="text-white text-4xl lg:text-5xl font-light leading-tight mb-6"
                                style="font-family: 'Poppins', sans-serif;">Launch quality<br>products faster</h3>
                            <p class="text-white/80 text-lg lg:text-xl leading-relaxed mb-8">Plan roadmaps, execute
                                sprints, and ship with precision using AI-powered guidance.</p>
                        </div>
                        <a href="#"
                            class="inline-flex items-center gap-2 bg-white text-text-primary px-6 py-3 rounded-full text-sm font-medium hover:bg-light-200 transition-colors w-fit">
                            Get Started
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 8l4 4m0 0l-4 4m4-4H3" />
                            </svg>
                        </a>
                    </div>

                    {{-- Leadership Tab --}}
                    <div x-show="activeTab === 'leadership'" x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                        class="bg-primary-600 rounded-3xl p-10 h-full flex flex-col justify-between min-h-120">
                        <div>
                            <div class="flex items-center gap-2 mb-8">
                                <div class="w-8 h-8 bg-white/20 rounded-lg flex items-center justify-center">
                                    <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M3 13h2v-2H3v2zm0 4h2v-2H3v2zm0-8h2V7H3v2zm4 4h14v-2H7v2zm0 4h14v-2H7v2zM7 7v2h14V7H7z" />
                                    </svg>
                                </div>
                                <span class="text-white/90 text-sm font-medium"><strong
                                        class="font-bold">monday</strong> platform</span>
                            </div>
                            <h3 class="text-white text-4xl lg:text-5xl font-light leading-tight mb-6"
                                style="font-family: 'Poppins', sans-serif;">Lead with clear<br>foresight</h3>
                            <p class="text-white/80 text-lg lg:text-xl leading-relaxed mb-8">Keep strategic goals on
                                track with AI risk flagging and cross-org data to make real-time decisions.</p>
                        </div>
                        <a href="#"
                            class="inline-flex items-center gap-2 bg-white text-text-primary px-6 py-3 rounded-full text-sm font-medium hover:bg-light-200 transition-colors w-fit">
                            Get Started
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 8l4 4m0 0l-4 4m4-4H3" />
                            </svg>
                        </a>
                    </div>
                </div>

                {{-- Right: Testimonial Cards --}}
                <div class="flex-1 flex flex-col gap-4">
                    {{-- Stats Card --}}
                    <div x-show="activeTab === 'projects'" x-transition
                        class="bg-surface-primary rounded-2xl p-6 border border-border-light"
                        style="box-shadow: 0 4px 20px -4px rgba(96, 92, 212, 0.12);">
                        <p class="text-text-tertiary text-xs uppercase tracking-wider mb-2 font-semibold">HOLT CAT</p>
                        <p class="text-3xl lg:text-4xl font-bold text-text-primary"><span class="text-primary-600">$4M
                                saved</span> with<br>optimized processes</p>
                    </div>
                    <div x-show="activeTab === 'sales'" x-transition
                        class="bg-surface-primary rounded-2xl p-6 border border-border-light"
                        style="box-shadow: 0 4px 20px -4px rgba(96, 92, 212, 0.12);">
                        <p class="text-text-tertiary text-xs uppercase tracking-wider mb-2 font-semibold">KC PETROLEUM
                        </p>
                        <p class="text-3xl lg:text-4xl font-bold text-text-primary"><span class="text-[#0f7b6c]">18x
                                ROI</span> achieved<br>in the first year</p>
                    </div>
                    <div x-show="activeTab === 'marketing'" x-transition
                        class="bg-surface-primary rounded-2xl p-6 border border-border-light"
                        style="box-shadow: 0 4px 20px -4px rgba(96, 92, 212, 0.12);">
                        <p class="text-text-tertiary text-xs uppercase tracking-wider mb-2 font-semibold">CANVA</p>
                        <p class="text-3xl lg:text-4xl font-bold text-text-primary"><span
                                class="text-primary-500">300% increase</span> in<br>creative output</p>
                    </div>
                    <div x-show="activeTab === 'itops'" x-transition
                        class="bg-surface-primary rounded-2xl p-6 border border-border-light"
                        style="box-shadow: 0 4px 20px -4px rgba(96, 92, 212, 0.12);">
                        <p class="text-text-tertiary text-xs uppercase tracking-wider mb-2 font-semibold">ZOPA BANK</p>
                        <p class="text-3xl lg:text-4xl font-bold text-text-primary"><span class="text-[#7a1a42]">55
                                hours</span> saved<br>per month</p>
                    </div>
                    <div x-show="activeTab === 'engineering'" x-transition
                        class="bg-surface-primary rounded-2xl p-6 border border-border-light"
                        style="box-shadow: 0 4px 20px -4px rgba(96, 92, 212, 0.12);">
                        <p class="text-text-tertiary text-xs uppercase tracking-wider mb-2 font-semibold">VISTRA</p>
                        <p class="text-3xl lg:text-4xl font-bold text-text-primary"><span class="text-success-600">28%
                                faster</span> time<br>to market</p>
                    </div>
                    <div x-show="activeTab === 'leadership'" x-transition
                        class="bg-surface-primary rounded-2xl p-6 border border-border-light"
                        style="box-shadow: 0 4px 20px -4px rgba(96, 92, 212, 0.12);">
                        <p class="text-text-tertiary text-xs uppercase tracking-wider mb-2 font-semibold">VML</p>
                        <p class="text-3xl lg:text-4xl font-bold text-text-primary"><span class="text-primary-600">11%
                                efficiency</span> gained<br>per month</p>
                    </div>

                    {{-- Testimonial Quote Card --}}
                    <div x-show="activeTab === 'projects'" x-transition
                        class="bg-surface-primary rounded-2xl p-6 border border-border-light flex-1"
                        style="box-shadow: 0 4px 20px -4px rgba(96, 92, 212, 0.12);">
                        <p class="text-text-secondary text-lg leading-relaxed mb-6">"monday.com gives us the visibility
                            to get everyone on the same page and track all the moving parts of our projects."</p>
                        <div class="flex items-center gap-3">
                            <div
                                class="w-10 h-10 bg-primary-100 rounded-full flex items-center justify-center text-primary-600 font-semibold text-sm">
                                JD</div>
                            <div>
                                <p class="text-text-primary font-semibold text-sm">Jason Doan</p>
                                <p class="text-text-tertiary text-xs">VP of Operations, HOLT CAT</p>
                            </div>
                        </div>
                    </div>
                    <div x-show="activeTab === 'sales'" x-transition
                        class="bg-surface-primary rounded-2xl p-6 border border-border-light flex-1"
                        style="box-shadow: 0 4px 20px -4px rgba(96, 92, 212, 0.12);">
                        <p class="text-text-secondary text-lg leading-relaxed mb-6">"As a VP, trying to look at a
                            30,000-ft view, I can see the percentage of successful opportunities and know-how to analyze
                            the market."</p>
                        <div class="flex items-center gap-3">
                            <div
                                class="w-10 h-10 bg-[#0f7b6c]/10 rounded-full flex items-center justify-center text-[#0f7b6c] font-semibold text-sm">
                                CS</div>
                            <div>
                                <p class="text-text-primary font-semibold text-sm">Christopher Stone</p>
                                <p class="text-text-tertiary text-xs">VP Business Development, KC Petroleum</p>
                            </div>
                        </div>
                    </div>
                    <div x-show="activeTab === 'marketing'" x-transition
                        class="bg-surface-primary rounded-2xl p-6 border border-border-light flex-1"
                        style="box-shadow: 0 4px 20px -4px rgba(96, 92, 212, 0.12);">
                        <p class="text-text-secondary text-lg leading-relaxed mb-6">"monday.com isn't just another tool
                            in the mix, but a work operating system that supports our need for efficiency at scale."</p>
                        <div class="flex items-center gap-3">
                            <div
                                class="w-10 h-10 bg-primary-100 rounded-full flex items-center justify-center text-primary-600 font-semibold text-sm">
                                VD</div>
                            <div>
                                <p class="text-text-primary font-semibold text-sm">Vic Diesta</p>
                                <p class="text-text-tertiary text-xs">Creative Operations Lead, Canva</p>
                            </div>
                        </div>
                    </div>
                    <div x-show="activeTab === 'itops'" x-transition
                        class="bg-surface-primary rounded-2xl p-6 border border-border-light flex-1"
                        style="box-shadow: 0 4px 20px -4px rgba(96, 92, 212, 0.12);">
                        <p class="text-text-secondary text-lg leading-relaxed mb-6">"With monday service, 98% of our
                            tickets are automatically categorized and assigned by AI. We resolve each 6-7 mins faster."
                        </p>
                        <div class="flex items-center gap-3">
                            <div
                                class="w-10 h-10 bg-[#7a1a42]/10 rounded-full flex items-center justify-center text-[#7a1a42] font-semibold text-sm">
                                CC</div>
                            <div>
                                <p class="text-text-primary font-semibold text-sm">Clive Camilleri</p>
                                <p class="text-text-tertiary text-xs">Head of People & Ops, Zopa Bank</p>
                            </div>
                        </div>
                    </div>
                    <div x-show="activeTab === 'engineering'" x-transition
                        class="bg-surface-primary rounded-2xl p-6 border border-border-light flex-1"
                        style="box-shadow: 0 4px 20px -4px rgba(96, 92, 212, 0.12);">
                        <p class="text-text-secondary text-lg leading-relaxed mb-6">"monday dev ensures clear alignment
                            between what we're building and market demand. Does it help us move faster? Without a
                            doubt."</p>
                        <div class="flex items-center gap-3">
                            <div
                                class="w-10 h-10 bg-success-100 rounded-full flex items-center justify-center text-success-600 font-semibold text-sm">
                                AS</div>
                            <div>
                                <p class="text-text-primary font-semibold text-sm">Alan Schmoll</p>
                                <p class="text-text-tertiary text-xs">Executive VP, Vistra Platform</p>
                            </div>
                        </div>
                    </div>
                    <div x-show="activeTab === 'leadership'" x-transition
                        class="bg-surface-primary rounded-2xl p-6 border border-border-light flex-1"
                        style="box-shadow: 0 4px 20px -4px rgba(96, 92, 212, 0.12);">
                        <p class="text-text-secondary text-lg leading-relaxed mb-6">"Now in real-time, we can identify
                            health metrics and risks, whether they're coming from our side or the client side."</p>
                        <div class="flex items-center gap-3">
                            <div
                                class="w-10 h-10 bg-primary-100 rounded-full flex items-center justify-center text-primary-600 font-semibold text-sm">
                                PW</div>
                            <div>
                                <p class="text-text-primary font-semibold text-sm">Paul Willie</p>
                                <p class="text-text-tertiary text-xs">COO, VML</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Section 3: AI-First Products --}}
    <section class="bg-surface-primary py-20">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex flex-col lg:flex-row gap-12 lg:gap-16">
                {{-- Left Column: Headline + Product Cards --}}
                <div class="lg:w-1/2">
                    {{-- Main Headline --}}
                    <h2 class="text-4xl md:text-5xl text-text-primary leading-tight mb-12"
                        style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                        Solve work challenges<br>with AI-first products
                    </h2>

                    {{-- Product Cards Grid --}}
                    <div class="grid grid-cols-2 gap-4">
                        {{-- Work Management Card --}}
                        <div class="relative group">
                            <div class="absolute -inset-0.5 rounded-xl opacity-0 group-hover:opacity-100 transition-opacity duration-500 ease-out"
                                style="background: linear-gradient(90deg, #fb275d, #ffcb00, #00ca72, #6161ff);"></div>
                            <div class="relative h-full bg-surface-primary rounded-xl p-7 border border-border-light group-hover:border-transparent transition-colors duration-300"
                                style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                                <div class="flex items-center gap-3 mb-5">
                                    <div class="w-12 h-12 bg-primary-100 rounded-lg flex items-center justify-center">
                                        <svg class="w-7 h-7 text-primary-600" fill="currentColor"
                                            viewBox="0 0 24 24">
                                            <rect x="3" y="3" width="7" height="7" rx="1" />
                                            <rect x="14" y="3" width="7" height="7" rx="1" />
                                            <rect x="3" y="14" width="7" height="7" rx="1" />
                                            <rect x="14" y="14" width="7" height="7" rx="1" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-lg font-bold text-text-primary">monday</p>
                                        <p class="text-base text-text-tertiary -mt-0.5">work management</p>
                                    </div>
                                </div>
                                <p class="text-text-secondary text-lg leading-relaxed mb-5">Drive projects and
                                    processes forward with AI insights</p>
                                <a href="#"
                                    class="text-text-primary text-base font-semibold underline underline-offset-2 hover:text-primary-600 transition-colors">Learn
                                    more</a>
                            </div>
                        </div>

                        {{-- CRM Card --}}
                        <div class="relative group">
                            <div class="absolute -inset-0.5 rounded-xl opacity-0 group-hover:opacity-100 transition-opacity duration-500 ease-out"
                                style="background: linear-gradient(90deg, #fb275d, #ffcb00, #00ca72, #6161ff);"></div>
                            <div class="relative h-full bg-surface-primary rounded-xl p-7 border border-border-light group-hover:border-transparent transition-colors duration-300"
                                style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                                <div class="flex items-center gap-3 mb-5">
                                    <div class="w-12 h-12 bg-[#0f7b6c]/10 rounded-lg flex items-center justify-center">
                                        <svg class="w-7 h-7 text-[#0f7b6c]" fill="currentColor" viewBox="0 0 24 24">
                                            <path
                                                d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-lg font-bold text-text-primary">monday</p>
                                        <p class="text-base text-text-tertiary -mt-0.5">CRM</p>
                                    </div>
                                </div>
                                <p class="text-text-secondary text-lg leading-relaxed mb-5">Automate full customer
                                    journeys with AI actions</p>
                                <a href="#"
                                    class="text-text-primary text-base font-semibold underline underline-offset-2 hover:text-primary-600 transition-colors">Learn
                                    more</a>
                            </div>
                        </div>

                        {{-- Dev Card --}}
                        <div class="relative group">
                            <div class="absolute -inset-0.5 rounded-xl opacity-0 group-hover:opacity-100 transition-opacity duration-500 ease-out"
                                style="background: linear-gradient(90deg, #fb275d, #ffcb00, #00ca72, #6161ff);"></div>
                            <div class="relative h-full bg-surface-primary rounded-xl p-7 border border-border-light group-hover:border-transparent transition-colors duration-300"
                                style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                                <div class="flex items-center gap-3 mb-5">
                                    <div class="w-12 h-12 bg-success-100 rounded-lg flex items-center justify-center">
                                        <svg class="w-7 h-7 text-success-600" fill="currentColor"
                                            viewBox="0 0 24 24">
                                            <path
                                                d="M9.4 16.6L4.8 12l4.6-4.6L8 6l-6 6 6 6 1.4-1.4zm5.2 0l4.6-4.6-4.6-4.6L16 6l6 6-6 6-1.4-1.4z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-lg font-bold text-text-primary">monday</p>
                                        <p class="text-base text-text-tertiary -mt-0.5">dev</p>
                                    </div>
                                </div>
                                <p class="text-text-secondary text-lg leading-relaxed mb-5">Ship quality software with
                                    AI-guided sprints</p>
                                <a href="#"
                                    class="text-text-primary text-base font-semibold underline underline-offset-2 hover:text-primary-600 transition-colors">Learn
                                    more</a>
                            </div>
                        </div>

                        {{-- Service Card --}}
                        <div class="relative group">
                            <div class="absolute -inset-0.5 rounded-xl opacity-0 group-hover:opacity-100 transition-opacity duration-500 ease-out"
                                style="background: linear-gradient(90deg, #fb275d, #ffcb00, #00ca72, #6161ff);"></div>
                            <div class="relative h-full bg-surface-primary rounded-xl p-7 border border-border-light group-hover:border-transparent transition-colors duration-300"
                                style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                                <div class="flex items-center gap-3 mb-5">
                                    <div class="w-12 h-12 bg-danger-100 rounded-lg flex items-center justify-center">
                                        <svg class="w-7 h-7 text-danger-500" fill="currentColor" viewBox="0 0 24 24">
                                            <path
                                                d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-7 3c1.93 0 3.5 1.57 3.5 3.5S13.93 13 12 13s-3.5-1.57-3.5-3.5S10.07 6 12 6zm7 13H5v-.23c0-.62.28-1.2.76-1.58C7.47 15.82 9.64 15 12 15s4.53.82 6.24 2.19c.48.38.76.97.76 1.58V19z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-lg font-bold text-text-primary">monday</p>
                                        <p class="text-base text-text-tertiary -mt-0.5">service</p>
                                    </div>
                                </div>
                                <p class="text-text-secondary text-lg leading-relaxed mb-5">Deliver standout service
                                    with AI ticket handling</p>
                                <a href="#"
                                    class="text-text-primary text-base font-semibold underline underline-offset-2 hover:text-primary-600 transition-colors">Learn
                                    more</a>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Right Column: Description + CTA + Image --}}
                <div class="lg:w-1/2 flex flex-col">
                    {{-- Description and CTAs --}}
                    <div class="mb-8">
                        <p class="text-text-secondary text-xl lg:text-2xl leading-relaxed mb-6">
                            Each product solves departmental needs, and together, they power seamless operations across
                            your organization.
                        </p>
                        <div class="flex items-center gap-4">
                            <a href="{{ route('register') }}"
                                class="inline-flex items-center gap-2 bg-dark-900 text-white px-7 py-3.5 rounded-full text-base font-medium hover:bg-dark-800 transition-colors">
                                Get Started
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                </svg>
                            </a>
                            <a href="#"
                                class="inline-flex items-center gap-2 bg-surface-primary text-text-primary px-7 py-3.5 rounded-full text-base font-medium border border-border-default hover:bg-surface-secondary transition-colors">
                                Request a demo
                            </a>
                        </div>
                    </div>

                    {{-- Team Image with Labels --}}
                    <div class="relative flex-1 min-h-80 rounded-2xl overflow-hidden">
                        {{-- Background Image --}}
                        <img src="{{ Vite::asset('resources/images/products-main-img.webp') }}"
                            alt="Team collaboration" class="absolute inset-0 w-full h-full object-cover">

                        {{-- Floating Labels --}}
                        <div class="absolute top-24 right-12">
                            <span class="bg-[#0f7b6c] text-white text-sm font-medium px-4 py-2 rounded-lg">Sales</span>
                        </div>
                        <div class="absolute top-30 left-60">
                            <span
                                class="bg-success-500 text-white text-sm font-medium px-4 py-2 rounded-lg">Engineering</span>
                        </div>
                        <div class="absolute top-1/2 left-1/6">
                            <span class="bg-danger-500 text-white text-sm font-medium px-4 py-2 rounded-lg">IT</span>
                        </div>
                        <div class="absolute bottom-24 right-16">
                            <span
                                class="bg-primary-500 text-white text-sm font-medium px-4 py-2 rounded-lg">Marketing</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Section 4: The monday.com difference (Bento Grid) --}}
    <section class="bg-surface-primary py-20">
        <div class="max-w-7xl mx-auto px-6">
            {{-- Section Headline --}}
            <h2 class="text-4xl md:text-5xl text-text-primary text-center mb-16"
                style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                The monday.com difference
            </h2>

            {{-- Bento Grid --}}
            <div class="grid grid-cols-12 gap-5">
                {{-- Row 1 --}}
                {{-- Icon Card (small, left) --}}
                <div
                    class="col-span-12 md:col-span-4 bg-primary-50 rounded-3xl p-8 flex items-center justify-center min-h-56">
                    <svg class="w-28 h-28 text-success-500" viewBox="0 0 100 100" fill="currentColor">
                        <ellipse cx="30" cy="65" rx="18" ry="18" />
                        <ellipse cx="55" cy="40" rx="18" ry="18" />
                        <ellipse cx="70" cy="70" rx="14" ry="14" />
                    </svg>
                </div>

                {{-- Flexible yet standardized (large, right) --}}
                <div
                    class="col-span-12 md:col-span-8 bg-success-500 rounded-3xl p-10 lg:p-12 flex items-center min-h-56">
                    <div class="flex flex-col md:flex-row md:items-center gap-6 md:gap-16">
                        <h3 class="text-white text-3xl md:text-[2.5rem] lg:text-[2.75rem] font-medium leading-[1.15]"
                            style="font-family: 'Poppins', sans-serif;">
                            Flexible yet<br>standardized
                        </h3>
                        <p class="text-white/90 text-lg lg:text-xl leading-relaxed max-w-md">
                            Build custom workflows with a no-code interface, while defining admin controls to maintain
                            cross-org consistency.
                        </p>
                    </div>
                </div>

                {{-- Row 2 --}}
                {{-- Products teams love to use (large, left) --}}
                <div
                    class="col-span-12 md:col-span-7 bg-primary-500 rounded-3xl p-10 lg:p-12 flex items-center min-h-56">
                    <div class="flex flex-col md:flex-row md:items-center gap-6 md:gap-12">
                        <h3 class="text-white text-3xl md:text-[2.5rem] lg:text-[2.75rem] font-medium leading-[1.15]"
                            style="font-family: 'Poppins', sans-serif;">
                            Products teams<br>love to use
                        </h3>
                        <p class="text-white/90 text-lg lg:text-xl leading-relaxed max-w-sm">
                            Onboard your entire organization with intuitive products they'll love to use.
                        </p>
                    </div>
                </div>

                {{-- Heart Icon Card (small, right) --}}
                <div
                    class="col-span-12 md:col-span-5 bg-primary-50 rounded-3xl p-8 flex items-center justify-center min-h-56">
                    <div class="relative">
                        <svg class="w-36 h-36 text-primary-200" viewBox="0 0 24 24" fill="currentColor">
                            <path
                                d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
                        </svg>
                        <svg class="w-24 h-24 text-primary-500 absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2"
                            viewBox="0 0 24 24" fill="currentColor">
                            <path
                                d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
                        </svg>
                    </div>
                </div>

                {{-- Row 3 --}}
                {{-- Speed Icon Card (small, left) --}}
                <div
                    class="col-span-12 md:col-span-4 bg-danger-50 rounded-3xl p-8 flex items-center justify-center min-h-56">
                    <svg class="w-32 h-32 text-danger-400" viewBox="0 0 100 100" fill="currentColor">
                        <rect x="10" y="35" width="45" height="18" rx="9" />
                        <rect x="25" y="55" width="45" height="18" rx="9" />
                    </svg>
                </div>

                {{-- Fast time to value (large, right) --}}
                <div
                    class="col-span-12 md:col-span-8 bg-danger-400 rounded-3xl p-10 lg:p-12 flex items-center min-h-56">
                    <div class="flex flex-col md:flex-row md:items-center gap-6 md:gap-16">
                        <h3 class="text-white text-3xl md:text-[2.5rem] lg:text-[2.75rem] font-medium leading-[1.15]"
                            style="font-family: 'Poppins', sans-serif;">
                            Fast time to<br>value
                        </h3>
                        <p class="text-white/90 text-lg lg:text-xl leading-relaxed max-w-md">
                            See value fast with products that are quick to implement and even easier to learn.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Section 5: Case Studies Carousel --}}
    <section class="bg-light-400 py-20">
        <div class="max-w-7xl mx-auto px-6">
            {{-- Header --}}
            <div class="flex items-start justify-between mb-12">
                <h2 class="text-4xl md:text-5xl lg:text-[3.5rem] text-text-primary leading-tight max-w-2xl"
                    style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                    Leading brands drive efficient growth with monday.com
                </h2>
                <a href="#"
                    class="hidden md:inline-flex items-center gap-2 bg-text-primary text-white px-7 py-3.5 rounded-full text-base font-medium hover:bg-dark-700 transition-colors shrink-0">
                    Contact sales
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 8l4 4m0 0l-4 4m4-4H3" />
                    </svg>
                </a>
            </div>

            {{-- Carousel Container --}}
            <div x-data="{
                currentIndex: 0,
                totalSlides: 9,
                visibleSlides: 4,
                autoplayInterval: null,
                isHovered: false,
                isDragging: false,
                startX: 0,
                currentX: 0,
                dragOffset: 0,
                get maxIndex() {
                    return Math.max(0, this.totalSlides - this.visibleSlides);
                },
                init() {
                    this.updateVisibleSlides();
                    window.addEventListener('resize', () => this.updateVisibleSlides());
                    this.startAutoplay();
                },
                updateVisibleSlides() {
                    if (window.innerWidth < 640) this.visibleSlides = 1;
                    else if (window.innerWidth < 1024) this.visibleSlides = 2;
                    else if (window.innerWidth < 1280) this.visibleSlides = 3;
                    else this.visibleSlides = 4;
                    if (this.currentIndex > this.maxIndex) this.currentIndex = this.maxIndex;
                },
                next() {
                    if (this.currentIndex < this.maxIndex) {
                        this.currentIndex++;
                    } else {
                        this.currentIndex = 0;
                    }
                },
                prev() {
                    if (this.currentIndex > 0) {
                        this.currentIndex--;
                    } else {
                        this.currentIndex = this.maxIndex;
                    }
                },
                goTo(index) {
                    this.currentIndex = Math.min(index, this.maxIndex);
                },
                startAutoplay() {
                    this.autoplayInterval = setInterval(() => {
                        if (!this.isHovered) this.next();
                    }, 4000);
                },
                stopAutoplay() {
                    clearInterval(this.autoplayInterval);
                },
                handleDragStart(e) {
                    this.isDragging = true;
                    this.startX = e.type.includes('mouse') ? e.pageX : e.touches[0].pageX;
                    this.dragOffset = 0;
                },
                handleDragMove(e) {
                    if (!this.isDragging) return;
                    e.preventDefault();
                    this.currentX = e.type.includes('mouse') ? e.pageX : e.touches[0].pageX;
                    this.dragOffset = this.currentX - this.startX;
                },
                handleDragEnd() {
                    if (!this.isDragging) return;
                    this.isDragging = false;
                    const threshold = 80;
                    if (this.dragOffset > threshold) {
                        this.prev();
                    } else if (this.dragOffset < -threshold) {
                        this.next();
                    }
                    this.dragOffset = 0;
                }
            }" @mouseenter="isHovered = true"
                @mouseleave="isHovered = false; handleDragEnd()" class="relative">
                {{-- Cards Carousel --}}
                <div class="overflow-hidden">
                    <div class="flex gap-6 select-none [&_img]:pointer-events-none"
                        :class="isDragging ? '' : 'transition-transform duration-500 ease-out'"
                        :style="'transform: translateX(calc(-' + (currentIndex * (100 / visibleSlides)) + '% + ' + dragOffset +
                            'px)); cursor: ' + (isDragging ? 'grabbing' : 'grab')"
                        @mousedown="handleDragStart($event)" @mousemove="handleDragMove($event)"
                        @mouseup="handleDragEnd()" @mouseleave="handleDragEnd()"
                        @touchstart="handleDragStart($event)" @touchmove="handleDragMove($event)"
                        @touchend="handleDragEnd()">
                        {{-- McDonald's Card --}}
                        <div class="shrink-0 w-full sm:w-[calc(50%-12px)] lg:w-[calc(33.333%-16px)] xl:w-[calc(25%-18px)] bg-white rounded-2xl p-6"
                            style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                            <div class="flex items-center justify-between mb-4 h-10">
                                <img src="https://cdn.prod.website-files.com/65b62e80a3a89609079c247a/67e2f63a9b1842822745591c_mcdonalds-15-logo-png-transparent.avif"
                                    alt="McDonald's" class="h-10 w-auto max-w-28 object-contain">
                                <a href="#"
                                    class="text-text-primary text-sm font-medium underline underline-offset-2 hover:text-primary-600 transition-colors">See
                                    the case study</a>
                            </div>
                            <div class="w-full h-40 rounded-xl mb-5 overflow-hidden">
                                <img src="https://cdn.prod.website-files.com/65b62e80a3a89609079c247a/67e2f6b041ce2963c90ef8ef_visual-karsa-y8fS7CSN-Vw-unsplash.avif"
                                    alt="McDonald's case study" class="w-full h-full object-cover">
                            </div>
                            <div class="flex items-center gap-3 mb-4">
                                <span class="text-5xl font-bold text-text-primary"
                                    style="font-family: 'Poppins', sans-serif;">615%</span>
                                <span class="text-text-secondary text-base leading-tight">Return
                                    on<br>investment</span>
                            </div>
                            <div class="border-t border-border-light pt-4">
                                <span
                                    class="inline-block px-3 py-1.5 border border-border-light rounded-full text-sm text-text-secondary">Retail
                                    & CPG</span>
                            </div>
                        </div>

                        {{-- HOLT CAT Card --}}
                        <div class="shrink-0 w-full sm:w-[calc(50%-12px)] lg:w-[calc(33.333%-16px)] xl:w-[calc(25%-18px)] bg-white rounded-2xl p-6"
                            style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                            <div class="flex items-center justify-between mb-4 h-10">
                                <img src="https://dapulse-res.cloudinary.com/image/upload/f_auto,q_auto/remote_mondaycom_static/img/customers/logos-v2/HoltCat.png"
                                    alt="HOLT CAT" class="h-8 w-auto max-w-28 object-contain">
                                <a href="#"
                                    class="text-text-primary text-sm font-medium underline underline-offset-2 hover:text-primary-600 transition-colors">See
                                    the case study</a>
                            </div>
                            <div class="w-full h-40 rounded-xl mb-5 overflow-hidden">
                                <img src="https://dapulse-res.cloudinary.com/image/upload/f_auto,q_auto/remote_mondaycom_static/uploads/MaayanDagan/63f73c80-46ae-4158-871d-c4ee43bf3a1e_HOLT5.png"
                                    alt="HOLT CAT case study" class="w-full h-full object-cover">
                            </div>
                            <div class="flex items-center gap-3 mb-4">
                                <span class="text-5xl font-bold text-text-primary"
                                    style="font-family: 'Poppins', sans-serif;">105K</span>
                                <span class="text-text-secondary text-base leading-tight">Hours
                                    saved<br>annually</span>
                            </div>
                            <div class="border-t border-border-light pt-4">
                                <span
                                    class="inline-block px-3 py-1.5 border border-border-light rounded-full text-sm text-text-secondary">Manufacturing</span>
                            </div>
                        </div>

                        {{-- Canva Card --}}
                        <div class="shrink-0 w-full sm:w-[calc(50%-12px)] lg:w-[calc(33.333%-16px)] xl:w-[calc(25%-18px)] bg-white rounded-2xl p-6"
                            style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                            <div class="flex items-center justify-between mb-4 h-10">
                                <img src="https://cdn.prod.website-files.com/65b62e80a3a89609079c247a/66fbd753a720abab15120c77_Canva_Logo.svg"
                                    alt="Canva" class="h-8 w-auto max-w-28 object-contain">
                                <a href="#"
                                    class="text-text-primary text-sm font-medium underline underline-offset-2 hover:text-primary-600 transition-colors">See
                                    the case study</a>
                            </div>
                            <div class="w-full h-40 rounded-xl mb-5 overflow-hidden">
                                <img src="https://cdn.prod.website-files.com/65b62e80a3a89609079c247a/6720cc84a8ee5cd3ba51161d_canva.avif"
                                    alt="Canva case study" class="w-full h-full object-cover">
                            </div>
                            <div class="flex items-center gap-3 mb-4">
                                <span class="text-5xl font-bold text-text-primary"
                                    style="font-family: 'Poppins', sans-serif;">300%</span>
                                <span class="text-text-secondary text-base leading-tight">Saved yearly
                                    to<br>reinvest</span>
                            </div>
                            <div class="border-t border-border-light pt-4">
                                <span
                                    class="inline-block px-3 py-1.5 border border-border-light rounded-full text-sm text-text-secondary">Advertising</span>
                            </div>
                        </div>

                        {{-- Vistra Card --}}
                        <div class="shrink-0 w-full sm:w-[calc(50%-12px)] lg:w-[calc(33.333%-16px)] xl:w-[calc(25%-18px)] bg-white rounded-2xl p-6"
                            style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                            <div class="flex items-center justify-between mb-4 h-10">
                                <img src="https://cdn.prod.website-files.com/65b62e80a3a89609079c247a/67e308bf93fb14fdddd63880_Vistra_Logo_Vistra_Blue_RGB_b4198462-0d47-4a43-8524-1b55ebf4082c_1024x.avif"
                                    alt="Vistra" class="h-6 w-auto max-w-28 object-contain">
                                <a href="#"
                                    class="text-text-primary text-sm font-medium underline underline-offset-2 hover:text-primary-600 transition-colors">See
                                    the case study</a>
                            </div>
                            <div class="w-full h-40 rounded-xl mb-5 overflow-hidden">
                                <img src="https://cdn.prod.website-files.com/65b62e80a3a89609079c247a/67e30e370a822e0ddc743d9b_verne-ho-0LAJfSNa-xQ-unsplash.avif"
                                    alt="Vistra case study" class="w-full h-full object-cover">
                            </div>
                            <div class="flex items-center gap-3 mb-4">
                                <span class="text-5xl font-bold text-text-primary"
                                    style="font-family: 'Poppins', sans-serif;">28%</span>
                                <span class="text-text-secondary text-base leading-tight">Faster time
                                    to<br>market</span>
                            </div>
                            <div class="border-t border-border-light pt-4">
                                <span
                                    class="inline-block px-3 py-1.5 border border-border-light rounded-full text-sm text-text-secondary">Technology</span>
                            </div>
                        </div>

                        {{-- Universal Music Group Card --}}
                        <div class="shrink-0 w-full sm:w-[calc(50%-12px)] lg:w-[calc(33.333%-16px)] xl:w-[calc(25%-18px)] bg-white rounded-2xl p-6"
                            style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                            <div class="flex items-center justify-between mb-4 h-10">
                                <img src="https://dapulse-res.cloudinary.com/image/upload/f_auto,q_auto/remote_mondaycom_static/img/customers/logos-v2/universal.png"
                                    alt="Universal Music Group" class="h-10 w-auto max-w-28 object-contain">
                                <a href="#"
                                    class="text-text-primary text-sm font-medium underline underline-offset-2 hover:text-primary-600 transition-colors">See
                                    the case study</a>
                            </div>
                            <div class="w-full h-40 rounded-xl mb-5 overflow-hidden">
                                <img src="{{ Vite::asset('resources/images/hp_cusromers-srory-5.webp') }}"
                                    alt="Universal Music Group case study" class="w-full h-full object-cover">
                            </div>
                            <div class="flex items-center gap-3 mb-4">
                                <span class="text-5xl font-bold text-text-primary"
                                    style="font-family: 'Poppins', sans-serif;">517%</span>
                                <span class="text-text-secondary text-base leading-tight">Growth in
                                    annual<br>accounts</span>
                            </div>
                            <div class="border-t border-border-light pt-4">
                                <span
                                    class="inline-block px-3 py-1.5 border border-border-light rounded-full text-sm text-text-secondary">Entertainment</span>
                            </div>
                        </div>

                        {{-- Compass Card --}}
                        <div class="shrink-0 w-full sm:w-[calc(50%-12px)] lg:w-[calc(33.333%-16px)] xl:w-[calc(25%-18px)] bg-white rounded-2xl p-6"
                            style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                            <div class="flex items-center justify-between mb-4 h-10">
                                <img src="https://cdn.prod.website-files.com/65b62e80a3a89609079c247a/66fe4e1ab5f3de574e762686_compass.svg"
                                    alt="Compass" class="h-6 w-auto max-w-28 object-contain">
                                <a href="#"
                                    class="text-text-primary text-sm font-medium underline underline-offset-2 hover:text-primary-600 transition-colors">See
                                    the case study</a>
                            </div>
                            <div class="w-full h-40 rounded-xl mb-5 overflow-hidden">
                                <img src="https://cdn.prod.website-files.com/65b62e80a3a89609079c247a/6720cd94d5cf9e8b0e3e4be5_compass.avif"
                                    alt="Compass case study" class="w-full h-full object-cover">
                            </div>
                            <div class="flex items-center gap-3 mb-4">
                                <span class="text-5xl font-bold text-text-primary"
                                    style="font-family: 'Poppins', sans-serif;">$173K</span>
                                <span class="text-text-secondary text-base leading-tight">Saved per<br>month</span>
                            </div>
                            <div class="border-t border-border-light pt-4">
                                <span
                                    class="inline-block px-3 py-1.5 border border-border-light rounded-full text-sm text-text-secondary">Real
                                    estate</span>
                            </div>
                        </div>

                        {{-- VML Card --}}
                        <div class="shrink-0 w-full sm:w-[calc(50%-12px)] lg:w-[calc(33.333%-16px)] xl:w-[calc(25%-18px)] bg-white rounded-2xl p-6"
                            style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                            <div class="flex items-center justify-between mb-4 h-10">
                                <img src="https://cdn.prod.website-files.com/65b62e80a3a89609079c247a/66fbc36c01eba16bf8a29247_VML.svg"
                                    alt="VML" class="h-6 w-auto max-w-28 object-contain">
                                <a href="#"
                                    class="text-text-primary text-sm font-medium underline underline-offset-2 hover:text-primary-600 transition-colors">See
                                    the case study</a>
                            </div>
                            <div class="w-full h-40 rounded-xl mb-5 overflow-hidden">
                                <img src="https://cdn.prod.website-files.com/65b62e80a3a89609079c247a/6720e6a6096540e78d4c7c50_Screenshot%202024-10-29%20at%2015.43.43.avif"
                                    alt="VML case study" class="w-full h-full object-cover">
                            </div>
                            <div class="flex items-center gap-3 mb-4">
                                <span class="text-5xl font-bold text-text-primary"
                                    style="font-family: 'Poppins', sans-serif;">$250K</span>
                                <span class="text-text-secondary text-base leading-tight">Saved yearly
                                    to<br>reinvest</span>
                            </div>
                            <div class="border-t border-border-light pt-4">
                                <span
                                    class="inline-block px-3 py-1.5 border border-border-light rounded-full text-sm text-text-secondary">Advertising</span>
                            </div>
                        </div>

                        {{-- Call Box Card --}}
                        <div class="shrink-0 w-full sm:w-[calc(50%-12px)] lg:w-[calc(33.333%-16px)] xl:w-[calc(25%-18px)] bg-white rounded-2xl p-6"
                            style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                            <div class="flex items-center justify-between mb-4 h-10">
                                <img src="https://cdn.prod.website-files.com/65b62e80a3a89609079c247a/6703c06032a4d282266d7374_Call%20Box%20Logo.svg"
                                    alt="Call Box" class="h-6 w-auto max-w-28 object-contain">
                                <a href="#"
                                    class="text-text-primary text-sm font-medium underline underline-offset-2 hover:text-primary-600 transition-colors">See
                                    the case study</a>
                            </div>
                            <div class="w-full h-40 rounded-xl mb-5 overflow-hidden">
                                <img src="https://cdn.prod.website-files.com/65b62e80a3a89609079c247a/6720fe11d4ea96e33f16d8f4_GettyImages-2165167605.avif"
                                    alt="Call Box case study" class="w-full h-full object-cover">
                            </div>
                            <div class="flex items-center gap-3 mb-4">
                                <span class="text-5xl font-bold text-text-primary"
                                    style="font-family: 'Poppins', sans-serif;">66%</span>
                                <span class="text-text-secondary text-base leading-tight">Decrease in post-<br>release
                                    bugs</span>
                            </div>
                            <div class="border-t border-border-light pt-4">
                                <span
                                    class="inline-block px-3 py-1.5 border border-border-light rounded-full text-sm text-text-secondary">Technology</span>
                            </div>
                        </div>

                        {{-- Deezer Card --}}
                        <div class="shrink-0 w-full sm:w-[calc(50%-12px)] lg:w-[calc(33.333%-16px)] xl:w-[calc(25%-18px)] bg-white rounded-2xl p-6"
                            style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                            <div class="flex items-center justify-between mb-4 h-10">
                                <img src="https://cdn.prod.website-files.com/65b62e80a3a89609079c247a/66fd445e4d98faf22b5d93cb_Deezer_logo%2C_2023.svg"
                                    alt="Deezer" class="h-6 w-auto max-w-28 object-contain">
                                <a href="#"
                                    class="text-text-primary text-sm font-medium underline underline-offset-2 hover:text-primary-600 transition-colors">See
                                    the case study</a>
                            </div>
                            <div class="w-full h-40 rounded-xl mb-5 overflow-hidden">
                                <img src="https://cdn.prod.website-files.com/65b62e80a3a89609079c247a/6720e84e5e31406127d92514_deezer.avif"
                                    alt="Deezer case study" class="w-full h-full object-cover">
                            </div>
                            <div class="flex items-center gap-3 mb-4">
                                <span class="text-5xl font-bold text-text-primary"
                                    style="font-family: 'Poppins', sans-serif;">142%</span>
                                <span class="text-text-secondary text-base leading-tight">More
                                    weekly<br>campaigns</span>
                            </div>
                            <div class="border-t border-border-light pt-4">
                                <span
                                    class="inline-block px-3 py-1.5 border border-border-light rounded-full text-sm text-text-secondary">Technology</span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Navigation Arrows & Dots --}}
                <div class="flex items-center justify-between mt-8">
                    {{-- Arrow Buttons --}}
                    <div class="flex gap-3">
                        <button @click="prev()"
                            class="w-12 h-12 rounded-full border border-border-light bg-white flex items-center justify-center transition-colors hover:bg-surface-secondary">
                            <svg class="w-5 h-5 text-text-primary" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 19l-7-7 7-7" />
                            </svg>
                        </button>
                        <button @click="next()"
                            class="w-12 h-12 rounded-full border border-border-light bg-white flex items-center justify-center transition-colors hover:bg-surface-secondary">
                            <svg class="w-5 h-5 text-text-primary" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5l7 7-7 7" />
                            </svg>
                        </button>
                    </div>

                    {{-- Dot Indicators --}}
                    <div class="flex gap-2">
                        <template x-for="i in (maxIndex + 1)" :key="i">
                            <button @click="goTo(i - 1)"
                                :class="currentIndex === (i - 1) ? 'bg-dark-300 w-6' : 'bg-dark-200 w-2 hover:bg-dark-300'"
                                class="h-2 rounded-full transition-all duration-300">
                            </button>
                        </template>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Section 6: Trusted By / Social Proof --}}
    <section class="bg-surface-secondary border-y border-border-light py-16">
        <div class="max-w-7xl mx-auto px-6">
            <p class="text-center text-text-tertiary text-sm uppercase tracking-wider mb-10">
                Több mint 500+ vállalat bízik bennünk
            </p>

            {{-- Logo cloud --}}
            <div
                class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-8 items-center justify-items-center opacity-60">
                {{-- Placeholder logos - replace with actual client logos --}}
                <div class="flex items-center justify-center h-12">
                    <div class="flex items-center gap-2 text-dark-400">
                        <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"></path>
                        </svg>
                        <span class="font-semibold text-lg">TechCorp</span>
                    </div>
                </div>
                <div class="flex items-center justify-center h-12">
                    <div class="flex items-center gap-2 text-dark-400">
                        <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24">
                            <circle cx="12" cy="12" r="10"></circle>
                        </svg>
                        <span class="font-semibold text-lg">Globex</span>
                    </div>
                </div>
                <div class="flex items-center justify-center h-12">
                    <div class="flex items-center gap-2 text-dark-400">
                        <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24">
                            <rect x="3" y="3" width="18" height="18" rx="2"></rect>
                        </svg>
                        <span class="font-semibold text-lg">Initech</span>
                    </div>
                </div>
                <div class="flex items-center justify-center h-12">
                    <div class="flex items-center gap-2 text-dark-400">
                        <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24">
                            <polygon points="12 2 22 8.5 22 15.5 12 22 2 15.5 2 8.5 12 2"></polygon>
                        </svg>
                        <span class="font-semibold text-lg">Umbrella</span>
                    </div>
                </div>
                <div class="flex items-center justify-center h-12">
                    <div class="flex items-center gap-2 text-dark-400">
                        <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z">
                            </path>
                        </svg>
                        <span class="font-semibold text-lg">Hooli</span>
                    </div>
                </div>
                <div class="flex items-center justify-center h-12">
                    <div class="flex items-center gap-2 text-dark-400">
                        <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                        </svg>
                        <span class="font-semibold text-lg">Stark</span>
                    </div>
                </div>
            </div>

            {{-- Stats --}}
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 mt-16">
                <div class="text-center">
                    <div class="text-4xl font-bold text-text-primary mb-2">500+</div>
                    <div class="text-text-secondary">Elégedett ügyfél</div>
                </div>
                <div class="text-center">
                    <div class="text-4xl font-bold text-text-primary mb-2">99.9%</div>
                    <div class="text-text-secondary">Üzemidő garancia</div>
                </div>
                <div class="text-center">
                    <div class="text-4xl font-bold text-text-primary mb-2">24/7</div>
                    <div class="text-text-secondary">Támogatás</div>
                </div>
                <div class="text-center">
                    <div class="text-4xl font-bold text-text-primary mb-2">346%</div>
                    <div class="text-text-secondary">Átlagos ROI</div>
                </div>
            </div>
        </div>
    </section>

    {{-- Section 3: Features / Value Proposition --}}
    <section id="features" class="bg-surface-primary py-24">
        <div class="max-w-7xl mx-auto px-6">
            {{-- Section header --}}
            <div class="text-center max-w-3xl mx-auto mb-16">
                <span class="badge badge-primary mb-4">Funkciók</span>
                <h2 class="text-3xl md:text-4xl font-bold text-text-primary mb-6">
                    Minden, amire szüksége van egy helyen
                </h2>
                <p class="text-lg text-text-secondary">
                    Fedezze fel azokat a funkciókat, amelyek segítenek hatékonyabban dolgozni és gyorsabban elérni
                    céljait.
                </p>
            </div>

            {{-- Features grid --}}
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                {{-- Feature 1 --}}
                <div class="card p-8 hover:shadow-lg transition-shadow duration-300 group">
                    <div
                        class="w-14 h-14 bg-primary-100 rounded-xl flex items-center justify-center mb-6 group-hover:bg-primary-500 transition-colors duration-300">
                        <svg class="w-7 h-7 text-primary-600 group-hover:text-white transition-colors duration-300"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01">
                            </path>
                        </svg>
                    </div>
                    <h4 class="text-xl font-semibold text-text-primary mb-3">Feladatkezelés</h4>
                    <p class="text-text-secondary mb-4">
                        Szervezze és kövesse nyomon feladatait egyszerűen. Hozzon létre határidőket, rendeljen
                        felelősöket és figyelje a haladást valós időben.
                    </p>
                    <a href="#"
                        class="inline-flex items-center gap-2 text-primary-600 font-medium hover:text-primary-800 transition-colors">
                        <span>Tudjon meg többet</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                            </path>
                        </svg>
                    </a>
                </div>

                {{-- Feature 2 --}}
                <div class="card p-8 hover:shadow-lg transition-shadow duration-300 group">
                    <div
                        class="w-14 h-14 bg-success-100 rounded-xl flex items-center justify-center mb-6 group-hover:bg-success-500 transition-colors duration-300">
                        <svg class="w-7 h-7 text-success-600 group-hover:text-white transition-colors duration-300"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                    <h4 class="text-xl font-semibold text-text-primary mb-3">Automatizálás</h4>
                    <p class="text-text-secondary mb-4">
                        Szabadítsa fel idejét automatizált munkafolyamatokkal. Állítson be triggereket és akciókat kód
                        nélkül, percek alatt.
                    </p>
                    <a href="#"
                        class="inline-flex items-center gap-2 text-primary-600 font-medium hover:text-primary-800 transition-colors">
                        <span>Tudjon meg többet</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                            </path>
                        </svg>
                    </a>
                </div>

                {{-- Feature 3 --}}
                <div class="card p-8 hover:shadow-lg transition-shadow duration-300 group">
                    <div
                        class="w-14 h-14 bg-warning-100 rounded-xl flex items-center justify-center mb-6 group-hover:bg-warning-500 transition-colors duration-300">
                        <svg class="w-7 h-7 text-warning-600 group-hover:text-white transition-colors duration-300"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
                            </path>
                        </svg>
                    </div>
                    <h4 class="text-xl font-semibold text-text-primary mb-3">Riportok és elemzések</h4>
                    <p class="text-text-secondary mb-4">
                        Hozzon döntéseket adatok alapján. Részletes riportok és dashboardok segítenek megérteni
                        teljesítményét.
                    </p>
                    <a href="#"
                        class="inline-flex items-center gap-2 text-primary-600 font-medium hover:text-primary-800 transition-colors">
                        <span>Tudjon meg többet</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                            </path>
                        </svg>
                    </a>
                </div>

                {{-- Feature 4 --}}
                <div class="card p-8 hover:shadow-lg transition-shadow duration-300 group">
                    <div
                        class="w-14 h-14 bg-danger-100 rounded-xl flex items-center justify-center mb-6 group-hover:bg-danger-500 transition-colors duration-300">
                        <svg class="w-7 h-7 text-danger-600 group-hover:text-white transition-colors duration-300"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                            </path>
                        </svg>
                    </div>
                    <h4 class="text-xl font-semibold text-text-primary mb-3">Csapatmunka</h4>
                    <p class="text-text-secondary mb-4">
                        Dolgozzon együtt csapatával valós időben. Osszon meg fájlokat, kommunikáljon és tartsa mindenkit
                        naprakészen.
                    </p>
                    <a href="#"
                        class="inline-flex items-center gap-2 text-primary-600 font-medium hover:text-primary-800 transition-colors">
                        <span>Tudjon meg többet</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                            </path>
                        </svg>
                    </a>
                </div>

                {{-- Feature 5 --}}
                <div class="card p-8 hover:shadow-lg transition-shadow duration-300 group">
                    <div
                        class="w-14 h-14 bg-primary-100 rounded-xl flex items-center justify-center mb-6 group-hover:bg-primary-500 transition-colors duration-300">
                        <svg class="w-7 h-7 text-primary-600 group-hover:text-white transition-colors duration-300"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 4a2 2 0 114 0v1a1 1 0 001 1h3a1 1 0 011 1v3a1 1 0 01-1 1h-1a2 2 0 100 4h1a1 1 0 011 1v3a1 1 0 01-1 1h-3a1 1 0 01-1-1v-1a2 2 0 10-4 0v1a1 1 0 01-1 1H7a1 1 0 01-1-1v-3a1 1 0 00-1-1H4a2 2 0 110-4h1a1 1 0 001-1V7a1 1 0 011-1h3a1 1 0 001-1V4z">
                            </path>
                        </svg>
                    </div>
                    <h4 class="text-xl font-semibold text-text-primary mb-3">Integrációk</h4>
                    <p class="text-text-secondary mb-4">
                        Kapcsolja össze kedvenc eszközeit. 50+ integráció érhető el, beleértve a Google, Microsoft és
                        Slack alkalmazásokat.
                    </p>
                    <a href="#"
                        class="inline-flex items-center gap-2 text-primary-600 font-medium hover:text-primary-800 transition-colors">
                        <span>Tudjon meg többet</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                            </path>
                        </svg>
                    </a>
                </div>

                {{-- Feature 6 --}}
                <div class="card p-8 hover:shadow-lg transition-shadow duration-300 group">
                    <div
                        class="w-14 h-14 bg-success-100 rounded-xl flex items-center justify-center mb-6 group-hover:bg-success-500 transition-colors duration-300">
                        <svg class="w-7 h-7 text-success-600 group-hover:text-white transition-colors duration-300"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z">
                            </path>
                        </svg>
                    </div>
                    <h4 class="text-xl font-semibold text-text-primary mb-3">Biztonság</h4>
                    <p class="text-text-secondary mb-4">
                        Enterprise szintű biztonság. SOC 2 tanúsítvány, GDPR megfelelőség és végpontok közötti
                        titkosítás.
                    </p>
                    <a href="#"
                        class="inline-flex items-center gap-2 text-primary-600 font-medium hover:text-primary-800 transition-colors">
                        <span>Tudjon meg többet</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                            </path>
                        </svg>
                    </a>
                </div>
            </div>

            {{-- Bottom CTA --}}
            <div class="text-center mt-16">
                <a href="{{ route('register') }}" class="btn btn-primary btn-lg">
                    Próbálja ki ingyen
                </a>
                <p class="text-text-tertiary text-sm mt-4">
                    Nincs bankkártya szükséges • 14 napos ingyenes próbaidőszak
                </p>
            </div>
        </div>
    </section>
</x-layouts.app>
