@php
    $statePath = $getStatePath();
    $selected = $getState();
@endphp

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
    @foreach($categories as $category)
        <div
            class="relative rounded-xl border-2 p-6 transition-all hover:shadow-md flex flex-col
                {{ $selected == $category->id ? 'border-primary-500 bg-primary-50 dark:bg-primary-900/20' : 'border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800' }}"
        >
            <input
                type="radio"
                name="{{ $statePath }}"
                value="{{ $category->id }}"
                wire:model.live="{{ $statePath }}"
                class="sr-only"
                id="category-{{ $category->id }}"
                {{ $selected == $category->id ? 'checked' : '' }}
            />

            {{-- Selected indicator --}}
            @if($selected == $category->id)
                <div class="absolute top-3 right-3">
                    <svg class="h-6 w-6 text-primary-500" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                </div>
            @endif

            {{-- Category name --}}
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                {{ $category->name }}
            </h3>

            {{-- Description --}}
            @if($category->description)
                <p class="mt-3 text-sm text-gray-600 dark:text-gray-400 grow">
                    {{ $category->description }}
                </p>
            @endif

            {{-- Select button --}}
            <div class="mt-6 grow flex items-end">
                <button
                    type="button"
                    wire:click="$set('{{ $statePath }}', {{ $category->id }})"
                    x-on:click="setTimeout(() => { const btns = document.querySelectorAll('.fi-ac-btn-action'); btns[btns.length - 1]?.click(); }, 150)"
                    class="w-full py-2.5 px-4 rounded-lg font-semibold text-sm transition-all
                        {{ $selected == $category->id
                            ? 'bg-primary-600 text-white hover:bg-primary-500'
                            : 'bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-white hover:bg-gray-200 dark:hover:bg-gray-600 border border-gray-300 dark:border-gray-600' }}"
                >
                    {{ $selected == $category->id ? __('Kiválasztva') : __('Kiválasztás') }}
                </button>
            </div>
        </div>
    @endforeach
</div>
