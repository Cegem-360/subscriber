<?php

declare(strict_types=1);

use App\Http\Controllers\SubscriptionController;
use Illuminate\Database\Eloquent\Model;

arch()->preset()->php();
// arch()->preset()->strict();
arch()->preset()->laravel()->ignoring(SubscriptionController::class);
arch()->preset()->security();
arch()->expect('App\Models')->toBeClasses()->toExtend(Model::class)->ignoring('App\Models\Scopes');
arch()->expect('App\Controllers\Controller')->toBeAbstract();
