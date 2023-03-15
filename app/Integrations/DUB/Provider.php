<?php

declare(strict_types=1);

namespace App\Integrations\DUB;

use App\Integrations\Contracts\IntegrationProvider;
use Illuminate\Support\Facades\Route;

final class Provider implements IntegrationProvider
{
    public function name(): string
    {
        return 'DUB';
    }

    public function register(): void
    {
        Route::prefix('dub')->group(function (): void {
            //
        });
    }

    public function examples(): array
    {
        return [
            '/dub/v/dub'                 => 'version',
            '/dub/license/arsd-official' => 'license',
            '/dub/dt/vibe-d'             => 'total downloads',
            '/dub/dd/vibe-d'             => 'daily downloads',
            '/dub/dw/vibe-d'             => 'weekly downloads',
            '/dub/dm/vibe-d'             => 'monthly downloads',
            '/dub/rating/pegged'         => 'rating',
            '/dub/stars/silly'           => 'stars',
        ];
    }
}
