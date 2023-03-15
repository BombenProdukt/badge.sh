<?php

declare(strict_types=1);

namespace App\Integrations\Tidelift;

use App\Integrations\Contracts\IntegrationProvider;
use App\Integrations\Tidelift\Controllers\StatusController;
use Illuminate\Support\Facades\Route;

final class Provider implements IntegrationProvider
{
    public function name(): string
    {
        return 'Tidelift';
    }

    public function register(): void
    {
        Route::prefix('tidelift')->group(function (): void {
            Route::get('/{platform}/{name}', StatusController::class);
        });
    }

    public function examples(): array
    {
        return [
            '/tidelift/npm/minimist' => 'subscription',
            '/tidelift/npm/got'      => 'subscription',
        ];
    }
}
