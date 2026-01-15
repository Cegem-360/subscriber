<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Enums\BillingPeriod;
use App\Models\Plan;
use App\Models\Plan\PlanCategory;
use Illuminate\Database\Seeder;

class PlanSeeder extends Seeder
{
    /**
     * Pricing data for each module.
     * Yearly HUF, Monthly HUF (yearly/12 * 1.20), Yearly EUR, Monthly EUR.
     *
     * @var array<string, array{yearly_huf: int, monthly_huf: int, yearly_eur: int, monthly_eur: int}>
     */
    private array $pricing = [
        'kontrolling' => [
            'yearly_huf' => 350000,
            'monthly_huf' => 35000,
            'yearly_eur' => 875,
            'monthly_eur' => 88,
        ],
        'beszerzes-logisztika' => [
            'yearly_huf' => 370000,
            'monthly_huf' => 37000,
            'yearly_eur' => 925,
            'monthly_eur' => 93,
        ],
        'gyartasiranyitas' => [
            'yearly_huf' => 370000,
            'monthly_huf' => 37000,
            'yearly_eur' => 925,
            'monthly_eur' => 93,
        ],
        'automatizalas' => [
            'yearly_huf' => 370000,
            'monthly_huf' => 37000,
            'yearly_eur' => 925,
            'monthly_eur' => 93,
        ],
        'ertekesites' => [
            'yearly_huf' => 250000,
            'monthly_huf' => 25000,
            'yearly_eur' => 625,
            'monthly_eur' => 63,
        ],
        'crm' => [
            'yearly_huf' => 250000,
            'monthly_huf' => 25000,
            'yearly_eur' => 625,
            'monthly_eur' => 63,
        ],
    ];

    public function run(): void
    {
        $categories = PlanCategory::all();

        $categories->each(function (PlanCategory $category): void {
            $prices = $this->pricing[$category->slug] ?? [
                'yearly_huf' => 360000,
                'monthly_huf' => 36000,
                'yearly_eur' => 900,
                'monthly_eur' => 90,
            ];

            $features = $this->getFeaturesForCategory($category->slug);

            // Yearly plan
            Plan::factory()
                ->state([
                    'name' => $category->name . ' - Éves',
                    'is_active' => true,
                    'price' => $prices['yearly_huf'],
                    'price_eur' => $prices['yearly_eur'],
                    'billing_period' => BillingPeriod::Yearly,
                    'features' => $features,
                ])
                ->category($category->id)
                ->create();

            // Monthly plan
            Plan::factory()
                ->state([
                    'name' => $category->name . ' - Havi',
                    'is_active' => true,
                    'price' => $prices['monthly_huf'],
                    'price_eur' => $prices['monthly_eur'],
                    'billing_period' => BillingPeriod::Monthly,
                    'features' => $features,
                ])
                ->category($category->id)
                ->create();
        });
    }

    /**
     * @return array<int, string>
     */
    private function getFeaturesForCategory(string $slug): array
    {
        return match ($slug) {
            'kontrolling' => [
                'Google Analytics 4 integráció',
                'Google Search Console integráció',
                'Google Ads integráció',
                'Egyedi KPI-ok beállítása',
                'Automatikus heti/havi riportok',
                'E-mail és push értesítések',
                'Historikus adatelemzés',
                'Korlátlan felhasználó',
            ],
            'beszerzes-logisztika' => [
                'Raktárkészlet nyilvántartás',
                'Beszállítói adatbázis',
                'Megrendelés-kezelés',
                'Szállítmánykövetés',
                'Automatikus készletfigyelmeztetés',
                'Beszerzési javaslatok',
                'Beszállító értékelés',
                'Korlátlan felhasználó',
            ],
            'gyartasiranyitas' => [
                'Gyártási megrendelések kezelése',
                'Termelési ütemezés',
                'Kapacitástervezés',
                'Anyagszükséglet-tervezés (MRP)',
                'Minőségellenőrzés',
                'Gépkihasználtság követés',
                'Termelési riportok',
                'Korlátlan felhasználó',
            ],
            'automatizalas' => [
                'Vizuális workflow építő',
                'Jóváhagyási folyamatok',
                'Automatikus értesítések',
                'Határidő-emlékeztetők',
                'Dokumentum-generálás',
                'Feltételes logika',
                'Integráció más modulokkal',
                'Korlátlan felhasználó',
            ],
            'ertekesites' => [
                'Ajánlatkészítés',
                'Megrendelés-kezelés',
                'Értékesítési pipeline',
                'Teljesítmény dashboard',
                'Jutalékszámítás',
                'Dokumentumsablonok',
                'E-mail integráció',
                'Korlátlan felhasználó',
            ],
            'crm' => [
                'Ügyfél-adatbázis',
                'Kapcsolattartók kezelése',
                'Kommunikációs előzmények',
                'Feladat és emlékeztető',
                'Lead kezelés',
                'Ügyfélosztályozás',
                'Tömeges e-mail küldés',
                'Korlátlan felhasználó',
            ],
            default => [
                'Teljes funkcionalitás',
                'Email támogatás',
                'Automatikus frissítések',
                'Korlátlan felhasználó',
            ],
        };
    }
}
