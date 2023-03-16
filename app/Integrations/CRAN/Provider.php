<?php

declare(strict_types=1);

namespace App\Integrations\CRAN;

use App\Integrations\Contracts\IntegrationProvider;
use Illuminate\Support\Facades\Route;

final class Provider implements IntegrationProvider
{
    public function name(): string
    {
        return 'CRAN';
    }

    public function register(): void
    {
        Route::prefix('cran')->group(function (): void {
            Route::get('v/{package}', Controllers\VersionController::class);
            Route::get('license/{package}', Controllers\LicenseController::class);
            Route::get('r/{package}', Controllers\RVersionController::class);
            Route::get('dependents/{package}', Controllers\DependentsController::class);
            Route::get('dt/{package}', Controllers\TotalDownloadsController::class);
            Route::get('dd/{package}', Controllers\DailyDownloadsController::class);
            Route::get('dw/{package}', Controllers\WeeklyDownloadsController::class);
            Route::get('dm/{package}', Controllers\MonthlyDownloadsController::class);
        });
    }

    public function examples(): array
    {
        return [
            '/cran/v/dplyr'         => 'version',
            '/cran/license/ggplot2' => 'license',
            '/cran/r/data.table'    => 'r version',
            '/cran/dependents/R6'   => 'dependents',
            '/cran/dt/Rcpp'         => 'total downloads',
            '/cran/dd/Rcpp'         => 'daily downloads',
            '/cran/dw/Rcpp'         => 'weekly downloads',
            '/cran/dm/Rcpp'         => 'monthly downloads',
        ];
    }
}
