<?php

declare(strict_types=1);

namespace App\Integrations\Reddit;

use App\Integrations\Contracts\IntegrationProvider;
use App\Integrations\Reddit\Controllers\CommentKarmaController;
use App\Integrations\Reddit\Controllers\PostKarmaController;
use App\Integrations\Reddit\Controllers\SubscribersController;
use App\Integrations\Reddit\Controllers\TotalKarmaController;
use Illuminate\Support\Facades\Route;

final class Provider implements IntegrationProvider
{
    public function name(): string
    {
        return 'Reddit';
    }

    public function register(): void
    {
        Route::prefix('reddit')->group(function (): void {
            Route::get('/karma/{user}', TotalKarmaController::class);
            Route::get('/karma/u/{user}', TotalKarmaController::class);
            Route::get('/comment-karma/{user}', CommentKarmaController::class);
            Route::get('/comment-karma/u/{user}', CommentKarmaController::class);
            Route::get('/post-karma/{user}', PostKarmaController::class);
            Route::get('/post-karma/u/{user}', PostKarmaController::class);
            Route::get('/subscribers/r/{subreddit}', SubscribersController::class);
            Route::get('/subscribers/{subreddit}', SubscribersController::class);
        });
    }

    public function examples(): array
    {
        return [
            '/reddit/karma/u/spez'              => 'karma',
            '/reddit/post-karma/u/spez'         => 'post karma',
            '/reddit/comment-karma/u/spez'      => 'comment karma',
            '/reddit/subscribers/r/programming' => 'subreddit subscribers',
        ];
    }
}
