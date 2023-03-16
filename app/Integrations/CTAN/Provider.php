<?php

declare(strict_types=1);

namespace App\Integrations\CTAN;

use App\Integrations\Contracts\IntegrationProvider;
use Illuminate\Support\Facades\Route;

final class Provider implements IntegrationProvider
{
    public function name(): string
    {
        return 'CTAN';
    }

    public function register(): void
    {
        Route::prefix('ctan')->group(function (): void {
            Route::get('v/{package}', Controllers\VersionController::class);
            Route::get('license/{package}', Controllers\LicenseController::class);
            Route::get('rating/{package}', Controllers\RatingController::class);
            Route::get('stars/{package}', Controllers\StarsController::class);
        });
    }

    public function examples(): array
    {
        return [
            '/ctan/v/latexindent'     => 'version',
            '/ctan/license/latexdiff' => 'license',
            '/ctan/rating/pgf-pie'    => 'rating',
            '/ctan/stars/pgf-pie'     => 'stars',
        ];
    }
}
