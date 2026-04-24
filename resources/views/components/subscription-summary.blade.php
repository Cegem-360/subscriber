@php
    $team = $team ?? null;
    $unitPrice = $plan?->priceForTeam($team);
    $hasCustom = $plan?->hasCustomPriceForTeam($team) ?? false;
    $seats = $quantity ?? 1;
@endphp

<div class="space-y-4">
    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
        {{ __('Order Summary') }}
    </h3>

    <div class="bg-gray-50 dark:bg-gray-700/50 rounded-lg p-4 space-y-3">
        @if ($plan)
            <div class="flex justify-between">
                <span class="text-gray-600 dark:text-gray-400">{{ __('Package') }}</span>
                <span class="font-medium text-gray-900 dark:text-white">{{ $plan->name }}</span>
            </div>

            <div class="flex justify-between">
                <span class="text-gray-600 dark:text-gray-400">{{ __('Billing Period') }}</span>
                <span class="font-medium text-gray-900 dark:text-white">
                    {{ $billing_period?->getLabel() }}
                </span>
            </div>

            <div class="flex justify-between">
                <span class="text-gray-600 dark:text-gray-400">{{ __('Seats') }}</span>
                <span class="font-medium text-gray-900 dark:text-white">{{ $seats }}</span>
            </div>

            <hr class="border-gray-200 dark:border-gray-600">

            <div class="flex justify-between">
                <span class="text-gray-600 dark:text-gray-400">{{ __('Unit Price') }}</span>
                <span class="font-medium text-gray-900 dark:text-white">
                    {{ Number::currency($unitPrice, 'HUF', 'hu', 0) }}
                    @if ($hasCustom)
                        <span class="ml-1 text-xs text-primary-600 dark:text-primary-400">{{ __('(egyedi)') }}</span>
                    @endif
                </span>
            </div>

            <div class="flex justify-between text-lg">
                <span class="font-semibold text-gray-900 dark:text-white">{{ __('Total') }}</span>
                <span class="font-bold text-primary-600 dark:text-primary-400">
                    {{ Number::currency($unitPrice * $seats, 'HUF', 'hu', 0) }}
                </span>
            </div>
        @else
            <p class="text-gray-500 dark:text-gray-400">{{ __('No plan selected') }}</p>
        @endif
    </div>
</div>
