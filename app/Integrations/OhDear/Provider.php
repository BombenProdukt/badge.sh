<?php

declare(strict_types=1);

namespace App\Integrations\OhDear;

use App\Integrations\Contracts\IntegrationProvider;
use App\Integrations\OhDear\Controllers\StatusController;
use App\Integrations\OhDear\Controllers\TimezoneController;
use Illuminate\Support\Facades\Route;

final class Provider implements IntegrationProvider
{
    public function name(): string
    {
        return 'Oh Dear';
    }

    public function register(): void
    {
        Route::prefix('ohdear')->group(function (): void {
            Route::get('/status/{domain}/{label}', StatusController::class);
            Route::get('/timezone/{domain}', TimezoneController::class);
        });
    }

    public function examples(): array
    {
        return [
            '/ohdear/status/status.laravel.com/forge.laravel.com' => 'status',
            '/ohdear/timezone/status.laravel.com'                 => 'timezone',
        ];
    }
}
