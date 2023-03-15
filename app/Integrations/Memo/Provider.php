<?php

declare(strict_types=1);

namespace App\Integrations\Memo;

use App\Integrations\Contracts\IntegrationProvider;
use App\Integrations\Memo\Controllers\ShowBadgeController;
use App\Integrations\Memo\Controllers\UpdateBadgeController;
use Illuminate\Support\Facades\Route;

final class Provider implements IntegrationProvider
{
    public function name(): string
    {
        return 'Memo';
    }

    public function register(): void
    {
        Route::prefix('memo')->group(function (): void {
            Route::get('/{name}', ShowBadgeController::class);
            Route::put('/{name}', UpdateBadgeController::class);
        });
    }

    public function examples(): array
    {
        return [
            '/memo/deployed' => 'memoized badge for deploy status',
        ];
    }
}
