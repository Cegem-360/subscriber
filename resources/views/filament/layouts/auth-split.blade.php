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
            <!-- Logo header -->
            <div class="flex items-center justify-between px-6 py-6 lg:px-12">
                <a href="{{ route('home') }}">
                    <img src="{{ Vite::asset('resources/images/cegem360-logo.png') }}" alt="{{ config('app.name') }}" class="h-10">
                </a>
                <x-language-switcher />
            </div>
            <!-- Main content area - centered -->
            <div class="flex flex-1 flex-col items-center justify-center px-6 pb-6 lg:px-12">
                <div class="w-full max-w-lg">
                    {{ $slot }}
                </div>
            </div>
        </div>

        <!-- Right side - Illustration with floating elements -->
        <div class="hidden bg-indigo-600 lg:flex lg:w-1/2 lg:items-center lg:justify-center relative overflow-hidden">
            <!-- Concentric circles behind the UI panel -->
            <div class="absolute inset-0 flex items-center justify-center">
                <div class="w-[800px] h-[800px] border-2 border-white/20 rounded-full"></div>
            </div>
            <div class="absolute inset-0 flex items-center justify-center">
                <div class="w-[600px] h-[600px] border-2 border-white/25 rounded-full"></div>
            </div>
            <div class="absolute inset-0 flex items-center justify-center">
                <div class="w-[400px] h-[400px] border-2 border-white/20 rounded-full"></div>
            </div>

            <div class="relative w-full max-w-2xl px-12">
                <!-- Dashboard mockup card -->
                <div class="bg-white rounded-2xl shadow-2xl border border-gray-200 p-4 relative z-10">
                    <div class="bg-gradient-to-br from-gray-50 to-gray-100 rounded-xl p-6">
                        <!-- Stats grid -->
                        <div class="grid grid-cols-2 gap-3 mb-4">
                            <div class="bg-white rounded-lg p-3 shadow-sm">
                                <div class="text-xs text-gray-500 mb-1">{{ __('Active modules') }}</div>
                                <div class="text-xl font-bold text-gray-900">5</div>
                                <div class="text-xs text-green-600">CRM, HR, Finance...</div>
                            </div>
                            <div class="bg-white rounded-lg p-3 shadow-sm">
                                <div class="text-xs text-gray-500 mb-1">{{ __('Team members') }}</div>
                                <div class="text-xl font-bold text-gray-900">24</div>
                                <div class="text-xs text-green-600">+3 this month</div>
                            </div>
                            <div class="bg-white rounded-lg p-3 shadow-sm">
                                <div class="text-xs text-gray-500 mb-1">{{ __('Storage used') }}</div>
                                <div class="text-xl font-bold text-gray-900">12.4 GB</div>
                                <div class="text-xs text-gray-500">of 50 GB</div>
                            </div>
                            <div class="bg-white rounded-lg p-3 shadow-sm">
                                <div class="text-xs text-gray-500 mb-1">{{ __('Uptime') }}</div>
                                <div class="text-xl font-bold text-gray-900">99.9%</div>
                                <div class="text-xs text-green-600">Last 30 days</div>
                            </div>
                        </div>
                        <!-- Module status -->
                        <div class="bg-white rounded-lg p-3 shadow-sm">
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-xs font-medium text-gray-900">{{ __('Your modules') }}</span>
                                <span class="text-xs text-gray-500">5 active</span>
                            </div>
                            <div class="flex gap-2">
                                <div class="flex-1 bg-indigo-500 rounded h-6 flex items-center justify-center text-xs font-medium text-white">CRM</div>
                                <div class="flex-1 bg-emerald-500 rounded h-6 flex items-center justify-center text-xs font-medium text-white">HR</div>
                                <div class="flex-1 bg-amber-500 rounded h-6 flex items-center justify-center text-xs font-medium text-white">Finance</div>
                                <div class="flex-1 bg-purple-500 rounded h-6 flex items-center justify-center text-xs font-medium text-white">+2</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Floating notification - Module activated -->
                <div class="absolute -left-8 top-1/4 bg-white rounded-lg shadow-lg p-3 border border-gray-100 animate-pulse z-20">
                    <div class="flex items-center gap-2">
                        <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center">
                            <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        </div>
                        <div>
                            <div class="text-sm font-medium text-gray-900">{{ __('Module activated!') }}</div>
                            <div class="text-xs text-gray-500">CRM Pro</div>
                        </div>
                    </div>
                </div>

                <!-- Floating notification - New feature -->
                <div class="absolute -right-4 top-1/2 bg-white rounded-lg shadow-lg p-3 border border-gray-100 z-20">
                    <div class="flex items-center gap-2">
                        <div class="w-8 h-8 bg-indigo-100 rounded-full flex items-center justify-center">
                            <svg class="w-4 h-4 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                        </div>
                        <div>
                            <div class="text-sm font-medium text-gray-900">{{ __('New feature') }}</div>
                            <div class="text-xs text-gray-500">{{ __('AI Assistant available') }}</div>
                        </div>
                    </div>
                </div>

                <!-- Floating notification - Team invite -->
                <div class="absolute left-1/3 -bottom-4 bg-white rounded-lg shadow-lg p-3 border border-gray-100 z-20">
                    <div class="flex items-center gap-2">
                        <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                            <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/></svg>
                        </div>
                        <div>
                            <div class="text-sm font-medium text-gray-900">{{ __('Team invite sent') }}</div>
                            <div class="text-xs text-gray-500">anna@company.hu</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Decorative circles - positioned relative to the outer container -->
            <div class="absolute top-16 right-16 w-24 h-24 border-2 border-white/30 rounded-full"></div>
            <div class="absolute bottom-24 left-12 w-16 h-16 bg-indigo-400/40 rounded-full"></div>
            <div class="absolute top-1/3 right-1/3 w-8 h-8 bg-white/30 rounded-full"></div>
            <div class="absolute bottom-1/3 right-12 w-10 h-10 border-2 border-white/25 rounded-full"></div>
            <div class="absolute top-24 left-16 w-6 h-6 bg-white/35 rounded-full"></div>

            <!-- Decorative wave at bottom -->
            <div class="absolute bottom-8 left-1/2 -translate-x-1/2">
                <svg class="h-8 w-72 text-indigo-300 opacity-70" viewBox="0 0 200 20" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M0 10 Q 20 0, 40 10 T 80 10 T 120 10 T 160 10 T 200 10"/>
                </svg>
            </div>
        </div>
    </div>

    @filamentScripts
    @vite('resources/js/app.js')
</body>

</html>
