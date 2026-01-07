<div class="max-w-4xl mx-auto">
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">{{ __('Update Subscription') }}</h1>
        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Current plan') }}: <span class="font-semibold">{{ $subscription->plan?->name }}</span>
            ({{ $subscription->quantity ?? 1 }} {{ __('seats') }})
        </p>
    </div>

    <form wire:submit="update" class="space-y-6 bg-white dark:bg-gray-800 p-6 rounded-xl shadow-sm">
        {{ $this->form }}
    </form>

    <x-filament-actions::modals />
</div>
