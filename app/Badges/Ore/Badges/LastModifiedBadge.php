<?php

declare(strict_types=1);

namespace App\Badges\Ore\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class LastModifiedBadge extends AbstractBadge
{
    /**
     * The routes to access this badge.
     *
     * @var array<int, string>
     */
    protected array $routes = [
        '/ore/last-modified/{pluginId}',
    ];

    /**
     * The keywords that describe this badge.
     *
     * @var array<int, string>
     */
    protected array $keywords = [
        Category::ACTIVITY,
    ];

    public function handle(string $pluginId): array
    {
        return [
            'date' => $this->client->get($pluginId)['last_updated'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderDateDiff('last modified', $properties['date']);
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
            '/ore/last-modified/nucleus' => 'license',
        ];
    }
}
