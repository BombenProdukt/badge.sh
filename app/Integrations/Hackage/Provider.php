<?php

declare(strict_types=1);

namespace App\Integrations\Hackage;

use App\Integrations\Contracts\IntegrationProvider;
use Illuminate\Support\Facades\Route;

final class Provider implements IntegrationProvider
{
    public function name(): string
    {
        return 'Hackage';
    }

    public function register(): void
    {
        Route::prefix('hackage')->group(function (): void {
            //
        });
    }

    public function examples(): array
    {
        return [
            '/hackage/v/abt'         => 'version',
            '/hackage/v/Cabal'       => 'version',
            '/hackage/license/Cabal' => 'license',
        ];
    }
}
