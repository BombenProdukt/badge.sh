<?php

declare(strict_types=1);

namespace App\Badges\Pub\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class LikesBadge extends AbstractBadge
{
    public function handle(string $package): array
    {
        return [
            'count' => $this->client->api("packages/{$package}/score")['likeCount'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderNumber('popularity', $properties['count']);
    }

    public function keywords(): array
    {
        return [Category::SOCIAL];
    }

    public function routePaths(): array
    {
        return [
            '/pub/likes/{package}',
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
            '/pub/likes/firebase_core' => 'likes',
        ];
    }
}
