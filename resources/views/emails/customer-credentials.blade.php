@php
    /** @var string $name */
    /** @var string $email */
    /** @var string $password */
    /** @var string $loginUrl */
@endphp
<x-mail::message>
# Üdvözlünk, {{ $name }}!

Fiók készült számodra a Cégem 360 rendszerben. Az alábbi adatokkal tudsz belépni:

<x-mail::panel>
**E-mail:** {{ $email }}
**Jelszó:** {{ $password }}
</x-mail::panel>

<x-mail::button :url="$loginUrl">
Belépés
</x-mail::button>

Biztonsági okból javasoljuk, hogy az első belépés után változtasd meg a jelszavad.

Üdvözlettel,<br>
{{ config('app.name') }}
</x-mail::message>
