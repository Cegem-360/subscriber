<?php

declare(strict_types=1);

namespace App\Livewire;

use Livewire\Component;

final class PricingPage extends Component
{
    public string $currency = 'HUF';

    public bool $isYearly = true;

    private const EUR_RATE = 400;

    private const MONTHLY_MARKUP = 1.20;

    public function toggleCurrency(): void
    {
        $this->currency = $this->currency === 'HUF' ? 'EUR' : 'HUF';
    }

    public function toggleBillingCycle(): void
    {
        $this->isYearly = ! $this->isYearly;
    }

    public function getModulesProperty(): array
    {
        return [
            [
                'id' => 'kontrolling',
                'name' => 'Kontrolling',
                'subtitle' => 'és döntéstámogatás',
                'description' => 'Valós idejű marketing és pénzügyi adatok egyetlen dashboardon.',
                'yearlyPriceHUF' => 350000,
                'color' => '#10B981',
                'icon' => 'chart-bar',
                'features' => [
                    'Google Analytics 4 integráció',
                    'Google Search Console integráció',
                    'Google Ads integráció',
                    'Egyedi KPI-ok beállítása',
                    'Automatikus heti/havi riportok',
                    'E-mail és push értesítések',
                    'Korlátlan felhasználó',
                ],
            ],
            [
                'id' => 'beszerzes',
                'name' => 'Beszerzés',
                'subtitle' => 'és logisztika',
                'description' => 'Raktárkészlet-nyilvántartás, beszállítói megrendelések és szállítmánykövetés.',
                'yearlyPriceHUF' => 370000,
                'color' => '#F59E0B',
                'icon' => 'cube',
                'features' => [
                    'Raktárkészlet nyilvántartás',
                    'Beszállítói adatbázis',
                    'Megrendelés-kezelés',
                    'Szállítmánykövetés',
                    'Automatikus készletfigyelmeztetés',
                    'Beszerzési javaslatok',
                    'Korlátlan felhasználó',
                ],
            ],
            [
                'id' => 'gyartas',
                'name' => 'Gyártásirányítás',
                'subtitle' => 'és termelés',
                'description' => 'Termelési folyamatok tervezése, gyártási megrendelések és kapacitás-optimalizálás.',
                'yearlyPriceHUF' => 370000,
                'color' => '#6366F1',
                'icon' => 'cog',
                'features' => [
                    'Gyártási megrendelések kezelése',
                    'Termelési ütemezés',
                    'Kapacitástervezés',
                    'Anyagszükséglet-tervezés (MRP)',
                    'Minőségellenőrzés',
                    'Gépkihasználtság követés',
                    'Korlátlan felhasználó',
                ],
            ],
            [
                'id' => 'automatizalas',
                'name' => 'Automatizálás',
                'subtitle' => 'és workflow',
                'description' => 'Ismétlődő feladatok automatizálása, jóváhagyási folyamatok — programozás nélkül.',
                'yearlyPriceHUF' => 370000,
                'color' => '#8B5CF6',
                'icon' => 'refresh',
                'features' => [
                    'Vizuális workflow építő',
                    'Jóváhagyási folyamatok',
                    'Automatikus értesítések',
                    'Határidő-emlékeztetők',
                    'Dokumentum-generálás',
                    'Feltételes logika',
                    'Korlátlan felhasználó',
                ],
            ],
            [
                'id' => 'ertekesites',
                'name' => 'Értékesítés',
                'subtitle' => 'és pipeline',
                'description' => 'Ajánlatok készítése, megrendelés-kezelés és értékesítési teljesítmény nyomon követése.',
                'yearlyPriceHUF' => 250000,
                'color' => '#EF4444',
                'icon' => 'currency-dollar',
                'features' => [
                    'Ajánlatkészítés',
                    'Megrendelés-kezelés',
                    'Értékesítési pipeline',
                    'Teljesítmény dashboard',
                    'Jutalékszámítás',
                    'Dokumentumsablonok',
                    'Korlátlan felhasználó',
                ],
            ],
            [
                'id' => 'crm',
                'name' => 'CRM',
                'subtitle' => 'ügyfélkapcsolat-kezelés',
                'description' => 'Ügyfelek és kapcsolatok kezelése az első megkeresésétől a hosszú távú partnerségig.',
                'yearlyPriceHUF' => 250000,
                'color' => '#0EA5E9',
                'icon' => 'users',
                'features' => [
                    'Ügyfél-adatbázis',
                    'Kapcsolattartók kezelése',
                    'Kommunikációs előzmények',
                    'Feladat és emlékeztető',
                    'Lead kezelés',
                    'Ügyfélosztályozás',
                    'Korlátlan felhasználó',
                ],
            ],
        ];
    }

    public function calculatePrice(int $yearlyPriceHUF): string
    {
        if ($this->isYearly) {
            $price = $this->currency === 'EUR'
                ? round($yearlyPriceHUF / self::EUR_RATE)
                : $yearlyPriceHUF;
        } else {
            $monthlyHUF = round(($yearlyPriceHUF / 12) * self::MONTHLY_MARKUP);
            $price = $this->currency === 'EUR'
                ? round($monthlyHUF / self::EUR_RATE)
                : $monthlyHUF;
        }

        return number_format($price, 0, ',', ' ');
    }

    public function calculateYearlyPrice(int $yearlyPriceHUF): string
    {
        $price = $this->currency === 'EUR'
            ? round($yearlyPriceHUF / self::EUR_RATE)
            : $yearlyPriceHUF;

        return number_format($price, 0, ',', ' ');
    }

    public function getCurrencySymbol(): string
    {
        return $this->currency === 'EUR' ? '€' : 'Ft';
    }

    public function getFaqsProperty(): array
    {
        return [
            [
                'question' => 'Kipróbálhatom a modulokat vásárlás előtt?',
                'answer' => 'Igen, minden modult 14 napig ingyenesen kipróbálhat, teljes funkcionalitással. A próbaidőszak végén dönthet az előfizetésről — nincs automatikus terhelés.',
            ],
            [
                'question' => 'Válthat-e havi és éves előfizetés között?',
                'answer' => 'Igen, bármikor válthat. Havi előfizetésről éves előfizetésre váltva a fennmaradó összeg jóváírásra kerül. Éves előfizetésről havira váltás az éves időszak lejártakor lehetséges.',
            ],
            [
                'question' => 'Mi történik, ha lemondja az előfizetést?',
                'answer' => 'Lemondás esetén a szolgáltatás a kifizetett időszak végéig elérhető marad. Éves előfizetés esetén nincs arányos visszatérítés, de adatait 30 napig megőrizzük exportálásra.',
            ],
            [
                'question' => 'Van felhasználói létszám korlát?',
                'answer' => 'Nem, minden modulhoz korlátlan számú felhasználót adhat hozzá külön díj nélkül. A felhasználók jogosultsági szintjeit a központi dashboardon állíthatja be.',
            ],
            [
                'question' => 'Kapok számlát az előfizetésről?',
                'answer' => 'Igen, minden előfizetésről magyar nyelvű, NAV-kompatibilis számlát állítunk ki. Magyar cégek esetén az ár ÁFÁ-t tartalmaz, EU-s cégek esetén fordított adózás érvényesül.',
            ],
            [
                'question' => 'Használhatok több modult egyszerre?',
                'answer' => 'Igen, a modulok teljesen integráltak, és egy közös felületen keresztül érhetők el. Az adatok átjárnak a modulok között, így például a CRM-ből közvetlenül indíthat értékesítési folyamatot.',
            ],
            [
                'question' => 'Biztonságban vannak az adataim?',
                'answer' => 'Igen. Titkosított kapcsolat (HTTPS), GDPR-kompatibilis adatkezelés, rendszeres biztonsági mentések. Az adatok EU-n belüli szervereken tárolódnak.',
            ],
        ];
    }

    public function render()
    {
        return view('livewire.pricing-page')
            ->layout('components.layouts.app');
    }
}
