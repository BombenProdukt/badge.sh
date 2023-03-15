<?php

declare(strict_types=1);

namespace App\Integrations\Hackage;

use App\Integrations\Contracts\IntegrationProvider;
use App\Integrations\Hackage\Controllers\LicenseController;
use App\Integrations\Hackage\Controllers\VersionController;
use Illuminate\Support\Facades\Route;

final class Provider implements IntegrationProvider
{
    public function name(): string
    {
        return 'Hackage';
    }

    public function register(): void
    {
        Route::prefix('hackage')->group(function (): void {
            Route::get('v/{package}', VersionController::class);
            Route::get('license/{package}', LicenseController::class);
        });
    }

    public function examples(): array
    {
        return [
            '/hackage/v/abt'         => 'version',
            '/hackage/v/Cabal'       => 'version',
            '/hackage/license/Cabal' => 'license',
        ];
    }
}
