<?php

declare(strict_types=1);

namespace App\Integrations\OpenCollective;

use App\Integrations\Contracts\IntegrationProvider;
use App\Integrations\OpenCollective\Controllers\BackersController;
use App\Integrations\OpenCollective\Controllers\BalanceController;
use App\Integrations\OpenCollective\Controllers\ContributorsController;
use App\Integrations\OpenCollective\Controllers\YearlyController;
use Illuminate\Support\Facades\Route;

final class Provider implements IntegrationProvider
{
    public function name(): string
    {
        return 'Open Collective';
    }

    public function register(): void
    {
        Route::prefix('opencollective')->group(function (): void {
            Route::get('backers/{slug}', BackersController::class);
            Route::get('contributors/{slug}', ContributorsController::class);
            Route::get('balance/{slug}', BalanceController::class);
            Route::get('yearly/{slug}', YearlyController::class);
        });
    }

    public function examples(): array
    {
        return [
            '/opencollective/backers/webpack'      => 'backers',
            '/opencollective/contributors/webpack' => 'contributors',
            '/opencollective/balance/webpack'      => 'balance',
            '/opencollective/yearly/webpack'       => 'yearly income',
        ];
    }
}
