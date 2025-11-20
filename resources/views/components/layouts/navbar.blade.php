<nav class="bg-white shadow-sm dark:bg-gray-800">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 items-center justify-between">
            {{-- Logo --}}
            <div class="shrink-0">
                <a href="{{ route('welcome') }}" class="flex items-center">
                    <img src="{{ Vite::asset('resources/images/cegem360-logo.png') }}" alt="cégem360.eu" class="h-10">
                </a>
            </div>
            @auth
                {{-- Navigation Links --}}
                <div class="flex gap-4">
                    <a href="{{ route('modules') }}"
                        class="inline-flex items-center rounded-md bg-green-600 px-4 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 dark:bg-green-500 dark:hover:bg-green-600">
                        Moduljaim
                    </a>
                </div>
            @endauth
            {{-- Navigation Links --}}
            <div class="flex  gap-4">
                <a href="{{ route('module.order') }}"
                    class="inline-flex items-center rounded-md bg-green-600 px-4 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 dark:bg-green-500 dark:hover:bg-green-600">
                    Rendelés
                </a>
            </div>

            @auth

                {{-- Navigation Links --}}
                <div class="flex gap-4">
                    <a href="{{ route('subscriptions') }}"
                        class="inline-flex items-center rounded-md bg-green-600 px-4 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 dark:bg-green-500 dark:hover:bg-green-600">
                        Előfizetések
                    </a>
                </div>
                @if(auth()->user()->isAdmin() || auth()->user()->isManager())
                    <div class="flex gap-4">
                        <a href="{{ route('manage.users') }}"
                            class="inline-flex items-center rounded-md bg-yellow-600 px-4 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2 dark:bg-yellow-500 dark:hover:bg-yellow-600">
                            Felhasználók
                        </a>
                    </div>
                @endif
                {{-- Bejelentkezés gomb --}}
                <div>
                    <a href="{{ route('filament.admin.auth.profile') }}"
                        class="inline-flex items-center rounded-md bg-blue-600 px-4 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:bg-blue-500 dark:hover:bg-blue-600">
                        Profilom
                    </a>
                </div>
                {{-- Navigation Links --}}
                <div class="flex gap-4">
                    <form method="POST" action="{{ route('filament.admin.auth.logout') }}">
                        @csrf
                        <button type="submit"
                            class="inline-flex items-center rounded-md bg-red-600 px-4 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:bg-blue-500 dark:hover:bg-blue-600">
                            Kijelentkezés
                        </button>
                    </form>
                </div>
            @endauth
            @guest
                {{-- Bejelentkezés gomb --}}
                <div>
                    <a href="/admin"
                        class="inline-flex items-center rounded-md bg-blue-600 px-4 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:bg-blue-500 dark:hover:bg-blue-600">
                        Bejelentkezés
                    </a>
                </div>
            @endguest
        </div>
    </div>
</nav>
