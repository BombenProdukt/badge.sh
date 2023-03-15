<?php

declare(strict_types=1);

namespace App\Integrations\Memo;

use App\Integrations\Contracts\IntegrationProvider;
use Illuminate\Support\Facades\Route;

final class Provider implements IntegrationProvider
{
    public function name(): string
    {
        return 'Memo';
    }

    public function register(): void
    {
        Route::prefix('memo')->group(function (): void {
            //
        });
    }

    public function examples(): array
    {
        return [
            '/memo/deployed' => 'memoized badge for deploy status',
        ];
    }
}
