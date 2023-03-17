<?php

declare(strict_types=1);

namespace App\Integrations\Gitter;

use App\Integrations\Contracts\IntegrationProvider;
use App\Integrations\DeprecatedController;
use Illuminate\Support\Facades\Route;

final class Provider implements IntegrationProvider
{
    public function name(): string
    {
        return 'Gitter';
    }

    public function register(): void
    {
        Route::prefix('gitter')->group(function (): void {
            Route::get('members/{org}/{room}', DeprecatedController::class);
        });
    }

    public function examples(): array
    {
        return [
            '/gitter/members/redom/lobby' => 'members',
            '/gitter/members/redom/redom' => 'members',
        ];
    }
}
