<?php

declare(strict_types=1);

namespace App\Integrations\Scoop;

use App\Integrations\Contracts\IntegrationProvider;
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
            //
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
