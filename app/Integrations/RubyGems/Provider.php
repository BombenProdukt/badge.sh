<?php

declare(strict_types=1);

namespace App\Integrations\RubyGems;

use App\Integrations\Contracts\IntegrationProvider;
use App\Integrations\RubyGems\Controllers\LatestVersionDownloadsController;
use App\Integrations\RubyGems\Controllers\NameController;
use App\Integrations\RubyGems\Controllers\PlatformController;
use App\Integrations\RubyGems\Controllers\TotalDownloadsController;
use App\Integrations\RubyGems\Controllers\VersionController;
use Illuminate\Support\Facades\Route;

final class Provider implements IntegrationProvider
{
    public function name(): string
    {
        return 'Ruby Gems';
    }

    public function register(): void
    {
        Route::prefix('rubygems')->group(function (): void {
            Route::get('v/{gem}/{channel?}', VersionController::class);
            Route::get('dt/{gem}', TotalDownloadsController::class);
            Route::get('dv/{gem}', LatestVersionDownloadsController::class);
            Route::get('n/{gem}', NameController::class);
            Route::get('p/{gem}', PlatformController::class);
        });
    }

    public function examples(): array
    {
        return [
            '/rubygems/v/rails'        => 'version (stable)',
            '/rubygems/v/rails/pre'    => 'version (pre)',
            '/rubygems/v/rails/latest' => 'version (latest)',
            '/rubygems/dt/rails'       => 'total downloads',
            '/rubygems/dv/rails'       => 'latest version downloads',
            '/rubygems/n/rails'        => 'name',
            '/rubygems/p/rails'        => 'platform',
        ];
    }
}
