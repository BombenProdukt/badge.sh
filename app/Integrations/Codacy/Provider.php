<?php

declare(strict_types=1);

namespace App\Integrations\Codacy;

use App\Integrations\Contracts\IntegrationProvider;
use Illuminate\Support\Facades\Route;

final class Provider implements IntegrationProvider
{
    public function name(): string
    {
        return 'Codacy';
    }

    public function register(): void
    {
        Route::prefix('codacy')->group(function (): void {
            //
        });
    }

    public function examples(): array
    {
        return [
            // f0875490cea1497a9eca9c25f3f7774e → https://github.com/xobotyi/react-scrollbars-custom
            '/codacy/coverage/f0875490cea1497a9eca9c25f3f7774e'        => 'coverage',
            '/codacy/coverage/f0875490cea1497a9eca9c25f3f7774e/master' => 'branch coverage',
            '/codacy/grade/f0875490cea1497a9eca9c25f3f7774e'           => 'code quality',
            '/codacy/grade/f0875490cea1497a9eca9c25f3f7774e/master'    => 'branch code quality',
        ];
    }
}
