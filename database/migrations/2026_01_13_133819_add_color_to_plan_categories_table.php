<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('plan_categories', function (Blueprint $table) {
            $table->string('color')->default('#6366F1')->after('description');
            $table->string('icon')->nullable()->after('color');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('plan_categories', function (Blueprint $table) {
            $table->dropColumn(['color', 'icon']);
        });
    }
};
