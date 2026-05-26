<?php

declare(strict_types=1);

test('tamogatas feature page renders successfully', function (): void {
    $response = $this->get(route('features.tamogatas'));

    $response->assertStatus(200);
    $response->assertSee('Éjjel az AI válaszol');
    $response->assertSee('nappal a csapatunk is ott van');
});

test('tamogatas feature page displays hero support visual', function (): void {
    $response = $this->get(route('features.tamogatas'));

    $response->assertSee('Támogatás');
    $response->assertSee('AI Chat + Emberi ügyfélszolgálat');
    $response->assertSee('AI Chat · 24/7');
    $response->assertSee('Csapat · H–P 8–16h');
    $response->assertSee('Hozzáférés megtagadva');
    $response->assertSee('AI Chat online');
});

test('tamogatas feature page displays two pillars section', function (): void {
    $response = $this->get(route('features.tamogatas'));

    $response->assertSee('AI Chat');
    $response->assertSee('Emberi ügyfélszolgálat');
    $response->assertSee('Azonnali válasz, a rendszer adataira építve');
    $response->assertSee('Szakértő csapat a komplex ügyekre');
    $response->assertSee('Szervizjegy-státusz, számla, garancia lekérdezés');
    $response->assertSee('Technikai hibaelhárítás és bugfix');
});

test('tamogatas feature page displays how it works section', function (): void {
    $response = $this->get(route('features.tamogatas'));

    $response->assertSee('A kérdéstől a megoldásig');
    $response->assertSee('Kérdés érkezik');
    $response->assertSee('AI Chat válaszol');
    $response->assertSee('Megoldva?');
    $response->assertSee('Csapat átveszi');
    $response->assertSee('Megoldás');
});

test('tamogatas feature page displays contact channels section', function (): void {
    $response = $this->get(route('features.tamogatas'));

    $response->assertSee('Három csatorna');
    $response->assertSee('AI Chat');
    $response->assertSee('E-mail');
    $response->assertSee('Hibabejelentő űrlap');
    $response->assertSee('support@cegem360.eu');
});

test('tamogatas feature page displays AI chat capabilities section', function (): void {
    $response = $this->get(route('features.tamogatas'));

    $response->assertSee('Nem generikus chatbot');
    $response->assertSee('Státusz-lekérdezés');
    $response->assertSee('Használati útmutató');
    $response->assertSee('Hibaelhárítás');
    $response->assertSee('Automatikus ticket-nyitás');
    $response->assertSee('Live handoff');
    $response->assertSee('Magyar nyelv');
});

test('tamogatas feature page displays example dialogues section', function (): void {
    $response = $this->get(route('features.tamogatas'));

    $response->assertSee('Ilyen kérdésekre válaszol az AI Chat');
    $response->assertSee('SZ-2026-0142');
    $response->assertSee('Hogyan hozhatok létre új ajánlatot');
    $response->assertSee('KARB-2024-0087');
});

test('tamogatas feature page displays SLA section', function (): void {
    $response = $this->get(route('features.tamogatas'));

    $response->assertSee('Mire számíthat');
    $response->assertSee('AI Chat válaszidők');
    $response->assertSee('Emberi support válaszidők');
    $response->assertSee('&lt; 2 mp', escape: false);
    $response->assertSee('&lt; 4 óra', escape: false);
});

test('tamogatas feature page displays stats section', function (): void {
    $response = $this->get(route('features.tamogatas'));

    $response->assertSee('data-count="24/7"', escape: false);
    $response->assertSee('data-count="85"', escape: false);
    $response->assertSee('AI Chat elérhetőség');
    $response->assertSee('AI válaszidő');
    $response->assertSee('AI által megoldott kérdés');
    $response->assertSee('Emberi válaszidő (átlag)');
});

test('tamogatas feature page displays competitor comparison section', function (): void {
    $response = $this->get(route('features.tamogatas'));

    $response->assertSee('Hagyományos helpdesk');
    $response->assertSee('Generikus chatbotok');
    $response->assertSee('Cégem360 Támogatás');
    $response->assertSee('Csak munkaidőben elérhető');
    $response->assertSee('Nem ismeri a rendszer adatait');
});

test('tamogatas feature page displays comparison table', function (): void {
    $response = $this->get(route('features.tamogatas'));

    $response->assertSee('24/7 elérhetőség');
    $response->assertSee('Rendszeradatokra épülő válasz');
    $response->assertSee('Emberi support komplex ügyekre');
    $response->assertSee('Automatikus ticket-nyitás');
    $response->assertSee('Magyar nyelv és ipari terminológia');
});

test('tamogatas feature page displays CTA sections', function (): void {
    $response = $this->get(route('features.tamogatas'));

    $response->assertSee('Kérdése van? Vegye fel a kapcsolatot!');
    $response->assertSee('Hibabejelentés');
    $response->assertSee('Regisztráció és kipróbálás');
    $response->assertSee('Válassza ki a leggyorsabb utat a megoldásig');
});
