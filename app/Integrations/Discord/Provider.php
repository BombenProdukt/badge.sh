<?php

declare(strict_types=1);

namespace App\Integrations\Discord;

use App\Integrations\Contracts\IntegrationProvider;
use Illuminate\Support\Facades\Route;

final class Provider implements IntegrationProvider
{
    public function name(): string
    {
        return 'Discord';
    }

    public function register(): void
    {
        Route::prefix('discord')->group(function (): void {
            //
        });
    }

    public function examples(): array
    {
        return [
            '/discord/members/reactiflux'     => 'members',
            '/discord/online-members/8Jzqu3T' => 'online members',
        ];
    }
}
