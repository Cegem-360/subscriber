@php
    $statePath = $getStatePath();
    $selected = $getState();
    $currentPlanId = $currentPlanId ?? null;
@endphp

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
    @foreach ($plans as $plan)
        <div @class([
            'relative rounded-xl border-2 p-6 transition-all hover:shadow-md flex flex-col',
            'border-primary-500 bg-primary-50 dark:bg-primary-900/20' =>
                $selected == $plan->id,
            'border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800' =>
                $selected != $plan->id,
        ])>
            <input type="radio" name="{{ $statePath }}" value="{{ $plan->id }}"
                wire:model.live="{{ $statePath }}" class="sr-only" id="plan-{{ $plan->id }}"
                {{ $selected == $plan->id ? 'checked' : '' }} />

            {{-- Current plan badge --}}
            @if ($currentPlanId && $currentPlanId == $plan->id)
                <div class="absolute top-3 left-3">
                    <span class="inline-flex items-center px-2 py-1 text-xs font-medium rounded-full bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200">
                        {{ __('Current') }}
                    </span>
                </div>
            @endif

            {{-- Selected indicator --}}
            @if ($selected == $plan->id)
                <div class="absolute top-3 right-3">
                    <svg class="h-6 w-6 text-primary-500" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
            @endif

            {{-- Plan name --}}
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                {{ $plan->name }}
            </h3>

            {{-- Price --}}
            <div class="mt-4">
                <span class="text-3xl font-bold text-gray-900 dark:text-white">
                    {{ Number::currency($plan->price, 'HUF', 'hu', 0) }}
                </span>
                <span class="text-sm text-gray-500 dark:text-gray-400">
                    /{{ $plan->billing_period?->getLabel() }}
                </span>
            </div>

            {{-- Description --}}
            @if ($plan->description)
                <p class="mt-3 text-sm text-gray-600 dark:text-gray-400">
                    {{ $plan->description }}
                </p>
            @endif

            {{-- Features --}}
            @if ($plan->features && count($plan->features) > 0)
                <ul class="mt-4 space-y-2">
                    @foreach ($plan->features as $feature)
                        <li class="flex items-center gap-2 text-sm text-gray-600 dark:text-gray-400">
                            <svg class="h-4 w-4 text-primary-500 shrink-0" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            {{ $feature }}
                        </li>
                    @endforeach
                </ul>
            @endif

            {{-- Select button --}}
            <div class="mt-6 grow flex items-end">
                <button type="button" wire:click="$set('{{ $statePath }}', {{ $plan->id }})"
                    x-on:click="setTimeout(() => { const btns = document.querySelectorAll('.fi-ac-btn-action'); btns[btns.length - 1]?.click(); }, 150)"
                    @class([
                        'w-full py-2.5 px-4 rounded-lg font-semibold text-sm transition-all',
                        'bg-primary-600 text-white hover:bg-primary-500' => $selected == $plan->id,
                        'bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-white hover:bg-gray-200 dark:hover:bg-gray-600 border border-gray-300 dark:border-gray-600' =>
                            $selected != $plan->id,
                    ])>
                    @if ($selected == $plan->id)
                        {{ __('Selected') }}
                    @else
                        {{ __('Select') }}
                    @endif

                </button>
            </div>
        </div>
    @endforeach
</div>
