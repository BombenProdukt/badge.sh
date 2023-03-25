<?php

declare(strict_types=1);

namespace App\Badges\Reddit\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;
use PreemStudio\Formatter\FormatNumber;

final class SubscribersBadge extends AbstractBadge
{
    public function handle(string $subreddit): array
    {
        return [
            'subreddit' => $subreddit,
            'subscribers' => $this->client->get("r/{$subreddit}/about.json")['subscribers'],
        ];
    }

    public function render(array $properties): array
    {
        return [
            'label' => 'r/'.$properties['subreddit'],
            'message' => FormatNumber::execute($properties['subscribers']).' subscribers',
            'messageColor' => 'ff4500',
        ];
    }

    public function keywords(): array
    {
        return [Category::SOCIAL];
    }

    public function routePaths(): array
    {
        return [
            '/reddit/subscribers/{subreddit}',
        ];
    }

    public function routeParameters(): array
    {
        return [];
    }

    public function routeConstraints(Route $route): void
    {
        //
    }

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/reddit/subscribers/programming' => 'subreddit subscribers',
        ];
    }
}
