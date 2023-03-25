<?php

declare(strict_types=1);

namespace App\Badges\JetBrains\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class VersionBadge extends AbstractBadge
{
    protected array $routes = [
        '/jetbrains/version/{pluginId}',
    ];

    protected array $keywords = [
        Category::VERSION,
    ];

    public function handle(string $pluginId): array
    {
        if (\is_numeric($pluginId)) {
            return [
                'version' => $this->client->legacy($pluginId)->filterXPath('//plugin-repository//category//idea-plugin//version')->text(),
            ];
        }

        return [
            'version' => $this->client->updates($pluginId)[0]['version'],
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
                name: 'version',
                path: '/jetbrains/version/13441-laravel-idea',
                data: $this->render(['version' => '1.0.0']),
            ),
            new BadgePreviewData(
                name: 'version (legacy plugin)',
                path: '/jetbrains/version/9630',
                data: $this->render(['version' => '1.0.0']),
            ),
        ];
    }
}
