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
            Route::get('v/{scope}/{package}/{tag?}', Controllers\VersionWithScopeController::class)->where('scope', '@[a-z]+');
            Route::get('v/{package}/{tag?}', Controllers\VersionController::class);

            Route::get('license/{scope}/{package}/{tag?}', Controllers\LicenseWithScopeController::class)->where('scope', '@[a-z]+');
            Route::get('license/{package}/{tag?}', Controllers\LicenseController::class);

            Route::get('node/{scope}/{package}/{tag?}', Controllers\NodeWithScopeController::class)->where('scope', '@[a-z]+');
            Route::get('node/{package}/{tag?}', Controllers\NodeController::class);

            Route::get('dt/{scope}/{package}/{tag?}', Controllers\TotalDownloadsWithScopeController::class)->where('scope', '@[a-z]+');
            Route::get('dt/{package}/{tag?}', Controllers\TotalDownloadsController::class);

            Route::get('dd/{scope}/{package}/{tag?}', Controllers\DailyDownloadsWithScopeController::class)->where('scope', '@[a-z]+');
            Route::get('dd/{package}/{tag?}', Controllers\DailyDownloadsController::class);

            Route::get('dw/{scope}/{package}/{tag?}', Controllers\WeeklyDownloadsWithScopeController::class)->where('scope', '@[a-z]+');
            Route::get('dw/{package}/{tag?}', Controllers\WeeklyDownloadsController::class);

            Route::get('dm/{scope}/{package}/{tag?}', Controllers\MonthlyDownloadsWithScopeController::class)->where('scope', '@[a-z]+');
            Route::get('dm/{package}/{tag?}', Controllers\MonthlyDownloadsController::class);

            Route::get('dy/{scope}/{package}/{tag?}', Controllers\YearlyDownloadsWithScopeController::class)->where('scope', '@[a-z]+');
            Route::get('dy/{package}/{tag?}', Controllers\YearlyDownloadsController::class);

            Route::get('dependents/{scope}/{package}/{tag?}', Controllers\DependentsWithScopeController::class)->where('scope', '@[a-z]+');
            Route::get('dependents/{package}/{tag?}', Controllers\DependentsController::class);

            Route::get('types/{scope}/{package}/{tag?}', Controllers\TypesWithScopeController::class)->where('scope', '@[a-z]+');
            Route::get('types/{package}/{tag?}', Controllers\TypesController::class);
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
