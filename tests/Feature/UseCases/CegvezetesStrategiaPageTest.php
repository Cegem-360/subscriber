<?php

declare(strict_types=1);

test('cegvezetes-strategia use-case page renders successfully', function () {
    $response = $this->get(route('usecases.cegvezetes-strategia'));

    $response->assertStatus(200);
    $response->assertSee('Az egész vállalat');
    $response->assertSee('irányítópulton, minden reggel');
});

test('cegvezetes-strategia use-case page displays pain points section', function () {
    $response = $this->get(route('usecases.cegvezetes-strategia'));

    $response->assertSee('Nincs valós idejű áttekintés');
    $response->assertSee('Adatsilók és rendszersziget-ek');
    $response->assertSee('Döntés megérzés alapján');
    $response->assertSee('Heti menedzsment-riport');
});

test('cegvezetes-strategia use-case page displays target audience section', function () {
    $response = $this->get(route('usecases.cegvezetes-strategia'));

    $response->assertSee('Ügyvezetők és cégtulajdonosok');
    $response->assertSee('CFO-k és pénzügyi igazgatók');
    $response->assertSee('Kereskedelmi és értékesítési igazgatók');
    $response->assertSee('Műszaki és termelési igazgatók');
});

test('cegvezetes-strategia use-case page displays core toolkit modules', function () {
    $response = $this->get(route('usecases.cegvezetes-strategia'));

    $response->assertSee('Kontrolling');
    $response->assertSee('DataMind');
    $response->assertSee('CRM');
    $response->assertSee('MarketingHub');
});

test('cegvezetes-strategia use-case page displays decision flow section', function () {
    $response = $this->get(route('usecases.cegvezetes-strategia'));

    $response->assertSee('Reggeli összefoglaló');
    $response->assertSee('Dashboard áttekintés');
    $response->assertSee('Fókusz-elemzés');
    $response->assertSee('Döntéshozatal');
    $response->assertSee('Végrehajtás-követés');
});

test('cegvezetes-strategia use-case page displays stats section', function () {
    $response = $this->get(route('usecases.cegvezetes-strategia'));

    $response->assertSee('data-count="5"', escape: false);
    $response->assertSee('data-count="100"', escape: false);
    $response->assertSee('data-count="90"', escape: false);
    $response->assertSee('data-count="30"', escape: false);
    $response->assertSee('Gyorsabb döntéshozatal');
    $response->assertSee('Valós idejű vállalati áttekintés');
    $response->assertSee('Riportkészítési idő');
    $response->assertSee('Stratégiai célok teljesülése');
});

test('cegvezetes-strategia use-case page displays use cases section', function () {
    $response = $this->get(route('usecases.cegvezetes-strategia'));

    $response->assertSee('Reggeli MI összefoglaló és napi prioritások');
    $response->assertSee('Projekt-portfólió jövedelmezőségi áttekintés');
    $response->assertSee('Stratégiai kapacitásdöntés MI predikcióval');
    $response->assertSee('Automatikus vezetői heti riport');
    $response->assertSee('Marketing–értékesítés–szerviz összefüggés-elemzés');
    $response->assertSee('Tulajdonosi riport és befektetői kommunikáció');
});

test('cegvezetes-strategia use-case page displays comparison table', function () {
    $response = $this->get(route('usecases.cegvezetes-strategia'));

    $response->assertSee('Vállalati áttekintés');
    $response->assertSee('Vezetői riport');
    $response->assertSee('Kockázat-azonosítás');
    $response->assertSee('Egyetlen igazságforrás');
});

test('cegvezetes-strategia use-case page displays CTA sections', function () {
    $response = $this->get(route('usecases.cegvezetes-strategia'));

    $response->assertSee('Vezetői konzultáció');
    $response->assertSee('Regisztráció és kipróbálás');
    $response->assertSee('Készen áll az adatvezérelt cégirányításra?');
});

test('cegvezetes-strategia use-case page displays CEO command center visual', function () {
    $response = $this->get(route('usecases.cegvezetes-strategia'));

    $response->assertSee('Vezetői irányítóközpont');
    $response->assertSee('CEO Dashboard');
    $response->assertSee('248M');
    $response->assertSee('EBITDA margin');
    $response->assertSee('DataMind — Reggeli összefoglaló');
    $response->assertSee('Új keretszerződés aláírva');
});
