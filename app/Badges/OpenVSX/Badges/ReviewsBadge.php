<?php

declare(strict_types=1);

namespace App\Badges\OpenVSX\Badges;

use App\Enums\Category;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;

final class ReviewsBadge extends AbstractBadge
{
    public function handle(string $extension): array
    {
        return [
            'count' => $this->client->get($extension)['reviewCount'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderNumber('reviews', $properties['count']);
    }

    public function keywords(): array
    {
        return [Category::SOCIAL];
    }

    public function routePaths(): array
    {
        return [
            '/open-vsx/reviews/{extension}',
        ];
    }

    public function routeParameters(): array
    {
        return [];
    }

    public function routeConstraints(Route $route): void
    {
        $route->where('extension', RoutePattern::CATCH_ALL->value);
    }

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/open-vsx/reviews/idleberg/electron-builder' => 'reviews',
        ];
    }
}
