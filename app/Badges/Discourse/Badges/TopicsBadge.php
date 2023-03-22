<?php

declare(strict_types=1);

namespace App\Badges\Discourse\Badges;

use App\Badges\AbstractBadge;
use App\Badges\Discourse\Client;
use App\Enums\Category;
use Illuminate\Routing\Route;

final class TopicsBadge extends AbstractBadge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $server): array
    {
        return $this->renderNumber('topics', $this->client->statistics($server)['topic_count']);
    }

    public function service(): string
    {
        return 'Discourse';
    }

    public function keywords(): array
    {
        return [Category::METRICS];
    }

    public function routePaths(): array
    {
        return [
            '/discourse/topics/{server}',
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
            '/discourse/topics/meta.discourse.org' => 'topics',
        ];
    }
}
