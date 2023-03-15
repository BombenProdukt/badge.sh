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
            Route::get('v/{pkg}', VersionController::class);
            Route::get('version/{pkg}', VersionController::class);
            Route::get('license/{pkg}', LicenseController::class);
            Route::get('dd/{pkg}', DailyDownloadsController::class);
            Route::get('dw/{pkg}', WeeklyDownloadsController::class);
            Route::get('dm/{pkg}', MonthlyDownloadsController::class);
            Route::get('dt/{pkg}', TotalDownloadsController::class);
            Route::get('rating/{pkg}', RatingController::class);
            Route::get('stars/{pkg}', StarsController::class);
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
