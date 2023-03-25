<?php

declare(strict_types=1);

namespace App\Badges\Feedz\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class VersionBadge extends AbstractBadge
{
    /**
     * The routes to access this badge.
     *
     * @var array<int, string>
     */
    protected array $routes = [
        '/feedz/version/{organization}/{repository}/{packageName}',
    ];

    /**
     * The keywords that describe this badge.
     *
     * @var array<int, string>
     */
    protected array $keywords = [
        Category::VERSION,
    ];

    public function handle(string $organization, string $repository, string $packageName): array
    {
        return [
            'version' => head($this->client->items($organization, $repository, $packageName)),
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderVersion($properties['version']);
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
            '/feedz/version/shieldstests/mongodb/MongoDB.Driver.Core' => 'version',
        ];
    }
}
