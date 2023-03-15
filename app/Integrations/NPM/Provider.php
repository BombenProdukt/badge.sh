<?php

declare(strict_types=1);

namespace App\Integrations\NPM;

use App\Integrations\Contracts\IntegrationProvider;
use Illuminate\Support\Facades\Route;

final class Provider implements IntegrationProvider
{
    public function name(): string
    {
        return 'npm';
    }

    public function register(): void
    {
        Route::prefix('npm')->group(function (): void {
            //
        });
    }

    public function examples(): array
    {
        return [
            '/npm/v/express'           => 'version',
            '/npm/v/yarn'              => 'version',
            '/npm/v/yarn/berry'        => 'version (tag)',
            '/npm/v/yarn/legacy'       => 'version (tag)',
            '/npm/v/@babel/core'       => 'version (scoped package)',
            '/npm/v/@nestjs/core/beta' => 'version (scoped & tag)',
            '/npm/dw/express'          => 'weekly downloads',
            '/npm/dm/express'          => 'monthly downloads',
            '/npm/dy/express'          => 'yearly downloads',
            '/npm/dt/express'          => 'total downloads',
            '/npm/license/lodash'      => 'license',
            '/npm/node/next'           => 'node version',
            '/npm/dependents/got'      => 'dependents',
            '/npm/types/tslib'         => 'types',
            '/npm/types/react'         => 'types',
            '/npm/types/queri'         => 'types',
        ];
    }
}
