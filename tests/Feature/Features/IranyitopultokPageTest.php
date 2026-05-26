<?php

declare(strict_types=1);

test('iranyitopultok feature page renders successfully', function (): void {
    $response = $this->get(route('features.iranyitopultok'));

    $response->assertSuccessful();
    $response->assertSee('Minden szám, egyetlen képernyőn');
    $response->assertSee('az Ön szerepkörére szabva');
});

test('iranyitopultok feature page displays dashboard visual', function (): void {
    $response = $this->get(route('features.iranyitopultok'));

    $response->assertSee('Vezetői irányítópult');
    $response->assertSee('187.4M');
    $response->assertSee('Pipeline érték');
    $response->assertSee('Terv-teljesítés');
    $response->assertSee('Átlag SLA válasz');
    $response->assertSee('OEE üzem');
    $response->assertSee('TechBuild Kft.');
    $response->assertSee('Valós idejű');
    $response->assertSee('11 modul forrás');
});

test('iranyitopultok feature page displays role dashboards section', function (): void {
    $response = $this->get(route('features.iranyitopultok'));

    $response->assertSee('Szerepkör-alapú dashboardok');
    $response->assertSee('CEO / Ügyvezető');
    $response->assertSee('Értékesítési vezető');
    $response->assertSee('CFO / Pénzügyi vezető');
    $response->assertSee('Üzemvezető / Termelés');
    $response->assertSee('Szervizmenedzser');
    $response->assertSee('Beszerzési vezető');
});

test('iranyitopultok feature page displays capabilities section', function (): void {
    $response = $this->get(route('features.iranyitopultok'));

    $response->assertSee('Drag-and-drop widget-rendszer');
    $response->assertSee('Szerepkör-alapú alapértelmezés');
    $response->assertSee('Valós idejű frissítés');
    $response->assertSee('Mobil-elérés');
    $response->assertSee('Modul-átívelő adatok');
    $response->assertSee('Export és megosztás');
});

test('iranyitopultok feature page displays widget library section', function (): void {
    $response = $this->get(route('features.iranyitopultok'));

    $response->assertSee('Widget-könyvtár');
    $response->assertSee('KPI-kártya');
    $response->assertSee('Oszlopdiagram');
    $response->assertSee('Vonaldiagram');
    $response->assertSee('Kör/fánk diagram');
    $response->assertSee('Térkép');
    $response->assertSee('Gauge / sebességmérő');
    $response->assertSee('Hőtérkép');
    $response->assertSee('MI összefoglaló');
    $response->assertSee('Aktivitás-feed');
    $response->assertSee('Pipeline funnel');
});

test('iranyitopultok feature page displays module dashboards section', function (): void {
    $response = $this->get(route('features.iranyitopultok'));

    $response->assertSee('Modul-irányítópultok');
    $response->assertSee('Értékesítési dashboard');
    $response->assertSee('Termelés dashboard');
    $response->assertSee('Készlet dashboard');
    $response->assertSee('Pénzügyi dashboard');
    $response->assertSee('Szerviz dashboard');
    $response->assertSee('Marketing dashboard');
});

test('iranyitopultok feature page displays dashboard builder section', function (): void {
    $response = $this->get(route('features.iranyitopultok'));

    $response->assertSee('Dashboard-építő');
    $response->assertSee('4 lépésben összeállítható');
    $response->assertSee('Új dashboard');
    $response->assertSee('Widget-ek kiválasztása');
    $response->assertSee('Szűrők és adat');
    $response->assertSee('Mentés és megosztás');
    $response->assertSee('Heti vezetői áttekintés');
});

test('iranyitopultok feature page displays stats section', function (): void {
    $response = $this->get(route('features.iranyitopultok'));

    $response->assertSee('data-count="90"', escape: false);
    $response->assertSee('data-prefix="-"', escape: false);
    $response->assertSee('data-count="5"', escape: false);
    $response->assertSee('data-suffix="×"', escape: false);
    $response->assertSee('data-count="40"', escape: false);
    $response->assertSee('Riport-készítési idő');
    $response->assertSee('Gyorsabb döntéshozatal');
    $response->assertSee('Widget a könyvtárban');
});

test('iranyitopultok feature page displays use cases section', function (): void {
    $response = $this->get(route('features.iranyitopultok'));

    $response->assertSee('CEO reggeli áttekintés');
    $response->assertSee('Értékesítési heti meeting adattal');
    $response->assertSee('Üzemvezető műszak-áttekintés mobilon');
    $response->assertSee('Automatikus heti PDF riport e-mailben');
    $response->assertSee('Szervizmenedzser helyszíni koordinálás');
    $response->assertSee('Egyedi projekt-dashboard az ügyfélnek');
});

test('iranyitopultok feature page displays competitor comparison section', function (): void {
    $response = $this->get(route('features.iranyitopultok'));

    $response->assertSee('Külső BI eszközök');
    $response->assertSee('ERP beépített riportok');
    $response->assertSee('Cégem360');
    $response->assertSee('ETL pipeline szükséges');
    $response->assertSee('Valós idejű adat — nincs ETL');
    $response->assertSee('Drag-and-drop widget-rendszer, 40+ widget');
});

test('iranyitopultok feature page displays comparison table', function (): void {
    $response = $this->get(route('features.iranyitopultok'));

    $response->assertSee('Irányítópult képesség-összehasonlítás');
    $response->assertSee('Valós idejű adat');
    $response->assertSee('Szerepkör-alapú alapértelmezés');
    $response->assertSee('Modul-átívelő adatok');
    $response->assertSee('MI összefoglaló widget');
    $response->assertSee('Bevezetési idő');
    $response->assertSee('Ipari KPI-k beépítve');
});

test('iranyitopultok feature page displays CTA sections', function (): void {
    $response = $this->get(route('features.iranyitopultok'));

    $response->assertSee('Személyre szabott dashboard-konzultáció');
    $response->assertSee('Dashboard konzultáció');
    $response->assertSee('Regisztráció és kipróbálás');
    $response->assertSee('Készen áll a valós idejű ipari irányítópultokra');
});
