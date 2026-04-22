<nav class="bg-white border-b border-gray-100" x-data="{ mobileMenuOpen: false, openDropdown: null }">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 items-center justify-between">
            {{-- Left: Logo --}}
            <div class="flex items-center">
                <a href="{{ route('home') }}" class="flex items-center">
                    <img src="{{ Vite::asset('resources/images/cegem360-logo.png') }}" alt="Cégem360" class="h-10">
                </a>
            </div>

            {{-- Center: Navigation Links with Dropdowns --}}
            <div class="hidden lg:flex items-center gap-1">
                {{-- Products Dropdown --}}
                <div class="relative" @mouseenter="openDropdown = 'products'" @mouseleave="openDropdown = null">
                    <button
                        class="flex items-center gap-1 px-3 py-2 text-sm font-medium text-gray-700 hover:text-gray-900 transition-colors">
                        {{ __('Products') }}
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="openDropdown === 'products'" x-transition:enter="transition ease-out duration-100"
                        x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-75"
                        x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                        class="absolute left-0 top-full mt-1 w-[580px] bg-white rounded-xl shadow-lg border border-gray-200 z-50">
                        <div class="grid grid-cols-2 gap-x-1 p-3">
                            <a href="{{ route('products.kontrolling') }}"
                                class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm text-gray-700 hover:bg-gray-50">
                                <x-module-icon module="kontrolling" size="sm" />
                                <div>
                                    <div class="font-medium">{{ __('Controlling') }}</div>
                                    <div class="text-xs text-gray-500">{{ __('Financial planning and analysis') }}</div>
                                </div>
                            </a>
                            <a href="{{ route('products.crm') }}"
                                class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm text-gray-700 hover:bg-gray-50">
                                <x-module-icon module="crm" size="sm" />
                                <div>
                                    <div class="font-medium">CRM</div>
                                    <div class="text-xs text-gray-500">{{ __('Customer relationship management') }}</div>
                                </div>
                            </a>
                            <a href="{{ route('products.ertekesites') }}"
                                class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm text-gray-700 hover:bg-gray-50">
                                <x-module-icon module="ertekesites" size="sm" />
                                <div>
                                    <div class="font-medium">{{ __('Sales') }}</div>
                                    <div class="text-xs text-gray-500">{{ __('Quotes and orders') }}</div>
                                </div>
                            </a>
                            <a href="{{ route('products.beszerzes') }}"
                                class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm text-gray-700 hover:bg-gray-50">
                                <x-module-icon module="beszerzes" size="sm" />
                                <div>
                                    <div class="font-medium">{{ __('Procurement & Logistics') }}</div>
                                    <div class="text-xs text-gray-500">{{ __('Inventory and shipping management') }}</div>
                                </div>
                            </a>
                            <a href="{{ route('products.gyartas') }}"
                                class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm text-gray-700 hover:bg-gray-50">
                                <x-module-icon module="gyartas" size="sm" />
                                <div>
                                    <div class="font-medium">{{ __('Manufacturing Management') }}</div>
                                    <div class="text-xs text-gray-500">{{ __('Production and quality') }}</div>
                                </div>
                            </a>
                            <a href="{{ route('products.automatizalas') }}"
                                class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm text-gray-700 hover:bg-gray-50">
                                <x-module-icon module="automatizalas" size="sm" />
                                <div>
                                    <div class="font-medium">{{ __('Automation') }}</div>
                                    <div class="text-xs text-gray-500">{{ __('Workflows and triggers') }}</div>
                                </div>
                            </a>
                            <a href="{{ route('products.szerviz') }}"
                                class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm text-gray-700 hover:bg-gray-50">
                                <x-module-icon module="szerviz" size="sm" />
                                <div>
                                    <div class="font-medium">{{ __('Digital Worksheet') }}</div>
                                    <div class="text-xs text-gray-500">{{ __('Worksheets for field visits') }}</div>
                                </div>
                            </a>
                            <a href="{{ route('products.seo') }}"
                                class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm text-gray-700 hover:bg-gray-50">
                                <x-module-icon module="seo" size="sm" />
                                <div>
                                    <div class="font-medium">{{ __('SEO Tool') }}</div>
                                    <div class="text-xs text-gray-500">{{ __('AI-powered search optimization') }}</div>
                                </div>
                            </a>
                            <a href="{{ route('products.marketinghub') }}"
                                class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm text-gray-700 hover:bg-gray-50">
                                <x-module-icon module="marketinghub" size="sm" />
                                <div>
                                    <div class="font-medium">MarketingHub</div>
                                    <div class="text-xs text-gray-500">{{ __('Online marketing tools') }}</div>
                                </div>
                            </a>
                            <a href="{{ route('products.datamind') }}"
                                class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm text-gray-700 hover:bg-gray-50">
                                <x-module-icon module="datamind" size="sm" />
                                <div>
                                    <div class="font-medium">DataMind</div>
                                    <div class="text-xs text-gray-500">{{ __('AI-powered data mining platform') }}</div>
                                </div>
                            </a>
                            @if(false)
                            <a href="{{ route('products.aichat') }}"
                                class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm text-gray-700 hover:bg-gray-50">
                                <x-module-icon module="ai-chat" size="sm" />
                                <div>
                                    <div class="font-medium">AI Chat</div>
                                    <div class="text-xs text-gray-500">{{ __('Intelligent chatbot for websites') }}</div>
                                </div>
                            </a>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- Solutions Dropdown --}}
                <div class="relative" @mouseenter="openDropdown = 'solutions'" @mouseleave="openDropdown = null">
                    <button
                        class="flex items-center gap-1 px-3 py-2 text-sm font-medium text-gray-700 hover:text-gray-900 transition-colors">
                        {{ __('Solutions') }}
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="openDropdown === 'solutions'" x-transition:enter="transition ease-out duration-100"
                        x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-75"
                        x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                        class="absolute left-0 top-full mt-1 w-48 bg-white rounded-lg shadow-lg border border-gray-200 py-2 z-50">
                        <a href="{{ route('solutions.kkv') }}"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">{{ __('SME') }}</a>
                        <a href="{{ route('solutions.enterprise') }}"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">{{ __('Enterprise') }}</a>
                    </div>
                </div>

                {{-- Resources Dropdown --}}
                <div class="relative" @mouseenter="openDropdown = 'resources'" @mouseleave="openDropdown = null">
                    <button
                        class="flex items-center gap-1 px-3 py-2 text-sm font-medium text-gray-700 hover:text-gray-900 transition-colors">
                        {{ __('Resources') }}
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="openDropdown === 'resources'" x-transition:enter="transition ease-out duration-100"
                        x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-75"
                        x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                        class="absolute left-0 top-full mt-1 w-48 bg-white rounded-lg shadow-lg border border-gray-200 py-2 z-50">
                        <a href="{{ route('blog.category', ['blogCategory' => 'sugo']) }}"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">{{ __('Help') }}</a>
                        <a href="{{ route('blog.category', ['blogCategory' => 'blog']) }}"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">Blog</a>
                        <a href="{{ route('blog.category', ['blogCategory' => 'akademia']) }}"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">{{ __('Academy') }}</a>
                    </div>
                </div>

                {{-- Custom Solutions (no dropdown) --}}
                <a href="{{ route('solutions.custom') }}"
                    class="px-3 py-2 text-sm font-medium text-gray-700 hover:text-gray-900 transition-colors">
                    {{ __('Custom solutions') }}
                </a>
            </div>

            {{-- Right: Actions --}}
            <div class="hidden lg:flex items-center gap-4">
                {{-- Language Switcher --}}
                <x-language-switcher />

                {{-- Pricing --}}
                <a href="{{ route('pricing') }}"
                    class="text-sm font-medium text-gray-700 hover:text-gray-900 transition-colors">
                    {{ __('Pricing') }}
                </a>

                @guest
                    {{-- Log in --}}
                    <a href="/admin" class="text-sm font-medium text-gray-700 hover:text-gray-900 transition-colors">
                        {{ __('Log in') }}
                    </a>

                    {{-- Contact sales (outlined) --}}
                    <a href="{{ route('contact') }}"
                        class="inline-flex items-center px-4 py-2 text-sm font-medium text-indigo-600 border border-indigo-600 rounded-full hover:bg-indigo-50 transition-colors">
                        {{ __('Contact') }}
                    </a>

                    {{-- Get Started (filled) --}}
                    <a href="{{ route('filament.admin.auth.register') }}"
                        class="inline-flex items-center gap-1 px-5 py-2 text-sm font-medium text-white bg-indigo-600 rounded-full hover:bg-indigo-700 transition-colors">
                        {{ __('Get started') }}
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </a>
                @endguest

                @auth
                    {{-- User menu for authenticated users --}}
                    <a href="{{ route('modules') }}"
                        class="text-sm font-medium text-gray-700 hover:text-gray-900 transition-colors">
                        {{ __('My Modules') }}
                    </a>

                    <a href="{{ route('subscriptions') }}"
                        class="text-sm font-medium text-gray-700 hover:text-gray-900 transition-colors">
                        {{ __('Subscriptions') }}
                    </a>

                    @if (auth()->user()->isAdmin() || auth()->user()->isManager())
                        <a href="{{ route('manage.users') }}"
                            class="text-sm font-medium text-gray-700 hover:text-gray-900 transition-colors">
                            {{ __('Users') }}
                        </a>
                    @endif

                    {{-- User dropdown --}}
                    <div class="relative" @mouseenter="openDropdown = 'user'" @mouseleave="openDropdown = null">
                        <button
                            class="flex items-center gap-2 px-3 py-2 text-sm font-medium text-gray-700 hover:text-gray-900 transition-colors">
                            <div
                                class="w-8 h-8 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 font-semibold text-sm">
                                {{ substr(auth()->user()->name ?? auth()->user()->email, 0, 1) }}
                            </div>
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <div x-show="openDropdown === 'user'" x-transition:enter="transition ease-out duration-100"
                            x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-75"
                            x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                            class="absolute right-0 top-full mt-1 w-48 bg-white rounded-lg shadow-lg border border-gray-200 py-2 z-50">
                            <a href="{{ route('filament.admin.auth.profile') }}"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">{{ __('My Profile') }}</a>
                            <hr class="my-1 border-gray-200">
                            <form method="POST" action="{{ route('filament.admin.auth.logout') }}">
                                @csrf
                                <button type="submit"
                                    class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">
                                    {{ __('Sign out') }}
                                </button>
                            </form>
                        </div>
                    </div>
                @endauth

            </div>

            {{-- Mobile menu button --}}
            <button @click="mobileMenuOpen = !mobileMenuOpen"
                class="lg:hidden p-2 text-gray-400 hover:text-gray-600 transition-colors">
                <svg x-show="!mobileMenuOpen" class="w-6 h-6" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 6h16M4 12h16M4 18h16" />
                </svg>
                <svg x-show="mobileMenuOpen" x-cloak class="w-6 h-6" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>

    {{-- Mobile menu --}}
    <div x-show="mobileMenuOpen" x-collapse class="lg:hidden border-t border-gray-200">
        <div class="px-4 py-4 space-y-3">
            <div class="py-2">
                <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">{{ __('Products') }}</p>
                <a href="{{ route('products.szerviz') }}"
                    class="flex items-center gap-2 py-1.5 pl-3 text-sm text-gray-700">
                    <x-module-icon module="szerviz" size="xs" />
                    {{ __('Digital Worksheet') }}
                </a>
                <a href="{{ route('products.kontrolling') }}"
                    class="flex items-center gap-2 py-1.5 pl-3 text-sm text-gray-700">
                    <x-module-icon module="kontrolling" size="xs" />
                    {{ __('Controlling') }}
                </a>
                <a href="{{ route('products.seo') }}"
                    class="flex items-center gap-2 py-1.5 pl-3 text-sm text-gray-700">
                    <x-module-icon module="seo" size="xs" />
                    {{ __('SEO Tool') }}
                </a>
                <a href="{{ route('products.crm') }}"
                    class="flex items-center gap-2 py-1.5 pl-3 text-sm text-gray-700">
                    <x-module-icon module="crm" size="xs" />
                    CRM
                </a>
                <a href="{{ route('products.beszerzes') }}"
                    class="flex items-center gap-2 py-1.5 pl-3 text-sm text-gray-700">
                    <x-module-icon module="beszerzes" size="xs" />
                    {{ __('Procurement & Logistics') }}
                </a>
                <a href="{{ route('products.ertekesites') }}"
                    class="flex items-center gap-2 py-1.5 pl-3 text-sm text-gray-700">
                    <x-module-icon module="ertekesites" size="xs" />
                    {{ __('Sales') }}
                </a>
                <a href="{{ route('products.gyartas') }}"
                    class="flex items-center gap-2 py-1.5 pl-3 text-sm text-gray-700">
                    <x-module-icon module="gyartas" size="xs" />
                    {{ __('Manufacturing Management') }}
                </a>
                <a href="{{ route('products.automatizalas') }}"
                    class="flex items-center gap-2 py-1.5 pl-3 text-sm text-gray-700">
                    <x-module-icon module="automatizalas" size="xs" />
                    {{ __('Automation') }}
                </a>
                <a href="{{ route('products.marketinghub') }}"
                    class="flex items-center gap-2 py-1.5 pl-3 text-sm text-gray-700">
                    <x-module-icon module="marketinghub" size="xs" />
                    MarketingHub
                </a>
                <a href="{{ route('products.datamind') }}"
                    class="flex items-center gap-2 py-1.5 pl-3 text-sm text-gray-700">
                    <x-module-icon module="datamind" size="xs" />
                    DataMind
                </a>
                @if(false)
                <a href="{{ route('products.aichat') }}"
                    class="flex items-center gap-2 py-1.5 pl-3 text-sm text-gray-700">
                    <x-module-icon module="ai-chat" size="xs" />
                    AI Chat
                </a>
                @endif
            </div>
            <div class="py-2">
                <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">{{ __('Solutions') }}</p>
                <a href="{{ route('solutions.kkv') }}" class="block py-1.5 pl-3 text-sm text-gray-700">{{ __('SME') }}</a>
                <a href="{{ route('solutions.enterprise') }}"
                    class="block py-1.5 pl-3 text-sm text-gray-700">{{ __('Enterprise') }}</a>
            </div>
            <a href="#" class="block py-2 text-sm font-medium text-gray-700">{{ __('Resources') }}</a>
            <a href="{{ route('pricing') }}" class="block py-2 text-sm font-medium text-gray-700">{{ __('Pricing') }}</a>

            {{-- Language Switcher for Mobile --}}
            <div class="py-2">
                <x-language-switcher />
            </div>

            <hr class="border-gray-200">

            @guest
                <a href="/admin" class="block py-2 text-sm font-medium text-gray-700">{{ __('Log in') }}</a>
                <a href="{{ route('contact') }}" class="block py-2 text-sm font-medium text-indigo-600">{{ __('Contact') }}</a>
                <a href="{{ route('filament.admin.auth.register') }}"
                    class="block w-full text-center py-2.5 text-sm font-medium text-white bg-indigo-600 rounded-full">
                    {{ __('Get started') }}
                </a>
            @endguest

            @auth
                <a href="{{ route('modules') }}" class="block py-2 text-sm font-medium text-gray-700">{{ __('My Modules') }}</a>
                <a href="{{ route('subscriptions') }}"
                    class="block py-2 text-sm font-medium text-gray-700">{{ __('Subscriptions') }}</a>
                @if (auth()->user()->isAdmin() || auth()->user()->isManager())
                    <a href="{{ route('manage.users') }}"
                        class="block py-2 text-sm font-medium text-gray-700">{{ __('Users') }}</a>
                @endif
                <a href="{{ route('filament.admin.auth.profile') }}"
                    class="block py-2 text-sm font-medium text-gray-700">{{ __('My Profile') }}</a>
                <form method="POST" action="{{ route('filament.admin.auth.logout') }}">
                    @csrf
                    <button type="submit" class="block w-full text-left py-2 text-sm font-medium text-red-600">
                        {{ __('Sign out') }}
                    </button>
                </form>
            @endauth
        </div>
    </div>
</nav>
