@props([
    'module' => null,
    'size' => 'md',
    'showBackground' => true,
    'rounded' => 'xl',
])

@php
    // Module definitions with their icons and colors
    $modules = [
        'kontrolling' => [
            'color' => '#10B981',
            'icon' => 'chart-bar',
        ],
        'beszerzes' => [
            'color' => '#F59E0B',
            'icon' => 'cube',
        ],
        'gyartas' => [
            'color' => '#6366F1',
            'icon' => 'cog',
        ],
        'automatizalas' => [
            'color' => '#8B5CF6',
            'icon' => 'refresh',
        ],
        'ertekesites' => [
            'color' => '#EF4444',
            'icon' => 'currency-dollar',
        ],
        'crm' => [
            'color' => '#0EA5E9',
            'icon' => 'users',
        ],
        'szerviz' => [
            'color' => '#06B6D4',
            'icon' => 'clipboard',
        ],
    ];

    // Get module config or use passed values
    $moduleConfig = $modules[$module] ?? null;
    $color = $attributes->get('color') ?? ($moduleConfig['color'] ?? '#6366F1');
    $icon = $attributes->get('icon') ?? ($moduleConfig['icon'] ?? 'cog');

    // Size classes
    $sizes = [
        'xs' => ['container' => 'h-8 w-8', 'icon' => 'h-4 w-4'],
        'sm' => ['container' => 'h-10 w-10', 'icon' => 'h-5 w-5'],
        'md' => ['container' => 'h-12 w-12', 'icon' => 'h-6 w-6'],
        'lg' => ['container' => 'h-14 w-14', 'icon' => 'h-7 w-7'],
        'xl' => ['container' => 'h-16 w-16', 'icon' => 'h-8 w-8'],
    ];

    $containerSize = $sizes[$size]['container'] ?? $sizes['md']['container'];
    $iconSize = $sizes[$size]['icon'] ?? $sizes['md']['icon'];

    // Rounded options
    $roundedClass = match($rounded) {
        'full' => 'rounded-full',
        'xl' => 'rounded-xl',
        'lg' => 'rounded-lg',
        'md' => 'rounded-md',
        'sm' => 'rounded-sm',
        'none' => '',
        default => 'rounded-xl',
    };
@endphp

@if ($showBackground)
    <div class="inline-flex {{ $containerSize }} items-center justify-center {{ $roundedClass }} shrink-0"
        style="background-color: {{ $color }}15;">
@endif

@switch($icon)
    @case('chart-bar')
        <svg class="{{ $iconSize }}" style="color: {{ $color }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
        </svg>
    @break

    @case('cube')
        <svg class="{{ $iconSize }}" style="color: {{ $color }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
        </svg>
    @break

    @case('cog')
        <svg class="{{ $iconSize }}" style="color: {{ $color }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
        </svg>
    @break

    @case('refresh')
        <svg class="{{ $iconSize }}" style="color: {{ $color }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
        </svg>
    @break

    @case('currency-dollar')
        <svg class="{{ $iconSize }}" style="color: {{ $color }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
    @break

    @case('users')
        <svg class="{{ $iconSize }}" style="color: {{ $color }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
        </svg>
    @break

    @case('clipboard')
        <svg class="{{ $iconSize }}" style="color: {{ $color }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
        </svg>
    @break
@endswitch

@if ($showBackground)
    </div>
@endif
