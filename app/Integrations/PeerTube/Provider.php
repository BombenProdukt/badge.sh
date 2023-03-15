<?php

declare(strict_types=1);

namespace App\Integrations\PeerTube;

use App\Integrations\Contracts\IntegrationProvider;
use Illuminate\Support\Facades\Route;

final class Provider implements IntegrationProvider
{
    public function name(): string
    {
        return 'PeerTube';
    }

    public function register(): void
    {
        Route::prefix('peertube')->group(function (): void {
            //
        });
    }

    public function examples(): array
    {
        return [
            '/peertube/framatube.org/comments/9c9de5e8-0a1e-484a-b099-e80766180a6d?icon=peertube'       => 'comments',
            '/peertube/framatube.org/votes/9c9de5e8-0a1e-484a-b099-e80766180a6d?icon=peertube'          => 'votes (combined)',
            '/peertube/framatube.org/votes/9c9de5e8-0a1e-484a-b099-e80766180a6d/likes?icon=peertube'    => 'votes (likes)',
            '/peertube/framatube.org/votes/9c9de5e8-0a1e-484a-b099-e80766180a6d/dislikes?icon=peertube' => 'votes (dislikes)',
            '/peertube/framatube.org/views/9c9de5e8-0a1e-484a-b099-e80766180a6d?icon=peertube'          => 'views',
            '/peertube/framatube.org/followers/framasoft?icon=peertube'                                 => 'followers (account)',
            '/peertube/framatube.org/followers/framasoft/framablog.audio?icon=peertube'                 => 'followers (channel)',
        ];
    }
}
