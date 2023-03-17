<?php

declare(strict_types=1);

namespace App\Integrations\DUB;

use App\Integrations\Contracts\IntegrationProvider;
use App\Integrations\DUB\Controllers\DailyDownloadsController;
use App\Integrations\DUB\Controllers\LicenseController;
use App\Integrations\DUB\Controllers\MonthlyDownloadsController;
use App\Integrations\DUB\Controllers\RatingController;
use App\Integrations\DUB\Controllers\StarsController;
use App\Integrations\DUB\Controllers\TotalDownloadsController;
use App\Integrations\DUB\Controllers\VersionController;
use App\Integrations\DUB\Controllers\WeeklyDownloadsController;
use Illuminate\Support\Facades\Route;

final class Provider implements IntegrationProvider
{
    public function name(): string
    {
        return 'DUB';
    }

    public function register(): void
    {
        Route::prefix('dub')->group(function (): void {
            Route::get('v/{package}', VersionController::class);
            Route::get('version/{package}', VersionController::class);
            Route::get('license/{package}', LicenseController::class);
            Route::get('dd/{package}', DailyDownloadsController::class);
            Route::get('dw/{package}', WeeklyDownloadsController::class);
            Route::get('dm/{package}', MonthlyDownloadsController::class);
            Route::get('dt/{package}', TotalDownloadsController::class);
            Route::get('rating/{package}', RatingController::class);
            Route::get('stars/{package}', StarsController::class);
        });
    }

    public function examples(): array
    {
        return [
            '/dub/v/dub'                 => 'version',
            '/dub/license/arsd-official' => 'license',
            '/dub/dt/vibe-d'             => 'total downloads',
            '/dub/dd/vibe-d'             => 'daily downloads',
            '/dub/dw/vibe-d'             => 'weekly downloads',
            '/dub/dm/vibe-d'             => 'monthly downloads',
            '/dub/rating/pegged'         => 'rating',
            '/dub/stars/silly'           => 'stars',
        ];
    }
}
