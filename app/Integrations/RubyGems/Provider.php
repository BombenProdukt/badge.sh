<?php

declare(strict_types=1);

namespace App\Integrations\RubyGems;

use App\Integrations\Contracts\IntegrationProvider;
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
            //
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
