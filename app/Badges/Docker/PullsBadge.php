<?php

declare(strict_types=1);

namespace App\Badges\Docker;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class PullsBadge extends AbstractBadge
{
    protected string $route = '/docker/pulls/{scope}/{name}';

    protected array $keywords = [
        Category::DOWNLOADS,
    ];

    public function handle(string $scope, string $name): array
    {
        return [
            'count' => $this->client->info($scope, $name)['pull_count'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderNumber('docker pulls', $properties['count']);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'pulls (library)',
                path: '/docker/pulls/library/ubuntu',
                data: $this->render(['count' => 0]),
            ),
            new BadgePreviewData(
                name: 'pulls (scoped)',
                path: '/docker/pulls/amio/node-chrome',
                data: $this->render(['count' => 0]),
            ),
        ];
    }
}
