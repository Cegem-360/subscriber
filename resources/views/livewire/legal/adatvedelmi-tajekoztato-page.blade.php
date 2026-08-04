<div>
    <section data-hero-light class="bg-white pt-44 pb-28">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl sm:text-4xl font-semibold text-gray-900 mb-3 text-center">{{ __('Privacy Policy') }}</h1>
            <p class="text-sm text-text-secondary text-center mb-12">
                {{ __('Effective from: :date', ['date' => \App\Enums\LegalDocument::PrivacyPolicy->effectiveAt()->locale(app()->getLocale())->translatedFormat(__('j F Y'))]) }}
            </p>

            <div class="prose prose-gray max-w-none">

                {{-- 1. Adatkezelő --}}
                <h2 class="text-xl font-semibold text-gray-900 mt-10 mb-4">{{ __('1. Data controller name and contact details') }}</h2>
                <table class="w-full text-sm">
                    <tbody>
                        <tr class="border-b border-gray-100">
                            <td class="py-2 font-medium text-gray-700 pr-4 whitespace-nowrap">{{ __('Company') }}</td>
                            <td class="py-2 text-gray-600">Cégem 360 Kft.</td>
                        </tr>
                        <tr class="border-b border-gray-100">
                            <td class="py-2 font-medium text-gray-700 pr-4 whitespace-nowrap">{{ __('Registered office') }}</td>
                            <td class="py-2 text-gray-600">1051 Budapest, Széchenyi István tér 7-8.</td>
                        </tr>
                        <tr class="border-b border-gray-100">
                            <td class="py-2 font-medium text-gray-700 pr-4 whitespace-nowrap">{{ __('Company reg. no.') }}</td>
                            <td class="py-2 text-gray-600">01-09-303498</td>
                        </tr>
                        <tr class="border-b border-gray-100">
                            <td class="py-2 font-medium text-gray-700 pr-4 whitespace-nowrap">{{ __('Tax number') }}</td>
                            <td class="py-2 text-gray-600">14286249-2-43</td>
                        </tr>
                        <tr class="border-b border-gray-100">
                            <td class="py-2 font-medium text-gray-700 pr-4 whitespace-nowrap">{{ __('Privacy contact') }}</td>
                            <td class="py-2 text-gray-600">Tóth Tamás</td>
                        </tr>
                        <tr class="border-b border-gray-100">
                            <td class="py-2 font-medium text-gray-700 pr-4 whitespace-nowrap">{{ __('E-mail') }}</td>
                            <td class="py-2 text-gray-600"><a href="mailto:info@cegem360.hu" class="text-primary-500 hover:text-primary-600">info@cegem360.hu</a></td>
                        </tr>
                        <tr class="border-b border-gray-100">
                            <td class="py-2 font-medium text-gray-700 pr-4 whitespace-nowrap">{{ __('Phone') }}</td>
                            <td class="py-2 text-gray-600">+36 20 331 9550</td>
                        </tr>
                        <tr>
                            <td class="py-2 font-medium text-gray-700 pr-4 whitespace-nowrap">{{ __('Website') }}</td>
                            <td class="py-2 text-gray-600"><a href="https://cegem360.eu" class="text-primary-500 hover:text-primary-600">https://cegem360.eu</a></td>
                        </tr>
                    </tbody>
                </table>

                <h3 class="text-lg font-medium text-gray-800 mt-6 mb-3">{{ __('Privacy contact') }}</h3>
                <p class="text-gray-600 leading-relaxed">
                    {{ __('Cégem 360 Kft. is not required to appoint a Data Protection Officer (DPO) under GDPR Article 37, as it does not carry out large-scale, regular, and systematic monitoring, and does not process special categories of data as a core activity.') }}
                </p>
                <p class="text-gray-600 leading-relaxed">
                    {{ __('For questions, requests, and complaints related to data protection, please contact us only at:') }}
                </p>
                <p class="text-gray-600 leading-relaxed">
                    {!! __('<strong>Tamás Tóth</strong> (privacy contact)<br>E-mail: <a href="mailto:tamas@cegem360.hu" class="text-primary-500 hover:text-primary-600">tamas@cegem360.hu</a><br>Phone: +36 20 331 9550') !!}
                </p>

                {{-- 2. Jogszabályi alap --}}
                <h2 class="text-xl font-semibold text-gray-900 mt-10 mb-4">{{ __('2. Legal basis and scope of this notice') }}</h2>
                <p class="text-gray-600 leading-relaxed">
                    {!! __('This Privacy Policy applies to all data processing activities of the <strong>https://cegem360.eu</strong> website and Cégem 360 Kft., including the website, newsletter sending, B2B marketing, invoicing, and customer record-keeping.') !!}
                </p>
                <p class="text-gray-600 leading-relaxed">{{ __('Legal bases of processing:') }}</p>
                <ul class="list-disc pl-5 space-y-1 text-gray-600">
                    <li>{{ __('Regulation (EU) 2016/679 of the European Parliament and of the Council (GDPR)') }}</li>
                    <li>{{ __('Hungarian Act CXII of 2011 on the Right of Informational Self-Determination and on Freedom of Information (Infotv.)') }}</li>
                    <li>{{ __('Hungarian Act CVIII of 2001 on Electronic Commerce Services (Eker. tv.)') }}</li>
                    <li>{{ __('Hungarian Act XLVIII of 2008 on the Basic Conditions of Economic Advertising Activity (Grtv.)') }}</li>
                    <li>{{ __('Hungarian Act C of 2000 on Accounting (Szt.)') }}</li>
                </ul>

                {{-- 3. Adatkezelési tevékenységek --}}
                <h2 class="text-xl font-semibold text-gray-900 mt-10 mb-4">{{ __('3. Detailed presentation of data processing activities') }}</h2>

                <h3 class="text-lg font-medium text-gray-800 mt-6 mb-3">{{ __('3.1. Contact and quote-request form') }}</h3>
                <table class="w-full text-sm">
                    <tbody>
                        <tr class="border-b border-gray-100">
                            <td class="py-2 font-medium text-gray-700 pr-4 whitespace-nowrap">{{ __('Data processed') }}</td>
                            <td class="py-2 text-gray-600">{{ __('Name, e-mail address, phone number, company name, message content') }}</td>
                        </tr>
                        <tr class="border-b border-gray-100">
                            <td class="py-2 font-medium text-gray-700 pr-4 whitespace-nowrap">{{ __('Purpose') }}</td>
                            <td class="py-2 text-gray-600">{{ __('Answering the inquiry, preparing a quote, preparing for contract conclusion') }}</td>
                        </tr>
                        <tr class="border-b border-gray-100">
                            <td class="py-2 font-medium text-gray-700 pr-4 whitespace-nowrap">{{ __('Legal basis') }}</td>
                            <td class="py-2 text-gray-600">{{ __('GDPR Article 6(1)(a) (consent) and (b) (pre-contractual measures)') }}</td>
                        </tr>
                        <tr class="border-b border-gray-100">
                            <td class="py-2 font-medium text-gray-700 pr-4 whitespace-nowrap">{{ __('Retention period') }}</td>
                            <td class="py-2 text-gray-600">{{ __('5 years from case closure; in case of contract conclusion, 5 years from contract termination') }}</td>
                        </tr>
                        <tr>
                            <td class="py-2 font-medium text-gray-700 pr-4 whitespace-nowrap">{{ __('System involved') }}</td>
                            <td class="py-2 text-gray-600">{{ __('Notion (CRM), e-mail') }}</td>
                        </tr>
                    </tbody>
                </table>

                <h3 class="text-lg font-medium text-gray-800 mt-6 mb-3">{{ __('3.2. Newsletter subscription (voluntary, for individuals)') }}</h3>
                <table class="w-full text-sm">
                    <tbody>
                        <tr class="border-b border-gray-100">
                            <td class="py-2 font-medium text-gray-700 pr-4 whitespace-nowrap">{{ __('Data processed') }}</td>
                            <td class="py-2 text-gray-600">{{ __('Name, e-mail address, time of subscription, IP address (for technical purposes)') }}</td>
                        </tr>
                        <tr class="border-b border-gray-100">
                            <td class="py-2 font-medium text-gray-700 pr-4 whitespace-nowrap">{{ __('Purpose') }}</td>
                            <td class="py-2 text-gray-600">{{ __('Sending informational and promotional electronic messages') }}</td>
                        </tr>
                        <tr class="border-b border-gray-100">
                            <td class="py-2 font-medium text-gray-700 pr-4 whitespace-nowrap">{{ __('Legal basis') }}</td>
                            <td class="py-2 text-gray-600">{{ __('GDPR Article 6(1)(a) (voluntary, prior consent) in line with Article 6 of the Hungarian Advertising Act (Grtv.)') }}</td>
                        </tr>
                        <tr class="border-b border-gray-100">
                            <td class="py-2 font-medium text-gray-700 pr-4 whitespace-nowrap">{{ __('Retention period') }}</td>
                            <td class="py-2 text-gray-600">{{ __('Until unsubscribe; data is deleted immediately after unsubscribe') }}</td>
                        </tr>
                        <tr class="border-b border-gray-100">
                            <td class="py-2 font-medium text-gray-700 pr-4 whitespace-nowrap">{{ __('Unsubscribe') }}</td>
                            <td class="py-2 text-gray-600">{{ __('Via the unsubscribe link in every newsletter, free of charge at any time') }}</td>
                        </tr>
                        <tr>
                            <td class="py-2 font-medium text-gray-700 pr-4 whitespace-nowrap">{{ __('System involved') }}</td>
                            <td class="py-2 text-gray-600">{{ __('Zoho Campaigns (see chapter 5)') }}</td>
                        </tr>
                    </tbody>
                </table>

                <h3 class="text-lg font-medium text-gray-800 mt-6 mb-3">{{ __('3.3. B2B direct marketing — corporate data sourced from a third party (OPTEN Kft.)') }}</h3>
                <div class="bg-blue-50 border-l-4 border-blue-500 p-4 rounded-r-lg my-4">
                    {!! __('<strong>Notice under GDPR Article 14</strong> — This section addresses those who did not contact us directly but received marketing communications from us at their corporate contact details.') !!}
                </div>
                <table class="w-full text-sm">
                    <tbody>
                        <tr class="border-b border-gray-100">
                            <td class="py-2 font-medium text-gray-700 pr-4 whitespace-nowrap">{{ __('Data processed') }}</td>
                            <td class="py-2 text-gray-600">{{ __('Corporate e-mail address (as listed in the Hungarian company registry or supplementary corporate information database)') }}</td>
                        </tr>
                        <tr class="border-b border-gray-100">
                            <td class="py-2 font-medium text-gray-700 pr-4">{{ __('Source of the data') }}</td>
                            <td class="py-2 text-gray-600">{{ __('OPTEN Kft. (1138 Budapest, Népfürdő utca 22., Duna Tower; tax no.: 12012187-2-41) — corporate marketing list containing publicly available or officially sourced contact data of Hungarian businesses. Our company holds a valid subscription to OPTEN\'s Marketing module and Email-address add-on services.') }}</td>
                        </tr>
                        <tr class="border-b border-gray-100">
                            <td class="py-2 font-medium text-gray-700 pr-4 whitespace-nowrap">{{ __('Purpose') }}</td>
                            <td class="py-2 text-gray-600">{{ __('B2B (business-to-business) marketing communications: tender opportunities, digitalization services, website development') }}</td>
                        </tr>
                        <tr class="border-b border-gray-100">
                            <td class="py-2 font-medium text-gray-700 pr-4 whitespace-nowrap">{{ __('Legal basis') }}</td>
                            <td class="py-2 text-gray-600">{{ __('GDPR Article 6(1)(f) — Legitimate interest: B2B marketing data processing, in line with GDPR Recital 47 and Section 6 of Hungarian Advertising Act (Grtv.). Processing only targets corporate contact details of businesses, not individuals.') }}</td>
                        </tr>
                        <tr class="border-b border-gray-100">
                            <td class="py-2 font-medium text-gray-700 pr-4 whitespace-nowrap">{{ __('Retention period') }}</td>
                            <td class="py-2 text-gray-600">{{ __('Until objection or unsubscribe; thereafter the e-mail address is deleted immediately') }}</td>
                        </tr>
                        <tr class="border-b border-gray-100">
                            <td class="py-2 font-medium text-gray-700 pr-4">{{ __('Objection / deletion') }}</td>
                            <td class="py-2 text-gray-600">{{ __('Every message contains an unsubscribe option (Unsubscribe link); upon written objection (info@cegem360.hu), data is deleted immediately') }}</td>
                        </tr>
                        <tr>
                            <td class="py-2 font-medium text-gray-700 pr-4 whitespace-nowrap">{{ __('System involved') }}</td>
                            <td class="py-2 text-gray-600">{{ __('Zoho Campaigns; OPTEN database') }}</td>
                        </tr>
                    </tbody>
                </table>
                <p class="text-gray-600 leading-relaxed mt-3">
                    {!! __('Please note that if you have any objection regarding the legal basis of this processing or the message received, you have the right to object (GDPR Art. 21) or request deletion (GDPR Art. 17) at <a href="mailto:info@cegem360.hu" class="text-primary-500 hover:text-primary-600">info@cegem360.hu</a>. We respond to objections within 30 days.') !!}
                </p>

                <h3 class="text-lg font-medium text-gray-800 mt-6 mb-3">{{ __('3.4. Invoicing and accounting obligations') }}</h3>
                <table class="w-full text-sm">
                    <tbody>
                        <tr class="border-b border-gray-100">
                            <td class="py-2 font-medium text-gray-700 pr-4 whitespace-nowrap">{{ __('Data processed') }}</td>
                            <td class="py-2 text-gray-600">{{ __('Billing name, address, tax number, e-mail address, ordered service, payment amount') }}</td>
                        </tr>
                        <tr class="border-b border-gray-100">
                            <td class="py-2 font-medium text-gray-700 pr-4 whitespace-nowrap">{{ __('Purpose') }}</td>
                            <td class="py-2 text-gray-600">{{ __('Fulfilling legal obligations: invoice issuance, accounting') }}</td>
                        </tr>
                        <tr class="border-b border-gray-100">
                            <td class="py-2 font-medium text-gray-700 pr-4 whitespace-nowrap">{{ __('Legal basis') }}</td>
                            <td class="py-2 text-gray-600">{{ __('GDPR Article 6(1)(c) — legal obligation (Hungarian VAT Act, Accounting Act)') }}</td>
                        </tr>
                        <tr class="border-b border-gray-100">
                            <td class="py-2 font-medium text-gray-700 pr-4 whitespace-nowrap">{{ __('Retention period') }}</td>
                            <td class="py-2 text-gray-600">{{ __('8 years (Section 169 of the Hungarian Accounting Act)') }}</td>
                        </tr>
                        <tr>
                            <td class="py-2 font-medium text-gray-700 pr-4 whitespace-nowrap">{{ __('System involved') }}</td>
                            <td class="py-2 text-gray-600">{{ __('Billingo (see chapter 5)') }}</td>
                        </tr>
                    </tbody>
                </table>

                <h3 class="text-lg font-medium text-gray-800 mt-6 mb-3">{{ __('3.5. Customer relationship management (CRM)') }}</h3>
                <table class="w-full text-sm">
                    <tbody>
                        <tr class="border-b border-gray-100">
                            <td class="py-2 font-medium text-gray-700 pr-4 whitespace-nowrap">{{ __('Data processed') }}</td>
                            <td class="py-2 text-gray-600">{{ __('Name, e-mail address, phone number, company name, project communication, quotes, contractual data') }}</td>
                        </tr>
                        <tr class="border-b border-gray-100">
                            <td class="py-2 font-medium text-gray-700 pr-4 whitespace-nowrap">{{ __('Purpose') }}</td>
                            <td class="py-2 text-gray-600">{{ __('Recording customers and prospects, project tracking, communication') }}</td>
                        </tr>
                        <tr class="border-b border-gray-100">
                            <td class="py-2 font-medium text-gray-700 pr-4 whitespace-nowrap">{{ __('Legal basis') }}</td>
                            <td class="py-2 text-gray-600">{{ __('GDPR Article 6(1)(b) (contract performance) and (f) (legitimate interest: customer relationship management)') }}</td>
                        </tr>
                        <tr class="border-b border-gray-100">
                            <td class="py-2 font-medium text-gray-700 pr-4 whitespace-nowrap">{{ __('Retention period') }}</td>
                            <td class="py-2 text-gray-600">{{ __('5 years from termination of the business relationship') }}</td>
                        </tr>
                        <tr>
                            <td class="py-2 font-medium text-gray-700 pr-4 whitespace-nowrap">{{ __('System involved') }}</td>
                            <td class="py-2 text-gray-600">{{ __('Notion (see chapter 5)') }}</td>
                        </tr>
                    </tbody>
                </table>

                <h3 class="text-lg font-medium text-gray-800 mt-6 mb-3">{{ __('3.6. Cookies and web analytics') }}</h3>
                <p class="text-gray-600 leading-relaxed">
                    {!! __('Detailed information on the cookies and analytics tools used on the website is available in our <a href=":url" class="text-primary-500 hover:text-primary-600 underline">Cookie Policy</a>.', ['url' => route('legal.cookie-beallitasok')]) !!}
                </p>
                <table class="w-full text-sm">
                    <tbody>
                        <tr class="border-b border-gray-100">
                            <td class="py-2 font-medium text-gray-700 pr-4">{{ __('Technical (session) cookies') }}</td>
                            <td class="py-2 text-gray-600">{{ __('Legal basis: legitimate interest (GDPR Art. 6(f)); no consent required') }}</td>
                        </tr>
                        <tr class="border-b border-gray-100">
                            <td class="py-2 font-medium text-gray-700 pr-4">Google Analytics (_ga, _ga_*)</td>
                            <td class="py-2 text-gray-600">{{ __('Legal basis: consent (GDPR Art. 6(a)); transfer: Google LLC (under EU–US Data Privacy Framework and SCCs)') }}</td>
                        </tr>
                        <tr class="border-b border-gray-100">
                            <td class="py-2 font-medium text-gray-700 pr-4">Google Ads {{ __('conversion tracking') }} (_gcl_au)</td>
                            <td class="py-2 text-gray-600">{{ __('Legal basis: consent; transfer: Google LLC') }}</td>
                        </tr>
                        <tr>
                            <td class="py-2 font-medium text-gray-700 pr-4">Meta pixel (_fbp)</td>
                            <td class="py-2 text-gray-600">{{ __('Legal basis: consent; transfer: Meta Platforms Ireland Ltd.') }}</td>
                        </tr>
                    </tbody>
                </table>

                <h3 class="text-lg font-medium text-gray-800 mt-6 mb-3">{{ __('3.7. LinkedIn social media') }}</h3>
                <table class="w-full text-sm">
                    <tbody>
                        <tr class="border-b border-gray-100">
                            <td class="py-2 font-medium text-gray-700 pr-4 whitespace-nowrap">{{ __('Data processed') }}</td>
                            <td class="py-2 text-gray-600">{{ __('Publicly available LinkedIn profile data (if contact is initiated)') }}</td>
                        </tr>
                        <tr class="border-b border-gray-100">
                            <td class="py-2 font-medium text-gray-700 pr-4 whitespace-nowrap">{{ __('Purpose') }}</td>
                            <td class="py-2 text-gray-600">{{ __('B2B networking, business communication') }}</td>
                        </tr>
                        <tr class="border-b border-gray-100">
                            <td class="py-2 font-medium text-gray-700 pr-4 whitespace-nowrap">{{ __('Legal basis') }}</td>
                            <td class="py-2 text-gray-600">{{ __('GDPR Article 6(1)(f) (legitimate interest); LinkedIn\'s own data processing terms also apply') }}</td>
                        </tr>
                        <tr>
                            <td class="py-2 font-medium text-gray-700 pr-4 whitespace-nowrap">{{ __('Note') }}</td>
                            <td class="py-2 text-gray-600">{{ __('Data processing on our LinkedIn pages is governed by LinkedIn Ireland Unlimited Company\'s own privacy policy') }}</td>
                        </tr>
                    </tbody>
                </table>

                {{-- 4. Érintetti jogok --}}
                <h2 class="text-xl font-semibold text-gray-900 mt-10 mb-4">{{ __('4. Rights of data subjects') }}</h2>
                <p class="text-gray-600 leading-relaxed mb-3">{{ __('Under the GDPR, you may exercise the following rights regarding the processing of your data:') }}</p>
                <table class="w-full text-sm">
                    <tbody>
                        <tr class="border-b border-gray-100">
                            <td class="py-2 font-medium text-gray-700 pr-4">{{ __('Access (Article 15)') }}</td>
                            <td class="py-2 text-gray-600">{{ __('You may request information on what personal data Cégem 360 Kft. processes about you, the purposes and legal bases, recipients, and retention period') }}</td>
                        </tr>
                        <tr class="border-b border-gray-100">
                            <td class="py-2 font-medium text-gray-700 pr-4">{{ __('Rectification (Article 16)') }}</td>
                            <td class="py-2 text-gray-600">{{ __('You may request rectification of inaccurate or incomplete personal data') }}</td>
                        </tr>
                        <tr class="border-b border-gray-100">
                            <td class="py-2 font-medium text-gray-700 pr-4">{{ __('Erasure (Article 17)') }}</td>
                            <td class="py-2 text-gray-600">{{ __('You may request deletion of personal data if processing purpose has ended, consent is withdrawn, or your objection was successful') }}</td>
                        </tr>
                        <tr class="border-b border-gray-100">
                            <td class="py-2 font-medium text-gray-700 pr-4">{{ __('Restriction (Article 18)') }}</td>
                            <td class="py-2 text-gray-600">{{ __('You may request suspension of processing, e.g., when accuracy is contested') }}</td>
                        </tr>
                        <tr class="border-b border-gray-100">
                            <td class="py-2 font-medium text-gray-700 pr-4">{{ __('Data portability (Article 20)') }}</td>
                            <td class="py-2 text-gray-600">{{ __('In the case of consent-based or contract-based processing, you may request your data in machine-readable format') }}</td>
                        </tr>
                        <tr class="border-b border-gray-100">
                            <td class="py-2 font-medium text-gray-700 pr-4">{{ __('Objection (Article 21)') }}</td>
                            <td class="py-2 text-gray-600">{{ __('You may object at any time to processing based on legitimate interest (e.g., B2B marketing); upon objection we cease processing unless compelling legitimate grounds exist') }}</td>
                        </tr>
                        <tr>
                            <td class="py-2 font-medium text-gray-700 pr-4">{{ __('Withdrawal of consent') }}</td>
                            <td class="py-2 text-gray-600">{{ __('For consent-based processing (e.g., newsletter), consent can be withdrawn at any time; withdrawal does not affect lawfulness of prior processing') }}</td>
                        </tr>
                    </tbody>
                </table>
                <p class="text-gray-600 leading-relaxed mt-3">
                    {!! __('<strong>Submitting requests:</strong> To exercise your rights, contact us at <a href="mailto:tamas@cegem360.hu" class="text-primary-500 hover:text-primary-600">tamas@cegem360.hu</a>. We respond to incoming requests within <strong>30 days</strong> at the latest; in justified cases this may be extended to 60 days, of which we will notify you.') !!}
                </p>

                {{-- 5. Adatfeldolgozók --}}
                <h2 class="text-xl font-semibold text-gray-900 mt-10 mb-4">{{ __('5. Data processors and third parties') }}</h2>
                <p class="text-gray-600 leading-relaxed mb-3">{{ __('We share your personal data with the following processors only for the indicated purpose, to the extent necessary:') }}</p>

                <h3 class="text-lg font-medium text-gray-800 mt-6 mb-3">{{ __('5.1. Hosting provider') }}</h3>
                <table class="w-full text-sm">
                    <tbody>
                        <tr class="border-b border-gray-100">
                            <td class="py-2 font-medium text-gray-700 pr-4 whitespace-nowrap">{{ __('Company') }}</td>
                            <td class="py-2 text-gray-600">Tárhely.Eu Szolgáltató Korlátolt Felelősségű Társaság</td>
                        </tr>
                        <tr class="border-b border-gray-100">
                            <td class="py-2 font-medium text-gray-700 pr-4 whitespace-nowrap">{{ __('Registered office') }}</td>
                            <td class="py-2 text-gray-600">1144 Budapest, Ormánság utca 4. X. em. 241.</td>
                        </tr>
                        <tr class="border-b border-gray-100">
                            <td class="py-2 font-medium text-gray-700 pr-4 whitespace-nowrap">{{ __('Company reg. no.') }}</td>
                            <td class="py-2 text-gray-600">01-09-909968</td>
                        </tr>
                        <tr class="border-b border-gray-100">
                            <td class="py-2 font-medium text-gray-700 pr-4 whitespace-nowrap">{{ __('Tax number') }}</td>
                            <td class="py-2 text-gray-600">14571332-2-42</td>
                        </tr>
                        <tr class="border-b border-gray-100">
                            <td class="py-2 font-medium text-gray-700 pr-4 whitespace-nowrap">{{ __('Website') }}</td>
                            <td class="py-2 text-gray-600"><a href="https://tarhely.eu" target="_blank" class="text-primary-500 hover:text-primary-600">https://tarhely.eu</a></td>
                        </tr>
                        <tr class="border-b border-gray-100">
                            <td class="py-2 font-medium text-gray-700 pr-4">{{ __('Processing purpose') }}</td>
                            <td class="py-2 text-gray-600">{{ __('Hosting service for the website and e-mail infrastructure; the processor acts under a GDPR Article 28 data processing agreement') }}</td>
                        </tr>
                        <tr class="border-b border-gray-100">
                            <td class="py-2 font-medium text-gray-700 pr-4 whitespace-nowrap">{{ __('Data processed') }}</td>
                            <td class="py-2 text-gray-600">{{ __('All data stored on the web server (visitor log files, uploaded content, e-mail traffic)') }}</td>
                        </tr>
                        <tr>
                            <td class="py-2 font-medium text-gray-700 pr-4">{{ __('Storage country') }}</td>
                            <td class="py-2 text-gray-600">{{ __('Hungary (EU)') }}</td>
                        </tr>
                    </tbody>
                </table>

                <h3 class="text-lg font-medium text-gray-800 mt-6 mb-3">{{ __('5.2. Invoicing software') }}</h3>
                <table class="w-full text-sm">
                    <tbody>
                        <tr class="border-b border-gray-100">
                            <td class="py-2 font-medium text-gray-700 pr-4 whitespace-nowrap">{{ __('Company') }}</td>
                            <td class="py-2 text-gray-600">Billingo Technologies Zártkörűen Működő Részvénytársaság</td>
                        </tr>
                        <tr class="border-b border-gray-100">
                            <td class="py-2 font-medium text-gray-700 pr-4 whitespace-nowrap">{{ __('Registered office') }}</td>
                            <td class="py-2 text-gray-600">1031 Budapest, Záhony utca 7.</td>
                        </tr>
                        <tr class="border-b border-gray-100">
                            <td class="py-2 font-medium text-gray-700 pr-4 whitespace-nowrap">{{ __('Company reg. no.') }}</td>
                            <td class="py-2 text-gray-600">01-10-140802</td>
                        </tr>
                        <tr class="border-b border-gray-100">
                            <td class="py-2 font-medium text-gray-700 pr-4 whitespace-nowrap">{{ __('Tax number') }}</td>
                            <td class="py-2 text-gray-600">27926309-2-41</td>
                        </tr>
                        <tr class="border-b border-gray-100">
                            <td class="py-2 font-medium text-gray-700 pr-4 whitespace-nowrap">{{ __('Website') }}</td>
                            <td class="py-2 text-gray-600"><a href="https://billingo.hu" target="_blank" class="text-primary-500 hover:text-primary-600">https://billingo.hu</a></td>
                        </tr>
                        <tr class="border-b border-gray-100">
                            <td class="py-2 font-medium text-gray-700 pr-4">{{ __('Processing purpose') }}</td>
                            <td class="py-2 text-gray-600">{{ __('Issuance and storage of electronic invoices to fulfill accounting law obligations') }}</td>
                        </tr>
                        <tr class="border-b border-gray-100">
                            <td class="py-2 font-medium text-gray-700 pr-4 whitespace-nowrap">{{ __('Data processed') }}</td>
                            <td class="py-2 text-gray-600">{{ __('Billing name, address, tax number, e-mail address, ordered service, amount') }}</td>
                        </tr>
                        <tr>
                            <td class="py-2 font-medium text-gray-700 pr-4">{{ __('Storage country') }}</td>
                            <td class="py-2 text-gray-600">{{ __('EU (Amazon Web Services EMEA SARL, Luxembourg)') }}</td>
                        </tr>
                    </tbody>
                </table>

                <h3 class="text-lg font-medium text-gray-800 mt-6 mb-3">{{ __('5.3. Newsletter sending system') }}</h3>
                <table class="w-full text-sm">
                    <tbody>
                        <tr class="border-b border-gray-100">
                            <td class="py-2 font-medium text-gray-700 pr-4 whitespace-nowrap">{{ __('Company') }}</td>
                            <td class="py-2 text-gray-600">Zoho Corporation BV</td>
                        </tr>
                        <tr class="border-b border-gray-100">
                            <td class="py-2 font-medium text-gray-700 pr-4">{{ __('Registered office (EU representative)') }}</td>
                            <td class="py-2 text-gray-600">{{ __('Beneluxlaan 4B, 3527 HT Utrecht, Netherlands') }}</td>
                        </tr>
                        <tr class="border-b border-gray-100">
                            <td class="py-2 font-medium text-gray-700 pr-4 whitespace-nowrap">{{ __('Website') }}</td>
                            <td class="py-2 text-gray-600"><a href="https://www.zoho.com/campaigns/" target="_blank" class="text-primary-500 hover:text-primary-600">https://www.zoho.com/campaigns/</a></td>
                        </tr>
                        <tr class="border-b border-gray-100">
                            <td class="py-2 font-medium text-gray-700 pr-4 whitespace-nowrap">{{ __('DPO contact') }}</td>
                            <td class="py-2 text-gray-600"><a href="mailto:dpo@zohocorp.com" class="text-primary-500 hover:text-primary-600">dpo@zohocorp.com</a></td>
                        </tr>
                        <tr class="border-b border-gray-100">
                            <td class="py-2 font-medium text-gray-700 pr-4">{{ __('Processing purpose') }}</td>
                            <td class="py-2 text-gray-600">{{ __('Sending and managing e-mail newsletter campaigns (voluntary subscribers and B2B marketing lists)') }}</td>
                        </tr>
                        <tr class="border-b border-gray-100">
                            <td class="py-2 font-medium text-gray-700 pr-4 whitespace-nowrap">{{ __('Data processed') }}</td>
                            <td class="py-2 text-gray-600">{{ __('E-mail address, name, open and click statistics') }}</td>
                        </tr>
                        <tr>
                            <td class="py-2 font-medium text-gray-700 pr-4">{{ __('Transfer guarantee') }}</td>
                            <td class="py-2 text-gray-600">{!! __('EU–Zoho data processing takes place under EU Standard Contractual Clauses (SCC); Zoho operates an EU data center (GDPR DPA available at <a href="mailto:legal@zohocorp.com" class="text-primary-500 hover:text-primary-600">legal@zohocorp.com</a>)') !!}</td>
                        </tr>
                    </tbody>
                </table>

                <h3 class="text-lg font-medium text-gray-800 mt-6 mb-3">{{ __('5.4. Source of B2B marketing list') }}</h3>
                <table class="w-full text-sm">
                    <tbody>
                        <tr class="border-b border-gray-100">
                            <td class="py-2 font-medium text-gray-700 pr-4 whitespace-nowrap">{{ __('Company') }}</td>
                            <td class="py-2 text-gray-600">OPTEN Informatikai Korlátolt Felelősségű Társaság</td>
                        </tr>
                        <tr class="border-b border-gray-100">
                            <td class="py-2 font-medium text-gray-700 pr-4 whitespace-nowrap">{{ __('Registered office') }}</td>
                            <td class="py-2 text-gray-600">1138 Budapest, Népfürdő utca 22., Duna Tower, 'B' tower, 11th floor</td>
                        </tr>
                        <tr class="border-b border-gray-100">
                            <td class="py-2 font-medium text-gray-700 pr-4 whitespace-nowrap">{{ __('Tax number') }}</td>
                            <td class="py-2 text-gray-600">12012187-2-41</td>
                        </tr>
                        <tr class="border-b border-gray-100">
                            <td class="py-2 font-medium text-gray-700 pr-4 whitespace-nowrap">{{ __('Website') }}</td>
                            <td class="py-2 text-gray-600"><a href="https://opten.hu" target="_blank" class="text-primary-500 hover:text-primary-600">https://opten.hu</a></td>
                        </tr>
                        <tr class="border-b border-gray-100">
                            <td class="py-2 font-medium text-gray-700 pr-4 whitespace-nowrap">{{ __('Role') }}</td>
                            <td class="py-2 text-gray-600">{{ __('OPTEN Kft. provides a B2B marketing list based on the corporate registry and supplementary data of Hungarian businesses. OPTEN acts as an independent controller for its own activities; Cégem 360 Kft. uses the data only for B2B marketing.') }}</td>
                        </tr>
                        <tr>
                            <td class="py-2 font-medium text-gray-700 pr-4 whitespace-nowrap">{{ __('Legal basis') }}</td>
                            <td class="py-2 text-gray-600">{{ __('GDPR Article 6(1)(f) (legitimate interest — B2B direct marketing)') }}</td>
                        </tr>
                    </tbody>
                </table>

                <h3 class="text-lg font-medium text-gray-800 mt-6 mb-3">{{ __('5.5. CRM — Customer record-keeping') }}</h3>
                <table class="w-full text-sm">
                    <tbody>
                        <tr class="border-b border-gray-100">
                            <td class="py-2 font-medium text-gray-700 pr-4 whitespace-nowrap">{{ __('Company') }}</td>
                            <td class="py-2 text-gray-600">Notion Labs, Inc.</td>
                        </tr>
                        <tr class="border-b border-gray-100">
                            <td class="py-2 font-medium text-gray-700 pr-4 whitespace-nowrap">{{ __('Registered office') }}</td>
                            <td class="py-2 text-gray-600">2300 Harrison Street, San Francisco, CA 94110, USA</td>
                        </tr>
                        <tr class="border-b border-gray-100">
                            <td class="py-2 font-medium text-gray-700 pr-4 whitespace-nowrap">{{ __('Website') }}</td>
                            <td class="py-2 text-gray-600"><a href="https://www.notion.so/privacy" target="_blank" class="text-primary-500 hover:text-primary-600">https://www.notion.so/privacy</a></td>
                        </tr>
                        <tr class="border-b border-gray-100">
                            <td class="py-2 font-medium text-gray-700 pr-4">{{ __('Processing purpose') }}</td>
                            <td class="py-2 text-gray-600">{{ __('Recording customers and projects for internal CRM purposes') }}</td>
                        </tr>
                        <tr class="border-b border-gray-100">
                            <td class="py-2 font-medium text-gray-700 pr-4 whitespace-nowrap">{{ __('Data processed') }}</td>
                            <td class="py-2 text-gray-600">{{ __('Customer data: name, e-mail, phone number, company name, project notes') }}</td>
                        </tr>
                        <tr>
                            <td class="py-2 font-medium text-gray-700 pr-4">{{ __('Transfer guarantee') }}</td>
                            <td class="py-2 text-gray-600">{!! __('Notion ensures GDPR compliance under EU Standard Contractual Clauses (SCC); Notion GDPR DPA available at: <a href="https://www.notion.so/gdpr-dpa" target="_blank" class="text-primary-500 hover:text-primary-600">notion.so/gdpr-dpa</a>') !!}</td>
                        </tr>
                    </tbody>
                </table>

                <h3 class="text-lg font-medium text-gray-800 mt-6 mb-3">{{ __('5.6. Web analytics and advertising systems') }}</h3>
                <table class="w-full text-sm">
                    <thead>
                        <tr class="border-b border-gray-200">
                            <th class="py-2 text-left font-medium text-gray-700 pr-4">{{ __('Provider') }}</th>
                            <th class="py-2 text-left font-medium text-gray-700 pr-4">{{ __('Purpose') }}</th>
                            <th class="py-2 text-left font-medium text-gray-700">{{ __('Basis of transfer') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border-b border-gray-100">
                            <td class="py-2 text-gray-600 pr-4">Google LLC (USA)</td>
                            <td class="py-2 text-gray-600 pr-4">{{ __('Google Analytics (visitor stats), Google Ads (conversion tracking)') }}</td>
                            <td class="py-2 text-gray-600">{{ __('EU–US Data Privacy Framework (DPF) and Standard Contractual Clauses') }}</td>
                        </tr>
                        <tr class="border-b border-gray-100">
                            <td class="py-2 text-gray-600 pr-4">Meta Platforms Ireland Ltd. (Ireland / USA)</td>
                            <td class="py-2 text-gray-600 pr-4">{{ __('Meta pixel (ad effectiveness measurement)') }}</td>
                            <td class="py-2 text-gray-600">{{ __('Standard Contractual Clauses') }}</td>
                        </tr>
                        <tr>
                            <td class="py-2 text-gray-600 pr-4">LinkedIn Ireland Unlimited Company (Ireland)</td>
                            <td class="py-2 text-gray-600 pr-4">{{ __('LinkedIn company page management') }}</td>
                            <td class="py-2 text-gray-600">{{ __('EU member-state controller; LinkedIn\'s own privacy policy applies') }}</td>
                        </tr>
                    </tbody>
                </table>

                <h3 class="text-lg font-medium text-gray-800 mt-6 mb-3">{{ __('5.7. Legal representation') }}</h3>
                <table class="w-full text-sm">
                    <tbody>
                        <tr class="border-b border-gray-100">
                            <td class="py-2 font-medium text-gray-700 pr-4 whitespace-nowrap">{{ __('Law firm') }}</td>
                            <td class="py-2 text-gray-600">Bangó Ügyvédi Iroda</td>
                        </tr>
                        <tr class="border-b border-gray-100">
                            <td class="py-2 font-medium text-gray-700 pr-4 whitespace-nowrap">{{ __('Lead attorney') }}</td>
                            <td class="py-2 text-gray-600">Dr. Bangó Zoltán</td>
                        </tr>
                        <tr class="border-b border-gray-100">
                            <td class="py-2 font-medium text-gray-700 pr-4 whitespace-nowrap">{{ __('Registered office') }}</td>
                            <td class="py-2 text-gray-600">1052 Budapest, Szervita tér 8.</td>
                        </tr>
                        <tr class="border-b border-gray-100">
                            <td class="py-2 font-medium text-gray-700 pr-4 whitespace-nowrap">{{ __('Phone') }}</td>
                            <td class="py-2 text-gray-600">+36 30 910 5293</td>
                        </tr>
                        <tr class="border-b border-gray-100">
                            <td class="py-2 font-medium text-gray-700 pr-4 whitespace-nowrap">{{ __('Website') }}</td>
                            <td class="py-2 text-gray-600"><a href="https://www.bango-lawfirm.com" target="_blank" class="text-primary-500 hover:text-primary-600">https://www.bango-lawfirm.com</a></td>
                        </tr>
                        <tr>
                            <td class="py-2 font-medium text-gray-700 pr-4 whitespace-nowrap">{{ __('Note') }}</td>
                            <td class="py-2 text-gray-600">{{ __('The law firm accesses personal data under attorney-client privilege, only to the extent necessary for legal representation') }}</td>
                        </tr>
                    </tbody>
                </table>

                {{-- 6. Adatbiztonság --}}
                <h2 class="text-xl font-semibold text-gray-900 mt-10 mb-4">{{ __('6. Data security') }}</h2>
                <p class="text-gray-600 leading-relaxed">
                    {{ __('Under GDPR Article 32, Cégem 360 Kft. applies appropriate technical and organizational measures to protect personal data, including:') }}
                </p>
                <ul class="list-disc pl-5 space-y-1 text-gray-600">
                    <li>{{ __('SSL/TLS encryption on the website and in e-mail communication') }}</li>
                    <li>{{ __('Access control: only authorized employees may access personal data') }}</li>
                    <li>{{ __('Regular security backups') }}</li>
                    <li>{{ __('Strong password management and two-factor authentication on the relevant systems') }}</li>
                    <li>{{ __('Data processing agreements with processors (GDPR Article 28)') }}</li>
                </ul>
                <p class="text-gray-600 leading-relaxed mt-3">
                    {{ __('In case of a personal data breach, our company notifies the NAIH within 72 hours under GDPR Article 33, where the breach is likely to result in a risk to the rights and freedoms of natural persons.') }}
                </p>

                {{-- 7. Adattovábbítás --}}
                <h2 class="text-xl font-semibold text-gray-900 mt-10 mb-4">{{ __('7. Data transfer to third countries') }}</h2>
                <p class="text-gray-600 leading-relaxed">
                    {{ __('Some processors (Google, Meta, Notion, Zoho) may store or process data outside the European Economic Area (EEA), particularly in the United States. Our company ensures the lawfulness of such transfers through the following mechanisms:') }}
                </p>
                <ul class="list-disc pl-5 space-y-1 text-gray-600">
                    <li>{!! __('<strong>EU Standard Contractual Clauses (SCC)</strong> — contractual safeguards approved by the EU Commission (Zoho, Notion)') !!}</li>
                    <li>{!! __('<strong>EU–US Data Privacy Framework (DPF)</strong> — for Google and Meta, which are certified participants of the framework') !!}</li>
                </ul>

                {{-- 8. Jogorvoslat --}}
                <h2 class="text-xl font-semibold text-gray-900 mt-10 mb-4">{{ __('8. Remedies') }}</h2>
                <p class="text-gray-600 leading-relaxed mb-3">
                    {{ __('If you believe your rights have been infringed in connection with the processing of your personal data, or your request has not been fulfilled adequately, the following options are available:') }}
                </p>

                <h3 class="text-lg font-medium text-gray-800 mt-6 mb-3">{{ __('Supervisory authority') }}</h3>
                <table class="w-full text-sm">
                    <tbody>
                        <tr class="border-b border-gray-100">
                            <td class="py-2 font-medium text-gray-700 pr-4 whitespace-nowrap">{{ __('Authority name') }}</td>
                            <td class="py-2 text-gray-600">{{ __('Hungarian National Authority for Data Protection and Freedom of Information (NAIH)') }}</td>
                        </tr>
                        <tr class="border-b border-gray-100">
                            <td class="py-2 font-medium text-gray-700 pr-4 whitespace-nowrap">{{ __('Postal address') }}</td>
                            <td class="py-2 text-gray-600">1363 Budapest, Pf. 9.</td>
                        </tr>
                        <tr class="border-b border-gray-100">
                            <td class="py-2 font-medium text-gray-700 pr-4 whitespace-nowrap">{{ __('Visiting address') }}</td>
                            <td class="py-2 text-gray-600">1055 Budapest, Falk Miksa utca 9–11.</td>
                        </tr>
                        <tr class="border-b border-gray-100">
                            <td class="py-2 font-medium text-gray-700 pr-4 whitespace-nowrap">{{ __('Phone') }}</td>
                            <td class="py-2 text-gray-600">+36 1 391 1400</td>
                        </tr>
                        <tr class="border-b border-gray-100">
                            <td class="py-2 font-medium text-gray-700 pr-4 whitespace-nowrap">{{ __('E-mail') }}</td>
                            <td class="py-2 text-gray-600"><a href="mailto:ugyfelszolgalat@naih.hu" class="text-primary-500 hover:text-primary-600">ugyfelszolgalat@naih.hu</a></td>
                        </tr>
                        <tr>
                            <td class="py-2 font-medium text-gray-700 pr-4 whitespace-nowrap">{{ __('Website') }}</td>
                            <td class="py-2 text-gray-600"><a href="https://naih.hu" target="_blank" class="text-primary-500 hover:text-primary-600">https://naih.hu</a></td>
                        </tr>
                    </tbody>
                </table>

                <h3 class="text-lg font-medium text-gray-800 mt-6 mb-3">{{ __('Judicial remedy') }}</h3>
                <p class="text-gray-600 leading-relaxed">
                    {{ __('You may also turn to court against the controller under Section 22 of the Hungarian Infotv. and the Civil Code. The action may also be brought before the regional court competent at your place of residence or stay.') }}
                </p>

                <h3 class="text-lg font-medium text-gray-800 mt-6 mb-3">{{ __('Our legal representation') }}</h3>
                <p class="text-gray-600 leading-relaxed">
                    {!! __('You may submit your legal claims directly to Bangó Ügyvédi Iroda (1052 Budapest, Szervita tér 8.; phone: +36 30 910 5293; <a href="https://www.bango-lawfirm.com" target="_blank" class="text-primary-500 hover:text-primary-600">bango-lawfirm.com</a>).') !!}
                </p>

                {{-- 9. Módosítás --}}
                <h2 class="text-xl font-semibold text-gray-900 mt-10 mb-4">{{ __('9. Amendments to this notice') }}</h2>
                <p class="text-gray-600 leading-relaxed">
                    {{ __('Cégem 360 Kft. reserves the right to amend this notice at any time. The amended notice enters into force on publication on the website. In the case of significant amendments, newsletter subscribers will be notified by e-mail.') }}
                </p>
                <p class="text-gray-600 leading-relaxed">
                    {!! __('Earlier versions: archived versions are available on request at <a href="mailto:info@cegem360.hu" class="text-primary-500 hover:text-primary-600">info@cegem360.hu</a>.') !!}
                </p>

            </div>

            <p class="mt-16 text-center text-sm text-gray-400">
                &copy; {{ date('Y') }} Cégem 360 Kft. &nbsp;|&nbsp;
                {{ __('Effective: :date', ['date' => \App\Enums\LegalDocument::PrivacyPolicy->effectiveAt()->locale(app()->getLocale())->translatedFormat(__('j F Y'))]) }}
                &nbsp;|&nbsp;
                <a href="{{ route('legal.impresszum') }}" class="hover:text-gray-600">{{ __('Imprint') }}</a> &nbsp;|&nbsp;
                <a href="{{ route('legal.cookie-beallitasok') }}" class="hover:text-gray-600">{{ __('Cookie Policy') }}</a> &nbsp;|&nbsp;
                <a href="{{ route('legal.szolgaltatasi-feltetelek') }}" class="hover:text-gray-600">{{ __('General Terms and Conditions') }}</a>
            </p>

            <div class="mt-10 text-center">
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
