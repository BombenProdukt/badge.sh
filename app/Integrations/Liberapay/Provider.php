<?php

declare(strict_types=1);

namespace App\Integrations\Liberapay;

use App\Integrations\Contracts\IntegrationProvider;
use Illuminate\Support\Facades\Route;

final class Provider implements IntegrationProvider
{
    public function name(): string
    {
        return 'Liberapay';
    }

    public function register(): void
    {
        Route::prefix('liberapay')->group(function (): void {
            //
        });
    }

    public function examples(): array
    {
        return [
            '/liberapay/gives/aurelienpierre' => 'giving',
            '/liberapay/receives/GIMP'        => 'receiving',
            '/liberapay/patrons/microG'       => 'patrons count',
            '/liberapay/goal/Changaco'        => 'goal progress',
        ];
    }
}
