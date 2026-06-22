<div>
    {{-- Hero Section --}}
    <section class="bg-linear-to-b from-violet-50 to-white py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto max-w-4xl text-center">
                <div class="mb-6 flex justify-center">
                    <x-module-icon module="datamind" size="xl" />
                </div>
                <div
                    class="mb-6 inline-flex items-center gap-2 rounded-full bg-violet-100 px-4 py-1.5 text-sm font-medium text-violet-700">
                    <x-module-icon module="datamind" size="xs" :show-background="false" color="#6d28d9" />
                    {{ __('AI-Powered Business Intelligence') }}
                </div>
                <h1 class="mb-6 text-4xl font-semibold leading-tight text-gray-900 sm:text-5xl lg:text-6xl">
                    {{ __('We turn your data into business advantage — with artificial intelligence') }}
                </h1>
                <p class="mx-auto max-w-3xl text-lg leading-relaxed text-gray-600 sm:text-xl">
                    {{ __('DataMind automatically uncovers hidden correlations in marketing data, predicts trends and provides recommendations — without coding, on a drag-and-drop interface.') }}
                </p>

                {{-- CTA Buttons --}}
                <div class="mt-8 flex flex-col items-center justify-center gap-4 sm:flex-row">
                    <a href="{{ route('register') }}"
                        class="inline-flex items-center justify-center gap-2 rounded-full bg-violet-500 px-8 py-4 text-base font-semibold text-white shadow-lg transition-colors hover:bg-violet-600 hover:shadow-xl">
                        {{ __('Get started') }}
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </a>
                    <a href="{{ route('contact') }}"
                        class="inline-flex items-center justify-center gap-2 rounded-full border-2 border-violet-200 bg-white px-8 py-4 text-base font-semibold text-violet-700 transition-colors hover:bg-violet-50">
                        {{ __('Request a demo') }}
                    </a>
                    <a href="https://datamind.cegem360.eu/"
                        class="inline-flex items-center justify-center gap-2 text-base font-medium text-violet-600 transition-colors hover:text-violet-800">
                        {{ __('Log in to the platform') }} →
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{-- Problem Section --}}
    <section class="bg-white py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto mb-12 max-w-3xl text-center">
                <h2 class="text-3xl font-semibold text-gray-900 sm:text-4xl">{{ __('Familiar problems?') }}</h2>
            </div>

            <div class="grid gap-6 sm:grid-cols-2">
                <div class="rounded-2xl border border-violet-100 bg-linear-to-br from-violet-50 to-white p-8">
                    <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-xl bg-white shadow-sm">
                        <svg class="h-6 w-6 text-violet-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3.375 19.5h17.25m-17.25 0a1.125 1.125 0 01-1.125-1.125M3.375 19.5h7.5c.621 0 1.125-.504 1.125-1.125m-9.75 0V5.625m0 12.75v-1.5c0-.621.504-1.125 1.125-1.125m18.375 2.625V5.625m0 12.75c0 .621-.504 1.125-1.125 1.125m1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125m0 3.75h-7.5A1.125 1.125 0 0112 18.375" />
                        </svg>
                    </div>
                    <h3 class="mb-2 text-lg font-semibold text-gray-900">{{ __('Scattered data') }}</h3>
                    <p class="text-gray-600">{{ __('Google Analytics, Ads, Search Console — each on a separate interface, manual aggregation.') }}</p>
                </div>
                <div class="rounded-2xl border border-violet-100 bg-linear-to-br from-violet-50 to-white p-8">
                    <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-xl bg-white shadow-sm">
                        <svg class="h-6 w-6 text-violet-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="mb-2 text-lg font-semibold text-gray-900">{{ __('Slow reporting') }}</h3>
                    <p class="text-gray-600">{{ __('Spending hours each week compiling Excel spreadsheets instead of making decisions.') }}</p>
                </div>
                <div class="rounded-2xl border border-violet-100 bg-linear-to-br from-violet-50 to-white p-8">
                    <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-xl bg-white shadow-sm">
                        <svg class="h-6 w-6 text-violet-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                    <h3 class="mb-2 text-lg font-semibold text-gray-900">{{ __('Hidden correlations') }}</h3>
                    <p class="text-gray-600">{{ __('You can\'t see what affects what — which campaign drives conversions, what causes traffic decline.') }}</p>
                </div>
                <div class="rounded-2xl border border-violet-100 bg-linear-to-br from-violet-50 to-white p-8">
                    <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-xl bg-white shadow-sm">
                        <svg class="h-6 w-6 text-violet-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="mb-2 text-lg font-semibold text-gray-900">{{ __('Reactive decision-making') }}</h3>
                    <p class="text-gray-600">{{ __('Always reacting after the fact, instead of anticipating trends and preventing problems.') }}</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Features Section --}}
    <section id="funkciok" class="bg-gray-50 py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto mb-12 max-w-3xl text-center">
                <h2 class="text-3xl font-semibold text-gray-900 sm:text-4xl">{{ __('Everything on one platform') }}</h2>
                <p class="mt-4 text-lg text-gray-600">{{ __('AI-powered data mining and business intelligence — 6 integrated capabilities on a single interface.') }}</p>
            </div>

            <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-3">
                {{-- Feature 1 --}}
                <div class="rounded-2xl bg-white p-8 shadow-sm">
                    <div
                        class="mb-4 flex h-12 w-12 items-center justify-center rounded-xl bg-violet-100 text-violet-500">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
                        </svg>
                    </div>
                    <h3 class="mb-2 text-lg font-semibold text-gray-900">{{ __('Data Integration') }}</h3>
                    <ul class="space-y-2 text-sm text-gray-600">
                        <li class="flex items-start gap-2">
                            <svg class="mt-0.5 h-4 w-4 shrink-0 text-violet-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            Google Analytics, Search Console, Ads
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="mt-0.5 h-4 w-4 shrink-0 text-violet-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            {{ __('CSV, databases, ERP and CRM') }}
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="mt-0.5 h-4 w-4 shrink-0 text-violet-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            {{ __('A single unified data warehouse') }}
                        </li>
                    </ul>
                </div>

                {{-- Feature 2 --}}
                <div class="rounded-2xl bg-white p-8 shadow-sm">
                    <div
                        class="mb-4 flex h-12 w-12 items-center justify-center rounded-xl bg-violet-100 text-violet-500">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                    <h3 class="mb-2 text-lg font-semibold text-gray-900">{{ __('Real-time Analysis') }}</h3>
                    <ul class="space-y-2 text-sm text-gray-600">
                        <li class="flex items-start gap-2">
                            <svg class="mt-0.5 h-4 w-4 shrink-0 text-violet-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            {{ __('Streaming data processing') }}
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="mt-0.5 h-4 w-4 shrink-0 text-violet-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            {{ __('Instant anomaly detection') }}
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="mt-0.5 h-4 w-4 shrink-0 text-violet-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            {{ __('KPI alerts and notifications') }}
                        </li>
                    </ul>
                </div>

                {{-- Feature 3 --}}
                <div class="rounded-2xl bg-white p-8 shadow-sm">
                    <div class="mb-4">
                        <x-module-icon module="datamind" size="md" />
                    </div>
                    <h3 class="mb-2 text-lg font-semibold text-gray-900">{{ __('AI Model Builder') }}</h3>
                    <ul class="space-y-2 text-sm text-gray-600">
                        <li class="flex items-start gap-2">
                            <svg class="mt-0.5 h-4 w-4 shrink-0 text-violet-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            {{ __('Drag-and-drop interface') }}
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="mt-0.5 h-4 w-4 shrink-0 text-violet-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            {{ __('Manager and expert mode') }}
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="mt-0.5 h-4 w-4 shrink-0 text-violet-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            {{ __('No programming required') }}
                        </li>
                    </ul>
                </div>

                {{-- Feature 4 --}}
                <div class="rounded-2xl bg-white p-8 shadow-sm">
                    <div
                        class="mb-4 flex h-12 w-12 items-center justify-center rounded-xl bg-violet-100 text-violet-500">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 013 19.875v-6.75zM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V8.625zM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V4.125z" />
                        </svg>
                    </div>
                    <h3 class="mb-2 text-lg font-semibold text-gray-900">{{ __('Predictive Analysis') }}</h3>
                    <ul class="space-y-2 text-sm text-gray-600">
                        <li class="flex items-start gap-2">
                            <svg class="mt-0.5 h-4 w-4 shrink-0 text-violet-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            {{ __('Traffic forecasting') }}
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="mt-0.5 h-4 w-4 shrink-0 text-violet-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            {{ __('Conversion prediction') }}
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="mt-0.5 h-4 w-4 shrink-0 text-violet-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            {{ __('Cost optimization and churn prediction') }}
                        </li>
                    </ul>
                </div>

                {{-- Feature 5 --}}
                <div class="rounded-2xl bg-white p-8 shadow-sm">
                    <div
                        class="mb-4 flex h-12 w-12 items-center justify-center rounded-xl bg-violet-100 text-violet-500">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                    <h3 class="mb-2 text-lg font-semibold text-gray-900">{{ __('Correlation Discovery') }}</h3>
                    <ul class="space-y-2 text-sm text-gray-600">
                        <li class="flex items-start gap-2">
                            <svg class="mt-0.5 h-4 w-4 shrink-0 text-violet-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            {{ __('Automatic correlation search') }}
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="mt-0.5 h-4 w-4 shrink-0 text-violet-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            {{ __('Customer segmentation') }}
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="mt-0.5 h-4 w-4 shrink-0 text-violet-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            {{ __('Pattern identification') }}
                        </li>
                    </ul>
                </div>

                {{-- Feature 6 --}}
                <div class="rounded-2xl bg-white p-8 shadow-sm">
                    <div
                        class="mb-4 flex h-12 w-12 items-center justify-center rounded-xl bg-violet-100 text-violet-500">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                        </svg>
                    </div>
                    <h3 class="mb-2 text-lg font-semibold text-gray-900">{{ __('Automatic Reports') }}</h3>
                    <ul class="space-y-2 text-sm text-gray-600">
                        <li class="flex items-start gap-2">
                            <svg class="mt-0.5 h-4 w-4 shrink-0 text-violet-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            {{ __('Hungarian-language AI summaries') }}
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="mt-0.5 h-4 w-4 shrink-0 text-violet-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            {{ __('Action plan recommendations') }}
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="mt-0.5 h-4 w-4 shrink-0 text-violet-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            {{ __('Industry benchmark comparison') }}
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    {{-- Workflow Section --}}
    <section class="bg-white py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto mb-12 max-w-3xl text-center">
                <h2 class="text-3xl font-semibold text-gray-900 sm:text-4xl">{{ __('How does it work?') }}</h2>
            </div>

            <div class="mx-auto max-w-4xl">
                <div class="space-y-8">
                    <div class="flex items-start gap-6">
                        <div
                            class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-violet-500 text-sm font-bold text-white">
                            1</div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">{{ __('Connect data sources') }}</h3>
                            <p class="mt-1 text-gray-600">{{ __('Link your Google accounts, upload your CSV or connect your database — with just a few clicks.') }}</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-6">
                        <div
                            class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-violet-500 text-sm font-bold text-white">
                            2</div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">{{ __('Automatic data cleaning') }}</h3>
                            <p class="mt-1 text-gray-600">{{ __('The ETL pipeline cleans, normalizes and unifies the data into the data warehouse.') }}</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-6">
                        <div
                            class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-violet-500 text-sm font-bold text-white">
                            3</div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">{{ __('AI analysis begins') }}</h3>
                            <p class="mt-1 text-gray-600">{{ __('The system automatically runs anomaly detection, trend analysis and correlation search.') }}</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-6">
                        <div
                            class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-violet-500 text-sm font-bold text-white">
                            4</div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">{{ __('Build a model') }}</h3>
                            <p class="mt-1 text-gray-600">{{ __('Select the target variable on the drag-and-drop interface — the system automatically builds the best model.') }}</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-6">
                        <div
                            class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-violet-500 text-sm font-bold text-white">
                            5</div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">{{ __('Recommendations and decisions') }}</h3>
                            <p class="mt-1 text-gray-600">{{ __('Get instant, Hungarian-language AI recommendations and action plans on the dashboard and via email.') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Results Section --}}
    <section class="bg-violet-500 py-16 lg:py-20">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto mb-12 max-w-3xl text-center">
                <h2 class="text-3xl font-semibold text-white sm:text-4xl">{{ __('Measurable results') }}</h2>
                <p class="mt-4 text-lg text-violet-100">{{ __('Average improvement among our clients after implementing DataMind.') }}</p>
            </div>

            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                <div class="rounded-2xl bg-white/10 p-6 text-center backdrop-blur-sm">
                    <p class="text-4xl font-bold text-white">-75%</p>
                    <p class="mt-2 text-violet-100">{{ __('report time reduction') }}</p>
                </div>
                <div class="rounded-2xl bg-white/10 p-6 text-center backdrop-blur-sm">
                    <p class="text-4xl font-bold text-white">3x</p>
                    <p class="mt-2 text-violet-100">{{ __('faster decision-making') }}</p>
                </div>
                <div class="rounded-2xl bg-white/10 p-6 text-center backdrop-blur-sm">
                    <p class="text-4xl font-bold text-white">+40%</p>
                    <p class="mt-2 text-violet-100">{{ __('more discovered correlations') }}</p>
                </div>
                <div class="rounded-2xl bg-white/10 p-6 text-center backdrop-blur-sm">
                    <p class="text-4xl font-bold text-white">+25%</p>
                    <p class="mt-2 text-violet-100">{{ __('marketing ROI improvement') }}</p>
                </div>
                <div class="rounded-2xl bg-white/10 p-6 text-center backdrop-blur-sm">
                    <p class="text-4xl font-bold text-white">-90%</p>
                    <p class="mt-2 text-violet-100">{{ __('human error reduction') }}</p>
                </div>
                <div class="rounded-2xl bg-white/10 p-6 text-center backdrop-blur-sm">
                    <p class="text-4xl font-bold text-white">6+</p>
                    <p class="mt-2 text-violet-100">{{ __('data source integrations') }}</p>
                </div>
            </div>
            <p class="mt-8 text-center text-xs text-violet-200/70">* {{ __('Illustrative examples') }}</p>
        </div>
    </section>

    {{-- Integrations Section --}}
    <section class="bg-white py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto mb-12 max-w-3xl text-center">
                <h2 class="text-3xl font-semibold text-gray-900 sm:text-4xl">{{ __('Connects to your existing tools') }}</h2>
                <p class="mt-4 text-lg text-gray-600">{{ __('Pre-configured integrations for the most popular data sources.') }}
                </p>
            </div>

            <div class="mx-auto grid max-w-4xl gap-4 sm:grid-cols-2 lg:grid-cols-3">
                <div class="flex items-center gap-3 rounded-xl border border-gray-200 p-4">
                    <div
                        class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-yellow-50 text-xs font-bold text-yellow-600">
                        GA</div>
                    <div>
                        <p class="text-sm font-semibold text-gray-900">Google Analytics 4</p>
                        <p class="text-xs text-gray-400">{{ __('Traffic data, conversions') }}</p>
                    </div>
                </div>
                <div class="flex items-center gap-3 rounded-xl border border-gray-200 p-4">
                    <div
                        class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-blue-50 text-xs font-bold text-blue-600">
                        Ads</div>
                    <div>
                        <p class="text-sm font-semibold text-gray-900">Google Ads</p>
                        <p class="text-xs text-gray-400">{{ __('Campaign performance') }}</p>
                    </div>
                </div>
                <div class="flex items-center gap-3 rounded-xl border border-gray-200 p-4">
                    <div
                        class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-green-50 text-xs font-bold text-green-600">
                        GSC</div>
                    <div>
                        <p class="text-sm font-semibold text-gray-900">Search Console</p>
                        <p class="text-xs text-gray-400">{{ __('Search positions, CTR') }}</p>
                    </div>
                </div>
                <div class="flex items-center gap-3 rounded-xl border border-gray-200 p-4">
                    <div
                        class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-gray-50 text-xs font-bold text-gray-600">
                        CSV</div>
                    <div>
                        <p class="text-sm font-semibold text-gray-900">CSV / Excel / JSON</p>
                        <p class="text-xs text-gray-400">{{ __('File-based data import') }}</p>
                    </div>
                </div>
                <div class="flex items-center gap-3 rounded-xl border border-gray-200 p-4">
                    <div
                        class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-violet-50 text-xs font-bold text-violet-600">
                        SQL</div>
                    <div>
                        <p class="text-sm font-semibold text-gray-900">{{ __('SQL Databases') }}</p>
                        <p class="text-xs text-gray-400">PostgreSQL, MySQL, MSSQL</p>
                    </div>
                </div>
                <div class="flex items-center gap-3 rounded-xl border border-gray-200 p-4">
                    <div
                        class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-indigo-50 text-xs font-bold text-indigo-600">
                        API</div>
                    <div>
                        <p class="text-sm font-semibold text-gray-900">REST API</p>
                        <p class="text-xs text-gray-400">{{ __('External system integration') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Who Uses Section --}}
    <section class="bg-gray-50 py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto mb-12 max-w-3xl text-center">
                <h2 class="text-3xl font-semibold text-gray-900 sm:text-4xl">{{ __('Who is it for?') }}</h2>
            </div>

            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
                <div class="rounded-2xl border border-gray-200 p-6 text-center">
                    <div
                        class="mx-auto mb-4 flex h-14 w-14 items-center justify-center rounded-full bg-violet-100 text-violet-500">
                        <svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 013 19.875v-6.75z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900">{{ __('Marketing Managers') }}</h3>
                    <p class="mt-2 text-sm text-gray-600">{{ __('Real-time campaign tracking, ROI optimization, AI predictions for budget planning.') }}</p>
                </div>
                <div class="rounded-2xl border border-gray-200 p-6 text-center">
                    <div
                        class="mx-auto mb-4 flex h-14 w-14 items-center justify-center rounded-full bg-violet-100 text-violet-500">
                        <svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900">{{ __('Webshop Owners') }}</h3>
                    <p class="mt-2 text-sm text-gray-600">{{ __('Sales forecasting, customer segmentation, seasonal pattern recognition.') }}</p>
                </div>
                <div class="rounded-2xl border border-gray-200 p-6 text-center">
                    <div
                        class="mx-auto mb-4 flex h-14 w-14 items-center justify-center rounded-full bg-violet-100 text-violet-500">
                        <svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900">{{ __('CEOs') }}</h3>
                    <p class="mt-2 text-sm text-gray-600">{{ __('All business metrics on a single dashboard, with AI-powered decision support.') }}</p>
                </div>
                <div class="rounded-2xl border border-gray-200 p-6 text-center">
                    <div
                        class="mx-auto mb-4 flex h-14 w-14 items-center justify-center rounded-full bg-violet-100 text-violet-500">
                        <svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9.813 15.904L9 18.75l-.813-2.846a4.5 4.5 0 00-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 003.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 003.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 00-3.09 3.09z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900">{{ __('Data Analysts') }}</h3>
                    <p class="mt-2 text-sm text-gray-600">{{ __('Expert mode with drag-and-drop model builder, advanced algorithm selection.') }}</p>
                </div>
            </div>
        </div>
    </section>

    {{-- FAQ Section --}}
    <section class="bg-white py-16 lg:py-24" x-data="{ openFaq: null }">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto mb-12 max-w-3xl text-center">
                <h2 class="text-3xl font-semibold text-gray-900 sm:text-4xl">{{ __('Frequently Asked Questions') }}</h2>
            </div>

            <div class="mx-auto max-w-3xl space-y-4">
                <div class="rounded-xl border border-gray-200">
                    <button @click="openFaq = openFaq === 1 ? null : 1"
                        class="flex w-full items-center justify-between px-6 py-4 text-left">
                        <span class="font-medium text-gray-900">{{ __('What data sources does DataMind support?') }}</span>
                        <svg class="h-5 w-5 shrink-0 text-gray-400 transition-transform"
                            :class="{ 'rotate-180': openFaq === 1 }" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="openFaq === 1" x-collapse class="px-6 pb-4 text-gray-600">
                        {{ __('Google Analytics 4, Google Search Console, Google Ads, CSV/Excel/JSON files, SQL databases (PostgreSQL, MySQL, MSSQL) and any REST APIs.') }}
                    </div>
                </div>
                <div class="rounded-xl border border-gray-200">
                    <button @click="openFaq = openFaq === 2 ? null : 2"
                        class="flex w-full items-center justify-between px-6 py-4 text-left">
                        <span class="font-medium text-gray-900">{{ __('Do I need to program to use it?') }}</span>
                        <svg class="h-5 w-5 shrink-0 text-gray-400 transition-transform"
                            :class="{ 'rotate-180': openFaq === 2 }" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="openFaq === 2" x-collapse class="px-6 pb-4 text-gray-600">
                        {{ __('No! In manager mode, you can build a model in 5 steps on the drag-and-drop interface, without coding. Expert mode is optionally available for advanced users.') }}
                    </div>
                </div>
                <div class="rounded-xl border border-gray-200">
                    <button @click="openFaq = openFaq === 3 ? null : 3"
                        class="flex w-full items-center justify-between px-6 py-4 text-left">
                        <span class="font-medium text-gray-900">{{ __('How quickly can I get started?') }}</span>
                        <svg class="h-5 w-5 shrink-0 text-gray-400 transition-transform"
                            :class="{ 'rotate-180': openFaq === 3 }" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="openFaq === 3" x-collapse class="px-6 pb-4 text-gray-600">
                        {{ __('After connecting your Google accounts, the first data and analyses appear on the dashboard within 15 minutes.') }}
                    </div>
                </div>
                <div class="rounded-xl border border-gray-200">
                    <button @click="openFaq = openFaq === 4 ? null : 4"
                        class="flex w-full items-center justify-between px-6 py-4 text-left">
                        <span class="font-medium text-gray-900">{{ __('Is my data handled securely?') }}</span>
                        <svg class="h-5 w-5 shrink-0 text-gray-400 transition-transform"
                            :class="{ 'rotate-180': openFaq === 4 }" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="openFaq === 4" x-collapse class="px-6 pb-4 text-gray-600">
                        {{ __('Yes. The system is GDPR-compliant, uses TLS 1.3 encryption, and has an RBAC permission system. Data anonymization capabilities are also available.') }}
                    </div>
                </div>
                <div class="rounded-xl border border-gray-200">
                    <button @click="openFaq = openFaq === 5 ? null : 5"
                        class="flex w-full items-center justify-between px-6 py-4 text-left">
                        <span class="font-medium text-gray-900">{{ __('What is predictive analysis?') }}</span>
                        <svg class="h-5 w-5 shrink-0 text-gray-400 transition-transform"
                            :class="{ 'rotate-180': openFaq === 5 }" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="openFaq === 5" x-collapse class="px-6 pb-4 text-gray-600">
                        {{ __('AI uses machine learning algorithms to create predictions from historical data — e.g. how much traffic to expect next month, or which customer will leave the service.') }}
                    </div>
                </div>
                <div class="rounded-xl border border-gray-200">
                    <button @click="openFaq = openFaq === 6 ? null : 6"
                        class="flex w-full items-center justify-between px-6 py-4 text-left">
                        <span class="font-medium text-gray-900">{{ __('How does it connect to other Cégem 360 modules?') }}</span>
                        <svg class="h-5 w-5 shrink-0 text-gray-400 transition-transform"
                            :class="{ 'rotate-180': openFaq === 6 }" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="openFaq === 6" x-collapse class="px-6 pb-4 text-gray-600">
                        {{ __('DataMind natively integrates with the CRM, Controlling and Automation modules — data automatically flows between the systems.') }}
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Related Modules Section --}}
    <section class="bg-gray-50 py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto mb-12 max-w-3xl text-center">
                <h2 class="text-3xl font-semibold text-gray-900 sm:text-4xl">{{ __('Related Modules') }}</h2>
                <p class="mt-4 text-lg text-gray-600">{{ __('Extend DataMind with these modules.') }}</p>
            </div>

            <div class="mx-auto grid max-w-3xl gap-6 sm:grid-cols-3">
                <a href="{{ route('products.crm') }}"
                    class="group rounded-2xl border border-gray-200 bg-white p-6 transition-shadow hover:shadow-md">
                    <x-module-icon module="crm" size="lg" />
                    <h3 class="mt-4 text-lg font-semibold text-gray-900 group-hover:text-violet-500">{{ __('CRM Module') }}</h3>
                    <p class="mt-2 text-sm text-gray-600">{{ __('Customer relationship management and sales pipeline') }}</p>
                </a>
                <a href="{{ route('products.automatizalas') }}"
                    class="group rounded-2xl border border-gray-200 bg-white p-6 transition-shadow hover:shadow-md">
                    <x-module-icon module="automatizalas" size="lg" />
                    <h3 class="mt-4 text-lg font-semibold text-gray-900 group-hover:text-violet-500">{{ __('Automation') }}
                    </h3>
                    <p class="mt-2 text-sm text-gray-600">{{ __('Business process automation') }}</p>
                </a>
                <a href="{{ route('products.kontrolling') }}"
                    class="group rounded-2xl border border-gray-200 bg-white p-6 transition-shadow hover:shadow-md">
                    <x-module-icon module="kontrolling" size="lg" />
                    <h3 class="mt-4 text-lg font-semibold text-gray-900 group-hover:text-violet-500">{{ __('Controlling') }}</h3>
                    <p class="mt-2 text-sm text-gray-600">{{ __('Marketing dashboard and KPI tracking') }}</p>
                </a>
            </div>
        </div>
    </section>

    {{-- CTA Section --}}
    <section class="bg-violet-500 py-16 lg:py-20">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl font-semibold text-white sm:text-4xl">
                {{ __('Ready for data-driven decision making?') }}
            </h2>
            <p class="mx-auto mt-4 max-w-xl text-lg text-violet-100">
                {{ __('Full functionality, Hungarian-language support. Request a personalized demo.') }}
            </p>
            <div class="mt-8 flex flex-col items-center justify-center gap-4 sm:flex-row">
                <a href="{{ route('register') }}"
                    class="inline-flex items-center justify-center gap-2 rounded-full bg-white px-8 py-4 text-base font-semibold text-violet-500 shadow-lg transition-colors hover:bg-violet-50 hover:shadow-xl">
                    {{ __('Get started') }}
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M14 5l7 7m0 0l-7 7m7-7H3" />
                    </svg>
                </a>
                <a href="{{ route('contact') }}"
                    class="inline-flex items-center justify-center gap-2 rounded-full border-2 border-violet-300 px-8 py-4 text-base font-semibold text-white transition-colors hover:bg-violet-600">
                    {{ __('Request a demo') }}
                </a>
                <a href="https://datamind.cegem360.eu/"
                    class="inline-flex items-center justify-center gap-2 text-base font-medium text-violet-200 transition-colors hover:text-white">
                    {{ __('Log in to the platform') }} →
                </a>
            </div>
        </div>
    </section>

    <x-product.legal-note>
        <p>{{ __('Predictions are not guarantees. The platform uses an external AI service and the Google API, which may involve international data transfer. The legality of connected data sources is the customer\'s responsibility. We act as a data processor (DPA).') }}</p>
    </x-product.legal-note>
</div>
