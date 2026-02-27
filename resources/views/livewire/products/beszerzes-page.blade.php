<div>
    {{-- Hero Section --}}
    <section class="bg-linear-to-b from-amber-50 to-white py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto max-w-4xl text-center">
                <div class="mb-6 flex justify-center">
                    <x-module-icon module="beszerzes" size="xl" />
                </div>
                <div
                    class="mb-6 inline-flex items-center gap-2 rounded-full bg-amber-100 px-4 py-1.5 text-sm font-medium text-amber-700">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                    </svg>
                    {{ __('Procurement & Logistics Module') }}
                </div>
                <h1 class="mb-6 text-4xl font-semibold leading-tight text-gray-900 sm:text-5xl lg:text-6xl">
                    {{ __('Optimize your inventory and supplier relationships') }}
                </h1>
                <p class="mx-auto max-w-3xl text-lg leading-relaxed text-gray-600 sm:text-xl">
                    {{ __('The Cégem360 Procurement & Logistics module helps you accurately track inventory, manage supplier orders, and optimize warehouse operations.') }}
                </p>

                {{-- CTA Buttons --}}
                <div class="mt-8 flex flex-col items-center justify-center gap-4 sm:flex-row">
                    <a href="{{ route('register') }}"
                        class="inline-flex items-center justify-center gap-2 rounded-full bg-amber-600 px-8 py-4 text-base font-semibold text-white shadow-lg transition-colors hover:bg-amber-700 hover:shadow-xl">
                        {{ __('Get started') }}
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </a>
                    <a href="{{ route('contact') }}"
                        class="inline-flex items-center justify-center gap-2 rounded-full border-2 border-amber-200 bg-white px-8 py-4 text-base font-semibold text-amber-700 transition-colors hover:bg-amber-50">
                        {{ __('Request a demo') }}
                    </a>
                    <a href="{{ route('login') }}"
                        class="inline-flex items-center justify-center gap-2 text-base font-medium text-amber-600 transition-colors hover:text-amber-800">
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
                <div class="rounded-2xl border border-amber-100 bg-linear-to-br from-amber-50 to-white p-8">
                    <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-xl bg-white shadow-sm">
                        <svg class="h-6 w-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                    </div>
                    <h3 class="mb-2 text-lg font-semibold text-gray-900">{{ __('Stock shortage') }}</h3>
                    <p class="text-gray-600">{{ __('You notice too late that a key raw material has run out.') }}</p>
                </div>
                <div class="rounded-2xl border border-amber-100 bg-linear-to-br from-amber-50 to-white p-8">
                    <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-xl bg-white shadow-sm">
                        <svg class="h-6 w-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                        </svg>
                    </div>
                    <h3 class="mb-2 text-lg font-semibold text-gray-900">{{ __('Overstocking') }}</h3>
                    <p class="text-gray-600">{{ __('Unnecessarily ties up capital in inventory sitting in the warehouse.') }}</p>
                </div>
                <div class="rounded-2xl border border-amber-100 bg-linear-to-br from-amber-50 to-white p-8">
                    <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-xl bg-white shadow-sm">
                        <svg class="h-6 w-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="mb-2 text-lg font-semibold text-gray-900">{{ __('Supplier chaos') }}</h3>
                    <p class="text-gray-600">{{ __('You don\'t know which supplier delivers what and when.') }}</p>
                </div>
                <div class="rounded-2xl border border-amber-100 bg-linear-to-br from-amber-50 to-white p-8">
                    <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-xl bg-white shadow-sm">
                        <svg class="h-6 w-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <h3 class="mb-2 text-lg font-semibold text-gray-900">{{ __('Manual inventory counting') }}</h3>
                    <p class="text-gray-600">{{ __('Paper-based warehouse management, inaccurate stock data.') }}</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Features Section --}}
    <section class="bg-gray-50 py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto mb-12 max-w-3xl text-center">
                <h2 class="text-3xl font-semibold text-gray-900 sm:text-4xl">{{ __('Key features') }}</h2>
                <p class="mt-4 text-lg text-gray-600">{{ __('Everything you need for efficient procurement and warehouse management.') }}</p>
            </div>

            <div class="grid gap-8 lg:grid-cols-3">
                {{-- Készletkezelés --}}
                <div
                    class="rounded-2xl border border-gray-100 bg-white p-8 shadow-sm transition-shadow hover:shadow-lg">
                    <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-xl bg-amber-100">
                        <svg class="h-6 w-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                        </svg>
                    </div>
                    <h3 class="mb-3 text-xl font-semibold text-gray-900">{{ __('Inventory management') }}</h3>
                    <ul class="space-y-2 text-gray-600">
                        <li class="flex items-start gap-2">
                            <svg class="mt-1 h-4 w-4 shrink-0 text-amber-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            {{ __('Real-time stock level tracking') }}
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="mt-1 h-4 w-4 shrink-0 text-amber-500" fill="currentColor"
                                viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            {{ __('Automatic minimum stock alerts') }}
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="mt-1 h-4 w-4 shrink-0 text-amber-500" fill="currentColor"
                                viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            {{ __('Multi-warehouse support') }}
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="mt-1 h-4 w-4 shrink-0 text-amber-500" fill="currentColor"
                                viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            {{ __('Barcode and QR code management') }}
                        </li>
                    </ul>
                </div>

                {{-- Beszállító kezelés --}}
                <div
                    class="rounded-2xl border border-gray-100 bg-white p-8 shadow-sm transition-shadow hover:shadow-lg">
                    <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-xl bg-amber-100">
                        <svg class="h-6 w-6 text-amber-600" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                    <h3 class="mb-3 text-xl font-semibold text-gray-900">{{ __('Supplier management') }}</h3>
                    <ul class="space-y-2 text-gray-600">
                        <li class="flex items-start gap-2">
                            <svg class="mt-1 h-4 w-4 shrink-0 text-amber-500" fill="currentColor"
                                viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            {{ __('Supplier database') }}
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="mt-1 h-4 w-4 shrink-0 text-amber-500" fill="currentColor"
                                viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            {{ __('Price list and discount management') }}
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="mt-1 h-4 w-4 shrink-0 text-amber-500" fill="currentColor"
                                viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            {{ __('Supplier performance evaluation') }}
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="mt-1 h-4 w-4 shrink-0 text-amber-500" fill="currentColor"
                                viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            {{ __('Contract and document storage') }}
                        </li>
                    </ul>
                </div>

                {{-- Rendeléskezelés --}}
                <div
                    class="rounded-2xl border border-gray-100 bg-white p-8 shadow-sm transition-shadow hover:shadow-lg">
                    <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-xl bg-amber-100">
                        <svg class="h-6 w-6 text-amber-600" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                        </svg>
                    </div>
                    <h3 class="mb-3 text-xl font-semibold text-gray-900">{{ __('Order management') }}</h3>
                    <ul class="space-y-2 text-gray-600">
                        <li class="flex items-start gap-2">
                            <svg class="mt-1 h-4 w-4 shrink-0 text-amber-500" fill="currentColor"
                                viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            {{ __('Automatic procurement suggestions') }}
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="mt-1 h-4 w-4 shrink-0 text-amber-500" fill="currentColor"
                                viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            {{ __('Order approval workflow') }}
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="mt-1 h-4 w-4 shrink-0 text-amber-500" fill="currentColor"
                                viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            {{ __('Delivery deadline tracking') }}
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="mt-1 h-4 w-4 shrink-0 text-amber-500" fill="currentColor"
                                viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            {{ __('Goods receipt and quality control') }}
                        </li>
                    </ul>
                </div>

                {{-- Raktári műveletek --}}
                <div
                    class="rounded-2xl border border-gray-100 bg-white p-8 shadow-sm transition-shadow hover:shadow-lg">
                    <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-xl bg-amber-100">
                        <svg class="h-6 w-6 text-amber-600" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                        </svg>
                    </div>
                    <h3 class="mb-3 text-xl font-semibold text-gray-900">{{ __('Warehouse operations') }}</h3>
                    <ul class="space-y-2 text-gray-600">
                        <li class="flex items-start gap-2">
                            <svg class="mt-1 h-4 w-4 shrink-0 text-amber-500" fill="currentColor"
                                viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            {{ __('Inbound and outbound handling') }}
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="mt-1 h-4 w-4 shrink-0 text-amber-500" fill="currentColor"
                                viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            {{ __('Storage location management') }}
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="mt-1 h-4 w-4 shrink-0 text-amber-500" fill="currentColor"
                                viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            {{ __('Inter-warehouse transfer operations') }}
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="mt-1 h-4 w-4 shrink-0 text-amber-500" fill="currentColor"
                                viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            {{ __('Stocktaking support') }}
                        </li>
                    </ul>
                </div>

                {{-- Áru- és csomagkövetés --}}
                <div
                    class="rounded-2xl border border-gray-100 bg-white p-8 shadow-sm transition-shadow hover:shadow-lg">
                    <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-xl bg-amber-100">
                        <svg class="h-6 w-6 text-amber-600" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7" />
                        </svg>
                    </div>
                    <h3 class="mb-3 text-xl font-semibold text-gray-900">{{ __('Goods and parcel tracking') }}</h3>
                    <ul class="space-y-2 text-gray-600">
                        <li class="flex items-start gap-2">
                            <svg class="mt-1 h-4 w-4 shrink-0 text-amber-500" fill="currentColor"
                                viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            {{ __('Shipment tracking') }}
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="mt-1 h-4 w-4 shrink-0 text-amber-500" fill="currentColor"
                                viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            {{ __('Courier service integration') }}
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="mt-1 h-4 w-4 shrink-0 text-amber-500" fill="currentColor"
                                viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            {{ __('Packing list management') }}
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="mt-1 h-4 w-4 shrink-0 text-amber-500" fill="currentColor"
                                viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            {{ __('Delivery planning') }}
                        </li>
                    </ul>
                </div>

                {{-- Riportok és elemzések --}}
                <div
                    class="rounded-2xl border border-gray-100 bg-white p-8 shadow-sm transition-shadow hover:shadow-lg">
                    <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-xl bg-amber-100">
                        <svg class="h-6 w-6 text-amber-600" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                    </div>
                    <h3 class="mb-3 text-xl font-semibold text-gray-900">{{ __('Reports and analytics') }}</h3>
                    <ul class="space-y-2 text-gray-600">
                        <li class="flex items-start gap-2">
                            <svg class="mt-1 h-4 w-4 shrink-0 text-amber-500" fill="currentColor"
                                viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            {{ __('Inventory turnover analysis') }}
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="mt-1 h-4 w-4 shrink-0 text-amber-500" fill="currentColor"
                                viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            {{ __('ABC analysis') }}
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="mt-1 h-4 w-4 shrink-0 text-amber-500" fill="currentColor"
                                viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            {{ __('Procurement cost report') }}
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="mt-1 h-4 w-4 shrink-0 text-amber-500" fill="currentColor"
                                viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            {{ __('Supplier performance report') }}
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
                <div class="rounded-2xl bg-amber-50 p-6 text-center">
                    <div class="text-4xl font-bold text-amber-600">-30%</div>
                    <div class="mt-2 text-sm text-gray-600">{{ __('Reduction in stock shortages') }}</div>
                </div>
                <div class="rounded-2xl bg-amber-50 p-6 text-center">
                    <div class="text-4xl font-bold text-amber-600">-25%</div>
                    <div class="mt-2 text-sm text-gray-600">{{ __('Reduction in overstocking') }}</div>
                </div>
                <div class="rounded-2xl bg-amber-50 p-6 text-center">
                    <div class="text-4xl font-bold text-amber-600">+40%</div>
                    <div class="mt-2 text-sm text-gray-600">{{ __('Warehouse efficiency') }}</div>
                </div>
                <div class="rounded-2xl bg-amber-50 p-6 text-center">
                    <div class="text-4xl font-bold text-amber-600">-20%</div>
                    <div class="mt-2 text-sm text-gray-600">{{ __('Procurement costs') }}</div>
                </div>
                <div class="rounded-2xl bg-amber-50 p-6 text-center">
                    <div class="text-4xl font-bold text-amber-600">+50%</div>
                    <div class="mt-2 text-sm text-gray-600">{{ __('Stocktaking speed') }}</div>
                </div>
            </div>
        </div>
    </section>

    {{-- Integrations Section --}}
    <section class="bg-gray-50 py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto mb-12 max-w-3xl text-center">
                <h2 class="text-3xl font-semibold text-gray-900 sm:text-4xl">{{ __('Integrations') }}</h2>
                <p class="mt-4 text-lg text-gray-600">{{ __('Connect to the tools you already use.') }}</p>
            </div>

            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                <div class="flex items-center gap-4 rounded-xl bg-white p-6 shadow-sm">
                    <div class="flex h-12 w-12 items-center justify-center rounded-lg bg-amber-100">
                        <svg class="h-6 w-6 text-amber-600" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-900">{{ __('Barcode scanners') }}</h3>
                        <p class="text-sm text-gray-600">Zebra, Honeywell, Datalogic</p>
                    </div>
                </div>
                <div class="flex items-center gap-4 rounded-xl bg-white p-6 shadow-sm">
                    <div class="flex h-12 w-12 items-center justify-center rounded-lg bg-amber-100">
                        <svg class="h-6 w-6 text-amber-600" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-900">{{ __('Courier services') }}</h3>
                        <p class="text-sm text-gray-600">GLS, DPD, FoxPost, MPL</p>
                    </div>
                </div>
                <div class="flex items-center gap-4 rounded-xl bg-white p-6 shadow-sm">
                    <div class="flex h-12 w-12 items-center justify-center rounded-lg bg-amber-100">
                        <svg class="h-6 w-6 text-amber-600" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-900">{{ __('Invoicing') }}</h3>
                        <p class="text-sm text-gray-600">Billingo, Számlázz.hu, NAV</p>
                    </div>
                </div>
                <div class="flex items-center gap-4 rounded-xl bg-white p-6 shadow-sm">
                    <div class="flex h-12 w-12 items-center justify-center rounded-lg bg-amber-100">
                        <svg class="h-6 w-6 text-amber-600" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-900">{{ __('Webshops') }}</h3>
                        <p class="text-sm text-gray-600">WooCommerce, Shopify, Shoprenter</p>
                    </div>
                </div>
                <div class="flex items-center gap-4 rounded-xl bg-white p-6 shadow-sm">
                    <div class="flex h-12 w-12 items-center justify-center rounded-lg bg-amber-100">
                        <svg class="h-6 w-6 text-amber-600" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-900">{{ __('Accounting software') }}</h3>
                        <p class="text-sm text-gray-600">Kulcs-Soft, Novitax, RLB</p>
                    </div>
                </div>
                <div class="flex items-center gap-4 rounded-xl bg-white p-6 shadow-sm">
                    <div class="flex h-12 w-12 items-center justify-center rounded-lg bg-amber-100">
                        <svg class="h-6 w-6 text-amber-600" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-900">API</h3>
                        <p class="text-sm text-gray-600">{{ __('REST API for custom integrations') }}</p>
                    </div>
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
                    <div class="mx-auto mb-4 flex h-14 w-14 items-center justify-center rounded-xl bg-amber-100">
                        <svg class="h-7 w-7 text-amber-600" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                        </svg>
                    </div>
                    <h3 class="mb-2 font-semibold text-gray-900">{{ __('Warehouse staff') }}</h3>
                    <p class="text-sm text-gray-600">{{ __('Inbound and outbound, stocktaking') }}</p>
                </div>
                <div class="rounded-2xl border border-gray-100 bg-white p-6 text-center shadow-sm">
                    <div class="mx-auto mb-4 flex h-14 w-14 items-center justify-center rounded-xl bg-amber-100">
                        <svg class="h-7 w-7 text-amber-600" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                    <h3 class="mb-2 font-semibold text-gray-900">{{ __('Procurement officers') }}</h3>
                    <p class="text-sm text-gray-600">{{ __('Orders and supplier management') }}</p>
                </div>
                <div class="rounded-2xl border border-gray-100 bg-white p-6 text-center shadow-sm">
                    <div class="mx-auto mb-4 flex h-14 w-14 items-center justify-center rounded-xl bg-amber-100">
                        <svg class="h-7 w-7 text-amber-600" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" />
                        </svg>
                    </div>
                    <h3 class="mb-2 font-semibold text-gray-900">{{ __('Logistics coordinators') }}</h3>
                    <p class="text-sm text-gray-600">{{ __('Delivery planning and tracking') }}</p>
                </div>
                <div class="rounded-2xl border border-gray-100 bg-white p-6 text-center shadow-sm">
                    <div class="mx-auto mb-4 flex h-14 w-14 items-center justify-center rounded-xl bg-amber-100">
                        <svg class="h-7 w-7 text-amber-600" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                    </div>
                    <h3 class="mb-2 font-semibold text-gray-900">{{ __('Managers') }}</h3>
                    <p class="text-sm text-gray-600">{{ __('Reports and decision support') }}</p>
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
                        {{ __('We used to do inventory once a week, and even then stock shortages occurred. Now we see what\'s in the warehouse in real time.') }}
                    </blockquote>
                    <div class="flex items-center gap-4">
                        <div
                            class="flex h-12 w-12 items-center justify-center rounded-full bg-amber-100 text-amber-600 font-semibold">
                            NI</div>
                        <div>
                            <div class="font-semibold text-gray-900">{{ __('István Nagy') }}</div>
                            <div class="text-sm text-gray-500">{{ __('Warehouse Manager, Trading Ltd.') }}</div>
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
                        {{ __('Tracking supplier performance helped us select reliable partners. Since then, late deliveries have decreased by 20%.') }}
                    </blockquote>
                    <div class="flex items-center gap-4">
                        <div
                            class="flex h-12 w-12 items-center justify-center rounded-full bg-amber-100 text-amber-600 font-semibold">
                            TM</div>
                        <div>
                            <div class="font-semibold text-gray-900">{{ __('Mária Tóth') }}</div>
                            <div class="text-sm text-gray-500">{{ __('Procurement Manager, Manufacturing Plc.') }}</div>
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
                <p class="mt-4 text-lg text-gray-600">{{ __('Extend the Procurement & Logistics module with these modules.') }}</p>
            </div>

            <div class="grid gap-6 sm:grid-cols-2">
                <a href="{{ route('products.gyartas') }}"
                    class="group rounded-2xl border border-gray-100 bg-white p-6 shadow-sm transition-shadow hover:shadow-lg">
                    <div class="flex items-center gap-4">
                        <x-module-icon module="gyartas" size="lg" />
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 group-hover:text-indigo-600">
                                {{ __('Manufacturing module') }}</h3>
                            <p class="text-gray-600">{{ __('Production processes and raw material usage') }}</p>
                        </div>
                    </div>
                </a>
                <a href="{{ route('products.ertekesites') }}"
                    class="group rounded-2xl border border-gray-100 bg-white p-6 shadow-sm transition-shadow hover:shadow-lg">
                    <div class="flex items-center gap-4">
                        <x-module-icon module="ertekesites" size="lg" />
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 group-hover:text-red-600">{{ __('Sales module') }}
                            </h3>
                            <p class="text-gray-600">{{ __('Order and delivery management') }}</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </section>

    {{-- Bottom CTA Section --}}
    <section class="bg-amber-600 py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-4 text-center sm:px-6 lg:px-8">
            <h2 class="text-3xl font-semibold text-white sm:text-4xl">
                {{ __('Start today — risk free') }}
            </h2>
            <p class="mx-auto mt-4 max-w-xl text-lg text-amber-100">
                {{ __('Full functionality, Hungarian-language support. Request a personalized demo.') }}
            </p>
            <div class="mt-8 flex flex-col items-center justify-center gap-4 sm:flex-row">
                <a href="{{ route('register') }}"
                    class="inline-flex items-center justify-center gap-2 rounded-full bg-white px-8 py-4 text-base font-semibold text-amber-600 shadow-lg transition-colors hover:bg-amber-50 hover:shadow-xl">
                    {{ __('Get started') }}
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M14 5l7 7m0 0l-7 7m7-7H3" />
                    </svg>
                </a>
                <a href="{{ route('contact') }}"
                    class="inline-flex items-center justify-center gap-2 rounded-full border-2 border-amber-400 px-8 py-4 text-base font-semibold text-white transition-colors hover:bg-amber-700">
                    {{ __('Request a demo') }}
                </a>
                <a href="{{ route('login') }}"
                    class="inline-flex items-center justify-center gap-2 text-base font-medium text-amber-200 transition-colors hover:text-white">
                    {{ __('Log in to the application') }} →
                </a>
            </div>
        </div>
    </section>
</div>
