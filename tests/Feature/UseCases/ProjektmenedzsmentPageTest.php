<?php

declare(strict_types=1);

test('projektmenedzsment use-case page renders successfully', function () {
    $response = $this->get(route('usecases.projektmenedzsment'));

    $response->assertStatus(200);
    $response->assertSee('Irányítsa ipari projektjeit');
    $response->assertSee('a megrendeléstől az átadásig');
});

test('projektmenedzsment use-case page displays pain points section', function () {
    $response = $this->get(route('usecases.projektmenedzsment'));

    $response->assertSee('Csúszó határidők');
    $response->assertSee('Papíralapú helyszíni munka');
    $response->assertSee('Elszálló projektköltségek');
    $response->assertSee('Szétesett kommunikáció');
});

test('projektmenedzsment use-case page displays target audience section', function () {
    $response = $this->get(route('usecases.projektmenedzsment'));

    $response->assertSee('Projektvezetők');
    $response->assertSee('Műszaki igazgatók');
    $response->assertSee('Üzemvezetők');
    $response->assertSee('Ügyvezetők');
});

test('projektmenedzsment use-case page displays core toolkit modules', function () {
    $response = $this->get(route('usecases.projektmenedzsment'));

    $response->assertSee('Gyártásirányítás');
    $response->assertSee('Digitális munkalap');
    $response->assertSee('Automatizálás');
    $response->assertSee('Kontrolling');
});

test('projektmenedzsment use-case page displays project lifecycle section', function () {
    $response = $this->get(route('usecases.projektmenedzsment'));

    $response->assertSee('Ajánlattétel');
    $response->assertSee('Tervezés');
    $response->assertSee('Végrehajtás');
    $response->assertSee('Átadás');
});

test('projektmenedzsment use-case page displays stats section', function () {
    $response = $this->get(route('usecases.projektmenedzsment'));

    $response->assertSee('data-count="30"', escape: false);
    $response->assertSee('Határidő-tartás javulás');
    $response->assertSee('Projektköltség csökkenés');
});

test('projektmenedzsment use-case page displays use cases section', function () {
    $response = $this->get(route('usecases.projektmenedzsment'));

    $response->assertSee('Gyártósor telepítési projekt');
    $response->assertSee('Szerviz- és karbantartási projektek');
    $response->assertSee('Projekt-alapú költségkontroll');
});

test('projektmenedzsment use-case page displays comparison table', function () {
    $response = $this->get(route('usecases.projektmenedzsment'));

    $response->assertSee('Excel és e-mail helyett');
    $response->assertSee('Valós idejű projekt státusz');
    $response->assertSee('Helyszíni adatrögzítés');
});

test('projektmenedzsment use-case page displays CTA sections', function () {
    $response = $this->get(route('usecases.projektmenedzsment'));

    $response->assertSee('Online konzultáció');
    $response->assertSee('Regisztráció és kipróbálás');
    $response->assertSee('Készen áll a hatékonyabb projektmenedzsmentre?');
});

test('projektmenedzsment use-case page displays gantt chart visual', function () {
    $response = $this->get(route('usecases.projektmenedzsment'));

    $response->assertSee('Projekt ütemterv');
    $response->assertSee('Gyártósor telepítés');
    $response->assertSee('Próbaüzem');
});
