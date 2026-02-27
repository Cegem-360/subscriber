<div>
    {{-- Page header --}}
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">{{ __('Subscriptions') }}</h1>
        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">{{ __('Overview of all your subscriptions') }}</p>
    </div>

    <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6">
        {{ $this->table }}
    </div>
</div>
