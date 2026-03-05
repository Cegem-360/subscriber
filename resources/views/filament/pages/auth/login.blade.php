<div class="w-full max-w-md">
    <div class="text-center mb-10">
        <h1 class="text-2xl font-semibold text-gray-900">
            Jelentkezz be a fiókodba
        </h1>
    </div>

    <form wire:submit="authenticate" class="space-y-6">
        {{ $this->form }}

        <div class="pt-2">
            <x-filament::button type="submit" color="primary" class="w-full! justify-center text-base">
                Bejelentkezés
                <x-slot name="iconAfter">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M14 5l7 7m0 0l-7 7m7-7H3" />
                    </svg>
                </x-slot>
            </x-filament::button>
        </div>
    </form>

    <div class="mt-10 text-center space-y-3">
        <p class="text-sm text-gray-500">
            Nincs még fiókod?
            <a wire:navigate href="{{ route('filament.admin.auth.register') }}"
                class="text-indigo-600 hover:text-indigo-700 font-medium" style="color: #4f46e5 !important;">
                Regisztrálj
            </a>
        </p>
        @if (filament()->hasPasswordReset())
            <p class="text-sm text-gray-400">
                <a wire:navigate href="{{ filament()->getRequestPasswordResetUrl() }}" class="hover:text-gray-600"
                    style="color: #9ca3af !important;">
                    Elfelejtetted a jelszavad?
                </a>
            </p>
        @endif
    </div>
</div>
