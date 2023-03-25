<?php

declare(strict_types=1);

namespace App\Badges\Docker\Badges;

use App\Enums\Category;

final class PullsBadge extends AbstractBadge
{
    protected array $routes = [
        '/docker/pulls/{scope}/{name}',
    ];

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
            '/docker/pulls/library/ubuntu' => 'pulls (library)',
            '/docker/pulls/amio/node-chrome' => 'pulls (scoped)',
        ];
    }
}
