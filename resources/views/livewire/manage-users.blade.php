<div class="max-w-6xl mx-auto space-y-6 pt-8">
    {{-- Subscription selector --}}
    <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-sm">
        <h2 class="text-lg font-semibold mb-4">{{ __('Your Subscriptions') }}</h2>

        @if ($subscriptions->isEmpty())
            <p class="text-gray-500">{{ __('No active subscriptions found.') }}</p>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach ($subscriptions as $subscription)
                    <button wire:click="selectSubscription({{ $subscription->id }})"
                        class="p-4 rounded-lg border-2 text-left transition {{ $selectedSubscriptionId === $subscription->id ? 'border-yellow-500 bg-yellow-50 dark:bg-yellow-900/20' : 'border-gray-200 dark:border-gray-700 hover:border-gray-300' }}">
                        <h3 class="font-semibold">{{ $subscription->plan?->name ?? __('Unknown Plan') }}</h3>
                        <p class="text-sm text-gray-500 mt-1">
                            {{ __('Users') }}: {{ $subscription->members->count() }} /
                            {{ max(0, ($subscription->quantity ?? 0) - 1) }}
                        </p>
                        <div class="mt-2">
                            @if ($subscription->availableSeats() > 0)
                                <span class="text-xs px-2 py-1 bg-green-100 text-green-800 rounded">
                                    {{ $subscription->availableSeats() }} {{ __('seats available') }}
                                </span>
                            @else
                                <span class="text-xs px-2 py-1 bg-red-100 text-red-800 rounded">
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
        <form wire:submit="createUser" class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-sm">
            {{ $this->form }}

            <div class="mt-4">
                <x-filament::button type="submit" :disabled="$selectedSubscription->availableSeats() <= 0">
                    {{ __('Create User') }}
                </x-filament::button>
            </div>
        </form>

        {{-- Users table --}}
        <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-sm">
            <h2 class="text-lg font-semibold mb-4">
                {{ __('Users in') }} {{ $selectedSubscription->plan?->name }}
            </h2>
            {{ $this->table }}
        </div>
    @endif

    <x-filament-actions::modals />
</div>
