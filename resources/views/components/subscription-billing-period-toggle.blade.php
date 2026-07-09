@php
    $statePath = $getStatePath();
    $selected = $getState();
@endphp
@use('App\Enums\BillingPeriod')
<div class="flex justify-center">
    <div class="inline-flex rounded-full bg-gray-100 dark:bg-gray-800 p-1">
        @foreach ($types as $type)
            <button type="button" wire:click="selectBillingPeriod('{{ $type->value }}')"
                @class([
                    'px-6 py-2 text-sm font-semibold rounded-full transition-all duration-200',
                    'bg-primary-600 text-white shadow-sm' => $selected === $type->value,
                    'text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white' =>
                        $selected !== $type->value,
                ])>
                {{ $type->getLabel() }}
                @if ($type === BillingPeriod::Yearly)
                    <span @class([
                        'ml-1.5 text-xs px-1.5 py-0.5 rounded-full',
                        'bg-primary-500 text-white' => $selected === $type->value,
                        'bg-green-100 dark:bg-green-900 text-green-700 dark:text-green-300' =>
                            $selected !== $type->value,
                    ])>
                        -17%
                    </span>
                @endif
            </button>
        @endforeach
    </div>
</div>
