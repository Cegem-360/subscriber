<?php

declare(strict_types=1);

return [
    /*
    |--------------------------------------------------------------------------
    | Jelszó-visszaállítási nyelvi sorok
    |--------------------------------------------------------------------------
    |
    | A jelszó-visszaállítási broker által visszaadott státuszüzenetek magyar
    | fordításai (sikeres visszaállítás, elküldött link, érvénytelen token stb.).
    |
    */

    'reset' => 'A jelszavad sikeresen megváltozott.',
    'sent' => 'Elküldtük e-mailben a jelszó-visszaállítási linket.',
    'throttled' => 'Kérjük, várj, mielőtt újra próbálkoznál.',
    'token' => 'Ez a jelszó-visszaállítási token érvénytelen.',
    'user' => 'Nem található felhasználó ezzel az e-mail címmel.',
];
