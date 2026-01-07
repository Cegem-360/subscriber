<div class="space-y-4">
    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
        {{ __('Update Summary') }}
    </h3>

    <div class="bg-gray-50 dark:bg-gray-700/50 rounded-lg p-4 space-y-3">
        @if ($newPlan)
            {{-- Current Plan --}}
            <div class="pb-3 border-b border-gray-200 dark:border-gray-600">
                <span class="text-sm font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wide">{{ __('Current') }}</span>
                <div class="mt-1 flex justify-between">
                    <span class="text-gray-600 dark:text-gray-400">{{ $currentPlan?->name ?? '-' }}</span>
                    <span class="font-medium text-gray-900 dark:text-white">
                        {{ $currentQuantity }} {{ __('seats') }} ×
                        {{ Number::currency($currentPlan?->price ?? 0, 'HUF', 'hu', 0) }}
                    </span>
                </div>
            </div>

            {{-- New Plan --}}
            <div class="pb-3 border-b border-gray-200 dark:border-gray-600">
                <span class="text-sm font-medium text-primary-500 dark:text-primary-400 uppercase tracking-wide">{{ __('New') }}</span>
                <div class="mt-1 flex justify-between">
                    <span class="text-gray-600 dark:text-gray-400">{{ $newPlan->name }}</span>
                    <span class="font-medium text-gray-900 dark:text-white">
                        {{ $newQuantity ?? 1 }} {{ __('seats') }} ×
                        {{ Number::currency($newPlan->price, 'HUF', 'hu', 0) }}
                    </span>
                </div>
            </div>

            {{-- Changes --}}
            @php
                $planChanged = $currentPlan?->id !== $newPlan->id;
                $quantityChanged = ($currentQuantity ?? 1) !== (int) ($newQuantity ?? 1);
                $hasChanges = $planChanged || $quantityChanged;

                $currentTotal = ($currentPlan?->price ?? 0) * ($currentQuantity ?? 1);
                $newTotal = $newPlan->price * ($newQuantity ?? 1);
                $difference = $newTotal - $currentTotal;
            @endphp

            @if ($hasChanges)
                <div class="space-y-2">
                    @if ($planChanged)
                        <div class="flex items-center gap-2 text-sm">
                            <x-heroicon-o-arrow-path class="w-4 h-4 text-blue-500" />
                            <span class="text-gray-600 dark:text-gray-400">
                                {{ __('Plan change') }}: {{ $currentPlan?->name }} → {{ $newPlan->name }}
                            </span>
                        </div>
                    @endif

                    @if ($quantityChanged)
                        <div class="flex items-center gap-2 text-sm">
                            <x-heroicon-o-users class="w-4 h-4 text-blue-500" />
                            <span class="text-gray-600 dark:text-gray-400">
                                {{ __('Seats change') }}: {{ $currentQuantity }} → {{ $newQuantity }}
                            </span>
                        </div>
                    @endif
                </div>

                <hr class="border-gray-200 dark:border-gray-600">

                {{-- Price difference --}}
                <div class="flex justify-between">
                    <span class="text-gray-600 dark:text-gray-400">{{ __('Monthly difference') }}</span>
                    <span class="font-medium {{ $difference > 0 ? 'text-red-600 dark:text-red-400' : ($difference < 0 ? 'text-green-600 dark:text-green-400' : 'text-gray-900 dark:text-white') }}">
                        {{ $difference > 0 ? '+' : '' }}{{ Number::currency($difference, 'HUF', 'hu', 0) }}
                    </span>
                </div>

                <div class="flex justify-between text-lg">
                    <span class="font-semibold text-gray-900 dark:text-white">{{ __('New Total') }}</span>
                    <span class="font-bold text-primary-600 dark:text-primary-400">
                        {{ Number::currency($newTotal, 'HUF', 'hu', 0) }}/{{ $billing_period?->getLabel() }}
                    </span>
                </div>

                <p class="text-xs text-gray-500 dark:text-gray-400 mt-2">
                    {{ __('Note: Stripe will automatically calculate the prorated amount based on your current billing period.') }}
                </p>
            @else
                <p class="text-gray-500 dark:text-gray-400 text-center py-2">
                    {{ __('No changes detected') }}
                </p>
            @endif
        @else
            <p class="text-gray-500 dark:text-gray-400">{{ __('No plan selected') }}</p>
        @endif
    </div>
</div>
