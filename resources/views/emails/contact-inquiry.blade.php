@php
    /** @var string $source */
    /** @var array<string, mixed> $data */

    $isPricing = $source === 'pricing';
    $title = $isPricing ? 'Új árajánlatkérés' : 'Új kapcsolatfelvétel';
    $subtitle = $isPricing
        ? 'Árajánlatkérés érkezett a weboldalról.'
        : 'Új megkeresés érkezett a kapcsolati űrlapon keresztül.';

    $inquiryTypeLabels = [
        'demo' => 'Demo kérés',
        'quote' => 'Árajánlatkérés',
        'support' => 'Technikai támogatás',
        'partnership' => 'Partnerség',
        'other' => 'Egyéb',
    ];

    $moduleLabels = [
        'crm' => 'CRM',
        'kontrolling' => 'Kontrolling',
        'beszerzes' => 'Beszerzés & Logisztika',
        'beszerzes-logisztika' => 'Beszerzés & Logisztika',
        'ertekesites' => 'Értékesítés',
        'gyartas' => 'Gyártásirányítás',
        'gyartasiranyitas' => 'Gyártásirányítás',
        'automatizalas' => 'Automatizálás',
        'szerviz' => 'Digitális szerviz munkalap',
        'data-mind' => 'DataMind',
        'marketinghub' => 'MarketingHub',
        'seo-and-stat-ai-assisstant' => 'SEO & analitika AI asszisztens',
    ];

    $companySizeLabels = [
        '1-10' => '1-10 fő',
        '11-50' => '11-50 fő',
        '51-200' => '51-200 fő',
        '201-500' => '201-500 fő',
        '500+' => '500+ fő',
    ];

    $firstName = (string) ($data['firstName'] ?? '');
    $lastName = (string) ($data['lastName'] ?? '');
    $fullName = trim($lastName.' '.$firstName);
    $email = (string) ($data['email'] ?? '');
    $phone = (string) ($data['phone'] ?? '');
    $company = (string) ($data['company'] ?? '');
    $position = (string) ($data['position'] ?? '');
    $companySize = (string) ($data['companySize'] ?? '');
    $inquiryType = (string) ($data['inquiryType'] ?? '');
    $message = (string) ($data['message'] ?? '');
    $interestedModules = is_array($data['interestedModules'] ?? null) ? $data['interestedModules'] : [];
    $privacyAccepted = (bool) ($data['privacyAccepted'] ?? false);
    $newsletterSubscribe = (bool) ($data['newsletterSubscribe'] ?? false);
@endphp
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
</head>
<body style="margin:0; padding:0; background-color:#f9fafb; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif; color:#111827;">
    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background-color:#f9fafb; padding: 32px 16px;">
        <tr>
            <td align="center">
                <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="max-width:640px; background-color:#ffffff; border-radius:16px; overflow:hidden; box-shadow:0 1px 3px rgba(0,0,0,0.05);">
                    {{-- Header --}}
                    <tr>
                        <td style="background: linear-gradient(to bottom, #111827, #1f2937); padding: 32px 32px 28px 32px; text-align:center;">
                            <div style="display:inline-block; background-color: rgba(99,102,241,0.2); color:#a5b4fc; font-size:13px; font-weight:500; padding:6px 14px; border-radius:9999px; margin-bottom:16px;">
                                Cégem360
                            </div>
                            <h1 style="margin:0; color:#ffffff; font-size:26px; font-weight:700; letter-spacing:-0.02em;">
                                {{ $title }}
                            </h1>
                            <p style="margin:10px 0 0 0; color:#d1d5db; font-size:15px;">
                                {{ $subtitle }}
                            </p>
                        </td>
                    </tr>

                    {{-- Contact Info --}}
                    <tr>
                        <td style="padding: 32px;">
                            <h2 style="margin:0 0 16px 0; font-size:18px; font-weight:600; color:#111827;">Kapcsolattartó</h2>
                            <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background-color:#f9fafb; border-radius:12px; padding:4px;">
                                @if ($fullName !== '')
                                    <tr>
                                        <td style="padding:12px 16px; border-bottom:1px solid #e5e7eb; width:40%; font-size:14px; color:#6b7280; font-weight:500;">Név</td>
                                        <td style="padding:12px 16px; border-bottom:1px solid #e5e7eb; font-size:14px; color:#111827; font-weight:600;">{{ $fullName }}</td>
                                    </tr>
                                @endif
                                @if ($email !== '')
                                    <tr>
                                        <td style="padding:12px 16px; border-bottom:1px solid #e5e7eb; font-size:14px; color:#6b7280; font-weight:500;">E-mail</td>
                                        <td style="padding:12px 16px; border-bottom:1px solid #e5e7eb; font-size:14px;">
                                            <a href="mailto:{{ $email }}" style="color:#4f46e5; text-decoration:none; font-weight:600;">{{ $email }}</a>
                                        </td>
                                    </tr>
                                @endif
                                @if ($phone !== '')
                                    <tr>
                                        <td style="padding:12px 16px; border-bottom:1px solid #e5e7eb; font-size:14px; color:#6b7280; font-weight:500;">Telefon</td>
                                        <td style="padding:12px 16px; border-bottom:1px solid #e5e7eb; font-size:14px;">
                                            <a href="tel:{{ $phone }}" style="color:#4f46e5; text-decoration:none; font-weight:600;">{{ $phone }}</a>
                                        </td>
                                    </tr>
                                @endif
                                @if ($company !== '')
                                    <tr>
                                        <td style="padding:12px 16px; border-bottom:1px solid #e5e7eb; font-size:14px; color:#6b7280; font-weight:500;">Cégnév</td>
                                        <td style="padding:12px 16px; border-bottom:1px solid #e5e7eb; font-size:14px; color:#111827; font-weight:600;">{{ $company }}</td>
                                    </tr>
                                @endif
                                @if ($position !== '')
                                    <tr>
                                        <td style="padding:12px 16px; border-bottom:1px solid #e5e7eb; font-size:14px; color:#6b7280; font-weight:500;">Pozíció</td>
                                        <td style="padding:12px 16px; border-bottom:1px solid #e5e7eb; font-size:14px; color:#111827; font-weight:600;">{{ $position }}</td>
                                    </tr>
                                @endif
                                @if ($companySize !== '')
                                    <tr>
                                        <td style="padding:12px 16px; border-bottom:1px solid #e5e7eb; font-size:14px; color:#6b7280; font-weight:500;">Cégméret</td>
                                        <td style="padding:12px 16px; border-bottom:1px solid #e5e7eb; font-size:14px; color:#111827; font-weight:600;">{{ $companySizeLabels[$companySize] ?? $companySize }}</td>
                                    </tr>
                                @endif
                                @if ($inquiryType !== '')
                                    <tr>
                                        <td style="padding:12px 16px; font-size:14px; color:#6b7280; font-weight:500;">Megkeresés típusa</td>
                                        <td style="padding:12px 16px; font-size:14px;">
                                            <span style="display:inline-block; background-color:#eef2ff; color:#4338ca; font-size:13px; font-weight:600; padding:4px 12px; border-radius:9999px;">
                                                {{ $inquiryTypeLabels[$inquiryType] ?? $inquiryType }}
                                            </span>
                                        </td>
                                    </tr>
                                @endif
                            </table>

                            {{-- Interested Modules --}}
                            @if (! empty($interestedModules))
                                <h2 style="margin:28px 0 16px 0; font-size:18px; font-weight:600; color:#111827;">Érdeklődési körök</h2>
                                <div style="background-color:#f9fafb; border-radius:12px; padding:16px;">
                                    @foreach ($interestedModules as $module)
                                        <span style="display:inline-block; background-color:#eef2ff; color:#4338ca; font-size:13px; font-weight:600; padding:6px 14px; border-radius:9999px; margin:4px 4px 4px 0;">
                                            {{ $moduleLabels[$module] ?? $module }}
                                        </span>
                                    @endforeach
                                </div>
                            @endif

                            {{-- Message --}}
                            @if ($message !== '')
                                <h2 style="margin:28px 0 16px 0; font-size:18px; font-weight:600; color:#111827;">Üzenet</h2>
                                <div style="background-color:#f9fafb; border-left:4px solid #4f46e5; border-radius:8px; padding:20px; font-size:15px; line-height:1.6; color:#374151; white-space:pre-wrap;">{{ $message }}</div>
                            @endif

                            {{-- Flags --}}
                            <h2 style="margin:28px 0 16px 0; font-size:18px; font-weight:600; color:#111827;">Egyebek</h2>
                            <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background-color:#f9fafb; border-radius:12px; padding:4px;">
                                <tr>
                                    <td style="padding:12px 16px; border-bottom:1px solid #e5e7eb; width:60%; font-size:14px; color:#6b7280; font-weight:500;">Adatvédelmi nyilatkozat elfogadva</td>
                                    <td style="padding:12px 16px; border-bottom:1px solid #e5e7eb; font-size:14px; color:{{ $privacyAccepted ? '#059669' : '#dc2626' }}; font-weight:600;">
                                        {{ $privacyAccepted ? 'Igen' : 'Nem' }}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding:12px 16px; font-size:14px; color:#6b7280; font-weight:500;">Hírlevél feliratkozás</td>
                                    <td style="padding:12px 16px; font-size:14px; color:{{ $newsletterSubscribe ? '#059669' : '#6b7280' }}; font-weight:600;">
                                        {{ $newsletterSubscribe ? 'Igen' : 'Nem' }}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding:12px 16px; border-top:1px solid #e5e7eb; font-size:14px; color:#6b7280; font-weight:500;">Forrás</td>
                                    <td style="padding:12px 16px; border-top:1px solid #e5e7eb; font-size:14px; color:#111827; font-weight:600;">
                                        {{ $isPricing ? 'Árazás oldal' : 'Kapcsolat oldal' }}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding:12px 16px; border-top:1px solid #e5e7eb; font-size:14px; color:#6b7280; font-weight:500;">Beküldve</td>
                                    <td style="padding:12px 16px; border-top:1px solid #e5e7eb; font-size:14px; color:#111827; font-weight:600;">
                                        {{ now()->format('Y-m-d H:i') }}
                                    </td>
                                </tr>
                            </table>

                            {{-- CTA --}}
                            @if ($email !== '')
                                <div style="margin-top:32px; text-align:center;">
                                    <a href="mailto:{{ $email }}" style="display:inline-block; background-color:#4f46e5; color:#ffffff; text-decoration:none; font-weight:600; font-size:15px; padding:14px 28px; border-radius:10px;">
                                        Válasz a feladónak
                                    </a>
                                </div>
                            @endif
                        </td>
                    </tr>

                    {{-- Footer --}}
                    <tr>
                        <td style="background-color:#f9fafb; padding:20px 32px; text-align:center; border-top:1px solid #e5e7eb;">
                            <p style="margin:0; font-size:12px; color:#6b7280;">
                                Ez az értesítés automatikusan generált a Cégem360 weboldalon beküldött űrlapból.
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
