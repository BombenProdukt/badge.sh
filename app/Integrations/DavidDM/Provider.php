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
            //
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
