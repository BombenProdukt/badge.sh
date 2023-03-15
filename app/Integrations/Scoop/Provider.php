<?php

declare(strict_types=1);

namespace App\Integrations\Scoop;

use App\Integrations\Contracts\IntegrationProvider;
use App\Integrations\Scoop\Controllers\LicenseController;
use App\Integrations\Scoop\Controllers\LicenseFromBucketController;
use App\Integrations\Scoop\Controllers\VersionController;
use App\Integrations\Scoop\Controllers\VersionFromBucketController;
use Illuminate\Support\Facades\Route;

final class Provider implements IntegrationProvider
{
    public function name(): string
    {
        return 'Scoop';
    }

    public function register(): void
    {
        Route::prefix('scoop')->group(function (): void {
            Route::get('v/{app}', VersionController::class);
            Route::get('license/{app}', LicenseController::class);

            Route::get('{bucket}/v/{app}', VersionFromBucketController::class)->whereIn('bucket', ['extras', 'versions']);
            Route::get('{bucket}/license/{app}', LicenseFromBucketController::class)->whereIn('bucket', ['extras', 'versions']);
        });
    }

    public function examples(): array
    {
        return [
            '/scoop/v/1password-cli'       => 'version',
            '/scoop/v/adb'                 => 'version',
            '/scoop/license/caddy'         => 'license',
            '/scoop/extras/v/age'          => 'version',
            '/scoop/extras/v/codeblocks'   => 'version',
            '/scoop/extras/license/deluge' => 'license',
        ];
    }
}
