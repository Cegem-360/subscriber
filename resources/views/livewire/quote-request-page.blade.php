<div>
    {{-- Hero Section --}}
    <section class="bg-linear-to-b from-gray-50 to-white py-16 lg:py-20">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h1 class="mb-6 text-3xl font-semibold text-gray-900 sm:text-4xl lg:text-5xl">
                    {{ __('Custom quote request') }}
                </h1>
                <p class="mx-auto mt-4 max-w-3xl text-xl text-gray-600">
                    {{ __('Custom needs, dedicated resources, personalized support.') }}
                    {{ __('Fill out the form below and we\'ll prepare a tailored quote for you.') }}
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
                    <h2 class="mb-2 text-2xl font-semibold text-gray-900">{{ __('Thank you for your inquiry!') }}</h2>
                    <p class="mb-6 text-gray-600">
                        {{ __('Our colleague will contact you shortly at the provided contact details.') }}
                    </p>
                    <a href="{{ route('pricing') }}"
                        class="inline-flex items-center justify-center rounded-lg bg-indigo-600 px-6 py-3 text-base font-medium text-white transition-colors hover:bg-indigo-700">
                        {{ __('Back to pricing') }}
                    </a>
                </div>
            @else
                {{-- Quote Request Form with Filament inputs --}}
                <div class="rounded-2xl border border-gray-200 bg-white p-8 shadow-sm">
                    <form wire:submit="submit">
                        {{ $this->form }}

                        {{-- Submit Button --}}
                        <div class="mt-6">
                            <button type="submit"
                                class="flex w-full items-center justify-center rounded-lg bg-indigo-600 px-6 py-3 text-base font-medium text-white transition-colors hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                                wire:loading.attr="disabled" wire:loading.class="opacity-75 cursor-not-allowed">
                                <span wire:loading.remove>{{ __('Submit quote request') }}</span>
                                <span wire:loading class="flex items-center">
                                    <svg class="mr-2 h-5 w-5 animate-spin text-white" fill="none"
                                        viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10"
                                            stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor"
                                            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                        </path>
                                    </svg>
                                    {{ __('Sending...') }}
                                </span>
                            </button>
                        </div>
                    </form>

                    {{-- Back Link --}}
                    <div class="mt-6 text-center">
                        <a href="{{ route('pricing') }}"
                            class="text-sm font-medium text-indigo-600 hover:text-indigo-500">
                            {{ __('← Back to pricing') }}
                        </a>
                    </div>
                </div>

            @endif
        </div>
    </section>

</div>
