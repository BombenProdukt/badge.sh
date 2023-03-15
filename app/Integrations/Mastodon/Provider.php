<?php

declare(strict_types=1);

namespace App\Integrations\Mastodon;

use App\Integrations\Contracts\IntegrationProvider;
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
            //
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
