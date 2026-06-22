<div>
    {{-- Hero Section --}}
    <section class="bg-linear-to-b from-violet-50 to-white py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto max-w-4xl text-center">
                <div class="mb-6 flex justify-center">
                    <x-module-icon module="automatizalas" size="xl" />
                </div>

                <div class="mb-6 inline-flex items-center gap-2 rounded-full bg-violet-100 px-4 py-1.5 text-sm font-medium text-violet-700">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                    {{ __('Intelligent business automation') }}
                </div>

                <h1 class="mb-6 text-4xl font-bold tracking-tight text-gray-900 sm:text-5xl lg:text-6xl">
                    {{ __('Automate your business') }}
                    <span class="text-violet-600">{{ __('processes') }}</span>
                </h1>

                <p class="mx-auto mb-10 max-w-2xl text-lg text-gray-600 sm:text-xl">
                    {{ __('Get rid of repetitive manual tasks. The Automation module optimizes your business operations with intelligent workflows and triggers.') }}
                </p>

                <div class="mt-8 flex flex-col items-center justify-center gap-4 sm:flex-row">
                    <a href="{{ route('register') }}"
                        class="inline-flex items-center justify-center gap-2 rounded-full bg-violet-600 px-8 py-4 text-base font-semibold text-white shadow-lg transition-colors hover:bg-violet-700 hover:shadow-xl">
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
                    <a href="https://workflow.cegem360.eu/"
                        class="inline-flex items-center justify-center gap-2 text-base font-medium text-violet-600 transition-colors hover:text-violet-800">
                        {{ __('Log in to the application') }} →
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{-- Problem Section --}}
    <section class="bg-gray-50 py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto max-w-3xl text-center">
                <h2 class="mb-4 text-3xl font-bold text-gray-900 sm:text-4xl">
                    {{ __('Familiar problems?') }}
                </h2>
                <p class="text-lg text-gray-600">
                    {{ __('Manual, repetitive tasks consume a lot of time and energy.') }}
                </p>
            </div>

            <div class="mt-12 grid gap-8 md:grid-cols-2 lg:grid-cols-4">
                <div class="rounded-xl bg-white p-6 shadow-sm">
                    <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-lg bg-red-100">
                        <svg class="h-6 w-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="mb-2 font-semibold text-gray-900">{{ __('Repetitive tasks') }}</h3>
                    <p class="text-sm text-gray-600">{{ __('Your employees perform the same manual steps over and over again on a daily basis.') }}</p>
                </div>

                <div class="rounded-xl bg-white p-6 shadow-sm">
                    <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-lg bg-red-100">
                        <svg class="h-6 w-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                    </div>
                    <h3 class="mb-2 font-semibold text-gray-900">{{ __('Human errors') }}</h3>
                    <p class="text-sm text-gray-600">{{ __('Forgotten or incorrect operations frequently occur during manual data entry and handover.') }}</p>
                </div>

                <div class="rounded-xl bg-white p-6 shadow-sm">
                    <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-lg bg-red-100">
                        <svg class="h-6 w-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 17h8m0 0V9m0 8l-8-8-4 4-6-6" />
                        </svg>
                    </div>
                    <h3 class="mb-2 font-semibold text-gray-900">{{ __('Slow processes') }}</h3>
                    <p class="text-sm text-gray-600">{{ __('Information reaches the right people late, slowing down decision-making.') }}</p>
                </div>

                <div class="rounded-xl bg-white p-6 shadow-sm">
                    <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-lg bg-red-100">
                        <svg class="h-6 w-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="mb-2 font-semibold text-gray-900">{{ __('Unmotivated team') }}</h3>
                    <p class="text-sm text-gray-600">{{ __('Boring, repetitive tasks reduce employee satisfaction and efficiency.') }}</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Features Section --}}
    <section class="py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto max-w-3xl text-center">
                <div class="mb-4 inline-flex items-center gap-2 rounded-full bg-violet-100 px-4 py-1.5 text-sm font-medium text-violet-700">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                    </svg>
                    {{ __('Features') }}
                </div>
                <h2 class="mb-4 text-3xl font-bold text-gray-900 sm:text-4xl">
                    {{ __('Everything you need for automation') }}
                </h2>
                <p class="text-lg text-gray-600">
                    {{ __('Comprehensive toolkit for automating and optimizing workflows.') }}
                </p>
            </div>

            <div class="mt-16 grid gap-8 md:grid-cols-2 lg:grid-cols-3">
                {{-- Feature 1 --}}
                <div class="rounded-2xl border border-gray-100 bg-white p-8 shadow-sm transition hover:shadow-md">
                    <div class="mb-6 flex h-14 w-14 items-center justify-center rounded-xl bg-violet-100">
                        <svg class="h-7 w-7 text-violet-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                        </svg>
                    </div>
                    <h3 class="mb-3 text-xl font-semibold text-gray-900">{{ __('Workflow builder') }}</h3>
                    <p class="mb-4 text-gray-600">
                        {{ __('Design your business processes on a visual drag-and-drop interface without programming.') }}
                    </p>
                    <ul class="space-y-2 text-sm text-gray-600">
                        <li class="flex items-center gap-2">
                            <svg class="h-4 w-4 text-violet-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            {{ __('Drag-and-drop editor') }}
                        </li>
                        <li class="flex items-center gap-2">
                            <svg class="h-4 w-4 text-violet-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            {{ __('Branches and conditions') }}
                        </li>
                        <li class="flex items-center gap-2">
                            <svg class="h-4 w-4 text-violet-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            {{ __('Templates and examples') }}
                        </li>
                    </ul>
                </div>

                {{-- Feature 2 --}}
                <div class="rounded-2xl border border-gray-100 bg-white p-8 shadow-sm transition hover:shadow-md">
                    <div class="mb-6 flex h-14 w-14 items-center justify-center rounded-xl bg-violet-100">
                        <svg class="h-7 w-7 text-violet-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                        </svg>
                    </div>
                    <h3 class="mb-3 text-xl font-semibold text-gray-900">{{ __('Triggers and events') }}</h3>
                    <p class="mb-4 text-gray-600">
                        {{ __('Set up automatic actions that run when events occur.') }}
                    </p>
                    <ul class="space-y-2 text-sm text-gray-600">
                        <li class="flex items-center gap-2">
                            <svg class="h-4 w-4 text-violet-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            {{ __('Time-based and scheduled') }}
                        </li>
                        <li class="flex items-center gap-2">
                            <svg class="h-4 w-4 text-violet-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            {{ __('Data change based') }}
                        </li>
                        <li class="flex items-center gap-2">
                            <svg class="h-4 w-4 text-violet-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            {{ __('User action based') }}
                        </li>
                    </ul>
                </div>

                {{-- Feature 3 --}}
                <div class="rounded-2xl border border-gray-100 bg-white p-8 shadow-sm transition hover:shadow-md">
                    <div class="mb-6 flex h-14 w-14 items-center justify-center rounded-xl bg-violet-100">
                        <svg class="h-7 w-7 text-violet-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <h3 class="mb-3 text-xl font-semibold text-gray-900">{{ __('Automatic notifications') }}</h3>
                    {{-- Content audit: original copy mentioning SMS hidden; SMS not offered --}}
                    @if(false)
                    <p class="mb-4 text-gray-600">
                        {{ __('Automatically send emails, SMS messages, or system notifications about events.') }}
                    </p>
                    @endif
                    <p class="mb-4 text-gray-600">
                        {{ __('Automatically send emails or system notifications about events.') }}
                    </p>
                    <ul class="space-y-2 text-sm text-gray-600">
                        <li class="flex items-center gap-2">
                            <svg class="h-4 w-4 text-violet-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            {{ __('Email templates') }}
                        </li>
                        {{-- Content audit: SMS hidden (not offered); push notifications kept --}}
                        @if(false)
                        <li class="flex items-center gap-2">
                            <svg class="h-4 w-4 text-violet-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            {{ __('SMS and push notifications') }}
                        </li>
                        @endif
                        <li class="flex items-center gap-2">
                            <svg class="h-4 w-4 text-violet-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            {{ __('Push notifications') }}
                        </li>
                        <li class="flex items-center gap-2">
                            <svg class="h-4 w-4 text-violet-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            {{ __('Slack and Teams integration') }}
                        </li>
                    </ul>
                </div>

                {{-- Feature 4 --}}
                <div class="rounded-2xl border border-gray-100 bg-white p-8 shadow-sm transition hover:shadow-md">
                    <div class="mb-6 flex h-14 w-14 items-center justify-center rounded-xl bg-violet-100">
                        <svg class="h-7 w-7 text-violet-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <h3 class="mb-3 text-xl font-semibold text-gray-900">{{ __('Document generation') }}</h3>
                    <p class="mb-4 text-gray-600">
                        {{ __('Automatically create invoices, contracts, reports, and other documents.') }}
                    </p>
                    <ul class="space-y-2 text-sm text-gray-600">
                        <li class="flex items-center gap-2">
                            <svg class="h-4 w-4 text-violet-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            {{ __('PDF and Word export') }}
                        </li>
                        <li class="flex items-center gap-2">
                            <svg class="h-4 w-4 text-violet-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            {{ __('Customizable templates') }}
                        </li>
                        <li class="flex items-center gap-2">
                            <svg class="h-4 w-4 text-violet-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            {{ __('Automatic numbering') }}
                        </li>
                    </ul>
                </div>

                {{-- Feature 5 --}}
                <div class="rounded-2xl border border-gray-100 bg-white p-8 shadow-sm transition hover:shadow-md">
                    <div class="mb-6 flex h-14 w-14 items-center justify-center rounded-xl bg-violet-100">
                        <svg class="h-7 w-7 text-violet-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" />
                        </svg>
                    </div>
                    <h3 class="mb-3 text-xl font-semibold text-gray-900">{{ __('Data synchronization') }}</h3>
                    <p class="mb-4 text-gray-600">
                        {{ __('Keep data in sync between different modules and external systems.') }}
                    </p>
                    <ul class="space-y-2 text-sm text-gray-600">
                        <li class="flex items-center gap-2">
                            <svg class="h-4 w-4 text-violet-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            {{ __('Two-way and one-way sync') }}
                        </li>
                        <li class="flex items-center gap-2">
                            <svg class="h-4 w-4 text-violet-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            {{ __('Data mappings') }}
                        </li>
                        <li class="flex items-center gap-2">
                            <svg class="h-4 w-4 text-violet-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            {{ __('Conflict resolution') }}
                        </li>
                    </ul>
                </div>

                {{-- Feature 6 --}}
                <div class="rounded-2xl border border-gray-100 bg-white p-8 shadow-sm transition hover:shadow-md">
                    <div class="mb-6 flex h-14 w-14 items-center justify-center rounded-xl bg-violet-100">
                        <svg class="h-7 w-7 text-violet-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                    </div>
                    <h3 class="mb-3 text-xl font-semibold text-gray-900">{{ __('Automation reports') }}</h3>
                    <p class="mb-4 text-gray-600">
                        {{ __('Track the performance of automations and identify optimization opportunities.') }}
                    </p>
                    <ul class="space-y-2 text-sm text-gray-600">
                        <li class="flex items-center gap-2">
                            <svg class="h-4 w-4 text-violet-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            {{ __('Execution statistics') }}
                        </li>
                        <li class="flex items-center gap-2">
                            <svg class="h-4 w-4 text-violet-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            {{ __('Error reports') }}
                        </li>
                        <li class="flex items-center gap-2">
                            <svg class="h-4 w-4 text-violet-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            {{ __('Time savings metrics') }}
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    {{-- Results Section --}}
    <section class="bg-violet-600 py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto max-w-3xl text-center">
                <h2 class="mb-4 text-3xl font-bold text-white sm:text-4xl">
                    {{ __('Measurable results') }}
                </h2>
                <p class="text-lg text-violet-100">
                    {{ __('Average improvements achieved by our clients in the first 6 months of automation implementation.') }}
                </p>
            </div>

            <div class="mt-12 grid gap-8 sm:grid-cols-2 lg:grid-cols-5">
                <div class="rounded-xl bg-white/10 p-6 text-center backdrop-blur-sm">
                    <div class="mb-2 text-4xl font-bold text-white">75%</div>
                    <div class="text-sm text-violet-100">{{ __('Fewer manual tasks') }}</div>
                </div>
                <div class="rounded-xl bg-white/10 p-6 text-center backdrop-blur-sm">
                    <div class="mb-2 text-4xl font-bold text-white">60%</div>
                    <div class="text-sm text-violet-100">{{ __('Faster processes') }}</div>
                </div>
                <div class="rounded-xl bg-white/10 p-6 text-center backdrop-blur-sm">
                    <div class="mb-2 text-4xl font-bold text-white">90%</div>
                    <div class="text-sm text-violet-100">{{ __('Fewer human errors') }}</div>
                </div>
                <div class="rounded-xl bg-white/10 p-6 text-center backdrop-blur-sm">
                    <div class="mb-2 text-4xl font-bold text-white">40%</div>
                    <div class="text-sm text-violet-100">{{ __('More time saved') }}</div>
                </div>
                <div class="rounded-xl bg-white/10 p-6 text-center backdrop-blur-sm">
                    <div class="mb-2 text-4xl font-bold text-white">3x</div>
                    <div class="text-sm text-violet-100">{{ __('ROI within 12 months') }}</div>
                </div>
            </div>
            <p class="mt-8 text-center text-xs text-violet-200/70">* {{ __('Illustrative examples') }}</p>
        </div>
    </section>

    {{-- Integrations Section --}}
    <section class="py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto max-w-3xl text-center">
                <div class="mb-4 inline-flex items-center gap-2 rounded-full bg-violet-100 px-4 py-1.5 text-sm font-medium text-violet-700">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
                    </svg>
                    {{ __('Integrations') }}
                </div>
                <h2 class="mb-4 text-3xl font-bold text-gray-900 sm:text-4xl">
                    {{ __('Connect to your favorite tools') }}
                </h2>
                <p class="text-lg text-gray-600">
                    {{ __('Automate workflows with the systems you already use.') }}
                </p>
            </div>

            <div class="mt-12 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                <div class="flex items-center gap-4 rounded-xl border border-gray-100 bg-white p-6 shadow-sm">
                    <div class="flex h-12 w-12 items-center justify-center rounded-lg bg-gray-100">
                        <svg class="h-6 w-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-900">{{ __('Email providers') }}</h3>
                        <p class="text-sm text-gray-600">Gmail, Outlook, SMTP</p>
                    </div>
                </div>

                <div class="flex items-center gap-4 rounded-xl border border-gray-100 bg-white p-6 shadow-sm">
                    <div class="flex h-12 w-12 items-center justify-center rounded-lg bg-gray-100">
                        <svg class="h-6 w-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-900">{{ __('Communication') }}</h3>
                        <p class="text-sm text-gray-600">Slack, Teams, Discord</p>
                    </div>
                </div>

                <div class="flex items-center gap-4 rounded-xl border border-gray-100 bg-white p-6 shadow-sm">
                    <div class="flex h-12 w-12 items-center justify-center rounded-lg bg-gray-100">
                        <svg class="h-6 w-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-900">{{ __('Cloud storage') }}</h3>
                        <p class="text-sm text-gray-600">Google Drive, Dropbox, OneDrive</p>
                    </div>
                </div>

                <div class="flex items-center gap-4 rounded-xl border border-gray-100 bg-white p-6 shadow-sm">
                    <div class="flex h-12 w-12 items-center justify-center rounded-lg bg-gray-100">
                        <svg class="h-6 w-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-900">{{ __('Financial systems') }}</h3>
                        <p class="text-sm text-gray-600">NAV, Szamlazzo, Billingo</p>
                    </div>
                </div>

                <div class="flex items-center gap-4 rounded-xl border border-gray-100 bg-white p-6 shadow-sm">
                    <div class="flex h-12 w-12 items-center justify-center rounded-lg bg-gray-100">
                        <svg class="h-6 w-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-900">{{ __('Webhook and API') }}</h3>
                        <p class="text-sm text-gray-600">REST API, Webhooks, Zapier</p>
                    </div>
                </div>

                <div class="flex items-center gap-4 rounded-xl border border-gray-100 bg-white p-6 shadow-sm">
                    <div class="flex h-12 w-12 items-center justify-center rounded-lg bg-gray-100">
                        <svg class="h-6 w-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-900">{{ __('Calendars') }}</h3>
                        <p class="text-sm text-gray-600">Google Calendar, Outlook</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Who Uses Section --}}
    <section class="bg-gray-50 py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto max-w-3xl text-center">
                <h2 class="mb-4 text-3xl font-bold text-gray-900 sm:text-4xl">
                    {{ __('Who is it for?') }}
                </h2>
                <p class="text-lg text-gray-600">
                    {{ __('The Automation module is ideal for any team that wants to work more efficiently.') }}
                </p>
            </div>

            <div class="mt-12 grid gap-8 sm:grid-cols-2 lg:grid-cols-4">
                <div class="rounded-xl bg-white p-6 shadow-sm">
                    <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-lg bg-violet-100">
                        <svg class="h-6 w-6 text-violet-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                    </div>
                    <h3 class="mb-2 font-semibold text-gray-900">{{ __('Office managers') }}</h3>
                    <p class="text-sm text-gray-600">{{ __('Automate administrative tasks and team communication.') }}</p>
                </div>

                <div class="rounded-xl bg-white p-6 shadow-sm">
                    <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-lg bg-violet-100">
                        <svg class="h-6 w-6 text-violet-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                        </svg>
                    </div>
                    <h3 class="mb-2 font-semibold text-gray-900">{{ __('Process managers') }}</h3>
                    <p class="text-sm text-gray-600">{{ __('Optimize and automate corporate business processes.') }}</p>
                </div>

                <div class="rounded-xl bg-white p-6 shadow-sm">
                    <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-lg bg-violet-100">
                        <svg class="h-6 w-6 text-violet-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>
                    <h3 class="mb-2 font-semibold text-gray-900">{{ __('IT teams') }}</h3>
                    <p class="text-sm text-gray-600">{{ __('Implement integrations and system automation within the company.') }}</p>
                </div>

                <div class="rounded-xl bg-white p-6 shadow-sm">
                    <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-lg bg-violet-100">
                        <svg class="h-6 w-6 text-violet-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                        </svg>
                    </div>
                    <h3 class="mb-2 font-semibold text-gray-900">{{ __('Entrepreneurs') }}</h3>
                    <p class="text-sm text-gray-600">{{ __('Achieve more with fewer resources in daily operations.') }}</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Testimonials Section (hidden) --}}
    @if(false)
    <section class="py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto max-w-3xl text-center">
                <h2 class="mb-4 text-3xl font-bold text-gray-900 sm:text-4xl">
                    {{ __('What our clients say') }}
                </h2>
                <p class="text-lg text-gray-600">
                    {{ __('Learn how the Automation module has helped other businesses.') }}
                </p>
            </div>

            <div class="mt-12 grid gap-8 lg:grid-cols-2">
                <div class="rounded-2xl bg-gray-50 p-8">
                    <div class="mb-6 flex items-center gap-1">
                        @for ($i = 0; $i < 5; $i++)
                            <svg class="h-5 w-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg>
                        @endfor
                    </div>
                    <blockquote class="mb-6 text-gray-700">
                        "{{ __('Before implementing automation, our team spent 3-4 hours daily on repetitive administrative tasks. Today, most of these happen automatically, and colleagues can focus on more valuable work.') }}"
                    </blockquote>
                    <div class="flex items-center gap-4">
                        <div class="flex h-12 w-12 items-center justify-center rounded-full bg-violet-200 font-semibold text-violet-700">
                            NK
                        </div>
                        <div>
                            <div class="font-semibold text-gray-900">Nagy Katalin</div>
                            <div class="text-sm text-gray-600">{{ __('Operations Director, LogiTech Kft.') }}</div>
                        </div>
                    </div>
                </div>

                <div class="rounded-2xl bg-gray-50 p-8">
                    <div class="mb-6 flex items-center gap-1">
                        @for ($i = 0; $i < 5; $i++)
                            <svg class="h-5 w-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg>
                        @endfor
                    </div>
                    <blockquote class="mb-6 text-gray-700">
                        "{{ __('We set up the workflows nicely, one by one at first, but already in the first month human errors decreased by 90%. The system works reliably, and the team has become more motivated.') }}"
                    </blockquote>
                    <div class="flex items-center gap-4">
                        <div class="flex h-12 w-12 items-center justify-center rounded-full bg-violet-200 font-semibold text-violet-700">
                            FT
                        </div>
                        <div>
                            <div class="font-semibold text-gray-900">Fehér Tamás</div>
                            <div class="text-sm text-gray-600">{{ __('IT Director, MediaPrint Zrt.') }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif

    {{-- Related Modules Section --}}
    <section class="py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto max-w-3xl text-center">
                <h2 class="mb-4 text-3xl font-bold text-gray-900 sm:text-4xl">
                    {{ __('Related modules') }}
                </h2>
                <p class="text-lg text-gray-600">
                    {{ __('Extend the Automation module with other Cégem360 modules for complete operations.') }}
                </p>
            </div>

            <div class="mt-12 grid gap-8 md:grid-cols-2">
                <a href="{{ route('products.crm') }}" class="group flex gap-6 rounded-2xl border border-gray-100 bg-white p-6 shadow-sm transition hover:shadow-md">
                    <div class="flex h-16 w-16 shrink-0 items-center justify-center rounded-xl bg-sky-100">
                        <x-module-icon module="crm" size="lg" />
                    </div>
                    <div>
                        <h3 class="mb-2 text-xl font-semibold text-gray-900 group-hover:text-sky-600">CRM</h3>
                        <p class="text-gray-600">{{ __('Automate customer relationship processes: follow-up emails, lead scoring, task assignments.') }}</p>
                    </div>
                </a>

                <a href="{{ route('products.gyartas') }}" class="group flex gap-6 rounded-2xl border border-gray-100 bg-white p-6 shadow-sm transition hover:shadow-md">
                    <div class="flex h-16 w-16 shrink-0 items-center justify-center rounded-xl bg-indigo-100">
                        <x-module-icon module="gyartas" size="lg" />
                    </div>
                    <div>
                        <h3 class="mb-2 text-xl font-semibold text-gray-900 group-hover:text-indigo-600">{{ __('Manufacturing Management') }}</h3>
                        <p class="text-gray-600">{{ __('Automate manufacturing processes: work order generation, quality control alerts.') }}</p>
                    </div>
                </a>
            </div>
        </div>
    </section>

    {{-- Bottom CTA Section --}}
    <section class="bg-linear-to-br from-violet-600 to-violet-800 py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto max-w-3xl text-center">
                <h2 class="mb-6 text-3xl font-bold text-white sm:text-4xl">
                    {{ __('Ready to automate your processes?') }}
                </h2>
                <p class="mb-10 text-lg text-violet-100">
                    {{ __('Full functionality, Hungarian language support. Request a personalized demo.') }}
                </p>
                <div class="flex flex-col items-center justify-center gap-4 sm:flex-row">
                    <a href="{{ route('register') }}"
                        class="inline-flex items-center justify-center gap-2 rounded-full bg-white px-8 py-4 text-base font-semibold text-violet-600 shadow-lg transition-colors hover:bg-violet-50 hover:shadow-xl">
                        {{ __('Get started') }}
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </a>
                    <a href="{{ route('contact') }}"
                        class="inline-flex items-center justify-center gap-2 rounded-full border-2 border-violet-400 px-8 py-4 text-base font-semibold text-white transition-colors hover:bg-violet-700">
                        {{ __('Request a demo') }}
                    </a>
                    <a href="https://workflow.cegem360.eu/"
                        class="inline-flex items-center justify-center gap-2 text-base font-medium text-violet-200 transition-colors hover:text-white">
                        {{ __('Log in to the application') }} →
                    </a>
                </div>
            </div>
        </div>
    </section>

    <x-product.legal-note>
        <p>{{ __('Email sending is live, and document generation (e.g. invoices via the Invoicing module) is supported. The customer is responsible for the workflow configuration. We act as a data processor (DPA); AI clauses apply where relevant.') }}</p>
    </x-product.legal-note>
</div>
