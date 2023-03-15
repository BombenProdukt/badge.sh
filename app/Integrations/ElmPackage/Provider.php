<?php

declare(strict_types=1);

namespace App\Integrations\ElmPackage;

use App\Integrations\Contracts\IntegrationProvider;
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
            //
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
