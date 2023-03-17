<?php

declare(strict_types=1);

namespace App\Integrations\AtomPackage;

use App\Integrations\Contracts\IntegrationProvider;
use App\Integrations\DeprecatedController;
use Illuminate\Support\Facades\Route;

final class Provider implements IntegrationProvider
{
    public function name(): string
    {
        return 'Atom Package';
    }

    public function register(): void
    {
        Route::prefix('apm')->group(function (): void {
            Route::get('v/{package}', DeprecatedController::class);
            Route::get('version/{package}', DeprecatedController::class);
            Route::get('stars/{package}', DeprecatedController::class);
            Route::get('license/{package}', DeprecatedController::class);
            Route::get('dl/{package}', DeprecatedController::class);
            Route::get('downloads/{package}', DeprecatedController::class);
        });
    }

    public function examples(): array
    {
        return [
            '/apm/v/linter'         => 'version',
            '/apm/stars/linter'     => 'stars',
            '/apm/license/linter'   => 'license',
            '/apm/downloads/linter' => 'downloads',
        ];
    }
}
