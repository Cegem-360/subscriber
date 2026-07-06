@php
    /** @var string $name */
    /** @var string $email */
    /** @var string $password */
    /** @var string $loginUrl */
    /** @var array<int, array{name: string, url: ?string, icon: ?string}> $modules */
    $hasModules = $modules !== [];
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
                    <span style="display:inline-block;padding:6px 16px;border-radius:20px;border:2px solid #6161ff;background-color:#f0f0ff;font-size:11px;font-weight:700;color:#6161ff;text-transform:uppercase;letter-spacing:2px;">⚡ Modulhozzáférés értesítő</span>
                    <h1 style="margin:20px 0 16px;font-size:28px;line-height:1.3;color:#0f0f23;">
                        Kedves <span style="color:#6161ff;">{{ $name }}</span>!
                    </h1>
                    <p style="margin:0;font-size:15px;line-height:1.7;color:#1a1a2e;">
                        Örömmel értesítjük, hogy <strong style="color:#0f0f23;">Cégem 360 fiókja elkészült</strong>{{ $hasModules ? ' és az alábbi modulok már elérhetők az Ön számára' : '' }}. Az alábbiakban megtalálja a belépési adatokat{{ $hasModules ? ' és a közvetlen elérési linkeket' : '' }}.
                    </p>
                </td>
            </tr>

            {{-- Central account --}}
            <tr>
                <td style="padding:0 40px 28px;">
                    <h2 style="margin:0 0 4px;font-size:20px;color:#0f0f23;">Központi fiók</h2>
                    <div style="width:40px;height:3px;background-color:#6161ff;border-radius:2px;margin-bottom:16px;"></div>

                    <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="background-color:#0f0f23;border-radius:12px;overflow:hidden;margin-bottom:20px;">
                        <tbody>
                            <tr>
                                <td style="padding:22px 26px;">
                                    <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0">
                                        <tbody>
                                            <tr>
                                                <td valign="middle">
                                                    <p style="margin:0 0 2px;font-size:11px;font-weight:600;color:#6b7280;letter-spacing:1px;text-transform:uppercase;">Platform</p>
                                                    <p style="margin:0 0 4px;font-size:16px;font-weight:700;color:#ffffff;">Cégem 360 Platform</p>
                                                    <a href="{{ $loginUrl }}" style="font-size:13px;color:#a5b4fc;text-decoration:none;" target="_blank">Belépés a platformra</a>
                                                </td>
                                                <td align="right" valign="middle">
                                                    <a href="{{ $loginUrl }}" style="display:inline-block;padding:10px 22px;border-radius:8px;background:linear-gradient(135deg,#6161ff,#ec4899);font-size:13px;font-weight:700;color:#ffffff;text-decoration:none;" target="_blank">Belépés →</a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    {{-- Credentials --}}
                    <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="background-color:#f6f7fb;border-radius:12px;border:1px solid #e5e7eb;">
                        <tbody>
                            <tr>
                                <td style="padding:20px 24px;">
                                    <p style="margin:0 0 14px;font-size:14px;font-weight:700;color:#0f0f23;">🔐 Belépési adatok{{ $hasModules ? ' — minden modulhoz azonos' : '' }}</p>
                                    <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-bottom:8px;">
                                        <tbody>
                                            <tr>
                                                <td width="80" style="font-size:11px;font-weight:600;color:#6b7280;text-transform:uppercase;letter-spacing:0.8px;padding:8px 0;">E-mail</td>
                                                <td style="font-family:'Courier New',monospace;font-size:14px;font-weight:600;color:#0f0f23;background-color:#ffffff;border:1px solid #e5e7eb;border-radius:6px;padding:6px 12px;">{{ $email }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0">
                                        <tbody>
                                            <tr>
                                                <td width="80" style="font-size:11px;font-weight:600;color:#6b7280;text-transform:uppercase;letter-spacing:0.8px;padding:8px 0;">Jelszó</td>
                                                <td style="font-family:'Courier New',monospace;font-size:14px;font-weight:600;color:#7c3aed;background-color:#ffffff;border:1px solid #e5e7eb;border-radius:6px;padding:6px 12px;">{{ $password }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <p style="margin:14px 0 0;font-size:12px;color:#6b7280;">Biztonsági okból javasoljuk, hogy az első belépés után változtassa meg a jelszavát.</p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>

            {{-- Active modules --}}
            @if ($hasModules)
                <tr>
                    <td style="padding:0 40px 28px;">
                        <h2 style="margin:0 0 4px;font-size:20px;color:#0f0f23;">⚡ Az Ön aktív moduljai</h2>
                        <div style="width:40px;height:3px;background-color:#6161ff;border-radius:2px;margin-bottom:18px;"></div>

                        @foreach ($modules as $module)
                            <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-bottom:10px;">
                                <tbody>
                                    <tr>
                                        <td style="padding:14px 18px;border:1.5px solid #e5e7eb;border-left:4px solid #6161ff;border-radius:10px;">
                                            <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0">
                                                <tbody>
                                                    <tr>
                                                        <td width="36" valign="middle" style="font-size:20px;padding-right:14px;">{{ $module['icon'] ?: '⚡' }}</td>
                                                        <td valign="middle">
                                                            <p style="margin:0 0 2px;font-size:14px;font-weight:700;color:#0f0f23;">{{ $module['name'] }}</p>
                                                            @if (! empty($module['url']))
                                                                <a href="{{ $module['url'] }}" style="font-size:12px;color:#6161ff;text-decoration:none;" target="_blank">{{ preg_replace('#^https?://#', '', rtrim($module['url'], '/')) }}</a>
                                                            @endif
                                                        </td>
                                                        @if (! empty($module['url']))
                                                            <td align="right" valign="middle">
                                                                <a href="{{ $module['url'] }}" style="font-size:14px;color:#6161ff;text-decoration:none;" target="_blank">►</a>
                                                            </td>
                                                        @endif
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        @endforeach
                    </td>
                </tr>
            @endif

            {{-- Footer / signature --}}
            <tr>
                <td style="padding:24px 40px 32px;border-top:1px solid #e5e7eb;">
                    <p style="margin:0 0 4px;font-size:14px;font-weight:700;color:#0f0f23;">Cégem 360 Kft.</p>
                    <p style="margin:0;font-size:12px;line-height:1.6;color:#6b7280;">
                        1051 Budapest, Széchenyi István tér 7-8.<br>
                        +36 20 331 9550 · <a href="mailto:tamas@cegem360.hu" style="color:#6161ff;text-decoration:none;">tamas@cegem360.hu</a><br>
                        <a href="https://cegem360.hu/" style="color:#6161ff;text-decoration:none;" target="_blank">cegem360.hu</a>
                    </p>
                </td>
            </tr>
        </tbody>
    </table>
</div>
