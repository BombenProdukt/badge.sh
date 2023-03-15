<?php

declare(strict_types=1);

namespace App\Integrations\Homebrew;

use App\Integrations\Contracts\IntegrationProvider;
use App\Integrations\Homebrew\Controllers\MonthlyDownloadsForCaskController;
use App\Integrations\Homebrew\Controllers\MonthlyDownloadsForFormulaController;
use App\Integrations\Homebrew\Controllers\VersionForCaskController;
use App\Integrations\Homebrew\Controllers\VersionForFormulaController;
use App\Integrations\Homebrew\Controllers\YearlyDownloadsForCaskController;
use App\Integrations\Homebrew\Controllers\YearlyDownloadsForFormulaController;
use Illuminate\Support\Facades\Route;

final class Provider implements IntegrationProvider
{
    public function name(): string
    {
        return 'Homebrew';
    }

    public function register(): void
    {
        Route::prefix('homebrew')->group(function (): void {
            Route::get('/v/{package}', VersionForFormulaController::class);
            Route::get('/dm/{package}', MonthlyDownloadsForFormulaController::class);
            Route::get('/dy/{package}', YearlyDownloadsForFormulaController::class);

            Route::get('/formula/v/{package}', VersionForFormulaController::class);
            Route::get('/formula/dm/{package}', MonthlyDownloadsForFormulaController::class);
            Route::get('/formula/dy/{package}', YearlyDownloadsForFormulaController::class);

            Route::get('/cask/v/{package}', VersionForCaskController::class);
            Route::get('/cask/dm/{package}', MonthlyDownloadsForCaskController::class);
            Route::get('/cask/dy/{package}', YearlyDownloadsForCaskController::class);
        });
    }

    public function examples(): array
    {
        return [
            '/homebrew/v/fish'            => 'version',
            '/homebrew/v/cake'            => 'version',
            '/homebrew/dm/fish'           => 'monthly downloads',
            '/homebrew/dy/fish'           => 'yearly downloads',
            '/homebrew/cask/v/atom'       => 'version',
            '/homebrew/cask/v/whichspace' => 'version',
            '/homebrew/cask/dm/atom'      => 'monthly downloads',
            '/homebrew/cask/dy/atom'      => 'yearly downloads',
        ];
    }
}
