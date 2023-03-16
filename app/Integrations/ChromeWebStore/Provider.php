<?php

declare(strict_types=1);

namespace App\Integrations\ChromeWebStore;

use App\Integrations\Contracts\IntegrationProvider;
use Illuminate\Support\Facades\Route;

final class Provider implements IntegrationProvider
{
    public function name(): string
    {
        return 'Chrome Web Store';
    }

    public function register(): void
    {
        Route::prefix('chrome-web-store')->group(function (): void {
            Route::get('v/{itemId}', Controllers\VersionController::class);
            Route::get('users/{itemId}', Controllers\UsersController::class);
            Route::get('price/{itemId}', Controllers\PriceController::class);
            Route::get('stars/{itemId}', Controllers\StarsController::class);
            Route::get('rating/{itemId}', Controllers\RatingController::class);
            Route::get('rating-count/{itemId}', Controllers\RatingCountController::class);
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
