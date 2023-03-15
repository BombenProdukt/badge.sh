<?php

declare(strict_types=1);

namespace App\Integrations\Mastodon;

use App\Integrations\Contracts\IntegrationProvider;
use App\Integrations\DevRant\Controllers\UserIdController;
use App\Integrations\Mastodon\Controllers\AccountController;
use Illuminate\Support\Facades\Route;

final class Provider implements IntegrationProvider
{
    public function name(): string
    {
        return 'Mastodon/Pleroma';
    }

    public function register(): void
    {
        Route::prefix('mastodon')->group(function (): void {
            Route::get('follow/{account}', AccountController::class);
            Route::get('follow/{userId}/{instance?}', UserIdController::class)->whereNumber('userId');
        });
    }

    public function examples(): array
    {
        return [
            '/mastodon/follow/Gargron@mastodon.social' => 'followers',
            '/mastodon/follow/trumpet@mas.to'          => 'followers',
            '/mastodon/follow/admin@cawfee.club'       => 'followers (Pleroma)',
        ];
    }
}
