<?php

declare(strict_types=1);

namespace App\Badges\JetBrains\Badges;

use App\Enums\Category;

final class DownloadsBadge extends AbstractBadge
{
    protected array $routes = [
        '/jetbrains/downloads/{pluginId}',
    ];

    protected array $keywords = [
        Category::RATING,
    ];

    public function handle(string $pluginId): array
    {
        if (\is_numeric($pluginId)) {
            return [
                'downloads' => $this->client->legacy($pluginId)->filterXPath('//plugin-repository//category//idea-plugin//@downloads')->text(),
            ];
        }

        return $this->client->info($pluginId);
    }

    public function render(array $properties): array
    {
        return $this->renderDownloads($properties['downloads']);
    }

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/jetbrains/downloads/13441-laravel-idea' => 'downloads',
            '/jetbrains/downloads/9630' => 'downloads (legacy plugin)',
        ];
    }
}
