<?php

declare(strict_types=1);

namespace App\Badges\Docker\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class PullsBadge extends AbstractBadge
{
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

    public function keywords(): array
    {
        return [Category::DOWNLOADS];
    }

    public function routePaths(): array
    {
        return [
            '/docker/pulls/{scope}/{name}',
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
            '/docker/pulls/library/ubuntu' => 'pulls (library)',
            '/docker/pulls/amio/node-chrome' => 'pulls (scoped)',
        ];
    }
}
