<?php

declare(strict_types=1);

test('ugyfelsztorik page renders successfully', function (): void {
    $response = $this->get(route('company.ugyfelsztorik'));

    $response->assertStatus(200);
    $response->assertSee('Valós eredmények,');
    $response->assertSee('valós ipari cégektől');
});

test('ugyfelsztorik page displays hero filter buttons', function (): void {
    $response = $this->get(route('company.ugyfelsztorik'));

    $response->assertSee('Összes');
    $response->assertSee('Gyártás');
    $response->assertSee('Kereskedelem');
    $response->assertSee('Építőipar');
    $response->assertSee('Szolgáltatás');
});

test('ugyfelsztorik page displays PrecizTech story card', function (): void {
    $response = $this->get(route('company.ugyfelsztorik'));

    $response->assertSee('PrecízTech Kft.');
    $response->assertSee('selejt-arányt 40%-kal');
    $response->assertSee('-40%');
    $response->assertSee('87%');
    $response->assertSee('OEE átlag');
    $response->assertSee('Üzemvezető, PrecízTech Kft.');
});

test('ugyfelsztorik page displays SzervizPont story card', function (): void {
    $response = $this->get(route('company.ugyfelsztorik'));

    $response->assertSee('SzervizPont Zrt.');
    $response->assertSee('15 technikusát koordinálja');
    $response->assertSee('96%');
    $response->assertSee('SLA-teljesítés');
    $response->assertSee('-65%');
    $response->assertSee('Szervizmenedzser, SzervizPont Zrt.');
});

test('ugyfelsztorik page displays IndusztriParts story card', function (): void {
    $response = $this->get(route('company.ugyfelsztorik'));

    $response->assertSee('IndusztriParts Kft.');
    $response->assertSee('ajánlat–megrendelés konverziót');
    $response->assertSee('+35%');
    $response->assertSee('Konverzió');
    $response->assertSee('-60%');
    $response->assertSee('Értékesítési vezető, IndusztriParts Kft.');
});

test('ugyfelsztorik page displays module tags', function (): void {
    $response = $this->get(route('company.ugyfelsztorik'));

    $response->assertSee('Gyártásirányítás');
    $response->assertSee('Digitális munkalap');
    $response->assertSee('DataMind MI');
    $response->assertSee('Irányítópultok');
    $response->assertSee('CRM');
    $response->assertSee('Automatizálás');
    $response->assertSee('Értékesítés');
    $response->assertSee('Kontrolling');
});

test('ugyfelsztorik page displays more stories teaser', function (): void {
    $response = $this->get(route('company.ugyfelsztorik'));

    $response->assertSee('Folyamatosan bővülő ügyfélsztorik');
    $response->assertSee('További esettanulmányok hamarosan');
    $response->assertSee('Értesítsen az új sztorikról');
});

test('ugyfelsztorik page displays anatomy section', function (): void {
    $response = $this->get(route('company.ugyfelsztorik'));

    $response->assertSee('Minden sztorinkat így építjük fel');
    $response->assertSee('Cég és iparág');
    $response->assertSee('Kihívás');
    $response->assertSee('Megoldás');
    $response->assertSee('Eredmények');
});

test('ugyfelsztorik page displays stats section', function (): void {
    $response = $this->get(route('company.ugyfelsztorik'));

    $response->assertSee('Amit az ügyfeleink együtt elértek');
    $response->assertSee('data-count="52"', escape: false);
    $response->assertSee('data-count="34"', escape: false);
    $response->assertSee('Átlagos admin-idő csökkenés');
    $response->assertSee('Ügyfél-elégedettség');
});

test('ugyfelsztorik page displays CTA section', function (): void {
    $response = $this->get(route('company.ugyfelsztorik'));

    $response->assertSee('Az Ön cége is lehet a következő sztori');
    $response->assertSee('Konzultáció foglalása');
    $response->assertSee('Regisztráció és kipróbálás');
    $response->assertSee('30 perc videóhívás');
});
