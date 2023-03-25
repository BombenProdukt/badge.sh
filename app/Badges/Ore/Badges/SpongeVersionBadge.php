<?php

declare(strict_types=1);

namespace App\Badges\Ore\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class SpongeVersionBadge extends AbstractBadge
{
    /**
     * The routes to access this badge.
     *
     * @var array<int, string>
     */
    protected array $routes = [
        '/ore/sponge-version/{pluginId}',
    ];

    /**
     * The keywords that describe this badge.
     *
     * @var array<int, string>
     */
    protected array $keywords = [
        Category::VERSION,
    ];

    public function handle(string $pluginId): array
    {
        return [
            'version' => collect($this->client->get($pluginId)['promoted_versions'])
                ->flatMap(fn (array $version) => $version['tags'])
                ->filter(fn (array $tag) => \mb_strtolower($tag['name']) === 'sponge')
                ->map(fn (array $tag) => $tag['display_data'])
                ->first(),
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
            '/ore/sponge-version/nucleus' => 'sponge version',
        ];
    }
}
