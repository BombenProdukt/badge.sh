<?php

declare(strict_types=1);

namespace App\Integrations\CodeClimate;

use App\Integrations\Contracts\IntegrationProvider;
use Illuminate\Support\Facades\Route;

final class Provider implements IntegrationProvider
{
    public function name(): string
    {
        return 'Code Climate';
    }

    public function register(): void
    {
        Route::prefix('codeclimate')->group(function (): void {
            //
        });
    }

    public function examples(): array
    {
        return [
            '/codeclimate/loc/codeclimate/codeclimate'                        => 'lines of code',
            '/codeclimate/issues/codeclimate/codeclimate'                     => 'issues',
            '/codeclimate/tech-debt/codeclimate/codeclimate'                  => 'technical debt',
            '/codeclimate/maintainability/codeclimate/codeclimate'            => 'maintainability',
            '/codeclimate/maintainability-percentage/codeclimate/codeclimate' => 'maintainability (percentage)',
            '/codeclimate/coverage/codeclimate/codeclimate'                   => 'coverage',
            '/codeclimate/coverage-letter/codeclimate/codeclimate'            => 'coverage (letter)',
        ];
    }
}
