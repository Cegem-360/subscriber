<x-filament-panels::page>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
        @foreach ($plans as $plan)
            <div
                class="flex flex-col rounded-lg border border-gray-200 bg-white shadow-sm dark:border-gray-700 dark:bg-gray-800">
                <div class="flex flex-col gap-4 p-6">
                    <div>
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                            {{ $plan->name }}
                        </h3>
                        @if ($plan->description)
                            <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                                {{ $plan->description }}
                            </p>
                        @endif
                    </div>

                    <div class="flex items-baseline gap-1">
                        <span class="text-4xl font-bold text-gray-900 dark:text-white">
                            {{ number_format($plan->price, 0, ',', ' ') }}
                        </span>
                        <span class="text-lg text-gray-600 dark:text-gray-400">
                            Ft
                        </span>
                        <span class="text-sm text-gray-600 dark:text-gray-400">
                            / {{ $plan->billing_period->getLabel() }}
                        </span>
                    </div>

                    @if ($plan->features && count($plan->features) > 0)
                        <ul class="flex flex-col gap-2">
                            @foreach ($plan->features as $feature)
                                <li class="flex items-start gap-2">
                                    <svg class="size-5 shrink-0 text-green-600 dark:text-green-500" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7" />
                                    </svg>
                                    <span class="text-sm text-gray-700 dark:text-gray-300">
                                        {{ $feature }}
                                    </span>
                                </li>
                            @endforeach
                        </ul>
                    @endif

                    @if ($plan->microservices && count($plan->microservices) > 0)
                        <div>
                            <p class="mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                                Elérhető szolgáltatások:
                            </p>
                            <ul class="flex flex-col gap-1">
                                @foreach ($plan->microservices as $microservice)
                                    <li class="flex items-start gap-2">
                                        <svg class="size-4 shrink-0 text-blue-600 dark:text-blue-500" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        <span class="text-sm text-gray-600 dark:text-gray-400">
                                            {{ ucwords(str_replace('-', ' ', $microservice)) }}
                                        </span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>

                <div class="mt-auto border-t border-gray-200 p-6 dark:border-gray-700">
                    @if ($this->hasActivePlan($plan))
                        <x-filament::button color="success" disabled class="w-full">
                            <svg class="mr-2 size-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            Aktív előfizetés
                        </x-filament::button>
                    @else
                        <form action="{{ route('subscription.checkout', $plan) }}" method="POST">
                            @csrf
                            <x-filament::button type="submit" color="primary" class="w-full">
                                Előfizetés
                            </x-filament::button>
                        </form>
                    @endif
                </div>
            </div>
        @endforeach
    </div>

    @if ($plans->isEmpty())
        <div class="rounded-lg border border-gray-200 bg-white p-12 text-center dark:border-gray-700 dark:bg-gray-800">
            <svg class="mx-auto size-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
            </svg>
            <h3 class="mt-4 text-lg font-medium text-gray-900 dark:text-white">
                Nincsenek elérhető csomagok
            </h3>
            <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                Jelenleg nincsenek elérhető előfizetési csomagok.
            </p>
        </div>
    @endif
</x-filament-panels::page>
