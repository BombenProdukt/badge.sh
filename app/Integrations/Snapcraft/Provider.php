<?php

declare(strict_types=1);

namespace App\Integrations\Snapcraft;

use App\Integrations\Contracts\IntegrationProvider;
use App\Integrations\Snapcraft\Controllers\ArchitectureController;
use App\Integrations\Snapcraft\Controllers\LicenseController;
use App\Integrations\Snapcraft\Controllers\SizeController;
use App\Integrations\Snapcraft\Controllers\VersionController;
use Illuminate\Support\Facades\Route;

final class Provider implements IntegrationProvider
{
    public function name(): string
    {
        return 'Snapcraft';
    }

    public function register(): void
    {
        Route::prefix('snapcraft')->group(function (): void {
            Route::get('v/{snap}/{architecture?}/{channel?}', VersionController::class);
            Route::get('version/{snap}/{architecture?}/{channel?}', VersionController::class);
            Route::get('l/{snap}', LicenseController::class);
            Route::get('license/{snap}', LicenseController::class);
            Route::get('size/{snap}/{architecture?}/{channel?}', SizeController::class);
            Route::get('arch/{snap}', ArchitectureController::class);
            Route::get('architecture/{snap}', ArchitectureController::class);
        });
    }

    public function examples(): array
    {
        return [
            '/snapcraft/v/joplin-desktop'                 => 'version',
            '/snapcraft/v/mattermost-desktop/i386'        => 'version',
            '/snapcraft/v/telegram-desktop/arm64/edge'    => 'version',
            '/snapcraft/license/okular'                   => 'license',
            '/snapcraft/size/beekeeper-studio'            => 'distribution size',
            '/snapcraft/size/beekeeper-studio/arm64'      => 'distribution size',
            '/snapcraft/size/beekeeper-studio/armhf/edge' => 'distribution size',
            '/snapcraft/architecture/telegram-desktop'    => 'supported architectures',
        ];
    }
}
