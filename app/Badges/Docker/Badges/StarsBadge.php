<?php

declare(strict_types=1);

namespace App\Badges\Docker\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class StarsBadge extends AbstractBadge
{
    protected array $routes = [
        '/docker/stars/{scope}/{name}',
    ];

    protected array $keywords = [
        Category::RATING,
    ];

    public function handle(string $scope, string $name): array
    {
        return [
            'stars' => $this->client->info($scope, $name)['star_count'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderStars('stars', $properties['stars']);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'stars (library)',
                path: '/docker/stars/library/ubuntu',
                data: $this->render([]),
            ),
            new BadgePreviewData(
                name: 'stars (icon & label)',
                path: '/docker/stars/library/mongo',
                data: $this->render([]),
            ),
        ];
    }
}
