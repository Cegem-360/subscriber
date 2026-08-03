<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * A sync_apps táblát a laravel-user-team-sync csomag hozza létre, de ez az
 * oszlop kizárólag a publisher IdP-szerepéhez tartozik. Ezért a subscriber
 * saját migrációja adja hozzá: a csomagban bővítve mind a 16 receiver
 * megkapná, teljesen fölöslegesen.
 *
 * Szándékosan string, nem uuid: a Passport kliens kulcsa a
 * Passport::$clientUuids beállítástól függően uuid vagy autoinkrement
 * egész, és a string mindkettőt elbírja.
 */
return new class() extends Migration
{
    public function up(): void
    {
        Schema::table('sync_apps', function (Blueprint $table): void {
            $table->string('oauth_client_id')->nullable()->after('api_key');
        });
    }

    public function down(): void
    {
        Schema::table('sync_apps', function (Blueprint $table): void {
            $table->dropColumn('oauth_client_id');
        });
    }
};
