<?php

declare(strict_types=1);

namespace App\Badges\JetBrains\Badges;

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

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/jetbrains/version/13441-laravel-idea' => 'version',
            '/jetbrains/version/9630' => 'version (legacy plugin)',
        ];
    }
}
