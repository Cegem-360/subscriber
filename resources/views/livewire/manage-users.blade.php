<div>
    {{-- Page header --}}
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">{{ __('Manage Users') }}</h1>
        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">{{ __('Manage users belonging to your subscriptions') }}</p>
    </div>

    <div class="space-y-6">
        {{-- Subscription selector --}}
        <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6">
            <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">{{ __('Your Subscriptions') }}</h2>

            @if ($subscriptions->isEmpty())
                <p class="text-gray-500 dark:text-gray-400">{{ __('No active subscriptions found.') }}</p>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach ($subscriptions as $subscription)
                        <button wire:click="selectSubscription({{ $subscription->id }})"
                            class="p-4 rounded-xl border-2 text-left transition {{ $selectedSubscriptionId === $subscription->id ? 'border-indigo-500 bg-indigo-50 dark:bg-indigo-900/20' : 'border-gray-200 dark:border-gray-700 hover:border-gray-300 dark:hover:border-gray-600' }}">
                            <h3 class="font-semibold text-gray-900 dark:text-white">{{ $subscription->plan?->name ?? __('Unknown Plan') }}</h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                                {{ __('Users') }}: {{ $subscription->members->count() }} /
                                {{ max(0, ($subscription->quantity ?? 0) - 1) }}
                            </p>
                            <div class="mt-2">
                                @if ($subscription->availableSeats() > 0)
                                    <span class="text-xs px-2 py-1 bg-emerald-100 dark:bg-emerald-900/30 text-emerald-700 dark:text-emerald-400 rounded-full font-medium">
                                        {{ $subscription->availableSeats() }} {{ __('seats available') }}
                                    </span>
                                @else
                                    <span class="text-xs px-2 py-1 bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-400 rounded-full font-medium">
                                        {{ __('Full') }}
                                    </span>
                                @endif
                            </div>
                        </button>
                    @endforeach
                </div>
            @endif
        </div>

        @if ($selectedSubscription)
            {{-- Add user form --}}
            <form wire:submit="createUser" class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6">
                {{ $this->form }}

                <div class="mt-6">
                    <x-filament::button type="submit" :disabled="$selectedSubscription->availableSeats() <= 0">
                        {{ __('Create User') }}
                    </x-filament::button>
                </div>
            </form>

            {{-- Users table --}}
            <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6">
                <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">
                    {{ __('Users in') }} {{ $selectedSubscription->plan?->name }}
                </h2>
                {{ $this->table }}
            </div>
        @endif

        <x-filament-actions::modals />
    </div>
</div>
