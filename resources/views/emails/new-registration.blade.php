@php
    /** @var \App\Models\User $user */
    /** @var string $adminUrl */

    $rows = [
        'Név' => $user->name,
        'E-mail' => $user->email,
        'Telefon' => $user->phone,
        'Cégnév' => $user->company_name,
        'Adószám' => $user->tax_number,
        'Cím' => trim(implode(' ', array_filter([$user->postal_code, $user->city])) . ', ' . $user->address, ' ,'),
        'Ország' => \App\Enums\Country::tryFrom((string) $user->country)?->getLabel() ?? $user->country,
        'Regisztrált' => $user->created_at?->timezone(config('app.timezone'))->format('Y-m-d H:i'),
    ];
@endphp
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Új regisztráció</title>
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
                                Új regisztráció
                            </h1>
                            <p style="margin:10px 0 0 0; color:#d1d5db; font-size:15px;">
                                Új ügyfél regisztrált a weboldalon.
                            </p>
                        </td>
                    </tr>

                    {{-- Details --}}
                    <tr>
                        <td style="padding: 32px;">
                            <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background-color:#f9fafb; border-radius:12px; padding:4px;">
                                @foreach (array_filter($rows, fn (?string $value): bool => filled($value)) as $label => $value)
                                    <tr>
                                        <td style="padding:12px 16px; {{ $loop->last ? '' : 'border-bottom:1px solid #e5e7eb;' }} width:40%; font-size:14px; color:#6b7280; font-weight:500;">{{ $label }}</td>
                                        <td style="padding:12px 16px; {{ $loop->last ? '' : 'border-bottom:1px solid #e5e7eb;' }} font-size:14px; color:#111827; font-weight:600;">
                                            @if ($label === 'E-mail')
                                                <a href="mailto:{{ $value }}" style="color:#4f46e5; text-decoration:none; font-weight:600;">{{ $value }}</a>
                                            @else
                                                {{ $value }}
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </table>

                            {{-- CTA --}}
                            <div style="margin-top:32px; text-align:center;">
                                <a href="{{ $adminUrl }}" style="display:inline-block; background-color:#4f46e5; color:#ffffff; text-decoration:none; font-weight:600; font-size:15px; padding:14px 28px; border-radius:10px;">
                                    Megnyitás az adminban
                                </a>
                            </div>
                        </td>
                    </tr>

                    {{-- Footer --}}
                    <tr>
                        <td style="background-color:#f9fafb; padding:20px 32px; text-align:center; border-top:1px solid #e5e7eb;">
                            <p style="margin:0; font-size:12px; color:#6b7280;">
                                Ez az értesítés automatikusan generált a Cégem360 regisztrációs űrlapjából.
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
