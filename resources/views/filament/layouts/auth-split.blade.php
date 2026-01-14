<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="antialiased">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? config('app.name') }}</title>

    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>

    @filamentStyles
    @vite('resources/css/app.css')
</head>

<body class="min-h-screen font-sans antialiased">
    <div class="flex min-h-screen">
        <!-- Left side - Form -->
        <div class="flex w-full flex-col bg-white lg:w-1/2">
            <!-- Main content area - centered -->
            <div class="flex flex-1 flex-col items-center justify-center px-6 py-6 lg:px-12">
                <div class="w-full max-w-lg">
                    {{ $slot }}
                </div>
            </div>
        </div>

        <!-- Right side - Illustration -->
        <div class="hidden bg-indigo-600 lg:flex lg:w-1/2 lg:items-center lg:justify-center">
            <div class="relative w-full max-w-2xl px-12">
                <!-- Decorative illustration -->
                <svg class="h-auto w-full" viewBox="0 0 500 400" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <!-- Large background circle -->
                    <circle cx="250" cy="200" r="160" stroke="rgba(255,255,255,0.15)" stroke-width="2" fill="none"/>

                    <!-- Dashboard mockup -->
                    <rect x="120" y="100" width="260" height="180" rx="12" fill="white" filter="drop-shadow(0 25px 50px rgba(0,0,0,0.15))"/>

                    <!-- Dashboard header -->
                    <rect x="120" y="100" width="260" height="36" rx="12" fill="#f9fafb"/>
                    <rect x="120" y="124" width="260" height="12" fill="#f9fafb"/>
                    <circle cx="142" cy="118" r="6" fill="#ef4444"/>
                    <circle cx="160" cy="118" r="6" fill="#fbbf24"/>
                    <circle cx="178" cy="118" r="6" fill="#22c55e"/>

                    <!-- Dashboard content rows -->
                    <rect x="140" y="155" width="100" height="10" rx="3" fill="#e5e7eb"/>
                    <rect x="260" y="155" width="40" height="10" rx="3" fill="#22c55e"/>
                    <rect x="310" y="155" width="50" height="10" rx="3" fill="#22c55e"/>

                    <rect x="140" y="180" width="85" height="10" rx="3" fill="#e5e7eb"/>
                    <rect x="260" y="180" width="40" height="10" rx="3" fill="#fbbf24"/>
                    <rect x="310" y="180" width="50" height="10" rx="3" fill="#fbbf24"/>

                    <rect x="140" y="205" width="110" height="10" rx="3" fill="#e5e7eb"/>
                    <rect x="260" y="205" width="40" height="10" rx="3" fill="#ef4444"/>
                    <rect x="310" y="205" width="50" height="10" rx="3" fill="#ef4444"/>

                    <rect x="140" y="230" width="75" height="10" rx="3" fill="#e5e7eb"/>
                    <rect x="260" y="230" width="40" height="10" rx="3" fill="#3b82f6"/>
                    <rect x="310" y="230" width="50" height="10" rx="3" fill="#3b82f6"/>

                    <rect x="140" y="255" width="95" height="10" rx="3" fill="#e5e7eb"/>
                    <rect x="260" y="255" width="40" height="10" rx="3" fill="#22c55e"/>
                    <rect x="310" y="255" width="50" height="10" rx="3" fill="#22c55e"/>

                    <!-- Hand pointing from right -->
                    <g transform="translate(340, 160)">
                        <!-- Palm -->
                        <ellipse cx="45" cy="35" rx="30" ry="40" fill="#c2410c"/>
                        <!-- Finger pointing -->
                        <rect x="0" y="20" width="35" height="18" rx="9" fill="#c2410c"/>
                        <!-- Wrist/sleeve -->
                        <rect x="55" y="10" width="25" height="60" rx="5" fill="#fbbf24"/>
                    </g>

                    <!-- Hand from bottom left -->
                    <g transform="translate(80, 260)">
                        <!-- Palm -->
                        <ellipse cx="30" cy="50" rx="28" ry="38" fill="#7c2d12"/>
                        <!-- Thumb up -->
                        <ellipse cx="5" cy="30" rx="12" ry="20" fill="#7c2d12"/>
                        <!-- Wrist/sleeve -->
                        <rect x="10" y="75" width="45" height="30" rx="5" fill="#fbbf24"/>
                    </g>

                    <!-- Decorative elements -->
                    <circle cx="100" cy="320" r="8" fill="#fbbf24"/>
                    <circle cx="420" cy="90" r="10" stroke="rgba(255,255,255,0.3)" stroke-width="2" fill="none"/>
                    <rect x="380" y="340" width="70" height="10" rx="5" fill="#22c55e"/>

                    <!-- Small floating element top left -->
                    <circle cx="150" cy="60" r="15" fill="#fbbf24" opacity="0.8"/>
                </svg>

                <!-- Decorative squiggle at bottom -->
                <div class="absolute -bottom-4 left-1/2 -translate-x-1/2">
                    <svg class="h-6 w-56 text-indigo-400 opacity-60" viewBox="0 0 200 20" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M0 10 Q 20 0, 40 10 T 80 10 T 120 10 T 160 10 T 200 10"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    @filamentScripts
    @vite('resources/js/app.js')
</body>

</html>
