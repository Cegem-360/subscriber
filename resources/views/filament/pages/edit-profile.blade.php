<x-filament-panels::page>

    <form wire:submit="save" class="max-w-3xl mx-auto space-y-6 bg-white dark:bg-gray-800 p-6 rounded-xl shadow-sm">
        {{ $this->form }}

        <div class="flex justify-end mt-6">
            <x-filament::button type="submit">
                {{ __('Save') }}
            </x-filament::button>
        </div>
    </form>

    <x-filament-actions::modals />
</x-filament-panels::page>
