<?php

declare(strict_types=1);

namespace App\Integrations\DavidDM;

use App\Integrations\Contracts\IntegrationProvider;
use Illuminate\Support\Facades\Route;

final class Provider implements IntegrationProvider
{
    public function name(): string
    {
        return 'David DM';
    }

    public function register(): void
    {
        Route::prefix('david')->group(function (): void {
            Route::get('dep/{owner}/{repo}/{path?}', Controllers\DepController::class)->where('path', '.+');
            Route::get('dev/{owner}/{repo}/{path?}', Controllers\DevController::class)->where('path', '.+');
            Route::get('peer/{owner}/{repo}/{path?}', Controllers\PeerController::class)->where('path', '.+');
            Route::get('optional/{owner}/{repo}/{path?}', Controllers\OptionalController::class)->where('path', '.+');
        });
    }

    public function examples(): array
    {
        return [
            '/david/dep/zeit/pkg'                       => 'dependencies',
            '/david/dev/zeit/pkg'                       => 'dev dependencies',
            '/david/peer/epoberezkin/ajv-keywords'      => 'peer dependencies',
            '/david/optional/epoberezkin/ajv-keywords'  => 'optional dependencies',
            '/david/dep/babel/babel/packages/babel-cli' => 'dependencies (sub path)',
        ];
    }
}
