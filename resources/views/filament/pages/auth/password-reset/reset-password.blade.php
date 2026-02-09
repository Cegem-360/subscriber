<div class="w-full max-w-md">
    <div class="text-center mb-10">
        <h1 class="text-2xl font-semibold text-gray-900">
            Jelszó visszaállítása
        </h1>
        <p class="mt-2 text-sm text-gray-500">
            Add meg az új jelszavadat.
        </p>
    </div>

    <form wire:submit="resetPassword" class="space-y-6">
        {{ $this->form }}

        <div class="pt-2">
            <x-filament::button type="submit" color="primary" class="w-full! justify-center text-base">
                Jelszó visszaállítása
                <x-slot name="iconAfter">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                    </svg>
                </x-slot>
            </x-filament::button>
        </div>
    </form>
</div>
