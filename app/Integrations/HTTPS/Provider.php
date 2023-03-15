<?php

declare(strict_types=1);

namespace App\Integrations\HTTPS;

use App\Integrations\Contracts\IntegrationProvider;
use App\Integrations\HTTPS\Controllers\RequestController;
use Illuminate\Support\Facades\Route;

final class Provider implements IntegrationProvider
{
    public function name(): string
    {
        return 'HTTPS';
    }

    public function register(): void
    {
        Route::prefix('https')->group(function (): void {
            Route::get('/{host}/{path?}', RequestController::class);
        });
    }

    public function examples(): array
    {
        return [
            '/https/cal-badge-icd0onfvrxx6.runkit.sh'                     => 'https endpoint',
            '/https/cal-badge-icd0onfvrxx6.runkit.sh/Asia/Shanghai'       => 'https endpoint (with path args)',
            '/https/cal-badge-icd0onfvrxx6.runkit.sh/America/Los_Angeles' => 'https endpoint (with path args)',
        ];
    }
}
