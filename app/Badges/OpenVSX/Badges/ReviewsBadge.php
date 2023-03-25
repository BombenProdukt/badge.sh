<?php

declare(strict_types=1);

namespace App\Badges\OpenVSX\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;

final class ReviewsBadge extends AbstractBadge
{
    protected array $routes = [
        '/open-vsx/reviews/{extension}',
    ];

    protected array $keywords = [
        Category::SOCIAL,
    ];

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

    public function routeConstraints(Route $route): void
    {
        $route->where('extension', RoutePattern::CATCH_ALL->value);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'reviews',
                path: '/open-vsx/reviews/idleberg/electron-builder',
                data: $this->render([]),
            ),
        ];
    }
}
