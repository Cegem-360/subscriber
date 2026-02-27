<div>
    {{-- Hero Section --}}
    <section class="bg-linear-to-b from-gray-900 to-gray-800 py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto max-w-4xl text-center">
                <div
                    class="mb-6 inline-flex items-center gap-2 rounded-full bg-indigo-500/20 px-4 py-1.5 text-sm font-medium text-indigo-300">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M11 4a2 2 0 114 0v1a1 1 0 001 1h3a1 1 0 011 1v3a1 1 0 01-1 1h-1a2 2 0 100 4h1a1 1 0 011 1v3a1 1 0 01-1 1h-3a1 1 0 01-1-1v-1a2 2 0 10-4 0v1a1 1 0 01-1 1H7a1 1 0 01-1-1v-3a1 1 0 00-1-1H4a2 2 0 110-4h1a1 1 0 001-1V7a1 1 0 011-1h3a1 1 0 001-1V4z" />
                    </svg>
                    {{ __('Custom solutions') }}
                </div>

                <h1 class="mb-6 text-4xl font-bold tracking-tight text-white sm:text-5xl lg:text-6xl">
                    {{ __('Tailored to your business') }}
                    <span class="text-indigo-400">{{ __('— not the other way around') }}</span>
                </h1>

                <p class="mx-auto mb-8 max-w-3xl text-lg text-gray-300 sm:text-xl">
                    {{ __('Every business is unique. That\'s why we adapt Cégem360 to fit your processes — whether you have 10 or 1000 employees. Custom integrations, tailored modules, and dedicated support.') }}
                </p>

                <div class="flex flex-col justify-center gap-4 sm:flex-row">
                    <a href="{{ route('contact') }}"
                        class="inline-flex items-center justify-center gap-2 rounded-lg bg-indigo-600 px-8 py-4 text-base font-semibold text-white shadow-lg transition hover:bg-indigo-700">
                        {{ __('Request a consultation') }}
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 7l5 5m0 0l-5 5m5-5H6" />
                        </svg>
                    </a>
                    <a href="{{ route('quote-request') }}"
                        class="inline-flex items-center justify-center gap-2 rounded-lg border-2 border-gray-600 px-8 py-4 text-base font-semibold text-white transition hover:bg-gray-800">
                        {{ __('Request a quote') }}
                    </a>
                </div>

                <div class="mt-10 flex flex-wrap items-center justify-center gap-x-8 gap-y-4 text-sm text-gray-400">
                    <div class="flex items-center gap-2">
                        <svg class="h-5 w-5 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        {{ __('Custom development') }}
                    </div>
                    <div class="flex items-center gap-2">
                        <svg class="h-5 w-5 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        {{ __('Personal support') }}
                    </div>
                    <div class="flex items-center gap-2">
                        <svg class="h-5 w-5 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        {{ __('Flexible pricing') }}
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Why Custom Solutions Section --}}
    <section class="bg-white py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto max-w-3xl text-center">
                <h2 class="mb-4 text-3xl font-bold text-gray-900 sm:text-4xl">
                    {{ __('Why choose a custom solution?') }}
                </h2>
                <p class="text-lg text-gray-600">
                    {{ __('Off-the-shelf software rarely fits perfectly. A custom solution means the system adapts to your way of working — you don\'t have to change.') }}
                </p>
            </div>

            <div class="mt-12 grid gap-8 md:grid-cols-2 lg:grid-cols-3">
                <div class="rounded-xl bg-gray-50 p-6">
                    <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-lg bg-indigo-100">
                        <svg class="h-6 w-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z" />
                        </svg>
                    </div>
                    <h3 class="mb-2 font-semibold text-gray-900">{{ __('Custom interface') }}</h3>
                    <p class="text-sm text-gray-600">{{ __('Screens and dashboards designed for your workflows — not generic templates.') }}</p>
                </div>

                <div class="rounded-xl bg-gray-50 p-6">
                    <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-lg bg-indigo-100">
                        <svg class="h-6 w-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 9l3 3-3 3m5 0h3M5 20h14a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <h3 class="mb-2 font-semibold text-gray-900">{{ __('System integration') }}</h3>
                    <p class="text-sm text-gray-600">{{ __('We connect with your existing systems: ERP, invoicing, webshop, HR — anything.') }}</p>
                </div>

                <div class="rounded-xl bg-gray-50 p-6">
                    <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-lg bg-indigo-100">
                        <svg class="h-6 w-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                    <h3 class="mb-2 font-semibold text-gray-900">{{ __('Automation') }}</h3>
                    <p class="text-sm text-gray-600">{{ __('Custom workflows and triggers that automate repetitive tasks.') }}</p>
                </div>

                <div class="rounded-xl bg-gray-50 p-6">
                    <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-lg bg-indigo-100">
                        <svg class="h-6 w-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <h3 class="mb-2 font-semibold text-gray-900">{{ __('Custom reports') }}</h3>
                    <p class="text-sm text-gray-600">{{ __('See exactly the data you need — with your own KPIs.') }}</p>
                </div>

                <div class="rounded-xl bg-gray-50 p-6">
                    <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-lg bg-indigo-100">
                        <svg class="h-6 w-6 text-indigo-600" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </div>
                    <h3 class="mb-2 font-semibold text-gray-900">{{ __('Dedicated support') }}</h3>
                    <p class="text-sm text-gray-600">{{ __('A personal contact who knows your system and business.') }}</p>
                </div>

                <div class="rounded-xl bg-gray-50 p-6">
                    <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-lg bg-indigo-100">
                        <svg class="h-6 w-6 text-indigo-600" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                    </div>
                    <h3 class="mb-2 font-semibold text-gray-900">{{ __('Higher SLA') }}</h3>
                    <p class="text-sm text-gray-600">{{ __('Guaranteed uptime and faster response times for critical issues.') }}</p>
                </div>
            </div>
        </div>
    </section>

    {{-- How It Works Section --}}
    <section class="bg-gray-50 py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto max-w-3xl text-center">
                <h2 class="mb-4 text-3xl font-bold text-gray-900 sm:text-4xl">
                    {{ __('How does it work?') }}
                </h2>
                <p class="text-lg text-gray-600">
                    {{ __('Four steps from idea to working system') }}
                </p>
            </div>

            <div class="relative mt-16">
                {{-- Connecting line (hidden on mobile) --}}
                <div
                    class="absolute left-[calc(12.5%+1.5rem)] right-[calc(12.5%+1.5rem)] top-6 hidden h-0.5 bg-indigo-200 lg:block">
                </div>

                <div class="grid gap-8 lg:grid-cols-4">
                    <div class="text-center">
                        <div
                            class="relative z-10 mx-auto mb-4 flex h-12 w-12 items-center justify-center rounded-full bg-indigo-600 text-xl font-bold text-white">
                            1</div>
                        <h3 class="mb-2 text-lg font-semibold text-gray-900">{{ __('Assessment') }}</h3>
                        <p class="text-gray-600">{{ __('We learn about your processes, pain points, and goals. In person or online.') }}</p>
                    </div>

                    <div class="text-center">
                        <div
                            class="relative z-10 mx-auto mb-4 flex h-12 w-12 items-center justify-center rounded-full bg-indigo-600 text-xl font-bold text-white">
                            2</div>
                        <h3 class="mb-2 text-lg font-semibold text-gray-900">{{ __('Planning') }}</h3>
                        <p class="text-gray-600">{{ __('We prepare the system plan and the quote. You decide, we proceed.') }}</p>
                    </div>

                    <div class="text-center">
                        <div
                            class="relative z-10 mx-auto mb-4 flex h-12 w-12 items-center justify-center rounded-full bg-indigo-600 text-xl font-bold text-white">
                            3</div>
                        <h3 class="mb-2 text-lg font-semibold text-gray-900">{{ __('Development') }}</h3>
                        <p class="text-gray-600">{{ __('We work with agile methodology: regular demos, continuous feedback.') }}</p>
                    </div>

                    <div class="text-center">
                        <div
                            class="relative z-10 mx-auto mb-4 flex h-12 w-12 items-center justify-center rounded-full bg-green-600 text-xl font-bold text-white">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                        <h3 class="mb-2 text-lg font-semibold text-gray-900">{{ __('Go-live') }}</h3>
                        <p class="text-gray-600">{{ __('Deployment, training, and ongoing support. We won\'t leave you alone.') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Integration Examples --}}
    <section class="bg-white py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="grid items-center gap-12 lg:grid-cols-2">
                <div>
                    <h2 class="mb-4 text-3xl font-bold text-gray-900 sm:text-4xl">
                        {{ __('Integrable with your existing systems') }}
                    </h2>
                    <p class="mb-8 text-lg text-gray-600">
                        {{ __('You don\'t have to replace everything. Cégem360 can connect with the tools you already use, so data syncs automatically.') }}
                    </p>

                    <div class="space-y-4">
                        <div class="flex items-start gap-4">
                            <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-indigo-100">
                                <svg class="h-5 w-5 text-indigo-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-900">{{ __('Invoicing systems') }}</h4>
                                <p class="text-sm text-gray-600">{{ __('Billingo, Szamlazz.hu, Kulcs-Soft and other Hungarian systems') }}</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-4">
                            <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-indigo-100">
                                <svg class="h-5 w-5 text-indigo-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-900">{{ __('Webshops') }}</h4>
                                <p class="text-sm text-gray-600">Shopify, WooCommerce, Shoprenter, Unas</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-4">
                            <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-indigo-100">
                                <svg class="h-5 w-5 text-indigo-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-900">{{ __('ERP systems') }}</h4>
                                <p class="text-sm text-gray-600">SAP, Microsoft Dynamics, Odoo, Nexon</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-4">
                            <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-indigo-100">
                                <svg class="h-5 w-5 text-indigo-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-900">{{ __('Communication tools') }}</h4>
                                <p class="text-sm text-gray-600">Microsoft 365, Google Workspace, Slack, Teams</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="rounded-2xl bg-gray-50 p-8">
                    <div class="grid grid-cols-3 gap-4">
                        <div class="flex h-20 items-center justify-center rounded-xl bg-white p-4 shadow-sm">
                            <img src="{{ Vite::asset('resources/images/integrations/sap.svg') }}" alt="SAP" class="h-9 w-auto">
                        </div>
                        <div class="flex h-20 items-center justify-center rounded-xl bg-white p-4 shadow-sm">
                            <img src="{{ Vite::asset('resources/images/integrations/billingo.svg') }}" alt="Billingo" class="h-9 w-auto">
                        </div>
                        <div class="flex h-20 items-center justify-center rounded-xl bg-white p-4 shadow-sm">
                            <img src="{{ Vite::asset('resources/images/integrations/shopify.svg') }}" alt="Shopify" class="h-7 w-auto">
                        </div>
                        <div class="flex h-20 items-center justify-center rounded-xl bg-white p-4 shadow-sm">
                            <img src="{{ Vite::asset('resources/images/integrations/teams.svg') }}" alt="Microsoft Teams" class="h-10 w-auto">
                        </div>
                        <div class="flex h-20 items-center justify-center rounded-xl bg-white p-4 shadow-sm">
                            <img src="{{ Vite::asset('resources/images/integrations/slack.svg') }}" alt="Slack" class="h-8 w-auto">
                        </div>
                        <div class="flex h-20 items-center justify-center rounded-xl bg-white p-4 shadow-sm">
                            <img src="{{ Vite::asset('resources/images/integrations/nexon.svg') }}" alt="Nexon" class="h-5 w-auto">
                        </div>
                        <div class="flex h-20 items-center justify-center rounded-xl bg-white p-4 shadow-sm">
                            <img src="{{ Vite::asset('resources/images/integrations/hubspot.svg') }}" alt="HubSpot" class="h-10 w-auto">
                        </div>
                        <div class="flex h-20 items-center justify-center rounded-xl bg-white p-4 shadow-sm">
                            <img src="{{ Vite::asset('resources/images/integrations/dynamics.svg') }}" alt="Microsoft Dynamics 365" class="h-10 w-auto">
                        </div>
                        <div class="flex h-20 items-center justify-center rounded-xl bg-indigo-100 p-4">
                            <span class="text-sm font-medium text-indigo-600">{{ __('+50 more') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Pricing Section --}}
    <section class="bg-gray-50 py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto max-w-3xl text-center">
                <h2 class="mb-4 text-3xl font-bold text-gray-900 sm:text-4xl">
                    {{ __('Transparent pricing') }}
                </h2>
                <p class="text-lg text-gray-600">
                    {{ __('No hidden costs. You know exactly what to expect.') }}
                </p>
            </div>

            <div class="mt-12 grid gap-8 lg:grid-cols-3">
                <div class="rounded-2xl bg-white p-8 shadow-sm">
                    <h3 class="mb-2 text-xl font-semibold text-gray-900">{{ __('Consultation') }}</h3>
                    <p class="mb-6 text-gray-600">{{ __('Assessment and planning') }}</p>
                    <div class="mb-6">
                        <span class="text-4xl font-bold text-gray-900">{{ __('Free') }}</span>
                    </div>
                    <ul class="mb-8 space-y-3">
                        <li class="flex items-center gap-2 text-sm text-gray-600">
                            <svg class="h-5 w-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            {{ __('60-minute personal or online meeting') }}
                        </li>
                        <li class="flex items-center gap-2 text-sm text-gray-600">
                            <svg class="h-5 w-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            {{ __('Needs assessment and system design') }}
                        </li>
                        <li class="flex items-center gap-2 text-sm text-gray-600">
                            <svg class="h-5 w-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            {{ __('Detailed quote') }}
                        </li>
                    </ul>
                    <a href="{{ route('quote-request') }}"
                        class="block w-full rounded-lg bg-indigo-600 py-3 text-center font-semibold text-white transition hover:bg-indigo-700">
                        {{ __('Request a consultation') }}
                    </a>
                </div>

                <div class="relative rounded-2xl bg-indigo-600 p-8 shadow-lg">
                    <div
                        class="absolute -top-4 left-1/2 -translate-x-1/2 rounded-full bg-indigo-500 px-4 py-1 text-sm font-medium text-white">
                        {{ __('Most popular') }}
                    </div>
                    <h3 class="mb-2 text-xl font-semibold text-white">{{ __('Custom development') }}</h3>
                    <p class="mb-6 text-indigo-200">{{ __('Tailored solution') }}</p>
                    <div class="mb-6">
                        <span class="text-4xl font-bold text-white">{{ __('Custom price') }}</span>
                    </div>
                    <ul class="mb-8 space-y-3">
                        <li class="flex items-center gap-2 text-sm text-indigo-100">
                            <svg class="h-5 w-5 text-indigo-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            {{ __('Everything in Consultation +') }}
                        </li>
                        <li class="flex items-center gap-2 text-sm text-indigo-100">
                            <svg class="h-5 w-5 text-indigo-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            {{ __('Custom module development') }}
                        </li>
                        <li class="flex items-center gap-2 text-sm text-indigo-100">
                            <svg class="h-5 w-5 text-indigo-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            {{ __('System integrations') }}
                        </li>
                        <li class="flex items-center gap-2 text-sm text-indigo-100">
                            <svg class="h-5 w-5 text-indigo-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            {{ __('Deployment and training') }}
                        </li>
                        <li class="flex items-center gap-2 text-sm text-indigo-100">
                            <svg class="h-5 w-5 text-indigo-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            {{ __('Dedicated support') }}
                        </li>
                    </ul>
                    <a href="{{ route('quote-request') }}"
                        class="block w-full rounded-lg bg-white py-3 text-center font-semibold text-indigo-600 transition hover:bg-indigo-50">
                        {{ __('Request a quote') }}
                    </a>
                </div>

                <div class="rounded-2xl bg-white p-8 shadow-sm">
                    <h3 class="mb-2 text-xl font-semibold text-gray-900">{{ __('Support') }}</h3>
                    <p class="mb-6 text-gray-600">{{ __('Ongoing operation') }}</p>
                    <div class="mb-6">
                        <span class="text-4xl font-bold text-gray-900">{{ __('Monthly fee') }}</span>
                    </div>
                    <ul class="mb-8 space-y-3">
                        <li class="flex items-center gap-2 text-sm text-gray-600">
                            <svg class="h-5 w-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            {{ __('Personal contact person') }}
                        </li>
                        <li class="flex items-center gap-2 text-sm text-gray-600">
                            <svg class="h-5 w-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            {{ __('Priority bug fixes') }}
                        </li>
                        <li class="flex items-center gap-2 text-sm text-gray-600">
                            <svg class="h-5 w-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            {{ __('Regular updates') }}
                        </li>
                        <li class="flex items-center gap-2 text-sm text-gray-600">
                            <svg class="h-5 w-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            {{ __('SLA guarantee') }}
                        </li>
                    </ul>
                    <a href="{{ route('quote-request') }}"
                        class="block w-full rounded-lg border-2 border-indigo-600 py-3 text-center font-semibold text-indigo-600 transition hover:bg-indigo-50">
                        {{ __('Request details') }}
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{-- Who Is It For Section --}}
    <section class="bg-white py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto max-w-3xl text-center">
                <h2 class="mb-4 text-3xl font-bold text-gray-900 sm:text-4xl">
                    {{ __('Who is it for?') }}
                </h2>
            </div>

            <div class="mt-12 grid gap-8 md:grid-cols-2">
                <div class="rounded-2xl bg-green-50 p-8">
                    <h3 class="mb-6 flex items-center gap-2 text-xl font-semibold text-green-800">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        {{ __('Ideal if...') }}
                    </h3>
                    <ul class="space-y-3 text-green-700">
                        <li class="flex items-start gap-2">
                            <span class="mt-1.5 h-1.5 w-1.5 shrink-0 rounded-full bg-green-500"></span>
                            {{ __('You have unique workflows that don\'t fit standard solutions') }}
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="mt-1.5 h-1.5 w-1.5 shrink-0 rounded-full bg-green-500"></span>
                            {{ __('You use multiple systems and want to connect them') }}
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="mt-1.5 h-1.5 w-1.5 shrink-0 rounded-full bg-green-500"></span>
                            {{ __('You want personal support and partnership') }}
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="mt-1.5 h-1.5 w-1.5 shrink-0 rounded-full bg-green-500"></span>
                            {{ __('You think long-term and would invest in efficiency') }}
                        </li>
                    </ul>
                </div>

                <div class="rounded-2xl bg-gray-100 p-8">
                    <h3 class="mb-6 flex items-center gap-2 text-xl font-semibold text-gray-600">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                        {{ __('Not ideal if...') }}
                    </h3>
                    <ul class="space-y-3 text-gray-600">
                        <li class="flex items-start gap-2">
                            <span class="mt-1.5 h-1.5 w-1.5 shrink-0 rounded-full bg-gray-400"></span>
                            {{ __('A standard solution meets your needs') }}
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="mt-1.5 h-1.5 w-1.5 shrink-0 rounded-full bg-gray-400"></span>
                            {{ __('You want to start immediately, without onboarding') }}
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="mt-1.5 h-1.5 w-1.5 shrink-0 rounded-full bg-gray-400"></span>
                            {{ __('You\'re looking for the cheapest solution') }}
                        </li>
                    </ul>
                    <p class="mt-6 text-sm text-gray-500">
                        {!! __('If a standard solution is enough, check out our <a href=":kkv_url" class="font-medium text-indigo-600 hover:underline">SMB package</a> or the <a href=":pricing_url" class="font-medium text-indigo-600 hover:underline">pricing page</a>.', ['kkv_url' => route('solutions.kkv'), 'pricing_url' => route('pricing')]) !!}
                    </p>
                </div>
            </div>
        </div>
    </section>

    {{-- Testimonials --}}
    <section class="bg-gray-50 py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto max-w-3xl text-center">
                <h2 class="mb-4 text-3xl font-bold text-gray-900 sm:text-4xl">
                    {{ __('Our clients said') }}
                </h2>
            </div>

            <div class="mt-12 grid gap-8 lg:grid-cols-2">
                <div class="rounded-2xl bg-white p-8 shadow-sm">
                    <div class="mb-6 flex items-center gap-1">
                        @for ($i = 0; $i < 5; $i++)
                            <svg class="h-5 w-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg>
                        @endfor
                    </div>
                    <blockquote class="mb-6 text-lg text-gray-700">
                        {{ __('"We used to work with 4 different systems, now everything is in one place. The Cégem360 team understood exactly what we needed."') }}
                    </blockquote>
                    <div class="flex items-center gap-4">
                        <div class="flex h-12 w-12 items-center justify-center rounded-full bg-indigo-200 font-semibold text-indigo-700">TK</div>
                        <div>
                            <div class="font-semibold text-gray-900">{{ __('Katalin Toth') }}</div>
                            <div class="text-sm text-gray-600">{{ __('CEO, Medium-sized manufacturing company') }}</div>
                        </div>
                    </div>
                </div>

                <div class="rounded-2xl bg-white p-8 shadow-sm">
                    <div class="mb-6 flex items-center gap-1">
                        @for ($i = 0; $i < 5; $i++)
                            <svg class="h-5 w-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg>
                        @endfor
                    </div>
                    <blockquote class="mb-6 text-lg text-gray-700">
                        {{ __('"The deployment was smooth, and since then there\'s always someone to count on when I have questions. This is real partnership."') }}
                    </blockquote>
                    <div class="flex items-center gap-4">
                        <div class="flex h-12 w-12 items-center justify-center rounded-full bg-indigo-200 font-semibold text-indigo-700">NP</div>
                        <div>
                            <div class="font-semibold text-gray-900">{{ __('Peter Nagy') }}</div>
                            <div class="text-sm text-gray-600">{{ __('Owner, Commercial business') }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- FAQ Section --}}
    <section class="bg-white py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto max-w-3xl text-center">
                <h2 class="mb-4 text-3xl font-bold text-gray-900 sm:text-4xl">
                    {{ __('Frequently asked questions') }}
                </h2>
            </div>

            <div class="mx-auto mt-12 max-w-3xl space-y-4">
                <div x-data="{ open: false }" class="rounded-xl bg-gray-50 shadow-sm">
                    <button @click="open = !open" class="flex w-full items-center justify-between p-6 text-left">
                        <span class="font-semibold text-gray-900">{{ __('What size companies is it recommended for?') }}</span>
                        <svg class="h-5 w-5 text-gray-500 transition-transform" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="open" x-collapse class="px-6 pb-6">
                        <p class="text-gray-600">{{ __('For any size company that has unique needs. We\'ve worked with 5-person startups and 500-person manufacturing companies. What matters isn\'t the size, but that standard solutions don\'t meet your needs.') }}</p>
                    </div>
                </div>

                <div x-data="{ open: false }" class="rounded-xl bg-gray-50 shadow-sm">
                    <button @click="open = !open" class="flex w-full items-center justify-between p-6 text-left">
                        <span class="font-semibold text-gray-900">{{ __('How long does a custom project take?') }}</span>
                        <svg class="h-5 w-5 text-gray-500 transition-transform" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="open" x-collapse class="px-6 pb-6">
                        <p class="text-gray-600">{{ __('Depending on project complexity, 4-16 weeks. A simpler integration can be done in 2 weeks, while a full custom system development can take several months. We\'ll give a more precise estimate during the consultation.') }}</p>
                    </div>
                </div>

                <div x-data="{ open: false }" class="rounded-xl bg-gray-50 shadow-sm">
                    <button @click="open = !open" class="flex w-full items-center justify-between p-6 text-left">
                        <span class="font-semibold text-gray-900">{{ __('What happens if my needs change during the project?') }}</span>
                        <svg class="h-5 w-5 text-gray-500 transition-transform" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="open" x-collapse class="px-6 pb-6">
                        <p class="text-gray-600">{{ __('We work with agile methodology, which means we can flexibly adapt to changing needs. We hold regular demos and adjust direction as needed.') }}</p>
                    </div>
                </div>

                <div x-data="{ open: false }" class="rounded-xl bg-gray-50 shadow-sm">
                    <button @click="open = !open" class="flex w-full items-center justify-between p-6 text-left">
                        <span class="font-semibold text-gray-900">{{ __('Is there a trial period?') }}</span>
                        <svg class="h-5 w-5 text-gray-500 transition-transform" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="open" x-collapse class="px-6 pb-6">
                        <p class="text-gray-600">{{ __('For custom projects, we can provide a Proof of Concept (PoC) phase where you can test the solution on a smaller scope before committing to the full project.') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Bottom CTA Section --}}
    <section class="bg-linear-to-br from-indigo-600 to-indigo-800 py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto max-w-3xl text-center">
                <h2 class="mb-4 text-3xl font-bold text-white sm:text-4xl">
                    {{ __('Let\'s talk about your needs') }}
                </h2>
                <p class="mb-10 text-lg text-indigo-100">
                    {{ __('Let\'s schedule a 30-minute call where we understand your challenges and outline possible solutions. No commitment, just a conversation.') }}
                </p>
                <div class="flex flex-col justify-center gap-4 sm:flex-row">
                    <a href="{{ route('contact') }}"
                        class="inline-flex items-center justify-center gap-2 rounded-lg bg-white px-8 py-4 text-base font-semibold text-indigo-600 shadow-lg transition hover:bg-gray-50">
                        {{ __('Request a consultation') }}
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                        </svg>
                    </a>
                    <a href="{{ route('quote-request') }}"
                        class="inline-flex items-center justify-center gap-2 rounded-lg border-2 border-white/30 px-8 py-4 text-base font-semibold text-white transition hover:bg-white/10">
                        {{ __('Request a quote') }}
                    </a>
                </div>
            </div>
        </div>
    </section>
</div>
