<?php

declare(strict_types=1);

namespace App\Integrations\CTAN;

use App\Integrations\Contracts\IntegrationProvider;
use Illuminate\Support\Facades\Route;

final class Provider implements IntegrationProvider
{
    public function name(): string
    {
        return 'CTAN';
    }

    public function register(): void
    {
        Route::prefix('ctan')->group(function (): void {
            //
        });
    }

    public function examples(): array
    {
        return [
            '/ctan/v/latexindent'     => 'version',
            '/ctan/license/latexdiff' => 'license',
            '/ctan/rating/pgf-pie'    => 'rating',
            '/ctan/stars/pgf-pie'     => 'stars',
        ];
    }
}
