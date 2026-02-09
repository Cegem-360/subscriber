<div class="w-full max-w-md">
    <div class="text-center mb-10">
        <h1 class="text-2xl font-semibold text-gray-900">
            Elfelejtett jelszó
        </h1>
        <p class="mt-2 text-sm text-gray-500">
            Add meg az e-mail címed, és küldünk egy jelszó-visszaállító linket.
        </p>
    </div>

    <form wire:submit="request" class="space-y-6">
        {{ $this->form }}

        <div class="pt-2">
            <x-filament::button type="submit" color="primary" class="w-full! justify-center text-base">
                Link küldése
                <x-slot name="iconAfter">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                </x-slot>
            </x-filament::button>
        </div>
    </form>

    <div class="mt-10 text-center">
        <p class="text-sm text-gray-500">
            Emlékszel a jelszavadra?
            <a href="{{ route('filament.admin.auth.login') }}" class="text-indigo-600 hover:text-indigo-700 font-medium" style="color: #4f46e5 !important;">
                Bejelentkezés
            </a>
        </p>
    </div>
</div>
