<?php

declare(strict_types=1);

namespace App\Integrations\Discord;

use App\Integrations\Contracts\IntegrationProvider;
use App\Integrations\Discord\Controllers\MembersController;
use App\Integrations\Discord\Controllers\OnlineMembersController;
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
            Route::get('members/{inviteCode}', MembersController::class);
            Route::get('online-members/{inviteCode}', OnlineMembersController::class);
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
