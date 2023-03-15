<?php

declare(strict_types=1);

namespace App\Integrations\OPAM;

use App\Integrations\Contracts\IntegrationProvider;
use App\Integrations\OPAM\Controllers\LicenseController;
use App\Integrations\OPAM\Controllers\VersionController;
use Illuminate\Support\Facades\Route;

final class Provider implements IntegrationProvider
{
    public function name(): string
    {
        return 'OCaml Package Manager';
    }

    public function register(): void
    {
        Route::prefix('opam')->group(function (): void {
            Route::get('v/{name}', VersionController::class);
            Route::get('license/{name}', LicenseController::class);
        });
    }

    public function examples(): array
    {
        return [
            '/opam/v/merlin'       => 'version',
            '/opam/v/ocamlformat'  => 'version',
            '/opam/license/cohttp' => 'license',
        ];
    }
}
