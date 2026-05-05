<div>
    {{-- Hero Section --}}
    <section class="bg-linear-to-b from-gray-900 to-gray-800 py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto max-w-4xl text-center">
                <div class="mb-6 inline-flex items-center gap-2 rounded-full bg-indigo-500/20 px-4 py-1.5 text-sm font-medium text-indigo-300">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                    {{ __('Contact') }}
                </div>

                <h1 class="mb-6 text-4xl font-bold tracking-tight text-white sm:text-5xl lg:text-6xl">
                    {{ __("Let's talk!") }}
                </h1>

                <p class="mx-auto mb-8 max-w-3xl text-lg text-gray-300 sm:text-xl">
                    {{ __('Have a question? Want a demo? Write to us or call us.') }}
                    {{ __('Our team responds to every inquiry within 24 hours.') }}
                </p>
            </div>
        </div>
    </section>

    {{-- Contact Options --}}
    <section class="bg-white py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="grid gap-8 md:grid-cols-3">
                {{-- Phone --}}
                <div class="rounded-2xl bg-gray-50 p-8 text-center">
                    <div class="mx-auto mb-4 flex h-14 w-14 items-center justify-center rounded-full bg-indigo-100">
                        <svg class="h-7 w-7 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                        </svg>
                    </div>
                    <h3 class="mb-2 text-lg font-semibold text-gray-900">{{ __('By phone') }}</h3>
                    <p class="mb-4 text-sm text-gray-600">{{ __('Mon-Fri: 9:00 AM - 5:00 PM') }}</p>
                    <a href="tel:+36203319550" class="text-lg font-semibold text-indigo-600 hover:underline">+36 20 331 9550</a>
                </div>

                {{-- Email --}}
                <div class="rounded-2xl bg-gray-50 p-8 text-center">
                    <div class="mx-auto mb-4 flex h-14 w-14 items-center justify-center rounded-full bg-indigo-100">
                        <svg class="h-7 w-7 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <h3 class="mb-2 text-lg font-semibold text-gray-900">{{ __('By email') }}</h3>
                    <p class="mb-4 text-sm text-gray-600">{{ __('We respond within 24 hours') }}</p>
                    <a href="mailto:info@cegem360.hu" class="text-lg font-semibold text-indigo-600 hover:underline">info@cegem360.hu</a>
                </div>

                {{-- Address --}}
                <div class="rounded-2xl bg-gray-50 p-8 text-center">
                    <div class="mx-auto mb-4 flex h-14 w-14 items-center justify-center rounded-full bg-indigo-100">
                        <svg class="h-7 w-7 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>
                    <h3 class="mb-2 text-lg font-semibold text-gray-900">{{ __('In person') }}</h3>
                    <p class="mb-4 text-sm text-gray-600">{{ __('By prior appointment') }}</p>
                    <p class="text-gray-700">1051 Budapest,<br>Széchenyi István tér 7-8.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Contact Form Section --}}
    <section class="bg-gray-50 py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="grid gap-12 lg:grid-cols-2">
                {{-- Form --}}
                <div class="rounded-2xl bg-white p-8 shadow-sm">
                    @if ($submitted)
                        <div class="text-center">
                            <div class="mx-auto mb-6 flex h-16 w-16 items-center justify-center rounded-full bg-green-100">
                                <svg class="h-8 w-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                            </div>
                            <h3 class="mb-2 text-2xl font-bold text-gray-900">{{ __('Thank you for your inquiry!') }}</h3>
                            <p class="text-gray-600">{{ __('Our colleague will contact you shortly.') }}</p>
                        </div>
                    @else
                        <h2 class="mb-6 text-2xl font-bold text-gray-900">{{ __('Write to us') }}</h2>

                        <form wire:submit="submit" class="space-y-6">
                            {{-- Inquiry Type --}}
                            <div>
                                <label for="inquiryType" class="mb-2 block text-sm font-medium text-gray-700">{{ __('Inquiry type') }} *</label>
                                <select wire:model="inquiryType" id="inquiryType" class="w-full rounded-lg border border-gray-300 px-4 py-3 focus:border-indigo-500 focus:ring-indigo-500">
                                    <option value="">{{ __('Select...') }}</option>
                                    <option value="demo">{{ __('Demo request') }}</option>
                                    <option value="quote">{{ __('Quote request') }}</option>
                                    <option value="support">{{ __('Technical support') }}</option>
                                    <option value="partnership">{{ __('Partnership') }}</option>
                                    <option value="other">{{ __('Other') }}</option>
                                </select>
                                @error('inquiryType') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                            </div>

                            {{-- Name Fields --}}
                            <div class="grid gap-4 sm:grid-cols-2">
                                <div>
                                    <label for="lastName" class="mb-2 block text-sm font-medium text-gray-700">{{ __('Last name') }} *</label>
                                    <input wire:model="lastName" type="text" id="lastName" class="w-full rounded-lg border border-gray-300 px-4 py-3 focus:border-indigo-500 focus:ring-indigo-500" placeholder="{{ __('Smith') }}">
                                    @error('lastName') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                                </div>
                                <div>
                                    <label for="firstName" class="mb-2 block text-sm font-medium text-gray-700">{{ __('First name') }} *</label>
                                    <input wire:model="firstName" type="text" id="firstName" class="w-full rounded-lg border border-gray-300 px-4 py-3 focus:border-indigo-500 focus:ring-indigo-500" placeholder="{{ __('John') }}">
                                    @error('firstName') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                                </div>
                            </div>

                            {{-- Contact Fields --}}
                            <div class="grid gap-4 sm:grid-cols-2">
                                <div>
                                    <label for="email" class="mb-2 block text-sm font-medium text-gray-700">{{ __('Email address') }} *</label>
                                    <input wire:model="email" type="email" id="email" class="w-full rounded-lg border border-gray-300 px-4 py-3 focus:border-indigo-500 focus:ring-indigo-500" placeholder="kovacs.janos@example.com">
                                    @error('email') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                                </div>
                                <div>
                                    <label for="phone" class="mb-2 block text-sm font-medium text-gray-700">{{ __('Phone number') }}</label>
                                    <input wire:model="phone" type="tel" id="phone" class="w-full rounded-lg border border-gray-300 px-4 py-3 focus:border-indigo-500 focus:ring-indigo-500" placeholder="+36 30 123 4567">
                                    @error('phone') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                                </div>
                            </div>

                            {{-- Company Fields --}}
                            <div class="grid gap-4 sm:grid-cols-2">
                                <div>
                                    <label for="company" class="mb-2 block text-sm font-medium text-gray-700">{{ __('Company name') }}</label>
                                    <input wire:model="company" type="text" id="company" class="w-full rounded-lg border border-gray-300 px-4 py-3 focus:border-indigo-500 focus:ring-indigo-500" placeholder="{{ __('Example Ltd.') }}">
                                    @error('company') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                                </div>
                                <div>
                                    <label for="position" class="mb-2 block text-sm font-medium text-gray-700">{{ __('Position') }}</label>
                                    <input wire:model="position" type="text" id="position" class="w-full rounded-lg border border-gray-300 px-4 py-3 focus:border-indigo-500 focus:ring-indigo-500" placeholder="{{ __('CEO') }}">
                                    @error('position') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                                </div>
                            </div>

                            {{-- Company Size --}}
                            <div>
                                <label for="companySize" class="mb-2 block text-sm font-medium text-gray-700">{{ __('Company size') }}</label>
                                <select wire:model="companySize" id="companySize" class="w-full rounded-lg border border-gray-300 px-4 py-3 focus:border-indigo-500 focus:ring-indigo-500">
                                    <option value="">{{ __('Select...') }}</option>
                                    <option value="1-10">{{ __('1-10 employees') }}</option>
                                    <option value="11-50">{{ __('11-50 employees') }}</option>
                                    <option value="51-200">{{ __('51-200 employees') }}</option>
                                    <option value="201-500">{{ __('201-500 employees') }}</option>
                                    <option value="500+">{{ __('500+ employees') }}</option>
                                </select>
                                @error('companySize') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                            </div>

                            {{-- Interested Modules --}}
                            <div>
                                <label class="mb-2 block text-sm font-medium text-gray-700">{{ __('Which modules interest you?') }}</label>
                                <div class="grid gap-2 sm:grid-cols-2">
                                    <label class="flex items-center gap-2">
                                        <input wire:model="interestedModules" type="checkbox" value="crm" class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                        <span class="text-sm text-gray-700">CRM</span>
                                    </label>
                                    <label class="flex items-center gap-2">
                                        <input wire:model="interestedModules" type="checkbox" value="kontrolling" class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                        <span class="text-sm text-gray-700">{{ __('Controlling') }}</span>
                                    </label>
                                    <label class="flex items-center gap-2">
                                        <input wire:model="interestedModules" type="checkbox" value="beszerzes" class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                        <span class="text-sm text-gray-700">{{ __('Procurement & Logistics') }}</span>
                                    </label>
                                    <label class="flex items-center gap-2">
                                        <input wire:model="interestedModules" type="checkbox" value="ertekesites" class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                        <span class="text-sm text-gray-700">{{ __('Sales') }}</span>
                                    </label>
                                    <label class="flex items-center gap-2">
                                        <input wire:model="interestedModules" type="checkbox" value="gyartas" class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                        <span class="text-sm text-gray-700">{{ __('Manufacturing management') }}</span>
                                    </label>
                                    <label class="flex items-center gap-2">
                                        <input wire:model="interestedModules" type="checkbox" value="automatizalas" class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                        <span class="text-sm text-gray-700">{{ __('Automation') }}</span>
                                    </label>
                                </div>
                                @error('interestedModules') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                            </div>

                            {{-- Message --}}
                            <div>
                                <label for="message" class="mb-2 block text-sm font-medium text-gray-700">{{ __('Message') }} *</label>
                                <textarea wire:model="message" id="message" rows="4" class="w-full rounded-lg border border-gray-300 px-4 py-3 focus:border-indigo-500 focus:ring-indigo-500" placeholder="{{ __('Describe your question or requirement...') }}"></textarea>
                                @error('message') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                            </div>

                            {{-- Privacy & Newsletter --}}
                            <div class="space-y-3">
                                <label class="flex items-start gap-2">
                                    <input wire:model="privacyAccepted" type="checkbox" class="mt-1 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                    <span class="text-sm text-gray-700">{!! __('I have read and accept the <a href="#" class="text-indigo-600 hover:underline">privacy policy</a>.') !!} *</span>
                                </label>
                                @error('privacyAccepted') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror

                                <label class="flex items-start gap-2">
                                    <input wire:model="newsletterSubscribe" type="checkbox" class="mt-1 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                    <span class="text-sm text-gray-700">{{ __('Subscribe to the Cégem360 newsletter') }}</span>
                                </label>
                            </div>

                            {{-- Submit Button --}}
                            <button type="submit" class="w-full rounded-lg bg-indigo-600 px-6 py-4 font-semibold text-white transition hover:bg-indigo-700" wire:loading.attr="disabled" wire:loading.class="opacity-50">
                                <span wire:loading.remove>{{ __('Send message') }}</span>
                                <span wire:loading>{{ __('Sending...') }}</span>
                            </button>
                        </form>
                    @endif
                </div>

                {{-- Info Side --}}
                <div class="space-y-8">
                    {{-- Demo Booking --}}
                    <div class="rounded-2xl bg-indigo-600 p-8">
                        <h3 class="mb-4 text-xl font-bold text-white">{{ __('Book an online demo') }}</h3>
                        <p class="mb-6 text-indigo-100">{{ __('A 30-minute personalized presentation where we answer your questions and demonstrate the system.') }}</p>
                        <a href="{{ route('quote-request') }}" class="inline-flex items-center gap-2 rounded-lg bg-white px-6 py-3 font-semibold text-indigo-600 transition hover:bg-indigo-50">
                            {{ __('Book a demo') }}
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                            </svg>
                        </a>
                    </div>

                    {{-- Sales Team --}}
                    <div class="rounded-2xl bg-white p-8 shadow-sm">
                        <h3 class="mb-6 text-xl font-bold text-gray-900">{{ __('Sales') }}</h3>
                        <div class="flex items-start gap-4">
                            <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-full bg-indigo-100 font-semibold text-indigo-700">
                                <svg class="h-6 w-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                            <div>
                                <div class="font-semibold text-gray-900">Tóth Tamás</div>
                                <div class="mt-2 space-y-1">
                                    <a href="tel:+36203319550" class="flex items-center gap-2 text-sm text-indigo-600 hover:underline">
                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                        </svg>
                                        +36 20 331 9550
                                    </a>
                                    <a href="mailto:tamas@cegem360.hu" class="flex items-center gap-2 text-sm text-indigo-600 hover:underline">
                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                        </svg>
                                        tamas@cegem360.hu
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Partner Program --}}
                    <div class="rounded-2xl bg-gray-100 p-8">
                        <h3 class="mb-4 text-xl font-bold text-gray-900">{{ __('Partner program') }}</h3>
                        <p class="mb-4 text-gray-600">{{ __('We offer partnership opportunities for IT companies, consultants, and system integrators.') }}</p>
                        <a href="{{ route('quote-request') }}" class="font-semibold text-indigo-600 hover:underline">{{ __('Learn more') }} &rarr;</a>
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
                        <span class="font-semibold text-gray-900">{{ __('How quickly do you respond?') }}</span>
                        <svg class="h-5 w-5 text-gray-500 transition-transform" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="open" x-collapse class="px-6 pb-6">
                        <p class="text-gray-600">{{ __('We respond to email inquiries within 24 hours on business days. For urgent matters, call us by phone.') }}</p>
                    </div>
                </div>

                <div x-data="{ open: false }" class="rounded-xl bg-gray-50 shadow-sm">
                    <button @click="open = !open" class="flex w-full items-center justify-between p-6 text-left">
                        <span class="font-semibold text-gray-900">{{ __('How much does the demo cost?') }}</span>
                        <svg class="h-5 w-5 text-gray-500 transition-transform" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="open" x-collapse class="px-6 pb-6">
                        <p class="text-gray-600">{{ __('The demo is completely free and without obligation. In 30 minutes, we demonstrate the system and answer your questions.') }}</p>
                    </div>
                </div>

                <div x-data="{ open: false }" class="rounded-xl bg-gray-50 shadow-sm">
                    <button @click="open = !open" class="flex w-full items-center justify-between p-6 text-left">
                        <span class="font-semibold text-gray-900">{{ __('Is there technical support?') }}</span>
                        <svg class="h-5 w-5 text-gray-500 transition-transform" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="open" x-collapse class="px-6 pb-6">
                        <p class="text-gray-600">{{ __('Yes, we provide email and phone support for all subscribers. Premium packages include a dedicated contact person.') }}</p>
                    </div>
                </div>

                <div x-data="{ open: false }" class="rounded-xl bg-gray-50 shadow-sm">
                    <button @click="open = !open" class="flex w-full items-center justify-between p-6 text-left">
                        <span class="font-semibold text-gray-900">{{ __('Where can I find the knowledge base?') }}</span>
                        <svg class="h-5 w-5 text-gray-500 transition-transform" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="open" x-collapse class="px-6 pb-6">
                        <p class="text-gray-600">{{ __('After logging in, you can find detailed documentation, video tutorials, and FAQ in the Help menu.') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Other Contact Options --}}
    <section class="bg-gray-50 py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
                {{-- Press/Media --}}
                <div class="rounded-2xl bg-white p-8 shadow-sm">
                    <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-lg bg-indigo-100">
                        <svg class="h-6 w-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                        </svg>
                    </div>
                    <h3 class="mb-2 text-lg font-semibold text-gray-900">{{ __('Press and media') }}</h3>
                    <p class="mb-4 text-sm text-gray-600">{{ __('Press inquiries, interviews, and media materials') }}</p>
                    <a href="mailto:sajto@cegem360.hu" class="font-semibold text-indigo-600 hover:underline">sajto@cegem360.hu</a>
                </div>

                {{-- Careers --}}
                <div class="rounded-2xl bg-white p-8 shadow-sm">
                    <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-lg bg-indigo-100">
                        <svg class="h-6 w-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <h3 class="mb-2 text-lg font-semibold text-gray-900">{{ __('Careers') }}</h3>
                    <p class="mb-4 text-sm text-gray-600">{{ __('Join our dynamically growing team') }}</p>
                    <a href="mailto:karrier@cegem360.hu" class="font-semibold text-indigo-600 hover:underline">karrier@cegem360.hu</a>
                </div>

                {{-- Support --}}
                <div class="rounded-2xl bg-white p-8 shadow-sm">
                    <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-lg bg-indigo-100">
                        <svg class="h-6 w-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </div>
                    <h3 class="mb-2 text-lg font-semibold text-gray-900">{{ __('Technical support') }}</h3>
                    <p class="mb-4 text-sm text-gray-600">{{ __('For existing customers') }}</p>
                    <a href="mailto:support@cegem360.hu" class="font-semibold text-indigo-600 hover:underline">support@cegem360.hu</a>
                </div>
            </div>
        </div>
    </section>

    {{-- Social Media --}}
    <section class="bg-white py-16">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h3 class="mb-6 text-lg font-semibold text-gray-900">{{ __('Follow us') }}</h3>
                <div class="flex justify-center gap-6">
                    <a href="#" class="flex h-12 w-12 items-center justify-center rounded-full bg-gray-100 text-gray-600 transition hover:bg-indigo-100 hover:text-indigo-600">
                        <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                        </svg>
                    </a>
                    <a href="#" class="flex h-12 w-12 items-center justify-center rounded-full bg-gray-100 text-gray-600 transition hover:bg-indigo-100 hover:text-indigo-600">
                        <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                        </svg>
                    </a>
                    <a href="#" class="flex h-12 w-12 items-center justify-center rounded-full bg-gray-100 text-gray-600 transition hover:bg-indigo-100 hover:text-indigo-600">
                        <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 0C8.74 0 8.333.015 7.053.072 5.775.132 4.905.333 4.14.63c-.789.306-1.459.717-2.126 1.384S.935 3.35.63 4.14C.333 4.905.131 5.775.072 7.053.012 8.333 0 8.74 0 12s.015 3.667.072 4.947c.06 1.277.261 2.148.558 2.913.306.788.717 1.459 1.384 2.126.667.666 1.336 1.079 2.126 1.384.766.296 1.636.499 2.913.558C8.333 23.988 8.74 24 12 24s3.667-.015 4.947-.072c1.277-.06 2.148-.262 2.913-.558.788-.306 1.459-.718 2.126-1.384.666-.667 1.079-1.335 1.384-2.126.296-.765.499-1.636.558-2.913.06-1.28.072-1.687.072-4.947s-.015-3.667-.072-4.947c-.06-1.277-.262-2.149-.558-2.913-.306-.789-.718-1.459-1.384-2.126C21.319 1.347 20.651.935 19.86.63c-.765-.297-1.636-.499-2.913-.558C15.667.012 15.26 0 12 0zm0 2.16c3.203 0 3.585.016 4.85.071 1.17.055 1.805.249 2.227.415.562.217.96.477 1.382.896.419.42.679.819.896 1.381.164.422.36 1.057.413 2.227.057 1.266.07 1.646.07 4.85s-.015 3.585-.074 4.85c-.061 1.17-.256 1.805-.421 2.227-.224.562-.479.96-.899 1.382-.419.419-.824.679-1.38.896-.42.164-1.065.36-2.235.413-1.274.057-1.649.07-4.859.07-3.211 0-3.586-.015-4.859-.074-1.171-.061-1.816-.256-2.236-.421-.569-.224-.96-.479-1.379-.899-.421-.419-.69-.824-.9-1.38-.165-.42-.359-1.065-.42-2.235-.045-1.26-.061-1.649-.061-4.844 0-3.196.016-3.586.061-4.861.061-1.17.255-1.814.42-2.234.21-.57.479-.96.9-1.381.419-.419.81-.689 1.379-.898.42-.166 1.051-.361 2.221-.421 1.275-.045 1.65-.06 4.859-.06l.045.03zm0 3.678c-3.405 0-6.162 2.76-6.162 6.162 0 3.405 2.76 6.162 6.162 6.162 3.405 0 6.162-2.76 6.162-6.162 0-3.405-2.757-6.162-6.162-6.162zM12 16c-2.21 0-4-1.79-4-4s1.79-4 4-4 4 1.79 4 4-1.79 4-4 4zm7.846-10.405c0 .795-.646 1.44-1.44 1.44-.795 0-1.44-.646-1.44-1.44 0-.794.646-1.439 1.44-1.439.793-.001 1.44.645 1.44 1.439z"/>
                        </svg>
                    </a>
                    <a href="#" class="flex h-12 w-12 items-center justify-center rounded-full bg-gray-100 text-gray-600 transition hover:bg-indigo-100 hover:text-indigo-600">
                        <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{-- Map Section --}}
    <section class="bg-gray-100">
        <div class="h-96 w-full">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2694.4!2d19.0503!3d47.5025!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4741dc403a85f0ab%3A0x6cf0e6e8b0a0a15e!2sSz%C3%A9chenyi%20Istv%C3%A1n%20t%C3%A9r%207-8%2C%20Budapest%2C%201051!5e0!3m2!1sen!2shu!4v1704067200000!5m2!1sen!2shu"
                width="100%"
                height="100%"
                style="border:0;"
                allowfullscreen=""
                loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"
            ></iframe>
        </div>
    </section>
</div>
