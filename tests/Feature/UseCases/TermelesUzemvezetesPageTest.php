<?php

declare(strict_types=1);

test('termeles-uzemvezetes use-case page renders successfully', function () {
    $response = $this->get(route('usecases.termeles-uzemvezetes'));

    $response->assertStatus(200);
    $response->assertSee('Irányítsa a termelést');
    $response->assertSee('ne a termelés irányítsa Önt');
});

test('termeles-uzemvezetes use-case page displays pain points section', function () {
    $response = $this->get(route('usecases.termeles-uzemvezetes'));

    $response->assertSee('Nem tervezett leállások');
    $response->assertSee('Papír alapú gyártáskísérés');
    $response->assertSee('Ismeretlen OEE és hatékonyság');
    $response->assertSee('Gyártás–értékesítés szinkronhiba');
});

test('termeles-uzemvezetes use-case page displays target audience section', function () {
    $response = $this->get(route('usecases.termeles-uzemvezetes'));

    $response->assertSee('Üzem- és műszakvezetők');
    $response->assertSee('Termelési igazgatók');
    $response->assertSee('Karbantartási vezetők');
    $response->assertSee('Minőségirányítási vezető');
});

test('termeles-uzemvezetes use-case page displays core toolkit modules', function () {
    $response = $this->get(route('usecases.termeles-uzemvezetes'));

    $response->assertSee('Gyártásirányítás');
    $response->assertSee('Digitális munkalap');
    $response->assertSee('Automatizálás');
    $response->assertSee('DataMind');
});

test('termeles-uzemvezetes use-case page displays production lifecycle section', function () {
    $response = $this->get(route('usecases.termeles-uzemvezetes'));

    $response->assertSee('Megrendelés');
    $response->assertSee('Tervezés');
    $response->assertSee('Gyártás');
    $response->assertSee('Minőség');
    $response->assertSee('Kiszállítás');
    $response->assertSee('Elemzés');
});

test('termeles-uzemvezetes use-case page displays stats section', function () {
    $response = $this->get(route('usecases.termeles-uzemvezetes'));

    $response->assertSee('data-count="25"', escape: false);
    $response->assertSee('data-count="40"', escape: false);
    $response->assertSee('data-count="30"', escape: false);
    $response->assertSee('data-count="65"', escape: false);
    $response->assertSee('OEE javulás');
    $response->assertSee('Nem tervezett leállás');
    $response->assertSee('Selejt-arány csökkenés');
    $response->assertSee('Adminisztrációs idő');
});

test('termeles-uzemvezetes use-case page displays use cases section', function () {
    $response = $this->get(route('usecases.termeles-uzemvezetes'));

    $response->assertSee('OEE mérés és gépkihasználtság-elemzés');
    $response->assertSee('Prediktív karbantartás MI-vel');
    $response->assertSee('Gantt-alapú kapacitástervezés');
    $response->assertSee('Digitális műszak-jelentés');
    $response->assertSee('Selejt-elemzés és minőségellenőrzés');
    $response->assertSee('Gyártás–értékesítés szinkronizáció');
});

test('termeles-uzemvezetes use-case page displays comparison table', function () {
    $response = $this->get(route('usecases.termeles-uzemvezetes'));

    $response->assertSee('Gépállapot áttekintés');
    $response->assertSee('OEE mérés');
    $response->assertSee('Prediktív MI tervezés');
    $response->assertSee('Gantt, kapacitás-szinkronnal');
});

test('termeles-uzemvezetes use-case page displays CTA sections', function () {
    $response = $this->get(route('usecases.termeles-uzemvezetes'));

    $response->assertSee('Online konzultáció');
    $response->assertSee('Regisztráció és kipróbálás');
    $response->assertSee('Készen áll a digitális üzemirányításra?');
});

test('termeles-uzemvezetes use-case page displays OEE dashboard visual', function () {
    $response = $this->get(route('usecases.termeles-uzemvezetes'));

    $response->assertSee('Üzemi vezérlőpult');
    $response->assertSee('CNC marógép #1');
    $response->assertSee('Hegesztő robot');
    $response->assertSee('Lézervágó');
    $response->assertSee('Présgép #2');
    $response->assertSee('Napi termelési cél teljesítés');
});
