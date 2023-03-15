<?php

declare(strict_types=1);

namespace App\Integrations\XO;

use App\Integrations\Contracts\IntegrationProvider;
use App\Integrations\XO\Controllers\IndentController;
use App\Integrations\XO\Controllers\IndentWithScopeController;
use App\Integrations\XO\Controllers\SemiController;
use App\Integrations\XO\Controllers\SemiWithScopeController;
use App\Integrations\XO\Controllers\StatusController;
use App\Integrations\XO\Controllers\StatusWithScopeController;
use Illuminate\Support\Facades\Route;

final class Provider implements IntegrationProvider
{
    public function name(): string
    {
        return 'XO';
    }

    public function register(): void
    {
        Route::prefix('xo')->group(function (): void {
            Route::get('/status/{name}', StatusController::class);
            Route::get('/status/{scope}/{name}', StatusWithScopeController::class);

            Route::get('/indent/{name}', IndentController::class);
            Route::get('/indent/{scope}/{name}', IndentWithScopeController::class);

            Route::get('/semi/{name}', SemiController::class);
            Route::get('/semi/{scope}/{name}', SemiWithScopeController::class);
        });
    }

    public function examples(): array
    {
        return [
            '/xo/status/badgen'                => 'status',
            '/xo/status/chalk'                 => 'status',
            '/xo/indent/@tusbar/cache-control' => 'indent',
            '/xo/semi/got'                     => 'semicolons',
        ];
    }
}
