<?php

declare(strict_types=1);

namespace App\Badges\Discourse\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class LikesBadge extends AbstractBadge
{
    public function handle(string $server): array
    {
        return [
            'count' => $this->client->statistics($server)['like_count'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderNumber('likes', $properties['count']);
    }

    public function keywords(): array
    {
        return [Category::METRICS];
    }

    public function routePaths(): array
    {
        return [
            '/discourse/likes/{server}',
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
            '/discourse/likes/meta.discourse.org' => 'likes',
        ];
    }
}
