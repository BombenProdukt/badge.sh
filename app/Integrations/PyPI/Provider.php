<?php

declare(strict_types=1);

namespace App\Integrations\PyPI;

use App\Integrations\Contracts\IntegrationProvider;
use Illuminate\Support\Facades\Route;

final class Provider implements IntegrationProvider
{
    public function name(): string
    {
        return 'PyPI';
    }

    public function register(): void
    {
        Route::prefix('pypi')->group(function (): void {
            Route::get('v/{project}', Controllers\VersionController::class);
            Route::get('license/{project}', Controllers\LicenseController::class);
            Route::get('python/{project}', Controllers\PythonController::class);
        });
    }

    public function examples(): array
    {
        return [
            '/pypi/v/pip'        => 'version',
            '/pypi/v/docutils'   => 'version',
            '/pypi/license/pip'  => 'license',
            '/pypi/python/black' => 'python version',
        ];
    }
}
