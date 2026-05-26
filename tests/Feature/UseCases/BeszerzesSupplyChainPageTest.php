<?php

declare(strict_types=1);

test('beszerzes-supply-chain use-case page renders successfully', function (): void {
    $response = $this->get(route('usecases.beszerzes-supply-chain'));

    $response->assertStatus(200);
    $response->assertSee('Tudja, mi van raktáron');
    $response->assertSee('és mi lesz holnap');
});

test('beszerzes-supply-chain use-case page displays pain points section', function (): void {
    $response = $this->get(route('usecases.beszerzes-supply-chain'));

    $response->assertSee('Váratlan készlethiány');
    $response->assertSee('Túlkészletezés és tőkelekötés');
    $response->assertSee('Beszállítói káosz');
    $response->assertSee('Manuális rendelési folyamat');
});

test('beszerzes-supply-chain use-case page displays target audience section', function (): void {
    $response = $this->get(route('usecases.beszerzes-supply-chain'));

    $response->assertSee('Beszerzési vezetők');
    $response->assertSee('Raktárvezetők');
    $response->assertSee('Üzem- és termelési vezetők');
    $response->assertSee('CFO-k és kontrollerek');
});

test('beszerzes-supply-chain use-case page displays core toolkit modules', function (): void {
    $response = $this->get(route('usecases.beszerzes-supply-chain'));

    $response->assertSee('Beszerzés-logisztika');
    $response->assertSee('Gyártásirányítás');
    $response->assertSee('Automatizálás');
    $response->assertSee('DataMind');
});

test('beszerzes-supply-chain use-case page displays supply chain lifecycle section', function (): void {
    $response = $this->get(route('usecases.beszerzes-supply-chain'));

    $response->assertSee('Szükséglet');
    $response->assertSee('Jóváhagyás');
    $response->assertSee('Rendelés');
    $response->assertSee('Nyomonkövetés');
    $response->assertSee('Bevételezés');
    $response->assertSee('Elszámolás');
});

test('beszerzes-supply-chain use-case page displays stats section', function (): void {
    $response = $this->get(route('usecases.beszerzes-supply-chain'));

    $response->assertSee('data-count="35"', escape: false);
    $response->assertSee('data-count="25"', escape: false);
    $response->assertSee('data-count="60"', escape: false);
    $response->assertSee('Készlethiány miatti leállás');
    $response->assertSee('Raktári tőkelekötés');
    $response->assertSee('Beszerzési adminisztrációs idő');
    $response->assertSee('Szállítói teljesítmény-javulás');
});

test('beszerzes-supply-chain use-case page displays use cases section', function (): void {
    $response = $this->get(route('usecases.beszerzes-supply-chain'));

    $response->assertSee('Automatikus minimumkészlet-riasztás és újrarendelés');
    $response->assertSee('BOM alapú anyagszükséglet-tervezés');
    $response->assertSee('Szállítói teljesítmény értékelés');
    $response->assertSee('Többszintű jóváhagyási workflow');
    $response->assertSee('Szerviz kiszállás anyagkezelése');
    $response->assertSee('Prediktív készletezés MI-vel');
});

test('beszerzes-supply-chain use-case page displays comparison table', function (): void {
    $response = $this->get(route('usecases.beszerzes-supply-chain'));

    $response->assertSee('Készletszint áttekintés');
    $response->assertSee('Szállítói összehasonlítás');
    $response->assertSee('Automatikus trigger');
    $response->assertSee('BOM alapú, automatikus');
});

test('beszerzes-supply-chain use-case page displays CTA sections', function (): void {
    $response = $this->get(route('usecases.beszerzes-supply-chain'));

    $response->assertSee('Online konzultáció');
    $response->assertSee('Regisztráció és kipróbálás');
    $response->assertSee('Készen áll az átlátható ellátási láncra?');
});

test('beszerzes-supply-chain use-case page displays supply chain tracker visual', function (): void {
    $response = $this->get(route('usecases.beszerzes-supply-chain'));

    $response->assertSee('Ellátásilánc tracker');
    $response->assertSee('Acéllemez');
    $response->assertSee('Csapágyak');
    $response->assertSee('SKF csapágykészlet');
    $response->assertSee('Jóváhagyásra vár');
});
