<?php

declare(strict_types=1);

namespace App\Integrations\OpenVSX;

use App\Integrations\Contracts\IntegrationProvider;
use Illuminate\Support\Facades\Route;

final class Provider implements IntegrationProvider
{
    public function name(): string
    {
        return 'Open VSX';
    }

    public function register(): void
    {
        Route::prefix('open-vsx')->group(function (): void {
            //
        });
    }

    public function examples(): array
    {
        return [
            '/open-vsx/d/idleberg/electron-builder'       => 'downloads',
            '/open-vsx/license/idleberg/electron-builder' => 'license',
            '/open-vsx/rating/idleberg/electron-builder'  => 'rating',
            '/open-vsx/reviews/idleberg/electron-builder' => 'reviews',
            '/open-vsx/version/idleberg/electron-builder' => 'version',
        ];
    }
}
