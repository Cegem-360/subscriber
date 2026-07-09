@php
    /** @var string $name */
    /** @var string $verificationUrl */
    /** @var int $expireMinutes */
    $greetingName = $name !== '' ? $name : 'Felhasználó';
@endphp
<div style="background-color:#f6f7fb;padding:24px 0;font-family:Poppins,Arial,sans-serif;">
    <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="max-width:640px;margin:0 auto;background-color:#ffffff;border-radius:16px;overflow:hidden;">
        <tbody>
            {{-- Header --}}
            <tr>
                <td style="padding:28px 40px 0;">
                    <img src="https://hirlevel.cegem360.hu/wp-content/uploads/2026/03/logo.png" alt="cégem360 — hello web+marketing" width="200" style="display:block;height:auto;border:0;outline:none;">
                    <div style="height:3px;margin-top:20px;background:linear-gradient(90deg,#6161ff 0%,#8280ff 40%,#a78bfa 70%,#ec4899 100%);border-radius:2px;"></div>
                </td>
            </tr>

            {{-- Greeting --}}
            <tr>
                <td style="padding:36px 40px 32px;">
                    <span style="display:inline-block;padding:6px 16px;border-radius:20px;border:2px solid #6161ff;background-color:#f0f0ff;font-size:11px;font-weight:700;color:#6161ff;text-transform:uppercase;letter-spacing:2px;">✉️ E-mail megerősítés</span>
                    <h1 style="margin:20px 0 16px;font-size:28px;line-height:1.3;color:#0f0f23;">
                        Kedves <span style="color:#6161ff;">{{ $greetingName }}</span>!
                    </h1>
                    <p style="margin:0;font-size:15px;line-height:1.7;color:#1a1a2e;">
                        Köszönjük a regisztrációt a <strong style="color:#0f0f23;">Cégem 360</strong> platformon! A fiók aktiválásához kérjük, erősítse meg e-mail címét az alábbi gombra kattintva.
                    </p>
                </td>
            </tr>

            {{-- Verification action --}}
            <tr>
                <td style="padding:0 40px 28px;">
                    <h2 style="margin:0 0 4px;font-size:20px;color:#0f0f23;">E-mail cím megerősítése</h2>
                    <div style="width:40px;height:3px;background-color:#6161ff;border-radius:2px;margin-bottom:16px;"></div>

                    <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="background-color:#0f0f23;border-radius:12px;overflow:hidden;margin-bottom:20px;">
                        <tbody>
                            <tr>
                                <td style="padding:24px 26px;">
                                    <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0">
                                        <tbody>
                                            <tr>
                                                <td valign="middle">
                                                    <p style="margin:0 0 2px;font-size:11px;font-weight:600;color:#6b7280;letter-spacing:1px;text-transform:uppercase;">Platform</p>
                                                    <p style="margin:0 0 4px;font-size:16px;font-weight:700;color:#ffffff;">Cégem 360 Platform</p>
                                                    <p style="margin:0;font-size:13px;color:#a5b4fc;">Fiók aktiválása</p>
                                                </td>
                                                <td align="right" valign="middle">
                                                    <a href="{{ $verificationUrl }}" style="display:inline-block;padding:12px 26px;border-radius:8px;background:linear-gradient(135deg,#6161ff,#ec4899);font-size:14px;font-weight:700;color:#ffffff;text-decoration:none;" target="_blank">E-mail megerősítése →</a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    {{-- Expiry / fallback --}}
                    <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="background-color:#f6f7fb;border-radius:12px;border:1px solid #e5e7eb;">
                        <tbody>
                            <tr>
                                <td style="padding:20px 24px;">
                                    <p style="margin:0 0 10px;font-size:13px;line-height:1.6;color:#1a1a2e;">
                                        ⏱️ Ez a link biztonsági okból <strong style="color:#0f0f23;">{{ $expireMinutes }} percig</strong> érvényes.
                                    </p>
                                    <p style="margin:0 0 6px;font-size:12px;color:#6b7280;">Ha a gomb nem működik, másolja be az alábbi linket a böngészőbe:</p>
                                    <p style="margin:0;font-family:'Courier New',monospace;font-size:12px;color:#6161ff;word-break:break-all;background-color:#ffffff;border:1px solid #e5e7eb;border-radius:6px;padding:8px 12px;">{{ $verificationUrl }}</p>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <p style="margin:16px 0 0;font-size:12px;line-height:1.6;color:#6b7280;">Ha nem Ön hozott létre fiókot a Cégem 360 platformon, nincs teendője — nyugodtan hagyja figyelmen kívül ezt az üzenetet.</p>
                </td>
            </tr>

            {{-- Footer / signature --}}
            <tr>
                <td style="padding:24px 40px 32px;border-top:1px solid #e5e7eb;">
                    <p style="margin:0 0 4px;font-size:14px;font-weight:700;color:#0f0f23;">Cégem 360 Kft.</p>
                    <p style="margin:0;font-size:12px;line-height:1.6;color:#6b7280;">
                        1051 Budapest, Széchenyi István tér 7-8.<br>
                        <a href="mailto:support@cegem360.eu" style="color:#6161ff;text-decoration:none;">support@cegem360.eu</a><br>
                        <a href="https://cegem360.hu/" style="color:#6161ff;text-decoration:none;" target="_blank">cegem360.hu</a>
                    </p>
                </td>
            </tr>
        </tbody>
    </table>
</div>
