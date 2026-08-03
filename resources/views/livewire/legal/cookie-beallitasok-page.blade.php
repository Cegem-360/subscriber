<div>
    <section data-hero-light class="bg-white pt-44 pb-28">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl sm:text-4xl font-semibold text-gray-900 mb-3 text-center">{{ __('Cookie Policy') }}</h1>
            <p class="text-sm text-text-secondary text-center mb-12">{{ __('Effective from: 1 January 2025') }}</p>

            <div class="prose prose-gray max-w-none">

                {{-- 1. Mi az a cookie? --}}
                <h2 class="text-xl font-semibold text-gray-900 mt-10 mb-4">{{ __('1. What is a cookie?') }}</h2>
                <p class="text-gray-600 leading-relaxed">
                    {!! __('A cookie is a small text file that the website places in your browser when you visit <strong>https://cegem360.eu</strong>. Cookies help the website function properly, make browsing safer, and provide a better user experience.') !!}
                </p>

                {{-- 2. Süti típusok --}}
                <h2 class="text-xl font-semibold text-gray-900 mt-10 mb-4">{{ __('2. Types of cookies we use') }}</h2>

                <h3 class="text-lg font-medium text-gray-800 mt-6 mb-3">{{ __('2.1. Strictly necessary (technical) cookies') }}</h3>
                <p class="text-gray-600 leading-relaxed mb-3">
                    {{ __('These cookies are essential for the basic operation of the website. Without them, the website cannot function properly.') }}
                </p>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm border border-gray-200 rounded-lg">
                        <thead>
                            <tr class="bg-gray-50">
                                <th class="px-4 py-2 text-left font-medium text-gray-700">{{ __('Cookie name') }}</th>
                                <th class="px-4 py-2 text-left font-medium text-gray-700">{{ __('Purpose') }}</th>
                                <th class="px-4 py-2 text-left font-medium text-gray-700">{{ __('Expiry') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="border-t border-gray-100">
                                <td class="px-4 py-2 text-gray-600">XSRF-TOKEN</td>
                                <td class="px-4 py-2 text-gray-600">{{ __('CSRF protection') }}</td>
                                <td class="px-4 py-2 text-gray-600">{{ __('Session') }}</td>
                            </tr>
                            <tr class="border-t border-gray-100">
                                <td class="px-4 py-2 text-gray-600">laravel_session</td>
                                <td class="px-4 py-2 text-gray-600">{{ __('User session identification') }}</td>
                                <td class="px-4 py-2 text-gray-600">{{ __('2 hours') }}</td>
                            </tr>
                            <tr class="border-t border-gray-100">
                                <td class="px-4 py-2 text-gray-600">cookie_consent</td>
                                <td class="px-4 py-2 text-gray-600">{{ __('Storing cookie consent') }}</td>
                                <td class="px-4 py-2 text-gray-600">{{ __('1 year') }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <h3 class="text-lg font-medium text-gray-800 mt-6 mb-3">{{ __('2.2. Analytics cookies') }}</h3>
                <p class="text-gray-600 leading-relaxed mb-3">
                    {{ __('These cookies collect anonymous statistics about website usage, helping with development and user experience improvement.') }}
                </p>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm border border-gray-200 rounded-lg">
                        <thead>
                            <tr class="bg-gray-50">
                                <th class="px-4 py-2 text-left font-medium text-gray-700">{{ __('Cookie name') }}</th>
                                <th class="px-4 py-2 text-left font-medium text-gray-700">{{ __('Provider') }}</th>
                                <th class="px-4 py-2 text-left font-medium text-gray-700">{{ __('Purpose') }}</th>
                                <th class="px-4 py-2 text-left font-medium text-gray-700">{{ __('Expiry') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="border-t border-gray-100">
                                <td class="px-4 py-2 text-gray-600">_ga</td>
                                <td class="px-4 py-2 text-gray-600">Google Analytics</td>
                                <td class="px-4 py-2 text-gray-600">{{ __('Distinguishing unique visitors') }}</td>
                                <td class="px-4 py-2 text-gray-600">{{ __('2 years') }}</td>
                            </tr>
                            <tr class="border-t border-gray-100">
                                <td class="px-4 py-2 text-gray-600">_ga_*</td>
                                <td class="px-4 py-2 text-gray-600">Google Analytics</td>
                                <td class="px-4 py-2 text-gray-600">{{ __('Storing session state') }}</td>
                                <td class="px-4 py-2 text-gray-600">{{ __('2 years') }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <h3 class="text-lg font-medium text-gray-800 mt-6 mb-3">{{ __('2.3. Marketing cookies') }}</h3>
                <p class="text-gray-600 leading-relaxed mb-3">
                    {{ __('These cookies are used to measure the effectiveness of advertising campaigns.') }}
                </p>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm border border-gray-200 rounded-lg">
                        <thead>
                            <tr class="bg-gray-50">
                                <th class="px-4 py-2 text-left font-medium text-gray-700">{{ __('Cookie name') }}</th>
                                <th class="px-4 py-2 text-left font-medium text-gray-700">{{ __('Provider') }}</th>
                                <th class="px-4 py-2 text-left font-medium text-gray-700">{{ __('Purpose') }}</th>
                                <th class="px-4 py-2 text-left font-medium text-gray-700">{{ __('Expiry') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="border-t border-gray-100">
                                <td class="px-4 py-2 text-gray-600">_gcl_au</td>
                                <td class="px-4 py-2 text-gray-600">Google Ads</td>
                                <td class="px-4 py-2 text-gray-600">{{ __('Conversion tracking') }}</td>
                                <td class="px-4 py-2 text-gray-600">{{ __('90 days') }}</td>
                            </tr>
                            <tr class="border-t border-gray-100">
                                <td class="px-4 py-2 text-gray-600">_fbp</td>
                                <td class="px-4 py-2 text-gray-600">Meta (Facebook)</td>
                                <td class="px-4 py-2 text-gray-600">{{ __('Measuring ad effectiveness') }}</td>
                                <td class="px-4 py-2 text-gray-600">{{ __('90 days') }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                {{-- 3. Jogalap --}}
                <h2 class="text-xl font-semibold text-gray-900 mt-10 mb-4">{{ __('3. Legal basis for cookies') }}</h2>
                <ul class="list-disc pl-5 space-y-1 text-gray-600">
                    <li>{!! __('<strong>Technical cookies:</strong> legitimate interest (GDPR Article 6(1)(f)) — essential for website operation') !!}</li>
                    <li>{!! __('<strong>Analytics and marketing cookies:</strong> consent of the data subject (GDPR Article 6(1)(a))') !!}</li>
                </ul>

                {{-- 4. Sütik kezelése --}}
                <h2 class="text-xl font-semibold text-gray-900 mt-10 mb-4">{{ __('4. Managing and disabling cookies') }}</h2>
                <p class="text-gray-600 leading-relaxed mb-3">
                    {{ __('You can change or withdraw your cookie consent at any time. You can manage cookies in your browser in the following ways:') }}
                </p>
                <ul class="list-disc pl-5 space-y-1 text-gray-600">
                    <li>{!! __('<strong>Chrome:</strong> Settings → Privacy and security → Cookies and other site data') !!}</li>
                    <li>{!! __('<strong>Firefox:</strong> Settings → Privacy & Security → Cookies and Site Data') !!}</li>
                    <li>{!! __('<strong>Safari:</strong> Preferences → Privacy → Manage Website Data') !!}</li>
                    <li>{!! __('<strong>Edge:</strong> Settings → Cookies and site permissions') !!}</li>
                </ul>
                <p class="text-gray-600 leading-relaxed mt-3">
                    {!! __('To disable Google Analytics, you can use the <a href=":url" target="_blank" rel="noopener noreferrer" class="text-primary-500 hover:text-primary-600 underline">Google Analytics opt-out browser add-on</a>.', ['url' => 'https://tools.google.com/dlpage/gaoptout']) !!}
                </p>
                <p class="text-gray-600 leading-relaxed mt-2">
                    {!! __('<strong>Note:</strong> if technical cookies are disabled, some functions of the website will not work properly.') !!}
                </p>

                {{-- 5. Adattovábbítás --}}
                <h2 class="text-xl font-semibold text-gray-900 mt-10 mb-4">{{ __('5. Data transfer to third parties') }}</h2>
                <p class="text-gray-600 leading-relaxed">
                    {!! __('Data from analytics and marketing cookies are transferred to Google LLC and Meta Platforms, Inc. The transfer is made under the EU–US Data Privacy Framework. Further information is available in our <a href=":url" class="text-primary-500 hover:text-primary-600 underline">Privacy Policy</a>.', ['url' => route('legal.adatvedelmi-tajekoztato')]) !!}
                </p>

                {{-- 6. Módosítás --}}
                <h2 class="text-xl font-semibold text-gray-900 mt-10 mb-4">{{ __('6. Amendments to this policy') }}</h2>
                <p class="text-gray-600 leading-relaxed">
                    {{ __('Cégem 360 Kft. reserves the right to amend this cookie policy at any time. The amended policy is effective from the date of publication on the website.') }}
                </p>

                {{-- 7. Kapcsolat --}}
                <h2 class="text-xl font-semibold text-gray-900 mt-10 mb-4">{{ __('7. Contact') }}</h2>
                <p class="text-gray-600 leading-relaxed">
                    {{ __('For questions related to cookie management, please contact us:') }}
                </p>
                <ul class="list-none space-y-1 text-gray-600 mt-2">
                    <li><strong>{{ __('E-mail:') }}</strong> info@cegem360.hu</li>
                    <li><strong>{{ __('Phone:') }}</strong> +36 20 331 9550</li>
                </ul>

            </div>

            <div class="mt-20 text-center">
                <a href="{{ route('home') }}"
                    class="inline-flex items-center gap-2 px-6 py-3 text-sm font-semibold border-2 border-gray-200 hover:border-primary-300 hover:bg-primary-50 text-gray-700 rounded-full transition-all">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    {{ __('Back to home') }}
                </a>
            </div>
        </div>
    </section>
</div>
