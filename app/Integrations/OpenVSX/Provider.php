<?php

declare(strict_types=1);

namespace App\Integrations\OpenVSX;

use App\Integrations\Contracts\IntegrationProvider;
use App\Integrations\OpenVSX\Controllers\DownloadsController;
use App\Integrations\OpenVSX\Controllers\LicenseController;
use App\Integrations\OpenVSX\Controllers\RatingController;
use App\Integrations\OpenVSX\Controllers\ReviewsController;
use App\Integrations\OpenVSX\Controllers\VersionController;
use Illuminate\Support\Facades\Route;

final class Provider implements IntegrationProvider
{
    public function name(): string
    {
        return 'Open VSX';
    }

    public function register(): void
    {
        Route::prefix('open-vsx')->group(function (): void {
            Route::get('v/{namespace}/{package}', VersionController::class);
            Route::get('version/{namespace}/{package}', VersionController::class);
            Route::get('d/{namespace}/{package}', DownloadsController::class);
            Route::get('l/{namespace}/{package}', LicenseController::class);
            Route::get('license/{namespace}/{package}', LicenseController::class);
            Route::get('rating/{namespace}/{package}', RatingController::class);
            Route::get('reviews/{namespace}/{package}', ReviewsController::class);
        });
    }

    public function examples(): array
    {
        return [
            '/open-vsx/d/idleberg/electron-builder'       => 'downloads',
            '/open-vsx/license/idleberg/electron-builder' => 'license',
            '/open-vsx/rating/idleberg/electron-builder'  => 'rating',
            '/open-vsx/reviews/idleberg/electron-builder' => 'reviews',
            '/open-vsx/version/idleberg/electron-builder' => 'version',
        ];
    }
}
