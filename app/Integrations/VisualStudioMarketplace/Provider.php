<?php

declare(strict_types=1);

namespace App\Integrations\VisualStudioMarketplace;

use App\Integrations\Contracts\IntegrationProvider;
use Illuminate\Support\Facades\Route;

final class Provider implements IntegrationProvider
{
    public function name(): string
    {
        return 'Visual Studio Marketplace';
    }

    public function register(): void
    {
        Route::prefix('vs-marketplace')->group(function (): void {
            //
        });
    }

    public function examples(): array
    {
        return [
            '/vs-marketplace/v/vscodevim.vim'      => 'version',
            '/vs-marketplace/i/vscodevim.vim'      => 'installs',
            '/vs-marketplace/d/vscodevim.vim'      => 'downloads',
            '/vs-marketplace/rating/vscodevim.vim' => 'rating',
        ];
    }
}
