<?php

declare(strict_types=1);

namespace App\Badges\Docker;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class StarsBadge extends AbstractBadge
{
    protected string $route = '/docker/stars/{scope}/{name}';

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
                data: $this->render(['stars' => '4.5']),
            ),
            new BadgePreviewData(
                name: 'stars (icon & label)',
                path: '/docker/stars/library/mongo',
                data: $this->render(['stars' => '4.5']),
            ),
        ];
    }
}
