<?php

declare(strict_types=1);

test('marketing use-case page renders successfully', function () {
    $response = $this->get(route('usecases.marketing'));

    $response->assertStatus(200);
    $response->assertSee('B2B ipari marketing');
    $response->assertSee('adatvezérelt marketing eszközökkel');
});

test('marketing use-case page displays pain points section', function () {
    $response = $this->get(route('usecases.marketing'));

    $response->assertSee('Szétszórt adatforrások');
    $response->assertSee('Nem mérhető kampányok');
    $response->assertSee('Döntéshozók elérése');
    $response->assertSee('Manuális riportolás');
});

test('marketing use-case page displays target audience section', function () {
    $response = $this->get(route('usecases.marketing'));

    $response->assertSee('Beszerzési vezetők és referensek');
    $response->assertSee('Műszaki igazgatók és mérnökök');
    $response->assertSee('Ügyvezetők és tulajdonosok');
});

test('marketing use-case page displays core toolkit modules', function () {
    $response = $this->get(route('usecases.marketing'));

    $response->assertSee('MarketingHub');
    $response->assertSee('SEO Eszköz');
    $response->assertSee('DataMind');
    $response->assertSee('AI Chat');
});

test('marketing use-case page displays stats section', function () {
    $response = $this->get(route('usecases.marketing'));

    $response->assertSee('data-count="45"', escape: false);
    $response->assertSee('Marketing ROI növekedés');
    $response->assertSee('Organikus forgalom');
});

test('marketing use-case page displays use cases section', function () {
    $response = $this->get(route('usecases.marketing'));

    $response->assertSee('Lead generálás ipari beszerzőknek');
    $response->assertSee('Kampány-attribúció és ROI mérés');
    $response->assertSee('Marketing-Sales összehangolás');
});

test('marketing use-case page displays CTA sections', function () {
    $response = $this->get(route('usecases.marketing'));

    $response->assertSee('Online konzultáció');
    $response->assertSee('Regisztráció és kipróbálás');
    $response->assertSee('Készen áll a hatékonyabb B2B marketingre?');
});
