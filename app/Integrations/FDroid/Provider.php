<?php

declare(strict_types=1);

namespace App\Integrations\FDroid;

use App\Integrations\Contracts\IntegrationProvider;
use App\Integrations\FDroid\Controllers\LicenseController;
use App\Integrations\FDroid\Controllers\VersionController;
use Illuminate\Support\Facades\Route;

final class Provider implements IntegrationProvider
{
    public function name(): string
    {
        return 'F-Droid';
    }

    public function register(): void
    {
        Route::prefix('f-droid')->group(function (): void {
            Route::get('/v/{appId}', VersionController::class);
            Route::get('/license/{appId}', LicenseController::class);
        });
    }

    public function examples(): array
    {
        return [
            '/f-droid/v/org.schabi.newpipe'    => 'version',
            '/f-droid/v/com.amaze.filemanager' => 'version',
            '/f-droid/license/org.tasks'       => 'license',
        ];
    }
}
