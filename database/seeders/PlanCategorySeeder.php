<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Plan\PlanCategory;
use Illuminate\Database\Seeder;

class PlanCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PlanCategory::factory()->createMany([
            [
                'name' => 'Kontrolling és döntéstámogatás',
                'slug' => 'kontrolling',
                'url' => 'https://kontrolling.cegem360.eu',
                'description' => 'Valós idejű marketing és pénzügyi adatok egyetlen dashboardon. Google Analytics, Search Console és Ads integráció, KPI-ok, automatikus riportok.',
                'color' => '#10B981',
                'icon' => 'chart-bar',
            ],
            [
                'name' => 'Beszerzési-logisztikai szoftver',
                'slug' => 'beszerzes-logisztika',
                'url' => 'https://beszerzes.cegem360.eu',
                'description' => 'Raktárkészlet-nyilvántartás, beszállítói megrendelések és szállítmánykövetés egy átlátható rendszerben.',
                'color' => '#F59E0B',
                'icon' => 'cube',
            ],
            [
                'name' => 'Gyártásirányítási rendszer',
                'slug' => 'gyartasiranyitas',
                'url' => 'https://gyartas.cegem360.eu',
                'description' => 'Termelési folyamatok tervezése, gyártási megrendelések kezelése és kapacitás-optimalizálás.',
                'color' => '#6366F1',
                'icon' => 'building-office',
            ],
            [
                'name' => 'Munkafolyamat-automatizálás',
                'slug' => 'automatizalas',
                'url' => 'https://automatizalas.cegem360.eu',
                'description' => 'Ismétlődő feladatok automatizálása, jóváhagyási folyamatok és értesítések – programozás nélkül.',
                'color' => '#8B5CF6',
                'icon' => 'cog-6-tooth',
            ],
            [
                'name' => 'Értékesítési folyamatok kezelése',
                'slug' => 'ertekesites',
                'url' => 'https://ertekesites.cegem360.eu',
                'description' => 'Ajánlatok készítése, megrendelés-kezelés és értékesítési teljesítmény nyomon követése.',
                'color' => '#EF4444',
                'icon' => 'currency-dollar',
            ],
            [
                'name' => 'CRM (Ügyfélkapcsolat-kezelés)',
                'slug' => 'crm',
                'url' => 'https://crm.cegem360.eu',
                'description' => 'Ügyfelek és kapcsolatok kezelése az első megkeresésétől a hosszú távú partnerségig.',
                'color' => '#6366F1',
                'icon' => 'users',
            ],
        ]);
    }
}
