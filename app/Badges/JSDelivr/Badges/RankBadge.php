<?php

declare(strict_types=1);

namespace App\Badges\JSDelivr\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;

final class RankBadge extends AbstractBadge
{
    protected array $routes = [
        '/jsdelivr/rank/{platform}/{package}',
    ];

    protected array $keywords = [
        Category::SOCIAL,
    ];

    public function handle(string $platform, string $package): array
    {
        return $this->client->data($platform, $package);
    }

    public function render(array $properties): array
    {
        return [
            'label' => 'jsDelivr rank',
            'message' => $properties['rank'] ? '#'.$properties['rank'] : 'none',
            'messageColor' => $properties['rank'] ? 'blue.600' : 'gray.600',
        ];
    }

    public function routeConstraints(Route $route): void
    {
        $route->where('package', RoutePattern::CATCH_ALL->value);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'rank',
                path: '/jsdelivr/rank/npm/lodash',
                data: $this->render(['rank' => 1]),
            ),
        ];
    }
}
