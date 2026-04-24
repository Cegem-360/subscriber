<?php

declare(strict_types=1);

use App\Models\Plan;
use App\Models\Team;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration
{
    public function up(): void
    {
        Schema::create('team_plan_prices', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Team::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Plan::class)->constrained()->cascadeOnDelete();
            $table->decimal('price', 10, 2)->nullable();
            $table->decimal('price_eur', 10, 2)->nullable();
            $table->string('stripe_price_id')->nullable();
            $table->string('stripe_price_id_eur')->nullable();
            $table->timestamps();

            $table->unique(['team_id', 'plan_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('team_plan_prices');
    }
};
