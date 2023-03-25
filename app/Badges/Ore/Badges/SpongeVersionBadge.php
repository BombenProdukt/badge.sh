<?php

declare(strict_types=1);

namespace App\Badges\Ore\Badges;

use App\Data\BadgePreviewData;
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

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'sponge version',
                path: '/ore/sponge-version/nucleus',
                data: $this->render([]),
            ),
        ];
    }
}
