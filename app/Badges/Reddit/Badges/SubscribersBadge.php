<?php

declare(strict_types=1);

namespace App\Badges\Reddit\Badges;

use App\Badges\AbstractBadge;
use App\Badges\Reddit\Client;
use App\Enums\Category;
use Illuminate\Routing\Route;
use PreemStudio\Formatter\FormatNumber;

final class SubscribersBadge extends AbstractBadge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $subreddit): array
    {
        $response = $this->client->get("r/{$subreddit}/about.json");

        return [
            'label'        => "r/{$subreddit}",
            'message'      => FormatNumber::execute($response['subscribers']).' subscribers',
            'messageColor' => 'ff4500',
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
