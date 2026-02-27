<?php

declare(strict_types=1);

test('penzugy-kontrolling use-case page renders successfully', function () {
    $response = $this->get(route('usecases.penzugy-kontrolling'));

    $response->assertStatus(200);
    $response->assertSee('Lássa át vállalata pénzügyeit');
    $response->assertSee('valós időben, nem hónap végén');
});

test('penzugy-kontrolling use-case page displays pain points section', function () {
    $response = $this->get(route('usecases.penzugy-kontrolling'));

    $response->assertSee('Hónap végi meglepetések');
    $response->assertSee('Szétszórt pénzügyi adatok');
    $response->assertSee('Napokig tartó riportkészítés');
    $response->assertSee('Nincs előrejelzés');
});

test('penzugy-kontrolling use-case page displays target audience section', function () {
    $response = $this->get(route('usecases.penzugy-kontrolling'));

    $response->assertSee('CFO / Pénzügyi igazgató');
    $response->assertSee('Kontrollerek');
    $response->assertSee('Ügyvezetők/tulajdonosok');
    $response->assertSee('Projekt- és üzemvezetők');
});

test('penzugy-kontrolling use-case page displays core toolkit modules', function () {
    $response = $this->get(route('usecases.penzugy-kontrolling'));

    $response->assertSee('Kontrolling');
    $response->assertSee('DataMind');
    $response->assertSee('Értékesítés');
    $response->assertSee('Automatizálás');
});

test('penzugy-kontrolling use-case page displays data flow section', function () {
    $response = $this->get(route('usecases.penzugy-kontrolling'));

    $response->assertSee('Értékesítés');
    $response->assertSee('Gyártás & szerviz');
    $response->assertSee('Beszerzés');
    $response->assertSee('MI elemzés');
});

test('penzugy-kontrolling use-case page displays stats section', function () {
    $response = $this->get(route('usecases.penzugy-kontrolling'));

    $response->assertSee('data-count="80"', escape: false);
    $response->assertSee('data-count="30"', escape: false);
    $response->assertSee('Riportkészítési idő');
    $response->assertSee('Költségcsökkentés');
    $response->assertSee('Gyorsabb döntéshozatal');
    $response->assertSee('Predikció pontosság');
});

test('penzugy-kontrolling use-case page displays use cases section', function () {
    $response = $this->get(route('usecases.penzugy-kontrolling'));

    $response->assertSee('Projekt-szintű jövedelmezőség');
    $response->assertSee('Cash flow előrejelzés');
    $response->assertSee('Automatikus vezetői riport');
    $response->assertSee('Marketing ROI mérés');
    $response->assertSee('Gyártási önköltségszámítás');
    $response->assertSee('Költség-anomália felismerése');
});

test('penzugy-kontrolling use-case page displays comparison table', function () {
    $response = $this->get(route('usecases.penzugy-kontrolling'));

    $response->assertSee('Pénzügyi áttekintés');
    $response->assertSee('Projekt-jövedelmezőség');
    $response->assertSee('Valós idejű dashboard');
    $response->assertSee('MI-alapú predikció');
});

test('penzugy-kontrolling use-case page displays CTA sections', function () {
    $response = $this->get(route('usecases.penzugy-kontrolling'));

    $response->assertSee('Online konzultáció');
    $response->assertSee('Regisztráció és kipróbálás');
    $response->assertSee('Készen áll a hatékonyabb pénzügyi irányításra?');
});

test('penzugy-kontrolling use-case page displays finance dashboard visual', function () {
    $response = $this->get(route('usecases.penzugy-kontrolling'));

    $response->assertSee('Pénzügyi Dashboard');
    $response->assertSee('248.6M');
    $response->assertSee('EBITDA');
    $response->assertSee('Projekt-jövedelmezőség');
});
