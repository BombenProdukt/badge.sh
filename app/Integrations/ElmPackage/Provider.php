<?php

declare(strict_types=1);

namespace App\Integrations\ElmPackage;

use App\Integrations\Contracts\IntegrationProvider;
use App\Integrations\ElmPackage\Controllers\ElmVersionController;
use App\Integrations\ElmPackage\Controllers\LicenseController;
use App\Integrations\ElmPackage\Controllers\VersionController;
use Illuminate\Support\Facades\Route;

final class Provider implements IntegrationProvider
{
    public function name(): string
    {
        return 'Elm Package';
    }

    public function register(): void
    {
        Route::prefix('elm-package')->group(function (): void {
            Route::get('/v/{owner}/{name}', VersionController::class);
            Route::get('/version/{owner}/{name}', VersionController::class);
            Route::get('/license/{owner}/{name}', LicenseController::class);
            Route::get('/elm/{owner}/{name}', ElmVersionController::class);
        });
    }

    public function examples(): array
    {
        return [
            '/elm-package/v/avh4/elm-color'          => 'version',
            '/elm-package/license/mdgriffith/elm-ui' => 'license',
            '/elm-package/elm/justinmimbs/date'      => 'elm version',
        ];
    }
}
