<?php

declare(strict_types=1);

namespace App\Integrations\Crates;

use App\Integrations\Contracts\IntegrationProvider;
use App\Integrations\Crates\Controllers\LatestVersionController;
use App\Integrations\Crates\Controllers\LatestVersionDownloadsController;
use App\Integrations\Crates\Controllers\TotalDownloadsController;
use Illuminate\Support\Facades\Route;

final class Provider implements IntegrationProvider
{
    public function name(): string
    {
        return 'Rust Crates';
    }

    public function register(): void
    {
        Route::prefix('crates')->group(function (): void {
            Route::get('/v/{package}', LatestVersionController::class);
            Route::get('/d/{package}', TotalDownloadsController::class);
            Route::get('/dl/{package}', LatestVersionDownloadsController::class);
        });
    }

    public function examples(): array
    {
        return [
            '/crates/v/regex'  => 'version',
            '/crates/d/regex'  => 'downloads',
            '/crates/dl/regex' => 'downloads (latest version)',
        ];
    }
}
