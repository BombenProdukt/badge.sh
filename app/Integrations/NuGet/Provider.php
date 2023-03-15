<?php

declare(strict_types=1);

namespace App\Integrations\NuGet;

use App\Integrations\Contracts\IntegrationProvider;
use App\Integrations\NuGet\Controllers\TotalDownloadsController;
use App\Integrations\NuGet\Controllers\VersionController;
use Illuminate\Support\Facades\Route;

final class Provider implements IntegrationProvider
{
    public function name(): string
    {
        return 'NuGet';
    }

    public function register(): void
    {
        Route::prefix('nuget')->group(function (): void {
            Route::get('/v/{project}/{channel?}', VersionController::class);
            Route::get('/dt/{project}', TotalDownloadsController::class);
        });
    }

    public function examples(): array
    {
        return [
            '/nuget/v/Newtonsoft.Json'        => 'version (stable channel)',
            '/nuget/v/Newtonsoft.Json/pre'    => 'version (pre channel)',
            '/nuget/v/Newtonsoft.Json/latest' => 'version (latest channel)',
            '/nuget/dt/Newtonsoft.Json'       => 'total downloads',
        ];
    }
}
