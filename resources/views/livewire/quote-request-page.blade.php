<div>
    {{-- Hero Section --}}
    <section class="bg-linear-to-b from-gray-50 to-white py-16 lg:py-20">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h1 class="mb-6 text-3xl font-semibold text-gray-900 sm:text-4xl lg:text-5xl">
                    Enterprise ajánlatkérés
                </h1>
                <p class="mx-auto mt-4 max-w-3xl text-xl text-gray-600">
                    Egyedi igények, dedikált erőforrások, személyre szabott támogatás.
                    Töltse ki az alábbi űrlapot, és készítünk Önnek testre szabott ajánlatot.
                </p>
            </div>
        </div>
    </section>

    {{-- Form Section --}}
    <section class="bg-white py-12 lg:py-16">
        <div class="mx-auto max-w-2xl px-4 sm:px-6 lg:px-8">
            @if ($submitted)
                {{-- Success Message --}}
                <div class="rounded-2xl border border-green-200 bg-green-50 p-8 text-center">
                    <div class="mx-auto mb-4 flex h-16 w-16 items-center justify-center rounded-full bg-green-100">
                        <svg class="h-8 w-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                    <h2 class="mb-2 text-2xl font-semibold text-gray-900">Köszönjük megkeresését!</h2>
                    <p class="mb-6 text-gray-600">
                        Munkatársunk hamarosan felveszi Önnel a kapcsolatot a megadott elérhetőségen.
                    </p>
                    <a href="{{ route('pricing') }}"
                        class="inline-flex items-center justify-center rounded-lg bg-indigo-600 px-6 py-3 text-base font-medium text-white transition-colors hover:bg-indigo-700">
                        Vissza az árakhoz
                    </a>
                </div>
            @else
                {{-- Quote Request Form --}}
                <div class="rounded-2xl border border-gray-200 bg-white p-8 shadow-sm">
                    <form wire:submit="submit" class="space-y-6">
                        {{-- Name Field --}}
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700">
                                Név <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="name" wire:model="name"
                                class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('name') border-red-300 @enderror"
                                placeholder="Az Ön neve">
                            @error('name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Email Field --}}
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700">
                                Email <span class="text-red-500">*</span>
                            </label>
                            <input type="email" id="email" wire:model="email"
                                class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('email') border-red-300 @enderror"
                                placeholder="pelda@email.hu">
                            @error('email')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Message Field --}}
                        <div>
                            <label for="message" class="block text-sm font-medium text-gray-700">
                                Üzenet <span class="text-red-500">*</span>
                            </label>
                            <textarea id="message" wire:model="message" rows="5"
                                class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('message') border-red-300 @enderror"
                                placeholder="Írja le igényeit, kérdéseit..."></textarea>
                            @error('message')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Submit Button --}}
                        <div class="pt-4">
                            <button type="submit"
                                class="flex w-full items-center justify-center rounded-lg bg-indigo-600 px-6 py-3 text-base font-medium text-white transition-colors hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                                wire:loading.attr="disabled" wire:loading.class="opacity-75 cursor-not-allowed">
                                <span wire:loading.remove>Ajánlatkérés elküldése</span>
                                <span wire:loading class="flex items-center">
                                    <svg class="mr-2 h-5 w-5 animate-spin text-white" fill="none"
                                        viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10"
                                            stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor"
                                            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                        </path>
                                    </svg>
                                    Küldés...
                                </span>
                            </button>
                        </div>
                    </form>

                    {{-- Back Link --}}
                    <div class="mt-6 text-center">
                        <a href="{{ route('pricing') }}"
                            class="text-sm font-medium text-indigo-600 hover:text-indigo-500">
                            ← Vissza az árakhoz
                        </a>
                    </div>
                </div>

                {{-- Enterprise Features --}}
                <div class="mt-12">
                    <h3 class="mb-6 text-center text-lg font-semibold text-gray-900">
                        Mit tartalmaz az Enterprise csomag?
                    </h3>
                    <div class="grid gap-4 sm:grid-cols-2">
                        @foreach ([
                            'Dedikált szerver környezet',
                            'Egyedi integrációk (ERP, számlázó, webshop)',
                            'SLA garancia (99,9% uptime)',
                            'Kiemelt támogatás',
                            'On-premise telepítés lehetősége',
                            'Egyedi fejlesztések projekt alapon',
                            'Személyes account manager',
                            'Oktatás és onboarding',
                        ] as $feature)
                            <div class="flex items-center gap-3">
                                <svg class="h-5 w-5 shrink-0 text-green-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                                <span class="text-gray-700">{{ $feature }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </section>
</div>
