<?php

declare(strict_types=1);

test('ai feature page renders successfully', function (): void {
    $response = $this->get(route('features.ai'));

    $response->assertStatus(200);
    $response->assertSee('Mesterséges intelligencia');
    $response->assertSee('beépítve az ipari vállalatirányításba');
});

test('ai feature page displays AI dashboard visual', function (): void {
    $response = $this->get(route('features.ai'));

    $response->assertSee('MI Irányítópult');
    $response->assertSee('MI aktív');
    $response->assertSee('DataMind reggeli összefoglaló');
    $response->assertSee('Q1 árbevétel 12% terv felett');
    $response->assertSee('3 ügyfél churn-kockázat');
    $response->assertSee('SZ-2026-0142');
    $response->assertSee('Q1 terv-teljesítés');
    $response->assertSee('Churn-kockázat');
    $response->assertSee('MI javaslat ma');
    $response->assertSee('DataMind elemez');
    $response->assertSee('AI Chat online');
    $response->assertSee('11 modul forrás');
});

test('ai feature page displays two pillars section', function (): void {
    $response = $this->get(route('features.ai'));

    $response->assertSee('DataMind elemez');
    $response->assertSee('AI Chat válaszol');
    $response->assertSee('Elemzés, predikció és döntéstámogatás');
    $response->assertSee('Ügyfélszolgálat, belső segédlet és információ');
    $response->assertSee('Reggeli összefoglaló');
    $response->assertSee('Churn-predikció');
    $response->assertSee('Ügyfélportál chatbot');
    $response->assertSee('Live handoff');
});

test('ai feature page displays capabilities section', function (): void {
    $response = $this->get(route('features.ai'));

    $response->assertSee('Prediktív elemzés');
    $response->assertSee('Anomália-detekció');
    $response->assertSee('Természetes nyelvű kérdezés');
    $response->assertSee('Automatikus összefoglalók');
    $response->assertSee('Javaslat-motor');
    $response->assertSee('Adatbiztonság és jogosultság');
});

test('ai feature page displays module AI map', function (): void {
    $response = $this->get(route('features.ai'));

    $response->assertSee('CRM');
    $response->assertSee('Gyártásirányítás');
    $response->assertSee('Beszerzés-logisztika');
    $response->assertSee('Kontrolling');
    $response->assertSee('Szerviz');
    $response->assertSee('MarketingHub');
    $response->assertSee('Cross-sell javaslat');
    $response->assertSee('Prediktív karbantartás');
    $response->assertSee('Cash flow előrejelzés');
});

test('ai feature page displays NLQ section', function (): void {
    $response = $this->get(route('features.ai'));

    $response->assertSee('Kérdezz magyarul');
    $response->assertSee('Top 5 ügyfél árbevétel szerint');
    $response->assertSee('Milyen karbantartások esedékesek');
    $response->assertSee('Melyik gyártósoron volt a legnagyobb selejt-arány');
    $response->assertSee('Mekkora a pipeline érték');
    $response->assertSee('Forrás: CRM');
});

test('ai feature page displays stats section', function (): void {
    $response = $this->get(route('features.ai'));

    $response->assertSee('data-count="5"', escape: false);
    $response->assertSee('data-suffix="×"', escape: false);
    $response->assertSee('data-count="90"', escape: false);
    $response->assertSee('data-prefix="-"', escape: false);
    $response->assertSee('data-count="95"', escape: false);
    $response->assertSee('data-count="24/7"', escape: false);
    $response->assertSee('Gyorsabb döntéshozatal');
    $response->assertSee('Riport-készítési idő');
    $response->assertSee('Predikciós pontosság');
    $response->assertSee('AI Chat elérhetőség');
});

test('ai feature page displays use cases section', function (): void {
    $response = $this->get(route('features.ai'));

    $response->assertSee('Reggeli MI összefoglaló a CEO-nak');
    $response->assertSee('Churn-predikció és proaktív retention');
    $response->assertSee('szervizjegy-követés AI Chatbottal');
    $response->assertSee('Prediktív karbantartás gyártósoron');
    $response->assertSee('Cash flow előrejelzés a CFO-nak');
    $response->assertSee('Belső adatlekérdezés természetes nyelven');
});

test('ai feature page displays competitor comparison section', function (): void {
    $response = $this->get(route('features.ai'));

    $response->assertSee('Általános MI eszközök');
    $response->assertSee('BI + MI bővítmények');
    $response->assertSee('Cégem360 MI');
    $response->assertSee('Nem lát az ERP/CRM adatokba');
    $response->assertSee('11 modul valós adatain dolgozik');
});

test('ai feature page displays comparison table', function (): void {
    $response = $this->get(route('features.ai'));

    $response->assertSee('Modulok közötti adathozzáférés');
    $response->assertSee('Prediktív elemzés');
    $response->assertSee('Természetes nyelvű kérdezés (NLQ)');
    $response->assertSee('AI Chatbot');
    $response->assertSee('Anomália-detekció');
    $response->assertSee('Workflow-integráció');
    $response->assertSee('Magyar nyelvi támogatás');
    $response->assertSee('Árazási modell');
});

test('ai feature page displays CTA sections', function (): void {
    $response = $this->get(route('features.ai'));

    $response->assertSee('Személyre szabott MI konzultáció');
    $response->assertSee('Regisztráció és kipróbálás');
    $response->assertSee('MI-vel támogatott vállalatirányításra');
    $response->assertSee('MI konzultáció');
});
