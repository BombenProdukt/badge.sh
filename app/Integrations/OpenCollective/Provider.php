<?php

declare(strict_types=1);

namespace App\Integrations\OpenCollective;

use App\Integrations\Contracts\IntegrationProvider;
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
            //
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
