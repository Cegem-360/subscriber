<?php

declare(strict_types=1);

test('automatizacio feature page renders successfully', function () {
    $response = $this->get(route('features.automatizaciok'));

    $response->assertStatus(200);
    $response->assertSee('Ha egyszer beállítod');
    $response->assertSee('utána a rendszer dolgozik helyetted');
});

test('automatizacio feature page displays workflow builder visual', function () {
    $response = $this->get(route('features.automatizaciok'));

    $response->assertSee('Automatizáció-kezelő');
    $response->assertSee('14 aktív workflow');
    $response->assertSee('Szervizjegy kiosztás');
    $response->assertSee('1 247×');
    $response->assertSee('Garancia-lejárat');
    $response->assertSee('Heti vezetői riport');
    $response->assertSee('Szünetel');
    $response->assertSee('12 aktív');
    $response->assertSee('2 szünetel');
    $response->assertSee('2 283 futás / hó');
});

test('automatizacio feature page displays trigger types section', function () {
    $response = $this->get(route('features.automatizaciok'));

    $response->assertSee('Esemény-trigger');
    $response->assertSee('Időzített trigger');
    $response->assertSee('Feltétel-trigger');
    $response->assertSee('MI-trigger (DataMind)');
    $response->assertSee('Új szervizjegy érkezett');
    $response->assertSee('Hétfő 8:00 — vezetői riport');
    $response->assertSee('Churn-kockázat');
});

test('automatizacio feature page displays capabilities section', function () {
    $response = $this->get(route('features.automatizaciok'));

    $response->assertSee('Vizuális workflow-építő');
    $response->assertSee('Modulok közötti automatizmus');
    $response->assertSee('Feltételes logika és elágazás');
    $response->assertSee('Eszkaláció és határidő-kezelés');
    $response->assertSee('Többcsatornás értesítés');
    $response->assertSee('Napló és audit trail');
});

test('automatizacio feature page displays module automations map', function () {
    $response = $this->get(route('features.automatizaciok'));

    $response->assertSee('CRM');
    $response->assertSee('Gyártásirányítás');
    $response->assertSee('Beszerzés-logisztika');
    $response->assertSee('Kontrolling');
    $response->assertSee('Digitális munkalap');
    $response->assertSee('AI Chat');
    $response->assertSee('MarketingHub');
    $response->assertSee('DataMind');
    $response->assertSee('Ajánlat elfogadva');
    $response->assertSee('fizetési felszólítás workflow');
});

test('automatizacio feature page displays workflow builder section', function () {
    $response = $this->get(route('features.automatizaciok'));

    $response->assertSee('Trigger kiválasztása');
    $response->assertSee('Feltételek megadása');
    $response->assertSee('Akciók definiálása');
    $response->assertSee('Aktiválás és monitoring');
    $response->assertSee('Garancia-lejárat kezelés');
    $response->assertSee('Van aktív szervizszerződés');
});

test('automatizacio feature page displays stats section', function () {
    $response = $this->get(route('features.automatizaciok'));

    $response->assertSee('data-count="75"', escape: false);
    $response->assertSee('data-prefix="-"', escape: false);
    $response->assertSee('data-count="0"', escape: false);
    $response->assertSee('data-count="3"', escape: false);
    $response->assertSee('data-count="100"', escape: false);
    $response->assertSee('Ismétlődő manuális feladatok');
    $response->assertSee('Elfelejtett határidő vagy eszkaláció');
    $response->assertSee('Gyorsabb reakcióidő');
    $response->assertSee('Audit-nyomonkövethetőség');
});

test('automatizacio feature page displays use cases section', function () {
    $response = $this->get(route('features.automatizaciok'));

    $response->assertSee('Szervizjegy-kiosztás és SLA-eszkaláció');
    $response->assertSee('megrendelés');
    $response->assertSee('Jóváhagyási workflow összeghatárral');
    $response->assertSee('Készlet-újrarendelés automatikusan');
    $response->assertSee('proaktív értékesítés');
    $response->assertSee('MI predikció');
});

test('automatizacio feature page displays competitor comparison section', function () {
    $response = $this->get(route('features.automatizaciok'));

    $response->assertSee('Általános automatizálók');
    $response->assertSee('ERP workflow-k');
    $response->assertSee('Cégem360');
    $response->assertSee('Drága skálázás (futásonkénti árazás)');
    $response->assertSee('Modulok között — nulla szinkron-hiba');
});

test('automatizacio feature page displays comparison table', function () {
    $response = $this->get(route('features.automatizaciok'));

    $response->assertSee('Modulok közötti workflow');
    $response->assertSee('Vizuális workflow-építő');
    $response->assertSee('Feltételes logika (IF/THEN)');
    $response->assertSee('MI-trigger (predikció, anomália)');
    $response->assertSee('Eszkalációs lánc');
    $response->assertSee('Jóváhagyási workflow');
    $response->assertSee('Árazási modell');
});

test('automatizacio feature page displays CTA sections', function () {
    $response = $this->get(route('features.automatizaciok'));

    $response->assertSee('Személyre szabott automatizációs konzultáció');
    $response->assertSee('Regisztráció és kipróbálás');
    $response->assertSee('Készen áll az automatizált ipari munkafolyamatokra?');
    $response->assertSee('Automatizációs konzultáció');
});
