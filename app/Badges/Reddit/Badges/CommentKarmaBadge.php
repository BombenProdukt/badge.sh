<?php

declare(strict_types=1);

namespace App\Badges\Reddit\Badges;

use App\Badges\Reddit\Client;
use App\Contracts\Badge;
use Illuminate\Routing\Route;
use PreemStudio\Formatter\FormatNumber;

final class CommentKarmaBadge implements Badge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $user): array
    {
        return [
            'label'       => "u/{$user}",
            'status'      => FormatNumber::execute($this->client->get("user/{$user}/about.json")['comment_karma']).' comment karma',
            'statusColor' => 'ff4500',
        ];
    }

    public function service(): string
    {
        return 'Reddit';
    }

    public function title(): string
    {
        return '';
    }

    public function keywords(): array
    {
        return [
            //
        ];
    }

    public function routePaths(): array
    {
        return [
            '/reddit/comment-karma/{user}',
            '/reddit/comment-karma/u/{user}',
        ];
    }

    public function routeParameters(): array
    {
        return [
            //
        ];
    }

    public function routeConstraints(Route $route): void
    {
        //
    }

    public function staticPreviews(): array
    {
        return [
            //
        ];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/reddit/comment-karma/u/spez' => 'comment karma',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}
