<?php

declare(strict_types=1);

namespace App\Integrations\WinGet;

use App\Integrations\Contracts\IntegrationProvider;
use App\Integrations\WinGet\Controllers\LicenseController;
use App\Integrations\WinGet\Controllers\SizeController;
use App\Integrations\WinGet\Controllers\VersionController;
use Illuminate\Support\Facades\Route;

final class Provider implements IntegrationProvider
{
    public function name(): string
    {
        return 'winget';
    }

    public function register(): void
    {
        Route::prefix('winget')->group(function (): void {
            Route::get('v/{appId}', VersionController::class);
            Route::get('license/{appId}', LicenseController::class);
            Route::get('size/{appId}', SizeController::class);
        });
    }

    public function examples(): array
    {
        return [
            '/winget/v/GitHub.cli'       => 'version',
            '/winget/v/Balena.Etcher'    => 'version',
            '/winget/license/GitHub.cli' => 'license',
            '/winget/size/GitHub.cli'    => 'size',
        ];
    }
}
