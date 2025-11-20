<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    @if ($this->subscriptions->isEmpty())
        <div class="text-center py-12">
            <p class="text-gray-500 dark:text-gray-400">{{ __('No active subscriptions') }}</p>
            <a href="{{ route('module.order') }}"
                class="mt-4 inline-flex items-center px-4 py-2 bg-primary-600 rounded-lg text-white font-semibold text-sm hover:bg-primary-500 transition">
                {{ __('Order') }}
            </a>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($this->subscriptions as $subscription)
                <div
                    class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6 shadow-sm hover:shadow-md transition-shadow flex flex-col">
                    {{-- Plan name --}}
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                        {{ $subscription->plan->name }}
                    </h3>

                    {{-- Category --}}
                    <p class="text-sm text-primary-600 dark:text-primary-400 mt-1">
                        {{ $subscription->plan->planCategory->name }}
                    </p>

                    {{-- Description --}}
                    @if ($subscription->plan->description)
                        <p class="mt-3 text-sm text-gray-600 dark:text-gray-400 grow">
                            {{ $subscription->plan->description }}
                        </p>
                    @else
                        <div class="grow"></div>
                    @endif

                    {{-- Subscription details --}}
                    <div class="mt-4 pt-4 border-t border-gray-200 dark:border-gray-700 space-y-2 text-sm">
                        <div class="flex justify-between">
                            <span class="text-gray-500 dark:text-gray-400">{{ __('Seats') }}</span>
                            <span class="font-medium text-gray-900 dark:text-white">{{ $subscription->quantity }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-500 dark:text-gray-400">{{ __('Billing') }}</span>
                            <span
                                class="font-medium text-gray-900 dark:text-white">{{ $subscription->type->getLabel() }}</span>
                        </div>
                    </div>

                    {{-- Action button --}}
                    @if ($subscription->plan->planCategory->url)
                        <div class="mt-6">
                            <a href="{{ $subscription->plan->planCategory->url }}" target="_blank"
                                class="w-full inline-flex items-center justify-center px-4 py-2.5 bg-primary-600 text-white rounded-lg font-semibold text-sm hover:bg-primary-500 transition">
                                {{ __('Open') }}
                                <svg class="ml-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                </svg>
                            </a>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    @endif
</div>
