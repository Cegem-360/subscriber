<div class="max-w-4xl mx-auto">
    <form wire:submit="create" class="space-y-6 bg-white dark:bg-gray-800 p-6 rounded-xl shadow-sm">
        {{ $this->form }}
    </form>

    <x-filament-actions::modals />
</div>
