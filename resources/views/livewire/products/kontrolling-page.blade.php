<div>
    {{-- Hero Section --}}
    <section class="bg-linear-to-b from-emerald-50 to-white py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto max-w-4xl text-center">
                <div class="mb-6 flex justify-center">
                    <x-module-icon module="kontrolling" size="xl" />
                </div>
                <div
                    class="mb-6 inline-flex items-center gap-2 rounded-full bg-emerald-100 px-4 py-1.5 text-sm font-medium text-emerald-700">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                    </svg>
                    {{ __('Controlling Module') }}
                </div>
                <h1 class="mb-6 text-4xl font-semibold leading-tight text-gray-900 sm:text-5xl lg:text-6xl">
                    {{ __('Real-time financial overview and decision-support reports') }}
                </h1>
                <p class="mx-auto max-w-3xl text-lg leading-relaxed text-gray-600 sm:text-xl">
                    {{ __('See your company\'s finances at a glance. Revenue, costs, cash flow, project profitability — all on one dashboard. Make decisions based on data, not gut feeling.') }}
                </p>

                {{-- CTA Buttons --}}
                <div class="mt-8 flex flex-col items-center justify-center gap-4 sm:flex-row">
                    <a href="{{ route('register') }}"
                        class="inline-flex items-center justify-center gap-2 rounded-full bg-emerald-600 px-8 py-4 text-base font-semibold text-white shadow-lg transition-colors hover:bg-emerald-700 hover:shadow-xl">
                        {{ __('Get started') }}
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </a>
                    <a href="{{ route('contact') }}"
                        class="inline-flex items-center justify-center gap-2 rounded-full border-2 border-emerald-200 bg-white px-8 py-4 text-base font-semibold text-emerald-700 transition-colors hover:bg-emerald-50">
                        {{ __('Request a demo') }}
                    </a>
                    <a href="https://controlling.cegem360.eu/"
                        class="inline-flex items-center justify-center gap-2 text-base font-medium text-emerald-600 transition-colors hover:text-emerald-800">
                        {{ __('Log in to the application') }} →
                    </a>
                </div>

            </div>
        </div>
    </section>

    {{-- Problem Section --}}
    <section class="bg-white py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto mb-12 max-w-3xl text-center">
                <h2 class="text-3xl font-semibold text-gray-900 sm:text-4xl">{{ __('The problem we solve') }}</h2>
            </div>

            <div class="grid gap-6 sm:grid-cols-2">
                <div class="rounded-2xl border border-emerald-100 bg-linear-to-br from-emerald-50 to-white p-8">
                    <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-xl bg-white shadow-sm">
                        <svg class="h-6 w-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="mb-2 text-lg font-semibold text-gray-900">{{ __('End-of-month surprises') }}</h3>
                    <p class="text-gray-600">{{ __('You only find out how much the company earned (or lost) after closing.') }}</p>
                </div>
                <div class="rounded-2xl border border-emerald-100 bg-linear-to-br from-emerald-50 to-white p-8">
                    <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-xl bg-white shadow-sm">
                        <svg class="h-6 w-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4" />
                        </svg>
                    </div>
                    <h3 class="mb-2 text-lg font-semibold text-gray-900">{{ __('Scattered data') }}</h3>
                    <p class="text-gray-600">{{ __('Finance in one spreadsheet, sales in another, projects in a third.') }}</p>
                </div>
                <div class="rounded-2xl border border-emerald-100 bg-linear-to-br from-emerald-50 to-white p-8">
                    <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-xl bg-white shadow-sm">
                        <svg class="h-6 w-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="mb-2 text-lg font-semibold text-gray-900">{{ __('Slow report generation') }}</h3>
                    <p class="text-gray-600">{{ __('It takes days to compile the monthly report for management.') }}</p>
                </div>
                <div class="rounded-2xl border border-emerald-100 bg-linear-to-br from-emerald-50 to-white p-8">
                    <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-xl bg-white shadow-sm">
                        <svg class="h-6 w-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="mb-2 text-lg font-semibold text-gray-900">{{ __('You can\'t see the details') }}</h3>
                    <p class="text-gray-600">{{ __('You know profit is declining, but you don\'t know why.') }}</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Features Section --}}
    <section class="bg-gray-50 py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto mb-12 max-w-3xl text-center">
                <h2 class="text-3xl font-semibold text-gray-900 sm:text-4xl">{{ __('Key features') }}</h2>
                <p class="mt-4 text-lg text-gray-600">{{ __('Everything you need for financial control.') }}</p>
            </div>

            <div class="grid gap-8 lg:grid-cols-3">
                {{-- Pénzügyi dashboard --}}
                <div
                    class="rounded-2xl border border-gray-100 bg-white p-8 shadow-sm transition-shadow hover:shadow-lg">
                    <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-xl bg-emerald-100">
                        <svg class="h-6 w-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                    </div>
                    <h3 class="mb-3 text-xl font-semibold text-gray-900">{{ __('Financial dashboard') }}</h3>
                    <ul class="space-y-2 text-gray-600">
                        <li class="flex items-start gap-2">
                            <svg class="mt-1 h-4 w-4 shrink-0 text-emerald-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            {{ __('Real-time revenue and cost overview') }}
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="mt-1 h-4 w-4 shrink-0 text-emerald-500" fill="currentColor"
                                viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            {{ __('Cash flow forecasting') }}
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="mt-1 h-4 w-4 shrink-0 text-emerald-500" fill="currentColor"
                                viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            {{ __('Budget vs. actual comparison') }}
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="mt-1 h-4 w-4 shrink-0 text-emerald-500" fill="currentColor"
                                viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            {{ __('Trend analysis and seasonality') }}
                        </li>
                    </ul>
                </div>

                {{-- Projekt-kontrolling --}}
                <div
                    class="rounded-2xl border border-gray-100 bg-white p-8 shadow-sm transition-shadow hover:shadow-lg">
                    <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-xl bg-emerald-100">
                        <svg class="h-6 w-6 text-emerald-600" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                    </div>
                    <h3 class="mb-3 text-xl font-semibold text-gray-900">{{ __('Project controlling') }}</h3>
                    <ul class="space-y-2 text-gray-600">
                        <li class="flex items-start gap-2">
                            <svg class="mt-1 h-4 w-4 shrink-0 text-emerald-500" fill="currentColor"
                                viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            {{ __('Project-level profitability') }}
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="mt-1 h-4 w-4 shrink-0 text-emerald-500" fill="currentColor"
                                viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            {{ __('Tracking hours spent and costs') }}
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="mt-1 h-4 w-4 shrink-0 text-emerald-500" fill="currentColor"
                                viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            {{ __('Milestone-based cost tracking') }}
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="mt-1 h-4 w-4 shrink-0 text-emerald-500" fill="currentColor"
                                viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            {{ __('Overrun alerts') }}
                        </li>
                    </ul>
                </div>

                {{-- Költséghely-kezelés --}}
                <div
                    class="rounded-2xl border border-gray-100 bg-white p-8 shadow-sm transition-shadow hover:shadow-lg">
                    <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-xl bg-emerald-100">
                        <svg class="h-6 w-6 text-emerald-600" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                    </div>
                    <h3 class="mb-3 text-xl font-semibold text-gray-900">{{ __('Cost center management') }}</h3>
                    <ul class="space-y-2 text-gray-600">
                        <li class="flex items-start gap-2">
                            <svg class="mt-1 h-4 w-4 shrink-0 text-emerald-500" fill="currentColor"
                                viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            {{ __('Department and project-based cost allocation') }}
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="mt-1 h-4 w-4 shrink-0 text-emerald-500" fill="currentColor"
                                viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            {{ __('Internal billing support') }}
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="mt-1 h-4 w-4 shrink-0 text-emerald-500" fill="currentColor"
                                viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            {{ __('Budget monitoring') }}
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="mt-1 h-4 w-4 shrink-0 text-emerald-500" fill="currentColor"
                                viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            {{ __('Automatic allocation') }}
                        </li>
                    </ul>
                </div>

                {{-- Riportok és elemzések --}}
                <div
                    class="rounded-2xl border border-gray-100 bg-white p-8 shadow-sm transition-shadow hover:shadow-lg">
                    <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-xl bg-emerald-100">
                        <svg class="h-6 w-6 text-emerald-600" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <h3 class="mb-3 text-xl font-semibold text-gray-900">{{ __('Reports and analytics') }}</h3>
                    <ul class="space-y-2 text-gray-600">
                        <li class="flex items-start gap-2">
                            <svg class="mt-1 h-4 w-4 shrink-0 text-emerald-500" fill="currentColor"
                                viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            {{ __('Customizable report templates') }}
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="mt-1 h-4 w-4 shrink-0 text-emerald-500" fill="currentColor"
                                viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            {{ __('Automatic report generation') }}
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="mt-1 h-4 w-4 shrink-0 text-emerald-500" fill="currentColor"
                                viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            {{ __('Drill-down: from summary to details') }}
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="mt-1 h-4 w-4 shrink-0 text-emerald-500" fill="currentColor"
                                viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            {{ __('Comparative analyses') }}
                        </li>
                    </ul>
                </div>

                {{-- Terv-tény elemzés --}}
                <div
                    class="rounded-2xl border border-gray-100 bg-white p-8 shadow-sm transition-shadow hover:shadow-lg">
                    <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-xl bg-emerald-100">
                        <svg class="h-6 w-6 text-emerald-600" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <h3 class="mb-3 text-xl font-semibold text-gray-900">{{ __('Budget vs. actual analysis') }}</h3>
                    <ul class="space-y-2 text-gray-600">
                        <li class="flex items-start gap-2">
                            <svg class="mt-1 h-4 w-4 shrink-0 text-emerald-500" fill="currentColor"
                                viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            {{ __('Annual and monthly budget planning') }}
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="mt-1 h-4 w-4 shrink-0 text-emerald-500" fill="currentColor"
                                viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            {{ __('Automatic variance calculation') }}
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="mt-1 h-4 w-4 shrink-0 text-emerald-500" fill="currentColor"
                                viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            {{ __('Recording variance explanations') }}
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="mt-1 h-4 w-4 shrink-0 text-emerald-500" fill="currentColor"
                                viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            {{ __('Rolling forecast support') }}
                        </li>
                    </ul>
                </div>

                {{-- Integráció --}}
                <div
                    class="rounded-2xl border border-gray-100 bg-white p-8 shadow-sm transition-shadow hover:shadow-lg">
                    <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-xl bg-emerald-100">
                        <svg class="h-6 w-6 text-emerald-600" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z" />
                        </svg>
                    </div>
                    <h3 class="mb-3 text-xl font-semibold text-gray-900">{{ __('Financial integrations') }}</h3>
                    <ul class="space-y-2 text-gray-600">
                        {{-- Content audit: bank-sync hidden until confirmed live --}}
                        @if(false)
                        <li class="flex items-start gap-2">
                            <svg class="mt-1 h-4 w-4 shrink-0 text-emerald-500" fill="currentColor"
                                viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            {{ __('Bank account synchronization') }}
                        </li>
                        @endif
                        <li class="flex items-start gap-2">
                            <svg class="mt-1 h-4 w-4 shrink-0 text-emerald-500" fill="currentColor"
                                viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            {{ __('Invoicing integration (Billingo, Szamlazz.hu)') }}
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="mt-1 h-4 w-4 shrink-0 text-emerald-500" fill="currentColor"
                                viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            {{ __('Accounting export') }}
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="mt-1 h-4 w-4 shrink-0 text-emerald-500" fill="currentColor"
                                viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            {{ __('NAV-compatible data export') }}
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    {{-- Results Section --}}
    <section class="bg-white py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto mb-12 max-w-3xl text-center">
                <h2 class="text-3xl font-semibold text-gray-900 sm:text-4xl">{{ __('Results in numbers') }}</h2>
                <p class="mt-4 text-lg text-gray-600">{{ __('Average improvement among our clients after implementation.') }}</p>
            </div>

            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-5">
                <div class="rounded-2xl bg-emerald-50 p-6 text-center">
                    <div class="text-4xl font-bold text-emerald-600">-70%</div>
                    <div class="mt-2 text-sm text-gray-600">{{ __('Monthly closing time') }}</div>
                </div>
                <div class="rounded-2xl bg-emerald-50 p-6 text-center">
                    <div class="text-4xl font-bold text-emerald-600">-60%</div>
                    <div class="mt-2 text-sm text-gray-600">{{ __('Report generation time') }}</div>
                </div>
                <div class="rounded-2xl bg-emerald-50 p-6 text-center">
                    <div class="text-4xl font-bold text-emerald-600">+40%</div>
                    <div class="mt-2 text-sm text-gray-600">{{ __('Forecast accuracy') }}</div>
                </div>
                <div class="rounded-2xl bg-emerald-50 p-6 text-center">
                    <div class="text-4xl font-bold text-emerald-600">3x</div>
                    <div class="mt-2 text-sm text-gray-600">{{ __('Faster cost overrun detection') }}</div>
                </div>
                <div class="rounded-2xl bg-emerald-50 p-6 text-center">
                    <div class="text-4xl font-bold text-emerald-600">+50%</div>
                    <div class="mt-2 text-sm text-gray-600">{{ __('Decision-making speed') }}</div>
                </div>
            </div>
            <p class="mt-8 text-center text-xs text-gray-400">* {{ __('Illustrative examples') }}</p>
        </div>
    </section>

    {{-- Dashboard Examples Section --}}
    <section class="bg-gray-50 py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto mb-12 max-w-3xl text-center">
                <h2 class="text-3xl font-semibold text-gray-900 sm:text-4xl">{{ __('Dashboard examples') }}</h2>
                <p class="mt-4 text-lg text-gray-600">{{ __('Every role has its own view.') }}</p>
            </div>

            <div class="grid gap-8 lg:grid-cols-3">
                {{-- Vezetői dashboard --}}
                <div class="rounded-2xl border border-gray-100 bg-white p-8 shadow-sm">
                    <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-xl bg-emerald-100">
                        <svg class="h-6 w-6 text-emerald-600" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                    <h3 class="mb-3 text-xl font-semibold text-gray-900">{{ __('Executive dashboard') }}</h3>
                    <ul class="space-y-2 text-gray-600">
                        <li>{{ __('Monthly revenue vs. plan') }}</li>
                        <li>{{ __('Top 5 cost centers') }}</li>
                        <li>{{ __('Cash flow forecast for 90 days') }}</li>
                        <li>{{ __('Project profitability ranking') }}</li>
                    </ul>
                </div>

                {{-- Pénzügyi dashboard --}}
                <div class="rounded-2xl border border-gray-100 bg-white p-8 shadow-sm">
                    <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-xl bg-emerald-100">
                        <svg class="h-6 w-6 text-emerald-600" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="mb-3 text-xl font-semibold text-gray-900">{{ __('Finance dashboard') }}</h3>
                    <ul class="space-y-2 text-gray-600">
                        <li>{{ __('Receivables by age') }}</li>
                        <li>{{ __('Payables and due dates') }}</li>
                        <li>{{ __('Liquidity ratio') }}</li>
                        <li>{{ __('Cost structure pie chart') }}</li>
                    </ul>
                </div>

                {{-- Projekt dashboard --}}
                <div class="rounded-2xl border border-gray-100 bg-white p-8 shadow-sm">
                    <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-xl bg-emerald-100">
                        <svg class="h-6 w-6 text-emerald-600" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                        </svg>
                    </div>
                    <h3 class="mb-3 text-xl font-semibold text-gray-900">{{ __('Project dashboard') }}</h3>
                    <ul class="space-y-2 text-gray-600">
                        <li>{{ __('Active projects status') }}</li>
                        <li>{{ __('Spent vs. planned hours') }}</li>
                        <li>{{ __('Budget utilization') }}</li>
                        <li>{{ __('Milestone completions') }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    {{-- Who Uses Section --}}
    <section class="bg-white py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto mb-12 max-w-3xl text-center">
                <h2 class="text-3xl font-semibold text-gray-900 sm:text-4xl">{{ __('Who uses it?') }}</h2>
            </div>

            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
                <div class="rounded-2xl border border-gray-100 bg-white p-6 text-center shadow-sm">
                    <div class="mx-auto mb-4 flex h-14 w-14 items-center justify-center rounded-xl bg-emerald-100">
                        <svg class="h-7 w-7 text-emerald-600" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="mb-2 font-semibold text-gray-900">{{ __('CFOs') }}</h3>
                    <p class="text-sm text-gray-600">{{ __('Real-time financial overview') }}</p>
                </div>
                <div class="rounded-2xl border border-gray-100 bg-white p-6 text-center shadow-sm">
                    <div class="mx-auto mb-4 flex h-14 w-14 items-center justify-center rounded-xl bg-emerald-100">
                        <svg class="h-7 w-7 text-emerald-600" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                    <h3 class="mb-2 font-semibold text-gray-900">{{ __('Managing Directors') }}</h3>
                    <p class="text-sm text-gray-600">{{ __('Decision-support reports') }}</p>
                </div>
                <div class="rounded-2xl border border-gray-100 bg-white p-6 text-center shadow-sm">
                    <div class="mx-auto mb-4 flex h-14 w-14 items-center justify-center rounded-xl bg-emerald-100">
                        <svg class="h-7 w-7 text-emerald-600" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                    </div>
                    <h3 class="mb-2 font-semibold text-gray-900">{{ __('Project Managers') }}</h3>
                    <p class="text-sm text-gray-600">{{ __('Project profitability tracking') }}</p>
                </div>
                <div class="rounded-2xl border border-gray-100 bg-white p-6 text-center shadow-sm">
                    <div class="mx-auto mb-4 flex h-14 w-14 items-center justify-center rounded-xl bg-emerald-100">
                        <svg class="h-7 w-7 text-emerald-600" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <h3 class="mb-2 font-semibold text-gray-900">{{ __('Controllers') }}</h3>
                    <p class="text-sm text-gray-600">{{ __('Budget vs. actual analysis and cost allocation') }}</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Testimonials Section (hidden) --}}
    @if(false)
    <section class="bg-gray-50 py-16 lg:py-20">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto mb-12 max-w-3xl text-center">
                <h2 class="text-3xl font-semibold text-gray-900 sm:text-4xl">{{ __('What our clients say') }}</h2>
            </div>

            <div class="grid gap-8 lg:grid-cols-2">
                <div class="rounded-2xl bg-white p-8 shadow-sm">
                    <div class="mb-6 flex items-center gap-1">
                        @for ($i = 0; $i < 5; $i++)
                            <svg class="h-5 w-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg>
                        @endfor
                    </div>
                    <blockquote class="mb-6 text-lg text-gray-700">
                        {{ __('\"I can finally see where the money goes and why. Our monthly closing went from days to hours.\"') }}
                    </blockquote>
                    <div class="flex items-center gap-4">
                        <div
                            class="flex h-12 w-12 items-center justify-center rounded-full bg-emerald-100 font-semibold text-emerald-600">
                            NT</div>
                        <div>
                            <div class="font-semibold text-gray-900">{{ __('Tamas Nagy') }}</div>
                            <div class="text-sm text-gray-500">{{ __('CFO, Industrial manufacturing company') }}</div>
                        </div>
                    </div>
                </div>

                <div class="rounded-2xl bg-white p-8 shadow-sm">
                    <div class="mb-6 flex items-center gap-1">
                        @for ($i = 0; $i < 5; $i++)
                            <svg class="h-5 w-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg>
                        @endfor
                    </div>
                    <blockquote class="mb-6 text-lg text-gray-700">
                        {{ __('\"It used to take a week to compile an executive report. Now it\'s one click and done.\"') }}
                    </blockquote>
                    <div class="flex items-center gap-4">
                        <div
                            class="flex h-12 w-12 items-center justify-center rounded-full bg-emerald-100 font-semibold text-emerald-600">
                            HE</div>
                        <div>
                            <div class="font-semibold text-gray-900">{{ __('Eszter Horvath') }}</div>
                            <div class="text-sm text-gray-500">{{ __('Head of Controlling, Service company') }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif

    {{-- Related Modules Section --}}
    <section class="bg-gray-50 py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto mb-12 max-w-3xl text-center">
                <h2 class="text-3xl font-semibold text-gray-900 sm:text-4xl">{{ __('Related modules') }}</h2>
                <p class="mt-4 text-lg text-gray-600">{{ __('Extend Controlling with these modules.') }}</p>
            </div>

            <div class="grid gap-6 sm:grid-cols-2">
                <a href="{{ route('products.beszerzes') }}"
                    class="group rounded-2xl border border-gray-100 bg-white p-6 shadow-sm transition-shadow hover:shadow-lg">
                    <div class="flex items-center gap-4">
                        <x-module-icon module="beszerzes" size="lg" />
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 group-hover:text-amber-600">
                                {{ __('Procurement & Logistics module') }}</h3>
                            <p class="text-gray-600">{{ __('Supplier costs and inventory value') }}</p>
                        </div>
                    </div>
                </a>
                <a href="{{ route('products.gyartas') }}"
                    class="group rounded-2xl border border-gray-100 bg-white p-6 shadow-sm transition-shadow hover:shadow-lg">
                    <div class="flex items-center gap-4">
                        <x-module-icon module="gyartas" size="lg" />
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 group-hover:text-indigo-600">
                                {{ __('Manufacturing Management module') }}</h3>
                            <p class="text-gray-600">{{ __('Project-level manufacturing costs') }}</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </section>

    {{-- Bottom CTA Section --}}
    <section class="bg-emerald-600 py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-4 text-center sm:px-6 lg:px-8">
            <h2 class="text-3xl font-semibold text-white sm:text-4xl">
                {{ __('Start today — risk-free') }}
            </h2>
            <p class="mx-auto mt-4 max-w-xl text-lg text-emerald-100">
                {{ __('Full functionality, Hungarian language support. Request a personalized demo.') }}
            </p>
            <div class="mt-8 flex flex-col items-center justify-center gap-4 sm:flex-row">
                <a href="{{ route('register') }}"
                    class="inline-flex items-center justify-center gap-2 rounded-full bg-white px-8 py-4 text-base font-semibold text-emerald-600 shadow-lg transition-colors hover:bg-emerald-50 hover:shadow-xl">
                    {{ __('Get started') }}
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M14 5l7 7m0 0l-7 7m7-7H3" />
                    </svg>
                </a>
                <a href="{{ route('contact') }}"
                    class="inline-flex items-center justify-center gap-2 rounded-full border-2 border-emerald-400 px-8 py-4 text-base font-semibold text-white transition-colors hover:bg-emerald-700">
                    {{ __('Request a demo') }}
                </a>
                <a href="https://controlling.cegem360.eu/"
                    class="inline-flex items-center justify-center gap-2 text-base font-medium text-emerald-200 transition-colors hover:text-white">
                    {{ __('Log in to the application') }} →
                </a>
            </div>
        </div>
    </section>

    <x-product.legal-note>
        <p>{{ __('Cégem360 Controlling is not accounting software and does not provide tax advice.') }}</p>
    </x-product.legal-note>
</div>
