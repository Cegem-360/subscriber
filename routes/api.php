<?php

declare(strict_types=1);

use App\Http\Controllers\Api\UserInfoController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->group(function (): void {
    Route::get('/userinfo', UserInfoController::class);
});
