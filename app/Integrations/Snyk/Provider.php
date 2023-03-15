<?php

declare(strict_types=1);

namespace App\Integrations\Snyk;

use App\Integrations\Contracts\IntegrationProvider;
use App\Integrations\Snyk\Controllers\StatusController;
use Illuminate\Support\Facades\Route;

final class Provider implements IntegrationProvider
{
    public function name(): string
    {
        return 'Snyk';
    }

    public function register(): void
    {
        Route::prefix('snyk')->group(function (): void {
            Route::get('/{owner}/{repo}/{branch?}/{targetFile?}', StatusController::class);
        });
    }

    public function examples(): array
    {
        return [
            '/snyk/badgen/badgen.net'                                     => 'vulnerability scan',
            '/snyk/babel/babel/6.x'                                       => 'vulnerability scan (branch)',
            '/snyk/rollup/plugins/master/packages%2Falias%2Fpackage.json' => 'vulnerability scan (custom path)',
        ];
    }
}
