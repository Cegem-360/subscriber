<footer class="bg-white border-t border-gray-200" x-data="{ openSection: null }">
    <!-- Main Footer -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-x-8 gap-y-8">
            <!-- Column 1: Logo + Links -->
            <div class="col-span-2 md:col-span-3 lg:col-span-1">
                <a href="{{ route('home') }}" class="flex items-center gap-2 mb-5">
                    <img src="{{ Vite::asset('resources/images/cegem360-logo.png') }}" alt="Cégem360" class="h-10">
                </a>
                <ul class="space-y-2.5 text-sm text-gray-700">
                    <li><a href="#" class="text-inherit! hover:text-indigo-600! transition-colors">Árazás</a></li>
                    <li><a href="#" class="text-inherit! hover:text-indigo-600! transition-colors">Kapcsolat</a></li>
                    <li><a href="#" class="text-inherit! hover:text-indigo-600! transition-colors">Sablonok</a></li>
                    <li><a href="#" class="text-inherit! hover:text-indigo-600! transition-colors">KKV</a></li>
                    <li><a href="#" class="text-inherit! hover:text-indigo-600! transition-colors">Nagyvállalat</a></li>
                    <li><a href="#" class="text-inherit! hover:text-indigo-600! transition-colors">App piactér</a></li>
                    <li><a href="#" class="text-inherit! hover:text-indigo-600! transition-colors">24/7 támogatás</a></li>
                </ul>
            </div>

            <!-- Column 2: Funkciók -->
            <div class="col-span-1">
                <button
                    class="lg:hidden w-full flex items-center justify-between text-[15px] font-semibold text-gray-900 mb-4"
                    @click="openSection = openSection === 'funkciok' ? null : 'funkciok'"
                >
                    Funkciók
                    <svg class="w-4 h-4 transition-transform" :class="{ 'rotate-180': openSection === 'funkciok' }" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </button>
                <h3 class="hidden lg:block text-[15px] font-semibold text-gray-900 mb-4">Funkciók</h3>
                <ul class="space-y-2.5 text-sm text-gray-700" x-show="openSection === 'funkciok' || window.innerWidth >= 1024" x-collapse.duration.300ms>
                    <li><a href="#" class="text-inherit! hover:text-indigo-600! transition-colors">Dokumentumok</a></li>
                    <li><a href="#" class="text-inherit! hover:text-indigo-600! transition-colors">Integrációk</a></li>
                    <li><a href="#" class="text-inherit! hover:text-indigo-600! transition-colors">Automatizációk</a></li>
                    <li><a href="#" class="text-inherit! hover:text-indigo-600! transition-colors">AI</a></li>
                    <li><a href="#" class="text-inherit! hover:text-indigo-600! transition-colors">Irányítópultok</a></li>
                    <li><a href="#" class="text-inherit! hover:text-indigo-600! transition-colors">Kanban</a></li>
                    <li><a href="#" class="text-inherit! hover:text-indigo-600! transition-colors">Gantt</a></li>
                </ul>
            </div>

            <!-- Column 3: Modulok -->
            <div class="col-span-1">
                <button
                    class="lg:hidden w-full flex items-center justify-between text-[15px] font-semibold text-gray-900 mb-4"
                    @click="openSection = openSection === 'modulok' ? null : 'modulok'"
                >
                    Modulok
                    <svg class="w-4 h-4 transition-transform" :class="{ 'rotate-180': openSection === 'modulok' }" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </button>
                <h3 class="hidden lg:block text-[15px] font-semibold text-gray-900 mb-4">Modulok</h3>
                <ul class="space-y-2.5 text-sm text-gray-700" x-show="openSection === 'modulok' || window.innerWidth >= 1024" x-collapse.duration.300ms>
                    <li><a href="{{ route('products.szerviz') }}" class="text-inherit! hover:text-indigo-600! transition-colors">Digitális munkalap</a></li>
                    <li><a href="{{ route('products.kontrolling') }}" class="text-inherit! hover:text-indigo-600! transition-colors">Kontrolling</a></li>
                    <li><a href="{{ route('products.seo') }}" class="text-inherit! hover:text-indigo-600! transition-colors">SEO Eszköz</a></li>
                    <li><a href="{{ route('products.crm') }}" class="text-inherit! hover:text-indigo-600! transition-colors">CRM</a></li>
                    <li><a href="{{ route('products.beszerzes') }}" class="text-inherit! hover:text-indigo-600! transition-colors">Beszerzés-logisztika</a></li>
                    <li><a href="{{ route('products.ertekesites') }}" class="text-inherit! hover:text-indigo-600! transition-colors">Értékesítés</a></li>
                    <li><a href="{{ route('products.gyartas') }}" class="text-inherit! hover:text-indigo-600! transition-colors">Gyártásirányítás</a></li>
                    <li><a href="{{ route('products.automatizalas') }}" class="text-inherit! hover:text-indigo-600! transition-colors">Automatizálás</a></li>
                </ul>

                <h4 class="text-[15px] font-semibold text-gray-900 mb-4 mt-6">Továbbiak</h4>
                <ul class="space-y-2.5 text-sm text-gray-700">
                    <li><a href="#" class="text-inherit! hover:text-indigo-600! transition-colors">WorkCanvas</a></li>
                    <li><a href="#" class="text-inherit! hover:text-indigo-600! transition-colors">WorkForms</a></li>
                </ul>
            </div>

            <!-- Column 4: Felhasználási területek -->
            <div class="col-span-1">
                <button
                    class="lg:hidden w-full flex items-center justify-between text-[15px] font-semibold text-gray-900 mb-4"
                    @click="openSection = openSection === 'usecases' ? null : 'usecases'"
                >
                    Felhasználás
                    <svg class="w-4 h-4 transition-transform" :class="{ 'rotate-180': openSection === 'usecases' }" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </button>
                <h3 class="hidden lg:block text-[15px] font-semibold text-gray-900 mb-4">Felhasználás</h3>
                <ul class="space-y-2.5 text-sm text-gray-700" x-show="openSection === 'usecases' || window.innerWidth >= 1024" x-collapse.duration.300ms>
                    <li><a href="#" class="text-inherit! hover:text-indigo-600! transition-colors">Marketing</a></li>
                    <li><a href="#" class="text-inherit! hover:text-indigo-600! transition-colors">Projektmenedzsment</a></li>
                    <li><a href="#" class="text-inherit! hover:text-indigo-600! transition-colors">Értékesítés</a></li>
                    <li><a href="#" class="text-inherit! hover:text-indigo-600! transition-colors">Fejlesztők</a></li>
                    <li><a href="#" class="text-inherit! hover:text-indigo-600! transition-colors">HR</a></li>
                    <li><a href="#" class="text-inherit! hover:text-indigo-600! transition-colors">IT</a></li>
                    <li><a href="#" class="text-inherit! hover:text-indigo-600! transition-colors">Operáció</a></li>
                    <li><a href="#" class="text-inherit! hover:text-indigo-600! transition-colors">Építőipar</a></li>
                </ul>
            </div>

            <!-- Column 5: Cég -->
            <div class="col-span-1">
                <button
                    class="lg:hidden w-full flex items-center justify-between text-[15px] font-semibold text-gray-900 mb-4"
                    @click="openSection = openSection === 'ceg' ? null : 'ceg'"
                >
                    Cég
                    <svg class="w-4 h-4 transition-transform" :class="{ 'rotate-180': openSection === 'ceg' }" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </button>
                <h3 class="hidden lg:block text-[15px] font-semibold text-gray-900 mb-4">Cég</h3>
                <ul class="space-y-2.5 text-sm text-gray-700" x-show="openSection === 'ceg' || window.innerWidth >= 1024" x-collapse.duration.300ms>
                    <li><a href="#" class="text-inherit! hover:text-indigo-600! transition-colors">Rólunk</a></li>
                    <li><a href="#" class="text-inherit! hover:text-indigo-600! transition-colors">Karrier - Felveszünk!</a></li>
                    <li><a href="#" class="text-inherit! hover:text-indigo-600! transition-colors">Vezetői betekintések</a></li>
                    <li><a href="#" class="text-inherit! hover:text-indigo-600! transition-colors">Sajtó</a></li>
                    <li><a href="#" class="text-inherit! hover:text-indigo-600! transition-colors">Ügyfélsztorik</a></li>
                    <li><a href="#" class="text-inherit! hover:text-indigo-600! transition-colors">Partnerré válás</a></li>
                    <li><a href="#" class="text-inherit! hover:text-indigo-600! transition-colors">Fenntarthatóság</a></li>
                    <li><a href="#" class="text-inherit! hover:text-indigo-600! transition-colors">Affiliate</a></li>
                    <li><a href="#" class="text-inherit! hover:text-indigo-600! transition-colors">Befektetői kapcsolatok</a></li>
                </ul>
            </div>

            <!-- Column 6: Erőforrások -->
            <div class="col-span-1">
                <button
                    class="lg:hidden w-full flex items-center justify-between text-[15px] font-semibold text-gray-900 mb-4"
                    @click="openSection = openSection === 'eroforrasok' ? null : 'eroforrasok'"
                >
                    Erőforrások
                    <svg class="w-4 h-4 transition-transform" :class="{ 'rotate-180': openSection === 'eroforrasok' }" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </button>
                <h3 class="hidden lg:block text-[15px] font-semibold text-gray-900 mb-4">Erőforrások</h3>
                <ul class="space-y-2.5 text-sm text-gray-700" x-show="openSection === 'eroforrasok' || window.innerWidth >= 1024" x-collapse.duration.300ms>
                    <li><a href="#" class="text-inherit! hover:text-indigo-600! transition-colors">Súgó</a></li>
                    <li><a href="#" class="text-inherit! hover:text-indigo-600! transition-colors">Közösség</a></li>
                    <li><a href="#" class="text-inherit! hover:text-indigo-600! transition-colors">Blog</a></li>
                    <li><a href="#" class="text-inherit! hover:text-indigo-600! transition-colors">Újdonságok</a></li>
                    <li><a href="#" class="text-inherit! hover:text-indigo-600! transition-colors">Akadémia</a></li>
                    <li><a href="#" class="text-inherit! hover:text-indigo-600! transition-colors">Globális események</a></li>
                    <li><a href="#" class="text-inherit! hover:text-indigo-600! transition-colors">Startup program</a></li>
                    <li><a href="#" class="text-inherit! hover:text-indigo-600! transition-colors">App fejlesztés</a></li>
                    <li><a href="#" class="text-inherit! hover:text-indigo-600! transition-colors">Partner keresés</a></li>
                    <li><a href="#" class="text-inherit! hover:text-indigo-600! transition-colors">Szakértő keresés</a></li>
                    <li><a href="#" class="text-inherit! hover:text-indigo-600! transition-colors">Összehasonlítás</a></li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Sub-footer -->
    <div class="border-t border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-5">
            <div class="flex flex-col lg:flex-row items-center justify-between gap-5">
                <!-- Left: Language selector + Social icons -->
                <div class="flex flex-col sm:flex-row items-center gap-5">
                    <!-- Language Selector -->
                    <div class="relative" x-data="{ open: false }">
                        <button
                            @click="open = !open"
                            @click.outside="open = false"
                            class="flex items-center gap-2 px-3 py-1.5 text-sm text-gray-700 hover:text-gray-900 border border-gray-300 rounded-md transition-colors bg-white"
                        >
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"/></svg>
                            Magyar
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                        </button>
                        <div
                            x-show="open"
                            x-transition
                            class="absolute bottom-full left-0 mb-2 w-36 bg-white border border-gray-200 rounded-md shadow-lg overflow-hidden z-10"
                        >
                            <a href="#" class="block px-3 py-2 text-sm text-gray-900 bg-gray-100">Magyar</a>
                            <a href="#" class="block px-3 py-2 text-sm text-gray-700 hover:text-gray-900 hover:bg-gray-50">English</a>
                            <a href="#" class="block px-3 py-2 text-sm text-gray-700 hover:text-gray-900 hover:bg-gray-50">Deutsch</a>
                        </div>
                    </div>

                    <!-- Social Icons -->
                    <div class="flex items-center gap-3">
                        <a href="#" class="text-gray-400 hover:text-gray-600 transition-colors">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-gray-600 transition-colors">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-gray-600 transition-colors">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-gray-600 transition-colors">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-gray-600 transition-colors">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-gray-600 transition-colors">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96 1.66-1.44 3.98-2.13 6.15-1.72.02 1.48-.04 2.96-.04 4.44-.99-.32-2.15-.23-3.02.37-.63.41-1.11 1.04-1.36 1.75-.21.51-.15 1.07-.14 1.61.24 1.64 1.82 3.02 3.5 2.87 1.12-.01 2.19-.66 2.77-1.61.19-.33.4-.67.41-1.06.1-1.79.06-3.57.07-5.36.01-4.03-.01-8.05.02-12.07z"/></svg>
                        </a>
                    </div>
                </div>

            </div>

            <!-- Bottom row: Legal links -->
            <div class="mt-5 pt-5 border-t border-gray-200 flex flex-col sm:flex-row items-center justify-between gap-3">
                <div class="flex flex-wrap items-center justify-center gap-x-4 gap-y-1 text-sm text-gray-500">
                    <a href="#" class="hover:text-gray-700 transition-colors">Jogi nyilatkozat</a>
                    <span class="text-gray-300">|</span>
                    <a href="#" class="hover:text-gray-700 transition-colors">Szolgáltatási feltételek</a>
                    <span class="text-gray-300">|</span>
                    <a href="#" class="hover:text-gray-700 transition-colors">Adatvédelmi tájékoztató</a>
                    <span class="text-gray-300">|</span>
                    <a href="#" class="hover:text-gray-700 transition-colors">Cookie beállítások</a>
                    <span class="text-gray-300">|</span>
                    <a href="{{ route('privacy-policy') }}" class="hover:text-gray-700 transition-colors">ÁSZF</a>
                </div>
            </div>

            <!-- Copyright -->
            <div class="mt-3 text-center sm:text-left text-sm text-gray-400">
                Minden jog fenntartva &copy; {{ date('Y') }} Cégem360
            </div>
        </div>
    </div>
</footer>
