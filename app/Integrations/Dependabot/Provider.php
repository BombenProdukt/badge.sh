<?php

declare(strict_types=1);

namespace App\Integrations\Dependabot;

use App\Integrations\Contracts\IntegrationProvider;
use App\Integrations\Dependabot\Controllers\StatusController;
use Illuminate\Support\Facades\Route;

final class Provider implements IntegrationProvider
{
    public function name(): string
    {
        return 'Dependabot';
    }

    public function register(): void
    {
        Route::prefix('dependabot')->group(function (): void {
            Route::get('{owner}/{repo}/{identifier?}', StatusController::class);
        });
    }

    public function examples(): array
    {
        return [
            '/dependabot/thepracticaldev/dev.to'     => 'status',
            '/dependabot/dependabot/dependabot-core' => 'status',
        ];
    }
}
