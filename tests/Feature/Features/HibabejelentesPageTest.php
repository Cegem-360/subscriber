<?php

declare(strict_types=1);

test('hibabejelentes page renders successfully', function () {
    $response = $this->get(route('hibabejelentes'));

    $response->assertStatus(200);
    $response->assertSee('Technikai problema jelzese');
    $response->assertSee('a Cegem360 csapatnak');
});

test('hibabejelentes page displays hero info bar', function () {
    $response = $this->get(route('hibabejelentes'));

    $response->assertSee('Hibabejelentes');
    $response->assertSee('valaszido');
    $response->assertSee('kezeles');
    $response->assertSee('E-mail ertesites');
});

test('hibabejelentes page displays bug report form', function () {
    $response = $this->get(route('hibabejelentes'));

    $response->assertSee('Hibabejelento urlap');
    $response->assertSee('Bejelento adatai');
    $response->assertSee('Hiba reszletei');
    $response->assertSee('Prioritas');
    $response->assertSee('Kepernykep / csatolmany');
});

test('hibabejelentes page displays form fields', function () {
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

test('hibabejelentes page displays module options', function () {
    $response = $this->get(route('hibabejelentes'));

    $response->assertSee('CRM');
    $response->assertSee('Ertekesites');
    $response->assertSee('Gyartasiranyitas');
    $response->assertSee('Kontrolling');
    $response->assertSee('DataMind (MI)');
});

test('hibabejelentes page displays priority options', function () {
    $response = $this->get(route('hibabejelentes'));

    $response->assertSee('Kritikus');
    $response->assertSee('Magas');
    $response->assertSee('Normal');
    $response->assertSee('Alacsony');
});

test('hibabejelentes page displays sidebar with SLA', function () {
    $response = $this->get(route('hibabejelentes'));

    $response->assertSee('Valaszidok prioritas szerint');
    $response->assertSee('&lt; 1 ora', escape: false);
    $response->assertSee('&lt; 4 ora', escape: false);
    $response->assertSee('&lt; 8 ora', escape: false);
    $response->assertSee('&lt; 24 ora', escape: false);
});

test('hibabejelentes page displays sidebar tips', function () {
    $response = $this->get(route('hibabejelentes'));

    $response->assertSee('Tippek a gyorsabb megoldashoz');
    $response->assertSee('Csatoljon kepernykepet');
    $response->assertSee('Masolja be a hibauzenet pontos szoveget');
});

test('hibabejelentes page displays alternative channels', function () {
    $response = $this->get(route('hibabejelentes'));

    $response->assertSee('Egyeb elerhetosegek');
    $response->assertSee('AI Chat');
    $response->assertSee('support@cegem360.eu');
    $response->assertSee('24/7 Tamogatas oldal');
});

test('hibabejelentes page displays system status', function () {
    $response = $this->get(route('hibabejelentes'));

    $response->assertSee('jelenleg elerheto');
});

test('hibabejelentes page displays after-form steps section', function () {
    $response = $this->get(route('hibabejelentes'));

    $response->assertSee('3 lepesben a megoldasig');
    $response->assertSee('Visszaigazolas azonnal');
    $response->assertSee('Vizsgalat es diagnozis');
    $response->assertSee('Megoldas es lezaras');
});

test('hibabejelentes page displays footer CTA section', function () {
    $response = $this->get(route('hibabejelentes'));

    $response->assertSee('Nem hiba, hanem kerdes?');
    $response->assertSee('Tamogatas oldal');
});
