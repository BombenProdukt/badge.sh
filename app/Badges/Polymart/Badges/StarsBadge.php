<?php

declare(strict_types=1);

namespace App\Badges\Polymart\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class StarsBadge extends AbstractBadge
{
    public function handle(string $resourceId): array
    {
        return $this->client->get($resourceId)['reviews'];
    }

    public function render(array $properties): array
    {
        return $this->renderStars('rating', $properties['stars']);
    }

    public function keywords(): array
    {
        return [Category::SOCIAL];
    }

    public function routePaths(): array
    {
        return [
            '/polymart/stars/{resourceId}',
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
            '/polymart/stars/323' => 'stars',
        ];
    }
}
