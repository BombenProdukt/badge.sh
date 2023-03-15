<?php

declare(strict_types=1);

namespace App\Integrations\Twitter;

use App\Integrations\Contracts\IntegrationProvider;
use Illuminate\Support\Facades\Route;

final class Provider implements IntegrationProvider
{
    public function name(): string
    {
        return 'Twitter';
    }

    public function register(): void
    {
        Route::prefix('twitter')->group(function (): void {
            //
        });
    }

    public function examples(): array
    {
        return [
            '/twitter/follow/rustlang' => 'followers count',
            '/twitter/follow/golang'   => 'followers count',
        ];
    }
}
