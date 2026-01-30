<div>
    {{-- Hero Section --}}
    <section class="bg-linear-to-b from-gray-50 to-white py-16 lg:py-20">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h1 class="mb-6 text-3xl font-semibold text-gray-900 sm:text-4xl lg:text-5xl">
                    Válassza ki a vállalatának megfelelő modulokat
                </h1>
                <p class="mx-auto mt-4 max-w-4xl text-xl text-gray-600">
                    Minden modul önállóan is működik, együtt pedig teljeskörű vállalatirányítási rendszert alkotnak.
                    Fizessen csak azért, amit valóban használ.
                </p>
            </div>
        </div>
    </section>

    {{-- Module Cards Section with Toggles --}}
    <section class="bg-white py-12 lg:py-16">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            {{-- Toggles Row - Currency left, Billing right --}}
            <div class="mb-8 flex flex-col items-center justify-between gap-4 sm:flex-row">
                {{-- Currency Toggle (Left) --}}
                <div class="flex items-center gap-3">
                    <span
                        class="text-sm font-medium {{ $currency === 'HUF' ? 'text-gray-900' : 'text-gray-500' }}">HUF</span>
                    <button wire:click="toggleCurrency" type="button"
                        class="relative inline-flex h-6 w-11 shrink-0 cursor-pointer rounded-full border-2 border-transparent bg-gray-200 transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-indigo-600 focus:ring-offset-2"
                        role="switch" aria-checked="{{ $currency === 'EUR' ? 'true' : 'false' }}">
                        <span
                            class="pointer-events-none inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out {{ $currency === 'EUR' ? 'translate-x-5' : 'translate-x-0' }}"></span>
                    </button>
                    <span
                        class="text-sm font-medium {{ $currency === 'EUR' ? 'text-gray-900' : 'text-gray-500' }}">EUR</span>
                </div>

                {{-- Billing Cycle Toggle (Right) --}}
                <div class="flex items-center gap-3">
                    <span
                        class="flex items-center gap-2 text-sm font-medium {{ $isYearly ? 'text-gray-900' : 'text-gray-500' }}">
                        Éves
                        <span
                            class="inline-flex items-center rounded-full bg-green-100 px-2.5 py-0.5 text-xs font-medium text-green-800">
                            -17%
                        </span>
                    </span>
                    <button wire:click="toggleBillingCycle" type="button"
                        class="relative inline-flex h-6 w-11 shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-indigo-600 focus:ring-offset-2 {{ $isYearly ? 'bg-green-500' : 'bg-gray-200' }}"
                        role="switch" aria-checked="{{ !$isYearly ? 'true' : 'false' }}">
                        <span
                            class="pointer-events-none inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out {{ !$isYearly ? 'translate-x-5' : 'translate-x-0' }}"></span>
                    </button>
                    <span class="text-sm font-medium {{ !$isYearly ? 'text-gray-900' : 'text-gray-500' }}">Havi</span>
                </div>
            </div>

            {{-- Carousel Container --}}
            <div class="relative" x-data="{
                scrollContainer: null,
                activeIndex: 0,
                updateActiveIndex() {
                    if (!this.scrollContainer) return;
                    const cardWidth = 320 + 24; // card width + gap
                    this.activeIndex = Math.round(this.scrollContainer.scrollLeft / cardWidth);
                }
            }" x-init="scrollContainer = $refs.carousel">
                {{-- Navigation Arrows --}}
                <button @click="scrollContainer.scrollBy({ left: -340, behavior: 'smooth' })"
                    class="absolute -left-4 top-1/2 z-10 hidden -translate-y-1/2 rounded-full bg-white p-2 shadow-lg ring-1 ring-gray-200 transition-colors hover:bg-gray-50 lg:flex">
                    <svg class="h-5 w-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                </button>
                <button @click="scrollContainer.scrollBy({ left: 340, behavior: 'smooth' })"
                    class="absolute -right-4 top-1/2 z-10 hidden -translate-y-1/2 rounded-full bg-white p-2 shadow-lg ring-1 ring-gray-200 transition-colors hover:bg-gray-50 lg:flex">
                    <svg class="h-5 w-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </button>

                {{-- Scrollable Cards Row --}}
                <div x-ref="carousel" @scroll.debounce.100ms="updateActiveIndex()"
                    class="-mx-4 flex snap-x snap-mandatory gap-6 overflow-x-auto px-4 pb-4 scrollbar-hide lg:mx-0 lg:px-0"
                    style="scroll-padding: 1rem;">
                    @foreach ($this->modules as $module)
                        <div class="w-[320px] shrink-0 snap-start">
                            <div
                                class="flex h-full flex-col rounded-2xl border border-gray-200 bg-white p-6 shadow-sm transition-shadow hover:shadow-md">
                                {{-- Header with larger icon and title --}}
                                <div class="mb-5">
                                    <div class="mb-4">
                                        <x-module-icon :module="$module['id']" size="lg" />
                                    </div>
                                    <h3 class="text-xl font-semibold text-gray-900">{{ $module['name'] }}</h3>
                                    <p class="text-sm text-gray-500">{{ $module['subtitle'] }}</p>
                                </div>

                                {{-- Price --}}
                                <div class="mb-4">
                                    <div class="flex items-baseline">
                                        <span
                                            class="text-3xl font-bold text-gray-900">{{ $this->calculatePrice($module) }}</span>
                                        <span class="ml-2 text-sm text-gray-500">/
                                            {{ $isYearly ? 'év' : 'hó' }} / ügyfél</span>
                                    </div>
                                    @if (!$isYearly)
                                        <p class="mt-1 text-xs text-gray-500">
                                            Éves előfizetéssel:
                                            {{ $this->calculateYearlyPrice($module) }}
                                        </p>
                                    @endif
                                </div>

                                {{-- Description --}}
                                <p class="mb-4 text-sm text-gray-600">{{ $module['description'] }}</p>

                                {{-- Features --}}
                                <ul class="mb-6 flex-1 space-y-2">
                                    @foreach ($module['features'] as $feature)
                                        <li class="flex items-start gap-2 text-sm text-gray-600">
                                            <svg class="mt-0.5 h-4 w-4 shrink-0 text-green-500" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M5 13l4 4L19 7" />
                                            </svg>
                                            {{ $feature }}
                                        </li>
                                    @endforeach
                                </ul>

                                {{-- CTA Button - Indigo with bigger text --}}
                                <a href="{{ route('register') }}"
                                    class="block w-full rounded-lg bg-indigo-600 px-4 py-3 text-center text-base font-medium text-white transition-colors hover:bg-indigo-700">
                                    Kezdés
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- Scroll indicators (dots) for mobile --}}
                <div class="mt-4 flex justify-center gap-2 lg:hidden">
                    @foreach ($this->modules as $index => $module)
                        <button
                            @click="scrollContainer.scrollTo({ left: {{ $index }} * (320 + 24), behavior: 'smooth' })"
                            class="h-2 w-2 rounded-full transition-colors"
                            :class="activeIndex === {{ $index }} ? 'bg-indigo-600' : 'bg-gray-300'"></button>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    {{-- Comparison Table Section --}}
    <section class="bg-gray-50 py-16 lg:py-20">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-semibold text-gray-900">
                    Modulok összehasonlítása
                </h2>
                <p class="mt-3 text-lg text-gray-600">
                    Minden modul tartalmazza az alap funkciókat, plusz az egyedi képességeket
                </p>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full min-w-200 border-collapse">
                    <thead>
                        <tr class="border-b border-gray-200">
                            <th class="py-5 px-4 text-left text-base font-semibold text-gray-900 w-1/4">Funkció</th>
                            @foreach ($this->modules as $module)
                                <th class="py-5 px-3 text-center">
                                    <x-module-icon :module="$module['id']" size="md" />
                                    <p class="mt-2 text-sm font-medium text-gray-700">{{ $module['name'] }}</p>
                                </th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        {{-- Common features --}}
                        <tr class="bg-white">
                            <td class="py-4 px-4 text-base text-gray-700">Korlátlan felhasználó</td>
                            @foreach ($this->modules as $module)
                                <td class="py-4 px-3 text-center">
                                    <svg class="mx-auto h-6 w-6 text-green-500" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7" />
                                    </svg>
                                </td>
                            @endforeach
                        </tr>
                        <tr class="bg-gray-50/50">
                            <td class="py-4 px-4 text-base text-gray-700">Magyar nyelvű felület</td>
                            @foreach ($this->modules as $module)
                                <td class="py-4 px-3 text-center">
                                    <svg class="mx-auto h-6 w-6 text-green-500" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7" />
                                    </svg>
                                </td>
                            @endforeach
                        </tr>
                        <tr class="bg-white">
                            <td class="py-4 px-4 text-base text-gray-700">E-mail értesítések</td>
                            @foreach ($this->modules as $module)
                                <td class="py-4 px-3 text-center">
                                    <svg class="mx-auto h-6 w-6 text-green-500" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7" />
                                    </svg>
                                </td>
                            @endforeach
                        </tr>
                        <tr class="bg-gray-50/50">
                            <td class="py-4 px-4 text-base text-gray-700">API hozzáférés</td>
                            @foreach ($this->modules as $module)
                                <td class="py-4 px-3 text-center">
                                    <svg class="mx-auto h-6 w-6 text-green-500" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7" />
                                    </svg>
                                </td>
                            @endforeach
                        </tr>
                        <tr class="bg-white">
                            <td class="py-4 px-4 text-base text-gray-700">Mobil alkalmazás</td>
                            @foreach ($this->modules as $module)
                                <td class="py-4 px-3 text-center">
                                    <svg class="mx-auto h-6 w-6 text-green-500" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7" />
                                    </svg>
                                </td>
                            @endforeach
                        </tr>

                        {{-- Module-specific features --}}
                        <tr class="bg-gray-50/50">
                            <td class="py-4 px-4 text-base text-gray-700">Digitális munkalapok</td>
                            <td class="py-4 px-3 text-center"><span class="text-gray-300 text-lg">—</span></td>
                            <td class="py-4 px-3 text-center"><span class="text-gray-300 text-lg">—</span></td>
                            <td class="py-4 px-3 text-center"><span class="text-gray-300 text-lg">—</span></td>
                            <td class="py-4 px-3 text-center"><span class="text-gray-300 text-lg">—</span></td>
                            <td class="py-4 px-3 text-center"><span class="text-gray-300 text-lg">—</span></td>
                            <td class="py-4 px-3 text-center"><span class="text-gray-300 text-lg">—</span></td>
                            <td class="py-4 px-3 text-center"><svg class="mx-auto h-6 w-6 text-green-500"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg></td>
                        </tr>
                        <tr class="bg-white">
                            <td class="py-4 px-4 text-base text-gray-700">Helyszíni aláírás</td>
                            <td class="py-4 px-3 text-center"><span class="text-gray-300 text-lg">—</span></td>
                            <td class="py-4 px-3 text-center"><span class="text-gray-300 text-lg">—</span></td>
                            <td class="py-4 px-3 text-center"><span class="text-gray-300 text-lg">—</span></td>
                            <td class="py-4 px-3 text-center"><span class="text-gray-300 text-lg">—</span></td>
                            <td class="py-4 px-3 text-center"><span class="text-gray-300 text-lg">—</span></td>
                            <td class="py-4 px-3 text-center"><span class="text-gray-300 text-lg">—</span></td>
                            <td class="py-4 px-3 text-center"><svg class="mx-auto h-6 w-6 text-green-500"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg></td>
                        </tr>
                        <tr class="bg-gray-50/50">
                            <td class="py-4 px-4 text-base text-gray-700">Offline működés</td>
                            <td class="py-4 px-3 text-center"><span class="text-gray-300 text-lg">—</span></td>
                            <td class="py-4 px-3 text-center"><span class="text-gray-300 text-lg">—</span></td>
                            <td class="py-4 px-3 text-center"><span class="text-gray-300 text-lg">—</span></td>
                            <td class="py-4 px-3 text-center"><span class="text-gray-300 text-lg">—</span></td>
                            <td class="py-4 px-3 text-center"><span class="text-gray-300 text-lg">—</span></td>
                            <td class="py-4 px-3 text-center"><span class="text-gray-300 text-lg">—</span></td>
                            <td class="py-4 px-3 text-center"><svg class="mx-auto h-6 w-6 text-green-500"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg></td>
                        </tr>
                        <tr class="bg-white">
                            <td class="py-4 px-4 text-base text-gray-700">Pénzügyi riportok</td>
                            <td class="py-4 px-3 text-center"><svg class="mx-auto h-6 w-6 text-green-500"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg></td>
                            <td class="py-4 px-3 text-center"><span class="text-gray-300 text-lg">—</span></td>
                            <td class="py-4 px-3 text-center"><span class="text-gray-300 text-lg">—</span></td>
                            <td class="py-4 px-3 text-center"><span class="text-gray-300 text-lg">—</span></td>
                            <td class="py-4 px-3 text-center"><span class="text-gray-300 text-lg">—</span></td>
                            <td class="py-4 px-3 text-center"><span class="text-gray-300 text-lg">—</span></td>
                            <td class="py-4 px-3 text-center"><span class="text-gray-300 text-lg">—</span></td>
                        </tr>
                        <tr class="bg-gray-50/50">
                            <td class="py-4 px-4 text-base text-gray-700">Készletkezelés</td>
                            <td class="py-4 px-3 text-center"><span class="text-gray-300 text-lg">—</span></td>
                            <td class="py-4 px-3 text-center"><svg class="mx-auto h-6 w-6 text-green-500"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg></td>
                            <td class="py-4 px-3 text-center"><svg class="mx-auto h-6 w-6 text-green-500"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg></td>
                            <td class="py-4 px-3 text-center"><span class="text-gray-300 text-lg">—</span></td>
                            <td class="py-4 px-3 text-center"><span class="text-gray-300 text-lg">—</span></td>
                            <td class="py-4 px-3 text-center"><span class="text-gray-300 text-lg">—</span></td>
                            <td class="py-4 px-3 text-center"><span class="text-gray-300 text-lg">—</span></td>
                        </tr>
                        <tr class="bg-white">
                            <td class="py-4 px-4 text-base text-gray-700">Gyártási ütemezés</td>
                            <td class="py-4 px-3 text-center"><span class="text-gray-300 text-lg">—</span></td>
                            <td class="py-4 px-3 text-center"><span class="text-gray-300 text-lg">—</span></td>
                            <td class="py-4 px-3 text-center"><svg class="mx-auto h-6 w-6 text-green-500"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg></td>
                            <td class="py-4 px-3 text-center"><span class="text-gray-300 text-lg">—</span></td>
                            <td class="py-4 px-3 text-center"><span class="text-gray-300 text-lg">—</span></td>
                            <td class="py-4 px-3 text-center"><span class="text-gray-300 text-lg">—</span></td>
                            <td class="py-4 px-3 text-center"><span class="text-gray-300 text-lg">—</span></td>
                        </tr>
                        <tr class="bg-gray-50/50">
                            <td class="py-4 px-4 text-base text-gray-700">Workflow automatizálás</td>
                            <td class="py-4 px-3 text-center"><span class="text-gray-300 text-lg">—</span></td>
                            <td class="py-4 px-3 text-center"><span class="text-gray-300 text-lg">—</span></td>
                            <td class="py-4 px-3 text-center"><span class="text-gray-300 text-lg">—</span></td>
                            <td class="py-4 px-3 text-center"><svg class="mx-auto h-6 w-6 text-green-500"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg></td>
                            <td class="py-4 px-3 text-center"><span class="text-gray-300 text-lg">—</span></td>
                            <td class="py-4 px-3 text-center"><span class="text-gray-300 text-lg">—</span></td>
                            <td class="py-4 px-3 text-center"><span class="text-gray-300 text-lg">—</span></td>
                        </tr>
                        <tr class="bg-white">
                            <td class="py-4 px-4 text-base text-gray-700">Ajánlatkészítés</td>
                            <td class="py-4 px-3 text-center"><span class="text-gray-300 text-lg">—</span></td>
                            <td class="py-4 px-3 text-center"><span class="text-gray-300 text-lg">—</span></td>
                            <td class="py-4 px-3 text-center"><span class="text-gray-300 text-lg">—</span></td>
                            <td class="py-4 px-3 text-center"><span class="text-gray-300 text-lg">—</span></td>
                            <td class="py-4 px-3 text-center"><svg class="mx-auto h-6 w-6 text-green-500"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg></td>
                            <td class="py-4 px-3 text-center"><span class="text-gray-300 text-lg">—</span></td>
                            <td class="py-4 px-3 text-center"><span class="text-gray-300 text-lg">—</span></td>
                        </tr>
                        <tr class="bg-gray-50/50">
                            <td class="py-4 px-4 text-base text-gray-700">Ügyfél-adatbázis</td>
                            <td class="py-4 px-3 text-center"><span class="text-gray-300 text-lg">—</span></td>
                            <td class="py-4 px-3 text-center"><span class="text-gray-300 text-lg">—</span></td>
                            <td class="py-4 px-3 text-center"><span class="text-gray-300 text-lg">—</span></td>
                            <td class="py-4 px-3 text-center"><span class="text-gray-300 text-lg">—</span></td>
                            <td class="py-4 px-3 text-center"><svg class="mx-auto h-6 w-6 text-green-500"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg></td>
                            <td class="py-4 px-3 text-center"><svg class="mx-auto h-6 w-6 text-green-500"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg></td>
                            <td class="py-4 px-3 text-center"><svg class="mx-auto h-6 w-6 text-green-500"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg></td>
                        </tr>
                        <tr class="bg-white">
                            <td class="py-4 px-4 text-base text-gray-700">Lead kezelés</td>
                            <td class="py-4 px-3 text-center"><span class="text-gray-300 text-lg">—</span></td>
                            <td class="py-4 px-3 text-center"><span class="text-gray-300 text-lg">—</span></td>
                            <td class="py-4 px-3 text-center"><span class="text-gray-300 text-lg">—</span></td>
                            <td class="py-4 px-3 text-center"><span class="text-gray-300 text-lg">—</span></td>
                            <td class="py-4 px-3 text-center"><span class="text-gray-300 text-lg">—</span></td>
                            <td class="py-4 px-3 text-center"><svg class="mx-auto h-6 w-6 text-green-500"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg></td>
                            <td class="py-4 px-3 text-center"><span class="text-gray-300 text-lg">—</span></td>
                        </tr>

                        {{-- Price row --}}
                        <tr class="border-t-2 border-gray-200 bg-white">
                            <td class="py-5 px-4 text-base font-semibold text-gray-900">Éves ár</td>
                            @foreach ($this->modules as $module)
                                <td class="py-5 px-3 text-center">
                                    <span
                                        class="text-base font-semibold text-gray-900">{{ $this->calculateYearlyPrice($module) }}</span>
                                </td>
                            @endforeach
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    {{-- Trust Section --}}
    <section class="bg-white py-12 lg:py-16">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-4">
                <div class="text-center">
                    <div class="text-4xl font-bold text-indigo-600">100+</div>
                    <div class="mt-2 text-base text-gray-600">elégedett ügyfél</div>
                </div>
                <div class="text-center">
                    <div class="text-4xl font-bold text-indigo-600">99,5%</div>
                    <div class="mt-2 text-base text-gray-600">rendelkezésre állás</div>
                </div>
                <div class="text-center">
                    <div class="text-4xl font-bold text-indigo-600">5 perc</div>
                    <div class="mt-2 text-base text-gray-600">alatt beüzemelhető</div>
                </div>
                <div class="text-center">
                    <div class="text-4xl font-bold text-indigo-600">Magyar</div>
                    <div class="mt-2 text-base text-gray-600">támogatás</div>
                </div>
            </div>

            <div class="mt-12 grid gap-4 sm:grid-cols-3">
                <div class="flex items-center gap-3 rounded-lg border border-gray-200 p-4">
                    <svg class="h-6 w-6 shrink-0 text-green-500" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    <span class="text-base text-gray-700">Bármikor lemondható</span>
                </div>
                <div class="flex items-center gap-3 rounded-lg border border-gray-200 p-4">
                    <svg class="h-6 w-6 shrink-0 text-green-500" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    <span class="text-base text-gray-700">Magyar nyelvű támogatás</span>
                </div>
                <div class="flex items-center gap-3 rounded-lg border border-gray-200 p-4">
                    <svg class="h-6 w-6 shrink-0 text-green-500" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    <span class="text-base text-gray-700">GDPR megfelelőség</span>
                </div>
            </div>
        </div>
    </section>

    {{-- FAQ Section --}}
    <section class="bg-gray-50 py-16 lg:py-20">
        <div class="mx-auto max-w-3xl px-4 sm:px-6 lg:px-8">
            <h2 class="text-center text-3xl font-semibold text-gray-900">
                Gyakran ismételt kérdések
            </h2>

            <div class="mt-10 space-y-4" x-data="{ openFaq: null }">
                @foreach ($this->faqs as $index => $faq)
                    <div class="rounded-lg border border-gray-200 bg-white">
                        <button type="button" class="flex w-full items-center justify-between px-6 py-5 text-left"
                            @click="openFaq = openFaq === {{ $index }} ? null : {{ $index }}">
                            <span class="text-base font-medium text-gray-900">{{ $faq['question'] }}</span>
                            <svg class="h-5 w-5 shrink-0 text-gray-500 transition-transform ml-4"
                                :class="{ 'rotate-180': openFaq === {{ $index }} }" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <div x-show="openFaq === {{ $index }}" x-collapse class="border-t border-gray-100">
                            <p class="px-6 py-5 text-base text-gray-600 leading-relaxed">{{ $faq['answer'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Bottom CTA Section --}}
    <section class="bg-indigo-600 py-16 lg:py-20">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl font-semibold text-white">
                Készen áll a hatékonyabb működésre?
            </h2>
            <p class="mx-auto mt-4 max-w-xl text-lg text-indigo-100">
                Próbálja ki bármelyik modult még ma. Nincs elkötelezettség, nem szükséges bankkártya.
            </p>
            <div class="mt-8 flex flex-col items-center justify-center gap-4 sm:flex-row">
                <a href="{{ route('register') }}"
                    class="inline-flex items-center justify-center rounded-lg bg-white px-6 py-3 text-base font-medium text-indigo-600 transition-colors hover:bg-indigo-50">
                    Kezdés
                    <svg class="ml-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M14 5l7 7m0 0l-7 7m7-7H3" />
                    </svg>
                </a>
                <a href="{{ route('contact') }}"
                    class="inline-flex items-center justify-center rounded-lg border border-indigo-400 px-6 py-3 text-base font-medium text-white transition-colors hover:bg-indigo-700">
                    Demo kérése
                </a>
            </div>
        </div>
    </section>
</div>
