<?php

declare(strict_types=1);

return [
    /*
    |--------------------------------------------------------------------------
    | Jogi dokumentumok hatályossági dátuma
    |--------------------------------------------------------------------------
    | Egyetlen forrás a megjelenített és az elfogadáskor auditba írt dátumhoz,
    | hogy a `legal_acceptances` rekord mindig azt a verziót jelölje, amit a
    | megrendelő ténylegesen látott. Új verzió kiadásakor csak itt kell írni.
    */
    'terms' => [
        'effective_at' => '2026-05-27',
    ],

    'privacy' => [
        'effective_at' => '2026-05-27',
    ],
];
