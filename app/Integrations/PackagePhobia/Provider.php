<?php

declare(strict_types=1);

namespace App\Integrations\PackagePhobia;

use App\Integrations\Contracts\IntegrationProvider;
use App\Integrations\PackagePhobia\Controllers\InstallController;
use App\Integrations\PackagePhobia\Controllers\InstallWithScopeController;
use App\Integrations\PackagePhobia\Controllers\PublishController;
use App\Integrations\PackagePhobia\Controllers\PublishWithScopeController;
use Illuminate\Support\Facades\Route;

final class Provider implements IntegrationProvider
{
    public function name(): string
    {
        return 'PackagePhobia';
    }

    public function register(): void
    {
        Route::prefix('packagephobia')->group(function (): void {
            Route::get('/install/{name}', InstallController::class);
            Route::get('/install/{scope}/{name}', InstallWithScopeController::class);

            Route::get('/publish/{name}', PublishController::class);
            Route::get('/publish/{scope}/{name}', PublishWithScopeController::class);
        });
    }

    public function examples(): array
    {
        return [
            '/packagephobia/install/webpack'               => 'install size',
            '/packagephobia/install/@tusbar/cache-control' => 'install size',
            '/packagephobia/publish/webpack'               => 'publish size',
            '/packagephobia/publish/@tusbar/cache-control' => '(scoped pkg) publish size',
        ];
    }
}
