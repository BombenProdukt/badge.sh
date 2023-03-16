<?php

declare(strict_types=1);

namespace App\Integrations\VisualStudioMarketplace;

use App\Integrations\Contracts\IntegrationProvider;
use App\Integrations\VisualStudioMarketplace\Controllers\DownloadsController;
use App\Integrations\VisualStudioMarketplace\Controllers\InstallsController;
use App\Integrations\VisualStudioMarketplace\Controllers\RatingController;
use App\Integrations\VisualStudioMarketplace\Controllers\VersionController;
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
            Route::get('v/{extension}', VersionController::class);
            Route::get('d/{extension}', DownloadsController::class);
            Route::get('i/{extension}', InstallsController::class);
            Route::get('rating/{extension}', RatingController::class);
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
