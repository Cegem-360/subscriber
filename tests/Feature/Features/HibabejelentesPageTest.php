<?php

declare(strict_types=1);

test('hibabejelentes page renders successfully', function (): void {
    $response = $this->get(route('hibabejelentes'));

    $response->assertStatus(200);
    $response->assertSee('Technikai probléma jelzése');
    $response->assertSee('a Cégem360 csapatnak');
});

test('hibabejelentes page displays hero info bar', function (): void {
    $response = $this->get(route('hibabejelentes'));

    $response->assertSee('Hibabejelentés');
    $response->assertSee('válaszidő');
    $response->assertSee('kezelés');
    $response->assertSee('E-mail értesítés');
});

test('hibabejelentes page displays bug report form', function (): void {
    $response = $this->get(route('hibabejelentes'));

    $response->assertSee('Hibabejelentő űrlap');
    $response->assertSee('Bejelentő adatai');
    $response->assertSee('Hiba részletei');
    $response->assertSee('Prioritás');
    $response->assertSee('Képernyőkép / csatolmány');
});

test('hibabejelentes page displays form fields', function (): void {
    $response = $this->get(route('hibabejelentes'));

    $response->assertSee('name="name"', escape: false);
    $response->assertSee('name="email"', escape: false);
    $response->assertSee('name="company"', escape: false);
    $response->assertSee('name="module"', escape: false);
    $response->assertSee('name="issue_type"', escape: false);
    $response->assertSee('name="subject"', escape: false);
    $response->assertSee('name="description"', escape: false);
    $response->assertSee('name="priority"', escape: false);
});

test('hibabejelentes page displays module options', function (): void {
    $response = $this->get(route('hibabejelentes'));

    $response->assertSee('CRM');
    $response->assertSee('Értékesítés');
    $response->assertSee('Gyártásirányítás');
    $response->assertSee('Kontrolling');
    $response->assertSee('DataMind (MI)');
});

test('hibabejelentes page displays priority options', function (): void {
    $response = $this->get(route('hibabejelentes'));

    $response->assertSee('Kritikus');
    $response->assertSee('Magas');
    $response->assertSee('Normál');
    $response->assertSee('Alacsony');
});

test('hibabejelentes page displays sidebar with SLA', function (): void {
    $response = $this->get(route('hibabejelentes'));

    $response->assertSee('Válaszidők prioritás szerint');
    $response->assertSee('&lt; 1 óra', escape: false);
    $response->assertSee('&lt; 4 óra', escape: false);
    $response->assertSee('&lt; 8 óra', escape: false);
    $response->assertSee('&lt; 24 óra', escape: false);
});

test('hibabejelentes page displays sidebar tips', function (): void {
    $response = $this->get(route('hibabejelentes'));

    $response->assertSee('Tippek a gyorsabb megoldáshoz');
    $response->assertSee('Csatoljon képernyőképet');
    $response->assertSee('Másolja be a hibaüzenet pontos szövegét');
});

test('hibabejelentes page displays alternative channels', function (): void {
    $response = $this->get(route('hibabejelentes'));

    $response->assertSee('Egyéb elérhetőségek');
    $response->assertSee('AI Chat');
    $response->assertSee('support@cegem360.eu');
    $response->assertSee('24/7 Támogatás oldal');
});

test('hibabejelentes page displays system status', function (): void {
    $response = $this->get(route('hibabejelentes'));

    $response->assertSee('jelenleg elérhető');
});

test('hibabejelentes page displays after-form steps section', function (): void {
    $response = $this->get(route('hibabejelentes'));

    $response->assertSee('3 lépésben a megoldásig');
    $response->assertSee('1. Visszaigazolás azonnal');
    $response->assertSee('2. Vizsgálat és diagnózis');
    $response->assertSee('3. Megoldás és lezárás');
});

test('hibabejelentes page displays footer CTA section', function (): void {
    $response = $this->get(route('hibabejelentes'));

    $response->assertSee('Nem hiba, hanem kérdés?');
    $response->assertSee('Támogatás oldal');
});
