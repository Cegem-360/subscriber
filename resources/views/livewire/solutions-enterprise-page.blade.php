<div>
    {{-- Hero Section --}}
    <section class="bg-linear-to-b from-gray-900 to-gray-800 py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto max-w-4xl text-center">
                <div
                    class="mb-6 inline-flex items-center gap-2 rounded-full bg-indigo-500/20 px-4 py-1.5 text-sm font-medium text-indigo-300">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                    </svg>
                    {{ __('Enterprise Solutions') }}
                </div>

                <h1 class="mb-6 text-4xl font-bold tracking-tight text-white sm:text-5xl lg:text-6xl">
                    {{ __('Custom solutions, dedicated resources') }}
                    <span class="text-indigo-400">{{ __('tailored to your company') }}</span>
                </h1>

                <p class="mx-auto mb-8 max-w-3xl text-lg text-gray-300 sm:text-xl">
                    {{ __('When standard solutions are no longer sufficient. The Cégem360 Enterprise program is for companies with unique needs, who expect dedicated resources, and count on the highest level of support and security.') }}
                </p>

                <div class="flex flex-col justify-center gap-4 sm:flex-row">
                    <a href="{{ route('contact') }}"
                        class="inline-flex items-center justify-center gap-2 rounded-lg bg-indigo-600 px-8 py-4 text-base font-semibold text-white shadow-lg transition hover:bg-indigo-700">
                        {{ __('Request Enterprise Consultation') }}
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 7l5 5m0 0l-5 5m5-5H6" />
                        </svg>
                    </a>
                    <a href="{{ route('quote-request') }}"
                        class="inline-flex items-center justify-center gap-2 rounded-lg border-2 border-gray-600 px-8 py-4 text-base font-semibold text-white transition hover:bg-gray-800">
                        {{ __('Request a Quote') }}
                    </a>
                </div>

                <div class="mt-10 flex flex-wrap items-center justify-center gap-x-8 gap-y-4 text-sm text-gray-400">
                    <div class="flex items-center gap-2">
                        <svg class="h-5 w-5 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        {{ __('99.9% SLA guarantee') }}
                    </div>
                    <div class="flex items-center gap-2">
                        <svg class="h-5 w-5 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        {{ __('Dedicated support') }}
                    </div>
                    <div class="flex items-center gap-2">
                        <svg class="h-5 w-5 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        {{ __('Custom integrations') }}
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Why Enterprise Section --}}
    <section class="bg-white py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto max-w-3xl text-center">
                <h2 class="mb-4 text-3xl font-bold text-gray-900 sm:text-4xl">
                    {{ __('Why do large companies choose the Enterprise program?') }}
                </h2>
                <p class="text-lg text-gray-600">
                    {{ __('Above a certain company size, standard SaaS solutions hit their limits. Unique processes, special integration needs, strict compliance requirements.') }}
                </p>
            </div>

            <div class="mt-12 grid gap-8 md:grid-cols-2 lg:grid-cols-4">
                <div class="rounded-xl bg-gray-50 p-6">
                    <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-lg bg-red-100">
                        <svg class="h-6 w-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4" />
                        </svg>
                    </div>
                    <h3 class="mb-2 font-semibold text-gray-900">{{ __('Fragmented systems') }}</h3>
                    <p class="text-sm text-gray-600">{{ __('Different departments use different tools, data gets stuck in silos.') }}</p>
                </div>

                <div class="rounded-xl bg-gray-50 p-6">
                    <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-lg bg-red-100">
                        <svg class="h-6 w-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="mb-2 font-semibold text-gray-900">{{ __('Slow decision-making') }}</h3>
                    <p class="text-sm text-gray-600">{{ __('By the time data is collected and processed, the market situation changes.') }}</p>
                </div>

                <div class="rounded-xl bg-gray-50 p-6">
                    <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-lg bg-red-100">
                        <svg class="h-6 w-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                    </div>
                    <h3 class="mb-2 font-semibold text-gray-900">{{ __('Compliance risks') }}</h3>
                    <p class="text-sm text-gray-600">{{ __('GDPR, SOC 2, ISO - compliance requires continuous attention.') }}</p>
                </div>

                <div class="rounded-xl bg-gray-50 p-6">
                    <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-lg bg-red-100">
                        <svg class="h-6 w-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                        </svg>
                    </div>
                    <h3 class="mb-2 font-semibold text-gray-900">{{ __('Scalability limits') }}</h3>
                    <p class="text-sm text-gray-600">{{ __('The current system cannot handle the growth, migration is risky.') }}
                    </p>
                </div>
            </div>

            <div class="mt-12 text-center">
                <p class="text-lg font-semibold text-indigo-600">
                    {{ __('Cégem360 Enterprise is not a package — it\'s a partnership.') }}
                </p>
            </div>
        </div>
    </section>

    {{-- 5 Pillars Section --}}
    <section class="bg-gray-50 py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto max-w-3xl text-center">
                <div
                    class="mb-4 inline-flex items-center gap-2 rounded-full bg-indigo-100 px-4 py-1.5 text-sm font-medium text-indigo-700">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                    </svg>
                    {{ __('The 5 pillars of the Enterprise program') }}
                </div>
                <h2 class="mb-4 text-3xl font-bold text-gray-900 sm:text-4xl">
                    {{ __('Everything you need for successful operations') }}
                </h2>
            </div>

            <div class="mt-16 space-y-16">
                {{-- Pillar 1: Dedicated Server --}}
                <div class="grid items-center gap-12 lg:grid-cols-2">
                    <div>
                        <div
                            class="mb-4 inline-flex items-center gap-2 rounded-full bg-indigo-600 px-3 py-1 text-sm font-medium text-white">
                            {{ __('Pillar 1') }}
                        </div>
                        <h3 class="mb-4 text-2xl font-bold text-gray-900">{{ __('Dedicated server environment') }}</h3>
                        <p class="mb-6 text-gray-600">
                            {{ __('Your data, on your server — full control and security. The dedicated server environment means your Cégem360 system runs on physically separated infrastructure.') }}
                        </p>

                        <div class="grid gap-4 sm:grid-cols-2">
                            <div class="rounded-lg bg-white p-4 shadow-sm">
                                <h4 class="mb-2 font-semibold text-gray-900">{{ __('Performance guarantee') }}</h4>
                                <ul class="space-y-1 text-sm text-gray-600">
                                    <li>{{ __('Guaranteed CPU, RAM, and storage') }}</li>
                                    <li>{{ __('No slowdowns due to other customers') }}</li>
                                    <li>{{ __('Scalable resources') }}</li>
                                </ul>
                            </div>
                            <div class="rounded-lg bg-white p-4 shadow-sm">
                                <h4 class="mb-2 font-semibold text-gray-900">{{ __('Data security') }}</h4>
                                <ul class="space-y-1 text-sm text-gray-600">
                                    <li>{{ __('Physically separated storage') }}</li>
                                    <li>{{ __('Unique encryption keys') }}</li>
                                    <li>{{ __('Selectable data center (EU, HU)') }}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="rounded-2xl bg-white p-8 shadow-lg">
                        <h4 class="mb-6 font-semibold text-gray-900">{{ __('Deployment options') }}</h4>
                        <div class="space-y-4">
                            <div class="flex items-start gap-4 rounded-lg border border-gray-100 p-4">
                                <div
                                    class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-indigo-100">
                                    <svg class="h-5 w-5 text-indigo-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z" />
                                    </svg>
                                </div>
                                <div>
                                    <h5 class="font-medium text-gray-900">{{ __('Dedicated cloud') }}</h5>
                                    <p class="text-sm text-gray-600">{{ __('Quick start, minimal IT burden') }}</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-4 rounded-lg border border-gray-100 p-4">
                                <div
                                    class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-indigo-100">
                                    <svg class="h-5 w-5 text-indigo-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                    </svg>
                                </div>
                                <div>
                                    <h5 class="font-medium text-gray-900">{{ __('Private cloud') }}</h5>
                                    <p class="text-sm text-gray-600">{{ __('AWS, Azure, GCP — leverage existing investment') }}</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-4 rounded-lg border border-gray-100 p-4">
                                <div
                                    class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-indigo-100">
                                    <svg class="h-5 w-5 text-indigo-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 12h14M5 12a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v4a2 2 0 01-2 2M5 12a2 2 0 00-2 2v4a2 2 0 002 2h14a2 2 0 002-2v-4a2 2 0 00-2-2" />
                                    </svg>
                                </div>
                                <div>
                                    <h5 class="font-medium text-gray-900">{{ __('On-premise') }}</h5>
                                    <p class="text-sm text-gray-600">{{ __('Maximum control, strict compliance') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Pillar 2: Custom Integrations --}}
                <div class="grid items-center gap-12 lg:grid-cols-2">
                    <div class="order-2 lg:order-1">
                        <div class="rounded-2xl bg-white p-8 shadow-lg">
                            <h4 class="mb-6 font-semibold text-gray-900">{{ __('Typical integrations') }}</h4>
                            <div class="grid gap-3 sm:grid-cols-2">
                                <div class="flex items-center gap-3 rounded-lg bg-gray-50 p-3">
                                    <span class="text-2xl">📊</span>
                                    <div>
                                        <p class="text-sm font-medium text-gray-900">ERP</p>
                                        <p class="text-xs text-gray-500">SAP, Dynamics, Odoo</p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-3 rounded-lg bg-gray-50 p-3">
                                    <span class="text-2xl">👥</span>
                                    <div>
                                        <p class="text-sm font-medium text-gray-900">HR</p>
                                        <p class="text-xs text-gray-500">Workday, BambooHR</p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-3 rounded-lg bg-gray-50 p-3">
                                    <span class="text-2xl">📈</span>
                                    <div>
                                        <p class="text-sm font-medium text-gray-900">BI/Analytics</p>
                                        <p class="text-xs text-gray-500">Power BI, Tableau</p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-3 rounded-lg bg-gray-50 p-3">
                                    <span class="text-2xl">🛒</span>
                                    <div>
                                        <p class="text-sm font-medium text-gray-900">E-commerce</p>
                                        <p class="text-xs text-gray-500">Shopify, Magento</p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-3 rounded-lg bg-gray-50 p-3">
                                    <span class="text-2xl">📧</span>
                                    <div>
                                        <p class="text-sm font-medium text-gray-900">Marketing</p>
                                        <p class="text-xs text-gray-500">HubSpot, Marketo</p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-3 rounded-lg bg-gray-50 p-3">
                                    <span class="text-2xl">💬</span>
                                    <div>
                                        <p class="text-sm font-medium text-gray-900">{{ __('Communication') }}</p>
                                        <p class="text-xs text-gray-500">Slack, Teams</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="order-1 lg:order-2">
                        <div
                            class="mb-4 inline-flex items-center gap-2 rounded-full bg-indigo-600 px-3 py-1 text-sm font-medium text-white">
                            {{ __('Pillar 2') }}
                        </div>
                        <h3 class="mb-4 text-2xl font-bold text-gray-900">{{ __('Custom integration development') }}</h3>
                        <p class="mb-6 text-gray-600">
                            {{ __('Connect Cégem360 with your existing systems — seamlessly. Every company has its own systems: ERP, HR, BI, legacy applications.') }}
                        </p>

                        <div class="space-y-4">
                            <div class="flex items-start gap-3">
                                <div
                                    class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-indigo-100 text-sm font-semibold text-indigo-600">
                                    1</div>
                                <div>
                                    <h5 class="font-medium text-gray-900">{{ __('Assessment and planning') }}</h5>
                                    <p class="text-sm text-gray-600">{{ __('Mapping existing systems and data flows') }}
                                    </p>
                                </div>
                            </div>
                            <div class="flex items-start gap-3">
                                <div
                                    class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-indigo-100 text-sm font-semibold text-indigo-600">
                                    2</div>
                                <div>
                                    <h5 class="font-medium text-gray-900">{{ __('Development') }}</h5>
                                    <p class="text-sm text-gray-600">{{ __('Dedicated development team, agile methodology') }}</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-3">
                                <div
                                    class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-indigo-100 text-sm font-semibold text-indigo-600">
                                    3</div>
                                <div>
                                    <h5 class="font-medium text-gray-900">{{ __('Testing and go-live') }}</h5>
                                    <p class="text-sm text-gray-600">{{ __('Comprehensive testing, staged rollout') }}</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-3">
                                <div
                                    class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-indigo-100 text-sm font-semibold text-indigo-600">
                                    4</div>
                                <div>
                                    <h5 class="font-medium text-gray-900">{{ __('Maintenance') }}</h5>
                                    <p class="text-sm text-gray-600">{{ __('Continuous monitoring and further development') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Pillar 3: SLA --}}
                <div class="grid items-center gap-12 lg:grid-cols-2">
                    <div>
                        <div
                            class="mb-4 inline-flex items-center gap-2 rounded-full bg-indigo-600 px-3 py-1 text-sm font-medium text-white">
                            {{ __('Pillar 3') }}
                        </div>
                        <h3 class="mb-4 text-2xl font-bold text-gray-900">{{ __('SLA guarantee — 99.9% uptime') }}</h3>
                        <p class="mb-6 text-gray-600">
                            {{ __('When the system is critical, availability is not an option — it\'s a requirement. The Enterprise SLA provides contractually guaranteed system performance.') }}
                        </p>

                        <div class="overflow-hidden rounded-xl border border-gray-200 bg-white">
                            <table class="w-full text-sm">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-4 py-3 text-left font-semibold text-gray-900">{{ __('Level') }}</th>
                                        <th class="px-4 py-3 text-left font-semibold text-gray-900">{{ __('Uptime') }}</th>
                                        <th class="px-4 py-3 text-left font-semibold text-gray-900">{{ __('Max. downtime/month') }}</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100">
                                    <tr>
                                        <td class="px-4 py-3 text-gray-600">Standard</td>
                                        <td class="px-4 py-3 text-gray-600">99,5%</td>
                                        <td class="px-4 py-3 text-gray-600">{{ __('3.6 hours') }}</td>
                                    </tr>
                                    <tr class="bg-indigo-50">
                                        <td class="px-4 py-3 font-medium text-indigo-700">Enterprise</td>
                                        <td class="px-4 py-3 font-medium text-indigo-700">99,9%</td>
                                        <td class="px-4 py-3 font-medium text-indigo-700">{{ __('43 minutes') }}</td>
                                    </tr>
                                    <tr>
                                        <td class="px-4 py-3 text-gray-600">Enterprise+</td>
                                        <td class="px-4 py-3 text-gray-600">99,95%</td>
                                        <td class="px-4 py-3 font-medium text-gray-600">{{ __('22 minutes') }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="rounded-2xl bg-white p-8 shadow-lg">
                        <h4 class="mb-6 font-semibold text-gray-900">{{ __('Incident management') }}</h4>
                        <div class="space-y-4">
                            <div
                                class="flex items-center justify-between rounded-lg border-l-4 border-red-500 bg-red-50 p-4">
                                <div>
                                    <p class="font-medium text-gray-900">{{ __('P1 — Critical') }}</p>
                                    <p class="text-sm text-gray-600">{{ __('System unavailable') }}</p>
                                </div>
                                <div class="text-right">
                                    <p class="font-semibold text-red-600">{{ __('15 minutes') }}</p>
                                    <p class="text-xs text-gray-500">{{ __('response time') }}</p>
                                </div>
                            </div>
                            <div
                                class="flex items-center justify-between rounded-lg border-l-4 border-orange-500 bg-orange-50 p-4">
                                <div>
                                    <p class="font-medium text-gray-900">{{ __('P2 — High') }}</p>
                                    <p class="text-sm text-gray-600">{{ __('Main function not working') }}</p>
                                </div>
                                <div class="text-right">
                                    <p class="font-semibold text-orange-600">{{ __('1 hour') }}</p>
                                    <p class="text-xs text-gray-500">{{ __('response time') }}</p>
                                </div>
                            </div>
                            <div
                                class="flex items-center justify-between rounded-lg border-l-4 border-yellow-500 bg-yellow-50 p-4">
                                <div>
                                    <p class="font-medium text-gray-900">{{ __('P3 — Medium') }}</p>
                                    <p class="text-sm text-gray-600">{{ __('Function limited') }}</p>
                                </div>
                                <div class="text-right">
                                    <p class="font-semibold text-yellow-600">{{ __('4 hours') }}</p>
                                    <p class="text-xs text-gray-500">{{ __('response time') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Pillar 4: Support --}}
                <div class="grid items-center gap-12 lg:grid-cols-2">
                    <div class="order-2 lg:order-1">
                        <div class="rounded-2xl bg-white p-8 shadow-lg">
                            <h4 class="mb-6 font-semibold text-gray-900">{{ __('Support channels') }}</h4>
                            <div class="space-y-3">
                                <div class="flex items-center gap-4 rounded-lg bg-gray-50 p-4">
                                    <svg class="h-6 w-6 text-indigo-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                    </svg>
                                    <div>
                                        <p class="font-medium text-gray-900">{{ __('Phone (hotline)') }}</p>
                                        <p class="text-sm text-gray-600">{{ __('Mon-Fri 8:00-18:00 — urgent issues') }}</p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-4 rounded-lg bg-gray-50 p-4">
                                    <svg class="h-6 w-6 text-indigo-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                    </svg>
                                    <div>
                                        <p class="font-medium text-gray-900">{{ __('Slack/Teams channel') }}</p>
                                        <p class="text-sm text-gray-600">{{ __('10/5 — quick questions, daily communication') }}</p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-4 rounded-lg bg-gray-50 p-4">
                                    <svg class="h-6 w-6 text-indigo-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                    </svg>
                                    <div>
                                        <p class="font-medium text-gray-900">{{ __('Screen sharing') }}</p>
                                        <p class="text-sm text-gray-600">{{ __('Unlimited — complex issues') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="order-1 lg:order-2">
                        <div
                            class="mb-4 inline-flex items-center gap-2 rounded-full bg-indigo-600 px-3 py-1 text-sm font-medium text-white">
                            {{ __('Pillar 4') }}
                        </div>
                        <h3 class="mb-4 text-2xl font-bold text-gray-900">{{ __('Priority support (10/5)') }}</h3>
                        <p class="mb-6 text-gray-600">
                            {{ __('A dedicated support team that knows your system and business. Enterprise support is not an anonymous helpdesk — it\'s a dedicated team.') }}
                        </p>

                        <ul class="space-y-3">
                            <li class="flex items-start gap-3">
                                <svg class="mt-0.5 h-5 w-5 shrink-0 text-green-500" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                                <span class="text-gray-600">{{ __('Dedicated support engineer — named contact person') }}</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <svg class="mt-0.5 h-5 w-5 shrink-0 text-green-500" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                                <span class="text-gray-600">{{ __('Priority handling — guaranteed response times') }}</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <svg class="mt-0.5 h-5 w-5 shrink-0 text-green-500" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                                <span class="text-gray-600">{{ __('Proactive support — regular health checks') }}</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <svg class="mt-0.5 h-5 w-5 shrink-0 text-green-500" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                                <span class="text-gray-600">{{ __('Knowledge transfer — admin and power user training') }}</span>
                            </li>
                        </ul>
                    </div>
                </div>

                {{-- Pillar 5: Account Manager --}}
                <div class="grid items-center gap-12 lg:grid-cols-2">
                    <div>
                        <div
                            class="mb-4 inline-flex items-center gap-2 rounded-full bg-indigo-600 px-3 py-1 text-sm font-medium text-white">
                            {{ __('Pillar 5') }}
                        </div>
                        <h3 class="mb-4 text-2xl font-bold text-gray-900">{{ __('Personal Account Manager') }}</h3>
                        <p class="mb-6 text-gray-600">
                            {{ __('A dedicated contact person who works for your success. The Account Manager is not a salesperson — they are your internal advocate.') }}
                        </p>

                        <div class="space-y-4">
                            <div class="rounded-lg border border-gray-200 bg-white p-4">
                                <h5 class="mb-2 font-medium text-gray-900">{{ __('Onboarding and implementation') }}</h5>
                                <p class="text-sm text-gray-600">{{ __('Project plan, stakeholder management, go-live criteria') }}
                                </p>
                            </div>
                            <div class="rounded-lg border border-gray-200 bg-white p-4">
                                <h5 class="mb-2 font-medium text-gray-900">{{ __('Ongoing partnership') }}</h5>
                                <p class="text-sm text-gray-600">{{ __('Regular check-in calls, mapping business needs') }}</p>
                            </div>
                            <div class="rounded-lg border border-gray-200 bg-white p-4">
                                <h5 class="mb-2 font-medium text-gray-900">{{ __('Business consulting') }}</h5>
                                <p class="text-sm text-gray-600">{{ __('Best practices, ROI measurement, demonstrating business value') }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="rounded-2xl bg-indigo-600 p-8 text-white">
                        <h4 class="mb-6 text-xl font-semibold">{{ __('Quarterly Business Review (QBR)') }}</h4>
                        <p class="mb-6 text-indigo-100">
                            {{ __('Every quarter, a personal meeting with your Account Manager:') }}
                        </p>
                        <div class="space-y-4">
                            <div class="flex items-start gap-3">
                                <div
                                    class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-white/20 text-sm font-semibold">
                                    1</div>
                                <div>
                                    <p class="font-medium">{{ __('Previous quarter review') }}</p>
                                    <p class="text-sm text-indigo-200">{{ __('Usage statistics, achieved results') }}</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-3">
                                <div
                                    class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-white/20 text-sm font-semibold">
                                    2</div>
                                <div>
                                    <p class="font-medium">{{ __('Current situation') }}</p>
                                    <p class="text-sm text-indigo-200">{{ __('User satisfaction, open questions') }}</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-3">
                                <div
                                    class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-white/20 text-sm font-semibold">
                                    3</div>
                                <div>
                                    <p class="font-medium">{{ __('Next quarter') }}</p>
                                    <p class="text-sm text-indigo-200">{{ __('Business priorities, planned developments') }}</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-3">
                                <div
                                    class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-white/20 text-sm font-semibold">
                                    4</div>
                                <div>
                                    <p class="font-medium">{{ __('Long-term strategy') }}</p>
                                    <p class="text-sm text-indigo-200">{{ __('Roadmap alignment, partnership development') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Security Section --}}
    <section class="bg-gray-900 py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto max-w-3xl text-center">
                <h2 class="mb-4 text-3xl font-bold text-white sm:text-4xl">
                    {{ __('Security and compliance') }}
                </h2>
                <p class="text-lg text-gray-400">
                    {{ __('The highest level of data protection and compliance') }}
                </p>
            </div>

            <div class="mt-12 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                <div class="flex items-center gap-4 rounded-xl border border-gray-700 bg-gray-800 p-6">
                    <svg class="h-8 w-8 shrink-0 text-green-400" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                    </svg>
                    <div>
                        <p class="font-medium text-white">SOC 2 Type II</p>
                        <p class="text-sm text-gray-400">{{ __('Certified infrastructure') }}</p>
                    </div>
                </div>

                <div class="flex items-center gap-4 rounded-xl border border-gray-700 bg-gray-800 p-6">
                    <svg class="h-8 w-8 shrink-0 text-green-400" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3" />
                    </svg>
                    <div>
                        <p class="font-medium text-white">{{ __('GDPR compliant') }}</p>
                        <p class="text-sm text-gray-400">{{ __('Data protection built in') }}</p>
                    </div>
                </div>

                <div class="flex items-center gap-4 rounded-xl border border-gray-700 bg-gray-800 p-6">
                    <svg class="h-8 w-8 shrink-0 text-green-400" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                    <div>
                        <p class="font-medium text-white">{{ __('AES-256 encryption') }}</p>
                        <p class="text-sm text-gray-400">{{ __('At rest and in transit') }}</p>
                    </div>
                </div>

                <div class="flex items-center gap-4 rounded-xl border border-gray-700 bg-gray-800 p-6">
                    <svg class="h-8 w-8 shrink-0 text-green-400" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
                    </svg>
                    <div>
                        <p class="font-medium text-white">{{ __('SSO integration') }}</p>
                        <p class="text-sm text-gray-400">SAML, OIDC, AD</p>
                    </div>
                </div>

                <div class="flex items-center gap-4 rounded-xl border border-gray-700 bg-gray-800 p-6">
                    <svg class="h-8 w-8 shrink-0 text-green-400" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                    </svg>
                    <div>
                        <p class="font-medium text-white">{{ __('Full audit trail') }}</p>
                        <p class="text-sm text-gray-400">{{ __('SIEM integration') }}</p>
                    </div>
                </div>

                <div class="flex items-center gap-4 rounded-xl border border-gray-700 bg-gray-800 p-6">
                    <svg class="h-8 w-8 shrink-0 text-green-400" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    <div>
                        <p class="font-medium text-white">{{ __('Penetration test') }}</p>
                        <p class="text-sm text-gray-400">{{ __('Annual external audit') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Implementation Process --}}
    <section class="bg-white py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto max-w-3xl text-center">
                <h2 class="mb-4 text-3xl font-bold text-gray-900 sm:text-4xl">
                    {{ __('The Enterprise implementation process') }}
                </h2>
                <p class="text-lg text-gray-600">
                    {{ __('A structured approach for successful implementation') }}
                </p>
            </div>

            <div class="mt-12">
                <div class="relative">
                    <div class="absolute left-8 top-0 hidden h-full w-0.5 bg-indigo-200 lg:block"></div>

                    <div class="space-y-8">
                        <div class="relative flex gap-8">
                            <div class="hidden lg:flex lg:flex-col lg:items-center">
                                <div
                                    class="flex h-16 w-16 items-center justify-center rounded-full bg-indigo-600 text-xl font-bold text-white">
                                    1</div>
                            </div>
                            <div class="flex-1 rounded-xl bg-gray-50 p-6">
                                <div class="mb-2 flex items-center gap-3">
                                    <div
                                        class="flex h-10 w-10 items-center justify-center rounded-full bg-indigo-600 text-sm font-bold text-white lg:hidden">
                                        1</div>
                                    <h3 class="text-xl font-semibold text-gray-900">{{ __('Assessment and planning') }}</h3>
                                    <span
                                        class="rounded-full bg-indigo-100 px-3 py-1 text-sm font-medium text-indigo-700">{{ __('2-4 weeks') }}</span>
                                </div>
                                <p class="text-gray-600">{{ __('Kickoff meeting, mapping current systems, assembling the project plan') }}</p>
                            </div>
                        </div>

                        <div class="relative flex gap-8">
                            <div class="hidden lg:flex lg:flex-col lg:items-center">
                                <div
                                    class="flex h-16 w-16 items-center justify-center rounded-full bg-indigo-600 text-xl font-bold text-white">
                                    2</div>
                            </div>
                            <div class="flex-1 rounded-xl bg-gray-50 p-6">
                                <div class="mb-2 flex items-center gap-3">
                                    <div
                                        class="flex h-10 w-10 items-center justify-center rounded-full bg-indigo-600 text-sm font-bold text-white lg:hidden">
                                        2</div>
                                    <h3 class="text-xl font-semibold text-gray-900">{{ __('Configuration and development') }}</h3>
                                    <span
                                        class="rounded-full bg-indigo-100 px-3 py-1 text-sm font-medium text-indigo-700">{{ __('4-12 weeks') }}</span>
                                </div>
                                <p class="text-gray-600">{{ __('Building the dedicated environment, developing custom integrations, data migration') }}</p>
                            </div>
                        </div>

                        <div class="relative flex gap-8">
                            <div class="hidden lg:flex lg:flex-col lg:items-center">
                                <div
                                    class="flex h-16 w-16 items-center justify-center rounded-full bg-indigo-600 text-xl font-bold text-white">
                                    3</div>
                            </div>
                            <div class="flex-1 rounded-xl bg-gray-50 p-6">
                                <div class="mb-2 flex items-center gap-3">
                                    <div
                                        class="flex h-10 w-10 items-center justify-center rounded-full bg-indigo-600 text-sm font-bold text-white lg:hidden">
                                        3</div>
                                    <h3 class="text-xl font-semibold text-gray-900">{{ __('Implementation and training') }}</h3>
                                    <span
                                        class="rounded-full bg-indigo-100 px-3 py-1 text-sm font-medium text-indigo-700">{{ __('2-4 weeks') }}</span>
                                </div>
                                <p class="text-gray-600">{{ __('Admin and power user training, staged rollout, go-live support') }}</p>
                            </div>
                        </div>

                        <div class="relative flex gap-8">
                            <div class="hidden lg:flex lg:flex-col lg:items-center">
                                <div
                                    class="flex h-16 w-16 items-center justify-center rounded-full bg-indigo-600 text-xl font-bold text-white">
                                    4</div>
                            </div>
                            <div class="flex-1 rounded-xl bg-gray-50 p-6">
                                <div class="mb-2 flex items-center gap-3">
                                    <div
                                        class="flex h-10 w-10 items-center justify-center rounded-full bg-indigo-600 text-sm font-bold text-white lg:hidden">
                                        4</div>
                                    <h3 class="text-xl font-semibold text-gray-900">{{ __('Stabilization and optimization') }}</h3>
                                    <span
                                        class="rounded-full bg-indigo-100 px-3 py-1 text-sm font-medium text-indigo-700">{{ __('4-8 weeks') }}</span>
                                </div>
                                <p class="text-gray-600">{{ __('Hypercare period, performance monitoring, optimization recommendations') }}</p>
                            </div>
                        </div>

                        <div class="relative flex gap-8">
                            <div class="hidden lg:flex lg:flex-col lg:items-center">
                                <div
                                    class="flex h-16 w-16 items-center justify-center rounded-full bg-green-600 text-xl font-bold text-white">
                                    <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7" />
                                    </svg>
                                </div>
                            </div>
                            <div class="flex-1 rounded-xl bg-green-50 p-6">
                                <div class="mb-2 flex items-center gap-3">
                                    <div
                                        class="flex h-10 w-10 items-center justify-center rounded-full bg-green-600 text-white lg:hidden">
                                        <svg class="h-5 w-5" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 13l4 4L19 7" />
                                        </svg>
                                    </div>
                                    <h3 class="text-xl font-semibold text-gray-900">{{ __('Ongoing partnership') }}</h3>
                                </div>
                                <p class="text-gray-600">{{ __('Regular check-ins, quarterly business reviews, continuous development') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Who Is It For --}}
    <section class="bg-gray-50 py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto max-w-3xl text-center">
                <h2 class="mb-4 text-3xl font-bold text-gray-900 sm:text-4xl">
                    {{ __('Who do we recommend the Enterprise program for?') }}
                </h2>
            </div>

            <div class="mt-12 grid gap-8 lg:grid-cols-2">
                <div class="rounded-2xl bg-white p-8 shadow-sm">
                    <h3 class="mb-6 text-xl font-semibold text-gray-900">{{ __('Ideal if...') }}</h3>
                    <ul class="space-y-4">
                        <li class="flex items-start gap-3">
                            <svg class="mt-0.5 h-6 w-6 shrink-0 text-green-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            <span class="text-gray-600"><strong class="text-gray-900">{{ __('100+ users') }}</strong> {{ __('will use the system') }}</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <svg class="mt-0.5 h-6 w-6 shrink-0 text-green-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            <span class="text-gray-600"><strong class="text-gray-900">{{ __('Custom integrations') }}</strong>
                                {{ __('are needed with existing systems') }}</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <svg class="mt-0.5 h-6 w-6 shrink-0 text-green-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            <span class="text-gray-600"><strong class="text-gray-900">{{ __('Strict compliance requirements') }}</strong> {{ __('must be met') }}</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <svg class="mt-0.5 h-6 w-6 shrink-0 text-green-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            <span class="text-gray-600"><strong class="text-gray-900">{{ __('Dedicated resources') }}</strong>
                                {{ __('and personal support are expected') }}</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <svg class="mt-0.5 h-6 w-6 shrink-0 text-green-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            <span class="text-gray-600"><strong class="text-gray-900">{{ __('A long-term partner') }}</strong>
                                {{ __('is needed, not just software') }}</span>
                        </li>
                    </ul>
                </div>

                <div class="rounded-2xl bg-white p-8 shadow-sm">
                    <h3 class="mb-6 text-xl font-semibold text-gray-900">{{ __('Typical Enterprise clients') }}</h3>
                    <div class="space-y-4">
                        <div class="flex items-center gap-4 rounded-lg bg-gray-50 p-4">
                            <span class="text-2xl">🏭</span>
                            <div>
                                <p class="font-medium text-gray-900">{{ __('Manufacturing') }}</p>
                                <p class="text-sm text-gray-600">{{ __('MES integration, multiple sites, OEE monitoring') }}</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-4 rounded-lg bg-gray-50 p-4">
                            <span class="text-2xl">🏪</span>
                            <div>
                                <p class="font-medium text-gray-900">{{ __('Retail') }}</p>
                                <p class="text-sm text-gray-600">{{ __('ERP connection, webshop integration, multi-currency') }}</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-4 rounded-lg bg-gray-50 p-4">
                            <span class="text-2xl">🏦</span>
                            <div>
                                <p class="font-medium text-gray-900">{{ __('Finance') }}</p>
                                <p class="text-sm text-gray-600">{{ __('Strict compliance, audit trail, encryption') }}</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-4 rounded-lg bg-gray-50 p-4">
                            <span class="text-2xl">🚚</span>
                            <div>
                                <p class="font-medium text-gray-900">{{ __('Logistics') }}</p>
                                <p class="text-sm text-gray-600">{{ __('EDI, multiple warehouses, carrier integrations') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Testimonials --}}
    <section class="bg-white py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto max-w-3xl text-center">
                <h2 class="mb-4 text-3xl font-bold text-gray-900 sm:text-4xl">
                    {{ __('References') }}
                </h2>
            </div>

            <div class="mt-12 grid gap-8 lg:grid-cols-3">
                <div class="rounded-2xl bg-gray-50 p-8">
                    <div class="mb-6 flex items-center gap-1">
                        @for ($i = 0; $i < 5; $i++)
                            <svg class="h-5 w-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg>
                        @endfor
                    </div>
                    <blockquote class="mb-6 text-gray-700">
                        {{ __('"Cégem360 didn\'t just provide software, but a partner. Our Account Manager knows our processes better than some of our internal colleagues."') }}
                    </blockquote>
                    <div class="flex items-center gap-4">
                        <div
                            class="flex h-12 w-12 items-center justify-center rounded-full bg-indigo-200 font-semibold text-indigo-700">
                            HL</div>
                        <div>
                            <div class="font-semibold text-gray-900">{{ __('László Horváth') }}</div>
                            <div class="text-sm text-gray-600">{{ __('IT Director, Enterprise manufacturer') }}</div>
                        </div>
                    </div>
                </div>

                <div class="rounded-2xl bg-gray-50 p-8">
                    <div class="mb-6 flex items-center gap-1">
                        @for ($i = 0; $i < 5; $i++)
                            <svg class="h-5 w-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg>
                        @endfor
                    </div>
                    <blockquote class="mb-6 text-gray-700">
                        {{ __('"The dedicated environment and SLA guarantee were decisive. We cannot afford downtime with our critical system."') }}
                    </blockquote>
                    <div class="flex items-center gap-4">
                        <div
                            class="flex h-12 w-12 items-center justify-center rounded-full bg-indigo-200 font-semibold text-indigo-700">
                            SM</div>
                        <div>
                            <div class="font-semibold text-gray-900">{{ __('Dr. Mária Szabó') }}</div>
                            <div class="text-sm text-gray-600">{{ __('CFO, Financial services provider') }}</div>
                        </div>
                    </div>
                </div>

                <div class="rounded-2xl bg-gray-50 p-8">
                    <div class="mb-6 flex items-center gap-1">
                        @for ($i = 0; $i < 5; $i++)
                            <svg class="h-5 w-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg>
                        @endfor
                    </div>
                    <blockquote class="mb-6 text-gray-700">
                        {{ __('"The custom SAP integration was completed in 3 months, and it has been running flawlessly since. The support team\'s response time is exemplary."') }}
                    </blockquote>
                    <div class="flex items-center gap-4">
                        <div
                            class="flex h-12 w-12 items-center justify-center rounded-full bg-indigo-200 font-semibold text-indigo-700">
                            KA</div>
                        <div>
                            <div class="font-semibold text-gray-900">{{ __('András Kovács') }}</div>
                            <div class="text-sm text-gray-600">{{ __('Operations Director, Logistics company') }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- FAQ Section --}}
    <section class="bg-gray-50 py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto max-w-3xl text-center">
                <h2 class="mb-4 text-3xl font-bold text-gray-900 sm:text-4xl">
                    {{ __('Frequently Asked Questions') }}
                </h2>
            </div>

            <div class="mx-auto mt-12 max-w-3xl space-y-4">
                <div x-data="{ open: false }" class="rounded-xl bg-white shadow-sm">
                    <button @click="open = !open" class="flex w-full items-center justify-between p-6 text-left">
                        <span class="font-semibold text-gray-900">{{ __('How long does implementation take?') }}</span>
                        <svg class="h-5 w-5 text-gray-500 transition-transform" :class="{ 'rotate-180': open }"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="open" x-collapse class="px-6 pb-6">
                        <p class="text-gray-600">{{ __('Typically 3-6 months, depending on the complexity of custom requirements. Simpler projects can start in as little as 8 weeks.') }}</p>
                    </div>
                </div>

                <div x-data="{ open: false }" class="rounded-xl bg-white shadow-sm">
                    <button @click="open = !open" class="flex w-full items-center justify-between p-6 text-left">
                        <span class="font-semibold text-gray-900">{{ __('What systems can you integrate with?') }}</span>
                        <svg class="h-5 w-5 text-gray-500 transition-transform" :class="{ 'rotate-180': open }"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="open" x-collapse class="px-6 pb-6">
                        <p class="text-gray-600">{{ __('Almost anything that has an API or data export capability. The most popular: SAP, Microsoft Dynamics, Salesforce, HubSpot, Shopify, as well as numerous Hungarian systems (Billingo, Számlázz.hu, Nexon).') }}</p>
                    </div>
                </div>

                <div x-data="{ open: false }" class="rounded-xl bg-white shadow-sm">
                    <button @click="open = !open" class="flex w-full items-center justify-between p-6 text-left">
                        <span class="font-semibold text-gray-900">{{ __('What happens when the contract expires?') }}</span>
                        <svg class="h-5 w-5 text-gray-500 transition-transform" :class="{ 'rotate-180': open }"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="open" x-collapse class="px-6 pb-6">
                        <p class="text-gray-600">{{ __('Your data is yours. At the end of the contract, we provide a full data export in standard formats (CSV, JSON, XML). No vendor lock-in.') }}</p>
                    </div>
                </div>

                <div x-data="{ open: false }" class="rounded-xl bg-white shadow-sm">
                    <button @click="open = !open" class="flex w-full items-center justify-between p-6 text-left">
                        <span class="font-semibold text-gray-900">{{ __('Is there a trial period?') }}</span>
                        <svg class="h-5 w-5 text-gray-500 transition-transform" :class="{ 'rotate-180': open }"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="open" x-collapse class="px-6 pb-6">
                        <p class="text-gray-600">{{ __('For Enterprise projects, we can provide a Proof of Concept (PoC) period during which you can test the system on a limited scope.') }}</p>
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
                    {{ __('Next steps') }}
                </h2>
                <p class="mb-10 text-lg text-indigo-100">
                    {{ __('Let\'s schedule a 30-minute call where we understand your needs and challenges. Our experts will map your current systems and prepare a personalized offer.') }}
                </p>
                <div class="flex flex-col justify-center gap-4 sm:flex-row">
                    <a href="{{ route('contact') }}"
                        class="inline-flex items-center justify-center gap-2 rounded-lg bg-white px-8 py-4 text-base font-semibold text-indigo-600 shadow-lg transition hover:bg-gray-50">
                        {{ __('Request Enterprise Consultation') }}
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 7l5 5m0 0l-5 5m5-5H6" />
                        </svg>
                    </a>
                    <a href="{{ route('quote-request') }}"
                        class="inline-flex items-center justify-center gap-2 rounded-lg border-2 border-white/30 px-8 py-4 text-base font-semibold text-white transition hover:bg-white/10">
                        {{ __('Request a Quote') }}
                    </a>
                </div>
            </div>
        </div>
    </section>
</div>
