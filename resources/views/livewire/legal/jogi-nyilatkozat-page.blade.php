<div>
    <section data-hero-light class="bg-white pt-44 pb-28">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl sm:text-4xl font-semibold text-gray-900 mb-3 text-center">{{ __('Imprint') }}</h1>
            <p class="text-sm text-text-secondary text-center mb-12">{{ __('Mandatory information under §§ 4 and 14 of the Hungarian E-Commerce Act (Ekertv.)') }}</p>

            <div class="prose prose-gray max-w-none">

                {{-- Szolgáltató adatai --}}
                <h2 class="text-xl font-semibold text-gray-900 mt-10 mb-4">{{ __('Provider information') }}</h2>
                <table class="w-full text-sm">
                    <tbody>
                        <tr class="border-b border-gray-100">
                            <td class="py-2 font-medium text-gray-700 pr-4 whitespace-nowrap">{{ __('Company name:') }}</td>
                            <td class="py-2 text-gray-600">Cégem 360 Kft.</td>
                        </tr>
                        <tr class="border-b border-gray-100">
                            <td class="py-2 font-medium text-gray-700 pr-4 whitespace-nowrap">{{ __('Registered office:') }}</td>
                            <td class="py-2 text-gray-600">1051 Budapest, Széchenyi István tér 7-8.</td>
                        </tr>
                        <tr class="border-b border-gray-100">
                            <td class="py-2 font-medium text-gray-700 pr-4 whitespace-nowrap">{{ __('Company registration no.:') }}</td>
                            <td class="py-2 text-gray-600">01-09-303498</td>
                        </tr>
                        <tr class="border-b border-gray-100">
                            <td class="py-2 font-medium text-gray-700 pr-4 whitespace-nowrap">{{ __('Registering court:') }}</td>
                            <td class="py-2 text-gray-600">{{ __('Metropolitan Court of Budapest, Company Registry') }}</td>
                        </tr>
                        <tr class="border-b border-gray-100">
                            <td class="py-2 font-medium text-gray-700 pr-4 whitespace-nowrap">{{ __('Tax number:') }}</td>
                            <td class="py-2 text-gray-600">14286249-2-43</td>
                        </tr>
                        <tr class="border-b border-gray-100">
                            <td class="py-2 font-medium text-gray-700 pr-4 whitespace-nowrap">{{ __('EU VAT number:') }}</td>
                            <td class="py-2 text-gray-600">HU14286249</td>
                        </tr>
                        <tr class="border-b border-gray-100">
                            <td class="py-2 font-medium text-gray-700 pr-4 whitespace-nowrap">{{ __('Representative:') }}</td>
                            <td class="py-2 text-gray-600">{{ __('Tamás Tóth, Managing Director') }}</td>
                        </tr>
                        <tr class="border-b border-gray-100">
                            <td class="py-2 font-medium text-gray-700 pr-4 whitespace-nowrap">{{ __('E-mail:') }}</td>
                            <td class="py-2 text-gray-600">info@cegem360.hu</td>
                        </tr>
                        <tr class="border-b border-gray-100">
                            <td class="py-2 font-medium text-gray-700 pr-4 whitespace-nowrap">{{ __('Phone:') }}</td>
                            <td class="py-2 text-gray-600">+36 20 331 9550</td>
                        </tr>
                        <tr>
                            <td class="py-2 font-medium text-gray-700 pr-4 whitespace-nowrap">{{ __('Website:') }}</td>
                            <td class="py-2 text-gray-600">https://cegem360.eu</td>
                        </tr>
                    </tbody>
                </table>

                {{-- Tárhelyszolgáltató --}}
                <h2 class="text-xl font-semibold text-gray-900 mt-10 mb-4">{{ __('Hosting provider') }}</h2>
                <table class="w-full text-sm">
                    <tbody>
                        <tr class="border-b border-gray-100">
                            <td class="py-2 font-medium text-gray-700 pr-4 whitespace-nowrap">{{ __('Provider name:') }}</td>
                            <td class="py-2 text-gray-600">Tárhelypark Kft.</td>
                        </tr>
                        <tr class="border-b border-gray-100">
                            <td class="py-2 font-medium text-gray-700 pr-4 whitespace-nowrap">{{ __('Registered office:') }}</td>
                            <td class="py-2 text-gray-600">1132 Budapest, Victor Hugo utca 18-22.</td>
                        </tr>
                        <tr>
                            <td class="py-2 font-medium text-gray-700 pr-4 whitespace-nowrap">{{ __('Website:') }}</td>
                            <td class="py-2 text-gray-600">https://tarhelypark.hu</td>
                        </tr>
                    </tbody>
                </table>

                {{-- Szerzői jogok --}}
                <h2 class="text-xl font-semibold text-gray-900 mt-10 mb-4">{{ __('Copyright') }}</h2>
                <p class="text-gray-600 leading-relaxed">
                    {!! __('The entire content of the <strong>https://cegem360.eu</strong> website — including texts, images, graphics, logos, icons, software, and other materials — is the intellectual property of Cégem 360 Kft. and is protected under Hungarian Copyright Act LXXVI of 1999.') !!}
                </p>
                <p class="text-gray-600 leading-relaxed mt-3">
                    {{ __('Copying, distributing, modifying, or using the website\'s content in any form is permitted only with the prior written consent of Cégem 360 Kft.') }}
                </p>

                {{-- Felelősségkizárás --}}
                <h2 class="text-xl font-semibold text-gray-900 mt-10 mb-4">{{ __('Disclaimer') }}</h2>
                <p class="text-gray-600 leading-relaxed">
                    {{ __('Cégem 360 Kft. strives to ensure the accuracy and timeliness of the information published on the website but accepts no liability for any inaccuracies, omissions, or damages arising from the use of the website.') }}
                </p>
                <p class="text-gray-600 leading-relaxed mt-3">
                    {{ __('Regarding external links on the website, Cégem 360 Kft. assumes no responsibility for the content, privacy practices, or availability of the linked sites.') }}
                </p>

                {{-- Alkalmazandó jog --}}
                <h2 class="text-xl font-semibold text-gray-900 mt-10 mb-4">{{ __('Applicable laws') }}</h2>
                <ul class="list-disc pl-5 space-y-1 text-gray-600">
                    <li>{{ __('Hungarian Act CVIII of 2001 on Certain Issues of Electronic Commerce Services and Information Society Services (Ekertv.)') }}</li>
                    <li>{{ __('Hungarian Act CXII of 2011 on the Right of Informational Self-Determination and on Freedom of Information (Infotv.)') }}</li>
                    <li>{{ __('Regulation (EU) 2016/679 of the European Parliament and of the Council (GDPR)') }}</li>
                    <li>{{ __('Hungarian Act CLV of 1997 on Consumer Protection') }}</li>
                    <li>{{ __('Hungarian Act V of 2013 on the Civil Code') }}</li>
                </ul>

                {{-- Panaszkezelés --}}
                <h2 class="text-xl font-semibold text-gray-900 mt-10 mb-4">{{ __('Complaints, dispute resolution') }}</h2>
                <p class="text-gray-600 leading-relaxed mb-3">
                    {!! __('Please contact us with complaints at <strong>info@cegem360.hu</strong>. If your complaint cannot be settled, you may contact the following bodies:') !!}
                </p>
                <table class="w-full text-sm">
                    <tbody>
                        <tr class="border-b border-gray-100">
                            <td class="py-3 font-medium text-gray-700 pr-4">{{ __('Consumer protection authority:') }}</td>
                            <td class="py-3 text-gray-600">{!! __('Government Office of the Capital City Budapest, Consumer Protection Department<br>1051 Budapest, Sas utca 19., 3rd floor') !!}</td>
                        </tr>
                        <tr class="border-b border-gray-100">
                            <td class="py-3 font-medium text-gray-700 pr-4">{{ __('Conciliation body:') }}</td>
                            <td class="py-3 text-gray-600">{!! __('Budapest Conciliation Body<br>1016 Budapest, Krisztina krt. 99.<br>E-mail: bekelteto.testulet@bkik.hu') !!}</td>
                        </tr>
                        <tr>
                            <td class="py-3 font-medium text-gray-700 pr-4">{{ __('Online dispute resolution:') }}</td>
                            <td class="py-3 text-gray-600">{!! __('European Commission online dispute resolution platform:<br>https://ec.europa.eu/consumers/odr') !!}</td>
                        </tr>
                    </tbody>
                </table>

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
