<?php

declare(strict_types=1);

namespace App\Integrations\Shardbox;

use App\Integrations\Contracts\IntegrationProvider;
use App\Integrations\Shardbox\Controllers\CrystalController;
use App\Integrations\Shardbox\Controllers\DependentsController;
use App\Integrations\Shardbox\Controllers\LicenseController;
use App\Integrations\Shardbox\Controllers\VersionController;
use Illuminate\Support\Facades\Route;

final class Provider implements IntegrationProvider
{
    public function name(): string
    {
        return 'Shardbox';
    }

    public function register(): void
    {
        Route::prefix('shards')->group(function (): void {
            Route::get('v/{shard}', VersionController::class);
            Route::get('license/{shard}', LicenseController::class);
            Route::get('crystal/{shard}', CrystalController::class);
            Route::get('dependents/{shard}', DependentsController::class);
        });
    }

    public function examples(): array
    {
        return [
            '/shards/v/kemal'          => 'version',
            '/shards/license/clear'    => 'license',
            '/shards/crystal/amber'    => 'crystal version',
            '/shards/dependents/lucky' => 'dependents',
        ];
    }
}
