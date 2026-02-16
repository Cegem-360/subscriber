<?php

declare(strict_types=1);

test('ertekesites use-case page renders successfully', function () {
    $response = $this->get(route('usecases.ertekesites'));

    $response->assertStatus(200);
    $response->assertSee('Zárja le gyorsabban');
    $response->assertSee('az ipari üzleteket');
});

test('ertekesites use-case page displays pain points section', function () {
    $response = $this->get(route('usecases.ertekesites'));

    $response->assertSee('Elveszett érdeklődők');
    $response->assertSee('Lassú ajánlattétel');
    $response->assertSee('Átláthatatlan pipeline');
    $response->assertSee('Marketing–Sales szakadék');
});

test('ertekesites use-case page displays target audience section', function () {
    $response = $this->get(route('usecases.ertekesites'));

    $response->assertSee('Sales igazgatók');
    $response->assertSee('Értékesítők és AM-ek');
    $response->assertSee('Ügyvezetők');
    $response->assertSee('Marketing csapat');
});

test('ertekesites use-case page displays core toolkit modules', function () {
    $response = $this->get(route('usecases.ertekesites'));

    $response->assertSee('CRM');
    $response->assertSee('Értékesítés');
    $response->assertSee('Automatizálás');
    $response->assertSee('DataMind');
});

test('ertekesites use-case page displays sales funnel section', function () {
    $response = $this->get(route('usecases.ertekesites'));

    $response->assertSee('Lead beérkezés');
    $response->assertSee('Kvalifikálás');
    $response->assertSee('Ajánlattétel');
    $response->assertSee('Tárgyalás');
    $response->assertSee('Lezárás');
});

test('ertekesites use-case page displays stats section', function () {
    $response = $this->get(route('usecases.ertekesites'));

    $response->assertSee('data-count="40"', escape: false);
    $response->assertSee('Lezárt üzletek');
    $response->assertSee('Értékesítési ciklus');
    $response->assertSee('Admin-idő');
    $response->assertSee('Ügyfél-visszatérés');
});

test('ertekesites use-case page displays use cases section', function () {
    $response = $this->get(route('usecases.ertekesites'));

    $response->assertSee('Ipari lead kezelés és kvalifikálás');
    $response->assertSee('Gyors ajánlattétel sablonokból');
    $response->assertSee('Pipeline menedzsment és előrejelzés');
});

test('ertekesites use-case page displays comparison table', function () {
    $response = $this->get(route('usecases.ertekesites'));

    $response->assertSee('Excel és fejben tartás helyett');
    $response->assertSee('Automatikus CRM pipeline');
    $response->assertSee('Dinamikus ajánlat percek alatt');
});

test('ertekesites use-case page displays CTA sections', function () {
    $response = $this->get(route('usecases.ertekesites'));

    $response->assertSee('Online konzultáció');
    $response->assertSee('Regisztráció és kipróbálás');
    $response->assertSee('Készen áll a hatékonyabb értékesítésre?');
});

test('ertekesites use-case page displays pipeline visual', function () {
    $response = $this->get(route('usecases.ertekesites'));

    $response->assertSee('Sales Pipeline');
    $response->assertSee('24 aktív üzlet');
    $response->assertSee('42% konverzió');
});
