<?php

declare(strict_types=1);

namespace App\Badges\Ore\Badges;

use App\Enums\Category;

final class SpongeVersionBadge extends AbstractBadge
{
    protected array $routes = [
        '/ore/sponge-version/{pluginId}',
    ];

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
