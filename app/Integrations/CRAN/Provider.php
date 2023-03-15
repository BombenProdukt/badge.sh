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
            //
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
