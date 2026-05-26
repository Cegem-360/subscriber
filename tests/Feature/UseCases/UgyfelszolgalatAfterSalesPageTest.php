<?php

declare(strict_types=1);

test('ugyfelszolgalat-after-sales use-case page renders successfully', function (): void {
    $response = $this->get(route('usecases.ugyfelszolgalat-after-sales'));

    $response->assertStatus(200);
    $response->assertSee('Szolgáltasson ki gyorsabban');
    $response->assertSee('és tartsa meg ügyfeleit');
});

test('ugyfelszolgalat-after-sales use-case page displays pain points section', function (): void {
    $response = $this->get(route('usecases.ugyfelszolgalat-after-sales'));

    $response->assertSee('Lassú reakcióidő');
    $response->assertSee('Papíros szervizmunkalapok');
    $response->assertSee('Nincs szerviz-előzmény');
    $response->assertSee('Elszalasztott upsell-lehetőségek');
});

test('ugyfelszolgalat-after-sales use-case page displays target audience section', function (): void {
    $response = $this->get(route('usecases.ugyfelszolgalat-after-sales'));

    $response->assertSee('Helyszíni szerelők');
    $response->assertSee('Szervizvezetők');
    $response->assertSee('Ügyfélkapcsolati munkatársak');
    $response->assertSee('Ügyvezetők');
});

test('ugyfelszolgalat-after-sales use-case page displays core toolkit modules', function (): void {
    $response = $this->get(route('usecases.ugyfelszolgalat-after-sales'));

    $response->assertSee('Digitális munkalap');
    $response->assertSee('CRM');
    $response->assertSee('AI Chat');
    $response->assertSee('Automatizálás');
});

test('ugyfelszolgalat-after-sales use-case page displays service lifecycle section', function (): void {
    $response = $this->get(route('usecases.ugyfelszolgalat-after-sales'));

    $response->assertSee('Bejelentés');
    $response->assertSee('Kiosztás');
    $response->assertSee('Helyszíni munka');
    $response->assertSee('Dokumentálás');
    $response->assertSee('Visszajelzés');
    $response->assertSee('Proaktív gondoskodás');
});

test('ugyfelszolgalat-after-sales use-case page displays stats section', function (): void {
    $response = $this->get(route('usecases.ugyfelszolgalat-after-sales'));

    $response->assertSee('data-count="60"', escape: false);
    $response->assertSee('data-count="35"', escape: false);
    $response->assertSee('data-count="45"', escape: false);
    $response->assertSee('data-count="70"', escape: false);
    $response->assertSee('Átlagos válaszidő csökkenés');
    $response->assertSee('Ügyfél-megtartás javulás');
    $response->assertSee('Szerviz-upsell konverzió');
    $response->assertSee('Admin-idő helyszínen');
});

test('ugyfelszolgalat-after-sales use-case page displays use cases section', function (): void {
    $response = $this->get(route('usecases.ugyfelszolgalat-after-sales'));

    $response->assertSee('Helyszíni szerviz digitális dokumentálása');
    $response->assertSee('0-24 AI ügyfélszolgálat');
    $response->assertSee('Proaktív karbantartás-értesítés');
    $response->assertSee('Reklamáció-kezelés és garancia-workflow');
    $response->assertSee('Szerviz-upsell és keretszerződés-ajánlat');
    $response->assertSee('Szerviz-jövedelmezőség elemzés');
});

test('ugyfelszolgalat-after-sales use-case page displays comparison table', function (): void {
    $response = $this->get(route('usecases.ugyfelszolgalat-after-sales'));

    $response->assertSee('Szervizbejelentés');
    $response->assertSee('Szerviz-előzmények');
    $response->assertSee('Helyszíni dokumentálás');
    $response->assertSee('Proaktív gondoskodás');
});

test('ugyfelszolgalat-after-sales use-case page displays CTA sections', function (): void {
    $response = $this->get(route('usecases.ugyfelszolgalat-after-sales'));

    $response->assertSee('Online konzultáció');
    $response->assertSee('Regisztráció és kipróbálás');
    $response->assertSee('Készen áll a proaktív ügyfélszolgálatra?');
});

test('ugyfelszolgalat-after-sales use-case page displays service ticket dashboard visual', function (): void {
    $response = $this->get(route('usecases.ugyfelszolgalat-after-sales'));

    $response->assertSee('Szerviz irányítópult');
    $response->assertSee('Kompresszor meghibásodás');
    $response->assertSee('Éves karbantartás ütemezés');
    $response->assertSee('Garancia-igény: vezérlőpanel');
    $response->assertSee('Cégem360 AI Asszisztens');
});
