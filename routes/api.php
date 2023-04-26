<?php

declare(strict_types=1);

use App\Contracts\Badge;
use App\Facades\BadgeService;
use App\Http\Resources\BadgeResource;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('/badges', function (): Collection {
    return collect(BadgeService::all())
        ->map(fn (Badge $badge): BadgeResource => BadgeResource::make($badge))
        ->values();
});

Route::get('/badges/{service}', function (string $service): Collection {
    return collect(BadgeService::all())
        ->where(fn (Badge $badge): bool => \strcasecmp($badge->service(), $service) === 0)
        ->map(fn (Badge $badge): BadgeResource => BadgeResource::make($badge))
        ->values();
});
