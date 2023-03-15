<?php

declare(strict_types=1);

namespace App\Integrations\Keybase;

use App\Integrations\Contracts\IntegrationProvider;
use App\Integrations\Keybase\Controllers\KeyController;
use Illuminate\Support\Facades\Route;

final class Provider implements IntegrationProvider
{
    public function name(): string
    {
        return 'Keybase';
    }

    public function register(): void
    {
        Route::prefix('keybase')->group(function (): void {
            Route::get('pgp/{username}', KeyController::class);
        });
    }

    public function examples(): array
    {
        return [
            '/keybase/pgp/lukechilds' => 'pgp key',
        ];
    }
}
