<?php

declare(strict_types=1);

namespace App\Badges\Treeware\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class CountBadge extends AbstractBadge
{
    /**
     * The routes to access this badge.
     *
     * @var array<int, string>
     */
    protected array $routes = [
        '/treeware/trees/{owner}/{packageName}',
    ];

    /**
     * The keywords that describe this badge.
     *
     * @var array<int, string>
     */
    protected array $keywords = [
        Category::OTHER,
    ];

    public function handle(string $owner, string $packageName): array
    {
        return [
            'count' => $this->client->get($owner, $packageName),
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderNumber('trees', $properties['count']);
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
            '/treeware/trees/stoplightio/spectral' => 'tree count',
        ];
    }
}
