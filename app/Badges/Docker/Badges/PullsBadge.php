<?php

declare(strict_types=1);

namespace App\Badges\Docker\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class PullsBadge extends AbstractBadge
{
    /**
     * The routes to access this badge.
     *
     * @var array<int, string>
     */
    protected array $routes = [
        '/docker/pulls/{scope}/{name}',
    ];

    /**
     * The keywords that describe this badge.
     *
     * @var array<int, string>
     */
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
