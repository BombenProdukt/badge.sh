<?php

declare(strict_types=1);

namespace App\Integrations\Travis;

use App\Integrations\Contracts\IntegrationProvider;
use App\Integrations\Travis\Controllers\StatusController;
use Illuminate\Support\Facades\Route;

final class Provider implements IntegrationProvider
{
    public function name(): string
    {
        return 'Travis';
    }

    public function register(): void
    {
        Route::prefix('travis')->group(function (): void {
            Route::get('{owner}/{repo}/{branch?}', StatusController::class);
        });
    }

    public function examples(): array
    {
        return [
            '/travis/babel/babel'     => 'build',
            '/travis/babel/babel/6.x' => 'build (branch)',
        ];
    }
}
