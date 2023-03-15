<?php

declare(strict_types=1);

namespace App\Integrations\Bundlephobia;

use App\Integrations\Bundlephobia\Controllers\DependencyCountController;
use App\Integrations\Bundlephobia\Controllers\DependencyCountWithScopeController;
use App\Integrations\Bundlephobia\Controllers\MinController;
use App\Integrations\Bundlephobia\Controllers\MinWithScopeController;
use App\Integrations\Bundlephobia\Controllers\MinzipController;
use App\Integrations\Bundlephobia\Controllers\MinzipWithScopeController;
use App\Integrations\Bundlephobia\Controllers\TreeShakingController;
use App\Integrations\Bundlephobia\Controllers\TreeShakingWithScopeController;
use App\Integrations\Contracts\IntegrationProvider;
use Illuminate\Support\Facades\Route;

final class Provider implements IntegrationProvider
{
    public function name(): string
    {
        return 'Bundlephobia';
    }

    public function register(): void
    {
        Route::prefix('bundlephobia')->group(function (): void {
            Route::get('/min/{name}', MinController::class);
            Route::get('/min/{scope}/{name}', MinWithScopeController::class);

            Route::get('/minzip/{name}', MinzipController::class);
            Route::get('/minzip/{scope}/{name}', MinzipWithScopeController::class);

            Route::get('/dependency-count/{name}', DependencyCountController::class);
            Route::get('/dependency-count/{scope}/{name}', DependencyCountWithScopeController::class);

            Route::get('/tree-shaking/{name}', TreeShakingController::class);
            Route::get('/tree-shaking/{scope}/{name}', TreeShakingWithScopeController::class);
        });
    }

    public function examples(): array
    {
        return [
            '/bundlephobia/min/react'                   => 'minified',
            '/bundlephobia/minzip/react'                => 'minified + gzip',
            '/bundlephobia/minzip/@material-ui/core'    => '(scoped pkg) minified + gzip',
            '/bundlephobia/dependency-count/react'      => 'dependency count',
            '/bundlephobia/tree-shaking/react-colorful' => 'tree-shaking support',
        ];
    }
}
