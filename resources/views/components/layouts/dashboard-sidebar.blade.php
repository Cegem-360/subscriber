{{-- Monday.com style sidebar - 240px width --}}
<aside
    class="fixed inset-y-0 left-0 z-50 w-60 bg-[#292F4C] text-white flex flex-col transform transition-transform duration-300 ease-in-out lg:translate-x-0"
    :class="{ '-translate-x-full': !mobileMenuOpen, 'translate-x-0': mobileMenuOpen }"
    x-show="sidebarOpen || mobileMenuOpen"
    x-cloak
>
    {{-- Logo area --}}
    <div class="h-16 flex items-center px-4 border-b border-white/10">
        <a href="{{ route('modules') }}" class="flex items-center gap-2">
            <img src="{{ Vite::asset('resources/images/cegem360-logo.png') }}" alt="cégem360.eu" class="h-8 brightness-0 invert">
        </a>
    </div>

    {{-- Navigation --}}
    <nav class="flex-1 overflow-y-auto py-4 px-3 space-y-6">
        {{-- Main navigation --}}
        <div>
            <h3 class="px-3 text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Navigáció</h3>
            <ul class="space-y-1">
                <li>
                    <a href="{{ route('modules') }}"
                        class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium transition
                            {{ request()->routeIs('modules') ? 'bg-white/10 text-white' : 'text-gray-300 hover:bg-white/5 hover:text-white' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                        </svg>
                        Kezdőlap
                    </a>
                </li>
                <li>
                    <a href="{{ route('subscriptions') }}"
                        class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium transition
                            {{ request()->routeIs('subscriptions') ? 'bg-white/10 text-white' : 'text-gray-300 hover:bg-white/5 hover:text-white' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                        </svg>
                        Áttekintés
                    </a>
                </li>
            </ul>
        </div>

        {{-- Modules section --}}
        <div>
            <h3 class="px-3 text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Moduljaim</h3>
            <ul class="space-y-1">
                @auth
                    @php
                        $userSubscriptions = auth()->user()->subscriptions()->activeSubscription()->with('plan.planCategory')->get();
                    @endphp
                    @forelse ($userSubscriptions as $subscription)
                        @if ($subscription->plan?->planCategory?->url)
                            <li>
                                <a href="{{ $subscription->plan->planCategory->url }}" target="_blank"
                                    class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium text-gray-300 hover:bg-white/5 hover:text-white transition group">
                                    <span class="w-2 h-2 rounded-full bg-emerald-400"></span>
                                    {{ $subscription->plan->planCategory->name }}
                                    <svg class="w-4 h-4 ml-auto opacity-0 group-hover:opacity-100 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                                    </svg>
                                </a>
                            </li>
                        @endif
                    @empty
                        <li class="px-3 py-2 text-sm text-gray-400">
                            Nincs aktív modul
                        </li>
                    @endforelse
                @endauth
            </ul>
        </div>

        {{-- Admin section --}}
        @auth
            @if(auth()->user()->isAdmin() || auth()->user()->isManager())
                <div>
                    <h3 class="px-3 text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Adminisztráció</h3>
                    <ul class="space-y-1">
                        <li>
                            <a href="{{ route('manage.users') }}"
                                class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium transition
                                    {{ request()->routeIs('manage.users') ? 'bg-white/10 text-white' : 'text-gray-300 hover:bg-white/5 hover:text-white' }}">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                                </svg>
                                Felhasználók kezelése
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('module.order') }}"
                                class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium transition
                                    {{ request()->routeIs('module.order') ? 'bg-white/10 text-white' : 'text-gray-300 hover:bg-white/5 hover:text-white' }}">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                </svg>
                                Új modul rendelés
                            </a>
                        </li>
                    </ul>
                </div>
            @endif
        @endauth
    </nav>

    {{-- User section at bottom --}}
    @auth
        <div class="border-t border-white/10 p-4">
            <a href="{{ route('filament.admin.auth.profile') }}"
                class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium text-gray-300 hover:bg-white/5 hover:text-white transition">
                <div class="w-8 h-8 rounded-full bg-linear-to-br from-indigo-500 to-purple-600 flex items-center justify-center text-white font-semibold text-sm">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>
                <div class="flex-1 min-w-0">
                    <p class="truncate font-medium">{{ auth()->user()->name }}</p>
                    <p class="truncate text-xs text-gray-400">{{ auth()->user()->email }}</p>
                </div>
            </a>
        </div>
    @endauth
</aside>
