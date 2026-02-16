<?php

declare(strict_types=1);

test('dokumentumok feature page renders successfully', function () {
    $response = $this->get(route('features.dokumentumok'));

    $response->assertStatus(200);
    $response->assertSee('Minden dokumentum');
    $response->assertSee('automatikusan, a folyamatból');
});

test('dokumentumok feature page displays document dashboard visual', function () {
    $response = $this->get(route('features.dokumentumok'));

    $response->assertSee('Dokumentumközpont');
    $response->assertSee('1 284 dokumentum');
    $response->assertSee('342');
    $response->assertSee('187');
    $response->assertSee('TechBuild Kft. keretszerződés');
    $response->assertSee('Klímaberendezés árajánlat');
});

test('dokumentumok feature page displays document types section', function () {
    $response = $this->get(route('features.dokumentumok'));

    $response->assertSee('Árajánlatok');
    $response->assertSee('Szerződések és keretszerződések');
    $response->assertSee('Szerviz munkalapok');
    $response->assertSee('Szállítólevelek');
    $response->assertSee('Minőségi tanúsítványok');
    $response->assertSee('Vezetői riportok');
    $response->assertSee('Megrendelők és rendelés-visszaigazolások');
    $response->assertSee('Marketing anyagok és kampány-riportok');
});

test('dokumentumok feature page displays capabilities section', function () {
    $response = $this->get(route('features.dokumentumok'));

    $response->assertSee('Automatikus dokumentumgenerálás');
    $response->assertSee('Digitális aláírás');
    $response->assertSee('Sablon-rendszer céges arculattal');
    $response->assertSee('Verziókezelés és audit trail');
    $response->assertSee('Keresés és szűrés');
    $response->assertSee('Jogosultságkezelés és megosztás');
});

test('dokumentumok feature page displays module document map section', function () {
    $response = $this->get(route('features.dokumentumok'));

    $response->assertSee('CRM');
    $response->assertSee('Gyártásirányítás');
    $response->assertSee('Beszerzés-logisztika');
    $response->assertSee('Digitális munkalap');
    $response->assertSee('Kontrolling');
    $response->assertSee('Automatizálás');
});

test('dokumentumok feature page displays document workflow section', function () {
    $response = $this->get(route('features.dokumentumok'));

    $response->assertSee('Generálás');
    $response->assertSee('Szerkesztés');
    $response->assertSee('Jóváhagyás');
    $response->assertSee('Aláírás');
    $response->assertSee('Kiküldés');
    $response->assertSee('Archiválás');
});

test('dokumentumok feature page displays stats section', function () {
    $response = $this->get(route('features.dokumentumok'));

    $response->assertSee('data-count="80"', escape: false);
    $response->assertSee('data-count="0"', escape: false);
    $response->assertSee('data-count="95"', escape: false);
    $response->assertSee('data-count="100"', escape: false);
    $response->assertSee('Dokumentum-készítési idő');
    $response->assertSee('Elveszett dokumentum');
    $response->assertSee('Papírfelhasználás');
    $response->assertSee('Audit-nyomonkövethetőség');
});

test('dokumentumok feature page displays competitor comparison section', function () {
    $response = $this->get(route('features.dokumentumok'));

    $response->assertSee('Általános DMS rendszerek');
    $response->assertSee('ERP modulok');
    $response->assertSee('Cégem360');
    $response->assertSee('Nem generál dokumentumot');
    $response->assertSee('Automatikus generálás modulokból');
});

test('dokumentumok feature page displays comparison table', function () {
    $response = $this->get(route('features.dokumentumok'));

    $response->assertSee('Automatikus dokumentumgenerálás');
    $response->assertSee('Helyszíni e-aláírás');
    $response->assertSee('Fotódokumentáció');
    $response->assertSee('Jóváhagyási workflow');
    $response->assertSee('MI riportok és összefoglalók');
    $response->assertSee('Ipari dokumentumtípusok');
});

test('dokumentumok feature page displays use cases section', function () {
    $response = $this->get(route('features.dokumentumok'));

    $response->assertSee('Ajánlat küldése CRM-ből');
    $response->assertSee('Helyszíni szerviz munkalap e-aláírással');
    $response->assertSee('Automatikus heti vezetői riport');
    $response->assertSee('Szerződés-kezelés és automatikus megújítás');
    $response->assertSee('Minőségi tanúsítvány csatolása');
    $response->assertSee('Ügyfélportál: minden dokumentum egy helyen');
});

test('dokumentumok feature page displays CTA sections', function () {
    $response = $this->get(route('features.dokumentumok'));

    $response->assertSee('Személyre szabott online konzultáció');
    $response->assertSee('Regisztráció és kipróbálás');
    $response->assertSee('Készen áll a papírmentes ipari dokumentumkezelésre?');
});
