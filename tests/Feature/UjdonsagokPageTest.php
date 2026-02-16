<?php

declare(strict_types=1);

test('ujdonsagok page renders successfully', function () {
    $response = $this->get(route('ujdonsagok'));

    $response->assertStatus(200);
    $response->assertSee('Mi újság a Cégem360-ban?');
    $response->assertSee('Minden hónapban új funkciók');
});

test('ujdonsagok page displays hero filter buttons', function () {
    $response = $this->get(route('ujdonsagok'));

    $response->assertSee('Összes');
    $response->assertSee('Új funkció');
    $response->assertSee('Fejlesztés');
    $response->assertSee('Hibajavítás');
    $response->assertSee('Integráció');
});

test('ujdonsagok page displays february month block', function () {
    $response = $this->get(route('ujdonsagok'));

    $response->assertSee('2026. február');
    $response->assertSee('3 frissítés');
});

test('ujdonsagok page displays datamind anomaly entry', function () {
    $response = $this->get(route('ujdonsagok'));

    $response->assertSee('DataMind anomália-detekció');
    $response->assertSee('automatikus riasztás rendellenes üzleti adatokra');
    $response->assertSee('DataMind');
    $response->assertSee('AI Chat');
    $response->assertSee('Automatikus anomália-detekció bevétel');
});

test('ujdonsagok page displays digital worksheet entry', function () {
    $response = $this->get(route('ujdonsagok'));

    $response->assertSee('Digitális munkalap: offline mód');
    $response->assertSee('fotómegjegyzés a helyszíni munkához');
    $response->assertSee('Offline mód: teljes munkalap-kitöltés');
});

test('ujdonsagok page displays security fix entry', function () {
    $response = $this->get(route('ujdonsagok'));

    $response->assertSee('Jogosultságkezelés javítás és biztonsági frissítés');
    $response->assertSee('Biztonság');
    $response->assertSee('Session timeout');
});

test('ujdonsagok page displays january month block', function () {
    $response = $this->get(route('ujdonsagok'));

    $response->assertSee('2026. január');
    $response->assertSee('4 frissítés');
});

test('ujdonsagok page displays marketinghub entry', function () {
    $response = $this->get(route('ujdonsagok'));

    $response->assertSee('MarketingHub: hírlevél-kampányok a CRM-adatokra építve');
    $response->assertSee('CRM-szegmens alapú hírlevélküldés');
    $response->assertSee('A/B tesztelés');
});

test('ujdonsagok page displays kontrolling entry', function () {
    $response = $this->get(route('ujdonsagok'));

    $response->assertSee('Kontrolling: pénzforgalmi előrejelzés');
    $response->assertSee('cash flow dashboard');
    $response->assertSee('Cash flow előrejelzés');
});

test('ujdonsagok page displays performance entry', function () {
    $response = $this->get(route('ujdonsagok'));

    $response->assertSee('Rendszerszintű teljesítmény-optimalizálás');
    $response->assertSee('Teljesítmény');
    $response->assertSee('API válaszidő');
});

test('ujdonsagok page displays customer portal entry', function () {
    $response = $this->get(route('ujdonsagok'));

    $response->assertSee('Ügyfélportál béta');
    $response->assertSee('Béta');
    $response->assertSee('Rendelés-követés');
    $response->assertSee('Garancia-nyilvántartás');
});

test('ujdonsagok page displays stats section', function () {
    $response = $this->get(route('ujdonsagok'));

    $response->assertSee('A Cégem360 folyamatosan fejlődik');
    $response->assertSee('data-count="Havi"', escape: false);
    $response->assertSee('data-count="11"', escape: false);
    $response->assertSee('Frissítési ciklus');
    $response->assertSee('Aktív modul');
    $response->assertSee('Ügyfélvisszajelzés-alapú');
});

test('ujdonsagok page displays roadmap section', function () {
    $response = $this->get(route('ujdonsagok'));

    $response->assertSee('Amin most dolgozunk');
    $response->assertSee('Fejlesztés alatt');
    $response->assertSee('SEO modul');
    $response->assertSee('Tervezett');
    $response->assertSee('Többdevizás számlázás');
    $response->assertSee('Kutatás');
    $response->assertSee('Mobil app');
});

test('ujdonsagok page displays subscribe section', function () {
    $response = $this->get(route('ujdonsagok'));

    $response->assertSee('Tudjon elsőként az újdonságokról');
    $response->assertSee('Kapjon értesítést minden frissítésről');
    $response->assertSee('Hírlevél');
    $response->assertSee('RSS feed');
    $response->assertSee('LinkedIn');
});

test('ujdonsagok page displays CTA section', function () {
    $response = $this->get(route('ujdonsagok'));

    $response->assertSee('Kíváncsi az új funkciókra?');
    $response->assertSee('Konzultáció foglalása');
    $response->assertSee('Regisztráció és kipróbálás');
});
