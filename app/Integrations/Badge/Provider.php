<?php

declare(strict_types=1);

namespace App\Integrations\Badge;

use App\Integrations\Badge\Controllers\BadgeController;
use App\Integrations\Contracts\IntegrationProvider;
use Illuminate\Support\Facades\Route;

final class Provider implements IntegrationProvider
{
    public function name(): string
    {
        return 'Static';
    }

    public function register(): void
    {
        Route::prefix('badge')->group(function (): void {
            Route::get('/{label}/{status}/{statusColor?}', BadgeController::class);
        });
    }

    public function examples(): array
    {
        return [
            '/badge/Swift/4.2/orange'          => 'swift version',
            '/badge/license/MIT/blue'          => 'license MIT',
            '/badge/chat/on%20gitter/cyan'     => 'chat on gitter',
            '/badge/stars/★★★★☆'               => 'star rating',
            '/badge/become/a%20patron/F96854'  => 'patron',
            '/badge/code%20style/standard/f2a' => 'code style: standard',
        ];
    }
}
