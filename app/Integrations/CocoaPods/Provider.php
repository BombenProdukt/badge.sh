<?php

declare(strict_types=1);

namespace App\Integrations\CocoaPods;

use App\Integrations\CocoaPods\Controllers\PlatformController;
use App\Integrations\CocoaPods\Controllers\VersionController;
use App\Integrations\Contracts\IntegrationProvider;
use Illuminate\Support\Facades\Route;

final class Provider implements IntegrationProvider
{
    public function name(): string
    {
        return 'CocoaPods';
    }

    public function register(): void
    {
        Route::prefix('cocoapods')->group(function (): void {
            Route::get('v/{pod}', VersionController::class);
            Route::get('p/{pod}', PlatformController::class);
        });
    }

    public function examples(): array
    {
        return [
            '/cocoapods/v/AFNetworking' => 'version',
            '/cocoapods/p/AFNetworking' => 'platform',
        ];
    }
}
