<?php

declare(strict_types=1);

namespace App\Integrations\PeerTube;

use App\Integrations\Contracts\IntegrationProvider;
use App\Integrations\PeerTube\Controllers\CommentsController;
use App\Integrations\PeerTube\Controllers\FollowersController;
use App\Integrations\PeerTube\Controllers\ViewsController;
use App\Integrations\PeerTube\Controllers\VotesController;
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
            Route::get('{instance}/comments/{video}', CommentsController::class);
            Route::get('{instance}/views/{video}', ViewsController::class);
            Route::get('{instance}/votes/{video}/{format?}', VotesController::class);
            Route::get('{instance}/followers/{account}/{channel?}', FollowersController::class);
        });
    }

    public function examples(): array
    {
        return [
            '/peertube/framatube.org/comments/9c9de5e8-0a1e-484a-b099-e80766180a6d'       => 'comments',
            '/peertube/framatube.org/votes/9c9de5e8-0a1e-484a-b099-e80766180a6d'          => 'votes (combined)',
            '/peertube/framatube.org/votes/9c9de5e8-0a1e-484a-b099-e80766180a6d/likes'    => 'votes (likes)',
            '/peertube/framatube.org/votes/9c9de5e8-0a1e-484a-b099-e80766180a6d/dislikes' => 'votes (dislikes)',
            '/peertube/framatube.org/views/9c9de5e8-0a1e-484a-b099-e80766180a6d'          => 'views',
            '/peertube/framatube.org/followers/framasoft'                                 => 'followers (account)',
            '/peertube/framatube.org/followers/framasoft/framablog.audio'                 => 'followers (channel)',
        ];
    }
}
