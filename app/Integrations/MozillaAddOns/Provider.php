<?php

declare(strict_types=1);

namespace App\Integrations\MozillaAddOns;

use App\Integrations\Contracts\IntegrationProvider;
use Illuminate\Support\Facades\Route;

final class Provider implements IntegrationProvider
{
    public function name(): string
    {
        return 'Mozilla Add-on';
    }

    public function register(): void
    {
        Route::prefix('amo')->group(function (): void {
            //
        });
    }

    public function examples(): array
    {
        return [
            '/amo/v/markdown-viewer-chrome'       => 'version',
            '/amo/users/markdown-viewer-chrome'   => 'users',
            '/amo/rating/markdown-viewer-chrome'  => 'rating',
            '/amo/stars/markdown-viewer-chrome'   => 'stars',
            '/amo/reviews/markdown-viewer-chrome' => 'reviews',
        ];
    }
}
