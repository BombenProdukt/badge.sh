<?php

declare(strict_types=1);

namespace App\Integrations\Liberapay;

use App\Integrations\Contracts\IntegrationProvider;
use App\Integrations\Liberapay\Controllers\GivesController;
use App\Integrations\Liberapay\Controllers\GoalController;
use App\Integrations\Liberapay\Controllers\PatronsController;
use App\Integrations\Liberapay\Controllers\ReceivesController;
use Illuminate\Support\Facades\Route;

final class Provider implements IntegrationProvider
{
    public function name(): string
    {
        return 'Liberapay';
    }

    public function register(): void
    {
        Route::prefix('liberapay')->group(function (): void {
            Route::get('gives/{username}', GivesController::class);
            Route::get('receives/{username}', ReceivesController::class);
            Route::get('patrons/{username}', PatronsController::class);
            Route::get('goal/{username}', GoalController::class);
        });
    }

    public function examples(): array
    {
        return [
            '/liberapay/gives/aurelienpierre' => 'giving',
            '/liberapay/receives/GIMP'        => 'receiving',
            '/liberapay/patrons/microG'       => 'patrons count',
            '/liberapay/goal/Changaco'        => 'goal progress',
        ];
    }
}
