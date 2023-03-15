<?php

declare(strict_types=1);

namespace App\Integrations\WinGet;

use App\Integrations\Contracts\IntegrationProvider;
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
            //
        });
    }

    public function examples(): array
    {
        return [
            '/winget/v/GitHub.cli'            => 'version',
            '/winget/v/Balena.Etcher'         => 'version',
            '/winget/license/Arduino.Arduino' => 'license',
        ];
    }
}
