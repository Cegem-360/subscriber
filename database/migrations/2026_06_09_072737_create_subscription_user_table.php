<?php

declare(strict_types=1);

use App\Models\Subscription;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration
{
    public function up(): void
    {
        Schema::create('subscription_user', function (Blueprint $table): void {
            $table->id();
            $table->foreignIdFor(Subscription::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete();
            $table->timestamps();

            $table->unique(['subscription_id', 'user_id']);
        });

        // Migrate existing single-subscription memberships into the pivot.
        DB::table('users')
            ->whereNotNull('subscription_id')
            ->orderBy('id')
            ->each(function (object $user): void {
                DB::table('subscription_user')->insertOrIgnore([
                    'subscription_id' => $user->subscription_id,
                    'user_id' => $user->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            });

        Schema::table('users', function (Blueprint $table): void {
            $table->dropForeign(['subscription_id']);
            $table->dropColumn('subscription_id');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table): void {
            $table->unsignedBigInteger('subscription_id')->nullable()->after('role');
        });

        // Restore the first membership per user into the legacy column.
        DB::table('subscription_user')
            ->orderBy('id')
            ->each(function (object $pivot): void {
                DB::table('users')
                    ->where('id', $pivot->user_id)
                    ->whereNull('subscription_id')
                    ->update(['subscription_id' => $pivot->subscription_id]);
            });

        if (DB::getDriverName() !== 'sqlite') {
            Schema::table('users', function (Blueprint $table): void {
                $table->foreign('subscription_id')->references('id')->on('subscriptions')->nullOnDelete();
            });
        }

        Schema::dropIfExists('subscription_user');
    }
};
