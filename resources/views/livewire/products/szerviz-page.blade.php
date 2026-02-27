<div>
    {{-- Hero Section --}}
    <section class="bg-linear-to-b from-cyan-50 to-white py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto max-w-4xl text-center">
                <div class="mb-6 flex justify-center">
                    <x-module-icon module="szerviz" size="xl" />
                </div>
                <div
                    class="mb-6 inline-flex items-center gap-2 rounded-full bg-cyan-100 px-4 py-1.5 text-sm font-medium text-cyan-700">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                    </svg>
                    {{ __('Service Module') }}
                </div>
                <h1 class="mb-6 text-4xl font-semibold leading-tight text-gray-900 sm:text-5xl lg:text-6xl">
                    {{ __('Digital worksheets for on-site service work') }}
                </h1>
                <p class="mx-auto max-w-3xl text-lg leading-relaxed text-gray-600 sm:text-xl">
                    {{ __('Forget paper-based worksheets. Record everything on-site: work hours, materials used, photos — and create instant digital reports for your clients.') }}
                </p>

                {{-- CTA Buttons --}}
                <div class="mt-8 flex flex-col items-center justify-center gap-4 sm:flex-row">
                    <a href="{{ route('register') }}"
                        class="inline-flex items-center justify-center gap-2 rounded-full bg-cyan-600 px-8 py-4 text-base font-semibold text-white shadow-lg transition-colors hover:bg-cyan-700 hover:shadow-xl">
                        {{ __('Get started') }}
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </a>
                    <a href="{{ route('contact') }}"
                        class="inline-flex items-center justify-center gap-2 rounded-full border-2 border-cyan-200 bg-white px-8 py-4 text-base font-semibold text-cyan-700 transition-colors hover:bg-cyan-50">
                        {{ __('Request a demo') }}
                    </a>
                    <a href="{{ route('login') }}"
                        class="inline-flex items-center justify-center gap-2 text-base font-medium text-cyan-600 transition-colors hover:text-cyan-800">
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
                <div class="rounded-2xl border border-cyan-100 bg-linear-to-br from-cyan-50 to-white p-8">
                    <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-xl bg-white shadow-sm">
                        <svg class="h-6 w-6 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <h3 class="mb-2 text-lg font-semibold text-gray-900">{{ __('Lost papers') }}</h3>
                    <p class="text-gray-600">{{ __('Handwritten worksheets get lost, become illegible, or go missing.') }}</p>
                </div>
                <div class="rounded-2xl border border-cyan-100 bg-linear-to-br from-cyan-50 to-white p-8">
                    <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-xl bg-white shadow-sm">
                        <svg class="h-6 w-6 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="mb-2 text-lg font-semibold text-gray-900">{{ __('Delayed invoicing') }}</h3>
                    <p class="text-gray-600">{{ __('Worksheets only reach the office days later, delaying invoicing.') }}</p>
                </div>
                <div class="rounded-2xl border border-cyan-100 bg-linear-to-br from-cyan-50 to-white p-8">
                    <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-xl bg-white shadow-sm">
                        <svg class="h-6 w-6 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>
                    <h3 class="mb-2 text-lg font-semibold text-gray-900">{{ __('Missing documentation') }}</h3>
                    <p class="text-gray-600">{{ __('No photo documentation of completed work, leading to disputes.') }}</p>
                </div>
                <div class="rounded-2xl border border-cyan-100 bg-linear-to-br from-cyan-50 to-white p-8">
                    <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-xl bg-white shadow-sm">
                        <svg class="h-6 w-6 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <h3 class="mb-2 text-lg font-semibold text-gray-900">{{ __('Non-transparent performance') }}</h3>
                    <p class="text-gray-600">{{ __('You cannot see in real time where each technician is and how much work they have done.') }}</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Features Section --}}
    <section class="bg-gray-50 py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto mb-12 max-w-3xl text-center">
                <h2 class="text-3xl font-semibold text-gray-900 sm:text-4xl">{{ __('Key Features') }}</h2>
                <p class="mt-4 text-lg text-gray-600">{{ __('Everything you need to manage on-site work.') }}</p>
            </div>

            <div class="grid gap-8 lg:grid-cols-3">
                {{-- Digitális munkalap --}}
                <div
                    class="rounded-2xl border border-gray-100 bg-white p-8 shadow-sm transition-shadow hover:shadow-lg">
                    <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-xl bg-cyan-100">
                        <svg class="h-6 w-6 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                        </svg>
                    </div>
                    <h3 class="mb-3 text-xl font-semibold text-gray-900">{{ __('Digital Worksheet') }}</h3>
                    <ul class="space-y-2 text-gray-600">
                        <li class="flex items-start gap-2">
                            <svg class="mt-1 h-4 w-4 shrink-0 text-cyan-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            {{ __('Mobile-fillable forms') }}
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="mt-1 h-4 w-4 shrink-0 text-cyan-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            {{ __('Customizable fields by industry') }}
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="mt-1 h-4 w-4 shrink-0 text-cyan-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            {{ __('Offline mode support') }}
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="mt-1 h-4 w-4 shrink-0 text-cyan-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            {{ __('Automatic synchronization') }}
                        </li>
                    </ul>
                </div>

                {{-- Munkaidő és anyagkövetés --}}
                <div
                    class="rounded-2xl border border-gray-100 bg-white p-8 shadow-sm transition-shadow hover:shadow-lg">
                    <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-xl bg-cyan-100">
                        <svg class="h-6 w-6 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="mb-3 text-xl font-semibold text-gray-900">{{ __('Work Time and Material Tracking') }}</h3>
                    <ul class="space-y-2 text-gray-600">
                        <li class="flex items-start gap-2">
                            <svg class="mt-1 h-4 w-4 shrink-0 text-cyan-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            {{ __('Accurate time tracking') }}
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="mt-1 h-4 w-4 shrink-0 text-cyan-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            {{ __('Recording materials used') }}
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="mt-1 h-4 w-4 shrink-0 text-cyan-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            {{ __('Inventory connection') }}
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="mt-1 h-4 w-4 shrink-0 text-cyan-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            {{ __('Automatic cost calculation') }}
                        </li>
                    </ul>
                </div>

                {{-- Dokumentumkezelés és iratkövetés --}}
                <div
                    class="rounded-2xl border border-gray-100 bg-white p-8 shadow-sm transition-shadow hover:shadow-lg">
                    <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-xl bg-cyan-100">
                        <svg class="h-6 w-6 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>
                    <h3 class="mb-3 text-xl font-semibold text-gray-900">{{ __('Document Management and Tracking') }}</h3>
                    <ul class="space-y-2 text-gray-600">
                        <li class="flex items-start gap-2">
                            <svg class="mt-1 h-4 w-4 shrink-0 text-cyan-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            {{ __('Document lifecycle tracking') }}
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="mt-1 h-4 w-4 shrink-0 text-cyan-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            {{ __('Automatic timestamping') }}
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="mt-1 h-4 w-4 shrink-0 text-cyan-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            {{ __('Easy search') }}
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="mt-1 h-4 w-4 shrink-0 text-cyan-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            {{ __('Cloud-based storage') }}
                        </li>
                    </ul>
                </div>

                {{-- Digitális aláírás --}}
                <div
                    class="rounded-2xl border border-gray-100 bg-white p-8 shadow-sm transition-shadow hover:shadow-lg">
                    <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-xl bg-cyan-100">
                        <svg class="h-6 w-6 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                        </svg>
                    </div>
                    <h3 class="mb-3 text-xl font-semibold text-gray-900">{{ __('Digital Signature') }}</h3>
                    <ul class="space-y-2 text-gray-600">
                        <li class="flex items-start gap-2">
                            <svg class="mt-1 h-4 w-4 shrink-0 text-cyan-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            {{ __('On-site client signature') }}
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="mt-1 h-4 w-4 shrink-0 text-cyan-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            {{ __('Legally accepted format') }}
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="mt-1 h-4 w-4 shrink-0 text-cyan-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            {{ __('Instant PDF generation') }}
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="mt-1 h-4 w-4 shrink-0 text-cyan-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            {{ __('Email sending to the client') }}
                        </li>
                    </ul>
                </div>

                {{-- Ütemezés és diszpécser --}}
                <div
                    class="rounded-2xl border border-gray-100 bg-white p-8 shadow-sm transition-shadow hover:shadow-lg">
                    <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-xl bg-cyan-100">
                        <svg class="h-6 w-6 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <h3 class="mb-3 text-xl font-semibold text-gray-900">{{ __('Scheduling and Dispatching') }}</h3>
                    <ul class="space-y-2 text-gray-600">
                        <li class="flex items-start gap-2">
                            <svg class="mt-1 h-4 w-4 shrink-0 text-cyan-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            {{ __('Drag-and-drop calendar') }}
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="mt-1 h-4 w-4 shrink-0 text-cyan-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            {{ __('Technician assignment') }}
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="mt-1 h-4 w-4 shrink-0 text-cyan-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            {{ __('Route optimization') }}
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="mt-1 h-4 w-4 shrink-0 text-cyan-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            {{ __('Real-time status tracking') }}
                        </li>
                    </ul>
                </div>

                {{-- Riportok és elemzések --}}
                <div
                    class="rounded-2xl border border-gray-100 bg-white p-8 shadow-sm transition-shadow hover:shadow-lg">
                    <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-xl bg-cyan-100">
                        <svg class="h-6 w-6 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                    </div>
                    <h3 class="mb-3 text-xl font-semibold text-gray-900">{{ __('Reports and Analytics') }}</h3>
                    <ul class="space-y-2 text-gray-600">
                        <li class="flex items-start gap-2">
                            <svg class="mt-1 h-4 w-4 shrink-0 text-cyan-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            {{ __('Technician performance reports') }}
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="mt-1 h-4 w-4 shrink-0 text-cyan-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            {{ __('Material usage statistics') }}
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="mt-1 h-4 w-4 shrink-0 text-cyan-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            {{ __('Customer satisfaction measurements') }}
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="mt-1 h-4 w-4 shrink-0 text-cyan-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            {{ __('Export to PDF/Excel') }}
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
                <h2 class="text-3xl font-semibold text-gray-900 sm:text-4xl">{{ __('Results in Numbers') }}</h2>
                <p class="mt-4 text-lg text-gray-600">{{ __('What our clients experience after implementation.') }}</p>
            </div>

            <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-4">
                <div class="text-center">
                    <div class="mb-4 text-5xl font-bold text-cyan-600">70%</div>
                    <p class="text-lg font-medium text-gray-900">{{ __('Faster administration') }}</p>
                    <p class="mt-1 text-gray-600">{{ __('Less paperwork, more time for work.') }}</p>
                </div>
                <div class="text-center">
                    <div class="mb-4 text-5xl font-bold text-cyan-600">50%</div>
                    <p class="text-lg font-medium text-gray-900">{{ __('Faster invoicing') }}</p>
                    <p class="mt-1 text-gray-600">{{ __('Instant worksheet = instant invoice.') }}</p>
                </div>
                <div class="text-center">
                    <div class="mb-4 text-5xl font-bold text-cyan-600">0</div>
                    <p class="text-lg font-medium text-gray-900">{{ __('Lost worksheets') }}</p>
                    <p class="mt-1 text-gray-600">{{ __('All data safely in the cloud.') }}</p>
                </div>
                <div class="text-center">
                    <div class="mb-4 text-5xl font-bold text-cyan-600">100%</div>
                    <p class="text-lg font-medium text-gray-900">{{ __('Transparency') }}</p>
                    <p class="mt-1 text-gray-600">{{ __('Real-time visibility into all work.') }}</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Who Uses Section --}}
    <section class="bg-gray-50 py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto mb-12 max-w-3xl text-center">
                <h2 class="text-3xl font-semibold text-gray-900 sm:text-4xl">{{ __('Who is it for?') }}</h2>
                <p class="mt-4 text-lg text-gray-600">{{ __('Ideal solution for companies providing on-site services.') }}</p>
            </div>

            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                <div class="rounded-2xl bg-white p-6 shadow-sm">
                    <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-xl bg-cyan-100">
                        <svg class="h-6 w-6 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                    </div>
                    <h3 class="mb-2 text-lg font-semibold text-gray-900">{{ __('Building engineering companies') }}</h3>
                    <p class="text-gray-600">{{ __('Documentation and billing for heating, air conditioning, and plumbing work.') }}</p>
                </div>
                <div class="rounded-2xl bg-white p-6 shadow-sm">
                    <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-xl bg-cyan-100">
                        <svg class="h-6 w-6 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                    <h3 class="mb-2 text-lg font-semibold text-gray-900">{{ __('Electricians') }}</h3>
                    <p class="text-gray-600">{{ __('Precise documentation and handover of electrical work.') }}</p>
                </div>
                <div class="rounded-2xl bg-white p-6 shadow-sm">
                    <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-xl bg-cyan-100">
                        <svg class="h-6 w-6 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>
                    <h3 class="mb-2 text-lg font-semibold text-gray-900">{{ __('Machine technicians, maintenance workers') }}</h3>
                    <p class="text-gray-600">{{ __('Tracking maintenance of industrial machines.') }}</p>
                </div>
                <div class="rounded-2xl bg-white p-6 shadow-sm">
                    <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-xl bg-cyan-100">
                        <svg class="h-6 w-6 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                    </div>
                    <h3 class="mb-2 text-lg font-semibold text-gray-900">{{ __('Security technology companies') }}</h3>
                    <p class="text-gray-600">{{ __('Installation and maintenance of alarm and camera systems.') }}</p>
                </div>
                <div class="rounded-2xl bg-white p-6 shadow-sm">
                    <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-xl bg-cyan-100">
                        <svg class="h-6 w-6 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                    </div>
                    <h3 class="mb-2 text-lg font-semibold text-gray-900">{{ __('Property managers') }}</h3>
                    <p class="text-gray-600">{{ __('Coordination and documentation of building maintenance work.') }}</p>
                </div>
                <div class="rounded-2xl bg-white p-6 shadow-sm">
                    <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-xl bg-cyan-100">
                        <svg class="h-6 w-6 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z" />
                        </svg>
                    </div>
                    <h3 class="mb-2 text-lg font-semibold text-gray-900">{{ __('IT service providers') }}</h3>
                    <p class="text-gray-600">{{ __('Documentation of on-site hardware and software service.') }}</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Testimonial Section (hidden) --}}
    @if(false)
    <section class="bg-white py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto max-w-3xl text-center">
                <blockquote class="text-2xl font-medium text-gray-900 sm:text-3xl">
                    "{{ __('Since we started using digital worksheets, our invoicing has become days faster. Clients are also more satisfied because they receive the report immediately.') }}"
                </blockquote>
                <div class="mt-8 flex items-center justify-center gap-4">
                    <div
                        class="flex h-12 w-12 items-center justify-center rounded-full bg-cyan-100 text-lg font-semibold text-cyan-700">
                        BL
                    </div>
                    <div class="text-left">
                        <p class="font-semibold text-gray-900">Balogh László</p>
                        <p class="text-gray-600">{{ __('Managing Director, KlimaProfi Kft.') }}</p>
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
                <h2 class="text-3xl font-semibold text-gray-900 sm:text-4xl">{{ __('Related Modules') }}</h2>
                <p class="mt-4 text-lg text-gray-600">{{ __('Extend the Service module with additional functionality.') }}</p>
            </div>

            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                <a href="{{ route('products.crm') }}"
                    class="group rounded-2xl bg-white p-6 shadow-sm transition-shadow hover:shadow-lg">
                    <div class="mb-4 flex items-center gap-3">
                        <x-module-icon module="crm" size="md" />
                        <h3 class="text-lg font-semibold text-gray-900 group-hover:text-cyan-600">CRM</h3>
                    </div>
                    <p class="text-gray-600">{{ __('Connect service work with customer records and contracts.') }}</p>
                </a>
                <a href="{{ route('products.beszerzes') }}"
                    class="group rounded-2xl bg-white p-6 shadow-sm transition-shadow hover:shadow-lg">
                    <div class="mb-4 flex items-center gap-3">
                        <x-module-icon module="beszerzes" size="md" />
                        <h3 class="text-lg font-semibold text-gray-900 group-hover:text-cyan-600">{{ __('Procurement & Logistics') }}
                        </h3>
                    </div>
                    <p class="text-gray-600">{{ __('Manage materials used and inventory in an integrated way.') }}</p>
                </a>
                <a href="{{ route('products.kontrolling') }}"
                    class="group rounded-2xl bg-white p-6 shadow-sm transition-shadow hover:shadow-lg">
                    <div class="mb-4 flex items-center gap-3">
                        <x-module-icon module="kontrolling" size="md" />
                        <h3 class="text-lg font-semibold text-gray-900 group-hover:text-cyan-600">{{ __('Controlling') }}</h3>
                    </div>
                    <p class="text-gray-600">{{ __('Analyze the profitability and costs of service work.') }}</p>
                </a>
            </div>
        </div>
    </section>

    {{-- CTA Section --}}
    <section class="bg-cyan-600 py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto max-w-3xl text-center">
                <h2 class="text-3xl font-semibold text-white sm:text-4xl">{{ __('Ready for paperless service?') }}</h2>
                <p class="mt-4 text-lg text-cyan-100">{{ __('Full functionality, Hungarian-language support. Request a personalized demo.') }}</p>
                <div class="mt-8 flex flex-col items-center justify-center gap-4 sm:flex-row">
                    <a href="{{ route('register') }}"
                        class="inline-flex items-center justify-center gap-2 rounded-full bg-white px-8 py-4 text-base font-semibold text-cyan-700 shadow-lg transition-colors hover:bg-cyan-50 hover:shadow-xl">
                        {{ __('Get started') }}
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </a>
                    <a href="{{ route('contact') }}"
                        class="inline-flex items-center justify-center gap-2 rounded-full border-2 border-white bg-transparent px-8 py-4 text-base font-semibold text-white transition-colors hover:bg-white/10">
                        {{ __('Request a demo') }}
                    </a>
                    <a href="{{ route('login') }}"
                        class="inline-flex items-center justify-center gap-2 text-base font-medium text-cyan-200 transition-colors hover:text-white">
                        {{ __('Log in to the application') }} →
                    </a>
                </div>
            </div>
        </div>
    </section>
</div>
