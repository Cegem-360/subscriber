<?php

declare(strict_types=1);

test('integracio feature page renders successfully', function (): void {
    $response = $this->get(route('features.integraciok'));

    $response->assertStatus(200);
    $response->assertSee('11 modul, egyetlen rendszer');
    $response->assertSee('REST API');
});

test('integracio feature page displays integration hub visual', function (): void {
    $response = $this->get(route('features.integraciok'));

    $response->assertSee('Integrációs áttekintés');
    $response->assertSee('11 modul aktív');
    $response->assertSee('55+');
    $response->assertSee('Belső modulkapcsolat');
    $response->assertSee('Külső API csatlakozás');
    $response->assertSee('AI-támogatott integráció');
});

test('integracio feature page displays two pillars section', function (): void {
    $response = $this->get(route('features.integraciok'));

    $response->assertSee('Belső integráció');
    $response->assertSee('Külső integráció');
    $response->assertSee('11 modul — natívan összekötve, nulla konfiguráció');
    $response->assertSee('REST API — AI segítséggel és a mi szolgáltatásunkkal');
    $response->assertSee('Nincs szinkronizálási hiba vagy adatvesztés');
    $response->assertSee('REST API teljes hozzáféréssel minden modulhoz');
});

test('integracio feature page displays internal ecosystem modules', function (): void {
    $response = $this->get(route('features.integraciok'));

    $response->assertSee('CRM');
    $response->assertSee('Gyártásirányítás');
    $response->assertSee('Kontrolling');
    $response->assertSee('Automatizálás');
    $response->assertSee('DataMind');
    $response->assertSee('MarketingHub');
    $response->assertSee('SEO Eszköz');
    $response->assertSee('AI Chat');
});

test('integracio feature page displays connection flow cards', function (): void {
    $response = $this->get(route('features.integraciok'));

    $response->assertSee('Elfogadott ajánlatból automatikus gyártási utasítás');
    $response->assertSee('automatikus anyagszükséglet');
    $response->assertSee('azonnali költségelszámolás');
    $response->assertSee('AI chatbottól kérdezi');
});

test('integracio feature page displays external API section', function (): void {
    $response = $this->get(route('features.integraciok'));

    $response->assertSee('Dokumentáció és sandbox');
    $response->assertSee('AI fejlesztéstámogatás');
    $response->assertSee('Integrációs szolgáltatás');
    $response->assertSee('REST API — teljes hozzáférés mind a 11 modulhoz');
    $response->assertSee('api-example.sh');
    $response->assertSee('api.cegem360.eu');
});

test('integracio feature page displays possible connections', function (): void {
    $response = $this->get(route('features.integraciok'));

    $response->assertSee('Számlázóprogramok');
    $response->assertSee('NAV Online Számla');
    $response->assertSee('ERP rendszerek');
    $response->assertSee('Webshopok');
    $response->assertSee('Google Workspace');
    $response->assertSee('Microsoft 365');
    $response->assertSee('Fizetési szolgáltatók');
    $response->assertSee('Kommunikáció');
});

test('integracio feature page displays stats section', function (): void {
    $response = $this->get(route('features.integraciok'));

    $response->assertSee('data-count="11"', escape: false);
    $response->assertSee('data-count="55"', escape: false);
    $response->assertSee('data-count="REST"', escape: false);
    $response->assertSee('data-count="AI"', escape: false);
    $response->assertSee('Belső modul natívan összekötve');
    $response->assertSee('Automatikus modulkapcsolat');
    $response->assertSee('Fejlesztéstámogatás beépítve');
});

test('integracio feature page displays use cases section', function (): void {
    $response = $this->get(route('features.integraciok'));

    $response->assertSee('Megrendelés');
    $response->assertSee('Számlázóprogram csatlakoztatása REST API-n');
    $response->assertSee('Szerviz-kiszállás');
    $response->assertSee('ERP törzs-adatszinkron szolgáltatásként');
    $response->assertSee('Webhook riasztás Slack-be vagy SMS-ben');
    $response->assertSee('Webshop rendelések behúzása API-n');
});

test('integracio feature page displays competitor comparison section', function (): void {
    $response = $this->get(route('features.integraciok'));

    $response->assertSee('Pont-megoldások halmaza');
    $response->assertSee('Nagyvállalati ERP');
    $response->assertSee('Cégem360');
    $response->assertSee('Zapier, kézi szinkron, CSV export');
    $response->assertSee('11 modul natívan összekapcsolva');
});

test('integracio feature page displays comparison table', function (): void {
    $response = $this->get(route('features.integraciok'));

    $response->assertSee('Belső modulok integrációja');
    $response->assertSee('Külső rendszerkapcsolat');
    $response->assertSee('AI fejlesztéstámogatás');
    $response->assertSee('Webhook-ok (valós idejű)');
    $response->assertSee('ERP-kiegészítő üzemmód');
    $response->assertSee('Szinkron-hibák kockázata');
});

test('integracio feature page displays CTA sections', function (): void {
    $response = $this->get(route('features.integraciok'));

    $response->assertSee('Személyre szabott integrációs konzultáció');
    $response->assertSee('Regisztráció és kipróbálás');
    $response->assertSee('Készen áll az összekötött ipari vállalatirányításra?');
});
