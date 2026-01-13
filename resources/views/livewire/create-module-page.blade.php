<div>
    <form wire:submit="create" class="bg-white dark:bg-gray-800 p-6 rounded-xl border border-gray-200 dark:border-gray-700">
        {{ $this->form }}
    </form>

    <x-filament-actions::modals />
</div>
