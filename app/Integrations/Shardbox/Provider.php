<?php

declare(strict_types=1);

namespace App\Integrations\Shardbox;

use App\Integrations\Contracts\IntegrationProvider;
use Closure;
use Illuminate\Support\Facades\Route;

final class Provider implements IntegrationProvider
{
    public function name(): string
    {
        return 'Shardbox';
    }

    public function register(): void
    {
        Route::prefix('shardbox')->group($this->routes());

        // Backwards compatibility with old badge URLs!
        Route::prefix('shards')->group($this->routes());
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

    private function routes(): Closure
    {
        return function (): void {
            Route::get('{shardbox}', 'ShardboxController@show');
        };
    }
}
