<x-layouts.app>
    {{-- Section 1: Hero (Zoho layout + Monday.com style) --}}
    <section class="bg-linear-to-b from-primary-50/60 to-surface-secondary">
        <div class="max-w-7xl mx-auto px-6 py-16 lg:py-24">
            <div class="flex flex-col lg:flex-row gap-12 lg:gap-16 items-center">
                {{-- Left: Content --}}
                <div class="flex-1">
                    {{-- Gradient badge --}}
                    <div class="inline-flex items-center px-4 py-1.5 rounded-full border border-border-light/80 bg-surface-primary mb-8"
                        style="box-shadow: 0 1px 3px rgba(0,0,0,0.04), 0 1px 2px rgba(0,0,0,0.02);">
                        <span
                            class="w-1.5 h-1.5 rounded-full bg-linear-to-r from-success-500 via-warning-500 to-danger-500 mr-2.5"></span>
                        <span class="text-sm font-medium text-text-primary">{{ __('Enterprise management platform') }}</span>
                    </div>

                    {{-- Main headline --}}
                    <h1 class="text-4xl md:text-5xl lg:text-[3.5rem] text-text-primary leading-[1.15] tracking-tight mb-6"
                        style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                        {{ __('Take control of your company') }}<br>
                        {{ __('— from a single system') }}
                    </h1>

                    {{-- Subheadline --}}
                    <p class="text-xl lg:text-2xl text-text-secondary mb-8 leading-relaxed">
                        {{ __('Customized enterprise management solutions for industrial companies: CRM, controlling, procurement, sales, AI-based SEO analysis and automated workflows — that deliver real results.') }}
                    </p>

                    {{-- CTA Button --}}
                    <a href="{{ route('register') }}"
                        class="inline-flex items-center gap-2 px-6 py-3 bg-primary-600 text-white rounded-full text-base font-medium hover:bg-primary-700 transition-colors"
                        style="box-shadow: 0 1px 2px rgba(0,0,0,0.05);">
                        <span>{{ __('Request a demo') }}</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                        </svg>
                    </a>

                    {{-- No credit card text --}}
                    <p class="text-sm text-text-tertiary mt-4 flex items-center gap-2">
                        {{-- <span>{{ __('Start without a credit card') }}</span>
                        <span class="text-text-disabled">✦</span> --}}
                        <span>{{ __('Personalized demo in 30 minutes') }}</span>
                    </p>
                </div>

                {{-- Right: Card (Zoho vertical layout) --}}
                <div class="bg-surface-primary rounded-2xl p-8 w-full lg:w-[520px] shrink-0"
                    style="box-shadow: 0 12px 50px -6px rgba(96, 92, 212, 0.35), 0 0 1px rgba(96, 92, 212, 0.2);">
                    <p class="text-[11px] font-semibold text-text-tertiary uppercase tracking-widest mb-6">{{ __('Our modules') }}
                    </p>

                    <div class="grid grid-cols-2 gap-x-6 gap-y-5">
                        <a href="{{ route('products.szerviz') }}" class="flex items-center gap-3.5 group">
                            <x-module-icon module="szerviz" size="md" rounded="full" />
                            <div class="flex-1 min-w-0">
                                <p
                                    class="text-base font-semibold text-text-primary leading-none group-hover:text-primary-600 transition-colors">
                                    {{ __('Digital Worksheet') }}</p>
                                <p class="text-xs text-text-tertiary mt-1">{{ __('Worksheets for on-site jobs.') }}</p>
                            </div>
                        </a>
                        <a href="{{ route('products.kontrolling') }}" class="flex items-center gap-3.5 group">
                            <x-module-icon module="kontrolling" size="md" rounded="full" />
                            <div class="flex-1 min-w-0">
                                <p
                                    class="text-base font-semibold text-text-primary leading-none group-hover:text-primary-600 transition-colors">
                                    {{ __('Controlling') }}</p>
                                <p class="text-xs text-text-tertiary mt-1">{{ __('Financial overview and reports.') }}</p>
                            </div>
                        </a>
                        <a href="{{ route('products.seo') }}" class="flex items-center gap-3.5 group">
                            <x-module-icon module="seo" size="md" rounded="full" />
                            <div class="flex-1 min-w-0">
                                <p
                                    class="text-base font-semibold text-text-primary leading-none group-hover:text-primary-600 transition-colors">
                                    {{ __('SEO Tool') }}</p>
                                <p class="text-xs text-text-tertiary mt-1">{{ __('AI-based search engine optimization.') }}</p>
                            </div>
                        </a>
                        <a href="{{ route('products.crm') }}" class="flex items-center gap-3.5 group">
                            <x-module-icon module="crm" size="md" rounded="full" />
                            <div class="flex-1 min-w-0">
                                <p
                                    class="text-base font-semibold text-text-primary leading-none group-hover:text-primary-600 transition-colors">
                                    CRM</p>
                                <p class="text-xs text-text-tertiary mt-1">{{ __('Customer management to contract.') }}</p>
                            </div>
                        </a>
                        <a href="{{ route('products.beszerzes') }}" class="flex items-center gap-3.5 group">
                            <x-module-icon module="beszerzes" size="md" rounded="full" />
                            <div class="flex-1 min-w-0">
                                <p
                                    class="text-base font-semibold text-text-primary leading-none group-hover:text-primary-600 transition-colors">
                                    {{ __('Procurement') }}</p>
                                <p class="text-xs text-text-tertiary mt-1">{{ __('Inventory and shipping management.') }}</p>
                            </div>
                        </a>
                        <a href="{{ route('products.ertekesites') }}" class="flex items-center gap-3.5 group">
                            <x-module-icon module="ertekesites" size="md" rounded="full" />
                            <div class="flex-1 min-w-0">
                                <p
                                    class="text-base font-semibold text-text-primary leading-none group-hover:text-primary-600 transition-colors">
                                    {{ __('Sales') }}</p>
                                <p class="text-xs text-text-tertiary mt-1">{{ __('Quotes and orders.') }}</p>
                            </div>
                        </a>
                        <a href="{{ route('products.gyartas') }}" class="flex items-center gap-3.5 group">
                            <x-module-icon module="gyartas" size="md" rounded="full" />
                            <div class="flex-1 min-w-0">
                                <p
                                    class="text-base font-semibold text-text-primary leading-none group-hover:text-primary-600 transition-colors">
                                    {{ __('Production Management') }}</p>
                                <p class="text-xs text-text-tertiary mt-1">{{ __('Production and capacity planning.') }}</p>
                            </div>
                        </a>
                        <a href="{{ route('products.automatizalas') }}" class="flex items-center gap-3.5 group">
                            <x-module-icon module="automatizalas" size="md" rounded="full" />
                            <div class="flex-1 min-w-0">
                                <p
                                    class="text-base font-semibold text-text-primary leading-none group-hover:text-primary-600 transition-colors">
                                    {{ __('Automation') }}</p>
                                <p class="text-xs text-text-tertiary mt-1">{{ __('Workflows and triggers.') }}</p>
                            </div>
                        </a>
                        <a href="{{ route('products.marketinghub') }}" class="flex items-center gap-3.5 group">
                            <x-module-icon module="marketinghub" size="md" rounded="full" />
                            <div class="flex-1 min-w-0">
                                <p
                                    class="text-base font-semibold text-text-primary leading-none group-hover:text-primary-600 transition-colors">
                                    MarketingHub</p>
                                <p class="text-xs text-text-tertiary mt-1">{{ __('Online marketing tools.') }}</p>
                            </div>
                        </a>
                        <a href="{{ route('products.datamind') }}" class="flex items-center gap-3.5 group">
                            <x-module-icon module="datamind" size="md" rounded="full" />
                            <div class="flex-1 min-w-0">
                                <p
                                    class="text-base font-semibold text-text-primary leading-none group-hover:text-primary-600 transition-colors">
                                    DataMind</p>
                                <p class="text-xs text-text-tertiary mt-1">{{ __('AI data mining platform.') }}</p>
                            </div>
                        </a>
                        <a href="{{ route('products.aichat') }}" class="flex items-center gap-3.5 group">
                            <x-module-icon module="ai-chat" size="md" rounded="full" />
                            <div class="flex-1 min-w-0">
                                <p
                                    class="text-base font-semibold text-text-primary leading-none group-hover:text-primary-600 transition-colors">
                                    AI Chat</p>
                                <p class="text-xs text-text-tertiary mt-1">{{ __('Intelligent chatbot for websites.') }}</p>
                            </div>
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </section>

    {{-- Section 2: Tabbed Product Showcase --}}
    <section class="bg-surface-secondary py-16" x-data="{ activeTab: 'szerviz' }">
        <div class="max-w-7xl mx-auto px-6">
            {{-- Tab Navigation --}}
            <div class="flex justify-center mb-12">
                <div class="inline-flex items-center bg-surface-primary rounded-full p-1.5 border border-border-light"
                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <button @click="activeTab = 'szerviz'"
                        :class="activeTab === 'szerviz' ? 'bg-cyan-500 text-white' :
                            'text-text-secondary hover:text-text-primary'"
                        class="px-6 py-2.5 rounded-full text-sm font-medium transition-all duration-200">{{ __('Worksheet') }}</button>
                    <button @click="activeTab = 'projects'"
                        :class="activeTab === 'projects' ? 'bg-primary-600 text-white' :
                            'text-text-secondary hover:text-text-primary'"
                        class="px-6 py-2.5 rounded-full text-sm font-medium transition-all duration-200">{{ __('Controlling') }}</button>
                    <button @click="activeTab = 'seo'"
                        :class="activeTab === 'seo' ? 'bg-violet-600 text-white' :
                            'text-text-secondary hover:text-text-primary'"
                        class="px-6 py-2.5 rounded-full text-sm font-medium transition-all duration-200">SEO</button>
                    <button @click="activeTab = 'sales'"
                        :class="activeTab === 'sales' ? 'bg-[#0f7b6c] text-white' :
                            'text-text-secondary hover:text-text-primary'"
                        class="px-6 py-2.5 rounded-full text-sm font-medium transition-all duration-200">CRM</button>
                    <button @click="activeTab = 'marketing'"
                        :class="activeTab === 'marketing' ? 'bg-primary-500 text-white' :
                            'text-text-secondary hover:text-text-primary'"
                        class="px-6 py-2.5 rounded-full text-sm font-medium transition-all duration-200">{{ __('Sales') }}</button>
                    <button @click="activeTab = 'itops'"
                        :class="activeTab === 'itops' ? 'bg-[#7a1a42] text-white' :
                            'text-text-secondary hover:text-text-primary'"
                        class="px-6 py-2.5 rounded-full text-sm font-medium transition-all duration-200">{{ __('Procurement') }}</button>
                    <button @click="activeTab = 'engineering'"
                        :class="activeTab === 'engineering' ? 'bg-success-600 text-white' :
                            'text-text-secondary hover:text-text-primary'"
                        class="px-6 py-2.5 rounded-full text-sm font-medium transition-all duration-200">{{ __('Automation') }}</button>
                    <button @click="activeTab = 'marketinghub'"
                        :class="activeTab === 'marketinghub' ? 'bg-pink-500 text-white' :
                            'text-text-secondary hover:text-text-primary'"
                        class="px-6 py-2.5 rounded-full text-sm font-medium transition-all duration-200">{{ __('Marketing') }}</button>
                    <button @click="activeTab = 'datamind'"
                        :class="activeTab === 'datamind' ? 'bg-violet-500 text-white' :
                            'text-text-secondary hover:text-text-primary'"
                        class="px-6 py-2.5 rounded-full text-sm font-medium transition-all duration-200">DataMind</button>
                    <button @click="activeTab = 'aichat'"
                        :class="activeTab === 'aichat' ? 'bg-blue-500 text-white' :
                            'text-text-secondary hover:text-text-primary'"
                        class="px-6 py-2.5 rounded-full text-sm font-medium transition-all duration-200">AI Chat</button>
                    <button @click="activeTab = 'leadership'"
                        :class="activeTab === 'leadership' ? 'bg-primary-600 text-white' :
                            'text-text-secondary hover:text-text-primary'"
                        class="px-6 py-2.5 rounded-full text-sm font-medium transition-all duration-200">{{ __('Leadership') }}</button>
                </div>
            </div>

            {{-- Tab Content --}}
            <div class="flex flex-col lg:flex-row gap-6 items-stretch">
                {{-- Left: Colored Product Card --}}
                <div class="lg:w-130 shrink-0">
                    {{-- Kontrolling Tab --}}
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
                                        class="font-bold">cégem360</strong> {{ __('controlling') }}</span>
                            </div>
                            <h3 class="text-white text-4xl lg:text-5xl font-light leading-tight mb-6"
                                style="font-family: 'Poppins', sans-serif;">{{ __('See your company\'s finances') }}<br>{{ __('in real time') }}</h3>
                            <p class="text-white/80 text-lg lg:text-xl leading-relaxed mb-8">{{ __('Track revenues, costs and cash flow on a single dashboard. Instant reports help you make decisions.') }}
                            </p>
                        </div>
                        <a href="#"
                            class="inline-flex items-center gap-2 bg-white text-text-primary px-6 py-3 rounded-full text-sm font-medium hover:bg-light-200 transition-colors w-fit">
                            {{ __('Request a demo') }}
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 8l4 4m0 0l-4 4m4-4H3" />
                            </svg>
                        </a>
                    </div>

                    {{-- SEO Tab --}}
                    <div x-show="activeTab === 'seo'" x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                        class="bg-violet-600 rounded-3xl p-10 h-full flex flex-col justify-between min-h-120">
                        <div>
                            <div class="flex items-center gap-2 mb-8">
                                <div class="w-8 h-8 bg-white/20 rounded-lg flex items-center justify-center">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                    </svg>
                                </div>
                                <span class="text-white/90 text-sm font-medium"><strong
                                        class="font-bold">cégem360</strong> SEO</span>
                            </div>
                            <h3 class="text-white text-4xl lg:text-5xl font-light leading-tight mb-6"
                                style="font-family: 'Poppins', sans-serif;">{{ __('Understand what your market') }}<br>{{ __('is searching for — and be') }}<br>{{ __('the first result') }}
                            </h3>
                            <p class="text-white/80 text-lg lg:text-xl leading-relaxed mb-8">{{ __('AI-based keyword research, competitor analysis and content optimization on a single platform. Increase your organic traffic with measurable results.') }}</p>
                        </div>
                        <a href="{{ route('products.seo') }}"
                            class="inline-flex items-center gap-2 bg-white text-text-primary px-6 py-3 rounded-full text-sm font-medium hover:bg-light-200 transition-colors w-fit">
                            {{ __('Request a demo') }}
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 8l4 4m0 0l-4 4m4-4H3" />
                            </svg>
                        </a>
                    </div>

                    {{-- CRM Tab --}}
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
                                        class="font-bold">cégem360</strong> CRM</span>
                            </div>
                            <h3 class="text-white text-4xl lg:text-5xl font-light leading-tight mb-6"
                                style="font-family: 'Poppins', sans-serif;">{{ __('Increase your revenue with') }}<br>{{ __('organized customer management') }}</h3>
                            <p class="text-white/80 text-lg lg:text-xl leading-relaxed mb-8">{{ __('Every customer, quote and contact in one place. Automatic reminders and sales pipeline — so your team can focus on closing.') }}</p>
                        </div>
                        <a href="#"
                            class="inline-flex items-center gap-2 bg-white text-text-primary px-6 py-3 rounded-full text-sm font-medium hover:bg-light-200 transition-colors w-fit">
                            {{ __('Request a demo') }}
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 8l4 4m0 0l-4 4m4-4H3" />
                            </svg>
                        </a>
                    </div>

                    {{-- Értékesítés Tab --}}
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
                                        class="font-bold">cégem360</strong> {{ __('sales') }}</span>
                            </div>
                            <h3 class="text-white text-4xl lg:text-5xl font-light leading-tight mb-6"
                                style="font-family: 'Poppins', sans-serif;">{{ __('Measure and increase your') }}<br>{{ __('sales efficiency') }}</h3>
                            <p class="text-white/80 text-lg lg:text-xl leading-relaxed mb-8">{{ __('Integrate sales and marketing activities. Know which campaign brought which customer — increase conversion with data-driven decisions.') }}
                            </p>
                        </div>
                        <a href="#"
                            class="inline-flex items-center gap-2 bg-white text-text-primary px-6 py-3 rounded-full text-sm font-medium hover:bg-light-200 transition-colors w-fit">
                            {{ __('Request a demo') }}
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 8l4 4m0 0l-4 4m4-4H3" />
                            </svg>
                        </a>
                    </div>

                    {{-- IT & Ops Tab → Beszerzés --}}
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
                                        class="font-bold">cégem360</strong> {{ __('procurement') }}</span>
                            </div>
                            <h3 class="text-white text-4xl lg:text-5xl font-light leading-tight mb-6"
                                style="font-family: 'Poppins', sans-serif;">{{ __('Optimize your procurement') }}<br>{{ __('and logistics processes') }}</h3>
                            <p class="text-white/80 text-lg lg:text-xl leading-relaxed mb-8">{{ __('Track your inventory and shipments on a single interface. The system alerts you when intervention is needed — so you can act in time.') }}</p>
                        </div>
                        <a href="#"
                            class="inline-flex items-center gap-2 bg-white text-text-primary px-6 py-3 rounded-full text-sm font-medium hover:bg-light-200 transition-colors w-fit">
                            {{ __('Request a demo') }}
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 8l4 4m0 0l-4 4m4-4H3" />
                            </svg>
                        </a>
                    </div>

                    {{-- Product & Engineering Tab → Automatizálás --}}
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
                                        class="font-bold">cégem360</strong> {{ __('automation') }}</span>
                            </div>
                            <h3 class="text-white text-4xl lg:text-5xl font-light leading-tight mb-6"
                                style="font-family: 'Poppins', sans-serif;">{{ __('Automate your') }}<br>{{ __('repetitive tasks') }}
                            </h3>
                            <p class="text-white/80 text-lg lg:text-xl leading-relaxed mb-8">{{ __('Set rules and let the system work for you. Faster response time, fewer human errors, more time for strategic tasks.') }}</p>
                        </div>
                        <a href="#"
                            class="inline-flex items-center gap-2 bg-white text-text-primary px-6 py-3 rounded-full text-sm font-medium hover:bg-light-200 transition-colors w-fit">
                            {{ __('Request a demo') }}
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 8l4 4m0 0l-4 4m4-4H3" />
                            </svg>
                        </a>
                    </div>

                    {{-- Leadership Tab → Vezetés --}}
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
                                        class="font-bold">cégem360</strong> platform</span>
                            </div>
                            <h3 class="text-white text-4xl lg:text-5xl font-light leading-tight mb-6"
                                style="font-family: 'Poppins', sans-serif;">{{ __('Decide based on data') }}<br>{{ __('not gut feeling') }}
                            </h3>
                            <p class="text-white/80 text-lg lg:text-xl leading-relaxed mb-8">{{ __('Quick overview of the entire company: finance, sales, projects — on one dashboard. Stay in the picture and make the right decisions.') }}</p>
                        </div>
                        <a href="#"
                            class="inline-flex items-center gap-2 bg-white text-text-primary px-6 py-3 rounded-full text-sm font-medium hover:bg-light-200 transition-colors w-fit">
                            {{ __('Request a demo') }}
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 8l4 4m0 0l-4 4m4-4H3" />
                            </svg>
                        </a>
                    </div>

                    {{-- Szerviz Tab --}}
                    <div x-show="activeTab === 'szerviz'" x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                        class="bg-cyan-500 rounded-3xl p-10 h-full flex flex-col justify-between min-h-120">
                        <div>
                            <div class="flex items-center gap-2 mb-8">
                                <div class="w-8 h-8 bg-white/20 rounded-lg flex items-center justify-center">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                                    </svg>
                                </div>
                                <span class="text-white/90 text-sm font-medium"><strong
                                        class="font-bold">cégem360</strong> {{ __('digital worksheet') }}</span>
                            </div>
                            <h3 class="text-white text-4xl lg:text-5xl font-light leading-tight mb-6"
                                style="font-family: 'Poppins', sans-serif;">{{ __('Digital worksheets') }}<br>{{ __('for on-site jobs') }}
                            </h3>
                            <p class="text-white/80 text-lg lg:text-xl leading-relaxed mb-8">{{ __('Forget paper-based worksheets. Record everything on-site: work hours, materials, photos — and create instant reports for your clients.') }}</p>
                        </div>
                        <a href="{{ route('products.szerviz') }}"
                            class="inline-flex items-center gap-2 bg-white text-text-primary px-6 py-3 rounded-full text-sm font-medium hover:bg-light-200 transition-colors w-fit">
                            {{ __('Request a demo') }}
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 8l4 4m0 0l-4 4m4-4H3" />
                            </svg>
                        </a>
                    </div>

                    {{-- MarketingHub Tab --}}
                    <div x-show="activeTab === 'marketinghub'" x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                        class="bg-pink-500 rounded-3xl p-10 h-full flex flex-col justify-between min-h-120">
                        <div>
                            <div class="flex items-center gap-2 mb-8">
                                <x-module-icon module="marketinghub" size="xs" :show-background="false"
                                    color="#ffffff" />
                                <span class="text-white/90 text-sm font-medium"><strong
                                        class="font-bold">cégem360</strong> MarketingHub</span>
                            </div>
                            <h3 class="text-white text-4xl lg:text-5xl font-light leading-tight mb-6"
                                style="font-family: 'Poppins', sans-serif;">{{ __('All marketing data') }}<br>{{ __('in one place') }}</h3>
                            <p class="text-white/80 text-lg lg:text-xl leading-relaxed mb-8">{{ __('Google Ads, Meta, Analytics and SEO results on a single dashboard. See instantly which campaign brings real customers — and which ones to stop spending on.') }}</p>
                        </div>
                        <a href="{{ route('products.marketinghub') }}"
                            class="inline-flex items-center gap-2 bg-white text-text-primary px-6 py-3 rounded-full text-sm font-medium hover:bg-light-200 transition-colors w-fit">
                            {{ __('Request a demo') }}
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 8l4 4m0 0l-4 4m4-4H3" />
                            </svg>
                        </a>
                    </div>

                    {{-- DataMind Tab --}}
                    <div x-show="activeTab === 'datamind'" x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                        class="bg-violet-500 rounded-3xl p-10 h-full flex flex-col justify-between min-h-120">
                        <div>
                            <div class="flex items-center gap-2 mb-8">
                                <x-module-icon module="datamind" size="xs" :show-background="false" color="#ffffff" />
                                <span class="text-white/90 text-sm font-medium"><strong
                                        class="font-bold">cégem360</strong> DataMind</span>
                            </div>
                            <h3 class="text-white text-4xl lg:text-5xl font-light leading-tight mb-6"
                                style="font-family: 'Poppins', sans-serif;">{{ __('Artificial intelligence') }}<br>{{ __('for business decisions') }}</h3>
                            <p class="text-white/80 text-lg lg:text-xl leading-relaxed mb-8">{{ __('Automatic correlation discovery, predictive analysis and drag-and-drop model builder — without coding. Connect multiple data sources on a single dashboard.') }}</p>
                        </div>
                        <a href="{{ route('products.datamind') }}"
                            class="inline-flex items-center gap-2 bg-white text-text-primary px-6 py-3 rounded-full text-sm font-medium hover:bg-light-200 transition-colors w-fit">
                            {{ __('Request a demo') }}
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 8l4 4m0 0l-4 4m4-4H3" />
                            </svg>
                        </a>
                    </div>

                    {{-- AI Chat Tab --}}
                    <div x-show="activeTab === 'aichat'" x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                        class="bg-blue-500 rounded-3xl p-10 h-full flex flex-col justify-between min-h-120">
                        <div>
                            <div class="flex items-center gap-2 mb-8">
                                <x-module-icon module="ai-chat" size="xs" :show-background="false" color="#ffffff" />
                                <span class="text-white/90 text-sm font-medium"><strong
                                        class="font-bold">cégem360</strong> AI Chat</span>
                            </div>
                            <h3 class="text-white text-4xl lg:text-5xl font-light leading-tight mb-6"
                                style="font-family: 'Poppins', sans-serif;">{{ __('Intelligent chatbot') }}<br>{{ __('for your website') }}</h3>
                            <p class="text-white/80 text-lg lg:text-xl leading-relaxed mb-8">{{ __('24/7 automated customer service that knows your products. The chatbot learns from your website content — with your own API key, full control.') }}</p>
                        </div>
                        <a href="{{ route('products.aichat') }}"
                            class="inline-flex items-center gap-2 bg-white text-text-primary px-6 py-3 rounded-full text-sm font-medium hover:bg-light-200 transition-colors w-fit">
                            {{ __('Request a demo') }}
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
                        <p class="text-text-tertiary text-xs uppercase tracking-wider mb-2 font-semibold">{{ __('INDUSTRIAL CLIENT') }}
                        </p>
                        <p class="text-3xl lg:text-4xl font-bold text-text-primary"><span class="text-primary-600">{{ __('30% cost reduction') }}</span><br>{{ __('with real-time data') }}</p>
                    </div>
                    <div x-show="activeTab === 'sales'" x-transition
                        class="bg-surface-primary rounded-2xl p-6 border border-border-light"
                        style="box-shadow: 0 4px 20px -4px rgba(96, 92, 212, 0.12);">
                        <p class="text-text-tertiary text-xs uppercase tracking-wider mb-2 font-semibold">{{ __('OUR PARTNER') }}
                        </p>
                        <p class="text-3xl lg:text-4xl font-bold text-text-primary"><span
                                class="text-[#0f7b6c]">{{ __('40% more quotes') }}</span><br>{{ __('with less admin') }}</p>
                    </div>
                    <div x-show="activeTab === 'marketing'" x-transition
                        class="bg-surface-primary rounded-2xl p-6 border border-border-light"
                        style="box-shadow: 0 4px 20px -4px rgba(96, 92, 212, 0.12);">
                        <p class="text-text-tertiary text-xs uppercase tracking-wider mb-2 font-semibold">{{ __('CRM CLIENT') }}
                        </p>
                        <p class="text-3xl lg:text-4xl font-bold text-text-primary"><span class="text-primary-500">{{ __('2x conversion') }}</span><br>{{ __('with structured data') }}</p>
                    </div>
                    <div x-show="activeTab === 'itops'" x-transition
                        class="bg-surface-primary rounded-2xl p-6 border border-border-light"
                        style="box-shadow: 0 4px 20px -4px rgba(96, 92, 212, 0.12);">
                        <p class="text-text-tertiary text-xs uppercase tracking-wider mb-2 font-semibold">{{ __('LOGISTICS PARTNER') }}</p>
                        <p class="text-3xl lg:text-4xl font-bold text-text-primary"><span class="text-[#7a1a42]">{{ __('20% inventory optimization') }}</span><br>{{ __('with automatic alerts') }}</p>
                    </div>
                    <div x-show="activeTab === 'engineering'" x-transition
                        class="bg-surface-primary rounded-2xl p-6 border border-border-light"
                        style="box-shadow: 0 4px 20px -4px rgba(96, 92, 212, 0.12);">
                        <p class="text-text-tertiary text-xs uppercase tracking-wider mb-2 font-semibold">{{ __('AUTOMATION CLIENT') }}</p>
                        <p class="text-3xl lg:text-4xl font-bold text-text-primary"><span class="text-success-600">{{ __('50% less manual work') }}</span><br>{{ __('with rule-based processes') }}</p>
                    </div>
                    <div x-show="activeTab === 'leadership'" x-transition
                        class="bg-surface-primary rounded-2xl p-6 border border-border-light"
                        style="box-shadow: 0 4px 20px -4px rgba(96, 92, 212, 0.12);">
                        <p class="text-text-tertiary text-xs uppercase tracking-wider mb-2 font-semibold">{{ __('EXECUTIVE CLIENT') }}
                        </p>
                        <p class="text-3xl lg:text-4xl font-bold text-text-primary"><span
                                class="text-primary-600">{{ __('Instant overview') }}</span><br>{{ __('on one dashboard') }}</p>
                    </div>
                    <div x-show="activeTab === 'szerviz'" x-transition
                        class="bg-surface-primary rounded-2xl p-6 border border-border-light"
                        style="box-shadow: 0 4px 20px -4px rgba(96, 92, 212, 0.12);">
                        <p class="text-text-tertiary text-xs uppercase tracking-wider mb-2 font-semibold">{{ __('SERVICE PARTNER') }}
                        </p>
                        <p class="text-3xl lg:text-4xl font-bold text-text-primary"><span class="text-cyan-500">{{ __('70% faster administration') }}</span><br>{{ __('with digital worksheets') }}</p>
                    </div>
                    <div x-show="activeTab === 'seo'" x-transition
                        class="bg-surface-primary rounded-2xl p-6 border border-border-light"
                        style="box-shadow: 0 4px 20px -4px rgba(96, 92, 212, 0.12);">
                        <p class="text-text-tertiary text-xs uppercase tracking-wider mb-2 font-semibold">{{ __('SEO CLIENT') }}
                        </p>
                        <p class="text-3xl lg:text-4xl font-bold text-text-primary"><span class="text-violet-600">{{ __('3x organic traffic') }}</span><br>{{ __('with AI-based optimization') }}</p>
                    </div>
                    <div x-show="activeTab === 'marketinghub'" x-transition
                        class="bg-surface-primary rounded-2xl p-6 border border-border-light"
                        style="box-shadow: 0 4px 20px -4px rgba(96, 92, 212, 0.12);">
                        <p class="text-text-tertiary text-xs uppercase tracking-wider mb-2 font-semibold">{{ __('MARKETING CLIENT') }}</p>
                        <p class="text-3xl lg:text-4xl font-bold text-text-primary"><span class="text-pink-500">{{ __('45% better marketing ROI') }}</span><br>{{ __('with data-driven decisions') }}</p>
                    </div>
                    <div x-show="activeTab === 'datamind'" x-transition
                        class="bg-surface-primary rounded-2xl p-6 border border-border-light"
                        style="box-shadow: 0 4px 20px -4px rgba(96, 92, 212, 0.12);">
                        <p class="text-text-tertiary text-xs uppercase tracking-wider mb-2 font-semibold">{{ __('DATAMIND CLIENT') }}</p>
                        <p class="text-3xl lg:text-4xl font-bold text-text-primary"><span class="text-violet-500">{{ __('3x faster decision making') }}</span><br>{{ __('with AI predictions') }}</p>
                    </div>
                    <div x-show="activeTab === 'aichat'" x-transition
                        class="bg-surface-primary rounded-2xl p-6 border border-border-light"
                        style="box-shadow: 0 4px 20px -4px rgba(96, 92, 212, 0.12);">
                        <p class="text-text-tertiary text-xs uppercase tracking-wider mb-2 font-semibold">{{ __('AI CHAT CLIENT') }}</p>
                        <p class="text-3xl lg:text-4xl font-bold text-text-primary"><span class="text-blue-500">{{ __('85% automatic responses') }}</span><br>{{ __('with 24/7 availability') }}</p>
                    </div>

                    {{-- Testimonial Quote Card --}}
                    <div x-show="activeTab === 'projects'" x-transition
                        class="bg-surface-primary rounded-2xl p-6 border border-border-light flex-1"
                        style="box-shadow: 0 4px 20px -4px rgba(96, 92, 212, 0.12);">
                        <p class="text-text-secondary text-lg leading-relaxed mb-6">"{{ __('I can finally see where the money goes, and why. Our monthly closing went from days to hours.') }}"</p>
                        <div class="flex items-center gap-3">
                            <div
                                class="w-10 h-10 bg-primary-100 rounded-full flex items-center justify-center text-primary-600 font-semibold text-sm">
                                NT</div>
                            <div>
                                <p class="text-text-primary font-semibold text-sm">{{ __('Tamas Nagy') }}</p>
                                <p class="text-text-tertiary text-xs">{{ __('Financial Director, Industrial manufacturing company') }}</p>
                            </div>
                        </div>
                    </div>
                    <div x-show="activeTab === 'sales'" x-transition
                        class="bg-surface-primary rounded-2xl p-6 border border-border-light flex-1"
                        style="box-shadow: 0 4px 20px -4px rgba(96, 92, 212, 0.12);">
                        <p class="text-text-secondary text-lg leading-relaxed mb-6">"{{ __('I know which client we last spoke to, when, and what we promised. No more lost leads.') }}"</p>
                        <div class="flex items-center gap-3">
                            <div
                                class="w-10 h-10 bg-[#0f7b6c]/10 rounded-full flex items-center justify-center text-[#0f7b6c] font-semibold text-sm">
                                KA</div>
                            <div>
                                <p class="text-text-primary font-semibold text-sm">{{ __('Anna Kovacs') }}</p>
                                <p class="text-text-tertiary text-xs">{{ __('Sales Manager, B2B service provider') }}</p>
                            </div>
                        </div>
                    </div>
                    <div x-show="activeTab === 'marketing'" x-transition
                        class="bg-surface-primary rounded-2xl p-6 border border-border-light flex-1"
                        style="box-shadow: 0 4px 20px -4px rgba(96, 92, 212, 0.12);">
                        <p class="text-text-secondary text-lg leading-relaxed mb-6">"{{ __('I can see which campaign brought real buyers — and which ones to stop spending on.') }}"</p>
                        <div class="flex items-center gap-3">
                            <div
                                class="w-10 h-10 bg-primary-100 rounded-full flex items-center justify-center text-primary-600 font-semibold text-sm">
                                SB</div>
                            <div>
                                <p class="text-text-primary font-semibold text-sm">{{ __('Bela Szabo') }}</p>
                                <p class="text-text-tertiary text-xs">{{ __('Marketing Director, Trading company') }}</p>
                            </div>
                        </div>
                    </div>
                    <div x-show="activeTab === 'itops'" x-transition
                        class="bg-surface-primary rounded-2xl p-6 border border-border-light flex-1"
                        style="box-shadow: 0 4px 20px -4px rgba(96, 92, 212, 0.12);">
                        <p class="text-text-secondary text-lg leading-relaxed mb-6">"{{ __('Tracking inventory in Excel used to be a nightmare. Now one click and I see what\'s missing.') }}"</p>
                        <div class="flex items-center gap-3">
                            <div
                                class="w-10 h-10 bg-[#7a1a42]/10 rounded-full flex items-center justify-center text-[#7a1a42] font-semibold text-sm">
                                TG</div>
                            <div>
                                <p class="text-text-primary font-semibold text-sm">{{ __('Gabor Toth') }}</p>
                                <p class="text-text-tertiary text-xs">{{ __('Logistics Manager, Manufacturing company') }}</p>
                            </div>
                        </div>
                    </div>
                    <div x-show="activeTab === 'engineering'" x-transition
                        class="bg-surface-primary rounded-2xl p-6 border border-border-light flex-1"
                        style="box-shadow: 0 4px 20px -4px rgba(96, 92, 212, 0.12);">
                        <p class="text-text-secondary text-lg leading-relaxed mb-6">"{{ __('The system automatically reminds about deadlines and notifies colleagues when a task awaits them. I don\'t need to follow up.') }}"</p>
                        <div class="flex items-center gap-3">
                            <div
                                class="w-10 h-10 bg-success-100 rounded-full flex items-center justify-center text-success-600 font-semibold text-sm">
                                VE</div>
                            <div>
                                <p class="text-text-primary font-semibold text-sm">{{ __('Eszter Varga') }}</p>
                                <p class="text-text-tertiary text-xs">{{ __('Operations Director, Industrial company') }}</p>
                            </div>
                        </div>
                    </div>
                    <div x-show="activeTab === 'leadership'" x-transition
                        class="bg-surface-primary rounded-2xl p-6 border border-border-light flex-1"
                        style="box-shadow: 0 4px 20px -4px rgba(96, 92, 212, 0.12);">
                        <p class="text-text-secondary text-lg leading-relaxed mb-6">"{{ __('With my morning coffee I check the dashboard and know what happened yesterday — across all areas.') }}"</p>
                        <div class="flex items-center gap-3">
                            <div
                                class="w-10 h-10 bg-primary-100 rounded-full flex items-center justify-center text-primary-600 font-semibold text-sm">
                                HP</div>
                            <div>
                                <p class="text-text-primary font-semibold text-sm">{{ __('Peter Horvath') }}</p>
                                <p class="text-text-tertiary text-xs">{{ __('CEO, Mid-sized enterprise') }}</p>
                            </div>
                        </div>
                    </div>
                    <div x-show="activeTab === 'szerviz'" x-transition
                        class="bg-surface-primary rounded-2xl p-6 border border-border-light flex-1"
                        style="box-shadow: 0 4px 20px -4px rgba(96, 92, 212, 0.12);">
                        <p class="text-text-secondary text-lg leading-relaxed mb-6">"{{ __('Since we started using digital worksheets, our invoicing is days faster. Clients are happier too, because they get the report instantly.') }}"</p>
                        <div class="flex items-center gap-3">
                            <div
                                class="w-10 h-10 bg-cyan-100 rounded-full flex items-center justify-center text-cyan-600 font-semibold text-sm">
                                BL</div>
                            <div>
                                <p class="text-text-primary font-semibold text-sm">{{ __('Laszlo Balogh') }}</p>
                                <p class="text-text-tertiary text-xs">{{ __('CEO, KlimaProfi Kft.') }}</p>
                            </div>
                        </div>
                    </div>
                    <div x-show="activeTab === 'seo'" x-transition
                        class="bg-surface-primary rounded-2xl p-6 border border-border-light flex-1"
                        style="box-shadow: 0 4px 20px -4px rgba(96, 92, 212, 0.12);">
                        <p class="text-text-secondary text-lg leading-relaxed mb-6">"{{ __('In three months we tripled our organic traffic. The AI-based keyword suggestions showed exactly what our market is searching for.') }}"</p>
                        <div class="flex items-center gap-3">
                            <div
                                class="w-10 h-10 bg-violet-100 rounded-full flex items-center justify-center text-violet-600 font-semibold text-sm">
                                FM</div>
                            <div>
                                <p class="text-text-primary font-semibold text-sm">{{ __('Marton Feher') }}</p>
                                <p class="text-text-tertiary text-xs">{{ __('Marketing Manager, TechBuild Kft.') }}</p>
                            </div>
                        </div>
                    </div>
                    <div x-show="activeTab === 'marketinghub'" x-transition
                        class="bg-surface-primary rounded-2xl p-6 border border-border-light flex-1"
                        style="box-shadow: 0 4px 20px -4px rgba(96, 92, 212, 0.12);">
                        <p class="text-text-secondary text-lg leading-relaxed mb-6">"{{ __('Finally I can see in one place which campaign brings leads and which just burns the budget. Our monthly report is ready in minutes instead of hours.') }}"</p>
                        <div class="flex items-center gap-3">
                            <div
                                class="w-10 h-10 bg-pink-100 rounded-full flex items-center justify-center text-pink-600 font-semibold text-sm">
                                MK</div>
                            <div>
                                <p class="text-text-primary font-semibold text-sm">{{ __('Kata Molnar') }}</p>
                                <p class="text-text-tertiary text-xs">{{ __('Marketing Director, WebShop Solutions Kft.') }}</p>
                            </div>
                        </div>
                    </div>
                    <div x-show="activeTab === 'datamind'" x-transition
                        class="bg-surface-primary rounded-2xl p-6 border border-border-light flex-1"
                        style="box-shadow: 0 4px 20px -4px rgba(96, 92, 212, 0.12);">
                        <p class="text-text-secondary text-lg leading-relaxed mb-6">"{{ __('DataMind discovered that 30% of our Google Ads campaigns weren\'t converting. Based on the AI recommendations, we reallocated the budget — our ROI grew 25% in 2 months.') }}"</p>
                        <div class="flex items-center gap-3">
                            <div
                                class="w-10 h-10 bg-violet-100 rounded-full flex items-center justify-center text-violet-600 font-semibold text-sm">
                                KP</div>
                            <div>
                                <p class="text-text-primary font-semibold text-sm">{{ __('Peter Kovacs') }}</p>
                                <p class="text-text-tertiary text-xs">{{ __('Marketing Director, Industrial manufacturing company') }}</p>
                            </div>
                        </div>
                    </div>
                    <div x-show="activeTab === 'aichat'" x-transition
                        class="bg-surface-primary rounded-2xl p-6 border border-border-light flex-1"
                        style="box-shadow: 0 4px 20px -4px rgba(96, 92, 212, 0.12);">
                        <p class="text-text-secondary text-lg leading-relaxed mb-6">"{{ __('We installed it in 5 minutes, and that same evening it was answering our guests\' questions. The multilingual support works great with foreign guests too.') }}"</p>
                        <div class="flex items-center gap-3">
                            <div
                                class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center text-blue-600 font-semibold text-sm">
                                SB</div>
                            <div>
                                <p class="text-text-primary font-semibold text-sm">{{ __('Balazs Szabo') }}</p>
                                <p class="text-text-tertiary text-xs">{{ __('Owner, Balaton guesthouse') }}</p>
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
                        {{ __('One system,') }}<br>{{ __('for every business area') }}
                    </h2>

                    {{-- Product Cards Grid --}}
                    <div class="grid grid-cols-2 gap-4">
                        {{-- Work Management Card → Kontrolling --}}
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
                                        <p class="text-lg font-bold text-text-primary">cégem360</p>
                                        <p class="text-base text-text-tertiary -mt-0.5">{{ __('controlling') }}</p>
                                    </div>
                                </div>
                                <p class="text-text-secondary text-lg leading-relaxed mb-5">{{ __('Real-time financial data and reports — decision support in moments.') }}</p>
                                <a href="#"
                                    class="text-text-primary text-base font-semibold underline underline-offset-2 hover:text-primary-600 transition-colors">{{ __('Learn more') }}</a>
                            </div>
                        </div>

                        {{-- SEO Eszköz Card --}}
                        <div class="relative group">
                            <div class="absolute -inset-0.5 rounded-xl opacity-0 group-hover:opacity-100 transition-opacity duration-500 ease-out"
                                style="background: linear-gradient(90deg, #fb275d, #ffcb00, #00ca72, #6161ff);"></div>
                            <div class="relative h-full bg-surface-primary rounded-xl p-7 border border-border-light group-hover:border-transparent transition-colors duration-300"
                                style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                                <div class="flex items-center gap-3 mb-5">
                                    <div class="w-12 h-12 bg-violet-100 rounded-lg flex items-center justify-center">
                                        <svg class="w-7 h-7 text-violet-600" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-lg font-bold text-text-primary">cégem360</p>
                                        <p class="text-base text-text-tertiary -mt-0.5">{{ __('SEO tool') }}</p>
                                    </div>
                                </div>
                                <p class="text-text-secondary text-lg leading-relaxed mb-5">{{ __('AI-based keyword research and competitor analysis — organic traffic growth.') }}</p>
                                <a href="{{ route('products.seo') }}"
                                    class="text-text-primary text-base font-semibold underline underline-offset-2 hover:text-primary-600 transition-colors">{{ __('Learn more') }}</a>
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
                                        <p class="text-lg font-bold text-text-primary">cégem360</p>
                                        <p class="text-base text-text-tertiary -mt-0.5">CRM</p>
                                    </div>
                                </div>
                                <p class="text-text-secondary text-lg leading-relaxed mb-5">{{ __('Transparent customer management — from first contact to closed deal.') }}</p>
                                <a href="#"
                                    class="text-text-primary text-base font-semibold underline underline-offset-2 hover:text-primary-600 transition-colors">{{ __('Learn more') }}</a>
                            </div>
                        </div>

                        {{-- Dev Card → Beszerzés --}}
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
                                        <p class="text-lg font-bold text-text-primary">cégem360</p>
                                        <p class="text-base text-text-tertiary -mt-0.5">{{ __('procurement') }}</p>
                                    </div>
                                </div>
                                <p class="text-text-secondary text-lg leading-relaxed mb-5">{{ __('Inventory tracking and shipments — on one interface, in real time.') }}</p>
                                <a href="#"
                                    class="text-text-primary text-base font-semibold underline underline-offset-2 hover:text-primary-600 transition-colors">{{ __('Learn more') }}</a>
                            </div>
                        </div>

                        {{-- MarketingHub Card --}}
                        <div class="relative group">
                            <div class="absolute -inset-0.5 rounded-xl opacity-0 group-hover:opacity-100 transition-opacity duration-500 ease-out"
                                style="background: linear-gradient(90deg, #fb275d, #ffcb00, #00ca72, #6161ff);"></div>
                            <div class="relative h-full bg-surface-primary rounded-xl p-7 border border-border-light group-hover:border-transparent transition-colors duration-300"
                                style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                                <div class="flex items-center gap-3 mb-5">
                                    <x-module-icon module="marketinghub" size="md" />
                                    <div>
                                        <p class="text-lg font-bold text-text-primary">cégem360</p>
                                        <p class="text-base text-text-tertiary -mt-0.5">MarketingHub</p>
                                    </div>
                                </div>
                                <p class="text-text-secondary text-lg leading-relaxed mb-5">{{ __('Online marketing channels and campaign performance — on one dashboard.') }}</p>
                                <a href="{{ route('products.marketinghub') }}"
                                    class="text-text-primary text-base font-semibold underline underline-offset-2 hover:text-primary-600 transition-colors">{{ __('Learn more') }}</a>
                            </div>
                        </div>

                        {{-- DataMind Card --}}
                        <div class="relative group">
                            <div class="absolute -inset-0.5 rounded-xl opacity-0 group-hover:opacity-100 transition-opacity duration-500 ease-out"
                                style="background: linear-gradient(90deg, #fb275d, #ffcb00, #00ca72, #6161ff);"></div>
                            <div class="relative h-full bg-surface-primary rounded-xl p-7 border border-border-light group-hover:border-transparent transition-colors duration-300"
                                style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                                <div class="flex items-center gap-3 mb-5">
                                    <x-module-icon module="datamind" size="md" />
                                    <div>
                                        <p class="text-lg font-bold text-text-primary">cégem360</p>
                                        <p class="text-base text-text-tertiary -mt-0.5">DataMind</p>
                                    </div>
                                </div>
                                <p class="text-text-secondary text-lg leading-relaxed mb-5">{{ __('AI-based data mining platform — predictive analysis and correlation discovery.') }}</p>
                                <a href="{{ route('products.datamind') }}"
                                    class="text-text-primary text-base font-semibold underline underline-offset-2 hover:text-primary-600 transition-colors">{{ __('Learn more') }}</a>
                            </div>
                        </div>

                    </div>
                </div>

                {{-- Right Column: Description + CTA + Image --}}
                <div class="lg:w-1/2 flex flex-col">
                    {{-- Description and CTAs --}}
                    <div class="mb-8">
                        <p class="text-text-secondary text-xl lg:text-2xl leading-relaxed mb-6">
                            {{ __('Each module is valuable on its own, and together they ensure coordinated operation across the entire company.') }}
                        </p>
                        <div class="flex items-center gap-4">
                            <a href="{{ route('register') }}"
                                class="inline-flex items-center gap-2 bg-dark-900 text-white px-7 py-3.5 rounded-full text-base font-medium hover:bg-dark-800 transition-colors">
                                {{ __('Get started') }}
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                </svg>
                            </a>
                            <a href="{{ route('contact') }}"
                                class="inline-flex items-center gap-2 bg-surface-primary text-text-primary px-7 py-3.5 rounded-full text-base font-medium border border-border-default hover:bg-surface-secondary transition-colors">
                                {{ __('Request demo') }}
                            </a>
                        </div>
                    </div>

                    {{-- Team Image with Labels --}}
                    <div class="relative flex-1 min-h-80 rounded-2xl overflow-hidden">
                        {{-- Background Image --}}
                        <img src="{{ Vite::asset('resources/images/products-main-img.webp') }}" alt="{{ __('Teamwork') }}"
                            class="absolute inset-0 w-full h-full object-cover">

                        {{-- Floating Labels --}}
                        <div class="absolute top-24 right-12">
                            <span
                                class="bg-[#0f7b6c] text-white text-sm font-medium px-4 py-2 rounded-lg">{{ __('Sales') }}</span>
                        </div>
                        <div class="absolute top-30 left-60">
                            <span
                                class="bg-success-500 text-white text-sm font-medium px-4 py-2 rounded-lg">{{ __('Controlling') }}</span>
                        </div>
                        <div class="absolute top-1/2 left-1/6">
                            <span
                                class="bg-danger-500 text-white text-sm font-medium px-4 py-2 rounded-lg">{{ __('Procurement') }}</span>
                        </div>
                        <div class="absolute bottom-24 right-16">
                            <span class="bg-primary-500 text-white text-sm font-medium px-4 py-2 rounded-lg">CRM</span>
                        </div>
                        <div class="absolute bottom-12 left-12">
                            <span class="bg-violet-600 text-white text-sm font-medium px-4 py-2 rounded-lg">SEO</span>
                        </div>
                        <div class="absolute top-12 left-12">
                            <span
                                class="bg-pink-500 text-white text-sm font-medium px-4 py-2 rounded-lg">MarketingHub</span>
                        </div>
                        <div class="absolute top-1/2 right-12">
                            <span
                                class="bg-violet-500 text-white text-sm font-medium px-4 py-2 rounded-lg">DataMind</span>
                        </div>
                        <div class="absolute bottom-36 right-40">
                            <span
                                class="bg-blue-500 text-white text-sm font-medium px-4 py-2 rounded-lg">AI Chat</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Section 4: A Cégem360 előnyei (Bento Grid) --}}
    <section class="bg-surface-primary py-20">
        <div class="max-w-7xl mx-auto px-6">
            {{-- Section Headline --}}
            <h2 class="text-4xl md:text-5xl text-text-primary text-center mb-16"
                style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                {{ __('Benefits of Cégem360') }}
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

                {{-- Rugalmas, mégis egységes --}}
                <div
                    class="col-span-12 md:col-span-8 bg-success-500 rounded-3xl p-10 lg:p-12 flex items-center min-h-56">
                    <div class="flex flex-col md:flex-row md:items-center gap-6 md:gap-16">
                        <h3 class="text-white text-3xl md:text-[2.5rem] lg:text-[2.75rem] font-medium leading-[1.15]"
                            style="font-family: 'Poppins', sans-serif;">
                            {{ __('Flexible,') }}<br>{{ __('yet unified') }}
                        </h3>
                        <p class="text-white/90 text-lg lg:text-xl leading-relaxed max-w-md">
                            {{ __('Shape the system to your needs — without code. While maintaining enterprise-level consistency.') }}
                        </p>
                    </div>
                </div>

                {{-- Row 2 --}}
                {{-- Amit a csapat szeret használni --}}
                <div
                    class="col-span-12 md:col-span-7 bg-primary-500 rounded-3xl p-10 lg:p-12 flex items-center min-h-56">
                    <div class="flex flex-col md:flex-row md:items-center gap-6 md:gap-12">
                        <h3 class="text-white text-3xl md:text-[2.5rem] lg:text-[2.75rem] font-medium leading-[1.15]"
                            style="font-family: 'Poppins', sans-serif;">
                            {{ __('What the team') }}<br>{{ __('loves to use') }}
                        </h3>
                        <p class="text-white/90 text-lg lg:text-xl leading-relaxed max-w-sm">
                            {{ __('An intuitive interface that colleagues actually use — not out of obligation, but with pleasure.') }}
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

                {{-- Gyors eredmények --}}
                <div
                    class="col-span-12 md:col-span-8 bg-danger-400 rounded-3xl p-10 lg:p-12 flex items-center min-h-56">
                    <div class="flex flex-col md:flex-row md:items-center gap-6 md:gap-16">
                        <h3 class="text-white text-3xl md:text-[2.5rem] lg:text-[2.75rem] font-medium leading-[1.15]"
                            style="font-family: 'Poppins', sans-serif;">
                            {{ __('Fast') }}<br>{{ __('results') }}
                        </h3>
                        <p class="text-white/90 text-lg lg:text-xl leading-relaxed max-w-md">
                            {{ __('Deployable in days, learnable in minutes. So your investment pays off immediately.') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Section 5: Blog Posts Carousel --}}
    @php
        $blogPosts = \App\Models\Blog\Blog::query()
            ->published()
            ->with('blogCategory')
            ->orderByDesc('published_at')
            ->limit(9)
            ->get();
    @endphp

    @if ($blogPosts->isNotEmpty())
        <section class="bg-light-400 py-20">
            <div class="max-w-7xl mx-auto px-6">
                {{-- Header --}}
                <div class="flex items-start justify-between mb-12">
                    <h2 class="text-4xl md:text-5xl lg:text-[3.5rem] text-text-primary leading-tight max-w-2xl"
                        style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                        {{ __('Blog: useful tips and knowledge for entrepreneurs') }}
                    </h2>
                    <a href="{{ route('blog.category', ['blogCategory' => 'blog']) }}"
                        class="hidden md:inline-flex items-center gap-2 bg-text-primary text-white px-7 py-3.5 rounded-full text-base font-medium hover:bg-dark-700 transition-colors shrink-0">
                        {{ __('All posts') }}
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 8l4 4m0 0l-4 4m4-4H3" />
                        </svg>
                    </a>
                </div>

                {{-- Carousel Container --}}
                <div x-data="{
                    currentIndex: 0,
                    totalSlides: {{ $blogPosts->count() }},
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
                            :style="'transform: translateX(calc(-' + (currentIndex * (100 / visibleSlides)) + '% + ' +
                            dragOffset +
                                'px)); cursor: ' + (isDragging ? 'grabbing' : 'grab')"
                            @mousedown="handleDragStart($event)" @mousemove="handleDragMove($event)"
                            @mouseup="handleDragEnd()" @mouseleave="handleDragEnd()"
                            @touchstart="handleDragStart($event)" @touchmove="handleDragMove($event)"
                            @touchend="handleDragEnd()">
                            @foreach ($blogPosts as $post)
                                <div class="shrink-0 w-full sm:w-[calc(50%-12px)] lg:w-[calc(33.333%-16px)] xl:w-[calc(25%-18px)] bg-white rounded-2xl p-6 flex flex-col"
                                    style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                                    <div class="w-full h-40 rounded-xl mb-5 overflow-hidden">
                                        <img src="{{ $post->featured_image ? Storage::url($post->featured_image) : Vite::asset('resources/images/products-main-img.webp') }}"
                                            alt="{{ $post->title }}" class="w-full h-full object-cover">
                                    </div>
                                    @if ($post->blogCategory)
                                        <span
                                            class="self-start mb-3 px-3 py-1 bg-primary-100 text-primary-700 rounded-full text-sm font-medium">
                                            {{ $post->blogCategory->name }}
                                        </span>
                                    @endif
                                    <h3 class="text-lg font-semibold text-text-primary mb-2 line-clamp-2"
                                        style="font-family: 'Poppins', sans-serif;">
                                        <a href="{{ route('blog.show', [$post->blogCategory?->slug, $post->slug]) }}"
                                            class="text-inherit! hover:text-primary-600 transition-colors">
                                            {{ $post->title }}
                                        </a>
                                    </h3>
                                    <p class="text-text-secondary text-sm leading-relaxed line-clamp-3">
                                        {{ $post->excerpt }}
                                    </p>
                                    <div class="mt-auto border-t border-border-light pt-4 flex items-center justify-between">
                                        <span class="text-sm text-text-tertiary">
                                            {{ $post->published_at->format('Y. m. d.') }}
                                        </span>
                                        <a href="{{ route('blog.show', [$post->blogCategory?->slug, $post->slug]) }}"
                                            class="text-primary-600 text-base font-medium hover:text-primary-700 transition-colors">
                                            {{ __('Read more') }} →
                                        </a>
                                    </div>
                                </div>
                            @endforeach
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
    @endif

    {{-- ORIGINAL Section 5: Case Studies Carousel (commented out for later use)
    <section class="bg-light-400 py-20">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex items-start justify-between mb-12">
                <h2 class="text-4xl md:text-5xl lg:text-[3.5rem] text-text-primary leading-tight max-w-2xl"
                    style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                    {{ __('Success stories: how does Cégem360 help industrial companies?') }}
                </h2>
                <a href="#"
                    class="hidden md:inline-flex items-center gap-2 bg-text-primary text-white px-7 py-3.5 rounded-full text-base font-medium hover:bg-dark-700 transition-colors shrink-0">
                    {{ __('Contact us') }}
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 8l4 4m0 0l-4 4m4-4H3" />
                    </svg>
                </a>
            </div>
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
                <div class="overflow-hidden">
                    <div class="flex gap-6 select-none [&_img]:pointer-events-none"
                        :class="isDragging ? '' : 'transition-transform duration-500 ease-out'"
                        :style="'transform: translateX(calc(-' + (currentIndex * (100 / visibleSlides)) + '% + ' + dragOffset +
                            'px)); cursor: ' + (isDragging ? 'grabbing' : 'grab')"
                        @mousedown="handleDragStart($event)" @mousemove="handleDragMove($event)"
                        @mouseup="handleDragEnd()" @mouseleave="handleDragEnd()"
                        @touchstart="handleDragStart($event)" @touchmove="handleDragMove($event)"
                        @touchend="handleDragEnd()">
                        McDonald's Card ... HOLT CAT Card ... Canva Card ... Vistra Card ...
                        Universal Music Group Card ... Compass Card ... VML Card ... Call Box Card ... Deezer Card ...
                        (9 hardcoded cards with company logos, images, stats, and industry tags)
                    </div>
                </div>
                <div class="flex items-center justify-between mt-8">
                    <div class="flex gap-3">
                        <button @click="prev()" class="w-12 h-12 rounded-full border ...">←</button>
                        <button @click="next()" class="w-12 h-12 rounded-full border ...">→</button>
                    </div>
                    <div class="flex gap-2">
                        <template x-for="i in (maxIndex + 1)" :key="i">
                            <button @click="goTo(i - 1)" class="h-2 rounded-full ..."></button>
                        </template>
                    </div>
                </div>
            </div>
        </div>
    </section>
    --}}

    {{-- Section 6: Trusted By / Social Proof --}}
    <section class="hidden bg-surface-secondary border-y border-border-light py-16">
        <div class="max-w-7xl mx-auto px-6">
            <p class="text-center text-text-tertiary text-sm uppercase tracking-wider mb-10">
                {{ __('Trusted by over 500+ companies') }}
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
                    <div class="text-text-secondary">{{ __('Satisfied clients') }}</div>
                </div>
                <div class="text-center">
                    <div class="text-4xl font-bold text-text-primary mb-2">99.9%</div>
                    <div class="text-text-secondary">{{ __('Uptime guarantee') }}</div>
                </div>
                <div class="text-center">
                    <div class="text-4xl font-bold text-text-primary mb-2">24/7</div>
                    <div class="text-text-secondary">{{ __('Support') }}</div>
                </div>
                <div class="text-center">
                    <div class="text-4xl font-bold text-text-primary mb-2">346%</div>
                    <div class="text-text-secondary">{{ __('Average ROI') }}</div>
                </div>
            </div>
        </div>
    </section>

    {{-- Section 3: Features / Value Proposition --}}
    <section id="features" class="hidden bg-surface-primary py-24">
        <div class="max-w-7xl mx-auto px-6">
            {{-- Section header --}}
            <div class="text-center max-w-3xl mx-auto mb-16">
                <span class="badge badge-primary mb-4">{{ __('Features') }}</span>
                <h2 class="text-3xl md:text-4xl font-bold text-text-primary mb-6">
                    {{ __('Everything you need in one place') }}
                </h2>
                <p class="text-lg text-text-secondary">
                    {{ __('Discover the features that help you work more efficiently and reach your goals faster.') }}
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
                    <h4 class="text-xl font-semibold text-text-primary mb-3">{{ __('Task Management') }}</h4>
                    <p class="text-text-secondary mb-4">
                        {{ __('Organize and track your tasks easily. Create deadlines, assign responsibilities and monitor progress in real time.') }}
                    </p>
                    <a href="#"
                        class="inline-flex items-center gap-2 text-primary-600 font-medium hover:text-primary-800 transition-colors">
                        <span>{{ __('Learn more') }}</span>
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
                    <h4 class="text-xl font-semibold text-text-primary mb-3">{{ __('Automation') }}</h4>
                    <p class="text-text-secondary mb-4">
                        {{ __('Free up your time with automated workflows. Set up triggers and actions without code, in minutes.') }}
                    </p>
                    <a href="#"
                        class="inline-flex items-center gap-2 text-primary-600 font-medium hover:text-primary-800 transition-colors">
                        <span>{{ __('Learn more') }}</span>
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
                    <h4 class="text-xl font-semibold text-text-primary mb-3">{{ __('Reports and analytics') }}</h4>
                    <p class="text-text-secondary mb-4">
                        {{ __('Make decisions based on data. Detailed reports and dashboards help you understand your performance.') }}
                    </p>
                    <a href="#"
                        class="inline-flex items-center gap-2 text-primary-600 font-medium hover:text-primary-800 transition-colors">
                        <span>{{ __('Learn more') }}</span>
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
                    <h4 class="text-xl font-semibold text-text-primary mb-3">{{ __('Teamwork') }}</h4>
                    <p class="text-text-secondary mb-4">
                        {{ __('Collaborate with your team in real time. Share files, communicate and keep everyone up to date.') }}
                    </p>
                    <a href="#"
                        class="inline-flex items-center gap-2 text-primary-600 font-medium hover:text-primary-800 transition-colors">
                        <span>{{ __('Learn more') }}</span>
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
                    <h4 class="text-xl font-semibold text-text-primary mb-3">{{ __('Integrations') }}</h4>
                    <p class="text-text-secondary mb-4">
                        {{ __('Connect your favorite tools. 50+ integrations available, including Google, Microsoft and Slack applications.') }}
                    </p>
                    <a href="#"
                        class="inline-flex items-center gap-2 text-primary-600 font-medium hover:text-primary-800 transition-colors">
                        <span>{{ __('Learn more') }}</span>
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
                    <h4 class="text-xl font-semibold text-text-primary mb-3">{{ __('Security') }}</h4>
                    <p class="text-text-secondary mb-4">
                        {{ __('Enterprise-level security. SOC 2 certification, GDPR compliance and end-to-end encryption.') }}
                    </p>
                    <a href="#"
                        class="inline-flex items-center gap-2 text-primary-600 font-medium hover:text-primary-800 transition-colors">
                        <span>{{ __('Learn more') }}</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5l7 7-7 7">
                            </path>
                        </svg>
                    </a>
                </div>
            </div>

            {{-- Bottom CTA --}}
            <div class="hidden text-center mt-16">
                <a href="{{ route('register') }}" class="btn btn-primary btn-lg">
                    {{ __('Try it for free') }}
                </a>
                <p class="text-text-tertiary text-sm mt-4">
                    {{ __('No credit card required') }} • {{ __('14-day free trial') }}
                </p>
            </div>
        </div>
    </section>
</x-layouts.app>
