<?php

declare(strict_types=1);

namespace App\Integrations\JSDelivr;

use App\Integrations\Contracts\IntegrationProvider;
use App\Integrations\JSDelivr\Controllers\HitsController;
use App\Integrations\JSDelivr\Controllers\RankController;
use App\Integrations\JSDelivr\Controllers\VersionController;
use Illuminate\Support\Facades\Route;

final class Provider implements IntegrationProvider
{
    public function name(): string
    {
        return 'jsDelivr';
    }

    public function register(): void
    {
        Route::prefix('jsdelivr')->group(function (): void {
            Route::get('hits/{platform}/{package}', HitsController::class)->where('package', '.+');
            Route::get('rank/{platform}/{package}', RankController::class)->where('package', '.+');
            Route::get('v/npm/{package}', VersionController::class)->where('package', '.+');
        });
    }

    public function examples(): array
    {
        return [
            '/jsdelivr/hits/gh/jquery/jquery' => 'hits (per month)',
            '/jsdelivr/hits/npm/lodash'       => 'hits (per month)',
            '/jsdelivr/rank/npm/lodash'       => 'rank',
            '/jsdelivr/v/npm/lodash'          => 'version',
        ];
    }
}
