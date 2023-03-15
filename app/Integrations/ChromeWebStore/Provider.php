<?php

declare(strict_types=1);

namespace App\Integrations\ChromeWebStore;

use App\Integrations\ChromeWebStore\Controllers\PriceController;
use App\Integrations\ChromeWebStore\Controllers\RatingController;
use App\Integrations\ChromeWebStore\Controllers\RatingCountController;
use App\Integrations\ChromeWebStore\Controllers\StarsController;
use App\Integrations\ChromeWebStore\Controllers\UsersController;
use App\Integrations\ChromeWebStore\Controllers\VersionController;
use App\Integrations\Contracts\IntegrationProvider;
use Illuminate\Support\Facades\Route;

final class Provider implements IntegrationProvider
{
    public function name(): string
    {
        return 'Chrome Extensions';
    }

    public function register(): void
    {
        Route::prefix('chrome-web-store')->group(function (): void {
            Route::get('v/{itemId}', VersionController::class);
            Route::get('users/{itemId}', UsersController::class);
            Route::get('price/{itemId}', PriceController::class);
            Route::get('stars/{itemId}', StarsController::class);
            Route::get('rating/{itemId}', RatingController::class);
            Route::get('rating-count/{itemId}', RatingCountController::class);
        });
    }

    public function examples(): array
    {
        return [
            '/chrome-web-store/v/ckkdlimhmcjmikdlpkmbgfkaikojcbjk'            => 'version',
            '/chrome-web-store/users/ckkdlimhmcjmikdlpkmbgfkaikojcbjk'        => 'users',
            '/chrome-web-store/price/ckkdlimhmcjmikdlpkmbgfkaikojcbjk'        => 'price',
            '/chrome-web-store/stars/ckkdlimhmcjmikdlpkmbgfkaikojcbjk'        => 'stars',
            '/chrome-web-store/rating/ckkdlimhmcjmikdlpkmbgfkaikojcbjk'       => 'rating',
            '/chrome-web-store/rating-count/ckkdlimhmcjmikdlpkmbgfkaikojcbjk' => 'rating count',
        ];
    }
}
