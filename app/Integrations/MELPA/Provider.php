<?php

declare(strict_types=1);

namespace App\Integrations\MELPA;

use App\Integrations\Contracts\IntegrationProvider;
use App\Integrations\MELPA\Controllers\VersionController;
use Illuminate\Support\Facades\Route;

final class Provider implements IntegrationProvider
{
    public function name(): string
    {
        return 'MELPA';
    }

    public function register(): void
    {
        Route::prefix('melpa')->group(function (): void {
            Route::get('v/{package}', VersionController::class);
            Route::get('version/{package}', VersionController::class);
        });
    }

    public function examples(): array
    {
        return [
            '/melpa/v/magit' => 'version',
        ];
    }
}
