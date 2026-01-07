<div class="max-w-4xl mx-auto">
    {{-- Header --}}
    <div class="mb-6 flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">{{ __('Subscription Details') }}</h1>
            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                {{ $subscription->plan?->planCategory?->name }} - {{ $subscription->plan?->name }}
            </p>
        </div>
        <div class="flex gap-3">
            <a href="{{ route('subscriptions') }}"
               class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700">
                <x-heroicon-o-arrow-left class="w-4 h-4" />
                {{ __('Back') }}
            </a>
            @if($subscription->isActive())
                <a href="{{ route('subscription.update', $subscription) }}"
                   class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-white bg-primary-600 rounded-lg hover:bg-primary-700">
                    <x-heroicon-o-pencil class="w-4 h-4" />
                    {{ __('Update') }}
                </a>
            @endif
        </div>
    </div>

    <div class="space-y-6">
        {{-- Status Card --}}
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-6">
            <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">{{ __('Status') }}</h2>
            <div class="flex items-center gap-3">
                @if($subscription->isActive())
                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 text-sm font-medium bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400 rounded-full">
                        <span class="w-2 h-2 bg-green-500 rounded-full"></span>
                        {{ __('Active') }}
                    </span>
                @elseif($subscription->ends_at)
                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 text-sm font-medium bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-400 rounded-full">
                        <span class="w-2 h-2 bg-yellow-500 rounded-full"></span>
                        {{ __('Cancelled') }}
                    </span>
                @else
                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 text-sm font-medium bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300 rounded-full">
                        <span class="w-2 h-2 bg-gray-500 rounded-full"></span>
                        {{ $subscription->stripe_status?->getLabel() ?? __('Unknown') }}
                    </span>
                @endif
            </div>
        </div>

        {{-- Plan Details --}}
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-6">
            <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">{{ __('Plan Details') }}</h2>
            <dl class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('Module') }}</dt>
                    <dd class="mt-1 text-gray-900 dark:text-white">{{ $subscription->plan?->planCategory?->name ?? '-' }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('Plan') }}</dt>
                    <dd class="mt-1 text-gray-900 dark:text-white">{{ $subscription->plan?->name ?? '-' }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('Type') }}</dt>
                    <dd class="mt-1 text-gray-900 dark:text-white">{{ $subscription->type?->getLabel() ?? '-' }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('Price') }}</dt>
                    <dd class="mt-1 text-gray-900 dark:text-white">
                        {{ Number::currency($subscription->plan?->price ?? 0, 'HUF', 'hu', 0) }}/{{ $subscription->plan?->billing_period?->getLabel() }}
                    </dd>
                </div>
            </dl>
        </div>

        {{-- Seats & Usage --}}
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-6">
            <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">{{ __('Seats & Usage') }}</h2>
            <dl class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="bg-gray-50 dark:bg-gray-700/50 rounded-lg p-4 text-center">
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('Total Seats') }}</dt>
                    <dd class="mt-1 text-3xl font-bold text-gray-900 dark:text-white">{{ $subscription->quantity ?? 1 }}</dd>
                </div>
                <div class="bg-gray-50 dark:bg-gray-700/50 rounded-lg p-4 text-center">
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('Used') }}</dt>
                    <dd class="mt-1 text-3xl font-bold text-blue-600 dark:text-blue-400">{{ $subscription->members->count() + 1 }}</dd>
                </div>
                <div class="bg-gray-50 dark:bg-gray-700/50 rounded-lg p-4 text-center">
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('Available') }}</dt>
                    <dd class="mt-1 text-3xl font-bold text-green-600 dark:text-green-400">{{ $subscription->availableSeats() }}</dd>
                </div>
            </dl>

            {{-- Members List --}}
            @if($subscription->members->count() > 0)
                <div class="mt-6">
                    <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-3">{{ __('Team Members') }}</h3>
                    <ul class="divide-y divide-gray-200 dark:divide-gray-700">
                        @foreach($subscription->members as $member)
                            <li class="py-3 flex items-center gap-3">
                                <div class="w-8 h-8 bg-gray-200 dark:bg-gray-600 rounded-full flex items-center justify-center">
                                    <span class="text-sm font-medium text-gray-600 dark:text-gray-300">
                                        {{ strtoupper(substr($member->name, 0, 1)) }}
                                    </span>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-900 dark:text-white">{{ $member->name }}</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">{{ $member->email }}</p>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>

        {{-- Billing Details --}}
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-6">
            <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">{{ __('Billing Details') }}</h2>
            <dl class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('Monthly Total') }}</dt>
                    <dd class="mt-1 text-xl font-bold text-gray-900 dark:text-white">
                        {{ Number::currency(($subscription->plan?->price ?? 0) * ($subscription->quantity ?? 1), 'HUF', 'hu', 0) }}
                    </dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('Created at') }}</dt>
                    <dd class="mt-1 text-gray-900 dark:text-white">{{ $subscription->created_at?->format('Y. m. d. H:i') }}</dd>
                </div>
                @if($subscription->trial_ends_at)
                    <div>
                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('Trial Ends at') }}</dt>
                        <dd class="mt-1 text-gray-900 dark:text-white">{{ $subscription->trial_ends_at->format('Y. m. d. H:i') }}</dd>
                    </div>
                @endif
                @if($subscription->ends_at)
                    <div>
                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('Ends at') }}</dt>
                        <dd class="mt-1 text-red-600 dark:text-red-400">{{ $subscription->ends_at->format('Y. m. d. H:i') }}</dd>
                    </div>
                @endif
            </dl>
        </div>

        {{-- Stripe Details (Admin only or debug) --}}
        @if($subscription->stripe_id)
            <div class="bg-gray-50 dark:bg-gray-900 rounded-xl p-6 border border-gray-200 dark:border-gray-700">
                <h2 class="text-sm font-semibold text-gray-500 dark:text-gray-400 mb-3 uppercase tracking-wide">{{ __('Technical Details') }}</h2>
                <dl class="grid grid-cols-1 gap-2 text-sm font-mono">
                    <div class="flex gap-2">
                        <dt class="text-gray-500 dark:text-gray-400">Stripe ID:</dt>
                        <dd class="text-gray-700 dark:text-gray-300">{{ $subscription->stripe_id }}</dd>
                    </div>
                    <div class="flex gap-2">
                        <dt class="text-gray-500 dark:text-gray-400">Stripe Price:</dt>
                        <dd class="text-gray-700 dark:text-gray-300">{{ $subscription->stripe_price ?? '-' }}</dd>
                    </div>
                    <div class="flex gap-2">
                        <dt class="text-gray-500 dark:text-gray-400">Stripe Status:</dt>
                        <dd class="text-gray-700 dark:text-gray-300">{{ $subscription->stripe_status?->value ?? '-' }}</dd>
                    </div>
                </dl>
            </div>
        @endif
    </div>
</div>
