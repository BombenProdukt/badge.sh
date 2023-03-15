<?php

declare(strict_types=1);

namespace App\Integrations\Snapcraft;

use App\Integrations\Contracts\IntegrationProvider;
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
            //
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
