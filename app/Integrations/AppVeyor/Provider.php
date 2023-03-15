<?php

declare(strict_types=1);

namespace App\Integrations\AppVeyor;

use App\Integrations\Contracts\IntegrationProvider;
use Illuminate\Support\Facades\Route;

final class Provider implements IntegrationProvider
{
    public function name(): string
    {
        return 'AppVeyor';
    }

    public function register(): void
    {
        Route::prefix('appveyor')->group(function (): void {
            //
        });
    }

    public function examples(): array
    {
        return [
            '/appveyor/ci/gruntjs/grunt'           => 'build',
            '/appveyor/ci/gruntjs/grunt/deprecate' => 'build (branch)',
        ];
    }
}
