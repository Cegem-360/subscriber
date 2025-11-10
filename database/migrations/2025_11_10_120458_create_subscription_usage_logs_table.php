<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('subscription_usage_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('subscription_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('microservice_name');
            $table->string('endpoint')->nullable();
            $table->unsignedInteger('request_count')->default(1);
            $table->unsignedInteger('response_time_ms')->nullable();
            $table->timestamp('created_at');

            $table->index('subscription_id');
            $table->index('user_id');
            $table->index('microservice_name');
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscription_usage_logs');
    }
};
